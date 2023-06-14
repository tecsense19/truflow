-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2023 at 07:20 AM
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
-- Table structure for table `addwish_list`
--

CREATE TABLE `addwish_list` (
  `wishid` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `isDeleted` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `shipping` varchar(255) DEFAULT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `final_total_ammount` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `add_to_cart`
--

INSERT INTO `add_to_cart` (`cart_id`, `user_id`, `category_id`, `sub_category_id`, `product_id`, `variant_id`, `product_quantity`, `product_amount`, `product_discount`, `total_amount`, `shipping`, `discount_type`, `final_total_ammount`, `coupon_code`, `created_at`, `updated_at`) VALUES
(1, 4, 1, 4, 5, 4, '2', '5000', '', '10000.00', NULL, NULL, NULL, NULL, '2023-06-12 04:51:05', '2023-06-12 04:51:05'),
(2, 4, 2, 6, 7, 7, '2', '700', '', '1400.00', NULL, NULL, NULL, NULL, '2023-06-12 04:52:41', '2023-06-12 04:52:41'),
(3, 4, 2, 6, 7, 7, '1', '700', '', '700.00', NULL, NULL, NULL, NULL, '2023-06-12 04:58:28', '2023-06-12 04:58:28'),
(62, 5, 2, 6, 7, 7, '1', '700', '', '700.00', NULL, NULL, NULL, NULL, '2023-06-13 04:31:16', '2023-06-13 04:31:16'),
(63, 5, 3, 2, 3, 2, '1', '1000', '', '1000.00', NULL, NULL, NULL, NULL, '2023-06-13 05:41:05', '2023-06-13 05:41:05');

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
(1, 'ADAPTORS', 'test', 'public/admin/images/category/1686027467_categoryImg_category-main-8.jpg', '2023-06-05 23:27:47', '2023-06-13 05:53:30'),
(2, 'HOSE TAIL', 'test', 'public/admin/images/category/1686027513_categoryImg_product-banner-2.jpg', '2023-06-05 23:28:33', '2023-06-05 23:58:35'),
(3, 'TUBE, TUBE FITTINGS AND ACCESSORIES', 'ghfgh', 'public/admin/images/category/1686655440_categoryImg_p2.png', '2023-06-05 23:29:01', '2023-06-13 05:54:00'),
(5, 'fghgf', 'fghfgh', 'public/admin/images/category/1686655425_categoryImg_p8.png', '2023-06-13 05:53:45', '2023-06-13 05:53:45');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `country_id` int(11) NOT NULL,
  `label` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `isdeleted` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`country_id`, `label`, `status`, `isdeleted`, `created_at`, `updated_at`) VALUES
(1, 'Australia', 0, 0, '0000-00-00 00:00:00', '2023-05-31 04:58:52'),
(4, 'New Zealand', NULL, 0, '2023-05-31 04:59:40', '2023-05-31 04:59:40');

-- --------------------------------------------------------

--
-- Table structure for table `coupon`
--

