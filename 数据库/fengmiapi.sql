-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 12 月 25 日 01:41
-- 服务器版本: 5.7.1-m11
-- PHP 版本: 5.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `fengmiapi`
--
DROP DATABASE IF EXISTS `fengmiapi`;

CREATE DATABASE IF NOT EXISTS `fengmiapi` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `fengmiapi`;

-- --------------------------------------------------------

--
-- 表的结构 `ign_admin`
--

CREATE TABLE IF NOT EXISTS `ign_admin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `gId` int(11) DEFAULT '0' COMMENT '所属用户组',
  `rId` int(11) DEFAULT '0' COMMENT '所属角色',
  `adminName` varchar(20) DEFAULT NULL COMMENT '账号',
  `adminPwd` varchar(100) DEFAULT NULL COMMENT '密码',
  `realName` varchar(20) DEFAULT NULL COMMENT '真实姓名',
  `sex` int(1) DEFAULT '0' COMMENT '性别',
  `phone` varchar(30) DEFAULT NULL COMMENT '管理员联系电话',
  `email` varchar(60) DEFAULT NULL COMMENT '管理员电子邮箱',
  `status` int(3) DEFAULT '0' COMMENT '状态',
  `isChecked` bit(1) DEFAULT b'1' COMMENT '是否通过审核',
  `bak` varchar(255) DEFAULT NULL COMMENT '备注',
  `power` text COMMENT '权限字符串',
  `loginTimes` int(11) DEFAULT '0' COMMENT '登录次数',
  `lastLoginIP` varchar(15) DEFAULT NULL COMMENT '最后登录IP',
  `lastLoginTime` int(11) DEFAULT '0' COMMENT '最后一次登录时间',
  `addUserId` int(11) DEFAULT '0' COMMENT '添加用户Id',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ign_admin`
--

INSERT INTO `ign_admin` (`Id`, `gId`, `rId`, `adminName`, `adminPwd`, `realName`, `sex`, `phone`, `email`, `status`, `isChecked`, `bak`, `power`, `loginTimes`, `lastLoginIP`, `lastLoginTime`, `addUserId`, `addTime`) VALUES
(1, 16, 1, 'admin', 'cGWT5fycWIFeLn4jJRDa/6mkLR8vLeFq+JAOxsZemvmqI4iKMQzFX4XeB0J55jbNHPF5qtkEZMYveiCbN3cnZg==', 'admin.chirs', 1, '13823386486', 'admin@163.com', 0, b'1', '超级管理员', '111', 330, '127.0.0.1', 1419433309, 1, 1366855285),
(2, 17, 2, 'test1', 'w73uqOCWWGMB8CBd1WA9ZtTnjSlkap0r422l9jcgqO66oGMOToOq8B/M6XOl2owJlPhhCfXIPprdwcgjHG1XLA==', 'test', 1, '18666990865', '4645003@qq.com', 0, b'1', 'test', NULL, 6, '127.0.0.1', 1400226544, 1, 1397647475);

-- --------------------------------------------------------

--
-- 表的结构 `ign_advertise`
--

CREATE TABLE IF NOT EXISTS `ign_advertise` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) NOT NULL COMMENT '广告编号',
  `lang` varchar(10) NOT NULL DEFAULT '',
  `cateId` int(11) DEFAULT '0' COMMENT '类别Id',
  `orderNum` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `advName` varchar(40) DEFAULT NULL COMMENT '广告名称',
  `advLink` varchar(100) DEFAULT NULL COMMENT '广告链接地址',
  `bak` varchar(255) DEFAULT NULL COMMENT '广告备注',
  `isShow` int(1) DEFAULT '0' COMMENT '是否显示',
  `addTime` int(11) DEFAULT NULL,
  `addUserId` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='广告图片' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_area`
--

CREATE TABLE IF NOT EXISTS `ign_area` (
  `Id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) unsigned DEFAULT NULL COMMENT '上一级的id值',
  `area_name` varchar(50) DEFAULT NULL COMMENT '地区名称',
  `sort` mediumint(8) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `lang` varchar(10) NOT NULL DEFAULT 'zh-cn' COMMENT '所属语言',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='地区信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_article`
