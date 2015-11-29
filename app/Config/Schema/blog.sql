/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : test

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2012-01-03 10:17:40
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `categories`
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'Book', '2011-12-31 04:55:42');
INSERT INTO `categories` VALUES ('2', 'Movie', '2011-12-31 04:56:19');
INSERT INTO `categories` VALUES ('3', 'Arts & Theatre', '2011-12-31 05:16:09');

-- ----------------------------
-- Table structure for `posts`
-- ----------------------------
DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `title` varchar(50) DEFAULT NULL,
  `body` text,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of posts
-- ----------------------------
INSERT INTO `posts` VALUES ('2', '1', 'My first message', 'This is test message', '2012-01-02 10:29:27', '2012-01-02 10:42:23');
INSERT INTO `posts` VALUES ('3', '2', 'Test Movie', 'Avatar is the best movie ever', '2012-01-02 10:33:38', '2012-01-02 10:33:38');
