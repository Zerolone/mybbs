<html>

<head>
<meta http-equiv="Content-Language" content="zh-cn">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Monolith后台管理系统 &gt;&gt; 管理员登陆</title>
</head>

<body>
<body bgcolor="#2E5984">
<form name="loginForm" method="post" action="logincheck.php">
<input type="hidden" name="login" value="true">
<input type="hidden" name="login_submit" value="true">
	<div align="center">
		<table border="0" width="100%" id="table1" height="100%" cellspacing="0" cellpadding="0">
			<tr>
				<td>
				<div align="center">
					<table border="0" width="418" height="256" id="table2" background="images/admin_login.gif" cellspacing="0" cellpadding="0">
						<tr>
							<td width="418" colspan="3" height="70">
							<p align="center">
							<font face="Impact" size="6" color="#FF6633">
							Monolith Cms (Php) Version 1.0 </font></p></td>
						</tr>
						<tr>
							<td width="418" colspan="3">
							<p>&nbsp; 登陆注意事项：</p>
							<p>&nbsp;1、用户名密码均需要注意大小写
							<p>&nbsp;2、输入认证码以及总和							</td>
						</tr>
						<tr>
							<td height="75" width="125" rowspan="5">
							<p align="center">
							<font face="黑体" color="#FFFFFF" size="4">管理员登陆</font></p>							</td>
							<td height="11" width="205">							</td>
							<td height="75" width="88" rowspan="5">
							<p align="center">
							<input border="0" src="images/admin_login_button.gif" name="I1" width="54" height="40" type="image" class="SubmitButton"></p>							</td>
						</tr>
						<tr>
						  <td height="18" width="205">
							<font face="黑体" color="#FFFFFF" size="3">用户名：</font>
							<input name="user" type="text" id="user" style="border:1px solid #000000; width=78;height=16" tabindex="1" value="<?=ADMINUSER?>">							</td>
							</tr>
						<tr>
							<td width="205" style="height: 8px">
							<font face="黑体" color="#FFFFFF"  size="3">密&nbsp; 码：</font>
							<input name="pass" type="password" id="pass" style="border:1px solid #000000; width=78;height=16" tabindex="2" value="<?=ADMINPASS?>"></td>
						</tr>
						<tr>
							<td height="8" width="205">						
						  <img src='../include/check.php'>
						  &nbsp;<input name="usercheck" type="text" id="usercheck" style="border:1px solid #000000; width:50px;height:16px" tabindex="3" maxlength="6"> <input name="int_usercheck" type="text" id="int_usercheck" style="border:1px solid #000000; width:20px;height:16px" tabindex="3" maxlength="2"></td>
						  </tr>
					</table>
				</div>
				</td>
			</tr>
		</table>
	</div>

</form>

<script language="JavaScript" type="text/javascript">
<!--
// 跳出框架
	if (self.parent.frames.length != 0) self.parent.location=document.location;

	document.loginForm.user.focus();
//-->
</script>

</body></html>