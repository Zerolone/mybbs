<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
<title>条目列表</title>
<meta http-equiv=Content-Type content="text/html; charset=utf-8 ">
<link href="../../css/manage.css" type=text/css rel=stylesheet>
<meta content="MSHTML 6.00.2900.2180" name=GENERATOR>
</head>
<script type="text/javascript" src="../scripts/mootools-1.2-core.js"></script>
<script type="text/javascript" src="../scripts/mootools-1.2-more.js"></script>
<script language="JavaScript">
function goto(pagenum)
{
	nav_bar_frm.pagenum.value	= pagenum;
//	alert(pagenum);
	nav_bar_frm.submit();
}
</script>
<body topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0">
<div id="message"></div>

<form name="form1" action="update.php" method="post">
<div class="csstb head">
	<div class="div20">标题</div>
	<div class="div40">说明</div>
	<div class="div25">网址</div>
	<div>首显</div>
	<div>显示</div>
	<div>选择</div>
  <!--
	<div>修改</div>
  -->
</div>

<div id="sortable" class="divdrag">

<?php
	if(isset($navbar_list)){
		foreach ($navbar_list as $navbar){
?>
<div class="sortme" id="sortme" alt="<?=$navbar['id']?>">
		<label for="selectid<?=$navbar['id']?>">
		<input type="hidden" name="id[]" value="<?=$navbar['id']?>">
		<div class="div20 editabletitle"><?=encode($navbar['title'])?></div>
		<div class="div40 editablecontent"><?=encode($navbar['content'])?></div>
		<div class="div25 editableurl"><a href="<?=$navbar['url']?>" target="_blank"><?=$navbar['url']?></a></div>
		<div class="editablelevel"><?=$navbar['level_txt']?></div>
		<div class="editableactive"><?=$navbar['active_txt']?></div>
		<div><input name="selectid[]" type="checkbox" id="selectid<?=$navbar['id']?>" class="selectbox" value="<?=$navbar['id']?>"></div>
    <!--
		<div>&nbsp;<a href="edit.php?id=<?=$navbar['id']?>">修改</a></div>
		-->
    </label>
</div>
<?php
	}
}
?>
</div>

<div class="div100">
      <input type="button" class="inputbox" onClick="javascript:window.parent.MUI.navaddWindow(<?=$cateid?>);" value="添加网址">
      <input name="s_list_lorder" id="s_list_lorder" type="submit" class="inputbox" value="修改顺序">
    <input type="hidden" name="pagenum"  id="pagenum" value="<?=$pagenum?>">
		<input type="hidden" name="pagesize" id="pagesize" value="<?=$pagesize?>">
			<input type="hidden" name="cateid"   value="<?=$cateid?>">
     	<input type="hidden" name="sort_id" id="sort_id" value="" />
      <!--
      <input type="button" class="inputbox" onClick="alert(sort_id.value);" value="sort_id">
      -->
			<a href="?cateid=<?=$cateid?>&pagesize=<?=($pagesize/2)?>">1/2倍排序</a>
	<a href="?cateid=<?=$cateid?>&pagesize=<?=($pagesize*2)?>">2倍排序</a></div>
</form>
<div class="div90">
		<form method="get" action="" style="MARGIN-BOTTOM:0px" name="nav_bar_frm">
			<input type="hidden" name="cateid"   value="<?=$cateid?>">
			<input type="hidden" name="pagesize" value="<?=$pagesize?>">
			<?=SplitPage($recordcount, $pagenum, $pagesize);?>
		</form>	
</div>
<script type="text/javascript" src="../scripts/sort.js"></script>
<script type="text/javascript" src="../scripts/navedit.js"></script>

</body>
</html>
