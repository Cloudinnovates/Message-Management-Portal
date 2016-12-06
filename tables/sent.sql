-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2016 at 09:32 AM
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
-- Table structure for table `sent`
--

CREATE TABLE IF NOT EXISTS `sent` (
  `ID` varchar(100) NOT NULL,
  `Sub` varchar(100) NOT NULL,
  `Msg` varchar(100) NOT NULL,
  `Person` varchar(100) NOT NULL,
  `Date_Time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sent`
--

INSERT INTO `sent` (`ID`, `Sub`, `Msg`, `Person`, `Date_Time`) VALUES
('s@gmail.com', 'Important', 'hello', 'Choyo_VIT', '2016-01-04 00:27:37'),
('c@gmail.com', 'casual', 'how are u?', 'SumanVIT', '2016-01-07 14:11:00'),
('s@gmail.com', 'sda', 'sdaas', 'Choyo_VIT', '2016-06-03 23:48:45'),
('s@gmail.com', 'sda', 'adsad', 'Choyo_VIT', '2016-06-03 23:48:49'),
('s@gmail.com', 'sda', 'sadas', 'Choyo_VIT', '2016-06-03 23:48:50'),
('s@gmail.com', 'sda', 'sad', 'Choyo_VIT', '2016-06-03 23:48:51'),
('s@gmail.com', 'sda', 'das', 'Choyo_VIT', '2016-06-03 23:48:56'),
('s@gmail.com', 'sda', 'adsa', 'Choyo_VIT', '2016-06-03 23:48:58'),
('s@gmail.com', 'sda', 'asdas', 'Choyo_VIT', '2016-06-03 23:48:59'),
('s@gmail.com', 'sda', 'sadas', 'Choyo_VIT', '2016-06-03 23:49:01'),
('s@gmail.com', 'ddd', 'kya hal', 'Choyo_VIT', '2016-06-12 22:56:56');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
