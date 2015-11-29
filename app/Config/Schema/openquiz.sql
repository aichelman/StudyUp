-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 22, 2012 at 06:06 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `openquiz`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

DROP TABLE IF EXISTS `acos`;
CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=177 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 158),
(8, 1, NULL, NULL, 'AclExtras', 2, 3),
(9, 1, NULL, NULL, 'AclManagement', 4, 55),
(10, 9, NULL, NULL, 'Groups', 5, 16),
(11, 10, NULL, NULL, 'index', 6, 7),
(12, 10, NULL, NULL, 'view', 8, 9),
(13, 10, NULL, NULL, 'add', 10, 11),
(14, 10, NULL, NULL, 'edit', 12, 13),
(15, 10, NULL, NULL, 'delete', 14, 15),
(21, 9, NULL, NULL, 'Users', 17, 44),
(22, 21, NULL, NULL, 'login', 18, 19),
(23, 21, NULL, NULL, 'logout', 20, 21),
(24, 21, NULL, NULL, 'index', 22, 23),
(25, 21, NULL, NULL, 'view', 24, 25),
(26, 21, NULL, NULL, 'add', 26, 27),
(27, 21, NULL, NULL, 'edit', 28, 29),
(28, 21, NULL, NULL, 'delete', 30, 31),
(29, 1, NULL, NULL, 'AssetCompress', 56, 61),
(30, 29, NULL, NULL, 'Assets', 57, 60),
(31, 30, NULL, NULL, 'get', 58, 59),
(32, 1, NULL, NULL, 'DebugKit', 62, 69),
(33, 32, NULL, NULL, 'ToolbarAccess', 63, 68),
(34, 33, NULL, NULL, 'history_state', 64, 65),
(35, 33, NULL, NULL, 'sql_explain', 66, 67),
(40, 21, NULL, NULL, 'toggle', 32, 33),
(61, 9, NULL, NULL, 'UserPermissions', 45, 54),
(62, 61, NULL, NULL, 'index', 46, 47),
(63, 61, NULL, NULL, 'sync', 48, 49),
(64, 61, NULL, NULL, 'edit', 50, 51),
(65, 61, NULL, NULL, 'toggle', 52, 53),
(74, 1, NULL, NULL, 'PracticeTests', 70, 97),
(75, 74, NULL, NULL, 'admin_index', 71, 72),
(77, 74, NULL, NULL, 'admin_add', 73, 74),
(78, 74, NULL, NULL, 'admin_edit', 75, 76),
(79, 74, NULL, NULL, 'admin_delete', 77, 78),
(80, 74, NULL, NULL, 'admin_toggle', 79, 80),
(81, 1, NULL, NULL, 'Questions', 98, 123),
(82, 81, NULL, NULL, 'admin_index', 99, 100),
(84, 81, NULL, NULL, 'admin_add', 101, 102),
(85, 81, NULL, NULL, 'admin_edit', 103, 104),
(86, 81, NULL, NULL, 'admin_delete', 105, 106),
(87, 81, NULL, NULL, 'admin_toggle', 107, 108),
(89, 74, NULL, NULL, 'index', 81, 82),
(90, 1, NULL, NULL, 'Upload', 124, 125),
(91, 74, NULL, NULL, 'view', 83, 84),
(92, 81, NULL, NULL, 'admin_ordered', 109, 110),
(93, 74, NULL, NULL, 'admin_ordered', 85, 86),
(112, 81, NULL, NULL, 'admin_delete_image', 111, 112),
(130, 21, NULL, NULL, 'facebook_connect', 34, 35),
(131, 21, NULL, NULL, 'twitter_connect', 36, 37),
(132, 21, NULL, NULL, 'twitter_login', 38, 39),
(133, 21, NULL, NULL, 'oauth_callback', 40, 41),
(134, 74, NULL, NULL, 'vote', 87, 88),
(135, 74, NULL, NULL, 'member_index', 89, 90),
(136, 21, NULL, NULL, 'register', 42, 43),
(138, 74, NULL, NULL, 'member_add', 91, 92),
(139, 74, NULL, NULL, 'member_edit', 93, 94),
(140, 74, NULL, NULL, 'member_delete', 95, 96),
(141, 81, NULL, NULL, 'member_index', 113, 114),
(142, 81, NULL, NULL, 'member_add', 115, 116),
(143, 81, NULL, NULL, 'member_edit', 117, 118),
(144, 81, NULL, NULL, 'member_delete', 119, 120),
(145, 81, NULL, NULL, 'member_ordered', 121, 122),
(160, 1, NULL, NULL, 'Dashboards', 126, 153),
(161, 160, NULL, NULL, 'admin_index', 127, 128),
(162, 160, NULL, NULL, 'admin_toggle', 129, 130),
(163, 160, NULL, NULL, 'index', 131, 132),
(164, 160, NULL, NULL, 'view', 133, 134),
(165, 160, NULL, NULL, 'vote', 135, 136),
(166, 160, NULL, NULL, 'member_index', 137, 138),
(167, 160, NULL, NULL, 'member_add', 139, 140),
(168, 160, NULL, NULL, 'member_edit', 141, 142),
(169, 160, NULL, NULL, 'member_delete', 143, 144),
(170, 160, NULL, NULL, 'admin_add', 145, 146),
(171, 160, NULL, NULL, 'admin_edit', 147, 148),
(172, 160, NULL, NULL, 'admin_delete', 149, 150),
(173, 160, NULL, NULL, 'admin_ordered', 151, 152),
(174, 1, NULL, NULL, 'Pages', 154, 157),
(175, 174, NULL, NULL, 'display', 155, 156);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `content`, `published`, `created`, `modified`) VALUES
(13, 4, 'Red', 1, '2012-02-22 05:52:35', '2012-02-22 05:52:35'),
(14, 4, 'Blue', 1, '2012-02-22 05:52:35', '2012-02-22 05:52:35'),
(15, 4, 'Black', 1, '2012-02-22 05:52:35', '2012-02-22 05:52:35'),
(16, 5, 'Red', 1, '2012-02-22 05:53:07', '2012-02-22 05:53:07'),
(17, 5, 'Blue', 1, '2012-02-22 05:53:07', '2012-02-22 05:53:07'),
(18, 5, 'Black', 1, '2012-02-22 05:53:07', '2012-02-22 05:53:07'),
(19, 6, 'Red', 1, '2012-02-22 05:53:33', '2012-02-22 05:53:33'),
(20, 6, 'Blue', 1, '2012-02-22 05:53:33', '2012-02-22 05:53:33'),
(21, 6, 'Black', 1, '2012-02-22 05:53:33', '2012-02-22 05:53:33'),
(22, 1, '<#php #>', 1, '2012-02-22 05:54:56', '2012-02-22 05:54:56'),
(23, 1, '<%php %>', 1, '2012-02-22 05:54:56', '2012-02-22 05:54:56'),
(24, 1, '<?php... ?>', 1, '2012-02-22 05:54:56', '2012-02-22 05:54:56'),
(25, 1, '?....?', 1, '2012-02-22 05:54:56', '2012-02-22 05:54:56'),
(26, 3, 'True', 1, '2012-02-22 05:57:43', '2012-02-22 05:57:43'),
(27, 3, 'False', 1, '2012-02-22 05:57:43', '2012-02-22 05:57:43'),
(28, 2, 'A comma [,]', 1, '2012-02-22 05:58:25', '2012-02-22 05:58:25'),
(29, 2, 'Full stop [.]', 1, '2012-02-22 05:58:25', '2012-02-22 05:58:25'),
(30, 2, 'Colon [:]', 1, '2012-02-22 05:58:25', '2012-02-22 05:58:25'),
(31, 2, 'Semi colon [;]', 1, '2012-02-22 05:58:25', '2012-02-22 05:58:25');

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

