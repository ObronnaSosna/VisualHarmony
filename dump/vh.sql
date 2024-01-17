-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Dec 09, 2023 at 10:14 AM
-- Server version: 11.1.2-MariaDB-1:11.1.2+maria~ubu2204
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vh`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `text` varchar(255) DEFAULT NULL,
  `post_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `text`, `post_id`, `users_id`, `upvote`, `downvote`) VALUES
(1, 'test\n', 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE reports (
  id int(11) NOT NULL,
  title varchar(255) DEFAULT NULL,
  post_id int(11) NOT NULL,
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `title`, `post_id`) VALUES
(1, 'test', 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `path` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `path`) VALUES
(1, 'pics/akitaxhusky.png'),
(2, 'pics/autumn.png'),
(3, 'pics/akitaxhusky.png'),
(4, 'pics/autumn.png'),
(5, 'pics/castle.png'),
(6, 'pics/casual.png'),
(7, 'pics/child.png'),
(8, 'pics/deer.png'),
(9, 'pics/doggo.png'),
(10, 'pics/flower.png'),
(11, 'pics/forest.png'),
(12, 'pics/freedom.png'),
(13, 'pics/gift.png'),
(14, 'pics/girl.png'),
(15, 'pics/horse.png'),
(16, 'pics/husky.png'),
(17, 'pics/japanGirl.png'),
(18, 'pics/mountain.png'),
(19, 'pics/music.png'),
(20, 'pics/nature.png'),
(21, 'pics/ny.png'),
(22, 'pics/ogorek.png'),
(23, 'pics/old.png'),
(24, 'pics/paw.png'),
(25, 'pics/rainyDay.png'),
(26, 'pics/santa.png'),
(27, 'pics/shop.png'),
(28, 'pics/superhero.png'),
(29, 'pics/tatry.png'),
(30, 'pics/town.png'),
(31, 'pics/water.png'),
(32, 'pics/wild.png'),
(33, 'pics/wind.png'),
(34, 'pics/winter.png');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `tags` varchar(1000) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `file_id` int(11) NOT NULL,
  `upvote` int(11) DEFAULT NULL,
  `downvote` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `title`, `description`, `tags`, `date`, `user_id`, `file_id`, `upvote`, `downvote`) VALUES
(1, 'test title', 'test desc', 'test_tag', '2023-12-06 20:41:14', 1, 1, 4, 0),
(2, 'test2', 'testt', 'test_tagg', '2023-12-07 20:43:44', 1, 2, 10, 0),
(3, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 3, 0, 0),
(4, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 4, 0, 0),
(5, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 5, 0, 0),
(6, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 6, 0, 0),
(7, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 7, 0, 0),
(8, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 8, 0, 0),
(9, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 9, 0, 0),
(10, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 10, 0, 0),
(11, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 11, 0, 0),
(12, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 12, 0, 0),
(13, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 13, 0, 0),
(14, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 14, 0, 0),
(15, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 15, 0, 0),
(16, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 16, 0, 0),
(17, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 17, 0, 0),
(18, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 18, 0, 0),
(19, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 19, 0, 0),
(20, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 20, 0, 0),
(21, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 21, 0, 0),
(22, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 22, 0, 0),
(23, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 23, 0, 0),
(24, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 24, 0, 0),
(26, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 26, 0, 0),
(27, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 27, 0, 0),
(28, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 28, 0, 0),
(29, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 29, 0, 0),
(30, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 30, 0, 0),
(31, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 31, 0, 0),
(32, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 32, 0, 0),
(33, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 33, 0, 0),
(34, 'test', 'desc', 'tag', '2010-12-31 01:15:00', 1, 34, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `profiles`
--

CREATE TABLE `profiles` (
  `id` int(11) NOT NULL,
  `bio` varchar(100) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--
INSERT INTO `users` (`id`, `user`, `password`) VALUES
(1,'test','1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comments_posts_fk` (`post_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `reports_posts_fk` (`post_id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logins`
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_files_fk` (`file_id`),
  ADD KEY `image_users_fk` (`user_id`);

--
-- Indexes for table `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `profiles_users_fk` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_posts_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `comments`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_posts_fk` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `image_files_fk` FOREIGN KEY (`file_id`) REFERENCES `files` (`id`),
  ADD CONSTRAINT `image_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);





/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
