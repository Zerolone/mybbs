<?php
/**
 * 远程抓取图片另存到本地服务器
 * 
 * @author Zerolone
 * @version 2009-8-14 11:40:31
*/

require ('../include/common.php')';

//获取内容
$content	= $_POST["content"];
	
//抓取图片
$content=getContent($content);

//addslashes
$content=addslashes($content);

//替换换行
$content	= str_replace("\r\n", "", $content);

//echo $content;
?>

<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
</head>
<body>
<script language="javascript">
parent.frames.monolith_article_body.document.body.innerHTML="<?=$content?>";
parent.LayerPicToRemote.style.visibility	=	"hidden";
alert("图片本地化成功！");
</script>
</body>
</html>