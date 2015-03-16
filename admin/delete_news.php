<?php 
	require_once('connections/connect_to_db.php');
	$id = $_POST['id'];
	$qur = "DELETE FROM `news` WHERE id = '$id'";
	mysqli_query($db, $qur) or die(mysql_error());	
	header("Location: news.php");
?>