-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.6-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for inv_system
CREATE DATABASE IF NOT EXISTS `inv_system` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `inv_system`;

-- Dumping structure for table inv_system.calendar
CREATE TABLE IF NOT EXISTS `calendar` (
  `dayy` int(11) NOT NULL,
  `monthh` varchar(3) NOT NULL DEFAULT '',
  `eventDescription` varchar(220) NOT NULL,
  PRIMARY KEY (`dayy`,`monthh`,`eventDescription`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.calendar: ~3 rows (approximately)
DELETE FROM `calendar`;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` (`dayy`, `monthh`, `eventDescription`) VALUES
	(5, 'Mar', 'adsdsa'),
	(10, 'Nov', 'asdasd'),
	(18, 'Mar', 'asd'),
	(20, 'Mar', 'sdfwer');
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;

-- Dumping structure for table inv_system.customers
CREATE TABLE IF NOT EXISTS `customers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `address` varchar(95) NOT NULL,
  `email` varchar(120) DEFAULT 'Invalid Email',
  `phone` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.customers: ~16 rows (approximately)
DELETE FROM `customers`;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
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
	(65, 'asdad', 'asdasd', 'Invalid Email', '123123312');
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;

-- Dumping structure for table inv_system.employees
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `address` varchar(95) NOT NULL,
  `phone` varchar(50) NOT NULL DEFAULT '',
  `gender` varchar(6) DEFAULT NULL,
  `doj` date NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.employees: ~16 rows (approximately)
DELETE FROM `employees`;
/*!40000 ALTER TABLE `employees` DISABLE KEYS */;
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
/*!40000 ALTER TABLE `employees` ENABLE KEYS */;

-- Dumping structure for table inv_system.machineconsumable
CREATE TABLE IF NOT EXISTS `machineconsumable` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `machineType_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(70) NOT NULL,
  `serialNumber` varchar(100) DEFAULT 'None',
  `description` varchar(120) DEFAULT 'None',
  `price` double NOT NULL,
  `quantity` int(11) NOT NULL,
  KEY `id` (`id`),
  KEY `FK_machineconsumable_machinetype` (`machineType_id`),
  CONSTRAINT `FK_machineconsumable_machinetype` FOREIGN KEY (`machineType_id`) REFERENCES `machinetype` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.machineconsumable: ~6 rows (approximately)
DELETE FROM `machineconsumable`;
/*!40000 ALTER TABLE `machineconsumable` DISABLE KEYS */;
INSERT INTO `machineconsumable` (`id`, `machineType_id`, `name`, `serialNumber`, `description`, `price`, `quantity`) VALUES
	(8, 3, 'electrode', '3122222', 'asdasd', 6, 57),
	(9, 3, 'nozzle', '1231238', 'ashndahsd', 15, 3119),
	(10, 3, 'shield', '123122', 'pokk', 20, 118),
	(11, 4, 'tool', '123123', 'okkki', 123, 49),
	(12, 4, 'collet', '123123321', 'dasd', 12312, 99),
	(13, 4, 'toolholder', 'dasdasd', 'adsas', 123, 11);
/*!40000 ALTER TABLE `machineconsumable` ENABLE KEYS */;

-- Dumping structure for table inv_system.machinetype
CREATE TABLE IF NOT EXISTS `machinetype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `consumptionRate` double DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.machinetype: ~2 rows (approximately)
DELETE FROM `machinetype`;
/*!40000 ALTER TABLE `machinetype` DISABLE KEYS */;
INSERT INTO `machinetype` (`id`, `name`, `consumptionRate`) VALUES
	(3, 'CNC Plasma', 16),
	(4, 'CNC Router', 15);
/*!40000 ALTER TABLE `machinetype` ENABLE KEYS */;

-- Dumping structure for table inv_system.merchants
CREATE TABLE IF NOT EXISTS `merchants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) NOT NULL,
  `address` varchar(95) NOT NULL,
  `description` varchar(120) NOT NULL,
  `phone` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `phone` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.merchants: ~4 rows (approximately)
DELETE FROM `merchants`;
/*!40000 ALTER TABLE `merchants` DISABLE KEYS */;
INSERT INTO `merchants` (`id`, `name`, `address`, `description`, `phone`) VALUES
	(1, 'Merchant A', 'Address M0', 'asdasd', '9945231220'),
	(12, 'okkkk', 'hasdjads', 'jashdjasdj', '090909'),
	(13, 'dasd', 'ads', 'ads', '3123123'),
	(14, 'asd', 'asdasd', 'ads', '123123');
/*!40000 ALTER TABLE `merchants` ENABLE KEYS */;

-- Dumping structure for table inv_system.metal
CREATE TABLE IF NOT EXISTS `metal` (
  `metalprice` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.metal: ~0 rows (approximately)
DELETE FROM `metal`;
/*!40000 ALTER TABLE `metal` DISABLE KEYS */;
/*!40000 ALTER TABLE `metal` ENABLE KEYS */;

-- Dumping structure for table inv_system.products
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(35) NOT NULL,
  `subtype` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subtype` (`subtype`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.products: ~5 rows (approximately)
DELETE FROM `products`;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` (`id`, `name`, `subtype`) VALUES
	(8, 'Sheet Metal', 'standard'),
	(17, 'Sheet Metal', 'samissa'),
	(18, 'Sheet Metal', 'n7asss'),
	(24, 'Sheet Metal', 'standrad'),
	(28, 'Sheet Metal', 'dsadsa');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;

-- Dumping structure for table inv_system.soldd_items
CREATE TABLE IF NOT EXISTS `soldd_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `image` longblob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `employee_id` (`employee_id`),
  KEY `stock_id` (`stock_id`),
  KEY `machineType_id` (`machineType_id`),
  CONSTRAINT `FK_soldd_items_machinetype` FOREIGN KEY (`machineType_id`) REFERENCES `machinetype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `soldd_items_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `soldd_items_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `soldd_items_ibfk_3` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.soldd_items: ~9 rows (approximately)
DELETE FROM `soldd_items`;
/*!40000 ALTER TABLE `soldd_items` DISABLE KEYS */;
INSERT INTO `soldd_items` (`id`, `name`, `tool`, `collet`, `toolholder`, `machineType_id`, `stock_id`, `stockQuantity`, `customer_id`, `employee_id`, `fuelprice`, `cost`, `price`, `dos`, `image`) VALUES
	(57, 'helllo123', 0, 0, 0, 4, 39, 2, 2, 2, 0, 60.4, 1231, '2020-03-28', NULL),
	(58, '132123', 0, 0, 0, 4, 38, 1, 2, 2, 20, 25.2, 2500, '2020-10-11', NULL),
	(61, 'sami', 0, 0, 0, 4, 31, 1, 2, 2, 0, 20.222, 20, '2020-03-27', NULL),
	(62, 'ok', 0, 0, 0, 4, 38, 1, 2, 2, 0, 5.2, 90, '2020-03-08', NULL),
	(63, 'hello', 20, 120, 123, 4, 37, 1, 2, 2, 0, 0, 23, '2020-04-17', NULL),
	(64, 'aab', 1, 1, 1, 4, 38, 0, 2, 2, 30, 12588, 1600, '2020-10-08', NULL),
	(65, 'hehs', 1, 1, 1, 4, 38, 1, 2, 2, 0, 0, 1, '2020-03-21', NULL),
	(66, 'asdasdasdasda', 1, 1, 1, 4, 38, 1, 2, 2, 100, 12663.2, 222, '2020-03-21', NULL),
	(68, 'asd', 1, 1, 1, 4, 39, 1, 2, 2, 20, 12608.2, 1200, '2020-10-08', NULL),
	(69, 'asd', 0, 0, 0, 4, 41, 1, 2, 2, 12, 212, 1, '2020-03-14', NULL),
	(70, 'test', 1, 1, 1, 4, 31, 1, 2, 2, 10, 12588.2, 2000, '2020-10-11', NULL);
/*!40000 ALTER TABLE `soldd_items` ENABLE KEYS */;

-- Dumping structure for table inv_system.sold_items
CREATE TABLE IF NOT EXISTS `sold_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `electrode` int(11) NOT NULL DEFAULT 0,
  `nozzle` int(11) NOT NULL DEFAULT 0,
  `shield` int(11) NOT NULL DEFAULT 0,
  `machineType_id` int(11) NOT NULL,
  `stock_id` int(11) NOT NULL,
  `stockQuantity` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `fuelprice` double NOT NULL DEFAULT 0,
  `cost` float NOT NULL DEFAULT 0,
  `price` float NOT NULL DEFAULT 0,
  `dos` date NOT NULL,
  `image` longblob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_id` (`customer_id`),
  KEY `employee_id` (`employee_id`),
  KEY `stock_id` (`stock_id`),
  KEY `machineType_id` (`machineType_id`),
  CONSTRAINT `FK_sold_items_machinetype` FOREIGN KEY (`machineType_id`) REFERENCES `machinetype` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sold_items_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sold_items_ibfk_2` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sold_items_ibfk_3` FOREIGN KEY (`stock_id`) REFERENCES `stocks` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.sold_items: ~10 rows (approximately)
DELETE FROM `sold_items`;
/*!40000 ALTER TABLE `sold_items` DISABLE KEYS */;
INSERT INTO `sold_items` (`id`, `name`, `electrode`, `nozzle`, `shield`, `machineType_id`, `stock_id`, `stockQuantity`, `customer_id`, `employee_id`, `fuelprice`, `cost`, `price`, `dos`, `image`) VALUES
	(60, 'asjidhasiidasd', 2, 2, 2, 3, 39, 1, 2, 2, 21, 133.2, 213, '2020-02-15', NULL),
	(64, 'saas', 1, 1, 1, 3, 38, 2, 2, 2, 1, 52.4, 23, '2020-03-11', NULL),
	(65, 'asd', 1, 1, 1, 3, 38, 1, 2, 2, 60, 106.2, 1800, '2020-10-16', NULL),
	(66, 'asasas', 1, 1, 1, 3, 38, 1, 2, 2, 30, 76.2, 5000, '2020-10-05', NULL),
	(68, '3', 1, 1, 1, 3, 38, 1, 2, 2, 10, 56.2, 2000, '2020-10-02', NULL),
	(69, 'sami', 2, 2, 2, 3, 31, 1, 2, 2, 0, 6516.22, 1, '2020-03-28', NULL),
	(70, 'cone', 1, 1, 1, 3, 39, 1, 2, 2, 10, 81.2, 160, '2020-03-13', NULL),
	(71, 'test', 1, 1, 1, 3, 31, 1, 2, 2, 20, 81.222, 3000, '2020-10-11', NULL),
	(72, 'test2', 1, 1, 1, 3, 31, 1, 2, 2, 20, 81.222, 4000, '2020-10-11', NULL),
	(73, 'test', 1, 1, 1, 3, 31, 1, 2, 2, 5, 66.222, 1500, '2020-10-11', NULL);
/*!40000 ALTER TABLE `sold_items` ENABLE KEYS */;

-- Dumping structure for table inv_system.stocks
CREATE TABLE IF NOT EXISTS `stocks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `merchant_id` int(11) NOT NULL,
  `weight` double unsigned DEFAULT 0,
  `width` double unsigned DEFAULT 0,
  `height` double unsigned DEFAULT 0,
  `thickness` double unsigned DEFAULT 0,
  `price` double unsigned DEFAULT 0,
  `quantity` int(10) unsigned DEFAULT 0,
  `dop` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `merchant_id` (`merchant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.stocks: ~8 rows (approximately)
DELETE FROM `stocks`;
/*!40000 ALTER TABLE `stocks` DISABLE KEYS */;
INSERT INTO `stocks` (`id`, `product_id`, `merchant_id`, `weight`, `width`, `height`, `thickness`, `price`, `quantity`, `dop`) VALUES
	(31, 8, 1, 1, 0, 0, 0, 20.222, 6, '2020-10-20'),
	(33, 8, 1, 3.3, 0, 0, 0, 20.5, 50, '2020-10-22'),
	(36, 8, 1, 1, 0, 0, 0, 1, 4, '2020-02-15'),
	(37, 8, 1, 1, 0, 0, 0, 1, 40, '2020-10-07'),
	(38, 8, 1, 2.3, 80.6, 40.3, 96, 5.2, 20, '2020-03-28'),
	(39, 8, 1, 20.6, 8.3, 6.1, 9.2, 30.2, 14, '2020-03-19'),
	(40, 18, 1, 20, 10, 10, 10, 300, 8, '2020-03-28'),
	(41, 18, 1, 20, 2000, 1000, 9, 200, 29, '2020-03-16');
/*!40000 ALTER TABLE `stocks` ENABLE KEYS */;

-- Dumping structure for table inv_system.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `password` varchar(128) NOT NULL,
  `admin` tinyint(4) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employee_id` (`employee_id`),
  UNIQUE KEY `email` (`email`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- Dumping data for table inv_system.users: ~4 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `employee_id`, `email`, `password`, `admin`) VALUES
	(2, 2, 'adellkanso@gmail.com', 'adel123', 1),
	(10, 7, 'samisami@gmail.com', 'secret', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
