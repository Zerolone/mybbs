<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>条目列表</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8 ">
<link href="/css/manage.css" type=text/css rel=stylesheet>
<meta content="MSHTML 6.00.2900.2180" name=GENERATOR>
<script language=javascript>
function AddTo(PicSrc)
{
	alert("添加成功，图片名为：\n\n" + PicSrc );
	parent.document.form2.UpPicSelectList.value += "<img src='" + PicSrc + "'>";
}
</script>
</head>

<body>
<script language="JavaScript" src="/js/all.js"></script>
<script language="JavaScript">
function goto(pagenum)
{
	article_list_frm.pagenum.value	= pagenum;
//	alert(pagenum);
	article_list_frm.submit();
}
</script>
<div align="center">
<table border="1" width="460" height="220" bordercolor="#C0C0C0">
	<tr>
		<?php
			if(isset($photo_list))
			{
				$i=0;
				foreach ($photo_list as $photo)
				{
		?>
		 <td align="center" valign="top" >
		<img src="<?=$photo['url']?>" width="111" height="95" onClick="AddTo(this.src);"></td>
		<?php
					$i++;
					if($i == 3)
					{
						echo "</tr><tr>";
					}
		
				}
			}
		?>

</tr>
</table>
</div>
<table width="460" border="0" cellpadding="0" cellspacing="0">
		<tr height="22" valign="bottom">
    <td colspan="4" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
       <input type="hidden" name="cateid" value="<?=$cateid?>">
       <?=SplitPage($recordcount, $pagenum, $pagesize);?>
</form>			</td>
	</tr>
</table>
</body>

</html>
