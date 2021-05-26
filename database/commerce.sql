-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2021 at 07:20 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `commerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` int(11) NOT NULL,
  `name` varchar(180) NOT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Song', '1_b_051321.235212.52.png', 1, 1, '2021-05-13 17:52:12', '2021-05-13 17:52:12'),
(2, 'Samsung', '1_b_050621.194541.45.jpg', 1, 1, '2021-05-06 13:45:41', '2021-05-06 13:45:41'),
(3, 'Microsoft', '1_b_050621.194620.46.jpg', 1, 1, '2021-05-06 13:46:20', '2021-05-06 13:46:20'),
(4, 'One Plus', '1_b_050621.195101.51.jpg', 1, 1, '2021-05-06 13:51:01', '2021-05-06 13:51:01'),
(5, 'Nike', '1_b_051321.235233.52.png', 1, 1, '2021-05-13 17:52:33', '2021-05-13 17:52:33'),
(6, 'Dell', '1_b_051321.234742.47.png', 1, 1, '2021-05-13 17:47:42', '2021-05-13 17:47:42'),
(7, 'Cannon', '1_b_051321.234811.48.png', 1, 1, '2021-05-13 17:48:11', '2021-05-13 17:48:11'),
(8, 'Gucci', '1_b_051321.234832.48.png', 1, 1, '2021-05-13 17:48:32', '2021-05-13 17:48:32'),
(9, 'Asus', '1_b_051321.234851.48.png', 1, 1, '2021-05-13 17:48:51', '2021-05-13 17:48:51'),
(10, 'Lenovo', '1_b_051321.234909.49.png', 1, 1, '2021-05-13 17:49:09', '2021-05-13 17:49:09'),
(11, 'Rado', '1_b_051321.235015.50.png', 1, 1, '2021-05-13 17:50:15', '2021-05-13 17:50:15'),
(12, 'Adidas', '1_b_051321.235043.50.png', 1, 1, '2021-05-13 17:50:43', '2021-05-13 17:50:43'),
(13, 'Levis', '1_b_051321.235110.51.png', 1, 1, '2021-05-13 17:51:10', '2021-05-13 17:51:10');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(180) NOT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `image`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Mens Fashion', '1_c_050621.200203.02.jpg', 1, 1, '2021-05-13 13:58:41', '2021-05-13 13:58:41'),
(2, 'Computers & Accessories', '1_c_050621.200242.02.png', 1, 1, '2021-05-06 14:02:42', '2021-05-06 14:02:42'),
(3, 'Electronics & Home Appliances', '1_c_050621.200310.03.jpg', 1, 1, '2021-05-06 14:03:10', '2021-05-06 14:03:10'),
(4, 'Womens Fashion', '1_c_051321.235522.55.jpg', 1, 1, '2021-05-13 17:55:22', '2021-05-13 17:55:22'),
(5, 'Childs', '1_c_051321.235726.57.jpg', 1, 1, '2021-05-13 17:57:26', '2021-05-13 17:57:26'),
(6, 'Watch', '1_c_051421.000332.03.jpg', 1, 1, '2021-05-13 18:03:32', '2021-05-13 18:03:32'),
(7, 'Furniture', '1_c_051421.000400.04.jpeg', 1, 1, '2021-05-13 18:04:00', '2021-05-13 18:04:00'),
(8, 'Health', '1_c_051421.000536.05.jpg', 1, 1, '2021-05-13 18:05:36', '2021-05-13 18:05:36'),
(9, 'Beauty', '1_c_051421.000551.05.jpg', 1, 1, '2021-05-13 18:05:51', '2021-05-13 18:05:51'),
(10, 'Sports & Outdoor', '1_c_051421.000702.07.jpg', 1, 1, '2021-05-13 18:07:02', '2021-05-13 18:07:02'),
(11, 'Home & Living', '1_c_051421.000717.07.jpg', 1, 1, '2021-05-13 18:07:17', '2021-05-13 18:07:17');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` int(11) NOT NULL,
  `name` varchar(180) NOT NULL,
  `code` varchar(30) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `name`, `code`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Blue', '#0814F5', 1, '2021-05-06 14:13:06', '2021-05-06 14:13:06'),
(2, 'Gray', '#3F393F', 1, '2021-05-06 14:13:52', '2021-05-06 14:13:52'),
(3, 'Black', '#080707', 1, '2021-05-06 14:14:25', '2021-05-06 14:14:25'),
(4, 'Red', '#F10707', 1, '2021-05-06 14:14:39', '2021-05-06 14:14:39'),
(5, 'Light Blue', '#08F9E1', 1, '2021-05-06 14:15:01', '2021-05-06 14:15:01'),
(6, 'Green', '#092E02', 1, '2021-05-06 14:15:24', '2021-05-06 14:15:24'),
(7, 'Light Green', '#57F706', 1, '2021-05-06 14:15:39', '2021-05-06 14:15:39');

-- --------------------------------------------------------

--
-- Table structure for table `discount`
--

CREATE TABLE `discount` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `percentage` int(11) NOT NULL,
  `current_amount` int(11) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount`
