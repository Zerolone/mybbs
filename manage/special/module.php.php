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
	article_list_frm.submit();
}
</script>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC" id="DBList">
    <tr valign=center align=middle>
      <td width="40" bgcolor=#999999 height=20><font color="#FFFFFF">顺序</font></td>
      <td width="60" bgcolor=#999999 height=20><font color="#FFFFFF">模块类型</font></td>
      <td width="*" bgcolor=#999999><font color="#FFFFFF">标题</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">修改</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">删除</font></td>
    </tr>
  <form name="form1" action="module_update.php" method="post">
		<?php
			if(isset($module_list))
			{
				foreach ($module_list as $module)
				{
		?>
    <tr>
      <td>
			<input type="hidden" name="id[]" value="<?=$module['id']?>">
			<select name="order[]" class="inputbox"><?=getOrderList($module['order'])?></select>
			</td>
      <td>&nbsp;<?=$module['kind_text']?></td>
      <td>&nbsp;<?=$module['title']?></td>
      <td>&nbsp;<a href="module_edit.php?id=<?=$module['id']?>&parentid=<?=$parentid?>">修改</a></td>
			<td><input name="del[]" type="checkbox" id="del<?=$module['id']?>" value="<?=$module['id']?>"><label for="del<?=$module['id']?>">删除</label></td>
    </tr>
    <?php
				}
		}	
		?>
    <tr>
      <td valign=bottom height=20 colspan="6" align=right>
			<a href="module_add.php?parentid=<?=$parentid?>">添加一个模块</a>
			<a href="special.php">返回专题列表</a>
	      <input type="hidden" name="parentid" value="<?=$parentid?>">
	      <input type="hidden" name="pagenum" value="<?=$pagenum?>">
        <input name="s_list_order" type="submit" class="inputbox" value="修改顺序">
        <input type="button" class="inputbox" onclick='selectalldel()' value="全选删除">
        <input name="s_list_del" type="submit" class="inputbox" onClick="return confirm('你真的要删除所选信息？！');" value="删除">
        <input type="reset" class="inputbox" value="全不选">
			</td>
    </TR>
  	</form>
		<tr height="22" valign="bottom">
    <td colspan="6" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
	      <input type="hidden" name="parentid" value="<?=$parentid?>">
       <?=SplitPage($recordcount, $pagenum);?>
</form>			</td>
	</tr>
	</table>
</body>
</html>
