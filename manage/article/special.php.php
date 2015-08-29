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
    <td height="26" colspan="8" bgcolor="#666666"><b><font color="#FFFFFF">&nbsp;首页文章区域管理 &gt;&gt; 首页文章列表</font></b></td>
  </tr>
  <tr valign=center align=middle>
    <td width="40" bgcolor=#999999 height=20><p><font color="#FFFFFF">顺序</font></p></td>
    <td width="*" bgcolor=#999999><font color="#FFFFFF">标题</font></td>
    <td width="60" bgcolor=#999999><font color="#FFFFFF">图片</font></td>
    <td width="90" bgcolor=#999999><font color="#FFFFFF">说明文字</font></td>
    <td width="24" bgcolor=#999999><font color="#FFFFFF">选定</font></td>
  </tr>
  <form name="form1" action="update.php" method="post">
    <?php
			if(isset($article_list))
			{
				foreach ($article_list as $article)
				{
		?>
    <tr>
	<label for="select<?=$article['id']?>">
      <td><input type="hidden" name="id[]" value="<?=$article['id']?>">
        <select name="order[]" class="inputbox">
          <?=getOrderList($article['order'])?>
        </select></td>
      <td>&nbsp;
        <?php if($article['url']!=''){?>
        [<a href="<?=$article['url']?>" target="_blank" title="原始地址：<?=$article['url']?>">原</a>]
        <?php } ?>
        <a href="preview.php?id=<?=$article['id']?>" target="_blank">
        <?=$article['title']?>
        </a></td>
      <td>&nbsp;<a href="<?=$article['pic']?>" target="_blank">查看</a></td>
      <td>&nbsp;
        <?=$article['memo']?></td>
      <td><input name="selectid[]" type="checkbox" id="select<?=$article['id']?>" value="<?=$article['id']?>"></td>
	  </label>
    </tr>
    <?php
				}
		}	
		?>
    <tr>
      <td valign=bottom height=20 colspan="8" align=right><input type="hidden" name="pagenum" value="<?=$pagenum?>">
        <input type="hidden" name="area" value="<?=$area?>">
        <input type="button" class="inputbox" onclick='selectall()' value=" 全 选 ">		
        <input name="reset" 		type="reset"  class="inputbox" value="全不选">
        <input name="s_list_order" type="submit" class="inputbox" value=" 修 改 顺 序 ">
        <input name="s_list_area"  type="submit" class="inputbox" value=" 删 除 显 示 " onClick="return confirm('确定删除选定文章的特殊区域显示？仅删除特殊位置显示， 不删除文章本身。');">		</td>
    </TR>
  </form>
  <tr height="22" valign="bottom">
    <td colspan="8" width="100%" align="right"><form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
        <input type="hidden" name="area" value="<?=$area?>">
        <?=SplitPage($recordcount, $pagenum);?>
      </form></td>
  </tr>
</table>
</body>
</html>
