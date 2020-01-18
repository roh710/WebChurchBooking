-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2019 at 12:23 PM
-- Server version: 10.3.11-MariaDB
-- PHP Version: 7.2.20

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
(1, 'Admin', '1 교구', 'Admin', '교구모임', '2019-06-22 18:30:51'),
(2, '01 소그룹', '1 교구', 'User', '교구모임', '2019-06-22 18:36:35'),
(3, '02 소그룹', '1 교구', 'User', '교구모임', '2019-06-22 18:50:20'),
(4, '03 소그룹', '1 교구', 'User', '교구모임', '2019-06-22 18:57:08'),
(5, '04 소그룹', '2 교구', 'User', '교구모임', '2019-06-22 18:57:41'),
(6, '05 소그룹', '2 교구', 'User', '교구모임', '2019-06-22 18:58:14'),
(7, '06 소그룹', '2 교구', 'User', '교구모임', '2019-06-22 18:58:57'),
(8, '07 소그룹', '3 교구', 'User', '교구모임', '2019-06-22 18:59:31'),
(9, '08 소그룹', '3 교구', 'User', '교구모임', '2019-06-22 18:59:57'),
(10, '09 소그룹', '3 교구', 'User', '교구모임', '2019-06-22 19:00:26'),
(11, '10 소그룹', '4 교구', 'User', '교구모임', '2019-06-22 20:20:10'),
(12, '11 소그룹', '4 교구', 'User', '교구모임', '2019-06-22 20:20:49'),
(13, '12 소그룹', '4 교구', 'User', '교구모임', '2019-06-22 20:21:24'),
(14, '13 소그룹', '5 교구', 'User', '교구모임', '2019-06-22 20:22:08'),
(15, '14 소그룹', '5 교구', 'User', '교구모임', '2019-06-22 20:23:02'),
(16, '15 소그룹', '5 교구', 'User', '교구모임', '2019-06-22 20:23:35'),
(17, '16 소그룹', '6 교구', 'User', '교구모임', '2019-06-22 20:24:10'),
(18, '17 소그룹', '6 교구', 'User', '교구모임', '2019-06-22 20:24:45'),
(19, '18 소그룹', '6 교구', 'User', '교구모임', '2019-06-22 20:25:15'),
(20, '19 소그룹', '7 교구', 'User', '교구모임', '2019-06-22 20:25:59'),
(21, '20 소그룹', '7 교구', 'User', '교구모임', '2019-06-22 20:26:28'),
(22, '21 소그룹', '7 교구', 'User', '교구모임', '2019-06-22 20:27:02'),
(23, '22 소그룹', '8 교구', 'User', '교구모임', '2019-06-22 20:27:35'),
(24, '23 소그룹', '8 교구', 'User', '교구모임', '2019-06-22 20:28:06'),
(25, '24 소그룹', '8 교구', 'User', '교구모임', '2019-06-22 20:28:39'),
(26, '25 소그룹', '9 교구', 'User', '교구모임', '2019-06-22 20:29:09'),
(27, '26 소그룹', '9 교구', 'User', '교구모임', '2019-06-22 20:29:45'),
(28, '27 소그룹', '9 교구', 'User', '교구모임', '2019-06-22 20:30:09'),
(29, '예배부', '예배위원회', 'User', '성도들의 예배에 은혜 및 평안한 예배 도모. 예배 안내 및 환경 준비에 관한 제반 사항 담당.', '2019-06-22 20:31:11'),
(30, '선교부', '선교회', 'User', '선교 총괄', '2019-06-22 20:32:12'),
(31, '봉사부', '교제위원회', 'User', '봉사 사역', '2019-06-22 20:33:31'),
(32, '청년부', '교육부', 'User', '청년모임', '2019-06-22 20:34:24'),
(33, '중고등부', '교육부', 'User', '중고등부 모임', '2019-06-22 20:35:14'),
(34, '영아부', '교육부', 'User', '영아부', '2019-06-22 20:35:58'),
(35, '남선교회', '선교회', 'User', '남선교회', '2019-06-22 20:36:58'),
(36, '여선교회', '선교회', 'User', '여선교회', '2019-06-22 20:37:34'),
(37, '유치부', '교육부', 'User', '유치부', '2019-06-22 20:38:09'),
(38, '장로회', '당회', 'User', '장로회', '2019-06-22 20:39:02'),
(39, '이른비 찬양대', '찬양부', 'User', '1부 성가대', '2019-06-23 20:12:47'),
(43, '단비 찬양대', '찬양부', 'User', '2부 성가대', '2019-07-16 07:29:05'),
(44, '할렐루야 찬양대', '찬양부', 'User', '3부 성가대', '2019-07-18 12:19:28'),
(45, 'IT', '전문사역', 'User', '전문사역', '2019-07-30 13:20:42'),
(46, '해외선교부', '선교 위원회', 'User', '해외 선교 사역', '2019-07-30 14:47:23'),
(47, '전도부', '선교 위원회', 'User', '전도사역', '2019-07-30 14:49:52'),
(48, '구제부', '선교 위원회', 'User', '구제 사역', '2019-07-30 14:59:35'),
(49, '병원선교부', '선교 위원회', 'User', '병원선교 사역', '2019-07-30 15:00:29'),
(50, '친교부', '교제위원회', 'User', '친교부', '2019-07-30 15:01:23'),
(52, '스포츠사역부', '교제위원회', 'User', '스포츠 사역', '2019-07-30 15:04:49'),
(53, '경조부', '교제위원회', 'User', '경조 사역', '2019-07-30 15:06:03'),
(54, '시설관리부', '관리위원회', 'User', '교회의 전반적인 시설 관리, 유지, 보수 사역.', '2019-07-30 15:07:29'),
(55, '주차안내부', '관리위원회', 'User', '주일 예배 및 행사에 성도 안전 주차 도모.', '2019-07-30 15:08:28'),
(56, '차량부', '관리위원회', 'User', '차량운행 불가 성도 차량운행 지원, 교회 차량 컨디션 유지 관리.', '2019-07-30 15:09:39'),
(57, '환경미화부', '관리위원회', 'User', '교회 내외 청경 환경 유지.', '2019-07-30 15:10:42'),
(58, '새가족부', '예배위원회', 'User', '새 성도 영접, 교회 소개 및 등록 안내. 새 성도 정착 도모.', '2019-07-30 15:12:40'),
(59, '대학부', '교육부', 'User', '대학부', '2019-08-21 13:09:53'),
(60, 'test gr1', 'test', 'User', 'test', '2019-10-13 15:49:02');

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

