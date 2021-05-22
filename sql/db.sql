-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 22, 2021 at 08:32 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id16829760_inv_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--
CREATE DATABASE IF NOT EXISTS `inv_system` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inv_system`;

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `dayy` int(11) NOT NULL,
  `monthh` varchar(3) NOT NULL DEFAULT '',
  `eventDescription` varchar(220) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `dayy`, `monthh`, `eventDescription`, `user_id`) VALUES
(1, 5, 'Mar', 'adsdsa', 2),
(2, 10, 'Nov', 'asdasd', 2),
(3, 15, 'May', 'kifakkkkkkkkkkkkkk', 2),
(4, 18, 'Mar', 'asd', 2),
(6, 22, 'May', 'dammmeeee', 26),
(8, 29, 'May', 'sdfwer', 2);

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `address` varchar(95) NOT NULL,
  `email` varchar(120) DEFAULT 'Invalid Email',
  `phone` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `address`, `email`, `phone`) VALUES
(2, 'Customer B', 'Address C1', 'customer01@mail.com', '9911223341'),
(4, 'Customer D', 'Address C3', 'customer03@mail.com', '9911223343'),
(5, 'Customer E', 'Address C4', 'customer04@mail.com', '9911223344'),
(6, 'Customer F', 'Address C5', 'customer05@mail.com', '9911223345'),
(7, 'Customer G', 'Address C6', 'customer06@mail.com', '9911223346'),
(8, 'Customer H', 'Address C7', 'customer07@mail.com', '9911223347'),
(9, 'Customer I', 'Address C8', 'customer08@mail.com', '9911223348'),
(10, 'Customer J', 'Address C9', 'customer09@mail.com', '09911223349'),
(57, 'aaaaa', 'sss', 'Invalid Email', '1323'),
(59, 'ali kanso', '321312', 'Invalid Email', '22222'),
(60, 'aaaaaaaaaaaasdasd', '21e123', 'Invalid Email', '342'),
(61, 'aaaaa', '1e21ewqe', 'Invalid Email', '123123'),
(62, 'hello', 'akjsdjasd', 'Invalid Email', '0909090'),
(63, 'das', '', 'asd', '01010101'),
(64, 'asdad', 'asdasdasd', 'Invalid Email', '123132312'),
(65, 'asdad', 'asdasd', 'Invalid Email', '123123312'),
(66, 'jasndaj', 'jdasjd', 'jasjd', '2012021');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `address` varchar(95) NOT NULL,
  `phone` varchar(50) NOT NULL DEFAULT '',
  `gender` varchar(6) DEFAULT NULL,
  `doj` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `address`, `phone`, `gender`, `doj`) VALUES
(2, 'Employee B', 'Address E1', '123456781', 'F', '2017-01-21'),
(3, 'Employee C', 'Address E2', '123456782', 'Male', '2020-03-27'),
(5, 'Employee E', 'Address E4', '123456784', 'M', '2017-01-05'),
(6, 'Employee F', 'Address E5', '123456785', 'F', '2017-01-06'),
(7, 'Employee G', 'Address E6', '123456786', 'M', '2017-01-07'),
(8, 'Employee H', 'Address E7', '123456787', 'F', '2017-01-08'),
(9, 'Employee I', 'Address E8', '123456788', 'M', '2017-01-09'),
(10, 'Employee Jasd', 'Address E9', '123456789', '', '2020-03-28'),
(13, 'dasd', 'frqeri', '124312', 'Female', '2020-02-08'),
(14, 'adsa', 'asdad', '213123', 'Male', '2020-02-15'),
(15, 'asdasdas', 'asdasdasd', '123123123', '', '2020-03-13'),
(82, 'hadusdh', 'ahsidhas', '21838123', 'Male', '2020-03-20'),
(86, 'sdada', 'sad', '123', 'Male', '2020-03-13'),
(87, 'asdasd', 'adsasdsad', '807405403', 'Male', '2020-03-26'),
(88, 'asdasd', 'adsasd', '740523', 'Male', '2020-03-21'),
(89, 'aaaaaaaaaaaaaaaaaaaaa', 'adsads', '7809080', 'Male', '2020-03-13'),
(90, 'kkkkkkkkkkkkk', 'adasdasd', '07070707', 'Male', '2020-03-21');

-- --------------------------------------------------------

--
-- Table structure for table `machineconsumable`
--

CREATE TABLE `machineconsumable` (
  `id` int(11) NOT NULL,
  `machineType_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(70) NOT NULL,
  `serialNumber` varchar(100) DEFAULT 'None',
  `description` varchar(120) DEFAULT 'None',
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machineconsumable`
--

INSERT INTO `machineconsumable` (`id`, `machineType_id`, `name`, `serialNumber`, `description`, `price`, `quantity`) VALUES
(8, 3, 'electrode', '31222228', 'asdasd', 6, 46),
(9, 3, 'nozzle', '12312381', 'ashndahsd', 15, 3109),
(10, 3, 'shield', '123122', 'pokk', 20, 108),
(11, 4, 'tool', '123123', 'okkki', 123, 46),
(12, 4, 'collet', '123123321', 'dasd', 12312, 96),
(13, 4, 'toolholder', 'dasdasd', 'adsas', 123, 8);

-- --------------------------------------------------------

--
-- Table structure for table `machinetype`
--

CREATE TABLE `machinetype` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `consumptionRate` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `machinetype`
--

INSERT INTO `machinetype` (`id`, `name`, `consumptionRate`) VALUES
(3, 'CNC Plasma', 16),
(4, 'CNC Router', 15),
(3, 'CNC Plasma', 16),
(4, 'CNC Router', 15),
(3, 'CNC Plasma', 16),
(4, 'CNC Router', 15),
(3, 'CNC Plasma', 16),
(4, 'CNC Router', 15);

-- --------------------------------------------------------

--
-- Table structure for table `merchants`
--

CREATE TABLE `merchants` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `address` varchar(95) NOT NULL,
  `description` varchar(120) NOT NULL,
  `phone` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `merchants`
--

INSERT INTO `merchants` (`id`, `name`, `address`, `description`, `phone`) VALUES
(1, 'Merchant A', 'Address M0', 'asdasd', '9945231220'),
(12, 'okkkk', 'hasdjads', 'jashdjasdj', '090909'),
(13, 'dasd', 'ads', 'ads', '3123123'),
(14, 'asd', 'asdasd', 'ads', '123123');

-- --------------------------------------------------------

--
-- Table structure for table `plasma`
--

CREATE TABLE `plasma` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `stockQuantity` int(11) DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `fuelprice` double DEFAULT 0,
  `cost` double DEFAULT 0,
  `price` double DEFAULT 0,
  `dos` date DEFAULT NULL,
  `machineType_id` int(11) DEFAULT NULL,
  `stock_id` int(11) DEFAULT NULL,
  `electrode` int(11) DEFAULT NULL,
  `nozzle` int(11) DEFAULT NULL,
  `shield` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `plasma`
--

INSERT INTO `plasma` (`id`, `name`, `stockQuantity`, `customer_id`, `employee_id`, `fuelprice`, `cost`, `price`, `dos`, `machineType_id`, `stock_id`, `electrode`, `nozzle`, `shield`) VALUES
(6, 'test', 1, 2, 2, 9, 70.222, 20, '2021-05-17', 3, 31, 1, 1, 1),
(7, 'Bla', 1, 2, 2, 10, 77.222, 200, '2021-05-12', 3, 31, 2, 1, 1),
(8, 'bbbbb', 1, 2, 2, 10, 71.222, 10, '2021-05-12', 3, 31, 1, 1, 1),
(9, 'a', 1, 2, 2, 20, 81.222, 1, '2021-05-04', 3, 31, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `rawmaterials`
--

CREATE TABLE `rawmaterials` (
  `id` int(11) NOT NULL,
  `name` varchar(35) NOT NULL,
  `subtype` varchar(35) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rawmaterials`
