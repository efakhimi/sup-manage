-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.7.3-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table supportmanagementsystem.categories
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.categories: ~2 rows (approximately)
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `name`, `active`, `created_at`, `updated_at`) VALUES
	(1, 'test2222', 1, '2022-12-20 19:12:10', '2022-12-24 01:36:15'),
	(3, 'test 3', 1, '2022-12-20 19:12:25', '2022-12-20 19:12:25');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.contracts
CREATE TABLE IF NOT EXISTS `contracts` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` bigint(20) unsigned NOT NULL,
  `contract_no` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contracts_customer_id_foreign` (`customer_id`),
  CONSTRAINT `contracts_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.contracts: ~2 rows (approximately)
/*!40000 ALTER TABLE `contracts` DISABLE KEYS */;
INSERT INTO `contracts` (`id`, `customer_id`, `contract_no`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
	(1, 1, '123', '2022-12-20', '2023-12-20', 1, '2022-12-20 19:14:23', '2022-12-20 19:14:23'),
	(2, 2, '1234', '2022-12-20', '2023-12-20', 0, '2022-12-20 19:14:32', '2022-12-20 19:14:53'),
	(3, 4, '12345', '2022-12-20', '2023-12-20', 1, '2022-12-20 19:14:43', '2022-12-20 19:14:43');
/*!40000 ALTER TABLE `contracts` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cname` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ctell` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caddress` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `techname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `techtell` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('فعال','غیرفعال','مسدود') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.customers: ~6 rows (approximately)
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
INSERT INTO `customers` (`id`, `cname`, `ctell`, `caddress`, `techname`, `techtell`, `status`, `created_at`, `updated_at`) VALUES
	(1, 'داروسازی حکیم', NULL, NULL, NULL, NULL, 'فعال', '2022-12-20 19:12:34', '2022-12-20 19:12:34'),
	(2, 'شرکت داروپخش', NULL, NULL, NULL, NULL, 'فعال', '2022-12-20 19:12:39', '2022-12-20 19:12:39'),
	(3, 'شرکت کیمیا دارو', NULL, NULL, NULL, NULL, 'فعال', '2022-12-20 19:12:43', '2022-12-20 19:12:43'),
	(4, 'شرکت زهراوی', NULL, NULL, NULL, NULL, 'فعال', '2022-12-20 19:12:48', '2022-12-20 19:12:48'),
	(5, 'داروسازی تهران شیمی', NULL, NULL, NULL, NULL, 'فعال', '2022-12-20 19:12:52', '2022-12-20 19:12:52'),
	(6, 'داروسازی عبیدی', NULL, NULL, NULL, NULL, 'فعال', '2022-12-20 19:12:55', '2022-12-20 19:12:55');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.failed_jobs: ~0 rows (approximately)
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.migrations: ~8 rows (approximately)
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2022_12_19_064726_create_categories_table', 1),
	(6, '2022_12_19_084446_create_customers_table', 1),
	(7, '2022_12_19_170531_create_contracts_table', 1),
	(8, '2022_12_20_175817_create_support_requests_table', 1),
	(9, '2022_12_22_105003_create_permission_tables', 2);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.model_has_permissions
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.model_has_permissions: ~3 rows (approximately)
/*!40000 ALTER TABLE `model_has_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `model_has_permissions` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.model_has_roles
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.model_has_roles: ~1 rows (approximately)
/*!40000 ALTER TABLE `model_has_roles` DISABLE KEYS */;
INSERT INTO `model_has_roles` (`role_id`, `model_type`, `model_id`) VALUES
	(3, 'App\\Models\\User', 1);
/*!40000 ALTER TABLE `model_has_roles` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.password_resets: ~0 rows (approximately)
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.permissions
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.permissions: ~24 rows (approximately)
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(1, 'view_category', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(2, 'create_category', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(3, 'edit_category', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(4, 'delete_category', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(5, 'view_customer', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(6, 'create_customer', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(7, 'edit_customer', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(8, 'delete_customer', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(9, 'view_contract', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(10, 'create_contract', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(11, 'edit_contract', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(12, 'delete_contract', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(13, 'view_suprequest', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(14, 'create_suprequest', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(15, 'edit_suprequest', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(16, 'delete_suprequest', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(17, 'edit_suprequest_all', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(18, 'delete_suprequest_all', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(19, 'view_user', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(20, 'create_user', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(21, 'edit_user', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(22, 'delete_user', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44'),
	(23, 'create_roles', 'web', '2022-12-23 20:17:27', '2022-12-23 20:17:27'),
	(24, 'manipulate_permrole', 'web', '2022-12-23 20:17:27', '2022-12-23 20:17:27');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.personal_access_tokens: ~0 rows (approximately)
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.roles: ~1 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`id`, `name`, `guard_name`, `created_at`, `updated_at`) VALUES
	(3, 'Administrator', 'web', '2022-12-23 15:13:44', '2022-12-23 15:13:44');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.role_has_permissions
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) unsigned NOT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.role_has_permissions: ~24 rows (approximately)
/*!40000 ALTER TABLE `role_has_permissions` DISABLE KEYS */;
INSERT INTO `role_has_permissions` (`permission_id`, `role_id`) VALUES
	(1, 3),
	(2, 3),
	(3, 3),
	(4, 3),
	(5, 3),
	(6, 3),
	(7, 3),
	(8, 3),
	(9, 3),
	(10, 3),
	(11, 3),
	(12, 3),
	(13, 3),
	(14, 3),
	(15, 3),
	(16, 3),
	(17, 3),
	(18, 3),
	(19, 3),
	(20, 3),
	(21, 3),
	(22, 3),
	(23, 3),
	(24, 3);
/*!40000 ALTER TABLE `role_has_permissions` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.support_requests
CREATE TABLE IF NOT EXISTS `support_requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `customer_id` bigint(20) unsigned NOT NULL,
  `category_id` bigint(20) unsigned NOT NULL,
  `title` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `callername` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `callertell` varchar(60) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `solved` tinyint(1) NOT NULL DEFAULT 0,
  `start_date` datetime NOT NULL,
  `end_date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `support_requests_user_id_foreign` (`user_id`),
  KEY `support_requests_customer_id_foreign` (`customer_id`),
  KEY `support_requests_category_id_foreign` (`category_id`),
  CONSTRAINT `support_requests_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `support_requests_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `support_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.support_requests: ~2 rows (approximately)
/*!40000 ALTER TABLE `support_requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `support_requests` ENABLE KEYS */;

-- Dumping structure for table supportmanagementsystem.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uname` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `lname` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `job_position` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `active` tinyint(1) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_uname_unique` (`uname`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table supportmanagementsystem.users: ~4 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `uname`, `password`, `fname`, `lname`, `job_position`, `active`, `last_login`, `remember_token`, `created_at`, `updated_at`) VALUES
	(1, 'root', '$2y$10$FB3E0bEaBgzDhtAGTNkMtuUI7rCcVrnM0NFJBcCI1jhV2izl9t4YK', 'SuperUser', NULL, 'مدیرکل', 1, '2022-12-24 11:35:00', NULL, NULL, '2022-12-24 11:35:56');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
