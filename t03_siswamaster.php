<?php

// tahunajaran_id
// kelas_id
// Nomor_Induk
// Nama

?>
<?php if ($t03_siswa->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t03_siswa->TableCaption() ?></h4> -->
<table id="tbl_t03_siswamaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t03_siswa->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t03_siswa->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<tr id="r_tahunajaran_id">
			<td><?php echo $t03_siswa->tahunajaran_id->FldCaption() ?></td>
			<td<?php echo $t03_siswa->tahunajaran_id->CellAttributes() ?>>
<span id="el_t03_siswa_tahunajaran_id">
<span<?php echo $t03_siswa->tahunajaran_id->ViewAttributes() ?>>
<?php echo $t03_siswa->tahunajaran_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_siswa->kelas_id->Visible) { // kelas_id ?>
		<tr id="r_kelas_id">
			<td><?php echo $t03_siswa->kelas_id->FldCaption() ?></td>
			<td<?php echo $t03_siswa->kelas_id->CellAttributes() ?>>
<span id="el_t03_siswa_kelas_id">
<span<?php echo $t03_siswa->kelas_id->ViewAttributes() ?>>
<?php echo $t03_siswa->kelas_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_siswa->Nomor_Induk->Visible) { // Nomor_Induk ?>
		<tr id="r_Nomor_Induk">
			<td><?php echo $t03_siswa->Nomor_Induk->FldCaption() ?></td>
			<td<?php echo $t03_siswa->Nomor_Induk->CellAttributes() ?>>
<span id="el_t03_siswa_Nomor_Induk">
<span<?php echo $t03_siswa->Nomor_Induk->ViewAttributes() ?>>
<?php echo $t03_siswa->Nomor_Induk->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t03_siswa->Nama->Visible) { // Nama ?>
		<tr id="r_Nama">
			<td><?php echo $t03_siswa->Nama->FldCaption() ?></td>
			<td<?php echo $t03_siswa->Nama->CellAttributes() ?>>
<span id="el_t03_siswa_Nama">
<span<?php echo $t03_siswa->Nama->ViewAttributes() ?>>
<?php echo $t03_siswa->Nama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