--

INSERT INTO `rawmaterials` (`id`, `name`, `subtype`) VALUES
(8, 'Sheet Metal', 'standard'),
(17, 'Sheet Metal', 'samissa'),
(18, 'Sheet Metal', 'n7asss'),
(24, 'Sheet Metal', 'standradd'),
(28, 'Sheet Metal', 'dsadsa');

-- --------------------------------------------------------

--
-- Table structure for table `router`
--

CREATE TABLE `router` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `tool` int(11) NOT NULL DEFAULT 0,
  `collet` int(11) NOT NULL DEFAULT 0,
  `toolholder` int(11) NOT NULL DEFAULT 0,
  `machineType_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `stockQuantity` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `fuelprice` double NOT NULL DEFAULT 0,
  `cost` float NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0,
  `dos` date NOT NULL,
  `image` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `router`
--

INSERT INTO `router` (`id`, `name`, `tool`, `collet`, `toolholder`, `machineType_id`, `stock_id`, `stockQuantity`, `customer_id`, `employee_id`, `fuelprice`, `cost`, `price`, `dos`, `image`) VALUES
(57, 'helllo123', 0, 0, 0, 4, 39, 2, 2, 2, 0, 60.4, 1231, '2020-03-28', NULL),
(58, '132123', 0, 0, 0, 4, 38, 1, 2, 2, 1, 6.2, 2500, '2020-10-23', NULL),
(61, 'sami', 0, 0, 0, 4, 31, 1, 2, 2, 0, 20.222, 20, '2020-03-27', NULL),
(62, 'ok', 0, 0, 0, 4, 38, 1, 2, 2, 0, 5.2, 90, '2020-03-08', NULL),
(63, 'hello', 20, 120, 123, 4, 37, 1, 2, 2, 0, 0, 23, '2020-04-17', NULL),
(64, 'aab', 1, 1, 1, 4, 38, 0, 2, 2, 10, 12568, 1600, '2020-10-09', NULL),
(65, 'hehs', 1, 1, 1, 4, 38, 1, 2, 2, 0, 0, 1, '2020-03-21', NULL),
(66, 'asdasdasdasda', 1, 1, 1, 4, 38, 1, 2, 2, 100, 12663.2, 222, '2020-03-21', NULL),
(68, 'asd', 1, 1, 1, 4, 39, 1, 2, 2, 20, 12608.2, 1200, '2020-10-08', NULL),
(69, 'asd', 0, 0, 0, 4, 41, 1, 2, 2, 12, 212, 1, '2020-03-14', NULL),
(70, 'test', 1, 1, 1, 4, 31, 1, 2, 2, 10, 12588.2, 2000, '2020-10-11', NULL),
(71, 'asdk', 1, 1, 1, 4, 31, 1, 2, 2, 20, 12598.2, 20, '2021-04-29', NULL),
(72, 'askd', 1, 1, 1, 4, 31, 1, 2, 2, 1, 12579.2, 1, '2021-05-31', NULL),
(73, 'blaasss', 1, 1, 1, 4, 31, 1, 2, 2, 1, 12579.2, 20, '2021-05-02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stocks`
--

