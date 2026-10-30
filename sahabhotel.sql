-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 28, 2025 at 04:34 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sahabhotel`
--
CREATE DATABASE IF NOT EXISTS `sahabhotel` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `sahabhotel`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phoneno` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `email`, `phoneno`) VALUES
('admin', 'admin123', 'admin@gmail.com', '7450068107'),
('admin', 'admin123', 'admin@gmail.com', '7450068107');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `name` varchar(200) DEFAULT NULL,
  `phoneno` varchar(20) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `checkin` varchar(50) DEFAULT NULL,
  `checkin_time` varchar(50) DEFAULT NULL,
  `checkout` varchar(50) DEFAULT NULL,
  `checkout_time` varchar(50) DEFAULT NULL,
  `roomtype` varchar(100) DEFAULT NULL,
  `noofroom` varchar(50) DEFAULT NULL,
  `totalprice` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`name`, `phoneno`, `email`, `checkin`, `checkin_time`, `checkout`, `checkout_time`, `roomtype`, `noofroom`, `totalprice`) VALUES
('rohandas', '4444444444', 'rohan@r.com', '2025-11-28', '22:28', '2025-11-29', '10:29', 'AC', '1', '2000'),
('sksahab', '3333333333', 'sahabmb18@gmail.com', '2025-11-13', '21:36', '2025-11-28', '09:40', 'Non AC', '1', '1500');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`name`, `username`, `password`, `phone`, `email`) VALUES
('Sk Sahab', 'sksahab', '12345', '3333333333', 'sahabmb18@gmail.com'),
('Rohan Das', 'rohandas', '12345', '4444444444', 'rohan@r.com'),
('sksakilali', 'sksakir', '12345', '1111111111', 'sakir@gmail.com'),
('Rohit saha', 'rohitsaha', '12345', '1234567890', 'ro@gmail.vom');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
