-- phpMyAdmin SQL Dump
-- version 3.4.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 25, 2012 at 04:01 AM
-- Server version: 5.1.61
-- PHP Version: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `phapsuco_phapsu`
--

-- --------------------------------------------------------

--
-- Table structure for table `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=181 ;

--
-- Dumping data for table `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 160),
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
(32, 1, NULL, NULL, 'DebugKit', 56, 63),
(33, 32, NULL, NULL, 'ToolbarAccess', 57, 62),
(34, 33, NULL, NULL, 'history_state', 58, 59),
(35, 33, NULL, NULL, 'sql_explain', 60, 61),
(40, 21, NULL, NULL, 'toggle', 32, 33),
(61, 9, NULL, NULL, 'UserPermissions', 45, 54),
(62, 61, NULL, NULL, 'index', 46, 47),
(63, 61, NULL, NULL, 'sync', 48, 49),
(64, 61, NULL, NULL, 'edit', 50, 51),
(65, 61, NULL, NULL, 'toggle', 52, 53),
(74, 1, NULL, NULL, 'PracticeTests', 64, 95),
(75, 74, NULL, NULL, 'admin_index', 65, 66),
(77, 74, NULL, NULL, 'admin_add', 67, 68),
(78, 74, NULL, NULL, 'admin_edit', 69, 70),
(79, 74, NULL, NULL, 'admin_delete', 71, 72),
(80, 74, NULL, NULL, 'admin_toggle', 73, 74),
(81, 1, NULL, NULL, 'Questions', 96, 121),
(82, 81, NULL, NULL, 'admin_index', 97, 98),
(84, 81, NULL, NULL, 'admin_add', 99, 100),
(85, 81, NULL, NULL, 'admin_edit', 101, 102),
(86, 81, NULL, NULL, 'admin_delete', 103, 104),
(87, 81, NULL, NULL, 'admin_toggle', 105, 106),
(89, 74, NULL, NULL, 'index', 75, 76),
(90, 1, NULL, NULL, 'Upload', 122, 123),
(91, 74, NULL, NULL, 'view', 77, 78),
(92, 81, NULL, NULL, 'admin_ordered', 107, 108),
(93, 74, NULL, NULL, 'admin_ordered', 79, 80),
(112, 81, NULL, NULL, 'admin_delete_image', 109, 110),
(130, 21, NULL, NULL, 'facebook_connect', 34, 35),
(131, 21, NULL, NULL, 'twitter_connect', 36, 37),
(132, 21, NULL, NULL, 'twitter_login', 38, 39),
(133, 21, NULL, NULL, 'oauth_callback', 40, 41),
(134, 74, NULL, NULL, 'vote', 81, 82),
(135, 74, NULL, NULL, 'member_index', 83, 84),
(136, 21, NULL, NULL, 'register', 42, 43),
(138, 74, NULL, NULL, 'member_add', 85, 86),
(139, 74, NULL, NULL, 'member_edit', 87, 88),
(140, 74, NULL, NULL, 'member_delete', 89, 90),
(141, 81, NULL, NULL, 'member_index', 111, 112),
(142, 81, NULL, NULL, 'member_add', 113, 114),
(143, 81, NULL, NULL, 'member_edit', 115, 116),
(144, 81, NULL, NULL, 'member_delete', 117, 118),
(145, 81, NULL, NULL, 'member_ordered', 119, 120),
(160, 1, NULL, NULL, 'Dashboards', 124, 155),
(161, 160, NULL, NULL, 'admin_index', 125, 126),
(162, 160, NULL, NULL, 'admin_toggle', 127, 128),
(163, 160, NULL, NULL, 'index', 129, 130),
(164, 160, NULL, NULL, 'view', 131, 132),
(165, 160, NULL, NULL, 'vote', 133, 134),
(166, 160, NULL, NULL, 'member_index', 135, 136),
(167, 160, NULL, NULL, 'member_add', 137, 138),
(168, 160, NULL, NULL, 'member_edit', 139, 140),
(169, 160, NULL, NULL, 'member_delete', 141, 142),
(170, 160, NULL, NULL, 'admin_add', 143, 144),
(171, 160, NULL, NULL, 'admin_edit', 145, 146),
(172, 160, NULL, NULL, 'admin_delete', 147, 148),
(173, 160, NULL, NULL, 'admin_ordered', 149, 150),
(174, 1, NULL, NULL, 'Pages', 156, 159),
(175, 174, NULL, NULL, 'display', 157, 158),
(177, 160, NULL, NULL, 'openquiz', 151, 152),
(178, 160, NULL, NULL, 'topten', 153, 154),
(179, 74, NULL, NULL, 'openquiz', 91, 92),
(180, 74, NULL, NULL, 'topten', 93, 94);

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `published` tinyint(1) NOT NULL DEFAULT '1',
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `content`, `published`, `created`, `modified`) VALUES
(35, 4, '13', 1, '2012-03-18 04:02:11', '2012-03-18 04:02:11'),
(36, 4, '24', 1, '2012-03-18 04:02:12', '2012-03-18 04:02:12'),
(37, 4, '32', 1, '2012-03-18 04:02:12', '2012-03-18 04:02:12'),
(38, 5, 'Ronaldo', 1, '2012-03-18 04:03:27', '2012-03-18 04:03:27'),
(39, 5, 'Emmanuel Petit', 1, '2012-03-18 04:03:27', '2012-03-18 04:03:27'),
(40, 5, 'Zinedine Zidane', 1, '2012-03-18 04:03:27', '2012-03-18 04:03:27'),
(41, 5, 'Rivaldo', 1, '2012-03-18 04:03:27', '2012-03-18 04:03:27'),
(42, 6, 'The Jules Rimet Trophy', 1, '2012-03-18 04:05:07', '2012-03-18 04:05:07'),
(43, 6, 'The Fifa Trophy', 1, '2012-03-18 04:05:07', '2012-03-18 04:05:07'),
(44, 6, 'The Coupe de Monde', 1, '2012-03-18 04:05:07', '2012-03-18 04:05:07'),
(45, 1, 'Arsenal', 1, '2012-03-18 04:22:56', '2012-03-18 04:22:56'),
(46, 1, 'Manchester United', 1, '2012-03-18 04:22:56', '2012-03-18 04:22:56'),
(47, 1, 'AFC Portsmouth', 1, '2012-03-18 04:22:56', '2012-03-18 04:22:56'),
(48, 3, 'Ronaldo', 1, '2012-03-18 04:24:25', '2012-03-18 04:24:25'),
(49, 3, 'Gerd Müller', 1, '2012-03-18 04:24:25', '2012-03-18 04:24:25'),
(50, 3, 'Miroslav Klose', 1, '2012-03-18 04:24:26', '2012-03-18 04:24:26'),
(51, 3, 'Just Fontaine', 1, '2012-03-18 04:24:26', '2012-03-18 04:24:26'),
(52, 2, 'Italy', 1, '2012-03-18 04:26:22', '2012-03-18 04:26:22'),
(53, 2, 'England', 1, '2012-03-18 04:26:22', '2012-03-18 04:26:22'),
(54, 2, 'Germany', 1, '2012-03-18 04:26:22', '2012-03-18 04:26:22'),
(55, 2, 'Brazil', 1, '2012-03-18 04:26:22', '2012-03-18 04:26:22');

