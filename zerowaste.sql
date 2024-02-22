-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 22, 2024 at 03:49 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `zerowaste`
--

-- --------------------------------------------------------

--
-- Table structure for table `buyers`
--

DROP TABLE IF EXISTS `buyers`;
CREATE TABLE IF NOT EXISTS `buyers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(150) NOT NULL,
  `user_name` varchar(150) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `password` varchar(150) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `buyers`
--

INSERT INTO `buyers` (`id`, `email`, `user_name`, `phone_number`, `password`, `created_at`) VALUES
(1, 'singhesinghe123@gmail.com', 'abc', '+94761683094', '123', '2024-02-19 02:56:01');

-- --------------------------------------------------------

--
-- Table structure for table `donations`
--

DROP TABLE IF EXISTS `donations`;
CREATE TABLE IF NOT EXISTS `donations` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `seller_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `donations`
--

INSERT INTO `donations` (`id`, `name`, `weight`, `category`, `image`, `seller_id`, `created_at`) VALUES
(1, 'All Food Waste', '150.00', 'food', 'https://th.bing.com/th/id/OIP.c8Fulqt59ihSk13D4cWwkwHaE8?rs=1&pid=ImgDetMain', 2, '2024-02-21 03:06:02'),
(2, 'All Food Waste', '150.00', 'food', 'https://th.bing.com/th/id/OIP.c8Fulqt59ihSk13D4cWwkwHaE8?rs=1&pid=ImgDetMain', 2, '2024-02-21 03:08:05'),
(3, 'All Food Waste', '150.00', 'food', 'https://th.bing.com/th/id/OIP.c8Fulqt59ihSk13D4cWwkwHaE8?rs=1&pid=ImgDetMain', 2, '2024-02-21 03:09:43'),
(4, 'All Food Waste', '150.00', 'food', 'https://th.bing.com/th/id/OIP.c8Fulqt59ihSk13D4cWwkwHaE8?rs=1&pid=ImgDetMain', 2, '2024-02-21 03:12:08'),
(5, 'All Food Waste', '150.00', 'food', 'https://th.bing.com/th/id/OIP.c8Fulqt59ihSk13D4cWwkwHaE8?rs=1&pid=ImgDetMain', 2, '2024-02-21 03:12:32'),
(6, 'All Food Waste', '150.00', 'food', 'https://th.bing.com/th/id/OIP.c8Fulqt59ihSk13D4cWwkwHaE8?rs=1&pid=ImgDetMain', 2, '2024-02-21 03:13:47'),
(7, 'All Food Waste', '150.00', 'food', 'https://th.bing.com/th/id/OIP.c8Fulqt59ihSk13D4cWwkwHaE8?rs=1&pid=ImgDetMain', 2, '2024-02-21 14:03:53');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rating` int NOT NULL,
  `improvements` text,
  `suggestions` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`id`, `rating`, `improvements`, `suggestions`, `created_at`) VALUES
(1, 1, 'Transparency', 'Good', '2024-02-22 03:08:23'),
(2, 2, 'Overall Service', 'Good', '2024-02-22 03:11:23'),
(3, 1, 'Overall Service', 'Good', '2024-02-22 03:14:33');

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `weight` varchar(255) DEFAULT NULL,
  `price` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'Noodles', '250.00', 'https://th.bing.com/th/id/R.0b7129d20ac9acfed54004acfb7a1c9f?rik=15jQ%2bYsfVztnpA&pid=ImgRaw&r=0'),
(2, 'Rice and Curry', '200.00', 'rice_and_curry.jpg'),
(3, 'Sandwich', '150.00', 'sandwich.jpg'),
(4, 'Burger', '300.00', 'burger.jpg'),
(5, 'Pizza', '200.00', 'pizza.jpg'),
(6, 'Fish Roll', '100.00', 'fish_roll.jpg'),
(7, 'Chicken Kottu', '450.00', 'chicken_kottu.jpg'),
(8, 'Noodles', '250.00', 'noodles.jpg'),
(9, 'Rice and Curry', '200.00', 'rice_and_curry.jpg'),
(10, 'Sandwich', '150.00', 'sandwich.jpg'),
(11, 'Burger', '300.00', 'burger.jpg'),
(12, 'Pizza', '200.00', 'pizza.jpg'),
(13, 'Fish Roll', '100.00', 'fish_roll.jpg'),
(14, 'Chicken Kottu', '450.00', 'chicken_kottu.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `sellers`
--

DROP TABLE IF EXISTS `sellers`;
CREATE TABLE IF NOT EXISTS `sellers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `seller_name` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `password` varchar(255) NOT NULL,
  `business_type` enum('Restaurant','Hotel','Grocery Stores','House/Resident') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `sellers`
