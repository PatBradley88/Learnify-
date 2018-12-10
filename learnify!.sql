-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2018 at 04:24 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `learnify!`
--

-- --------------------------------------------------------

--
-- Table structure for table `contentlistlectures`
--

CREATE TABLE `contentlistlectures` (
  `id` int(11) NOT NULL,
  `lectureid` int(11) NOT NULL,
  `contentlistid` int(11) NOT NULL,
  `contentlistOrder` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `contentlists`
--

CREATE TABLE `contentlists` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `owner` varchar(50) NOT NULL,
  `dateCreated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contentlists`
--

INSERT INTO `contentlists` (`id`, `name`, `owner`, `dateCreated`) VALUES
(1, 'Programming Mix', 'joseph-ryan', '2018-12-09 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `lecture` (
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
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `lectureTitle`, `lecturer`, `module`, `course`, `duration`, `path`, `moduleOrder`, `plays`) VALUES
(1, 'Introduction to Team Project Module File', 1, 1, 1, '4:02', 'assets/audio/01_Badlands.m4a', 1, 0),
(2, 'Programming2', 1, 1, 1, '4:18', 'assets/audio/Guizado_-_07_-_O_Marisco.mp3', 0, 0),
(3, 'Introduction to Databases1', 1, 1, 1, '4:02', 'assets/audio/Amarasiri_Peiris_-_08_-_Kath_Kawuruwath.mp3', 1, 0),
(4, 'Web Technologies', 1, 1, 1, '4:44', 'assets/audio/Bonde_Do_Role_-_01_-_Gasolina__Contamida.mp3', 1, 0),
(5, 'Advanced Databases1', 1, 1, 1, '2:04', 'assets/audio/Bonde_Do_Role_-_03_-_Solta_o_Franco.mp3', 1, 0),
(6, 'Enterprise and IT', 1, 1, 1, '2:16', 'assets/audio/Bonde_Do_Role_-_04_-_Bondalica.mp3', 1, 0),
(7, 'Programming1', 1, 1, 1, '8:13', 'assets/audio/Dee_Yan-Key_-_02_-_Winter_is_coming_Adagio_-_First_Snow.mp3', 1, 0),
(8, 'Artificial intelligence (AI)', 1, 1, 1, '4:19', 'assets/audio/L_Eles_-_03_-_Disseram_a_Ela.mp3', 1, 0),
(9, 'Operating Systems', 1, 1, 1, '3:52', 'assets/audio/L_Eles_-_03_-_Disseram_a_Ela.mp3', 1, 0),
(10, 'Computing Architecture', 1, 1, 1, '3:35', 'assets/audio/Sul_Rebel_-_02_-_Airuma.mp3', 1, 0),
(11, 'Advanced Computing', 1, 1, 1, '3:59', 'assets/audio/Sul_Rebel_-_03_-_Nem_Eu_Mesmo_Acreditei.mp3', 1, 0),
(12, 'Data Analytics', 1, 1, 1, '6:06', 'assets/audio/Terrero_De_Jesus_-_03_-_Yemanj.mp3', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `moduleTitle` varchar(250) NOT NULL,
  `lecturer` int(11) NOT NULL,
  `course` int(11) NOT NULL,
  `artworkPath` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(4, 'LucasMoura', 'Lucas', 'Moura', 'Lucas@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2018-10-10 00:00:00', 'assets/images/profile-pics/proPic.png'),
(5, 'x15011887', 'Tony', 'Ennis', 'X15011887@ncirl.ie', '42f749ade7f9e195bf475f37a44cafcb', '2018-11-13 00:00:00', 'assets/images/profile-pics/profile-pic.png'),
(6, 'apcSouza', 'Ana', 'Souza', 'Ana@ana.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2018-11-13 00:00:00', 'assets/images/profile-pics/profile-pic.png'),
(7, 'JosephRyan', 'Joseph', 'Ryan', 'Joseph.ryan246810@gmail.com', '5f4dcc3b5aa765d61d8327deb882cf99', '2018-11-22 00:00:00', 'assets/images/profile-pics/profile-pic.png'),
(8, 'joseph-ryan', 'Joseph', 'Ryan', 'X15037355@student.ncirl.ie', '5f4dcc3b5aa765d61d8327deb882cf99', '2018-11-22 00:00:00', 'assets/images/profile-pics/profile-pic.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contentlistlectures`
--
ALTER TABLE `contentlistlectures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contentlists`
--
ALTER TABLE `contentlists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecture`
--
ALTER TABLE `lecture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
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
-- AUTO_INCREMENT for table `contentlistlectures`
--
ALTER TABLE `contentlistlectures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contentlists`
--
ALTER TABLE `contentlists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `lecture`
--
ALTER TABLE `lecture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;