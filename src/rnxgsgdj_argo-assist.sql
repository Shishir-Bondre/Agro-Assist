-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 27, 2017 at 04:31 PM
-- Server version: 5.5.54-38.7-log
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `rnxgsgdj_argo-assist`
--

-- --------------------------------------------------------

--
-- Table structure for table `dht22`
--

CREATE TABLE IF NOT EXISTS `dht22` (
  `srno` int(100) NOT NULL AUTO_INCREMENT,
  `date` varchar(10000) NOT NULL,
  `time` varchar(10000) NOT NULL,
  `humidity` varchar(1000) NOT NULL,
  `temperature` varchar(1000) NOT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `dht22`
--

INSERT INTO `dht22` (`srno`, `date`, `time`, `humidity`, `temperature`) VALUES
(22, '25/03/2017', '11:38:47 AM', '49.3', '27.9'),
(20, '23/03/2017', '08:51:21 AM', '44.2', '9.9'),
(19, '23/03/2017', '08:50:19 AM', '43.9', '29.9'),
(18, '20/03/2017', '03:11:33 PM', '85.7', '58.8'),
(13, '19/03/2017', '05:30:20 AM', '56', '27'),
(14, '19/03/2017', '12:31:43 PM', '56', '27'),
(15, '19/03/2017', '11:02:31 AM', '56', '27'),
(16, '20/03/2017', '02:05:56 PM', '35.4', '32.5'),
(17, '20/03/2017', '02:07:45 PM', '34.7', '32.5');

-- --------------------------------------------------------

--
-- Table structure for table `hygrometer`
--

CREATE TABLE IF NOT EXISTS `hygrometer` (
  `srno` int(100) NOT NULL AUTO_INCREMENT,
  `date` varchar(500) NOT NULL,
  `time` varchar(500) NOT NULL,
  `moisture` varchar(500) NOT NULL DEFAULT '13',
  PRIMARY KEY (`srno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `hygrometer`
--

INSERT INTO `hygrometer` (`srno`, `date`, `time`, `moisture`) VALUES
(8, '23/03/2017', '08:50:03 AM', '31'),
(2, '19/03/2017', '12:33:31 PM', '33'),
(3, '19/03/2017', '12:35:11 PM', '358'),
(4, '19/03/2017', '12:35:43 PM', '122'),
(5, '19/03/2017', '12:37:08 PM', '1023'),
(6, '20/03/2017', '02:01:41 PM', '72'),
(7, '20/03/2017', '03:12:42 PM', '81'),
(9, '23/03/2017', '08:51:13 AM', '10'),
(13, '25/03/2017', '11:42:13 AM', '43');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE IF NOT EXISTS `login` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `username`, `password`, `role`, `status`) VALUES
(1, 'admin123', '0192023a7bbd73250516f069df18b500', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `plant_disease`
--

CREATE TABLE IF NOT EXISTS `plant_disease` (
  `srno` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(1000) NOT NULL,
  `time` varchar(1000) NOT NULL,
  `disease` varchar(10) NOT NULL,
  `fertilizer` varchar(10) NOT NULL,
  `ph_level` varchar(10) NOT NULL,
  `fertilizer_soil` varchar(10) NOT NULL,
  PRIMARY KEY (`srno`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `plant_disease`
--

INSERT INTO `plant_disease` (`srno`, `date`, `time`, `disease`, `fertilizer`, `ph_level`, `fertilizer_soil`) VALUES
(1, '20/03/2017', '02:07:45 PM', '', '', '', ''),
(2, '19/03/2017', '11:02:31 AM', '', '', '', ''),
(3, '23/03/2017', '08:50:19 AM', '', '', '', ''),
(4, '25/03/2017', '11:38:47 AM', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `plant_photos`
--

CREATE TABLE IF NOT EXISTS `plant_photos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo_name` varchar(300) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `plant_photos`
--

INSERT INTO `plant_photos` (`id`, `photo_name`) VALUES
(10, '1490426248_test3.jpg'),
(6, '1490421730_2.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