--

INSERT INTO `sellers` (`id`, `email`, `seller_name`, `phone_number`, `address`, `password`, `business_type`, `created_at`) VALUES
(1, 'mudiyansew@gmail.com', 'bvgc', '+94761683094', 'hbjk', '202cb962ac59075b964b07152d234b70', 'Restaurant', '2024-02-19 02:32:30'),
(2, 'singhesinghe123@gmail.com', 'meee', '+94761683094', 'colombo', '123', 'Restaurant', '2024-02-19 02:37:50');

-- --------------------------------------------------------

--
-- Table structure for table `waste`
--

DROP TABLE IF EXISTS `waste`;
CREATE TABLE IF NOT EXISTS `waste` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `weight` decimal(10,2) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `category` enum('food','waste') NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `contact` varchar(50) DEFAULT NULL,
  `address` text,
  `ratings` decimal(3,2) DEFAULT NULL,
  `seller_id` int NOT NULL,
  `is_donation` tinyint DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `seller_id` (`seller_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `waste`
--

INSERT INTO `waste` (`id`, `name`, `weight`, `price`, `image`, `category`, `created_at`, `contact`, `address`, `ratings`, `seller_id`, `is_donation`) VALUES
(1, 'Organic Apple Waste', '185.00', '100.00', 'path-to-apple-image.jpg', 'food', '2024-02-20 23:54:18', '+94771234567', '123 Orchard Lane', '4.50', 1, 0),
(2, 'Plastic Bottles', '25.00', '80.00', 'path-to-bottle-image.jpg', 'waste', '2024-02-20 23:54:18', '+94771234568', '456 Recycling Bin Avenue', '4.70', 2, 0),
(3, 'Expired Canned Goods', '90.00', '120.00', 'path-to-canned-goods-image.jpg', 'food', '2024-02-20 23:54:18', '+94771234569', '789 Supermarket Shelf Road', '4.30', 1, 0),
(4, 'All Food Waste', '150.00', '100.00', 'https://th.bing.com/th/id/OIP.c8Fulqt59ihSk13D4cWwkwHaE8?rs=1&pid=ImgDetMain', 'food', '2024-02-21 01:05:45', NULL, NULL, NULL, 2, 0),
(5, 'All Food Waste', '150.00', '100.00', 'https://th.bing.com/th/id/OIP.c8Fulqt59ihSk13D4cWwkwHaE8?rs=1&pid=ImgDetMain', 'food', '2024-02-21 01:08:23', NULL, NULL, NULL, 2, 0),
(6, 'Some Waste', '106.00', '100.00', '', 'waste', '2024-02-21 03:02:46', NULL, NULL, NULL, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `waste_factories`
--

DROP TABLE IF EXISTS `waste_factories`;
CREATE TABLE IF NOT EXISTS `waste_factories` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `details` text,
  `image` varchar(255) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `efficiency` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `waste_factories`
--

INSERT INTO `waste_factories` (`id`, `name`, `details`, `image`, `contact`, `efficiency`) VALUES
(1, 'EcoCycle Compost Solution', 'Comprehensive composting solutions for organic waste.', 'ecocycle_image.jpg', '+94 76 279 5612', 80),
(2, 'EcoCycle Compost Solution', 'Comprehensive composting solutions for organic waste.', 'ecocycle_image.jpg', '+94 76 279 5612', 80),
(3, 'GreenEarth Recycling', 'Recycling services focused on sustainability and reusability.', 'greenearth_image.jpg', '+94 77 123 4567', 75);

-- --------------------------------------------------------

--
-- Table structure for table `waste_providers`
--

DROP TABLE IF EXISTS `waste_providers`;
CREATE TABLE IF NOT EXISTS `waste_providers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `contact` varchar(50) DEFAULT NULL,
  `efficiency` int DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `details` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
