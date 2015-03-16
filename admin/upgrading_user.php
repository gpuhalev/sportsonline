<?php 
	require_once('connections/connect_to_db.php');
	$db->set_charset("utf8");	
	$id = $_REQUEST['id'];
	$where=$_REQUEST['where'];
	echo $where;
	if(isset($_REQUEST['is_admin'])){
		$is_admin = 1;
	}else{
		$is_admin = 0;
	}
	$qur = "UPDATE `users` SET `is_admin`='$is_admin' WHERE id = '$id'";
	mysqli_query($db, $qur) or die(mysql_error());
	if($where == 1){
		header("Location: users_table.php");
	}else{
		header("Location: users.php");
	}
?>