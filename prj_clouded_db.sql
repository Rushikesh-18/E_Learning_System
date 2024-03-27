-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2024 at 12:23 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prj_clouded_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `ass_id` int(9) NOT NULL,
  `ass_name` varchar(100) NOT NULL,
  `ass_desc` varchar(500) NOT NULL,
  `ass_type` varchar(20) NOT NULL,
  `ass_path` varchar(200) NOT NULL,
  `ass_date` date NOT NULL,
  `ass_status` tinyint(1) NOT NULL,
  `cr_id` int(9) NOT NULL,
  `uid` int(9) NOT NULL,
  `ass_sub_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignment`
--

INSERT INTO `assignment` (`ass_id`, `ass_name`, `ass_desc`, `ass_type`, `ass_path`, `ass_date`, `ass_status`, `cr_id`, `uid`, `ass_sub_date`) VALUES
(1, 'myAssignment', 'none', 'File', './uploads/classroom/11_20240309122018.pdf', '2024-03-09', 1, 1, 11, '2024-03-10');

-- --------------------------------------------------------

--
-- Table structure for table `assignment_answer`
--

CREATE TABLE `assignment_answer` (
  `aa_id` int(9) NOT NULL,
  `ans_path` varchar(100) NOT NULL,
  `marks` double(10,2) NOT NULL,
  `remark` varchar(500) NOT NULL,
  `ass_id` int(9) NOT NULL,
  `euid` int(9) NOT NULL,
  `aa_date` date NOT NULL,
  `aa_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `chat_id` int(9) NOT NULL,
  `chat_desc` varchar(500) NOT NULL,
  `chat_date` date NOT NULL,
  `chat_status` tinyint(1) NOT NULL,
  `cr_id` int(9) NOT NULL,
  `euid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classrooms`
--

CREATE TABLE `classrooms` (
  `cr_id` int(9) NOT NULL,
  `cr_name` varchar(50) NOT NULL,
  `cr_desc` varchar(1000) NOT NULL,
  `cr_regdate` datetime NOT NULL,
  `cr_status` tinyint(1) NOT NULL,
  `uid` int(9) NOT NULL,
  `cid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classrooms`
--

INSERT INTO `classrooms` (`cr_id`, `cr_name`, `cr_desc`, `cr_regdate`, `cr_status`, `uid`, `cid`) VALUES
(1, 'My Classroom', 'None', '2024-03-09 00:00:00', 1, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `classroom_student`
--

CREATE TABLE `classroom_student` (
  `cr_st_id` int(9) NOT NULL,
  `cr_id` int(9) NOT NULL,
  `euid` int(9) NOT NULL,
  `cr_st_status` tinyint(1) NOT NULL,
  `cr_st_date` date NOT NULL,
  `uid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `classroom_student`
--

INSERT INTO `classroom_student` (`cr_st_id`, `cr_id`, `euid`, `cr_st_status`, `cr_st_date`, `uid`) VALUES
(1, 1, 2, 1, '2024-03-09', 11);

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `comp_id` int(9) NOT NULL,
  `comp_name` varchar(90) NOT NULL,
  `comp_tag_line` varchar(120) NOT NULL,
  `pro_pra_name` varchar(90) NOT NULL,
  `comp_add` varchar(250) NOT NULL,
  `comp_mob` varchar(13) NOT NULL,
  `comp_mob1` varchar(13) NOT NULL,
  `comp_web` varchar(120) NOT NULL,
  `uid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`comp_id`, `comp_name`, `comp_tag_line`, `pro_pra_name`, `comp_add`, `comp_mob`, `comp_mob1`, `comp_web`, `uid`) VALUES
(1, 'CloudED', 'E-Learning Smart Classroom', 'Rushikesh Pachpute', 'Sangamner', '91309 75938', '91309 75938', 'cloudEd1982@gmail.com', 1);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `cid` int(9) NOT NULL,
  `c_name` varchar(45) NOT NULL,
  `regdate` date NOT NULL,
  `status` tinyint(1) NOT NULL,
  `uid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`cid`, `c_name`, `regdate`, `status`, `uid`) VALUES
