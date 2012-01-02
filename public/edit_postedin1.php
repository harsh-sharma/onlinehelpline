<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('postedin_name','postedin_id');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	$fields_with_lengths = array('postedin_name' => 50);
	foreach($required_fields as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("edit_postedin.php?postedin_id=".$_POST['postedin_id']);
		
		//echo "<body onload=\"javascript:window.close();\">";
	}
	
	$postedin_name = ucwords(trim(mysql_prep($_POST['postedin_name'])));
	$postedin_id = ucwords(trim(mysql_prep($_POST['postedin_id'])));
	
	$query = "update postedin_master set postedin_name='".$postedin_name."' where postedin_id='".$postedin_id."'";
	$result = mysql_query($query,$conn);
	
	if($result){
		//redirect_to("content.php?page=".urlencode($id));
		//redirect_to("content.php?page=".$_POST['pageid']);
		echo "<body onload=\"javascript:window.close();\">";
	}else{
		echo "<p>PostedIn Updation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>