<?php 
	session_start();
	require_once('connections/connect_to_db.php');
	$db->set_charset("utf8");
	if ($_SESSION['loggedIn'] == "false"){
		header("Location: index.php");	
	}
	
	
	function pathination($parentIDiU, $db){
		$qur = "SELECT id,name,parent_id FROM news_categories WHERE id = $parentIDiU";
		$res = mysqli_query($db, $qur);
		$row = mysqli_fetch_array($res);
		echo "<span style='float:right'><a href='edit_categories.php?parentID=".$row['id']."'>".$row['name']."</a> >> </span>";
		if($row['parent_id'] != 0){
			pathination($row['parent_id'], $db);
		}
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php include 'header.php'; ?>
	<title>Categories</title>
</head>


<body>
<div id="wrapper">
		<?php include 'menu.php';?>
        
        <div id="right">
        	<?php 
				if(!(isset($_REQUEST['parentID']))){ 
					$parentID = 0; 
				}else{
					$parentID = $_REQUEST['parentID'];
				}
			?>
            
            <div id="news_head"><p>Всички категории:</p></div>
            
            <div class="search"> 
            	<form action="search_categories.php" method="get">
                	<input type="text" name="name" placeholder="Име" style="height:10px; padding:5px; width:200px;"/>
					<input type="submit" value="Търси" style="margin-top:-0.2em;"/>
                </form>
            </div>
            
            <div id="cat_path" style="float:left">
	            <br />
            	<?php 
					echo "<a href='edit_categories.php'>Началo</a> >> ";
					if($parentID!=0)
						pathination($parentID, $db); 
				?>
            </div>
            <br />
            <br />
            <br />
            
            <?php 
				
                $qur = "SELECT id,name,parent_id FROM news_categories WHERE parent_id = $parentID";
                $res = mysqli_query($db, $qur);
                while($row = mysqli_fetch_array($res)){ ?>
                    <div class="many_news">
                        <div class="news_title"><?php echo $row['name']; ?>
                        	<form action="edit_categories.php" method="get">
                            	<input type="hidden" name="parentID" value="<?php echo $row['id'];?>"/>
                                <input type="submit" value="Покажи подкатегории" style="float:right; margin-top:-1.8em;"/>
                        	</form>
                        </div>
                        
                        <form method="get" onsubmit="
						<?php 
							$id = $row['id'];
							$qur2 = "SELECT id FROM news_categories WHERE parent_id = $id";
							$res2 = mysqli_query($db, $qur2);
							if(($res2->num_rows)!=0){
								echo "alert('Категорията, която се опитвате да изтриете има подкатегории. Моля, първо изтрийте тях.')";
							}else{
								echo "return confirm('Сигурни ли сте, че желаете да изтриете тази категория?')";
							}?>"
						<?php 
							if(($res2->num_rows)==0)
								echo 'action="deleting_category.php"';
						?>
                            >
                        	<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                            <input type="hidden" name="parentID" value="<?php echo $row['parent_id'];?>"/>
                            <input type="submit" value="Изтрий" style="float:left;"/>
                        </form>
                        
                        <form action="edit_category.php" method="get">
                        	<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                        	<input type="submit" value="Редактирай"/>
                        </form>
                        
                    </div>
                    <br />
			<?php } ?>
            <form action="add_category.php" method="get">
                <input type="hidden" name="parentID" value="<?php echo $parentID;?>" />
                <input type="submit" value="Добави категория тук" style="float:left;"/>
            </form>
        </div>
    </div>

</body>
</html>