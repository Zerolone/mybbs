<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="../../css/manage.css" type="text/css" >
<script language="javascript" src="../../js/all.js"></script>
<script language="javascript" src="../../js/edit.js"></script>
<script language="javascript">
function update_check()
{
  var check_title		= document.edit_nav_bar_frm.title;
  if (check_title.value == "")
  {
		alert("请输入标题！");
		check_title.focus();
		return false;
	}
	
	edit_nav_bar_frm.action 			= "navservice_update.php?";
	edit_nav_bar_frm.target				=	"_self";
	edit_nav_bar_frm.submit();
}

</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#6A6A6A">
    <td colspan="2" height="26"><b><font color="#FFFFFF">&nbsp;导航菜单管理 &gt;&gt; 可提供服务操作</font></b></td>
  </tr>
  <form name="edit_nav_bar_frm" method="POST">
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标题：</font></td>
      <td bgcolor="#FFFFFF"><input name="title" type="text" class="inputbox" id="title" value="<?=$title?>" size="40" style="width:300"  onMouseOver="select();"  /></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">说明：</font></td>
      <td bgcolor="#FFFFFF"><input name="url" type="text" class="inputbox" id="url" value="<?=$url?>" size="40" style="width:300"  onMouseOver="select();"  /></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺序：</font></td>
      <td bgcolor="#FFFFFF"><select name="order" class="inputbox"><?=getOrderList($order)?></select></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">是否使用：</font></td>
      <td bgcolor="#FFFFFF"><input name="active" type="radio" id="active_0" value="0" checked><label for="active_0">不使用</label><input type="radio" name="active" id="active_1" value="1" <?php if($active) echo 'checked' ?>><label for="active_1">使用</label></td>
    </tr>        <tr>
      <td bgcolor="#999999"></td>
      <td bgcolor="#FFFFFF">
      	<input type="hidden" name="id" value="<?=$id?>" />
      	<input type="hidden" name="pid" value="<?=$pid?>" />
        <input name="mode" type="hidden" id="mode" value="<?=$mode?>" />
        <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" /></td>
    </tr>
  </form>
</table>
