<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('cat_name');
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
		redirect_to("content.php?page=".$_POST['pageid']);
	}
	
	$cat_name = ucwords(trim(mysql_prep($_POST['cat_name'])));
	
	$query = "select max(cat_id) as maxid from cat_master";
	$sql=mysql_query($query,$conn);
	confirm_query($sql);
	$max=mysql_fetch_array($sql);
	$cat_id=$max['maxid']+1;
	echo $cat_id;
	
	$query = "insert into cat_master (cat_id, cat_name) values ('".$cat_id."', '".$cat_name."')";
	$result = mysql_query($query,$conn);
	
	if($result){
		//redirect_to("content.php?page=".urlencode($id));
		redirect_to("content.php?page=".$_POST['pageid']);
	}else{
		echo "<p>Category creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>