-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 02:33 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eco_trade_hub`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `admin_email` varchar(255) NOT NULL,
  `admin_password` varchar(255) NOT NULL,
  `admin_image` varchar(255) NOT NULL,
  `admin_address` varchar(255) NOT NULL,
  `admin_mobile` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`admin_id`, `admin_name`, `admin_email`, `admin_password`, `admin_image`, `admin_address`, `admin_mobile`) VALUES
(1, 'Malik Nouman', 'nouman_malik@gmail.com', '123', 'admin1.jpg', 'B17 MultiGardens', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_title`) VALUES
(1, 'Bosch'),
(2, 'Denso'),
(3, 'Continental AG'),
(4, 'Valeo'),
(5, 'NGK'),
(6, 'Bilstein'),
(7, 'Brembo'),
(8, 'Lexus');

-- --------------------------------------------------------

--
-- Table structure for table `cart_details`
--

CREATE TABLE `cart_details` (
  `product_id` int(11) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `quantity` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_title` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_title`) VALUES
(1, 'Passenger Automobile'),
(3, 'SUV'),
(4, 'Engine Parts'),
(5, 'Transmission & Drivetrain'),
(6, 'Suspension & Steering'),
(7, 'Brakes'),
(8, 'Electrical & Lighting');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `chat_id` int(11) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chat_messages`
--

INSERT INTO `chat_messages` (`chat_id`, `sender`, `receiver`, `message`, `date`) VALUES
(1, 'nouman.nomi@gmail.com', 'nouman.awan@gmail.com', 'Hi', '2024-11-11 07:50:17'),
(2, 'nouman.nomi@gmail.com', 'nouman.awan@gmail.com', 'How are you doing?', '2024-11-11 07:50:21'),
(3, 'nouman.awan@gmail.com', 'nouman.nomi@gmail.com', 'I am fine!', '2024-11-11 07:50:26'),
(4, 'nouman.awan@gmail.com', 'nouman.nomi@gmail.com', 'Do you want to ask about parts?', '2024-11-11 07:50:29');

-- --------------------------------------------------------

--
-- Table structure for table `orders_pending`
--

CREATE TABLE `orders_pending` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(255) NOT NULL,
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders_pending`
--

INSERT INTO `orders_pending` (`order_id`, `user_id`, `invoice_number`, `product_id`, `quantity`, `order_status`) VALUES
(1, 4, 67033627, 3, 4, 'pending'),
(2, 4, 67033627, 4, 1, 'pending'),
(6, 4, 2093470678, 3, 4, 'pending'),
(7, 4, 2093470678, 4, 1, 'pending'),
(8, 4, 2093470678, 6, 1, 'pending'),
(9, 4, 1197211106, 2, 1, 'complete'),
(10, 4, 1197211106, 11, 1, 'complete'),
(11, 1, 579678158, 10, 1, 'pending'),
(12, 5, 522285410, 2, 1, 'complete'),
(13, 5, 1835484400, 3, 1, 'pending'),
(14, 5, 1835484400, 4, 1, 'pending'),
(15, 5, 1835484400, 6, 1, 'pending'),
(16, 5, 2015242663, 5, 1, 'complete'),
(17, 5, 2015242663, 9, 1, 'complete'),
(18, 5, 2015242663, 11, 1, 'complete'),
(19, 5, 2123949378, 3, 1, 'complete'),
(20, 5, 2123949378, 6, 1, 'complete'),
(21, 5, 1114742846, 3, 1, 'pending'),
(22, 5, 1114742846, 5, 1, 'pending'),
(23, 5, 1114742846, 9, 1, 'pending'),
(24, 5, 1888331469, 3, 1, 'pending'),
(25, 5, 1041519402, 4, 1, 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `product_id` int(11) NOT NULL,
  `product_title` varchar(100) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `product_description` varchar(255) NOT NULL,
  `product_keywords` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `brand_id` int(11) NOT NULL,
  `product_image1` varchar(255) NOT NULL,
  `product_image2` varchar(255) NOT NULL,
  `product_image3` varchar(255) NOT NULL,
  `product_price` varchar(100) NOT NULL,
  `product_condition` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `product_title`, `seller_id`, `product_description`, `product_keywords`, `category_id`, `brand_id`, `product_image1`, `product_image2`, `product_image3`, `product_price`, `product_condition`, `date`, `status`) VALUES
