<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('detail','cat_id','sub_cat_id','cat_detail_id');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	$fields_with_lengths = array('detail' => 500);
	foreach($required_fields as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("edit_sub_category_detail.php?cat_id=".$_POST['cat_id']."&sub_cat_id=".$_POST['sub_cat_id']."&cat_detail_id=".$_POST['cat_detail_id']);
	}
	
	
	$cat_id = ucwords(trim(mysql_prep($_POST['cat_id'])));
	$sub_cat_id = ucwords(trim(mysql_prep($_POST['sub_cat_id'])));
	$cat_detail_id = ucwords(trim(mysql_prep($_POST['cat_detail_id'])));
	$detail = ucwords(trim(mysql_prep($_POST['detail'])));
	
	$query = "update sub_cat_detail set detail='".$detail."' where cat_id='".$cat_id."' and sub_cat_id='".$sub_cat_id."' and cat_detail_id='".$cat_detail_id."'";
	$result = mysql_query($query,$conn);
	
	if($result){
		//redirect_to("content.php?page=".$_POST['pageid']);
		echo "<body onload=\"javascript:window.close();\">";
	}else{
		echo "<p>Category Detail creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>