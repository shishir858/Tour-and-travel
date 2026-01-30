-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 30, 2026 at 05:17 AM
-- Server version: 10.6.24-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sspsof5_tdip`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `role` enum('super_admin','admin','editor') DEFAULT 'admin',
  `is_active` tinyint(1) DEFAULT 1,
  `last_login` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `email`, `password`, `full_name`, `role`, `is_active`, `last_login`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@touristdriversindia.com', '$2y$10$AVGFFlOsiow35UpbYbWGPuybcbJzI0gHD5LnuIT5BDncrkCvbqRfG', 'Admin User', 'super_admin', 1, '2026-01-30 02:32:26', '2025-12-31 07:17:20', '2026-01-30 02:32:26');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `booking_number` varchar(50) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `travel_date` date NOT NULL,
  `number_of_persons` int(11) NOT NULL,
  `number_of_days` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `discount` decimal(10,2) DEFAULT 0.00,
  `final_price` decimal(10,2) NOT NULL,
  `payment_status` enum('pending','partial','paid','refunded') DEFAULT 'pending',
  `paid_amount` decimal(10,2) DEFAULT 0.00,
  `payment_method` varchar(50) DEFAULT NULL,
  `booking_status` enum('pending','confirmed','cancelled','completed') DEFAULT 'pending',
  `special_requests` text DEFAULT NULL,
  `admin_notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `booking_number`, `customer_id`, `package_id`, `vehicle_id`, `travel_date`, `number_of_persons`, `number_of_days`, `total_price`, `discount`, `final_price`, `payment_status`, `paid_amount`, `payment_method`, `booking_status`, `special_requests`, `admin_notes`, `created_at`, `updated_at`) VALUES
(100, 'ENQ202601080037788', 37, 56, NULL, '2026-01-21', 7, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'pending', 'Quick Enquiry - Name: preet | Phone: 1212125100 | Guests: 7 | Package: Corbett Wildlife Tour', NULL, '2026-01-08 09:58:29', '2026-01-08 09:58:29'),
(101, 'BK202601080011331', 11, 11, NULL, '2026-01-25', 5, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'pending', 'Travel Date: 2026-01-25 | Guests: 5 | Message: dddfdfdfd', NULL, '2026-01-08 10:18:38', '2026-01-08 10:18:38'),
(102, 'BK202601080011757', 11, 14, NULL, '2026-02-07', 6, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'pending', 'Travel Date: 2026-02-07 | Guests: 6 | Message: ffdfsf', NULL, '2026-01-08 10:23:25', '2026-01-08 10:23:25'),
(103, 'ENQ202601080011430', 11, 6, NULL, '2026-01-29', 6, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'pending', 'Quick Enquiry - Name: preet | Phone: 1212125100 | Guests: 6 | Package: Chardham Yatra Package from Delhi', NULL, '2026-01-08 10:24:15', '2026-01-08 10:24:15'),
(104, 'ENQ202601080031722', 31, 6, NULL, '2026-01-15', 4, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'pending', 'Quick Enquiry - Name: testing  | Phone: 6525896524 | Guests: 4 | Package: Chardham Yatra Package from Delhi', NULL, '2026-01-08 11:10:28', '2026-01-08 11:10:28'),
(105, 'ENQ202601110008190', 8, 58, NULL, '2026-01-12', 6, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'pending', 'Quick Enquiry - Name: Devender Singh | Phone: 07838971870 | Guests: 6 | Package: 15 Nights 16 Days Southern Taste of India', NULL, '2026-01-11 03:14:06', '2026-01-11 03:14:06'),
(106, 'BK202601120008634', 8, 12, NULL, '2026-01-28', 23, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'pending', 'Travel Date: 2026-01-28 | Guests: 23 | Message: Tedt', NULL, '2026-01-12 15:50:26', '2026-01-12 15:50:26'),
(107, 'BK202601120008848', 8, 55, NULL, '2026-01-31', 2, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'pending', 'Travel Date: 2026-01-31 | Guests: 2 | Message: T', NULL, '2026-01-12 15:51:05', '2026-01-12 15:51:05'),
(108, 'CNT202601120038463', 38, 1, NULL, '2026-01-12', 1, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'completed', 'Contact Form Message | Message: Hello,\r\n\r\n\r\nWe are a group of 4 people staying at Welcomhotel Dwarka, New Delhi, and we would like to book a private guided tour on 22 February.\r\n\r\n\r\nWe would like hotel pick-up at around 10:00 a.m.\r\n\r\n\r\nProposed itinerary:\r\n\r\n\r\nHumayun’s Tomb\r\n\r\n\r\nLodhi Gardens\r\n\r\n\r\nNizamuddin Dargah (evening visit)\r\n\r\n\r\nWe are looking for:\r\n– A private guide, preferably Italian-speaking (English is acceptable only if Italian is not available)\r\n– A private air-conditioned car with driver\r\n\r\n\r\nCould you please let us know:\r\n– Availability for 22 February\r\n– Total price for the 4 of us\r\n– What is included in the price (guide, transport, entrance fees, etc.)\r\n– Approximate duration of the tour\r\n\r\n\r\nThank you very much.\r\nKind regards,', NULL, '2026-01-12 16:57:52', '2026-01-25 16:17:24'),
(109, 'ENQ202601160008780', 8, 1, NULL, '2026-01-22', 6, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'confirmed', 'Quick Enquiry - Name: Devender Singh | Phone: 07838971870 | Guests: 6', NULL, '2026-01-16 01:38:40', '2026-01-25 16:17:09'),
(110, 'BK202601160008342', 8, 43, NULL, '2026-01-31', 2, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'confirmed', 'Travel Date: 2026-01-31 | Guests: 2 | Message: Tedt', NULL, '2026-01-16 01:39:19', '2026-01-25 16:16:57'),
(111, 'CNT202601190039283', 39, 1, NULL, '2026-01-19', 1, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'completed', 'Contact Form Message | Message: Hi, we will arrive to New Dehli and will stay there for 7 days. for the whole time we need a driver with a car (we are 3 persons). We want to stay flexible and travel around, but not classic golden trangle \r\n', NULL, '2026-01-19 17:59:14', '2026-01-25 16:16:44'),
(112, 'ENQ202601220040828', 40, 6, NULL, '2026-01-22', 2, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'completed', 'Quick Enquiry - Name: Sanket Kadam | Phone: 7758871585 | Guests: 2 | Package: Chardham Yatra Package from Delhi', NULL, '2026-01-22 12:36:20', '2026-01-25 08:57:15'),
(113, 'BK202601270041278', 41, 10, NULL, '2026-01-31', 5, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'cancelled', 'Travel Date: 2026-01-31 | Guests: 5 | Message: gfgffgfgfg', NULL, '2026-01-27 12:14:10', '2026-01-27 14:37:06'),
(114, 'ENQ202601270017986', 17, 10, NULL, '2026-01-30', 7, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'cancelled', 'Quick Enquiry - Name: testing | Phone: 7654953163 | Guests: 7 | Package: 15 Days Rajasthan Tour Package', NULL, '2026-01-27 12:14:55', '2026-01-27 14:36:54'),
(115, 'ENQ202601270042137', 42, 8, NULL, '2026-01-28', 4, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'cancelled', 'Quick Enquiry - Name: testing | Phone: 9355993528 | Guests: 4 | Package: Delhi Haridwer Rishikesh Delhi 5 Days Package', NULL, '2026-01-27 12:23:18', '2026-01-27 14:36:44'),
(116, 'ENQ202601270029145', 29, 10, NULL, '2026-01-29', 6, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'cancelled', 'Quick Enquiry - Name: Rajan Singh  | Phone: 8800608559 | Guests: 6 | Package: 15 Days Rajasthan Tour Package', NULL, '2026-01-27 13:24:41', '2026-01-27 14:36:30'),
(117, 'BK202601270008207', 8, 49, NULL, '2026-01-30', 23, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'cancelled', 'Travel Date: 2026-01-30 | Guests: 23 | Message: ,tedt', NULL, '2026-01-27 13:25:28', '2026-01-27 14:36:20'),
(118, 'CNT202601270007576', 7, 58, NULL, '2026-01-27', 1, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'completed', 'Contact Form Message | Package Interest: 15 Nights 16 Days Southern Taste of India | Message: Test', NULL, '2026-01-27 14:34:40', '2026-01-27 14:36:07'),
(119, 'ENQ202601280043220', 43, 62, NULL, '2026-01-31', 9, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'pending', 'Quick Enquiry - Name: CCR ssp | Phone: 8789096567 | Guests: 9 | Package: Best of Gujarat Heritage Tour', NULL, '2026-01-28 05:44:30', '2026-01-28 05:44:30'),
(120, 'ENQ202601280044944', 44, 56, NULL, '2026-02-04', 4, 1, '0.00', '0.00', '0.00', 'pending', '0.00', NULL, 'cancelled', 'Quick Enquiry - Name: ddfd | Phone: 7890098789 | Guests: 4 | Package: Corbett Wildlife Tour', NULL, '2026-01-28 05:46:47', '2026-01-30 02:32:48');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `show_in_header` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `icon`, `display_order`, `is_active`, `show_in_header`, `created_at`, `updated_at`) VALUES
(1, 'Golden Triangle', 'golden-triangle', 'Explore Delhi, Agra, and Jaipur - India\'s most iconic destinations', NULL, 1, 1, 1, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(2, 'Himachal ', 'himachal', 'Experience the beauty of Himachal Pradesh with hill stations and adventure', '', 4, 1, 1, '2025-12-31 06:57:49', '2026-01-03 12:01:24'),
(3, 'Rajasthan ', 'rajasthan', 'Discover the royal heritage and desert landscapes of Rajasthan', '', 3, 1, 1, '2025-12-31 06:57:49', '2026-01-03 12:01:32'),
(4, 'Taj Mahal Tours', 'tajmahal-tours', 'Visit the iconic Taj Mahal with same-day and multi-day packages', '', 2, 1, 1, '2025-12-31 06:57:49', '2026-01-03 11:52:24'),
(5, 'Pilgrimage ', 'pilgrimage', 'Spiritual journeys to sacred destinations across India', '', 5, 1, 1, '2025-12-31 06:57:49', '2026-01-03 12:01:40'),
(11, 'wildlife ', 'wildlife', '', '', 6, 1, 1, '2026-01-03 10:12:44', '2026-01-03 12:02:31'),
(12, 'south india ', 'south-india', '', '', 6, 1, 1, '2026-01-03 10:19:23', '2026-01-03 12:02:25'),
(13, 'Gujarat', 'gujarat', '', '', 6, 1, 1, '2026-01-03 11:21:12', '2026-01-03 12:02:17');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `country` varchar(100) DEFAULT 'India',
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `phone`, `country`, `state`, `city`, `address`, `created_at`, `updated_at`) VALUES
(2, 'CCR ssp', 'admin@seomanagement.com', '7890989075', 'India', NULL, NULL, NULL, '2026-01-02 07:59:50', '2026-01-02 07:59:50'),
(6, 'Guest', 'guest@example.com', '8845475247', 'India', NULL, NULL, NULL, '2026-01-02 09:52:57', '2026-01-02 09:52:57'),
(7, 'rajan', 'mrajam@gmail.com', '988888888', 'India', NULL, NULL, NULL, '2026-01-03 16:06:18', '2026-01-03 16:06:18'),
(8, 'Devender Singh', 'mrrajanindian@gmail.com', '07838971870', 'India', NULL, NULL, NULL, '2026-01-03 16:54:49', '2026-01-03 16:54:49'),
(11, 'aman', 'backenddata.ssp@gmail.com', '1212125100', 'India', NULL, NULL, NULL, '2026-01-05 11:29:32', '2026-01-08 10:24:15'),
(15, 'preet', 'backendfdfdddata.ssp@gmail.com', '1000021211', 'India', NULL, NULL, NULL, '2026-01-06 05:45:14', '2026-01-08 07:44:04'),
(16, 'contact', 'backdffdenddata.ssp@gmail.com', '1000021200', 'India', NULL, NULL, NULL, '2026-01-06 05:49:04', '2026-01-06 05:49:04'),
(17, 'preet', 'backeddfdfnddata.ssp@gmail.com', '7654953163', 'India', NULL, NULL, NULL, '2026-01-06 05:49:38', '2026-01-06 05:49:38'),
(18, 'tets', 'guest_8585858521@example.com', '8585858521', 'India', NULL, NULL, NULL, '2026-01-06 05:50:44', '2026-01-06 05:50:44'),
(19, 'testing', 'guest_dfdfdfdfd@example.com', 'dfdfdfdfd', 'India', NULL, NULL, NULL, '2026-01-06 12:37:53', '2026-01-06 12:37:53'),
(20, 'testing', 'guest_9911597634@example.com', '9911597634', 'India', NULL, NULL, NULL, '2026-01-06 12:57:19', '2026-01-06 12:57:19'),
(21, 'ramnnnnn', 'guest_1212125195@example.com', '1212125195', 'India', NULL, NULL, NULL, '2026-01-06 13:04:48', '2026-01-06 13:04:48'),
(22, 'Hjjjjm', 'guest_8563258093@example.com', '8563258093', 'India', NULL, NULL, NULL, '2026-01-06 13:12:32', '2026-01-06 13:12:32'),
(23, 'Hi jmmn', 'd@gmail.com', '8520852369', 'India', NULL, NULL, NULL, '2026-01-06 13:13:42', '2026-01-06 13:13:42'),
(24, 'Tedt', 'guest_96358024719@example.com', '96358024719', 'India', NULL, NULL, NULL, '2026-01-06 15:49:13', '2026-01-06 15:49:13'),
(25, 'Gaurav ', 'Gauravssp997@gmail.com', '9632580741', 'India', NULL, NULL, NULL, '2026-01-06 15:54:51', '2026-01-06 15:54:51'),
(26, 'Test', 'test@gmail.com', '3692580147', 'India', NULL, NULL, NULL, '2026-01-06 15:55:30', '2026-01-06 15:55:30'),
(27, 'JEET SINGH', 'guest_1234567890@example.com', '1234567890', 'India', NULL, NULL, NULL, '2026-01-06 16:28:58', '2026-01-06 16:28:58'),
(28, 'fdfdfda', 'a@gmail.com', '8765678987', 'India', NULL, NULL, NULL, '2026-01-06 16:33:10', '2026-01-06 16:33:10'),
(29, 'Rajan Singh', 'guest_8800608559@example.com', '8800608559', 'India', NULL, NULL, NULL, '2026-01-07 02:34:06', '2026-01-07 02:34:06'),
(30, 'RAJAN', 'info@tajmahaldaytour.in', '888888888', 'India', NULL, NULL, NULL, '2026-01-07 03:29:44', '2026-01-07 03:29:44'),
(31, 'testing ', 'testing.ssp@gmail.com', '6525896524', 'India', NULL, NULL, NULL, '2026-01-07 05:04:01', '2026-01-08 11:10:28'),
(32, 'Tanja Birri', 'tanjabirri@gmail.com', '+41797486371', 'India', NULL, NULL, NULL, '2026-01-07 05:56:38', '2026-01-07 05:56:38'),
(33, 'Nova', 'guest_+447592526588@example.com', '+447592526588', 'India', NULL, NULL, NULL, '2026-01-07 19:50:35', '2026-01-07 19:50:35'),
(37, 'preet', 'bacfdffdfkenddata.ssp@gmail.com', '1212125100', 'India', NULL, NULL, NULL, '2026-01-08 09:58:29', '2026-01-08 09:58:29'),
(38, 'DENISE BASTIANELLI', 'denisebastianelli@libero.it', '+393473432125', 'India', NULL, NULL, NULL, '2026-01-12 16:57:52', '2026-01-12 16:57:52'),
(39, 'Maxim Göring', 'goering.maxim@gmail.com', '0178769223', 'India', NULL, NULL, NULL, '2026-01-19 17:59:14', '2026-01-19 17:59:14'),
(40, 'Sanket Kadam', 'sanketkadam882@gmail.com', '7758871585', 'India', NULL, NULL, NULL, '2026-01-22 12:36:20', '2026-01-22 12:36:20'),
(41, 'testing', 'backenddatasdd.ssp@gmail.com', '8790597634', 'India', NULL, NULL, NULL, '2026-01-27 12:14:10', '2026-01-27 12:14:10'),
(42, 'testing', 'guest_9355993528@example.com', '9355993528', 'India', NULL, NULL, NULL, '2026-01-27 12:23:18', '2026-01-27 12:23:18'),
(43, 'CCR ssp', 'guest_8789096567@example.com', '8789096567', 'India', NULL, NULL, NULL, '2026-01-28 05:44:30', '2026-01-28 05:44:30'),
(44, 'ddfd', 'guest_7890098789@example.com', '7890098789', 'India', NULL, NULL, NULL, '2026-01-28 05:46:47', '2026-01-28 05:46:47');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `country` varchar(100) DEFAULT 'India',
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `latitude` decimal(10,8) DEFAULT NULL,
  `longitude` decimal(11,8) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`id`, `name`, `slug`, `state`, `country`, `description`, `image`, `latitude`, `longitude`, `is_active`, `display_order`, `created_at`, `updated_at`) VALUES
