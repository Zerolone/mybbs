<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="../../css/manage.css" type="text/css" >
<script language="javascript">
function update_check()
{
	//提交
	password_frm.action 			= "update.php?";
	password_frm.target			=	"_self";
	password_frm.submit();
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" scroll="no">
<form name="password_frm" method="POST">
	<tr>
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标题1：</font></td>
    <td bgcolor="#FFFFFF"><input name="title1" type="text" class="inputbox" id="title1" onMouseOver="select();" value="<?=$title1?>"  size="40" maxlength="150" /></td>
	</tr>
	<tr>
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标题2：</font></td>
    <td bgcolor="#FFFFFF"><input name="title2" type="text" class="inputbox" id="title2" onMouseOver="select();" value="<?=$title2?>" size="40" maxlength="150"  /></td>
	</tr>
	<tr>
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标题3：</font></td>
    <td bgcolor="#FFFFFF"><input name="title3" type="text" class="inputbox" id="title3" onMouseOver="select();" value="<?=$title3?>" size="40" maxlength="150"  /></td>
	<tr>
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">版权信息：</font></td>
    <td bgcolor="#FFFFFF"><input name="copyright" type="text" class="inputbox" id="copyright" onMouseOver="select();" value="<?=$copyright?>" size="40" maxlength="150"  /></td>    
	</tr>
	<tr>
		<td bgcolor="#999999"></td>
		<td bgcolor="#FFFFFF">
    <input type="hidden" name="mode" value="editone" />
			<input type="button" value=" 修 改 (Alt +Y) " name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
			<input type="reset" value=" 重 置 (Alt + N) " name="B2" class="inputbox" accesskey="N" /></td>
	</tr>
</form>
</table>