-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 21, 2018 at 05:02 PM
-- Server version: 10.1.25-MariaDB
-- PHP Version: 7.1.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dakbro`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` varchar(50) NOT NULL,
  `country_id` varchar(50) NOT NULL,
  `state_id` varchar(50) NOT NULL,
  `city_id` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `country_id`, `state_id`, `city_id`, `code`, `name`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('bdb8ea97-b87d-41d0-a51d-aa1e3d8216a85a531e059f15d', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'AN', 'Ashok nagar', '1', '1', '2018-03-10 08:14:51', '2018-03-10 03:44:51');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `country_id` varchar(50) NOT NULL,
  `state_id` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `code`, `name`, `country_id`, `state_id`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'Ch', 'chennai', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', '1', '1', '2018-03-10 08:13:04', '2018-03-10 03:43:04');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `comments` text NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `subject`, `comments`, `created_time`, `updated_time`) VALUES
('test', 'name', 'email', '1234567890', 'subject', 'gjhhbjkjkjk;\r\njjhjkhk', '2018-03-10 14:25:20', '2018-03-10 14:25:20');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` varchar(50) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', 'IN', 'India', '1', '1', '2018-03-10 08:13:47', '2018-03-10 03:43:47'),
('a1208561-7133-4e62-8fbe-9687183e0c0f5a5314a2e32ca', 'UN', 'United states', '1', '1', '2018-01-08 02:20:10', '2018-01-08 02:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `type` enum('percentage','cash') NOT NULL,
  `amount` double NOT NULL,
  `allowed_count` int(11) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE `discounts` (
  `id` varchar(50) NOT NULL,
  `type` enum('cash','percentage') NOT NULL,
  `amount` double NOT NULL,
  `service_id` int(11) NOT NULL,
  `shop_id` varchar(50) NOT NULL,
  `start_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('0248533a-4039-4b48-a00d-13e7100e1ca55aaef79e7672e', 'tdsdsfsdf', '1', '1', '2018-03-18 19:04:54', '2018-03-18 19:04:54'),
