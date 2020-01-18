-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 18, 2019 at 08:13 AM
-- Server version: 10.3.11-MariaDB
-- PHP Version: 7.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cdnj_reservation`
--

-- --------------------------------------------------------

--
-- Table structure for table `cdnj_group`
--

CREATE TABLE `cdnj_group` (
  `grId` int(11) NOT NULL,
  `grName` varchar(50) NOT NULL,
  `grParent` varchar(50) NOT NULL,
  `user_perm_level` varchar(10) NOT NULL DEFAULT 'User',
  `grDesc` varchar(255) NOT NULL,
  `grCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cdnj_group`
--

INSERT INTO `cdnj_group` (`grId`, `grName`, `grParent`, `user_perm_level`, `grDesc`, `grCreated`) VALUES
(1, 'Admin', 'IT Group', 'Admin', '', '2019-05-19 14:59:58'),
(2, '예배부', '참된교회', 'User', '예배진행', '2019-05-19 15:00:41'),
(3, '01 소그룹', '1 교구', 'User', '교구모임', '2019-05-19 15:08:46'),
(4, '02 소그룹', '1교구', 'User', '교구모임', '2019-05-19 15:09:18'),
(5, '03 소그룹', '1교구', 'User', '교구모임', '2019-05-19 15:18:44'),
(6, '04 소그룹', '2 교구', 'User', '교구모임', '2019-05-19 15:40:19'),
(7, '05 소그룹', '2교구', 'User', '교구모임', '2019-05-19 15:40:47'),
(8, '06 소그룹', '2교구', 'User', '교구모임', '2019-05-19 15:41:14'),
(9, '07 소그룹', '3 교구', 'User', '교구모임', '2019-05-19 15:58:29'),
(10, '08 소그룹', '3 교구', 'User', '교구모임', '2019-05-19 15:59:26'),
(11, '09 소그룹', '3 교구', 'User', '교구모임', '2019-05-19 16:00:14'),
(12, '10 소그룹', '4 교구', 'User', '교구모임', '2019-05-19 16:01:00'),
(13, '11 소그룹', '4 교구', 'User', '교구모임', '2019-05-19 16:02:27'),
(14, '12 소그룹', '4 교구', 'User', '교구모임', '2019-05-19 16:03:02'),
(15, '13 소그룹', '5 교구', 'User', '교구모임', '2019-05-19 16:03:49'),
(16, '14 소그룹', '5 교구', 'User', '교구모임', '2019-05-19 16:04:23'),
(17, '15 소그룹', '5 교구', 'User', '교구모임', '2019-05-19 16:05:01'),
(18, '16 소그룹', '6 교구', 'User', '교구모임', '2019-05-19 16:05:44'),
(19, '17 소그룹', '6 교구', 'User', '교구모임', '2019-05-19 16:06:22'),
(20, '18 소그룹', '6 교구', 'User', '교구모임', '2019-05-19 16:06:57'),
(21, '대학부', 'Education', 'User', 'College students', '2019-05-19 17:14:07'),
(22, '중고등부', '교육부', 'User', '중고등부', '2019-05-22 09:39:08'),
(23, '영아부', 'Education', 'User', '영아부', '2019-05-22 16:18:18'),
(24, '청년부', 'Education', 'User', 'Young-adult', '2019-05-24 13:17:26'),
(25, '19 소그룹', '7 교구', 'User', '교구모임', '2019-05-28 16:20:51'),
(26, '20 소그룹', '7 교구', 'User', '교구모임', '2019-06-02 15:27:22'),
(27, '21 소그룹', '7 교구', 'User', '교구모임', '2019-06-02 15:27:57'),
(28, '22 소그룹', '8 교구', 'User', '교구모임', '2019-06-02 15:28:28'),
(29, '23 소그룹', '8 교구', 'User', '교구모임', '2019-06-02 15:29:10'),
(30, '24 소그룹', '8 교구', 'User', '교구모임', '2019-06-02 15:29:40'),
(31, '25 소그룹', '9 교구', 'User', '교구모임', '2019-06-02 15:30:23'),
(32, '26 소그룹', '9 교구', 'User', '교구모임', '2019-06-02 15:30:55'),
(33, '27 소그룹', '9 교구', 'User', '교구모임', '2019-06-02 15:31:23'),
(34, '선교부', '당회', 'User', '선교부', '2019-06-02 15:32:27'),
(35, '시험', '시험', 'User', '시험', '2019-06-09 10:06:30');

-- --------------------------------------------------------

--
-- Table structure for table `perm_events`
--

CREATE TABLE `perm_events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_desc` varchar(255) NOT NULL,
  `event_wkday` int(1) NOT NULL,
  `event_st_date` date DEFAULT NULL,
  `event_end_date` date DEFAULT NULL,
  `event_st_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `rmlist_fk` int(11) NOT NULL,
  `grId_fk` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `event_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perm_events`
