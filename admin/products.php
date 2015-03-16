<?php 
	session_start();
	require_once('connections/connect_to_db.php');
	$db->set_charset("utf8");
	if ($_SESSION['loggedIn'] == "false"){
		header("Location: index.php");	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include 'header.php'; ?>
	<title>Products</title>
</head>

<body>
	<div id="wrapper">
		<?php include 'menu.php';?>
        
        <div id="right">
            <div id="news_head"><p>Всички продукти:</p></div>
            
        </div>
    </div>

</body>
</html>