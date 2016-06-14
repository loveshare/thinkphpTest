<?php

$users_single_table = "CREATE TABLE users (
  ID int(11) unsigned NOT NULL auto_increment,
  uName varchar(60) NOT NULL default '',
  uPass char(32) NOT NULL default '',
  uNicename varchar(50) NOT NULL default '',
  userEmail varchar(100) NOT NULL default '',
  userMobile varchar(100) NOT NULL default '',
  userStatus int(11) NOT NULL default '0',
  QQ int(11) NOT NULL default '0',
  weibo char(100) NOT NULL default '',
  roles char(100) NOT NULL default '' COMMENT '用户角色',
  coin int(11) NOT NULL DEFAULT '0' COMMENT '金币',
  point int(11) NOT NULL DEFAULT '0' COMMENT '积分',
  money int(11) NOT NULL DEFAULT '0' COMMENT '钱',
  siteCode char(15) NOT NULL DEFAULT '' COMMENT '识别码',
  avatar char(100) NOT NULL default '',
  newpm int(11) NOT NULL default '0',
  new int(11) NOT NULL default '0',
  errorNum tinyint(1) NOT NULL default '0',
  lockTime int(11) NOT NULL default '0',
  PRIMARY KEY  (ID),
  KEY user_login_key (uName),
  KEY user_nicename (uNicename),
  KEY user_email (userEmail),
  KEY user_mobile (userMobile),
  KEY user_status (userStatus),
  KEY user_qq (QQ),
  KEY user_wb (weibo),
  KEY user_error_num (errorNum),
  KEY user_new (new),
  KEY user_newpm (newpm),
  KEY user_site_code (siteCode),
  KEY user_money (money),
  KEY user_roles (roles),
  KEY user_point (point),
  KEY user_coin (coin),
)";


emailVerified
phoneVerified
lastloginip
lastlogintime
from 来源 pc android ios
tags
payPassword
userRegisteredTime 注册时间
userRegisteredIp 注册IP
siteCode
$usermeta_table = "CREATE TABLE usermeta (
  umId int(11) unsigned NOT NULL auto_increment,
  uId int(11) unsigned NOT NULL default '0',
  umKey char(50) default NULL,
  umValue char(255) default '',
  siteCode char(15) NOT NULL DEFAULT '' COMMENT '识别码',
  PRIMARY KEY  (umId),
  KEY user_id (uId),
  KEY meta_key (umKey(50))
);