-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 13, 2021 at 11:03 PM
-- Server version: 5.7.24
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backlink`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `protocol` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `language_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `name`, `protocol`, `url`, `language_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(5, 'nama blog', 'http://', 'urlgo.blog', 1, '2021-11-13 15:10:30', '2021-11-13 16:00:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_categories`
--

CREATE TABLE `blog_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_categories`
--

INSERT INTO `blog_categories` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bisnis', '2021-11-13 13:56:05', '2021-11-13 13:56:05', NULL),
(2, 'Kecantikan', '2021-11-13 13:56:12', '2021-11-13 13:56:12', NULL),
(3, 'Fashion', '2021-11-13 13:56:21', '2021-11-13 13:56:21', NULL),
(4, 'Gaya Hidup', '2021-11-13 13:56:46', '2021-11-13 13:56:46', NULL),
(5, 'Gadget', '2021-11-13 13:57:03', '2021-11-13 13:57:03', NULL),
(6, 'Kesehatan', '2021-11-13 13:57:10', '2021-11-13 13:57:10', NULL),
(7, 'Makanan & Minuman', '2021-11-13 13:57:24', '2021-11-13 13:57:24', NULL),
(8, 'Otomotif', '2021-11-13 13:57:49', '2021-11-13 13:57:49', NULL),
(9, 'Properti', '2021-11-13 13:57:55', '2021-11-13 13:57:55', NULL),
(10, 'Motivasi', '2021-11-13 13:58:15', '2021-11-13 13:58:15', NULL),
(11, 'Religi', '2021-11-13 13:58:24', '2021-11-13 13:58:24', NULL),
(12, 'Politik', '2021-11-13 13:58:29', '2021-11-13 13:58:29', NULL),
(13, 'Pendidikan', '2021-11-13 13:58:43', '2021-11-13 13:58:43', NULL),
(14, 'Wisata', '2021-11-13 13:58:56', '2021-11-13 13:58:56', NULL),
(15, 'Teknologi', '2021-11-13 13:59:01', '2021-11-13 13:59:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blog_has_categories`
--

CREATE TABLE `blog_has_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `blog_id` bigint(20) UNSIGNED NOT NULL,
  `blog_category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `blog_has_categories`
--

INSERT INTO `blog_has_categories` (`id`, `blog_id`, `blog_category_id`, `created_at`, `updated_at`) VALUES
(5, 5, 4, '2021-11-13 16:00:45', '2021-11-13 16:00:45'),
(6, 5, 3, '2021-11-13 16:00:45', '2021-11-13 16:00:45');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `province_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `type`, `province_id`, `created_at`, `updated_at`) VALUES
(1101, 'KAB. ACEH SELATAN', 1, 11, NULL, NULL),
(1102, 'KAB. ACEH TENGGARA', 1, 11, NULL, NULL),
(1103, 'KAB. ACEH TIMUR', 1, 11, NULL, NULL),
(1104, 'KAB. ACEH TENGAH', 1, 11, NULL, NULL),
(1105, 'KAB. ACEH BARAT', 1, 11, NULL, NULL),
(1106, 'KAB. ACEH BESAR', 1, 11, NULL, NULL),
(1107, 'KAB. PIDIE', 1, 11, NULL, NULL),
(1108, 'KAB. ACEH UTARA', 1, 11, NULL, NULL),
(1109, 'KAB. SIMEULUE', 1, 11, NULL, NULL),
(1110, 'KAB. ACEH SINGKIL', 1, 11, NULL, NULL),
(1111, 'KAB. BIREUEN', 1, 11, NULL, NULL),
(1112, 'KAB. ACEH BARAT DAYA', 1, 11, NULL, NULL),
(1113, 'KAB. GAYO LUES', 1, 11, NULL, NULL),
(1114, 'KAB. ACEH JAYA', 1, 11, NULL, NULL),
(1115, 'KAB. NAGAN RAYA', 1, 11, NULL, NULL),
(1116, 'KAB. ACEH TAMIANG', 1, 11, NULL, NULL),
(1117, 'KAB. BENER MERIAH', 1, 11, NULL, NULL),
(1118, 'KAB. PIDIE JAYA', 1, 11, NULL, NULL),
(1171, 'KOTA BANDA ACEH', 2, 11, NULL, NULL),
(1172, 'KOTA SABANG', 2, 11, NULL, NULL),
(1173, 'KOTA LHOKSEUMAWE', 2, 11, NULL, NULL),
(1174, 'KOTA LANGSA', 2, 11, NULL, NULL),
(1175, 'KOTA SUBULUSSALAM', 2, 11, NULL, NULL),
(1201, 'KAB. TAPANULI TENGAH', 1, 12, NULL, NULL),
(1202, 'KAB. TAPANULI UTARA', 1, 12, NULL, NULL),
(1203, 'KAB. TAPANULI SELATAN', 1, 12, NULL, NULL),
(1204, 'KAB. NIAS', 1, 12, NULL, NULL),
(1205, 'KAB. LANGKAT', 1, 12, NULL, NULL),
(1206, 'KAB. KARO', 1, 12, NULL, NULL),
(1207, 'KAB. DELI SERDANG', 1, 12, NULL, NULL),
(1208, 'KAB. SIMALUNGUN', 1, 12, NULL, NULL),
(1209, 'KAB. ASAHAN', 1, 12, NULL, NULL),
(1210, 'KAB. LABUHANBATU', 1, 12, NULL, NULL),
(1211, 'KAB. DAIRI', 1, 12, NULL, NULL),
(1212, 'KAB. TOBA SAMOSIR', 1, 12, NULL, NULL),
(1213, 'KAB. MANDAILING NATAL', 1, 12, NULL, NULL),
(1214, 'KAB. NIAS SELATAN', 1, 12, NULL, NULL),
(1215, 'KAB. PAKPAK BHARAT', 1, 12, NULL, NULL),
(1216, 'KAB. HUMBANG HASUNDUTAN', 1, 12, NULL, NULL),
(1217, 'KAB. SAMOSIR', 1, 12, NULL, NULL),
(1218, 'KAB. SERDANG BEDAGAI', 1, 12, NULL, NULL),
(1219, 'KAB. BATU BARA', 1, 12, NULL, NULL),
(1220, 'KAB. PADANG LAWAS UTARA', 1, 12, NULL, NULL),
(1221, 'KAB. PADANG LAWAS', 1, 12, NULL, NULL),
(1222, 'KAB. LABUHANBATU SELATAN', 1, 12, NULL, NULL),
(1223, 'KAB. LABUHANBATU UTARA', 1, 12, NULL, NULL),
(1224, 'KAB. NIAS UTARA', 1, 12, NULL, NULL),
(1225, 'KAB. NIAS BARAT', 1, 12, NULL, NULL),
(1271, 'KOTA MEDAN', 2, 12, NULL, NULL),
(1272, 'KOTA PEMATANG SIANTAR', 2, 12, NULL, NULL),
(1273, 'KOTA SIBOLGA', 2, 12, NULL, NULL),
(1274, 'KOTA TANJUNG BALAI', 2, 12, NULL, NULL),
(1275, 'KOTA BINJAI', 2, 12, NULL, NULL),
(1276, 'KOTA TEBING TINGGI', 2, 12, NULL, NULL),
(1277, 'KOTA PADANGSIDIMPUAN', 2, 12, NULL, NULL),
(1278, 'KOTA GUNUNGSITOLI', 2, 12, NULL, NULL),
(1301, 'KAB. PESISIR SELATAN', 1, 13, NULL, NULL),
(1302, 'KAB. SOLOK', 1, 13, NULL, NULL),
(1303, 'KAB. SIJUNJUNG', 1, 13, NULL, NULL),
(1304, 'KAB. TANAH DATAR', 1, 13, NULL, NULL),
(1305, 'KAB. PADANG PARIAMAN', 1, 13, NULL, NULL),
(1306, 'KAB. AGAM', 1, 13, NULL, NULL),
(1307, 'KAB. LIMA PULUH KOTA', 1, 13, NULL, NULL),
(1308, 'KAB. PASAMAN', 1, 13, NULL, NULL),
(1309, 'KAB. KEPULAUAN MENTAWAI', 1, 13, NULL, NULL),
(1310, 'KAB. DHARMASRAYA', 1, 13, NULL, NULL),
(1311, 'KAB. SOLOK SELATAN', 1, 13, NULL, NULL),
(1312, 'KAB. PASAMAN BARAT', 1, 13, NULL, NULL),
(1371, 'KOTA PADANG', 2, 13, NULL, NULL),
(1372, 'KOTA SOLOK', 2, 13, NULL, NULL),
(1373, 'KOTA SAWAHLUNTO', 2, 13, NULL, NULL),
(1374, 'KOTA PADANG PANJANG', 2, 13, NULL, NULL),
(1375, 'KOTA BUKITTINGGI', 2, 13, NULL, NULL),
(1376, 'KOTA PAYAKUMBUH', 2, 13, NULL, NULL),
(1377, 'KOTA PARIAMAN', 2, 13, NULL, NULL),
(1401, 'KAB. KAMPAR', 1, 14, NULL, NULL),
(1402, 'KAB. INDRAGIRI HULU', 1, 14, NULL, NULL),
(1403, 'KAB. BENGKALIS', 1, 14, NULL, NULL),
(1404, 'KAB. INDRAGIRI HILIR', 1, 14, NULL, NULL),
(1405, 'KAB. PELALAWAN', 1, 14, NULL, NULL),
(1406, 'KAB. ROKAN HULU', 1, 14, NULL, NULL),
(1407, 'KAB. ROKAN HILIR', 1, 14, NULL, NULL),
(1408, 'KAB. SIAK', 1, 14, NULL, NULL),
(1409, 'KAB. KUANTAN SINGINGI', 1, 14, NULL, NULL),
(1410, 'KAB. KEPULAUAN MERANTI', 1, 14, NULL, NULL),
(1471, 'KOTA PEKANBARU', 2, 14, NULL, NULL),
(1472, 'KOTA DUMAI', 2, 14, NULL, NULL),
(1501, 'KAB. KERINCI', 1, 15, NULL, NULL),
(1502, 'KAB. MERANGIN', 1, 15, NULL, NULL),
(1503, 'KAB. SAROLANGUN', 1, 15, NULL, NULL),
(1504, 'KAB. BATANGHARI', 1, 15, NULL, NULL),
(1505, 'KAB. MUARO JAMBI', 1, 15, NULL, NULL),
(1506, 'KAB. TANJUNG JABUNG BARAT', 1, 15, NULL, NULL),
(1507, 'KAB. TANJUNG JABUNG TIMUR', 1, 15, NULL, NULL),
(1508, 'KAB. BUNGO', 1, 15, NULL, NULL),
(1509, 'KAB. TEBO', 1, 15, NULL, NULL),
(1571, 'KOTA JAMBI', 2, 15, NULL, NULL),
(1572, 'KOTA SUNGAI PENUH', 2, 15, NULL, NULL),
(1601, 'KAB. OGAN KOMERING ULU', 1, 16, NULL, NULL),
(1602, 'KAB. OGAN KOMERING ILIR', 1, 16, NULL, NULL),
(1603, 'KAB. MUARA ENIM', 1, 16, NULL, NULL),
(1604, 'KAB. LAHAT', 1, 16, NULL, NULL),
(1605, 'KAB. MUSI RAWAS', 1, 16, NULL, NULL),
(1606, 'KAB. MUSI BANYUASIN', 1, 16, NULL, NULL),
(1607, 'KAB. BANYUASIN', 1, 16, NULL, NULL),
(1608, 'KAB. OGAN KOMERING ULU TIMUR', 1, 16, NULL, NULL),
(1609, 'KAB. OGAN KOMERING ULU SELATAN', 1, 16, NULL, NULL),
(1610, 'KAB. OGAN ILIR', 1, 16, NULL, NULL),
(1611, 'KAB. EMPAT LAWANG', 1, 16, NULL, NULL),
(1612, 'KAB. PENUKAL ABAB LEMATANG ILIR', 1, 16, NULL, NULL),
(1613, 'KAB. MUSI RAWAS UTARA', 1, 16, NULL, NULL),
(1671, 'KOTA PALEMBANG', 2, 16, NULL, NULL),
(1672, 'KOTA PAGAR ALAM', 2, 16, NULL, NULL),
(1673, 'KOTA LUBUK LINGGAU', 2, 16, NULL, NULL),
(1674, 'KOTA PRABUMULIH', 2, 16, NULL, NULL),
(1701, 'KAB. BENGKULU SELATAN', 1, 17, NULL, NULL),
(1702, 'KAB. REJANG LEBONG', 1, 17, NULL, NULL),
(1703, 'KAB. BENGKULU UTARA', 1, 17, NULL, NULL),
(1704, 'KAB. KAUR', 1, 17, NULL, NULL),
(1705, 'KAB. SELUMA', 1, 17, NULL, NULL),
(1706, 'KAB. MUKO MUKO', 1, 17, NULL, NULL),
(1707, 'KAB. LEBONG', 1, 17, NULL, NULL),
(1708, 'KAB. KEPAHIANG', 1, 17, NULL, NULL),
(1709, 'KAB. BENGKULU TENGAH', 1, 17, NULL, NULL),
(1771, 'KOTA BENGKULU', 2, 17, NULL, NULL),
(1801, 'KAB. LAMPUNG SELATAN', 1, 18, NULL, NULL),
(1802, 'KAB. LAMPUNG TENGAH', 1, 18, NULL, NULL),
(1803, 'KAB. LAMPUNG UTARA', 1, 18, NULL, NULL),
(1804, 'KAB. LAMPUNG BARAT', 1, 18, NULL, NULL),
(1805, 'KAB. TULANG BAWANG', 1, 18, NULL, NULL),
(1806, 'KAB. TANGGAMUS', 1, 18, NULL, NULL),
(1807, 'KAB. LAMPUNG TIMUR', 1, 18, NULL, NULL),
(1808, 'KAB. WAY KANAN', 1, 18, NULL, NULL),
(1809, 'KAB. PESAWARAN', 1, 18, NULL, NULL),
(1810, 'KAB. PRINGSEWU', 1, 18, NULL, NULL),
(1811, 'KAB. MESUJI', 1, 18, NULL, NULL),
(1812, 'KAB. TULANG BAWANG BARAT', 1, 18, NULL, NULL),
(1813, 'KAB. PESISIR BARAT', 1, 18, NULL, NULL),
(1871, 'KOTA BANDAR LAMPUNG', 2, 18, NULL, NULL),
(1872, 'KOTA METRO', 2, 18, NULL, NULL),
(1901, 'KAB. BANGKA', 1, 19, NULL, NULL),
(1902, 'KAB. BELITUNG', 1, 19, NULL, NULL),
(1903, 'KAB. BANGKA SELATAN', 1, 19, NULL, NULL),
(1904, 'KAB. BANGKA TENGAH', 1, 19, NULL, NULL),
(1905, 'KAB. BANGKA BARAT', 1, 19, NULL, NULL),
(1906, 'KAB. BELITUNG TIMUR', 1, 19, NULL, NULL),
(1971, 'KOTA PANGKAL PINANG', 2, 19, NULL, NULL),
(2101, 'KAB. BINTAN', 1, 21, NULL, NULL),
(2102, 'KAB. KARIMUN', 1, 21, NULL, NULL),
(2103, 'KAB. NATUNA', 1, 21, NULL, NULL),
(2104, 'KAB. LINGGA', 1, 21, NULL, NULL),
(2105, 'KAB. KEPULAUAN ANAMBAS', 1, 21, NULL, NULL),
(2171, 'KOTA BATAM', 2, 21, NULL, NULL),
(2172, 'KOTA TANJUNG PINANG', 2, 21, NULL, NULL),
(3101, 'KAB. ADM. KEP. SERIBU', 1, 31, NULL, NULL),
(3171, 'KOTA ADM. JAKARTA PUSAT', 2, 31, NULL, NULL),
(3172, 'KOTA ADM. JAKARTA UTARA', 2, 31, NULL, NULL),
(3173, 'KOTA ADM. JAKARTA BARAT', 2, 31, NULL, NULL),
(3174, 'KOTA ADM. JAKARTA SELATAN', 2, 31, NULL, NULL),
(3175, 'KOTA ADM. JAKARTA TIMUR', 2, 31, NULL, NULL),
(3201, 'KAB. BOGOR', 1, 32, NULL, NULL),
(3202, 'KAB. SUKABUMI', 1, 32, NULL, NULL),
(3203, 'KAB. CIANJUR', 1, 32, NULL, NULL),
(3204, 'KAB. BANDUNG', 1, 32, NULL, NULL),
(3205, 'KAB. GARUT', 1, 32, NULL, NULL),
(3206, 'KAB. TASIKMALAYA', 1, 32, NULL, NULL),
(3207, 'KAB. CIAMIS', 1, 32, NULL, NULL),
(3208, 'KAB. KUNINGAN', 1, 32, NULL, NULL),
(3209, 'KAB. CIREBON', 1, 32, NULL, NULL),
(3210, 'KAB. MAJALENGKA', 1, 32, NULL, NULL),
(3211, 'KAB. SUMEDANG', 1, 32, NULL, NULL),
(3212, 'KAB. INDRAMAYU', 1, 32, NULL, NULL),
(3213, 'KAB. SUBANG', 1, 32, NULL, NULL),
(3214, 'KAB. PURWAKARTA', 1, 32, NULL, NULL),
(3215, 'KAB. KARAWANG', 1, 32, NULL, NULL),
(3216, 'KAB. BEKASI', 1, 32, NULL, NULL),
(3217, 'KAB. BANDUNG BARAT', 1, 32, NULL, NULL),
(3218, 'KAB. PANGANDARAN', 1, 32, NULL, NULL),
(3271, 'KOTA BOGOR', 2, 32, NULL, NULL),
(3272, 'KOTA SUKABUMI', 2, 32, NULL, NULL),
(3273, 'KOTA BANDUNG', 2, 32, NULL, NULL),
(3274, 'KOTA CIREBON', 2, 32, NULL, NULL),
(3275, 'KOTA BEKASI', 2, 32, NULL, NULL),
(3276, 'KOTA DEPOK', 2, 32, NULL, NULL),
(3277, 'KOTA CIMAHI', 2, 32, NULL, NULL),
(3278, 'KOTA TASIKMALAYA', 2, 32, NULL, NULL),
(3279, 'KOTA BANJAR', 2, 32, NULL, NULL),
(3301, 'KAB. CILACAP', 1, 33, NULL, NULL),
(3302, 'KAB. BANYUMAS', 1, 33, NULL, NULL),
(3303, 'KAB. PURBALINGGA', 1, 33, NULL, NULL),
(3304, 'KAB. BANJARNEGARA', 1, 33, NULL, NULL),
(3305, 'KAB. KEBUMEN', 1, 33, NULL, NULL),
(3306, 'KAB. PURWOREJO', 1, 33, NULL, NULL),
(3307, 'KAB. WONOSOBO', 1, 33, NULL, NULL),
(3308, 'KAB. MAGELANG', 1, 33, NULL, NULL),
(3309, 'KAB. BOYOLALI', 1, 33, NULL, NULL),
(3310, 'KAB. KLATEN', 1, 33, NULL, NULL),
(3311, 'KAB. SUKOHARJO', 1, 33, NULL, NULL),
(3312, 'KAB. WONOGIRI', 1, 33, NULL, NULL),
(3313, 'KAB. KARANGANYAR', 1, 33, NULL, NULL),
(3314, 'KAB. SRAGEN', 1, 33, NULL, NULL),
(3315, 'KAB. GROBOGAN', 1, 33, NULL, NULL),
(3316, 'KAB. BLORA', 1, 33, NULL, NULL),
(3317, 'KAB. REMBANG', 1, 33, NULL, NULL),
(3318, 'KAB. PATI', 1, 33, NULL, NULL),
(3319, 'KAB. KUDUS', 1, 33, NULL, NULL),
(3320, 'KAB. JEPARA', 1, 33, NULL, NULL),
(3321, 'KAB. DEMAK', 1, 33, NULL, NULL),
(3322, 'KAB. SEMARANG', 1, 33, NULL, NULL),
(3323, 'KAB. TEMANGGUNG', 1, 33, NULL, NULL),
(3324, 'KAB. KENDAL', 1, 33, NULL, NULL),
(3325, 'KAB. BATANG', 1, 33, NULL, NULL),
(3326, 'KAB. PEKALONGAN', 1, 33, NULL, NULL),
(3327, 'KAB. PEMALANG', 1, 33, NULL, NULL),
(3328, 'KAB. TEGAL', 1, 33, NULL, NULL),
(3329, 'KAB. BREBES', 1, 33, NULL, NULL),
(3371, 'KOTA MAGELANG', 2, 33, NULL, NULL),
(3372, 'KOTA SURAKARTA', 2, 33, NULL, NULL),
(3373, 'KOTA SALATIGA', 2, 33, NULL, NULL),
(3374, 'KOTA SEMARANG', 2, 33, NULL, NULL),
(3375, 'KOTA PEKALONGAN', 2, 33, NULL, NULL),
(3376, 'KOTA TEGAL', 2, 33, NULL, NULL),
(3401, 'KAB. KULON PROGO', 1, 34, NULL, NULL),
(3402, 'KAB. BANTUL', 1, 34, NULL, NULL),
(3403, 'KAB. GUNUNG KIDUL', 1, 34, NULL, NULL),
(3404, 'KAB. SLEMAN', 1, 34, NULL, NULL),
(3471, 'KOTA YOGYAKARTA', 2, 34, NULL, NULL),
(3501, 'KAB. PACITAN', 1, 35, NULL, NULL),
(3502, 'KAB. PONOROGO', 1, 35, NULL, NULL),
(3503, 'KAB. TRENGGALEK', 1, 35, NULL, NULL),
(3504, 'KAB. TULUNGAGUNG', 1, 35, NULL, NULL),
(3505, 'KAB. BLITAR', 1, 35, NULL, NULL),
(3506, 'KAB. KEDIRI', 1, 35, NULL, NULL),
(3507, 'KAB. MALANG', 1, 35, NULL, NULL),
(3508, 'KAB. LUMAJANG', 1, 35, NULL, NULL),
(3509, 'KAB. JEMBER', 1, 35, NULL, NULL),
(3510, 'KAB. BANYUWANGI', 1, 35, NULL, NULL),
(3511, 'KAB. BONDOWOSO', 1, 35, NULL, NULL),
(3512, 'KAB. SITUBONDO', 1, 35, NULL, NULL),
(3513, 'KAB. PROBOLINGGO', 1, 35, NULL, NULL),
(3514, 'KAB. PASURUAN', 1, 35, NULL, NULL),
(3515, 'KAB. SIDOARJO', 1, 35, NULL, NULL),
(3516, 'KAB. MOJOKERTO', 1, 35, NULL, NULL),
(3517, 'KAB. JOMBANG', 1, 35, NULL, NULL),
(3518, 'KAB. NGANJUK', 1, 35, NULL, NULL),
(3519, 'KAB. MADIUN', 1, 35, NULL, NULL),
(3520, 'KAB. MAGETAN', 1, 35, NULL, NULL),
(3521, 'KAB. NGAWI', 1, 35, NULL, NULL),
(3522, 'KAB. BOJONEGORO', 1, 35, NULL, NULL),
(3523, 'KAB. TUBAN', 1, 35, NULL, NULL),
(3524, 'KAB. LAMONGAN', 1, 35, NULL, NULL),
(3525, 'KAB. GRESIK', 1, 35, NULL, NULL),
(3526, 'KAB. BANGKALAN', 1, 35, NULL, NULL),
(3527, 'KAB. SAMPANG', 1, 35, NULL, NULL),
(3528, 'KAB. PAMEKASAN', 1, 35, NULL, NULL),
(3529, 'KAB. SUMENEP', 1, 35, NULL, NULL),
(3571, 'KOTA KEDIRI', 2, 35, NULL, NULL),
(3572, 'KOTA BLITAR', 2, 35, NULL, NULL),
(3573, 'KOTA MALANG', 2, 35, NULL, NULL),
(3574, 'KOTA PROBOLINGGO', 2, 35, NULL, NULL),
(3575, 'KOTA PASURUAN', 2, 35, NULL, NULL),
(3576, 'KOTA MOJOKERTO', 2, 35, NULL, NULL),
(3577, 'KOTA MADIUN', 2, 35, NULL, NULL),
(3578, 'KOTA SURABAYA', 2, 35, NULL, NULL),
(3579, 'KOTA BATU', 2, 35, NULL, NULL),
(3601, 'KAB. PANDEGLANG', 1, 36, NULL, NULL),
(3602, 'KAB. LEBAK', 1, 36, NULL, NULL),
(3603, 'KAB. TANGERANG', 1, 36, NULL, NULL),
(3604, 'KAB. SERANG', 1, 36, NULL, NULL),
(3671, 'KOTA TANGERANG', 2, 36, NULL, NULL),
(3672, 'KOTA CILEGON', 2, 36, NULL, NULL),
(3673, 'KOTA SERANG', 2, 36, NULL, NULL),
(3674, 'KOTA TANGERANG SELATAN', 2, 36, NULL, NULL),
(5101, 'KAB. JEMBRANA', 1, 51, NULL, NULL),
(5102, 'KAB. TABANAN', 1, 51, NULL, NULL),
(5103, 'KAB. BADUNG', 1, 51, NULL, NULL),
(5104, 'KAB. GIANYAR', 1, 51, NULL, NULL),
(5105, 'KAB. KLUNGKUNG', 1, 51, NULL, NULL),
(5106, 'KAB. BANGLI', 1, 51, NULL, NULL),
(5107, 'KAB. KARANGASEM', 1, 51, NULL, NULL),
(5108, 'KAB. BULELENG', 1, 51, NULL, NULL),
(5171, 'KOTA DENPASAR', 2, 51, NULL, NULL),
(5201, 'KAB. LOMBOK BARAT', 1, 52, NULL, NULL),
(5202, 'KAB. LOMBOK TENGAH', 1, 52, NULL, NULL),
(5203, 'KAB. LOMBOK TIMUR', 1, 52, NULL, NULL),
(5204, 'KAB. SUMBAWA', 1, 52, NULL, NULL),
(5205, 'KAB. DOMPU', 1, 52, NULL, NULL),
(5206, 'KAB. BIMA', 1, 52, NULL, NULL),
(5207, 'KAB. SUMBAWA BARAT', 1, 52, NULL, NULL),
(5208, 'KAB. LOMBOK UTARA', 1, 52, NULL, NULL),
(5271, 'KOTA MATARAM', 2, 52, NULL, NULL),
(5272, 'KOTA BIMA', 2, 52, NULL, NULL),
(5301, 'KAB. KUPANG', 1, 53, NULL, NULL),
(5302, 'KAB TIMOR TENGAH SELATAN', 1, 53, NULL, NULL),
(5303, 'KAB. TIMOR TENGAH UTARA', 1, 53, NULL, NULL),
(5304, 'KAB. BELU', 1, 53, NULL, NULL),
(5305, 'KAB. ALOR', 1, 53, NULL, NULL),
(5306, 'KAB. FLORES TIMUR', 1, 53, NULL, NULL),
(5307, 'KAB. SIKKA', 1, 53, NULL, NULL),
(5308, 'KAB. ENDE', 1, 53, NULL, NULL),
(5309, 'KAB. NGADA', 1, 53, NULL, NULL),
(5310, 'KAB. MANGGARAI', 1, 53, NULL, NULL),
(5311, 'KAB. SUMBA TIMUR', 1, 53, NULL, NULL),
(5312, 'KAB. SUMBA BARAT', 1, 53, NULL, NULL),
(5313, 'KAB. LEMBATA', 1, 53, NULL, NULL),
(5314, 'KAB. ROTE NDAO', 1, 53, NULL, NULL),
(5315, 'KAB. MANGGARAI BARAT', 1, 53, NULL, NULL),
(5316, 'KAB. NAGEKEO', 1, 53, NULL, NULL),
(5317, 'KAB. SUMBA TENGAH', 1, 53, NULL, NULL),
(5318, 'KAB. SUMBA BARAT DAYA', 1, 53, NULL, NULL),
(5319, 'KAB. MANGGARAI TIMUR', 1, 53, NULL, NULL),
(5320, 'KAB. SABU RAIJUA', 1, 53, NULL, NULL),
(5321, 'KAB. MALAKA', 1, 53, NULL, NULL),
(5371, 'KOTA KUPANG', 2, 53, NULL, NULL),
(6101, 'KAB. SAMBAS', 1, 61, NULL, NULL),
(6102, 'KAB. MEMPAWAH', 1, 61, NULL, NULL),
(6103, 'KAB. SANGGAU', 1, 61, NULL, NULL),
(6104, 'KAB. KETAPANG', 1, 61, NULL, NULL),
(6105, 'KAB. SINTANG', 1, 61, NULL, NULL),
(6106, 'KAB. KAPUAS HULU', 1, 61, NULL, NULL),
(6107, 'KAB. BENGKAYANG', 1, 61, NULL, NULL),
(6108, 'KAB. LANDAK', 1, 61, NULL, NULL),
(6109, 'KAB. SEKADAU', 1, 61, NULL, NULL),
(6110, 'KAB. MELAWI', 1, 61, NULL, NULL),
(6111, 'KAB. KAYONG UTARA', 1, 61, NULL, NULL),
(6112, 'KAB. KUBU RAYA', 1, 61, NULL, NULL),
(6171, 'KOTA PONTIANAK', 2, 61, NULL, NULL),
(6172, 'KOTA SINGKAWANG', 2, 61, NULL, NULL),
(6201, 'KAB. KOTAWARINGIN BARAT', 1, 62, NULL, NULL),
(6202, 'KAB. KOTAWARINGIN TIMUR', 1, 62, NULL, NULL),
(6203, 'KAB. KAPUAS', 1, 62, NULL, NULL),
(6204, 'KAB. BARITO SELATAN', 1, 62, NULL, NULL),
(6205, 'KAB. BARITO UTARA', 1, 62, NULL, NULL),
(6206, 'KAB. KATINGAN', 1, 62, NULL, NULL),
(6207, 'KAB. SERUYAN', 1, 62, NULL, NULL),
(6208, 'KAB. SUKAMARA', 1, 62, NULL, NULL),
(6209, 'KAB. LAMANDAU', 1, 62, NULL, NULL),
(6210, 'KAB. GUNUNG MAS', 1, 62, NULL, NULL),
(6211, 'KAB. PULANG PISAU', 1, 62, NULL, NULL),
(6212, 'KAB. MURUNG RAYA', 1, 62, NULL, NULL),
(6213, 'KAB. BARITO TIMUR', 1, 62, NULL, NULL),
(6271, 'KOTA PALANGKARAYA', 2, 62, NULL, NULL),
(6301, 'KAB. TANAH LAUT', 1, 63, NULL, NULL),
(6302, 'KAB. KOTABARU', 1, 63, NULL, NULL),
(6303, 'KAB. BANJAR', 1, 63, NULL, NULL),
(6304, 'KAB. BARITO KUALA', 1, 63, NULL, NULL),
(6305, 'KAB. TAPIN', 1, 63, NULL, NULL),
(6306, 'KAB. HULU SUNGAI SELATAN', 1, 63, NULL, NULL),
(6307, 'KAB. HULU SUNGAI TENGAH', 1, 63, NULL, NULL),
(6308, 'KAB. HULU SUNGAI UTARA', 1, 63, NULL, NULL),
(6309, 'KAB. TABALONG', 1, 63, NULL, NULL),
(6310, 'KAB. TANAH BUMBU', 1, 63, NULL, NULL),
(6311, 'KAB. BALANGAN', 1, 63, NULL, NULL),
(6371, 'KOTA BANJARMASIN', 2, 63, NULL, NULL),
(6372, 'KOTA BANJARBARU', 2, 63, NULL, NULL),
(6401, 'KAB. PASER', 1, 64, NULL, NULL),
(6402, 'KAB. KUTAI KARTANEGARA', 1, 64, NULL, NULL),
(6403, 'KAB. BERAU', 1, 64, NULL, NULL),
(6407, 'KAB. KUTAI BARAT', 1, 64, NULL, NULL),
(6408, 'KAB. KUTAI TIMUR', 1, 64, NULL, NULL),
(6409, 'KAB. PENAJAM PASER UTARA', 1, 64, NULL, NULL),
(6411, 'KAB. MAHAKAM ULU', 1, 64, NULL, NULL),
(6471, 'KOTA BALIKPAPAN', 2, 64, NULL, NULL),
(6472, 'KOTA SAMARINDA', 2, 64, NULL, NULL),
(6474, 'KOTA BONTANG', 2, 64, NULL, NULL),
(6501, 'KAB. BULUNGAN', 1, 65, NULL, NULL),
(6502, 'KAB. MALINAU', 1, 65, NULL, NULL),
(6503, 'KAB. NUNUKAN', 1, 65, NULL, NULL),
(6504, 'KAB. TANA TIDUNG', 1, 65, NULL, NULL),
(6571, 'KOTA TARAKAN', 2, 65, NULL, NULL),
(7101, 'KAB. BOLAANG MONGONDOW', 1, 71, NULL, NULL),
(7102, 'KAB. MINAHASA', 1, 71, NULL, NULL),
(7103, 'KAB. KEPULAUAN SANGIHE', 1, 71, NULL, NULL),
(7104, 'KAB. KEPULAUAN TALAUD', 1, 71, NULL, NULL),
(7105, 'KAB. MINAHASA SELATAN', 1, 71, NULL, NULL),
(7106, 'KAB. MINAHASA UTARA', 1, 71, NULL, NULL),
(7107, 'KAB. MINAHASA TENGGARA', 1, 71, NULL, NULL),
(7108, 'KAB. BOLAANG MONGONDOW UTARA', 1, 71, NULL, NULL),
(7109, 'KAB. KEP. SIAU TAGULANDANG BIARO', 1, 71, NULL, NULL),
(7110, 'KAB. BOLAANG MONGONDOW TIMUR', 1, 71, NULL, NULL),
(7111, 'KAB. BOLAANG MONGONDOW SELATAN', 1, 71, NULL, NULL),
(7171, 'KOTA MANADO', 2, 71, NULL, NULL),
(7172, 'KOTA BITUNG', 2, 71, NULL, NULL),
(7173, 'KOTA TOMOHON', 2, 71, NULL, NULL),
(7174, 'KOTA KOTAMOBAGU', 2, 71, NULL, NULL),
(7201, 'KAB. BANGGAI', 1, 72, NULL, NULL),
(7202, 'KAB. POSO', 1, 72, NULL, NULL),
(7203, 'KAB. DONGGALA', 1, 72, NULL, NULL),
(7204, 'KAB. TOLI TOLI', 1, 72, NULL, NULL),
(7205, 'KAB. BUOL', 1, 72, NULL, NULL),
(7206, 'KAB. MOROWALI', 1, 72, NULL, NULL),
(7207, 'KAB. BANGGAI KEPULAUAN', 1, 72, NULL, NULL),
(7208, 'KAB. PARIGI MOUTONG', 1, 72, NULL, NULL),
(7209, 'KAB. TOJO UNA UNA', 1, 72, NULL, NULL),
(7210, 'KAB. SIGI', 1, 72, NULL, NULL),
(7211, 'KAB. BANGGAI LAUT', 1, 72, NULL, NULL),
(7212, 'KAB. MOROWALI UTARA', 1, 72, NULL, NULL),
(7271, 'KOTA PALU', 2, 72, NULL, NULL),
(7301, 'KAB. KEPULAUAN SELAYAR', 1, 73, NULL, NULL),
(7302, 'KAB. BULUKUMBA', 1, 73, NULL, NULL),
(7303, 'KAB. BANTAENG', 1, 73, NULL, NULL),
(7304, 'KAB. JENEPONTO', 1, 73, NULL, NULL),
(7305, 'KAB. TAKALAR', 1, 73, NULL, NULL),
(7306, 'KAB. GOWA', 1, 73, NULL, NULL),
(7307, 'KAB. SINJAI', 1, 73, NULL, NULL),
(7308, 'KAB. BONE', 1, 73, NULL, NULL),
(7309, 'KAB. MAROS', 1, 73, NULL, NULL),
(7310, 'KAB. PANGKAJENE KEPULAUAN', 1, 73, NULL, NULL),
(7311, 'KAB. BARRU', 1, 73, NULL, NULL),
(7312, 'KAB. SOPPENG', 1, 73, NULL, NULL),
(7313, 'KAB. WAJO', 1, 73, NULL, NULL),
(7314, 'KAB. SIDENRENG RAPPANG', 1, 73, NULL, NULL),
(7315, 'KAB. PINRANG', 1, 73, NULL, NULL),
(7316, 'KAB. ENREKANG', 1, 73, NULL, NULL),
(7317, 'KAB. LUWU', 1, 73, NULL, NULL),
(7318, 'KAB. TANA TORAJA', 1, 73, NULL, NULL),
(7322, 'KAB. LUWU UTARA', 1, 73, NULL, NULL),
(7324, 'KAB. LUWU TIMUR', 1, 73, NULL, NULL),
(7326, 'KAB. TORAJA UTARA', 1, 73, NULL, NULL),
(7371, 'KOTA MAKASSAR', 2, 73, NULL, NULL),
(7372, 'KOTA PARE PARE', 2, 73, NULL, NULL),
(7373, 'KOTA PALOPO', 2, 73, NULL, NULL),
(7401, 'KAB. KOLAKA', 1, 74, NULL, NULL),
(7402, 'KAB. KONAWE', 1, 74, NULL, NULL),
(7403, 'KAB. MUNA', 1, 74, NULL, NULL),
(7404, 'KAB. BUTON', 1, 74, NULL, NULL),
(7405, 'KAB. KONAWE SELATAN', 1, 74, NULL, NULL),
(7406, 'KAB. BOMBANA', 1, 74, NULL, NULL),
(7407, 'KAB. WAKATOBI', 1, 74, NULL, NULL),
(7408, 'KAB. KOLAKA UTARA', 1, 74, NULL, NULL),
(7409, 'KAB. KONAWE UTARA', 1, 74, NULL, NULL),
(7410, 'KAB. BUTON UTARA', 1, 74, NULL, NULL),
(7411, 'KAB. KOLAKA TIMUR', 1, 74, NULL, NULL),
(7412, 'KAB. KONAWE KEPULAUAN', 1, 74, NULL, NULL),
(7413, 'KAB. MUNA BARAT', 1, 74, NULL, NULL),
(7414, 'KAB. BUTON TENGAH', 1, 74, NULL, NULL),
(7415, 'KAB. BUTON SELATAN', 1, 74, NULL, NULL),
(7471, 'KOTA KENDARI', 2, 74, NULL, NULL),
(7472, 'KOTA BAU BAU', 2, 74, NULL, NULL),
(7501, 'KAB. GORONTALO', 1, 75, NULL, NULL),
(7502, 'KAB. BOALEMO', 1, 75, NULL, NULL),
(7503, 'KAB. BONE BOLANGO', 1, 75, NULL, NULL),
(7504, 'KAB. PAHUWATO', 1, 75, NULL, NULL),
(7505, 'KAB. GORONTALO UTARA', 1, 75, NULL, NULL),
(7571, 'KOTA GORONTALO', 2, 75, NULL, NULL),
(7601, 'KAB. MAMUJU UTARA', 1, 76, NULL, NULL),
(7602, 'KAB. MAMUJU', 1, 76, NULL, NULL),
(7603, 'KAB. MAMASA', 1, 76, NULL, NULL),
(7604, 'KAB. POLEWALI MANDAR', 1, 76, NULL, NULL),
(7605, 'KAB. MAJENE', 1, 76, NULL, NULL),
(7606, 'KAB. MAMUJU TENGAH', 1, 76, NULL, NULL),
(8101, 'KAB. MALUKU TENGAH', 1, 81, NULL, NULL),
(8102, 'KAB. MALUKU TENGGARA', 1, 81, NULL, NULL),
(8103, 'KAB MALUKU TENGGARA BARAT', 1, 81, NULL, NULL),
(8104, 'KAB. BURU', 1, 81, NULL, NULL),
(8105, 'KAB. SERAM BAGIAN TIMUR', 1, 81, NULL, NULL),
(8106, 'KAB. SERAM BAGIAN BARAT', 1, 81, NULL, NULL),
(8107, 'KAB. KEPULAUAN ARU', 1, 81, NULL, NULL),
(8108, 'KAB. MALUKU BARAT DAYA', 1, 81, NULL, NULL),
(8109, 'KAB. BURU SELATAN', 1, 81, NULL, NULL),
(8171, 'KOTA AMBON', 2, 81, NULL, NULL),
(8172, 'KOTA TUAL', 2, 81, NULL, NULL),
(8201, 'KAB. HALMAHERA BARAT', 1, 82, NULL, NULL),
(8202, 'KAB. HALMAHERA TENGAH', 1, 82, NULL, NULL),
(8203, 'KAB. HALMAHERA UTARA', 1, 82, NULL, NULL),
(8204, 'KAB. HALMAHERA SELATAN', 1, 82, NULL, NULL),
(8205, 'KAB. KEPULAUAN SULA', 1, 82, NULL, NULL),
(8206, 'KAB. HALMAHERA TIMUR', 1, 82, NULL, NULL),
(8207, 'KAB. PULAU MOROTAI', 1, 82, NULL, NULL),
(8208, 'KAB. PULAU TALIABU', 1, 82, NULL, NULL),
(8271, 'KOTA TERNATE', 2, 82, NULL, NULL),
(8272, 'KOTA TIDORE KEPULAUAN', 2, 82, NULL, NULL),
(9101, 'KAB. MERAUKE', 1, 91, NULL, NULL),
(9102, 'KAB. JAYAWIJAYA', 1, 91, NULL, NULL),
(9103, 'KAB. JAYAPURA', 1, 91, NULL, NULL),
(9104, 'KAB. NABIRE', 1, 91, NULL, NULL),
(9105, 'KAB. KEPULAUAN YAPEN', 1, 91, NULL, NULL),
(9106, 'KAB. BIAK NUMFOR', 1, 91, NULL, NULL),
(9107, 'KAB. PUNCAK JAYA', 1, 91, NULL, NULL),
(9108, 'KAB. PANIAI', 1, 91, NULL, NULL),
(9109, 'KAB. MIMIKA', 1, 91, NULL, NULL),
(9110, 'KAB. SARMI', 1, 91, NULL, NULL),
(9111, 'KAB. KEEROM', 1, 91, NULL, NULL),
(9112, 'KAB PEGUNUNGAN BINTANG', 1, 91, NULL, NULL),
(9113, 'KAB. YAHUKIMO', 1, 91, NULL, NULL),
(9114, 'KAB. TOLIKARA', 1, 91, NULL, NULL),
(9115, 'KAB. WAROPEN', 1, 91, NULL, NULL),
(9116, 'KAB. BOVEN DIGOEL', 1, 91, NULL, NULL),
(9117, 'KAB. MAPPI', 1, 91, NULL, NULL),
(9118, 'KAB. ASMAT', 1, 91, NULL, NULL),
(9119, 'KAB. SUPIORI', 1, 91, NULL, NULL),
(9120, 'KAB. MAMBERAMO RAYA', 1, 91, NULL, NULL),
(9121, 'KAB. MAMBERAMO TENGAH', 1, 91, NULL, NULL),
(9122, 'KAB. YALIMO', 1, 91, NULL, NULL),
(9123, 'KAB. LANNY JAYA', 1, 91, NULL, NULL),
(9124, 'KAB. NDUGA', 1, 91, NULL, NULL),
(9125, 'KAB. PUNCAK', 1, 91, NULL, NULL),
(9126, 'KAB. DOGIYAI', 1, 91, NULL, NULL),
(9127, 'KAB. INTAN JAYA', 1, 91, NULL, NULL),
(9128, 'KAB. DEIYAI', 1, 91, NULL, NULL),
(9171, 'KOTA JAYAPURA', 2, 91, NULL, NULL),
(9201, 'KAB. SORONG', 1, 92, NULL, NULL),
(9202, 'KAB. MANOKWARI', 1, 92, NULL, NULL),
(9203, 'KAB. FAK FAK', 1, 92, NULL, NULL),
(9204, 'KAB. SORONG SELATAN', 1, 92, NULL, NULL),
(9205, 'KAB. RAJA AMPAT', 1, 92, NULL, NULL),
(9206, 'KAB. TELUK BINTUNI', 1, 92, NULL, NULL),
(9207, 'KAB. TELUK WONDAMA', 1, 92, NULL, NULL),
(9208, 'KAB. KAIMANA', 1, 92, NULL, NULL),
(9209, 'KAB. TAMBRAUW', 1, 92, NULL, NULL),
(9210, 'KAB. MAYBRAT', 1, 92, NULL, NULL),
(9211, 'KAB. MANOKWARI SELATAN', 1, 92, NULL, NULL),
(9212, 'KAB. PEGUNUNGAN ARFAK', 1, 92, NULL, NULL),
(9271, 'KOTA SORONG', 2, 92, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_traces`
--

CREATE TABLE `job_traces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `log` text COLLATE utf8mb4_unicode_ci,
  `file_path` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Indonesia', '2021-11-13 13:59:22', '2021-11-13 13:59:22', NULL),
(2, 'Inggris', '2021-11-13 13:59:29', '2021-11-13 13:59:29', NULL);

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
(4, '2021_10_23_141145_create_job_traces_table', 1),
(5, '2021_10_23_150401_create_roles_table', 1),
(6, '2021_10_23_170251_add_role_id_to_users_table', 1),
(7, '2021_10_24_071056_create_provinces_table', 2),
(8, '2021_10_24_071335_create_cities_table', 2),
(9, '2021_10_24_072542_add_province_id_and_city_id_to_users_table', 3),
(11, '2021_10_24_143103_add_code_to_roles_table', 4),
(12, '2021_11_13_202613_create_blog_categories_table', 5),
(13, '2021_11_13_202706_create_languages_table', 5),
(15, '2021_11_13_204152_create_blogs_table', 6),
(16, '2021_11_13_220425_create_blog_has_categories_table', 6);

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
-- Table structure for table `provinces`
--

CREATE TABLE `provinces` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `name`, `created_at`, `updated_at`) VALUES
(11, 'Aceh', NULL, NULL),
(12, 'Sumatera Utara', NULL, NULL),
(13, 'Sumatera Barat', NULL, NULL),
(14, 'Riau', NULL, NULL),
(15, 'Jambi', NULL, NULL),
(16, 'Sumatera Selatan', NULL, NULL),
(17, 'Bengkulu', NULL, NULL),
(18, 'Lampung', NULL, NULL),
(19, 'Kepulauan Bangka Belitung', NULL, NULL),
(21, 'Kepulauan Riau', NULL, NULL),
(31, 'DKI Jakarta', NULL, NULL),
(32, 'Jawa Barat', NULL, NULL),
(33, 'Jawa Tengah', NULL, NULL),
(34, 'DI Yogyakarta', NULL, NULL),
(35, 'Jawa Timur', NULL, NULL),
(36, 'Banten', NULL, NULL),
(51, 'Bali', NULL, NULL),
(52, 'Nusa Tenggara Barat', NULL, NULL),
(53, 'Nusa Tenggara Timur', NULL, NULL),
(61, 'Kalimantan Barat', NULL, NULL),
(62, 'Kalimantan Tengah', NULL, NULL),
(63, 'Kalimantan Selatan', NULL, NULL),
(64, 'Kalimantan Timur', NULL, NULL),
(65, 'Kalimantan Utara', NULL, NULL),
(71, 'Sulawesi Utara', NULL, NULL),
(72, 'Sulawesi Tengah', NULL, NULL),
(73, 'Sulawesi Selatan', NULL, NULL),
(74, 'Sulawesi Tenggara', NULL, NULL),
(75, 'Gorontalo', NULL, NULL),
(76, 'Sulawesi Barat', NULL, NULL),
(81, 'Maluku', NULL, NULL),
(82, 'Maluku Utara', NULL, NULL),
(91, 'Papua Barat', NULL, NULL),
(92, 'Papua', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', 'admin', '2021-10-23 10:21:51', '2021-10-24 08:05:03', NULL),
(2, 'Registered User', NULL, '2021-10-23 10:49:14', '2021-10-23 10:55:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `province_id` bigint(20) UNSIGNED DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `province_id`, `city_id`, `role_id`, `name`, `email`, `phone_number`, `email_verified_at`, `password`, `status`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, NULL, NULL, 1, 'wow', 'teserahaaja@gmail.com', NULL, NULL, '$2y$10$9/yITyDIdEW1krn3808hXu0wGQ4ToGPj5eEm0FpgZRd.d97eil9n6', NULL, NULL, '2021-10-23 10:13:33', '2021-10-24 05:11:22', NULL),
(2, NULL, NULL, 2, 'User Test', 'akoenbaroe01@gmail.com', NULL, NULL, '$2y$10$WbPUwdTOrYV5YMBvRJbjNO1sScazzDnrAMRi9fBFF2iwvJYAioS2m', NULL, NULL, '2021-10-23 10:57:17', '2021-10-23 23:43:57', NULL),
(6, 14, 1401, NULL, 'full name', 'akoenbaroe02@gmail.com', '089604250221', NULL, '$2y$10$9/yITyDIdEW1krn3808hXu0wGQ4ToGPj5eEm0FpgZRd.d97eil9n6', NULL, NULL, '2021-10-24 01:45:08', '2021-10-24 01:45:08', NULL),
(8, 16, 1604, 2, 'ketiga123', 'akoenbaroe03@gmail.com', '10231929', NULL, '$2y$10$BgzcSXzdWosYRNhUBsqwUu43r70kFZofeIl4LQv9BQL1R9rQsMmsG', NULL, NULL, '2021-10-24 08:20:06', '2021-10-24 08:29:14', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blogs_language_id_foreign` (`language_id`);

--
-- Indexes for table `blog_categories`
--
ALTER TABLE `blog_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_has_categories`
--
ALTER TABLE `blog_has_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `blog_has_categories_blog_id_foreign` (`blog_id`),
  ADD KEY `blog_has_categories_blog_category_id_foreign` (`blog_category_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cities_province_id_foreign` (`province_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_traces`
--
ALTER TABLE `job_traces`
  ADD PRIMARY KEY (`id`),
  ADD KEY `job_traces_user_id_foreign` (`user_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `provinces`
--
ALTER TABLE `provinces`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_city_id_foreign` (`city_id`),
  ADD KEY `users_province_id_foreign` (`province_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `blog_categories`
--
ALTER TABLE `blog_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `blog_has_categories`
--
ALTER TABLE `blog_has_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9272;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_traces`
--
ALTER TABLE `job_traces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `provinces`
--
ALTER TABLE `provinces`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `blogs`
--
ALTER TABLE `blogs`
  ADD CONSTRAINT `blogs_language_id_foreign` FOREIGN KEY (`language_id`) REFERENCES `languages` (`id`);

--
-- Constraints for table `blog_has_categories`
--
ALTER TABLE `blog_has_categories`
  ADD CONSTRAINT `blog_has_categories_blog_category_id_foreign` FOREIGN KEY (`blog_category_id`) REFERENCES `blog_categories` (`id`),
  ADD CONSTRAINT `blog_has_categories_blog_id_foreign` FOREIGN KEY (`blog_id`) REFERENCES `blogs` (`id`);

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `cities_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`);

--
-- Constraints for table `job_traces`
--
ALTER TABLE `job_traces`
  ADD CONSTRAINT `job_traces_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`),
  ADD CONSTRAINT `users_province_id_foreign` FOREIGN KEY (`province_id`) REFERENCES `provinces` (`id`),
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
