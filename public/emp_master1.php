<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('emp_name','father_husband_name','designation','sutable_time','address','dob_day','dob_month','dob_year','age','gender','phone_no','native_place','district');
	foreach($required_fields as $fieldname){
		if (!isset($_POST[$fieldname]) || empty($_POST[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	
	$fields_with_lengths = array('emp_name' => 50,'father_husband_name' => 50,'designation' => 20,'sutable_time' => 20,'address' => 300,'phone_no' => 20,'email_id' => 50,'mobile_no' => 20,'native_place' => 20);
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
	$sutable_time = ucwords(trim(mysql_prep($_POST['sutable_time'])));
	$email_id = ucwords(trim(mysql_prep($_POST['email_id'])));
	
	
	$query = "select max(empid) as maxid from employee_master";
	$sql=mysql_query($query,$conn);
	confirm_query($sql);
	$max=mysql_fetch_array($sql);
	$empid=$max['maxid']+1;
	echo $empid;
		
	$query = "insert into employee_master 
			(empid, emp_name, father_husband_name, address, native_place, district, gender, dob, age, phone_no, mobile_no, designation, sutable_time, email_id)
			 values 
			('".$empid."', '".$emp_name."','".$father_husband_name."','".$address."','".$native_place."','".$district."','".$gender."','".$dob."','".$age."','".$phone_no."','".$mobile_no."','".$designation."','".$sutable_time."','".$email_id."')";
	
	$result = mysql_query($query,$conn);
	echo $query;
	if($result){
		//redirect_to("content.php?page=".urlencode($id));
		redirect_to("content.php?page=".$_POST['pageid']);
	}else{
		echo "<p>Employee creation failed.</p>";
		echo "<p>". mysql_error() ."</p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>