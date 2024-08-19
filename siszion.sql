-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2019 at 11:44 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `siszion`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_payment`
--

CREATE TABLE IF NOT EXISTS `academic_payment` (
  `username` varchar(20) DEFAULT NULL,
  `period` varchar(12) DEFAULT NULL,
  `status` varchar(15) NOT NULL DEFAULT 'Not paid'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `academic_payment`
--

INSERT INTO `academic_payment` (`username`, `period`, `status`) VALUES
('bio/001/19 ', 'Year1:Sem1', 'Paid');

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `username` varchar(30) NOT NULL,
  `password` varchar(35) NOT NULL,
  `role` varchar(30) NOT NULL,
  `status` varchar(30) NOT NULL,
  `picname` varchar(255) NOT NULL,
  `name` varchar(60) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`username`, `password`, `role`, `status`, `picname`, `name`) VALUES
('abeni23339', '8a2a7812fe568ace222dad14e20441dc', 'Department Head', 'activated', '23339dfs.jpg', 'Abenezer Desta'),
('abeni7048', '76f7a7d61483a9fce066f463342bfe57', 'Faculty Head', 'activated', '7048dfs.jpg', 'Adis Mulu'),
('admin13467', 'c93ccd78b2076528346216b3b2f701e6 ', 'Admin', 'activated', '1346719140WIN_20181210_01_40_36_Pro.jpg', 'billie jean'),
('alex2685', '60b764617b723ef7cd1267f571484f79', 'Quality Assurance', 'activated', '2685photo_2019-05-20_10-05-37.jpg', 'Alex Ande'),
('cs/001/19', '4460ab06c3b771943e082c290a777402', 'student', 'activated', '21735xv.png', 'Nebiyat Giramy'),
('cs/002/19', '0cf5687b6002cd1fa8dbf52997a65aee', 'student', 'activated', '1025untitled.png', 'Sada Ahmed'),
('habte15193', 'fd940567a8b5669537300df72a79e184', 'Registrar', 'activated', '15193pic.png', 'Habtamu Abebe'),
('lemu15730', '2aa98abe949d56d0ce381f15dba00647', 'Finance', 'activated', '15730sdf.jpg', 'Lemu Abebe'),
('mgm/001/19', '1d656366827d39b7faf6d008eddea095', 'student', 'activated', '12966v v.jpg', 'Fisaha Mulu'),
('mgm/002/19', 'fbd19f453eec9f8e1f3f8d5385a2acfe', 'student', 'activated', '14484sdf.jpg', 'Tariku Tamirat'),
('shime6010', 'ad90d6fd91040e5f1851b2f0b5ee7878', 'Department Head', 'activated', '6010df.png', 'Shime Juffa'),
('worke1037', '87b54c0df6c2d32bd8a3008989113490', 'Instructor', 'activated', '1037dsxc.png', 'worke Atalel'),
('yoni11940', '4abd745b8c4cf6d1a455ea215726bb34', 'Instructor', 'activated', '11940blue.jpg', 'Yonas Tekle');

-- --------------------------------------------------------

--
-- Table structure for table `active_course`
--

CREATE TABLE IF NOT EXISTS `active_course` (
  `username` varchar(15) NOT NULL,
  `course` varchar(40) NOT NULL,
  `period` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_course`
--

INSERT INTO `active_course` (`username`, `course`, `period`) VALUES
('cs/001/19', 'Algorithm', 'Year1:Sem1'),
('cs/002/19', 'Algorithm', 'Year1:Sem1'),
('mgm/001/19', 'Business Principe', 'Year1:Sem1'),
('mgm/002/19', 'Business Principe', 'Year1:Sem1');

-- --------------------------------------------------------

--
-- Table structure for table `active_teachers`
--

