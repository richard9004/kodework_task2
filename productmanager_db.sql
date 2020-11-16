-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 16, 2020 at 10:34 AM
-- Server version: 5.7.21
-- PHP Version: 7.0.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `productmanager_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `gst` double NOT NULL,
  `gst_type` int(11) NOT NULL COMMENT '0=exclusive, 1=inclusive',
  `user_id` int(11) NOT NULL,
  `path` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `gst`, `gst_type`, `user_id`, `path`, `created_at`, `updated_at`, `quantity`) VALUES
(10, 'Product 5', 70, 7, 0, 3, 'J4J4gI_pexels-pixabay-372470.jpg', '2020-11-13 11:10:23', '2020-11-16 18:23:46', 10),
(11, 'Product6', 67, 45, 0, 3, '', '2020-11-13 11:10:50', '2020-11-13 17:29:27', 78),
(12, 'P2', 45, 34, 0, 3, '', '2020-11-14 05:20:02', '2020-11-14 05:20:02', 40),
(13, 'rd', 43, 3, 0, 3, '', '2020-11-14 05:20:28', '2020-11-14 05:20:28', 34),
(14, 'Res', 678, 232, 0, 3, '', '2020-11-14 05:21:00', '2020-11-14 05:40:53', 1000),
(15, 'S12', 782, 22, 0, 3, '', '2020-11-14 05:21:26', '2020-11-14 05:21:26', 10),
(20, 'Richard Product1', 345, 456, 0, 3, '', '2020-11-14 07:50:43', '2020-11-14 07:50:43', 456),
(21, 'Produc1', 234.78, 45.78, 0, 4, '', '2020-11-14 08:03:51', '2020-11-14 08:05:51', 1000),
(23, 'ProductTestt1', 20.8, 56.55, 0, 3, '', '2020-11-14 09:39:56', '2020-11-14 09:39:56', 4000),
(24, 'ProductTest2', 34, 34.4, 1, 3, '', '2020-11-14 09:40:58', '2020-11-14 09:40:58', 800),
(25, 'Soccer Shoes', 800, 5.55, 0, 3, '', '2020-11-14 12:04:59', '2020-11-14 12:05:38', 1000),
(26, 'ProductNew1', 123, 34.5, 0, 3, '', '2020-11-16 17:43:33', '2020-11-16 17:43:33', 200),
(27, 'Product2', 456, 34, 0, 3, 'Y3eLPX_bank_netwest.jpg', '2020-11-16 17:52:28', '2020-11-16 17:52:28', 344);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `api_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `api_key`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(3, 'Richard Cedric Mendes', '37b998da6cd0309890cc1be14c374bec', 'admin@gmail.com', '$2y$10$SEc9fnqsCEmj.h261eP8EOWHIrMExhgjhUTrgCfIBg2Mv1lOgykAC', 'iDjvzoshyxIogzbaW2V2ehFvO3qbmidpMTljcSWQb27b6u5Cb23JPLs5rPQg', '2020-11-11 09:40:31', '2020-11-14 06:36:44'),
(4, 'Test User', '3c91f72fbb5bcc342223c2206488f16c', 'testuser@gmail.com', '$2y$10$ofonkz6Ooh2vHH87/41dP.oqawRGVRw.WCyjPJV.CqhufON/r2yqy', 'u82D4aXQwM3BD05rWB25Ti5oDBzkWKz8fSdliqBixtoFo22A3UQyNP9Iv79s', '2020-11-14 02:27:34', '2020-11-14 04:02:10'),
(5, 'User', '8e9a7e365ee3c07e03e58f60933a9d22', 'richard.programmer90@gmail.com', '$2y$10$DF3i0xEb7zKbttOwF51rQOxQWg71.mqZFWCdHkRwQnaGg6TqKV2Yq', 'A8i50fi63wxmgDT1oH2i5Xn76hpoAA7qmAZQWsZn6vVFB4sn0zsGSwKoTJQA', '2020-11-14 06:37:25', '2020-11-14 06:38:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
