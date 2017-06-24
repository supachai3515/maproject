/*
Navicat MySQL Data Transfer

Source Server         : MysqlServer
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : maproject

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-24 23:28:59
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
INSERT INTO `ci_sessions` VALUES ('9352b6a746c0d56d8705fde9520af468', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:54.0) Gecko/20100101 Firefox/54.0', '1498317017', 'a:7:{s:9:\"user_data\";s:0:\"\";s:6:\"userId\";s:1:\"1\";s:4:\"role\";s:1:\"1\";s:13:\"menu_group_id\";s:1:\"1\";s:8:\"roleText\";s:20:\"System Administrator\";s:4:\"name\";s:12:\"System Admin\";s:10:\"isLoggedIn\";b:1;}');
INSERT INTO `ci_sessions` VALUES ('c58de51b67b71bd7388b15bfdad1c6c8', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:54.0) Gecko/20100101 Firefox/54.0', '1498302533', 'a:7:{s:9:\"user_data\";s:0:\"\";s:6:\"userId\";s:1:\"1\";s:4:\"role\";s:1:\"1\";s:13:\"menu_group_id\";s:1:\"1\";s:8:\"roleText\";s:20:\"System Administrator\";s:4:\"name\";s:12:\"System Admin\";s:10:\"isLoggedIn\";b:1;}');

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of menu
-- ----------------------------
INSERT INTO `menu` VALUES ('1', '#', 'Users Manage', 'fa fa-users', '0', '1000', '1', '2017-06-10 20:05:21', '1', '2017-06-10 20:05:40', '1');
INSERT INTO `menu` VALUES ('2', 'dashboard', 'Dashboard', 'fa fa-fw fa-dashboard', '99', '100', '1', '2017-06-10 20:06:48', '1', null, null);
INSERT INTO `menu` VALUES ('3', 'userListing', 'Users', 'fa fa-circle-o', '1', '200', '1', '2017-06-17 17:37:58', '1', null, null);
INSERT INTO `menu` VALUES ('4', 'menugroup', 'Menu Group', 'fa fa-circle-o', '1', '100', '1', '2017-06-17 17:37:56', '1', null, null);
INSERT INTO `menu` VALUES ('5', '#', 'Master Data', 'fa fa-database', '0', '300', '1', '2017-06-17 17:37:52', '1', '2017-06-20 22:37:51', null);
INSERT INTO `menu` VALUES ('6', 'province', 'Province', 'fa fa-circle-o', '5', '100', '1', '2017-06-17 17:39:30', '1', null, null);
INSERT INTO `menu` VALUES ('7', 'discount_sla_type', 'SLA GP Type', 'fa fa-circle-o', '5', '200', '1', '2017-06-20 22:37:23', '1', null, null);
INSERT INTO `menu` VALUES ('8', 'discount_of_contract', 'Discount of contract', 'fa fa-circle-o', '5', '300', '1', '2017-06-20 22:39:25', '1', null, null);
INSERT INTO `menu` VALUES ('9', 'discount_of_qty', 'Discount of QTY', 'fa fa-circle-o', '5', '400', '1', '2017-06-20 22:40:40', '1', null, null);
INSERT INTO `menu` VALUES ('10', '#', 'Product Manage', 'fa fa-server', '0', '400', '1', '2017-06-24 17:59:31', '1', null, null);
INSERT INTO `menu` VALUES ('11', 'product_owner', 'Product TOS', 'fa fa-circle-o', '10', '200', '1', '2017-06-24 17:59:33', '1', null, null);
INSERT INTO `menu` VALUES ('12', 'product_vender', 'Product Vender', 'fa fa-circle-o', '10', '300', '1', '2017-06-24 17:59:35', '1', null, null);
INSERT INTO `menu` VALUES ('13', 'product_brand', 'Product Brand', 'fa fa-circle-o', '10', '100', '1', '2017-06-24 17:59:37', '1', null, null);
INSERT INTO `menu` VALUES ('14', '#', 'Document', 'fa fa-file-text-o', '0', '100', '1', '2017-06-24 17:59:16', '1', null, null);
INSERT INTO `menu` VALUES ('15', 'order', 'Orders', 'fa fa-circle-o', '14', '100', '1', '2017-06-24 18:02:33', '1', null, null);
INSERT INTO `menu` VALUES ('16', 'sale_order', 'Sale Orders', 'fa fa-circle-o', '14', '200', '1', '2017-06-24 18:03:37', '1', null, null);

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
INSERT INTO `menu_group` VALUES ('1', 'System', 'System Management', '1', '2017-06-11 21:50:39', '1', '2017-06-24 18:09:33', '1');
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
INSERT INTO `menu_group_detail` VALUES ('14', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('15', '1', '1', '1', '1', '1');
INSERT INTO `menu_group_detail` VALUES ('16', '1', '1', '1', '1', '1');

-- ----------------------------
-- Table structure for order
-- ----------------------------
DROP TABLE IF EXISTS `order`;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date` datetime NOT NULL,
  `company` varchar(128) NOT NULL,
  `address` varchar(512) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(128) NOT NULL,
  `order_status_id` int(11) DEFAULT NULL,
  `province_id` int(11) DEFAULT NULL,
  `lb_year` int(11) DEFAULT NULL,
  `pm_year` int(11) DEFAULT NULL,
  `discount_sla_type_id` int(11) DEFAULT NULL,
  `discount_sla_type_values` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` decimal(11,0) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=692 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order
-- ----------------------------

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `is_product_owner` tinyint(1) DEFAULT NULL,
  `product_owner_id` int(11) DEFAULT NULL,
  `product_vender_id` int(11) DEFAULT NULL,
  `full_price` decimal(10,0) DEFAULT NULL,
  `dealer_price` decimal(10,0) DEFAULT NULL,
  `discount_sla_type_values` decimal(11,0) DEFAULT NULL,
  `discount_of_contract_values` decimal(11,0) DEFAULT NULL,
  `discount_of_qty_values` decimal(11,0) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` decimal(11,0) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=692 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_detail
-- ----------------------------

-- ----------------------------
-- Table structure for order_status
-- ----------------------------
DROP TABLE IF EXISTS `order_status`;
CREATE TABLE `order_status` (
  `order_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `priority_color` varchar(50) DEFAULT NULL,
  `icon_font` varchar(50) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_status
-- ----------------------------
INSERT INTO `order_status` VALUES ('1', 'ขอใบเสนอราคา', null, 'warning', null, '1', '2017-06-24 18:33:54', '1', null, null);
INSERT INTO `order_status` VALUES ('2', 'ขอราคาพิเศษ', null, 'info', null, '1', '2017-06-24 18:33:58', '1', null, null);
INSERT INTO `order_status` VALUES ('3', 'Assign Sale', null, 'info', null, '1', '2017-06-24 18:34:01', '1', null, null);
INSERT INTO `order_status` VALUES ('4', 'ส่งราคาพิเศษ', null, 'info', null, '1', '2017-06-24 18:34:04', '1', null, null);
INSERT INTO `order_status` VALUES ('5', 'ยืนยันราคา', null, 'info', null, '1', '2017-06-24 18:34:08', '1', null, null);
INSERT INTO `order_status` VALUES ('6', 'แนบเอกสารสั่งซื้อ', null, 'info', null, '1', '2017-06-24 18:34:12', '1', null, null);
INSERT INTO `order_status` VALUES ('7', 'อนุมัติ', null, 'success', null, '1', '2017-06-24 18:34:14', '1', null, null);
INSERT INTO `order_status` VALUES ('8', 'ยกเลิก', null, 'default', null, '1', '2017-06-24 22:13:08', '1', null, null);

-- ----------------------------
-- Table structure for order_status_history
-- ----------------------------
DROP TABLE IF EXISTS `order_status_history`;
CREATE TABLE `order_status_history` (
  `order_id` int(11) NOT NULL,
  `order_status_id` int(2) NOT NULL,
  `description` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_status_history
-- ----------------------------
INSERT INTO `order_status_history` VALUES ('2', '2', '', '2017-04-09 21:56:04');
INSERT INTO `order_status_history` VALUES ('2', '5', '', '2017-04-16 01:49:12');
INSERT INTO `order_status_history` VALUES ('1', '2', '', '2017-04-28 14:40:46');
INSERT INTO `order_status_history` VALUES ('3', '2', '', '2017-04-28 14:48:29');
INSERT INTO `order_status_history` VALUES ('7', '2', '', '2017-05-05 22:16:53');
INSERT INTO `order_status_history` VALUES ('7', '4', '', '2017-05-05 22:24:56');
INSERT INTO `order_status_history` VALUES ('2', '2', '', '2017-05-09 12:38:03');
INSERT INTO `order_status_history` VALUES ('2', '2', '', '2017-05-09 12:38:09');
INSERT INTO `order_status_history` VALUES ('3', '2', '', '2017-05-09 13:05:42');
INSERT INTO `order_status_history` VALUES ('3', '2', '', '2017-05-09 13:06:09');
INSERT INTO `order_status_history` VALUES ('4', '2', '', '2017-05-09 13:09:20');
INSERT INTO `order_status_history` VALUES ('1', '2', '', '2017-05-09 13:14:10');
INSERT INTO `order_status_history` VALUES ('1', '2', '', '2017-05-09 13:17:30');
INSERT INTO `order_status_history` VALUES ('6', '2', '', '2017-05-09 13:52:20');
INSERT INTO `order_status_history` VALUES ('8', '2', '', '2017-05-09 14:17:51');
INSERT INTO `order_status_history` VALUES ('5', '2', '', '2017-05-09 14:28:30');
INSERT INTO `order_status_history` VALUES ('9', '2', '', '2017-05-09 14:42:05');
INSERT INTO `order_status_history` VALUES ('11', '2', '', '2017-05-09 15:20:20');
INSERT INTO `order_status_history` VALUES ('12', '2', '', '2017-05-09 15:47:47');
INSERT INTO `order_status_history` VALUES ('14', '2', '', '2017-05-09 16:42:11');
INSERT INTO `order_status_history` VALUES ('15', '2', '', '2017-05-09 16:49:50');
INSERT INTO `order_status_history` VALUES ('13', '2', '', '2017-05-09 17:14:59');
INSERT INTO `order_status_history` VALUES ('13', '2', '', '2017-05-09 17:15:18');
INSERT INTO `order_status_history` VALUES ('16', '2', '', '2017-05-09 17:16:52');
INSERT INTO `order_status_history` VALUES ('17', '2', '', '2017-05-09 17:39:45');
INSERT INTO `order_status_history` VALUES ('17', '2', '', '2017-05-09 17:39:50');
INSERT INTO `order_status_history` VALUES ('18', '2', '', '2017-05-09 18:49:14');
INSERT INTO `order_status_history` VALUES ('1', '4', 'มารับเอง', '2017-05-10 09:59:32');
INSERT INTO `order_status_history` VALUES ('19', '2', '', '2017-05-10 11:01:41');
INSERT INTO `order_status_history` VALUES ('6', '4', 'GE734507285WW', '2017-05-10 14:25:47');
INSERT INTO `order_status_history` VALUES ('18', '4', 'GE734507294WW', '2017-05-10 14:26:20');
INSERT INTO `order_status_history` VALUES ('19', '4', 'GE734507303WW', '2017-05-10 14:26:43');
INSERT INTO `order_status_history` VALUES ('17', '4', '', '2017-05-10 14:57:11');
INSERT INTO `order_status_history` VALUES ('16', '4', 'GE734507246WW', '2017-05-10 14:57:57');
INSERT INTO `order_status_history` VALUES ('15', '4', 'GE734507250WW', '2017-05-10 14:58:22');
INSERT INTO `order_status_history` VALUES ('14', '4', 'GE734507277WW', '2017-05-10 14:58:39');
INSERT INTO `order_status_history` VALUES ('13', '4', 'GE734507263WW', '2017-05-10 14:58:58');
INSERT INTO `order_status_history` VALUES ('12', '4', 'GE734507192WW', '2017-05-10 14:59:20');
INSERT INTO `order_status_history` VALUES ('11', '4', 'GE734507201WW', '2017-05-10 14:59:36');
INSERT INTO `order_status_history` VALUES ('9', '4', 'GE734507189WW', '2017-05-10 15:00:10');
INSERT INTO `order_status_history` VALUES ('8', '4', 'EQ158596540TH', '2017-05-10 15:00:39');
INSERT INTO `order_status_history` VALUES ('12', '4', 'GE734507192WW', '2017-05-10 15:01:05');
INSERT INTO `order_status_history` VALUES ('11', '4', 'GE734507201WW', '2017-05-10 15:01:19');
INSERT INTO `order_status_history` VALUES ('5', '4', 'GE734507215WW', '2017-05-10 15:01:40');
INSERT INTO `order_status_history` VALUES ('4', '4', 'GE734507232WW', '2017-05-10 15:02:14');
INSERT INTO `order_status_history` VALUES ('3', '4', 'GE734507229WW', '2017-05-10 15:02:40');
INSERT INTO `order_status_history` VALUES ('4', '4', 'GE734507232WW', '2017-05-10 15:03:17');
INSERT INTO `order_status_history` VALUES ('2', '4', 'GrabBike', '2017-05-10 15:03:47');
INSERT INTO `order_status_history` VALUES ('21', '2', '', '2017-05-10 16:25:10');
INSERT INTO `order_status_history` VALUES ('7', '2', '', '2017-05-11 09:01:52');
INSERT INTO `order_status_history` VALUES ('23', '5', '', '2017-05-11 09:46:16');
INSERT INTO `order_status_history` VALUES ('24', '2', '', '2017-05-11 09:47:07');
INSERT INTO `order_status_history` VALUES ('25', '2', '', '2017-05-11 10:07:55');
INSERT INTO `order_status_history` VALUES ('26', '2', '', '2017-05-11 10:46:13');
INSERT INTO `order_status_history` VALUES ('27', '2', '', '2017-05-11 11:10:25');
INSERT INTO `order_status_history` VALUES ('22', '2', '', '2017-05-11 11:46:25');
INSERT INTO `order_status_history` VALUES ('28', '2', '', '2017-05-11 12:29:46');
INSERT INTO `order_status_history` VALUES ('10', '2', '', '2017-05-11 13:44:13');
INSERT INTO `order_status_history` VALUES ('10', '2', '', '2017-05-11 13:44:22');
INSERT INTO `order_status_history` VALUES ('31', '2', '', '2017-05-11 13:50:01');
INSERT INTO `order_status_history` VALUES ('31', '2', '', '2017-05-11 13:50:08');
INSERT INTO `order_status_history` VALUES ('32', '2', '', '2017-05-11 13:50:32');
INSERT INTO `order_status_history` VALUES ('33', '2', '', '2017-05-11 13:58:02');
INSERT INTO `order_status_history` VALUES ('20', '2', '', '2017-05-11 14:11:45');
INSERT INTO `order_status_history` VALUES ('35', '2', '', '2017-05-11 14:21:55');
INSERT INTO `order_status_history` VALUES ('29', '2', '', '2017-05-11 14:24:39');
INSERT INTO `order_status_history` VALUES ('10', '4', '', '2017-05-11 14:25:06');
INSERT INTO `order_status_history` VALUES ('32', '4', 'มารับสินค้าเอง', '2017-05-11 14:40:58');
INSERT INTO `order_status_history` VALUES ('36', '2', '', '2017-05-11 15:22:28');
INSERT INTO `order_status_history` VALUES ('37', '2', '', '2017-05-11 15:23:56');
INSERT INTO `order_status_history` VALUES ('38', '2', '', '2017-05-11 15:53:03');
INSERT INTO `order_status_history` VALUES ('24', '4', 'EQ158596522TH', '2017-05-11 16:11:29');
INSERT INTO `order_status_history` VALUES ('25', '4', 'EQ158596553TH', '2017-05-11 16:12:22');
INSERT INTO `order_status_history` VALUES ('39', '2', '', '2017-05-11 16:14:18');
INSERT INTO `order_status_history` VALUES ('40', '2', '', '2017-05-11 16:14:46');
INSERT INTO `order_status_history` VALUES ('42', '2', '', '2017-05-11 17:00:57');
INSERT INTO `order_status_history` VALUES ('43', '2', '', '2017-05-11 17:04:09');
INSERT INTO `order_status_history` VALUES ('41', '2', '', '2017-05-11 17:08:54');
INSERT INTO `order_status_history` VALUES ('44', '5', '', '2017-05-11 17:24:09');
INSERT INTO `order_status_history` VALUES ('46', '2', '', '2017-05-11 17:41:45');
INSERT INTO `order_status_history` VALUES ('21', '4', 'GE734507317WW', '2017-05-11 17:49:38');
INSERT INTO `order_status_history` VALUES ('7', '4', 'GE734507325WW', '2017-05-11 17:50:39');
INSERT INTO `order_status_history` VALUES ('26', '4', 'GE734507334WW', '2017-05-11 17:51:24');
INSERT INTO `order_status_history` VALUES ('36', '4', 'GE734507348WW', '2017-05-11 17:51:53');
INSERT INTO `order_status_history` VALUES ('35', '4', 'GE734507351WW', '2017-05-11 17:52:20');
INSERT INTO `order_status_history` VALUES ('22', '4', 'GE734507365WW', '2017-05-11 17:53:10');
INSERT INTO `order_status_history` VALUES ('33', '4', 'GE734507379WW', '2017-05-11 17:53:57');
INSERT INTO `order_status_history` VALUES ('27', '4', 'GE734507382WW', '2017-05-11 17:54:31');
INSERT INTO `order_status_history` VALUES ('31', '4', 'GE734507396WW', '2017-05-11 17:54:54');
INSERT INTO `order_status_history` VALUES ('39', '4', 'GE734507405WW', '2017-05-11 17:55:09');
INSERT INTO `order_status_history` VALUES ('40', '4', 'GE734507419WW', '2017-05-11 17:55:27');
INSERT INTO `order_status_history` VALUES ('42', '4', 'GE734507422WW', '2017-05-11 17:55:53');
INSERT INTO `order_status_history` VALUES ('43', '4', 'GE734507436WW', '2017-05-11 17:56:11');
INSERT INTO `order_status_history` VALUES ('46', '4', 'GE734507440WW', '2017-05-11 17:56:35');
INSERT INTO `order_status_history` VALUES ('33', '4', 'GE734507379WW', '2017-05-11 17:57:26');
INSERT INTO `order_status_history` VALUES ('22', '4', 'GE734507365WW', '2017-05-11 17:58:38');
INSERT INTO `order_status_history` VALUES ('28', '4', 'GrabBike', '2017-05-11 17:59:56');
INSERT INTO `order_status_history` VALUES ('50', '2', '', '2017-05-12 12:51:27');
INSERT INTO `order_status_history` VALUES ('49', '2', '', '2017-05-12 12:58:34');
INSERT INTO `order_status_history` VALUES ('49', '2', '', '2017-05-12 12:59:04');
INSERT INTO `order_status_history` VALUES ('48', '2', '', '2017-05-12 13:10:10');
INSERT INTO `order_status_history` VALUES ('48', '4', 'GrabBike', '2017-05-12 13:33:20');
INSERT INTO `order_status_history` VALUES ('52', '2', '', '2017-05-12 13:59:00');
INSERT INTO `order_status_history` VALUES ('53', '5', '', '2017-05-12 14:25:03');
INSERT INTO `order_status_history` VALUES ('52', '5', '', '2017-05-12 14:25:28');
INSERT INTO `order_status_history` VALUES ('54', '2', '', '2017-05-12 14:31:10');
INSERT INTO `order_status_history` VALUES ('50', '4', 'GrabBike', '2017-05-12 14:32:19');
INSERT INTO `order_status_history` VALUES ('55', '2', '', '2017-05-12 14:34:46');
INSERT INTO `order_status_history` VALUES ('55', '4', 'GrabBike', '2017-05-12 15:32:23');
INSERT INTO `order_status_history` VALUES ('41', '4', 'EQ158596584TH', '2017-05-12 15:34:00');
INSERT INTO `order_status_history` VALUES ('38', '4', 'EQ158596607TH', '2017-05-12 15:35:05');
INSERT INTO `order_status_history` VALUES ('37', '4', 'EQ158596607TH', '2017-05-12 15:35:59');
INSERT INTO `order_status_history` VALUES ('29', '4', 'EQ158596567TH', '2017-05-12 15:37:11');
INSERT INTO `order_status_history` VALUES ('20', '4', 'EQ158596598TH', '2017-05-12 15:38:34');
INSERT INTO `order_status_history` VALUES ('56', '2', '', '2017-05-12 15:43:11');
INSERT INTO `order_status_history` VALUES ('57', '2', '', '2017-05-12 15:43:30');
INSERT INTO `order_status_history` VALUES ('51', '2', '', '2017-05-12 15:44:38');
INSERT INTO `order_status_history` VALUES ('47', '2', '', '2017-05-12 16:08:36');
INSERT INTO `order_status_history` VALUES ('59', '2', '', '2017-05-12 16:16:22');
INSERT INTO `order_status_history` VALUES ('47', '4', 'นัดรับสินค้า', '2017-05-12 16:20:43');
INSERT INTO `order_status_history` VALUES ('58', '2', '', '2017-05-12 16:21:28');
INSERT INTO `order_status_history` VALUES ('60', '2', '', '2017-05-12 16:24:14');
INSERT INTO `order_status_history` VALUES ('49', '4', 'GE734507453WW', '2017-05-12 17:10:51');
INSERT INTO `order_status_history` VALUES ('54', '4', 'GE734507467WW', '2017-05-12 17:11:38');
INSERT INTO `order_status_history` VALUES ('56', '4', 'GE734507475WW', '2017-05-12 17:12:09');
INSERT INTO `order_status_history` VALUES ('57', '4', 'GE734507475WW', '2017-05-12 17:12:31');
INSERT INTO `order_status_history` VALUES ('60', '4', 'GE734507484WW', '2017-05-12 17:12:50');
INSERT INTO `order_status_history` VALUES ('58', '4', 'GE734507498WW', '2017-05-12 17:13:10');
INSERT INTO `order_status_history` VALUES ('51', '4', 'GE734507507WW', '2017-05-12 17:13:45');
INSERT INTO `order_status_history` VALUES ('59', '4', 'GE734507515WW', '2017-05-12 17:14:03');
INSERT INTO `order_status_history` VALUES ('61', '2', '', '2017-05-13 01:46:46');
INSERT INTO `order_status_history` VALUES ('62', '2', '', '2017-05-13 09:41:54');
INSERT INTO `order_status_history` VALUES ('63', '2', '', '2017-05-13 10:28:14');
INSERT INTO `order_status_history` VALUES ('64', '2', '', '2017-05-13 10:36:44');
INSERT INTO `order_status_history` VALUES ('66', '2', '', '2017-05-13 13:10:37');
INSERT INTO `order_status_history` VALUES ('65', '2', '', '2017-05-13 13:11:32');
INSERT INTO `order_status_history` VALUES ('68', '2', '', '2017-05-13 13:29:19');
INSERT INTO `order_status_history` VALUES ('67', '2', '', '2017-05-13 13:31:05');
INSERT INTO `order_status_history` VALUES ('62', '4', 'GE734507524WW', '2017-05-13 13:49:43');
INSERT INTO `order_status_history` VALUES ('64', '4', 'GE734507538WW', '2017-05-13 13:50:01');
INSERT INTO `order_status_history` VALUES ('63', '4', 'GE734507541WW', '2017-05-13 13:50:30');
INSERT INTO `order_status_history` VALUES ('68', '4', 'GE734507555WW', '2017-05-13 13:50:50');
INSERT INTO `order_status_history` VALUES ('69', '2', '', '2017-05-13 13:53:10');
INSERT INTO `order_status_history` VALUES ('70', '2', '', '2017-05-13 14:10:08');
INSERT INTO `order_status_history` VALUES ('71', '2', '', '2017-05-13 14:10:32');
INSERT INTO `order_status_history` VALUES ('74', '2', '', '2017-05-13 14:33:48');
INSERT INTO `order_status_history` VALUES ('73', '2', '', '2017-05-13 14:58:19');
INSERT INTO `order_status_history` VALUES ('72', '2', '', '2017-05-13 14:59:03');
INSERT INTO `order_status_history` VALUES ('77', '5', '', '2017-05-14 13:07:20');
INSERT INTO `order_status_history` VALUES ('77', '5', '', '2017-05-14 13:07:52');
INSERT INTO `order_status_history` VALUES ('82', '5', '', '2017-05-14 15:08:29');
INSERT INTO `order_status_history` VALUES ('82', '5', '', '2017-05-14 15:08:38');
INSERT INTO `order_status_history` VALUES ('80', '5', '', '2017-05-14 15:08:58');
INSERT INTO `order_status_history` VALUES ('81', '5', '', '2017-05-14 15:09:13');
INSERT INTO `order_status_history` VALUES ('79', '5', '', '2017-05-14 15:09:31');
INSERT INTO `order_status_history` VALUES ('83', '2', '', '2017-05-14 15:56:40');
INSERT INTO `order_status_history` VALUES ('78', '2', '', '2017-05-14 15:57:49');
INSERT INTO `order_status_history` VALUES ('76', '2', '', '2017-05-15 09:37:35');
INSERT INTO `order_status_history` VALUES ('72', '4', 'GrabBike', '2017-05-15 10:11:19');
INSERT INTO `order_status_history` VALUES ('73', '4', ' GrabBike', '2017-05-15 10:11:47');
INSERT INTO `order_status_history` VALUES ('66', '4', 'GrabBike', '2017-05-15 10:12:47');
INSERT INTO `order_status_history` VALUES ('65', '4', 'GrabBike', '2017-05-15 10:13:25');
INSERT INTO `order_status_history` VALUES ('61', '4', 'EQ158596624TH', '2017-05-15 10:14:08');
INSERT INTO `order_status_history` VALUES ('45', '2', '', '2017-05-15 11:09:49');
INSERT INTO `order_status_history` VALUES ('86', '2', '', '2017-05-15 13:23:46');
INSERT INTO `order_status_history` VALUES ('85', '2', '', '2017-05-15 13:35:53');
INSERT INTO `order_status_history` VALUES ('30', '5', '', '2017-05-15 14:07:24');
INSERT INTO `order_status_history` VALUES ('34', '5', '', '2017-05-15 14:07:47');
INSERT INTO `order_status_history` VALUES ('83', '4', '', '2017-05-15 14:17:53');
INSERT INTO `order_status_history` VALUES ('86', '4', '', '2017-05-15 14:21:27');
INSERT INTO `order_status_history` VALUES ('88', '2', '', '2017-05-15 14:29:44');
INSERT INTO `order_status_history` VALUES ('88', '2', '', '2017-05-15 14:30:04');
INSERT INTO `order_status_history` VALUES ('75', '2', '', '2017-05-15 14:31:30');
INSERT INTO `order_status_history` VALUES ('75', '2', '', '2017-05-15 14:32:23');
INSERT INTO `order_status_history` VALUES ('90', '2', '', '2017-05-15 14:32:31');
INSERT INTO `order_status_history` VALUES ('91', '2', '', '2017-05-15 14:35:53');
INSERT INTO `order_status_history` VALUES ('92', '2', '', '2017-05-15 14:42:35');
INSERT INTO `order_status_history` VALUES ('89', '2', '', '2017-05-15 14:49:20');
INSERT INTO `order_status_history` VALUES ('87', '2', '', '2017-05-15 15:01:58');
INSERT INTO `order_status_history` VALUES ('93', '5', '', '2017-05-15 15:08:42');
INSERT INTO `order_status_history` VALUES ('96', '2', '', '2017-05-15 15:33:50');
INSERT INTO `order_status_history` VALUES ('97', '2', '', '2017-05-15 15:43:28');
INSERT INTO `order_status_history` VALUES ('98', '2', '', '2017-05-15 16:03:27');
INSERT INTO `order_status_history` VALUES ('98', '2', '', '2017-05-15 16:03:45');
INSERT INTO `order_status_history` VALUES ('98', '1', '', '2017-05-15 16:03:48');
INSERT INTO `order_status_history` VALUES ('101', '2', '', '2017-05-15 16:03:54');
INSERT INTO `order_status_history` VALUES ('99', '2', '', '2017-05-15 16:08:06');
INSERT INTO `order_status_history` VALUES ('100', '2', '', '2017-05-15 16:08:53');
INSERT INTO `order_status_history` VALUES ('102', '2', '', '2017-05-15 16:09:05');
INSERT INTO `order_status_history` VALUES ('98', '2', '', '2017-05-15 16:09:21');
INSERT INTO `order_status_history` VALUES ('98', '2', '', '2017-05-15 16:09:34');
INSERT INTO `order_status_history` VALUES ('103', '2', '', '2017-05-15 16:10:06');
INSERT INTO `order_status_history` VALUES ('94', '2', '', '2017-05-15 16:16:54');
INSERT INTO `order_status_history` VALUES ('104', '2', '', '2017-05-15 16:36:41');
INSERT INTO `order_status_history` VALUES ('87', '5', '', '2017-05-15 16:37:34');
INSERT INTO `order_status_history` VALUES ('105', '2', '', '2017-05-15 16:55:14');
INSERT INTO `order_status_history` VALUES ('106', '2', '', '2017-05-15 17:30:33');
INSERT INTO `order_status_history` VALUES ('106', '4', 'นัดรับสินค้า', '2017-05-15 17:44:21');
INSERT INTO `order_status_history` VALUES ('76', '4', 'GE734507569WW', '2017-05-15 18:14:30');
INSERT INTO `order_status_history` VALUES ('75', '4', 'GE734507572WW', '2017-05-15 18:15:24');
INSERT INTO `order_status_history` VALUES ('67', '4', 'GE734507586WW', '2017-05-15 18:16:08');
INSERT INTO `order_status_history` VALUES ('69', '4', 'GE734507590WW', '2017-05-15 18:16:38');
INSERT INTO `order_status_history` VALUES ('70', '4', 'GE734507609WW', '2017-05-15 18:16:59');
INSERT INTO `order_status_history` VALUES ('45', '4', 'GE734507626WW', '2017-05-15 18:17:40');
INSERT INTO `order_status_history` VALUES ('108', '2', '', '2017-05-15 18:17:42');
INSERT INTO `order_status_history` VALUES ('96', '4', 'GE734507630WW', '2017-05-15 18:18:12');
INSERT INTO `order_status_history` VALUES ('89', '4', 'GE734507643WW', '2017-05-15 18:18:38');
INSERT INTO `order_status_history` VALUES ('74', '4', 'GE734507657WW', '2017-05-15 18:18:58');
INSERT INTO `order_status_history` VALUES ('85', '4', 'GE734507665WW', '2017-05-15 18:19:22');
INSERT INTO `order_status_history` VALUES ('91', '4', 'GE734507674WW', '2017-05-15 18:19:40');
INSERT INTO `order_status_history` VALUES ('90', '4', 'GE734507688WW', '2017-05-15 18:20:01');
INSERT INTO `order_status_history` VALUES ('78', '4', 'GE734507691WW', '2017-05-15 18:20:19');
INSERT INTO `order_status_history` VALUES ('92', '4', 'GE734507705WW', '2017-05-15 18:20:42');
INSERT INTO `order_status_history` VALUES ('97', '4', 'GE734507714WW', '2017-05-15 18:21:03');
INSERT INTO `order_status_history` VALUES ('99', '4', 'GE734507728WW', '2017-05-15 18:21:21');
INSERT INTO `order_status_history` VALUES ('94', '4', 'GE734507731WW', '2017-05-15 18:21:44');
INSERT INTO `order_status_history` VALUES ('102', '4', 'GE734507745WW', '2017-05-15 18:22:11');
INSERT INTO `order_status_history` VALUES ('104', '4', 'GE734507759WW', '2017-05-15 18:22:40');
INSERT INTO `order_status_history` VALUES ('101', '4', 'GE734507762WW', '2017-05-15 18:23:05');
INSERT INTO `order_status_history` VALUES ('105', '4', 'GE734507776WW', '2017-05-15 18:23:39');
INSERT INTO `order_status_history` VALUES ('103', '4', 'GE734507745WW', '2017-05-15 18:25:36');
INSERT INTO `order_status_history` VALUES ('100', '4', 'GE734507728WW', '2017-05-15 18:26:06');
INSERT INTO `order_status_history` VALUES ('98', '4', '', '2017-05-15 18:27:04');
INSERT INTO `order_status_history` VALUES ('88', '4', 'GE734507572WW', '2017-05-15 18:27:34');
INSERT INTO `order_status_history` VALUES ('71', '4', 'GE734507612WW', '2017-05-15 18:29:55');
INSERT INTO `order_status_history` VALUES ('110', '2', '', '2017-05-16 10:25:52');
INSERT INTO `order_status_history` VALUES ('107', '2', '', '2017-05-16 10:42:42');
INSERT INTO `order_status_history` VALUES ('109', '2', '', '2017-05-16 10:46:02');
INSERT INTO `order_status_history` VALUES ('111', '5', '', '2017-05-16 10:59:49');
INSERT INTO `order_status_history` VALUES ('112', '2', '', '2017-05-16 11:40:25');
INSERT INTO `order_status_history` VALUES ('113', '2', '', '2017-05-16 11:51:30');
INSERT INTO `order_status_history` VALUES ('114', '2', '', '2017-05-16 12:04:13');
INSERT INTO `order_status_history` VALUES ('115', '2', '', '2017-05-16 12:10:38');
INSERT INTO `order_status_history` VALUES ('108', '4', '', '2017-05-16 12:38:43');
INSERT INTO `order_status_history` VALUES ('117', '2', '', '2017-05-16 13:01:00');
INSERT INTO `order_status_history` VALUES ('107', '4', 'GrabBike', '2017-05-16 13:19:30');
INSERT INTO `order_status_history` VALUES ('118', '2', '', '2017-05-16 13:35:41');
INSERT INTO `order_status_history` VALUES ('118', '2', '', '2017-05-16 13:35:46');
INSERT INTO `order_status_history` VALUES ('115', '4', 'GrabBike', '2017-05-16 14:13:40');
INSERT INTO `order_status_history` VALUES ('120', '2', '', '2017-05-16 14:14:30');
INSERT INTO `order_status_history` VALUES ('95', '2', '', '2017-05-16 14:15:15');
INSERT INTO `order_status_history` VALUES ('119', '2', '', '2017-05-16 14:36:52');
INSERT INTO `order_status_history` VALUES ('122', '5', '', '2017-05-16 15:24:27');
INSERT INTO `order_status_history` VALUES ('122', '5', '', '2017-05-16 15:24:30');
INSERT INTO `order_status_history` VALUES ('109', '4', 'EQ158596638TH', '2017-05-16 15:31:46');
INSERT INTO `order_status_history` VALUES ('114', '4', 'EQ158596641TH', '2017-05-16 15:33:14');
INSERT INTO `order_status_history` VALUES ('112', '4', 'EQ158596655TH', '2017-05-16 15:34:00');
INSERT INTO `order_status_history` VALUES ('117', '4', 'GrabBike', '2017-05-16 15:36:55');
INSERT INTO `order_status_history` VALUES ('128', '2', '', '2017-05-16 15:37:18');
INSERT INTO `order_status_history` VALUES ('129', '2', '', '2017-05-16 15:47:36');
INSERT INTO `order_status_history` VALUES ('124', '2', '', '2017-05-16 16:10:52');
INSERT INTO `order_status_history` VALUES ('120', '4', 'GrabBike', '2017-05-16 16:40:38');
INSERT INTO `order_status_history` VALUES ('131', '2', '', '2017-05-16 17:14:05');
INSERT INTO `order_status_history` VALUES ('131', '2', '', '2017-05-16 17:14:11');
INSERT INTO `order_status_history` VALUES ('118', '4', 'GE734507780WW', '2017-05-16 17:35:40');
INSERT INTO `order_status_history` VALUES ('113', '4', 'GE734507793WW', '2017-05-16 17:37:19');
INSERT INTO `order_status_history` VALUES ('110', '4', 'GE734507802WW', '2017-05-16 17:37:46');
INSERT INTO `order_status_history` VALUES ('128', '4', 'GE734507816WW', '2017-05-16 17:38:17');
INSERT INTO `order_status_history` VALUES ('129', '4', 'GE734507820WW', '2017-05-16 17:38:35');
INSERT INTO `order_status_history` VALUES ('124', '4', 'GE734507833WW', '2017-05-16 17:38:58');
INSERT INTO `order_status_history` VALUES ('131', '4', 'GE734507847WW', '2017-05-16 17:39:29');
INSERT INTO `order_status_history` VALUES ('121', '2', '', '2017-05-16 18:07:55');
INSERT INTO `order_status_history` VALUES ('127', '2', '', '2017-05-16 18:08:13');
INSERT INTO `order_status_history` VALUES ('132', '2', '', '2017-05-16 18:52:15');
INSERT INTO `order_status_history` VALUES ('134', '2', '', '2017-05-17 09:42:24');
INSERT INTO `order_status_history` VALUES ('135', '2', '', '2017-05-17 09:49:46');
INSERT INTO `order_status_history` VALUES ('116', '2', '', '2017-05-17 09:55:12');
INSERT INTO `order_status_history` VALUES ('133', '2', '', '2017-05-17 11:57:06');
INSERT INTO `order_status_history` VALUES ('123', '2', '', '2017-05-17 11:57:39');
INSERT INTO `order_status_history` VALUES ('139', '2', '', '2017-05-17 13:41:27');
INSERT INTO `order_status_history` VALUES ('138', '2', '', '2017-05-17 13:41:55');
INSERT INTO `order_status_history` VALUES ('140', '2', '', '2017-05-17 13:51:27');
INSERT INTO `order_status_history` VALUES ('136', '2', '', '2017-05-17 14:16:28');
INSERT INTO `order_status_history` VALUES ('121', '4', 'นัดรับสินค้า', '2017-05-17 14:33:37');
INSERT INTO `order_status_history` VALUES ('137', '2', '', '2017-05-17 14:42:35');
INSERT INTO `order_status_history` VALUES ('142', '2', '', '2017-05-17 15:09:11');
INSERT INTO `order_status_history` VALUES ('141', '5', '', '2017-05-17 15:15:35');
INSERT INTO `order_status_history` VALUES ('143', '5', '', '2017-05-17 15:15:54');
INSERT INTO `order_status_history` VALUES ('130', '2', '', '2017-05-17 15:18:44');
INSERT INTO `order_status_history` VALUES ('144', '2', '', '2017-05-17 15:29:20');
INSERT INTO `order_status_history` VALUES ('145', '2', '', '2017-05-17 15:44:01');
INSERT INTO `order_status_history` VALUES ('140', '4', ' GrabBike', '2017-05-17 15:54:06');
INSERT INTO `order_status_history` VALUES ('147', '2', '', '2017-05-17 16:18:41');
INSERT INTO `order_status_history` VALUES ('149', '2', '', '2017-05-17 17:36:01');
INSERT INTO `order_status_history` VALUES ('130', '4', 'GE734507855WW', '2017-05-17 17:38:37');
INSERT INTO `order_status_history` VALUES ('139', '4', 'GE734507864WW', '2017-05-17 17:39:07');
INSERT INTO `order_status_history` VALUES ('132', '4', 'GE734507878WW', '2017-05-17 17:39:32');
INSERT INTO `order_status_history` VALUES ('133', '4', 'GE734507881WW', '2017-05-17 17:39:59');
INSERT INTO `order_status_history` VALUES ('145', '4', 'GE734507895WW', '2017-05-17 17:40:35');
INSERT INTO `order_status_history` VALUES ('136', '4', 'GE734507904WW', '2017-05-17 17:41:00');
INSERT INTO `order_status_history` VALUES ('142', '4', 'GE734507918WW', '2017-05-17 17:41:23');
INSERT INTO `order_status_history` VALUES ('137', '4', 'GE734507921WW', '2017-05-17 17:41:46');
INSERT INTO `order_status_history` VALUES ('116', '4', 'GE734507935WW', '2017-05-17 17:42:01');
INSERT INTO `order_status_history` VALUES ('123', '4', 'GE734507949WW', '2017-05-17 17:42:20');
INSERT INTO `order_status_history` VALUES ('138', '4', 'GE734507952WW', '2017-05-17 17:42:40');
INSERT INTO `order_status_history` VALUES ('144', '4', 'GE734507966WW', '2017-05-17 17:43:01');
INSERT INTO `order_status_history` VALUES ('147', '4', 'GE734507966WW', '2017-05-17 17:43:26');
INSERT INTO `order_status_history` VALUES ('149', '4', 'GE734507970WW', '2017-05-17 17:43:48');
INSERT INTO `order_status_history` VALUES ('95', '4', 'EQ158596730TH', '2017-05-18 13:20:56');
INSERT INTO `order_status_history` VALUES ('119', '4', 'EQ158596690TH', '2017-05-18 13:21:57');
INSERT INTO `order_status_history` VALUES ('154', '2', '', '2017-05-18 14:38:50');
INSERT INTO `order_status_history` VALUES ('84', '5', '', '2017-05-18 14:45:25');
INSERT INTO `order_status_history` VALUES ('146', '5', '', '2017-05-18 14:46:08');
INSERT INTO `order_status_history` VALUES ('156', '2', '', '2017-05-18 15:13:22');
INSERT INTO `order_status_history` VALUES ('134', '4', 'มารับสินค้าเอง', '2017-05-18 15:28:34');
INSERT INTO `order_status_history` VALUES ('153', '2', '', '2017-05-18 16:22:59');
INSERT INTO `order_status_history` VALUES ('158', '2', '', '2017-05-18 16:32:39');
INSERT INTO `order_status_history` VALUES ('159', '2', '', '2017-05-18 16:41:39');
INSERT INTO `order_status_history` VALUES ('152', '5', '', '2017-05-18 16:50:17');
INSERT INTO `order_status_history` VALUES ('152', '5', '', '2017-05-18 16:50:19');
INSERT INTO `order_status_history` VALUES ('155', '5', '', '2017-05-18 16:50:47');
INSERT INTO `order_status_history` VALUES ('150', '2', '', '2017-05-18 17:12:26');
INSERT INTO `order_status_history` VALUES ('150', '2', '', '2017-05-18 17:12:57');
INSERT INTO `order_status_history` VALUES ('156', '4', 'GE734507983WW', '2017-05-18 17:44:20');
INSERT INTO `order_status_history` VALUES ('154', '4', 'GE734507997WW', '2017-05-18 17:44:37');
INSERT INTO `order_status_history` VALUES ('153', '4', 'GE734508003WW', '2017-05-18 17:44:53');
INSERT INTO `order_status_history` VALUES ('158', '4', 'GE734508017WW', '2017-05-18 17:45:11');
INSERT INTO `order_status_history` VALUES ('159', '4', 'GE734508025WW', '2017-05-18 17:45:27');
INSERT INTO `order_status_history` VALUES ('150', '4', 'GE734508034WW', '2017-05-18 17:45:41');
INSERT INTO `order_status_history` VALUES ('161', '2', '', '2017-05-18 21:28:13');
INSERT INTO `order_status_history` VALUES ('162', '2', '', '2017-05-19 00:43:14');
INSERT INTO `order_status_history` VALUES ('165', '2', '', '2017-05-19 11:46:21');
INSERT INTO `order_status_history` VALUES ('166', '2', '', '2017-05-19 11:55:04');
INSERT INTO `order_status_history` VALUES ('171', '2', '', '2017-05-19 12:39:16');
INSERT INTO `order_status_history` VALUES ('171', '2', '', '2017-05-19 12:39:19');
INSERT INTO `order_status_history` VALUES ('164', '2', '', '2017-05-19 12:44:59');
INSERT INTO `order_status_history` VALUES ('167', '1', '', '2017-05-19 12:51:20');
INSERT INTO `order_status_history` VALUES ('167', '2', '', '2017-05-19 12:51:50');
INSERT INTO `order_status_history` VALUES ('168', '2', '', '2017-05-19 12:53:17');
INSERT INTO `order_status_history` VALUES ('170', '2', '', '2017-05-19 12:55:14');
INSERT INTO `order_status_history` VALUES ('172', '2', '', '2017-05-19 13:01:45');
INSERT INTO `order_status_history` VALUES ('173', '2', '', '2017-05-19 13:02:46');
INSERT INTO `order_status_history` VALUES ('160', '2', '', '2017-05-19 13:04:29');
INSERT INTO `order_status_history` VALUES ('174', '2', '', '2017-05-19 13:17:21');
INSERT INTO `order_status_history` VALUES ('176', '2', '', '2017-05-19 13:42:38');
INSERT INTO `order_status_history` VALUES ('175', '2', '', '2017-05-19 13:45:54');
INSERT INTO `order_status_history` VALUES ('178', '2', '', '2017-05-19 14:53:29');
INSERT INTO `order_status_history` VALUES ('177', '2', '', '2017-05-19 15:08:20');
INSERT INTO `order_status_history` VALUES ('177', '2', '', '2017-05-19 15:08:34');
INSERT INTO `order_status_history` VALUES ('176', '4', ' GrabBike', '2017-05-19 15:30:29');
INSERT INTO `order_status_history` VALUES ('125', '2', '', '2017-05-19 15:39:54');
INSERT INTO `order_status_history` VALUES ('179', '2', '', '2017-05-19 15:57:05');
INSERT INTO `order_status_history` VALUES ('179', '2', '', '2017-05-19 16:06:05');
INSERT INTO `order_status_history` VALUES ('180', '2', '', '2017-05-19 16:11:09');
INSERT INTO `order_status_history` VALUES ('172', '4', 'EQ158596774TH', '2017-05-19 17:04:34');
INSERT INTO `order_status_history` VALUES ('170', '4', 'EQ158596774TH', '2017-05-19 17:04:56');
INSERT INTO `order_status_history` VALUES ('168', '4', 'EQ158596774TH', '2017-05-19 17:05:15');
INSERT INTO `order_status_history` VALUES ('177', '4', 'EQ158596774TH', '2017-05-19 17:05:31');
INSERT INTO `order_status_history` VALUES ('167', '4', 'EQ158596774TH', '2017-05-19 17:05:55');
INSERT INTO `order_status_history` VALUES ('164', '4', 'EQ158596774TH', '2017-05-19 17:06:17');
INSERT INTO `order_status_history` VALUES ('171', '4', 'EQ158596669TH', '2017-05-19 17:08:12');
INSERT INTO `order_status_history` VALUES ('171', '4', 'EQ158596669TH', '2017-05-19 17:08:29');
INSERT INTO `order_status_history` VALUES ('126', '5', '', '2017-05-19 17:14:00');
INSERT INTO `order_status_history` VALUES ('169', '2', '', '2017-05-19 17:15:01');
INSERT INTO `order_status_history` VALUES ('148', '5', '', '2017-05-19 17:23:01');
INSERT INTO `order_status_history` VALUES ('180', '4', 'GrabBike', '2017-05-19 17:33:49');
INSERT INTO `order_status_history` VALUES ('173', '4', 'GE734508048WW', '2017-05-19 17:46:49');
INSERT INTO `order_status_history` VALUES ('125', '4', 'GE734508051WW', '2017-05-19 17:47:09');
INSERT INTO `order_status_history` VALUES ('178', '4', 'GE734508065WW', '2017-05-19 17:47:27');
INSERT INTO `order_status_history` VALUES ('165', '4', 'GE734508079WW', '2017-05-19 17:47:49');
INSERT INTO `order_status_history` VALUES ('161', '4', 'GE734508082WW', '2017-05-19 17:48:07');
INSERT INTO `order_status_history` VALUES ('160', '4', 'GE734508096WW', '2017-05-19 17:48:28');
INSERT INTO `order_status_history` VALUES ('166', '4', 'GE734508105WW', '2017-05-19 17:48:44');
INSERT INTO `order_status_history` VALUES ('151', '5', '', '2017-05-19 17:49:07');
INSERT INTO `order_status_history` VALUES ('177', '4', 'GE734508119WW', '2017-05-19 17:50:31');
INSERT INTO `order_status_history` VALUES ('174', '4', 'GE734508122WW', '2017-05-19 17:51:00');
INSERT INTO `order_status_history` VALUES ('179', '4', 'GE734508122WW', '2017-05-19 17:51:22');
INSERT INTO `order_status_history` VALUES ('169', '4', 'GE734508136WW', '2017-05-19 17:51:44');
INSERT INTO `order_status_history` VALUES ('182', '2', '', '2017-05-19 17:58:46');
INSERT INTO `order_status_history` VALUES ('183', '2', '', '2017-05-19 17:59:01');
INSERT INTO `order_status_history` VALUES ('179', '4', 'GE734508122WW', '2017-05-19 18:16:14');
INSERT INTO `order_status_history` VALUES ('163', '2', '', '2017-05-20 09:07:36');
INSERT INTO `order_status_history` VALUES ('187', '2', '', '2017-05-20 11:52:20');
INSERT INTO `order_status_history` VALUES ('186', '2', '', '2017-05-20 11:53:04');
INSERT INTO `order_status_history` VALUES ('188', '2', '', '2017-05-20 12:18:44');
INSERT INTO `order_status_history` VALUES ('189', '2', '', '2017-05-20 13:41:23');
INSERT INTO `order_status_history` VALUES ('188', '4', 'GrabBike', '2017-05-20 13:59:24');
INSERT INTO `order_status_history` VALUES ('187', '4', 'GrabBike', '2017-05-20 13:59:42');
INSERT INTO `order_status_history` VALUES ('193', '2', '', '2017-05-20 14:53:07');
INSERT INTO `order_status_history` VALUES ('183', '4', 'EQ158596743TH', '2017-05-20 15:37:17');
INSERT INTO `order_status_history` VALUES ('182', '4', 'EQ158596743TH', '2017-05-20 15:37:35');
INSERT INTO `order_status_history` VALUES ('175', '4', 'EQ158596788TH', '2017-05-20 15:38:16');
INSERT INTO `order_status_history` VALUES ('189', '4', 'GE734508140WW', '2017-05-20 15:47:14');
INSERT INTO `order_status_history` VALUES ('163', '4', 'GE734508153WW', '2017-05-20 15:47:37');
INSERT INTO `order_status_history` VALUES ('193', '4', 'GE734508175WW', '2017-05-20 15:47:56');
INSERT INTO `order_status_history` VALUES ('186', '6', '', '2017-05-20 16:00:58');
INSERT INTO `order_status_history` VALUES ('192', '2', '', '2017-05-20 16:11:37');
INSERT INTO `order_status_history` VALUES ('194', '2', '', '2017-05-20 16:14:13');
INSERT INTO `order_status_history` VALUES ('194', '4', 'GE734508167WW', '2017-05-20 16:15:00');
INSERT INTO `order_status_history` VALUES ('185', '2', '', '2017-05-20 16:46:15');
INSERT INTO `order_status_history` VALUES ('195', '2', '', '2017-05-20 18:19:37');
INSERT INTO `order_status_history` VALUES ('195', '2', '', '2017-05-20 18:20:54');
INSERT INTO `order_status_history` VALUES ('191', '2', '', '2017-05-22 09:23:07');
INSERT INTO `order_status_history` VALUES ('181', '2', '', '2017-05-22 09:25:29');
INSERT INTO `order_status_history` VALUES ('162', '6', '', '2017-05-22 09:26:21');
INSERT INTO `order_status_history` VALUES ('157', '5', '', '2017-05-22 09:27:10');
INSERT INTO `order_status_history` VALUES ('199', '2', '', '2017-05-22 10:43:41');
INSERT INTO `order_status_history` VALUES ('200', '5', '', '2017-05-22 11:18:38');
INSERT INTO `order_status_history` VALUES ('191', '4', 'GrabBike', '2017-05-22 11:20:30');
INSERT INTO `order_status_history` VALUES ('201', '2', '', '2017-05-22 11:22:11');
INSERT INTO `order_status_history` VALUES ('202', '2', '', '2017-05-22 11:22:54');
INSERT INTO `order_status_history` VALUES ('201', '4', 'นัดรับสินค้า', '2017-05-22 11:30:08');
INSERT INTO `order_status_history` VALUES ('198', '2', '', '2017-05-22 11:40:05');
INSERT INTO `order_status_history` VALUES ('190', '2', '', '2017-05-22 11:53:08');
INSERT INTO `order_status_history` VALUES ('205', '2', '', '2017-05-22 11:54:35');
INSERT INTO `order_status_history` VALUES ('207', '2', '', '2017-05-22 12:23:13');
INSERT INTO `order_status_history` VALUES ('206', '2', '', '2017-05-22 12:25:12');
INSERT INTO `order_status_history` VALUES ('197', '2', '', '2017-05-22 12:41:20');
INSERT INTO `order_status_history` VALUES ('204', '2', '', '2017-05-22 12:45:00');
INSERT INTO `order_status_history` VALUES ('209', '2', '', '2017-05-22 12:48:18');
INSERT INTO `order_status_history` VALUES ('211', '2', '', '2017-05-22 12:50:42');
INSERT INTO `order_status_history` VALUES ('203', '5', '', '2017-05-22 12:52:48');
INSERT INTO `order_status_history` VALUES ('210', '2', '', '2017-05-22 13:23:11');
INSERT INTO `order_status_history` VALUES ('212', '2', '', '2017-05-22 13:43:28');
INSERT INTO `order_status_history` VALUES ('213', '2', '', '2017-05-22 13:45:12');
INSERT INTO `order_status_history` VALUES ('215', '2', '', '2017-05-22 14:09:14');
INSERT INTO `order_status_history` VALUES ('208', '2', '', '2017-05-22 14:45:02');
INSERT INTO `order_status_history` VALUES ('196', '5', '', '2017-05-22 14:54:57');
INSERT INTO `order_status_history` VALUES ('219', '2', '', '2017-05-22 15:03:54');
INSERT INTO `order_status_history` VALUES ('218', '2', '', '2017-05-22 15:04:26');
INSERT INTO `order_status_history` VALUES ('220', '2', '', '2017-05-22 15:07:53');
INSERT INTO `order_status_history` VALUES ('214', '2', '', '2017-05-22 15:31:35');
INSERT INTO `order_status_history` VALUES ('223', '2', '', '2017-05-22 15:36:40');
INSERT INTO `order_status_history` VALUES ('221', '2', '', '2017-05-22 15:37:40');
INSERT INTO `order_status_history` VALUES ('222', '2', '', '2017-05-22 15:46:12');
INSERT INTO `order_status_history` VALUES ('224', '2', '', '2017-05-22 16:13:48');
INSERT INTO `order_status_history` VALUES ('225', '2', '', '2017-05-22 16:50:07');
INSERT INTO `order_status_history` VALUES ('185', '4', 'GE734508184WW', '2017-05-22 17:49:57');
INSERT INTO `order_status_history` VALUES ('190', '4', 'GE734508198WW', '2017-05-22 17:50:28');
INSERT INTO `order_status_history` VALUES ('197', '4', 'GE734508207WW', '2017-05-22 17:51:10');
INSERT INTO `order_status_history` VALUES ('214', '4', 'GE734508215WW', '2017-05-22 17:51:32');
INSERT INTO `order_status_history` VALUES ('202', '4', 'GE734508224WW', '2017-05-22 17:51:59');
INSERT INTO `order_status_history` VALUES ('212', '4', 'GE734508238WW', '2017-05-22 17:52:26');
INSERT INTO `order_status_history` VALUES ('215', '4', 'GE734508241WW', '2017-05-22 17:52:53');
INSERT INTO `order_status_history` VALUES ('218', '4', 'GE734508255WW', '2017-05-22 17:53:15');
INSERT INTO `order_status_history` VALUES ('210', '4', 'GE734508269WW', '2017-05-22 17:53:35');
INSERT INTO `order_status_history` VALUES ('206', '4', 'GE734508272WW', '2017-05-22 17:53:59');
INSERT INTO `order_status_history` VALUES ('219', '4', 'GE734508286WW', '2017-05-22 17:54:22');
INSERT INTO `order_status_history` VALUES ('207', '4', 'GE734508290WW', '2017-05-22 17:54:43');
INSERT INTO `order_status_history` VALUES ('204', '4', 'GE734508309WW', '2017-05-22 17:55:06');
INSERT INTO `order_status_history` VALUES ('192', '4', 'GE734508312WW', '2017-05-22 17:55:31');
INSERT INTO `order_status_history` VALUES ('224', '4', 'GE734508326WW', '2017-05-22 17:55:48');
INSERT INTO `order_status_history` VALUES ('209', '4', 'GE734508330WW', '2017-05-22 17:56:10');
INSERT INTO `order_status_history` VALUES ('223', '4', 'GE734508343WW', '2017-05-22 17:56:30');
INSERT INTO `order_status_history` VALUES ('222', '4', 'GE734508357WW', '2017-05-22 17:56:45');
INSERT INTO `order_status_history` VALUES ('208', '4', 'GE734508365WW', '2017-05-22 17:57:03');
INSERT INTO `order_status_history` VALUES ('225', '4', 'GE734508374WW', '2017-05-22 17:57:17');
INSERT INTO `order_status_history` VALUES ('221', '4', 'GE734508388WW', '2017-05-22 17:57:42');
INSERT INTO `order_status_history` VALUES ('198', '4', 'GE734508391WW', '2017-05-22 17:58:22');
INSERT INTO `order_status_history` VALUES ('199', '4', 'EQ158596712TH', '2017-05-22 18:00:31');
INSERT INTO `order_status_history` VALUES ('181', '4', 'EQ158596686TH', '2017-05-22 18:02:41');
INSERT INTO `order_status_history` VALUES ('195', '4', 'EQ158596672TH', '2017-05-22 18:03:44');
INSERT INTO `order_status_history` VALUES ('213', '4', ' GrabBike', '2017-05-22 18:04:20');
INSERT INTO `order_status_history` VALUES ('211', '4', ' GrabBike', '2017-05-22 18:04:50');
INSERT INTO `order_status_history` VALUES ('184', '2', '', '2017-05-22 18:53:07');
INSERT INTO `order_status_history` VALUES ('217', '2', '', '2017-05-23 09:50:02');
INSERT INTO `order_status_history` VALUES ('205', '4', '', '2017-05-23 09:54:51');
INSERT INTO `order_status_history` VALUES ('217', '4', 'นัดรับสินค้า', '2017-05-23 10:32:44');
INSERT INTO `order_status_history` VALUES ('230', '1', '', '2017-05-23 10:48:32');
INSERT INTO `order_status_history` VALUES ('230', '2', '', '2017-05-23 10:48:43');
INSERT INTO `order_status_history` VALUES ('229', '2', '', '2017-05-23 11:11:55');
INSERT INTO `order_status_history` VALUES ('227', '2', '', '2017-05-23 12:03:57');
INSERT INTO `order_status_history` VALUES ('226', '2', '', '2017-05-23 12:10:01');
INSERT INTO `order_status_history` VALUES ('234', '2', '', '2017-05-23 13:33:48');
INSERT INTO `order_status_history` VALUES ('233', '2', '', '2017-05-23 13:34:40');
INSERT INTO `order_status_history` VALUES ('235', '2', '', '2017-05-23 14:40:03');
INSERT INTO `order_status_history` VALUES ('236', '2', '', '2017-05-23 14:52:05');
INSERT INTO `order_status_history` VALUES ('227', '4', 'EQ158596726TH', '2017-05-23 14:56:53');
INSERT INTO `order_status_history` VALUES ('230', '4', 'EQ158596757TH', '2017-05-23 14:57:56');
INSERT INTO `order_status_history` VALUES ('220', '4', 'EQ158596765TH', '2017-05-23 14:58:44');
INSERT INTO `order_status_history` VALUES ('229', '3', '', '2017-05-23 14:58:49');
INSERT INTO `order_status_history` VALUES ('229', '4', '', '2017-05-23 15:06:33');
INSERT INTO `order_status_history` VALUES ('238', '2', '', '2017-05-23 15:19:20');
INSERT INTO `order_status_history` VALUES ('239', '2', '', '2017-05-23 16:54:44');
INSERT INTO `order_status_history` VALUES ('233', '4', 'GE734508405WW', '2017-05-23 17:47:11');
INSERT INTO `order_status_history` VALUES ('184', '4', 'GE734508414WW', '2017-05-23 17:47:30');
INSERT INTO `order_status_history` VALUES ('234', '4', 'GE734508428WW', '2017-05-23 17:47:52');
INSERT INTO `order_status_history` VALUES ('226', '4', 'GE734508431WW', '2017-05-23 17:48:13');
INSERT INTO `order_status_history` VALUES ('238', '4', 'GE734508445WW', '2017-05-23 17:48:30');
INSERT INTO `order_status_history` VALUES ('236', '4', 'GE734508459WW', '2017-05-23 17:48:50');
INSERT INTO `order_status_history` VALUES ('235', '4', 'GE734508462WW', '2017-05-23 17:49:08');
INSERT INTO `order_status_history` VALUES ('229', '4', 'GE734508476WW', '2017-05-23 17:50:23');
INSERT INTO `order_status_history` VALUES ('240', '2', '', '2017-05-23 18:13:17');
INSERT INTO `order_status_history` VALUES ('243', '2', '', '2017-05-24 10:04:24');
INSERT INTO `order_status_history` VALUES ('245', '2', '', '2017-05-24 10:52:53');
INSERT INTO `order_status_history` VALUES ('246', '2', '', '2017-05-24 11:31:29');
INSERT INTO `order_status_history` VALUES ('247', '2', '', '2017-05-24 12:10:25');
INSERT INTO `order_status_history` VALUES ('248', '2', '', '2017-05-24 13:01:02');
INSERT INTO `order_status_history` VALUES ('250', '2', '', '2017-05-24 13:01:18');
INSERT INTO `order_status_history` VALUES ('249', '2', '', '2017-05-24 13:24:15');
INSERT INTO `order_status_history` VALUES ('232', '2', '', '2017-05-24 13:51:49');
INSERT INTO `order_status_history` VALUES ('254', '2', '', '2017-05-24 14:34:16');
INSERT INTO `order_status_history` VALUES ('253', '2', '', '2017-05-24 14:34:58');
INSERT INTO `order_status_history` VALUES ('252', '2', '', '2017-05-24 14:35:54');
INSERT INTO `order_status_history` VALUES ('251', '5', '', '2017-05-24 14:36:31');
INSERT INTO `order_status_history` VALUES ('255', '5', '', '2017-05-24 14:49:13');
INSERT INTO `order_status_history` VALUES ('256', '2', '', '2017-05-24 14:50:56');
INSERT INTO `order_status_history` VALUES ('241', '2', '', '2017-05-24 16:08:36');
INSERT INTO `order_status_history` VALUES ('247', '4', 'GrabBike', '2017-05-24 17:03:17');
INSERT INTO `order_status_history` VALUES ('241', '4', ' นัดรับสินค้า', '2017-05-24 17:03:34');
INSERT INTO `order_status_history` VALUES ('246', '4', 'GrabBike', '2017-05-24 17:04:37');
INSERT INTO `order_status_history` VALUES ('240', '4', 'EQ158596828TH', '2017-05-24 17:05:11');
INSERT INTO `order_status_history` VALUES ('252', '4', 'GE734508480WW', '2017-05-24 17:41:44');
INSERT INTO `order_status_history` VALUES ('253', '4', 'GE734508493WW', '2017-05-24 17:42:23');
INSERT INTO `order_status_history` VALUES ('245', '4', 'GE734508502WW', '2017-05-24 17:42:45');
INSERT INTO `order_status_history` VALUES ('254', '4', 'GE734508516WW', '2017-05-24 17:43:24');
INSERT INTO `order_status_history` VALUES ('232', '4', 'GE734508520WW', '2017-05-24 17:43:42');
INSERT INTO `order_status_history` VALUES ('243', '4', 'GE734508533WW', '2017-05-24 17:44:14');
INSERT INTO `order_status_history` VALUES ('248', '4', 'GE734508547WW', '2017-05-24 17:44:35');
INSERT INTO `order_status_history` VALUES ('250', '4', 'GE734508555WW', '2017-05-24 17:44:57');
INSERT INTO `order_status_history` VALUES ('249', '4', 'GE734508564WW', '2017-05-24 17:45:27');
INSERT INTO `order_status_history` VALUES ('256', '4', 'GE734508578WW', '2017-05-24 17:45:47');
INSERT INTO `order_status_history` VALUES ('259', '2', '', '2017-05-24 19:19:58');
INSERT INTO `order_status_history` VALUES ('257', '2', '', '2017-05-25 09:54:29');
INSERT INTO `order_status_history` VALUES ('258', '2', '', '2017-05-25 10:46:09');
INSERT INTO `order_status_history` VALUES ('261', '5', '', '2017-05-25 10:48:47');
INSERT INTO `order_status_history` VALUES ('216', '5', '', '2017-05-25 10:49:58');
INSERT INTO `order_status_history` VALUES ('228', '5', '', '2017-05-25 10:50:14');
INSERT INTO `order_status_history` VALUES ('237', '5', '', '2017-05-25 10:50:37');
INSERT INTO `order_status_history` VALUES ('262', '2', '', '2017-05-25 11:15:37');
INSERT INTO `order_status_history` VALUES ('263', '2', '', '2017-05-25 12:49:30');
INSERT INTO `order_status_history` VALUES ('264', '2', '', '2017-05-25 12:51:16');
INSERT INTO `order_status_history` VALUES ('266', '2', '', '2017-05-25 13:43:40');
INSERT INTO `order_status_history` VALUES ('268', '2', '', '2017-05-25 14:08:46');
INSERT INTO `order_status_history` VALUES ('269', '2', '', '2017-05-25 14:34:02');
INSERT INTO `order_status_history` VALUES ('271', '2', '', '2017-05-25 15:04:40');
INSERT INTO `order_status_history` VALUES ('270', '2', '', '2017-05-25 15:15:27');
INSERT INTO `order_status_history` VALUES ('271', '4', 'GrabBike', '2017-05-25 15:57:34');
INSERT INTO `order_status_history` VALUES ('273', '2', '', '2017-05-25 16:07:33');
INSERT INTO `order_status_history` VALUES ('272', '2', '', '2017-05-25 16:42:45');
INSERT INTO `order_status_history` VALUES ('275', '2', '', '2017-05-25 17:20:03');
INSERT INTO `order_status_history` VALUES ('276', '2', '', '2017-05-25 17:52:47');
INSERT INTO `order_status_history` VALUES ('264', '4', 'GE734508581WW', '2017-05-25 18:04:33');
INSERT INTO `order_status_history` VALUES ('259', '4', 'GE734508595WW', '2017-05-25 18:05:05');
INSERT INTO `order_status_history` VALUES ('258', '4', 'GE734508604WW', '2017-05-25 18:05:38');
INSERT INTO `order_status_history` VALUES ('266', '4', 'GE734508618WW', '2017-05-25 18:05:57');
INSERT INTO `order_status_history` VALUES ('269', '4', 'GE734508621WW', '2017-05-25 18:06:17');
INSERT INTO `order_status_history` VALUES ('270', '4', 'GE734508635WW', '2017-05-25 18:06:34');
INSERT INTO `order_status_history` VALUES ('268', '4', 'GE734508649WW', '2017-05-25 18:06:50');
INSERT INTO `order_status_history` VALUES ('262', '4', 'GE734508652WW', '2017-05-25 18:07:12');
INSERT INTO `order_status_history` VALUES ('257', '4', 'GE734508666WW', '2017-05-25 18:07:32');
INSERT INTO `order_status_history` VALUES ('263', '4', 'GE734508670WW', '2017-05-25 18:08:01');
INSERT INTO `order_status_history` VALUES ('273', '4', 'GE734508683WW', '2017-05-25 18:08:23');
INSERT INTO `order_status_history` VALUES ('272', '4', 'GE734508697WW', '2017-05-25 18:08:41');
INSERT INTO `order_status_history` VALUES ('275', '4', 'GE734508706WW', '2017-05-25 18:09:00');
INSERT INTO `order_status_history` VALUES ('274', '2', '', '2017-05-25 19:49:14');
INSERT INTO `order_status_history` VALUES ('274', '4', 'นัดรับสินค้า', '2017-05-26 10:03:45');
INSERT INTO `order_status_history` VALUES ('278', '2', '', '2017-05-26 10:50:30');
INSERT INTO `order_status_history` VALUES ('242', '2', '', '2017-05-26 11:57:55');
INSERT INTO `order_status_history` VALUES ('281', '2', '', '2017-05-26 12:16:00');
INSERT INTO `order_status_history` VALUES ('282', '2', '', '2017-05-26 13:12:27');
INSERT INTO `order_status_history` VALUES ('280', '2', '', '2017-05-26 13:28:18');
INSERT INTO `order_status_history` VALUES ('267', '2', '', '2017-05-26 13:37:42');
INSERT INTO `order_status_history` VALUES ('267', '2', '', '2017-05-26 13:37:47');
INSERT INTO `order_status_history` VALUES ('277', '2', '', '2017-05-26 14:21:50');
INSERT INTO `order_status_history` VALUES ('277', '6', '', '2017-05-26 14:27:11');
INSERT INTO `order_status_history` VALUES ('284', '2', '', '2017-05-26 14:31:20');
INSERT INTO `order_status_history` VALUES ('285', '2', '', '2017-05-26 14:57:26');
INSERT INTO `order_status_history` VALUES ('285', '2', '', '2017-05-26 14:57:31');
INSERT INTO `order_status_history` VALUES ('279', '2', '', '2017-05-26 15:07:55');
INSERT INTO `order_status_history` VALUES ('279', '2', '', '2017-05-26 15:07:59');
INSERT INTO `order_status_history` VALUES ('286', '2', '', '2017-05-26 15:09:53');
INSERT INTO `order_status_history` VALUES ('287', '2', '', '2017-05-26 15:21:01');
INSERT INTO `order_status_history` VALUES ('260', '2', '', '2017-05-26 16:00:20');
INSERT INTO `order_status_history` VALUES ('289', '2', '', '2017-05-26 16:10:30');
INSERT INTO `order_status_history` VALUES ('290', '2', '', '2017-05-26 16:38:38');
INSERT INTO `order_status_history` VALUES ('293', '2', '', '2017-05-26 16:53:58');
INSERT INTO `order_status_history` VALUES ('292', '5', '', '2017-05-26 16:55:59');
INSERT INTO `order_status_history` VALUES ('291', '5', '', '2017-05-26 16:56:15');
INSERT INTO `order_status_history` VALUES ('288', '2', '', '2017-05-26 17:04:08');
INSERT INTO `order_status_history` VALUES ('294', '2', '', '2017-05-26 17:11:26');
INSERT INTO `order_status_history` VALUES ('284', '4', 'GE734508710WW', '2017-05-26 18:13:46');
INSERT INTO `order_status_history` VALUES ('285', '4', 'GE734508723WW', '2017-05-26 18:14:11');
INSERT INTO `order_status_history` VALUES ('281', '4', 'GE734508737WW', '2017-05-26 18:14:41');
INSERT INTO `order_status_history` VALUES ('267', '4', 'GE734508745WW', '2017-05-26 18:15:06');
INSERT INTO `order_status_history` VALUES ('282', '4', 'GE734508754WW', '2017-05-26 18:15:28');
INSERT INTO `order_status_history` VALUES ('260', '4', 'GE734508768WW', '2017-05-26 18:15:57');
INSERT INTO `order_status_history` VALUES ('287', '4', 'GE734508771WW', '2017-05-26 18:16:18');
INSERT INTO `order_status_history` VALUES ('290', '4', 'GE734508771WW', '2017-05-26 18:16:32');
INSERT INTO `order_status_history` VALUES ('289', '4', 'GE734508785WW', '2017-05-26 18:16:51');
INSERT INTO `order_status_history` VALUES ('288', '4', 'GE734508799WW', '2017-05-26 18:17:09');
INSERT INTO `order_status_history` VALUES ('293', '4', 'GE734508808WW', '2017-05-26 18:17:28');
INSERT INTO `order_status_history` VALUES ('286', '4', 'GrabBike', '2017-05-26 18:17:50');
INSERT INTO `order_status_history` VALUES ('242', '4', 'GE734508754WW', '2017-05-26 18:18:43');
INSERT INTO `order_status_history` VALUES ('276', '4', 'EQ158596845TH', '2017-05-26 18:50:32');
INSERT INTO `order_status_history` VALUES ('278', '4', 'EQ158596831TH', '2017-05-26 18:51:26');
INSERT INTO `order_status_history` VALUES ('280', '4', 'EQ158596862TH', '2017-05-26 18:52:10');
INSERT INTO `order_status_history` VALUES ('295', '2', '', '2017-05-26 22:14:15');
INSERT INTO `order_status_history` VALUES ('296', '2', '', '2017-05-27 08:28:19');
INSERT INTO `order_status_history` VALUES ('297', '2', '', '2017-05-27 09:10:17');
INSERT INTO `order_status_history` VALUES ('265', '2', '', '2017-05-27 09:10:43');
INSERT INTO `order_status_history` VALUES ('299', '2', '', '2017-05-27 11:17:58');
INSERT INTO `order_status_history` VALUES ('298', '2', '', '2017-05-27 11:24:05');
INSERT INTO `order_status_history` VALUES ('295', '4', 'GrabBike', '2017-05-27 11:33:56');
INSERT INTO `order_status_history` VALUES ('279', '4', 'EQ158596876TH', '2017-05-27 11:38:33');
INSERT INTO `order_status_history` VALUES ('302', '2', '', '2017-05-27 12:21:52');
INSERT INTO `order_status_history` VALUES ('303', '2', '', '2017-05-27 12:40:55');
INSERT INTO `order_status_history` VALUES ('283', '2', '', '2017-05-27 13:03:20');
INSERT INTO `order_status_history` VALUES ('303', '4', 'นัดรับสินค้า', '2017-05-27 13:23:28');
INSERT INTO `order_status_history` VALUES ('305', '2', '', '2017-05-27 13:40:40');
INSERT INTO `order_status_history` VALUES ('305', '2', '', '2017-05-27 13:40:43');
INSERT INTO `order_status_history` VALUES ('307', '2', '', '2017-05-27 13:49:40');
INSERT INTO `order_status_history` VALUES ('307', '2', '', '2017-05-27 13:49:43');
INSERT INTO `order_status_history` VALUES ('306', '2', '', '2017-05-27 13:49:59');
INSERT INTO `order_status_history` VALUES ('306', '2', '', '2017-05-27 13:50:00');
INSERT INTO `order_status_history` VALUES ('300', '2', '', '2017-05-27 13:59:22');
INSERT INTO `order_status_history` VALUES ('302', '4', 'GE734508811WW', '2017-05-27 15:02:19');
INSERT INTO `order_status_history` VALUES ('299', '4', 'GE734508825WW', '2017-05-27 15:02:39');
INSERT INTO `order_status_history` VALUES ('296', '4', 'GE734508839WW', '2017-05-27 15:03:15');
INSERT INTO `order_status_history` VALUES ('283', '4', 'GE734508842WW', '2017-05-27 15:03:34');
INSERT INTO `order_status_history` VALUES ('298', '4', 'GE734508856WW', '2017-05-27 15:03:59');
INSERT INTO `order_status_history` VALUES ('297', '4', 'GE734508860WW', '2017-05-27 15:04:17');
INSERT INTO `order_status_history` VALUES ('265', '4', 'GE734508873WW', '2017-05-27 15:04:39');
INSERT INTO `order_status_history` VALUES ('306', '4', 'GE734508887WW', '2017-05-27 15:04:57');
INSERT INTO `order_status_history` VALUES ('300', '4', 'GE734508895WW', '2017-05-27 15:05:14');
INSERT INTO `order_status_history` VALUES ('127', '6', '', '2017-05-27 15:21:30');
INSERT INTO `order_status_history` VALUES ('308', '2', '', '2017-05-27 15:25:44');
INSERT INTO `order_status_history` VALUES ('309', '2', '', '2017-05-27 15:27:21');
INSERT INTO `order_status_history` VALUES ('309', '2', '', '2017-05-27 15:27:31');
INSERT INTO `order_status_history` VALUES ('311', '2', '', '2017-05-27 15:38:47');
INSERT INTO `order_status_history` VALUES ('305', '4', 'GrabBike', '2017-05-27 15:52:51');
INSERT INTO `order_status_history` VALUES ('308', '4', 'GrabBike', '2017-05-27 15:54:06');
INSERT INTO `order_status_history` VALUES ('310', '2', '', '2017-05-27 15:59:28');
INSERT INTO `order_status_history` VALUES ('310', '4', 'GrabBike', '2017-05-27 15:59:35');
INSERT INTO `order_status_history` VALUES ('313', '2', '', '2017-05-27 16:06:26');
INSERT INTO `order_status_history` VALUES ('313', '4', 'นัดรับสินค้า', '2017-05-27 16:09:08');
INSERT INTO `order_status_history` VALUES ('311', '4', 'นัดรับสินค้า', '2017-05-27 16:09:51');
INSERT INTO `order_status_history` VALUES ('316', '5', '', '2017-05-27 17:12:01');
INSERT INTO `order_status_history` VALUES ('317', '2', '', '2017-05-27 17:43:48');
INSERT INTO `order_status_history` VALUES ('317', '2', '', '2017-05-27 17:44:16');
INSERT INTO `order_status_history` VALUES ('318', '2', '', '2017-05-27 17:54:26');
INSERT INTO `order_status_history` VALUES ('315', '2', '', '2017-05-27 21:09:43');
INSERT INTO `order_status_history` VALUES ('244', '5', '', '2017-05-27 21:10:50');
INSERT INTO `order_status_history` VALUES ('286', '4', '', '2017-05-28 13:25:11');
INSERT INTO `order_status_history` VALUES ('321', '2', '', '2017-05-29 09:47:16');
INSERT INTO `order_status_history` VALUES ('314', '2', '', '2017-05-29 10:29:34');
INSERT INTO `order_status_history` VALUES ('322', '2', '', '2017-05-29 11:43:11');
INSERT INTO `order_status_history` VALUES ('324', '2', '', '2017-05-29 11:43:35');
INSERT INTO `order_status_history` VALUES ('323', '2', '', '2017-05-29 11:43:57');
INSERT INTO `order_status_history` VALUES ('333', '2', '', '2017-05-29 13:16:19');
INSERT INTO `order_status_history` VALUES ('327', '2', '', '2017-05-29 13:17:08');
INSERT INTO `order_status_history` VALUES ('327', '2', '', '2017-05-29 13:17:13');
INSERT INTO `order_status_history` VALUES ('335', '2', '', '2017-05-29 13:18:53');
INSERT INTO `order_status_history` VALUES ('327', '2', '', '2017-05-29 13:25:47');
INSERT INTO `order_status_history` VALUES ('334', '2', '', '2017-05-29 13:26:34');
INSERT INTO `order_status_history` VALUES ('334', '2', '', '2017-05-29 13:26:36');
INSERT INTO `order_status_history` VALUES ('334', '2', '', '2017-05-29 13:26:39');
INSERT INTO `order_status_history` VALUES ('336', '2', '', '2017-05-29 13:29:42');
INSERT INTO `order_status_history` VALUES ('325', '2', '', '2017-05-29 13:30:19');
INSERT INTO `order_status_history` VALUES ('329', '2', '', '2017-05-29 13:48:31');
INSERT INTO `order_status_history` VALUES ('340', '2', '', '2017-05-29 13:57:13');
INSERT INTO `order_status_history` VALUES ('342', '2', '', '2017-05-29 14:07:53');
INSERT INTO `order_status_history` VALUES ('327', '4', 'นัดรับสินค้า', '2017-05-29 14:08:49');
INSERT INTO `order_status_history` VALUES ('324', '4', 'GrabBike', '2017-05-29 14:09:13');
INSERT INTO `order_status_history` VALUES ('322', '4', ' GrabBike', '2017-05-29 14:09:36');
INSERT INTO `order_status_history` VALUES ('309', '4', 'นัดรับสินค้า', '2017-05-29 14:10:00');
INSERT INTO `order_status_history` VALUES ('294', '4', 'นัดรับสินค้า', '2017-05-29 14:10:27');
INSERT INTO `order_status_history` VALUES ('312', '2', '', '2017-05-29 14:15:40');
INSERT INTO `order_status_history` VALUES ('312', '2', '', '2017-05-29 14:15:42');
INSERT INTO `order_status_history` VALUES ('331', '2', '', '2017-05-29 14:19:57');
INSERT INTO `order_status_history` VALUES ('341', '2', '', '2017-05-29 14:27:58');
INSERT INTO `order_status_history` VALUES ('301', '2', '', '2017-05-29 14:31:07');
INSERT INTO `order_status_history` VALUES ('344', '2', '', '2017-05-29 14:35:03');
INSERT INTO `order_status_history` VALUES ('338', '2', '', '2017-05-29 14:45:42');
INSERT INTO `order_status_history` VALUES ('338', '2', '', '2017-05-29 14:45:49');
INSERT INTO `order_status_history` VALUES ('338', '2', '', '2017-05-29 14:45:53');
INSERT INTO `order_status_history` VALUES ('339', '2', '', '2017-05-29 14:46:50');
INSERT INTO `order_status_history` VALUES ('239', '6', '', '2017-05-29 14:59:15');
INSERT INTO `order_status_history` VALUES ('343', '2', '', '2017-05-29 14:59:39');
INSERT INTO `order_status_history` VALUES ('346', '2', '', '2017-05-29 14:59:50');
INSERT INTO `order_status_history` VALUES ('345', '2', '', '2017-05-29 15:01:41');
INSERT INTO `order_status_history` VALUES ('336', '4', 'GrabBike', '2017-05-29 15:02:36');
INSERT INTO `order_status_history` VALUES ('330', '2', '', '2017-05-29 15:10:18');
INSERT INTO `order_status_history` VALUES ('330', '2', '', '2017-05-29 15:10:22');
INSERT INTO `order_status_history` VALUES ('328', '2', '', '2017-05-29 15:11:12');
INSERT INTO `order_status_history` VALUES ('326', '2', '', '2017-05-29 15:11:29');
INSERT INTO `order_status_history` VALUES ('319', '2', '', '2017-05-29 15:28:17');
INSERT INTO `order_status_history` VALUES ('347', '2', '', '2017-05-29 15:56:05');
INSERT INTO `order_status_history` VALUES ('337', '5', '', '2017-05-29 16:36:46');
INSERT INTO `order_status_history` VALUES ('304', '5', '', '2017-05-29 17:32:18');
INSERT INTO `order_status_history` VALUES ('329', '4', 'GrabBike', '2017-05-29 17:44:52');
INSERT INTO `order_status_history` VALUES ('135', '4', 'นัดรับสินค้า', '2017-05-29 17:47:34');
INSERT INTO `order_status_history` VALUES ('321', '4', 'GE734508900WW', '2017-05-29 18:04:16');
INSERT INTO `order_status_history` VALUES ('328', '4', 'GE734508913WW', '2017-05-29 18:04:44');
INSERT INTO `order_status_history` VALUES ('330', '4', 'GE734508927WW', '2017-05-29 18:05:03');
INSERT INTO `order_status_history` VALUES ('333', '4', 'GE734508935WW', '2017-05-29 18:05:24');
INSERT INTO `order_status_history` VALUES ('341', '4', 'GE734508944WW', '2017-05-29 18:05:47');
INSERT INTO `order_status_history` VALUES ('335', '4', 'GE734508958WW', '2017-05-29 18:06:01');
INSERT INTO `order_status_history` VALUES ('314', '4', 'GE734508961WW', '2017-05-29 18:06:18');
INSERT INTO `order_status_history` VALUES ('315', '4', 'GE734508975WW', '2017-05-29 18:06:35');
INSERT INTO `order_status_history` VALUES ('312', '4', 'GE734508989WW', '2017-05-29 18:06:57');
INSERT INTO `order_status_history` VALUES ('301', '4', 'GE734508992WW', '2017-05-29 18:07:12');
INSERT INTO `order_status_history` VALUES ('331', '4', 'GE734509009WW', '2017-05-29 18:07:27');
INSERT INTO `order_status_history` VALUES ('347', '4', 'GE734509012WW', '2017-05-29 18:07:42');
INSERT INTO `order_status_history` VALUES ('346', '4', 'GE734509026WW', '2017-05-29 18:08:02');
INSERT INTO `order_status_history` VALUES ('307', '4', 'GE734509030WW', '2017-05-29 18:08:16');
INSERT INTO `order_status_history` VALUES ('325', '4', 'GE734509043WW', '2017-05-29 18:08:29');
INSERT INTO `order_status_history` VALUES ('342', '4', 'GE734509057WW', '2017-05-29 18:08:43');
INSERT INTO `order_status_history` VALUES ('343', '4', 'GE734509065WW', '2017-05-29 18:08:57');
INSERT INTO `order_status_history` VALUES ('344', '4', 'GE734509074WW', '2017-05-29 18:09:11');
INSERT INTO `order_status_history` VALUES ('319', '4', 'GE734509088WW', '2017-05-29 18:09:24');
INSERT INTO `order_status_history` VALUES ('323', '4', 'GE734509091WW', '2017-05-29 18:09:41');
INSERT INTO `order_status_history` VALUES ('339', '4', 'GE734509105WW', '2017-05-29 18:09:55');
INSERT INTO `order_status_history` VALUES ('338', '4', 'GE734509114WW', '2017-05-29 18:10:08');
INSERT INTO `order_status_history` VALUES ('334', '4', 'EQ158596880TH', '2017-05-29 18:32:05');
INSERT INTO `order_status_history` VALUES ('318', '4', 'EQ158596893TH', '2017-05-29 18:32:36');
INSERT INTO `order_status_history` VALUES ('317', '4', 'EQ158596893TH', '2017-05-29 18:32:50');
INSERT INTO `order_status_history` VALUES ('326', '4', '', '2017-05-29 21:37:08');
INSERT INTO `order_status_history` VALUES ('349', '2', '', '2017-05-30 09:38:33');
INSERT INTO `order_status_history` VALUES ('332', '2', '', '2017-05-30 09:38:53');
INSERT INTO `order_status_history` VALUES ('351', '2', '', '2017-05-30 10:44:33');
INSERT INTO `order_status_history` VALUES ('352', '2', '', '2017-05-30 11:04:31');
INSERT INTO `order_status_history` VALUES ('350', '2', '', '2017-05-30 11:05:34');
INSERT INTO `order_status_history` VALUES ('354', '2', '', '2017-05-30 11:15:05');
INSERT INTO `order_status_history` VALUES ('355', '2', '', '2017-05-30 11:26:54');
INSERT INTO `order_status_history` VALUES ('348', '2', '', '2017-05-30 12:51:48');
INSERT INTO `order_status_history` VALUES ('360', '2', '', '2017-05-30 13:50:37');
INSERT INTO `order_status_history` VALUES ('361', '2', '', '2017-05-30 13:51:04');
INSERT INTO `order_status_history` VALUES ('362', '2', '', '2017-05-30 14:24:09');
INSERT INTO `order_status_history` VALUES ('359', '2', '', '2017-05-30 14:25:34');
INSERT INTO `order_status_history` VALUES ('365', '2', '', '2017-05-30 14:37:32');
INSERT INTO `order_status_history` VALUES ('365', '2', '', '2017-05-30 14:37:38');
INSERT INTO `order_status_history` VALUES ('364', '2', '', '2017-05-30 14:43:01');
INSERT INTO `order_status_history` VALUES ('367', '2', '', '2017-05-30 14:51:07');
INSERT INTO `order_status_history` VALUES ('369', '2', '', '2017-05-30 14:58:09');
INSERT INTO `order_status_history` VALUES ('363', '5', '', '2017-05-30 15:12:46');
INSERT INTO `order_status_history` VALUES ('357', '2', '', '2017-05-30 15:15:35');
INSERT INTO `order_status_history` VALUES ('368', '2', '', '2017-05-30 15:23:16');
INSERT INTO `order_status_history` VALUES ('366', '2', '', '2017-05-30 15:38:01');
INSERT INTO `order_status_history` VALUES ('371', '2', '', '2017-05-30 15:42:55');
INSERT INTO `order_status_history` VALUES ('371', '2', '', '2017-05-30 15:42:59');
INSERT INTO `order_status_history` VALUES ('370', '2', '', '2017-05-30 15:49:05');
INSERT INTO `order_status_history` VALUES ('372', '2', '', '2017-05-30 16:23:33');
INSERT INTO `order_status_history` VALUES ('348', '4', 'EQ158596902TH', '2017-05-30 16:23:38');
INSERT INTO `order_status_history` VALUES ('354', '4', 'EQ158596920TH', '2017-05-30 16:24:22');
INSERT INTO `order_status_history` VALUES ('350', '4', 'EQ158596933TH', '2017-05-30 16:28:28');
INSERT INTO `order_status_history` VALUES ('340', '4', 'EQ158596947TH', '2017-05-30 16:29:15');
INSERT INTO `order_status_history` VALUES ('351', '4', 'EQ158596916TH', '2017-05-30 16:30:24');
INSERT INTO `order_status_history` VALUES ('352', '4', 'EQ158596916TH', '2017-05-30 16:30:45');
INSERT INTO `order_status_history` VALUES ('371', '4', 'GE734509128WW', '2017-05-30 17:28:57');
INSERT INTO `order_status_history` VALUES ('370', '4', 'GE734509131WW', '2017-05-30 17:29:14');
INSERT INTO `order_status_history` VALUES ('364', '4', 'GE734509145WW', '2017-05-30 17:29:30');
INSERT INTO `order_status_history` VALUES ('359', '4', 'GE734509159WW', '2017-05-30 17:29:45');
INSERT INTO `order_status_history` VALUES ('362', '4', 'GE734509162WW', '2017-05-30 17:30:00');
INSERT INTO `order_status_history` VALUES ('349', '4', 'GE734509176WW', '2017-05-30 17:30:16');
INSERT INTO `order_status_history` VALUES ('372', '4', 'GE734509180WW', '2017-05-30 17:30:31');
INSERT INTO `order_status_history` VALUES ('366', '4', 'GE734509193WW', '2017-05-30 17:30:48');
INSERT INTO `order_status_history` VALUES ('368', '4', 'GE734509202WW', '2017-05-30 17:31:09');
INSERT INTO `order_status_history` VALUES ('374', '2', '', '2017-05-30 17:31:15');
INSERT INTO `order_status_history` VALUES ('360', '4', 'GE734509216WW', '2017-05-30 17:31:24');
INSERT INTO `order_status_history` VALUES ('332', '4', 'GE734509220WW', '2017-05-30 17:31:41');
INSERT INTO `order_status_history` VALUES ('367', '4', 'GE734509233WW', '2017-05-30 17:32:04');
INSERT INTO `order_status_history` VALUES ('365', '4', 'GE734509247WW', '2017-05-30 17:32:18');
INSERT INTO `order_status_history` VALUES ('355', '4', 'GE734509255WW', '2017-05-30 17:32:32');
INSERT INTO `order_status_history` VALUES ('374', '4', 'นัดรับสินค้า', '2017-05-30 18:05:27');
INSERT INTO `order_status_history` VALUES ('375', '1', '', '2017-05-31 09:23:50');
INSERT INTO `order_status_history` VALUES ('375', '1', '', '2017-05-31 09:24:12');
INSERT INTO `order_status_history` VALUES ('375', '2', '', '2017-05-31 09:24:44');
INSERT INTO `order_status_history` VALUES ('376', '2', '', '2017-05-31 09:33:09');
INSERT INTO `order_status_history` VALUES ('377', '2', '', '2017-05-31 10:09:07');
INSERT INTO `order_status_history` VALUES ('379', '2', '', '2017-05-31 10:10:32');
INSERT INTO `order_status_history` VALUES ('361', '4', 'GrabBike', '2017-05-31 10:54:23');
INSERT INTO `order_status_history` VALUES ('380', '2', '', '2017-05-31 10:56:53');
INSERT INTO `order_status_history` VALUES ('378', '2', '', '2017-05-31 11:10:00');
INSERT INTO `order_status_history` VALUES ('381', '2', '', '2017-05-31 11:59:40');
INSERT INTO `order_status_history` VALUES ('382', '2', '', '2017-05-31 12:01:46');
INSERT INTO `order_status_history` VALUES ('383', '2', '', '2017-05-31 12:15:18');
INSERT INTO `order_status_history` VALUES ('386', '2', '', '2017-05-31 13:59:36');
INSERT INTO `order_status_history` VALUES ('375', '4', 'EQ158596978TH', '2017-05-31 14:12:37');
INSERT INTO `order_status_history` VALUES ('357', '4', 'EQ158596955TH', '2017-05-31 14:13:07');
INSERT INTO `order_status_history` VALUES ('376', '4', 'EQ158596964TH', '2017-05-31 14:13:45');
INSERT INTO `order_status_history` VALUES ('390', '2', '', '2017-05-31 15:13:28');
INSERT INTO `order_status_history` VALUES ('390', '2', '', '2017-05-31 15:14:23');
INSERT INTO `order_status_history` VALUES ('389', '2', '', '2017-05-31 15:14:39');
INSERT INTO `order_status_history` VALUES ('389', '2', '', '2017-05-31 15:14:42');
INSERT INTO `order_status_history` VALUES ('388', '2', '', '2017-05-31 15:15:07');
INSERT INTO `order_status_history` VALUES ('393', '2', '', '2017-05-31 16:49:03');
INSERT INTO `order_status_history` VALUES ('394', '2', '', '2017-05-31 16:55:27');
INSERT INTO `order_status_history` VALUES ('386', '4', 'GE734509264WW', '2017-05-31 17:44:13');
INSERT INTO `order_status_history` VALUES ('381', '4', 'GE734509278WW', '2017-05-31 17:44:36');
INSERT INTO `order_status_history` VALUES ('379', '4', 'GE734509281WW', '2017-05-31 17:44:49');
INSERT INTO `order_status_history` VALUES ('382', '4', 'GE734509295WW', '2017-05-31 17:45:05');
INSERT INTO `order_status_history` VALUES ('378', '4', 'GE734509304WW', '2017-05-31 17:45:18');
INSERT INTO `order_status_history` VALUES ('383', '4', 'GE734509318WW', '2017-05-31 17:45:33');
INSERT INTO `order_status_history` VALUES ('345', '4', 'GE734509321WW', '2017-05-31 17:45:49');
INSERT INTO `order_status_history` VALUES ('389', '4', 'GE734509335WW', '2017-05-31 17:46:03');
INSERT INTO `order_status_history` VALUES ('391', '5', '', '2017-05-31 17:46:14');
INSERT INTO `order_status_history` VALUES ('380', '4', 'GE734509349WW', '2017-05-31 17:46:17');
INSERT INTO `order_status_history` VALUES ('377', '4', 'GE734509352WW', '2017-05-31 17:46:32');
INSERT INTO `order_status_history` VALUES ('388', '4', 'GE734509366WW', '2017-05-31 17:46:45');
INSERT INTO `order_status_history` VALUES ('390', '4', 'GE734509370WW', '2017-05-31 17:47:17');
INSERT INTO `order_status_history` VALUES ('393', '4', 'GE734509383WW', '2017-05-31 17:47:32');
INSERT INTO `order_status_history` VALUES ('394', '4', 'GE734509397WW', '2017-05-31 17:47:47');
INSERT INTO `order_status_history` VALUES ('396', '2', '', '2017-05-31 18:28:04');
INSERT INTO `order_status_history` VALUES ('320', '5', '', '2017-06-01 00:23:39');
INSERT INTO `order_status_history` VALUES ('397', '2', '', '2017-06-01 09:44:28');
INSERT INTO `order_status_history` VALUES ('395', '2', '', '2017-06-01 10:10:18');
INSERT INTO `order_status_history` VALUES ('399', '2', '', '2017-06-01 11:08:20');
INSERT INTO `order_status_history` VALUES ('398', '2', '', '2017-06-01 11:45:22');
INSERT INTO `order_status_history` VALUES ('403', '2', '', '2017-06-01 12:35:48');
INSERT INTO `order_status_history` VALUES ('405', '2', '', '2017-06-01 13:55:42');
INSERT INTO `order_status_history` VALUES ('392', '2', '', '2017-06-01 13:56:13');
INSERT INTO `order_status_history` VALUES ('409', '2', '', '2017-06-01 15:02:02');
INSERT INTO `order_status_history` VALUES ('410', '2', '', '2017-06-01 15:02:32');
INSERT INTO `order_status_history` VALUES ('411', '2', '', '2017-06-01 15:24:48');
INSERT INTO `order_status_history` VALUES ('413', '2', '', '2017-06-01 15:59:54');
INSERT INTO `order_status_history` VALUES ('402', '2', '', '2017-06-01 16:19:24');
INSERT INTO `order_status_history` VALUES ('412', '2', '', '2017-06-01 16:30:54');
INSERT INTO `order_status_history` VALUES ('414', '2', '', '2017-06-01 16:42:48');
INSERT INTO `order_status_history` VALUES ('414', '2', '', '2017-06-01 16:43:28');
INSERT INTO `order_status_history` VALUES ('412', '6', '', '2017-06-01 16:51:01');
INSERT INTO `order_status_history` VALUES ('400', '2', '', '2017-06-01 16:57:18');
INSERT INTO `order_status_history` VALUES ('416', '2', '', '2017-06-01 17:04:57');
INSERT INTO `order_status_history` VALUES ('415', '2', '', '2017-06-01 17:33:28');
INSERT INTO `order_status_history` VALUES ('410', '4', 'GE734509406WW', '2017-06-01 17:42:37');
INSERT INTO `order_status_history` VALUES ('409', '4', 'GE734509410WW', '2017-06-01 17:42:55');
INSERT INTO `order_status_history` VALUES ('405', '4', 'GE734509445WW', '2017-06-01 17:43:10');
INSERT INTO `order_status_history` VALUES ('392', '4', 'GE734509454WW', '2017-06-01 17:43:25');
INSERT INTO `order_status_history` VALUES ('398', '4', 'GE734509468WW', '2017-06-01 17:43:39');
INSERT INTO `order_status_history` VALUES ('403', '4', 'GE734509471WW', '2017-06-01 17:43:53');
INSERT INTO `order_status_history` VALUES ('396', '4', 'GE734509485WW', '2017-06-01 17:44:16');
INSERT INTO `order_status_history` VALUES ('395', '4', 'GE734509499WW', '2017-06-01 17:44:32');
INSERT INTO `order_status_history` VALUES ('399', '4', 'GE734509508WW', '2017-06-01 17:44:45');
INSERT INTO `order_status_history` VALUES ('414', '4', 'GE734509511WW', '2017-06-01 17:45:01');
INSERT INTO `order_status_history` VALUES ('413', '4', 'GE734509525WW', '2017-06-01 17:45:14');
INSERT INTO `order_status_history` VALUES ('416', '4', 'GE734509539WW', '2017-06-01 17:45:27');
INSERT INTO `order_status_history` VALUES ('401', '2', '', '2017-06-01 17:55:21');
INSERT INTO `order_status_history` VALUES ('417', '2', '', '2017-06-01 18:04:27');
INSERT INTO `order_status_history` VALUES ('415', '4', 'นัดรับสินค้า', '2017-06-01 18:07:39');
INSERT INTO `order_status_history` VALUES ('408', '2', '', '2017-06-01 18:31:07');
INSERT INTO `order_status_history` VALUES ('418', '2', '', '2017-06-02 09:54:30');
INSERT INTO `order_status_history` VALUES ('419', '2', '', '2017-06-02 12:10:58');
INSERT INTO `order_status_history` VALUES ('420', '2', '', '2017-06-02 12:17:49');
INSERT INTO `order_status_history` VALUES ('421', '2', '', '2017-06-02 12:38:53');
INSERT INTO `order_status_history` VALUES ('422', '2', '', '2017-06-02 13:54:11');
INSERT INTO `order_status_history` VALUES ('424', '2', '', '2017-06-02 14:21:30');
INSERT INTO `order_status_history` VALUES ('423', '2', '', '2017-06-02 14:30:42');
INSERT INTO `order_status_history` VALUES ('433', '2', '', '2017-06-02 14:50:44');
INSERT INTO `order_status_history` VALUES ('432', '2', '', '2017-06-02 14:55:11');
INSERT INTO `order_status_history` VALUES ('434', '2', '', '2017-06-02 14:56:57');
INSERT INTO `order_status_history` VALUES ('427', '2', '', '2017-06-02 14:57:49');
INSERT INTO `order_status_history` VALUES ('425', '2', '', '2017-06-02 14:59:01');
INSERT INTO `order_status_history` VALUES ('369', '4', 'EQ158597015TH', '2017-06-02 15:05:55');
INSERT INTO `order_status_history` VALUES ('397', '4', 'EQ158597094TH', '2017-06-02 15:06:35');
INSERT INTO `order_status_history` VALUES ('400', '4', 'EQ158597050TH', '2017-06-02 15:07:56');
INSERT INTO `order_status_history` VALUES ('407', '5', '', '2017-06-02 15:12:08');
INSERT INTO `order_status_history` VALUES ('406', '2', '', '2017-06-02 15:19:15');
INSERT INTO `order_status_history` VALUES ('436', '2', '', '2017-06-02 15:45:49');
INSERT INTO `order_status_history` VALUES ('435', '5', '', '2017-06-02 15:57:59');
INSERT INTO `order_status_history` VALUES ('438', '2', '', '2017-06-02 16:28:52');
INSERT INTO `order_status_history` VALUES ('439', '2', '', '2017-06-02 17:14:13');
INSERT INTO `order_status_history` VALUES ('439', '2', '', '2017-06-02 17:14:23');
INSERT INTO `order_status_history` VALUES ('440', '2', '', '2017-06-02 17:41:18');
INSERT INTO `order_status_history` VALUES ('423', '4', 'GE734509542WW', '2017-06-02 17:45:07');
INSERT INTO `order_status_history` VALUES ('425', '4', 'GE734509556WW', '2017-06-02 17:45:21');
INSERT INTO `order_status_history` VALUES ('433', '4', 'GE734509560WW', '2017-06-02 17:45:34');
INSERT INTO `order_status_history` VALUES ('424', '4', 'GE734509573WW', '2017-06-02 17:45:48');
INSERT INTO `order_status_history` VALUES ('417', '4', 'GE734509587WW', '2017-06-02 17:46:01');
INSERT INTO `order_status_history` VALUES ('408', '4', 'GE734509595WW', '2017-06-02 17:46:20');
INSERT INTO `order_status_history` VALUES ('438', '4', 'GE734509600WW', '2017-06-02 17:46:38');
INSERT INTO `order_status_history` VALUES ('432', '4', 'GE734509613WW', '2017-06-02 17:46:52');
INSERT INTO `order_status_history` VALUES ('434', '4', 'GE734509627WW', '2017-06-02 17:47:05');
INSERT INTO `order_status_history` VALUES ('436', '4', 'GE734509635WW', '2017-06-02 17:47:23');
INSERT INTO `order_status_history` VALUES ('422', '4', 'GE734509644WW', '2017-06-02 17:47:37');
INSERT INTO `order_status_history` VALUES ('420', '4', 'GE734509658WW', '2017-06-02 17:47:50');
INSERT INTO `order_status_history` VALUES ('418', '4', 'GE734509661WW', '2017-06-02 17:48:04');
INSERT INTO `order_status_history` VALUES ('439', '4', 'GE734509675WW', '2017-06-02 17:48:19');
INSERT INTO `order_status_history` VALUES ('427', '4', 'GE734509689WW', '2017-06-02 17:48:36');
INSERT INTO `order_status_history` VALUES ('421', '4', 'นัดรับสินค้า', '2017-06-02 17:49:08');
INSERT INTO `order_status_history` VALUES ('419', '4', 'GrabBike', '2017-06-02 17:49:28');
INSERT INTO `order_status_history` VALUES ('404', '2', '', '2017-06-02 22:13:04');
INSERT INTO `order_status_history` VALUES ('428', '2', '', '2017-06-03 10:00:11');
INSERT INTO `order_status_history` VALUES ('353', '2', '', '2017-06-03 10:18:24');
INSERT INTO `order_status_history` VALUES ('442', '2', '', '2017-06-03 10:48:30');
INSERT INTO `order_status_history` VALUES ('411', '4', 'EQ158597103TH', '2017-06-03 11:05:07');
INSERT INTO `order_status_history` VALUES ('401', '4', 'EQ158597063TH', '2017-06-03 11:06:31');
INSERT INTO `order_status_history` VALUES ('402', '4', 'EQ158597029TH', '2017-06-03 11:07:21');
INSERT INTO `order_status_history` VALUES ('443', '5', '', '2017-06-03 11:57:36');
INSERT INTO `order_status_history` VALUES ('445', '2', '', '2017-06-03 12:07:05');
INSERT INTO `order_status_history` VALUES ('446', '2', '', '2017-06-03 12:11:33');
INSERT INTO `order_status_history` VALUES ('447', '2', '', '2017-06-03 12:43:56');
INSERT INTO `order_status_history` VALUES ('448', '2', '', '2017-06-03 12:45:08');
INSERT INTO `order_status_history` VALUES ('449', '2', '', '2017-06-03 13:11:50');
INSERT INTO `order_status_history` VALUES ('450', '2', '', '2017-06-03 13:30:05');
INSERT INTO `order_status_history` VALUES ('440', '4', 'GrabBike', '2017-06-03 13:52:11');
INSERT INTO `order_status_history` VALUES ('406', '4', 'EQ158597117TH', '2017-06-03 13:59:58');
INSERT INTO `order_status_history` VALUES ('428', '4', 'EQ158597077TH', '2017-06-03 14:00:40');
INSERT INTO `order_status_history` VALUES ('451', '2', '', '2017-06-03 14:11:37');
INSERT INTO `order_status_history` VALUES ('450', '4', ' GrabBike', '2017-06-03 14:18:10');
INSERT INTO `order_status_history` VALUES ('449', '4', ' GrabBike', '2017-06-03 14:18:24');
INSERT INTO `order_status_history` VALUES ('447', '6', '', '2017-06-03 14:25:39');
INSERT INTO `order_status_history` VALUES ('353', '4', 'GE734509692WW', '2017-06-03 14:32:28');
INSERT INTO `order_status_history` VALUES ('404', '4', 'GE734509701WW', '2017-06-03 14:32:42');
INSERT INTO `order_status_history` VALUES ('446', '4', 'GE734509715WW', '2017-06-03 14:32:56');
INSERT INTO `order_status_history` VALUES ('442', '4', 'GE734509729WW', '2017-06-03 14:33:10');
INSERT INTO `order_status_history` VALUES ('445', '4', 'GE734509732WW', '2017-06-03 14:33:23');
INSERT INTO `order_status_history` VALUES ('452', '2', '', '2017-06-03 14:46:37');
INSERT INTO `order_status_history` VALUES ('454', '2', '', '2017-06-03 15:20:51');
INSERT INTO `order_status_history` VALUES ('455', '2', '', '2017-06-03 16:02:28');
INSERT INTO `order_status_history` VALUES ('451', '4', 'GrabBike', '2017-06-03 17:55:55');
INSERT INTO `order_status_history` VALUES ('457', '2', '', '2017-06-04 16:58:00');
INSERT INTO `order_status_history` VALUES ('457', '2', '', '2017-06-04 16:58:06');
INSERT INTO `order_status_history` VALUES ('458', '2', '', '2017-06-04 16:58:58');
INSERT INTO `order_status_history` VALUES ('356', '5', '', '2017-06-05 09:26:25');
INSERT INTO `order_status_history` VALUES ('358', '5', '', '2017-06-05 09:26:48');
INSERT INTO `order_status_history` VALUES ('384', '5', '', '2017-06-05 09:27:18');
INSERT INTO `order_status_history` VALUES ('385', '5', '', '2017-06-05 09:27:37');
INSERT INTO `order_status_history` VALUES ('387', '5', '', '2017-06-05 09:27:58');
INSERT INTO `order_status_history` VALUES ('426', '2', '', '2017-06-05 09:30:03');
INSERT INTO `order_status_history` VALUES ('231', '5', '', '2017-06-05 09:32:18');
INSERT INTO `order_status_history` VALUES ('437', '5', '', '2017-06-05 09:32:58');
INSERT INTO `order_status_history` VALUES ('460', '2', '', '2017-06-05 10:17:06');
INSERT INTO `order_status_history` VALUES ('429', '2', '', '2017-06-05 11:00:06');
INSERT INTO `order_status_history` VALUES ('462', '2', '', '2017-06-05 11:00:53');
INSERT INTO `order_status_history` VALUES ('462', '2', '', '2017-06-05 11:01:16');
INSERT INTO `order_status_history` VALUES ('430', '2', '', '2017-06-05 11:14:41');
INSERT INTO `order_status_history` VALUES ('431', '2', '', '2017-06-05 11:23:01');
INSERT INTO `order_status_history` VALUES ('463', '2', '', '2017-06-05 11:32:21');
INSERT INTO `order_status_history` VALUES ('465', '2', '', '2017-06-05 12:13:20');
INSERT INTO `order_status_history` VALUES ('466', '2', '', '2017-06-05 12:29:29');
INSERT INTO `order_status_history` VALUES ('464', '2', '', '2017-06-05 13:23:58');
INSERT INTO `order_status_history` VALUES ('467', '2', '', '2017-06-05 13:34:44');
INSERT INTO `order_status_history` VALUES ('423', '4', 'วุฒ', '2017-06-05 13:41:03');
INSERT INTO `order_status_history` VALUES ('468', '2', '', '2017-06-05 13:48:49');
INSERT INTO `order_status_history` VALUES ('472', '2', '', '2017-06-05 14:13:15');
INSERT INTO `order_status_history` VALUES ('470', '2', '', '2017-06-05 14:13:39');
INSERT INTO `order_status_history` VALUES ('469', '2', '', '2017-06-05 14:14:20');
INSERT INTO `order_status_history` VALUES ('473', '2', '', '2017-06-05 14:20:48');
INSERT INTO `order_status_history` VALUES ('471', '5', '', '2017-06-05 15:10:31');
INSERT INTO `order_status_history` VALUES ('476', '2', '', '2017-06-05 15:11:24');
INSERT INTO `order_status_history` VALUES ('477', '2', '', '2017-06-05 15:12:51');
INSERT INTO `order_status_history` VALUES ('478', '2', '', '2017-06-05 15:17:41');
INSERT INTO `order_status_history` VALUES ('480', '2', '', '2017-06-05 15:37:52');
INSERT INTO `order_status_history` VALUES ('479', '5', '', '2017-06-05 15:52:34');
INSERT INTO `order_status_history` VALUES ('483', '2', '', '2017-06-05 15:59:19');
INSERT INTO `order_status_history` VALUES ('484', '2', '', '2017-06-05 16:07:08');
INSERT INTO `order_status_history` VALUES ('485', '2', '', '2017-06-05 16:16:54');
INSERT INTO `order_status_history` VALUES ('453', '2', '', '2017-06-05 16:21:01');
INSERT INTO `order_status_history` VALUES ('453', '1', '', '2017-06-05 16:23:28');
INSERT INTO `order_status_history` VALUES ('486', '2', '', '2017-06-05 16:26:46');
INSERT INTO `order_status_history` VALUES ('453', '2', '', '2017-06-05 16:35:00');
INSERT INTO `order_status_history` VALUES ('489', '2', '', '2017-06-05 16:47:00');
INSERT INTO `order_status_history` VALUES ('487', '5', '', '2017-06-05 16:50:03');
INSERT INTO `order_status_history` VALUES ('490', '2', '', '2017-06-05 16:57:47');
INSERT INTO `order_status_history` VALUES ('491', '2', '', '2017-06-05 17:04:57');
INSERT INTO `order_status_history` VALUES ('448', '4', 'EQ158597001TH', '2017-06-05 17:18:22');
INSERT INTO `order_status_history` VALUES ('454', '4', 'นัดรับสินค้า', '2017-06-05 17:18:51');
INSERT INTO `order_status_history` VALUES ('472', '4', ' GrabBike', '2017-06-05 17:19:51');
INSERT INTO `order_status_history` VALUES ('462', '4', 'นัดรับสินค้า', '2017-06-05 17:21:26');
INSERT INTO `order_status_history` VALUES ('460', '4', 'EQ158597046TH', '2017-06-05 17:22:02');
INSERT INTO `order_status_history` VALUES ('466', '4', 'EQ158597085TH', '2017-06-05 17:22:38');
INSERT INTO `order_status_history` VALUES ('458', '4', 'EQ158597125TH', '2017-06-05 17:23:18');
INSERT INTO `order_status_history` VALUES ('470', '4', 'GE734509746WW', '2017-06-05 17:46:46');
INSERT INTO `order_status_history` VALUES ('473', '4', 'GE734509750WW', '2017-06-05 17:47:05');
INSERT INTO `order_status_history` VALUES ('463', '4', 'GE734509763WW', '2017-06-05 17:47:22');
INSERT INTO `order_status_history` VALUES ('467', '4', 'GE734509777WW', '2017-06-05 17:47:38');
INSERT INTO `order_status_history` VALUES ('465', '4', 'GE734509785WW', '2017-06-05 17:47:54');
INSERT INTO `order_status_history` VALUES ('426', '4', 'GE734509794WW', '2017-06-05 17:48:22');
INSERT INTO `order_status_history` VALUES ('455', '4', 'GE734509803WW', '2017-06-05 17:48:41');
INSERT INTO `order_status_history` VALUES ('464', '4', 'GE734509817WW', '2017-06-05 17:49:06');
INSERT INTO `order_status_history` VALUES ('469', '4', 'GE734509825WW', '2017-06-05 17:49:20');
INSERT INTO `order_status_history` VALUES ('457', '4', 'GE734509834WW', '2017-06-05 17:49:35');
INSERT INTO `order_status_history` VALUES ('452', '4', 'GE734509848WW', '2017-06-05 17:50:03');
INSERT INTO `order_status_history` VALUES ('483', '4', 'GE734509851WW', '2017-06-05 17:50:16');
INSERT INTO `order_status_history` VALUES ('476', '4', 'GE734509865WW', '2017-06-05 17:50:28');
INSERT INTO `order_status_history` VALUES ('480', '4', 'GE734509879WW', '2017-06-05 17:50:41');
INSERT INTO `order_status_history` VALUES ('478', '4', 'GE734509882WW', '2017-06-05 17:50:53');
INSERT INTO `order_status_history` VALUES ('484', '4', 'GE734509896WW', '2017-06-05 17:51:07');
INSERT INTO `order_status_history` VALUES ('453', '4', 'GE734509905WW', '2017-06-05 17:51:21');
INSERT INTO `order_status_history` VALUES ('485', '4', 'GE734509919WW', '2017-06-05 17:51:36');
INSERT INTO `order_status_history` VALUES ('477', '4', 'GE734509922WW', '2017-06-05 17:51:50');
INSERT INTO `order_status_history` VALUES ('489', '4', 'GE734509936WW', '2017-06-05 17:52:05');
INSERT INTO `order_status_history` VALUES ('491', '4', 'GE734509940WW', '2017-06-05 17:52:18');
INSERT INTO `order_status_history` VALUES ('486', '4', 'GrabBike', '2017-06-05 17:52:39');
INSERT INTO `order_status_history` VALUES ('474', '2', '', '2017-06-05 18:00:32');
INSERT INTO `order_status_history` VALUES ('493', '2', '', '2017-06-05 18:06:01');
INSERT INTO `order_status_history` VALUES ('496', '2', '', '2017-06-06 11:47:08');
INSERT INTO `order_status_history` VALUES ('498', '2', '', '2017-06-06 12:05:57');
INSERT INTO `order_status_history` VALUES ('499', '2', '', '2017-06-06 12:20:32');
INSERT INTO `order_status_history` VALUES ('501', '2', '', '2017-06-06 12:57:20');
INSERT INTO `order_status_history` VALUES ('494', '2', '', '2017-06-06 12:59:20');
INSERT INTO `order_status_history` VALUES ('500', '2', '', '2017-06-06 13:14:43');
INSERT INTO `order_status_history` VALUES ('502', '2', '', '2017-06-06 13:15:35');
INSERT INTO `order_status_history` VALUES ('505', '2', '', '2017-06-06 13:37:49');
INSERT INTO `order_status_history` VALUES ('506', '2', '', '2017-06-06 13:54:08');
INSERT INTO `order_status_history` VALUES ('461', '2', '', '2017-06-06 14:01:45');
INSERT INTO `order_status_history` VALUES ('504', '2', '', '2017-06-06 14:06:47');
INSERT INTO `order_status_history` VALUES ('444', '2', '', '2017-06-06 14:27:15');
INSERT INTO `order_status_history` VALUES ('503', '2', '', '2017-06-06 14:29:38');
INSERT INTO `order_status_history` VALUES ('511', '2', '', '2017-06-06 14:48:24');
INSERT INTO `order_status_history` VALUES ('510', '2', '', '2017-06-06 14:52:51');
INSERT INTO `order_status_history` VALUES ('509', '2', '', '2017-06-06 14:55:21');
INSERT INTO `order_status_history` VALUES ('497', '2', '', '2017-06-06 15:13:51');
INSERT INTO `order_status_history` VALUES ('512', '2', '', '2017-06-06 15:17:29');
INSERT INTO `order_status_history` VALUES ('495', '5', '', '2017-06-06 15:21:44');
INSERT INTO `order_status_history` VALUES ('482', '5', '', '2017-06-06 15:30:11');
INSERT INTO `order_status_history` VALUES ('475', '5', '', '2017-06-06 15:30:43');
INSERT INTO `order_status_history` VALUES ('515', '2', '', '2017-06-06 15:46:55');
INSERT INTO `order_status_history` VALUES ('514', '2', '', '2017-06-06 16:06:33');
INSERT INTO `order_status_history` VALUES ('481', '2', '', '2017-06-06 16:21:54');
INSERT INTO `order_status_history` VALUES ('516', '2', '', '2017-06-06 16:45:45');
INSERT INTO `order_status_history` VALUES ('517', '2', '', '2017-06-06 16:46:12');
INSERT INTO `order_status_history` VALUES ('492', '2', '', '2017-06-06 16:46:34');
INSERT INTO `order_status_history` VALUES ('468', '4', 'EQ158597165TH', '2017-06-06 17:16:00');
INSERT INTO `order_status_history` VALUES ('490', '4', 'EQ158597151TH', '2017-06-06 17:16:50');
INSERT INTO `order_status_history` VALUES ('474', '4', 'EQ158597148TH', '2017-06-06 17:17:40');
INSERT INTO `order_status_history` VALUES ('493', '4', 'EQ158597134TH', '2017-06-06 17:18:21');
INSERT INTO `order_status_history` VALUES ('500', '4', 'EQ158597205TH', '2017-06-06 17:19:06');
INSERT INTO `order_status_history` VALUES ('500', '4', 'EQ158597205TH', '2017-06-06 17:23:20');
INSERT INTO `order_status_history` VALUES ('499', '4', 'EQ158597196TH', '2017-06-06 17:25:12');
INSERT INTO `order_status_history` VALUES ('496', '4', 'EQ158597182TH', '2017-06-06 17:25:55');
INSERT INTO `order_status_history` VALUES ('498', '4', 'EQ158597179TH', '2017-06-06 17:28:23');
INSERT INTO `order_status_history` VALUES ('506', '4', 'GE734509953WW', '2017-06-06 17:38:28');
INSERT INTO `order_status_history` VALUES ('501', '4', 'GE734509967WW', '2017-06-06 17:38:42');
INSERT INTO `order_status_history` VALUES ('504', '4', 'GE734509975WW', '2017-06-06 17:38:59');
INSERT INTO `order_status_history` VALUES ('494', '4', 'GE734509984WW', '2017-06-06 17:39:13');
INSERT INTO `order_status_history` VALUES ('444', '4', 'GE734509998WW', '2017-06-06 17:39:25');
INSERT INTO `order_status_history` VALUES ('502', '4', 'GE734510007WW', '2017-06-06 17:39:39');
INSERT INTO `order_status_history` VALUES ('461', '4', 'GE734510015WW', '2017-06-06 17:39:52');
INSERT INTO `order_status_history` VALUES ('509', '4', 'GE734510024WW', '2017-06-06 17:40:06');
INSERT INTO `order_status_history` VALUES ('511', '4', 'GE734510038WW', '2017-06-06 17:40:19');
INSERT INTO `order_status_history` VALUES ('503', '4', 'GE734510041WW', '2017-06-06 17:40:33');
INSERT INTO `order_status_history` VALUES ('481', '4', 'GE734510055WW', '2017-06-06 17:40:44');
INSERT INTO `order_status_history` VALUES ('514', '4', 'GE734510069WW', '2017-06-06 17:40:58');
INSERT INTO `order_status_history` VALUES ('515', '4', 'GE734510072WW', '2017-06-06 17:41:14');
INSERT INTO `order_status_history` VALUES ('497', '4', 'GE734510086WW', '2017-06-06 17:41:28');
INSERT INTO `order_status_history` VALUES ('512', '4', 'GE734510090WW', '2017-06-06 17:41:42');
INSERT INTO `order_status_history` VALUES ('517', '4', 'GE734510109WW', '2017-06-06 17:41:55');
INSERT INTO `order_status_history` VALUES ('492', '4', 'GE734510112WW', '2017-06-06 17:42:11');
INSERT INTO `order_status_history` VALUES ('516', '4', 'GE734510126WW', '2017-06-06 17:42:24');
INSERT INTO `order_status_history` VALUES ('518', '2', '', '2017-06-06 17:58:30');
INSERT INTO `order_status_history` VALUES ('519', '2', '', '2017-06-06 21:05:10');
INSERT INTO `order_status_history` VALUES ('441', '5', '', '2017-06-07 06:25:45');
INSERT INTO `order_status_history` VALUES ('456', '5', '', '2017-06-07 06:26:03');
INSERT INTO `order_status_history` VALUES ('459', '5', '', '2017-06-07 06:26:45');
INSERT INTO `order_status_history` VALUES ('522', '2', '', '2017-06-07 09:38:21');
INSERT INTO `order_status_history` VALUES ('520', '2', '', '2017-06-07 09:57:47');
INSERT INTO `order_status_history` VALUES ('508', '5', '', '2017-06-07 10:26:23');
INSERT INTO `order_status_history` VALUES ('523', '2', '', '2017-06-07 10:27:49');
INSERT INTO `order_status_history` VALUES ('523', '6', '', '2017-06-07 10:34:15');
INSERT INTO `order_status_history` VALUES ('520', '6', '', '2017-06-07 10:34:33');
INSERT INTO `order_status_history` VALUES ('524', '2', '', '2017-06-07 10:34:53');
INSERT INTO `order_status_history` VALUES ('525', '2', '', '2017-06-07 10:35:04');
INSERT INTO `order_status_history` VALUES ('525', '4', ' นัดรับสินค้า', '2017-06-07 11:07:42');
INSERT INTO `order_status_history` VALUES ('524', '4', 'นัดรับสินค้า', '2017-06-07 11:08:06');
INSERT INTO `order_status_history` VALUES ('527', '2', '', '2017-06-07 13:20:51');
INSERT INTO `order_status_history` VALUES ('526', '2', '', '2017-06-07 13:53:09');
INSERT INTO `order_status_history` VALUES ('529', '2', '', '2017-06-07 13:57:06');
INSERT INTO `order_status_history` VALUES ('533', '2', '', '2017-06-07 15:06:04');
INSERT INTO `order_status_history` VALUES ('534', '2', '', '2017-06-07 15:13:58');
INSERT INTO `order_status_history` VALUES ('507', '2', '', '2017-06-07 15:19:30');
INSERT INTO `order_status_history` VALUES ('531', '2', '', '2017-06-07 15:27:52');
INSERT INTO `order_status_history` VALUES ('535', '2', '', '2017-06-07 15:42:02');
INSERT INTO `order_status_history` VALUES ('530', '2', '', '2017-06-07 15:48:02');
INSERT INTO `order_status_history` VALUES ('488', '2', '', '2017-06-07 15:56:49');
INSERT INTO `order_status_history` VALUES ('537', '2', '', '2017-06-07 16:40:21');
INSERT INTO `order_status_history` VALUES ('538', '2', '', '2017-06-07 17:19:25');
INSERT INTO `order_status_history` VALUES ('529', '4', 'GE734510130WW', '2017-06-07 18:05:24');
INSERT INTO `order_status_history` VALUES ('534', '4', 'GE734510143WW', '2017-06-07 18:05:45');
INSERT INTO `order_status_history` VALUES ('507', '4', 'GE734510157WW', '2017-06-07 18:06:01');
INSERT INTO `order_status_history` VALUES ('533', '4', 'GE734510165WW', '2017-06-07 18:06:12');
INSERT INTO `order_status_history` VALUES ('526', '4', 'GE734510174WW', '2017-06-07 18:06:26');
INSERT INTO `order_status_history` VALUES ('522', '4', 'GE734510188WW', '2017-06-07 18:06:50');
INSERT INTO `order_status_history` VALUES ('488', '4', 'GE734510191WW', '2017-06-07 18:07:10');
INSERT INTO `order_status_history` VALUES ('530', '4', 'GE734510214WW', '2017-06-07 18:07:32');
INSERT INTO `order_status_history` VALUES ('531', '4', 'GE734510228WW', '2017-06-07 18:07:44');
INSERT INTO `order_status_history` VALUES ('535', '4', 'GE734510231WW', '2017-06-07 18:07:57');
INSERT INTO `order_status_history` VALUES ('538', '4', 'GE734510245WW', '2017-06-07 18:08:10');
INSERT INTO `order_status_history` VALUES ('537', '4', 'นัดรับสินค้า', '2017-06-07 18:08:39');
INSERT INTO `order_status_history` VALUES ('532', '2', '', '2017-06-07 18:28:14');
INSERT INTO `order_status_history` VALUES ('539', '2', '', '2017-06-08 08:57:57');
INSERT INTO `order_status_history` VALUES ('519', '4', 'EQ158597222TH', '2017-06-08 10:09:28');
INSERT INTO `order_status_history` VALUES ('518', '4', 'EQ158597236TH', '2017-06-08 10:11:05');
INSERT INTO `order_status_history` VALUES ('510', '4', 'EQ158597219TH', '2017-06-08 10:12:30');
INSERT INTO `order_status_history` VALUES ('540', '2', '', '2017-06-08 10:40:22');
INSERT INTO `order_status_history` VALUES ('541', '2', '', '2017-06-08 11:05:40');
INSERT INTO `order_status_history` VALUES ('542', '2', '', '2017-06-08 11:31:21');
INSERT INTO `order_status_history` VALUES ('543', '2', '', '2017-06-08 11:39:40');
INSERT INTO `order_status_history` VALUES ('548', '2', '', '2017-06-08 13:20:37');
INSERT INTO `order_status_history` VALUES ('536', '2', '', '2017-06-08 13:40:51');
INSERT INTO `order_status_history` VALUES ('549', '2', '', '2017-06-08 14:36:27');
INSERT INTO `order_status_history` VALUES ('550', '2', '', '2017-06-08 14:47:07');
INSERT INTO `order_status_history` VALUES ('551', '2', '', '2017-06-08 14:47:43');
INSERT INTO `order_status_history` VALUES ('543', '4', 'EQ158597240TH', '2017-06-08 15:04:37');
INSERT INTO `order_status_history` VALUES ('532', '4', 'GrabBike', '2017-06-08 15:05:00');
INSERT INTO `order_status_history` VALUES ('542', '4', 'EQ158597267TH', '2017-06-08 15:05:42');
INSERT INTO `order_status_history` VALUES ('527', '4', 'นัดรับสินค้า', '2017-06-08 15:06:15');
INSERT INTO `order_status_history` VALUES ('540', '4', 'EQ158597253TH', '2017-06-08 15:06:50');
INSERT INTO `order_status_history` VALUES ('431', '4', 'GrabBike', '2017-06-08 15:07:51');
INSERT INTO `order_status_history` VALUES ('430', '4', 'GrabBike', '2017-06-08 15:08:12');
INSERT INTO `order_status_history` VALUES ('429', '4', 'GrabBike', '2017-06-08 15:08:27');
INSERT INTO `order_status_history` VALUES ('546', '2', '', '2017-06-08 15:13:18');
INSERT INTO `order_status_history` VALUES ('553', '2', '', '2017-06-08 15:18:19');
INSERT INTO `order_status_history` VALUES ('552', '2', '', '2017-06-08 15:23:35');
INSERT INTO `order_status_history` VALUES ('545', '2', '', '2017-06-08 15:42:59');
INSERT INTO `order_status_history` VALUES ('547', '2', '', '2017-06-08 15:46:14');
INSERT INTO `order_status_history` VALUES ('550', '4', 'GrabBike', '2017-06-08 16:18:10');
INSERT INTO `order_status_history` VALUES ('554', '2', '', '2017-06-08 16:39:20');
INSERT INTO `order_status_history` VALUES ('552', '4', 'GrabBike', '2017-06-08 17:11:48');
INSERT INTO `order_status_history` VALUES ('549', '4', 'GE734510259WW', '2017-06-08 17:34:44');
INSERT INTO `order_status_history` VALUES ('541', '4', 'GE734510262WW', '2017-06-08 17:35:20');
INSERT INTO `order_status_history` VALUES ('536', '4', 'GE734510276WW', '2017-06-08 17:35:39');
INSERT INTO `order_status_history` VALUES ('548', '4', 'GE734510280WW', '2017-06-08 17:36:00');
INSERT INTO `order_status_history` VALUES ('539', '4', 'GE734510293WW', '2017-06-08 17:36:17');
INSERT INTO `order_status_history` VALUES ('551', '4', 'GE734510302WW', '2017-06-08 17:36:32');
INSERT INTO `order_status_history` VALUES ('554', '4', 'GE734510316WW', '2017-06-08 17:36:46');
INSERT INTO `order_status_history` VALUES ('547', '4', 'GE734510320WW', '2017-06-08 17:37:02');
INSERT INTO `order_status_history` VALUES ('553', '4', 'GE734510333WW', '2017-06-08 17:37:15');
INSERT INTO `order_status_history` VALUES ('546', '4', 'GE734510347WW', '2017-06-08 17:37:29');
INSERT INTO `order_status_history` VALUES ('545', '4', 'GE734510355WW', '2017-06-08 17:37:45');
INSERT INTO `order_status_history` VALUES ('555', '2', '', '2017-06-08 19:31:23');
INSERT INTO `order_status_history` VALUES ('557', '2', '', '2017-06-09 09:59:20');
INSERT INTO `order_status_history` VALUES ('559', '2', '', '2017-06-09 10:46:56');
INSERT INTO `order_status_history` VALUES ('560', '5', '', '2017-06-09 11:16:28');
INSERT INTO `order_status_history` VALUES ('544', '2', '', '2017-06-09 12:52:36');
INSERT INTO `order_status_history` VALUES ('563', '2', '', '2017-06-09 13:00:57');
INSERT INTO `order_status_history` VALUES ('562', '5', '', '2017-06-09 13:23:36');
INSERT INTO `order_status_history` VALUES ('565', '2', '', '2017-06-09 13:41:07');
INSERT INTO `order_status_history` VALUES ('566', '2', '', '2017-06-09 13:43:47');
INSERT INTO `order_status_history` VALUES ('373', '5', '', '2017-06-09 13:45:11');
INSERT INTO `order_status_history` VALUES ('567', '2', '', '2017-06-09 14:01:50');
INSERT INTO `order_status_history` VALUES ('564', '2', '', '2017-06-09 14:04:02');
INSERT INTO `order_status_history` VALUES ('561', '2', '', '2017-06-09 14:15:14');
INSERT INTO `order_status_history` VALUES ('568', '2', '', '2017-06-09 14:21:01');
INSERT INTO `order_status_history` VALUES ('570', '2', '', '2017-06-09 14:59:34');
INSERT INTO `order_status_history` VALUES ('569', '2', '', '2017-06-09 15:14:56');
INSERT INTO `order_status_history` VALUES ('572', '2', '', '2017-06-09 15:54:43');
INSERT INTO `order_status_history` VALUES ('571', '2', '', '2017-06-09 15:55:59');
INSERT INTO `order_status_history` VALUES ('573', '2', '', '2017-06-09 15:58:20');
INSERT INTO `order_status_history` VALUES ('574', '2', '', '2017-06-09 16:46:06');
INSERT INTO `order_status_history` VALUES ('564', '6', '', '2017-06-09 16:46:25');
INSERT INTO `order_status_history` VALUES ('571', '4', 'GrabBike', '2017-06-09 16:55:39');
INSERT INTO `order_status_history` VALUES ('572', '4', 'GrabBike', '2017-06-09 16:56:04');
INSERT INTO `order_status_history` VALUES ('565', '4', ' GrabBike', '2017-06-09 17:15:57');
INSERT INTO `order_status_history` VALUES ('575', '2', '', '2017-06-09 17:47:18');
INSERT INTO `order_status_history` VALUES ('570', '4', 'GE734510364WW', '2017-06-09 17:58:45');
INSERT INTO `order_status_history` VALUES ('544', '4', 'GE734510378WW', '2017-06-09 17:59:07');
INSERT INTO `order_status_history` VALUES ('563', '4', 'GE734510381WW', '2017-06-09 17:59:32');
INSERT INTO `order_status_history` VALUES ('559', '4', 'GE734510395WW', '2017-06-09 17:59:59');
INSERT INTO `order_status_history` VALUES ('557', '4', 'GE734510404WW', '2017-06-09 18:00:15');
INSERT INTO `order_status_history` VALUES ('566', '4', 'GE734510418WW', '2017-06-09 18:00:32');
INSERT INTO `order_status_history` VALUES ('567', '4', 'GE734510421WW', '2017-06-09 18:00:48');
INSERT INTO `order_status_history` VALUES ('569', '4', 'GE734510435WW', '2017-06-09 18:01:08');
INSERT INTO `order_status_history` VALUES ('555', '4', 'GE734510449WW', '2017-06-09 18:01:25');
INSERT INTO `order_status_history` VALUES ('561', '4', 'GE734510452WW', '2017-06-09 18:01:43');
INSERT INTO `order_status_history` VALUES ('573', '4', 'GE734510466WW', '2017-06-09 18:02:01');
INSERT INTO `order_status_history` VALUES ('574', '4', 'GE734510470WW', '2017-06-09 18:02:21');
INSERT INTO `order_status_history` VALUES ('575', '4', 'GE734510483WW', '2017-06-09 18:02:40');
INSERT INTO `order_status_history` VALUES ('576', '2', '', '2017-06-10 09:51:22');
INSERT INTO `order_status_history` VALUES ('577', '2', '', '2017-06-10 10:24:38');
INSERT INTO `order_status_history` VALUES ('556', '2', '', '2017-06-10 11:08:26');
INSERT INTO `order_status_history` VALUES ('578', '2', '', '2017-06-10 12:11:13');
INSERT INTO `order_status_history` VALUES ('577', '4', 'GrabBike', '2017-06-10 12:53:03');
INSERT INTO `order_status_history` VALUES ('579', '2', '', '2017-06-10 12:54:43');
INSERT INTO `order_status_history` VALUES ('580', '2', '', '2017-06-10 13:00:36');
INSERT INTO `order_status_history` VALUES ('583', '2', '', '2017-06-10 13:25:11');
INSERT INTO `order_status_history` VALUES ('582', '2', '', '2017-06-10 13:27:11');
INSERT INTO `order_status_history` VALUES ('584', '2', '', '2017-06-10 13:52:23');
INSERT INTO `order_status_history` VALUES ('576', '4', 'GE734510497WW', '2017-06-10 14:13:43');
INSERT INTO `order_status_history` VALUES ('580', '4', 'GE734510506WW', '2017-06-10 14:13:58');
INSERT INTO `order_status_history` VALUES ('556', '4', 'GE734510510WW', '2017-06-10 14:14:14');
INSERT INTO `order_status_history` VALUES ('583', '4', 'GE734510523WW', '2017-06-10 14:14:26');
INSERT INTO `order_status_history` VALUES ('579', '4', 'GE734510537WW', '2017-06-10 14:14:43');
INSERT INTO `order_status_history` VALUES ('581', '2', '', '2017-06-10 14:38:32');
INSERT INTO `order_status_history` VALUES ('585', '2', '', '2017-06-10 15:07:43');
INSERT INTO `order_status_history` VALUES ('586', '2', '', '2017-06-10 15:08:41');
INSERT INTO `order_status_history` VALUES ('587', '2', '', '2017-06-10 16:14:21');
INSERT INTO `order_status_history` VALUES ('584', '4', ' GrabBike', '2017-06-10 16:39:46');
INSERT INTO `order_status_history` VALUES ('582', '4', 'GrabBike', '2017-06-10 16:40:57');
INSERT INTO `order_status_history` VALUES ('588', '2', '', '2017-06-10 16:55:15');
INSERT INTO `order_status_history` VALUES ('588', '4', 'นัดรับสินค้า', '2017-06-10 17:04:56');
INSERT INTO `order_status_history` VALUES ('587', '4', 'GrabBike', '2017-06-10 17:10:45');
INSERT INTO `order_status_history` VALUES ('589', '1', '', '2017-06-10 18:31:19');
INSERT INTO `order_status_history` VALUES ('591', '2', '', '2017-06-11 08:45:06');
INSERT INTO `order_status_history` VALUES ('589', '2', '', '2017-06-12 09:17:16');
INSERT INTO `order_status_history` VALUES ('593', '2', '', '2017-06-12 09:18:06');
INSERT INTO `order_status_history` VALUES ('594', '2', '', '2017-06-12 09:39:09');
INSERT INTO `order_status_history` VALUES ('513', '5', '', '2017-06-12 09:40:12');
INSERT INTO `order_status_history` VALUES ('521', '5', '', '2017-06-12 09:40:35');
INSERT INTO `order_status_history` VALUES ('528', '5', '', '2017-06-12 09:40:57');
INSERT INTO `order_status_history` VALUES ('558', '5', '', '2017-06-12 09:41:23');
INSERT INTO `order_status_history` VALUES ('595', '2', '', '2017-06-12 10:00:39');
INSERT INTO `order_status_history` VALUES ('597', '2', '', '2017-06-12 10:04:42');
INSERT INTO `order_status_history` VALUES ('568', '4', 'EQ158597275TH', '2017-06-12 10:15:51');
INSERT INTO `order_status_history` VALUES ('599', '5', '', '2017-06-12 10:50:27');
INSERT INTO `order_status_history` VALUES ('600', '2', '', '2017-06-12 10:54:17');
INSERT INTO `order_status_history` VALUES ('601', '2', '', '2017-06-12 11:28:15');
INSERT INTO `order_status_history` VALUES ('596', '2', '', '2017-06-12 11:37:52');
INSERT INTO `order_status_history` VALUES ('602', '2', '', '2017-06-12 11:38:22');
INSERT INTO `order_status_history` VALUES ('603', '2', '', '2017-06-12 12:11:14');
INSERT INTO `order_status_history` VALUES ('604', '2', '', '2017-06-12 12:14:17');
INSERT INTO `order_status_history` VALUES ('606', '2', '', '2017-06-12 12:56:10');
INSERT INTO `order_status_history` VALUES ('607', '2', '', '2017-06-12 13:16:05');
INSERT INTO `order_status_history` VALUES ('607', '2', '', '2017-06-12 13:16:39');
INSERT INTO `order_status_history` VALUES ('598', '2', '', '2017-06-12 13:24:28');
INSERT INTO `order_status_history` VALUES ('609', '2', '', '2017-06-12 13:43:28');
INSERT INTO `order_status_history` VALUES ('610', '2', '', '2017-06-12 14:20:15');
INSERT INTO `order_status_history` VALUES ('598', '4', 'นัดรับสินค้า', '2017-06-12 14:27:42');
INSERT INTO `order_status_history` VALUES ('608', '2', '', '2017-06-12 14:40:57');
INSERT INTO `order_status_history` VALUES ('611', '2', '', '2017-06-12 14:42:36');
INSERT INTO `order_status_history` VALUES ('612', '2', '', '2017-06-12 14:57:53');
INSERT INTO `order_status_history` VALUES ('613', '5', '', '2017-06-12 15:16:22');
INSERT INTO `order_status_history` VALUES ('614', '2', '', '2017-06-12 15:18:52');
INSERT INTO `order_status_history` VALUES ('610', '4', 'GrabBike', '2017-06-12 15:21:02');
INSERT INTO `order_status_history` VALUES ('605', '2', '', '2017-06-12 15:23:35');
INSERT INTO `order_status_history` VALUES ('592', '2', '', '2017-06-12 15:42:49');
INSERT INTO `order_status_history` VALUES ('578', '4', 'EQ158597355TH', '2017-06-12 15:57:10');
INSERT INTO `order_status_history` VALUES ('595', '4', 'EQ158597341TH', '2017-06-12 15:57:53');
INSERT INTO `order_status_history` VALUES ('581', '4', 'EQ158597338TH', '2017-06-12 15:58:31');
INSERT INTO `order_status_history` VALUES ('591', '4', 'EQ158597324TH', '2017-06-12 15:59:16');
INSERT INTO `order_status_history` VALUES ('594', '4', 'EQ158597315TH', '2017-06-12 16:00:00');
INSERT INTO `order_status_history` VALUES ('600', '4', 'EQ158597307TH', '2017-06-12 16:00:51');
INSERT INTO `order_status_history` VALUES ('615', '2', '', '2017-06-12 16:01:14');
INSERT INTO `order_status_history` VALUES ('597', '4', 'EQ158597298TH', '2017-06-12 16:01:37');
INSERT INTO `order_status_history` VALUES ('596', '4', 'EQ158597284TH', '2017-06-12 16:02:15');
INSERT INTO `order_status_history` VALUES ('585', '4', 'GE734510554WW', '2017-06-12 17:38:47');
INSERT INTO `order_status_history` VALUES ('585', '4', 'GE734510554WW', '2017-06-12 17:39:16');
INSERT INTO `order_status_history` VALUES ('586', '4', 'GE734510568WW', '2017-06-12 17:40:45');
INSERT INTO `order_status_history` VALUES ('609', '4', 'GE734510571WW', '2017-06-12 17:43:15');
INSERT INTO `order_status_history` VALUES ('603', '4', 'GE734510585WW', '2017-06-12 17:44:19');
INSERT INTO `order_status_history` VALUES ('589', '4', 'GE734510599WW', '2017-06-12 17:44:45');
INSERT INTO `order_status_history` VALUES ('593', '4', 'GE734510608WW', '2017-06-12 17:45:09');
INSERT INTO `order_status_history` VALUES ('602', '4', 'GE734510611WW', '2017-06-12 17:45:31');
INSERT INTO `order_status_history` VALUES ('604', '4', 'GE734510625WW', '2017-06-12 17:45:55');
INSERT INTO `order_status_history` VALUES ('612', '4', 'GE734510639WW', '2017-06-12 17:46:16');
INSERT INTO `order_status_history` VALUES ('608', '4', 'GE734510642WW', '2017-06-12 17:46:38');
INSERT INTO `order_status_history` VALUES ('611', '4', 'GE734510656WW', '2017-06-12 17:47:00');
INSERT INTO `order_status_history` VALUES ('601', '4', 'GE734510660WW', '2017-06-12 17:47:21');
INSERT INTO `order_status_history` VALUES ('607', '4', 'GE734510673WW', '2017-06-12 17:48:01');
INSERT INTO `order_status_history` VALUES ('615', '4', 'GE734510687WW', '2017-06-12 17:48:16');
INSERT INTO `order_status_history` VALUES ('614', '4', 'GE734510695WW', '2017-06-12 17:48:34');
INSERT INTO `order_status_history` VALUES ('605', '4', 'GE734510700WW', '2017-06-12 17:49:05');
INSERT INTO `order_status_history` VALUES ('606', '4', '', '2017-06-13 09:20:05');
INSERT INTO `order_status_history` VALUES ('618', '2', '', '2017-06-13 09:52:06');
INSERT INTO `order_status_history` VALUES ('620', '2', '', '2017-06-13 10:38:37');
INSERT INTO `order_status_history` VALUES ('621', '2', '', '2017-06-13 10:57:52');
INSERT INTO `order_status_history` VALUES ('616', '2', '', '2017-06-13 10:59:44');
INSERT INTO `order_status_history` VALUES ('622', '2', '', '2017-06-13 11:19:59');
INSERT INTO `order_status_history` VALUES ('616', '6', '', '2017-06-13 11:27:19');
INSERT INTO `order_status_history` VALUES ('623', '2', '', '2017-06-13 11:34:44');
INSERT INTO `order_status_history` VALUES ('624', '2', '', '2017-06-13 13:20:54');
INSERT INTO `order_status_history` VALUES ('626', '2', '', '2017-06-13 14:14:53');
INSERT INTO `order_status_history` VALUES ('627', '2', '', '2017-06-13 14:15:30');
INSERT INTO `order_status_history` VALUES ('617', '2', '', '2017-06-13 14:16:10');
INSERT INTO `order_status_history` VALUES ('590', '5', '', '2017-06-13 14:30:44');
INSERT INTO `order_status_history` VALUES ('628', '2', '', '2017-06-13 15:19:33');
INSERT INTO `order_status_history` VALUES ('625', '5', '', '2017-06-13 15:27:21');
INSERT INTO `order_status_history` VALUES ('629', '2', '', '2017-06-13 15:36:26');
INSERT INTO `order_status_history` VALUES ('622', '4', '', '2017-06-13 16:04:12');
INSERT INTO `order_status_history` VALUES ('592', '4', '', '2017-06-13 16:04:59');
INSERT INTO `order_status_history` VALUES ('632', '2', '', '2017-06-13 16:08:17');
INSERT INTO `order_status_history` VALUES ('633', '2', '', '2017-06-13 16:14:41');
INSERT INTO `order_status_history` VALUES ('634', '2', '', '2017-06-13 16:32:26');
INSERT INTO `order_status_history` VALUES ('635', '2', '', '2017-06-13 17:29:35');
INSERT INTO `order_status_history` VALUES ('634', '4', '', '2017-06-13 18:49:57');
INSERT INTO `order_status_history` VALUES ('633', '4', '', '2017-06-13 18:50:51');
INSERT INTO `order_status_history` VALUES ('632', '4', '', '2017-06-13 18:51:48');
INSERT INTO `order_status_history` VALUES ('617', '4', '', '2017-06-13 18:53:18');
INSERT INTO `order_status_history` VALUES ('626', '4', '', '2017-06-13 18:54:01');
INSERT INTO `order_status_history` VALUES ('628', '4', '', '2017-06-13 18:54:46');
INSERT INTO `order_status_history` VALUES ('629', '4', '', '2017-06-13 18:55:47');
INSERT INTO `order_status_history` VALUES ('618', '4', '', '2017-06-13 18:56:51');
INSERT INTO `order_status_history` VALUES ('627', '4', '', '2017-06-13 18:58:42');
INSERT INTO `order_status_history` VALUES ('624', '4', '', '2017-06-13 18:59:25');
INSERT INTO `order_status_history` VALUES ('620', '4', '', '2017-06-13 18:59:58');
INSERT INTO `order_status_history` VALUES ('621', '4', '', '2017-06-13 19:00:57');
INSERT INTO `order_status_history` VALUES ('623', '4', '', '2017-06-13 19:01:54');
INSERT INTO `order_status_history` VALUES ('638', '2', '', '2017-06-13 22:34:46');
INSERT INTO `order_status_history` VALUES ('640', '2', '', '2017-06-14 11:07:12');
INSERT INTO `order_status_history` VALUES ('641', '2', '', '2017-06-14 11:26:43');
INSERT INTO `order_status_history` VALUES ('638', '4', '', '2017-06-14 11:38:30');
INSERT INTO `order_status_history` VALUES ('631', '2', '', '2017-06-14 11:45:36');
INSERT INTO `order_status_history` VALUES ('640', '4', '', '2017-06-14 11:48:23');
INSERT INTO `order_status_history` VALUES ('631', '6', '', '2017-06-14 12:04:48');
INSERT INTO `order_status_history` VALUES ('644', '2', '', '2017-06-14 12:12:39');
INSERT INTO `order_status_history` VALUES ('643', '2', '', '2017-06-14 12:13:14');
INSERT INTO `order_status_history` VALUES ('639', '2', '', '2017-06-14 12:14:44');
INSERT INTO `order_status_history` VALUES ('642', '2', '', '2017-06-14 12:21:43');
INSERT INTO `order_status_history` VALUES ('646', '2', '', '2017-06-14 13:13:20');
INSERT INTO `order_status_history` VALUES ('643', '4', '', '2017-06-14 13:19:25');
INSERT INTO `order_status_history` VALUES ('637', '5', '', '2017-06-14 13:20:16');
INSERT INTO `order_status_history` VALUES ('636', '5', '', '2017-06-14 13:20:31');
INSERT INTO `order_status_history` VALUES ('647', '2', '', '2017-06-14 13:23:56');
INSERT INTO `order_status_history` VALUES ('649', '2', '', '2017-06-14 13:28:34');
INSERT INTO `order_status_history` VALUES ('650', '2', '', '2017-06-14 13:52:04');
INSERT INTO `order_status_history` VALUES ('651', '2', '', '2017-06-14 13:53:12');
INSERT INTO `order_status_history` VALUES ('652', '2', '', '2017-06-14 14:39:22');
INSERT INTO `order_status_history` VALUES ('619', '2', '', '2017-06-14 15:01:12');
INSERT INTO `order_status_history` VALUES ('635', '4', '', '2017-06-14 17:07:01');
INSERT INTO `order_status_history` VALUES ('651', '4', '', '2017-06-14 17:44:39');
INSERT INTO `order_status_history` VALUES ('650', '4', '', '2017-06-14 17:45:21');
INSERT INTO `order_status_history` VALUES ('647', '4', '', '2017-06-14 17:45:57');
INSERT INTO `order_status_history` VALUES ('646', '4', '', '2017-06-14 17:46:32');
INSERT INTO `order_status_history` VALUES ('639', '4', '', '2017-06-14 17:47:14');
INSERT INTO `order_status_history` VALUES ('619', '4', '', '2017-06-14 17:47:46');
INSERT INTO `order_status_history` VALUES ('652', '4', '', '2017-06-14 17:48:43');
INSERT INTO `order_status_history` VALUES ('644', '4', '', '2017-06-14 17:49:28');
INSERT INTO `order_status_history` VALUES ('642', '4', '', '2017-06-14 17:50:07');
INSERT INTO `order_status_history` VALUES ('649', '4', '', '2017-06-14 17:51:02');
INSERT INTO `order_status_history` VALUES ('641', '4', '', '2017-06-14 17:51:33');
INSERT INTO `order_status_history` VALUES ('654', '2', '', '2017-06-15 09:57:00');
INSERT INTO `order_status_history` VALUES ('653', '2', '', '2017-06-15 09:58:53');
INSERT INTO `order_status_history` VALUES ('655', '2', '', '2017-06-15 10:04:41');
INSERT INTO `order_status_history` VALUES ('656', '2', '', '2017-06-15 10:20:02');
INSERT INTO `order_status_history` VALUES ('630', '2', '', '2017-06-15 10:23:57');
INSERT INTO `order_status_history` VALUES ('658', '2', '', '2017-06-15 10:55:44');
INSERT INTO `order_status_history` VALUES ('658', '4', 'นัดรับสินค้า', '2017-06-15 11:29:17');
INSERT INTO `order_status_history` VALUES ('660', '2', '', '2017-06-15 11:47:31');
INSERT INTO `order_status_history` VALUES ('662', '2', '', '2017-06-15 13:38:24');
INSERT INTO `order_status_history` VALUES ('664', '2', '', '2017-06-15 14:19:46');
INSERT INTO `order_status_history` VALUES ('648', '2', '', '2017-06-15 14:26:36');
INSERT INTO `order_status_history` VALUES ('662', '4', 'GrabBike', '2017-06-15 14:56:31');
INSERT INTO `order_status_history` VALUES ('645', '2', '', '2017-06-15 15:23:18');
INSERT INTO `order_status_history` VALUES ('665', '2', '', '2017-06-15 15:27:04');
INSERT INTO `order_status_history` VALUES ('666', '2', '', '2017-06-15 15:43:12');
INSERT INTO `order_status_history` VALUES ('661', '5', '', '2017-06-15 15:43:33');
INSERT INTO `order_status_history` VALUES ('669', '2', '', '2017-06-15 15:45:01');
INSERT INTO `order_status_history` VALUES ('667', '5', '', '2017-06-15 15:47:07');
INSERT INTO `order_status_history` VALUES ('668', '2', '', '2017-06-15 15:55:36');
INSERT INTO `order_status_history` VALUES ('665', '4', 'GrabBike', '2017-06-15 16:30:34');
INSERT INTO `order_status_history` VALUES ('659', '5', '', '2017-06-15 16:49:57');
INSERT INTO `order_status_history` VALUES ('653', '4', 'GE734510951WW', '2017-06-15 17:53:26');
INSERT INTO `order_status_history` VALUES ('655', '4', 'GE734510951WW', '2017-06-15 17:53:50');
INSERT INTO `order_status_history` VALUES ('654', '4', 'GE734510951WW', '2017-06-15 17:54:16');
INSERT INTO `order_status_history` VALUES ('630', '4', 'GE734510965WW', '2017-06-15 17:54:34');
INSERT INTO `order_status_history` VALUES ('664', '4', 'GE734510979WW', '2017-06-15 17:54:50');
INSERT INTO `order_status_history` VALUES ('645', '4', 'GE734510982WW', '2017-06-15 17:55:07');
INSERT INTO `order_status_history` VALUES ('666', '4', 'GE734510996WW', '2017-06-15 17:55:23');
INSERT INTO `order_status_history` VALUES ('669', '4', 'GE734511002WW', '2017-06-15 17:55:38');
INSERT INTO `order_status_history` VALUES ('663', '2', '', '2017-06-15 18:10:39');
INSERT INTO `order_status_history` VALUES ('671', '2', '', '2017-06-16 09:59:47');
INSERT INTO `order_status_history` VALUES ('657', '2', '', '2017-06-16 10:05:32');
INSERT INTO `order_status_history` VALUES ('670', '2', '', '2017-06-16 10:39:29');
INSERT INTO `order_status_history` VALUES ('657', '4', 'นัดรับสินค้า', '2017-06-16 10:45:31');
INSERT INTO `order_status_history` VALUES ('674', '2', '', '2017-06-16 13:52:47');
INSERT INTO `order_status_history` VALUES ('674', '4', 'นัดรับสินค้า', '2017-06-16 13:53:57');
INSERT INTO `order_status_history` VALUES ('676', '2', '', '2017-06-16 14:07:25');
INSERT INTO `order_status_history` VALUES ('678', '1', '', '2017-06-16 14:22:44');
INSERT INTO `order_status_history` VALUES ('678', '2', '', '2017-06-16 14:22:47');
INSERT INTO `order_status_history` VALUES ('677', '2', '', '2017-06-16 14:24:46');
INSERT INTO `order_status_history` VALUES ('656', '4', 'EQ158597412TH', '2017-06-16 14:38:08');
INSERT INTO `order_status_history` VALUES ('648', '4', 'EQ158597390TH', '2017-06-16 14:38:48');
INSERT INTO `order_status_history` VALUES ('668', '4', 'EQ158597409TH', '2017-06-16 14:39:30');
INSERT INTO `order_status_history` VALUES ('660', '4', 'นัดรับสินค้า', '2017-06-16 14:42:20');
INSERT INTO `order_status_history` VALUES ('675', '2', '', '2017-06-16 14:47:59');
INSERT INTO `order_status_history` VALUES ('679', '2', '', '2017-06-16 14:59:12');
INSERT INTO `order_status_history` VALUES ('677', '4', 'GrabBike', '2017-06-16 15:06:01');
INSERT INTO `order_status_history` VALUES ('675', '2', '', '2017-06-16 15:07:36');
INSERT INTO `order_status_history` VALUES ('680', '2', '', '2017-06-16 15:15:42');
INSERT INTO `order_status_history` VALUES ('679', '4', 'นัดรับสินค้า', '2017-06-16 15:15:43');
INSERT INTO `order_status_history` VALUES ('681', '2', '', '2017-06-16 15:17:03');
INSERT INTO `order_status_history` VALUES ('673', '2', '', '2017-06-16 16:19:35');
INSERT INTO `order_status_history` VALUES ('672', '2', '', '2017-06-16 16:25:58');
INSERT INTO `order_status_history` VALUES ('682', '2', '', '2017-06-16 16:33:23');
INSERT INTO `order_status_history` VALUES ('680', '4', 'GrabBike', '2017-06-16 16:38:50');
INSERT INTO `order_status_history` VALUES ('675', '4', 'GE734511016WW', '2017-06-16 17:59:34');
INSERT INTO `order_status_history` VALUES ('676', '4', 'GE734511016WW', '2017-06-16 17:59:58');
INSERT INTO `order_status_history` VALUES ('670', '4', 'GE734511020WW', '2017-06-16 18:00:15');
INSERT INTO `order_status_history` VALUES ('672', '4', 'GE734511033WW', '2017-06-16 18:00:32');
INSERT INTO `order_status_history` VALUES ('673', '4', 'GE734511047WW', '2017-06-16 18:00:50');
INSERT INTO `order_status_history` VALUES ('682', '4', 'GE734511055WW', '2017-06-16 18:01:07');
INSERT INTO `order_status_history` VALUES ('681', '4', 'GE734511064WW', '2017-06-16 18:01:21');
INSERT INTO `order_status_history` VALUES ('678', '4', 'GE734511078WW', '2017-06-16 18:01:41');
INSERT INTO `order_status_history` VALUES ('663', '4', 'GE734511081WW', '2017-06-16 18:02:01');
INSERT INTO `order_status_history` VALUES ('671', '4', 'GE734511095WW', '2017-06-16 18:02:17');
INSERT INTO `order_status_history` VALUES ('684', '2', '', '2017-06-17 10:24:28');
INSERT INTO `order_status_history` VALUES ('686', '2', '', '2017-06-17 11:57:57');
INSERT INTO `order_status_history` VALUES ('685', '2', '', '2017-06-17 12:04:23');
INSERT INTO `order_status_history` VALUES ('685', '4', 'EQ158597457TH', '2017-06-17 14:06:31');
INSERT INTO `order_status_history` VALUES ('686', '4', 'GE734511104WW', '2017-06-17 14:43:23');
INSERT INTO `order_status_history` VALUES ('684', '4', 'GE734511118WW', '2017-06-17 14:43:49');
INSERT INTO `order_status_history` VALUES ('688', '2', '', '2017-06-17 15:25:10');
INSERT INTO `order_status_history` VALUES ('689', '2', '', '2017-06-17 15:39:37');
INSERT INTO `order_status_history` VALUES ('690', '2', '', '2017-06-17 15:52:37');
INSERT INTO `order_status_history` VALUES ('690', '2', '', '2017-06-17 15:52:45');
INSERT INTO `order_status_history` VALUES ('690', '4', 'นัดรับสินค้า', '2017-06-17 16:11:35');
INSERT INTO `order_status_history` VALUES ('689', '4', 'GrabBike', '2017-06-17 17:10:11');

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
INSERT INTO `product_brand` VALUES ('2', 'HPE', 'HPE brand', '1', '2017-06-23 00:27:57', '1', '2017-06-24 17:50:22', '1');

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
  PRIMARY KEY (`product_owner_id`,`part_number`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_owner
-- ----------------------------
INSERT INTO `product_owner` VALUES ('1', 'E7V99A', 'MSA1040', '1', '1 MSA 1040 2Prt FC DC LFF Strg', '1 MSA 1040 2Prt FC DC LFF Strg', '229500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('2', 'E7W00A', 'SV3200', '1', '1 MSA 1040 2Prt FC DC SFF Strg', '1 MSA 1040 2Prt FC DC SFF Strg', '229900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('3', 'E7W01A', 'MSA2042', '1', '1 MSA 1040 2Prt 1G iSCSI DC LFF Strg', '1 MSA 1040 2Prt 1G iSCSI DC LFF Strg', '208000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('4', 'E7W02A', 'WS-C2960C', '1', '1 MSA 1040 2Prt 1G iSCSI DC SFF Strg', '1 MSA 1040 2Prt 1G iSCSI DC SFF Strg', '210500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('5', 'K2Q90A', 'MODEL001', '1', '1 MSA 1040 2Prt SAS DC LFF Strg', '1 MSA 1040 2Prt SAS DC LFF Strg', '220000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('6', 'K2Q89A', 'MODEL002', '1', '1 MSA 1040 2Prt SAS DC SFF Strg', '1 MSA 1040 2Prt SAS DC SFF Strg', '225500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('7', 'N9X95A', 'MODEL003', '1', '1 MSA 400GB 12G SAS MU 2.5in SSD', '1 MSA 400GB 12G SAS MU 2.5in SSD', '40300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('8', 'N9X96A', 'MODEL004', '1', '1 MSA 800GB 12G SAS MU 2.5in SSD', '1 MSA 800GB 12G SAS MU 2.5in SSD', '56300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('9', 'N9X91A', 'MODEL005', '1', '1 MSA 1.6TB 12G SAS MU 2.5in SSD', '1 MSA 1.6TB 12G SAS MU 2.5in SSD', '98400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('10', 'N9X92A', 'MODEL006', '1', '1 MSA 3.2TB 12G SAS MU 2.5in SSD', '1 MSA 3.2TB 12G SAS MU 2.5in SSD', '188400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('11', 'Q0F76A', 'MODEL007', '1', '1 MSA 400GB 12G SAS ME LFF CC SSD(Converter)', '1 MSA 400GB 12G SAS ME LFF CC SSD(Converter)', '65600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('12', 'Q0F77A', 'MODEL008', '1', '1 MSA 800GB 12G SAS ME LFF CC SSD(Converter)', '1 MSA 800GB 12G SAS ME LFF CC SSD(Converter)', '131000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('13', 'J9F50A', 'MODEL009', '1', 'HP MSA 1TB 12G SAS 7.2K 2.5in 512e HDD', 'HP MSA 1TB 12G SAS 7.2K 2.5in 512e HDD', '17600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('14', 'J9F51A', 'MODEL010', '1', 'HP MSA 2TB 12G SAS 7.2K 2.5in 512e HDD', 'HP MSA 2TB 12G SAS 7.2K 2.5in 512e HDD', '29400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('15', 'J9F44A', 'MODEL011', '1', '1 MSA 300GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 300GB 12G SAS 10K 2.5in ENT HDD', '9500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('16', 'J9F46A', 'MODEL012', '1', '1 MSA 600GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 600GB 12G SAS 10K 2.5in ENT HDD', '12900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('17', 'J9F47A', 'MODEL013', '1', '1 MSA 900GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 900GB 12G SAS 10K 2.5in ENT HDD', '16500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('18', 'J9F48A', 'MODEL014', '1', '1 MSA 1.2TB 12G SAS 10K 2.5in ENT HDD', '1 MSA 1.2TB 12G SAS 10K 2.5in ENT HDD', '19900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('19', 'J9F49A', 'MODEL015', '1', '1 MSA 1.8TB 12G SAS 10K 2.5in 512e HDD', '1 MSA 1.8TB 12G SAS 10K 2.5in 512e HDD', '29400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('20', 'J9F40A', 'MODEL016', '1', 'HP MSA 300GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 300GB 12G SAS 15K 2.5in ENT HDD', '11800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('21', 'J9F41A', 'MODEL017', '1', 'HP MSA 450GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 450GB 12G SAS 15K 2.5in ENT HDD', '15300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('22', 'J9F42A', 'MODEL018', '1', 'HP MSA 600GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 600GB 12G SAS 15K 2.5in ENT HDD', '16500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('23', 'J9V68A', 'MODEL019', '1', 'HP MSA 300GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 300GB 12G SAS 15K 3.5in CC HDD', '15300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('24', 'J9V69A', 'MODEL020', '1', 'HP MSA 450GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 450GB 12G SAS 15K 3.5in CC HDD', '17600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('25', 'J9V70A', 'MODEL021', '1', 'HP MSA 600GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 600GB 12G SAS 15K 3.5in CC HDD', '18800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('26', 'K2Q82A', 'MODEL022', '1', 'HP MSA 4TB 12G SAS 7.2K 3.5in MDL HDD', 'HP MSA 4TB 12G SAS 7.2K 3.5in MDL HDD', '18800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('27', 'J9F43A', 'MODEL023', '1', 'HP MSA 6TB 12G SAS 7.2K 3.5in MDL HDD', 'HP MSA 6TB 12G SAS 7.2K 3.5in MDL HDD', '27000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('28', 'N9X93A', 'MODEL024', '1', '1 MSA 2TB 12G SAS 7.2K 3.5in 512n HDD', '1 MSA 2TB 12G SAS 7.2K 3.5in 512n HDD', '12900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('29', 'M0S90A', 'MODEL025', '1', '1 MSA 8TB 12G SAS 7.2K 3.5in 512e HDD', '1 MSA 8TB 12G SAS 7.2K 3.5in 512e HDD', '35200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('30', 'Q0F74A', 'MODEL026', '1', '1 MSA 2042 SAN DC ME LFF Storage', '1 MSA 2042 SAN DC ME LFF Storage', '465700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('31', 'Q0F72A', 'MODEL027', '1', '1 MSA 2042 SAN DC ME SFF Stor', '1 MSA 2042 SAN DC ME SFF Stor', '465700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('32', 'Q0F75A', 'MODEL028', '1', '1 MSA 2042 SAS DC ME LFF Storage', '1 MSA 2042 SAS DC ME LFF Storage', '465700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('33', 'Q0F73A', 'MODEL029', '1', '1 MSA 2042 SAS DC ME SFF Storage', '1 MSA 2042 SAS DC ME SFF Storage', '465700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('34', 'Q0F05A', 'MODEL030', '1', '1 MSA 2042 SAN DC LFF Storage', '1 MSA 2042 SAN DC LFF Storage', '445000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('35', 'Q0F06A', 'MODEL031', '1', '1 MSA 2042 SAN DC SFF Storage', '1 MSA 2042 SAN DC SFF Storage', '445000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('36', 'Q0F07A', 'MODEL032', '1', '1 MSA 2042 SAS DC LFF Storage', '1 MSA 2042 SAS DC LFF Storage', '445000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('37', 'Q0F08A', 'MODEL033', '1', '1 MSA 2042 SAS DC SFF Storage', '1 MSA 2042 SAS DC SFF Storage', '445000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('38', 'N9X95A', 'MODEL034', '1', '1 MSA 400GB 12G SAS MU 2.5in SSD', '1 MSA 400GB 12G SAS MU 2.5in SSD', '40300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('39', 'N9X96A', 'MODEL035', '1', '1 MSA 800GB 12G SAS MU 2.5in SSD', '1 MSA 800GB 12G SAS MU 2.5in SSD', '56300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('40', 'N9X91A', 'MODEL036', '1', '1 MSA 1.6TB 12G SAS MU 2.5in SSD', '1 MSA 1.6TB 12G SAS MU 2.5in SSD', '98400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('41', 'N9X92A', 'MODEL037', '1', '1 MSA 3.2TB 12G SAS MU 2.5in SSD', '1 MSA 3.2TB 12G SAS MU 2.5in SSD', '188400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('42', 'Q0F76A', 'MODEL038', '1', '1 MSA 400GB 12G SAS ME LFF CC SSD(Converter)', '1 MSA 400GB 12G SAS ME LFF CC SSD(Converter)', '65600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('43', 'Q0F77A', 'MODEL039', '1', '1 MSA 800GB 12G SAS ME LFF CC SSD(Converter)', '1 MSA 800GB 12G SAS ME LFF CC SSD(Converter)', '131000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('44', 'J9F50A', 'MODEL040', '1', 'HP MSA 1TB 12G SAS 7.2K 2.5in 512e HDD', 'HP MSA 1TB 12G SAS 7.2K 2.5in 512e HDD', '17600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('45', 'J9F51A', 'MODEL041', '1', 'HP MSA 2TB 12G SAS 7.2K 2.5in 512e HDD', 'HP MSA 2TB 12G SAS 7.2K 2.5in 512e HDD', '29400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('46', 'J9F44A', 'MODEL042', '1', '1 MSA 300GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 300GB 12G SAS 10K 2.5in ENT HDD', '9500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('47', 'J9F46A', 'MODEL043', '1', '1 MSA 600GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 600GB 12G SAS 10K 2.5in ENT HDD', '12900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('48', 'J9F47A', 'MODEL044', '1', '1 MSA 900GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 900GB 12G SAS 10K 2.5in ENT HDD', '16500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('49', 'J9F48A', 'MODEL045', '1', '1 MSA 1.2TB 12G SAS 10K 2.5in ENT HDD', '1 MSA 1.2TB 12G SAS 10K 2.5in ENT HDD', '19900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('50', 'J9F49A', 'MODEL046', '1', '1 MSA 1.8TB 12G SAS 10K 2.5in 512e HDD', '1 MSA 1.8TB 12G SAS 10K 2.5in 512e HDD', '29400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('51', 'J9F40A', 'MODEL047', '1', 'HP MSA 300GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 300GB 12G SAS 15K 2.5in ENT HDD', '11800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('52', 'J9F41A', 'MODEL048', '1', 'HP MSA 450GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 450GB 12G SAS 15K 2.5in ENT HDD', '15300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('53', 'J9F42A', 'MODEL049', '1', 'HP MSA 600GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 600GB 12G SAS 15K 2.5in ENT HDD', '16500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('54', 'J9V68A', 'MODEL050', '1', 'HP MSA 300GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 300GB 12G SAS 15K 3.5in CC HDD', '15300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('55', 'J9V69A', 'MODEL051', '1', 'HP MSA 450GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 450GB 12G SAS 15K 3.5in CC HDD', '17600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('56', 'J9V70A', 'MODEL052', '1', 'HP MSA 600GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 600GB 12G SAS 15K 3.5in CC HDD', '18800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('57', 'K2Q82A', 'MODEL053', '1', 'HP MSA 4TB 12G SAS 7.2K 3.5in MDL HDD', 'HP MSA 4TB 12G SAS 7.2K 3.5in MDL HDD', '18800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('58', 'J9F43A', 'MODEL054', '1', 'HP MSA 6TB 12G SAS 7.2K 3.5in MDL HDD', 'HP MSA 6TB 12G SAS 7.2K 3.5in MDL HDD', '27000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('59', 'N9X93A', 'MODEL055', '1', '1 MSA 2TB 12G SAS 7.2K 3.5in 512n HDD', '1 MSA 2TB 12G SAS 7.2K 3.5in 512n HDD', '12900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('60', 'M0S90A', 'MODEL056', '1', '1 MSA 8TB 12G SAS 7.2K 3.5in 512e HDD', '1 MSA 8TB 12G SAS 7.2K 3.5in 512e HDD', '35200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('61', 'M0S96A', 'MODEL057', '1', 'HP MSA 2040 ES LFF Disk Enclosure', 'HP MSA 2040 ES LFF Disk Enclosure', '129000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('62', 'AJ941A', 'MODEL058', '1', 'HP D2700 Disk Enclosure', 'HP D2700 Disk Enclosure', '99500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('63', 'C8R23A', 'MODEL059', '1', 'HP MSA 2040 8Gb SW FC SFP 4 Pk', 'HP MSA 2040 8Gb SW FC SFP 4 Pk', '7200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('64', 'C8R24A', 'MODEL060', '1', 'HP MSA 2040 16Gb SW FC SFP 4 Pk', 'HP MSA 2040 16Gb SW FC SFP 4 Pk', '26600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('65', 'C8R25A', 'MODEL061', '1', 'HP MSA 2040 10Gb SW iSCSI SFP 4 Pk', 'HP MSA 2040 10Gb SW iSCSI SFP 4 Pk', '25500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('66', 'C8S75A', 'MODEL062', '1', 'HP MSA 2040 1Gb SW iSCSI SFP 4 Pk (Includes four x 1Gb SW iSCSI SFPs )', 'HP MSA 2040 1Gb SW iSCSI SFP 4 Pk (Includes four x 1Gb SW iSCSI SFPs )', '16500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('67', 'N9X16A', 'MODEL063', '1', '1 SV3200 4x1GbE iSCSI SFF Storage', '1 SV3200 4x1GbE iSCSI SFF Storage', '225900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('68', 'N9X17A', 'MODEL064', '1', '1 SV3200 4x1GbE iSCSI LFF Storage', '1 SV3200 4x1GbE iSCSI LFF Storage', '225900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('69', 'N9X18A', 'MODEL065', '1', '1 SV3200 8x1GbE iSCSI SFF Storage', '1 SV3200 8x1GbE iSCSI SFF Storage', '226000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('70', 'N9X19A', 'MODEL066', '1', '1 SV3200 8x1GbE iSCSI LFF Storage', '1 SV3200 8x1GbE iSCSI LFF Storage', '226000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('71', 'N9X24A', 'MODEL067', '1', '1 SV3200 4x16Gb FC SFF Storage', '1 SV3200 4x16Gb FC SFF Storage', '342500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('72', 'N9X25A', 'MODEL068', '1', '1 SV3200 4x16Gb FC LFF Storage', '1 SV3200 4x16Gb FC LFF Storage', '342500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('73', 'N9X22A', 'MODEL069', '1', '1 SV3200 4x10GBase-T SFF Storage', '1 SV3200 4x10GBase-T SFF Storage', '231700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('74', 'N9X23A', 'MODEL070', '1', '1 SV3200 4x10GBase-T LFF Storage', '1 SV3200 4x10GBase-T LFF Storage', '231700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('75', 'N9X14A', 'MODEL071', '1', '1 SV3000 300GB 12G SAS 15K SFF HDD', '1 SV3000 300GB 12G SAS 15K SFF HDD', '14200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('76', 'N9X15A', 'MODEL072', '1', '1 SV3000 600GB 12G SAS 15K SFF HDD', '1 SV3000 600GB 12G SAS 15K SFF HDD', '22000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('77', 'N9X04A', 'MODEL073', '1', '1 SV3000 300GB 12G SAS 10K SFF HDD', '1 SV3000 300GB 12G SAS 10K SFF HDD', '9500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('78', 'N9X05A', 'MODEL074', '1', '1 SV3000 600GB 12G SAS 10K SFF HDD', '1 SV3000 600GB 12G SAS 10K SFF HDD', '12500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('79', 'N9X06A', 'MODEL075', '1', '1 SV3000 900GB 12G SAS 10K SFF HDD', '1 SV3000 900GB 12G SAS 10K SFF HDD', '17600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('80', 'N9X07A', 'MODEL076', '1', '1 SV3000 1.2TB 12G SAS 10K SFF HDD', '1 SV3000 1.2TB 12G SAS 10K SFF HDD', '22000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('81', 'N9X08A', 'MODEL077', '1', '1 SV3000 1.8TB 12G SAS 10K SFF HDD', '1 SV3000 1.8TB 12G SAS 10K SFF HDD', '29500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('82', 'N9X09A', 'MODEL078', '1', '1 SV3000 2TB 12G SAS 7.2K SFF MDL HDD', '1 SV3000 2TB 12G SAS 7.2K SFF MDL HDD', '27000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('83', 'N9X10A', 'MODEL079', '1', '1 SV3000 2TB 12G SAS 7.2K LFF MDL HDD', '1 SV3000 2TB 12G SAS 7.2K LFF MDL HDD', '14200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('84', 'N9X11A', 'MODEL080', '1', '1 SV3000 4TB 12G SAS 7.2K LFF MDL HDD', '1 SV3000 4TB 12G SAS 7.2K LFF MDL HDD', '23500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('85', 'N9X12A', 'MODEL081', '1', '1 SV3000 6TB 12G SAS 7.2K LFF MDL HDD', '1 SV3000 6TB 12G SAS 7.2K LFF MDL HDD', '30500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('86', 'N9X01A', 'MODEL082', '1', '1 SV3000 8Gb 2-pack FC SFP+ XCVR', '1 SV3000 8Gb 2-pack FC SFP+ XCVR', '5900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('87', 'N9X02A', 'MODEL083', '1', '1 SV3000 16Gb 2-pack FC SFP+ XCVR', '1 SV3000 16Gb 2-pack FC SFP+ XCVR', '19900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('88', 'N9X03A', 'MODEL084', '1', '1 SV3000 10Gb 2-pack iSCSI SFP XCVR', '1 SV3000 10Gb 2-pack iSCSI SFP XCVR', '18800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('89', 'N9Y66A', 'MODEL085', '1', '1 SV3200 Advanced Data Services LTU', '1 SV3200 Advanced Data Services LTU', '79000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('90', 'P9V08A', 'MODEL086', '1', '1 SV3200 Migration Manager LTU', '1 SV3200 Migration Manager LTU', '3600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('91', 'WS-C2960C-8PC-L', 'MODEL087', '2', 'Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', 'Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', '20000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('92', 'WS-C2960C-8TC-L', 'MODEL088', '2', 'Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', 'Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '15200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('93', 'WS-C2960C-8TC-S', 'MODEL089', '2', 'Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', 'Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '11400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('94', 'WS-C2960CPD-8PT-L', 'MODEL090', '2', 'Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', 'Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', '18100', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('95', 'WS-C2960CPD-8TT-L', 'MODEL091', '2', 'Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', 'Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', '15200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);
INSERT INTO `product_owner` VALUES ('96', 'WS-C2960C-12PC-L', 'MODEL092', '2', 'Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', 'Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', '22800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', null);

-- ----------------------------
-- Table structure for product_vender
-- ----------------------------
DROP TABLE IF EXISTS `product_vender`;
CREATE TABLE `product_vender` (
  `product_vender_id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`product_vender_id`,`model`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_vender
-- ----------------------------
INSERT INTO `product_vender` VALUES ('1', 'SV3200', '1', '1 5 Year Proactive Care Next Business Day StoreVirtual 3200 Service', '1 5 Year Proactive Care Next Business Day StoreVirtual 3200 Service', '60970', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('2', 'SV3200', '1', '1 5 Year Proactive Care 24x7 StoreVirtual 3200 Service', '1 5 Year Proactive Care 24x7 StoreVirtual 3200 Service', '107840', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('3', 'MSA1040', '1', '1 5 year Proactive Care 24x7 MSA2000 G3 Arrays Service', '1 5 year Proactive Care 24x7 MSA2000 G3 Arrays Service', '96690', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('4', 'MSA1040', '1', '1 5 year Proactive Care Next business day MSA2000 G3 Arrays Service', '1 5 year Proactive Care Next business day MSA2000 G3 Arrays Service', '58750', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('5', 'MSA2042', '1', '1 5 Year Proactive Care 24x7 MSA 2042 Storage Service', '1 5 Year Proactive Care 24x7 MSA 2042 Storage Service', '129450', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('6', 'MSA2042', '1', '1 5 Year Proactive Care Next Business Day MSA 2042 Storage Service', '1 5 Year Proactive Care Next Business Day MSA 2042 Storage Service', '91440', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('7', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('8', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('9', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('10', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD , Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', '1 Year Onsite 8x5xNBD , Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('11', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD , Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', '1 Year Onsite 8x5xNBD , Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('12', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD ,Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 8x5xNBD ,Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('13', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('14', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('15', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('16', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 , Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', '1 Year Onsite 24x7x4 , Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('17', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 , Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', '1 Year Onsite 24x7x4 , Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);
INSERT INTO `product_vender` VALUES ('18', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 ,Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 24x7x4 ,Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', null);

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
INSERT INTO `province` VALUES ('1', '10', 'กรุงเทพมหานคร   ', '0', '0', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-22 23:40:33', '1');
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
INSERT INTO `tbl_users` VALUES ('2', 'supachai@wisadev.com', '$2y$10$I5FpXKlnpaj8WYAWvSkgBuO3Hc.jr.k7sjwbr.QNy0qinDCqVzR0i', 'Supachai Wisachai', '0917750586', '5', '2', null, null, '0', '1', '2017-06-11 16:56:35', '1', '2017-06-24 18:09:06');
INSERT INTO `tbl_users` VALUES ('3', 'manager@wisadev.com', '$2y$10$dj.u.qiqcj7Y9Db5oK3QJuygwyi.Z7ceQH2F6A34cGUbkuWpyDi.2', 'Manager', '0917750586', '2', '2', null, null, '0', '1', '2017-06-11 17:24:57', null, null);
INSERT INTO `tbl_users` VALUES ('4', 'employee@wsiadev.com', '$2y$10$olThVYD4MwDAGAIZOf0KxelUk.gkOdpkahzWvgVKwK2g/dF6Zks7.', 'Employee', '0917750586', '3', '3', null, null, '0', '1', '2017-06-11 17:26:02', null, null);
