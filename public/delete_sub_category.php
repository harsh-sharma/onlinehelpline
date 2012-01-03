<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$subcatid = mysql_prep($_GET['subcatid']);
		
	$query = "delete from sub_cat_master where subcatid = {$subcatid} limit 1";
	$result = mysql_query($query,$conn);
	
	if(mysql_affected_rows() == 1){
		redirect_to("content.php?page=3");
	}else{
		echo "<p>Sub Category deletion failed.</p>";
		echo "<p>". mysql_error ."</p>";
		echo "<a href=\"content.php\">Return to Main Page.</a>";
	}

?>


<?php if(isset($conn)) mysql_close($conn);?>