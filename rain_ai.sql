/*
Navicat MySQL Data Transfer

Source Server         : 本地数据库
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : rain

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2018-04-23 13:29:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `rain_ai`
-- ----------------------------
DROP TABLE IF EXISTS `rain_ai`;
CREATE TABLE `rain_ai` (
  `u_id` int(11) NOT NULL AUTO_INCREMENT,
  `state` int(11) DEFAULT NULL,
  `date` char(255) DEFAULT NULL,
  `face1` int(11) DEFAULT NULL,
  `face2` int(11) DEFAULT NULL,
  `sound` int(11) DEFAULT NULL,
  `ocr` int(11) DEFAULT NULL,
  `image1` int(11) DEFAULT NULL,
  `image2` int(11) DEFAULT NULL,
  `image3` int(11) DEFAULT NULL,
  `image4` int(11) DEFAULT NULL,
  `text1` int(11) DEFAULT NULL,
  `text2` int(11) DEFAULT NULL,
  `text3` int(11) DEFAULT NULL,
  `text4` int(11) DEFAULT NULL,
  `text5` int(11) DEFAULT NULL,
  `text6` int(11) DEFAULT NULL,
  `text7` int(11) DEFAULT NULL,
  `text8` int(11) DEFAULT NULL,
  PRIMARY KEY (`u_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of rain_ai
-- ----------------------------
