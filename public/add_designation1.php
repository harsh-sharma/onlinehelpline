<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('designation_name');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	$fields_with_lengths = array('designation_name' => 50);
	foreach($required_fields as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("content.php?page=".$_POST['pageid']);
	}
	
	$designation_name = ucwords(trim(mysql_prep($_POST['designation_name'])));
	
	$query = "select max(designation_id) as maxid from designation_master";
	$sql=mysql_query($query,$conn);
	confirm_query($sql);
	$max=mysql_fetch_array($sql);
	$designation_id=$max['maxid']+1;
	echo $designation_id;
	
	$query = "insert into designation_master (designation_id, designation_name) values ('".$designation_id."', '".$designation_name."')";
	$result = mysql_query($query,$conn);
	
	if($result){
		//redirect_to("content.php?page=".urlencode($id));
		redirect_to("content.php?page=".$_POST['pageid']);
	}else{
		echo "<p>Designation creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>