-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2024 at 01:12 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mtnrpa`
--

-- --------------------------------------------------------

--
-- Table structure for table `category_boards`
--

CREATE TABLE `category_boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category_boards`
--

INSERT INTO `category_boards` (`id`, `name`, `keterangan`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 'SASA', NULL, '2024-03-08 03:54:50', '2024-03-08 03:52:13', '2024-03-08 03:54:50'),
(2, 'SOP PRODUCTION', NULL, NULL, '2024-03-08 03:55:05', '2024-03-08 04:59:44'),
(3, 'QUALITY', NULL, NULL, '2024-03-08 03:55:15', '2024-03-08 04:13:31'),
(4, 'DAILY CHECKSHEET', NULL, NULL, '2024-03-08 04:05:04', '2024-03-08 04:12:36'),
(5, 'DAILY CHECKSHEET', 'sasas', '2024-03-08 04:11:22', '2024-03-08 04:10:48', '2024-03-08 04:11:22'),
(6, 'DAILY CHECKSHEET', 'sasa', '2024-03-08 04:11:59', '2024-03-08 04:11:26', '2024-03-08 04:11:59'),
(7, 'DAILY CHECKSHEET', 'sasas', '2024-03-08 04:12:26', '2024-03-08 04:12:03', '2024-03-08 04:12:26'),
(8, 'WI SETTING DIES', NULL, NULL, '2024-03-08 04:59:26', '2024-03-08 04:59:26'),
(9, 'OPL', NULL, NULL, '2024-03-08 04:59:34', '2024-03-08 04:59:34');

-- --------------------------------------------------------

--
-- Table structure for table `content_assgins`
--

CREATE TABLE `content_assgins` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mesinId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contentId` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_assgins`
--

INSERT INTO `content_assgins` (`id`, `mesinId`, `contentId`, `created_at`, `updated_at`) VALUES
('0fa914ca-7b89-458b-8d4f-01c0cf20e952', '80', '14', NULL, NULL),
('15316a25-ab0e-4cef-af60-94033ad4ed7f', '80', '9', NULL, NULL),
('36636a35-c37f-455f-b61a-aeb501525ef7', '81', '13', NULL, NULL),
('40700e9c-b904-4397-a719-4f002d203edb', '82', '13', NULL, NULL),
('62a629c2-aa44-4571-836d-ad31d4579662', '79', '14', NULL, NULL),
('92ce9a7c-5b44-4b7d-8b13-2e60f14221f5', '79', '9', NULL, NULL),
('9dc9f54a-b6b6-43fb-af67-4243bc285921', '80', '11', NULL, NULL),
('ad3c1885-6833-4ce0-9daf-456800017d64', '80', '13', NULL, NULL),
('add187ed-d5f1-4225-9508-b90400867aa7', '80', '8', NULL, NULL),
('e11fa522-1f23-4515-a769-48dff07edd87', '79', '10', NULL, NULL),
('e37b82b7-71bd-4f3b-b330-b52fb7518cea', '79', '8', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `content_boards`
--

CREATE TABLE `content_boards` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `categoryId` bigint(20) NOT NULL,
  `directory` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `content_boards`
--

INSERT INTO `content_boards` (`id`, `categoryId`, `directory`, `status`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 2, 'uploads/Picture1.jpg', 'Inactive', '2024-03-14 00:43:09', '2024-03-14 00:40:28', '2024-03-14 00:43:09'),
(2, 2, 'uploads/Picture1.jpg', 'Inactive', '2024-03-14 00:53:10', '2024-03-14 00:43:22', '2024-03-14 00:53:10'),
(3, 2, 'uploads/content/Picture1.jpg', 'Active', '2024-03-14 00:57:52', '2024-03-14 00:53:41', '2024-03-14 00:57:52'),
(4, 2, 'assets/uploads/content/Picture1.jpg', 'Active', '2024-03-14 01:02:36', '2024-03-14 00:58:29', '2024-03-14 01:02:36'),
(8, 2, 'assets/uploads/content/652edPicture1.jpg', 'Active', NULL, '2024-03-14 23:19:55', '2024-03-14 23:19:55'),
(9, 3, 'assets/uploads/content/d5b6bScreenshot 2023-12-19 165525.png', 'Active', NULL, '2024-03-15 21:46:46', '2024-03-15 21:46:46'),
(10, 2, 'assets/uploads/content/1a3f8Screenshot 2023-09-26 083552.png', 'Active', NULL, '2024-03-15 21:52:16', '2024-03-15 21:52:16'),
(11, 2, 'assets/uploads/content/5c996Screenshot 2023-09-27 091636.png', 'Active', NULL, '2024-03-19 00:28:19', '2024-03-19 00:28:19'),
(13, 2, 'assets/uploads/content/13c39Screenshot 2023-10-02 145505.png', 'Active', NULL, '2024-03-19 00:37:23', '2024-03-19 00:37:23'),
(14, 2, 'assets/uploads/content/068ceScreenshot 2023-10-02 145505.png', 'Active', NULL, '2024-03-19 01:55:11', '2024-03-19 01:55:11');

-- --------------------------------------------------------

--
-- Table structure for table `divisi`
--

CREATE TABLE `divisi` (
  `id_divisi` bigint(20) UNSIGNED NOT NULL,
  `nama_divisi` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `divisi`
--

INSERT INTO `divisi` (`id_divisi`, `nama_divisi`, `created_at`, `updated_at`) VALUES
(1, 'Progresif', NULL, '2021-10-01 23:41:30'),
(3, 'Line Arm Break', '2021-10-01 23:36:09', '2021-10-01 23:36:09'),
(4, 'Line Cutting', '2021-10-01 23:36:34', '2021-10-01 23:36:34'),
(5, 'Line Welding', '2021-10-01 23:36:50', '2021-10-01 23:36:50'),
(6, 'Line Spot', '2021-10-01 23:37:01', '2021-10-01 23:37:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_mesin`
--