--

CREATE TABLE IF NOT EXISTS `ign_article` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `cateId` int(11) DEFAULT '0' COMMENT '类别Id',
  `lang` varchar(10) DEFAULT NULL COMMENT '所属语言',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `content` text COMMENT '内容',
  `hitsNums` int(11) DEFAULT '0' COMMENT '点击量',
  `isTop` tinyint(1) DEFAULT '0' COMMENT '是否置顶',
  `isRecommended` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `writer` varchar(20) DEFAULT NULL COMMENT '作者',
  `source` varchar(100) DEFAULT NULL COMMENT '来源',
  `hitsNum` int(11) DEFAULT '0' COMMENT '点击量',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  `addUserId` int(11) DEFAULT '0' COMMENT '添加用户Id',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='单页表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_artonce`
--

CREATE TABLE IF NOT EXISTS `ign_artonce` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `cateId` int(11) DEFAULT '0' COMMENT '类别Id',
  `lang` varchar(10) DEFAULT NULL COMMENT '所属语言',
  `title` varchar(120) DEFAULT NULL COMMENT '标题',
  `keywords` varchar(120) DEFAULT NULL COMMENT '关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `content` text COMMENT '内容',
  `addUserId` int(11) DEFAULT '0' COMMENT '添加用户Id',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  `hitsNums` int(11) DEFAULT '0' COMMENT '点击量',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='单页表' AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `ign_artonce`
--

