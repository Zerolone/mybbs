<?php
/**
 * 专题 添加、修改、删除、生成
 * 
 * @author 		Zerolone
 * @version 		2009-9-11 12:56:42
 */
require('../include/common.php');

$page_name	= '../../include/refresh.php';

$refresh_msg	= '[<font color=blue>不成功</font>]，请返回重试。';

$mode					=	Request('mode');					//提交方式， add为添加， edit为修改
$id						= Request('id');						//编号
$title				= Request('title');					//标题
$templateid		= Request('templateid',1);	//模板id
$pagenum			=	Request('pagenum',1);   	//接受pagenum
$order				= Request('order');					//顺序
$html					= Request('html');					//html
$pic					= Request('pic');						//图片
$memo					= Request('memo');					//说明
$url1					= Request('url1');					//url1
$url2					= Request('url2');					//url2
$url3					= Request('url3');					//url3
$url4					= Request('url4');					//url4
$url5					= Request('url5');					//url5

//设置刷新时间
//$refresh_time = 300;

//跳转链接
$refresh_url  = 'special.php?pagenum='.$pagenum;

//--------------标题----html---图片---模板---------顺序----说明---url1---url2
$ArrField=array('title','html','pic','templateid','order','memo','url1','url2','url3','url4','url5');
$ArrValue=array($title,	$html, $pic, $templateid, $order, $memo, $url1, $url2, $url3, $url4, $url5);

