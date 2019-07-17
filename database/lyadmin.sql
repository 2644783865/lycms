/*
Navicat MySQL Data Transfer

Source Server         : 45.78.56.222
Source Server Version : 50556
Source Host           : 45.78.56.222:3306
Source Database       : lyadmin

Target Server Type    : MYSQL
Target Server Version : 50556
File Encoding         : 65001

Date: 2019-07-17 19:47:05
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for ad_positions
-- ----------------------------
DROP TABLE IF EXISTS `ad_positions`;
CREATE TABLE `ad_positions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '品牌名称',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态:1启用,2禁用',
  `remark` varchar(512) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '说明',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of ad_positions
-- ----------------------------
INSERT INTO `ad_positions` VALUES ('1', '博客首页banner', '1', '', '2019-07-04 23:35:33', '2019-07-05 13:11:51', null);
INSERT INTO `ad_positions` VALUES ('2', '博客侧边栏1', '1', '', '2019-07-04 23:35:56', '2019-07-05 13:01:35', null);
INSERT INTO `ad_positions` VALUES ('3', '博客侧边栏2', '1', '', '2019-07-04 23:36:07', '2019-07-16 22:22:21', null);
INSERT INTO `ad_positions` VALUES ('4', '博客标签云', '1', '', '2019-07-05 12:57:27', '2019-07-05 13:11:31', null);
INSERT INTO `ad_positions` VALUES ('5', '企业站首页banner', '1', '', '2019-07-11 19:08:51', '2019-07-11 19:08:51', null);

-- ----------------------------
-- Table structure for admins
-- ----------------------------
DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `super` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '超级管理员',
  `email` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of admins
-- ----------------------------
INSERT INTO `admins` VALUES ('1', '超级管理员', '1', 'admin@qq.com', '$2y$10$8oOraAG6u7P4PhOUjZNuBehG7.ZA6GBEsxJA70HaSlbFNuzQAyKQO', '/uploads/image/201907/2258154904.jpg', null, '2019-07-04 22:57:12', '2019-07-04 22:58:18', null);
INSERT INTO `admins` VALUES ('2', '测试帐号', '2', 'test@qq.com', '$2y$10$tZTC/ZsaclqZa798.zJBqeYD0K9SwW6blF/MbywVRUl0WrPPJQ/Te', '/uploads/image/201907/1014461401.jpg', null, '2019-07-13 10:14:52', '2019-07-13 10:14:52', null);

-- ----------------------------
-- Table structure for ads
-- ----------------------------
DROP TABLE IF EXISTS `ads`;
CREATE TABLE `ads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `position_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '广告位ID',
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `subtitle` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '副标题',
  `image` varchar(256) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '广告图',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `status` tinyint(4) NOT NULL DEFAULT '1' COMMENT '状态：1启用,2禁用',
  `target_type` int(11) NOT NULL DEFAULT '0' COMMENT '链接类型',
  `target` text COLLATE utf8mb4_unicode_ci COMMENT '链接内容',
  `start_time` timestamp NULL DEFAULT NULL COMMENT '开始时间',
  `end_time` timestamp NULL DEFAULT NULL COMMENT '结束时间',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ads_position_id_index` (`position_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of ads
-- ----------------------------
INSERT INTO `ads` VALUES ('1', '4', 'PHP', '', '', '1', '1', '1', '/tag/PHP', '2019-06-08 00:00:00', '2020-01-19 00:00:00', '2019-07-05 12:58:18', '2019-07-05 12:58:18', null);
INSERT INTO `ads` VALUES ('2', '4', 'MySQL', '', '', '1', '1', '1', '/tag/MySQL', '2019-06-08 00:00:00', '2020-01-19 00:00:00', '2019-07-05 12:58:28', '2019-07-05 12:58:28', null);
INSERT INTO `ads` VALUES ('3', '1', 'banner', '', '/uploads/image/201907/1321367837.jpg', '0', '1', '1', 'http://www.baidu.com', '2019-06-07 00:00:00', '2020-01-05 00:00:00', '2019-07-05 12:59:21', '2019-07-05 13:21:38', null);
INSERT INTO `ads` VALUES ('4', '2', 'banner', '', '/uploads/image/201907/1300302160.jpg', '0', '1', '1', 'http://www.baidu.com', '2019-06-07 00:00:00', '2020-01-05 00:00:00', '2019-07-05 12:59:27', '2019-07-05 13:00:32', null);
INSERT INTO `ads` VALUES ('5', '3', 'banner', '', '/uploads/image/201907/1323391799.jpg', '0', '1', '1', 'http://www.baidu.com', '2019-06-07 00:00:00', '2020-01-05 00:00:00', '2019-07-05 12:59:30', '2019-07-05 13:23:40', null);
INSERT INTO `ads` VALUES ('6', '5', '1', '1', '/uploads/image/201907/1910155979.jpg', '1', '1', '1', '/', '2019-07-06 00:00:00', '2020-01-26 00:00:00', '2019-07-11 19:10:20', '2019-07-11 19:10:20', null);
INSERT INTO `ads` VALUES ('7', '5', '2', '', '/uploads/image/201907/1911257376.jpg', '2', '1', '1', '/', '2019-06-07 00:00:00', '2020-01-05 00:00:00', '2019-07-11 19:11:36', '2019-07-11 19:11:36', null);

-- ----------------------------
-- Table structure for areas
-- ----------------------------
DROP TABLE IF EXISTS `areas`;
CREATE TABLE `areas` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `short_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '简称',
  `full_name` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '全称',
  `depth` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '深度',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `path` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '路径',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `areas_parent_id_index` (`parent_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of areas
-- ----------------------------

-- ----------------------------
-- Table structure for attributes
-- ----------------------------
DROP TABLE IF EXISTS `attributes`;
CREATE TABLE `attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '编码',
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `alias_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '别名',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '备选值',
  `tree_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '树ID',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `input` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '类型',
  `unit` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '单位',
  `placeholder` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '提示文字',
  `remark` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attributes_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of attributes
-- ----------------------------
INSERT INTO `attributes` VALUES ('1', 'blog_content', '博客内容', '内容', null, '0', '1', 'html', '', '', '', '2019-07-04 23:28:03', '2019-07-04 23:28:03', null);
INSERT INTO `attributes` VALUES ('2', 'blog_summary', '博客摘要', '摘要', null, '0', '1', 'text', '', '', '', '2019-07-04 23:29:11', '2019-07-04 23:29:11', null);
INSERT INTO `attributes` VALUES ('3', 'blog_category', '博客分类', '分类', null, '1', '1', 'tree', '', '', '', '2019-07-04 23:32:14', '2019-07-04 23:32:14', null);
INSERT INTO `attributes` VALUES ('4', 'blog_tag', '博客标签', '标签', null, '0', '1', 'tags', '', '', '', '2019-07-04 23:33:56', '2019-07-04 23:33:56', null);
INSERT INTO `attributes` VALUES ('5', 'album', '相册', '相册', null, '0', '1', 'images', '', '', '', '2019-07-07 22:08:04', '2019-07-07 22:08:04', null);
INSERT INTO `attributes` VALUES ('6', 'specs', '规格', '规格', null, '0', '1', 'specification', '', '', '', '2019-07-07 22:08:22', '2019-07-07 22:08:22', null);
INSERT INTO `attributes` VALUES ('7', 'attrs', '属性基本信息', '基本信息', null, '0', '1', 'attribute', '', '', '', '2019-07-07 22:08:34', '2019-07-07 22:18:48', null);
INSERT INTO `attributes` VALUES ('8', 'html_content', 'HTML内容', '内容', null, '0', '1', 'html', '', '', '', '2019-07-07 22:09:28', '2019-07-07 22:09:28', null);
INSERT INTO `attributes` VALUES ('9', 'subtitle', '副标题', '副标题', null, '0', '1', 'text', '', '', '', '2019-07-07 22:19:14', '2019-07-07 22:20:10', null);
INSERT INTO `attributes` VALUES ('10', 'weight', '重量', '重量', null, '0', '1', 'number', 'g', '', '', '2019-07-07 22:21:03', '2019-07-07 22:21:03', null);
INSERT INTO `attributes` VALUES ('11', 'price', '价格', '价格', null, '0', '1', 'number', '元', '', '', '2019-07-07 22:21:20', '2019-07-07 22:21:20', null);
INSERT INTO `attributes` VALUES ('12', 'brand', '品牌', '品牌', null, '8', '1', 'tree', '', '', '', '2019-07-07 22:28:57', '2019-07-07 22:28:57', null);
INSERT INTO `attributes` VALUES ('13', 'link', '链接', '链接地址', null, '0', '1', 'string', '', '', '', '2019-07-11 14:37:36', '2019-07-11 14:37:36', null);
INSERT INTO `attributes` VALUES ('14', 'company_category', '类别', '类别', null, '18', '1', 'tree', '', '', '', '2019-07-11 19:07:33', '2019-07-11 19:07:33', null);
INSERT INTO `attributes` VALUES ('15', 'intro', '前言', '前言', null, '0', '1', 'text', '', '', '', '2019-07-13 10:05:51', '2019-07-13 10:05:51', null);
INSERT INTO `attributes` VALUES ('16', 'mobile', '手机', '手机', null, '0', '1', 'mobile', '', '', '', '2019-07-17 19:30:38', '2019-07-17 19:30:38', null);
INSERT INTO `attributes` VALUES ('17', 'tel', '电话', '电话', null, '0', '1', 'tel', '', '', '', '2019-07-17 19:30:47', '2019-07-17 19:30:47', null);
INSERT INTO `attributes` VALUES ('18', 'file', '附件', '附件', null, '0', '1', 'file', '', '', '', '2019-07-17 19:31:02', '2019-07-17 19:31:02', null);
INSERT INTO `attributes` VALUES ('19', 'video', '视频', '视频', null, '0', '1', 'file', '', '', '', '2019-07-17 19:31:10', '2019-07-17 19:31:10', null);
INSERT INTO `attributes` VALUES ('20', 'location', '位置', '位置', null, '0', '1', 'location', '', '', '', '2019-07-17 19:31:48', '2019-07-17 19:31:48', null);
INSERT INTO `attributes` VALUES ('21', 'md_content', '内容', '内容', null, '0', '1', 'markdown', '', '', '', '2019-07-17 19:33:08', '2019-07-17 19:33:08', null);
INSERT INTO `attributes` VALUES ('22', 'email', '邮箱', '邮箱', null, '0', '1', 'email', '', '', '', '2019-07-17 19:42:17', '2019-07-17 19:42:17', null);

-- ----------------------------
-- Table structure for configs
-- ----------------------------
DROP TABLE IF EXISTS `configs`;
CREATE TABLE `configs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'CODE',
  `value` text COLLATE utf8mb4_unicode_ci COMMENT '值',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `configs_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of configs
-- ----------------------------
INSERT INTO `configs` VALUES ('1', 'config_site', '{\"name\":\"lycms\",\"keyword\":\"lycms\",\"description\":\"lycms\"}', '2019-07-04 23:36:32', '2019-07-04 23:36:32');

-- ----------------------------
-- Table structure for content_attributes
-- ----------------------------
DROP TABLE IF EXISTS `content_attributes`;
CREATE TABLE `content_attributes` (
  `content_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '内容id',
  `attribute_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '属性id',
  `attribute_value` text COLLATE utf8mb4_unicode_ci COMMENT '属性值',
  UNIQUE KEY `content_attributes_content_id_attribute_id_unique` (`content_id`,`attribute_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of content_attributes
-- ----------------------------
INSERT INTO `content_attributes` VALUES ('1', '1', '<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<span>直到今天，PHP 仍有很多糟糕的东西，例如许多核心功能仍然存在不一致的方法签名，仍然存在令人混淆的配置设置，仍然会有一些开发者因为知识的缺乏而导致写的代码很糟糕等等。</span>\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	但是，本文我想把目光集中在 PHP 已经改进的地方上面，以及如何写出更加干净和易维护的 PHP 代码。也许你不会改变对 PHP 的看法，但很有可能，你会吃惊于过去几年 PHP 的进步。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	要点：\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<ul class=\"list-paddingleft-2\" style=\"color:#333333;font-family:-apple-system-font, BlinkMacSystemFont, \"font-size:16px;text-align:justify;background-color:#FFFFFF;\">\n	<li>\n		<p>\n			PHP 每年都会推出一个新的版本；\n		</p>\n	</li>\n	<li>\n		<p>\n			自 PHP 5 代之后，其性能不断提升；\n		</p>\n	</li>\n	<li>\n		<p>\n			有框架、包和平台组成的活跃生态系统；\n		</p>\n	</li>\n	<li>\n		<p>\n			过去几年间，PHP 添加了许多新的特性，且现在仍在持续演进。\n		</p>\n	</li>\n	<li>\n		<p>\n			许多工具如静态分析器也越发成熟，未来也将继续发展。\n		</p>\n	</li>\n</ul>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	更新：很多人希望我能够展示一下实际代码，这是我其中一个业余项目的源代码，它是用 PHP 和 Laravel 写的，另外还有一个是我们在办公室负责维护的上百个 OSS 包的列表。\n</p>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</h2>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	回顾历史\n</h2>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	让我们先快速回顾一下 PHP 的版本发布周期。现在 PHP 的版本是 7.3，预计 2019 年末将发布 PHP 7.4，7.4 之后的版本将会是 PHP 8.0。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	从 5.X 版本之后，PHP 核心团队一直在努力每年发布一个新版本，并且在过去的 4 年间，这一目标一直完成得很好。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	大致来说，每个新版本都会用 2 年时间进行积极地支持，然后用一年进行“安全修补”工作。这样做的目的是促使 PHP 开发者尽可能保持最新状态，例如每年都升级比从 5.4 直接跳到 7.0 要简单得多。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	PHP 具体的版本发布情况，可以点击此处。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	搞清楚 PHP 的发展历程后，我们来谈谈大家对 PHP 的常见误解。\n</p>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</h2>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	PHP 的性能\n</h2>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	在 5.X 版本时代，PHP 的性能平均而言是最好的。而在 7.0 时代，大部分的 PHP 核心都从零开始重写了，其性能能够达到之前的 2-3 倍。口说无凭，幸运的是，有人花了大量时间来测量 PHP 的性能，Kinsta提供了一个很好的更新列表。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	从 7.0 版本以来，PHP 性能就只升不降。PHP web 应用的性能可以和其他语言 web 框架的性能相提并论，甚至更高（具体测试情况可点击该链接：https://github.com/the-benchmarker/web-frameworks）。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	当然，PHP 框架的性能还无法超越 C 和 Rust，但是要比 Rails 或 Django 好，且能够和 ExpressJS 相媲美。\n</p>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</h2>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	框架和生态系统\n</h2>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	在谈到框架时，PHP 已经不再只是 WordPress 了。作为职业的 PHP 开发者，我认为，WordPress 无法从任何层面代表当今的生态系统。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	总体来说，有 2 个主要的 web 应用框架以及一些相对而言较小的框架，如Symfony和Laravel。除此之后，还有 Zend、Yii、Cake、 Code Igniter 等等。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	如果你想了解现代 PHP 开发究竟是什么样子，那么就需要掌握Symfony和Laravel中的一个，这 2 个框架都有庞大的生态系统，包含各种包和产品。从管理面板和客户关系管理系统 (CRM) 到单独的包，从持续集成 (CI) 到性能监视工具，我们有无数的服务如 web 套接字服务器、队列管理器、支付集成等等。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	但是，这些框架都是为实际开发而设计的。如果你需要纯粹的内容管理，WordPress 和 CraftCMS 是理想选择，而且它们还会不断优化。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	衡量 PHP 生态系统目前状态的方法是看一看 Packagist，它是 PHP 主要的包仓库。在过去的时间里，它呈现出了指数式增长的态势，每天 2500 万左右的下载量，足以说明 PHP 生态系统已经不再是过去那种弱者了。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	Packagist网站上列出了过去的包和版本数量：\n</p>\n<p class=\"\" style=\"color:#333333;font-size:16px;background-color:#FFFFFF;text-align:center;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	除了应用框架和内容管理系统 (CMS) 以外，我们还发现，在过去几年，异步框架也崛起了。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	异步框架是指用 PHP 或其它语言编写的框架和服务器，它们能够让用户运行真正异步的 PHP。异步框架的例子包括：Swoole、Amp和ReactPHP。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	由于我们已经进入异步领域，具有大量 IO 的 web 套接字和应用等东西在 PHP 世界中就变得非常重要。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	另外，人们还谈到了内部邮件列表，在邮件列表中，PHP 核心开发者讨论了 PHP 语言的进一步发展，例如增加 libuv 到核心之中。对于不熟悉 libuv 的人来说，libuv 同 Node.js 用于实现其所有异步性的库一模一样。\n</p>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</h2>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	语言本身\n</h2>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	尽管异步 (async) 和等待 (await) 还未面市，但 PHP 在过去几年已经经过了许多改进，下面便是 PHP 新特性的不完全列表：\n</p>\n<ul class=\"list-paddingleft-2\" style=\"color:#333333;font-family:-apple-system-font, BlinkMacSystemFont, \"font-size:16px;text-align:justify;background-color:#FFFFFF;\">\n	<li>\n		<p>\n			短闭包\n		</p>\n	</li>\n	<li>\n		<p>\n			空合并运算符\n		</p>\n	</li>\n	<li>\n		<p>\n			Trait\n		</p>\n	</li>\n	<li>\n		<p>\n			属性类型\n		</p>\n	</li>\n	<li>\n		<p>\n			扩散运算符\n		</p>\n	</li>\n	<li>\n		<p>\n			JIT 编译器\n		</p>\n	</li>\n	<li>\n		<p>\n			FFI\n		</p>\n	</li>\n	<li>\n		<p>\n			匿名类\n		</p>\n	</li>\n	<li>\n		<p>\n			声明返回类型\n		</p>\n	</li>\n	<li>\n		<p>\n			Contemporary cryptography\n		</p>\n	</li>\n	<li>\n		<p>\n			Generators\n		</p>\n	</li>\n	<li>\n		<p>\n			其他\n		</p>\n	</li>\n</ul>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	尽管我们的主题是 PHP 的语言特性，但我还是觉得需要谈一下 PHP 语言的开发流程。虽然社区被允许提出 RFC，但仍有一个活跃的志愿者核心团队在推动PHP 的发展。在添加一个新的语言特性之前，必须要进行投票。只有获得 2/3 多数选票的 RFC 才能被添加到核心中。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	大约有 100 个人可以投票，但你不需要给每个 RFC 投票。核心团队的成员毋庸置疑能够投票，因为他们必须维护代码库。除了他们以外，还有一群人是单独从 PHP 社区中挑选出来的，这些人员包括 PHP 文件的维护人员，PHP 整体项目的贡献者，以及 PHP 社区中颇具威望的开发者。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	虽然大多数核心开发是由志愿者组成的，但其中一名核心 PHP 开发者 Nikita Popov 近期被JetBrains雇佣，并全职负责该语言的开发。另外一个例子是 Linux 基金会决定投资Zend 框架。上述这些雇佣和收购行为确保了未来 PHP 开发的稳定性。\n</p>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</h2>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	工具\n</h2>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	除了核心本身，我们还目睹了过去几年间工具的增长。首先进入我脑海的是静态分析器如 Vimeo 发明的Psalm，以及Phan和 PHPStan。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	这些工具能够静态分析 PHP 代码，并且报告打字错误、可能的 bug 等等。在某些方面，它们提供的功能足以和 TypeScript 相媲美，但目前 PHP 还没有被转编译 (transpile)，因此它并不支持定制句法。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	虽然这意味着我们必须依赖于文档块，但 PHP 的最初发明者 Rasmus Lerdorf 提出了将静态分析引擎添加到核心之中的想法。这个想法潜力巨大，但任务量着实不小。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	提到转编译，由于受到 JavaScript 社区的启发，有许多人试图将 PHP 句法延伸到用户空间中。一个名叫Pre的项目就做了这件事情：它支持新的已经转编译为普通 PHP 代码的 PHP 句法。\n</p>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	虽然这一想法已经在 JavaScript 中得以实现，但只有在提供了适当的集成开发环境 (IDE) 和静态分析支持后，它才能在 PHP 工作。这一想法非常有趣，但还必须不断完善，才能变成“主流”。\n</p>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	<br />\n</h2>\n<h2 style=\"font-size:20px;color:#333333;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	小结\n</h2>\n<p style=\"color:#333333;font-size:16px;text-align:justify;background-color:#FFFFFF;font-family:Arial, sans-serif;\">\n	尽管 PHP 还有很多缺点和遗留问题，但我可以充满信心地说，我喜欢使用它。就我的经验来看，它可以创建可靠、可维护和高质量的软件。如果使用得当，PHP 对于 web 开发来说是个非常棒的选择。\n</p>');
INSERT INTO `content_attributes` VALUES ('1', '2', '直到今天，PHP 仍有很多糟糕的东西，例如许多核心功能仍然存在不一致的方法签名，仍然存在令人混淆的配置设置，仍然会有一些开发者因为知识的缺乏而导致写的代码很糟糕等等。但是，本文我想把目光集中在 PHP 已经改进的地方上面，以及如何写出更加干净和易维护的 PHP 代码。也许你不会改变对 PHP 的看法，但很有可能，你会吃惊于过去几年 PHP 的进步。');
INSERT INTO `content_attributes` VALUES ('1', '3', '2');
INSERT INTO `content_attributes` VALUES ('1', '4', 'PHP7');
INSERT INTO `content_attributes` VALUES ('2', '5', '[\"\\/uploads\\/image\\/201907\\/2217533712.jpg\",\"\\/uploads\\/image\\/201907\\/2217569684.jpg\",\"\\/uploads\\/image\\/201907\\/2218007340.jpg\"]');
INSERT INTO `content_attributes` VALUES ('2', '6', '{\"\\u989c\\u8272\":\"\\u84dd\\u8272,\\u767d\\u8272,\\u9ec4\\u8272,\\u7ea2\\u8272,\\u73ca\\u745a\\u8272,\\u9ed1\\u8272\",\"\\u7248\\u672c\":\"64G,128G,256G\"}');
INSERT INTO `content_attributes` VALUES ('2', '7', '{\"\\u5165\\u7f51\\u578b\\u53f7\":\"A2018\",\"\\u4e0a\\u5e02\\u5e74\\u4efd\":\"2018\\u5e74\",\"\\u4e0a\\u5e02\\u6708\\u4efd\":\"10\\u6708\"}');
INSERT INTO `content_attributes` VALUES ('2', '8', '<img src=\"/uploads/editor/images/201907/41a8fe500e5535ed2e6e7412946eacef.jpg\" alt=\"\" /> <img src=\"/uploads/editor/images/201907/d037a9d10c15bd95c1004bf5f951dbf4.jpg\" alt=\"\" />');
INSERT INTO `content_attributes` VALUES ('2', '9', '新一代iPhoneXR，6.1英寸视网膜显示屏，A12仿生芯片，面容识别，无线充电，支持双卡！');
INSERT INTO `content_attributes` VALUES ('2', '10', '460');
INSERT INTO `content_attributes` VALUES ('2', '11', '5499.00');
INSERT INTO `content_attributes` VALUES ('2', '12', '10');
INSERT INTO `content_attributes` VALUES ('3', '8', '');
INSERT INTO `content_attributes` VALUES ('3', '9', '');
INSERT INTO `content_attributes` VALUES ('3', '13', '/');
INSERT INTO `content_attributes` VALUES ('3', '14', '24');
INSERT INTO `content_attributes` VALUES ('4', '8', '');
INSERT INTO `content_attributes` VALUES ('4', '9', '');
INSERT INTO `content_attributes` VALUES ('4', '13', '');
INSERT INTO `content_attributes` VALUES ('4', '14', '25');
INSERT INTO `content_attributes` VALUES ('5', '8', '');
INSERT INTO `content_attributes` VALUES ('5', '9', 'test');
INSERT INTO `content_attributes` VALUES ('5', '13', 'http://www.baidu.com');
INSERT INTO `content_attributes` VALUES ('5', '14', '26');
INSERT INTO `content_attributes` VALUES ('6', '8', '');
INSERT INTO `content_attributes` VALUES ('6', '9', '');
INSERT INTO `content_attributes` VALUES ('6', '13', '');
INSERT INTO `content_attributes` VALUES ('6', '14', '24');
INSERT INTO `content_attributes` VALUES ('7', '8', '');
INSERT INTO `content_attributes` VALUES ('7', '9', '');
INSERT INTO `content_attributes` VALUES ('7', '13', '');
INSERT INTO `content_attributes` VALUES ('7', '14', '25');
INSERT INTO `content_attributes` VALUES ('8', '8', '');
INSERT INTO `content_attributes` VALUES ('8', '9', '');
INSERT INTO `content_attributes` VALUES ('8', '13', '');
INSERT INTO `content_attributes` VALUES ('8', '14', '24');
INSERT INTO `content_attributes` VALUES ('9', '8', '如果你决定建一个网站，无论是做产品、做服务还是做其他的东西，你都会需要找人来帮你做技术维护，寻找信息来源，组织信息发布方式等等，看起来这一切都不简单。但是万事开头...');
INSERT INTO `content_attributes` VALUES ('9', '14', '22');
INSERT INTO `content_attributes` VALUES ('9', '15', '如果你决定建一个网站，无论是做产品、做服务还是做其他的东西，你都会需要找人来帮你做技术维护，寻找信息来源，组织信息发布方式等等，看起来这一切都不简单。但是万事开头...');
INSERT INTO `content_attributes` VALUES ('10', '8', '无论是刚成立的，还是正在发展的公司，好的网站设计对他们的成功是至关重要的。这能让你即使你现实上是不专业的，如果网站设计得好，看起来也好似大公司或专业的公司一样...');
INSERT INTO `content_attributes` VALUES ('10', '14', '22');
INSERT INTO `content_attributes` VALUES ('10', '15', '无论是刚成立的，还是正在发展的公司，好的网站设计对他们的成功是至关重要的。这能让你即使你现实上是不专业的，如果网站设计得好，看起来也好似大公司或专业的公司一样...');
INSERT INTO `content_attributes` VALUES ('11', '8', '<span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\">昨晚和大家互动，问了大家和PPT有关的事。得到了海量的回复，几乎都是爱与恨的交织。琼瑶阿姨不知怎么看？作为一个对人类伤害最大也是帮助巨大的电脑软件PPT几乎是很多人工作中...</span>');
INSERT INTO `content_attributes` VALUES ('11', '14', '22');
INSERT INTO `content_attributes` VALUES ('11', '15', '昨晚和大家互动，问了大家和PPT有关的事。得到了海量的回复，几乎都是爱与恨的交织。琼瑶阿姨不知怎么看？作为一个对人类伤害最大也是帮助巨大的电脑软件PPT几乎是很多人工作中...');
INSERT INTO `content_attributes` VALUES ('12', '8', '<span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\">在网站建设行业里，一个项目的完成步骤，首先是经过客户和客服的沟通后，然后客服将客户的需求提交给网站设计师，让网站设计师将客户的需求通过设计稿的形式设计下来...</span></span>');
INSERT INTO `content_attributes` VALUES ('12', '14', '22');
INSERT INTO `content_attributes` VALUES ('12', '15', '在网站建设行业里，一个项目的完成步骤，首先是经过客户和客服的沟通后，然后客服将客户的需求提交给网站设计师，让网站设计师将客户的需求通过设计稿的形式设计下来...');
INSERT INTO `content_attributes` VALUES ('13', '8', '<span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\">你，错过了，传统行业的高速发展期！错过了，PC端互联网时代的绝佳机会！你还想错过移动互联网？2014年起，百度移动搜索开始取消PC网页收录。...</span></span></span>');
INSERT INTO `content_attributes` VALUES ('13', '14', '23');
INSERT INTO `content_attributes` VALUES ('13', '15', '你，错过了，传统行业的高速发展期！错过了，PC端互联网时代的绝佳机会！你还想错过移动互联网？2014年起，百度移动搜索开始取消PC网页收录。...');
INSERT INTO `content_attributes` VALUES ('14', '8', '<span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\">我们不再接有关商城网站建设项目，作出这个决定是一个无奈的决定，两三年前，商城网站建设是我们的一个优势项目，经过日积月累，也造就了我们现在一个非常不错的商城系统，毕...</span></span></span></span>');
INSERT INTO `content_attributes` VALUES ('14', '14', '23');
INSERT INTO `content_attributes` VALUES ('14', '15', '我们不再接有关商城网站建设项目，作出这个决定是一个无奈的决定，两三年前，商城网站建设是我们的一个优势项目，经过日积月累，也造就了我们现在一个非常不错的商城系统，毕...');
INSERT INTO `content_attributes` VALUES ('15', '8', '<span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\">笔者作为一个技术员，策划在网站建设行业这行做业务已达四年多，遇到过各类的客户和不同的客户需求，大多数的企业建站客户在策划自已的网站的时候，都是在百度上寻找同行的网...</span></span></span></span></span>');
INSERT INTO `content_attributes` VALUES ('15', '14', '23');
INSERT INTO `content_attributes` VALUES ('15', '15', '笔者作为一个技术员，策划在网站建设行业这行做业务已达四年多，遇到过各类的客户和不同的客户需求，大多数的企业建站客户在策划自已的网站的时候，都是在百度上寻找同行的网...');
INSERT INTO `content_attributes` VALUES ('16', '8', '<span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\"><span style=\"color:#222222;font-family:Consolas, &quot;background-color:#FFFFFF;\">艾迪创想网站建设公司说：微信的受众面特别广，在这样的情况下，如何找到属于自已的客户群体？微信营销怎样来找客户呢？下面介绍几种方法，希望大家可以轻松玩转微信......</span></span></span></span></span></span>');
INSERT INTO `content_attributes` VALUES ('16', '14', '23');
INSERT INTO `content_attributes` VALUES ('16', '15', '艾迪创想网站建设公司说：微信的受众面特别广，在这样的情况下，如何找到属于自已的客户群体？微信营销怎样来找客户呢？下面介绍几种方法，希望大家可以轻松玩转微信......');

-- ----------------------------
-- Table structure for contents
-- ----------------------------
DROP TABLE IF EXISTS `contents`;
CREATE TABLE `contents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '表单ID',
  `title` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '标题',
  `cover` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '封面',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '状态:1启用2禁用',
  `page_view` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '浏览量',
  `top` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '置顶',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contents_title_index` (`title`),
  KEY `contents_form_id_index` (`form_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of contents
-- ----------------------------
INSERT INTO `contents` VALUES ('1', '1', '2019 年，PHP 已不再是当年那个“设计糟糕”的语言', '/uploads/image/201907/0012035078.jpg', '1', '0', '1562256791', '2019-07-05 00:12:51', '2019-07-05 00:13:11', null);
INSERT INTO `contents` VALUES ('2', '2', 'Apple iPhone XR (A2108) 128GB 黄色 移动联通电信4G手机 双卡双待', '/uploads/image/201907/2217469991.jpg', '1', '0', '0', '2019-07-07 22:18:14', '2019-07-07 22:18:14', null);
INSERT INTO `contents` VALUES ('3', '4', '案例1', '/uploads/image/201907/1651513152.jpg', '1', '0', '1562922316', '2019-07-12 16:54:31', '2019-07-12 17:05:16', null);
INSERT INTO `contents` VALUES ('4', '4', '广州锡海净化科技有限公司', '/uploads/image/201907/1002039523.jpg', '1', '0', '1562983400', '2019-07-13 10:02:15', '2019-07-13 10:03:20', null);
INSERT INTO `contents` VALUES ('5', '4', '广州锡海净化科技有限公司', '/uploads/image/201907/1002355397.jpg', '1', '0', '1562983400', '2019-07-13 10:02:39', '2019-07-13 10:03:20', null);
INSERT INTO `contents` VALUES ('6', '4', '广州锡海净化科技有限公司', '/uploads/image/201907/1002498095.jpg', '1', '0', '1562983399', '2019-07-13 10:02:52', '2019-07-13 10:03:19', null);
INSERT INTO `contents` VALUES ('7', '4', '广州锡海净化科技有限公司', '/uploads/image/201907/1003095360.jpg', '1', '0', '1562983399', '2019-07-13 10:03:12', '2019-07-13 10:03:19', null);
INSERT INTO `contents` VALUES ('8', '4', 'test', '/uploads/image/201907/1003502348.jpg', '1', '0', '0', '2019-07-13 10:03:58', '2019-07-13 10:03:58', null);
INSERT INTO `contents` VALUES ('9', '3', '如何一步步开始制作您的网站', '/uploads/image/201907/1006514360.jpg', '1', '0', '1562983673', '2019-07-13 10:07:46', '2019-07-13 10:07:53', null);
INSERT INTO `contents` VALUES ('10', '3', '为什么说好的网站设计对他们的成功是至关重要', '/uploads/image/201907/1009245858.jpg', '1', '0', '1562983981', '2019-07-13 10:09:44', '2019-07-13 10:13:01', null);
INSERT INTO `contents` VALUES ('11', '3', '那些与PPT设计有关的日子_广州网站制作公司', '/uploads/image/201907/1009512569.jpg', '1', '0', '1562983977', '2019-07-13 10:10:14', '2019-07-13 10:12:57', null);
INSERT INTO `contents` VALUES ('12', '3', '网站设计师如何提高客户通过率_广州网站制作公', '/uploads/image/201907/1010331587.jpg', '1', '0', '1562983976', '2019-07-13 10:10:42', '2019-07-13 10:12:56', null);
INSERT INTO `contents` VALUES ('13', '3', '企业网站手机网站建设解决方案_广州网站制作公司', '/uploads/image/201907/1010593170.png', '1', '0', '1562983976', '2019-07-13 10:11:03', '2019-07-13 10:12:56', null);
INSERT INTO `contents` VALUES ('14', '3', '我们不再接有关商城网站建设项目_广州网站制作', '/uploads/image/201907/1011273196.jpg', '1', '0', '1562983975', '2019-07-13 10:11:32', '2019-07-13 10:12:55', null);
INSERT INTO `contents` VALUES ('15', '3', '企业网站建设之如何更好留住用户_广州网站制作', '/uploads/image/201907/1011532825.jpg', '1', '0', '1562983975', '2019-07-13 10:11:59', '2019-07-13 10:12:55', null);
INSERT INTO `contents` VALUES ('16', '3', '微信营销：如何利用QQ来挖掘微信的精准用户', '/uploads/image/201907/1012439572.jpg', '1', '0', '1562983973', '2019-07-13 10:12:49', '2019-07-13 10:12:53', null);

-- ----------------------------
-- Table structure for form_attributes
-- ----------------------------
DROP TABLE IF EXISTS `form_attributes`;
CREATE TABLE `form_attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `form_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '模型id',
  `attribute_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '属性id',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `required` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '必填',
  `show` tinyint(3) unsigned NOT NULL DEFAULT '2' COMMENT '列表显示',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `form_attributes_form_id_attribute_id_unique` (`form_id`,`attribute_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of form_attributes
-- ----------------------------
INSERT INTO `form_attributes` VALUES ('1', '1', '1', '6', '1', '2', null);
INSERT INTO `form_attributes` VALUES ('2', '1', '2', '5', '1', '2', null);
INSERT INTO `form_attributes` VALUES ('3', '1', '3', '1', '1', '1', null);
INSERT INTO `form_attributes` VALUES ('4', '1', '4', '2', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('5', '2', '7', '88', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('6', '2', '8', '99', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('7', '2', '5', '1', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('8', '2', '6', '2', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('9', '2', '9', '0', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('10', '2', '10', '2', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('11', '2', '11', '0', '2', '1', null);
INSERT INTO `form_attributes` VALUES ('12', '2', '12', '0', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('13', '3', '8', '99', '1', '2', null);
INSERT INTO `form_attributes` VALUES ('14', '4', '8', '99', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('15', '4', '13', '3', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('16', '3', '14', '0', '1', '1', null);
INSERT INTO `form_attributes` VALUES ('17', '4', '14', '1', '1', '1', null);
INSERT INTO `form_attributes` VALUES ('18', '4', '9', '0', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('19', '3', '15', '2', '1', '2', null);
INSERT INTO `form_attributes` VALUES ('20', '5', '18', '0', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('21', '5', '19', '0', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('22', '5', '20', '0', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('23', '5', '21', '99', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('24', '5', '16', '0', '2', '2', null);
INSERT INTO `form_attributes` VALUES ('25', '5', '17', '0', '2', '2', null);

-- ----------------------------
-- Table structure for forms
-- ----------------------------
DROP TABLE IF EXISTS `forms`;
CREATE TABLE `forms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '编码',
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `forms_code_unique` (`code`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of forms
-- ----------------------------
INSERT INTO `forms` VALUES ('1', 'blog', '博客', '2019-07-04 22:59:05', '2019-07-04 22:59:05', null);
INSERT INTO `forms` VALUES ('2', 'product', '产品', '2019-07-07 22:08:45', '2019-07-07 22:08:45', null);
INSERT INTO `forms` VALUES ('3', 'news', '新闻资讯', '2019-07-07 22:33:04', '2019-07-07 22:33:04', null);
INSERT INTO `forms` VALUES ('4', 'case', '案例', '2019-07-10 21:48:38', '2019-07-10 21:48:38', null);
INSERT INTO `forms` VALUES ('5', 'deom', 'DEMO', '2019-07-17 19:30:16', '2019-07-17 19:30:16', null);

-- ----------------------------
-- Table structure for menus
-- ----------------------------
DROP TABLE IF EXISTS `menus`;
CREATE TABLE `menus` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '菜单名称',
  `link` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '链接地址',
  `route` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '控制器',
  `icon` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT 'icon',
  `show` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '显示：1显示2不显示',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_parent_id_index` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of menus
-- ----------------------------
INSERT INTO `menus` VALUES ('1', '0', '首页', '/admins/', '', '', '2', '0', '2019-07-10 22:47:03', '2019-07-11 22:25:52', null);
INSERT INTO `menus` VALUES ('2', '0', '系统设置', '', '', 'mdi-settings', '1', '1', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('3', '0', '广告管理', '', '', 'mdi-brightness-auto', '1', '2', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('4', '0', '内容管理', '', '', 'mdi-content-copy', '1', '3', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('5', '2', '用户管理', '/admin/admins', '', '', '1', '1', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('6', '2', '菜单管理', '/admin/menus', 'admin.menu', '', '1', '2', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('7', '2', '配置管理', '/admin/configs', 'admin.config', '', '1', '3', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('8', '3', '广告位管理', '/admin/ad-positions', 'admin.ad-position', '', '1', '1', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('9', '3', '广告管理', '/admin/ads', '', '', '1', '2', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('10', '4', '字段管理', '/admin/attributes', '', '', '1', '1', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('11', '4', '表单管理', '/admin/forms', 'admin.form', '', '1', '3', '2019-07-10 22:47:03', '2019-07-13 10:13:37', null);
INSERT INTO `menus` VALUES ('12', '4', '级联管理', '/admin/trees', 'admin.tree', '', '1', '2', '2019-07-10 22:47:03', '2019-07-13 10:13:44', null);
INSERT INTO `menus` VALUES ('13', '4', '内容管理', '/admin/contents', '', '', '1', '4', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('14', '10', '字段列表', '/admin/attributes', 'admin.attribute', '', '1', '0', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('15', '10', '新增字段', '/admin/attributes/create', 'admin.attribute.create', '', '1', '1', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('16', '10', '编辑字段', '', 'admin.attribute.show', '', '1', '2', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('17', '10', '删除字段', '', 'admin.attribute.delete', '', '2', '3', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('18', '13', '内容列表', '/admin/contents', 'admin.content', '', '1', '0', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('19', '13', '新增内容', '/admin/contents/create', 'admin.content.create', '', '1', '1', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('20', '13', '编辑内容', '', 'admin.content.show', '', '1', '2', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('21', '13', '删除内容', '', 'admin.content.delete', '', '2', '3', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('22', '5', '用户列表', '/admin/admins', 'admin.admin', '', '2', '0', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('23', '5', '新增用户', '/admin/admins/create', 'admin.admin.create', '', '1', '1', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('24', '5', '编辑用户', '', 'admin.admin.show', '', '2', '2', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('25', '5', '删除用户', '', 'admin.admin.delete', '', '2', '3', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('26', '9', '广告列表', '/admin/ads', 'admin.ad', '', '1', '0', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('27', '9', '新增广告', '/admin/ads/create', 'admin.ad.create', '', '1', '1', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('28', '9', '编辑广告', '', 'admin.ad.show', '', '1', '2', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);
INSERT INTO `menus` VALUES ('29', '9', '删除广告', '', 'admin.ad.delete', '', '2', '3', '2019-07-10 22:47:03', '2019-07-10 22:47:03', null);

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('25', '2014_10_12_000000_create_admins_table', '1');
INSERT INTO `migrations` VALUES ('26', '2019_05_16_160202_create_menus_table', '1');
INSERT INTO `migrations` VALUES ('27', '2019_05_20_162919_create_configs_table', '1');
INSERT INTO `migrations` VALUES ('28', '2019_06_04_162148_create_ad_positions_table', '1');
INSERT INTO `migrations` VALUES ('29', '2019_06_04_162212_create_ads_table', '1');
INSERT INTO `migrations` VALUES ('30', '2019_06_05_113021_create_attributes_table', '1');
INSERT INTO `migrations` VALUES ('31', '2019_06_05_160152_create_forms_table', '1');
INSERT INTO `migrations` VALUES ('32', '2019_06_05_160208_create_form_attributes_table', '1');
INSERT INTO `migrations` VALUES ('33', '2019_06_10_144355_create_contents_table', '1');
INSERT INTO `migrations` VALUES ('34', '2019_06_10_145302_create_content_attributes_table', '1');
INSERT INTO `migrations` VALUES ('35', '2019_06_12_125142_create_trees_table', '1');
INSERT INTO `migrations` VALUES ('36', '2019_06_14_173128_create_areas_table', '1');

-- ----------------------------
-- Table structure for trees
-- ----------------------------
DROP TABLE IF EXISTS `trees`;
CREATE TABLE `trees` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `root_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '根ID',
  `parent_id` bigint(20) unsigned NOT NULL DEFAULT '0' COMMENT '父ID',
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '名称',
  `sort` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '排序',
  `depth` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '深度',
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1' COMMENT '状态',
  `path` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '路径',
  `level` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '级别',
  `remark` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '备注',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trees_root_id_index` (`root_id`),
  KEY `trees_parent_id_index` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of trees
-- ----------------------------
INSERT INTO `trees` VALUES ('1', '0', '0', '博客分类', '0', '0', '1', '', '层级1,层级2', '', '2019-07-04 23:29:55', '2019-07-04 23:29:55', null);
INSERT INTO `trees` VALUES ('2', '1', '0', 'PHP', '0', '1', '1', '', '', '', '2019-07-04 23:30:38', '2019-07-04 23:30:38', null);
INSERT INTO `trees` VALUES ('3', '1', '0', '数据库', '0', '1', '1', '', '', '', '2019-07-04 23:30:48', '2019-07-04 23:30:48', null);
INSERT INTO `trees` VALUES ('4', '1', '3', 'MySQL', '0', '2', '1', '3', '', '', '2019-07-04 23:30:56', '2019-07-04 23:30:56', null);
INSERT INTO `trees` VALUES ('5', '1', '3', 'Redis', '0', '2', '1', '3', '', '', '2019-07-04 23:31:05', '2019-07-04 23:31:05', null);
INSERT INTO `trees` VALUES ('6', '1', '0', 'Web前端', '0', '1', '1', '', '', '', '2019-07-04 23:31:32', '2019-07-04 23:31:32', null);
INSERT INTO `trees` VALUES ('7', '1', '0', '随笔', '0', '1', '1', '', '', '', '2019-07-04 23:31:46', '2019-07-04 23:31:46', null);
INSERT INTO `trees` VALUES ('8', '0', '0', '品牌', '0', '0', '1', '', '品类,品牌名称', '', '2019-07-07 22:23:53', '2019-07-11 23:01:36', null);
INSERT INTO `trees` VALUES ('9', '8', '0', '手机品牌', '0', '1', '1', '', '', '', '2019-07-07 22:26:13', '2019-07-07 22:26:13', null);
INSERT INTO `trees` VALUES ('10', '8', '9', 'Apple', '0', '2', '1', '9', '', '', '2019-07-07 22:27:46', '2019-07-07 22:27:46', null);
INSERT INTO `trees` VALUES ('11', '8', '9', '华为', '0', '2', '1', '9', '', '', '2019-07-07 22:27:54', '2019-07-07 22:27:54', null);
INSERT INTO `trees` VALUES ('12', '8', '9', '荣耀', '0', '2', '1', '9', '', '', '2019-07-07 22:27:59', '2019-07-07 22:27:59', null);
INSERT INTO `trees` VALUES ('13', '8', '9', '小米', '0', '2', '1', '9', '', '', '2019-07-07 22:28:03', '2019-07-07 22:28:03', null);
INSERT INTO `trees` VALUES ('14', '8', '9', '一加', '0', '2', '1', '9', '', '', '2019-07-07 22:28:07', '2019-07-07 22:28:07', null);
INSERT INTO `trees` VALUES ('15', '8', '9', 'vivo', '0', '2', '1', '9', '', '', '2019-07-07 22:28:13', '2019-07-07 22:28:13', null);
INSERT INTO `trees` VALUES ('16', '8', '9', '联想', '0', '2', '1', '9', '', '', '2019-07-07 22:28:18', '2019-07-07 22:28:18', null);
INSERT INTO `trees` VALUES ('17', '8', '9', '三星', '0', '2', '1', '9', '', '', '2019-07-07 22:28:23', '2019-07-07 22:28:23', null);
INSERT INTO `trees` VALUES ('18', '0', '0', '企业站分类', '0', '0', '1', '', '大类,小类', '', '2019-07-11 19:04:16', '2019-07-11 23:01:00', null);
INSERT INTO `trees` VALUES ('19', '18', '0', '资讯', '0', '1', '1', '', '', '', '2019-07-11 19:04:29', '2019-07-11 19:04:29', null);
INSERT INTO `trees` VALUES ('20', '18', '0', '案例', '0', '1', '1', '', '', '', '2019-07-11 19:04:35', '2019-07-11 19:04:35', null);
INSERT INTO `trees` VALUES ('21', '18', '19', '方案', '0', '2', '1', '19', '', '', '2019-07-11 19:05:50', '2019-07-11 19:05:50', null);
INSERT INTO `trees` VALUES ('22', '18', '19', '新闻', '0', '2', '1', '19', '', '', '2019-07-11 19:05:58', '2019-07-11 19:05:58', null);
INSERT INTO `trees` VALUES ('23', '18', '19', '观点', '0', '2', '1', '19', '', '', '2019-07-11 19:06:03', '2019-07-11 19:06:03', null);
INSERT INTO `trees` VALUES ('24', '18', '20', '企业网站案例', '0', '2', '1', '20', '', '', '2019-07-11 19:06:24', '2019-07-11 19:06:24', null);
INSERT INTO `trees` VALUES ('25', '18', '20', '商城网站案例', '0', '2', '1', '20', '', '', '2019-07-11 19:06:33', '2019-07-11 19:06:33', null);
INSERT INTO `trees` VALUES ('26', '18', '20', '互联网品牌推广', '0', '2', '1', '20', '', '', '2019-07-11 19:06:52', '2019-07-11 19:06:52', null);
