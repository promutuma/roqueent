-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2023 at 06:11 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `camerapr_kamau`
--

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_name` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_name`, `createdBy`) VALUES
('DRY FOOD', '00000000'),
('FAST FOODS', '00000000'),
('STATIONERY', '00000000');

-- --------------------------------------------------------

--
-- Table structure for table `expense`
--

CREATE TABLE `expense` (
  `expense_ID` varchar(255) NOT NULL,
  `expense_description` varchar(255) NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `expense_amount` decimal(65,2) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `expense`
--

INSERT INTO `expense` (`expense_ID`, `expense_description`, `date`, `time`, `expense_amount`, `remarks`, `createdBy`) VALUES
('1680677404', 'Electricity Bill', '2023-04-05', '09:50:04', '1000.00', '33 tokens', '00000000'),
('1680682853', 'Rent', '2023-04-05', '11:20:53', '5000.00', 'Paid through mpesa to Landlord\'s  phone number ', '00000000'),
('1684412574', 'Shop Rent', '2023-05-18', '15:22:54', '5000.00', 'Paid through mpesa to Landlord\'s  phone number QWRETYRY67', '00000000');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `log_id` varchar(255) NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `log_type` varchar(255) NOT NULL,
  `log_desc` varchar(255) NOT NULL,
  `log_date` varchar(255) NOT NULL,
  `log_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`log_id`, `session_id`, `user_id`, `log_type`, `log_desc`, `log_date`, `log_time`) VALUES
('0001680611315', '1680611306', '00000000', 'Logout', 'User with user: Administrator  CAMERA 20 logged out successfully on 2023-04-04 15:28:35', '2023-04-04', '15:28:35'),
('0001680611363', '1680611318', '00000000', 'Logout', 'Administrator  CAMERA 20 logged out successfully on 2023-04-04 15:29:23', '2023-04-04', '15:29:23'),
('0001680694263', '1680675778', '00000000', 'Logout', 'Administrator  CAMERA 20 logged out successfully on 2023-04-05 14:31:03', '2023-04-05', '14:31:03'),
('0001683004736', '1683004719', '00000000', 'Logout', 'Administrator  CAMERA 20 logged out successfully on 2023-05-02 08:18:56', '2023-05-02', '08:18:56'),
('0001684411371', '1684411355', '00000000', 'Logout', 'Administrator  CAMERA 20 logged out successfully on 2023-05-18 15:02:51', '2023-05-18', '15:02:51'),
('0001684412276', '1684411411', '00000000', 'Logout', 'Administrator  CAMERA 20 logged out successfully on 2023-05-18 15:17:56', '2023-05-18', '15:17:56'),
('0001684413837', '1684412286', '00000000', 'Logout', 'Administrator  CAMERA 20 logged out successfully on 2023-05-18 15:43:57', '2023-05-18', '15:43:57'),
('1680611306', '1680611306', '00000000', 'Login', 'Administrator  Logged in at 2023-04-04 15:28:26', '2023-04-04', '15:28:26'),
('1680611316', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-04-04', '15:28:36'),
('1680611318', '1680611318', '00000000', 'Login', 'Administrator  Logged in at 2023-04-04 15:28:38', '2023-04-04', '15:28:38'),
('1680611363', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-04-04', '15:29:23'),
('1680611365', '1680611365', '00000000', 'Login', 'Administrator  Logged in at 2023-04-04 15:29:25', '2023-04-04', '15:29:25'),
('1680611392', '1680611365', '00000000', 'Create', 'New sale (1680611392) initiated by Administrator  CAMERA 20 on 2023-04-04 15:29:52', '2023-04-04', '15:29:52'),
('1680611534', '1680611365', '00000000', 'Create', 'Item Beans 1kg Bags added to cart 1680611392 by Administrator  CAMERA 20 on 2023-04-04 15:32:14', '2023-04-04', '15:32:14'),
('1680611568', '1680611365', '00000000', 'Create', 'Item Maize 1kg Bags added to cart 1680611392 by Administrator  CAMERA 20 on 2023-04-04 15:32:48', '2023-04-04', '15:32:48'),
('1680611592', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-04-04', '15:33:12'),
('1680611593', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-04-04', '15:33:13'),
('1680611610', '1680611610', '35232699', 'Login', 'Franklin Logged in at 2023-04-04 15:33:30', '2023-04-04', '15:33:30'),
('1680611642', '1680611365', '00000000', 'Create', 'Item Chips at 50 added to cart 1680611392 by Administrator  CAMERA 20 on 2023-04-04 15:34:02', '2023-04-04', '15:34:02'),
('1680612317', '1680611610', '35232699', 'Create', 'New sale (1680612317) initiated by Franklin Mutuma on 2023-04-04 15:45:17', '2023-04-04', '15:45:17'),
('1680612936', '1680611365', '00000000', 'Create', 'Item Beans 1kg Bags added to cart 1680612317 by Administrator  CAMERA 20 on 2023-04-04 15:55:36', '2023-04-04', '15:55:36'),
('1680675700', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-04-05', '09:21:40'),
('1680675778', '1680675778', '00000000', 'Login', 'Administrator  Logged in at 2023-04-05 09:22:58', '2023-04-05', '09:22:58'),
('1680677404', '1680675778', '00000000', 'Create', 'Expense 1680677404 of Ksh 1000  added to by Administrator  CAMERA 20 on 2023-04-05 09:50:04', '2023-04-05', '09:50:04'),
('1680682568', '1680675778', '00000000', 'Create', 'Item Ice cream - Vanilla 150ml added to cart 1680611392 by Administrator  CAMERA 20 on 2023-04-05 11:16:08', '2023-04-05', '11:16:08'),
('1680682582', '1680675778', '00000000', 'Create', 'New sale (1680682582) initiated by Administrator  CAMERA 20 on 2023-04-05 11:16:22', '2023-04-05', '11:16:22'),
('1680682597', '1680675778', '00000000', 'Create', 'Item Maize 1kg Bags added to cart 1680682582 by Administrator  CAMERA 20 on 2023-04-05 11:16:37', '2023-04-05', '11:16:37'),
('1680682853', '1680675778', '00000000', 'Create', 'Expense 1680682853 of Ksh 5000  added to by Administrator  CAMERA 20 on 2023-04-05 11:20:53', '2023-04-05', '11:20:53'),
('1680686189', '1680675778', '00000000', 'Create', 'Payment C1680686189 of Ksh 2190 by Cash payment mode added to sale  1680611392 by Administrator  CAMERA 20 on 2023-04-05 12:16:29', '2023-04-05', '12:16:29'),
('1680693451', '1680675778', '00000000', 'Create', 'New sale (1680693451) initiated by Administrator  CAMERA 20 on 2023-04-05 14:17:31', '2023-04-05', '14:17:31'),
('1680694264', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-04-05', '14:31:04'),
('1680694265', '1680694265', '00000000', 'Login', 'Administrator  Logged in at 2023-04-05 14:31:05', '2023-04-05', '14:31:05'),
('1680695701', '1680694265', '00000000', 'Create', 'Product (Chapati) added to the system by Administrator  CAMERA 20 on 2023-04-05 14:55:01', '2023-04-05', '14:55:01'),
('1681891343', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-04-19', '11:02:23'),
('1681891351', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-04-19', '11:02:31'),
('1681891357', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-04-19', '11:02:37'),
('1681891364', '1681891364', '00000000', 'Login', 'Administrator  Logged in at 2023-04-19 11:02:44', '2023-04-19', '11:02:44'),
('1681891378', '1681891364', '00000000', 'Create', 'New sale (1681891378) initiated by Administrator  CAMERA 20 on 2023-04-19 11:02:58', '2023-04-19', '11:02:58'),
('1683004709', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-05-02', '08:18:29'),
('1683004719', '1683004719', '00000000', 'Login', 'Administrator  Logged in at 2023-05-02 08:18:39', '2023-05-02', '08:18:39'),
('1683004736', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-05-02', '08:18:56'),
('1684411170', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-05-18', '14:59:30'),
('1684411355', '1684411355', '00000000', 'Login', 'Administrator  Logged in at 2023-05-18 15:02:35', '2023-05-18', '15:02:35'),
('1684411371', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-05-18', '15:02:51'),
('1684411411', '1684411411', '00000000', 'Login', 'Administrator  Logged in at 2023-05-18 15:03:31', '2023-05-18', '15:03:31'),
('1684411892', '1684411411', '00000000', 'Create', 'User Franklin added as Admin by Administrator  CAMERA 20 on 2023-05-18 15:11:31', '2023-05-18', '15:11:32'),
('1684412094', '1684411411', '00000000', 'Delete', 'Product with sku number (1679664917) deleted from the system by Administrator  CAMERA 20 on 2023-05-18 15:14:54', '2023-05-18', '15:14:54'),
('1684412276', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-05-18', '15:17:56'),
('1684412286', '1684412286', '00000000', 'Login', 'Administrator  Logged in at 2023-05-18 15:18:06', '2023-05-18', '15:18:06'),
('1684412343', '1684412286', '00000000', 'Create', 'Category (STATIONERY) added to the system by Administrator  CAMERA 20 on 2023-05-18 15:19:03', '2023-05-18', '15:19:03'),
('1684412439', '1684412286', '00000000', 'Create', 'Product (Kasuku Foolscaps 80 pages) added to the system by Administrator  CAMERA 20 on 2023-05-18 15:20:39', '2023-05-18', '15:20:39'),
('1684412489', '1684412286', '00000000', 'Update', 'A stock of 30 added to Product with sku number (1684412439) by Administrator  CAMERA 20 on 2023-05-18 15:21:29', '2023-05-18', '15:21:29'),
('1684412574', '1684412286', '00000000', 'Create', 'Expense 1684412574 of Ksh 5000  added to by Administrator  CAMERA 20 on 2023-05-18 15:22:54', '2023-05-18', '15:22:54'),
('1684412817', '1684412286', '00000000', 'Create', 'New sale (1684412817) initiated by Administrator  CAMERA 20 on 2023-05-18 15:26:57', '2023-05-18', '15:26:57'),
('1684412891', '1684412286', '00000000', 'Create', 'Item Kasuku Foolscaps 80 pages added to cart 1684412817 by Administrator  CAMERA 20 on 2023-05-18 15:28:11', '2023-05-18', '15:28:11'),
('1684412926', '1684412286', '00000000', 'Create', 'Item Chips at 50 added to cart 1684412817 by Administrator  CAMERA 20 on 2023-05-18 15:28:46', '2023-05-18', '15:28:46'),
('1684412992', '1684412286', '00000000', 'Create', 'Item Maize 1kg Bags added to cart 1684412817 by Administrator  CAMERA 20 on 2023-05-18 15:29:52', '2023-05-18', '15:29:52'),
('1684413041', '1684412286', '00000000', 'Update', 'A stock of 1 added to Product with sku number (1679665355) by Administrator  CAMERA 20 on 2023-05-18 15:30:41', '2023-05-18', '15:30:41'),
('1684413104', '1684412286', '00000000', 'Update', 'Quantity of Item Maize 1kg Bags updated on sale  1684412817 by Administrator  CAMERA 20 on 2023-05-18 15:31:44', '2023-05-18', '15:31:44'),
('1684413172', '1684412286', '00000000', 'Create', 'Payment C1684413172 of Ksh 200 by Cash payment mode added to sale  1684412817 by Administrator  CAMERA 20 on 2023-05-18 15:32:52', '2023-05-18', '15:32:52'),
('1684413213', '1684412286', '00000000', 'Create', 'Payment M1684413213 of Ksh 300 by Mpesa payment mode added to sale  1684412817 by Administrator  CAMERA 20 on 2023-05-18 15:33:33', '2023-05-18', '15:33:33'),
('1684413253', '1684412286', '00000000', 'Create', 'Payment C1684413253 of Ksh 95 by Cash payment mode added to sale  1684412817 by Administrator  CAMERA 20 on 2023-05-18 15:34:13', '2023-05-18', '15:34:13'),
('1684413837', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-05-18', '15:43:57'),
('1685106725', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-05-26', '16:12:05'),
('1685106733', '1685106733', '00000000', 'Login', 'Administrator  Logged in at 2023-05-26 16:12:13', '2023-05-26', '16:12:13'),
('1685106753', '1685106733', '00000000', 'Create', 'New sale (1685106753) initiated by Administrator  CAMERA 20 on 2023-05-26 16:12:33', '2023-05-26', '16:12:33'),
('1685106763', '1685106733', '00000000', 'Create', 'Item Maize 1kg Bags added to cart 1685106753 by Administrator  CAMERA 20 on 2023-05-26 16:12:43', '2023-05-26', '16:12:43'),
('1685106780', '1685106733', '00000000', 'Create', 'Item Kasuku Foolscaps 80 pages added to cart 1685106753 by Administrator  CAMERA 20 on 2023-05-26 16:13:00', '2023-05-26', '16:13:00'),
('1685106802', '1685106733', '00000000', 'Create', 'Payment M1685106802 of Ksh 625 by Mpesa payment mode added to sale  1685106753 by Administrator  CAMERA 20 on 2023-05-26 16:13:22', '2023-05-26', '16:13:22'),
('1687165053', '0', 'GUEST', 'Access', 'Accessed Login Page', '2023-06-19', '11:57:33');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` varchar(255) NOT NULL,
  `sale_id` varchar(255) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_date` varchar(255) NOT NULL,
  `payment_time` varchar(255) NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `total_price` decimal(65,2) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `balanceNotPaid` decimal(65,2) NOT NULL,
  `createdBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `sale_id`, `payment_type`, `payment_date`, `payment_time`, `amount`, `total_price`, `remarks`, `balanceNotPaid`, `createdBy`) VALUES
