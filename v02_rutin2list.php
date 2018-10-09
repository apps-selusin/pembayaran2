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

$v02_rutin2_list = NULL; // Initialize page object first

class cv02_rutin2_list extends cv02_rutin2 {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = "{8F2DFBC1-53BE-44C3-91F5-73D45F821091}";

	// Table name
	var $TableName = 'v02_rutin2';

	// Page object name
	var $PageObjName = 'v02_rutin2_list';

	// Grid form hidden field names
	var $FormName = 'fv02_rutin2list';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "v02_rutin2add.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "v02_rutin2delete.php";
		$this->MultiUpdateUrl = "v02_rutin2update.php";

		// Table object (t96_employees)
		if (!isset($GLOBALS['t96_employees'])) $GLOBALS['t96_employees'] = new ct96_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption fv02_rutin2listsrch";

		// List actions
		$this->ListActions = new cListActions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// Get export parameters
		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
			$custom = @$_POST["custom"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();
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

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;	
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values

			// Process filter list
			$this->ProcessFilterList();
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load advanced search from default
			if ($this->LoadAdvancedSearchDefault()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			}
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} else {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);
		if ($sFilter == "") {
			$sFilter = "0=101";
			$this->SearchWhere = $sFilter;
		}

		// Set up filter in session
		$this->setSessionWhere($sFilter);
		$this->CurrentFilter = "";

