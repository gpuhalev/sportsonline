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
	<title>Add User</title>
</head>


<body>
	<div id="wrapper">
		<?php include 'menu.php';?>
        
        <div id="right">
        	<?php
				$qur = "SELECT id, name FROM news_categories";
				$resCat = mysqli_query($db, $qur) or die(mysql_error());
			?>
        
            <div id="news_head"><p>Добавяне на потребител</p></div>
            <form action="adding_user.php" method="post">
                     <table>
                     	<tr>
                               <td><label for="email">E-mail: </label></td>
                               <td><input type="email" name="email" id="email" placeholder="E-mail"></td>
                          </tr>
                          <tr>
                               <td><label for="username2">Username: </label></td>
                               <td><input type="text" name="user" id="username2" placeholder="Username" style=""></td>
                          </tr>
                          <tr>
                               <td><label for="password2">Password: </label></td>
                               <td><input type="password" name="pass" id="password2" placeholder="Password"></td>
                          </tr>
                          <tr>
                               <td><label for="rep_password">Repeat password: </label></td>
                               <td><input type="password" name="rep_pass" id="rep_password" placeholder="Repeat password"></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td align="right"><input type="checkbox" name="is_admin" id="is_admin"><label for="is_admin" style="font-weight:bold;">Администратор</label></td>
                          </tr>
                          <tr>
                            <td></td>
                            <td align="right"><input type="submit" id="register_buton" value="Добави"></td>
                          </tr>
                     </table>
        	</form>
        </div>
    </div>

</body>
</html>