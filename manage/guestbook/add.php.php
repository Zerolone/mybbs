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
    <td colspan="2" height="26"><b><font color="#FFFFFF">&nbsp;留言簿管理 &gt;&gt; 留言簿操作</font></b></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">昵　　称：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="name" type="text" class="InputBox" id="name" style="width:300" onMouseOver="select();" value="<?=$name?>" size="80"></td>
  </tr>  
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">QQ：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="homepage" type="text" class="InputBox" id="homepage" style="width:300" onMouseOver="select();" value="<?=$homepage?>" size="80"></td>
  </tr>    
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">邮　　箱：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="mail" type="text" class="InputBox" id="mail" style="width:300" onMouseOver="select();" value="<?=$mail?>" size="80"></td>
  </tr>    <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">使　　用：</font></td>
    <td bgcolor="#FFFFFF"><input name="active" id="active1" type="radio" value="1" <?php if($active==1) echo 'checked'; ?>><label for="active1">使用</label><input name="active" id="active2" type="radio" value="0" <?php if($active==0) echo 'checked'; ?>><label for="active2">不使用</label></td>
  </tr>	
	<tr>
	  <td width="100" height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">内容：</font></td>
	  <td bgcolor="#FFFFFF"><textarea name="content" cols="80" rows="6" class="InputBox" id="content" style="width:300"><?=$content?></textarea></td>
	  </tr>	  
	<tr>
	  <td width="100" height="20" align="right" bgcolor="#999999"><font color="#FFFFFF">回复内容：</font></td>
	  <td bgcolor="#FFFFFF"><textarea name="recontent" cols="80" rows="6" class="InputBox" id="recontent" style="width:300"><?=$recontent?></textarea></td>
	  </tr>
    <tr>
    <td bgcolor="#999999"></td>
    <td bgcolor="#FFFFFF">
				<input type="hidden" name="id"				value="<?=$id?>" />
				<input type="hidden" name="cateid"		value="<?=$cateid?>" />
				<input type="hidden" name="mode"			value="<?=$mode?>" />
				<input type="hidden" name="pagenum"		value="<?=$pagenum?>" />
				<input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
				<input type="button" name="Submit2" value=" 返 回 (ALT + B) " onClick="history.back(-1)" class="inputbox" accesskey="B">				</td>
  </tr>
 </form>
</table>
