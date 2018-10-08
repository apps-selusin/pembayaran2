<?php

// rutin_id
// Nilai

?>
<?php if ($t05_siswarutin->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t05_siswarutin->TableCaption() ?></h4> -->
<table id="tbl_t05_siswarutinmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t05_siswarutin->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t05_siswarutin->rutin_id->Visible) { // rutin_id ?>
		<tr id="r_rutin_id">
			<td><?php echo $t05_siswarutin->rutin_id->FldCaption() ?></td>
			<td<?php echo $t05_siswarutin->rutin_id->CellAttributes() ?>>
<span id="el_t05_siswarutin_rutin_id">
<span<?php echo $t05_siswarutin->rutin_id->ViewAttributes() ?>>
<?php echo $t05_siswarutin->rutin_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t05_siswarutin->Nilai->Visible) { // Nilai ?>
		<tr id="r_Nilai">
			<td><?php echo $t05_siswarutin->Nilai->FldCaption() ?></td>
			<td<?php echo $t05_siswarutin->Nilai->CellAttributes() ?>>
<span id="el_t05_siswarutin_Nilai">
<span<?php echo $t05_siswarutin->Nilai->ViewAttributes() ?>>
<?php echo $t05_siswarutin->Nilai->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