('c32b317a-fd7d-43e7-a0c1-f68dd17dad955aa3e3ced7069', 'test', '1', '1', '2018-03-10 09:25:26', '2018-03-10 09:25:26');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` varchar(50) NOT NULL,
  `gallery_id` varchar(50) NOT NULL,
  `type` enum('image','youtube') NOT NULL,
  `title` text,
  `description` text,
  `url` text NOT NULL,
  `image` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `gallery_id`, `type`, `title`, `description`, `url`, `image`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('32bd658b-1de0-46e1-b41a-3d17657aac715aa3e417ae0a7', 'c32b317a-fd7d-43e7-a0c1-f68dd17dad955aa3e3ced7069', 'image', 't', 't', '', '[{\"source\":\"upload\",\"name\":\"slider_01jpg_ecsize_1920_750_412502\",\"size\":412502,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"f7f94d/ccb8bdc0-246b-11e8-b9e4-f53de053497e_1520690604955.jpg\",\"s3_url\":\"prod-dakbro/f7f94d/ccb8bdc0-246b-11e8-b9e4-f53de053497e_1520690604955.jpg\",\"dimension\":{\"width\":1920,\"height\":750,\"size\":412502}}]', '1', '1', '2018-03-10 14:03:41', '2018-03-10 09:33:41');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` varchar(50) NOT NULL,
  `date` int(11) NOT NULL,
  `reason` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `date`, `reason`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('040d4120-41f2-42a1-b15b-e6cdcc71b75f5aafa2853b606', 1520899200, 'dsdsfdsfdsf', '1', '1', '2018-03-19 07:14:05', '2018-03-19 07:14:05');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE `log` (
  `id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `page_settings`
--

CREATE TABLE `page_settings` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `image` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_settings`
--

INSERT INTO `page_settings` (`id`, `name`, `page_title`, `meta_key`, `meta_desc`, `image`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('b7515e16-5769-4398-a950-6d2adc60c9f75a916f5c3fc5c', 'Home', 'Dakbro', 'Bike Polish, All vehicles', 'We offer all two wheeler polishing serivce.', '[{\"source\":\"upload\",\"name\":\"dakjpg_ecsize_500_300_22206\",\"size\":22206,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"d2960a/ad9fa9f0-196a-11e8-b215-5560f05b3485_1519480660495.jpg\",\"s3_url\":\"prod-dakbro/d2960a/ad9fa9f0-196a-11e8-b215-5560f05b3485_1519480660495.jpg\",\"dimension\":{\"width\":500,\"height\":300,\"size\":22206}}]', '1', '1', '2018-03-10 08:04:04', '2018-03-10 03:34:04');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `created_id` int(50) NOT NULL,
  `updated_id` int(50) NOT NULL,
  `permissions` text,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `id` varchar(50) NOT NULL,
  `shop_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_status` enum('ACCEPTED','FAILED','PROCESSING','PENDING','SHIPPED','COMPLETE','HOLD') NOT NULL,
  `total_amount` double NOT NULL,
  `total_discount` double NOT NULL DEFAULT '0',
  `total_tax` double NOT NULL,
  `payment_type` varchar(45) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `txn_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_item`
--

CREATE TABLE `sales_order_item` (
  `id` varchar(50) NOT NULL,
  `service_id` int(11) NOT NULL,
  `item_status` enum('NEW','PENDING','ACCEPTED','SHIPPED','COMPLETE') NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `sales_order_id` int(11) NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` varchar(50) NOT NULL,
  `parent_id` varchar(50) NOT NULL,
  `name` text NOT NULL,
  `description` text NOT NULL,
  `type` enum('bike','car') NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `parent_id`, `name`, `description`, `type`, `created_time`, `updated_time`, `created_id`, `updated_id`) VALUES
('29ba5972-32cc-4396-8518-9d1ec46e2ad25aaeefac239b1', 'd8c76996-212c-4f37-8b93-82287255a6915aaee50569448', 'yrdyy', 'yyy', 'bike', '2018-03-18 18:31:00', '2018-03-18 18:31:00', '1', '1'),
('d8c76996-212c-4f37-8b93-82287255a6915aaee50569448', '', 'Bike polishinggg', 'Two Bike polishingggtg\r\n\r\ndsfsdfsd', 'bike', '2018-03-18 17:45:33', '2018-03-18 18:31:10', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `service_vehicles`
--

CREATE TABLE `service_vehicles` (
  `id` varchar(50) NOT NULL,
  `service_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `shops`
--

CREATE TABLE `shops` (
  `id` varchar(140) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner_id` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `about` text NOT NULL,
  `address` text NOT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` varchar(50) NOT NULL,
  `city_id` int(11) NOT NULL,
  `area_id` int(11) NOT NULL,
  `start_day` varchar(10) NOT NULL,
  `end_day` varchar(10) NOT NULL,
  `start_time` varchar(11) NOT NULL,
  `end_time` varchar(11) NOT NULL,
  `experience` varchar(20) NOT NULL,
  `no_of_mechanics` tinyint(4) NOT NULL,
  `image` text NOT NULL,
  `shop_area` int(11) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `owner_id`, `phone`, `email`, `about`, `address`, `country_id`, `state_id`, `city_id`, `area_id`, `start_day`, `end_day`, `start_time`, `end_time`, `experience`, `no_of_mechanics`, `image`, `shop_area`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('3e2035bf-5474-4eba-82a2-04ded4ed53255ab27b75efa19', 'Dakbro polishing service', '1', '1234567890', 'nfo@dakbro.com', 'Welcome to dakbro!!', '27/2 B 2nd street', 6, '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 0, 0, 'Monday', 'Friday', '09:00 AM', '12:00 PM', '8', 2, '', 2455, '1', '1', '2018-03-21 15:38:20', '2018-03-21 11:08:20');

-- --------------------------------------------------------

--
-- Table structure for table `shop_services`
--

CREATE TABLE `shop_services` (
  `id` varchar(50) NOT NULL,
  `shop_id` varchar(50) NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `discount` tinyint(4) NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE `sliders` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('97535390-0c5c-4c08-ad68-fa4b7372c6595aa3e4ac05c14', 't', '1', '1', '2018-03-10 09:29:08', '2018-03-10 09:29:08');

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE `slider_images` (
  `id` varchar(50) NOT NULL,
  `slider_id` varchar(50) NOT NULL,
  `type` enum('image','youtube') NOT NULL,
  `title` text,
  `sub_title` text,
  `url` text NOT NULL,
  `image` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `slider_id`, `type`, `title`, `sub_title`, `url`, `image`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('0f5e9f12-7d5c-47f2-8694-4a9b9f3a89f15aa3e50be27ad', '97535390-0c5c-4c08-ad68-fa4b7372c6595aa3e4ac05c14', 'image', 'ts', 'ss', '', '', '1', '1', '2018-03-10 14:00:47', '2018-03-10 09:30:47');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` varchar(50) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `country_id` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `code`, `name`, `country_id`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'TN', 'Tamilnadu', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', '1', '1', '2018-03-10 08:14:04', '2018-03-10 03:44:04');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `name`, `message`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('bf9e6af7-9770-455f-8d29-89fbd3abafb95aae62febb399', 'ARUN NURA', 'test.,', '1', '1', '2018-03-18 08:30:46', '2018-03-21 09:57:41');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` varchar(50) NOT NULL,
  `name` varchar(155) NOT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(150) NOT NULL,
  `role` varchar(10) NOT NULL,
  `city` varchar(50) DEFAULT NULL,
  `area` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `language` varchar(10) NOT NULL DEFAULT 'eng',
  `country` varchar(50) DEFAULT NULL,
  `tz` varchar(50) NOT NULL DEFAULT '	Asia/Kolkata',
  `image` text,
  `status` enum('active','blocked') NOT NULL DEFAULT 'active',
  `parent_id` varchar(50) DEFAULT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `city`, `area`, `state`, `language`, `country`, `tz`, `image`, `status`, `parent_id`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('1', 'Admin', 'programmingtechz@gmail.com', '9176599630', '21232f297a57a5a743894a0e4a801fc3', 'admin', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'bdb8ea97-b87d-41d0-a51d-aa1e3d8216a85a531e059f15d', '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'eng', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', 'Asia/Kolkata', '', 'active', NULL, '', '1', '2018-01-08 07:59:07', '2018-01-08 03:29:07'),
('e68f3a6b-83b5-4069-ab87-bd9219c2ceba5a5586a8c3c2a', 'arunnura', 'arunnura23@gmail.com', '1234567890', '', 'shop_owner', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'bdb8ea97-b87d-41d0-a51d-aa1e3d8216a85a531e059f15d', '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'eng', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', 'Asia/Kolkata', '[{\"source\":\"upload\",\"name\":\"wwjpg_ecsize_170_170_7984\",\"size\":7984,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"28dd46/a0cf1920-195d-11e8-8225-27f82b3008d6_1519475055538.jpg\",\"s3_url\":\"prod-dakbro/28dd46/a0cf1920-195d-11e8-8225-27f82b3008d6_1519475055538.jpg\",\"dimension\":{\"width\":170,\"height\":170,\"size\":7984}}]', 'blocked', NULL, '1', '1', '2018-02-24 12:24:18', '2018-02-24 07:54:18');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('car','bike') NOT NULL DEFAULT 'bike',
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `description`, `type`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('67e7812d-93dd-488b-8558-ea2c54fb9ee45aa3cb81c63af', '200cc', '200cc!!', 'bike', '1', '1', '2018-03-10 12:12:01', '2018-03-10 07:42:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discounts`
--
ALTER TABLE `discounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `page_settings`
--
ALTER TABLE `page_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales_order`
--
ALTER TABLE `sales_order`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_order_api_access1` (`created_id`),
  ADD KEY `fk_order_api_access2` (`updated_id`),
  ADD KEY `fk_order_customers1` (`user_id`),
  ADD KEY `fk_sales_order_sales_channel1` (`shop_id`),
  ADD KEY `fk_sales_order_user1` (`created_id`),
  ADD KEY `fk_sales_order_user2` (`updated_id`);

--
-- Indexes for table `sales_order_item`
--
ALTER TABLE `sales_order_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `service_vehicles`
--
ALTER TABLE `service_vehicles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shops`
--
ALTER TABLE `shops`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `shop_services`
--
ALTER TABLE `shop_services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sliders`
--
ALTER TABLE `sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `slider_images`
--
ALTER TABLE `slider_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `log`
--
ALTER TABLE `log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
