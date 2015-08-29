<?php
//计算花费时间 count cost time
$startime	= microtime();

//是否显示调试信息 show debug info 说明：1为显示，其他为不显示
define('SHOW_DEBUG', 1);

//数据库查询次数 query count
$query_count = 0;

//版本检测
if (version_compare(PHP_VERSION, '5.2.0', '<')) {
    die('本系统需要PHP版本为5.2以上，你的版本为：' . PHP_VERSION . "，请升级你的PHP版本。");
}
	
/**
 * 数据库定义 Database Define
 */
define('DB_TYPE',				'mysql5');
define('DB_USER',				'admin');
define('DB_PASS',				'12345678');
define('DB_HOST',				'localhost');
define('DB_PORT',				'3306');
define('DB_NAME',				'MyBBS');
define('DB_LANG',				'UTF8');
define('DB_TABLE_PRE',	'my_');	
//-----------------------------------------------------------

//版本
//$site_version
$site_version = 'V4.0.0';

//网站物理路径 site dir
define('SITE_DIR',				'/data0/htdocs/www/');
define('SITE_URL',				'http://192.168.128.104/');

//网站目录， 如果为根目录， 则为空
define('SITE_FOLDER',			'/my');

//图片路径
define('IMAGEURL',			SITE_FOLDER.'/upload/');
define('IMAGEPATH',			SITE_DIR.IMAGEURL);

//日志
define('SITE_LOG',	SITE_DIR . 'log.log');

//常规设置
//页面跳转时间(秒)
define('REFRESH_TIME',300);

/**
 * 默认账号设置
 */
define('ADMINUSER','admin');
define('ADMINPASS','admin');

define('NAME', 'Zerolone');
define('PASS','Zerolone');

//默认组
define('GROUPID',13);
//默认权限
define('PERMISSION',524440);

//显示所有错误，警告提示
error_reporting(E_ALL);

//取消警告
//error_reporting(E_ALL & ~E_NOTICE);
//取消所有错误提示
//error_reporting(0);

/**
 * Cookies方面
 */

//COOKIE有效目录，使一个空间放置多个论坛,都能访问!
define('DB_CKPATH','/');

//COOKIE有效域名
define('DB_CKDOMAIN','');

/**
 * 论坛设置方面
 */
//论坛首页调用文件
define('BBS_INDEX', 'index.php');

//论坛首页名
define('BBS_NAME', 'MyBBS Board');

//默认首页导航
define('BBS_NAV','<img src="image/home.gif"> <b><a href="'.BBS_INDEX.'">'.BBS_NAME.'</a>');

//自定义首页各版块的图片logo //0-不使用 //1-自定义
define('BBS_FM_LOGO',1);

//论坛关键字-以及说明
define('BBS_KEYWORD','');
define('BBS_DESC','');

//是否开启IP验证功能：可以加强论坛安全，选择开启将对登录者ip进行验证，如果与上一次登录ip前2位不同，将要求重新登录
define('SAFE_IPCHECK',0);

/**
 * 时间方面
 */
//是否记录会员在线时间并在版块内显示
define('TIME_ONLINE', 1);

//在线用户时限（多少分钟内有动作视为在线）
define('TIME_ONLINETIME', 3600);

//在线用户时限（多少分钟内有动作视为在线）
define('DB_ONLINETIME', 3600);

//在线用户时限（多少秒内有动作视为在线）
define('ONLINETIME', 3600);

//分版块文章多少时间表示为新帖(3600=1小时)
define('TIME_NEW',3600);

//默认时区
date_default_timezone_set('PRC');

//返回自从 Unix 纪元（格林威治时间 1970 年 1 月 1 日 00:00:00）到当前时间的秒数。
define('TIMESTAMP', time());

//参与在线显示的用户组
define('GROUP_SHOW',',1,3,4,5,16,');

//首页是否显示在线游客
define('GUEST_SHOW',1);

//首页是否显示在线用户
define('MEMBER_SHOW',1);

/**
 * 分页
 */
//论坛文章列表每页显示主题数 
define('PAGE_PER', 20);

//阅读一主题时每页显示帖子数
define('READ_PER', 10);


//后台论坛文章列表每页显示主题数 
define('PAGE_PER_B', 15);

//方式					//威望//金币//好评
//发布一个主题    10    10		0
//回复一个主题		0			5			0
define('CREDIT_POST_RVRC', 	1);
define('CREDIT_POST_MONEY', 10);

define('CREDIT_REPLAY_RVRC', 	0);
define('CREDIT_REPLAY_MONEY', 5);

//货币名称  货币单位  威望名称  威望单位
define('CREDIT_RVRC', '爱心');
define('CREDIT_RVRC_EXT','点');
define('CREDIT_MONEY','金币');
define('CREDIT_MONEY_EXT','个');

/**
 * 文件上传部分
 */
//一次最多上传附件个数
define('UPLOAD_FILES', 4);

//是否使用附件上传功能
define('UPLOAD',1);

//允许上传的附件
define('UPLOAD_EXT', ' gif jpg png');

//最大上传数
define('UPLOAD_MAX', 2048);

//用户方面
define('GID', 8);
?>