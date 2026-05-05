-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 26, 2026 at 01:23 AM
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
-- Database: `lab_automation`
--

-- --------------------------------------------------------

--
-- Table structure for table `cpri_records`
--

CREATE TABLE `cpri_records` (
  `id` int(11) NOT NULL,
  `product_ref` int(11) NOT NULL,
  `sent_date` date DEFAULT NULL,
  `approval_status` varchar(50) DEFAULT NULL,
  `remarks` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_id` varchar(10) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_type` varchar(100) NOT NULL,
  `revision_no` varchar(10) DEFAULT NULL,
  `manufacturing_no` varchar(20) DEFAULT NULL,
  `manufacture_date` date DEFAULT NULL,
  `status` varchar(50) DEFAULT 'Pending Testing',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_id`, `product_name`, `product_type`, `revision_no`, `manufacturing_no`, `manufacture_date`, `status`, `created_at`) VALUES
(1, '2026000001', 'LCD', 'digital', '1', '1', '2026-04-22', 'Pass', '2026-04-22 09:45:53'),
(4, '2026000002', 'LCD', 'digital', '4', '4', '2026-04-22', 'pass', '2026-04-22 17:12:07'),
(7, '2026000003', 'LCD', 'digital', '7', '7', '2026-04-23', 'Pass', '2026-04-23 19:23:56'),
(8, '2026000004', 'Fuse Box', 'mechanical', '8', '8', '2026-04-23', 'Pending Testing', '2026-04-23 19:31:43'),
(9, '2026000005', 'Fuse Box', 'mechanical', '9', '9', '2026-04-23', 'Pending Testing', '2026-04-23 20:27:14'),
(10, '2026000006', 'LCD', 'digital', '10', '10', '2026-04-24', 'fail', '2026-04-24 20:40:38');

-- --------------------------------------------------------

--
-- Table structure for table `remanufacture`
--

CREATE TABLE `remanufacture` (
  `id` int(11) NOT NULL,
  `product_ref` int(11) NOT NULL,
  `reason` text DEFAULT NULL,
  `action_taken` text DEFAULT NULL,
  `date_sent` date DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `id` int(11) NOT NULL,
  `test_id` varchar(12) NOT NULL,
  `product_ref` int(11) NOT NULL,
  `test_type` varchar(100) NOT NULL,
  `department` varchar(100) DEFAULT NULL,
  `result` varchar(20) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `tested_by` int(11) DEFAULT NULL,
  `test_date` date DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`id`, `test_id`, `product_ref`, `test_type`, `department`, `result`, `remarks`, `tested_by`, `test_date`, `created_at`) VALUES
(5, '0000000001', 7, 'heat test', 'mechanical', 'pass', 'all good', 6, '2026-04-25', '2026-04-25 19:39:54'),
(7, '0000000002', 1, 'heat test', 'mechanical', 'pass', 'all good', 6, '2026-04-25', '2026-04-25 20:18:43'),
(9, '0000000003', 4, 'heat test', 'mechanical', 'pass', 'All Good', 6, '2026-04-25', '2026-04-25 20:21:17'),
(10, '0000000004', 10, 'heat test', 'mechanical', 'fail', 'melted', 7, '2026-04-25', '2026-04-25 22:12:35');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `password`, `role`, `created_at`) VALUES
(5, 'Faaiz', 'faaiz121', '1234567', 'admin', '2026-04-25 09:13:30'),
(6, 'Ali', 'ali121', '1234567', 'tester', '2026-04-25 19:24:28'),
(7, 'Bilawal', 'bilawal121', '1234567', 'tester', '2026-04-25 22:11:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cpri_records`
--
ALTER TABLE `cpri_records`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ref` (`product_ref`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `product_id` (`product_id`);

--
-- Indexes for table `remanufacture`
--
ALTER TABLE `remanufacture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ref` (`product_ref`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `test_id` (`test_id`),
  ADD KEY `product_ref` (`product_ref`),
  ADD KEY `tested_by` (`tested_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cpri_records`
--
ALTER TABLE `cpri_records`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `remanufacture`
--
ALTER TABLE `remanufacture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cpri_records`
--
ALTER TABLE `cpri_records`
  ADD CONSTRAINT `cpri_records_ibfk_1` FOREIGN KEY (`product_ref`) REFERENCES `products` (`id`);

--
-- Constraints for table `remanufacture`
--
ALTER TABLE `remanufacture`
  ADD CONSTRAINT `remanufacture_ibfk_1` FOREIGN KEY (`product_ref`) REFERENCES `products` (`id`);

--
-- Constraints for table `tests`
--
ALTER TABLE `tests`
  ADD CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`product_ref`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `tests_ibfk_2` FOREIGN KEY (`tested_by`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
