<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('cat_id','sub_cat_name');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	$fields_with_lengths = array('sub_cat_name' => 50);
	foreach($required_fields as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("content.php?page=".$_POST['pageid']);
	}
	
	$cat_id = mysql_prep($_POST['cat_id']);
	$sub_cat_name = ucwords(trim(mysql_prep($_POST['sub_cat_name'])));
	
	$query = "select max(sub_cat_id) as maxid from sub_cat_master where cat_id='".$cat_id."'";
	echo $query."<br>";
	$sql=mysql_query($query,$conn);
	confirm_query($sql);
	$max=mysql_fetch_array($sql);
	$sub_cat_id=$max['maxid']+1;
	echo $sub_cat_id."<br>";
	
	$query = "insert into sub_cat_master (cat_id, sub_cat_id, sub_cat_name) values ('".$cat_id."', '".$sub_cat_id."', '".$sub_cat_name."')";
	echo $query;
	$result = mysql_query($query,$conn);
	
	if($result){
		//redirect_to("content.php?page=".urlencode($id));
		redirect_to("content.php?page=".$_POST['pageid']);
	}else{
		echo "<p>Sub Category creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>