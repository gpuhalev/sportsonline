<?php 
	require_once('connections/connect_to_db.php');
	$db->set_charset("utf8");	
	$id = $_REQUEST['id'];
	$title = $_REQUEST['title'];
	$category = $_REQUEST['category'];
	$anotation = $_REQUEST['anotation'];
	$content = $_REQUEST['content'];
	$is_visible = $_REQUEST['visibility'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$date = date('Y-m-d H:i:s');
	$qur = "UPDATE `news` SET id='$id',category='$category',title='$title',anotation='$anotation',content='$content',images='',ip_address='$ip',date='$date',is_visible='$is_visible' WHERE id = '$id'";
	mysqli_query($db, $qur) or die(mysql_error());
	$where=$_REQUEST['where'];
	if($where == 1){
		header("Location: news_table.php");
	}else{
		header("Location: news.php");
	}
?>