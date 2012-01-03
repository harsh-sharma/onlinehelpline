<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('cat_name','cat_id');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	$fields_with_lengths = array('cat_name' => 50);
	foreach($fields_with_lengths as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("edit_category.php?cat_id=".$_POST['cat_id']);
		
		//echo "<body onload=\"javascript:window.close();\">";
	}
	
	$cat_name = ucwords(trim(mysql_prep($_POST['cat_name'])));
	$cat_id = ucwords(trim(mysql_prep($_POST['cat_id'])));
	
	$query = "update cat_master set cat_name='".$cat_name."' where cat_id='".$cat_id."'";
	$result = mysql_query($query,$conn);
	
	if($result){
		//redirect_to("content.php?page=".urlencode($id));
		//redirect_to("content.php?page=".$_POST['pageid']);
		echo "<body onload=\"javascript:window.close();\">";
	}else{
		echo "<p>Category Updation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>