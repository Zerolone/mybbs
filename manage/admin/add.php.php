<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="../../css/manage.css" type="text/css" >
<script language="javascript" src="../../js/all.js"></script>
<script language="javascript">
function update_check()
{
  var check_user		= document.admin_frm.user;
  if (check_user.value == "")
  {
		alert("请输入用户名！");
		check_user.focus();
		return false;
	}
	
	admin_frm.action 			= "update.php?";
	admin_frm.target				=	"_self";
	
	var tempStr="";
	tempStr+='后台地址：/manage/'+"\n";
	tempStr+='用 户 名：'+ document.getElementById('user').value + "\n";
	tempStr+='用户密码：'+ document.getElementById('pass').value + "\n";
	tempStr+='请注意密码安全。';
	
	window.clipboardData.setData("Text",tempStr);   
	alert("已经复制到剪切板！");	
	
	admin_frm.submit();
}

function createPassword(len) {
	len = parseInt(len);
	str = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
	var mod = str.length;
	var out = '';
	for (var i = 0; i < len; i++) {
		out += str.substr(parseInt(Math.random() * 100) % mod, 1);
	}
	return out;
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
      <td bgcolor="#FFFFFF"><input name="user" type="text" class="InputBox" id="user" style="width:300" onMouseOver="select();" value="<?=$user?>" size="80">
      用户名不能修改</td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">密　　码：</font></td>
      <td bgcolor="#FFFFFF"><input name="pass" type="text" class="InputBox" id="pass" size="80" style="width:300"  onMouseOver="select();" >
        <font color="#FF0000">
        <?=$mode_note?>
        </font></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">用户权限：</font></td>
      <td bgcolor="#FFFFFF"><select name="groupid" id="groupid">
		<?php
			if(isset($group_list))
			{
				foreach ($group_list as $group)
				{
		?>
          <option value="<?=$group['id']?>" <?=$group['selected']?>><?=$group['title']?></option>
		<?php
				}
			}		
		?>			
        </select>
      </td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
      <td bgcolor="#FFFFFF"><input name="order" type="text" class="InputBox" id="order" style="width:300"  onMouseOver="select();" value="<?=$order?>" size="80" ></td>
    </tr>
    <tr>
      <td bgcolor="#999999"></td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="id"	value="<?=$id?>" />
        <input type="hidden" name="mode"	value="<?=$mode?>" />
        <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" /></td>
    </tr>
  </form>
</table>
<script language="javascript">
//生成密码
document.getElementById('pass').value=createPassword(10);
</script>