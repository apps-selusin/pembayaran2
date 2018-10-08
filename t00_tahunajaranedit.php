<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t00_tahunajaraninfo.php" ?>
<?php include_once "t96_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t00_tahunajaran_edit = NULL; // Initialize page object first

class ct00_tahunajaran_edit extends ct00_tahunajaran {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{8F2DFBC1-53BE-44C3-91F5-73D45F821091}";

	// Table name
	var $TableName = 't00_tahunajaran';

	// Page object name
	var $PageObjName = 't00_tahunajaran_edit';

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

		// Table object (t00_tahunajaran)
		if (!isset($GLOBALS["t00_tahunajaran"]) || get_class($GLOBALS["t00_tahunajaran"]) == "ct00_tahunajaran") {
			$GLOBALS["t00_tahunajaran"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t00_tahunajaran"];
		}

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't00_tahunajaran', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t00_tahunajaranlist.php"));
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
		$this->awal_bulan->SetVisibility();
		$this->awal_tahun->SetVisibility();
		$this->akhir_bulan->SetVisibility();
		$this->akhir_tahun->SetVisibility();

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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
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
		global $EW_EXPORT, $t00_tahunajaran;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t00_tahunajaran);
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
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Load key from QueryString
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
		}

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($this->id->CurrentValue == "") {
			$this->Page_Terminate("t00_tahunajaranlist.php"); // Invalid key, return to list
		}

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("t00_tahunajaranlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t00_tahunajaranlist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->awal_bulan->FldIsDetailKey) {
			$this->awal_bulan->setFormValue($objForm->GetValue("x_awal_bulan"));
		}
		if (!$this->awal_tahun->FldIsDetailKey) {
			$this->awal_tahun->setFormValue($objForm->GetValue("x_awal_tahun"));
		}
		if (!$this->akhir_bulan->FldIsDetailKey) {
			$this->akhir_bulan->setFormValue($objForm->GetValue("x_akhir_bulan"));
		}
		if (!$this->akhir_tahun->FldIsDetailKey) {
			$this->akhir_tahun->setFormValue($objForm->GetValue("x_akhir_tahun"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->awal_bulan->CurrentValue = $this->awal_bulan->FormValue;
		$this->awal_tahun->CurrentValue = $this->awal_tahun->FormValue;
		$this->akhir_bulan->CurrentValue = $this->akhir_bulan->FormValue;
		$this->akhir_tahun->CurrentValue = $this->akhir_tahun->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
		$this->id->setDbValue($rs->fields('id'));
		$this->awal_bulan->setDbValue($rs->fields('awal_bulan'));
		$this->awal_tahun->setDbValue($rs->fields('awal_tahun'));
		$this->akhir_bulan->setDbValue($rs->fields('akhir_bulan'));
		$this->akhir_tahun->setDbValue($rs->fields('akhir_tahun'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->awal_bulan->DbValue = $row['awal_bulan'];
		$this->awal_tahun->DbValue = $row['awal_tahun'];
		$this->akhir_bulan->DbValue = $row['akhir_bulan'];
		$this->akhir_tahun->DbValue = $row['akhir_tahun'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// awal_bulan
		// awal_tahun
		// akhir_bulan
		// akhir_tahun

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// awal_bulan
		if (strval($this->awal_bulan->CurrentValue) <> "") {
			$this->awal_bulan->ViewValue = $this->awal_bulan->OptionCaption($this->awal_bulan->CurrentValue);
		} else {
			$this->awal_bulan->ViewValue = NULL;
		}
		$this->awal_bulan->ViewCustomAttributes = "";

		// awal_tahun
		$this->awal_tahun->ViewValue = $this->awal_tahun->CurrentValue;
		$this->awal_tahun->ViewCustomAttributes = "";

		// akhir_bulan
		if (strval($this->akhir_bulan->CurrentValue) <> "") {
			$this->akhir_bulan->ViewValue = $this->akhir_bulan->OptionCaption($this->akhir_bulan->CurrentValue);
		} else {
			$this->akhir_bulan->ViewValue = NULL;
		}
		$this->akhir_bulan->ViewCustomAttributes = "";

		// akhir_tahun
		$this->akhir_tahun->ViewValue = $this->akhir_tahun->CurrentValue;
		$this->akhir_tahun->ViewCustomAttributes = "";

			// awal_bulan
			$this->awal_bulan->LinkCustomAttributes = "";
			$this->awal_bulan->HrefValue = "";
			$this->awal_bulan->TooltipValue = "";

			// awal_tahun
			$this->awal_tahun->LinkCustomAttributes = "";
			$this->awal_tahun->HrefValue = "";
			$this->awal_tahun->TooltipValue = "";

			// akhir_bulan
			$this->akhir_bulan->LinkCustomAttributes = "";
			$this->akhir_bulan->HrefValue = "";
			$this->akhir_bulan->TooltipValue = "";

			// akhir_tahun
			$this->akhir_tahun->LinkCustomAttributes = "";
			$this->akhir_tahun->HrefValue = "";
			$this->akhir_tahun->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// awal_bulan
			$this->awal_bulan->EditAttrs["class"] = "form-control";
			$this->awal_bulan->EditCustomAttributes = "";
			$this->awal_bulan->EditValue = $this->awal_bulan->Options(TRUE);

			// awal_tahun
			$this->awal_tahun->EditAttrs["class"] = "form-control";
			$this->awal_tahun->EditCustomAttributes = "";
			$this->awal_tahun->EditValue = ew_HtmlEncode($this->awal_tahun->CurrentValue);
			$this->awal_tahun->PlaceHolder = ew_RemoveHtml($this->awal_tahun->FldCaption());

			// akhir_bulan
			$this->akhir_bulan->EditAttrs["class"] = "form-control";
			$this->akhir_bulan->EditCustomAttributes = "";
			$this->akhir_bulan->EditValue = $this->akhir_bulan->Options(TRUE);

			// akhir_tahun
			$this->akhir_tahun->EditAttrs["class"] = "form-control";
			$this->akhir_tahun->EditCustomAttributes = "";
			$this->akhir_tahun->EditValue = ew_HtmlEncode($this->akhir_tahun->CurrentValue);
			$this->akhir_tahun->PlaceHolder = ew_RemoveHtml($this->akhir_tahun->FldCaption());

			// Edit refer script
			// awal_bulan

			$this->awal_bulan->LinkCustomAttributes = "";
			$this->awal_bulan->HrefValue = "";

			// awal_tahun
			$this->awal_tahun->LinkCustomAttributes = "";
			$this->awal_tahun->HrefValue = "";

			// akhir_bulan
			$this->akhir_bulan->LinkCustomAttributes = "";
			$this->akhir_bulan->HrefValue = "";

			// akhir_tahun
			$this->akhir_tahun->LinkCustomAttributes = "";
			$this->akhir_tahun->HrefValue = "";
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

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->awal_bulan->FldIsDetailKey && !is_null($this->awal_bulan->FormValue) && $this->awal_bulan->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->awal_bulan->FldCaption(), $this->awal_bulan->ReqErrMsg));
		}
		if (!$this->awal_tahun->FldIsDetailKey && !is_null($this->awal_tahun->FormValue) && $this->awal_tahun->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->awal_tahun->FldCaption(), $this->awal_tahun->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->awal_tahun->FormValue)) {
			ew_AddMessage($gsFormError, $this->awal_tahun->FldErrMsg());
		}
		if (!$this->akhir_bulan->FldIsDetailKey && !is_null($this->akhir_bulan->FormValue) && $this->akhir_bulan->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->akhir_bulan->FldCaption(), $this->akhir_bulan->ReqErrMsg));
		}
		if (!$this->akhir_tahun->FldIsDetailKey && !is_null($this->akhir_tahun->FormValue) && $this->akhir_tahun->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->akhir_tahun->FldCaption(), $this->akhir_tahun->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->akhir_tahun->FormValue)) {
			ew_AddMessage($gsFormError, $this->akhir_tahun->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// awal_bulan
			$this->awal_bulan->SetDbValueDef($rsnew, $this->awal_bulan->CurrentValue, 0, $this->awal_bulan->ReadOnly);

			// awal_tahun
			$this->awal_tahun->SetDbValueDef($rsnew, $this->awal_tahun->CurrentValue, 0, $this->awal_tahun->ReadOnly);

			// akhir_bulan
			$this->akhir_bulan->SetDbValueDef($rsnew, $this->akhir_bulan->CurrentValue, 0, $this->akhir_bulan->ReadOnly);

			// akhir_tahun
			$this->akhir_tahun->SetDbValueDef($rsnew, $this->akhir_tahun->CurrentValue, 0, $this->akhir_tahun->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t00_tahunajaranlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
if (!isset($t00_tahunajaran_edit)) $t00_tahunajaran_edit = new ct00_tahunajaran_edit();

// Page init
$t00_tahunajaran_edit->Page_Init();

// Page main
$t00_tahunajaran_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t00_tahunajaran_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft00_tahunajaranedit = new ew_Form("ft00_tahunajaranedit", "edit");

// Validate form
ft00_tahunajaranedit.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_awal_bulan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t00_tahunajaran->awal_bulan->FldCaption(), $t00_tahunajaran->awal_bulan->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_awal_tahun");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t00_tahunajaran->awal_tahun->FldCaption(), $t00_tahunajaran->awal_tahun->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_awal_tahun");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t00_tahunajaran->awal_tahun->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_akhir_bulan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t00_tahunajaran->akhir_bulan->FldCaption(), $t00_tahunajaran->akhir_bulan->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_akhir_tahun");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t00_tahunajaran->akhir_tahun->FldCaption(), $t00_tahunajaran->akhir_tahun->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_akhir_tahun");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t00_tahunajaran->akhir_tahun->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft00_tahunajaranedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft00_tahunajaranedit.ValidateRequired = true;
<?php } else { ?>
ft00_tahunajaranedit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft00_tahunajaranedit.Lists["x_awal_bulan"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft00_tahunajaranedit.Lists["x_awal_bulan"].Options = <?php echo json_encode($t00_tahunajaran->awal_bulan->Options()) ?>;
ft00_tahunajaranedit.Lists["x_akhir_bulan"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft00_tahunajaranedit.Lists["x_akhir_bulan"].Options = <?php echo json_encode($t00_tahunajaran->akhir_bulan->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t00_tahunajaran_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t00_tahunajaran_edit->ShowPageHeader(); ?>
<?php
$t00_tahunajaran_edit->ShowMessage();
?>
<form name="ft00_tahunajaranedit" id="ft00_tahunajaranedit" class="<?php echo $t00_tahunajaran_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t00_tahunajaran_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t00_tahunajaran_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t00_tahunajaran">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t00_tahunajaran_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t00_tahunajaran->awal_bulan->Visible) { // awal_bulan ?>
	<div id="r_awal_bulan" class="form-group">
		<label id="elh_t00_tahunajaran_awal_bulan" for="x_awal_bulan" class="col-sm-2 control-label ewLabel"><?php echo $t00_tahunajaran->awal_bulan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t00_tahunajaran->awal_bulan->CellAttributes() ?>>
<span id="el_t00_tahunajaran_awal_bulan">
<select data-table="t00_tahunajaran" data-field="x_awal_bulan" data-value-separator="<?php echo $t00_tahunajaran->awal_bulan->DisplayValueSeparatorAttribute() ?>" id="x_awal_bulan" name="x_awal_bulan"<?php echo $t00_tahunajaran->awal_bulan->EditAttributes() ?>>
<?php echo $t00_tahunajaran->awal_bulan->SelectOptionListHtml("x_awal_bulan") ?>
</select>
</span>
<?php echo $t00_tahunajaran->awal_bulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t00_tahunajaran->awal_tahun->Visible) { // awal_tahun ?>
	<div id="r_awal_tahun" class="form-group">
		<label id="elh_t00_tahunajaran_awal_tahun" for="x_awal_tahun" class="col-sm-2 control-label ewLabel"><?php echo $t00_tahunajaran->awal_tahun->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t00_tahunajaran->awal_tahun->CellAttributes() ?>>
<span id="el_t00_tahunajaran_awal_tahun">
<input type="text" data-table="t00_tahunajaran" data-field="x_awal_tahun" name="x_awal_tahun" id="x_awal_tahun" size="30" placeholder="<?php echo ew_HtmlEncode($t00_tahunajaran->awal_tahun->getPlaceHolder()) ?>" value="<?php echo $t00_tahunajaran->awal_tahun->EditValue ?>"<?php echo $t00_tahunajaran->awal_tahun->EditAttributes() ?>>
</span>
<?php echo $t00_tahunajaran->awal_tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t00_tahunajaran->akhir_bulan->Visible) { // akhir_bulan ?>
	<div id="r_akhir_bulan" class="form-group">
		<label id="elh_t00_tahunajaran_akhir_bulan" for="x_akhir_bulan" class="col-sm-2 control-label ewLabel"><?php echo $t00_tahunajaran->akhir_bulan->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t00_tahunajaran->akhir_bulan->CellAttributes() ?>>
<span id="el_t00_tahunajaran_akhir_bulan">
<select data-table="t00_tahunajaran" data-field="x_akhir_bulan" data-value-separator="<?php echo $t00_tahunajaran->akhir_bulan->DisplayValueSeparatorAttribute() ?>" id="x_akhir_bulan" name="x_akhir_bulan"<?php echo $t00_tahunajaran->akhir_bulan->EditAttributes() ?>>
<?php echo $t00_tahunajaran->akhir_bulan->SelectOptionListHtml("x_akhir_bulan") ?>
</select>
</span>
<?php echo $t00_tahunajaran->akhir_bulan->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t00_tahunajaran->akhir_tahun->Visible) { // akhir_tahun ?>
	<div id="r_akhir_tahun" class="form-group">
		<label id="elh_t00_tahunajaran_akhir_tahun" for="x_akhir_tahun" class="col-sm-2 control-label ewLabel"><?php echo $t00_tahunajaran->akhir_tahun->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t00_tahunajaran->akhir_tahun->CellAttributes() ?>>
<span id="el_t00_tahunajaran_akhir_tahun">
<input type="text" data-table="t00_tahunajaran" data-field="x_akhir_tahun" name="x_akhir_tahun" id="x_akhir_tahun" size="30" placeholder="<?php echo ew_HtmlEncode($t00_tahunajaran->akhir_tahun->getPlaceHolder()) ?>" value="<?php echo $t00_tahunajaran->akhir_tahun->EditValue ?>"<?php echo $t00_tahunajaran->akhir_tahun->EditAttributes() ?>>
</span>
<?php echo $t00_tahunajaran->akhir_tahun->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t00_tahunajaran" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t00_tahunajaran->id->CurrentValue) ?>">
<?php if (!$t00_tahunajaran_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t00_tahunajaran_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft00_tahunajaranedit.Init();
</script>
<?php
$t00_tahunajaran_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t00_tahunajaran_edit->Page_Terminate();
?>
