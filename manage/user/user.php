<?php
/**
 * 用户列表显示
 *
 * @version 2010-3-24 20:29:10
 * @author Zerolone
*/

require('../include/common.php');
define('PAGENAME', 'user.php');

//加载所有的等级
$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'user_group` ORDER BY `post`, `gid`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$UserGroups = $MyDatabase->ResultArr;
	
	//重新定义一下组、图片和名字
	foreach ( $UserGroups as $group ) {
		$groups[$group['gid']]=array(
			'online'		=> $group['online'],
			'offline'		=> $group['offline'],
			'title'			=> $group['title'],
		);
	}		
}else {
	DebugStr($MyDatabase->SqlStr);
	echo '文件：'.__FILE__;	echo '<br />行数：'.__LINE__;	echo '<br />原因：';ErrorMsg('读取用户组出错！');
}

$pagenum 			= Request('pagenum',1);	//读取页数
$pagesize 		= 20 ;									//页面记录数
$recordcount	= 0;										//总记录

//获取查询用的一些东西
$SqlWhere=' WHERE 1=1';
$gid=Request('gid',0);
if($gid){
	$SqlWhere.= ' AND `groupid`='.$gid;
}

//
$username=Request('username');
if($username){
	$SqlWhere.=' AND `username` like \'%' . $username . '%\'';
}

$SqlStr	= 'SELECT COUNT( * ) AS `count` FROM `'.DB_TABLE_PRE.'users`';
$SqlStr.=$SqlWhere;
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$recordcount = $MyDatabase->ResultArr [0]['count'];
}

//管理员列表
$SqlStr	= 'SELECT * ';
$SqlStr.= ' FROM `'.DB_TABLE_PRE.'users`';
$SqlStr.=$SqlWhere;
$SqlStr.= ' ORDER BY `uid` DESC';
$SqlStr.= ' LIMIT '. $pagesize * ($pagenum-1) .' ,'.$pagesize.';';
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$users_list=$MyDatabase->ResultArr;
}

require(PAGENAME.'.php');
require('../../include/debug.php');

//管理员日志
$log_content			= '用户 &gt;&gt; 列表';
require('../../include/log.php');
?>