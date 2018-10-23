-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2018 at 07:38 PM
-- Server version: 10.1.35-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Learnify!`
--

-- --------------------------------------------------------

--
-- Table structure for table `Course`
--

CREATE TABLE `Course` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Course`
--

INSERT INTO `Course` (`id`, `name`) VALUES
(1, 'BSc (Hons) in Computing'),
(2, 'BA (Hons) in Accounting and Finance');

-- --------------------------------------------------------

--
-- Table structure for table `Lecture`
--

CREATE TABLE `Lecture` (
  `id` int(11) NOT NULL,
  `lectureTitle` varchar(250) NOT NULL,
  `lecturer` int(11) NOT NULL,
  `module` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `duration` varchar(8) NOT NULL,
  `path` varchar(500) NOT NULL,
  `moduleOrder` int(11) NOT NULL,
  `plays` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Lecture`
--

INSERT INTO `Lecture` (`id`, `lectureTitle`, `lecturer`, `module`, `course`, `duration`, `path`, `moduleOrder`, `plays`) VALUES
(1, 'Introduction to Team Project Module File', 1, 1, 1, '4:02', 'assets/audio/01 Badlands.m4a', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Lecturer`
--

CREATE TABLE `Lecturer` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Lecturer`
--

INSERT INTO `Lecturer` (`id`, `name`) VALUES
(1, 'Michael Armstrong'),
(2, 'Muhammad Iqbal'),
(3, 'Mark Ryder'),
(4, 'Enda Stafford'),
(5, 'Paul Hayes');

-- --------------------------------------------------------

--
-- Table structure for table `Module`
--

CREATE TABLE `Module` (
  `id` int(11) NOT NULL,
  `moduleTitle` varchar(250) NOT NULL,
  `lecturer` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `Module`
--

INSERT INTO `Module` (`id`, `moduleTitle`, `lecturer`, `course`, `artworkPath`) VALUES
(1, 'Team Project -Yr3', 1, 1, 'assets/images/artwork/KeepTheEveningsLong.jpeg'),
(2, 'Advanced Programming', 2, 1, 'assets/images/artwork/clearday.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `email` varchar(200) NOT NULL,
  `password` varchar(32) NOT NULL,
  `signUpDate` datetime NOT NULL,
  `profilePic` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `firstName`, `lastName`, `email`, `password`, `signUpDate`, `profilePic`) VALUES
(1, 'HarryKane', 'Harry', 'Kane', 'Harry@gmail.com', '2ac9cb7dc02b3c0083eb70898e549b63', '2018-10-09 00:00:00', 'assets/images/profile-pics/proPic.png'),
(2, 'DeleAlli', 'Dele', 'Alli', 'Dele@yahoo.co.uk', '5f4dcc3b5aa765d61d8327deb882cf99', '2018-10-09 00:00:00', 'assets/images/profile-pics/proPic.png'),
(4, 'LucasMoura', 'Lucas', 'Moura', 'Lucas@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-10-10 00:00:00', 'assets/images/profile-pics/proPic.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Course`
--
ALTER TABLE `Course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Lecture`
--
ALTER TABLE `Lecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Lecturer`
--
ALTER TABLE `Lecturer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Module`
--
ALTER TABLE `Module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Course`
--
ALTER TABLE `Course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `Lecture`
--
ALTER TABLE `Lecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Lecturer`
--
ALTER TABLE `Lecturer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `Module`
--
ALTER TABLE `Module`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
