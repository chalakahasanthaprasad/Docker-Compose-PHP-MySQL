-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Aug 18, 2024 at 06:19 PM
-- Server version: 8.0.39
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
-- Table structure for table `course_faculty`
--

CREATE TABLE `course_faculty` (
  `course_id` int NOT NULL,
  `faculty_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_faculty`
--

INSERT INTO `course_faculty` (`course_id`, `faculty_id`) VALUES
(4, 1),
(5, 1),
(6, 1),
(11, 1),
(12, 1),
(1, 2),
(3, 2),
(7, 2),
(21, 2),
(26, 2),
(2, 3),
(9, 3),
(10, 3),
(13, 3),
(14, 3),
(8, 4),
(17, 4),
(18, 4),
(15, 5),
(16, 5),
(19, 6),
(20, 6);

-- --------------------------------------------------------

--
-- Table structure for table `course_subjects`
--

CREATE TABLE `course_subjects` (
  `course_id` int NOT NULL,
  `subject_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_subjects`
--

INSERT INTO `course_subjects` (`course_id`, `subject_id`) VALUES
(1, 1),
(10, 1),
(1, 2),
(10, 2),
(1, 3),
(10, 3),
(1, 4),
(10, 4),
(1, 5),
(10, 5),
(2, 6),
(9, 6),
(13, 6),
(14, 6),
(2, 7),
(9, 7),
(13, 7),
(14, 7),
(2, 8),
(9, 8),
(13, 8),
(14, 8),
(2, 9),
(9, 9),
(13, 9),
(14, 9),
(3, 10),
(7, 10),
(8, 10),
(3, 11),
(7, 11),
(8, 11),
(3, 12),
(7, 12),
(8, 12),
(3, 13),
(7, 13),
(8, 13),
(4, 14),
(4, 15),
(4, 16),
(4, 17),
(5, 18),
(5, 19),
(5, 20),
(5, 21),
(6, 22),
(6, 23),
(6, 24),
(6, 25),
(11, 26),
(12, 26),
(11, 27),
(12, 27),
(11, 28),
(12, 28),
(11, 29),
(12, 29),
(15, 30),
(16, 30),
(15, 31),
(16, 31),
(15, 32),
(16, 32),
(15, 33),
(16, 33),
(17, 34),
(18, 34),
(17, 35),
(18, 35),
(17, 36),
(18, 36),
(17, 37),
(18, 37),
(19, 38),
(20, 38),
(19, 39),
(20, 39),
(19, 40),
(20, 40),
(19, 41),
(20, 41),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(2, 48),
(2, 49),
(2, 50),
(2, 51),
(2, 52),
(2, 53),
(3, 54),
(3, 55),
(3, 56),
(3, 57),
(3, 58),
(3, 59),
(4, 60),
(4, 61),
(4, 62),
(4, 63),
(4, 64),
(4, 65),
(5, 66),
(5, 67),
(5, 68),
(5, 69),
(5, 70),
(5, 71),
(6, 72),
(6, 73),
(6, 74),
(6, 75),
(6, 76),
(6, 77),
(11, 78),
(11, 79),
(11, 80),
(11, 81),
(11, 82),
(11, 83),
(19, 96),
(19, 97),
(19, 98),
(19, 99),
(19, 100),
(19, 101),
(2, 102),
(1, 103);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_batch`
--

CREATE TABLE `tbl_batch` (
  `batch_id` int NOT NULL,
  `batch_code` varchar(15) NOT NULL,
  `course_id` int NOT NULL,
  `faculty_id` int NOT NULL,
  `center_id` int NOT NULL,
  `student_count` int DEFAULT '0',
  `batch_year` varchar(4) NOT NULL,
  `enrollment_start_date` date NOT NULL,
  `enrollment_end_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_batch`
--

INSERT INTO `tbl_batch` (`batch_id`, `batch_code`, `course_id`, `faculty_id`, `center_id`, `student_count`, `batch_year`, `enrollment_start_date`, `enrollment_end_date`) VALUES
(1, 'COMCA242F', 1, 2, 1, 0, '24', '2024-08-10', '2024-09-10'),
(2, 'COMCA243F', 1, 2, 1, 0, '2024', '2024-08-16', '2024-10-16'),
(11, 'COMCA241P', 1, 2, 1, 0, '2024', '2024-08-17', '2024-10-17');

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
  `course_level` varchar(50) NOT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `isDelete` tinyint(1) NOT NULL DEFAULT '0',
  `created_date` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `update_date` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_course`
--

INSERT INTO `tbl_course` (`cid`, `code`, `cfull`, `course_level`, `isActive`, `isDelete`, `created_date`, `update_date`) VALUES
(1, 'MCA', 'Master of Computer Applications', 'Master', 1, 0, '2024-03-01', '19-07-2024'),
(2, 'B.E.', 'Bachelor of Engineering', 'Degree', 1, 0, '2024-03-02', NULL),
(3, 'B.Sc.', 'Bachelor of Science', 'Degree', 1, 0, '2024-03-03', NULL),
(4, 'B.Com.', 'Bachelor of Commerce', 'Degree', 1, 0, '2024-03-04', NULL),
(5, 'MBA', 'Master of Business Administration', 'Master', 1, 0, '2024-03-05', NULL),
(6, 'BBA', 'Bachelor of Business Administration', 'Degree', 1, 0, '2024-03-06', NULL),
(7, 'M.Sc.', 'Master of Science', 'Master', 1, 0, '2024-03-07', NULL),
(8, 'B.A.', 'Bachelor of Arts', 'Degree', 1, 0, '2024-03-08', NULL),
(9, 'M.E.', 'Master of Engineering', 'Master', 1, 0, '2024-03-09', NULL),
(10, 'Ph.D.', 'Doctor of Philosophy', 'Master', 1, 0, '2024-03-10', NULL),
(11, 'LLB', 'Bachelor of Laws', 'Degree', 1, 0, '2024-03-11', NULL),
(12, 'LLM', 'Master of Laws', 'Master', 1, 0, '2024-03-12', NULL),
(13, 'B.Tech.', 'Bachelor of Technology', 'Degree', 1, 0, '2024-03-13', NULL),
(14, 'M.Tech.', 'Master of Technology', 'Master', 1, 0, '2024-03-14', NULL),
(15, 'B.Arch.', 'Bachelor of Architecture', 'Degree', 1, 0, '2024-03-15', NULL),
(16, 'M.Arch.', 'Master of Architecture', 'Master', 1, 0, '2024-03-16', NULL),
(17, 'B.Ed.', 'Bachelor of Education', 'Degree', 1, 0, '2024-03-17', NULL),
(18, 'M.Ed.', 'Master of Education', 'Master', 1, 0, '2024-03-18', NULL),
(19, 'B.Pharm.', 'Bachelor of Pharmacy', 'Degree', 1, 0, '2024-03-19', NULL),
(20, 'M.Pharm.', 'Master of Pharmacy', 'Master', 1, 0, '2024-03-20', NULL),
(21, 'C.java', 'Certificate Course Java', 'Certificate', 0, 0, '15-07-2024', '17-07-2024'),
(26, 'DSE', 'Diploma In Software Engineering', 'Diploma', 0, 0, '24-07-2024', NULL),
(27, 'a', 'a', 'English', 0, 0, '31-07-2024', NULL),
(28, 'test2', 'test2', 'English', 0, 0, '01-08-2024', '01-08-2024');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_faculty`
--

CREATE TABLE `tbl_faculty` (
  `faculty_id` int NOT NULL,
  `faculty_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_faculty`
--

INSERT INTO `tbl_faculty` (`faculty_id`, `faculty_name`) VALUES
(1, 'School of Business'),
(2, 'School of Computing'),
(3, 'School of Engineering'),
(4, 'School of Languages'),
(5, 'School of Design'),
(7, 'Business Analytics Centre'),
(8, 'Productivity and Quality Centre');

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
  `title` varchar(6) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `std_name` varchar(250) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `std_index` varchar(30) NOT NULL,
  `tcenter_id` int NOT NULL,
  `faculty_id` int NOT NULL,
  `course_code` int NOT NULL,
  `batch_id` int NOT NULL,
  `nic_no` varchar(12) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` varchar(250) DEFAULT NULL,
  `email` varchar(250) NOT NULL,
  `birthofdate` date NOT NULL,
  `mobile_number` varchar(15) DEFAULT NULL,
  `parent_number` varchar(15) DEFAULT NULL,
  `f_language` varchar(8) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `registered_date` date NOT NULL,
  `city_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subjects`
--

CREATE TABLE `tbl_subjects` (
  `subject_id` int NOT NULL,
  `subject_code` varchar(50) NOT NULL,
  `subject_name` varchar(250) NOT NULL,
  `created_date` datetime NOT NULL,
  `update_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_subjects`
--

INSERT INTO `tbl_subjects` (`subject_id`, `subject_code`, `subject_name`, `created_date`, `update_date`) VALUES
(1, 'CS101', 'Computer Science Basics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(2, 'CS102', 'Data Structures', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(3, 'CS103', 'Algorithms', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(4, 'CS104', 'Operating Systems', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(5, 'CS105', 'Database Management Systems', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(6, 'ENG101', 'Engineering Mathematics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(7, 'ENG102', 'Mechanics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(8, 'ENG103', 'Thermodynamics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(9, 'ENG104', 'Fluid Mechanics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(10, 'SCI101', 'Physics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(11, 'SCI102', 'Chemistry', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(12, 'SCI103', 'Biology', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(13, 'SCI104', 'Mathematics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(14, 'COM101', 'Financial Accounting', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(15, 'COM102', 'Business Law', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(16, 'COM103', 'Economics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(17, 'COM104', 'Marketing', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(18, 'MBA101', 'Management Principles', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(19, 'MBA102', 'Organizational Behavior', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(20, 'MBA103', 'Financial Management', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(21, 'MBA104', 'Human Resource Management', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(22, 'BBA101', 'Introduction to Business', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(23, 'BBA102', 'Business Communication', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(24, 'BBA103', 'Business Statistics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(25, 'BBA104', 'Business Ethics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(26, 'LAW101', 'Constitutional Law', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(27, 'LAW102', 'Criminal Law', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(28, 'LAW103', 'Civil Law', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(29, 'LAW104', 'Corporate Law', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(30, 'ARCH101', 'Architectural Design', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(31, 'ARCH102', 'Building Materials', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(32, 'ARCH103', 'Structural Systems', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(33, 'ARCH104', 'Urban Planning', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(34, 'EDU101', 'Educational Psychology', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(35, 'EDU102', 'Curriculum Development', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(36, 'EDU103', 'Educational Technology', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(37, 'EDU104', 'Assessment Methods', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(38, 'PHARM101', 'Pharmacology', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(39, 'PHARM102', 'Medicinal Chemistry', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(40, 'PHARM103', 'Pharmaceutics', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(41, 'PHARM104', 'Pharmacy Practice', '2024-07-22 17:42:48', '2024-07-22 17:42:48'),
(42, 'CS106', 'Software Engineering', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(43, 'CS107', 'Computer Networks', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(44, 'CS108', 'Artificial Intelligence', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(45, 'CS109', 'Machine Learning', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(46, 'CS110', 'Cyber Security', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(47, 'CS111', 'Web Development', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(48, 'ENG107', 'Materials Science', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(49, 'ENG108', 'Control Systems', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(50, 'ENG109', 'Signals and Systems', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(51, 'ENG110', 'Digital Electronics', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(52, 'ENG111', 'Heat Transfer', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(53, 'ENG112', 'Manufacturing Processes', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(54, 'SCI107', 'Organic Chemistry', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(55, 'SCI108', 'Inorganic Chemistry', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(56, 'SCI109', 'Quantum Mechanics', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(57, 'SCI110', 'Thermodynamics', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(58, 'SCI111', 'Genetics', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(59, 'SCI112', 'Ecology', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(60, 'COM107', 'Taxation', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(61, 'COM108', 'Auditing', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(62, 'COM109', 'Corporate Governance', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(63, 'COM110', 'Investment Management', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(64, 'COM111', 'Cost Accounting', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(65, 'COM112', 'International Business', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(66, 'MBA107', 'Entrepreneurship', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(67, 'MBA108', 'Operations Management', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(68, 'MBA109', 'Supply Chain Management', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(69, 'MBA110', 'Project Management', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(70, 'MBA111', 'Business Analytics', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(71, 'MBA112', 'Leadership and Change Management', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(72, 'BBA107', 'International Business', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(73, 'BBA108', 'Financial Markets', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(74, 'BBA109', 'Entrepreneurship', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(75, 'BBA110', 'E-commerce', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(76, 'BBA111', 'Retail Management', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(77, 'BBA112', 'Quality Management', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(78, 'LAW107', 'Labor Law', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(79, 'LAW108', 'Environmental Law', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(80, 'LAW109', 'Human Rights Law', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(81, 'LAW110', 'Tax Law', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(82, 'LAW111', 'Family Law', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(83, 'LAW112', 'Property Law', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(84, 'ARCH107', 'Interior Design', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(85, 'ARCH108', 'Architectural History', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(86, 'ARCH109', 'Building Construction', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(87, 'ARCH110', 'Sustainable Design', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(88, 'ARCH111', 'Digital Architecture', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(89, 'ARCH112', 'Housing Design', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(90, 'EDU106', 'Classroom Management', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(91, 'EDU107', 'Special Education', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(92, 'EDU108', 'Educational Leadership', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(93, 'EDU109', 'Child Development', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(94, 'EDU110', 'Instructional Strategies', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(95, 'EDU111', 'Counseling in Education', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(96, 'PHARM105', 'Clinical Pharmacy', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(97, 'PHARM106', 'Pharmacokinetics', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(98, 'PHARM107', 'Pharmaceutical Chemistry', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(99, 'PHARM108', 'Pharmacognosy', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(100, 'PHARM109', 'Biopharmaceutics', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(101, 'PHARM110', 'Pharmaceutical Analysis', '2024-07-22 17:53:02', '2024-07-22 17:53:02'),
(102, 'ENG113', 'System Software', '2024-07-24 00:00:00', NULL),
(103, 'CS112', 'testsubject', '2024-07-25 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_training_centers`
--

CREATE TABLE `tbl_training_centers` (
  `center_id` int NOT NULL,
  `c_code` varchar(5) NOT NULL,
  `center_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `city` varchar(100) NOT NULL,
  `state` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `country` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_training_centers`
--

INSERT INTO `tbl_training_centers` (`center_id`, `c_code`, `center_name`, `address`, `city`, `state`, `postal_code`, `country`) VALUES
(1, 'CO', 'Colombo Training Center', '123 Main St', 'Colombo', 'Western Province', '00100', 'Sri Lanka'),
(2, 'KA', 'Kandy Training Center', '456 Queen St', 'Kandy', 'Central Province', '20000', 'Sri Lanka'),
(3, 'GA', 'Galle Training Center', '789 King St', 'Galle', 'Southern Province', '80000', 'Sri Lanka'),
(4, 'MA', 'Mathara Training Center', '101 Prince St', 'Mathara', 'Southern Province', '81000', 'Sri Lanka'),
(5, 'KU', 'Kurunagela Training Center', '202 Princess St', 'Kurunagela', 'North Western Province', '60000', 'Sri Lanka');

-- --------------------------------------------------------

--
-- Table structure for table `training_center_courses`
--

CREATE TABLE `training_center_courses` (
  `center_id` int NOT NULL,
  `course_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `training_center_courses`
--

INSERT INTO `training_center_courses` (`center_id`, `course_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(2, 5),
(3, 5),
(4, 5),
(5, 5),
(1, 6),
(2, 6),
(3, 6),
(4, 6),
(5, 6),
(1, 7);

-- --------------------------------------------------------

--
-- Table structure for table `training_center_faculties`
--

CREATE TABLE `training_center_faculties` (
  `center_id` int NOT NULL,
  `faculty_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `training_center_faculties`
--

INSERT INTO `training_center_faculties` (`center_id`, `faculty_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(1, 2),
(2, 2),
(4, 2),
(1, 3),
(3, 3),
(5, 3),
(1, 4),
(4, 4),
(1, 5),
(5, 5);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `course_faculty`
--
ALTER TABLE `course_faculty`
  ADD PRIMARY KEY (`course_id`,`faculty_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- Indexes for table `course_subjects`
--
ALTER TABLE `course_subjects`
  ADD PRIMARY KEY (`course_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD PRIMARY KEY (`batch_id`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `center_id` (`center_id`),
  ADD KEY `fk_faculty` (`faculty_id`);

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
-- Indexes for table `tbl_faculty`
--
ALTER TABLE `tbl_faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `tbl_login`
--
ALTER TABLE `tbl_login`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`std_id`),
  ADD KEY `fk_batch` (`batch_id`);

--
-- Indexes for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `tbl_training_centers`
--
ALTER TABLE `tbl_training_centers`
  ADD PRIMARY KEY (`center_id`);

--
-- Indexes for table `training_center_courses`
--
ALTER TABLE `training_center_courses`
  ADD PRIMARY KEY (`center_id`,`course_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `training_center_faculties`
--
ALTER TABLE `training_center_faculties`
  ADD PRIMARY KEY (`center_id`,`faculty_id`),
  ADD KEY `faculty_id` (`faculty_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  MODIFY `batch_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tbl_city`
--
ALTER TABLE `tbl_city`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `tbl_course`
--
ALTER TABLE `tbl_course`
  MODIFY `cid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tbl_login`
--
ALTER TABLE `tbl_login`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `std_id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_subjects`
--
ALTER TABLE `tbl_subjects`
  MODIFY `subject_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `tbl_training_centers`
--
ALTER TABLE `tbl_training_centers`
  MODIFY `center_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_batch`
--
ALTER TABLE `tbl_batch`
  ADD CONSTRAINT `fk_faculty` FOREIGN KEY (`faculty_id`) REFERENCES `tbl_faculty` (`faculty_id`),
  ADD CONSTRAINT `tbl_batch_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `tbl_course` (`cid`),
  ADD CONSTRAINT `tbl_batch_ibfk_2` FOREIGN KEY (`center_id`) REFERENCES `tbl_training_centers` (`center_id`);

--
-- Constraints for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD CONSTRAINT `fk_batch` FOREIGN KEY (`batch_id`) REFERENCES `tbl_batch` (`batch_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
