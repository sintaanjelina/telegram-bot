-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jul 03, 2019 at 08:51 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laboratorium`
--

-- --------------------------------------------------------

--
-- Table structure for table `aslab`
--

CREATE TABLE `aslab` (
  `id_aslab` int(3) NOT NULL,
  `nim` int(10) NOT NULL,
  `nama_aslab` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aslab`
--

INSERT INTO `aslab` (`id_aslab`, `nim`, `nama_aslab`, `password`) VALUES
(1, 161402004, 'Muhibuddin', 'muhibuddin'),
(2, 161402106, 'Emmanuella Anggi', 'emmanuella'),
(3, 161402100, 'Sinta Anjelina', 'sintasinta'),
(4, 161402088, 'Andini Pratiwi', 'andini'),
(5, 161402027, 'Fitri Nanda Yani', 'fitriny'),
(6, 161402002, 'Hanna Rabitha Hasni', 'hannadugong'),
(7, 151402081, 'Muhammad Arka Kharisma', 'bangarka'),
(8, 161402028, 'Febria Sahrina', 'ririfebria'),
(9, 161402063, 'Hari Purnomo Aji', 'hariaji'),
(10, 161402025, 'Teguh Kirana Berutu', 'teguhkirana'),
(11, 151402019, 'Firza Rinandha Nasution', 'bangfirza'),
(12, 161402007, 'Ilham Kurnia Wahyudi Rusdi', 'ilhamkwr'),
(13, 151402088, 'Hanafi', 'banghanafi'),
(14, 151402076, 'Virliansi Adrisa Utami', 'kakvirli'),
(15, 151402011, 'Mia Rahma Dhita', 'kakmia'),
(16, 151402097, 'Silvia Mawarni', 'kakcipi'),
(17, 161402017, 'Jhon Rendy Sortono', 'jhonrendy'),
(18, 151402111, 'Muhammad Iqbal Fajar', 'bangibal'),
(19, 161402120, 'Fitria Adine Yasmine Belinda', 'kakadine'),
(20, 161402059, 'Sahat Gebima Sihotang', 'sahatgebima'),
(21, 161402065, 'Aldo Stepanus Simarmata', 'aldostepanus'),
(22, 151402017, 'Tata Feraro Mukarram', 'bangtata'),
(23, 151402034, 'Afdhalul Ihsan Nasution', 'bangdalul'),
(24, 151402075, 'Faris Zharfan Alif', 'bangfaris'),
(25, 131402000, 'Muhammad Iqbal Rizky', 'bangiqbal'),
(26, 141402086, 'Muhammad Aidiel Rachman Putra', 'bangidel');

-- --------------------------------------------------------

--
-- Table structure for table `catatan`
--

