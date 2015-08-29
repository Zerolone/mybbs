<?php
/**
 * 论坛公用文件
 * 
 * @version 2010-2-21
 * @author Zerolone
 */
//配置函数
if (strpos(' '.$_SERVER["HTTP_HOST"], 'localhost')){
	//本地调试用Config文件
	require('include/config_local.php');
}else{
	//网络用Config文件
	require('include/config.php');	
}

//函数地址
require('include/function.php');

//连接数据库
require('class/'.DB_TYPE.'.php');
//声明数据库
$MyDatabase=new Database();

//用户类
require 'class/user.php';

///////////////////Code///////////////////////////////////////////////////////////////////////////////////////////////////////////////////
$title='';
$forumtitle='';

//初始化用户
$user=new User();

//检测用户，取默认的用户名
$Refresh_msg=$user->checkUser($MyDatabase, '' , '');

//获取用户组信息
$group=$user->getGroupInfo($MyDatabase);

//如果Theme不为空，则
if ($user->theme){
	define('TP', 'template/'.$user->theme.'/');
}else{
	define('TP', $TP);
}
?>