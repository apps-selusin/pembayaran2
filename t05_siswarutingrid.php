<?php include_once "t96_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t05_siswarutin_grid)) $t05_siswarutin_grid = new ct05_siswarutin_grid();

// Page init
$t05_siswarutin_grid->Page_Init();

// Page main
$t05_siswarutin_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t05_siswarutin_grid->Page_Render();
?>
<?php if ($t05_siswarutin->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft05_siswarutingrid = new ew_Form("ft05_siswarutingrid", "grid");
ft05_siswarutingrid.FormKeyCountName = '<?php echo $t05_siswarutin_grid->FormKeyCountName ?>';

// Validate form
ft05_siswarutingrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_rutin_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t05_siswarutin->rutin_id->FldCaption(), $t05_siswarutin->rutin_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nilai");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t05_siswarutin->Nilai->FldCaption(), $t05_siswarutin->Nilai->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nilai");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t05_siswarutin->Nilai->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft05_siswarutingrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "rutin_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Nilai", false)) return false;
	return true;
}

// Form_CustomValidate event
ft05_siswarutingrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft05_siswarutingrid.ValidateRequired = true;
<?php } else { ?>
ft05_siswarutingrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft05_siswarutingrid.Lists["x_rutin_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Nama","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t04_rutin"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t05_siswarutin->CurrentAction == "gridadd") {
	if ($t05_siswarutin->CurrentMode == "copy") {
		$bSelectLimit = $t05_siswarutin_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t05_siswarutin_grid->TotalRecs = $t05_siswarutin->SelectRecordCount();
			$t05_siswarutin_grid->Recordset = $t05_siswarutin_grid->LoadRecordset($t05_siswarutin_grid->StartRec-1, $t05_siswarutin_grid->DisplayRecs);
		} else {
			if ($t05_siswarutin_grid->Recordset = $t05_siswarutin_grid->LoadRecordset())
				$t05_siswarutin_grid->TotalRecs = $t05_siswarutin_grid->Recordset->RecordCount();
		}
		$t05_siswarutin_grid->StartRec = 1;
		$t05_siswarutin_grid->DisplayRecs = $t05_siswarutin_grid->TotalRecs;
	} else {
		$t05_siswarutin->CurrentFilter = "0=1";
		$t05_siswarutin_grid->StartRec = 1;
		$t05_siswarutin_grid->DisplayRecs = $t05_siswarutin->GridAddRowCount;
	}
	$t05_siswarutin_grid->TotalRecs = $t05_siswarutin_grid->DisplayRecs;
	$t05_siswarutin_grid->StopRec = $t05_siswarutin_grid->DisplayRecs;
} else {
	$bSelectLimit = $t05_siswarutin_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t05_siswarutin_grid->TotalRecs <= 0)
			$t05_siswarutin_grid->TotalRecs = $t05_siswarutin->SelectRecordCount();
	} else {
		if (!$t05_siswarutin_grid->Recordset && ($t05_siswarutin_grid->Recordset = $t05_siswarutin_grid->LoadRecordset()))
			$t05_siswarutin_grid->TotalRecs = $t05_siswarutin_grid->Recordset->RecordCount();
	}
	$t05_siswarutin_grid->StartRec = 1;
	$t05_siswarutin_grid->DisplayRecs = $t05_siswarutin_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t05_siswarutin_grid->Recordset = $t05_siswarutin_grid->LoadRecordset($t05_siswarutin_grid->StartRec-1, $t05_siswarutin_grid->DisplayRecs);

	// Set no record found message
	if ($t05_siswarutin->CurrentAction == "" && $t05_siswarutin_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t05_siswarutin_grid->setWarningMessage(ew_DeniedMsg());
		if ($t05_siswarutin_grid->SearchWhere == "0=101")
			$t05_siswarutin_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t05_siswarutin_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t05_siswarutin_grid->RenderOtherOptions();
?>
<?php $t05_siswarutin_grid->ShowPageHeader(); ?>
<?php
$t05_siswarutin_grid->ShowMessage();
?>
<?php if ($t05_siswarutin_grid->TotalRecs > 0 || $t05_siswarutin->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t05_siswarutin">
<div id="ft05_siswarutingrid" class="ewForm form-inline">
<?php if ($t05_siswarutin_grid->ShowOtherOptions) { ?>
<div class="panel-heading ewGridUpperPanel">
<?php
	foreach ($t05_siswarutin_grid->OtherOptions as &$option)
		$option->Render("body");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<div id="gmp_t05_siswarutin" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t05_siswarutingrid" class="table ewTable">
<?php echo $t05_siswarutin->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t05_siswarutin_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t05_siswarutin_grid->RenderListOptions();

// Render list options (header, left)
$t05_siswarutin_grid->ListOptions->Render("header", "left");
?>
<?php if ($t05_siswarutin->rutin_id->Visible) { // rutin_id ?>
	<?php if ($t05_siswarutin->SortUrl($t05_siswarutin->rutin_id) == "") { ?>
		<th data-name="rutin_id"><div id="elh_t05_siswarutin_rutin_id" class="t05_siswarutin_rutin_id"><div class="ewTableHeaderCaption"><?php echo $t05_siswarutin->rutin_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="rutin_id"><div><div id="elh_t05_siswarutin_rutin_id" class="t05_siswarutin_rutin_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t05_siswarutin->rutin_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t05_siswarutin->rutin_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t05_siswarutin->rutin_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t05_siswarutin->Nilai->Visible) { // Nilai ?>
	<?php if ($t05_siswarutin->SortUrl($t05_siswarutin->Nilai) == "") { ?>
		<th data-name="Nilai"><div id="elh_t05_siswarutin_Nilai" class="t05_siswarutin_Nilai"><div class="ewTableHeaderCaption"><?php echo $t05_siswarutin->Nilai->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai"><div><div id="elh_t05_siswarutin_Nilai" class="t05_siswarutin_Nilai">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t05_siswarutin->Nilai->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t05_siswarutin->Nilai->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t05_siswarutin->Nilai->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t05_siswarutin_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t05_siswarutin_grid->StartRec = 1;
$t05_siswarutin_grid->StopRec = $t05_siswarutin_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t05_siswarutin_grid->FormKeyCountName) && ($t05_siswarutin->CurrentAction == "gridadd" || $t05_siswarutin->CurrentAction == "gridedit" || $t05_siswarutin->CurrentAction == "F")) {
		$t05_siswarutin_grid->KeyCount = $objForm->GetValue($t05_siswarutin_grid->FormKeyCountName);
		$t05_siswarutin_grid->StopRec = $t05_siswarutin_grid->StartRec + $t05_siswarutin_grid->KeyCount - 1;
	}
}
$t05_siswarutin_grid->RecCnt = $t05_siswarutin_grid->StartRec - 1;
if ($t05_siswarutin_grid->Recordset && !$t05_siswarutin_grid->Recordset->EOF) {
	$t05_siswarutin_grid->Recordset->MoveFirst();
	$bSelectLimit = $t05_siswarutin_grid->UseSelectLimit;
	if (!$bSelectLimit && $t05_siswarutin_grid->StartRec > 1)
		$t05_siswarutin_grid->Recordset->Move($t05_siswarutin_grid->StartRec - 1);
} elseif (!$t05_siswarutin->AllowAddDeleteRow && $t05_siswarutin_grid->StopRec == 0) {
	$t05_siswarutin_grid->StopRec = $t05_siswarutin->GridAddRowCount;
}

// Initialize aggregate
$t05_siswarutin->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t05_siswarutin->ResetAttrs();
$t05_siswarutin_grid->RenderRow();
if ($t05_siswarutin->CurrentAction == "gridadd")
	$t05_siswarutin_grid->RowIndex = 0;
if ($t05_siswarutin->CurrentAction == "gridedit")
	$t05_siswarutin_grid->RowIndex = 0;
while ($t05_siswarutin_grid->RecCnt < $t05_siswarutin_grid->StopRec) {
	$t05_siswarutin_grid->RecCnt++;
	if (intval($t05_siswarutin_grid->RecCnt) >= intval($t05_siswarutin_grid->StartRec)) {
		$t05_siswarutin_grid->RowCnt++;
		if ($t05_siswarutin->CurrentAction == "gridadd" || $t05_siswarutin->CurrentAction == "gridedit" || $t05_siswarutin->CurrentAction == "F") {
			$t05_siswarutin_grid->RowIndex++;
			$objForm->Index = $t05_siswarutin_grid->RowIndex;
			if ($objForm->HasValue($t05_siswarutin_grid->FormActionName))
				$t05_siswarutin_grid->RowAction = strval($objForm->GetValue($t05_siswarutin_grid->FormActionName));
			elseif ($t05_siswarutin->CurrentAction == "gridadd")
				$t05_siswarutin_grid->RowAction = "insert";
			else
				$t05_siswarutin_grid->RowAction = "";
		}

		// Set up key count
		$t05_siswarutin_grid->KeyCount = $t05_siswarutin_grid->RowIndex;

		// Init row class and style
		$t05_siswarutin->ResetAttrs();
		$t05_siswarutin->CssClass = "";
		if ($t05_siswarutin->CurrentAction == "gridadd") {
			if ($t05_siswarutin->CurrentMode == "copy") {
				$t05_siswarutin_grid->LoadRowValues($t05_siswarutin_grid->Recordset); // Load row values
				$t05_siswarutin_grid->SetRecordKey($t05_siswarutin_grid->RowOldKey, $t05_siswarutin_grid->Recordset); // Set old record key
			} else {
				$t05_siswarutin_grid->LoadDefaultValues(); // Load default values
				$t05_siswarutin_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t05_siswarutin_grid->LoadRowValues($t05_siswarutin_grid->Recordset); // Load row values
		}
		$t05_siswarutin->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t05_siswarutin->CurrentAction == "gridadd") // Grid add
			$t05_siswarutin->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t05_siswarutin->CurrentAction == "gridadd" && $t05_siswarutin->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t05_siswarutin_grid->RestoreCurrentRowFormValues($t05_siswarutin_grid->RowIndex); // Restore form values
		if ($t05_siswarutin->CurrentAction == "gridedit") { // Grid edit
			if ($t05_siswarutin->EventCancelled) {
				$t05_siswarutin_grid->RestoreCurrentRowFormValues($t05_siswarutin_grid->RowIndex); // Restore form values
			}
			if ($t05_siswarutin_grid->RowAction == "insert")
				$t05_siswarutin->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t05_siswarutin->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t05_siswarutin->CurrentAction == "gridedit" && ($t05_siswarutin->RowType == EW_ROWTYPE_EDIT || $t05_siswarutin->RowType == EW_ROWTYPE_ADD) && $t05_siswarutin->EventCancelled) // Update failed
			$t05_siswarutin_grid->RestoreCurrentRowFormValues($t05_siswarutin_grid->RowIndex); // Restore form values
		if ($t05_siswarutin->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t05_siswarutin_grid->EditRowCnt++;
		if ($t05_siswarutin->CurrentAction == "F") // Confirm row
			$t05_siswarutin_grid->RestoreCurrentRowFormValues($t05_siswarutin_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t05_siswarutin->RowAttrs = array_merge($t05_siswarutin->RowAttrs, array('data-rowindex'=>$t05_siswarutin_grid->RowCnt, 'id'=>'r' . $t05_siswarutin_grid->RowCnt . '_t05_siswarutin', 'data-rowtype'=>$t05_siswarutin->RowType));

		// Render row
		$t05_siswarutin_grid->RenderRow();

		// Render list options
		$t05_siswarutin_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t05_siswarutin_grid->RowAction <> "delete" && $t05_siswarutin_grid->RowAction <> "insertdelete" && !($t05_siswarutin_grid->RowAction == "insert" && $t05_siswarutin->CurrentAction == "F" && $t05_siswarutin_grid->EmptyRow())) {
?>
	<tr<?php echo $t05_siswarutin->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t05_siswarutin_grid->ListOptions->Render("body", "left", $t05_siswarutin_grid->RowCnt);
?>
	<?php if ($t05_siswarutin->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id"<?php echo $t05_siswarutin->rutin_id->CellAttributes() ?>>
<?php if ($t05_siswarutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t05_siswarutin_grid->RowCnt ?>_t05_siswarutin_rutin_id" class="form-group t05_siswarutin_rutin_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id"><?php echo (strval($t05_siswarutin->rutin_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t05_siswarutin->rutin_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t05_siswarutin->rutin_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t05_siswarutin" data-field="x_rutin_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t05_siswarutin->rutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo $t05_siswarutin->rutin_id->CurrentValue ?>"<?php echo $t05_siswarutin->rutin_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="s_x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo $t05_siswarutin->rutin_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t05_siswarutin" data-field="x_rutin_id" name="o<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="o<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t05_siswarutin->rutin_id->OldValue) ?>">
<?php } ?>
<?php if ($t05_siswarutin->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t05_siswarutin_grid->RowCnt ?>_t05_siswarutin_rutin_id" class="form-group t05_siswarutin_rutin_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id"><?php echo (strval($t05_siswarutin->rutin_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t05_siswarutin->rutin_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t05_siswarutin->rutin_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t05_siswarutin" data-field="x_rutin_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t05_siswarutin->rutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo $t05_siswarutin->rutin_id->CurrentValue ?>"<?php echo $t05_siswarutin->rutin_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="s_x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo $t05_siswarutin->rutin_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t05_siswarutin->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t05_siswarutin_grid->RowCnt ?>_t05_siswarutin_rutin_id" class="t05_siswarutin_rutin_id">
<span<?php echo $t05_siswarutin->rutin_id->ViewAttributes() ?>>
<?php echo $t05_siswarutin->rutin_id->ListViewValue() ?></span>
</span>
<?php if ($t05_siswarutin->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t05_siswarutin" data-field="x_rutin_id" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t05_siswarutin->rutin_id->FormValue) ?>">
<input type="hidden" data-table="t05_siswarutin" data-field="x_rutin_id" name="o<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="o<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t05_siswarutin->rutin_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t05_siswarutin" data-field="x_rutin_id" name="ft05_siswarutingrid$x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="ft05_siswarutingrid$x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t05_siswarutin->rutin_id->FormValue) ?>">
<input type="hidden" data-table="t05_siswarutin" data-field="x_rutin_id" name="ft05_siswarutingrid$o<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="ft05_siswarutingrid$o<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t05_siswarutin->rutin_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t05_siswarutin_grid->PageObjName . "_row_" . $t05_siswarutin_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t05_siswarutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t05_siswarutin" data-field="x_id" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_id" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t05_siswarutin->id->CurrentValue) ?>">
<input type="hidden" data-table="t05_siswarutin" data-field="x_id" name="o<?php echo $t05_siswarutin_grid->RowIndex ?>_id" id="o<?php echo $t05_siswarutin_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t05_siswarutin->id->OldValue) ?>">
<?php } ?>
<?php if ($t05_siswarutin->RowType == EW_ROWTYPE_EDIT || $t05_siswarutin->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t05_siswarutin" data-field="x_id" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_id" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t05_siswarutin->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t05_siswarutin->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai"<?php echo $t05_siswarutin->Nilai->CellAttributes() ?>>
<?php if ($t05_siswarutin->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t05_siswarutin_grid->RowCnt ?>_t05_siswarutin_Nilai" class="form-group t05_siswarutin_Nilai">
<input type="text" data-table="t05_siswarutin" data-field="x_Nilai" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" size="30" placeholder="<?php echo ew_HtmlEncode($t05_siswarutin->Nilai->getPlaceHolder()) ?>" value="<?php echo $t05_siswarutin->Nilai->EditValue ?>"<?php echo $t05_siswarutin->Nilai->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t05_siswarutin" data-field="x_Nilai" name="o<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" id="o<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t05_siswarutin->Nilai->OldValue) ?>">
<?php } ?>
<?php if ($t05_siswarutin->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t05_siswarutin_grid->RowCnt ?>_t05_siswarutin_Nilai" class="form-group t05_siswarutin_Nilai">
<input type="text" data-table="t05_siswarutin" data-field="x_Nilai" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" size="30" placeholder="<?php echo ew_HtmlEncode($t05_siswarutin->Nilai->getPlaceHolder()) ?>" value="<?php echo $t05_siswarutin->Nilai->EditValue ?>"<?php echo $t05_siswarutin->Nilai->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t05_siswarutin->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t05_siswarutin_grid->RowCnt ?>_t05_siswarutin_Nilai" class="t05_siswarutin_Nilai">
<span<?php echo $t05_siswarutin->Nilai->ViewAttributes() ?>>
<?php echo $t05_siswarutin->Nilai->ListViewValue() ?></span>
</span>
<?php if ($t05_siswarutin->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t05_siswarutin" data-field="x_Nilai" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t05_siswarutin->Nilai->FormValue) ?>">
<input type="hidden" data-table="t05_siswarutin" data-field="x_Nilai" name="o<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" id="o<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t05_siswarutin->Nilai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t05_siswarutin" data-field="x_Nilai" name="ft05_siswarutingrid$x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" id="ft05_siswarutingrid$x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t05_siswarutin->Nilai->FormValue) ?>">
<input type="hidden" data-table="t05_siswarutin" data-field="x_Nilai" name="ft05_siswarutingrid$o<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" id="ft05_siswarutingrid$o<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t05_siswarutin->Nilai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t05_siswarutin_grid->ListOptions->Render("body", "right", $t05_siswarutin_grid->RowCnt);
?>
	</tr>
<?php if ($t05_siswarutin->RowType == EW_ROWTYPE_ADD || $t05_siswarutin->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft05_siswarutingrid.UpdateOpts(<?php echo $t05_siswarutin_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t05_siswarutin->CurrentAction <> "gridadd" || $t05_siswarutin->CurrentMode == "copy")
		if (!$t05_siswarutin_grid->Recordset->EOF) $t05_siswarutin_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t05_siswarutin->CurrentMode == "add" || $t05_siswarutin->CurrentMode == "copy" || $t05_siswarutin->CurrentMode == "edit") {
		$t05_siswarutin_grid->RowIndex = '$rowindex$';
		$t05_siswarutin_grid->LoadDefaultValues();

		// Set row properties
		$t05_siswarutin->ResetAttrs();
		$t05_siswarutin->RowAttrs = array_merge($t05_siswarutin->RowAttrs, array('data-rowindex'=>$t05_siswarutin_grid->RowIndex, 'id'=>'r0_t05_siswarutin', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t05_siswarutin->RowAttrs["class"], "ewTemplate");
		$t05_siswarutin->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t05_siswarutin_grid->RenderRow();

		// Render list options
		$t05_siswarutin_grid->RenderListOptions();
		$t05_siswarutin_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t05_siswarutin->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t05_siswarutin_grid->ListOptions->Render("body", "left", $t05_siswarutin_grid->RowIndex);
?>
	<?php if ($t05_siswarutin->rutin_id->Visible) { // rutin_id ?>
		<td data-name="rutin_id">
<?php if ($t05_siswarutin->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t05_siswarutin_rutin_id" class="form-group t05_siswarutin_rutin_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id"><?php echo (strval($t05_siswarutin->rutin_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $t05_siswarutin->rutin_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($t05_siswarutin->rutin_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="t05_siswarutin" data-field="x_rutin_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $t05_siswarutin->rutin_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo $t05_siswarutin->rutin_id->CurrentValue ?>"<?php echo $t05_siswarutin->rutin_id->EditAttributes() ?>>
<input type="hidden" name="s_x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="s_x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo $t05_siswarutin->rutin_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t05_siswarutin_rutin_id" class="form-group t05_siswarutin_rutin_id">
<span<?php echo $t05_siswarutin->rutin_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t05_siswarutin->rutin_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t05_siswarutin" data-field="x_rutin_id" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t05_siswarutin->rutin_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t05_siswarutin" data-field="x_rutin_id" name="o<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" id="o<?php echo $t05_siswarutin_grid->RowIndex ?>_rutin_id" value="<?php echo ew_HtmlEncode($t05_siswarutin->rutin_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t05_siswarutin->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai">
<?php if ($t05_siswarutin->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t05_siswarutin_Nilai" class="form-group t05_siswarutin_Nilai">
<input type="text" data-table="t05_siswarutin" data-field="x_Nilai" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" size="30" placeholder="<?php echo ew_HtmlEncode($t05_siswarutin->Nilai->getPlaceHolder()) ?>" value="<?php echo $t05_siswarutin->Nilai->EditValue ?>"<?php echo $t05_siswarutin->Nilai->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t05_siswarutin_Nilai" class="form-group t05_siswarutin_Nilai">
<span<?php echo $t05_siswarutin->Nilai->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t05_siswarutin->Nilai->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t05_siswarutin" data-field="x_Nilai" name="x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" id="x<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t05_siswarutin->Nilai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t05_siswarutin" data-field="x_Nilai" name="o<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" id="o<?php echo $t05_siswarutin_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t05_siswarutin->Nilai->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t05_siswarutin_grid->ListOptions->Render("body", "right", $t05_siswarutin_grid->RowCnt);
?>
<script type="text/javascript">
ft05_siswarutingrid.UpdateOpts(<?php echo $t05_siswarutin_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t05_siswarutin->CurrentMode == "add" || $t05_siswarutin->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t05_siswarutin_grid->FormKeyCountName ?>" id="<?php echo $t05_siswarutin_grid->FormKeyCountName ?>" value="<?php echo $t05_siswarutin_grid->KeyCount ?>">
<?php echo $t05_siswarutin_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t05_siswarutin->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t05_siswarutin_grid->FormKeyCountName ?>" id="<?php echo $t05_siswarutin_grid->FormKeyCountName ?>" value="<?php echo $t05_siswarutin_grid->KeyCount ?>">
<?php echo $t05_siswarutin_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t05_siswarutin->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft05_siswarutingrid">
</div>
<?php

// Close recordset
if ($t05_siswarutin_grid->Recordset)
	$t05_siswarutin_grid->Recordset->Close();
?>
<?php if ($t05_siswarutin_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t05_siswarutin_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t05_siswarutin_grid->TotalRecs == 0 && $t05_siswarutin->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t05_siswarutin_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t05_siswarutin->Export == "") { ?>
<script type="text/javascript">
ft05_siswarutingrid.Init();
</script>
<?php } ?>
<?php
$t05_siswarutin_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t05_siswarutin_grid->Page_Terminate();
?>
