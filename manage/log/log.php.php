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
  <form name="form1" action="log_action.php" method="post">
    <tr>
      <td valign=bottom bgcolor=#FFFFFF height=20 colspan="6" align=right><input type="hidden" name="pagenum" value="<?=$pagenum?>">
        <input name="s_list_del" type="submit" class="inputbox" onClick="return confirm('你真的要删除所选信息？！');" value="删除">
      <input type="button" class="inputbox" onclick='selectalldel()' value="全选删除"></td>
    </TR>
    <tr valign=center align=middle>
      <td width="40" bgcolor=#999999 height=20><font color="#FFFFFF">IP</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">用户</font></td>
      <td width="*"  bgcolor=#999999><font color="#FFFFFF">内容</font></td>
      <td width="80" bgcolor=#999999><font color="#FFFFFF"> 地址</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">日期</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">删除</font></td>
    </tr>
    <?php
			if(isset($log_list))
			{
				foreach ($log_list as $log)
				{
		?>
    <tr>
      <td><?=$log['ip']?></td>
      <td><?=$log['user']?></td>
      <td><?=$log['content']?></td>
      <td><?=$log['url']?></td>
      <td><?=$log['date']?></td>
      <td><input name="del[]" type="checkbox" id="del<?=$log['id']?>" value="<?=$log['id']?>" checked><label for="del<?=$log['id']?>">删除</label></td>
    </tr>
    <?php
				}
		}	
		?>
    <tr>
      <td valign=bottom height=20 colspan="6" align=right><input type="hidden" name="pagenum" value="<?=$pagenum?>">
        <input name="s_list_del" type="submit" class="inputbox" onClick="return confirm('你真的要删除所选信息？！');" value="删除">
      <input type="button" class="inputbox" onclick='selectalldel()' value="全选删除"></td>
    </TR>
  </form>
  <tr height="22" valign="bottom">
    <td colspan="6" width="100%" align="right"><form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
<?=SplitPage($recordcount, $pagenum, $pagesize);?>
      </form></td>
  </tr>
</table>
</body>
</html>
