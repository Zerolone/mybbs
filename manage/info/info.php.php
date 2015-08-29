<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="../../css/manage.css" type="text/css" >

</head>
<body scroll="no">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
		<form action="info_update.php" method="POST">		
		<tr>
			<td height="20" colspan="2" bgcolor="#6A6A6A"><font color="#FFFFFF"><b>站点相关设置</b></font></td>
			</tr>
		<tr>
			<td width="120" height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">网址：</font></td>
			<td bgcolor="#FFFFFF"><?=SITE_URL?></td>
		</tr>
		<tr>
			<td height="20" colspan="2" bgcolor="#6A6A6A"><font color="#FFFFFF"><b>管理设置</b></font></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">刷新时间：</font></td>
			<td bgcolor="#FFFFFF"><?=REFRESH_TIME?>秒</td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">显示调试信息：</font></td>
			<td bgcolor="#FFFFFF"><?=SHOW_DEBUG?></td>
		</tr>
		<!--
		<tr>
			<td height="20" colspan="2" bgcolor="#999999"><font color="#FFFFFF"><b>采集设置（未启用）</b></font></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">一次采集数：</font></td>
			<td bgcolor="#FFFFFF"><input name="LimitCount" type="text" class="inputbox" id="LimitCount" onMouseOver="select();" size="90" maxlength="120" /></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">刷新时间：</font></td>
			<td bgcolor="#FFFFFF"><input name="RefreshTime" type="text" class="inputbox" id="RefreshTime" onMouseOver="select();" size="90" maxlength="120" /></td>
		</tr>
		-->
		<!-- 文件保存设置_开始 -->
		<tr>
			<td height="20" colspan="2" bgcolor="#6A6A6A"><font color="#FFFFFF"><b>文件保存设置</b>【请确保服务端存在此路径】</font></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">物理路径：</font></td>
			<td bgcolor="#FFFFFF"><?=SITE_DIR?>	完整的路径</td>
		</tr>
		<!-- 文件保存设置_结束 -->
		<!-- 数据库设置_开始 -->
		<tr>
			<td height="20" colspan="2" bgcolor="#6A6A6A"><font color="#FFFFFF"><b>数据库设置</b></font></td>
		</tr>

		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">用户名：</font></td>
			<td bgcolor="#FFFFFF"><?=DB_USER?></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">密码：</font></td>
			<td bgcolor="#FFFFFF">******</td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">主机名或IP：</font></td>
			<td bgcolor="#FFFFFF"><?=DB_HOST?></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">数据库：</font></td>
			<td bgcolor="#FFFFFF"><?=DB_NAME?></td>
		</tr>
		<tr>
			<td align="right" bgcolor="#999999" height="20"><font color="#FFFFFF">表前缀：</font></td>
			<td bgcolor="#FFFFFF"><?=DB_TABLE_PRE?></td>
		</tr>
		<!-- 数据库设置_结束 -->
</form>
</table>
