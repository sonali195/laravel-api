-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2025 at 08:33 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `carva_e_hind`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@laravel11.com', '$2y$12$KRLi37u0l9eJwhgo.l/IfuqPfj2AWd7DxcuHBfYF4s.vdl9rDK9/m', '2025-04-10 23:09:44', NULL, '2025-04-10 23:09:44', '2025-04-10 23:09:44');

-- --------------------------------------------------------

--
-- Table structure for table `assistance`
--

CREATE TABLE `assistance` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assistance_type` tinyint(4) DEFAULT NULL,
  `full_name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(255) DEFAULT NULL,
  `description` blob DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assistance`
--

INSERT INTO `assistance` (`id`, `assistance_type`, `full_name`, `contact_number`, `description`, `image`, `created_at`, `updated_at`, `deleted_at`) VALUES
(65, 1, 'Sonali Prajapati', '2343234323', 0x746573747474, NULL, '2025-05-04 23:51:03', '2025-05-04 23:51:03', NULL),
(66, 1, 'Sonali Prajapati', '6534543423', 0x35747472, NULL, '2025-05-04 23:52:56', '2025-05-04 23:52:56', NULL),
(67, 1, 'Sonali Prajapati', '4323123243', 0x7274727472, NULL, '2025-05-04 23:54:42', '2025-05-04 23:54:42', NULL),
(68, 1, 'Sonali Prajapati', 'ewqwewqwew', 0x64666466, NULL, '2025-05-04 23:57:51', '2025-05-04 23:57:51', NULL),
(69, 3, 'Sonali Prajapati', '4334234323', 0x68656c6c6f, 'Img-2025050505554725.png', '2025-05-05 00:25:48', '2025-05-05 00:25:48', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ayat_quran`
--

CREATE TABLE `ayat_quran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `surah_id` bigint(20) UNSIGNED NOT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `title_translation` varchar(255) DEFAULT NULL,
  `title_transliteration` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ayat_quran`
--

