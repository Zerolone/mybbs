<?php
/**
 * 用户添加、修改公共页面
 * 
 * @version 2009-3-3 14:59:20
*/

//获取id
$id=Request('id',0);

//初始化用户名
$user		= '';

//初始化默认组
$groupid	= 1;

//初始化提示内容
$mode_note='';

//初始化顺序
$order			=	1;

//获取用户信息
//-------------------0----------1--------2
$SqlStr	= 'SELECT `user`, `groupid`, `order` FROM `' .DB_TABLE_PRE. 'admin` WHERE `id`= ' . $id;
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$user				= $DB_Record[0];
	$groupid		= $DB_Record[1];
	$order			= $DB_Record[2];
}

//获取用户组
//------------------0------1
$SqlStr	= 'SELECT `id`, `title` FROM `' .DB_TABLE_PRE. 'admin_group` ORDER BY `order` ASC';
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr=$MyDatabase->ResultArr;
	foreach ($DB_Record_Arr as $DB_Record){
		$selected='';
		if ($groupid==$DB_Record[0]) 
		{
			$selected='selected';	
		}	
		
		$group_list[] = array(
		'id' 					=> $DB_Record[0],
		'title'				=> $DB_Record[1],
		'selected'		=> $selected
		);
	}
}
?>