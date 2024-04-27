-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2024 at 08:29 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kasir`
--

-- --------------------------------------------------------

--
-- Table structure for table `detailpenjualan`
--

CREATE TABLE `detailpenjualan` (
  `detailID` bigint(20) UNSIGNED NOT NULL,
  `penjualanID` bigint(20) UNSIGNED NOT NULL,
  `produkID` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `detailpenjualan`
--

INSERT INTO `detailpenjualan` (`detailID`, `penjualanID`, `produkID`, `jumlah`, `subtotal`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 10, '30000.00', '2024-04-25 19:14:31', '2024-04-25 19:14:31'),
(2, 1, 2, 10, '10000.00', '2024-04-25 19:14:40', '2024-04-25 19:14:40'),
(3, 1, 4, 5, '10000.00', '2024-04-25 19:15:12', '2024-04-25 19:15:12'),
(25, 4, 1, 10, '30000.00', '2024-04-25 22:57:08', '2024-04-25 22:57:08'),
(26, 4, 4, 10, '20000.00', '2024-04-25 22:57:16', '2024-04-25 22:57:16'),
(28, 4, 2, 10, '10000.00', '2024-04-25 22:57:39', '2024-04-25 22:57:39');

--
-- Triggers `detailpenjualan`
--
DELIMITER $$
CREATE TRIGGER `stok_kurang` AFTER INSERT ON `detailpenjualan` FOR EACH ROW BEGIN
        
            UPDATE produk SET stok = stok - NEW.jumlah WHERE produkID = NEW.produkID;
            
            INSERT INTO `log_stok`(`produkID`, `jumlah`, `aksi`, `created_at`) VALUES (NEW.produkID,NEW.jumlah,"Keluar", NEW.created_at);
            
            END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `stok_tambah` AFTER DELETE ON `detailpenjualan` FOR EACH ROW BEGIN
        
            UPDATE produk SET produk.stok = produk.stok + old.jumlah WHERE produk.produkID = old.produkID;
            
            INSERT INTO `log_stok`(`produkID`, `jumlah`, `aksi`, `created_at`) VALUES (OLD.produkID, OLD.jumlah,"Masuk", OLD.created_at);
            
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `diskon`
--

CREATE TABLE `diskon` (
  `diskonID` bigint(20) UNSIGNED NOT NULL,
  `nominal` decimal(10,2) NOT NULL,
  `persen` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `diskon`
--

INSERT INTO `diskon` (`diskonID`, `nominal`, `persen`, `created_at`, `updated_at`) VALUES
(2, '50000.00', 5, '2024-04-25 20:18:03', '2024-04-25 20:18:03'),
(3, '100000.00', 10, '2024-04-25 20:36:56', '2024-04-25 20:36:56');

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
-- Table structure for table `log_stok`
--

CREATE TABLE `log_stok` (
  `detailLog` bigint(20) UNSIGNED NOT NULL,
  `produkID` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(10) UNSIGNED NOT NULL,
  `aksi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log_stok`
--

INSERT INTO `log_stok` (`detailLog`, `produkID`, `jumlah`, `aksi`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 'Keluar', '2024-04-25 19:20:54', NULL),
(2, 1, 7, 'Masuk', '2024-04-25 19:20:54', NULL),
(3, 1, 16, 'Keluar', '2024-04-25 21:17:20', NULL),
(4, 2, 2, 'Keluar', '2024-04-25 21:29:21', NULL),
(5, 4, 1, 'Keluar', '2024-04-25 21:30:03', NULL),
(6, 4, 1, 'Keluar', '2024-04-25 21:30:44', NULL),
(7, 2, 1, 'Keluar', '2024-04-25 21:31:51', NULL),
(8, 2, 1, 'Keluar', '2024-04-25 21:32:03', NULL),
(9, 2, 1, 'Masuk', '2024-04-25 21:32:03', NULL),
(10, 2, 1, 'Masuk', '2024-04-25 21:31:51', NULL),
(11, 4, 1, 'Masuk', '2024-04-25 21:30:44', NULL),
(12, 2, 1, 'Keluar', '2024-04-25 21:32:16', NULL),
(13, 2, 1, 'Keluar', '2024-04-25 21:32:35', NULL),
(14, 2, 1, 'Keluar', '2024-04-25 21:33:19', NULL),
(15, 2, 1, 'Masuk', '2024-04-25 21:33:19', NULL),
(16, 2, 1, 'Masuk', '2024-04-25 21:32:35', NULL),
(17, 2, 1, 'Masuk', '2024-04-25 21:32:16', NULL),
(18, 1, 1, 'Keluar', '2024-04-25 21:34:31', NULL),
(19, 1, 1, 'Keluar', '2024-04-25 21:34:41', NULL),
(20, 1, 1, 'Keluar', '2024-04-25 21:35:04', NULL),
(21, 1, 1, 'Keluar', '2024-04-25 21:35:51', NULL),
(22, 1, 1, 'Masuk', '2024-04-25 21:34:31', NULL),
(23, 1, 1, 'Masuk', '2024-04-25 21:34:41', NULL),
(24, 1, 1, 'Masuk', '2024-04-25 21:35:04', NULL),
(25, 2, 1, 'Keluar', '2024-04-25 21:36:27', NULL),
(26, 2, 1, 'Keluar', '2024-04-25 21:37:21', NULL),
(27, 2, 1, 'Keluar', '2024-04-25 21:38:24', NULL),
(28, 1, 14, 'Keluar', '2024-04-25 21:38:39', NULL),
(29, 2, 1, 'Masuk', '2024-04-25 21:37:21', NULL),
(30, 2, 1, 'Masuk', '2024-04-25 21:36:27', NULL),
(31, 1, 16, 'Masuk', '2024-04-25 21:17:20', NULL),
(32, 2, 1, 'Masuk', '2024-04-25 21:38:24', NULL),
(33, 1, 18, 'Keluar', '2024-04-25 21:42:56', NULL),
(34, 2, 1, 'Keluar', '2024-04-25 21:43:17', NULL),
(35, 1, 1, 'Masuk', '2024-04-25 21:35:51', NULL),
(36, 1, 18, 'Masuk', '2024-04-25 21:42:56', NULL),
(37, 2, 1, 'Masuk', '2024-04-25 21:43:17', NULL),
(38, 1, 10, 'Keluar', '2024-04-25 22:57:08', NULL),
(39, 4, 10, 'Keluar', '2024-04-25 22:57:16', NULL),
(40, 4, 10, 'Keluar', '2024-04-25 22:57:21', NULL),
(41, 4, 10, 'Masuk', '2024-04-25 22:57:21', NULL),
(42, 2, 10, 'Keluar', '2024-04-25 22:57:39', NULL),
(43, 1, 2, 'Keluar', '2024-04-25 23:08:14', NULL),
(44, 2, 2, 'Keluar', '2024-04-25 23:08:44', NULL),
(45, 2, 2, 'Masuk', '2024-04-25 23:08:44', NULL),
(46, 7, 300, 'Masuk', '2024-04-25 23:25:03', NULL),
(47, 7, 2, 'Keluar', '2024-04-25 23:25:55', NULL),
(48, 7, 2, 'Masuk', '2024-04-25 23:25:55', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `memberID` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomorTelepon` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`memberID`, `nama`, `alamat`, `nomorTelepon`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ken Gosling', 'Jl Pajuruan', '0834567889012', NULL, '2024-04-25 18:59:08', '2024-04-25 19:00:52'),
(3, 'Ridho H', 'Jl ketapang', '082111111112', NULL, '2024-04-25 22:49:24', '2024-04-25 22:49:54');

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
(1, '2014_10_12_000000_create_user_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_20_012729_create_produk_table', 1),
(6, '2024_04_20_012857_create_member_table', 1),
(7, '2024_04_20_012941_create_penjualan_table', 1),
(8, '2024_04_20_013003_create_detail_penjualan_table', 1),
(9, '2024_04_25_024337_log_stok', 1),
(10, '2024_04_26_004631_create_diskon_table', 1),
(11, '2024_04_26_053922_masuk_stok', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `penjualan`
--

CREATE TABLE `penjualan` (
  `penjualanID` bigint(20) UNSIGNED NOT NULL,
  `userID` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `namaMember` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `totalAkhir` decimal(10,2) DEFAULT NULL,
  `bayar` decimal(10,2) DEFAULT NULL,
  `kembalian` decimal(10,2) DEFAULT NULL,
  `status` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `penjualan`
--

INSERT INTO `penjualan` (`penjualanID`, `userID`, `tanggal`, `namaMember`, `total`, `totalAkhir`, `bayar`, `kembalian`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '2024-04-26', 'Ken Gosling', '50000.00', '47500.00', '50000.00', '2500.00', 'selesai', '2024-04-25 19:06:33', '2024-04-25 19:15:30'),
(4, 2, '2024-04-26', 'Ken Gosling', '60000.00', '57000.00', '60000.00', '3000.00', 'selesai', '2024-04-25 22:56:47', '2024-04-25 22:57:55'),
(6, 1, '2024-04-26', 'Bukan member', NULL, NULL, NULL, NULL, 'proses', '2024-04-25 23:25:43', '2024-04-25 23:25:55');

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
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `produk`
--

CREATE TABLE `produk` (
  `produkID` bigint(20) UNSIGNED NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` decimal(10,2) NOT NULL,
  `stok` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `produk`
--

INSERT INTO `produk` (`produkID`, `nama`, `harga`, `stok`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Mie Goreng', '3000.00', 474, 'Aktif', '2024-04-25 18:15:31', '2024-04-25 18:23:34'),
(2, 'Ale-ale', '1000.00', 188, 'Aktif', '2024-04-25 18:18:39', '2024-04-25 18:25:05'),
(4, 'Kerupuk', '2000.00', 89, 'Aktif', '2024-04-25 18:19:35', '2024-04-25 18:39:28'),
(5, 'Mobil Terbang', '99000000.00', 2, 'Nonaktif', '2024-04-25 19:03:35', '2024-04-25 22:37:16'),
(6, 'Tongkat bisbol', '1450000.00', 9, 'Nonaktif', '2024-04-25 22:47:16', '2024-04-25 22:48:33'),
(7, 'Minyak 500ml', '7000.00', 300, 'Aktif', '2024-04-25 23:25:03', '2024-04-25 23:25:03');

--
-- Triggers `produk`
--
DELIMITER $$
CREATE TRIGGER `stok_masuk` AFTER INSERT ON `produk` FOR EACH ROW BEGIN

            INSERT INTO `log_stok`(`produkID`, `jumlah`, `aksi`, `created_at`) VALUES (NEW.produkID, NEW.stok,"Masuk", NEW.created_at);
            
            END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userID` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(10) UNSIGNED NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userID`, `name`, `email`, `role`, `status`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin1', 'admin@gmail.com', 1, NULL, '$2y$12$Um71I2vjYscFK1TBnPyoEuANevEiEkJQ/DYTkDtdfcZvyNY/retk6', NULL, '2024-04-25 18:03:16', '2024-04-25 18:13:54'),
(2, 'Naufal A.I', 'naufala@gmail', 2, 'Aktif', '$2y$12$5/lNpwgtKJPLwhrOXEtF6.p1vhH4GNe8wxoFh5rthFISPNxIMtCr.', NULL, '2024-04-25 18:49:58', '2024-04-25 22:59:51'),
(3, 'Jon', 'jon@gmail.com', 2, 'Nonaktif', '$2y$12$BA28GxPkCD6xf1PTKTC0MOrNWELM8.Q0xRuJbq5WYAnnr6vHj9FtC', NULL, '2024-04-25 22:31:15', '2024-04-25 22:31:24'),
(4, 'Rizal S', 'rizs@gmail.com', 2, 'Nonaktif', '$2y$12$7cgm5vtdZlk4zbR43XCmPeRdY3YYg74f11XPeNoKVbslg2at6oyNu', NULL, '2024-04-25 23:11:12', '2024-04-25 23:11:52');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD PRIMARY KEY (`detailID`),
  ADD KEY `detailpenjualan_penjualanid_foreign` (`penjualanID`),
  ADD KEY `detailpenjualan_produkid_foreign` (`produkID`);

--
-- Indexes for table `diskon`
--
ALTER TABLE `diskon`
  ADD PRIMARY KEY (`diskonID`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `log_stok`
--
ALTER TABLE `log_stok`
  ADD PRIMARY KEY (`detailLog`),
  ADD KEY `log_stok_produkid_foreign` (`produkID`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`memberID`);

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
-- Indexes for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD PRIMARY KEY (`penjualanID`),
  ADD KEY `penjualan_userid_foreign` (`userID`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `produk`
--
ALTER TABLE `produk`
  ADD PRIMARY KEY (`produkID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userID`),
  ADD UNIQUE KEY `user_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  MODIFY `detailID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `diskon`
--
ALTER TABLE `diskon`
  MODIFY `diskonID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `log_stok`
--
ALTER TABLE `log_stok`
  MODIFY `detailLog` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `memberID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `penjualan`
--
ALTER TABLE `penjualan`
  MODIFY `penjualanID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produk`
--
ALTER TABLE `produk`
  MODIFY `produkID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userID` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detailpenjualan`
--
ALTER TABLE `detailpenjualan`
  ADD CONSTRAINT `detailpenjualan_penjualanid_foreign` FOREIGN KEY (`penjualanID`) REFERENCES `penjualan` (`penjualanID`) ON DELETE CASCADE,
  ADD CONSTRAINT `detailpenjualan_produkid_foreign` FOREIGN KEY (`produkID`) REFERENCES `produk` (`produkID`) ON DELETE CASCADE;

--
-- Constraints for table `log_stok`
--
ALTER TABLE `log_stok`
  ADD CONSTRAINT `log_stok_produkid_foreign` FOREIGN KEY (`produkID`) REFERENCES `produk` (`produkID`) ON DELETE CASCADE;

--
-- Constraints for table `penjualan`
--
ALTER TABLE `penjualan`
  ADD CONSTRAINT `penjualan_userid_foreign` FOREIGN KEY (`userID`) REFERENCES `user` (`userID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
