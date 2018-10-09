<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "v02_rutin2info.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$v02_rutin2_search = NULL; // Initialize page object first

class cv02_rutin2_search extends cv02_rutin2 {

	// Page ID
	var $PageID = 'search';

	// Project ID
	var $ProjectID = "{8F2DFBC1-53BE-44C3-91F5-73D45F821091}";

	// Table name
	var $TableName = 'v02_rutin2';

	// Page object name
	var $PageObjName = 'v02_rutin2_search';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (v02_rutin2)
		if (!isset($GLOBALS["v02_rutin2"]) || get_class($GLOBALS["v02_rutin2"]) == "cv02_rutin2") {
			$GLOBALS["v02_rutin2"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["v02_rutin2"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'search', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'v02_rutin2', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t96_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct96_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanSearch()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("v02_rutin2list.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Create form object
		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->tahunajaran_id->SetVisibility();
		$this->sekolah_id->SetVisibility();
		$this->kelas_id->SetVisibility();
		$this->siswa_id->SetVisibility();
		$this->rutin_id->SetVisibility();
		$this->id->SetVisibility();
		$this->id->Visible = !$this->IsAdd() && !$this->IsCopy() && !$this->IsGridAdd();
		$this->siswarutin_id->SetVisibility();
		$this->Bulan->SetVisibility();
		$this->Tahun->SetVisibility();
		$this->Bayar_Tgl->SetVisibility();
		$this->Bayar_Jumlah->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $v02_rutin2;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($v02_rutin2);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) {
				$row = array();
				$row["url"] = $url;
				echo ew_ArrayToJson(array($row));
			} else {
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewSearchForm";
	var $IsModal = FALSE;
	var $SearchLabelClass = "col-sm-3 control-label ewLabel";
	var $SearchRightColumnClass = "col-sm-9";

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError;
		global $gbSkipHeaderFooter;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		if ($this->IsPageRequest()) { // Validate request

			// Get action
			$this->CurrentAction = $objForm->GetValue("a_search");
			switch ($this->CurrentAction) {
				case "S": // Get search criteria

					// Build search string for advanced search, remove blank field
					$this->LoadSearchValues(); // Get search values
					if ($this->ValidateSearch()) {
						$sSrchStr = $this->BuildAdvancedSearch();
					} else {
						$sSrchStr = "";
						$this->setFailureMessage($gsSearchError);
					}
					if ($sSrchStr <> "") {
						$sSrchStr = $this->UrlParm($sSrchStr);
						$sSrchStr = "v02_rutin2list.php" . "?" . $sSrchStr;
						$this->Page_Terminate($sSrchStr); // Go to list page
					}
			}
		}

		// Restore search settings from Session
		if ($gsSearchError == "")
			$this->LoadAdvancedSearch();

		// Render row for search
		$this->RowType = EW_ROWTYPE_SEARCH;
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Build advanced search
	function BuildAdvancedSearch() {
		$sSrchUrl = "";
		$this->BuildSearchUrl($sSrchUrl, $this->tahunajaran_id); // tahunajaran_id
		$this->BuildSearchUrl($sSrchUrl, $this->sekolah_id); // sekolah_id
		$this->BuildSearchUrl($sSrchUrl, $this->kelas_id); // kelas_id
		$this->BuildSearchUrl($sSrchUrl, $this->siswa_id); // siswa_id
		$this->BuildSearchUrl($sSrchUrl, $this->rutin_id); // rutin_id
		$this->BuildSearchUrl($sSrchUrl, $this->id); // id
		$this->BuildSearchUrl($sSrchUrl, $this->siswarutin_id); // siswarutin_id
		$this->BuildSearchUrl($sSrchUrl, $this->Bulan); // Bulan
		$this->BuildSearchUrl($sSrchUrl, $this->Tahun); // Tahun
		$this->BuildSearchUrl($sSrchUrl, $this->Bayar_Tgl); // Bayar_Tgl
		$this->BuildSearchUrl($sSrchUrl, $this->Bayar_Jumlah); // Bayar_Jumlah
		if ($sSrchUrl <> "") $sSrchUrl .= "&";
		$sSrchUrl .= "cmd=search";
		return $sSrchUrl;
	}

	// Build search URL
	function BuildSearchUrl(&$Url, &$Fld, $OprOnly=FALSE) {
		global $objForm;
		$sWrk = "";
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = $objForm->GetValue("x_$FldParm");
		$FldOpr = $objForm->GetValue("z_$FldParm");
		$FldCond = $objForm->GetValue("v_$FldParm");
		$FldVal2 = $objForm->GetValue("y_$FldParm");
		$FldOpr2 = $objForm->GetValue("w_$FldParm");
		$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($FldOpr == "BETWEEN") {
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal) && $this->SearchValueIsNumeric($Fld, $FldVal2));
			if ($FldVal <> "" && $FldVal2 <> "" && $IsValidValue) {
				$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
					"&y_" . $FldParm . "=" . urlencode($FldVal2) .
					"&z_" . $FldParm . "=" . urlencode($FldOpr);
			}
		} else {
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal));
			if ($FldVal <> "" && $IsValidValue && ew_IsValidOpr($FldOpr, $lFldDataType)) {
				$sWrk = "x_" . $FldParm . "=" . urlencode($FldVal) .
					"&z_" . $FldParm . "=" . urlencode($FldOpr);
			} elseif ($FldOpr == "IS NULL" || $FldOpr == "IS NOT NULL" || ($FldOpr <> "" && $OprOnly && ew_IsValidOpr($FldOpr, $lFldDataType))) {
				$sWrk = "z_" . $FldParm . "=" . urlencode($FldOpr);
			}
			$IsValidValue = ($lFldDataType <> EW_DATATYPE_NUMBER) ||
				($lFldDataType == EW_DATATYPE_NUMBER && $this->SearchValueIsNumeric($Fld, $FldVal2));
			if ($FldVal2 <> "" && $IsValidValue && ew_IsValidOpr($FldOpr2, $lFldDataType)) {
				if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
				$sWrk .= "y_" . $FldParm . "=" . urlencode($FldVal2) .
					"&w_" . $FldParm . "=" . urlencode($FldOpr2);
			} elseif ($FldOpr2 == "IS NULL" || $FldOpr2 == "IS NOT NULL" || ($FldOpr2 <> "" && $OprOnly && ew_IsValidOpr($FldOpr2, $lFldDataType))) {
				if ($sWrk <> "") $sWrk .= "&v_" . $FldParm . "=" . urlencode($FldCond) . "&";
				$sWrk .= "w_" . $FldParm . "=" . urlencode($FldOpr2);
			}
		}
		if ($sWrk <> "") {
			if ($Url <> "") $Url .= "&";
			$Url .= $sWrk;
		}
	}

