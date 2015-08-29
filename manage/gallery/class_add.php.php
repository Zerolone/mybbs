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
  var check_title		= document.admin_frm.title;
  if (check_title.value == "")
  {
		alert("请输入标题！");
		check_title.focus();
		return false;
	}
	
	admin_frm.action 			= "class_update.php?";
	admin_frm.target				=	"_self";
	admin_frm.submit();
}

</script>
</head>
<body>
<div id="Layer1" style="position:absolute; left:200px; top:17px; width:1px; height:1px; z-index:1; visibility:hidden">
	<table border="1" width="100%" id="table1" cellspacing="0" cellpadding="0" bordercolor="#000000" onClick="HiddenLayer();">
		<tr>
			<td><img src="../ad/images/loadingpic.gif" name="ViewImg"></td>
		</tr>
	</table>
</div>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <form name="admin_frm" method="POST">
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标　　题：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="title" type="text" class="InputBox" id="title" style="width:300" onMouseOver="select();" value="<?=$title?>" size="80"></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">目　　录：</font></td>
      <td bgcolor="#FFFFFF">
      <input name="dir" type="text" class="InputBox" id="dir" style="width:300" onMouseOver="select();" value="<?=$dir?>" size="80">
      默认在gallery目录中</td>
  </tr>

    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">所属模板：</font></td>
      <td bgcolor="#FFFFFF"><select name="templateid" id="select">
          <?php
					if(isset($template_list))
					{
						foreach ($template_list as $template)
						{
					?>
          <option value="<?=$template['id']?>" <?=$template['selected']?>><?=$template['title']?></option>
          <?
						}
					}
					?>
        </select></td>
    </tr>		  
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">所属专题：</font></td>
      <td bgcolor="#FFFFFF"><select name="specialid" id="specialid">
        <?php
					if(isset($special_list)){
						foreach ($special_list as $special){
					?>
        <option value="<?=$special['id']?>" <?=$special['selected']?>>
          <?=$special['title']?>
          </option>
        <?
						}
					}
					?>
      </select></td>
    </tr>		  

  <tr>
		<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
    <td bgcolor="#FFFFFF"><select name="order" class="inputbox"><?=getOrderList($order)?></select></td>
  </tr>	
  <tr>
    <td bgcolor="#999999"></td>
    <td bgcolor="#FFFFFF">
				<input type="hidden" name="id"	value="<?=$id?>" />
				<input type="hidden" name="mode"	value="<?=$mode?>" />
				<input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" /></td>
  </tr>
 </form>
</table>
