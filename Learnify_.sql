-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 13, 2018 at 01:40 PM
-- Server version: 5.5.38-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `Learnify!`
--

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`) VALUES
(1, 'BSc (Hons) in Computing'),
(2, 'BA (Hons) in Accounting and Finance');

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE IF NOT EXISTS `lecture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lectureTitle` varchar(250) NOT NULL,
  `lecturer` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `moduleOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `lectureTitle`, `lecturer`, `module`, `course`, `duration`, `path`, `moduleOrder`, `plays`) VALUES
(1, 'Introduction to Team Project Module File', 1, 1, 1, '4:02', 'assets/audio/01 Badlands.m4a', 1, 0),
(2, 'test', 0, 1, 0, '5', 'test-7', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE IF NOT EXISTS `lecturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `name`) VALUES
(1, 'Michael Armstrong'),
(2, 'Muhammad Iqbal'),
(3, 'Mark Ryder'),
(4, 'Enda Stafford'),
(5, 'Paul Hayes');

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE IF NOT EXISTS `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `moduleTitle` varchar(250) NOT NULL,
  `lecturer` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `moduleTitle`, `lecturer`, `course`, `artworkPath`) VALUES
(1, 'Team Project -Yr3', 1, 1, 'assets/images/artwork/KeepTheEveningsLong.jpeg'),
(2, 'Advanced Programming', 2, 1, './assets/images/artwork/clearday.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(1, 'HarryKane', 'Harry', 'Kane', 'Harry@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63', '2018-10-09 00:00:00', 'assets/images/profile-pics/proPic.png'),
(2, 'DeleAlli', 'Dele', 'Alli', 'Dele@yahoo.co.uk', '5f4dcc3b5aa765d61d8327deb882cf99', '2018-10-09 00:00:00', 'assets/images/profile-pics/proPic.png'),
(4, 'LucasMoura', 'Lucas', 'Moura', 'Lucas@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-10-10 00:00:00', 'assets/images/profile-pics/proPic.png'),
(5, 'x15011887', 'Tony', 'Ennis', 'X15011887@ncirl.ie', '42f749ade7f9e195bf475f37a44cafcb', '2018-11-13 00:00:00', 'assets/images/profile-pics/profile-pic.png');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
