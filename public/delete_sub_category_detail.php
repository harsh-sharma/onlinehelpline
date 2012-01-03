<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$catdetailid = mysql_prep($_GET['catdetailid']);
		
	$query = "delete from sub_cat_detail where catdetailid = {$catdetailid} limit 1";
	$result = mysql_query($query,$conn);
	
	if(mysql_affected_rows() == 1){
		redirect_to("content.php?page=4");
	}else{
		echo "<p>Category Detail deletion failed.</p>";
		echo "<p>". mysql_error ."</p>";
		echo "<a href=\"content.php\">Return to Main Page.</a>";
	}

?>


<?php if(isset($conn)) mysql_close($conn);?>