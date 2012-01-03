<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('emp_name','father_husband_name','designation','mother_name','address','dob_day','dob_month','dob_year','age','gender','phone_no','native_place','district');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	$fields_with_lengths = array('emp_name' => 50,'father_husband_name' => 50,'designation' => 20,'mother_name' => 20,'address' => 300,'phone_no' => 20,'email_id' => 50,'mobile_no' => 20,'native_place' => 20);
	foreach($required_fields as $fieldname => $maxlength){
		if(strlen(trim(mysql_prep($_POST[$fieldname]))) > $maxlength){
			$errors[] = $fieldname;
		}
	}
		
	if (!empty($errors)){
		redirect_to("content.php?page=".$_POST['pageid']);
		redirect_to("edit_employee.php?empid=".$_POST['empid']);
	}
	
	$emp_name = ucwords(trim(mysql_prep($_POST['emp_name'])));
	$father_husband_name = ucwords(trim(mysql_prep($_POST['father_husband_name'])));
	$address = ucwords(trim(mysql_prep($_POST['address'])));
	$native_place = ucwords(trim(mysql_prep($_POST['native_place'])));
	$district = ucwords(trim(mysql_prep($_POST['district'])));
	$gender = mysql_prep($_POST['gender']);
	$dob_day = mysql_prep($_POST['dob_day']);
	$dob_month = mysql_prep($_POST['dob_month']);
	$dob_year = mysql_prep($_POST['dob_year']);
	$dob=$dob_year."-".$dob_month."-".$dob_day;
	$age = ucwords(trim(mysql_prep($_POST['age'])));
	$phone_no = ucwords(trim(mysql_prep($_POST['phone_no'])));
	$mobile_no = ucwords(trim(mysql_prep($_POST['mobile_no'])));
	$designation = ucwords(trim(mysql_prep($_POST['designation'])));
	$mother_name = ucwords(trim(mysql_prep($_POST['mother_name'])));
	$email_id = ucwords(trim(mysql_prep($_POST['email_id'])));
	$empid = ucwords(trim(mysql_prep($_POST['empid'])));
	
	
	$query = "update employee_master set 
			emp_name = '".$emp_name."', father_husband_name = '".$father_husband_name."', address = '".$address."', 
			native_place = '".$native_place."', district = '".$district."', gender = '".$gender."', dob = '".$dob."', 
			age = '".$age."', phone_no = '".$phone_no."', mobile_no = '".$mobile_no."', designation = '".$designation."', 
			mother_name = '".$mother_name."', email_id = '".$email_id."' 
			where empid='".$empid."'";
	
	$result = mysql_query($query,$conn);
	echo $query;
	if($result){
		
		echo "<body onload=\"javascript:window.close();\">";
	}else{
		echo "<p>Employee creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>