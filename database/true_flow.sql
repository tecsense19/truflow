-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 25, 2023 at 07:40 AM
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
-- Table structure for table `add_to_cart`
--

CREATE TABLE `add_to_cart` (
  `cart_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `product_quantity` varchar(255) NOT NULL,
  `product_amount` varchar(255) NOT NULL,
  `product_discount` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_to_cart`
--

INSERT INTO `add_to_cart` (`cart_id`, `user_id`, `category_id`, `sub_category_id`, `product_id`, `variant_id`, `product_quantity`, `product_amount`, `product_discount`, `total_amount`, `created_at`, `updated_at`) VALUES
(1, 5, 2, 3, 2, 2, '10', '500', '', '5000.00', '2023-05-23 00:19:09', '2023-05-23 00:19:09'),
(2, 5, 2, 3, 2, 5, '5', '400', '', '2000.00', '2023-05-23 00:19:09', '2023-05-23 00:19:09'),
(3, 4, 1, 4, 1, 1, '10', '50', '', '500.00', '2023-05-23 00:20:49', '2023-05-23 00:20:49'),
(4, 4, 2, 3, 3, 7, '5', '200', '', '1000.00', '2023-05-23 00:22:10', '2023-05-23 00:22:10'),
(5, 5, 1, 4, 1, 6, '3', '300', '', '900.00', '2023-05-23 00:22:53', '2023-05-23 00:22:53');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL,
  `category_description` text DEFAULT NULL,
  `category_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `category_name`, `category_description`, `category_img`, `created_at`, `updated_at`) VALUES
(1, 'category 1', 'tedfsfsdfs', 'public/admin/images/category/1684992888_categoryImg_p2.png', '2023-05-15 00:21:24', '2023-05-25 00:04:48'),
(2, 'category 2', 'asdasdasd', 'public/admin/images/category/1684992897_categoryImg_p7.png', '2023-05-15 00:21:36', '2023-05-25 00:04:57'),
(3, 'category 3', 'asdasdasd', 'public/admin/images/category/1684992907_categoryImg_p2.png', '2023-05-15 00:21:49', '2023-05-25 00:05:07'),
(4, 'category 4', 'asdasdasdasd', 'public/admin/images/category/1684992920_categoryImg_p4.png', '2023-05-15 00:22:01', '2023-05-25 00:05:20');

-- --------------------------------------------------------

--
-- Table structure for table `header_menu`
--

CREATE TABLE `header_menu` (
  `header_id` int(11) NOT NULL,
  `header_menu` varchar(255) DEFAULT NULL,
  `menu_link` text DEFAULT NULL,
  `header_sub_menu` varchar(255) DEFAULT NULL,
  `sub_menu_link` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `header_menu`
--

INSERT INTO `header_menu` (`header_id`, `header_menu`, `menu_link`, `header_sub_menu`, `sub_menu_link`, `created_at`, `updated_at`) VALUES
(1, 'HOME', NULL, '-', NULL, '2023-05-15 05:08:46', '2023-05-15 05:39:54'),
(2, 'ABOUT US', 'about', '-', '', '2023-05-15 05:10:48', '2023-05-15 11:35:00'),
(3, 'OUR PRODUCTS', NULL, '-', NULL, '2023-05-15 05:11:14', '2023-05-15 05:11:14'),
(6, 'SHOP', 'shop', '-', '-', '2023-05-15 05:50:51', '2023-05-15 06:20:27');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `product_name` varchar(255) DEFAULT NULL,
  `product_img` varchar(255) DEFAULT NULL,
  `product_price` varchar(255) DEFAULT NULL,
  `product_description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `category_id`, `sub_category_id`, `product_name`, `product_img`, `product_price`, `product_description`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 'HYDRAULIC', 'public/admin/images/product/1684992747_productImg_p3.png', NULL, 'test test test test test test test test test test test test', '2023-05-16 07:54:49', '2023-05-25 00:02:27'),
