-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 25, 2019 at 02:43 AM
-- Server version: 5.7.21
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_syllabus`
--

DROP TABLE IF EXISTS `academic_syllabus`;
CREATE TABLE IF NOT EXISTS `academic_syllabus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `academic_syllabus_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `uploader_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `uploader_id` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `session` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `accountant`
--

DROP TABLE IF EXISTS `accountant`;
CREATE TABLE IF NOT EXISTS `accountant` (
  `accountant_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `accountant_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `facebook` longtext COLLATE utf8_unicode_ci NOT NULL,
  `twitter` longtext COLLATE utf8_unicode_ci NOT NULL,
  `googleplus` longtext COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `qualification` longtext COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `login_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`accountant_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `accountant`
--

INSERT INTO `accountant` (`accountant_id`, `name`, `accountant_number`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `marital_status`, `file_name`, `password`, `login_status`) VALUES
(16, 'Accountant', '09f94645c8', '2019-08-27', 'Male', 'Muslim', 'o+', 'Address Accountant', '+912345667', 'accountant@accountant.com', 'facebook', 'twitter', 'googleplu', 'linkedin', 'PhD', 'Married', 'Terms of Service.docx', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0');

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

DROP TABLE IF EXISTS `activity`;
CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `colour` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `club_id` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `level` longtext COLLATE utf8_unicode_ci NOT NULL,
  `login_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `phone`, `password`, `level`, `login_status`) VALUES
(1, 'Administrator', 'admin@admin.com', '07133445656', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '1', '0'),
(9, 'Udemy Instructor', 'udemy@udemy.com', '+1564783934', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '2', '0');

-- Force super admin entry
INSERT IGNORE INTO `admin` (`name`, `email`, `phone`, `password`, `level`, `login_status`) VALUES
('Super Admin', 'nps@school.com', '', SHA1('nps1234'), '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE IF NOT EXISTS `admin_role` (
  `admin_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `dashboard` int(11) NOT NULL,
  `manage_academics` int(11) NOT NULL,
  `manage_employee` int(11) NOT NULL,
  `manage_student` int(11) NOT NULL,
  `manage_attendance` int(11) NOT NULL,
  `download_page` int(11) NOT NULL,
  `manage_parent` int(11) NOT NULL,
  `manage_alumni` int(11) NOT NULL,
  PRIMARY KEY (`admin_role_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`admin_role_id`, `admin_id`, `dashboard`, `manage_academics`, `manage_employee`, `manage_student`, `manage_attendance`, `download_page`, `manage_parent`, `manage_alumni`) VALUES
(4, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(7, 9, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
CREATE TABLE IF NOT EXISTS `alumni` (
  `alumni_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profession` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `g_year` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `club_id` int(11) NOT NULL,
  `interest` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`alumni_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `alumni`
--

INSERT INTO `alumni` (`alumni_id`, `name`, `sex`, `phone`, `email`, `address`, `profession`, `marital_status`, `g_year`, `club_id`, `interest`) VALUES
(4, 'Alumni Learner', 'Male', '09066021052', 'd@d.com', 'Address', 'Engineer', 'married', '2019-09-04', 1, 'Reading');

-- --------------------------------------------------------

--
-- Table structure for table `application`
--

DROP TABLE IF EXISTS `application`;
CREATE TABLE IF NOT EXISTS `application` (
  `application_id` int(11) NOT NULL AUTO_INCREMENT,
  `applicant_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vacancy_id` int(11) NOT NULL,
  `apply_date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`application_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application`
--

INSERT INTO `application` (`application_id`, `applicant_name`, `vacancy_id`, `apply_date`, `status`) VALUES
(2, 'Udemy Application', 3, '1567965600', 'interviewed');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

DROP TABLE IF EXISTS `assignment`;
CREATE TABLE IF NOT EXISTS `assignment` (
  `assignment_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`assignment_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`assignment_id`, `name`, `subject_id`, `class_id`, `teacher_id`, `description`, `file_name`, `file_type`, `timestamp`) VALUES
(1, 'Assignment for Nursery One', 4, 2, 1, 'DESC', 'invoice.docx', 'pdf', '2018-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

DROP TABLE IF EXISTS `attendance`;
CREATE TABLE IF NOT EXISTS `attendance` (
  `attendance_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL COMMENT '0 undefined , 1 present , 2  absent, 3 holiday, 4 half day, 5 late',
  `student_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `session` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`attendance_id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `status`, `student_id`, `date`, `session`) VALUES
(39, 1, 45, '2019-12-20', ''),
(40, 1, 45, '2019-12-22', '');

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
CREATE TABLE IF NOT EXISTS `author` (
  `author_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`author_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`author_id`, `name`, `description`) VALUES
(2, 'Esther and Atorise.', 'The book is written by Esther and Atorise');

-- --------------------------------------------------------

--
-- Table structure for table `award`
--

DROP TABLE IF EXISTS `award`;
CREATE TABLE IF NOT EXISTS `award` (
  `award_id` int(11) NOT NULL AUTO_INCREMENT,
  `award_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `gift` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` longtext NOT NULL,
  PRIMARY KEY (`award_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `award`
--

INSERT INTO `award` (`award_id`, `award_code`, `name`, `gift`, `amount`, `date`, `user_id`) VALUES
(2, '4675HD', 'Most Dedicated', 'Award', '1000', '2019-09-19', 'hrm-15');

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `account_holder_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `account_number` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `bank_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `branch` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`bank_id`, `account_holder_name`, `account_number`, `bank_name`, `branch`) VALUES
(2, 'Udemy Instructor', '1234567', 'Payoneer or paypal', 'USA'),
(3, 'Udemy Instructor', '1234567', 'Payoneer or paypal', 'USA'),
(4, 'Udemy Instructor', '1234567', 'Payoneer or paypal', 'USA');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
CREATE TABLE IF NOT EXISTS `book` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `publisher_id` int(11) NOT NULL,
  `book_category_id` int(11) NOT NULL,
  `isbn` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `edition` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` int(11) NOT NULL,
  `quantity` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `price` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`book_id`, `name`, `description`, `author_id`, `publisher_id`, `book_category_id`, `isbn`, `edition`, `subject_id`, `quantity`, `timestamp`, `class_id`, `status`, `price`) VALUES
(1, 'Advance Java.', 'This is the newly released book by Sheg', 2, 1, 2, 'DS34FD', '1st', 0, '1', 1576951200, 2, '1', '200'),
(2, 'Python', 'Python', 2, 1, 2, 'DS34FD', '1st', 4, '2', 1574186400, 2, '2', '500');

-- --------------------------------------------------------

--
-- Table structure for table `book_category`
--

DROP TABLE IF EXISTS `book_category`;
CREATE TABLE IF NOT EXISTS `book_category` (
  `book_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`book_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book_category`
--

INSERT INTO `book_category` (`book_category_id`, `name`, `description`) VALUES
(2, 'Non fictional.', 'This is another non-fictional book');

-- --------------------------------------------------------

--
-- Table structure for table `circular`
--

DROP TABLE IF EXISTS `circular`;
CREATE TABLE IF NOT EXISTS `circular` (
  `circular_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reference` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`circular_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `circular`
--

INSERT INTO `circular` (`circular_id`, `title`, `reference`, `content`, `date`) VALUES
(2, 'Meeting for all the members of the school', 'DF46SFGH', 'This is for all the teaching staff. Ensure you are all present.', '2018-08-24');

-- --------------------------------------------------------

--
-- Table structure for table `ci_sessions`
--

DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE IF NOT EXISTS `ci_sessions` (
  `id` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ci_sessions_timestamp` (`timestamp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `ci_sessions`
--

INSERT INTO `ci_sessions` (`id`, `ip_address`, `timestamp`, `data`) VALUES
('0o55lsviqm8i8evg7i1164p53mkp4vup', '127.0.0.1', 1576400835, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363430303833353b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b),
('5k29uj9otbufutr4sl6sm1sgqajns7q3', '127.0.0.1', 1576401225, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363430313232353b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b),
('6qlbqi95gm56km49cioacibnpl1d6qap', '127.0.0.1', 1575989622, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537353938393632323b),
('7k1ho15mjeg7u9lbsua6a6f0fl3okgf5', '127.0.0.1', 1575989675, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537353938393637353b),
('8esqiumpgo03rthcimbnehv3b2e9bc2p', '127.0.0.1', 1575989062, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537353938393036323b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b),
('ea738lb5ik6v0kmm7dm2pbud27k02glr', '127.0.0.1', 1576397281, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363339373238313b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b),
('fofehi7eaeqj2bk5eit5ekp41gd147hi', '127.0.0.1', 1576397948, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363339373934383b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b),
('jjgc5umr0p2np4aneuua2t7tm89v1voj', '127.0.0.1', 1576239186, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363233393138363b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b),
('l1e17mk7cdg71do9qouos1q5249fetn7', '127.0.0.1', 1576239187, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363233393138373b),
('l46es3qrhtcgi7kcc8daopocsam1knfg', '127.0.0.1', 1576401563, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363430313536333b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b),
('m9sj7su5id61c0rfj53c718pqrbt4hq6', '127.0.0.1', 1576396972, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363339363937323b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b666c6173685f6d6573736167657c733a31383a225375636365737366756c6c79204c6f67696e223b5f5f63695f766172737c613a313a7b733a31333a22666c6173685f6d657373616765223b733a333a226f6c64223b7d),
('ndto2l4cv384prfveod69n5duullmo4o', '127.0.0.1', 1576401722, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537363430313732323b),
('pk4m8lpu6igmqgieqnm547i4q2h99gud', '127.0.0.1', 1575988659, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537353938383635393b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b),
('qhcrmmb8gppl38vmtu8jd806a7l0oksa', '127.0.0.1', 1575989414, 0x5f5f63695f6c6173745f726567656e65726174657c693a313537353938393431343b6c6f67696e5f747970657c733a353a2261646d696e223b61646d696e5f6c6f67696e7c733a313a2231223b61646d696e5f69647c733a313a2238223b6c6f67696e5f757365725f69647c733a313a2238223b6e616d657c733a31333a2241646d696e6973747261746f72223b);

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
CREATE TABLE IF NOT EXISTS `class` (
  `class_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name_numeric` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`class_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `name`, `name_numeric`, `teacher_id`) VALUES
(2, 'Nursery One', 'Nursery 1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_routine`
--

DROP TABLE IF EXISTS `class_routine`;
CREATE TABLE IF NOT EXISTS `class_routine` (
  `class_routine_id` int(11) NOT NULL AUTO_INCREMENT,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `time_start` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time_end` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time_start_min` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `time_end_min` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `day` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `year` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`class_routine_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `class_routine`
--

INSERT INTO `class_routine` (`class_routine_id`, `class_id`, `section_id`, `subject_id`, `time_start`, `time_end`, `time_start_min`, `time_end_min`, `day`, `year`) VALUES
(5, 2, 3, 4, '3', '17', '20', '20', 'monday', '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

DROP TABLE IF EXISTS `club`;
CREATE TABLE IF NOT EXISTS `club` (
  `club_id` int(11) NOT NULL AUTO_INCREMENT,
  `club_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `desc` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`club_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`club_id`, `club_name`, `desc`, `date`) VALUES
(1, 'Jet club', 'This is for those who love science.', '2019-08-25');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `department_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `name`, `department_code`) VALUES
(2, 'Bursar', 'aed7c689d676c7c');

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

DROP TABLE IF EXISTS `designation`;
CREATE TABLE IF NOT EXISTS `designation` (
  `designation_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`designation_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `name`, `department_id`) VALUES
(5, 'Tutorial', 2),
(4, 'Udemy', 2),
(6, 'Student', 2);

-- --------------------------------------------------------

--
-- Table structure for table `dormitory`
--

DROP TABLE IF EXISTS `dormitory`;
CREATE TABLE IF NOT EXISTS `dormitory` (
  `dormitory_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `hostel_room_id` int(11) NOT NULL,
  `hostel_category_id` int(11) NOT NULL,
  `capacity` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`dormitory_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `dormitory`
--

INSERT INTO `dormitory` (`dormitory_id`, `name`, `hostel_room_id`, `hostel_category_id`, `capacity`, `address`, `description`) VALUES
(2, 'Wiz Hostel', 2, 3, '200', 'Address for hostel location', 'Address for hostel location');

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

DROP TABLE IF EXISTS `enquiry`;
CREATE TABLE IF NOT EXISTS `enquiry` (
  `enquiry_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `mobile` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `purpose` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `whom_to_meet` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` timestamp NOT NULL,
  PRIMARY KEY (`enquiry_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enquiry_category`
--

DROP TABLE IF EXISTS `enquiry_category`;
CREATE TABLE IF NOT EXISTS `enquiry_category` (
  `enquiry_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `purpose` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `whom` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`enquiry_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enquiry_category`
--

INSERT INTO `enquiry_category` (`enquiry_category_id`, `category`, `purpose`, `whom`) VALUES
(3, 'This is for ID 3 information.', 'Payment', 'Tutorial'),
(4, 'This is Udemy Information', 'School fees information', 'Just edited now');

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

DROP TABLE IF EXISTS `exam`;
CREATE TABLE IF NOT EXISTS `exam` (
  `exam_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`exam_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `name`, `comment`, `timestamp`) VALUES
(1, 'First Term Examination', 'First Term', '2019-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question`
--

DROP TABLE IF EXISTS `exam_question`;
CREATE TABLE IF NOT EXISTS `exam_question` (
  `exam_question_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `subject_id` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class_id` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`exam_question_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `expense_category`
--

DROP TABLE IF EXISTS `expense_category`;
CREATE TABLE IF NOT EXISTS `expense_category` (
  `expense_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`expense_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `expense_category`
--

INSERT INTO `expense_category` (`expense_category_id`, `name`) VALUES
(5, 'Reading Books.');

-- --------------------------------------------------------

--
-- Table structure for table `hostel`
--

DROP TABLE IF EXISTS `hostel`;
CREATE TABLE IF NOT EXISTS `hostel` (
  `hostel_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hostel_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `facebook` longtext COLLATE utf8_unicode_ci NOT NULL,
  `twitter` longtext COLLATE utf8_unicode_ci NOT NULL,
  `googleplus` longtext COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `qualification` longtext COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `login_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hostel_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hostel`
--

INSERT INTO `hostel` (`hostel_id`, `name`, `hostel_number`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `marital_status`, `file_name`, `password`, `login_status`) VALUES
(15, 'Hostel Udemy', '78e39debb4', '2019-08-27', 'Male', 'Muslim', 'o+', 'This is the new address for the new hostel manager.', '+912345667', 'hostel@hostel.com', 'facebook', 'twitter', 'googleplus', 'linkedin', 'PhD', 'Married', 'Welcome to Optimum Linkup.docx', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_category`
--

DROP TABLE IF EXISTS `hostel_category`;
CREATE TABLE IF NOT EXISTS `hostel_category` (
  `hostel_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hostel_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_category`
--

INSERT INTO `hostel_category` (`hostel_category_id`, `name`, `description`) VALUES
(2, 'Female', 'This is for female only.'),
(3, 'Male', 'This is for male only. Female are not allowed.');

-- --------------------------------------------------------

--
-- Table structure for table `hostel_room`
--

DROP TABLE IF EXISTS `hostel_room`;
CREATE TABLE IF NOT EXISTS `hostel_room` (
  `hostel_room_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `room_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `num_bed` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `cost_bed` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hostel_room_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostel_room`
--

INSERT INTO `hostel_room` (`hostel_room_id`, `name`, `room_type`, `num_bed`, `cost_bed`, `description`) VALUES
(2, 'Room One', 'Single', '2', '5000', 'This is for the big guys among us.');

-- --------------------------------------------------------

--
-- Table structure for table `house`
--

DROP TABLE IF EXISTS `house`;
CREATE TABLE IF NOT EXISTS `house` (
  `house_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`house_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `house`
--

INSERT INTO `house` (`house_id`, `name`, `description`) VALUES
(1, 'Purple House', 'This is for students in purple house');

-- --------------------------------------------------------

--
-- Table structure for table `hrm`
--

DROP TABLE IF EXISTS `hrm`;
CREATE TABLE IF NOT EXISTS `hrm` (
  `hrm_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hrm_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `facebook` longtext COLLATE utf8_unicode_ci NOT NULL,
  `twitter` longtext COLLATE utf8_unicode_ci NOT NULL,
  `googleplus` longtext COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `qualification` longtext COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `login_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`hrm_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hrm`
--

INSERT INTO `hrm` (`hrm_id`, `name`, `hrm_number`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `marital_status`, `file_name`, `password`, `login_status`) VALUES
(15, 'Human Udemy', '414bbf2d2a', '2019-08-27', 'Male', 'Christianity', 'B+', 'This is the newly added human resources manager address', '+912345667', 'hrm@hrm.com', 'facebook', 'twitter', 'googleplus', 'linkedin', 'PhD', 'Married', 'index.html', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0');

-- --------------------------------------------------------

--
-- Table structure for table `invoice`
--

DROP TABLE IF EXISTS `invoice`;
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,     
  `invoice_number` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `receipt_number` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `student_id` int(11) NOT NULL,
  `admission_number` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `student_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `class` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `fee_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `amount` int(11) NOT NULL,
  `discount_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `discount` int(11) NOT NULL,
  `amount_paid` int(11) NOT NULL,
  `due` int(11) NOT NULL,
  `creation_timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_method` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `year` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`invoice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `invoice`
--

INSERT INTO `invoice` (`invoice_id`, `invoice_number`, `receipt_number`, `student_id`, `admission_number`, `student_name`, `class`, `title`, `description`, `fee_type`, `amount`, `discount`, `amount_paid`, `due`, `creation_timestamp`, `payment_method`, `status`, `year`) VALUES
(2, '742593INV2019', '', 102, NULL, 'Student Name', 'Class Name', 'Another Part payment for eLibrary', 'Another Part payment for eLibrary.', 'expense', 7000, 0, 6200, 800, '2019-11-12', '1', 2, '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `fee_items`
--

DROP TABLE IF EXISTS `fee_items`;
CREATE TABLE IF NOT EXISTS `fee_items` (
  `fee_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `fee_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fee_item_id`),
  KEY `invoice_id` (`invoice_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `phrase_id` int(11) NOT NULL AUTO_INCREMENT,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci,
  `arabic` longtext COLLATE utf8_unicode_ci,
  `french` longtext COLLATE utf8_unicode_ci,
  `korea` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`phrase_id`)
) ENGINE=MyISAM AUTO_INCREMENT=40558 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`, `arabic`, `french`, `korea`) VALUES
(1, 'Manage Language', 'Manage Language', 'إدارة اللغة', NULL, NULL),
(2, 'active language', 'Active Language', 'اللغة النشطة', NULL, NULL),
(40557, 'add', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language_list`
--

DROP TABLE IF EXISTS `language_list`;
CREATE TABLE IF NOT EXISTS `language_list` (
  `language_list_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `db_field` varchar(300) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`language_list_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `leave`
--

DROP TABLE IF EXISTS `leave`;
CREATE TABLE IF NOT EXISTS `leave` (
  `leave_id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `start_date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `end_date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `reason` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`leave_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `librarian`
--

DROP TABLE IF EXISTS `librarian`;
CREATE TABLE IF NOT EXISTS `librarian` (
  `librarian_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `librarian_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `facebook` longtext COLLATE utf8_unicode_ci NOT NULL,
  `twitter` longtext COLLATE utf8_unicode_ci NOT NULL,
  `googleplus` longtext COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `qualification` longtext COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `login_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`librarian_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `librarian`
--

INSERT INTO `librarian` (`librarian_id`, `name`, `librarian_number`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `marital_status`, `file_name`, `password`, `login_status`) VALUES
(13, 'Udemy Librarian', '42ed75d802', '2019-08-26', 'Male', 'Muslim', 'O-', 'Address', '+912345667', 'librarian@librarian.com', 'facebook', 'twitter', 'googleplus', 'linkedin', 'PhD', 'Married', 'invoice.docx', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '0');

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

DROP TABLE IF EXISTS `mark`;
CREATE TABLE IF NOT EXISTS `mark` (
  `mark_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `class_score1` int(11) NOT NULL,
  `class_score2` int(11) NOT NULL,
  `class_score3` int(11) NOT NULL,
  `exam_score` int(11) NOT NULL,
  `comment` longtext NOT NULL,
  PRIMARY KEY (`mark_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`mark_id`, `student_id`, `subject_id`, `exam_id`, `class_id`, `class_score1`, `class_score2`, `class_score3`, `exam_score`, `comment`) VALUES
(1, 45, 5, 1, 2, 10, 9, 8, 70, 'Good performance.'),
(2, 45, 4, 1, 2, 10, 7, 9, 69, 'Excellent performance.');

-- --------------------------------------------------------

--
-- Table structure for table `material`
--

DROP TABLE IF EXISTS `material`;
CREATE TABLE IF NOT EXISTS `material` (
  `material_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `file_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`material_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `material`
--

INSERT INTO `material` (`material_id`, `name`, `class_id`, `subject_id`, `teacher_id`, `description`, `file_name`, `file_type`, `timestamp`) VALUES
(1, 'Study material for Nursery One', 2, 5, 1, 'This is for class only.', 'profile.png', 'docx', '2018-08-19');

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

DROP TABLE IF EXISTS `noticeboard`;
CREATE TABLE IF NOT EXISTS `noticeboard` (
  `noticeboard_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `location` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` int(11) NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`noticeboard_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `noticeboard`
--

INSERT INTO `noticeboard` (`noticeboard_id`, `title`, `location`, `timestamp`, `description`) VALUES
(3, 'Second meeting coming up soon', 'Udemy Forum', 1575136800, 'The meeting is coming up soon. Ensure you are fully prepared.'),
(4, 'Parent Teacher Association Meeting.', 'Ontario Location', 1575050400, 'This is the new updated information as regards the meeting.');

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

DROP TABLE IF EXISTS `parent`;
CREATE TABLE IF NOT EXISTS `parent` (
  `parent_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `profession` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `login_status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `name`, `email`, `password`, `phone`, `address`, `profession`, `login_status`) VALUES
(4, 'Mr. Parent', 'parent@parent.com', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', '+912345667', 'Udemy Address', 'Learners', '0');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
CREATE TABLE IF NOT EXISTS `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `title` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `payment_type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL, -- This is the amount for this specific payment transaction
  -- >> ADD THESE LINES <<
  `discount_type` varchar(255) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL, -- Or DECIMAL(5,2) etc.
  -- >> END OF ADDED LINES <<
  `timestamp` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `method` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `year` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `invoice_id`, `student_id`, `title`, `description`, `payment_type`, `amount`, `discount_type`, `discount`, `timestamp`, `method`, `year`) VALUES
(2, 2, 102, 'Purchase of school reading', 'expense', 'expense', 5000, '', '', 556644564, '2', '2019-2020'),
(5, 2, 102, 'Purchase of school chalks', 'expense', 'expense', 3000, '', '', 556644564, '1', '2019-2020'),
(6, 2, 102, 'Part payment for eLibrary', '', 'income', 5000, '0', 0, 556644564, '1', ''),
(7, 2, 102, 'Another payment for eLibrary', 'income', 'income', 2000, '0', 0, 445667865, '1', ''),
(8, 2, 102, 'Part payment for eLibrary', 'income', 'income', 1200, '', 0, 556644564, '1', ''),
(9, 2, 102, 'New chalk purchased', 'expense', 'expense', 1000, '', '', 556644564, '3', '2019-2020'),
(10, 2, 102, 'Another Part payment for eLibrary.', 'income', 'income', 5000, '', 0, 1576951200, '1', '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `payroll`
--

DROP TABLE IF EXISTS `payroll`;
CREATE TABLE IF NOT EXISTS `payroll` (
  `payroll_id` int(11) NOT NULL AUTO_INCREMENT,
  `payroll_code` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `user_id` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `allowances` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `deductions` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`payroll_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payroll`
--

INSERT INTO `payroll` (`payroll_id`, `payroll_code`, `user_id`, `allowances`, `deductions`, `date`, `status`) VALUES
(4, 'c94d9d7', '1', '[{\"type\":\"A\",\"amount\":\"1000\"},{\"type\":\"B\",\"amount\":\"1000\"}]', '[{\"type\":\"A\",\"amount\":\"200\"},{\"type\":\"B\",\"amount\":\"700\"}]', '10,2019', '0'),
(3, 'a8c4ae9', '1', '[{\"type\":\"Food\",\"amount\":\"5000\"},{\"type\":\"House\",\"amount\":\"2000\"}]', '[{\"type\":\"Tax1\",\"amount\":\"1000\"},{\"type\":\"Tax2\",\"amount\":\"500\"}]', '9,2019', '1'),
(5, '75c1f3d', '1', '[{\"type\":\"A\",\"amount\":\"2000\"},{\"type\":\"B\",\"amount\":\"1000\"}]', '[{\"type\":\"A\",\"amount\":\"500\"},{\"type\":\"B\",\"amount\":\"500\"}]', '12,2019', '1');

-- --------------------------------------------------------

--
-- Table structure for table `publisher`
--

DROP TABLE IF EXISTS `publisher`;
CREATE TABLE IF NOT EXISTS `publisher` (
  `publisher_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`publisher_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `publisher`
--

INSERT INTO `publisher` (`publisher_id`, `name`, `description`) VALUES
(1, 'Amazon.', 'The book is published by Amazon');
-- --------------------------------------------------------

--
-- Table structure for table `section`
--

DROP TABLE IF EXISTS `section`;
CREATE TABLE IF NOT EXISTS `section` (
  `section_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `nick_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`section_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `name`, `nick_name`, `class_id`, `teacher_id`) VALUES
(3, 'First Term', 'Term 1', 2, 1),
(4, 'Second Term', '2nd', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`settings_id`)
) ENGINE=MyISAM AUTO_INCREMENT=123 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'Gyansetu School ERP System'),
(2, 'system_title', 'Gyansetu School ERP System'),
(3, 'address', 'Dehkora, Haryana 124501'),
(4, 'phone', '+917082101540'),
(6, 'currency', '₹'),
(7, 'system_email', 'info@ruhilfuturetechnologies.com'),
(11, 'language', 'english'),
(12, 'text_align', 'left-to-right'),
(16, 'skin_colour', 'purple'),
(21, 'session', '2025-26'),
(22, 'footer', 'Powered by Gyansetu.ai <br>  ( RFT )'),
(116, 'paypal_email', 'optimumproblemsolver@gmail.com'),
(119, 'stripe_setting', '[{"stripe_active":"1","testmode":"off","secret_key":"test secret key","public_key":"test public key","secret_live_key":"live secret key","public_live_key":"live public key"}]'),
(122, 'paypal_setting', '[{"paypal_active":"1","paypal_mode":"sandbox","sandbox_client_id":"client id sandbox","production_client_id":"client - production"}]');

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

DROP TABLE IF EXISTS `sms_settings`;
CREATE TABLE IF NOT EXISTS `sms_settings` (
  `sms_setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `info` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`sms_setting_id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_settings`
--

INSERT INTO `sms_settings` (`sms_setting_id`, `type`, `info`) VALUES
(12, 'msg91_sender_id', 'sender id'),
(11, 'msg91_authentication_key', 'msg91 auth key'),
(10, 'clickatell_apikey', 'clickattel api'),
(9, 'clickatell_password', 'clickattel paasword'),
(8, 'clickatell_username', 'clickattel username'),
(13, 'msg91_route', 'route'),
(14, 'msg91_country_code', 'country code'),
(15, 'active_sms_gateway', 'msg91');

-- --------------------------------------------------------

--
-- Table structure for table `social_category`
--

DROP TABLE IF EXISTS `social_category`;
CREATE TABLE IF NOT EXISTS `social_category` (
  `social_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `colour` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `icon` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`social_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `social_category`
--

INSERT INTO `social_category` (`social_category_id`, `name`, `colour`, `icon`, `description`) VALUES
(2, 'Romance', 'danger', 'fa-male', 'This is for romance chat room'),
(3, 'Event', 'primary', 'fa-book', 'This is for event chat room');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_id` int(11) NOT NULL AUTO_INCREMENT,
  `admission_number` int(11) NOT NULL,
  `student_code` int(11) DEFAULT NULL,
  `apaar_id` int(12) DEFAULT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `age` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `place_birth` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `m_tongue` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religion` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blood_group` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pincode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_address` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permanent_pincode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nationality` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `student_photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_id` int(11) DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_occupation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_adhar` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_annual_income` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_designation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_qualification` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_occupation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_photo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_adhar` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_annual_income` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_designation` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_qualification` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardian_address` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` int(11) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `roll` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `admission_date` date DEFAULT NULL,
  `date_of_joining` date DEFAULT NULL,
  `transport_id` int(11) DEFAULT NULL,
  `transport_mode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pick_area` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pick_stand` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pick_route_id` int(11) DEFAULT NULL,
  `pick_driver_id` int(11) DEFAULT NULL,
  `drop_area` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `drop_stand` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `drop_route_id` int(11) DEFAULT NULL,
  `drop_driver_id` int(11) DEFAULT NULL,
  `transport_months` text COLLATE utf8_unicode_ci,
  `dormitory_id` int(11) DEFAULT NULL,
  `house_id` int(11) DEFAULT NULL,
  `student_category_id` int(11) DEFAULT NULL,
  `admission_category` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caste` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `club_id` int(11) DEFAULT NULL,
  `session` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adhar_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ps_attended` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ps_address` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `ps_purpose` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_study` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_leaving` date DEFAULT NULL,
  `am_date` date DEFAULT NULL,
  `tran_cert` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob_cert` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mark_join` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `physical_h` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transfer_certificate_doc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `father_adharcard_doc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mother_adharcard_doc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `income_certificate_doc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob_proof_doc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `migration_certificate_doc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `caste_certificate_doc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aadhar_card_doc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address_proof_doc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`student_id`),
  UNIQUE KEY `email` (`email`),
  KEY `class_id` (`class_id`),
  KEY `section_id` (`section_id`),
  KEY `father_id` (`father_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student`
--

--
-- Example data for table `student`
--

INSERT INTO `student` (`student_id`, `admission_number`, `student_code`, `apaar_id`, `name`, `birthday`, `age`, `sex`, `religion`, `blood_group`, `address`, `city`, `state`, `nationality`, `phone`, `email`, `password`, `class_id`, `section_id`, `father_name`, `father_phone`, `father_email`, `father_occupation`, `father_designation`, `father_qualification`, `father_annual_income`, `mother_name`, `mother_phone`, `mother_email`, `mother_occupation`, `mother_designation`, `mother_qualification`, `roll`, `transport_id`, `dormitory_id`, `house_id`, `student_category_id`, `club_id`, `session`, `admission_date`, `date_of_leaving`) 
VALUES 
(11, 101, 1001, 123456, 'John Smith', '2005-05-15', '18', 'male', 'Christianity', 'O+', '123 Main Street', 'New Delhi', 'Delhi', 'Indian', '9876543210', 'john.smith@student.com', SHA1('password123'), 2, 1, 'Robert Smith', '9876543211', 'robert.smith@parent.com', 'Engineer', 'Senior Engineer', 'B.Tech', '1200000', 'Mary Smith', '9876543212', 'mary.smith@parent.com', 'Teacher', 'Assistant Teacher', 'M.A.', '101', 1, 0, 2, 2, 0, '2023-2024', '2022-06-05', '2024-05-31'),
(12, 102, 1002, 654321, 'Sarah Johnson', '2006-08-20', '17', 'female', 'Hinduism', 'B+', '456 Park Avenue', 'Mumbai', 'Maharashtra', 'Indian', '8765432109', 'sarah.johnson@student.com', SHA1('password456'), 2, 1, 'James Johnson', '8765432108', 'james.johnson@parent.com', 'Doctor', 'Surgeon', 'MBBS, MD', '2500000', 'Emily Johnson', '8765432107', 'emily.johnson@parent.com', 'Lawyer', 'Senior Advocate', 'LLB', '102', 2, 0, 1, 2, 0, '2023-2024', '2021-06-10', '2024-05-31');

-- --------------------------------------------------------

--
-- Table structure for table `transfer_certificate`
--

DROP TABLE IF EXISTS `transfer_certificate`;
CREATE TABLE IF NOT EXISTS `transfer_certificate` (
  `tc_id` int(11) NOT NULL AUTO_INCREMENT,
  `tc_no` varchar(50) NOT NULL,
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `admission_number` varchar(50) NOT NULL,
  `father_name` varchar(100) NOT NULL,
  `mother_name` varchar(100) NOT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `qualified` varchar(50) DEFAULT NULL,
  `date_of_admission` date NOT NULL,
  `date_of_leaving` date NOT NULL,
  `student_class` varchar(50) NOT NULL,
  `to_class` varchar(50) DEFAULT NULL,
  `class_in_words` varchar(100) DEFAULT NULL,
  `admit_class` varchar(50) DEFAULT NULL,
  `fees_paid_up_to` date DEFAULT NULL,
  `fees_concession_availed` varchar(50) DEFAULT NULL,
  `max_attendance` varchar(20) DEFAULT NULL,
  `obtained_attendance` varchar(20) DEFAULT NULL,
  `last_attendance_date` date DEFAULT NULL,
  `tc_charge` varchar(20) DEFAULT NULL,
  `exam_in` varchar(100) DEFAULT NULL,
  `whether_failed`   varchar(50) DEFAULT NULL,
  `subject` text DEFAULT NULL,
  `games_played` text DEFAULT NULL,
  `extra_activity` text DEFAULT NULL,
  `general_conduct` varchar(50) DEFAULT NULL,
  `behavior_remarks` text DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `date_of_issue` date NOT NULL,
  `roll_no` varchar(50) DEFAULT NULL,
  `issue_status` varchar(20) DEFAULT 'issued',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`tc_id`),
  UNIQUE KEY `tc_no` (`tc_no`),
  KEY `student_id` (`student_id`),
  KEY `admission_number` (`admission_number`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `transfer_certificate`
--

INSERT IGNORE INTO `transfer_certificate` (`tc_no`, `student_id`, `student_name`, `admission_number`, `father_name`, `mother_name`, `nationality`, `category`, `date_of_birth`, `qualified`, `date_of_admission`, `date_of_leaving`, `student_class`, `to_class`, `class_in_words`, `admit_class`, `fees_paid_up_to`, `fees_concession_availed`, `max_attendance`, `obtained_attendance`, `last_attendance_date`, `tc_charge`, `exam_in`, `whether_failed`, `subject`, `games_played`, `extra_activity`, `general_conduct`, `behavior_remarks`, `reason`, `remarks`, `date_of_issue`, `roll_no`, `issue_status`) 
VALUES 
('TC/2024/1', 11, 'John Smith', '101', 'Robert Smith', 'Mary Smith', 'Indian', 'General', '2005-05-15', 'Yes', '2022-06-05', '2024-05-31', 'Class X', 'Class XI', 'Tenth', 'Class VI', '2024-05-31', 'No', '220', '210', '2024-05-31', 'Yes', 'Annual Examination 2024', 'No', 'English, Mathematics, Science, Social Studies, Hindi', 'Cricket, Football', 'Debate Club, Science Club', 'Excellent', 'Well-mannered student with leadership qualities', 'Completed education at this institution', 'Recommended for higher studies', '2024-06-05', '101', 'issued'),
('TC/2024/2', 12, 'Sarah Johnson', '102', 'James Johnson', 'Emily Johnson', 'Indian', 'General', '2006-08-20', 'Yes', '2021-06-10', '2024-05-31', 'Class X', 'Class XI', 'Tenth', 'Class V', '2024-05-31', 'No', '220', '195', '2024-05-31', 'Yes', 'Annual Examination 2024', 'No', 'English, Mathematics, Science, Social Studies, Hindi', 'Basketball, Badminton', 'Art Club, Dance Club', 'Good', 'Sincere and hardworking student', 'Parental relocation', 'Wishes well for future academic endeavors', '2024-06-05', '102', 'issued');

-- --------------------------------------------------------

--
-- Table structure for table `student_category`
--

DROP TABLE IF EXISTS `student_category`;
CREATE TABLE IF NOT EXISTS `student_category` (
  `student_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`student_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_category`
--

INSERT INTO `student_category` (`student_category_id`, `name`, `description`) VALUES
(2, 'Boarding Student', 'This is for the boarding student.');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `subject_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `class_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  PRIMARY KEY (`subject_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `name`, `class_id`, `teacher_id`) VALUES
(5, 'Economics', 2, 1),
(4, 'Mathematics', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `role` longtext COLLATE utf8_unicode_ci NOT NULL,
  `teacher_number` longtext COLLATE utf8_unicode_ci NOT NULL,
  `birthday` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `religion` longtext COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `facebook` longtext COLLATE utf8_unicode_ci NOT NULL,
  `twitter` longtext COLLATE utf8_unicode_ci NOT NULL,
  `googleplus` longtext COLLATE utf8_unicode_ci NOT NULL,
  `linkedin` longtext COLLATE utf8_unicode_ci NOT NULL,
  `qualification` longtext COLLATE utf8_unicode_ci NOT NULL,
  `marital_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  `file_name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `date_of_joining` longtext COLLATE utf8_unicode_ci NOT NULL,
  `joining_salary` longtext COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `date_of_leaving` longtext COLLATE utf8_unicode_ci NOT NULL,
  `bank_id` int(11) NOT NULL,
  `login_status` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`teacher_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `role`, `teacher_number`, `birthday`, `sex`, `religion`, `blood_group`, `address`, `phone`, `email`, `facebook`, `twitter`, `googleplus`, `linkedin`, `qualification`, `marital_status`, `file_name`, `password`, `department_id`, `designation_id`, `date_of_joining`, `joining_salary`, `status`, `date_of_leaving`, `bank_id`, `login_status`) VALUES
(1, 'Udemy Teacher', '1', 'f82e5cc', '2018-08-19', 'male', 'Christianity', 'B+', '546787, Kertz shopping complext, Silicon Valley, United State of America, New York city.', '+912345667', 'teacher@teacher.com', 'facebook', 'twitter', 'googleplus', 'linkedin', 'PhD', 'Married', 'profile.png', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 2, 4, '2019-09-15', '5000', 1, '2019-09-18', 3, '0');

-- --------------------------------------------------------

--
-- Table structure for table `transport`
--

DROP TABLE IF EXISTS `transport`;
CREATE TABLE IF NOT EXISTS `transport` (
  `transport_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `transport_route_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `route_fare` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transport_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `transport_route`
--

DROP TABLE IF EXISTS `transport_route`;
CREATE TABLE IF NOT EXISTS `transport_route` (
  `transport_route_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`transport_route_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transport_route`
--

INSERT INTO `transport_route` (`transport_route_id`, `name`, `description`) VALUES
(2, 'Toronto to Usa', 'This is vehicle is going from Canada to Usa'),
(3, 'Lagos to Canada', 'This is going to Canada');

-- --------------------------------------------------------

--
-- Table structure for table `vacancy`
--

DROP TABLE IF EXISTS `vacancy`;
CREATE TABLE IF NOT EXISTS `vacancy` (
  `vacancy_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `number_of_vacancies` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `last_date` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`vacancy_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vacancy`
--

INSERT INTO `vacancy` (`vacancy_id`, `name`, `number_of_vacancies`, `last_date`) VALUES
(3, 'Position for class teachers', '4', '2019-12-21');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
CREATE TABLE IF NOT EXISTS `vehicle` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_number` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_model` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vehicle_quantity` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `year_made` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `driver_name` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `driver_license` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `driver_contact` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `name`, `vehicle_number`, `vehicle_model`, `vehicle_quantity`, `year_made`, `driver_name`, `driver_license`, `driver_contact`, `description`, `status`) VALUES
(2, 'Toyota', '423', 'Camry', '2', '2019', 'Udemy Sheg', 'License', 'Contact address here', 'description here', 'available');

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
