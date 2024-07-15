-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Jul 15, 2024 at 06:05 PM
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
-- Table structure for table `tbl_city`
--

CREATE TABLE `tbl_city` (
  `id` int NOT NULL,
  `name` varchar(30) NOT NULL,
  `province_code` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_city`
--

INSERT INTO `tbl_city` (`id`, `name`, `province_code`) VALUES
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
  `code` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cfull` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `created_date` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
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
(5, 'MBA', 'Master of Business Administration', '2024-03-05', NULL),
(6, 'BBA', 'Bachelor of Business Administration', '2024-03-06', NULL),
(7, 'M.Sc.', 'Master of Science', '2024-03-07', NULL),
(8, 'B.A.', 'Bachelor of Arts', '2024-03-08', NULL),
(9, 'M.E.', 'Master of Engineering', '2024-03-09', NULL),
(10, 'Ph.D.', 'Doctor of Philosophy', '2024-03-10', NULL),
(11, 'LLB', 'Bachelor of Laws', '2024-03-11', NULL),
(12, 'LLM', 'Master of Laws', '2024-03-12', NULL),
(13, 'B.Tech.', 'Bachelor of Technology', '2024-03-13', NULL),
(14, 'M.Tech.', 'Master of Technology', '2024-03-14', NULL),
(15, 'B.Arch.', 'Bachelor of Architecture', '2024-03-15', NULL),
(16, 'M.Arch.', 'Master of Architecture', '2024-03-16', NULL),
(17, 'B.Ed.', 'Bachelor of Education', '2024-03-17', NULL),
(18, 'M.Ed.', 'Master of Education', '2024-03-18', NULL),
(19, 'B.Pharm.', 'Bachelor of Pharmacy', '2024-03-19', NULL),
(20, 'M.Pharm.', 'Master of Pharmacy', '2024-03-20', NULL);

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
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `std_id` int NOT NULL,
  `std_name` varchar(250) DEFAULT NULL,
  `course_code` varchar(250) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `birthofdate` date DEFAULT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `parent_number` varchar(15) DEFAULT NULL,
  `registered_date` date DEFAULT NULL,
  `city_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`std_id`, `std_name`, `course_code`, `gender`, `address`, `birthofdate`, `mobile_number`, `parent_number`, `registered_date`, `city_id`) VALUES
(1, 'Nimal Perera', 'MCA', 'Male', '123 Galle Road, Colombo', '2000-01-01', '0712345678', '0778765432', '2024-03-01', 5),
(2, 'Kamal Fernando', 'B.E.', 'Male', '456 Kandy Road, Kandy', '1999-02-15', '0712345679', '0778765433', '2024-03-02', 11),
(3, 'Sunil Silva', 'B.Sc.', 'Male', '789 Matara Road, Galle', '2001-03-20', '0712345680', '0778765434', '2024-03-03', 6),
(4, 'Amara Jayawardena', 'B.Com.', 'Female', '101 Kurunegala Road, Kurunegala', '2002-04-25', '0712345681', '0778765435', '2024-03-04', 14),
(5, 'Kusum Wijesinghe', 'MBA', 'Female', '202 Nuwara Eliya Road, Nuwara Eliya', '2000-05-30', '0712345682', '0778765436', '2024-03-05', 20),
(6, 'Tharanga Rajapaksha', 'MCA', 'Male', '303 Badulla Road, Badulla', '1999-06-05', '0712345683', '0778765437', '2024-03-06', 3),
(7, 'Anura Ekanayake', 'B.E.', 'Male', '404 Anuradhapura Road, Anuradhapura', '2001-07-10', '0712345684', '0778765438', '2024-03-07', 2),
(8, 'Samanthi Kumari', 'B.Sc.', 'Female', '505 Batticaloa Road, Batticaloa', '2002-08-15', '0712345685', '0778765439', '2024-03-08', 4),
(9, 'Nuwan Jayasuriya', 'B.Com.', 'Male', '606 Jaffna Road, Jaffna', '2003-09-20', '0712345686', '0778765440', '2024-03-09', 9),
(10, 'Sanduni Fernando', 'MBA', 'Female', '707 Hambantota Road, Hambantota', '2004-10-25', '0712345687', '0778765441', '2024-03-10', 8),
(11, 'Lakshan Perera', 'MCA', 'Male', '808 Kalutara Road, Kalutara', '2000-11-30', '0712345688', '0778765442', '2024-03-11', 10),
(12, 'Chamari de Silva', 'B.E.', 'Female', '909 Kegalle Road, Kegalle', '2001-12-05', '0712345689', '0778765443', '2024-03-12', 12),
(13, 'Dilshan Gamage', 'B.Sc.', 'Male', '1010 Kilinochchi Road, Kilinochchi', '2002-01-10', '0712345690', '0778765444', '2024-03-13', 13),
(14, 'Harsha Fonseka', 'B.Com.', 'Male', '1111 Mannar Road, Mannar', '2003-02-15', '0712345691', '0778765445', '2024-03-14', 15),
(15, 'Madhavi Gunawardena', 'MBA', 'Female', '1212 Matale Road, Matale', '2004-03-20', '0712345692', '0778765446', '2024-03-15', 16),
(16, 'Suresh Raj', 'MCA', 'Male', '1313 Matara Road, Matara', '2000-04-25', '0712345693', '0778765447', '2024-03-16', 17),
(17, 'Nirosha Karunaratne', 'B.E.', 'Female', '1414 Moneragala Road, Moneragala', '2001-05-30', '0712345694', '0778765448', '2024-03-17', 18),
(18, 'Chamika Bandara', 'B.Sc.', 'Male', '1515 Mullaitivu Road, Mullaitivu', '2002-06-05', '0712345695', '0778765449', '2024-03-18', 19),
(19, 'Dilanka Wickramasinghe', 'B.Com.', 'Male', '1616 Polonnaruwa Road, Polonnaruwa', '2003-07-10', '0712345696', '0778765450', '2024-03-19', 21),
(20, 'Udara Alwis', 'MBA', 'Male', '1717 Puttalam Road, Puttalam', '2004-08-15', '0712345697', '0778765451', '2024-03-20', 22),
(21, 'Kasun Liyanage', 'MCA', 'Male', '1818 Ratnapura Road, Ratnapura', '2000-09-20', '0712345698', '0778765452', '2024-03-21', 23),
(22, 'Hansika Perera', 'B.E.', 'Female', '1919 Trincomalee Road, Trincomalee', '2001-10-25', '0712345699', '0778765453', '2024-03-22', 24),
(23, 'Chathura de Silva', 'B.Sc.', 'Male', '2020 Vavuniya Road, Vavuniya', '2002-11-30', '0712345700', '0778765454', '2024-03-23', 25),
(24, 'Sajith Weerasinghe', 'B.Com.', 'Male', '2121 Ampara Road, Ampara', '2003-12-05', '0712345701', '0778765455', '2024-03-24', 1),
(25, 'Anjali Jayasinghe', 'MBA', 'Female', '2222 Galle Road, Colombo', '2004-01-10', '0712345702', '0778765456', '2024-03-25', 5),
(26, 'Mahesh Abeywardena', 'MCA', 'Male', '2323 Kandy Road, Kandy', '2000-02-15', '0712345703', '0778765457', '2024-03-26', 11),
(27, 'Shanaka Senanayake', 'B.E.', 'Male', '2424 Matara Road, Galle', '2001-03-20', '0712345704', '0778765458', '2024-03-27', 6),
(28, 'Ishara Madushanka', 'B.Sc.', 'Male', '2525 Kurunegala Road, Kurunegala', '2002-04-25', '0712345705', '0778765459', '2024-03-28', 14),
(29, 'Thilini Kanchana', 'B.Com.', 'Female', '2626 Nuwara Eliya Road, Nuwara Eliya', '2003-05-30', '0712345706', '0778765460', '2024-03-29', 20),
(30, 'Ashan Nuwan', 'MBA', 'Male', '2727 Badulla Road, Badulla', '2004-06-05', '0712345707', '0778765461', '2024-03-30', 3),
(31, 'Iroshani Pathirana', 'MCA', 'Female', '2828 Anuradhapura Road, Anuradhapura', '2000-07-10', '0712345708', '0778765462', '2024-03-31', 2),
(32, 'Kusal Priyadarshana', 'B.E.', 'Male', '2929 Batticaloa Road, Batticaloa', '2001-08-15', '0712345709', '0778765463', '2024-04-01', 4),
(33, 'Dulani Ranasinghe', 'B.Sc.', 'Female', '3030 Jaffna Road, Jaffna', '2002-09-20', '0712345710', '0778765464', '2024-04-02', 9),
(34, 'Shehan Priyantha', 'B.Com.', 'Male', '3131 Hambantota Road, Hambantota', '2003-10-25', '0712345711', '0778765465', '2024-04-03', 8),
(35, 'Naduni Perera', 'MBA', 'Female', '3232 Kalutara Road, Kalutara', '2004-11-30', '0712345712', '0778765466', '2024-04-04', 10),
(36, 'Pradeep Kumar', 'MCA', 'Male', '3333 Kegalle Road, Kegalle', '2000-12-05', '0712345713', '0778765467', '2024-04-05', 12),
(37, 'Chamara Dissanayake', 'B.E.', 'Male', '3434 Kilinochchi Road, Kilinochchi', '2001-01-10', '0712345714', '0778765468', '2024-04-06', 13),
(38, 'Sanduni Wickramasinghe', 'B.Sc.', 'Female', '3535 Mannar Road, Mannar', '2002-02-15', '0712345715', '0778765469', '2024-04-07', 15),
(39, 'Nimesh Pathirana', 'B.Com.', 'Male', '3636 Matale Road, Matale', '2003-03-20', '0712345716', '0778765470', '2024-04-08', 16),
(40, 'Hansani Peiris', 'MBA', 'Female', '3737 Matara Road, Matara', '2004-04-25', '0712345717', '0778765471', '2024-04-09', 17),
(41, 'Gihan Ekanayake', 'MCA', 'Male', '3838 Moneragala Road, Moneragala', '2000-05-30', '0712345718', '0778765472', '2024-04-10', 18),
(42, 'Dilan Wickremasinghe', 'B.E.', 'Male', '3939 Mullaitivu Road, Mullaitivu', '2001-06-05', '0712345719', '0778765473', '2024-04-11', 19),
(43, 'Madhusha Sandaruwan', 'B.Sc.', 'Male', '4040 Polonnaruwa Road, Polonnaruwa', '2002-07-10', '0712345720', '0778765474', '2024-04-12', 21),
(44, 'Harini Jayasinghe', 'B.Com.', 'Female', '4141 Puttalam Road, Puttalam', '2003-08-15', '0712345721', '0778765475', '2024-04-13', 22),
(45, 'Isuru Bandara', 'MBA', 'Male', '4242 Ratnapura Road, Ratnapura', '2004-09-20', '0712345722', '0778765476', '2024-04-14', 23),
(46, 'Thilanka Perera', 'MCA', 'Female', '4343 Trincomalee Road, Trincomalee', '2000-10-25', '0712345723', '0778765477', '2024-04-15', 24),
(47, 'Supun Wickrama', 'B.E.', 'Male', '4444 Vavuniya Road, Vavuniya', '2001-11-30', '0712345724', '0778765478', '2024-04-16', 25),
(48, 'Dulshan Lakmal', 'B.Sc.', 'Male', '4545 Ampara Road, Ampara', '2002-12-05', '0712345725', '0778765479', '2024-04-17', 1),
(49, 'Menaka Jayathilaka', 'B.Com.', 'Female', '4646 Galle Road, Colombo', '2003-01-10', '0712345726', '0778765480', '2024-04-18', 5),
(50, 'Ravindu Jayasuriya', 'MBA', 'Male', '4747 Kandy Road, Kandy', '2004-02-15', '0712345727', '0778765481', '2024-04-19', 11),
(51, 'testFemale', '', 'Female', 'col 7', '2002-07-11', '0715116262', '0725445545', '2024-07-11', 5),
(52, 'testMale', 'MCA', 'Male', 'aaa', '2000-07-11', '1111111111', '2222222222', '2024-07-11', 7);

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
-- Indexes for table `tbl_city`
--
ALTER TABLE `tbl_city`
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
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`std_id`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`subid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `std_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  MODIFY `subid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
