-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 30, 2022 at 10:13 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `inventarisasi_jurusan`
--

-- --------------------------------------------------------

--
-- Table structure for table `foto_barang`
--

CREATE TABLE `foto_barang` (
  `foto_id` int(11) NOT NULL,
  `barang_fk` varchar(32) NOT NULL,
  `foto_nama` varchar(128) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto_barang`
--

INSERT INTO `foto_barang` (`foto_id`, `barang_fk`, `foto_nama`, `created_at`, `updated_at`) VALUES
(1, 'sar404pa1', '20220202_095243.jpg', '2022-03-01 02:11:30', '2022-03-01 02:11:30'),
(2, 'sar404pa2', '20220202_95244.jpg', '2022-03-01 02:11:35', '2022-03-01 02:11:35'),
(3, 'sar404le3', '20220202_095320.jpg', '2022-03-01 02:11:40', '2022-03-01 02:11:40'),
(4, 'sar404le3', '20220202_095334.jpg', '2022-03-01 02:11:40', '2022-03-01 02:11:40'),
(5, 'kom404cp4', '20220202_095723.jpg', '2022-03-01 02:11:46', '2022-03-01 02:11:46'),
(6, 'kom404cp4', '20220202_095733.jpg', '2022-03-01 02:11:46', '2022-03-01 02:11:46'),
(7, 'kom404cp4', '20220202_095752.jpg', '2022-03-01 02:11:46', '2022-03-01 02:11:46'),
(8, 'kom404cp4', '20220202_095840.jpg', '2022-03-01 02:11:46', '2022-03-01 02:11:46'),
(9, 'kom404cp4', '20220202_095849.jpg', '2022-03-01 02:11:46', '2022-03-01 02:11:46'),
(10, 'kom404mo5', '20220202_100111.jpg', '2022-03-01 02:11:51', '2022-03-01 02:11:51'),
(11, 'kom404mo5', '20220202_100116.jpg', '2022-03-01 02:11:51', '2022-03-01 02:11:51'),
(13, 'kom404ke7', '20220202_100452.jpg', '2022-03-01 02:12:09', '2022-03-01 02:12:09'),
(14, 'sar409ku8', '20220202_101809.jpg', '2022-03-01 02:12:13', '2022-03-01 02:12:13'),
(15, 'sar409ku8', '20220202_101819.jpg', '2022-03-01 02:12:13', '2022-03-01 02:12:13'),
(16, 'sar409me9', '20220202_101929.jpg', '2022-03-01 02:12:19', '2022-03-01 02:12:19'),
(17, 'sar409me9', '20220202_101944.jpg', '2022-03-01 02:12:19', '2022-03-01 02:12:19'),
(18, 'sar409me9', '20220202_101954.jpg', '2022-03-01 02:12:19', '2022-03-01 02:12:19'),
(19, 'kom404mo10', '20220202_100142.jpg', '2022-03-01 02:12:37', '2022-03-01 02:12:37'),
(20, 'kom404mo10', '20220202_100202.jpg', '2022-03-01 02:12:37', '2022-03-01 02:12:37'),
(21, 'sar404me11', '20220202_100601.jpg', '2022-03-02 00:55:03', '2022-03-02 00:55:03'),
(22, 'sar404me11', '20220202_100618.jpg', '2022-03-02 00:55:03', '2022-03-02 00:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `foto_barang_pending`
--

CREATE TABLE `foto_barang_pending` (
  `foto_pending_id` int(11) NOT NULL,
  `pending_fk` varchar(32) NOT NULL,
  `foto_pending_nama` varchar(128) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `foto_barang_pending`
--

INSERT INTO `foto_barang_pending` (`foto_pending_id`, `pending_fk`, `foto_pending_nama`, `created_at`, `updated_at`) VALUES
(1, 'p-sar404pa1', '20220202_095243.jpg', '2022-03-01 02:04:33', '2022-03-01 02:04:33'),
(2, 'p-sar404pa2', '20220202_95244.jpg', '2022-03-01 02:04:33', '2022-03-01 02:04:33'),
(3, 'p-sar404le3', '20220202_095320.jpg', '2022-03-01 02:05:14', '2022-03-01 02:05:14'),
(4, 'p-sar404le3', '20220202_095334.jpg', '2022-03-01 02:05:14', '2022-03-01 02:05:14'),
(5, 'p-kom404cp4', '20220202_095723.jpg', '2022-03-01 02:06:18', '2022-03-01 02:06:18'),
(6, 'p-kom404cp4', '20220202_095733.jpg', '2022-03-01 02:06:18', '2022-03-01 02:06:18'),
(7, 'p-kom404cp4', '20220202_095752.jpg', '2022-03-01 02:06:18', '2022-03-01 02:06:18'),
(8, 'p-kom404cp4', '20220202_095840.jpg', '2022-03-01 02:06:18', '2022-03-01 02:06:18'),
(9, 'p-kom404cp4', '20220202_095849.jpg', '2022-03-01 02:06:18', '2022-03-01 02:06:18'),
(10, 'p-kom404mp5', '20220202_100111.jpg', '2022-03-01 02:07:25', '2022-03-01 02:07:25'),
(11, 'p-kom404mp5', '20220202_100116.jpg', '2022-03-01 02:07:25', '2022-03-01 02:07:25'),
(12, 'p-kom404mo6', '20220202_100142.jpg', '2022-03-01 02:08:23', '2022-03-01 02:08:23'),
(13, 'p-kom404mo6', '20220202_100202.jpg', '2022-03-01 02:08:23', '2022-03-01 02:08:23'),
(14, 'p-kom404ke7', '20220202_100452.jpg', '2022-03-01 02:09:05', '2022-03-01 02:09:05'),
(15, 'p-sar409ku8', '20220202_101809.jpg', '2022-03-01 02:10:37', '2022-03-01 02:10:37'),
(16, 'p-sar409ku8', '20220202_101819.jpg', '2022-03-01 02:10:37', '2022-03-01 02:10:37'),
(17, 'p-sar409me9', '20220202_101929.jpg', '2022-03-01 02:11:10', '2022-03-01 02:11:10'),
(18, 'p-sar409me9', '20220202_101944.jpg', '2022-03-01 02:11:10', '2022-03-01 02:11:10'),
(19, 'p-sar409me9', '20220202_101954.jpg', '2022-03-01 02:11:10', '2022-03-01 02:11:10'),
(20, 'p-sar404me10', '20220202_100601.jpg', '2022-03-02 00:50:56', '2022-03-02 00:50:56'),
(21, 'p-sar404me10', '20220202_100618.jpg', '2022-03-02 00:50:56', '2022-03-02 00:50:56');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_barang`
--

CREATE TABLE `informasi_barang` (
  `barang_id` int(11) NOT NULL,
  `barang_kode` varchar(32) NOT NULL,
  `barang_nama` varchar(64) NOT NULL,
  `kategori_fk` varchar(32) NOT NULL,
  `barang_merk` varchar(32) DEFAULT NULL,
  `barang_deskripsi` text DEFAULT NULL,
  `barang_tahun_perolehan` year(4) DEFAULT NULL,
  `barang_keadaan` varchar(32) NOT NULL,
  `barang_harga` decimal(10,0) DEFAULT 0,
  `lokasi_fk` varchar(16) NOT NULL,
  `barang_keterangan` text DEFAULT NULL,
  `barang_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '''0'' = INACTIVE, ''1'' = ACTIVE, ''2'' = DIPINJAMKAN',
  `barang_dipinjamkan` tinyint(1) NOT NULL DEFAULT 0 COMMENT '''0'' = TIDAK DIPINJAMKAN, ''1'' = BOLEH DIPINJAMKAN',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi_barang`
--

INSERT INTO `informasi_barang` (`barang_id`, `barang_kode`, `barang_nama`, `kategori_fk`, `barang_merk`, `barang_deskripsi`, `barang_tahun_perolehan`, `barang_keadaan`, `barang_harga`, `lokasi_fk`, `barang_keterangan`, `barang_status`, `barang_dipinjamkan`, `created_at`, `updated_at`) VALUES
(1, 'sar404pa1', 'Papan Tulis', 'Sarana', '', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 0, '2022-03-01 02:11:30', '2022-03-01 02:11:30'),
(2, 'sar404pa2', 'Papan Tulis', 'Sarana', '', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 0, '2022-03-01 02:11:35', '2022-03-01 02:11:35'),
(3, 'sar404le3', 'Lemari', 'Sarana', '', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 0, '2022-03-01 02:11:40', '2022-03-01 02:11:40'),
(4, 'kom404cp4', 'CPU', 'Komputer', 'HP', '', 0000, 'BAIK', '0', 'R.4.04', '', 2, 0, '2022-03-01 02:11:46', '2022-03-02 01:01:57'),
(5, 'kom404mo5', 'Mouse', 'Komputer', 'Logitech', '', 0000, 'BAIK', '0', 'R.4.04', '', 2, 0, '2022-03-01 02:11:51', '2022-03-02 01:01:57'),
(6, 'kom404mp6', 'Mpuse', 'Komputer', 'Logitech', '', 0000, 'BAIK', '0', 'R.4.04', '', 2, 0, '2022-03-01 02:11:51', '2022-03-02 01:01:57'),
(7, 'kom404ke7', 'Keyboard', 'Komputer', 'Logitech', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 1, '2022-03-01 02:12:09', '2022-03-01 02:12:09'),
(8, 'sar409ku8', 'Kursi', 'Sarana', '', '', 0000, 'BAIK', '0', 'R.4.09', '', 1, 0, '2022-03-01 02:12:13', '2022-03-01 02:12:13'),
(9, 'sar409me9', 'Meja Besar', 'Sarana', '', '', 0000, 'BAIK', '0', 'R.4.09', '', 1, 0, '2022-03-01 02:12:19', '2022-03-01 02:12:19'),
(10, 'kom404mo10', 'Monitor', 'Komputer', 'HP', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 1, '2022-03-01 02:12:37', '2022-03-01 02:12:37'),
(11, 'sar404me11', 'Meja', 'Sarana', '', '', 2019, 'BAIK', '0', 'R.4.04', '', 1, 0, '2022-03-02 00:55:03', '2022-03-02 00:55:03');

-- --------------------------------------------------------

--
-- Table structure for table `informasi_barang_pending`
--

CREATE TABLE `informasi_barang_pending` (
  `pending_id` int(11) NOT NULL,
  `pending_kode` varchar(32) NOT NULL,
  `pending_nama` varchar(64) NOT NULL,
  `kategori_fk` varchar(32) NOT NULL,
  `pending_merk` varchar(32) DEFAULT NULL,
  `pending_deskripsi` text DEFAULT NULL,
  `pending_tahun_perolehan` year(4) DEFAULT NULL,
  `pending_keadaan` varchar(32) NOT NULL,
  `pending_harga` decimal(10,0) DEFAULT 0,
  `lokasi_fk` varchar(16) NOT NULL,
  `pending_keterangan` text DEFAULT NULL,
  `pending_status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '''0'' = INACTIVE, ''1'' = ACTIVE, ''2'' = DIPINJAMKAN',
  `pending_dipinjamkan` tinyint(1) NOT NULL DEFAULT 0 COMMENT '''0'' = TIDAK DIPINJAMKAN, ''1'' = BOLEH DIPINJAMKAN',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `informasi_barang_pending`
--

INSERT INTO `informasi_barang_pending` (`pending_id`, `pending_kode`, `pending_nama`, `kategori_fk`, `pending_merk`, `pending_deskripsi`, `pending_tahun_perolehan`, `pending_keadaan`, `pending_harga`, `lokasi_fk`, `pending_keterangan`, `pending_status`, `pending_dipinjamkan`, `created_at`, `updated_at`) VALUES
(1, 'p-sar404pa1', 'Papan Tulis', 'Sarana', '', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 0, '2022-03-01 02:04:33', '2022-03-01 02:04:33'),
(2, 'p-sar404pa2', 'Papan Tulis', 'Sarana', '', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 0, '2022-03-01 02:04:33', '2022-03-01 02:04:33'),
(3, 'p-sar404le3', 'Lemari', 'Sarana', '', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 0, '2022-03-01 02:05:14', '2022-03-01 02:05:14'),
(4, 'p-kom404cp4', 'CPU', 'Komputer', 'HP', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 1, '2022-03-01 02:06:18', '2022-03-01 02:06:18'),
(5, 'p-kom404mp5', 'Mpuse', 'Komputer', 'Logitech', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 1, '2022-03-01 02:07:25', '2022-03-01 02:07:25'),
(6, 'p-kom404mo6', 'Monitor', 'Komputer', 'HP', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 1, '2022-03-01 02:08:23', '2022-03-01 02:08:23'),
(7, 'p-kom404ke7', 'Keyboard', 'Komputer', 'Logitech', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 1, '2022-03-01 02:09:05', '2022-03-01 02:09:05'),
(8, 'p-sar409ku8', 'Kursi', 'Sarana', '', '', 0000, 'BAIK', '0', 'R.4.09', '', 1, 0, '2022-03-01 02:10:37', '2022-03-01 02:10:37'),
(9, 'p-sar409me9', 'Meja Besar', 'Sarana', '', '', 0000, 'BAIK', '0', 'R.4.09', '', 1, 0, '2022-03-01 02:11:10', '2022-03-01 02:11:10'),
(10, 'p-sar404me10', 'Meja', 'Sarana', '', '', 2019, 'BAIK', '0', 'R.4.04', '', 1, 0, '2022-03-02 00:50:56', '2022-03-02 00:50:56'),
(11, 'p-kom404mo11', 'Mouse', 'Komputer', 'Logitech', '', 0000, 'BAIK', '0', 'R.4.04', '', 1, 1, '2022-03-02 00:51:43', '2022-03-02 00:51:43');

-- --------------------------------------------------------

--
-- Table structure for table `jenis_pengelolaan`
--

CREATE TABLE `jenis_pengelolaan` (
  `jenis_id` int(11) NOT NULL,
  `jenis_nama` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_pengelolaan`
--

INSERT INTO `jenis_pengelolaan` (`jenis_id`, `jenis_nama`, `created_at`, `updated_at`) VALUES
(1, 'TAMBAH', '2022-02-10 17:46:34', '2022-02-10 17:46:34'),
(2, 'UBAH', '2022-02-10 17:46:34', '2022-02-10 17:46:34'),
(3, 'HAPUS', '2022-02-10 17:46:34', '2022-02-10 17:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `kategori_barang`
--

CREATE TABLE `kategori_barang` (
  `kategori_id` int(11) NOT NULL,
  `kategori_nama` varchar(32) NOT NULL,
  `kategori_slug` varchar(32) NOT NULL,
  `kategori_keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori_barang`
--

INSERT INTO `kategori_barang` (`kategori_id`, `kategori_nama`, `kategori_slug`, `kategori_keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Elektronik', 'elektronik', 'Barang Inventaris yang merupakan barang elektorik selain dari komponen utama komputer.', '2022-02-06 07:59:03', '2022-02-06 08:10:34'),
(2, 'Komputer', 'komputer', 'Barang Inventaris yang menjadi komponen utama sebuah komputer.', '2022-02-06 08:10:49', '2022-02-06 08:10:49'),
(3, 'Sarana', 'sarana', 'Barang Invetaris Sarana Prasarana Jurusan.', '2022-02-06 08:11:11', '2022-02-28 16:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `kepala_bagian_tu`
--

CREATE TABLE `kepala_bagian_tu` (
  `tu_id` int(11) NOT NULL,
  `tu_nama` varchar(32) NOT NULL,
  `tu_nip` varchar(18) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kepala_bagian_tu`
--

INSERT INTO `kepala_bagian_tu` (`tu_id`, `tu_nama`, `tu_nip`, `created_at`, `updated_at`) VALUES
(1, 'Drs. Satiman', '196005011986031002', '2022-02-08 16:26:15', '2022-02-08 09:46:00');

-- --------------------------------------------------------

--
-- Table structure for table `kumpulan_barang_dipinjam`
--

CREATE TABLE `kumpulan_barang_dipinjam` (
  `kumpulan_id` int(11) NOT NULL,
  `barang_dipinjam_fk` varchar(32) NOT NULL,
  `transaksi_fk` int(11) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kumpulan_barang_dipinjam`
--

INSERT INTO `kumpulan_barang_dipinjam` (`kumpulan_id`, `barang_dipinjam_fk`, `transaksi_fk`, `created_at`, `updated_at`) VALUES
(1, 'kom404cp4', 1, '2022-03-02 01:00:49', '2022-03-02 01:00:49'),
(2, 'kom404mo5', 1, '2022-03-02 01:00:49', '2022-03-02 01:00:49'),
(3, 'kom404mp6', 1, '2022-03-02 01:00:49', '2022-03-02 01:00:49');

-- --------------------------------------------------------

--
-- Table structure for table `lokasi_barang`
--

CREATE TABLE `lokasi_barang` (
  `lokasi_id` int(11) NOT NULL,
  `lokasi_kode` varchar(16) NOT NULL,
  `lokasi_slug` varchar(16) NOT NULL,
  `lokasi_nama` varchar(64) NOT NULL,
  `lokasi_lantai` int(2) NOT NULL,
  `lokasi_fakultas` varchar(128) NOT NULL,
  `lokasi_keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lokasi_barang`
--

INSERT INTO `lokasi_barang` (`lokasi_id`, `lokasi_kode`, `lokasi_slug`, `lokasi_nama`, `lokasi_lantai`, `lokasi_fakultas`, `lokasi_keterangan`, `created_at`, `updated_at`) VALUES
(1, 'R.4.04', 'r404', 'Laboratorium Visi Komputer & Sistem Berintelegensia', 4, 'Sains dan Teknologi', '', '2022-02-06 09:21:58', '2022-02-28 17:02:07'),
(2, 'R.4.05', 'r405', 'Laboratorium Pemrograman & RPL', 4, 'Sains dan Teknologi', '', '2022-02-09 12:28:24', '2022-02-09 12:28:24'),
(3, 'R.4.09', 'r409', 'Ruang Kelas', 4, 'Sains dan Teknologi', '', '2022-03-01 02:09:42', '2022-03-01 02:09:51');

-- --------------------------------------------------------

--
-- Table structure for table `pengelolaan_barang`
--

CREATE TABLE `pengelolaan_barang` (
  `pengelolaan_id` int(11) NOT NULL,
  `pengelolaan_kode` varchar(16) NOT NULL,
  `barang_fk` varchar(32) DEFAULT NULL,
  `pending_fk` varchar(32) DEFAULT NULL,
  `user_fk` varchar(128) DEFAULT NULL,
  `pengelolaan_tanggal` date NOT NULL,
  `jenis_fk` varchar(64) NOT NULL,
  `pengelolaan_status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '''0'' = DITOLAK, ''1'' = DISETUJUI, ''2'' = PENDING',
  `pengelolaan_keterangan` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengelolaan_barang`
--

INSERT INTO `pengelolaan_barang` (`pengelolaan_id`, `pengelolaan_kode`, `barang_fk`, `pending_fk`, `user_fk`, `pengelolaan_tanggal`, `jenis_fk`, `pengelolaan_status`, `pengelolaan_keterangan`, `created_at`, `updated_at`) VALUES
(1, 'tam-p-sar404pa1', NULL, 'p-sar404pa1', 'admin', '2022-03-01', 'TAMBAH', 1, NULL, '2022-03-01 02:04:33', '2022-03-01 02:11:30'),
(2, 'tam-p-sar404pa2', NULL, 'p-sar404pa2', 'admin', '2022-03-01', 'TAMBAH', 1, NULL, '2022-03-01 02:04:33', '2022-03-01 02:11:35'),
(3, 'tam-p-sar404le3', NULL, 'p-sar404le3', 'admin', '2022-03-01', 'TAMBAH', 1, NULL, '2022-03-01 02:05:14', '2022-03-01 02:11:40'),
(4, 'tam-p-kom404cp4', NULL, 'p-kom404cp4', 'admin', '2022-03-01', 'TAMBAH', 1, NULL, '2022-03-01 02:06:18', '2022-03-01 02:11:46'),
(5, 'tam-p-kom404mp5', NULL, 'p-kom404mp5', 'admin', '2022-03-01', 'TAMBAH', 1, NULL, '2022-03-01 02:07:25', '2022-03-01 02:11:51'),
(6, 'tam-p-kom404mo6', NULL, 'p-kom404mo6', 'admin', '2022-03-01', 'TAMBAH', 1, NULL, '2022-03-01 02:08:23', '2022-03-01 02:12:37'),
(7, 'tam-p-kom404ke7', NULL, 'p-kom404ke7', 'admin', '2022-03-01', 'TAMBAH', 1, NULL, '2022-03-01 02:09:05', '2022-03-01 02:12:09'),
(8, 'tam-p-sar409ku8', NULL, 'p-sar409ku8', 'admin', '2022-03-01', 'TAMBAH', 1, NULL, '2022-03-01 02:10:37', '2022-03-01 02:12:13'),
(9, 'tam-p-sar409me9', NULL, 'p-sar409me9', 'admin', '2022-03-01', 'TAMBAH', 1, NULL, '2022-03-01 02:11:10', '2022-03-01 02:12:19'),
(10, 'tam-p-sar404me10', NULL, 'p-sar404me10', 'admin', '2022-03-02', 'TAMBAH', 1, NULL, '2022-03-02 00:50:56', '2022-03-02 00:55:03'),
(11, 'uba-p-kom404mo11', 'kom404mo5', 'p-kom404mo11', 'admin', '2022-03-02', 'UBAH', 1, NULL, '2022-03-02 00:51:43', '2022-03-02 00:57:59');

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_peminjaman`
--

CREATE TABLE `transaksi_peminjaman` (
  `transaksi_id` int(11) NOT NULL,
  `peminjam_fk` varchar(64) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `jurusan_fk` varchar(128) DEFAULT NULL,
  `pengajuan_status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '''-1'' = DIBATALKAN, ''0'' = DITOLAK, ''1'' = DISETUJUI, ''2'' = PENDING',
  `peminjaman_status` tinyint(1) NOT NULL DEFAULT 2 COMMENT '''-1''= Tidak Dipinjam, ''0'' = SUDAH DIKEMBALIKAN, ''1'' = SEDANG DIPINJAM, ''2'' = PENDING',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `transaksi_peminjaman`
--

INSERT INTO `transaksi_peminjaman` (`transaksi_id`, `peminjam_fk`, `tanggal_peminjaman`, `tanggal_pengembalian`, `jurusan_fk`, `pengajuan_status`, `peminjaman_status`, `created_at`, `updated_at`) VALUES
(1, 'peminjam01', '2022-03-02', '2022-03-09', 'ketuajurusan', 1, 1, '2022-03-02 01:00:49', '2022-03-02 01:01:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_jurusan`
--

CREATE TABLE `user_jurusan` (
  `user_id` int(11) NOT NULL,
  `user_nama` varchar(128) NOT NULL,
  `user_slug` varchar(128) NOT NULL,
  `user_nip` varchar(18) DEFAULT '0',
  `user_posisi` varchar(64) NOT NULL DEFAULT 'Admin Jurusan',
  `user_username` varchar(128) NOT NULL,
  `user_password` varchar(128) NOT NULL,
  `user_level` tinyint(1) NOT NULL DEFAULT 3,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_jurusan`
--

INSERT INTO `user_jurusan` (`user_id`, `user_nama`, `user_slug`, `user_nip`, `user_posisi`, `user_username`, `user_password`, `user_level`, `created_at`, `updated_at`) VALUES
(1, 'Cepy Slamet, ST., M.Kom.', 'ketuajurusan', '198002252011011007', 'Ketua Jurusan', 'ketuajurusan', 'ketuajurusan', 1, '2022-02-06 11:53:49', '2022-02-28 17:08:38'),
(2, 'Agung Wahana, M.T., S.E.', 'sekretarisjurusan', '197305312009011003', 'Sekretaris Jurusan', 'sekretarisjurusan', 'sekretarisjurusan', 2, '2022-02-06 11:53:49', '2022-02-28 06:32:13'),
(5, 'Admin Pertama', 'admin', '0000', 'Admin Jurusan', 'admin', 'adminadmin', 3, '2022-02-06 04:56:47', '2022-02-28 10:40:08'),
(6, 'Admin Kedua', 'admindua', '1123213', 'Admin Jurusan', 'admindua', 'admindua', 3, '2022-02-06 05:09:25', '2022-02-28 06:26:11'),
(15, 'Admin Ketiga', 'admintiga', '0', 'Admin Jurusan', 'admintiga', 'admintiga', 3, '2022-02-28 17:08:57', '2022-02-28 17:08:57');

-- --------------------------------------------------------

--
-- Table structure for table `user_peminjam`
--

CREATE TABLE `user_peminjam` (
  `peminjam_id` int(11) NOT NULL,
  `peminjam_nama` varchar(64) NOT NULL,
  `peminjam_slug` varchar(64) NOT NULL,
  `peminjam_hp` varchar(64) NOT NULL,
  `peminjam_alamat` text NOT NULL,
  `peminjam_username` varchar(64) NOT NULL,
  `peminjam_password` varchar(64) NOT NULL,
  `peminjam_level` tinyint(1) NOT NULL DEFAULT 4,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_peminjam`
--

INSERT INTO `user_peminjam` (`peminjam_id`, `peminjam_nama`, `peminjam_slug`, `peminjam_hp`, `peminjam_alamat`, `peminjam_username`, `peminjam_password`, `peminjam_level`, `created_at`, `updated_at`) VALUES
(1, 'Akbar', 'peminjam01', '0123456789', 'Bandung, Jawa Barat, Indonesia', 'peminjam01', 'peminjam01', 4, '2022-02-25 08:18:06', '2022-02-28 07:54:47'),
(3, 'Peminjam Kedua', 'peminjam02', '0211226458', 'Jakarta', 'Peminjam02', 'Peminjam02', 4, '2022-02-25 04:01:38', '2022-02-25 04:01:38');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `foto_barang`
--
ALTER TABLE `foto_barang`
  ADD PRIMARY KEY (`foto_id`),
  ADD UNIQUE KEY `foto_nama` (`foto_nama`),
  ADD KEY `barang_foreign` (`barang_fk`);

--
-- Indexes for table `foto_barang_pending`
--
ALTER TABLE `foto_barang_pending`
  ADD PRIMARY KEY (`foto_pending_id`),
  ADD KEY `barang_pending_foreign` (`pending_fk`);

--
-- Indexes for table `informasi_barang`
--
ALTER TABLE `informasi_barang`
  ADD PRIMARY KEY (`barang_id`),
  ADD UNIQUE KEY `barang_kode` (`barang_kode`),
  ADD KEY `kategori_foreign` (`kategori_fk`),
  ADD KEY `lokasi_foreign` (`lokasi_fk`);

--
-- Indexes for table `informasi_barang_pending`
--
ALTER TABLE `informasi_barang_pending`
  ADD PRIMARY KEY (`pending_id`) USING BTREE,
  ADD UNIQUE KEY `pending_kode` (`pending_kode`),
  ADD KEY `kategori_pending_foreign` (`kategori_fk`),
  ADD KEY `lokasi_pending_foreign` (`lokasi_fk`);

--
-- Indexes for table `jenis_pengelolaan`
--
ALTER TABLE `jenis_pengelolaan`
  ADD PRIMARY KEY (`jenis_id`),
  ADD UNIQUE KEY `jenis_nama` (`jenis_nama`);

--
-- Indexes for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  ADD PRIMARY KEY (`kategori_id`),
  ADD UNIQUE KEY `kategori_nama` (`kategori_nama`);

--
-- Indexes for table `kepala_bagian_tu`
--
ALTER TABLE `kepala_bagian_tu`
  ADD PRIMARY KEY (`tu_id`);

--
-- Indexes for table `kumpulan_barang_dipinjam`
--
ALTER TABLE `kumpulan_barang_dipinjam`
  ADD PRIMARY KEY (`kumpulan_id`),
  ADD KEY `barang_dipinjam_fk` (`barang_dipinjam_fk`),
  ADD KEY `transaksi_fk` (`transaksi_fk`);

--
-- Indexes for table `lokasi_barang`
--
ALTER TABLE `lokasi_barang`
  ADD PRIMARY KEY (`lokasi_id`),
  ADD UNIQUE KEY `lokasi_kode` (`lokasi_kode`);

--
-- Indexes for table `pengelolaan_barang`
--
ALTER TABLE `pengelolaan_barang`
  ADD PRIMARY KEY (`pengelolaan_id`),
  ADD UNIQUE KEY `pengelolaan_kode` (`pengelolaan_kode`),
  ADD KEY `barang_utama_foreign` (`barang_fk`),
  ADD KEY `pending_fk` (`pending_fk`),
  ADD KEY `user_fk` (`user_fk`),
  ADD KEY `jenis_fk` (`jenis_fk`);

--
-- Indexes for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  ADD PRIMARY KEY (`transaksi_id`),
  ADD KEY `peminjam_fk` (`peminjam_fk`),
  ADD KEY `jurusan_fk` (`jurusan_fk`);

--
-- Indexes for table `user_jurusan`
--
ALTER TABLE `user_jurusan`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_username` (`user_username`);

--
-- Indexes for table `user_peminjam`
--
ALTER TABLE `user_peminjam`
  ADD PRIMARY KEY (`peminjam_id`),
  ADD UNIQUE KEY `peminjam_username` (`peminjam_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `foto_barang`
--
ALTER TABLE `foto_barang`
  MODIFY `foto_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `foto_barang_pending`
--
ALTER TABLE `foto_barang_pending`
  MODIFY `foto_pending_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `informasi_barang`
--
ALTER TABLE `informasi_barang`
  MODIFY `barang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `informasi_barang_pending`
--
ALTER TABLE `informasi_barang_pending`
  MODIFY `pending_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jenis_pengelolaan`
--
ALTER TABLE `jenis_pengelolaan`
  MODIFY `jenis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategori_barang`
--
ALTER TABLE `kategori_barang`
  MODIFY `kategori_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kepala_bagian_tu`
--
ALTER TABLE `kepala_bagian_tu`
  MODIFY `tu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kumpulan_barang_dipinjam`
--
ALTER TABLE `kumpulan_barang_dipinjam`
  MODIFY `kumpulan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `lokasi_barang`
--
ALTER TABLE `lokasi_barang`
  MODIFY `lokasi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pengelolaan_barang`
--
ALTER TABLE `pengelolaan_barang`
  MODIFY `pengelolaan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  MODIFY `transaksi_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_jurusan`
--
ALTER TABLE `user_jurusan`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_peminjam`
--
ALTER TABLE `user_peminjam`
  MODIFY `peminjam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `foto_barang`
--
ALTER TABLE `foto_barang`
  ADD CONSTRAINT `barang_foreign` FOREIGN KEY (`barang_fk`) REFERENCES `informasi_barang` (`barang_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `foto_barang_pending`
--
ALTER TABLE `foto_barang_pending`
  ADD CONSTRAINT `barang_pending_foreign` FOREIGN KEY (`pending_fk`) REFERENCES `informasi_barang_pending` (`pending_kode`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `informasi_barang`
--
ALTER TABLE `informasi_barang`
  ADD CONSTRAINT `kategori_foreign` FOREIGN KEY (`kategori_fk`) REFERENCES `kategori_barang` (`kategori_nama`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lokasi_foreign` FOREIGN KEY (`lokasi_fk`) REFERENCES `lokasi_barang` (`lokasi_kode`) ON UPDATE CASCADE;

--
-- Constraints for table `informasi_barang_pending`
--
ALTER TABLE `informasi_barang_pending`
  ADD CONSTRAINT `kategori_pending_foreign` FOREIGN KEY (`kategori_fk`) REFERENCES `kategori_barang` (`kategori_nama`) ON UPDATE CASCADE,
  ADD CONSTRAINT `lokasi_pending_foreign` FOREIGN KEY (`lokasi_fk`) REFERENCES `lokasi_barang` (`lokasi_kode`) ON UPDATE CASCADE;

--
-- Constraints for table `kumpulan_barang_dipinjam`
--
ALTER TABLE `kumpulan_barang_dipinjam`
  ADD CONSTRAINT `barang_dipinjam_fk` FOREIGN KEY (`barang_dipinjam_fk`) REFERENCES `informasi_barang` (`barang_kode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `transaksi_fk` FOREIGN KEY (`transaksi_fk`) REFERENCES `transaksi_peminjaman` (`transaksi_id`) ON UPDATE CASCADE;

--
-- Constraints for table `pengelolaan_barang`
--
ALTER TABLE `pengelolaan_barang`
  ADD CONSTRAINT `barang_utama_foreign` FOREIGN KEY (`barang_fk`) REFERENCES `informasi_barang` (`barang_kode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `jenis_fk` FOREIGN KEY (`jenis_fk`) REFERENCES `jenis_pengelolaan` (`jenis_nama`) ON UPDATE CASCADE,
  ADD CONSTRAINT `pending_fk` FOREIGN KEY (`pending_fk`) REFERENCES `informasi_barang_pending` (`pending_kode`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_fk` FOREIGN KEY (`user_fk`) REFERENCES `user_jurusan` (`user_username`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `transaksi_peminjaman`
--
ALTER TABLE `transaksi_peminjaman`
  ADD CONSTRAINT `jurusan_fk` FOREIGN KEY (`jurusan_fk`) REFERENCES `user_jurusan` (`user_username`) ON UPDATE CASCADE,
  ADD CONSTRAINT `peminjam_fk` FOREIGN KEY (`peminjam_fk`) REFERENCES `user_peminjam` (`peminjam_username`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
