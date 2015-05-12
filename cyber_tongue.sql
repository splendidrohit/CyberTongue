-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2015 at 03:38 PM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `cyber_tongue`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
`ans_no` int(11) NOT NULL,
  `ans_body` varchar(500) NOT NULL,
  `ans_user` varchar(100) NOT NULL,
  `ques_no` int(11) NOT NULL,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_likes` int(11) NOT NULL DEFAULT '0',
  `total_comments` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`ans_no`, `ans_body`, `ans_user`, `ques_no`, `date_of_create`, `total_likes`, `total_comments`) VALUES
(1, 'Rohit sharma is extremly talented batsmen...', 'shiv.ratan', 1, '2014-11-28 14:39:30', 1, 1),
(2, 'dummy answer in this category...', 'himcoder', 3, '2014-11-28 14:42:00', 1, 1),
(3, 'It hurt religious sentiments of people', 'xorfire', 7, '2014-12-29 12:09:09', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
`com_no` int(11) NOT NULL,
  `user` varchar(100) NOT NULL,
  `com_body` varchar(500) NOT NULL,
  `ans_no` int(11) NOT NULL,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`com_no`, `user`, `com_body`, `ans_no`, `date_of_create`) VALUES
(1, 'himcoder', 'hello ,this is the 1st comment', 1, '2014-11-28 14:42:22'),
(2, 'himcoder', 'hhhhhhhhhhhhhhhh', 2, '2014-12-16 11:28:11'),
(3, 'xorfire', 'hello', 3, '2015-04-24 12:24:43');

-- --------------------------------------------------------

--
-- Table structure for table `followers`
--

CREATE TABLE IF NOT EXISTS `followers` (
  `follow_id` varchar(200) NOT NULL,
  `user` varchar(100) NOT NULL,
  `ques_no` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `followers`
--

INSERT INTO `followers` (`follow_id`, `user`, `ques_no`) VALUES
('1shiv.ratan', 'shiv.ratan', 1),
('3himcoder', 'himcoder', 3),
('3xorfire', 'xorfire', 3),
('7xorfire', 'xorfire', 7);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE IF NOT EXISTS `likes` (
  `likeid` varchar(200) NOT NULL,
  `type` varchar(50) NOT NULL,
  `like_user` varchar(100) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`likeid`, `type`, `like_user`, `number`) VALUES
('ans1shiv.ratan', 'ans', 'shiv.ratan', 1),
('ans2himcoder', 'ans', 'himcoder', 2),
('ans3himcoder', 'ans', 'himcoder', 3),
('ans3xorfire', 'ans', 'xorfire', 3),
('ques2himcoder', 'ques', 'himcoder', 2),
('ques3himcoder', 'ques', 'himcoder', 3),
('ques3shiv.ratan', 'ques', 'shiv.ratan', 3),
('ques4himcoder', 'ques', 'himcoder', 4),
('ques5himcoder', 'ques', 'himcoder', 5),
('ques6himcoder', 'ques', 'himcoder', 6),
('ques7himcoder', 'ques', 'himcoder', 7),
('ques7xorfire', 'ques', 'xorfire', 7),
('ques9himcoder', 'ques', 'himcoder', 9);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE IF NOT EXISTS `notifications` (
`notif_id` int(11) NOT NULL,
  `on_tag` varchar(50) DEFAULT NULL,
  `from_tag` varchar(50) DEFAULT NULL,
  `from_user` varchar(100) NOT NULL,
  `to_user` varchar(100) NOT NULL,
  `on_tag_no` int(11) NOT NULL,
  `from_tag_no` int(11) NOT NULL,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`notif_id`, `on_tag`, `from_tag`, `from_user`, `to_user`, `on_tag_no`, `from_tag_no`, `date_of_create`) VALUES
(1, 'question', 'answer', 'shiv.ratan', 'himcoder', 1, 2, '2014-11-28 14:39:30'),
(2, 'follow', 'answer', 'shiv.ratan', 'shiv.ratan', 1, 2, '2014-11-28 14:39:30'),
(3, 'question', 'answer', 'himcoder', 'shiv.ratan', 3, 3, '2014-11-28 14:42:00'),
(4, 'question', 'answer', 'xorfire', 'himcoder', 7, 4, '2014-12-29 12:09:09'),
(5, 'follow', 'answer', 'xorfire', 'xorfire', 7, 4, '2014-12-29 12:09:09');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
`ques_no` int(11) NOT NULL,
  `ques_body` varchar(500) NOT NULL,
  `ques_detail` varchar(500) NOT NULL,
  `ques_user` varchar(100) NOT NULL,
  `category` varchar(50) NOT NULL,
  `anonymous` tinyint(1) NOT NULL,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_likes` int(11) NOT NULL DEFAULT '0',
  `total_answers` int(11) NOT NULL DEFAULT '0',
  `total_followers` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`ques_no`, `ques_body`, `ques_detail`, `ques_user`, `category`, `anonymous`, `date_of_create`, `total_likes`, `total_answers`, `total_followers`) VALUES
