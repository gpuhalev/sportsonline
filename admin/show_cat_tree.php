<?php 
	session_start();
	require_once('connections/connect_to_db.php');
	$db->set_charset("utf8");
	if ($_SESSION['loggedIn'] == "false"){
		header("Location: index.php");	
	}
	
	function treeing($parentID, $db, $mult){
		$qur = "SELECT id,name,parent_id FROM news_categories WHERE parent_id = $parentID";
		$res = mysqli_query($db, $qur);
		while($row = mysqli_fetch_array($res)){
			?>
			<div class="cat_tree" style='margin:0.2em 0.2em 0.2em <?php echo 30*$mult?>px; font-weight:bold; font-size:18px; border:0.1em solid black; border-radius: 0.2em; padding: 0.2em; background-color:rgb(<?php echo 255-25*$mult;?>,<?php echo 255-25*$mult;?>,<?php echo 255-25*$mult; ?>);'><a href="edit_categories.php?parentID=<?php echo $row['id'];?>" target="_blank"> > <?php echo $row['name']; subcating($row['id'], $db);?>
            <?php 
			echo "<br>";
			$qur2 = "SELECT id FROM news_categories WHERE parent_id = $row[id]";
			$res2 = mysqli_query($db, $qur);
			if(($res2->num_rows)!=0){
				treeing($row['id'], $db, ($mult+1));
			}
			echo "</div></a>";
		}
	}
	
	function subcating($id, $db){
		$qur2 = "SELECT id FROM news_categories WHERE parent_id = $id";
		$res2 = mysqli_query($db, $qur2);
		echo " (";
		echo $res2->num_rows;
		echo " п.к.)";
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include 'header.php'; ?>
	<title>Category Tree</title>
</head>

<body>
<div id="wrapper">
		<?php include 'menu.php';?>   
        <div id="right">
            <div id="news_head"><p>Дърво c категории:</p></div>
			<br />
            <?php treeing(0, $db, 0);?>
        </div>
    </div>

</body>
</html>