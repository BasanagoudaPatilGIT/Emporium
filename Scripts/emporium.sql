-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 18, 2019 at 05:37 AM
-- Server version: 5.6.43-cll-lve
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emporium`
--

-- --------------------------------------------------------

--
-- Table structure for table `tab_apartment`
--

CREATE TABLE `tab_apartment` (
  `id` int(10) NOT NULL,
  `apartment_name` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL
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

CREATE TABLE `tab_app_version` (
  `id` int(10) NOT NULL,
  `app_version` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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

CREATE TABLE `tab_bill_d` (
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
  `sub_total` double(65,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_bill_d`
--

INSERT INTO `tab_bill_d` (`id`, `bill_h_id`, `product_code`, `product_name`, `product_batch`, `product_uom_index`, `order_qty`, `bill_qty`, `tax_amount`, `tax_percent`, `sale_rate`, `product_status_index`, `sub_total`) VALUES
(1, 1, '#P10002-2', 'Carrot', '#P10002-22021-07-180.080.082', 10008, 0, 200, 0.3280, 2.0000, 0.0820, 10006, 16.7280),
(2, 1, '#P10002-3', 'Tomato', '#P10002-32020-07-180.0450.05', 10009, 0, 1, 1.5000, 3.0000, 0.0500, 10006, 51.5000),
(3, 1, '#P10002-4', 'Methi', '#P10002-42022-07-181513', 10010, 0, 1, 0.2600, 2.0000, 13.0000, 10006, 13.2600),
(4, 2, '#P10002-1', 'Onion', '#P10002-12020-07-180.0240.023', 10009, 0, 1, 0.4600, 2.0000, 0.0230, 10006, 23.4600),
(5, 3, '#P10002-4', 'Methi', '#P10002-42022-07-181513', 10010, 0, 8, 2.0800, 2.0000, 13.0000, 10006, 106.0800);

-- --------------------------------------------------------

--
-- Table structure for table `tab_bill_h`
--

