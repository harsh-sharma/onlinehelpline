<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('desc_remark','issue_id');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	if (!empty($errors)){
		redirect_to("edit_issue.php?issue_id=".$_POST['issue_id']);
		
		//echo "<body onload=\"javascript:window.close();\">";
	}
	
	$desc_remark = ucwords(trim(mysql_prep($_POST['desc_remark'])));
	$issue_id = ucwords(trim(mysql_prep($_POST['issue_id'])));
	
	$query = "update issue_master1 set desc_remark='".$desc_remark."' where issue_id='".$issue_id."'";
	$result = mysql_query($query,$conn);
	
	if($result){
		//redirect_to("content.php?page=".urlencode($id));
		//redirect_to("content.php?page=".$_POST['pageid']);
		echo "<body onload=\"javascript:window.close();\">";
	}else{
		echo "<p>Query Updation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>