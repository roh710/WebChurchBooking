-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2019 at 04:22 AM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

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
(1, 'Admin', 'CDNJ', 'Admin', 'IT', '2019-11-06 15:42:58'),
(2, '11 소그룹', '1 교구', 'User', '교구모임', '2019-11-06 16:15:47'),
(3, '12 소그룹', '1 교구', 'User', '교구모임', '2019-11-06 16:25:16'),
(4, '13 소그룹', '1 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(5, '21 소그룹', '2 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(6, '22 소그룹', '2 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(7, '23 소그룹', '2 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(8, '31 소그룹', '3 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(9, '32 소그룹', '3 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(10, '33 소그룹', '3 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(11, '41 소그룹', '4 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(12, '42 소그룹', '4 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(13, '43 소그룹', '4 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(14, '51 소그룹', '5 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(15, '52 소그룹', '5 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(16, '53 소그룹', '5 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(17, '61 소그룹', '6 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(18, '62 소그룹', '6 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(19, '63 소그룹', '6 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(20, '71 소그룹', '7 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(21, '72 소그룹', '7 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(22, '73 소그룹', '7 교구', 'User', '교구모임', '2019-11-06 16:26:14'),
(23, '81 소그룹', '8 교구', 'User', '교구모임', '2019-11-06 16:40:23'),
(24, '82 소그룹', '8 교구', 'User', '교구모임', '2019-11-06 16:40:50'),
(25, '83 소그룹', '8 교구', 'User', '교구모임', '2019-11-06 16:41:20'),
(26, '91 소그룹', '9 교구', 'User', '교구모임', '2019-11-06 16:43:17'),
(27, '92 소그룹', '9 교구', 'User', '교구모임', '2019-11-06 16:43:50'),
(28, '93 소그룹', '9 교구', 'User', '교구모임', '2019-11-06 16:44:14'),
(29, '예배부', '예백관리부', 'User', '예배 총괄', '2019-11-06 16:45:16');

-- --------------------------------------------------------

--
-- Table structure for table `perm_events`
--

CREATE TABLE `perm_events` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `event_desc` varchar(255) NOT NULL,
  `event_wkday` int(1) DEFAULT NULL,
  `event_st_date` date DEFAULT NULL,
  `event_end_date` date DEFAULT NULL,
  `event_st_time` time NOT NULL,
  `event_end_time` time NOT NULL,
  `rmlist_fk` int(11) NOT NULL,
  `grId_fk` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `event_updated` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
(1, '2019-11-10', 1, '08:00:00', '09:00:00', '이른비예배', 29, '2019-11-06 16:22:04', 1, NULL),
(2, '2019-11-10', 1, '10:00:00', '11:00:00', '단비예배', 29, '2019-11-06 16:22:30', 1, NULL),
(3, '2019-11-10', 1, '12:00:00', '13:00:00', '큰비예배', 29, '2019-11-06 16:23:17', 1, NULL),
(4, '2019-11-10', 1, '14:00:00', '15:00:00', 'EM Worship', 29, '2019-11-06 16:24:10', 1, NULL),
(5, '2019-11-10', 3, '18:00:00', '21:00:00', 'Choir practice', 3, '2019-11-06 19:03:02', 0, NULL);

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
(1, '본당', '1층', 'Main Sanctuary', 300, '07:00:00', '21:00:00', 1, '2019-11-06 16:20:07'),
(2, '친교실', '1층', 'Fellowship Room', 100, '07:00:00', '21:00:00', 0, '2019-11-06 16:21:09'),
(3, '찬양연습실', '1층 복도 끝', 'Choir Rehersal Room', 40, '07:00:00', '21:00:00', 1, '2019-11-06 16:53:45');

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
`user_id` int(11)
,`user_firstname` varchar(50)
,`user_lastname` varchar(50)
,`user_email` varchar(50)
,`user_kor_name` varchar(50)
,`user_title` varchar(20)
,`user_name` varchar(50)
,`user_pwd` varchar(255)
,`active_status` tinyint(1)
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
  `user_created` datetime NOT NULL DEFAULT current_timestamp(),
  `active_status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_mi`, `user_lastname`, `user_email`, `cellPhoneNum`, `user_group_fk`, `user_kor_name`, `user_title`, `user_name`, `user_pwd`, `user_token`, `user_expire`, `user_created`, `active_status`) VALUES
(1, 'Ki', NULL, 'Roh', 'roh710@msn.com', '201-315-2126', 1, '노기영', '집사', 'admin', '$2y$10$vMjXMT684MvjYPmxWT8pgum336iIKQuTDA2XIyaFhiAht4BzilOHW', NULL, NULL, '2019-11-06 16:08:21', 1),
(2, 'Ki', NULL, 'Roh', 'roh710@gmail.com', '201-315-2126', 1, '노기영', '집사', 'roh710', '$2y$10$cEyyzyKavjaupKXqXjbaY.pf9QxVZyW0ToCs.1Kv4uAp2qW21tYy6', NULL, NULL, '2019-11-06 16:17:26', 1),
(3, 'Group', NULL, 'One', 'gr1@group.com', '201-768-9876', 2, '그룹', '원', 'group1', '$2y$10$ZG.QhbLB0I16H6rgW.QxDe8aZtSgmgBVfyYRolfl1ASB7RmvlIx.S', NULL, NULL, '2019-11-06 16:29:28', 1),
(4, 'Group', NULL, 'Two', 'gr2@goup.com', '201-312-6789', 3, '그룹', '투', 'group2', '$2y$10$ykjWQpqYryfHVlmleyWoaOgpTxGWmN1P4nFtFKeBptuq9amUb84Zm', NULL, NULL, '2019-11-06 19:00:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_conn_info`
--

CREATE TABLE `user_conn_info` (
  `user_conn_id` int(11) NOT NULL,
  `user_fk` int(11) NOT NULL,
  `ip_addr` varchar(20) NOT NULL,
  `isp` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL,
  `city` varchar(50) NOT NULL,
  `region` varchar(40) DEFAULT NULL,
  `zip` varchar(5) NOT NULL,
  `date_time_stamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userinfo_perm`  AS  select `users`.`user_id` AS `user_id`,`users`.`user_firstname` AS `user_firstname`,`users`.`user_lastname` AS `user_lastname`,`users`.`user_email` AS `user_email`,`users`.`user_kor_name` AS `user_kor_name`,`users`.`user_title` AS `user_title`,`users`.`user_name` AS `user_name`,`users`.`user_pwd` AS `user_pwd`,`users`.`active_status` AS `active_status`,`cdnj_group`.`user_perm_level` AS `user_perm_level`,`cdnj_group`.`grId` AS `grId`,`cdnj_group`.`grName` AS `grName` from (`users` join `cdnj_group` on(`users`.`user_group_fk` = `cdnj_group`.`grId`)) ;

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
  ADD PRIMARY KEY (`rmId`),
  ADD UNIQUE KEY `rmName` (`rmName`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `gr_fk` (`user_group_fk`);

--
-- Indexes for table `user_conn_info`
--
ALTER TABLE `user_conn_info`
  ADD PRIMARY KEY (`user_conn_id`),
  ADD KEY `user_fk` (`user_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cdnj_group`
--
ALTER TABLE `cdnj_group`
  MODIFY `grId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `perm_events`
--
ALTER TABLE `perm_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rmlist`
--
ALTER TABLE `rmlist`
  MODIFY `rmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_conn_info`
--
ALTER TABLE `user_conn_info`
  MODIFY `user_conn_id` int(11) NOT NULL AUTO_INCREMENT;

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

--
-- Constraints for table `user_conn_info`
--
ALTER TABLE `user_conn_info`
  ADD CONSTRAINT `user_conn_info_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
