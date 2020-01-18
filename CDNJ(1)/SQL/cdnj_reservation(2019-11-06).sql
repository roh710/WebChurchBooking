-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2019 at 06:47 PM
-- Server version: 10.1.31-MariaDB
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
(1, 'Admin', 'IT', 'Admin', 'IT', '2019-06-22 18:30:51'),
(2, '01 ì†Œê·¸ë£¹', '1 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 18:36:35'),
(3, '02 ì†Œê·¸ë£¹', '1 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 18:50:20'),
(4, '03 ì†Œê·¸ë£¹', '1 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 18:57:08'),
(5, '04 ì†Œê·¸ë£¹', '2 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 18:57:41'),
(6, '05 ì†Œê·¸ë£¹', '2 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 18:58:14'),
(7, '06 ì†Œê·¸ë£¹', '2 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 18:58:57'),
(8, '07 ì†Œê·¸ë£¹', '3 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 18:59:31'),
(9, '08 ì†Œê·¸ë£¹', '3 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 18:59:57'),
(10, '09 ì†Œê·¸ë£¹', '3 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 19:00:26'),
(11, '10 ì†Œê·¸ë£¹', '4 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:20:10'),
(12, '11 ì†Œê·¸ë£¹', '4 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:20:49'),
(13, '12 ì†Œê·¸ë£¹', '4 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:21:24'),
(14, '13 ì†Œê·¸ë£¹', '5 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:22:08'),
(15, '14 ì†Œê·¸ë£¹', '5 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:23:02'),
(16, '15 ì†Œê·¸ë£¹', '5 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:23:35'),
(17, '16 ì†Œê·¸ë£¹', '6 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:24:10'),
(18, '17 ì†Œê·¸ë£¹', '6 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:24:45'),
(19, '18 ì†Œê·¸ë£¹', '6 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:25:15'),
(20, '19 ì†Œê·¸ë£¹', '7 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:25:59'),
(21, '20 ì†Œê·¸ë£¹', '7 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:26:28'),
(22, '21 ì†Œê·¸ë£¹', '7 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:27:02'),
(23, '22 ì†Œê·¸ë£¹', '8 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:27:35'),
(24, '23 ì†Œê·¸ë£¹', '8 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:28:06'),
(25, '24 ì†Œê·¸ë£¹', '8 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:28:39'),
(26, '25 ì†Œê·¸ë£¹', '9 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:29:09'),
(27, '26 ì†Œê·¸ë£¹', '9 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:29:45'),
(28, '27 ì†Œê·¸ë£¹', '9 êµêµ¬', 'User', 'êµêµ¬ëª¨ìž„', '2019-06-22 20:30:09'),
(29, 'ì˜ˆë°°ë¶€', 'ì˜ˆë°°ìœ„ì›íšŒ', 'User', 'ì„±ë„ë“¤ì˜ ì˜ˆë°°ì— ì€í˜œ ë° í‰ì•ˆí•œ ì˜ˆë°° ë„ëª¨. ì˜ˆë°° ì•ˆë‚´ ë° í™˜ê²½ ì¤€ë¹„ì— ê´€í•œ ì œë°˜ ì‚¬í•­ ë‹´ë‹¹.', '2019-06-22 20:31:11'),
(34, 'ì˜ì•„ë¶€', 'êµìœ¡ë¶€', 'User', 'ì˜ì•„ë¶€', '2019-06-22 20:35:58'),
(37, 'ì¤‘ë“±ë¶€', 'êµìœ¡ë¶€', 'User', 'ì¤‘ë“±ë¶€', '2019-06-22 20:38:09'),
(45, 'IT', 'ì „ë¬¸ì‚¬ì—­', 'User', 'ì „ë¬¸ì‚¬ì—­', '2019-07-30 13:20:42'),
(54, 'ì‹œì„¤ê´€ë¦¬ë¶€', 'ê´€ë¦¬ìœ„ì›íšŒ', 'User', 'êµíšŒì˜ ì „ë°˜ì ì¸ ì‹œì„¤ ê´€ë¦¬, ìœ ì§€, ë³´ìˆ˜ ì‚¬ì—­.', '2019-07-30 15:07:29'),
(55, 'ì£¼ì°¨ì•ˆë‚´ë¶€', 'ê´€ë¦¬ìœ„ì›íšŒ', 'User', 'ì£¼ì¼ ì˜ˆë°° ë° í–‰ì‚¬ì— ì„±ë„ ì•ˆì „ ì£¼ì°¨ ë„ëª¨.', '2019-07-30 15:08:28'),
(56, 'ì°¨ëŸ‰ë¶€', 'ê´€ë¦¬ìœ„ì›íšŒ', 'User', 'ì°¨ëŸ‰ìš´í–‰ ë¶ˆê°€ ì„±ë„ ì°¨ëŸ‰ìš´í–‰ ì§€ì›, êµíšŒ ì°¨ëŸ‰ ì»¨ë””ì…˜ ìœ ì§€ ê´€ë¦¬.', '2019-07-30 15:09:39'),
(57, 'í™˜ê²½ë¯¸í™”ë¶€', 'ê´€ë¦¬ìœ„ì›íšŒ', 'User', 'êµíšŒ ë‚´ì™¸ ì²­ê²½ í™˜ê²½ ìœ ì§€.', '2019-07-30 15:10:42'),
(59, 'ëŒ€í•™ë¶€', 'êµìœ¡ë¶€', 'User', 'ëŒ€í•™ë¶€', '2019-08-21 13:09:53'),
(61, 'ìƒˆê°€ì¡±ë¶€', 'ì˜ˆë°°ìœ„ì›íšŒ', 'User', 'ìƒˆ ì„±ë„ ì˜ì ‘, êµíšŒ ì†Œê°œ ë° ë“±ë¡ ì•ˆë‚´. ìƒˆ ì„±ë„ ì •ì°© ë„ëª¨.', '2019-10-24 06:13:53');

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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `event_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
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
  `reservCreated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `reservStatus` tinyint(1) NOT NULL DEFAULT '0',
  `reservMsg` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`reservID`, `reservDate`, `rmReserv`, `reservTime`, `endTime`, `reservPurpose`, `reservGroup`, `reservCreated`, `reservStatus`, `reservMsg`) VALUES
