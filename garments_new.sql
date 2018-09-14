-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 14, 2018 at 05:06 PM
-- Server version: 5.7.23-0ubuntu0.16.04.1
-- PHP Version: 7.2.9-1+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `garments`
--

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE `company` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobileno` bigint(20) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dels` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `address`, `email`, `mobileno`, `status`, `dels`, `created_on`, `updated_on`) VALUES
(1, 'Prince Garments Inc', '1780, Firestation Road, Gandhi Managar Road, Gandhi Managar Road, Gandhi Managar Road, Gandhi Managar', 'princegarments@gmail.com', 9834234254, 1, 0, '2018-06-19 00:00:00', '2018-06-20 09:43:43'),
(2, 'Aryaa International', '319/B, 2nd street, Gandhipuram', 'aryaa@garments.com', 9790998545, 0, 0, '2018-06-20 00:00:00', '2018-07-30 07:02:33'),
(3, 'super company', '6/45, jurassic street', 'dididi@gg.jjj', 6766666666, 1, 0, '2018-06-20 06:37:46', '2018-06-21 03:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `companydeliverydetails`
--

CREATE TABLE `companydeliverydetails` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `deliveryquantity` int(11) NOT NULL,
  `paiddate` date NOT NULL,
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL,
  `dels` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companydeliverydetails`
--

INSERT INTO `companydeliverydetails` (`id`, `order_id`, `deliveryquantity`, `paiddate`, `created_on`, `updated_on`, `dels`) VALUES
(1, 1, 23, '2018-08-17', '2018-08-16 08:29:20', '0000-00-00 00:00:00', 0),
(2, 1, 29, '2018-08-24', '2018-08-16 09:50:34', '0000-00-00 00:00:00', 0),
(4, 14, 20, '2018-08-18', '2018-08-17 00:21:23', '0000-00-00 00:00:00', 0),
(5, 14, 21, '2018-08-18', '2018-08-17 00:21:40', '0000-00-00 00:00:00', 0),
(6, 1, 1, '2018-08-25', '2018-08-17 01:29:04', '0000-00-00 00:00:00', 0),
(12, 1, 1, '2018-08-24', '2018-08-17 07:05:14', '0000-00-00 00:00:00', 0),
(13, 16, 85, '2018-08-17', '2018-08-17 07:08:52', '0000-00-00 00:00:00', 0),
(14, 16, 57, '2018-08-17', '2018-08-17 07:09:59', '0000-00-00 00:00:00', 0),
(15, 16, 425, '2018-08-17', '2018-08-17 07:10:20', '0000-00-00 00:00:00', 0),
(18, 2, 4, '2018-08-24', '2018-08-17 07:18:01', '0000-00-00 00:00:00', 0),
(19, 2, 1, '2018-08-17', '2018-08-17 07:18:16', '0000-00-00 00:00:00', 0),
(20, 16, 199, '2018-09-08', '2018-09-08 02:30:07', '0000-00-00 00:00:00', 0),
(21, 16, 1, '2018-09-09', '2018-09-08 02:35:21', '0000-00-00 00:00:00', 0),
(23, 14, 3, '2018-09-08', '2018-09-08 03:16:31', '0000-00-00 00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `mobileno` varchar(15) NOT NULL,
  `address` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL,
  `dels` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `mobileno`, `address`, `status`, `created_on`, `updated_on`, `dels`) VALUES
(1, 'Vivek', '9563456783', '9/54. Anna salai Main road', 1, '2018-07-28 11:27:09', '2018-07-30 06:57:43', 0),
(2, 'Tamil Selvan', '9867666666', '6/45, Near Ibacco Ice Cream', 1, '2018-07-28 02:14:25', '2018-07-30 06:57:12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `expense_type_id` int(11) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `dels` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expenses`
--

INSERT INTO `expenses` (`id`, `expense_type_id`, `amount`, `dels`, `created_on`, `updated_on`) VALUES
(1, 1, '333', 0, '2018-09-14 07:20:44', '0000-00-00 00:00:00'),
(2, 2, '344', 0, '2018-09-14 07:21:11', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `expensetype`
--

CREATE TABLE `expensetype` (
  `id` int(11) NOT NULL,
  `name` varchar(11) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expensetype`
--

INSERT INTO `expensetype` (`id`, `name`) VALUES
(1, 'Material'),
(2, 'EB'),
(3, 'Rent'),
(4, 'Personal'),
(5, 'Other Expen');

-- --------------------------------------------------------

--
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL,
  `mname` varchar(255) CHARACTER SET utf8 NOT NULL,
  `product_id` int(11) NOT NULL,
  `dels` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `measurements`
--

INSERT INTO `measurements` (`id`, `mname`, `product_id`, `dels`) VALUES
(1, 'Right Hand', 4, 0),
(2, 'agagag', 4, 1),
(9, 'New Text', 4, 0),
(10, 'Left Hand', 4, 0),
(11, 'Ball6', 5, 1),
(15, 'டாட்டா', 1, 0),
(16, 'Measurement 2 ', 1, 0),
(17, 'Measurement 3', 1, 0),
(18, 'Measurement 4', 1, 0),
(19, 'Measurement 5', 1, 0),
(20, 'Measurement 6', 1, 0),
(21, 'Measurement1', 2, 0),
(22, 'Measurement2', 2, 0),
(23, 'Measurement3', 2, 0),
(24, 'Measurement 1', 3, 0),
(25, 'Measurement 2', 3, 0),
(26, 'Measurement 3', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `orderno` varchar(255) NOT NULL,
  `order_person_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `order_type` enum('customer','company') NOT NULL,
  `orderdate` date NOT NULL,
  `deliverydate` date DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `balance_amount` int(11) NOT NULL,
  `paid_amount` varchar(100) NOT NULL,
  `psize` varchar(100) NOT NULL,
  `meter` varchar(100) NOT NULL,
  `orderstatus` enum('open','inprogress','delivered') NOT NULL DEFAULT 'open',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_on` datetime DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dels` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `orderno`, `order_person_id`, `product_id`, `order_type`, `orderdate`, `deliverydate`, `quantity`, `price`, `total_amount`, `balance_amount`, `paid_amount`, `psize`, `meter`, `orderstatus`, `created_on`, `updated_on`, `status`, `dels`) VALUES
(1, 'ORDERNO1', 1, 1, 'company', '2018-08-07', '2018-08-18', 58, 54, '3132', 3108, '24', '', '', 'inprogress', '2018-09-08 09:18:54', NULL, 1, 0),
(2, 'ORDERNO2', 3, 2, 'company', '2018-08-07', '2018-08-14', 5, 890, '4450', 3905, '545', '', '', 'open', '2018-08-14 07:19:21', NULL, 1, 0),
(3, 'ORDERNO3', 2, 1, 'customer', '2018-08-08', NULL, 7, 678, '4746', 92, '4654', '', '', 'open', '2018-08-17 04:43:57', NULL, 1, 0),
(4, 'ORDERNO4', 1, 2, 'customer', '2018-08-07', NULL, 34, 45, '1530', 1296, '234', '', '', 'open', '2018-08-08 07:56:20', NULL, 1, 0),
(5, 'ORDERNO5', 1, 1, 'customer', '2018-08-08', NULL, 25, 56, '1400', 943, '457', '', '', 'open', '2018-08-08 01:57:27', NULL, 1, 0),
(6, 'ORDERNO6', 2, 1, 'customer', '2018-08-08', NULL, 4, 56, '224', -553, '777', '', '', 'open', '2018-08-08 02:27:32', NULL, 1, 0),
(7, 'ORDERNO7', 2, 1, 'customer', '2018-08-08', NULL, 4, 56, '224', -553, '777', '', '', 'open', '2018-08-08 02:27:36', NULL, 1, 0),
(8, 'ORDERNO8', 1, 1, 'customer', '2018-08-09', NULL, 87, 78, '6786', 5997, '789', '', '', 'open', '2018-08-16 02:34:03', NULL, 1, 0),
(9, 'ORDERNO9', 1, 1, 'customer', '2018-08-09', '2018-08-18', 87, 78, '6786', 5997, '789', '', '', 'open', '2018-08-10 11:04:45', NULL, 1, 0),
(10, 'ORDERNO10', 1, 1, 'customer', '2018-08-17', '2018-08-18', 78, 89, '6942', 6864, '78', '', '', 'open', '2018-08-17 12:59:00', '2018-08-17 08:59:00', 1, 0),
(11, 'ORDERNO11', 2, 1, 'customer', '2018-08-11', '2018-08-10', 89, 89, '7921', 133, '7788', '', '', 'open', '2018-08-10 07:56:31', NULL, 1, 0),
(12, 'ORDERNO12', 2, 2, 'customer', '2018-08-12', '2018-08-16', 77, 89, '6853', 6797, '56', '', '', 'open', '2018-08-14 05:29:15', NULL, 1, 0),
(13, 'ORDERNO13', 2, 5, 'customer', '2018-08-09', '2018-08-25', 88, 89, '7832', 6944, '888', '', '', 'open', '2018-08-14 05:29:26', NULL, 1, 0),
(14, 'ORDERNO14', 3, 1, 'company', '2018-08-11', '2018-08-24', 44, 33, '1452', 1408, '44', '34', '5', 'delivered', '2018-09-08 07:25:17', NULL, 1, 0),
(15, 'ORDERNO15', 1, 1, 'customer', '2018-08-18', '2018-08-31', 5, 98, '490', 12, '478', '', '', 'open', '2018-08-13 21:00:51', NULL, 1, 0),
(16, 'ORDERNO16', 2, 2, 'company', '2018-08-14', '2018-08-24', 767, 676, '518492', 518416, '76', '', '', 'open', '2018-08-13 21:50:25', NULL, 1, 0),
(17, 'ORDERNO17', 1, 5, 'customer', '2018-08-17', '2018-08-25', 45, 65, '2925', 2871, '54', '', '', 'open', '2018-08-17 03:26:34', NULL, 1, 0),
(18, 'ORDERNO18', 1, 3, 'customer', '2018-08-20', '2018-08-22', 54, 54, '2916', 2862, '54', '', '', 'open', '2018-08-19 19:23:11', NULL, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetailsvalue`
--

CREATE TABLE `orderdetailsvalue` (
  `id` int(11) NOT NULL,
  `measurement_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `measurementvalue` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orderdetailsvalue`
--

INSERT INTO `orderdetailsvalue` (`id`, `measurement_id`, `order_id`, `measurementvalue`) VALUES
(1, 15, 1, 'edg'),
(2, 16, 1, ''),
(3, 17, 1, ''),
(4, 18, 1, ''),
(5, 19, 1, ''),
(6, 20, 1, ''),
(7, 21, 2, 'fdj'),
(8, 22, 2, 'djd'),
(9, 23, 2, 'djd'),
(10, 15, 3, 'f'),
(11, 16, 3, 'fs'),
(12, 17, 3, 'sgs'),
(13, 18, 3, 'sgs'),
(14, 19, 3, 'sgs'),
(15, 20, 3, 'sg'),
(16, 21, 4, 'dsa'),
(17, 22, 4, 'af'),
(18, 23, 4, 'afaf'),
(19, 15, 5, '89'),
(20, 16, 5, '76'),
(21, 17, 5, '76'),
(22, 18, 5, '76'),
(23, 19, 5, 'h'),
(24, 20, 5, ''),
(25, 15, 6, '88'),
(26, 16, 6, '999'),
(27, 17, 6, '7'),
(28, 18, 6, '55'),
(29, 19, 6, '55'),
(30, 20, 6, '55'),
(31, 15, 7, '88'),
(32, 16, 7, '999'),
(33, 17, 7, '7'),
(34, 18, 7, '55'),
(35, 19, 7, '55'),
(36, 20, 7, '55'),
(37, 15, 8, '898'),
(38, 16, 8, 'hg'),
(39, 17, 8, 'hg'),
(40, 18, 8, 'h6'),
(41, 19, 8, 'hf'),
(42, 20, 8, ''),
(43, 15, 9, '898'),
(44, 16, 9, 'hg'),
(45, 17, 9, 'hg'),
(46, 18, 9, 'h6'),
(47, 19, 9, 'hf'),
(48, 20, 9, ''),
(49, 15, 10, 'hg'),
(50, 16, 10, 'fj'),
(51, 17, 10, 'fjfj'),
(52, 18, 10, 'fjfj'),
(53, 19, 10, 'fjfj'),
(54, 20, 10, 'fjfj'),
(55, 15, 11, 'hk'),
(56, 16, 11, 'ggkg'),
(57, 17, 11, 'gkg'),
(58, 18, 11, 'gkg'),
(59, 19, 11, 'gkg'),
(60, 20, 11, 'kgk'),
(61, 21, 12, 'jhy'),
(62, 22, 12, 'kgkg'),
(63, 23, 12, 'ggkgk'),
(64, 15, 14, '33'),
(65, 16, 14, '44'),
(66, 17, 14, '4'),
(67, 18, 14, '44'),
(68, 19, 14, '4'),
(69, 20, 14, 'sg'),
(70, 15, 15, ''),
(71, 16, 15, ''),
(72, 17, 15, ''),
(73, 18, 15, ''),
(74, 19, 15, ''),
(75, 20, 15, ''),
(76, 21, 16, 'hhhh'),
(77, 22, 16, 'hhhhhhhhhf'),
(78, 23, 16, 'fjf'),
(79, 24, 18, '565'),
(80, 25, 18, 'fd'),
(81, 26, 18, 'gfdh');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `productname` varchar(255) NOT NULL,
  `price` int(11) NOT NULL,
  `product_image` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dels` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `productname`, `price`, `product_image`, `status`, `dels`, `created_on`, `updated_on`) VALUES
(1, 'Chudithar', 233, '1529581714-product_image.jpg', 1, 0, '2018-06-21 06:35:42', '2018-08-02 09:11:52'),
(2, 'Pant', 300, '1529581517-product_image.jpg', 1, 0, '2018-06-21 06:39:18', '2018-07-30 06:49:59'),
(3, 'Shirt', 444, '1529581569-product_image.jpeg', 1, 0, '2018-06-21 07:37:58', '2018-07-30 06:50:22'),
(4, 'jyyy', 43, '', 1, 0, '2018-07-26 03:53:36', '2018-07-26 07:40:39'),
(5, 'Supers', 545, '1532605330-product_image.jpg', 1, 0, '2018-07-26 07:42:10', '2018-07-26 07:46:30');

-- --------------------------------------------------------

--
-- Table structure for table `producttypevalue`
--

CREATE TABLE `producttypevalue` (
  `id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `typevalue` varchar(20) NOT NULL,
  `dels` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `producttypevalue`
--

INSERT INTO `producttypevalue` (`id`, `type_id`, `order_id`, `typevalue`, `dels`) VALUES
(1, 1, 5, 'checked', 0),
(2, 4, 5, '', 0),
(6, 1, 7, '', 0),
(7, 2, 7, '', 0),
(8, 4, 7, '', 0),
(14, 1, 6, 'checked', 0),
(15, 2, 6, 'checked', 0),
(16, 3, 6, 'checked', 0),
(17, 4, 6, 'checked', 0),
(18, 1, 8, '', 0),
(19, 3, 8, '', 0),
(31, 1, 11, 'checked', 0),
(32, 4, 11, 'checked', 0),
(33, 1, 9, 'checked', 0),
(34, 2, 9, 'checked', 0),
(35, 3, 9, 'checked', 0),
(36, 4, 15, '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_types`
--

CREATE TABLE `product_types` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `typename` varchar(255) CHARACTER SET utf8 NOT NULL,
  `typeimage` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dels` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_types`
--

INSERT INTO `product_types` (`id`, `product_id`, `typename`, `typeimage`, `status`, `dels`) VALUES
(1, 1, 'Neck Model', '1533627709-typeimage.jpg', 1, 0),
(2, 1, 'Round Model', '1533714826-typeimage.jpg', 1, 0),
(3, 1, 'Vshape Model', '1533714829-typeimage.jpg', 1, 0),
(4, 1, 'Chest Round Model', '1533727049-typeimage.jpeg', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `staffbalance`
--

CREATE TABLE `staffbalance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `buydate` date NOT NULL,
  `dels` int(11) NOT NULL DEFAULT '0',
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staffbalance`
--

INSERT INTO `staffbalance` (`id`, `user_id`, `amount`, `buydate`, `dels`, `created_on`, `updated_on`) VALUES
(1, 2, 90, '2018-08-10', 0, '2018-08-10 03:44:22', '2018-08-10 09:22:35'),
(2, 2, 78, '2018-08-17', 1, '2018-08-10 03:49:22', '2018-08-10 09:22:27'),
(3, 3, 49, '2018-08-17', 0, '2018-08-10 04:31:54', '2018-08-10 10:02:41'),
(4, 2, 443, '2018-08-17', 0, '2018-08-17 01:59:04', '0000-00-00 00:00:00'),
(5, 2, 44, '2018-09-28', 0, '2018-09-07 20:38:45', '0000-00-00 00:00:00'),
(6, 2, 878, '2018-09-20', 0, '2018-09-07 20:38:59', '0000-00-00 00:00:00'),
(7, 2, 888888, '2018-09-30', 0, '2018-09-07 20:39:10', '0000-00-00 00:00:00'),
(8, 2, 777, '2018-09-04', 0, '2018-09-07 20:39:19', '0000-00-00 00:00:00'),
(9, 1, 7878, '2018-09-03', 0, '2018-09-07 20:39:28', '0000-00-00 00:00:00'),
(10, 2, 3343, '2018-09-05', 0, '2018-09-07 20:39:37', '0000-00-00 00:00:00'),
(11, 3, 33, '2018-09-06', 0, '2018-09-07 20:39:49', '0000-00-00 00:00:00'),
(12, 3, 343453, '2018-09-11', 0, '2018-09-07 20:40:01', '0000-00-00 00:00:00'),
(13, 1, 342, '2018-09-04', 0, '2018-09-07 20:40:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `mobileno` bigint(20) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int(11) NOT NULL,
  `userimage` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `dels` int(11) NOT NULL DEFAULT '0',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `address`, `mobileno`, `gender`, `username`, `password`, `role`, `userimage`, `status`, `dels`, `created_on`, `updated_on`) VALUES
(1, 'Tamil', 'Selvans', 'admin@sstailor.com', 'WEa agag      ghhs\r\nsh\r\nshs\r\nhsh\r\nsh\r\nshshsh\r\nshsh\r\nshs\r\nhs\r\nhsh\r\nsh\r\nsh\r\nsh\r\nshs\r\nhsh\r\nss\r\nhsh\r\nsh\r\nshs\r\nhsh', 8825751447, 'male', 'admin', 'vo+wgRwPU+JmMaSFm6HaDQ==', 1, '1534231490-userimage.jpeg', 1, 0, '2018-06-19 00:00:00', '2018-09-10 02:11:56'),
(2, 'Pransanths', 'Kannan', '', 'agag agag', 9546476474, 'male', 'gunasekar', '2UuB8DWtoflsty2o/IC70w==', 2, '1534155808-userimage.png', 1, 0, '2018-08-06 03:52:58', '2018-09-10 02:12:54'),
(3, 'balakirshnan', 'velu', '', 'aga,a agag fgs\r\nhs h\r\nshs\r\nhsh\r\n sh\r\nsh\r\ns\r\nh\r\nsh\r\ns\r\nh\r\nshshsh\r\nshsh\r\nshfdsdgs ag\r\nag\r\nag\r\nag\r\na gag\r\nag aga\r\ngagag\r\na gag\r\nagag', 4363636363, 'male', 'balakrishnan', 'y3J/xsT3g3KJxC8dE9rU1A==', 2, '', 1, 0, '2018-08-10 09:14:04', '2018-09-10 02:12:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companydeliverydetails`
--
ALTER TABLE `companydeliverydetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expensetype`
--
ALTER TABLE `expensetype`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `measurements`
--
ALTER TABLE `measurements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orderdetailsvalue`
--
ALTER TABLE `orderdetailsvalue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `producttypevalue`
--
ALTER TABLE `producttypevalue`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_types`
--
ALTER TABLE `product_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staffbalance`
--
ALTER TABLE `staffbalance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `company`
--
ALTER TABLE `company`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `companydeliverydetails`
--
ALTER TABLE `companydeliverydetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `expensetype`
--
ALTER TABLE `expensetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `orderdetailsvalue`
--
ALTER TABLE `orderdetailsvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `producttypevalue`
--
ALTER TABLE `producttypevalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT for table `product_types`
--
ALTER TABLE `product_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `staffbalance`
--
ALTER TABLE `staffbalance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
