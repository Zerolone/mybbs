<?php
/**
* 公共函数放置位置
*
* @author Zerolone
* @update 2010-3-25 11:31:14
*/

/**
 * 打印空格
 *
 * @param 整数 $num
 * @return 一片空格
 */
function LoopNBSP($num=1){
	$thestr="";
	for($i=0;$i<$num;$i++){
		$thestr .= "&nbsp;";
	}
	return $thestr;
}

/**
 * 获取执行时间
 *
 * @param 时间 $start_time
 * @return 时间差距
 */
function getprocesstime($start_time="0 0"){
	list($start_usec, $start_sec, $end_usec, $end_sec) = explode(" ",$start_time . " " . microtime());
	$temp1	= ((float)$start_usec + (float)$start_sec)*1000;
	$temp2	= ((float)$end_usec + (float)$end_sec)*1000;
	$temp		= $temp2-$temp1 ;
	$temp	 /= 1000;
	return number_format($temp, 4, '.', '');
}

/**
 * 获取上一级页面提交的参数
 * 
 * @version 	2009-3-2 20:21:44
 * @param 需要获取的参数 $value
 * @param 默认返回值 $default
 * 
 * @return 	获取的参数值
 */
function Request($value, $default='') {
	if (isset ( $_POST [$value] )) {
		return $_POST [$value];
	} elseif (isset ( $_GET [$value] )) {
		return $_GET [$value];
	} else {
		return $default;
	}
}

/**
 * 打印数组，也是为了调试信息用.
 *
 * @param Array $TheArray
 * @return Array
 */
function print_array($TheArray) {
	$TmpStr = '';
	$TmpStr .= "Array\n{\n";
	if (isset ( $TheArray )) {
		foreach ( $TheArray as $Key => $value ) {
			$TmpStr .= '    [' . $Key . ']	=> ' . $value . "\n";
		}
	}
	$TmpStr .= "}\n";
	return $TmpStr;
}

/**
 * 格式化日期
 * 
 * @param 时间
 * @param 时间格式，默认为Y-m-d H:i:s
 */
function get_date($timestamp, $timeformat='Y-m-d H:i:s'){
	if ($timestamp)	return date($timeformat,$timestamp);	
}

/**
 * 字符串截取
 *
 * @param 字符串 $str
 * @param 整型 $len
 * @return 字符串
 */
function subString($str,$len){
	for($i=0;$i<$len;$i++){
		$temp_str=substr($str,0,1);
		if(ord($temp_str) > 127){
			$i++;
			if($i<$len){
				$new_str[]=substr($str,0,3);
				$str=substr($str,3);
			}
		}else{
			$new_str[]=substr($str,0,1);
			$str=substr($str,1);
		}
	}
	return join($new_str);
}

/**
 * 打印字符串，用<hr>包含
 * 
 * @param $str 字符串
 */
function DebugStr($str='调试'){
	echo '<hr color=blue>'.$str.'<hr color=blue>';
}

function DebugArr($arr){
	echo '<hr color=blue>';
	echo '<pre>';
	print_r($arr);
	echo '</pre><hr color=blue>';
}

/**
 * 
 * @param $str
 */
function DebugAlert($str){
	echo '<script>';
	echo 'alert("';
	echo $str;
	echo '")';
	echo '</script>';
}

/**
 * 分页函数
 * 
 * @param 总数   $count
 * @param 页数   $page
 * @param 当前页 $numofpage
 * @param 地址   $url
 */
function numofpage($count,$page,$numofpage,$url){
	$total=$numofpage;
	if ($numofpage <= 1 || !is_numeric($page)){
		return ;
	}else{
		$pages="<a href=\"{$url}\">&laquo;</a>";
		$flag=0;
		for($i=$page-3;$i<=$page-1;$i++){
			if($i<1) continue;
			$pages.=" <a href='{$url}&page=$i'>$i</a>";
		}
		$pages.="<b>$page</b>";
		if($page<$numofpage)
		{
			for($i=$page+1;$i<=$numofpage;$i++)
			{
				$pages.=" <a href='{$url}&page=$i'>$i</a>";
				$flag++;
				if($flag==4) break;
			}
		}
		$pages.="<a href=\"{$url}&page=$numofpage\">&raquo;</a> &nbsp;Pages: ( $page/$total total )";
		return $pages;
	}
}

