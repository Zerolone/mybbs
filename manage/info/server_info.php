<?php
	require('../include/common.php');
?>
<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="../../css/manage.css" type="text/css" media="all"  />

</head>
<body scroll="no">
<?php
	@mkdir("check_test", 0777);
	$fd1 = @fopen("check_test/index.txt","wb");
	@fwrite($fd1,"test test again");
	@fclose($fd1);
	$jephp_status = file_exists("check_test/index.txt") ? "<font color=green>允许</font>" : "<font color=red>禁止</font>";
	@unlink("check_test/index.txt");
	@rmdir("check_test");
	$phpver = PHP_VERSION;
	$server_env = get_cfg_var("register_globals")=="1" ? "ON" : "OFF";
	$server_tout = get_cfg_var("max_execution_time");
	$server_time = date("Y年m月d日 H时i分s秒");
	$phpos = php_uname();
	if(get_cfg_var("file_uploads")) {
		$max_size = get_cfg_var("upload_max_filesize");
		$server_upload_status = "允许，最大 $max_size";
	} else {
		$server_upload_status = "不允许上传附件";
	}
	if(function_exists("imageline")) {
		$pic="<font color=green>支持</font>";
	} else {
		$pic="<font color=red>不支持</font>";
	}
?>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
		<tr bgcolor="#6A6A6A" height="26">
			<td colspan="2"><b><font color="#FFFFFF">常规设置 &gt;&gt; 服务器参数</font></b></td>
		</tr>
		<tr>
			<td align="right" width="150" bgcolor="#999999" height="20"><font color="#FFFFFF">PHP程序版本：</font></td>
			<td bgcolor="#FFFFFF">&nbsp;<?=$phpver?></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">服务端操作系统信息： </font></td>
			<td bgcolor="#FFFFFF">&nbsp;<?=$phpos?></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">自动定义全局变量：</font></td>
			<td bgcolor="#FFFFFF">&nbsp;<?=$server_env?></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">创建目录写文件权限：</font></td>
			<td bgcolor="#FFFFFF">&nbsp;<?=$jephp_status?></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">是否允许上传文件：</font></td>
			<td bgcolor="#FFFFFF">&nbsp;<?=$server_upload_status?></b></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">脚本超时限制：</font></td>
			<td bgcolor="#FFFFFF">&nbsp;<?=$server_tout?></b> 秒</td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">服务器当前时间： </font></td>
			<td bgcolor="#FFFFFF">&nbsp;<?=$server_time?></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">GD库： </font></td>
			<td bgcolor="#FFFFFF">&nbsp;<?=$pic?></td>
		</tr>
</table>
<?php
//管理员日志
$log_content			= '站点信息 &gt;&gt; 服务器参数 &gt;&gt; 查看';

require('../../include/log.php');
?>
</body>
</html>