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
      <td height="26" colspan="4" bgcolor="#666666"><b><font color="#FFFFFF">&nbsp;文章管理 &gt;&gt; 上传图片列表</font></b></td>
    </tr>
    <tr valign=center align=middle>
      <td width="40" bgcolor=#999999 height=20><p><font color="#FFFFFF">图片</font></p></td>
      <td width="*" bgcolor=#999999><font color="#FFFFFF">图片地址</font></td>
      <td width="*" bgcolor=#999999><font color="#FFFFFF">原图地址</font></td>
      <td bgcolor=#999999><font color="#FFFFFF">提交日期</font></td>
    </tr>
	 <form name="form1" action="upload_pic_action.php" method="post">
		<?php
			if(isset($photo_list))
			{
				foreach ($photo_list as $photo)
				{
		?>
    <tr>
	  <label for="del<?=$photo['id']?>">
      <td>&nbsp;<img name="" src="<?=$photo['url']?>" width="32" height="32" alt=""></td>
      <td>&nbsp;<input name="del[]" type="checkbox" id="del<?=$photo['id']?>" value="<?=$photo['id']?>"><a href="<?=$photo['url']?>" target="_blank"><?=$photo['url']?></a></td>
      <td>&nbsp;<a href="<?=$photo['urlold']?>" target="_blank"><?=$photo['urlold']?></a></td>
			<td>&nbsp;<?=$photo['posttime']?></td>
	  </label>
    </tr>
    <?php
				}
		}	
		?>
    <tr>
      <td valign=bottom height=20 colspan="6" align=right>
				<input type="hidden" name="pagenum" value="<?=$pagenum?>">
        <input type="button" class="inputbox" onclick='selectalldel()' value=" 全 选 ">
        <input name="s_list_del" type="submit" class="inputbox" onClick="return confirm('你真的要删除所选信息？！');" value=" 删 除 ">
        <input type="reset" class="inputbox" value=" 全 不 选 ">
			</td>
    </TR>
  	</form>		
		<tr height="22" valign="bottom">
    <td colspan="4" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
    <input type="hidden" name="cateid" value="<?=$cateid?>">
		<?=SplitPage($recordcount, $pagenum, $pagesize);?>
		</form>
		</td>
	</tr>
	</table>
</body>
</html>
