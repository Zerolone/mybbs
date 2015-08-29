<?php
require('../include/common.php');

$id	= $_GET['id'];

if($id)
{
	//--------------------0
	$SqlStr = 'SELECT `content` FROM '.table_pre.'article WHERE id='.$id;
	//echo $SqlStr;
	$temp_query = query($SqlStr);
	if($DB_Record = nqfetch($temp_query))
	{
		echo $DB_Record[0];
	}
}
?>