-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 05, 2024 at 03:41 AM
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
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `daily_sales`
--

CREATE TABLE `daily_sales` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `total_sales` decimal(10,2) NOT NULL,
  `number_of_orders` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_sales`
--

INSERT INTO `daily_sales` (`id`, `date`, `total_sales`, `number_of_orders`) VALUES
(1, '2024-10-04', 2609.00, 134),
(2, '2024-10-04', 2609.00, 134),
(3, '2024-10-04', 2609.00, 134),
(4, '2024-10-04', 2609.00, 134),
(5, '2024-10-04', 2609.00, 134),
(6, '2024-10-04', 2609.00, 134),
(7, '2024-10-04', 2609.00, 134),
(8, '2024-10-04', 2609.00, 134),
(9, '2024-10-04', 2609.00, 134),
(10, '2024-10-04', 2609.00, 134),
(11, '2024-10-04', 2609.00, 134),
(12, '2024-10-04', 2609.00, 134),
(13, '2024-10-04', 2609.00, 134),
(14, '2024-10-04', 2609.00, 134),
(15, '2024-10-04', 2609.00, 134),
(16, '2024-10-04', 2609.00, 134),
(17, '2024-10-04', 2609.00, 134),
(18, '2024-10-04', 2609.00, 134),
(19, '2024-10-04', 2609.00, 134),
(20, '2024-10-05', 700.00, 13);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `product` varchar(255) NOT NULL,
  `size` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `username`, `product`, `size`, `quantity`, `total_price`, `date`) VALUES
(1, 'Foga', 'Milk Tea', 'Medium', 2, 30.00, '2024-10-03 23:05:27'),
(2, 'Test', 'Chocolate Cake', 'Large', 1, 20.00, '2024-10-03 23:16:01'),
(3, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-03 23:18:39'),
(4, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-03 23:18:39'),
(5, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-03 23:18:40'),
(6, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-03 23:18:40'),
(7, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-03 23:19:43'),
(8, 'Test', 'Iced Coffee', 'Medium', 1, 0.00, '2024-10-03 23:36:45'),
(9, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 08:55:16'),
(10, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 08:55:16'),
(11, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 08:55:16'),
(12, 'Test', 'Iced Coffee', 'Large', 4, 88.00, '2024-10-04 08:55:16'),
(13, 'Test', 'Milk Tea', 'Large', 11, 220.00, '2024-10-04 08:55:46'),
(14, 'Test', 'Iced Coffee', 'Medium', 4, 68.00, '2024-10-04 17:07:19'),
(15, 'Test', 'Fruit Tea', 'Large', 1, 25.00, '2024-10-04 17:07:19'),
(16, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 17:07:19'),
(17, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 17:33:34'),
(18, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 17:33:34'),
(19, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-04 17:33:34'),
(20, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 17:33:34'),
(21, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 17:42:36'),
(22, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 17:42:36'),
(23, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 17:42:36'),
(24, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 17:42:36'),
(25, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 17:42:36'),
(26, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-04 17:42:36'),
(27, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-04 17:42:36'),
(28, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 18:14:04'),
(29, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-04 18:14:04'),
(30, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-04 18:14:04'),
(31, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 18:14:04'),
(32, 'Test', 'Fruit Tea', 'Small', 1, 15.00, '2024-10-04 18:14:04'),
(33, 'Test', 'Fruit Tea', 'Small', 1, 15.00, '2024-10-04 18:14:04'),
(34, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 18:14:04'),
(35, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 18:14:04'),
(36, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 18:23:37'),
(37, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 18:23:37'),
(38, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-04 18:23:37'),
(39, 'Test', 'Fruit Tea', 'Medium', 1, 20.00, '2024-10-04 18:23:37'),
(40, 'Test', 'Fruit Tea', 'Medium', 1, 20.00, '2024-10-04 18:23:37'),
(41, 'FOGA', 'Fruit Tea', 'Small', 1, 15.00, '2024-10-04 19:41:44'),
(42, 'FOGA', 'Fruit Tea', 'Small', 1, 15.00, '2024-10-04 19:41:44'),
(43, 'FOGA', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 19:41:44'),
(44, 'FOGA', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 19:41:44'),
(45, 'FOGA', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 19:41:44'),
(46, 'FOGA', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 19:41:44'),
(47, 'FOGA', 'Fruit Tea', 'Medium', 1, 20.00, '2024-10-04 19:41:44'),
(48, 'Test', 'Milk Tea', 'Medium', 1, 15.00, '2024-10-04 21:16:16'),
(49, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 21:16:16'),
(50, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 21:16:16'),
(51, 'Test', 'Fruit Tea', 'Large', 11, 25.00, '2024-10-04 21:16:16'),
(52, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 21:17:45'),
(53, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 21:17:45'),
(54, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 21:17:45'),
(55, 'Test', 'Milk Tea', 'Large', 4, 20.00, '2024-10-04 21:27:17'),
(56, 'Test', 'Milk Tea', 'Large', 12, 20.00, '2024-10-04 21:27:40'),
(57, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 21:27:59'),
(58, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 21:27:59'),
(59, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 21:27:59'),
(60, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 21:27:59'),
(61, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 21:27:59'),
(62, 'Test', 'Iced Coffee', 'Large', 1, 22.00, '2024-10-04 21:27:59'),
(63, 'Test', 'Iced Coffee', 'Large', 20, 22.00, '2024-10-04 21:27:59'),
(64, 'Test', 'Iced Coffee', 'Large', 10, 22.00, '2024-10-04 21:28:39'),
(65, 'Test', 'Iced Coffee', 'Large', 10, 22.00, '2024-10-04 21:28:39'),
(66, 'Test', 'Iced Coffee', 'Large', 10, 22.00, '2024-10-04 21:28:39'),
(67, 'Test', 'Iced Coffee', 'Large', 10, 22.00, '2024-10-04 21:28:39'),
(68, 'Test', 'Iced Coffee', 'Large', 10, 22.00, '2024-10-04 21:28:39'),
(69, 'Test', 'Iced Coffee', 'Large', 10, 22.00, '2024-10-04 21:28:39'),
(70, 'Test', 'Fruit Tea', 'Large', 20, 25.00, '2024-10-04 21:31:50'),
(71, 'Test', 'Fruit Tea', 'Large', 19, 25.00, '2024-10-04 21:34:01'),
(72, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:34:14'),
(73, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:34:14'),
(74, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:34:14'),
(75, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:34:14'),
(76, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:34:14'),
(77, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:34:14'),
(78, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:34:14'),
(79, 'Test', 'Fruit Tea', 'Large', 1, 25.00, '2024-10-04 21:34:28'),
(80, 'Test', 'Fruit Tea', 'Large', 1, 25.00, '2024-10-04 21:34:28'),
(81, 'Test', 'Fruit Tea', 'Large', 1, 25.00, '2024-10-04 21:34:28'),
(82, 'Test', 'Fruit Tea', 'Large', 1, 25.00, '2024-10-04 21:34:28'),
(83, 'Test', 'Fruit Tea', 'Large', 1, 25.00, '2024-10-04 21:34:28'),
(84, 'Test', 'Fruit Tea', 'Large', 1, 25.00, '2024-10-04 21:34:28'),
(85, 'Test', 'Fruit Tea', 'Large', 1, 25.00, '2024-10-04 21:34:28'),
(86, 'Test', 'Fruit Tea', 'Large', 1, 25.00, '2024-10-04 21:34:28'),
(87, 'Test', 'Fruit Tea', 'Large', 1, 25.00, '2024-10-04 21:34:28'),
(88, 'Test', 'Fruit Tea', 'Large', 5, 25.00, '2024-10-04 21:34:28'),
(89, 'Test', 'Milk Tea', 'Large', 20, 20.00, '2024-10-04 21:39:25'),
(90, 'Test', 'Milk Tea', 'Small', 20, 10.00, '2024-10-04 21:39:46'),
(91, 'Test', 'Milk Tea', 'Medium', 1, 15.00, '2024-10-04 21:47:43'),
(92, 'Test', 'Milk Tea', 'Medium', 1, 15.00, '2024-10-04 21:47:43'),
(93, 'Test', 'Milk Tea', 'Medium', 1, 15.00, '2024-10-04 21:47:43'),
(94, 'Test', 'Milk Tea', 'Small', 7, 10.00, '2024-10-04 21:47:43'),
(95, 'Test', 'Fruit Tea', 'Medium', 4, 20.00, '2024-10-04 21:47:43'),
(96, 'Test', 'Milk Tea', 'Large', 5, 20.00, '2024-10-04 21:48:06'),
(97, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:50:27'),
(98, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:50:27'),
(99, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:50:27'),
(100, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 21:50:27'),
(101, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 21:50:46'),
(102, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 21:50:46'),
(103, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 21:50:46'),
(104, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 21:50:46'),
(105, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 21:50:46'),
(106, 'Test', 'Milk Tea', 'Large', 4, 20.00, '2024-10-04 22:02:06'),
(107, 'Test', 'Milk Tea', 'Large', 4, 20.00, '2024-10-04 22:02:06'),
(108, 'Test', 'Milk Tea', 'Large', 4, 20.00, '2024-10-04 22:02:06'),
(109, 'Test', 'Milk Tea', 'Large', 4, 20.00, '2024-10-04 22:02:06'),
(110, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 22:25:30'),
(111, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 22:25:30'),
(112, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 22:25:30'),
(113, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 22:25:30'),
(114, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 22:25:30'),
(115, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 22:25:30'),
(116, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-04 22:25:30'),
(117, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 22:25:30'),
(118, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 22:25:30'),
(119, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 22:25:30'),
(120, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 22:25:30'),
(121, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-04 22:25:30'),
(122, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-04 22:25:30'),
(123, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-04 22:25:30'),
(124, 'Test', 'Iced Coffee', 'Medium', 1, 17.00, '2024-10-04 22:25:30'),
(125, 'Test', 'Iced Coffee', 'Medium', 5, 17.00, '2024-10-04 22:25:30'),
(126, 'Test', 'Iced Coffee', 'Medium', 5, 17.00, '2024-10-04 22:25:30'),
(127, 'Test', 'Iced Coffee', 'Medium', 5, 17.00, '2024-10-04 22:25:31'),
(128, 'Test', 'Iced Coffee', 'Medium', 5, 17.00, '2024-10-04 22:25:31'),
(129, 'Test', 'Iced Coffee', 'Medium', 5, 17.00, '2024-10-04 22:25:31'),
(130, 'Test', 'Iced Coffee', 'Medium', 5, 17.00, '2024-10-04 22:25:31'),
(131, 'Test', 'Iced Coffee', 'Medium', 5, 17.00, '2024-10-04 22:25:31'),
(132, 'Test', 'Iced Coffee', 'Medium', 5, 17.00, '2024-10-04 22:25:31'),
(133, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 22:31:06'),
(134, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 22:31:06'),
(135, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 22:31:06'),
(136, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 22:31:06'),
(137, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 22:31:36'),
(138, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 22:31:36'),
(139, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 22:31:36'),
(140, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 22:31:36'),
(141, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-04 22:31:36'),
(142, 'Test', 'Milk Tea', 'Small', 5, 10.00, '2024-10-04 22:31:36'),
(143, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-05 03:23:08'),
(144, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-05 03:23:08'),
(145, 'Test', 'Milk Tea', 'Large', 1, 20.00, '2024-10-05 03:23:08'),
(146, 'Test', 'Fruit Tea', 'Small', 1, 15.00, '2024-10-05 03:23:08'),
(147, 'Test', 'Iced Coffee', 'Small', 1, 12.00, '2024-10-05 03:23:08'),
(148, 'Test', 'Jiuce', 'Medium', 1, 16.00, '2024-10-05 03:26:14'),
(149, 'Test', 'Jiuce', 'Medium', 1, 16.00, '2024-10-05 03:26:14'),
(150, 'Test', 'Jiuce', 'Medium', 1, 16.00, '2024-10-05 03:26:14'),
(151, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-05 03:29:29'),
(152, 'Test', 'Milk Tea', 'Small', 1, 10.00, '2024-10-05 03:29:29'),
(153, 'Test', 'Milk Tea', 'Large', 6, 20.00, '2024-10-05 03:30:30'),
(154, 'Test', 'Milk Tea', 'Large', 20, 400.00, '2024-10-05 03:38:24'),
(155, 'Test', 'Fruit Tea', 'Large', 5, 125.00, '2024-10-05 03:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price_small` decimal(10,2) NOT NULL,
  `price_medium` decimal(10,2) NOT NULL,
  `price_large` decimal(10,2) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price_small`, `price_medium`, `price_large`, `created_at`) VALUES
(4, 'Milk Tea', 10.00, 15.00, 20.00, '2024-10-04 13:15:01'),
(5, 'Fruit Tea', 15.00, 20.00, 25.00, '2024-10-04 13:15:43'),
(6, 'Iced Coffee', 12.00, 17.00, 22.00, '2024-10-04 13:16:16'),
(7, 'Jiuce', 12.00, 16.00, 23.00, '2024-10-04 18:25:53');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'f', '$2y$10$PfCivYEnH09VkAQ1lnzJmOWV8yZ0C0QTh2SaLYdbN9zs0.kVoP3Xi'),
(2, 'Foga', '$2y$10$cRe6iFv2U8ssyF.GZnQ9.eEhlZVnvbzM8lI0nbYaXe0TCvMt98mMC'),
(3, 'Test', '$2y$10$JHFZhDeJXLRiCmXYN7zeHevlBOeQos6EvHaxn7VH6wXqSMxMCim6O'),
(4, 'orga', '$2y$10$t885cc3wZTbUUFKzMUAwd.xpl7eLK/ENmTvYyFoD54P2s3oWX8fbK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daily_sales`
--
ALTER TABLE `daily_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daily_sales`
--
ALTER TABLE `daily_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=156;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
