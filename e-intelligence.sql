-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2020 at 11:12 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-intelligence`
--

-- --------------------------------------------------------

--
-- Table structure for table `analysis_revi`
--

CREATE TABLE `analysis_revi` (
  `id` int(11) NOT NULL,
  `skill_name` varchar(250) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `skill_value` int(11) NOT NULL,
  `type_analysis` int(11) NOT NULL,
  `updated` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `analysis_revi`
--

INSERT INTO `analysis_revi` (`id`, `skill_name`, `institution_id`, `skill_value`, `type_analysis`, `updated`) VALUES
(1, 'python', 17, 3, 1, '2020-11-09'),
(2, 'java', 17, 2, 1, '2020-11-09'),
(3, 'C++ Programming', 17, 4, 1, '2020-11-09'),
(4, 'php', 17, 2, 1, '2020-11-09'),
(14, 'python', 17, 1, 2, '2020-11-09'),
(15, 'java', 17, 1, 2, '2020-11-09'),
(16, 'C++ Programming', 17, 2, 2, '2020-11-09'),
(20, 'python', 0, 1, 3, '2020-11-09'),
(21, 'java', 0, 1, 3, '2020-11-09'),
(22, 'C++ Programming', 0, 2, 3, '2020-11-09');

-- --------------------------------------------------------

--
-- Table structure for table `curriculum`
--

CREATE TABLE `curriculum` (
  `curriculum_id` int(11) NOT NULL,
  `curriculum` varchar(150) DEFAULT NULL,
  `file_path` varchar(250) NOT NULL,
  `file_type` varchar(250) NOT NULL,
  `file_size` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `institution_admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `curriculum`
--

INSERT INTO `curriculum` (`curriculum_id`, `curriculum`, `file_path`, `file_type`, `file_size`, `status`, `created`, `updated`, `institution_admin_id`) VALUES
(1, 'MUK', 'uploads/docs/76117-HarvestPlus_Uganda_FCT_0(1) original.xls', 'application/vnd.ms-excel', 248320, 1, '2020-04-13 18:41:53', '2020-04-13 18:41:53', 17),
(3, 'MUK96545-HarvestPlus_Uganda_FCT_0(1) original.xls', 'uploads/docs/MUK64320-HarvestPlus_Uganda_FCT_0(1) original.xls', 'application/vnd.ms-excel', 248320, 1, '2020-04-13 20:47:59', '2020-04-13 20:47:59', 17);

-- --------------------------------------------------------

--
-- Table structure for table `employement`
--

