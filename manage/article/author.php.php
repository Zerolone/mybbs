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
    <tr height="26">
      <td height="26" colspan="7" bgcolor="#666666"><b><font color="#FFFFFF">&nbsp;作者来源管理 &gt;&gt; 作者来源列表</font></b></td>
    </tr>
    <tr valign=center align=middle>
      <td width="60" bgcolor=#999999 height=20><p><font color="#FFFFFF">顺序</font></p></td>
      <td width="*" bgcolor=#999999><font color="#FFFFFF">标题</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">删除</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">修改</font></td>
    </tr>
  <form name="form1" action="author_update.php" method="post">
		<?php
			if(isset($author_list))
			{
				foreach ($author_list as $author)
				{
		?>
    <tr>
      <td>&nbsp;<?=$author['order']?></td>
      <td>&nbsp;<?=$author['name']?></a></td>
			<td><input name="del[]" type="checkbox" id="del<?=$author['id']?>" value="<?=$author['id']?>"><label for="del<?=$article['id']?>">删除</label></td>
      <td>&nbsp;<a href="author_edit.php?id=<?=$author['id']?>&kind=<?=$kind?>">修改</a></td>
    </tr>
    <?php
				}
		}	
		?>
    <tr>
      <td valign=bottom height=20 colspan="7" align=right>
				<a href="author.php?kind=author">作者</a>
				<a href="author.php?kind=from">来源</a>
	      <input type="hidden" name="kind" value="<?=$kind?>">
	      <input type="hidden" name="pagenum" value="<?=$pagenum?>">
        <input type="button" class="inputbox" onclick='selectalldel()' value="全选删除">
        <input name="s_list_del" type="submit" class="inputbox" onClick="return confirm('你真的要删除所选信息？！');" value="删除">
        <input type="reset" class="inputbox" value="全不选">			</td>
    </TR>
  	</form>
		<tr height="22" valign="bottom">
    <td colspan="7" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
       <input type="hidden" name="flag" value="<?=$flag?>">
       <input type="hidden" name="cateid" value="<?=$cateid?>">
			 <?=SplitPage($recordcount, $pagenum);?>
</form>			</td>
	</tr>
	</table>
</body>
</html>
