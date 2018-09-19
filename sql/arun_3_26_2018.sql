-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 26, 2018 at 10:43 AM
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
('b3136e61-5513-4db6-b94a-e00bb58efef75ab6291409e27', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'AN', 'Anna Nagar', '1', '1', '2018-03-24 06:01:48', '2018-03-24 06:01:48'),
('bdb8ea97-b87d-41d0-a51d-aa1e3d8216a85a531e059f15d', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'BN', 'Besant Nagar', '1', '1', '2018-03-24 10:31:33', '2018-03-24 06:01:33');

-- --------------------------------------------------------

--
-- Stand-in structure for view `best_price_services`
-- (See below for the actual view)
--
CREATE TABLE `best_price_services` (
`service_id` varchar(50)
,`vehicle_id` varchar(50)
,`service_time` int(11)
,`shop_id` varchar(50)
,`price` double
,`discount` tinyint(4)
,`name` text
,`description` text
,`image` text
,`service_details` text
);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `id` int(11) NOT NULL,
  `key` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`id`, `key`) VALUES
(1, '2b5a4490-2f2d-11e8-9d28-87eb4118684f_1521873168217');

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
('979ad21c-eb57-472b-81aa-0a372f58f6cf5ab7be0fae1dc', 'Hand Polish', '1', '1', '2018-03-25 11:49:43', '2018-03-25 11:49:43'),
('97b07783-0a53-4e12-a093-726c285a73595ab7bda451f5f', 'polishing', '1', '1', '2018-03-25 11:47:56', '2018-03-25 11:47:56');

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
('5fcc0598-a4ea-464b-8e7d-0a448bf9e41e5ab7be2ec6319', '97b07783-0a53-4e12-a093-726c285a73595ab7bda451f5f', 'image', 'Polishing', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '[{\"source\":\"upload\",\"name\":\"unnamedpng_ecsize_512_250_151946\",\"size\":151946,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"500ba6/4fc39ca0-3040-11e8-a8ce-998ef9d8d3f8_1521991340906.png\",\"s3_url\":\"prod-dakbro/500ba6/4fc39ca0-3040-11e8-a8ce-998ef9d8d3f8_1521991340906.png\",\"dimension\":{\"width\":512,\"height\":250,\"size\":151946}}]', '1', '1', '2018-03-25 21:48:53', '2018-03-25 11:52:25'),
('97f0c3c2-c790-4943-91dc-2f3f9e81ce9f5ab7bef1c08c2', '979ad21c-eb57-472b-81aa-0a372f58f6cf5ab7be0fae1dc', 'image', 'Hand polish', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '[{\"source\":\"upload\",\"name\":\"image_10jpg_ecsize_760_506_132676\",\"size\":132676,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"ffcb8a/5c8b18a0-3040-11e8-a0bd-3db8d24bc9b5_1521991362346.jpg\",\"s3_url\":\"prod-dakbro/ffcb8a/5c8b18a0-3040-11e8-a0bd-3db8d24bc9b5_1521991362346.jpg\",\"dimension\":{\"width\":760,\"height\":506,\"size\":132676}}]', '1', '1', '2018-03-25 21:48:57', '2018-03-25 11:53:29');

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
('2febd1d2-392c-490f-ae04-f4c43ae87e245ab3bbfe35db1', 1520899200, 'dsdsfdsfdsfd', '1', '1', '2018-03-22 09:51:50', '2018-03-22 09:51:50'),
('69ff1813-3ecf-4602-a4d1-5fedf055f6835ab3be9b426e8', 1521676800, 'dfgfd', '1', '1', '2018-03-22 10:02:59', '2018-03-22 10:02:59');

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
('281ec800-cf2d-4723-ac7a-fd94a2fcbabb5ab6898a414bc', 'services', 'Dakbro Incredible Polishing Studio - Services', 'Bike Polish, All vehicles', 'We offer all two wheeler polishing serivce.', '[{\"source\":\"upload\",\"name\":\"ad9fa9f0196a11e8b2155560f05b3485_1519480660495jpg_ecsize_500_300_22206\",\"size\":22206,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"bc617d/0b031810-2f88-11e8-b705-af4668d0addb_1521912198161.jpg\",\"s3_url\":\"prod-dakbro/bc617d/0b031810-2f88-11e8-b705-af4668d0addb_1521912198161.jpg\",\"dimension\":{\"width\":500,\"height\":300,\"size\":22206}}]', '1', '1', '2018-03-24 12:53:22', '2018-03-24 12:53:22'),
('b7515e16-5769-4398-a950-6d2adc60c9f75a916f5c3fc5c', 'home', 'Dakbro Incredible Polishing Studio', 'Bike Polish, All vehicles', 'We offer all two wheeler polishing serivce.', '[{\"source\":\"upload\",\"name\":\"dakjpg_ecsize_500_300_22206\",\"size\":22206,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"d2960a/ad9fa9f0-196a-11e8-b215-5560f05b3485_1519480660495.jpg\",\"s3_url\":\"prod-dakbro/d2960a/ad9fa9f0-196a-11e8-b215-5560f05b3485_1519480660495.jpg\",\"dimension\":{\"width\":500,\"height\":300,\"size\":22206}}]', '1', '1', '2018-03-24 17:15:42', '2018-03-10 03:34:04');

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
  `image` text NOT NULL,
  `short_text` text NOT NULL,
  `description` text NOT NULL,
  `service_details` text NOT NULL,
  `service_time` int(11) NOT NULL,
  `service_image` text NOT NULL,
  `type` enum('bike','car') NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `parent_id`, `name`, `image`, `short_text`, `description`, `service_details`, `service_time`, `service_image`, `type`, `created_time`, `updated_time`, `created_id`, `updated_id`) VALUES
