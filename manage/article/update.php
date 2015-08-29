<?php
/**
 * 文章添加、修改、删除提交处理页面
 * 
 * @author Zerolone
 * @version 2009-11-30 21:20:19
 */

require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，返回首页。';
$refresh_txt	= '失败';
//$refresh_url	= Request('refresh_url');
$pagenum			= Request('pagenum',1);			//接受pagenum
$mode					= Request('mode');					//提交方式， add为添加， edit为修改
$id						= Request('id',0);					//文章编号
$title				= Request('title');					//标题一
$title				= stripslashes($title);
$titlecolor		= Request('titlecolor');				//标题一颜色
$title2				= Request('title2');				//标题二
$content			= Request('content');				//文章内容
$cateid				=	Request('cateid',0);			//栏目编号
$memo					=	Request('memo');					//调用文字
$pic1					=	Request('pic1');					//调用图片一、二
$pic2					=	Request('pic2');
$author				=	Request('author');				//作者
$from					=	Request('from');					//来源
$keyword			=	Request('keyword');				//关键字
$order				=	Request('order');					//顺序
$reurl				=	Request('reurl');					//跳转地址
$notshowlist	= Request('notshowlist',0);	//不在列表显示

$changecateid				= Request('changecateid');					//移动到栏目

//日期
$posttime=date("Y-m-d",time());
if(isset($_POST['posttime']))	$posttime		= $_POST['posttime'];

$hits=Request('hits',0);//点击率

//跳转URL
//$refresh_url	= 'article.php?cateid='.$cateid.'&flag='.$flag.'&pagenum='.$pagenum;
$refresh_url	= 'article.php?cateid='.$cateid.'&pagenum='.$pagenum;

//替换$content里面的script
$content = preg_replace( '@\<script(.*?)\</script\>@is', '', $content );

//---------------标题------标题颜色----标题二-----栏目编号-调用文字--调用图片一、二--文章作者--文章来源--跳转地址--提交时间----用户编号--------------设置为状态--顺序------点击率--不显示在列表---内容
$ArrField=array('title',	'titlecolor',	'title2',	'cateid',	'memo',		'pic1',	'pic2',	'author',	'from',		'reurl',	'posttime',	'userid',							'flag',			'order',	'hits',	'notshowlist',	'content');
$ArrValue=array($title,		$titlecolor,	$title2,	$cateid,	$memo,		$pic1,	$pic2,	$author,	$from,		$reurl,		$posttime,	$_SESSION['userid'],	EDTFLAG,		$order,		$hits,	$notshowlist,		$content);

