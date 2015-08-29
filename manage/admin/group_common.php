<?php
/**
 * 用户组添加、修改公共页面
 * 
 * @version 2010-3-20 21:29:41
*/

$id=Request('id',0);//获取id
$title		= '';//初始化用户组
$permission	= 0;//初始化默认权限
$order = 1;//初始化顺序

$group=array(
'title' 			=> '新板块',
'logo'				=> '',
'forumadmin'	=> '',
'post_check'	=>0,
'reply_check'	=>0,
'content'			=>'',
);

$SqlStr	= ' SELECT * FROM `' .DB_TABLE_PRE. 'forums` ';
$SqlStr.= ' WHERE `fid`= ' . $fid;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$group = $MyDatabase->ResultArr [0];
}
?>