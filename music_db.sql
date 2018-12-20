-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 28, 2018 at 08:50 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `7learn_music`
--

-- --------------------------------------------------------

--
-- Table structure for table `downloads`
--

DROP TABLE IF EXISTS `downloads`;
CREATE TABLE IF NOT EXISTS `downloads` (
  `id` bigint(255) NOT NULL AUTO_INCREMENT,
  `user_id` int(20) NOT NULL,
  `music_id` bigint(127) NOT NULL,
  `file_id` varchar(512) DEFAULT NULL,
  `performer` varchar(512) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` varchar(512) CHARACTER SET utf8mb4 DEFAULT NULL,
  `duration` varchar(127) DEFAULT NULL,
  `file_size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `music`
--

DROP TABLE IF EXISTS `music`;
CREATE TABLE IF NOT EXISTS `music` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `file_id` varchar(512) DEFAULT NULL,
  `performer` varchar(512) CHARACTER SET utf8mb4 DEFAULT NULL,
  `title` varchar(512) CHARACTER SET utf8mb4 DEFAULT NULL,
  `duration` int(127) DEFAULT NULL,
  `file_size` int(127) DEFAULT NULL,
  `mime_type` varchar(31) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file_id` (`file_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` int(63) NOT NULL,
  `first_name` varchar(1023) CHARACTER SET utf8mb4 NOT NULL,
  `last_name` varchar(1023) CHARACTER SET utf8mb4 DEFAULT NULL,
  `username` varchar(1023) DEFAULT NULL,
  `step` varchar(16) DEFAULT NULL,
  `invite` int(127) NOT NULL DEFAULT '0',
  `is_invited` int(1) NOT NULL DEFAULT '0',
  `sent_music` int(127) NOT NULL DEFAULT '0',
  `downloaded_music` int(127) NOT NULL DEFAULT '0',
  `last_search` varchar(512) CHARACTER SET utf8mb4 DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
