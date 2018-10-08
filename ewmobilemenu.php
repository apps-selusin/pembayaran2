<!-- Begin Main Menu -->
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(5, "mmi_cf01_home_php", $Language->MenuPhrase("5", "MenuText"), "cf01_home.php", -1, "", AllowListMenu('{8F2DFBC1-53BE-44C3-91F5-73D45F821091}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(27, "mmi_v02_rutin", $Language->MenuPhrase("27", "MenuText"), "v02_rutinlist.php", -1, "", AllowListMenu('{8F2DFBC1-53BE-44C3-91F5-73D45F821091}v02_rutin'), FALSE, FALSE);
$RootMenu->AddMenuItem(6, "mmci_Setup", $Language->MenuPhrase("6", "MenuText"), "", -1, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(7, "mmi_t00_tahunajaran", $Language->MenuPhrase("7", "MenuText"), "t00_tahunajaranlist.php", 6, "", AllowListMenu('{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t00_tahunajaran'), FALSE, FALSE);
$RootMenu->AddMenuItem(8, "mmi_t01_sekolah", $Language->MenuPhrase("8", "MenuText"), "t01_sekolahlist.php", 6, "", AllowListMenu('{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t01_sekolah'), FALSE, FALSE);
$RootMenu->AddMenuItem(24, "mmci_Pembayaran", $Language->MenuPhrase("24", "MenuText"), "", 6, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(13, "mmi_t04_rutin", $Language->MenuPhrase("13", "MenuText"), "t04_rutinlist.php", 24, "", AllowListMenu('{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t04_rutin'), FALSE, FALSE);
$RootMenu->AddMenuItem(10, "mmi_t03_siswa", $Language->MenuPhrase("10", "MenuText"), "t03_siswalist.php", 6, "", AllowListMenu('{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t03_siswa'), FALSE, FALSE);
$RootMenu->AddMenuItem(1, "mmi_t96_employees", $Language->MenuPhrase("1", "MenuText"), "t96_employeeslist.php", 6, "", AllowListMenu('{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t96_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(2, "mmi_t97_userlevels", $Language->MenuPhrase("2", "MenuText"), "t97_userlevelslist.php", 6, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mmi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mmi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mmi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
