-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 12, 2022 at 01:07 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fypfinal`
--

-- --------------------------------------------------------

--
-- Table structure for table `Goal`
--

CREATE TABLE `Goal` (
  `GOAL_ID` char(5) NOT NULL,
  `NAME` varchar(90) DEFAULT NULL,
  `PERCENTAGE` decimal(3,2) DEFAULT NULL,
  `DESCRIPTION` varchar(1000) DEFAULT NULL,
  `PROJ_ID` char(5) NOT NULL,
  `STUDENT_ID` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Goal`
--

INSERT INTO `Goal` (`GOAL_ID`, `NAME`, `PERCENTAGE`, `DESCRIPTION`, `PROJ_ID`, `STUDENT_ID`) VALUES
('GO001', 'Initial goal', '0.30', 'Finding the goal of the project', 'PR001', 'channg');

-- --------------------------------------------------------

--
-- Table structure for table `Mark`
--

CREATE TABLE `Mark` (
  `MARK_ID` char(5) NOT NULL,
  `NAME` varchar(90) DEFAULT NULL,
  `PATH` varchar(1000) DEFAULT NULL,
  `PERCENTAGE` decimal(3,2) DEFAULT NULL,
  `IS_MARKED` bit(1) DEFAULT NULL,
  `SUPERVISOR_ID` varchar(20) NOT NULL,
  `STUDENT_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `Meeting`
--

CREATE TABLE `Meeting` (
  `MEET_ID` char(5) NOT NULL,
  `NAME` varchar(90) DEFAULT NULL,
  `PLACE` varchar(500) DEFAULT NULL,
  `TIME` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DURATION` decimal(4,0) DEFAULT NULL,
  `STUDENT_ID` varchar(20) NOT NULL,
  `SUPERVISOR_ID` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Meeting`
--

INSERT INTO `Meeting` (`MEET_ID`, `NAME`, `PLACE`, `TIME`, `DURATION`, `STUDENT_ID`, `SUPERVISOR_ID`) VALUES
('MT001', 'Project Planning Discussion', 'Google Meet', '2022-04-11 02:19:00', '60', 'channg', 'Mayind46');

-- --------------------------------------------------------

--
-- Table structure for table `Project`
--

CREATE TABLE `Project` (
  `PROJ_ID` char(5) NOT NULL,
  `NAME` varchar(90) DEFAULT NULL,
  `DESCRIPTION` varchar(1000) DEFAULT NULL,
  `STUDENT_ID` varchar(20) DEFAULT NULL,
  `SUPERVISOR_ID` varchar(20) DEFAULT NULL,
  `BACKUP_DESCRIPTION` varchar(1000) DEFAULT NULL,
  `APPROVED_SUPERVISOR` bit(1) DEFAULT NULL,
  `APPROVED_ADMIN` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Project`
--

INSERT INTO `Project` (`PROJ_ID`, `NAME`, `DESCRIPTION`, `STUDENT_ID`, `SUPERVISOR_ID`, `BACKUP_DESCRIPTION`, `APPROVED_SUPERVISOR`, `APPROVED_ADMIN`) VALUES
('PR001', 'Lorem Project 3', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'channg', 'Mayind46', 'none', b'1', b'1'),
('PR002', 'Lorem Project 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', NULL, 'Mayind46', NULL, b'1', b'1'),
('PR003', 'Lorem Project 4', 'orem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 'hewgiyew', 'Suche1946', 'none', b'1', b'1'),
('PR004', 'Lorem Project 2', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', NULL, 'nashrin', NULL, b'1', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE `Student` (
  `STUDENT_ID` varchar(10) NOT NULL,
  `NAME` varchar(90) DEFAULT NULL,
  `PASSWORD` varchar(70) NOT NULL,
  `AGE` decimal(10,0) DEFAULT NULL,
  `EMAIL` varchar(80) DEFAULT NULL,
  `ISVERIFIED` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`STUDENT_ID`, `NAME`, `PASSWORD`, `AGE`, `EMAIL`, `ISVERIFIED`) VALUES
('channg', 'Chan Cher Huang', '4b381ddf', '21', 'chanhuang@hotmail.com', b'1'),
('hewgiyew', 'Hew Giap Yew', '66c66532', '21', 'hewgiyew@kuppusamy.com', b'1'),
('kiatatern', 'Kia Tat Ern', '2e494067', '21', 'kiatatern@yahoo.com', b'0'),
('mohamus', 'Mohamed Haji Nik Fakhrullah bin Idrus', '3e6d8257', '21', 'mohamus@gmail.com', b'1'),
('mohdchfli', 'Mohd Che Zaqiyuddin Zainordin bin Zulkefli', '07c7054e', '21', 'chezaq@hotmail.com', b'1'),
('quahkik', 'Quah Kai Nik', '913b3935', '21', 'quahnik@gmail.com', b'1'),
('ramyesh', 'Ramya Gnanalingam a/p Ganesh', 'befb05a5', '21', 'ramyaganesh@yahoo.com', b'0'),
('rasampan', 'Rasammah a/l Janil Velappan', 'e4f559f7', '21', 'rasamjanil@hotmail.com', b'1'),
('syamiril', 'Syamien binti Azril', '12df66bc', '21', 'syamiril@ratnam.com', b'1'),
('zhanik', 'Zhang Sih Pik', 'a10e5c2d', '21', 'zhanik@yahoo.com', b'0');

-- --------------------------------------------------------

--
-- Table structure for table `Supervisor`
--

CREATE TABLE `Supervisor` (
  `SUPERVISOR_ID` varchar(10) NOT NULL,
  `NAME` varchar(90) DEFAULT NULL,
  `PASSWORD` varchar(70) NOT NULL,
  `AGE` decimal(10,0) DEFAULT NULL,
  `EMAIL` varchar(80) DEFAULT NULL,
  `PROFESSION` varchar(100) DEFAULT NULL,
  `ISVERIFIED` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Supervisor`
--

INSERT INTO `Supervisor` (`SUPERVISOR_ID`, `NAME`, `PASSWORD`, `AGE`, `EMAIL`, `PROFESSION`, `ISVERIFIED`) VALUES
('kevintat', 'Kevin Thum Thian Liat', '1201d208', '40', 'kevinliat@hotmail.com', 'Professor', b'0'),
('Mayind46', 'Ryan A. Price', 'Ood5Theph', '30', 'RyanAPrice@jourrapide.com', 'Lecturer', b'1'),
('nashrin', 'Nashrah Sobirin binti Shamsuddin', 'd230ffa5', '31', 'nashrahsam@hotmail.com', 'Senior Lecturer', b'1'),
('newjonhup', 'New Jong Hup', 'a063c1ad', '35', 'jonhup@hotmail.com', 'Senior Lecturer', b'1'),
('Suche1946', 'Hu Hsia', 'TuuS3eeque', '28', 'HuHsia@teleworm.us', 'Lecturer', b'1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Goal`
--
ALTER TABLE `Goal`
  ADD PRIMARY KEY (`GOAL_ID`);

--
-- Indexes for table `Mark`
--
ALTER TABLE `Mark`
  ADD PRIMARY KEY (`MARK_ID`);

--
-- Indexes for table `Meeting`
--
ALTER TABLE `Meeting`
  ADD PRIMARY KEY (`MEET_ID`);

--
-- Indexes for table `Project`
--
ALTER TABLE `Project`
  ADD PRIMARY KEY (`PROJ_ID`);

--
-- Indexes for table `Student`
--
ALTER TABLE `Student`
  ADD PRIMARY KEY (`STUDENT_ID`);

--
-- Indexes for table `Supervisor`
--
ALTER TABLE `Supervisor`
  ADD PRIMARY KEY (`SUPERVISOR_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
