<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="../../css/manage.css" type="text/css" >
<script language="javascript" src="../../js/all.js"></script>
<script language="javascript">
function update_check(){
	admin_frm.action 			= "update.php?";
	admin_frm.target				=	"_self";
	
	/*
	var tempStr="";
	tempStr+='后台地址：/manage/'+"\n";
	tempStr+='用 户 名：'+ <?=$user['username']?> + "\n";
	tempStr+='用户密码：'+ document.getElementById('password').value + "\n";
	tempStr+='请注意密码安全。';
	
	window.clipboardData.setData("Text",tempStr);   
	alert("已经复制到剪切板！");	
	*/
	admin_frm.submit();
}

function createPassword(inputbox, len) {
	len = parseInt(len);
	str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	var mod = str.length;
	var out = '';
	for (var i = 0; i < len; i++) {
		out += str.substr(parseInt(Math.random() * 100) % mod, 1);
	}
	
	var inputbox=document.getElementById(inputbox);
	inputbox.value=out;
	
//	return out;
}
</script>
</head>
<body scroll="no">
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">

  <form name="admin_frm" method="POST">
  <tr bgcolor="#6A6A6A">
    <td colspan="10" height="26"><b><font color="#FFFFFF">&nbsp;用户管理 &gt;&gt; 用户操作</font></b></td>
  </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">用 户 名：</font></td>
      <td bgcolor="#FFFFFF">&nbsp;<?=$user['username']?></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">密　　码：</font></td>
      <td bgcolor="#FFFFFF"><input name="password" type="text" class="InputBox" id="password" size="80" style="width:300"  onMouseOver="select();" >
      <input type="button" value="生成新密码" name="B2" class="inputbox" accesskey="Y" onClick="createPassword('password',10);" /></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">用户权限：</font></td>
      <td bgcolor="#FFFFFF"><select name="groupid" id="groupid"><?=getUserGroup($MyDatabase, $user['groupid'])?></select>
      </td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">邮　　箱：</font></td>
      <td bgcolor="#FFFFFF"><input name="email" type="text" class="InputBox" id="email" style="width:300px;"  onMouseOver="select();" value="<?=$user['email']?>" size="80" ></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">威　　望：</font></td>
      <td bgcolor="#FFFFFF"><input name="rvrc" type="text" class="InputBox" id="rvrc" style="width:300px;"  onMouseOver="select();" value="<?=$user['rvrc']?>" size="80" ></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">金　　钱：</font></td>
      <td bgcolor="#FFFFFF"><input name="money" type="text" class="InputBox" id="money" style="width:300px;"  onMouseOver="select();" value="<?=$user['money']?>" size="80" ></td>
    </tr>
    
    <tr>
      <td bgcolor="#999999"></td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="uid"	value="<?=$uid?>" />
        <input type="hidden" name="mode"	value="<?=$mode?>" />
        <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" /></td>
    </tr>
  </form>
</table>