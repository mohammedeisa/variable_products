-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 08, 2020 at 07:27 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `variable_products`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attributes_category_id_foreign` (`category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `category_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 3, 'Color', '2020-08-11 03:54:48', '2020-08-11 03:54:48'),
(2, 3, 'Size', '2020-08-11 04:40:59', '2020-08-11 04:40:59'),
(3, 3, 'Dimentions', '2020-08-13 22:11:24', '2020-08-13 22:11:24');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_product`
--

DROP TABLE IF EXISTS `attribute_product`;
CREATE TABLE IF NOT EXISTS `attribute_product` (
  `product_id` bigint(20) NOT NULL,
  `attribute_id` bigint(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_product`
--

INSERT INTO `attribute_product` (`product_id`, `attribute_id`) VALUES
(20, 1),
(20, 2),
(24, 1),
(24, 2),
(19, 1),
(19, 3),
(26, 1),
(26, 2),
(30, 1),
(30, 2),
(30, 3),
(31, 1),
(31, 2),
(31, 3),
(33, 1),
(33, 2),
(33, 3);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(3, 'shoes', '2020-08-10 02:21:48', '2020-08-10 02:21:48'),
(4, 'cat4', '2020-08-10 02:23:11', '2020-08-10 02:23:11'),
(18, 'Bags', '2020-09-08 02:04:50', '2020-09-08 02:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `categories__attributes`
--

DROP TABLE IF EXISTS `categories__attributes`;
CREATE TABLE IF NOT EXISTS `categories__attributes` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` bigint(20) NOT NULL,
  `attribute_id` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `categories__attributes_category_id_foreign` (`category_id`),
  KEY `categories__attributes_attribute_id_foreign` (`attribute_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=MyISAM AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_08_19_000000_create_failed_jobs_table', 1),
(3, '2020_08_08_001139_create_products_table', 1),
(4, '2020_08_09_022717_create_categories_table', 2),
(5, '2020_08_09_022738_create_attributes_table', 2),
(6, '2020_08_09_022824_create_variations_table', 2),
(7, '2020_08_09_022911_create_variation_attributes_table', 2),
(8, '2020_08_09_024007_create_category_attributes_table', 3),
(9, '2020_08_09_030451_categoriesv2', 4),
(10, '2020_08_09_030547_categoriesv3', 5),
(11, '2020_08_09_030637_productsv2', 6),
(12, '2020_08_09_031154_attributesv2', 7),
(13, '2020_08_09_031229_variations2', 8),
(14, '2020_08_09_233011_categoriesv4', 9),
(15, '2020_08_10_002130_create_categories__attributes_table', 10),
(16, '2020_08_10_002447_attributes3', 11),
(17, '2020_08_10_002504_attributes4', 12),
(18, '2020_08_10_004000_variation_attributes2', 13),
(19, '2020_08_10_004318_variation_attributes3', 14),
(20, '2020_08_10_004948_productv5', 15),
(21, '2020_08_10_014147_categories5', 16),
(22, '2020_08_11_055415_attributes5', 17),
(23, '2020_08_12_023321_variation_attributes6', 18),
(24, '2020_08_13_225537_product_attribute1', 19),
(25, '2020_08_13_230059_product_attribute2', 20),
(26, '2020_08_13_230221_product_attribute3', 21),
(27, '2020_08_13_231300_attribute_product', 22),
(28, '2014_10_12_100000_create_password_resets_table', 23),
(29, '2020_09_07_013812_productv8', 23),
(30, '2020_09_07_014015_productv9', 23),
(31, '2020_09_07_014435_productsv10', 24),
(32, '2020_09_07_014457_productsv11', 24),
(33, '2020_09_08_043840_ordersv0', 25),
(34, '2020_09_08_044610_order_productsv0', 26),
(35, '2020_09_08_173728_ordersv1', 27),
(36, '2020_09_08_174354_order_productsv1', 28);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `total` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `total`, `created_at`, `updated_at`) VALUES
(1, 520, '2020-09-08 15:40:08', '2020-09-08 15:40:08'),
(2, 520, '2020-09-08 15:40:27', '2020-09-08 15:40:27'),
(3, 520, '2020-09-08 15:44:49', '2020-09-08 15:44:49'),
(4, 520, '2020-09-08 15:45:03', '2020-09-08 15:45:03'),
(5, 520, '2020-09-08 15:46:05', '2020-09-08 15:46:05'),
(6, 2520, '2020-09-08 15:46:26', '2020-09-08 15:46:26'),
(7, 2520, '2020-09-08 15:46:44', '2020-09-08 15:46:44'),
(8, 2520, '2020-09-08 15:47:35', '2020-09-08 15:47:35'),
(9, 2520, '2020-09-08 15:47:46', '2020-09-08 15:47:46'),
(10, 520, '2020-09-08 15:55:56', '2020-09-08 15:55:56'),
(11, 2520, '2020-09-08 15:56:16', '2020-09-08 15:56:16'),
(12, 5520, '2020-09-08 15:56:28', '2020-09-08 15:56:28'),
(13, 5520, '2020-09-08 15:56:52', '2020-09-08 15:56:52'),
(14, 1500, '2020-09-08 16:24:02', '2020-09-08 16:24:02'),
(15, 6000, '2020-09-08 17:03:14', '2020-09-08 17:03:14');

-- --------------------------------------------------------

--
-- Table structure for table `order_products`
--

DROP TABLE IF EXISTS `order_products`;
CREATE TABLE IF NOT EXISTS `order_products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) NOT NULL,
  `order_id` bigint(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_products`
--

INSERT INTO `order_products` (`id`, `product_id`, `order_id`, `quantity`, `subtotal`, `created_at`, `updated_at`) VALUES
(34, 26, 15, 3, 6000, '2020-09-08 17:03:14', '2020-09-08 17:03:14'),
(33, 18, 14, 1, 1500, '2020-09-08 16:24:02', '2020-09-08 16:24:02'),
(32, 18, 13, 2, 3000, '2020-09-08 15:56:52', '2020-09-08 15:56:52'),
(31, 26, 13, 1, 2000, '2020-09-08 15:56:52', '2020-09-08 15:56:52'),
(30, 40, 13, 1, 520, '2020-09-08 15:56:52', '2020-09-08 15:56:52');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`(250))
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` double NOT NULL DEFAULT 0,
  `category_id` bigint(20) DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `description`, `price`, `category_id`, `image`, `created_at`, `updated_at`) VALUES
(18, 'Adidas', 'test', 1500, 3, '1599496279.jpeg', '2020-08-12 01:18:40', '2020-08-12 01:18:40'),
(19, 'Nike', 'test', 1200, 3, '1599496270.jpg', '2020-08-12 01:18:48', '2020-08-12 01:18:48'),
(26, 'Reebok', 'Reebok', 2000, 3, '1599496236.jpg', '2020-08-16 23:54:00', '2020-08-16 23:54:00'),
(40, 'Black Bag', 'bbaagg', 520, 18, '1599537890.jpg', '2020-09-08 02:04:50', '2020-09-08 02:04:50');

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
CREATE TABLE IF NOT EXISTS `test` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `testttt` text DEFAULT NULL,
  `product_id` bigint(20) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `test_fore` (`product_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `testttt`, `product_id`) VALUES
(54, '545g', 24);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`) USING HASH
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `variations`
--

DROP TABLE IF EXISTS `variations`;
CREATE TABLE IF NOT EXISTS `variations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(20) NOT NULL,
  `quantity` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `variations_product_id_foreign` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `variations`
--

INSERT INTO `variations` (`id`, `product_id`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(2, 17, 100, 10, '2020-08-12 01:18:24', '2020-08-12 01:18:24'),
(3, 18, 100, 10, '2020-08-12 01:18:40', '2020-08-12 01:18:40'),
(4, 18, 150, 15, '2020-08-12 01:18:40', '2020-08-12 01:18:40'),
(7, 20, 1550, 120, '2020-08-12 01:26:12', '2020-08-12 01:26:12'),
(8, 21, 1550, 120, '2020-08-12 01:26:29', '2020-08-12 01:26:29'),
(9, 21, 1700, 2, '2020-08-12 01:26:29', '2020-08-12 01:26:29'),
(10, 22, 1550, 100, '2020-08-12 02:47:49', '2020-08-12 02:47:49'),
(11, 22, 1700, 15, '2020-08-12 02:47:49', '2020-08-12 02:47:49'),
(12, 23, 1550, 10, '2020-08-12 02:50:15', '2020-08-12 02:50:15'),
(13, 23, 1700, 18, '2020-08-12 02:50:15', '2020-08-12 02:50:15'),
(14, 24, 185, 15, '2020-08-13 00:03:41', '2020-08-14 02:58:19'),
(15, 24, 200, 166, '2020-08-13 00:03:41', '2020-08-14 03:24:42'),
(20, 24, 23, 1, '2020-08-14 04:06:22', '2020-08-14 04:06:22'),
(21, 24, 5454, 454, '2020-08-14 04:15:54', '2020-08-14 04:15:54'),
(22, 24, 21233, 2121, '2020-08-14 04:16:32', '2020-08-14 04:16:37'),
(42, 26, 120, 100, '2020-08-17 00:50:13', '2020-08-17 00:51:58'),
(43, 26, 32, 125, '2020-08-17 00:50:13', '2020-08-17 00:51:58'),
(46, 26, 10, 663, '2020-08-17 00:51:27', '2020-08-17 00:51:58'),
(47, 29, 121, 110, '2020-08-17 00:54:53', '2020-08-17 00:54:53'),
(48, 29, 34, 343, '2020-08-17 00:54:53', '2020-08-17 00:54:53'),
(49, 30, 234233333333333, 423, '2020-08-17 00:55:43', '2020-08-17 00:55:43'),
(50, 31, 345, 45345, '2020-08-17 00:59:20', '2020-08-17 00:59:20'),
(51, 33, 4234234, 423423, '2020-08-17 01:02:56', '2020-08-17 01:02:56'),
(52, 33, 55, 34534, '2020-08-17 01:03:09', '2020-08-17 01:03:09');

-- --------------------------------------------------------

--
-- Table structure for table `variation_attributes`
--

DROP TABLE IF EXISTS `variation_attributes`;
CREATE TABLE IF NOT EXISTS `variation_attributes` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `variation_id` bigint(20) NOT NULL,
  `attribute_id` bigint(20) NOT NULL,
  `value` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `variation_attributes_variation_id_foreign` (`variation_id`),
  KEY `variation_attributes_attribute_id_foreign` (`attribute_id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `variation_attributes`
--

INSERT INTO `variation_attributes` (`id`, `variation_id`, `attribute_id`, `value`, `created_at`, `updated_at`) VALUES
(1, 8, 1, 'Black', '2020-08-12 01:26:29', '2020-08-14 03:24:42'),
(2, 8, 2, '42', '2020-08-12 01:26:29', '2020-08-14 03:24:42'),
(3, 9, 1, 'Black', '2020-08-12 01:26:29', '2020-08-12 01:26:29'),
(4, 9, 2, '48', '2020-08-12 01:26:29', '2020-08-12 01:26:29'),
(5, 10, 1, 'White', '2020-08-12 02:47:49', '2020-08-12 02:47:49'),
(6, 10, 2, '45', '2020-08-12 02:47:49', '2020-08-12 02:47:49'),
(7, 11, 1, 'Black', '2020-08-12 02:47:49', '2020-08-12 02:47:49'),
(8, 11, 2, '44', '2020-08-12 02:47:49', '2020-08-12 02:47:49'),
(9, 12, 1, 'White', '2020-08-12 02:50:15', '2020-08-12 02:50:15'),
(10, 12, 2, '44', '2020-08-12 02:50:15', '2020-08-12 02:50:15'),
(11, 13, 1, 'Black', '2020-08-12 02:50:15', '2020-08-12 02:50:15'),
(12, 13, 2, '42', '2020-08-12 02:50:15', '2020-08-12 02:50:15'),
(13, 14, 2, '45ff', '2020-08-13 00:03:41', '2020-08-14 03:37:41'),
(14, 14, 1, 'whitee', '2020-08-13 00:03:41', '2020-08-14 03:37:49'),
(15, 15, 2, '42', '2020-08-13 00:03:41', '2020-08-13 00:03:41'),
(16, 15, 1, 'Black', '2020-08-13 00:03:41', '2020-08-13 00:03:41'),
(17, 18, 1, 'purple', '2020-08-14 04:00:25', '2020-08-14 04:00:25'),
(21, 20, 2, 'news', '2020-08-14 04:06:22', '2020-08-14 04:06:22'),
(20, 20, 1, 'newc', '2020-08-14 04:06:22', '2020-08-14 04:06:22'),
(22, 21, 1, 'sdsds', '2020-08-14 04:15:54', '2020-08-14 04:15:54'),
(23, 21, 2, 'dsds', '2020-08-14 04:15:54', '2020-08-14 04:15:54'),
(24, 22, 1, 'sadsa', '2020-08-14 04:16:32', '2020-08-14 04:16:32'),
(25, 22, 2, 'dasd', '2020-08-14 04:16:32', '2020-08-14 04:16:32'),
(54, 47, 2, '120', '2020-08-17 00:54:53', '2020-08-17 00:54:53'),
(46, 43, 2, '555', '2020-08-17 00:50:13', '2020-08-17 00:51:58'),
(45, 43, 1, 'Blackyy', '2020-08-17 00:50:13', '2020-08-17 00:51:58'),
(43, 42, 1, 'whoteyy', '2020-08-17 00:50:13', '2020-08-17 00:51:58'),
(44, 42, 2, '4555', '2020-08-17 00:50:13', '2020-08-17 00:51:58'),
(52, 46, 2, '44', '2020-08-17 00:51:27', '2020-08-17 00:51:58'),
(53, 47, 1, 'frany', '2020-08-17 00:54:53', '2020-08-17 00:54:53'),
(51, 46, 1, 'grayyy', '2020-08-17 00:51:27', '2020-08-17 00:51:58'),
(55, 48, 1, '5', '2020-08-17 00:54:53', '2020-08-17 00:54:53'),
(56, 48, 2, '434', '2020-08-17 00:54:53', '2020-08-17 00:54:53'),
(57, 49, 1, '324234', '2020-08-17 00:55:43', '2020-08-17 00:55:43'),
(58, 49, 2, '23423', '2020-08-17 00:55:43', '2020-08-17 00:55:43'),
(59, 49, 3, '423423', '2020-08-17 00:55:43', '2020-08-17 00:55:43'),
(60, 50, 1, '3453', '2020-08-17 00:59:20', '2020-08-17 00:59:20'),
(61, 50, 2, '45345', '2020-08-17 00:59:20', '2020-08-17 00:59:20'),
(62, 50, 3, '3453', '2020-08-17 00:59:20', '2020-08-17 00:59:20'),
(63, 51, 1, '23423', '2020-08-17 01:02:56', '2020-08-17 01:02:56'),
(64, 51, 2, '4234', '2020-08-17 01:02:56', '2020-08-17 01:02:56'),
(65, 51, 3, '23423', '2020-08-17 01:02:56', '2020-08-17 01:02:56'),
(66, 52, 1, '345345', '2020-08-17 01:03:09', '2020-08-17 01:03:09'),
(67, 52, 2, '5345', '2020-08-17 01:03:09', '2020-08-17 01:03:09'),
(68, 52, 3, '34534', '2020-08-17 01:03:09', '2020-08-17 01:03:09');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
