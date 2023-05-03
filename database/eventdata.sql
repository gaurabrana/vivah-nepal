-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 27, 2022 at 08:23 PM
-- Server version: 5.7.33
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventdata`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `userName` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `createdDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `userName`, `password`, `mobile`, `email`, `createdDate`) VALUES
(1, 'Nitin Kumar', 'admin', 'admin', '8888888888', 'admin@gmail.com', '2022-07-25 16:43:31');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `bookingId` int(11) DEFAULT NULL,
  `eventId` int(11) DEFAULT NULL,
  `userId` int(11) DEFAULT NULL,
  `eventName` varchar(200) DEFAULT NULL,
  `numberOfGuest` int(11) DEFAULT NULL,
  `bookingFrom` date DEFAULT NULL,
  `bookingTo` date DEFAULT NULL,
  `place` varchar(200) DEFAULT NULL,
  `message` longtext,
  `bookingDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `remark` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `postDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `bookingId`, `eventId`, `userId`, `eventName`, `numberOfGuest`, `bookingFrom`, `bookingTo`, `place`, `message`, `bookingDate`, `remark`, `status`, `postDate`) VALUES
(4, 346932784, 2, 1, 'Birthday Party', 45, '2022-07-02', '2022-07-27', 'patna', 'test', '2022-07-26 17:49:04', 'done', 'Approved', '2022-07-27 20:21:48'),
(12, 521647743, 2, 1, 'Night Club', 76, '2022-07-02', '2022-07-17', 'delhi', 'test', '2022-07-27 12:19:23', 'done', 'Approved', '2022-07-27 20:21:40');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `id` int(11) NOT NULL,
  `fname` varchar(200) DEFAULT NULL,
  `lname` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `subject` mediumtext,
  `message` mediumtext,
  `isRead` int(5) DEFAULT NULL,
  `postDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`id`, `fname`, `lname`, `email`, `phone`, `subject`, `message`, `isRead`, `postDate`) VALUES
(2, 'sonal', 'kumar', 'sonal@gmail.com', '6665675456', 'test', 'test', 1, '2022-07-27 15:51:52'),
(3, 'sonu', 'kumar', 'sonu@gmail.com', '6665675456', 'hi', 'hi', 1, '2022-07-27 15:52:43'),
(4, 'kunal', 'singh', 'kunal@gmail.com', '555555555', 'hi', 'hi', 1, '2022-07-27 15:53:04'),
(5, 'abhi', 'kumar', 'abhi@gmail.com', '4444444444', 'test', 'test', 1, '2022-07-27 16:44:21'),
(6, 'abhishek', 'kumar', 'abhishek@gmail.com', '4444444444', 'hi', 'hi', 1, '2022-07-27 18:10:23');

-- --------------------------------------------------------

--
-- Table structure for table `dating`
--

CREATE TABLE `dating` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `dateFrom` date DEFAULT NULL,
  `dateTo` date DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dating`
--

INSERT INTO `dating` (`id`, `name`, `dateFrom`, `dateTo`, `creationDate`) VALUES
(1, 'jhkjhkjhkhk', NULL, NULL, '2022-07-26 16:16:57'),
(2, 'Nitin Kumar', NULL, NULL, '2022-07-26 16:17:26'),
(3, 'Nitin Kumar', '2022-07-01', '2022-07-19', '2022-07-26 16:19:05');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `eventName` varchar(200) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `eventName`, `creationDate`) VALUES
(24, 'Anniversary', '2022-07-25 16:32:50'),
(25, 'Birthday Party', '2022-07-25 16:32:58'),
(26, 'Charity', '2022-07-25 16:33:02'),
(27, 'Community', '2022-07-25 16:33:07'),
(28, 'Engagement', '2022-07-25 16:33:11'),
(29, 'Night Club', '2022-07-25 16:33:17'),
(30, 'Post Wedding', '2022-07-25 16:33:22'),
(31, 'Pre Engagement', '2022-07-25 16:33:26'),
(32, 'Wedding', '2022-07-25 16:33:31');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` int(11) NOT NULL,
  `serviceName` varchar(200) DEFAULT NULL,
  `servicePrice` int(11) DEFAULT NULL,
  `servicDescription` longtext,
  `createdDate` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `serviceName`, `servicePrice`, `servicDescription`, `createdDate`) VALUES
(2, 'Party DJ', 700, 'Party DJ', '2022-07-25 21:24:23'),
(3, 'Karaoke Add-on', 67, 'Karaoke Add-on', '2022-07-25 21:35:38'),
(5, 'Ceremony Music', 400, 'Best Ceremony Music', '2022-07-27 23:13:57');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `address` longtext,
  `createdDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `mobile`, `age`, `gender`, `email`, `password`, `address`, `createdDate`) VALUES
(1, 'kunal', '8877654667', 60, 'Male', 'nitin@gmail.com', '111', 'patna', '2022-07-25 17:34:54'),
(2, 'abhi', '5678987654', 40, 'Male', 'sonu@gmail.com', '111', 'bihar', '2022-07-25 17:39:28'),
(3, 'Neha', '4444444444', 34, 'Female', 'neha@gmail.com', '11111', 'patna', '2022-07-27 18:24:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dating`
--
ALTER TABLE `dating`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
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
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `dating`
--
ALTER TABLE `dating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
