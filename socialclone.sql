-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2022 at 01:01 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `socialclone`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_body` text NOT NULL,
  `posted_by` varchar(60) NOT NULL,
  `posted_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `removed` varchar(3) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_body`, `posted_by`, `posted_to`, `date_added`, `removed`, `post_id`) VALUES
(1, 'Hey!', 'kin_diaz', 'kin_diaz', '2022-01-21 09:11:03', 'no', 0),
(2, 'Hey!\r\n', 'kin_diaz', 'kin_diaz', '2022-01-21 10:13:28', 'no', 1),
(3, 'This is cool\r\n', 'kin_diaz', 'kin_diaz', '2022-01-21 12:19:26', 'no', 1),
(4, 'Hello!', 'kin_diaz', 'kin_diaz', '2022-01-21 12:21:04', 'no', 1),
(5, 'Thanks!', 'kin_diaz', 'melody_song', '2022-01-21 16:53:32', 'no', 2),
(6, 'Hey! How\'s it going!', 'kin_diaz', 'jillian_camron', '2022-01-21 16:53:46', 'no', 4),
(7, 'Why is Ate so tall?', 'charmaine_diaz', 'kin_diaz', '2022-01-21 17:44:00', 'no', 5),
(8, 'Hahaha you\'re pretty tall too Charm!', 'kin_diaz', 'kin_diaz', '2022-01-21 17:46:51', 'no', 5),
(9, 'Yeah, I like basketball. ', 'george_sullivan', 'kin_diaz', '2022-01-21 19:47:20', 'no', 7),
(10, 'Pretty dope photo!', 'archie_campbell', 'kin_diaz', '2022-01-21 19:56:37', 'no', 8),
(11, 'Oh, seen that one. The shoe sale right now is crazy!', 'archie_campbell', 'kin_diaz', '2022-01-21 19:57:25', 'no', 7),
(12, 'Hello!', 'archie_campbell', 'jillian_camron', '2022-01-21 19:57:35', 'no', 4),
(13, 'Sick!', 'archie_campbell', 'kin_diaz', '2022-01-21 19:57:45', 'no', 1),
(15, 'Hey Archie! Excited you\'re here. Hmm well I\'m interested in coding and creating safe spaces on the internet for people to meet!', 'kin_diaz', 'archie_campbell', '2022-01-21 20:02:33', 'no', 9),
(16, 'Cool! Hello good Sir!', 'mark_beneign', 'kin_diaz', '2022-01-21 22:35:29', 'no', 1),
(17, 'Mark here. I\'ve been searching for a community of chill people and this site was recommended. Am. Excited.', 'mark_beneign', 'archie_campbell', '2022-01-21 22:36:24', 'no', 9),
(18, 'Hey!', 'luisa_strong', 'kin_diaz', '2022-01-22 10:55:21', 'no', 1);

-- --------------------------------------------------------

--
-- Table structure for table `friend_requests`
--

CREATE TABLE `friend_requests` (
  `id` int(11) NOT NULL,
  `user_to` varchar(50) NOT NULL,
  `user_from` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friend_requests`
--

