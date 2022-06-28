-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 28, 2022 at 09:32 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tahfez`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `user` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `user`, `password`) VALUES
(1, 'admin', '1122');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int(11) NOT NULL,
  `groupNames` varchar(30) NOT NULL,
  `points` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `groupNames`, `points`) VALUES
(1, 'العزة', 340),
(2, 'القوة', 992),
(3, 'الفرسان', 25),
(6, 'النجاح', 992);

-- --------------------------------------------------------

--
-- Table structure for table `records`
--

CREATE TABLE `records` (
  `event` text NOT NULL,
  `time` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `records`
--

INSERT INTO `records` (`event`, `time`) VALUES
('hi', '2022/06/15 03:25:22am'),
('hi', '11:09'),
('hi', '2022/06/15 11:09:00am'),
('hi', '2022/06/15 04:29:59am'),
('شراء سلاح لكنه لا يملك رصيد كافي خالدحاول ', '2022/06/16 01:36:04am'),
('حاول خالد شراء سلاح لكنه لا يملك رصيد كافي', '2022/06/16 01:37:15am'),
('حاول خالد شراء سلاح استخلاص لكنه لا يملك رصيد كافي', '2022/06/16 01:38:13am'),
('حاول خالد شراء سلاح استخلاص 5$ لكنه لا يملك رصيد كافي', '2022/06/16 01:39:09am'),
('حاول خالد شراء سلاح استخلاص لكنه لا يملك رصيد كافي', '2022/06/16 01:40:26am'),
('اشترى خالد سلاح استخلاص', '2022/06/16 01:45:20am'),
('هجم خالد على فهد', ''),
('هجم خالد على علي', '2022/06/16 01:51:23am'),
('اشترى خالد سلاح استخلاص', '2022/06/19 04:12:43am'),
('هجم خالد على علي', '2022/06/19 04:13:10am'),
('اشترى خالد سلاح استخلاص', '2022/06/22 03:19:58am');

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `id` int(11) NOT NULL,
  `product` varchar(30) NOT NULL,
  `price` int(5) NOT NULL,
  `power` int(5) NOT NULL,
  `usingTimes` int(3) NOT NULL,
  `qty` int(5) NOT NULL,
  `kind` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `store`
--

INSERT INTO `store` (`id`, `product`, `price`, `power`, `usingTimes`, `qty`, `kind`) VALUES
(1, 'استخلاص', 11, 8, 1, 968, 'هجوم'),
(2, 'التحام', 28, 30, 1, 19, 'دفاع'),
(3, 'خطأ تكتيكي', 55, 70, 3, 10, 'دفاع'),
(4, 'القفازات النارية', 111, 2000, 2, 1, 'دفاع'),
(5, 'الجزمة النارية', 8, 999, 1, 0, 'هجوم'),
(7, 'الهداف', 690, 800, 3, 0, 'دفاع'),
(8, 'القدم الملتهبة', 13, 111, 4, 3, 'هجوم'),
(9, 'قفازات', 150, 20, 3, 4, 'دفاع');

-- --------------------------------------------------------

--
-- Table structure for table `user_psw`
--

CREATE TABLE `user_psw` (
  `id` int(3) NOT NULL,
  `name` varchar(70) NOT NULL,
  `money` int(10) NOT NULL,
  `lifeP` int(10) NOT NULL,
  `user` varchar(15) NOT NULL,
  `psw` varchar(15) NOT NULL,
  `group` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_psw`
--

INSERT INTO `user_psw` (`id`, `name`, `money`, `lifeP`, `user`, `psw`, `group`) VALUES
(1, 'خالد', 201, 50, '51691', '51691', 'العزة'),
(3, 'علي', 1020, 25, '53469', '53469', 'الفرسان'),
(4, 'فهد', 1020, 992, '60421', '60421', 'النجاح'),
(5, 'سالم', 1020, 992, '73672', '73672', 'القوة');

-- --------------------------------------------------------

--
-- Table structure for table `weapons`
--

CREATE TABLE `weapons` (
  `id` int(11) NOT NULL,
  `name` varchar(70) NOT NULL,
  `w1` varchar(40) DEFAULT NULL,
  `w2` varchar(40) DEFAULT NULL,
  `w3` varchar(40) DEFAULT NULL,
  `d1` varchar(40) DEFAULT NULL,
  `usingTimesd1` int(3) NOT NULL,
  `powerd1` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `weapons`
--

INSERT INTO `weapons` (`id`, `name`, `w1`, `w2`, `w3`, `d1`, `usingTimesd1`, `powerd1`) VALUES
(1, 'احمد', NULL, NULL, NULL, NULL, 0, 0),
(2, 'خالد', 'استخلاص', NULL, NULL, NULL, 0, 0),
(3, 'سالم', NULL, NULL, NULL, NULL, 0, 0),
(4, 'علي', NULL, NULL, NULL, NULL, 0, 0),
(5, 'فهد', NULL, NULL, NULL, NULL, 0, 0),
(6, 'محمد', NULL, NULL, 'استخلاص', NULL, 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_psw`
--
ALTER TABLE `user_psw`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `weapons`
--
ALTER TABLE `weapons`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_psw`
--
ALTER TABLE `user_psw`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `weapons`
--
ALTER TABLE `weapons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
