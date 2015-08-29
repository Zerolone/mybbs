<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="<?=SITE_FOLDER?>/css/manage.css" type="text/css" >
<script language="javascript">
function update_check(){
  var check_title		= document.admin_frm.title;
  if (check_title.value == ""){
		alert("请输入用户组名！");
		check_title.focus();
		return false;
	}
	
	admin_frm.action 			= "group_update.php?";
	admin_frm.target				=	"_self";
	admin_frm.submit();
}
</script>
</head>
<body>
<div id="Layer1" style="position:absolute; left:200px; top:17px; width:1px; height:1px; z-index:1; visibility:hidden">
	<table border="1" width="100%" id="table1" cellspacing="0" cellpadding="0" bordercolor="#000000" onClick="HiddenLayer();">
		<tr>
			<td><img name="ViewImg"></td>
		</tr>
	</table>
</div>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <form name="admin_frm" method="POST">
<tr bgcolor="#6A6A6A">
    <td colspan="10" height="26"><b><font color="#FFFFFF">&nbsp;用户组管理 &gt;&gt; 用户组操作</font></b></td>
  </tr>  
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">用户组名：</font></td>
      <td bgcolor="#FFFFFF"><input name="title" type="text" class="InputBox" id="title" style="width:300" onMouseOver="select();" value="<?=$title?>" size="80"></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
      <td bgcolor="#FFFFFF"><select name="order" class="inputbox"><?=getOrderList($order)?></select>
      </td>
    </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">在线图标：</font></td>
    <td bgcolor="#FFFFFF"><input name="logo" type="text" class="InputBox" id="logo" style="width:300" value="<?=$online?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插入图片 (ALT + I) " onClick="insertpic1('online')" class="inputbox" accesskey="I">
      <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(online.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span></td>
  </tr>	 
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">离线图标：</font></td>
    <td bgcolor="#FFFFFF"><input name="logo" type="text" class="InputBox" id="logo" style="width:300" value="<?=$offline?>" size="80">
      <input type="button" name="btnInsertPic" value=" 插入图片 (ALT + I) " onClick="insertpic1('offline')" class="inputbox" accesskey="I">
      <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(offline.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span></td>
  </tr>	     
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">用户权限：</font></td>
      <td bgcolor="#FFFFFF">
        <input type="checkbox" name="permission[]" value="1" id="permission_1" <? if (substr($permission, -1,1)==1) echo "checked" ?>><label for="permission_1">模块1---广告管理</label>
        <br />
        <input type="checkbox" name="permission[]" value="2" id="permission_2" <? if (substr($permission, -2,1)==1) echo "checked" ?>><label for="permission_2">模块2---用户管理</label>
        <br />
        <input type="checkbox" name="permission[]" value="4" id="permission_3" <? if (substr($permission, -3,1)==1) echo "checked" ?>><label for="permission_3">模块3---文章管理</label>
        <br />
        <input type="checkbox" name="permission[]" value="8" id="permission_4" <? if (substr($permission, -4,1)==1) echo "checked" ?>><label for="permission_4">模块4---轮显管理</label>
        <br />
        <input type="checkbox" name="permission[]" value="16" id="permission_5" <? if (substr($permission, -5,1)==1) echo "checked" ?>><label for="permission_5">模块5---QA</label>
        <br />
        <input type="checkbox" name="permission[]" value="32" id="permission_6" <? if (substr($permission, -6,1)==1) echo "checked" ?>><label for="permission_6">模块6---作品留言</label>
        <br />
        <input type="checkbox" name="permission[]" value="64" id="permission_7" <? if (substr($permission, -7,1)==1) echo "checked" ?>><label for="permission_7">模块7---调查</label>
        <br />
        <input type="checkbox" name="permission[]" value="128" id="permission_8" <? if (substr($permission, -8,1)==1) echo "checked" ?>><label for="permission_8">模块8---报名</label>
        <br />
        <input type="checkbox" name="permission[]" value="256" id="permission_9" <? if (substr($permission, -9,1)==1) echo "checked" ?>><label for="permission_9">模块9---课程设置</label>
        <br />
        <input type="checkbox" name="permission[]" value="512" id="permission_10" <? if (substr($permission, -10,1)==1) echo "checked" ?>><label for="permission_10">模块10--讲师留言管理</label>
        <br />
        <input type="checkbox" name="permission[]" value="1024" id="permission_11" <? if (substr($permission, -11,1)==1) echo "checked" ?>><label for="permission_11">模块11--站点信息</label>
        <br />
        <input type="checkbox" name="permission[]" value="2048" id="permission_12" <? if (substr($permission, -12,1)==1) echo "checked" ?>><label for="permission_12">模块12--修改密码</label>
        <br />
        <input type="checkbox" name="permission[]" value="4096" id="permission_13" <? if (substr($permission, -13,1)==1) echo "checked" ?>><label for="permission_13">模块13--操作日志</label>
        <br />
        <input type="checkbox" name="permission[]" value="8192" id="permission_14" <? if (substr($permission, -14,1)==1) echo "checked" ?>><label for="permission_14">模块14--在线咨询</label>
        <br />
        <input type="checkbox" name="permission[]" value="16384" id="permission_15" <? if (substr($permission, -15,1)==1) echo "checked" ?>><label for="permission_15">模块15--友情链接</label>
        </td>
    </tr>
    <tr>
      <td bgcolor="#999999"></td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="id"	value="<?=$id?>" />
        <input type="hidden" name="mode"	value="<?=$mode?>" />
        <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" /></td>
    </tr>
  </form>
</table>
