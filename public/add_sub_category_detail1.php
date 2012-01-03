<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('sub_cat_id','detail');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	$fields_with_lengths = array('detail' => 300);
	foreach($required_fields as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("content.php?page=".$_POST['pageid']);
	}
	
	$arr=explode("-",mysql_prep($_POST['sub_cat_id']));
	
	$cat_id = $arr[0];
	$sub_cat_id = $arr[1];
	$detail = ucwords(trim(mysql_prep($_POST['detail'])));
	
	$query = "select max(cat_detail_id) as maxid from sub_cat_detail where cat_id='".$cat_id."' and sub_cat_id='".$sub_cat_id."'";
	echo $query."<br>";
	$sql=mysql_query($query,$conn);
	confirm_query($sql);
	$max=mysql_fetch_array($sql);
	$cat_detail_id=$max['maxid']+1;
	echo $cat_detail_id."<br>";
	
	$query = "insert into sub_cat_detail (cat_id, sub_cat_id, cat_detail_id, detail) values ('".$cat_id."', '".$sub_cat_id."', '".$cat_detail_id."', '".$detail."')";
	$result = mysql_query($query,$conn);
	
	if($result){
		redirect_to("content.php?page=".$_POST['pageid']);
	}else{
		echo "<p>Category Detail creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>