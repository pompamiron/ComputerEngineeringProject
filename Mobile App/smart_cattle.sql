-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 23, 2020 at 07:29 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `smart_cattle`
--

-- --------------------------------------------------------

--
-- Table structure for table `behavior_data`
--

CREATE TABLE `behavior_data` (
  `ID` int(10) NOT NULL,
  `cowID` int(10) NOT NULL,
  `behavior` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `duration` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `behavior_data`
--

INSERT INTO `behavior_data` (`ID`, `cowID`, `behavior`, `time`, `duration`) VALUES
(1, 3, 'sleep', '2019-11-16 07:56:14', 3785),
(2, 2, 'sleep', '2019-11-16 08:04:33', 3046),
(3, 1, 'sleep', '2019-11-16 08:16:07', 877),
(4, 4, 'sleep', '2019-11-16 08:27:10', 601),
(5, 1, 'eat', '2019-11-16 08:30:44', 2815),
(6, 4, 'eat', '2019-11-16 08:37:11', 3004),
(7, 2, 'walk', '2019-11-16 08:55:59', 354),
(8, 3, 'walk', '2019-11-16 08:59:19', 664),
(9, 2, 'sleep', '2019-11-16 09:01:13', 3547),
(10, 3, 'sleep', '2019-11-16 09:10:23', 3117),
(11, 1, 'walk', '2020-05-18 09:17:39', 1291),
(12, 4, 'walk', '2019-11-16 09:27:15', 349),
(13, 4, 'sleep', '2019-11-16 09:33:04', 3416),
(14, 1, 'sleep', '2019-11-16 09:39:10', 2122),
(15, 2, 'walk', '2019-11-16 10:00:20', 327),
(16, 3, 'walk', '2019-11-16 10:02:20', 429),
(17, 2, 'sleep', '2019-11-16 10:05:47', 1988),
(18, 3, 'sleep', '2019-11-16 10:09:29', 3067),
(19, 1, 'walk', '2019-11-16 10:14:32', 6421),
(20, 4, 'walk', '2019-11-16 10:30:00', 165),
(21, 4, 'sleep', '2019-11-16 10:32:45', 3731),
(22, 2, 'walk', '2019-11-16 10:38:55', 3579),
(23, 3, 'walk', '2019-11-16 11:00:36', 3904),
(24, 4, 'walk', '2019-11-16 11:34:56', 2348),
(25, 2, 'eat', '2019-11-16 11:38:34', 7980),
(26, 1, 'eat', '2019-11-16 12:01:33', 3318),
(27, 3, 'eat', '2019-11-16 12:05:40', 4143),
(28, 4, 'eat', '2019-11-16 12:14:04', 7698),
(29, 1, 'walk', '2019-11-16 12:56:51', 7133),
(30, 3, 'walk', '2019-11-16 13:14:43', 5166),
(31, 2, 'walk', '2019-11-16 13:51:34', 3289),
(32, 4, 'walk', '2019-11-16 14:22:22', 623),
(33, 4, 'sleep', '2019-11-16 14:32:45', 3119),
(34, 3, 'eat', '2019-11-16 14:40:49', 1203),
(35, 2, 'eat', '2019-11-16 14:46:23', 4417),
(36, 1, 'sleep', '2019-11-16 14:55:44', 569),
(37, 3, 'walk', '2019-11-16 15:00:52', 4025),
(38, 1, 'walk', '2019-11-16 15:05:13', 3380),
(39, 4, 'walk', '2019-11-16 15:24:44', 2991),
(40, 2, 'walk', '2019-11-16 16:00:00', 2576),
(41, 1, 'eat', '2019-11-16 16:01:33', 4140),
(42, 3, 'eat', '2019-11-16 16:07:57', 3785),
(43, 4, 'eat', '2019-11-16 16:14:35', 2618),
(44, 2, 'sleep', '2019-11-16 16:42:56', 4676),
(45, 4, 'walk', '2019-11-16 16:59:16', 1660),
(46, 1, 'walk', '2019-11-16 17:10:33', 1801),
(47, 3, 'walk', '2019-11-16 17:11:02', 724),
(48, 3, 'sleep', '2019-11-16 17:23:06', 3424),
(49, 4, 'sleep', '2019-11-16 17:26:56', 5437),
(50, 1, 'sleep', '2019-11-16 17:40:34', 2130),
(51, 2, 'walk', '2019-11-16 18:00:52', 51),
(52, 2, 'eat', '2019-11-16 18:01:43', 796),
(53, 2, 'sleep', '2019-11-16 18:14:59', 3624),
(54, 1, 'walk', '2019-11-16 18:16:04', 421),
(55, 3, 'walk', '2019-11-16 18:20:10', 903),
(56, 1, 'sleep', '2019-11-16 18:23:05', 8700),
(57, 3, 'sleep', '2019-11-16 18:35:13', 2104),
(58, 4, 'walk', '2019-11-16 18:57:33', 2649),
(59, 3, 'walk', '2019-11-16 19:10:17', 3844),
(60, 2, 'walk', '2019-11-16 19:15:23', 8496),
(61, 4, 'eat', '2019-11-16 19:41:42', 1083),
(62, 4, 'walk', '2019-11-16 19:59:45', 3708),
(63, 3, 'eat', '2019-11-16 20:14:21', 3363),
(64, 1, 'walk', '2019-11-16 20:48:05', 3287),
(65, 4, 'sleep', '2019-11-16 21:01:33', 4020),
(66, 3, 'walk', '2019-11-16 21:10:24', 2702),
(67, 2, 'sleep', '2019-11-16 21:36:59', 3501),
(68, 1, 'eat', '2019-11-16 21:42:52', 691),
(69, 1, 'walk', '2019-11-16 21:54:23', 1057),
(70, 3, 'sleep', '2019-11-16 21:55:26', 2401),
(71, 1, 'sleep', '2020-05-22 01:55:27', NULL),
(72, 4, 'sleep', '2020-05-22 02:03:05', NULL),
(79, 3, 'sleep', '2020-05-22 03:51:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cow`
--

CREATE TABLE `cow` (
  `cowID` int(10) NOT NULL,
  `farmID` int(10) NOT NULL,
  `hwID1` int(10) NOT NULL,
  `hwID2` int(10) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `birthDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cow`
--

INSERT INTO `cow` (`cowID`, `farmID`, `hwID1`, `hwID2`, `name`, `birthDate`) VALUES
(1, 1, 1, 2, 'Sunny', '2019-04-05'),
(2, 1, 3, 4, 'Chuti', '2019-02-20'),
(3, 2, 5, 6, 'Pompam', '2019-03-22'),
(4, 2, 7, 8, 'Kampoo', '2019-07-17');

-- --------------------------------------------------------

--
-- Table structure for table `farm`
--

CREATE TABLE `farm` (
  `farmID` int(10) NOT NULL,
  `farmName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `farm`
--

INSERT INTO `farm` (`farmID`, `farmName`, `username`, `password`) VALUES
(1, 'Chokchai_Farm', 'v1', 'v1'),
(2, 'KMUTT_Farm', 'v2', 'v4');

-- --------------------------------------------------------

--
-- Table structure for table `general_data`
--

CREATE TABLE `general_data` (
  `ID` int(10) NOT NULL,
  `cowID` int(10) NOT NULL,
  `action` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `general_data`
--

INSERT INTO `general_data` (`ID`, `cowID`, `action`, `time`) VALUES
(1, 1, 'illness', '2019-11-15 22:00:05'),
(2, 4, 'vaccination', '2019-11-16 00:30:22'),
(3, 1, 'vaccination', '2019-11-16 03:50:15'),
(4, 3, 'hormone vaccination', '2019-11-17 08:27:28'),
(5, 2, 'illness', '2019-11-18 13:17:15'),
(6, 2, 'vaccination', '2019-11-19 01:47:18'),
(7, 1, 'illness', '2020-05-10 14:32:32'),
(8, 2, 'illness', '2020-05-10 14:46:29'),
(9, 1, 'vaccination', '2020-05-10 14:50:13'),
(10, 1, 'illness', '2020-05-10 15:02:43'),
(11, 1, 'vaccination', '2020-05-12 07:24:28'),
(12, 1, 'illness', '2020-05-12 07:30:25'),
(13, 2, 'vaccination', '2020-05-21 20:49:02'),
(14, 4, 'vaccination', '2020-05-22 08:54:58'),
(15, 4, 'vaccination', '2020-05-22 09:01:27');

-- --------------------------------------------------------

--
-- Table structure for table `hardware`
--

CREATE TABLE `hardware` (
  `hwID` int(10) NOT NULL,
  `installPath` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hardware`
--

INSERT INTO `hardware` (`hwID`, `installPath`, `name`) VALUES
(1, 'neck', 'neck001'),
(2, 'tail', 'tail001'),
(3, 'neck', 'neck002'),
(4, 'tail', 'tail002'),
(5, 'neck', 'neck003'),
(6, 'tail', 'tail003'),
(7, 'neck', 'neck004'),
(8, 'tail', 'tail004'),
(9, 'neck', 'neck005'),
(10, 'tail', 'tail005');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `behavior_data`
--
ALTER TABLE `behavior_data`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cowID` (`cowID`);

--
-- Indexes for table `cow`
--
ALTER TABLE `cow`
  ADD PRIMARY KEY (`cowID`),
  ADD KEY `farmID` (`farmID`),
  ADD KEY `hwID1` (`hwID1`),
  ADD KEY `hwID2` (`hwID2`);

--
-- Indexes for table `farm`
--
ALTER TABLE `farm`
  ADD PRIMARY KEY (`farmID`);

--
-- Indexes for table `general_data`
--
ALTER TABLE `general_data`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `cowID` (`cowID`);

--
-- Indexes for table `hardware`
--
ALTER TABLE `hardware`
  ADD PRIMARY KEY (`hwID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `behavior_data`
--
ALTER TABLE `behavior_data`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `cow`
--
ALTER TABLE `cow`
  MODIFY `cowID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `farm`
--
ALTER TABLE `farm`
  MODIFY `farmID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_data`
--
ALTER TABLE `general_data`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `hardware`
--
ALTER TABLE `hardware`
  MODIFY `hwID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `behavior_data`
--
ALTER TABLE `behavior_data`
  ADD CONSTRAINT `behavior_data_ibfk_1` FOREIGN KEY (`cowID`) REFERENCES `cow` (`cowID`);

--
-- Constraints for table `cow`
--
ALTER TABLE `cow`
  ADD CONSTRAINT `cow_ibfk_1` FOREIGN KEY (`farmID`) REFERENCES `farm` (`farmID`),
  ADD CONSTRAINT `cow_ibfk_2` FOREIGN KEY (`hwID1`) REFERENCES `hardware` (`hwID`),
  ADD CONSTRAINT `cow_ibfk_3` FOREIGN KEY (`hwID2`) REFERENCES `hardware` (`hwID`);

--
-- Constraints for table `general_data`
--
ALTER TABLE `general_data`
  ADD CONSTRAINT `general_data_ibfk_1` FOREIGN KEY (`cowID`) REFERENCES `cow` (`cowID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
