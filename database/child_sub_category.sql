-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2023 at 12:20 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `true_flow`
--

-- --------------------------------------------------------

--
-- Table structure for table `child_sub_category`
--

CREATE TABLE `child_sub_category` (
  `child_id` int(11) NOT NULL,
  `sub_chid_id` int(11) NOT NULL DEFAULT 0,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `child_sub_category_name` varchar(255) NOT NULL,
  `child_sub_existing` int(11) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `child_sub_category`
--

INSERT INTO `child_sub_category` (`child_id`, `sub_chid_id`, `category_id`, `sub_category_id`, `child_sub_category_name`, `child_sub_existing`, `created_at`, `updated_at`) VALUES
(45, 0, 1, 1, 'Gautam 1.1', 0, '2023-07-18 09:42:44', '2023-07-18 09:42:44'),
(53, 0, 1, 2, 'Test 1', 0, '2023-07-18 10:10:09', '2023-07-18 10:10:09'),
(54, 53, 1, 2, 'Test 2', 0, '2023-07-18 10:10:19', '2023-07-18 10:10:19'),
(55, 45, 1, 1, 'Gautam 1.2', 0, '2023-07-18 10:11:47', '2023-07-18 10:11:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `child_sub_category`
--
ALTER TABLE `child_sub_category`
  ADD PRIMARY KEY (`child_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `child_sub_category`
--
ALTER TABLE `child_sub_category`
  MODIFY `child_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
