-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: May 30, 2024 at 07:00 PM
-- Server version: 8.0.37
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nibm`
--

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `province_code` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `name`, `province_code`) VALUES
(1, 'Ampara', 'Eastern'),
(2, 'Anuradhapura', 'North Central'),
(3, 'Badulla', 'Uva'),
(4, 'Batticaloa', 'Eastern'),
(5, 'Colombo', 'Western'),
(6, 'Galle', 'Southern'),
(7, 'Gampaha', 'Western'),
(8, 'Hambantota', 'Southern'),
(9, 'Jaffna', 'Northern'),
(10, 'Kalutara', 'Western'),
(11, 'Kandy', 'Central'),
(12, 'Kegalle', 'Sabaragamuwa'),
(13, 'Kilinochchi', 'Northern'),
(14, 'Kurunegala', 'North Western'),
(15, 'Mannar', 'Northern'),
(16, 'Matale', 'Central'),
(17, 'Matara', 'Southern'),
(18, 'Moneragala', 'Uva'),
(19, 'Mullaitivu', 'Northern'),
(20, 'Nuwara Eliya', 'Central'),
(21, 'Polonnaruwa', 'North Central'),
(22, 'Puttalam', 'North Western'),
(23, 'Ratnapura', 'Sabaragamuwa'),
(24, 'Trincomalee', 'Eastern'),
(25, 'Vavuniya', 'Northern');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_course`
--

CREATE TABLE `tbl_course` (
  `cid` int NOT NULL,
  `code` varchar(250) DEFAULT NULL,
  `cfull` varchar(250) DEFAULT NULL,
  `created_date` varchar(50) DEFAULT NULL,
  `update_date` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`cid`, `code`, `cfull`, `created_date`, `update_date`) VALUES
(1, 'MCA', 'Master of Computer Applications', '2024-03-01', NULL),
(2, 'B.E.', 'Bachelor of Engineering', '2024-03-02', NULL),
(3, 'B.Sc.', 'Bachelor of Science', '2024-03-03', NULL),
(4, 'B.Com.', 'Bachelor of Commerce', '2024-03-04', NULL),
(5, 'MBA', 'Master of Business Administration', '2024-03-05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_login`
--

CREATE TABLE `tbl_login` (
  `id` int NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `fullname` varchar(150) NOT NULL,
  `loginid` varchar(10) NOT NULL,
  `password` text NOT NULL,
  `nic` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_login`
--

INSERT INTO `tbl_login` (`id`, `nickname`, `fullname`, `loginid`, `password`, `nic`) VALUES
(1, 'chalaka', 'chalaka hasantha', 'chalaka', 'pass123', '199512312322');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `subid` int NOT NULL,
  `code` varchar(50) DEFAULT NULL,
  `cfull` varchar(250) DEFAULT NULL,
  `sub1` varchar(250) DEFAULT NULL,
  `sub2` varchar(250) DEFAULT NULL,
  `sub3` varchar(250) DEFAULT NULL,
  `sub4` varchar(255) DEFAULT NULL,
  `created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`subid`, `code`, `cfull`, `sub1`, `sub2`, `sub3`, `sub4`, `created_date`, `update_date`) VALUES
(1, '2', 'Bachelor of Engineering', 'Computer Science', 'Electrical Engineering', 'Mechanical Engineering', 'Mathematics', '2024-03-01 09:00:00', NULL),
(2, '3', 'Bachelor of Science', 'Biology', 'Chemistry', 'Physics', 'Environmental Science', '2024-03-02 10:30:00', NULL),
(3, '4', 'Bachelor of Commerce', 'Accounting', 'Business Management', 'Marketing', 'Economics', '2024-03-03 11:45:00', NULL),
(4, '5', 'Master of Business Administration', 'Finance', 'Human Resource Management', 'Strategic Management', 'Operations Management', '2024-03-04 12:15:00', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_course`
--
ALTER TABLE `tbl_course`
  ADD PRIMARY KEY (`cid`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`subid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `subid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
