<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="/css/manage.css" type="text/css" >
<script language="javascript" src="/js/all.js"></script>
<script language="javascript" src="/js/edit.js"></script>
<script language="javascript">
function update_check(){
  var check_title		= document.admin_frm.title;
  if (check_title.value == ""){
		alert("请输入标题！");
		check_title.focus();
		return false;
	}
	
	admin_frm.action 			= "update.php?";
	admin_frm.target				=	"_self";
	admin_frm.submit();
}

</script>
</head>
<body>
<div id="Layer1" style="position:absolute; left:200px; top:17px; width:1px; height:1px; z-index:1; visibility:hidden">
	<table border="1" width="100%" id="table1" cellspacing="0" cellpadding="0" bordercolor="#000000" onClick="HiddenLayer();">
		<tr>
			<td><img src="images/loadingpic.gif" name="ViewImg"></td>
		</tr>
	</table>
</div>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
      <form name="admin_frm" method="POST">
<tr bgcolor="#6A6A6A">
    <td colspan="2" height="26"><b><font color="#FFFFFF">&nbsp;友情链接管理 &gt;&gt; 友情链接操作</font></b></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标　　题：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="title" type="text" class="InputBox" id="title" style="width:300" onMouseOver="select();" value="<?=$title?>" size="80"></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">U　 R　L：</font></td>
    <td bgcolor="#FFFFFF">
      <input name="url" type="text" class="InputBox" id="url" style="width:300" onMouseOver="select();" value="<?=$url?>" size="80"></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
    <td bgcolor="#FFFFFF"><select name="order" class="inputbox"><?=getOrderList($order)?></select></td>
  </tr>	
	<tr>
	  <td width="100" height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">图　　片：</font></td>
	  <td bgcolor="#FFFFFF"><input name="pic" type="text" class="InputBox" id="pic" style="width:300" value="<?=$pic?>" size="80">
	    <input type="button" name="btnInsertPic" value=" 插入图片 (ALT + I) " onClick="insertpic1('pic')" class="inputbox" accesskey="I">
	    <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(pic.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span></td>
	  </tr>	  
  <tr>
    <td bgcolor="#999999"></td>
    <td bgcolor="#FFFFFF">
				<input type="hidden" name="id"				value="<?=$id?>" />
				<input type="hidden" name="mode"			value="<?=$mode?>" />
				<input type="hidden" name="pagenum"		value="<?=$pagenum?>" />
				<input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
				<input type="button" name="Submit2" value=" 返 回 (ALT + B) " onClick="history.back(-1)" class="inputbox" accesskey="B">				</td>
  </tr>
 </form>
</table>
