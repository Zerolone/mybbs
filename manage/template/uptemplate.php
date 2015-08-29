<?php
/**
* 页面功能：模板文件上传
* 创建日期：2008年9月24日16:09:01
* 修改日期：
* 文 件 名：/manage/article/uptemplate.php
* 作    者：Zerolone
*/
require../include/common.php;

$upload_file=$_FILES['upfile']['tmp_name'];
$upload_file_name=$_FILES['upfile']['name'];
$upload_file_ext=strtolower( strrchr( $upload_file_name, "." ) );

//建立文件夹
if (!is_dir($TemplatePath)) {
	mkdir($TemplatePath);
}
	
//网页上面的路径
$ImageUrl			.= date("ym",time()).'/'.date("d",time()).'/';

//上传文件
$newnameurl = saveFilelocal( $upload_file, $TemplatePath, $upload_file_ext, 0);

$newnameurl	= $TemplateUrl.$newnameurl;
?>
<script>
var str;
str="";
str= '<?=$newnameurl?>';
parent.document.form1.UpLoadPic.value=str;
parent.document.form1.InsertUpLoadPic.style.display = "";
</script>