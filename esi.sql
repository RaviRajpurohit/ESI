-- phpMyAdmin SQL Dump
-- version 4.1.4
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2017 at 05:45 PM
-- Server version: 5.6.15-log
-- PHP Version: 5.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `esi`
--

-- --------------------------------------------------------

--
-- Table structure for table `issued_detail`
--
CREATE DATABASE `ESI`;
USE `ESI`;

CREATE TABLE IF NOT EXISTS `issued_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `issue_voucher_no` varchar(50) NOT NULL,
  `toWhomIssued` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `batchNo` varchar(50) NOT NULL,
  `mfgDate` date NOT NULL,
  `expDate` date NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Table structure for table `issuer_receiver`
--

CREATE TABLE IF NOT EXISTS `issuer_receiver` (
  `name` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `issuer_receiver`
--

INSERT INTO `issuer_receiver` (`name`) VALUES
('Main Store'),
(''),
('Dispensary OPD'),
('Dressing OPD'),
('Injection OPD');

-- --------------------------------------------------------

--
-- Table structure for table `product_details`
--

CREATE TABLE IF NOT EXISTS `product_details` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `batchNo` varchar(50) NOT NULL,
  `mfgDate` date NOT NULL,
  `expDate` date NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

-- --------------------------------------------------------

--
-- Table structure for table `recived_detail`
--

CREATE TABLE IF NOT EXISTS `recived_detail` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `recived_voucher_no` varchar(50) NOT NULL,
  `fromWhomRecived` varchar(50) NOT NULL,
  `quantity` int(11) NOT NULL,
  `batchNo` varchar(50) NOT NULL,
  `mfgDate` date NOT NULL,
  `expDate` date NOT NULL,
  `rate` float NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `department` varchar(50) NOT NULL,
  `contactPerson` varchar(50) NOT NULL,
  `mobileNo` int(11) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`username`, `password`, `department`, `contactPerson`, `mobileNo`) VALUES
('other', '795f3202b17cb6bc3d4b771d8c6c9eaf', 'other', 'Mr.', 0),
('injection', '2c5b9c6195d4bc2fc0ace4b41b1745d5', 'Injection OPD', 'Mr.', 0),
('dispensary', 'c4bb33f3bf4de46e6f942ce06c3f7bc7', 'Dispensary OPD ', 'Mr.', 0),
('dressing', 'cebaea92f732a6a8392f329925d3fccf', 'Dressing OPD ', 'Mr.', 0),
('main', 'fad58de7366495db4650cfefac2fcd61', 'Main Store', 'Dr. J.P. Purohit', 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
