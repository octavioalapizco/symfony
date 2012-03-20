/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50508
Source Host           : localhost:3306
Source Database       : symfony

Target Server Type    : MYSQL
Target Server Version : 50508
File Encoding         : 65001

Date: 2012-03-19 20:55:04
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `acme_users`
-- ----------------------------
DROP TABLE IF EXISTS `acme_users`;
CREATE TABLE `acme_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL,
  `salt` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `email` varchar(60) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_55884A7F85E0677` (`username`),
  UNIQUE KEY `UNIQ_55884A7E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of acme_users
-- ----------------------------
INSERT INTO `acme_users` VALUES ('1', 'ryan', 'iont8pm8u2gwgc8w4g4coo8w48c8soo', '507f4c1e9a2fc487ac18f97d134c5e23647a768c', 'ryan@email.com', '1');
INSERT INTO `acme_users` VALUES ('4', 'cesar', '4jr13kvr9wu8cgoscww0ossgwk8c8ss', 'bf3aad154a5a1a114d92cf4c3b146a3e4247fd06', 'cesar@test.com', '1');
INSERT INTO `acme_users` VALUES ('5', 'faary', '3bgmw2uvlj40kg8s0cs4s8w88o4coss', 'ea57ad593499eb7dbdccac2960aa229539440464', 'faary@email.com', '1');

-- ----------------------------
-- Table structure for `blog`
-- ----------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE `blog` (
  `blog_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `blog_name` char(255) DEFAULT NULL COMMENT 'nombre del blog',
  PRIMARY KEY (`blog_id`),
  KEY `blog_id` (`blog_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog
-- ----------------------------
INSERT INTO `blog` VALUES ('1', 'Pendientes');
INSERT INTO `blog` VALUES ('2', 'Características');
INSERT INTO `blog` VALUES ('4', 'Write a blog');

-- ----------------------------
-- Table structure for `blog_categoria`
-- ----------------------------
DROP TABLE IF EXISTS `blog_categoria`;
CREATE TABLE `blog_categoria` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_categoria
-- ----------------------------
INSERT INTO `blog_categoria` VALUES ('1', 'pendientes');
INSERT INTO `blog_categoria` VALUES ('2', 'listo');
INSERT INTO `blog_categoria` VALUES ('3', 'Sprint 1');

-- ----------------------------
-- Table structure for `blog_comment`
-- ----------------------------
DROP TABLE IF EXISTS `blog_comment`;
CREATE TABLE `blog_comment` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_id` bigint(20) NOT NULL,
  `author` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blog_comment_post_id_idx` (`post_id`),
  CONSTRAINT `blog_post_id` FOREIGN KEY (`post_id`) REFERENCES `blog_post` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of blog_comment
-- ----------------------------

-- ----------------------------
-- Table structure for `blog_post`
-- ----------------------------
DROP TABLE IF EXISTS `blog_post`;
CREATE TABLE `blog_post` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `fk_categoria_id` int(11) unsigned NOT NULL DEFAULT '1',
  `fk_blog_id` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_categoria_id` (`fk_categoria_id`),
  CONSTRAINT `fk_categoria_id` FOREIGN KEY (`fk_categoria_id`) REFERENCES `blog_categoria` (`id`) ON DELETE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of blog_post
-- ----------------------------
INSERT INTO `blog_post` VALUES ('7', 'Mostrar notificaciones del sistema', '<p>De preferencia &nbsp;en la parte inferior, que los mensajes desaparezcan automaticamente pero con la posibilidad de darle cierre por parte del usuario</p>', '2012-03-13 21:08:00', '3', '1');
INSERT INTO `blog_post` VALUES ('9', 'Summary of Roles', '<h2><span class=\\\"\\\\&quot;mw-headline\\\\&quot;\\\">Summary of Roles</span></h2>\r\n<ul>\r\n<li><a class=\\\"\\\\&quot;mw-redirect\\\\&quot;\\\" title=\\\"\\\\&quot;Super\\\" href=\\\"\\\\&quot;http:/codex.wordpress.org/Super_Admin_Menu\\\\&quot;\\\">Super Admin</a>&nbsp;- Someone with access to the blog network administration features controlling the entire network (<a title=\\\"\\\\&quot;Create\\\" href=\\\"\\\\&quot;http:/codex.wordpress.org/Create_A_Network\\\\&quot;\\\">See Create a Network</a>).</li>\r\n<li><a title=\\\"\\\\&quot;\\\\&quot;\\\" href=\\\"\\\\&quot;http:/codex.wordpress.org/Roles_and_Capabilities#Administrator\\\\&quot;\\\">Administrator</a>&nbsp;- Somebody who has access to all the administration features</li>\r\n<li><a title=\\\"\\\\&quot;\\\\&quot;\\\" href=\\\"\\\\&quot;http:/codex.wordpress.org/Roles_and_Capabilities#Editor\\\\&quot;\\\">Editor</a>&nbsp;- Somebody who can publish and manage posts and pages as well as manage other users\\\\\\\' posts, etc.</li>\r\n<li><a title=\\\"\\\\&quot;\\\\&quot;\\\" href=\\\"\\\\&quot;http:/codex.wordpress.org/Roles_and_Capabilities#Author\\\\&quot;\\\">Author</a>&nbsp;- Somebody who can publish and manage their own posts</li>\r\n<li><a title=\\\"\\\\&quot;\\\\&quot;\\\" href=\\\"\\\\&quot;http:/codex.wordpress.org/Roles_and_Capabilities#Contributor\\\\&quot;\\\">Contributor</a>&nbsp;- Somebody who can write and manage their posts but not publish them</li>\r\n<li><a title=\\\"\\\\&quot;\\\\&quot;\\\" href=\\\"\\\\&quot;http:/codex.wordpress.org/Roles_and_Capabilities#Subscriber\\\\&quot;\\\">Subscriber</a>&nbsp;- Somebody who can only manage their profile</li>\r\n</ul>', '2012-02-05 16:19:42', '1', '1');
INSERT INTO `blog_post` VALUES ('10', 'confirmar cancelacion', '<p>Mostrar Ventana de confirmacion antes de borrar blogs y posts.</p>\r\n<p>En el caso de los blogs notificar que es necesario borrar los posts y aclarar que la acci&oacute;n es irreversible</p>\r\n<p>&nbsp;</p>', '2012-02-06 16:19:46', '1', '1');
INSERT INTO `blog_post` VALUES ('11', 'Creacion de usuarios', '<p>Estilo al <a href=\\\"new_user\\\">formulario de registro de usuario&nbsp;</a></p>', '2012-03-30 16:19:51', '1', '1');
INSERT INTO `blog_post` VALUES ('21', 'Organizar menus', '<ul>\r\n<li>Agregar iconos</li>\r\n<li></li>\r\n</ul>\r\n<p>&nbsp;</p>', '2012-06-14 16:19:59', '1', '1');
INSERT INTO `blog_post` VALUES ('22', 'Summary of Roles', '<ul>\r\n<li><a class=\\\"\\\\&quot;\\\\\\\\&quot;mw-redirect\\\\\\\\&quot;\\\\&quot;\\\" title=\\\"\\\\&quot;\\\\\\\\&quot;Super\\\\&quot;\\\" href=\\\"\\\\&quot;\\\\\\\\&quot;http:/codex.wordpress.org/Super_Admin_Menu\\\\\\\\&quot;\\\\&quot;\\\"><img src=\\\"http://lh3.googleusercontent.com/_Zuzii37VUO4/Ta0nUeMwXoI/AAAAAAAAFoc/7f0Um7OTgNg/s000/Antartic-by-Peter-Rejcek.jpg\\\" alt=\\\"\\\" width=\\\"500\\\" height=\\\"332\\\" />Super Admin</a>&nbsp;- Someone with access to the blog network administration features controlling the entire network (<a title=\\\"\\\\&quot;\\\\\\\\&quot;Create\\\\&quot;\\\" href=\\\"\\\\&quot;\\\\\\\\&quot;http:/codex.wordpress.org/Create_A_Network\\\\\\\\&quot;\\\\&quot;\\\">See Create a Network</a>).</li>\r\n<li><a title=\\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\\" href=\\\"\\\\&quot;\\\\\\\\&quot;http:/codex.wordpress.org/Roles_and_Capabilities#Administrator\\\\\\\\&quot;\\\\&quot;\\\">Administrator</a>&nbsp;- Somebody who has access to all the administration features</li>\r\n<li><a title=\\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\\" href=\\\"\\\\&quot;\\\\\\\\&quot;http:/codex.wordpress.org/Roles_and_Capabilities#Editor\\\\\\\\&quot;\\\\&quot;\\\">Editor</a>&nbsp;- Somebody who can publish and manage posts and pages as well as manage other users\\\\\\\\\\\\\\\' posts, etc.</li>\r\n<li><a title=\\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\\" href=\\\"\\\\&quot;\\\\\\\\&quot;http:/codex.wordpress.org/Roles_and_Capabilities#Author\\\\\\\\&quot;\\\\&quot;\\\">Author</a>&nbsp;- Somebody who can publish and manage their own posts</li>\r\n<li><a title=\\\"\\\\&quot;\\\\\\\\&quot;\\\\\\\\&quot;\\\\&quot;\\\" href=\\\"\\\\&quot;\\\\\\\\&quot;http:/codex.wordpress.org/Roles_and_Capabilities#Contributor\\\\\\\\&quot;\\\\&quot;\\\">Contributor</a>&nbsp;- Somebody who can write and manage their posts but not publish them</li>\r\n<li><a title=\"asd\" href=\\\"http://lh3.googleusercontent.com/_Zuzii37VUO4/Ta0nUeMwXoI/AAAAAAAAFoc/7f0Um7OTgNg/s000/Antartic-by-Peter-Rejcek.jpg\\\">Subscriber</a>&nbsp;- Somebody who can only manage their profile</li>\r\n</ul>', '0000-00-00 00:00:00', '2', '1');
INSERT INTO `blog_post` VALUES ('23', 'Summary of Roles', '<h2 style=\\\"text-align: left; margin-top: 22px; margin-right: 0px; margin-bottom: 11px; margin-left: 0px; font-weight: normal; font-family: Georgia, \\\'Times New Roman\\\', Times, serif; font-size: 23px; color: #333333; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: #dadada; line-height: 22px; padding: 0px;\\\"><span class=\\\"mw-headline\\\">Summary of Roles</span></h2>\r\n<ul style=\\\"text-align: left; margin-top: 0px; margin-right: 0px; margin-bottom: 22px; margin-left: 16px; list-style-type: square; list-style-position: initial; list-style-image: initial; font-family: \\\'Lucida Grande\\\', Verdana, \\\'Bitstream Vera Sans\\\', Arial, sans-serif; font-size: 12px; line-height: 22px; padding: 0px;\\\">\r\n<li style=\\\"text-align: left !important; padding: 0px; margin: 0px;\\\"><a class=\\\"mw-redirect\\\" style=\\\"text-decoration: none; color: #4ca6cf;\\\" title=\\\"Super Admin Menu\\\" href=\\\"http://codex.wordpress.org/Super_Admin_Menu\\\">Super Admin</a>&nbsp;- Someone with access to the blog network administration features controlling the entire network (<a style=\\\"text-decoration: none; color: #4ca6cf;\\\" title=\\\"Create A Network\\\" href=\\\"http://codex.wordpress.org/Create_A_Network\\\">See Create a Network</a>).</li>\r\n<li style=\\\"text-align: left !important; padding: 0px; margin: 0px;\\\"><a style=\\\"text-decoration: none; color: #4ca6cf;\\\" title=\\\"\\\" href=\\\"http://codex.wordpress.org/Roles_and_Capabilities#Administrator\\\">Administrator</a>&nbsp;- Somebody who has access to all the administration features</li>\r\n<li style=\\\"text-align: left !important; padding: 0px; margin: 0px;\\\"><a style=\\\"text-decoration: none; color: #4ca6cf;\\\" title=\\\"\\\" href=\\\"http://codex.wordpress.org/Roles_and_Capabilities#Editor\\\">Editor</a>&nbsp;- Somebody who can publish and manage posts and pages as well as manage other users\\\' posts, etc.</li>\r\n<li style=\\\"text-align: left !important; padding: 0px; margin: 0px;\\\"><a style=\\\"text-decoration: none; color: #4ca6cf;\\\" title=\\\"\\\" href=\\\"http://codex.wordpress.org/Roles_and_Capabilities#Author\\\">Author</a>&nbsp;- Somebody who can publish and manage their own posts</li>\r\n<li style=\\\"text-align: left !important; padding: 0px; margin: 0px;\\\"><a style=\\\"text-decoration: none; color: #4ca6cf;\\\" title=\\\"\\\" href=\\\"http://codex.wordpress.org/Roles_and_Capabilities#Contributor\\\">Contributor</a>&nbsp;- Somebody who can write and manage their posts but not publish them</li>\r\n<li style=\\\"text-align: left !important; padding: 0px; margin: 0px;\\\"><a style=\\\"text-decoration: none; color: #4ca6cf;\\\" title=\\\"\\\" href=\\\"http://codex.wordpress.org/Roles_and_Capabilities#Subscriber\\\">Subscriber</a>&nbsp;- Somebody who can only manage their profile</li>\r\n</ul>', '2011-12-13 16:20:13', '2', '1');
INSERT INTO `blog_post` VALUES ('24', 'login - logout', '<p>agregar boton login/logout</p>', '2012-02-20 08:54:44', '1', '1');
INSERT INTO `blog_post` VALUES ('25', 'errores', '<p>poner titulo login / logout causa error por la barra.</p>', '2012-02-20 09:01:23', '1', '1');
INSERT INTO `blog_post` VALUES ('26', 'Cambiar imagen', '<p>Permitir agregar una imagen al post y poder cambiarla</p>', '2012-02-20 09:02:06', '1', '1');
INSERT INTO `blog_post` VALUES ('28', 'Add Coments', '<h1 style=\\\"margin: 0px; padding: 0px; font-size: 22px; font-weight: normal; display: block; line-height: 22px; color: #393939; font-family: Arial,Verdana,sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;\\\"><a href=\\\"http://knpbundles.com/kitpages/KitpagesUserGeneratedBundle\\\">http://knpbundles.com/kitpages/KitpagesUserGeneratedBundle</a></h1>\r\n<h1 style=\\\"margin: 0px; padding: 0px; font-size: 22px; font-weight: normal; display: block; line-height: 22px; color: #393939; font-family: Arial,Verdana,sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;\\\">&nbsp;</h1>\r\n<h1 style=\\\"margin: 0px; padding: 0px; font-size: 22px; font-weight: normal; display: block; line-height: 22px; color: #393939; font-family: Arial,Verdana,sans-serif; font-style: normal; font-variant: normal; letter-spacing: normal; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff;\\\"><span style=\\\"color: #666666; font-family: Arial,Verdana,sans-serif; font-size: 14px; font-style: normal; font-variant: normal; font-weight: normal; letter-spacing: normal; line-height: 24px; orphans: 2; text-align: left; text-indent: 0px; text-transform: none; white-space: normal; widows: 2; word-spacing: 0px; background-color: #ffffff; display: inline ! important; float: none;\\\">This bundle is an way to add comments on any content of a website</span></h1>', '2012-02-21 07:06:32', '1', '1');
INSERT INTO `blog_post` VALUES ('29', 'Busquedas con Zend Lucerne', '<p><a href=\\\"http://knpbundles.com/excelwebzone/EWZSearchBundle\\\">http://knpbundles.com/excelwebzone/EWZSearchBundle</a></p>', '2012-02-21 07:13:45', '1', '1');
INSERT INTO `blog_post` VALUES ('30', 'crear backend', '<p>admin.php para entrar al administrador</p>', '2012-02-21 07:15:32', '1', '1');
INSERT INTO `blog_post` VALUES ('31', 'Instalar un blog bundle', '<p><em>Instalar los bundles necesarios para crear un blog</em></p>', '2012-02-21 07:23:19', '1', '1');
INSERT INTO `blog_post` VALUES ('32', 'Doctrator, muy shido', '<p>Agregar <a href=\\\"http://www.symfony.es/2011/03/04/sflive2011-doctrator-comportamientos-en-doctrine2/\\\">http://www.symfony.es/2011/03/04/sflive2011-doctrator-comportamientos-en-doctrine2/</a></p>\r\n<p>&nbsp;</p>', '2012-02-21 07:40:32', '1', '1');
INSERT INTO `blog_post` VALUES ('33', 'ver blog', '<p><a href=\\\"http://sylius.org/sandbox/administration/assortment/products/list?page=2\\\">http://sylius.org/sandbox/administration/assortment/products/list?page=2</a></p>', '2012-02-24 07:26:02', '1', '1');
INSERT INTO `blog_post` VALUES ('34', 'Estrenando sonata admin', 'Post creado desde Sonata Admin', '2012-02-22 11:16:00', '1', '1');
INSERT INTO `blog_post` VALUES ('35', 'as', 'AS', '2012-03-01 01:02:00', '2', '1');
INSERT INTO `blog_post` VALUES ('36', 'asdf', 'asdff', '2012-02-27 02:04:42', '1', '1');
INSERT INTO `blog_post` VALUES ('37', 'a 01', 'a 01', '2012-02-27 02:22:16', '1', '1');
INSERT INTO `blog_post` VALUES ('38', 'investigar mink php', 'http://mink.behat.org/', '2012-02-27 02:29:00', '1', '1');
INSERT INTO `blog_post` VALUES ('39', 'agregar disqus', 'www.disqus.com', '2012-02-27 05:41:50', '1', '1');
INSERT INTO `blog_post` VALUES ('40', 'otro post', 'otro comentario', '2007-01-01 00:00:00', '1', '1');
INSERT INTO `blog_post` VALUES ('41', 'tu madre', 'tu madre tu madre', '2007-01-01 00:00:00', '1', '1');

-- ----------------------------
-- Table structure for `comment`
-- ----------------------------
DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `url` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_5BC96BF04B89032C` (`post_id`),
  CONSTRAINT `FK_5BC96BF04B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of comment
-- ----------------------------
INSERT INTO `comment` VALUES ('5', null, 'mi nombre', 'email@test.com', 'www.asd.com', 'Un mensaj');
INSERT INTO `comment` VALUES ('6', null, 'zxczxczc', 'zxzxc@asd.com', 'www.asd.com', 'zxczxczxczc');
INSERT INTO `comment` VALUES ('7', null, 'zxczxczc', 'zxzxc@asd.com', 'www.asd.com', 'zxczxczxczc');

-- ----------------------------
-- Table structure for `fb_factura`
-- ----------------------------
DROP TABLE IF EXISTS `fb_factura`;
CREATE TABLE `fb_factura` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `rfc_e` char(20) NOT NULL,
  `rfc_r` char(20) NOT NULL,
  `fecha_emision` datetime NOT NULL,
  `serie` char(10) DEFAULT NULL,
  `folio` int(11) NOT NULL,
  `total_antes_dimpuestos` decimal(18,4) unsigned NOT NULL,
  `i_traladados` decimal(18,4) unsigned DEFAULT NULL,
  `i_retenidos` decimal(18,4) unsigned DEFAULT NULL,
  `total` decimal(18,4) unsigned NOT NULL,
  `tipo_comprobante` enum('CFDI','CFD') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fb_factura
-- ----------------------------
INSERT INTO `fb_factura` VALUES ('1', 'ssdfg', 'affgdsfg', '2007-01-01 00:00:00', 'asdf', '113', '2345.0000', '234.0000', '234.0000', '234.0000', null);
INSERT INTO `fb_factura` VALUES ('2', 'AAA010101AAA', 'BIAC810820TH2', '2012-02-17 18:52:12', 'A', '360', '96500.0000', null, null, '96500.0000', null);
INSERT INTO `fb_factura` VALUES ('3', 'AAA010101AAA', 'BIAC810820TH2', '2012-02-17 18:52:46', 'A', '361', '2200.0000', null, null, '2200.0000', null);

-- ----------------------------
-- Table structure for `fos_user`
-- ----------------------------
DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `username_canonical` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_canonical` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of fos_user
-- ----------------------------
INSERT INTO `fos_user` VALUES ('1', 'cesar', 'cesar', 'runtim3.error@gmail.com', 'runtim3.error@gmail.com', '1', '7prdtwr51vs40s8so8kwwc000s044oo', '4xsvOg7aDQF4UBl5FKfh2NrelBoJWJc31ZaxfgVvhiNuUXRUHFyfTkc8CH0LEfrHxAiBGcXrzFCeU8jQSzI7Mw==', null, '0', '0', null, null, null, 'a:0:{}', '0', null);

-- ----------------------------
-- Table structure for `post`
-- ----------------------------
DROP TABLE IF EXISTS `post`;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `abstract` longtext NOT NULL,
  `content` longtext NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post
-- ----------------------------
INSERT INTO `post` VALUES ('1', 'aaaa', 'asda dasd asd asd asd ', 'asda da ads ', '0', '2012-02-20 09:25:47');
INSERT INTO `post` VALUES ('2', 'el titulo', 'abstracto', 'contenido', '0', '2012-02-26 17:47:00');
INSERT INTO `post` VALUES ('3', 'no more comments', 'quit{é la caja para comentarios', 'no content', '0', '2012-02-26 20:18:00');

-- ----------------------------
-- Table structure for `post_tag`
-- ----------------------------
DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE `post_tag` (
  `post_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`post_id`,`tag_id`),
  KEY `IDX_5ACE3AF04B89032C` (`post_id`),
  KEY `IDX_5ACE3AF0BAD26311` (`tag_id`),
  CONSTRAINT `FK_5ACE3AF04B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5ACE3AF0BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of post_tag
-- ----------------------------
INSERT INTO `post_tag` VALUES ('2', '2');

-- ----------------------------
-- Table structure for `product`
-- ----------------------------
DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product
-- ----------------------------
INSERT INTO `product` VALUES ('1', 'A Foo Bar', '19.99', 'Lorem ipsum dolor');
INSERT INTO `product` VALUES ('2', 'A Foo Bar', '19.99', 'Lorem ipsum dolor');
INSERT INTO `product` VALUES ('3', 'A Foo Bar', '19.99', 'Lorem ipsum dolor');

-- ----------------------------
-- Table structure for `revisions`
-- ----------------------------
DROP TABLE IF EXISTS `revisions`;
CREATE TABLE `revisions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `timestamp` datetime NOT NULL,
  `username` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of revisions
-- ----------------------------

-- ----------------------------
-- Table structure for `tag`
-- ----------------------------
DROP TABLE IF EXISTS `tag`;
CREATE TABLE `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag
-- ----------------------------
INSERT INTO `tag` VALUES ('2', 'un tag', '0');

-- ----------------------------
-- Table structure for `tag_post`
-- ----------------------------
DROP TABLE IF EXISTS `tag_post`;
CREATE TABLE `tag_post` (
  `tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`,`post_id`),
  KEY `IDX_B485D33BBAD26311` (`tag_id`),
  KEY `IDX_B485D33B4B89032C` (`post_id`),
  CONSTRAINT `FK_B485D33B4B89032C` FOREIGN KEY (`post_id`) REFERENCES `post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B485D33BBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tag_post
-- ----------------------------
