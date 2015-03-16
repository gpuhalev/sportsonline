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
	<title>All News</title>

</head>

<body>
	<div id="wrapper">
		<?php include 'menu.php';?>
        
        <div id="right">
            <div id="news_head"><p>Всички новини:</p></div>
            <div class="search"> 
            	<form action="search_news.php" method="get">
                	<input type="text" name="title" placeholder="Заглавие" style="height:10px; padding:5px; width:150px;"/>
                    <input type="text" name="anotation" placeholder="Анотация" style="height:10px; padding:5px; width:150px;"/>
                    <input type="text" name="content" placeholder="Съдържание" style="height:10px; padding:5px; width:150px;"/>
					<input type="submit" value="Търси" style="margin-top:-0.2em;"/>
                </form>
            </div><br />
            
            <?php 
				if(!(isset($_REQUEST['$pagenum']))){ 
					$pagenum = 1; 
				}else{
					$pagenum = $_REQUEST['$pagenum'];
				}

				$page_results = 5;
				$data = mysqli_query($db, "SELECT id FROM news") or die(mysql_error());
				$num_of_rows = $data->num_rows;
				$all_pages = ceil($num_of_rows / $page_results);
				$min = (($pagenum-1)*$page_results);
				$qur = "SELECT id,title,anotation FROM news LIMIT $min,$page_results";
				
				
                $res = mysqli_query($db, $qur);
                while($row = mysqli_fetch_array($res)){ ?>
                    <div class="many_news">
                        <div class="news_title"><?php echo $row['title']; ?></div>
                        <div class="news_anotation"><?php echo $row['anotation']; ?></div>
                        <form action="delete_news.php" method="post" onsubmit="return confirm('Сигурни ли сте, че желаете да изтриете тази новина?')">
                        	<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                            <input type="submit" value="Изтрий" style="float:left;"/>
                        </form>
                        
                        <form action="edit_news.php" method="get">
                        	<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                        	<input type="submit" value="Редактирай"/>
                        </form>
                        
                    </div>
                    <br />
                <?php } ?>
                
            <div id="paging">
                <?php include "pagination.php" ?>
            </div>
            
        </div>
    </div>

</body>
</html>

















