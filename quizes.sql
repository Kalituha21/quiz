-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 16, 2019 at 09:14 AM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.3.7-2+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `quizes`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(41) NOT NULL,
  `is_correct` tinyint(1) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `text`, `is_correct`, `question_id`) VALUES
(1, 'Atbilde 1', 1, 1),
(2, 'Atbilde 2', 0, 1),
(3, 'Atbilde 3', 0, 1),
(4, 'Atbilde 4', 0, 1),
(5, 'Atbilde 1', 0, 2),
(6, 'Atbilde 2', 0, 2),
(7, 'Atbilde 3', 1, 2),
(8, 'Atbilde 4', 0, 2),
(9, 'Atbilde 1', 0, 3),
(10, 'Atbilde 2', 1, 3),
(11, 'Atbilde 3', 0, 3),
(12, 'Atbilde 4', 0, 3),
(13, 'Atbilde 1', 0, 4),
(14, 'Atbilde 2', 0, 4),
(15, 'Atbilde 3', 0, 4),
(16, 'Atbilde 4', 1, 4),
(17, 'True', 1, 5),
(18, 'False', 0, 5),
(19, 'False', 0, 5),
(20, 'False', 0, 5),
(21, 'False', 0, 6),
(22, 'False', 0, 6),
(23, 'True', 1, 6),
(24, 'False', 0, 6),
(25, 'True', 1, 7),
(26, 'False', 0, 7),
(27, 'False', 0, 7),
(28, 'False', 0, 7),
(29, 'Do not choose this', 1, 8),
(30, 'Choose me', 0, 8),
(31, 'Uncorrect', 0, 8),
(32, 'False', 0, 9),
(33, 'False', 1, 9),
(34, 'True', 0, 9),
(35, 'False', 0, 9),
(36, 'False', 0, 9),
(37, 'Not correct', 0, 10),
(38, 'False', 0, 10),
(39, 'Not false', 1, 10),
(40, 'Uncorrect', 0, 10),
(41, 'Button', 1, 11),
(42, 'Correct', 0, 11),
(43, 'Press this', 0, 11),
(44, 'Choose this', 1, 12),
(45, 'Do not press', 1, 12);

-- --------------------------------------------------------

--
-- Table structure for table `attempts`
--

CREATE TABLE `attempts` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attempts`
--

INSERT INTO `attempts` (`id`, `user_id`, `quiz_id`) VALUES
(1, 13, 1),
(2, 13, 1),
(3, 13, 1),
(4, 13, 1),
(5, 14, 1),
(6, 14, 1),
(7, 14, 1),
(8, 15, 1),
(9, 15, 1),
(10, 15, 1),
(11, 15, 1),
(12, 15, 1),
(13, 15, 3),
(14, 15, 2),
(15, 15, 3),
(16, 13, 3);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(10) UNSIGNED NOT NULL,
  `text` varchar(255) NOT NULL,
  `quiz_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `text`, `quiz_id`) VALUES
(1, 'Jautajums 1', 1),
(2, 'Jautajums 2', 1),
(3, 'Jautajums 3', 1),
(4, 'Jautajums 4', 1),
(5, 'Question 1', 2),
(6, 'Question 2', 2),
(7, 'Question 3', 2),
(8, 'Choose 1', 3),
(9, 'Choose preveous', 3),
(10, 'Choose correct', 3),
(11, 'Choose left from correct', 3),
(12, 'Choose', 3);

-- --------------------------------------------------------

--
-- Table structure for table `quizzes`
--

CREATE TABLE `quizzes` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `quizzes`
--

INSERT INTO `quizzes` (`id`, `title`) VALUES
(1, 'Test 1'),
(2, 'Test 2'),
(3, 'Try to pass');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(13, 'AAA', 'aa@aa.aa', '$2y$10$dbx9G2H6PFO6Tzf5ifIpduDljQU/T1qQvwc0MwXSOwb.ttxqKQua2'),
(14, 'CCCC', 'cc@cc.cc', '$2y$10$YUwkz.WHuDNuoo013cK4Y.feF2RorE5gZwAH23h5/E42wg3n.VkNG'),
(15, 'Ddddd', 'dd@dd.dd', '$2y$10$wG6y.eQPIBRQIlDqr634kOOKIrSBs2SYSVlE9Y80iOQ0UuLjZkWay');

