-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 28, 2025 at 04:19 PM
-- Server version: 10.6.22-MariaDB
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appwebdemo_md`
--

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
(5, '2025_05_19_171107_create_properties_table', 1),
(6, '2025_05_19_173237_create_gallery_table', 1),
(7, '2025_05_22_000503_alter_properties_table_add_more_fields', 2),
(8, '2025_05_23_185009_alter_properties_table_add_more_fields', 3);

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
(4, 'App\\Models\\User', 1, 'api-token', '5aab51b610ab99a1584c498fd972e311145291f9008b41d9ba2ebc92e4389861', '[\"*\"]', NULL, NULL, '2025-05-19 18:46:41', '2025-05-19 18:46:41'),
(5, 'App\\Models\\User', 1, 'api-token', '93362bee18951bda197461e61d42dbb7f7de421558b8ff00b4d2d96da9acd123', '[\"*\"]', '2025-05-19 18:51:33', NULL, '2025-05-19 18:50:07', '2025-05-19 18:51:33'),
(6, 'App\\Models\\User', 1, 'api-token', '6eaf2d3453d03647ef941b5b257e3ce153c232bb2173fae0b844a32b996b2d9a', '[\"*\"]', '2025-05-22 11:07:44', NULL, '2025-05-22 11:07:29', '2025-05-22 11:07:44');

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `pricing` decimal(10,2) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `date_range` varchar(255) DEFAULT NULL,
  `airbnb` decimal(10,2) DEFAULT NULL,
  `capitalvac` decimal(10,2) DEFAULT NULL,
  `discounted` decimal(8,2) DEFAULT NULL,
  `disc_percent` decimal(10,0) DEFAULT NULL,
  `beds` tinyint(4) DEFAULT NULL,
  `baths` tinyint(4) DEFAULT NULL,
  `area` smallint(6) DEFAULT NULL,
  `interest` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`interest`)),
  `status` enum('available','occupied','pending','sold','rented','under_maintenance','inactive','vacant','booking') NOT NULL DEFAULT 'available',
  `rules_and_regulations` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `property_type` enum('sell','rent') NOT NULL DEFAULT 'rent',
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`id`, `property_name`, `type`, `location`, `latitude`, `longitude`, `pricing`, `phone`, `date_range`, `airbnb`, `capitalvac`, `discounted`, `disc_percent`, `beds`, `baths`, `area`, `interest`, `status`, `rules_and_regulations`, `description`, `property_type`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Vivian Fleming', 'Bungalow', 'USA', '38.6742286', '29.4058825', 100.00, '754121254558', '2025-05-20 - 2025-06-30', 90.00, 94.00, 8900.00, 11, 9, 4, 1999, '[\"pools,cont,\"]', 'booking', 'Ab praesentium neces', 'Reprehenderit quasi', 'rent', NULL, '2025-05-23 12:10:20', '2025-05-27 23:46:40'),
(3, 'Rina Grant', 'Apartment', 'Amsterdam, Netherlands', '52.3675734', '4.9041389', 70.00, NULL, '2025-07-13 - 2025-07-23', 55.00, 25.00, NULL, NULL, 5, 2, 1500, '[\"pools,club,work\"]', 'under_maintenance', 'Accusamus incididunt', 'Qui a consequatur I', 'rent', NULL, '2025-05-23 15:13:06', '2025-05-23 23:33:42'),
(8, 'Asher Baird', 'Resort', 'USA', '38.7945952', '-106.5348379', 26.00, '62', '2025-05-28 - 2025-05-28', 67.00, 65.00, NULL, NULL, 92, 16, NULL, '[\"Et ducimus aliqua\"]', 'available', 'Exercitationem ex of', 'Accusantium quis qui', 'rent', NULL, '2025-05-27 21:14:27', '2025-05-27 21:14:27'),
(9, 'Frances Dotson', 'Penthouse', 'Ohio, USA', '40.4172871', '-82.90712300000001', 60.00, '85', '2025-05-28 - 2025-05-28', 77.00, 60.00, NULL, NULL, 52, 35, NULL, '[\"Molestiae quaerat vo\"]', 'available', 'Id quis molestiae in', 'Obcaecati ex quo mag', 'rent', NULL, '2025-05-27 21:15:39', '2025-05-27 21:15:39'),
(10, 'Haley Farley', 'Residences', 'OKDONGSIK New York, East 30th Street, New York, NY, USA', '40.7456944', '-73.9853743', 21.00, '16', '2025-05-28 - 2025-05-28', 69.00, 41.00, NULL, NULL, 40, 94, NULL, '[\"Qui omnis quia eum a\"]', 'available', 'Voluptate nisi dolor', 'Mollit laudantium a', 'rent', NULL, '2025-05-27 21:16:26', '2025-05-27 21:16:26'),
(11, 'Dale Rhodes', 'Condo', 'Paris, France', '48.8575475', '2.3513765', 99.00, '46', '2025-05-26 - 2025-05-31', 36.00, 22.00, NULL, NULL, 48, 47, NULL, '[\"Dolores itaque eveni\"]', 'booking', 'Amet velit nostrud', 'Dolores do est velit', 'rent', NULL, '2025-05-27 21:17:17', '2025-05-27 23:44:32'),
(12, 'Abbot Ratliff', 'Bungalow', 'Dolores qui quos nih', NULL, NULL, 53.00, '9999996543', '2025-05-30 - 2025-06-16', 50.00, 18.00, NULL, NULL, 49, 36, NULL, '[\"Tempora expedita qui\"]', 'available', 'Laudantium modi sin', 'Minima qui tempore', 'rent', NULL, '2025-05-27 23:40:39', '2025-05-28 00:10:19');

-- --------------------------------------------------------

--
-- Table structure for table `property_galleries`
--

CREATE TABLE `property_galleries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `property_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `property_galleries`
--

INSERT INTO `property_galleries` (`id`, `property_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 1, 'img/gallery/5PfzZBrFXtcJ7FjItNh5.png', '2025-05-23 12:10:39', '2025-05-23 12:10:39'),
(2, 1, 'img/gallery/0HkaBtpa64lYLWYVuy77.png', '2025-05-23 12:10:39', '2025-05-23 12:10:39'),
(3, 1, 'img/gallery/8WPmTD3UJKKAdSUwsddp.png', '2025-05-23 12:10:39', '2025-05-23 12:10:39'),
(6, 3, 'img/gallery/RMj43FLv9pDY9fhoebU0.png', '2025-05-23 15:13:06', '2025-05-23 15:13:06'),
(7, 3, 'img/gallery/17hcLxsZzmeGp6reIr8f.png', '2025-05-23 15:13:06', '2025-05-23 15:13:06'),
(24, 8, 'img/gallery/hUi9K5I6yI3MmSl3ybg9.png', '2025-05-27 21:14:27', '2025-05-27 21:14:27'),
(25, 8, 'img/gallery/uNjewyQPNjYn53UTkppN.png', '2025-05-27 21:14:27', '2025-05-27 21:14:27'),
(26, 8, 'img/gallery/K8ReoEoDjAHmGeo43xcG.png', '2025-05-27 21:14:27', '2025-05-27 21:14:27'),
(27, 9, 'img/gallery/AdlpbFmtFa7kZJRI6u7L.png', '2025-05-27 21:15:39', '2025-05-27 21:15:39'),
(28, 9, 'img/gallery/9oXs76pthN7GOhCXJXnE.png', '2025-05-27 21:15:39', '2025-05-27 21:15:39'),
(29, 10, 'img/gallery/56xkQ31jPcO3gdcLlVou.png', '2025-05-27 21:16:26', '2025-05-27 21:16:26'),
(30, 10, 'img/gallery/Vndzh3fJGOZvoWxS8pzH.png', '2025-05-27 21:16:26', '2025-05-27 21:16:26'),
(31, 11, 'img/gallery/JoiCgpkL2sTo5k55AR0P.png', '2025-05-27 21:17:17', '2025-05-27 21:17:17'),
(32, 11, 'img/gallery/iexAD7VU3XPA3eM9FJ7V.png', '2025-05-27 21:17:17', '2025-05-27 21:17:17'),
(33, 12, 'img/gallery/yrMq5LXaZPd7WxKya0fj.png', '2025-05-27 23:40:39', '2025-05-27 23:40:39'),
(34, 12, 'img/gallery/SFW3SZrsDmdUrYo1VzfE.png', '2025-05-27 23:40:39', '2025-05-27 23:40:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `zip` varchar(20) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `phone`, `address`, `country`, `state`, `city`, `zip`, `image`, `bio`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Mario Davidson', '000000000', 'A-1163/Phase-1/Gulshan-e-Hadeed', 'Pakistan', 'Sindh', 'Karachi', '71000', 'img/profile_1_7hEsVuxzTR.png', 'My name is Mario Davidson', 'mariodavidson@gmail.com', NULL, '$2y$12$wELP5YkinzRgqkEGQ4F16.jmpI8rMeKnD.7RxphHgpRjylVDobyL2', NULL, NULL, '2025-05-27 20:47:12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_galleries`
--
ALTER TABLE `property_galleries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_galleries_property_id_foreign` (`property_id`);

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
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `property_galleries`
--
ALTER TABLE `property_galleries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `property_galleries`
--
ALTER TABLE `property_galleries`
  ADD CONSTRAINT `property_galleries_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
