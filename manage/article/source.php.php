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
<script language="JavaScript">
function goto(pagenum)
{
	article_list_frm.pagenum.value	= pagenum;
//	alert(pagenum);
	article_list_frm.submit();
}
</script>
  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC">
    <tr height="26">
      <td height="26" colspan="6" bgcolor="#666666"><b><font color="#FFFFFF">&nbsp;文章采集管理 &gt;&gt; 采集列表</font></b></td>
    </tr>
    <tr valign=center align=middle>
      <td  height=20 width="*" bgcolor=#999999><font color="#FFFFFF">标题</font></td>
      <td width="80" bgcolor=#999999><font color="#FFFFFF">修改日期</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">修改</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">删除</font></td>
    </tr>
		<?php
			if(isset($source_list))
			{
				foreach ($source_list as $source)
				{
		?>
    <tr <?=$source['trbgcolor']?>>
      <td>&nbsp;<?=$source['title']?></td>
			<td>&nbsp;<?=$source['posttime']?></td>
      <td>&nbsp;<a href="javascript:ffClick('article/source_edit.php?id=<?=$source['id']?>','修改：<?=$source['title']?>')">修改|采集标题|采集内容</a></td>
      <td>&nbsp;
        <label>
        <input type="checkbox" name="a" id="a">
        </label>
      <a href="source_del.php?id=<?=$source['id']?>">删除</a></td>
    </tr>
    <?php
				}
		}	
		?>
		<tr height="22" valign="bottom">
    <td colspan="6" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
       <input type="hidden" name="pagenum" value="<?=$pagenum?>">
       <input type="hidden" name="cateid" value="<?=$cateid?>">
			<a href="javascript:goto('1');" title="第一页"><b>|&lt;</b></a>  <a href="javascript:goto('<?=$pagenum_up?>');" title="上一页"><b>&lt;</b></a> 
			<?
			if(isset($beginlist))
			{
			foreach ($beginlist as $begin)
			{
			?>
			<a href="javascript:goto('<?=$begin[0]?>');" title="第<?=$begin[0]?>页">[<?=$begin[0]?>]</a>
			<?
			}
			}
			?> [<font color="red"><?=$pagenum?></font>] 
			<?
			if(isset($endlist))
			{
			foreach ($endlist as $end)
			{
			?>
			<a href="javascript:goto('<?=$end[0]?>');" title="第<?=$end[0]?>页">[<?=$end[0]?>]</a>
			<?
			}
			}
			?>
			<a href="javascript:goto('<?=$pagenum_down?>');" title="下一页"><b>&gt;</b></a> <a href="javascript:goto('<?=$pagend?>');" title="第<?=$pagend?>页"><b>&gt;|</b></a>&nbsp;
					<strong><font color=red><?=$pagenum?></font>/<?=$pagecount?></strong>页&nbsp;<b><font color="#FF0000"><?=$recordcount?></font></b>条记录&nbsp;<b><?=$pagesize?></b>条/页&nbsp;
			转到：
			<input type="text" name="pagenum1" size=2 maxlength=10 class="InputBox" value=""> <input class="inputbox" type="submit"  value="Go"  name="cndok">
</form>			</td>
	</tr>
	</table>
</body>
</html>
