<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="/css/manage.css" type="text/css" >
<script language="javascript" src="/js/all.js"></script>
<script language="javascript" src="/js/edit.js"></script>
<script language="javascript">
function update_check()
{
  var check_title		= document.add_article_frm.title;
  if (check_title.value == "")
  {
		alert("请输入模板名！");
		check_title.focus();
		return false;
	}
	
	add_article_frm.action 			= "template_update.php?";
	add_article_frm.target				=	"_self";
	add_article_frm.submit();
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
<form name="add_article_frm" method="POST">  
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">模 板 名：</font></td>
    <td colspan="3" bgcolor="#FFFFFF"><input name="title" type="text" class="InputBox" id="title" style="width:300" onMouseOver="select();" value="<?=$title?>" size="80"></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
    <td colspan="3" bgcolor="#FFFFFF">
			<select name="order" id="order"><?=getOrderList($order)?></select>    </td>
  </tr>
  <tr>
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">HTML文件：</font></td>
    <td bgcolor="#FFFFFF">
          <input name="html" type="text" class="InputBox" id="html" style="width:300" onMouseOver="select();" value="<?=$html?>" size="30"></td>
<td width="50" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="insertemplate('html')" bgcolor="#C0C0C0"> 插 入 </td>
        <td bgcolor="#FFFFFF" width="300">&nbsp;</td>
        
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">J s 文件：</font></td>
    <td bgcolor="#FFFFFF"><input name="js" type="text" class="InputBox" id="js" style="width:300" onMouseOver="select();" value="<?=$js?>" size="30"></td>
<td width="50" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="insertemplate('js')" bgcolor="#C0C0C0"> 插 入 </td>	
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">Css 文件：</font></td>
    <td bgcolor="#FFFFFF"><input name="css" type="text" class="InputBox" id="css" style="width:300" onMouseOver="select();" value="<?=$css?>" size="30"></td>
<td width="50" class="Menu" align="center" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="insertemplate('css')" bgcolor="#C0C0C0"> 插 入 </td>	
    <td bgcolor="#FFFFFF">&nbsp;</td>
  </tr>  
  <tr>
    <td bgcolor="#999999"></td>
    <td colspan="3" bgcolor="#FFFFFF">
				<input type="hidden" name="id"	value="<?=$id?>" />
				<input type="hidden" name="mode"	value="<?=$mode	?>" />
				<input type="hidden" name="content" />
        <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
        <input type="button" name="Submit2" value=" 返 回 (ALT + B) " onClick="history.back(-1)" class="inputbox" accesskey="B">		</td>
  </tr>
 </form>
</table>