CREATE TABLE `employement` (
  `employement_id` varchar(250) NOT NULL,
  `stetus` int(11) DEFAULT 1,
  `date_created` datetime DEFAULT current_timestamp(),
  `date_updated` datetime DEFAULT current_timestamp(),
  `graduate_id` int(11) NOT NULL,
  `grad_year` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `account_con` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employement`
--

INSERT INTO `employement` (`employement_id`, `stetus`, `date_created`, `date_updated`, `graduate_id`, `grad_year`, `employer_id`, `institution_id`, `account_con`) VALUES
('e004', 1, '2020-05-24 10:09:54', '2020-05-24 10:09:54', 26, 2016, 18, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `employer`
--

CREATE TABLE `employer` (
  `id` int(11) NOT NULL,
  `company_name` varchar(45) DEFAULT NULL,
  `logo` varchar(250) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employer`
--

INSERT INTO `employer` (`id`, `company_name`, `logo`, `created`, `updated`, `user_id`) VALUES
(2, 'H', 'uploads/logos/.png', '2020-04-02 19:19:05', '0000-00-00 00:00:00', 18),
(3, 'I', 'uploads/logos/I.png', '2020-04-03 17:12:01', '2020-04-03 17:12:01', 24),
(4, 'K', 'uploads/logos/K.png', '2020-04-03 17:13:49', '2020-04-03 17:13:49', 25);

-- --------------------------------------------------------

--
-- Table structure for table `employment_list`
--

CREATE TABLE `employment_list` (
  `id` int(11) NOT NULL,
  `employment_id` varchar(45) NOT NULL,
  `student_number` varchar(45) NOT NULL,
  `institution_id` int(11) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `updated` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `employment_list`
--

INSERT INTO `employment_list` (`id`, `employment_id`, `student_number`, `institution_id`, `employer_id`, `created`, `updated`) VALUES
(1, 'E001', 'u001', 11, 18, '2020-04-23', '2020-04-23'),
(2, 'E002', 'u002', 11, 18, '2020-04-23', '2020-04-23'),
(3, 'E003', 'u003', 11, 18, '2020-04-23', '2020-04-23'),
(4, 'E004', 'u004', 11, 18, '2020-04-23', '2020-04-23'),
(5, 'E005', 'u005', 11, 18, '2020-04-23', '2020-04-23'),
(6, 'E006', 'u006', 11, 18, '2020-04-23', '2020-04-23'),
(7, 'E007', 'u007', 11, 18, '2020-04-23', '2020-04-23'),
(8, 'E008', 'u008', 11, 18, '2020-04-23', '2020-04-23'),
(9, 'E009', 'u009', 11, 18, '2020-04-23', '2020-04-23'),
(10, 'E010', 'u010', 11, 18, '2020-04-23', '2020-04-23');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `feedback_content` varchar(250) DEFAULT NULL,
  `field_employment` varchar(250) NOT NULL,
  `programming_language` varchar(250) NOT NULL,
  `comment_status` varchar(45) NOT NULL,
  `employment_id` varchar(45) NOT NULL,
  `employer_id` int(11) NOT NULL,
  `institution_admin_id` int(11) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `feedback_content`, `field_employment`, `programming_language`, `comment_status`, `employment_id`, `employer_id`, `institution_admin_id`, `created`) VALUES
(19, 'I like coding and coding is really good', 'General', 'code', 'positive', 'e004', 18, 11, '2020-05-27'),
(20, 'I like coding and coding is really good', 'Programming', 'Java', 'positive', 'e004', 18, 11, '2020-05-27'),
(21, 'I like coding and coding is really good', 'Programming', 'Java', 'negative', 'e004', 18, 11, '2020-05-27'),
(22, 'I like coding and coding is really good', 'General', 'code', 'positive', '', 18, 11, '2020-05-27'),
(23, 'I like coding and coding is really good', 'Programming', 'C++', 'positive', '', 18, 11, '2020-05-27'),
(24, 'I like coding and coding is really good', 'Application-Design', 'C#', 'positive', 'e004', 18, 11, '2020-05-27'),
(25, 'I like coding and coding is really good', 'Application-Development', 'Python', 'positive', '', 18, 11, '2020-05-27');

-- --------------------------------------------------------

--
-- Table structure for table `graduate`
--

CREATE TABLE `graduate` (
  `id` int(11) NOT NULL,
  `institution_id` int(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `student_number` varchar(250) NOT NULL,
  `account_con` int(11) NOT NULL DEFAULT 0,
  `profile_pic` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `graduate`
--

INSERT INTO `graduate` (`id`, `institution_id`, `created`, `updated`, `user_id`, `student_number`, `account_con`, `profile_pic`) VALUES
(2, 17, '2020-04-05 13:51:40', '2020-04-05 13:51:40', 26, 'u004', 0, 'uploads/logos/student_1.png'),
(3, 17, '2020-04-05 13:53:43', '2020-04-05 13:53:43', 27, 'u005', 0, 'uploads/logos/student_1.png'),
(4, 17, '2020-04-05 13:55:08', '2020-04-05 13:55:08', 28, 'u006', 0, 'uploads/logos/student_1.png');

-- --------------------------------------------------------

--
-- Table structure for table `graduate_list`
--

CREATE TABLE `graduate_list` (
  `graduate_list_id` int(11) NOT NULL,
  `student_name` varchar(250) DEFAULT NULL,
  `student_number` varchar(45) DEFAULT NULL,
  `course` varchar(250) NOT NULL,
  `year` varchar(45) NOT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT NULL,
  `institution_admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `graduate_list`
--

INSERT INTO `graduate_list` (`graduate_list_id`, `student_name`, `student_number`, `course`, `year`, `created`, `updated`, `institution_admin_id`) VALUES
(2, 'grad_1  grad_1', 'u004', 'IT', '2016', '2020-04-07 21:29:19', '2020-04-07 21:29:19', 11),
(3, 'grad_2  grad_2', 'u005', 'IT', '2016', '2020-04-07 21:29:19', '2020-04-07 21:29:19', 11),
(4, 'grad_3 grad_3', 'u006', 'IT', '2016', '2020-04-07 21:29:19', '2020-04-07 21:29:19', 11),
(5, 'grad_4  grad_4', 'u007', 'IT', '2016', '2020-04-07 21:29:19', '2020-04-07 21:29:19', 11),
(6, 'grad_5  grad_5', 'u008', 'IT', '2016', '2020-04-07 21:29:19', '2020-04-07 21:29:19', 11),
(7, 'grad_6  grad_6', 'u009', 'IT', '2016', '2020-04-07 21:29:19', '2020-04-07 21:29:19', 11),
(8, 'grad_7  grad_7', 'u010', 'IT', '2016', '2020-04-07 21:29:19', '2020-04-07 21:29:19', 11),
(9, 'grad_8  grad_8', 'u011', 'IT', '2016', '2020-04-07 21:29:19', '2020-04-07 21:29:19', 11),
(10, 'grad_9  grad_9', 'u012', 'IT', '2016', '2020-04-07 21:29:19', '2020-04-07 21:29:19', 11),
(11, 'grad_10  grad_10', 'u013', 'IT', '2016', '2020-04-07 21:29:19', '2020-04-07 21:29:19', 11);

-- --------------------------------------------------------

--
-- Table structure for table `institution_admin`
--

CREATE TABLE `institution_admin` (
  `id` int(11) NOT NULL,
  `institution_name` varchar(45) DEFAULT NULL,
  `logo` varchar(250) NOT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `institution_admin`
--

INSERT INTO `institution_admin` (`id`, `institution_name`, `logo`, `created`, `updated`, `user_id`) VALUES
(11, 'M', 'uploads/logos/M.png', '2020-04-02 19:12:20', '0000-00-00 00:00:00', 17),
(12, 'N', 'uploads/logos/N.png', '2020-04-03 17:07:26', '2020-04-03 17:07:26', 22),
(13, 'O', 'uploads/logos/O.png', '2020-04-03 17:08:17', '2020-04-03 17:08:17', 23);

-- --------------------------------------------------------

--
-- Table structure for table `institution_ranking`
--

CREATE TABLE `institution_ranking` (
  `institution_id` int(11) NOT NULL,
  `rank_points` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `institution_ranking`
--

INSERT INTO `institution_ranking` (`institution_id`, `rank_points`) VALUES
(11, 14);

-- --------------------------------------------------------

--
-- Table structure for table `programming_languages`
--

CREATE TABLE `programming_languages` (
  `id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `programming_languages`
--

INSERT INTO `programming_languages` (`id`, `name`) VALUES
(5, 'code'),
(6, 'Java'),
(7, 'C++'),
(8, 'C#'),
(9, 'Python');

-- --------------------------------------------------------

--
-- Table structure for table `skill`
--

CREATE TABLE `skill` (
  `skill_id` int(11) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `rating` int(11) DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `date_created` datetime DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `employer_id` int(11) DEFAULT NULL,
  `institution_admin_id` int(11) DEFAULT NULL,
  `doc_path` varchar(250) NOT NULL,
  `file_type` varchar(250) NOT NULL,
  `file_size` int(11) NOT NULL,
  `scouted` int(11) NOT NULL DEFAULT 0,
  `doc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `skill`
--

INSERT INTO `skill` (`skill_id`, `Name`, `rating`, `user_id`, `date_created`, `date_updated`, `employer_id`, `institution_admin_id`, `doc_path`, `file_type`, `file_size`, `scouted`, `doc_id`) VALUES
(26, 'python', 0, 0, '2020-05-24 09:57:53', '2020-05-24 09:57:53', 18, 17, 'uploads/skills/29955-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 1, 29955),
(27, 'java', 2, 0, '2020-05-24 09:58:06', '2020-05-24 09:58:06', 18, 17, 'uploads/skills/31337-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 1, 31337),
(28, 'C++ Programming', 0, 0, '2020-05-24 09:58:29', '2020-05-24 09:58:29', 18, 17, 'uploads/skills/84212-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 1, 84212),
(29, 'C++ Programming', 0, 0, '2020-05-24 09:58:46', '2020-05-24 09:58:46', 18, 17, 'uploads/skills/15728-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 1, 15728),
(30, 'rust', 1, 0, '2020-05-24 09:59:13', '2020-05-24 09:59:13', 18, 0, 'uploads/skills/24779-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 0, 24779),
(31, 'php', 2, 0, '2020-05-24 09:59:54', '2020-05-24 09:59:54', 18, 0, 'uploads/skills/49090-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 0, 49090),
(32, 'python', 2, 26, '2020-05-24 10:15:32', '2020-05-24 10:15:32', 18, 17, 'uploads/skills/54785-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 2, 54785),
(33, 'php', 1, 26, '2020-05-24 10:16:06', '2020-05-24 10:16:06', 18, 17, 'uploads/skills/42066-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 2, 42066),
(34, 'C++ Programming', 2, 26, '2020-05-24 10:16:19', '2020-05-24 10:16:19', 18, 17, 'uploads/skills/93866-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 2, 93866),
(35, 'php', 0, 19, '2020-05-24 10:55:23', '2020-05-24 10:55:23', 18, 17, 'uploads/skills/87040-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 1, 87040),
(36, 'C++ Programming', 0, 19, '2020-05-24 10:55:38', '2020-05-24 10:55:38', 18, 17, 'uploads/skills/35310-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 1, 35310),
(37, 'java', 0, 19, '2020-05-24 10:55:55', '2020-05-24 10:55:55', 18, 17, 'uploads/skills/61521-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 2, 61521),
(38, 'python', 2, 19, '2020-05-24 10:56:10', '2020-05-24 10:56:10', 18, 17, 'uploads/skills/60441-Quotation.xlsx', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 12126, 1, 60441);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `institution_id` int(45) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `updated` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `student_number` varchar(250) NOT NULL,
  `account_con` int(11) NOT NULL DEFAULT 0,
  `profile_pic` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `institution_id`, `created`, `updated`, `user_id`, `student_number`, `account_con`, `profile_pic`) VALUES
(2, 17, '2020-04-03 17:04:07', '0000-00-00 00:00:00', 19, 'u001', 0, 'uploads/logos/student_1.png'),
(3, 17, '2020-04-03 17:05:17', '2020-04-03 17:05:17', 20, 'u002', 0, ''),
(4, 17, '2020-04-03 17:05:50', '2020-04-03 17:05:50', 21, 'u003', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `student_list`
--

CREATE TABLE `student_list` (
  `graduate_list_id` int(11) NOT NULL,
  `student_name` varchar(45) NOT NULL,
  `student_number` varchar(250) NOT NULL,
  `course` varchar(250) NOT NULL,
  `year` int(11) NOT NULL,
  `created` date NOT NULL DEFAULT current_timestamp(),
  `updated` date NOT NULL,
  `institution_admin_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_list`
--

INSERT INTO `student_list` (`graduate_list_id`, `student_name`, `student_number`, `course`, `year`, `created`, `updated`, `institution_admin_id`) VALUES
(1, 'student_1  student_1', 'u001', 'IT', 2016, '2020-04-07', '2020-04-07', 11),
(2, 'student_2  student_2', 'u002', 'IT', 2016, '2020-04-07', '2020-04-07', 11),
(3, 'student_3  student_3', 'u003', 'IT', 2016, '2020-04-07', '2020-04-07', 11),
(4, 'student_4  student_4', 'u004', 'IT', 2016, '2020-04-07', '2020-04-07', 11),
(5, 'student_5  student_5', 'u005', 'IT', 2016, '2020-04-07', '2020-04-07', 11),
(6, 'student_6  student_6', 'u006', 'IT', 2016, '2020-04-07', '2020-04-07', 11),
(7, 'student_7  student_7', 'u007', 'IT', 2016, '2020-04-07', '2020-04-07', 11),
(8, 'student_8  student_8', 'u008', 'IT', 2016, '2020-04-07', '2020-04-07', 11),
(9, 'student_9  student_9', 'u009', 'IT', 2016, '2020-04-07', '2020-04-07', 11),
(10, 'student_10  student_10', 'u010', 'IT', 2016, '2020-04-07', '2020-04-07', 11),
(11, 'grad_8  grad_8', 'u011', 'BSSE', 2017, '2020-04-16', '2020-04-16', 11),
(12, 'grad_9  grad_9', 'u012', 'BSSE', 2017, '2020-04-16', '2020-04-16', 11),
(13, 'grad_10  grad_10', 'u013', 'BSSE', 2017, '2020-04-16', '2020-04-16', 11);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_info`
--

CREATE TABLE `tbl_info` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_info`
--

INSERT INTO `tbl_info` (`id`, `name`, `description`, `date`) VALUES
(26, 'Kids Dresses', ' Fancy party dreasses for kids', '2020-03-29 12:27:17'),
(27, 'Toys', 'Mechanical and battery toys', '2020-03-29 12:27:17'),
(28, 'Snacks', 'Creamy cakes and sweets', '2020-03-29 12:27:17'),
(29, 'Stationaries', 'Books and notebooks, craft papers', '2020-03-29 12:27:17'),
(30, 'Tools', 'First aid tools', '2020-03-29 12:27:17');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `username` varchar(250) NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `contact` varchar(45) DEFAULT NULL,
  `account_type` varchar(45) DEFAULT NULL,
  `password` varchar(45) DEFAULT NULL,
  `Other_details` varchar(145) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `username`, `email`, `contact`, `account_type`, `password`, `Other_details`) VALUES
(17, 'registrar   ', 'MUK', 'MUK', 'doomxbox370@gmail.com', '', 'registrar', '(Admin123456)', NULL),
(18, 'Emp_1', 'Emp_1', 'Emp_1', 'ahmedswalik@gmail.com', '0000000000', 'employer', '(Admin123456)', NULL),
(19, 'student_1', 'student_1', 'student_1', 'doomxbox370@gmail.com', '0000000000', 'student', '(Admin123456)', NULL),
(20, 'student_2', 'student_2', 'student_2', 'doomxbox370@gmail.com', NULL, 'student', '(Admin123456)', NULL),
(21, 'student_3', 'student_3', 'student_3', 'doomxbox370@gmail.com', NULL, 'student', '(Admin123456)', NULL),
(22, 'Reg_2', 'Reg_2', 'Reg_2', 'doomxbox370@gmail.com', NULL, 'registrar', '(Admin123456)', NULL),
(23, 'Reg_3', 'Reg_3', 'Reg_3', 'doomxbox370@gmail.com', NULL, 'registrar', '(Admin123456)', NULL),
(24, 'Emp_2', 'Emp_2', 'Emp_2', 'doomxbox370@gmail.com', NULL, 'employer', '(Admin123456)', NULL),
(25, 'Emp_3', 'Emp_3', 'Emp_3', 'doomxbox370@gmail.com', NULL, 'employer', '(Admin123456)', NULL),
(26, 'grad_1', 'grad_1', 'grad_1', 'doomxbox370@gmail.com', NULL, 'graduate', '(Admin123456)', NULL),
(27, 'grad_2', 'grad_2', 'grad_2', 'doomxbox370@gmail.com', NULL, 'graduate', '(Admin123456)', NULL),
(28, 'grad_3', 'grad_3', 'grad_3', 'doomxbox370@gmail.com', NULL, 'graduate', '(Admin123456)', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `analysis_revi`
--
ALTER TABLE `analysis_revi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `curriculum`
--
ALTER TABLE `curriculum`
  ADD PRIMARY KEY (`curriculum_id`);

--
-- Indexes for table `employement`
--
ALTER TABLE `employement`
  ADD PRIMARY KEY (`employement_id`);

--
-- Indexes for table `employer`
--
ALTER TABLE `employer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employment_list`
--
ALTER TABLE `employment_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `graduate`
--
ALTER TABLE `graduate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `graduate_list`
--
ALTER TABLE `graduate_list`
  ADD PRIMARY KEY (`graduate_list_id`);

--
-- Indexes for table `institution_admin`
--
ALTER TABLE `institution_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `institution_ranking`
--
ALTER TABLE `institution_ranking`
  ADD PRIMARY KEY (`institution_id`);

--
-- Indexes for table `programming_languages`
--
ALTER TABLE `programming_languages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skill`
--
ALTER TABLE `skill`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_list`
--
ALTER TABLE `student_list`
  ADD PRIMARY KEY (`graduate_list_id`);

--
-- Indexes for table `tbl_info`
--
ALTER TABLE `tbl_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `analysis_revi`
--
ALTER TABLE `analysis_revi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `curriculum`
--
ALTER TABLE `curriculum`
  MODIFY `curriculum_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `employer`
--
ALTER TABLE `employer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employment_list`
--
ALTER TABLE `employment_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `graduate`
--
ALTER TABLE `graduate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `graduate_list`
--
ALTER TABLE `graduate_list`
  MODIFY `graduate_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `institution_admin`
--
ALTER TABLE `institution_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `programming_languages`
--
ALTER TABLE `programming_languages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `skill`
--
ALTER TABLE `skill`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `student_list`
--
ALTER TABLE `student_list`
  MODIFY `graduate_list_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `tbl_info`
--
ALTER TABLE `tbl_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
