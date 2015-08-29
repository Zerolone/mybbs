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
      <td height="26" colspan="7" bgcolor="#666666"><b><font color="#FFFFFF">&nbsp;轮显管理 &gt;&gt; 轮显列表</font></b></td>
    </tr>
    <tr valign=center align=middle>
      <td width="40" bgcolor=#999999 height=20><p><font color="#FFFFFF">顺序</font></p></td>
      <td width="*" bgcolor=#999999><font color="#FFFFFF">标题</font></td>
      <td width="60" bgcolor=#999999><font color="#FFFFFF">轮显图片</font></td>
      <td width="90" bgcolor=#999999><font color="#FFFFFF">说明文字</font></td>
    </tr>
		<?php
			if(isset($article_list))
			{
				foreach ($article_list as $article)
				{
		?>
    <tr <?=$article['trbgcolor']?>>
      <td>&nbsp;<?=$article['order']?></td>
      <td>&nbsp;<?php if($article['url']!=''){?>[<a href="<?=$article['url']?>" target="_blank" title="原始地址：<?=$article['url']?>">原</a>]<?php } ?><a href="<?=$article['html']?>" target="_blank" title="前台查看">[前]</a><a href="preview.php?id=<?=$article['id']?>" target="_blank"><?=$article['title']?></a></td>
			<td>&nbsp;<a href="<?=$article['pic1']?>" target="_blank">查看</a></td>
      <td>&nbsp;<?=$article['memo']?></td>
    </tr>
    <?php
				}
		}	
		?>
		<tr height="22" valign="bottom">
    <td colspan="7" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
       <input type="hidden" name="pagenum" value="<?=$pagenum?>">
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
