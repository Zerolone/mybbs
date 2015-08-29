<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>条目列表</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8 ">
<link href="../../css/manage.css" type=text/css rel=stylesheet>
<meta content="MSHTML 6.00.2900.2180" name=GENERATOR>
</head>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<script language="JavaScript" src="../../js/all.js"></script>
<script language="JavaScript" src="../../js/trcolor.js"></script>
<script language="JavaScript">
function goto(pagenum)
{
	nav_bar_frm.pagenum.value	= pagenum;
//	alert(pagenum);
	nav_bar_frm.submit();
}
</script>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="DBList">
    <tr height="26">
      <td height="26" colspan="7" bgcolor="#666666"><b><font color="#FFFFFF">&nbsp;导航菜单管理 &gt;&gt; 相关网址</font></b></td>
    </tr>
    <tr valign=center align=middle>
      <td width="25" bgcolor=#999999 height=21><p><font color="#FFFFFF">顺序</font></p></td>
      <td width="60" bgcolor=#999999><font color="#FFFFFF">标题</font></td>
      <td width="*" bgcolor=#999999><font color="#FFFFFF"> 地址</font></td>
      <td width="50" bgcolor=#999999><font color="#FFFFFF">是否显示</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF"> 删除</font></td>
      <td bgcolor=#999999><font color="#FFFFFF">修改</font></td>
    </tr>
  <form name="form1" action="navbar_update.php" method="post">
		<?php
			if(isset($navbar_list))
			{
				foreach ($navbar_list as $navbar)
				{
		?>
    <label for="del<?=$navbar['id']?>">
    <tr>
			<input type="hidden" name="id[]" value="<?=$navbar['id']?>">
      <td>&nbsp;<select name="order[]" class="inputbox"><?=getOrderList($navbar['order'])?></select></td>
      <td>&nbsp;<?=encode($navbar['title'])?></td>
      <td>&nbsp;<?=encode($navbar['url'])?></td>
      <td>&nbsp;<?=$navbar['active_txt']?></td>
			<td><input name="del[]" type="checkbox" id="del<?=$navbar['id']?>" value="<?=$navbar['id']?>">删除</td>
      <td>&nbsp;<a href="navbar_edit.php?id=<?=$navbar['id']?>&pid=<?=$pid?>">修改</a></td>
    </tr>
    </label>
    <?php
				}
		}	
		?>
    <tr>
      <td valign=bottom height=20 colspan="7" align=right><a href="navbar_add.php?pid=<?=$pid?>">添加一个相关网址</a> <a href="nav.php">返回列表</a>
        <input type="hidden" name="pid" value="<?=$pid?>">
        <input type="hidden" name="pagenum" value="<?=$pagenum?>">
        <input name="s_list_order" type="submit" class="inputbox" value="修改顺序">
         <input type="button" class="inputbox" onclick='selectalldel()' value="全选删除">
        <input name="s_list_del" type="submit" class="inputbox" onClick="return confirm('你真的要删除所选信息？！');" value=" 删 除 ">
        <input type="reset" class="inputbox" value=" 全不选 ">
      </td>
    </tr>
  	</form>
		<tr height="22" valign="bottom">
    <td colspan="7" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="nav_bar_frm">
			<?=SplitPage($recordcount, $pagenum, $pagesize);?>
		</form>	
		</td>
	</tr>
	</table>
</body>
</html>
