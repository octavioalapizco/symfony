/*
Navicat MySQL Data Transfer

Source Server         : saw
Source Server Version : 50051
Source Host           : 201.155.192.116:3306
Source Database       : iticarloscanedo

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2012-05-10 22:37:58
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `horas`
-- ----------------------------
DROP TABLE IF EXISTS `horas`;
CREATE TABLE `horas` (
  `id` double NOT NULL auto_increment,
  `hora` varchar(20) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of horas
-- ----------------------------
INSERT INTO `horas` VALUES ('1', '07:00', '1');
INSERT INTO `horas` VALUES ('2', '07:50', '1');
INSERT INTO `horas` VALUES ('3', '08:40', '1');
INSERT INTO `horas` VALUES ('4', '09:30', '1');
INSERT INTO `horas` VALUES ('5', '09:50', '1');
INSERT INTO `horas` VALUES ('6', '10:40', '1');
INSERT INTO `horas` VALUES ('7', '11:30', '1');
INSERT INTO `horas` VALUES ('8', '12:20', '1');
INSERT INTO `horas` VALUES ('9', '01:10', '1');
INSERT INTO `horas` VALUES ('10', '02:00', '1');
INSERT INTO `horas` VALUES ('11', '05:15', '1');
INSERT INTO `horas` VALUES ('12', '06:00', '1');
INSERT INTO `horas` VALUES ('13', '06:45', '1');
INSERT INTO `horas` VALUES ('14', '07:30', '1');
INSERT INTO `horas` VALUES ('15', '08:15', '1');
INSERT INTO `horas` VALUES ('16', '09:00', '1');
INSERT INTO `horas` VALUES ('17', '09:45', '1');
INSERT INTO `horas` VALUES ('18', '08:00', '0');
INSERT INTO `horas` VALUES ('19', '09:00', '0');
INSERT INTO `horas` VALUES ('20', '10:00', '0');
INSERT INTO `horas` VALUES ('21', '11:00', '0');
INSERT INTO `horas` VALUES ('22', '12:00', '0');
INSERT INTO `horas` VALUES ('23', '01:00', '0');
INSERT INTO `horas` VALUES ('24', '02:00', '0');