--

INSERT INTO `perm_events` (`event_id`, `event_name`, `event_desc`, `event_wkday`, `event_st_date`, `event_end_date`, `event_st_time`, `event_end_time`, `rmlist_fk`, `grId_fk`, `status`, `event_updated`) VALUES
(3, '이른비예배', '이른비예배', 1, NULL, NULL, '08:00:00', '09:00:00', 1, 2, 1, '2019-05-30 14:48:21'),
(4, '단비예배', '단비예배', 1, NULL, NULL, '10:00:00', '11:00:00', 1, 2, 1, '2019-05-30 14:49:44');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `reservID` int(11) NOT NULL,
  `reservDate` date NOT NULL,
  `rmReserv` int(3) NOT NULL,
  `reservTime` time NOT NULL,
  `endTime` time NOT NULL,
  `reservPurpose` varchar(50) NOT NULL,
  `reservGroup` int(11) DEFAULT NULL,
  `reservCreated` datetime NOT NULL DEFAULT current_timestamp(),
  `reservStatus` tinyint(1) NOT NULL DEFAULT 0,
  `reservMsg` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservID`, `reservDate`, `rmReserv`, `reservTime`, `endTime`, `reservPurpose`, `reservGroup`, `reservCreated`, `reservStatus`, `reservMsg`) VALUES
(32, '2019-05-27', 15, '10:00:00', '11:30:00', '부엌 일', 6, '2019-05-25 10:35:03', 1, NULL),
(33, '2019-05-28', 13, '12:00:00', '13:30:00', '성경공부', 8, '2019-05-25 10:36:51', 0, NULL),
(34, '2019-05-30', 2, '09:30:00', '11:00:00', 'test 1', 24, '2019-05-28 10:28:18', 1, NULL),
(35, '2019-05-30', 2, '12:00:00', '14:00:00', 'test 1', 24, '2019-05-28 10:29:23', 1, NULL),
(36, '2019-05-30', 2, '14:15:00', '16:30:00', 'test 1', 24, '2019-05-28 10:30:32', 1, NULL),
(38, '2019-05-30', 15, '21:00:00', '22:00:00', 'hjkjhj', 4, '2019-05-28 16:05:05', 1, NULL),
(39, '2019-05-30', 16, '18:00:00', '19:00:00', 'hjhk', 13, '2019-05-28 16:38:05', 1, NULL),
(40, '2019-06-08', 1, '08:00:00', '09:00:00', 'Test 1', 2, '2019-05-31 12:15:36', 1, NULL),
(41, '2019-06-08', 1, '09:30:00', '11:00:00', 'Test 2', 2, '2019-05-31 12:16:20', 1, NULL),
(42, '2019-06-08', 1, '12:00:00', '14:00:00', 'Test 3', 2, '2019-05-31 12:17:00', 1, NULL),
(43, '2019-06-08', 1, '15:30:00', '17:00:00', 'Test 4', 2, '2019-05-31 12:18:00', 1, NULL),
(44, '2019-06-08', 1, '17:30:00', '19:00:00', 'Test 5', 2, '2019-06-01 12:47:18', 1, NULL),
(55, '2019-06-05', 7, '08:00:00', '08:45:00', 'Test 6', 17, '2019-06-03 15:18:54', 1, NULL),
(56, '2019-06-06', 15, '15:00:00', '16:00:00', 'Test 7', 2, '2019-06-03 15:19:38', 1, NULL),
(57, '2019-06-09', 1, '08:00:00', '09:00:00', '이른비예배', 2, '2019-06-04 17:55:55', 1, NULL),
(58, '2019-06-06', 1, '08:00:00', '09:00:00', '성가대 연습', 2, '2019-06-04 21:54:06', 1, NULL),
(59, '2019-06-07', 7, '12:00:00', '20:00:00', '일일 찻집', 22, '2019-06-05 16:18:49', 0, NULL),
(60, '2019-06-06', 4, '17:30:00', '19:00:00', 'Practice', 22, '2019-06-05 16:24:09', 0, NULL),
(61, '2019-06-08', 7, '09:00:00', '12:00:00', 'Tea Day 2', 22, '2019-06-07 12:59:08', 0, NULL),
(66, '2019-06-09', 10, '08:00:00', '20:00:00', 'bazaar', 4, '2019-06-07 18:17:36', 1, NULL),
(69, '2019-06-09', 10, '11:00:00', '13:00:00', 'Tupperware party ', 1, '2019-06-08 17:47:10', 0, NULL),
(70, '2019-06-11', 1, '08:00:00', '09:00:00', 'Meeting', 25, '2019-06-08 17:48:49', 1, NULL),
(71, '2019-06-08', 14, '21:15:00', '22:15:00', '소그룹', 3, '2019-06-08 21:11:00', 1, NULL),
(73, '2019-06-10', 5, '09:00:00', '10:15:00', '회의', 1, '2019-06-09 18:01:59', 0, NULL),
(74, '2019-06-10', 5, '11:00:00', '12:30:00', '회의', 26, '2019-06-09 18:04:11', 1, NULL),
(77, '2019-06-12', 1, '18:30:00', '19:30:00', 'Testing 1', 2, '2019-06-11 18:24:35', 1, NULL),
(80, '2019-06-13', 27, '18:00:00', '19:00:00', 'meeting', 1, '2019-06-12 15:12:46', 0, NULL),
(113, '2019-06-18', 1, '07:00:00', '23:00:00', 'mb3', 18, '2019-06-14 20:07:50', 0, NULL),
(126, '2019-06-20', 15, '09:30:00', '12:00:00', 'Kitchen wrk', 1, '2019-06-15 22:59:56', 0, NULL),
(127, '2019-06-19', 1, '06:00:00', '07:00:00', 'hjjhk', 2, '2019-06-15 23:01:16', 1, NULL),
(128, '2019-07-16', 15, '10:15:00', '11:00:00', 'Mid-morning Service', 26, '2019-06-16 12:26:33', 1, NULL),
(129, '2019-07-16', 1, '14:30:00', '16:00:00', 'Mid-morning Service', 25, '2019-06-16 14:11:37', 1, NULL),
(130, '2019-06-20', 1, '08:15:00', '08:45:00', 'ES 2', 1, '2019-06-16 14:17:59', 0, NULL),
(131, '2019-06-20', 1, '10:00:00', '11:00:00', 'ES', 1, '2019-06-16 14:18:24', 0, NULL),
(132, '2019-06-20', 9, '08:00:00', '12:00:00', 'ES 2333', 1, '2019-06-16 20:31:59', 0, NULL),
(133, '2019-06-18', 5, '08:00:00', '09:00:00', 'ESP 2', 1, '2019-06-16 20:35:45', 0, NULL),
(134, '2019-06-20', 1, '09:15:00', '09:45:00', 'ES 2', 1, '2019-06-17 20:34:38', 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `rmlist`
--

CREATE TABLE `rmlist` (
  `rmId` int(11) NOT NULL,
  `rmName` varchar(50) NOT NULL,
  `rmLocation` varchar(50) NOT NULL,
  `rmDesc` varchar(50) NOT NULL,
  `rmMaxPersons` int(11) NOT NULL,
  `rmStartAvailTime` time NOT NULL,
  `rmEndAvailTime` time NOT NULL,
  `rmPiano` tinyint(1) NOT NULL DEFAULT 0,
  `rmCreated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rmlist`
--

INSERT INTO `rmlist` (`rmId`, `rmName`, `rmLocation`, `rmDesc`, `rmMaxPersons`, `rmStartAvailTime`, `rmEndAvailTime`, `rmPiano`, `rmCreated`) VALUES
(1, '본당', '1st Floor', 'Main Sanctuary', 300, '08:00:00', '20:00:00', 1, '2019-05-19 15:10:28'),
(2, '친교실', '1st Floor', 'Fellowship Hall', 100, '08:00:00', '20:00:00', 0, '2019-05-19 15:11:56'),
(3, '회의실 1', '2층', 'Meeting Rm 1', 40, '09:00:00', '21:00:00', 1, '2019-05-19 15:29:21'),
(4, '연습실 1', '1층', 'Rehearsal Rm', 20, '09:00:00', '21:00:00', 1, '2019-05-19 15:30:21'),
(5, '1번 방', '1층', '작은 회의실', 15, '09:00:00', '21:00:00', 0, '2019-05-19 16:20:24'),
(6, 'Room 2', '1st Floor', 'Meeting Rm', 30, '09:00:00', '21:00:00', 0, '2019-05-19 16:21:43'),
(7, '카페', '1층', 'Coffee, Tea, etc.', 50, '10:00:00', '20:00:00', 1, '2019-05-19 16:22:48'),
(8, 'Room 3', '2nd Floor', 'Meeting Rm', 20, '09:00:00', '21:00:00', 0, '2019-05-19 16:35:31'),
(9, 'Back Yard', '외부', '뒷뜰', 40, '09:00:00', '21:00:00', 0, '2019-05-19 16:37:11'),
(10, 'Front yard', '외부', '앞뜰', 40, '10:00:00', '20:00:00', 0, '2019-05-19 17:20:10'),
(11, 'Room 4', '1st Floor', 'Room 4', 25, '09:00:00', '21:00:00', 0, '2019-05-19 20:23:08'),
(12, 'Room 5', '1st Floot', 'Small meeting rm', 10, '09:00:00', '21:00:00', 0, '2019-05-20 11:19:03'),
(13, 'Room 6', '1st Floor', 'Rm 6', 40, '09:00:00', '21:00:00', 1, '2019-05-22 16:16:51'),
(14, '영아실', '본당뒤', '영아실', 15, '09:00:00', '21:00:00', 0, '2019-05-23 18:38:42'),
(15, '부엌', '1st Floor', 'Kitchen', 7, '09:00:00', '21:00:00', 0, '2019-05-24 13:15:48'),
(16, 'Room 7', '1층', '작은 회의실', 10, '09:00:00', '21:00:00', 0, '2019-05-28 16:18:22'),
(21, 'Room 8', '2층', '회의실', 20, '09:00:00', '21:00:00', 0, '2019-06-09 12:54:35'),
(22, 'Room 9', '2층', '큰 회의실', 50, '08:00:00', '20:00:00', 1, '2019-06-09 12:58:50'),
(24, '옆뜰', '외부', '옆뜰', 30, '08:00:00', '19:00:00', 0, '2019-06-09 14:14:40'),
(25, '연습실 2', '2층', 'Rehearsal Rm 2', 20, '09:00:00', '21:00:00', 1, '2019-06-09 17:56:09'),
(26, '연습실 3', '1층', 'Rehearsal Rm 3', 30, '09:00:00', '21:00:00', 1, '2019-06-10 13:30:03'),
(27, 'Room 1', '1층', '회의실 1', 20, '09:00:00', '21:00:00', 0, '2019-06-11 18:27:59');

-- --------------------------------------------------------

--
-- Stand-in structure for view `rm_reserved`
-- (See below for the actual view)
--
CREATE TABLE `rm_reserved` (
`reservID` int(11)
,`reservDate` date
,`rmName` varchar(50)
,`reservTime` time
,`endTime` time
,`reservPurpose` varchar(50)
,`grName` varchar(50)
,`status` varchar(8)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `userinfo_perm`
-- (See below for the actual view)
--
CREATE TABLE `userinfo_perm` (
`user_firstname` varchar(50)
,`user_lastname` varchar(50)
,`user_kor_name` varchar(50)
,`user_title` varchar(20)
,`cellPhoneNum` varchar(12)
,`user_name` varchar(50)
,`user_pwd` varchar(255)
,`user_perm_level` varchar(10)
,`grId` int(11)
,`grName` varchar(50)
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_firstname` varchar(50) NOT NULL,
  `user_mi` varchar(2) DEFAULT NULL,
  `user_lastname` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `cellPhoneNum` varchar(12) DEFAULT NULL,
  `user_group_fk` int(11) NOT NULL,
  `user_kor_name` varchar(50) NOT NULL,
  `user_title` varchar(20) DEFAULT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_pwd` varchar(255) NOT NULL,
  `user_token` varchar(255) DEFAULT NULL,
  `user_expire` date DEFAULT NULL,
  `user_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_mi`, `user_lastname`, `user_email`, `cellPhoneNum`, `user_group_fk`, `user_kor_name`, `user_title`, `user_name`, `user_pwd`, `user_token`, `user_expire`, `user_created`) VALUES
(1, 'Ki', 'Y', 'Roh', 'roh710@msn.com', '201-315-2126', 1, '노기영', '집사', 'admin', '$2y$10$4tQ9dTV4VkaQspO3DL6BzOIOGTbmpNYpRNItqgnONlYijkzQEy1sm', NULL, NULL, '2019-05-19 15:07:10'),
(2, 'Ki', 'Y', 'Roh', 'roh710@gmail.com', '201-315-2126', 1, '노기영', '집사', 'roh710', '$2y$10$Tg.HhKC9iKwXazx19PfJcesy/Ws5HuUethyg/p9Nio9dt1GCP.X32', NULL, NULL, '2019-05-19 15:24:12'),
(18, 'Youngtae', NULL, 'Cho', 'cdnj.org@gmail.com', '201-401-3208', 1, '조영태', '목사', 'cdnjadmin', '$2y$10$GTZpvpkDJkjQVubZTRwouOBQKh59.Sb4QsHS.EsBlikajt3qk8Tpa', NULL, NULL, '2019-05-28 16:50:52');

-- --------------------------------------------------------

--
-- Structure for view `rm_reserved`
--
DROP TABLE IF EXISTS `rm_reserved`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rm_reserved`  AS  select `reservations`.`reservID` AS `reservID`,`reservations`.`reservDate` AS `reservDate`,`rmlist`.`rmName` AS `rmName`,`reservations`.`reservTime` AS `reservTime`,`reservations`.`endTime` AS `endTime`,`reservations`.`reservPurpose` AS `reservPurpose`,`cdnj_group`.`grName` AS `grName`,if(`reservations`.`reservStatus` = 0,'Pending','Approved') AS `status` from ((`reservations` join `rmlist` on(`reservations`.`rmReserv` = `rmlist`.`rmId`)) left join `cdnj_group` on(`reservations`.`reservGroup` = `cdnj_group`.`grId`)) where `reservations`.`reservDate` >= curdate() order by `reservations`.`reservDate` ;

