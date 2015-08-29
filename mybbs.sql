-- phpMyAdmin SQL Dump
-- version 3.1.3
-- http://www.phpmyadmin.net
--
-- 主机: localhost:3307
-- 生成日期: 2010 年 06 月 02 日 16:13
-- 服务器版本: 5.0.77
-- PHP 版本: 5.2.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `mybbs`
--

-- --------------------------------------------------------

--
-- 表的结构 `my_admin`
--

CREATE TABLE IF NOT EXISTS `my_admin` (
  `id` tinyint(4) unsigned NOT NULL auto_increment COMMENT '编号',
  `user` varchar(30) NOT NULL COMMENT '用户名',
  `pass` varchar(32) NOT NULL COMMENT '密码',
  `groupid` int(10) unsigned NOT NULL default '0' COMMENT '组编号',
  `order` int(10) unsigned NOT NULL default '0' COMMENT '顺序',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='管理员' AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_admin_group`
--

CREATE TABLE IF NOT EXISTS `my_admin_group` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT '编号',
  `title` varchar(255) NOT NULL COMMENT '组名',
  `permission` int(10) unsigned NOT NULL default '0' COMMENT '权限',
  `order` int(10) unsigned NOT NULL default '0' COMMENT '顺序',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='权限组' AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_announce`
--

CREATE TABLE IF NOT EXISTS `my_announce` (
  `id` smallint(6) unsigned NOT NULL auto_increment COMMENT '公告id',
  `startdate` int(10) unsigned NOT NULL COMMENT '发布公告时间',
  `level` varchar(4) NOT NULL COMMENT '有效板块(分类level,0为全部论坛）',
  `order` smallint(6) NOT NULL default '0' COMMENT '板快排列顺序',
  `title` varchar(100) NOT NULL COMMENT '公告标题',
  `content` mediumtext NOT NULL COMMENT '公告内容',
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='公告信息' AUTO_INCREMENT=129 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_attachs`
--

CREATE TABLE IF NOT EXISTS `my_attachs` (
  `aid` mediumint(8) unsigned NOT NULL auto_increment COMMENT '附件id',
  `fid` smallint(6) unsigned NOT NULL default '0' COMMENT '附件所在板块',
  `uid` mediumint(8) unsigned NOT NULL default '0' COMMENT '用户的id',
  `name` char(80) NOT NULL COMMENT '附件显示名',
  `type` char(30) NOT NULL COMMENT '文件类型',
  `size` int(10) unsigned NOT NULL default '0' COMMENT '文件大小',
  `attachurl` char(80) NOT NULL default '0' COMMENT '实际储存名',
  `uploadtime` int(10) NOT NULL default '0' COMMENT '上传时间',
  `descrip` char(100) NOT NULL COMMENT '对附件的描述',
  PRIMARY KEY  (`aid`),
  KEY `fid` (`fid`),
  KEY `uid` (`uid`),
  KEY `type` (`type`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='附件信息' AUTO_INCREMENT=15543 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_bbsinfo`
--

CREATE TABLE IF NOT EXISTS `my_bbsinfo` (
  `newmember` varchar(15) NOT NULL COMMENT '最新注册',
  `totalmember` mediumint(8) unsigned NOT NULL default '0' COMMENT '会员总数'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='论坛基本信息';

-- --------------------------------------------------------

--
-- 表的结构 `my_forums`
--

CREATE TABLE IF NOT EXISTS `my_forums` (
  `fid` smallint(6) unsigned NOT NULL auto_increment COMMENT '板块id',
  `logo` char(100) NOT NULL COMMENT '板块logo',
  `title` varchar(50) NOT NULL default 'MyBBS Board' COMMENT '板块名称',
  `content` varchar(255) default NULL COMMENT '板块介绍',
  `forumadmin` varchar(255) default NULL COMMENT '版主名单',
  `allowvisit` char(120) default NULL COMMENT '允许访问用户组',
  `allowpost` char(120) default NULL COMMENT '允许发贴用户组',
  `allowreply` char(120) default NULL COMMENT '允许回复用户组',
  `post_check` tinyint(1) unsigned NOT NULL default '0' COMMENT '发帖审核',
  `reply_check` tinyint(3) unsigned NOT NULL default '0' COMMENT '回复审核',
  `modify_check` tinyint(3) unsigned NOT NULL default '0' COMMENT '修改审核',
  `ifhide` tinyint(1) NOT NULL default '0' COMMENT '是否隐藏',
  `level` varchar(4) NOT NULL default '00' COMMENT '排序用的',
  `topic` mediumint(8) unsigned NOT NULL default '0' COMMENT '主题数',
  `post` mediumint(8) unsigned NOT NULL default '0' COMMENT '帖子数',
  `lastpost` varchar(255) default NULL COMMENT '最后一帖信息',
  PRIMARY KEY  (`fid`),
  KEY `level` (`level`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='板块设置相关' AUTO_INCREMENT=332 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_msg`
--

CREATE TABLE IF NOT EXISTS `my_msg` (
  `mid` int(10) unsigned NOT NULL auto_increment COMMENT '短消息id',
  `touid` mediumint(8) unsigned NOT NULL default '0' COMMENT '接受人id',
  `fromuid` mediumint(8) unsigned NOT NULL default '0' COMMENT '发信人id',
  `username` varchar(15) NOT NULL COMMENT '发信人',
  `type` enum('rebox','sebox') NOT NULL default 'rebox' COMMENT '所处信箱',
  `ifnew` tinyint(1) NOT NULL default '0' COMMENT '是否已读',
  `title` varchar(130) NOT NULL COMMENT '标题',
  `mdate` int(10) unsigned NOT NULL default '0' COMMENT '发信时间',
  `content` text NOT NULL COMMENT '内容',
  PRIMARY KEY  (`mid`),
  KEY `touid` (`touid`),
  KEY `fromuid` (`fromuid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='短消息相关' AUTO_INCREMENT=35 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_posts`
--

CREATE TABLE IF NOT EXISTS `my_posts` (
  `id` int(10) unsigned NOT NULL auto_increment COMMENT '回复id',
  `fid` smallint(6) unsigned NOT NULL default '0' COMMENT '贴子所在板块',
  `tid` mediumint(8) unsigned NOT NULL default '0' COMMENT '贴子id',
  `author` varchar(15) NOT NULL COMMENT '作者',
  `authorid` mediumint(8) unsigned NOT NULL default '0' COMMENT '作者uid',
  `icon` tinyint(2) NOT NULL default '0' COMMENT '贴子使用表情',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `userip` varchar(15) NOT NULL COMMENT '用户ip',
  `ifsign` tinyint(1) NOT NULL default '0' COMMENT '是否显示签名',
  `alterinfo` varchar(50) default NULL COMMENT '重编辑信息（不纪录论坛创始人和管理员的）',
  `ifcheck` tinyint(1) NOT NULL default '0' COMMENT '是否已验证',
  `content` mediumtext NOT NULL COMMENT '内容',
  `postdate` int(10) unsigned NOT NULL COMMENT '发帖时间',
  PRIMARY KEY  (`id`),
  KEY `fid` (`fid`),
  KEY `tid` (`tid`),
  KEY `authorid` (`authorid`),
  KEY `ifcheck` (`ifcheck`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='回复贴信息表' AUTO_INCREMENT=279454 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_topics`
--

CREATE TABLE IF NOT EXISTS `my_topics` (
  `tid` mediumint(8) unsigned NOT NULL auto_increment COMMENT '贴子id',
  `fid` smallint(6) NOT NULL default '0' COMMENT '板块id',
  `icon` tinyint(2) NOT NULL default '0' COMMENT '贴子图标',
  `author` char(15) NOT NULL COMMENT '发贴人',
  `authorid` mediumint(8) unsigned NOT NULL default '0' COMMENT '发贴人id',
  `title` varchar(255) NOT NULL COMMENT '标题',
  `ifcheck` tinyint(1) NOT NULL default '0' COMMENT '是否验证',
  `postdate` int(10) unsigned NOT NULL COMMENT '发贴时间',
  `lastpost` int(10) unsigned NOT NULL COMMENT '回复时间',
  `lastposter` char(15) NOT NULL COMMENT '最后回复人',
  `hits` int(10) unsigned NOT NULL default '1' COMMENT '点击率',
  `replies` int(10) unsigned NOT NULL default '0' COMMENT '回复人数',
  `top` smallint(6) NOT NULL default '0' COMMENT '顶置信息0为不顶置，以此类推',
  `lock` tinyint(1) unsigned NOT NULL default '0' COMMENT '是否锁定',
  `ifupload` tinyint(1) NOT NULL default '0' COMMENT '是否上传附件',
  PRIMARY KEY  (`tid`),
  KEY `authorid` (`authorid`),
  KEY `topped` (`top`),
  KEY `ifcheck` (`ifcheck`),
  KEY `lastpost` (`fid`,`top`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='发贴基本信息表' AUTO_INCREMENT=36010 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_topics_ext`
--

CREATE TABLE IF NOT EXISTS `my_topics_ext` (
  `tid` mediumint(8) unsigned NOT NULL default '0' COMMENT '贴子id',
  `userip` varchar(15) NOT NULL COMMENT '来源ip',
  `ifsign` tinyint(1) NOT NULL default '0' COMMENT '是否使用签名',
  `alterinfo` varchar(50) default NULL COMMENT '重编辑信息（不纪录论坛创始人和管理员的）',
  `content` mediumtext NOT NULL COMMENT '贴子内容',
  `ifmark` varchar(255) default NULL COMMENT '评分信息',
  `icon` tinyint(3) unsigned NOT NULL default '0' COMMENT '图标',
  `authorid` mediumint(8) unsigned NOT NULL COMMENT '用户编号',
  PRIMARY KEY  (`tid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='发贴扩展信息表';

-- --------------------------------------------------------

--
-- 表的结构 `my_users`
--

CREATE TABLE IF NOT EXISTS `my_users` (
  `uid` mediumint(8) unsigned NOT NULL auto_increment COMMENT '用户id',
  `username` varchar(20) NOT NULL COMMENT '用户名',
  `password` varchar(40) NOT NULL COMMENT '密码hash',
  `email` varchar(60) NOT NULL COMMENT 'email',
  `groupid` tinyint(3) NOT NULL default '-1' COMMENT '用户组id',
  `groups` varchar(255) default NULL COMMENT '附加用户组头衔id',
  `icon` varchar(100) NOT NULL COMMENT '图像',
  `gender` tinyint(1) NOT NULL default '0' COMMENT '性别',
  `regdate` int(10) unsigned NOT NULL default '0' COMMENT '注册时间',
  `signature` text NOT NULL COMMENT '个性签名',
  `introduce` text NOT NULL COMMENT '自我简介',
  `oicq` varchar(12) NOT NULL COMMENT '用户的oicq',
  `site` varchar(75) NOT NULL COMMENT '个人主页',
  `location` varchar(36) NOT NULL COMMENT '来自',
  `bday` date NOT NULL default '0000-00-00' COMMENT '生日',
  `active` tinyint(1) unsigned NOT NULL default '1' COMMENT '是否通过验证',
  `newpm` tinyint(1) NOT NULL default '0' COMMENT '是否有新短消息',
  `showsign` tinyint(1) unsigned NOT NULL default '1' COMMENT '个性化签名(默认为1无个性化签名)',
  PRIMARY KEY  (`uid`),
  KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='会员主信息表' AUTO_INCREMENT=112920 ;

-- --------------------------------------------------------

--
-- 表的结构 `my_user_ext`
--

CREATE TABLE IF NOT EXISTS `my_user_ext` (
  `uid` mediumint(8) unsigned NOT NULL default '1' COMMENT '用户id',
  `postnum` int(10) unsigned NOT NULL default '0' COMMENT '发贴数',
  `rvrc` int(10) NOT NULL default '0' COMMENT '威望',
  `money` int(10) NOT NULL default '0' COMMENT '金钱',
  `lastvisit` int(10) unsigned NOT NULL default '0' COMMENT '最后访问时间',
  `thisvisit` int(10) unsigned NOT NULL default '0' COMMENT '此次访问时间',
  `lastpost` int(10) unsigned NOT NULL default '0' COMMENT '最后发贴时间',
  `todaypost` smallint(6) unsigned NOT NULL default '0' COMMENT '今日发贴',
  `uploadtime` int(10) unsigned NOT NULL default '0' COMMENT '最后上传文件时间',
  `onlineip` char(30) NOT NULL COMMENT '在线ip以及登陆相关信息（密码错误次数）',
  PRIMARY KEY  (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户基本信息';

-- --------------------------------------------------------

--
-- 表的结构 `my_user_group`
--

CREATE TABLE IF NOT EXISTS `my_user_group` (
  `gid` smallint(5) unsigned NOT NULL auto_increment COMMENT '用户组id',
  `title` varchar(60) NOT NULL COMMENT '用户组名',
  `online` varchar(255) default NULL COMMENT '在线图标',
  `offline` varchar(255) default NULL COMMENT '离线图标',
  `post` int(10) unsigned NOT NULL default '0' COMMENT '升级贴数需求',
  `allowread` tinyint(1) NOT NULL default '0' COMMENT '是否允许浏览帖子',
  `allowicon` tinyint(1) NOT NULL default '0' COMMENT '是否允许用户使用自定义头像',
  `allowreply` tinyint(1) NOT NULL default '0' COMMENT '是否允许回复主题',
  `allowpost` tinyint(1) NOT NULL default '0' COMMENT '是否允许发表主题',
  `allowsearch` tinyint(1) NOT NULL default '0' COMMENT '搜索权限控制',
  `allowprofile` tinyint(1) NOT NULL default '0' COMMENT '允许查看会员资料',
  `allowmessege` tinyint(1) NOT NULL default '0' COMMENT '允许发送短消息',
  `allowupload` tinyint(1) NOT NULL default '0' COMMENT '允许上传附件',
  `edittime` mediumint(6) NOT NULL default '0' COMMENT '编辑时间约束(分)',
  `post_check` tinyint(1) NOT NULL default '0' COMMENT '发贴审核',
  `reply_check` tinyint(3) unsigned NOT NULL default '0' COMMENT '回复审核',
  `order` tinyint(3) unsigned NOT NULL default '1' COMMENT '顺序',
  PRIMARY KEY  (`gid`),
  KEY `grouppost` (`post`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='用户组信息' AUTO_INCREMENT=109 ;

-- --------------------------------------------------------

--
-- Stand-in structure for view `my_view_admin`
--
CREATE TABLE IF NOT EXISTS `my_view_admin` (
`pass` varchar(32)
,`id` tinyint(4) unsigned
,`user` varchar(30)
,`title` varchar(255)
,`permission` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `my_view_forum`
--
CREATE TABLE IF NOT EXISTS `my_view_forum` (
`fid` smallint(6) unsigned
,`logo` char(100)
,`title` varchar(50)
,`content` varchar(255)
,`forumadmin` varchar(255)
,`allowvisit` char(120)
,`allowpost` char(120)
,`allowreply` char(120)
,`ifhide` tinyint(1)
,`atitle` varchar(100)
,`aid` smallint(6) unsigned
,`level` varchar(4)
,`topic` mediumint(8) unsigned
,`startdate` int(10) unsigned
,`acontent` mediumtext
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `my_view_posts`
--
CREATE TABLE IF NOT EXISTS `my_view_posts` (
`id` int(10) unsigned
,`fid` smallint(6) unsigned
,`tid` mediumint(8) unsigned
,`author` varchar(15)
,`authorid` mediumint(8) unsigned
,`icon` tinyint(2)
,`postdate` int(10) unsigned
,`title` varchar(255)
,`userip` varchar(15)
,`ifsign` tinyint(1)
,`alterinfo` varchar(50)
,`ifcheck` tinyint(1)
,`content` mediumtext
,`uid` mediumint(8) unsigned
,`username` varchar(20)
,`gender` tinyint(1)
,`groupid` tinyint(3)
,`oicq` varchar(12)
,`micon` varchar(100)
,`regdate` int(10) unsigned
,`signature` text
,`postnum` int(10) unsigned
,`rvrc` int(10)
,`money` int(10)
,`thisvisit` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `my_view_topic`
--
CREATE TABLE IF NOT EXISTS `my_view_topic` (
`tid` mediumint(8) unsigned
,`fid` smallint(6)
,`icon` tinyint(2)
,`author` char(15)
,`authorid` mediumint(8) unsigned
,`title` varchar(255)
,`ifcheck` tinyint(1)
,`postdate` int(10) unsigned
,`lastposter` char(15)
,`hits` int(10) unsigned
,`replies` int(10) unsigned
,`top` smallint(6)
,`lock` tinyint(1) unsigned
,`userip` varchar(15)
,`ifsign` tinyint(1)
,`alterinfo` varchar(50)
,`content` mediumtext
,`uid` mediumint(8) unsigned
,`username` varchar(20)
,`gender` tinyint(1)
,`groupid` tinyint(3)
,`micon` varchar(100)
,`signature` text
,`regdate` int(10) unsigned
,`postnum` int(10) unsigned
,`rvrc` int(10)
,`money` int(10)
,`showsign` tinyint(1) unsigned
,`oicq` varchar(12)
,`thisvisit` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `my_view_topic_ext`
--
CREATE TABLE IF NOT EXISTS `my_view_topic_ext` (
`tid` mediumint(8) unsigned
,`fid` smallint(6)
,`author` char(15)
,`authorid` mediumint(8) unsigned
,`icon` tinyint(2)
,`lock` tinyint(1) unsigned
,`postdate` int(10) unsigned
,`title` varchar(255)
,`ifcheck` tinyint(1)
,`ifsign` tinyint(1)
,`content` mediumtext
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `my_view_user`
--
CREATE TABLE IF NOT EXISTS `my_view_user` (
`uid` mediumint(8) unsigned
,`username` varchar(20)
,`password` varchar(40)
,`email` varchar(60)
,`oicq` varchar(12)
,`groupid` tinyint(3)
,`regdate` int(10) unsigned
,`newpm` tinyint(1)
,`showsign` tinyint(1) unsigned
,`postnum` int(10) unsigned
,`rvrc` int(10)
,`money` int(10)
,`lastvisit` int(10) unsigned
,`thisvisit` int(10) unsigned
,`lastpost` int(10) unsigned
,`todaypost` smallint(6) unsigned
,`uploadtime` int(10) unsigned
,`icon` varchar(100)
,`signature` text
,`introduce` text
,`gender` tinyint(1)
,`bday` date
,`site` varchar(75)
,`active` tinyint(1) unsigned
,`onlineip` char(30)
);
-- --------------------------------------------------------

--
-- Stand-in structure for view `soutuan8`
--
CREATE TABLE IF NOT EXISTS `soutuan8` (
`pass` varchar(32)
,`id` tinyint(4) unsigned
,`user` varchar(30)
,`title` varchar(255)
,`permission` int(10) unsigned
);
-- --------------------------------------------------------

--
-- Structure for view `my_view_admin`
--
DROP TABLE IF EXISTS `my_view_admin`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `my_view_admin` AS select `a`.`pass` AS `pass`,`a`.`id` AS `id`,`a`.`user` AS `user`,`g`.`title` AS `title`,`g`.`permission` AS `permission` from (`my_admin` `a` join `my_admin_group` `g` on((`a`.`groupid` = `g`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `my_view_forum`
--
DROP TABLE IF EXISTS `my_view_forum`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `my_view_forum` AS select `f`.`fid` AS `fid`,`f`.`logo` AS `logo`,`f`.`title` AS `title`,`f`.`content` AS `content`,`f`.`forumadmin` AS `forumadmin`,`f`.`allowvisit` AS `allowvisit`,`f`.`allowpost` AS `allowpost`,`f`.`allowreply` AS `allowreply`,`f`.`ifhide` AS `ifhide`,`a`.`title` AS `atitle`,`a`.`id` AS `aid`,`a`.`level` AS `level`,`f`.`topic` AS `topic`,`a`.`startdate` AS `startdate`,`a`.`content` AS `acontent` from (`my_forums` `f` left join `my_announce` `a` on((`f`.`level` = `a`.`level`))) order by `a`.`order`;

-- --------------------------------------------------------

--
-- Structure for view `my_view_posts`
--
DROP TABLE IF EXISTS `my_view_posts`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `my_view_posts` AS select `p`.`id` AS `id`,`p`.`fid` AS `fid`,`p`.`tid` AS `tid`,`p`.`author` AS `author`,`p`.`authorid` AS `authorid`,`p`.`icon` AS `icon`,`p`.`postdate` AS `postdate`,`p`.`title` AS `title`,`p`.`userip` AS `userip`,`p`.`ifsign` AS `ifsign`,`p`.`alterinfo` AS `alterinfo`,`p`.`ifcheck` AS `ifcheck`,`p`.`content` AS `content`,`m`.`uid` AS `uid`,`m`.`username` AS `username`,`m`.`gender` AS `gender`,`m`.`groupid` AS `groupid`,`m`.`oicq` AS `oicq`,`m`.`icon` AS `micon`,`m`.`regdate` AS `regdate`,`m`.`signature` AS `signature`,`md`.`postnum` AS `postnum`,`md`.`rvrc` AS `rvrc`,`md`.`money` AS `money`,`md`.`thisvisit` AS `thisvisit` from ((`my_posts` `p` left join `my_users` `m` on((`p`.`authorid` = `m`.`uid`))) left join `my_user_ext` `md` on((`p`.`authorid` = `md`.`uid`)));

-- --------------------------------------------------------

--
-- Structure for view `my_view_topic`
--
DROP TABLE IF EXISTS `my_view_topic`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `my_view_topic` AS select `t`.`tid` AS `tid`,`t`.`fid` AS `fid`,`t`.`icon` AS `icon`,`t`.`author` AS `author`,`t`.`authorid` AS `authorid`,`t`.`title` AS `title`,`t`.`ifcheck` AS `ifcheck`,`t`.`postdate` AS `postdate`,`t`.`lastposter` AS `lastposter`,`t`.`hits` AS `hits`,`t`.`replies` AS `replies`,`t`.`top` AS `top`,`t`.`lock` AS `lock`,`te`.`userip` AS `userip`,`te`.`ifsign` AS `ifsign`,`te`.`alterinfo` AS `alterinfo`,`te`.`content` AS `content`,`m`.`uid` AS `uid`,`m`.`username` AS `username`,`m`.`gender` AS `gender`,`m`.`groupid` AS `groupid`,`m`.`icon` AS `micon`,`m`.`signature` AS `signature`,`m`.`regdate` AS `regdate`,`md`.`postnum` AS `postnum`,`md`.`rvrc` AS `rvrc`,`md`.`money` AS `money`,`m`.`showsign` AS `showsign`,`m`.`oicq` AS `oicq`,`md`.`thisvisit` AS `thisvisit` from (((`my_topics` `t` left join `my_topics_ext` `te` on((`t`.`tid` = `te`.`tid`))) left join `my_users` `m` on((`t`.`authorid` = `m`.`uid`))) join `my_user_ext` `md` on((`t`.`authorid` = `md`.`uid`)));

-- --------------------------------------------------------

--
-- Structure for view `my_view_topic_ext`
--
DROP TABLE IF EXISTS `my_view_topic_ext`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `my_view_topic_ext` AS select `t`.`tid` AS `tid`,`t`.`fid` AS `fid`,`t`.`author` AS `author`,`t`.`authorid` AS `authorid`,`t`.`icon` AS `icon`,`t`.`lock` AS `lock`,`t`.`postdate` AS `postdate`,`t`.`title` AS `title`,`t`.`ifcheck` AS `ifcheck`,`te`.`ifsign` AS `ifsign`,`te`.`content` AS `content` from (`my_topics` `t` join `my_topics_ext` `te` on((`t`.`tid` = `te`.`tid`)));

-- --------------------------------------------------------

--
-- Structure for view `my_view_user`
--
DROP TABLE IF EXISTS `my_view_user`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `my_view_user` AS select `m`.`uid` AS `uid`,`m`.`username` AS `username`,`m`.`password` AS `password`,`m`.`email` AS `email`,`m`.`oicq` AS `oicq`,`m`.`groupid` AS `groupid`,`m`.`regdate` AS `regdate`,`m`.`newpm` AS `newpm`,`m`.`showsign` AS `showsign`,`md`.`postnum` AS `postnum`,`md`.`rvrc` AS `rvrc`,`md`.`money` AS `money`,`md`.`lastvisit` AS `lastvisit`,`md`.`thisvisit` AS `thisvisit`,`md`.`lastpost` AS `lastpost`,`md`.`todaypost` AS `todaypost`,`md`.`uploadtime` AS `uploadtime`,`m`.`icon` AS `icon`,`m`.`signature` AS `signature`,`m`.`introduce` AS `introduce`,`m`.`gender` AS `gender`,`m`.`bday` AS `bday`,`m`.`site` AS `site`,`m`.`active` AS `active`,`md`.`onlineip` AS `onlineip` from (`my_users` `m` left join `my_user_ext` `md` on((`m`.`uid` = `md`.`uid`)));

-- --------------------------------------------------------

--
-- Structure for view `soutuan8`
--
DROP TABLE IF EXISTS `soutuan8`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `soutuan8` AS select `a`.`pass` AS `pass`,`a`.`id` AS `id`,`a`.`user` AS `user`,`g`.`title` AS `title`,`g`.`permission` AS `permission` from (`my_admin` `a` join `my_admin_group` `g` on((`a`.`groupid` = `g`.`id`)));
