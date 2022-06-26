-- phpMyAdmin SQL Dump
-- version 5.3.0-dev+20220625.0c1859477d
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2022 at 05:22 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `chatten_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

CREATE TABLE `blocks` (
  `block_id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`block_id`, `user_one`, `user_two`) VALUES
(6, 44, 48);

-- --------------------------------------------------------

--
-- Table structure for table `chats`
--

CREATE TABLE `chats` (
  `msg_id` int(11) NOT NULL,
  `msg_sender` int(11) NOT NULL,
  `msg_receiver` int(11) NOT NULL,
  `msg_content` text NOT NULL,
  `msg_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `msg_status` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chats`
--

INSERT INTO `chats` (`msg_id`, `msg_sender`, `msg_receiver`, `msg_content`, `msg_date`, `msg_status`) VALUES
(94, 39, 31, 'rhoncus dui vel sem sed sagittis nam congue risus semper', '2022-06-23 13:36:37', 1),
(95, 39, 31, 'id sapien in sapien iaculis congue', '2022-06-23 13:36:44', 1),
(96, 39, 31, 'vitae mattis nibh ligula nec sem', '2022-06-23 16:17:22', 0),
(97, 44, 31, 'jsdf oishfd ohtwemnrondskngf ksdgijsmfnglkdsg sdm gnsj', '2022-06-24 16:41:07', 0),
(98, 44, 46, 'Hey, let&#039;s talk', '2022-06-24 17:15:21', 0),
(99, 49, 34, 'hex ajsfn kjafsk', '2022-06-24 19:18:06', 0);

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `frd_id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`frd_id`, `user_one`, `user_two`) VALUES
(56, 32, 31),
(57, 39, 31),
(58, 39, 32),
(63, 44, 31),
(66, 44, 46),
(68, 49, 34),
(69, 49, 48);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(225) NOT NULL,
  `user_password` char(255) NOT NULL,
  `user_country` text NOT NULL,
  `user_avatar` varchar(225) NOT NULL,
  `user_online` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_country`, `user_avatar`, `user_online`) VALUES
(31, 'Gisbye', 'jgisbye3@springer.com', '$2y$10$NSnR7nKtH.JrIA81MOm45.eNKfUD.eSiysuWT62eeubzuEcp..Zq2', 'Finland', 'img/ava.png', 0),
(33, 'Sallyann', 'sburneyz@sina.com.cn', '$2y$10$fG0vX1g2HFv9GaH7ZbcNeefIgNxAAWUsyuV.rQ9mhdXcf9H2ewWwu', 'Switzerland', 'img/ava.png', 0),
(34, 'Zorana', 'zravel1g@odnoklassniki.ru', '$2y$10$YzoIV2DfT9dgEKAaxfh6UunPqLB/naIK0jdzcqH5r.7gsMP97vd4y', 'Vietnam', 'img/ava.png', 0),
(44, 'Wilfrid', 'wfullerh@freewebs.com', '$2y$10$Xu9NnmQqjgqjAQ4E3kR5EuZJWPlkW4qzKbg52m.4bH4V6qsLiNfsO', 'Finland', 'uploads/IMG-62b5d417bfbf02.32835970.png', 1),
(45, 'Ann', 'avanellio@ehow.com', '$2y$10$p6vDT4RaHfUXkJcxQsy/yuqEOiJdNigbQ87d6q5ykzYjSz3F9jbQu', 'Finland', 'uploads/IMG-62b5ef943eecd6.54225160.png', 0),
(46, 'Hugues', 'hmushet25@furl.net', '$2y$10$ZTvxc7Nt66zlnaaxxt3eROKgyD6qeG2GNIZZTwtUH2JxH0qPXeNSG', 'Finland', 'uploads/IMG-62b5efc06d00b1.65371919.png', 0),
(47, 'Ricardo', 'rcrayk2l@devhub.com', '$2y$10$QdxkjEAzJg7Bjzg2BZB1CeSGaZ4Q1bIXUFgJJAPrTPhcCVL00sdra', 'Finland', 'uploads/IMG-62b5efe60e3357.51694580.png', 0),
(48, 'Yevette', 'ydogerty2p@about.me', '$2y$10$RbgSx8mMKAsQApDtoLE6TuHkSr/A0X.MCBqc5BbYsi/mk4swXBOQa', 'Finland', 'uploads/IMG-62b5f00059ce06.33328798.png', 0),
(49, 'Eirena', 'emelross1o@earthlink.net', '$2y$10$nAhEWf.vZX6OS/CZJ5pQY.KxdLbBtco9lXaiZW7SWmTPhctOLYLy.', 'Vietnam', 'uploads/IMG-62b60d502b5f90.51559679.png', 1),
(50, 'Clerkclaude', 'callmann1t@oakley.com', '$2y$10$XYQiHiNIlI6XQju1U53uAOgWhr57hVMP8KrDGWYgUMcrKHDpCSrBy', 'Vietnam', 'uploads/IMG-62b60d7e708909.29714253.png', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocks`
--
ALTER TABLE `blocks`
  ADD PRIMARY KEY (`block_id`);

--
-- Indexes for table `chats`
--
ALTER TABLE `chats`
  ADD PRIMARY KEY (`msg_id`);

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`frd_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_name` (`user_name`,`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocks`
--
ALTER TABLE `blocks`
  MODIFY `block_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `chats`
--
ALTER TABLE `chats`
  MODIFY `msg_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100;

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `frd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