(2, 'Lexus Enginee', 3, 'An engine that will transform your car into a roaring beast.', 'engine, best engine, quality engine, new engine, excellent engine', 3, 8, 'lexus_engine1.jpg', 'lexus_engine11.jpg', 'lexus_engine111.jpg', '10000', 'Excellent', '2024-11-14 07:01:43', 'true'),
(3, 'Air Filter', 3, 'Best air filter out there to keep your car clean', 'air filter, best air filter, quality engine, new engine', 3, 2, 'denso_air_filter.jpg', 'denso_air_filterr.jpg', 'denso_air_filterrr.png', '2000', 'Excellent', '2024-11-14 07:01:51', 'true'),
(4, 'Fuel Injectors', 3, 'Fuel Injectors that will keep your cars roaring', 'engine pats, best engine parts, fuel injectors quality engine, new engine', 4, 1, 'bosch_fuel.png', 'bosch_fuell.jpg', 'bosch_fuelll.jpg', '4000', 'Good', '2024-11-14 07:02:00', 'true'),
(5, 'Brake Drum', 3, 'Speeding is not an issue with Continental AG Brake Drums', 'brake parts, best brake parts, quality brake drums, new brake drums', 7, 3, 'cont_ag_brakedrum.jpg', 'cont_ag_brakedrumm.jpg', 'cont_ag_brakedrummm.jpg', '90000', 'Excellent', '2024-11-14 07:02:11', 'true'),
(6, 'Shock Absorbers', 3, 'A great shock absorber that will save your car from any atrocities coming its way', 'shock absorber, best shock absorber, good shock absorber, new shock absorber', 6, 6, 'bilstein_shock_absorb.jpg', 'bilstein_shock_absorbb.jpg', 'bilstein_shock_absorbbb.jpg', '300000', 'Excellent', '2024-11-14 07:02:20', 'true'),
(9, 'Fuel Injectors', 1, 'Fuel Injectors that will keep your cars roaring', 'engine pats, best engine parts, fuel injectors quality engine, new engine', 4, 1, 'bosch_fuel.png', 'bosch_fuell.jpg', 'bosch_fuelll.jpg', '4000', 'Satisfactory', '2024-11-14 07:02:31', 'true'),
(10, 'Brake', 1, 'An brake that will stop your beast bike at any speed.', 'brake, best brake, quality brake, new brake', 7, 7, 'brembo_brake.jpg', 'brembo_brakee.png', 'brembo_brakeee.jpg', '400000', 'Excellent', '2024-11-14 07:02:41', 'true'),
(11, 'Spark Plugs', 1, 'NGK spark plugs are renowned for their durability, high performance, and efficient ignition, making them a top choice for automotive engines worldwide.', 'durability, high performance, efficient, ignition, spark plugs, best spark plugs', 1, 5, 'ngk_spark.jpg', 'ngk_sparkk.jpg', 'ngk_sparkkk.jpg', '5200', 'Excellent', '2024-11-14 07:02:52', 'true'),
(12, 'Valeo Alternators', 1, 'The best alternators one can find in the market!', 'best alternator, alternator, alternators, valeo alternators, best quality alternator', 1, 4, 'valeo_alternatorr1.webp', 'valeo_alternator111.jpg', 'valeo_alternator11.jpg', '25000', 'Excellent', '2024-11-14 07:03:01', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `product_id`, `rating`, `message`, `date`) VALUES
(3, 1, 2, '5', 'This is a good product!', '2024-11-14 05:24:33'),
(6, 5, 2, '5', 'I love it so much!', '2024-11-14 05:24:44'),
(7, 5, 2, '5', 'This is one of the best!', '2024-11-14 05:24:52'),
(9, 5, 2, '5', 'Good product!', '2024-11-14 05:24:58'),
(10, 1, 2, '5', 'Excellent Product! Will purchase again!', '2024-11-14 05:25:06'),
(11, 5, 3, '5', 'Such a nice product!', '2024-11-14 05:25:13'),
(15, 1, 4, '5', 'I commend this product!', '2024-11-14 06:25:42'),
(16, 7, 4, '4', 'I would not say that I am a fan!', '2024-11-14 06:41:19'),
(17, 2, 4, '3', 'An average product!', '2024-11-14 06:51:53');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

CREATE TABLE `sellers` (
  `seller_id` int(11) NOT NULL,
  `sellername` varchar(255) NOT NULL,
  `seller_email` varchar(255) NOT NULL,
  `seller_password` varchar(255) NOT NULL,
  `seller_image` varchar(255) NOT NULL,
  `seller_address` varchar(255) NOT NULL,
  `seller_mobile` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`seller_id`, `sellername`, `seller_email`, `seller_password`, `seller_image`, `seller_address`, `seller_mobile`, `status`) VALUES
