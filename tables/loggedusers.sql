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
-- Table structure for table `loggedusers`
--

CREATE TABLE IF NOT EXISTS `loggedusers` (
  `ID` varchar(100) NOT NULL,
  `Pass` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loggedusers`
--

INSERT INTO `loggedusers` (`ID`, `Pass`, `name`) VALUES
('s@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'SumanVIT'),
('c@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Choyo_VIT'),
('a@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Amit'),
('f@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Farhan'),
('h@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Hari'),
('f1@gmail.com', 'd8578edf8458ce06fbc5bb76a58c5ca4', 'Fatima');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
