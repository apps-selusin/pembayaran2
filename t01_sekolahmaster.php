<?php

// Nomor_Induk
// Nama
// Alamat

?>
<?php if ($t01_sekolah->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t01_sekolah->TableCaption() ?></h4> -->
<table id="tbl_t01_sekolahmaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t01_sekolah->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t01_sekolah->Nomor_Induk->Visible) { // Nomor_Induk ?>
		<tr id="r_Nomor_Induk">
			<td><?php echo $t01_sekolah->Nomor_Induk->FldCaption() ?></td>
			<td<?php echo $t01_sekolah->Nomor_Induk->CellAttributes() ?>>
<span id="el_t01_sekolah_Nomor_Induk">
<span<?php echo $t01_sekolah->Nomor_Induk->ViewAttributes() ?>>
<?php echo $t01_sekolah->Nomor_Induk->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t01_sekolah->Nama->Visible) { // Nama ?>
		<tr id="r_Nama">
			<td><?php echo $t01_sekolah->Nama->FldCaption() ?></td>
			<td<?php echo $t01_sekolah->Nama->CellAttributes() ?>>
<span id="el_t01_sekolah_Nama">
<span<?php echo $t01_sekolah->Nama->ViewAttributes() ?>>
<?php echo $t01_sekolah->Nama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t01_sekolah->Alamat->Visible) { // Alamat ?>
		<tr id="r_Alamat">
			<td><?php echo $t01_sekolah->Alamat->FldCaption() ?></td>
			<td<?php echo $t01_sekolah->Alamat->CellAttributes() ?>>
<span id="el_t01_sekolah_Alamat">
<span<?php echo $t01_sekolah->Alamat->ViewAttributes() ?>>
<?php echo $t01_sekolah->Alamat->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