(2, 2, 3, 'product 1', 'public/admin/images/product/1684396581_productImg_p7.png', NULL, 'sadasd', '2023-05-16 07:56:06', '2023-05-18 02:26:21'),
(3, 2, 3, 'product 2', 'public/admin/images/product/1684992755_productImg_s1.png', NULL, 'dadsadas dadsadas dadsadas dadsadas', '2023-05-16 08:02:30', '2023-05-25 00:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `variant_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_name` varchar(255) DEFAULT NULL,
  `variant_qty` varchar(255) DEFAULT NULL,
  `variant_price` varchar(255) DEFAULT NULL,
  `variant_sku` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`variant_id`, `product_id`, `variant_name`, `variant_qty`, `variant_price`, `variant_sku`, `created_at`, `updated_at`) VALUES
(1, 1, 'variant 1', '500', '50', 'BPF-WELD 1', '2023-05-16 07:54:49', '2023-05-25 00:02:27'),
(2, 2, 'variant 2', '0', '500', 'BPF-WELD 2', '2023-05-16 07:56:06', '2023-05-18 11:59:13'),
(3, 2, 'variant 3', '0', '100', 'BPF-WELD 33', '2023-05-16 07:56:32', '2023-05-18 11:59:18'),
(4, 2, 'variant 4', '0', '100', 'EDRE-WELD', '2023-05-16 07:56:32', '2023-05-18 11:59:30'),
(5, 2, 'variant 5', '0', '400', 'HTR-REDSW', '2023-05-16 08:01:12', '2023-05-18 12:00:06'),
(6, 1, 'variant 6', '600', '300', 'ERER-QQA', '2023-05-16 08:01:36', '2023-05-25 00:02:27'),
(7, 3, 'variant 7', '40', '200', 'BPF-WELD 1', '2023-05-16 08:02:30', '2023-05-25 00:02:35');

-- --------------------------------------------------------

--
-- Table structure for table `settings_images`
--

