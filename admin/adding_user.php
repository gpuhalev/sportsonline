<?php
	session_start();
	require_once('connections/connect_to_db.php');
	$email = $_POST['email'];
	$username = $_POST['user'];
	$password = $_POST['pass'];
	$reppassword = $_POST['rep_pass'];
	if(isset($_POST['is_admin'])){
		$is_admin = 1;
	}else{
		$is_admin = 0;
	}
	
	if(strcmp($password, $reppassword)){
		header("Location: users.php");	
	}
	
	$email = stripslashes($email);
	$username = stripslashes($username);
	$password = stripslashes($password);
	
	$qur = "select username from users where username = '$username'";
	$result = mysqli_query($db, $qur) or die ( mysql_error() );
	
	$count = 0;
	
	$count = mysqli_num_rows($result);
	
	if ($count == 0) {
		$qur = "select email from users where email = '$email'";
		$result = mysqli_query($db, $qur) or die ( mysql_error() );
		$count = 0;
		$count = mysqli_num_rows($result);
		if($count == 0){
			$qur = "INSERT INTO `users`(`id`, `username`, `password`, `email`, `is_admin`) VALUES ('','$username','$password','$email','$is_admin')";
			mysqli_query($db, $qur);
		}
	}
	header("Location: users.php");
?>