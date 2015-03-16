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
	<title>All Users</title>
</head>


<body>
	<div id="wrapper">
		<?php include 'menu.php';?>
        
        <div id="right">
            <div id="news_head"><p>Всички потребители:</p></div>
            <div class="search"> 
            	<form action="search_users.php" method="get">
                	<input type="text" name="username" placeholder="Потребителско име" style="height:10px; padding:5px; width:180px;"/>
                    <input type="text" name="email" placeholder="E-mail" style="height:10px; padding:5px; width:180px;"/>
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
				$data = mysqli_query($db, "SELECT id FROM users") or die(mysql_error());
				$num_of_rows = $data->num_rows;
				$all_pages = ceil($num_of_rows / $page_results);
				$min = (($pagenum-1)*$page_results);
                $qur = "SELECT id, username, email, is_admin FROM users LIMIT $min,$page_results";
				
                $res = mysqli_query($db, $qur);
                while($row = mysqli_fetch_array($res)){ ?>
                    <div class="many_news">
                        <div class="news_title"><?php echo $row['username']; ?></div>
                        <div class="news_anotation"><?php echo $row['email'];?>  -  <?php if($row['is_admin']==1){ ?>Администратор<?php }else{?>Потребител<?php }?></div>
                        <form action="delete_user.php" method="post" onsubmit="return confirm('Сигурни ли сте, че желаете да изтриете този потребител?')">
                        	<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                            <input type="submit" value="Изтрий" style="float:left;"/>
                        </form>
                        
                        <form action="edit_user.php" method="get">
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