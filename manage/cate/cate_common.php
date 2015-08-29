<?php
/**
 * 分类修改公共页面
 * 
 * @version 2010-3-24 16:24:24
 * @author  Zerolone
*/

$fid		= Request('fid', 0);		//获取编号
$SqlStr	= ' SELECT * FROM `' .DB_TABLE_PRE. 'forums` ';
$SqlStr.= ' WHERE `fid`= ' . $fid;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$forum = $MyDatabase->ResultArr [0];
}
?>