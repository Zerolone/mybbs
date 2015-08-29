<?php
/**
* 文章系统中的图片删除功能
*
* @version 2009-12-23 9:48:03
* @author Zerolone
*/
require ('../include/common.php');

$page_name	= '../../include/refresh.php';
$refresh_msg	= '图片删除[<font color=blue>不成功</font>]，返回图片显示页面。';

//接受pagenum
$pagenum=Request('pagenum', 1);

if( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		//获取图片名
		$SqlStr	= 'SELECT `url` FROM '.DB_TABLE_PRE.'article_pic';
		$SqlStr.= ' WHERE `id`='. $_POST["del"][$i];
		$SqlStr.= ' LIMIT 1';
		//echo $SqlStr;
		$MyDatabase->SqlStr = $SqlStr;
		if ($MyDatabase->Query ()) {
			$DB_Record = $MyDatabase->ResultArr [0];

			//删除文件
			deleteFile(SITE_DIR.$DB_Record[0]);
		}
		
		$SqlStr = 'DELETE FROM `'. DB_TABLE_PRE .'article_pic` WHERE `id`='. $_POST["del"][$i];

		$MyDatabase->SqlStr = $SqlStr;
		$MyDatabase->ExecuteQuery ();
	}
	$refresh_msg	= '删除图片[<font color=red>成功</font>]，返回图片显示页面。';
}

$refresh_url	= 'upload_pic.php?pagenum='.$pagenum;

require($page_name.'.php');

//管理员日志
require('../../include/log.php');
require('../../include/debug.php');
?>