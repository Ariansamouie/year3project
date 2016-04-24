-- phpMyAdmin SQL Dump
-- version 4.4.10
-- http://www.phpmyadmin.net
--
-- Host: 10.169.0.9
-- Generation Time: Apr 24, 2016 at 10:09 AM
-- Server version: 5.6.21
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alloistu_guess`
--

-- --------------------------------------------------------

--
-- Table structure for table `created_guesses`
--

CREATE TABLE IF NOT EXISTS `created_guesses` (
  `id` int(11) NOT NULL,
  `user_id` int(4) NOT NULL,
  `fixture_id` int(10) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `first_scorer` int(11) NOT NULL,
  `team_1_scorer` int(11) NOT NULL,
  `team_2_scorer` int(11) NOT NULL,
  `points_added` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=216 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `created_guesses`
--

INSERT INTO `created_guesses` (`id`, `user_id`, `fixture_id`, `date_added`, `first_scorer`, `team_1_scorer`, `team_2_scorer`, `points_added`) VALUES
(215, 41, 67, '2016-04-24 08:39:02', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `fixtures`
--

CREATE TABLE IF NOT EXISTS `fixtures` (
  `id` int(11) NOT NULL,
  `team1_id` int(11) NOT NULL,
  `team2_id` int(11) NOT NULL,
  `fixture_date` date NOT NULL,
  `team1_score` int(11) NOT NULL,
  `team2_score` int(11) NOT NULL,
  `first_scorer` varchar(255) NOT NULL,
  `parsed` int(1) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `fixtures`
--

INSERT INTO `fixtures` (`id`, `team1_id`, `team2_id`, `fixture_date`, `team1_score`, `team2_score`, `first_scorer`, `parsed`) VALUES
(67, 1, 2, '2016-04-22', 0, 0, '7', 1);

-- --------------------------------------------------------

--
-- Table structure for table `frnds`
--

CREATE TABLE IF NOT EXISTS `frnds` (
  `id` int(11) NOT NULL,
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `frnds`
--

INSERT INTO `frnds` (`id`, `user_one`, `user_two`) VALUES
(29, 41, 40);

-- --------------------------------------------------------

--
-- Table structure for table `frnd_req`
--

CREATE TABLE IF NOT EXISTS `frnd_req` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `guesses`
--

CREATE TABLE IF NOT EXISTS `guesses` (
  `id` int(11) NOT NULL,
  `created_guesses_id` int(4) NOT NULL,
  `user_id` int(4) NOT NULL,
  `team1_score` int(11) NOT NULL,
  `team2_score` int(11) NOT NULL,
  `first_scorer` varchar(100) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=300 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `guesses`
--

INSERT INTO `guesses` (`id`, `created_guesses_id`, `user_id`, `team1_score`, `team2_score`, `first_scorer`, `date_added`) VALUES
(299, 215, 41, 0, 0, '7', '2016-04-24 08:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `id` int(11) NOT NULL,
  `group_hash` int(11) NOT NULL,
  `from_id` int(11) NOT NULL,
  `message` varchar(225) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `message_group`
--

CREATE TABLE IF NOT EXISTS `message_group` (
  `user_one` int(11) NOT NULL,
  `user_two` int(11) NOT NULL,
  `hash` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
  `id` int(11) NOT NULL,
  `user_from` int(11) NOT NULL,
  `user_to` int(11) NOT NULL,
  `date_sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_guesses_id` int(11) NOT NULL,
  `notification_status` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=153 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `players`
--

CREATE TABLE IF NOT EXISTS `players` (
  `player_id` int(11) NOT NULL,
  `team_id` int(11) NOT NULL,
  `player_number` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `players`
--

INSERT INTO `players` (`player_id`, `team_id`, `player_number`, `name`) VALUES
(7, 1, 10, 'Rooney'),
(8, 1, 1, 'De Gea'),
(12, 1, 3, 'Shaw'),
(13, 1, 4, 'Jones'),
(14, 1, 5, 'Rojo'),
(15, 1, 6, 'Evens'),
(16, 1, 7, 'Di Maria'),
(17, 1, 8, 'Mata'),
(18, 1, 11, 'Januzaj'),
(19, 1, 12, 'Smalling'),
(20, 1, 16, 'Carrick'),
(21, 1, 17, 'Blind'),
(22, 1, 18, 'Young'),
(23, 1, 20, 'Van Persie'),
(24, 1, 21, 'Herrera'),
(25, 1, 25, 'Valencia'),
(26, 1, 31, 'Fellaini'),
(27, 1, 32, 'Valdes'),
(28, 5, 1, 'Szczesny'),
(29, 5, 18, 'Monreal'),
(30, 5, 3, 'Gibbs'),
(31, 5, 21, 'Chambers'),
(32, 5, 4, 'Mertesacker'),
(33, 5, 6, 'Koscielny'),
(34, 5, 7, 'Rosicky'),
(35, 5, 19, 'Cazorla'),
(36, 5, 8, 'Arteta'),
(37, 5, 20, 'Flamini'),
(38, 5, 10, 'Wilshere'),
(39, 5, 11, 'Ozil'),
(40, 5, 15, 'CHamberlain'),
(41, 5, 16, 'Ramsey'),
(42, 5, 12, 'Giroud'),
(43, 5, 23, 'Welbeck'),
(44, 5, 14, 'Walcott'),
(45, 5, 17, 'Alexis'),
(46, 5, 22, 'Sanogo'),
(47, 3, 3, 'Enrique'),
(48, 3, 4, 'Toure'),
(49, 3, 6, 'Lovren'),
(50, 3, 7, 'Milner'),
(51, 3, 9, 'Lambert'),
(52, 3, 10, 'Coutinho'),
(53, 3, 14, 'Henderson'),
(54, 3, 15, 'Sturridge'),
(55, 3, 17, 'Sakho'),
(56, 3, 22, 'Mignolet'),
(57, 3, 23, 'Can'),
(58, 3, 24, 'Allen'),
(59, 3, 26, 'LLori'),
(60, 3, 28, 'Ings'),
(61, 3, 29, 'Borini'),
(62, 3, 33, 'Ibe'),
(63, 3, 37, 'Skrtel'),
(64, 3, 18, 'Moreno'),
(65, 3, 20, 'Lallana'),
(66, 3, 21, 'Lucas'),
(67, 1, 14, 'Samouie'),
(69, 6, 1, 'Guzan'),
(70, 6, 2, 'Baker'),
(71, 6, 5, 'Okore'),
(72, 6, 18, 'Richardson'),
(73, 5, 14, 'Senderos'),
(74, 6, 12, 'J Cole'),
(75, 6, 15, 'Westwood'),
(76, 6, 17, 'Herd'),
(77, 6, 25, 'Gil'),
(78, 6, 28, 'N''Zogbia'),
(79, 6, 11, 'Agbonlahor'),
(80, 6, 27, 'Kozak'),
(81, 4, 10, 'Hazzard'),
(82, 1, 22, 'Ashton'),
(83, 1, 99, 'Xhesi'),
(84, 2, 50, 'Rodreguez'),
(85, 2, 1, 'keeper'),
(86, 1, 44, 'awd'),
(87, 1, 55, 'Xhesi');

-- --------------------------------------------------------

--
-- Table structure for table `teams`
--

CREATE TABLE IF NOT EXISTS `teams` (
  `id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `images` varchar(250) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teams`
--

INSERT INTO `teams` (`id`, `team_name`, `images`) VALUES
(1, 'Man Utd', 'manutd.png'),
(2, 'Everton', 'everton.png'),
(3, 'Liverpool', 'liverpool.png'),
(4, 'Chelsea', 'chelsea.png'),
(5, 'Arsenal', 'arsenal.png'),
(6, 'Aston Villa', 'astonvilla.gif'),
(7, 'Bournemouth', 'bournemouth.png'),
(8, 'Crystal Palace', 'crystalpalace.png'),
(9, 'Leicester', 'leicester.png'),
(10, 'Man City', 'mancity.gif'),
(11, 'Newcastle', 'newcastle.gif'),
(12, 'Norwich', 'norwich.png'),
(13, 'Southampton', 'southampton.png'),
(14, 'Stoke', 'stoke.png'),
(15, 'Sunderland', 'sunderland.png'),
(16, 'Swansea', 'swansea.png'),
(17, 'Tottenham', 'tottenham.png'),
(18, 'Watford', 'watford.png'),
(19, 'West Brom', 'westbrom.png'),
(20, 'West Ham', 'westham.png');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `supported_team` int(4) NOT NULL,
  `email` varchar(255) NOT NULL,
  `friend_count` int(11) NOT NULL,
  `user_score` int(8) NOT NULL,
  `reset` varchar(50) NOT NULL,
  `access_level` varchar(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `firstname`, `lastname`, `supported_team`, `email`, `friend_count`, `user_score`, `reset`, `access_level`) VALUES
(40, 'Andy', '096190508c6d3bf0349fe3157ac553bf0b57c7ed', 'Andy', 'Smith', 1, 'andysmith@gmail.com', 0, 0, '', '1'),
(41, 'Edward', '4f6cd285a6fc2db4c1cc4f2a4122de8c7c587a68', 'Edward', 'Harrison', 2, 'ed@gmail.com', 0, 10, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `user_score`
--

CREATE TABLE IF NOT EXISTS `user_score` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `score` int(11) NOT NULL,
  `creadet_guesses_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `created_guesses`
