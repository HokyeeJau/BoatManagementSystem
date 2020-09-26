-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2020 年 09 月 26 日 12:53
-- 伺服器版本： 8.0.19
-- PHP 版本： 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `boat`
--

-- --------------------------------------------------------

--
-- 資料表結構 `admins`
--

CREATE TABLE `admins` (
  `name` varchar(30) NOT NULL DEFAULT 'admin',
  `pwd` varchar(30) NOT NULL DEFAULT '1234'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `admins`
--

INSERT INTO `admins` (`name`, `pwd`) VALUES
('root', '123456');

-- --------------------------------------------------------

--
-- 資料表結構 `clients`
--

CREATE TABLE `clients` (
  `name` varchar(20) NOT NULL,
  `id` int NOT NULL,
  `mobile` varchar(13) NOT NULL,
  `boat_id` varchar(4) NOT NULL,
  `rent_finish` tinyint(1) NOT NULL DEFAULT '0',
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `board_num` int NOT NULL DEFAULT '3',
  `boat_type` varchar(1) NOT NULL DEFAULT 'A'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- 傾印資料表的資料 `clients`
--

INSERT INTO `clients` (`name`, `id`, `mobile`, `boat_id`, `rent_finish`, `start`, `end`, `board_num`, `boat_type`) VALUES
('name', 1234, '13411164656', '1', 1, '2020-09-26 15:33:23', '2020-09-26 15:46:33', 5, 'B'),
('name3', 3456, '13433364656', '505', 1, '2020-09-26 15:41:03', '2020-09-26 16:00:28', 4, 'B'),
('name3', 3456, '13433364656', '397', 1, '2020-09-26 16:31:11', '2020-09-26 16:31:20', 4, 'B'),
('name5', 1234, '13018970932', '721', 1, '2020-09-26 17:12:18', '2020-09-26 17:12:25', 4, 'D'),
('name5', 1234, '13018970932', '456', 1, '2020-09-26 17:12:34', '2020-09-26 17:38:12', 4, 'D'),
('name5', 1234, '13018970932', '880', 1, '2020-09-26 17:06:22', '2020-09-26 17:06:24', 4, 'D'),
('name3', 1234, '13005166999', '809', 1, '2020-09-26 17:12:22', '2020-09-26 17:12:29', 3, 'A'),
('name2', 1234, '13005166999', '14', 1, '2020-09-26 17:12:33', '2020-09-26 17:38:14', 3, 'A'),
('name3', 1234, '13005166999', '598', 1, '2020-09-26 17:12:20', '2020-09-26 17:12:30', 3, 'A');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