	function SearchValueIsNumeric($Fld, $Value) {
		if (ew_IsFloatFormat($Fld->FldType)) $Value = ew_StrToFloat($Value);
		return is_numeric($Value);
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// tahunajaran_id

		$this->tahunajaran_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_tahunajaran_id"));
		$this->tahunajaran_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_tahunajaran_id");

		// sekolah_id
		$this->sekolah_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_sekolah_id"));
		$this->sekolah_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_sekolah_id");

		// kelas_id
		$this->kelas_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_kelas_id"));
		$this->kelas_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_kelas_id");

		// siswa_id
		$this->siswa_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_siswa_id"));
		$this->siswa_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_siswa_id");

		// rutin_id
		$this->rutin_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_rutin_id"));
		$this->rutin_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_rutin_id");

		// id
		$this->id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_id"));
		$this->id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_id");

		// siswarutin_id
		$this->siswarutin_id->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_siswarutin_id"));
		$this->siswarutin_id->AdvancedSearch->SearchOperator = $objForm->GetValue("z_siswarutin_id");

		// Bulan
		$this->Bulan->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Bulan"));
		$this->Bulan->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Bulan");

		// Tahun
		$this->Tahun->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Tahun"));
		$this->Tahun->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Tahun");

		// Bayar_Tgl
		$this->Bayar_Tgl->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Bayar_Tgl"));
		$this->Bayar_Tgl->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Bayar_Tgl");

		// Bayar_Jumlah
		$this->Bayar_Jumlah->AdvancedSearch->SearchValue = ew_StripSlashes($objForm->GetValue("x_Bayar_Jumlah"));
		$this->Bayar_Jumlah->AdvancedSearch->SearchOperator = $objForm->GetValue("z_Bayar_Jumlah");
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Bayar_Jumlah->FormValue == $this->Bayar_Jumlah->CurrentValue && is_numeric(ew_StrToFloat($this->Bayar_Jumlah->CurrentValue)))
			$this->Bayar_Jumlah->CurrentValue = ew_StrToFloat($this->Bayar_Jumlah->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// tahunajaran_id
		// sekolah_id
		// kelas_id
		// siswa_id
		// rutin_id
		// id
		// siswarutin_id
		// Bulan
		// Tahun
		// Bayar_Tgl
		// Bayar_Jumlah

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// tahunajaran_id
		if (strval($this->tahunajaran_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->tahunajaran_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `tahun_pelajaran` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v00_tahunajaran`";
		$sWhereWrk = "";
		$this->tahunajaran_id->LookupFilters = array("dx1" => '`tahun_pelajaran`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tahunajaran_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->tahunajaran_id->ViewValue = $this->tahunajaran_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tahunajaran_id->ViewValue = $this->tahunajaran_id->CurrentValue;
			}
		} else {
			$this->tahunajaran_id->ViewValue = NULL;
		}
		$this->tahunajaran_id->ViewCustomAttributes = "";

		// sekolah_id
		if (strval($this->sekolah_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->sekolah_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nomor_Induk` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_sekolah`";
		$sWhereWrk = "";
		$this->sekolah_id->LookupFilters = array("dx1" => '`Nomor_Induk`', "dx2" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->sekolah_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->sekolah_id->ViewValue = $this->sekolah_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->sekolah_id->ViewValue = $this->sekolah_id->CurrentValue;
			}
		} else {
			$this->sekolah_id->ViewValue = NULL;
		}
		$this->sekolah_id->ViewCustomAttributes = "";

		// kelas_id
		if (strval($this->kelas_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->kelas_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t02_kelas`";
		$sWhereWrk = "";
		$this->kelas_id->LookupFilters = array("dx1" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->kelas_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->kelas_id->ViewValue = $this->kelas_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->kelas_id->ViewValue = $this->kelas_id->CurrentValue;
			}
		} else {
			$this->kelas_id->ViewValue = NULL;
		}
		$this->kelas_id->ViewCustomAttributes = "";

		// siswa_id
		if (strval($this->siswa_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswa_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nomor_Induk` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t03_siswa`";
		$sWhereWrk = "";
		$this->siswa_id->LookupFilters = array("dx1" => '`Nomor_Induk`', "dx2" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->siswa_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->siswa_id->ViewValue = $this->siswa_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
			}
		} else {
			$this->siswa_id->ViewValue = NULL;
		}
		$this->siswa_id->ViewCustomAttributes = "";

		// rutin_id
		if (strval($this->rutin_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->rutin_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t04_rutin`";
		$sWhereWrk = "";
		$this->rutin_id->LookupFilters = array("dx1" => '`Nama`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->rutin_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->rutin_id->ViewValue = $this->rutin_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->rutin_id->ViewValue = $this->rutin_id->CurrentValue;
			}
		} else {
			$this->rutin_id->ViewValue = NULL;
		}
		$this->rutin_id->ViewCustomAttributes = "";

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// siswarutin_id
		$this->siswarutin_id->ViewValue = $this->siswarutin_id->CurrentValue;
		$this->siswarutin_id->ViewCustomAttributes = "";

		// Bulan
		$this->Bulan->ViewValue = $this->Bulan->CurrentValue;
		$this->Bulan->ViewCustomAttributes = "";

		// Tahun
		$this->Tahun->ViewValue = $this->Tahun->CurrentValue;
		$this->Tahun->ViewCustomAttributes = "";

		// Bayar_Tgl
		$this->Bayar_Tgl->ViewValue = $this->Bayar_Tgl->CurrentValue;
		$this->Bayar_Tgl->ViewValue = ew_FormatDateTime($this->Bayar_Tgl->ViewValue, 0);
		$this->Bayar_Tgl->ViewCustomAttributes = "";

		// Bayar_Jumlah
		$this->Bayar_Jumlah->ViewValue = $this->Bayar_Jumlah->CurrentValue;
		$this->Bayar_Jumlah->ViewCustomAttributes = "";

			// tahunajaran_id
			$this->tahunajaran_id->LinkCustomAttributes = "";
			$this->tahunajaran_id->HrefValue = "";
			$this->tahunajaran_id->TooltipValue = "";

			// sekolah_id
			$this->sekolah_id->LinkCustomAttributes = "";
			$this->sekolah_id->HrefValue = "";
			$this->sekolah_id->TooltipValue = "";

			// kelas_id
			$this->kelas_id->LinkCustomAttributes = "";
			$this->kelas_id->HrefValue = "";
			$this->kelas_id->TooltipValue = "";

			// siswa_id
			$this->siswa_id->LinkCustomAttributes = "";
			$this->siswa_id->HrefValue = "";
			$this->siswa_id->TooltipValue = "";

			// rutin_id
			$this->rutin_id->LinkCustomAttributes = "";
			$this->rutin_id->HrefValue = "";
			$this->rutin_id->TooltipValue = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// siswarutin_id
			$this->siswarutin_id->LinkCustomAttributes = "";
			$this->siswarutin_id->HrefValue = "";
			$this->siswarutin_id->TooltipValue = "";

			// Bulan
			$this->Bulan->LinkCustomAttributes = "";
			$this->Bulan->HrefValue = "";
			$this->Bulan->TooltipValue = "";

			// Tahun
			$this->Tahun->LinkCustomAttributes = "";
			$this->Tahun->HrefValue = "";
			$this->Tahun->TooltipValue = "";

			// Bayar_Tgl
			$this->Bayar_Tgl->LinkCustomAttributes = "";
			$this->Bayar_Tgl->HrefValue = "";
			$this->Bayar_Tgl->TooltipValue = "";

			// Bayar_Jumlah
			$this->Bayar_Jumlah->LinkCustomAttributes = "";
			$this->Bayar_Jumlah->HrefValue = "";
			$this->Bayar_Jumlah->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// tahunajaran_id
			$this->tahunajaran_id->EditCustomAttributes = "";
			if (trim(strval($this->tahunajaran_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->tahunajaran_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `tahun_pelajaran` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `v00_tahunajaran`";
			$sWhereWrk = "";
			$this->tahunajaran_id->LookupFilters = array("dx1" => '`tahun_pelajaran`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->tahunajaran_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->tahunajaran_id->AdvancedSearch->ViewValue = $this->tahunajaran_id->DisplayValue($arwrk);
			} else {
				$this->tahunajaran_id->AdvancedSearch->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tahunajaran_id->EditValue = $arwrk;

			// sekolah_id
			$this->sekolah_id->EditCustomAttributes = "";
			if (trim(strval($this->sekolah_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->sekolah_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nomor_Induk` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t01_sekolah`";
			$sWhereWrk = "";
			$this->sekolah_id->LookupFilters = array("dx1" => '`Nomor_Induk`', "dx2" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->sekolah_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
				$this->sekolah_id->AdvancedSearch->ViewValue = $this->sekolah_id->DisplayValue($arwrk);
			} else {
				$this->sekolah_id->AdvancedSearch->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->sekolah_id->EditValue = $arwrk;

			// kelas_id
			$this->kelas_id->EditCustomAttributes = "";
			if (trim(strval($this->kelas_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->kelas_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `sekolah_id` AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t02_kelas`";
			$sWhereWrk = "";
			$this->kelas_id->LookupFilters = array("dx1" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->kelas_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->kelas_id->AdvancedSearch->ViewValue = $this->kelas_id->DisplayValue($arwrk);
			} else {
				$this->kelas_id->AdvancedSearch->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->kelas_id->EditValue = $arwrk;

			// siswa_id
			$this->siswa_id->EditCustomAttributes = "";
			if (trim(strval($this->siswa_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswa_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nomor_Induk` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, `tahunajaran_id` AS `SelectFilterFld`, `kelas_id` AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t03_siswa`";
			$sWhereWrk = "";
			$this->siswa_id->LookupFilters = array("dx1" => '`Nomor_Induk`', "dx2" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->siswa_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
				$this->siswa_id->AdvancedSearch->ViewValue = $this->siswa_id->DisplayValue($arwrk);
			} else {
				$this->siswa_id->AdvancedSearch->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->siswa_id->EditValue = $arwrk;

			// rutin_id
			$this->rutin_id->EditCustomAttributes = "";
			if (trim(strval($this->rutin_id->AdvancedSearch->SearchValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->rutin_id->AdvancedSearch->SearchValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t04_rutin`";
			$sWhereWrk = "";
			$this->rutin_id->LookupFilters = array("dx1" => '`Nama`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->rutin_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->rutin_id->AdvancedSearch->ViewValue = $this->rutin_id->DisplayValue($arwrk);
			} else {
				$this->rutin_id->AdvancedSearch->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->rutin_id->EditValue = $arwrk;

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = ew_HtmlEncode($this->id->AdvancedSearch->SearchValue);
			$this->id->PlaceHolder = ew_RemoveHtml($this->id->FldCaption());

			// siswarutin_id
			$this->siswarutin_id->EditAttrs["class"] = "form-control";
			$this->siswarutin_id->EditCustomAttributes = "";
			$this->siswarutin_id->EditValue = ew_HtmlEncode($this->siswarutin_id->AdvancedSearch->SearchValue);
			$this->siswarutin_id->PlaceHolder = ew_RemoveHtml($this->siswarutin_id->FldCaption());

			// Bulan
			$this->Bulan->EditAttrs["class"] = "form-control";
			$this->Bulan->EditCustomAttributes = "";
			$this->Bulan->EditValue = ew_HtmlEncode($this->Bulan->AdvancedSearch->SearchValue);
			$this->Bulan->PlaceHolder = ew_RemoveHtml($this->Bulan->FldCaption());

			// Tahun
			$this->Tahun->EditAttrs["class"] = "form-control";
			$this->Tahun->EditCustomAttributes = "";
			$this->Tahun->EditValue = ew_HtmlEncode($this->Tahun->AdvancedSearch->SearchValue);
			$this->Tahun->PlaceHolder = ew_RemoveHtml($this->Tahun->FldCaption());

			// Bayar_Tgl
			$this->Bayar_Tgl->EditAttrs["class"] = "form-control";
			$this->Bayar_Tgl->EditCustomAttributes = "";
			$this->Bayar_Tgl->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->Bayar_Tgl->AdvancedSearch->SearchValue, 0), 8));
			$this->Bayar_Tgl->PlaceHolder = ew_RemoveHtml($this->Bayar_Tgl->FldCaption());

			// Bayar_Jumlah
			$this->Bayar_Jumlah->EditAttrs["class"] = "form-control";
			$this->Bayar_Jumlah->EditCustomAttributes = "";
			$this->Bayar_Jumlah->EditValue = ew_HtmlEncode($this->Bayar_Jumlah->AdvancedSearch->SearchValue);
			$this->Bayar_Jumlah->PlaceHolder = ew_RemoveHtml($this->Bayar_Jumlah->FldCaption());
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;
		if (!ew_CheckInteger($this->id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->id->FldErrMsg());
		}
		if (!ew_CheckInteger($this->siswarutin_id->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->siswarutin_id->FldErrMsg());
		}
		if (!ew_CheckInteger($this->Bulan->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Bulan->FldErrMsg());
		}
		if (!ew_CheckInteger($this->Tahun->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Tahun->FldErrMsg());
		}
		if (!ew_CheckDateDef($this->Bayar_Tgl->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Bayar_Tgl->FldErrMsg());
		}
		if (!ew_CheckNumber($this->Bayar_Jumlah->AdvancedSearch->SearchValue)) {
			ew_AddMessage($gsSearchError, $this->Bayar_Jumlah->FldErrMsg());
		}

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->tahunajaran_id->AdvancedSearch->Load();
		$this->sekolah_id->AdvancedSearch->Load();
		$this->kelas_id->AdvancedSearch->Load();
		$this->siswa_id->AdvancedSearch->Load();
		$this->rutin_id->AdvancedSearch->Load();
		$this->id->AdvancedSearch->Load();
		$this->siswarutin_id->AdvancedSearch->Load();
		$this->Bulan->AdvancedSearch->Load();
		$this->Tahun->AdvancedSearch->Load();
		$this->Bayar_Tgl->AdvancedSearch->Load();
		$this->Bayar_Jumlah->AdvancedSearch->Load();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("v02_rutin2list.php"), "", $this->TableVar, TRUE);
		$PageId = "search";
		$Breadcrumb->Add("search", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_tahunajaran_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `tahun_pelajaran` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `v00_tahunajaran`";
			$sWhereWrk = "{filter}";
			$this->tahunajaran_id->LookupFilters = array("dx1" => '`tahun_pelajaran`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tahunajaran_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_sekolah_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nomor_Induk` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t01_sekolah`";
			$sWhereWrk = "{filter}";
			$this->sekolah_id->LookupFilters = array("dx1" => '`Nomor_Induk`', "dx2" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->sekolah_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_kelas_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t02_kelas`";
			$sWhereWrk = "{filter}";
			$this->kelas_id->LookupFilters = array("dx1" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "", "f1" => '`sekolah_id` IN ({filter_value})', "t1" => "3", "fn1" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->kelas_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_siswa_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nomor_Induk` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t03_siswa`";
			$sWhereWrk = "{filter}";
			$this->siswa_id->LookupFilters = array("dx1" => '`Nomor_Induk`', "dx2" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "", "f1" => '`tahunajaran_id` IN ({filter_value})', "t1" => "3", "fn1" => "", "f2" => '`kelas_id` IN ({filter_value})', "t2" => "3", "fn2" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->siswa_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_rutin_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Nama` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t04_rutin`";
			$sWhereWrk = "{filter}";
			$this->rutin_id->LookupFilters = array("dx1" => '`Nama`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->rutin_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($v02_rutin2_search)) $v02_rutin2_search = new cv02_rutin2_search();

// Page init
$v02_rutin2_search->Page_Init();

// Page main
$v02_rutin2_search->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v02_rutin2_search->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "search";
<?php if ($v02_rutin2_search->IsModal) { ?>
var CurrentAdvancedSearchForm = fv02_rutin2search = new ew_Form("fv02_rutin2search", "search");
<?php } else { ?>
var CurrentForm = fv02_rutin2search = new ew_Form("fv02_rutin2search", "search");
<?php } ?>

// Form_CustomValidate event
fv02_rutin2search.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fv02_rutin2search.ValidateRequired = true;
<?php } else { ?>
fv02_rutin2search.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fv02_rutin2search.Lists["x_tahunajaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tahun_pelajaran","","",""],"ParentFields":[],"ChildFields":["x_siswa_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v00_tahunajaran"};
fv02_rutin2search.Lists["x_sekolah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor_Induk","x_Nama","",""],"ParentFields":[],"ChildFields":["x_kelas_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_sekolah"};
fv02_rutin2search.Lists["x_kelas_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":["x_sekolah_id"],"ChildFields":["x_siswa_id"],"FilterFields":["x_sekolah_id"],"Options":[],"Template":"","LinkTable":"t02_kelas"};
fv02_rutin2search.Lists["x_siswa_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor_Induk","x_Nama","",""],"ParentFields":["x_tahunajaran_id","x_kelas_id"],"ChildFields":[],"FilterFields":["x_tahunajaran_id","x_kelas_id"],"Options":[],"Template":"","LinkTable":"t03_siswa"};
fv02_rutin2search.Lists["x_rutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t04_rutin"};

// Form object for search
// Validate function for search

fv02_rutin2search.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";
	elm = this.GetElements("x" + infix + "_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v02_rutin2->id->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_siswarutin_id");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v02_rutin2->siswarutin_id->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Bulan");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v02_rutin2->Bulan->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Tahun");
	if (elm && !ew_CheckInteger(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v02_rutin2->Tahun->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Bayar_Tgl");
	if (elm && !ew_CheckDateDef(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v02_rutin2->Bayar_Tgl->FldErrMsg()) ?>");
	elm = this.GetElements("x" + infix + "_Bayar_Jumlah");
	if (elm && !ew_CheckNumber(elm.value))
		return this.OnError(elm, "<?php echo ew_JsEncode2($v02_rutin2->Bayar_Jumlah->FldErrMsg()) ?>");

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$v02_rutin2_search->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $v02_rutin2_search->ShowPageHeader(); ?>
<?php
$v02_rutin2_search->ShowMessage();
?>
<form name="fv02_rutin2search" id="fv02_rutin2search" class="<?php echo $v02_rutin2_search->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($v02_rutin2_search->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $v02_rutin2_search->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v02_rutin2">
<input type="hidden" name="a_search" id="a_search" value="S">
<?php if ($v02_rutin2_search->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($v02_rutin2->tahunajaran_id->Visible) { // tahunajaran_id ?>
	<div id="r_tahunajaran_id" class="form-group">
		<label for="x_tahunajaran_id" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_tahunajaran_id"><?php echo $v02_rutin2->tahunajaran_id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_tahunajaran_id" id="z_tahunajaran_id" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->tahunajaran_id->CellAttributes() ?>>
			<span id="el_v02_rutin2_tahunajaran_id">
<?php $v02_rutin2->tahunajaran_id->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$v02_rutin2->tahunajaran_id->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tahunajaran_id"><?php echo (strval($v02_rutin2->tahunajaran_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $v02_rutin2->tahunajaran_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($v02_rutin2->tahunajaran_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tahunajaran_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="v02_rutin2" data-field="x_tahunajaran_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v02_rutin2->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" name="x_tahunajaran_id" id="x_tahunajaran_id" value="<?php echo $v02_rutin2->tahunajaran_id->AdvancedSearch->SearchValue ?>"<?php echo $v02_rutin2->tahunajaran_id->EditAttributes() ?>>
<input type="hidden" name="s_x_tahunajaran_id" id="s_x_tahunajaran_id" value="<?php echo $v02_rutin2->tahunajaran_id->LookupFilterQuery() ?>">
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v02_rutin2->sekolah_id->Visible) { // sekolah_id ?>
	<div id="r_sekolah_id" class="form-group">
		<label for="x_sekolah_id" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_sekolah_id"><?php echo $v02_rutin2->sekolah_id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_sekolah_id" id="z_sekolah_id" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->sekolah_id->CellAttributes() ?>>
			<span id="el_v02_rutin2_sekolah_id">
<?php $v02_rutin2->sekolah_id->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$v02_rutin2->sekolah_id->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_sekolah_id"><?php echo (strval($v02_rutin2->sekolah_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $v02_rutin2->sekolah_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($v02_rutin2->sekolah_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_sekolah_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="v02_rutin2" data-field="x_sekolah_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v02_rutin2->sekolah_id->DisplayValueSeparatorAttribute() ?>" name="x_sekolah_id" id="x_sekolah_id" value="<?php echo $v02_rutin2->sekolah_id->AdvancedSearch->SearchValue ?>"<?php echo $v02_rutin2->sekolah_id->EditAttributes() ?>>
<input type="hidden" name="s_x_sekolah_id" id="s_x_sekolah_id" value="<?php echo $v02_rutin2->sekolah_id->LookupFilterQuery() ?>">
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v02_rutin2->kelas_id->Visible) { // kelas_id ?>
	<div id="r_kelas_id" class="form-group">
		<label for="x_kelas_id" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_kelas_id"><?php echo $v02_rutin2->kelas_id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_kelas_id" id="z_kelas_id" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->kelas_id->CellAttributes() ?>>
			<span id="el_v02_rutin2_kelas_id">
<?php $v02_rutin2->kelas_id->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$v02_rutin2->kelas_id->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_kelas_id"><?php echo (strval($v02_rutin2->kelas_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $v02_rutin2->kelas_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($v02_rutin2->kelas_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_kelas_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="v02_rutin2" data-field="x_kelas_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v02_rutin2->kelas_id->DisplayValueSeparatorAttribute() ?>" name="x_kelas_id" id="x_kelas_id" value="<?php echo $v02_rutin2->kelas_id->AdvancedSearch->SearchValue ?>"<?php echo $v02_rutin2->kelas_id->EditAttributes() ?>>
<input type="hidden" name="s_x_kelas_id" id="s_x_kelas_id" value="<?php echo $v02_rutin2->kelas_id->LookupFilterQuery() ?>">
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v02_rutin2->siswa_id->Visible) { // siswa_id ?>
	<div id="r_siswa_id" class="form-group">
		<label for="x_siswa_id" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_siswa_id"><?php echo $v02_rutin2->siswa_id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_siswa_id" id="z_siswa_id" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->siswa_id->CellAttributes() ?>>
			<span id="el_v02_rutin2_siswa_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_siswa_id"><?php echo (strval($v02_rutin2->siswa_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $v02_rutin2->siswa_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($v02_rutin2->siswa_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_siswa_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="v02_rutin2" data-field="x_siswa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v02_rutin2->siswa_id->DisplayValueSeparatorAttribute() ?>" name="x_siswa_id" id="x_siswa_id" value="<?php echo $v02_rutin2->siswa_id->AdvancedSearch->SearchValue ?>"<?php echo $v02_rutin2->siswa_id->EditAttributes() ?>>
<input type="hidden" name="s_x_siswa_id" id="s_x_siswa_id" value="<?php echo $v02_rutin2->siswa_id->LookupFilterQuery() ?>">
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v02_rutin2->rutin_id->Visible) { // rutin_id ?>
	<div id="r_rutin_id" class="form-group">
		<label for="x_rutin_id" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_rutin_id"><?php echo $v02_rutin2->rutin_id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_rutin_id" id="z_rutin_id" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->rutin_id->CellAttributes() ?>>
			<span id="el_v02_rutin2_rutin_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_rutin_id"><?php echo (strval($v02_rutin2->rutin_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $v02_rutin2->rutin_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($v02_rutin2->rutin_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_rutin_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="v02_rutin2" data-field="x_rutin_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v02_rutin2->rutin_id->DisplayValueSeparatorAttribute() ?>" name="x_rutin_id" id="x_rutin_id" value="<?php echo $v02_rutin2->rutin_id->AdvancedSearch->SearchValue ?>"<?php echo $v02_rutin2->rutin_id->EditAttributes() ?>>
<input type="hidden" name="s_x_rutin_id" id="s_x_rutin_id" value="<?php echo $v02_rutin2->rutin_id->LookupFilterQuery() ?>">
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v02_rutin2->id->Visible) { // id ?>
	<div id="r_id" class="form-group">
		<label for="x_id" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_id"><?php echo $v02_rutin2->id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id" id="z_id" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->id->CellAttributes() ?>>
			<span id="el_v02_rutin2_id">
<input type="text" data-table="v02_rutin2" data-field="x_id" name="x_id" id="x_id" placeholder="<?php echo ew_HtmlEncode($v02_rutin2->id->getPlaceHolder()) ?>" value="<?php echo $v02_rutin2->id->EditValue ?>"<?php echo $v02_rutin2->id->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v02_rutin2->siswarutin_id->Visible) { // siswarutin_id ?>
	<div id="r_siswarutin_id" class="form-group">
		<label for="x_siswarutin_id" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_siswarutin_id"><?php echo $v02_rutin2->siswarutin_id->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_siswarutin_id" id="z_siswarutin_id" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->siswarutin_id->CellAttributes() ?>>
			<span id="el_v02_rutin2_siswarutin_id">
<input type="text" data-table="v02_rutin2" data-field="x_siswarutin_id" name="x_siswarutin_id" id="x_siswarutin_id" size="30" placeholder="<?php echo ew_HtmlEncode($v02_rutin2->siswarutin_id->getPlaceHolder()) ?>" value="<?php echo $v02_rutin2->siswarutin_id->EditValue ?>"<?php echo $v02_rutin2->siswarutin_id->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v02_rutin2->Bulan->Visible) { // Bulan ?>
	<div id="r_Bulan" class="form-group">
		<label for="x_Bulan" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_Bulan"><?php echo $v02_rutin2->Bulan->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Bulan" id="z_Bulan" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->Bulan->CellAttributes() ?>>
			<span id="el_v02_rutin2_Bulan">
<input type="text" data-table="v02_rutin2" data-field="x_Bulan" name="x_Bulan" id="x_Bulan" size="30" placeholder="<?php echo ew_HtmlEncode($v02_rutin2->Bulan->getPlaceHolder()) ?>" value="<?php echo $v02_rutin2->Bulan->EditValue ?>"<?php echo $v02_rutin2->Bulan->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v02_rutin2->Tahun->Visible) { // Tahun ?>
	<div id="r_Tahun" class="form-group">
		<label for="x_Tahun" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_Tahun"><?php echo $v02_rutin2->Tahun->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Tahun" id="z_Tahun" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->Tahun->CellAttributes() ?>>
			<span id="el_v02_rutin2_Tahun">
<input type="text" data-table="v02_rutin2" data-field="x_Tahun" name="x_Tahun" id="x_Tahun" size="30" placeholder="<?php echo ew_HtmlEncode($v02_rutin2->Tahun->getPlaceHolder()) ?>" value="<?php echo $v02_rutin2->Tahun->EditValue ?>"<?php echo $v02_rutin2->Tahun->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v02_rutin2->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
	<div id="r_Bayar_Tgl" class="form-group">
		<label for="x_Bayar_Tgl" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_Bayar_Tgl"><?php echo $v02_rutin2->Bayar_Tgl->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Bayar_Tgl" id="z_Bayar_Tgl" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->Bayar_Tgl->CellAttributes() ?>>
			<span id="el_v02_rutin2_Bayar_Tgl">
<input type="text" data-table="v02_rutin2" data-field="x_Bayar_Tgl" name="x_Bayar_Tgl" id="x_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($v02_rutin2->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $v02_rutin2->Bayar_Tgl->EditValue ?>"<?php echo $v02_rutin2->Bayar_Tgl->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
<?php if ($v02_rutin2->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
	<div id="r_Bayar_Jumlah" class="form-group">
		<label for="x_Bayar_Jumlah" class="<?php echo $v02_rutin2_search->SearchLabelClass ?>"><span id="elh_v02_rutin2_Bayar_Jumlah"><?php echo $v02_rutin2->Bayar_Jumlah->FldCaption() ?></span>	
		<p class="form-control-static ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_Bayar_Jumlah" id="z_Bayar_Jumlah" value="="></p>
		</label>
		<div class="<?php echo $v02_rutin2_search->SearchRightColumnClass ?>"><div<?php echo $v02_rutin2->Bayar_Jumlah->CellAttributes() ?>>
			<span id="el_v02_rutin2_Bayar_Jumlah">
<input type="text" data-table="v02_rutin2" data-field="x_Bayar_Jumlah" name="x_Bayar_Jumlah" id="x_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($v02_rutin2->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $v02_rutin2->Bayar_Jumlah->EditValue ?>"<?php echo $v02_rutin2->Bayar_Jumlah->EditAttributes() ?>>
</span>
		</div></div>
	</div>
<?php } ?>
</div>
<?php if (!$v02_rutin2_search->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-3 col-sm-9">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("Search") ?></button>
<button class="btn btn-default ewButton" name="btnReset" id="btnReset" type="button" onclick="ew_ClearForm(this.form);"><?php echo $Language->Phrase("Reset") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
fv02_rutin2search.Init();
</script>
<?php
$v02_rutin2_search->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$v02_rutin2_search->Page_Terminate();
?>
