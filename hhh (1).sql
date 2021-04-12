-- phpMyAdmin SQL Dump
-- version 4.9.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 16, 2021 at 09:30 AM
-- Server version: 5.6.49-cll-lve
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hhh`
--

-- --------------------------------------------------------

--
-- Table structure for table `access`
--

CREATE TABLE `access` (
  `Permission` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `id` int(11) NOT NULL,
  `Counter_Part` varchar(30) NOT NULL,
  `Date` date NOT NULL,
  `To_Name` text NOT NULL,
  `Speedway_Name` text NOT NULL,
  `Payment` float NOT NULL,
  `Remark` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `addtransport`
--

CREATE TABLE `addtransport` (
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bill`
--

CREATE TABLE `bill` (
  `no` int(11) NOT NULL,
  `date` date NOT NULL,
  `destination` varchar(30) NOT NULL,
  `weight` int(11) NOT NULL,
  `to_name` text NOT NULL,
  `unit_price` int(11) NOT NULL,
  `other_charge` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `counter_part`
--

CREATE TABLE `counter_part` (
  `Counter_Part` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE `expenses` (
  `id` int(11) NOT NULL,
  `Date` date NOT NULL,
  `RS` float NOT NULL,
  `Note` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `extra_box`
--

CREATE TABLE `extra_box` (
  `Speedway_No` int(11) NOT NULL,
  `Tracking_Number` varchar(100) NOT NULL,
  `link` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `fuel`
--

CREATE TABLE `fuel` (
  `month` text NOT NULL,
  `fedex` float NOT NULL,
  `ups` float NOT NULL,
  `dhl` float NOT NULL,
  `tnt` float NOT NULL,
  `sky` float NOT NULL,
  `airwings` float NOT NULL,
  `aramex` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `graph`
--

CREATE TABLE `graph` (
  `Month` varchar(20) NOT NULL,
  `Profit` float NOT NULL,
  `Courier` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `speedway`
--

CREATE TABLE `speedway` (
  `id` int(11) NOT NULL,
  `Speedway_No` int(20) NOT NULL,
  `Date` date NOT NULL,
  `Origin` varchar(10) NOT NULL,
  `Country` varchar(20) NOT NULL,
  `Destination` text NOT NULL,
  `From_Name` varchar(100) NOT NULL,
  `From_Address` text NOT NULL,
  `From_Address2` text NOT NULL,
  `From_Number` text,
  `To_Name` varchar(100) NOT NULL,
  `To_Address` text NOT NULL,
  `To_Address2` text NOT NULL,
  `To_Address3` text NOT NULL,
  `To_Address4` text NOT NULL,
  `To_Number` text,
  `To_Number2` text,
  `Service` varchar(20) NOT NULL,
  `Counter_Part` text NOT NULL,
  `Weight` decimal(5,2) NOT NULL,
  `CPK` float NOT NULL,
  `OC` float NOT NULL,
  `Customer_Fee` float NOT NULL,
  `Service_Fee` float NOT NULL,
  `PR` float NOT NULL,
  `Tracking_Number` varchar(300) NOT NULL,
  `Tracking_Website` varchar(100) NOT NULL,
  `Link` text NOT NULL,
  `Status` varchar(20) NOT NULL,
  `Payment` varchar(100) NOT NULL DEFAULT 'NOT DONE',
  `Remarks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `Role` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD KEY `index` (`id`);

--
-- Indexes for table `bill`
--
ALTER TABLE `bill`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `expenses`
--
ALTER TABLE `expenses`
  ADD KEY `index` (`id`);

--
-- Indexes for table `speedway`
--
ALTER TABLE `speedway`
  ADD PRIMARY KEY (`Speedway_No`),
  ADD KEY `index` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `expenses`
--
ALTER TABLE `expenses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `speedway`
--
ALTER TABLE `speedway`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