(1, 'Delhi', 'delhi', 'Delhi', 'India', 'Capital city with rich Mughal heritage', '6954d1c682c64_1767166406.jpg', NULL, NULL, 1, 1, '2025-12-31 06:57:49', '2025-12-31 07:33:26'),
(2, 'Agra', 'agra', 'Uttar Pradesh', 'India', 'Home to the iconic Taj Mahal', NULL, NULL, NULL, 1, 2, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(3, 'Jaipur', 'jaipur', 'Rajasthan', 'India', 'The Pink City known for forts and palaces', NULL, NULL, NULL, 1, 3, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(4, 'Shimla', 'shimla', 'Himachal Pradesh', 'India', 'Popular hill station and former summer capital', NULL, NULL, NULL, 1, 4, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(5, 'Manali', 'manali', 'Himachal Pradesh', 'India', 'Adventure hub with snow-capped mountains', NULL, NULL, NULL, 1, 5, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(6, 'Dharamshala', 'dharamshala', 'Himachal Pradesh', 'India', 'Home to Dalai Lama and Tibetan culture', NULL, NULL, NULL, 1, 6, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(7, 'Kullu', 'kullu', 'Himachal Pradesh', 'India', 'Valley of Gods with scenic beauty', NULL, NULL, NULL, 1, 7, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(8, 'Dalhousie', 'dalhousie', 'Himachal Pradesh', 'India', 'Charming colonial-era hill station', NULL, NULL, NULL, 1, 8, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(9, 'Kasauli', 'kasauli', 'Himachal Pradesh', 'India', 'Peaceful hill town with colonial charm', NULL, NULL, NULL, 1, 9, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(10, 'Udaipur', 'udaipur', 'Rajasthan', 'India', 'City of Lakes with romantic palaces', NULL, NULL, NULL, 1, 10, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(11, 'Jodhpur', 'jodhpur', 'Rajasthan', 'India', 'The Blue City with Mehrangarh Fort', NULL, NULL, NULL, 1, 11, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(12, 'Jaisalmer', 'jaisalmer', 'Rajasthan', 'India', 'The Golden City in Thar Desert', NULL, NULL, NULL, 1, 12, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(13, 'Bikaner', 'bikaner', 'Rajasthan', 'India', 'Desert city famous for Junagarh Fort', NULL, NULL, NULL, 1, 13, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(14, 'Pushkar', 'pushkar', 'Rajasthan', 'India', 'Sacred town with Brahma Temple', NULL, NULL, NULL, 1, 14, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(15, 'Mount Abu', 'mount-abu', 'Rajasthan', 'India', 'Only hill station in Rajasthan', NULL, NULL, NULL, 1, 15, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(16, 'Varanasi', 'varanasi', 'Uttar Pradesh', 'India', 'Holiest city on banks of Ganges', NULL, NULL, NULL, 1, 16, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(17, 'Haridwar', 'haridwar', 'Uttarakhand', 'India', 'Gateway to God with evening Ganga Aarti', NULL, NULL, NULL, 1, 17, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(18, 'Rishikesh', 'rishikesh', 'Uttarakhand', 'India', 'Yoga capital of the world', NULL, NULL, NULL, 1, 18, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(19, 'Mathura', 'mathura', 'Uttar Pradesh', 'India', 'Birthplace of Lord Krishna', NULL, NULL, NULL, 1, 19, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(20, 'Vrindavan', 'vrindavan', 'Uttar Pradesh', 'India', 'Sacred town of Krishna temples', NULL, NULL, NULL, 1, 20, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(21, 'Amritsar', 'amritsar', 'Punjab', 'India', 'Home to the Golden Temple', NULL, NULL, NULL, 1, 21, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(22, 'Goa', 'goa', 'Goa', 'India', 'Beach paradise with Portuguese heritage', NULL, NULL, NULL, 1, 22, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(23, 'Kerala', 'kerala', 'Kerala', 'India', 'God\'s Own Country with backwaters', NULL, NULL, NULL, 1, 23, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(24, 'Mumbai', 'mumbai', 'Maharashtra', 'India', 'Financial capital and Bollywood hub', NULL, NULL, NULL, 1, 24, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(25, 'Bangalore', 'bangalore', 'Karnataka', 'India', 'Garden City and IT capital', NULL, NULL, NULL, 1, 25, '2025-12-31 06:57:49', '2025-12-31 06:57:49'),
(26, 'Ranthambore', 'ranthambore', 'Rajasthan', 'India', 'Ranthambore is located in the Sawai Madhopur district of Rajasthan, India, about 180 km from Jaipur. It is famous for Ranthambore National Park, one of the best places in India to see Royal Bengal tigers in their natural habitat, surrounded by the Aravalli and Vindhya mountain ranges.', '6958c55d5d2f0_1767425373.webp', NULL, NULL, 1, 0, '2026-01-03 07:29:33', '2026-01-03 07:29:33'),
(27, 'Khajuraho', 'khajuraho', 'Madhya Pradesh', 'India', 'The Khajuraho Group of Monuments are a group of Hindu and Digambara Jain temples in Chhatarpur district, Madhya Pradesh, India.', '', NULL, NULL, 1, 0, '2026-01-03 07:43:26', '2026-01-03 07:43:26'),
(28, 'Orchha', 'orchha', 'Madhya Pradesh', 'India', '', '', NULL, NULL, 1, 0, '2026-01-03 07:44:19', '2026-01-03 07:44:19'),
(29, 'Ahmedabad', 'ahmedabad', '', 'India', '', '', NULL, NULL, 1, 0, '2026-01-03 11:32:51', '2026-01-03 11:32:51'),
(30, 'Dwarka', 'dwarka', '', 'India', '', '', NULL, NULL, 1, 0, '2026-01-03 11:33:01', '2026-01-03 11:33:01'),
(31, 'Jamnagar', 'jamnagar', '', 'India', '', '', NULL, NULL, 1, 0, '2026-01-03 11:33:15', '2026-01-03 11:33:15');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_new`
--

CREATE TABLE `gallery_new` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image_url` varchar(255) NOT NULL,
  `thumbnail_url` varchar(255) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `related_type` enum('package','destination','vehicle','general') DEFAULT 'general',
  `related_id` int(11) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `package_destinations`
--

CREATE TABLE `package_destinations` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `destination_id` int(11) NOT NULL,
  `day_number` int(11) DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_destinations`
--

INSERT INTO `package_destinations` (`id`, `package_id`, `destination_id`, `day_number`, `display_order`, `created_at`) VALUES
(173, 1, 14, NULL, 0, '2026-01-05 11:13:21'),
(228, 13, 2, NULL, 0, '2026-01-06 07:22:09'),
(229, 13, 1, NULL, 0, '2026-01-06 07:22:09'),
(230, 13, 3, NULL, 0, '2026-01-06 07:22:09'),
(231, 13, 10, NULL, 0, '2026-01-06 07:22:09'),
(234, 5, 1, NULL, 0, '2026-01-06 07:45:17'),
(235, 5, 7, NULL, 0, '2026-01-06 07:45:17'),
(236, 5, 5, NULL, 0, '2026-01-06 07:45:17'),
(237, 5, 4, NULL, 0, '2026-01-06 07:45:17'),
(241, 66, 29, NULL, 0, '2026-01-06 09:17:15'),
(242, 66, 30, NULL, 0, '2026-01-06 09:17:15'),
(243, 66, 24, NULL, 0, '2026-01-06 09:17:15'),
(244, 65, 30, NULL, 0, '2026-01-06 09:28:35'),
(245, 64, 30, NULL, 0, '2026-01-06 09:29:15'),
(246, 64, 31, NULL, 0, '2026-01-06 09:29:15'),
(247, 63, 29, NULL, 0, '2026-01-06 09:30:02'),
(248, 63, 31, NULL, 0, '2026-01-06 09:30:02'),
(250, 62, 1, NULL, 0, '2026-01-06 09:31:46'),
(251, 61, 2, NULL, 0, '2026-01-06 09:35:41'),
(252, 61, 1, NULL, 0, '2026-01-06 09:35:41'),
(253, 61, 3, NULL, 0, '2026-01-06 09:35:41'),
(254, 61, 23, NULL, 0, '2026-01-06 09:35:41'),
(255, 59, 25, NULL, 0, '2026-01-06 09:50:52'),
(256, 59, 23, NULL, 0, '2026-01-06 09:50:52'),
(257, 58, 25, NULL, 0, '2026-01-06 09:51:32'),
(258, 58, 23, NULL, 0, '2026-01-06 09:51:32'),
(259, 57, 23, NULL, 0, '2026-01-06 10:00:55'),
(276, 50, 2, NULL, 0, '2026-01-06 10:16:54'),
(277, 50, 1, NULL, 0, '2026-01-06 10:16:54'),
(278, 50, 23, NULL, 0, '2026-01-06 10:16:54'),
(279, 49, 2, NULL, 0, '2026-01-06 10:18:09'),
(280, 49, 1, NULL, 0, '2026-01-06 10:18:09'),
(281, 49, 5, NULL, 0, '2026-01-06 10:18:09'),
(282, 49, 4, NULL, 0, '2026-01-06 10:18:09'),
(286, 47, 2, NULL, 0, '2026-01-06 10:24:22'),
(287, 47, 1, NULL, 0, '2026-01-06 10:24:22'),
(288, 47, 3, NULL, 0, '2026-01-06 10:24:22'),
(289, 47, 27, NULL, 0, '2026-01-06 10:24:22'),
(290, 47, 28, NULL, 0, '2026-01-06 10:24:22'),
(295, 45, 2, NULL, 0, '2026-01-06 10:27:27'),
(296, 45, 1, NULL, 0, '2026-01-06 10:27:27'),
(297, 45, 3, NULL, 0, '2026-01-06 10:27:27'),
(298, 44, 2, NULL, 0, '2026-01-06 10:30:11'),
(299, 44, 1, NULL, 0, '2026-01-06 10:30:11'),
(300, 44, 3, NULL, 0, '2026-01-06 10:30:11'),
(301, 44, 27, NULL, 0, '2026-01-06 10:30:11'),
(302, 43, 2, NULL, 0, '2026-01-06 10:30:47'),
(303, 43, 1, NULL, 0, '2026-01-06 10:30:47'),
(308, 41, 2, NULL, 0, '2026-01-06 10:32:34'),
(309, 41, 1, NULL, 0, '2026-01-06 10:32:34'),
(310, 41, 3, NULL, 0, '2026-01-06 10:32:34'),
(311, 41, 27, NULL, 0, '2026-01-06 10:32:34'),
(312, 41, 28, NULL, 0, '2026-01-06 10:32:34'),
(313, 41, 16, NULL, 0, '2026-01-06 10:32:34'),
(314, 40, 2, NULL, 0, '2026-01-08 05:31:41'),
(315, 40, 1, NULL, 0, '2026-01-08 05:31:41'),
(316, 40, 3, NULL, 0, '2026-01-08 05:31:41'),
(317, 40, 26, NULL, 0, '2026-01-08 05:31:41'),
(318, 39, 2, NULL, 0, '2026-01-08 05:33:11'),
(319, 39, 1, NULL, 0, '2026-01-08 05:33:11'),
(320, 39, 3, NULL, 0, '2026-01-08 05:33:11'),
(321, 39, 10, NULL, 0, '2026-01-08 05:33:11'),
(322, 38, 2, NULL, 0, '2026-01-08 05:34:32'),
(323, 38, 1, NULL, 0, '2026-01-08 05:34:32'),
(324, 38, 3, NULL, 0, '2026-01-08 05:34:32'),
(328, 18, 2, NULL, 0, '2026-01-08 05:35:17'),
(329, 18, 1, NULL, 0, '2026-01-08 05:35:17'),
(330, 18, 3, NULL, 0, '2026-01-08 05:35:17'),
(331, 4, 1, NULL, 0, '2026-01-08 05:36:26'),
(332, 4, 4, NULL, 0, '2026-01-08 05:36:26'),
(336, 9, 2, NULL, 0, '2026-01-08 05:46:37'),
(337, 9, 1, NULL, 0, '2026-01-08 05:46:37'),
(338, 9, 16, NULL, 0, '2026-01-08 05:46:37'),
(342, 51, 2, NULL, 0, '2026-01-25 16:25:52'),
(343, 51, 1, NULL, 0, '2026-01-25 16:25:52'),
(344, 51, 3, NULL, 0, '2026-01-25 16:25:52'),
(353, 46, 2, NULL, 0, '2026-01-25 16:33:39'),
(354, 46, 1, NULL, 0, '2026-01-25 16:33:39'),
(355, 46, 3, NULL, 0, '2026-01-25 16:33:39'),
(356, 46, 14, NULL, 0, '2026-01-25 16:33:39'),
(360, 54, 13, NULL, 0, '2026-01-26 12:29:51'),
(361, 54, 1, NULL, 0, '2026-01-26 12:29:51'),
(362, 54, 3, NULL, 0, '2026-01-26 12:29:51'),
(367, 53, 2, NULL, 0, '2026-01-26 12:30:52'),
(368, 53, 1, NULL, 0, '2026-01-26 12:30:52'),
(369, 53, 3, NULL, 0, '2026-01-26 12:30:52'),
(370, 53, 26, NULL, 0, '2026-01-26 12:30:52'),
(374, 55, 1, NULL, 0, '2026-01-27 14:26:55'),
(375, 55, 19, NULL, 0, '2026-01-27 14:26:55'),
(376, 55, 20, NULL, 0, '2026-01-27 14:26:55'),
(377, 42, 2, NULL, 0, '2026-01-27 14:28:30'),
(378, 42, 1, NULL, 0, '2026-01-27 14:28:30'),
(379, 42, 3, NULL, 0, '2026-01-27 14:28:30'),
(380, 42, 16, NULL, 0, '2026-01-27 14:28:30'),
(382, 56, 1, NULL, 0, '2026-01-30 02:34:21'),
(385, 52, 2, NULL, 0, '2026-01-30 02:35:23'),
(386, 52, 1, NULL, 0, '2026-01-30 02:35:23'),
(387, 48, 2, NULL, 0, '2026-01-30 02:37:04'),
(388, 48, 1, NULL, 0, '2026-01-30 02:37:04'),
(389, 48, 6, NULL, 0, '2026-01-30 02:37:04');

-- --------------------------------------------------------

--
-- Table structure for table `package_itinerary`
--

CREATE TABLE `package_itinerary` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `day_number` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `meals` varchar(100) DEFAULT NULL,
  `accommodation` varchar(255) DEFAULT NULL,
  `activities` text DEFAULT NULL,
  `display_order` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `package_itinerary`
--

INSERT INTO `package_itinerary` (`id`, `package_id`, `day_number`, `title`, `description`, `meals`, `accommodation`, `activities`, `display_order`, `created_at`) VALUES
(230, 8, 1, 'Delhi â€“ Haridwar', 'ickup from Delhi Railway Station, Meet & Assist further drive to Haridwar. Check in Hotel. In the evening visit Har-ki-Pauri to view the holy Ganges Aarti. This is the place where the main bathing takes place. The place is called Brahma Kund, the myths says this is the place where the nectar can dissolved in the holy water of river Ganges. If wish, have a dip here later after viewing Aarti visit the market near the place. Later back to your Hotel for night stay.', NULL, NULL, NULL, 0, '2025-12-31 09:24:01'),
(231, 8, 2, 'Haridwar â€“ Rishikesh', 'Morning visit Haridwar Local Sight Seeing i.e Daksh Prajapati Temple, Ananand Mai Ashram, Parad (Mercury) Shivling in Kankhal Region, Mansa Devi and Chandi Devi (both by ropeway), Maya Devi, Pawan Dham, Bhuma Niketan, Parmarth, Bharat Mata Mandir, Shanti Kunj, Saptrishi Ashram and others.\r\n\r\nLater drive to Rishikesh another ancient place which is famous for its Ashrams and for grand viewing of Ganges. Visit Ashrams, some of which are internationally recognized as centre of Philosophical studies, yoga and meditation. Check in Hotel. In the evening visit Triveni Ghat to view the holy Ganges Aarti. Later back to your Hotel for night stay.\r\n\r\nTriveni Ghat: A sacred bathing spot on the bank of the river Ganga where devotees take holy dips and offer prayers. Devotees bathe here with the belief that the water has the power to purify them. Triveni Ghat is also called because it is believed to be the confluence of the Ganga, the Yamuna and the legendary Saraswati river. It is an interesting place to be at dawn when people make offerings of milk to the river and feed the fish. After sunset, as a part of the Aarti ceremony, lamps are floated on the water and provide a spectacular view.', NULL, NULL, NULL, 0, '2025-12-31 09:24:01'),
(232, 8, 3, 'Rishikesh Delhi', 'After Breakfast, Visit Rishikesh Local Sight Seeing. Later drive to Delhi. Drop at Airport for your onward destination.', NULL, NULL, NULL, 0, '2025-12-31 09:24:01'),
(233, 7, 1, 'Arrival in Varanasi', 'Pickup: Arrive at Varanasi Airport and transfer to your hotel.\r\nActivities: In the evening, attend the Ganga Aarti at Dashashwamedh Ghat and enjoy a Ghat\r\nDarshan.\r\nOvernight Stay: Varanasi', NULL, NULL, NULL, 0, '2025-12-31 09:25:26'),
(234, 7, 2, 'Sarnath & Varanasi Temples Tour', 'Morning: Visit Sarnath, where Buddha delivered his first sermon. Explore the Dhamek Stupa,\r\nChaukhandi Stupa, and Sarnath Museum.\r\nAfternoon: Visit prominent Varanasi temples such as Kashi Vishwanath Temple, Annapurna\r\nTemple, and Sankat Mochan Hanuman Temple.\r\nOvernight Stay: Varanasi', NULL, NULL, NULL, 0, '2025-12-31 09:25:26'),
(235, 7, 3, 'Varanasi to Prayagraj (Allahabad)', 'Morning: Check out from your hotel and drive to Prayagraj (approximately 3 hours).\r\nActivities: Visit Triveni Sangam (confluence of Ganga, Yamuna, and Saraswati), Anand\r\nBhavan, and Allahabad Fort.\r\nOvernight Stay: Prayagraj', NULL, NULL, NULL, 0, '2025-12-31 09:25:26'),
(236, 7, 4, 'Prayagraj to Ayodhya', 'Morning: Check out from your hotel and drive to Ayodhya (approximately 4 hours).\r\nActivities: Visit Ram Janam Bhoomi, the birthplace of Lord Rama.\r\nOvernight Stay: Ayodhya', NULL, NULL, NULL, 0, '2025-12-31 09:25:26'),
(237, 7, 5, 'Ayodhya Tour', 'Activities: Explore other significant sites in Ayodhya, such as Hanuman Garhi, Kanak\r\nBhawan, and Sita Ki Rasoi.\r\nOvernight Stay: Ayodhya', NULL, NULL, NULL, 0, '2025-12-31 09:25:26'),
(238, 7, 6, 'Departure from Ayodhya', 'Check Out: Check out from your hotel.\r\nTransfer: Drop off at Ayodhya Railway Station or Airport for your next destination.', NULL, NULL, NULL, 0, '2025-12-31 09:25:26'),
(958, 1, 1, 'Arrive in Delhi.', 'Airport and transfer to hotel and night stay in new Delhi:', NULL, NULL, NULL, 0, '2026-01-05 11:13:21'),
(959, 1, 2, 'Delhi Day Tour.', 'this day after breakfast you start Delhi guided tour and visit sights Red Fort , Jama Masjid , Raj Ghat , India Gate , Lotas Temple , Qutab Minner , Persistent House Hum-yuan Tomb and lunch and dinner in the city and night stay in Delhi.', NULL, NULL, NULL, 0, '2026-01-05 11:13:21'),
(960, 1, 3, 'Delhi- Jaipur Drive.', 'After breakfast drive to pink city of Jaipur you reach around in afternoon and check-inn in the hotel and after rest going to center city and walking tour and night stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-05 11:13:21'),
(961, 1, 4, 'Jaipur Guided Day Tour', 'After breakfast you going to amber fort with your private tour guide and see the amber fort and after water palace , City Palace , Wind Palace and local bazaars and night stay in Jaipur', NULL, NULL, NULL, 0, '2026-01-05 11:13:21'),
(962, 1, 5, 'Jaipur-Pushkar-Jaipur Day Trip', 'Early in the morning we drive to Pushkar Day Trip and you reach around 10:30 am in the morning and visit pushkar and see the holy lakes and Oldest Hindu Temples and if you have also enjoy the camel ride and after pushkar tour back to the Jaipur and night stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-05 11:13:21'),
(963, 1, 6, 'Jaipur- Agra Drive.', 'After breakfast check-out from hotel and drive to Agra and en-route you visit fathepur sikri and night stay in Agra.', NULL, NULL, NULL, 0, '2026-01-05 11:13:21'),
(964, 1, 7, 'Agra- Delhi Drive', 'Visit Taj Mahal in morning and see the nice sunrise and after back to the hotel and breakfast , check-out and visit Agra fort and drive back to new Delhi.', NULL, NULL, NULL, 0, '2026-01-05 11:13:21'),
(1102, 10, 1, 'Sight Seeing of Delhi', 'Welcome to the Pink City! Upon arrival, you\'ll be greeted and transferred to your hotel. After check-in, explore local markets or enjoy a short sightseeing tour including Birla Mandir and Nahargarh Fort for a sunset view.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1103, 10, 2, 'Delhi- Mandawa Drive', 'Check in Hotel and get ready for afternoon sightseeing tour in the fort town of Mandawa, famous for its heritage Havelis and fresco art. Thousands of tourists come here to see the Mandawa Castle, which was an important station in the silk route. Now Castle Mandawa has been converted into a beautiful heritage hotel. Night halt at Bikaner', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1104, 10, 3, 'Mandawa - Bikaner Drive', 'Lalgarh-palaceCheck in Hotel & enjoy the afternoon sightseeing tour. A leisurely afternoon visit includes are the major attractions like the Lalgarh Palace, the Junagarh fort, Ganga Golden Jubilee Museum, the Bhandasar Jain Temple, The Gajner Palace, the Shiv Bari Temple including Kalibangan, a famous Harappan civilization site. Night halt at Bikaner', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1105, 10, 4, 'Bikaner - Jaisalmer Drive', 'At Jaisalmer morning sightseeing tour of Jaisalmer, covering beautiful locations like the 12th century Jaisalmer Fort, Gadsisar Lake, Nathmalji-ki-Haveli, Patwon -ki-Haveli, Salim Singh-ki-Haveli and Jain Temple & in the afternoon an exciting trip to Sand dunes and camel safari, night Halt at Jaisalmer.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1106, 10, 5, 'Jaisalmer -Jodhpur Drive', 'Drive to Jodhpur and check-in at a hotel. Jodhpur has several major tourist attractions like Umaid Bhawan Palace, Girdikot and Sardar Market famous for a wide range of handicrafts. Night halt at Jodhpur.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1107, 10, 6, 'Jodhpur Tour', 'Mehrangarh-Fort Sightseeing of Jodhpur including Mehrangarh Fort and Jaswant Thada built in 1899 A.D. in memory of Maharaja Jaswant Singh II. An afternoon sightseeing trip will cover all these destinations. Night halt at Jodhpur.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1108, 10, 7, 'Jodhpur -Udaipur Drive', 'While driving to Udaipur enroute visit Ranakpur Temples, This huge temple complex is located just 90 km from Udaipur city. These are the most extensive of Jain temples in India, covering an area of around 40,000 square feet. Check-in at the hotel for overnight.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1109, 10, 8, 'Udaipur Tour', 'Jag-MahalCity sightseeing tour, Major tourist attractions in Udaipur are Lake Pichola, the largest and the most beautiful of Udaipurâ€™s lakes, City Palace, on the banks of the Lake Pichola, island palaces like Jag Mahal and Jag Niwas, Jagdish Temple, Sahelion Ki Bari, Gulab Bagh (Rose garden) and the 18th century monsoon palace, Sajjangarh. Spend leisure time during afternoon.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1110, 10, 9, 'Udaipur-Pushkar Drive', 'Sightseeing of the holy city of Pushkar, You will get an opportunity to see various religious traditions and rituals practiced in India. Pushkar has several beautiful temples like Brahma Temple, Rangaji Temple, and Savitri Temple, holy ghats and lakes like the famous Pushkar Lake and Night stay in Pushkar.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1111, 10, 10, 'Pushkar-Jaipur Drive', 'Sightseeing tour of Jaipur, visiting sprawling Havelis, serene temples and well laid out gardens of Jaipur, enjoy the architectural excellence of Amber Fort, City Palace, Jantar Mantar, Hawa Mahal and shop for the unique handicrafts of local people. Night halt at Jaipur Drive to Ranthambhore, afternoon jeep safari to view Wildlife. Ranthambore National Park is spread over in an area of 392 sq. kilometrtes.Night stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1112, 10, 11, 'Jaipur- Ranthambore Drive', 'After Jaipur sightseen you drive to Ranthambore National Park , check-inn in the hotel and night stay in ranthambore city.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1113, 10, 12, 'Ranthambhore Forest Tour', 'Ranthambore-National-ParkMorning & afternoon jeep safari to view wildlife, Ranthambore National Park is home of variety of animals like Tiger, sambhar, cheetal, wild boar, leopard, sloth bear, and jackal. Night halt at Ranthambhore.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1114, 10, 13, 'Ranthambore-Agra Drive', 'Taj-MahalSightseeing tour of Agra, visiting Taj Mahal, Agra Fort, Jehangir Mahal, Diwan-i-Khas, Diwan-i-Am and Moti Masjid experience the traditional art and craft of Agra like the famous fine marble inlay work and other handicraft products. Night halt at Agra.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1115, 10, 14, 'Agra Delhi Delhi', 'Reaching Delhi after a 204 km long comfortable drive & night stay in Delhi.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1116, 10, 15, 'Delhi Airport transfer', 'Next day after breakfast we will transfer to Airport/Railway station.\r\nPlease note that this is all flexible tour itinerary according to your comfort if you want any change or tailor made itinerary , its will be possible.', NULL, NULL, NULL, 0, '2026-01-06 07:13:30'),
(1141, 11, 1, 'Pickup from airport /train station', 'Pickup from airport /train station and transfer to hotel, Refresh than after start Delhi tour by car and visit sight Old Delhi â€“Red Fort-Jama Masjid-RajGhat-Humayan tomb-India Gate-President House of India-Qutab Miner & night stay in Delhi', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1142, 11, 2, 'Delhi - Agra Drive', 'Pickup from hotel and drive to Agra, check-in in the hotel and refresh after visit Agra fort & Taj Mahal and some local area walking tour â€“Night stay in Agra.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1143, 11, 3, 'Agra-Fathepur Sikri-Jaipur Drive', 'Pick from hotel and drive to Jaipur en-route visit world heritage site fathepur sikri and after continue drive to Jaipur-night stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1144, 11, 4, 'Jaipur Tour', 'This morning after breakfast you visit Amber fort-Water palace-city palace-wind palace-monkey temple and some walking in bazaar-night stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1145, 11, 5, 'Jaipur - Pushkar Driver', 'This day after breakfast you drive to next holy city Pushkar, arrived in Pushkar and check-in the hotel, in evening you enjoy the Pushkar city and night stay in Pushkar.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1146, 11, 6, 'Pushkar - Udaipur Drive', 'Pickup from hotel and drive to Lake City Udaipur, reach around in evening and some evening tour in the city- night stay in Udaipur.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1147, 11, 7, 'Udaipur - Jodhpur Drive', 'This morning after breakfast check-out and start sight seen and visit fathe Sagar Lake and city palace, Jagdish temple and after lunch drive to next city Jodhpur â€“night stay in jodhpur.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1148, 11, 8, 'Jodhpur - Jaislmer Drive', 'Breakfast and Check-out after visit Jodhpur fort and some more sight seen after lunch drive to Next city Jaislmer-night stay in Jaislmer.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1149, 11, 9, 'Jaislmer - Kuri Tour', 'This morning after breakfast check-out and sight seen in the city, visit most famous attraction after drive to Kuri Desert. Arrive in desert and after start desert tour by camel and night stay in desert camp.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1150, 11, 10, 'Kuri - Bikaner Drive', 'After breakfast you drive to next city Bikaner, check inn in the hotel and after in evening you visit Bikaner fort â€“Night stay in Bikaner.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1151, 11, 11, 'Bikaner - Mandwa Drive', 'Drive to heritage village Mandwa and reach in evening-night stay in Mandwa.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1152, 11, 12, 'Delhi - Mandwa Drive', 'Visit Mandwa walking tour and see the many old Havali, Houses after sight seen- Night stay in Delhi.', NULL, NULL, NULL, 0, '2026-01-06 07:15:41'),
(1180, 13, 1, 'Delhi Airport Arrival', 'Meet and assist by our representative upon your arrival at the airport and drive to hotel, Rest after Delhi Private Trip-\r\n\r\nRed Fort-Old Delhi-Rajghat-India Gate-Humyun tomb-lotus temple-Qutab miner', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1181, 13, 2, 'Delhi- Bikaner', 'After breakfast in drive to Bikaner via Mandawa, visit Mandawa and see the local village life-stay in Bikaner', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1182, 13, 3, 'Bikaner Jaislmer', 'After breakfast drive to Jaislmer city is one of India most beautiful, colorful & fascinating place. Arrive Jaislmer check in at Hotel. Stay Jaislmer', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1183, 13, 4, 'Jaislmer Sightseen', 'After a relaxed breakfast proceed for full day sightseeing tour of The Golden City - Jaislmer. It is in the heart of the Great Indian Desert. Its temple, fort and palaces are all built of yellow stone. The city is a mass of intricately carved buildings, facades and elaborate balconies. visit the Jaislmer fort-oldest living fort , Desert Camel ride etc-Stay Jaislmer', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1184, 13, 5, 'Jaislmer Jodhpur', 'After breakfast drive to Jodhpur the Gateway to the Thar Desert. Arrive Jodhpur check in at hotel. After visit Jaswant Thada and Meharangarh-Stay Jodhpur', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1185, 13, 6, 'Jodhpur Ranakpur', 'After breakfast drive to Ranakpur visit world famous 500 years old incredible jain temple with 1444 pillar, all pillar are different then each other. After jain temple visit to natural lake with very nice view of sun set-Stay Ranakpur', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1186, 13, 7, 'Ranakpur Udaipur', 'After Ranakpur drive to Udaipur â€“the city of the lakes , arrive and stay in Udaipu', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1187, 13, 8, 'Udaipur Sightseen', 'This morning after breakfast visit Udaipur and see the nice lakes and life etc-Stay in Udaipur', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1188, 13, 9, 'Udaipur Pushkar', 'After breakfast drive to Pushkar edge of the desert lies the tiny tranquil town of Pushkar along the bank of the picturesque Pushkar Lake. This is an important pilgrimage spot for the Hindus, which has the only temple of Lord Brahma in the country and one of the few in the world. Stay Pushkar', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1189, 13, 10, 'Pushkar Jaipur', 'After breakfast proceed to Jaipur the capital of Rajasthan, arrive Jaipur and check-inn and after the city tour.', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1190, 13, 11, 'Jaipur Sightseen', 'Drive  to the Hawa Mahal, Jantar Mantar, City Palace , wind Palce amber fort  and the in-house Museum. Walk along the bazaars of the Pink City and enjoy the colorful life of the city. You will be amazed at the sight of the men and the women folk dressed in the most colorful way, especially ladies adorned with heavy silver jewelry-Stay Jaipur', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1191, 13, 12, 'Jaipur Ranthambore-National Game Park', 'After breakfast drive to Ranthambore national park, arrive afternoon and relex-stay Ranthambore', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1192, 13, 13, 'Ranthambore-National Game Park Safaris', 'This morning visit game park 6:00 am - 11:00 am Jeep safari and 2nd safari 14:00 pm to 18:00 Pm\r\n\r\nHere you have chance to see many animal and Indians tigers-night stay in Ranthambore', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1193, 13, 14, 'Ranthambore-Agra via fatepur sikri', 'After breakfast check out from the hotel and drive to city of marble Agra via fatepursikri-Stay Agra', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1194, 13, 15, 'Tajmahal Visit and drive to Khajuraho', 'Visit Tajmahal morning (sunrise) after breakfast and drive to Kamasutra city Khajuraho-Stay Khajuraho.', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1195, 13, 16, 'Khajuraho Tour', 'After breakfast in hotel proceed to explore beautiful town Khajuraho. Khajuraho known for its temples built from 950 A.D to 1150 AD, by the Candela Dynasty. The group of thirty temples urahois an example of Indian architectural excellence The Western group of temples are best known for their erotic sculptures. Stay Khajuraho', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1196, 13, 17, 'Khajuraho Varanasi Flight', 'Driver drop you Khajuraho airport and flight to Varanasi , pickup Varanasi airport and move to the hotel\r\n\r\n After we take you to banks of the river Ganges where we board a boat to see the morning ablutions of the Hindus from the security of our boat.See the Kashi Vishwanath temple and the Gyanvyapi kund and the mosque attached to it. Also visit the Benares Hindu University the largest residential university in India with more than 3000 residential students', NULL, NULL, NULL, 0, '2026-01-06 07:22:09'),
(1202, 5, 1, 'Delhi - Manali', 'On arrival at Delhi, our representative meets you and assists to transfer you to Manali 570 km/ 11 hrs. On arrival check in at hotel, freshen up and enjoy rest of the time at leisure. At night enjoy delicious dinner and overnight stay t the hotel in Manali.', NULL, NULL, NULL, 0, '2026-01-06 07:45:17'),
(1203, 5, 2, 'Manali Sightseeing', 'Morning after breakfast get ready for city tour to visit some of the magnificent attractions including Hadimba Devi Temple, Tibetan Monastery, Manu Temple and Vashisht Village. Afternoon enjoy at leisure. Dinner and overnight stay will be at the hotel in Manali.', NULL, NULL, NULL, 0, '2026-01-06 07:45:17'),
(1204, 5, 3, 'Manali Excursion', 'Enjoy the early morning breakfast at the hotel. Later visit to Kothi Gorge, Marhi, Rothang pass and Marhi. Rothang Pass is an important tourist spot with alluring view of the snow capped Himalayas, picturesque lakes and scintillating tranquil surrounding. After visiting to Solang Valley, return back to the hotel on time and enjoy delicious dinner and overnight stay. .( in Winter Car will be going only up to the Snow point).', NULL, NULL, NULL, 0, '2026-01-06 07:45:17'),
(1205, 5, 4, 'Manali - Manikaran via Kullu - Manali', 'Morning after breakfast, check out from the hotel and drive to Manikaran 75 kms /4 hours, enroute visiting Kullu. Manikaran is located in Parvati valley amidst the river Vyaas and Parvati in the Kullu district of Himachal Pradesh. Manikaran is holy centre of both Hindu and Sikh religion. It is believed that Manu created human life again in Manikaran after the devastating flood, making the place centre of pilgrimage. After visit to Manikaran transfer to Kullu valley (45 kms/2 hours) for a half day sightseeing tour and panoramic view of the natural beauty and snow capped himalayas. Return to Manali by evening for dinner and overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 07:45:17'),
(1206, 5, 5, 'Manali - Delhi', 'Morning after breakfast, check out from the hotel and transfer to Delhi 520 K M (10 hrs).', NULL, NULL, NULL, 0, '2026-01-06 07:45:17'),
(1241, 66, 1, 'MUMBAI - BARODA', 'India Trip Planners will welcome you at Baroda and get you some brief details of the tour plan while getting transferred to the hotel. The tour starts with Baroda which is one of the major known cities in Gujarat that is extremely famous for its art galleries and massive museums. After visiting these you will get introduced to the history of the state and its prime legacies. After the architectural sites of Baroda, you will visit the historical city of Champaner which is located in about 50 km from Baroda. This city houses the world heritage site named as Pavagadh Archaeological Park. While being in here at this destination, do not miss to visit the tribal hamlets of Chhota Udepur and the exotic paintings which double up the beauty of the walls of their houses. Return back to Baroda for your night stay.', NULL, NULL, NULL, 0, '2026-01-06 09:17:15'),
(1242, 66, 2, 'BARODA - AHMEDABAD', 'From Baroda, you will be traveling to Ahmedabad which is one of the most popular cities in the state from both point of view, may it be the business related guests or the leisure tourists. Ahmedabad is called to be one of the most preferred tourist destinations in the country. So, get yourself check into the hotel. The mausoleums and the mosques which are here show an impressive insight into the art and architecture of the late centuries. An Indo-Saracen style of architecture is being housed on the monuments of Ahmedabad which is totally a treat to every onlooker. You could also visit the famous Gandhi Ashram and the several other museums for getting in touch with the various different style of architecture. Return to the hotel at Ahmedabad and stay for overnight', NULL, NULL, NULL, 0, '2026-01-06 09:17:15'),
(1243, 66, 3, 'AHMEDABAD - LOTHAL', 'In the morning, visit the splendid mansions which are known as \'havelis\'. These havelis are the residences of the rich traders and are no less than palaces. The best can be gained by strolling through these beautifully carved havelis with remarkable architecture. After the visit to havelis, you will proceed towards next destination Lothal which is another historically significant town of India. The archeological side of Lothal is extremely known and has become a very important center. It showcases mind blowing designing, planning, and architecture of the era. Relax and stay for overnight at Lothal.', NULL, NULL, NULL, 0, '2026-01-06 09:17:15'),
(1244, 66, 4, 'LOTHAL - PALITANA - DIU', 'Proceed towards Palitana on the 4th day of the tour, it is renowned for its temple complex. Jain pilgrims mostly visit the complex situated on top of the Shatrunjaya hill. The temple complex caters more than 1300 temples in its circumference and all are beautifully carved out of pure marble. After your visit to the Jain religious site, now it is time to move on to visit the Portuguese sites housed in Gujarat and to do so, you will have to move ahead to Diu where the architectural styles of 16th and 17th century churches will attract all the artists in large numbers. The Portuguese forts are also there, so visit it after the churches. Return to hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:17:15'),
(1245, 66, 5, 'PALITANA - SOMNATH - GIR', 'On the 5th day of the tour early in the morning, begin your day by traveling to Somnath. It is a place of great significance for the Hindus religion. It is worldwide famous due to its temple which consists of the twelve Jyotirlingas of Lord Shiva and on special dates and occasions, this place is fully crowded by thousands of devotees. A visit to the Somnath temple is going to relish you with its beauty and architecture. From Somnath, travel towards Gir which is your next destination of this tour plan. Reach and stay for overnight in hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:17:15'),
(1246, 66, 6, 'GIR - JUNAGADH – GONDAL', 'The tour plan is totally incomplete without covering this fantastic wildlife sanctuary of Gujarat that is Gir National Park. It cannot be imagined without including the Gir National Park. It is frequently visited by the tourists for the exotic view of Lion’s collection. After your visit to the wildlife, you will proceed towards the historically rich place that is Junagadh. Junagadh is famous for its various different numbers of forts and palaces that were once residences of the members of the royal family. To get the detailed insights of legacies and history, then visit the Junagadh Museums. After all this in Junagadh, the next destination which you will be visiting is Gondal which is extremely famous for the Naulakha Palace. This place is a must visit type of destination which is being included in this tour plan circuit. Stay for an overnight here in Gondal.', NULL, NULL, NULL, 0, '2026-01-06 09:17:15'),
(1247, 66, 7, 'GONDAL - DASADA', 'An architectural trip to Gujarat has much more to offer you with such as deserts. Therefore on this day, you will begin with a short excursion to the Rann of Kutch. It is renowned for its distinct wildlife; this area is also fondly frequented for the vibrant villages that surround it. On your way, you will also visit the artisans of Dasada before you arrive in Jhijhwada. The history and architecture of this place can be very well acknowledged of the early centuries. Overnight stay is arranged in Dasada.', NULL, NULL, NULL, 0, '2026-01-06 09:17:15'),
(1248, 66, 8, 'DASADA - MODHERA - PATAN - BALARAM', 'This day is dedicated for a combination of the destinations in which you will be covering Modhera, Patan and Balaram. So leave for Modhera from Dasada after your breakfast. One of the most exotic Hindu temples in western India is The Sun temple as it is believed that a prayer here never goes unanswered. The architecture style is amazing too. After your visit to Modhera, you will halt at your next destination which is Patan which is famous for its ancient and grand step-well and is most celebrated site of the country. From Patan, visit Balaram which is known for its exquisite palace named as Balaram Palace. Explore the houses of the princely state and enjoy the architecture and its creative art. Rest at your pre-booked hotel at Balaram and spend a comfortable night stay.', NULL, NULL, NULL, 0, '2026-01-06 09:17:15'),
(1249, 66, 9, 'BALARAM - TARANGA - VADNAGAR - AHMEDABAD', 'On the 9th day, travel from Balaram towards Taranga and Vadnagar which are the historical sites for its heritage and attracts guests from all over the world to visit and gain a wonderful as well as magical experience by being here. Taranga is renowned for its Jain Temples and Vadnagar, on the other hand, is most visited for its exotic and pleasing collection of ancient buildings and grand monuments. After visiting these medieval Indian cities, you will then proceed towards Ahmedabad which is your final destination of this tour plan. Check in and an overnight stay at the Ahmedabad hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:17:15'),
(1250, 66, 10, 'AHMEDABAD', 'This is going to be the last day of your architectural tour of Gujarat and Mumbai. According to your flight schedules, get transferred to the Ahmedabad airport for your final voyage back home. The trip is a perfect choice for exploration of the architecture side of both these sites. It is a combination of historic as well as entertainment at its best.', NULL, NULL, NULL, 0, '2026-01-06 09:17:15'),
(1251, 65, 1, 'Ahmedabad – Little Rann of Kutch', 'Today, proceed to Little Rann of Kutch. On arrival check in to the resort. One can visit the home of Rabari and Banjara are the two important tribes of the region. Overnight stay at Little Rann of Kutch.', NULL, NULL, NULL, 0, '2026-01-06 09:28:35'),
(1252, 65, 2, 'Little Rann of Kutch – Jamnagar – Dwarka', 'Today, proceed to the sacred town of Dwarka. Enroute visit Jmangar. At Jamnagar visit Lakhota Lake & Lakhota Museum. In the evening, visit Bala Hanuman Temple known for its nonstop Ramdhun since 1956 and it mentioned in Guinness Book of World Records. At Dwarka Visit Dwarkadeesh Temple. Take a holy dip in Gomti river. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:28:35'),
(1253, 65, 3, 'Dwarka- Excursion to bet dwarka', 'In the morning leave to visit Nageshwar Jyotirling, Gopi Talav, Bet Dwarka, and on way back do visit Rukmani Temple, evening visit other temples on coastal area, attend evening aarti at Dwarkadish temple. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:28:35'),
(1254, 65, 4, 'Dwarka – Porbandar – Somnath', 'In the morning depart to Porbandar (75km/1.5hrs) at Porbandar visit Kirti Mandir – the place where Gandhiji was born and Sudama Temple – The only Sudama Temple in the world. Later proceed to Somnath (130km/2.5hrs) on arrival visit Bhalka Tirth, Triveni Sagam, Geeta Mandir Chopati & Somnath Temple. In the evening attend Aarti and later watch light and Sound show. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:28:35'),
(1255, 65, 5, 'Somnath – Diu', 'Today, after breakfast proceed to beach town Diu. Later, visit St. Paul\'s Church, Diu Museum and Diu Fort. Evening is at leisure to laze and relax on the beach. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:28:35'),
(1256, 65, 6, 'Diu – Sasangir', 'After breakfast Proceed to Sasangir. Sasangir, is the home of the Asiatic Lion. On arrival get ready for open jeep safari at Gir National Park( Jeep Safari to be booked from www.girlion.in). Later, Visit Gir Interpretation Zone at Devaliya (Closed on Wednesday) Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:28:35'),
(1257, 65, 7, 'Sasangir – Palitana – Bhavnagar', 'Today, proceed to Bhavnagar. Enroute visit temples city Palitana, Famous Jain temples at Shatrunjaya Hills. Continued towards Bhavnagar. In the evening visit Takhteshwar Temple located on the small hillock. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:28:35'),
(1258, 65, 8, 'Bhavnagar – Lothal – Ahmedabad', 'Today, after breakfast proceed to visit Nishkalank Mahadev Temple in Koliyak, Bhavnagar. On the way visit Lother archeological site (Closed on Friday). Drop at Railway Station/Airport.', NULL, NULL, NULL, 0, '2026-01-06 09:28:35'),
(1259, 64, 1, 'Ahmedabad – Dwarka ( 450km / 8hrs )', 'Today, proceed to the sacred town of Dwarka. Visit Dwarkadeesh Temple. Take a holy dip in Gomti river. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:29:15'),
(1260, 64, 2, 'Dwarka- Excursion to bet dwarka', 'In the morning leave to visit Nageshwar Jyotirling, Gopi Talav, Bet Dwarka, and on way back do visit Rukmani Temple, evening visit other temples on coastal area, attend evening aarti at Dwarkadish temple. Overnight stay at the hotel', NULL, NULL, NULL, 0, '2026-01-06 09:29:15'),
(1261, 64, 3, 'Dwarka – Porbandar – Somnath', 'In the morning depart to Porbandar (75km/1.5hrs) at Porbandar visit Kirti Mandir – the place where Gandhiji was born and Sudama Temple – The only Sudama Temple in the world. Later proceed to Somnath (130km/2.5hrs) on arrival visit Bhalka Tirth, Triveni Sagam, Geeta Mandir Chopati & Somnath Temple. In the evening attend Aarti and later watch light and Sound show. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:29:15'),
(1262, 64, 4, 'Somnath – Diu', 'Today, after breakfast proceed to beach town Diu. Later, visit St. Paul’s Church, Diu Museum and Diu Fort. Evening is at leisure to laze and relax on the beach. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:29:15'),
(1263, 64, 5, 'Diu – Sasangir', 'After breakfast Proceed to Sasangir. Sasangir, is the home of the Asiatic Lion. On arrival get ready for open jeep safari at Gir National Park( Jeep Safari to be booked from www.girlion.in ). Later, Visit Gir Interpretation Zone at Devaliya (Closed on Wednesday) Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:29:15'),
(1264, 64, 6, 'Sasangir – Ahmedabad', 'Today, after breakfast proceed to Ahmedabad. On arrival drop at Railway Station/Airport.', NULL, NULL, NULL, 0, '2026-01-06 09:29:15'),
(1265, 63, 1, 'Ahmedabad – Little Rann of Kutch ( 90km / 2hrs )', 'Today, proceed to Little Rann of Kutch. On arrival check in to the resort. One can visit the home of Rabari and Banjara are the two important tribes of the region. Overnight stay at Little Rann of Kutch.', NULL, NULL, NULL, 0, '2026-01-06 09:30:02'),
(1266, 63, 2, 'Little Rann of Kutch – Jamnagar – Dwarka ( 360km / 7hrs )', 'Today, proceed to the sacred town of Dwarka. Enroute visit Jmangar. At Jamnagar visit Lakhota Lake & Lakhota Museum. In the evening, visit Bala Hanuman Temple known for its nonstop Ramdhun since 1956 and it mentioned in Guinness Book of World Records. At Dwarka Visit Dwarkadeesh Temple. Take a holy dip in Gomti river. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:30:02'),
(1267, 63, 3, 'Dwarka- Excursion to bet dwarka ( km / hrs )', 'In the morning leave to visit Nageshwar Jyotirling, Gopi Talav, Bet Dwarka, and on way back do visit Rukmani Temple, evening visit other temples on coastal area, attend evening aarti at Dwarkadish temple. Overnight stay at the hotel', NULL, NULL, NULL, 0, '2026-01-06 09:30:02'),
(1268, 63, 4, 'Dwarka – Porbandar – Somnath ( 200km / 4hrs )', 'In the morning depart to Porbandar (75km/1.5hrs) at Porbandar visit Kirti Mandir – the place where Gandhiji was born and Sudama Temple – The only Sudama Temple in the world. Later proceed to Somnath (130km/2.5hrs) on arrival visit Bhalka Tirth, Triveni Sagam, Geeta Mandir Chopati & Somnath Temple. In the evening attend Aarti and later watch light and Sound show. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:30:02'),
(1269, 63, 5, 'Somnath – Diu ( 100km / 2hrs )', 'Today, after breakfast proceed to beach town Diu. Later, visit St. Paul\'s Church, Diu Museum and Diu Fort. Evening is at leisure to laze and relax on the beach. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:30:02'),
(1270, 63, 6, 'Diu – Sasangir ( 110km / 2hrs )', 'After breakfast Proceed to Sasangir. Sasangir, is the home of the Asiatic Lion. On arrival get ready for open jeep safari at Gir National Park( Jeep Safari to be booked from www.girlion.in). Later, Visit Gir Interpretation Zone at Devaliya (Closed on Wednesday) Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:30:02'),
(1271, 63, 7, 'Sasangir – Palitana – Bhavnagar ( 210km / 4hrs )', 'Today, proceed to Bhavnagar. Enroute visit temples city Palitana, Famous Jain temples at Shatrunjaya Hills. Continued towards Bhavnagar. In the evening visit Takhteshwar Temple located on the small hillock. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:30:02'),
(1272, 63, 8, 'Bhavnagar – Lothal – Ahmedabad ( 200km / 4hrs )', 'Today, after breakfast proceed to visit Nishkalank Mahadev Temple in Koliyak, Bhavnagar. On the way visit Lother archeological site (Closed on Friday). Drop at Railway Station/Airport.', NULL, NULL, NULL, 0, '2026-01-06 09:30:02'),
(1283, 62, 1, 'Arrival Ahmedabad', 'On your arrival at Ahmedabad you will be welcome by our representative & transfer to hotel. Check-in & day free for own activities. Overnight stay at Ahmedabad.', NULL, NULL, NULL, 0, '2026-01-06 09:31:46'),
(1284, 62, 2, 'Ahmedabad', 'Morning after breakfast visit to Calico Museum of Textiles, a museum devoted exclusively to clothes. It includes a vast collection of textiles like Indian silk that has been discovered at famous archaeological sites in Egypt. Later visit the famous Sarkhej mausoleum complex and Vishala Village complex that boasts of a famous museum of utensils. Return back to the hotel for overnight stay', NULL, NULL, NULL, 0, '2026-01-06 09:31:46'),
(1285, 62, 3, 'Ahmedabad – Jambughoda', 'Morning after breakfast drive to Jambughoda. On arrival check-in to the hotel. Afternoon safari at Jambughoda wildlife sanctuary, former private hunting village of the Prince of Jambughoda. During the safari ride you will have opportunity to see animal species like Leopard, Jackal, Sloth Bear, and Wild Boar etc. Evening visit to the nearby village. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:31:46'),
(1286, 62, 4, 'Jambughoda – Chhota Udaipur – Jambugodha', 'Morning after breakfast visit to Chotta Udaipur, a significant state, earlier known as Rewa Kantha. Visit the surroundings the colorful tribal villages. Observe the traditional lifestyle of locals. Return back to Jambughoda for an overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:31:46'),
(1287, 62, 5, 'Jambugodha – Uthelia', 'Morning at leisure after breakfast drive to Uthelia. Enroute visit to Champaner, the chronological city of Gujarat. This UNESCO World heritage site is dotted with several architectural monuments; visit Champaner Fort, Jama Masjid, Kalika temple etc. Arrive Uthelia late in the evening. Check-in to the hotel for an overnight stay', NULL, NULL, NULL, 0, '2026-01-06 09:31:46'),
(1288, 62, 6, 'Uthelia – Bhavnagar', 'Morning at leisure after breakfast, visit Lothal, one of the important place of witnessing Harappan civilization. Visit the remains of the famous commercial center during 2000 BCE. After visiting Lothal continue you drive to Bhavnagar. Arrive Bhavnagar & check-in to the Hotel. Later visit the Barton Museum and local market. Overnight stay at Bhavnagar', NULL, NULL, NULL, 0, '2026-01-06 09:31:46'),
(1289, 62, 7, 'Bhavnagar – Palitana – Bhavnagar', 'Morning after breakfast full day tour to Palitana, an important religious site for the followers of Jain religion who believe that to achieve nirvana, they need to visit this site. Palitana Jain temples, located on Mount Shatrunjaya, are around 863 marble-cut temples, which were carved during the 11th to 20th century. After visiting Palitana return back to hotel. Overnight stay at Bhavnagar.', NULL, NULL, NULL, 0, '2026-01-06 09:31:46'),
(1290, 62, 8, 'Bhavnagar – Gondal', 'Morning at leisure after breakfast drive to Gondal. Arrive Gondal at the time of lunch, check-in to the hotel. Later visit Naulakha palace & the vintage car collection of the royal family of Gondal. Return back to the hotel for overnight stay', NULL, NULL, NULL, 0, '2026-01-06 09:31:46'),
(1291, 62, 9, 'Gondal – Wankaner', 'Morning after breakfast drive to Wankaner, a former Royal state of Gujarat. Enroute visit Watson Museum-one of Gujarat’s largest museums and Rashtriya Shala. Continue your drive to Wankaner. On arrival at Wankaner check-in at the hotel. Later visit Wankaner Palace Museum & nearby local village. Overnight stay at the hotel in Wankaner.', NULL, NULL, NULL, 0, '2026-01-06 09:31:46'),
(1292, 62, 10, 'Wankaner – Ahmedabad – Departure', 'Morning after breakfast drive to Ahmedabad. On arrival in Ahmedabad in time transfer to airport to board the flight for onwards destination.', NULL, NULL, NULL, 0, '2026-01-06 09:31:46'),
(1293, 59, 1, 'ARRIVE COCHIN', 'The ultimate tour begins with India Trip Planners team members who will be overwhelmed in receiving you at Cochin airport and you will be transferred to hotel for your check in. Relax for a while as and when you reach to your hotel. Cochin sightseeing will enrich you with the remarkable history; fascinate you with its amendable culture. So, quickly take a sunset cruise ride along the backwaters of Cochin for experiencing the illuminated views of the Marine Drive and its sides. Stay overnight in the hotel', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1294, 59, 2, 'COCHIN', 'Today, you will visit the main tourist attractions of Cochin such as Dutch Palace, Jewish Synagogue, Spice Market, Hill Palace, St.Francis Church, Santa Cruz Basilica and Puthuvype Beach. To spend some romantic time with your partner you can go to Fort Kochi Beach. Later on, watch an amazing Kathakali performance which in known to be famous from its ancient times in Kerala. Return to your hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1295, 59, 3, 'COCHIN – ALLEPPEY HOUSEBOAT', 'This is going to be the ultimate day when you will leave for Alleppey to board onto the Houseboat. Earlier, Houseboats were known as Kettuvallams or Rice Boats which were used as ferries to carry rice, now it has come out in the modern form. You will take your lunch on the houseboat and after that, you will be taken on a cruise through the narrow canals of the Vembanad Lake. The floating markets in canoes and exotic landscapes of rolling paddy fields around all add an ethnic touch to the cruise. The stay is on houseboat itself. So, enjoy the sunset and later do peacefully the gazing of stars which can be rarely done when in crowded cities. Also, enjoy your dinner with the sounds of water gushing through and fro over the moors.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1296, 59, 4, 'ALLEPPEY – KUMARAKOM', 'Move to the next destination after breakfast that is Kumarakom. As per your arrival, you will check into the hotel which is already reserved for you. Get the fantastic Ayurvedic treatments of massage and spa which is being offered by the resorts and get relaxed right in the lap of nature. Enjoy the views of greenery and the fascinating beauty of the place in the evening. Overnight stay is at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1297, 59, 5, 'KUMARAKOM', 'Kumarakom is situated on the shores of the tranquil Vembanad Lake which is around 14 km from Kottayam. It is the best place in whole Kerala for clicking pictures of the scenic beauty. It caters many small clusters of islands which make it more beautiful. Kumarakom has become very famous now and it attracts many tourists from all over the world; also it has grown up as a bird sanctuary. It is the best place to be upon over holidays, offering beautiful surroundings. There are many things to do additionally such as boating and fishing. On request, Canoe trips can be organized and are best enjoyed early in the morning or during the evenings. After this fun-filled day, you will return to your hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1298, 59, 6, 'KUMARAKOM – PERIYAR', 'After your delightful breakfast, drive to Periyar which is also called as Thekkady on the 6th day of your trip. It is one of the most popular wildlife sanctuaries in South India. Periyar is an area of serene lakes, dense woods, craggy hills and spice gardens. Check into the hotel as per your arrival. Relax for some time and then in the afternoon, go for sightseeing of this magical place of South India. Later, return to the hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1299, 59, 7, 'PERIYAR', 'The day is dedicated for Periyar; so after breakfast start your sightseeing with Periyar Wildlife Sanctuary. Here to get a view of large variety of wildlife species like Wild Elephants, Sambar Deer, Nilgiri Langur, Wild Bison, Wild Boar and also some unique birds; then take a Wildlife cruise. After finishing up with the wildlife sanctuary, explore the Hill Station and Spice Plantation where you can do certain activities like Bamboo Rafting, Trekking and Elephant ride. Later, get back to the hotel for a comfortable night stay.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1300, 59, 8, 'PERIYAR – MUNNAR', 'Proceed to your next destination which is Munnar after a delightful breakfast at the hotel. Munnar is a place which is full of joyous beauty. Upon arrival, get to check into the hotel. Begin the sightseeing of Munnar and in evening you can walk through the Munnar Tea Museum and also visit the Cardamom Curing Centre. Spend your night in hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1301, 59, 9, 'MUNNAR', 'Today after your breakfast, you are going to spend a full day sightseeing of this extraordinary place, Munnar. A vacation plan at Munnar will be etched in your memory for years as it consists of Emerald green hills with mist looming over them like wandering ghosts. Start by exploring Eravikulam National Park which is approximately 30 minutes away from Munnar and Nilgiri Thaars is the main attraction of this park being protected at its best. Return and explore Attukal Waterfalls, Mattupetty Dam, Echo Point, Kundala Lake and Mount Carmel. After that, have your dinner at the hotel and stay for overnight.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1302, 59, 10, 'MUNNAR', 'The morning breeze at this place giving you perfect picture when waterfalls down the hills makes a sound of numerous streams of gurgle along generating a feeling in you that you never want to go back from here. After your breakfast, we will move further to do the exploration of Chinnar Wildlife Sanctuary, Amaravati Reserve Forest, Kurinjimala Sanctuary, Anamudi Shola National Park and the Pampadum Shola National Park. A visit to all these is going to be highly educational and peaceful. In the end, explore the more quiet and scenic spot named as Devikulam Lake. One can also choose to do some other activities such as cycling, paragliding, rock climbing and much more. Return to the hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1303, 59, 11, 'MUNNAR – ATHIRAPALLY', 'From Munnar, it takes nearly four hours to reach to your next planned destination that is Athirapally. In between, you will take a stopover at Guruvayoor which is the hallowed town close to Thrissur that is well-known for its fabled Shree Krishna Temple. Non-Hindus are not allowed inside the temple premises is the only a hitch. But the narrow lanes with blooming trees on sides that lead to the temple is a huge treat and is just not to be missed part of your plan. Enjoy there and then as per your arrival, check into the hotel for a comfortable overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1304, 59, 12, 'ATHIRAPALLY', 'Today, the complete day is scheduled for Athirapally which is positioned at the opening point of the Sholayar forest range. After your breakfast, get on the ride to see its unparallel beauty which defies even words. We will start with its mighty waterfalls which is of over 80 ft that cascade down the rocks with a furious roar as it sprinkles you, is the best sight to behold on this Kerala trip. Then from there, we will move to explore Kauthuka Park followed by Charpa Waterfalls for an ultimate bird watching near to it. Later, return to your hotel for a comfortable stay', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1305, 59, 13, 'ATHIRAPALLY – WAYANAD', 'After breakfast, we will check out from Athirapally and will head towards Wayanad which is Eden, if Kerala is the God’s own country. As per your arrival, check into the hotel. Later, we will begin with the sightseeing of Wayanad which is filled with all tropical rainforests, grassy meadows, expansive tea estates and aromatic spice gardens. We will visit the imperious Edakkal caves and the Jain shrines at Wayanad. After that, enjoy your night with delicious dinner and a relaxing night stay.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1306, 59, 14, 'WILDLIFE ADVENTURE AT WAYANAD', 'The super fantastic 14th day of your trip on which you will be excursing the well known site of Wayanad known as “The Wayanad Wildlife Sanctuary”. It is home to a variety of indigenous species of animals and birds. Enjoy your safari in this wildlife sanctuary by capturing the clicks of different species. Later in the afternoon, you will drive to Kuruva Island which is a lonely group of islets spot in the middle of the River Kabini. After that, come back to the hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1307, 59, 15, 'WAYANAD – TELLICHERRY', 'Today you will move to Tellicherry which is also known as Thalassery is a boisterous fishing town close to the northern edge of Calicut. Check into your pre booked hotel, as per your arrival. Later on in the evening, there will be a traditional dance performance will be arranged for you named as Theyyam. Spend a night in this beautiful part of Kerala.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1308, 59, 16, 'TELLICHERRY', 'After your breakfast, we will visit the grand Tellicherry Fort which is structured magnificently. On returning from the fort, we will stop over at the vibrant fish markets of Tellicherry. After that, we will explore the Ramaswami Temple and then a short drive away to the picturesque and pleasing Muzhipillangad Beach. The extreme beauty and the white sand will please you with ultimate joy and happiness. Relax there for a while and then return to the hotel for a peaceful night stay.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52');
INSERT INTO `package_itinerary` (`id`, `package_id`, `day_number`, `title`, `description`, `meals`, `accommodation`, `activities`, `display_order`, `created_at`) VALUES
(1309, 59, 17, 'TELLICHERRY – NILESHWAR', 'From Tellicherry, take a journey towards Nileshwar after your breakfast at the hotel. A visit to this destination is going to be a lifetime memorable site of this complete Kerala trip. Reach Nileshwar and check into the already reserved hotel for you. Relax for some time and then do the excursion of this extraordinary place of South India. This is the best place to relax with an Ayurveda massage at a resort. In the evening, you will pay a visit to the renowned Hindustan Kalari Sangam, which is one of the oldest in the world and gives world class training in ‘Kalaripayattu’ that is the Kerala martial arts. Return to the hotel for night stay.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1310, 59, 18, 'NILESHWAR', 'As this is the last destination to explore, enjoy every bit of it. After your delicious breakfast, we will be taking you to the massive Neeleswaram Palace. The architecture style of this palace is remarkable. After that, we will be exploring Shree Muthappan Temple which consists of beautiful hall and shrines. In the end, you will relax at the Azhithala Beach which is the prime and beautiful spot of Nileshwar. Return back to the hotel and stay for overnight.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1311, 59, 19, 'NILESHWAR – COCHIN DEPARTURE', 'It is the end and the goodbye moment from this tour of “Kerala with a Difference”. India Trip Planners representative will guide you to the Cochin airport to catch the return flight for your onward destination. We serve the best and maintain our values with the best in all amenities. Thank you for giving us a chance to serve you.', NULL, NULL, NULL, 0, '2026-01-06 09:50:52'),
(1312, 58, 1, 'ARRIVE BANGALORE', 'Trip Planners will meet you at Bangalore International Airport and transfer to your hotel as per your bookings. Get freshen up and then in the afternoon enjoy an orientation tour of Bangalore. The weather condition is almost always pleasant here that is why it attracts tourist from all over the world. You will visit Bannerghatta National Park, Ulsoor (Boating), Wonder-la which is a fun-filled place with so many activities, Tipu Sultan’s Summer Palace which is grand, Bangalore Palace is simply outrageous and lastly at the Venkatappa Art Gallery. In the late evening, dedicate your time for attending the grand Aarti in Iskcon Temple which will make you feel peace and glorious. Return back to hotel and night stay is in hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1313, 58, 2, 'BANGALORE – HASSAN', 'Next, you will be checking out from Bangalore and will be moving towards Hassan. Hassan is well-known for its temples and architecture. As per your arrival, you will be transferred to your pre-booked hotel. After getting refreshed from your travel hangover, we will continue our tour with sightseeing of Hassan. Enjoy at Yogakshema Ayurveda Centre and get relaxed. Return and stay comfortably at your hotel in Hassan.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1314, 58, 3, 'HASSAN', 'We will be exploring Hassan today after your breakfast. Today explore the intricately carved Temples such as Kedareswara Temple, Lakshmi Narasimha Temple, Hasanamba Temple and Koravangala Temple. After this sacred visit, you will be taken to Chandragiri Hills which is the soothing location. Then, visit Bhagwan Bahubali Statue, Shettihalli Church, Bisile Ghat and in the end visit Gorur Dam. After this glorious day, you will return to the hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1315, 58, 4, 'HASSAN – MYSORE', 'Today early morning we have to leave for another beautiful destination that is Mysore. As per your arrival, get check-in to hotel. Relax for a while and then start your sightseeing of Mysore. In evening you will visit the very popular Mysore Palace which is also famous by the name Amba Vilas. The lighting on it is spectacularly awesome and worth a visit. Overnight stay is at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1316, 58, 5, 'MYSORE', 'The day is dedicated completely to Mysore. You will start exploring the very famous and grand Chamundeshwari Temple, followed by St. Philomena’s Cathedral, Jaganmohan Palace, Melody World Wax Museum, and in the end the Mysore Zoo. Later, you will drive to Sri Rangapattanam to see the Tippu’s Summer Palace which is grand and the ruins of the Tippu’s Fort too. In the evening, you will take a stroll through the colorful fruit and vegetable market at Devaraja Market. Later, get back to the hotel for a comfortable night stay.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1317, 58, 6, 'MYSORE – KABINI', 'Next, we will be moving towards Kabini which is famous for its Jungle Safari. So, leave from Mysore and after arrival at Kabini, get checked into the pre-booked hotel. Get relaxed and then begin with sightseeing of Kabini. You will drive to Nagarhole National Park which is one of the finest Wildlife Parks in South India. Do the safari of one part of this park today and then in the evening time, spend time on the banks of the Kabini River. Overnight stay is at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1318, 58, 7, 'KABINI', 'The complete day is for jungle activities at Nagarhole National Park with a guide, in search of the elephant, tiger, sambar, mongoose, spotted deer, peacock and jungle fowl too. Also, visit Kabini Dam and then get into the activity of boating in the evening. The city shopping is also interesting, so spend some time there and then return to your hotel for dinner and overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1319, 58, 8, 'KABINI - WAYANAD', 'After breakfast, we will check out from Kabini and will head towards Wayanad which is Eden, if Kerala is the God’s own country. As per your arrival, check into the hotel. Later, we will begin with the sightseeing of Wayanad which is filled with all tropical rainforests, grassy meadows, expansive tea estates and aromatic spice gardens. We will visit the imperious Edakkal caves and the Jain shrines at Wayanad. After that, enjoy your night with delicious dinner and a relaxing night stay', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1320, 58, 9, 'WAYANAD', 'Today, you will be excursing the well known site of Wayanad known as Wayanad Wildlife Sanctuary. It is home to a variety of indigenous species of animals and birds. Enjoy your safari in this wildlife sanctuary by capturing the clicks of different species. Later in the afternoon, you will drive to Kuruva Island which is a lonely group of islets spot in the middle of the River Kabini. After that, come back to the hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1321, 58, 10, 'WAYANAD – COCHIN', 'Leave from Wayanad in the morning and reach Cochin. Cochin sightseeing will enrich you with the remarkable history; fascinate you with its amendable culture. So, quickly take a sunset cruise ride along the backwaters of Cochin for experiencing the illuminated views of the Marine Drive and its sides. Stay overnight in the hotel.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1322, 58, 11, 'COCHIN', 'Today, you will visit the main tourist attractions of Cochin such as Dutch Palace, Jewish Synagogue, Spice Market, Hill Palace, St.Francis Church, Santa Cruz Basilica and Puthuvype Beach. To spend some romantic time with your partner you can go to Fort Kochi Beach. Later on, watch an amazing Kathakali performance which in known to be famous from its ancient times in Kerala. Return to your hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1323, 58, 12, 'COCHIN – KUMARAKOM', 'Move to the next destination after breakfast that is Kumarakom. As per your arrival, you will check into the hotel which is already reserved for you. Kumarakom is situated on the shores of the tranquil Vembanad Lake which is around 14 km from Kottayam. It is the best place in whole Kerala for clicking pictures of the scenic beauty. It caters many small clusters of islands which make it more beautiful. Kumarakom has become very famous now and it attracts many tourists from all over the world; also it has grown up as a bird sanctuary. There are many things to do additionally such as boating and fishing. On request, Canoe trips can be organized and are best enjoyed early in the morning or during the evenings. After this fun-filled day, you will return to your hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1324, 58, 13, 'KUMARAKOM - ALLEPPEY', 'This is going to be the ultimate day when you will leave for Alleppey to board onto the Houseboat. Earlier, Houseboats were known as Kettuvallams or Rice Boats which were used as ferries to carry rice, now it has come out in the modern form. You will take your lunch on the houseboat and after that; you will be taken on a cruise through the narrow canals of the Vembanad Lake. The floating markets in canoes and exotic landscapes of rolling paddy fields around all add an ethnic touch to the cruise. The stay is on houseboat itself. So, enjoy the sunset and later do peacefully the gazing of stars which can be rarely done when in crowded cities. Also, enjoy your dinner with the sounds of water gushing through and fro over the moors.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1325, 58, 14, 'ALLEPPEY – KOVALAM', 'Today, you will check out from your houseboat after breakfast and proceed to Kovalam. Kovalam beach is a dreamland and famously known as the “Paradise of the South”. It is a destination full of greenery, serenity, and pleasant climate. Reach at the destination and check into the hotel. Rest for some time and then proceed for sightseeing. It is the place where one would be able to see the golden sand at the day time and silver sand in the night time; it is so phenomenal. This beach paradise with high rock promontory and a calm bay of blue waters in total creates a unique aquarelle on moonlight nights. Return to the hotel for overnight stay', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1326, 58, 15, 'KOVALAM', 'Your next destination of this tour plan is Kanyakumari. So, leave for it early in the morning and then after exploration return back to Kovalam for your stay. Kanyakumari was famous as Cape Comorin earlier and is located at the southernmost point of India. It attracts a lot of tourists because it is the geographical end of the mainland. Nagercoil and Thiruvananthapuram are the closest major cities. Kanyakumari is formed on the name of the Hindu Goddess Kanyakumari which is situated at the confluence of the three beautiful water-bodies stated as the Arabian Sea, the Bay of Bengal and the Indian Ocean. After exploring Kanyakumari and watching the mind-blowing sunset, return back to Kovalam and stay for the night.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1327, 58, 16, 'KOVALAM – TRIVANDRUM DEPARTURE', 'Proceed for the sightseeing of Trivandrum, after your delightful breakfast. We will begin with the Sri Padmanabhaswamy Temple which is the most religious temple of the city. Then we will explore some other places like Kuthiramalika Palace Museum and then followed with Poovar Beach, experience the endless beauty of the beach. Later according to your schedule, you will proceed to Trivandrum airport/railway station to connect your flight/train to the onward destination.', NULL, NULL, NULL, 0, '2026-01-06 09:51:32'),
(1328, 57, 1, 'ARRIVE COCHIN', 'Taj Mahal Day Tour - OTI team members will be overwhelmed in receiving you at Cochin airport and you will be transferred to hotel for your check in. Relax for a while as and when you reach to your hotel. Now, you will begin with your Cochin sightseeing with the main tourist attractions such as Dutch Palace, Jewish Synagogue, Hill Palace, St.Francis Church and Puthuvype Beach. To spend some romantic time with your partner you can go to Fort Kochi Beach. Later on, visit Marine Drive for taking a glimpse of the sunset. Stay overnight in the hotel', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1329, 57, 2, 'COCHIN – MUNNAR', 'Proceed to your next destination which is Munnar after a delightful breakfast at the hotel. Upon arrival, get to check into the hotel. Begin the sightseeing of Munnar and in evening you can walk through the Munnar Tea Museum and also visit the Cardamom Curing Centre. Spend your night in hotel.', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1330, 57, 3, 'MUNNAR', 'Today after your breakfast, you are going to spend a full day sightseeing of this extraordinary place, Munnar. Start quickly without wasting time by exploring Eravikulam National Park which is approximately 30 minutes away from Munnar and Nilgiri Thaars is the main attraction of this park being protected at its best. Return and explore Attukal Waterfalls, Mattupetty Dam, Echo Point, Kundala Lake and Mount Carmel. After that, have your dinner at the hotel and stay for overnight.', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1331, 57, 4, 'MUNNAR TO PERIYAR', 'Drive to Periyar which is also called as Thekkady on the 4th day of your trip. It is one of the most popular wildlife sanctuaries in South India. Check into the hotel as per your arrival. Relax for some time and then in the afternoon, go for sightseeing of this magical place of South India. Later, return to the hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1332, 57, 5, 'PERIYAR', 'The day is dedicated for Periyar; so after breakfast start your sightseeing with Periyar Wildlife Sanctuary. Here to get a view of large variety of wildlife species like Wild Elephants, Sambar Deer, Nilgiri Langur, Wild Bison, Wild Boar and also some unique birds; then take a Wildlife cruise. After finishing up with the wildlife sanctuary, explore the Hill Station and Spice Plantation where you can do certain activities like Bamboo Rafting, Trekking and Elephant ride. Later, get back to the hotel for a comfortable night stay.', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1333, 57, 6, 'PERIYAR – KUMARAKOM', 'Move to the next destination after breakfast that is Kumarakom. It is situated on the shores of the tranquil Vembanad Lake which is around 14 km from Kottayam. It is the best place in whole Kerala for clicking pictures of the scenic beauty. It caters many small clusters of islands which makes it more beautiful. Kumarakom has become very famous now and it attracts many tourists from all over the world; also it has grown up as a bird sanctuary. It is the best place to be laze upon over holidays, offering beautiful surroundings. There are many things to do additionally such as boating and fishing. After this fun-filled day, you will return to your hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1334, 57, 7, 'KUMARAKOM – ALLEPPEY', 'The most waited day of this trip when you will leave for Alleppey to board onto the Houseboat. Earlier, Houseboats were known as kettuvallams or rice boats which were used as ferries to carry rice, now it has come out in the modern form. You will take your lunch on the houseboat and after that you will be taken on a cruise through the narrow canals of the Vembanad Lake. The stay is on houseboat itself. So, enjoy the sunset and later do peacefully the gazing of stars which can be rarely done when in crowded cities. Also, enjoy your dinner with the sounds of water gushing through and fro over the moors.', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1335, 57, 8, 'KUMARAKOM – ALLEPPEY', 'On 8th day, you will check out from your houseboat after breakfast and proceed to Kovalam. Kovalam beach is a dreamland and famously known as the “Paradise of the South”. It is a destination full of greenery, serenity, and pleasant climate. Reach at the destination and check into the hotel. Rest for some time and then proceed for sightseeing. It is the place where one would be able to see the golden sand at the day time and silver sand in the night time; it is so phenomenal. This beach paradise with high rock promontory and a calm bay of blue waters in total creates a unique aquarelle on moonlight nights. Return to the hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1336, 57, 9, 'KOVALAM – TRIVANDRUM – POOVAR – KOVALAM', 'Proceed for the sightseeing of Trivandrum, after your delightful breakfast. We will begin with the Sri Padmanabhaswamy temple which is the most religious temple of the city. Then we will explore some other places like Kuthiramalika Palace Museum and then followed with Veli Tourist Village which has an excellent waterfront park with an entire range of aqua entertainment facilities like wading pools, fishponds and landscaped garden. Later in the afternoon, head towards Poovar Beach and indulge in the endless beauty of the beach. Later, return to Kovalam and spend a comfortable night.', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1337, 57, 10, 'KOVALAM – KANYAKUMARI – KOVALAM', 'Your next destination of this tour plan is Kanyakumari. So, leave for it early in the morning and then after exploration return back to Kovalam for your stay. Kanyakumari was famous as Cape Comorin earlier and is located at the southernmost point of India. It attracts a lot of tourists because it is the geographical end of the mainland. Nagercoil and Thiruvananthapuram are the closest major cities. Kanyakumari is formed on the name of the Hindu Goddess Kanyakumari which is situated at the confluence of the three beautiful water-bodies stated as the Arabian Sea, the Bay of Bengal and the Indian Ocean. After exploring Kanyakumari and watching the mind-blowing sunset, return back to Kovalam and stay for the night.', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1338, 57, 11, 'KOVALAM – TRIVANDRUM DROP', 'This is going to be the end of the Kerala exploration. After your breakfast, you will proceed to Trivandrum airport/railway station to connect your flight/train to the onward destination. Thank you for giving us a chance to serve you with this. Return home with sweet memories of your wonderful trip with your loved ones.', NULL, NULL, NULL, 0, '2026-01-06 10:00:55'),
(1383, 50, 1, 'Arrival at Delhi', 'Arrival at the international airport in Delhi late in the night or midnight. Transfer to your hotel.Overnight will be at Delhi', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1384, 50, 2, 'Delhi', 'After Breakfast, Start a full-day tour of Old and New Delhi.\r\nOLD DELHI - A sight-seeing tour of Old Delhi would entail visiting the Raj Ghat - the memorial site where Mahatma Gandhi was cremated; Jama Masjid - the largest mosque in India and the Red Fort - once the most opulent fort and palace of the Moghul Empire. Enjoy the cycle rickshaw ride from Jama Masjid to Chandni Chowk.\r\n\r\nNEW DELHI - An extensive sight-seeing tour of New Delhi would include a visit to the Humayun\'s Tomb, the Qutub Minar, a drive along the ceremonial avenue - Rajpath, past the imposing India Gate, Parliament House, the President\'s Residence, Lotus Temple and would end with a drive through the Diplomatic Enclave. Overnight will be at Delhi.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1385, 50, 3, 'Delhi - Agra', 'Start for Agra early in the morning after breakfast. Check in at Agra hotel.\r\nAGRA: Two great Mughal monarchs, Akbar and Shah Jahan, transformed the little village of Agra into a befitting second capital of the Mughal Empire - giving it the name Dar-ul-Khilafat {seat of the Emperor}.\r\n\r\nTAJ MAHAL: Little needs to be said about this architectural wonder which is always the soul raison-de-etre for every tourist\'s visit to Agra. Built by Shah Jahan, the Taj is a white marble memorial to his beautiful wife Mumtaz Mahal. This monument took 22 years to be completed and was designed, and planned by Persian architect Ustad Isa. Proceed for visit to the Taj Mahal, Agra Fort and Itmadullah\'s Tomb (Baby Taj) with English speaking guide. Enjoy battery van ride. Return to hotel and relax in the evening. Overnight will be at Agra.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1386, 50, 4, 'Jaipur', 'Enjoy your breakfast at the hotel. Proceed for a morning excursion to Amber Fort. Elephant ride ascent to the fort', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1387, 50, 5, 'Jaipur - Delhi', 'After breakfast proceed for shopping. Leave for Delhi after lunch. Reach Delhi and you will be transferred to airport for flight with sweet memories of India.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1388, 50, 6, 'Delhi - Chennai', 'Transfer to hotel.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1389, 50, 7, 'Chennai - Trivandrum', 'Transfer to Resort', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1390, 50, 8, 'Ayurvedic Beach Resort', 'Relax and enjoy the facilities at the resort including private beach, yoga, massage, nature walks, classical music and dance programs on open-air stage, visits to local traditional village.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1391, 50, 9, 'Backwaters of Kerala', 'From the resort drive to the pier to board a private rice boat (70 kms/2 hrs drive) and then cruise through the narrow canals and wide lakes enjoying the scenic natural beauty -- coconut trees, rice patties, small villages. Meals and overnight on houseboats.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1392, 50, 10, 'Backwaters - Cochin Morning', 'relax on houseboat, after lunch drive to Cochin 65 Kms/ 1 1/12 hrs.), transfer to hotel. overlooking the harbor, sea facing rooms.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1393, 50, 11, 'Cochin Full day sighseeing', 'palaces, museums. Enjoy a Kathakali dance performance at Cochin Cultural Center, arriving by 5 pm to watch the make-up. Dinner at traditional Kerala restaurant. overnight at hotel.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1394, 50, 12, 'Periyar', 'Periyar Wild life Sanctuary Home to bison, antelopes, sambars, wild boars, monkeys, langurs, a wide variety of birds, and some 750 elephants. Game viewing by private motor-boat in the evening, (the best time to see wild life). overnight at hotel', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1395, 50, 13, 'Periyar - Madurai', 'Relax at Periyar in the morning. In afternoon, drive to Madurai (135 kms./ 4hrs. drive), \"The Temple City of India.\" Evening relaxed overview of the city, independent strolling. Hotel in Madurai, cottages', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1396, 50, 14, 'Madurai', 'Full day sighseeing: Sri Meenakshi Temple, Tirumalai Nayak Palace, Tiruparankundram (rock-cut)Temple, Alagarkoil Temple Evening fly Madurai-Madras dep 19:40 arr 20:30 arr. OR 20:40 dep.-21:30 arr. Hotel', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1397, 50, 15, 'Madras', 'Full day sightseeing of Madras: Kapaleeshwarar Temple, San Thome Cathedral, Sri Parthasarathy Temple, Fort St. George, the Marina. overnight at hotel.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1398, 50, 16, 'Drive to Kanchipuram', 'Visit temples of Kanchipuram enroute to Mahabalipuram. Kailasanatha Temple, Vaikunta Perumal Temple, Sri Ekambaranathar Temple, Kamakshi Amman Temple, Devarajaswami Temple. On arrival in Mahabalipuram transfer to Hotel.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1399, 50, 17, 'Mahabalipuram', 'Morning relax; afternoon sightseeing: Five Rathas, Shore Temple, ArjunaÕs Penance, Mandapams, Krishna Mandapam.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1400, 50, 18, 'Madras', 'Relax in the morning. Late afternoon drive back to Madras (80kms./2hrs. drive). Transfer to international airport for flight home.', NULL, NULL, NULL, 0, '2026-01-06 10:16:54'),
(1401, 49, 1, 'Delhi To Shimla', 'Arrival at Delhi railway station / Airport, our special vehicle pick up you & drive you to Shimla (345 Kms / 9 Hrs). When ever reach at Shimla check into your hotel & get fresh. Evening free for leisure & take your dinner at hotel. Overnight stay at hotel in Shimla.', NULL, NULL, NULL, 0, '2026-01-06 10:18:09'),
(1402, 49, 2, 'Shimla / Kufri Sightseeing', 'After breakfast proceed for wonderful day excursion to Kufri. In Kufri enjoy a walk through thick ceder woods to Mahasu Pick for amazing view of mighty Himalayas. Enjoy Hirse riding at your own cost. You can do wonderful photography also. Evening come back to the Resort & do some shopping at very famous Mall road of Shimla. Enjoy your dinner at Hotel. Overnight stay at hotel in Shimla.', NULL, NULL, NULL, 0, '2026-01-06 10:18:09'),
(1403, 49, 3, 'Shimla To Manali', 'After taking breakfast transfer to Manali (250 Kms/ 8 Hrs). When ever reach at Manali check into your Hotel & get fresh. Take your dinner at Hotel. Overnight stay at hotel in Manali.', NULL, NULL, NULL, 0, '2026-01-06 10:18:09'),
(1404, 49, 4, 'Manali / Rohtang Pass Snow Point Sightseeing', 'After breakfast proceed for full day local sightseeing of Manali like Hadimba Temple, Tibetan Monastery, Lord Buddha and Tankha paintings, Vashistha Temple for \"Hot & Cold water Kund\", Club House. Afternoon excursion to the Rohtang Pass also called Snow Point of Himachal – enjoy the beauty of year round snow caped mountains. Evening free for leisure & enjoy your dinner at Hotel. Overnight stay at hotel in Manali.', NULL, NULL, NULL, 0, '2026-01-06 10:18:09'),
(1405, 49, 5, 'Manali To Delhi', 'After breakfast, checkout from hotel and proceed for Delhi by Road (12hrs.). Reach at Delhi at Night. Overnight at Delhi', NULL, NULL, NULL, 0, '2026-01-06 10:18:09'),
(1406, 49, 6, 'Delhi - Agra - Delhi', 'Today after breakfast we proceed for Agra by Yamuna Express Highway thru this highway we reach agra by 2.30hrs. Today we cover Taj Mahal and Agra Fort.\r\nTAJ MAHAL - Built by Shah Jahan, the Taj is a white marble memorial to his beautiful wife Mumtaz Mahal. This monument took 22 years to be completed and was designed, and planned by Persian architect Ustad Isa.\r\n\r\nAGRA FORT - Fort built in red sandstone with its magnificent palaces, halls of public and private audience and the beautiful gardens. This is where Emperor Shah Jahan was kept under house arrest by his third son Aurangzeb and spent the last year of his life viewing the Taj Mahal from across the river Jamuna. Evening after finish all sight seeing we proceed for Delhi by Road.', NULL, NULL, NULL, 0, '2026-01-06 10:18:09'),
(1407, 49, 7, 'Delhi Sightseeing', 'Today After breakfast we checkout from hotel and proceed for Delhi local Sight seeing as per time permit we proceed for Red Fort / Qutab Minar / India Gate / Parliament House / Akshardham temple / Birla Temple. / Lotus Temple. Drop at Railway Station / Airport.', NULL, NULL, NULL, 0, '2026-01-06 10:18:09'),
(1419, 47, 1, 'Arrival Delhi', 'Arrive Delhi, meet assist at the airport & transfer to hotel. Night stay in Delhi.', NULL, NULL, NULL, 0, '2026-01-06 10:24:22'),
(1420, 47, 2, 'Delhi Sightseeing', 'After breakfast proceed for sightseeing tour of Old & New Delhi:\r\nOLD DELHI - A sight-seeing tour of Old Delhi would entail visiting the Raj Ghat - the memorial site where Mahatma Gandhi was cremated; Jama Masjid - the largest mosque in India.\r\n\r\nNEW DELHI - An extensive sight-seeing tour of New Delhi would include a visit to the Humayun\'s Tomb, the Qutub Minar, a drive along the ceremonial avenue - Rajpath, past the imposing India Gate, Parliament House, the President\'s Residence and would end with a drive through the Diplomatic Enclave. Night stay in Delhi.', NULL, NULL, NULL, 0, '2026-01-06 10:24:22'),
(1421, 47, 3, 'Delhi - Jaipur (By train Dep 0610 Hrs Arr 1040 Hrs ) Palace of Winds', 'Early morning pick up from hotel & transfer to railway station to board the superfast airconditioned train to Jaipur. Breakfast in the train. Arrive Jaipur and transfer to hotel. Later sight seeing tour of Jaipur covering:\r\nAMBER FORT PALACE - Amber is the classic romantic Rajasthani fort palace. Its construction was started by Man Singh I in 1592, and completed by his descendent Jai Singh I. Its forbidding exterior belies an inner paradise where a beautiful fusion of Mughal and Hindu styles finds it\'s ultimate expression.\r\n\r\nCITY PALACE - A delightful blend of Mughal and traditional Rajasthani architecture, the City Palace sprawls over one-seventh of the area in the walled city. It houses the Chandra Mahal, Shri Govind Dev Temple and the City Palace Museum.\r\n\r\nJANTAR MANTAR - This is the largest and the best preserved of the five observatories built by Jai Singh II in different parts of the country. This observatory consisting of outsized astronomical instruments is still in use.\r\n\r\nHAWA MAHAL - The ornamental facade of this \"Palace of Winds\" is a prominent landmark in Jaipur. Their five-storey structures of sandstone plastered pink encrusted with fine trelliswork and elaborate balconies. The palace has 953 niches and windows. Built in 1799 by Pratap Singh, the Mahal was a royal grandstand for the palace women. Night stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-06 10:24:22'),
(1422, 47, 4, 'Jaipur - Agra', 'Morning drive to Agra via Fatehpur sikri , a perfectly preserved red sandstone “ghost town” which was the estranged capital of mughal emperor Akbar, built in 1569 and deserted when its water supply failed. Arrive Agra and transfer to hotel. Night stay in Agra.', NULL, NULL, NULL, 0, '2026-01-06 10:24:22'),
(1423, 47, 5, 'Agra Sightseeing', 'Morning at sunrise visit the magnificient Taj Mahal - one of the seven wonders of the world surely the most extravagant expression of love ever created. 20,000 men laboured for over 17 years to build this memorial to Shah Jahan\'s beloved wife.Also visit the Red fort - the rusty and majestic red- sandstone fort of Agra stands on the banks of the river Yamuna and the construction was started by Emperor Akbar in 1566. At the Diwan-I-Am (hall of public audience),a colonnaded hall of red-sandstone with a throne alcove of inlaid marble at the back, the Emperor heard public petitions. At the Diwan-I-Khas (hall of private audience) where marble pavilions with floral inlays lend an ethereal ambience, the Emperor sat on his gem-studded peacock Throne and met foreign ambassadors and rulers of friendly kingdoms. Evening free to explore the rich handicrafts of Agra. Night stay in Agra.', NULL, NULL, NULL, 0, '2026-01-06 10:24:22'),
(1424, 47, 6, 'Agra - Jhansi - Orchha', 'Morning transfer to railway station to board the train to Jhansi, Arrive Jhansi & drive to Orchha & transfer to hotel. Later tour of this historical site with magnificient temples and monuments. Some of the palaces were decorated with painted murals which represent the finest flowering of the Bundela school of painting. Night stay in Orchha.', NULL, NULL, NULL, 0, '2026-01-06 10:24:22'),
(1425, 47, 7, 'Orchha - Khajuraho', 'After breakfast drive to Khajuraho , The legendary temples of khajuraho are an incomparable experience. Acknowledged as one of the world’s artistic wonders, these temples dedicated to the Hindu pantheon of Gods are covered in carvings that are a paean to life and love. Built within a short span of a hundred years by the Chandela Rajputs, the 10th century temples lay forgotten until they were discovered in the present century. Khajuraho has achieved fame for the sensual appeal of its erotic sculptures. Arrive Khajuraho & transfer to hotel. Later explore the Western and Eastern temples of khajuraho while your guide explains the intricate meaning and legends behind each describable sculpture. Night stay in Khajuraho.', NULL, NULL, NULL, 0, '2026-01-06 10:24:22'),
(1426, 47, 8, 'Khajuraho- Delhi ( By flight )-Departure', 'After a relaxed breakfast transfer to airport to board the flight to Delhi to connect the onward flight.', NULL, NULL, NULL, 0, '2026-01-06 10:24:22'),
(1427, 45, 1, 'Arrive New Delhi Airport', 'On arrival at New Delhi airport and our driver meet you with your name plate and transfer to Hotel and night stay in Delhi.', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1428, 45, 2, 'Delhi City Day Tour', 'This morning after breakfast first you will visit old Delhi. The Raj Ghat, Red fort & Jama Masjid are important places to visit, you may also visit Chandni Chowk, spice market etc. Later on proceed to visit the New Delhi. The Qutab Miner, tallest stone tower in India, imposing India Gate and the Rastrapathi Bhawan, Laxmi Narayan Temple, Lotus Temple and night stay in Delh', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1429, 45, 3, 'Delhi-Agra Drive', 'This morning after breakfast you will drive to love city Agra, check-in in the hotel and refresh and after start Agra tour. You visit Agra fort, Meatab Garden and some local market, Night stay in Agra', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1430, 45, 4, 'Agra – Jaipur Drive', 'This morning after breakfast you will drive to pink city Jaipur ( the capital of Rajasthan) en-route visit Step wall and fathepur sikri and reach in evening in Jaipur and night stay', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1431, 45, 5, 'Jaipur City Day Tour', 'After Breakfast visit amber fort and enjoy the elephant ride and after visit water palace , City Palace , Wind Palace , Monkey Temples and in evening the time for shopping and night stay in Jaipur', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1432, 45, 6, 'Jaipur – Delhi Drive', 'After Breakfast drive back to New Delhi and night stay in Delhi.', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1433, 45, 7, 'Delhi -Cochin by flight', 'Today you will be transferred to airport to take a flight to Cochin. On arrival at Cochin Pickup & Transfer to hotel Rest of the day is at your leisure. Overnight at hotel', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1434, 45, 8, 'Cochin City Tour', 'On arrival at Cochin pick up and transfer to Hotel This evening enjoy Motor Boat Ride at Cochin Harbor and walk around the beach. Overnight at the hotel', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1435, 45, 9, 'Cochin –Munnar Drive', 'After breakfast Cochin sightseeing – Drive to Munnar and night stay in Munner', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1436, 45, 10, 'Munnar City Tour', 'Full day sight-seeing at Munnar – Rajamalai, Mattupetty, Eco point, Devikulam, Tea plantations /overnight at hotel', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1437, 45, 11, 'Munnar- Kumarakom Drive', 'Breakfast at the hotel & later drive to Kumarakom located on the Southern coast of India enjoys a well-balanced tropical climate, upon arrival check-in at Hotel Abad Whispering palms. The village of Kumarakom is a cluster of little islands on the Vembanad Lake sanctuary. Rest of the day is free. Overnight at hotel', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1438, 45, 12, 'Kumarakom City Tour', 'After breakfast at the Hotel visit Kumarakom Bird Sanctuary, the best time for this is between November and March, when a range of migratory birds from Siberia make it their winter home. Some of the species include the Snake bird Little Cormorant, Crow Pleasant, White-branded water Hen and Tree pie. Occasionally you can catch the native kingfishers setting the waters ablaze in a psychedelic flash of colors. The night herons, the Golden-backed woodpeckers are added delights. At the fourteen-acre bird sanctuary one can glimpse many a rare bird – some of which, sadly, may not be around forever. Evening enjoy the sun set cruise thereafter return to hotel for overnight', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1439, 45, 13, 'Kumarakom to Alleppy-Houseboat', 'Today morning after breakfast Proceed to Alleppey, Known as the Venice of the East. On arrival check into a traditional House Boat of Kerala Style. Cruise through the back waters is the fabulous way to explore the fascinating beauty of the backwaters. Stay overnight in the House Boat.', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1440, 45, 14, 'Alleppy –Cochin Drive', 'This morning pick up from the house boat and transfer to Cochin. Rest of the day is free at your leisure. Overnight at hotel .', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1441, 45, 15, 'Transfer to Cochin Airport', 'Today you will be transferred to Cochin airport for your onward journey.', NULL, NULL, NULL, 0, '2026-01-06 10:27:27'),
(1442, 44, 1, 'Arrival in Delhi – Sightseeing', 'Pickup from airport and Transfer to hotel and check-inn in after you start Delhi tour and cover sight Old Delhi –Red Fort-Jama Masjid-RajGhat-Humayan tomb-India Gate-President House of India-Qutab Miner & night stay in Delhi', NULL, NULL, NULL, 0, '2026-01-06 10:30:11'),
(1443, 44, 2, 'Delhi –Jaipur Drive', 'check-out from hotel and drive to pink city Jaipur reach around in afternoon and check-in in the hotel –night stay in Jaipur', NULL, NULL, NULL, 0, '2026-01-06 10:30:11'),
(1444, 44, 3, 'Jaipur Guided Day Tour', 'this morning after breakfast you visit Amber fort-Water palace-city palace-wind palace-monkey temple and some walking in bazaar-night stay in Jaipur', NULL, NULL, NULL, 0, '2026-01-06 10:30:11'),
(1445, 44, 4, 'Jaipur-Step wall-Fathepur sikri –Agra Drive', 'Check-out from hotel and drive to Agra and en-route you can visit world heritage site fathepur sikri and after continue drive to Agra visit Taj Mahal and Agra fort –night stay in Agra', NULL, NULL, NULL, 0, '2026-01-06 10:30:11'),
(1446, 44, 5, 'Agra-Khajuraho Drive', 'This morning after breakfast you drive to Khajuraho (the city of the Kama-sutra temples) arrived in evening –night stay in Khajuraho.', NULL, NULL, NULL, 0, '2026-01-06 10:30:11'),
(1447, 44, 6, 'Khajuraho Day Tour-Evening Flight to New Delhi', 'Pickup from hotel and transfer to Khajuraho Airport and catch flight to New Delhi –Pickup from New Delhi Airport and transfer to hotel or Airport.', NULL, NULL, NULL, 0, '2026-01-06 10:30:11'),
(1448, 43, 1, 'Arrival in the Capital City – Delhi', 'Kick off your journey in vibrant Delhi, where the old meets the new. Upon your arrival at Delhi International Airport, you’ll be greeted by our representative and whisked away to your cozy hotel. Take the evening to unwind or stroll around your neighborhood to soak in the lively atmosphere that surrounds you.', NULL, NULL, NULL, 0, '2026-01-06 10:30:47'),
(1449, 43, 2, 'Delhi – Srinagar (by flight)', 'Post breakfast in the hotel proceed for Delhi Airport to board the flight for Srinagar. Check into a houseboat upon arrival. Shikhara (boat) on Dal Lake, Srinagar, Jammu & Kashmir, IndiaHave lunch in the houseboat and later step out for half-day city tour/sightseeing of Srinagar. Situated in the Kashmir Valley, this beautiful city is known for its gardens, lakes and houseboats (also called shikaras).\r\n\r\nEnjoy the sightseeing and visit Mughal Garden, Nishat Bagh (the Garden of Spring) as well as Shalimar Bagh. Enjoy Shikara ride over Dal Lake in evening.\r\n\r\n Get back to houseboat, have dinner and overnight stay there.', NULL, NULL, NULL, 0, '2026-01-06 10:30:47'),
(1450, 43, 3, 'Srinagar – Gulmarg (55 kms, 2 hrs drive one way)', 'Post breakfast in the houseboat depart for full day excursion of Gulmarg. Gulmarg is the most amazing winter resort in the Gulmarg snow during winter,Srinagar, Jammu & Kashmir, Indiavalley. It is famous for its highest golf course and winter skiing. In afternoon tourists may enjoy skiing at their own expense for which an instructor can be hired to guide them about skiing equipment’s (skies, sticks, gloves and goggles).', NULL, NULL, NULL, 0, '2026-01-06 10:30:47'),
(1451, 43, 4, 'Srinagar – Pahalgam (90 kms, 3.5 hrs one way)', 'Today, set off for Pahalgam, a picturesque town perched on the banks of the Lidder River. The beauty of this peaceful valley will leave you in awe as you meander through lush green meadows and stunning views. After a day immersed in nature, return to your hotel in Srinagar for a cozy overnight stay', NULL, NULL, NULL, 0, '2026-01-06 10:30:47'),
(1452, 43, 5, 'Srinagar – Delhi (by flight) – Drive to Jaipur', 'After breakfast, catch your flight back to Delhi, where a local restaurant will serve you a delicious lunch. Next, journey to the royal city of Jaipur, known for its rich heritage and iconic architecture. Upon arrival, check into your hotel and take the evening to relax, shop, or savor the Rajasthani vibe.', NULL, NULL, NULL, 0, '2026-01-06 10:30:47'),
(1453, 43, 6, 'Jaipur Tour', 'Prepare for a day of exploration! Begin with breakfast before heading to the majestic Amber Fort, where you’ll marvel at the stunning architecture. Capture the perfect photo at Hawa Mahal, then visit the City Palace and Jantar Mantar, a UNESCO World Heritage site. Later, dive into the bustling bazaars of Jaipur, where you can shop for handicrafts, jewelry, and souvenirs before returning to your hotel for a restful night.', NULL, NULL, NULL, 0, '2026-01-06 10:30:47'),
(1454, 43, 7, 'Jaipur – Agra', 'Post-breakfast, embark on your journey to Agra. Stop at Fatehpur Sikri, the exquisite former capital of the Mughal Empire—its architectural wonders offer a glimpse into India’s glorious past. Continue to Agra to visit the magnificent Taj Mahal, where you can marvel at its ivory-white marble beauty. End your day with a visit to Agra Fort before settling in for a relaxing overnight at your hotel', NULL, NULL, NULL, 0, '2026-01-06 10:30:47'),
(1455, 43, 8, 'Agra – Delhi (  Departure )', 'On your final day, after an early breakfast, travel back to Delhi. Once you arrive, enjoy a delicious lunch and immerse yourself in the rich history at landmarks such as India Gate and the Lotus Temple. Please take advantage of the late afternoon to shop for last-minute treasures before we arrange your transfer to Delhi International Airport for your onward journey', NULL, NULL, NULL, 0, '2026-01-06 10:30:47'),
(1465, 41, 1, 'Delhi Arrival', 'Upon arrival at the airport, our representative will greet you and help you with the hotel transfer. The evening is leisure or you can visit Sri Bangla Sahib Gurudwara, one of the famous Sikh Gurudwara. Overnight stay at the hotel in Delhi.', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1466, 41, 2, 'Delhi Sightseeing', 'After breakfast start your Delhi Sightseeing tour visiting  Jama Masjid-the largest mosque in India, built in the 17th century. Next drive past Red Fort and enjoy the Rickshaw Ride to\r\n\r\nChandni Chown. Raj Ghat, India Gate, Rashtrapati Bhawan (Presidential Palace), the Parliament House and other colonial buildings. \r\n\r\nLater, you\'ll drive past the New Delhi area to visit the Qutub Minar, Humayun\'s Tomb and the Lotus Temple. Overnight stay at the hotel in Delhi.', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1467, 41, 3, 'Delhi - Jaipur', 'After breakfast, drive toward Jaipur, Pink City, this drive will take approximately 5 hours. Upon arrival check into the hotel and the rest of the day is leisure. Night stay at the hotel or you can explore the nearby area or local market.', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1468, 41, 4, 'Jaipur Sightseeing', 'After breakfast, visit Hawa Mahal (Palace of Winds) to see its beautiful facade and snap a few photos before continuing to the famous Amber Fort, 7 miles (11 km) outside of Jaipur. You\'ll spend a few hours touring this hilltop fort, then go back to Jaipur stopping at Jal Mahal for some good photos. Next is City Palace, which is a perfect example of blended Rajasthani and Mughal architecture. Next, you\'ll visit nearby Jantar Mantar, also called the Solar Observatory. In the evening visit local markets of Jaipur for some shopping time. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1469, 41, 5, 'Jaipur - Agra', 'Today post breakfast, check out and drive to Agra, the Taj City.  Enroute visit Fatehpur Sikri-a red sandstone city and Abhaneri Step Wells.  Upon arrival check into the hotel and rest for an hour. Later you\'ll head to Agra Fort also known as Red Fort of Agra, built in the 16th century, Itmad-Ud- Daulah and Mehtab Bagh for a sunset view of the Taj. Overnight stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1470, 41, 6, 'Agra - Orchha - Khajuraho', 'Early in the morning, get ready and leave for the famous Taj Mahal. Visit this big white marble mausoleum that was built by Shah Jahan for his beloved wife Mumtaz Mahal. This is one of the most famous monuments in the world.\r\n\r\nThen return to the hotel for breakfast and check out. Drive to Agra Railway Station to take a train to Jhansi, upon arrival our driver will pick you up and drive you to Khajuraho en route to visit Orchha. Here you visit Jahangir Mahal, Raj Mahal and Laxmi Narayan Temple. After that, get back on the road to Khajuraho. Upon arrival check into the hotel and rest. The rest of the day is leisure on your own. Night stay at the hotel in Khajuraho.  \r\n\r\nNote: The Taj Mahal is closed on Friday', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1471, 41, 7, 'Khajuraho Sightseeing', 'Enjoy a morning breakfast at the hotel and leave for the Khajuraho Sightseeing. Visit the Eastern & western groups of temples and erotic sculptures that show a vision of eternal, spiritual and physical love. \r\n\r\nAfter lunch, drive approximately 2 hours to visit the Panna National Park, where you can enjoy a Jeep Safari and experience wildlife (Optional Activity). Overnight stay at the hotel in Khajuraho.', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1472, 41, 8, 'Khajuraho - Varanasi', 'Post breakfast, transfer to the Khajuraho Airport to board a flight for Varanasi. Upon arrival, our representative will welcome you and transfer you to the hotel. Check-in at the hotel and the rest. After lunch, drive to Sarnath, located 10 km northeast of Varanasi. Where you visit the Buddhist temple and the Bodhi Tree. Return to your hotel for a night\'s stay.', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1473, 41, 9, 'Varanasi Sightseeing', 'After breakfast, take a boat ride on the Ganges River and make a ferry pilgrimage from one ghat to another. Manikarnika and Harishchandra are the two cremation ghats, where the funeral pyre burns day and night. Every devout Hindu knows that cremation on the Ganges banks and death in Kashi represents an escape from the cycle of life and death. Spend the night in Varanasi.', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1474, 41, 10, 'Varanasi - Delhi', 'After breakfast check out from the hotel and drive to the Varanasi Airport to take a flight for Delhi. Upon arrival our representative will pick you up and transfer to the hotel. Rest of the day is free for your own activity. Night stay at the hotel.', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1475, 41, 11, 'Departure From Delhi', 'This is the last day of your tour with Elefantastic, after breakfast drive to Delhi Airport to take a flight for your onward journey.', NULL, NULL, NULL, 0, '2026-01-06 10:32:34'),
(1476, 40, 1, 'Arrive in Delhi', 'As per your flight schedule driver pickup you from Airport and transfer you to Delhi hotel. Afternoon visit Red fort, Jama Masjid, Qutab Minar, Lotus Temple, Humayun Tomb. Evening rest in Delhi hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:31:41'),
(1477, 40, 2, 'Arrive in Delhi', 'After breakfast visit India Gate, President hose. and depart from Delhi to Agra. around 3 hrs drive. afternoon check in Agra hotel. evening visit Agra fort, Mehtab bag garden. view the Taj Mahal from Garden. over night rest in Agra hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:31:41'),
(1478, 40, 3, 'Agra - Ranthambore', 'Early morning at the time of sunrise visit Taj Mahal (best time to visit Taj Mahal). Aafter the Taj tour back to the hotel for breakfast and and depart from Agra to Ranthambore Tour. Around 4 hrs drive on the way visit Fatehpur sikri (Capital city of Akbar). Evening check in Ranthambore hotel. over night rest in Hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:31:41'),
(1479, 40, 4, 'Ranthambore', 'Early morning visit the Ranthambore park by Jeep Safari. after noon visit Fort. Eevening visit the Rantambore National park again. and over night rest in hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:31:41'),
(1480, 40, 5, 'Ranthambore - Jaipur', 'After breakfast depart from Ranthambore to Jaipur. around 4 hrs drive. Afternoon check in Jaipur hotel. Evening visit Hawa mahal and Jaipur Bazaar. over night in Jaipur hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:31:41'),
(1481, 40, 6, 'Jaipur', 'After breakfast start your guiding tour of Capital city of Rajasthan (Jaipur). Visit - Amber fort with Elephant ride, City Palace, Jantar Mantar (Astronomical sight). Jal Mahal (water Palace), Monkey Temple. Evening free for shopping or over night rest in Jaipur hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:31:41'),
(1482, 40, 7, 'Jaipur to Delhi', 'After breakfast depart from Jaipur to Delhi around 4 hrs. drive as per your flight schedule driver transfer you to Delhi airport. Golden Triangle Tour With Ranthambore design Delhi Agra Jaipur Ranthambore City by City.', NULL, NULL, NULL, 0, '2026-01-08 05:31:41'),
(1483, 39, 1, 'Delhi Arrival', 'our representative will greet and transfer you to hotel. Later you can enjoy a sumptuous dinner and stay overnight at the hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:33:11'),
(1484, 39, 2, 'Delhi Sightseeing', 'Take early morning delicious breakfast at the hotel and today you are going to feel the magic and charisma of Delhi, which is a very lively city. You are going to enjoy a full day sightseeing tour of Delhi, starting with impressive Red Fort, Jama Masjid - India’s oldest and largest mosque. You will also visit Qutub Minar-2nd tallest Minar in India, India Gate, Parliament House, the President\'s House. Our representative will also guide you through the ticketing process as well as the history and significance associated with these sites. You can also take rickshaw ride in the bustling bazaars at Chandni Chowk and tour to Khari Baoli spice market to witness the business markets as well as to eat mouth-watering Indian dishes. Return to your hotel in the evening for comforting overnight stay.', NULL, NULL, NULL, 0, '2026-01-08 05:33:11');
INSERT INTO `package_itinerary` (`id`, `package_id`, `day_number`, `title`, `description`, `meals`, `accommodation`, `activities`, `display_order`, `created_at`) VALUES
(1485, 39, 3, 'Delhi – Agra (The Taj Mahal)', 'After breakfast lead to Agra, the home of Taj. Upon arrival check in at hotel. Later in the afternoon take a guided tour to the visit of Agra Fort, the majestic fort of red sandstone stands on the banks of river Yamuna, continue to Itmad-ud-Daula’s tomb (baby Taj). Evening free to explore the local streets. Overnight at Agra hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:33:11'),
(1486, 39, 4, 'Agra - Jaipur', 'Early morning, you can visit Taj Mahal during the sunrise. Come Back Hotel for breakfast at the hotel and leave Agra Hotel for Jaipur. En route, you will visit Fatehpur Sikri, the deserted capital of the Mughal emperor Akbar. On arrival at Jaipur, our representative will transfer you to the hotel and later In evening, you can also do shopping in this beautiful city, which is famous for gemstone jewellry, pots as well as great traditional outfits. Return to the hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-08 05:33:11'),
(1487, 39, 5, 'Jaipur Sightseeing', 'breakfast at the hotel and get ready because it\'s time to explore and enjoy sightseeing in the Pink city of India - Jaipur, which is the capital city of Rajasthan state. Jaipur is Famous for Forts, Palaces and Rich Indian cultural Heritage. The traditional fortress is at Amber, so this is the logical place from which to begin your exploration. We will arrange an elephant safari for you to see the countryside around Amber. Later in the afternoon you will visit City Palace Museum - an imposing blend of traditional Mughal and Rajasthani Art. The museum is resplendent with its collection of robes of royal princes, carpets, and armory of old weapons, miniature paintings portraying court scenes, battle scenes and processions, After this, you will visit Albert Hall museum situated in Ram Niwas Garden, which has a rich collection of artifacts like paintings, metal sculptures, colorful crystal works. Later you will drive past the Hawa Mahal - The Palace of Winds and visit Jal Mahal- palace located in the middle of the Man Sagar Lake. Later you will have Dinner traditional Rajasthani food and return to your hotel for a relaxing overnight stay.', NULL, NULL, NULL, 0, '2026-01-08 05:33:11'),
(1488, 39, 6, 'Jaipur-Udaipur', 'After breakfast at the hotel and you will leave for Udaipur. En route to Udaipur, you will visit Chittorgarh Fort which is acknowledged as the largest fort of India. On arrival in Udaipur, our representative will transfer you to the hotel. Later in the evening, you will go for the sightseeing tour of the breathtaking royal buildings around Lake Pichola in boat. Return to your hotel overnight stay.', NULL, NULL, NULL, 0, '2026-01-08 05:33:11'),
(1489, 39, 7, 'Udaipur sightseeing', 'Breakfast at the hotel and you will embark on sightseeing trip of Udaipur city, which is famously known as \"Venice of the East\" and \"City of Lakes\". You will visit the City Palace- it is the largest royal complex in Rajasthan, which stands on a rocky promontory and comprises of cupolas, balconies, and towers which gives a wonderful view of the lake and the city. After this you will visit Jagdish temple, which was built in 1651 A.D. by Maharana Jagat Singh, this Indo-Aryan temple is dedicated to Lord Jagannath, a manifestation of Vishnu and noted for its beautiful sculpted images and towering shikhara. Then you will drive through the old city of Udaipur to reach Fateh Sagar Lake and will also see Saheliyon-Ki-Bari - Courtyard of the Maidens was designed and laid out early in the eighteenth century as a retreat for ladies of the royal household to spend their time in leisure. Later in the evening you can visit Monsoon palace for sunset or you can do shopping in this beautiful city, which is famous for hand printed textiles, wall hangings, wooden folk toys and much more.', NULL, NULL, NULL, 0, '2026-01-08 05:33:11'),
(1490, 39, 8, 'Udaipur -Delhi (By Flight)', 'After having your breakfast at the hotel, our representative will transfer you to Udaipur Airport to board the flight for New Delhi. Continue your onward journey with sweet memories.', NULL, NULL, NULL, 0, '2026-01-08 05:33:11'),
(1491, 38, 1, 'Arrival in Delhi.', 'As per your flight/train schedule driver pickup you from Airport/train station and transfer you Agra. Evening check in Agra hotel. over night rest in Agra hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:34:32'),
(1492, 38, 2, 'Agra - Jaipur.', 'Early morning at the time of sunrise or after the breakfast visit the Taj Mahl (best time to visit Taj Mahal) and visit Agra fort. Depart from Agra to Jaipur around 4 hours drive. on the way visit Fatehpur Sikri (fort).\r\nAnd evening check in Jaipur Hotel. over night stay in Jaipur Hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:34:32'),
(1493, 38, 3, 'Jaipur - Delhi.', 'After Breakfast Start your guiding tour of Jaipur. Visit - Amber fort, City palace, Hawa Mahal, Jantar Mantar, Jal Mahal. around 3/4 pm depart from Jaipur to Delhi around 5 hrs drive. Late evening check in Delhi hotel. Over night stay in Delhi hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:34:32'),
(1494, 38, 4, 'Delhi- Airport/train station drop.', 'After breakfast start your guiding tour of capital city Jaipur tour. Visit- Red fort, Humayun Tomb, Qutab Minar, India Gate, Lotus Temple, President house as per your flight schedule or train Schedule driver transfer you Delhi Airport/Train station', NULL, NULL, NULL, 0, '2026-01-08 05:34:32'),
(1500, 18, 1, 'Arrive in Delhi', 'check-in at hotel. On your Golden Triangle Tour, Fresh Later look at the visit Red Fort, Chandni Chowk, Jama Masjid, Qutub Minar and Humayun\'s Tomb. Overnight at hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:35:17'),
(1501, 18, 2, 'Agra - Jaipur', 'After refreshing breakfast move for Agra the city of love. Upon arrival, enter into the hotel and relax for few minutes and Then visit the Agra fort made with red sand stone by Akbar. Later visit Taj Mahal built by Shah Jahan for his wife Mumtaz Mahal. The charm of this structure is unparallel. It is said that the death of his lovely wife forced him to make this memorial and used 20,000 men as labored for over 17 years to build this image of white marble and expensive stone. Overnight at hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:35:17'),
(1502, 18, 3, 'Agra – Jaipur via Fatehpur Sikri', 'drive to Jaipur enroute visiting Fatehpur Sikri-a perfectly preserved red sandstone “ghost town” which was the estranged capital of mughal emperor Akbar, built in 1569 and deserted when its water supply failed. Arrive Jaipur & transfer to Hotel of Golden TriangleTours. Overnight in hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:35:17'),
(1503, 18, 4, 'Jaipur – Delhi', 'After breakfast,leave hotel to move towards Jaipur is city has ruled out by various royal Rajputs and there are several spots in Jaipur where you can find their royal residences. visit to enjoy Amber Fort with elephant ride. Later visit Royal Palace museum, Jantar Mantar and Hawa Mahal. Evening is fixed for the white Birla temple. Must visit chowki dhani to enjoy Rajasthani cuisines along with Golden Triangle Tourfolk dances, puppet shows, live music, astrology and others! Enter into the hotel and take a night sleep. Overnight at hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:35:17'),
(1504, 18, 5, 'Jaipur – Delhi', 'After breakfast, drive to Delhi. Arrive Delhi check in at hotel. Overnight at hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:35:17'),
(1505, 4, 1, 'Delhi - Shimla (380 kms)', 'On Arrival in Delhi we will meet you and transfer by to Shimla (343 kms / 8 hrs).Shimla is capital of himachal former capital of Britishers also set amidst, the snow copper, shaivalik,mountains which offer some of the most beautifull view of himalaya Reach there and check in hotel Dinner and overnight at Simla.', NULL, NULL, NULL, 0, '2026-01-08 05:36:26'),
(1506, 4, 2, 'Shimla', 'After breakfast,go out for a sightseeing trip to Kufri(14 kms/1 hour). Afternoon half day city tour visiting Indian Institute Of Advanced Studies, Sankat Mochan Temple and Jakhu Temple, Evening free to stroll in the famous shopping place of Shimla town - The Mall & The Ridge. Dinner and Overnight at hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:36:26'),
(1507, 4, 3, 'Shimla - Kasauli (80 Kms/2 hours)', 'After breakfast,transfer to Kasauli.Kasauli is a small,unspoiled hill station in Solan district of Himachal Pradesh,it is far away from the maddening crowds which you find in other cities and hill stations.Day at leisure and dinner and overnight stay at hotel in Kasauli.', NULL, NULL, NULL, 0, '2026-01-08 05:36:26'),
(1508, 4, 4, 'Kasauli', 'After breakfast,go for local sightseeing in the town and near by areas,evening at leisure,one can spend evening tolling in the mall and shopping.Dinner and overnight stay at hotel in Kasauli.', NULL, NULL, NULL, 0, '2026-01-08 05:36:26'),
(1509, 4, 5, 'Departure(Kasauli-Delhi)', 'After breakfast,depart for Delhi(320 kms/7 hours).Tour Ends.', NULL, NULL, NULL, 0, '2026-01-08 05:36:26'),
(1521, 9, 1, 'Delhi Arrival', 'Arrive at Delhi airport and our representative will welcome you. Transfer to the hotel. After freshen up, enjoy the thrills and chills of the place. Start the sight seen with rickshaw ride at the Old Bazaar. Also enjoy the magnificent sight at Jama Masjid, Red Fort & Humayun Tomb. Also enjoy lovely site seen at President House, Raj Ghat and various other places. Get back in the hotel and stay relaxed with our complementary dinner.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1522, 9, 2, 'Delhi – Agra', 'After early breakfast, proceed towards Agra. On the way, you will enjoy the wonderful scenic at Fatehpur Sikri. This monument will certainly fill your spirit with happiness and joy. After having Lunch, you will also witness the mesmerizing site scene at The Taj Mahal – One of the Seven Wonders of the World. Check in at the hotel and overnight stay with our complementary dinner.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1523, 9, 3, 'Agra – Sankasya – Lucknow', 'After early breakfast, move for Lucknow with packed Lunch. En route you will visit famous Buddha Stupa at Sankasya. Enjoy the holy site. Arrive in Lucknow and check in at the hotel with complementary Dinner.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1524, 9, 4, 'Lucknow – Sravasti', 'After breakfast, enjoy the royalty of the City of Nawabs. Get the glance at Chota Imambara, Dilkusha Kothi and various other places on the way to Sravasti. On the way, have Lunch while enjoying the site seen. Arrival at Sravasti and check in at the hotel with our complementary Dinner.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1525, 9, 5, 'Sravasti – Kapilvastu – Lumbini (Nepal)', 'After breakfast, proceed towards Lumbini. On the way, get the glimpse of holistic site at Sravasti where Lord Buddha did miracle to impress the non-believers. En route have Lunch along with the site seeing. Check in at the hotel at Lumbini, overnight stay with complementary Dinner.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1526, 9, 6, 'Lumbini – Kushinagar', 'After breakfast, enjoy the spirituality of Mayadevi Temple which is a UNESCO World Heritage Site and birth place of Buddha. En route have Lunch. Check in at the hotel at Kushinagar and have complementary Dinner at hotel.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1527, 9, 7, 'Kushinagar – Vaishali – Patna', 'After the breakfast, visit Nirvana Chaitya where Buddha achieved the divine knowledge. On the way, you will visit Vaishali. Also enjoy Lunch en route. Arrival in Patna and check in at the hotel with our complementary Dinner.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1528, 9, 8, 'Patna – Rajgir – Nalanada – Bodhgaya', 'After breakfast, visit various sites at Patna. Get the glimpse of the ancient civilization at Rajgir which harbors famous place Makhdum Kund. En route Lunch at the Hotel. Arrival in Bodhgaya and check in at the hotel with complementary Dinner.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1529, 9, 9, 'Bodhgaya', 'After breakfast, start your tour in the spiritual city of Bodhgaya. The city is well known for its architectural monuments in the form of the magnificent temples. Visit the most popular Mahabodhi Temple. Here, Buddha spent years in the search of knowledge. You will get the glimpse of the life of Buddha through museum, house and sculptures. You will get comprehensive knowledge about the life of Buddha while visiting Dungeshwari Cave temples. Here, he spent various phases of life while reaching towards enlightenment. Lunch at the Hotel. After performing religious activities get back in hotel and have overnight stay with complementary Dinner.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1530, 9, 10, 'Bodhgaya – Varanasi', 'After breakfast, proceed towards Varanasi. Check in, Lunch at the hotel. After rest enjoy the mesmerizing site seen. This is another spiritual place for the Buddhists. Get the glimpse at the Sarnath Temple. This is a sacred place where Buddha delivered his first sermon. You mind and soul will certainly get fill with the spirituality of this place. Overnight stay at the hotel with complementary Dinner.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1531, 9, 11, 'Varanasi – Delhi', 'After breakfast, transfer to Delhi.', NULL, NULL, NULL, 0, '2026-01-08 05:46:37'),
(1535, 51, 1, 'Arrive in Delhi', 'As per your flight schedule driver pickup you from Delhi Airport. And depart from Delhi to Agra. around 3 hours drive so late evening check in Agra hotel. overnight in Agra hotel.', NULL, NULL, NULL, 0, '2026-01-25 16:25:52'),
(1536, 51, 2, 'Agra - Jaipur', 'Early morning at the time of Sunrise visit the Taj Mahal. (best time to visit the Taj). after the Taj Mahal tour back to the hotel for breakfast. and visit the Agra fort and depart from Agra to Jaipur around 4 hour drive, on the Way visit Fatehpur sikri Fort (Capital city of Akbar). evening check in Jaipur hotel over night rest in Jaipur hotel. overnight in Jaipur Hotel.', NULL, NULL, NULL, 0, '2026-01-25 16:25:52'),
(1537, 51, 3, 'Jaipur- Delhi', 'After breakfast start your Guiding tour of Capital city of Rajasthan Jaipur.\r\n\r\nVisit:- Amber Fort, City Palace. Hawa Mahal, Jal Mahal, Jantar Mantar,\r\nafter the guiding tour of Jaipur visit Jaipur Bazaar and around 4 pm Depart from Jaipur to Delhi, Around 4/5 hour drive, evening around 9 pm driver transfer you to Delhi Airport/ Hotel/ Railway Station', NULL, NULL, NULL, 0, '2026-01-25 16:25:52'),
(1560, 67, 1, 'Delhi to Shimla (Approx. 350 km / 7–8 hrs)', 'ick-up from Delhi (home / hotel / airport / railway station) and drive towards Shimla in a comfortable private car. Enjoy scenic mountain views en route. On arrival, check-in at hotel and relax. Evening free for leisure or local walk. Overnight stay in Shimla.', NULL, NULL, NULL, 0, '2026-01-25 16:36:09'),
(1561, 67, 2, 'Shimla & Kufri Sightseeing', 'After breakfast, proceed for local sightseeing of Shimla and Kufri. Visit Kufri Fun World, Jakhoo Temple, Mall Road, The Ridge and Christ Church. Enjoy shopping and local cuisine at Mall Road. Overnight stay in Shimla.', NULL, NULL, NULL, 0, '2026-01-25 16:36:09'),
(1562, 67, 3, 'Shimla to Manali (Approx. 250 km / 7 hrs)', 'Post breakfast, check-out and drive to Manali. En route visit Kullu Valley, Pandoh Dam, Sundernagar Lake and optional river rafting in Kullu. Continue towards Manali. Check-in at hotel and rest. Overnight stay in Manali.', NULL, NULL, NULL, 0, '2026-01-25 16:36:09'),
(1563, 67, 4, 'Manali Local Sightseeing', 'After breakfast, explore local attractions of Manali including Hadimba Devi Temple, Vashisht Hot Springs, Manu Temple, Van Vihar and Mall Road. Evening free for shopping or leisure activities. Overnight stay in Manali.', NULL, NULL, NULL, 0, '2026-01-25 16:36:09'),
(1564, 67, 5, 'Solang Valley / Atal Tunnel Excursion', 'After breakfast, proceed for an excursion to Solang Valley (subject to weather conditions). Enjoy adventure activities like paragliding, skiing, snow scooter and zip-lining (at own cost). Visit Atal Tunnel (if accessible). Return to Manali. Overnight stay in Manali.', NULL, NULL, NULL, 0, '2026-01-25 16:36:09'),
(1565, 67, 6, 'Manali to Delhi (Approx. 540 km / Overnight Drive / 12 hrs)', 'After breakfast, check-out and drive back to Delhi by private car with beautiful memories of the Himalayas. Drop at desired location in Delhi.', NULL, NULL, NULL, 0, '2026-01-25 16:36:09'),
(1585, 54, 1, 'Delhi Arrival', 'Meet and assist by our representative upon your arrival at the airport and drive to hotel, Rest after Delhi Private Trip-\r\n\r\nRed Fort-Old Delhi-Rajghat-India Gate-Humyun tomb-lotus temple-Qutab miner', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1586, 54, 2, 'Delhi –Bikaner by Car', 'After breakfast in drive to Bikaner via Mandawa, visit Mandawa and see the local village life-stay in Bikaner', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1587, 54, 3, 'Bikaner Jaislmer-By Car', 'After breakfast drive to Jaislmer city is one of India most beautiful, colorful & fascinating place. Arrive Jaislmer check in at Hotel. Stay Jaislmer', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1588, 54, 4, 'Jaislmer Sightseen', 'After a relaxed breakfast proceed for full day sightseeing tour of The Golden City – Jaislmer. It is in the heart of the Great Indian Desert. Its temple, fort and palaces are all built of yellow stone. The city is a mass of intricately carved buildings, facades and elaborate balconies. visit the Jaislmer fort-oldest living fort , Desert Camel ride etc-Stay Jaislmer .', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1589, 54, 5, 'Jaislmer Jodhpur by Car', 'After breakfast drive to Jodhpur the Gateway to the Thar Desert. Arrive Jodhpur check in at hotel. After visit Jaswant Thada and Meharangarh-Stay Jodhpur', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1590, 54, 6, 'Jodhpur Ranakpur by Car', 'After breakfast drive to Ranakpur visit world famous 500 years old incredible jain temple with 1444 pillar, all pillar are different then each other. After jain temple visit to natural lake with very nice view of sun set-Stay Ranakpur', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1591, 54, 7, 'Ranakpur Udaipur by Car', 'After Ranakpur drive to Udaipur –the city of the lakes , arrive and stay in Udaipur', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1592, 54, 8, 'Udaipur Sightseen', 'This morning after breakfast visit Udaipur and see the nice lakes and life etc-Stay in Udaipur', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1593, 54, 9, 'Udaipur Pushkar by Car', 'After breakfast drive to Pushkar edge of the desert lies the tiny tranquil town of Pushkar along the bank of the picturesque Pushkar Lake. This is an important pilgrimage spot for the Hindus, which has the only temple of Lord Brahma in the country and one of the few in the world. Stay Pushkar', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1594, 54, 10, 'Udaipur Jaipur by Car', 'After breakfast proceed to Jaipur the capital of Rajasthan, arrive Jaipur and check-inn and after the city tour.', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1595, 54, 11, 'Jaipur Sightseen', 'Drive  to the Hawa Mahal, Jantar Mantar, City Palace , wind Palce amber fort  and the in-house Museum. Walk along the bazaars of the “Pink City” and enjoy the colorful life of the city. You will be amazed at the sight of the men and the women folk dressed in the most colorful way, especially ladies adorned with heavy silver jewelry-Stay Jaipur', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1596, 54, 12, 'Jaipur Ranthambore-National Game Park', 'After breakfast drive to Ranthambore national park, arrive afternoon and relex-stay Ranthambore', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1597, 54, 13, 'Ranthambore-National Game Park Safaris', 'This morning visit game park 6:00 am –11:00 am Jeep safari and 2nd safari 14:00 pm to 18:00 Pm –\r\n\r\nHere you have chance to see many animal and Indians tigers-night stay in Ranthambore', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1598, 54, 14, 'Ranthambore-Agra by Car via fatepur sikri', 'After breakfast check out from the hotel and drive to city of marble Agra via fatepursikri-Stay Agra', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1599, 54, 15, 'Tajmahal Visit and drive to Khajuraho', 'Visit Tajmahal morning (sunrise) after breakfast and drive to Kamasutra city Khajuraho-Stay Khajuraho.', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1600, 54, 16, 'Khajuraho Tour', 'After breakfast in hotel proceed to explore beautiful town Khajuraho. Khajuraho known for its temples built from 950 A.D to 1150 AD, by the Candela Dynasty. The group of thirty temples urahois an example of Indian architectural excellence The Western group of temples are best known for their erotic sculptures. Stay Khajuraho', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1601, 54, 17, 'Khajuraho Varanasi Flight', 'Driver drop you Khajuraho airport and flight to Varanasi , pickup Varanasi airport and move to the hotel\r\n\r\n After we take you to banks of the river Ganges where we board a boat to see the morning ablutions of the Hindus from the security of our boat.See the Kashi Vishwanath temple and the Gyanvyapi kund and the mosque attached to it. Also visit the Benares Hindu University the largest residential university in India with more than 3000 residential students', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1602, 54, 18, 'Varanasi Stay', 'Varanasi Sightseeing', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1603, 54, 19, 'Flight back to New Delhi', 'Flight back to New Delhi', NULL, NULL, NULL, 0, '2026-01-26 12:29:51'),
(1612, 53, 1, 'Delhi Arrival', 'Our Company persons meet you in New Delhi airport and transfer to hotel', NULL, NULL, NULL, 0, '2026-01-26 12:30:52'),
(1613, 53, 2, 'Delhi Day Tour', 'This morning after breakfast you start Delhi tour and you visit Red fort, Jama masjid, Rajghat, old Delhi, India gate Huyuman tomb, lotus temple , some temple in the city and you take nice lunch and dinner in the city and night stay in Delh', NULL, NULL, NULL, 0, '2026-01-26 12:30:52'),
(1614, 53, 3, 'Delhi -Agra –Drive', 'This Morning after breakfast you drive to Agra city ( the Taj Mahal) check-in in the hotel and refresh after you start Agra tour and you visit Agra Fort /Baby Taj Mahal and in evening you see the nice sunset from back sight of Taj Mahal and night stay in Agra.', NULL, NULL, NULL, 0, '2026-01-26 12:30:52'),
(1615, 53, 4, 'Agra- Fathepur sikri -Ranthambore Drive', 'This morning pickup from your hotel and transfer to Taj Mahal and you see nice sunrise in the taj Mahal, enjoy the taj and after beck to the hotel and refresh and breakfast after drive to Ranthambore and night stay in Ranthambore', NULL, NULL, NULL, 0, '2026-01-26 12:30:52'),
(1616, 53, 5, 'Ranthambore Jeep Tour (Morning & Afternoon)', 'This morning we provide you jungle tour by jeep, the first tour is 6 am and 2nd tour is 14:00 PM and night stay in hotel.', NULL, NULL, NULL, 0, '2026-01-26 12:30:52'),
(1617, 53, 6, 'Ranthambore- Jaipur Drive', 'Breakfast & Check-out from Ranthambore hotel and drive to pink city Jaipur (the capital of Rajasthan and after continue drive to Jaipur & check-in in the hotel and night stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-26 12:30:52'),
(1618, 53, 7, 'Jaipur Tour', 'This morning we visit world famous amber fort and there you also enjoy the elephant ride and after we visit water palace, city palace, wind palace and some local area and monkey temples and Night stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-26 12:30:52'),
(1619, 53, 8, 'Jaipur – Delhi Drive', 'This day you drive back to new Delhi and drop you at airport', NULL, NULL, NULL, 0, '2026-01-26 12:30:52'),
(1629, 17, 1, 'Arrive at Delhi', 'As per your flight schedule our represntative pickup you from Delhi Airport and transfer you to Delhi hotel. over night rest in Delhi hotel.', NULL, NULL, NULL, 0, '2026-01-26 12:33:31'),
(1630, 17, 2, 'Delhi Guiding Tour', 'After Breakfast for full day side sightseeing like the Red Fort, Chandni Chowk Bazaar and Khari Baoli spice market on your way to visit Jama Masjid. One of the largest mosques in the world and the largest in India, it was built by Shah Jahan to dominate the city. Then, make your way to Raj Ghat, a memorial built to commemorate the site of Mahatma Gandhi\'s cremation. Also visit the UNESCO World Heritage-listed Qutub Minar, India\'s tallest minaret, made of red sandstone and marble and inscribed with verses from the Qur\'an.', NULL, NULL, NULL, 0, '2026-01-26 12:33:31'),
(1631, 17, 3, 'Delhi - Jaipur. (260 km 6 hrs)', 'After breakfast depart from Delhi to Jaipur around 6 hour drive. evening check in Jaipur hotel.\r\nOver night rest in Jaipur hotel.', NULL, NULL, NULL, 0, '2026-01-26 12:33:31'),
(1632, 17, 4, 'Jaipur', 'today proceeds to \'Pink City\' Jaipur. After Breakfast, Visit Amber - the ancient capital of the Rajput Empire reaching the fort on elephant back. It is a deserted palace surrounded by majestic ramparts & the magnificent public & private room\'s evidence the splendor of the rulers of 16th & 17th century Rajasthan. Also visit City Place, Janter Mantar and Hawa Mahal in evening leisure. Overnight at Hotel.', NULL, NULL, NULL, 0, '2026-01-26 12:33:31'),
(1633, 17, 5, 'Jaipur:- Agra (200 Kms / 04 hrs)', 'After breakfast drive to Agra en-route visit Fatehpur Sikri. Later continue drive to Agra. Arrive and check in at Hotel. Akbarabad, as Agra was known during the Mughal era, is home to some of the most magnificent Mughal architectures. Situated on the banks of river Yamuna, the monumental beauty of Agra has inspired countless people around the world. This third largest city of the state of Uttar Pradesh is home to three UNESCO world heritage sites. Overnight at Hotel.', NULL, NULL, NULL, 0, '2026-01-26 12:33:31'),
(1634, 17, 6, 'Agra - Varanasi', 'On day 06 of Delhi Agra Jaipur Varanasi Tour, Early morning at the time of sun rise visit the Taj mahal (best time to visit the Taj Mahal). after the Taj mahal back to the hotel for breakfast and visit the Agra Fort (world heritage site, baby Taj. Sikandra (tomb of Akbar). late evening catch the night train from Agra to Varanasi.', NULL, NULL, NULL, 0, '2026-01-26 12:33:31'),
(1635, 17, 7, 'Varanasi Arrival & City Tour', 'Arrive at Varanasi station. Meet and transfer to hotel for check in. Dating back to more than 3000 years, Varanasi is said to be the oldest city of the world. There are temples at every few steps here Hinduism it is believed that those who breathe their last in this city attain nirvana and get an instant gateway to liberation from the cycle of births and re-births. After Lunch proceed for tour planned for second half of the day We begin the tour of the city with the famous Banaras Hindu University.', NULL, NULL, NULL, 0, '2026-01-26 12:33:31'),
(1636, 17, 8, 'Varanasi City Tour', 'Early morning proceed to morning Cruise on Ganges. The \'Ghats of Ganga\' dotted with temples or more than 100 ghats (banks) alongside the Ganges in Varanasi. The best way to cover them all is acruise. A morning cruise on the Ganges presents a very beautiful view of the ghats bathed in crimson light. After Lunch half day excursion to Sarnath. Evening explore the city. A walk through old Varanasi will be memorable experience.', NULL, NULL, NULL, 0, '2026-01-26 12:33:31'),
(1637, 17, 9, 'Varanasi Departure', 'Morning catch the train or flight from Varanasi to Delhi. driver pickup you from Delhi Train station/Airport. If you left some sight in Delhi you can visit today. evening driver transfer you Airport to catch your Early morning flight from Delhi. Tour to Varanasi ends.', NULL, NULL, NULL, 0, '2026-01-26 12:33:31'),
(1650, 6, 1, 'Pick up from Delhi airport transfer to Haridwar.', 'Highlights - Ganga Aarati at Har ki Pauri\r\n\r\nMeet our assistance on arrival as per your predefined schedule and further proceed to Haridwar.\r\nUpon arrival check into the hotel and further you can proceed for Ganga Aarti at Har Ki Pouri on\r\nyour own if possible with available time and conditions. So here Har Ki pouri is the center point\r\nof Haridwar and there are several local transports available for this sight. We kept you free to\r\nexplore the local Haridwar and edge of Ganges. Overnight stay in Haridwar.', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1651, 6, 2, 'Haridwar Barkot (approx 215km / 07 hrs. drive)', 'Highlights - Mussoorie & Kempty Fall\r\n\r\nThis morning, you depart for Barkot. Barkot is a beautiful hill station which is located on the foot\r\nof Yamunotri. As you drive through Mussoorie, you can visit the famous Kempty Falls on your\r\nway. On arrival at Barkot, check-in to your hotel/camp. Rest of the day is free to relax and store\r\nyour energy for the hiII Yatra of Yamunotri Overnight stay at Barkot.', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1652, 6, 3, 'Barkot  Yamunotri Barkot (approx 42 km DRIVE / 06 km TREK)', 'Highlights - Yamunotri Temple\r\n\r\nAfter breakfast, depart for Hanumanchatti (40 Km), Janki Chatti (8 km). Here you will begin the\r\nFirst hill Yatra of Yamunotri (6 Km trek). You have an option of hiring Palki or a horse for your\r\ntrek. (Cost Not Included).\r\nThe trek passes through lush green valley, a profusion of conifers, rhododendrons, cacti and\r\nseveral species of Himalayan shrubs.', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1653, 6, 4, 'Barkot  Uttarkashi (approx DRIVE 82 km, / 04 hrs. DRIVE)', 'Highlights - Vishwanath Temple\r\n\r\nAfter breakfast check out from the Barkot hotel and drive to Uttarkashi. En route visit the famous\r\nVishwanath Temple on Uttarkashi. On arrival check in into the hotel. Uttarkashi is situated on the\r\nbanks of river Bhagirathi and is famous for its historical monuments, Temples & Ashrams. .\r\nOvernight stay at Uttarkashi.', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1654, 6, 5, 'Uttarkashi  Gangotri Uttarkashi (approx 100 km. PER WAY)', 'Highlights - Gangotri Temple\r\n\r\nEarly morning breakfast at the hotel and drive to Gangotri. Upon arrival at Gangotri take a holy\r\ndip in the sacred river Ganges which is also called Bhagirathi at its origin. Visit the Gangotri\r\nTemple. The 18th century\'s temple dedicated to Goddess Ganga is located near a sacred stone\r\nwhere King Bhagirathi worshiped Lord Shiva. Ganga is believed to have touched earth at this\r\nspot. The temple is an exquisite 20 ft. high structure made of white granite. After performing\r\nPooja, afternoon drive back to Uttarkashi. Overnight stay at Uttarkashi.', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1655, 6, 6, 'Uttarkashi  Guptkashi / Phata (approx 223 kms / 09 hrs DRIVE)', 'Highlights - Shree Kashi Vishwanath Temple and Ardhnareshwar Temple\r\n\r\nLeave for your next destination, Guptkashi after having your breakfast early in the morning. On\r\nreaching, check-in to the hotel. Guptkashi is located at a distance of 47 km from the holy shrine,\r\nKedarnath. The town holds immense religious importance as it houses famous ancient temples\r\nlike Shree Kashi Vishwanath Temple and Ardhnareshwar Temple. overnight in the hotel/camp.', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1656, 6, 7, 'Guptkashi/Phata  Kedarnath (approx 27 km DRIVE + 19 km TREK)', 'Highlights - Kedarnath Temple, Adi Shankaracharya Temple\r\n\r\nEarly morning after breakfast drive to the helipad from where, you will start to fly to Kedarnath\r\nby helicopter. Mandakini, one of the main tributaries of the Ganges originates at Kedarnath and\r\nflows through Gaurikund. \"Jai Bholenath\" chants echo in the mountains. The mists envelop the\r\nmountains and slowly lift away. When you can view the picturesque beauty you are left\r\nmesmerized. Overnight stay at Kedarnath.', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1657, 6, 8, 'Kedarnath Guptkashi / Phata (approx 27 km DRIVE + 19 km TREK)', 'Early morning after breakfast you can come back to the helipad to fly to the Sersi / Phata by\r\nhelicopter. The vehicles are waiting for you in the helipad and youï¿½ll drive to the hotel and\r\nOvernight at Guptkashi.', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1658, 6, 9, 'Guptkashi/ Phata  Pandukeshwar / Badrinath (185 kms / 7 hrs )', 'Highlights - Chopta Peak\r\n\r\nAfter having your breakfast in the morning, check out of the hotel and start driving towards your\r\nnext destination, Badrinath via Joshimath. Badrinath is an important pilgrimage site which holds\r\nimmense importance for both Hindus and Buddhists. Badrinath temple is dedicated to Lord\r\nVishnu and is set at a height of 3133 meter. On arrival check into the hotel. After some rest and\r\nrefreshments you are all set to go to Badrinath Temple for darshan in the evening. But first you\r\nhave to go to Tapt Kund (Hot Spring), take a bath and then go to the temple. Dedicated to Lord\r\nVishnu. Later back to hotel. Overnight stay at hotel.', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1659, 6, 10, 'Badrinath  Rudraprayag', 'Highlights - Mana Village - Vasudhara Falls, Satopanth Lake, Bhim Pul, Saraswati Temple,\r\nGanesh Gufa & Vyas Gufa\r\nAlso see Vishnuprayag, Nandprayag, Karnprayag\r\n\r\nThis morning if we had not visited Badrinath Temple, we could visit for Darshan. Later return to\r\nthe hotel for breakfast. After breakfast check out from the hotel and proceed to Mana Village\r\nwhich is known as the last village of India. Places to visit in Mana Village - Bhim Pool, Vyas\r\nGufa and Vasudhara Falls. Later you drive for Rudraprayag. En-route you can see\r\nVIshnuprayag, Nandprayag, Karanprayag. On reaching Rudraprayag, check-in to the hotel. You\r\ncan relax for the rest of the day.stay overnight at the hotel.', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1660, 6, 11, 'Rudraprayag  Rishikesh', 'Highlights - Rudraprayag, Dhari Devi Temple, Dev Prayag, Ram Jhula, Laxman Jhula\r\n\r\nEarly morning, after breakfast, you drive downhill to Rishikesh, a spiritual city and the Yoga\r\ncapital of the world. Enroute you can visit Mata Dhari Devi Temple. On reaching Rishikesh, go\r\nout for sightseeing. Visit Ram Jhula and Laxman Jhula. Evening you can visit Ganga Aarati at\r\nTriveni Ghat. drop to Hotel. overnight stay in hotel', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1661, 6, 12, 'Rishikesh- Delhi', 'After breakfast check out from the hotel and drive to Delhi', NULL, NULL, NULL, 0, '2026-01-26 12:37:34'),
(1662, 15, 1, '02:30 AM: - Pickup from Delhi', 'You will be picked up from your hotel in Delhi or any other convenient location to begin your Taj Mahal tour. Drive to Agra (243.4 km) along the Yamuna Expressway.', NULL, NULL, NULL, 0, '2026-01-26 12:39:38'),
(1663, 15, 2, '06:00 AM: -Arrival in Agra', 'Reach Agra and then get ready for your visit to the Taj Mahal after a quick pit stop for some tea and refreshments.', NULL, NULL, NULL, 0, '2026-01-26 12:39:38'),
(1664, 15, 3, '06:30 AM: - Visit the Taj Mahal', 'This is the highlight of your sunrise Taj Mahal tour, as you enter the historic monument that was built between 1631 and 1648 in Agra by Mughal Emperor Shah Jahan as a tribute to his wife Mumtaz Mahal. The key highlight of your visit is that you can see the UNESCO World Heritage Site at sunrise as the rays fall on the ivory-white marble faï¿½ade and create an unforgettable experience.', NULL, NULL, NULL, 0, '2026-01-26 12:39:38'),
(1665, 15, 4, '08:00 AM: - Breakfast Stop', 'After youï¿½re done exploring the Taj Mahal at sunrise, the next pit-stop will be at a local restaurant near the monument for a hearty local breakfast. Savor the rich flavors of Agra as you dig into a hearty meal here.', NULL, NULL, NULL, 0, '2026-01-26 12:39:38'),
(1666, 15, 5, '09:00 AM: - Journey to the Agra Fort', 'The next destination on your sunrise Taj Mahal tour from Delhi is the Agra Fort. It was built in 1565 AD by Mughal Emperor Akbar. Explore the sprawling complex which includes the Musamman Burj where Shah Jahan was imprisoned and passed away. This fort was the main residence of the Emperor until the year 1638 when the capital shifted away to Delhi.', NULL, NULL, NULL, 0, '2026-01-26 12:39:38'),
(1667, 15, 6, '10:30 AM: - Trip to the Local Bazaars', 'Enjoy a unique experience on your sunrise Taj Mahal tour as you stroll through Agraï¿½s famous local bazaars. Purchase handicrafts and souvenirs along with buying the famous Petha sweets to take back home from your trip. You may choose the Sadar Bazaar near the Agra Cantonment railway station and browse leather items, shoes, souvenirs, and street food here. Another option is the Tajganj Market, which is just near the Taj Mahal and offers souvenirs, handicrafts, marble items, and gifts.', NULL, NULL, NULL, 0, '2026-01-26 12:39:38'),
(1668, 15, 7, '12 PM- Return to Delhi', 'Wind up your sunrise Taj Mahal tour and get set for the drive back to Delhi, bringing the curtains down on an awe-inspiring experience.', NULL, NULL, NULL, 0, '2026-01-26 12:39:38'),
(1676, 55, 1, 'Delhi Arrival', 'Transfer to hotel by private Car', NULL, NULL, NULL, 0, '2026-01-27 14:26:55'),
(1677, 55, 2, 'Delhi mathura drive', 'Destination and Places to Cover\r\n\r\nMathura : Shri Krishna Janmabhoomi ( Birth Place of Lord Krishna ), Potara Kund, Dwarkadheesh Temple, Vishram Ghat, Birla Temple\r\n\r\nVrindavan : Shri Banke Bihari Temple, Nidhivan, ISKCON, Prem Mandir, Rangnath Temple, Vaishno Devi-night stay mathura', NULL, NULL, NULL, 0, '2026-01-27 14:26:55'),
(1678, 55, 3, 'Mathura Agra Drive', 'Now Take A Short Tea Or Coffee Break To Get You Refreshed! Now Drive Towards Agra.\r\nAfter three And A Half Hours Of Drive, You Will Arrive In The Beautiful City Of Agra. Arrive Agra, Our Executive Will Introduce The Tour Guide-visit tajmahal and Agra fort-night stay Agra', NULL, NULL, NULL, 0, '2026-01-27 14:26:55'),
(1679, 55, 4, 'Agra -Ayodha Drive', 'After agra tour drive to the land of the shree ram , arrive in evening', NULL, NULL, NULL, 0, '2026-01-27 14:26:55'),
(1680, 55, 5, 'Ayodha Sightseen', 'Darshan timing for Ram Mandir in Ayodhya is from 7:00 AM to 11:30 AM in morning while in evening darshan timing is 2:00 PM to 7:00 PM.\r\n\r\nRam Mandir Temple Ayodhya Aarti Timings:\r\n\r\nMorning Aarti - 6:30 AM\r\nAfternoon Aarti - 12:00 PM\r\nEvening Aarti - 7:30 PM\r\n\r\n1) Ram Mandir:- The magnificent Ram Mandir is ready with 1st floor and Vigrah of Shree Ram. Spanning in 54,700 sq ft, the temple area covers nearly 2.7 acres of land. The entire Ram Mandir Complex would be spread over nearly 70 acres and will be equipped to host about a million devotees at any time. The Mandir dimensions are 380 feet length, 161 feet height and 250 feet wide. The temple situated near Saryu River is built in traditional Nagar architectural style. The Temple with 392 pillars will have main Sanctrum, Mandaps. There are four temples on corners dedicated to Sun God, Lord Ganesha, Goddess Bhagwati and Lord Shiva.', NULL, NULL, NULL, 0, '2026-01-27 14:26:55'),
(1681, 55, 6, 'Ayodha Sightseen', 'Hanuman Garhi Temple:- This temple dedicated to Lord Hanuman is one of the most visited temples in Ayodhya and situated on hill top. Devotees and visitors climb a series of stairs to reach the Hanuman Garhi temple complex. The main deity in the temple is Lord Hanuman, and the idol is enshrined in a small cave-like structure.\r\n3) Kanak Bhawan:- Kanak Bhawan is a palace made of gold is said to be gifted by Kaikeyi to Goddess Sita where you will find idols of Lord rama and Sita.\r\n4) Dashrath Mahalaya Palace Museum:- This museum showcases artifacts and exhibits related to the history and culture of Ayodhya. It is located within the complex of the Dashrath Bhavan.\r\n5) Treta Ke Thakur:- An ancient temple that is believed to be the place where Lord Rama performed the Ashwamedha Yagya.\r\n6) Swarg Dwar:- Translated as the \"Gateway to Heaven,\" it is believed to be the spot from where Lord Rama is said to have entered heaven. Devotees believe that passing through this gate ensures a place in heaven after death.\r\n7) Nageshwarnath Temple:- Dedicated to Lord Shiva, this temple is considered one of the oldest in Ayodhya. It is believed to have been established by Lord Rama\'s son, Kush.\r\n8) Kala Ram Temple:- This temple is dedicated to Lord Rama and showcases idols in black stone. It is known for its unique architecture and religious importance.\r\n9) Guptar Ghat:- A serene ghat on the banks of the Sarayu River, associated with the story of Lord Rama and his sons. It is a peaceful spot for reflection and prayer.', NULL, NULL, NULL, 0, '2026-01-27 14:26:55'),
(1682, 55, 7, 'Drop Lucknow-Train or Airport', 'Drop Lucknow-Train or Airport', NULL, NULL, NULL, 0, '2026-01-27 14:26:55'),
(1683, 42, 1, 'Arrive at Delhi', 'As per your flight schedule our represntative pickup you from Delhi Airport and transfer you to Delhi hotel. over night rest in Delhi hotel.', NULL, NULL, NULL, 0, '2026-01-27 14:28:30'),
(1684, 42, 2, 'Delhi Guiding Tour', 'After Breakfast for full day side sightseeing like the Red Fort, Chandni Chowk Bazaar and Khari Baoli spice market on your way to visit Jama Masjid. One of the largest mosques in the world and the largest in India, it was built by Shah Jahan to dominate the city. Then, make your way to Raj Ghat, a memorial built to commemorate the site of Mahatma Gandhi’s cremation. Also visit the UNESCO World Heritage-listed Qutub Minar, India’s tallest minaret, made of red sandstone and marble and inscribed with verses from the Qur’an. Next stop Lotus Temple completed in 1986. Notable for its flowerlike shape, it serves as the Mother Temple of the Indian subcontinent and has become a prominent attraction in the city also visit Iskon Temple a famous Krishana Temple. Stop next at Humayun’s Tomb, another UNESCO World Heritage site and tomb of a Mughal emperor dating back to the 1500s. Next, pass under the high stone archway of India Gate – constructed in the memory of Indian soldiers who died in World War I – and drive along Rajpath (King\'s Way), the ceremonial boulevard heading toward Rashtrapati Bhavan, official home to the President of India. Also visit Birla Temple a Lord Vishnu Temple. Along the way, your guide will point out architectural and cultural features of these important monuments. over night rest in Delhi hotel.', NULL, NULL, NULL, 0, '2026-01-27 14:28:30'),
(1685, 42, 3, 'Delhi - Jaipur', 'After breakfast depart from Delhi to Jaipur around 6 hour drive. evening check in Jaipur hotel.\r\nOver night rest in Jaipur hotel.', NULL, NULL, NULL, 0, '2026-01-27 14:28:30'),
(1686, 42, 4, 'Jaipur', 'today proceeds to \'Pink City\' Jaipur. After Breakfast, Visit Amber - the ancient capital of the Rajput Empire reaching the fort on elephant back. It is a deserted palace surrounded by majestic ramparts & the magnificent public & private room\'s evidence the splendor of the rulers of 16th & 17th century Rajasthan. Also visit City Place, Janter Mantar and Hawa Mahal in evening leisure. Overnight at Hotel', NULL, NULL, NULL, 0, '2026-01-27 14:28:30'),
(1687, 42, 5, 'Jaipur - Agra', 'After breakfast drive to Agra en-route visit Fatehpur Sikri. Later continue drive to Agra. Arrive and check in at Hotel. Akbarabad, as Agra was known during the Mughal era, is home to some of the most magnificent Mughal architectures. Situated on the banks of river Yamuna, the monumental beauty of Agra has inspired countless people around the world. This third largest city of the state of Uttar Pradesh is home to three UNESCO world heritage sites. Overnight at Hotel.', NULL, NULL, NULL, 0, '2026-01-27 14:28:30'),
(1688, 42, 6, 'Agra - Varanasi', 'On day 06 of Delhi Agra Jaipur Varanasi Tour, Early morning at the time of sun rise visit the Taj mahal (best time to visit the Taj Mahal). after the Taj mahal back to the hotel for breakfast and visit the Agra Fort (world heritage site, baby Taj. Sikandra (tomb of Akbar). late evening catch the night train from Agra to Varanasi.', NULL, NULL, NULL, 0, '2026-01-27 14:28:30'),
(1689, 42, 7, 'Varanasi Arrival & City Tour', 'Arrive at Varanasi station. Meet and transfer to hotel for check in. Dating back to more than 3000 years, Varanasi is said to be the oldest city of the world. There are temples at every few steps here Hinduism it is believed that those who breathe their last in this city attain nirvana and get an instant gateway to liberation from the cycle of births and re-births. After Lunch proceed for tour planned for second half of the day We begin the tour of the city with the famous Banaras Hindu University. Next we visit the famous 18th century Durga temple dedicated to Goddess Durga & later visit one of the most famous temples of Varanasi, the Tulsi Manas temple.We end our tour with a oneof-its-kind temple the ‘Bharat Mata’ (Mother India). The temple was inaugurated by Mahatma Gandhi in 1936. The temple has the undivided India personified as a mother deity and has her statue built in marble. Unlike other temples, this one does not have images of the customary gods and goddesses; it houses a relief map of India, carved out of marble.Evening Aarti ceremony - Every evening, hundreds of people gather at the banks of the river Ganges to participate in the aarti (hymn). The evening aarti offers one of the most spectacular sensory experiences, when hundreds of lamps light up the river side at dusk, the entire city of Varanasi comes to a standstill and the sound of chimes and dongs reverberates in each and every street. Overnight at Hotel.', NULL, NULL, NULL, 0, '2026-01-27 14:28:30'),
(1690, 42, 8, 'Varanasi City Tour', 'Early morning proceed to morning Cruise on Ganges. The ‘Ghats of Ganga’ dotted with temples or more than 100 ghats (banks) alongside the Ganges in Varanasi. The best way to cover them all is acruise. A morning cruise on the Ganges presents a very beautiful view of the ghats bathed in crimson light. After Lunch half day excursion to Sarnath. Evening explore the city. A walk through old Varanasi will be memorable experience', NULL, NULL, NULL, 0, '2026-01-27 14:28:30'),
(1691, 42, 9, 'Varanasi Departure', 'Morning catch the train or flight from Varanasi to Delhi. driver pickup you from Delhi Train station/Airport. If you left some sight in Delhi you can visit today. evening driver transfer you Airport to catch your Early morning flight from Delhi. Tour to Varanasi ends.', NULL, NULL, NULL, 0, '2026-01-27 14:28:30'),
(1697, 56, 1, 'Arrival at Delhi', 'Once you arrive at the Delhi Airport, the tour representative takes charge and helps in transfer to the pre- booked hotel. After checking in you may freshen up and head to the bazaars of Chandni Chowk or any cool lounge restaurant. For a typical punjabi cuisine, you may feel the essence of it at the dhabas of Delhi. Relax at the hotel after a scrumptious meal', NULL, NULL, NULL, 0, '2026-01-30 02:34:21'),
(1698, 56, 2, 'Delhi – Corbett', 'Post breakfast, leave for Corbett National Park by road. It is almost 270 kms from the capital. At the pre booked resort you check in and relax in the room. Post lunch a small orientation is held on Corbett National Park. After this you can enjoy the walk through the jungle and explore its rich wildlife and tiger watching.', NULL, NULL, NULL, 0, '2026-01-30 02:34:21'),
(1699, 56, 3, 'Dhikala', 'Depart to Dhikala by road after breakfast in Corbett. On the way you can see some wildlife activities. At Dhikala, check in at the resort. Later at Dhikala enjoy the game drive. For lunch, get back to the resort and then head on for an adventurous elephant ride. Get your cameras ready as this is home to the most beautiful species of birds and you can watch them closely. The sounds of the birds fill the forest with music. After this amazing experience, go back to the resort and have dinner.', NULL, NULL, NULL, 0, '2026-01-30 02:34:21'),
(1700, 56, 4, 'Corbett National Park', 'Post breakfast, head towards the Ramganga reservoir. Here you get an ariel view of the surroundings from a top Observation Tower. Its an absolute delight for the birdwatchers. Here they can explore and observe birds such as storks, kingfishers, terns, fish eagles and so on', NULL, NULL, NULL, 0, '2026-01-30 02:34:21'),
(1701, 56, 5, 'Corbett – Delhi (Departure', 'At the Corbett National Park make your early morning encounter with the elephants or deer or even a Tiger by taking a game safari. Post safari, enjoy a great breakfast spread at the resort. Depart for Delhi Airport by road post breakfast.', NULL, NULL, NULL, 0, '2026-01-30 02:34:21');
INSERT INTO `package_itinerary` (`id`, `package_id`, `day_number`, `title`, `description`, `meals`, `accommodation`, `activities`, `display_order`, `created_at`) VALUES
(1704, 52, 1, 'Delhi – Agra', 'Our representative will report you around 7:00 AM to take you to Agra. Through Yamuna Express highway, it takes around 3 hours to reach Agra. After reaching Agra, our representative will welcome you and assist you in check in the hotel. After check in the hotel our representative will introduce you to your tour guide, who will guide you around the city and the Tajmahal as well. Now you can have some break for lunch or refreshment.\r\n\r\nProceed for sightseeing:-\r\nNow after having fresh mental and physical energy, first of all your guide will take you to Tajmahal, which is the main attraction in Agra. Before going to visit Tajmahal with moonlight view, it is better to visit Tajmahal in sun light as well with the guide, so that the guide can show you and explain you all the detail properly. As the guides are not allowed inside the Tajmahal with the tourist during moonlight view. After visiting Tajmahal you will be proceeded towards Agra Fort, which is made of red sand stone and surrounded by two high walls and two moths. After visiting these two monuments you can also visit handicraft bazaars, where you will see some handcrafted souvenirs. As Agra is famous for inlaid marble souvenirs. After completing your sightseeing you can go back to your hotel. You must have an early dinner in order to see the Tajmahal at night. After your dinner your driver will take you to Tajmahal according to the time which would be mention on your pre-booked ticket. As tourist must reach Shilpgram parking half an hour before the schedule time, mentioned on the ticket for the security checking. Now you will experience its beauty in silver moonlight. After having the wonderful moonlight view of Tajmahal, Hopefully your dream what you had over the years has come true today. Over Night in Agra.', NULL, NULL, NULL, 0, '2026-01-30 02:35:23'),
(1705, 52, 2, 'Agra to Delhi (via Fatehpur Sikri)', 'After having breakfast in your hotel, you would be proceeded to Delhi via Fatehpur Sikri. Now you are leaving the city of Tajmahal and proceed to Delhi via Fatehpur Sikri which is one hour west from Agra. Fatehpur Sikri is an amazing example of Mughal architecture and reflects a fusion of Hindu, Persian and Mughal art. Buland Darwaza which is the largest gate in Asian subcontinent belongs to Fatehpur Sikri. After your lunch you will be driven straight to Delhi without any stops or hassles\'.\r\n\r\nThis is a suggested itinerary – it can be changed to fit your individual hotels room types and requirements, as we are expert in designing custom tours based on the cities and monuments you want to visit and the number of days you have within your budget and time.', NULL, NULL, NULL, 0, '2026-01-30 02:35:23'),
(1706, 48, 1, 'Arrive Delhi', 'You will be met on your arrival at Delhi International Airport and transfer to the hotel. Overnight in Delhi.', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1707, 48, 2, 'In Delhi', 'Breakfast at the hotel followed by a full day sight-seeing tour of Old and New Delhi visiting - The Red Fort, Friday Mosque -- Jama Masjid, The silver street of Chandni Chowk, Raj Ghat, The Hindu temple -- Birla Mandir, The India Gate, The Rashtrapati Bhawan -- President\'s House, Humayun\'s Tomb, Qutub Minar and The Bahai Temple. Overnight in Delhi.', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1708, 48, 3, 'Delhi - Agra (220 kms /04 hrs)', 'After breakfast, depart for Agra by road. On your arrival in Agra check into the hotel. Afternoon sight-seeing tour of Agra visiting the Taj Mahal and the Red Fort. Overnight in Agra.', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1709, 48, 4, 'Agra /Samode (275 kms /05 hrs)', 'After breakfast, depart for Samode by road en-route visiting Fatehpur Sikri. On your arrival check into the Samode Palace. The Samode Palace has been voted as one of the finest of the Rajasthan hotels. Overnight in Samode.', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1710, 48, 5, 'Samode - Jaipur - Samode', 'Breakfast at the hotel followed by a full day excursion tour of Jaipur visiting Hawa Mahal -- The Palace of Winds, The Jantar Mantar, The City Palace and the Amber Fort. The memory of the ride up the Fort on a gaily bedecked Elephant, is something that will be remembered by you as a highlight of your Rajasthan tour. Overnight in Samode.', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1711, 48, 6, 'Samode - Khimsar (330 kms / 06 hrs)', 'After breakfast, depart for Khimsar by road. On your arrival in Khimsar check-into the Khimsar Fort, another one of the fine heritage hotels in Rajasthan. Late afternoon Black buck safari followed by picnic tea on the nearby Sand Dunes. Overnight at the Khimsar Fort.', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1712, 48, 7, 'Khimsar - Jodhpur - Khimsar', 'After breakfast, excursion tour of Jodhpur visiting The Mehrangarh Fort, The Jaswant Thada and The Sardar market. Overnight in Khimsar Fort.', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1713, 48, 8, 'Khimsar - Udaipur (350 kms / 07 hrs)', 'After breakfast, depart for Udaipur by road. On your arrival in Udaipur, check-into the hotel Lake Palace, perhaps the most famous and the most photographed from among the long list of Rajasthan’s heritage hotels. Overnight in Udaipur.', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1714, 48, 9, 'In Udaipur', 'Breakfast at the hotel followed by a sightseeing tour of Udaipur visiting City Palace, Jagdish Temple and Saheliyon ki bari. Evening sunset boat cruise on Lake Pichola. A private Boat cruise on the Lake Pichola, is something that you will long remember as one of the highlights of your Rajasthan tour. Overnight in Udaipur', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1715, 48, 10, 'Udaipur - Delhi', 'After breakfast, transfer to airport intime to board flight for Delhi. Met on your arrival in Delhi and transferred to the hotel. Overnight in Delhi.', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1716, 48, 11, 'Depart Delhi', 'Check out from your hotel and transfer to Trivandrum airport intime to board your flight home.', NULL, NULL, NULL, 0, '2026-01-30 02:37:04'),
(1732, 14, 1, 'Arrival Delhi Airport', 'You will be met at the airport by one of our representatives upon arrival in Delhi, who will pick you up and give you a warm welcome. Check in at the hotel after the transfer. Enjoy a walking tour of Old Delhi local market once you\'ve had a chance to freshen yourself. We will visit Sis Ganj Sikh Temple, Jama Masjid and the spice market.\r\n \r\nOvernight stay in Delhi.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1733, 14, 2, 'Delhi - Agra', 'After breakfast, get driven to Agra. On arrival and check in, visit Agra Fort. Later, enjoy some Mughal cuisine lunch and then visit the lovely Taj Mahal. \r\n \r\nReturn back to the hotel after a long day for overnight stay.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1734, 14, 3, 'Agra -Jaipur', 'oday after breakfast we will drive to the â€˜Pink Cityâ€™- Jaipur. Enroute explore the ghost city of Fatehpur Sikri. On arrival, check into the hotel and relax. Later, head out to witness the majestic Amer Fort with a photo stop at Hawa Mahal and Jal Mahal.\r\n \r\nOvernight stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1735, 14, 4, 'aipur - Bikaner', 'oday after breakfast we will have another exciting journey towards Bikaner. After arrival and check in, explore the Junagarh Fort and Karni Mata Temple in Deshnok. \r\n \r\nReturn back to the hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1736, 14, 5, 'Bikaner - Jaisalmer', 'After having breakfast we will head off to the golden sand city of Jaisalmer. Once checked in, visit Bada Bagh at sunset. Rest of the day at leisure.\r\n \r\nOvernight stay in Jaisalmer', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1737, 14, 6, 'Jaisalmer - Khuri', 'Drive to Khuri village and check into the resort after breakfast. Enjoy a desert camel safari in Thar. Dinner served in the evening with a customary traditional dance programme.\r\n \r\nStay for the night in Khuri.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1738, 14, 7, 'Khuri - Jaisalmer', 'Get driven back to Jaisalmer after breakfast. After arrival and check in, visit the grand golden fort and revisit the history.\r\n \r\nAnother overnight stay in Jaisalmer.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1739, 14, 8, 'Jaisalmer - Jodhpur', 'Take a drive to Jodhpur after breakfast. When you get to Jodhpur, check into your hotel. Visit the Spice Market, Jaswant Thada, and Mehrangarh Fort afterwards.\r\n \r\nOvernight stay in Jodhpur.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1740, 14, 9, 'Jodhpur', 'Enjoy a full day tour in Jodhpur after breakfast. Visit Umaid Bhawan Palace and enjoy a jeep safari to Bishnoi village and learn about local culture.\r\n \r\nReturn to the hotel for overnight stay.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1741, 14, 10, 'Jodhpur - Udaipur', 'This morning after breakfast, get driven to â€˜City of Lakesâ€™- Udaipur. After check in, relax and enjoy the rest of the time as you may please.\r\n \r\nOvernight stay in Udaipur.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1742, 14, 11, 'Udaipur', 'Full day is dedicated to sightseeing after breakfast. Visit City Palace, Jagdish temple, Gem Museum, Sahelion ki Baari and enjoy a boat ride in Lake Pichola.\r\n \r\nStay for another night in Udaipur.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1743, 14, 12, 'Udaipur - Mumbai Flight', 'After breakfast, board a flight to Mumbai- the commercial capital of India. On arrival, check in and head out to seek blessings at Siddhi Vinayak temple and spend the rest of the time at Juhu Beach.\r\n \r\nOvernight stay in Mumbai', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1744, 14, 13, 'Mumbai', 'his morning a visit to Elephanta caves is planned. After breakfast, drive to witness the Gateway of India from where we will also embark on a ferry for Elephanta Island. Once you arrive, enjoy the scenic short hike and explore the ancient caves. Return to the mainland after exploration and spend the rest of the time at leisure.\r\n \r\nHotel stay in Mumbai.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1745, 14, 14, 'Bollywood Tours', 'Enjoy breakfast and Visit Bollywood the movie shooting etc \r\n \r\nStay for another night in Mumbai.', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1746, 14, 15, 'Drop Mumbai Airport', 'After breakfast driver drop to Mumbai Airport', NULL, NULL, NULL, 0, '2026-01-30 02:41:16'),
(1757, 12, 1, 'Sight Seeing of Delhi', 'Red-FortThis morning is at leisure. Enjoy a whole daylong extravaganza of visiting New Delhi and Old Delhi. Enjoy the delicious cuisine and visit magnificent monuments like Qutab Miner, Red Fort, India Gate, Jama Masjid, Rajghat Night halt in Delhi.', NULL, NULL, NULL, 0, '2026-01-30 02:43:29'),
(1758, 12, 2, 'Delhi - Agra Drive', 'Pickup from hotel and drive to Agra, check-in in the hotel and refresh after visit Agra fort & Taj Mahal and some local area walking tour â€“Night stay in Agra.', NULL, NULL, NULL, 0, '2026-01-30 02:43:29'),
(1759, 12, 3, 'Agra-Fathepur Sikri-Jaipur Drive:', 'Pick from hotel and drive to Jaipur en-route visit world heritage site fathepur sikri and after continue drive to Jaipur-night stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-30 02:43:29'),
(1760, 12, 4, 'Jaipur Tour', 'Hawa-Mahalthis morning after breakfast you visit Amber fort-Water palace-city palace-wind palace-monkey temple and some walking in bazaar-night stay in Jaipur.', NULL, NULL, NULL, 0, '2026-01-30 02:43:29'),
(1761, 12, 5, 'Jaipur-Udaipur Drive', 'Pickup from hotel and drive to Lake City Udaipur, reach around in evening and some evening tour in the city- night stay in Udaipur.', NULL, NULL, NULL, 0, '2026-01-30 02:43:29'),
(1762, 12, 6, 'Udaipur - Jodhpur Drive', 'This morning after breakfast check-out and start sight seen and visit fate Sagar Lake and city palace, Jagdish temple and after lunch drive to next city Jodhpur â€“night stay in jodhpur.', NULL, NULL, NULL, 0, '2026-01-30 02:43:29'),
(1763, 12, 7, 'Jodhpur-Jaislmer Drive', 'Breakfast and Check-out after visit Jodhpur fort and some more sight seen after lunch drive to Next city Jaislmer-night stay in Jaislmer.', NULL, NULL, NULL, 0, '2026-01-30 02:43:29'),
(1764, 12, 8, 'Jaislmer-Kuri Tour', 'This morning after breakfast check-out and sight seen in the city ,visit most famous attraction after drive to Kuri Desert. Arrive in desert and after start desert tour by camel and night stay in desert camp.', NULL, NULL, NULL, 0, '2026-01-30 02:43:29'),
(1765, 12, 9, 'Kuri-Jaislmer-Mandwa-Drive', 'Drive to heritage village Mandwa and reach in evening-night stay in Mandwa.', NULL, NULL, NULL, 0, '2026-01-30 02:43:29'),
(1766, 12, 10, 'visit Mandwa', 'Walking tour and see the many old Havali, Houses after sight seen drive to New Delhi and night stay in Delhi.', NULL, NULL, NULL, 0, '2026-01-30 02:43:29'),
(1789, 16, 1, '07:30', 'Our car will pick up you from hotel in Delhi and transfer to H Nizamuddin Railway station to board superfast air conditioned train to Agra. Our chauffer will assist you at railway station. We will E-mail you an E-ticket after booking confirmation.', NULL, NULL, NULL, 0, '2026-01-30 03:08:48'),
(1790, 16, 2, '08:10', 'Gatimaan Express ( Train No 12050 ) fully air conditioned train departs H Nizamuddin Railway Station for Agra Cantt railway station\r\n\r\n1) Breakfast included in Train fare\r\n2)Distance Travelled between Delhi & Agra by train in 1 : 40 Hrs.', NULL, NULL, NULL, 0, '2026-01-30 03:08:48'),
(1791, 16, 3, '09:50', 'Arriving Agra Cantt railway station. Your Tour Guide & Driver will receive you from Railway Station in Agra. Tour Start with drive to Taj Mahal by air conditioned car.', NULL, NULL, NULL, 0, '2026-01-30 03:08:48'),
(1792, 16, 4, '10:15', 'Taj Mahal is a cynosure of India in global tourism arena. The monument, constructed in 16th Century hold a grand history of true love and affection of 5th Mughal King Shah Jahan towards his beloved wife Mumtaj Mahal. This edifice is finest example of Indo Islamic architecture style situated on right bank of river Yamuna.', NULL, NULL, NULL, 0, '2026-01-30 03:08:48'),
(1793, 16, 5, '12:30', 'AGRA FORT After Taj Mahal drive to Agra Fort.The Fort made of red sand stone depicting glorious rule of the mighty Mughals with their lavish lifestyle. It was built in 15th century by third Mughal king Akbar. Encircled with two huge walls, this Fort has some impressive buildings like Jasmine Tower ,Khas Mahal , Diwan I Am , Diwan I Khas etc.', NULL, NULL, NULL, 0, '2026-01-30 03:08:48'),
(1794, 16, 6, '14:00', 'LUNCH BREAK You reserve right to recommend restaurant of your choice in Agra on direct payment otherwise your tour guide will take you to clean & hygenic AC Restaurant .', NULL, NULL, NULL, 0, '2026-01-30 03:08:48'),
(1795, 16, 7, '15:00', 'ITMAD - UD - DAULAH ( BABY TAJ ) After Lunch proceed to Itmad-Ud-Daulah tomb. Due to some of its resemblance with Taj Mahal.This edifice is popularly known as \'\'Baby Taj\'\'.This tomb is elaborately carved with pure marble & exhibit Indo Islamic architecture style. Empress Noor Jahan ordered this tomb in memory of her father, Mirza Ghiyas Beg in 1622.', NULL, NULL, NULL, 0, '2026-01-30 03:08:48'),
(1796, 16, 8, '16:30', 'OPTIONAL After Baby Taj you can visit handicraft gallery of Marble inlay souvenirs in Agra city. Free to explore Agra City known for exporting marble inlay handicraft.', NULL, NULL, NULL, 0, '2026-01-30 03:08:48'),
(1797, 16, 9, '17:00', 'Transfer to Railway Station to board train to Delhi..', NULL, NULL, NULL, 0, '2026-01-30 03:08:48'),
(1798, 16, 10, '17:50', 'Gatimaan Express( Train No 12049 ) departs for Delhi.. Dinner served in Train.', NULL, NULL, NULL, 0, '2026-01-30 03:08:48'),
(1799, 16, 11, '19:30', 'Arriving H Nizamuddin Railway Station. Our cab will transfer you back to your Hotel in Delhi. Tour End', NULL, NULL, NULL, 0, '2026-01-30 03:08:48');

-- --------------------------------------------------------

--
-- Table structure for table `package_pricing`
--

CREATE TABLE `package_pricing` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `pricing_type` enum('seasonal','group_size','accommodation') NOT NULL,
  `season_name` varchar(100) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `min_persons` int(11) DEFAULT NULL,
  `max_persons` int(11) DEFAULT NULL,
  `accommodation_type` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `rating` int(11) NOT NULL CHECK (`rating` between 1 and 5),
  `title` varchar(255) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `is_approved` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `id` int(11) NOT NULL,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` text DEFAULT NULL,
  `setting_group` varchar(50) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`id`, `setting_key`, `setting_value`, `setting_group`, `updated_at`) VALUES
(1, 'site_name', 'Tourist Drivers India Private Tours', 'site_info', '2025-12-31 08:45:42'),
(2, 'site_tagline', 'Your Trusted Travel Partner in India', 'site_info', '2025-12-31 08:45:42'),
(3, 'site_email', 'touristdriversindiapvttours@gmail.com', 'site_info', '2026-01-02 07:24:06'),
(4, 'site_phone', '+91 9310042916', 'site_info', '2026-01-02 07:24:06'),
(5, 'site_address', 'Plot No C 50 Ganesh Nagar Complex - New Delhi 110092', 'site_info', '2026-01-02 07:24:06'),
(6, 'meta_title', 'Best India Travel Company - Tourist Drivers India ', 'meta', '2026-01-08 11:17:32'),
(7, 'meta_description', 'Experience India with professional drivers and private tours. Book Golden Triangle, Rajasthan, Himachal tours.\r\n', 'meta', '2026-01-08 11:13:07'),
(8, 'meta_keywords', 'india tours, car rental, private driver, golden triangle, rajasthan tour', 'meta', '2025-12-31 08:45:42'),
(9, 'facebook_url', 'https://www.facebook.com/share/19FNNr2ycZ/', 'social', '2026-01-08 11:13:07'),
(10, 'instagram_url', 'https://www.instagram.com/touristdriversindiaprivatetour?utm_source=qr&igsh=Y3Y1NmVkdHJvOG5l', 'social', '2026-01-08 11:13:07'),
(11, 'twitter_url', 'https://twitter.com/', 'social', '2025-12-31 08:45:42'),
(12, 'youtube_url', 'https://youtube.com/@tourismindia557?si=2pyzrdl1suMuBlHe', 'social', '2026-01-08 11:13:07'),
(13, 'contact_email', 'contact@touristdriversindia.com', 'contact', '2025-12-31 08:45:42'),
(14, 'support_email', 'support@touristdriversindia.com', 'contact', '2025-12-31 08:45:42'),
(15, 'whatsapp_number', '+91-93100 42916', 'contact', '2026-01-02 07:24:32'),
(16, 'office_hours', 'Mon-Sat: 9:00 AM - 6:00 PM', 'contact', '2025-12-31 08:45:42');

-- --------------------------------------------------------

--
-- Table structure for table `tour_packages`
--

CREATE TABLE `tour_packages` (
  `id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `short_description` text DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `duration_days` int(11) NOT NULL,
  `duration_nights` int(11) NOT NULL,
  `base_price` decimal(10,2) NOT NULL,
  `discounted_price` decimal(10,2) DEFAULT NULL,
  `price_type` enum('per_person','per_group') DEFAULT 'per_person',
  `featured_image` varchar(255) DEFAULT NULL,
  `gallery_images` text DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `max_group_size` int(11) DEFAULT 20,
  `min_age` int(11) DEFAULT 0,
  `difficulty_level` enum('easy','moderate','challenging','difficult') DEFAULT 'easy',
  `inclusions` text DEFAULT NULL,
  `exclusions` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `meta_keywords` text DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `is_featured` tinyint(1) DEFAULT 0,
  `is_bestseller` tinyint(1) DEFAULT 0,
  `display_order` int(11) DEFAULT 0,
  `views` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tour_packages`
--

INSERT INTO `tour_packages` (`id`, `category_id`, `title`, `slug`, `short_description`, `description`, `duration_days`, `duration_nights`, `base_price`, `discounted_price`, `price_type`, `featured_image`, `gallery_images`, `video_url`, `max_group_size`, `min_age`, `difficulty_level`, `inclusions`, `exclusions`, `meta_title`, `meta_description`, `meta_keywords`, `is_active`, `is_featured`, `is_bestseller`, `display_order`, `views`, `created_at`, `updated_at`) VALUES
(1, 1, 'Golden Triangle with Pushkar Tour', 'golden-triangle-with-pushkar-tour', 'Experience the rich heritage of India’s Golden Triangle and the cultural charm of Pushkar in one captivating tour — ideal for couples, families, and culture seekers.', 'Embark on an unforgettable journey through India’s iconic Golden Triangle — a fascinating loop of historical and cultural landmarks that weave together the past and present in a rich tapestry of experiences. Starting in the vibrant capital of Delhi, you\'ll explore the majestic monuments and bustling markets, where old-world charm blends seamlessly with modern energy. From there, journey to Agra, home to the breathtaking Taj Mahal, one of the world’s most recognized symbols of love and an architectural marvel. In Jaipur, the “Pink City,” you’ll be immersed in royal palaces, opulent forts, and colorful bazaars, each telling the story of Rajasthan’s rich history and heritage.\r\n\r\nBut the adventure doesn’t end there — venture into the serene desert town of Pushkar, where the mystical allure of its sacred lake and temples beckon. Pushkar is an oasis of calm amidst the vast Thar Desert, famous for its annual camel fair and its deep spiritual significance. The town offers a unique blend of culture, religion, and natural beauty, with winding streets lined with vibrant bazaars, ancient ghats, and peaceful temples. Here, you\'ll have the chance to experience the soul-stirring atmosphere of one of India’s oldest pilgrimage sites, where tradition and spirituality come together in perfect harmony.\r\n\r\nThis carefully curated tour is designed for couples, families, and culture seekers alike. Whether you\'re a history enthusiast eager to explore India’s past, a family looking for a memorable adventure, or a couple in search of romance and tranquility, this journey through the Golden Triangle and Pushkar offers something for everyone. Experience the diverse colors, sounds, and flavors of India, where each moment promises to be a treasure trove of memories.', 7, 6, '0.00', NULL, 'per_person', '6954d4cde5ea6_1767167181.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Golden Triangle with Pushkar Tour Package | Delhi Agra Jaipur', 'Experience the rich heritage of India’s Golden Triangle and the cultural charm of Pushkar in one captivating tour — ideal for couples, families, and culture seekers.\' eksa ek long discription dena', '', 1, 0, 0, 0, 60, '2025-12-31 07:46:21', '2026-01-28 21:23:42'),
(2, 2, 'Delhi Shimla Manali Delhi Tour Package 6 Days', 'delhi-shimla-manali-delhi-tour-package-6-days', '', 'Experience the beauty of Himachal Pradesh with our Manali Shimla Tour. Explore the snow-capped mountains, lush valleys, and charming colonial architecture. Begin your journey in Shimla, known for its scenic Mall Road, Jakhoo Temple, and historic landmarks. Continue to Manali, where you can visit Solang Valley, Rohtang Pass, and Hadimba Temple, and enjoy thrilling adventures like paragliding and river rafting. Perfect for couples, families, and nature lovers, this tour offers a perfect blend of relaxation and excitement amidst the serene Himalayan landscapes. Book now for an unforgettable mountain getaway.', 5, 6, '0.00', NULL, 'per_person', '6954e8e097266_1767172320.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Delhi Shimla Manali Delhi Tour Package 6 Days', '', '', 1, 1, 0, 0, 64, '2025-12-31 08:52:23', '2026-01-29 02:52:40'),
(4, 2, 'Shimla kasauli tour package', 'shimla-kasauli-tour-package', 'A scenic Himachal tour combining the charming hill stations of Shimla and Kasauli.', 'Experience the beauty of the Himalayas with our 5-day Shimla Tour. Begin your journey from Delhi and enjoy a scenic drive to Shimla, the Queen of Hills. Explore popular attractions like The Ridge, Mall Road, Jakhoo Temple, Kufri, and Chail. Breathe in the fresh mountain air, take in stunning views of snow-capped peaks, and relax in peaceful surroundings. Perfect for families, couples, and nature lovers, this tour offers a blend of sightseeing, leisure, and adventure. Create unforgettable memories with this charming escape to Shimlaï¿½s serene landscapes.', 5, 4, '0.00', NULL, 'per_person', '695f425a6a2fd_1767850586.png', NULL, NULL, 20, 0, 'easy', '', '', 'Shimla Kasauli Tour Package | Himachal Hill Station Holiday', 'Enjoy a refreshing hill station getaway with the Shimla Kasauli Tour Package. Explore the scenic beauty, cool mountain climate, colonial charm and peaceful landscapes of Himachal’s most popular destinations with comfortable travel arrangements and guided sightseeing.', 'Shimla Kasauli tour, Himachal hill station tour, Shimla Kasauli package, hill station holiday, India mountain tour', 1, 0, 0, 0, 62, '2025-12-31 08:53:49', '2026-01-28 16:12:20'),
(5, 2, 'Delhi Manali Delhi Tour Package 5 Days', 'delhi-manali-delhi-tour-package-5-days', '', 'Embark on a mesmerizing 5-day Manali tour and experience the breathtaking beauty of Himachal Pradesh. Begin your journey from Delhi to Manali, driving through scenic valleys and mountains. Enjoy local sightseeing at Hadimba Devi Temple, Vashisht Kund, and Manu Temple. Experience the thrill of adventure at Solang Valley with activities like paragliding and skiing. Explore the enchanting Rohtang Pass (subject to availability) and capture the snow-covered charm. Indulge in shopping at the vibrant Mall Road and enjoy cozy evenings in the hills. A perfect getaway for nature lovers and thrill-seekers.', 5, 4, '0.00', NULL, 'per_person', '6954eacd5c217_1767172813.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Delhi Manali Delhi Tour Package 5 Days  | Shimla Manali Road Trip | Delhi Manali tour package,', '', 'Delhi Manali tour package, Manali tour from Delhi, Himachal road trip, Shimla Manali package, 5 days Himachal tour', 1, 0, 0, 0, 40, '2025-12-31 08:53:50', '2026-01-28 15:26:38'),
(6, 5, 'Chardham Yatra Package from Delhi', 'chardham-yatra-package-from-delhi', 'Chardham Yatra from Delhi Badrinath Kedarnath Yamunotri Gangotri Package', 'Chardham Yatra Tours is a sacred pilgrimage journey covering the four holy shrines of Yamunotri, Gangotri, Kedarnath, and Badrinath nestled in the majestic Himalayas. This spiritually enriching tour offers a perfect blend of devotion, adventure, and natural beauty. Pilgrims embark on a divine path through serene rivers, ancient temples, and breathtaking landscapes. From the holy Ganga Aarti in Haridwar to the tranquil vibes of Badrinath and Kedarnath, every step of this journey brings peace to the soul. Chardham Yatra is not just a tripï¿½it\'s a transformative experience that renews your spirit and deepens your connection with the divine.', 12, 11, '72000.00', NULL, 'per_person', '6954ea754355e_1767172725.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Chardham Yatra Package from Delhi', '', '', 1, 0, 0, 0, 37, '2025-12-31 08:53:50', '2026-01-29 03:25:42'),
(7, 5, 'Varanasi Prayagraj Ayodhya Package', 'varanasi-prayagraj-ayodhya-package', '', 'Explore the spiritual heart of India with our Varanasi, Prayagraj, and Ayodhya tour package. Begin your journey in Varanasi, the city of temples and ghats, where you can witness the mesmerizing Ganga Aarti. Next, visit Prayagraj, known for the sacred Triveni Sangam, where the Ganga, Yamuna, and Saraswati rivers meet. Conclude your pilgrimage in Ayodhya, the birthplace of Lord Rama, and visit the grand Ram Janmabhoomi temple. This thoughtfully curated package offers comfortable travel, guided tours, and spiritual experiences that connect you to Indiaï¿½s divine heritage. Book now for a soulful journey through these sacred cities.', 6, 5, '0.00', NULL, 'per_person', '6954ec05dedb5_1767173125.webp', NULL, NULL, 20, 0, 'easy', '', '', 'Varanasi Prayagraj Ayodhya Package', '', '', 1, 0, 0, 0, 34, '2025-12-31 08:53:51', '2026-01-28 17:40:47'),
(8, 5, 'Delhi Haridwer Rishikesh Delhi 5 Days Package', 'delhi-haridwer-rishikesh-delhi-5-days-package', '', 'According to astrologers, the â€˜Kumbh Fairâ€™ takes place when the planet Jupiter enters Aquarius and the Sun enters Aries. According to mythology, â€˜Devasâ€™ (Gods) and â€˜Asurasâ€™ (Demons) churned the ocean to obtain Nectar and when the coveted â€˜Kumbhaâ€™ (pitcher) of Nectar (Amrita) which gave immortality was obtained from the depths of ocean, one of the â€˜Devasâ€™ whisked away the â€˜Kumbhaâ€™ from the â€˜Asurasâ€™ and evading from the â€˜Asurasâ€™, stopped at four places viz. Haridwar, Allahabad (Prayag), Nasik and Ujjain before he finally arrived into the safety of heaven. A few drops of Nectar are supposed to have spilled over on the water at these four places and sages, saints and pilgrims started periodically to flock to each of these â€˜Tirthasâ€™ to celebrate the divine event. In fact , it is a unique event that blends religious and social features alike', 5, 4, '0.00', NULL, 'per_person', '6954ebb0f3692_1767173040.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Delhi Haridwer Rishikesh Delhi 5 Days Package', '', '', 1, 0, 0, 0, 34, '2025-12-31 08:53:51', '2026-01-29 04:25:16'),
(9, 5, 'Buddha Tours Package India', 'buddha-tours-package-india', 'A spiritual 11-day Buddhist circuit tour covering India’s key pilgrimage destinations.', 'Buddhism is based on the wisdom of Siddhartha Gautam borne like a prince of kapilavastu situated in Lumbini, Nepal. Gautam Buddha attained illumination sitting under the tree of Pipal.\r\n\r\nThis Buddhist tour will get you to the lots of significant Buddhist sites of India and we submit this tour the same as footsteps of Buddha. The major sites to be visiting through this tour are Bodhgaya, Patna, Kushinagar, Balrampur and Lumbini', 11, 10, '0.00', NULL, 'per_person', '6954eb6a807c4_1767172970.webp', NULL, NULL, 20, 0, 'easy', '', '', 'Buddha Tours Package India | Buddhist Trails 10 Nights 11 Days Tour | Buddhist Circuit India', 'Explore India’s sacred Buddhist Trails on this 10 Nights 11 Days tour covering major sites like Bodh Gaya, Sarnath, Kushinagar, Rajgir, Nalanda and Varanasi with cultural experiences, spiritual visits and comfortable travel.', 'Buddhist Trails tour, Buddhist circuit India, Bodh Gaya Sarnath Kushinagar, Buddhist pilgrimage tour, India spiritual tour', 1, 0, 0, 0, 40, '2025-12-31 08:53:51', '2026-01-28 10:18:50'),
(10, 3, '15 Days Rajasthan Tour Package', '15-days-rajasthan-tour-package', '', 'Embark on an unforgettable journey through the majestic land of Rajasthan with our 15 Days Rajasthan Tour Package. Explore the vibrant culture, royal palaces, historic forts, desert landscapes, and colorful markets across the state. This tour is a perfect blend of heritage, adventure, and relaxation, covering iconic cities such as Jaipur, Udaipur, Jodhpur, Jaisalmer, Bikaner, and more. Whether you\'re a history enthusiast, culture lover, or photography buff, this package offers the best of Rajasthan in two weeks.', 15, 14, '0.00', NULL, 'per_person', '6954eb293bb5f_1767172905.jpg', NULL, NULL, 20, 0, 'easy', '', '', '15 Days Rajasthan Tour Package', '', '', 1, 0, 0, 0, 76, '2025-12-31 08:53:51', '2026-01-28 21:57:40'),
(11, 3, '12 Days Rajasthan  Private Tours', '12-days-rajasthan-private-tours', '', 'Uncover the royal legacy of Rajasthan in 12 unforgettable days filled with historic forts, royal palaces, desert adventures, and spiritual journeys. This thoughtfully curated tour offers the perfect blend of cultural richness, scenic beauty, and local experiences across iconic destinations like Jaipur, Udaipur, Jodhpur, Jaisalmer, and more. Ideal for families, couples, and culture lovers, this journey captures the true spirit of Rajasthan in less than two weeks.', 12, 11, '0.00', NULL, 'per_person', '6954ec44292b1_1767173188.jpg', NULL, NULL, 20, 0, 'easy', '', '', '12 Days Rajasthan  Private Tours', '', '', 1, 0, 0, 0, 38, '2025-12-31 08:53:52', '2026-01-29 00:47:34'),
(12, 3, '10 Days Rajasthan Private Tours', '10-days-rajasthan-private-tours', 'Experience the majestic charm of Rajasthan in just 10 days with this carefully crafted tour that takes you through the land of kings, forts, and desert wonders.', 'Experience the majestic charm of Rajasthan in just 10 days with this carefully crafted tour that takes you through the land of kings, forts, and desert wonders. From the royal palaces of Jaipur to the golden sands of Jaisalmer, the blue houses of Jodhpur, and the serene lakes of Udaipur. every city tells a tale of its glorious past and vibrant culture. Ideal for those looking to explore the highlights of Rajasthan within a limited time, this tour offers history, heritage, adventure, and unforgettable local experiences.', 10, 9, '45000.00', NULL, 'per_person', '6954ecbeb420a_1767173310.jpg', NULL, NULL, 20, 0, 'easy', '', '', '10 Days Rajasthan Private Tours', 'Rajasthan 10 Days Package by Car and Drivers from Delhi and Mumbai', 'Rajastha 10 Days Package - Rajasthan Tour by Car and Driver', 1, 1, 0, 0, 38, '2025-12-31 08:53:53', '2026-01-30 02:43:20'),
(13, 3, '15 to 18 Days-Rajasthan-Varanasi -Tajmahal Tour Package', '15-to-18-days-rajasthan-varanasi-tajmahal-tour-package', 'A rich cultural tour combining Rajasthan’s royal cities and Varanasi’s spiritual experiences.', 'Experience the royal heritage of Rajasthan and the spiritual charm of Varanasi with this inclusive tour. Explore iconic destinations like Delhi, Agra, Jaipur, Udaipur, Jodhpur and witness the sacred Ganga Aarti in Varanasi. Comfortable travel with cultural sightseeing and memorable experiences.', 18, 0, '0.00', NULL, 'per_person', '6954ec7c55eda_1767173244.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Rajasthan with Varanasi Tour | Delhi Agra Jaipur Udaipur Varanasi Package', '', 'Rajasthan tour, Varanasi tour package, Delhi Agra Jaipur Udaipur Jodhpur Varanasi, Rajasthan Varanasi holiday, India heritage tour', 1, 1, 0, 0, 62, '2025-12-31 08:53:53', '2026-01-29 23:24:31'),
(14, 3, 'Delhi Agra Rajasthan & Mumbai Tours', 'delhi-agra-rajasthan-mumbai-tours', '', 'A tour combining Delhi, Agra, Rajasthan (Jaipur, Jaisalmer, Udaipur), and Mumbai offers a diverse experience of India\'s history, culture, and modernity. You can explore historical sites like the Taj Mahal and Red Fort, enjoy vibrant bazaars and palaces, and experience the energy of Mumbai\'s urban landscape', 20, 19, '65000.00', NULL, 'per_person', '6954ee259746a_1767173669.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Delhi Agra Rajasthan & Mumbai Tours', 'Rajasthan Tour Package from Mumbai to Delhi by Road Car and drivers Package', 'Rajasthan Tour Package from Mumbai - Mumbai to Delhi Rajastha Tours', 1, 0, 0, 0, 43, '2025-12-31 08:53:54', '2026-01-30 02:41:10'),
(15, 4, 'Tajmahal Sunrise Tours', 'tajmahal-sunrise-tours', 'Tajmahal sunrise tour Tajmahal overnight tour', 'The Taj Mahal Sunrise Tour is a magical journey that lets you witness the iconic monument in the soft glow of early morning light. As the sun rises, the white marble of the Taj Mahal shimmers with golden hues, offering a serene and unforgettable view. This early visit allows you to avoid large crowds and enjoy the peaceful ambiance of one of the world\'s most beautiful architectural wonders.', 1, 0, '5500.00', NULL, 'per_person', '6954ed614402f_1767173473.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Tajmahal Sunrise Tours', '', 'Tajmahal Sunrise Tour Tajmahal Tour', 1, 0, 0, 0, 54, '2025-12-31 08:53:54', '2026-01-28 13:17:17'),
(16, 4, 'Tajmahal Tour by Train - Tajmahal Tour by Gatimaan Express', 'tajmahal-tour-by-train-tajmahal-tour-by-gatimaan-express', 'Gatimaan Express from Delhi to Agra Tajmahal Tickets Delhi to Tajmahal by train tours', 'The Taj Mahal Tour by Train via Gatimaan Express offers a fast, comfortable, and convenient way to explore the beauty of Agra in a single day. Departing from Delhi, the Gatimaan Express is India\'s fastest train, reaching Agra in just 100 minutes. Upon arrival, you\'ll be taken to the majestic Taj Mahal to witness its stunning architecture and learn about its rich history. The tour often includes visits to other iconic sites such as Agra Fort and Mehtab Bagh. With guided support, smooth transfers, and same-day return, this tour is perfect for travelers seeking a hassle-free and memorable experience.', 1, 0, '8500.00', NULL, 'per_person', '6954eeb473975_1767173812.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Tajamhal Tour by Train Tajmahal Tour', 'Delhi to Agra by train tours Gatimaan Express from Delhi to Tajmahal', 'Gatimaan Train to Tajmahal Package - Train To Tajmahal', 1, 1, 0, 0, 52, '2025-12-31 08:53:55', '2026-01-30 04:24:48'),
(17, 4, 'Tajmahal Tour with Varanasi', 'tajmahal-tour-with-varanasi', '', 'The Taj Mahal Tour with Varanasi combines the grandeur of Mughal architecture with the spiritual essence of India. Begin your journey in Agra with a visit to the iconic Taj Mahal, a timeless symbol of love and architectural brilliance. Then travel to Varanasi, one of the world\'s oldest living cities, to experience the sacred Ganga Aarti, explore ancient temples, and take a serene boat ride on the Ganges. This tour offers a perfect blend of history, culture, and spirituality, giving you an unforgettable glimpse into India\'s rich and diverse heritage.', 9, 8, '35000.00', NULL, 'per_person', '6954ee676fcb8_1767173735.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Tajmahal Tour with Varanasi', '', 'Tajmahal Tour Varanasi Tour Golden Trinagle with Varanasi', 1, 0, 0, 0, 39, '2025-12-31 08:53:55', '2026-01-30 03:09:00'),
(18, 1, 'Golden Triangle with Jaipur  Tour', 'golden-triangle-with-jaipur-tour', 'A classic Golden Triangle tour covering Delhi, Agra and Jaipur’s top heritage attractions.', 'Experience India’s iconic Golden Triangle with the Delhi Agra Jaipur Tour. Visit the majestic Taj Mahal, Agra Fort, Amber Fort, and City Palace while enjoying a culturally rich journey with comfortable transfers and professional service.', 5, 4, '0.00', NULL, 'per_person', '695f4215f012a_1767850517.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Golden Triangle with Jaipur  Tour |  Delhi Agra Jaipur Tour | 4 Nights/ 5 Days  Golden Triangle Tour', 'Experience India’s iconic Golden Triangle with the Delhi Agra Jaipur Tour. Visit the majestic Taj Mahal, Agra Fort, Amber Fort, and City Palace while enjoying a culturally rich journey with comfortable transfers and professional service.', 'Delhi Agra Jaipur tour, Golden Triangle package, Taj Mahal tour, Agra Jaipur Delhi sightseeing, India heritage tour', 1, 0, 0, 0, 110, '2025-12-31 08:53:56', '2026-01-29 01:14:28'),
(38, 1, 'Golden Triangle Tours 4 Days', 'golden-triangle-tours-4-days', 'Explore Delhi, Agra & Jaipur on a 4-day Golden Triangle tour featuring the iconic Taj Mahal and royal heritage sites.', 'Embark on a captivating journey through India\'s iconic Golden Triangle in just 4 days. This tour covers the historic cities of Delhi, Agra, and Jaipur, offering a perfect blend of culture, heritage, and architecture.', 4, 3, '0.00', NULL, 'per_person', '695f41e825ed9_1767850472.jpg', NULL, NULL, 20, 0, 'easy', '', '', '4 Days Golden Triangle Tour with Taj Mahal , Delhi Agra Jaipur Golden Triangle Tour – 4 Days', '4 Days Golden Triangle Tour with Taj Mahal , Delhi Agra Jaipur Golden Triangle Tour – 4 Days', '4 Days Golden Triangle Tour with Taj Mahal , Delhi Agra Jaipur Golden Triangle Tour – 4 Days', 1, 0, 0, 0, 48, '2026-01-03 06:59:22', '2026-01-29 00:47:33'),
(39, 1, 'Golden Triangle Tour with Udaipur', 'golden-triangle-tour-with-udaipur', 'A 6–8 day Golden Triangle tour that blends the heritage of Delhi, Agra & Jaipur with the lake city charm of Udaipur.', 'Explore India’s Golden Triangle with this 6–8 day package covering Delhi, Agra, Jaipur and beautiful Udaipur. Visit iconic landmarks like the Taj Mahal, Agra Fort, Amber Fort, City Palace and enjoy the scenic lakes and palaces of Udaipur.', 8, 7, '0.00', NULL, 'per_person', '695f419773cb6_1767850391.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Golden Triangle tour, Udaipur tour package, Delhi Agra Jaipur Udaipur, India Golden Triangle, Udaipur travel', '', 'Golden Triangle tour, Udaipur tour package, Delhi Agra Jaipur Udaipur, India Golden Triangle, Udaipur travel', 1, 0, 0, 0, 41, '2026-01-03 07:14:30', '2026-01-28 15:32:57'),
(40, 1, 'Golden Triangle Tour with Ranthambore', 'golden-triangle-tour-with-ranthambore', 'A heritage and wildlife adventure combining the Golden Triangle with an exciting Ranthambore safari.', 'Explore the best of India’s Golden Triangle with this exciting tour to Delhi, Agra, Jaipur and Ranthambore. Visit iconic sites like the Taj Mahal, Agra Fort, Amber Fort, and enjoy thrilling wildlife safari at Ranthambore National Park.', 7, 6, '0.00', NULL, 'per_person', '695f413d91d6d_1767850301.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Golden Triangle with Ranthambore Tour | Delhi Agra Jaipur Ranthambore Package | Ranthambore, Tour Package', 'Explore the best of India’s Golden Triangle with this exciting tour to Delhi, Agra, Jaipur and Ranthambore. Visit iconic sites like the Taj Mahal, Agra Fort, Amber Fort, and enjoy thrilling wildlife safari at Ranthambore National Park.', 'Golden Triangle tour, Ranthambore safari, Delhi Agra Jaipur Ranthambore, Taj Mahal tour package, India wildlife tour', 1, 1, 0, 0, 47, '2026-01-03 07:35:02', '2026-01-28 18:04:26'),
(41, 1, 'Golden Triangle Tour with Varanasi and Khajuraho', 'golden-triangle-tour-with-varanasi-and-khajuraho', 'A cultural and spiritual tour combining Golden Triangle highlights with Varanasi’s ghats and Khajuraho’s ancient temples.', 'Experience the perfect blend of India’s iconic Golden Triangle — Delhi, Agra & Jaipur — with the spiritual vibes of Varanasi and the ancient temple art of Khajuraho. Visit world-famous landmarks like the Taj Mahal, enjoy sunrise at the Ganges, and explore UNESCO-listed temples in Khajuraho.', 11, 10, '0.00', NULL, 'per_person', '695ce4c242a39_1767695554.webp', NULL, NULL, 20, 0, 'easy', '', '', 'Golden Triangle with Varanasi & Khajuraho Tour | Delhi Agra Jaipur Varanasi Khajuraho| Delhi Agra Jaipur Varanasi Khajuraho', 'Experience the perfect blend of India’s iconic Golden Triangle — Delhi, Agra & Jaipur — with the spiritual vibes of Varanasi and the ancient temple art of Khajuraho. Visit world-famous landmarks like the Taj Mahal, enjoy sunrise at the Ganges, and explore UNESCO-listed temples in Khajuraho.', 'Golden Triangle tour, Varanasi tour package, Khajuraho tour, Delhi Agra Jaipur Varanasi Khajuraho, India heritage tour', 1, 0, 0, 0, 43, '2026-01-03 07:42:35', '2026-01-28 15:46:00'),
(42, 1, 'Golden Triangle Tour with Varanasi', 'golden-triangle-tour-with-varanasi', 'A heritage and spiritual tour combining Golden Triangle highlights with the sacred city of Varanasi.', 'Experience the best of India’s heritage on this Golden Triangle Tour with Varanasi. Visit iconic sites like the Taj Mahal, Agra Fort, Amber Fort and enjoy spiritual vibes with a Ganga Aarti and river boat ride in Varanasi.', 9, 8, '22700.00', NULL, 'per_person', '695ce48bd390a_1767695499.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Golden Triangle Tour with Varanasi | Delhi Agra Jaipur Varanasi Package | Varanasi tour package', 'Experience the best of India’s heritage on this Golden Triangle Tour with Varanasi. Visit iconic sites like the Taj Mahal, Agra Fort, Amber Fort and enjoy spiritual vibes with a Ganga Aarti and river boat ride in Varanasi.', 'Golden Triangle tour, Varanasi tour package, Delhi Agra Jaipur Varanasi, Taj Mahal tour, India cultural tour', 1, 0, 0, 0, 40, '2026-01-03 07:57:53', '2026-01-28 21:57:40'),
(43, 1, 'Golden Triangle with kashmir', 'golden-triangle-with-kashmir', 'An unforgettable 8-day tour blending Golden Triangle heritage with the scenic wonders of Kashmir.', 'Explore the best of Northern India with our 8D7N Delhi Kashmir Jaipur Agra Tour. Visit iconic landmarks like the Taj Mahal, Agra Fort, Amber Fort, and experience the scenic beauty of Kashmir including Dal Lake, Gulmarg and Pahalgam.', 8, 7, '0.00', NULL, 'per_person', '695ce4572f095_1767695447.webp', NULL, NULL, 20, 0, 'easy', '', '', '8D7N Delhi Kashmir Jaipur Agra Tour | Golden Triangle & Kashmir Package | Golden Triangle tour', 'Explore the best of Northern India with our 8D7N Delhi Kashmir Jaipur Agra Tour. Visit iconic landmarks like the Taj Mahal, Agra Fort, Amber Fort, and experience the scenic beauty of Kashmir including Dal Lake, Gulmarg and Pahalgam.', 'Delhi Kashmir tour, Golden Triangle tour, Kashmir holiday package, Delhi Agra Jaipur Kashmir, 8D7N India tour', 1, 1, 0, 0, 58, '2026-01-03 08:05:17', '2026-01-29 13:06:25'),
(44, 1, 'Golden Triangle with Khajuraho Tour', 'golden-triangle-with-khajuraho-tour', 'Golden Triangle tour, Khajuraho tour, Delhi Agra Jaipur Khajuraho, India heritage tour, Golden Triangle package', 'Embark on a captivating Golden Triangle with Khajuraho Tour covering Delhi, Agra and Jaipur’s iconic sites, combined with the magnificent temple art and heritage of UNESCO-listed Khajuraho Group of Monuments. This culturally rich itinerary blends history, architecture and spiritual experiences.', 6, 5, '0.00', NULL, 'per_person', '695ce4332c3e5_1767695411.webp', NULL, NULL, 20, 0, 'easy', '', '', 'Golden Triangle with Khajuraho Tour | Delhi Agra Jaipur Khajuraho Package |  5 Night 6 Days Khajuraho tour', 'Embark on a captivating Golden Triangle with Khajuraho Tour covering Delhi, Agra and Jaipur’s iconic sites, combined with the magnificent temple art and heritage of UNESCO-listed Khajuraho Group of Monuments. This culturally rich itinerary blends history, architecture and spiritual experiences.', 'Golden Triangle tour, Khajuraho tour, Delhi Agra Jaipur Khajuraho, India heritage tour, Golden Triangle package', 1, 0, 0, 0, 43, '2026-01-03 08:35:38', '2026-01-28 10:26:50'),
(45, 1, 'Golden Triangle with Kerala Tours', 'golden-triangle-with-kerala-tours', 'A scenic and heritage tour blending the Golden Triangle with Kerala’s backwaters and landscapes.', 'Explore India’s Golden Triangle destinations — Delhi, Agra & Jaipur — and extend your journey to the serene backwaters, lush hill stations and beaches of Kerala. Enjoy heritage monuments, scenic landscapes and cultural experiences in one complete holiday package.', 15, 14, '0.00', NULL, 'per_person', '695ce38eb471a_1767695246.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Golden Triangle with Kerala Tour | Delhi Agra Jaipur Kerala Package | Kerala tour package', '', 'Golden Triangle tour, Kerala tour package, Delhi Agra Jaipur Kerala, India backwater tour, Golden Triangle with Kerala', 1, 0, 0, 0, 44, '2026-01-03 08:42:07', '2026-01-28 16:08:21'),
(46, 1, 'Golden Triangle Tour with Pushkar', 'golden-triangle-tour-with-pushkar', 'A heritage and spiritual Golden Triangle tour that includes the sacred town of Pushkar.', 'Enjoy a heritage journey through Delhi, Agra and Jaipur and continue to the holy town of Pushkar. Visit the Taj Mahal, historic forts, palaces and sacred temples, and experience local culture and spiritual vibes in Pushkar.', 7, 6, '18500.00', NULL, 'per_person', '695ce2fe3cbc4_1767695102.webp', NULL, NULL, 20, 0, 'easy', '', '', 'Golden Triangle Tour with Pushkar | Delhi Agra Jaipur Pushkar Package | Pushkar tour package,', '', 'Golden Triangle tour, Pushkar tour package, Delhi Agra Jaipur Pushkar, India heritage tour, Pushkar pilgrimage', 1, 0, 0, 0, 37, '2026-01-03 08:52:26', '2026-01-29 10:06:45'),
(47, 4, 'Taj Mahal with Khajuraho', 'taj-mahal-with-khajuraho', 'A cultural heritage tour blending the Golden Triangle with the artistic marvels of Khajuraho.', 'Experience India’s iconic Golden Triangle highlights — Delhi, Agra & Jaipur — combined with the ancient temple art and UNESCO heritage of Khajuraho. Visit the Taj Mahal, historic forts and sculpted temples for a cultural exploration.', 8, 7, '0.00', NULL, 'per_person', '695ce2d693fcd_1767695062.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Taj Mahal Tour with Khajuraho | 9 Days Delhi Agra Jaipur Khajuraho Package | Khajuraho tour', '', 'Khajuraho tour Taj Mahal tour, Khajuraho tour, Golden Triangle Khajuraho, Delhi Agra Jaipur Khajuraho, India heritage tour', 1, 1, 0, 0, 42, '2026-01-03 09:19:34', '2026-01-28 12:31:38'),
(48, 4, 'Taj Mahal Tour with Rajasthan', 'taj-mahal-tour-with-rajasthan', 'A complete Northern India tour combining the Taj Mahal with Rajasthan’s royal heritage.', 'Explore the majestic Taj Mahal and Golden Triangle cities along with the royal heritage of Rajasthan. Visit Delhi, Agra, Jaipur, Udaipur and Jodhpur to witness forts, palaces, lakes and city culture in one complete journey.', 11, 10, '22500.00', NULL, 'per_person', '695ce26123d1a_1767694945.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Taj Mahal Tour with Rajasthan | 10 Days Delhi Agra Jaipur Udaipur Jodhpur Package | Rajasthan tour,', 'Rajasthan 10 days package from Delhi airport to airport', 'Taj Mahal tour, Rajasthan tour, Delhi Agra Jaipur Udaipur Jodhpur, Golden Triangle Rajasthan, India heritage tour', 1, 0, 0, 0, 44, '2026-01-03 09:24:50', '2026-01-30 02:37:04'),
(49, 4, 'Taj Mahal Tour with Shimla Manali', 'taj-mahal-tour-with-shimla-manali', 'A scenic tour joining the Golden Triangle with the hill stations of Shimla and Manali.', 'Combine heritage and hill station beauty with this unique tour exploring Delhi, Agra, Jaipur and the cool mountain retreats of Shimla and Manali. Enjoy monuments, scenic valleys and adventure in one memorable trip.', 7, 6, '0.00', NULL, 'per_person', '695ce1617f4fc_1767694689.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Taj Mahal Tour with Shimla Manali | 8–10 Days Delhi Agra Jaipur Shimla Manali Package | Shimla Manali tour', '', 'Taj Mahal tour, Shimla Manali tour, Golden Triangle Shimla Manali, Delhi Agra Jaipur hills, India scenic tour', 1, 1, 0, 0, 47, '2026-01-03 09:30:40', '2026-01-29 03:00:41'),
(50, 4, 'Taj Mahal Tour with Kerala', 'taj-mahal-tour-with-kerala', 'A heritage and nature holiday combining the Golden Triangle with Kerala’s backwaters and landscapes.', 'Explore India’s iconic Golden Triangle destinations and then relax in Kerala’s serene backwaters, tea gardens and beaches. From historical forts to tropical landscapes, this tour blends heritage and nature experiences.', 18, 17, '0.00', NULL, 'per_person', '695ce11615ed0_1767694614.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Taj Mahal Tour with Kerala | 10–12 Days Delhi Agra Jaipur Kerala Holiday Package |  Kerala tour package,', '', 'Taj Mahal tour, Kerala tour package, Golden Triangle Kerala, Delhi Agra Jaipur Kerala, India backwater holiday', 1, 0, 0, 0, 38, '2026-01-03 09:36:46', '2026-01-29 10:06:53'),
(51, 4, 'Taj Mahal Tour with Jaipur', 'taj-mahal-tour-with-jaipur', 'A 3-day heritage tour featuring the Taj Mahal, Agra Fort and Jaipur’s royal palaces.', 'Experience the perfect short getaway with this Taj Mahal Tour with Jaipur package. Visit the iconic Taj Mahal and Agra Fort, explore the historic forts and palaces of Jaipur, and enjoy key attractions of Delhi in a memorable 3-day heritage trip.', 3, 2, '12500.00', NULL, 'per_person', '695ce0e83545a_1767694568.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Taj Mahal Tour with Jaipur | 3 Days Agra Jaipur Delhi Package | Jaipur tour package', '', 'Taj Mahal tour, Jaipur tour package, Agra Jaipur Delhi trip, Taj Mahal Jaipur tour, India heritage tour', 1, 0, 0, 0, 50, '2026-01-03 09:41:23', '2026-01-28 13:06:11'),
(52, 4, 'Taj Mahal Moon Tour', 'taj-mahal-moon-tour', 'A special night visit tour of the Taj Mahal under the moonlit sky.', 'Experience the magical beauty of the Taj Mahal under the moonlight on this exclusive Taj Mahal Moon Tour. Enjoy a night visit at the Taj, serene ambiance, and a unique romantic experience perfect for couples and culture seekers.', 2, 1, '8500.00', NULL, 'per_person', '695ce0b4ea7b1_1767694516.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Taj Mahal Moon Tour | Agra Night Visit & Taj Mahal Experience | Agra tour package', '', 'Taj Mahal Moon Tour, Taj Mahal night visit, Agra moonlight tour, Taj Mahal experience, Agra tour package', 1, 0, 0, 0, 48, '2026-01-03 09:51:48', '2026-01-30 02:35:18'),
(53, 3, '8 Days Agra Ranthambore Jaipur Customized Tours', '8-days-agra-ranthambore-jaipur-customized-tours', 'A heritage and wildlife tour combining the agra jaipur with an exciting Ranthambore safari.', 'Experience India’s heritage and wildlife on this Golden Triangle and Ranthambore Tour. Visit the iconic Taj Mahal, Agra Fort, Amber Fort, Jaipur attractions, and enjoy thrilling safari adventures in Ranthambore National Park.', 8, 7, '25000.00', NULL, 'per_person', '695cde968601e_1767693974.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Golden Triangle and Ranthambore Tour | Delhi Agra Jaipur Ranthambore Package | Ranthambore safari,', '', 'Golden Triangle tour, Ranthambore safari, Delhi Agra Jaipur Ranthambore, Golden Triangle Ranthambore package, India wildlife tour', 1, 0, 0, 0, 44, '2026-01-03 09:57:14', '2026-01-29 08:40:48'),
(54, 3, 'Rajasthan Varanasi Tour', 'rajasthan-varanasi-tour', 'A cultural and spiritual journey through Rajasthan’s royal cities and Varanasi’s sacred ghats.', 'Discover the vibrant culture and heritage of Rajasthan combined with the spiritual charm of Varanasi. This tour covers Delhi, Agra, Jaipur, Udaipur, Jodhpur and concludes with the sacred experiences of Varanasi’s Ganga Aarti and river cruise.', 19, 18, '55000.00', NULL, 'per_person', '695cddc5eaf35_1767693765.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Rajasthan and Varanasi Tour | Delhi Jaipur Agra Udaipur Jodhpur Varanasi Package', 'Discover the vibrant culture and heritage of Rajasthan combined with the spiritual charm of Varanasi. This tour covers Delhi, Agra, Jaipur, Udaipur, Jodhpur and concludes with the sacred experiences of Varanasi’s Ganga Aarti and river cruise.', 'Rajasthan tour, Varanasi tour, Delhi Agra Jaipur Udaipur Jodhpur Varanasi, Rajasthan Varanasi package, India cultural tour', 1, 0, 0, 0, 45, '2026-01-03 10:04:22', '2026-01-29 03:33:43'),
(55, 5, 'Ayodhya Pilgrims Tour Package', 'ayodhya-pilgrims-tour-package', 'A devotional Ayodhya tour featuring holy temples and spiritual experiences on the banks of the Saryu River.', 'Embark on a spiritual journey with our Ayodhya Pilgrimage Tour Package. Visit sacred temples including Ram Janmabhoomi, Hanuman Garhi, Kanak Bhawan and attend the serene Ganga Aarti at Saryu River while enjoying personalized private travel arrangements.', 7, 6, '24500.00', NULL, 'per_person', '695cdda5a6de6_1767693733.webp', NULL, NULL, 20, 0, 'easy', '', '', 'Ayodhya Pilgrimage Tour Package | Ayodhya Temple & Spiritual Tour', '', 'Ayodhya tour, Ayodhya pilgrimage, Ayodhya temple tour package, spiritual tour India, Ram Janmabhoomi tour', 1, 0, 0, 0, 40, '2026-01-03 10:10:48', '2026-01-28 22:05:41'),
(56, 11, 'Corbett Wildlife Tour', 'corbett-wildlife-tour', 'An exciting 5-day wildlife tour with multiple safaris in Jim Corbett National Park.', 'Experience thrilling wildlife adventures with the 5 Days Corbett Wildlife Tour. Explore the famous Jim Corbett National Park with premium safaris, diverse flora and fauna, and comfortable private transport and accommodations included.', 5, 4, '18500.00', NULL, 'per_person', '695cdd820eccc_1767693698.jpg', NULL, NULL, 20, 0, 'easy', '', '', '5 Days Corbett Wildlife Tour | Jim Corbett National Park Safari Package | Corbett National Park trip', '', 'Corbett wildlife tour, Jim Corbett safari package, 5 days Corbett tour, wildlife holiday India, Corbett National Park trip', 1, 0, 0, 0, 42, '2026-01-03 10:17:24', '2026-01-30 02:34:17'),
(57, 12, '10 Nights 11 Days Explore Kerala', '10-nights-11-days-explore-kerala', 'A complete 11-day Kerala tour with backwaters, hill stations and beach experiences.', 'Discover the tropical beauty of Kerala on this 10 Nights 11 Days Explore Kerala tour. Enjoy serene backwaters, houseboat stays, tea gardens in Munnar, wildlife in Thekkady and relaxing beaches in Kovalam, with comfortable transfers and daily breakfast included.', 10, 11, '0.00', NULL, 'per_person', '695cdd56d2ca0_1767693654.jpg', NULL, NULL, 20, 0, 'easy', '', '', '10 Nights 11 Days Kerala Tour | Kerala Backwaters & Beach Holiday Package | Kerala backwaters houseboat', '', 'Kerala tour, Kerala holiday package, Kerala backwaters houseboat, Munnar Thekkady Kovalam, 11 days Kerala', 1, 0, 0, 0, 43, '2026-01-03 10:25:44', '2026-01-28 14:38:37'),
(58, 12, '15 Nights 16 Days Southern Taste of India', '15-nights-16-days-southern-taste-of-india', 'A panoramic 16-day South India tour covering Kerala, Tamil Nadu and Karnataka.', 'Explore the diverse beauty of South India on this 15 Nights 16 Days Southern Taste of India tour. Journey through Kerala’s backwaters, Tamil Nadu’s temples, Karnataka’s hill stations and coastal landscapes with comfortable transfers and rich cultural experiences.', 16, 15, '0.00', NULL, 'per_person', '695cdb246a06c_1767693092.jpg', NULL, NULL, 20, 0, 'easy', '', '', '15 Nights 16 Days Southern India Tour | Kerala Tamil Nadu Karnataka Package', '', 'Southern India tour, Kerala tour, Tamil Nadu package, Karnataka tour, India holiday package, backwaters temples hills', 1, 0, 0, 0, 41, '2026-01-03 10:34:06', '2026-01-29 02:52:40'),
(59, 12, '18 Nights 19 Days Kerala with a Difference', '18-nights-19-days-kerala-with-a-difference', 'A unique 19-day Kerala tour with backwaters, hills and beach experiences.', 'Experience the best of Kerala on this 18 Nights 19 Days Kerala with a Difference tour. Enjoy unforgettable houseboat cruises, scenic hill stations like Munnar & Thekkady, tranquil backwaters and relaxing beach stays in Kovalam with daily breakfast and private transfers.', 19, 18, '0.00', NULL, 'per_person', '695cdafc1c9ae_1767693052.jpg', NULL, NULL, 20, 0, 'easy', '', '', '18 Nights 19 Days Kerala with a Difference | Backwaters Munnar Thekkady Kovalam Tour | Kerala holiday tour', '', 'Kerala tour, backwaters houseboat, Munnar Thekkady Kovalam package, 19 days Kerala, Kerala holiday tour', 1, 1, 0, 0, 41, '2026-01-03 10:54:07', '2026-01-28 18:39:50'),
(61, 12, 'Taj Mahal Kerala Tour', 'taj-mahal-kerala-tour', '', 'Explore India’s rich heritage and natural beauty with this Taj Mahal Kerala Tour. Visit iconic sites in Delhi, Agra & Jaipur, including the Taj Mahal, and unwind in Kerala’s backwaters, hill stations and beaches for a memorable holiday.', 11, 10, '0.00', NULL, 'per_person', '695cd76d6fb67_1767692141.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Taj Mahal Kerala Tour | Golden Triangle & Kerala Holiday Package | Delhi Agra Jaipur Kerala', '', 'Taj Mahal tour, Kerala tour package, Golden Triangle Kerala, Delhi Agra Jaipur Kerala, India holiday tour', 1, 0, 0, 0, 124, '2026-01-03 11:19:18', '2026-01-30 03:26:35'),
(62, 13, 'Best of Gujarat Heritage Tour', 'best-of-gujarat-heritage-tour', 'A heritage and culture tour showcasing the best of Gujarat’s historic sites and traditions.', 'Explore the cultural heritage of Gujarat with the Best of Gujarat Heritage Tour. Visit historic sites, temples, forts and scenic landscapes while enjoying authentic local experiences, delicious cuisine and comfortable travel.', 10, 9, '0.00', NULL, 'per_person', '695cd6820615a_1767691906.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Best of Gujarat Heritage Tour | Gujarat Culture & Sightseeing Package | Gujarat travel package', '', 'Gujarat heritage tour, Gujarat sightseeing package, Best of Gujarat, Gujarat culture tour, Gujarat travel package', 1, 0, 0, 0, 61, '2026-01-03 11:22:46', '2026-01-28 15:53:34'),
(63, 13, 'Best of Gujarat Tour', 'best-of-gujarat-tour', 'A complete Gujarat tour exploring its culture, temples, forts and heritage.', 'Discover the top attractions of Gujarat with the Best of Gujarat Tour. Visit historic temples, forts, wildlife sanctuaries and cultural heritage sites while enjoying local cuisine and scenic drives.', 8, 7, '0.00', NULL, 'per_person', '695cd61a8d598_1767691802.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Best of Gujarat Tour | Gujarat Heritage & Culture Package | Gujarat tour', '', 'Gujarat tour, Best of Gujarat, Gujarat heritage tour, Gujarat sightseeing package, Gujarat travel', 1, 1, 0, 0, 37, '2026-01-03 11:32:33', '2026-01-28 15:10:51'),
(64, 13, 'Dwarka Somnath Diu Sasangir Tour | Gujarat Pilgrimage & Beach Package', 'dwarka-somnath-diu-sasangir-tour-gujarat-pilgrimage-beach-package', 'A unique Gujarat tour combining pilgrimage, beach relaxation and wildlife adventure.', 'Experience a spiritual and coastal journey across Gujarat with this tour covering Dwarka, Somnath, Diu and Sasangir. Visit sacred temples, scenic beaches and Gir National Park for a complete cultural and nature experience.', 6, 5, '0.00', NULL, 'per_person', '695cd5ebbffe9_1767691755.png', NULL, NULL, 20, 0, 'easy', '', '', 'Dwarka Somnath Diu Sasangir Tour | Gujarat Pilgrimage & Beach Package | 5 Nights / 6 Days Gujarat pilgrimage tour', '', 'Dwarka tour, Somnath package, Diu tour, Sasangir wildlife, Gujarat pilgrimage tour', 1, 0, 0, 0, 58, '2026-01-03 11:37:42', '2026-01-29 23:24:30'),
(65, 13, 'Kutch with Dwarka Somnath Tour', 'kutch-with-dwarka-somnath-tour', 'A diverse Gujarat holiday blending desert landscapes, temples and coastal attractions.', 'Explore the best of Gujarat’s landscapes, culture and heritage with this Kutch with Dwarka Somnath Tour. Visit the White Desert of Kutch, sacred temples in Dwarka, and serene beaches and historic sites in Somnath.', 8, 7, '0.00', NULL, 'per_person', '695cd5c3c0f39_1767691715.jpg', NULL, NULL, 20, 0, 'easy', '', '', 'Kutch with Dwarka Somnath Tour | Gujarat Culture & Desert Tour | 7 Nights / 8 Days Kutch with Dwarka Somnath Tour', '', 'Kutch tour, Dwarka Somnath tour, Gujarat desert tour, White Desert Kutch, Gujarat culture tour', 1, 0, 0, 0, 37, '2026-01-03 11:41:49', '2026-01-29 09:19:37'),
(66, 13, '09 Nights 10 Days Architecture Of Gujrat And Mumbai', '09-nights-10-days-architecture-of-gujrat-and-mumbai', 'A 10-day architecture and heritage tour covering Gujarat’s monuments and Mumbai’s landmarks.', 'Explore the architectural marvels and cultural heritage of Gujarat and Mumbai on this 09 Nights 10 Days tour. Visit historic temples, ancient forts, colonial landmarks, bustling markets and scenic sights with comfortable transfers and professional guidance.', 10, 9, '0.00', NULL, 'per_person', '695cd31b08979_1767691035.jpg', NULL, NULL, 20, 0, 'easy', '', '', '09 Nights 10 Days Gujarat & Mumbai Architecture Tour | Heritage Package | Gujarat Mumbai tour package', '', 'Gujarat architecture tour, Mumbai heritage tour, Gujarat Mumbai tour package, 10 days India tour, Gujarat sightseeing', 1, 0, 0, 0, 63, '2026-01-03 11:48:00', '2026-01-29 23:24:32'),
(67, 2, 'Shimla Manali Tour Package from Delhi by Car', 'shimla-manali-tour-package-from-delhi-by-car', 'Enjoy a memorable 5-day road trip from Delhi to Manali and back. Explore the scenic hills of Himachal Pradesh with comfortable transfers, sightseeing in Manali and Shimla, and leisure time amidst snow-capped mountains and valleys.', 'Enjoy a memorable 5-day road trip from Delhi to Manali and back. Explore the scenic hills of Himachal Pradesh with comfortable transfers, sightseeing in Manali and Shimla, and leisure time amidst snow-capped mountains and valleys.', 6, 5, '22500.00', NULL, 'per_person', '695cd2db6e72a_1767690971.jpeg', NULL, NULL, 20, 0, 'easy', '', '', 'Delhi Manali Delhi Tour Package 5 Days | Shimla Manali Road Trip | 5 days Himachal tour', 'A 5-day road tour from Delhi to Manali and back featuring scenic mountain landscapes and Himachal sightseeing.', 'Delhi Manali tour package, Manali tour from Delhi, Himachal road trip, Shimla Manali package, 5 days Himachal tour', 1, 0, 0, 0, 54, '2026-01-06 08:37:28', '2026-01-28 11:35:14');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles_new`
--

CREATE TABLE `vehicles_new` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` enum('sedan','suv','tempo_traveller','bus','luxury') NOT NULL,
  `capacity` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `features` text DEFAULT NULL,
  `price_per_km` decimal(8,2) DEFAULT NULL,
  `price_per_day` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_username` (`username`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `booking_number` (`booking_number`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `idx_booking_number` (`booking_number`),
  ADD KEY `idx_travel_date` (`travel_date`),
  ADD KEY `idx_status` (`booking_status`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_active` (`is_active`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `idx_email` (`email`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_active` (`is_active`);

--
-- Indexes for table `gallery_new`
--
ALTER TABLE `gallery_new`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_category` (`category`),
  ADD KEY `idx_related` (`related_type`,`related_id`);

--
-- Indexes for table `package_destinations`
--
ALTER TABLE `package_destinations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_package_destination` (`package_id`,`destination_id`),
  ADD KEY `destination_id` (`destination_id`),
  ADD KEY `idx_package` (`package_id`);

--
-- Indexes for table `package_itinerary`
--
ALTER TABLE `package_itinerary`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_package_day` (`package_id`,`day_number`);

--
-- Indexes for table `package_pricing`
--
ALTER TABLE `package_pricing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_package` (`package_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `idx_package` (`package_id`),
  ADD KEY `idx_approved` (`is_approved`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `setting_key` (`setting_key`);

--
-- Indexes for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`),
  ADD KEY `idx_category` (`category_id`),
  ADD KEY `idx_slug` (`slug`),
  ADD KEY `idx_active` (`is_active`),
  ADD KEY `idx_featured` (`is_featured`);

--
-- Indexes for table `vehicles_new`
--
ALTER TABLE `vehicles_new`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=121;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `gallery_new`
--
ALTER TABLE `gallery_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `package_destinations`
--
ALTER TABLE `package_destinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=390;

--
-- AUTO_INCREMENT for table `package_itinerary`
--
ALTER TABLE `package_itinerary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1800;

--
-- AUTO_INCREMENT for table `package_pricing`
--
ALTER TABLE `package_pricing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tour_packages`
--
ALTER TABLE `tour_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `vehicles_new`
--
ALTER TABLE `vehicles_new`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `tour_packages` (`id`);

--
-- Constraints for table `package_destinations`
--
ALTER TABLE `package_destinations`
  ADD CONSTRAINT `package_destinations_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `package_destinations_ibfk_2` FOREIGN KEY (`destination_id`) REFERENCES `destinations` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_itinerary`
--
ALTER TABLE `package_itinerary`
  ADD CONSTRAINT `package_itinerary_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `package_pricing`
--
ALTER TABLE `package_pricing`
  ADD CONSTRAINT `package_pricing_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`package_id`) REFERENCES `tour_packages` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `tour_packages`
--
ALTER TABLE `tour_packages`
  ADD CONSTRAINT `tour_packages_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
