<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t02_kelas_grid)) $t02_kelas_grid = new ct02_kelas_grid();

// Page init
$t02_kelas_grid->Page_Init();

// Page main
$t02_kelas_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t02_kelas_grid->Page_Render();
?>
<?php if ($t02_kelas->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft02_kelasgrid = new ew_Form("ft02_kelasgrid", "grid");
ft02_kelasgrid.FormKeyCountName = '<?php echo $t02_kelas_grid->FormKeyCountName ?>';

// Validate form
ft02_kelasgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_sekolah_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t02_kelas->sekolah_id->FldCaption(), $t02_kelas->sekolah_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_sekolah_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t02_kelas->sekolah_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Nama");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t02_kelas->Nama->FldCaption(), $t02_kelas->Nama->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft02_kelasgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "sekolah_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Nama", false)) return false;
	return true;
}

// Form_CustomValidate event
ft02_kelasgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft02_kelasgrid.ValidateRequired = true;
<?php } else { ?>
ft02_kelasgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft02_kelasgrid.Lists["x_sekolah_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t01_sekolah"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t02_kelas->CurrentAction == "gridadd") {
	if ($t02_kelas->CurrentMode == "copy") {
		$bSelectLimit = $t02_kelas_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t02_kelas_grid->TotalRecs = $t02_kelas->SelectRecordCount();
			$t02_kelas_grid->Recordset = $t02_kelas_grid->LoadRecordset($t02_kelas_grid->StartRec-1, $t02_kelas_grid->DisplayRecs);
		} else {
			if ($t02_kelas_grid->Recordset = $t02_kelas_grid->LoadRecordset())
				$t02_kelas_grid->TotalRecs = $t02_kelas_grid->Recordset->RecordCount();
		}
		$t02_kelas_grid->StartRec = 1;
		$t02_kelas_grid->DisplayRecs = $t02_kelas_grid->TotalRecs;
	} else {
		$t02_kelas->CurrentFilter = "0=1";
		$t02_kelas_grid->StartRec = 1;
		$t02_kelas_grid->DisplayRecs = $t02_kelas->GridAddRowCount;
	}
	$t02_kelas_grid->TotalRecs = $t02_kelas_grid->DisplayRecs;
	$t02_kelas_grid->StopRec = $t02_kelas_grid->DisplayRecs;
} else {
	$bSelectLimit = $t02_kelas_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t02_kelas_grid->TotalRecs <= 0)
			$t02_kelas_grid->TotalRecs = $t02_kelas->SelectRecordCount();
	} else {
		if (!$t02_kelas_grid->Recordset && ($t02_kelas_grid->Recordset = $t02_kelas_grid->LoadRecordset()))
			$t02_kelas_grid->TotalRecs = $t02_kelas_grid->Recordset->RecordCount();
	}
	$t02_kelas_grid->StartRec = 1;
	$t02_kelas_grid->DisplayRecs = $t02_kelas_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t02_kelas_grid->Recordset = $t02_kelas_grid->LoadRecordset($t02_kelas_grid->StartRec-1, $t02_kelas_grid->DisplayRecs);

	// Set no record found message
	if ($t02_kelas->CurrentAction == "" && $t02_kelas_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t02_kelas_grid->setWarningMessage(ew_DeniedMsg());
		if ($t02_kelas_grid->SearchWhere == "0=101")
			$t02_kelas_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t02_kelas_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t02_kelas_grid->RenderOtherOptions();
?>
<?php $t02_kelas_grid->ShowPageHeader(); ?>
<?php
$t02_kelas_grid->ShowMessage();
?>
<?php if ($t02_kelas_grid->TotalRecs > 0 || $t02_kelas->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t02_kelas">
<div id="ft02_kelasgrid" class="ewForm form-inline">
<?php if ($t02_kelas_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t02_kelas_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t02_kelas" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t02_kelasgrid" class="table ewTable">
<?php echo $t02_kelas->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t02_kelas_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t02_kelas_grid->RenderListOptions();

// Render list options (header, left)
$t02_kelas_grid->ListOptions->Render("header", "left");
?>
<?php if ($t02_kelas->sekolah_id->Visible) { // sekolah_id ?>
	<?php if ($t02_kelas->SortUrl($t02_kelas->sekolah_id) == "") { ?>
		<th data-name="sekolah_id"><div id="elh_t02_kelas_sekolah_id" class="t02_kelas_sekolah_id"><div class="ewTableHeaderCaption"><?php echo $t02_kelas->sekolah_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="sekolah_id"><div><div id="elh_t02_kelas_sekolah_id" class="t02_kelas_sekolah_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t02_kelas->sekolah_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t02_kelas->sekolah_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t02_kelas->sekolah_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t02_kelas->Nama->Visible) { // Nama ?>
	<?php if ($t02_kelas->SortUrl($t02_kelas->Nama) == "") { ?>
		<th data-name="Nama"><div id="elh_t02_kelas_Nama" class="t02_kelas_Nama"><div class="ewTableHeaderCaption"><?php echo $t02_kelas->Nama->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nama"><div><div id="elh_t02_kelas_Nama" class="t02_kelas_Nama">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t02_kelas->Nama->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t02_kelas->Nama->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t02_kelas->Nama->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t02_kelas_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t02_kelas_grid->StartRec = 1;
$t02_kelas_grid->StopRec = $t02_kelas_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t02_kelas_grid->FormKeyCountName) && ($t02_kelas->CurrentAction == "gridadd" || $t02_kelas->CurrentAction == "gridedit" || $t02_kelas->CurrentAction == "F")) {
		$t02_kelas_grid->KeyCount = $objForm->GetValue($t02_kelas_grid->FormKeyCountName);
		$t02_kelas_grid->StopRec = $t02_kelas_grid->StartRec + $t02_kelas_grid->KeyCount - 1;
	}
}
$t02_kelas_grid->RecCnt = $t02_kelas_grid->StartRec - 1;
if ($t02_kelas_grid->Recordset && !$t02_kelas_grid->Recordset->EOF) {
	$t02_kelas_grid->Recordset->MoveFirst();
	$bSelectLimit = $t02_kelas_grid->UseSelectLimit;
	if (!$bSelectLimit && $t02_kelas_grid->StartRec > 1)
		$t02_kelas_grid->Recordset->Move($t02_kelas_grid->StartRec - 1);
} elseif (!$t02_kelas->AllowAddDeleteRow && $t02_kelas_grid->StopRec == 0) {
	$t02_kelas_grid->StopRec = $t02_kelas->GridAddRowCount;
}

// Initialize aggregate
$t02_kelas->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t02_kelas->ResetAttrs();
$t02_kelas_grid->RenderRow();
if ($t02_kelas->CurrentAction == "gridadd")
	$t02_kelas_grid->RowIndex = 0;
if ($t02_kelas->CurrentAction == "gridedit")
	$t02_kelas_grid->RowIndex = 0;
while ($t02_kelas_grid->RecCnt < $t02_kelas_grid->StopRec) {
	$t02_kelas_grid->RecCnt++;
	if (intval($t02_kelas_grid->RecCnt) >= intval($t02_kelas_grid->StartRec)) {
		$t02_kelas_grid->RowCnt++;
		if ($t02_kelas->CurrentAction == "gridadd" || $t02_kelas->CurrentAction == "gridedit" || $t02_kelas->CurrentAction == "F") {
			$t02_kelas_grid->RowIndex++;
			$objForm->Index = $t02_kelas_grid->RowIndex;
			if ($objForm->HasValue($t02_kelas_grid->FormActionName))
				$t02_kelas_grid->RowAction = strval($objForm->GetValue($t02_kelas_grid->FormActionName));
			elseif ($t02_kelas->CurrentAction == "gridadd")
				$t02_kelas_grid->RowAction = "insert";
			else
				$t02_kelas_grid->RowAction = "";
		}

		// Set up key count
		$t02_kelas_grid->KeyCount = $t02_kelas_grid->RowIndex;

		// Init row class and style
		$t02_kelas->ResetAttrs();
		$t02_kelas->CssClass = "";
		if ($t02_kelas->CurrentAction == "gridadd") {
			if ($t02_kelas->CurrentMode == "copy") {
				$t02_kelas_grid->LoadRowValues($t02_kelas_grid->Recordset); // Load row values
				$t02_kelas_grid->SetRecordKey($t02_kelas_grid->RowOldKey, $t02_kelas_grid->Recordset); // Set old record key
			} else {
				$t02_kelas_grid->LoadDefaultValues(); // Load default values
				$t02_kelas_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t02_kelas_grid->LoadRowValues($t02_kelas_grid->Recordset); // Load row values
		}
		$t02_kelas->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t02_kelas->CurrentAction == "gridadd") // Grid add
			$t02_kelas->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t02_kelas->CurrentAction == "gridadd" && $t02_kelas->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t02_kelas_grid->RestoreCurrentRowFormValues($t02_kelas_grid->RowIndex); // Restore form values
		if ($t02_kelas->CurrentAction == "gridedit") { // Grid edit
			if ($t02_kelas->EventCancelled) {
				$t02_kelas_grid->RestoreCurrentRowFormValues($t02_kelas_grid->RowIndex); // Restore form values
			}
			if ($t02_kelas_grid->RowAction == "insert")
				$t02_kelas->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t02_kelas->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t02_kelas->CurrentAction == "gridedit" && ($t02_kelas->RowType == EW_ROWTYPE_EDIT || $t02_kelas->RowType == EW_ROWTYPE_ADD) && $t02_kelas->EventCancelled) // Update failed
			$t02_kelas_grid->RestoreCurrentRowFormValues($t02_kelas_grid->RowIndex); // Restore form values
		if ($t02_kelas->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t02_kelas_grid->EditRowCnt++;
		if ($t02_kelas->CurrentAction == "F") // Confirm row
			$t02_kelas_grid->RestoreCurrentRowFormValues($t02_kelas_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t02_kelas->RowAttrs = array_merge($t02_kelas->RowAttrs, array('data-rowindex'=>$t02_kelas_grid->RowCnt, 'id'=>'r' . $t02_kelas_grid->RowCnt . '_t02_kelas', 'data-rowtype'=>$t02_kelas->RowType));

		// Render row
		$t02_kelas_grid->RenderRow();

		// Render list options
		$t02_kelas_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t02_kelas_grid->RowAction <> "delete" && $t02_kelas_grid->RowAction <> "insertdelete" && !($t02_kelas_grid->RowAction == "insert" && $t02_kelas->CurrentAction == "F" && $t02_kelas_grid->EmptyRow())) {
?>
	<tr<?php echo $t02_kelas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t02_kelas_grid->ListOptions->Render("body", "left", $t02_kelas_grid->RowCnt);
?>
	<?php if ($t02_kelas->sekolah_id->Visible) { // sekolah_id ?>
		<td data-name="sekolah_id"<?php echo $t02_kelas->sekolah_id->CellAttributes() ?>>
<?php if ($t02_kelas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($t02_kelas->sekolah_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t02_kelas_grid->RowCnt ?>_t02_kelas_sekolah_id" class="form-group t02_kelas_sekolah_id">
<span<?php echo $t02_kelas->sekolah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_kelas->sekolah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" name="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t02_kelas_grid->RowCnt ?>_t02_kelas_sekolah_id" class="form-group t02_kelas_sekolah_id">
<?php
$wrkonchange = trim(" " . @$t02_kelas->sekolah_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t02_kelas->sekolah_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t02_kelas_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="sv_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo $t02_kelas->sekolah_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->getPlaceHolder()) ?>"<?php echo $t02_kelas->sekolah_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_kelas" data-field="x_sekolah_id" data-value-separator="<?php echo $t02_kelas->sekolah_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="q_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo $t02_kelas->sekolah_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft02_kelasgrid.CreateAutoSuggest({"id":"x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id","forceSelect":false});
</script>
</span>
<?php } ?>
<input type="hidden" data-table="t02_kelas" data-field="x_sekolah_id" name="o<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="o<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->OldValue) ?>">
<?php } ?>
<?php if ($t02_kelas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($t02_kelas->sekolah_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $t02_kelas_grid->RowCnt ?>_t02_kelas_sekolah_id" class="form-group t02_kelas_sekolah_id">
<span<?php echo $t02_kelas->sekolah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_kelas->sekolah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" name="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $t02_kelas_grid->RowCnt ?>_t02_kelas_sekolah_id" class="form-group t02_kelas_sekolah_id">
<?php
$wrkonchange = trim(" " . @$t02_kelas->sekolah_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t02_kelas->sekolah_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t02_kelas_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="sv_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo $t02_kelas->sekolah_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->getPlaceHolder()) ?>"<?php echo $t02_kelas->sekolah_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_kelas" data-field="x_sekolah_id" data-value-separator="<?php echo $t02_kelas->sekolah_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="q_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo $t02_kelas->sekolah_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft02_kelasgrid.CreateAutoSuggest({"id":"x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } ?>
<?php if ($t02_kelas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t02_kelas_grid->RowCnt ?>_t02_kelas_sekolah_id" class="t02_kelas_sekolah_id">
<span<?php echo $t02_kelas->sekolah_id->ViewAttributes() ?>>
<?php echo $t02_kelas->sekolah_id->ListViewValue() ?></span>
</span>
<?php if ($t02_kelas->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t02_kelas" data-field="x_sekolah_id" name="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->FormValue) ?>">
<input type="hidden" data-table="t02_kelas" data-field="x_sekolah_id" name="o<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="o<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t02_kelas" data-field="x_sekolah_id" name="ft02_kelasgrid$x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="ft02_kelasgrid$x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->FormValue) ?>">
<input type="hidden" data-table="t02_kelas" data-field="x_sekolah_id" name="ft02_kelasgrid$o<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="ft02_kelasgrid$o<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t02_kelas_grid->PageObjName . "_row_" . $t02_kelas_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t02_kelas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t02_kelas" data-field="x_id" name="x<?php echo $t02_kelas_grid->RowIndex ?>_id" id="x<?php echo $t02_kelas_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t02_kelas->id->CurrentValue) ?>">
<input type="hidden" data-table="t02_kelas" data-field="x_id" name="o<?php echo $t02_kelas_grid->RowIndex ?>_id" id="o<?php echo $t02_kelas_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t02_kelas->id->OldValue) ?>">
<?php } ?>
<?php if ($t02_kelas->RowType == EW_ROWTYPE_EDIT || $t02_kelas->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t02_kelas" data-field="x_id" name="x<?php echo $t02_kelas_grid->RowIndex ?>_id" id="x<?php echo $t02_kelas_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t02_kelas->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t02_kelas->Nama->Visible) { // Nama ?>
		<td data-name="Nama"<?php echo $t02_kelas->Nama->CellAttributes() ?>>
<?php if ($t02_kelas->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t02_kelas_grid->RowCnt ?>_t02_kelas_Nama" class="form-group t02_kelas_Nama">
<input type="text" data-table="t02_kelas" data-field="x_Nama" name="x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" id="x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_kelas->Nama->getPlaceHolder()) ?>" value="<?php echo $t02_kelas->Nama->EditValue ?>"<?php echo $t02_kelas->Nama->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_kelas" data-field="x_Nama" name="o<?php echo $t02_kelas_grid->RowIndex ?>_Nama" id="o<?php echo $t02_kelas_grid->RowIndex ?>_Nama" value="<?php echo ew_HtmlEncode($t02_kelas->Nama->OldValue) ?>">
<?php } ?>
<?php if ($t02_kelas->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t02_kelas_grid->RowCnt ?>_t02_kelas_Nama" class="form-group t02_kelas_Nama">
<input type="text" data-table="t02_kelas" data-field="x_Nama" name="x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" id="x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_kelas->Nama->getPlaceHolder()) ?>" value="<?php echo $t02_kelas->Nama->EditValue ?>"<?php echo $t02_kelas->Nama->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t02_kelas->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t02_kelas_grid->RowCnt ?>_t02_kelas_Nama" class="t02_kelas_Nama">
<span<?php echo $t02_kelas->Nama->ViewAttributes() ?>>
<?php echo $t02_kelas->Nama->ListViewValue() ?></span>
</span>
<?php if ($t02_kelas->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t02_kelas" data-field="x_Nama" name="x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" id="x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" value="<?php echo ew_HtmlEncode($t02_kelas->Nama->FormValue) ?>">
<input type="hidden" data-table="t02_kelas" data-field="x_Nama" name="o<?php echo $t02_kelas_grid->RowIndex ?>_Nama" id="o<?php echo $t02_kelas_grid->RowIndex ?>_Nama" value="<?php echo ew_HtmlEncode($t02_kelas->Nama->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t02_kelas" data-field="x_Nama" name="ft02_kelasgrid$x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" id="ft02_kelasgrid$x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" value="<?php echo ew_HtmlEncode($t02_kelas->Nama->FormValue) ?>">
<input type="hidden" data-table="t02_kelas" data-field="x_Nama" name="ft02_kelasgrid$o<?php echo $t02_kelas_grid->RowIndex ?>_Nama" id="ft02_kelasgrid$o<?php echo $t02_kelas_grid->RowIndex ?>_Nama" value="<?php echo ew_HtmlEncode($t02_kelas->Nama->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t02_kelas_grid->ListOptions->Render("body", "right", $t02_kelas_grid->RowCnt);
?>
	</tr>
<?php if ($t02_kelas->RowType == EW_ROWTYPE_ADD || $t02_kelas->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft02_kelasgrid.UpdateOpts(<?php echo $t02_kelas_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t02_kelas->CurrentAction <> "gridadd" || $t02_kelas->CurrentMode == "copy")
		if (!$t02_kelas_grid->Recordset->EOF) $t02_kelas_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t02_kelas->CurrentMode == "add" || $t02_kelas->CurrentMode == "copy" || $t02_kelas->CurrentMode == "edit") {
		$t02_kelas_grid->RowIndex = '$rowindex$';
		$t02_kelas_grid->LoadDefaultValues();

		// Set row properties
		$t02_kelas->ResetAttrs();
		$t02_kelas->RowAttrs = array_merge($t02_kelas->RowAttrs, array('data-rowindex'=>$t02_kelas_grid->RowIndex, 'id'=>'r0_t02_kelas', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t02_kelas->RowAttrs["class"], "ewTemplate");
		$t02_kelas->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t02_kelas_grid->RenderRow();

		// Render list options
		$t02_kelas_grid->RenderListOptions();
		$t02_kelas_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t02_kelas->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t02_kelas_grid->ListOptions->Render("body", "left", $t02_kelas_grid->RowIndex);
?>
	<?php if ($t02_kelas->sekolah_id->Visible) { // sekolah_id ?>
		<td data-name="sekolah_id">
<?php if ($t02_kelas->CurrentAction <> "F") { ?>
<?php if ($t02_kelas->sekolah_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_t02_kelas_sekolah_id" class="form-group t02_kelas_sekolah_id">
<span<?php echo $t02_kelas->sekolah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_kelas->sekolah_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" name="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_t02_kelas_sekolah_id" class="form-group t02_kelas_sekolah_id">
<?php
$wrkonchange = trim(" " . @$t02_kelas->sekolah_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t02_kelas->sekolah_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t02_kelas_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="sv_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo $t02_kelas->sekolah_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->getPlaceHolder()) ?>"<?php echo $t02_kelas->sekolah_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t02_kelas" data-field="x_sekolah_id" data-value-separator="<?php echo $t02_kelas->sekolah_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="q_x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo $t02_kelas->sekolah_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft02_kelasgrid.CreateAutoSuggest({"id":"x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_t02_kelas_sekolah_id" class="form-group t02_kelas_sekolah_id">
<span<?php echo $t02_kelas->sekolah_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_kelas->sekolah_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t02_kelas" data-field="x_sekolah_id" name="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="x<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t02_kelas" data-field="x_sekolah_id" name="o<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" id="o<?php echo $t02_kelas_grid->RowIndex ?>_sekolah_id" value="<?php echo ew_HtmlEncode($t02_kelas->sekolah_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t02_kelas->Nama->Visible) { // Nama ?>
		<td data-name="Nama">
<?php if ($t02_kelas->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t02_kelas_Nama" class="form-group t02_kelas_Nama">
<input type="text" data-table="t02_kelas" data-field="x_Nama" name="x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" id="x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($t02_kelas->Nama->getPlaceHolder()) ?>" value="<?php echo $t02_kelas->Nama->EditValue ?>"<?php echo $t02_kelas->Nama->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t02_kelas_Nama" class="form-group t02_kelas_Nama">
<span<?php echo $t02_kelas->Nama->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t02_kelas->Nama->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t02_kelas" data-field="x_Nama" name="x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" id="x<?php echo $t02_kelas_grid->RowIndex ?>_Nama" value="<?php echo ew_HtmlEncode($t02_kelas->Nama->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t02_kelas" data-field="x_Nama" name="o<?php echo $t02_kelas_grid->RowIndex ?>_Nama" id="o<?php echo $t02_kelas_grid->RowIndex ?>_Nama" value="<?php echo ew_HtmlEncode($t02_kelas->Nama->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t02_kelas_grid->ListOptions->Render("body", "right", $t02_kelas_grid->RowCnt);
?>
<script type="text/javascript">
ft02_kelasgrid.UpdateOpts(<?php echo $t02_kelas_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t02_kelas->CurrentMode == "add" || $t02_kelas->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t02_kelas_grid->FormKeyCountName ?>" id="<?php echo $t02_kelas_grid->FormKeyCountName ?>" value="<?php echo $t02_kelas_grid->KeyCount ?>">
<?php echo $t02_kelas_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t02_kelas->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t02_kelas_grid->FormKeyCountName ?>" id="<?php echo $t02_kelas_grid->FormKeyCountName ?>" value="<?php echo $t02_kelas_grid->KeyCount ?>">
<?php echo $t02_kelas_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t02_kelas->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft02_kelasgrid">
</div>
<?php

// Close recordset
if ($t02_kelas_grid->Recordset)
	$t02_kelas_grid->Recordset->Close();
?>
<?php if ($t02_kelas_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t02_kelas_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t02_kelas_grid->TotalRecs == 0 && $t02_kelas->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t02_kelas_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t02_kelas->Export == "") { ?>
<script type="text/javascript">
ft02_kelasgrid.Init();
</script>
<?php } ?>
<?php
$t02_kelas_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t02_kelas_grid->Page_Terminate();
?>