CREATE TABLE `catatan` (
  `no` int(11) NOT NULL,
  `id` varchar(50) NOT NULL,
  `waktu` date NOT NULL,
  `pesan` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `catatan`
--

INSERT INTO `catatan` (`no`, `id`, `waktu`, `pesan`) VALUES
(14, '856934097', '2019-06-03', 'aku galau aned gara2 homina'),
(17, '890890326', '2019-06-07', 'ajhsd ajhdad ajhsdaj');

-- --------------------------------------------------------

--
-- Table structure for table `data_telegram`
--

CREATE TABLE `data_telegram` (
  `NAMA` varchar(100) NOT NULL,
  `ALAMAT` varchar(300) DEFAULT NULL,
  `HP` varchar(100) DEFAULT NULL,
  `TANGGAL` datetime DEFAULT NULL,
  `chat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `data_telegram`
--

INSERT INTO `data_telegram` (`NAMA`, `ALAMAT`, `HP`, `TANGGAL`, `chat_id`) VALUES
('', '', '', '2019-06-01 11:25:15', NULL),
('', '', '', '2019-06-01 12:14:38', 890890326),
('', '', '', '2019-06-01 12:16:06', 890890326),
('NAMA', 'ALAMAT', 'HP', '2019-06-01 12:17:53', 890890326),
('NAMAKU', 'ALAMATKU', 'HP', '2019-06-01 12:19:59', 890890326);

-- --------------------------------------------------------

--
-- Table structure for table `jadwal`
--

CREATE TABLE `jadwal` (
  `id_jadwal` int(2) NOT NULL,
  `id_aslab` int(2) NOT NULL,
  `id_mk` int(2) NOT NULL,
  `id_kelas` int(2) NOT NULL,
  `id_waktu` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jadwal`
--

INSERT INTO `jadwal` (`id_jadwal`, `id_aslab`, `id_mk`, `id_kelas`, `id_waktu`) VALUES
(1, 1, 1, 1, 135),
(2, 2, 2, 2, 140),
(4, 4, 4, 4, 130),
(49, 7, 17, 14, 135),
(50, 3, 4, 3, 145),
(51, 8, 4, 1, 33),
(52, 12, 3, 1, 139),
(53, 3, 3, 4, 1),
(54, 3, 16, 17, 159),
(55, 3, 26, 19, 2);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(2) NOT NULL,
  `kom` varchar(10) NOT NULL,
  `angkatan` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `kom`, `angkatan`) VALUES
(1, 'A1', 2018),
(2, 'A2', 2018),
(3, 'B1', 2018),
(4, 'B2', 2018),
(5, 'C1', 2018),
(6, 'C2', 2018),
(7, 'A1', 2017),
(8, 'A2', 2017),
(9, 'B1', 2017),
(10, 'B2', 2017),
(11, 'C1', 2017),
(12, 'C2', 2017),
(13, 'A1', 2016),
(14, 'A2', 2016),
(15, 'B1', 2016),
(16, 'B2 ', 2016),
(17, 'C1', 2016),
(18, 'C2', 2016),
(19, 'A1', 2015),
(20, 'A2', 2015),
(21, 'B1', 2015),
(22, 'B2', 2015),
(23, 'C1', 2015),
(24, 'C2', 2015);

-- --------------------------------------------------------

--
-- Table structure for table `matakuliah`
--

CREATE TABLE `matakuliah` (
  `id_mk` int(3) NOT NULL,
  `nama_mk` varchar(50) NOT NULL,
  `semester` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `matakuliah`
--

INSERT INTO `matakuliah` (`id_mk`, `nama_mk`, `semester`) VALUES
(1, 'Dasar Pemrograman', 1),
(2, 'Pemrograman Web', 1),
(3, 'Pemrograman Web Lanjutan', 2),
(4, 'Pemrograman Berorientasi Objek', 2),
(5, 'Komunikasi Data dan Jaringan Komputer', 3),
(6, 'Sistem Basis Data', 3),
(7, 'Web Semantik', 3),
(8, 'Struktur Data dan Algoritma', 3),
(9, 'Interaksi Manusia dan Komputer', 3),
(10, 'Manajemen Sistem Basis Data', 4),
(11, 'Pemrograman Berorientasi Objek Lanjutan', 4),
(12, 'Administrasi dan Desain Jaringan', 4),
(13, 'Desain Interaksi', 5),
(14, 'Arsitektur Data', 5),
(15, 'Sistem Administrasi Server', 5),
(16, 'Kecerdasan Buatan', 5),
(17, 'Pemrograman Integratif', 6),
(18, 'Efek Visual dan Animasi', 6),
(19, 'Pembelajaran Mesin', 6),
(20, 'Pemrograman Terdistribusi dan Paralel', 6),
(21, 'Routing Jaringan', 6),
(22, 'Pemrograman Mobile', 7),
(23, 'Pembelajaran Mesin Lanjutan', 7),
(24, 'Sistem Interaktif', 7),
(25, 'Sistem Sensor dan Aplikasi', 7),
(26, 'Virtual dan Augmented Reality', 8),
(27, 'Pemrosesan Citra Digital', 8),
(28, 'Digital Forensik', 8);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_jadwal`
--
CREATE TABLE `v_jadwal` (
`id_aslab` int(3)
,`id_kelas` int(2)
,`id_mk` int(3)
,`id_waktu` int(2)
,`id_jadwal` int(2)
,`kom` varchar(10)
,`angkatan` int(4)
,`hari` varchar(10)
,`semester` int(2)
,`nama_mk` varchar(50)
,`jam` varchar(20)
,`ruangan` varchar(30)
,`nama_aslab` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `waktu`
--

CREATE TABLE `waktu` (
  `id_waktu` int(2) NOT NULL,
  `jam` varchar(20) NOT NULL,
  `hari` varchar(10) NOT NULL,
  `ruangan` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `waktu`
--

INSERT INTO `waktu` (`id_waktu`, `jam`, `hari`, `ruangan`) VALUES
(1, '08.00-09.40', 'Senin', 'Jaringan 1'),
(2, '09.40-11.20', 'Senin', 'Jaringan 1'),
(3, '11.20-13.00', 'Senin', 'Jaringan 1'),
(4, '13.00-14.40', 'Senin', 'Jaringan 1'),
(5, '14.40-16.20', 'Senin', 'Jaringan 1'),
(6, '08.00-09.40', 'Senin', 'Jaringan 2'),
(7, '09.40-11.20', 'Senin', 'Jaringan 2'),
(8, '11.20-13.00', 'Senin', 'Jaringan 2'),
(9, '13.00-14.40', 'Senin', 'Jaringan 2'),
(10, '14.40-16.20', 'Senin', 'Jaringan 2'),
(11, '08.00-09.40', 'Senin', 'Database'),
(12, '09.40-11.20', 'Senin', 'Database'),
(13, '11.20-13.00', 'Senin', 'Database'),
(14, '13.00-14.40', 'Senin', 'Database'),
(15, '14.40-16.20', 'Senin', 'Database'),
(16, '08.00-09.40', 'Senin', 'Multimedia'),
(17, '09.40-11.20', 'Senin', 'Multimedia'),
(18, '11.20-13.00', 'Senin', 'Multimedia'),
(19, '13.00-14.40', 'Senin', 'Multimedia'),
(20, '14.40-16.20', 'Senin', 'Multimedia'),
(21, '08.00-09.40', 'Senin', 'Pemrograman 1'),
(22, '09.40-11.20', 'Senin', 'Pemrograman 1'),
(23, '11.20-13.00', 'Senin', 'Pemrograman 1'),
(24, '13.00-14.40', 'Senin', 'Pemrograman 1'),
(25, '14.40-16.20', 'Senin', 'Pemrograman 1'),
(26, '08.00-09.40', 'Senin', 'Pemrograman 2'),
(27, '09.40-11.20', 'Senin', 'Pemrograman 2'),
(28, '11.20-13.00', 'Senin', 'Pemrograman 2'),
(29, '13.00-14.40', 'Senin', 'Pemrograman 2'),
(30, '14.40-16.20', 'Senin', 'Pemrograman 2'),
(31, '08.00-09.40', 'Senin', 'Pemrograman 3'),
(32, '09.40-11.20', 'Senin', 'Pemrograman 3'),
(33, '11.20-13.00', 'Senin', 'Pemrograman 3'),
(34, '13.00-14.40', 'Senin', 'Pemrograman 3'),
(35, '14.40-16.20', 'Senin', 'Pemrograman 3'),
(36, '08.00-09.40', 'Senin', 'Pemrograman 4'),
(37, '09.40-11.20', 'Senin', 'Pemrograman 4'),
(38, '11.20-13.00', 'Senin', 'Pemrograman 4'),
(39, '13.00-14.40', 'Senin', 'Pemrograman 4'),
(40, '14.40-16.20', 'Senin', 'Pemrograman 4'),
(41, '08.00-09.40', 'Selasa', 'Jaringan 1'),
(42, '09.40-11.20', 'Selasa', 'Jaringan 1'),
(43, '11.20-13.00', 'Selasa', 'Jaringan 1'),
(44, '13.00-14.40', 'Selasa', 'Jaringan 1'),
(45, '14.40-16.20', 'Selasa', 'Jaringan 1'),
(46, '08.00-09.40', 'Selasa', 'Jaringan 2'),
(47, '09.40-11.20', 'Selasa', 'Jaringan 2'),
(48, '11.20-13.00', 'Selasa', 'Jaringan 2'),
(49, '13.00-14.40', 'Selasa', 'Jaringan 2'),
(50, '14.40-16.20', 'Selasa', 'Jaringan 2'),
(51, '08.00-09.40', 'Selasa', 'Database'),
(52, '09.40-11.20', 'Selasa', 'Database'),
(53, '11.20-13.00', 'Selasa', 'Database'),
(54, '13.00-14.40', 'Selasa', 'Database'),
(55, '14.40-16.20', 'Selasa', 'Database'),
(56, '08.00-09.40', 'Selasa', 'Multimedia'),
(57, '09.40-11.20', 'Selasa', 'Multimedia'),
(58, '11.20-13.00', 'Selasa', 'Multimedia'),
(59, '13.00-14.40', 'Selasa', 'Multimedia'),
(60, '14.40-16.20', 'Selasa', 'Multimedia'),
(61, '08.00-09.40', 'Selasa', 'Pemrograman 1'),
(62, '09.40-11.20', 'Selasa', 'Pemrograman 1'),
(63, '11.20-13.00', 'Selasa', 'Pemrograman 1'),
(64, '13.00-14.40', 'Selasa', 'Pemrograman 1'),
(65, '14.40-16.20', 'Selasa', 'Pemrograman 1'),
(66, '08.00-09.40', 'Selasa', 'Pemrograman 2'),
(67, '09.40-11.20', 'Selasa', 'Pemrograman 2'),
(68, '11.20-13.00', 'Selasa', 'Pemrograman 2'),
(69, '13.00-14.40', 'Selasa', 'Pemrograman 2'),
(70, '14.40-16.20', 'Selasa', 'Pemrograman 2'),
(71, '08.00-09.40', 'Selasa', 'Pemrograman 3'),
(72, '09.40-11.20', 'Selasa', 'Pemrograman 3'),
(73, '11.20-13.00', 'Selasa', 'Pemrograman 3'),
(74, '13.00-14.40', 'Selasa', 'Pemrograman 3'),
(75, '14.40-16.20', 'Selasa', 'Pemrograman 3'),
(76, '08.00-09.40', 'Selasa', 'Pemrograman 4'),
(77, '09.40-11.20', 'Selasa', 'Pemrograman 4'),
(78, '11.20-13.00', 'Selasa', 'Pemrograman 4'),
(79, '13.00-14.40', 'Selasa', 'Pemrograman 4'),
(80, '14.40-16.20', 'Selasa', 'Pemrograman 4'),
(81, '08.00-09.40', 'Rabu', 'Jaringan 1'),
(82, '09.40-11.20', 'Rabu', 'Jaringan 1'),
(83, '11.20-13.00', 'Rabu', 'Jaringan 1'),
(84, '13.00-14.40', 'Rabu', 'Jaringan 1'),
(85, '14.40-16.20', 'Rabu', 'Jaringan 1'),
(86, '08.00-09.40', 'Rabu', 'Jaringan 2'),
(87, '09.40-11.20', 'Rabu', 'Jaringan 2'),
(88, '11.20-13.00', 'Rabu', 'Jaringan 2'),
(89, '13.00-14.40', 'Rabu', 'Jaringan 2'),
(90, '14.40-16.20', 'Rabu', 'Jaringan 2'),
(91, '08.00-09.40', 'Rabu', 'Database'),
(92, '09.40-11.20', 'Rabu', 'Database'),
(93, '11.20-13.00', 'Rabu', 'Database'),
(94, '13.00-14.40', 'Rabu', 'Database'),
(95, '14.40-16.20', 'Rabu', 'Database'),
(96, '08.00-09.40', 'Rabu', 'Multimedia'),
(97, '09.40-11.20', 'Rabu', 'Multimedia'),
(98, '11.20-13.00', 'Rabu', 'Multimedia'),
(99, '13.00-14.40', 'Rabu', 'Multimedia'),
(100, '14.40-16.20', 'Rabu', 'Multimedia'),
(101, '08.00-09.40', 'Rabu', 'Pemrograman 1'),
(102, '09.40-11.20', 'Rabu', 'Pemrograman 1'),
(103, '11.20-13.00', 'Rabu', 'Pemrograman 1'),
(104, '13.00-14.40', 'Rabu', 'Pemrograman 1'),
(105, '14.40-16.20', 'Rabu', 'Pemrograman 1'),
(106, '08.00-09.40', 'Rabu', 'Pemrograman 2'),
(107, '09.40-11.20', 'Rabu', 'Pemrograman 2'),
(108, '11.20-13.00', 'Rabu', 'Pemrograman 2'),
(109, '13.00-14.40', 'Rabu', 'Pemrograman 2'),
(110, '14.40-16.20', 'Rabu', 'Pemrograman 2'),
(111, '08.00-09.40', 'Rabu', 'Pemrograman 3'),
(112, '09.40-11.20', 'Rabu', 'Pemrograman 3'),
(113, '11.20-13.00', 'Rabu', 'Pemrograman 3'),
(114, '13.00-14.40', 'Rabu', 'Pemrograman 3'),
(115, '14.40-16.20', 'Rabu', 'Pemrograman 3'),
(116, '08.00-09.40', 'Rabu', 'Pemrograman 4'),
(117, '09.40-11.20', 'Rabu', 'Pemrograman 4'),
(118, '11.20-13.00', 'Rabu', 'Pemrograman 4'),
(119, '13.00-14.40', 'Rabu', 'Pemrograman 4'),
(120, '14.40-16.20', 'Rabu', 'Pemrograman 4'),
(121, '08.00-09.40', 'Kamis', 'Jaringan 1'),
(122, '09.40-11.20', 'Kamis', 'Jaringan 1'),
(123, '11.20-13.00', 'Kamis', 'Jaringan 1'),
(124, '13.00-14.40', 'Kamis', 'Jaringan 1'),
(125, '14.40-16.20', 'Kamis', 'Jaringan 1'),
(126, '08.00-09.40', 'Kamis', 'Jaringan 2'),
(127, '09.40-11.20', 'Kamis', 'Jaringan 2'),
(128, '11.20-13.00', 'Kamis', 'Jaringan 2'),
(129, '13.00-14.40', 'Kamis', 'Jaringan 2'),
(130, '14.40-16.20', 'Kamis', 'Jaringan 2'),
(131, '08.00-09.40', 'Kamis', 'Database'),
(132, '09.40-11.20', 'Kamis', 'Database'),
(133, '11.20-13.00', 'Kamis', 'Database'),
(134, '13.00-14.40', 'Kamis', 'Database'),
(135, '14.40-16.20', 'Kamis', 'Database'),
(136, '08.00-09.40', 'Kamis', 'Multimedia'),
(137, '09.40-11.20', 'Kamis', 'Multimedia'),
(138, '11.20-13.00', 'Kamis', 'Multimedia'),
(139, '13.00-14.40', 'Kamis', 'Multimedia'),
(140, '14.40-16.20', 'Kamis', 'Multimedia'),
(141, '08.00-09.40', 'Kamis', 'Pemrograman 1'),
(142, '09.40-11.20', 'Kamis', 'Pemrograman 1'),
(143, '11.20-13.00', 'Kamis', 'Pemrograman 1'),
(144, '13.00-14.40', 'Kamis', 'Pemrograman 1'),
(145, '14.40-16.20', 'Kamis', 'Pemrograman 1'),
(146, '08.00-09.40', 'Kamis', 'Pemrograman 2'),
(147, '09.40-11.20', 'Kamis', 'Pemrograman 2'),
(148, '11.20-13.00', 'Kamis', 'Pemrograman 2'),
(149, '13.00-14.40', 'Kamis', 'Pemrograman 2'),
(150, '14.40-16.20', 'Kamis', 'Pemrograman 2'),
(151, '08.00-09.40', 'Kamis', 'Pemrograman 3'),
(152, '09.40-11.20', 'Kamis', 'Pemrograman 3'),
(153, '11.20-13.00', 'Kamis', 'Pemrograman 3'),
(154, '13.00-14.40', 'Kamis', 'Pemrograman 3'),
(155, '14.40-16.20', 'Kamis', 'Pemrograman 3'),
(156, '08.00-09.40', 'Kamis', 'Pemrograman 4'),
(157, '09.40-11.20', 'Kamis', 'Pemrograman 4'),
(158, '11.20-13.00', 'Kamis', 'Pemrograman 4'),
(159, '13.00-14.40', 'Kamis', 'Pemrograman 4'),
(160, '14.40-16.20', 'Kamis', 'Pemrograman 4'),
(161, '08.00-09.40', 'Jumat', 'Jaringan 1'),
(162, '09.40-11.20', 'Jumat', 'Jaringan 1'),
(163, '11.20-13.00', 'Jumat', 'Jaringan 1'),
(164, '13.00-14.40', 'Jumat', 'Jaringan 1'),
(165, '14.40-16.20', 'Jumat', 'Jaringan 1'),
(166, '08.00-09.40', 'Jumat', 'Jaringan 2'),
(167, '09.40-11.20', 'Jumat', 'Jaringan 2'),
(168, '11.20-13.00', 'Jumat', 'Jaringan 2'),
(169, '13.00-14.40', 'Jumat', 'Jaringan 2'),
(170, '14.40-16.20', 'Jumat', 'Jaringan 2'),
(171, '08.00-09.40', 'Jumat', 'Database'),
(172, '09.40-11.20', 'Jumat', 'Database'),
(173, '11.20-13.00', 'Jumat', 'Database'),
(174, '13.00-14.40', 'Jumat', 'Database'),
(175, '14.40-16.20', 'Jumat', 'Database'),
(176, '08.00-09.40', 'Jumat', 'Multimedia'),
(177, '09.40-11.20', 'Jumat', 'Multimedia'),
(178, '11.20-13.00', 'Jumat', 'Multimedia'),
(179, '13.00-14.40', 'Jumat', 'Multimedia'),
(180, '14.40-16.20', 'Jumat', 'Multimedia'),
(181, '08.00-09.40', 'Jumat', 'Pemrograman 1'),
(182, '09.40-11.20', 'Jumat', 'Pemrograman 1'),
(183, '11.20-13.00', 'Jumat', 'Pemrograman 1'),
(184, '13.00-14.40', 'Jumat', 'Pemrograman 1'),
(185, '14.40-16.20', 'Jumat', 'Pemrograman 1'),
(186, '08.00-09.40', 'Jumat', 'Pemrograman 2'),
(187, '09.40-11.20', 'Jumat', 'Pemrograman 2'),
(188, '11.20-13.00', 'Jumat', 'Pemrograman 2'),
(189, '13.00-14.40', 'Jumat', 'Pemrograman 2'),
(190, '14.40-16.20', 'Jumat', 'Pemrograman 2'),
(191, '08.00-09.40', 'Jumat', 'Pemrograman 3'),
(192, '09.40-11.20', 'Jumat', 'Pemrograman 3'),
(193, '11.20-13.00', 'Jumat', 'Pemrograman 3'),
(194, '13.00-14.40', 'Jumat', 'Pemrograman 3'),
(195, '14.40-16.20', 'Jumat', 'Pemrograman 3'),
(196, '08.00-09.40', 'Jumat', 'Pemrograman 4'),
(197, '09.40-11.20', 'Jumat', 'Pemrograman 4'),
(198, '11.20-13.00', 'Jumat', 'Pemrograman 4'),
(199, '13.00-14.40', 'Jumat', 'Pemrograman 4'),
(200, '14.40-16.20', 'Jumat', 'Pemrograman 4');

-- --------------------------------------------------------

--
-- Structure for view `v_jadwal`
--
DROP TABLE IF EXISTS `v_jadwal`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_jadwal`  AS  select `a`.`id_aslab` AS `id_aslab`,`b`.`id_kelas` AS `id_kelas`,`c`.`id_mk` AS `id_mk`,`d`.`id_waktu` AS `id_waktu`,`e`.`id_jadwal` AS `id_jadwal`,`b`.`kom` AS `kom`,`b`.`angkatan` AS `angkatan`,`d`.`hari` AS `hari`,`c`.`semester` AS `semester`,`c`.`nama_mk` AS `nama_mk`,`d`.`jam` AS `jam`,`d`.`ruangan` AS `ruangan`,`a`.`nama_aslab` AS `nama_aslab` from ((((`aslab` `a` join `kelas` `b`) join `matakuliah` `c`) join `waktu` `d`) join `jadwal` `e`) where ((`e`.`id_aslab` = `a`.`id_aslab`) and (`e`.`id_mk` = `c`.`id_mk`) and (`e`.`id_kelas` = `b`.`id_kelas`) and (`e`.`id_waktu` = `d`.`id_waktu`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aslab`
--
ALTER TABLE `aslab`
  ADD PRIMARY KEY (`id_aslab`),
  ADD KEY `id_aslab` (`id_aslab`);

--
-- Indexes for table `catatan`
--
ALTER TABLE `catatan`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD PRIMARY KEY (`id_jadwal`),
  ADD KEY `fk_mk` (`id_mk`),
  ADD KEY `fk_aslab` (`id_aslab`),
  ADD KEY `fk_kelas` (`id_kelas`),
  ADD KEY `fk_waktu` (`id_waktu`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `matakuliah`
--
ALTER TABLE `matakuliah`
  ADD PRIMARY KEY (`id_mk`),
  ADD KEY `id_mk` (`id_mk`);

--
-- Indexes for table `waktu`
--
ALTER TABLE `waktu`
  ADD PRIMARY KEY (`id_waktu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `aslab`
--
ALTER TABLE `aslab`
  MODIFY `id_aslab` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `catatan`
--
ALTER TABLE `catatan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `jadwal`
--
ALTER TABLE `jadwal`
  MODIFY `id_jadwal` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `matakuliah`
--
ALTER TABLE `matakuliah`
  MODIFY `id_mk` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
--
-- AUTO_INCREMENT for table `waktu`
--
ALTER TABLE `waktu`
  MODIFY `id_waktu` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `jadwal`
--
ALTER TABLE `jadwal`
  ADD CONSTRAINT `fk_aslab` FOREIGN KEY (`id_aslab`) REFERENCES `aslab` (`id_aslab`),
  ADD CONSTRAINT `fk_kelas` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`),
  ADD CONSTRAINT `fk_mk` FOREIGN KEY (`id_mk`) REFERENCES `matakuliah` (`id_mk`),
  ADD CONSTRAINT `fk_waktu` FOREIGN KEY (`id_waktu`) REFERENCES `waktu` (`id_waktu`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