(1, 'BE IT', '2024-01-01', 1, 1),
(2, 'MTECH', '2024-01-10', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `end_user`
--

CREATE TABLE `end_user` (
  `euid` int(9) NOT NULL,
  `euname` varchar(30) NOT NULL,
  `eumob` varchar(10) NOT NULL,
  `eupass` varchar(50) NOT NULL,
  `altmob` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `email` varchar(500) NOT NULL,
  `bdate` date NOT NULL,
  `address` varchar(250) NOT NULL,
  `cid` int(9) NOT NULL,
  `euregdate` date NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `end_user`
--

INSERT INTO `end_user` (`euid`, `euname`, `eumob`, `eupass`, `altmob`, `gender`, `email`, `bdate`, `address`, `cid`, `euregdate`, `status`) VALUES
(1, 'Zelos Infotech', '8888789402', '123', '8888789040', 'Female', 'zelosinfotech@gmail.com', '1990-02-19', 'Manchar', 2, '2024-01-10', 1),
(2, 'ABC', '9975508577', '123', '', 'Male', 'subhan.shaikh.786@gmail.com', '1990-12-12', 'Mankeshwar', 1, '2024-01-16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meet`
--

CREATE TABLE `meet` (
  `meet_id` int(9) NOT NULL,
  `meet_name` varchar(100) NOT NULL,
  `meet_desc` varchar(500) NOT NULL,
  `meet_link` varchar(200) NOT NULL,
  `meet_date` date NOT NULL,
  `meet_time` time NOT NULL,
  `meet_regdate` date NOT NULL,
  `meet_status` tinyint(1) NOT NULL,
  `cr_id` int(9) NOT NULL,
  `uid` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(9) NOT NULL,
  `uname` varchar(45) NOT NULL,
  `pass` varchar(20) NOT NULL,
  `uregdate` datetime NOT NULL,
  `utype` int(9) NOT NULL,
  `ustatus` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `uname`, `pass`, `uregdate`, `utype`, `ustatus`) VALUES
(1, 'admin', 'admin', '2024-01-01 00:00:00', 2, 1),
(11, 'Rushikesh', '123', '2024-03-09 16:38:41', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`ass_id`),
  ADD KEY `cr_id` (`cr_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `assignment_answer`
--
ALTER TABLE `assignment_answer`
  ADD PRIMARY KEY (`aa_id`),
  ADD KEY `ass_id` (`ass_id`),
  ADD KEY `euid` (`euid`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`chat_id`),
  ADD KEY `cr_id` (`cr_id`),
  ADD KEY `euid` (`euid`);

--
-- Indexes for table `classrooms`
--
ALTER TABLE `classrooms`
  ADD PRIMARY KEY (`cr_id`),
  ADD KEY `cid` (`cid`),
  ADD KEY `emp_id` (`uid`);

--
-- Indexes for table `classroom_student`
--
ALTER TABLE `classroom_student`
  ADD PRIMARY KEY (`cr_st_id`),
  ADD KEY `cr_id` (`cr_id`),
  ADD KEY `euid` (`euid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`comp_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`cid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `end_user`
--
ALTER TABLE `end_user`
  ADD PRIMARY KEY (`euid`),
  ADD KEY `cid` (`cid`);

--
-- Indexes for table `meet`
--
ALTER TABLE `meet`
  ADD PRIMARY KEY (`meet_id`),
  ADD KEY `cr_id` (`cr_id`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `ass_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment_answer`
--
ALTER TABLE `assignment_answer`
  MODIFY `aa_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `chat_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classrooms`
--
ALTER TABLE `classrooms`
  MODIFY `cr_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classroom_student`
--
ALTER TABLE `classroom_student`
  MODIFY `cr_st_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `company_profile`
--
ALTER TABLE `company_profile`
  MODIFY `comp_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `cid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `end_user`
--
ALTER TABLE `end_user`
  MODIFY `euid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `meet`
--
ALTER TABLE `meet`
  MODIFY `meet_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assignment_answer`
--
ALTER TABLE `assignment_answer`
  ADD CONSTRAINT `assignment_answer_ibfk_1` FOREIGN KEY (`ass_id`) REFERENCES `assignment` (`ass_id`),
  ADD CONSTRAINT `assignment_answer_ibfk_2` FOREIGN KEY (`euid`) REFERENCES `end_user` (`euid`);

--
-- Constraints for table `classroom_student`
--
ALTER TABLE `classroom_student`
  ADD CONSTRAINT `classroom_student_ibfk_1` FOREIGN KEY (`cr_id`) REFERENCES `classrooms` (`cr_id`),
  ADD CONSTRAINT `classroom_student_ibfk_2` FOREIGN KEY (`euid`) REFERENCES `end_user` (`euid`),
  ADD CONSTRAINT `classroom_student_ibfk_3` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD CONSTRAINT `company_profile_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `course_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`);

--
-- Constraints for table `end_user`
--
ALTER TABLE `end_user`
  ADD CONSTRAINT `end_user_ibfk_1` FOREIGN KEY (`cid`) REFERENCES `course` (`cid`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
