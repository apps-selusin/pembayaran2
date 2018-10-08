<?php

// Global variable for table object
$v02_rutin = NULL;

//
// Table class for v02_rutin
//
class cv02_rutin extends cTable {
	var $tahunajaran_id;
	var $awal_bulan;
	var $awal_tahun;
	var $akhir_bulan;
	var $akhir_tahun;
	var $sekolah_id;
	var $Sekolah;
	var $kelas_id;
	var $Kelas;
	var $siswa_id;
	var $Nomor_Induk;
	var $Nama;
	var $rutin_id;
	var $Pembayaran_Rutin;
	var $nilai;
	var $id;
	var $siswarutin_id;
	var $Bulan;
	var $Tahun;
	var $Bayar_Tgl;
	var $Bayar_Jumlah;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'v02_rutin';
		$this->TableName = 'v02_rutin';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`v02_rutin`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// tahunajaran_id
		$this->tahunajaran_id = new cField('v02_rutin', 'v02_rutin', 'x_tahunajaran_id', 'tahunajaran_id', '`tahunajaran_id`', '`tahunajaran_id`', 3, -1, FALSE, '`tahunajaran_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tahunajaran_id->Sortable = TRUE; // Allow sort
		$this->tahunajaran_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tahunajaran_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->tahunajaran_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tahunajaran_id'] = &$this->tahunajaran_id;

		// awal_bulan
		$this->awal_bulan = new cField('v02_rutin', 'v02_rutin', 'x_awal_bulan', 'awal_bulan', '`awal_bulan`', '`awal_bulan`', 16, -1, FALSE, '`awal_bulan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->awal_bulan->Sortable = TRUE; // Allow sort
		$this->awal_bulan->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['awal_bulan'] = &$this->awal_bulan;

		// awal_tahun
		$this->awal_tahun = new cField('v02_rutin', 'v02_rutin', 'x_awal_tahun', 'awal_tahun', '`awal_tahun`', '`awal_tahun`', 2, -1, FALSE, '`awal_tahun`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->awal_tahun->Sortable = TRUE; // Allow sort
		$this->awal_tahun->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['awal_tahun'] = &$this->awal_tahun;

		// akhir_bulan
		$this->akhir_bulan = new cField('v02_rutin', 'v02_rutin', 'x_akhir_bulan', 'akhir_bulan', '`akhir_bulan`', '`akhir_bulan`', 16, -1, FALSE, '`akhir_bulan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->akhir_bulan->Sortable = TRUE; // Allow sort
		$this->akhir_bulan->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['akhir_bulan'] = &$this->akhir_bulan;

		// akhir_tahun
		$this->akhir_tahun = new cField('v02_rutin', 'v02_rutin', 'x_akhir_tahun', 'akhir_tahun', '`akhir_tahun`', '`akhir_tahun`', 2, -1, FALSE, '`akhir_tahun`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->akhir_tahun->Sortable = TRUE; // Allow sort
		$this->akhir_tahun->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['akhir_tahun'] = &$this->akhir_tahun;

		// sekolah_id
		$this->sekolah_id = new cField('v02_rutin', 'v02_rutin', 'x_sekolah_id', 'sekolah_id', '`sekolah_id`', '`sekolah_id`', 3, -1, FALSE, '`sekolah_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->sekolah_id->Sortable = TRUE; // Allow sort
		$this->sekolah_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['sekolah_id'] = &$this->sekolah_id;

		// Sekolah
		$this->Sekolah = new cField('v02_rutin', 'v02_rutin', 'x_Sekolah', 'Sekolah', '`Sekolah`', '`Sekolah`', 200, -1, FALSE, '`Sekolah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Sekolah->Sortable = TRUE; // Allow sort
		$this->fields['Sekolah'] = &$this->Sekolah;

		// kelas_id
		$this->kelas_id = new cField('v02_rutin', 'v02_rutin', 'x_kelas_id', 'kelas_id', '`kelas_id`', '`kelas_id`', 3, -1, FALSE, '`kelas_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->kelas_id->Sortable = TRUE; // Allow sort
		$this->kelas_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['kelas_id'] = &$this->kelas_id;

		// Kelas
		$this->Kelas = new cField('v02_rutin', 'v02_rutin', 'x_Kelas', 'Kelas', '`Kelas`', '`Kelas`', 200, -1, FALSE, '`Kelas`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Kelas->Sortable = TRUE; // Allow sort
		$this->fields['Kelas'] = &$this->Kelas;

		// siswa_id
		$this->siswa_id = new cField('v02_rutin', 'v02_rutin', 'x_siswa_id', 'siswa_id', '`siswa_id`', '`siswa_id`', 3, -1, FALSE, '`siswa_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->siswa_id->Sortable = TRUE; // Allow sort
		$this->siswa_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['siswa_id'] = &$this->siswa_id;

		// Nomor_Induk
		$this->Nomor_Induk = new cField('v02_rutin', 'v02_rutin', 'x_Nomor_Induk', 'Nomor_Induk', '`Nomor_Induk`', '`Nomor_Induk`', 200, -1, FALSE, '`Nomor_Induk`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nomor_Induk->Sortable = TRUE; // Allow sort
		$this->fields['Nomor_Induk'] = &$this->Nomor_Induk;

		// Nama
		$this->Nama = new cField('v02_rutin', 'v02_rutin', 'x_Nama', 'Nama', '`Nama`', '`Nama`', 200, -1, FALSE, '`Nama`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nama->Sortable = TRUE; // Allow sort
		$this->fields['Nama'] = &$this->Nama;

		// rutin_id
		$this->rutin_id = new cField('v02_rutin', 'v02_rutin', 'x_rutin_id', 'rutin_id', '`rutin_id`', '`rutin_id`', 3, -1, FALSE, '`rutin_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->rutin_id->Sortable = TRUE; // Allow sort
		$this->rutin_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->rutin_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->rutin_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['rutin_id'] = &$this->rutin_id;

		// Pembayaran_Rutin
		$this->Pembayaran_Rutin = new cField('v02_rutin', 'v02_rutin', 'x_Pembayaran_Rutin', 'Pembayaran_Rutin', '`Pembayaran_Rutin`', '`Pembayaran_Rutin`', 200, -1, FALSE, '`Pembayaran_Rutin`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->Pembayaran_Rutin->Sortable = TRUE; // Allow sort
		$this->Pembayaran_Rutin->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->Pembayaran_Rutin->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['Pembayaran_Rutin'] = &$this->Pembayaran_Rutin;

		// nilai
		$this->nilai = new cField('v02_rutin', 'v02_rutin', 'x_nilai', 'nilai', '`nilai`', '`nilai`', 4, -1, FALSE, '`nilai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nilai->Sortable = TRUE; // Allow sort
		$this->nilai->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['nilai'] = &$this->nilai;

		// id
		$this->id = new cField('v02_rutin', 'v02_rutin', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// siswarutin_id
		$this->siswarutin_id = new cField('v02_rutin', 'v02_rutin', 'x_siswarutin_id', 'siswarutin_id', '`siswarutin_id`', '`siswarutin_id`', 3, -1, FALSE, '`siswarutin_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->siswarutin_id->Sortable = TRUE; // Allow sort
		$this->siswarutin_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['siswarutin_id'] = &$this->siswarutin_id;

		// Bulan
		$this->Bulan = new cField('v02_rutin', 'v02_rutin', 'x_Bulan', 'Bulan', '`Bulan`', '`Bulan`', 16, -1, FALSE, '`Bulan`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Bulan->Sortable = TRUE; // Allow sort
		$this->Bulan->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Bulan'] = &$this->Bulan;

		// Tahun
		$this->Tahun = new cField('v02_rutin', 'v02_rutin', 'x_Tahun', 'Tahun', '`Tahun`', '`Tahun`', 2, -1, FALSE, '`Tahun`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Tahun->Sortable = TRUE; // Allow sort
		$this->Tahun->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Tahun'] = &$this->Tahun;

		// Bayar_Tgl
		$this->Bayar_Tgl = new cField('v02_rutin', 'v02_rutin', 'x_Bayar_Tgl', 'Bayar_Tgl', '`Bayar_Tgl`', ew_CastDateFieldForLike('`Bayar_Tgl`', 0, "DB"), 133, 0, FALSE, '`Bayar_Tgl`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Bayar_Tgl->Sortable = TRUE; // Allow sort
		$this->Bayar_Tgl->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['Bayar_Tgl'] = &$this->Bayar_Tgl;

		// Bayar_Jumlah
		$this->Bayar_Jumlah = new cField('v02_rutin', 'v02_rutin', 'x_Bayar_Jumlah', 'Bayar_Jumlah', '`Bayar_Jumlah`', '`Bayar_Jumlah`', 4, -1, FALSE, '`Bayar_Jumlah`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Bayar_Jumlah->Sortable = TRUE; // Allow sort
		$this->Bayar_Jumlah->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Bayar_Jumlah'] = &$this->Bayar_Jumlah;
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`v02_rutin`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		$cnt = -1;
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match("/^SELECT \* FROM/i", $sSql)) {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->Insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				ew_AddFilter($where, ew_QuotedName('id', $this->DBID) . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "v02_rutinlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "v02_rutinlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("v02_rutinview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("v02_rutinview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "v02_rutinadd.php?" . $this->UrlParm($parm);
		else
			$url = "v02_rutinadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("v02_rutinedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("v02_rutinadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("v02_rutindelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "id:" . ew_VarToJson($this->id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsHttpPost();
			if ($isPost && isset($_POST["id"]))
				$arKeys[] = ew_StripSlashes($_POST["id"]);
			elseif (isset($_GET["id"]))
				$arKeys[] = ew_StripSlashes($_GET["id"]);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->tahunajaran_id->setDbValue($rs->fields('tahunajaran_id'));
		$this->awal_bulan->setDbValue($rs->fields('awal_bulan'));
		$this->awal_tahun->setDbValue($rs->fields('awal_tahun'));
		$this->akhir_bulan->setDbValue($rs->fields('akhir_bulan'));
		$this->akhir_tahun->setDbValue($rs->fields('akhir_tahun'));
		$this->sekolah_id->setDbValue($rs->fields('sekolah_id'));
		$this->Sekolah->setDbValue($rs->fields('Sekolah'));
		$this->kelas_id->setDbValue($rs->fields('kelas_id'));
		$this->Kelas->setDbValue($rs->fields('Kelas'));
		$this->siswa_id->setDbValue($rs->fields('siswa_id'));
		$this->Nomor_Induk->setDbValue($rs->fields('Nomor_Induk'));
		$this->Nama->setDbValue($rs->fields('Nama'));
		$this->rutin_id->setDbValue($rs->fields('rutin_id'));
		$this->Pembayaran_Rutin->setDbValue($rs->fields('Pembayaran_Rutin'));
		$this->nilai->setDbValue($rs->fields('nilai'));
		$this->id->setDbValue($rs->fields('id'));
		$this->siswarutin_id->setDbValue($rs->fields('siswarutin_id'));
		$this->Bulan->setDbValue($rs->fields('Bulan'));
		$this->Tahun->setDbValue($rs->fields('Tahun'));
		$this->Bayar_Tgl->setDbValue($rs->fields('Bayar_Tgl'));
		$this->Bayar_Jumlah->setDbValue($rs->fields('Bayar_Jumlah'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// tahunajaran_id
		// awal_bulan
		// awal_tahun
		// akhir_bulan
		// akhir_tahun
		// sekolah_id
		// Sekolah
		// kelas_id
		// Kelas
		// siswa_id
		// Nomor_Induk
		// Nama
		// rutin_id
		// Pembayaran_Rutin
		// nilai
		// id
		// siswarutin_id
		// Bulan
		// Tahun
		// Bayar_Tgl
		// Bayar_Jumlah
		// tahunajaran_id

		if (strval($this->tahunajaran_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->tahunajaran_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `awal_bulan` AS `DispFld`, `awal_tahun` AS `Disp2Fld`, `akhir_bulan` AS `Disp3Fld`, `akhir_tahun` AS `Disp4Fld` FROM `t00_tahunajaran`";
		$sWhereWrk = "";
		$this->tahunajaran_id->LookupFilters = array("dx1" => '`awal_bulan`', "dx2" => '`awal_tahun`', "dx3" => '`akhir_bulan`', "dx4" => '`akhir_tahun`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tahunajaran_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$arwrk[3] = $rswrk->fields('Disp3Fld');
				$arwrk[4] = $rswrk->fields('Disp4Fld');
				$this->tahunajaran_id->ViewValue = $this->tahunajaran_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tahunajaran_id->ViewValue = $this->tahunajaran_id->CurrentValue;
			}
		} else {
			$this->tahunajaran_id->ViewValue = NULL;
		}
		$this->tahunajaran_id->ViewCustomAttributes = "";

		// awal_bulan
		$this->awal_bulan->ViewValue = $this->awal_bulan->CurrentValue;
		$this->awal_bulan->ViewCustomAttributes = "";

		// awal_tahun
		$this->awal_tahun->ViewValue = $this->awal_tahun->CurrentValue;
		$this->awal_tahun->ViewCustomAttributes = "";

		// akhir_bulan
		$this->akhir_bulan->ViewValue = $this->akhir_bulan->CurrentValue;
		$this->akhir_bulan->ViewCustomAttributes = "";

		// akhir_tahun
		$this->akhir_tahun->ViewValue = $this->akhir_tahun->CurrentValue;
		$this->akhir_tahun->ViewCustomAttributes = "";

		// sekolah_id
		$this->sekolah_id->ViewValue = $this->sekolah_id->CurrentValue;
		$this->sekolah_id->ViewCustomAttributes = "";

		// Sekolah
		$this->Sekolah->ViewValue = $this->Sekolah->CurrentValue;
		$this->Sekolah->ViewCustomAttributes = "";

		// kelas_id
		$this->kelas_id->ViewValue = $this->kelas_id->CurrentValue;
		$this->kelas_id->ViewCustomAttributes = "";

		// Kelas
		$this->Kelas->ViewValue = $this->Kelas->CurrentValue;
		$this->Kelas->ViewCustomAttributes = "";

		// siswa_id
		$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
		$this->siswa_id->ViewCustomAttributes = "";

		// Nomor_Induk
		$this->Nomor_Induk->ViewValue = $this->Nomor_Induk->CurrentValue;
		$this->Nomor_Induk->ViewCustomAttributes = "";

		// Nama
		$this->Nama->ViewValue = $this->Nama->CurrentValue;
		$this->Nama->ViewCustomAttributes = "";

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

		// Pembayaran_Rutin
		$this->Pembayaran_Rutin->ViewCustomAttributes = "";

		// nilai
		$this->nilai->ViewValue = $this->nilai->CurrentValue;
		$this->nilai->ViewCustomAttributes = "";

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

		// sekolah_id
		$this->sekolah_id->LinkCustomAttributes = "";
		$this->sekolah_id->HrefValue = "";
		$this->sekolah_id->TooltipValue = "";

		// Sekolah
		$this->Sekolah->LinkCustomAttributes = "";
		$this->Sekolah->HrefValue = "";
		$this->Sekolah->TooltipValue = "";

		// kelas_id
		$this->kelas_id->LinkCustomAttributes = "";
		$this->kelas_id->HrefValue = "";
		$this->kelas_id->TooltipValue = "";

		// Kelas
		$this->Kelas->LinkCustomAttributes = "";
		$this->Kelas->HrefValue = "";
		$this->Kelas->TooltipValue = "";

		// siswa_id
		$this->siswa_id->LinkCustomAttributes = "";
		$this->siswa_id->HrefValue = "";
		$this->siswa_id->TooltipValue = "";

		// Nomor_Induk
		$this->Nomor_Induk->LinkCustomAttributes = "";
		$this->Nomor_Induk->HrefValue = "";
		$this->Nomor_Induk->TooltipValue = "";

		// Nama
		$this->Nama->LinkCustomAttributes = "";
		$this->Nama->HrefValue = "";
		$this->Nama->TooltipValue = "";

		// rutin_id
		$this->rutin_id->LinkCustomAttributes = "";
		$this->rutin_id->HrefValue = "";
		$this->rutin_id->TooltipValue = "";

		// Pembayaran_Rutin
		$this->Pembayaran_Rutin->LinkCustomAttributes = "";
		$this->Pembayaran_Rutin->HrefValue = "";
		$this->Pembayaran_Rutin->TooltipValue = "";

		// nilai
		$this->nilai->LinkCustomAttributes = "";
		$this->nilai->HrefValue = "";
		$this->nilai->TooltipValue = "";

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

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// tahunajaran_id
		$this->tahunajaran_id->EditAttrs["class"] = "form-control";
		$this->tahunajaran_id->EditCustomAttributes = "";

		// awal_bulan
		$this->awal_bulan->EditAttrs["class"] = "form-control";
		$this->awal_bulan->EditCustomAttributes = "";
		$this->awal_bulan->EditValue = $this->awal_bulan->CurrentValue;
		$this->awal_bulan->PlaceHolder = ew_RemoveHtml($this->awal_bulan->FldCaption());

		// awal_tahun
		$this->awal_tahun->EditAttrs["class"] = "form-control";
		$this->awal_tahun->EditCustomAttributes = "";
		$this->awal_tahun->EditValue = $this->awal_tahun->CurrentValue;
		$this->awal_tahun->PlaceHolder = ew_RemoveHtml($this->awal_tahun->FldCaption());

		// akhir_bulan
		$this->akhir_bulan->EditAttrs["class"] = "form-control";
		$this->akhir_bulan->EditCustomAttributes = "";
		$this->akhir_bulan->EditValue = $this->akhir_bulan->CurrentValue;
		$this->akhir_bulan->PlaceHolder = ew_RemoveHtml($this->akhir_bulan->FldCaption());

		// akhir_tahun
		$this->akhir_tahun->EditAttrs["class"] = "form-control";
		$this->akhir_tahun->EditCustomAttributes = "";
		$this->akhir_tahun->EditValue = $this->akhir_tahun->CurrentValue;
		$this->akhir_tahun->PlaceHolder = ew_RemoveHtml($this->akhir_tahun->FldCaption());

		// sekolah_id
		$this->sekolah_id->EditAttrs["class"] = "form-control";
		$this->sekolah_id->EditCustomAttributes = "";
		$this->sekolah_id->EditValue = $this->sekolah_id->CurrentValue;
		$this->sekolah_id->PlaceHolder = ew_RemoveHtml($this->sekolah_id->FldCaption());

		// Sekolah
		$this->Sekolah->EditAttrs["class"] = "form-control";
		$this->Sekolah->EditCustomAttributes = "";
		$this->Sekolah->EditValue = $this->Sekolah->CurrentValue;
		$this->Sekolah->PlaceHolder = ew_RemoveHtml($this->Sekolah->FldCaption());

		// kelas_id
		$this->kelas_id->EditAttrs["class"] = "form-control";
		$this->kelas_id->EditCustomAttributes = "";
		$this->kelas_id->EditValue = $this->kelas_id->CurrentValue;
		$this->kelas_id->PlaceHolder = ew_RemoveHtml($this->kelas_id->FldCaption());

		// Kelas
		$this->Kelas->EditAttrs["class"] = "form-control";
		$this->Kelas->EditCustomAttributes = "";
		$this->Kelas->EditValue = $this->Kelas->CurrentValue;
		$this->Kelas->PlaceHolder = ew_RemoveHtml($this->Kelas->FldCaption());

		// siswa_id
		$this->siswa_id->EditAttrs["class"] = "form-control";
		$this->siswa_id->EditCustomAttributes = "";
		$this->siswa_id->EditValue = $this->siswa_id->CurrentValue;
		$this->siswa_id->PlaceHolder = ew_RemoveHtml($this->siswa_id->FldCaption());

		// Nomor_Induk
		$this->Nomor_Induk->EditAttrs["class"] = "form-control";
		$this->Nomor_Induk->EditCustomAttributes = "";
		$this->Nomor_Induk->EditValue = $this->Nomor_Induk->CurrentValue;
		$this->Nomor_Induk->PlaceHolder = ew_RemoveHtml($this->Nomor_Induk->FldCaption());

		// Nama
		$this->Nama->EditAttrs["class"] = "form-control";
		$this->Nama->EditCustomAttributes = "";
		$this->Nama->EditValue = $this->Nama->CurrentValue;
		$this->Nama->PlaceHolder = ew_RemoveHtml($this->Nama->FldCaption());

		// rutin_id
		$this->rutin_id->EditAttrs["class"] = "form-control";
		$this->rutin_id->EditCustomAttributes = "";

		// Pembayaran_Rutin
		$this->Pembayaran_Rutin->EditAttrs["class"] = "form-control";
		$this->Pembayaran_Rutin->EditCustomAttributes = "";

		// nilai
		$this->nilai->EditAttrs["class"] = "form-control";
		$this->nilai->EditCustomAttributes = "";
		$this->nilai->EditValue = $this->nilai->CurrentValue;
		$this->nilai->PlaceHolder = ew_RemoveHtml($this->nilai->FldCaption());
		if (strval($this->nilai->EditValue) <> "" && is_numeric($this->nilai->EditValue)) $this->nilai->EditValue = ew_FormatNumber($this->nilai->EditValue, -2, -1, -2, 0);

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// siswarutin_id
		$this->siswarutin_id->EditAttrs["class"] = "form-control";
		$this->siswarutin_id->EditCustomAttributes = "";
		$this->siswarutin_id->EditValue = $this->siswarutin_id->CurrentValue;
		$this->siswarutin_id->PlaceHolder = ew_RemoveHtml($this->siswarutin_id->FldCaption());

		// Bulan
		$this->Bulan->EditAttrs["class"] = "form-control";
		$this->Bulan->EditCustomAttributes = "";
		$this->Bulan->EditValue = $this->Bulan->CurrentValue;
		$this->Bulan->PlaceHolder = ew_RemoveHtml($this->Bulan->FldCaption());

		// Tahun
		$this->Tahun->EditAttrs["class"] = "form-control";
		$this->Tahun->EditCustomAttributes = "";
		$this->Tahun->EditValue = $this->Tahun->CurrentValue;
		$this->Tahun->PlaceHolder = ew_RemoveHtml($this->Tahun->FldCaption());

		// Bayar_Tgl
		$this->Bayar_Tgl->EditAttrs["class"] = "form-control";
		$this->Bayar_Tgl->EditCustomAttributes = "";
		$this->Bayar_Tgl->EditValue = ew_FormatDateTime($this->Bayar_Tgl->CurrentValue, 8);
		$this->Bayar_Tgl->PlaceHolder = ew_RemoveHtml($this->Bayar_Tgl->FldCaption());

		// Bayar_Jumlah
		$this->Bayar_Jumlah->EditAttrs["class"] = "form-control";
		$this->Bayar_Jumlah->EditCustomAttributes = "";
		$this->Bayar_Jumlah->EditValue = $this->Bayar_Jumlah->CurrentValue;
		$this->Bayar_Jumlah->PlaceHolder = ew_RemoveHtml($this->Bayar_Jumlah->FldCaption());
		if (strval($this->Bayar_Jumlah->EditValue) <> "" && is_numeric($this->Bayar_Jumlah->EditValue)) $this->Bayar_Jumlah->EditValue = ew_FormatNumber($this->Bayar_Jumlah->EditValue, -2, -1, -2, 0);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->tahunajaran_id->Exportable) $Doc->ExportCaption($this->tahunajaran_id);
					if ($this->awal_bulan->Exportable) $Doc->ExportCaption($this->awal_bulan);
					if ($this->awal_tahun->Exportable) $Doc->ExportCaption($this->awal_tahun);
					if ($this->akhir_bulan->Exportable) $Doc->ExportCaption($this->akhir_bulan);
					if ($this->akhir_tahun->Exportable) $Doc->ExportCaption($this->akhir_tahun);
					if ($this->sekolah_id->Exportable) $Doc->ExportCaption($this->sekolah_id);
					if ($this->Sekolah->Exportable) $Doc->ExportCaption($this->Sekolah);
					if ($this->kelas_id->Exportable) $Doc->ExportCaption($this->kelas_id);
					if ($this->Kelas->Exportable) $Doc->ExportCaption($this->Kelas);
					if ($this->siswa_id->Exportable) $Doc->ExportCaption($this->siswa_id);
					if ($this->Nomor_Induk->Exportable) $Doc->ExportCaption($this->Nomor_Induk);
					if ($this->Nama->Exportable) $Doc->ExportCaption($this->Nama);
					if ($this->rutin_id->Exportable) $Doc->ExportCaption($this->rutin_id);
					if ($this->Pembayaran_Rutin->Exportable) $Doc->ExportCaption($this->Pembayaran_Rutin);
					if ($this->nilai->Exportable) $Doc->ExportCaption($this->nilai);
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->siswarutin_id->Exportable) $Doc->ExportCaption($this->siswarutin_id);
					if ($this->Bulan->Exportable) $Doc->ExportCaption($this->Bulan);
					if ($this->Tahun->Exportable) $Doc->ExportCaption($this->Tahun);
					if ($this->Bayar_Tgl->Exportable) $Doc->ExportCaption($this->Bayar_Tgl);
					if ($this->Bayar_Jumlah->Exportable) $Doc->ExportCaption($this->Bayar_Jumlah);
				} else {
					if ($this->tahunajaran_id->Exportable) $Doc->ExportCaption($this->tahunajaran_id);
					if ($this->awal_bulan->Exportable) $Doc->ExportCaption($this->awal_bulan);
					if ($this->awal_tahun->Exportable) $Doc->ExportCaption($this->awal_tahun);
					if ($this->akhir_bulan->Exportable) $Doc->ExportCaption($this->akhir_bulan);
					if ($this->akhir_tahun->Exportable) $Doc->ExportCaption($this->akhir_tahun);
					if ($this->sekolah_id->Exportable) $Doc->ExportCaption($this->sekolah_id);
					if ($this->Sekolah->Exportable) $Doc->ExportCaption($this->Sekolah);
					if ($this->kelas_id->Exportable) $Doc->ExportCaption($this->kelas_id);
					if ($this->Kelas->Exportable) $Doc->ExportCaption($this->Kelas);
					if ($this->siswa_id->Exportable) $Doc->ExportCaption($this->siswa_id);
					if ($this->Nomor_Induk->Exportable) $Doc->ExportCaption($this->Nomor_Induk);
					if ($this->Nama->Exportable) $Doc->ExportCaption($this->Nama);
					if ($this->rutin_id->Exportable) $Doc->ExportCaption($this->rutin_id);
					if ($this->Pembayaran_Rutin->Exportable) $Doc->ExportCaption($this->Pembayaran_Rutin);
					if ($this->nilai->Exportable) $Doc->ExportCaption($this->nilai);
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->siswarutin_id->Exportable) $Doc->ExportCaption($this->siswarutin_id);
					if ($this->Bulan->Exportable) $Doc->ExportCaption($this->Bulan);
					if ($this->Tahun->Exportable) $Doc->ExportCaption($this->Tahun);
					if ($this->Bayar_Tgl->Exportable) $Doc->ExportCaption($this->Bayar_Tgl);
					if ($this->Bayar_Jumlah->Exportable) $Doc->ExportCaption($this->Bayar_Jumlah);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->tahunajaran_id->Exportable) $Doc->ExportField($this->tahunajaran_id);
						if ($this->awal_bulan->Exportable) $Doc->ExportField($this->awal_bulan);
						if ($this->awal_tahun->Exportable) $Doc->ExportField($this->awal_tahun);
						if ($this->akhir_bulan->Exportable) $Doc->ExportField($this->akhir_bulan);
						if ($this->akhir_tahun->Exportable) $Doc->ExportField($this->akhir_tahun);
						if ($this->sekolah_id->Exportable) $Doc->ExportField($this->sekolah_id);
						if ($this->Sekolah->Exportable) $Doc->ExportField($this->Sekolah);
						if ($this->kelas_id->Exportable) $Doc->ExportField($this->kelas_id);
						if ($this->Kelas->Exportable) $Doc->ExportField($this->Kelas);
						if ($this->siswa_id->Exportable) $Doc->ExportField($this->siswa_id);
						if ($this->Nomor_Induk->Exportable) $Doc->ExportField($this->Nomor_Induk);
						if ($this->Nama->Exportable) $Doc->ExportField($this->Nama);
						if ($this->rutin_id->Exportable) $Doc->ExportField($this->rutin_id);
						if ($this->Pembayaran_Rutin->Exportable) $Doc->ExportField($this->Pembayaran_Rutin);
						if ($this->nilai->Exportable) $Doc->ExportField($this->nilai);
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->siswarutin_id->Exportable) $Doc->ExportField($this->siswarutin_id);
						if ($this->Bulan->Exportable) $Doc->ExportField($this->Bulan);
						if ($this->Tahun->Exportable) $Doc->ExportField($this->Tahun);
						if ($this->Bayar_Tgl->Exportable) $Doc->ExportField($this->Bayar_Tgl);
						if ($this->Bayar_Jumlah->Exportable) $Doc->ExportField($this->Bayar_Jumlah);
					} else {
						if ($this->tahunajaran_id->Exportable) $Doc->ExportField($this->tahunajaran_id);
						if ($this->awal_bulan->Exportable) $Doc->ExportField($this->awal_bulan);
						if ($this->awal_tahun->Exportable) $Doc->ExportField($this->awal_tahun);
						if ($this->akhir_bulan->Exportable) $Doc->ExportField($this->akhir_bulan);
						if ($this->akhir_tahun->Exportable) $Doc->ExportField($this->akhir_tahun);
						if ($this->sekolah_id->Exportable) $Doc->ExportField($this->sekolah_id);
						if ($this->Sekolah->Exportable) $Doc->ExportField($this->Sekolah);
						if ($this->kelas_id->Exportable) $Doc->ExportField($this->kelas_id);
						if ($this->Kelas->Exportable) $Doc->ExportField($this->Kelas);
						if ($this->siswa_id->Exportable) $Doc->ExportField($this->siswa_id);
						if ($this->Nomor_Induk->Exportable) $Doc->ExportField($this->Nomor_Induk);
						if ($this->Nama->Exportable) $Doc->ExportField($this->Nama);
						if ($this->rutin_id->Exportable) $Doc->ExportField($this->rutin_id);
						if ($this->Pembayaran_Rutin->Exportable) $Doc->ExportField($this->Pembayaran_Rutin);
						if ($this->nilai->Exportable) $Doc->ExportField($this->nilai);
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->siswarutin_id->Exportable) $Doc->ExportField($this->siswarutin_id);
						if ($this->Bulan->Exportable) $Doc->ExportField($this->Bulan);
						if ($this->Tahun->Exportable) $Doc->ExportField($this->Tahun);
						if ($this->Bayar_Tgl->Exportable) $Doc->ExportField($this->Bayar_Tgl);
						if ($this->Bayar_Jumlah->Exportable) $Doc->ExportField($this->Bayar_Jumlah);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
