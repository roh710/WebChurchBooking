-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 29, 2019 at 10:50 AM
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
(7, '05 소그룹 thokko', '2교구', 'User', '교구모임', '2019-05-19 15:40:47'),
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
(21, 'College Group', 'Education', 'User', 'College students', '2019-05-19 17:14:07'),
(22, 'Youth Group', 'Education', 'User', '중고등부', '2019-05-22 09:39:08'),
(23, '영아부', 'Education', 'User', '영아부', '2019-05-22 16:18:18'),
(24, '청년부', 'Education', 'User', 'Young-adult', '2019-05-24 13:17:26'),
(25, '19 소그룹', '7 교구', 'User', '교구모임', '2019-05-28 16:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `perm_events`
--

CREATE TABLE `perm_events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_desc` varchar(255) NOT NULL,
  `event_wkday` varchar(100) NOT NULL,
  `event_st_date` date DEFAULT NULL,
  `event_end_date` date DEFAULT NULL,
  `event_st_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `rmlist_fk` int(11) NOT NULL,
  `event_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `perm_events`
--

INSERT INTO `perm_events` (`event_id`, `event_name`, `event_desc`, `event_wkday`, `event_st_date`, `event_end_date`, `event_st_time`, `event_end_time`, `rmlist_fk`, `event_updated`) VALUES
(1, 'Early Rain Worship', 'Early Rain Worship', 'sun', NULL, NULL, '08:00:00', '09:00:00', 1, '2019-05-29 10:25:32'),
(2, 'Sweet Rain Worship', 'Sweet Rain Worship', 'sun', NULL, NULL, '10:00:00', '11:00:00', 1, '2019-05-29 10:26:56');

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
(3, '2019-05-19', 3, '18:00:00', '19:00:00', 'Practice', 3, '2019-05-19 15:31:15', 1, NULL),
(4, '2019-05-19', 1, '08:00:00', '09:00:00', '이른비예배', 2, '2019-05-19 15:32:25', 1, NULL),
(5, '2019-05-19', 3, '14:00:00', '15:00:00', '제정부회의', 2, '2019-05-19 15:33:08', 1, NULL),
(6, '2019-05-26', 9, '18:00:00', '19:00:00', '바자회', 23, '2019-05-19 15:36:09', 1, NULL),
(7, '2019-05-21', 2, '18:00:00', '20:00:00', '바자회', 4, '2019-05-19 15:38:42', 1, NULL),
(8, '2019-05-21', 3, '17:00:00', '19:00:00', '교구모임', 6, '2019-05-19 15:43:36', 1, NULL),
(10, '2019-05-22', 8, '16:00:00', '17:30:00', '재정부 미팅', 7, '2019-05-19 16:47:49', 1, NULL),
(13, '2019-05-25', 10, '17:30:00', '18:30:00', 'Bazaar', 5, '2019-05-19 17:21:20', 1, NULL),
(14, '2019-05-25', 7, '18:30:00', '19:30:00', 'Tea time', 9, '2019-05-19 20:35:41', 0, NULL),
(15, '2019-05-26', 1, '08:00:00', '09:00:00', '이른비 예배', 2, '2019-05-20 15:09:39', 1, NULL),
(16, '2019-05-22', 2, '18:00:00', '19:00:00', 'Tyra', 5, '2019-05-20 18:31:34', 1, NULL),
(18, '2019-05-23', 3, '17:00:00', '18:00:00', '혹시 시간', 11, '2019-05-21 18:45:17', 1, NULL),
(19, '2019-05-23', 9, '17:30:00', '19:30:00', '떠왔다', 3, '2019-05-21 20:29:42', 1, NULL),
(20, '2019-05-22', 11, '17:00:00', '18:30:00', 'The beginning', 10, '2019-05-21 20:32:37', 1, NULL),
(21, '2019-05-23', 9, '14:00:00', '16:00:00', 'Bazaar', 22, '2019-05-22 09:40:53', 1, NULL),
(22, '2019-05-26', 9, '12:00:00', '14:00:00', 'Picnic for children', 23, '2019-05-22 16:36:40', 1, NULL),
(23, '2019-05-26', 14, '10:00:00', '11:00:00', 'Children play', 23, '2019-05-23 18:39:56', 1, NULL),
(24, '2019-05-27', 7, '09:00:00', '10:30:00', '모임', 4, '2019-05-24 07:29:04', 1, NULL),
(25, '2019-05-26', 3, '17:30:00', '07:30:00', '미팅', 11, '2019-05-24 07:29:52', 1, NULL),
(26, '2019-05-25', 4, '17:30:00', '19:30:00', 'Practice', 22, '2019-05-24 07:32:05', 0, NULL),
(27, '2019-05-26', 15, '11:00:00', '12:00:00', '부엌 도우미', 24, '2019-05-24 13:22:17', 1, NULL),
(28, '2019-05-26', 10, '16:00:00', '18:00:00', 'Yard work', 21, '2019-05-24 17:11:17', 1, NULL),
(29, '2019-05-30', 1, '08:00:00', '09:00:00', 'Youth group worship', 7, '2019-05-24 17:13:42', 1, NULL),
(30, '2019-05-31', 15, '09:30:00', '11:30:00', 'Kitchen work', 2, '2019-05-25 10:22:39', 1, NULL),
(31, '2019-05-28', 13, '17:00:00', '19:00:00', '회의', 10, '2019-05-25 10:31:58', 1, NULL),
(32, '2019-05-27', 15, '10:00:00', '11:30:00', '부엌 일', 6, '2019-05-25 10:35:03', 1, NULL),
(33, '2019-05-28', 13, '12:00:00', '13:30:00', '성경공부', 8, '2019-05-25 10:36:51', 0, NULL),
(34, '2019-05-30', 2, '09:30:00', '11:00:00', 'test 1', 24, '2019-05-28 10:28:18', 1, NULL),
(35, '2019-05-30', 2, '12:00:00', '14:00:00', 'test 1', 24, '2019-05-28 10:29:23', 1, NULL),
(36, '2019-05-30', 2, '14:15:00', '16:30:00', 'test 1', 24, '2019-05-28 10:30:32', 1, NULL),
(38, '2019-05-30', 15, '21:00:00', '22:00:00', 'hjkjhj', 4, '2019-05-28 16:05:05', 1, NULL),
(39, '2019-05-30', 16, '18:00:00', '19:00:00', 'hjhk', 13, '2019-05-28 16:38:05', 1, NULL);

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
(3, 'Meeting Rm 1', '2nd Floor', 'Meeting Rm', 40, '09:00:00', '21:00:00', 1, '2019-05-19 15:29:21'),
(4, 'Rehearsal Rm 1', '1st Floor', 'Rehearsal Rm', 20, '09:00:00', '21:00:00', 1, '2019-05-19 15:30:21'),
(5, 'Room 1', '1st Floor', 'Small Rm', 15, '09:00:00', '21:00:00', 0, '2019-05-19 16:20:24'),
(6, 'Room 2', '1st Floor', 'Meeting Rm', 30, '09:00:00', '21:00:00', 0, '2019-05-19 16:21:43'),
(7, 'Cafe', '1st Floor', 'Cafe', 50, '10:00:00', '20:00:00', 1, '2019-05-19 16:22:48'),
(8, 'Room 3', '2nd Floor', 'Meeting Rm', 20, '09:00:00', '21:00:00', 0, '2019-05-19 16:35:31'),
(9, 'Back Yard', 'Behind the building', 'Back Yard', 40, '09:00:00', '21:00:00', 0, '2019-05-19 16:37:11'),
(10, 'Front yard', 'Front of church', 'Front yard', 40, '10:00:00', '20:00:00', 0, '2019-05-19 17:20:10'),
(11, 'Room 4', '1st Floor', 'Room 4', 25, '09:00:00', '21:00:00', 0, '2019-05-19 20:23:08'),
(12, 'Room 5', '1st Floot', 'Small meeting rm', 10, '09:00:00', '21:00:00', 0, '2019-05-20 11:19:03'),
(13, 'Room 6', '1st Floor', 'Rm 6', 40, '09:00:00', '21:00:00', 1, '2019-05-22 16:16:51'),
(14, '영아실', '본당뒤', '영아실', 15, '09:00:00', '21:00:00', 0, '2019-05-23 18:38:42'),
(15, '부엌', '1st Floor', 'Kitchen', 7, '09:00:00', '21:00:00', 0, '2019-05-24 13:15:48'),
(16, 'Room 7', '1floor', 'Room 7', 20, '09:00:00', '21:00:00', 0, '2019-05-28 16:18:22');

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
(3, 'Jeong', NULL, 'Han', 'jhan@', '201-312-5507', 11, '한정림', '집사', 'jhan', '$2y$10$7eKzWYwl0LRFYghoKi.iD.FJ4asqIOcpn8/GekjX79iK5MojAfV2C', NULL, NULL, '2019-05-19 15:35:18'),
(4, 'Gina', NULL, 'Kim', 'fairgina@', '215-765-4328', 4, '김지나', '집사', 'gkim', '$2y$10$bXQ28MsKVsPsv7tbr1hJneDYjJc1oQPaE9GciMY0sUGXm3pccBeI2', NULL, NULL, '2019-05-19 15:37:50'),
(5, 'group', NULL, 'four', 'four@', '201-456-9876', 6, '홍성기', '성도', 'group4', '$2y$10$bN64MlwOBwEZQWypbIo9iO0KTbSB4alQRfW2jYlbZ8LK0ka9bgq9C', NULL, NULL, '2019-05-19 15:42:56'),
(7, 'Young', NULL, 'Kim', 'ghjkhgg', '719-789-9876', 7, '김영', '장로', 'group5', '$2y$10$U9/cNd/XlimJC/eyIGdKQO3BSBflNlI7MiV9TZaZwtpa3RpVX1uLG', NULL, NULL, '2019-05-19 16:46:26'),
(8, 'College', NULL, 'Group', 'college', '973-648-7903', 21, '컬리지', '학생', 'college', '$2y$10$RZRLheqDOPz22XBtZyEVKuItJIrkie./FlW8JpfesICcAqbs//p5S', NULL, NULL, '2019-05-19 17:12:45'),
(9, 'Group', NULL, 'Six', 'group6', '201-368-2638', 8, '그룹6', 'Deacon', 'group6', '$2y$10$SHPF0wl8CQxCOSHl82CeluATNRLCCnO1sm/xQspFwNTh524Ebivvy', NULL, NULL, '2019-05-19 20:30:20'),
(11, 'Frank', NULL, 'Stein', 'frank@', '201-735-2952', 9, '프렝크', '성도', 'frank', '$2y$10$V71mi9jn5jIcImKT8.d/AuuWiPfz1pbP6crMWzw6/EyT30ha4eN0C', NULL, NULL, '2019-05-20 11:22:12'),
(12, 'Group', NULL, 'One', 'group1@', '215-368-2795', 3, '그룹원', '성도', 'group1', '$2y$10$s4c4vCqfiNP0QeLQg3H5we5Kq6plIUO3jOlc/ZXwZ0u9U8Axxy042', NULL, NULL, '2019-05-20 12:39:53'),
(13, 'Tyra', NULL, 'Banks', 'tyra@msn.com', '357-903-9004', 5, '타이라', '집사', 'tyra', '$2y$10$zQY0S1NYqAtNnZth9ijRwevQC01cpkZH3lnFg/0V48uJ5u7hO9FWu', NULL, NULL, '2019-05-20 18:29:50'),
(14, 'Thomas', NULL, 'Train', 'thomas@hotmail.com', '215-123-7117', 10, '토마스', '전도사', 'thomas', '$2y$10$ymulxuzSyr6c7nuTU/65LupnE9LrOBN0hMWsYpDSn1XITQD5QAmoC', NULL, NULL, '2019-05-20 18:39:20'),
(15, 'Youth', NULL, 'Group', 'youth@', '201-456-9999', 22, '유스그룹', '성도', 'youth', '$2y$10$D3MqOykiTGnhmbQcJAsLyuE0bKqlYPaPCkqJ.SW.vQcTBFM564o5G', NULL, NULL, '2019-05-22 09:37:47'),
(16, 'Ronald', NULL, 'Ragen', 'ghhjghj', '215-367-0989', 23, '로날드', '집사', 'ronald', '$2y$10$Q/dtysrwChbQpDnJf6tdb.2W6KujMil3k5JVbSoNeUypgYRtxiGuG', NULL, NULL, '2019-05-22 16:31:30'),
(17, 'Kim', NULL, 'Basinger', 'hkjhkhk', '203-555-6789', 24, '킴', '집사', '베싱져', '$2y$10$QvOMMe0/aH7T6XkmwPnBo.tH.5ECZ8cApM93foAwvwB/VXKTYwscC', NULL, NULL, '2019-05-24 13:20:00'),
(18, 'youngtae', NULL, 'cho', 'cdnj.org@gmail.com', '201-401-3208', 1, '조영태', '목사', 'cdnjadmin', '$2y$10$GTZpvpkDJkjQVubZTRwouOBQKh59.Sb4QsHS.EsBlikajt3qk8Tpa', NULL, NULL, '2019-05-28 16:50:52');

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
  ADD KEY `rmlist_fk` (`rmlist_fk`);

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
  MODIFY `grId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `perm_events`
--
ALTER TABLE `perm_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `rmlist`
--
ALTER TABLE `rmlist`
  MODIFY `rmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `perm_events`
--
ALTER TABLE `perm_events`
  ADD CONSTRAINT `perm_events_ibfk_1` FOREIGN KEY (`rmlist_fk`) REFERENCES `rmlist` (`rmId`) ON UPDATE CASCADE;

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