DROP TABLE IF EXISTS `aros`;
CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Group', 1, NULL, 1, 4),
(2, NULL, 'Group', 2, NULL, 5, 12),
(4, 1, 'User', 1, NULL, 2, 3),
(6, 2, 'User', 3, NULL, 6, 7),
(7, 2, 'User', 4, NULL, 8, 9),
(8, 2, 'User', 5, NULL, 10, 11);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

DROP TABLE IF EXISTS `aros_acos`;
CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 2, 134, '1', '1', '1', '1'),
(3, 2, 135, '1', '1', '1', '1'),
(5, 2, 138, '1', '1', '1', '1'),
(6, 2, 139, '1', '1', '1', '1'),
(7, 2, 140, '1', '1', '1', '1'),
(8, 2, 141, '1', '1', '1', '1'),
(9, 2, 142, '1', '1', '1', '1'),
(10, 2, 143, '1', '1', '1', '1'),
(11, 2, 144, '1', '1', '1', '1'),
(12, 2, 145, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `created`, `modified`) VALUES
(1, 'Administrator', '2012-01-12 04:26:39', '2012-01-12 04:26:39'),
(2, 'Member', '2012-01-12 04:27:43', '2012-01-16 03:55:47');

-- --------------------------------------------------------

--
-- Table structure for table `practice_tests`
--

