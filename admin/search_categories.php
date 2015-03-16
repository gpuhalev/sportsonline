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
	<title>Search result:</title>
</head>


<body>
	<div id="wrapper">
		<?php include 'menu.php';?>
        
        <div id="right">
            <div id="news_head"><p>Резултат от търсенето:</p></div>
            
            <?php
				$name = $_REQUEST['name'];
			?>
            
            <div class="search"> 
            	<form action="search_categories.php" method="get">
                	<input type="text" name="name" placeholder="Име" value="<?php echo $name;?>" style="height:10px; padding:5px; width:150px;"/>
					<input type="submit" value="Търси" style="margin-top:-0.2em;"/>
                </form>
            </div><br />
            
            <?php 
				$qur = "SELECT id,name FROM news_categories";
				if($name !== ''){
					$qur .= " WHERE LOWER(name) LIKE LOWER('%$name%')";
				}
                $res = mysqli_query($db, $qur);
                while($row = mysqli_fetch_array($res)){ ?>
                        <div class="many_news">
                            <div class="news_title"><?php echo $row['name']; ?></div>
                        
                            <form action="delete_category.php" method="post" onsubmit="return confirm('Сигурни ли сте, че желаете да изтриете тази категория?')">
                                <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                                <input type="submit" value="Изтрий" style="float:left;"/>
                            </form>
                            
                            <form action="edit_category.php" method="get">
                                <input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                                <input type="submit" value="Редактирай"/>
                            </form>
                            
                        </div>
                        <br />
                <?php } ?>
        </div>
    </div>

</body>
</html>