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
  if (check_title.value == "") {
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
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标　　题：</font></td>
      <td bgcolor="#FFFFFF"><input name="title" type="text" class="InputBox" id="title" style="width:300" onMouseOver="select();" value="<?=$title?>" size="80"></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">静态页面：</font></td>
      <td bgcolor="#FFFFFF"><input name="html" type="text" class="InputBox" id="html" style="width:300" onMouseOver="select();" value="<?=$html?>" size="80"></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
      <td bgcolor="#FFFFFF"><select name="order" class="inputbox">
          <?=getOrderList($order)?>
        </select></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">所属模板：</font></td>
      <td bgcolor="#FFFFFF"><select name="templateid" id="templateid">
          <?php
					if(isset($template_list))
					{
						foreach ($template_list as $template)
						{
					?>
          <option value="<?=$template['id']?>" <?=$template['selected']?>>
          <?=$template['title']?>
          </option>
          <?
						}
					}
					?>
        </select></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">对应图片：</font></td>
      <td bgcolor="#FFFFFF"><input name="pic" type="text" class="InputBox" id="pic" style="width:300" onMouseOver="select();" value="<?=$pic?>" size="80">
        <input name="insertpic" type="button" class="inputbox" id="insertpic" onClick="insertpic1('pic')" value=" 插 入 ">
        <span width="30" class="Menu" align="center" onMouseOver="hl_menu(this,0); View(pic.value);" onMouseOut="hl_menu(this,1); HiddenLayer();" onClick=" HiddenLayer();" bgcolor="#C0C0C0"> 察 看 </span></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">说　　明：</font></td>
      <td bgcolor="#FFFFFF"><textarea name="memo" id="memo" cols="60" rows="5" class="InputBox"  style="width:300"><?=$memo?>
</textarea></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">链 接 一：</font></td>
      <td bgcolor="#FFFFFF"><input name="url1" type="text" class="InputBox" id="url1" style="width:300" onMouseOver="select();" value="<?=$url1?>" size="80"></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">链 接 二：</font></td>
      <td bgcolor="#FFFFFF"><input name="url2" type="text" class="InputBox" id="url2" style="width:300" onMouseOver="select();" value="<?=$url2?>" size="80"></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">链 接 三：</font></td>
      <td bgcolor="#FFFFFF"><input name="url3" type="text" class="InputBox" id="url3" style="width:300" onMouseOver="select();" value="<?=$url3?>" size="80"></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">链 接 四：</font></td>
      <td bgcolor="#FFFFFF"><input name="url4" type="text" class="InputBox" id="url4" style="width:300" onMouseOver="select();" value="<?=$url4?>" size="80"></td>
    </tr>
        <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">链 接 五：</font></td>
      <td bgcolor="#FFFFFF"><input name="url5" type="text" class="InputBox" id="url5" style="width:300" onMouseOver="select();" value="<?=$url5?>" size="80"></td>
    </tr>        
    <tr>
      <td bgcolor="#999999"></td>
      <td bgcolor="#FFFFFF"><input type="hidden" name="id"	value="<?=$id?>" />
        <input type="hidden" name="mode"	value="<?=$mode?>" />
        <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
        <input type="button" name="Submit2" value=" 返 回 (ALT + B) " onClick="JavaScript:history.back(-1)" class="inputbox" accesskey="B"></td>
    </tr>
  </form>
</table>