if($mode=='add'){
	if ($MyDatabase->Insert('article',$ArrField,$ArrValue))	$refresh_txt = '成功';	
	$refresh_msg	= '文章：[<font color=red>'.$title.'</font>]，添加'.$refresh_txt.'，点击继续添加一篇文章。';
	$log_content	= '文章 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】'.$refresh_txt;		
	
	$id=$MyDatabase->Insert_id();
	
	$refresh_url	= 'add.php?id='.$id;
}elseif ($mode=='edit'){
	if ($MyDatabase->Update('article',$ArrField,$ArrValue,'`id`='.$id))	$refresh_txt = '成功';	
	$refresh_msg	= '文章：[<font color=red>'.$title.'</font>]，修改'.$refresh_txt.'，跳转到列表页面。';
	$log_content	= '文章 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】'.$refresh_txt;	
	
}
//删除
elseif (isset($_POST['s_list_del'])){
	for($i = 0;$i<sizeof( $_POST["selectid"] );$i++)
	{
		$delid=$_POST["selectid"][$i];
		$SqlStr = 'DELETE FROM `'. DB_TABLE_PRE .'article` WHERE `id`='. $delid;
		
		if ($MyDatabase->Delete('article', '`id`='. $delid)){
			//管理员日志
			$log_content			= '文章 &gt;&gt; 删除 &gt;&gt; 成功';
			
			$refresh_msg	= '删除文章[<font color=red>成功</font>]，返回文章显示页面。';
		}else{
			//管理员日志
			$log_content			= '文章 &gt;&gt; 删除 &gt;&gt; 失败';
			
			$refresh_msg	= '删除文章[<font color=black>失败</font>]，返回文章显示页面。';
		}
	}
}
//HTML生成
elseif ( isset($_POST['s_html']) ){
//	set_time_limit(999);
	for($k = 0;$k<sizeof( $_POST["selectid"] );$k++){
		$upid	= $_POST["selectid"][$k];
		//--------------------0--------1----------2--------3--------4-------5------6--------7----------8---------9---------10
		$SqlStr	= ' SELECT `title`, `title2`, `content`, `html`, `thtml`, `js`, `from`, `posttime`, `author`, `cateid`, `forumid`, '; 
		//-------------11--------12------13------14---------15
		$SqlStr.= ' `isvideo`, `pic1`, `pic2`, `memo`, `specialid` ';
		$SqlStr.= ' FROM `'.DB_TABLE_PRE.'view_article`';
		$SqlStr.= ' WHERE `id`='.$upid;
		$SqlStr.= ' LIMIT 1';
			
		$MyDatabase->SqlStr = $SqlStr;
		if ($MyDatabase->Query ()) {
			$DB_Record = $MyDatabase->ResultArr [0];
			$title					= addslashes($DB_Record[0]);
			$title2					= $DB_Record[1];
			$content				= $DB_Record[2];
			$html						= $DB_Record[3];
			$template_html	= $DB_Record[4];
			$template_js		= $DB_Record[5];
			$from						= $DB_Record[6];
			$posttime				= $DB_Record[7];
			$author					= $DB_Record[8];
			$cateid					= $DB_Record[9];
			$forumid				= $DB_Record[10];
			$isvideo				= $DB_Record[11];
			
			$pic1						= $DB_Record[12];
			$pic2						= $DB_Record[13];
			$memo						= $DB_Record[14];
			$specialid			= $DB_Record[15];
			
			if ($pic1==''){
				$pic1='/images/dot.gif';
			}
			
			if ($pic2==''){
				$pic2='/images/dot.gif';
			}

			if ($isvideo){
				$title='<img src=\"/images/dot_video.gif\" border=\"0\">'.$title;
			}
	
			$navbar					= '';
			
			//替换content里面的<script>
			$content=str_replace('</SCRIPT>', 					'<\/SCRIPT>', 						$content);
			
			//---------
			//生成一个HTML文件名
			if ($html==''){
				$html =UpdateHTML($upid, $posttime);
			}
			//---------
			
			//获取cateid对应Level
			//--------------------0
			$SqlStr	= ' SELECT `level` '; 
			$SqlStr.= ' FROM `'.DB_TABLE_PRE.'article_cate` ';
			$SqlStr.= ' WHERE `id`='.$cateid;
			$SqlStr.= ' LIMIT 1';
			
			$MyDatabase1=new Database();
			$MyDatabase1->SqlStr = $SqlStr;
			if ($MyDatabase1->Query ()) {
				$level = $MyDatabase1->ResultArr [0][0];
			}
			
			$level_len= strlen($level) / 2 ;
			//level列表
			$level_str='0';
			for ($i=1;$i<=$level_len;$i++){
				$level_str.= ','.substr($level,0, 2*$i);
			}
			
			/*/
			echo '<hr>';
			echo $level_str;
			echo '<hr>';
			//*/
			//-------------------0-----1--------2
			$SqlStr	= ' SELECT `id`, `title`, `dir` '; 
			$SqlStr.= ' FROM `'.DB_TABLE_PRE.'article_cate` ';
			$SqlStr.= ' WHERE `level` in ('.$level_str.')';
			$SqlStr.= ' ORDER BY `level` ASC';
			
			$navbar = '';

			$MyDatabase1->SqlStr = $SqlStr;
			if ($MyDatabase1->Query ()) {
				$DB_Record_Arr = $MyDatabase1->ResultArr;
				foreach ( $DB_Record_Arr as $DB_Record1 ) {			
					$navbar.=' <a href=\"/'.$DB_Record1[2].'\">'. $DB_Record1[1] .'</a> &gt';
				}
			}
			
			$navbar					= '<a href=\"'. SITE_URL .'\">首页</a> &gt; '.$navbar;

			//文章排行
			$articleRightRank 	= addslashes(getArticleRightRank($cateid));
			
			//精彩视频带图片
			$articleRightVsPic	= addslashes(getArticlePicList('11,88,12,91,92,18,85', 3, 10, 'hits', 'DESC', 80, 50, 0, 0, 3, 1, 0, 0, 1));
			
			//精彩视频不带图片
			$articleRightVsTxt	= addslashes(getArticleList('11,88,12,91,92,18,85', 6, 20, 'hits', 'DESC', 0, 3, 1, 2, 0, 1));
			
			//重点阅读1
			$recommendTxtHot1		= addslashes(getArticleList(0, 1, 36, 'order', 'ASC', 1, 3, 0, 0, 0, 0, 0, 0, 0, 1));
			
			//重点阅读2
			$recommendTxtHot2		= addslashes(getArticleList(0, 2, 25, 'order', 'ASC', 1, 3, 0, 1, 0, 0, 0, 1, 0, 1));
			
			//重点阅读图片
			$recommendPic			 	=	addslashes(getArticlePicList(0, 3, 20, 'order', 'ASC', 80, 60, 0, 1, 3, 1, 0));
			
			//重点阅读列表
//			$recommendTxtList		= addslashes(getArticleList($cateid, 11, 40, 'order', 'ASC', 1, 3, 1, 5, 0, 0,1 ));
			$recommendTxtList		= addslashes(getArticleList(0, 11, 40, 'order', 'ASC', 1, 3, 1, 5, 0, 0, 1, 0, 0, 1 ));
			
			//最受关注
			$articleTopList			= addslashes(getArticleList(0, 2, 36, 'order', 'ASC', 2, 3, 1, 0, 1, 0, 0, 0, 0, 1 )); 
			
			//2009-8-14 20:40:31
			$MyArticle=new Article();
			$MyArticle->CateId=$cateid;
			$MyArticle->Count=100;
			$MyArticle->TitleCount=100;
			$MyArticle->OrderBy='Order';
			$MyArticle->OrderSort='ASC';
			$MyArticle->LiClass='seli';
			$MyArticle->LiClassId=$upid;
			
			//当前栏目文章列表、标题
			$articleList=$MyArticle->getArticleList();
			$articleTitle=$MyArticle->getCateTitle();
			
						
			$MyArticle->CateId=TOPURL;
			$MyArticle->LiClass='';
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
			
//			echo $MySpecial->SqlStr;			
				
			/**
			echo '<hr>';
			echo $articleList;
			echo '<hr>';
			/**/
			//获取分类标题
			
			//替换换行
			//windows
			$content=str_replace("\r\n", "", $content);
			//linux
			$content=str_replace("\n", "", $content);

			//生成一个
			//ob_flush();

			//分页
			$content_arr=explode("[---分页---]", $content);
			$len_content_arr=count($content_arr);
			
			//生成目录
			//$html_dir=$site_dir. $html;
			/*/
			echo '<hr>';
			echo $html_dir;
			echo '<hr>';
			//*/			
//			$html_dir=str_replace('//', '/', $html_dir);
			/*/
			echo '<hr>';
			echo $html_dir;
			echo '<hr>';
			//*/			
//			$html_dir=str_replace($ArticlePath, '', $html_dir);
			/*/
			echo '<hr>';
			echo $html;
			echo '<hr>';
			//*/			
			
			createFolderIII(SITE_DIR, $html);
			
			//没有分页的话
			if ($len_content_arr==1){
					$contents=file_get_contents(SITE_DIR.$template_html);
					$contents=str_replace("{title}", 				$title, 					$contents);
					$contents=str_replace("{title2}", 			$title2, 					$contents);
					$contents=str_replace("{template_js}", 	$template_js,			$contents);
					$contents=str_replace("{content}", 			$content, 				$contents);
					$contents=str_replace("{splitpage}", 		"", 							$contents);
					$contents=str_replace("{id}", 					$upid, 						$contents);				
					
					//来源
					$contents=str_replace("{from}", 				$from, 						$contents);
					
					//发布时间
					$contents=str_replace("{posttime}", 		$posttime, 				$contents);
					
					//作者
					$contents=str_replace("{author}", 			$author, 					$contents);
					
					//导航
					$contents=str_replace("{navbar}", 			$navbar, 					$contents);
						
					//文章分类编号
					$contents=str_replace("{cateid}", 			$cateid, 					$contents);

					//文章列表
					$contents=str_replace("{articleList}", 	$articleList, 		$contents);
										
					//图片1
					$contents=str_replace("{pic1}", 								$pic1, 								$contents);

					//图片2
					$contents=str_replace("{pic2}", 								$pic2, 								$contents);
					
					//memo
					$contents=str_replace("{memo}", 								$memo, 								$contents);
					
					//Flv视频&amp;替换为&
					$contents=str_replace("&amp;repeat=list", 			"&repeat=list",				$contents);
					
					
					//文章SEO
					$article_seo		= $title.$title2.$content.$navbar;	
					$article_seo		= str_replace('\"', 										'"', 									$article_seo);
					$article_seo		=	str_replace("ThePlayer", 							"ThePlayer1", 				$article_seo);
					$article_seo		=	str_replace("playbtn", 								"playbtn1", 					$article_seo);
					
					
					///
					//栏目标题
					$contents=str_replace("{articleTitle}", 			$articleTitle, 					$contents);
					
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
					
					
					$contents				=	str_replace("{article_seo}", 					$article_seo, 				$contents);
					
					$handle = fopen ( SITE_DIR . $html, "w" );
					fwrite( $handle, $contents );
					fclose($handle);				

					echo '地址为：<a target="_blank" href="'. $html .'">'. $html .'</a>['. $title . '],生成成功<br />';
			}else{
				for ($ii=0; $ii<$len_content_arr; $ii++){
					//获取模板地址
					$contents=file_get_contents(SITE_DIR.$template_html);
					$contents=str_replace("{title}", 				$title, 								$contents);
					$contents=str_replace("{title2}", 			$title2, 								$contents);
					$contents=str_replace("{template_js}", 	$template_js, 					$contents);
					$contents=str_replace("{content}", 			$content_arr[$ii], 			$contents);
					$contents=str_replace("{id}", 					$upid, 									$contents);

					//来源
					$contents=str_replace("{from}", 				$from, 							$contents);
					
					//发布时间
					$contents=str_replace("{posttime}", 		$posttime, 					$contents);
										
					//作者
					$contents=str_replace("{author}", 			$author, 					$contents);

					//导航
					$contents=str_replace("{navbar}", 			$navbar, 					$contents);
					
					//文章分类编号
					$contents=str_replace("{cateid}", 			$cateid, 					$contents);
										
					//文章排行
					$contents=str_replace("{articleRightRank}", 		$articleRightRank, 		$contents);
					
					//精彩视频带图片
					$contents=str_replace("{articleRightVsPic}", 		$articleRightVsPic, 	$contents);
					
					//精彩视频不带图片
					$contents=str_replace("{articleRightVsTxt}", 		$articleRightVsTxt, 	$contents);
					
					//重点阅读1
					$contents=str_replace("{recommendTxtHot1}", 		$recommendTxtHot1, 		$contents);

					//重点阅读2
					$contents=str_replace("{recommendTxtHot2}", 		$recommendTxtHot2, 		$contents);
										
					//重点阅读图片
					$contents=str_replace("{recommendPic}", 				$recommendPic, 				$contents);

					//重点阅读列表
					$contents=str_replace("{recommendTxtList}", 		$recommendTxtList, 		$contents);

					//重点阅读列表
					$contents=str_replace("{articleTopList}", 			$articleTopList, 		$contents);
														
					//论坛编号
					$contents=str_replace("{forumid}", 							$forumid, 					$contents);
					
					//分页 splitpage
					//$splitpage='';

					$html_name='';
					
					if ($ii == 0) {
						$splitpage = '<a href="#" class="select">1</a> ';
					} else {
						$splitpage = '<a href="' . $html . '">1</a> ';
					}
					
					for($j = 1; $j < $len_content_arr; $j ++) {
						if ($ii == $j) {
							$splitpage .= '<a href="#" class="select">' . ($j + 1) . '</a> ';
						} else {
							$html_name = str_replace ( '.html', '_' . ($j + 1) . '.html', $html );
							$splitpage .= '<a href="' . $html_name . '">' . ($j + 1) . '</a> ';
						}
					}
					$contents=str_replace("{splitpage}", 			addslashes($splitpage), 			$contents);
					
					//文章SEO
					$article_seo		= $title.$title2.$content.$splitpage.$navbar;
					$article_seo		= str_replace('\"', '"', $article_seo);
					$article_seo		=	str_replace("ThePlayer", 							"ThePlayer1", 				$article_seo);		
					$article_seo		=	str_replace("playbtn", 								"playbtn1", 					$article_seo);
					
					$contents				=	str_replace("{article_seo}", 					$article_seo, 				$contents);
					
					if ($ii > 0) {
						//						$html_name=$html.'.'.($ii+1).'.html';						
						$html_name = str_replace ( '.html', '_' . ($ii + 1) . '.html', $html );
						$handle = fopen ( SITE_DIR . $html_name, "w" );
						echo '地址为：<a target="_blank" href="' . $html_name . '">' . $html_name . '</a>[' . $title . '],生成成功<br />';
					} else {
						$handle = fopen ( SITE_DIR . $html, "w" );
						echo '地址为：<a target="_blank" href="' . $html . '">' . $html . '</a>[' . $title . '],生成成功<br />';
					}
					fwrite( $handle, $contents );
					fclose($handle);
				}
			}
		}

		flush();

		//更新标记		
		$MyDatabase->Update('article', array('flag'), array(HTMLFLAG), '`id`='.$upid);
	}
//	$refresh_url	= 'article.php?cateid='.$cateid.'&flag='.$flag.'&pagenum='.$pagenum;
	$refresh_msg	= '生成文章[<font color=red>成功</font>]，返回文章显示页面。';

	//管理员日志
	$log_content			= '文章 &gt;&gt; HTML生成 &gt;&gt; 成功';
}
//发布
elseif ( isset($_POST['s_issue']) ){
	for($i = 0;$i<sizeof( $_POST["selectid"] );$i++){
		$issueid=$_POST["selectid"][$i];
		$MyDatabase->Update('article', array('flag'), array('1'), '`id`='.$issueid);
			}
	$refresh_msg	= '发布文章[<font color=red>成功</font>]，返回文章显示页面。';

	//管理员日志
	$log_content			= '文章 &gt;&gt; 发布 &gt;&gt; 成功';
}
//不发布
elseif ( isset($_POST['s_unissue']) ){
	for($i = 0;$i<sizeof( $_POST["selectid"] );$i++){
		$issueid=$_POST["selectid"][$i];
		$MyDatabase->Update('article', array('flag'), array('0'), '`id`='.$issueid);
	}
	$refresh_msg	= '取消发布文章[<font color=red>成功</font>]，返回文章显示页面。';

	//管理员日志
	$log_content			= '文章 &gt;&gt; 取消发布 &gt;&gt; 成功';
}
//顺序
elseif (isset($_POST['s_list_order'])){
	for($i = 0;$i<sizeof( $_POST["order"] );$i++){
		if($MyDatabase->Update('article',array('order'),array($_POST["order"][$i]),'`id`='. $_POST["id"][$i])){
			$refresh_msg	= '文章顺序修改[<font color=red>成功</font>]，返回显示页面。';
	
			//管理员日志
			$log_content			= '文章顺序修改 &gt;&gt; 成功';			
		}else{
			$refresh_msg	= '文章顺序修改[<font color=red>失败</font>]，返回显示页面。';
	
			//管理员日志
			$log_content			= '文章顺序修改 &gt;&gt; 失败';			
		}
	}
	
//	$area=$_POST['area'];
//	$refresh_url	= 'special.php?pagenum='.$pagenum.'&area='.$area;
}
//移动分类
elseif ( isset($_POST['s_move']) )
{
	for($i = 0;$i<sizeof( $_POST["selectid"] );$i++){
		$moveid=$_POST["selectid"][$i];
		
		if($MyDatabase->Update('article',array('cateid'),array($changecateid),'`id`='.$moveid)){			
			$refresh_msg	= '修改文章分类[<font color=red>成功</font>]，返回文章显示页面。';
		
			//管理员日志
			$log_content			= '修改文章分类 &gt;&gt; 成功';
		}else {
			$refresh_msg	= '修改文章分类[<font color=red>失败</font>]，返回文章显示页面。';
		
			//管理员日志
			$log_content			= '修改文章分类 &gt;&gt; 失败';	
		}
	}
}
//删除特殊位置显示
elseif ( isset($_POST['s_list_area']) )
{
	$area=$_POST['area'];
	$refresh_url	= 'special.php?pagenum='.$pagenum.'&area='.$area;
		
	for($i = 0;$i<sizeof( $_POST["selectid"] );$i++)
	{
		$issueid=$_POST["selectid"][$i];
		$SqlStr = 'UPDATE `'. DB_TABLE_PRE .'article` SET `area'.$area.'`=0 WHERE `id`='. $issueid;
		query($SqlStr);
	}
	$refresh_msg	= '删除文章特殊位置[<font color=red>成功</font>]，返回文章显示页面。';

	//管理员日志
	$log_content			= '文章特殊位置 &gt;&gt; 删除 &gt;&gt; 成功';
}
//视频
elseif ( isset($_POST['s_video']) )
{
	for($i = 0;$i<sizeof( $_POST["selectid"] );$i++)
	{
		$issueid=$_POST["selectid"][$i];
		$SqlStr = 'UPDATE `'. DB_TABLE_PRE .'article` SET `isvideo` = 1 WHERE `id`='. $issueid;
		query($SqlStr);
	}
	$refresh_msg	= '修改文章类型为视频[<font color=red>成功</font>]，返回文章显示页面。';

	//管理员日志
	$log_content			= '文章类型为视频 &gt;&gt; 修改 &gt;&gt; 成功';
}
//非视频
elseif ( isset($_POST['s_video_not']) ){
	for($i = 0;$i<sizeof( $_POST["selectid"] );$i++){
		$issueid=$_POST["selectid"][$i];
		$SqlStr = 'UPDATE `'. DB_TABLE_PRE .'article` SET `isvideo` = 0 WHERE `id`='. $issueid;
		query($SqlStr);
	}
	$refresh_msg	= '取消文章类型为视频[<font color=red>成功</font>]，返回文章显示页面。';

	//管理员日志
	$log_content			= '文章类型为视频 &gt;&gt; 取消 &gt;&gt; 成功';
}

require($page_name.'.php');

//管理员日志
require('../../include/log.php');

require('../../include/debug.php');
?>