<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t06_siswarutinbayar_grid)) $t06_siswarutinbayar_grid = new ct06_siswarutinbayar_grid();

// Page init
$t06_siswarutinbayar_grid->Page_Init();

// Page main
$t06_siswarutinbayar_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t06_siswarutinbayar_grid->Page_Render();
?>
<?php if ($t06_siswarutinbayar->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft06_siswarutinbayargrid = new ew_Form("ft06_siswarutinbayargrid", "grid");
ft06_siswarutinbayargrid.FormKeyCountName = '<?php echo $t06_siswarutinbayar_grid->FormKeyCountName ?>';

// Validate form
ft06_siswarutinbayargrid.Validate = function() {
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
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_siswa_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar->siswa_id->FldCaption(), $t06_siswarutinbayar->siswa_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_rutin_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar->rutin_id->FldCaption(), $t06_siswarutinbayar->rutin_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bulan");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar->Bulan->FldCaption(), $t06_siswarutinbayar->Bulan->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tahun");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t06_siswarutinbayar->Tahun->FldCaption(), $t06_siswarutinbayar->Tahun->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Tgl");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_siswarutinbayar->Bayar_Tgl->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Bayar_Jumlah");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t06_siswarutinbayar->Bayar_Jumlah->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft06_siswarutinbayargrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "siswa_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "rutin_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bulan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Tahun", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bayar_Tgl", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Bayar_Jumlah", false)) return false;
	return true;
}

