<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('caller_relation','call_destrict','counsel_by','cat_id','desc_remark');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	$fields_with_lengths = array('call_destrict' => 20,'counsel_by' => 20,'desc_remark' => 1000);
	foreach($required_fields as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("content.php?page=".$_POST['pageid']."&empid=".$_POST['empid']);
	}
	
	$cat_id = mysql_prep($_POST['cat_id']);
	$sub_cat_id = mysql_prep($_POST['sub_cat_id']);
	$cat_detail_id = mysql_prep($_POST['cat_detail_id']);
	$emp_id = mysql_prep($_POST['empid']);
	$desc_remark = ucwords(trim(mysql_prep($_POST['desc_remark'])));
	$caller_relation = mysql_prep($_POST['caller_relation']);
	$call_destrict = ucwords(trim(mysql_prep($_POST['call_destrict'])));
	$counsel_by = ucwords(trim(mysql_prep($_POST['counsel_by'])));
	
	$query = "select max(issue_id) as maxid from issue_master";
	echo $query."<br>";
	$sql=mysql_query($query,$conn);
	confirm_query($sql);
	$max=mysql_fetch_array($sql);
	$issue_id=$max['maxid']+1;
	echo $issue_id."<br>";
	
	$query = "insert into issue_master 
			(issue_id, cat_id, sub_cat_id, cat_detail_id, emp_id, desc_remark, caller_relation, call_destrict, counsel_by) 
			values 
			('".$issue_id."', '".$cat_id."', '".$sub_cat_id."', '".$cat_detail_id."', '".$emp_id."', '".$desc_remark."', '".$caller_relation."', '".$call_destrict."', '".$counsel_by."')";
	echo $query;
	$result = mysql_query($query,$conn);
	
	if($result){
		//redirect_to("content.php?page=".urlencode($id));
		redirect_to("content.php?page=".$_POST['pageid']."&empid=".$_POST['empid']);
	}else{
		echo "<p>Issue creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>