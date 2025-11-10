-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2025 at 05:59 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-gudang`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_log`
--

CREATE TABLE `activity_log` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` bigint(20) UNSIGNED DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` bigint(20) UNSIGNED DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_log`
--

INSERT INTO `activity_log` (`id`, `log_name`, `description`, `subject_type`, `event`, `subject_id`, `causer_type`, `causer_id`, `properties`, `batch_uuid`, `created_at`, `updated_at`) VALUES
(1, 'default', 'created', 'App\\Models\\Jenis', 'created', 1, NULL, NULL, '{\"attributes\":{\"id\":1,\"jenis_barang\":\"pupuk cair\",\"user_id\":1,\"created_at\":\"2025-05-30T13:09:55.000000Z\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(2, 'default', 'created', 'App\\Models\\Jenis', 'created', 2, NULL, NULL, '{\"attributes\":{\"id\":2,\"jenis_barang\":\"pupuk Kimia\",\"user_id\":1,\"created_at\":\"2025-05-30T13:09:55.000000Z\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(3, 'default', 'created', 'App\\Models\\Satuan', 'created', 1, NULL, NULL, '{\"attributes\":{\"id\":1,\"created_at\":\"2025-05-30T13:09:55.000000Z\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\",\"satuan\":\"Kwintal\",\"user_id\":1}}', NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(4, 'default', 'created', 'App\\Models\\Satuan', 'created', 2, NULL, NULL, '{\"attributes\":{\"id\":2,\"created_at\":\"2025-05-30T13:09:55.000000Z\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\",\"satuan\":\"Liter\",\"user_id\":1}}', NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(5, 'default', 'created', 'App\\Models\\Supplier', 'created', 1, NULL, NULL, '{\"attributes\":{\"id\":1,\"supplier\":\"PT Petrokimia Gresik\",\"alamat\":\"Gresik, Jawa Timur\",\"user_id\":1,\"created_at\":\"2025-05-30T13:09:55.000000Z\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(6, 'default', 'created', 'App\\Models\\Supplier', 'created', 2, NULL, NULL, '{\"attributes\":{\"id\":2,\"supplier\":\"PT Pupuk Indonesia\",\"alamat\":\"Jakarta\",\"user_id\":1,\"created_at\":\"2025-05-30T13:09:55.000000Z\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(7, 'default', 'created', 'App\\Models\\Customer', 'created', 1, NULL, NULL, '{\"attributes\":{\"id\":1,\"customer\":\"CV Konco Tani\",\"alamat\":\"Suronegaran, Jawa Tengah\",\"user_id\":1,\"created_at\":\"2025-05-30T13:09:55.000000Z\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(8, 'default', 'created', 'App\\Models\\Customer', 'created', 2, NULL, NULL, '{\"attributes\":{\"id\":2,\"customer\":\"CV Harapan Tani\",\"alamat\":\"Baledono, Jawa Tengah\",\"user_id\":1,\"created_at\":\"2025-05-30T13:09:55.000000Z\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(9, 'default', 'updated', 'App\\Models\\Jenis', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"jenis_barang\":\"Komputer\",\"updated_at\":\"2025-05-30T13:13:40.000000Z\"},\"old\":{\"jenis_barang\":\"pupuk cair\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 06:13:40', '2025-05-30 06:13:40'),
(10, 'default', 'updated', 'App\\Models\\Jenis', 'updated', 2, 'App\\Models\\User', 3, '{\"attributes\":{\"jenis_barang\":\"CPU\",\"user_id\":3,\"updated_at\":\"2025-05-30T13:15:20.000000Z\"},\"old\":{\"jenis_barang\":\"pupuk Kimia\",\"user_id\":1,\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 06:15:20', '2025-05-30 06:15:20'),
(11, 'default', 'updated', 'App\\Models\\Satuan', 'updated', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-30T13:15:34.000000Z\",\"satuan\":\"PCS\",\"user_id\":3},\"old\":{\"updated_at\":\"2025-05-30T13:09:55.000000Z\",\"satuan\":\"Kwintal\",\"user_id\":1}}', NULL, '2025-05-30 06:15:34', '2025-05-30 06:15:34'),
(12, 'default', 'updated', 'App\\Models\\Satuan', 'updated', 2, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-30T13:15:42.000000Z\",\"satuan\":\"Meter\",\"user_id\":3},\"old\":{\"updated_at\":\"2025-05-30T13:09:55.000000Z\",\"satuan\":\"Liter\",\"user_id\":1}}', NULL, '2025-05-30 06:15:42', '2025-05-30 06:15:42'),
(13, 'default', 'created', 'App\\Models\\Satuan', 'created', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":3,\"created_at\":\"2025-05-30T13:22:23.000000Z\",\"updated_at\":\"2025-05-30T13:22:23.000000Z\",\"satuan\":\"Set\",\"user_id\":3}}', NULL, '2025-05-30 06:22:23', '2025-05-30 06:22:23'),
(14, 'default', 'updated', 'App\\Models\\Supplier', 'updated', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"supplier\":\"PT Pitrok Ink\",\"alamat\":\"Konoha, Wakanda Timur\",\"user_id\":3,\"updated_at\":\"2025-05-30T13:22:47.000000Z\"},\"old\":{\"supplier\":\"PT Petrokimia Gresik\",\"alamat\":\"Gresik, Jawa Timur\",\"user_id\":1,\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 06:22:47', '2025-05-30 06:22:47'),
(15, 'default', 'updated', 'App\\Models\\Supplier', 'updated', 2, 'App\\Models\\User', 3, '{\"attributes\":{\"supplier\":\"PT Power Konoha\",\"alamat\":\"Konoha\",\"user_id\":3,\"updated_at\":\"2025-05-30T13:23:19.000000Z\"},\"old\":{\"supplier\":\"PT Pupuk Indonesia\",\"alamat\":\"Jakarta\",\"user_id\":1,\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 06:23:19', '2025-05-30 06:23:19'),
(16, 'default', 'created', 'App\\Models\\Jenis', 'created', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":3,\"jenis_barang\":\"Mouse\",\"user_id\":3,\"created_at\":\"2025-05-31T00:49:12.000000Z\",\"updated_at\":\"2025-05-31T00:49:12.000000Z\"}}', NULL, '2025-05-30 17:49:13', '2025-05-30 17:49:13'),
(17, 'default', 'created', 'App\\Models\\Jenis', 'created', 4, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":4,\"jenis_barang\":\"Printer\",\"user_id\":3,\"created_at\":\"2025-05-31T00:49:32.000000Z\",\"updated_at\":\"2025-05-31T00:49:32.000000Z\"}}', NULL, '2025-05-30 17:49:32', '2025-05-30 17:49:32'),
(18, 'default', 'created', 'App\\Models\\Jenis', 'created', 5, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":5,\"jenis_barang\":\"Flashdisk\",\"user_id\":3,\"created_at\":\"2025-05-31T00:49:51.000000Z\",\"updated_at\":\"2025-05-31T00:49:51.000000Z\"}}', NULL, '2025-05-30 17:49:51', '2025-05-30 17:49:51'),
(19, 'default', 'created', 'App\\Models\\Supplier', 'created', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":3,\"supplier\":\"Kasep Tech\",\"alamat\":\"Konoha Selatan\",\"user_id\":3,\"created_at\":\"2025-05-31T00:55:57.000000Z\",\"updated_at\":\"2025-05-31T00:55:57.000000Z\"}}', NULL, '2025-05-30 17:55:57', '2025-05-30 17:55:57'),
(20, 'default', 'created', 'App\\Models\\Barang', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"created_at\":\"2025-05-31T03:40:00.000000Z\",\"updated_at\":\"2025-05-31T03:40:00.000000Z\",\"kode_barang\":\"BRG-35993\",\"nama_barang\":\"CPU Gaming 1\",\"deskripsi\":\"CPU Gaming 1, Full set cooling 5\",\"gambar\":\"gambar-barang\\/56.png\",\"stok_minimum\":2,\"stok\":0,\"user_id\":1,\"jenis_id\":2,\"satuan_id\":1}}', NULL, '2025-05-30 20:40:00', '2025-05-30 20:40:00'),
(21, 'default', 'created', 'App\\Models\\Barang', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"created_at\":\"2025-05-31T03:42:07.000000Z\",\"updated_at\":\"2025-05-31T03:42:07.000000Z\",\"kode_barang\":\"BRG-12236\",\"nama_barang\":\"CPU Gaming Pink Hard\",\"deskripsi\":\"CPU Gaming Pink Hard asekkk\",\"gambar\":\"gambar-barang\\/34.png\",\"stok_minimum\":2,\"stok\":0,\"user_id\":1,\"jenis_id\":2,\"satuan_id\":1}}', NULL, '2025-05-30 20:42:07', '2025-05-30 20:42:07'),
(22, 'default', 'created', 'App\\Models\\Barang', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":3,\"created_at\":\"2025-05-31T03:43:19.000000Z\",\"updated_at\":\"2025-05-31T03:43:19.000000Z\",\"kode_barang\":\"BRG-19088\",\"nama_barang\":\"1 Set Komputer Gaming ++\",\"deskripsi\":\"1 Set Komputer Gaming hard ryzen 9 ++\",\"gambar\":\"gambar-barang\\/78.jpg\",\"stok_minimum\":2,\"stok\":0,\"user_id\":1,\"jenis_id\":1,\"satuan_id\":3}}', NULL, '2025-05-30 20:43:19', '2025-05-30 20:43:19'),
(23, 'default', 'created', 'App\\Models\\Barang', 'created', 4, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":4,\"created_at\":\"2025-05-31T03:44:55.000000Z\",\"updated_at\":\"2025-05-31T03:44:55.000000Z\",\"kode_barang\":\"BRG-02405\",\"nama_barang\":\"Komputer Gaming Medium\",\"deskripsi\":\"Komputer Gaming Medium Core I7 Sikatt\",\"gambar\":\"gambar-barang\\/78.jpg\",\"stok_minimum\":2,\"stok\":0,\"user_id\":1,\"jenis_id\":1,\"satuan_id\":3}}', NULL, '2025-05-30 20:44:55', '2025-05-30 20:44:55'),
(24, 'default', 'created', 'App\\Models\\Barang', 'created', 5, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":5,\"created_at\":\"2025-05-31T03:48:58.000000Z\",\"updated_at\":\"2025-05-31T03:48:58.000000Z\",\"kode_barang\":\"BRG-08051\",\"nama_barang\":\"Printer Epson\",\"deskripsi\":\"Printer Epson 1212XXX\",\"gambar\":\"gambar-barang\\/55.jpg\",\"stok_minimum\":2,\"stok\":0,\"user_id\":1,\"jenis_id\":4,\"satuan_id\":1}}', NULL, '2025-05-30 20:48:58', '2025-05-30 20:48:58'),
(25, 'default', 'created', 'App\\Models\\Barang', 'created', 6, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":6,\"created_at\":\"2025-05-31T03:49:27.000000Z\",\"updated_at\":\"2025-05-31T03:49:27.000000Z\",\"kode_barang\":\"BRG-12487\",\"nama_barang\":\"Printer Canon MP22323XX\",\"deskripsi\":\"Printer Canon MP22323XX\",\"gambar\":\"gambar-barang\\/77.png\",\"stok_minimum\":2,\"stok\":0,\"user_id\":1,\"jenis_id\":4,\"satuan_id\":1}}', NULL, '2025-05-30 20:49:27', '2025-05-30 20:49:27'),
(26, 'default', 'created', 'App\\Models\\Barang', 'created', 7, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":7,\"created_at\":\"2025-05-31T03:50:05.000000Z\",\"updated_at\":\"2025-05-31T03:50:05.000000Z\",\"kode_barang\":\"BRG-30170\",\"nama_barang\":\"Printer Brother BR5656PP\",\"deskripsi\":\"Printer Brother BR5656PP Cihuy Mantep\",\"gambar\":\"gambar-barang\\/99.png\",\"stok_minimum\":3,\"stok\":0,\"user_id\":1,\"jenis_id\":4,\"satuan_id\":1}}', NULL, '2025-05-30 20:50:05', '2025-05-30 20:50:05'),
(27, 'default', 'created', 'App\\Models\\Barang', 'created', 8, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":8,\"created_at\":\"2025-05-31T03:50:46.000000Z\",\"updated_at\":\"2025-05-31T03:50:46.000000Z\",\"kode_barang\":\"BRG-18604\",\"nama_barang\":\"Mouse Gaming Logitech Hard1212\",\"deskripsi\":\"Mouse Gaming Logitech Hard1212 Mantep\",\"gambar\":\"gambar-barang\\/44.jpg\",\"stok_minimum\":4,\"stok\":0,\"user_id\":1,\"jenis_id\":3,\"satuan_id\":1}}', NULL, '2025-05-30 20:50:46', '2025-05-30 20:50:46'),
(28, 'default', 'created', 'App\\Models\\Barang', 'created', 9, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":9,\"created_at\":\"2025-05-31T03:51:23.000000Z\",\"updated_at\":\"2025-05-31T03:51:23.000000Z\",\"kode_barang\":\"BRG-79766\",\"nama_barang\":\"Maouse Rexus 3434 GAS\",\"deskripsi\":\"Maouse Rexus 3434 GAS ++\",\"gambar\":\"gambar-barang\\/33.jpg\",\"stok_minimum\":3,\"stok\":0,\"user_id\":1,\"jenis_id\":3,\"satuan_id\":1}}', NULL, '2025-05-30 20:51:23', '2025-05-30 20:51:23'),
(29, 'default', 'created', 'App\\Models\\Barang', 'created', 10, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":10,\"created_at\":\"2025-05-31T03:52:42.000000Z\",\"updated_at\":\"2025-05-31T03:52:42.000000Z\",\"kode_barang\":\"BRG-38130\",\"nama_barang\":\"Mouse Gaming Medium 1233\",\"deskripsi\":\"Mouse Gaming Medium 1233\",\"gambar\":\"gambar-barang\\/63.jpg\",\"stok_minimum\":2,\"stok\":0,\"user_id\":1,\"jenis_id\":3,\"satuan_id\":1}}', NULL, '2025-05-30 20:52:42', '2025-05-30 20:52:42'),
(30, 'default', 'updated', 'App\\Models\\Customer', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"customer\":\"CV be Internt\",\"alamat\":\"Konoha, Wakanda Timur\",\"updated_at\":\"2025-05-31T03:53:26.000000Z\"},\"old\":{\"customer\":\"CV Konco Tani\",\"alamat\":\"Suronegaran, Jawa Tengah\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 20:53:26', '2025-05-30 20:53:26'),
(31, 'default', 'updated', 'App\\Models\\Customer', 'updated', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"customer\":\"CV Harapan ink\",\"alamat\":\"Wakanda Tengah\",\"updated_at\":\"2025-05-31T03:53:48.000000Z\"},\"old\":{\"customer\":\"CV Harapan Tani\",\"alamat\":\"Baledono, Jawa Tengah\",\"updated_at\":\"2025-05-30T13:09:55.000000Z\"}}', NULL, '2025-05-30 20:53:48', '2025-05-30 20:53:48'),
(32, 'default', 'created', 'App\\Models\\Customer', 'created', 3, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":3,\"customer\":\"Kucuy Tech\",\"alamat\":\"Wakanda Barat Daya\",\"user_id\":1,\"created_at\":\"2025-05-31T03:54:16.000000Z\",\"updated_at\":\"2025-05-31T03:54:16.000000Z\"}}', NULL, '2025-05-30 20:54:17', '2025-05-30 20:54:17'),
(33, 'default', 'created', 'App\\Models\\BarangMasuk', 'created', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":1,\"kode_transaksi\":\"TRX-IN-2025-5-31-0707\",\"tanggal_masuk\":\"2025-05-31\",\"nama_barang\":\"CPU Gaming 1\",\"jumlah_masuk\":3,\"supplier_id\":1,\"user_id\":1,\"created_at\":\"2025-05-31T03:54:42.000000Z\",\"updated_at\":\"2025-05-31T03:54:42.000000Z\"}}', NULL, '2025-05-30 20:54:42', '2025-05-30 20:54:42'),
(34, 'default', 'updated', 'App\\Models\\Barang', 'updated', 1, 'App\\Models\\User', 1, '{\"attributes\":{\"updated_at\":\"2025-05-31T03:54:42.000000Z\",\"stok\":3},\"old\":{\"updated_at\":\"2025-05-31T03:40:00.000000Z\",\"stok\":0}}', NULL, '2025-05-30 20:54:42', '2025-05-30 20:54:42'),
(35, 'default', 'created', 'App\\Models\\BarangMasuk', 'created', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"id\":2,\"kode_transaksi\":\"TRX-IN-2025-5-31-1927\",\"tanggal_masuk\":\"2025-05-31\",\"nama_barang\":\"CPU Gaming Pink Hard\",\"jumlah_masuk\":5,\"supplier_id\":2,\"user_id\":1,\"created_at\":\"2025-05-31T03:55:16.000000Z\",\"updated_at\":\"2025-05-31T03:55:16.000000Z\"}}', NULL, '2025-05-30 20:55:16', '2025-05-30 20:55:16'),
(36, 'default', 'updated', 'App\\Models\\Barang', 'updated', 2, 'App\\Models\\User', 1, '{\"attributes\":{\"updated_at\":\"2025-05-31T03:55:16.000000Z\",\"stok\":5},\"old\":{\"updated_at\":\"2025-05-31T03:42:07.000000Z\",\"stok\":0}}', NULL, '2025-05-30 20:55:16', '2025-05-30 20:55:16'),
(37, 'default', 'created', 'App\\Models\\BarangMasuk', 'created', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":3,\"kode_transaksi\":\"TRX-IN-2025-5-31-8412\",\"tanggal_masuk\":\"2025-05-31\",\"nama_barang\":\"1 Set Komputer Gaming ++\",\"jumlah_masuk\":6,\"supplier_id\":3,\"user_id\":3,\"created_at\":\"2025-05-31T03:59:11.000000Z\",\"updated_at\":\"2025-05-31T03:59:11.000000Z\"}}', NULL, '2025-05-30 20:59:11', '2025-05-30 20:59:11'),
(38, 'default', 'updated', 'App\\Models\\Barang', 'updated', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-31T03:59:11.000000Z\",\"stok\":6},\"old\":{\"updated_at\":\"2025-05-31T03:43:19.000000Z\",\"stok\":0}}', NULL, '2025-05-30 20:59:11', '2025-05-30 20:59:11'),
(39, 'default', 'updated', 'App\\Models\\Barang', 'updated', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-31T04:00:43.000000Z\",\"stok_minimum\":0,\"user_id\":3},\"old\":{\"updated_at\":\"2025-05-31T03:54:42.000000Z\",\"stok_minimum\":2,\"user_id\":1}}', NULL, '2025-05-30 21:00:43', '2025-05-30 21:00:43'),
(40, 'default', 'created', 'App\\Models\\BarangKeluar', 'created', 1, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":1,\"kode_transaksi\":\"TRX-OUT-2025-5-31-6168\",\"tanggal_keluar\":\"2025-05-31\",\"nama_barang\":\"1 Set Komputer Gaming ++\",\"jumlah_keluar\":3,\"customer_id\":3,\"user_id\":3,\"created_at\":\"2025-05-31T04:02:06.000000Z\",\"updated_at\":\"2025-05-31T04:02:06.000000Z\"}}', NULL, '2025-05-30 21:02:06', '2025-05-30 21:02:06'),
(41, 'default', 'updated', 'App\\Models\\Barang', 'updated', 3, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-31T04:02:06.000000Z\",\"stok\":3},\"old\":{\"updated_at\":\"2025-05-31T03:59:11.000000Z\",\"stok\":6}}', NULL, '2025-05-30 21:02:06', '2025-05-30 21:02:06'),
(42, 'default', 'created', 'App\\Models\\BarangMasuk', 'created', 4, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":4,\"kode_transaksi\":\"TRX-IN-2025-5-31-4686\",\"tanggal_masuk\":\"2025-05-31\",\"nama_barang\":\"Komputer Gaming Medium\",\"jumlah_masuk\":7,\"supplier_id\":2,\"user_id\":3,\"created_at\":\"2025-05-31T04:02:45.000000Z\",\"updated_at\":\"2025-05-31T04:02:45.000000Z\"}}', NULL, '2025-05-30 21:02:45', '2025-05-30 21:02:45'),
(43, 'default', 'updated', 'App\\Models\\Barang', 'updated', 4, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-31T04:02:45.000000Z\",\"stok\":7},\"old\":{\"updated_at\":\"2025-05-31T03:44:55.000000Z\",\"stok\":0}}', NULL, '2025-05-30 21:02:45', '2025-05-30 21:02:45'),
(44, 'default', 'created', 'App\\Models\\BarangMasuk', 'created', 5, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":5,\"kode_transaksi\":\"TRX-IN-2025-5-31-7075\",\"tanggal_masuk\":\"2025-05-31\",\"nama_barang\":\"Maouse Rexus 3434 GAS\",\"jumlah_masuk\":87,\"supplier_id\":3,\"user_id\":3,\"created_at\":\"2025-05-31T04:02:54.000000Z\",\"updated_at\":\"2025-05-31T04:02:54.000000Z\"}}', NULL, '2025-05-30 21:02:54', '2025-05-30 21:02:54'),
(45, 'default', 'updated', 'App\\Models\\Barang', 'updated', 9, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-31T04:02:54.000000Z\",\"stok\":87},\"old\":{\"updated_at\":\"2025-05-31T03:51:23.000000Z\",\"stok\":0}}', NULL, '2025-05-30 21:02:54', '2025-05-30 21:02:54'),
(46, 'default', 'created', 'App\\Models\\BarangMasuk', 'created', 6, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":6,\"kode_transaksi\":\"TRX-IN-2025-5-31-2906\",\"tanggal_masuk\":\"2025-05-31\",\"nama_barang\":\"Mouse Gaming Medium 1233\",\"jumlah_masuk\":107,\"supplier_id\":3,\"user_id\":3,\"created_at\":\"2025-05-31T04:03:11.000000Z\",\"updated_at\":\"2025-05-31T04:03:11.000000Z\"}}', NULL, '2025-05-30 21:03:11', '2025-05-30 21:03:11'),
(47, 'default', 'updated', 'App\\Models\\Barang', 'updated', 10, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-31T04:03:11.000000Z\",\"stok\":107},\"old\":{\"updated_at\":\"2025-05-31T03:52:42.000000Z\",\"stok\":0}}', NULL, '2025-05-30 21:03:11', '2025-05-30 21:03:11'),
(48, 'default', 'created', 'App\\Models\\BarangMasuk', 'created', 7, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":7,\"kode_transaksi\":\"TRX-IN-2025-5-31-9719\",\"tanggal_masuk\":\"2025-05-31\",\"nama_barang\":\"Mouse Gaming Logitech Hard1212\",\"jumlah_masuk\":87,\"supplier_id\":3,\"user_id\":3,\"created_at\":\"2025-05-31T04:03:20.000000Z\",\"updated_at\":\"2025-05-31T04:03:20.000000Z\"}}', NULL, '2025-05-30 21:03:20', '2025-05-30 21:03:20'),
(49, 'default', 'updated', 'App\\Models\\Barang', 'updated', 8, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-31T04:03:20.000000Z\",\"stok\":87},\"old\":{\"updated_at\":\"2025-05-31T03:50:46.000000Z\",\"stok\":0}}', NULL, '2025-05-30 21:03:20', '2025-05-30 21:03:20'),
(50, 'default', 'created', 'App\\Models\\BarangMasuk', 'created', 8, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":8,\"kode_transaksi\":\"TRX-IN-2025-5-31-4844\",\"tanggal_masuk\":\"2025-05-31\",\"nama_barang\":\"Printer Canon MP22323XX\",\"jumlah_masuk\":33,\"supplier_id\":2,\"user_id\":3,\"created_at\":\"2025-05-31T04:07:33.000000Z\",\"updated_at\":\"2025-05-31T04:07:33.000000Z\"}}', NULL, '2025-05-30 21:07:33', '2025-05-30 21:07:33'),
(51, 'default', 'updated', 'App\\Models\\Barang', 'updated', 6, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-31T04:07:33.000000Z\",\"stok\":33},\"old\":{\"updated_at\":\"2025-05-31T03:49:27.000000Z\",\"stok\":0}}', NULL, '2025-05-30 21:07:33', '2025-05-30 21:07:33'),
(52, 'default', 'created', 'App\\Models\\BarangMasuk', 'created', 9, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":9,\"kode_transaksi\":\"TRX-IN-2025-5-31-0355\",\"tanggal_masuk\":\"2025-05-31\",\"nama_barang\":\"Printer Brother BR5656PP\",\"jumlah_masuk\":24,\"supplier_id\":2,\"user_id\":3,\"created_at\":\"2025-05-31T04:07:47.000000Z\",\"updated_at\":\"2025-05-31T04:07:47.000000Z\"}}', NULL, '2025-05-30 21:07:47', '2025-05-30 21:07:47'),
(53, 'default', 'updated', 'App\\Models\\Barang', 'updated', 7, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-31T04:07:47.000000Z\",\"stok\":24},\"old\":{\"updated_at\":\"2025-05-31T03:50:05.000000Z\",\"stok\":0}}', NULL, '2025-05-30 21:07:47', '2025-05-30 21:07:47'),
(54, 'default', 'created', 'App\\Models\\BarangMasuk', 'created', 10, 'App\\Models\\User', 3, '{\"attributes\":{\"id\":10,\"kode_transaksi\":\"TRX-IN-2025-5-31-0625\",\"tanggal_masuk\":\"2025-05-31\",\"nama_barang\":\"Printer Epson\",\"jumlah_masuk\":17,\"supplier_id\":2,\"user_id\":3,\"created_at\":\"2025-05-31T04:08:13.000000Z\",\"updated_at\":\"2025-05-31T04:08:13.000000Z\"}}', NULL, '2025-05-30 21:08:13', '2025-05-30 21:08:13'),
(55, 'default', 'updated', 'App\\Models\\Barang', 'updated', 5, 'App\\Models\\User', 3, '{\"attributes\":{\"updated_at\":\"2025-05-31T04:08:13.000000Z\",\"stok\":17},\"old\":{\"updated_at\":\"2025-05-31T03:48:58.000000Z\",\"stok\":0}}', NULL, '2025-05-30 21:08:13', '2025-05-30 21:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `barangs`
--

CREATE TABLE `barangs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `kode_barang` varchar(255) NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `deskripsi` varchar(255) NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `stok_minimum` int(11) NOT NULL,
  `stok` int(11) DEFAULT 0,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `jenis_id` bigint(20) UNSIGNED NOT NULL,
  `satuan_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barangs`
