-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 23, 2019 at 12:09 PM
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

--
-- Indexes for dumped tables
--

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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`user_group_fk`) REFERENCES `cdnj_group` (`grId`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
