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
	<title>Table Categories</title>

</head>

<body>
	<div id="wrapper">
		<?php include 'menu.php';?>
        
        <div id="right">
            <div id="news_head"><p>Таблица на всички категории:</p></div>
            <div class="search"> 
            	<form action="search_categories.php" method="get">
                	<input type="text" name="name" placeholder="Име" style="height:10px; padding:5px; width:200px;"/>
					<input type="submit" value="Търси" style="margin-top:-0.2em;"/>
                </form>
            </div><br />
            
            <?php 
				$qur = "SELECT id,name,parent_id FROM news_categories";		
                $res = mysqli_query($db, $qur);
				echo "<table style='width:100%;'>";
                while($row = mysqli_fetch_array($res)){ ?>
                    <tr>
                        <td style="border:1px solid black; font-size:14px; font-weight:bold; padding:0 5px;"><?php echo $row['name']; ?></td>
                        <td style="border:1px solid black;">
                        	<form action="edit_categories.php" method="get">
                            	<input type="hidden" name="parentID" value="<?php echo $row['id'];?>"/>
                                <input type="submit" value="Покажи подкатегории"/>
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
                            <input type="hidden" name="where" value="1" />
                        	<input type="submit" value="Редактирай"/>
                        </form>
                        </td>
                    </tr>
                <?php } ?>

        </div>
    </div>

</body>
</html>

















