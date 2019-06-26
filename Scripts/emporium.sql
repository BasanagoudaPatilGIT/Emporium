-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 26, 2019 at 01:18 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `emporium`
--
CREATE DATABASE IF NOT EXISTS `emporium` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `emporium`;

-- --------------------------------------------------------

--
-- Table structure for table `tab_apartment`
--

CREATE TABLE IF NOT EXISTS `tab_apartment` (
  `id` int(10) NOT NULL,
  `apartment_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `apid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_apartment`
--

INSERT INTO `tab_apartment` (`id`, `apartment_name`, `ent_code`) VALUES
(0, '-Select-', '1'),
(1, 'Other', '1'),
(2, 'Bala Apartments', '10002');

-- --------------------------------------------------------

--
-- Table structure for table `tab_app_version`
--

CREATE TABLE IF NOT EXISTS `tab_app_version` (
  `id` int(10) NOT NULL,
  `app_version` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_app_version`
--

INSERT INTO `tab_app_version` (`id`, `app_version`, `created_datetime`) VALUES
(1, 'v1.0.0', '2019-06-24 12:21:02'),
(2, 'v1.0.1', '2019-06-24 12:21:02');

-- --------------------------------------------------------

--
-- Table structure for table `tab_bill_d`
--

CREATE TABLE IF NOT EXISTS `tab_bill_d` (
  `id` int(10) NOT NULL,
  `bill_h_id` int(10) NOT NULL,
  `product_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_batch` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_uom_index` int(10) NOT NULL,
  `order_qty` int(10) NOT NULL,
  `bill_qty` int(10) NOT NULL,
  `tax_amount` double(65,4) NOT NULL,
  `tax_percent` double(65,4) NOT NULL,
  `sale_rate` double(65,4) NOT NULL,
  `product_status_index` int(10) NOT NULL,
  `sub_total` double(65,4) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `bhid` (`bill_h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_bill_h`
--

CREATE TABLE IF NOT EXISTS `tab_bill_h` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `bill_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `bill_total_amount` double(65,4) NOT NULL,
  `bill_tax_amount` double(65,4) NOT NULL,
  `delivery_charges` double(65,4) NOT NULL,
  `bill_net_amount` double(65,4) NOT NULL,
  `bill_created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_id` int(10) NOT NULL,
  `bill_status_index` int(10) NOT NULL,
  `payment_status` int(10) NOT NULL,
  `payment_mode` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tbhid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_category`
--

CREATE TABLE IF NOT EXISTS `tab_category` (
  `id` int(10) NOT NULL,
  `category_index` int(10) NOT NULL,
  `category_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `is_valid` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ciid` (`category_index`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_category`
--

INSERT INTO `tab_category` (`id`, `category_index`, `category_name`, `is_valid`, `ent_code`) VALUES
(0, 0, '-Select-', 1, '1'),
(1, 11001, 'Vegetables', 1, '10002'),
(2, 11002, 'Grocery', 1, '10002');

-- --------------------------------------------------------

--
-- Table structure for table `tab_entity`
--

CREATE TABLE IF NOT EXISTS `tab_entity` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ent_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `emp_limit` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `service_expiry_date` date NOT NULL,
  `app_current_version` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `teid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_entity`
--

INSERT INTO `tab_entity` (`id`, `ent_code`, `ent_name`, `emp_limit`, `created_datetime`, `service_expiry_date`, `app_current_version`) VALUES
(0, '0', '-Select-', 0, '2019-04-08 23:04:40', '2020-12-31', 'v1.0.0'),
(1, '10002', 'SS Stores', 2, '2019-04-08 23:04:40', '2020-12-31', 'v1.0.0');

-- --------------------------------------------------------

--
-- Table structure for table `tab_flat_no`
--

CREATE TABLE IF NOT EXISTS `tab_flat_no` (
  `id` int(10) NOT NULL,
  `flat_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `wing_id` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `wiid` (`wing_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_flat_no`
--

INSERT INTO `tab_flat_no` (`id`, `flat_no`, `wing_id`, `ent_code`) VALUES
(0, '-Select-', 0, '1'),
(1, 'Other', 1, '1'),
(2, '101', 2, '10002'),
(3, '102', 2, '10002');

-- --------------------------------------------------------

--
-- Table structure for table `tab_index`
--

CREATE TABLE IF NOT EXISTS `tab_index` (
  `id` int(10) NOT NULL,
  `index_id` int(10) NOT NULL,
  `index_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `index_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_valid` int(10) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `iiid` (`index_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_index`
--

INSERT INTO `tab_index` (`id`, `index_id`, `index_type`, `index_name`, `is_valid`) VALUES
(0, 0, 'select_index', '-Select-', 1),
(1, 10001, 'order_status_index', 'Order', 1),
(2, 10002, 'order_status_index', 'Approved', 2),
(3, 10003, 'order_status_index', 'Billed', 1),
(4, 10004, 'order_status_index', 'Billed-Pending', 2),
(5, 10005, 'order_status_index', 'Cancelled', 1),
(6, 10006, 'product_status_index', 'Billed', 1),
(7, 10007, 'product_status_index', 'Free item', 1),
(8, 10008, 'product_uom_index', 'Grams', 1),
(9, 10009, 'product_uom_index', 'Kg', 1),
(10, 10010, 'product_uom_index', 'Bundle', 1),
(11, 10011, 'product_uom_index', 'Packet', 1),
(12, 10012, 'product_uom_index', 'Pcs', 1),
(13, 10013, 'user_status_index', 'Active', 1),
(14, 10014, 'user_status_index', 'Inactive', 1),
(15, 10015, 'user_designation_index', 'Admin', 1),
(16, 10016, 'user_designation_index', 'Owner', 1),
(17, 10017, 'user_designation_index', 'Employee', 1),
(18, 10018, 'user_designation_index', 'Customer', 1),
(19, 10019, 'user_gender_index', 'Male', 1),
(20, 10020, 'user_gender_index', 'Female', 1),
(21, 10021, 'user_gender_index', 'Other', 1),
(22, 10022, 'invoice_status_index', 'Billed', 1),
(23, 10023, 'invoice_status_index', 'Cancelled', 1),
(24, 10024, 'product_uom_index', 'Box', 1),
(25, 10025, 'order_status_index', 'All', 1),
(26, 10026, 'stock_movement_index', 'Offline To Online', 1),
(27, 10027, 'stock_movement_index', 'Online To Offline', 1),
(28, 10028, 'invoice_status_index', 'Paid', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_notification`
--

CREATE TABLE IF NOT EXISTS `tab_notification` (
  `id` int(10) NOT NULL,
  `notification_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `display_message` text COLLATE utf8_unicode_ci NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) NOT NULL,
  `recieved_by` int(10) NOT NULL,
  `read_status` int(10) NOT NULL,
  `transaction_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_notification`
--

INSERT INTO `tab_notification` (`id`, `notification_type`, `display_message`, `created_datetime`, `ent_code`, `created_by`, `recieved_by`, `read_status`, `transaction_number`) VALUES
(2, 'Order', 'One Order Requested by Customer with order number #O100022001', '2019-06-24 17:30:25', '10002', 6, 2, 0, '#O100022001');

-- --------------------------------------------------------

--
-- Table structure for table `tab_order_d`
--

CREATE TABLE IF NOT EXISTS `tab_order_d` (
  `id` int(10) NOT NULL,
  `order_h_id` int(10) NOT NULL,
  `product_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_batch` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_uom_index` int(10) NOT NULL,
  `order_qty` int(10) NOT NULL,
  `tax_percent` double(65,2) NOT NULL,
  `tax_amount` double(65,2) NOT NULL,
  `sale_rate` double(65,2) NOT NULL,
  `sub_total` double(65,4) NOT NULL,
  `product_stock_status_index` int(10) NOT NULL,
  `row_invalidated` int(10) NOT NULL,
  `status_updated_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ohid` (`order_h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_order_d`
--

INSERT INTO `tab_order_d` (`id`, `order_h_id`, `product_code`, `product_name`, `product_batch`, `product_uom_index`, `order_qty`, `tax_percent`, `tax_amount`, `sale_rate`, `sub_total`, `product_stock_status_index`, `row_invalidated`, `status_updated_datetime`) VALUES
(1, 1, '#P10002-104', 'Brinjal', '#P10002-1042019-06-030.020.022', 10009, 1, 2.00, 0.44, 0.02, 22.4400, 10007, 0, '2019-06-15 17:49:36'),
(2, 1, '#P10002-105', 'broccoli', '#P10002-1052019-06-03200000.0200', 10008, 500, 2.00, 0.20, 0.02, 10.2000, 10007, 0, '2019-06-15 17:49:36'),
(3, 1, '#P10002-106', 'Puha', '#P10002-1062019-06-032510.0000', 10010, 1, 3.00, 0.30, 10.00, 10.3000, 10007, 0, '2019-06-15 17:49:36');

-- --------------------------------------------------------

--
-- Table structure for table `tab_order_h`
--

CREATE TABLE IF NOT EXISTS `tab_order_h` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `order_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `order_total_amount` double(65,4) NOT NULL,
  `order_tax_amount` double(65,4) NOT NULL,
  `order_net_amount` double(65,4) NOT NULL,
  `order_status_index` int(10) NOT NULL,
  `order_view_status` int(10) NOT NULL,
  `order_created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `tohid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_order_h`
--

INSERT INTO `tab_order_h` (`id`, `ent_code`, `user_id`, `order_number`, `order_total_amount`, `order_tax_amount`, `order_net_amount`, `order_status_index`, `order_view_status`, `order_created_datetime`) VALUES
(1, '10002', 8, '#O100022001', 42.0000, 2.3400, 44.0000, 10001, 10001, '2019-06-15 17:49:36');

-- --------------------------------------------------------

--
-- Table structure for table `tab_product`
--

CREATE TABLE IF NOT EXISTS `tab_product` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8_unicode_ci NOT NULL,
  `product_status_index` int(10) NOT NULL,
  `category_index` int(10) NOT NULL,
  `sub_category_index` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stock_qty_limit` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tpid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_product`
--

INSERT INTO `tab_product` (`id`, `ent_code`, `product_code`, `product_name`, `product_description`, `product_status_index`, `category_index`, `sub_category_index`, `created_datetime`, `stock_qty_limit`) VALUES
(1, '10002', '#P10002-104', 'Brinjal', 'Brinjal is a very beautiful vegetable.\nit dark purple in colour.In northern sides people eat baingan ka bharta which is very tasty.brinjal is mostly grown in India and sri Lanka.brinjal is very good for health.\nbrinjal is very tasty.', 10013, 11001, 20001, '2019-05-03 16:35:31', 10000),
(2, '10002', '#P10002-105', 'broccoli', 'Broccoli is popular and widely eaten. It has a distinctive ‘mustardy’ taste and well known health benefits. The stalks, buds and most of the leaves of broccoli are edible.', 10013, 11001, 20001, '2019-05-03 16:35:31', 10000),
(3, '10002', '#P10002-106', 'Puha', 'Traditionally it was one of the staple green vegetables of the Maori and is still eaten today. Puha can be found growing wild. The smooth leaved puha is the most popular, however, the slightly bitter and prickly leaved puha is also eaten.', 10013, 11001, 20002, '2019-05-03 16:35:31', 15),
(4, '10002', '#P10002-109', 'Testing', '', 10013, 11001, 20001, '2019-06-08 19:39:50', 10000),
(5, '10002', '#P10002-110', 'TestG', '', 10013, 11002, 20003, '2019-06-08 20:09:23', 5000);

-- --------------------------------------------------------

--
-- Table structure for table `tab_series`
--

CREATE TABLE IF NOT EXISTS `tab_series` (
  `id` int(100) NOT NULL,
  `series_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `series_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `continues_count` int(10) NOT NULL,
  `last_updated` datetime NOT NULL,
  `ent_code` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tsid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_series`
--

INSERT INTO `tab_series` (`id`, `series_name`, `series_id`, `continues_count`, `last_updated`, `ent_code`) VALUES
(1, 'Entity', 'Ent', 10003, '2019-04-12 00:00:00', 0),
(2, 'Product Code', '#P', 111, '2019-06-08 00:00:00', 10002),
(3, 'Employee Code', '#E', 1001, '2019-04-12 00:00:00', 10002),
(4, 'User Id', '#U', 111005, '2019-05-05 00:00:00', 10002),
(5, 'Orders', '#O', 2002, '2019-06-15 12:19:36', 10002),
(6, 'Invoice', '#In', 130001, '2019-06-15 11:24:44', 10002),
(7, 'Stock Movement', '#SM', 7, '2019-06-22 00:00:00', 10002);

-- --------------------------------------------------------

--
-- Table structure for table `tab_stock_d`
--

CREATE TABLE IF NOT EXISTS `tab_stock_d` (
  `id` int(10) NOT NULL,
  `stock_h_id` int(10) NOT NULL,
  `stock_qty` int(10) NOT NULL,
  `online_stock_qty` int(10) NOT NULL,
  `offline_stock_qty` int(10) NOT NULL,
  `transit_qty` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(10) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `shid` (`stock_h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_stock_d`
--

INSERT INTO `tab_stock_d` (`id`, `stock_h_id`, `stock_qty`, `online_stock_qty`, `offline_stock_qty`, `transit_qty`, `created_datetime`, `product_id`) VALUES
(1, 1, 900, 300, 600, 1000, '2019-05-03 16:35:31', 1),
(2, 2, 18500, 16500, 2000, 500, '2019-05-03 16:35:31', 2),
(3, 3, 10, 1, 9, 1, '2019-05-03 16:35:31', 3),
(4, 4, 20000, 5000, 15000, 0, '2019-06-08 16:41:09', 4),
(5, 5, 11000, 5000, 6000, 0, '2019-06-08 19:39:50', 5),
(6, 5, 10000, 5000, 5000, 0, '2019-06-08 20:09:23', 5);

-- --------------------------------------------------------

--
-- Table structure for table `tab_stock_h`
--

CREATE TABLE IF NOT EXISTS `tab_stock_h` (
  `id` int(10) NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_batch` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `packets_in_box` int(11) NOT NULL,
  `product_pack_date` date NOT NULL,
  `product_exp_date` date NOT NULL,
  `mrp` double(65,4) NOT NULL,
  `tax_percent` double(65,2) NOT NULL,
  `purchase_rate` double(65,4) NOT NULL,
  `sale_rate` double(65,4) NOT NULL,
  `purchase_qty` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `pid` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_stock_h`
--

INSERT INTO `tab_stock_h` (`id`, `product_id`, `product_batch`, `packets_in_box`, `product_pack_date`, `product_exp_date`, `mrp`, `tax_percent`, `purchase_rate`, `sale_rate`, `purchase_qty`, `created_datetime`) VALUES
(1, 1, '#P10002-1042019-06-030.020.022', 0, '2019-05-03', '2019-06-03', 0.0220, 2.00, 0.0200, 0.0220, 27000, '2019-05-03 16:35:31'),
(2, 2, '#P10002-1052019-06-03200000.0200', 0, '2019-05-03', '2019-06-03', 0.0200, 2.00, 0.0180, 0.0200, 20000, '2019-05-03 16:35:31'),
(3, 3, '#P10002-1062019-06-032510.0000', 0, '2019-05-03', '2019-06-03', 10.0000, 3.00, 8.0000, 10.0000, 25, '2019-05-03 16:35:31'),
(4, 4, '#P10002-1092019-09-060.0110.011', 0, '2019-08-22', '2019-09-06', 0.0110, 2.00, 0.0110, 0.0110, 11000, '2019-06-08 19:39:50'),
(5, 5, '#P10002-1102020-01-210.0110.011', 0, '2019-10-21', '2020-01-21', 0.0110, 2.00, 0.0110, 0.0110, 10000, '2019-06-08 20:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `tab_stock_movement`
--

CREATE TABLE IF NOT EXISTS `tab_stock_movement` (
  `id` int(10) NOT NULL,
  `transaction_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_batch` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `online_qty_before_movement` int(10) NOT NULL,
  `offline_qty_before_movement` int(10) NOT NULL,
  `movement_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `movement_qty` int(10) NOT NULL,
  `modified_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `uom_type` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_stock_movement`
--

INSERT INTO `tab_stock_movement` (`id`, `transaction_no`, `ent_code`, `product_code`, `product_name`, `product_batch`, `online_qty_before_movement`, `offline_qty_before_movement`, `movement_type`, `movement_qty`, `modified_datetime`, `uom_type`) VALUES
(1, '#SM100021', '10002', '#P10002-104', 'Brinjal', '#P10002-1042019-06-030.020.022', 21000, 6000, 'Online To Offline', 1000000, '2019-06-22 18:57:16', 10009),
(2, '#SM100022', '10002', '#P10002-104', 'Brinjal', '#P10002-1042019-06-030.020.022', 20000, 7000, 'Online To Offline', 1000000, '2019-06-22 18:59:13', 10009),
(3, '#SM100023', '10002', '#P10002-104', 'Brinjal', '#P10002-1042019-06-030.020.022', 19000, 8000, 'Offline To Online', 1000000, '2019-06-22 19:01:39', 10009),
(4, '#SM100024', '10002', '#P10002-104', 'Brinjal', '#P10002-1042019-06-030.020.022', 19000, 8000, 'Offline To Online', 0, '2019-06-22 19:02:14', 10009),
(5, '#SM100025', '10002', '#P10002-104', 'Brinjal', '#P10002-1042019-06-030.020.022', 19000, 8000, 'Offline To Online', 1000000, '2019-06-22 19:03:44', 10009),
(6, '#SM100026', '10002', '#P10002-104', 'Brinjal', '#P10002-1042019-06-030.020.022', 20000, 7000, 'Offline To Online', 1000000, '2019-06-22 19:05:18', 10009);

-- --------------------------------------------------------

--
-- Table structure for table `tab_sub_category`
--

CREATE TABLE IF NOT EXISTS `tab_sub_category` (
  `id` int(10) NOT NULL,
  `sub_category_index` int(10) NOT NULL,
  `sub_category_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `is_valid` int(10) NOT NULL,
  `category_index_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cid` (`category_index_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_sub_category`
--

INSERT INTO `tab_sub_category` (`id`, `sub_category_index`, `sub_category_name`, `is_valid`, `category_index_id`) VALUES
(0, 0, '-Select-', 1, 0),
(1, 20001, 'sub category 1', 1, 11001),
(2, 20002, 'sub category 2', 1, 11001),
(3, 20003, 'sub category 3', 1, 11002),
(4, 20004, 'sub category 4', 1, 11002);

-- --------------------------------------------------------

--
-- Table structure for table `tab_temp_product`
--

CREATE TABLE IF NOT EXISTS `tab_temp_product` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8_unicode_ci NOT NULL,
  `product_status_index` int(10) NOT NULL,
  `category_index` int(10) NOT NULL,
  `sub_category_index` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stock_qty_limit` int(10) DEFAULT NULL,
  `upload_status` text COLLATE utf8_unicode_ci NOT NULL,
  `upload_status_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ttpid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_temp_stock_d`
--

CREATE TABLE IF NOT EXISTS `tab_temp_stock_d` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `stock_h_id` int(10) NOT NULL,
  `stock_qty` int(10) NOT NULL,
  `online_stock_qty` int(10) NOT NULL,
  `offline_stock_qty` int(10) NOT NULL,
  `transit_qty` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(10) DEFAULT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `shid` (`stock_h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_temp_stock_h`
--

CREATE TABLE IF NOT EXISTS `tab_temp_stock_h` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `product_id` int(10) NOT NULL,
  `product_batch` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `packets_in_box` int(11) NOT NULL,
  `product_pack_date` date NOT NULL,
  `product_exp_date` date NOT NULL,
  `mrp` double(65,4) NOT NULL,
  `tax_precent` double(65,4) NOT NULL,
  `purchase_rate` double(65,4) NOT NULL,
  `sale_rate` double(65,4) NOT NULL,
  `purchase_qty` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `prid` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_union`
--

CREATE TABLE IF NOT EXISTS `tab_union` (
  `id` int(10) NOT NULL,
  `union_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_union`
--

INSERT INTO `tab_union` (`id`, `union_name`, `ent_code`) VALUES
(0, 'Select', '1');

-- --------------------------------------------------------

--
-- Table structure for table `tab_uom_mapping`
--

CREATE TABLE IF NOT EXISTS `tab_uom_mapping` (
  `id` int(10) NOT NULL,
  `index_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `sub_category_id` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `tumid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_uom_mapping`
--

INSERT INTO `tab_uom_mapping` (`id`, `index_id`, `category_id`, `sub_category_id`, `ent_code`) VALUES
(0, 10028, 0, 0, '1'),
(1, 10008, 11001, 20001, '10002'),
(2, 10009, 11001, 20001, '10002'),
(3, 10010, 11001, 20002, '10002'),
(4, 10008, 11002, 20003, '10002'),
(5, 10009, 11002, 20003, '10002'),
(6, 10011, 11002, 20004, '10002'),
(7, 10012, 11002, 20004, '10002'),
(8, 10024, 11002, 20004, '10002');

-- --------------------------------------------------------

--
-- Table structure for table `tab_user`
--

CREATE TABLE IF NOT EXISTS `tab_user` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `user_full_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `user_password` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_gender_index` int(10) NOT NULL,
  `user_age` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `user_dob` date NOT NULL,
  `user_phone_no` bigint(12) NOT NULL,
  `user_email_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_address` text COLLATE utf8_unicode_ci NOT NULL,
  `user_address_prof` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_imei` bigint(15) NOT NULL,
  `user_designation_index` int(10) NOT NULL,
  `user_status_index` int(10) NOT NULL,
  `user_image` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_login_status` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_emp_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `user_flat_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `tuid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_user`
--

INSERT INTO `tab_user` (`id`, `ent_code`, `user_full_name`, `user_name`, `user_password`, `user_gender_index`, `user_age`, `user_dob`, `user_phone_no`, `user_email_id`, `user_address`, `user_address_prof`, `user_imei`, `user_designation_index`, `user_status_index`, `user_image`, `user_login_status`, `created_datetime`, `user_emp_id`, `user_id`, `user_flat_id`) VALUES
(1, '10001', 'Basanagouda Patil', 'basupatil', 'cmFnaHVyYW0=', 10019, '28', '1990-04-06', 7259999282, 'basupail71@gmail.com', 'No Address', 'proof', 0, 10015, 10013, 'Capture.jpg', 0, '2019-04-09 10:13:14', '', '', 0),
(2, '10002', 'Raghu Ram .R', 'raghuram', 'cmFnaHVyYW0=', 10019, '28', '1990-04-06', 9611429415, 'user@gmail.com', 'Rohan Vasantha Apartment, Maratha Halli', 'proof', 0, 10016, 10013, 'Capture.jpg', 0, '2019-04-09 10:13:14', '', '', 0),
(3, '10002', 'BalaKumar', 'balakumar', 'YmFsYWt1bWFy', 10019, '28', '1990-04-06', 9611429417, 'user@gmail.com', 'Rohan Vasantha Apartment, Maratha Halli', 'proof', 358240051111110, 10017, 10013, 'Capture.jpg', 0, '2019-04-09 10:13:14', '', '', 0),
(4, '10002', 'Ganesh', 'ganesh', 'Z2FuZXNo', 10019, '30', '1988-04-06', 8611429418, 'ganesh@gmail.com', 'Rohan Vasantha Apartment, Maratha Halli', 'proof', 123456789009877, 10017, 10013, 'Capture.jpg', 1, '2019-04-09 10:13:14', '', '', 0),
(5, '10002', 'Vijay', 'vijay', 'dmlqYXk=', 10019, '28', '1990-04-01', 9087654321, 'vijay@gmail.com', 'Address', 'Address proof', 645678765677879, 10017, 10013, 'Capture.jpg', 0, '2019-04-12 12:32:32', '', '', 0),
(6, '10002', 'Ramesh R', 'Ramesh', 'UmFtZXNo', 10019, '28', '1990-04-01', 9087654329, 'ramesh@gmail.com', 'Address', 'Address proof', 0, 10018, 10013, 'Capture.jpg', 1, '2019-04-12 12:32:32', '0', '111001', 2),
(7, '10002', 'Akash M', 'Akash', 'QWthc2g=', 10019, '28', '1990-04-01', 9087654322, 'akash@gmail.com', 'Address', 'Address proof', 0, 10018, 10013, 'Capture.jpg', 0, '2019-04-12 12:32:32', '0', '111002', 1),
(8, '10002', 'John Snow', '9685743210', 'Sm9oblNub3c=', 10019, '', '1958-05-05', 9685743210, 'john.snow@gmail.com', '', '', 0, 10018, 10013, 'Capture.jpg', 1, '2019-05-05 16:31:00', '', '#U10002111003', 2);

-- --------------------------------------------------------

--
-- Table structure for table `tab_wing`
--

CREATE TABLE IF NOT EXISTS `tab_wing` (
  `id` int(10) NOT NULL,
  `wing` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `apartment_id` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `aid` (`apartment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_wing`
--

INSERT INTO `tab_wing` (`id`, `wing`, `apartment_id`, `ent_code`) VALUES
(0, '-Select-', 0, '1'),
(1, 'Other', 1, '1'),
(2, 'A', 2, '10002'),
(3, 'B', 2, '10002');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
