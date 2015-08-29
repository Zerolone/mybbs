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
		alert("请输入标题！");
		check_title.focus();
		return false;
	}
	
	add_article_frm.action 			= "author_update.php?";
	add_article_frm.target				=	"_self";
	add_article_frm.submit();
}

</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
  <tr bgcolor="#6A6A6A">
    <td colspan="2" height="26"><b><font color="#FFFFFF">&nbsp;作者来源管理 &gt;&gt; 作者来源操作</font></b></td>
  </tr>
<form name="add_article_frm" method="POST">  
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标　　题：</font></td>
    <td bgcolor="#FFFFFF"><input name="name" type="text" class="InputBox" id="name" style="width=300" onMouseOver="select();" value="<?=$name?>" size="80"></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺　　序：</font></td>
    <td bgcolor="#FFFFFF"><select name="order" id="order"><?=getOrderList($order)?></select></td>
  </tr>
  <tr>
    <td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">类　　型：</font></td>
    <td bgcolor="#FFFFFF">
			<select name="kind" id="kind">
			  <option value="author" 	<?php if($kind=='author') 	echo 'selected'?>>作者</option>
			  <option value="from"		<?php if($kind=='from') 		echo 'selected'?>>来源</option>
    	</select>    
		</td>
  </tr>	
  <tr>
    <td bgcolor="#999999"></td>
    <td bgcolor="#FFFFFF">
				<input type="hidden" name="id"	value="<?=$id?>" />
				<input type="hidden" name="mode"	value="<?=$mode	?>" />
        <input type="button" value="<?=$mode_title?>" name="B1" class="inputbox" accesskey="Y" onClick="update_check();" />
     </td>
  </tr>
 </form>
</table>