('C1680686189', '1680611392', 'Cash', '2023-04-05', '12:16:29', '2190.00', '2190.00', 'A Payment of Ksh 3000 plus a payment of Ksh 0 done previously has been successful. Please give the customer a balance of Ksh 810', '0.00', '00000000'),
('C1684413172', '1684412817', 'Cash', '2023-05-18', '15:32:52', '200.00', '595.00', 'A Payment of Ksh 200 as been done and saved, please Ask the customer for more payment of Ksh 395 to complete the sale.', '395.00', '00000000'),
('C1684413253', '1684412817', 'Cash', '2023-05-18', '15:34:13', '95.00', '595.00', 'A Payment of Ksh 100 plus a payment of Ksh 500.00 done previously has been successful. Please give the customer a balance of Ksh 5', '0.00', '00000000'),
('M1684413213', '1684412817', 'Mpesa', '2023-05-18', '15:33:33', '300.00', '595.00', 'A Payment of Ksh 500 as been done and saved, please Ask the customer for more payment of Ksh 95 to complete the sale.', '95.00', '00000000'),
('M1685106802', '1685106753', 'Mpesa', '2023-05-26', '16:13:22', '625.00', '625.00', 'A Payment of Ksh 1000 plus a payment of Ksh 0 done previously has been successful. Please give the customer a balance of Ksh 375', '0.00', '00000000');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_sku` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `regular_price` decimal(65,2) NOT NULL,
  `sale_price` decimal(65,2) NOT NULL,
  `stock` decimal(65,2) NOT NULL,
  `category` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_sku`, `product_name`, `regular_price`, `sale_price`, `stock`, `category`, `createdBy`) VALUES
