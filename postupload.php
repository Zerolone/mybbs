<?php
/**
 * 文件上传部分
 */
$ifupload=0;
$attachs=array();
$str_att='';
//遍历上传
for($i=1;$i<=UPLOAD_FILES;$i++){
	${'atc_attachment'.$i}=$_FILES['atc_attachment'.$i];
	if(is_array(${'atc_attachment'.$i})){
		$atc_attachment=${'atc_attachment'.$i}['tmp_name'];
		$atc_attachment_name=${'atc_attachment'.$i}['name'];
		$atc_attachment_size=${'atc_attachment'.$i}['size'];
	}else{
		$atc_attachment=${'atc_attachment'.$i};
		$atc_attachment_name=${'atc_attachment'.$i.'_name'};
		$atc_attachment_size=${'atc_attachment'.$i.'_size'};
	}
//	$atc_attachment_name = Char_cv($atc_attachment_name);

	//说明
	$descrip	=Request('atc_desc'.$i);

	//如果上传文件不存在
	/**/
	if(!($atc_attachment)){
		continue;
	}else {
		$ifupload=1;
	}
	/**/
	/*
	* 附件上传功能开关 
	*/
	if(UPLOAD!=1){
		ErrorMsg('系统设定不能上传附件！');
	}

	//版块权限判断
	
	//用户组权限判断
	
	//最大上传文件大小
//	DebugStr($atc_attachment_size);
	if($atc_attachment_size>UPLOAD_MAX * 1024){
		ErrorMsg('上传的文件过大！');
	}
	
	//上传文件类型
	$attach_ext = substr(strrchr($atc_attachment_name,'.'),1);
	$attach_ext=strtolower($attach_ext);

	$available_type = explode(' ',UPLOAD_EXT);
	$attach_ext = substr(strrchr($atc_attachment_name,'.'),1);
	$attach_ext=strtolower($attach_ext);
	if(empty($attach_ext) || !@in_array($attach_ext,$available_type)){
		ErrorMsg('不允许上传此类文件！');
	}
	
	$mybbs_user['uploadtime']=TIMESTAMP;

	$randvar=substr(md5(TIMESTAMP+$i),10,15);
	$fileuplodeurl="{$fid}_{$user->uid}_{$randvar}.$attach_ext";
	
	//按月份来储存附件
	$savedir = date('ym');
	//保存路径
	$attachdir = 'upload/' . $savedir . '/' ;

	//文件上传路径
	//$fileuplodeurl= $savedir.'/'.$fileuplodeurl;
		
	//如果文件夹不存在，则建立文件夹
	if(!is_dir($attachdir)) {
		@mkdir($attachdir);
		@chmod($attachdir, 0777);
		@fclose(@fopen($attachdir.'/index.html', 'w'));
		@chmod($attachdir.'/index.html', 0777);
	}
	
	$source=$attachdir . $fileuplodeurl;//版块id_文件名_时间.类型
	//DebugStr($savedir);
	if(!postupload($atc_attachment,$source)){
		DebugStr('文件上传失败！');
	}	

	//判断文件类型
	$type='img';

	/**/
	//获取文件大小
	$size=ceil(filesize("$attachdir/$fileuplodeurl")/1024);
	$atc_attachment_name=addslashes($atc_attachment_name);
		
	$ArrField=array('fid','uid',			'hits',	'name',							'type',	'size',	'attachurl',									'uploadtime',	'descrip');
	$ArrValue=array($fid, $user->uid	,0,			$atc_attachment_name,$type,	$size,	$attachdir .'/'.$fileuplodeurl,TIMESTAMP,		$descrip);	
	if($MyDatabase->Insert('attachs', $ArrField, $ArrValue)){
		$aid=$MyDatabase->Insert_id();		
		
		$descrip = str_replace('\\','',$descrip);
		if ($descrip!=''){
			$str_att.="\n[b]" . str_replace('\\','',$descrip) . "[/b]";		
		}
		$str_att.= "\n[attach]". $aid .'[/attach]';		
	}else {
		ErrorMsg($MyDatabase->SqlStr.'<br />添加附件到数据库失败失败！');
	}
}
?>