// Form_CustomValidate event
ft06_siswarutinbayargrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft06_siswarutinbayargrid.ValidateRequired = true;
<?php } else { ?>
ft06_siswarutinbayargrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft06_siswarutinbayargrid.Lists["x_siswa_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nomor_Induk","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t03_siswa"};
ft06_siswarutinbayargrid.Lists["x_rutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t04_rutin"};
ft06_siswarutinbayargrid.Lists["x_Bulan"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft06_siswarutinbayargrid.Lists["x_Bulan"].Options = <?php echo json_encode($t06_siswarutinbayar->Bulan->Options()) ?>;
ft06_siswarutinbayargrid.Lists["x_Tahun"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft06_siswarutinbayargrid.Lists["x_Tahun"].Options = <?php echo json_encode($t06_siswarutinbayar->Tahun->Options()) ?>;

// Form object for search
</script>
<?php } ?>
<?php
if ($t06_siswarutinbayar->CurrentAction == "gridadd") {
	if ($t06_siswarutinbayar->CurrentMode == "copy") {
		$bSelectLimit = $t06_siswarutinbayar_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t06_siswarutinbayar_grid->TotalRecs = $t06_siswarutinbayar->SelectRecordCount();
			$t06_siswarutinbayar_grid->Recordset = $t06_siswarutinbayar_grid->LoadRecordset($t06_siswarutinbayar_grid->StartRec-1, $t06_siswarutinbayar_grid->DisplayRecs);
		} else {
			if ($t06_siswarutinbayar_grid->Recordset = $t06_siswarutinbayar_grid->LoadRecordset())
				$t06_siswarutinbayar_grid->TotalRecs = $t06_siswarutinbayar_grid->Recordset->RecordCount();
		}
		$t06_siswarutinbayar_grid->StartRec = 1;
		$t06_siswarutinbayar_grid->DisplayRecs = $t06_siswarutinbayar_grid->TotalRecs;
	} else {
		$t06_siswarutinbayar->CurrentFilter = "0=1";
		$t06_siswarutinbayar_grid->StartRec = 1;
		$t06_siswarutinbayar_grid->DisplayRecs = $t06_siswarutinbayar->GridAddRowCount;
	}
	$t06_siswarutinbayar_grid->TotalRecs = $t06_siswarutinbayar_grid->DisplayRecs;
	$t06_siswarutinbayar_grid->StopRec = $t06_siswarutinbayar_grid->DisplayRecs;
} else {
	$bSelectLimit = $t06_siswarutinbayar_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t06_siswarutinbayar_grid->TotalRecs <= 0)
			$t06_siswarutinbayar_grid->TotalRecs = $t06_siswarutinbayar->SelectRecordCount();
	} else {
		if (!$t06_siswarutinbayar_grid->Recordset && ($t06_siswarutinbayar_grid->Recordset = $t06_siswarutinbayar_grid->LoadRecordset()))
			$t06_siswarutinbayar_grid->TotalRecs = $t06_siswarutinbayar_grid->Recordset->RecordCount();
	}
	$t06_siswarutinbayar_grid->StartRec = 1;
	$t06_siswarutinbayar_grid->DisplayRecs = $t06_siswarutinbayar_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t06_siswarutinbayar_grid->Recordset = $t06_siswarutinbayar_grid->LoadRecordset($t06_siswarutinbayar_grid->StartRec-1, $t06_siswarutinbayar_grid->DisplayRecs);

	// Set no record found message
	if ($t06_siswarutinbayar->CurrentAction == "" && $t06_siswarutinbayar_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t06_siswarutinbayar_grid->setWarningMessage(ew_DeniedMsg());
		if ($t06_siswarutinbayar_grid->SearchWhere == "0=101")
			$t06_siswarutinbayar_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t06_siswarutinbayar_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t06_siswarutinbayar_grid->RenderOtherOptions();
?>
<?php $t06_siswarutinbayar_grid->ShowPageHeader(); ?>
<?php
$t06_siswarutinbayar_grid->ShowMessage();
?>
<?php if ($t06_siswarutinbayar_grid->TotalRecs > 0 || $t06_siswarutinbayar->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t06_siswarutinbayar">
<div id="ft06_siswarutinbayargrid" class="ewForm form-inline">
<?php if ($t06_siswarutinbayar_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t06_siswarutinbayar_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t06_siswarutinbayar" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t06_siswarutinbayargrid" class="table ewTable">
<?php echo $t06_siswarutinbayar->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t06_siswarutinbayar_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t06_siswarutinbayar_grid->RenderListOptions();

// Render list options (header, left)
$t06_siswarutinbayar_grid->ListOptions->Render("header", "left");
?>
<?php if ($t06_siswarutinbayar->siswa_id->Visible) { // siswa_id ?>
	<?php if ($t06_siswarutinbayar->SortUrl($t06_siswarutinbayar->siswa_id) == "") { ?>
		<th data-name="siswa_id"><div id="elh_t06_siswarutinbayar_siswa_id" class="t06_siswarutinbayar_siswa_id"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->siswa_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="siswa_id"><div><div id="elh_t06_siswarutinbayar_siswa_id" class="t06_siswarutinbayar_siswa_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->siswa_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar->siswa_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar->siswa_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar->rutin_id->Visible) { // rutin_id ?>
	<?php if ($t06_siswarutinbayar->SortUrl($t06_siswarutinbayar->rutin_id) == "") { ?>
		<th data-name="rutin_id"><div id="elh_t06_siswarutinbayar_rutin_id" class="t06_siswarutinbayar_rutin_id"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->rutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rutin_id"><div><div id="elh_t06_siswarutinbayar_rutin_id" class="t06_siswarutinbayar_rutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->rutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar->rutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar->rutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar->Bulan->Visible) { // Bulan ?>
	<?php if ($t06_siswarutinbayar->SortUrl($t06_siswarutinbayar->Bulan) == "") { ?>
		<th data-name="Bulan"><div id="elh_t06_siswarutinbayar_Bulan" class="t06_siswarutinbayar_Bulan"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->Bulan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bulan"><div><div id="elh_t06_siswarutinbayar_Bulan" class="t06_siswarutinbayar_Bulan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->Bulan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar->Bulan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar->Bulan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar->Tahun->Visible) { // Tahun ?>
	<?php if ($t06_siswarutinbayar->SortUrl($t06_siswarutinbayar->Tahun) == "") { ?>
		<th data-name="Tahun"><div id="elh_t06_siswarutinbayar_Tahun" class="t06_siswarutinbayar_Tahun"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->Tahun->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Tahun"><div><div id="elh_t06_siswarutinbayar_Tahun" class="t06_siswarutinbayar_Tahun">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->Tahun->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar->Tahun->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar->Tahun->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
	<?php if ($t06_siswarutinbayar->SortUrl($t06_siswarutinbayar->Bayar_Tgl) == "") { ?>
		<th data-name="Bayar_Tgl"><div id="elh_t06_siswarutinbayar_Bayar_Tgl" class="t06_siswarutinbayar_Bayar_Tgl"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->Bayar_Tgl->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Tgl"><div><div id="elh_t06_siswarutinbayar_Bayar_Tgl" class="t06_siswarutinbayar_Bayar_Tgl">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->Bayar_Tgl->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar->Bayar_Tgl->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar->Bayar_Tgl->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t06_siswarutinbayar->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
	<?php if ($t06_siswarutinbayar->SortUrl($t06_siswarutinbayar->Bayar_Jumlah) == "") { ?>
		<th data-name="Bayar_Jumlah"><div id="elh_t06_siswarutinbayar_Bayar_Jumlah" class="t06_siswarutinbayar_Bayar_Jumlah"><div class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->Bayar_Jumlah->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Bayar_Jumlah"><div><div id="elh_t06_siswarutinbayar_Bayar_Jumlah" class="t06_siswarutinbayar_Bayar_Jumlah">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t06_siswarutinbayar->Bayar_Jumlah->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t06_siswarutinbayar->Bayar_Jumlah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t06_siswarutinbayar->Bayar_Jumlah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t06_siswarutinbayar_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t06_siswarutinbayar_grid->StartRec = 1;
$t06_siswarutinbayar_grid->StopRec = $t06_siswarutinbayar_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t06_siswarutinbayar_grid->FormKeyCountName) && ($t06_siswarutinbayar->CurrentAction == "gridadd" || $t06_siswarutinbayar->CurrentAction == "gridedit" || $t06_siswarutinbayar->CurrentAction == "F")) {
		$t06_siswarutinbayar_grid->KeyCount = $objForm->GetValue($t06_siswarutinbayar_grid->FormKeyCountName);
		$t06_siswarutinbayar_grid->StopRec = $t06_siswarutinbayar_grid->StartRec + $t06_siswarutinbayar_grid->KeyCount - 1;
	}
}
$t06_siswarutinbayar_grid->RecCnt = $t06_siswarutinbayar_grid->StartRec - 1;
if ($t06_siswarutinbayar_grid->Recordset && !$t06_siswarutinbayar_grid->Recordset->EOF) {
	$t06_siswarutinbayar_grid->Recordset->MoveFirst();
	$bSelectLimit = $t06_siswarutinbayar_grid->UseSelectLimit;
	if (!$bSelectLimit && $t06_siswarutinbayar_grid->StartRec > 1)
		$t06_siswarutinbayar_grid->Recordset->Move($t06_siswarutinbayar_grid->StartRec - 1);
} elseif (!$t06_siswarutinbayar->AllowAddDeleteRow && $t06_siswarutinbayar_grid->StopRec == 0) {
	$t06_siswarutinbayar_grid->StopRec = $t06_siswarutinbayar->GridAddRowCount;
}

// Initialize aggregate
$t06_siswarutinbayar->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t06_siswarutinbayar->ResetAttrs();
$t06_siswarutinbayar_grid->RenderRow();
if ($t06_siswarutinbayar->CurrentAction == "gridadd")
	$t06_siswarutinbayar_grid->RowIndex = 0;
if ($t06_siswarutinbayar->CurrentAction == "gridedit")
	$t06_siswarutinbayar_grid->RowIndex = 0;
while ($t06_siswarutinbayar_grid->RecCnt < $t06_siswarutinbayar_grid->StopRec) {
	$t06_siswarutinbayar_grid->RecCnt++;
	if (intval($t06_siswarutinbayar_grid->RecCnt) >= intval($t06_siswarutinbayar_grid->StartRec)) {
		$t06_siswarutinbayar_grid->RowCnt++;
		if ($t06_siswarutinbayar->CurrentAction == "gridadd" || $t06_siswarutinbayar->CurrentAction == "gridedit" || $t06_siswarutinbayar->CurrentAction == "F") {
			$t06_siswarutinbayar_grid->RowIndex++;
			$objForm->Index = $t06_siswarutinbayar_grid->RowIndex;
			if ($objForm->HasValue($t06_siswarutinbayar_grid->FormActionName))
				$t06_siswarutinbayar_grid->RowAction = strval($objForm->GetValue($t06_siswarutinbayar_grid->FormActionName));
			elseif ($t06_siswarutinbayar->CurrentAction == "gridadd")
				$t06_siswarutinbayar_grid->RowAction = "insert";
			else
				$t06_siswarutinbayar_grid->RowAction = "";
		}

		// Set up key count
		$t06_siswarutinbayar_grid->KeyCount = $t06_siswarutinbayar_grid->RowIndex;

		// Init row class and style
		$t06_siswarutinbayar->ResetAttrs();
		$t06_siswarutinbayar->CssClass = "";
		if ($t06_siswarutinbayar->CurrentAction == "gridadd") {
			if ($t06_siswarutinbayar->CurrentMode == "copy") {
				$t06_siswarutinbayar_grid->LoadRowValues($t06_siswarutinbayar_grid->Recordset); // Load row values
				$t06_siswarutinbayar_grid->SetRecordKey($t06_siswarutinbayar_grid->RowOldKey, $t06_siswarutinbayar_grid->Recordset); // Set old record key
			} else {
				$t06_siswarutinbayar_grid->LoadDefaultValues(); // Load default values
				$t06_siswarutinbayar_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t06_siswarutinbayar_grid->LoadRowValues($t06_siswarutinbayar_grid->Recordset); // Load row values
		}
		$t06_siswarutinbayar->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t06_siswarutinbayar->CurrentAction == "gridadd") // Grid add
			$t06_siswarutinbayar->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t06_siswarutinbayar->CurrentAction == "gridadd" && $t06_siswarutinbayar->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t06_siswarutinbayar_grid->RestoreCurrentRowFormValues($t06_siswarutinbayar_grid->RowIndex); // Restore form values
		if ($t06_siswarutinbayar->CurrentAction == "gridedit") { // Grid edit
			if ($t06_siswarutinbayar->EventCancelled) {
				$t06_siswarutinbayar_grid->RestoreCurrentRowFormValues($t06_siswarutinbayar_grid->RowIndex); // Restore form values
			}
			if ($t06_siswarutinbayar_grid->RowAction == "insert")
				$t06_siswarutinbayar->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t06_siswarutinbayar->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t06_siswarutinbayar->CurrentAction == "gridedit" && ($t06_siswarutinbayar->RowType == EW_ROWTYPE_EDIT || $t06_siswarutinbayar->RowType == EW_ROWTYPE_ADD) && $t06_siswarutinbayar->EventCancelled) // Update failed
			$t06_siswarutinbayar_grid->RestoreCurrentRowFormValues($t06_siswarutinbayar_grid->RowIndex); // Restore form values
		if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t06_siswarutinbayar_grid->EditRowCnt++;
		if ($t06_siswarutinbayar->CurrentAction == "F") // Confirm row
			$t06_siswarutinbayar_grid->RestoreCurrentRowFormValues($t06_siswarutinbayar_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t06_siswarutinbayar->RowAttrs = array_merge($t06_siswarutinbayar->RowAttrs, array('data-rowindex'=>$t06_siswarutinbayar_grid->RowCnt, 'id'=>'r' . $t06_siswarutinbayar_grid->RowCnt . '_t06_siswarutinbayar', 'data-rowtype'=>$t06_siswarutinbayar->RowType));

		// Render row
		$t06_siswarutinbayar_grid->RenderRow();

		// Render list options
		$t06_siswarutinbayar_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t06_siswarutinbayar_grid->RowAction <> "delete" && $t06_siswarutinbayar_grid->RowAction <> "insertdelete" && !($t06_siswarutinbayar_grid->RowAction == "insert" && $t06_siswarutinbayar->CurrentAction == "F" && $t06_siswarutinbayar_grid->EmptyRow())) {
?>
	<tr<?php echo $t06_siswarutinbayar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_siswarutinbayar_grid->ListOptions->Render("body", "left", $t06_siswarutinbayar_grid->RowCnt);
?>
	<?php if ($t06_siswarutinbayar->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id"<?php echo $t06_siswarutinbayar->siswa_id->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t06_siswarutinbayar->siswa_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_siswa_id" class="form-group t06_siswarutinbayar_siswa_id">
<span<?php echo $t06_siswarutinbayar->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_siswa_id" class="form-group t06_siswarutinbayar_siswa_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id"><?php echo (strval($t06_siswarutinbayar->siswa_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_siswarutinbayar->siswa_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_siswarutinbayar->siswa_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_siswa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_siswarutinbayar->siswa_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_siswarutinbayar->siswa_id->CurrentValue ?>"<?php echo $t06_siswarutinbayar->siswa_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="s_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_siswarutinbayar->siswa_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_siswa_id" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->siswa_id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_siswa_id" class="form-group t06_siswarutinbayar_siswa_id">
<span<?php echo $t06_siswarutinbayar->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->siswa_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->siswa_id->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_siswa_id" class="t06_siswarutinbayar_siswa_id">
<span<?php echo $t06_siswarutinbayar->siswa_id->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar->siswa_id->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->siswa_id->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_siswa_id" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->siswa_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_siswa_id" name="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->siswa_id->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_siswa_id" name="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->siswa_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t06_siswarutinbayar_grid->PageObjName . "_row_" . $t06_siswarutinbayar_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->id->CurrentValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_id" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_id" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_EDIT || $t06_siswarutinbayar->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t06_siswarutinbayar->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id"<?php echo $t06_siswarutinbayar->rutin_id->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t06_siswarutinbayar->rutin_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_rutin_id" class="form-group t06_siswarutinbayar_rutin_id">
<span<?php echo $t06_siswarutinbayar->rutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->rutin_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->rutin_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_rutin_id" class="form-group t06_siswarutinbayar_rutin_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id"><?php echo (strval($t06_siswarutinbayar->rutin_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_siswarutinbayar->rutin_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_siswarutinbayar->rutin_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_rutin_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_siswarutinbayar->rutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo $t06_siswarutinbayar->rutin_id->CurrentValue ?>"<?php echo $t06_siswarutinbayar->rutin_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="s_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo $t06_siswarutinbayar->rutin_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_rutin_id" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->rutin_id->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_rutin_id" class="form-group t06_siswarutinbayar_rutin_id">
<span<?php echo $t06_siswarutinbayar->rutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->rutin_id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->rutin_id->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_rutin_id" class="t06_siswarutinbayar_rutin_id">
<span<?php echo $t06_siswarutinbayar->rutin_id->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar->rutin_id->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->rutin_id->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_rutin_id" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->rutin_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_rutin_id" name="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->rutin_id->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_rutin_id" name="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->rutin_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar->Bulan->Visible) { // Bulan ?>
		<td data-name="Bulan"<?php echo $t06_siswarutinbayar->Bulan->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Bulan" class="form-group t06_siswarutinbayar_Bulan">
<select data-table="t06_siswarutinbayar" data-field="x_Bulan" data-value-separator="<?php echo $t06_siswarutinbayar->Bulan->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan"<?php echo $t06_siswarutinbayar->Bulan->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar->Bulan->SelectOptionListHtml("x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan") ?>
</select>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bulan" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bulan->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Bulan" class="form-group t06_siswarutinbayar_Bulan">
<span<?php echo $t06_siswarutinbayar->Bulan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->Bulan->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bulan->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Bulan" class="t06_siswarutinbayar_Bulan">
<span<?php echo $t06_siswarutinbayar->Bulan->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar->Bulan->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bulan->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bulan" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bulan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bulan" name="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" id="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bulan->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bulan" name="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" id="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bulan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun"<?php echo $t06_siswarutinbayar->Tahun->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Tahun" class="form-group t06_siswarutinbayar_Tahun">
<select data-table="t06_siswarutinbayar" data-field="x_Tahun" data-value-separator="<?php echo $t06_siswarutinbayar->Tahun->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun"<?php echo $t06_siswarutinbayar->Tahun->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar->Tahun->SelectOptionListHtml("x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun") ?>
</select>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Tahun" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Tahun->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Tahun" class="form-group t06_siswarutinbayar_Tahun">
<span<?php echo $t06_siswarutinbayar->Tahun->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->Tahun->EditValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Tahun->CurrentValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Tahun" class="t06_siswarutinbayar_Tahun">
<span<?php echo $t06_siswarutinbayar->Tahun->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar->Tahun->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Tahun->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Tahun" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Tahun->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Tahun" name="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" id="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Tahun->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Tahun" name="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" id="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Tahun->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
		<td data-name="Bayar_Tgl"<?php echo $t06_siswarutinbayar->Bayar_Tgl->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Bayar_Tgl" class="form-group t06_siswarutinbayar_Bayar_Tgl">
<input type="text" data-table="t06_siswarutinbayar" data-field="x_Bayar_Tgl" data-format="7" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar->Bayar_Tgl->EditValue ?>"<?php echo $t06_siswarutinbayar->Bayar_Tgl->EditAttributes() ?>>
<?php if (!$t06_siswarutinbayar->Bayar_Tgl->ReadOnly && !$t06_siswarutinbayar->Bayar_Tgl->Disabled && !isset($t06_siswarutinbayar->Bayar_Tgl->EditAttrs["readonly"]) && !isset($t06_siswarutinbayar->Bayar_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft06_siswarutinbayargrid", "x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl", 7);
</script>
<?php } ?>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Tgl" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Tgl->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Bayar_Tgl" class="form-group t06_siswarutinbayar_Bayar_Tgl">
<input type="text" data-table="t06_siswarutinbayar" data-field="x_Bayar_Tgl" data-format="7" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar->Bayar_Tgl->EditValue ?>"<?php echo $t06_siswarutinbayar->Bayar_Tgl->EditAttributes() ?>>
<?php if (!$t06_siswarutinbayar->Bayar_Tgl->ReadOnly && !$t06_siswarutinbayar->Bayar_Tgl->Disabled && !isset($t06_siswarutinbayar->Bayar_Tgl->EditAttrs["readonly"]) && !isset($t06_siswarutinbayar->Bayar_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft06_siswarutinbayargrid", "x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl", 7);
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Bayar_Tgl" class="t06_siswarutinbayar_Bayar_Tgl">
<span<?php echo $t06_siswarutinbayar->Bayar_Tgl->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar->Bayar_Tgl->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Tgl" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Tgl->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Tgl" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Tgl->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Tgl" name="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Tgl->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Tgl" name="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Tgl->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah"<?php echo $t06_siswarutinbayar->Bayar_Jumlah->CellAttributes() ?>>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Bayar_Jumlah" class="form-group t06_siswarutinbayar_Bayar_Jumlah">
<input type="text" data-table="t06_siswarutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar->Bayar_Jumlah->EditValue ?>"<?php echo $t06_siswarutinbayar->Bayar_Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Jumlah" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Jumlah->OldValue) ?>">
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Bayar_Jumlah" class="form-group t06_siswarutinbayar_Bayar_Jumlah">
<input type="text" data-table="t06_siswarutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar->Bayar_Jumlah->EditValue ?>"<?php echo $t06_siswarutinbayar->Bayar_Jumlah->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t06_siswarutinbayar_grid->RowCnt ?>_t06_siswarutinbayar_Bayar_Jumlah" class="t06_siswarutinbayar_Bayar_Jumlah">
<span<?php echo $t06_siswarutinbayar->Bayar_Jumlah->ViewAttributes() ?>>
<?php echo $t06_siswarutinbayar->Bayar_Jumlah->ListViewValue() ?></span>
</span>
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Jumlah->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Jumlah" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Jumlah" name="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="ft06_siswarutinbayargrid$x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Jumlah->FormValue) ?>">
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Jumlah" name="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="ft06_siswarutinbayargrid$o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_siswarutinbayar_grid->ListOptions->Render("body", "right", $t06_siswarutinbayar_grid->RowCnt);
?>
	</tr>
<?php if ($t06_siswarutinbayar->RowType == EW_ROWTYPE_ADD || $t06_siswarutinbayar->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft06_siswarutinbayargrid.UpdateOpts(<?php echo $t06_siswarutinbayar_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t06_siswarutinbayar->CurrentAction <> "gridadd" || $t06_siswarutinbayar->CurrentMode == "copy")
		if (!$t06_siswarutinbayar_grid->Recordset->EOF) $t06_siswarutinbayar_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t06_siswarutinbayar->CurrentMode == "add" || $t06_siswarutinbayar->CurrentMode == "copy" || $t06_siswarutinbayar->CurrentMode == "edit") {
		$t06_siswarutinbayar_grid->RowIndex = '$rowindex$';
		$t06_siswarutinbayar_grid->LoadDefaultValues();

		// Set row properties
		$t06_siswarutinbayar->ResetAttrs();
		$t06_siswarutinbayar->RowAttrs = array_merge($t06_siswarutinbayar->RowAttrs, array('data-rowindex'=>$t06_siswarutinbayar_grid->RowIndex, 'id'=>'r0_t06_siswarutinbayar', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t06_siswarutinbayar->RowAttrs["class"], "ewTemplate");
		$t06_siswarutinbayar->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t06_siswarutinbayar_grid->RenderRow();

		// Render list options
		$t06_siswarutinbayar_grid->RenderListOptions();
		$t06_siswarutinbayar_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t06_siswarutinbayar->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t06_siswarutinbayar_grid->ListOptions->Render("body", "left", $t06_siswarutinbayar_grid->RowIndex);
?>
	<?php if ($t06_siswarutinbayar->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id">
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<?php if ($t06_siswarutinbayar->siswa_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_siswa_id" class="form-group t06_siswarutinbayar_siswa_id">
<span<?php echo $t06_siswarutinbayar->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->siswa_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_siswa_id" class="form-group t06_siswarutinbayar_siswa_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id"><?php echo (strval($t06_siswarutinbayar->siswa_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_siswarutinbayar->siswa_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_siswarutinbayar->siswa_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_siswa_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_siswarutinbayar->siswa_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_siswarutinbayar->siswa_id->CurrentValue ?>"<?php echo $t06_siswarutinbayar->siswa_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="s_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo $t06_siswarutinbayar->siswa_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_siswa_id" class="form-group t06_siswarutinbayar_siswa_id">
<span<?php echo $t06_siswarutinbayar->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_siswa_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->siswa_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_siswa_id" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->siswa_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id">
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<?php if ($t06_siswarutinbayar->rutin_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_rutin_id" class="form-group t06_siswarutinbayar_rutin_id">
<span<?php echo $t06_siswarutinbayar->rutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->rutin_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->rutin_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_rutin_id" class="form-group t06_siswarutinbayar_rutin_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id"><?php echo (strval($t06_siswarutinbayar->rutin_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t06_siswarutinbayar->rutin_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t06_siswarutinbayar->rutin_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_rutin_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t06_siswarutinbayar->rutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo $t06_siswarutinbayar->rutin_id->CurrentValue ?>"<?php echo $t06_siswarutinbayar->rutin_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="s_x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo $t06_siswarutinbayar->rutin_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_rutin_id" class="form-group t06_siswarutinbayar_rutin_id">
<span<?php echo $t06_siswarutinbayar->rutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->rutin_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_rutin_id" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->rutin_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_rutin_id" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->rutin_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar->Bulan->Visible) { // Bulan ?>
		<td data-name="Bulan">
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_Bulan" class="form-group t06_siswarutinbayar_Bulan">
<select data-table="t06_siswarutinbayar" data-field="x_Bulan" data-value-separator="<?php echo $t06_siswarutinbayar->Bulan->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan"<?php echo $t06_siswarutinbayar->Bulan->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar->Bulan->SelectOptionListHtml("x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_Bulan" class="form-group t06_siswarutinbayar_Bulan">
<span<?php echo $t06_siswarutinbayar->Bulan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->Bulan->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bulan" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bulan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bulan" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bulan" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bulan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar->Tahun->Visible) { // Tahun ?>
		<td data-name="Tahun">
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_Tahun" class="form-group t06_siswarutinbayar_Tahun">
<select data-table="t06_siswarutinbayar" data-field="x_Tahun" data-value-separator="<?php echo $t06_siswarutinbayar->Tahun->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun"<?php echo $t06_siswarutinbayar->Tahun->EditAttributes() ?>>
<?php echo $t06_siswarutinbayar->Tahun->SelectOptionListHtml("x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_Tahun" class="form-group t06_siswarutinbayar_Tahun">
<span<?php echo $t06_siswarutinbayar->Tahun->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->Tahun->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Tahun" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Tahun->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Tahun" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Tahun" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Tahun->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar->Bayar_Tgl->Visible) { // Bayar_Tgl ?>
		<td data-name="Bayar_Tgl">
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_Bayar_Tgl" class="form-group t06_siswarutinbayar_Bayar_Tgl">
<input type="text" data-table="t06_siswarutinbayar" data-field="x_Bayar_Tgl" data-format="7" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Tgl->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar->Bayar_Tgl->EditValue ?>"<?php echo $t06_siswarutinbayar->Bayar_Tgl->EditAttributes() ?>>
<?php if (!$t06_siswarutinbayar->Bayar_Tgl->ReadOnly && !$t06_siswarutinbayar->Bayar_Tgl->Disabled && !isset($t06_siswarutinbayar->Bayar_Tgl->EditAttrs["readonly"]) && !isset($t06_siswarutinbayar->Bayar_Tgl->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft06_siswarutinbayargrid", "x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl", 7);
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_Bayar_Tgl" class="form-group t06_siswarutinbayar_Bayar_Tgl">
<span<?php echo $t06_siswarutinbayar->Bayar_Tgl->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->Bayar_Tgl->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Tgl" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Tgl->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Tgl" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Tgl" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Tgl->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t06_siswarutinbayar->Bayar_Jumlah->Visible) { // Bayar_Jumlah ?>
		<td data-name="Bayar_Jumlah">
<?php if ($t06_siswarutinbayar->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t06_siswarutinbayar_Bayar_Jumlah" class="form-group t06_siswarutinbayar_Bayar_Jumlah">
<input type="text" data-table="t06_siswarutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" size="30" placeholder="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Jumlah->getPlaceHolder()) ?>" value="<?php echo $t06_siswarutinbayar->Bayar_Jumlah->EditValue ?>"<?php echo $t06_siswarutinbayar->Bayar_Jumlah->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t06_siswarutinbayar_Bayar_Jumlah" class="form-group t06_siswarutinbayar_Bayar_Jumlah">
<span<?php echo $t06_siswarutinbayar->Bayar_Jumlah->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t06_siswarutinbayar->Bayar_Jumlah->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Jumlah" name="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="x<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t06_siswarutinbayar" data-field="x_Bayar_Jumlah" name="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" id="o<?php echo $t06_siswarutinbayar_grid->RowIndex ?>_Bayar_Jumlah" value="<?php echo ew_HtmlEncode($t06_siswarutinbayar->Bayar_Jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t06_siswarutinbayar_grid->ListOptions->Render("body", "right", $t06_siswarutinbayar_grid->RowCnt);
?>
<script type="text/javascript">
ft06_siswarutinbayargrid.UpdateOpts(<?php echo $t06_siswarutinbayar_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t06_siswarutinbayar->CurrentMode == "add" || $t06_siswarutinbayar->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t06_siswarutinbayar_grid->FormKeyCountName ?>" id="<?php echo $t06_siswarutinbayar_grid->FormKeyCountName ?>" value="<?php echo $t06_siswarutinbayar_grid->KeyCount ?>">
<?php echo $t06_siswarutinbayar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t06_siswarutinbayar->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t06_siswarutinbayar_grid->FormKeyCountName ?>" id="<?php echo $t06_siswarutinbayar_grid->FormKeyCountName ?>" value="<?php echo $t06_siswarutinbayar_grid->KeyCount ?>">
<?php echo $t06_siswarutinbayar_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t06_siswarutinbayar->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft06_siswarutinbayargrid">
</div>
<?php

// Close recordset
if ($t06_siswarutinbayar_grid->Recordset)
	$t06_siswarutinbayar_grid->Recordset->Close();
?>
<?php if ($t06_siswarutinbayar_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t06_siswarutinbayar_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t06_siswarutinbayar_grid->TotalRecs == 0 && $t06_siswarutinbayar->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t06_siswarutinbayar_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t06_siswarutinbayar->Export == "") { ?>
<script type="text/javascript">
ft06_siswarutinbayargrid.Init();
</script>
<?php } ?>
<?php
$t06_siswarutinbayar_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t06_siswarutinbayar_grid->Page_Terminate();
?>
