-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 07, 2016 at 06:48 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kho`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(500) NOT NULL,
  `image` varchar(500) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `status`, `note`) VALUES
(1, 'ac', '', 0, ''),
(2, 'abc', '', 0, 'abc'),
(3, 'abcd', '/khanh/uploads/images/1.jpg', 0, 'avc');

-- --------------------------------------------------------

--
-- Table structure for table `sale`
--

CREATE TABLE `sale` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `costprice` float NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `customer` varchar(500) NOT NULL,
  `create_at` varchar(500) NOT NULL,
  `delivery_at` date NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sale`
--

INSERT INTO `sale` (`id`, `product_id`, `costprice`, `price`, `quantity`, `status`, `customer`, `create_at`, `delivery_at`, `note`) VALUES
(4, 42, 100, 150000, 1, 1, 'Bồ yêu', '1474211120', '2016-09-23', 'Gọi trước khi giao'),
(5, 41, 70000, 110000, 2, 1, 'Phụng', '1474211334', '2016-09-19', 'abc'),
(7, 42, 100000, 100000, 2, 1, '', '1474220514', '2016-09-19', ''),
(8, 41, 70000, 100000, 1, 1, '', '1474221368', '2016-09-20', ''),
(9, 42, 100000, 110000, 2, 1, '', '1474256490', '2016-09-19', ''),
(10, 42, 100000, 120000, 1, 0, '', '1474256515', '2016-09-19', ''),
(11, 42, 100000, 130000, 1, 1, '', '1474256546', '2016-09-19', ''),
(12, 41, 70000, 100000, 1, 0, '', '1474303812', '2016-09-21', ''),
(13, 42, 100000, 110000, 1, 1, 'Khanh', '1474303860', '2016-09-27', ''),
(14, 2, 500000, 600000, 2, 0, '', '1474886954', '2016-09-26', ''),
(15, 2, 300000, 600000, 2, 0, '', '1474887113', '2016-09-26', ''),
(16, 2, 550000, 700000, 1, 0, '', '1474887285', '0000-00-00', '');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `tax_code` varchar(100) NOT NULL,
  `company` varchar(255) NOT NULL,
  `note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `phone`, `address`, `email`, `tax_code`, `company`, `note`) VALUES
(1, 'Công ty BDF', '0833975194', 'bdf', 'bdf@gmail.com', '3123213123', 'bdf', 'bdfThe controller (Form.php) has one method: index(). This method initializes the validation class and loads the form helper and URL helper used by your view files. It also runs the validation routine. Based on whether the validation was successful it either presents the form or the success page.'),
(4, 'Công ty ABC', '', '', '', '', '', ''),
(5, 'Bo Shop', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `warehouse`
--

CREATE TABLE `warehouse` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `costprice` float NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouse`
--

