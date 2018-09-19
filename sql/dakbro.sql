-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 10, 2018 at 09:46 PM
-- Server version: 5.5.59
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dakbro`
--

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE IF NOT EXISTS `areas` (
  `id` varchar(50) NOT NULL,
  `country_id` varchar(50) NOT NULL,
  `state_id` varchar(50) NOT NULL,
  `city_id` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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
--
CREATE TABLE IF NOT EXISTS `best_price_services` (
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

CREATE TABLE IF NOT EXISTS `cache` (
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

CREATE TABLE IF NOT EXISTS `cities` (
  `id` varchar(50) NOT NULL,
  `code` varchar(10) NOT NULL,
  `name` varchar(40) NOT NULL,
  `country_id` varchar(50) NOT NULL,
  `state_id` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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

CREATE TABLE IF NOT EXISTS `contact` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `comments` text NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `name`, `email`, `phone`, `subject`, `comments`, `created_time`, `updated_time`) VALUES
('', 'arun', 'arunnura23@gmail.com', '1234567890', '', 'test\r\ntest', '2018-04-07 16:48:09', '2018-04-07 11:18:09'),
('0e34ff87-81ed-4f07-9377-1243e262f0455ac8d257cdd45', 'arunnura', 'arun.izaap@gmail.com', '9176665532', '', 'Hi Please check my response.', '2018-04-07 19:44:47', '2018-04-07 14:14:48'),
('189499a0-723f-49c4-a4eb-298565a0da035ac8ade121c45', 'arunnura', 'arunnura23@gmail.com', '1234567890', '', 'ddd', '2018-04-07 17:09:13', '2018-04-07 11:39:13'),
('3c43424c-27d5-45af-8328-e7645ce539ca5ac8d03a56ea0', 'arun', 'arunnura23@gmail.com', '1234567890', '', 'test', '2018-04-07 19:35:46', '2018-04-07 14:05:46'),
('47206ab1-2bc2-4d0b-8359-d2cccfc94d355ac8d0ec005a6', 'arunnura', 'arunnura23@gmail.com', '9176665532', '', 'Hi How are you', '2018-04-07 19:38:43', '2018-04-07 14:08:44'),
('48b5092f-f4af-4e6a-a14d-cb8c3d1b60bf5ac8d15db74b8', 'arunnura', 'arunnura23@gmail.com', '1234567890', '', 'arun.izaap@gmail.com', '2018-04-07 19:40:37', '2018-04-07 14:10:37'),
('514c1fb3-1a71-4c9e-a26d-1aab3cbd284d5ac8acf9bcb71', 'arun', 'arunnura23@gmail.com', '1234567890', '', 'test', '2018-04-07 17:05:21', '2018-04-07 11:35:21'),
('72790dd8-2f38-4900-aefa-37a3bad8543e5ac8ceb08edd2', 'arun', 'arunnura23@gmail.com', '1234567890', '', 'test', '2018-04-07 19:29:12', '2018-04-07 13:59:12'),
('775f8904-4481-4dcf-85ec-a99d03d2a8d75ac8ce6f1aa63', 'arun', 'arun.izaap@gmail.com', '1234567890', '', 'test', '2018-04-07 19:28:07', '2018-04-07 13:58:07'),
('8a6d7869-2ea7-491e-9d7f-7df1ac0f4f225ac8cf053d3bd', 'arun', 'arunnura23@gmail.com', '1234567890', '', 'test', '2018-04-07 19:30:37', '2018-04-07 14:00:37'),
('bf2ffc40-57f0-4d9e-9f26-992503f0239c5ac8d0709c4fd', 'arunnura', 'arunnura23@gmail.com', '1234567890', '', 'test', '2018-04-07 19:36:40', '2018-04-07 14:06:40'),
('d921f88b-c102-431a-b99a-7be7f04bb2de5ac8aa66d4ca1', 'arun', 'arun.izaap@gmail.com', '1234567890', '', 'test \r\ntest \r\ntest', '2018-04-07 16:54:22', '2018-04-07 11:24:22');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` varchar(50) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', 'IN', 'India', '1', '1', '2018-04-08 21:48:26', '2018-04-08 16:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE IF NOT EXISTS `coupons` (
  `id` varchar(50) NOT NULL,
  `code` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NULL DEFAULT NULL,
  `type` enum('percentage','cash') NOT NULL,
  `amount` double NOT NULL,
  `allowed_count` int(11) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `discounts`
--

CREATE TABLE IF NOT EXISTS `discounts` (
  `id` varchar(50) NOT NULL,
  `type` enum('cash','percentage') NOT NULL,
  `amount` double NOT NULL,
  `service_id` int(11) NOT NULL,
  `shop_id` varchar(50) NOT NULL,
  `start_date` timestamp NULL DEFAULT NULL,
  `end_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `name`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('0a65646a-222d-4ee3-be19-35d43d3156b95aca0f77efb21', 'Alloy Wheel Painting', '1', '1', '2018-04-08 18:17:51', '2018-04-08 18:18:02'),
('979ad21c-eb57-472b-81aa-0a372f58f6cf5ab7be0fae1dc', 'Hand Polish', '1', '1', '2018-03-25 11:49:43', '2018-03-25 11:49:43'),
('97b07783-0a53-4e12-a093-726c285a73595ab7bda451f5f', 'polishing', '1', '1', '2018-03-25 11:47:56', '2018-03-25 11:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `gallery_images`
--

CREATE TABLE IF NOT EXISTS `gallery_images` (
  `id` varchar(50) NOT NULL,
  `gallery_id` varchar(50) NOT NULL,
  `type` enum('image','youtube') NOT NULL,
  `title` text,
  `description` text,
  `url` text NOT NULL,
  `image` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `gallery_images`
--

INSERT INTO `gallery_images` (`id`, `gallery_id`, `type`, `title`, `description`, `url`, `image`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('5fcc0598-a4ea-464b-8e7d-0a448bf9e41e5ab7be2ec6319', '97b07783-0a53-4e12-a093-726c285a73595ab7bda451f5f', 'image', 'Polishing', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '[{"source":"upload","name":"unnamedpng_ecsize_512_250_151946","size":151946,"type":"image/png","file":"","ext":"png","location":"500ba6/4fc39ca0-3040-11e8-a8ce-998ef9d8d3f8_1521991340906.png","s3_url":"prod-dakbro/500ba6/4fc39ca0-3040-11e8-a8ce-998ef9d8d3f8_1521991340906.png","dimension":{"width":512,"height":250,"size":151946}}]', '1', '1', '2018-03-25 21:48:53', '2018-03-25 11:52:25'),
('97f0c3c2-c790-4943-91dc-2f3f9e81ce9f5ab7bef1c08c2', '979ad21c-eb57-472b-81aa-0a372f58f6cf5ab7be0fae1dc', 'image', 'Hand polish', 'orem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '', '[{"source":"upload","name":"image_10jpg_ecsize_760_506_132676","size":132676,"type":"image/jpeg","file":"","ext":"jpg","location":"ffcb8a/5c8b18a0-3040-11e8-a0bd-3db8d24bc9b5_1521991362346.jpg","s3_url":"prod-dakbro/ffcb8a/5c8b18a0-3040-11e8-a0bd-3db8d24bc9b5_1521991362346.jpg","dimension":{"width":760,"height":506,"size":132676}}]', '1', '1', '2018-03-25 21:48:57', '2018-03-25 11:53:29');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` varchar(50) NOT NULL,
  `date` int(11) NOT NULL,
  `reason` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `date`, `reason`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('2febd1d2-392c-490f-ae04-f4c43ae87e245ab3bbfe35db1', 1520899200, 'dsdsfdsfdsfd', '1', '1', '2018-03-22 09:51:50', '2018-03-22 09:51:50'),
('3091bc0f-5b84-4d65-80bc-37c18b6175345abde8afb433f', 1520985600, 'ddd', 'e68f3a6b-83b5-4069-ab87-bd9219c2ceba5a5586a8c3c2a', 'e68f3a6b-83b5-4069-ab87-bd9219c2ceba5a5586a8c3c2a', '2018-03-30 04:05:11', '2018-03-30 04:05:11'),
('69ff1813-3ecf-4602-a4d1-5fedf055f6835ab3be9b426e8', 1521676800, 'dfgfd', '1', '1', '2018-03-22 10:02:59', '2018-03-22 10:02:59');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `created_id` int(11) NOT NULL,
  `updated_id` int(11) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `page_settings`
--

CREATE TABLE IF NOT EXISTS `page_settings` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `page_title` varchar(255) DEFAULT NULL,
  `meta_key` varchar(255) DEFAULT NULL,
  `meta_desc` varchar(255) DEFAULT NULL,
  `image` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `page_settings`
--

INSERT INTO `page_settings` (`id`, `name`, `page_title`, `meta_key`, `meta_desc`, `image`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('281ec800-cf2d-4723-ac7a-fd94a2fcbabb5ab6898a414bc', 'services', 'Dakbro Incredible Polishing Studio - Services', 'Bike Polish, All vehicles', 'We offer all two wheeler polishing serivce.', '[{"source":"upload","name":"ad9fa9f0196a11e8b2155560f05b3485_1519480660495jpg_ecsize_500_300_22206","size":22206,"type":"image/jpeg","file":"","ext":"jpg","location":"bc617d/0b031810-2f88-11e8-b705-af4668d0addb_1521912198161.jpg","s3_url":"prod-dakbro/bc617d/0b031810-2f88-11e8-b705-af4668d0addb_1521912198161.jpg","dimension":{"width":500,"height":300,"size":22206}}]', '1', '1', '2018-03-24 12:53:22', '2018-03-24 12:53:22'),
('b7515e16-5769-4398-a950-6d2adc60c9f75a916f5c3fc5c', 'home', 'Dakbro Incredible Polishing Studio', 'bike deatling, tefelon coating,ceramic coating,bike paiting,rust removal,', 'Bike detailng and Quick service', '[{"source":"upload","name":"dakjpg_ecsize_500_300_22206","size":22206,"type":"image/jpeg","file":"","ext":"jpg","location":"d2960a/ad9fa9f0-196a-11e8-b215-5560f05b3485_1519480660495.jpg","s3_url":"prod-dakbro/d2960a/ad9fa9f0-196a-11e8-b215-5560f05b3485_1519480660495.jpg","dimension":{"width":500,"height":300,"size":22206}}]', '1', '1', '2018-03-24 17:15:42', '2018-04-08 17:39:05');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE IF NOT EXISTS `permissions` (
  `id` varchar(50) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `created_id` int(50) NOT NULL,
  `updated_id` int(50) NOT NULL,
  `permissions` text,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order`
--

CREATE TABLE `sales_order` (
  `id` varchar(50) NOT NULL,
  `shop_id` varchar(50) NOT NULL,
  `user_id` varchar(50) DEFAULT NULL,
  `order_status` enum('ACCEPTED','FAILED','PROCESSING','PENDING','SHIPPED','COMPLETED','HOLD') NOT NULL,
  `total_amount` double NOT NULL,
  `total_discount` double NOT NULL DEFAULT '0',
  `total_tax` double NOT NULL,
  `payment_type` varchar(45) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `txn_id` text NOT NULL,
  `payment_status` enum('PENDING','PAID') NOT NULL,
  `service_date` date NOT NULL,
  `vehicle_model` varchar(100) NOT NULL,
  `vehicle_number` varchar(100) NOT NULL,
  `message` tinytext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sales_order_item`
--

CREATE TABLE `sales_order_item` (
  `id` varchar(50) NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `item_status` enum('NEW','PENDING','ACCEPTED','SHIPPED','COMPLETE') NOT NULL,
  `unit_price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  `sales_order_id` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` datetime NOT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE IF NOT EXISTS `services` (
  `id` varchar(50) NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT '0',
  `parent_id` varchar(50) DEFAULT NULL,
  `name` text NOT NULL,
  `image` text NOT NULL,
  `short_text` text NOT NULL,
  `description` text NOT NULL,
  `service_details` text NOT NULL,
  `service_time` int(11) NOT NULL DEFAULT '0',
  `service_image` text NOT NULL,
  `type` enum('bike','car') NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `order_no`, `parent_id`, `name`, `image`, `short_text`, `description`, `service_details`, `service_time`, `service_image`, `type`, `created_time`, `updated_time`, `created_id`, `updated_id`) VALUES
('33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', 1, NULL, 'Polishing', '[{"source":"upload","name":"bike wash Custompng_ecsize_26_33_1201","size":1201,"type":"image/png","file":"","ext":"png","location":"55919/cc0e7680-2f4c-11e8-92c8-777ecf08a4e4_1521886752232.png","s3_url":"prod-dakbro/55919/cc0e7680-2f4c-11e8-92c8-777ecf08a4e4_1521886752232.png","dimension":{"width":26,"height":33,"size":1201}}]', 'Bike Polishing', 'Metro tical dotrium est terminal integer forks driven suspendisse une novum etos pellentesque a non felis maecenas magna ligato primus.', 'Power wash\r\nRemoving scratches \r\nTeflon Coating "(PIMPOM)"\r\nRust removal\r\nAnti rust coating \r\nChrome polishing \r\nApplying protector\r\nSmart Painting(slincer & Stands)\r\nTyre & sheet dressing\r\nPaint protector\r\nPlastic & Vinyl exterior polishing\r\nLabour Charges\r\nService Charges.', 60, '[{"source":"upload","name":"eeejpg_ecsize_1000_391_41839","size":41839,"type":"image/jpeg","file":"","ext":"jpg","location":"2f9118/42beccb0-3044-11e8-9af3-330f7252665b_1521993037050.jpg","s3_url":"prod-dakbro/2f9118/42beccb0-3044-11e8-9af3-330f7252665b_1521993037050.jpg","dimension":{"width":1000,"height":391,"size":41839}}]', 'bike', '2018-03-24 01:54:41', '2018-03-25 12:20:45', '1', '1'),
('48e5658f-15b1-4538-92c9-2893dfcf5def5ab626bb302e1', 2, NULL, 'Chain lubrication', '[{"source":"upload","name":"chain 2jpg_ecsize_33_33_1015","size":1015,"type":"image/jpeg","file":"","ext":"jpg","location":"4200f7/269a8c10-2f4d-11e8-bf04-df082fb7005a_1521886904145.jpg","s3_url":"prod-dakbro/4200f7/269a8c10-2f4d-11e8-bf04-df082fb7005a_1521886904145.jpg","dimension":{"width":33,"height":33,"size":1015}}]', 'Bike Chain lubrication', 'Metro tical dotrium est terminal integer forks driven suspendisse une novum etos pellentesque a non felis maecenas magna ligato primus.', 'Bike Chain lubrication\r\nLabour Charges\r\nService Charges.', 60, '[{"source":"upload","name":"Cover_Image_1024x1024 Customjpg_ecsize_1000_535_118620","size":118620,"type":"image/jpeg","file":"","ext":"jpg","location":"965857/451fd1b0-3045-11e8-bbea-639dce617f77_1521993470539.jpg","s3_url":"prod-dakbro/965857/451fd1b0-3045-11e8-bbea-639dce617f77_1521993470539.jpg","dimension":{"width":1000,"height":535,"size":118620}}]', 'bike', '2018-03-24 05:51:47', '2018-03-25 12:27:56', '1', '1'),
('5a12dcdd-c593-4e94-9929-12e4254ad59e5ab62655a61b9', 3, NULL, 'Oil change', '[{"source":"upload","name":"oilpng_ecsize_33_22_770","size":770,"type":"image/png","file":"","ext":"png","location":"3006ed/e677a1e0-2f4c-11e8-ab67-872f4b0bf26b_1521886796541.png","s3_url":"prod-dakbro/3006ed/e677a1e0-2f4c-11e8-ab67-872f4b0bf26b_1521886796541.png","dimension":{"width":33,"height":22,"size":770}}]', 'Bike Oil change.', 'Metro tical dotrium est terminal integer forks driven suspendisse une novum etos pellentesque a non felis maecenas magna ligato primus.', 'Oil changes\r\nLabour Charges\r\nService Charges.', 60, '[{"source":"upload","name":"GYTROilChangeKit2banner Customjpg_ecsize_1000_526_119358","size":119358,"type":"image/jpeg","file":"","ext":"jpg","location":"82ce54/fa338570-3044-11e8-b502-17b41fc482f5_1521993344839.jpg","s3_url":"prod-dakbro/82ce54/fa338570-3044-11e8-b502-17b41fc482f5_1521993344839.jpg","dimension":{"width":1000,"height":526,"size":119358}}]', 'bike', '2018-03-24 05:50:05', '2018-03-25 12:25:48', '1', '1'),
('7448ecd3-1ea0-47d6-98e0-4d48d67276a95ab62780cbde3', 4, NULL, '3M Scratch Proof Sticker', '[{"source":"upload","name":"3m Custompng_ecsize_33_33_825","size":825,"type":"image/png","file":"","ext":"png","location":"b67414/9b8c98b0-2f4d-11e8-be96-7d1c696821a2_1521887100347.png","s3_url":"prod-dakbro/b67414/9b8c98b0-2f4d-11e8-be96-7d1c696821a2_1521887100347.png","dimension":{"width":33,"height":33,"size":825}}]', 'Bike 3M Scratch Proof Sticker', 'Metro tical dotrium est terminal integer forks driven suspendisse une novum etos pellentesque a non felis maecenas magna ligato primus.', '3M Scratch Proof Sticker\r\nLabour Charges\r\nService Charges.', 60, '[{"source":"upload","name":"maxresdefault Customjpg_ecsize_1000_563_109613","size":109613,"type":"image/jpeg","file":"","ext":"jpg","location":"28ac65/d9c604b0-3045-11e8-92d1-310e82d50871_1521993719931.jpg","s3_url":"prod-dakbro/28ac65/d9c604b0-3045-11e8-92d1-310e82d50871_1521993719931.jpg","dimension":{"width":1000,"height":563,"size":109613}}]', 'bike', '2018-03-24 05:55:04', '2018-03-25 12:32:03', '1', '1'),
('86629b11-c4b3-47b2-8d32-ffdb1955e1935ab627524ac3a', 5, NULL, 'Teflon Coating', '[{"source":"upload","name":"teflon Custompng_ecsize_31_33_1592","size":1592,"type":"image/png","file":"","ext":"png","location":"7922d8/809229d0-2f4d-11e8-8bc3-7bbd9825bebd_1521887055085.png","s3_url":"prod-dakbro/7922d8/809229d0-2f4d-11e8-8bc3-7bbd9825bebd_1521887055085.png","dimension":{"width":31,"height":33,"size":1592}}]', 'Bike Teflon Coating\r\n', 'Etiam bibendum est terminal metro. Suspendisse a novum etos pellentesque a non felis maecenas module vimeo est malesuada forte. Primus elit lectus at felis, malesuada ultricies obec curabitur et ligula sande porta node vestibulum une commodo a convallis laoreet enim. Morbi at sinum interdum etos fermentum. Nulla elite terminal integer vespa node supreme morbi suspendisse a novum etos module un metro.', 'Teflon Coating\r\nLabour Charges\r\nService Charges.', 60, '[{"source":"upload","name":"p4847128355 Customjpg_ecsize_1000_661_176004","size":176004,"type":"image/jpeg","file":"","ext":"jpg","location":"b07d34/4ea39ef0-3046-11e8-ab14-21afbad44d84_1521993915999.jpg","s3_url":"prod-dakbro/b07d34/4ea39ef0-3046-11e8-ab14-21afbad44d84_1521993915999.jpg","dimension":{"width":1000,"height":661,"size":176004}}]', 'bike', '2018-03-24 05:54:18', '2018-03-25 12:35:20', '1', '1'),
('ff87e5ee-3b05-49f7-9a49-df1306b164e55ab627244b851', 7, '', 'Alloy Wheel Painting', '[{"source":"upload","name":"alloy Custompng_ecsize_31_33_2048","size":2048,"type":"image/png","file":"","ext":"png","location":"6ab9f6/60dbe090-2f4d-11e8-b15b-b33d6d99b05b_1521887001881.png","s3_url":"prod-dakbro/6ab9f6/60dbe090-2f4d-11e8-b15b-b33d6d99b05b_1521887001881.png","dimension":{"width":31,"height":33,"size":2048}}]', 'Bike Alloy Wheel Coating', 'Etiam bibendum est terminal metro. Suspendisse a novum etos pellentesque a non felis maecenas module vimeo est malesuada forte. Primus elit lectus at felis, malesuada ultricies obec curabitur et ligula sande porta node vestibulum une commodo a convallis laoreet enim. Morbi at sinum interdum etos fermentum. Nulla elite terminal integer vespa node supreme morbi suspendisse a novum etos module un metro.', 'Alloy Wheel Coating\r\nLabour Charges\r\nService Charges.', 60, '[{"source":"upload","name":"imgarwcbannerpowdercoating Customjpg_ecsize_1000_417_141299","size":141299,"type":"image/jpeg","file":"","ext":"jpg","location":"6fda80/b8aaa2a0-3044-11e8-9dea-d950a4c9e927_1521993234890.jpg","s3_url":"prod-dakbro/6fda80/b8aaa2a0-3044-11e8-9dea-d950a4c9e927_1521993234890.jpg","dimension":{"width":1000,"height":417,"size":141299}}]', 'bike', '2018-03-24 05:53:32', '2018-04-08 18:38:08', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `service_vehicles`
--

CREATE TABLE IF NOT EXISTS `service_vehicles` (
  `id` varchar(50) NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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

CREATE TABLE IF NOT EXISTS `shops` (
  `id` varchar(140) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner_id` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(80) NOT NULL,
  `about` text NOT NULL,
  `address` text NOT NULL,
  `lat` varchar(50) DEFAULT NULL,
  `lon` varchar(50) DEFAULT NULL,
  `country_id` int(11) NOT NULL,
  `state_id` varchar(50) NOT NULL,
  `city_id` varchar(50) NOT NULL,
  `area_id` varchar(50) NOT NULL,
  `start_day` varchar(10) NOT NULL,
  `pickup` enum('yes','no','','') NOT NULL DEFAULT 'yes',
  `end_day` varchar(10) NOT NULL,
  `start_time` varchar(11) NOT NULL,
  `end_time` varchar(11) NOT NULL,
  `experience` varchar(20) NOT NULL,
  `ratings` tinyint(4) NOT NULL,
  `no_of_mechanics` tinyint(4) NOT NULL,
  `image` text NOT NULL,
  `shop_area` int(11) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shops`
--

INSERT INTO `shops` (`id`, `name`, `owner_id`, `phone`, `email`, `about`, `address`, `lat`, `lon`, `country_id`, `state_id`, `city_id`, `area_id`, `start_day`, `pickup`, `end_day`, `start_time`, `end_time`, `experience`, `ratings`, `no_of_mechanics`, `image`, `shop_area`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', 'DAKBRO Incredible Bike Polishing Studio', 'fec4b885-4525-4b2e-8437-599bc21ec2a65aca0aab7b135', '9176084047', 'kalanidhi.d@gmail.com', 'DAKBRO Incredible Bike Polishing Studio Anna Nagar.', '28th Cross St, Besant Nagar,', '13.000712', '80.270327', 6, '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'bdb8ea97-b87d-41d0-a51d-aa1e3d8216a85a531e059f15d', 'Monday', 'yes', 'Saturday', '10:00 AM', '12:00 PM', '5', 4, 2, '[{"source":"upload","name":"bannerjpg_ecsize_1023_500_119364","size":119364,"type":"image/jpeg","file":"","ext":"jpg","location":"7deb89/16dcd320-2f50-11e8-92c5-77d11f7a6e5b_1521888166225.jpg","s3_url":"prod-dakbro/7deb89/16dcd320-2f50-11e8-92c5-77d11f7a6e5b_1521888166225.jpg","dimension":{"width":1023,"height":500,"size":119364}}]', 500, '1', '1', '2018-03-30 07:12:59', '2018-04-08 18:50:43'),
('d64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', 'DAKBRO Incredible Bike Polishing Studio', '5349a9f7-5e7f-43c8-bb15-d0bf15ccbf3a5aca0a5f2f8db', '9176599630', 'incrediblepolishing@gmail.com', 'Dakbro Incredible BIKE Polishing Studio', '468, 7th Main Rd, Ishwarya Nagar, MGR Colony,', '13.006400', '80.271257', 6, '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'b3136e61-5513-4db6-b94a-e00bb58efef75ab6291409e27', 'Monday', 'yes', 'Sunday', '10:00 AM', '8:30 PM', '5', 4, 3, '[{"source":"upload","name":"bannerjpg_ecsize_1023_500_119364","size":119364,"type":"image/jpeg","file":"","ext":"jpg","location":"298611/63077db0-2f4e-11e8-b61e-4f0d53409b46_1521887435019.jpg","s3_url":"prod-dakbro/298611/63077db0-2f4e-11e8-b61e-4f0d53409b46_1521887435019.jpg","dimension":{"width":1023,"height":500,"size":119364}}]', 450, '1', '1', '2018-03-30 07:19:07', '2018-04-08 18:47:17');

-- --------------------------------------------------------

--
-- Table structure for table `shop_services`
--

CREATE TABLE IF NOT EXISTS `shop_services` (
  `id` varchar(50) NOT NULL,
  `shop_id` varchar(50) NOT NULL,
  `service_id` varchar(50) NOT NULL,
  `vehicle_id` varchar(50) NOT NULL,
  `discount` tinyint(4) NOT NULL DEFAULT '0',
  `price` double NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `shop_services`
--

INSERT INTO `shop_services` (`id`, `shop_id`, `service_id`, `vehicle_id`, `discount`, `price`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('18e09833-0d01-4894-b90f-e94c6909b0895ab632e300b69', 'b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '754b7616-9d6f-4ba8-9a30-9502c42013425ab5f23477b6f', 40, 900, '1', '1', '2018-03-24 06:43:39', '2018-03-24 06:43:39'),
('25da44f2-c5e7-4fc5-b3c7-effa1a9486925aca176f8c71e', 'd64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', 'de6b40be-f865-4e36-bb3e-9204668ff1e35aca1174b027a', 40, 600, '1', '1', '2018-04-08 18:51:51', '2018-04-08 18:51:51'),
('33daa11a-a7d2-4543-8bfb-e0eb3765d21d5ab632c6b25c8', 'b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '378bd005-b1c3-4598-a78b-10b379186ec75ab5f1a376b74', 40, 600, '1', '1', '2018-03-24 06:43:10', '2018-03-24 06:43:10'),
('68779c25-fe4d-41c3-9807-e4be51a73e3a5ab632d50ef84', 'b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '72379d8f-ca92-462c-a578-3d3fb4a518145ab5f1cb0e1b9', 40, 800, '1', '1', '2018-03-24 06:43:25', '2018-03-24 06:43:25'),
('9d50035e-a12d-4dc6-8658-d2cf26ac07045ab632f519f72', 'b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', 'f7fa3685-4f72-4fb6-908d-b3a897d007ee5ab5f26fa0021', 40, 2000, '1', '1', '2018-03-24 16:45:20', '2018-03-24 06:43:57'),
('a6a9246a-5d85-45dd-8df7-86107c0812b75aca1845ed667', 'd64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', 'ff87e5ee-3b05-49f7-9a49-df1306b164e55ab627244b851', 'de6b40be-f865-4e36-bb3e-9204668ff1e35aca1174b027a', 10, 300, '1', '1', '2018-04-08 18:55:25', '2018-04-08 18:55:42'),
('ac7fa789-09f5-49e4-847c-0bff45f147495aca178bed149', 'd64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', '288a3e14-80a4-4593-8f1a-8ca8ae03e58c5aca12a748801', 40, 800, '1', '1', '2018-04-08 18:52:19', '2018-04-08 18:52:19'),
('c472f9b4-2dda-43bc-afa7-a1cb997c91d65ab6330262c46', 'b928183b-4f38-4d75-b37a-9edf63216fef5ab62bc44d6de', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', 'c83c3311-97ed-4cc3-af11-29f5db58db905ab5f279ae72b', 40, 1200, '1', '1', '2018-03-24 16:45:36', '2018-03-24 06:44:10'),
('ccdeff2c-c44a-49c9-8bad-9044ea3ba2765aca17ba422e1', 'd64c006f-d8b0-4423-b898-fb9134db1ee65ab628f1c8b8c', '33533cde-a517-4665-bac3-fde0369a79825ab5ef29392cf', 'b2a42699-4f56-43b8-93b1-4a832d2406ab5aca133812cc4', 40, 900, '1', '1', '2018-04-08 18:53:06', '2018-04-08 18:53:06');

-- --------------------------------------------------------

--
-- Table structure for table `sliders`
--

CREATE TABLE IF NOT EXISTS `sliders` (
  `id` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sliders`
--

INSERT INTO `sliders` (`id`, `name`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('119f6ab1-72d6-4512-bcdb-651ec6896e315aca0e30961cf', 'contact', '1', '1', '2018-04-08 18:12:24', '2018-04-08 18:12:24'),
('84491f61-685a-4442-b123-889288d1015e5aca0dd821e39', 'gallery', '1', '1', '2018-04-08 18:10:56', '2018-04-08 18:10:56'),
('9c548ac3-7ee3-4383-a825-cf312ecf46525aca0d332e12a', 'services', '1', '1', '2018-04-08 18:08:11', '2018-04-08 18:08:11'),
('f6aa7702-0071-482a-80fc-df36aff210295aca0c1e3d63c', 'home', '1', '1', '2018-04-08 18:03:34', '2018-04-08 18:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `slider_images`
--

CREATE TABLE IF NOT EXISTS `slider_images` (
  `id` varchar(50) NOT NULL,
  `slider_id` varchar(50) NOT NULL,
  `type` enum('image','youtube') NOT NULL,
  `title` text,
  `sub_title` text,
  `url` text NOT NULL,
  `image` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `slider_images`
--

INSERT INTO `slider_images` (`id`, `slider_id`, `type`, `title`, `sub_title`, `url`, `image`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('0f5e9f12-7d5c-47f2-8694-4a9b9f3a89f15aa3e50be27ad', '97535390-0c5c-4c08-ad68-fa4b7372c6595aa3e4ac05c14', 'image', 'ts', 'ss', '', '', '1', '1', '2018-03-10 14:00:47', '2018-03-10 09:30:47'),
('1635e1af-48e4-4126-9f06-7b131b3fceb75ab76aaebdc79', 'e7cf515d-900a-4b01-acf4-f83a3cf984565ab76a955445b', 'image', '', '', '', '[{"source":"upload","name":"header_03jpg_ecsize_1920_500_290863","size":290863,"type":"image/jpeg","file":"","ext":"jpg","location":"afbda5/3b91dad0-300e-11e8-a558-85f130939e4b_1521969832189.jpg","s3_url":"prod-dakbro/afbda5/3b91dad0-300e-11e8-a558-85f130939e4b_1521969832189.jpg","dimension":{"width":1920,"height":500,"size":290863}}]', '1', '1', '2018-03-25 05:53:58', '2018-03-25 05:53:58'),
('1f387c8a-8959-4dd7-b867-7adfbbb5a4d55aca0e0357355', '84491f61-685a-4442-b123-889288d1015e5aca0dd821e39', 'image', 'Gallery', '', '', '[{"source":"upload","name":"4b47684f3d4d4e9a892845de106a41c9jpg_ecsize_1280_333_72507","size":72507,"type":"image/jpeg","file":"","ext":"jpg","location":"741aaa/2a6bc050-3b2a-11e8-be48-d7e8d2c2ef59_1523191292117.jpg","s3_url":"prod-dakbro/741aaa/2a6bc050-3b2a-11e8-be48-d7e8d2c2ef59_1523191292117.jpg","dimension":{"width":1280,"height":333,"size":72507}}]', '1', '1', '2018-04-08 18:11:39', '2018-04-08 18:11:39'),
('2a7a230b-1514-4300-802f-90039c987dbd5ab76c70af2c7', 'a8813f5c-7244-452c-9e66-1d3f3c6409715ab76c5f6ea3f', 'image', '', 'Gallery', '', '[{"source":"upload","name":"4b47684f3d4d4e9a892845de106a41c9jpg_ecsize_1280_333_72507","size":72507,"type":"image/jpeg","file":"","ext":"jpg","location":"713beb/8b229520-304b-11e8-98a0-9b2fe4cec0aa_1521996164978.jpg","s3_url":"prod-dakbro/713beb/8b229520-304b-11e8-98a0-9b2fe4cec0aa_1521996164978.jpg","dimension":{"width":1280,"height":333,"size":72507}}]', '1', '1', '2018-03-25 16:42:48', '2018-03-25 13:12:48'),
('3fec0650-abb9-4e7f-99f1-89176c8fa2745ab613a1da0b0', 'c9a2d684-906e-461e-8e65-d105b17aab855ab612672b6b2', 'image', 'Welcome to DAKbro Incredibles', 'We Love your Bike the same as you do', '', '[{"source":"upload","name":"1beaa372cae74c04b4832a65d9626c32jpg_ecsize_1280_500_70533","size":70533,"type":"image/jpeg","file":"","ext":"jpg","location":"20964b/b7e26610-3043-11e8-a50c-07e4454cfe41_1521992804081.jpg","s3_url":"prod-dakbro/20964b/b7e26610-3043-11e8-a50c-07e4454cfe41_1521992804081.jpg","dimension":{"width":1280,"height":500,"size":70533}}]', '1', '1', '2018-03-25 15:46:48', '2018-03-25 12:16:48'),
('415df12c-e9bf-4d8c-98a1-1d840a59610b5aca0e65e97b9', '119f6ab1-72d6-4512-bcdb-651ec6896e315aca0e30961cf', 'image', 'Contact us', '', '', '[{"source":"upload","name":"d3383e944a7d4464bf1bddf60cd73fa9jpg_ecsize_1280_333_59495","size":59495,"type":"image/jpeg","file":"","ext":"jpg","location":"a6850/641d30e0-3b2a-11e8-b095-d55736b108af_1523191388909.jpg","s3_url":"prod-dakbro/a6850/641d30e0-3b2a-11e8-b095-d55736b108af_1523191388909.jpg","dimension":{"width":1280,"height":333,"size":59495}}]', '1', '1', '2018-04-08 18:13:17', '2018-04-08 18:13:17'),
('4bf27af7-ed61-411f-a66b-d1dd5d0b2fa35ab7634f711e2', '7877e3b2-4c01-484e-857b-f73b83f5f6b75ab76304ad62e', 'image', 'test', 'Booking', '', '[{"source":"upload","name":"4b47684f3d4d4e9a892845de106a41c9jpg_ecsize_1280_333_72507","size":72507,"type":"image/jpeg","file":"","ext":"jpg","location":"ea97e9/92e11740-3042-11e8-abaf-5b096182d47b_1521992312500.jpg","s3_url":"prod-dakbro/ea97e9/92e11740-3042-11e8-abaf-5b096182d47b_1521992312500.jpg","dimension":{"width":1280,"height":333,"size":72507}}]', '1', '1', '2018-03-25 15:38:36', '2018-03-25 12:08:36'),
('5fb35aaa-692c-4849-8cd3-31c585f005325ab76d6a771f1', '0eeccb1c-14a9-464c-93fd-64e45289a41e5ab76d59e4fea', 'image', '', 'Contact', '', '[{"source":"upload","name":"d3383e944a7d4464bf1bddf60cd73fa9 Customjpg_ecsize_900_234_29428","size":29428,"type":"image/jpeg","file":"","ext":"jpg","location":"ad2412/94476ef0-304b-11e8-bdf8-49d150757a1e_1521996180319.jpg","s3_url":"prod-dakbro/ad2412/94476ef0-304b-11e8-bdf8-49d150757a1e_1521996180319.jpg","dimension":{"width":900,"height":234,"size":29428}}]', '1', '1', '2018-03-25 16:43:02', '2018-03-25 13:13:02'),
('7d921d7c-3cf7-4756-9998-d1b4522340e15aca0c9fc4a59', 'f6aa7702-0071-482a-80fc-df36aff210295aca0c1e3d63c', 'image', 'Welcome to DAKBRO Incredibles', 'We Love your Bike the same as you do', '', '[{"source":"upload","name":"1beaa372cae74c04b4832a65d9626c32jpg_ecsize_1280_500_70533","size":70533,"type":"image/jpeg","file":"","ext":"jpg","location":"4a2dfe/5361b3d0-3b29-11e8-ba7e-796949c4d317_1523190931340.jpg","s3_url":"prod-dakbro/4a2dfe/5361b3d0-3b29-11e8-ba7e-796949c4d317_1523190931340.jpg","dimension":{"width":1280,"height":500,"size":70533}}]', '1', '1', '2018-04-08 18:05:43', '2018-04-08 18:05:43'),
('9b1f5d24-ca30-496b-bf57-deebe6a822b05aca0dc532d18', '9c548ac3-7ee3-4383-a825-cf312ecf46525aca0d332e12a', 'image', 'Quick Services', '', '', '[{"source":"upload","name":"1beaa372cae74c04b4832a65d9626c32jpg_ecsize_1280_500_70533","size":70533,"type":"image/jpeg","file":"","ext":"jpg","location":"7bedd0/04d56800-3b2a-11e8-8a15-c5412a90b0b4_1523191229054.jpg","s3_url":"prod-dakbro/7bedd0/04d56800-3b2a-11e8-8a15-c5412a90b0b4_1523191229054.jpg","dimension":{"width":1280,"height":500,"size":70533}}]', '1', '1', '2018-04-08 18:10:37', '2018-04-08 18:10:37'),
('f54f2613-cfcc-4794-91a7-45d0a15ba7915ab689c293cec', '0d4c68e5-40bd-4df5-9be2-a4f9332eb30c5ab68993a4f91', 'image', 'Services', 'We Love your Bike the same as you do', '', '[{"source":"upload","name":"d3383e944a7d4464bf1bddf60cd73fa9jpg_ecsize_1280_333_59495","size":59495,"type":"image/jpeg","file":"","ext":"jpg","location":"5353bc/a874ecd0-3042-11e8-92da-c5cfd5a1438b_1521992348701.jpg","s3_url":"prod-dakbro/5353bc/a874ecd0-3042-11e8-92da-c5cfd5a1438b_1521992348701.jpg","dimension":{"width":1280,"height":333,"size":59495}}]', '1', '1', '2018-03-25 15:39:13', '2018-03-25 12:09:13');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` varchar(50) NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `country_id` varchar(50) NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
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

CREATE TABLE IF NOT EXISTS `testimonials` (
  `id` varchar(50) NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
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

CREATE TABLE IF NOT EXISTS `users` (
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
  `tz` varchar(50) NOT NULL DEFAULT ' Asia/Kolkata',
  `image` text,
  `status` enum('active','blocked') NOT NULL DEFAULT 'active',
  `parent_id` varchar(50) DEFAULT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `password`, `role`, `city`, `area`, `state`, `language`, `country`, `tz`, `image`, `status`, `parent_id`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('1', 'Admin', 'd.dayanidhi20@gmail.com', '9884069404', '5a1760628ea739e61d9bb798b50542d5', 'admin', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'bdb8ea97-b87d-41d0-a51d-aa1e3d8216a85a531e059f15d', '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'eng', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', 'Asia/Kolkata', '[{"source":"upload","name":"wwjpg_ecsize_170_170_7984","size":7984,"type":"image/jpeg","file":"","ext":"jpg","location":"28dd46/a0cf1920-195d-11e8-8225-27f82b3008d6_1519475055538.jpg","s3_url":"prod-dakbro/28dd46/a0cf1920-195d-11e8-8225-27f82b3008d6_1519475055538.jpg","dimension":{"width":170,"height":170,"size":7984}}]', 'active', NULL, '1', '1', '2018-03-30 07:25:49', '2018-04-08 15:57:20'),
('5349a9f7-5e7f-43c8-bb15-d0bf15ccbf3a5aca0a5f2f8db', 'Dayanidhi', 'incrediblepolishing@gmail.com', '9176599630', '2ee8211779169c7079d1a15e77c877b3', 'shop_owner', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'b3136e61-5513-4db6-b94a-e00bb58efef75ab6291409e27', '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'eng', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', 'Asia/Kolkata', '', 'active', NULL, '1', '1', '2018-04-08 17:56:07', '2018-04-08 14:19:10'),
('58837084-3943-4aad-a57f-5c0ec5e896675aca478a08d9a', 'ARUN NURA', 'arunnura23@gmail.com', '9176665532', 'b1f966d3d5d8655b7b7378812c51037f', 'shop_owner', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'b3136e61-5513-4db6-b94a-e00bb58efef75ab6291409e27', '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'eng', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', 'Asia/Kolkata', '', 'active', NULL, '1', '1', '2018-04-08 22:17:06', '2018-04-08 22:17:06'),
('b4d1aeb8-1539-40e8-a005-fe5a031a5ab65acb39a9a3616', '', '', '7904949930', '', 'customer', NULL, NULL, NULL, 'eng', NULL, ' Asia/Kolkata', NULL, 'active', NULL, '', '', NULL, '2018-04-09 10:00:09'),
('fec4b885-4525-4b2e-8437-599bc21ec2a65aca0aab7b135', 'Kalanidhi', 'kalanidhi.d@gmail.com', '9176084047', '', 'shop_owner', 'ab7546f2-eb49-4ade-83ba-1853ecfdc8505a53102eacf0c', 'b3136e61-5513-4db6-b94a-e00bb58efef75ab6291409e27', '558dfd33-8acc-4646-803f-a769073120ae5a530e4e8583e', 'eng', '6dff1e8e-ee7c-4415-a6f5-a2c8ce985e005a5223b7bc219', 'Asia/Kolkata', '', 'active', NULL, '1', '1', '2018-04-08 17:57:23', '2018-04-08 17:57:23');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` varchar(50) NOT NULL,
  `order_no` int(11) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `type` enum('car','bike') NOT NULL DEFAULT 'bike',
  `image` text NOT NULL,
  `hover_image` text NOT NULL,
  `created_id` varchar(50) NOT NULL,
  `updated_id` varchar(50) NOT NULL,
  `created_time` timestamp NULL DEFAULT NULL,
  `updated_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`id`, `order_no`, `name`, `description`, `type`, `image`, `hover_image`, `created_id`, `updated_id`, `created_time`, `updated_time`) VALUES
('288a3e14-80a4-4593-8f1a-8ca8ae03e58c5aca12a748801', 2, 'upto 220cc', 'upto 220cc', 'bike', '[{"source":"upload","name":"bike4 Custompng_ecsize_80_49_3153","size":3153,"type":"image/png","file":"","ext":"png","location":"38641b/ebf26010-3b2c-11e8-b8be-732724666eed_1523192475792.png","s3_url":"prod-dakbro/38641b/ebf26010-3b2c-11e8-b8be-732724666eed_1523192475792.png","dimension":{"width":80,"height":49,"size":3153}}]', '[{"source":"upload","name":"bike4_whitepng_ecsize_80_49_1706","size":1706,"type":"image/png","file":"","ext":"png","location":"ba9b1e/ef8a2cd0-3b2c-11e8-b8be-732724666eed_1523192481821.png","s3_url":"prod-dakbro/ba9b1e/ef8a2cd0-3b2c-11e8-b8be-732724666eed_1523192481821.png","dimension":{"width":80,"height":49,"size":1706}}]', '1', '1', '2018-04-08 18:31:27', '2018-04-08 21:27:49'),
('9814bb4e-ce38-45e0-a500-f417329501bd5aca13775f1f0', 5, 'Above 800cc', 'Above 800cc', 'bike', '[{"source":"upload","name":"bike3 Custompng_ecsize_80_49_2516","size":2516,"type":"image/png","file":"","ext":"png","location":"197bb6/631ecc50-3b2d-11e8-925e-1118b86dd8f6_1523192675733.png","s3_url":"prod-dakbro/197bb6/631ecc50-3b2d-11e8-925e-1118b86dd8f6_1523192675733.png","dimension":{"width":80,"height":49,"size":2516}}]', '[{"source":"upload","name":"bike3_whitepng_ecsize_80_49_1383","size":1383,"type":"image/png","file":"","ext":"png","location":"d1b884/67d37ac0-3b2d-11e8-925e-1118b86dd8f6_1523192683628.png","s3_url":"prod-dakbro/d1b884/67d37ac0-3b2d-11e8-925e-1118b86dd8f6_1523192683628.png","dimension":{"width":80,"height":49,"size":1383}}]', '1', '1', '2018-04-08 18:34:55', '2018-04-08 21:28:10'),
('b2a42699-4f56-43b8-93b1-4a832d2406ab5aca133812cc4', 3, '250cc - 500cc', '250cc - 500cc', 'bike', '[{"source":"upload","name":"bike1 Custompng_ecsize_80_49_3000","size":3000,"type":"image/png","file":"","ext":"png","location":"8bec63/4285eb40-3b2d-11e8-8eea-e5d0b1263e44_1523192621044.png","s3_url":"prod-dakbro/8bec63/4285eb40-3b2d-11e8-8eea-e5d0b1263e44_1523192621044.png","dimension":{"width":80,"height":49,"size":3000}}]', '[{"source":"upload","name":"bike1_whitepng_ecsize_80_49_1611","size":1611,"type":"image/png","file":"","ext":"png","location":"e73ed0/462e80e0-3b2d-11e8-8eea-e5d0b1263e44_1523192627179.png","s3_url":"prod-dakbro/e73ed0/462e80e0-3b2d-11e8-8eea-e5d0b1263e44_1523192627179.png","dimension":{"width":80,"height":49,"size":1611}}]', '1', '1', '2018-04-08 18:33:52', '2018-04-08 21:27:56'),
('de6b40be-f865-4e36-bb3e-9204668ff1e35aca1174b027a', 1, 'Scooters', 'Activa, Vespa', 'bike', '[{"source":"upload","name":"bike5 Custompng_ecsize_80_49_2228","size":2228,"type":"image/png","file":"","ext":"png","location":"bda8d4/29b381f0-3b2c-11e8-afe1-376fc63ceb0a_1523192149903.png","s3_url":"prod-dakbro/bda8d4/29b381f0-3b2c-11e8-afe1-376fc63ceb0a_1523192149903.png","dimension":{"width":80,"height":49,"size":2228}}]', '[{"source":"upload","name":"bike5_whitepng_ecsize_80_49_1194","size":1194,"type":"image/png","file":"","ext":"png","location":"1162c2/c45ae090-3b2c-11e8-b0a9-1140319ed5df_1523192409368.png","s3_url":"prod-dakbro/1162c2/c45ae090-3b2c-11e8-b0a9-1140319ed5df_1523192409368.png","dimension":{"width":80,"height":49,"size":1194}}]', '1', '1', '2018-04-08 18:26:20', '2018-04-08 21:27:41'),
('debfb6cf-3890-42a9-b016-074fc0ed58a35aca135013f8d', 4, '500cc - 800cc', '500cc - 800cc', 'bike', '[{"source":"upload","name":"bike2 Custompng_ecsize_80_49_2676","size":2676,"type":"image/png","file":"","ext":"png","location":"d04f94/5197cc70-3b2d-11e8-ae57-5b778fa819c8_1523192646326.png","s3_url":"prod-dakbro/d04f94/5197cc70-3b2d-11e8-ae57-5b778fa819c8_1523192646326.png","dimension":{"width":80,"height":49,"size":2676}}]', '[{"source":"upload","name":"bike2_whitepng_ecsize_80_49_1439","size":1439,"type":"image/png","file":"","ext":"png","location":"bda995/549be4b0-3b2d-11e8-ae57-5b778fa819c8_1523192651387.png","s3_url":"prod-dakbro/bda995/549be4b0-3b2d-11e8-ae57-5b778fa819c8_1523192651387.png","dimension":{"width":80,"height":49,"size":1439}}]', '1', '1', '2018-04-08 18:34:16', '2018-04-08 21:28:03');

-- --------------------------------------------------------

--
-- Structure for view `best_price_services`
--
DROP TABLE IF EXISTS `best_price_services`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `best_price_services` AS select `shop_services`.`service_id` AS `service_id`,`shop_services`.`vehicle_id` AS `vehicle_id`,`s`.`service_time` AS `service_time`,`shop_services`.`shop_id` AS `shop_id`,`shop_services`.`price` AS `price`,`shop_services`.`discount` AS `discount`,`s`.`name` AS `name`,`s`.`description` AS `description`,`s`.`image` AS `image`,`s`.`service_details` AS `service_details` from (`shop_services` left join `services` `s` on(((`s`.`id` = `shop_services`.`service_id`) and isnull(`s`.`parent_id`)))) order by `shop_services`.`price`;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