CREATE TABLE `settings_images` (
  `image_id` int(11) NOT NULL,
  `setting_id` int(11) NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings_images`
--

INSERT INTO `settings_images` (`image_id`, `setting_id`, `image_path`, `created_at`, `updated_at`) VALUES
(42, 1, 'public/front/images/home/1683790955_bannerImg_679247241.png', '2023-05-11 02:12:35', '2023-05-11 02:12:35'),
(43, 6, 'public/front/images/partner_images/1683790955_bannerImg_pl1.png', '2023-05-11 02:12:36', '2023-05-11 02:12:36'),
(44, 6, 'public/front/images/partner_images/1683790956_bannerImg_pl2.png', '2023-05-11 02:12:36', '2023-05-11 02:12:36');

-- --------------------------------------------------------

--
-- Table structure for table `site_settings`
--

CREATE TABLE `site_settings` (
  `setting_id` int(11) NOT NULL,
  `title` text DEFAULT NULL,
  `sub_title` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `button_text` varchar(255) DEFAULT NULL,
  `button_link` text DEFAULT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `site_settings`
--

INSERT INTO `site_settings` (`setting_id`, `title`, `sub_title`, `description`, `button_text`, `button_link`, `type`, `created_at`, `updated_at`) VALUES
(1, 'WELCOME TO,', 'TRUFLOW HYDRAULICS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. A donec velit, et tempor, sit turpis. Ut posuere quisque sagittis leo massa est est felis. Enim diam et nisi, nunc amet pretium.', 'CALL NOW', 'https://www.google.com/', 'welcome', '2023-05-09 04:28:30', '2023-05-15 05:17:09'),
(2, 'About Us', 'TRUFLOW HYDRAULICS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. A donec velit, et tempor, sit turpis. Ut posuere quisque sagittis leo massa est est felis. Enim diam et nisi, nunc amet pretium. Sem vel commodo proin proin proin nec, arcu semper.Lorem ipsum dolor sit amet, consectetur adipiscing elit. A donec velit, et tempor, sit turpis. Ut posuere quisque sagittis leo massa est est felis. Enim diam et nisi, nunc amet pretium. Sem vel commodo proin proin proin nec, arcu semper.Lorem ipsum dolor sit amet,', 'Read More', 'https://www.google.com/', 'about', '2023-05-08 23:12:50', '2023-05-15 05:17:09'),
(3, 'Lorem ipsum dolor sit amet.', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor.', 'Contact Us', 'https://www.google.com/', 'contact', '2023-05-08 23:31:15', '2023-05-15 05:17:09'),
(4, 'OUR PRODUCTS', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.', '', '', 'product', '2023-05-08 23:31:15', '2023-05-15 05:17:09'),
(5, 'Client Testimonials', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.', '', '', 'testominal', '2023-05-08 23:31:15', '2023-05-15 05:17:09'),
(6, 'PARTNER LOGO', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.', '', '', 'partner', '2023-05-08 23:31:15', '2023-05-15 05:17:09');

-- --------------------------------------------------------

--
-- Table structure for table `sub_category`
--

CREATE TABLE `sub_category` (
  `sub_category_id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `sub_category_name` varchar(255) DEFAULT NULL,
  `sub_category_description` varchar(255) DEFAULT NULL,
  `sub_category_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sub_category`
--

INSERT INTO `sub_category` (`sub_category_id`, `category_id`, `sub_category_name`, `sub_category_description`, `sub_category_img`, `created_at`, `updated_at`) VALUES
(1, 2, 'sub cat 1', 'asdasdas', 'public/admin/images/sub_category/1684992772_sub_categoryImg_p6.png', '2023-05-15 00:22:30', '2023-05-25 00:02:52'),
(2, 3, 'sub cat 2', 'asdsadas', 'public/admin/images/sub_category/1684992781_sub_categoryImg_s3.png', '2023-05-15 00:22:47', '2023-05-25 00:03:01'),
(3, 2, 'sub category 2', 'asdasdas', 'public/admin/images/sub_category/1684992793_sub_categoryImg_p1.png', '2023-05-15 08:23:10', '2023-05-25 00:03:13'),
(4, 1, 'sub cat 1', 'test,test,test', 'public/admin/images/sub_category/1684992803_sub_categoryImg_s2.png', '2023-05-16 00:54:55', '2023-05-25 00:03:23'),
(5, 3, 'sub cat 3', 'dsasdasda', 'public/admin/images/sub_category/1684992811_sub_categoryImg_p8.png', '2023-05-16 00:55:21', '2023-05-25 00:03:31'),
(6, 4, 'sub cat 4', 'asdasdasdasdasdasasdasdasdasdasdasasdasdasdasdasdasasdasdasdasdasdas', 'public/admin/images/sub_category/1684992822_sub_categoryImg_p2.png', '2023-05-16 00:55:49', '2023-05-25 00:03:42'),
(7, 1, 'sub cat 1_1', 'asdasdasdasdasdasasdasdasdasdasdas', 'public/admin/images/sub_category/1684992832_sub_categoryImg_bg-img.png', '2023-05-16 00:56:11', '2023-05-25 00:03:52'),
(8, 2, 'sub cat 2_2', 'asdasdasdasdasdasasdasdasdasdasdas', 'public/admin/images/sub_category/1684992843_sub_categoryImg_p4.png', '2023-05-16 00:56:37', '2023-05-25 00:04:03'),
(9, 2, 'sub cat 2_3', 'asdasd', 'public/admin/images/sub_category/1684992852_sub_categoryImg_p5.png', '2023-05-16 00:56:57', '2023-05-25 00:04:12'),
(10, 2, 'sub cat 2_4', 'asdasdsa', 'public/admin/images/sub_category/1684992868_sub_categoryImg_p4.png', '2023-05-16 00:57:15', '2023-05-25 00:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE `tbl_order` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `cart_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `sub_category_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant_id` int(11) NOT NULL,
  `product_quantity` varchar(255) DEFAULT NULL,
  `product_amount` varchar(255) DEFAULT NULL,
  `product_discount` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `pay_method` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `testominal`
--

CREATE TABLE `testominal` (
  `testimo_id` int(11) NOT NULL,
  `full_name` text DEFAULT NULL,
  `designation` text DEFAULT NULL,
  `description` text DEFAULT NULL,
  `testimo_img` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testominal`
--

INSERT INTO `testominal` (`testimo_id`, `full_name`, `designation`, `description`, `testimo_img`, `created_at`, `updated_at`) VALUES
(2, 'nadim', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,', 'public/front/images/testominal/1683790807_testominalImg_client.png', '2023-05-11 01:49:23', '2023-05-11 02:10:07'),
(3, 'Ravi', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,', 'public/front/images/testominal/1683790795_testominalImg_client.png', '2023-05-11 01:49:48', '2023-05-11 02:09:55'),
(4, 'Bhavin', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,', 'public/front/images/testominal/1683790821_testominalImg_client.png', '2023-05-11 01:50:11', '2023-05-11 02:10:21'),
(5, 'Gautam', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,', 'public/front/images/testominal/1683790785_testominalImg_client.png', '2023-05-11 02:06:08', '2023-05-11 02:09:45'),
(6, 'Darshit', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,', 'public/front/images/testominal/1683790768_testominalImg_client.png', '2023-05-11 02:06:20', '2023-05-11 02:09:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` varchar(5) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `first_name`, `last_name`, `gender`, `date_of_birth`, `mobile`, `email`, `password`, `user_role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Trueflow Admin', NULL, NULL, NULL, NULL, NULL, 'trueflow@admin.com', '123456', 'Admin', '2023-05-04 13:57:47', '2023-05-04 13:57:47', '2023-05-04 13:57:47'),
(2, 'sdfsd sdfdsf', 'sdfsd', 'sdfdsf', 'male', '2023-05-11', '1231231234', 'bhasavin@tec-sense.com', '123456', 'user', '2023-05-22 13:38:48', '2023-05-22 13:38:48', '0000-00-00 00:00:00'),
(3, 'asdasd asdsadas', 'asdasd', 'asdsadas', 'male', '2023-05-19', '7043619433', 'sbhavin@tec-sense.com', '123456', 'user', '2023-05-22 13:41:33', '2023-05-22 13:41:33', '0000-00-00 00:00:00'),
(4, 'sdfsdf sdfsdf', 'sdfsdf', 'sdfsdf', 'femal', '2023-05-08', '1231231234', 'bhavin@tec-sense.com', '$2y$10$2D0PPq.JlM5yxa.EqSQkq.bwvlDn/VVS6RGyc0HiQvX/G5E2Z2geG', 'user', '2023-05-22 13:43:02', '2023-05-22 13:43:02', '0000-00-00 00:00:00'),
(5, 'Tommy test ', 'Tommy', 'test ', 'femal', '2023-02-02', '7043619433', 'nadim@tec-sense.com', '$2y$10$eOdUNstneRt3gC3MFnDpOOMtaLL2vkqCtEym31SsN5BT52xe.GR1C', 'user', '2023-05-22 13:51:05', '2023-05-22 13:51:05', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  ADD PRIMARY KEY (`cart_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `header_menu`
--
ALTER TABLE `header_menu`
  ADD PRIMARY KEY (`header_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`variant_id`);

--
-- Indexes for table `settings_images`
--
ALTER TABLE `settings_images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `setting_id` (`setting_id`);

--
-- Indexes for table `site_settings`
--
ALTER TABLE `site_settings`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `sub_category`
--
ALTER TABLE `sub_category`
  ADD PRIMARY KEY (`sub_category_id`);

--
-- Indexes for table `tbl_order`
--
ALTER TABLE `tbl_order`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `testominal`
--
ALTER TABLE `testominal`
  ADD PRIMARY KEY (`testimo_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `header_menu`
--
ALTER TABLE `header_menu`
  MODIFY `header_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `settings_images`
--
ALTER TABLE `settings_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `testominal`
--
ALTER TABLE `testominal`
  MODIFY `testimo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `settings_images`
--
ALTER TABLE `settings_images`
  ADD CONSTRAINT `settings_images_ibfk_1` FOREIGN KEY (`setting_id`) REFERENCES `site_settings` (`setting_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
