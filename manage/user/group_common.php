<?php
/**
 * 用户组添加、修改公共页面
 * 
 * @version 2010-3-20 21:29:41
*/

$gid=Request('gid',0);//获取id
$title		= '';//初始化用户组
$permission	= 0;//初始化默认权限
$order = 1;//初始化顺序

$group=array(
'title' 		=> '',
'online'		=> '',
'offline'		=> '',
);

$SqlStr	= ' SELECT * FROM `' .DB_TABLE_PRE. 'user_group` ';
$SqlStr.= ' WHERE `gid`= ' . $gid;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$group = $MyDatabase->ResultArr [0];
}
?>