CREATE TABLE `stocks` (
  `id` int(11) NOT NULL,
  `rawMaterial_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `weight` double UNSIGNED DEFAULT 0,
  `width` double UNSIGNED DEFAULT 0,
  `height` double UNSIGNED DEFAULT 0,
  `thickness` double UNSIGNED DEFAULT 0,
  `price` double UNSIGNED DEFAULT 0,
  `quantity` int(10) UNSIGNED DEFAULT 0,
  `dop` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stocks`
--

INSERT INTO `stocks` (`id`, `rawMaterial_id`, `merchant_id`, `weight`, `width`, `height`, `thickness`, `price`, `quantity`, `dop`) VALUES
(31, 8, 1, 1, 0, 0, 0, 20.222, 94, '2021-05-20'),
(33, 8, 1, 3.3, 0, 0, 0, 20.5, 50, '2020-10-22'),
(36, 8, 1, 1, 0, 0, 0, 1, 4, '2020-02-15'),
(37, 8, 1, 1, 0, 0, 0, 1, 40, '2020-10-07'),
(38, 8, 1, 2.3, 80.6, 40.3, 96, 5.2, 20, '2020-03-28'),
(39, 8, 1, 20.6, 8.3, 6.1, 9.2, 30.2, 14, '2020-03-19'),
(40, 18, 1, 20, 10, 10, 10, 300, 10, '2021-05-28'),
(41, 18, 1, 20, 2000, 1000, 9, 200, 29, '2020-03-16');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` enum('admin','engineer','accountant') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `employee_id`, `email`, `password`, `role`) VALUES
(2, 2, 'adellkanso@gmail.com', 'adel123', 'admin'),
(26, 10, 'adel.adel@ads.asd', 'secret', 'accountant'),
(27, 8, 'adel@adel.adel', 'secret', 'engineer');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `machineconsumable`
--
ALTER TABLE `machineconsumable`
  ADD KEY `id` (`id`),
  ADD KEY `FK_machineconsumable_machinetype` (`machineType_id`);

--
-- Indexes for table `machinetype`
--
ALTER TABLE `machinetype`
  ADD KEY `id` (`id`);

--
-- Indexes for table `merchants`
--
ALTER TABLE `merchants`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- Indexes for table `plasma`
--
ALTER TABLE `plasma`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id_employee_id_machineType_id_stock_id` (`customer_id`,`employee_id`,`machineType_id`,`stock_id`),
  ADD KEY `FK_operations_stocks` (`stock_id`),
  ADD KEY `FK_operations_employees` (`employee_id`),
  ADD KEY `FK_operations_machinetype` (`machineType_id`);

--
-- Indexes for table `rawmaterials`
--
ALTER TABLE `rawmaterials`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subtype` (`subtype`);

--
-- Indexes for table `router`
--
ALTER TABLE `router`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_id` (`customer_id`),
  ADD KEY `stock_id` (`stock_id`),
  ADD KEY `machineType_id` (`machineType_id`),
  ADD KEY `employee_id` (`employee_id`) USING BTREE;

--
-- Indexes for table `stocks`
--
ALTER TABLE `stocks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `merchant_id` (`merchant_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_id` (`employee_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `machineconsumable`
--
ALTER TABLE `machineconsumable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `machinetype`
--
ALTER TABLE `machinetype`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `merchants`
--
ALTER TABLE `merchants`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `plasma`
--
ALTER TABLE `plasma`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rawmaterials`
--
ALTER TABLE `rawmaterials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `router`
--
ALTER TABLE `router`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `stocks`
--
ALTER TABLE `stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calendar`
--
ALTER TABLE `calendar`
  ADD CONSTRAINT `FK_calendar_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `machineconsumable`
--
ALTER TABLE `machineconsumable`
  ADD CONSTRAINT `FK_machineconsumable_machinetype` FOREIGN KEY (`machineType_id`) REFERENCES `machinetype` (`id`);

--
-- Constraints for table `plasma`
--
ALTER TABLE `plasma`
  ADD CONSTRAINT `FK_operations_customers` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_operations_employees` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_operations_machinetype` FOREIGN KEY (`machineType_id`) REFERENCES `machinetype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_operations_stocks` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `router`
--
ALTER TABLE `router`
  ADD CONSTRAINT `FK_soldd_items_machinetype` FOREIGN KEY (`machineType_id`) REFERENCES `machinetype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `router_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `router_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `router_ibfk_3` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
