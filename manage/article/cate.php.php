<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>文章分类</title>
<link rel="STYLESHEET" type="text/css" href="<?=SITE_FOLDER?>/css/manage.css">
<script language="javascript" src="<?=SITE_FOLDER?>/js/all.js"></script>
</head>

<body>
<form name="editid" method="post" action="cate_update.php">
<?php foreach($catedb as $key=>$cate){ ?>
栏目分类：<?=$cate['name']?>
<?php foreach($forumdb[$cate['fid']] as $key=>$forums){?>
--<b><?=$forums['name']?></b>
<?php }?>
<hr color="#666666">
<?php }?>
</form>

</body>

</html>