('1679665355', 'Maize 1kg Bags', '100.00', '150.00', '1.00', 'DRY FOOD', ''),
('1679998006', 'Green Grams 1Kg', '100.00', '140.00', '17.00', 'DRY FOOD', ''),
('1679999499', 'Chips at 50', '30.00', '50.00', '62.00', 'FAST FOODS', ''),
('1680589685', 'Ice cream - Vanilla 150ml', '10.00', '30.00', '330.00', 'FAST FOODS', ''),
('1680695701', 'Chapati', '12.50', '20.00', '15.00', 'FAST FOODS', '00000000'),
('1684412439', 'Kasuku Foolscaps 80 pages', '45.00', '65.00', '46.00', 'STATIONERY', '00000000');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `sale_id` varchar(255) NOT NULL,
  `sale_date` varchar(255) NOT NULL,
  `sale_time` varchar(255) NOT NULL,
  `amount` decimal(65,2) NOT NULL,
  `paid_amount` decimal(65,2) NOT NULL,
  `pay_method` varchar(255) NOT NULL,
  `sale_status` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`sale_id`, `sale_date`, `sale_time`, `amount`, `paid_amount`, `pay_method`, `sale_status`, `createdBy`) VALUES
('1680611392', '2023-04-04', '15:29:52', '2190.00', '3000.00', 'Cash', 'Complete', '00000000'),
('1680612317', '2023-04-04', '15:45:17', '3000.00', '0.00', '', 'Payment Initiated', '35232699'),
('1680682582', '2023-04-05', '11:16:22', '600.00', '0.00', '', 'IA, Pending Payment', '00000000'),
('1680693451', '2023-04-05', '14:17:31', '0.00', '0.00', '', 'Sale Initiated', '00000000'),
('1681891378', '2023-04-19', '11:02:58', '0.00', '0.00', '', 'Sale Initiated', '00000000'),
('1684412817', '2023-05-18', '15:26:57', '595.00', '600.00', 'Cash', 'Complete', '00000000'),
('1685106753', '2023-05-26', '16:12:33', '625.00', '1000.00', 'Mpesa', 'Payment Initiated', '00000000');

