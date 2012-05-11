/*
Navicat MySQL Data Transfer

Source Server         : saw
Source Server Version : 50051
Source Host           : 201.155.192.116:3306
Source Database       : iticarloscanedo

Target Server Type    : MYSQL
Target Server Version : 50051
File Encoding         : 65001

Date: 2012-05-10 22:48:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `dias`
-- ----------------------------
DROP TABLE IF EXISTS `dias`;
CREATE TABLE `dias` (
  `id` double NOT NULL auto_increment,
  `dia` varchar(30) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dias
-- ----------------------------
INSERT INTO `dias` VALUES ('1', 'Lunes');
INSERT INTO `dias` VALUES ('2', 'Martes');
INSERT INTO `dias` VALUES ('3', 'Miercoles');
INSERT INTO `dias` VALUES ('4', 'Jueves');
INSERT INTO `dias` VALUES ('5', 'Viernes');
INSERT INTO `dias` VALUES ('6', 'Sabado');
