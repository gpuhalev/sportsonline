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
				$title = $_REQUEST['title'];
				$anotation = $_REQUEST['anotation'];
				$content = $_REQUEST['content'];
			?>
            
            <div class="search"> 
            	<form action="search_news.php" method="get">
                	<input type="text" name="title" placeholder="Заглавие" value="<?php echo $title ?>" style="height:10px; padding:5px; width:150px;"/>
                    <input type="text" name="anotation" placeholder="Анотация" value="<?php echo $anotation ?>" style="height:10px; padding:5px; width:150px;"/>
                    <input type="text" name="content" placeholder="Съдържание" value="<?php echo $content ?>" style="height:10px; padding:5px; width:150px;"/>
					<input type="submit" value="Търси" style="margin-top:-0.2em;"/>
                </form>
            </div><br />
            
            <?php 
				$qur = "SELECT id,title,anotation,content FROM news";
				if($title !== ''){
					$qur .= " WHERE LOWER(title) LIKE LOWER('%$title%')";
						if($anotation !== ''){
							$qur .= " OR LOWER(anotation) LIKE LOWER('%$anotation%')";
							if($content !== ''){
								$qur .= " OR LOWER(content) LIKE LOWER('%$content%')";
							}
						}else if($content !== ''){
							$qur .= " OR LOWER(content) LIKE LOWER('%$content%')";
						}
				}else if($anotation !== ''){
					$qur .= " WHERE LOWER(anotation) LIKE LOWER('%$anotation%')";
					if($content !== ''){
						$qur .= " OR LOWER(content) LIKE LOWER('%$content%')";
					}
				}else if($content !== ''){
					$qur .= " WHERE LOWER(content) LIKE LOWER('%$content%')";
				}
				
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
        </div>
    </div>

</body>
</html>