(113, '2019-10-27', 1, '08:00:00', '09:00:00', 'ì´ë¥¸ë¹„ì˜ˆë°°', 29, '2019-10-24 06:07:30', 1, NULL),
(114, '2019-10-27', 1, '10:00:00', '11:00:00', 'ë‹¨ë¹„ì˜ˆë°°', 29, '2019-10-24 06:08:09', 1, NULL),
(115, '2019-10-27', 1, '12:00:00', '13:00:00', 'í°ë¹„ì˜ˆë°°', 29, '2019-10-24 06:08:49', 1, NULL),
(116, '2019-10-27', 1, '14:00:00', '15:00:00', 'EM ì˜ˆë°°', 29, '2019-10-24 06:10:12', 1, NULL),
(118, '2019-10-29', 1, '19:00:00', '20:00:00', 'ê³ ê³ ë²”ì„', 11, '2019-10-29 17:31:45', 1, NULL),
(120, '2019-11-10', 10, '18:00:00', '20:30:00', 'Test event', 29, '2019-11-03 20:03:12', 1, NULL),
(121, '2019-11-10', 1, '08:00:00', '09:00:00', 'ì´ë¥¸ë¹„ì˜ˆë°°', 29, '2019-11-04 09:27:53', 1, NULL),
(122, '2019-11-10', 1, '10:00:00', '11:00:00', 'ë‹¨ë¹„ì˜ˆë°°', 29, '2019-11-04 09:28:41', 1, NULL);

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
(1, 'ë³¸ë‹¹', '1ì¸µ', 'Main Sanctuary', 300, '09:00:00', '21:00:00', 1, '2019-06-22 18:37:55'),
(2, 'ì¹œêµì‹¤', '1ì¸µ', 'Fellowship Hall', 100, '08:00:00', '20:00:00', 0, '2019-06-22 18:51:46'),
(3, 'ì˜ì•„ì‹¤', '1ì¸µ ë³¸ë‹¹ ë’¤', 'Playroom', 15, '08:00:00', '20:00:00', 0, '2019-06-22 19:02:13'),
(4, 'ë’·ëœ°', 'êµíšŒê±´ë¬¼ ë’¤', 'ì•¼ì™¸', 30, '09:00:00', '21:00:00', 0, '2019-06-22 20:41:02'),
(5, 'ì•žëœ°', 'êµíšŒê±´ë¬¼ ì•ž', 'ì•¼ì™¸', 20, '09:00:00', '21:00:00', 0, '2019-06-22 20:42:25'),
(6, 'ì°¬ì–‘ëŒ€ ì—°ìŠµì‹¤', '1ì¸µ, ë³µë„ë', 'ì°¬ì–‘ëŒ€ ì—°ìŠµì‹¤', 40, '09:00:00', '21:00:00', 1, '2019-06-23 20:10:26'),
(8, 'íšŒì˜ì‹¤ 1', '1ì¸µ', 'íšŒì˜ì‹¤', 20, '09:00:00', '21:00:00', 0, '2019-07-04 14:03:16'),
(9, 'íšŒì˜ì‹¤ 2', '1ì¸µ', 'íšŒì˜ì‹¤', 30, '21:00:00', '21:00:00', 0, '2019-07-24 16:59:03'),
(10, 'ë¹„ì „í™€', '1ì¸µ', 'ë¹„ì „í™€', 50, '09:00:00', '21:00:00', 1, '2019-07-30 13:14:13'),
(11, 'ìœ ì¹˜ë¶€ì‹¤', '1ì¸µ', 'ìœ ì¹˜ë¶€ì‹¤', 20, '09:00:00', '21:00:00', 0, '2019-08-19 21:21:01'),
(13, 'Meeting Room', '1st Floor', 'Meeting Room', 25, '09:00:00', '21:00:00', 1, '2019-10-11 22:38:07'),
(14, 'ë¶€ì—Œ', '1ì¸µ', 'Kitchin', 5, '08:00:00', '20:00:00', 0, '2019-11-03 20:04:34');

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
  `user_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active_status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_firstname`, `user_mi`, `user_lastname`, `user_email`, `cellPhoneNum`, `user_group_fk`, `user_kor_name`, `user_title`, `user_name`, `user_pwd`, `user_token`, `user_expire`, `user_created`, `active_status`) VALUES