CREATE TABLE IF NOT EXISTS `active_teachers` (
  `username` varchar(50) DEFAULT NULL,
  `course` varchar(60) DEFAULT NULL,
  `department` varchar(60) NOT NULL,
  `section` int(2) DEFAULT NULL,
  `period` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `active_teachers`
--

INSERT INTO `active_teachers` (`username`, `course`, `department`, `section`, `period`) VALUES
('yoni11940', 'Algorithm', 'Computer Science', 1, 'Year1:Sem1'),
('yoni11940', 'Algorithm', 'Computer Science', 2, 'Year1:Sem1'),
('worke1037', 'Business Principe', 'Management', 1, 'Year1:Sem1'),
('worke1037', 'Business Principe', 'Management', 2, 'Year1:Sem1');

-- --------------------------------------------------------

--
-- Table structure for table `assessment_structure`
--

CREATE TABLE IF NOT EXISTS `assessment_structure` (
  `username` varchar(20) DEFAULT NULL,
  `course` varchar(40) DEFAULT NULL,
  `period` varchar(40) DEFAULT NULL,
  `assessment` varchar(15) DEFAULT NULL,
  `structure` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assessment_structure`
--

INSERT INTO `assessment_structure` (`username`, `course`, `period`, `assessment`, `structure`) VALUES
('yoni11940', 'Algorithm ', 'Year1:Sem1', 'assessment1', 'quiz(5)'),
('yoni11940', 'Algorithm ', 'Year1:Sem1', 'assessment2', 'test1(20)'),
('yoni11940', 'Algorithm ', 'Year1:Sem1', 'assessment3', 'test1(10)'),
('yoni11940', 'Algorithm ', 'Year1:Sem1', 'assessment4', 'assignment1(15)'),
('yoni11940', 'Algorithm ', 'Year1:Sem1', 'assessment5', 'final(50)');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
  `username` varchar(20) DEFAULT NULL,
  `course` varchar(80) DEFAULT NULL,
  `attendance` varchar(8) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cgpa_status`
--

CREATE TABLE IF NOT EXISTS `cgpa_status` (
  `status` varchar(25) NOT NULL DEFAULT '',
  `min_cgpa` varchar(4) DEFAULT NULL,
  `max_cgpa` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cgpa_status`
--

INSERT INTO `cgpa_status` (`status`, `min_cgpa`, `max_cgpa`) VALUES
('Distinction', '3.5', '3.74'),
('First Class', '2.75', '3.4'),
('Great Distinction', '3.75', '4'),
('Second Class', '1', '2.74');

-- --------------------------------------------------------

--
-- Table structure for table `clearancewithdraw`
--

CREATE TABLE IF NOT EXISTS `clearancewithdraw` (
  `username` varchar(20) DEFAULT NULL,
  `period` varchar(12) DEFAULT NULL,
  `library` varchar(14) DEFAULT 'Not cleared',
  `finance` varchar(15) DEFAULT 'Not cleared',
  `registrar` varchar(14) DEFAULT 'Not cleared'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clearancewithdraw`
--

INSERT INTO `clearancewithdraw` (`username`, `period`, `library`, `finance`, `registrar`) VALUES
('bio/001/19 ', 'Year1:Sem1', 'cleared', 'cleared', 'cleared');

-- --------------------------------------------------------

--
-- Table structure for table `coursebank`
--

CREATE TABLE IF NOT EXISTS `coursebank` (
  `department` varchar(70) DEFAULT NULL,
  `coursename` varchar(70) DEFAULT NULL,
  `coursecode` varchar(25) NOT NULL DEFAULT '',
  `credithour` int(2) DEFAULT NULL,
  `period` varchar(13) DEFAULT NULL,
  `prerequisite` varchar(70) DEFAULT NULL,
  `status` varchar(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`coursecode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursebank`
--

INSERT INTO `coursebank` (`department`, `coursename`, `coursecode`, `credithour`, `period`, `prerequisite`, `status`) VALUES
('Computer Science', 'Algorithm', 'al01', 8, 'Year1:Sem1', '', '1'),
('Management', 'Business Principe', 'bs01', 3, 'Year1:Sem1', '', '1'),
('Computer Science', 'Data Structure', 'Ds01', 5, 'Year1:Sem2', '', '1'),
('Management', 'Login in management', 'lmg-1', 3, 'Year1:Sem2', '', '1');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE IF NOT EXISTS `department` (
  `prefix` varchar(25) NOT NULL,
  `name` varchar(50) NOT NULL,
  `head` varchar(50) NOT NULL,
  `faculty` varchar(40) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`prefix`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`prefix`, `name`, `head`, `faculty`, `status`) VALUES
('Bsp01', 'Business Principle', 'shime6010', 'Business', '1'),
('cs', 'Computer Science', 'abeni23339', 'Technology', '1'),
('mgm', 'Management', 'shime6010', 'Business', '1');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `email` varchar(255) DEFAULT NULL,
  `feedback` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`email`, `feedback`) VALUES
('tare@gmail.com', 'hello there');

-- --------------------------------------------------------

--
-- Table structure for table `grade_scale`
--

CREATE TABLE IF NOT EXISTS `grade_scale` (
  `grade` char(2) NOT NULL DEFAULT '',
  `min_point` int(3) DEFAULT NULL,
  `max_point` int(3) DEFAULT NULL,
  PRIMARY KEY (`grade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_scale`
--

INSERT INTO `grade_scale` (`grade`, `min_point`, `max_point`) VALUES
('A', 85, 89),
('A+', 90, 100),
('A-', 80, 84),
('B', 70, 74),
('B+', 75, 79),
('B-', 65, 74),
('C', 55, 59),
('C+', 60, 64),
('C-', 50, 54),
('D', 40, 44),
('D+', 45, 49),
('F', 0, 29),
('Fx', 30, 39);

-- --------------------------------------------------------

--
-- Table structure for table `grade_settings`
--

CREATE TABLE IF NOT EXISTS `grade_settings` (
  `grade` varchar(2) NOT NULL DEFAULT '',
  `point` varchar(4) DEFAULT NULL,
  PRIMARY KEY (`grade`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_settings`
--

INSERT INTO `grade_settings` (`grade`, `point`) VALUES
('A', '4'),
('A+', '4'),
('A-', '3.75'),
('B', '3'),
('B+', '3.5'),
('B-', '2.75'),
('C', '2.3'),
('C+', '2.5'),
('C-', '2'),
('D', '1'),
('D+', '1.5'),
('F', '0'),
('Fx', 'fx');

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `material` varchar(255) DEFAULT NULL,
  `department` varchar(60) DEFAULT NULL,
  `batch` int(4) DEFAULT NULL,
  `section` int(2) DEFAULT NULL,
  `path` varchar(255) NOT NULL,
  `attachment` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`material`, `department`, `batch`, `section`, `path`, `attachment`, `date`) VALUES
('Chapter one.pptx', 'Computer Science', 2019, 1, '24381Chapter one.pptx', '<p>do this in group of five</p>\r\n', '2019-06-12 06:14:01');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE IF NOT EXISTS `notices` (
  `username` varchar(30) DEFAULT NULL,
  `notice` varchar(255) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(2) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `passing_points`
--

CREATE TABLE IF NOT EXISTS `passing_points` (
  `period` varchar(14) DEFAULT NULL,
  `cgpa` varchar(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `passing_points`
--

INSERT INTO `passing_points` (`period`, `cgpa`) VALUES
('Yar1:Sem2', '1.5'),
('Yar2:Sem1', '1.75'),
('Year2:Sem2', '1.8'),
('Yar3:Sem1', '2'),
('Yar3:Sem2', '2'),
('Yar4:Sem1', '2.2'),
('Yar1:Sem2', '2.3');

-- --------------------------------------------------------

--
-- Table structure for table `pendingrequest`
--

CREATE TABLE IF NOT EXISTS `pendingrequest` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `fname` varchar(15) NOT NULL,
  `lname` varchar(15) NOT NULL,
  `email` varchar(60) NOT NULL,
  `age` int(3) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(8) NOT NULL,
  `maritalstatus` varchar(10) NOT NULL,
  `region` varchar(30) NOT NULL,
  `zone` varchar(25) NOT NULL,
  `woreda` varchar(25) NOT NULL,
  `fchoice` varchar(50) NOT NULL,
  `schoice` varchar(50) NOT NULL,
  `tchoice` varchar(50) NOT NULL,
  `picname` varchar(255) NOT NULL,
  `studid` varchar(25) NOT NULL,
  `studdept` varchar(255) NOT NULL,
  `program` varchar(12) NOT NULL,
  `studsec` varchar(2) NOT NULL,
  `sent` varchar(255) NOT NULL,
  `documents` varchar(255) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `pendingrequest`
--

INSERT INTO `pendingrequest` (`id`, `fname`, `lname`, `email`, `age`, `dob`, `sex`, `maritalstatus`, `region`, `zone`, `woreda`, `fchoice`, `schoice`, `tchoice`, `picname`, `studid`, `studdept`, `program`, `studsec`, `sent`, `documents`, `date`) VALUES
(1, 'Tariku', 'Tamirat', 'tare@gmail.com', 21, '2019-06-16', 'male', 'married', 'df', 'fasd', 'fasd', 'Business Principle', 'Computer Science', 'Management', '24941983794168.jpg', '', '', '', '', '', '24941.._materials_.23068ccna1Final.pdf', '2019-06-16 08:49:29'),
(2, 'Tariku', 'Tamirat', 'tare@gmail.com', 22, '2019-06-16', 'female', 'single', 'dafs', 'fadsf', 'ffasdf', 'Management', 'Computer Science', 'Business Principle', '27278983794168.jpg', '', '', '', '', '', '27278.._materials_.23068ccna1Final.pdf', '2019-06-16 08:52:58'),
(3, 'Fisaha', 'Mulu', 'fish@gmail.com', 23, '2019-06-16', 'male', 'married', 'asdf', 'fasdf', 'fadsf', 'Business Principle', 'Computer Science', 'Management', '21167983794168.jpg', '', '', '', '', '', '21167.._materials_.23068ccna1Final.pdf', '2019-06-16 08:56:05'),
(4, 'Nebiyat', 'Giramy', 'neb@gmail.com', 23, '2019-06-16', 'male', 'married', 'asdf', 'fasd', 'fasd', 'Business Principle', 'Computer Science', 'Management', '237983794168.jpg', '', '', '', '', '', '237.._materials_.23068ccna1Final.pdf', '2019-06-16 08:57:06'),
(5, 'Nebiyat', 'Giramy', 'neb@gmail.com', 2, '2017-06-16', 'male', 'married', 'asdf', 'fasd', 'fasd', 'Business Principle', 'Computer Science', 'Management', '14012983794168.jpg', '', '', '', '', '', '14012.._materials_.23068ccna1Final.pdf', '2019-06-16 09:07:32'),
(6, 'Tariku', 'Tamirat', 'tare@gmail.com', 21, '2019-06-16', 'male', 'married', 'fg', 'gsdfg', 'dfsg', 'Business Principle', 'Computer Science', 'Management', '17989983794168.jpg', '', '', '', '', '', '17989.._materials_.23068ccna1Final.pdf', '2019-06-16 09:09:19'),
(7, 'Fisaha', 'Mulu', 'fish@gmail.com', 21, '2019-06-16', 'male', 'married', 'dsf', 'fasd', 'fasd', 'Computer Science', 'Management', 'Business Principle', '8602983794168.jpg', '', '', '', '', '', '8602.._materials_.23068ccna1Final.pdf', '2019-06-16 09:11:40'),
(8, 'Fisaha', 'Mulu', 'fish@gmail.com', 2, '2017-05-16', 'male', 'married', 'dfads', 'fasd', 'fasd', 'Management', 'Computer Science', 'Business Principle', '19234983794168.jpg', '', '', '', '', '', '19234.._materials_.23068ccna1Final.pdf', '2019-06-16 09:15:27'),
(9, 'Fisaha', 'Mulu', 'fish@gmail.com', 2, '2017-06-20', 'male', 'married', 'asdf', 'fasd', 'fasd', 'Business Principle', 'Management', 'Computer Science', '29551983794168.jpg', '', '', '', '', '', '29551.._materials_.23068ccna1Final.pdf', '2019-06-20 13:54:26');

-- --------------------------------------------------------

--
-- Table structure for table `registeredstudents`
--

CREATE TABLE IF NOT EXISTS `registeredstudents` (
  `username` varchar(20) NOT NULL,
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `email` varchar(25) NOT NULL,
  `age` int(2) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(9) NOT NULL,
  `maritalstatus` varchar(9) NOT NULL,
  `region` varchar(50) NOT NULL,
  `zone` varchar(30) NOT NULL,
  `woreda` varchar(30) NOT NULL,
  `dept` varchar(50) NOT NULL,
  `program` varchar(12) NOT NULL,
  `section` varchar(50) NOT NULL,
  `picname` varchar(50) NOT NULL,
  `batch` int(5) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `registeredstudents`
--

INSERT INTO `registeredstudents` (`username`, `fname`, `lname`, `email`, `age`, `dob`, `sex`, `maritalstatus`, `region`, `zone`, `woreda`, `dept`, `program`, `section`, `picname`, `batch`) VALUES
('cs/001/19', 'Nebiyat', 'Giramy', 'neb@gmail.com', 22, '2019-06-11', 'female', 'married', 'asdf', 'fasd', 'fsd', 'Computer Science', '', '2', '21735xv.png', 2019),
('cs/002/19', 'Sada', 'Ahmed', 'sada@gmail.com', 21, '2019-06-11', 'female', 'single', 'asdf', 'fasd', 'fasd', 'Computer Science', '', '1', '1025untitled.png', 2019),
('mgm/001/19', 'Fisaha', 'Mulu', 'fish@gmail.com', 20, '2019-06-11', 'male', 'single', 'dsf', 'fsd', 'fasd', 'Management', '', '1', '12966v v.jpg', 2019),
('mgm/002/19', 'Tariku', 'Tamirat', 'tare@gmail.com', 23, '2019-06-11', 'male', 'married', 'dsf', 'fasd', 'fsda', 'Management', '', '2', '14484sdf.jpg', 2019);

-- --------------------------------------------------------

--
-- Table structure for table `seat`
--

CREATE TABLE IF NOT EXISTS `seat` (
  `dept` varchar(200) NOT NULL,
  `count` int(11) NOT NULL,
  `section` varchar(9) NOT NULL,
  UNIQUE KEY `dept` (`dept`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seat`
--

INSERT INTO `seat` (`dept`, `count`, `section`) VALUES
('Business Principle', 0, ''),
('Computer Science', 2, 'assigned'),
('Management', 2, 'assigned');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `fname` varchar(30) NOT NULL,
  `lname` varchar(30) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(70) NOT NULL,
  `dob` date NOT NULL,
  `sex` varchar(10) NOT NULL,
  `maritalstatus` varchar(10) NOT NULL,
  `region` varchar(50) NOT NULL,
  `zone` varchar(50) NOT NULL,
  `woreda` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `picname` varchar(50) NOT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`fname`, `lname`, `username`, `email`, `dob`, `sex`, `maritalstatus`, `region`, `zone`, `woreda`, `role`, `picname`) VALUES
('Abenezer', 'Desta', 'abeni23339', 'abi@gm', '2019-06-11', 'male', 'single', 'fasd', 'fasdf', 'fasdfsd', 'Department Head', '23339dfs.jpg'),
('Adis', 'Mulu', 'abeni7048', 'abi@gm', '2019-06-11', 'male', 'single', 'asdf', 'fasd', 'afd', 'Faculty Head', '7048dfs.jpg'),
('Alex', 'Ande', 'alex2685', 'alex@gmail.com', '2019-06-11', 'male', 'single', 'fasd', 'fasdf', 'fasdfas', 'Quality Assurance', '2685photo_2019-05-20_10-05-37.jpg'),
('Habtamu', 'Abebe', 'habte15193', 'habte@gmail.com', '2019-06-11', 'male', 'single', 'fasd', 'fasdf', 'fasdf', 'Registrar', '15193pic.png'),
('Lemu', 'Abebe', 'lemu15730', 'lemu@gmail.com', '2019-06-11', 'female', 'single', 'fsadf', 'fasdf', 'fasdf', 'Finance', '15730sdf.jpg'),
('Shime', 'Juffa', 'shime6010', 'shime@gmail.com', '2019-06-11', 'male', 'married', 'adf', 'fasd', 'adf', 'Department Head', '6010df.png'),
('worke', 'Atalel', 'worke1037', 'worke@gmail.com', '2019-06-11', 'male', 'married', 'adsff', 'fasd', 'fasd', 'Instructor', '1037dsxc.png'),
('Yonas', 'Tekle', 'yoni11940', 'yoni@gmail.com', '2019-06-11', 'male', 'single', 'asfds', 'fasdf', 'fasdf', 'Instructor', '11940blue.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `student_cgpa`
--

CREATE TABLE IF NOT EXISTS `student_cgpa` (
  `username` varchar(15) DEFAULT NULL,
  `period` varchar(13) DEFAULT NULL,
  `cgpa` varchar(4) DEFAULT NULL,
  `total_crhr` varchar(3) DEFAULT NULL,
  `total_crpts` varchar(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_cgpa`
--

INSERT INTO `student_cgpa` (`username`, `period`, `cgpa`, `total_crhr`, `total_crpts`) VALUES
('cs/001/19', 'Year1:Sem1', '3.5', '8', '28'),
('cs/002/19', 'Year1:Sem1', '2.75', '8', '22');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE IF NOT EXISTS `student_course` (
  `username` varchar(20) NOT NULL,
  `course` varchar(40) NOT NULL,
  `period` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`username`, `course`, `period`) VALUES
('cs/001/19', 'Algorithm', 'Year1:Sem1'),
('cs/002/19', 'Algorithm', 'Year1:Sem1'),
('mgm/001/19', 'Business Principe', 'Year1:Sem1'),
('mgm/002/19', 'Business Principe', 'Year1:Sem1');

-- --------------------------------------------------------

--
-- Table structure for table `student_gpa`
--

CREATE TABLE IF NOT EXISTS `student_gpa` (
  `username` varchar(25) DEFAULT NULL,
  `period` varchar(12) DEFAULT NULL,
  `gpa` varchar(4) DEFAULT NULL,
  `total_crhr` int(3) DEFAULT NULL,
  `total_crpts` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_gpa`
--

INSERT INTO `student_gpa` (`username`, `period`, `gpa`, `total_crhr`, `total_crpts`) VALUES
('cs/001/19', 'Year1:Sem1', '3.5', 8, 28),
('cs/002/19', 'Year1:Sem1', '2.75', 8, 22);

-- --------------------------------------------------------

--
-- Table structure for table `student_grade`
--

CREATE TABLE IF NOT EXISTS `student_grade` (
  `username` varchar(20) DEFAULT NULL,
  `course` varchar(40) DEFAULT NULL,
  `period` varchar(15) DEFAULT NULL,
  `grade` char(2) DEFAULT NULL,
  `mark` varchar(4) NOT NULL,
  `total_points` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_grade`
--

INSERT INTO `student_grade` (`username`, `course`, `period`, `grade`, `mark`, `total_points`) VALUES
('cs/001/19', 'Algorithm', 'Year1:Sem1', 'B+', '3.5', '76'),
('cs/002/19', 'Algorithm', 'Year1:Sem1', 'B-', '2.75', '68');

-- --------------------------------------------------------

--
-- Table structure for table `student_mark`
--

CREATE TABLE IF NOT EXISTS `student_mark` (
  `username` varchar(25) DEFAULT NULL,
  `course` varchar(40) DEFAULT NULL,
  `period` varchar(12) DEFAULT NULL,
  `assessment1` varchar(12) DEFAULT NULL,
  `assessment2` varchar(12) DEFAULT NULL,
  `assessment3` varchar(12) DEFAULT NULL,
  `assessment4` varchar(12) DEFAULT NULL,
  `assessment5` varchar(12) DEFAULT NULL,
  `assessment6` varchar(12) DEFAULT NULL,
  `assessment7` varchar(12) DEFAULT NULL,
  `assessment8` varchar(12) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_mark`
--

INSERT INTO `student_mark` (`username`, `course`, `period`, `assessment1`, `assessment2`, `assessment3`, `assessment4`, `assessment5`, `assessment6`, `assessment7`, `assessment8`) VALUES
('cs/001/19', 'Algorithm', 'Year1:Sem1', '3', '7', '8', '12', '6', '40', '', ''),
('cs/002/19', 'Algorithm', 'Year1:Sem1', '2', '6', '6', '13', '6', '35', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_course`
--

CREATE TABLE IF NOT EXISTS `teacher_course` (
  `username` varchar(25) DEFAULT NULL,
  `course` varchar(60) DEFAULT NULL,
  `department` varchar(60) NOT NULL,
  `section` int(2) DEFAULT NULL,
  `period` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teacher_course`
--

INSERT INTO `teacher_course` (`username`, `course`, `department`, `section`, `period`) VALUES
('shime9995', 'Water resource', 'Agricultural science', 1, 'Year1:Sem1'),
('shime9995', 'Irrigation', 'Agricultural science', 0, 'Year1:Sem1'),
('yoni11940', 'Algorithm', 'Computer Science', 2, 'Year1:Sem1'),
('yoni11940', 'Algorithm', 'Computer Science', 2, 'Year1:Sem1'),
('worke1037', 'Business Principe', 'Management', 1, 'Year1:Sem1'),
('worke1037', 'Business Principe', 'Management', 2, 'Year1:Sem1');

-- --------------------------------------------------------

--
-- Table structure for table `user_mgmnt`
--

CREATE TABLE IF NOT EXISTS `user_mgmnt` (
  `username` varchar(30) DEFAULT NULL,
  `user_role` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_mgmnt`
--

INSERT INTO `user_mgmnt` (`username`, `user_role`) VALUES
('shime6010', 'Management'),
('abeni23339', 'Computer Science'),
('yoni11940', 'Computer Science'),
('worke1037', 'Management'),
('shime6010', 'Business Principle');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
