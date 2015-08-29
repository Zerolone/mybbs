<?php
/**
 * 日志删除操作
 * 
 * @author Zerolone
 * @version 2009-8-20 15:51:29
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

//接受pagenum
$pagenum=Request('pagenum',1);
$refresh_url	= 'log.php?pagenum='.$pagenum;

for($i = 0;$i<sizeof( $_POST["del"] );$i++){
	if($MyDatabase->Delete('log', '`id`='. $_POST["del"][$i])){
		$refresh_msg	= '删除操作日志列表[<font color=red>成功</font>]，返回操作日志列表显示页面。';
		
		//管理员日志
		$log_content			= '删除操作日志列表[<font color=red>成功</font>]，返回操作日志列表显示页面。';		
	}else{
		$refresh_msg	= '删除操作日志列表[<font color=red>失败</font>]，返回操作日志列表显示页面。';
		
		//管理员日志
		$log_content			= '删除操作日志列表[<font color=red>失败</font>]，返回操作日志列表显示页面。';		
	}
}
require('../../include/log.php');

require($page_name.'.php');
require('../../include/debug.php');
?>