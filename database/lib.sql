-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 30, 2022 at 12:21 AM
-- Server version: 5.7.38-0ubuntu0.18.04.1
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `lib`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `AdminEmail` varchar(120) DEFAULT NULL,
  `UserName` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  `updationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `FullName`, `AdminEmail`, `UserName`, `Password`, `updationDate`) VALUES
(1, 'John Doe', 'johndow@gmail.com', 'admin', '81dc9bdb52d04dc20036dbd8313ed055', '2022-05-29 17:41:59');

-- --------------------------------------------------------

--
-- Table structure for table `overdue`
--

CREATE TABLE `overdue` (
  `StudentID` varchar(11) NOT NULL,
  `StudentName` varchar(40) NOT NULL,
  `MobNumber` varchar(11) NOT NULL,
  `Fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `overdue`
--

INSERT INTO `overdue` (`StudentID`, `StudentName`, `MobNumber`, `Fine`) VALUES
('SID009', 'Test user3', '1234567890', 868518);

-- --------------------------------------------------------

--
-- Table structure for table `tblauthors`
--

CREATE TABLE `tblauthors` (
  `id` int(11) NOT NULL,
  `AuthorName` varchar(159) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblauthors`
--

INSERT INTO `tblauthors` (`id`, `AuthorName`, `creationDate`, `UpdationDate`) VALUES
(2, 'cher loid', '2017-07-08 14:30:23', '2022-05-29 17:42:12'),
(3, 'Adam Copeland', '2017-07-08 14:35:08', '2022-05-29 03:15:54'),
(4, 'john dow', '2017-07-08 14:35:21', '2022-05-29 03:15:46'),
(5, 'Nesciunt vero ut do', '2022-05-29 12:27:51', '2022-05-29 12:33:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooks`
--

CREATE TABLE `tblbooks` (
  `id` int(11) NOT NULL,
  `BookName` varchar(255) DEFAULT NULL,
  `Copies` int(3) NOT NULL,
  `IssuedCopies` int(3) NOT NULL,
  `CatId` int(11) DEFAULT NULL,
  `AuthorId` int(11) DEFAULT NULL,
  `ISBNNumber` int(11) DEFAULT NULL,
  `BookPrice` int(11) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblbooks`
--

INSERT INTO `tblbooks` (`id`, `BookName`, `Copies`, `IssuedCopies`, `CatId`, `AuthorId`, `ISBNNumber`, `BookPrice`, `RegDate`, `UpdationDate`) VALUES
(3, 'Chemistry', 10, 9, 6, 4, 1111, 15, '2017-07-08 20:17:31', '2022-05-29 14:54:34'),
(4, 'physics', 5, 4, 4, 5, 20, 100, '2018-06-06 22:52:21', '2022-05-29 15:03:30'),
(5, 'C Programming', 3, 1, 5, 3, 111, 200, '2018-06-11 17:48:02', '2018-07-20 09:37:04'),
(6, 'Maths', 3, 0, 4, 2, 456, 500, '2018-06-11 17:49:10', '2018-06-13 21:35:31'),
(7, 'Winter Daniel', 123, 0, 7, 5, 123, 666, '2022-05-29 12:42:45', NULL),
(8, 'Gage Burton', 123, 0, 9, 5, 12333, 371, '2022-05-29 12:43:07', NULL),
(9, 'Ezekiel Pearson', 99, 0, 6, 5, 78, 112, '2022-05-29 12:43:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `id` int(11) NOT NULL,
  `CategoryName` varchar(150) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`id`, `CategoryName`, `Status`, `CreationDate`, `UpdationDate`) VALUES
(4, 'Knowledge1', 1, '2017-07-04 18:35:25', '2022-05-29 12:19:53'),
(5, 'Technology', 1, '2017-07-04 18:35:39', '2017-07-08 17:13:03'),
(6, 'Science', 1, '2017-07-04 18:35:55', '0000-00-00 00:00:00'),
(7, 'Management', 1, '2017-07-04 18:36:16', '2018-06-06 18:46:41'),
(8, 'physics', 1, '2018-06-11 17:31:43', '2018-06-11 17:36:56'),
(9, 'history', 1, '2018-06-11 18:24:53', '2018-06-13 00:29:15'),
(14, 'LifeStyle', 1, '2018-07-13 05:17:16', '0000-00-00 00:00:00'),
(15, 'sdafsadf', 1, '2022-05-27 15:34:47', '0000-00-00 00:00:00'),
(16, 'Aut deleniti culpa i', 1, '2022-05-29 12:26:47', '0000-00-00 00:00:00'),
(17, 'Veniam ea voluptate', 0, '2022-05-29 12:27:06', '0000-00-00 00:00:00'),
(18, 'Quaerat enim minus i', 1, '2022-05-29 12:27:14', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tblfine`
--

CREATE TABLE `tblfine` (
  `fine` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblfine`
--

INSERT INTO `tblfine` (`fine`) VALUES
(122);

-- --------------------------------------------------------

--
-- Table structure for table `tblissuedbookdetails`
--

CREATE TABLE `tblissuedbookdetails` (
  `id` int(11) NOT NULL,
  `BookId` int(11) DEFAULT NULL,
  `StudentID` varchar(150) DEFAULT NULL,
  `IssuesDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ReturnDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `ReturnStatus` int(1) NOT NULL,
  `fine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblissuedbookdetails`
--

INSERT INTO `tblissuedbookdetails` (`id`, `BookId`, `StudentID`, `IssuesDate`, `ReturnDate`, `ReturnStatus`, `fine`) VALUES
(6, 4, 'SID009', '2018-06-12 20:52:10', '2018-06-13 20:44:28', 1, 20),
(7, 5, 'SID009', '2018-06-12 20:55:24', '2018-06-12 23:46:08', 1, 200),
(8, 3, 'SID009', '2018-06-12 23:27:23', NULL, 0, NULL),
(9, 5, 'SID009', '2018-06-13 21:24:38', NULL, 0, NULL),
(10, 5, 'SID009', '2018-06-13 21:44:50', NULL, 0, NULL),
(11, 10, 'SID002', '2018-07-11 18:30:00', '2018-07-18 07:47:46', 1, 10),
(12, 10, 'SID005', '2018-07-18 07:59:30', '2018-07-18 07:59:41', 1, NULL),
(13, 5, 'SID005', '2018-07-18 08:00:25', '2018-07-18 08:00:41', 1, NULL),
(14, 5, 'SID009', '2018-07-20 09:37:03', NULL, 0, NULL),
(15, 5, 'SID009', '2018-07-20 09:40:40', NULL, 0, NULL),
(16, 3, 'SID002', '2022-05-29 12:51:26', NULL, 0, NULL),
(17, 3, 'SID002', '2022-05-29 12:51:35', NULL, 0, NULL),
(18, 3, 'SID002', '2022-05-29 12:52:14', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblrequestedbookdetails`
--

CREATE TABLE `tblrequestedbookdetails` (
  `StudentID` varchar(20) NOT NULL,
  `StudName` varchar(40) NOT NULL,
  `BookName` varchar(50) NOT NULL,
  `CategoryName` varchar(20) NOT NULL,
  `AuthorName` varchar(50) NOT NULL,
  `ISBNNumber` int(11) NOT NULL,
  `BookPrice` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblrequestedbookdetails`
--

INSERT INTO `tblrequestedbookdetails` (`StudentID`, `StudName`, `BookName`, `CategoryName`, `AuthorName`, `ISBNNumber`, `BookPrice`) VALUES
('1', 'drew mcntyre', 'Chemistry', 'Science', 'john dow', 1111, 15);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudents`
--

CREATE TABLE `tblstudents` (
  `id` int(11) NOT NULL,
  `StudentId` varchar(100) DEFAULT NULL,
  `FullName` varchar(120) DEFAULT NULL,
  `EmailId` varchar(120) DEFAULT NULL,
  `MobileNumber` char(11) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `Status` int(1) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudents`
--

INSERT INTO `tblstudents` (`id`, `StudentId`, `FullName`, `EmailId`, `MobileNumber`, `Password`, `Status`, `RegDate`, `UpdationDate`) VALUES
(1, 'SID002', 'Test user1', 'testuser1@gmail.com', '1234567890', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2017-07-11 15:37:05', '2022-05-29 17:45:01'),
(4, 'SID005', 'Test user2', 'testuser2@gmail.com', '1234567890', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2017-07-11 15:41:27', '2022-05-29 17:45:04'),
(8, 'SID009', 'Test user3', 'testuser3@gmail.com', '1234567890', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2017-07-11 15:58:28', '2022-05-29 17:45:06'),
(9, 'SID010', 'Test user4', 'testuser4@gmail.com', '1234567890', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2017-07-15 13:40:30', '2022-05-29 17:45:08'),
(10, 'SID011', 'Test user5', 'testuser5@gmail.com', '1234567890', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2017-07-15 18:00:59', '2022-05-29 17:45:09'),
(11, 'SID012', 'Test user6', 'testuser6@gmail.com', '1234567890', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2018-06-11 17:55:21', '2022-05-29 17:45:11'),
(12, 'SID013', 'Test user7', 'testuser7@gmail.com', '1234567890', '81dc9bdb52d04dc20036dbd8313ed055', 1, '2022-05-27 03:19:59', '2022-05-29 17:45:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblauthors`
--
ALTER TABLE `tblauthors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblbooks`
--
ALTER TABLE `tblbooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tblstudents`
--
ALTER TABLE `tblstudents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `StudentId` (`StudentId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `tblauthors`
--
ALTER TABLE `tblauthors`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tblbooks`
--
ALTER TABLE `tblbooks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `tblissuedbookdetails`
--
ALTER TABLE `tblissuedbookdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `tblstudents`
--
ALTER TABLE `tblstudents`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
