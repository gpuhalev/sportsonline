<?php
session_start();
require_once('connect_to_db.php');

// Get the data passed from the form
$email = $_POST['email'];
$username = $_POST['user'];
$password = $_POST['pass'];
$reppassword = $_POST['rep_pass'];

if(strcmp($password, $reppassword)){
	header("Location: loginFailed.php");	
}

$email = stripslashes($email);
$username = stripslashes($username);
$password = stripslashes($password);

mysqli_select_db($db,"users");

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
		$qur = "INSERT INTO `users`(`id`, `username`, `password`, `email`) VALUES ('','$username','$password','$email')";
		mysqli_query($db, $qur);
		header("Location: ../../index.php");
	}else{
		header("Location: ../loginFailed.php");
	}
	
} else {
	 header("Location: ../loginFailed.php");
}

?>