INSERT INTO `ayat_quran` (`id`, `surah_id`, `title_ar`, `title_translation`, `title_transliteration`, `created_at`, `updated_at`, `deleted_at`) VALUES
(4, 2, 'بِسۡمِ ٱللَّهِ ٱلرَّحۡمَٰنِ ٱلرَّحِيمِ', 'In the name of Allah, the Beneficent, the Merciful.', '<p>BISMILLAAHIR RAHMAANIR RAHEEM</p>', '2025-04-16 03:06:49', '2025-04-24 03:50:29', NULL),
(5, 1, 'ٱلۡحَمۡدُ لِلَّهِ رَبِّ ٱلۡعَٰلَمِينَ', 'All praise is due to Allah, the Lord of the Worlds.', '<p>ALHAMDU LILLAAHI RABBIL &#39;AALAMEEN</p>', '2025-04-16 03:08:47', '2025-04-16 03:08:47', NULL),
(6, 1, 'ٱلرَّحۡمَٰنِ ٱلرَّحِيمِ', 'The Beneficent, the Merciful.', '<p>AR-RAHMAANIR-RAHEEM</p>', '2025-04-16 03:09:06', '2025-04-16 03:09:06', NULL),
(7, 1, 'مَٰلِكِ يَوۡمِ ٱلدِّينِ', 'Master of the Day of Judgement.', '<p>MAALIKI YAWMID-DEEN</p>', '2025-04-16 03:09:25', '2025-04-16 03:09:25', NULL),
(8, 1, 'إِيَّاكَ نَعۡبُدُ وَإِيَّاكَ نَسۡتَعِينُ', 'Thee do we serve and Thee do we beseech for help.', '<p>IYYAAKA NA&#39;BUDU WA IYYAAKA NASTA&#39;EEN</p>', '2025-04-16 03:09:40', '2025-04-16 03:09:40', NULL),
(9, 1, 'رَٰطَ ٱلَّذِينَ أَنۡعَمۡتَ عَلَيۡهِمۡ غَيۡرِ ٱلۡمَغۡضُوبِ عَلَيۡهِمۡ وَلَا ٱلضَّآلِّينَ', 'The path of those upon whom Thou hast bestowed favors. Not (the path) of those upon whom Thy wrath is brought down, nor of those who go astray.', 'SIRAATAL-LAZEENA AN&#39;AMTA &#39;ALAIHIM GHAYRIL-MAGHDOOBI &#39;ALAIHIM WA LAD-DAAALLEEN', '2025-04-16 03:10:10', '2025-04-16 03:31:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` blob DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `slug` text DEFAULT NULL,
  `time_spend` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cms_pages`
--

CREATE TABLE `cms_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `page_name` varchar(255) DEFAULT NULL,
  `contents` blob DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `short_code` varchar(10) DEFAULT NULL,
  `isd_code` varchar(10) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  `currency` varchar(50) DEFAULT NULL,
  `currency_symbol` varchar(10) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1 - Yes, 0 - No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `short_code`, `isd_code`, `flag`, `currency`, `currency_symbol`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Afghanistan', 'af', '+93', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(2, 'Albania', 'al', '+355', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(3, 'Algeria', 'dz', '+213', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(4, 'American Samoa', 'AS', '+1684', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(5, 'Andorra', 'ad', '+376', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(6, 'Angola', 'ao', '+244', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(7, 'Anguilla', 'ai', '+1264', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(8, 'Antarctica', 'AQ', '+672', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(9, 'Antigua And Barbuda', 'ag', '+1268', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(10, 'Argentina', 'ar', '+54', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(11, 'Armenia', 'am', '+374', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(12, 'Aruba', 'aw', '+297', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(13, 'Australia', 'au', '+61', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(14, 'Austria', 'at', '+43', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(15, 'Azerbaijan', 'az', '+994', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(16, 'Bahamas The', 'bs', '+1242', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(17, 'Bahrain', 'bh', '+973', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(18, 'Bangladesh', 'bd', '+880', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(19, 'Barbados', 'bb', '+1246', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(20, 'Belarus', 'by', '+375', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(21, 'Belgium', 'be', '+32', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(22, 'Belize', 'bz', '+501', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(23, 'Benin', 'bj', '+229', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(24, 'Bermuda', 'bm', '+1441', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(25, 'Bhutan', 'bt', '+975', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(26, 'Bolivia', 'bo', '+591', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(27, 'Bosnia and Herzegovina', 'ba', '+387', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(28, 'Botswana', 'bw', '+267', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(29, 'Bouvet Island', 'BV', '+47', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(30, 'Brazil', 'br', '+55', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(31, 'British Indian Ocean Territory', 'IO', '+246', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(32, 'Brunei', 'bn', '+673', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(33, 'Bulgaria', 'bg', '+359', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(34, 'Burkina Faso', 'bf', '+226', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(35, 'Burundi', 'bi', '+257', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(36, 'Cambodia', 'kh', '+855', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(37, 'Cameroon', 'cm', '+237', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(38, 'Canada', 'ca', '+1', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(39, 'Cape Verde', 'cv', '+238', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(40, 'Cayman Islands', 'ky', '+1345', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(41, 'Central African Republic', 'cf', '+236', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(42, 'Chad', 'td', '+235', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(43, 'Chile', 'cl', '+56', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(44, 'China', 'cn', '+86', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(45, 'Christmas Island', 'cx', '+61', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(46, 'Cocos (Keeling) Islands', 'cc', '+61', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(47, 'Colombia', 'co', '+57', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(48, 'Comoros', 'km', '+269', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(49, 'Republic Of The Congo', 'CG', '+242', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(50, 'Democratic Republic Of The Congo', 'CD', '+242', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(51, 'Cook Islands', 'ck', '+682', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(52, 'Costa Rica', 'cr', '+506', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(53, 'Cote D\'Ivoire (Ivory Coast)', 'ci', '+225', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(54, 'Croatia (Hrvatska)', 'hr', '+385', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(55, 'Cuba', 'cu', '+53', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(56, 'Cyprus', 'cy', '+357', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(57, 'Czech Republic', 'cz', '+420', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(58, 'Denmark', 'dk', '+45', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(59, 'Djibouti', 'dj', '+253', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(60, 'Dominica', 'dm', '+1767', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(61, 'Dominican Republic', 'do', '+1809', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(62, 'East Timor', 'TP', '+670', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(63, 'Ecuador', 'ec', '+593', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(64, 'Egypt', 'eg', '+20', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(65, 'El Salvador', 'sv', '+503', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(66, 'Equatorial Guinea', 'gq', '+240', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(67, 'Eritrea', 'er', '+291', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(68, 'Estonia', 'ee', '+372', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(69, 'Ethiopia', 'et', '+251', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(71, 'Falkland Islands', 'fk', '+500', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(72, 'Faroe Islands', 'fo', '+298', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(73, 'Fiji Islands', 'fj', '+679', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(74, 'Finland', 'fi', '+358', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(75, 'France', 'fr', '+33', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(76, 'French Guiana', 'gf', '+594', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(77, 'French Polynesia', 'pf', '+689', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(78, 'French Southern Territories', 'tf', '+1', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(79, 'Gabon', 'ga', '+241', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(80, 'Gambia', 'gm', '+220', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(81, 'Georgia', 'ge', '+995', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(82, 'Germany', 'de', '+49', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(83, 'Ghana', 'gh', '+233', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(84, 'Gibraltar', 'gi', '+350', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(85, 'Greece', 'gr', '+30', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(86, 'Greenland', 'gl', '+299', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(87, 'Grenada', 'gd', '+1473', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(88, 'Guadeloupe', 'gp', '+590', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(89, 'Guam', 'GU', '+1671', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(90, 'Guatemala', 'gt', '+502', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(91, 'Guernsey and Alderney', 'GG', '+44', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(92, 'Guinea', 'gn', '+224', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(93, 'Guinea-Bissau', 'gw', '+245', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(94, 'Guyana', 'gy', '+592', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(95, 'Haiti', 'ht', '+509', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(96, 'Heard and McDonald Islands', 'HM', '+672', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(97, 'Honduras', 'hn', '+504', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(98, 'Hong Kong S.A.R.', 'hk', '+852', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(99, 'Hungary', 'hu', '+36', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(100, 'Iceland', 'is', '+354', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(101, 'India', 'in', '+91', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(102, 'Indonesia', 'id', '+62', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(103, 'Iran', 'ir', '+98', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(104, 'Iraq', 'iq', '+964', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(105, 'Ireland', 'ie', '+353', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(106, 'Israel', 'il', '+972', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(107, 'Italy', 'it', '+39', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(108, 'Jamaica', 'jm', '+1876', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(109, 'Japan', 'jp', '+81', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(110, 'Jersey', 'JE', '+44', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(111, 'Jordan', 'jo', '+962', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(112, 'Kazakhstan', 'kz', '+7', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(113, 'Kenya', 'ke', '+254', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(114, 'Kiribati', 'ki', '+686', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(115, 'Korea North', 'kp', '+850', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(116, 'Korea South', 'kr', '+82', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(117, 'Kuwait', 'kw', '+965', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(118, 'Kyrgyzstan', 'kg', '+996', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(119, 'Laos', 'la', '+856', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(120, 'Latvia', 'lv', '+371', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(121, 'Lebanon', 'lb', '+961', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(122, 'Lesotho', 'ls', '+266', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(123, 'Liberia', 'lr', '+231', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(124, 'Libya', 'ly', '+218', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(125, 'Liechtenstein', 'li', '+423', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(126, 'Lithuania', 'lt', '+370', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(127, 'Luxembourg', 'lu', '+352', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(128, 'Macau S.A.R.', 'mo', '+853', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(129, 'Macedonia', 'mk', '+389', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(130, 'Madagascar', 'mg', '+261', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(131, 'Malawi', 'mw', '+265', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(132, 'Malaysia', 'my', '+60', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(133, 'Maldives', 'mv', '+960', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(134, 'Mali', 'ml', '+223', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(135, 'Malta', 'mt', '+356', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(136, 'Isle of Man', 'IM', '+44', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(137, 'Marshall Islands', 'mh', '+692', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(138, 'Martinique', 'mq', '+596', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(139, 'Mauritania', 'mr', '+222', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(140, 'Mauritius', 'mu', '+230', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(141, 'Mayotte', 'yt', '+269', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(142, 'Mexico', 'mx', '+52', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(143, 'Micronesia', 'FM', '+691', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(144, 'Moldova', 'md', '+373', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(145, 'Monaco', 'mc', '+377', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(146, 'Mongolia', 'mn', '+976', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(147, 'Montserrat', 'ms', '+1664', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(148, 'Morocco', 'ma', '+212', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(149, 'Mozambique', 'mz', '+258', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(150, 'Myanmar', 'mm', '+95', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(151, 'Namibia', 'na', '+264', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(152, 'Nauru', 'nr', '+674', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(153, 'Nepal', 'np', '+977', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(154, 'Netherlands Antilles', 'an', '+599', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(155, 'Netherlands The', 'nl', '+31', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(156, 'New Caledonia', 'nc', '+687', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(157, 'New Zealand', 'nz', '+64', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(158, 'Nicaragua', 'ni', '+505', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(159, 'Niger', 'ne', '+227', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(160, 'Nigeria', 'ng', '+234', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(161, 'Niue', 'nu', '+683', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(162, 'Norfolk Island', 'nf', '+672', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(163, 'Northern Mariana Islands', 'mp', '+1670', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(164, 'Norway', 'no', '+47', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(165, 'Oman', 'om', '+968', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(166, 'Pakistan', 'pk', '+92', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(167, 'Palau', 'pw', '+680', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(168, 'Palestinian Territory Occupied', 'ps', '+970', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(169, 'Panama', 'pa', '+507', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(170, 'Papua new Guinea', 'pg', '+675', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(171, 'Paraguay', 'py', '+595', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(172, 'Peru', 'pe', '+51', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(173, 'Philippines', 'ph', '+63', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(174, 'Pitcairn Island', 'PN', '+64', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(175, 'Poland', 'pl', '+48', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(176, 'Portugal', 'pt', '+351', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(177, 'Puerto Rico', 'PR', '+1787', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(178, 'Qatar', 'qa', '+974', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(179, 'Reunion', 're', '+262', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(180, 'Romania', 'ro', '+40', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(181, 'Russia', 'ru', '+70', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(182, 'Rwanda', 'rw', '+250', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(183, 'Saint Helena', 'sh', '+290', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(184, 'Saint Kitts And Nevis', 'kn', '+1869', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(185, 'Saint Lucia', 'lc', '+1758', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(186, 'Saint Pierre and Miquelon', 'pm', '+508', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(187, 'Saint Vincent And The Grenadines', 'vc', '+1784', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(188, 'Samoa', 'ws', '+684', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(189, 'San Marino', 'sm', '+378', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(190, 'Sao Tome and Principe', 'st', '+239', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(191, 'Saudi Arabia', 'sa', '+966', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(192, 'Senegal', 'sn', '+221', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(193, 'Serbia', 'RS', '+381', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(194, 'Seychelles', 'sc', '+248', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(195, 'Sierra Leone', 'sl', '+232', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(196, 'Singapore', 'sg', '+65', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(197, 'Slovakia', 'sk', '+421', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(198, 'Slovenia', 'si', '+386', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(199, 'Smaller Territories of the UK', 'GB', '+44', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(200, 'Solomon Islands', 'sb', '+677', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(201, 'Somalia', 'so', '+252', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(202, 'South Africa', 'za', '+27', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(203, 'South Georgia', 'gs', '+500', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(204, 'South Sudan', 'SS', '+211', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(205, 'Spain', 'es', '+34', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(206, 'Sri Lanka', 'lk', '+94', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(207, 'Sudan', 'sd', '+249', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(208, 'Suriname', 'sr', '+597', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(209, 'Svalbard And Jan Mayen Islands', 'sj', '+47', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(210, 'Swaziland', 'sz', '+268', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(211, 'Sweden', 'se', '+46', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(212, 'Switzerland', 'ch', '+41', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(213, 'Syria', 'sy', '+963', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(214, 'Taiwan', 'tw', '+886', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(215, 'Tajikistan', 'tj', '+992', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(216, 'Tanzania', 'tz', '+255', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(217, 'Thailand', 'th', '+66', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(218, 'Togo', 'tg', '+228', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(219, 'Tokelau', 'tk', '+690', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(220, 'Tonga', 'to', '+676', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(221, 'Trinidad And Tobago', 'tt', '+1868', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(222, 'Tunisia', 'tn', '+216', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(223, 'Turkey', 'tr', '+90', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(224, 'Turkmenistan', 'tm', '+993', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(225, 'Turks And Caicos Islands', 'tc', '+1649', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(226, 'Tuvalu', 'tv', '+688', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(227, 'Uganda', 'ug', '+256', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(228, 'Ukraine', 'ua', '+380', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(229, 'United Arab Emirates', 'ae', '+971', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(230, 'United Kingdom', 'gb', '+44', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(231, 'United States', 'us', '+1', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(232, 'United States Minor Outlying Islands', 'UM', '+246', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(233, 'Uruguay', 'uy', '+598', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(234, 'Uzbekistan', 'uz', '+998', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(235, 'Vanuatu', 'vu', '+678', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(236, 'Vatican City State (Holy See)', 'VA', '+379', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(237, 'Venezuela', 've', '+58', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(238, 'Vietnam', 'vn', '+84', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(239, 'Virgin Islands (British)', 'vg', '+1284', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(240, 'Virgin Islands (US)', 'vi', '+1340', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(241, 'Wallis And Futuna Islands', 'wf', '+681', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(242, 'Western Sahara', 'eh', '+212', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(243, 'Yemen', 'ye', '+967', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(244, 'Yugoslavia', 'YU', '+38', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(245, 'Zambia', 'zm', '+260', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(246, 'Zimbabwe', 'zm', '+263', NULL, NULL, NULL, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `body` blob DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1-Yes,0-No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `title`, `subject`, `body`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Reset Password', 'Reset Password', 0x3c703e48656c6c6f207b757365725f6e616d657d2c3c2f703e0a2020202020202020202020203c703e596f752068617665207265636569766564207468697320656d61696c206265636175736520776520726563656976656420612070617373776f7264207265736574207265717565737420666f7220796f7572206163636f756e742e20506c6561736520636c69636b206f6e20746865206c696e6b2062656c6f7720746f20726573657420796f75722070617373776f72642e3c2f703e0a2020202020202020202020203c703e3c6120687265663d277b70617373776f72645f72657365745f6c696e6b7d273e436c69636b20486572653c2f613e3c2f703e0a2020202020202020202020203c703e546869732070617373776f7264207265736574206c696e6b2077696c6c2065787069726520696e207b6578706972795f74696d657d206d696e757465732e3c2f703e0a2020202020202020202020203c703e496620796f7520646964206e6f74207265717565737420612070617373776f72642072657365742c20706c656173652067657420696e20746f756368207769746820757320617420696e666f406578616d706c652e636f6d20616e642077652077696c6c20696e76657374696761746520667572746865722e3c2f703e203c703e5761726d20526567617264732c3c6272202f3e4c61726176656c203131205465616d3c2f703e, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44'),
(2, 'Reset password (User)', 'Reset Password', 0x3c703e48656c6c6f207b757365725f6e616d657d2c3c2f703e3c703e57652072656365697665642061207265717565737420746f207265736574207468652070617373776f726420666f7220796f7572204c61726176656c203131206163636f756e742e20546f2070726f636565642077697468207468652070617373776f72642072657365742c20706c65617365207573652074686520666f6c6c6f77696e6720766572696669636174696f6e20636f64653a3c2f703e3c703e3c7374726f6e673e566572696669636174696f6e20436f64653a3c2f7374726f6e673e207b636f64657d3c2f703e3c703e496620796f75206861766520616e79207175657374696f6e73206f7220636f6e6365726e732c20706c6561736520636f6e74616374206f757220737570706f7274207465616d20617420696e666f406578616d706c652e636f2e756b2e3c2f703e3c703e5468616e6b20796f7520666f722063686f6f73696e67204c61726176656c2031312e2057652076616c756520796f757220736563757269747920616e6420617265206865726520746f2068656c702e3c2f703e3c703e5761726d20526567617264732c3c6272202f3e4c61726176656c203131205465616d3c2f703e, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44'),
(3, 'Welcome mail', 'Welcome to Laravel 11!', 0x3c703e4869207b757365725f6e616d657d213c2f703e3c703e57656c636f6d6520746f204c61726176656c20313121205468616e6b7320736f206d75636820666f72206a6f696e696e672075732e3c2f703e3c703e4861766520616e79207175657374696f6e733f204a7573742073686f6f7420757320616e20656d61696c20617420696e666f406578616d706c652e636f2e756b212057652061726520616c77617973206865726520746f2068656c702e3c2f703e3c703e526567617264732c3c6272202f3e4c61726176656c203131205465616d3c2f703e, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44'),
(4, 'Account Activate (User)', 'Account Activated', 0x3c703e48656c6c6f207b757365725f6e616d657d2c3c2f703e3c703e596f7572206163636f756e7420686173206265656e206163746976617465642c204e6f7720796f752063616e206c6f67696e3c2f703e3c703e5468616e6b732c3c6272202f3e4c61726176656c203131205465616d3c2f703e, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44'),
(5, 'Account Suspended (User)', 'Account Suspended', 0x3c703e48656c6c6f207b757365725f6e616d657d2c3c2f703e3c703e596f7572206163636f756e742068617665206265656e2073757370656e646564206279204c61726176656c203131205465616d2e20466f72206d6f726520696e666f726d6174696f6e2c20706c6561736520636f6e7461637420757320617420696e666f406578616d706c652e636f2e756b3c2f703e3c703e5468616e6b732c3c6272202f3e4c61726176656c203131205465616d3c2f703e, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44'),
(6, 'Contact Enquiry', 'Enquiry', 0x3c703e48656c6c6f213c2f703e3c703e4e6577266e6273703b456e71756972793c2f703e3c703e4e616d653a207b6e616d657d3c6272202f3e456d61696c3a207b656d61696c7d3c6272202f3e4d6573736167653a207b6d6573736167657d3c2f703e3c703e5468616e6b732c3c6272202f3e4c61726176656c203131205465616d3c2f703e, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44'),
(7, 'User account created by admin (User)', 'Your Account is created on Laravel 11', 0x3c703e48656c6c6f213c2f703e3c703e57656c636f6d6520746f204c61726176656c2031312120576520617265206578636974656420746f20696e666f726d20796f75207468617420796f7572206163636f756e7420686173206265656e206372656174656420696e206f75722073797374656d2e3c2f703e3c703e3c6120687265663d227b61637469766174696f6e5f6c696e6b7d223e3c7374726f6e673e436c69636b20686572653c2f7374726f6e673e3c2f613e266e6273703b746f2073657420757020796f7572206163636f756e742070617373776f72642e3c2f703e3c703e496620796f75206861766520616e79207175657374696f6e73206f7220636f6e6365726e732c20706c6561736520636f6e74616374206f757220737570706f7274207465616d20617420696e666f406578616d706c652e636f2e756b2e3c2f703e3c703e5468616e6b20796f7520666f722063686f6f73696e67204c61726176656c2031312e205765206170707265636961746520796f75722074727573742c20616e64207765277265206578636974656420746f206861766520796f752061732070617274206f66206f757220636f6d6d756e6974792e3c2f703e3c703e4265737420726567617264732c3c6272202f3e4c61726176656c203131205465616d3c2f703e, 1, '2025-04-10 23:09:44', '2025-04-10 23:09:44');

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
-- Table structure for table `faqs`
--

CREATE TABLE `faqs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question` text DEFAULT NULL,
  `answer` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `live_program`
--

CREATE TABLE `live_program` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `duration` varchar(255) NOT NULL,
  `video_url` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `live_program`
--

INSERT INTO `live_program` (`id`, `title`, `event_date`, `start_time`, `duration`, `video_url`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Maulana Ali Raza Rizvi', '2025-04-14', '13:07:00', '170min', 'https://www.youtube.com/watch?v=A9TWPBXi1aA', '2025-04-11 07:11:24', '2025-04-14 02:46:58', NULL),
(2, 'Maulana Asif Raza Alvi', '2025-04-18', '17:39:00', '45min', 'https://www.youtube.com/watch?v=pmwM5M3ivi0', '2025-04-17 04:38:16', '2025-04-17 04:38:16', NULL),
(3, 'Maulana Asif Raza Alvidfd', '2025-04-21', '15:02:00', '55min', 'https://www.youtube.com/watch?v=pmwM5M3ivi0', '2025-04-17 04:38:46', '2025-04-21 03:59:27', NULL);

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2020_08_08_063902_create_admins_table', 1),
(5, '2020_08_08_093112_create_email_templates_table', 1),
(6, '2020_08_24_131711_create_blogs_table', 1),
(7, '2020_10_10_120258_create_faq_table', 1),
(8, '2020_10_10_124431_create_countries_table', 1),
(9, '2020_10_10_124439_create_categories_table', 1),
(10, '2020_10_18_095707_create_cms_pages_table', 1),
(11, '2020_10_19_055114_create_settings_table', 1),
(12, '2020_10_19_055630_create_user_login_devices_table', 1),
(13, '2020_10_19_061000_create_notifications_table', 1),
(14, '2020_10_19_061134_create_notification_receivers_table', 1),
(15, '2020_10_19_143106_create_contacts_table', 1),
(16, '2024_12_11_122543_create_personal_access_tokens_table', 1),
(17, '2025_04_10_131327_create_travelguide_table', 1),
(18, '2025_04_10_131327_create_travelguides_table', 2),
(19, '2025_04_10_131327_create_travel_guides_table', 3),
(20, '2025_04_11_093807_create_events_table', 4),
(21, '2025_04_11_093807_create_schedule_table', 5),
(22, '2025_04_11_121751_create_live_program_table', 6),
(23, '2025_04_14_060745_near_by_facilities_table', 7),
(24, '2025_04_14_103234_create_volunteer_registration_table', 8),
(25, '2025_04_14_132134_create_assistance_table', 9),
(26, '2025_04_15_114337_create_surahs_quran_table', 10),
(27, '2025_04_15_114442_create_ayats_quran_table', 11),
(28, '2025_04_15_114337_create_surahs_table', 12),
(29, '2025_04_15_114442_create_ayats_table', 12),
(30, '2025_04_15_131707_create_surahs_quran_table', 13),
(31, '2025_04_16_060846_create_ayats_table', 14),
(32, '2025_04_16_060846_create_ayats_quran_table', 15),
(33, '2025_04_16_060846_create_ayat_quran_table', 16);

-- --------------------------------------------------------

--
-- Table structure for table `near_by_facilities`
--

CREATE TABLE `near_by_facilities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` blob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `near_by_facilities`
--

INSERT INTO `near_by_facilities` (`id`, `title`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Medical Services update 123', 0x3c703e3c7374726f6e673e47656e6572616c20436865636b2d5570733a203c2f7374726f6e673e50696c6772696d732063616e207265636569766520726f7574696e65206d65646963616c206576616c756174696f6e7320746f20656e73757265207468656972206865616c746820697320696e20676f6f6420636f6e646974696f6e20647572696e6720746865206a6f75726e65792075706461746565652e3c2f703e, '2025-04-14 01:27:35', '2025-04-14 02:10:34', NULL),
(2, 'second', 0x3c703e3c7374726f6e673e4d65646963696e657320616e6420507265736372697074696f6e733a3c2f7374726f6e673e20412077656c6c2d73746f636b656420737570706c79206f66206d65646963696e657320656e73757265732074686174207a61776172207265636569766520746865206d656469636174696f6e732074686579206e6565642070726f6d70746c792e3c2f703e, '2025-04-14 02:06:49', '2025-04-14 02:08:52', '2025-04-14 02:08:52'),
(3, 'Medicines and Prescriptions up', 0x4d65646963696e657320616e6420507265736372697074696f6e733a20412077656c6c2d73746f636b656420737570706c79206f66206d65646963696e657320656e73757265732074686174207a61776172207265636569766520746865206d656469636174696f6e732074686579206e6565642070726f6d70746c792e, '2025-04-17 02:11:57', '2025-04-17 02:12:05', NULL),
(4, 'Dental Check-Up', 0x44656e74616c20436865636b2d5570733a204f72616c206865616c7468206973206e6f74206f7665726c6f6f6b65642c20776974682064656e74616c2070726f66657373696f6e616c732070726f766964696e67206361726520666f7220636f6d6d6f6e2064656e74616c206973737565732e, '2025-04-17 02:12:18', '2025-04-17 02:12:18', NULL),
(5, 'Saline Infusions', 0x466f722074686f736520737566666572696e672066726f6d206465687964726174696f6e206f722065786861757374696f6e2c2073616c696e65206472697073206172652061646d696e6973746572656420746f20726573746f726520766974616c6974792e, '2025-04-17 02:12:39', '2025-04-17 02:12:39', NULL),
(6, 'Wound Care', 0x437574732c20626c6973746572732c20616e64206f7468657220696e6a7572696573207375737461696e656420647572696e6720746865206a6f75726e6579206172652074726561746564207769746820636172652c2070726576656e74696e6720696e66656374696f6e7320616e6420656e737572696e67207377696674207265636f766572792e, '2025-04-17 02:12:54', '2025-04-17 02:12:54', NULL),
(7, 'Emergency Care', 0x546865206d6f6b696220697320657175697070656420746f2068616e646c65206d65646963616c20656d657267656e636965732c2070726f766964696e6720696d6d65646961746520617373697374616e636520746f2070696c6772696d7320696e20637269746963616c20636f6e646974696f6e732e, '2025-04-17 02:13:19', '2025-04-17 02:13:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(4) DEFAULT NULL COMMENT '1- admin message',
  `title` varchar(255) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'user table id',
  `redirect_on` bigint(20) DEFAULT NULL COMMENT 'redirect table id',
  `others` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_receivers`
--

CREATE TABLE `notification_receivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL COMMENT 'notification table id',
  `receiver_id` bigint(20) UNSIGNED NOT NULL COMMENT 'user table id',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0 - Unread, 1 - Read',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(1, 'App\\Models\\User', 2, 'Carva E Hind', 'e08cb457dcf23c2f59332100c05be51e8793bceb13ef5c21f2d1361c4d18d7ba', '[\"*\"]', '2025-04-18 01:01:17', NULL, '2025-04-14 03:29:19', '2025-04-18 01:01:17');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `role_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2025-04-10 23:09:43', '2025-04-10 23:09:43'),
(2, 'User', '2025-04-10 23:09:43', '2025-04-10 23:09:43');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`id`, `title`, `category`, `event_date`, `start_time`, `end_time`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Recite with Nauhakhwan Sonu Monu', '2', '2025-04-19', '18:19:00', '20:19:00', '2025-04-11 05:16:15', '2025-04-17 01:04:38', NULL),
(2, 'Recite with Nauhakhwan Sonu Monu', '1', '2025-04-19', '16:25:00', '21:30:00', '2025-04-11 05:26:34', '2025-04-17 01:04:31', '2025-04-17 01:04:31'),
(5, 'Recite with Maulana Kumail Mehdavi', '1', '2025-04-19', '18:18:00', '20:20:00', '2025-04-14 04:15:10', '2025-04-17 01:05:04', NULL),
(6, 'Recite with Maulana Kumail Mehdavi', '1', '2025-04-20', '13:08:00', '14:09:00', '2025-04-17 01:07:39', '2025-04-17 01:07:39', NULL),
(7, 'Recite with Nauhakhwan Sonu Monu', '1', '2025-04-21', '14:10:00', '16:12:00', '2025-04-17 01:08:13', '2025-04-17 01:08:13', NULL),
(8, 'Recite with Maulana Kumail Mehdavi', '2', '2025-04-21', '14:10:00', '16:12:00', '2025-04-17 01:08:54', '2025-04-17 01:08:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('5LcJpXuebx5asjdr6uZzOGb5izOCarqC3Fm3KvoG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiRU1HRThNOTNOaFprSjJoR0dMVWFkWUVJUk5JUE10ZGNTYnFZa1V0NyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3Npc3RhbmNlX3dlYiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1746438862),
('CoDmvnb85FOV4dS50l3EP2m6jlwrHH6FV6wnDH8A', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoibzhxQURYRTQ3RkdJck1KdXpzN1dYdTVzWTNxajJLVENCVWRiczQ2NCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzY6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hc3Npc3RhbmNlX3dlYiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjE6e3M6ODoiaW50ZW5kZWQiO3M6Mzg6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9hc3Npc3RhbmNlIjt9czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1746424548),
('gyKv6b0KOR0HuE5RWlf5zP7TKMJK3Xz7EPW6erQa', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiZG9sNUZMekZUajY3TTkwdmVCRGYyNk01ZmJWbWhKaUxhbGRUY0k4QiI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Fzc2lzdGFuY2UiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo0NToiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Fzc2lzdGFuY2UvY3JlYXRlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1746427875),
('lild3oixUaGL5hUc3cKuFP2uHW8tnsHZM34uPRjb', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/135.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiNnV3VFo3bWlybVBZcWZnejgwR2dXWmdwVzZkWXFUZUtWbnA1c3ZjcyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluL2Rhc2hib2FyZCI7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjMzOiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vbG9naW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1746446171);

-- --------------------------------------------------------

--
-- Table structure for table `surahs_quran`
--

CREATE TABLE `surahs_quran` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title_en` varchar(255) DEFAULT NULL,
  `title_ar` varchar(255) DEFAULT NULL,
  `description` blob DEFAULT NULL,
  `total_number` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `surahs_quran`
--

INSERT INTO `surahs_quran` (`id`, `title_en`, `title_ar`, `description`, `total_number`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Al-Fatiah', 'ةحتافلا', 0x3c703e3c7374726f6e673e537572616820616c2d4661746568612069732061206375726520666f7220706879736963616c20616e6420616c736f2073706972697475616c2061696c6d656e74732e20576974686f757420746869732073757261682c206576656e20746865206461696c7920707261796572732061726520696e76616c69642e20497420697320696e646565642061206772656174207472656173757265207468617420686173206265656e20676976656e20746f20757320627920416c6c61682028732e772e742e29207468726f7567682074686520486f6c792050726f706865742028532920616e64206e6f2070726576696f75732070726f7068657420686173206265656e20676976656e20616e797468696e67206c696b652069742e205468697320737572616820697320616c736f206b6e6f776e20617320262333393b556d6d756c204b69746162262333393b20616e6420262333393b536162262333393b61206d617468616e6920757064617465262333393b2e3c2f7374726f6e673e3c2f703e, '8', '2025-04-15 23:40:21', '2025-04-15 23:56:18', NULL),
(2, 'Al-Baqarah', 'ةرقبلا', 0x3c703e537572616820616c2d4661746568612069732061206375726520666f7220706879736963616c20616e6420616c736f2073706972697475616c2061696c6d656e74732e20576974686f757420746869732073757261682c206576656e20746865206461696c7920707261796572732061726520696e76616c69642e20497420697320696e646565642061206772656174207472656173757265207468617420686173206265656e20676976656e20746f20757320627920416c6c61682028732e772e742e29207468726f7567682074686520486f6c792050726f706865742028532920616e64206e6f2070726576696f75732070726f7068657420686173206265656e20676976656e20616e797468696e67206c696b652069742e205468697320737572616820697320616c736f206b6e6f776e20617320262333393b556d6d756c204b69746162262333393b20616e6420262333393b536162262333393b61206d617468616e69262333393b2e3c2f703e, '286', '2025-04-15 23:57:26', '2025-04-15 23:57:26', NULL),
(3, 'Ali \'Imran', 'ناﺮﻤﻋ لآ', 0x3c703e537572616820616c2d4661746568612069732061206375726520666f7220706879736963616c20616e6420616c736f2073706972697475616c2061696c6d656e74732e20576974686f757420746869732073757261682c206576656e20746865206461696c7920707261796572732061726520696e76616c69642e20497420697320696e646565642061206772656174207472656173757265207468617420686173206265656e20676976656e20746f20757320627920416c6c61682028732e772e742e29207468726f7567682074686520486f6c792050726f706865742028532920616e64206e6f2070726576696f75732070726f7068657420686173206265656e20676976656e20616e797468696e67206c696b652069742e205468697320737572616820697320616c736f206b6e6f776e20617320262333393b556d6d756c204b69746162262333393b20616e6420262333393b536162262333393b61206d617468616e69262333393b2e3c2f703e, '200', '2025-04-15 23:57:58', '2025-04-15 23:57:58', NULL),
(4, 'An-Nisa', 'ءاسنلا', 0x3c703e537572616820616c2d4661746568612069732061206375726520666f7220706879736963616c20616e6420616c736f2073706972697475616c2061696c6d656e74732e20576974686f757420746869732073757261682c206576656e20746865206461696c7920707261796572732061726520696e76616c69642e20497420697320696e646565642061206772656174207472656173757265207468617420686173206265656e20676976656e20746f20757320627920416c6c61682028732e772e742e29207468726f7567682074686520486f6c792050726f706865742028532920616e64206e6f2070726576696f75732070726f7068657420686173206265656e20676976656e20616e797468696e67206c696b652069742e205468697320737572616820697320616c736f206b6e6f776e20617320262333393b556d6d756c204b69746162262333393b20616e6420262333393b536162262333393b61206d617468616e69262333393b2e3c2f703e, '176', '2025-04-15 23:58:23', '2025-04-15 23:58:23', NULL),
(5, 'Al-Ma\'idah', 'ٱلمائدة', 0x3c703e537572616820616c2d4661746568612069732061206375726520666f7220706879736963616c20616e6420616c736f2073706972697475616c2061696c6d656e74732e20576974686f757420746869732073757261682c206576656e20746865206461696c7920707261796572732061726520696e76616c69642e20497420697320696e646565642061206772656174207472656173757265207468617420686173206265656e20676976656e20746f20757320627920416c6c61682028732e772e742e29207468726f7567682074686520486f6c792050726f706865742028532920616e64206e6f2070726576696f75732070726f7068657420686173206265656e20676976656e20616e797468696e67206c696b652069742e205468697320737572616820697320616c736f206b6e6f776e20617320262333393b556d6d756c204b69746162262333393b20616e6420262333393b536162262333393b61206d617468616e69262333393b2e3c2f703e, '120', '2025-04-15 23:58:56', '2025-04-15 23:58:56', NULL),
(6, 'Al-An\'am', 'ةحتافلا', 0x3c703e537572616820616c2d4661746568612069732061206375726520666f7220706879736963616c20616e6420616c736f2073706972697475616c2061696c6d656e74732e20576974686f757420746869732073757261682c206576656e20746865206461696c7920707261796572732061726520696e76616c69642e20497420697320696e646565642061206772656174207472656173757265207468617420686173206265656e20676976656e20746f20757320627920416c6c61682028732e772e742e29207468726f7567682074686520486f6c792050726f706865742028532920616e64206e6f2070726576696f75732070726f7068657420686173206265656e20676976656e20616e797468696e67206c696b652069742e205468697320737572616820697320616c736f206b6e6f776e20617320262333393b556d6d756c204b69746162262333393b20616e6420262333393b536162262333393b61206d617468616e69262333393b2e3c2f703e, '165', '2025-04-16 00:01:20', '2025-04-16 00:04:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `android_version` double DEFAULT NULL,
  `safety_rules` longtext NOT NULL,
  `whatsApp_no` varchar(255) NOT NULL,
  `android_force_update` tinyint(4) DEFAULT 0 COMMENT '1 - Yes , 0 - No',
  `ios_version` double DEFAULT NULL,
  `ios_force_update` tinyint(4) DEFAULT 0 COMMENT '1 - Yes , 0 - No',
  `under_maintenance` tinyint(4) DEFAULT 0 COMMENT '1 - Yes , 0 - No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `android_version`, `safety_rules`, `whatsApp_no`, `android_force_update`, `ios_version`, `ios_force_update`, `under_maintenance`, `created_at`, `updated_at`) VALUES
(1, 1, '<ul>\r\n	<li>You don&#39;t have to worry much about doing it completely. If you ever think, that you cannot continue at any point, you can take a van to reach Karbala, there are hundreds everywhere. An average male/female above the age of 10 years is 99.99% likely to complete it on the 3rd/4th&nbsp;day without any issues. You should at least give it a try - it is definitely worth it!!</li>\r\n	<li>Make sure you know the name of the Hotel; you are intended to stay in Karbala in both English &amp; Arabic.</li>\r\n	<li>(Update:&nbsp;The situation has improved in the last few years or so and the calls do get connected most of the times. You can use mobile for internet connectivity. Also, there are some WIFI Moukkibs but those aren&#39;t too reliable and only works randomly sometimes.</li>\r\n	<li>For Common Terminologies in English, Arabic and Urdu</li>\r\n</ul>', '+918755580525', 0, 2, 0, 0, '2025-04-10 23:09:44', '2025-04-15 05:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `travel_guides`
--

CREATE TABLE `travel_guides` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(5) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description_english` blob DEFAULT NULL,
  `description_urdu` blob DEFAULT NULL,
  `description_gujarati` blob DEFAULT NULL,
  `description_arbian` blob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `travel_guides`
--

INSERT INTO `travel_guides` (`id`, `type`, `title`, `description_english`, `description_urdu`, `description_gujarati`, `description_arbian`, `created_at`, `updated_at`, `deleted_at`) VALUES
(3, 1, 'ZIYARAH ON THE DAY OF ARBAEEN; THE TWENTIETH OF SAFAR update', 0x3c703e536861796b6820616c2d547573692c20696e205461686468696220616c2d41686b616d20616e6420696e204d697362616820616c2d4d75746168616a6a69642c20686173207265706f7274656420496d616d20616c2d486173616e20616c2d262333393b41736b6172692028612920617320736179696e672c202671756f743b546865207369676e73206f66206120666169746866756c2062656c69657665722061726520666976653a20283129206f66666572696e672066696674792d6f6e6520756e697473206f662070726179657220286120646179293a20736576656e7465656e20756e697473206f6620746865206f626c696761746f7279207072617965727320616e64207468697274792d666f757220756e697473206f662074686520737570657265726f6761746f727920286d75737461686162202f206e6166696c61682920707261796572732c202832292076697369746174696f6e20286f6620496d616d20616c2d48757361796e262333393b7320746f6d6229206f6e207468652041726261262333393b696e204461793a20746865207477656e7469657468206f662053616661723b20666f727479206461797320616674657220746865206d6172747972646f6d206f6620496d616d20616c2d48757361796e2c202833292077656172696e6720612072696e6720696e207468652072696768742068616e642c20283429207072657373696e672074686520666f726568656164202862792076657279206672657175656e742070726f7374726174696f6e206265666f726520416c6d696768747920416c6c6168292c20616e64202835292072616973696e672074686520766f6963652077697468206269736d692d6c6c616869722d7261686d616e69722d726168696d20286261736d616c61683a20496e20746865204e616d65206f6620416c6c61683b2074686520416c6c2d62656e65666963656e742c2074686520416c6c2d6d6572636966756c292e266e6273703b7570646174653c2f703e, 0x3c7072653e0d0ad8b4db8cd8ae20d8b7d988d8b3db8c20d986db9220d8aadb81d8b0db8cd8a820d8a7d984d8a7d8addaa9d8a7d98520d8a7d988d8b120d985d8b5d8a8d8a7d8ad20d8a7d984d985d8aadb81d8acd8af20d985db8cdaba20d8a7d985d8a7d98520d8add8b3d98620d8b9d8b3daa9d8b1db8c20d8b9d984db8cdb8120d8a7d984d8b3d984d8a7d98520d8b3db9220d986d982d98420daa9db8cd8a720db81db9220daa9db813a202671756f743bd985d988d985d98620daa9db8c20d9bed8a7d986da8620d986d8b4d8a7d986db8cd8a7daba20db81db8cdaba3a2028312920d8a7daa9db8cd8a7d988d98620d8b1daa9d8b9d8aadb8cdaba2028d8afd98620d985db8cdaba29d88c20d981d8b1d8b620d986d985d8a7d8b2d988daba20daa9db8c20d8b3d8aad8b1db8120d8b1daa9d8b9d8aadb8cdaba20d8a7d988d8b120d985d8b3d8aad8add8a8d8a7d8aadb9420d986d985d8a7d8b2d88c2028322920db8cd988d98520d8a7d8b1d8a8d8b9db8cd98620d9bed8b12028d982d8a8d8b120d8a7d985d8a7d98520d8add8b3db8cd98620daa9db8c2920d8b2db8cd8a7d8b1d8aa3a20d8a7d985d8a7d98520d8add8b3db8cd98620daa9db8c20d8b4db81d8a7d8afd8aa20daa9db9220da86d8a7d984db8cd8b320d8afd98620d8a8d8b9d8afd88c2028332920d8afd8a7d8a6db8cdaba20db81d8a7d8aadabe20d985db8cdaba20d8a7d986daafd988d9b9dabedb8c20d9bedb81d986d986d8a7d88c2028342920d9bedb8cd8b4d8a7d986db8c20d8afd8a8d8a7d986d8a72028d8a8db81d8aa20d8b2db8cd8a7d8afdb8120d8b3d8acd8afdb8120d8b1db8cd8b220db81d98820daa9d8b12920d8a8d8b3d98520d8a7d984d984db8120d8a7d984d8b1d8add985d98620d8a7d984d8b1d8addb8cd9852028d8a8d8b3d98520d8a7d984d984db813a20d8a7d984d984db8120daa9db9220d986d8a7d98520d8b3db92d88c20d8a8da91d8a720d985db81d8b1d8a8d8a7d986d88c20d8b1d8add98520daa9d8b1d986db9220d988d8a7d984d8a729db94207570646174653c2f7072653e, 0x3c7072653e0d0ae0aab6e0ab87e0aa9620e0aa85e0aab22de0aaa4e0ab81e0aab8e0ab802c20e0aaa4e0aab9e0aaa7e0ab80e0aaac20e0aa85e0aab22de0aa85e0aab9e0aa95e0aaae20e0aa85e0aaa8e0ab8720e0aaaee0aabfe0aab8e0ab8de0aaace0aabee0aab920e0aa85e0aab22de0aaaee0ab81e0aaa4e0aabee0aab9e0aa9ce0ab8de0aa9ce0aabfe0aaa6e0aaaee0aabee0aa822c20e0aa87e0aaaee0aabee0aaae20e0aa85e0aab22de0aab9e0aab8e0aaa820e0aa85e0aab22de0aa85e0aab8e0ab8de0aa95e0aab0e0ab802028e0aa852e2920e0aaa8e0ab8720e0aa95e0aab9e0ab87e0aaa4e0aabe20e0aa85e0aab9e0ab87e0aab5e0aabee0aab220e0aa86e0aaaae0ab8720e0aa9be0ab8720e0aa95e0ab872c202671756f743be0aa8fe0aa9520e0aab5e0aabfe0aab6e0ab8de0aab5e0aabee0aab8e0ab8120e0aa86e0aab8e0ab8de0aaa5e0aabee0aab5e0aabee0aaa8e0aaa8e0ab8020e0aaa8e0aabfe0aab6e0aabee0aaa8e0ab80e0aa9320e0aaaae0aabee0aa82e0aa9a20e0aa9be0ab873a2028e0aba72920e0aa8fe0aa95e0aabee0aab5e0aaa820e0aab0e0aa95e0aabee0aaa420e0aaa8e0aaaee0aabee0aa9d2028e0aaa6e0aabfe0aab5e0aab8293a20e0aab8e0aaa4e0ab8de0aaa4e0aab020e0aab0e0aa95e0aabee0aaa420e0aaabe0aab0e0aa9ce0aabfe0aaafe0aabee0aaa420e0aaa8e0aaaee0aabee0aa9d20e0aa85e0aaa8e0ab8720e0aa9ae0ab8be0aaa4e0ab8de0aab0e0ab80e0aab820e0aab0e0aa95e0aabee0aaa420e0aaa8e0aaaee0aabee0aa9d2028e0aaaee0ab81e0aab8e0ab8de0aaa4e0aab9e0aaac202f20e0aaa8e0aaabe0ab80e0aab2e0aabe2920e0aaa8e0aaaee0aabee0aa9d2c2028e0aba82920e0aa85e0aab0e0aaace0ab88e0aaa820e0aaa6e0aabfe0aab5e0aab8e0ab872028e0aa87e0aaaee0aabee0aaae20e0aa85e0aab22de0aab9e0ab81e0aab8e0ab88e0aaa8e0aaa8e0ab8020e0aa95e0aaace0aab0e0aaa8e0ab802920e0aa9de0aabfe0aaafe0aabee0aab0e0aaa420e0aa95e0aab0e0aab5e0ab803a20e0aab5e0ab80e0aab8e0aaaee0ab8020e0aab8e0aaabe0aab03b20e0aa87e0aaaee0aabee0aaae20e0aa85e0aab22de0aab9e0ab81e0aab8e0ab88e0aaa8e0aaa8e0ab8020e0aab6e0aab9e0aabee0aaa6e0aaa4e0aaa8e0aabe20e0aa9ae0aabee0aab2e0ab80e0aab820e0aaa6e0aabfe0aab5e0aab820e0aaaae0aa9be0ab802c2028e0aba92920e0aa9ce0aaaee0aaa3e0aabe20e0aab9e0aabee0aaa5e0aaaee0aabee0aa8220e0aab5e0ab80e0aa82e0aa9fe0ab8020e0aaaae0aab9e0ab87e0aab0e0aab5e0ab802c2028e0abaa2920e0aa95e0aaaae0aabee0aab320e0aaa6e0aaace0aabee0aab5e0aab5e0ab81e0aa822028e0aab8e0aab0e0ab8de0aab5e0aab6e0aa95e0ab8de0aaa4e0aabfe0aaaee0aabee0aaa820e0aa85e0aab2e0ab8de0aab2e0aabee0aab920e0aab8e0aaaee0aa95e0ab8de0aab720e0aab5e0aabee0aab0e0aa82e0aab5e0aabee0aab020e0aab8e0aa9ce0aaa6e0ab8b20e0aa95e0aab0e0ab80e0aaa8e0ab87292c20e0aa85e0aaa8e0ab872028e0abab2920e0aaace0aabfe0aab8e0ab8de0aaaee0ab802de0aab2e0ab8de0aab2e0aabee0aab9e0aabfe0aab02de0aab0e0aab9e0aaaee0aabee0aaa8e0aabfe0aab02de0aab0e0aab9e0ab80e0aaae2028e0aaace0aab8e0aaaee0aab2e0aabee0aab93a20e0aa85e0aab2e0ab8de0aab2e0aabee0aab9e0aaa8e0aabe20e0aaa8e0aabee0aaaee0ab873b20e0aab8e0aab0e0ab8de0aab52de0aaa6e0aaafe0aabee0aab3e0ab812c20e0aab8e0aab0e0ab8de0aab52de0aaa6e0aaafe0aabee0aab3e0ab812920e0aab8e0aabee0aaa5e0ab8720e0aa85e0aab5e0aabee0aa9c20e0aa89e0aaa0e0aabee0aab5e0aab5e0ab8b2e207570646174653c2f7072653e, 0x3c7072653e0d0ad8b1d988d98920d8a7d984d8b4d98ad8ae20d8a7d984d8b7d988d8b3d98a20d981d98a20d8aad987d8b0d98ad8a820d8a7d984d8a3d8add983d8a7d98520d988d985d8b5d8a8d8a7d8ad20d8a7d984d985d8aad987d8acd8af20d8b9d98620d8a7d984d8a5d985d8a7d98520d8a7d984d8add8b3d98620d8a7d984d8b9d8b3d983d8b1d98a2028d8b9d984d98ad98720d8a7d984d8b3d984d8a7d9852920d982d8a7d9843a20d8b9d984d8a7d985d8a7d8aa20d8a7d984d985d8a4d985d98620d8aed985d8b33a2028312920d8b5d984d8a7d8a920d8a5d8add8afd98920d988d8aed985d8b3d98ad98620d8b1d983d8b9d8a93a20d8b3d8a8d8b920d8b9d8b4d8b1d8a920d8b1d983d8b9d8a920d985d98620d8a7d984d981d8b1d8a7d8a6d8b620d988d8a3d8b1d8a8d8b920d988d8abd984d8a7d8abd98ad98620d8b1d983d8b9d8a920d985d98620d8a7d984d986d988d8a7d981d984d88c2028322920d8b2d98ad8a7d8b1d8a920d8a7d984d8add8b3d98ad9862028d8b9d984d98ad98720d8a7d984d8b3d984d8a7d9852920d98ad988d98520d8a7d984d8a3d8b1d8a8d8b9d98ad9863a20d8a7d984d8b9d8b4d8b1d98ad98620d985d98620d8b5d981d8b1d88c20d8a3d8b1d8a8d8b9d98ad98620d98ad988d985d8a720d985d98620d8a7d8b3d8aad8b4d987d8a7d8af20d8a7d984d8add8b3d98ad9862028d8b9d984d98ad98720d8a7d984d8b3d984d8a7d98529d88c2028332920d8a7d984d8aad8aed8aad98520d981d98a20d8a7d984d98ad985d986d989d88c2028342920d988d8b6d8b920d8a7d984d98ad8af20d8b9d984d98920d8a7d984d8acd8a8d987d8a9d88c2028352920d8b1d981d8b920d8a7d984d8b5d988d8aa20d8a8d8a8d8b3d98520d8a7d984d984d98720d8a7d984d8b1d8add985d98620d8a7d984d8b1d8add98ad9852e207570646174653c2f7072653e, '2025-04-11 01:16:51', '2025-04-11 03:57:58', NULL),
(4, 2, 'Al Istighathah Bil Hujjah', 0x3c703e546865207265766572656e742053617979696420416c69204b68616e20616c2d53686972617a69202d206d617920416c6c6168262333393b7320706c65617375726520626520776974682068696d202d20686173206d656e74696f6e656420696e2068697320626f6f6b206f6620616c2d4b616c696d20616c2d546179796962207468617420416c6d696768747920416c6c6168262333393b73204772656174657374204e616d652028616c69736d20616c2d61262333393b7a616d29207374616e647320666f7220656163682073746174656d656e74207468617420626567696e7320776974682074686520776f726420266c6471756f3b416c6c616826726471756f3b20616e6420656e647320757020776974682074686520776f7264202671756f743b6875776120284865292c2671756f743b2070726f76696465642074686174207468652073746174656d656e742028696e204172616269632920626520656d707479206f6620616e7920646f74746564206c657474657220616e642074686174206974732072656369746174696f6e20646f6573206e6f74206368616e6765207768657468657220697420697320706172736564206f72206e6f742e20537563682073746174656d656e74732063616e20626520666f756e6420696e2074686520486f6c7920517572262333393b616e20696e206669766520766572736573206f66206669766520646966666572656e74205375726168733a20616c2d426171617261682028323a323535292c20416c2dcabc496d72616e2028333a32292c20616c2d4e697361262333393b2028343a3837292c20546161686161202832303a38292c20616e6420616c2d546167686162756e202836343a3133292e20536861796b68e280a8616c2d4d6167687269626920736179732c202671756f743b4966206f6e6520626574616b657320746f207468657365206669766520766572736573206173206120737570706c696361746f727920707261796572207468617420697320726570656174656420656c6576656e2074696d65732061206461792c20616c6c206869732067656e6572616c20616e6420706172746963756c617220616666616972732077696c6c206265206d616465206561737920666f722068696d20776974686f75742064656c61792c20416c6c61682077696c6c696e672e2671756f743b2054686573652066697665207665727365732061726520617320666f6c6c6f77733a3c2f703e, 0x3c7072653e0d0ad8b9d8b2d8aa20d985d8a2d8a820d8b3db8cd8af20d8b9d984db8c20d8aed8a7d98620d8a7d984d8b4db8cd8b1d8a7d8b2db8c20d986db9220d8a7d9bed986db8c20daa9d8aad8a7d8a820d8a7d984daa9d984d98520d8a7d984d8b7db8cd8a820d985db8cdaba20d8b0daa9d8b120daa9db8cd8a720db81db9220daa9db8120d8a7d984d984db8120d8aad8b9d8a7d984db8cd9b020daa9d8a720d8b3d8a820d8b3db9220d8a8da91d8a720d986d8a7d9852028d8a7d984d8b2d98520d8a7d984d8b9d8b2d9852920db81d8b120d8a7d8b320d982d988d98420daa9db9220d984db8cdb9220db81db9220d8acd98820d984d981d8b8202671756f743bd8a7d984d984db812671756f743b20d8b3db9220d8b4d8b1d988d8b920db81d988d8aad8a720db81db9220d8a7d988d8b120d984d981d8b8202671756f743bd8add988d8a72671756f743b20d9bed8b120d8aed8aad98520db81d988d8aad8a720db81db9220d8a8d8b4d8b1d8b7db8cdaa9db8120d8b9d8b1d8a8db8c20daa9d8a720daa9d988d8a6db8c20d8a8dabedb8c20d8add8b1d98120db81d988db9420daa9db8120d8a7d8b320daa9db8c20d8aad984d8a7d988d8aa20d985db8cdaba20daa9d988d8a6db8c20d8aad8a8d8afdb8cd984db8c20d986db81db8cdaba20d8a2d8aadb8c20da86d8a7db81db9220d8a7d8b320daa9db8c20d8aad8b5d8b1db8cd98120daa9db8c20d8acd8a7d8a6db9220db8cd8a720d986db8120daa9db8c20d8acd8a7d8a6db92db9420d8a7d8b320d8b7d8b1d8ad20daa9db9220d8a8db8cd8a7d986d8a7d8aa20d982d8b1d8a2d98620daa9d8b1db8cd98520d985db8cdaba20d9bed8a7d986da8620d985d8aed8aad984d98120d8b3d988d8b1d8aad988daba20daa9db8c20d9bed8a7d986da8620d8a2db8cd8a7d8aa20d985db8cdaba20d985d98420d8b3daa9d8aadb9220db81db8cdaba3a20d8a7d984d8a8d982d8b1db812028323a32353529d88c20d8a2d98420d8b9d985d8b1d8a7d9862028333a3229d88c20d8a7d984d986d8b3d8a7d8a12028343a383729d88c20d8b7db81d9b0202832303a382920d8a7d988d8b120d8a7d984d8b7d8a7d8bad8a8d988d986202836343a313329db9420d8b4db8cd8ae20d985d8bad8b1d8a8db8c20daa9db81d8aadb9220db81db8cdaba3a202671756f743bd8a7daafd8b120daa9d988d8a6db8c20d8a7d98620d9bed8a7d986da8620d8a2db8cd8a7d8aa20daa9d98820d8a8d8b7d988d8b120d8afd8b9d8a7d8a6db8cdb8120d8afd8b9d8a720daa9db9220d8b7d988d8b120d9bed8b120d9beda91dabedb9220d8acd98820d8afd98620d985db8cdaba20daafdb8cd8a7d8b1db8120d985d8b1d8aad8a8db8120d9beda91dabedb8c20d8acd8a7d8aadb8c20db81db9220d8aad98820d8a7d8b320daa9db9220d8aad985d8a7d98520d8b9d985d988d985db8c20d8a7d988d8b120d8aed8a7d8b520d8a7d985d988d8b120d8a8d8badb8cd8b120daa9d8b3db8c20d8aad8a7d8aedb8cd8b120daa9db9220d8a2d8b3d8a7d98620db81d98820d8acd8a7d8a6db8cdaba20daafdb92d88c20d8a7d986d8b4d8a7d8a120d8a7d984d984db81db942671756f743b20db8cdb8120d9bed8a7d986da8620d8a2db8cd8a7d8aa20d8afd8b1d8ac20d8b0db8cd98420db81db8cdabadb943c2f7072653e, 0x3c7072653e0d0ae0aa86e0aaa6e0aab0e0aaa3e0ab80e0aaaf20e0aab8e0ab88e0aaafe0aaa620e0aa85e0aab2e0ab8020e0aa96e0aabee0aaa820e0aa85e0aab22de0aab6e0aabfe0aab0e0aabee0aa9de0ab80202d20e0aa85e0aab2e0ab8de0aab2e0aabee0aab9e0aaa8e0ab8020e0aa96e0ab81e0aab6e0ab8020e0aaa4e0ab87e0aaaee0aaa8e0aabe20e0aaaae0aab020e0aab0e0aab9e0ab87202d20e0aa8f20e0aaa4e0ab87e0aaaee0aaa8e0aabe20e0aaaae0ab81e0aab8e0ab8de0aaa4e0aa9520e0aa85e0aab22de0aa95e0aabee0aab2e0ab80e0aaae20e0aa85e0aab22de0aaa4e0ab88e0aaafe0aaace0aaaee0aabee0aa8220e0aa89e0aab2e0ab8de0aab2e0ab87e0aa9620e0aa95e0aab0e0ab8de0aaafe0ab8b20e0aa9be0ab8720e0aa95e0ab8720e0aab8e0aab0e0ab8de0aab5e0aab6e0aa95e0ab8de0aaa4e0aabfe0aaaee0aabee0aaa820e0aa85e0aab2e0ab8de0aab2e0aabee0aab9e0aaa8e0ab81e0aa8220e0aaaee0aab9e0aabee0aaa820e0aaa8e0aabee0aaae2028e0aa85e0aab2e0aabfe0aa9de0aaae20e0aa85e0aab22de0aa86e0aa9de0aaae2920e0aa8f20e0aaa6e0aab0e0ab87e0aa9520e0aab5e0aabee0aa95e0ab8de0aaafe0aaa8e0ab81e0aa8220e0aaaae0ab8de0aab0e0aaa4e0aabfe0aaa8e0aabfe0aaa7e0aabfe0aaa4e0ab8de0aab520e0aa95e0aab0e0ab8720e0aa9be0ab8720e0aa9ce0ab87202671756f743be0aa85e0aab2e0ab8de0aab2e0aabee0aab92671756f743b20e0aab6e0aaace0ab8de0aaa6e0aaa5e0ab8020e0aab6e0aab0e0ab8220e0aaa5e0aabee0aaaf20e0aa9be0ab8720e0aa85e0aaa8e0ab87202671756f743be0aab9e0ab81e0aab5e0aabe2671756f743b20e0aab6e0aaace0ab8de0aaa620e0aab8e0aabee0aaa5e0ab8720e0aab8e0aaaee0aabee0aaaae0ab8de0aaa420e0aaa5e0aabee0aaaf20e0aa9be0ab872c20e0aaaae0aab0e0aa82e0aaa4e0ab8120e0aa9ce0ab8b20e0aab5e0aabee0aa95e0ab8de0aaaf2028e0aa85e0aab0e0aaace0ab80e0aaaee0aabee0aa822920e0aa95e0ab8be0aa88e0aaaae0aaa320e0aa9fe0aaaae0aa95e0aabee0aa82e0aab5e0aabee0aab3e0aabe20e0aa85e0aa95e0ab8de0aab7e0aab0e0ab8be0aaa5e0ab8020e0aa96e0aabee0aab2e0ab8020e0aab9e0ab8be0aaaf20e0aa85e0aaa8e0ab8720e0aaa4e0ab87e0aaa8e0ab81e0aa8220e0aaaae0aaa0e0aaa820e0aaace0aaa6e0aab2e0aabee0aaa4e0ab81e0aa8220e0aaa8e0aaa5e0ab802c20e0aaa4e0ab8b20e0aaa4e0ab8720e0aaaae0aabee0aab0e0ab8de0aab8e0aab220e0aa95e0aab0e0aab5e0aabee0aaaee0aabee0aa8220e0aa86e0aab5e0ab8720e0aa95e0ab8720e0aaa820e0aa95e0aab0e0aab5e0aabee0aaaee0aabee0aa8220e0aa86e0aab5e0ab872e20e0aa86e0aab5e0aabe20e0aab5e0aabee0aa95e0ab8de0aaaf20e0aaaae0aab5e0aabfe0aaa4e0ab8de0aab020e0aa95e0ab81e0aab0e0aabee0aaa8e0aaaee0aabee0aa8220e0aaaae0aabee0aa82e0aa9a20e0aa85e0aab2e0aa9720e0aa85e0aab2e0aa9720e0aab8e0ab81e0aab0e0aabee0aa93e0aaa8e0ab8020e0aaaae0aabee0aa82e0aa9a20e0aa86e0aaafe0aaa4e0ab8be0aaaee0aabee0aa8220e0aaaee0aab3e0ab8020e0aab6e0aa95e0ab8720e0aa9be0ab873a20e0aa85e0aab22de0aaace0aa95e0aab0e0aabee0aab92028323a323535292c20e0aa85e0aab22de0aa87e0aaaee0aab0e0aabee0aaa82028333a32292c20e0aa85e0aab22de0aaa8e0aabfe0aab8e0aabe262333393b2028343a3837292c20e0aaa4e0aabee0aab9e0aabe202832303a38292c20e0aa85e0aaa8e0ab8720e0aa85e0aab22de0aaa4e0aa97e0aabee0aaace0ab81e0aaa8202836343a3133292e20e0aab6e0ab87e0aa96e0aab22de0aaaee0aa97e0aab0e0aabfe0aaace0ab8020e0aa95e0aab9e0ab8720e0aa9be0ab872c202671756f743be0aa9ce0ab8b20e0aa95e0ab8be0aa8820e0aab5e0ab8de0aaafe0aa95e0ab8de0aaa4e0aabf20e0aa8620e0aaaae0aabee0aa82e0aa9a20e0aa86e0aaafe0aaa4e0ab8be0aaa8e0ab8720e0aaa6e0aabfe0aab5e0aab8e0aaaee0aabee0aa8220e0aa85e0aa97e0aabfe0aaafe0aabee0aab020e0aab5e0aa96e0aaa420e0aaaae0ab81e0aaa8e0aab0e0aabee0aab5e0aab0e0ab8de0aaa4e0aabfe0aaa420e0aaaae0ab8de0aab0e0aabee0aab0e0ab8de0aaa5e0aaa8e0aabe20e0aaa4e0aab0e0ab80e0aa95e0ab8720e0aab8e0ab8de0aab5e0ab80e0aa95e0aabee0aab0e0ab8720e0aa9be0ab872c20e0aaa4e0ab8b20e0aaa4e0ab87e0aaa8e0aabe20e0aaace0aaa7e0aabe20e0aab8e0aabee0aaaee0aabee0aaa8e0ab8de0aaaf20e0aa85e0aaa8e0ab8720e0aa96e0aabee0aab820e0aa95e0aabee0aab0e0ab8de0aaafe0ab8b20e0aaa4e0ab87e0aaa8e0aabe20e0aaaee0aabee0aa9fe0ab8720e0aab5e0aabfe0aab2e0aa82e0aaac20e0aa95e0aab0e0ab8de0aaafe0aabe20e0aab5e0aabfe0aaa8e0aabe20e0aab8e0aab0e0aab320e0aaa5e0aa8820e0aa9ce0aab6e0ab872c20e0aa85e0aab2e0ab8de0aab2e0aabee0aab9e0aaa8e0ab8020e0aa87e0aa9ae0ab8de0aa9be0aabe20e0aaaee0ab81e0aa9ce0aaac2e2671756f743b20e0aa8620e0aaaae0aabee0aa82e0aa9a20e0aa86e0aaafe0aaa4e0ab8b20e0aaa8e0ab80e0aa9ae0ab8720e0aaaee0ab81e0aa9ce0aaac20e0aa9be0ab873a3c2f7072653e, 0x3c7072653e0d0ad8b0d983d8b120d8a7d984d8b3d98ad8af20d8b9d984d98a20d8aed8a7d98620d8a7d984d8b4d98ad8b1d8a7d8b2d98a20d8a7d984d8acd984d98ad984202dd8b1d8b6d98a20d8a7d984d984d98720d8b9d986d9872d20d981d98a20d983d8aad8a7d8a8d987202671756f743bd8a7d984d983d984d98520d8a7d984d8b7d98ad8a82671756f743b20d8a3d98620d8a7d8b3d98520d8a7d984d984d98720d8a7d984d8a3d8b9d8b8d98520d987d98820d983d98420d983d984d985d8a920d8aad8a8d8afd8a320d8a8d983d984d985d8a9202671756f743bd8a7d984d984d9872671756f743b20d988d8aad986d8aad987d98a20d8a8d983d984d985d8a9202671756f743bd987d9882671756f743bd88c20d8b4d8b1d8b720d8a3d98620d8aad983d988d98620d8aed8a7d984d98ad8a920d985d98620d8a3d98a20d8add8b1d98120d985d986d982d988d8b7d88c20d988d8a3d98620d984d8a720d8aad8aad8bad98ad8b120d982d8b1d8a7d8a1d8aad987d8a720d8b3d988d8a7d8a1d98b20d8a3d98fd8b9d992d8a8d990d8b1d98ed8aa20d8a3d98520d984d98520d8aad98fd8b9d992d8a8d98ed8b12e20d988d982d8af20d988d8b1d8afd8aa20d987d8b0d98720d8a7d984d983d984d985d8a7d8aa20d981d98a20d8a7d984d982d8b1d8a2d98620d8a7d984d983d8b1d98ad98520d981d98a20d8aed985d8b320d8a2d98ad8a7d8aa20d985d98620d8aed985d8b320d8b3d988d8b120d985d8aed8aad984d981d8a93a20d8a7d984d8a8d982d8b1d8a92028323a2032353529d88c20d988d8a2d98420d8b9d985d8b1d8a7d9862028333a203229d88c20d988d8a7d984d986d8b3d8a7d8a12028343a20383729d88c20d988d8b7d987202832303a203829d88c20d988d8a7d984d8aad8bad8a7d8a8d986202836343a203133292e20d982d8a7d98420d8a7d984d8b4d98ad8ae20d8a7d984d985d8bad8b1d8a8d98a3a20d985d98620d984d8acd8a320d8a5d984d98920d987d8b0d98720d8a7d984d8a2d98ad8a7d8aa20d8a7d984d8aed985d8b320d8afd8b9d8a7d8a1d98b20d98ad98fd983d8b1d8b120d981d98a20d8a7d984d98ad988d98520d8a5d8add8afd98920d8b9d8b4d8b1d8a920d985d8b1d8a9d88c20d981d8a5d986d98720d98ad98fd8b3d987d991d98420d8b9d984d98ad98720d8acd985d98ad8b920d8a3d985d988d8b1d98720d8b9d8a7d985d8a920d988d8aed8a7d8b5d8a920d985d98620d8bad98ad8b120d8aad8a3d8aed98ad8b120d8a5d98620d8b4d8a7d8a120d8a7d984d984d9872e20d988d987d8b0d98720d8a7d984d8a2d98ad8a7d8aa20d8a7d984d8aed985d8b320d987d98a3a2020203c2f7072653e, '2025-04-11 01:41:15', '2025-04-16 07:46:55', NULL),
(5, 3, 'Mahine ki Awwal', 0x3c703e4d61727461626120537572616820466174656861207061646865206a697373652061616e6b686f262333393b6e206b692074616b6c656566207365206e616a6161742e3c2f703e, 0x3c7072653e0d0ad985d8b1d8aad8a8db8120d8b3d988d8b1db8120d981d8a7d8aad8addb8120d9beda91dabedb9220d8acdb8cd8b3db8c20d8a2d986daa9dabed988daba20daa9db8c20d8aadaa9d984db8cd98120d8b3db9220d986d8acd8a7d8aadb943c2f7072653e, 0x3c7072653e0d0ae0aaaee0aab0e0aaa4e0aaace0aabe20e0aab8e0ab81e0aab0e0aabe20e0aaabe0aabee0aaa4e0ab87e0aab9e0aabe20e0aaaae0aaa1e0ab8720e0aa9ce0ab80e0aab8e0ab8720e0aa86e0aa82e0aa96e0ab8b20e0aa95e0ab8020e0aaa4e0aa95e0aab2e0ab80e0aaab20e0aab8e0ab8720e0aaa8e0aa9ce0aabee0aaa42e3c2f7072653e, 0x3c7072653e0d0a4d61727461626120d8b3d988d8b1d8a920d8a7d984d981d8a7d8aad8add8a9205061646865206a697373652061616e6b686f262333393b6e206b692074616b6c656566207365206e616a6161742e3c2f7072653e, '2025-04-11 01:47:08', '2025-04-11 01:47:19', NULL),
(8, 1, 'Ziyarat e Aale Yasin', 0x3c703e536861796b6820616c2d547573692c20696e205461686468696220616c2d41686b616d20616e6420696e204d697362616820616c2d4d75746168616a6a69642c20686173207265706f7274656420496d616d20616c2d486173616e20616c2d262333393b41736b6172692028612920617320736179696e672c202671756f743b546865207369676e73206f66206120666169746866756c2062656c69657665722061726520666976653a20283129206f66666572696e672066696674792d6f6e6520756e697473206f662070726179657220286120646179293a20736576656e7465656e20756e697473206f6620746865206f626c696761746f7279207072617965727320616e64207468697274792d666f757220756e697473206f662074686520737570657265726f6761746f727920286d75737461686162202f206e6166696c61682920707261796572732c202832292076697369746174696f6e20286f6620496d616d20616c2d48757361796e262333393b7320746f6d6229206f6e207468652041726261262333393b696e204461793a20746865207477656e7469657468206f662053616661723b20666f727479206461797320616674657220746865206d6172747972646f6d206f6620496d616d20616c2d48757361796e2c202833292077656172696e6720612072696e6720696e207468652072696768742068616e642c20283429207072657373696e672074686520666f726568656164202862792076657279206672657175656e742070726f7374726174696f6e206265666f726520416c6d696768747920416c6c6168292c20616e64202835292072616973696e672074686520766f6963652077697468206269736d692d6c6c616869722d7261686d616e69722d726168696d20286261736d616c61683a20496e20746865204e616d65206f6620416c6c61683b2074686520416c6c2d62656e65666963656e742c2074686520416c6c2d6d6572636966756c292e3c2f703e, 0x3c7072653e0d0ad8b4db8cd8ae20d8b7d988d8b3db8c20d986db9220d8aadb81d8b0db8cd8a820d8a7d984d8a7d8addaa9d8a7d98520d8a7d988d8b120d985d8b5d8a8d8a7d8ad20d8a7d984d985d8aadb81d8acd8af20d985db8cdaba20d8a7d985d8a7d98520d8add8b3d98620d8b9d8b3daa9d8b1db8c20d8b9d984db8cdb8120d8a7d984d8b3d984d8a7d98520d8b3db9220d986d982d98420daa9db8cd8a720db81db9220daa9db813a202671756f743bd985d988d985d98620daa9db8c20d9bed8a7d986da8620d986d8b4d8a7d986db8cd8a7daba20db81db8cdaba3a2028312920d8a7daa9db8cd8a7d988d98620d8b1daa9d8b9d8aadb8cdaba2028d8afd98620d985db8cdaba29d88c20d981d8b1d8b620d986d985d8a7d8b2d988daba20daa9db8c20d8b3d8aad8b1db8120d8b1daa9d8b9d8aadb8cdaba20d8a7d988d8b120d985d8b3d8aad8add8a8d8a7d8aadb9420d986d985d8a7d8b2d88c2028322920d8b5d981d8b120daa9db8c20d8a8db8cd8b3d988db8cdaba20d8aad8a7d8b1db8cd8ae20daa9d98820d8b2db8cd8a7d8b1d8aa2028332920d8afd8a7d8a6db8cdaba20db81d8a7d8aadabe20d985db8cdaba20d8a7d986daafd988d9b9dabedb8c20d9bedb81d986d986d8a7d88c2028342920d9bedb8cd8b4d8a7d986db8c20d8afd8a8d8a7d986d8a72028d8a7d984d984db8120daa9db9220d8add8b6d988d8b120daa9d8abd8b1d8aa20d8b3db9220d8b3d8acd8afdb8120daa9d8b1d986d8a72920d8a7d988d8b12028352920d8a8d8b3d98520d8a7d984d984db8120d8a7d984d8b1d8add985d98620d8a7d984d8b1d8addb8cd98520daa9db9220d8b3d8a7d8aadabe20d8a2d988d8a7d8b220d8a8d984d986d8af20daa9d8b1d986d8a7db9420d8b3d8a820d8b3db9220d8b2db8cd8a7d8afdb8120d981d8a7d8a6d8afdb8120d985d986d8afd88c20d8b1d8add98520daa9d8b1d986db9220d988d8a7d984d8a729db943c2f7072653e, 0x3c7072653e0d0ae0aab6e0ab87e0aa9620e0aa85e0aab22de0aaa4e0ab81e0aab8e0ab802c20e0aaa4e0aab9e0aaa7e0ab80e0aaac20e0aa85e0aab22de0aa85e0aab9e0aa95e0aaae20e0aa85e0aaa8e0ab8720e0aaaee0aabfe0aab8e0ab8de0aaace0aabee0aab920e0aa85e0aab22de0aaaee0ab81e0aaa4e0aabee0aab9e0aa9ce0ab8de0aa9ce0ab80e0aaa6e0aaaee0aabee0aa822c20e0aa87e0aaaee0aabee0aaae20e0aa85e0aab22de0aab9e0aab8e0aaa820e0aa85e0aab22de0aa85e0aab8e0ab8de0aa95e0aab0e0ab802028e0aa852e2920e0aaa8e0ab8720e0aa95e0aab9e0ab87e0aaa4e0aabe20e0aa95e0aab9e0ab8720e0aa9be0ab8720e0aa95e0ab872c202671756f743be0aa8fe0aa9520e0aab5e0aabfe0aab6e0ab8de0aab5e0aabee0aab8e0ab8120e0aa86e0aab8e0ab8de0aaa5e0aabee0aab5e0aabee0aaa8e0aaa8e0ab8020e0aaa8e0aabfe0aab6e0aabee0aaa8e0ab80e0aa9320e0aaaae0aabee0aa82e0aa9a20e0aa9be0ab873a2028e0aba72920e0aa8fe0aa95e0aabee0aab5e0aaa820e0aab0e0aa95e0aabee0aaa420e0aaa8e0aaaee0aabee0aa9d2028e0aaa6e0aabfe0aab5e0aab8293a20e0aab8e0aaa4e0ab8de0aaa4e0aab020e0aab0e0aa95e0aabee0aaa420e0aaabe0aab0e0aa9ce0aabfe0aaafe0aabee0aaa420e0aaa8e0aaaee0aabee0aa9d20e0aa85e0aaa8e0ab8720e0aa9ae0ab8be0aaa4e0ab8de0aab0e0ab80e0aab820e0aab0e0aa95e0aabee0aaa420e0aaa8e0aaaee0aabee0aa9d2028e0aaaee0ab81e0aab8e0ab8de0aaa4e0aab9e0aaac202f20e0aaa8e0aaabe0ab80e0aab2e0aabe2920e0aaa8e0aaaee0aabee0aa9d2c2028e0aba82920e0aab5e0ab80e0aab8e0aaaee0ab8020e0aab8e0aaabe0aab0e0aaa8e0aabe20e0aaa6e0aabfe0aab5e0aab8e0ab872028e0aa87e0aaaee0aabee0aaae20e0aa85e0aab22de0aab9e0ab81e0aab8e0ab88e0aaa8e0aaa8e0ab8020e0aa95e0aaace0aab0e0aaa8e0ab802920e0aa9de0aabfe0aaafe0aabee0aab0e0aaa420e0aa95e0aab0e0aab5e0ab803b2028e0aba92920e0aa9ce0aaaee0aaa3e0aabe20e0aab9e0aabee0aaa5e0aaaee0aabee0aa8220e0aab5e0ab80e0aa82e0aa9fe0ab8020e0aaaae0aab9e0ab87e0aab0e0aab5e0ab802c2028e0abaa2920e0aa95e0aaaae0aabee0aab320e0aaa6e0aaace0aabee0aab5e0aab5e0ab81e0aa822028e0aab8e0aab0e0ab8de0aab5e0aab6e0aa95e0ab8de0aaa4e0aabfe0aaaee0aabee0aaa820e0aa85e0aab2e0ab8de0aab2e0aabee0aab920e0aab8e0aaaee0aa95e0ab8de0aab720e0aab5e0aabee0aab0e0aa82e0aab5e0aabee0aab020e0aab8e0aa9ce0aaa6e0ab8b20e0aa95e0aab0e0ab80e0aaa8e0ab87292c20e0aa85e0aaa8e0ab872028e0abab2920e0aaace0aabfe0aab8e0ab8de0aaaee0ab802de0aab2e0ab8de0aab2e0aabee0aab9e0aabfe0aab02de0aab0e0aab9e0aaaee0aabee0aaa8e0aabfe0aab02de0aab0e0aab9e0ab80e0aaae2028e0aaace0aab8e0aaaee0aab2e0aabee0aab93a20e0aa85e0aab2e0ab8de0aab2e0aabee0aab9e0aaa8e0aabe20e0aaa8e0aabee0aaaee0ab873b20e0aab8e0aab0e0ab8de0aab52de0aa89e0aaaae0aa95e0aabee0aab020e0aa95e0aab0e0aaa8e0aabee0aab02c20e0aab8e0aab0e0ab8de0aab52de0aaa6e0aaafe0aabee0aab3e0ab812920e0aab8e0aabee0aaa5e0ab8720e0aa85e0aab5e0aabee0aa9c20e0aa89e0aa82e0aa9ae0ab8b20e0aa95e0aab0e0aab5e0ab8b2e3c2f7072653e, 0x3c7072653e0d0ad8b1d988d98920d8a7d984d8b4d98ad8ae20d8a7d984d8b7d988d8b3d98a20d981d98a20d8aad987d8b0d98ad8a820d8a7d984d8a3d8add983d8a7d98520d988d985d8b5d8a8d8a7d8ad20d8a7d984d985d8aad987d8acd8af20d8b9d98620d8a7d984d8a5d985d8a7d98520d8a7d984d8add8b3d98620d8a7d984d8b9d8b3d983d8b1d98a2028d8b9d984d98ad98720d8a7d984d8b3d984d8a7d9852920d982d8a7d9843a20d8b9d984d8a7d985d8a7d8aa20d8a7d984d985d8a4d985d98620d8aed985d8b33a2028312920d8b5d984d8a7d8a920d8a5d8add8afd98920d988d8aed985d8b3d98ad98620d8b1d983d8b9d8a93a20d8b3d8a8d8b920d8b9d8b4d8b1d8a920d8b1d983d8b9d8a920d985d98620d8a7d984d981d8b1d8a7d8a6d8b620d988d8a3d8b1d8a8d8b920d988d8abd984d8a7d8abd98ad98620d8b1d983d8b9d8a920d985d98620d8a7d984d986d988d8a7d981d984d88c2028322920d8b2d98ad8a7d8b1d8a920d8a7d984d8add8b3d98ad9862028d8b9d984d98ad98720d8a7d984d8b3d984d8a7d9852920d981d98a20d8a7d984d8b9d8b4d8b1d98ad98620d985d98620d8b5d981d8b1d88c2028332920d8a7d984d8aad8aed8aad98520d981d98a20d8a7d984d98ad985d986d989d88c2028342920d988d8b6d8b920d8a7d984d8acd8a8d98ad98620d8b9d984d98920d8a7d984d8acd8a8d987d8a9d88c2028352920d8b1d981d8b920d8a7d984d8b5d988d8aa20d8a8d8a8d8b3d98520d8a7d984d984d98720d8a7d984d8b1d8add985d98620d8a7d984d8b1d8add98ad9852e3c2f7072653e, '2025-04-16 07:41:30', '2025-04-16 07:41:30', NULL),
(9, 1, 'Ziyarat e Arbaeen', 0x3c703e5a6979617261742065204172626165656e3c2f703e, 0x3c703e5a6979617261742065204172626165656e3c2f703e, 0x3c703e5a6979617261742065204172626165656e3c2f703e, 0x3c703e5a6979617261742065204172626165656e3c2f703e, '2025-04-16 07:42:02', '2025-04-16 07:42:02', NULL),
(10, 1, 'Ziyarat e Ashura', 0x3c703e5a6979617261742065204173687572613c2f703e, 0x3c703e5a6979617261742065204173687572613c2f703e, 0x3c703e5a6979617261742065204173687572613c2f703e, 0x3c703e5a6979617261742065204173687572613c2f703e, '2025-04-16 07:42:18', '2025-04-16 07:42:18', NULL),
(11, 1, '3rd Ziyarat of Imam Mahdi (a.t.f...', 0x3c703e337264205a697961726174206f6620496d616d204d616864692028612e742e662e2e2e3c2f703e, 0x3c703e337264205a697961726174206f6620496d616d204d616864692028612e742e662e2e2e3c2f703e, 0x3c703e337264205a697961726174206f6620496d616d204d616864692028612e742e662e2e2e3c2f703e, 0x3c703e337264205a697961726174206f6620496d616d204d616864692028612e742e662e2e2e3c2f703e, '2025-04-16 07:42:29', '2025-04-16 07:42:29', NULL),
(12, 1, 'Ziyarat e Waritha', 0x3c703e5a697961726174206520576172697468613c2f703e, 0x3c703e5a697961726174206520576172697468613c2f703e, 0x3c703e5a697961726174206520576172697468613c2f703e, 0x3c703e5a697961726174206520576172697468613c2f703e, '2025-04-16 07:42:45', '2025-04-16 07:42:45', NULL),
(13, 1, 'Ziyarat e Taziyah', 0x3c703e5a69796172617420652054617a697961683c2f703e, 0x3c703e5a69796172617420652054617a697961683c2f703e, 0x3c703e5a69796172617420652054617a697961683c2f703e, 0x3c703e5a69796172617420652054617a697961683c2f703e, '2025-04-16 07:43:00', '2025-04-16 07:43:00', NULL),
(14, 1, 'Ziyarat e Jameah Sagheerah', 0x3c703e5a6979617261742065204a616d656168205361676865657261683c2f703e, 0x3c703e5a6979617261742065204a616d656168205361676865657261683c2f703e, 0x3c703e5a6979617261742065204a616d656168205361676865657261683c2f703e, 0x3c703e5a6979617261742065204a616d656168205361676865657261683c2f703e, '2025-04-16 07:43:14', '2025-04-16 07:43:14', NULL),
(15, 1, 'Ziyarat e Nahiya', 0x3c703e5a6979617261742065204e61686979613c2f703e, 0x3c703e5a6979617261742065204e61686979613c2f703e, 0x3c703e5a6979617261742065204e61686979613c2f703e, 0x3c703e2d5a6979617261742065204e61686979613c2f703e, '2025-04-16 07:43:32', '2025-04-16 07:43:32', NULL),
(16, 2, 'Ayah Isme Aazam', 0x3c703e417961682049736d652041617a616d3c2f703e, 0x3c703e417961682049736d652041617a616d3c2f703e, 0x3c703e417961682049736d652041617a616d3c2f703e, 0x3c703e417961682049736d652041617a616d3c2f703e, '2025-04-16 07:47:17', '2025-04-16 07:47:17', NULL),
(17, 2, 'Dua Aaliyah al Mazameen', 0x3c703e4475612041616c6979616820616c204d617a616d65656e3c2f703e, 0x3c703e4475612041616c6979616820616c204d617a616d65656e3c2f703e, 0x3c703e4475612041616c6979616820616c204d617a616d65656e3c2f703e, 0x3c703e4475612041616c6979616820616c204d617a616d65656e3c2f703e, '2025-04-16 07:47:39', '2025-04-16 07:47:39', NULL),
(18, 2, 'Dua Adilah', 0x3c703e54686520666f6c6c6f77696e6720737570706c696361746f72792070726179657273206172652071756f7465642066726f6d20636f6e736964657261626c65207265666572656e636520626f6f6b733a3c2f703e0d0a0d0a3c703e546865207265766572656e742053617979696420416c69204b68616e20616c2d53686972617a69202d206d617920416c6c6168262333393b7320706c65617375726520626520776974682068696d202d20686173206d656e74696f6e656420696e2068697320626f6f6b206f6620616c2d4b616c696d20616c2d546179796962207468617420416c6d696768747920416c6c6168262333393b73204772656174657374204e616d652028616c69736d20616c2d61262333393b7a616d29207374616e647320666f7220656163682073746174656d656e74207468617420626567696e7320776974682074686520776f726420266c6471756f3b416c6c616826726471756f3b20616e6420656e647320757020776974682074686520776f7264202671756f743b6875776120284865292c2671756f743b2070726f76696465642074686174207468652073746174656d656e742028696e204172616269632920626520656d707479206f6620616e7920646f74746564206c657474657220616e642074686174206974732072656369746174696f6e20646f6573206e6f74206368616e6765207768657468657220697420697320706172736564206f72206e6f742e20537563682073746174656d656e74732063616e20626520666f756e6420696e2074686520486f6c7920517572262333393b616e20696e206669766520766572736573206f66206669766520646966666572656e74205375726168733a20616c2d426171617261682028323a323535292c20416c2dcabc496d72616e2028333a32292c20616c2d4e697361262333393b2028343a3837292c20546161686161202832303a38292c20616e6420616c2d546167686162756e202836343a3133292e20536861796b68e280a8616c2d4d6167687269626920736179732c202671756f743b4966206f6e6520626574616b657320746f207468657365206669766520766572736573206173206120737570706c696361746f727920707261796572207468617420697320726570656174656420656c6576656e2074696d65732061206461792c20616c6c206869732067656e6572616c20616e6420706172746963756c617220616666616972732077696c6c206265206d616465206561737920666f722068696d20776974686f75742064656c61792c20416c6c61682077696c6c696e672e2671756f743b2054686573652066697665207665727365732061726520617320666f6c6c6f77733a3c2f703e, 0x3c703ed982d8a7d8a8d98420d8b0daa9d8b120daa9d8aad8a7d8a8d988daba20d8b3db9220d8afd8b1d8ac20d8b0db8cd98420d8afd8b9d8a7d8a6db8cdb8120d8afd8b9d8a7d8a6db8cdaba20d986d982d98420daa9db8c20daafd8a6db8c20db81db8cdabadb943c2f703e0d0a0d0a3c703ed8b9d8b2d8aa20d985d8a2d8a820d8b3db8cd8af20d8b9d984db8c20d8aed8a7d98620d8a7d984d8b4db8cd8b1d8a7d8b2db8c20d986db9220d8a7d9bed986db8c20daa9d8aad8a7d8a820d8a7d984daa9d984d98520d8a7d984d8b7db8cd8a820d985db8cdaba20d8b0daa9d8b120daa9db8cd8a720db81db9220daa9db8120d8a7d984d984db8120d8aad8b9d8a7d984db8cd9b020daa9d8a720d8b3d8a820d8b3db9220d8a8da91d8a720d986d8a7d9852028d8a7d984d8b2d98520d8a7d984d8b9d8b2d9852920db81d8b120d8a7d8b320d982d988d98420daa9db9220d984db8cdb9220db81db9220d8acd98820d984d981d8b8202671756f743bd8a7d984d984db812671756f743b20d8b3db9220d8b4d8b1d988d8b920db81d988d8aad8a720db81db9220d8a7d988d8b120d984d981d8b8202671756f743bd8add988d8a72671756f743b20d9bed8b120d8aed8aad98520db81d988d8aad8a720db81db9220d8a8d8b4d8b1d8b7db8cdaa9db8120d8b9d8b1d8a8db8c20daa9d8a720daa9d988d8a6db8c20d8a8dabedb8c20d8add8b1d98120db81d988db9420daa9db8120d8a7d8b320daa9db8c20d8aad984d8a7d988d8aa20d985db8cdaba20daa9d988d8a6db8c20d8aad8a8d8afdb8cd984db8c20d986db81db8cdaba20d8a2d8aadb8c20da86d8a7db81db9220d8a7d8b320daa9db8c20d8aad8b5d8b1db8cd98120daa9db8c20d8acd8a7d8a6db9220db8cd8a720d986db8120daa9db8c20d8acd8a7d8a6db92db9420d8a7d8b320d8b7d8b1d8ad20daa9db9220d8a8db8cd8a7d986d8a7d8aa20d982d8b1d8a2d98620daa9d8b1db8cd98520d985db8cdaba20d9bed8a7d986da8620d985d8aed8aad984d98120d8b3d988d8b1d8aad988daba20daa9db8c20d9bed8a7d986da8620d8a2db8cd8a7d8aa20d985db8cdaba20d985d98420d8b3daa9d8aadb9220db81db8cdaba3a20d8a7d984d8a8d982d8b1db812028323a32353529d88c20d8a2d98420d8b9d985d8b1d8a7d9862028333a3229d88c20d8a7d984d986d8b3d8a7d8a12028343a383729d88c20d8b7db81d9b0202832303a382920d8a7d988d8b120d8a7d984d8b7d8a7d8bad8a8d988d986202836343a313329db9420d8b4db8cd8ae20d985d8bad8b1d8a8db8c20daa9db81d8aadb9220db81db8cdaba3a202671756f743bd8a7daafd8b120daa9d988d8a6db8c20d8a7d98620d9bed8a7d986da8620d8a2db8cd8a7d8aa20daa9d98820d8a8d8b7d988d8b120d8afd8b9d8a7d8a6db8cdb8120d8afd8b9d8a720daa9d8b1db9220d8acd98820d8afd98620d985db8cdaba20daafdb8cd8a7d8b1db8120d985d8b1d8aad8a8db8120d9beda91dabedb8c20d8acd8a7d8aadb8c20db81db9220d8aad98820d8a7d8b320daa9db9220d8aad985d8a7d98520d8b9d985d988d985db8c20d8a7d988d8b120d8aed8a7d8b520d8a7d985d988d8b120d8a8d8badb8cd8b120daa9d8b3db8c20d8aad8a7d8aedb8cd8b120daa9db9220d8a2d8b3d8a7d98620db81d98820d8acd8a7d8a6db8cdaba20daafdb92d88c20d8a7d986d8b4d8a7d8a120d8a7d984d984db81db942671756f743b20db8cdb8120d9bed8a7d986da8620d8a2db8cd8a7d8aa20d8afd8b1d8ac20d8b0db8cd98420db81db8cdabadb943c2f703e, 0x3c703ee0aaa8e0ab80e0aa9ae0ab87e0aaa8e0ab8020e0aaaae0ab8de0aab0e0aabee0aab0e0ab8de0aaa5e0aaa8e0aabee0aa9320e0aaa8e0ab8be0aa82e0aaa7e0aaaae0aabee0aaa4e0ab8de0aab020e0aab8e0aa82e0aaa6e0aab0e0ab8de0aaad20e0aaaae0ab81e0aab8e0ab8de0aaa4e0aa95e0ab8be0aaaee0aabee0aa82e0aaa5e0ab8020e0aa9fe0aabee0aa82e0aa95e0aab5e0aabee0aaaee0aabee0aa8220e0aa86e0aab5e0ab8020e0aa9be0ab872e3c2f703e0d0a0d0a3c703ee0aa86e0aaa6e0aab0e0aaa3e0ab80e0aaaf20e0aab8e0ab88e0aaafe0aaa620e0aa85e0aab2e0ab8020e0aa96e0aabee0aaa820e0aa85e0aab22de0aab6e0aabfe0aab0e0aabee0aa9de0ab80202d20e0aa85e0aab2e0ab8de0aab2e0aabee0aab9e0aaa8e0ab8020e0aa96e0ab81e0aab6e0ab8020e0aaa4e0ab87e0aaaee0aaa8e0aabe20e0aaaae0aab020e0aab0e0aab9e0ab87202d20e0aa8f20e0aaa4e0ab87e0aaaee0aaa8e0aabe20e0aaaae0ab81e0aab8e0ab8de0aaa4e0aa9520e0aa85e0aab22de0aa95e0aabee0aab2e0ab80e0aaae20e0aa85e0aab22de0aaa4e0ab88e0aaafe0aaace0aaaee0aabee0aa8220e0aa89e0aab2e0ab8de0aab2e0ab87e0aa9620e0aa95e0aab0e0ab8de0aaafe0ab8b20e0aa9be0ab8720e0aa95e0ab8720e0aab8e0aab0e0ab8de0aab5e0aab6e0aa95e0ab8de0aaa4e0aabfe0aaaee0aabee0aaa820e0aa85e0aab2e0ab8de0aab2e0aabee0aab9e0aaa8e0ab81e0aa8220e0aaaee0aab9e0aabee0aaa820e0aaa8e0aabee0aaae2028e0aa85e0aab2e0aabfe0aa9de0aaae20e0aa85e0aab22de0aa86e0aa9de0aaae2920e0aa8f20e0aaa6e0aab0e0ab87e0aa9520e0aab5e0aabee0aa95e0ab8de0aaafe0aaa8e0ab81e0aa8220e0aaaae0ab8de0aab0e0aaa4e0aabfe0aaa8e0aabfe0aaa7e0aabfe0aaa4e0ab8de0aab520e0aa95e0aab0e0ab8720e0aa9be0ab8720e0aa9ce0ab87202671756f743be0aa85e0aab2e0ab8de0aab2e0aabee0aab92671756f743b20e0aab6e0aaace0ab8de0aaa6e0aaa5e0ab8020e0aab6e0aab0e0ab8220e0aaa5e0aabee0aaaf20e0aa9be0ab8720e0aa85e0aaa8e0ab87202671756f743be0aab9e0ab81e0aab5e0aabe2028e0aaa4e0ab87292671756f743b20e0aab6e0aaace0ab8de0aaa620e0aab8e0aabee0aaa5e0ab8720e0aab8e0aaaee0aabee0aaaae0ab8de0aaa420e0aaa5e0aabee0aaaf20e0aa9be0ab872c20e0aaaae0aab0e0aa82e0aaa4e0ab8120e0aab6e0aab0e0aaa420e0aa8f20e0aa9be0ab8720e0aa95e0ab8720e0aab5e0aabee0aa95e0ab8de0aaaf2028e0aa85e0aab0e0aaace0ab80e0aaaee0aabee0aa822920e0aa95e0ab8be0aa88e0aaaae0aaa320e0aa9fe0aaaae0aa95e0aabee0aa82e0aab5e0aabee0aab3e0aabe20e0aa85e0aa95e0ab8de0aab7e0aab0e0ab8be0aaa5e0ab8020e0aaaee0ab81e0aa95e0ab8de0aaa420e0aab9e0ab8be0aaaf20e0aa85e0aaa8e0ab8720e0aaa4e0ab87e0aaa8e0ab81e0aa8220e0aaaae0aaa0e0aaa820e0aaace0aaa6e0aab2e0aabee0aaa4e0ab81e0aa8220e0aaa8e0aaa5e0ab802c20e0aaade0aab2e0ab8720e0aaa4e0ab87e0aaa8e0ab81e0aa8220e0aab5e0aabfe0aab6e0ab8de0aab2e0ab87e0aab7e0aaa320e0aa95e0aab0e0aab5e0aabee0aaaee0aabee0aa8220e0aa86e0aab5e0ab8720e0aa95e0ab8720e0aaa820e0aa95e0aab0e0aab5e0aabee0aaaee0aabee0aa8220e0aa86e0aab5e0ab872e20e0aa86e0aab5e0aabe20e0aaa8e0aabfe0aab5e0ab87e0aaa6e0aaa8e0ab8b20e0aaaae0aab5e0aabfe0aaa4e0ab8de0aab020e0aa95e0ab81e0aab0e0aabee0aaa8e0aaaee0aabee0aa8220e0aaaae0aabee0aa82e0aa9a20e0aa85e0aab2e0aa972de0aa85e0aab2e0aa9720e0aab8e0ab81e0aab0e0aabee0aa93e0aaa8e0ab8020e0aaaae0aabee0aa82e0aa9a20e0aa9be0aa82e0aaa6e0ab8be0aaaee0aabee0aa8220e0aa9ce0ab8be0aab5e0aabe20e0aaaee0aab3e0ab8720e0aa9be0ab873a20e0aa85e0aab22de0aaace0aa95e0aab0e0aabee0aab92028323a323535292c20e0aa85e0aab22de0aa88e0aaaee0aab0e0aabee0aaa82028333a32292c20e0aa85e0aab22de0aaa8e0aabfe0aab8e0aabe262333393b2028343a3837292c20e0aaa4e0aabee0aab9e0aabe202832303a38292c20e0aa85e0aaa8e0ab8720e0aa85e0aab22de0aaa4e0aa97e0aabee0aaace0ab81e0aaa8202836343a3133292e20e0aab6e0ab87e0aa96e0aab22de0aaaee0aa97e0aab0e0aabfe0aaace0ab8020e0aa95e0aab9e0ab8720e0aa9be0ab872c202671756f743be0aa9ce0ab8b20e0aa95e0ab8be0aa8820e0aa8620e0aaaae0aabee0aa82e0aa9a20e0aa86e0aaafe0aaa4e0ab8be0aaa8e0ab8720e0aaa6e0aabfe0aab5e0aab8e0aaaee0aabee0aa8220e0aa85e0aa97e0aabfe0aaafe0aabee0aab020e0aab5e0aa96e0aaa420e0aaaae0ab81e0aaa8e0aab0e0aabee0aab5e0aab0e0ab8de0aaa4e0aabfe0aaa420e0aaaae0ab8de0aab0e0aabee0aab0e0ab8de0aaa5e0aaa8e0aabe20e0aaa4e0aab0e0ab80e0aa95e0ab8720e0aab2e0ab872c20e0aaa4e0ab8b20e0aaa4e0ab87e0aaa8e0aabe20e0aaace0aaa7e0aabe20e0aab8e0aabee0aaaee0aabee0aaa8e0ab8de0aaaf20e0aa85e0aaa8e0ab8720e0aa96e0aabee0aab820e0aa95e0aabee0aab0e0ab8de0aaafe0ab8b20e0aaa4e0ab87e0aaa8e0aabe20e0aaaee0aabee0aa9fe0ab8720e0aab5e0aabfe0aab2e0aa82e0aaac20e0aa95e0aab0e0ab8de0aaafe0aabe20e0aab5e0aabfe0aaa8e0aabe20e0aab8e0aab0e0aab320e0aaa5e0aa8820e0aa9ce0aab6e0ab872c20e0aa85e0aab2e0ab8de0aab2e0aabee0aab9e0aaa8e0ab8020e0aa87e0aa9ae0ab8de0aa9be0aabe20e0aa9be0ab872e2671756f743b20e0aa8620e0aaaae0aabee0aa82e0aa9a20e0aab6e0ab8de0aab2e0ab8be0aa95e0ab8b20e0aaa8e0ab80e0aa9ae0ab8720e0aaaee0ab81e0aa9ce0aaac20e0aa9be0ab873a3c2f703e, 0x3c703ed8a7d984d8a3d8afd8b9d98ad8a920d8a7d984d8aad8a7d984d98ad8a920d985d982d8aad8a8d8b3d8a920d985d98620d983d8aad8a820d985d8b1d8acd8b9d98ad8a920d985d987d985d8a92e3c2f703e0d0a0d0a3c703ed988d982d8af20d8b0d983d8b120d8b3d985d8a7d8add8a920d8a7d984d8b3d98ad8af20d8b9d984d98a20d8aed8a7d98620d8a7d984d8b4d98ad8b1d8a7d8b2d98a202dd8b1d8b6d98a20d8a7d984d984d98720d8b9d986d9872d20d981d98a20d983d8aad8a7d8a8d987202671756f743bd8a7d984d983d984d98520d8a7d984d8b7d98ad8a82671756f743b20d8a3d98620d8a7d8b3d98520d8a7d984d984d98720d8a7d984d8a3d8b9d8b8d98520d987d98820d983d98420d983d984d985d8a920d8aad8a8d8afd8a320d8a8d983d984d985d8a9202671756f743bd8a7d984d984d9872671756f743b20d988d8aad986d8aad987d98a20d8a8d983d984d985d8a9202671756f743bd987d9882671756f743bd88c20d8a8d8b4d8b1d8b720d8a3d98620d8aad983d988d98620d8aed8a7d984d98ad8a920d985d98620d8a3d98a20d8add8b1d98120d985d986d982d8b7d88c20d988d8a3d98620d984d8a720d8aad8aad8bad98ad8b120d982d8b1d8a7d8a1d8aad987d8a720d8b3d988d8a7d8a120d8a3d981d8b3d8add8aa20d8a3d98520d984d98520d8a3d981d8b3d8ad2e20d98ad985d983d98620d8a7d984d8b9d8abd988d8b120d8b9d984d98920d985d8abd98420d987d8b0d98720d8a7d984d8b9d8a8d8a7d8b1d8a7d8aa20d981d98a20d8a7d984d982d8b1d8a2d98620d8a7d984d983d8b1d98ad98520d981d98a20d8aed985d8b320d8a2d98ad8a7d8aa20d985d98620d8aed985d8b320d8b3d988d8b120d985d8aed8aad984d981d8a93a20d8a7d984d8a8d982d8b1d8a92028323a32353529d88c20d8a2d98420d8b9d985d8b1d8a7d9862028333a3229d88c20d8a7d984d986d8b3d8a7d8a12028343a383729d88c20d8b7d987202832303a3829d88c20d988d8a7d984d8aad8bad8a7d8a8d986202836343a3133292e20d982d8a7d98420d8a7d984d8b4d98ad8ae20d8a7d984d985d8bad8b1d8a8d98a3a20d985d98620d8a7d8aad8aed8b020d987d8b0d98720d8a7d984d8a2d98ad8a7d8aa20d8a7d984d8aed985d8b320d8afd8b9d8a7d8a1d98b20d98ad983d8b1d8b1d98720d981d98a20d8a7d984d98ad988d98520d8a5d8add8afd98920d8b9d8b4d8b1d8a920d985d8b1d8a920d981d8a5d986d98720d98ad8b3d987d98420d8b9d984d98ad98720d8acd985d98ad8b920d8a3d985d988d8b1d98720d8b9d8a7d985d8a920d988d8aed8a7d8b5d8a920d985d98620d8bad98ad8b120d8aad8a3d8aed98ad8b120d8a5d98620d8b4d8a7d8a120d8a7d984d984d9872e20d988d987d8b0d98720d8a7d984d8a3d8a8d98ad8a7d8aa20d8a7d984d8aed985d8b320d987d98a20d983d985d8a720d98ad984d98a3a3c2f703e, '2025-04-16 07:48:50', '2025-04-16 07:48:50', NULL),
(19, 2, 'Dua e Hujjah', 0x3c703e44756120652048756a6a61683c2f703e, 0x3c703e44756120652048756a6a61683c2f703e, 0x3c703e44756120652048756a6a61683c2f703e, 0x3c703e44756120652048756a6a61683c2f703e, '2025-04-16 07:49:18', '2025-04-16 07:49:18', NULL),
(20, 2, 'Dua e Mahdi', 0x3c703e4475612065204d616864693c2f703e, 0x3c703e4475612065204d616864693c2f703e, 0x3c703e4475612065204d616864693c2f703e, 0x3c703e4475612065204d616864693c2f703e, '2025-04-16 07:49:35', '2025-04-16 07:49:35', NULL),
(21, 2, 'Dua Allahumma Asleh', 0x3c703e44756120416c6c6168756d6d612041736c65683c2f703e, 0x3c703e44756120416c6c6168756d6d612041736c65683c2f703e, 0x3c703e44756120416c6c6168756d6d612041736c65683c2f703e, 0x3c703e44756120416c6c6168756d6d612041736c65683c2f703e, '2025-04-16 07:49:48', '2025-04-16 07:49:48', NULL),
(22, 2, 'Dua Alqamah', 0x3c703e44756120416c71616d61683c2f703e, 0x3c703e44756120416c71616d61683c2f703e, 0x3c703e44756120416c71616d61683c2f703e, 0x3c703e44756120416c71616d61683c2f703e, '2025-04-16 07:50:01', '2025-04-16 07:50:01', NULL),
(23, 3, 'Mahine ki Awwal amal', 0x3c703e447561205361686966612d652d53616a6a61646979612d34332070616468652e3c2f703e, 0x3c703e447561205361686966612d652d53616a6a61646979612d34332070616468652e3c2f703e, 0x3c703e447561205361686966612d652d53616a6a61646979612d34332070616468652e3c2f703e, 0x3c703e447561205361686966612d652d53616a6a61646979612d34332070616468652e3c2f703e, '2025-04-16 07:51:43', '2025-04-16 07:51:43', NULL),
(24, 3, 'Hafto\'n ke din ke Amaal', 0x3c703e486166746f262333393b6e206b652064696e206b6520416d61616c3c2f703e, 0x3c703e486166746f262333393b6e206b652064696e206b6520416d61616c3c2f703e, 0x3c703e486166746f262333393b6e206b652064696e206b6520416d61616c3c2f703e, 0x3c703e486166746f262333393b6e206b652064696e206b6520416d61616c3c2f703e, '2025-04-16 07:52:03', '2025-04-16 07:52:03', NULL),
(25, 3, 'Amaal-e-Juma', 0x3c703e416d61616c2d652d4a756d613c2f703e, 0x3c703e416d61616c2d652d4a756d613c2f703e, 0x3c703e416d61616c2d652d4a756d613c2f703e, 0x3c703e416d61616c2d652d4a756d613c2f703e, '2025-04-16 07:52:20', '2025-04-16 07:52:20', NULL),
(26, 3, 'Amaal-e-Nawroz', 0x3c703e416d61616c2d652d4e6177726f7a3c2f703e, 0x3c703e416d61616c2d652d4e6177726f7a3c2f703e, 0x3c703e416d61616c2d652d4e6177726f7a3c2f703e, 0x3c703e416d61616c2d652d4e6177726f7a3c2f703e, '2025-04-16 07:52:38', '2025-04-16 07:52:38', NULL),
(27, 3, 'Mahe Muharrum', 0x3c703e4d616865204d7568617272756d3c2f703e, 0x3c703e4d616865204d7568617272756d3c2f703e, 0x3c703e4d616865204d7568617272756d3c2f703e, 0x3c703e4d616865204d7568617272756d3c2f703e, '2025-04-16 07:52:56', '2025-04-16 07:52:56', NULL),
(28, 3, 'Mahe Safar', 0x3c703e4d6168652053616661723c2f703e, 0x3c703e4d6168652053616661723c2f703e, 0x3c703e4d6168652053616661723c2f703e, 0x3c703e4d6168652053616661723c2f703e, '2025-04-16 07:53:07', '2025-04-16 07:53:07', NULL),
(29, 3, 'Mahe Rabi-ul-Awwal', 0x3c703e4d61686520526162692d756c2d417777616c3c2f703e, 0x3c703e4d61686520526162692d756c2d417777616c3c2f703e, 0x3c703e4d61686520526162692d756c2d417777616c3c2f703e, 0x3c703e4d61686520526162692d756c2d417777616c3c2f703e, '2025-04-16 07:53:20', '2025-04-16 07:53:20', NULL),
(30, 3, 'Mahe Rabi-us-Saani', 0x3c703e4d61686520526162692d75732d5361616e693c2f703e, 0x3c703e4d61686520526162692d75732d5361616e693c2f703e, 0x3c703e4d61686520526162692d75732d5361616e693c2f703e, 0x3c703e4d61686520526162692d75732d5361616e693c2f703e, '2025-04-16 07:53:32', '2025-04-16 07:53:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` smallint(5) UNSIGNED DEFAULT 2 COMMENT '1-Admin, 2-User',
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 0 COMMENT '0-Pending, 1-Active, 2-Deactivate',
  `is_complete_profile` tinyint(4) DEFAULT 0 COMMENT '0-no, 1-yes',
  `login_type` tinyint(4) DEFAULT 0 COMMENT '0-Email, 1-Google, 2-Facebook',
  `social_id` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reset_code` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `country_code`, `phone_number`, `photo`, `is_active`, `is_complete_profile`, `login_type`, `social_id`, `email_verified_at`, `password`, `reset_code`, `remember_token`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Admin', 'admin@laravel11.com', NULL, NULL, NULL, 1, 0, 0, NULL, '2025-04-10 23:09:44', '$2y$12$3rahpdWWSxhz7Bt4q6p2wu62lTm88Q3FgpLin8nnwutQVH/x5fwve', NULL, NULL, '2025-04-10 23:09:44', '2025-04-10 23:09:44', NULL),
(2, 2, NULL, NULL, '91', '6359220319', NULL, 1, 0, 0, NULL, NULL, NULL, NULL, NULL, '2025-04-14 03:29:19', '2025-04-14 03:29:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_login_devices`
--

CREATE TABLE `user_login_devices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'user table id',
  `fcm_token` text DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL COMMENT 'Android, iOS',
  `device_model` varchar(255) DEFAULT NULL,
  `device_manufacture` varchar(255) DEFAULT NULL,
  `device_os_version` varchar(255) DEFAULT NULL,
  `login_date` datetime DEFAULT NULL,
  `logout_date` datetime DEFAULT NULL,
  `is_signout` tinyint(4) DEFAULT 0 COMMENT '0- No, 1- Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_registrations`
--

CREATE TABLE `volunteer_registrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `profession` varchar(255) NOT NULL,
  `caravan_type` varchar(255) NOT NULL,
  `join_from` varchar(255) NOT NULL,
  `visited_before` varchar(255) NOT NULL,
  `additional_comments` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `volunteer_registrations`
--

INSERT INTO `volunteer_registrations` (`id`, `full_name`, `email`, `phone_number`, `profession`, `caravan_type`, `join_from`, `visited_before`, `additional_comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Mohammedali Budhwani', 'mbudhwani327@gmail.com', '+91 87555 80525', 'Doctor', 'Ground Package', 'Najaf', 'Many Times', 'Please assign near Haram.', '2025-04-14 05:11:06', '2025-04-14 05:11:06', NULL),
(2, 'Mohammedali Budhwani testtttt1111', 'mbudhwani3271111@gmail.com', '+91 87555 80525', 'Doctor', 'Ground Package', 'Najaf', 'Many Times', 'Please assign near Haram.', '2025-04-14 05:11:57', '2025-04-14 05:11:57', NULL),
(3, 'sonali', 'sonali@gmail.com', '+91 87555 805455', 'Doctor', 'Ground Package', 'Najaf', 'Many Times', 'Please assign near Haram.', '2025-04-14 05:20:50', '2025-04-14 05:20:50', NULL),
(4, 'sonali 111111', 'secondsonali@gmail.com', '+91 87555 605455', 'Doctor', 'Ground Package', 'Najaf', 'Many Times', 'Please assign near Haram.', '2025-04-14 05:21:37', '2025-04-14 05:21:37', NULL),
(5, 'first', 'first@gmail.com', '+91 87555 80525', 'Doctor', 'Ground Package', 'Najaf', 'Many Times', 'Please assign near Haram.', '2025-04-14 06:42:35', '2025-04-14 06:42:35', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `assistance`
--
ALTER TABLE `assistance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ayat_quran`
--
ALTER TABLE `ayat_quran`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ayat_quran_surah_id_foreign` (`surah_id`);

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_pages`
--
ALTER TABLE `cms_pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_user_id_foreign` (`user_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `faqs`
--
ALTER TABLE `faqs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `live_program`
--
ALTER TABLE `live_program`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `near_by_facilities`
--
ALTER TABLE `near_by_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_sender_id_foreign` (`sender_id`);

--
-- Indexes for table `notification_receivers`
--
ALTER TABLE `notification_receivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_receivers_notification_id_foreign` (`notification_id`),
  ADD KEY `notification_receivers_receiver_id_foreign` (`receiver_id`);

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
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `surahs_quran`
--
ALTER TABLE `surahs_quran`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_guides`
--
ALTER TABLE `travel_guides`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_role_id_foreign` (`role_id`);

--
-- Indexes for table `user_login_devices`
--
ALTER TABLE `user_login_devices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_login_devices_user_id_foreign` (`user_id`);

--
-- Indexes for table `volunteer_registrations`
--
ALTER TABLE `volunteer_registrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assistance`
--
ALTER TABLE `assistance`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `ayat_quran`
--
ALTER TABLE `ayat_quran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cms_pages`
--
ALTER TABLE `cms_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=247;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `faqs`
--
ALTER TABLE `faqs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `live_program`
--
ALTER TABLE `live_program`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `near_by_facilities`
--
ALTER TABLE `near_by_facilities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_receivers`
--
ALTER TABLE `notification_receivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `surahs_quran`
--
ALTER TABLE `surahs_quran`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `travel_guides`
--
ALTER TABLE `travel_guides`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user_login_devices`
--
ALTER TABLE `user_login_devices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `volunteer_registrations`
--
ALTER TABLE `volunteer_registrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ayat_quran`
--
ALTER TABLE `ayat_quran`
  ADD CONSTRAINT `ayat_quran_surah_id_foreign` FOREIGN KEY (`surah_id`) REFERENCES `surahs_quran` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_sender_id_foreign` FOREIGN KEY (`sender_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notification_receivers`
--
ALTER TABLE `notification_receivers`
  ADD CONSTRAINT `notification_receivers_notification_id_foreign` FOREIGN KEY (`notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `notification_receivers_receiver_id_foreign` FOREIGN KEY (`receiver_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_login_devices`
--
ALTER TABLE `user_login_devices`
  ADD CONSTRAINT `user_login_devices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
