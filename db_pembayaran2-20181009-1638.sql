-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2018 at 11:37 AM
-- Server version: 5.6.14
-- PHP Version: 5.5.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_pembayaran2`
--

-- --------------------------------------------------------

--
-- Table structure for table `t00_tahunajaran`
--

CREATE TABLE `t00_tahunajaran` (
  `id` int(11) NOT NULL,
  `awal_bulan` tinyint(10) NOT NULL,
  `awal_tahun` smallint(6) NOT NULL,
  `akhir_bulan` tinyint(10) NOT NULL,
  `akhir_tahun` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t00_tahunajaran`
--

INSERT INTO `t00_tahunajaran` (`id`, `awal_bulan`, `awal_tahun`, `akhir_bulan`, `akhir_tahun`) VALUES
(1, 7, 2018, 6, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `t01_sekolah`
--

CREATE TABLE `t01_sekolah` (
  `id` int(11) NOT NULL,
  `Nomor_Induk` varchar(100) NOT NULL,
  `Nama` varchar(100) NOT NULL,
  `Alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t01_sekolah`
--

INSERT INTO `t01_sekolah` (`id`, `Nomor_Induk`, `Nama`, `Alamat`) VALUES
(1, '0001', 'MINU BERKARAKTER', 'Jl. Gajah Mada - Bojonegoro');

-- --------------------------------------------------------

--
-- Table structure for table `t02_kelas`
--

CREATE TABLE `t02_kelas` (
  `id` int(11) NOT NULL,
  `sekolah_id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t02_kelas`
--

INSERT INTO `t02_kelas` (`id`, `sekolah_id`, `Nama`) VALUES
(1, 1, 'Kelas I'),
(2, 1, 'Kelas II'),
(3, 1, 'Kelas III'),
(4, 1, 'Kelas IV'),
(5, 1, 'Kelas V'),
(6, 1, 'Kelas VI');

-- --------------------------------------------------------

--
-- Table structure for table `t03_siswa`
--

CREATE TABLE `t03_siswa` (
  `id` int(11) NOT NULL,
  `tahunajaran_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `Nomor_Induk` varchar(100) NOT NULL,
  `Nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t03_siswa`
--

INSERT INTO `t03_siswa` (`id`, `tahunajaran_id`, `kelas_id`, `Nomor_Induk`, `Nama`) VALUES
(2, 1, 1, 'A0001', 'Abi');

-- --------------------------------------------------------

--
-- Table structure for table `t04_rutin`
--

CREATE TABLE `t04_rutin` (
  `id` int(11) NOT NULL,
  `Nama` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t04_rutin`
--

INSERT INTO `t04_rutin` (`id`, `Nama`) VALUES
(1, 'Infaq'),
(2, 'Catering'),
(3, 'Worksheet'),
(4, 'Beasiswa Infaq');

-- --------------------------------------------------------

--
-- Table structure for table `t05_siswarutin`
--

CREATE TABLE `t05_siswarutin` (
  `id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `rutin_id` int(11) NOT NULL,
  `Nilai` float(14,2) NOT NULL DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t05_siswarutin`
--

INSERT INTO `t05_siswarutin` (`id`, `siswa_id`, `rutin_id`, `Nilai`) VALUES
(3, 2, 2, 75000.00),
(4, 2, 3, 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t06_siswarutinbayar`
--

CREATE TABLE `t06_siswarutinbayar` (
  `id` int(11) NOT NULL,
  `tahunajaran_id` int(11) NOT NULL,
  `sekolah_id` int(11) NOT NULL,
  `kelas_id` int(11) NOT NULL,
  `siswa_id` int(11) NOT NULL,
  `rutin_id` int(11) NOT NULL,
  `Bulan` tinyint(4) NOT NULL,
  `Tahun` smallint(6) NOT NULL,
  `Bayar_Tgl` date DEFAULT NULL,
  `Bayar_Jumlah` float(14,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t06_siswarutinbayar`
--

INSERT INTO `t06_siswarutinbayar` (`id`, `tahunajaran_id`, `sekolah_id`, `kelas_id`, `siswa_id`, `rutin_id`, `Bulan`, `Tahun`, `Bayar_Tgl`, `Bayar_Jumlah`) VALUES
(25, 1, 1, 1, 2, 3, 7, 2018, NULL, 75000.00),
(26, 1, 1, 1, 2, 3, 8, 2018, NULL, 75000.00),
(27, 1, 1, 1, 2, 3, 9, 2018, NULL, 75000.00),
(28, 1, 1, 1, 2, 3, 10, 2018, NULL, 75000.00),
(29, 1, 1, 1, 2, 3, 11, 2018, NULL, 75000.00),
(30, 1, 1, 1, 2, 3, 12, 2018, NULL, 75000.00),
(31, 1, 1, 1, 2, 3, 1, 2019, NULL, 75000.00),
(32, 1, 1, 1, 2, 3, 2, 2019, NULL, 75000.00),
(33, 1, 1, 1, 2, 3, 3, 2019, NULL, 75000.00),
(34, 1, 1, 1, 2, 3, 4, 2019, NULL, 75000.00),
(35, 1, 1, 1, 2, 3, 5, 2019, NULL, 75000.00),
(36, 1, 1, 1, 2, 3, 6, 2019, NULL, 75000.00),
(37, 1, 1, 1, 2, 4, 7, 2018, NULL, 100000.00),
(38, 1, 1, 1, 2, 4, 8, 2018, NULL, 100000.00),
(39, 1, 1, 1, 2, 4, 9, 2018, NULL, 100000.00),
(40, 1, 1, 1, 2, 4, 10, 2018, NULL, 100000.00),
(41, 1, 1, 1, 2, 4, 11, 2018, NULL, 100000.00),
(42, 1, 1, 1, 2, 4, 12, 2018, NULL, 100000.00),
(43, 1, 1, 1, 2, 4, 1, 2019, NULL, 100000.00),
(44, 1, 1, 1, 2, 4, 2, 2019, NULL, 100000.00),
(45, 1, 1, 1, 2, 4, 3, 2019, NULL, 100000.00),
(46, 1, 1, 1, 2, 4, 4, 2019, NULL, 100000.00),
(47, 1, 1, 1, 2, 4, 5, 2019, NULL, 100000.00),
(48, 1, 1, 1, 2, 4, 6, 2019, NULL, 100000.00);

-- --------------------------------------------------------

--
-- Table structure for table `t96_employees`
--

CREATE TABLE `t96_employees` (
  `EmployeeID` int(11) NOT NULL,
  `LastName` varchar(20) DEFAULT NULL,
  `FirstName` varchar(10) DEFAULT NULL,
  `Title` varchar(30) DEFAULT NULL,
  `TitleOfCourtesy` varchar(25) DEFAULT NULL,
  `BirthDate` datetime DEFAULT NULL,
  `HireDate` datetime DEFAULT NULL,
  `Address` varchar(60) DEFAULT NULL,
  `City` varchar(15) DEFAULT NULL,
  `Region` varchar(15) DEFAULT NULL,
  `PostalCode` varchar(10) DEFAULT NULL,
  `Country` varchar(15) DEFAULT NULL,
  `HomePhone` varchar(24) DEFAULT NULL,
  `Extension` varchar(4) DEFAULT NULL,
  `Email` varchar(30) DEFAULT NULL,
  `Photo` varchar(255) DEFAULT NULL,
  `Notes` longtext,
  `ReportsTo` int(11) DEFAULT NULL,
  `Password` varchar(50) NOT NULL DEFAULT '',
  `UserLevel` int(11) DEFAULT NULL,
  `Username` varchar(20) NOT NULL DEFAULT '',
  `Activated` enum('Y','N') NOT NULL DEFAULT 'N',
  `Profile` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t96_employees`
--

INSERT INTO `t96_employees` (`EmployeeID`, `LastName`, `FirstName`, `Title`, `TitleOfCourtesy`, `BirthDate`, `HireDate`, `Address`, `City`, `Region`, `PostalCode`, `Country`, `HomePhone`, `Extension`, `Email`, `Photo`, `Notes`, `ReportsTo`, `Password`, `UserLevel`, `Username`, `Activated`, `Profile`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '21232f297a57a5a743894a0e4a801fc3', -1, 'admin', 'Y', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t97_userlevels`
--

CREATE TABLE `t97_userlevels` (
  `userlevelid` int(11) NOT NULL,
  `userlevelname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t97_userlevels`
--

INSERT INTO `t97_userlevels` (`userlevelid`, `userlevelname`) VALUES
(-2, 'Anonymous'),
(-1, 'Administrator'),
(0, 'Default');

-- --------------------------------------------------------

--
-- Table structure for table `t98_userlevelpermissions`
--

CREATE TABLE `t98_userlevelpermissions` (
  `userlevelid` int(11) NOT NULL,
  `tablename` varchar(255) NOT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `t98_userlevelpermissions`
--

INSERT INTO `t98_userlevelpermissions` (`userlevelid`, `tablename`, `permission`) VALUES
(-2, '{8F2DFBC1-53BE-44C3-91F5-73D45F821091}cf01_home.php', 8),
(-2, '{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t96_employees', 0),
(-2, '{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t97_userlevels', 0),
(-2, '{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t98_userlevelpermissions', 0),
(-2, '{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t99_audittrail', 0),
(0, '{8F2DFBC1-53BE-44C3-91F5-73D45F821091}cf01_home.php', 8),
(0, '{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t96_employees', 0),
(0, '{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t97_userlevels', 0),
(0, '{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t98_userlevelpermissions', 0),
(0, '{8F2DFBC1-53BE-44C3-91F5-73D45F821091}t99_audittrail', 0);

-- --------------------------------------------------------

--
-- Table structure for table `t99_audittrail`
--

CREATE TABLE `t99_audittrail` (
  `id` int(11) NOT NULL,
  `datetime` datetime NOT NULL,
  `script` varchar(255) DEFAULT NULL,
  `user` varchar(255) DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `table` varchar(255) DEFAULT NULL,
  `field` varchar(255) DEFAULT NULL,
  `keyvalue` longtext,
  `oldvalue` longtext,
  `newvalue` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t99_audittrail`
--

INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(1, '2018-10-08 10:20:15', '/pembayaran2/login.php', 'admin', 'login', '::1', '', '', '', ''),
(2, '2018-10-08 10:29:57', '/pembayaran2/t00_tahunajaranadd.php', '1', 'A', 't00_tahunajaran', 'awal_bulan', '1', '', 'Juli'),
(3, '2018-10-08 10:29:57', '/pembayaran2/t00_tahunajaranadd.php', '1', 'A', 't00_tahunajaran', 'awal_tahun', '1', '', '2018'),
(4, '2018-10-08 10:29:57', '/pembayaran2/t00_tahunajaranadd.php', '1', 'A', 't00_tahunajaran', 'akhir_bulan', '1', '', 'Juni'),
(5, '2018-10-08 10:29:57', '/pembayaran2/t00_tahunajaranadd.php', '1', 'A', 't00_tahunajaran', 'akhir_tahun', '1', '', '2019'),
(6, '2018-10-08 10:29:57', '/pembayaran2/t00_tahunajaranadd.php', '1', 'A', 't00_tahunajaran', 'id', '1', '', '1'),
(7, '2018-10-08 10:46:11', '/pembayaran2/t01_sekolahadd.php', '1', 'A', 't01_sekolah', 'Nomor_Induk', '1', '', '0001'),
(8, '2018-10-08 10:46:11', '/pembayaran2/t01_sekolahadd.php', '1', 'A', 't01_sekolah', 'Nama', '1', '', 'MINU BERKARAKTER'),
(9, '2018-10-08 10:46:11', '/pembayaran2/t01_sekolahadd.php', '1', 'A', 't01_sekolah', 'Alamat', '1', '', 'Jl. Gajah Mada - Bojonegoro'),
(10, '2018-10-08 10:46:11', '/pembayaran2/t01_sekolahadd.php', '1', 'A', 't01_sekolah', 'id', '1', '', '1'),
(11, '2018-10-08 10:56:08', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'sekolah_id', '1', '', '1'),
(12, '2018-10-08 10:56:08', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'Nama', '1', '', 'Kelas I'),
(13, '2018-10-08 10:56:08', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'id', '1', '', '1'),
(14, '2018-10-08 10:56:18', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'sekolah_id', '2', '', '1'),
(15, '2018-10-08 10:56:18', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'Nama', '2', '', 'Kelas II'),
(16, '2018-10-08 10:56:18', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'id', '2', '', '2'),
(17, '2018-10-08 10:56:25', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'sekolah_id', '3', '', '1'),
(18, '2018-10-08 10:56:25', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'Nama', '3', '', 'Kelas III'),
(19, '2018-10-08 10:56:25', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'id', '3', '', '3'),
(20, '2018-10-08 10:56:33', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'sekolah_id', '4', '', '1'),
(21, '2018-10-08 10:56:33', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'Nama', '4', '', 'Kelas IV'),
(22, '2018-10-08 10:56:33', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'id', '4', '', '4'),
(23, '2018-10-08 10:56:39', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'sekolah_id', '5', '', '1'),
(24, '2018-10-08 10:56:39', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'Nama', '5', '', 'Kelas V'),
(25, '2018-10-08 10:56:39', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'id', '5', '', '5'),
(26, '2018-10-08 10:56:45', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'sekolah_id', '6', '', '1'),
(27, '2018-10-08 10:56:45', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'Nama', '6', '', 'Kelas VI'),
(28, '2018-10-08 10:56:45', '/pembayaran2/t02_kelasadd.php', '1', 'A', 't02_kelas', 'id', '6', '', '6'),
(29, '2018-10-08 11:53:29', '/pembayaran2/t04_rutinadd.php', '1', 'A', 't04_rutin', 'Nama', '1', '', 'Infaq'),
(30, '2018-10-08 11:53:29', '/pembayaran2/t04_rutinadd.php', '1', 'A', 't04_rutin', 'id', '1', '', '1'),
(31, '2018-10-08 11:53:39', '/pembayaran2/t04_rutinadd.php', '1', 'A', 't04_rutin', 'Nama', '2', '', 'Catering'),
(32, '2018-10-08 11:53:39', '/pembayaran2/t04_rutinadd.php', '1', 'A', 't04_rutin', 'id', '2', '', '2'),
(33, '2018-10-08 11:53:50', '/pembayaran2/t04_rutinadd.php', '1', 'A', 't04_rutin', 'Nama', '3', '', 'Worksheet'),
(34, '2018-10-08 11:53:50', '/pembayaran2/t04_rutinadd.php', '1', 'A', 't04_rutin', 'id', '3', '', '3'),
(35, '2018-10-08 11:54:05', '/pembayaran2/t04_rutinadd.php', '1', 'A', 't04_rutin', 'Nama', '4', '', 'Beasiswa Infaq'),
(36, '2018-10-08 11:54:05', '/pembayaran2/t04_rutinadd.php', '1', 'A', 't04_rutin', 'id', '4', '', '4'),
(37, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'tahunajaran_id', '1', '', '1'),
(38, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '1', '', '1'),
(39, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '1', '', 'A0001'),
(40, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '1', '', 'Abu'),
(41, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '1', '', '1'),
(42, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(43, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '1', '', '1'),
(44, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '1', '', '100000'),
(45, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '1', '', '1'),
(46, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '1', '', '1'),
(47, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '2', '', '2'),
(48, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '2', '', '125000'),
(49, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '2', '', '1'),
(50, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '2', '', '2'),
(51, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '3', '', '3'),
(52, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '3', '', '150000'),
(53, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '3', '', '1'),
(54, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '3', '', '3'),
(55, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '4', '', '4'),
(56, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '4', '', '175000'),
(57, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '4', '', '1'),
(58, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '4', '', '4'),
(59, '2018-10-08 12:07:32', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(60, '2018-10-08 21:36:36', '/pembayaran2/login.php', 'admin', 'login', '::1', '', '', '', ''),
(61, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', '*** Batch delete begin ***', 't03_siswa', '', '', '', ''),
(62, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '1', '1', ''),
(63, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '1', '1', ''),
(64, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '1', '1', ''),
(65, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '1', '100000.00', ''),
(66, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '2', '2', ''),
(67, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '2', '1', ''),
(68, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '2', '2', ''),
(69, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '2', '125000.00', ''),
(70, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '3', '3', ''),
(71, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '3', '1', ''),
(72, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '3', '3', ''),
(73, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '3', '150000.00', ''),
(74, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '4', '4', ''),
(75, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '4', '1', ''),
(76, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '4', '4', ''),
(77, '2018-10-08 21:40:21', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '4', '175000.00', ''),
(78, '2018-10-08 21:40:22', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'id', '1', '1', ''),
(79, '2018-10-08 21:40:22', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'tahunajaran_id', '1', '1', ''),
(80, '2018-10-08 21:40:22', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'kelas_id', '1', '1', ''),
(81, '2018-10-08 21:40:22', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'Nomor_Induk', '1', 'A0001', ''),
(82, '2018-10-08 21:40:22', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'Nama', '1', 'Abu', ''),
(83, '2018-10-08 21:40:22', '/pembayaran2/t03_siswadelete.php', '1', '*** Batch delete successful ***', 't03_siswa', '', '', '', ''),
(84, '2018-10-08 21:41:29', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'tahunajaran_id', '2', '', '1'),
(85, '2018-10-08 21:41:29', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '2', '', '1'),
(86, '2018-10-08 21:41:29', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '2', '', 'A0001'),
(87, '2018-10-08 21:41:29', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '2', '', 'Abu'),
(88, '2018-10-08 21:41:29', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '2', '', '2'),
(89, '2018-10-08 21:41:29', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(90, '2018-10-08 21:41:29', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '5', '', '1'),
(91, '2018-10-08 21:41:29', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '5', '', '100000'),
(92, '2018-10-08 21:41:29', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '5', '', '2'),
(93, '2018-10-08 21:41:29', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '5', '', '5'),
(94, '2018-10-08 21:41:30', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '6', '', '2'),
(95, '2018-10-08 21:41:30', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '6', '', '125000'),
(96, '2018-10-08 21:41:30', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '6', '', '2'),
(97, '2018-10-08 21:41:30', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '6', '', '6'),
(98, '2018-10-08 21:41:30', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(99, '2018-10-09 00:13:13', '/pembayaran2/login.php', 'admin', 'login', '::1', '', '', '', ''),
(100, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', '*** Batch delete begin ***', 't03_siswa', '', '', '', ''),
(101, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '5', '5', ''),
(102, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '5', '2', ''),
(103, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '5', '1', ''),
(104, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '5', '100000.00', ''),
(105, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '6', '6', ''),
(106, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '6', '2', ''),
(107, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '6', '2', ''),
(108, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '6', '125000.00', ''),
(109, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'id', '2', '2', ''),
(110, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'tahunajaran_id', '2', '1', ''),
(111, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'kelas_id', '2', '1', ''),
(112, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'Nomor_Induk', '2', 'A0001', ''),
(113, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'Nama', '2', 'Abu', ''),
(114, '2018-10-09 00:13:32', '/pembayaran2/t03_siswadelete.php', '1', '*** Batch delete successful ***', 't03_siswa', '', '', '', ''),
(115, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'tahunajaran_id', '1', '', '1'),
(116, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '1', '', '1'),
(117, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '1', '', 'A0001'),
(118, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '1', '', 'Abu'),
(119, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '1', '', '1'),
(120, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(121, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '1', '', '3'),
(122, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '1', '', '200000'),
(123, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '1', '', '1'),
(124, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '1', '', '1'),
(125, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '2', '', '4'),
(126, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '2', '', '250000'),
(127, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '2', '', '1'),
(128, '2018-10-09 00:14:53', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '2', '', '2'),
(129, '2018-10-09 00:14:54', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(130, '2018-10-09 11:04:17', '/pembayaran2/login.php', 'admin', 'login', '::1', '', '', '', ''),
(131, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'tahunajaran_id', '1', '', '1'),
(132, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '1', '', '1'),
(133, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '1', '', 'A0001'),
(134, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '1', '', 'Abu'),
(135, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '1', '', '1'),
(136, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(137, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '1', '', '1'),
(138, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '1', '', '300000'),
(139, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '1', '', '1'),
(140, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '1', '', '1'),
(141, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '2', '', '3'),
(142, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '2', '', '350000'),
(143, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '2', '', '1'),
(144, '2018-10-09 13:26:01', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '2', '', '2'),
(145, '2018-10-09 13:26:02', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', ''),
(146, '2018-10-09 15:32:22', '/pembayaran2/login.php', 'admin', 'login', '::1', '', '', '', ''),
(147, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', '*** Batch delete begin ***', 't03_siswa', '', '', '', ''),
(148, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '1', '1', ''),
(149, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '1', '1', ''),
(150, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '1', '1', ''),
(151, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '1', '1', ''),
(152, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '1', '1', ''),
(153, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '1', '1', ''),
(154, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '1', '7', ''),
(155, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '1', '2018', ''),
(156, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '1', NULL, ''),
(157, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '1', '0.00', ''),
(158, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '2', '2', ''),
(159, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '2', '1', ''),
(160, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '2', '1', ''),
(161, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '2', '1', ''),
(162, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '2', '1', ''),
(163, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '2', '1', ''),
(164, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '2', '8', ''),
(165, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '2', '2018', ''),
(166, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '2', NULL, ''),
(167, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '2', '0.00', ''),
(168, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '3', '3', ''),
(169, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '3', '1', ''),
(170, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '3', '1', ''),
(171, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '3', '1', ''),
(172, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '3', '1', ''),
(173, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '3', '1', ''),
(174, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '3', '9', ''),
(175, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '3', '2018', ''),
(176, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '3', NULL, ''),
(177, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '3', '0.00', ''),
(178, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '4', '4', ''),
(179, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '4', '1', ''),
(180, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '4', '1', ''),
(181, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '4', '1', ''),
(182, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '4', '1', ''),
(183, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '4', '1', ''),
(184, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '4', '10', ''),
(185, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '4', '2018', ''),
(186, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '4', NULL, ''),
(187, '2018-10-09 16:07:06', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '4', '0.00', ''),
(188, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '5', '5', ''),
(189, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '5', '1', ''),
(190, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '5', '1', ''),
(191, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '5', '1', ''),
(192, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '5', '1', ''),
(193, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '5', '1', ''),
(194, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '5', '11', ''),
(195, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '5', '2018', ''),
(196, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '5', NULL, ''),
(197, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '5', '0.00', ''),
(198, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '6', '6', ''),
(199, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '6', '1', ''),
(200, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '6', '1', ''),
(201, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '6', '1', ''),
(202, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '6', '1', ''),
(203, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '6', '1', ''),
(204, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '6', '12', ''),
(205, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '6', '2018', ''),
(206, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '6', NULL, ''),
(207, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '6', '0.00', ''),
(208, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '7', '7', ''),
(209, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '7', '1', ''),
(210, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '7', '1', ''),
(211, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '7', '1', ''),
(212, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '7', '1', ''),
(213, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '7', '1', ''),
(214, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '7', '1', ''),
(215, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '7', '2019', ''),
(216, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '7', NULL, ''),
(217, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '7', '0.00', ''),
(218, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '8', '8', ''),
(219, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '8', '1', ''),
(220, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '8', '1', ''),
(221, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '8', '1', ''),
(222, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '8', '1', ''),
(223, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '8', '1', ''),
(224, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '8', '2', ''),
(225, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '8', '2019', ''),
(226, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '8', NULL, ''),
(227, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '8', '0.00', ''),
(228, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '9', '9', ''),
(229, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '9', '1', ''),
(230, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '9', '1', ''),
(231, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '9', '1', ''),
(232, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '9', '1', ''),
(233, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '9', '1', ''),
(234, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '9', '3', ''),
(235, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '9', '2019', ''),
(236, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '9', NULL, ''),
(237, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '9', '0.00', ''),
(238, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '10', '10', ''),
(239, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '10', '1', ''),
(240, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '10', '1', ''),
(241, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '10', '1', ''),
(242, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '10', '1', ''),
(243, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '10', '1', ''),
(244, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '10', '4', ''),
(245, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '10', '2019', ''),
(246, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '10', NULL, ''),
(247, '2018-10-09 16:07:07', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '10', '0.00', ''),
(248, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '11', '11', ''),
(249, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '11', '1', ''),
(250, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '11', '1', ''),
(251, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '11', '1', ''),
(252, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '11', '1', ''),
(253, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '11', '1', ''),
(254, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '11', '5', ''),
(255, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '11', '2019', ''),
(256, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '11', NULL, ''),
(257, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '11', '0.00', ''),
(258, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '12', '12', ''),
(259, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '12', '1', ''),
(260, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '12', '1', ''),
(261, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '12', '1', ''),
(262, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '12', '1', ''),
(263, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '12', '1', ''),
(264, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '12', '6', ''),
(265, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '12', '2019', ''),
(266, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '12', NULL, ''),
(267, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '12', '0.00', ''),
(268, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '1', '1', ''),
(269, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '1', '1', ''),
(270, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '1', '1', ''),
(271, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '1', '300000.00', ''),
(272, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '13', '13', ''),
(273, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '13', '1', ''),
(274, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '13', '1', ''),
(275, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '13', '1', ''),
(276, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '13', '1', ''),
(277, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '13', '2', ''),
(278, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '13', '7', ''),
(279, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '13', '2018', ''),
(280, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '13', NULL, ''),
(281, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '13', '0.00', ''),
(282, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '14', '14', ''),
(283, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '14', '1', ''),
(284, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '14', '1', ''),
(285, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '14', '1', ''),
(286, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '14', '1', ''),
(287, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '14', '2', ''),
(288, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '14', '8', ''),
(289, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '14', '2018', ''),
(290, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '14', NULL, ''),
(291, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '14', '0.00', ''),
(292, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '15', '15', ''),
(293, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '15', '1', ''),
(294, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '15', '1', ''),
(295, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '15', '1', ''),
(296, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '15', '1', ''),
(297, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '15', '2', ''),
(298, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '15', '9', ''),
(299, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '15', '2018', ''),
(300, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '15', NULL, ''),
(301, '2018-10-09 16:07:08', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '15', '0.00', ''),
(302, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '16', '16', ''),
(303, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '16', '1', ''),
(304, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '16', '1', ''),
(305, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '16', '1', ''),
(306, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '16', '1', ''),
(307, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '16', '2', ''),
(308, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '16', '10', ''),
(309, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '16', '2018', ''),
(310, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '16', NULL, ''),
(311, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '16', '0.00', ''),
(312, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '17', '17', ''),
(313, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '17', '1', ''),
(314, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '17', '1', ''),
(315, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '17', '1', ''),
(316, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '17', '1', ''),
(317, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '17', '2', ''),
(318, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '17', '11', ''),
(319, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '17', '2018', ''),
(320, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '17', NULL, ''),
(321, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '17', '0.00', ''),
(322, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '18', '18', ''),
(323, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '18', '1', ''),
(324, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '18', '1', ''),
(325, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '18', '1', ''),
(326, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '18', '1', ''),
(327, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '18', '2', ''),
(328, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '18', '12', ''),
(329, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '18', '2018', ''),
(330, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '18', NULL, ''),
(331, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '18', '0.00', ''),
(332, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '19', '19', ''),
(333, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '19', '1', ''),
(334, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '19', '1', ''),
(335, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '19', '1', ''),
(336, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '19', '1', ''),
(337, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '19', '2', ''),
(338, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '19', '1', ''),
(339, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '19', '2019', ''),
(340, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '19', NULL, ''),
(341, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '19', '0.00', ''),
(342, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '20', '20', ''),
(343, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '20', '1', ''),
(344, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '20', '1', ''),
(345, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '20', '1', ''),
(346, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '20', '1', ''),
(347, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '20', '2', ''),
(348, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '20', '2', ''),
(349, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '20', '2019', ''),
(350, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '20', NULL, ''),
(351, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '20', '0.00', ''),
(352, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '21', '21', ''),
(353, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '21', '1', ''),
(354, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '21', '1', ''),
(355, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '21', '1', ''),
(356, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '21', '1', ''),
(357, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '21', '2', ''),
(358, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '21', '3', ''),
(359, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '21', '2019', ''),
(360, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '21', NULL, ''),
(361, '2018-10-09 16:07:09', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '21', '0.00', ''),
(362, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '22', '22', ''),
(363, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '22', '1', ''),
(364, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '22', '1', ''),
(365, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '22', '1', ''),
(366, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '22', '1', ''),
(367, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '22', '2', ''),
(368, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '22', '4', ''),
(369, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '22', '2019', ''),
(370, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '22', NULL, ''),
(371, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '22', '0.00', ''),
(372, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '23', '23', ''),
(373, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '23', '1', ''),
(374, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '23', '1', ''),
(375, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '23', '1', ''),
(376, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '23', '1', ''),
(377, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '23', '2', ''),
(378, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '23', '5', ''),
(379, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '23', '2019', ''),
(380, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '23', NULL, ''),
(381, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '23', '0.00', ''),
(382, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'id', '24', '24', ''),
(383, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'tahunajaran_id', '24', '1', ''),
(384, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'sekolah_id', '24', '1', ''),
(385, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'kelas_id', '24', '1', ''),
(386, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'siswa_id', '24', '1', ''),
(387, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'rutin_id', '24', '2', ''),
(388, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bulan', '24', '6', ''),
(389, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Tahun', '24', '2019', ''),
(390, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Tgl', '24', NULL, ''),
(391, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't06_siswarutinbayar', 'Bayar_Jumlah', '24', '0.00', ''),
(392, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'id', '2', '2', ''),
(393, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'siswa_id', '2', '1', ''),
(394, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'rutin_id', '2', '3', ''),
(395, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't05_siswarutin', 'Nilai', '2', '350000.00', ''),
(396, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'id', '1', '1', ''),
(397, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'tahunajaran_id', '1', '1', ''),
(398, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'kelas_id', '1', '1', ''),
(399, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'Nomor_Induk', '1', 'A0001', ''),
(400, '2018-10-09 16:07:10', '/pembayaran2/t03_siswadelete.php', '1', 'D', 't03_siswa', 'Nama', '1', 'Abu', ''),
(401, '2018-10-09 16:07:11', '/pembayaran2/t03_siswadelete.php', '1', '*** Batch delete successful ***', 't03_siswa', '', '', '', ''),
(402, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'tahunajaran_id', '2', '', '1'),
(403, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'kelas_id', '2', '', '1'),
(404, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nomor_Induk', '2', '', 'A0001'),
(405, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'Nama', '2', '', 'Abi'),
(406, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't03_siswa', 'id', '2', '', '2'),
(407, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert begin ***', 't05_siswarutin', '', '', '', ''),
(408, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '3', '', '2'),
(409, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '3', '', '75000'),
(410, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '3', '', '2'),
(411, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '3', '', '3'),
(412, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'rutin_id', '4', '', '3'),
(413, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'Nilai', '4', '', '100000'),
(414, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'siswa_id', '4', '', '2');
INSERT INTO `t99_audittrail` (`id`, `datetime`, `script`, `user`, `action`, `table`, `field`, `keyvalue`, `oldvalue`, `newvalue`) VALUES
(415, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', 'A', 't05_siswarutin', 'id', '4', '', '4'),
(416, '2018-10-09 16:08:07', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', '');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v00_tahunajaran`
-- (See below for the actual view)
--
CREATE TABLE `v00_tahunajaran` (
`id` int(11)
,`awal_bulan` tinyint(10)
,`awal_tahun` smallint(6)
,`akhir_bulan` tinyint(10)
,`akhir_tahun` smallint(6)
,`tahun_pelajaran` varchar(15)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v01_sekolah_kelas`
-- (See below for the actual view)
--
CREATE TABLE `v01_sekolah_kelas` (
`kelas_id` int(11)
,`sekolah_nama` varchar(100)
,`kelas_nama` varchar(50)
);

-- --------------------------------------------------------

--
-- Structure for view `v00_tahunajaran`
--
DROP TABLE IF EXISTS `v00_tahunajaran`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v00_tahunajaran`  AS  select `t00_tahunajaran`.`id` AS `id`,`t00_tahunajaran`.`awal_bulan` AS `awal_bulan`,`t00_tahunajaran`.`awal_tahun` AS `awal_tahun`,`t00_tahunajaran`.`akhir_bulan` AS `akhir_bulan`,`t00_tahunajaran`.`akhir_tahun` AS `akhir_tahun`,concat(`t00_tahunajaran`.`awal_tahun`,' / ',`t00_tahunajaran`.`akhir_tahun`) AS `tahun_pelajaran` from `t00_tahunajaran` ;

-- --------------------------------------------------------

--
-- Structure for view `v01_sekolah_kelas`
--
DROP TABLE IF EXISTS `v01_sekolah_kelas`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v01_sekolah_kelas`  AS  select `a`.`id` AS `kelas_id`,`b`.`Nama` AS `sekolah_nama`,`a`.`Nama` AS `kelas_nama` from (`t02_kelas` `a` left join `t01_sekolah` `b` on((`a`.`sekolah_id` = `b`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t00_tahunajaran`
--
ALTER TABLE `t00_tahunajaran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t01_sekolah`
--
ALTER TABLE `t01_sekolah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t02_kelas`
--
ALTER TABLE `t02_kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t03_siswa`
--
ALTER TABLE `t03_siswa`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t04_rutin`
--
ALTER TABLE `t04_rutin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t05_siswarutin`
--
ALTER TABLE `t05_siswarutin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t06_siswarutinbayar`
--
ALTER TABLE `t06_siswarutinbayar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `t96_employees`
--
ALTER TABLE `t96_employees`
  ADD PRIMARY KEY (`EmployeeID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `t97_userlevels`
--
ALTER TABLE `t97_userlevels`
  ADD PRIMARY KEY (`userlevelid`);

--
-- Indexes for table `t98_userlevelpermissions`
--
ALTER TABLE `t98_userlevelpermissions`
  ADD PRIMARY KEY (`userlevelid`,`tablename`);

--
-- Indexes for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t00_tahunajaran`
--
ALTER TABLE `t00_tahunajaran`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t01_sekolah`
--
ALTER TABLE `t01_sekolah`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t02_kelas`
--
ALTER TABLE `t02_kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t03_siswa`
--
ALTER TABLE `t03_siswa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t04_rutin`
--
ALTER TABLE `t04_rutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t05_siswarutin`
--
ALTER TABLE `t05_siswarutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t06_siswarutinbayar`
--
ALTER TABLE `t06_siswarutinbayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=417;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
