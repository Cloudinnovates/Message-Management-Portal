-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2016 at 09:31 AM
-- Server version: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student`
--

-- --------------------------------------------------------

--
-- Table structure for table `inbox`
--

CREATE TABLE IF NOT EXISTS `inbox` (
  `ID` varchar(100) NOT NULL,
  `Sub` varchar(100) NOT NULL,
  `Msg` varchar(100) NOT NULL,
  `Person` varchar(100) NOT NULL,
  `Date_Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inbox`
--

INSERT INTO `inbox` (`ID`, `Sub`, `Msg`, `Person`, `Date_Time`) VALUES
('c@gmail.com', 'Important', 'hello', 'SumanVIT', '2016-01-04 00:27:37'),
('s@gmail.com', 'casual', 'how are u?', 'Choyo_VIT', '2016-01-07 14:11:00'),
('c@gmail.com', 'sda', 'sdaas', 'SumanVIT', '2016-06-03 23:48:45'),
('c@gmail.com', 'sda', 'adsad', 'SumanVIT', '2016-06-03 23:48:49'),
('c@gmail.com', 'sda', 'sadas', 'SumanVIT', '2016-06-03 23:48:50'),
('c@gmail.com', 'sda', 'sad', 'SumanVIT', '2016-06-03 23:48:51'),
('c@gmail.com', 'sda', 'das', 'SumanVIT', '2016-06-03 23:48:56'),
('c@gmail.com', 'sda', 'adsa', 'SumanVIT', '2016-06-03 23:48:58'),
('c@gmail.com', 'sda', 'asdas', 'SumanVIT', '2016-06-03 23:48:59'),
('c@gmail.com', 'sda', 'sadas', 'SumanVIT', '2016-06-03 23:49:01'),
('c@gmail.com', 'ddd', 'kya hal', 'SumanVIT', '2016-06-12 22:56:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
