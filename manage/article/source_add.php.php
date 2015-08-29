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
  var check_title		= document.add_link_frm.title;
  if (check_title.value == "")
  {
		alert("请输入文章采集标题！");
		check_title.focus();
		return false;
	}
	
	add_link_frm.action 			= "source_add_update.php?";
	add_link_frm.target				=	"_self";
	add_link_frm.submit();
}

</script>
</head>
<body>
<table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
		<tr bgcolor="#6A6A6A">
			<td colspan="2" height="26"><b><font color="#FFFFFF">&nbsp;文章采集管理 &gt;&gt; 添加采集规则</font></b></td>
		</tr>
<form name="add_link_frm" method="POST">
<tr>
	<td align="right" width="100" bgcolor="#999999" height="20"><font color="#FFFFFF">标　　题:</font></td>
  <td bgcolor="#FFFFFF"><input name="title" type="text" class="inputbox" id="title" size="72" /></td>
</tr>
<tr>
  <td bgcolor="#999999"></td>
  <td bgcolor="#FFFFFF"><input type="button" value=" 添 加 (Alt +Y) " name="B1" class="inputbox" accesskey="Y" onclick="update_check();" />
  <input type="reset" value=" 重 置 (Alt + N) " name="B2" class="inputbox" accesskey="N" /></td>
</tr>
</form>
</table>
</body>
</html>
