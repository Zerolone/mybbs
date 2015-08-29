<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>条目列表</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8">
<link href="/css/manage.css" type=text/css rel=stylesheet>
<meta content="MSHTML 6.00.2900.2180" name=GENERATOR>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<script language="JavaScript" src="/js/all.js"></script>
<script language="JavaScript" src="/js/trcolor.js"></script>
<script language="JavaScript">
function goto(pagenum){
	article_list_frm.pagenum.value	= pagenum;
//	alert(pagenum);
	article_list_frm.submit();
}
</script>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="DBList">
    <tr height="26">
      <td height="26" colspan="8" bgcolor="#666666"><b><font color="#FFFFFF">&nbsp;老爸你真棒 &gt;&gt; 列表</font></b></td>
    </tr>
    <tr valign=center align=middle>
      <td width="24" bgcolor=#999999 height=20><a href="?code=id"><font color="#FFFFFF">编号</font></a></td>
      <td width="100" bgcolor=#999999><font color="#FFFFFF">姓名</font></td>
      <td width="100" bgcolor=#999999><font color="#FFFFFF">年龄</font></td>
      <td width="100" bgcolor=#999999><font color="#FFFFFF">父亲</font></td>
      <td width="*" bgcolor=#999999><font color="#FFFFFF">母亲</font></td>
      <td bgcolor=#999999><font color="#FFFFFF">详细资料</font></td>
    </tr>
		<?php
			if(isset($vote_list))
			{
				foreach ($vote_list as $vote)
				{
		?>
    <label for="del<?=$vote['id']?>">
    <tr>
      <td height=20 >&nbsp;<?=$vote['id']?></td>
      <td><?=$vote['name']?></td>
      <td><?=$vote['age']?></td>
      <td><?=$vote['father']?></td>
      <td><?=$vote['mother']?></td>
      <td><a href="../../father/view.php?id=<?=$vote['id']?>" target="_blank">查看资料</a></td>
    </tr>
    </label>
    <?php
				}
		}	
		?>
		<tr height="22" valign="bottom">
    <td colspan="8" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
    <input type="hidden" name="code" value="<?=$code?>" /><?=SplitPage($recordcount, $pagenum);?>
</form>			</td>
	</tr>
	</table>
</body>
</html>
