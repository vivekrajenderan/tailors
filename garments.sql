-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2018 at 02:02 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

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
(2, 'Aryaa International', '319/B, 2nd street, Gandhipuram', 'aryaa@garments.com', 9790998545, 0, 0, '2018-06-20 00:00:00', '2018-06-20 09:19:32'),
(3, 'super company', '6/45, jurassic street', 'dididi@gg.jjj', 6766666666, 1, 0, '2018-06-20 06:37:46', '2018-06-21 03:40:14');

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
(1, 'Chudithar', 233, '1529581714-product_image.jpg', 1, 0, '2018-06-21 06:35:42', '2018-06-21 07:48:34'),
(2, 'Pant', 300, '1529581517-product_image.jpg', 1, 0, '2018-06-21 06:39:18', '2018-06-21 07:45:55'),
(3, 'Shirt', 444, '1529581569-product_image.jpeg', 1, 0, '2018-06-21 07:37:58', '2018-06-21 07:47:18');

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
(1, 'vivek', 'rajenderan', 'admin@garments.com', '', 8825751447, 'male', 'admin', 'vo+wgRwPU+JmMaSFm6HaDQ==', 1, '2018-06-19 00:00:00', '2018-06-19 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company`
--
ALTER TABLE `company`
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
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
