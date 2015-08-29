<?php
/**
 * 类别添加、修改、删除
 * 
 * @author Zerolone
 * @version 2009-8-20 22:26:30
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，请返回重试。';

$mode				= Request('mode');								//提交方式， add为添加， edit为修改
$id					= Request('id',1);								//编号
$title			= Request('title');								//标题
$pagenum		= Request('pagenum',1);						//pagenum
$order			= Request('order');								//顺序
$refresh_url= 'class.php?pagenum='.$pagenum;	//跳转链接
$dir				= Request('dir');									//dir
$templateid	= Request('templateid',1);				//模板编号
$specialid	= Request('specialid',1);					//专题编号

$ArrField=array('title','order','templateid','specialid','dir');
$ArrValue=array($title, $order, $templateid, $specialid,$dir);

if($mode=='add'){
	if($MyDatabase->Insert('gallery_class', $ArrField, $ArrValue)){
		$refresh_msg	= '相册类型：[<font color=red>'.$title.'</font>]，添加成功，点击关闭。';
	
		//管理员日志
		$log_content			= '相册类型 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】成功';		
	}else {
		$refresh_msg	= '相册类型：[<font color=red>'.$title.'</font>]，添加失败，点击关闭。';
	
		//管理员日志
		$log_content			= '相册类型 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】失败';		
	}
	$page_name	= '../../include/refreshno.php';
}
elseif ($mode=='edit'){
	if($MyDatabase->Update('gallery_class', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_msg	= '相册类型：[<font color=red>'.$title.'</font>]，修改成功，点击关闭。';
	
		//管理员日志
		$log_content			= '相册类型 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】成功';		
	}else {
		$refresh_msg	= '相册类型：[<font color=red>'.$title.'</font>]，修改失败，点击关闭。';
	
		//管理员日志
		$log_content			= '相册类型 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】失败';		
	}	
}
elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++)
	{
		$SqlStr = 'DELETE FROM `'. table_pre .'gallery_class` WHERE `id`='. $_POST["del"][$i];
		query($SqlStr);

		//删除所属相册
		$SqlStr = 'DELETE FROM `'. table_pre .'ad` WHERE `parentid`='. $_POST["del"][$i];
		query($SqlStr);
	}
	$refresh_msg	= '删除相册类型[<font color=red>成功</font>]，返回显示页面。';

	//管理员日志
	$log_content			= '相册类型 &gt;&gt; 删除 &gt;&gt; 成功';
}
elseif( isset($_POST['s_list_order']) )
{
	for($i = 0;$i<sizeof( $_POST["order"] );$i++)
	{
		$SqlStr = 'UPDATE `'. table_pre .'gallery_class` SET `order`= '.$_POST["order"][$i].' WHERE `id`='. $_POST["id"][$i];
		query($SqlStr);
	}
	$refresh_msg	= '修改相册类型顺序[<font color=red>成功</font>]，返回显示页面。';

	//管理员日志
	$log_content			= '相册类型 &gt;&gt; 修改顺序 &gt;&gt; 成功';
}
elseif ($mode=="html"){
	//获取id对应html
	//--------------------0-------1-------2----------3
	$SqlStr	= ' SELECT `title`, `dir`, `html`, `specialid`';
	$SqlStr.= ' FROM `'.DB_TABLE_PRE.'view_gallery_class` ';
	$SqlStr.= ' WHERE `id`='.$id;
	$SqlStr.= ' LIMIT 1';

	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record = $MyDatabase->ResultArr [0];
		$title					= $DB_Record[0];
		$dir						= $DB_Record[1];
		$template_html	= $DB_Record[2];
		$specialid			= $DB_Record[3];
	}

	//文件夹重复
	$candir=1;
	//	$candir= canCreateDir($dir, CANTDIR, $id);	
	if ($candir){	
		$pagesize=6;

		$SqlStr	= 'SELECT COUNT( * ) FROM `'.DB_TABLE_PRE.'gallery`';
		$SqlStr.= ' WHERE `parentid` = ' . $id ;
		//总记录
		$recordcount	= 0;
		$RsCount=0;
		$MyDatabase->SqlStr = $SqlStr;
		if ($MyDatabase->Query ()) {
			$DB_Record = $MyDatabase->ResultArr [0];
	
			$recordcount	= $DB_Record[0];
			$RsCount	= $DB_Record[0];
		}

		//总页数
		$pagecount		= ceil($recordcount / $pagesize);

		if($pagecount>100){
			$pagecount=100;
			$recordcount=$pagecount*$pagesize;
		}

		for($ii=0;$ii<$pagecount;$ii++){
			//开始生成文章列表
			//静态页面名
			if ($ii==0){
				$html= '/'. $dir. '/index.html';
			}else{
				$html= '/'. $dir. '/index_'.($ii+1).'.html';
			}
			
			$MyArticle=new Article();
			/*
			显示前后分页
			非空显示
			为空隐藏
			//*/
			$pagenum		=  $pagenum_up =	$ii+1;
			
			//分页
			//$splitpage=addslashes(SplitPageFront($recordcount, $pagenum, $pagesize, 10));
			$splitpage=SplitPageFront($recordcount, $pagenum, $pagesize, 10);
			
			/*
			//文章列表
			if ($kind==0){
//			$articlelist=addslashes(getArticleList($id, $pagesize, 70, 'id', 'DESC', 0, 3, 1, $ii*$pagesize, 0, 0, 0, 0, 1));
				$articlelist=addslashes(getArticleList($cateid_list, $pagesize, 70, 'id', 'DESC', 0, 3, 1, $ii*$pagesize, 0, 0, 0, 0, 1));
//				echo "<hr>文<hr>";
			}elseif($kind==1){
				$articlelist=addslashes(getArticlePicList($cateid_list, $pagesize, 70, 'id', 'DESC', 80, 60, 1, 0, 3, 0, 0, $ii*$pagesize, 0, 0));
//				echo "<hr>图文<hr>";
			}
			*/
			
			//文章列表SEO
			//$articlelist_seo=str_replace('\"', '"', $articlelist.$splitpage.$navbar);
			
			/*//
			echo "<hr>";
			echo $articlelist;
			echo "<br>";
			//*/

			//开始替换
			//获取模板
			$contents='';
			$contents=file_get_contents(SITE_DIR.$template_html);
			
			//循环体
			$str_loop_begin		= '{loop_begin}';
			$str_loop_end			= '{loop_end}';
			$LoopString				= CutStr($contents, $str_loop_begin, $str_loop_end);
			$LoopContent='';
			//循环开始

			//图片列表
			//---------------------0--------1-------2--------3-------4------5--------6--------7-------8----------9----------10--------11
			$SqlStr	= 'SELECT `filename` from `'.DB_TABLE_PRE.'gallery`';
			$SqlStr.= ' WHERE `parentid` ='.$id;
			$SqlStr.= ' ORDER BY `id` DESC ';
			$SqlStr.= ' LIMIT '. $pagesize * $ii .' ,'.$pagesize.';';
	
			$j=0;
						
			$MyDatabase1=new Database();
			$MyDatabase1->SqlStr = $SqlStr;
			if ($MyDatabase1->Query ()) {
				$DB_Record_Arr1 = $MyDatabase1->ResultArr;
				foreach ( $DB_Record_Arr1 as $DB_Record_Loop ) {
					$TempStr				= $LoopString;
					$TempFileName		= $DB_Record_Loop[0];
					$TempFileName_Ext=strtolower( strrchr( $TempFileName, "." ) );
					$TempFileName_Tumb=str_replace($TempFileName_Ext, '', $TempFileName);
					$TempFileName_Tumb.='_tumb'.$TempFileName_Ext;
							
					//原地址
					$TempStr				= str_replace('{filename}', $TempFileName, $TempStr);

					//原地址-ext
					$TempStr				= str_replace('{filename_tumb}', $TempFileName_Tumb, $TempStr);
									
					$LoopContent.=$TempStr;
				}
			}
			//循环结束
			
			//替换循环
			$contents=str_replace($str_loop_begin.$LoopString.$str_loop_end, $LoopContent, $contents);
			
			//2009-8-14 20:40:31 替换头尾
			$MyArticle=new Article();
			$MyArticle->Count=100;
			$MyArticle->TitleCount=100;
			$MyArticle->CateId=TOPURL;
			$MyArticle->OrderBy='Order';
			$MyArticle->OrderSort='ASC';
			
			$MyArticle->Flag=1;
			
			//顶部链接
			$topurl=$MyArticle->getArticleList();

			$MyArticle->CateId=FOOT01;
			
			//底部链接01
			$foot01=$MyArticle->getArticleList();
			$foot01_title=$MyArticle->getCateTitle();

			$MyArticle->CateId=FOOT02;
			//底部链接02
			$foot02=$MyArticle->getArticleList();
			$foot02_title=$MyArticle->getCateTitle();
			
			$MyArticle->CateId=FOOT03;
			//底部链接03
			$foot03=$MyArticle->getArticleList();
			$foot03_title=$MyArticle->getCateTitle();
			
			$MyArticle->CateId=FOOT04;
			//底部链接04
			$foot04=$MyArticle->getArticleList();
			$foot04_title=$MyArticle->getCateTitle();
			
			//各个地方的连接
			//获取对应专题的信息
			$MySpecial=new Special();
			$MySpecial->id=$specialid;
			$MySpecial->getURLById();
			$special_url1=$MySpecial->url1;
			$special_url2=$MySpecial->url2;
			$special_url3=$MySpecial->url3;
			$special_url4=$MySpecial->url4;
			$special_url5=$MySpecial->url5;
			$special_html=$MySpecial->html;

			//顶部链接
			$contents=str_replace("{topurl}", 			$topurl, 					$contents);
					
			//底部连接01-04
			$contents = str_replace("{foot01}", 			$foot01, 					$contents);
			$contents = str_replace("{foot01_title}", $foot01_title,		$contents);
			$contents = str_replace("{foot02}", 			$foot02, 					$contents);
			$contents = str_replace("{foot02_title}", $foot02_title,		$contents);
			$contents = str_replace("{foot03}", 			$foot03, 					$contents);
			$contents = str_replace("{foot03_title}", $foot03_title,		$contents);
			$contents = str_replace("{foot04}", 			$foot04, 					$contents);
			$contents = str_replace("{foot04_title}", $foot04_title,		$contents);
					
			//文章对应的专题的各个链接			
			$contents	= str_replace("{special_url1}", 	$special_url1, 		$contents);
			$contents	= str_replace("{special_url2}", 	$special_url2, 		$contents);
			$contents	= str_replace("{special_url3}", 	$special_url3, 		$contents);
			$contents	= str_replace("{special_url4}", 	$special_url4, 		$contents);
			$contents	= str_replace("{special_url5}", 	$special_url5, 		$contents);
			$contents	= str_replace("{special_html}", 	SITE_URL.SPECIALURL.$special_html, 		$contents);		
			

			//栏目名		
			$contents=str_replace("{title}", 					$title, 								$contents);
