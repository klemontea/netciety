-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 09, 2021 at 08:26 PM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_post_id` int(11) NOT NULL,
  `comment_user_id` int(11) NOT NULL,
  `comment_content` text NOT NULL,
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_post_id`, `comment_user_id`, `comment_content`, `comment_date`) VALUES
(11, 32, 7, 'Same', '2021-09-10 00:39:00'),
(12, 34, 7, 'Helooo', '2021-09-10 00:40:46'),
(13, 31, 7, 'Nice', '2021-09-10 00:47:37'),
(14, 31, 9, 'I like it!!', '2021-09-10 00:48:54');

-- --------------------------------------------------------

--
-- Table structure for table `friendrequest`
--

CREATE TABLE `friendrequest` (
  `request_id` int(255) NOT NULL,
  `sender_id` int(255) NOT NULL,
  `receiver_id` int(255) NOT NULL,
  `request_status` varchar(15) NOT NULL DEFAULT 'open',
  `request_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friendrequest`
--

INSERT INTO `friendrequest` (`request_id`, `sender_id`, `receiver_id`, `request_status`, `request_date`) VALUES
(25, 10, 7, 'accept', '2021-09-09 11:13:39'),
(26, 10, 8, 'pending', '2021-09-09 11:13:47'),
(27, 10, 12, 'accept', '2021-09-09 11:13:53'),
(28, 10, 11, 'accept', '2021-09-09 11:15:02'),
(29, 10, 9, 'accept', '2021-09-09 11:17:08'),
(30, 11, 8, 'pending', '2021-09-10 00:31:13'),
(31, 11, 7, 'accept', '2021-09-10 00:31:21'),
(32, 11, 9, 'accept', '2021-09-10 00:31:26'),
(33, 7, 8, 'pending', '2021-09-10 00:39:57'),
(34, 7, 9, 'accept', '2021-09-10 00:40:03'),
(35, 7, 12, 'accept', '2021-09-10 00:40:18'),
(36, 12, 9, 'accept', '2021-09-10 00:50:16');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(255) NOT NULL,
  `image_member_id` int(255) NOT NULL,
  `image_picture` varchar(255) NOT NULL,
  `image_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_member_id`, `image_picture`, `image_date`) VALUES
(18, 10, '', '2021-09-09'),
(19, 10, '', '2021-09-09'),
(20, 10, 'pexels-miggy-rivera-6141908.jpg', '2021-09-09'),
(21, 10, 'silly.png', '2021-09-09'),
(22, 10, '', '2021-09-09'),
(23, 11, 'pexels-erik-karits-3738673.jpg', '2021-09-10'),
(24, 11, 'pexels-marius-cigher-3692550.jpg', '2021-09-10'),
(25, 11, '', '2021-09-10'),
(26, 7, 'pexels-wendy-wei-1190298.jpg', '2021-09-10'),
(27, 7, 'pexels-shahnewaj-mahmood-3181093.jpg', '2021-09-10'),
(28, 7, 'pexels-tembela-bohle-1089930.jpg', '2021-09-10'),
(29, 7, 'pexels-aleksandar-pasaric-2078008.jpg', '2021-09-10'),
(30, 9, 'pexels-alleksana-4050990.jpg', '2021-09-10'),
(31, 12, 'pexels-tyler-nix-2396220.jpg', '2021-09-10'),
(32, 12, 'pexels-erik-karits-3738673.jpg', '2021-09-10'),
(33, 9, 'pexels-larissa-deruzzi-6546181.jpg', '2021-09-10');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int(11) NOT NULL,
  `like_post_id` int(11) NOT NULL,
  `like_user_id` int(11) NOT NULL,
  `like_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`like_id`, `like_post_id`, `like_user_id`, `like_status`) VALUES
(4, 32, 7, 'like'),
(5, 34, 7, 'like'),
(6, 31, 7, 'like'),
(7, 31, 9, 'like');

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

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `message_id` int(11) NOT NULL,
  `message_from_id` int(11) NOT NULL,
  `message_to_id` int(11) NOT NULL,
  `message_subject` varchar(255) NOT NULL,
  `message_content` text NOT NULL,
  `message_date` datetime NOT NULL,
  `message_read_status` varchar(20) NOT NULL DEFAULT 'unread',
  `message_sender_visible` tinyint(1) NOT NULL DEFAULT 1,
  `message_receiver_visible` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`message_id`, `message_from_id`, `message_to_id`, `message_subject`, `message_content`, `message_date`, `message_read_status`, `message_sender_visible`, `message_receiver_visible`) VALUES
(5, 11, 10, 'Hello', 'Hai', '2021-09-10 00:33:21', 'unread', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_user_id` int(11) NOT NULL COMMENT 'user_id is the author of this post!!',
  `post_content` text NOT NULL,
  `post_image` varchar(50) NOT NULL,
  `post_date` datetime NOT NULL,
  `post_comment_count` int(11) NOT NULL DEFAULT 0,
  `post_like_count` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`post_id`, `post_user_id`, `post_content`, `post_image`, `post_date`, `post_comment_count`, `post_like_count`) VALUES
(25, 10, 'First post, welcome!!', '', '2021-09-09 11:11:32', 0, 0),
(26, 10, 'Try picture...ready!!', '', '2021-09-09 11:11:47', 0, 0),
(27, 10, 'First pics\r\n', 'pexels-miggy-rivera-6141908.jpg', '2021-09-09 11:11:59', 0, 0),
(28, 10, '', 'silly.png', '2021-09-09 11:12:27', 0, 0),
(29, 10, 'zzz\r\n', '', '2021-09-09 11:13:27', 0, 0),
(30, 11, '', 'pexels-erik-karits-3738673.jpg', '2021-09-10 00:21:17', 0, 0),
(31, 11, 'Breeze', 'pexels-marius-cigher-3692550.jpg', '2021-09-10 00:21:32', 2, 2),
(32, 11, 'Sleepy', '', '2021-09-10 00:21:38', 1, 1),
(33, 7, 'Happy new year!', 'pexels-wendy-wei-1190298.jpg', '2021-09-10 00:38:51', 0, 0),
(34, 7, 'New place!!', 'pexels-shahnewaj-mahmood-3181093.jpg', '2021-09-10 00:40:37', 1, 1),
(35, 7, '', 'pexels-tembela-bohle-1089930.jpg', '2021-09-10 00:48:05', 0, 0),
(36, 7, '', 'pexels-aleksandar-pasaric-2078008.jpg', '2021-09-10 00:48:14', 0, 0),
(37, 9, 'Lunch first', 'pexels-alleksana-4050990.jpg', '2021-09-10 00:49:23', 0, 0),
(38, 12, 'Relax', 'pexels-tyler-nix-2396220.jpg', '2021-09-10 00:49:53', 0, 0),
(39, 12, '', 'pexels-erik-karits-3738673.jpg', '2021-09-10 00:50:39', 0, 0),
(40, 9, 'Healthyyyy', 'pexels-larissa-deruzzi-6546181.jpg', '2021-09-10 00:51:21', 0, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `friendrequest`
--
ALTER TABLE `friendrequest`
  ADD PRIMARY KEY (`request_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`member_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`message_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `friendrequest`
--
ALTER TABLE `friendrequest`
  MODIFY `request_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `member_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
