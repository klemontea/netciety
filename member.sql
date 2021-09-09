-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2021 at 07:52 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `netciety`
--

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `member_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `member_fname` varchar(255) NOT NULL,
  `member_lname` varchar(255) NOT NULL,
  `member_email` varchar(255) NOT NULL,
  `member_password` varchar(255) NOT NULL,
  `member_profile_photo` varchar(255) NOT NULL,
  `member_total_friend` int(11) NOT NULL DEFAULT 0,
  `member_total_post` int(11) NOT NULL DEFAULT 0,
  `member_date_creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`member_id`, `username`, `member_fname`, `member_lname`, `member_email`, `member_password`, `member_profile_photo`, `member_total_friend`, `member_total_post`, `member_date_creation`) VALUES
(7, 'thomas', 'Thomas', 'Jasjus', 'thomas@gmail.com', '$2y$12$s54AtRE3n6pr46F40CHuMOoP4GtXUNf40uG0cDfux5ia7tnxzxr3W', 'pexels-shahnewaj-mahmood-3181093.jpg', 4, 4, '2021-09-09'),
(8, 'leonardo', '', '', 'leonardo@gmail.com', '$2y$12$mMV8ZD1mvGyAd01UGptaMOci2kf52z6o.xlJxKqewtQYgoGcbQH4G', '', 0, 0, '2021-09-09'),
(9, 'susan', 'Susan', 'Wati', 'susan@gmail.com', '$2y$12$mmrZqrgElX5yIg0MROmzh.QjF.cbTAvzFL5cEkKhLFi0tKSnFJ1Bi', '', 4, 2, '2021-09-09'),
(10, 'james', 'James', 'Watt', 'james@gmail.com', '$2y$12$5B4paffvZiENZpPN98TNXulUtcTaCALXNHVV79rMAl0gkFVjEIUIS', 'pexels-miggy-rivera-6141908.jpg', 4, 5, '2021-09-09'),
(11, 'claire', '', '', 'claire@gmail.com', '$2y$12$HRPv6x.eh.QgljOM/oPSkONX6X0qOWBM7wNxmuz9IE2.M8efShrbq', 'pexels-erik-karits-3738673.jpg', 3, 3, '2021-09-09'),
(12, 'jefferson', '', '', 'jefferson@gmail.com', '$2y$12$jVBwa95pVf6YiZY0ey/uwu6.OCS.vvmhGzCWd5U/wZctc781PlPoy', 'pexels-tyler-nix-2396220.jpg', 3, 2, '2021-09-09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
