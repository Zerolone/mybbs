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

  <table width="100%" border="0" align="center" cellpadding="1" cellspacing="1" bgcolor="#CCCCCC"  id="DBList">
    <tr bgcolor="#6A6A6A">
    <td colspan="13" height="26"><form name="searchtitle" action="" style="MARGIN-BOTTOM:0px"><b><font color="#FFFFFF">&nbsp;文章管理 &gt;&gt; 文章操作&nbsp;&nbsp;&nbsp;&nbsp;文章标题搜索</font></b><input type="text" name="searchkey" class="InputBox"> <input type="submit" name="searchsubmit" value="搜索(按回车即可)" class="inputbox">
	  <input type="hidden" name="cateid" value="<?=$cateid?>">
      </form></td>
  </tr>
    </tr>
    <tr valign=center align=middle>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">顺序</font></td>
      <td width="30" bgcolor=#999999 height=20><font color="#FFFFFF">编号</font></td>
      <td width="30" bgcolor=#999999><font color="#FFFFFF">状态</font></td>
      <td width="*" bgcolor=#999999><font color="#FFFFFF">标题</font></td>
      <td width="60" bgcolor=#999999><font color="#FFFFFF">提交日期</font></td>
      <td width="40" bgcolor=#999999><font color="#FFFFFF">点击数</font></td>
      <td width="24" bgcolor=#999999><font color="#FFFFFF">选定</font></td>
      <td width="30" bgcolor=#999999><font color="#FFFFFF">修改</font></td>
    </tr>
  <form name="form1" action="update.php" method="post">
		<?php
			if(isset($article_list))
			{
				foreach ($article_list as $article)
				{
		?>
		<label for="select<?=$article['id']?>">
    <tr>
	  <td>&nbsp;<input type="hidden" name="id[]" value="<?=$article['id']?>">
        <select name="order[]" class="inputbox">
          <?=getOrderList($article['order'])?>
        </select></td>
        	  <td>&nbsp;<?=$article['id']?></td>
        	  <td>&nbsp;<?=$article['flag_txt']?></td>

      <td>&nbsp;<?php if($article['url']!=''){?>[<a href="<?=$article['url']?>" target="_blank" title="原始地址：<?=$article['url']?>">原</a>]<?php } ?><a href="preview.php?id=<?=$article['id']?>" target="_blank" title="预览页面">[预]</a><a href="../../aaa.php?id=<?=$article['id']?>" target="_blank"><?=$article['title']?></a></td>
			<td>&nbsp;<?=$article['posttime']?></td>
      <td>&nbsp;<?=$article['hits']?></td>
      <td><input name="selectid[]" type="checkbox" id="select<?=$article['id']?>" value="<?=$article['id']?>"></td>
      <td>&nbsp;<a href="edit.php?id=<?=$article['id']?>&pagenum=<?=$pagenum?>">修改</a></td>
    </tr>
	  </label>
    <?php
				}
		}	
		?>
    <tr>
      <td valign=bottom height=20 colspan="9" align=right>
        <input type="button" class="inputbox" onclick='selectall()' value=" 全 选 ">
        <input name="reset" 		type="reset"  class="inputbox" value="全不选">
        <input name="s_list_del"	type="submit" class="inputbox" value=" 删 除 " onClick="return confirm('确定删除选定内容？');">
        <input name="s_issue" 		type="submit" class="inputbox" value=" 发 布 " onClick="return confirm('确定发布选定内容？');">
        <input name="s_unissue" 	type="submit" class="inputbox" value="不发布" onClick="return confirm('确定取消发布选定内容？');">
				<input name="s_list_order" type="submit" class="inputbox" value="修改顺序" onClick="return confirm('确定修改顺序？');">
				<input name="s_move" 			type="submit" class="inputbox" value="移动到-&gt;" onClick="return confirm('确定移动文章？');"><select name="changecateid" class="inputbox" id="changecateid" style="width:160px">
          <?php
					if(isset($cate_list))
					{
						foreach ($cate_list as $cate)
						{
					?>
          <option value="<?=$cate['id']?>" <?=$cate['selected']?>>
          <?=$cate['title']?>
          </option>
          <?
						}
					}
					?>
        </select></td>
	      <input type="hidden" name="pagenum" 	value="<?=$pagenum?>">
      	<input type="hidden" name="cateid" 		value="<?=$cateid?>">
    </TR>
  	</form>
		<tr height="22" valign="bottom">
    <td colspan="9" width="100%" align="right">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="article_list_frm">
       <input type="hidden" name="cateid" value="<?=$cateid?>">
	   <input type="hidden" name="searchkey" value="<?=$searchkey?>">
				<?=SplitPage($recordcount, $pagenum, $pagesize);?>
</form></td>
	</tr>
	</table>
<script language="JavaScript">   
var r   =   document.body.createTextRange();
var thefindText = '<?php echo $searchkey?>';
if (thefindText!=''){
	for(var i=0;r.findText(thefindText);i++){   
		r.execCommand('bold',  		 'false');   
		r.execCommand('ForeColor',   'false',   'red');   
		r.execCommand('BackColor',   'false',   'yellow');
		r.collapse(false);   
	 }
}   
</script>   

</body>
</html>
