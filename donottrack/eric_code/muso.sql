-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 31, 2014 at 01:43 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `muso`
--
CREATE DATABASE IF NOT EXISTS `muso` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `muso`;

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `user_id` int(10) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `party_id` int(10) NOT NULL,
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`user_id`, `name`, `party_id`) VALUES
(3, 'Miles', 1),
(2, 'Ted', 231),
(1, 'bill', 1);

-- --------------------------------------------------------

--
-- Table structure for table `party`
--

CREATE TABLE IF NOT EXISTS `party` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `host_id` int(10) NOT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT '0',
  `start_time` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `end_time` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `max_guests` smallint(6) NOT NULL DEFAULT '50',
  `threshold` int(11) NOT NULL,
  `max_songs` smallint(6) NOT NULL DEFAULT '15',
  PRIMARY KEY (`id`),
  UNIQUE KEY `host_name` (`host_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=232 ;

--
-- Dumping data for table `party`
--

INSERT INTO `party` (`id`, `name`, `host_id`, `password`, `is_private`, `start_time`, `end_time`, `max_guests`, `threshold`, `max_songs`) VALUES
(231, 'PartyParty', 0, '', 0, '', '', 50, 5, 15);

-- --------------------------------------------------------

--
-- Table structure for table `playlist`
--

CREATE TABLE IF NOT EXISTS `playlist` (
  `song_id` int(10) NOT NULL,
  `party_id` int(10) NOT NULL,
  `location` int(12) unsigned NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `playlist`
--

INSERT INTO `playlist` (`song_id`, `party_id`, `location`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(4, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE IF NOT EXISTS `song` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `artist` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `album` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `track_id` varchar(128) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  `is_locked` tinyint(1) NOT NULL DEFAULT '0',
  `skips` int(11) NOT NULL DEFAULT '0',
  `party_id` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `playlist_id` (`party_id`),
  KEY `playlist_id_2` (`party_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=325 ;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `title`, `artist`, `album`, `track_id`, `votes`, `is_locked`, `skips`, `party_id`) VALUES
(321, '321', '231', '321', '321', 0, 0, 4, 1),
(322, 'Lee', 'Lee', 'Lee', '3216556', 0, 0, 0, 1),
(323, 'Brown', 'Brown', 'Brown', '32165564', 0, 0, 0, 1),
(324, 'Man', 'Man', 'Man', '8189165', 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vote`
--

CREATE TABLE IF NOT EXISTS `vote` (
  `guest_id` int(10) unsigned NOT NULL,
  `song_id` int(10) unsigned NOT NULL,
  `is_skip` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `vote`
--

INSERT INTO `vote` (`guest_id`, `song_id`, `is_skip`) VALUES
(1, 321, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
