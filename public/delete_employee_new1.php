<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$empid = mysql_prep($_GET['empid']);
		
	$query = "delete from employee_master where empid = {$empid} limit 1";
	$result = mysql_query($query,$conn);
	
	if(mysql_affected_rows() == 1){
		echo "<body onload=\"javascript:window.close();\">";
	}else{
		echo "<p>Category deletion failed.</p>";
		echo "<p>". mysql_error ."</p>";
		echo "<a href=\"content.php\">Return to Main Page.</a>";
	}

?>


<?php if(isset($conn)) mysql_close($conn);?>