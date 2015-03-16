<?php 
	require_once('connections/connect_to_db.php');
	$id = $_POST['id'];
	$qur = "DELETE FROM `users` WHERE id = '$id'";
	mysqli_query($db, $qur) or die(mysql_error());	
	header("Location: users.php");
?>