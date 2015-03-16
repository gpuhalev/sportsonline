<?php 
	require_once('connections/connect_to_db.php');
	$db->set_charset("utf8");
	$id = stripslashes($_REQUEST['id']);
	$name = stripslashes($_REQUEST['name']);
	$parentID = stripslashes($_REQUEST['parentID']);
	$ip = $_SERVER['REMOTE_ADDR'];
	$qur = "UPDATE `news_categories` SET id='$id',name='$name',ip='$ip' WHERE id = '$id'";
	mysqli_query($db, $qur) or die(mysql_error());
	$where = $_REQUEST['where'];
	if($where == 1){
		header("Location: category_table.php");
	}else{
		header("Location: edit_categories.php?parentID=$parentID");
	}
?>