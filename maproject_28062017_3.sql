/*
Navicat MySQL Data Transfer

Source Server         : MysqlServer
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : maproject

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-07-11 01:26:01
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
INSERT INTO `ci_sessions` VALUES ('2039d4d4a1bc43aeff1c26d8e9cc96b3', '::1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:54.0) Gecko/20100101 Firefox/54.0', '1499710985', 'a:8:{s:9:\"user_data\";s:0:\"\";s:6:\"userId\";s:1:\"1\";s:4:\"role\";s:1:\"1\";s:13:\"menu_group_id\";s:1:\"1\";s:8:\"roleText\";s:20:\"System Administrator\";s:4:\"name\";s:12:\"System Admin\";s:10:\"isLoggedIn\";b:1;s:17:\"flash:new:success\";s:178:\"ทางเราได้รับคำขอจากท่านเรียบร้อยแล้ว กรุณารอทางเราติดต่อครับ\";}');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of discount_of_contract
-- ----------------------------
INSERT INTO `discount_of_contract` VALUES ('1', '1', '0', 'บริการ 1 ปี', '1', '2017-06-22 00:00:00', '1', '2017-06-25 00:21:10', '1');
INSERT INTO `discount_of_contract` VALUES ('2', '2', '1', 'บริการ 2 ปี', '1', '2017-06-22 00:00:00', '1', '2017-06-25 00:21:26', '1');
INSERT INTO `discount_of_contract` VALUES ('3', '3', '2', 'บริการ 3 ปี', '1', '2017-06-22 00:00:00', '1', '2017-06-25 00:21:48', '1');
INSERT INTO `discount_of_contract` VALUES ('4', '4', '3', 'บริการ 4 ปี', '1', '2017-06-22 00:00:00', '1', '2017-06-25 00:21:56', '1');
INSERT INTO `discount_of_contract` VALUES ('5', '5', '4', 'บริการ 5 ปี', '1', '2017-06-22 00:00:00', '1', '2017-06-25 00:22:04', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of discount_of_qty
-- ----------------------------
INSERT INTO `discount_of_qty` VALUES ('1', '1', '1', '0', 'จำนวนอุปรกรณ์ซ้ำกัน 1 ชิ้น', '1', '2017-06-22 00:00:00', '1', '2017-06-25 00:23:26', '1');
INSERT INTO `discount_of_qty` VALUES ('2', '2', '2', '30', 'จำนวนอุปรกรณ์ซ้ำกัน 2 ชิ้น', '1', '2017-06-22 00:00:00', '1', '2017-06-25 00:23:36', '1');
INSERT INTO `discount_of_qty` VALUES ('3', '5', '99', '50', 'จำนวนอุปรกรณ์ซ้ำกัน 5 ชิ้น ขึ้นไป', '1', '2017-06-22 00:00:00', '1', '2017-06-25 00:24:03', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of discount_sla_type
-- ----------------------------
INSERT INTO `discount_sla_type` VALUES ('1', 'GOLD', 'Gold typee', '75', '85', '1', '1', '2017-06-22 00:00:00', '1', '2017-06-24 23:08:16', '1');
INSERT INTO `discount_sla_type` VALUES ('2', 'SILVER', 'Silver type', '85', '90', '1', '1', '2017-06-22 00:00:00', '1', '2017-06-22 00:00:00', '1');
INSERT INTO `discount_sla_type` VALUES ('3', 'BRONZ', 'Bronze type', '90', '93', '1', '1', '2017-06-22 00:00:00', '1', '2017-06-24 21:15:30', '1');
INSERT INTO `discount_sla_type` VALUES ('4', 'GP', 'GP type', '5', '10', '0', '1', '2017-06-22 00:00:00', '1', '2017-06-22 00:00:00', '1');

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
INSERT INTO `menu` VALUES ('12', 'product_vendor', 'Product Vendor', 'fa fa-circle-o', '10', '300', '1', '2017-06-24 17:59:35', '1', null, null);
INSERT INTO `menu` VALUES ('13', 'product_brand', 'Product Brand', 'fa fa-circle-o', '10', '100', '1', '2017-06-24 17:59:37', '1', null, null);
INSERT INTO `menu` VALUES ('14', '#', 'Document', 'fa fa-file-text-o', '0', '100', '1', '2017-06-24 17:59:16', '1', null, null);
INSERT INTO `menu` VALUES ('15', 'order', 'Orders', 'fa fa-circle-o', '14', '100', '1', '2017-06-24 18:02:33', '1', null, null);
INSERT INTO `menu` VALUES ('16', 'order_sale', 'Orders (Sale)', 'fa fa-circle-o', '14', '200', '1', '2017-06-24 18:03:37', '1', null, null);

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
-- Table structure for orders
-- ----------------------------
DROP TABLE IF EXISTS `orders`;
CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(128) DEFAULT NULL,
  `order_date` datetime NOT NULL,
  `company` varchar(128) NOT NULL,
  `address` varchar(512) NOT NULL,
  `tel` varchar(15) NOT NULL,
  `email` varchar(128) NOT NULL,
  `order_status_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` decimal(11,4) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `create_date` datetime NOT NULL,
  `create_by` int(11) NOT NULL,
  `modified_date` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of orders
-- ----------------------------
INSERT INTO `orders` VALUES ('1', '5a4e4905eb1cd2acd6bc79f1c58b3fe9', '2017-07-10 20:54:28', 'Tony Stark', '', '123456789', 'abc@gmail.com', '1', '4', '79660.3500', '1', '2017-07-10 20:54:28', '1', '2017-07-10 20:54:28', '1');
INSERT INTO `orders` VALUES ('2', '771fe90bc96f592c77e1ffd5abb0c8b7', '2017-07-10 20:55:32', 'Tony Stark', '', '123456789', 'abc@gmail.com', '1', '4', '79660.3500', '1', '2017-07-10 20:55:32', '1', '2017-07-10 20:55:32', '1');
INSERT INTO `orders` VALUES ('3', 'fe177dab4bc2f1e99b14877142726d88', '2017-07-10 23:34:09', 'Tony Stark', '', '123456789', 'supachai.wisa@gmail.com', '1', '4', '79660.3500', '1', '2017-07-10 23:34:09', '1', '2017-07-10 23:34:09', '1');
INSERT INTO `orders` VALUES ('4', 'b06c38942d1affa1ba27de70112bb49e', '2017-07-11 00:51:55', 'Tony Stark', '', '123456789', 'abc@gmail.com', '1', '0', '0.0000', '1', '2017-07-11 00:51:55', '1', '2017-07-11 00:51:55', '1');
INSERT INTO `orders` VALUES ('5', 'c0b777bfa17c8a4d7a772a8b821f6d9e', '2017-07-11 01:07:13', 'Tony Stark', '', '123456789', 'abc@gmail.com', '1', '8', '172132.3500', '1', '2017-07-11 01:07:13', '1', '2017-07-11 01:07:13', '1');
INSERT INTO `orders` VALUES ('6', '29c3e1c3ac4b4c1b1a3b113c9d627569', '2017-07-11 01:19:33', 'Tony Stark', '', '123456789', 'abc@gmail.com', '1', '8', '1379323.2000', '1', '2017-07-11 01:19:33', '1', '2017-07-11 01:19:33', '1');
INSERT INTO `orders` VALUES ('7', '1d58ddb871e927291df134b22dc67ee3', '2017-07-11 01:21:42', 'Tony Stark', '', '123456789', 'abc@gmail.com', '1', '8', '1849320.0000', '1', '2017-07-11 01:21:42', '1', '2017-07-11 01:21:42', '1');

-- ----------------------------
-- Table structure for order_detail
-- ----------------------------
DROP TABLE IF EXISTS `order_detail`;
CREATE TABLE `order_detail` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `line_number` int(11) NOT NULL,
  `product_owner_id` int(11) NOT NULL,
  `province_id` int(10) NOT NULL,
  `is_have_product` tinyint(1) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `is_product_owner` tinyint(1) NOT NULL,
  `product_vendor_id` int(11) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  `type_description` varchar(255) DEFAULT NULL,
  `full_price` decimal(10,4) DEFAULT NULL,
  `dealer_price` decimal(10,4) DEFAULT NULL,
  `discount_sla_type_id` int(11) DEFAULT NULL,
  `discount_sla_type_value` decimal(11,4) DEFAULT NULL,
  `discount_of_contract_value` decimal(11,4) DEFAULT NULL,
  `discount_of_qty_value` decimal(11,4) DEFAULT NULL,
  `province_name` varchar(255) DEFAULT NULL,
  `pm_time_value` decimal(11,0) DEFAULT NULL,
  `lb_year_value` decimal(11,4) DEFAULT NULL,
  `pm_time_qty` int(11) DEFAULT NULL,
  `lb_year_qty` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `total` decimal(11,4) DEFAULT NULL,
  PRIMARY KEY (`order_id`,`line_number`,`product_owner_id`,`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of order_detail
-- ----------------------------
INSERT INTO `order_detail` VALUES ('1', '1', '2', '10', '1', '', '1', '0', 'GOLD', 'Gold typee', '229900.0000', '0.0000', '1', '75.0000', '1.0000', '30.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '79660.3500');
INSERT INTO `order_detail` VALUES ('1', '2', '0', '10', '0', 'Name: 1 MSA 1040 2Prt 1G iSCSI DC SFF Strg , Model: WS-C2960C', '0', '0', '', '', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '0.0000');
INSERT INTO `order_detail` VALUES ('2', '1', '2', '10', '1', '', '1', '0', 'GOLD', 'Gold typee', '229900.0000', '0.0000', '1', '75.0000', '1.0000', '30.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '79660.3500');
INSERT INTO `order_detail` VALUES ('2', '2', '0', '10', '0', 'Name: 1 MSA 1040 2Prt 1G iSCSI DC SFF Strg , Model: WS-C2960C', '0', '0', '', '', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '0.0000');
INSERT INTO `order_detail` VALUES ('3', '1', '2', '10', '1', '', '1', '0', 'GOLD', 'Gold typee', '229900.0000', '0.0000', '1', '75.0000', '1.0000', '30.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '79660.3500');
INSERT INTO `order_detail` VALUES ('3', '2', '0', '10', '0', 'Name: 1 MSA 1040 2Prt 1G iSCSI DC SFF Strg , Model: WS-C2960C', '0', '0', '', '', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '0.0000');
INSERT INTO `order_detail` VALUES ('5', '1', '2', '10', '1', '', '1', '0', 'GOLD', 'Gold typee', '229900.0000', '0.0000', '1', '75.0000', '1.0000', '30.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '79660.3500');
INSERT INTO `order_detail` VALUES ('5', '2', '3', '10', '1', '', '1', '0', 'GOLD', 'Gold typee', '208000.0000', '0.0000', '1', '75.0000', '1.0000', '30.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '72072.0000');
INSERT INTO `order_detail` VALUES ('5', '3', '4', '10', '1', '', '0', '9', 'GP', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '0.0000', '1700.0000', '4', '5.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '20400.0000');
INSERT INTO `order_detail` VALUES ('5', '4', '0', '10', '0', 'Name: 1 MSA 1040 2Prt 1G iSCSI DC SFF Strg , Model: WS-C2960C', '0', '0', '', '', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '0.0000');
INSERT INTO `order_detail` VALUES ('6', '1', '2', '10', '1', '', '0', '2', 'GP', '1 5 Year Proactive Care 24x7 StoreVirtual 3200 Service', '0.0000', '107840.0000', '4', '5.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '1294080.0000');
INSERT INTO `order_detail` VALUES ('6', '2', '3', '10', '1', '', '1', '0', 'SILVER', 'Silver type', '208000.0000', '0.0000', '2', '85.0000', '1.0000', '30.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '43243.2000');
INSERT INTO `order_detail` VALUES ('6', '3', '4', '10', '1', '', '0', '14', 'GP', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '0.0000', '3500.0000', '4', '5.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '42000.0000');
INSERT INTO `order_detail` VALUES ('6', '4', '0', '10', '0', 'Name: 1 MSA 1040 2Prt FC DC SFF Strg , Model: SV3200', '0', '0', '', '', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '0.0000');
INSERT INTO `order_detail` VALUES ('7', '1', '2', '10', '1', '', '0', '1', 'GP', '1 5 Year Proactive Care Next Business Day StoreVirtual 3200 Service', '0.0000', '60970.0000', '4', '5.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '731640.0000');
INSERT INTO `order_detail` VALUES ('7', '2', '3', '10', '1', '', '0', '6', 'GP', '1 5 Year Proactive Care Next Business Day MSA 2042 Storage Service', '0.0000', '91440.0000', '4', '5.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '1097280.0000');
INSERT INTO `order_detail` VALUES ('7', '3', '4', '10', '1', '', '0', '9', 'GP', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '0.0000', '1700.0000', '4', '5.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '20400.0000');
INSERT INTO `order_detail` VALUES ('7', '4', '0', '10', '0', 'Name: 1 MSA 1040 2Prt 1G iSCSI DC SFF Strg , Model: WS-C2960C', '0', '0', '', '', '0.0000', '0.0000', '0', '0.0000', '0.0000', '0.0000', 'สระบุรี', '0', '0.0000', '2', '2', '2', '0.0000');

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
INSERT INTO `product_owner` VALUES ('1', 'E7V99A', 'MSA1040', '1', '1 MSA 1040 2Prt FC DC LFF Strg', '1 MSA 1040 2Prt FC DC LFF Strg', '358000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('2', 'E7W00A', 'SV3200', '1', '1 MSA 1040 2Prt FC DC SFF Strg', '1 MSA 1040 2Prt FC DC SFF Strg', '229900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('3', 'E7W01A', 'MSA2042', '1', '1 MSA 1040 2Prt 1G iSCSI DC LFF Strg', '1 MSA 1040 2Prt 1G iSCSI DC LFF Strg', '208000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('4', 'E7W02A', 'WS-C2960C', '1', '1 MSA 1040 2Prt 1G iSCSI DC SFF Strg', '1 MSA 1040 2Prt 1G iSCSI DC SFF Strg', '210500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('5', 'K2Q90A', 'MODEL001', '1', '1 MSA 1040 2Prt SAS DC LFF Strg', '1 MSA 1040 2Prt SAS DC LFF Strg', '220000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('6', 'K2Q89A', 'MODEL002', '1', '1 MSA 1040 2Prt SAS DC SFF Strg', '1 MSA 1040 2Prt SAS DC SFF Strg', '225500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('7', 'N9X95A', 'MODEL003', '1', '1 MSA 400GB 12G SAS MU 2.5in SSD', '1 MSA 400GB 12G SAS MU 2.5in SSD', '40300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('8', 'N9X96A', 'MODEL004', '1', '1 MSA 800GB 12G SAS MU 2.5in SSD', '1 MSA 800GB 12G SAS MU 2.5in SSD', '56300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('9', 'N9X91A', 'MODEL005', '1', '1 MSA 1.6TB 12G SAS MU 2.5in SSD', '1 MSA 1.6TB 12G SAS MU 2.5in SSD', '98400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('10', 'N9X92A', 'MODEL006', '1', '1 MSA 3.2TB 12G SAS MU 2.5in SSD', '1 MSA 3.2TB 12G SAS MU 2.5in SSD', '188400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('11', 'Q0F76A', 'MODEL007', '1', '1 MSA 400GB 12G SAS ME LFF CC SSD(Converter)', '1 MSA 400GB 12G SAS ME LFF CC SSD(Converter)', '65600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('12', 'Q0F77A', 'MODEL008', '1', '1 MSA 800GB 12G SAS ME LFF CC SSD(Converter)', '1 MSA 800GB 12G SAS ME LFF CC SSD(Converter)', '131000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('13', 'J9F50A', 'MODEL009', '1', 'HP MSA 1TB 12G SAS 7.2K 2.5in 512e HDD', 'HP MSA 1TB 12G SAS 7.2K 2.5in 512e HDD', '17600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('14', 'J9F51A', 'MODEL010', '1', 'HP MSA 2TB 12G SAS 7.2K 2.5in 512e HDD', 'HP MSA 2TB 12G SAS 7.2K 2.5in 512e HDD', '29400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('15', 'J9F44A', 'MODEL011', '1', '1 MSA 300GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 300GB 12G SAS 10K 2.5in ENT HDD', '9500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('16', 'J9F46A', 'MODEL012', '1', '1 MSA 600GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 600GB 12G SAS 10K 2.5in ENT HDD', '12900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('17', 'J9F47A', 'MODEL013', '1', '1 MSA 900GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 900GB 12G SAS 10K 2.5in ENT HDD', '16500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('18', 'J9F48A', 'MODEL014', '1', '1 MSA 1.2TB 12G SAS 10K 2.5in ENT HDD', '1 MSA 1.2TB 12G SAS 10K 2.5in ENT HDD', '19900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('19', 'J9F49A', 'MODEL015', '1', '1 MSA 1.8TB 12G SAS 10K 2.5in 512e HDD', '1 MSA 1.8TB 12G SAS 10K 2.5in 512e HDD', '29400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('20', 'J9F40A', 'MODEL016', '1', 'HP MSA 300GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 300GB 12G SAS 15K 2.5in ENT HDD', '11800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('21', 'J9F41A', 'MODEL017', '1', 'HP MSA 450GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 450GB 12G SAS 15K 2.5in ENT HDD', '15300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('22', 'J9F42A', 'MODEL018', '1', 'HP MSA 600GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 600GB 12G SAS 15K 2.5in ENT HDD', '16500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('23', 'J9V68A', 'MODEL019', '1', 'HP MSA 300GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 300GB 12G SAS 15K 3.5in CC HDD', '15300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('24', 'J9V69A', 'MODEL020', '1', 'HP MSA 450GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 450GB 12G SAS 15K 3.5in CC HDD', '17600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('25', 'J9V70A', 'MODEL021', '1', 'HP MSA 600GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 600GB 12G SAS 15K 3.5in CC HDD', '18800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('26', 'K2Q82A', 'MODEL022', '1', 'HP MSA 4TB 12G SAS 7.2K 3.5in MDL HDD', 'HP MSA 4TB 12G SAS 7.2K 3.5in MDL HDD', '18800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('27', 'J9F43A', 'MODEL023', '1', 'HP MSA 6TB 12G SAS 7.2K 3.5in MDL HDD', 'HP MSA 6TB 12G SAS 7.2K 3.5in MDL HDD', '27000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('28', 'N9X93A', 'MODEL024', '1', '1 MSA 2TB 12G SAS 7.2K 3.5in 512n HDD', '1 MSA 2TB 12G SAS 7.2K 3.5in 512n HDD', '12900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('29', 'M0S90A', 'MODEL025', '1', '1 MSA 8TB 12G SAS 7.2K 3.5in 512e HDD', '1 MSA 8TB 12G SAS 7.2K 3.5in 512e HDD', '35200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('30', 'Q0F74A', 'MODEL026', '1', '1 MSA 2042 SAN DC ME LFF Storage', '1 MSA 2042 SAN DC ME LFF Storage', '465700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('31', 'Q0F72A', 'MODEL027', '1', '1 MSA 2042 SAN DC ME SFF Stor', '1 MSA 2042 SAN DC ME SFF Stor', '465700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('32', 'Q0F75A', 'MODEL028', '1', '1 MSA 2042 SAS DC ME LFF Storage', '1 MSA 2042 SAS DC ME LFF Storage', '465700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('33', 'Q0F73A', 'MODEL029', '1', '1 MSA 2042 SAS DC ME SFF Storage', '1 MSA 2042 SAS DC ME SFF Storage', '465700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('34', 'Q0F05A', 'MODEL030', '1', '1 MSA 2042 SAN DC LFF Storage', '1 MSA 2042 SAN DC LFF Storage', '445000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('35', 'Q0F06A', 'MODEL031', '1', '1 MSA 2042 SAN DC SFF Storage', '1 MSA 2042 SAN DC SFF Storage', '445000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('36', 'Q0F07A', 'MODEL032', '1', '1 MSA 2042 SAS DC LFF Storage', '1 MSA 2042 SAS DC LFF Storage', '445000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('37', 'Q0F08A', 'MODEL033', '1', '1 MSA 2042 SAS DC SFF Storage', '1 MSA 2042 SAS DC SFF Storage', '445000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('38', 'N9X95A', 'MODEL034', '1', '1 MSA 400GB 12G SAS MU 2.5in SSD', '1 MSA 400GB 12G SAS MU 2.5in SSD', '40300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('39', 'N9X96A', 'MODEL035', '1', '1 MSA 800GB 12G SAS MU 2.5in SSD', '1 MSA 800GB 12G SAS MU 2.5in SSD', '56300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('40', 'N9X91A', 'MODEL036', '1', '1 MSA 1.6TB 12G SAS MU 2.5in SSD', '1 MSA 1.6TB 12G SAS MU 2.5in SSD', '98400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('41', 'N9X92A', 'MODEL037', '1', '1 MSA 3.2TB 12G SAS MU 2.5in SSD', '1 MSA 3.2TB 12G SAS MU 2.5in SSD', '188400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('42', 'Q0F76A', 'MODEL038', '1', '1 MSA 400GB 12G SAS ME LFF CC SSD(Converter)', '1 MSA 400GB 12G SAS ME LFF CC SSD(Converter)', '65600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('43', 'Q0F77A', 'MODEL039', '1', '1 MSA 800GB 12G SAS ME LFF CC SSD(Converter)', '1 MSA 800GB 12G SAS ME LFF CC SSD(Converter)', '131000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('44', 'J9F50A', 'MODEL040', '1', 'HP MSA 1TB 12G SAS 7.2K 2.5in 512e HDD', 'HP MSA 1TB 12G SAS 7.2K 2.5in 512e HDD', '17600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('45', 'J9F51A', 'MODEL041', '1', 'HP MSA 2TB 12G SAS 7.2K 2.5in 512e HDD', 'HP MSA 2TB 12G SAS 7.2K 2.5in 512e HDD', '29400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('46', 'J9F44A', 'MODEL042', '1', '1 MSA 300GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 300GB 12G SAS 10K 2.5in ENT HDD', '9500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('47', 'J9F46A', 'MODEL043', '1', '1 MSA 600GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 600GB 12G SAS 10K 2.5in ENT HDD', '12900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('48', 'J9F47A', 'MODEL044', '1', '1 MSA 900GB 12G SAS 10K 2.5in ENT HDD', '1 MSA 900GB 12G SAS 10K 2.5in ENT HDD', '16500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('49', 'J9F48A', 'MODEL045', '1', '1 MSA 1.2TB 12G SAS 10K 2.5in ENT HDD', '1 MSA 1.2TB 12G SAS 10K 2.5in ENT HDD', '19900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('50', 'J9F49A', 'MODEL046', '1', '1 MSA 1.8TB 12G SAS 10K 2.5in 512e HDD', '1 MSA 1.8TB 12G SAS 10K 2.5in 512e HDD', '29400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('51', 'J9F40A', 'MODEL047', '1', 'HP MSA 300GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 300GB 12G SAS 15K 2.5in ENT HDD', '11800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('52', 'J9F41A', 'MODEL048', '1', 'HP MSA 450GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 450GB 12G SAS 15K 2.5in ENT HDD', '15300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('53', 'J9F42A', 'MODEL049', '1', 'HP MSA 600GB 12G SAS 15K 2.5in ENT HDD', 'HP MSA 600GB 12G SAS 15K 2.5in ENT HDD', '16500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('54', 'J9V68A', 'MODEL050', '1', 'HP MSA 300GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 300GB 12G SAS 15K 3.5in CC HDD', '15300', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('55', 'J9V69A', 'MODEL051', '1', 'HP MSA 450GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 450GB 12G SAS 15K 3.5in CC HDD', '17600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('56', 'J9V70A', 'MODEL052', '1', 'HP MSA 600GB 12G SAS 15K 3.5in CC HDD', 'HP MSA 600GB 12G SAS 15K 3.5in CC HDD', '18800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('57', 'K2Q82A', 'MODEL053', '1', 'HP MSA 4TB 12G SAS 7.2K 3.5in MDL HDD', 'HP MSA 4TB 12G SAS 7.2K 3.5in MDL HDD', '18800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('58', 'J9F43A', 'MODEL054', '1', 'HP MSA 6TB 12G SAS 7.2K 3.5in MDL HDD', 'HP MSA 6TB 12G SAS 7.2K 3.5in MDL HDD', '27000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('59', 'N9X93A', 'MODEL055', '1', '1 MSA 2TB 12G SAS 7.2K 3.5in 512n HDD', '1 MSA 2TB 12G SAS 7.2K 3.5in 512n HDD', '12900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('60', 'M0S90A', 'MODEL056', '1', '1 MSA 8TB 12G SAS 7.2K 3.5in 512e HDD', '1 MSA 8TB 12G SAS 7.2K 3.5in 512e HDD', '35200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('61', 'M0S96A', 'MODEL057', '1', 'HP MSA 2040 ES LFF Disk Enclosure', 'HP MSA 2040 ES LFF Disk Enclosure', '129000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('62', 'AJ941A', 'MODEL058', '1', 'HP D2700 Disk Enclosure', 'HP D2700 Disk Enclosure', '99500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('63', 'C8R23A', 'MODEL059', '1', 'HP MSA 2040 8Gb SW FC SFP 4 Pk', 'HP MSA 2040 8Gb SW FC SFP 4 Pk', '7200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('64', 'C8R24A', 'MODEL060', '1', 'HP MSA 2040 16Gb SW FC SFP 4 Pk', 'HP MSA 2040 16Gb SW FC SFP 4 Pk', '26600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('65', 'C8R25A', 'MODEL061', '1', 'HP MSA 2040 10Gb SW iSCSI SFP 4 Pk', 'HP MSA 2040 10Gb SW iSCSI SFP 4 Pk', '25500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('66', 'C8S75A', 'MODEL062', '1', 'HP MSA 2040 1Gb SW iSCSI SFP 4 Pk (Includes four x 1Gb SW iSCSI SFPs )', 'HP MSA 2040 1Gb SW iSCSI SFP 4 Pk (Includes four x 1Gb SW iSCSI SFPs )', '16500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('67', 'N9X16A', 'MODEL063', '1', '1 SV3200 4x1GbE iSCSI SFF Storage', '1 SV3200 4x1GbE iSCSI SFF Storage', '225900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('68', 'N9X17A', 'MODEL064', '1', '1 SV3200 4x1GbE iSCSI LFF Storage', '1 SV3200 4x1GbE iSCSI LFF Storage', '225900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('69', 'N9X18A', 'MODEL065', '1', '1 SV3200 8x1GbE iSCSI SFF Storage', '1 SV3200 8x1GbE iSCSI SFF Storage', '226000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('70', 'N9X19A', 'MODEL066', '1', '1 SV3200 8x1GbE iSCSI LFF Storage', '1 SV3200 8x1GbE iSCSI LFF Storage', '226000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('71', 'N9X24A', 'MODEL067', '1', '1 SV3200 4x16Gb FC SFF Storage', '1 SV3200 4x16Gb FC SFF Storage', '342500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('72', 'N9X25A', 'MODEL068', '1', '1 SV3200 4x16Gb FC LFF Storage', '1 SV3200 4x16Gb FC LFF Storage', '342500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('73', 'N9X22A', 'MODEL069', '1', '1 SV3200 4x10GBase-T SFF Storage', '1 SV3200 4x10GBase-T SFF Storage', '231700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('74', 'N9X23A', 'MODEL070', '1', '1 SV3200 4x10GBase-T LFF Storage', '1 SV3200 4x10GBase-T LFF Storage', '231700', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('75', 'N9X14A', 'MODEL071', '1', '1 SV3000 300GB 12G SAS 15K SFF HDD', '1 SV3000 300GB 12G SAS 15K SFF HDD', '14200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('76', 'N9X15A', 'MODEL072', '1', '1 SV3000 600GB 12G SAS 15K SFF HDD', '1 SV3000 600GB 12G SAS 15K SFF HDD', '22000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('77', 'N9X04A', 'MODEL073', '1', '1 SV3000 300GB 12G SAS 10K SFF HDD', '1 SV3000 300GB 12G SAS 10K SFF HDD', '9500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('78', 'N9X05A', 'MODEL074', '1', '1 SV3000 600GB 12G SAS 10K SFF HDD', '1 SV3000 600GB 12G SAS 10K SFF HDD', '12500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('79', 'N9X06A', 'MODEL075', '1', '1 SV3000 900GB 12G SAS 10K SFF HDD', '1 SV3000 900GB 12G SAS 10K SFF HDD', '17600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('80', 'N9X07A', 'MODEL076', '1', '1 SV3000 1.2TB 12G SAS 10K SFF HDD', '1 SV3000 1.2TB 12G SAS 10K SFF HDD', '22000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('81', 'N9X08A', 'MODEL077', '1', '1 SV3000 1.8TB 12G SAS 10K SFF HDD', '1 SV3000 1.8TB 12G SAS 10K SFF HDD', '29500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('82', 'N9X09A', 'MODEL078', '1', '1 SV3000 2TB 12G SAS 7.2K SFF MDL HDD', '1 SV3000 2TB 12G SAS 7.2K SFF MDL HDD', '27000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('83', 'N9X10A', 'MODEL079', '1', '1 SV3000 2TB 12G SAS 7.2K LFF MDL HDD', '1 SV3000 2TB 12G SAS 7.2K LFF MDL HDD', '14200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('84', 'N9X11A', 'MODEL080', '1', '1 SV3000 4TB 12G SAS 7.2K LFF MDL HDD', '1 SV3000 4TB 12G SAS 7.2K LFF MDL HDD', '23500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('85', 'N9X12A', 'MODEL081', '1', '1 SV3000 6TB 12G SAS 7.2K LFF MDL HDD', '1 SV3000 6TB 12G SAS 7.2K LFF MDL HDD', '30500', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('86', 'N9X01A', 'MODEL082', '1', '1 SV3000 8Gb 2-pack FC SFP+ XCVR', '1 SV3000 8Gb 2-pack FC SFP+ XCVR', '5900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('87', 'N9X02A', 'MODEL083', '1', '1 SV3000 16Gb 2-pack FC SFP+ XCVR', '1 SV3000 16Gb 2-pack FC SFP+ XCVR', '19900', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('88', 'N9X03A', 'MODEL084', '1', '1 SV3000 10Gb 2-pack iSCSI SFP XCVR', '1 SV3000 10Gb 2-pack iSCSI SFP XCVR', '18800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('89', 'N9Y66A', 'MODEL085', '1', '1 SV3200 Advanced Data Services LTU', '1 SV3200 Advanced Data Services LTU', '79000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('90', 'P9V08A', 'MODEL086', '1', '1 SV3200 Migration Manager LTU', '1 SV3200 Migration Manager LTU', '3600', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('91', 'WS-C2960C-8PC-L', 'MODEL087', '2', 'Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', 'Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', '20000', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('92', 'WS-C2960C-8TC-L', 'MODEL088', '2', 'Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', 'Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '15200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('93', 'WS-C2960C-8TC-S', 'MODEL089', '2', 'Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', 'Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '11400', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('94', 'WS-C2960CPD-8PT-L', 'MODEL090', '2', 'Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', 'Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', '18100', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('95', 'WS-C2960CPD-8TT-L', 'MODEL091', '2', 'Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', 'Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', '15200', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');
INSERT INTO `product_owner` VALUES ('96', 'WS-C2960C-12PC-L', 'MODEL092', '2', 'Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', 'Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', '22800', '1', '2017-06-24 17:48:12', '1', '2017-06-24 17:53:20', '1');

-- ----------------------------
-- Table structure for product_vendor
-- ----------------------------
DROP TABLE IF EXISTS `product_vendor`;
CREATE TABLE `product_vendor` (
  `product_vendor_id` int(11) NOT NULL AUTO_INCREMENT,
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
  PRIMARY KEY (`product_vendor_id`,`model`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of product_vendor
-- ----------------------------
INSERT INTO `product_vendor` VALUES ('1', 'SV3200', '1', '1 5 Year Proactive Care Next Business Day StoreVirtual 3200 Service', '1 5 Year Proactive Care Next Business Day StoreVirtual 3200 Service', '60970', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('2', 'SV3200', '1', '1 5 Year Proactive Care 24x7 StoreVirtual 3200 Service', '1 5 Year Proactive Care 24x7 StoreVirtual 3200 Service', '107840', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('3', 'MSA1040', '1', '1 5 year Proactive Care 24x7 MSA2000 G3 Arrays Service', '1 5 year Proactive Care 24x7 MSA2000 G3 Arrays Service', '96690', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('4', 'MSA1040', '1', '1 5 year Proactive Care Next business day MSA2000 G3 Arrays Service', '1 5 year Proactive Care Next business day MSA2000 G3 Arrays Service', '58750', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('5', 'MSA2042', '1', '1 5 Year Proactive Care 24x7 MSA 2042 Storage Service', '1 5 Year Proactive Care 24x7 MSA 2042 Storage Service', '129450', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('6', 'MSA2042', '1', '1 5 Year Proactive Care Next Business Day MSA 2042 Storage Service', '1 5 Year Proactive Care Next Business Day MSA 2042 Storage Service', '91440', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('7', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('8', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('9', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '1 Year Onsite 8x5xNBD , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('10', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD , Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', '1 Year Onsite 8x5xNBD , Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('11', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD , Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', '1 Year Onsite 8x5xNBD , Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('12', 'WS-C2960C', '2', '1 Year Onsite 8x5xNBD ,Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 8x5xNBD ,Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', '1700', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('13', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE PoE, 2 x Dual Uplink, Lan Base', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('14', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Base', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('15', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '1 Year Onsite 24x7x4 , Catalyst 2960C Switch 8 FE, 2 x Dual Uplink, Lan Lite', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('16', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 , Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', '1 Year Onsite 24x7x4 , Catalyst 2960C PD PSE Switch 8 FE PoE, 2 x 1G, PoE+ LAN Base', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('17', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 , Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', '1 Year Onsite 24x7x4 , Catalyst 2960C PD Switch 8 FE, 2 x 1G, PoE+ LAN Base', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');
INSERT INTO `product_vendor` VALUES ('18', 'WS-C2960C', '2', '1 Year Onsite 24x7x4 ,Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', '1 Year Onsite 24x7x4 ,Catalyst 2960C Switch 12 FE PoE, 2 x Dual Uplink, Lan Base', '3500', '1', '2017-06-24 17:48:05', '1', '2017-06-24 17:53:27', '1');

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
INSERT INTO `province` VALUES ('1', '10', 'กรุงเทพมหานคร   ', '2000', '1000', '2', '1', '2017-06-18 17:38:20', '1', '2017-06-22 23:40:33', '1');
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
