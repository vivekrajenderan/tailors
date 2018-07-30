-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 30, 2018 at 05:13 PM
-- Server version: 5.7.22-0ubuntu0.16.04.1
-- PHP Version: 7.0.30-0ubuntu0.16.04.1

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
-- Table structure for table `measurements`
--

CREATE TABLE `measurements` (
  `id` int(11) NOT NULL,
  `mname` varchar(255) NOT NULL,
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
(15, 'Measruement 1', 1, 0),
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
  `quantity` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `total_amount` varchar(100) NOT NULL,
  `balance_amount` int(11) NOT NULL,
  `paid_amount` varchar(100) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1',
  `dels` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'Chudithar', 233, '1529581714-product_image.jpg', 1, 0, '2018-06-21 06:35:42', '2018-07-30 03:03:40'),
(2, 'Pant', 300, '1529581517-product_image.jpg', 1, 0, '2018-06-21 06:39:18', '2018-07-30 06:49:59'),
(3, 'Shirt', 444, '1529581569-product_image.jpeg', 1, 0, '2018-06-21 07:37:58', '2018-07-30 06:50:22'),
(4, 'jyyy', 43, '', 1, 1, '2018-07-26 03:53:36', '2018-07-26 07:40:39'),
(5, 'Supers', 545, '1532605330-product_image.jpg', 1, 1, '2018-07-26 07:42:10', '2018-07-26 07:46:30');

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
  `status` int(11) NOT NULL DEFAULT '1',
  `created_on` datetime NOT NULL,
  `updated_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstname`, `lastname`, `email`, `address`, `mobileno`, `gender`, `username`, `password`, `status`, `created_on`, `updated_on`) VALUES
(1, 'Tamil', 'Selvan', 'admin@sstailor.com', '', 8825751447, 'male', 'admin', 'vo+wgRwPU+JmMaSFm6HaDQ==', 1, '2018-06-19 00:00:00', '2018-06-19 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
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
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `measurements`
--
ALTER TABLE `measurements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `orderdetailsvalue`
--
ALTER TABLE `orderdetailsvalue`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
