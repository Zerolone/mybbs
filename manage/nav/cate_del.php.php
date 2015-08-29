<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="../css/manage.css" type="text/css" >
<script language="javascript" src="../js/all.js"></script>
<script language="javascript" src="../js/edit.js"></script>
<script language="javascript">
function update_check()
{
	add_link_frm.action 			= "cate_del_update.php?";
	add_link_frm.target				=	"_self";
	add_link_frm.submit();
}

</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
		<tr bgcolor="#6A6A6A">
			<td colspan="2" height="26"><b><font color="#FFFFFF">&nbsp;文章分类管理 &gt;&gt; 文章分类删除</font></b></td>
		</tr>
<form name="add_link_frm" method="POST">
<tr>
			<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">所属分类：</font></td>
	    <td bgcolor="#FFFFFF"><?=$catetitle?></td>
</tr>
<tr>
			<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">顺序：</font></td>
	    <td bgcolor="#FFFFFF"><?=$level?></td>
</tr>
<tr>
			<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标题：</font></td>
	    <td bgcolor="#FFFFFF"><?=$title?></td>
</tr>

<tr>
  <td bgcolor="#999999"></td>
  <td bgcolor="#FFFFFF">
	<input type="hidden" name="id" value="<?=$id?>" />
	<input type="button" value=" 删 除 (Alt + D) " name="B1" class="inputbox" accesskey="D" onclick="update_check();" />
	<font color="#FF0000">特别提示：将删除该类下面的所有子类以及文章</font></td>
</tr>
</form>
</table>
