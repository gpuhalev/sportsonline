<?php 
	header('Content-type: text/html; charset=utf-8');
	require_once('connections/connect_to_db.php');
	$db->set_charset("utf8");
	$name = stripslashes($_REQUEST['name']);
	$parentID = $_REQUEST['parentID'];
	$qur = "SELECT name FROM news_categories WHERE name = '$name' AND parent_id = '$parentID'";
	$res = mysqli_query($db, $qur) or die(mysql_error());
	if(mysqli_num_rows($res)==0){
		$ip = $_SERVER['REMOTE_ADDR'];
		$qur = "INSERT INTO `news_categories`(`id`, `name`, `Parent_id`, `ip`) VALUES ('','$name', '$parentID','$ip')";
		mysqli_query($db, $qur) or die(mysql_error());	
	}
	header("Location: edit_categories.php?parentID=$parentID");
?>