/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : rain

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-04-23 13:29:45
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ai_use`
-- ----------------------------
DROP TABLE IF EXISTS `ai_use`;
CREATE TABLE `ai_use` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '人工智能识别数据表',
  `add_time` char(255) DEFAULT NULL,
  `ip` char(255) DEFAULT NULL,
  `address` char(255) DEFAULT NULL,
  `status` char(255) DEFAULT NULL,
  `image1` char(255) DEFAULT NULL,
  `image2` char(255) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ai_use
-- ----------------------------