--

INSERT INTO `barangs` (`id`, `created_at`, `updated_at`, `kode_barang`, `nama_barang`, `deskripsi`, `gambar`, `stok_minimum`, `stok`, `user_id`, `jenis_id`, `satuan_id`) VALUES
(1, '2025-05-30 20:40:00', '2025-05-30 21:00:43', 'BRG-35993', 'CPU Gaming 1', 'CPU Gaming 1, Full set cooling 5', 'gambar-barang/56.png', 0, 3, 3, 2, 1),
(2, '2025-05-30 20:42:07', '2025-05-30 20:55:16', 'BRG-12236', 'CPU Gaming Pink Hard', 'CPU Gaming Pink Hard asekkk', 'gambar-barang/34.png', 2, 5, 1, 2, 1),
(3, '2025-05-30 20:43:19', '2025-05-30 21:02:06', 'BRG-19088', '1 Set Komputer Gaming ++', '1 Set Komputer Gaming hard ryzen 9 ++', 'gambar-barang/78.jpg', 2, 3, 1, 1, 3),
(4, '2025-05-30 20:44:55', '2025-05-30 21:02:45', 'BRG-02405', 'Komputer Gaming Medium', 'Komputer Gaming Medium Core I7 Sikatt', 'gambar-barang/67.png', 2, 7, 1, 1, 3),
(5, '2025-05-30 20:48:58', '2025-05-30 21:08:13', 'BRG-08051', 'Printer Epson', 'Printer Epson 1212XXX', 'gambar-barang/55.jpg', 2, 17, 1, 4, 1),
(6, '2025-05-30 20:49:27', '2025-05-30 21:07:33', 'BRG-12487', 'Printer Canon MP22323XX', 'Printer Canon MP22323XX', 'gambar-barang/77.png', 2, 33, 1, 4, 1),
(7, '2025-05-30 20:50:05', '2025-05-30 21:07:47', 'BRG-30170', 'Printer Brother BR5656PP', 'Printer Brother BR5656PP Cihuy Mantep', 'gambar-barang/99.png', 3, 24, 1, 4, 1),
(8, '2025-05-30 20:50:46', '2025-05-30 21:03:20', 'BRG-18604', 'Mouse Gaming Logitech Hard1212', 'Mouse Gaming Logitech Hard1212 Mantep', 'gambar-barang/44.jpg', 4, 87, 1, 3, 1),
(9, '2025-05-30 20:51:23', '2025-05-30 21:02:54', 'BRG-79766', 'Maouse Rexus 3434 GAS', 'Maouse Rexus 3434 GAS ++', 'gambar-barang/33.jpg', 3, 87, 1, 3, 1),
(10, '2025-05-30 20:52:42', '2025-05-30 21:03:11', 'BRG-38130', 'Mouse Gaming Medium 1233', 'Mouse Gaming Medium 1233', 'gambar-barang/63.jpg', 2, 107, 1, 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `barang_keluars`
--

CREATE TABLE `barang_keluars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `tanggal_keluar` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_keluar` int(11) NOT NULL,
  `customer_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_keluars`
--

INSERT INTO `barang_keluars` (`id`, `kode_transaksi`, `tanggal_keluar`, `nama_barang`, `jumlah_keluar`, `customer_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'TRX-OUT-2025-4-30-6168', '2025-04-30', '1 Set Komputer Gaming ++', 3, 3, 3, '2025-05-30 21:02:06', '2025-05-30 21:02:06');

-- --------------------------------------------------------

--
-- Table structure for table `barang_masuks`
--

CREATE TABLE `barang_masuks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `kode_transaksi` varchar(255) NOT NULL,
  `tanggal_masuk` date NOT NULL,
  `nama_barang` varchar(255) NOT NULL,
  `jumlah_masuk` int(11) NOT NULL,
  `supplier_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `barang_masuks`
--

INSERT INTO `barang_masuks` (`id`, `kode_transaksi`, `tanggal_masuk`, `nama_barang`, `jumlah_masuk`, `supplier_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'TRX-IN-2025-4-30-0707', '2025-04-30', 'CPU Gaming 1', 3, 1, 1, '2025-05-30 20:54:42', '2025-05-30 20:54:42'),
(2, 'TRX-IN-2025-4-30-1927', '2025-04-30', 'CPU Gaming Pink Hard', 5, 2, 1, '2025-05-30 20:55:16', '2025-05-30 20:55:16'),
(3, 'TRX-IN-2025-5-31-8412', '2025-05-31', '1 Set Komputer Gaming ++', 6, 3, 3, '2025-05-30 20:59:11', '2025-05-30 20:59:11'),
(4, 'TRX-IN-2025-5-31-4686', '2025-05-31', 'Komputer Gaming Medium', 7, 2, 3, '2025-05-30 21:02:45', '2025-05-30 21:02:45'),
(5, 'TRX-IN-2025-4-30-7075', '2025-04-30', 'Maouse Rexus 3434 GAS', 87, 3, 3, '2025-05-30 21:02:54', '2025-05-30 21:02:54'),
(6, 'TRX-IN-2025-5-31-2906', '2025-05-31', 'Mouse Gaming Medium 1233', 107, 3, 3, '2025-05-30 21:03:11', '2025-05-30 21:03:11'),
(7, 'TRX-IN-2025-5-31-9719', '2025-05-31', 'Mouse Gaming Logitech Hard1212', 87, 3, 3, '2025-05-30 21:03:20', '2025-05-30 21:03:20'),
(8, 'TRX-IN-2025-5-31-4844', '2025-05-31', 'Printer Canon MP22323XX', 33, 2, 3, '2025-05-30 21:07:33', '2025-05-30 21:07:33'),
(9, 'TRX-IN-2025-5-31-0355', '2025-05-31', 'Printer Brother BR5656PP', 24, 2, 3, '2025-05-30 21:07:47', '2025-05-30 21:07:47'),
(10, 'TRX-IN-2025-5-31-0625', '2025-05-31', 'Printer Epson', 17, 2, 3, '2025-05-30 21:08:13', '2025-05-30 21:08:13');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `customer`, `alamat`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'CV be Internt', 'Konoha, Wakanda Timur', 1, '2025-05-30 06:09:55', '2025-05-30 20:53:26'),
(2, 'CV Harapan ink', 'Wakanda Tengah', 1, '2025-05-30 06:09:55', '2025-05-30 20:53:48'),
(3, 'Kucuy Tech', 'Wakanda Barat Daya', 1, '2025-05-30 20:54:16', '2025-05-30 20:54:16');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jenis`
--

CREATE TABLE `jenis` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `jenis_barang` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jenis`
--

