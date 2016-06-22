/*
Navicat MySQL Data Transfer

Source Server         : 本地
Source Server Version : 50711
Source Host           : localhost:3306
Source Database       : tk

Target Server Type    : MYSQL
Target Server Version : 50711
File Encoding         : 65001

Date: 2016-06-20 16:08:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `site`
-- ----------------------------
DROP TABLE IF EXISTS `site`;
CREATE TABLE `site` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `siteCode` char(15) NOT NULL COMMENT '站点识别码',
  `siteName` char(30) NOT NULL DEFAULT '' COMMENT '站点名',
  `domain` char(50) NOT NULL COMMENT '域名',
  `theme` char(50) NOT NULL DEFAULT 'default' COMMENT '模板',
  `email` char(50) NOT NULL COMMENT '管理员邮箱',
  `sitekey` char(255) NOT NULL DEFAULT '' COMMENT '关键字',
  `siteintro` char(255) NOT NULL DEFAULT '' COMMENT '简介',
  `adminCenter` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否为中心站',
  `siteLogo` char(255) NOT NULL DEFAULT '' COMMENT '站点logo',
  `industryId` char(50) NOT NULL COMMENT '行业',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系站点设置表';

-- ----------------------------
-- Records of site
-- ----------------------------

-- ----------------------------
-- Table structure for `site_meta`
-- ----------------------------
DROP TABLE IF EXISTS `site_meta`;
CREATE TABLE `site_meta` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `siteId` tinyint(1) unsigned NOT NULL COMMENT '站点id',
  `siteCode` char(15) NOT NULL COMMENT '站点识别码',
  `key` char(15) NOT NULL COMMENT '键名',
  `value` char(255) NOT NULL DEFAULT '' COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系站点设置扩展表';

-- ----------------------------
-- Records of site_meta
-- ----------------------------

-- ----------------------------
-- Table structure for `system`
-- ----------------------------
DROP TABLE IF EXISTS `system`;
CREATE TABLE `system` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `systemName` char(30) NOT NULL DEFAULT '' COMMENT '系统名',
  `email` char(50) NOT NULL DEFAULT '' COMMENT '站点邮箱管理员邮箱',
  `siteKey` char(255) NOT NULL DEFAULT '' COMMENT '网站关键字',
  `siteDes` char(255) NOT NULL DEFAULT '' COMMENT '网站简介',
  `listNum` int(2) NOT NULL DEFAULT '12' COMMENT '里表页显示数量',
  `plTime` int(10) NOT NULL DEFAULT '0' COMMENT '评论间隔时间，单位秒',
  `loginKeyOk` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启会员登陆验证码1为开启,0为关闭',
  `loginNum` tinyint(1) NOT NULL DEFAULT '0' COMMENT '账户登录次数限制',
  `addNewsOk` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启投稿功能0为开启，1为关闭',
  `registerOk` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启会员注册0为开启，1为关闭',
  `registerStart` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否开启会员注册0为审核，1为直接通过',
  `smallTextLen` tinyint(3) NOT NULL DEFAULT '100' COMMENT '信息简介截取字数',
  `keyBgColor` char(7) NOT NULL DEFAULT '#FF0000' COMMENT '验证码文字颜色',
  `keyFontColor` char(7) NOT NULL DEFAULT '#FF0000' COMMENT '验证码文字颜色',
  `keyDistColor` char(7) NOT NULL DEFAULT '#FF0000' COMMENT '验证码干扰颜色',
  `plOk` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启评论1为开启，0为关闭',
  `plKeyOk` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启评论验证码1为开启，0为关闭',
  `plNum` tinyint(4) NOT NULL DEFAULT '8' COMMENT '评论列表每页显示数量',
  `gbOk` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启留言1为开启，0为关闭',
  `gbKeyOk` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启留言验证码1为开启，0为关闭',
  `gbNum` tinyint(4) NOT NULL DEFAULT '8' COMMENT '留言列表每页显示数量',
  `theme` char(50) NOT NULL DEFAULT 'Default' COMMENT '模板',
  `logo` char(255) NOT NULL DEFAULT '' COMMENT 'logo',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统总设置';

-- ----------------------------
-- Records of system
-- ----------------------------

-- ----------------------------
-- Table structure for `system_opetion`
-- ----------------------------
DROP TABLE IF EXISTS `system_opetion`;
CREATE TABLE `system_opetion` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `key` char(15) NOT NULL COMMENT '键名',
  `value` char(255) NOT NULL COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='系统扩展表';

-- ----------------------------
-- Records of system_opetion
-- ----------------------------

-- ----------------------------
-- Table structure for `theme`
-- ----------------------------
DROP TABLE IF EXISTS `theme`;
CREATE TABLE `theme` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `themeName` char(50) NOT NULL COMMENT '模板名',
  `themeSetting` longblob NOT NULL COMMENT '模板设置',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='模板设置表';

-- ----------------------------
-- Records of theme
-- ----------------------------

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `siteCode` char(15) NOT NULL COMMENT '站点识别码，这里作为注册来源',
  `userName` char(30) NOT NULL COMMENT '用户名',
  `passWord` char(32) NOT NULL COMMENT '用户密码',
  `niceName` char(50) NOT NULL DEFAULT '' COMMENT '昵称',
  `status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '状态 0未激活 1正常 2锁定',
  `email` char(180) NOT NULL DEFAULT '' COMMENT '邮箱',
  `emailStatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '邮箱状态',
  `mobile` char(32) NOT NULL DEFAULT '' COMMENT '手机',
  `mobileStatus` tinyint(1) NOT NULL DEFAULT '0' COMMENT '手机状态',
  `avartar` char(255) NOT NULL DEFAULT '' COMMENT '头像',
  `regdate` int(10) NOT NULL DEFAULT '0' COMMENT '注册时间',
  `newPlNum` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '新评论数量',
  `newGbNum` smallint(6) unsigned NOT NULL DEFAULT '0' COMMENT '新留言数目',
  `roles` varchar(255) NOT NULL DEFAULT '' COMMENT '用户角色',
  `point` int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  `coin` int(11) NOT NULL DEFAULT '0' COMMENT '金币',
  `money` int(11) NOT NULL DEFAULT '0' COMMENT '钱',
  `lockTime` int(10) NOT NULL DEFAULT '0' COMMENT '帐号锁定期限',
  `passErrorNum` tinyint(1) NOT NULL DEFAULT '0' COMMENT '帐号密码错误次数',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------

-- ----------------------------
-- Table structure for `user_meta`
-- ----------------------------
DROP TABLE IF EXISTS `user_meta`;
CREATE TABLE `user_meta` (
  `id` tinyint(1) unsigned NOT NULL AUTO_INCREMENT COMMENT '主键',
  `uId` tinyint(1) unsigned NOT NULL COMMENT '用户id',
  `siteCode` char(15) NOT NULL COMMENT '站点识别码',
  `key` char(15) NOT NULL COMMENT '键名',
  `value` char(255) NOT NULL DEFAULT '' COMMENT '值',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='用户扩展表';

-- ----------------------------
-- Records of user_meta
-- ----------------------------