-- --------------------------------------------------------

--
-- Table structure for table `user_answers`
--

CREATE TABLE `user_answers` (
  `id` int(10) UNSIGNED NOT NULL,
  `attempt_id` int(10) UNSIGNED NOT NULL,
  `question_id` int(10) UNSIGNED NOT NULL,
  `answer_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_answers`
--

INSERT INTO `user_answers` (`id`, `attempt_id`, `question_id`, `answer_id`) VALUES
(21, 1, 1, 2),
(22, 1, 2, 7),
(23, 1, 3, 9),
(24, 1, 4, 16),
(25, 2, 1, 2),
(26, 2, 2, 7),
(27, 2, 3, 10),
(28, 2, 4, 16),
(32, 3, 1, 1),
(33, 3, 2, 6),
(34, 3, 3, 11),
(35, 3, 4, 16),
(36, 4, 1, 3),
(37, 4, 2, 6),
(38, 4, 3, 10),
(39, 4, 4, 14),
(40, 5, 1, 2),
(41, 5, 2, 6),
(42, 5, 3, 10),
(43, 5, 4, 14),
(44, 6, 1, 2),
(45, 6, 2, 5),
(46, 6, 3, 9),
(47, 6, 4, 13),
(48, 7, 1, 3),
(49, 7, 2, 8),
(50, 7, 3, 11),
(51, 7, 4, 16),
(52, 8, 1, 1),
(53, 8, 2, 5),
(54, 8, 3, 9),
(55, 8, 4, 13),
(56, 9, 1, 1),
(57, 9, 2, 7),
(58, 9, 3, 10),
(59, 9, 4, 16),
(60, 10, 1, 1),
(61, 10, 2, 7),
(62, 10, 3, 10),
(63, 10, 4, 16),
(64, 11, 1, 1),
(65, 11, 2, 7),
(66, 11, 3, 10),
(67, 11, 4, 15),
(68, 12, 1, 1),
(69, 12, 2, 6),
(70, 12, 3, 10),
(71, 12, 4, 13),
(72, 13, 8, 29),
(73, 13, 9, 33),
(74, 13, 10, 39),
(75, 13, 11, 41),
(76, 13, 12, 44),
(77, 14, 5, 18),
(78, 14, 6, 22),
(79, 14, 7, 26),
(80, 16, 8, 29),
(81, 16, 9, 32),
(82, 16, 10, 37),
(83, 16, 11, 41),
(84, 16, 12, 44);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `answers_questions_id_fk` (`question_id`);

--
-- Indexes for table `attempts`
--
ALTER TABLE `attempts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attempts_quizzes_id_fk` (`quiz_id`),
  ADD KEY `attempts_users_id_fk` (`user_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `questions_quizzes_id_fk` (`quiz_id`);

--
-- Indexes for table `quizzes`
--
ALTER TABLE `quizzes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_answers_answers_id_fk` (`answer_id`),
  ADD KEY `user_answers_questions_id_fk` (`question_id`),
  ADD KEY `user_answers_attempts_id_fk` (`attempt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `attempts`
--
ALTER TABLE `attempts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quizzes`
--
ALTER TABLE `quizzes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_answers`
--
ALTER TABLE `user_answers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `answers`
--
ALTER TABLE `answers`
  ADD CONSTRAINT `answers_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);

--
-- Constraints for table `attempts`
--
ALTER TABLE `attempts`
  ADD CONSTRAINT `attempts_quizzes_id_fk` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`),
  ADD CONSTRAINT `attempts_users_id_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_quizzes_id_fk` FOREIGN KEY (`quiz_id`) REFERENCES `quizzes` (`id`);

--
-- Constraints for table `user_answers`
--
ALTER TABLE `user_answers`
  ADD CONSTRAINT `user_answers_answers_id_fk` FOREIGN KEY (`answer_id`) REFERENCES `answers` (`id`),
  ADD CONSTRAINT `user_answers_attempts_id_fk` FOREIGN KEY (`attempt_id`) REFERENCES `attempts` (`id`),
  ADD CONSTRAINT `user_answers_questions_id_fk` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