function Char_cv($msg){
	$msg = str_replace('&amp;','&',$msg);
	$msg = str_replace('&nbsp;',' ',$msg);
	$msg = str_replace('"','&quot;',$msg);
	$msg = str_replace("'",'&#39;',$msg);
	$msg = str_replace("<","&lt;",$msg);
	$msg = str_replace(">","&gt;",$msg);
	$msg = str_replace("\t"," &nbsp; &nbsp;",$msg);
	$msg = str_replace("\r","",$msg);
	$msg = str_replace("   "," &nbsp; ",$msg);
	return $msg;
}

function Add_S(&$array){
	foreach($array as $key=>$value){
		if(!is_array($value)){
			$array[$key]=addslashes($value);
		}else{
			Add_S($array[$key]);
		}
	}
}

/**
 * 错误信息
 * 
 * @param $str 内容
 */

function ErrorMsg($refresh_msg='',$refresh_url=''){
	//获取来源页面
	if($refresh_url=='') $refresh_url=@$_SERVER['HTTP_REFERER'];
	if($refresh_url=='') $refresh_url=BBS_INDEX;
	require 'include/refresh.php.php';	
	exit();
}

//////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////
/**
 * 计算字符串的总值
 *
 * @author   Zerolone
 * @version  2008-9-19 23:31:24
 * @param String 字符串
 * @return   Integer 整数
 */
function count_string($string){
	$string_len=strlen($string);
	$count=0;
	for($i=0;$i<$string_len;$i++)	{
		$count+=substr($string, $i, 1);
	}
	return $count;
}

/**
 * 将模块数转换成一个字符串
 *
 * @author   Zerolone
 * @version  2008年10月17日15:01:32
 * @param TheString 字符串
 * @param Filename 文件名， 物理路径 字符串
 * @return 
 */
function tostr($TheString){
	$TheString			= decbin($TheString);
	$TheString_len	= strlen($TheString);
	$TheString_num	= 32;
	
	for($i=0;$i<$TheString_num-$TheString_len;$i++)
		$TheString= '0'.$TheString;
	return($TheString);
}

/**
 * 根据编号，显示选定值
 * 
 * @author   Zerolone
 * @version  2008年11月3日10:18:59
 * @param		 order		选定的顺序 		默认为0
 *  
 * @return 一个字符串
 */
function getOrderList($order=0){
	$RetrunStr='';
	
	//列表
	for ($i=1;$i<=99;$i++){
		$RetrunStr.='<option value="'.$i . '"';
		if ($order==$i){
			$RetrunStr.=' selected';
		}

		$RetrunStr.= '>' . $i . '</option>';
	}
	
	//如果默认的order大于循环数，则显示一个
	if ($order>$i){
		$RetrunStr.='<option value="'.$order . '" selected >' . $order . '</option>';
	}
	
	return $RetrunStr;
}

/**
 * 根据编号，显示论坛栏目列表
 * 
 * @author   Zerolone
 * @version  2010-3-16 9:43:44
 * 
 * @param	数据库	$MyDataBase		
 * @param	级别		$level
 *  
 * @return 一个字符串
 */
function getForumsList($MyDatabase, $level=0){
	$RetrunStr='<option value="0">全局</option>';
	
	//获取论坛栏目
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'forums` ORDER BY `level` ASC';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $DB_Record ) {
			//如果是分类， 这加颜色
			$style='';
			if (strlen($DB_Record['level'])==2){
				$style=' style="color: #FFFFFF;background: #84AACE"';
			}else{
				$DB_Record['title']='--'.$DB_Record['title'];
			}

			$RetrunStr.='<option value="'.$DB_Record['level'] . '"';
			if ($DB_Record['level']==$level){
				$RetrunStr.=' selected';
			}
	
			$RetrunStr.= $style.'>' . $DB_Record['title'] . '</option>';
		}
	}
	return $RetrunStr;
}

/**
 * 根据编号，显示论坛栏目列表
 * 
 * @author   Zerolone
 * @version  2010-3-16 9:43:44
 * 
 * @param	$MyDataBase		数据库
 * @param	$level				级别
 *  
 * @return 一个字符串
 */