--
ALTER TABLE `created_guesses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `fixtures`
--
ALTER TABLE `fixtures`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frnds`
--
ALTER TABLE `frnds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `frnd_req`
--
ALTER TABLE `frnd_req`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `guesses`
--
ALTER TABLE `guesses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_group`
--
ALTER TABLE `message_group`
  ADD PRIMARY KEY (`hash`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `players`
--
ALTER TABLE `players`
  ADD PRIMARY KEY (`player_id`),
  ADD KEY `team_id` (`team_id`) USING BTREE;

--
-- Indexes for table `teams`
--
ALTER TABLE `teams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_score`
--
ALTER TABLE `user_score`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `created_guesses`
--
ALTER TABLE `created_guesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=216;
--
-- AUTO_INCREMENT for table `fixtures`
--
ALTER TABLE `fixtures`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `frnds`
--
ALTER TABLE `frnds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=30;
--
-- AUTO_INCREMENT for table `frnd_req`
--
ALTER TABLE `frnd_req`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=81;
--
-- AUTO_INCREMENT for table `guesses`
--
ALTER TABLE `guesses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=300;
--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=56;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=153;
--
-- AUTO_INCREMENT for table `players`
--
ALTER TABLE `players`
  MODIFY `player_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=88;
--
-- AUTO_INCREMENT for table `teams`
--
ALTER TABLE `teams`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `user_score`
--
ALTER TABLE `user_score`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `players`
--
ALTER TABLE `players`
  ADD CONSTRAINT `players_ibfk_1` FOREIGN KEY (`team_id`) REFERENCES `teams` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