INSERT INTO `warehouse` (`id`, `product_id`, `costprice`, `price`, `quantity`) VALUES
(1, 22, 100000, 200000, 13),
(2, 23, 300000, 500000, 6),
(3, 24, 100000, 200000, 2),
(4, 32, 3000000, 4000000, 2),
(6, 26, 400000, 500000, 1),
(8, 37, 200000, 300000, 3),
(9, 41, 70000, 0, 2),
(10, 42, 100000, 110000, -1),
(11, 35, 300000, 0, 1),
(12, 2, 500000, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_detail`
--

CREATE TABLE `warehouse_detail` (
  `id` int(11) NOT NULL,
  `insert_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `costprice` float NOT NULL,
  `price` float NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouse_detail`
--

INSERT INTO `warehouse_detail` (`id`, `insert_id`, `product_id`, `costprice`, `price`, `quantity`) VALUES
(18, 2, 22, 300000, 350000, 4),
(19, 3, 22, 300000, 400000, 4),
(23, 5, 22, 0, 0, 1),
(24, 5, 24, 0, 0, 1),
(27, 7, 32, 3000000, 4000000, 1),
(34, 8, 22, 100000, 200000, 1),
(35, 8, 23, 100000, 200000, 1),
(36, 8, 24, 100000, 200000, 1),
(37, 1, 22, 300000, 350000, 3),
(38, 1, 23, 300000, 400000, 4),
(44, 6, 23, 300000, 500000, 1),
(45, 6, 26, 400000, 500000, 1),
(46, 10, 24, 300000, 400000, 1),
(47, 10, 27, 300000, 0, 1),
(48, 11, 28, 400000, 0, 1),
(49, 12, 32, 500000, 0, 1),
(51, 14, 23, 300000, 400000, 3),
(52, 14, 24, 400000, 500000, 4),
(53, 14, 25, 500000, 600000, 6),
(54, 15, 23, 300000, 400000, 1),
(55, 15, 25, 400000, 500000, 1),
(56, 15, 27, 500000, 600000, 1),
(60, 16, 37, 200000, 300000, 3),
(62, 18, 40, 300000, 400000, 5),
(63, 19, 41, 70000, 100000, 2),
(64, 20, 42, 100000, 0, 5),
(65, 20, 41, 70000, 0, 2),
(67, 22, 35, 300000, 0, 1),
(71, 21, 41, 65000, 150000, 6),
(72, 23, 41, 65000, 150000, 7),
(73, 24, 2, 500000, 0, 5);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_enter`
--

CREATE TABLE `warehouse_enter` (
  `id` int(11) NOT NULL,
  `total_money` float NOT NULL,
  `paid` float DEFAULT NULL,
  `supplier` int(11) NOT NULL,
  `entry_at` varchar(255) NOT NULL,
  `hinhthuc` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `note` text,
  `status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouse_enter`
--

INSERT INTO `warehouse_enter` (`id`, `total_money`, `paid`, `supplier`, `entry_at`, `hinhthuc`, `user`, `note`, `status`) VALUES
(1, 2100000, 2100000, 1, '1470624298', 1, 1, 'Đơn hàng mới', 2),
(2, 1200000, 1200000, 1, '1470204863', 1, 1, 'Đơn hàng mới', 0),
(3, 1200000, 1200000, 0, '1470204902', 1, 1, '', 0),
(5, 0, 0, 0, '1470286124', 1, 0, '', 1),
(6, 700000, 500000, 2, '1470638889', 1, 0, 'Hợp tác lần đầu', 1),
(7, 8000000, 8000000, 0, '1470293511', 1, 0, '', 1),
(8, 300000, 100000, 0, '1470622431', 1, 0, 'Update lần 1', 1),
(9, 400000, 400000, 1, '1470625283', 1, 0, '', 2),
(10, 600000, 500000, 1, '1470644702', 1, 0, '', 0),
(11, 400000, 400000, 1, '1470722608', 1, 0, 'a', 2),
(12, 500000, 0, 0, '1470722903', 1, 0, '', 2),
(13, 0, 0, 0, '1470722911', 1, 0, '', 1),
(14, 5500000, 5000000, 4, '1470815822', 1, 0, '', 0),
(15, 1200000, 1000000, 0, '1470816002', 1, 1, '', 0),
(16, 1800000, 1500000, 4, '1472449701', 1, 1, '', 1),
(17, 2000000, 2000000, 0, '1472449751', 1, 1, '', 1),
(18, 1500000, 1400000, 0, '1472611691', 1, 1, '', 0),
(19, 140000, 0, 0, '1474026344', 1, 1, '', 1),
(20, 640000, 0, 0, '1474027657', 1, 1, '', 1),
(21, 390000, NULL, 5, '1474395328', 0, 1, '', 0),
(22, 300000, 0, 0, '1474395189', 0, 1, '', 1),
(23, 455000, NULL, 5, '1474395520', 0, 1, '', 0),
(24, 2500000, NULL, 0, '1474886920', 0, 1, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `warehouse_user`
--

CREATE TABLE `warehouse_user` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `phone` varchar(100) NOT NULL,
  `level` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `create_at` varchar(255) NOT NULL,
  `randomkey` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `warehouse_user`
--

INSERT INTO `warehouse_user` (`id`, `name`, `username`, `password`, `address`, `phone`, `level`, `email`, `create_at`, `randomkey`) VALUES
(1, 'Qui Phụng', 'admin', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', 0, 'phung.lequi93@gmail.com', '', ''),
(2, 'Hoàng Long', 'hoanglong', '7c4a8d09ca3762af61e59520943dc26494f8941b', '', '', 1, '', '', ''),
(3, 'abc', 'abc', '7c4a8d09ca3762af61e59520943dc26494f8941b', 'abc', '12323123', 2, 'abc@gmail.com', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale`
--
ALTER TABLE `sale`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `supplier`
--
ALTER TABLE `supplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse`
--
ALTER TABLE `warehouse`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_detail`
--
ALTER TABLE `warehouse_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_enter`
--
ALTER TABLE `warehouse_enter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `warehouse_user`
--
ALTER TABLE `warehouse_user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `sale`
--
ALTER TABLE `sale`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `supplier`
--
ALTER TABLE `supplier`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `warehouse`
--
ALTER TABLE `warehouse`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `warehouse_detail`
--
ALTER TABLE `warehouse_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;
--
-- AUTO_INCREMENT for table `warehouse_enter`
--
ALTER TABLE `warehouse_enter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `warehouse_user`
--
ALTER TABLE `warehouse_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
