-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 01, 2022 at 01:25 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `adminstarter`
--

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capital_city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `country_name`, `capital_city`, `created_at`, `updated_at`) VALUES
(3, 'asfasd', 'asdfas', '2022-07-30 15:06:04', '2022-07-30 15:06:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

DROP TABLE IF EXISTS `jadwals`;
CREATE TABLE IF NOT EXISTS `jadwals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kursus` int(11) NOT NULL,
  `id_instruktur` int(11) NOT NULL,
  `id_mobil` int(11) NOT NULL,
  `tanggal` date NOT NULL,
  `jam_mulai` time NOT NULL,
  `jam_akhir` time NOT NULL,
  `status` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jadwals`
--

INSERT INTO `jadwals` (`id`, `id_kursus`, `id_instruktur`, `id_mobil`, `tanggal`, `jam_mulai`, `jam_akhir`, `status`) VALUES
(1, 1, 2, 1, '2022-08-17', '21:39:13', '21:39:13', '1');

-- --------------------------------------------------------

--
-- Table structure for table `kursuses`
--

DROP TABLE IF EXISTS `kursuses`;
CREATE TABLE IF NOT EXISTS `kursuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_peserta` int(11) NOT NULL,
  `biaya` float NOT NULL,
  `jemput` tinyint(1) DEFAULT NULL,
  `biaya_jemput` float DEFAULT '0',
  `sim` tinyint(1) DEFAULT NULL,
  `biaya_sim` float DEFAULT '0',
  `diskon` int(11) DEFAULT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kursuses`
--

INSERT INTO `kursuses` (`id`, `id_peserta`, `biaya`, `jemput`, `biaya_jemput`, `sim`, `biaya_sim`, `diskon`, `status`) VALUES
(1, 3, 1000000, 1, 100000, 1, 500000, 5, '1');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_06_19_211448_create_permission_tables', 1),
(5, '2021_06_19_211608_add_column_to_users_table', 1),
(6, '2021_06_23_041436_create_settings_table', 1),
(7, '2021_07_06_225937_add_column_to_settings_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `mobils`
--

DROP TABLE IF EXISTS `mobils`;
CREATE TABLE IF NOT EXISTS `mobils` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_plat` varchar(30) NOT NULL,
  `merk_mobil` varchar(30) NOT NULL,
  `jenis_mobil` varchar(30) NOT NULL,
  `status` varchar(30) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL,
  `updated_at` timestamp NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `mobils`
--

INSERT INTO `mobils` (`id`, `no_plat`, `merk_mobil`, `jenis_mobil`, `status`, `foto`, `created_at`, `updated_at`) VALUES
(1, '13213asdfadsf', 'Toyota', 'Minibus', 'asdf', 'sadf', '0000-00-00 00:00:00', '2022-07-31 17:48:18'),
(8, 'sadffasdfasdf', 'asdfasdfadsf', 'asdfasdf', NULL, NULL, '2022-07-31 17:49:12', '2022-07-31 17:49:19');

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

DROP TABLE IF EXISTS `model_has_permissions`;
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

DROP TABLE IF EXISTS `model_has_roles`;
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
(1, 'App\\Models\\User', 1),
(2, 'App\\Models\\User', 2),
(3, 'App\\Models\\User', 3),
(3, 'App\\Models\\User', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pembayarans`
--

DROP TABLE IF EXISTS `pembayarans`;
CREATE TABLE IF NOT EXISTS `pembayarans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_kursus` int(11) NOT NULL,
  `id_peserta` int(11) NOT NULL,
  `jumlah` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pembayarans`
--

INSERT INTO `pembayarans` (`id`, `id_kursus`, `id_peserta`, `jumlah`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 500000, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 3, 500000, '2022-08-17 20:51:38', '2022-08-16 20:51:38');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'lihat dasbor', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(2, 'lihat role', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(3, 'tambah role', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(4, 'ubah role', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(5, 'hapus role', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(6, 'lihat permission', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(7, 'tambah permission', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(8, 'ubah permission', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(9, 'hapus permission', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(10, 'lihat assign permission', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(11, 'ubah assign permission', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(12, 'lihat pengguna', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(13, 'tambah pengguna', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(14, 'ubah pengguna', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(15, 'hapus pengguna', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(16, 'lihat pengaturan', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(17, 'ubah pengaturan', 'web', '2022-07-30 09:47:06', '2022-07-30 09:47:06'),
(18, 'lihat mobil', 'web', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'web', '2022-07-30 09:47:05', '2022-07-30 09:47:05'),
(2, 'Instruktur', 'web', '2022-07-30 09:47:05', '2022-07-30 13:44:05'),
(3, 'Peserta', 'web', '2022-07-30 13:44:24', '2022-07-30 13:44:24');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

DROP TABLE IF EXISTS `role_has_permissions`;
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `logo`, `email`, `phone_number`, `address`, `created_at`, `updated_at`, `facebook`, `instagram`, `youtube`, `twitter`) VALUES
(1, 'Nama Sistem', 'logo/Nf5qekYFJ2jTnlvkguecZZii2OJZJdhfSeG1iW6m.png', 'sman4timun@example.com', '+(62)821 7766 2211', 'Jalan Mekar Mawar Desa Maju Jaya, Bersih, 2998877', '2022-07-30 09:47:06', '2022-07-31 13:59:40', 'https://facebook.com', 'https://instagram.com', 'https://youtube.com', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `no_ktp` varchar(30) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `tempat_lahir` varchar(30) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(15) NOT NULL,
  `role` varchar(20) NOT NULL,
  `foto` varchar(200) NOT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ktp` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `gender` enum('male','female') COLLATE utf8mb4_unicode_ci NOT NULL,
  `birth_place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `ktp`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `gender`, `birth_place`, `birth_date`, `address`, `phone_number`, `image`) VALUES
(1, 'Admin sistem', 'superadmin@example.com', '', NULL, '$2y$10$SGaGkToe.PqNw39Dar8AfeKWvo0RIrcRNkUyPhVnQ4f36u5MEfKmS', NULL, '2022-07-30 09:47:05', '2022-07-31 13:57:22', 'male', NULL, NULL, NULL, NULL, 'profile_images/lOwQBwXGCX9Q6Ej3hp8rLVCUIRYFgwkdupyP2p9B.jpg'),
(2, 'Tomi Firman Cahyadi', 'tomifirman88@gmail.com', '', NULL, '$2y$10$5FrIg8qMGvjKleaGwwITXOc6BG/gAiO46eaWqR0oaiaW6ja2O6ABu', NULL, '2022-07-30 12:39:58', '2022-07-30 12:42:01', 'male', NULL, NULL, NULL, NULL, 'profile_images/e4Rq5tb7B73rW9ls7utXYi8BN2Bi7Acs6ugEIjv4.jpg'),
(3, 'peserta', 'peserta@gmail.com', NULL, NULL, '$2y$10$/5956vkU0c11N2i7koux1enDjOUpv7NtQoaqRouzucYtIWhtrOMKi', NULL, '2022-07-31 19:00:22', '2022-07-31 19:00:22', 'male', NULL, NULL, NULL, NULL, 'profile_images/1659294021.png'),
(5, 'atom', 'atomfire88@gmail.com', NULL, NULL, '$2y$10$P60lO9/2L7/NuSQk87xvnOjb0JZSSvlexeVr5s1APXn4LVuP50BEe', NULL, '2022-07-31 19:25:45', '2022-07-31 19:25:45', 'male', NULL, NULL, NULL, NULL, 'profile_images/1659295545.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
