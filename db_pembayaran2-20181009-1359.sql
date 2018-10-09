-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 09, 2018 at 08:58 AM
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
(1, 1, 1, 'A0001', 'Abu');

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
(1, 1, 1, 300000.00),
(2, 1, 3, 350000.00);

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
(1, 1, 1, 1, 1, 1, 7, 2018, NULL, 0.00),
(2, 1, 1, 1, 1, 1, 8, 2018, NULL, 0.00),
(3, 1, 1, 1, 1, 1, 9, 2018, NULL, 0.00),
(4, 1, 1, 1, 1, 1, 10, 2018, NULL, 0.00),
(5, 1, 1, 1, 1, 1, 11, 2018, NULL, 0.00),
(6, 1, 1, 1, 1, 1, 12, 2018, NULL, 0.00),
(7, 1, 1, 1, 1, 1, 1, 2019, NULL, 0.00),
(8, 1, 1, 1, 1, 1, 2, 2019, NULL, 0.00),
(9, 1, 1, 1, 1, 1, 3, 2019, NULL, 0.00),
(10, 1, 1, 1, 1, 1, 4, 2019, NULL, 0.00),
(11, 1, 1, 1, 1, 1, 5, 2019, NULL, 0.00),
(12, 1, 1, 1, 1, 1, 6, 2019, NULL, 0.00),
(13, 1, 1, 1, 1, 2, 7, 2018, NULL, 0.00),
(14, 1, 1, 1, 1, 2, 8, 2018, NULL, 0.00),
(15, 1, 1, 1, 1, 2, 9, 2018, NULL, 0.00),
(16, 1, 1, 1, 1, 2, 10, 2018, NULL, 0.00),
(17, 1, 1, 1, 1, 2, 11, 2018, NULL, 0.00),
(18, 1, 1, 1, 1, 2, 12, 2018, NULL, 0.00),
(19, 1, 1, 1, 1, 2, 1, 2019, NULL, 0.00),
(20, 1, 1, 1, 1, 2, 2, 2019, NULL, 0.00),
(21, 1, 1, 1, 1, 2, 3, 2019, NULL, 0.00),
(22, 1, 1, 1, 1, 2, 4, 2019, NULL, 0.00),
(23, 1, 1, 1, 1, 2, 5, 2019, NULL, 0.00),
(24, 1, 1, 1, 1, 2, 6, 2019, NULL, 0.00);

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
(145, '2018-10-09 13:26:02', '/pembayaran2/t03_siswaadd.php', '1', '*** Batch insert successful ***', 't05_siswarutin', '', '', '', '');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t04_rutin`
--
ALTER TABLE `t04_rutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t05_siswarutin`
--
ALTER TABLE `t05_siswarutin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `t06_siswarutinbayar`
--
ALTER TABLE `t06_siswarutinbayar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `t96_employees`
--
ALTER TABLE `t96_employees`
  MODIFY `EmployeeID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `t99_audittrail`
--
ALTER TABLE `t99_audittrail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=146;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
