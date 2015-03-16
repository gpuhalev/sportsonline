<div id="left_sidebar">
	<?php 
		$qur = "SELECT id, title FROM news WHERE is_visible = '1'";
		$res = mysqli_query($db, $qur);
		while($row = mysqli_fetch_array($res)){?>
			<a href="show_single_news.php?id=<?php echo $row['id'];?>"><?php echo $row['title'];?></a><br><br>
    	<?php } 
	?>
</div>