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
	<title>Edit News</title>
	<script src="../ckeditor/ckeditor.js"></script>
</head>


<body>
	<div id="wrapper">
		<?php include 'menu.php';?>
        
        <div id="right">
        	<?php 
				$id = $_REQUEST['id'];
				$qur = "SELECT id,title,anotation,content,images FROM news WHERE id = '$id'";
                $res = mysqli_query($db, $qur) or die(mysql_error());
				$row = mysqli_fetch_array($res);
			?>
            
            <?php
				$qur = "SELECT id, name FROM news_categories";
				$resCat = mysqli_query($db, $qur) or die(mysql_error());
			?>
            
            <div id="news_head"><p>Редактиране на новина</p></div>
            <form action="upgrading_news.php" method="post">
            
            	<input type="hidden" name="id" value="<?php echo $id ?>" />
                
                <div id="news_item"><p>Заглавие:</p></div>
                <input type="text" name="title" value="<?php echo $row['title'];?>" />
                
                <div id="news_item"><p>Категория:</p></div>
                <select name="category">
					<?php
                        while($rowCat = mysqli_fetch_array($resCat)){
                    ?>
                      <option value="<?php echo $rowCat['id']?>"><?php echo $rowCat['name']?></option>  
                    <?php }?>
                </select>
                
                <div id="news_item"><p>Анотация:</p></div>
                <textarea rows="2" cols="60" name="anotation"/><?php echo $row['anotation'];?></textarea>
                
                <div id="news_item"><p>Съдържание:</p></div>
            	<textarea rows="10" cols="60" name="content"/><?php echo $row['content'];?></textarea>
                
                <script>
					CKEDITOR.replace( 'content' );
				</script>
                
				<div id="news_item"><p>Да е видима ли новината за потребителите?</p></div>
                <input type="radio" name="visibility" value="1" checked="checked"/>ДА<br />
                <input type="radio" name="visibility" value="0"/>НЕ<br />

				<input type="hidden" name="where" value="<?php echo $where;?>" />                

                <input type="submit" value="Запази промените"/>
            </form>
           
        </div>
    </div>

</body>
</html>