--
-- Dumping data for table `perm_events`
--

INSERT INTO `perm_events` (`event_id`, `event_name`, `event_desc`, `event_wkday`, `event_st_date`, `event_end_date`, `event_st_time`, `event_end_time`, `rmlist_fk`, `grId_fk`, `status`, `event_updated`) VALUES
(1, '이른비 예배', '8시 예뱌', 1, NULL, NULL, '08:00:00', '09:00:00', 1, 29, 1, '2019-06-23 20:17:50'),
(2, '단비 예배', '10시 예재', 1, NULL, NULL, '10:00:00', '11:00:00', 1, 29, 1, '2019-06-23 20:21:34'),
(3, '큰비 예배', '12시 예배', 1, NULL, NULL, '12:00:00', '13:00:00', 1, 29, 1, '2019-06-23 20:21:34'),
(5, 'Bible study', 'Bible study', NULL, '2019-07-01', '2019-07-06', '10:00:00', '12:00:00', 6, 1, 1, '2019-06-28 06:10:11');

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
(90, '2019-10-27', 1, '12:00:00', '13:00:00', '큰비예배 ', 29, '2019-08-31 17:04:53', 1, NULL),
(91, '2019-10-27', 1, '14:00:00', '15:00:00', 'EM Worship ', 29, '2019-08-31 17:06:08', 1, NULL),
(95, '2019-11-10', 5, '15:45:00', '17:45:00', '찬양팀식사', 13, '2019-09-03 13:45:20', 1, NULL),
(99, '2019-10-27', 10, '08:00:00', '09:00:00', 'Test', 2, '2019-09-27 20:56:05', 1, NULL),
(103, '2019-10-27', 5, '07:30:00', '18:00:00', 'Test', 3, '2019-10-08 16:17:42', 1, NULL),
(107, '2019-10-27', 1, '10:00:00', '11:00:00', '단비예배', 29, '2019-10-19 15:07:59', 1, NULL),
(108, '2019-10-27', 1, '08:00:00', '09:00:00', '이른비예배', 29, '2019-10-19 15:09:24', 1, NULL),
(109, '2019-10-22', 4, '13:00:00', '14:00:00', 'Test', 28, '2019-10-22 13:01:48', 1, NULL),
(110, '2019-10-22', 13, '13:00:00', '14:00:00', 'Test', 3, '2019-10-22 13:03:05', 1, NULL),
(111, '2019-10-22', 1, '13:30:00', '14:30:00', 'Test', 4, '2019-10-22 15:36:47', 1, NULL);

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
(1, '본당', '1층', 'Main Sanctuary', 300, '09:00:00', '21:00:00', 1, '2019-06-22 18:37:55'),
(2, '친교실', '1층', 'Fellowship Hall', 100, '08:00:00', '20:00:00', 0, '2019-06-22 18:51:46'),
(3, '영아실', '1층 본당 뒤', 'Playroom', 15, '08:00:00', '20:00:00', 0, '2019-06-22 19:02:13'),
(4, '뒷뜰', '교회건물 뒤', '야외', 30, '09:00:00', '21:00:00', 0, '2019-06-22 20:41:02'),
(5, '앞뜰', '교회건물 앞', '야외', 20, '09:00:00', '21:00:00', 0, '2019-06-22 20:42:25'),
(6, '찬양대 연습실', '1층, 복도 끝', '찬양대 연습실', 40, '09:00:00', '21:00:00', 1, '2019-06-23 20:10:26'),
(8, '회의실 1', '1층', '회의실', 20, '09:00:00', '21:00:00', 0, '2019-07-04 14:03:16'),
(9, '회의실 2', '1층', '회의실', 30, '21:00:00', '21:00:00', 0, '2019-07-24 16:59:03'),
(10, '비전홀', '1층', '비전홀', 50, '09:00:00', '21:00:00', 1, '2019-07-30 13:14:13'),
(11, '유치부실', '1층', '유치부실', 20, '09:00:00', '21:00:00', 0, '2019-08-19 21:21:01'),
(13, 'Meeting Room', '1st Floor', 'Meeting Room', 25, '09:00:00', '21:00:00', 1, '2019-10-11 22:38:07');

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
(1, 'Keith', NULL, 'Roh', 'roh710@msn.com', '201-315-2126', 1, '노기영', '집사', 'admin', '$2y$10$EdrAdqm9xX7fdm5KR5gAb./uk2c8xkW9fMQ0xLwGL.q7bCIi.3LO2', NULL, NULL, '2019-08-23 18:13:16', 1),
(4, 'Ki', NULL, 'Roh', 'roh710@gmail.com', '201-315-2126', 1, '노기영', '집사', 'roh710', '$2y$10$EdrAdqm9xX7fdm5KR5gAb./uk2c8xkW9fMQ0xLwGL.q7bCIi.3LO2', NULL, NULL, '2019-08-23 18:24:39', 1),
(17, 'Youngtae', NULL, 'Cho', 'cdnj.org@gmail.com', '201-401-3208', 1, '조영태', '목사', 'cdnjadmin', '$2y$10$GTZpvpkDJkjQVubZTRwouOBQKh59.Sb4QsHS.EsBlikajt3qk8Tpa', NULL, NULL, '2019-08-23 18:09:42', 1),
(20, 'Group', NULL, 'One', 'group1@mail.com', '000-000-0000', 2, '그룹', '원', 'group1', '$2y$10$A9EQJvA5p7OoHhs.sPHLo.aeauxpopna2pwjbbtO/9oQCX8u6Hdc.', NULL, NULL, '2019-08-23 18:27:43', 1),
(21, 'Test', NULL, 'admin', 'testadmin@mail.com', '000-000-0000', 1, '테스트', '관리자', 'testadmin', '$2y$10$pZ0t3nDKGKeuyp1Rw6c1gOgvqPoJkDN.4t3fpDWEsLD5O8khOMo7q', NULL, NULL, '2019-08-23 19:29:37', 1),
(22, 'Group', NULL, 'Two', 'group2@mail.com', '000-000-0000', 3, '그룹', '투', 'group2', '$2y$10$Yj/GFEChxgxLuc0K6XBWJex6vCNKDkW7CpVD4Wx4BN4EZuUsO4UNG', NULL, NULL, '2019-08-24 00:03:46', 1),
(23, 'Jinju', NULL, 'Kim', 'gbyedu@gmail.com', '201-968-7719', 1, '김진주', '목사', 'edurev', '$2y$10$SX/rXXvr8Ccgt2iIeDwIIure8BfHPAJmGmtDlEthrkzxytT7PkU3.', NULL, NULL, '2019-09-03 13:39:08', 1),
(24, 'EK', NULL, 'Park', 'pih0303@outlook.com', '484-362-3458', 33, '박익휘', '전도사', 'pih0303', '$2y$10$/XHhun.7qTx59dDYJowMuuXVoJsXhGXC7mpyoeAwCChuVoHIXJbe2', NULL, NULL, '2019-09-04 10:29:13', 1),
(25, 'seunghwan', NULL, 'park', 'ezrapark80@outlook.com', '201-707-1746', 54, '박승환', '목사', 'ezrapark', '$2y$10$JIXjsDBeH/LYdQxB0aDqfuzzG0lha9q4XpHro8gz.0qyCRnDbSrkK', NULL, NULL, '2019-09-04 10:30:40', 1),
(26, 'SunJin', NULL, 'Park', 'sjpark0802@hotmail.com', '201-749-2788', 1, '박순진', '목사', 'sjpark0802', '$2y$10$r2JAj4rT0lL11hmJrMgO.e3UkAEo05jrmIViMfbN5NzAov6WUAHS2', NULL, NULL, '2019-09-04 10:33:39', 1),
(27, 'Bumseok', NULL, 'Ko', 'kobumseok80@gmail.com', '201-213-9080', 1, '고범석', '목사', 'kkokko98', '$2y$10$R0cDyCJqtf5TYytTfEnemeccwaFeoWjsYVRrAkCOMnxCMVSd8YE/K', NULL, NULL, '2019-09-04 10:35:34', 1),
(28, 'Hong', NULL, 'Kil-Dong', 'group3@gmail.com', '201-345-5678', 4, '홍길동', '성도', 'group03', '$2y$10$xraaCq4k0QYd0SYtsfwlze8Q9UWkWlw3utNfkZKFaQJwqtb5Y.Pk2', NULL, NULL, '2019-10-11 20:17:14', 1),
(29, 'Hong', NULL, 'Kil-Dong', 'khong@gmail.com', '201-678-0989', 57, '홍길동', '성도', 'kdhong', '$2y$10$8XOppYsAnQd1uyKELqPQxuuZ5wMH0fx9O.g224Mr.H3KF9LEQj2d6', NULL, NULL, '2019-10-19 09:26:25', 1);

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

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `rm_reserved`  AS  select `reservations`.`reservID` AS `reservID`,`reservations`.`reservDate` AS `reservDate`,`rmlist`.`rmName` AS `rmName`,`reservations`.`reservTime` AS `reservTime`,`reservations`.`endTime` AS `endTime`,`reservations`.`reservPurpose` AS `reservPurpose`,`cdnj_group`.`grName` AS `grName`,if(`reservations`.`reservStatus` = 0,'Pending','Approved') AS `status` from ((`reservations` join `rmlist` on(`reservations`.`rmReserv` = `rmlist`.`rmId`)) left join `cdnj_group` on(`reservations`.`reservGroup` = `cdnj_group`.`grId`)) where `reservations`.`reservDate` >= curdate() order by `reservations`.`reservDate` ;

-- --------------------------------------------------------

--
-- Structure for view `userinfo_perm`
--
DROP TABLE IF EXISTS `userinfo_perm`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `userinfo_perm`  AS  select `users`.`user_id` AS `user_id`,`users`.`user_firstname` AS `user_firstname`,`users`.`user_lastname` AS `user_lastname`,`users`.`user_email` AS `user_email`,`users`.`user_kor_name` AS `user_kor_name`,`users`.`user_title` AS `user_title`,`users`.`user_name` AS `user_name`,`users`.`user_pwd` AS `user_pwd`,`cdnj_group`.`user_perm_level` AS `user_perm_level`,`cdnj_group`.`grId` AS `grId`,`cdnj_group`.`grName` AS `grName` from (`users` join `cdnj_group` on(`users`.`user_group_fk` = `cdnj_group`.`grId`)) ;

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
  MODIFY `grId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `perm_events`
--
ALTER TABLE `perm_events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `reservID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `rmlist`
--
ALTER TABLE `rmlist`
  MODIFY `rmId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
  ADD CONSTRAINT `user_conn_info_ibfk_1` FOREIGN KEY (`user_fk`) REFERENCES `users` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