INSERT INTO `ign_artonce` (`Id`, `cateId`, `lang`, `title`, `keywords`, `description`, `content`, `addUserId`, `addTime`, `hitsNums`) VALUES
(1, 1, 'zh_cn', '验证用户登录', '验证  登录', '验证用户登录', '验证用户登录', 1, 1419440923, 0),
(2, 1, 'zh_cn', '判断用户是否存在', '验证  登录', '判断用户是否存在', '判断用户是否存在', 1, 1419441266, 0),
(3, 1, 'zh_cn', '用户注册', '用户注册', '用户注册', '用户注册', 1, 1419441400, 0),
(4, 2, 'zh_cn', '修改用户个人信息', '修改用户个人信息', '修改用户个人信息', '修改用户个人信息', 1, 1419441613, 0),
(5, 2, 'zh_cn', '获取用户个人信息', '获取用户个人信息', '获取用户个人信息', '获取用户个人信息', 1, 1419441623, 0),
(6, 2, 'zh_cn', '修改用户密码', '修改用户密码', '修改用户密码', '修改用户密码', 1, 1419441634, 0),
(7, 2, 'zh_cn', '获取用户状态', '获取用户状态', '获取用户状态', '获取用户状态', 1, 1419441646, 0),
(8, 2, 'zh_cn', '修改用户状态', '修改用户状态', '修改用户状态', '修改用户状态', 1, 1419441656, 0),
(9, 2, 'zh_cn', '修改用户设置', '修改用户设置', '修改用户设置', '修改用户设置', 1, 1419441666, 0),
(10, 3, 'zh_cn', '摇一摇', '摇一摇', '摇一摇', '摇一摇', 1, 1419441712, 0),
(11, 4, 'zh_cn', '添加好友', '添加好友', '添加好友', '添加好友', 1, 1419441736, 0),
(12, 4, 'zh_cn', '删除好友', '删除好友', '删除好友', '删除好友', 1, 1419441746, 0),
(13, 4, 'zh_cn', '获取好友', '获取好友', '获取好友', '获取好友', 1, 1419441755, 0),
(14, 5, 'zh_cn', '创建好友分组', '创建好友分组', '创建好友分组', '创建好友分组', 1, 1419441769, 0),
(15, 5, 'zh_cn', '修改好友分组名称', '修改好友分组名称', '修改好友分组名称', '修改好友分组名称', 1, 1419441778, 0),
(16, 5, 'zh_cn', '删除好友分组', '删除好友分组', '删除好友分组', '删除好友分组', 1, 1419441788, 0),
(17, 5, 'zh_cn', '添加用户好友分组成员', '添加用户好友分组成员', '添加用户好友分组成员', '添加用户好友分组成员', 1, 1419441797, 0),
(18, 5, 'zh_cn', '修改好友分组状态', '修改好友分组状态', '修改好友分组状态', '修改好友分组状态', 1, 1419441806, 0),
(19, 5, 'zh_cn', '获取用户好友分组', '获取用户好友分组', '获取用户好友分组', '获取用户好友分组', 1, 1419441815, 0),
(20, 6, 'zh_cn', '创建群', '创建群', '创建群', '创建群', 1, 1419441839, 0),
(21, 6, 'zh_cn', '添加群用户，支持多个', '添加群用户，支持多个', '添加群用户，支持多个', '添加群用户，支持多个', 1, 1419441849, 0),
(22, 6, 'zh_cn', '删除群用户，支持多个', '删除群用户，支持多个', '删除群用户，支持多个', '删除群用户，支持多个', 1, 1419441859, 0),
(23, 6, 'zh_cn', '获取用户加入的所有群名称', '获取用户加入的所有群名称', '获取用户加入的所有群名称', '获取用户加入的所有群名称', 1, 1419441868, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ign_category`
--

CREATE TABLE IF NOT EXISTS `ign_category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `fatherId` int(11) DEFAULT '0' COMMENT '上级Id',
  `cateName` varchar(120) DEFAULT NULL COMMENT '类别名称',
  `orderNum` smallint(3) DEFAULT '0' COMMENT '排序数字',
  `catePath` varchar(72) NOT NULL COMMENT '类别路劲不包含本身',
  `cateIdentifier` varchar(60) DEFAULT NULL COMMENT '类别路劲不包含本身',
  `level` int(1) NOT NULL DEFAULT '1',
  `isNav` int(1) DEFAULT '1' COMMENT '是否是导航栏栏目:1是|2否 ',
  `haveLeaf` int(1) NOT NULL DEFAULT '0' COMMENT '是否有子类别',
  `cateType` tinyint(1) DEFAULT '1' COMMENT '1，2=链接类型；3=信息类别',
  `linkURL` varchar(100) DEFAULT NULL COMMENT '链接地址',
  `target` varchar(20) DEFAULT '0' COMMENT '打开方式',
  `navHover` varchar(30) DEFAULT NULL COMMENT '高亮菜单标识',
  `lang` varchar(10) DEFAULT NULL COMMENT '所属语言',
  `keywords` varchar(120) DEFAULT NULL COMMENT '关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `forPlugin` varchar(120) DEFAULT NULL COMMENT '所属插件',
  `addUserId` int(11) DEFAULT '0' COMMENT '添加用户Id',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='类别表' AUTO_INCREMENT=7 ;

--
-- 转存表中的数据 `ign_category`
--

INSERT INTO `ign_category` (`Id`, `fatherId`, `cateName`, `orderNum`, `catePath`, `cateIdentifier`, `level`, `isNav`, `haveLeaf`, `cateType`, `linkURL`, `target`, `navHover`, `lang`, `keywords`, `description`, `forPlugin`, `addUserId`, `addTime`) VALUES
(1, 0, '用户操作(验证、登录、注册等)', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '用户操作', '用户操作\r\n(验证、登录、注册等)', 'artonce', 1, 1419434381),
(2, 0, '用户基本信息操作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '用户基本信息操作', '用户基本信息操作', 'artonce', 1, 1419434403),
(3, 0, '用户动作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '用户动作', '用户动作，例如摇一摇', 'artonce', 1, 1419434448),
(4, 0, '好友操作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '好友操作', '好友操作', 'artonce', 1, 1419434459),
(5, 0, '好友分组操作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '好友分组操作', '好友分组操作', 'artonce', 1, 1419434470),
(6, 0, '群组操作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '群组操作', '群组操作', 'artonce', 1, 1419434480);

-- --------------------------------------------------------

--
-- 表的结构 `ign_common_cate`
--

CREATE TABLE IF NOT EXISTS `ign_common_cate` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(10) NOT NULL DEFAULT 'zh_cn' COMMENT '所属语言',
  `fatherId` int(11) DEFAULT '0' COMMENT '上级Id',
  `cateName` varchar(120) DEFAULT NULL COMMENT ' 警员类别名称',
  `orderNum` smallint(3) DEFAULT '0' COMMENT '排序数字',
  `catePath` varchar(72) NOT NULL COMMENT '类别路劲不包含本身',
  `cateIdentifier` varchar(60) DEFAULT NULL COMMENT '类别路劲不包含本身',
  `level` int(1) NOT NULL DEFAULT '1',
  `haveLeaf` int(1) NOT NULL DEFAULT '0' COMMENT '是否有子类别',
  `keywords` varchar(120) DEFAULT NULL COMMENT '关键字',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `forPlugin` varchar(120) DEFAULT NULL COMMENT '所属插件',
  `addUserId` int(11) DEFAULT '0' COMMENT '添加用户Id',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='类别表' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ign_common_cate`
--

INSERT INTO `ign_common_cate` (`Id`, `lang`, `fatherId`, `cateName`, `orderNum`, `catePath`, `cateIdentifier`, `level`, `haveLeaf`, `keywords`, `description`, `forPlugin`, `addUserId`, `addTime`) VALUES
(1, 'zh_cn', 0, '超级管理员组', 0, '0', '1', 1, 0, NULL, '超级管理员组', 'adminGroup', 1, 1419424475);

-- --------------------------------------------------------

--
-- 表的结构 `ign_feedback`
--

CREATE TABLE IF NOT EXISTS `ign_feedback` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `cateId` int(11) DEFAULT '0' COMMENT '类别Id',
  `lang` varchar(10) DEFAULT NULL COMMENT '所属语言',
  `title` varchar(120) DEFAULT NULL COMMENT '标题',
  `email` varchar(60) NOT NULL COMMENT '邮箱',
  `content` text COMMENT '内容',
  `isShow` int(1) DEFAULT '2' COMMENT '是否显示',
  `addUserIP` varchar(15) DEFAULT NULL COMMENT '添加用户ip',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='留言反馈表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_goods`
--

CREATE TABLE IF NOT EXISTS `ign_goods` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(20) NOT NULL COMMENT '商品唯一编号',
  `lang` varchar(10) NOT NULL,
  `name` varchar(400) NOT NULL,
  `content` varchar(500) NOT NULL,
  `orderNum` int(4) NOT NULL COMMENT '排序号',
  `marketPrice` double NOT NULL COMMENT '市场价格',
  `sellPrice` double NOT NULL COMMENT '销售价格',
  `weight` double NOT NULL COMMENT '商品重量',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `isDel` int(1) NOT NULL DEFAULT '0',
  `isChecked` int(1) NOT NULL DEFAULT '0',
  `addTime` datetime NOT NULL,
  `addUserId` varchar(20) NOT NULL,
  `specArray` text NOT NULL COMMENT '序列化的规则值,key规则ID,value此货品所具有的规则值',
  `specHidden` text NOT NULL COMMENT '隐藏表单值',
  PRIMARY KEY (`Id`),
  UNIQUE KEY `no` (`no`),
  KEY `name` (`name`(333))
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_goods_extend`
--

CREATE TABLE IF NOT EXISTS `ign_goods_extend` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `pno` varchar(20) NOT NULL COMMENT '产品主表唯一编号',
  `lang` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `detail` text NOT NULL COMMENT '详情',
  `isDel` int(1) NOT NULL DEFAULT '0',
  `isChecked` int(1) NOT NULL DEFAULT '0',
  `addTime` datetime NOT NULL,
  `addUserId` varchar(20) NOT NULL,
  `cateId` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`),
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_group`
--

CREATE TABLE IF NOT EXISTS `ign_group` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `fatherId` int(11) DEFAULT '0' COMMENT '上级Id',
  `gName` varchar(20) NOT NULL DEFAULT '' COMMENT '组名称',
  `orderNum` smallint(6) DEFAULT '0' COMMENT '排序数字',
  `power` text COMMENT '权限字符串',
  `bak` varchar(255) DEFAULT NULL COMMENT '备注',
  `addUserId` int(11) DEFAULT '0' COMMENT '添加用户Id',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员组' AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `ign_group`
--

INSERT INTO `ign_group` (`Id`, `fatherId`, `gName`, `orderNum`, `power`, `bak`, `addUserId`, `addTime`) VALUES
(1, 0, '超级管理员组', 0, 'adminGroup_00,adminGroup_01,adminGroup_02,adminGroup_03,adminGroup_04,adminRole_00,adminRole_01,adminRole_02,adminRole_03,adminRole_04,adminUser_00,adminUser_01,adminUser_02,adminUser_03,adminUser_04,policeCate_00,policeCate_01,policeCate_02,policeCate_03,policeCate_04,policeRole_00,policeRole_01,policeRole_02,policeRole_03,policeRole_04,police_00,police_01,police_02,police_03,police_04,policePhone_00,policePhone_01,policePhone_02,policePhone_03,policePhone_04,msg_00,msg_01,msg_05,msg_06,msg_07,GPS_00,GPS_01,GPS_05,GPS_06,GPSEquipment_00,GPSEquipment_01,GPSEquipment_02,GPSEquipment_03,GPSEquipment_04,GPSLogs_00,GPSLogs_01,GPSLogs_03,admin_00,admin_01,admin_05,admin_06,database_00,database_01,database_05,database_06,logs_00,logs_01,logs_03', '这是超级管理员组，请谨慎操作！数据一旦删除将无法恢复！建议在操作前 先备份数据库！', 1, 1353766032);

-- --------------------------------------------------------

--
-- 表的结构 `ign_link`
--

CREATE TABLE IF NOT EXISTS `ign_link` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(10) DEFAULT NULL,
  `cateId` int(11) DEFAULT '0' COMMENT '类别Id',
  `orderNum` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `title` varchar(120) DEFAULT NULL COMMENT '标题',
  `link` varchar(100) DEFAULT NULL COMMENT '友情链接地址',
  `isShow` int(1) DEFAULT '0' COMMENT '是否显示',
  `bak` varchar(255) NOT NULL COMMENT '备注',
  `addUserId` int(11) DEFAULT '0' COMMENT '添加用户Id',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接表' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_log`
--

CREATE TABLE IF NOT EXISTS `ign_log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `logType` tinyint(1) DEFAULT '0' COMMENT '日志类型',
  `describe` varchar(100) DEFAULT NULL COMMENT '日志描述',
  `logTime` int(11) DEFAULT '0' COMMENT '日志时间',
  `ip` varchar(15) DEFAULT NULL COMMENT 'IP地址',
  `emergeURL` text COMMENT '日志出现URL',
  `userId` int(11) DEFAULT '0' COMMENT '日志产生的用户Id',
  `userType` tinyint(1) DEFAULT '0' COMMENT '用户类型,1管理员，2前台会员，3普通游客',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='系统日志' AUTO_INCREMENT=54 ;

--
-- 转存表中的数据 `ign_log`
--

INSERT INTO `ign_log` (`Id`, `logType`, `describe`, `logTime`, `ip`, `emergeURL`, `userId`, `userType`) VALUES
(1, 2, '登录失败，用户名不存在', 1419407050, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/login', NULL, 0),
(2, 2, '登录失败，密码错误', 1419407102, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/login', NULL, 0),
(3, 2, '登录失败，密码错误', 1419407111, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/login', NULL, 0),
(4, 2, '登录失败，密码错误', 1419407120, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/login', NULL, 0),
(5, 2, '登录成功！', 1419407394, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/login', 1, 0),
(6, 3, '清除缓存成功 !', 1419407435, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/cache', 1, 0),
(7, 3, '成功 !', 1419421938, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/cache', 1, 0),
(8, 1, '抱歉，您无操作权限！', 1419423932, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/cache', 1, 0),
(9, 1, '抱歉，您无操作权限！', 1419423936, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/cache', 1, 0),
(10, 3, '成功 !', 1419424084, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/cache', 1, 0),
(11, 1, '抱歉，您无管理类别操作权限！', 1419424362, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/category/index', 1, 0),
(12, 1, '抱歉，您无管理单页面操作权限！', 1419424368, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/artonce/index', 1, 0),
(13, 3, '成功 !', 1419424412, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/cache', 1, 0),
(14, 1, '抱歉，您无管理留言反馈操作权限！', 1419424423, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/feedback/index', 1, 0),
(15, 0, '添加管理员组成功！', 1419424475, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/adminGroup/deal', 1, 0),
(16, 0, '修改管理员组成功！', 1419424525, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/adminGroup/deal', 1, 0),
(17, 1, '抱歉，您无操作权限！', 1419424737, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/CommonCate/index', 1, 0),
(18, 0, '修改管理员组成功！', 1419425246, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/adminGroup/deal', 1, 0),
(19, 0, '修改管理员角色成功！', 1419425267, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/adminRole/deal', 1, 0),
(20, 3, '成功 !', 1419425271, '127.0.0.1', 'http://127.0.0.1/fengmiapiwebsite/fengmiapimanage/index.php/admin/cache', 1, 0),
(21, 2, '登录失败，密码错误', 1419433299, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/admin/login', NULL, 0),
(22, 2, '登录成功！', 1419433308, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/admin/login', 1, 0),
(23, 3, '成功 !', 1419433338, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/admin/cache', 1, 0),
(24, 3, '成功 !', 1419433354, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/admin/cache', 1, 0),
(25, 0, '添加类别成功！', 1419434381, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/category/deal', 1, 0),
(26, 0, '添加类别成功！', 1419434403, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/category/deal', 1, 0),
(27, 0, '添加类别成功！', 1419434448, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/category/deal', 1, 0),
(28, 0, '添加类别成功！', 1419434459, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/category/deal', 1, 0),
(29, 0, '添加类别成功！', 1419434470, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/category/deal', 1, 0),
(30, 0, '添加类别成功！', 1419434480, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/category/deal', 1, 0),
(31, 0, '添加单页面成功！', 1419440923, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(32, 0, '添加单页面成功！', 1419441266, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(33, 0, '添加单页面成功！', 1419441400, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(34, 0, '添加单页面成功！', 1419441613, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(35, 0, '添加单页面成功！', 1419441623, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(36, 0, '添加单页面成功！', 1419441634, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(37, 0, '添加单页面成功！', 1419441646, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(38, 0, '添加单页面成功！', 1419441656, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(39, 0, '添加单页面成功！', 1419441666, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(40, 0, '添加单页面成功！', 1419441712, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(41, 0, '添加单页面成功！', 1419441736, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(42, 0, '添加单页面成功！', 1419441746, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(43, 0, '添加单页面成功！', 1419441755, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(44, 0, '添加单页面成功！', 1419441769, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(45, 0, '添加单页面成功！', 1419441778, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(46, 0, '添加单页面成功！', 1419441788, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(47, 0, '添加单页面成功！', 1419441797, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(48, 0, '添加单页面成功！', 1419441806, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(49, 0, '添加单页面成功！', 1419441815, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(50, 0, '添加单页面成功！', 1419441839, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(51, 0, '添加单页面成功！', 1419441849, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(52, 0, '添加单页面成功！', 1419441859, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0),
(53, 0, '添加单页面成功！', 1419441868, '127.0.0.1', 'http://localhost:8001/fengmiapimanage/index.php/artonce/deal', 1, 0);

-- --------------------------------------------------------

--
-- 表的结构 `ign_member`
--

CREATE TABLE IF NOT EXISTS `ign_member` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `lang` varchar(10) DEFAULT NULL COMMENT '所属语言',
  `email` varchar(100) DEFAULT NULL COMMENT '邮箱',
  `password` char(32) DEFAULT NULL COMMENT '密码',
  `realname` varchar(30) DEFAULT NULL COMMENT '真实姓名',
  `nickname` varchar(20) DEFAULT NULL COMMENT '昵称',
  `sex` int(1) DEFAULT '1' COMMENT '1-男，2-女',
  `birthday` date DEFAULT NULL COMMENT '生日',
  `headpic` varchar(20) DEFAULT NULL COMMENT '头像',
  `addrNation` varchar(30) DEFAULT NULL COMMENT '国家',
  `addrProvince` varchar(40) DEFAULT NULL COMMENT '省',
  `addrCity` varchar(40) DEFAULT NULL COMMENT '城市',
  `addrCounty` varchar(40) DEFAULT NULL COMMENT '区县',
  `fullAddress` varchar(100) DEFAULT NULL COMMENT '详细地址',
  `postcode` varchar(10) DEFAULT NULL COMMENT '邮编',
  `mobile` varchar(20) DEFAULT NULL COMMENT '手机号码',
  `phone` varchar(20) DEFAULT NULL COMMENT '家庭电话',
  `introduce` text COMMENT '个人简介',
  `integral` int(11) DEFAULT NULL COMMENT '积分',
  `money` float(10,3) DEFAULT '0.000' COMMENT '用户余额',
  `level` int(11) DEFAULT '0' COMMENT '用户等级',
  `type` int(11) DEFAULT '0' COMMENT '用户类型',
  `isFrost` int(1) DEFAULT '1' COMMENT '是否冻结账号',
  `regTime` int(11) DEFAULT '0' COMMENT '注册时间',
  `isActive` int(1) DEFAULT '0' COMMENT '是否已激活',
  `lastLoginIP` varchar(15) DEFAULT NULL COMMENT '最后登录IP',
  `lastLoginTime` int(11) DEFAULT '0' COMMENT '最后一次登录时间',
  `loginTimes` int(11) DEFAULT '0' COMMENT '登录次数',
  `sendNum` int(11) NOT NULL DEFAULT '0' COMMENT '接受邮件数量',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='会员' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_msg`
--

CREATE TABLE IF NOT EXISTS `ign_msg` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `msg` text NOT NULL COMMENT '信息内容',
  `designee` varchar(50) NOT NULL COMMENT '发送者',
  `receiver` varchar(50) NOT NULL COMMENT '接收者',
  `status` int(3) DEFAULT '0' COMMENT '状态',
  `addTime` int(11) DEFAULT NULL,
  `addUserId` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='信息' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_news`
--

CREATE TABLE IF NOT EXISTS `ign_news` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) NOT NULL COMMENT '新闻编号',
  `cateId` int(11) DEFAULT '0' COMMENT '类别Id',
  `lang` varchar(10) DEFAULT NULL COMMENT '所属语言',
  `title` varchar(100) DEFAULT NULL COMMENT '标题',
  `keywords` varchar(100) DEFAULT NULL COMMENT '关键字',
  `editor` varchar(20) NOT NULL COMMENT '编辑',
  `description` varchar(255) DEFAULT NULL COMMENT '描述',
  `content` text COMMENT '内容',
  `isTop` tinyint(1) DEFAULT '0' COMMENT '是否置顶',
  `isHot` tinyint(1) DEFAULT '2' COMMENT '是否热门',
  `isRecommended` tinyint(1) DEFAULT '0' COMMENT '是否推荐',
  `source` varchar(100) DEFAULT NULL COMMENT '来源',
  `hitsNums` int(11) DEFAULT '0' COMMENT '点击量',
  `orderNum` smallint(6) NOT NULL DEFAULT '0' COMMENT '排序',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  `addUserId` int(11) DEFAULT '0' COMMENT '添加用户Id',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC COMMENT='新闻' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_product`
--

CREATE TABLE IF NOT EXISTS `ign_product` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) NOT NULL COMMENT '商品唯一编号',
  `cateId` int(11) DEFAULT '0',
  `lang` varchar(10) NOT NULL,
  `title` varchar(120) NOT NULL,
  `description` varchar(500) NOT NULL COMMENT '简介',
  `content` text NOT NULL COMMENT '内容',
  `isHot` tinyint(1) NOT NULL DEFAULT '2' COMMENT '是否热门',
  `orderNum` int(4) NOT NULL COMMENT '排序号',
  `marketPrice` double NOT NULL DEFAULT '0.01' COMMENT '市场价格',
  `sellPrice` double NOT NULL DEFAULT '0.01' COMMENT '销售价格',
  `weight` double DEFAULT '0.01' COMMENT '商品重量',
  `stock` int(11) NOT NULL DEFAULT '0' COMMENT '库存',
  `isDel` int(1) NOT NULL DEFAULT '0',
  `isChecked` int(1) NOT NULL DEFAULT '0',
  `addTime` int(11) NOT NULL,
  `addUserId` varchar(20) NOT NULL,
  PRIMARY KEY (`Id`),
  KEY `name` (`title`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_relefile`
--

CREATE TABLE IF NOT EXISTS `ign_relefile` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(50) DEFAULT '0' COMMENT '关联文件的编号',
  `cTable` varchar(20) DEFAULT NULL COMMENT '内容所属表',
  `cId` int(11) DEFAULT '0' COMMENT '内容Id',
  `title` varchar(50) DEFAULT NULL COMMENT '关联文件标题',
  `cType` varchar(20) DEFAULT NULL COMMENT '文件类型',
  `cSign` varchar(20) DEFAULT NULL COMMENT '文件标识',
  `cAffect` varchar(120) DEFAULT NULL COMMENT '作用标识',
  `url` varchar(120) DEFAULT NULL COMMENT '文件链接',
  `bak` varchar(255) DEFAULT NULL COMMENT '文件备注',
  `addUserId` int(11) DEFAULT '0' COMMENT '添加用户Id',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='内容关联文件' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- 表的结构 `ign_role`
--

CREATE TABLE IF NOT EXISTS `ign_role` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `fatherId` int(11) DEFAULT '0' COMMENT '上级Id',
  `gId` int(11) NOT NULL DEFAULT '0' COMMENT '所属组Id',
  `rName` varchar(20) NOT NULL DEFAULT '' COMMENT '角色名称',
  `orderNum` smallint(6) DEFAULT '0' COMMENT '排序数字',
  `power` text COMMENT '权限字符串',
  `bak` varchar(255) DEFAULT NULL COMMENT '备注',
  `addUserId` int(11) DEFAULT '0' COMMENT '添加用户Id',
  `addTime` int(11) DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户角色' AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `ign_role`
--

INSERT INTO `ign_role` (`Id`, `fatherId`, `gId`, `rName`, `orderNum`, `power`, `bak`, `addUserId`, `addTime`) VALUES
(1, 0, 1, '超级管理员', 0, 'adminGroup_00,adminGroup_01,adminGroup_02,adminGroup_03,adminGroup_04,adminRole_00,adminRole_01,adminRole_02,adminRole_03,adminRole_04,adminUser_00,adminUser_01,adminUser_02,adminUser_03,adminUser_04,category_00,category_01,category_02,category_03,category_04,artonce_00,artonce_01,artonce_02,artonce_03,artonce_04,product_00,product_01,product_02,product_03,product_04,logs_00,logs_01,logs_03,feedback_00,feedback_01,feedback_02,feedback_03,feedback_04,friendlink_00,friendlink_01,friendlink_02,friendlink_03,friendlink_04,admin_00,admin_01,admin_05,admin_06', '超级管理员', 1, 1364873946),
(2, 0, 17, '普通管理员', 0, 'policeCate_00,policeCate_01,policeCate_02,policeCate_03,policeCate_04,policeRole_00,policeRole_01,policeRole_02,policeRole_03,policeRole_04,police_00,police_01,police_02,police_03,police_04,msg_00,msg_01,msg_05,msg_06,msg_07,GPS_00,GPS_01,GPS_05,GPS_06,GPSEquipment_00,GPSEquipment_01,GPSEquipment_02,GPSEquipment_03,GPSEquipment_04,GPSLogs_00,GPSLogs_01,GPSLogs_03,admin_00,admin_01,admin_05,admin_06,database_00,database_01,database_05,database_06,logs_00,logs_01,logs_03', '普通管理员', 1, 1397647447);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