-- --------------------------------------------------------

--
-- Table structure for table `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Group', 1, NULL, 1, 4),
(2, NULL, 'Group', 2, NULL, 5, 18),
(4, 1, 'User', 1, NULL, 2, 3),
(6, 2, 'User', 3, NULL, 6, 7),
(7, 2, 'User', 4, NULL, 8, 9),
(8, 2, 'User', 5, NULL, 10, 11),
(9, 2, 'User', 6, NULL, 12, 13),
(10, 2, 'User', 7, NULL, 14, 15),
(11, 2, 'User', 8, NULL, 16, 17);

-- --------------------------------------------------------

--
-- Table structure for table `aros_acos`
--

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
(1, 1, 'General Football Knowledge', 'general_football_knowledge', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 0, 0, 0, 0, '2012-02-22 05:46:06', '2012-03-18 04:26:37', 1),
(2, 1, 'Soccer Worldcup Quiz', 'soccer_worldcup_quiz', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor ', 0, 1, 0, 1, '2012-02-22 05:51:04', '2012-03-18 00:54:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

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
(1, 1, 'Sherlock Holmes creator Sir Arthur Conan Doyle was the first keeper for which english football club ?', NULL, NULL, NULL, 47, 0, 1, '2012-02-22 05:46:55', '2012-03-18 04:22:56'),
(2, 1, ' Which is the only country to have played in every World Cup since it started in 1930?', NULL, NULL, NULL, 55, 1, 1, '2012-02-22 05:47:22', '2012-03-18 04:26:22'),
(3, 1, 'Which top goal getter in international competions wore the number 13 ? (68 goals in 62 int appearances and a European footballer of the year)', NULL, NULL, NULL, 49, 0, 1, '2012-02-22 05:48:39', '2012-03-18 04:24:26'),
(4, 2, 'How many teams played in the first World Cup?', NULL, NULL, NULL, 35, 0, 1, '2012-02-22 05:52:35', '2012-03-18 04:02:12'),
(5, 2, 'Who scored two goals in the 1998 World Cup final?', NULL, NULL, NULL, 40, 0, 1, '2012-02-22 05:53:07', '2012-03-18 04:03:27'),
(6, 2, 'What was the name of the original World Cup trophy?', NULL, NULL, NULL, 42, 0, 1, '2012-02-22 05:53:33', '2012-03-18 04:05:07');

-- --------------------------------------------------------

--
-- Table structure for table `rates`
--

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `group_id`, `username`, `name`, `password`, `email`, `avatar`, `language`, `timezone`, `key`, `status`, `created`, `modified`, `last_login`, `facebook_id`, `oauth_token`, `oauth_secret`, `oauth_provider`, `oauth_uid`) VALUES
(1, 1, NULL, 'Admin', '12da3e452ea3a4ba9bb340a24e4e2c15232a7d42', 'admin@dev.com', NULL, NULL, NULL, '4f0e5fe7-6e4c-4ff7-a1de-0a9c7f000003', 1, '2012-01-12 05:07:22', '2012-01-12 05:21:59', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(3, 2, NULL, 'Member', '12da3e452ea3a4ba9bb340a24e4e2c15232a7d42', 'member@dev.com', NULL, NULL, NULL, '4f14f6de-27d8-47d5-a49a-08507f000003', 1, '2012-01-12 11:27:58', '2012-01-17 05:19:42', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(4, 2, 'vukhanhtruong', 'Vu Khanh Truong', 'de71dfb7575ae3cfee29805d268e43fcc69c6b51', 'vukhanhtruong.485546410@twitter.com', NULL, NULL, NULL, '4f3e1f3b-fac0-4dbe-96bd-08247f000004', 1, '2012-02-17 10:34:51', '2012-02-17 10:34:51', '0000-00-00 00:00:00', 0, '485546410-A33RNbm6Yox2iA7nvX4bqq6BwyOjufVTWZFuHpKZ', 'Arnaqk1I74xTpQI5Kj7xZRm1VSHOD8SAGH8AkDSO8AY', 'twitter', '485546410'),
(5, 2, NULL, 'phapsu', '12da3e452ea3a4ba9bb340a24e4e2c15232a7d42', 'mail.phapsu.com@gmail.com', NULL, NULL, NULL, '4f4454c3-53f4-424e-8a1b-08b47f000004', 1, '2012-02-22 03:36:51', '2012-02-22 03:36:51', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(6, 2, 'truongvk', 'Vu Khanh Truong', 'f59707389a4eeb7015c6cb7c387b2e08fa6e5f33', 'khanhtruong111@gmail.com', NULL, NULL, NULL, '4f656d01-0728-4884-97d4-406a48128449', 1, '2012-03-17 23:05:05', '2012-03-17 23:05:05', '0000-00-00 00:00:00', 1364464780, NULL, NULL, NULL, NULL),
(7, 2, NULL, 'anna_bui93', 'd1adc312c7615acbc81202da8e0e4399c01e9784', 'myhanh.bck11@gmail.com', NULL, NULL, NULL, '4f7263f0-c28c-484b-8314-473848128449', 1, '2012-03-27 19:05:52', '2012-03-27 19:05:52', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL),
(8, 2, NULL, 'inicimbsutt', '4e9767e7f0432ffad19547e41155aef936a1809b', 'u.t.i.bre.wh.eew@gmail.com', NULL, NULL, NULL, '4f774c3e-3e0c-4ece-80c0-460e48128449', 1, '2012-03-31 12:26:06', '2012-03-31 12:26:06', '0000-00-00 00:00:00', 0, NULL, NULL, NULL, NULL);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