if($mode=='add'){
	if ($MyDatabase->Insert('special',$ArrField,$ArrValue)){
		
		$refresh_msg	= '专题：[<font color=red>'.$title.'</font>]，添加成功，点击关闭。';
	
		//管理员日志
		$log_content			= '专题 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】成功';		
	}else {
		$refresh_msg	= '专题：[<font color=red>'.$title.'</font>]，添加失败，点击关闭。';
	
		//管理员日志
		$log_content			= '专题 &gt;&gt; 添加 &gt;&gt; 【'. $title .'】失败';		
	}

	$page_name	= '../../include/refreshno.php';
}elseif ($mode=='edit'){
	if ($MyDatabase->Update('special',$ArrField,$ArrValue, '`id`='.$id)){
		$refresh_msg	= '专题：[<font color=red>'.$title.'</font>]，修改成功，跳转列表页面。';
	
		//管理员日志
		$log_content			= '专题 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】成功';
	}else {
		$refresh_msg	= '专题：[<font color=red>'.$title.'</font>]，修改失败，跳转列表页面。';
	
		//管理员日志
		$log_content			= '专题 &gt;&gt; 修改 &gt;&gt; 【'. $title .'】失败';
	}

	$refresh_url	= 'special.php';
}elseif( isset($_POST['s_list_del']) ){
	for($i = 0;$i<sizeof( $_POST["del"] );$i++){
		if($MyDatabase->Delete('special_module',`parentid=`.$_POST["del"][$i])){			
			if($MyDatabase->Delete('special',`id=`.$_POST["del"][$i])){				
				$refresh_msg	= '删除专题[<font color=red>成功</font>]，返回专题显示页面。';
				//管理员日志
				$log_content			= '专题 &gt;&gt; 删除 &gt;&gt; 成功';
			}
		}
	}
	$refresh_url	= 'special.php';
}elseif( isset($_POST['s_list_order']) ){
	//修改顺序
	for($i = 0;$i<sizeof( $_POST["order"] );$i++){
		if ($MyDatabase->Update('special',array('order'),array($_POST["order"][$i]), '`id`='.$_POST["id"][$i])){			
			$refresh_msg	= '修改专题列表顺序[<font color=red>成功</font>]，返回专题列表显示页面。';
			$log_content			= '专题列表 &gt;&gt; 修改顺序 &gt;&gt; 成功';
		}else{
			$refresh_msg	= '修改专题列表顺序[<font color=red>失败</font>]，返回专题列表显示页面。';	
			$log_content			= '专题列表 &gt;&gt; 修改顺序 &gt;&gt; 失败';
		}
	}
	$refresh_url	= 'special.php?pagenum='.$pagenum;
}elseif ($mode=="html"){
	//专题生成
	//-------------------0-------1--------2-------3-----4-----5------6------7-------8--------9-----10
	$SqlStr	= 'SELECT `title`, `html`, `thtml`, `js`, `pic`,`memo`,`url1`,`url2`, `url3`, `url4`,`url5` ';
	$SqlStr.= ' FROM `'.DB_TABLE_PRE.'view_special`';
	$SqlStr.= ' WHERE `id`='.$id;
	$SqlStr.= ' LIMIT 1';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record = $MyDatabase->ResultArr [0];
		$special_title	= $DB_Record[0];
		$html						= $DB_Record[1];
		$template_html	= $DB_Record[2];
		$template_js		= $DB_Record[3];
		$special_pic		= $DB_Record[4];
		$special_memo		= $DB_Record[5];
		$special_url1		= $DB_Record[6];
		$special_url2		= $DB_Record[7];
		$special_url3		= $DB_Record[8];
		$special_url4		= $DB_Record[9];
		$special_url5		= $DB_Record[10];
	}

	//专题内容
	$contents					= file_get_contents(SITE_DIR.$template_html);
	$contents					= str_replace("{special_title}", 	$special_title, 	$contents);
	$contents					= str_replace("{special_pic}", 		$special_pic, 		$contents);
	$contents					= str_replace("{special_memo}", 	$special_memo, 		$contents);
	$contents					= str_replace("{template_js}", 		$template_js, 		$contents);
	$contents					= str_replace("{special_url1}", 	$special_url1, 		$contents);
	$contents					= str_replace("{special_url2}", 	$special_url2, 		$contents);
	$contents					= str_replace("{special_url3}", 	$special_url3, 		$contents);
	$contents					= str_replace("{special_url4}", 	$special_url4, 		$contents);
	$contents					= str_replace("{special_url5}", 	$special_url5, 		$contents);
	$contents					= str_replace("{special_html}", 	SITE_URL.SPECIALURL.$html, 		$contents);
	
	//各个超链接
	$MyArticle=new Article();
	$MyArticle->Flag = 1;
	$MyArticle->Count=100;
	$MyArticle->TitleCount=100;
	
	//顶部链接
	$MyArticle->CateId = TOPURL;
	$topurl = $MyArticle->getArticleList ();
	
	$MyArticle->CateId = FOOT01;
	
	//底部链接01
	$foot01 = $MyArticle->getArticleList ();
	$foot01_title = $MyArticle->getCateTitle ();
	
	$MyArticle->CateId = FOOT02;
	//底部链接02
	$foot02 = $MyArticle->getArticleList ();
	$foot02_title = $MyArticle->getCateTitle ();
	
	$MyArticle->CateId = FOOT03;
	//底部链接03
	$foot03 = $MyArticle->getArticleList ();
	$foot03_title = $MyArticle->getCateTitle ();
	
	$MyArticle->CateId = FOOT04;
	//底部链接04
	$foot04 = $MyArticle->getArticleList ();
	$foot04_title = $MyArticle->getCateTitle ();
	
	//顶部链接
	$contents=str_replace("{topurl}", 			$topurl, 					$contents);
					
	//底部连接01-04
	$contents=str_replace("{foot01}", 			$foot01, 					$contents);
	$contents=str_replace("{foot01_title}", $foot01_title,		$contents);
	$contents=str_replace("{foot02}", 			$foot02, 					$contents);
	$contents=str_replace("{foot02_title}", $foot02_title,		$contents);
	$contents=str_replace("{foot03}", 			$foot03, 					$contents);
	$contents=str_replace("{foot03_title}", $foot03_title,		$contents);
	$contents=str_replace("{foot04}", 			$foot04, 					$contents);
	$contents=str_replace("{foot04_title}", $foot04_title,		$contents);	
	
	//模块列表
	//--------------------0--------1----------2---------3
	$SqlStr	= ' SELECT `title`, `order`, `parentid`, `kind`,  ';
	//----------------4--------------5---------------6------------7
	$SqlStr.= ' `kind1_count`, `kind1_cateid`, `kind1_txt`, `kind1_perline`, ';	
	//----------------8
	$SqlStr.= ' `kind2_url`, ';
	//----------------9
	$SqlStr.= ' `kind3_id`, ';
	//------------10----11
	$SqlStr.= ' `pic`, `url`, ';
	//----------------12
	$SqlStr.= ' `kind4_id`, ';
	//----------------13
	$SqlStr.= ' `kind5_id`, ';
	//----------------14----------------15
	$SqlStr.= ' `kind1_orderby`, `kind1_ordersort`, ';	
	//----------------16
	$SqlStr.= ' `kind6_id` ';	
	
	$SqlStr.= ' FROM `' .DB_TABLE_PRE. 'special_module` ';
	$SqlStr.= ' WHERE `parentid`='.$id;
	$SqlStr.= ' ORDER BY `order` ASC';
	
	//模块从1开始循环
	$i=1;

	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $DB_Record ) {
			$title					= $DB_Record[0];
			$kind						= $DB_Record[3];
	
	//		echo "<hr>$DB_Record[1]<hr>";
			
			$kind1_count		= $DB_Record[4];
			$kind1_cateid		= $DB_Record[5];
			$kind1_txt			= $DB_Record[6];
			$kind1_perline	= $DB_Record[7];
			$kind1_orderby	= $DB_Record[14];
			$kind1_ordersort= $DB_Record[15];
			
			$kind2_url			= $DB_Record[8];
			
			$kind3_id				= $DB_Record[9];
			
			$pic						= $DB_Record[10];
			$url						= $DB_Record[11];
			
			$kind4_id				= $DB_Record[12];
			
			$kind5_id				= $DB_Record[13];
			
			$kind6_id				= $DB_Record[16];
			
			//初始化各个变量
			$count			= 0;
			$cateid			= '0';
			$txt				= 0;
			$textalign	= '';
			$width			= 0;
			$height			= 0;
						
			//循环
			$str_loop_begin		= '{module'.$i.'_loop_begin}';
			$str_loop_end			= '{module'.$i.'_loop_end}';
			$str_module_pic		= '{module'.$i.'_pic}';
			$str_module_title	= '{module'.$i.'_title}';
			$str_module_url		= '{module'.$i.'_url}';
			$LoopString				= CutStr($contents, $str_loop_begin, $str_loop_end);
			$LoopContent='';	
			
			/*/
			$refresh_time = 300;
			if($refresh_time==300){
			echo "<hr>i=".$i;
			echo "<hr>";
			echo $LoopString;
			echo "<hr>";
			}
			//*/
			
			//静态处理
			switch ( $kind ){
				case 'kind1':
					$count			= $kind1_count;
					$cateid			= $kind1_cateid;
					$txt				= $kind1_txt;				
					
					//初始化
					if($kind1_orderby==""){
						$kind1_orderby = 'id';
					}
					if($kind1_ordersort==""){
						$kind1_ordersort = 'DESC';
					}
	
					//文章列表
					//-------------------0--------1-------2--------3-------4------5--------6--------7-------8----------9----------10-------11
					$SqlStr	= 'SELECT `title`, `html`, `reurl`, `pic1`, `pic2`, `memo`, `title2`, `id`, `custom1`, `content`, `posttime`, `hits` from '.DB_TABLE_PRE.'article ';
					$SqlStr.= ' WHERE `cateid` in ('.$cateid.')';
					$SqlStr.= ' AND `flag` = 3';
					$SqlStr.= ' ORDER BY `'.$kind1_orderby.'` ' . $kind1_ordersort;
	//				$SqlStr.= ' ORDER BY `id` DESC';
					$SqlStr.= ' LIMIT '. $count.';';
	
					/*/
					$refresh_time = 300;
					echo "<hr>";
					echo $SqlStr;
					echo "<hr>";
					//*/
	
					$j=0;
						
					$MyDatabase1=new Database();
					$MyDatabase1->SqlStr = $SqlStr;
					if ($MyDatabase1->Query ()) {
						$DB_Record_Arr1 = $MyDatabase1->ResultArr;
						foreach ( $DB_Record_Arr1 as $DB_Record_Loop ) {
							$TempStr				= $LoopString;
							$TempTitle			= subString($DB_Record_Loop[0],$txt);
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
							$TempContent		= subString($TempContent, 180);
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
							
							$j++;
							if($kind1_perline>1){
								if ($j % 2){
									$LoopContent.='</tr><tr>';
								}
							}
							
							$LoopContent.=$TempStr;
						}
					}
	
	//				echo $LoopContent;
	//				$contents=str_replace($str_loop_begin.$LoopString.$str_loop_end, $LoopContent, $contents);
					break;
					
				case 'kind2':
					//调用视频
					$url				= $kind2_url;
					
					$LoopContent='';
					
					$TempStr				= $LoopString;
						
					$TempStr				= str_replace('{url}', $url, $TempStr);
						
					$LoopContent.=$TempStr;
					
	//				echo $LoopContent;
	//				$contents=str_replace($str_loop_begin.$LoopString.$str_loop_end, $LoopContent, $contents);				
					break;
				case 'kind3':
					$TempStr=$LoopString;
					
					//单调文章
					//--------------------0---------1-------2--------3
					$SqlStr	= 'SELECT `content`, `memo`, `html`, `reurl` from '.DB_TABLE_PRE.'article ';
					$SqlStr.= ' WHERE `id`= '.$kind3_id;
					$SqlStr.= ' LIMIT 1;';
					
					$MyDatabase1=new Database();
					$MyDatabase1->SqlStr = $SqlStr;
					if ($MyDatabase1->Query ()) {
						$DB_Record_Loop = $MyDatabase->ResultArr [0];
						$TempStr			= str_replace('{content}', $DB_Record_Loop[0], $TempStr);				
						$TempStr			= str_replace('{memo}'	 , $DB_Record_Loop[1], $TempStr);				
	
						$TempHtml			= $DB_Record_Loop[2];
						$TempReUrl		= $DB_Record_Loop[3];
	
						//链接
						if ($TempReUrl==''){
							$TempStr				= str_replace('{html}', $TempHtml, $TempStr);				
						}else{
							$TempStr				= str_replace('{html}', $TempReUrl, $TempStr);				
						}
					}
					$LoopContent		= $TempStr;
	//				echo $LoopContent;
	//				$contents=str_replace($str_loop_begin.$LoopString.$str_loop_end, $LoopContent, $contents);
					
					break;
				case 'kind4':
					$TempStr				= $LoopString;
					
					//调用投票
					//------------------0------1----------2----------3----------4----------5----------6----------7---------8----------9
					$SqlStr	= ' SELECT `id`, `title`, `answer1`, `answer2`, `answer3`, `answer4`, `answer5`, `answer6`, `answer7`, `answer8`, ';
					//-------------10--------11--------12---------13-------14--------15--------16--------17----------18
					$SqlStr.= ' `count1`, `count2`, `count3`, `count4`, `count5`, `count6`, `count7`, `count8`, `checkmode` ';
					$SqlStr.= ' FROM `'.table_pre.'vote` ';
					$SqlStr.= ' WHERE `active`=1 ';
					$SqlStr.= ' AND `id`= '.$kind4_id;
					$SqlStr.= ' ORDER BY `id` DESC';
					$SqlStr.= ' LIMIT 1;';

					$MyDatabase1=new Database();
					$MyDatabase1->SqlStr = $SqlStr;
					if ($MyDatabase1->Query ()) {
						$DB_Record1 = $MyDatabase->ResultArr [0];
					
						$TempTitle		= $DB_Record1[1];
						
						$answer1	= $DB_Record1[2];
						$answer2	= $DB_Record1[3];
						$answer3	= $DB_Record1[4];
						$answer4	= $DB_Record1[5];
						$answer5	= $DB_Record1[6];
						$answer6	= $DB_Record1[7];
						$answer7	= $DB_Record1[8];
						$answer8	= $DB_Record1[9];
						
						$count1		= $DB_Record1[10];
						$count2		= $DB_Record1[11];
						$count3		= $DB_Record1[12];
						$count4		= $DB_Record1[13];
						$count5		= $DB_Record1[14];
						$count6		= $DB_Record1[15];
						$count7		= $DB_Record1[16];
						$count8		= $DB_Record1[17];
						
						$checkmode	= $DB_Record1[18];
						
						$input_type = 'radio'; 
						if ($checkmode==0){
							$input_type = 'checkbox'; 
						}
					
						$vote_string = '';
						$vote_name	 = 'vote'. $kind4_id;
							
						if ($answer1) $vote_string.='<input type="'.$input_type.'" name="vote[]" id="'.$vote_name.'_1" value="count1" /><label for="'.$vote_name.'_1">'.$answer1."</label> ";
						if ($answer2) $vote_string.='<input type="'.$input_type.'" name="vote[]" id="'.$vote_name.'_2" value="count2" /><label for="'.$vote_name.'_2">'.$answer2."</label> ";
						if ($answer3) $vote_string.='<input type="'.$input_type.'" name="vote[]" id="'.$vote_name.'_3" value="count3" /><label for="'.$vote_name.'_3">'.$answer3."</label> ";
						if ($answer4) $vote_string.='<input type="'.$input_type.'" name="vote[]" id="'.$vote_name.'_4" value="count4" /><label for="'.$vote_name.'_4">'.$answer4."</label> ";
						if ($answer5) $vote_string.='<input type="'.$input_type.'" name="vote[]" id="'.$vote_name.'_5" value="count5" /><label for="'.$vote_name.'_5">'.$answer5."</label> ";
						if ($answer6) $vote_string.='<input type="'.$input_type.'" name="vote[]" id="'.$vote_name.'_6" value="count6" /><label for="'.$vote_name.'_6">'.$answer6."</label> ";
						if ($answer7) $vote_string.='<input type="'.$input_type.'" name="vote[]" id="'.$vote_name.'_7" value="count7" /><label for="'.$vote_name.'_7">'.$answer7."</label> ";
						if ($answer8) $vote_string.='<input type="'.$input_type.'" name="vote[]" id="'.$vote_name.'_8" value="count8" /><label for="'.$vote_name.'_8">'.$answer8."</label> ";
					}
					
					$TempStr				= str_replace('{title}', 		$TempTitle, 	$TempStr);
					$TempStr				= str_replace('{id}',		 		$kind4_id, 		$TempStr);
					$TempStr				= str_replace('{content}', 	$vote_string, $TempStr);
					
					$LoopContent		= $TempStr;
					
					break;
				case 'kind5':
					$TempStr='<script language="javascript" src="/guestbook'.$kind5_id.'.php?parentid='.$kind5_id.'"></script>';
					$LoopContent		= $TempStr;
					break;
				//*
				case 'kind6':
					//轮显
					//-------------------0------1
					$SqlStr	= ' SELECT `url`, `pic` from `'.table_pre.'cycle` ';
					$SqlStr.= ' WHERE `cateid`='.$kind6_id;
					$SqlStr.= ' ORDER BY `order` ASC';
					$kind6_i=1;
					$TempStr='';

					$MyDatabase1=new Database();
					$MyDatabase1->SqlStr = $SqlStr;
					if ($MyDatabase1->Query ()) {
						$DB_Record_Arr1 = $MyDatabase1->ResultArr;
						foreach ( $DB_Record_Arr1 as $DB_Record1 ) {					
							$TempStr.='Switcher['.$kind6_i.'] 						=	Array();'."\n";
							$TempStr.='Switcher['.$kind6_i.']["url"]			= "'.$DB_Record1[0].'";'."\n";
							$TempStr.='Switcher['.$kind6_i.']["pic"]			= "'.$DB_Record1[1].'";'."\n";
							$kind6_i++;
						}
					}
					$LoopContent		= $TempStr;
					break;
					/**/
			}
	//		echo "替换:i" . $i . '<br>';		
			
			$contents=str_replace($str_loop_begin.$LoopString.$str_loop_end, $LoopContent, $contents);
			
			//替换图片
			$contents=str_replace($str_module_pic, 		$pic, 	$contents);
			
			//替换标题
			$contents=str_replace($str_module_title, 	$title, $contents);
			
			//替换url
			$contents=str_replace($str_module_url, 		$url, 	$contents);
			
			
			$i++;
		}
	}
		
//	$contents=str_replace("{title}", 				$title, 								$contents);
	
	//生成文件夹
	createFolder(SPECIALPATH, $html);

	$handle = fopen ( SPECIALPATH . $html, "w" );
	fwrite( $handle, $contents );
	fclose($handle);

	echo '['. $special_title . '],生成成功:地址为：<a target="_blank" href="'.SPECIALURL. $html .'">'.SPECIALURL. $html .'</a><br />';

	$refresh_msg	= '专题[<font color=red>'.$special_title.'</font>]生成[<font color=red>成功</font>]，返回专题列表显示页面。';

	//管理员日志
	$log_content			= '专题[<font color=red>'.$special_title.'</font>] &gt;&gt; 生成 &gt;&gt; 成功';
}

require($page_name.'.php');

//管理员日志
require('../../include/log.php');

require('../../include/debug.php');
?>