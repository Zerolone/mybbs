<?php
/**
 * 文章栏目添加、修改
 * 
 * @author Zerolone
 * @version 2009-12-3 15:01:00
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';

$refresh_url	= Request('refresh_url','cate.php');
$mode					=	Request('mode','add');			//提交方式， add为添加， edit为修改
$id						= Request('id',0);						//栏目编号
$parentid			= Request('parentid');				//上级编号
$level				= Request('level');						//顺序+栏目级别
$title				=	Request('title');						//标题
$url					=	Request('url');							//地址

//---------------标题----顺序+栏目级别---上级编号---替换地址
$ArrField=array('title','level',				'parentid', 'url');
$ArrValue=array($title,	$level,					$parentid,  $url);

//添加
if($mode=='add'){
	if ($MyDatabase->Insert('article_cate',$ArrField,$ArrValue)){
		$refresh_msg	= '文章栏目：[<font color=red>'.$title.'</font>]，添加成功，跳转到修改页面。';
	
		//管理员日志
		$log_content			= '文章栏目 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】成功';		
	}else{
		$refresh_msg	= '文章栏目：[<font color=red>'.$title.'</font>]，添加失败，跳转到修改页面。';
	
		//管理员日志
		$log_content			= '文章栏目 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】失败';		
	}
}elseif ($mode=='edit'){
	//判断$dir是否重复
		if ($MyDatabase->Update('article_cate', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_msg	= '文章分类：[<font color=red>'.$title.'</font>]，修改成功，跳转到修改页面。';
	
		//管理员日志
		$log_content			= '文章分类 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】成功';
		}else{
		$refresh_msg	= '文章分类：[<font color=red>'.$title.'</font>]，修改失败，跳转到修改页面。';
	
		//管理员日志
		$log_content			= '文章分类 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】失败';
		}
}elseif ($mode=="edit_title"){
	//---------------标题
	unset($ArrField);
	unset($ArrValue);
	$ArrField=array('title');
	$ArrValue=array($title);
	
	if ($MyDatabase->Update('article_cate', $ArrField, $ArrValue, '`id`='.$id)){
		$refresh_msg	= '文章分类：[<font color=red>'.$title.'</font>]，修改成功，跳转到修改页面。';
		
		//管理员日志
		$log_content			= '文章分类 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】成功';
	}else{
		$refresh_msg	= '文章分类：[<font color=red>'.$title.'</font>]，修改失败，跳转到修改页面。';
		
		//管理员日志
		$log_content			= '文章分类 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】失败';
	}

	$refresh_url	= 'cate.php#'.$id;
}elseif ($mode=="del"){
	//删除栏目
	//------------------0---------1----------2--------3
	$SqlStr	= 'Select `title`, `level` From `' .DB_TABLE_PRE. 'article_cate` WHERE `id`= ' . $id;
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record = $MyDatabase->ResultArr [0];
		$title	= $DB_Record[0];
		$level	= $DB_Record[1];
	}

	//level长度
	$level_len	= strlen($level);

	
		$refresh_msg	= '文章栏目删除失败，跳转到修改页面。';
	
		//管理员日志
		$log_content			= '文章栏目删除失败';
	
	//删除当前编号记录//删除当前编号记录下面的记录
	if(	$MyDatabase->Delete('article_cate','`id`='.$id) &&	$MyDatabase->Delete('article_cate','left(`level`, '.$level_len.') = '. $level)){
	//删除所有属于该类的文章
	//$SqlStr = 'DELETE FROM `'.table_pre.'article` WHERE left(`level`, '.$level_len.') = '. $level ;
	//query($SqlStr);
		$refresh_msg	= '文章栏目删除成功，跳转到修改页面。';
	
		//管理员日志
		$log_content			= '文章栏目删除成功';		
	}
}elseif ($mode=="unite"){
	$cate1		= $_POST['cate1'];
	$cate2		= $_POST['cate2'];

	$SqlL = 'UPDATE `'.table_pre.'article` SET';

	//标题
	$SqlL .= '`cateid`=';
	$SqlL .= '\'' . $cate2 . '\'';

	$SqlL.=  ' WHERE `cateid`=' . $cate1;

	query($SqlL);

	$refresh_msg	= '文章分类：[<font color=red>合并</font>]成功，跳转到合并后的页面。';

	$refresh_url	= 'article.php?cateid='.$cate2;

	//管理员日志
	$log_content			= '文章栏目 &gt;&gt; 合并 &gt;&gt; 成功';
}//生成静态
elseif ($mode=="html"){
	//获取id对应Level, forumid
	//--------------------0-------1--------2-----------3-------4---------5
	$SqlStr	= ' SELECT `level`, `html`, `pagesize`, `title`, `dir`, `specialid`';
	$SqlStr.= ' FROM `'.DB_TABLE_PRE.'view_cate` ';
	$SqlStr.= ' WHERE `id`='.$id;
	$SqlStr.= ' LIMIT 1';

	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record = $MyDatabase->ResultArr [0];
		$level					= $DB_Record[0];
		$template_html	= $DB_Record[1];
		$pagesize				= $DB_Record[2];
		$cateTitle			= $DB_Record[3];
		$dir						= $DB_Record[4];
		$specialid			= $DB_Record[5];
	}
		
	//获取下级ID
	$level_len = strlen($level);
	$cateid_list='';
	//------------------0------------1--------------2-----------3-----------4
//	$SqlStr	= 'SELECT `id`, `title`';
	$SqlStr	= 'SELECT `id`';
	$SqlStr.= ' FROM `'.DB_TABLE_PRE.'article_cate`';
	$SqlStr.= ' WHERE left(`level`, '.$level_len.')='.$level;
	$SqlStr.= ' ORDER BY `level` ASC;';

	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $DB_Record ) {
			$cateid_list.=$DB_Record[0].',';
		}
	}
	
	$cateid_list.=0;

	if ($candir){
		$level_len= strlen($level) / 2 ;
		//level列表
		$level_str='0';
		for ($i=1;$i<=$level_len;$i++){
			$level_str.= ','.substr($level,0, 2*$i);
		}

		//导航菜单
		//-------------------0------1-------2--------3
		$SqlStr	= ' SELECT `id`, `title`, `dir` ';
		$SqlStr.= ' FROM `'.DB_TABLE_PRE.'article_cate` ';
		$SqlStr.= ' WHERE `level` in ('.$level_str.')';
		$SqlStr.= ' ORDER BY `level` ASC';

		$navbar = '';
		$MyDatabase1=new Database();
		$MyDatabase1->SqlStr = $SqlStr;
		if ($MyDatabase1->Query ()) {
			$DB_Record_Arr1 = $MyDatabase1->ResultArr;
			foreach ( $DB_Record_Arr1 as $DB_Record1 ) {
				$navbar.=' <a href=\"/'.$DB_Record1[2].'\">'. $DB_Record1[1] .'</a> &gt';
			}
		}

		$navbar					= '<a href=\"'. SITE_URL .'\">首页</a> &gt; '.$navbar;

		//创建服务端文件夹
		createFolderII(SITE_DIR, '/'. $dir . '/');

		//计算总记录数
		//读取flag
		$flag 	= 3;
		
		$pagesize=6;

		//$SqlStr = 'Select count(*) from `'.table_pre.'article` Where `flag`=2 AND `cateid`='.$cateid;
		$SqlStr	= 'SELECT COUNT( * ) , `b`.`title` FROM `'.DB_TABLE_PRE.'article` `a`, `'.DB_TABLE_PRE.'article_cate` `b`';
//		$SqlStr.= ' WHERE `a`.`cateid` ='.$id ;
//		$SqlStr.= ' AND `a`.`cateid` = `b`.`id`';
		$SqlStr.= ' WHERE `a`.`cateid` in (' . $cateid_list . ')' ;
		$SqlStr.= ' AND `a`.`flag` = '. $flag;
		$SqlStr.= ' AND `a`.`notshowlist` = 0 ';
		$SqlStr.= ' GROUP BY `b`.`title`';
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
			$MyArticle->CateId=$cateid_list;
			$cateList=$MyArticle->getArticListDate();

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

			//文章列表
			//-------------------0--------1-------2--------3-------4------5--------6--------7-------8----------9----------10--------11
			$SqlStr	= 'SELECT `title`, `html`, `reurl`, `pic1`, `pic2`, `memo`, `title2`, `id`, `custom1`, `content`, `posttime`, `hits` from '.DB_TABLE_PRE.'article ';
			$SqlStr.= ' WHERE `cateid` in ('.$cateid_list.')';
			$SqlStr.= ' AND `flag` = 3';
			$SqlStr.= ' ORDER BY `id` DESC ';
			$SqlStr.= ' LIMIT '. $pagesize * $ii .' ,'.$pagesize.';';
	
			$j=0;
						
			$MyDatabase1=new Database();
			$MyDatabase1->SqlStr = $SqlStr;
			if ($MyDatabase1->Query ()) {
				$DB_Record_Arr1 = $MyDatabase1->ResultArr;
				foreach ( $DB_Record_Arr1 as $DB_Record_Loop ) {
					$TempStr				= $LoopString;
					$TempTitle			= $DB_Record_Loop[0];
					$TempTitle2			=	$DB_Record_Loop[6];
					$TempHtml				= $DB_Record_Loop[1];
					$TempReUrl			= $DB_Record_Loop[2];
					$TempPic1				= $DB_Record_Loop[3];
					$TempPic2				= $DB_Record_Loop[4];
					$TempMemo				= $DB_Record_Loop[5];
					$TempMemo				= str_replace(Chr(10),"<br />",$TempMemo);
					$TempId					= $DB_Record_Loop[7];
					$Tempcustom1		= $DB_Record_Loop[8];
					$TempContent		= $DB_Record_Loop[9];
					//过滤TempContent的所有HTML
					$TempContent		= strip_tags($TempContent);
					
					
					$TempContent		= subString($TempContent, 800, 1);
					$TempPosttime		= $DB_Record_Loop[10];
					$TempHits				= $DB_Record_Loop[11];
							
					//指定长标题
					$TempStr				= str_replace('{title1}', $TempTitle, $TempStr);
		
					//标题
					if ($TempTitle2!='')	$TempTitle=$TempTitle2;
							
					$TempStr				= str_replace('{title}', $TempTitle, $TempStr);
						
					//链接
					if ($TempReUrl==''){
						$TempStr				= str_replace('{html}', $TempHtml, $TempStr);				
					}else{
						$TempStr				= str_replace('{html}', $TempReUrl, $TempStr);				
					}
		
					//图片
					if ($TempPic2<>''){
						$TempStr				= str_replace('{pic}', $TempPic2, $TempStr);
					}else{
						$TempStr				= str_replace('{pic}', $TempPic1, $TempStr);
					}
							
					//pic1
					$TempStr				= str_replace('{pic1}', $TempPic1, $TempStr);
					//pic2
					$TempStr				= str_replace('{pic2}', $TempPic2, $TempStr);
						
					//memo
					$TempStr				= str_replace('{memo}', $TempMemo, $TempStr);
							
					//编号
					$TempStr				= str_replace('{id}', $TempId, $TempStr);					
		
					//自定义1
					$TempStr				= str_replace('{custom1}', $Tempcustom1, $TempStr);					
							
					//内容
					$TempStr				= str_replace('{content}', $TempContent, $TempStr);		

					//发布时间
					$TempStr				= str_replace('{posttime}', $TempPosttime, $TempStr);		
					
					//点击数
					$TempStr				= str_replace('{hits}', $TempHits, $TempStr);		
					
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
			

			//栏目编号		
			$contents=str_replace("{cateid}", 					$id, 								$contents);

			//栏目标题
			$contents=str_replace("{cateTitle}", 				$cateTitle, 				$contents);
			
			//栏目列表
			$contents=str_replace("{cateList}", 				$cateList, 				$contents);
			
			
			//导航
			$contents=str_replace("{navbar}", 					$navbar, 						$contents);

			//论坛编号
			$contents=str_replace("{forumid}", 					$forumid, 					$contents);

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

			echo '生成文章列表成功:地址为：<a target="_blank" href="'. $html .'">'. $html .'</a><br />';
			$refresh_msg	= '文章分类列表：[<font color=red>生成</font>]成功，跳转到分类列表页面。';
		}
	}else{
		$refresh_msg	= '文章分类存在，请修改文章分类目录，跳转到分类列表页面。';

	}


	$refresh_url	= 'cate.php';

	//管理员日志
	$log_content			= '文章栏目 &gt;&gt; 合并 &gt;&gt; 成功';
}

require($page_name.'.php');
require('../../include/debug.php');
?>