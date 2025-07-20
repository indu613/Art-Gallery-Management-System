-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 20, 2025 at 10:59 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artg`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE IF NOT EXISTS `cart` (
  `cartid` int NOT NULL AUTO_INCREMENT,
  `cid` int DEFAULT NULL,
  `stid` int DEFAULT NULL,
  PRIMARY KEY (`cartid`),
  KEY `cid` (`cid`),
  KEY `stid` (`stid`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cartid`, `cid`, `stid`) VALUES
(59, 8, 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `orderid` int NOT NULL AUTO_INCREMENT,
  `custid` int DEFAULT NULL,
  `orderdate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `amount` decimal(10,2) DEFAULT NULL,
  `s_fullname` varchar(255) DEFAULT NULL,
  `s_address` varchar(255) DEFAULT NULL,
  `s_city` varchar(100) DEFAULT NULL,
  `s_pincode` varchar(10) DEFAULT NULL,
  `s_phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`orderid`),
  KEY `custid` (`custid`)
) ENGINE=MyISAM AUTO_INCREMENT=92 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`orderid`, `custid`, `orderdate`, `amount`, `s_fullname`, `s_address`, `s_city`, `s_pincode`, `s_phone`) VALUES
(86, 15, '2023-11-20 05:28:55', '36000.00', 'Johhny Suh', 'ABC apartment', 'Kochi', '665544', '9988776655'),
(87, 9, '2023-11-20 10:28:16', '62000.00', 'Ardra Pradeepkumar', 'Bolgatty', 'Kochi', '654321', '9988776655'),
(88, 9, '2023-11-21 09:37:45', '40000.00', 'Ardra Pradeepkumar', 'Bolgatty', 'Kochi', '665544', '9988776655'),
(89, 9, '2023-11-22 06:05:34', '81000.00', 'Ardra Pradeepkumar', 'Bolgatty', 'Kochi', '665544', '9998877776'),
(90, 0, '2024-04-21 05:50:26', NULL, '', '', '', '', ''),
(91, 8, '2024-04-21 05:53:08', NULL, 'neeraja', 'ABC apartment', 'Kochi', '683111', '9988776655');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `card_no` varchar(20) NOT NULL,
  `cvv` varchar(5) DEFAULT NULL,
  `expiry` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`card_no`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`card_no`, `cvv`, `expiry`) VALUES
('1111-2222-3333-4444', '123', '2023-12'),
('1234-1234-1234-1234', '321', '2024-03');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

DROP TABLE IF EXISTS `stock`;
CREATE TABLE IF NOT EXISTS `stock` (
  `stockid` int NOT NULL AUTO_INCREMENT,
  `artistid` int DEFAULT NULL,
  `artname` varchar(50) DEFAULT NULL,
  `medium` varchar(30) DEFAULT NULL,
  `genre` varchar(30) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `image` blob,
  `status` enum('available','in_cart','out_of_stock') DEFAULT 'available',
  PRIMARY KEY (`stockid`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockid`, `artistid`, `artname`, `medium`, `genre`, `price`, `image`, `status`) VALUES
(1, 7, 'The Great Wave', 'Oil', 'Nature', 40000, 0x2e2f706963732f617274776f726b312e6a7067, 'out_of_stock'),
(2, 7, 'Victoria Terminus', 'Watercolour', 'Life', 36000, 0x2e2f706963732f617274776f726b322e6a7067, 'out_of_stock'),
(5, 3, 'Helgoland', 'Oil', 'Modern', 62000, 0x2e2f706963732f617274776f726b352e6a7067, 'out_of_stock'),
(8, 10, 'When sky meets sea', 'oil', 'Landscape', 40000, 0x2e2f706963732f417274776f726b372d5768656e20736b79206d65657473207365612e6a706567, 'available'),
(6, 13, 'Still Life', 'Oil', 'Conceptual', 32000, 0x2e2f706963732f617274776f726b332e6a7067, 'available'),
(7, 16, 'Nature', 'Watercolour', 'Abstract', 31000, 0x2e2f706963732f617274776f726b362e6a7067, 'out_of_stock'),
(9, 3, 'By the sea', 'Acrylic', 'Impressionism', 50000, 0x2e2f706963732f417274776f726b382d427920746865205365612e6a706567, 'out_of_stock'),
(10, 10, 'Fall', 'Watercolour', 'Landscape', 60000, 0x2e2f706963732f417274776f726b392d46616c6c2e6a706567, 'in_cart');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `pwd` varchar(50) DEFAULT NULL,
  `contact` varchar(20) DEFAULT NULL,
  `usertype` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`userid`),
  UNIQUE KEY `uname` (`uname`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `name`, `uname`, `email`, `pwd`, `contact`, `usertype`) VALUES
(1, '', 'admin', NULL, 'Admin@123', NULL, 'adm'),
(2, 'Krishna', 'krish', 'krishna@gmail.com', 'Krsna@123', '9876543210', 'c'),
(3, 'Jake T', 'jake111', 'jake111@yahoo.com', 'Jake#111', '9988776655', 'a'),
(7, 'Indu', 'indu', 'indu@gmail.com', 'Indum!2003', '9112288765', 'a'),
(8, 'Neeraja', 'neeraja', 'nrj12@gmail.com', 'Nrj!123', '9182736450', 'c'),
(9, 'Ardra', 'ardrap', 'ardra@gmail.com', 'Ardra@2002', '9123456780', 'c'),
(10, 'Chris', 'chrisbang', 'chris@jyp.com', 'Chris123@', '8123456790', 'a'),
(15, 'Johnny', 'johnny', 'john@yahoo.in', 'John@123', '6789012345', 'c'),
(16, 'Vin Gogh', 'ving', 'Vin@rediffmail.com', 'Vin@1234', '8937126345', 'a'),
(17, 'anu', 'anu', 'anu@gmail.com', 'Anu@123456', '3456723890', 'c');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
