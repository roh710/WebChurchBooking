-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2019 at 03:16 PM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.2.16

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
  `grCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
(21, 'College Group', 'Education', 'User', 'College students', '2019-05-19 17:14:07');

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
  `reservCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reservStatus` tinyint(1) NOT NULL DEFAULT '0',
  `reservMsg` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `rmPiano` tinyint(1) NOT NULL DEFAULT '0',
  `rmCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `rmlist`
--

INSERT INTO `rmlist` (`rmId`, `rmName`, `rmLocation`, `rmDesc`, `rmMaxPersons`, `rmStartAvailTime`, `rmEndAvailTime`, `rmPiano`, `rmCreated`) VALUES
(1, '본당', '1st Floor', 'Main Sanctuary', 300, '08:00:00', '20:00:00', 1, '2019-05-19 15:10:28'),
(2, '친교실', '1st Floor', 'Fellowship Hall', 100, '08:00:00', '20:00:00', 0, '2019-05-19 15:11:56');

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
  `user_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_mi`, `user_lastname`, `user_email`, `cellPhoneNum`, `user_group_fk`, `user_kor_name`, `user_title`, `user_name`, `user_pwd`, `user_token`, `user_expire`, `user_created`) VALUES
(1, 'Ki', 'Y', 'Roh', 'roh710@msn.com', '201-315-2126', 1, '노기영', '집사', 'admin', '$2y$10$4tQ9dTV4VkaQspO3DL6BzOIOGTbmpNYpRNItqgnONlYijkzQEy1sm', NULL, NULL, '2019-05-19 15:07:10'),
(2, 'Ki', 'Y', 'Roh', 'roh710@gmail.com', '201-315-2126', 1, '노기영', '집사', 'roh710', '$2y$10$Tg.HhKC9iKwXazx19PfJcesy/Ws5HuUethyg/p9Nio9dt1GCP.X32', NULL, NULL, '2019-05-19 15:24:12'),
(3, 'Jeong', NULL, 'Han', 'jhan@', '201-312-5507', 11, '한정림', '집사', 'jhan', '$2y$10$7eKzWYwl0LRFYghoKi.iD.FJ4asqIOcpn8/GekjX79iK5MojAfV2C', NULL, NULL, '2019-05-19 15:35:18');

-- --------------------------------------------------------

--
-- Structure for view `rm_reserved`
--
DROP TABLE IF EXISTS `rm_reserved`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rm_reserved`  AS  select `reservations`.`reservID` AS `reservID`,`reservations`.`reservDate` AS `reservDate`,`rmlist`.`rmName` AS `rmName`,`reservations`.`reservTime` AS `reservTime`,`reservations`.`endTime` AS `endTime`,`reservations`.`reservPurpose` AS `reservPurpose`,`cdnj_group`.`grName` AS `grName`,if((`reservations`.`reservStatus` = 0),'Pending','Approved') AS `status` from ((`reservations` join `rmlist` on((`reservations`.`rmReserv` = `rmlist`.`rmId`))) left join `cdnj_group` on((`reservations`.`reservGroup` = `cdnj_group`.`grId`))) where (`reservations`.`reservDate` >= curdate()) order by `reservations`.`reservDate` ;

-- --------------------------------------------------------

--
-- Structure for view `userinfo_perm`
--
DROP TABLE IF EXISTS `userinfo_perm`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userinfo_perm`  AS  select `users`.`user_firstname` AS `user_firstname`,`users`.`user_lastname` AS `user_lastname`,`users`.`user_kor_name` AS `user_kor_name`,`users`.`user_title` AS `user_title`,`users`.`cellPhoneNum` AS `cellPhoneNum`,`users`.`user_name` AS `user_name`,`users`.`user_pwd` AS `user_pwd`,`cdnj_group`.`user_perm_level` AS `user_perm_level`,`cdnj_group`.`grId` AS `grId`,`cdnj_group`.`grName` AS `grName` from (`users` join `cdnj_group` on((`users`.`user_group_fk` = `cdnj_group`.`grId`))) ;

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
  MODIFY `grId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `rmlist`
--
ALTER TABLE `rmlist`
  MODIFY `rmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

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
