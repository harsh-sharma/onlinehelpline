<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('district_name');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	$fields_with_lengths = array('district_name' => 50);
	foreach($required_fields as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("content.php?page=".$_POST['pageid']);
	}
	
	$district_name = ucwords(trim(mysql_prep($_POST['district_name'])));
	
	$query = "select max(district_id) as maxid from district_master";
	$sql=mysql_query($query,$conn);
	confirm_query($sql);
	$max=mysql_fetch_array($sql);
	$district_id=$max['maxid']+1;
	echo $district_id;
	
	$query = "insert into district_master (district_id, district_name) values ('".$district_id."', '".$district_name."')";
	$result = mysql_query($query,$conn);
	
	if($result){
		//redirect_to("content.php?page=".urlencode($id));
		redirect_to("content.php?page=".$_POST['pageid']);
	}else{
		echo "<p>District creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>