		// Export data only
		if ($this->CustomExport == "" && in_array($this->Export, array("html","word","excel","xml","csv","email","pdf"))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->SelectRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Load server side filters
		if (EW_SEARCH_FILTER_OPTION == "Server") {
			$sSavedFilterList = isset($UserProfile) ? $UserProfile->GetSearchFilters(CurrentUserName(), "fv02_rutin2listsrch") : "";
		} else {
			$sSavedFilterList = "";
		}

		// Initialize
		$sFilterList = "";
		$sFilterList = ew_Concat($sFilterList, $this->tahunajaran_id->AdvancedSearch->ToJSON(), ","); // Field tahunajaran_id
		$sFilterList = ew_Concat($sFilterList, $this->sekolah_id->AdvancedSearch->ToJSON(), ","); // Field sekolah_id
		$sFilterList = ew_Concat($sFilterList, $this->kelas_id->AdvancedSearch->ToJSON(), ","); // Field kelas_id
		$sFilterList = ew_Concat($sFilterList, $this->siswa_id->AdvancedSearch->ToJSON(), ","); // Field siswa_id
		$sFilterList = ew_Concat($sFilterList, $this->rutin_id->AdvancedSearch->ToJSON(), ","); // Field rutin_id
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJSON(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->siswarutin_id->AdvancedSearch->ToJSON(), ","); // Field siswarutin_id
		$sFilterList = ew_Concat($sFilterList, $this->Bulan->AdvancedSearch->ToJSON(), ","); // Field Bulan
		$sFilterList = ew_Concat($sFilterList, $this->Tahun->AdvancedSearch->ToJSON(), ","); // Field Tahun
		$sFilterList = ew_Concat($sFilterList, $this->Bayar_Tgl->AdvancedSearch->ToJSON(), ","); // Field Bayar_Tgl
		$sFilterList = ew_Concat($sFilterList, $this->Bayar_Jumlah->AdvancedSearch->ToJSON(), ","); // Field Bayar_Jumlah
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = ew_StripSlashes(@$_POST["filters"]);
			$UserProfile->SetSearchFilters(CurrentUserName(), "fv02_rutin2listsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(ew_StripSlashes(@$_POST["filter"]), TRUE);
		$this->Command = "search";

		// Field tahunajaran_id
		$this->tahunajaran_id->AdvancedSearch->SearchValue = @$filter["x_tahunajaran_id"];
		$this->tahunajaran_id->AdvancedSearch->SearchOperator = @$filter["z_tahunajaran_id"];
		$this->tahunajaran_id->AdvancedSearch->SearchCondition = @$filter["v_tahunajaran_id"];
		$this->tahunajaran_id->AdvancedSearch->SearchValue2 = @$filter["y_tahunajaran_id"];
		$this->tahunajaran_id->AdvancedSearch->SearchOperator2 = @$filter["w_tahunajaran_id"];
		$this->tahunajaran_id->AdvancedSearch->Save();

		// Field sekolah_id
		$this->sekolah_id->AdvancedSearch->SearchValue = @$filter["x_sekolah_id"];
		$this->sekolah_id->AdvancedSearch->SearchOperator = @$filter["z_sekolah_id"];
		$this->sekolah_id->AdvancedSearch->SearchCondition = @$filter["v_sekolah_id"];
		$this->sekolah_id->AdvancedSearch->SearchValue2 = @$filter["y_sekolah_id"];
		$this->sekolah_id->AdvancedSearch->SearchOperator2 = @$filter["w_sekolah_id"];
		$this->sekolah_id->AdvancedSearch->Save();

		// Field kelas_id
		$this->kelas_id->AdvancedSearch->SearchValue = @$filter["x_kelas_id"];
		$this->kelas_id->AdvancedSearch->SearchOperator = @$filter["z_kelas_id"];
		$this->kelas_id->AdvancedSearch->SearchCondition = @$filter["v_kelas_id"];
		$this->kelas_id->AdvancedSearch->SearchValue2 = @$filter["y_kelas_id"];
		$this->kelas_id->AdvancedSearch->SearchOperator2 = @$filter["w_kelas_id"];
		$this->kelas_id->AdvancedSearch->Save();

		// Field siswa_id
		$this->siswa_id->AdvancedSearch->SearchValue = @$filter["x_siswa_id"];
		$this->siswa_id->AdvancedSearch->SearchOperator = @$filter["z_siswa_id"];
		$this->siswa_id->AdvancedSearch->SearchCondition = @$filter["v_siswa_id"];
		$this->siswa_id->AdvancedSearch->SearchValue2 = @$filter["y_siswa_id"];
		$this->siswa_id->AdvancedSearch->SearchOperator2 = @$filter["w_siswa_id"];
		$this->siswa_id->AdvancedSearch->Save();

		// Field rutin_id
		$this->rutin_id->AdvancedSearch->SearchValue = @$filter["x_rutin_id"];
		$this->rutin_id->AdvancedSearch->SearchOperator = @$filter["z_rutin_id"];
		$this->rutin_id->AdvancedSearch->SearchCondition = @$filter["v_rutin_id"];
		$this->rutin_id->AdvancedSearch->SearchValue2 = @$filter["y_rutin_id"];
		$this->rutin_id->AdvancedSearch->SearchOperator2 = @$filter["w_rutin_id"];
		$this->rutin_id->AdvancedSearch->Save();

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->Save();

		// Field siswarutin_id
		$this->siswarutin_id->AdvancedSearch->SearchValue = @$filter["x_siswarutin_id"];
		$this->siswarutin_id->AdvancedSearch->SearchOperator = @$filter["z_siswarutin_id"];
		$this->siswarutin_id->AdvancedSearch->SearchCondition = @$filter["v_siswarutin_id"];
		$this->siswarutin_id->AdvancedSearch->SearchValue2 = @$filter["y_siswarutin_id"];
		$this->siswarutin_id->AdvancedSearch->SearchOperator2 = @$filter["w_siswarutin_id"];
		$this->siswarutin_id->AdvancedSearch->Save();

		// Field Bulan
		$this->Bulan->AdvancedSearch->SearchValue = @$filter["x_Bulan"];
		$this->Bulan->AdvancedSearch->SearchOperator = @$filter["z_Bulan"];
		$this->Bulan->AdvancedSearch->SearchCondition = @$filter["v_Bulan"];
		$this->Bulan->AdvancedSearch->SearchValue2 = @$filter["y_Bulan"];
		$this->Bulan->AdvancedSearch->SearchOperator2 = @$filter["w_Bulan"];
		$this->Bulan->AdvancedSearch->Save();

		// Field Tahun
		$this->Tahun->AdvancedSearch->SearchValue = @$filter["x_Tahun"];
		$this->Tahun->AdvancedSearch->SearchOperator = @$filter["z_Tahun"];
		$this->Tahun->AdvancedSearch->SearchCondition = @$filter["v_Tahun"];
		$this->Tahun->AdvancedSearch->SearchValue2 = @$filter["y_Tahun"];
		$this->Tahun->AdvancedSearch->SearchOperator2 = @$filter["w_Tahun"];
		$this->Tahun->AdvancedSearch->Save();

		// Field Bayar_Tgl
		$this->Bayar_Tgl->AdvancedSearch->SearchValue = @$filter["x_Bayar_Tgl"];
		$this->Bayar_Tgl->AdvancedSearch->SearchOperator = @$filter["z_Bayar_Tgl"];
		$this->Bayar_Tgl->AdvancedSearch->SearchCondition = @$filter["v_Bayar_Tgl"];
		$this->Bayar_Tgl->AdvancedSearch->SearchValue2 = @$filter["y_Bayar_Tgl"];
		$this->Bayar_Tgl->AdvancedSearch->SearchOperator2 = @$filter["w_Bayar_Tgl"];
		$this->Bayar_Tgl->AdvancedSearch->Save();

		// Field Bayar_Jumlah
		$this->Bayar_Jumlah->AdvancedSearch->SearchValue = @$filter["x_Bayar_Jumlah"];
		$this->Bayar_Jumlah->AdvancedSearch->SearchOperator = @$filter["z_Bayar_Jumlah"];
		$this->Bayar_Jumlah->AdvancedSearch->SearchCondition = @$filter["v_Bayar_Jumlah"];
		$this->Bayar_Jumlah->AdvancedSearch->SearchValue2 = @$filter["y_Bayar_Jumlah"];
		$this->Bayar_Jumlah->AdvancedSearch->SearchOperator2 = @$filter["w_Bayar_Jumlah"];
		$this->Bayar_Jumlah->AdvancedSearch->Save();
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->tahunajaran_id, $Default, FALSE); // tahunajaran_id
		$this->BuildSearchSql($sWhere, $this->sekolah_id, $Default, FALSE); // sekolah_id
		$this->BuildSearchSql($sWhere, $this->kelas_id, $Default, FALSE); // kelas_id
		$this->BuildSearchSql($sWhere, $this->siswa_id, $Default, FALSE); // siswa_id
		$this->BuildSearchSql($sWhere, $this->rutin_id, $Default, FALSE); // rutin_id
		$this->BuildSearchSql($sWhere, $this->id, $Default, FALSE); // id
		$this->BuildSearchSql($sWhere, $this->siswarutin_id, $Default, FALSE); // siswarutin_id
		$this->BuildSearchSql($sWhere, $this->Bulan, $Default, FALSE); // Bulan
		$this->BuildSearchSql($sWhere, $this->Tahun, $Default, FALSE); // Tahun
		$this->BuildSearchSql($sWhere, $this->Bayar_Tgl, $Default, FALSE); // Bayar_Tgl
		$this->BuildSearchSql($sWhere, $this->Bayar_Jumlah, $Default, FALSE); // Bayar_Jumlah

		// Set up search parm
		if (!$Default && $sWhere <> "") {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->tahunajaran_id->AdvancedSearch->Save(); // tahunajaran_id
			$this->sekolah_id->AdvancedSearch->Save(); // sekolah_id
			$this->kelas_id->AdvancedSearch->Save(); // kelas_id
			$this->siswa_id->AdvancedSearch->Save(); // siswa_id
			$this->rutin_id->AdvancedSearch->Save(); // rutin_id
			$this->id->AdvancedSearch->Save(); // id
			$this->siswarutin_id->AdvancedSearch->Save(); // siswarutin_id
			$this->Bulan->AdvancedSearch->Save(); // Bulan
			$this->Tahun->AdvancedSearch->Save(); // Tahun
			$this->Bayar_Tgl->AdvancedSearch->Save(); // Bayar_Tgl
			$this->Bayar_Jumlah->AdvancedSearch->Save(); // Bayar_Jumlah
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $Default, $MultiValue) {
		$FldParm = substr($Fld->FldVar, 2);
		$FldVal = ($Default) ? $Fld->AdvancedSearch->SearchValueDefault : $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = ($Default) ? $Fld->AdvancedSearch->SearchOperatorDefault : $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = ($Default) ? $Fld->AdvancedSearch->SearchConditionDefault : $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = ($Default) ? $Fld->AdvancedSearch->SearchValue2Default : $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = ($Default) ? $Fld->AdvancedSearch->SearchOperator2Default : $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";

		//$FldVal = ew_StripSlashes($FldVal);
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);

		//$FldVal2 = ew_StripSlashes($FldVal2);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1)
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr, $FldVal, $this->DBID) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr2, $FldVal2, $this->DBID) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2, $this->DBID);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		if ($FldVal == EW_NULL_VALUE || $FldVal == EW_NOT_NULL_VALUE)
			return $FldVal;
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE || $Fld->FldDataType == EW_DATATYPE_TIME) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Check if search parm exists
	function CheckSearchParms() {
		if ($this->tahunajaran_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->sekolah_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->kelas_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->siswa_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->rutin_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->siswarutin_id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Bulan->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Tahun->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Bayar_Tgl->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->Bayar_Jumlah->AdvancedSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->tahunajaran_id->AdvancedSearch->UnsetSession();
		$this->sekolah_id->AdvancedSearch->UnsetSession();
		$this->kelas_id->AdvancedSearch->UnsetSession();
		$this->siswa_id->AdvancedSearch->UnsetSession();
		$this->rutin_id->AdvancedSearch->UnsetSession();
		$this->id->AdvancedSearch->UnsetSession();
		$this->siswarutin_id->AdvancedSearch->UnsetSession();
		$this->Bulan->AdvancedSearch->UnsetSession();
		$this->Tahun->AdvancedSearch->UnsetSession();
		$this->Bayar_Tgl->AdvancedSearch->UnsetSession();
		$this->Bayar_Jumlah->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
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

	// Set up sort parameters
	function SetUpSortOrder() {

		// Check for Ctrl pressed
		$bCtrl = (@$_GET["ctrl"] <> "");

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->tahunajaran_id, $bCtrl); // tahunajaran_id
			$this->UpdateSort($this->sekolah_id, $bCtrl); // sekolah_id
			$this->UpdateSort($this->kelas_id, $bCtrl); // kelas_id
			$this->UpdateSort($this->siswa_id, $bCtrl); // siswa_id
			$this->UpdateSort($this->rutin_id, $bCtrl); // rutin_id
			$this->UpdateSort($this->id, $bCtrl); // id
			$this->UpdateSort($this->siswarutin_id, $bCtrl); // siswarutin_id
			$this->UpdateSort($this->Bulan, $bCtrl); // Bulan
			$this->UpdateSort($this->Tahun, $bCtrl); // Tahun
			$this->UpdateSort($this->Bayar_Tgl, $bCtrl); // Bayar_Tgl
			$this->UpdateSort($this->Bayar_Jumlah, $bCtrl); // Bayar_Jumlah
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->tahunajaran_id->setSort("");
				$this->sekolah_id->setSort("");
				$this->kelas_id->setSort("");
				$this->siswa_id->setSort("");
				$this->rutin_id->setSort("");
				$this->id->setSort("");
				$this->siswarutin_id->setSort("");
				$this->Bulan->setSort("");
				$this->Tahun->setSort("");
				$this->Bayar_Tgl->setSort("");
				$this->Bayar_Jumlah->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssStyle = "white-space: nowrap;";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->MoveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// "sequence"
		$item = &$this->ListOptions->Add("sequence");
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = TRUE;
		$item->OnLeft = TRUE; // Always on left
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// "sequence"
		$oListOpt = &$this->ListOptions->Items["sequence"];
		$oListOpt->Body = ew_FormatSeqNo($this->RecCnt);

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\" onclick='ew_ClickMultiCheckbox(event);'>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fv02_rutin2listsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fv02_rutin2listsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fv02_rutin2list}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fv02_rutin2listsrch\">" . $Language->Phrase("SearchBtn") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ResetSearch") . "\" data-caption=\"" . $Language->Phrase("ResetSearch") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ResetSearchBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Advanced search button
		$item = &$this->SearchOptions->Add("advancedsearch");
		$item->Body = "<a class=\"btn btn-default ewAdvancedSearch\" title=\"" . $Language->Phrase("AdvancedSearch") . "\" data-caption=\"" . $Language->Phrase("AdvancedSearch") . "\" href=\"v02_rutin2srch.php\">" . $Language->Phrase("AdvancedSearchBtn") . "</a>";
		$item->Visible = TRUE;

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// tahunajaran_id

		$this->tahunajaran_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_tahunajaran_id"]);
		if ($this->tahunajaran_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->tahunajaran_id->AdvancedSearch->SearchOperator = @$_GET["z_tahunajaran_id"];

		// sekolah_id
		$this->sekolah_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_sekolah_id"]);
		if ($this->sekolah_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->sekolah_id->AdvancedSearch->SearchOperator = @$_GET["z_sekolah_id"];

		// kelas_id
		$this->kelas_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_kelas_id"]);
		if ($this->kelas_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->kelas_id->AdvancedSearch->SearchOperator = @$_GET["z_kelas_id"];

		// siswa_id
		$this->siswa_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_siswa_id"]);
		if ($this->siswa_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->siswa_id->AdvancedSearch->SearchOperator = @$_GET["z_siswa_id"];

		// rutin_id
		$this->rutin_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_rutin_id"]);
		if ($this->rutin_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->rutin_id->AdvancedSearch->SearchOperator = @$_GET["z_rutin_id"];

		// id
		$this->id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_id"]);
		if ($this->id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// siswarutin_id
		$this->siswarutin_id->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_siswarutin_id"]);
		if ($this->siswarutin_id->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->siswarutin_id->AdvancedSearch->SearchOperator = @$_GET["z_siswarutin_id"];

		// Bulan
		$this->Bulan->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Bulan"]);
		if ($this->Bulan->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Bulan->AdvancedSearch->SearchOperator = @$_GET["z_Bulan"];

		// Tahun
		$this->Tahun->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Tahun"]);
		if ($this->Tahun->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Tahun->AdvancedSearch->SearchOperator = @$_GET["z_Tahun"];

		// Bayar_Tgl
		$this->Bayar_Tgl->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Bayar_Tgl"]);
		if ($this->Bayar_Tgl->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Bayar_Tgl->AdvancedSearch->SearchOperator = @$_GET["z_Bayar_Tgl"];

		// Bayar_Jumlah
		$this->Bayar_Jumlah->AdvancedSearch->SearchValue = ew_StripSlashes(@$_GET["x_Bayar_Jumlah"]);
		if ($this->Bayar_Jumlah->AdvancedSearch->SearchValue <> "") $this->Command = "search";
		$this->Bayar_Jumlah->AdvancedSearch->SearchOperator = @$_GET["z_Bayar_Jumlah"];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->tahunajaran_id->setDbValue($rs->fields('tahunajaran_id'));
		$this->sekolah_id->setDbValue($rs->fields('sekolah_id'));
		$this->kelas_id->setDbValue($rs->fields('kelas_id'));
		$this->siswa_id->setDbValue($rs->fields('siswa_id'));
		$this->rutin_id->setDbValue($rs->fields('rutin_id'));
		$this->id->setDbValue($rs->fields('id'));
		$this->siswarutin_id->setDbValue($rs->fields('siswarutin_id'));
		$this->Bulan->setDbValue($rs->fields('Bulan'));
		$this->Tahun->setDbValue($rs->fields('Tahun'));
		$this->Bayar_Tgl->setDbValue($rs->fields('Bayar_Tgl'));
		$this->Bayar_Jumlah->setDbValue($rs->fields('Bayar_Jumlah'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->tahunajaran_id->DbValue = $row['tahunajaran_id'];
		$this->sekolah_id->DbValue = $row['sekolah_id'];
		$this->kelas_id->DbValue = $row['kelas_id'];
		$this->siswa_id->DbValue = $row['siswa_id'];
		$this->rutin_id->DbValue = $row['rutin_id'];
		$this->id->DbValue = $row['id'];
		$this->siswarutin_id->DbValue = $row['siswarutin_id'];
		$this->Bulan->DbValue = $row['Bulan'];
		$this->Tahun->DbValue = $row['Tahun'];
		$this->Bayar_Tgl->DbValue = $row['Bayar_Tgl'];
		$this->Bayar_Jumlah->DbValue = $row['Bayar_Jumlah'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

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

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = TRUE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = TRUE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = TRUE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_v02_rutin2\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_v02_rutin2',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fv02_rutin2list,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && ew_IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->SelectRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->LoadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetUpStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "h");
		$Doc = &$this->ExportDoc;
		if ($bSelectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {

			//$this->StartRec = $this->StartRec;
			//$this->StopRec = $this->StopRec;

		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$ParentTable = "";
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$Doc->Text .= $sHeader;
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$Doc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$Doc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED && $this->Export <> "pdf")
			echo ew_DebugMsg();

		// Output data
		if ($this->Export == "email") {
			echo $this->ExportEmail($Doc->Text);
		} else {
			$Doc->Export();
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $gTmpImages, $Language;
		$sSender = @$_POST["sender"];
		$sRecipient = @$_POST["recipient"];
		$sCc = @$_POST["cc"];
		$sBcc = @$_POST["bcc"];
		$sContentType = @$_POST["contenttype"];

		// Subject
		$sSubject = ew_StripSlashes(@$_POST["subject"]);
		$sEmailSubject = $sSubject;

		// Message
		$sContent = ew_StripSlashes(@$_POST["message"]);
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterSenderEmail") . "</p>";
		}
		if (!ew_CheckEmail($sSender)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!ew_CheckEmailList($sRecipient, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!ew_CheckEmailList($sCc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!ew_CheckEmailList($sBcc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EW_EXPORT_EMAIL_COUNTER]))
			$_SESSION[EW_EXPORT_EMAIL_COUNTER] = 0;
		if (intval($_SESSION[EW_EXPORT_EMAIL_COUNTER]) > EW_MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-danger\">" . $Language->Phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$Email = new cEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Format = ($sContentType == "url") ? "text" : "html";
		if ($sEmailMessage <> "") {
			$sEmailMessage = ew_RemoveXSS($sEmailMessage);
			$sEmailMessage .= ($sContentType == "url") ? "\r\n\r\n" : "<br><br>";
		}
		if ($sContentType == "url") {
			$sUrl = ew_ConvertFullUrl(ew_CurrentPage() . "?" . $this->ExportQueryString());
			$sEmailMessage .= $sUrl; // Send URL only
		} else {
			foreach ($gTmpImages as $tmpimage)
				$Email->AddEmbeddedImage($tmpimage);
			$sEmailMessage .= ew_CleanEmailContent($EmailContent); // Send HTML
		}
		$Email->Content = $sEmailMessage; // Content
		$EventArgs = array();
		if ($this->Recordset) {
			$this->RecCnt = $this->StartRec - 1;
			$this->Recordset->MoveFirst();
			if ($this->StartRec > 1)
				$this->Recordset->Move($this->StartRec - 1);
			$EventArgs["rs"] = &$this->Recordset;
		}
		$bEmailSent = FALSE;
		if ($this->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count
			$_SESSION[EW_EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->Phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-danger\">" . $Email->SendErrDescription . "</p>";
		}
	}

	// Export QueryString
	function ExportQueryString() {

		// Initialize
		$sQry = "export=html";

		// Build QueryString for search
		$this->AddSearchQueryString($sQry, $this->tahunajaran_id); // tahunajaran_id
		$this->AddSearchQueryString($sQry, $this->sekolah_id); // sekolah_id
		$this->AddSearchQueryString($sQry, $this->kelas_id); // kelas_id
		$this->AddSearchQueryString($sQry, $this->siswa_id); // siswa_id
		$this->AddSearchQueryString($sQry, $this->rutin_id); // rutin_id
		$this->AddSearchQueryString($sQry, $this->id); // id
		$this->AddSearchQueryString($sQry, $this->siswarutin_id); // siswarutin_id
		$this->AddSearchQueryString($sQry, $this->Bulan); // Bulan
		$this->AddSearchQueryString($sQry, $this->Tahun); // Tahun
		$this->AddSearchQueryString($sQry, $this->Bayar_Tgl); // Bayar_Tgl
		$this->AddSearchQueryString($sQry, $this->Bayar_Jumlah); // Bayar_Jumlah

		// Build QueryString for pager
		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . urlencode($this->getRecordsPerPage()) . "&" . EW_TABLE_START_REC . "=" . urlencode($this->getStartRecordNumber());
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		$FldSearchValue = $Fld->AdvancedSearch->getValue("x");
		$FldParm = substr($Fld->FldVar,2);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . urlencode($FldSearchValue) .
				"&z_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("z"));
		}
		$FldSearchValue2 = $Fld->AdvancedSearch->getValue("y");
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("v")) .
				"&y_" . $FldParm . "=" . urlencode($FldSearchValue2) .
				"&w_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("w"));
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
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
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
			}
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($v02_rutin2_list)) $v02_rutin2_list = new cv02_rutin2_list();

// Page init
$v02_rutin2_list->Page_Init();

// Page main
$v02_rutin2_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$v02_rutin2_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($v02_rutin2->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fv02_rutin2list = new ew_Form("fv02_rutin2list", "list");
fv02_rutin2list.FormKeyCountName = '<?php echo $v02_rutin2_list->FormKeyCountName ?>';

// Form_CustomValidate event
fv02_rutin2list.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fv02_rutin2list.ValidateRequired = true;
<?php } else { ?>
fv02_rutin2list.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
fv02_rutin2list.Lists["x_tahunajaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tahun_pelajaran","","",""],"ParentFields":[],"ChildFields":["x_siswa_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v00_tahunajaran"};
fv02_rutin2list.Lists["x_sekolah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor_Induk","x_Nama","",""],"ParentFields":[],"ChildFields":["x_kelas_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_sekolah"};
fv02_rutin2list.Lists["x_kelas_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":["x_siswa_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t02_kelas"};
fv02_rutin2list.Lists["x_siswa_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor_Induk","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t03_siswa"};
fv02_rutin2list.Lists["x_rutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t04_rutin"};

// Form object for search
var CurrentSearchForm = fv02_rutin2listsrch = new ew_Form("fv02_rutin2listsrch");

// Validate function for search
fv02_rutin2listsrch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fv02_rutin2listsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
fv02_rutin2listsrch.ValidateRequired = true; // Use JavaScript validation
<?php } else { ?>
fv02_rutin2listsrch.ValidateRequired = false; // No JavaScript validation
<?php } ?>

// Dynamic selection lists
fv02_rutin2listsrch.Lists["x_tahunajaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tahun_pelajaran","","",""],"ParentFields":[],"ChildFields":["x_siswa_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"v00_tahunajaran"};
fv02_rutin2listsrch.Lists["x_sekolah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor_Induk","x_Nama","",""],"ParentFields":[],"ChildFields":["x_kelas_id"],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_sekolah"};
fv02_rutin2listsrch.Lists["x_kelas_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":["x_sekolah_id"],"ChildFields":["x_siswa_id"],"FilterFields":["x_sekolah_id"],"Options":[],"Template":"","LinkTable":"t02_kelas"};
fv02_rutin2listsrch.Lists["x_siswa_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor_Induk","x_Nama","",""],"ParentFields":["x_tahunajaran_id","x_kelas_id"],"ChildFields":[],"FilterFields":["x_tahunajaran_id","x_kelas_id"],"Options":[],"Template":"","LinkTable":"t03_siswa"};
fv02_rutin2listsrch.Lists["x_rutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t04_rutin"};
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($v02_rutin2->Export == "") { ?>
<div class="ewToolbar">
<?php if ($v02_rutin2->Export == "") { ?>
<?php $Breadcrumb->Render(); ?>
<?php } ?>
<?php if ($v02_rutin2_list->TotalRecs > 0 && $v02_rutin2_list->ExportOptions->Visible()) { ?>
<?php $v02_rutin2_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($v02_rutin2_list->SearchOptions->Visible()) { ?>
<?php $v02_rutin2_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($v02_rutin2_list->FilterOptions->Visible()) { ?>
<?php $v02_rutin2_list->FilterOptions->Render("body") ?>
<?php } ?>
<?php if ($v02_rutin2->Export == "") { ?>
<?php echo $Language->SelectionForm(); ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $v02_rutin2_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($v02_rutin2_list->TotalRecs <= 0)
			$v02_rutin2_list->TotalRecs = $v02_rutin2->SelectRecordCount();
	} else {
		if (!$v02_rutin2_list->Recordset && ($v02_rutin2_list->Recordset = $v02_rutin2_list->LoadRecordset()))
			$v02_rutin2_list->TotalRecs = $v02_rutin2_list->Recordset->RecordCount();
	}
	$v02_rutin2_list->StartRec = 1;
	if ($v02_rutin2_list->DisplayRecs <= 0 || ($v02_rutin2->Export <> "" && $v02_rutin2->ExportAll)) // Display all records
		$v02_rutin2_list->DisplayRecs = $v02_rutin2_list->TotalRecs;
	if (!($v02_rutin2->Export <> "" && $v02_rutin2->ExportAll))
		$v02_rutin2_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$v02_rutin2_list->Recordset = $v02_rutin2_list->LoadRecordset($v02_rutin2_list->StartRec-1, $v02_rutin2_list->DisplayRecs);

	// Set no record found message
	if ($v02_rutin2->CurrentAction == "" && $v02_rutin2_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$v02_rutin2_list->setWarningMessage(ew_DeniedMsg());
		if ($v02_rutin2_list->SearchWhere == "0=101")
			$v02_rutin2_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$v02_rutin2_list->setWarningMessage($Language->Phrase("NoRecord"));
	}

	// Audit trail on search
	if ($v02_rutin2_list->AuditTrailOnSearch && $v02_rutin2_list->Command == "search" && !$v02_rutin2_list->RestoreSearch) {
		$searchparm = ew_ServerVar("QUERY_STRING");
		$searchsql = $v02_rutin2_list->getSessionWhere();
		$v02_rutin2_list->WriteAuditTrailOnSearch($searchparm, $searchsql);
	}
$v02_rutin2_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($v02_rutin2->Export == "" && $v02_rutin2->CurrentAction == "") { ?>
<form name="fv02_rutin2listsrch" id="fv02_rutin2listsrch" class="form-inline ewForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($v02_rutin2_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fv02_rutin2listsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="v02_rutin2">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$v02_rutin2_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$v02_rutin2->RowType = EW_ROWTYPE_SEARCH;

// Render row
$v02_rutin2->ResetAttrs();
$v02_rutin2_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($v02_rutin2->tahunajaran_id->Visible) { // tahunajaran_id ?>
	<div id="xsc_tahunajaran_id" class="ewCell form-group">
		<label for="x_tahunajaran_id" class="ewSearchCaption ewLabel"><?php echo $v02_rutin2->tahunajaran_id->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_tahunajaran_id" id="z_tahunajaran_id" value="="></span>
		<span class="ewSearchField">
<?php $v02_rutin2->tahunajaran_id->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$v02_rutin2->tahunajaran_id->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tahunajaran_id"><?php echo (strval($v02_rutin2->tahunajaran_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $v02_rutin2->tahunajaran_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($v02_rutin2->tahunajaran_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tahunajaran_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="v02_rutin2" data-field="x_tahunajaran_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v02_rutin2->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" name="x_tahunajaran_id" id="x_tahunajaran_id" value="<?php echo $v02_rutin2->tahunajaran_id->AdvancedSearch->SearchValue ?>"<?php echo $v02_rutin2->tahunajaran_id->EditAttributes() ?>>
<input type="hidden" name="s_x_tahunajaran_id" id="s_x_tahunajaran_id" value="<?php echo $v02_rutin2->tahunajaran_id->LookupFilterQuery(false, "extbs") ?>">
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
<?php if ($v02_rutin2->sekolah_id->Visible) { // sekolah_id ?>
	<div id="xsc_sekolah_id" class="ewCell form-group">
		<label for="x_sekolah_id" class="ewSearchCaption ewLabel"><?php echo $v02_rutin2->sekolah_id->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_sekolah_id" id="z_sekolah_id" value="="></span>
		<span class="ewSearchField">
<?php $v02_rutin2->sekolah_id->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$v02_rutin2->sekolah_id->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_sekolah_id"><?php echo (strval($v02_rutin2->sekolah_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $v02_rutin2->sekolah_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($v02_rutin2->sekolah_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_sekolah_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="v02_rutin2" data-field="x_sekolah_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v02_rutin2->sekolah_id->DisplayValueSeparatorAttribute() ?>" name="x_sekolah_id" id="x_sekolah_id" value="<?php echo $v02_rutin2->sekolah_id->AdvancedSearch->SearchValue ?>"<?php echo $v02_rutin2->sekolah_id->EditAttributes() ?>>
<input type="hidden" name="s_x_sekolah_id" id="s_x_sekolah_id" value="<?php echo $v02_rutin2->sekolah_id->LookupFilterQuery(false, "extbs") ?>">
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ewRow">
<?php if ($v02_rutin2->kelas_id->Visible) { // kelas_id ?>
	<div id="xsc_kelas_id" class="ewCell form-group">
		<label for="x_kelas_id" class="ewSearchCaption ewLabel"><?php echo $v02_rutin2->kelas_id->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_kelas_id" id="z_kelas_id" value="="></span>
		<span class="ewSearchField">
<?php $v02_rutin2->kelas_id->EditAttrs["onchange"] = "ew_UpdateOpt.call(this); " . @$v02_rutin2->kelas_id->EditAttrs["onchange"]; ?>
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_kelas_id"><?php echo (strval($v02_rutin2->kelas_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $v02_rutin2->kelas_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($v02_rutin2->kelas_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_kelas_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="v02_rutin2" data-field="x_kelas_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v02_rutin2->kelas_id->DisplayValueSeparatorAttribute() ?>" name="x_kelas_id" id="x_kelas_id" value="<?php echo $v02_rutin2->kelas_id->AdvancedSearch->SearchValue ?>"<?php echo $v02_rutin2->kelas_id->EditAttributes() ?>>
<input type="hidden" name="s_x_kelas_id" id="s_x_kelas_id" value="<?php echo $v02_rutin2->kelas_id->LookupFilterQuery(false, "extbs") ?>">
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ewRow">
<?php if ($v02_rutin2->siswa_id->Visible) { // siswa_id ?>
	<div id="xsc_siswa_id" class="ewCell form-group">
		<label for="x_siswa_id" class="ewSearchCaption ewLabel"><?php echo $v02_rutin2->siswa_id->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_siswa_id" id="z_siswa_id" value="="></span>
		<span class="ewSearchField">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_siswa_id"><?php echo (strval($v02_rutin2->siswa_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $v02_rutin2->siswa_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($v02_rutin2->siswa_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_siswa_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="v02_rutin2" data-field="x_siswa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v02_rutin2->siswa_id->DisplayValueSeparatorAttribute() ?>" name="x_siswa_id" id="x_siswa_id" value="<?php echo $v02_rutin2->siswa_id->AdvancedSearch->SearchValue ?>"<?php echo $v02_rutin2->siswa_id->EditAttributes() ?>>
<input type="hidden" name="s_x_siswa_id" id="s_x_siswa_id" value="<?php echo $v02_rutin2->siswa_id->LookupFilterQuery(false, "extbs") ?>">
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_5" class="ewRow">
<?php if ($v02_rutin2->rutin_id->Visible) { // rutin_id ?>
	<div id="xsc_rutin_id" class="ewCell form-group">
		<label for="x_rutin_id" class="ewSearchCaption ewLabel"><?php echo $v02_rutin2->rutin_id->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_rutin_id" id="z_rutin_id" value="="></span>
		<span class="ewSearchField">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_rutin_id"><?php echo (strval($v02_rutin2->rutin_id->AdvancedSearch->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $v02_rutin2->rutin_id->AdvancedSearch->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($v02_rutin2->rutin_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_rutin_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="v02_rutin2" data-field="x_rutin_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $v02_rutin2->rutin_id->DisplayValueSeparatorAttribute() ?>" name="x_rutin_id" id="x_rutin_id" value="<?php echo $v02_rutin2->rutin_id->AdvancedSearch->SearchValue ?>"<?php echo $v02_rutin2->rutin_id->EditAttributes() ?>>
<input type="hidden" name="s_x_rutin_id" id="s_x_rutin_id" value="<?php echo $v02_rutin2->rutin_id->LookupFilterQuery(false, "extbs") ?>">
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_6" class="ewRow">
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("QuickSearchBtn") ?></button>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $v02_rutin2_list->ShowPageHeader(); ?>
<?php
$v02_rutin2_list->ShowMessage();
?>
<?php if ($v02_rutin2_list->TotalRecs > 0 || $v02_rutin2->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid v02_rutin2">
<?php if ($v02_rutin2->Export == "") { ?>
<div class="panel-heading ewGridUpperPanel">
<?php if ($v02_rutin2->CurrentAction <> "gridadd" && $v02_rutin2->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="form-inline ewForm ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($v02_rutin2_list->Pager)) $v02_rutin2_list->Pager = new cPrevNextPager($v02_rutin2_list->StartRec, $v02_rutin2_list->DisplayRecs, $v02_rutin2_list->TotalRecs) ?>
<?php if ($v02_rutin2_list->Pager->RecordCount > 0 && $v02_rutin2_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($v02_rutin2_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $v02_rutin2_list->PageUrl() ?>start=<?php echo $v02_rutin2_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($v02_rutin2_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $v02_rutin2_list->PageUrl() ?>start=<?php echo $v02_rutin2_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $v02_rutin2_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($v02_rutin2_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $v02_rutin2_list->PageUrl() ?>start=<?php echo $v02_rutin2_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($v02_rutin2_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $v02_rutin2_list->PageUrl() ?>start=<?php echo $v02_rutin2_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $v02_rutin2_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $v02_rutin2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $v02_rutin2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $v02_rutin2_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($v02_rutin2_list->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
<form name="fv02_rutin2list" id="fv02_rutin2list" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($v02_rutin2_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $v02_rutin2_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="v02_rutin2">
<div id="gmp_v02_rutin2" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<?php if ($v02_rutin2_list->TotalRecs > 0 || $v02_rutin2->CurrentAction == "gridedit") { ?>
<table id="tbl_v02_rutin2list" class="table ewTable">
<?php echo $v02_rutin2->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$v02_rutin2_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$v02_rutin2_list->RenderListOptions();

// Render list options (header, left)
$v02_rutin2_list->ListOptions->Render("header", "left");
?>
<?php if ($v02_rutin2->tahunajaran_id->Visible) { // tahunajaran_id ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->tahunajaran_id) == "") { ?>
		<th data-name="tahunajaran_id"><div id="elh_v02_rutin2_tahunajaran_id" class="v02_rutin2_tahunajaran_id"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->tahunajaran_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahunajaran_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->tahunajaran_id) ?>',2);"><div id="elh_v02_rutin2_tahunajaran_id" class="v02_rutin2_tahunajaran_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->tahunajaran_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->tahunajaran_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->tahunajaran_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v02_rutin2->sekolah_id->Visible) { // sekolah_id ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->sekolah_id) == "") { ?>
		<th data-name="sekolah_id"><div id="elh_v02_rutin2_sekolah_id" class="v02_rutin2_sekolah_id"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->sekolah_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekolah_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->sekolah_id) ?>',2);"><div id="elh_v02_rutin2_sekolah_id" class="v02_rutin2_sekolah_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->sekolah_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->sekolah_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->sekolah_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v02_rutin2->kelas_id->Visible) { // kelas_id ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->kelas_id) == "") { ?>
		<th data-name="kelas_id"><div id="elh_v02_rutin2_kelas_id" class="v02_rutin2_kelas_id"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->kelas_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="kelas_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->kelas_id) ?>',2);"><div id="elh_v02_rutin2_kelas_id" class="v02_rutin2_kelas_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->kelas_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->kelas_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->kelas_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v02_rutin2->siswa_id->Visible) { // siswa_id ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->siswa_id) == "") { ?>
		<th data-name="siswa_id"><div id="elh_v02_rutin2_siswa_id" class="v02_rutin2_siswa_id"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->siswa_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="siswa_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->siswa_id) ?>',2);"><div id="elh_v02_rutin2_siswa_id" class="v02_rutin2_siswa_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->siswa_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->siswa_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->siswa_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v02_rutin2->rutin_id->Visible) { // rutin_id ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->rutin_id) == "") { ?>
		<th data-name="rutin_id"><div id="elh_v02_rutin2_rutin_id" class="v02_rutin2_rutin_id"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->rutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rutin_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->rutin_id) ?>',2);"><div id="elh_v02_rutin2_rutin_id" class="v02_rutin2_rutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->rutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->rutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->rutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v02_rutin2->id->Visible) { // id ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->id) == "") { ?>
		<th data-name="id"><div id="elh_v02_rutin2_id" class="v02_rutin2_id"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->id) ?>',2);"><div id="elh_v02_rutin2_id" class="v02_rutin2_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v02_rutin2->siswarutin_id->Visible) { // siswarutin_id ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->siswarutin_id) == "") { ?>
		<th data-name="siswarutin_id"><div id="elh_v02_rutin2_siswarutin_id" class="v02_rutin2_siswarutin_id"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->siswarutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="siswarutin_id"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->siswarutin_id) ?>',2);"><div id="elh_v02_rutin2_siswarutin_id" class="v02_rutin2_siswarutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->siswarutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->siswarutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->siswarutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v02_rutin2->Bulan->Visible) { // Bulan ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->Bulan) == "") { ?>
		<th data-name="Bulan"><div id="elh_v02_rutin2_Bulan" class="v02_rutin2_Bulan"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->Bulan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bulan"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->Bulan) ?>',2);"><div id="elh_v02_rutin2_Bulan" class="v02_rutin2_Bulan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->Bulan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->Bulan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->Bulan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v02_rutin2->Tahun->Visible) { // Tahun ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->Tahun) == "") { ?>
		<th data-name="Tahun"><div id="elh_v02_rutin2_Tahun" class="v02_rutin2_Tahun"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->Tahun->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->Tahun) ?>',2);"><div id="elh_v02_rutin2_Tahun" class="v02_rutin2_Tahun">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->Tahun->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->Tahun->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->Tahun->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v02_rutin2->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->Bayar_Tgl) == "") { ?>
		<th data-name="Bayar_Tgl"><div id="elh_v02_rutin2_Bayar_Tgl" class="v02_rutin2_Bayar_Tgl"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->Bayar_Tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Tgl"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->Bayar_Tgl) ?>',2);"><div id="elh_v02_rutin2_Bayar_Tgl" class="v02_rutin2_Bayar_Tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->Bayar_Tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->Bayar_Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->Bayar_Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($v02_rutin2->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
	<?php if ($v02_rutin2->SortUrl($v02_rutin2->Bayar_Jumlah) == "") { ?>
		<th data-name="Bayar_Jumlah"><div id="elh_v02_rutin2_Bayar_Jumlah" class="v02_rutin2_Bayar_Jumlah"><div class="ewTableHeaderCaption"><?php echo $v02_rutin2->Bayar_Jumlah->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Jumlah"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $v02_rutin2->SortUrl($v02_rutin2->Bayar_Jumlah) ?>',2);"><div id="elh_v02_rutin2_Bayar_Jumlah" class="v02_rutin2_Bayar_Jumlah">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $v02_rutin2->Bayar_Jumlah->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($v02_rutin2->Bayar_Jumlah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($v02_rutin2->Bayar_Jumlah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$v02_rutin2_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($v02_rutin2->ExportAll && $v02_rutin2->Export <> "") {
	$v02_rutin2_list->StopRec = $v02_rutin2_list->TotalRecs;
} else {

	// Set the last record to display
	if ($v02_rutin2_list->TotalRecs > $v02_rutin2_list->StartRec + $v02_rutin2_list->DisplayRecs - 1)
		$v02_rutin2_list->StopRec = $v02_rutin2_list->StartRec + $v02_rutin2_list->DisplayRecs - 1;
	else
		$v02_rutin2_list->StopRec = $v02_rutin2_list->TotalRecs;
}
$v02_rutin2_list->RecCnt = $v02_rutin2_list->StartRec - 1;
if ($v02_rutin2_list->Recordset && !$v02_rutin2_list->Recordset->EOF) {
	$v02_rutin2_list->Recordset->MoveFirst();
	$bSelectLimit = $v02_rutin2_list->UseSelectLimit;
	if (!$bSelectLimit && $v02_rutin2_list->StartRec > 1)
		$v02_rutin2_list->Recordset->Move($v02_rutin2_list->StartRec - 1);
} elseif (!$v02_rutin2->AllowAddDeleteRow && $v02_rutin2_list->StopRec == 0) {
	$v02_rutin2_list->StopRec = $v02_rutin2->GridAddRowCount;
}

// Initialize aggregate
$v02_rutin2->RowType = EW_ROWTYPE_AGGREGATEINIT;
$v02_rutin2->ResetAttrs();
$v02_rutin2_list->RenderRow();
while ($v02_rutin2_list->RecCnt < $v02_rutin2_list->StopRec) {
	$v02_rutin2_list->RecCnt++;
	if (intval($v02_rutin2_list->RecCnt) >= intval($v02_rutin2_list->StartRec)) {
		$v02_rutin2_list->RowCnt++;

		// Set up key count
		$v02_rutin2_list->KeyCount = $v02_rutin2_list->RowIndex;

		// Init row class and style
		$v02_rutin2->ResetAttrs();
		$v02_rutin2->CssClass = "";
		if ($v02_rutin2->CurrentAction == "gridadd") {
		} else {
			$v02_rutin2_list->LoadRowValues($v02_rutin2_list->Recordset); // Load row values
		}
		$v02_rutin2->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$v02_rutin2->RowAttrs = array_merge($v02_rutin2->RowAttrs, array('data-rowindex'=>$v02_rutin2_list->RowCnt, 'id'=>'r' . $v02_rutin2_list->RowCnt . '_v02_rutin2', 'data-rowtype'=>$v02_rutin2->RowType));

		// Render row
		$v02_rutin2_list->RenderRow();

		// Render list options
		$v02_rutin2_list->RenderListOptions();
?>
	<tr<?php echo $v02_rutin2->RowAttributes() ?>>
<?php

// Render list options (body, left)
$v02_rutin2_list->ListOptions->Render("body", "left", $v02_rutin2_list->RowCnt);
?>
	<?php if ($v02_rutin2->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<td data-name="tahunajaran_id"<?php echo $v02_rutin2->tahunajaran_id->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_tahunajaran_id" class="v02_rutin2_tahunajaran_id">
<span<?php echo $v02_rutin2->tahunajaran_id->ViewAttributes() ?>>
<?php echo $v02_rutin2->tahunajaran_id->ListViewValue() ?></span>
</span>
<a id="<?php echo $v02_rutin2_list->PageObjName . "_row_" . $v02_rutin2_list->RowCnt ?>"></a></td>
	<?php } ?>
	<?php if ($v02_rutin2->sekolah_id->Visible) { // sekolah_id ?>
		<td data-name="sekolah_id"<?php echo $v02_rutin2->sekolah_id->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_sekolah_id" class="v02_rutin2_sekolah_id">
<span<?php echo $v02_rutin2->sekolah_id->ViewAttributes() ?>>
<?php echo $v02_rutin2->sekolah_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v02_rutin2->kelas_id->Visible) { // kelas_id ?>
		<td data-name="kelas_id"<?php echo $v02_rutin2->kelas_id->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_kelas_id" class="v02_rutin2_kelas_id">
<span<?php echo $v02_rutin2->kelas_id->ViewAttributes() ?>>
<?php echo $v02_rutin2->kelas_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v02_rutin2->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id"<?php echo $v02_rutin2->siswa_id->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_siswa_id" class="v02_rutin2_siswa_id">
<span<?php echo $v02_rutin2->siswa_id->ViewAttributes() ?>>
<?php echo $v02_rutin2->siswa_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v02_rutin2->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id"<?php echo $v02_rutin2->rutin_id->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_rutin_id" class="v02_rutin2_rutin_id">
<span<?php echo $v02_rutin2->rutin_id->ViewAttributes() ?>>
<?php echo $v02_rutin2->rutin_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v02_rutin2->id->Visible) { // id ?>
		<td data-name="id"<?php echo $v02_rutin2->id->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_id" class="v02_rutin2_id">
<span<?php echo $v02_rutin2->id->ViewAttributes() ?>>
<?php echo $v02_rutin2->id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v02_rutin2->siswarutin_id->Visible) { // siswarutin_id ?>
		<td data-name="siswarutin_id"<?php echo $v02_rutin2->siswarutin_id->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_siswarutin_id" class="v02_rutin2_siswarutin_id">
<span<?php echo $v02_rutin2->siswarutin_id->ViewAttributes() ?>>
<?php echo $v02_rutin2->siswarutin_id->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v02_rutin2->Bulan->Visible) { // Bulan ?>
		<td data-name="Bulan"<?php echo $v02_rutin2->Bulan->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_Bulan" class="v02_rutin2_Bulan">
<span<?php echo $v02_rutin2->Bulan->ViewAttributes() ?>>
<?php echo $v02_rutin2->Bulan->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v02_rutin2->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun"<?php echo $v02_rutin2->Tahun->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_Tahun" class="v02_rutin2_Tahun">
<span<?php echo $v02_rutin2->Tahun->ViewAttributes() ?>>
<?php echo $v02_rutin2->Tahun->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v02_rutin2->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
		<td data-name="Bayar_Tgl"<?php echo $v02_rutin2->Bayar_Tgl->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_Bayar_Tgl" class="v02_rutin2_Bayar_Tgl">
<span<?php echo $v02_rutin2->Bayar_Tgl->ViewAttributes() ?>>
<?php echo $v02_rutin2->Bayar_Tgl->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($v02_rutin2->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah"<?php echo $v02_rutin2->Bayar_Jumlah->CellAttributes() ?>>
<span id="el<?php echo $v02_rutin2_list->RowCnt ?>_v02_rutin2_Bayar_Jumlah" class="v02_rutin2_Bayar_Jumlah">
<span<?php echo $v02_rutin2->Bayar_Jumlah->ViewAttributes() ?>>
<?php echo $v02_rutin2->Bayar_Jumlah->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$v02_rutin2_list->ListOptions->Render("body", "right", $v02_rutin2_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($v02_rutin2->CurrentAction <> "gridadd")
		$v02_rutin2_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($v02_rutin2->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($v02_rutin2_list->Recordset)
	$v02_rutin2_list->Recordset->Close();
?>
<?php if ($v02_rutin2->Export == "") { ?>
<div class="panel-footer ewGridLowerPanel">
<?php if ($v02_rutin2->CurrentAction <> "gridadd" && $v02_rutin2->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($v02_rutin2_list->Pager)) $v02_rutin2_list->Pager = new cPrevNextPager($v02_rutin2_list->StartRec, $v02_rutin2_list->DisplayRecs, $v02_rutin2_list->TotalRecs) ?>
<?php if ($v02_rutin2_list->Pager->RecordCount > 0 && $v02_rutin2_list->Pager->Visible) { ?>
<div class="ewPager">
<span><?php echo $Language->Phrase("Page") ?>&nbsp;</span>
<div class="ewPrevNext"><div class="input-group">
<div class="input-group-btn">
<!--first page button-->
	<?php if ($v02_rutin2_list->Pager->FirstButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerFirst") ?>" href="<?php echo $v02_rutin2_list->PageUrl() ?>start=<?php echo $v02_rutin2_list->Pager->FirstButton->Start ?>"><span class="icon-first ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerFirst") ?>"><span class="icon-first ewIcon"></span></a>
	<?php } ?>
<!--previous page button-->
	<?php if ($v02_rutin2_list->Pager->PrevButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerPrevious") ?>" href="<?php echo $v02_rutin2_list->PageUrl() ?>start=<?php echo $v02_rutin2_list->Pager->PrevButton->Start ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerPrevious") ?>"><span class="icon-prev ewIcon"></span></a>
	<?php } ?>
</div>
<!--current page number-->
	<input class="form-control input-sm" type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $v02_rutin2_list->Pager->CurrentPage ?>">
<div class="input-group-btn">
<!--next page button-->
	<?php if ($v02_rutin2_list->Pager->NextButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerNext") ?>" href="<?php echo $v02_rutin2_list->PageUrl() ?>start=<?php echo $v02_rutin2_list->Pager->NextButton->Start ?>"><span class="icon-next ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerNext") ?>"><span class="icon-next ewIcon"></span></a>
	<?php } ?>
<!--last page button-->
	<?php if ($v02_rutin2_list->Pager->LastButton->Enabled) { ?>
	<a class="btn btn-default btn-sm" title="<?php echo $Language->Phrase("PagerLast") ?>" href="<?php echo $v02_rutin2_list->PageUrl() ?>start=<?php echo $v02_rutin2_list->Pager->LastButton->Start ?>"><span class="icon-last ewIcon"></span></a>
	<?php } else { ?>
	<a class="btn btn-default btn-sm disabled" title="<?php echo $Language->Phrase("PagerLast") ?>"><span class="icon-last ewIcon"></span></a>
	<?php } ?>
</div>
</div>
</div>
<span>&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $v02_rutin2_list->Pager->PageCount ?></span>
</div>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $v02_rutin2_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $v02_rutin2_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $v02_rutin2_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($v02_rutin2_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($v02_rutin2_list->TotalRecs == 0 && $v02_rutin2->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($v02_rutin2_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($v02_rutin2->Export == "") { ?>
<script type="text/javascript">
fv02_rutin2listsrch.FilterList = <?php echo $v02_rutin2_list->GetFilterList() ?>;
fv02_rutin2listsrch.Init();
fv02_rutin2list.Init();
</script>
<?php } ?>
<?php
$v02_rutin2_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($v02_rutin2->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$v02_rutin2_list->Page_Terminate();
?>
