<?php
require('../include/common.php');

$result = array();

$result['time'] = date('r');
$result['addr'] = substr_replace(gethostbyaddr($_SERVER['REMOTE_ADDR']), '******', 0, 6);
$result['agent'] = $_SERVER['HTTP_USER_AGENT'];

if (count($_GET)) {
	$result['get'] = $_GET;
}
if (count($_POST)) {
	$result['post'] = $_POST;
}
if (count($_FILES)) {
	$result['files'] = $_FILES;
}

// 日志太大时清空日志，以后改成重命名日志
if (file_exists('script.log') && filesize('script.log') > 102400) {
	unlink('script.log');
}

$log = @fopen('script.log', 'a');
if ($log) {
	fputs($log, print_r($result, true) . "\n---\n");
	fclose($log);
}


// 验证
$error = false;

if (!isset($_FILES['Filedata']) || !is_uploaded_file($_FILES['Filedata']['tmp_name'])) {
	$error = 'Invalid Upload';
}

/**
 * You would add more validation, checking image type or user rights.
 *

if (!$error && $_FILES['Filedata']['size'] > 2 * 1024 * 1024)
{
	$error = 'Please upload only files smaller than 2Mb!';
}

if (!$error && !($size = @getimagesize($_FILES['Filedata']['tmp_name']) ) )
{
	$error = 'Please upload only images, no other files are supported.';
}

if (!$error && !in_array($size[2], array(1, 2, 3, 7, 8) ) )
{
	$error = 'Please upload only images of type JPEG, GIF or PNG.';
}

if (!$error && ($size[0] < 25) || ($size[1] < 25))
{
	$error = 'Please upload an image bigger than 25px.';
}
*/


// Processing

/**
 * Its a demo, you would move or process the file like:
 *
 * move_uploaded_file($_FILES['Filedata']['tmp_name'], '../uploads/' . $_FILES['Filedata']['name']);
 * $return['src'] = '/uploads/' . $_FILES['Filedata']['name'];
 *
 * or
 *
 * $return['link'] = YourImageLibrary::createThumbnail($_FILES['Filedata']['tmp_name']);
 *
 */



if ($error) {
	$return = array(
		'status' => '0',
		'error' => $error
	);
} else {

	$return = array(
		'status' => '1',
		'name' => $_FILES['Filedata']['name']
	);

	// Our processing, we get a hash value from the file
	// $return['hash'] = md5_file($_FILES['Filedata']['tmp_name']);

	// ... and if available, we get image data
	$info = @getimagesize($_FILES['Filedata']['tmp_name']);

	if ($info) {
		$return['width'] = $info[0];
		$return['height'] = $info[1];
		$return['mime'] = $info['mime'];
	}
}

//建立文件夹
if (!is_dir(GALLERYPATH)) {
	mkdir(GALLERYPATH);
}
	
$ImagePath=GALLERYPATH.'/'. date("ym",time());
if (!is_dir($ImagePath)) {
	mkdir($ImagePath);
}

$ImagePath.='/'. date("d",time()) . '/';
if (!is_dir($ImagePath)) {
	mkdir($ImagePath);
}

//网页上面的路径
$ImageUrl			= GALLERYURL . date("ym",time()).'/'.date("d",time()).'/';

//上传文件
$upload_file=$_FILES['Filedata']['tmp_name'];
$upload_file_name=$_FILES['Filedata']['name'];
$upload_file_ext=strtolower( strrchr( $upload_file_name, "." ) );
$newnameurl = saveFilelocal( $upload_file, $ImagePath, $upload_file_ext);

$newnameurl	= $ImageUrl.$newnameurl;

//move_uploaded_file($_FILES['Filedata']['tmp_name'], 'uploads/' . $_FILES['Filedata']['name']);
//$return['src'] = 'uploads/' . $_FILES['Filedata']['name'];

//获取尺寸文件大小
$upload_file_name=SITE_DIR.$newnameurl;
list($width, $height) = getimagesize($upload_file_name);

if ($width>$height){
	$newwidth=PIC_WIDTH;
	$newheight=PIC_WIDTH*($height/$width);
}else {
	$newwidth=PIC_HEIGHT*($width/$height);
	$newheight=PIC_HEIGHT;
}

// Load
$thumb = imagecreatetruecolor($newwidth, $newheight);

//判断
switch ($upload_file_ext) {
	case ".jpg":
		$source = imagecreatefromjpeg($upload_file_name);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		$upload_file_name=str_replace('.jpg','',$upload_file_name);
		imagejpeg($thumb,$upload_file_name."_tumb.jpg", 75);
		break;
		
	case ".gif":
		$source = imagecreatefromgif($upload_file_name);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		$upload_file_name=str_replace('.gif','',$upload_file_name);
		imagegif($thumb,$upload_file_name."_tumb.gif");
		break;
		
	case ".png":
		$source = imagecreatefrompng($upload_file_name);
		imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
		$upload_file_name=str_replace('.png','',$upload_file_name);
		imagepng($thumb,$upload_file_name."_tumb.png");
		break;
}

//入库
$parentid=Request('parentid');
$ArrField=array('filename','width','height','parentid');
$ArrValue=array($newnameurl,$width, $height, $parentid);

$MyDatabase->Insert('gallery', $ArrField, $ArrValue);

// Output

/**
 * Again, a demo case. We can switch here, for different showcases
 * between different formats. You can also return plain data, like an URL
 * or whatever you want.
 *
 * The Content-type headers are uncommented, since Flash doesn't care for them
 * anyway. This way also the IFrame-based uploader sees the content.
 */

if (isset($_REQUEST['response']) && $_REQUEST['response'] == 'xml') {
	// header('Content-type: text/xml');

	// Really dirty, use DOM and CDATA section!
	echo '<response>';
	foreach ($return as $key => $value) {
		echo "<$key><![CDATA[$value]]></$key>";
	}
	echo '</response>';
} else {
	// header('Content-type: application/json');

	echo json_encode($return);
}

?>