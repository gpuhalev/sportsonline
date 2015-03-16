<?php
	if($pagenum != 1){
		echo '<div class="prev"><a href="'.$_SERVER["PHP_SELF"].'?$pagenum=1" class="prev"><<-First</a></div> ';
		echo '<div class="prev"><a href="'.$_SERVER["PHP_SELF"].'?$pagenum='.($pagenum-1).'" class="prev"><-Prev</a></div> ';
		echo '<div class="prev"><a href="'.$_SERVER["PHP_SELF"].'?$pagenum='.($pagenum-1).'" class="prev">'.($pagenum-1).'</a></div> ';
	}else{?>
		<script>
			$(function(){
				fix_margin();
			});
		 </script>
		<?php	
	}
	echo '<div class="current_page"><a href="'.$_SERVER["PHP_SELF"].'?$pagenum='.$pagenum.'">'.$pagenum.'</a></div> ';
	if($pagenum != $all_pages){
		echo '<div class="next"><a href="'.$_SERVER["PHP_SELF"].'?$pagenum='.($pagenum+1).'" class="next">'.($pagenum+1).'</a></div> ';
		echo '<div class="next"><a href="'.$_SERVER["PHP_SELF"].'?$pagenum='.($pagenum+1).'" class="next">Next-></a></div> ';
		echo '<div class="next"><a href="'.$_SERVER["PHP_SELF"].'?$pagenum='.$all_pages.'" class="next">Last->></a></div> ';
	}
?>