function getForumsListById($MyDatabase, $fid=0){
	$RetrunStr='';
	
	//获取论坛栏目
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'forums` ORDER BY `level` ASC';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $DB_Record ) {
			$select='';
			if ($DB_Record['fid']==$fid){
				$select=' selected';
			}
			
			//如果是分类， 加效果
			if (strlen($DB_Record['level'])==2){
				$RetrunStr.='<OPTGROUP style="color: #FFFFFF;background: #84AACE;" label="' . $DB_Record['title'] . '"></OPTGROUP>';

			}else{
				$RetrunStr.='<option value="'.$DB_Record['level'] . '"'.$select.'>--' . $DB_Record['title'] . '</option>';
			}
		}
	}
	return $RetrunStr;
}

/**
 * 根据编号，显示论坛栏目列表
 * 
 * @author   Zerolone
 * @version  2010-3-16 9:43:44
 * 
 * @param	数据库	$MyDataBase		
 * @param	编号		$fid					
 * @return 一个字符串
 */
function getForumsListByFid($MyDatabase, $fid=0){
	$RetrunStr='';
	
	//获取论坛栏目
	$SqlStr='SELECT * FROM `'.DB_TABLE_PRE.'forums` ORDER BY `level` ASC';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $DB_Record ) {
			$select='';
			if ($DB_Record['fid']==$fid){
				$select=' selected';
			}
			
			//如果是分类， 加效果
			if (strlen($DB_Record['level'])==2){
				$RetrunStr.='<OPTGROUP style="color: #FFFFFF;background: #84AACE;" label="' . $DB_Record['title'] . '"></OPTGROUP>';
			}else{
				$RetrunStr.='<option value="'.$DB_Record['fid'] . '"'.$select.'>--' . $DB_Record['title'] . '</option>';
			}
		}
	}
	return $RetrunStr;
}

function getUserGroup($MyDatabase, $gidlist){
	$RetrunStr='';

	//选定的组
	$gidlist				=	explode(',', $gidlist);
	//游客
	if (in_array('0', $gidlist)){
		$gid_selected = 'selected		= "selected"';
	}
	$RetrunStr.='<option value="0"'.$gid_selected.'>游客</option>';	

	$SqlStr	= 'SELECT * FROM `' .DB_TABLE_PRE. 'user_group` Order By `order`';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$DB_Record_Arr = $MyDatabase->ResultArr;
		foreach ( $DB_Record_Arr as $DB_Record ) {
			$gid_selected		= '';
			if (in_array($DB_Record['gid'], $gidlist)){
				$gid_selected = 'selected		= "selected"';
			}
			$RetrunStr.='<option value="'.$DB_Record['gid'] . '"'.$gid_selected.'>'. $DB_Record['title'] . '</option>';	
		}
	}
	return $RetrunStr;
}

/**
 * 根据编号，显示论坛栏目
 * 
 * @param	数据库	$MyDataBase		
 * @param	级别		$level				
 * @return 一个字符串
 */
function getForumByLevel($MyDatabase, $level=0){
	$RetrunStr='全局';
	
	//获取论坛栏目
	$SqlStr	='SELECT * FROM `'.DB_TABLE_PRE.'forums`';
	$SqlStr.=' WHERE `level` = '.$level;
	$SqlStr.=' LIMIT 1;';
	$MyDatabase->SqlStr = $SqlStr;
	if ($MyDatabase->Query ()) {
		$RetrunStr = $MyDatabase->ResultArr [0]['title'];
	}
	return $RetrunStr;
}


/**
 * 保存本地文件，并是否打水印
 * @author   Zerolone
 * @version  2008年11月28日16:15:56

 * @param		$fileName				文件名				没有默认值，必须指定
 * @param		$ImagePath			保存路径			没有默认值
 * @param		$ext_name				后缀名				没有默认值
 * @return 文件路径
 */
