/*
Navicat MySQL Data Transfer

Source Server         : MysqlServer
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : maproject

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-23 00:29:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ci_sessions
-- ----------------------------
DROP TABLE IF EXISTS `ci_sessions`;
CREATE TABLE `ci_sessions` (
  `session_id` varchar(40) NOT NULL DEFAULT '0',
  `ip_address` varchar(45) NOT NULL DEFAULT '0',
  `user_agent` varchar(120) NOT NULL,
  `last_activity` int(10) unsigned NOT NULL DEFAULT '0',
  `user_data` text NOT NULL,
  PRIMARY KEY (`session_id`),
  KEY `last_activity_idx` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ci_sessions
-- ----------------------------
INSERT INTO `ci_sessions` VALUES ('435d9ee6fc86cbf7be9d7ba6b992fddc', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:54.0) Gecko/20100101 Firefox/54.0', '1498152406', 'a:7:{s:9:\"user_data\";s:0:\"\";s:6:\"userId\";s:1:\"1\";s:4:\"role\";s:1:\"1\";s:13:\"menu_group_id\";s:1:\"1\";s:8:\"roleText\";s:20:\"System Administrator\";s:4:\"name\";s:12:\"System Admin\";s:10:\"isLoggedIn\";b:1;}');
INSERT INTO `ci_sessions` VALUES ('b7d18da71a2052e9270d5960175a2401', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:54.0) Gecko/20100101 Firefox/54.0', '1498139606', 'a:7:{s:9:\"user_data\";s:0:\"\";s:6:\"userId\";s:1:\"1\";s:4:\"role\";s:1:\"1\";s:13:\"menu_group_id\";s:1:\"1\";s:8:\"roleText\";s:20:\"System Administrator\";s:4:\"name\";s:12:\"System Admin\";s:10:\"isLoggedIn\";b:1;}');
INSERT INTO `ci_sessions` VALUES ('c8704e4b771de558ff89008247a2035b', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:54.0) Gecko/20100101 Firefox/54.0', '1498099606', 'a:7:{s:9:\"user_data\";s:0:\"\";s:6:\"userId\";s:1:\"1\";s:4:\"role\";s:1:\"1\";s:13:\"menu_group_id\";s:1:\"1\";s:8:\"roleText\";s:20:\"System Administrator\";s:4:\"name\";s:12:\"System Admin\";s:10:\"isLoggedIn\";b:1;}');

-- ----------------------------
-- Table structure for discount_of_contract
-- ----------------------------
DROP TABLE IF EXISTS `discount_of_contract`;
CREATE TABLE `discount_of_contract` (
  `discount_of_contract_id` int(11) NOT NULL AUTO_INCREMENT,
  `number` int(11) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`discount_of_contract_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of discount_of_contract
-- ----------------------------

-- ----------------------------
-- Table structure for discount_of_qty
-- ----------------------------
DROP TABLE IF EXISTS `discount_of_qty`;
CREATE TABLE `discount_of_qty` (
  `discount_of_qty_id` int(11) NOT NULL AUTO_INCREMENT,
  `from_number` int(11) NOT NULL,
  `to_number` int(11) NOT NULL,
  `discount` decimal(10,0) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`discount_of_qty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of discount_of_qty
-- ----------------------------

-- ----------------------------
-- Table structure for discount_sla_type
-- ----------------------------
DROP TABLE IF EXISTS `discount_sla_type`;
CREATE TABLE `discount_sla_type` (
  `discount_sla_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `min` decimal(10,0) DEFAULT NULL,
  `max` decimal(10,0) DEFAULT NULL,
  `is_owner` tinyint(4) DEFAULT '1',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`discount_sla_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of discount_sla_type
-- ----------------------------

-- ----------------------------
-- Table structure for menu
-- ----------------------------
DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(128) NOT NULL,
  `name` varchar(64) NOT NULL,
  `icon` varchar(64) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `order_by` int(10) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '#', 'Users Manage', 'fa fa-users', '0', '200', '1', '2017-06-10 20:05:21', '1', '2017-06-10 20:05:40', '1');
INSERT INTO `menu` VALUES ('2', 'dashboard', 'Dashboard', 'fa fa-fw fa-dashboard', '99', '100', '1', '2017-06-10 20:06:48', '1', null, null);
INSERT INTO `menu` VALUES ('3', 'userListing', 'Users', 'fa fa-circle-o', '1', '200', '1', '2017-06-17 17:37:58', '1', null, null);
INSERT INTO `menu` VALUES ('4', 'menugroup', 'Menu Group', 'fa fa-circle-o', '1', '100', '1', '2017-06-17 17:37:56', '1', null, null);
INSERT INTO `menu` VALUES ('5', '#', 'Master Data', 'fa fa-database', '0', '300', '1', '2017-06-17 17:37:52', '1', '2017-06-20 22:37:51', null);
INSERT INTO `menu` VALUES ('6', 'province', 'Province', 'fa fa-circle-o', '5', '100', '1', '2017-06-17 17:39:30', '1', null, null);
INSERT INTO `menu` VALUES ('7', 'discount_sla_type', 'SLA GP Type', 'fa fa-circle-o', '5', '200', '1', '2017-06-20 22:37:23', '1', null, null);
INSERT INTO `menu` VALUES ('8', 'discount_of_contract', 'Discount of contract', 'fa fa-circle-o', '5', '300', '1', '2017-06-20 22:39:25', '0', null, null);
INSERT INTO `menu` VALUES ('9', 'discount_of_qty', 'Discount of QTY', 'fa fa-circle-o', '5', '400', '1', '2017-06-20 22:40:40', '0', null, null);
INSERT INTO `menu` VALUES ('10', '#', 'Product Manage', 'fa fa-server', '0', '400', '1', '0000-00-00 00:00:00', '0', null, null);
INSERT INTO `menu` VALUES ('11', 'product_owner', 'Product TOS', 'fa fa-circle-o', '10', '200', '1', '0000-00-00 00:00:00', '0', null, null);
INSERT INTO `menu` VALUES ('12', 'product_vender', 'Product Vender', 'fa fa-circle-o', '10', '300', '1', '0000-00-00 00:00:00', '0', null, null);
INSERT INTO `menu` VALUES ('13', 'product_brand', 'Product Brand', 'fa fa-circle-o', '10', '100', '1', '0000-00-00 00:00:00', '0', null, null);

-- ----------------------------
-- Table structure for menu_group
-- ----------------------------
DROP TABLE IF EXISTS `menu_group`;
CREATE TABLE `menu_group` (
  `menu_group_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`menu_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu_group
-- ----------------------------
INSERT INTO `menu_group` VALUES ('1', 'System', 'System Management', '1', '2017-06-11 21:50:39', '1', '2017-06-18 21:12:44', '1');
INSERT INTO `menu_group` VALUES ('2', 'Admin', 'Admin Management', '1', '2017-06-11 16:58:02', '1', '2017-06-17 15:52:34', '1');
INSERT INTO `menu_group` VALUES ('3', 'Sale Agen', 'Sale Agen Management', '1', '2017-06-11 16:59:33', '1', '2017-06-17 15:29:56', '1');
INSERT INTO `menu_group` VALUES ('4', 'Sale office', 'Sale office Management', '1', '2017-06-17 14:37:55', '1', '2017-06-18 21:12:19', '1');
INSERT INTO `menu_group` VALUES ('5', 'Super Admin', 'Super Admin Management', '1', '2017-06-17 15:40:13', '1', '2017-06-17 15:52:19', '1');

-- ----------------------------
-- Table structure for menu_group_detail
-- ----------------------------
DROP TABLE IF EXISTS `menu_group_detail`;
CREATE TABLE `menu_group_detail` (
  `menu_id` int(11) NOT NULL DEFAULT '0',
  `menu_group_id` int(11) NOT NULL DEFAULT '0',
  `is_add` tinyint(1) NOT NULL DEFAULT '0',
  `is_view` tinyint(1) NOT NULL DEFAULT '0',
  `is_edit` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`menu_id`,`menu_group_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu_group_detail
-- ----------------------------
INSERT INTO `menu_group_detail` VALUES ('1', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('1', '2', '0', '1', '0', '1');
INSERT INTO `menu_group_detail` VALUES ('1', '3', '0', '1', '0', '1');
INSERT INTO `menu_group_detail` VALUES ('1', '4', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('1', '5', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('2', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('2', '2', '0', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('2', '3', '0', '1', '0', '1');
INSERT INTO `menu_group_detail` VALUES ('2', '4', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('2', '5', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('3', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('3', '2', '0', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('3', '3', '0', '1', '0', '1');
INSERT INTO `menu_group_detail` VALUES ('3', '4', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('3', '5', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('4', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('4', '2', '0', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('4', '3', '0', '1', '0', '1');
INSERT INTO `menu_group_detail` VALUES ('4', '4', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('4', '5', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('5', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('5', '2', '0', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('5', '5', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('6', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('6', '2', '0', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('6', '5', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('7', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('8', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('9', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('10', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('11', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('12', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('13', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for product_brand
-- ----------------------------
DROP TABLE IF EXISTS `product_brand`;
CREATE TABLE `product_brand` (
  `product_brand_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_brand
-- ----------------------------
INSERT INTO `product_brand` VALUES ('1', 'Cissco', 'Cissco Brand', '1', '2017-06-21 08:52:15', '1', '2017-06-21 08:52:31', '1');
INSERT INTO `product_brand` VALUES ('2', 'HP', 'HP brand', '1', '2017-06-23 00:27:57', '1', '2017-06-23 00:27:57', '1');

-- ----------------------------
-- Table structure for product_owner
-- ----------------------------
DROP TABLE IF EXISTS `product_owner`;
CREATE TABLE `product_owner` (
  `product_owner_id` int(11) NOT NULL AUTO_INCREMENT,
  `part_number` varchar(64) NOT NULL,
  `model` varchar(64) NOT NULL,
  `product_brand_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `full_price` decimal(10,0) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_owner
-- ----------------------------

-- ----------------------------
-- Table structure for product_vender
-- ----------------------------
DROP TABLE IF EXISTS `product_vender`;
CREATE TABLE `product_vender` (
  `product_vender_id` int(11) NOT NULL AUTO_INCREMENT,
  `part_number` varchar(64) NOT NULL,
  `model` varchar(64) NOT NULL,
  `product_brand_id` int(11) NOT NULL,
  `name` varchar(128) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `dealer_price` decimal(10,0) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_vender_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_vender
-- ----------------------------

-- ----------------------------
-- Table structure for province
-- ----------------------------
DROP TABLE IF EXISTS `province`;
CREATE TABLE `province` (
  `province_id` int(5) NOT NULL AUTO_INCREMENT,
  `province_code` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `province_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lb_year` decimal(10,0) DEFAULT '0',
  `pm_time` decimal(10,0) DEFAULT '0',
  `geo_id` int(5) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of province
-- ----------------------------
INSERT INTO `province` VALUES ('1', '10', 'กรุงเทพมหานคร   ', '200', '300', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-22 23:40:33', '1');
INSERT INTO `province` VALUES ('2', '11', 'สมุทรปราการ   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('3', '12', 'นนทบุรี   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('4', '13', 'ปทุมธานี   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('5', '14', 'พระนครศรีอยุธยา   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('6', '15', 'อ่างทอง   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('7', '16', 'ลพบุรี   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('8', '17', 'สิงห์บุรี   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('9', '18', 'ชัยนาท   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('10', '19', 'สระบุรี', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('11', '20', 'ชลบุรี   ', '0', '0', '5', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('12', '21', 'ระยอง   ', '0', '0', '5', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('13', '22', 'จันทบุรี   ', '0', '0', '5', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('14', '23', 'ตราด   ', '0', '0', '5', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('15', '24', 'ฉะเชิงเทรา   ', '0', '0', '5', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('16', '25', 'ปราจีนบุรี   ', '0', '0', '5', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('17', '26', 'นครนายก   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('18', '27', 'สระแก้ว   ', '0', '0', '5', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('19', '30', 'นครราชสีมา   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('20', '31', 'บุรีรัมย์   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('21', '32', 'สุรินทร์   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('22', '33', 'ศรีสะเกษ   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('23', '34', 'อุบลราชธานี   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('24', '35', 'ยโสธร   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('25', '36', 'ชัยภูมิ   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('26', '37', 'อำนาจเจริญ   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('27', '39', 'หนองบัวลำภู   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('28', '40', 'ขอนแก่น   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('29', '41', 'อุดรธานี   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('30', '42', 'เลย   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('31', '43', 'หนองคาย   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('32', '44', 'มหาสารคาม   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('33', '45', 'ร้อยเอ็ด   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('34', '46', 'กาฬสินธุ์   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('35', '47', 'สกลนคร   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('36', '48', 'นครพนม   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('37', '49', 'มุกดาหาร   ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('38', '50', 'เชียงใหม่   ', '0', '0', '1', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('39', '51', 'ลำพูน   ', '0', '0', '1', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('40', '52', 'ลำปาง   ', '0', '0', '1', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('41', '53', 'อุตรดิตถ์   ', '0', '0', '1', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('42', '54', 'แพร่   ', '0', '0', '1', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('43', '55', 'น่าน   ', '0', '0', '1', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('44', '56', 'พะเยา   ', '0', '0', '1', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('45', '57', 'เชียงราย   ', '0', '0', '1', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('46', '58', 'แม่ฮ่องสอน   ', '0', '0', '1', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('47', '60', 'นครสวรรค์   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('48', '61', 'อุทัยธานี   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('49', '62', 'กำแพงเพชร   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('50', '63', 'ตาก   ', '0', '0', '4', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('51', '64', 'สุโขทัย   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('52', '65', 'พิษณุโลก   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('53', '66', 'พิจิตร   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('54', '67', 'เพชรบูรณ์   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('55', '70', 'ราชบุรี   ', '0', '0', '4', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('56', '71', 'กาญจนบุรี   ', '0', '0', '4', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('57', '72', 'สุพรรณบุรี   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('58', '73', 'นครปฐม   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('59', '74', 'สมุทรสาคร   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('60', '75', 'สมุทรสงคราม   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('61', '76', 'เพชรบุรี   ', '0', '0', '4', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('62', '77', 'ประจวบคีรีขันธ์   ', '0', '0', '4', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('63', '80', 'นครศรีธรรมราช   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('64', '81', 'กระบี่   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('65', '82', 'พังงา   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('66', '83', 'ภูเก็ต   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('67', '84', 'สุราษฎร์ธานี   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('68', '85', 'ระนอง   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('69', '86', 'ชุมพร   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('70', '90', 'สงขลา   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('71', '91', 'สตูล   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('72', '92', 'ตรัง   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('73', '93', 'พัทลุง   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('74', '94', 'ปัตตานี   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('75', '95', 'ยะลา   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('76', '96', 'นราธิวาส   ', '0', '0', '6', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');
INSERT INTO `province` VALUES ('77', '97', 'บึงกาฬ', '0', '0', '3', '1', '2017-06-18 17:38:20', '1', '2017-06-18 21:11:37', '1');

-- ----------------------------
-- Table structure for tbl_reset_password
-- ----------------------------
DROP TABLE IF EXISTS `tbl_reset_password`;
CREATE TABLE `tbl_reset_password` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL,
  `activation_id` varchar(32) NOT NULL,
  `agent` varchar(512) NOT NULL,
  `client_ip` varchar(32) NOT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` bigint(20) NOT NULL DEFAULT '1',
  `createdDtm` datetime NOT NULL,
  `updatedBy` bigint(20) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_reset_password
-- ----------------------------

-- ----------------------------
-- Table structure for tbl_roles
-- ----------------------------
DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE `tbl_roles` (
  `roleId` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT 'role id',
  `role` varchar(50) NOT NULL COMMENT 'role text',
  `menu_group_id` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`roleId`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_roles
-- ----------------------------
INSERT INTO `tbl_roles` VALUES ('1', 'System Administrator', '1', '1', '2017-06-10 11:05:25', '1', null, null);
INSERT INTO `tbl_roles` VALUES ('2', 'Manager', '2', '1', '2017-06-10 11:05:30', '1', null, null);
INSERT INTO `tbl_roles` VALUES ('3', 'Employee', '3', '1', '2017-06-10 11:05:32', '1', null, null);

-- ----------------------------
-- Table structure for tbl_users
-- ----------------------------
DROP TABLE IF EXISTS `tbl_users`;
CREATE TABLE `tbl_users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(128) NOT NULL COMMENT 'login email',
  `password` varchar(128) NOT NULL COMMENT 'hashed login password',
  `name` varchar(128) DEFAULT NULL COMMENT 'full name of user',
  `mobile` varchar(20) DEFAULT NULL,
  `menu_group_id` int(11) NOT NULL,
  `roleId` tinyint(4) NOT NULL,
  `profile_img` varchar(256) DEFAULT NULL,
  `address` varchar(256) DEFAULT NULL,
  `isDeleted` tinyint(4) NOT NULL DEFAULT '0',
  `createdBy` int(11) NOT NULL,
  `createdDtm` datetime NOT NULL,
  `updatedBy` int(11) DEFAULT NULL,
  `updatedDtm` datetime DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of tbl_users
-- ----------------------------
INSERT INTO `tbl_users` VALUES ('1', 'system@wisadev.com', '$2y$10$abl8Qcd71JSqUeRPJd7ZQOZfiHzujLnYNFJMV.zv4cMHZvxpcVBSi', 'System Admin', null, '1', '1', null, null, '0', '1', '2017-06-11 21:44:51', '1', '2017-06-11 21:44:54');
INSERT INTO `tbl_users` VALUES ('2', 'supachai@wisadev.com', '$2y$10$I5FpXKlnpaj8WYAWvSkgBuO3Hc.jr.k7sjwbr.QNy0qinDCqVzR0i', 'Supachai Wisachai', '0917750586', '1', '2', null, null, '0', '1', '2017-06-11 16:56:35', null, null);
INSERT INTO `tbl_users` VALUES ('3', 'manager@wisadev.com', '$2y$10$dj.u.qiqcj7Y9Db5oK3QJuygwyi.Z7ceQH2F6A34cGUbkuWpyDi.2', 'Manager', '0917750586', '2', '2', null, null, '0', '1', '2017-06-11 17:24:57', null, null);
INSERT INTO `tbl_users` VALUES ('4', 'employee@wsiadev.com', '$2y$10$olThVYD4MwDAGAIZOf0KxelUk.gkOdpkahzWvgVKwK2g/dF6Zks7.', 'Employee', '0917750586', '3', '3', null, null, '0', '1', '2017-06-11 17:26:02', null, null);
