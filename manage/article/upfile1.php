<?php
require('../include/common.php');
require('../../include/watermark.php');
$upload_file=$_FILES['upfile']['tmp_name'];
$upload_file_name=$_FILES['upfile']['name'];
$upload_file_ext=strtolower( strrchr( $upload_file_name, "." ) );

//建立文件夹
if (!is_dir(IMAGEPATH)) {
	mkdir(IMAGEPATH);
}
	
$ImagePath=IMAGEPATH.'/'. date("ym",time());
if (!is_dir($ImagePath)) {
	mkdir($ImagePath);
}

$ImagePath.='/'. date("d",time()) . '/';
if (!is_dir($ImagePath)) {
	mkdir($ImagePath);
}
	
//网页上面的路径
$ImageUrl			=IMAGEURL. date("ym",time()).'/'.date("d",time()).'/';

//是否打水印
$watermark=1;
if (isset($_POST['watermark'])){
	$watermark 	= $_POST['watermark'] ;
}

//上传文件
$newnameurl = saveFilelocal( $upload_file, $ImagePath, $upload_file_ext, $watermark);

$newnameurl	= $ImageUrl.$newnameurl;

/*
echo '<br>upload_file='.$upload_file;
echo '<br>ImagePath='.$ImagePath;
echo '<br>newnameurl='.$newnameurl;
//*/

$MyDatabase->Insert('article_pic', array('url'),array($newnameurl));

//$TheString = '<img src="'.$newnameurl.'">';

?>
<script>
var str;
str="";
str= '<?=$newnameurl?>';
parent.document.form1.UpLoadPic.value=str;
parent.document.form1.InsertUpLoadPic.style.display = "";
</script>