(1, 'Nouman Awan', 'nouman.awan@gmail.com', '123', 'seller11.jpg', 'B17 Multigardens', '12345678910', 'approved'),
(3, 'Muhammad Nouman', 'm.nouman@gmail.com', '123', 'seller2.jpg', 'B17 Multigardens', '12345678910', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_image` varchar(255) NOT NULL,
  `user_ip` varchar(100) NOT NULL,
  `user_address` varchar(255) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `status` enum('pending','approved','rejected','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `user_email`, `user_password`, `user_image`, `user_ip`, `user_address`, `user_mobile`, `status`) VALUES
(1, 'Nouman Nomi', 'nouman.nomi@gmail.com', '12', 'WhatsApp Image 2024-11-12 at 11.49.49_87810ed2.jpg', '::1', 'Islamabad Pakistan', '123456', 'approved'),
(2, 'Sufi Ahmed', 'sawaiyan@gmail.com', '123', 'user22.jpg', '::1', 'B17 Multi Gardens Islamabad', '12345678', 'approved'),
(3, 'Zia Azad', 'zia@gmail.com', '123', 'user3.jpg', '::1', 'HPT Road Sangri Mera', '123456789', 'approved'),
(5, 'Muhammad Nouman Asghar', 'noumanashgar92@gmail.com', '1234', 'user55.jpg', '::1', 'B17 Multi Gardens Islamabad', '123456789101112', 'approved'),
(7, 'Umer Azad', 'umer@gmail.com', '123', 'user7.jpg', '::1', 'HPT Road Sangri Mera', '123456789101112', 'approved');

-- --------------------------------------------------------

--
-- Table structure for table `user_orders`
--

CREATE TABLE `user_orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount_due` int(255) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `total_products` int(255) NOT NULL,
  `order_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `order_status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_orders`
--

INSERT INTO `user_orders` (`order_id`, `user_id`, `amount_due`, `invoice_number`, `total_products`, `order_date`, `order_status`) VALUES
(1, 1, 10000, 1651816824, 5, '2024-11-11 03:26:48.404739', 'complete'),
(2, 2, 10000, 1703394903, 5, '2024-10-15 13:39:43.000000', 'pending'),
(6, 4, 310000, 2093470678, 6, '2024-10-15 15:00:33.000000', 'pending'),
(7, 4, 105200, 1197211106, 2, '2024-10-21 04:52:15.764333', 'complete'),
(8, 1, 400000, 579678158, 1, '2024-11-03 13:01:40.000000', 'pending'),
(9, 5, 10000, 522285410, 1, '2024-11-11 06:36:37.781603', 'complete'),
(10, 5, 306000, 1835484400, 3, '2024-11-11 07:15:14.473425', 'complete'),
(11, 5, 99200, 2015242663, 3, '2024-11-11 07:17:17.821941', 'complete'),
(12, 5, 302000, 2123949378, 2, '2024-11-11 07:24:21.240039', 'complete'),
(13, 5, 96000, 1114742846, 3, '2024-11-11 07:27:19.000000', 'pending'),
(14, 5, 2000, 1888331469, 1, '2024-11-11 07:28:29.000000', 'pending'),
(15, 5, 4000, 1041519402, 1, '2024-11-11 07:29:17.000000', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `user_payments`
--

CREATE TABLE `user_payments` (
  `payment_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `invoice_number` int(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_payments`
--

INSERT INTO `user_payments` (`payment_id`, `order_id`, `invoice_number`, `amount`, `payment_mode`, `date`) VALUES
(1, 6, 2093470678, 310000, 'CoD', '2024-10-21 04:48:52'),
(2, 6, 2093470678, 310000, 'CoD', '2024-10-21 04:49:20'),
(3, 6, 2093470678, 310000, 'CoD', '2024-10-21 04:50:37'),
(5, 6, 2093470678, 310000, 'credit_card', '2024-10-21 04:51:40'),
(6, 7, 1197211106, 105200, 'credit_card', '2024-10-21 04:52:15'),
(9, 7, 1197211106, 105200, 'credit_card', '2024-10-21 04:52:54'),
(10, 9, 522285410, 10000, 'credit_card', '2024-11-11 06:36:37'),
(11, 10, 1835484400, 306000, 'CoD', '2024-11-11 06:42:23'),
(21, 10, 1835484400, 306000, 'credit_card', '2024-11-11 07:15:14'),
(22, 11, 2015242663, 99200, 'credit_card', '2024-11-11 07:17:17'),
(24, 12, 2123949378, 302000, 'credit_card', '2024-11-11 07:24:21'),
(25, 13, 1114742846, 96000, 'CoD', '2024-11-11 07:34:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_details`
--
ALTER TABLE `cart_details`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`chat_id`);

--
-- Indexes for table `orders_pending`
--
ALTER TABLE `orders_pending`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`);

--
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`seller_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_orders`
--
ALTER TABLE `user_orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `user_payments`
--
ALTER TABLE `user_payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `chat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `orders_pending`
--
ALTER TABLE `orders_pending`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `seller_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_orders`
--
ALTER TABLE `user_orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_payments`
--
ALTER TABLE `user_payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