(1, 'what about rohit sharma''s double century against sri lanka???', 'Was his previous century better or this one??', 'himcoder', 'sports', 0, '2014-11-28 14:34:45', 0, 1, 1),
(2, 'dummy question about bollywood???', '', 'himcoder', 'entertainment', 1, '2014-11-28 14:37:45', 1, 0, 0),
(3, 'dummy question in sports category????', '', 'shiv.ratan', 'sports', 0, '2014-11-28 14:41:01', 2, 1, 2),
(4, 'dummy quetion in fashion category???', '', 'himcoder', 'fashion', 1, '2014-11-29 12:19:42', 1, 0, 0),
(5, 'hello this is dummy question????', '', 'himcoder', 'technology', 1, '2014-12-04 12:42:53', 1, 0, 0),
(6, 'what are the most important facts about FDI in retail??', '', 'himcoder', 'Business', 0, '2014-12-24 09:38:16', 1, 0, 0),
(7, 'What is the reason of pk''s controversy???', '', 'himcoder', 'entertainment', 1, '2014-12-29 12:03:47', 2, 1, 1),
(9, 'What is your view about aam aadmi patry''s historic win in delhi???', 'Is modi''s wave vanished or is it kejriwal''s clean image???', 'himcoder', 'politics', 1, '2015-03-21 23:05:25', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_information`
--

CREATE TABLE IF NOT EXISTS `user_information` (
  `user_name` varchar(100) NOT NULL,
`userid` int(11) NOT NULL,
  `password` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `date_of_create` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `profile_pic` varchar(100) DEFAULT NULL,
  `gender` varchar(10) NOT NULL,
  `status` varchar(100) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `user_information`
--

INSERT INTO `user_information` (`user_name`, `userid`, `password`, `name`, `email`, `date_of_create`, `profile_pic`, `gender`, `status`) VALUES
('anonymous', 3, '1234554321', 'anonymous', '', '2014-12-29 11:31:00', 'images/anonymous.jpg', '', ''),
('himcoder', 1, '123456', 'Rohit bhardwaj', 'techvirtuoso.rohit@gmail.com', '2014-11-28 14:33:15', 'images/himcoder_prof_pic.JPG', 'male', 'Passion is the best game..'),
('shiv.ratan', 2, '123456', 'shin ratan sinha', 'shiv@gmail.com', '2014-11-28 14:38:46', 'images/shiv.ratan_prof_pic.jpg', 'male', 'I never lose, i win or i learn...'),
('xorfire', 4, '123456', 'anudeep', 'tgshshggag@hotmail.com', '2014-12-29 12:07:28', 'images/xorfire_prof_pic.JPG', 'male', 'hiii...there my name is anudeep');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
 ADD PRIMARY KEY (`ans_no`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
 ADD PRIMARY KEY (`com_no`);

--
-- Indexes for table `followers`
--
ALTER TABLE `followers`
 ADD PRIMARY KEY (`follow_id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
 ADD PRIMARY KEY (`likeid`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
 ADD PRIMARY KEY (`notif_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
 ADD PRIMARY KEY (`ques_no`);

--
-- Indexes for table `user_information`
--
ALTER TABLE `user_information`
 ADD PRIMARY KEY (`user_name`), ADD UNIQUE KEY `userid` (`userid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
MODIFY `ans_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
MODIFY `com_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
MODIFY `notif_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
MODIFY `ques_no` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user_information`
--
ALTER TABLE `user_information`
MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
