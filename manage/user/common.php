<?php
/**
 * 用户修改公共页面
 * 
 * @version 2010-3-25 20:55:54
 * @author Zerolone
*/

//获取uid
$uid=Request('uid',0);

//获取用户信息
$SqlStr	= 'SELECT * FROM `' .DB_TABLE_PRE. 'view_user` WHERE `uid`= ' . $uid;
$MyDatabase->SqlStr=$SqlStr;
if ($MyDatabase->Query ()) {
	$user = $MyDatabase->ResultArr[0];
}
?>