('33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '', 'Polishing', '[{\"source\":\"upload\",\"name\":\"bike wash Custompng_ecsize_26_33_1201\",\"size\":1201,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"55919/cc0e7680-2f4c-11e8-92c8-777ecf08a4e4_1521886752232.png\",\"s3_url\":\"prod-dakbro/55919/cc0e7680-2f4c-11e8-92c8-777ecf08a4e4_1521886752232.png\",\"dimension\":{\"width\":26,\"height\":33,\"size\":1201}}]', 'Bike Polishing', 'Metro tical dotrium est terminal integer forks driven suspendisse une novum etos pellentesque a non felis maecenas magna ligato primus.', 'Power wash\r\nRemoving scratches \r\nTeflon Coating \"(PIMPOM)\"\r\nRust removal\r\nAnti rust coating \r\nChrome polishing \r\nApplying protector\r\nSmart Painting(slincer & Stands)\r\nTyre & sheet dressing\r\nPaint protector\r\nPlastic & Vinyl exterior polishing\r\nLabour Charges\r\nService Charges.', 60, '[{\"source\":\"upload\",\"name\":\"eeejpg_ecsize_1000_391_41839\",\"size\":41839,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"2f9118/42beccb0-3044-11e8-9af3-330f7252665b_1521993037050.jpg\",\"s3_url\":\"prod-dakbro/2f9118/42beccb0-3044-11e8-9af3-330f7252665b_1521993037050.jpg\",\"dimension\":{\"width\":1000,\"height\":391,\"size\":41839}}]', 'bike', '2018-03-24 01:54:41', '2018-03-25 12:20:45', '1', '1'),
('48e5658f-15b1-4538-92c9-2893dfcf5def5ab626bb302e1', '', 'Chain lubrication', '[{\"source\":\"upload\",\"name\":\"chain 2jpg_ecsize_33_33_1015\",\"size\":1015,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"4200f7/269a8c10-2f4d-11e8-bf04-df082fb7005a_1521886904145.jpg\",\"s3_url\":\"prod-dakbro/4200f7/269a8c10-2f4d-11e8-bf04-df082fb7005a_1521886904145.jpg\",\"dimension\":{\"width\":33,\"height\":33,\"size\":1015}}]', 'Bike Chain lubrication', 'Metro tical dotrium est terminal integer forks driven suspendisse une novum etos pellentesque a non felis maecenas magna ligato primus.', 'Bike Chain lubrication\r\nLabour Charges\r\nService Charges.', 60, '[{\"source\":\"upload\",\"name\":\"Cover_Image_1024x1024 Customjpg_ecsize_1000_535_118620\",\"size\":118620,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"965857/451fd1b0-3045-11e8-bbea-639dce617f77_1521993470539.jpg\",\"s3_url\":\"prod-dakbro/965857/451fd1b0-3045-11e8-bbea-639dce617f77_1521993470539.jpg\",\"dimension\":{\"width\":1000,\"height\":535,\"size\":118620}}]', 'bike', '2018-03-24 05:51:47', '2018-03-25 12:27:56', '1', '1'),
('5a12dcdd-c593-4e94-9929-12e4254ad59e5ab62655a61b9', '', 'Oil change', '[{\"source\":\"upload\",\"name\":\"oilpng_ecsize_33_22_770\",\"size\":770,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"3006ed/e677a1e0-2f4c-11e8-ab67-872f4b0bf26b_1521886796541.png\",\"s3_url\":\"prod-dakbro/3006ed/e677a1e0-2f4c-11e8-ab67-872f4b0bf26b_1521886796541.png\",\"dimension\":{\"width\":33,\"height\":22,\"size\":770}}]', 'Bike Oil change.', 'Metro tical dotrium est terminal integer forks driven suspendisse une novum etos pellentesque a non felis maecenas magna ligato primus.', 'Oil changes\r\nLabour Charges\r\nService Charges.', 60, '[{\"source\":\"upload\",\"name\":\"GYTROilChangeKit2banner Customjpg_ecsize_1000_526_119358\",\"size\":119358,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"82ce54/fa338570-3044-11e8-b502-17b41fc482f5_1521993344839.jpg\",\"s3_url\":\"prod-dakbro/82ce54/fa338570-3044-11e8-b502-17b41fc482f5_1521993344839.jpg\",\"dimension\":{\"width\":1000,\"height\":526,\"size\":119358}}]', 'bike', '2018-03-24 05:50:05', '2018-03-25 12:25:48', '1', '1'),
('7448ecd3-1ea0-47d6-98e0-4d48d67276a95ab62780cbde3', '', '3M Scratch Proof Sticker', '[{\"source\":\"upload\",\"name\":\"3m Custompng_ecsize_33_33_825\",\"size\":825,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"b67414/9b8c98b0-2f4d-11e8-be96-7d1c696821a2_1521887100347.png\",\"s3_url\":\"prod-dakbro/b67414/9b8c98b0-2f4d-11e8-be96-7d1c696821a2_1521887100347.png\",\"dimension\":{\"width\":33,\"height\":33,\"size\":825}}]', 'Bike 3M Scratch Proof Sticker', 'Metro tical dotrium est terminal integer forks driven suspendisse une novum etos pellentesque a non felis maecenas magna ligato primus.', '3M Scratch Proof Sticker\r\nLabour Charges\r\nService Charges.', 60, '[{\"source\":\"upload\",\"name\":\"maxresdefault Customjpg_ecsize_1000_563_109613\",\"size\":109613,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"28ac65/d9c604b0-3045-11e8-92d1-310e82d50871_1521993719931.jpg\",\"s3_url\":\"prod-dakbro/28ac65/d9c604b0-3045-11e8-92d1-310e82d50871_1521993719931.jpg\",\"dimension\":{\"width\":1000,\"height\":563,\"size\":109613}}]', 'bike', '2018-03-24 05:55:04', '2018-03-25 12:32:03', '1', '1'),
('86629b11-c4b3-47b2-8d32-ffdb1955e1935ab627524ac3a', '', 'Teflon Coating', '[{\"source\":\"upload\",\"name\":\"teflon Custompng_ecsize_31_33_1592\",\"size\":1592,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"7922d8/809229d0-2f4d-11e8-8bc3-7bbd9825bebd_1521887055085.png\",\"s3_url\":\"prod-dakbro/7922d8/809229d0-2f4d-11e8-8bc3-7bbd9825bebd_1521887055085.png\",\"dimension\":{\"width\":31,\"height\":33,\"size\":1592}}]', 'Bike Teflon Coating\r\n', 'Etiam bibendum est terminal metro. Suspendisse a novum etos pellentesque a non felis maecenas module vimeo est malesuada forte. Primus elit lectus at felis, malesuada ultricies obec curabitur et ligula sande porta node vestibulum une commodo a convallis laoreet enim. Morbi at sinum interdum etos fermentum. Nulla elite terminal integer vespa node supreme morbi suspendisse a novum etos module un metro.', 'Teflon Coating\r\nLabour Charges\r\nService Charges.', 60, '[{\"source\":\"upload\",\"name\":\"p4847128355 Customjpg_ecsize_1000_661_176004\",\"size\":176004,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"b07d34/4ea39ef0-3046-11e8-ab14-21afbad44d84_1521993915999.jpg\",\"s3_url\":\"prod-dakbro/b07d34/4ea39ef0-3046-11e8-ab14-21afbad44d84_1521993915999.jpg\",\"dimension\":{\"width\":1000,\"height\":661,\"size\":176004}}]', 'bike', '2018-03-24 05:54:18', '2018-03-25 12:35:20', '1', '1'),
('ff87e5ee-3b05-49f7-9a49-df1306b164e55ab627244b851', '', 'Alloy Wheel Coating', '[{\"source\":\"upload\",\"name\":\"alloy Custompng_ecsize_31_33_2048\",\"size\":2048,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"6ab9f6/60dbe090-2f4d-11e8-b15b-b33d6d99b05b_1521887001881.png\",\"s3_url\":\"prod-dakbro/6ab9f6/60dbe090-2f4d-11e8-b15b-b33d6d99b05b_1521887001881.png\",\"dimension\":{\"width\":31,\"height\":33,\"size\":2048}}]', 'Bike Alloy Wheel Coating', 'Etiam bibendum est terminal metro. Suspendisse a novum etos pellentesque a non felis maecenas module vimeo est malesuada forte. Primus elit lectus at felis, malesuada ultricies obec curabitur et ligula sande porta node vestibulum une commodo a convallis laoreet enim. Morbi at sinum interdum etos fermentum. Nulla elite terminal integer vespa node supreme morbi suspendisse a novum etos module un metro.', 'Alloy Wheel Coating\r\nLabour Charges\r\nService Charges.', 60, '[{\"source\":\"upload\",\"name\":\"imgarwcbannerpowdercoating Customjpg_ecsize_1000_417_141299\",\"size\":141299,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"6fda80/b8aaa2a0-3044-11e8-9dea-d950a4c9e927_1521993234890.jpg\",\"s3_url\":\"prod-dakbro/6fda80/b8aaa2a0-3044-11e8-9dea-d950a4c9e927_1521993234890.jpg\",\"dimension\":{\"width\":1000,\"height\":417,\"size\":141299}}]', 'bike', '2018-03-24 05:53:32', '2018-03-25 12:24:00', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `service_vehicles`
--

CREATE TABLE `service_vehicles` (
  `id` varchar(50) NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service_vehicles`
--

INSERT INTO `service_vehicles` (`id`, `service_id`, `vehicle_id`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('58791b57-c73e-4dec-ab41-354c54e60d195ab35b1276cc3', 'd8c76996-212c-4f37-8b93-82287255a6915aaee50569448', '67e7812d-93dd-488b-8558-ea2c54fb9ee45aa3cb81c63af', '1', '1', '2018-03-22 07:33:56', '2018-03-22 03:03:56');

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
  `city_id` varchar(50) NOT NULL,
  `area_id` varchar(50) NOT NULL,
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
('b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', 'DAKBRO Incredible Bike Polishing Studio', '1', '9176599630', 'info@dakbroincredible.com', 'DAKBRO Incredible Bike Polishing Studio Anna Nagar.', '28th Cross St, Besant Nagar,', 6, '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'bdb8ea97-b87d-41d0-a51d-aa1e3d8216a85a531e059f15d', 'Monday', 'Saturday', '9:00 AM', '12:00 PM', '5', 4, '[{\"source\":\"upload\",\"name\":\"bannerjpg_ecsize_1023_500_119364\",\"size\":119364,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"7deb89/16dcd320-2f50-11e8-92c5-77d11f7a6e5b_1521888166225.jpg\",\"s3_url\":\"prod-dakbro/7deb89/16dcd320-2f50-11e8-92c5-77d11f7a6e5b_1521888166225.jpg\",\"dimension\":{\"width\":1023,\"height\":500,\"size\":119364}}]', 245, '1', '1', '2018-03-24 06:13:16', '2018-03-24 06:13:16'),
('d64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', 'DAKBRO Incredible Bike Polishing Studio', '1', '9176084047', 'info@dakbroincredible.com', 'Dakbro Incredible BIKE Polishing Studio', '468, 7th Main Rd, Ishwarya Nagar, MGR Colony,', 6, '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'b3136e61-5513-4db6-b94a-e00bb58efef75ab6291409e27', 'Monday', 'Sunday', '9:00 AM', '8:30 PM', '5', 4, '[{\"source\":\"upload\",\"name\":\"bannerjpg_ecsize_1023_500_119364\",\"size\":119364,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"298611/63077db0-2f4e-11e8-b61e-4f0d53409b46_1521887435019.jpg\",\"s3_url\":\"prod-dakbro/298611/63077db0-2f4e-11e8-b61e-4f0d53409b46_1521887435019.jpg\",\"dimension\":{\"width\":1023,\"height\":500,\"size\":119364}}]', 200, '1', '1', '2018-03-24 10:47:20', '2018-03-24 06:17:20');

-- --------------------------------------------------------

--
-- Table structure for table `shop_services`
--

CREATE TABLE `shop_services` (
  `id` varchar(50) NOT NULL,
  `shop_id` varchar(50) NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `discount` tinyint(4) NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_services`
--

INSERT INTO `shop_services` (`id`, `shop_id`, `service_id`, `vehicle_id`, `discount`, `price`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('09580827-2668-4e1c-abbe-08ce19e3878f5ab62c28bdcc5', 'd64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '378bd005-b1c3-4598-a78b-10b379186ec75ab5f1a376b74', 40, 600, '1', '1', '2018-03-24 14:57:32', '2018-03-24 10:27:32'),
('18e09833-0d01-4894-b90f-e94c6909b0895ab632e300b69', 'b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '754b7616-9d6f-4ba8-9a30-9502c42013425ab5f23477b6f', 40, 900, '1', '1', '2018-03-24 06:43:39', '2018-03-24 06:43:39'),
('1b569278-f8eb-47e9-a8f3-1e87b9c596ae5ab6321b0f0bb', 'd64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '72379d8f-ca92-462c-a578-3d3fb4a518145ab5f1cb0e1b9', 40, 800, '1', '1', '2018-03-24 06:40:19', '2018-03-24 06:40:19'),
('33daa11a-a7d2-4543-8bfb-e0eb3765d21d5ab632c6b25c8', 'b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '378bd005-b1c3-4598-a78b-10b379186ec75ab5f1a376b74', 40, 600, '1', '1', '2018-03-24 06:43:10', '2018-03-24 06:43:10'),
('68779c25-fe4d-41c3-9807-e4be51a73e3a5ab632d50ef84', 'b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '72379d8f-ca92-462c-a578-3d3fb4a518145ab5f1cb0e1b9', 40, 800, '1', '1', '2018-03-24 06:43:25', '2018-03-24 06:43:25'),
('76c96501-d1fd-471d-bc06-c17c62c929345ab63284baeac', 'd64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', 'f7fa3685-4f72-4fb6-908d-b3a897d007ee5ab5f26fa0021', 40, 2000, '1', '1', '2018-03-24 16:45:25', '2018-03-24 10:19:55'),
('7adbbcbb-a800-46fc-b653-bf8853cfbfaa5ab631f36c554', 'd64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '754b7616-9d6f-4ba8-9a30-9502c42013425ab5f23477b6f', 40, 900, '1', '1', '2018-03-24 06:39:39', '2018-03-24 06:39:39'),
('9d50035e-a12d-4dc6-8658-d2cf26ac07045ab632f519f72', 'b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', 'f7fa3685-4f72-4fb6-908d-b3a897d007ee5ab5f26fa0021', 40, 2000, '1', '1', '2018-03-24 16:45:20', '2018-03-24 06:43:57'),
('bce48d85-3988-480a-84d1-da608e1d9cac5ab6329a645bb', 'd64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', 'c83c3311-97ed-4cc3-af11-29f5db58db905ab5f279ae72b', 40, 1200, '1', '1', '2018-03-24 16:45:30', '2018-03-24 06:42:45'),
('c472f9b4-2dda-43bc-afa7-a1cb997c91d65ab6330262c46', 'b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', 'c83c3311-97ed-4cc3-af11-29f5db58db905ab5f279ae72b', 40, 1200, '1', '1', '2018-03-24 16:45:36', '2018-03-24 06:44:10');

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
('0d4c68e5-40bd-4df5-9be2-a4f9332eb30c5ab68993a4f91', 'services', '1', '1', '2018-03-24 12:53:31', '2018-03-24 12:53:31'),
('0eeccb1c-14a9-464c-93fd-64e45289a41e5ab76d59e4fea', 'contact', '1', '1', '2018-03-25 06:05:21', '2018-03-25 06:05:21'),
('7877e3b2-4c01-484e-857b-f73b83f5f6b75ab76304ad62e', 'booking', '1', '1', '2018-03-25 05:21:16', '2018-03-25 05:21:16'),
('a8813f5c-7244-452c-9e66-1d3f3c6409715ab76c5f6ea3f', 'gallery', '1', '1', '2018-03-25 09:32:43', '2018-03-25 06:01:11'),
('c9a2d684-906e-461e-8e65-d105b17aab855ab612672b6b2', 'home', '1', '1', '2018-03-24 04:25:03', '2018-03-24 04:25:03'),
('e7cf515d-900a-4b01-acf4-f83a3cf984565ab76a955445b', 'shops', '1', '1', '2018-03-25 05:53:33', '2018-03-25 05:53:33');

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
('0f5e9f12-7d5c-47f2-8694-4a9b9f3a89f15aa3e50be27ad', '97535390-0c5c-4c08-ad68-fa4b7372c6595aa3e4ac05c14', 'image', 'ts', 'ss', '', '', '1', '1', '2018-03-10 14:00:47', '2018-03-10 09:30:47'),
('1635e1af-48e4-4126-9f06-7b131b3fceb75ab76aaebdc79', 'e7cf515d-900a-4b01-acf4-f83a3cf984565ab76a955445b', 'image', '', '', '', '[{\"source\":\"upload\",\"name\":\"header_03jpg_ecsize_1920_500_290863\",\"size\":290863,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"afbda5/3b91dad0-300e-11e8-a558-85f130939e4b_1521969832189.jpg\",\"s3_url\":\"prod-dakbro/afbda5/3b91dad0-300e-11e8-a558-85f130939e4b_1521969832189.jpg\",\"dimension\":{\"width\":1920,\"height\":500,\"size\":290863}}]', '1', '1', '2018-03-25 05:53:58', '2018-03-25 05:53:58'),
('2a7a230b-1514-4300-802f-90039c987dbd5ab76c70af2c7', 'a8813f5c-7244-452c-9e66-1d3f3c6409715ab76c5f6ea3f', 'image', '', 'Gallery', '', '[{\"source\":\"upload\",\"name\":\"4b47684f3d4d4e9a892845de106a41c9jpg_ecsize_1280_333_72507\",\"size\":72507,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"713beb/8b229520-304b-11e8-98a0-9b2fe4cec0aa_1521996164978.jpg\",\"s3_url\":\"prod-dakbro/713beb/8b229520-304b-11e8-98a0-9b2fe4cec0aa_1521996164978.jpg\",\"dimension\":{\"width\":1280,\"height\":333,\"size\":72507}}]', '1', '1', '2018-03-25 16:42:48', '2018-03-25 13:12:48'),
('3fec0650-abb9-4e7f-99f1-89176c8fa2745ab613a1da0b0', 'c9a2d684-906e-461e-8e65-d105b17aab855ab612672b6b2', 'image', 'Welcome to DAKbro Incredibles', 'We Love your Bike the same as you do', '', '[{\"source\":\"upload\",\"name\":\"1beaa372cae74c04b4832a65d9626c32jpg_ecsize_1280_500_70533\",\"size\":70533,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"20964b/b7e26610-3043-11e8-a50c-07e4454cfe41_1521992804081.jpg\",\"s3_url\":\"prod-dakbro/20964b/b7e26610-3043-11e8-a50c-07e4454cfe41_1521992804081.jpg\",\"dimension\":{\"width\":1280,\"height\":500,\"size\":70533}}]', '1', '1', '2018-03-25 15:46:48', '2018-03-25 12:16:48'),
('4bf27af7-ed61-411f-a66b-d1dd5d0b2fa35ab7634f711e2', '7877e3b2-4c01-484e-857b-f73b83f5f6b75ab76304ad62e', 'image', 'test', 'Booking', '', '[{\"source\":\"upload\",\"name\":\"4b47684f3d4d4e9a892845de106a41c9jpg_ecsize_1280_333_72507\",\"size\":72507,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"ea97e9/92e11740-3042-11e8-abaf-5b096182d47b_1521992312500.jpg\",\"s3_url\":\"prod-dakbro/ea97e9/92e11740-3042-11e8-abaf-5b096182d47b_1521992312500.jpg\",\"dimension\":{\"width\":1280,\"height\":333,\"size\":72507}}]', '1', '1', '2018-03-25 15:38:36', '2018-03-25 12:08:36'),
('5fb35aaa-692c-4849-8cd3-31c585f005325ab76d6a771f1', '0eeccb1c-14a9-464c-93fd-64e45289a41e5ab76d59e4fea', 'image', '', 'Contact', '', '[{\"source\":\"upload\",\"name\":\"d3383e944a7d4464bf1bddf60cd73fa9 Customjpg_ecsize_900_234_29428\",\"size\":29428,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"ad2412/94476ef0-304b-11e8-bdf8-49d150757a1e_1521996180319.jpg\",\"s3_url\":\"prod-dakbro/ad2412/94476ef0-304b-11e8-bdf8-49d150757a1e_1521996180319.jpg\",\"dimension\":{\"width\":900,\"height\":234,\"size\":29428}}]', '1', '1', '2018-03-25 16:43:02', '2018-03-25 13:13:02'),
('f54f2613-cfcc-4794-91a7-45d0a15ba7915ab689c293cec', '0d4c68e5-40bd-4df5-9be2-a4f9332eb30c5ab68993a4f91', 'image', 'Services', 'We Love your Bike the same as you do', '', '[{\"source\":\"upload\",\"name\":\"d3383e944a7d4464bf1bddf60cd73fa9jpg_ecsize_1280_333_59495\",\"size\":59495,\"type\":\"image/jpeg\",\"file\":\"\",\"ext\":\"jpg\",\"location\":\"5353bc/a874ecd0-3042-11e8-92da-c5cfd5a1438b_1521992348701.jpg\",\"s3_url\":\"prod-dakbro/5353bc/a874ecd0-3042-11e8-92da-c5cfd5a1438b_1521992348701.jpg\",\"dimension\":{\"width\":1280,\"height\":333,\"size\":59495}}]', '1', '1', '2018-03-25 15:39:13', '2018-03-25 12:09:13');

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
('bf9e6af7-9770-455f-8d29-89fbd3abafb95aae62febb399', 'ARUN NURA', 'I think Dakbro is the best bike polishersever. Love the price, convenience and customer service. Thanks so much! My bike looks like new. I will definitely come again.', '1', '1', '2018-03-18 08:30:46', '2018-03-24 08:42:07');

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
('', '', '', '1234567891', '', 'customer', NULL, NULL, NULL, 'eng', NULL, '	Asia/Kolkata', NULL, 'active', NULL, '', '', '2018-03-25 20:58:07', '2018-03-25 20:58:07'),
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
  `image` text NOT NULL,
  `hover_image` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `name`, `description`, `type`, `image`, `hover_image`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('378bd005-b1c3-4598-a78b-10b379186ec75ab5f1a376b74', 'Scooters', 'scooters', 'bike', '[{\"source\":\"upload\",\"name\":\"bike5_graypng_ecsize_80_49_1336\",\"size\":1336,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"ead8bb/74e5e930-2f4a-11e8-ba8e-63f1face88df_1521885747011.png\",\"s3_url\":\"prod-dakbro/ead8bb/74e5e930-2f4a-11e8-ba8e-63f1face88df_1521885747011.png\",\"dimension\":{\"width\":80,\"height\":49,\"size\":1336}}]', '[{\"source\":\"upload\",\"name\":\"bike5_whitepng_ecsize_80_49_1194\",\"size\":1194,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"f1b424/770ac500-2f4a-11e8-ba8e-63f1face88df_1521885750608.png\",\"s3_url\":\"prod-dakbro/f1b424/770ac500-2f4a-11e8-ba8e-63f1face88df_1521885750608.png\",\"dimension\":{\"width\":80,\"height\":49,\"size\":1194}}]', '1', '1', '2018-03-24 10:02:38', '2018-03-24 05:32:38'),
('72379d8f-ca92-462c-a578-3d3fb4a518145ab5f1cb0e1b9', 'upto 220cc', 'upto 220cc', 'bike', '[{\"source\":\"upload\",\"name\":\"bike4_graypng_ecsize_80_49_1909\",\"size\":1909,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"94d1ba/6d4f5080-2f4a-11e8-a722-c351bccb2be0_1521885734280.png\",\"s3_url\":\"prod-dakbro/94d1ba/6d4f5080-2f4a-11e8-a722-c351bccb2be0_1521885734280.png\",\"dimension\":{\"width\":80,\"height\":49,\"size\":1909}}]', '[{\"source\":\"upload\",\"name\":\"bike4_whitepng_ecsize_80_49_1706\",\"size\":1706,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"ae6140/6f2bffc0-2f4a-11e8-a722-c351bccb2be0_1521885737404.png\",\"s3_url\":\"prod-dakbro/ae6140/6f2bffc0-2f4a-11e8-a722-c351bccb2be0_1521885737404.png\",\"dimension\":{\"width\":80,\"height\":49,\"size\":1706}}]', '1', '1', '2018-03-24 11:09:05', '2018-03-24 06:39:05'),
('754b7616-9d6f-4ba8-9a30-9502c42013425ab5f23477b6f', '250cc - 500cc', '250cc - 500cc', 'bike', '[{\"source\":\"upload\",\"name\":\"bike1_graypng_ecsize_80_49_1797\",\"size\":1797,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"ee6247/5c5db2d0-2f4a-11e8-b131-2f2a730cbd88_1521885705852.png\",\"s3_url\":\"prod-dakbro/ee6247/5c5db2d0-2f4a-11e8-b131-2f2a730cbd88_1521885705852.png\",\"dimension\":{\"width\":80,\"height\":49,\"size\":1797}}]', '[{\"source\":\"upload\",\"name\":\"bike1_whitepng_ecsize_80_49_1611\",\"size\":1611,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"7c5fb2/633f5360-2f4a-11e8-b131-2f2a730cbd88_1521885717398.png\",\"s3_url\":\"prod-dakbro/7c5fb2/633f5360-2f4a-11e8-b131-2f2a730cbd88_1521885717398.png\",\"dimension\":{\"width\":80,\"height\":49,\"size\":1611}}]', '1', '1', '2018-03-24 10:02:00', '2018-03-24 05:32:00'),
('c83c3311-97ed-4cc3-af11-29f5db58db905ab5f279ae72b', '500cc - 800cc', '500cc - 800cc', 'bike', '[{\"source\":\"upload\",\"name\":\"bike2_graypng_ecsize_80_49_1589\",\"size\":1589,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"81e181/6ba80eb0-2f82-11e8-ae0b-1deb379222e3_1521909783323.png\",\"s3_url\":\"prod-dakbro/81e181/6ba80eb0-2f82-11e8-ae0b-1deb379222e3_1521909783323.png\",\"dimension\":{\"width\":80,\"height\":49,\"size\":1589}}]', '[{\"source\":\"upload\",\"name\":\"bike2_whitepng_ecsize_80_49_1439\",\"size\":1439,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"4ffec7/6fdcb7b0-2f82-11e8-ae0b-1deb379222e3_1521909790379.png\",\"s3_url\":\"prod-dakbro/4ffec7/6fdcb7b0-2f82-11e8-ae0b-1deb379222e3_1521909790379.png\",\"dimension\":{\"width\":80,\"height\":49,\"size\":1439}}]', '1', '1', '2018-03-24 16:43:12', '2018-03-24 12:13:12'),
('f7fa3685-4f72-4fb6-908d-b3a897d007ee5ab5f26fa0021', 'Above 800cc', 'Above 800cc', 'bike', '[{\"source\":\"upload\",\"name\":\"bike3_graypng_ecsize_80_49_1580\",\"size\":1580,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"b64a2c/5e24bcc0-2f82-11e8-a52d-5d9bdadb39f1_1521909760652.png\",\"s3_url\":\"prod-dakbro/b64a2c/5e24bcc0-2f82-11e8-a52d-5d9bdadb39f1_1521909760652.png\",\"dimension\":{\"width\":80,\"height\":49,\"size\":1580}}]', '[{\"source\":\"upload\",\"name\":\"bike3_whitepng_ecsize_80_49_1383\",\"size\":1383,\"type\":\"image/png\",\"file\":\"\",\"ext\":\"png\",\"location\":\"400f7b/63692810-2f82-11e8-a52d-5d9bdadb39f1_1521909769489.png\",\"s3_url\":\"prod-dakbro/400f7b/63692810-2f82-11e8-a52d-5d9bdadb39f1_1521909769489.png\",\"dimension\":{\"width\":80,\"height\":49,\"size\":1383}}]', '1', '1', '2018-03-24 16:42:54', '2018-03-24 12:12:54');

-- --------------------------------------------------------

--
-- Structure for view `best_price_services`
--
DROP TABLE IF EXISTS `best_price_services`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `best_price_services`  AS  select `shop_services`.`service_id` AS `service_id`,`shop_services`.`vehicle_id` AS `vehicle_id`,`s`.`service_time` AS `service_time`,`shop_services`.`shop_id` AS `shop_id`,`shop_services`.`price` AS `price`,`shop_services`.`discount` AS `discount`,`s`.`name` AS `name`,`s`.`description` AS `description`,`s`.`image` AS `image`,`s`.`service_details` AS `service_details` from (`shop_services` left join `services` `s` on((`s`.`id` = `shop_services`.`service_id`))) order by `shop_services`.`price` ;

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
-- Indexes for table `gallery_images`
--
ALTER TABLE `gallery_images`
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