-- --------------------------------------------------------

--
-- Structure for view `userinfo_perm`
--
DROP TABLE IF EXISTS `userinfo_perm`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userinfo_perm`  AS  select `users`.`user_firstname` AS `user_firstname`,`users`.`user_lastname` AS `user_lastname`,`users`.`user_kor_name` AS `user_kor_name`,`users`.`user_title` AS `user_title`,`users`.`cellPhoneNum` AS `cellPhoneNum`,`users`.`user_name` AS `user_name`,`users`.`user_pwd` AS `user_pwd`,`cdnj_group`.`user_perm_level` AS `user_perm_level`,`cdnj_group`.`grId` AS `grId`,`cdnj_group`.`grName` AS `grName` from (`users` join `cdnj_group` on(`users`.`user_group_fk` = `cdnj_group`.`grId`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cdnj_group`
--
ALTER TABLE `cdnj_group`
  ADD PRIMARY KEY (`grId`),
  ADD UNIQUE KEY `grName` (`grName`);

--
-- Indexes for table `perm_events`
--
ALTER TABLE `perm_events`
  ADD PRIMARY KEY (`event_id`),
  ADD KEY `rmlist_fk` (`rmlist_fk`),
  ADD KEY `grId_fk` (`grId_fk`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`reservID`),
  ADD KEY `reservGroup` (`reservGroup`),
  ADD KEY `rmReserv` (`rmReserv`);

--
-- Indexes for table `rmlist`
--
ALTER TABLE `rmlist`
  ADD PRIMARY KEY (`rmId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `gr_fk` (`user_group_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cdnj_group`
--
ALTER TABLE `cdnj_group`
  MODIFY `grId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `perm_events`
--
ALTER TABLE `perm_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=135;

--
-- AUTO_INCREMENT for table `rmlist`
--
ALTER TABLE `rmlist`
  MODIFY `rmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perm_events`
--
ALTER TABLE `perm_events`
  ADD CONSTRAINT `perm_events_ibfk_1` FOREIGN KEY (`rmlist_fk`) REFERENCES `rmlist` (`rmId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `perm_events_ibfk_2` FOREIGN KEY (`grId_fk`) REFERENCES `cdnj_group` (`grId`) ON UPDATE CASCADE;

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`rmReserv`) REFERENCES `rmlist` (`rmId`) ON UPDATE CASCADE,
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`reservGroup`) REFERENCES `cdnj_group` (`grId`) ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_group_fk`) REFERENCES `cdnj_group` (`grId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