function saveFilelocal( $fileName ,$ImagePath, $ext_name){
	$s_filename = basename( $fileName );
	
	if( ( ".jpg" && ".gif" && ".png" && ".bmp" ) != strtolower( $ext_name ) )	{
		return "";
	}

	$contents = file_get_contents( $fileName );
	$s_filename = date( "His", time() ) . rand( 1000, 9999 ) . $ext_name;

	$handle = fopen ( $ImagePath.$s_filename, "w" );
	fwrite( $handle, $contents );
	fclose($handle);

	return $s_filename;
}

function readover($filename,$method="rb"){
	strpos($filename,'..')!==false && exit('Forbidden');
	if($handle=@fopen($filename,$method)){
		flock($handle,LOCK_SH);
		$filedata=@fread($handle,filesize($filename));
		fclose($handle);
	}
	return $filedata;
}
function writeover($filename,$data,$method="rb+",$iflock=1,$check=1,$chmod=1){
	//Copyright (c) 2003-06 PHPWind
	$check && strpos($filename,'..')!==false && exit('Forbidden');
	touch($filename);
	$handle=fopen($filename,$method);
	if($iflock){
		flock($handle,LOCK_EX);
	}
	fwrite($handle,$data);
	if($method=="rb+") ftruncate($handle,strlen($data));
	fclose($handle);
	$chmod && @chmod($filename,0777);
}

/**
 * 显示模板
 * @author   Zerolone
 * @version  2010-5-7 15:08:07

 * @param	 模板名	$name
 * @return 模板
 */
function PT($name){
	//判断路径
	
	
	require(TP.$name.'.php');
}

/**
 * 分页
 * 
 * @author   Zerolone
 * @version  2008年11月3日11:28:11
 * @param			recordcount			总记录数
 * @param			pagenum					当前页
 * @param			pagesize				页面记录数 默认为20
 * @param			showrs					显示翻页数
 * @param			maxpagelimit		最大翻页数
 * 
 * @return 分页数组
 */
function SplitPage($recordcount=100, $pagenum=1, $pagesize=20, $showrs=10, $maxpagelimit=50 ){
	//返回值
	$ReturnString='';
	
	//总页数
	$pagecount = ceil($recordcount / $pagesize);		
	
	//最大移动数
	$pagend	= $pagenum+$maxpagelimit;
	if($pagend > $pagecount){
		$pagend	= $pagecount;
	}

	//如果为第一页， 则第一页的上一页也是第一页
	if($pagenum==1){
		$pagenum_up	= 1;
	}else{
		$pagenum_up = $pagenum-1;
	}

	//下一页， 如果下一页大于等于当前页，则下一页也是当前页
	$pagenum_down	= $pagenum+1;
	if ($pagenum_down > $pagecount){
		$pagenum_down	= $pagecount;
	}
	
	//前显记录数， 用舍余方式
	$showrs_begin	=	floor($showrs/2);
	
	//后显记录数，减掉前显记录数，再减掉当前记录数
	$showrs_end		=	$showrs-$showrs_begin-1;	

	//起始页数
	$pagenum_begin 	= $pagenum-$showrs_begin;
	if ($pagenum_begin<=1){
		$pagenum_begin=1;
	}
	
	//结束页数
	$pagenum_end		= $pagenum+$showrs_end;
	if ($pagenum_end>$pagecount){
		$pagenum_end=$pagecount;
	}
	
	//如果翻页数小于$showrs，则补全， 除非总的记录数小于$showrs
	$cutrs = $showrs-($pagenum_end-$pagenum_begin+1);
	if ($cutrs>0){
		if (($pagenum_begin-$cutrs)>0){
			$pagenum_begin=$pagenum_begin-$cutrs;
		}else{
			$pagenum_begin=1;
			$pagenum_end=$showrs;
			if ($pagenum_end>=$pagecount){
				$pagenum_end=$pagecount;
			}
		}
	}
	
	//第一页
	$ReturnString='<a href="javascript:goto(\'1\');" title="第一页"><b>|&lt;</b></a>  ';

	//上一页
	$ReturnString.='<a href="javascript:goto(\''. $pagenum_up .'\');" title="上一页"><b>&lt;</b></a>  ';
	
	for ($i=$pagenum_begin;$i<=$pagenum_end;$i++){
		if ($i==$pagenum){
			$ReturnString.='[<font color="red">'.$i.'</font>] ';
		}else{
			$ReturnString.='[<a href="javascript:goto(\''.$i.'\');" title="第'.$i.'页">'.$i.'</a>] ';
		}
	}
	
	$ReturnString.='<a href="javascript:goto(\''.$pagenum_down.'\');" title="下一页"><b>&gt;</b></a> ';
	$ReturnString.='<a href="javascript:goto(\''.$pagend.'\');" title="第'.$pagend.'页"><b>&gt;|</b></a> ';
	$ReturnString.='<strong><font color=red>'.$pagenum.'</font>/'.$pagecount.'</strong>页&nbsp;';
	$ReturnString.='<b><font color="#FF0000">'.$recordcount.'</font></b>条记录&nbsp;<b>'.$pagesize.'</b>条/页&nbsp;';
	$ReturnString.='转到：<input type="text" name="pagenum1" size=2 maxlength=10 class="InputBox"> <input class="inputbox" type="submit"  value="Go"  name="cndok">';
	$ReturnString.='<input type="hidden" name="pagenum" value="'.$pagenum.'">';
	
	return $ReturnString;
}