CREATE TABLE `coupon` (
  `coupon_id` int(11) NOT NULL,
  `coupon_code` varchar(20) NOT NULL,
  `coupon_price` varchar(255) NOT NULL,
  `coupon_price_type` varchar(20) NOT NULL,
  `coupon_type` varchar(255) NOT NULL,
  `user_id` text DEFAULT NULL,
  `category_id` text DEFAULT NULL,
  `sub_category_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `coupon_status` int(11) NOT NULL DEFAULT 0,
  `isDeleted` int(11) NOT NULL DEFAULT 0,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coupon`
--

INSERT INTO `coupon` (`coupon_id`, `coupon_code`, `coupon_price`, `coupon_price_type`, `coupon_type`, `user_id`, `category_id`, `sub_category_id`, `product_id`, `coupon_status`, `isDeleted`, `from_date`, `to_date`, `created_at`, `updated_at`) VALUES
(13, 'nadim', '10', 'Percentage', 'Global', '', '', NULL, NULL, 0, 0, '0000-00-00', '0000-00-00', '2023-06-09 06:25:44', '2023-06-09 19:14:56'),
(14, 'abcd', '10', 'Flat', 'User', '2,5,6,7', '', NULL, NULL, 0, 0, '0000-00-00', '0000-00-00', '2023-06-09 06:27:54', '2023-06-09 06:27:54'),
(15, 'rrr', '10', 'Percentage', 'User', '3', '', NULL, NULL, 0, 0, '0000-00-00', '0000-00-00', '2023-06-09 06:28:39', '2023-06-09 17:49:55'),
(16, 'bnb', '50', 'Flat', 'Category', '', '2,3', NULL, NULL, 0, 0, '0000-00-00', '0000-00-00', '2023-06-09 06:28:57', '2023-06-12 05:52:17'),
(17, 'key1', '100', 'Flat', 'Global', '', '', NULL, NULL, 0, 0, '0000-00-00', '0000-00-00', '2023-06-09 13:54:42', '2023-06-09 13:54:42');

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
-- Table structure for table `order_status`
--

CREATE TABLE `order_status` (
  `status_id` int(11) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `statustype` int(11) DEFAULT NULL,
  `isdeleted` int(11) DEFAULT 0,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `order_status`
--

INSERT INTO `order_status` (`status_id`, `label`, `statustype`, `isdeleted`, `created_at`, `updated_at`) VALUES
(1, 'Pending', 1, 0, '0000-00-00 00:00:00', '2021-12-15 00:00:00'),
(2, 'Approved', 2, 0, '0000-00-00 00:00:00', '2021-12-15 00:00:00'),
(3, 'Place order', 3, 0, '0000-00-00 00:00:00', '2022-09-07 00:00:00'),
(4, 'Canceled', 4, 0, '0000-00-00 00:00:00', '2022-09-07 00:00:00');

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
(1, 3, 1, 'BSP Parallel Fixed Female x Tube', 'public/admin/images/product/1686027829_productImg_product-details-desc-2.jpg', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s ', '2023-06-05 23:33:49', '2023-06-09 01:13:07'),
(3, 3, 2, 'BPF-WELD-90C', 'public/admin/images/product/1686027937_productImg_product-cart-2.jpg', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s ', '2023-06-05 23:35:37', '2023-06-05 23:35:37'),
(4, 1, 3, 'BBM-JIM', 'public/admin/images/product/1686028078_productImg_product-cart-2.jpg', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s ', '2023-06-05 23:37:58', '2023-06-05 23:37:58'),
(5, 1, 4, 'BJM-BJF-90C', 'public/admin/images/product/1686028123_productImg_p5.png', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s ', '2023-06-05 23:38:43', '2023-06-05 23:38:43'),
(6, 2, 5, 'SN01', 'public/admin/images/product/1686028264_productImg_p7.png', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s ', '2023-06-05 23:41:04', '2023-06-05 23:41:04'),
(7, 2, 6, 'PET-BSF', 'public/admin/images/product/1686028321_productImg_p7.png', NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s ', '2023-06-05 23:42:01', '2023-06-05 23:42:01'),
(8, 1, 3, 'test', 'public/admin/images/product/1686658018_productImg_p4.png', NULL, 'sdfsdf', '2023-06-13 06:36:58', '2023-06-13 06:36:58');

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
(1, 2, 'BSP Parallel Fixed Female x Tube', NULL, '500', 'BPF-TWF-1634 SCHD 16', '2023-06-05 23:34:13', '2023-06-05 23:34:13'),
(2, 3, 'BPF-WELD-90C', NULL, '1000', 'BPF-WELD-90C-0412ID34h20OD', '2023-06-05 23:35:37', '2023-06-05 23:35:37'),
(3, 4, 'BSP Parallel Bulkhead x JIC Male', NULL, '4500', 'BBM-JIM-0609 E44', '2023-06-05 23:37:58', '2023-06-05 23:37:58'),
(4, 5, 'BSP JIS Inverted Male x BSP JIS', NULL, '5000', 'BJM-BJF-90C-0202', '2023-06-05 23:38:43', '2023-06-05 23:38:43'),
(5, 6, '1/4 Non-Skive Swage Ferrule - R1T', NULL, '100', 'SN01-04', '2023-06-05 23:41:04', '2023-06-05 23:41:04'),
(6, 6, '5/16 Non-Skive Swage Ferrule - R1T', NULL, '200', 'SN01-05', '2023-06-05 23:41:04', '2023-06-05 23:41:04'),
(7, 7, '5/8 Petrol Tail x 1/2 BSPF', NULL, '700', 'PET-BSF-1008', '2023-06-05 23:42:01', '2023-06-05 23:42:01'),
(8, 1, 'aswerf', NULL, '200', 'gyr-745s', '2023-06-09 01:13:07', '2023-06-09 01:13:07');

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
(43, 6, 'public/front/images/partner_images/1683790955_bannerImg_pl1.png', '2023-05-11 02:12:36', '2023-05-11 02:12:36'),
(44, 6, 'public/front/images/partner_images/1683790956_bannerImg_pl2.png', '2023-05-11 02:12:36', '2023-05-11 02:12:36'),
(45, 1, 'public/front/images/home/1686146857_bannerImg_1143027264.png', '2023-06-07 08:37:37', '2023-06-07 08:37:37'),
(46, 6, 'public/front/images/partner_images/1686146857_bannerImg_pl1.png', '2023-06-07 08:37:38', '2023-06-07 08:37:38'),
(47, 6, 'public/front/images/partner_images/1686146858_bannerImg_pl2.png', '2023-06-07 08:37:38', '2023-06-07 08:37:38');

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
(1, 'WELCOME TO,', 'TRUFLOW HYDRAULICS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. A donec velit, et tempor, sit turpis. Ut posuere quisque sagittis leo massa est est felis. Enim diam et nisi, nunc amet pretium.', 'CALL NOW', 'https://website4you.co.in/truflow/about', 'welcome', '2023-05-09 04:28:30', '2023-06-07 08:37:36'),
(2, 'About Us', 'TRUFLOW HYDRAULICS', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. A donec velit, et tempor, sit turpis. Ut posuere quisque sagittis leo massa est est felis. Enim diam et nisi, nunc amet pretium. Sem vel commodo proin proin proin nec, arcu semper.Lorem ipsum dolor sit amet, consectetur adipiscing elit. A donec velit, et tempor, sit turpis. Ut posuere quisque sagittis leo massa est est felis. Enim diam et nisi, nunc amet pretium. Sem vel commodo proin proin proin nec, arcu semper.Lorem ipsum dolor sit amet,', 'Read More', 'https://website4you.co.in/truflow/about', 'about', '2023-05-08 23:12:50', '2023-06-07 08:37:37'),
(3, 'Lorem ipsum dolor sit amet.', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor.', 'Contact Us', 'https://website4you.co.in/truflow/about', 'contact', '2023-05-08 23:31:15', '2023-06-07 08:37:37'),
(4, 'OUR PRODUCTS', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.', '', '', 'product', '2023-05-08 23:31:15', '2023-06-07 08:37:37'),
(5, 'Client Testimonials', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.', '', '', 'testominal', '2023-05-08 23:31:15', '2023-06-07 08:37:37'),
(6, 'PARTNER LOGO', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.', '', '', 'partner', '2023-05-08 23:31:15', '2023-06-07 08:37:37');

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
(1, 3, 'TUBEWELD', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'public/admin/images/sub_category/1686027653_sub_categoryImg_p2.png', '2023-06-05 23:30:53', '2023-06-05 23:30:53'),
(2, 3, '90 DEGREE', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 'public/admin/images/sub_category/1686027676_sub_categoryImg_p2.png', '2023-06-05 23:31:16', '2023-06-05 23:31:16'),
(3, 1, 'ADAPTORS STRAIGHT', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s ', 'public/admin/images/sub_category/1686027999_sub_categoryImg_product-cart-4.jpg', '2023-06-05 23:36:39', '2023-06-05 23:36:39'),
(4, 1, 'ADAPTORS 90 DEGREE', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s ', 'public/admin/images/sub_category/1686028020_sub_categoryImg_product-details-desc-1.jpg', '2023-06-05 23:37:00', '2023-06-05 23:37:00'),
(5, 2, 'SWAGE FERRULES', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s ', 'public/admin/images/sub_category/1686028165_sub_categoryImg_p6.png', '2023-06-05 23:39:25', '2023-06-05 23:39:25'),
(6, 2, 'STRAIGHT', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s ', 'public/admin/images/sub_category/1686028184_sub_categoryImg_product-details-desc-3.jpg', '2023-06-05 23:39:44', '2023-06-05 23:39:44'),
(7, 1, 'sub cat 3', 'fgdfgdfgdfg', 'public/admin/images/sub_category/1686655591_sub_categoryImg_s1.png', '2023-06-13 05:56:31', '2023-06-13 05:57:45');

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
  `product_amount` varchar(255) DEFAULT NULL,
  `product_quantity` varchar(255) DEFAULT NULL,
  `total_amount` varchar(255) DEFAULT NULL,
  `discount_type` varchar(255) DEFAULT NULL,
  `product_discount` varchar(255) DEFAULT NULL,
  `final_total_ammount` varchar(255) DEFAULT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `pay_method` varchar(255) DEFAULT NULL,
  `order_status` varchar(255) NOT NULL,
  `shipping` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`order_id`, `user_id`, `cart_id`, `category_id`, `sub_category_id`, `product_id`, `variant_id`, `product_amount`, `product_quantity`, `total_amount`, `discount_type`, `product_discount`, `final_total_ammount`, `coupon_code`, `pay_method`, `order_status`, `shipping`, `created_at`, `updated_at`) VALUES
(1, 5, 33, 2, 5, 6, 5, '100', '1', '100.00', '', '', '', '', 'cash', 'Pending', 'Free shipping', '2023-06-13 06:50:39', '2023-06-13 06:50:39'),
(2, 5, 34, 2, 5, 6, 6, '200', '1', '200.00', '', '', '', '', 'cash', 'Pending', 'Free shipping', '2023-06-13 06:50:39', '2023-06-13 06:50:39'),
(3, 5, 35, 2, 6, 7, 7, '700', '1', '700.00', '', '', '700.00', '', 'cash', 'Pending', '', '2023-06-13 07:06:28', '2023-06-13 07:06:28'),
(4, 5, 36, 2, 6, 7, 7, '700', '2', '1400.00', 'Percentage', '10', '1,260.00', 'nadim', 'cash', 'Pending', 'Free shipping', '2023-06-13 07:07:04', '2023-06-13 07:07:04'),
(5, 5, 37, 3, 2, 3, 2, '1000', '1', '1000.00', 'Percentage', '10', '900.00', 'nadim', 'cash', 'Pending', 'Free shipping', '2023-06-13 07:07:38', '2023-06-13 07:07:38');

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
(2, 'nadim', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,', 'public/front/images/testominal/1686655903_testominalImg_client.png', '2023-05-11 01:49:23', '2023-06-13 06:01:43'),
(3, 'Ravi', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,', 'public/front/images/testominal/1683790795_testominalImg_client.png', '2023-05-11 01:49:48', '2023-05-11 02:09:55'),
(4, 'Bhavin', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,', 'public/front/images/testominal/1683790821_testominalImg_client.png', '2023-05-11 01:50:11', '2023-05-11 02:10:21'),
(5, 'Gautam', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,', 'public/front/images/testominal/1683790785_testominalImg_client.png', '2023-05-11 02:06:08', '2023-05-11 02:09:45'),
(6, 'Darshit', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,', 'public/front/images/testominal/1686656733_testominalImg_bg-img.png', '2023-05-11 02:06:20', '2023-06-13 06:15:33'),
(7, 'test', 'CEO', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,	\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Adipiscing enim morbi tortor.Lorem ipsum dolor sit amet, consectetur adipiscing.Lorem ipsum dolor sit amet,	', 'public/front/images/testominal/1686655970_testominalImg_client.png', '2023-06-13 06:02:50', '2023-06-13 06:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `gender` varchar(6) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `mobile` varchar(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `company_name` varchar(211) NOT NULL,
  `address_1` text DEFAULT NULL,
  `address_2` text DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `zipcode` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `fax` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `full_name`, `first_name`, `last_name`, `gender`, `date_of_birth`, `mobile`, `email`, `password`, `user_role`, `company_name`, `address_1`, `address_2`, `city`, `zipcode`, `country`, `phone`, `fax`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Trueflow Admin', NULL, NULL, NULL, NULL, NULL, 'trueflow@admin.com', '123456', 'Admin', '', NULL, NULL, '', '', '', '', '', '2023-05-04 13:57:47', '2023-05-04 13:57:47', '2023-05-04 13:57:47'),
(2, 'sdfsd sdfdsf', 'sdfsd', 'sdfdsf', 'male', '2023-05-11', '1231231234', 'bhasavin@tec-sense.com', '123456', 'user', '', NULL, NULL, '', '', '', '', '', '2023-05-22 13:38:48', '2023-05-22 13:38:48', '0000-00-00 00:00:00'),
(3, 'asdasd asdsadas', 'asdasd', 'asdsadas', 'male', '2023-05-19', '7043619433', 'sbhavin@tec-sense.com', '123456', 'user', '', NULL, NULL, '', '', '', '', '', '2023-05-22 13:41:33', '2023-05-22 13:41:33', '0000-00-00 00:00:00'),
(4, 'sdfsdf sdfsdf', 'sdfsdf', 'sdfsdf', 'femal', '2023-05-08', '1231231234', 'bhavin@tec-sense.com', '$2y$10$2D0PPq.JlM5yxa.EqSQkq.bwvlDn/VVS6RGyc0HiQvX/G5E2Z2geG', 'user', '', NULL, NULL, '', '', '', '', '', '2023-05-22 13:43:02', '2023-05-22 13:43:02', '0000-00-00 00:00:00'),
(5, 'Nadim test ', 'Nadim', 'test ', 'male', '2023-02-02', '7043619433', 'nadim@tec-sense.com', '$2y$10$eOdUNstneRt3gC3MFnDpOOMtaLL2vkqCtEym31SsN5BT52xe.GR1C', 'user', 'tec-sense', 'new vadaj', 'ahmedabad', 'ahmedabad', '123456', 'Australia', '+2 (525) 252-5252', '7485965', '2023-05-22 13:51:05', '2023-05-31 11:23:41', '0000-00-00 00:00:00'),
(6, 'Darshit Patel', 'Darshit', 'Patel', 'male', '1995-12-10', '2542524252', 'darshit@gmail.com', '$2y$10$T1o/zMs37mjN0V0cl6Xbye/Zw14jH7DnGxfFjSUbM/RsjrhB0TkVi', 'user', '', NULL, 'Ahmedabad', 'Ahmedabad', '3650021', 'India', '(141) 414-1414', '2541256', '2023-05-31 07:48:12', '2023-05-31 07:48:12', '0000-00-00 00:00:00'),
(7, 'ravi somani', 'ravi', 'somani', 'female', '1995-11-10', '1231231230', 'gautam@tec-sense.com', '$2y$10$8z78J.57JK7QfMh7VE5MBeUQs9DWKzHXnx9ReWhXyZlKFbV1z64Q6', 'user', 'tec-sense', 'new vadaj', 'ahmedabad', 'ahmedabad', '123456', 'New Zealand', '+1 (704) 361-9431', 'nadim', '2023-05-31 08:01:23', '2023-06-01 04:34:05', '0000-00-00 00:00:00'),
(8, 'Gautam somani', 'Gautam', 'somani', 'male', '1995-12-10', '1231231230', 'gautam@tec-sense.com', '$2y$10$Cg08nZDlulzVXGv5vGE.fu65QwTlDEV8DimDIa3LqsMvcnAH5//MK', 'user', 'tec-sense', 'new vadaj', 'ahmedabad', 'ahmedabad', '123456', 'Australia', '4152635285', '748596', '2023-05-31 09:55:23', '2023-05-31 09:55:23', '0000-00-00 00:00:00'),
(9, 'darshit dd', 'darshit', 'dd', NULL, '2023-06-14', '1231231230', 'dd@g.com', '$2y$10$dkNC1e4ZgUsUL40WQdu.LeLeXVsfg8Jsws6alaqhXd/Nc1y0Gaqoe', 'user', 'tec-sense', 'new vadaj', 'ahmedabad', 'ahmedabad', '123456', 'Australia', '4152635285', '748596dsfsd', '2023-06-13 07:17:38', '2023-06-13 07:17:38', '0000-00-00 00:00:00'),
(10, 'dsfsdf sdfsdfs', 'dsfsdf', 'sdfsdfs', NULL, '2023-06-27', '7043619433', 'shlomi@ipcomp.co.il', '$2y$10$4LHp7hpXvwPk8HEddJpuyeNb2i6tTuij33HK109yFH36rKmmLtIzO', 'user', 'sdfdsf', 'sdfsdf', '', 'ahmedabad', '123456', 'New Zealand', '', '', '2023-06-13 07:25:18', '2023-06-13 07:25:18', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addwish_list`
--
ALTER TABLE `addwish_list`
  ADD PRIMARY KEY (`wishid`);

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
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`country_id`);

--
-- Indexes for table `coupon`
--
ALTER TABLE `coupon`
  ADD PRIMARY KEY (`coupon_id`);

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
-- Indexes for table `order_status`
--
ALTER TABLE `order_status`
  ADD PRIMARY KEY (`status_id`);

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
-- AUTO_INCREMENT for table `addwish_list`
--
ALTER TABLE `addwish_list`
  MODIFY `wishid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `add_to_cart`
--
ALTER TABLE `add_to_cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `country_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `coupon`
--
ALTER TABLE `coupon`
  MODIFY `coupon_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
-- AUTO_INCREMENT for table `order_status`
--
ALTER TABLE `order_status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `variant_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `settings_images`
--
ALTER TABLE `settings_images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `site_settings`
--
ALTER TABLE `site_settings`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `sub_category`
--
ALTER TABLE `sub_category`
  MODIFY `sub_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_order`
--
ALTER TABLE `tbl_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `testominal`
--
ALTER TABLE `testominal`
  MODIFY `testimo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

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