CREATE TABLE `tab_bill_h` (
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
  `payment_mode` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_bill_h`
--

INSERT INTO `tab_bill_h` (`id`, `ent_code`, `user_id`, `bill_number`, `bill_total_amount`, `bill_tax_amount`, `delivery_charges`, `bill_net_amount`, `bill_created_datetime`, `order_id`, `bill_status_index`, `payment_status`, `payment_mode`) VALUES
(1, '10002', 5, '#In10002130001', 79.4000, 3.9080, 0.0000, 83.0000, '2019-07-18 00:41:26', 0, 10022, 0, 0),
(2, '10002', 5, '#In10002130002', 23.0000, 0.4600, 0.0000, 23.0000, '2019-07-18 04:20:30', 0, 10022, 0, 0),
(3, '10002', 5, '#In10002130003', 104.0000, 2.0800, 0.0000, 106.0000, '2019-07-18 04:32:52', 0, 10022, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tab_category`
--

CREATE TABLE `tab_category` (
  `id` int(10) NOT NULL,
  `category_index` int(10) NOT NULL,
  `category_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `is_valid` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL
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

CREATE TABLE `tab_entity` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ent_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `emp_limit` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `service_expiry_date` date NOT NULL,
  `app_current_version` varchar(50) COLLATE utf8_unicode_ci NOT NULL
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

CREATE TABLE `tab_flat_no` (
  `id` int(10) NOT NULL,
  `flat_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `wing_id` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL
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

CREATE TABLE `tab_index` (
  `id` int(10) NOT NULL,
  `index_id` int(10) NOT NULL,
  `index_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `index_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `is_valid` int(10) NOT NULL
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

CREATE TABLE `tab_notification` (
  `id` int(10) NOT NULL,
  `notification_type` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `display_message` text COLLATE utf8_unicode_ci NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) NOT NULL,
  `recieved_by` int(10) NOT NULL,
  `read_status` int(10) NOT NULL,
  `transaction_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_notification`
--

INSERT INTO `tab_notification` (`id`, `notification_type`, `display_message`, `created_datetime`, `ent_code`, `created_by`, `recieved_by`, `read_status`, `transaction_number`) VALUES
(1, 'Order', 'One Order Requested by Customer with order number: #O100022001', '2019-07-18 00:33:20', '10002', 0, 2, 0, '#O100022001'),
(2, 'Order', 'One Order Requested by Customer with order number: #O100022002', '2019-07-18 00:39:42', '10002', 5, 2, 0, '#O100022002'),
(3, 'Bill', 'Bill generated with Bill number: #In10002130001,click to view details', '2019-07-18 00:41:26', '10002', 2, 5, 0, '#In10002130001'),
(4, 'Bill', 'Bill generated with Bill number: #In10002130002,click to view details', '2019-07-18 04:20:30', '10002', 2, 5, 0, '#In10002130002'),
(5, 'Bill', 'Bill generated with Bill number: #In10002130003,click to view details', '2019-07-18 04:32:52', '10002', 2, 5, 0, '#In10002130003');

-- --------------------------------------------------------

--
-- Table structure for table `tab_order_d`
--

CREATE TABLE `tab_order_d` (
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
  `status_updated_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_order_d`
--

INSERT INTO `tab_order_d` (`id`, `order_h_id`, `product_code`, `product_name`, `product_batch`, `product_uom_index`, `order_qty`, `tax_percent`, `tax_amount`, `sale_rate`, `sub_total`, `product_stock_status_index`, `row_invalidated`, `status_updated_datetime`) VALUES
(1, 1, '#P10002-3', 'Tomato', '#P10002-32020-07-180.0450.05', 10009, 1, 3.00, 1.50, 0.05, 51.5000, 10007, 0, '2019-07-18 00:33:20'),
(2, 1, '#P10002-4', 'Methi', '#P10002-42022-07-181513', 10010, 1, 2.00, 0.26, 13.00, 13.2600, 10007, 0, '2019-07-18 00:33:20'),
(3, 2, '#P10002-1', 'Onion', '#P10002-12020-07-180.0240.023', 10008, 200, 2.00, 0.09, 0.02, 4.6920, 10007, 0, '2019-07-18 00:39:42'),
(4, 2, '#P10002-2', 'Carrot', '#P10002-22021-07-180.080.082', 10008, 100, 2.00, 0.16, 0.08, 8.3640, 10007, 0, '2019-07-18 00:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `tab_order_h`
--

CREATE TABLE `tab_order_h` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(10) NOT NULL,
  `order_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `order_total_amount` double(65,4) NOT NULL,
  `order_tax_amount` double(65,4) NOT NULL,
  `order_net_amount` double(65,4) NOT NULL,
  `order_status_index` int(10) NOT NULL,
  `order_view_status` int(10) NOT NULL,
  `order_created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_order_h`
--

INSERT INTO `tab_order_h` (`id`, `ent_code`, `user_id`, `order_number`, `order_total_amount`, `order_tax_amount`, `order_net_amount`, `order_status_index`, `order_view_status`, `order_created_datetime`) VALUES
(1, '10002', 0, '#O100022001', 63.0000, 2.7600, 66.0000, 10001, 10001, '2019-07-18 00:33:20'),
(2, '10002', 5, '#O100022002', 12.8000, 0.3480, 13.0000, 10001, 10001, '2019-07-18 00:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `tab_product`
--

CREATE TABLE `tab_product` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `product_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `product_description` text COLLATE utf8_unicode_ci NOT NULL,
  `product_status_index` int(10) NOT NULL,
  `category_index` int(10) NOT NULL,
  `sub_category_index` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `stock_qty_limit` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_product`
--

INSERT INTO `tab_product` (`id`, `ent_code`, `product_code`, `product_name`, `product_description`, `product_status_index`, `category_index`, `sub_category_index`, `created_datetime`, `stock_qty_limit`) VALUES
(1, '10002', '#P10002-1', 'Onion', '', 10013, 11001, 20001, '2019-07-18 00:22:25', 30000),
(2, '10002', '#P10002-2', 'Carrot', '', 10013, 11001, 20001, '2019-07-18 00:24:04', 20000),
(3, '10002', '#P10002-3', 'Tomato', '', 10013, 11001, 20001, '2019-07-18 00:26:47', 40000),
(4, '10002', '#P10002-4', 'Methi', '', 10013, 11001, 20002, '2019-07-18 00:30:17', 15);

-- --------------------------------------------------------

--
-- Table structure for table `tab_series`
--

CREATE TABLE `tab_series` (
  `id` int(100) NOT NULL,
  `series_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `series_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `continues_count` int(10) NOT NULL,
  `last_updated` datetime NOT NULL,
  `ent_code` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_series`
--

INSERT INTO `tab_series` (`id`, `series_name`, `series_id`, `continues_count`, `last_updated`, `ent_code`) VALUES
(1, 'Entity', 'Ent', 10003, '2019-04-12 00:00:00', 0),
(2, 'Product Code', '#P', 5, '2019-07-18 00:00:00', 10002),
(3, 'Employee Code', '#E', 1001, '2019-04-12 00:00:00', 10002),
(4, 'User Id', '#U', 111006, '2019-05-05 00:00:00', 10002),
(5, 'Orders', '#O', 2003, '2019-07-18 07:39:42', 10002),
(6, 'Invoice', '#In', 130004, '2019-07-18 11:32:52', 10002),
(7, 'Stock Movement', '#SM', 1, '2019-06-22 00:00:00', 10002);

-- --------------------------------------------------------

--
-- Table structure for table `tab_stock_d`
--

CREATE TABLE `tab_stock_d` (
  `id` int(10) NOT NULL,
  `stock_h_id` int(10) NOT NULL,
  `stock_qty` int(10) NOT NULL,
  `online_stock_qty` int(10) NOT NULL,
  `offline_stock_qty` int(10) NOT NULL,
  `transit_qty` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_stock_d`
--

INSERT INTO `tab_stock_d` (`id`, `stock_h_id`, `stock_qty`, `online_stock_qty`, `offline_stock_qty`, `transit_qty`, `created_datetime`, `product_id`) VALUES
(1, 1, 48800, 29800, 19000, 200, '2019-07-18 00:22:25', 1),
(2, 2, 29700, 19900, 9800, 100, '2019-07-18 00:24:04', 2),
(3, 3, 48000, 24000, 14000, 1000, '2019-07-18 00:26:47', 3),
(4, 4, 15, 14, 1, 1, '2019-07-18 00:30:17', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tab_stock_h`
--

CREATE TABLE `tab_stock_h` (
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
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_stock_h`
--

INSERT INTO `tab_stock_h` (`id`, `product_id`, `product_batch`, `packets_in_box`, `product_pack_date`, `product_exp_date`, `mrp`, `tax_percent`, `purchase_rate`, `sale_rate`, `purchase_qty`, `created_datetime`) VALUES
(1, 1, '#P10002-12020-07-180.0240.023', 0, '2019-07-18', '2020-07-18', 0.0250, 2.00, 0.0240, 0.0230, 50000, '2019-07-18 00:22:25'),
(2, 2, '#P10002-22021-07-180.080.082', 0, '2020-07-18', '2021-07-18', 0.0850, 2.00, 0.0800, 0.0820, 30000, '2019-07-18 00:24:04'),
(3, 3, '#P10002-32020-07-180.0450.05', 0, '2019-07-18', '2020-07-18', 0.0520, 3.00, 0.0450, 0.0500, 50000, '2019-07-18 00:26:47'),
(4, 4, '#P10002-42022-07-181513', 0, '2021-07-18', '2022-07-18', 18.0000, 2.00, 15.0000, 13.0000, 25, '2019-07-18 00:30:17');

-- --------------------------------------------------------

--
-- Table structure for table `tab_stock_movement`
--

CREATE TABLE `tab_stock_movement` (
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
  `uom_type` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_sub_category`
--

CREATE TABLE `tab_sub_category` (
  `id` int(10) NOT NULL,
  `sub_category_index` int(10) NOT NULL,
  `sub_category_name` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `is_valid` int(10) NOT NULL,
  `category_index_id` int(10) NOT NULL
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

CREATE TABLE `tab_temp_product` (
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
  `upload_status_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_temp_stock_d`
--

CREATE TABLE `tab_temp_stock_d` (
  `id` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `stock_h_id` int(10) NOT NULL,
  `stock_qty` int(10) NOT NULL,
  `online_stock_qty` int(10) NOT NULL,
  `offline_stock_qty` int(10) NOT NULL,
  `transit_qty` int(10) NOT NULL,
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `product_id` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_temp_stock_h`
--

CREATE TABLE `tab_temp_stock_h` (
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
  `created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tab_union`
--

CREATE TABLE `tab_union` (
  `id` int(10) NOT NULL,
  `union_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL
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

CREATE TABLE `tab_uom_mapping` (
  `id` int(10) NOT NULL,
  `index_id` int(10) NOT NULL,
  `category_id` int(10) NOT NULL,
  `sub_category_id` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL
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

CREATE TABLE `tab_user` (
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
  `user_flat_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_user`
--

INSERT INTO `tab_user` (`id`, `ent_code`, `user_full_name`, `user_name`, `user_password`, `user_gender_index`, `user_age`, `user_dob`, `user_phone_no`, `user_email_id`, `user_address`, `user_address_prof`, `user_imei`, `user_designation_index`, `user_status_index`, `user_image`, `user_login_status`, `created_datetime`, `user_emp_id`, `user_id`, `user_flat_id`) VALUES
(1, '10001', 'Basanagouda Patil', 'basupatil', 'YmFzdXBhdGls', 10019, '28', '1990-04-06', 7259999282, 'basupail71@gmail.com', 'No Address', 'proof', 0, 10015, 10013, 'Capture.jpg', 0, '2019-04-09 10:13:14', '', '', 0),
(2, '10002', 'Raghu Ram .R', 'raghuram', 'cmFnaHVyYW0=', 10019, '28', '1990-04-06', 9611429415, 'user@gmail.com', 'Rohan Vasantha Apartment, Maratha Halli', 'proof', 0, 10016, 10013, 'Capture.jpg', 1, '2019-04-09 10:13:14', '', '', 0),
(3, '10002', 'BalaKumar', 'balakumar', 'YmFsYWt1bWFy', 10019, '28', '1990-04-06', 9611429417, 'user@gmail.com', 'Rohan Vasantha Apartment, Maratha Halli', 'proof', 358240051111110, 10017, 10013, 'Capture.jpg', 0, '2019-04-09 10:13:14', '', '', 0),
(4, '10002', 'Vijay', 'vijay', 'dmlqYXk=', 10019, '28', '1990-04-01', 9087654321, 'vijay@gmail.com', 'Address', 'Address proof', 645678765677879, 10017, 10013, 'Capture.jpg', 0, '2019-04-12 12:32:32', '', '', 0),
(5, '10002', '', '9867854613', 'OTg2Nzg1NDYxMw==', 10019, '', '0000-00-00', 9867854613, '', '', '', 0, 10018, 10013, 'Capture.jpg', 0, '2019-07-18 00:33:20', '', '#U10002111005', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tab_wing`
--

CREATE TABLE `tab_wing` (
  `id` int(10) NOT NULL,
  `wing` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `apartment_id` int(10) NOT NULL,
  `ent_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tab_wing`
--

INSERT INTO `tab_wing` (`id`, `wing`, `apartment_id`, `ent_code`) VALUES
(0, '-Select-', 0, '1'),
(1, 'Other', 1, '1'),
(2, 'A', 2, '10002'),
(3, 'B', 2, '10002');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tab_apartment`
--
ALTER TABLE `tab_apartment`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `apid` (`id`);

--
-- Indexes for table `tab_app_version`
--
ALTER TABLE `tab_app_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tab_bill_d`
--
ALTER TABLE `tab_bill_d`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `bhid` (`bill_h_id`);

--
-- Indexes for table `tab_bill_h`
--
ALTER TABLE `tab_bill_h`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tbhid` (`id`);

--
-- Indexes for table `tab_category`
--
ALTER TABLE `tab_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ciid` (`category_index`);

--
-- Indexes for table `tab_entity`
--
ALTER TABLE `tab_entity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teid` (`id`);

--
-- Indexes for table `tab_flat_no`
--
ALTER TABLE `tab_flat_no`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `wiid` (`wing_id`);

--
-- Indexes for table `tab_index`
--
ALTER TABLE `tab_index`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `iiid` (`index_id`);

--
-- Indexes for table `tab_notification`
--
ALTER TABLE `tab_notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tab_order_d`
--
ALTER TABLE `tab_order_d`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ohid` (`order_h_id`);

--
-- Indexes for table `tab_order_h`
--
ALTER TABLE `tab_order_h`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tohid` (`id`);

--
-- Indexes for table `tab_product`
--
ALTER TABLE `tab_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tpid` (`id`);

--
-- Indexes for table `tab_series`
--
ALTER TABLE `tab_series`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tsid` (`id`);

--
-- Indexes for table `tab_stock_d`
--
ALTER TABLE `tab_stock_d`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `shid` (`stock_h_id`);

--
-- Indexes for table `tab_stock_h`
--
ALTER TABLE `tab_stock_h`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pid` (`product_id`);

--
-- Indexes for table `tab_stock_movement`
--
ALTER TABLE `tab_stock_movement`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `tab_sub_category`
--
ALTER TABLE `tab_sub_category`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cid` (`category_index_id`);

--
-- Indexes for table `tab_temp_product`
--
ALTER TABLE `tab_temp_product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ttpid` (`id`);

--
-- Indexes for table `tab_temp_stock_d`
--
ALTER TABLE `tab_temp_stock_d`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `shid` (`stock_h_id`);

--
-- Indexes for table `tab_temp_stock_h`
--
ALTER TABLE `tab_temp_stock_h`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prid` (`product_id`);

--
-- Indexes for table `tab_union`
--
ALTER TABLE `tab_union`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tab_uom_mapping`
--
ALTER TABLE `tab_uom_mapping`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `tumid` (`id`);

--
-- Indexes for table `tab_user`
--
ALTER TABLE `tab_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tuid` (`id`);

--
-- Indexes for table `tab_wing`
--
ALTER TABLE `tab_wing`
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `aid` (`apartment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
