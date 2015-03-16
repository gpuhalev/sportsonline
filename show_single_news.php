<?php 
	require_once('connections/connect_to_db.php');
	$db->set_charset("utf8");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php include 'header.html';?>
<title>Новини</title>
</head>
	
<body>

	<div id="wrapper">
		<?php include 'menu.html';?>
        
        <?php include 'left_sidebar.php';?>
        
        <div id="main">	
			<?php 
				$id = $_GET['id'];
				$qur = "SELECT title, category, anotation, content FROM news WHERE id = '$id'";
				$res = mysqli_query($db, $qur);
				$row = mysqli_fetch_array($res);
			?>
            <div class="news_single">
            	<div class="news_title"><?php echo $row['title']?></div>
                <div class="news_content"><?php echo $row['content'];?></div>
            </div>
        </div>
    </div>
    
</body>

</html>