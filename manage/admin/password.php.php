<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="../../css/manage.css" type="text/css" >
<script language="javascript">
function update_check()
{
  var check_password		= document.password_frm.password;
  if (check_password.value == "")
  {
		alert("请输入原密码！");
		check_password.focus();
		return false;
	}

  var check_password1		= document.password_frm.password1;
  if (check_password1.value == "")
  {
		alert("请输入新密码！");
		check_password1.focus();
		return false;
	}

  var check_password2		= document.password_frm.password2;
  if (check_password2.value == "")
  {
		alert("请输入新密码！");
		check_password2.focus();
		return false;
	}

  if (check_password1.value != check_password2.value )
  {
		alert("新密码两次输入不一样，请重新输入！");
		check_password1.focus();
		return false;
	}

	//提交
	password_frm.action 			= "password_update.php?";
	password_frm.target			=	"_self";
	password_frm.submit();
}
</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" scroll="no">
<form name="password_frm" method="POST">
	<tr>
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">原密码：</font></td>
    <td bgcolor="#FFFFFF"><input name="password" type="password" class="inputbox" id="password"  size="40" maxlength="150" onMouseOver="select();" /></td>
	</tr>
	<tr>
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">新密码：</font></td>
    <td bgcolor="#FFFFFF"><input name="password1" type="password" class="inputbox" id="password1" size="40" maxlength="150" onMouseOver="select();"  /></td>
	</tr>
	<tr>
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">新密码：</font></td>
    <td bgcolor="#FFFFFF"><input name="password2" type="password" class="inputbox" id="password2" size="40" maxlength="150" onMouseOver="select();"  /></td>
	</tr>
	<tr>
		<td bgcolor="#999999"></td>
		<td bgcolor="#FFFFFF">
			<input type="button" value=" 修 改 (Alt +Y) " name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
			<input type="reset" value=" 重 置 (Alt + N) " name="B2" class="inputbox" accesskey="N" /></td>
	</tr>
</form>
</table>