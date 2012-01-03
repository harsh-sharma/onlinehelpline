<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<html>
	<head>
		<title>Edit Employee</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body bgcolor="#eee4b9">
		<table align="center" width="100%" height="100%"><tr><td>
			<tr>
				<td id="page">
					<h2>Edit Employee</h2>
					<script language="javascript">
					function BSave_onclick(){
						if(IsBlank(document.form1.emp_name) == false)return false;
						if(IsBlank(document.form1.designation) == false)return false;
						if(IsBlank(document.form1.mother_name) == false)return false;
						if(IsBlank(document.form1.father_husband_name) == false)return false;
						if(IsBlank(document.form1.address) == false)return false;
						if(IsBlank(document.form1.dob_day) == false)return false;
						if(IsBlank(document.form1.dob_month) == false)return false;
						if(IsBlank(document.form1.dob_year) == false)return false;
						if(IsBlank(document.form1.age) == false)return false;
						if(IsBlank(document.form1.gender) == false)return false;
						if(IsBlank(document.form1.phone_no) == false)return false;
						if(IsBlank(document.form1.native_place) == false)return false;
						if(IsBlank(document.form1.district) == false)return false;
						if(IsInteger(document.form1.phone_no) == false)return false;
						if(IsInteger(document.form1.mobile_no) == false)return false;
						if(IsEmail(document.form1.email_id) == false)return false;
						PageLoad(document.form1,'edit_employee_new1.php')
					}
					</script>
					<?php
						$empid=$_GET['empid'];
						$emp=get_emp_by_id($empid);
						$employee=mysql_fetch_array($emp) 
					?>
					<form action="" method="post" name="form1">
						<table border="0" cellpadding="2" cellspacing="0">
							<tr>
								<td>Name<span class="mandatory">*</span></td>
								<td><input type="text" name="emp_name" value="<?php echo $employee['emp_name'];?>" size="15" maxlength="50" />&nbsp;</td>
								<td>Designation<span class="mandatory">*</span></td>
								<td><input type="text" name="designation" value="<?php echo $employee['designation'];?>" size="15" maxlength="20" />&nbsp;</td>
							</tr><tr>
								<td>Mother's Name<span class="mandatory">*</span></td>	
								<td><input type="text" name="mother_name" value="<?php echo $employee['mother_name'];?>" size="15" maxlength="50" />&nbsp;</td>
								<td>Father/Husband Name<span class="mandatory">*</span></td>	
								<td><input type="text" name="father_husband_name" value="<?php echo $employee['father_husband_name'];?>" size="15" maxlength="50" />&nbsp;</td>
							</tr><tr>
								<td>Address<span class="mandatory">*</span></td>
								<td colspan="3"><input type="text" name="address" value="<?php echo $employee['address'];?>" size="50" maxlength="300" />&nbsp;</td>
							</tr><tr>
								<td>Date of Birth<span class="mandatory">*</span></td>
								<td colspan="2">
									<?php
									$arr=explode("-",$employee['dob']);
									$dob_year = $arr[0];
									$dob_month = $arr[1];
									$dob_day = $arr[2];								
									?>
									<select name="dob_day" onChange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)">
										<option value="">-D-</option>
										<?php for ($i=1;$i<=31;$i++){?>
										<option value="<?php echo $i?>" <?php if($dob_day == $i){echo " selected ";} ?>><?php echo $i?></option>
										<?php }?>
									</select>
									<select name="dob_month" onChange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)">
										<option value="">-M-</option>
										<?php for ($i=1;$i<=12;$i++){?>
										<option value="<?php echo $i?>" <?php if($dob_month == $i){echo " selected ";} ?>><?php echo $i?></option>
										<?php }?>
									</select>
									<select name="dob_year" onChange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)">
										<option value="">-YYYY-</option>
										<?php for ($i=(date('Y')-20);$i>=(date('Y')-60) ;$i--){?>
										<option value="<?php echo $i?>" <?php if($dob_year == $i){echo " selected ";} ?>><?php echo $i?></option>
										<?php }?>
									</select>
								</td>
								<td>Age <input type="text" name="age" value="<?php echo $employee['age'];?>" size="2" maxlength="2" readonly /> Years&nbsp; </td>
							</tr><tr>
								<td>Gender<span class="mandatory">*</span></td>
								<td>
									<select name="gender">
										<option value="Male" <?php if($employee['gender'] == "Male"){echo " selected ";} ?>>Male</option>
										<option value="Female" <?php if($employee['gender'] == "Female"){echo " selected ";} ?>>Female</option>
									</select>&nbsp;
								</td>
								<td>Phone No.<span class="mandatory">*</span></td>
								<td><input type="text" name="phone_no" value="<?php echo $employee['phone_no'];?>" size="10" maxlength="20" onBlur="IsInteger(this)" />&nbsp;</td>
							</tr><tr>
								<td>Email Id</td>
								<td><input type="text" name="email_id" value="<?php echo $employee['email_id'];?>" size="10" maxlength="50" onBlur="IsEmail(this)" />&nbsp;</td></td>
								<td>Mobile No.</td>
								<td><input type="text" name="mobile_no" value="<?php echo $employee['mobile_no'];?>" size="10" maxlength="20" onBlur="IsInteger(this)" />&nbsp;</td>
							</tr><tr>
								<td>Native Place<span class="mandatory">*</span></td>
								<td><input type="text" name="native_place" value="<?php echo $employee['native_place'];?>" size="15" maxlength="50" />&nbsp;</td>
								<td>District<span class="mandatory">*</span></td>
								<td>
									<select name="district">
										<option value="">--Select--</option>
										<?php 
											$Dist=get_all_district('district_name');
											while($District=mysql_fetch_array($Dist)){
										?>
											<option value="<?php echo $District["district_id"] ;?>"
												<?php if($employee['district'] == $District["district_id"]){echo " selected ";} ?>>
												<?php echo ucwords($District["district_name"]) ;?>
											</option>
										<?php }?>
									</select>
								</td>
							</tr><tr>
								<td colspan="4"align="center"><input type="button" value="Edit" onClick="BSave_onclick();">&nbsp;</td>
							</tr>
							<input type="hidden" name="empid" value="<?php echo $_GET['empid'];?>" />
						</table>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>
