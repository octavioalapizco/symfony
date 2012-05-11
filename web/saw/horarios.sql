/*
Navicat MySQL Data Transfer

Source Server         : saw
Source Server Version : 50051
Source Host           : 201.155.192.116:3306
Source Database       : iticarloscanedo

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2012-05-10 22:46:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `horarios`
-- ----------------------------
DROP TABLE IF EXISTS `horarios`;
CREATE TABLE `horarios` (
  `id` double NOT NULL auto_increment,
  `aula` int(1) NOT NULL,
  `id_dia` double NOT NULL,
  `id_horainicio` double NOT NULL,
  `id_horafinal` double NOT NULL,
  `status` int(1) NOT NULL default '1',
  `activo` int(1) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=82 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of horarios
-- ----------------------------
INSERT INTO `horarios` VALUES ('68', '1', '6', '23', '24', '1', '1');
INSERT INTO `horarios` VALUES ('7', '1', '3', '1', '4', '1', '1');
INSERT INTO `horarios` VALUES ('65', '1', '6', '21', '22', '1', '1');
INSERT INTO `horarios` VALUES ('64', '1', '6', '20', '21', '1', '1');
INSERT INTO `horarios` VALUES ('63', '1', '6', '19', '20', '1', '1');
INSERT INTO `horarios` VALUES ('62', '1', '6', '18', '19', '1', '1');
INSERT INTO `horarios` VALUES ('61', '1', '5', '8', '9', '1', '1');
INSERT INTO `horarios` VALUES ('80', '1', '4', '1', '2', '1', '0');
INSERT INTO `horarios` VALUES ('79', '1', '2', '1', '2', '1', '0');
INSERT INTO `horarios` VALUES ('17', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('18', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('19', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('20', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('21', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('22', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('23', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('24', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('25', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('26', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('27', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('28', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('72', '2', '1', '5', '6', '1', '1');
INSERT INTO `horarios` VALUES ('30', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('31', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('32', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('33', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('34', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('35', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('36', '1', '2', '1', '1', '1', '1');
INSERT INTO `horarios` VALUES ('71', '1', '1', '5', '7', '1', '1');
INSERT INTO `horarios` VALUES ('66', '1', '6', '22', '23', '1', '1');
INSERT INTO `horarios` VALUES ('59', '1', '1', '5', '6', '1', '1');
INSERT INTO `horarios` VALUES ('58', '2', '1', '2', '3', '1', '1');
INSERT INTO `horarios` VALUES ('70', '1', '1', '4', '8', '1', '1');
INSERT INTO `horarios` VALUES ('78', '1', '2', '1', '2', '1', '0');
INSERT INTO `horarios` VALUES ('73', '2', '1', '6', '7', '1', '1');
INSERT INTO `horarios` VALUES ('74', '2', '3', '1', '2', '1', '1');
INSERT INTO `horarios` VALUES ('75', '2', '2', '3', '4', '1', '1');
INSERT INTO `horarios` VALUES ('76', '2', '5', '6', '7', '1', '1');
INSERT INTO `horarios` VALUES ('81', '1', '4', '1', '2', '1', '0');
