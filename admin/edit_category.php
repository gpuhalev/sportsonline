<?php 
	session_start();
	require_once('connections/connect_to_db.php');
	$db->set_charset("utf8");
	if ($_SESSION['loggedIn'] == "false"){
		header("Location: index.php");	
	}
	if(isset($_REQUEST['where'])){
		$where = $_REQUEST['where'];
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include 'header.php'; ?>
	<title>Edit Category</title>
</head>


<body>
	<div id="wrapper">
		<?php include 'menu.php';?>
        
        <div id="right">
        	<?php 
				$id = $_REQUEST['id'];
				$qur = "SELECT id,name,parent_id FROM news_categories WHERE id = '$id'";
                $res = mysqli_query($db, $qur) or die(mysql_error());
				$row = mysqli_fetch_array($res);
			?>
            
            <div id="news_head"><p>Редактиране на категория</p></div>
            <form action="upgrading_category.php" method="post">
            
            	<input type="hidden" name="id" value="<?php echo $id ?>" />
                
                <input type="hidden" name="parentID" value="<?php echo $row['parent_id']?>"? />
                
                <div id="news_item"><p>Заглавие:</p></div>
                <input type="text" name="name" value="<?php echo $row['name'];?>" />
                <input type="submit" value="Запази промените" style="margin-top:2em;"/>
                <input type="hidden" name="where" value="<?php echo $where;?>" />
            </form>     
        </div>
    </div>

</body>
</html>