/**
 * 前台文章分页
 * 
 * @author   Zerolone
 * @version  2008年11月3日15:03:17
 * @param			recordcount			总记录数
 * @param			pagesize				页面记录数 默认为20
 * @param			showrs					显示翻页数
 * @param			pagenum					当前页
 * @param			maxpagelimit		最大翻页数
 * 
 * @return 分页数组
 */
function SplitPageFront($recordcount=100, $pagenum=1, $pagesize=20, $showrs=10, $maxpagelimit=50 ){
	//总页数
	$pagecount = ceil($recordcount / $pagesize);		
	
	//最大移动数
	$pagend	= $pagenum+$maxpagelimit;
	if($pagend > $pagecount){
		$pagend	= $pagecount;
	}

	//如果为第一页， 则第一页的上一页也是第一页
	/*
	if($pagenum==1){
		$pagenum_up	= 1;
	}else{
		$pagenum_up = $pagenum-1;
	}
	*/

	//下一页， 如果下一页大于等于当前页，则下一页也是当前页
	$pagenum_down	= $pagenum+1;
	if ($pagenum_down > $pagecount){
		$pagenum_down	= $pagecount;
	}
	
	//前显记录数， 用舍余方式
	$showrs_begin	=	floor($showrs/2);
	
	//后显记录数，减掉前显记录数，再减掉当前记录数
	$showrs_end		=	$showrs-$showrs_begin-1;	

	//起始页数
	$pagenum_begin 	= $pagenum-$showrs_begin;
	if ($pagenum_begin<=1){
		$pagenum_begin=1;
	}
	
	//结束页数
	$pagenum_end		= $pagenum+$showrs_end;
	if ($pagenum_end>$pagecount){
		$pagenum_end=$pagecount;
	}
	
	//如果翻页数小于$showrs，则补全， 除非总的记录数小于$showrs
	$cutrs = $showrs-($pagenum_end-$pagenum_begin+1);
	if ($cutrs>0){
		if (($pagenum_begin-$cutrs)>0){
			$pagenum_begin=$pagenum_begin-$cutrs;
		}else{
			$pagenum_begin=1;
			$pagenum_end=$showrs;
			if ($pagenum_end>=$pagecount){
				$pagenum_end=$pagecount;
			}
		}
	}
	
	//返回值
	$ReturnString='';
	
	for ($i=$pagenum_begin;$i<=$pagenum_end;$i++){
		if ($i==$pagenum){
//			$ReturnString.='<a href="#" class="activePage">'.$i.'</a> ';
			
			$ReturnString.='<td class="activePage"><strong>'.$i.'</strong></td>';
			
		}else{
			$TheUrl='index.html';
			if ($i>1){
				$TheUrl= 'index_'.$i.'.html';
			}
			//$ReturnString.='<a href="'.$TheUrl.'" title="第'.$i.'页">'.$i.'</a> ';
			$ReturnString.='<td class="inactivePage"><a href="'.$TheUrl.'">'.$i.'</a></td>';
		}
	}
		
	return $ReturnString;
}
?>