(1, 'Keith', NULL, 'Roh', 'roh710@msn.com', '201-315-2126', 1, 'ë…¸ê¸°ì˜', 'ì§‘ì‚¬', 'admin', '$2y$10$MSsaE3RX/TfH04mv8ynnmeqZNnrkpy8m3Y0IPvEJFa0w8tt6.Kh3m', NULL, NULL, '2019-08-23 18:13:16', 1),
(4, 'Ki', NULL, 'Roh', 'roh710@gmail.com', '201-315-2126', 1, 'ë…¸ê¸°ì˜', 'ì§‘ì‚¬', 'roh710', '$2y$10$C0q14PMVCPsBXCynywRazuGkPKyRYJ6AvYRXkIf2x9Y0dPO0kVhbu', NULL, NULL, '2019-08-23 18:24:39', 1),
(17, 'Youngtae', NULL, 'Cho', 'cdnj.org@gmail.com', '201-401-3208', 1, '조영태', '목사', 'cdnjadmin', '$2y$10$GTZpvpkDJkjQVubZTRwouOBQKh59.Sb4QsHS.EsBlikajt3qk8Tpa', NULL, NULL, '2019-08-23 18:09:42', 1),
(20, 'Group', NULL, 'One', 'group1@mail.com', '000-000-0000', 2, '그룹', '원', 'group1', '$2y$10$DL1z6fNQOU76jIaJIc.dZeFY/tNaKV8HgW2mqlGXV/7Pk7VRRUVQe', NULL, NULL, '2019-08-23 18:27:43', 1),
(21, 'Test', NULL, 'admin', 'testadmin@mail.com', '000-000-0000', 1, '테스트', '관리자', 'testadmin', '$2y$10$pZ0t3nDKGKeuyp1Rw6c1gOgvqPoJkDN.4t3fpDWEsLD5O8khOMo7q', NULL, NULL, '2019-08-23 19:29:37', 1),
(22, 'Group', NULL, 'Two', 'group2@mail.com', '000-000-0000', 3, '그룹', '투', 'group2', '$2y$10$L.vxgXIdbafnv217HJp6IubNZ93J91LmFWkceBJxopgVUAfA4IXnO', NULL, NULL, '2019-08-24 00:03:46', 0),
(23, 'Jinju', NULL, 'Kim', 'gbyedu@gmail.com', '201-968-7719', 1, '김진주', '목사', 'edurev', '$2y$10$SX/rXXvr8Ccgt2iIeDwIIure8BfHPAJmGmtDlEthrkzxytT7PkU3.', NULL, NULL, '2019-09-03 13:39:08', 0),
(25, 'seunghwan', NULL, 'park', 'ezrapark80@outlook.com', '201-707-1746', 54, '박승환', '목사', 'ezrapark', '$2y$10$JIXjsDBeH/LYdQxB0aDqfuzzG0lha9q4XpHro8gz.0qyCRnDbSrkK', NULL, NULL, '2019-09-04 10:30:40', 1),
(26, 'SunJin', NULL, 'Park', 'sjpark0802@hotmail.com', '201-749-2788', 1, 'ë°•ìˆœì§„', 'ëª©ì‚¬', 'sjpark0802', '$2y$10$r2JAj4rT0lL11hmJrMgO.e3UkAEo05jrmIViMfbN5NzAov6WUAHS2', NULL, NULL, '2019-09-04 10:33:39', 1),
(27, 'Bumseok', NULL, 'Ko', 'kobumseok80@gmail.com', '201-213-9080', 1, 'ê³ ê³ ë²”ì„', 'ëª©ì‚¬', 'kkokko98', '$2y$10$R0cDyCJqtf5TYytTfEnemeccwaFeoWjsYVRrAkCOMnxCMVSd8YE/K', NULL, NULL, '2019-09-04 10:35:34', 1),
(28, 'Hong', NULL, 'Kil-Dong', 'group3@gmail.com', '201-345-5678', 4, '홍길동', '성도', 'group03', '$2y$10$xraaCq4k0QYd0SYtsfwlze8Q9UWkWlw3utNfkZKFaQJwqtb5Y.Pk2', NULL, NULL, '2019-10-11 20:17:14', 0),
(29, 'Hong', NULL, 'Kil-Dong', 'khong@gmail.com', '201-678-0989', 57, 'í™ê¸¸ë™', 'ì„±ë„', 'kdhong', '$2y$10$LT3xFZqT48ckAIfEsuHuzO04oLqfugvY.A2BHPQ8hE3Snd6vD5pOG', NULL, NULL, '2019-10-19 09:26:25', 0),
(30, 'Kil-Dong', NULL, 'Hong', 'khong@gmail.com', '201-678-0989', 28, 'í™ê¸¸ë™', 'ì„±ë„', 'kdhong', '$2y$10$FaazSP99DxOZRZkqsjmw..kOMLoz387RQEQqhXkWKHaUw4jM/xqay', NULL, NULL, '2019-10-23 17:04:08', 0);

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
  `date_time_stamp` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_conn_info`
--

INSERT INTO `user_conn_info` (`user_conn_id`, `user_fk`, `ip_addr`, `isp`, `country`, `city`, `region`, `zip`, `date_time_stamp`) VALUES
(131, 1, '107.77.106.16', 'AT&T Mobility LLC', 'United States', 'Boston', 'MA', '02112', '2019-08-31 17:56:52'),
(136, 1, '107.77.106.16', 'AT&T Services, Inc.', 'United States', 'Boston', 'MA', '02112', '2019-09-03 07:51:31'),
(137, 1, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-09-03 07:53:26'),
(142, 23, '174.225.134.16', 'Cellco Partnership DBA Verizon Wireless', 'United States', 'Hoboken', 'NJ', '07030', '2019-09-03 13:44:34'),
(144, 1, '47.23.107.142', 'Optimum Online', 'United States', 'Lyndhurst', 'NJ', '07071', '2019-09-04 14:41:21'),
(145, 1, '107.77.106.16', 'AT&T Services, Inc.', 'United States', 'Boston', 'MA', '02112', '2019-09-04 14:42:19'),
(148, 1, '108.53.114.106', 'Verizon Communications', 'United States', 'Paramus', 'NJ', '07652', '2019-09-09 11:29:26'),
(157, 1, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-09-16 18:10:37'),
(159, 1, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-09-19 08:29:18'),
(160, 22, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-09-19 08:29:43'),
(161, 1, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-09-27 20:57:05'),
(163, 1, '8.46.116.148', 'Level 3', 'United States', 'San Francisco', 'CA', '94107', '2019-09-29 13:32:01'),
(165, 1, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-09-29 19:23:48'),
(166, 1, '8.46.116.94', 'Level 3', 'United States', 'San Francisco', 'CA', '94107', '2019-09-29 19:25:40'),
(167, 1, '8.46.116.148', 'Level 3', 'United States', 'San Francisco', 'CA', '94107', '2019-09-30 17:28:25'),
(168, 1, '107.77.70.50', 'AT&T Mobility LLC', 'United States', 'Boston', 'MA', '02112', '2019-10-01 18:35:51'),
(169, 1, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-01 22:16:51'),
(170, 1, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-06 13:53:49'),
(171, 22, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-08 16:14:19'),
(172, 1, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-08 19:44:55'),
(173, 22, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-10 14:51:15'),
(174, 22, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-10 14:52:14'),
(179, 21, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-11 14:42:43'),
(180, 20, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-11 14:47:16'),
(181, 20, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-11 18:27:32'),
(182, 20, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-11 18:28:19'),
(183, 28, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-11 20:18:30'),
(184, 28, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-11 20:21:35'),
(185, 28, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-11 20:22:19'),
(186, 20, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-11 22:00:11'),
(187, 21, '58.123.21.114', 'SK Broadband Co Ltd', 'South Korea', 'Seoul', '11', '', '2019-10-11 22:54:57'),
(188, 29, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-19 09:27:58'),
(189, 29, '173.2.128.62', 'Cablevision Systems Corp.', 'United States', 'North Bergen', 'NJ', '07047', '2019-10-19 09:29:16');

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userinfo_perm`  AS  select `users`.`user_id` AS `user_id`,`users`.`user_firstname` AS `user_firstname`,`users`.`user_lastname` AS `user_lastname`,`users`.`user_email` AS `user_email`,`users`.`user_kor_name` AS `user_kor_name`,`users`.`user_title` AS `user_title`,`users`.`user_name` AS `user_name`,`users`.`user_pwd` AS `user_pwd`,`users`.`active_status` AS `active_status`,`cdnj_group`.`user_perm_level` AS `user_perm_level`,`cdnj_group`.`grId` AS `grId`,`cdnj_group`.`grName` AS `grName` from (`users` join `cdnj_group` on((`users`.`user_group_fk` = `cdnj_group`.`grId`))) ;

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
  MODIFY `grId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `perm_events`
--
ALTER TABLE `perm_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=123;

--
-- AUTO_INCREMENT for table `rmlist`
--
ALTER TABLE `rmlist`
  MODIFY `rmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `user_conn_info`
--
ALTER TABLE `user_conn_info`
  MODIFY `user_conn_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

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
  ADD CONSTRAINT `reservations_ibfk_2` FOREIGN KEY (`reservGroup`) REFERENCES `cdnj_group` (`grId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_group_fk`) REFERENCES `cdnj_group` (`grId`) ON UPDATE CASCADE;

--
-- Constraints for table `user_conn_info`
--
ALTER TABLE `user_conn_info`
  ADD CONSTRAINT `user_conn_info_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