DROP TABLE IF EXISTS `practice_tests`;
CREATE TABLE IF NOT EXISTS `practice_tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `ordered` int(11) DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT '0',
  `dislikes` int(11) NOT NULL DEFAULT '0',
  `avg` int(11) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `published` tinyint(2) NOT NULL COMMENT '2: waiting | 1: approve | 0: disabled',
  PRIMARY KEY (`id`),
  KEY `vote` (`likes`,`dislikes`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `practice_tests`
--

INSERT INTO `practice_tests` (`id`, `user_id`, `title`, `slug`, `description`, `ordered`, `likes`, `dislikes`, `avg`, `created`, `modified`, `published`) VALUES
(1, 4, 'Basic of PHP', 'basic_of_php', 'In this test, aimed at beginners, your knowledge of the absolute basics of PHP will be tested. Yes, we know PHP is a bit old school but it still powers a massive portion of the web and is a force to be reckoned with. And don’t get complacent with the diff', 0, 0, 0, 0, '2012-02-22 05:46:06', '2012-02-22 05:58:56', 1),
(2, 4, 'CSS Specificity and Cascading ', 'css_specificity_and_cascading', 'A lot of developers think that CSS is a complete pushover to master. While it’s true that the ceiling is a little lower compared to others, it can still make you want to tear your hair out!\r\n\r\nIn this month’s quiz, you’ll be testing out your mastery of ho', 0, 1, 0, 1, '2012-02-22 05:51:04', '2012-02-22 05:53:40', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `practice_test_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `photo_dir` varchar(255) DEFAULT NULL,
  `embed` text,
  `right_answer` int(11) DEFAULT NULL,
  `ordered` int(11) NOT NULL DEFAULT '0',
  `published` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `practice_test_id`, `content`, `photo`, `photo_dir`, `embed`, `right_answer`, `ordered`, `published`, `created`, `modified`) VALUES
(1, 1, 'The PHP starting and closing tags, also known as delimiters, are...', NULL, NULL, NULL, 22, 0, 1, '2012-02-22 05:46:55', '2012-02-22 05:54:56'),
(2, 1, 'Each statement in PHP needs to be ended with..', NULL, NULL, NULL, 31, 1, 1, '2012-02-22 05:47:22', '2012-02-22 05:58:25'),
(3, 1, 'PHP code can not be embedded within regular HTML code. This statement is...', NULL, NULL, NULL, 27, 0, 1, '2012-02-22 05:48:39', '2012-02-22 05:57:43'),
(4, 2, 'body {color: red;}\r\np {color: blue;}', NULL, NULL, NULL, 14, 0, 1, '2012-02-22 05:52:35', '2012-02-22 05:52:35'),
(5, 2, 'p {color: red;}\r\n.bar {color: blue;}', NULL, NULL, NULL, 17, 0, 1, '2012-02-22 05:53:07', '2012-02-22 05:53:07'),
(6, 2, 'p {color: red;}\r\n.container {color: blue;}', NULL, NULL, NULL, 19, 0, 1, '2012-02-22 05:53:33', '2012-02-22 05:53:33');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

DROP TABLE IF EXISTS `rates`;
CREATE TABLE IF NOT EXISTS `rates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `practice_test_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `likes` tinyint(1) NOT NULL DEFAULT '0',
  `dislikes` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `rate_per_pratice` (`practice_test_id`,`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `rates`
--

INSERT INTO `rates` (`id`, `practice_test_id`, `user_id`, `likes`, `dislikes`) VALUES
(1, 2, 1, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL,
  `username` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `avatar` tinytext COLLATE utf8_unicode_ci COMMENT 'full url to avatar image file',
  `language` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `key` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `facebook_id` bigint(20) unsigned NOT NULL,
  `oauth_token` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'twitter login',
  `oauth_secret` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'twitter login',
  `oauth_provider` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'twitter login',
  `oauth_uid` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'twitter login',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `username`, `name`, `password`, `email`, `avatar`, `language`, `timezone`, `key`, `status`, `created`, `modified`, `last_login`, `facebook_id`, `oauth_token`, `oauth_secret`, `oauth_provider`, `oauth_uid`) VALUES
(1, 1, NULL, 'Admin', '12da3e452ea3a4ba9bb340a24e4e2c15232a7d42', 'admin@dev.com', NULL, NULL, NULL, '4f0e5fe7-6e4c-4ff7-a1de-0a9c7f000003', 1, '2012-01-12 05:07:22', '2012-01-12 05:21:59', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(3, 2, NULL, 'Member', '12da3e452ea3a4ba9bb340a24e4e2c15232a7d42', 'member@dev.com', NULL, NULL, NULL, '4f14f6de-27d8-47d5-a49a-08507f000003', 1, '2012-01-12 11:27:58', '2012-01-17 05:19:42', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(4, 2, 'vukhanhtruong', 'Vu Khanh Truong', 'de71dfb7575ae3cfee29805d268e43fcc69c6b51', 'vukhanhtruong.485546410@twitter.com', NULL, NULL, NULL, '4f3e1f3b-fac0-4dbe-96bd-08247f000004', 1, '2012-02-17 10:34:51', '2012-02-17 10:34:51', '0000-00-00 00:00:00', 0, '485546410-A33RNbm6Yox2iA7nvX4bqq6BwyOjufVTWZFuHpKZ', 'Arnaqk1I74xTpQI5Kj7xZRm1VSHOD8SAGH8AkDSO8AY', 'twitter', '485546410'),
(5, 2, NULL, 'phapsu', '12da3e452ea3a4ba9bb340a24e4e2c15232a7d42', 'mail.phapsu.com@gmail.com', NULL, NULL, NULL, '4f4454c3-53f4-424e-8a1b-08b47f000004', 1, '2012-02-22 03:36:51', '2012-02-22 03:36:51', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL);
