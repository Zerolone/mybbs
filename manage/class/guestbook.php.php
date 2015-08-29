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
function goto(pagenum){
	article_list_frm.pagenum.value	= pagenum;
//	alert(pagenum);
	article_list_frm.submit();
}
</script>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="DBList">
<tr bgcolor="#6A6A6A">
    <td colspan="13" height="26"><b><font color="#FFFFFF">&nbsp;留言簿管理 &gt;&gt; 留言簿列表</font></b></td>
  </tr>
    <tr valign=center align=middle>
      <td width="*" bgcolor=#999999><font color="#FFFFFF">昵称</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">使用</font></td>
      <td width="50" bgcolor=#999999><font color="#FFFFFF">对应内容</font></td>
      <td width="50" bgcolor=#999999><font color="#FFFFFF">发布时间</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">修改</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">删除</font></td>
    </tr>
  <form name="form1" action="guestbook_update.php" method="post">
		<?php
			if(isset($guestbook_list)){
				foreach ($guestbook_list as $guestbook){
		?>
    <label for="del<?=$guestbook['id']?>">
    <input type="hidden" name="id[]" value="<?=$guestbook['id']?>">
    <tr>
      <td>&nbsp;<?=$guestbook['name']?></td>
      <td>&nbsp;<?=$guestbook['active']?></td>
      <td>&nbsp;<a target="_blank" href="../../course.php?id=<?=$guestbook['worksid']?>">对应内容</a></td>
      <td>&nbsp;<?=$guestbook['posttime']?></td>
      <td>&nbsp;<a href="guestbook_edit.php?id=<?=$guestbook['id']?>&pagenum=<?=$pagenum?>">修改</a></td>
			<td><input name="del[]" type="checkbox" id="del<?=$guestbook['id']?>" value="<?=$guestbook['id']?>"><label for="del<?=$guestbook['id']?>">删除</label></td>
    </tr>
    </label>
    <?php
				}
		}	
		?>
    <tr>
      <td valign=bottom height=20 colspan="13" align=right>
	      <input type="hidden" name="pagenum" value="<?=$pagenum?>">
	      <input type="button" class="inputbox" onclick='selectalldel()' value="全选删除">
        <input name="s_list_del" type="submit" class="inputbox" onClick="return confirm('你真的要删除所选信息？！');" value="删除">
        <input type="reset" class="inputbox" value="全不选">			</td>
    </TR>
  	</form>
		<tr height="22" valign="bottom">
    <td colspan="13" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
       <input type="hidden" name="cateid" value="<?=$cateid?>">
<?=SplitPage($recordcount, $pagenum, $pagesize);?>
</form>			</td>
	</tr>
	</table>
</body>
</html>
