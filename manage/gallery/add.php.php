<html xmlns="http://www.w3.org/1999/xhtml" lang="zh-CN">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="Content-Language" content="zh-CN" />
<!--样式表-->
<link rel="stylesheet"  href="/css/manage.css" type="text/css" >

<script type="text/javascript" src="../../js/mootools-1.2-core.js"></script>
<script type="text/javascript" src="../../js/mootools-1.2-more.js"></script>
<script type="text/javascript" src="js/Lang.js"></script>
<script type="text/javascript" src="js/Swiff.Uploader.js"></script>
<script type="text/javascript" src="js/Fx.ProgressBar.js"></script>
<script type="text/javascript" src="js/FancyUpload2.js"></script>
<script type="text/javascript" src="js/Upload.js"></script>

<link href="css/css.css" rel="stylesheet" type="text/css" />

</head>
<body>
<form action="script.php?parentid=<?=$parentid?>" method="post" enctype="multipart/form-data" id="form-demo">
<input type="button" name="Submit2" value=" 返 回 (ALT + B) " onClick="history.back(-1)" class="inputbox" accesskey="B"> 
	<fieldset id="demo-fallback" style="display:none;">
		<legend>File Upload</legend>
		<p>如果这里显示了， 说明你的代码出错了！</p>
		<label for="demo-photoupload"><input type="file" name="Filedata" /></label>
	</fieldset>
 
	<div id="demo-status" class="hide">
		<p>
			<a href="#" id="demo-browse">浏览本地文件</a>
			<a href="#" id="demo-clear"><img src="assets/clear.png" border=0></a>
			<a href="#" id="demo-upload"><img src="assets/upload.png" border=0></a>
		</p>
		<div>
			<strong class="overall-title"></strong><br />
			<img src="assets/progress-bar/bar.gif" class="progress overall-progress" />
		</div>
		<div>
			<strong class="current-title"></strong><br />
			<img src="assets/progress-bar/bar.gif" class="progress current-progress" />
		</div>
		<div class="current-text"></div>
	</div>
 
	<ul id="demo-list"></ul>
</form>

