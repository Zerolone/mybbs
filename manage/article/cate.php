<?php
/**
 * 栏目查看
 * 
 * @version 2009-8-14 9:37:43
 * @author Zerolone
*/

require('../include/common.php');
define('PAGE_NAME','cate.php');

//接受id， 修改用
$id=Request('id',0);

$mainmenu	= '&nbsp;<a href="cate_add.php?id=0">[添加下级]</a>';
$mainmenu.= '&nbsp;&nbsp;<a href="javascript:ffClick(\'article/article.php\', \'显示全部文章\')">[显示全部文章]</a>'."\n";

$Tablecellspacing	= 0;
$Tablecellpadding	= 0;

$tree_level_len	= 0;

$catenext_link='';
$catenext_title='';

//各个栏目颜色
//$table_color[2]	= "#CBF3FB";
$table_color[2]		= "#CCCCCC";
$table_color[4]		= "#FFFFFF";
$table_color[6]		= "#CCC999";
$table_color[8]		= "#DDD111";
$table_color[10]	= "#DDD999";
$table_color[12]	= "#EEE000";
$table_color[14]	= "#EEE666";

//------------------0-------1----------2--------3-----------4
$SqlStr	= 'Select `id`, `parentid`, `level`, `title`, `templateid` From `' .DB_TABLE_PRE. 'article_cate`  Order By `level`';
$i=0;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		if ($catenext_link=='') {
			$catenext_link 	= $DB_Record[0];
			$catenext_title	= $DB_Record[3];
		}
		
		//A
		if($tree_level_len == 0){
			$mainmenu.= '<table bgcolor="'.$table_color[strlen($DB_Record[2])].'" border="0" width="100%" cellspacing="'.$Tablecellspacing.'" cellpadding="'.$Tablecellpadding.'">'."\n";
		}
	
		//B
		if($tree_level_len == strlen($DB_Record[2])){
			$mainmenu.= '</td>'."\n".'</tr>'."\n";
		}
	
		//C
		if(($tree_level_len < strlen($DB_Record[2])) && $tree_level_len <> 0){
			$mainmenu.= '<table style="display:none" id="node_'.$DB_Record[1].'" bgcolor="'.$table_color[strlen($DB_Record[2])].'" border="0" width="100%" cellspacing="'.$Tablecellspacing.'" cellpadding="'.$Tablecellpadding.'" >'."\n";
		//	$mainmenu.= '<table id="node_'.$DB_Record[1].'" bgcolor="'.$table_color[strlen($DB_Record[2])].'" border="0" width="100%" cellspacing="'.$Tablecellspacing.'" cellpadding="'.$Tablecellpadding.'" >'."\n";
		}
	
		//D
		if($tree_level_len > strlen($DB_Record[2])){
			$j = ($tree_level_len-strlen($DB_Record[2])) / 2;
			for($i=0;$i<$j;$i++){
				$mainmenu.= '</td>'."\n".'</tr>'."\n".'</table>'."\n";
			}
			$mainmenu.= '</td>'."\n".'</tr>'."\n";
		}
	
		$mainmenu.= '<tr>'."\n".'<td height=26 >'."\n";
		
		if($_SESSION['login']==1){
			$mainmenu.= '&nbsp;<a href="cate_add.php?parentid='.$DB_Record[0].'">[添加下级]</a>'."\n";				
			$mainmenu.= '&nbsp;<a onClick="return confirm(\'你真的要删除所选信息？\');" href="cate_update.php?id='.$DB_Record[0].'&mode=del">[删除]</a>'."\n";
			$mainmenu.= '&nbsp;<a href="cate_edit.php?parentid='.$DB_Record[1].'&id='.$DB_Record[0].'">[完整编辑]</a>'."\n";
			$mainmenu.= '&nbsp;<a href="cate.php?id='.$DB_Record[0].'#'.$DB_Record[0].'">[标题编辑]</a>'."\n";
			$mainmenu.= '&nbsp;<span class="Menu" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="ffClick(\'article/add.php?cateid='.$DB_Record[0].'&templateid='.$DB_Record[4].'\',\'添加文章\');">[添加文章]</span>'."\n";
		}
		
		//加入折行
		
		$mainmenu.= '<img src="images/blank.gif" height="1" width="'.(((strlen($DB_Record[2]))-2) / 2 * 10).'"><span id="'.$DB_Record[0].'" class="Menu" onMouseOver="hl_menu(this,0)" onMouseOut="hl_menu(this,1)" onClick="extendnode(\'node_'.$DB_Record[0].'\');">'."\n";
		$mainmenu.= '<img id="img_node_'.$DB_Record[0].'" src="../images/shrink.gif">'."\n";	
		$mainmenu.= '<a name="'.$DB_Record[0].'"></a>'."\n";
			
		if ($id==$DB_Record[0]) {
			$mainmenu.= '&nbsp;<input type="hidden" name="mode" value="edit_title"><input name="id" type="hidden" value="'.$id.'"><input class="InputBox" name="title" type="text" value="' .$DB_Record[3].'"> <input class="InputBox" type="submit" value=" 修 改 ">'."\n";
		}	else {
			$mainmenu.= '&nbsp;<a href="javascript:ffClick(\'article/article.php?cateid='.$DB_Record[0].'\', \''.$DB_Record[3].'\')">' .$DB_Record[3].'</a>'."\n";			
		}
		
		$mainmenu.= '</span>'."\n";	
		
		$tree_level_len	= strlen($DB_Record[2]);
	}
}
$mainmenu.= '</td>'."\n".'</tr>'."\n".'</table>'."\n";
$mainmenu.= '</td>'."\n".'</tr>'."\n".'</table>'."\n";

require(PAGE_NAME.'.php');
require('../../include/debug.php');

?>

<script language="javascript">
//var AllSpan = document.getElementsByTagName('span');
var AllSpan = document.getElementsByTagName('img');
if (AllSpan) {
	  for (i = 0; i < AllSpan.length; i++) {
		 	theid=AllSpan[i].id;
		 	if(theid.substring(0,4)=="img_"){
//			 	 document.write (theid + '<br>');

			 	 thetable=theid.replace(/img_/, "");
			 	 thetable=document.getElementById(thetable);
			 	 if(!thetable)
			 	 {
				 	 AllSpan[i].src="/manage/images/unwrap.gif";

			 	 }
		 	}
	  }
	}
</script>