//
//			//栏目标题
//			$contents=str_replace("{cateTitle}", 				$cateTitle, 				$contents);
//			
//			//栏目列表
//			$contents=str_replace("{cateList}", 				$cateList, 				$contents);
//			
//			
//			//导航
//			$contents=str_replace("{navbar}", 					$navbar, 						$contents);
//
//			//论坛编号
//			$contents=str_replace("{forumid}", 					$forumid, 					$contents);

			//文章列表
			//$contents=str_replace("{articlelist}", 			$articlelist, 			$contents);

			//文章列表SEO
			//$contents=str_replace("{articlelist_seo}", 	$articlelist_seo, 	$contents);
			
			//分页列表
			$contents=str_replace("{splitpage}", 				$splitpage,					$contents);

			//recordcount
			$contents=str_replace("{recordcount}", 			$RsCount,					$contents);
			
			$handle = fopen ( SITE_DIR . $html, "w" );
			fwrite( $handle, $contents );
			fclose($handle);

			echo '生成相册列表成功:地址为：<a target="_blank" href="'. $html .'">'. $html .'</a><br />';
			$refresh_msg	= '相册列表：[<font color=red>生成</font>]成功，跳转到分类列表页面。';
		}
	}else{
		$refresh_msg	= '相册列表存在，请修改相册列表目录，跳转到分类列表页面。';

	}


	$refresh_url	= 'class.php';

	//管理员日志
	$log_content			= '相册 &gt;&gt; 生成 &gt;&gt; 成功';
}


require($page_name.'.php');

//管理员日志
require('../../include/log.php');

require('../../include/debug.php');
?>