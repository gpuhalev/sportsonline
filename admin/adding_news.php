<?php 
	require_once('connections/connect_to_db.php');
	$db->set_charset("utf8");
	
	$title = $_POST['title'];
	$img_name = basename($_FILES['file_upload']['name']);
	echo $img_name;
	$t_name = $_FILES['file_upload']['tmp_name'];
	$dir = '../news_images';
	if(!move_uploaded_file($t_name,"$dir/$img_name")){
		$img_name = "0.txt";
		$dir = "0";
	}	
	
	$category = $_POST['category'];
	$anotation = $_POST['anotation'];
	$content = $_POST['content'];
	$is_visible = $_POST['visibility'];
	$ip = $_SERVER['REMOTE_ADDR'];
	$date = date('Y-m-d H:i:s');
	$qur = "INSERT INTO `news`(`id`, `title`, `category`, `anotation`, `content`, `images`, `ip_address`, `date`, `is_visible`) VALUES  ('','$title','$category','$anotation','$content','$dir/$img_name','$ip','$date','$is_visible')";
	echo "IT DIEDED. PLEASE, RELOAD";
	mysqli_query($db, $qur) or die(mysql_error());	
	header("Location: news.php");
?>