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
	<title>Table Users</title>

</head>

<body>
	<div id="wrapper">
		<?php include 'menu.php';?>
        
        <div id="right">
            <div id="news_head"><p>Таблица на всички потребители:</p></div>
            <div class="search"> 
            	<form action="search_users.php" method="get">
                	<input type="text" name="username" placeholder="Потребителско име" style="height:10px; padding:5px; width:180px;"/>
                    <input type="text" name="email" placeholder="E-mail" style="height:10px; padding:5px; width:180px;"/>
					<input type="submit" value="Търси" style="margin-top:-0.2em;"/>
                </form>
            </div><br />
            
            <?php 
				$qur = "SELECT id,username FROM users";		
                $res = mysqli_query($db, $qur);
				echo "<table style='width:100%;'>";
                while($row = mysqli_fetch_array($res)){ ?>
                    <tr>
                        <td style="border:1px solid black; font-size:14px; font-weight:bold; padding:0 5px; width:70%;"><?php echo $row['username']; ?></td>
                        <td style="border:1px solid black;">
						<form action="delete_user.php" method="post" onsubmit="return confirm('Сигурни ли сте, че желаете да изтриете този потребител?')">
                        	<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                            <input type="submit" value="Изтрий" style="float:left;"/>
                        </form>
                        <form action="edit_user.php" method="get">
                        	<input type="hidden" name="where" value="1" />
                        	<input type="hidden" name="id" value="<?php echo $row['id'];?>"/>
                        	<input type="submit" value="Редактирай"/>
                        </form>
                        </td>
                    </tr>
                <?php } ?>

        </div>
    </div>

</body>
</html>

















