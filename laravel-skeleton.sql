-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 26, 2018 at 07:52 AM
-- Server version: 5.7.21
-- PHP Version: 7.0.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel-skeleton`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE IF NOT EXISTS `admin_users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '0bc7e46bf25c50bff4906e0610a880b9', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('jpeg','png','jpg','svg','gif','pdf','doc','docx','rtf') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `name`, `alt`, `type`, `created_at`, `updated_at`) VALUES
(4, 'pdf-sample.pdf', 'Pdf sample', 'pdf', '2018-11-21 06:50:58', '2018-11-21 06:50:58'),
(5, 'how-to-become-dentacoin-dentist.jpg', 'How to become dentacoin dentist', 'jpg', '2018-11-26 05:44:25', '2018-11-26 05:44:25');

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `menus_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Header', 'header', NULL, NULL),
(2, 'Footer', 'footer', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `menu_elements`
--

DROP TABLE IF EXISTS `menu_elements`;
CREATE TABLE IF NOT EXISTS `menu_elements` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` enum('page','file') COLLATE utf8mb4_unicode_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_id` int(11) NOT NULL,
  `new_window` tinyint(4) NOT NULL,
  `id_attribute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_attribute` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `media_id` int(10) UNSIGNED DEFAULT NULL,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_elements_media_id_foreign` (`media_id`),
  KEY `menu_elements_menu_id_foreign` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `menu_elements`
--

INSERT INTO `menu_elements` (`id`, `name`, `type`, `url`, `order_id`, `new_window`, `id_attribute`, `class_attribute`, `media_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(3, 'Dentacoin Corporate Identity: What We Stand For', 'file', 'http://laravel-skeleton.test/assets/uploads/pdf-sample.pdf', 0, 0, 'test-id', 'test-class', NULL, 2, '2018-11-21 06:57:44', '2018-11-21 06:58:00'),
(29, 'Element 1', 'page', 'https://reviews.dentacoin.com/', 0, 1, 'test-id', 'test-class', NULL, 1, '2018-11-26 05:42:44', '2018-11-26 05:43:04'),
(30, 'Element 2', 'page', 'https://reviews.dentacoin.com/', 1, 1, 'test-id', 'test-class', NULL, 1, '2018-11-26 05:43:20', '2018-11-26 05:43:20'),
(31, 'Element 3', 'page', 'https://reviews.dentacoin.com/', 2, 0, 'test-id', 'test-class', NULL, 1, '2018-11-26 05:43:40', '2018-11-26 05:43:40');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2018_07_22_162209_create_admin_users_table', 1),
(2, '2018_08_17_120730_media_table', 1),
(3, '2018_09_09_135739_create_pages_table', 1),
(4, '2018_09_10_085822_create_pages_html_sections_table', 1),
(5, '2018_09_16_135115_create_menus_table', 1),
(6, '2018_09_17_073937_create_menu_elements_table', 2),
(7, '2018_09_16_135116_create_menus_table', 3),
(8, '2018_09_17_073938_create_menu_elements_table', 3),
(9, '2018_09_16_135117_create_menus_table', 4),
(10, '2018_09_17_073939_create_menu_elements_table', 4),
(11, '2018_09_17_073940_create_menu_elements_table', 5),
(12, '2018_09_17_073941_create_menu_elements_table', 6),
(13, '2018_09_17_073942_create_menu_elements_table', 7);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `social_description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `media_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_media_id_foreign` (`media_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `title`, `description`, `keywords`, `social_title`, `social_description`, `media_id`, `created_at`, `updated_at`) VALUES
(1, 'home', 'Homepage', 'Homepage', 'Homepage', 'Homepage', 'Homepage', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `pages_html_sections`
--

DROP TABLE IF EXISTS `pages_html_sections`;
CREATE TABLE IF NOT EXISTS `pages_html_sections` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `page_id` int(10) UNSIGNED DEFAULT NULL,
  `html` text COLLATE utf8mb4_unicode_ci,
  `css` text COLLATE utf8mb4_unicode_ci,
  `order_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pages_html_sections_page_id_foreign` (`page_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages_html_sections`
--

INSERT INTO `pages_html_sections` (`id`, `page_id`, `html`, `css`, `order_id`, `created_at`, `updated_at`) VALUES
(1, 1, '<p>asdasd</p>\r\n\r\n<p><img alt=\"How to become dentacoin dentist\" class=\"small-image\" src=\"http://laravel-skeleton.test/assets/uploads/how-to-become-dentacoin-dentist.jpg\" />asdsad</p>\r\n\r\n<p><a href=\"http://laravel-skeleton.test/assets/uploads/pdf-sample.pdf\">http://laravel-skeleton.test/assets/uploads/pdf-sample.pdf</a></p>', 'asdasd', 0, NULL, '2018-11-26 05:48:57');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `menu_elements`
--
ALTER TABLE `menu_elements`
  ADD CONSTRAINT `menu_elements_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `menu_elements_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `pages_media_id_foreign` FOREIGN KEY (`media_id`) REFERENCES `media` (`id`);

--
-- Constraints for table `pages_html_sections`
--
ALTER TABLE `pages_html_sections`
  ADD CONSTRAINT `pages_html_sections_page_id_foreign` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
