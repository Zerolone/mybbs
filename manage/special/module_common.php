<?php
/**
 * 模块添加、修改公共页面
 * 
 * @author 			Zerolone
 * @version 			2009-8-17 17:16:42
 */

$id					=	Request('id',0);					//获取id
$title			= '';												//标题
$order			= 1;												//顺序
$kind				=	'kind1';									//kind
$parentid		=	Request('parentid',0);		//获取parentid
$pic				=	'';												//图片地址
$url				=	'';												//url

$kind1_count		= 1;										//kind1
$kind1_cateid		= 1;
$kind1_perline	= 0;
$kind1_txt			= 1;
$kind1_orderby	= 'id';
$kind1_ordersort= 'DESC';

$kind2_url			= '';			//初始化kind2
$kind3_id				= 0;			//初始化kind3
$kind4_id				= 0;			//投票
$kind5_id				= 0;			//留言
$kind6_id				= 0;			//轮显

//获取专题信息
//--------------------0--------1----------2--------3
$SqlStr	= ' SELECT `title`, `order`, `parentid`, `kind`, ';
//----------------4--------------5---------------6------------7
$SqlStr.= ' `kind1_count`, `kind1_cateid`, `kind1_txt`, `kind1_perline`, ';
//----------------8
$SqlStr.= ' `kind2_url`, ';
//----------------9
$SqlStr.= ' `kind3_id`, ';
//------------10-----11
$SqlStr.= ' `pic`, `url`, ';
//------------12
$SqlStr.= ' `kind4_id`, ';
//------------13
$SqlStr.= ' `kind5_id`, ';
//----------------14---------------15
$SqlStr.= ' `kind1_orderby`, `kind1_ordersort`,';
//----------------16
$SqlStr.= ' `kind6_id`';

$SqlStr.=' FROM `' .DB_TABLE_PRE. 'special_module` WHERE `id`= ' . $id;
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record = $MyDatabase->ResultArr [0];
	$title						= $DB_Record[0];
	$order						= $DB_Record[1];
	$parentid					= $DB_Record[2];
	$kind							= $DB_Record[3];

	//kind1
	$kind1_count			= $DB_Record[4];
	$kind1_cateid			= $DB_Record[5];
	$kind1_txt				= $DB_Record[6];
	$kind1_perline		= $DB_Record[7];
	$kind1_orderby		= $DB_Record[14];
	$kind1_ordersort	= $DB_Record[15];
	
	//kind2
	$kind2_url				= $DB_Record[8];

	//kind3
	$kind3_id					= $DB_Record[9];
	
	$pic							= $DB_Record[10];
	$url							= $DB_Record[11];
	
	//kind4
	$kind4_id					= $DB_Record[12];
	
	//kind5
	$kind5_id					= $DB_Record[13];
	
	//kind6
	$kind6_id					= $DB_Record[16];
}

//栏目列表kind1
//------------------0-------1----------2--------3
$SqlStr	= 'SELECT `id`, `parentid`, `level`, `title` FROM `' .DB_TABLE_PRE. 'article_cate` Order By `level`';
$MyDatabase->SqlStr = $SqlStr;
if ($MyDatabase->Query ()) {
	$DB_Record_Arr = $MyDatabase->ResultArr;
	foreach ( $DB_Record_Arr as $DB_Record ) {
		$kind1_cateid_arr=explode(',', $kind1_cateid);	
		$kind1_selected		= '';
		if (in_array($DB_Record[0], $kind1_cateid_arr))
		{
			$kind1_selected = 'selected		= "selected"';
		}
		$kind1_cate_list[] = array(
		'id' 				=> $DB_Record[0],
		'title'			=> LoopNBSP(((strlen($DB_Record[2]))-2) / 2 * 3) .$DB_Record[3],
		'selected'	=> $kind1_selected
		);
	}
}
?>