-- --------------------------------------------------------

--
-- Table structure for table `sale_item`
--

CREATE TABLE `sale_item` (
  `item_sale_id` varchar(255) NOT NULL,
  `product_sku` varchar(255) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `sale_id` varchar(255) NOT NULL,
  `quantity` decimal(65,2) NOT NULL,
  `price_per_unit` decimal(65,2) NOT NULL,
  `total_price` decimal(65,2) NOT NULL,
  `total_buying_price` decimal(65,2) NOT NULL,
  `total_profit` decimal(65,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sale_item`
--

INSERT INTO `sale_item` (`item_sale_id`, `product_sku`, `product_name`, `sale_id`, `quantity`, `price_per_unit`, `total_price`, `total_buying_price`, `total_profit`) VALUES
('16796649171680609067', '1679664917', 'Beans 1kg Bags', '1680609067', '1.20', '150.00', '180.00', '144.00', '36.00'),
('16796649171680611392', '1679664917', 'Beans 1kg Bags', '1680611392', '5.00', '150.00', '750.00', '600.00', '150.00'),
('16796649171680612317', '1679664917', 'Beans 1kg Bags', '1680612317', '20.00', '150.00', '3000.00', '2400.00', '600.00'),
('16796653551680609067', '1679665355', 'Maize 1kg Bags', '1680609067', '10.00', '150.00', '1500.00', '1000.00', '500.00'),
('16796653551680611392', '1679665355', 'Maize 1kg Bags', '1680611392', '5.00', '150.00', '750.00', '500.00', '250.00'),
('16796653551680682582', '1679665355', 'Maize 1kg Bags', '1680682582', '4.00', '150.00', '600.00', '400.00', '200.00'),
('16796653551684412817', '1679665355', 'Maize 1kg Bags', '1684412817', '2.00', '150.00', '300.00', '200.00', '100.00'),
('16796653551685106753', '1679665355', 'Maize 1kg Bags', '1685106753', '2.00', '150.00', '300.00', '200.00', '100.00'),
('16799994991680609067', '1679999499', 'Chips at 50', '1680609067', '10.00', '50.00', '500.00', '300.00', '200.00'),
('16799994991680611392', '1679999499', 'Chips at 50', '1680611392', '12.00', '50.00', '600.00', '360.00', '240.00'),
('16799994991684412817', '1679999499', 'Chips at 50', '1684412817', '2.00', '50.00', '100.00', '60.00', '40.00'),
('16805896851680611392', '1680589685', 'Ice cream - Vanilla 150ml', '1680611392', '3.00', '30.00', '90.00', '30.00', '60.00'),
('16844124391684412817', '1684412439', 'Kasuku Foolscaps 80 pages', '1684412817', '3.00', '65.00', '195.00', '135.00', '60.00'),
('16844124391685106753', '1684412439', 'Kasuku Foolscaps 80 pages', '1685106753', '5.00', '65.00', '325.00', '225.00', '100.00');

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `session_iddata` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `device` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `browser` varchar(255) NOT NULL,
  `browser_version` varchar(255) NOT NULL,
  `os_platform` varchar(255) NOT NULL,
  `pattern` varchar(255) NOT NULL,
  `date_time` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`session_iddata`, `user_id`, `ip_address`, `device`, `user_agent`, `browser`, `browser_version`, `os_platform`, `pattern`, `date_time`) VALUES
('1680611306', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 'Chrome', '111.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-04-04 15:28:26'),
('1680611318', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 'Chrome', '111.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-04-04 15:28:38'),
('1680611365', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 'Chrome', '111.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-04-04 15:29:25'),
('1680611610', '35232699', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36 Edg/111.0.1661.62', 'Chrome', '111.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-04-04 15:33:30'),
('1680675778', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 'Chrome', '111.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-04-05 09:22:58'),
('1680694265', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/111.0.0.0 Safari/537.36', 'Chrome', '111.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-04-05 14:31:05'),
('1681891364', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'Chrome', '112.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-04-19 11:02:44'),
('1683004719', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/112.0.0.0 Safari/537.36', 'Chrome', '112.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-05-02 08:18:39'),
('1684411355', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Chrome', '113.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-05-18 15:02:35'),
('1684411411', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Chrome', '113.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-05-18 15:03:31'),
('1684412286', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Chrome', '113.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-05-18 15:18:06'),
('1685106733', '00000000', '::1', 'Desktop', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', 'Chrome', '113.0.0.0', 'Windows', '#(?<browser>Version|Chrome|other)[/ ]+(?<version>[0-9.|a-zA-Z.]*)#', '2023-05-26 16:12:13');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_fname` varchar(255) NOT NULL,
  `user_oname` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `user_status` varchar(255) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `error_times` varchar(255) NOT NULL,
  `added_on` varchar(255) NOT NULL,
  `createdBy` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `user_email`, `user_fname`, `user_oname`, `phone_number`, `user_type`, `user_status`, `user_password`, `error_times`, `added_on`, `createdBy`) VALUES
('00000000', 'admin@camera20production.co.ke', 'Administrator ', 'CAMERA 20', '0796096678', 'Admin', '1', '$2y$10$TSvK/AqlYp4bbnewSSURP.ElM2oNjTpJW599VBaT57akhS/jWBNmK', '', '2023-04-04 10:31:23', ''),
('123456789', 'mutuma@eelam.co.ke', 'Franklin', 'Mutuma', '0796096678', 'Admin', '1', '', '', '2023-05-18 15:11:31', '00000000'),
('35232699', 'framutuma@gmail.com', 'Franklin', 'Mutuma', '0796096678', 'Admin', '1', '$2y$10$BM6JUqLZ0yQpmfCe5KNTz.Mmfs7OTEniKDUpR7fhVOmriNYufrKsi', '', '2023-04-04 12:11:05', '00000000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_name`);

--
-- Indexes for table `expense`
--
ALTER TABLE `expense`
  ADD PRIMARY KEY (`expense_ID`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_sku`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`sale_id`);

--
-- Indexes for table `sale_item`
--
ALTER TABLE `sale_item`
  ADD PRIMARY KEY (`item_sale_id`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`session_iddata`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
