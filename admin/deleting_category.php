<?php 
	require_once('connections/connect_to_db.php');
	$id = $_REQUEST['id'];
	$qur = "DELETE FROM news_categories WHERE id = '$id'";
	mysqli_query($db, $qur) or die(mysql_error());
	$parentID = $_REQUEST['parentID'];	
	header("Location: edit_categories.php?parentID=$parentID");
?>