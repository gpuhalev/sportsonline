<?php
session_start();
require_once('connect_to_db.php');

$username = $_POST['user'];
$password = $_POST['pass'];

$username = stripslashes($username);
$password = stripslashes($password);

mysqli_select_db($db,"users");

$qur = "select username, password from users where username = '$username' and password = '$password'";
$result = mysqli_query($db, $qur) or die ( mysql_error() );

$count = 0;

$count = mysqli_num_rows($result);

echo $count;

if ($count == 1) {
	 $_SESSION['loggedIn'] = "true";
	 $qur = "select is_admin from users where username = '$username'";
	 $result = mysqli_query($db, $qur) or die(mysql_error());
	 if($result == 1){
	 	header("Location: ../adminindex.php");
	 }else{
	 	header("Location: ../../index.php");
	 }
} else {
	 $_SESSION['loggedIn'] = "false";
	 header("Location: ../loginFailed.php");
}

?>