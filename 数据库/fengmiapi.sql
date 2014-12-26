-- phpMyAdmin SQL Dump
-- version 3.3.8.1
-- http://www.phpmyadmin.net
--
-- 主机: w.rdc.sae.sina.com.cn:3307
-- 生成日期: 2014 年 12 月 26 日 10:02
-- 服务器版本: 5.5.23
-- PHP 版本: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


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
(1, 16, 1, 'admin', 'cGWT5fycWIFeLn4jJRDa/6mkLR8vLeFq+JAOxsZemvmqI4iKMQzFX4XeB0J55jbNHPF5qtkEZMYveiCbN3cnZg==', 'admin.chirs', 1, '13823386486', 'admin@163.com', 0, '', '超级管理员', '111', 332, '121.8.62.72', 1419520238, 1, 1366855285),
(2, 17, 2, 'test1', 'w73uqOCWWGMB8CBd1WA9ZtTnjSlkap0r422l9jcgqO66oGMOToOq8B/M6XOl2owJlPhhCfXIPprdwcgjHG1XLA==', 'test', 1, '18666990865', '4645003@qq.com', 0, '', 'test', NULL, 6, '127.0.0.1', 1400226544, 1, 1397647475);

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

--
-- 转存表中的数据 `ign_advertise`
--


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

--
-- 转存表中的数据 `ign_area`
--


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

--
-- 转存表中的数据 `ign_article`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='单页表' AUTO_INCREMENT=41 ;

--
-- 转存表中的数据 `ign_artonce`
--

