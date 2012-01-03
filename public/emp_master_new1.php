<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('emp_name','father_husband_name','designation','mother_name','native_place','query_for');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	$fields_with_lengths = array('emp_name' => 50,'father_husband_name' => 50,'designation' => 20,'mother_name' => 50,'native_place' => 20);
	foreach($required_fields as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("content.php?page=".$_POST['pageid']);
	}
	
	$emp_name = ucwords(trim(mysql_prep($_POST['emp_name'])));
	$father_husband_name = ucwords(trim(mysql_prep($_POST['father_husband_name'])));
	$native_place = ucwords(trim(mysql_prep($_POST['native_place'])));
	$designation = ucwords(trim(mysql_prep($_POST['designation'])));
	$mother_name = ucwords(trim(mysql_prep($_POST['mother_name'])));
	$query_for = $_POST['query_for'];
	
	
	
	
	
	$query = "select max(empid) as maxid from employee_master";
	$sql=mysql_query($query,$conn);
	confirm_query($sql);
	$max=mysql_fetch_array($sql);
	$empid=$max['maxid']+1;
	echo $empid;
		
	$query = "insert into employee_master 
			(empid, emp_name, father_husband_name, native_place, designation, mother_name)
			 values 
			('".$empid."', '".$emp_name."','".$father_husband_name."','".$native_place."','".$designation."','".$mother_name."')";
	
	$result = mysql_query($query,$conn);
	echo $query;
	if($result){
		//redirect_to("content.php?page=".urlencode($id));
		$id=mysql_insert_id();
		echo $id;
		if ($query_for == "Other"){
			$relative_name = ucwords(trim(mysql_prep($_POST['relative_name'])));
			$relative_age = trim(mysql_prep($_POST['relative_age']));
			$relation = $_POST['relation'];
						
			if($relative_name != "" && $relative_age != "" && $relation != ""){
				$query = "select max(relative_id) as maxid from emp_relatives";
				$sql=mysql_query($query,$conn);
				confirm_query($sql);
				$max=mysql_fetch_array($sql);
				$relative_id=$max['maxid']+1;
				echo $relative_id;
				
				$query = "insert into emp_relatives 
						(relative_id, empid, relative_name, relative_age, relation)
						 values 
						('".$relative_id."', '".$id."', '".$relative_name."','".$relative_age."','".$relation."')";
				
				$result = mysql_query($query,$conn);
			}
		}
		redirect_to("content.php?page=11&empid=".$id);
	}else{
		echo "<p>Employee creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>