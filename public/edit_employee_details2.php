<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('emp_name','father_husband_name','mother_name','age','native_place');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	if (!empty($errors)){
		echo "Validation error occure.";
	}
	
	$emp_name = ucwords(trim(mysql_prep($_POST['emp_name'])));
	$father_husband_name = ucwords(trim(mysql_prep($_POST['father_husband_name'])));
	$mother_name = ucwords(trim(mysql_prep($_POST['mother_name'])));
	$native_place = ucwords(trim(mysql_prep($_POST['native_place'])));
	$designation = ucwords(trim(mysql_prep($_POST['designation'])));
	$district = ucwords(trim(mysql_prep($_POST['district'])));
	$dob_day = mysql_prep($_POST['dob_day']);
	$dob_month = mysql_prep($_POST['dob_month']);
	$dob_year = mysql_prep($_POST['dob_year']);
	$dob=$dob_year."-".$dob_month."-".$dob_day;
	$age = ucwords(trim(mysql_prep($_POST['age'])));
	$gender = mysql_prep($_POST['gender']);
	$email_id = ucwords(trim(mysql_prep($_POST['email_id'])));
	$phone_no = ucwords(trim(mysql_prep($_POST['phone_no'])));
	$office_no = ucwords(trim(mysql_prep($_POST['office_no'])));
	$mobile_no = ucwords(trim(mysql_prep($_POST['mobile_no'])));
	$postedin = mysql_prep($_POST['postedin']);
	$empid = ucwords(trim(mysql_prep($_POST['empid'])));
	
	
	$query = "update employee_master set 
			emp_name = '".$emp_name."', father_husband_name = '".$father_husband_name."', mother_name = '".$mother_name."', 
			native_place = '".$native_place."', designation = '".$designation."', district = '".$district."', gender = '".$gender."',  
			dob = '".$dob."', age = '".$age."', phone_no = '".$phone_no."', office_no = '".$office_no."', mobile_no = '".$mobile_no."',  
			email_id = '".$email_id."', postedin='".$postedin."' 
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