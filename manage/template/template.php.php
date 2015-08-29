<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>条目列表</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8 ">
<link href="/css/manage.css" type=text/css rel=stylesheet>
<meta content="MSHTML 6.00.2900.2180" name=GENERATOR>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<script language="JavaScript" src="/js/all.js"></script>
<script language="JavaScript" src="/js/trcolor.js"></script>
<script language="JavaScript">
function goto(pagenum)
{
	article_list_frm.pagenum.value	= pagenum;
//	alert(pagenum);
	article_list_frm.submit();
}
</script>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="DBList">
    <tr valign=center align=middle>
      <td width="40" bgcolor=#999999 height="20"><font color="#FFFFFF">顺序</font></td>
      <td width="*" bgcolor=#999999><font color="#FFFFFF">标题</font></td>
      <td width="80" bgcolor=#999999><font color="#FFFFFF">html</font></td>
      <td width="80" bgcolor=#999999><font color="#FFFFFF">js</font></td>
      <td width="80" bgcolor=#999999><font color="#FFFFFF">css</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">删除</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">修改</font></td>
    </tr>
  <form name="form1" action="template_update.php" method="post">
		<?php
			if(isset($template_list))
			{
				foreach ($template_list as $template)
				{
		?>
    <tr>
			<label for="del<?=$template['id']?>">	
      <td>&nbsp;<?=$template['order']?></select></td>
      <td>&nbsp;<?=encode($template['title'])?></td>
			<td>&nbsp;<?=$template['html']?></td>
			<td>&nbsp;<?=$template['js']?></td>
			<td>&nbsp;<?=$template['css']?></td>
      <td><input name="del[]" type="checkbox" id="del<?=$template['id']?>" value="<?=$template['id']?>"><label for="del<?=$template['id']?>">删除</label></td>
      <td>&nbsp;<a href="template_edit.php?id=<?=$template['id']?>">修改</a></td>
			</label>
    </tr>
    <?php
				}
		}	
		?>
    <tr>
      <td valign=bottom height=20 colspan="7" align=right><input type="hidden" name="pagenum" value="<?=$pagenum?>">
      	<input type="hidden" name="mode" value="del">
        <input type="button" class="inputbox" onclick='selectalldel()' value="全选删除">
        <input name="s_list_del" type="submit" class="inputbox" onClick="return confirm('你真的要删除所选信息？！');" value="删除">
        <input type="reset" class="inputbox" value="全不选">
			</td>
    </TR>
  	</form>
		<tr height="22" valign="bottom">
    <td colspan="7" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
       <input type="hidden" name="cateid" value="<?=$cateid?>">
<?=SplitPage($recordcount, $pagenum, $pagesize);?>
</form>			</td>
	</tr>
	</table>
</body>
</html>
