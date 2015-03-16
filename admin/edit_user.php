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
				$qur = "SELECT username, password, email,is_admin FROM users WHERE id = $id";
				$res = mysqli_query($db, $qur) or die(mysql_error());
				$row = mysqli_fetch_array($res);
			?>
            
            <div id="news_head"><p>Редактиране на потребител</p></div>
            <form action="upgrading_user.php" method="post">
                     <table>
                     	<tr>
                               <td><label for="email">E-mail: </label></td>
                               <td><input type="email" name="email" id="email" placeholder="E-mail" value="<?php echo $row['email'];?>"></td>
                          </tr>
                          <tr>
                               <td><label for="username2">Username: </label></td>
                               <td><input type="text" name="user" id="username2" placeholder="Username" value="<?php echo $row['username'];?>"></td>
                          </tr>
                          <tr>
                               <td><label for="password2">Password: </label></td>
                               <td><input type="text" name="pass" id="password2" placeholder="Password" value="<?php echo $row['password'];?>"></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td align="right"><input type="checkbox" name="is_admin" id="is_admin" <?php echo ($row['is_admin']==1 ? 'checked' : '');?>><label for="is_admin" style="font-weight:bold;">Администратор</label></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td align="right"><input type="submit" id="register_buton" value="Актуализирай"></td>
                          </tr>
                     </table>
                     <input type="hidden" name="where" value="<?php echo $where;?>" />
        	</form>
           
        </div>
    </div>

</body>
</html>