INSERT INTO `jenis` (`id`, `jenis_barang`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Komputer', 1, '2025-05-30 06:09:55', '2025-05-30 06:13:40'),
(2, 'CPU', 3, '2025-05-30 06:09:55', '2025-05-30 06:15:20'),
(3, 'Mouse', 3, '2025-05-30 17:49:12', '2025-05-30 17:49:12'),
(4, 'Printer', 3, '2025-05-30 17:49:32', '2025-05-30 17:49:32'),
(5, 'Flashdisk', 3, '2025-05-30 17:49:51', '2025-05-30 17:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_04_30_113736_create_barangs_table', 1),
(6, '2023_05_08_012945_create_jenis_table', 1),
(7, '2023_05_12_002014_create_satuans_table', 1),
(8, '2023_05_12_232201_create_suppliers_table', 1),
(9, '2023_05_13_003355_create_customers_table', 1),
(10, '2023_05_13_013458_create_barang_masuks_table', 1),
(11, '2023_05_17_135554_create_barang_keluars_table', 1),
(12, '2023_05_28_095805_create_roles_table', 1),
(13, '2023_05_30_124154_create_activity_log_table', 1),
(14, '2023_05_30_124155_add_event_column_to_activity_log_table', 1),
(15, '2023_05_30_124156_add_batch_uuid_column_to_activity_log_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role`, `deskripsi`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Superadmin memiliki kendali penuh pada aplikasi termasuk manajemen User', '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(2, 'kepala gudang', 'Kepala gudang memilki akses untuk mengelola dan mencetak laporan stok, barang masuk, dan barang keluar', '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(3, 'admin gudang', 'Admin gudang memilki akses untuk mengelola stok,  barang masuk, barang keluar dan laporannya', '2025-05-30 06:09:55', '2025-05-30 06:09:55');

-- --------------------------------------------------------

--
-- Table structure for table `satuans`
--

CREATE TABLE `satuans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `satuan` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `satuans`
--

INSERT INTO `satuans` (`id`, `created_at`, `updated_at`, `satuan`, `user_id`) VALUES
(1, '2025-05-30 06:09:55', '2025-05-30 06:15:34', 'PCS', 3),
(2, '2025-05-30 06:09:55', '2025-05-30 06:15:42', 'Meter', 3),
(3, '2025-05-30 06:22:23', '2025-05-30 06:22:23', 'Set', 3);

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier`, `alamat`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'PT Pitrok Ink', 'Konoha, Wakanda Timur', 3, '2025-05-30 06:09:55', '2025-05-30 06:22:47'),
(2, 'PT Power Konoha', 'Konoha', 3, '2025-05-30 06:09:55', '2025-05-30 06:23:19'),
(3, 'Kasep Tech', 'Konoha Selatan', 3, '2025-05-30 17:55:57', '2025-05-30 17:55:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@gmail.com', NULL, '$2y$10$o735mOVo/lEnMkFn/UY/8eNBA9PJuD8b8T9N73Dsmva5evRzX1hwC', 1, NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(2, 'Kepala Gudang', 'kepalagudang@gmail.com', NULL, '$2y$10$D6FYNJbK5MtHSgLt1Wt4w.qj6Sl2UqKKdGFSi5K6R3Vtjy2To04eC', 2, NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55'),
(3, 'Admin Gudang', 'admin@gmail.com', NULL, '$2y$10$QD1VCR5jT0sp/YFbUKwfr.IKmPkx371mdr6Gx3Gj..7Ywl4ZEKtD2', 3, NULL, '2025-05-30 06:09:55', '2025-05-30 06:09:55');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_log`
--
ALTER TABLE `activity_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `subject` (`subject_type`,`subject_id`),
  ADD KEY `causer` (`causer_type`,`causer_id`),
  ADD KEY `activity_log_log_name_index` (`log_name`);

--
-- Indexes for table `barangs`
--
ALTER TABLE `barangs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barangs_kode_barang_unique` (`kode_barang`);

--
-- Indexes for table `barang_keluars`
--
ALTER TABLE `barang_keluars`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barang_keluars_kode_transaksi_unique` (`kode_transaksi`);

--
-- Indexes for table `barang_masuks`
--
ALTER TABLE `barang_masuks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `barang_masuks_kode_transaksi_unique` (`kode_transaksi`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jenis`
--
ALTER TABLE `jenis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `satuans`
--
ALTER TABLE `satuans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_log`
--
ALTER TABLE `activity_log`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `barangs`
--
ALTER TABLE `barangs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `barang_keluars`
--
ALTER TABLE `barang_keluars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `barang_masuks`
--
ALTER TABLE `barang_masuks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis`
--
ALTER TABLE `jenis`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `satuans`
--
ALTER TABLE `satuans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
