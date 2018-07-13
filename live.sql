/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50640
Source Host           : localhost:3306
Source Database       : live

Target Server Type    : MYSQL
Target Server Version : 50640
File Encoding         : 65001

Date: 2018-07-13 13:45:24
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for live_chart
-- ----------------------------
DROP TABLE IF EXISTS `live_chart`;
CREATE TABLE `live_chart` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `game_id` int(10) unsigned NOT NULL DEFAULT '0',
  `user_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `content` varchar(200) NOT NULL DEFAULT '',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for live_game
-- ----------------------------
DROP TABLE IF EXISTS `live_game`;
CREATE TABLE `live_game` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `a_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `b_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `a_score` int(10) unsigned NOT NULL DEFAULT '0',
  `b_score` int(10) unsigned NOT NULL DEFAULT '0',
  `narrator` varchar(20) NOT NULL DEFAULT '',
  `image` varchar(20) NOT NULL DEFAULT '',
  `start_time` int(10) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for live_outs
-- ----------------------------
DROP TABLE IF EXISTS `live_outs`;
CREATE TABLE `live_outs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `game_id` int(10) unsigned NOT NULL DEFAULT '0',
  `team_id` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `content` varchar(200) NOT NULL DEFAULT '',
  `image` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for live_player
-- ----------------------------
DROP TABLE IF EXISTS `live_player`;
CREATE TABLE `live_player` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(20) NOT NULL DEFAULT '',
  `image` varchar(20) NOT NULL DEFAULT '',
  `age` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `position` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for live_team
-- ----------------------------
DROP TABLE IF EXISTS `live_team`;
CREATE TABLE `live_team` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `name` varchar(20) NOT NULL DEFAULT '',
  `image` varchar(20) NOT NULL DEFAULT '',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `create_time` int(10) unsigned NOT NULL DEFAULT '0',
  `update_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
