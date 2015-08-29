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
  var check_title		= document.add_link_frm.title;
  if (check_title.value == "")
  {
		alert("请输入分类名！");
		check_title.focus();
		return false;
	}
	
	add_link_frm.action 			= "cate_update.php?";
	add_link_frm.target				=	"_self";
	add_link_frm.submit();
}

</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <form name="add_link_frm" method="POST">
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">所属分类：</font></td>
      <td bgcolor="#FFFFFF"><?=$parenttitle?></td>
    </tr>		
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
      <td bgcolor="#FFFFFF"><select name="level" id="select">
      <?php
				if(substr($level,-2)>0){
					?>
			<option value="<?=$level?>"><?=$level?></option>
          <?php
				}
					if(isset($level_list_new))
					{
						foreach ($level_list_new as $level)
						{
					?>
          <option value="<?=$level?>"><?=$level?></option>
          <?
						}
					}
					?>
        </select></td>
    </tr>
    <tr>
      <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">分 类 名：</font></td>
      <td bgcolor="#FFFFFF"><input name="title" type="text" class="inputbox" id="title" onMouseOver="select();" value="<?=$title?>" size="40" maxlength="150" /></td>
    </tr>
    <tr>
      <td bgcolor="#999999"></td>
      <td bgcolor="#FFFFFF">
				<input type="hidden" name="parentid"	value="<?=$parentid?>" />
				<input type="hidden" name="id"	value="<?=$id?>" />
        <input type="hidden" name="mode"	value="<?=$mode	?>" />
        <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
        <input type="reset" value=" 重 置 (Alt + N) " name="B2" class="inputbox" accesskey="N" /></td>
    </tr>
  </form>
</table>
