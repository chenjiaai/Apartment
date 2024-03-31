-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 31, 2024 at 09:19 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `apartment`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `password` varchar(100) NOT NULL COMMENT '密码',
  `surname` varchar(100) NOT NULL COMMENT '性',
  `name` varchar(100) NOT NULL COMMENT '名',
  `gender` enum('male','female') NOT NULL COMMENT '性别',
  `email` varchar(100) DEFAULT NULL COMMENT '管理员邮箱'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `surname`, `name`, `gender`, `email`) VALUES
(1, 'test', '1234', '1', '2', 'male', '1@mail.com'),
(2, 'test1', '1234', 'm', 'm', 'male', '1@hotmail.com'),
(3, 'test22', '81dc9bdb52d04dc20036dbd8313ed055', 'a', 'a', 'male', '222@gmail.com'),
(4, 'test1111', 'cc34e6614ed384db3189234c6fa860c8', 't', 't', 'male', 'tttt@gmail.com'),
(5, 't99', '81dc9bdb52d04dc20036dbd8313ed055', '1', '2', 'male', '1@hotmail.com'),
(6, 'admin1', '21232f297a57a5a743894a0e4a801fc3', 't', 't', 'male', '1@hotmail.com'),
(7, 'admin2', 'admin1', 'admin', 'admin', 'male', 'admin@hotmail.com'),
(8, 't1234', 'test1234', 'tttttt', 'ttttttt', 'female', 'tttt@hotmail.com'),
(9, 'admin1234', 'e10adc3949ba59abbe56e057f20f883e', 'Saridichainanta', 'Nattapol', 'male', 'admin22@hotmail.com'),
(10, 'admin666', 'e10adc3949ba59abbe56e057f20f883e', '11', 'nc', 'male', 'AAAAA'),
(11, 'mildprdd', 'b59c67bf196a4758191e42f76670ceba', 'mildd', 'mildprdd', 'male', 'mild@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `cost`
--

CREATE TABLE `cost` (
  `id` int(11) NOT NULL,
  `priceW` int(10) NOT NULL COMMENT '水费',
  `priceE` int(10) NOT NULL COMMENT '电费',
  `commonfee` int(10) NOT NULL COMMENT '管理费'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cost`
--

INSERT INTO `cost` (`id`, `priceW`, `priceE`, `commonfee`) VALUES
(2, 2, 3, 45);

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

CREATE TABLE `invoice` (
  `id` int(10) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `number` varchar(100) NOT NULL COMMENT '房号',
  `tel` varchar(100) NOT NULL COMMENT '房客电话',
  `beforeW` int(10) NOT NULL COMMENT '上月水费',
  `afterW` int(10) NOT NULL COMMENT '本月水费',
  `beforeE` int(10) NOT NULL COMMENT '上月电费',
  `afterE` int(10) NOT NULL COMMENT '本月电费',
  `mulct` int(10) NOT NULL COMMENT '罚金',
  `dateInvoice` date NOT NULL COMMENT '开票日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `moveout`
--

CREATE TABLE `moveout` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL COMMENT '用户名',
  `number` varchar(100) NOT NULL COMMENT '房号',
  `tel` varchar(100) NOT NULL COMMENT '房客电话',
  `emailT` varchar(100) NOT NULL COMMENT '房客邮箱',
  `dateIn` date NOT NULL COMMENT '搬入',
  `dateOut` date NOT NULL COMMENT '搬出'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `moveout`
--

INSERT INTO `moveout` (`id`, `username`, `number`, `tel`, `emailT`, `dateIn`, `dateOut`) VALUES
(15, 'Moss', '6', '1212112', 'Moss@gmail.com', '2023-05-01', '2023-05-09'),
(16, 'Kd', '1', 'x', 'Kevin@mail.com', '2023-05-03', '2023-06-15'),
(17, '11111111', '10', 'aa', '1111111111', '2023-06-21', '2023-06-22');

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `id` int(10) NOT NULL,
  `room_type` varchar(100) DEFAULT NULL,
  `number` varchar(100) NOT NULL COMMENT '房号',
  `price` varchar(100) NOT NULL COMMENT '房价',
  `statusRoom` varchar(100) DEFAULT NULL COMMENT '房间状态'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `room`
--

INSERT INTO `room` (`id`, `room_type`, `number`, `price`, `statusRoom`) VALUES
(1, 'AAA', '101', '100', 'BUSY');

-- --------------------------------------------------------

--
-- Table structure for table `tenantinfo`
--

CREATE TABLE `tenantinfo` (
  `id` int(10) NOT NULL,
  `number` varchar(100) DEFAULT NULL COMMENT '房号',
  `username` varchar(100) DEFAULT NULL COMMENT '用户名',
  `tel` varchar(100) NOT NULL COMMENT '房客电话',
  `emailT` varchar(100) NOT NULL COMMENT '房客邮箱',
  `dateIn` date NOT NULL COMMENT '搬入',
  `dateOut` date DEFAULT NULL COMMENT '搬出',
  `beforeW` int(10) DEFAULT NULL COMMENT '上月水费',
  `afterW` int(10) DEFAULT NULL COMMENT '本月水费',
  `beforeE` int(10) DEFAULT NULL COMMENT '上月电费',
  `afterE` int(10) DEFAULT NULL COMMENT '本月电费',
  `mulct` int(10) DEFAULT NULL COMMENT '罚金',
  `status` varchar(100) DEFAULT NULL COMMENT '付款状态',
  `statusRoom` varchar(100) DEFAULT NULL COMMENT '房间状态',
  `dateInvoice` date DEFAULT NULL COMMENT '开票日期'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tenantinfo`
--

INSERT INTO `tenantinfo` (`id`, `number`, `username`, `tel`, `emailT`, `dateIn`, `dateOut`, `beforeW`, `afterW`, `beforeE`, `afterE`, `mulct`, `status`, `statusRoom`, `dateInvoice`) VALUES
(13, '2', '222', '123234242', 'Krist@mail.com', '2023-05-17', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(14, '5', 'Patt', '312323232', 'Patt@mail.com', '2023-05-29', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(15, '3', 'Br', '121212121', 'Br@mail.com', '2023-05-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(16, '25', 'John', '21212121', 'John@mail.com', '2023-05-01', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(19, '21', '2019326660438', 'SSSS', 'John@gmail.com', '2023-05-31', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL),
(20, '9', 'TESTER1', '123456', 'John@gmail.com', '2025-02-25', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost`
--
ALTER TABLE `cost`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice`
--
ALTER TABLE `invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moveout`
--
ALTER TABLE `moveout`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tenantinfo`
--
ALTER TABLE `tenantinfo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `cost`
--
ALTER TABLE `cost`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice`
--
ALTER TABLE `invoice`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `moveout`
--
ALTER TABLE `moveout`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tenantinfo`
--
ALTER TABLE `tenantinfo`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
