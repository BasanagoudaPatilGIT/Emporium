-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: May 25, 2019 at 02:46 PM
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
  `mrp` double(65,4) NOT NULL,
  `tax_percent` double(65,4) NOT NULL,
  `sale_rate` double(65,4) NOT NULL,
  `product_status_index` int(10) NOT NULL,
  UNIQUE KEY `id` (`id`),
  KEY `bhid` (`bill_h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_bill_d`
--

INSERT INTO `tab_bill_d` (`id`, `bill_h_id`, `product_code`, `product_name`, `product_batch`, `product_uom_index`, `order_qty`, `bill_qty`, `mrp`, `tax_percent`, `sale_rate`, `product_status_index`) VALUES
(1, 1, '#P10002-101', 'Tomato', '1234-1234', 10009, 2, 2, 2000.0000, 20.0000, 1600.0000, 0),
(2, 1, '#P10002-101', 'Tomato', '1234-1234', 10009, 2, 2, 2000.0000, 20.0000, 1600.0000, 0);

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

--
-- Dumping data for table `tab_bill_h`
--

INSERT INTO `tab_bill_h` (`id`, `ent_code`, `user_id`, `bill_number`, `bill_total_amount`, `bill_tax_amount`, `delivery_charges`, `bill_net_amount`, `bill_created_datetime`, `order_id`, `bill_status_index`, `payment_status`, `payment_mode`) VALUES
(1, '10002', 6, '#In-10002130001', 1600.0000, 20.0000, 0.0000, 1620.0000, '2019-04-30 10:59:35', 0, 10022, 0, 0);

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
  PRIMARY KEY (`id`),
  KEY `teid` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_entity`
--

INSERT INTO `tab_entity` (`id`, `ent_code`, `ent_name`, `emp_limit`, `created_datetime`, `service_expiry_date`) VALUES
(0, '0', '-Select-', 0, '2019-04-08 23:04:40', '2020-12-31'),
(1, '10002', 'SS Stores', 2, '2019-04-08 23:04:40', '2020-12-31');

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
(0, '-Select-', 1, '1'),
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
(28, 10028, 'select_index', '-Select-', 1);

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
  `tax_amount` double(65,4) NOT NULL,
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
(1, 1, '#P10002-104', 'Brinjal', '#P10002-1042019-06-03150000.0220', 10009, 2, 2.00, 0.8800, 0.02, 45.0000, 10007, 0, '2019-05-25 19:52:23'),
(2, 1, '#P10002-105', 'broccoli', '#P10002-1052019-06-03200000.0200', 10008, 800, 2.00, 0.3200, 0.02, 16.0000, 10007, 0, '2019-05-25 19:52:23'),
(3, 1, '#P10002-106', 'Puha', '#P10002-1062019-06-032510.0000', 10010, 2, 3.00, 0.6000, 10.00, 21.0000, 10007, 0, '2019-05-25 19:52:24'),
(4, 2, '#P10002-104', 'Brinjal', '#P10002-1042019-06-03150000.0220', 10009, 1, 2.00, 0.4400, 0.02, 22.4400, 10007, 0, '2019-05-25 19:57:29'),
(5, 2, '#P10002-105', 'broccoli', '#P10002-1052019-06-03200000.0200', 10009, 2, 2.00, 0.8000, 0.02, 40.8000, 10007, 0, '2019-05-25 19:57:29'),
(6, 2, '#P10002-106', 'Puha', '#P10002-1062019-06-032510.0000', 10010, 1, 3.00, 0.3000, 10.00, 10.3000, 10007, 0, '2019-05-25 19:57:29');

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
(1, '10002', 8, '#O100022001', 80.0000, 4.4800, 84.4800, 10001, 10001, '2019-05-25 19:52:23'),
(2, '10002', 8, '#O100022002', 72.0000, 3.8400, 76.0000, 10001, 10001, '2019-05-25 19:57:29');

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
(3, '10002', '#P10002-106', 'Puha', 'Traditionally it was one of the staple green vegetables of the Maori and is still eaten today. Puha can be found growing wild. The smooth leaved puha is the most popular, however, the slightly bitter and prickly leaved puha is also eaten.', 10013, 11001, 20002, '2019-05-03 16:35:31', 15);

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
(2, 'Product Code', '#P', 107, '2019-05-03 11:05:31', 10002),
(3, 'Employee Code', '#E', 1001, '2019-04-12 00:00:00', 10002),
(4, 'User Id', '#U', 111005, '2019-05-05 00:00:00', 10002),
(5, 'Orders', '#O', 2003, '2019-05-25 14:27:29', 10002),
(6, 'Invoice', '#In', 130001, '2019-04-12 00:00:00', 10002);

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
(1, 1, 12000, 7000, 5000, 3000, '2019-05-03 16:35:31', 1),
(2, 2, 17200, 12200, 5000, 2800, '2019-05-03 16:35:31', 2),
(3, 3, 24, 14, 10, 1, '2019-05-03 16:35:31', 3);

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
  `tax_precent` double(65,2) NOT NULL,
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

INSERT INTO `tab_stock_h` (`id`, `product_id`, `product_batch`, `packets_in_box`, `product_pack_date`, `product_exp_date`, `mrp`, `tax_precent`, `purchase_rate`, `sale_rate`, `purchase_qty`, `created_datetime`) VALUES
(1, 1, '#P10002-1042019-06-03150000.0220', 0, '2019-05-03', '2019-06-03', 0.0220, 2.00, 0.0200, 0.0220, 15000, '2019-05-03 16:35:31'),
(2, 2, '#P10002-1052019-06-03200000.0200', 0, '2019-05-03', '2019-06-03', 0.0200, 2.00, 0.0180, 0.0200, 20000, '2019-05-03 16:35:31'),
(3, 3, '#P10002-1062019-06-032510.0000', 0, '2019-05-03', '2019-06-03', 10.0000, 3.00, 8.0000, 10.0000, 25, '2019-05-03 16:35:31');

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
(0, 0, '-Select-', 1, 1),
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
(2, '10002', 'Raghu Ram .R', 'raghuram', 'cmFnaHVyYW0=', 10019, '28', '1990-04-06', 9611429415, 'user@gmail.com', 'Rohan Vasantha Apartment, Maratha Halli', 'proof', 358240051111110, 10016, 10013, 'Capture.jpg', 1, '2019-04-09 10:13:14', '', '', 0),
(3, '10002', 'BalaKumar', 'balakumar', 'YmFsYWt1bWFy', 10019, '28', '1990-04-06', 9611429417, 'user@gmail.com', 'Rohan Vasantha Apartment, Maratha Halli', 'proof', 123456789009876, 10017, 10013, 'Capture.jpg', 1, '2019-04-09 10:13:14', '', '', 0),
(4, '10002', 'Ganesh', 'ganesh', 'Z2FuZXNo', 10019, '30', '1988-04-06', 8611429418, 'ganesh@gmail.com', 'Rohan Vasantha Apartment, Maratha Halli', 'proof', 123456789009877, 10017, 10013, 'Capture.jpg', 1, '2019-04-09 10:13:14', '', '', 0),
(5, '10002', 'Vijay', 'vijay', 'dmlqYXk=', 10019, '28', '1990-04-01', 9087654321, 'vijay@gmail.com', 'Address', 'Address proof', 645678765677879, 10017, 10013, 'Capture.jpg', 0, '2019-04-12 12:32:32', '', '', 0),
(6, '10002', 'Ramesh R', 'Ramesh', 'dmlqYXk=', 10019, '28', '1990-04-01', 9087654329, 'ramesh@gmail.com', 'Address', 'Address proof', 0, 10018, 10013, 'Capture.jpg', 0, '2019-04-12 12:32:32', '0', '111001', 2),
(7, '10002', 'Akash M', 'Akash', 'dmlqYXk=', 10019, '28', '1990-04-01', 9087654322, 'akash@gmail.com', 'Address', 'Address proof', 0, 10018, 10013, 'Capture.jpg', 0, '2019-04-12 12:32:32', '0', '111002', 1),
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
(0, '-Select-', 1, '1'),
(1, 'Other', 1, '1'),
(2, 'A', 2, '10002'),
(3, 'B', 2, '10002');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