--

INSERT INTO `discount` (`id`, `product_id`, `percentage`, `current_amount`, `start_date`, `end_date`, `created_by`, `created_at`, `updated_at`) VALUES
(3, 2, 50, 2750, '2021-05-21', '2021-05-25', 1, '2021-05-21 07:32:39', '2021-05-21 07:32:39');

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
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `features`
--

CREATE TABLE `features` (
  `id` int(11) NOT NULL,
  `name` varchar(180) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `features`
--

INSERT INTO `features` (`id`, `name`) VALUES
(1, 'Hot'),
(2, 'Latest'),
(3, 'Buy one Get one'),
(4, 'Eid Offer'),
(5, 'All in One');

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
(3, '2019_08_19_000000_create_failed_jobs_table', 1);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(180) NOT NULL,
  `details` text NOT NULL,
  `color_ids` text NOT NULL,
  `feature_ids` text NOT NULL,
  `image` text NOT NULL,
  `image_slider` text NOT NULL,
  `buying_price` int(100) NOT NULL,
  `selling_price` int(100) NOT NULL,
  `status` tinyint(6) NOT NULL,
  `discount_status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `brand_id`, `category_id`, `sub_category_id`, `name`, `code`, `details`, `color_ids`, `feature_ids`, `image`, `image_slider`, `buying_price`, `selling_price`, `status`, `discount_status`, `created_by`, `created_at`, `updated_at`) VALUES
(2, 5, 1, 1, 'LOWA Men’s Renegade GTX Mid Hiking Boots Review', '452342357', '<p align=\"center\">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae \r\ncondimentum erat. Vestibulum ante ipsum primis in faucibus orci luctus \r\net ultrices posuere cubilia Curae; Sed posuere, purus at efficitur \r\nhendrerit, augue elit lacinia arcu, a eleifend sem elit et nunc. Sed \r\nrutrum vestibulum est, sit amet cursus dolor fermentum vel. Suspendisse \r\nmi nibh, congue et ante et, commodo mattis lacus. Duis varius finibus \r\npurus sed venenatis. Vivamus varius metus quam, id dapibus velit mattis \r\neu. Praesent et semper risus. Vestibulum erat erat, condimentum at elit \r\nat, bibendum placerat orci. Nullam gravida velit mauris, in pellentesque\r\n urna pellentesque viverra. Nullam non pellentesque justo, et ultricies \r\nneque. Praesent vel metus rutrum, tempus erat a, rutrum ante. Quisque \r\ninterdum efficitur nunc vitae consectetur. Suspendisse venenatis, tortor\r\n non convallis interdum, urna mi molestie eros, vel tempor justo lacus \r\nac justo. Fusce id enim a erat fringilla sollicitudin ultrices vel \r\nmetus. </p>', '2,3', '1,2', '1_p_050821.204038.40.jpg', '1_p_1_2105082040385692.jpg,1_p_2_2105082040385703.jpg,1_p_3_2105082040385714.jpg,1_p_4_2105082040385725.jpg', 4000, 5500, 1, 1, 1, '2021-05-20 16:11:04', '2021-05-20 16:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `measurement` varchar(200) NOT NULL,
  `unit` varchar(180) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `creator` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `sub_category_id`, `measurement`, `unit`, `status`, `creator`, `created_at`, `updated_at`) VALUES
(1, 1, '6\'', 'Inch', 1, 1, '2021-05-06 14:05:06', '2021-05-06 14:05:06'),
(2, 1, '5\'', 'Inch', 1, 1, '2021-05-06 14:05:29', '2021-05-06 14:05:29'),
(3, 3, '16\'', 'Inch', 1, 1, '2021-05-06 14:07:53', '2021-05-06 14:07:53'),
(4, 3, '18\'5\'\'', 'Inch', 1, 1, '2021-05-06 14:08:19', '2021-05-06 14:08:19'),
(5, 2, '17\'', 'Inch', 1, 1, '2021-05-06 14:08:36', '2021-05-06 14:08:36'),
(6, 2, '18\'', 'Inch', 1, 1, '2021-05-06 14:09:02', '2021-05-06 14:09:02'),
(7, 1, '7\'', 'Inch', 1, 1, '2021-05-06 14:09:23', '2021-05-06 14:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `sub_title` text NOT NULL,
  `image` text NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `current_stock` int(160) NOT NULL,
  `stock_in` int(160) NOT NULL,
  `restock` int(160) NOT NULL,
  `status` tinyint(8) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `product_id`, `size_id`, `color_id`, `current_stock`, `stock_in`, `restock`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, 2, 3, 54, 0, 0, 0, 1, '2021-05-22 05:06:44', '2021-05-22 05:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `stock_records`
--

CREATE TABLE `stock_records` (
  `id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `current_stock` int(160) NOT NULL,
  `stock_in` int(160) NOT NULL,
  `stock_out` int(160) NOT NULL,
  `restock` int(160) NOT NULL,
  `status` tinyint(6) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `stock_records`
--

INSERT INTO `stock_records` (`id`, `stock_id`, `current_stock`, `stock_in`, `stock_out`, `restock`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 54, 0, 0, 0, 0, 1, '2021-05-22 05:06:44', '2021-05-22 05:06:44');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(180) NOT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `category_id`, `name`, `image`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 1, 'Shoes', '1_b_050621.200432.04.jpg', 1, 1, '2021-05-06 14:04:32', '2021-05-06 14:04:32'),
(2, 2, 'Laptop', '1_b_050621.200657.06.png', 1, 1, '2021-05-06 14:06:57', '2021-05-06 14:06:57'),
(3, 2, 'Monitor', '1_b_050621.200734.07.jpg', 1, 1, '2021-05-06 14:07:34', '2021-05-06 14:07:34'),
(4, 1, 'Gents Tshirt', '1_b_051521.131055.10.jpg', 1, 1, '2021-05-15 07:10:55', '2021-05-15 07:10:55'),
(5, 1, 'Gents Shirt', '1_b_051521.131407.14.jpg', 1, 1, '2021-05-15 07:14:07', '2021-05-15 07:14:07'),
(6, 1, 'Gents Pant', '1_b_051521.131720.17.jpg', 1, 1, '2021-05-15 07:17:20', '2021-05-15 07:17:20'),
(7, 4, 'Womens Tshirt', '1_b_051521.131745.17.jpg', 1, 1, '2021-05-15 07:17:45', '2021-05-15 07:17:45'),
(8, 4, 'Womens Shirt', '1_b_051521.131914.19.jpg', 1, 1, '2021-05-15 07:19:14', '2021-05-15 07:19:14'),
(9, 4, 'Womens Pant', '1_b_051521.132103.21.jpg', 1, 1, '2021-05-15 07:21:03', '2021-05-15 07:21:03'),
(10, 5, 'Child Dress & Footware', '1_b_051521.132704.27.jpg', 1, 1, '2021-05-15 07:27:04', '2021-05-15 07:27:04'),
(11, 5, 'Child Body Care', '1_b_051521.132716.27.jpg', 1, 1, '2021-05-15 07:27:16', '2021-05-15 07:27:16'),
(12, 5, 'Child Diaper', '1_b_051521.132810.28.jpg', 1, 1, '2021-05-15 07:28:10', '2021-05-15 07:28:10'),
(13, 6, 'Gents Watch', '1_b_051521.132914.29.jpg', 1, 1, '2021-05-15 07:29:14', '2021-05-15 07:29:14'),
(14, 6, 'Womans Watch', '1_b_051521.132927.29.jpg', 1, 1, '2021-05-15 07:29:27', '2021-05-15 07:29:27'),
(15, 6, 'Kids Watch', '1_b_051521.133007.30.jpg', 1, 1, '2021-05-15 07:30:07', '2021-05-15 07:30:07'),
(16, 9, 'Body Spray', '1_b_051521.133050.30.jpg', 1, 1, '2021-05-15 07:30:50', '2021-05-15 07:30:50'),
(17, 9, 'Finger Ring', '1_b_051521.133128.31.jpg', 1, 1, '2021-05-15 07:31:28', '2021-05-15 07:31:28'),
(18, 9, 'Jewelry', '1_b_051521.133424.34.jpg', 1, 1, '2021-05-15 07:34:24', '2021-05-15 07:34:24'),
(19, 11, 'Appliances', '1_b_051521.133510.35.jpg', 1, 1, '2021-05-15 07:35:10', '2021-05-15 07:35:10'),
(20, 11, 'Room Decoration', '1_b_051521.133558.35.jpg', 1, 1, '2021-05-15 07:35:58', '2021-05-15 07:35:58'),
(21, 11, 'Light and Lamp', '1_b_051521.133648.36.jpg', 1, 1, '2021-05-15 07:36:48', '2021-05-15 07:36:48'),
(22, 11, 'Security', '1_b_051521.133747.37.jpg', 1, 1, '2021-05-15 07:37:47', '2021-05-15 07:37:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `access_level` enum('master_admin','admin','manager') COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image_url` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `access_level`, `email_verified_at`, `password`, `phone`, `gender`, `image_url`, `date_of_birth`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'K M Safwan Hassan', 'test@gmail.com', 'master_admin', NULL, '$2y$10$Rgzu6mXfN0yfXD74sh4NiOJv8w4KzvtAMzDDPsEf4POUfK/ljZ4Ty', '', '', NULL, NULL, 'fNOpImmiaJvsZ3CZ3nrnjOwf6OOKnApxMwdKp8Gm9o0jdAdCPhqmas7vIIDI', '2021-03-05 01:07:40', '2021-03-05 01:07:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount`
--
ALTER TABLE `discount`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `features`
--
ALTER TABLE `features`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_records`
--
ALTER TABLE `stock_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
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
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `discount`
--
ALTER TABLE `discount`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `features`
--
ALTER TABLE `features`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `sliders`
--
ALTER TABLE `sliders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `stock_records`
--
ALTER TABLE `stock_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