CREATE TABLE `jenis_mesin` (
  `id_jenisMesin` bigint(20) UNSIGNED NOT NULL,
  `jenis_mesin` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jenis_mesin`
--

INSERT INTO `jenis_mesin` (`id_jenisMesin`, `jenis_mesin`, `created_at`, `updated_at`) VALUES
(3, 'Stamping', '2021-11-23 01:35:53', '2021-11-23 01:35:53'),
(4, 'Feeder', '2021-11-23 01:36:21', '2021-11-23 01:36:21'),
(5, 'Drill', '2021-11-23 01:36:30', '2021-11-23 01:36:30'),
(6, 'Compresor', '2021-11-23 01:36:40', '2021-11-23 01:36:40'),
(7, 'Grinding', '2021-11-23 01:36:50', '2021-11-23 01:36:50'),
(8, 'Bubut', '2021-11-23 01:37:01', '2021-11-23 01:37:01'),
(9, 'Milling', '2021-11-23 01:37:09', '2021-11-23 01:37:09'),
(10, 'Circular saw', '2021-11-23 01:37:21', '2021-11-23 01:37:21'),
(11, 'Spot welding', '2021-11-23 01:37:33', '2021-11-23 01:37:33'),
(12, 'Broching', '2021-11-23 01:37:43', '2021-11-23 01:37:43'),
(13, 'Noching', '2021-11-23 01:37:56', '2021-11-23 01:37:56'),
(14, 'Cutting', '2021-11-23 01:38:07', '2021-11-23 01:38:07'),
(15, 'Auto cutting', '2021-11-23 01:38:22', '2021-11-23 01:38:22'),
(16, 'Welding robot', '2021-11-23 01:38:32', '2021-11-23 01:38:32');

-- --------------------------------------------------------

--
-- Table structure for table `mesin`
--

CREATE TABLE `mesin` (
  `id_mesin` bigint(20) UNSIGNED NOT NULL,
  `no_asset` varchar(100) DEFAULT NULL,
  `kode_mesin` varchar(100) DEFAULT NULL,
  `mesin` varchar(50) DEFAULT NULL,
  `jenis_mesin` varchar(20) DEFAULT NULL,
  `id_divisi` int(11) DEFAULT NULL,
  `status` enum('Aktif','Nonaktif') DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mesin`
--

INSERT INTO `mesin` (`id_mesin`, `no_asset`, `kode_mesin`, `mesin`, `jenis_mesin`, `id_divisi`, `status`, `keterangan`, `created_at`, `updated_at`) VALUES
(79, NULL, 'PG01', 'KOMATSU 80T', '3', 1, 'Aktif', NULL, NULL, NULL),
(80, NULL, 'PG02', 'KOMATSU 110T', '3', 1, 'Aktif', NULL, NULL, NULL),
(81, NULL, 'PG03', 'AIDA 110T', '3', 1, 'Aktif', NULL, NULL, NULL),
(82, NULL, 'PG04', 'AIDA 200T', '3', 1, 'Aktif', NULL, NULL, NULL),
(83, NULL, 'PG05', 'AIDA 200T', '3', 1, 'Aktif', NULL, NULL, NULL),
(84, NULL, 'PG06', 'AIDA 110T', '3', 1, 'Aktif', NULL, NULL, NULL),
(85, NULL, 'PG07', 'AIDA 250T', '3', 1, 'Aktif', NULL, NULL, NULL),
(86, NULL, 'STPM1', 'KOMATSU 300T', '3', 1, 'Aktif', NULL, NULL, NULL),
(87, NULL, 'STPM2', 'WASINO 250T', '3', 1, 'Aktif', NULL, NULL, NULL),
(88, NULL, 'STPM3', 'KOMATSU 250T', '3', 1, 'Aktif', NULL, NULL, NULL),
(89, NULL, 'STPM4', 'KOMATSU 60T', '3', 1, 'Aktif', NULL, NULL, NULL),
(90, NULL, 'STPM5', 'KOMATSU 60T', '3', 1, 'Aktif', NULL, NULL, NULL),
(91, NULL, 'STPM6', 'KOMATSU 60T', '3', 1, 'Aktif', NULL, NULL, NULL),
(92, NULL, 'STPM7', 'KOMATSU 60T', '3', 1, 'Aktif', NULL, NULL, NULL),
(93, NULL, 'FP1', 'AIDA LE 2E4L40', '3', 1, 'Aktif', NULL, NULL, NULL),
(94, NULL, 'FP2', 'HE CO-300', '4', 1, 'Aktif', NULL, NULL, NULL),
(95, NULL, 'FP3', 'AIDA LE 2E4L40', '4', 1, 'Aktif', NULL, NULL, NULL),
(96, NULL, 'FP4', 'HE GL-400E ', '4', 1, 'Aktif', NULL, NULL, NULL),
(97, NULL, 'FP5', 'DONGNAM', '4', 1, 'Aktif', NULL, NULL, NULL),
(98, NULL, 'FP6', 'ORII LCC03KR', '4', 1, 'Aktif', NULL, NULL, NULL),
(99, NULL, 'FP7', 'AIDA LFG 800E', '4', 1, 'Aktif', NULL, NULL, NULL),
(100, NULL, 'DR01', 'HORNG DAR', '5', 1, 'Aktif', NULL, NULL, NULL),
(101, NULL, 'DR02', 'HORNG DAR', '5', 1, 'Aktif', NULL, NULL, NULL),
(102, NULL, 'DR03', 'RF', '5', 1, 'Aktif', NULL, NULL, NULL),
(103, NULL, 'CP01', 'KAESER', '6', 1, 'Aktif', NULL, NULL, NULL),
(104, NULL, 'CP02', 'KOBELCO', '6', 1, 'Aktif', NULL, NULL, NULL),
(105, NULL, 'GR01', 'KENT', '7', 1, 'Aktif', NULL, NULL, NULL),
(106, NULL, 'BT01', 'N/A CHINA', '8', 1, 'Aktif', NULL, NULL, NULL),
(107, NULL, 'ML01', 'BRIDGEPORT', '9', 1, 'Aktif', NULL, NULL, NULL),
(108, NULL, 'CW01', 'N/A CUSTOM', '10', 1, 'Aktif', NULL, NULL, NULL),
(109, NULL, 'STPM8', 'KOMATSU 60T', '3', 1, 'Aktif', NULL, NULL, NULL),
(110, NULL, 'STPM9', 'KOMATSU 50T', '3', 1, 'Aktif', NULL, NULL, NULL),
(111, NULL, 'STPM10', 'KOMATSU 45T', '3', 1, 'Aktif', NULL, NULL, NULL),
(112, NULL, 'STPM11', 'KOMATSU 45T', '3', 1, 'Aktif', NULL, NULL, NULL),
(113, NULL, 'SW3', 'CHOU 35KVA', '11', 1, 'Aktif', NULL, NULL, NULL),
(114, NULL, 'BR01', 'BROCHING1', '12', 1, 'Aktif', NULL, NULL, NULL),
(115, NULL, 'BR02', 'BROCHING2', '12', 1, 'Aktif', NULL, NULL, NULL),
(116, NULL, 'CS01', 'CICULAR SAW1', '10', 1, 'Aktif', NULL, NULL, NULL),
(117, NULL, 'NC01', 'NOTCHING1', '13', 1, 'Aktif', NULL, NULL, NULL),
(118, NULL, 'C1', 'MORRY 476', '14', 1, 'Aktif', NULL, NULL, NULL),
(119, NULL, 'C2', 'MORRY 474', '14', 1, 'Aktif', NULL, NULL, NULL),
(120, NULL, 'C3', 'MORRY 1074', '14', 1, 'Aktif', NULL, NULL, NULL),
(121, NULL, 'C4', 'MORRY 855', '14', 1, 'Aktif', NULL, NULL, NULL),
(122, NULL, 'C5', 'MORRY 1076', '14', 1, 'Aktif', NULL, NULL, NULL),
(123, NULL, 'C6', 'MORRY 746', '14', 1, 'Aktif', NULL, NULL, NULL),
(124, NULL, 'C7', 'MORRY 027', '14', 1, 'Aktif', NULL, NULL, NULL),
(125, NULL, 'C8', 'MORRY 856', '14', 1, 'Aktif', NULL, NULL, NULL),
(126, NULL, 'C9', 'MK', '15', 1, 'Aktif', NULL, NULL, NULL),
(127, NULL, 'WR01', 'PANASONIC', '16', 1, 'Aktif', NULL, NULL, NULL),
(128, NULL, 'WR02', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL),
(129, NULL, 'WR03', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL),
(130, NULL, 'WR04', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL),
(131, NULL, 'WR05', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL),
(132, NULL, 'WR06', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL),
(133, NULL, 'WR07', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL),
(134, NULL, 'WR08', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL),
(135, NULL, 'WR09', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL),
(136, NULL, 'WR10', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL),
(137, NULL, 'WR11', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL),
(138, NULL, 'WR12', 'OTC', '16', 1, 'Aktif', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_27_110516_create_sessions_table', 1),
(6, '2024_03_06_114455_create_category_boards_table', 2),
(7, '2024_03_14_033858_create_content_boards_table', 3),
(8, '2024_03_19_042509_create_content_assgins_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `point_check`
--

CREATE TABLE `point_check` (
  `id_check` bigint(20) UNSIGNED NOT NULL,
  `point_check` varchar(100) DEFAULT NULL,
  `standard` varchar(100) DEFAULT NULL,
  `jadwal` varchar(30) DEFAULT NULL,
  `jenis_mesin` varchar(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `point_check`
--

INSERT INTO `point_check` (`id_check`, `point_check`, `standard`, `jadwal`, `jenis_mesin`, `created_at`, `updated_at`) VALUES
(1, 'OLI GEARBOX TRANSMISI CRANK', '1/2 ~ FULL', 'BULANAN', '3', NULL, NULL),
(2, 'OLI LUBRICANT SLIDING TABLE', '1/2 ~ FULL', 'BULANAN', '3', NULL, NULL),
(3, 'GREASE LUBRICANT CRANK SHAFT', '1/2 ~ FULL', 'BULANAN', '3', NULL, NULL),
(4, 'OLI LUBRICANT BUSHING & BALANCER', '1/2 ~ FULL', 'BULANAN', '3', NULL, NULL),
(5, 'MOTOR UTAMA', 'Suara halus  ', 'BULANAN', '3', NULL, NULL),
(6, 'ELEKTRIKAL SISTEM', 'Kabel rapi / Terminal kabel kencang', 'BULANAN', '3', NULL, NULL),
(7, 'SLIDE MOTOR DH', 'Suara halus / Tidak macet', 'BULANAN', '3', NULL, NULL),
(8, 'SAFETY SENSOR', 'Coba / Berfungsi', 'BULANAN', '3', NULL, NULL),
(9, 'EMERGENCY STOP', 'Coba / Berfungsi', 'BULANAN', '3', NULL, NULL),
(10, 'DISC BRAKE & CLUTCH', 'Clearence 2,5 ~ 3,2 mm', '6 BULANAN', '3', NULL, NULL),
(11, 'V BELT', 'Kelenturan 2 ~ 3 mm', '6 BULANAN', '3', NULL, NULL),
(12, 'SOLENOID VALVE', 'Berfungsi / Bersih', '6 BULANAN', '3', NULL, NULL),
(13, 'OVERLOAD PUMP', 'Berfungsi / Bersih', '6 BULANAN', '3', NULL, NULL),
(14, 'SELANG HIDROLIK', 'Tidak sobek / Bocor', '6 BULANAN', '3', NULL, NULL),
(15, 'PANEL CONTROL', 'Berfungsi / Bersih', '6 BULANAN', '3', NULL, NULL),
(16, 'PARALEL BOLSTER TO SLIDE', 'Kemiringan 0,2 ~ 0,3 mm', 'TAHUNAN', '3', NULL, NULL),
(17, 'CLEARENCE SLIDE GIVE', 'Kelenturan 0,2 ~ 0,3 mm', 'TAHUNAN', '3', NULL, NULL),
(18, 'SLIDING CUSHION', 'Halus / Tidak rusak', 'TAHUNAN', '3', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id_schedule` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal` varchar(10) DEFAULT NULL,
  `requester` varchar(20) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `id_divisi` int(11) DEFAULT NULL,
  `id_mesin` int(11) DEFAULT NULL,
  `p_check` varchar(20) DEFAULT NULL,
  `tanggal_jadwal` date DEFAULT NULL,
  `status` enum('Open','Onprogress','Waiting','Closed') DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `delete` varchar(10) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id_schedule`, `id_jadwal`, `requester`, `tanggal`, `id_divisi`, `id_mesin`, `p_check`, `tanggal_jadwal`, `status`, `keterangan`, `delete`, `created_at`, `updated_at`) VALUES
(1, 'SC0003', 'admin', '2021-10-07', 1, 79, '1,4,6', '2021-10-07', 'Open', '', '', '2021-11-01 13:58:59', '2021-12-10 06:01:36'),
(2, '1', 'admin', '2021-01-11', 1, 83, '1,4,5', '2021-04-11', 'Open', NULL, '', '2021-11-01 06:50:54', '2021-11-01 06:50:54'),
(3, '2', 'admin', '2021-01-11', 1, 80, '1,3,5', '2021-05-11', 'Open', NULL, '', '2021-11-01 07:11:21', '2021-11-01 07:11:21'),
(4, '3', 'admin', '2021-09-11', 1, 81, '1,3,11,12', '2021-12-11', 'Open', NULL, '', '2021-11-10 06:12:08', '2021-11-10 06:12:08'),
(5, '1', 'admin', '2021-08-12', 1, 79, '1,2,3,4', '2021-09-12', 'Open', NULL, '', '2021-12-07 21:30:50', '2021-12-07 21:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trouble`
--

CREATE TABLE `trouble` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_trouble` bigint(20) UNSIGNED DEFAULT NULL,
  `requester` varchar(20) DEFAULT NULL,
  `tgl_perbaikan` date DEFAULT NULL,
  `id_divisi` bigint(20) DEFAULT NULL,
  `id_mesin` bigint(20) DEFAULT NULL,
  `judul` varchar(100) DEFAULT NULL,
  `keterangan` varchar(225) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `delete` varchar(5) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trouble`
--

INSERT INTO `trouble` (`id`, `id_trouble`, `requester`, `tgl_perbaikan`, `id_divisi`, `id_mesin`, `judul`, `keterangan`, `status`, `delete`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '2021-11-11', 1, 80, 'Mesin panas', 'saya gatau tiba2 mati gitu aja', 'Open', '', '2021-11-10 23:37:40', '2021-11-23 00:41:11'),
(2, 2, 'admin', '2021-09-11', 1, 82, 'gatau', 'tolong di perbaiki', 'Open', '', '2021-11-11 00:52:59', '2021-11-11 01:23:07'),
(3, 3, 'do', '2021-10-11', 1, 85, 'gatau aku', 'tolong di check v-beltnya', 'Open', '', '2021-11-11 03:17:02', '2021-11-11 03:17:02');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_user` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hak_akses` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_divisi` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama_user`, `name`, `password`, `hak_akses`, `id_divisi`, `created_at`, `updated_at`) VALUES
(1, 'Salman', 'admin', '$2y$10$H2OaBzkC9MI5C1gW8wmSIOtQZw05q5jafckbI/aRoxZDuTNdBe9ku', 'Admin', 3, NULL, NULL),
(7, 'Budy Wahyono', 'qwerty', '$2y$10$MjVe9o8BP669ax7R3c4Kd.wv6MGFvF1GRR4I/hxI1CHxKQJEti3wq', 'Petugas', 4, '2021-10-02 01:58:08', '2021-11-17 03:20:38'),
(8, 'Dodo', 'do', '$2y$10$b1uJECYKxxacoYlCVNd.y.cIW8siywFpmbePdCIyzmwCA97E3ESri', 'User', 1, '2021-11-11 02:57:27', '2021-11-11 02:57:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category_boards`
--
ALTER TABLE `category_boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_assgins`
--
ALTER TABLE `content_assgins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `content_boards`
--
ALTER TABLE `content_boards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `divisi`
--
ALTER TABLE `divisi`
  ADD PRIMARY KEY (`id_divisi`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis_mesin`
--
ALTER TABLE `jenis_mesin`
  ADD PRIMARY KEY (`id_jenisMesin`);

--
-- Indexes for table `mesin`
--
ALTER TABLE `mesin`
  ADD PRIMARY KEY (`id_mesin`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `point_check`
--
ALTER TABLE `point_check`
  ADD PRIMARY KEY (`id_check`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id_schedule`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `trouble`
--
ALTER TABLE `trouble`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `category_boards`
--
ALTER TABLE `category_boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `content_boards`
--
ALTER TABLE `content_boards`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `divisi`
--
ALTER TABLE `divisi`
  MODIFY `id_divisi` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_mesin`
--
ALTER TABLE `jenis_mesin`
  MODIFY `id_jenisMesin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `mesin`
--
ALTER TABLE `mesin`
  MODIFY `id_mesin` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=139;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `point_check`
--
ALTER TABLE `point_check`
  MODIFY `id_check` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id_schedule` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `trouble`
--
ALTER TABLE `trouble`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
