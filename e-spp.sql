-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.33 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table db_spp2.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_spp2.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table db_spp2.kelas
CREATE TABLE IF NOT EXISTS `kelas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_kelas` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kompetensi_keahlian` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_spp2.kelas: ~3 rows (approximately)
/*!40000 ALTER TABLE `kelas` DISABLE KEYS */;
INSERT INTO `kelas` (`id`, `nama_kelas`, `kompetensi_keahlian`, `created_at`, `updated_at`) VALUES
	(1, 'XII RPL 2', 'Rekayasa Perangkat Lunak', '2023-03-15 17:22:32', '2023-03-15 17:22:32'),
	(2, 'XII OTKP', 'OTKP', '2023-03-15 18:03:56', '2023-03-15 18:03:56'),
	(3, 'XII MM1', 'MM1', '2023-03-15 20:16:12', '2023-03-15 20:16:12');
/*!40000 ALTER TABLE `kelas` ENABLE KEYS */;

-- Dumping structure for table db_spp2.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_spp2.migrations: ~7 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2020_02_08_070111_create_spp_table', 1),
	(5, '2020_02_08_070127_create_kelas_table', 1),
	(6, '2020_02_08_070145_create_siswa_table', 1),
	(7, '2020_02_08_070250_create_pembayaran_table', 1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table db_spp2.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_spp2.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table db_spp2.pembayaran
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_petugas` bigint(20) unsigned NOT NULL,
  `id_siswa` bigint(20) unsigned NOT NULL,
  `spp_bulan` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `payment_at` date DEFAULT NULL,
  `jumlah_bayar` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_spp2.pembayaran: ~3 rows (approximately)
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` (`id`, `id_petugas`, `id_siswa`, `spp_bulan`, `payment_at`, `jumlah_bayar`, `created_at`, `updated_at`, `status`) VALUES
	(32, 1, 8, '2023-10-01', '2023-03-19', 200000, '2023-03-19 15:30:30', '2023-03-19 15:30:30', 'Sudah Bayar'),
	(33, 1, 7, '2024-01-01', '2023-03-19', 200000, '2023-03-19 15:32:41', '2023-03-19 15:32:41', 'Sudah Bayar'),
	(35, 1, 8, '2023-11-01', '2023-03-19', 200000, '2023-03-19 15:36:12', '2023-03-19 15:36:12', 'Sudah Bayar');
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;

-- Dumping structure for table db_spp2.siswa
CREATE TABLE IF NOT EXISTS `siswa` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_kelas` bigint(20) unsigned NOT NULL,
  `id_spp` bigint(20) unsigned NOT NULL,
  `nisn` char(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nis` char(8) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(35) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `nomor_telp` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_spp2.siswa: ~2 rows (approximately)
/*!40000 ALTER TABLE `siswa` DISABLE KEYS */;
INSERT INTO `siswa` (`id`, `id_kelas`, `id_spp`, `nisn`, `nis`, `nama`, `alamat`, `nomor_telp`, `created_at`, `updated_at`, `user_id`) VALUES
	(7, 1, 4, '122032132', '213212', 'DAFFA', 'Jlnasda', '085165', '2023-03-19 11:04:03', '2023-03-19 11:04:03', 14),
	(8, 1, 4, '315351631', '31231', 'LANA', 'asdasdaas', '08016516', '2023-03-19 12:29:57', '2023-03-19 12:29:57', 15);
/*!40000 ALTER TABLE `siswa` ENABLE KEYS */;

-- Dumping structure for table db_spp2.spp
CREATE TABLE IF NOT EXISTS `spp` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tahun` year(4) NOT NULL,
  `nominal` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_spp2.spp: ~1 rows (approximately)
/*!40000 ALTER TABLE `spp` DISABLE KEYS */;
INSERT INTO `spp` (`id`, `tahun`, `nominal`, `created_at`, `updated_at`) VALUES
	(4, '2023', 200000, '2023-03-19 11:03:27', '2023-03-19 11:03:27');
/*!40000 ALTER TABLE `spp` ENABLE KEYS */;

-- Dumping structure for table db_spp2.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `level` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table db_spp2.users: ~5 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `level`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'admin', 'admin@app.com', NULL, '$2y$10$azO1GE.wLI0r0JkAaaRSiO6L42uM92VAzSZhbzd0w6sQQ5TzzdDYa', 'admin', NULL, '2023-03-15 17:22:31', '2023-03-15 17:22:31'),
	(2, 'petugas', 'petugas@app.com', NULL, '$2y$10$azO1GE.wLI0r0JkAaaRSiO6L42uM92VAzSZhbzd0w6sQQ5TzzdDYa', 'petugas', NULL, '2023-03-15 17:22:32', '2023-03-15 17:22:32'),
	(14, 'daffa', 'daffa@app.com', NULL, '$2y$10$.0DnQrwxWv5lIKz7y.o7NeKSKvRkuWMgOqTDII/5GWpsBO3V9J.1O', 'siswa', NULL, '2023-03-19 11:04:03', '2023-03-19 11:04:03'),
	(15, 'Lana', 'Lana@app.com', NULL, '$2y$10$6AY.L2s8J72tZJ6gc89VN.d2WEjxxjnqsMnrmvtI3iOJqI3XZwv/C', 'siswa', NULL, '2023-03-19 12:29:57', '2023-03-19 12:29:57');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
