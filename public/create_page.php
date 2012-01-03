<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('form_name','file_name','form_type');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	$fields_with_lengths = array('form_name' => 500,'file_name' => 50);
	foreach($required_fields as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("content.php?page=".$_POST['pageid']);
	}
	
	$form_name = trim(mysql_prep($_POST['form_name']));
	$file_name = trim(mysql_prep($_POST['file_name']));
	$form_type = mysql_prep($_POST['form_type']);
	$visible =  mysql_prep($_POST['visible']);
	
	$query = "insert into form_master 
				(form_name, file_name, form_type, visible) values 
				('".$form_name."','".$file_name."','".$form_type."','".$visible."')";
	$result = mysql_query($query,$conn);
	
	if($result){
		$id=mysql_insert_id();
		$query = "insert into profile_master 
					(form_id, user_type) values 
					('".$id."','admin')";
		$result = mysql_query($query,$conn);
		//redirect_to("content.php?page=".urlencode($id));
		redirect_to("content.php");
	}else{
		echo "<p>Page creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>