INSERT INTO `ign_artonce` (`Id`, `cateId`, `lang`, `title`, `keywords`, `description`, `content`, `addUserId`, `addTime`, `hitsNums`) VALUES
(1, 1, 'zh_cn', '验证用户登录', '验证  登录', '验证用户登录', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				验证用户登录\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/PostValidUser\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				phone 手机号<br />\npassword 密码\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\n				status = status,\n				msg = msg,<br />\nuId = uId\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：uId 用户Id，<br />\nstatus:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419440923, 0),
(2, 1, 'zh_cn', '判断用户是否存在', '验证  登录', '判断用户是否存在', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				判断用户是否存在\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/isUserExist\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				phone 手机号<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\n				status = status,\n				msg = msg,<br />\nuId = uId\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：uId 用户Id，<br />\nstatus:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441266, 0),
(3, 1, 'zh_cn', '用户注册', '用户注册', '用户注册', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				用户注册\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/Register\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				phone 手机号<br />\npassword 密码\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\n				status = status,\n				msg = msg,<br />\n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441400, 0),
(4, 2, 'zh_cn', '修改用户个人信息', '修改用户个人信息', '修改用户个人信息', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				修改用户个人信息\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/DealUserInfo\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				uId 用户Id<br />\nemail<br />\nrealName<br />\nnickName<br />\nidentityCard<br />\nbirthDay<br />\naddress<br />\nuserFace 头像\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\n				status = status,\n				msg = msg,<br />\nuId = uId\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：uId 用户Id，<br />\nstatus:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441613, 0),
(5, 2, 'zh_cn', '获取用户个人信息', '获取用户个人信息', '获取用户个人信息', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				获取用户个人信息\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/GetUserInfo\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				uId 用户Id<br />\n\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br />\nuser = {<br />\n phone = phone,<br />\n realName = realName,<br />\n nickName = nickName,<br />\n identityCard = identityCard,<br />\n birthDay = birthDay,<br />\n userFace = userFace,<br />\n email = email,<br />\n address = address,<br />\n userStatus = userStatus,<br />\n interests = interests,<br />\n isPermitAddFriend = isPermitAddFriend,<br />\n}\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441623, 0),
(6, 2, 'zh_cn', '修改用户密码', '修改用户密码', '修改用户密码', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				修改用户密码\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/DealUpdatePwd\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				uId 用户Id<br />\noldPassword 旧密码<br />\npassword 密码<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br />\n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441634, 0),
(7, 2, 'zh_cn', '获取用户状态', '获取用户状态', '获取用户状态', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				获取用户状态\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/GetUserStatus\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				uId 用户Id<br />\n\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \nuser ={ <br /> \n	 uId = uId, <br /> \n	 phone = phone, <br /> \n	 email = email, <br /> \n	 status = userStatus, <br /> \n}\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441646, 0),
(8, 2, 'zh_cn', '修改用户状态', '修改用户状态', '修改用户状态', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				修改用户状态\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/DealUserStatus\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				uId 用户Id<br />\nstatus （status=1 在线，status=2 隐身，其他值会提示修改失败。）<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\n				status = status, <br />\nmsg = msg, <br />\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441656, 0),
(9, 2, 'zh_cn', '修改用户设置', '修改用户设置', '修改用户设置', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				修改用户设置\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/DealUserPermit\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuId 用户Id<br />\nisPermitAddFriend 是否允许被添加好友：1=是，0=否<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441666, 0),
(10, 3, 'zh_cn', '摇一摇', '摇一摇', '摇一摇', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				摇一摇\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/Shake\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuId 用户Id<br />\nuploadTime 上传时间<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \nusers = [{ <br /> \nuId = t_uId,\naction = t_action, <br /> \nuploadTime = t_uploadTime, <br /> \nmodifyTime = t_modifyTime,  <br /> \nphone = phone, <br /> \nrealName = realName, <br /> \nnickName = nickName, <br /> \nidentityCard = identityCard, <br /> \nbirthDay = birthDay, <br /> \nuserFace = userFace, <br /> \n email = email, <br /> \n address = address, <br /> \n}] \n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441712, 0),
(11, 4, 'zh_cn', '添加好友', '添加好友', '添加好友', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				添加好友\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/AddFriend\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuId 用户Id<br />\nfuId 好友Id<br />\naddType (添加类型：1表示通过手机号查询添加；2表示摇一摇（暂定如此）。可选)\nuFGroupId (好友分组Id.可选)<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441736, 0),
(12, 4, 'zh_cn', '删除好友', '删除好友', '删除好友', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				删除好友\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/DeleteFriend\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuId 用户Id<br />\nfuId 好友Id<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441746, 0),
(13, 4, 'zh_cn', '获取好友', '获取好友', '获取好友', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				获取好友\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/GetFriend\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuId 用户Id<br />\n\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \nuserFriend = [<br />\n{<br />\n  uId = uId,<br />\n  fuId = fuId,<br />\n  addType = addType,<br />\n  uFGroupId = uFGroupId, <br />              \n  modifyTime = modifyTime,<br />\n  status = userStatus,<br />\n<br />\n  phone = phone,<br />\n  realName = realName,<br />\n  nickName = nickName,<br />\n  identityCard = identityCard,<br />\n  birthDay = birthDay,<br />\n  userFace = userFace,<br />\n  email = email,<br />\n  address = address<br />\n }]<br />\n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441755, 0),
(14, 5, 'zh_cn', '创建好友分组', '创建好友分组', '创建好友分组', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				创建好友分组\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/CreateUserFriendGroup\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuId 用户Id<br />\nname (名称 string类型)<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \nuFGroupId = uFGroupId (分组ID)<br />\n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441769, 0),
(15, 5, 'zh_cn', '修改好友分组名称', '修改好友分组名称', '修改好友分组名称', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				修改好友分组名称\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/ModifyUserFriendGroupName\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuFGroupId 好友分组Id<br />\nname <br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441778, 0),
(16, 5, 'zh_cn', '删除好友分组', '删除好友分组', '删除好友分组', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				删除好友分组\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/DeleteUserFriendGroup\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuFGroupId 好友分组Id<br />\n\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441788, 0),
(17, 5, 'zh_cn', '添加用户好友分组成员', '添加用户好友分组成员', '添加用户好友分组成员', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				添加用户好友分组成员\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/AddUserFriToUserFriendGroup\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uId<br />\n			fuId<br />\n			uFGroupId 好友分组Id<br />\n\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441797, 0),
(18, 5, 'zh_cn', '修改好友分组状态', '修改好友分组状态', '修改好友分组状态', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				修改好友分组状态\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/ModifyUserFriendGroupStatus\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uFGroupId 好友分组Id<br />\n			status<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441806, 0),
(19, 5, 'zh_cn', '获取用户好友分组', '获取用户好友分组', '获取用户好友分组', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				获取用户好友分组\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/GetUserFriendGroup\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uId  <br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \nuserFriendGroup = {<br />\nuId = i_uId,<br />\nuFGroupId = i_uFGroupId,<br />\ngName = gName,<br />\nmodifyTime = modifyTime,<br />\nstatus = status ,<br />\n}<br />\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441815, 0),
(20, 6, 'zh_cn', '创建群', '创建群', '创建群', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				创建群\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/CreateUserGroup	\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			name （名称 string类型）<br />\n			createUId （用户Id）<br />\n			status （群状态：可选）<br />\n			gType （群类型：可选）<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441839, 0),
(21, 6, 'zh_cn', '添加群用户，支持多个', '添加群用户，支持多个', '添加群用户，支持多个', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				添加群用户，支持多个\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/AddUserGroupUser\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uGId 群Id<br />\n			uId 用户Id： \\",\\"号隔开<br />\n			uRole （用户角色：int类型）<br />\n\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441849, 0),
(22, 6, 'zh_cn', '删除群用户，支持多个', '删除群用户，支持多个', '删除群用户，支持多个', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				删除群用户，支持多个\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/DeleteUserGroupUser\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uGId 群Id<br />\n			uId 用户Id： \\",\\"号隔开<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441859, 0),
(23, 6, 'zh_cn', '获取用户加入的所有群名称', '获取用户加入的所有群名称', '获取用户加入的所有群名称', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				获取用户加入的所有群名称\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/GetUserGroup\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uId 用户Id<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \nuserGroup = <br /> \n{<br /> \nuId = uId,<br /> \nuGId = uGId,<br /> \nuRole = uRole,<br /> \nmodifyTime = modifyTime,<br /> \nstatus = userStatus,<br /> \nname = name,<br /> \ncreateUId =createUId,<br /> \n}\n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419441868, 0),
(24, 1, 'zh_cn', '用邮箱找回密码', '邮箱 密码', '用邮箱找回密码', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				用邮箱找回密码\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/FindPwdWithEmail\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nphone<br />\nemail  邮箱是用户注册时填写的邮箱<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419524932, 0),
(25, 2, 'zh_cn', '修改用户对群状态', '用户 群 状态', '修改用户对群状态', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				修改用户对群状态\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/dealUserToGroupStatus\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				uId 用户Id<br />\nuGId 群的Id<br />\nmodifyTime<br />\nstatus 状态<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\n				status = status, <br />\nmsg = msg, <br />\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419525405, 0),
(26, 2, 'zh_cn', '在线时 设置对某好友是否隐身', '在线时 设置对某好友是否隐身', '在线时 设置对某好友是否隐身', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				在线时 设置对某好友是否隐身\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/SetUserToFriendUserOnline\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuId 用户Id<br />\nfuId 好友Id<br />\nisOnToHide (是否在线隐藏 0=否，1=是)<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419525728, 0),
(27, 2, 'zh_cn', '隐身时 设置对某好友是否在线', '隐身时 设置对某好友是否在线', '隐身时 设置对某好友是否在线', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				隐身时 设置对某好友是否在线\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/SetUserToFriendUserOffline\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuId 用户Id<br />\nfuId 好友Id<br />\nisOffToVisible (是否隐藏在线 0=否，1=是)<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419525785, 0),
(28, 3, 'zh_cn', '上传头像', '上传头像', '上传头像', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				上传头像\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/Common/UploadFile\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nuId 用户Id<br />\nuploadfile 图片资源<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \nuserFace = userFace (头像URL)<br /> \n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419526154, 0),
(29, 3, 'zh_cn', '发送邮件', '发送邮件', '发送邮件', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				发送邮件\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/SendEmail\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\nemail <br />\nsubject (邮件主题)<br />\ncontent (邮件内容，支持HTML编辑内容)<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419526372, 0),
(30, 5, 'zh_cn', '在线时 设置对分组好友是否隐身', '在线时 设置对分组好友是否隐身', '在线时 设置对分组好友是否隐身', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				在线时 设置对分组好友是否隐身\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/SetUserFriendGroupOnline\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uFGroupId (好友分组Id)<br />\n			isOnToHide (是否在线隐藏 0=否，1=是)<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419527988, 0),
(31, 5, 'zh_cn', '隐身时 设置对分组好友是否在线', '隐身时 设置对分组好友是否在线', '隐身时 设置对分组好友是否在线', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				隐身时 设置对分组好友是否在线\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/SetUserFriendGroupOffline\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				uFGroupId (好友分组Id)<br />\nisOffToVisible （是否隐藏在线 0=否，1=是）<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\n				status = status, <br />\nmsg = msg, <br />\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419528060, 0),
(32, 6, 'zh_cn', '获取群用户', '获取群用户', '获取群用户', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				获取群用户\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/GetUserGroupUser\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uId 用户Id<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \nuserGroup = <br /> \n{<br />  \n&nbsp;	&nbsp;uGId = uGId,<br /> \n&nbsp;	&nbsp;uRole = uRole,<br /> \n&nbsp;	&nbsp;modifyTime = modifyTime,<br /> \n&nbsp;	&nbsp;name = name,<br /> \n&nbsp;	&nbsp;createUId =createUId,<br /> \n&nbsp;	&nbsp;userGroupUser=[{<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;uRole = uRole,<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;status = ugStatus,<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;uId = ug_uId,<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;phone = phone,<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;realName = realName,<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;nickName = nickName,<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;identityCard = identityCard,<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;birthDay = birthDay,<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;userFace = userFace,<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;email = email,<br /> \n&nbsp;	&nbsp;&nbsp;	&nbsp;address = address<br /> \n&nbsp;	&nbsp;}]<br /> \n}<br /> \n\n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419528863, 0),
(33, 6, 'zh_cn', '删除群组', '删除群组', '删除群组', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				删除群组\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/DeleteUserGroup\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uGId 群Id<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419528927, 0),
(34, 6, 'zh_cn', '修改群用户角色', '修改群用户角色', '修改群用户角色', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				修改群用户角色\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/ModifyUserGroupUserRole\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uGId 群Id<br />\n			uId 用户Id：int类型<br />\n			uRole 用户角色：int类型<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419529019, 0),
(35, 6, 'zh_cn', '修改群名称', '修改群名称', '修改群名称', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				修改群名称\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/User/ModifyUserGroupName\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uGId 群Id<br />\n			name 群名称<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419529072, 0),
(36, 7, 'zh_cn', '上传用户定位信息', '上传用户定位信息', '上传用户定位信息', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				上传用户定位信息\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/Position/SetPosition\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uId 用户Id<br />\n			longitude 经度 decimal(10, 6)<br />\n			latitude 纬度 decimal(10, 6)<br />\n			placeName 地名<br />\n			uploadTime 上传时间<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \n\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419529266, 0),
(37, 7, 'zh_cn', '获取用户定位信息', '获取用户定位信息', '获取用户定位信息', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				获取用户定位信息\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/Position/GetPosition\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				uId 用户Id<br />\nperPage 获取的数量，默认10<br />\npage 第几页数，默认第1页 <br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br />\ntotal=total,<br />\npageTotal=pageTotal,<br />\ndata =[{<br />\n&nbsp;　&nbsp;longitude = longitude,<br />\n&nbsp;　&nbsp;latitude = latitude,<br />\n&nbsp;　&nbsp;placeName = placeName,<br />\n&nbsp;　&nbsp;uploadTime = uploadTime,<br />\n&nbsp;　&nbsp;modifyTime = modifyTime,<br />\n&nbsp;　&nbsp;offlineUserIds = offlineUserIds,<br />\n&nbsp;　&nbsp;isHiding = i_isHiding,<br />\n}],<br />\n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419529441, 0),
(38, 7, 'zh_cn', '获取用户最新定位信息', '获取用户最新定位信息', '获取用户最新定位信息', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				获取用户最新定位信息\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/Position/GetUserNewestPosition\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n			uId (用户Id，多个用户使用\\'',\\'' 分隔)<br />\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n			<td>\nstatus = status, <br />\nmsg = msg, <br /> \ndata = [{<br /> \n&nbsp;　&nbsp;uId = uId,<br /> \n&nbsp;　&nbsp;position = {<br /> \n&nbsp;　　&nbsp;longitude = longitude,<br /> \n&nbsp;　　&nbsp;latitude = latitude,<br /> \n&nbsp;　　&nbsp;placeName = placeName,<br /> \n&nbsp;　　&nbsp;uploadTime = uploadTime,<br /> \n&nbsp;　　&nbsp;modifyTime = modifyTime,<br /> \n&nbsp;　　&nbsp;offlineUserIds = offlineUserIds,<br /> \n&nbsp;　　&nbsp;isHiding = i_isHiding,<br /> \n&nbsp;　&nbsp;}<br /> \n}]<br /> \n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419529813, 0),
(39, 7, 'zh_cn', '获取群用户最新定位信息', '获取群用户最新定位信息', '获取群用户最新定位信息', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				获取群用户最新定位信息\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/Position/GetUserNewestPositionByUGid\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				uGId<br />\n\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n<td>\nstatus = status, <br>\nmsg = msg, <br> \ndata = [{<br> \n&nbsp;　&nbsp;uId = uId,<br> \n&nbsp;　&nbsp;position = {<br> \n&nbsp;　　&nbsp;longitude = longitude,<br> \n&nbsp;　　&nbsp;latitude = latitude,<br> \n&nbsp;　　&nbsp;placeName = placeName,<br> \n&nbsp;　　&nbsp;uploadTime = uploadTime,<br> \n&nbsp;　　&nbsp;modifyTime = modifyTime,<br> \n&nbsp;　　&nbsp;offlineUserIds = offlineUserIds,<br> \n&nbsp;　　&nbsp;isHiding = i_isHiding,<br> \n&nbsp;　&nbsp;}<br> \n}]<br> \n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419530242, 0),
(40, 7, 'zh_cn', '获取所有好友的最新定位信息', '获取所有好友的最新定位信息', '获取所有好友的最新定位信息', '<table class=\\"table table-bordered table-striped\\">\n	<tbody>\n		<tr>\n			<th>\n				功能\n			</th>\n			<td>\n				获取所有好友的最新定位信息\n			</td>\n		</tr>\n		<tr>\n			<th>\n				API路径\n			</th>\n			<td>\n				/Position/GetNewestPosition	\n			</td>\n		</tr>\n		<tr>\n			<th>\n				请求方式(默认：POST)\n			</th>\n			<td>\n				POST\n			</td>\n		</tr>\n		<tr>\n			<th>\n				传参\n			</th>\n			<td>\n				uId <br />\n\n			</td>\n		</tr>\n		<tr>\n			<th>\n				返回值\n			</th>\n<td>\nstatus = status, <br>\nmsg = msg, <br> \ndata = [{<br> \n&nbsp;　&nbsp;uId = uId,<br> \n&nbsp;　&nbsp;fuId = fuId,<br> \n&nbsp;　&nbsp;status = userFriStatus,<br> \n&nbsp;　&nbsp;userStatus = userStatus,<br> \n&nbsp;　&nbsp;position = {<br> \n&nbsp;　　&nbsp;longitude = longitude,<br> \n&nbsp;　　&nbsp;latitude = latitude,<br> \n&nbsp;　　&nbsp;placeName = placeName,<br> \n&nbsp;　　&nbsp;uploadTime = uploadTime,<br> \n&nbsp;　　&nbsp;modifyTime = modifyTime,<br> \n&nbsp;　　&nbsp;offlineUserIds = offlineUserIds,<br> \n&nbsp;　　&nbsp;isHiding = i_isHiding,<br> \n&nbsp;　&nbsp;}<br> \n}]<br> \n			</td>\n		</tr>\n	</tbody>\n</table>\n<p>\n	备注：status:<br />\nerror：表示错误<br />\nsucceed：表示成功\n</p>', 1, 1419530397, 0);

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='类别表' AUTO_INCREMENT=8 ;

