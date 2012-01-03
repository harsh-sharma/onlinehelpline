<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$designation_id = mysql_prep($_GET['designation_id']);
		
	$query = "delete from designation_master where designation_id = {$designation_id} limit 1";
	$result = mysql_query($query,$conn);
	
	if(mysql_affected_rows() == 1){
		redirect_to("content.php?page=19");
	}else{
		echo "<p>Designation deletion failed.</p>";
		echo "<p>". mysql_error ."</p>";
		echo "<a href=\"content.php\">Return to Main Page.</a>";
	}

?>


<?php if(isset($conn)) mysql_close($conn);?>