INSERT INTO `friend_requests` (`id`, `user_to`, `user_from`) VALUES
(1, 'jillian_camron', 'kin_diaz'),
(4, 'archie_campbell', 'melody_song');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `username` varchar(60) NOT NULL,
  `post_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `username`, `post_id`) VALUES
(13, 'kin_diaz', 1),
(14, 'melody_song', 2),
(15, 'kin_diaz', 4),
(16, 'kin_diaz', 2),
(17, 'charmaine_diaz', 5),
(18, 'charmaine_diaz', 3),
(19, 'kin_diaz', 5),
(20, 'george_sullivan', 7),
(21, 'george_sullivan', 3),
(22, 'george_sullivan', 1),
(23, 'oscar_james', 5),
(24, 'oscar_james', 1),
(25, 'oscar_james', 7),
(26, 'archie_campbell', 8),
(27, 'archie_campbell', 1),
(28, 'archie_campbell', 2),
(29, 'archie_campbell', 9),
(30, 'kin_diaz', 9),
(31, 'kin_diaz', 3),
(32, 'mark_beneign', 3),
(33, 'mark_beneign', 1),
(34, 'mark_beneign', 9),
(35, 'luisa_strong', 8),
(36, 'luisa_strong', 3),
(37, 'luisa_strong', 1);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `body` text NOT NULL,
  `added_by` varchar(60) NOT NULL,
  `user_to` varchar(60) NOT NULL,
  `date_added` datetime NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `deleted` varchar(3) NOT NULL,
  `likes` int(11) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `body`, `added_by`, `user_to`, `date_added`, `user_closed`, `deleted`, `likes`, `image`) VALUES
(1, 'Hello everyone! Nice to meet you! I\'m the owner of this website!', 'kin_diaz', 'none', '2022-01-21 09:59:27', 'no', 'no', 6, ''),
(2, 'Nice website!', 'melody_song', 'none', '2022-01-21 13:39:21', 'no', 'no', 3, ''),
(3, 'Who\'s up for pizza?', 'kin_diaz', 'none', '2022-01-21 14:57:08', 'no', 'no', 5, ''),
(4, 'Hey everyone!', 'jillian_camron', 'none', '2022-01-21 16:47:17', 'no', 'no', 1, ''),
(5, 'Do you like this photo?', 'kin_diaz', 'none', '2022-01-21 17:06:44', 'no', 'yes', 3, 'assets/images/posts/61eae824d3b84Parents.png'),
(7, 'The new basketball shop downtown is pretty cool! You guys into basketball?', 'kin_diaz', 'none', '2022-01-21 19:29:33', 'no', 'no', 2, ''),
(8, 'Do you guys like this photo?', 'kin_diaz', 'none', '2022-01-21 19:53:05', 'no', 'no', 2, 'assets/images/posts/61eb0f21069f0fac63c62d77afcc8f1b0cfe3ce001753.jpg'),
(9, 'Hey Guys! New here, just a bit about me, love basketball, meeting new people and hanging out with family.', 'archie_campbell', 'none', '2022-01-21 19:58:27', 'no', 'no', 3, ''),
(10, 'What\'s up guys? How you all doing today?', 'kin_diaz', 'none', '2022-01-22 16:54:44', 'no', 'yes', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwdResetID` int(11) NOT NULL,
  `pwdResetEmail` text NOT NULL,
  `pwdResetSelector` text NOT NULL,
  `pwdResetToken` longtext NOT NULL,
  `pwdResetExpires` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pwdreset`
--

INSERT INTO `pwdreset` (`pwdResetID`, `pwdResetEmail`, `pwdResetSelector`, `pwdResetToken`, `pwdResetExpires`) VALUES
(2, 'kimmehdiaz@gmail.com', 'f4a5c96e55944c91', '$2y$10$uQ6WwnIcsw23ICjr2O59T.dk4GSft23s89DIaghCkEkiBAzVByLVu', '1643026357');

-- --------------------------------------------------------

--
-- Table structure for table `trends`
--

CREATE TABLE `trends` (
  `title` varchar(50) NOT NULL,
  `hits` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `trends`
--

INSERT INTO `trends` (`title`, `hits`) VALUES
('Basketball', 3),
('Shop', 1),
('Downtown', 1),
('Pretty', 1),
('Cool', 1),
('Photo', 1),
('Bit', 1),
('Love', 1),
('Meeting', 1),
('People', 1),
('Hanging', 1),
('Family', 1),
('Whats', 1),
('Doing', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `signup_date` date NOT NULL,
  `profile_pic` varchar(255) NOT NULL,
  `num_posts` int(11) NOT NULL,
  `num_likes` int(11) NOT NULL,
  `user_closed` varchar(3) NOT NULL,
  `friend_array` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `password`, `signup_date`, `profile_pic`, `num_posts`, `num_likes`, `user_closed`, `friend_array`) VALUES
(1, 'Kin', 'Diaz', 'kin_diaz', 'Kinbryandiaz1@gmail.com', '1bbd886460827015e5d605ed44252251', '2022-01-21', 'assets/images/profile_pics/defaults/killer-whale-andrey-prokopenko.webp', 7, 18, 'no', ',melody_song,george_sullivan,archie_campbell,'),
(2, 'Melodee', 'Song', 'melody_song', 'Melody@gmail.com', '1bbd886460827015e5d605ed44252251', '2022-01-21', 'assets/images/profile_pics/defaults/shark-andrey-prokopenko.webp', 1, 3, 'no', ',kin_diaz,'),
(3, 'Jillian', 'Camron', 'jillian_camron', 'Jillian@gmail.com', '1bbd886460827015e5d605ed44252251', '2022-01-21', 'assets/images/profile_pics/defaults/aquamarine-andrey-prokopenko.webp', 1, 1, 'no', ','),
(4, 'Charmaine', 'Diaz', 'charmaine_diaz', 'D.charmaine@gmail.com', '1bbd886460827015e5d605ed44252251', '2022-01-21', 'assets/images/profile_pics/defaults/fish-swirl-andrey-prokopenko.webp', 0, 0, 'no', ','),
(5, 'George', 'Sullivan', 'george_sullivan', 'Georgesullivan@gmail.com', '1bbd886460827015e5d605ed44252251', '2022-01-21', 'assets/images/profile_pics/defaults/ranging-river-andrey-prokopenko.webp', 0, 0, 'no', ',kin_diaz,'),
(6, 'Oscar', 'James', 'oscar_james', 'Oscarjames@gmail.com', '1bbd886460827015e5d605ed44252251', '2022-01-21', 'assets/images/profile_pics/defaults/fish-swirl-andrey-prokopenko.webp', 0, 0, 'no', ','),
(7, 'Archie', 'Campbell', 'archie_campbell', 'Archiecampbell@gmail.com', '1bbd886460827015e5d605ed44252251', '2022-01-21', 'assets/images/profile_pics/defaults/shark-andrey-prokopenko.webp', 1, 3, 'yes', ',kin_diaz,'),
(8, 'Mark', 'Beneign', 'mark_beneign', 'Mark@gmail.com', '1bbd886460827015e5d605ed44252251', '2022-01-21', 'assets/images/profile_pics/defaults/starfish-andrey-prokopenko.webp', 0, 0, 'no', ','),
(9, 'Luisa', 'Strong', 'luisa_strong', 'Luisa@gmail.com', '1bbd886460827015e5d605ed44252251', '2022-01-22', 'assets/images/profile_pics/defaults/kraken-andrey-prokopenko.webp', 0, 0, 'no', ',');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `friend_requests`
--
ALTER TABLE `friend_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwdResetID`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `friend_requests`
--
ALTER TABLE `friend_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwdResetID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