--
-- 转存表中的数据 `ign_category`
--

INSERT INTO `ign_category` (`Id`, `fatherId`, `cateName`, `orderNum`, `catePath`, `cateIdentifier`, `level`, `isNav`, `haveLeaf`, `cateType`, `linkURL`, `target`, `navHover`, `lang`, `keywords`, `description`, `forPlugin`, `addUserId`, `addTime`) VALUES
(1, 0, '用户操作(验证、登录、注册等)', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '用户操作', '用户操作\r\n(验证、登录、注册等)', 'artonce', 1, 1419434381),
(2, 0, '用户基本信息操作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '用户基本信息操作', '用户基本信息操作', 'artonce', 1, 1419434403),
(3, 0, '用户动作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '用户动作', '用户动作，例如摇一摇', 'artonce', 1, 1419434448),
(4, 0, '好友操作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '好友操作', '好友操作', 'artonce', 1, 1419434459),
(5, 0, '好友分组操作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '好友分组操作', '好友分组操作', 'artonce', 1, 1419434470),
(6, 0, '群组操作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '群组操作', '群组操作', 'artonce', 1, 1419434480),
(7, 0, '定位操作', 0, '0', NULL, 1, 1, 0, 1, '#', '_self', NULL, 'zh_cn', '定位操作', '定位操作', 'artonce', 1, 1419529144);

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

--
-- 转存表中的数据 `ign_feedback`
--


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

--
-- 转存表中的数据 `ign_goods`
--


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

--
-- 转存表中的数据 `ign_goods_extend`
--


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

--
-- 转存表中的数据 `ign_link`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='系统日志' AUTO_INCREMENT=50 ;

--
-- 转存表中的数据 `ign_log`
--

INSERT INTO `ign_log` (`Id`, `logType`, `describe`, `logTime`, `ip`, `emergeURL`, `userId`, `userType`) VALUES
(1, 0, '修改单页面成功！', 1419505259, '14.23.158.218', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(2, 0, '修改单页面成功！', 1419505447, '14.23.158.218', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(3, 0, '修改单页面成功！', 1419505525, '14.23.158.218', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(4, 0, '修改单页面成功！', 1419506612, '14.23.158.218', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(5, 0, '修改单页面成功！', 1419524174, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(6, 0, '修改单页面成功！', 1419524266, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(7, 0, '修改单页面成功！', 1419524349, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(8, 0, '修改单页面成功！', 1419524454, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(9, 0, '修改单页面成功！', 1419524543, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(10, 0, '添加单页面成功！', 1419524932, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(11, 0, '修改单页面成功！', 1419525183, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(12, 0, '修改单页面成功！', 1419525211, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(13, 0, '添加单页面成功！', 1419525405, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(14, 0, '修改单页面成功！', 1419525433, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(15, 0, '修改单页面成功！', 1419525531, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(16, 0, '修改单页面成功！', 1419525578, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(17, 0, '添加单页面成功！', 1419525728, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(18, 0, '添加单页面成功！', 1419525785, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(19, 0, '修改单页面成功！', 1419526052, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(20, 0, '添加单页面成功！', 1419526154, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(21, 0, '添加单页面成功！', 1419526372, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(22, 0, '修改单页面成功！', 1419526623, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(23, 0, '修改单页面成功！', 1419526661, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(24, 0, '修改单页面成功！', 1419527271, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(25, 0, '修改单页面成功！', 1419527415, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(26, 0, '修改单页面成功！', 1419527484, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(27, 0, '修改单页面成功！', 1419527522, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(28, 0, '修改单页面成功！', 1419527575, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(29, 0, '修改单页面成功！', 1419527779, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(30, 0, '修改单页面成功！', 1419527849, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(31, 0, '添加单页面成功！', 1419527988, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(32, 0, '添加单页面成功！', 1419528060, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(33, 0, '修改单页面成功！', 1419528377, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(34, 0, '修改单页面成功！', 1419528439, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(35, 0, '修改单页面成功！', 1419528483, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(36, 0, '修改单页面成功！', 1419528592, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(37, 0, '添加单页面成功！', 1419528863, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(38, 0, '添加单页面成功！', 1419528927, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(39, 0, '添加单页面成功！', 1419529019, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(40, 0, '添加单页面成功！', 1419529072, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(41, 0, '添加类别成功！', 1419529144, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/category/deal', 1, 0),
(42, 0, '添加单页面成功！', 1419529266, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(43, 0, '添加单页面成功！', 1419529441, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(44, 0, '添加单页面成功！', 1419529813, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(45, 0, '修改单页面成功！', 1419529994, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(46, 0, '修改单页面成功！', 1419530028, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(47, 0, '添加单页面成功！', 1419530242, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(48, 0, '添加单页面成功！', 1419530397, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/artonce/deal', 1, 0),
(49, 2, '注销成功！', 1419530569, '121.8.62.72', 'http://alinchen.sinaapp.com/index.php/admin/logout', 1, 0);

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

--
-- 转存表中的数据 `ign_member`
--


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

--
-- 转存表中的数据 `ign_msg`
--


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

--
-- 转存表中的数据 `ign_news`
--


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

--
-- 转存表中的数据 `ign_product`
--


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

--
-- 转存表中的数据 `ign_relefile`
--


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
