<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/form_functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$empid=$_GET['empid'];
	$emp=get_emp_by_id($empid);
	$employee=mysql_fetch_array($emp);
	$emp_count=mysql_num_rows($emp);
	
	
	if($emp_count == 0){
		echo $emp_count;
		//*******************Employee not found.***************Employee not found.*********Employee not found.***********?>


<?php }else{
		//*******************Employee found.***************Employee found.*********Employee found.***********************?>
		
		
		
		<?php //****************************************Emp Name and Main (Start)****************************************?>
			<fieldset>
			<legend><b>Detail of Employee for ID</b></legend>
			<span class="mandatory">Employee ID:- <?php echo $employee['empid'];?></span>
			<input type="hidden" name="empid" value="<?php echo $employee['empid'];?>" size="15" maxlength="50" />
			<table border="1" cellpadding="2" cellspacing="0" align="center">	
				<tr>
					<th>Employee<br>Name</th><th>Father/Husband<br>Name</th><th>Mother's<br>Name</th><th>Native<br>District</th>
				</tr><tr>
					<td><input type="text" name="emp_name1" value="<?php echo $employee['emp_name'];?>" size="15" maxlength="50" readonly />&nbsp;</td>
					<td><input type="text" name="father_husband_name" value="<?php echo $employee['father_husband_name'];?>" size="15" maxlength="50" readonly />&nbsp;</td>
					<td><input type="text" name="mother_name" value="<?php echo $employee['mother_name'];?>" size="15" maxlength="10" readonly />&nbsp;</td>
					<td>
						<select name="native_place" disabled="disabled">
							<option value="">--Select--</option>
							<?php 
								$Dist=get_all_district('district_name');
								while($District=mysql_fetch_array($Dist)){
							?>
								<option value="<?php echo $District["district_id"] ;?>"
									<?php if($employee['native_place'] == $District["district_id"]){echo " selected ";} ?>>
									<?php echo ucwords($District["district_name"]) ;?>
								</option>
							<?php }?>
						</select>&nbsp;
					</td>
				</tr>
			</table>
			<table align="right">
				<tr><td><a href="#" onClick="EditForm('edit_employee_details1.php?empid=<?php echo urlencode($employee['empid']);?>')">Edit</a></td></tr>
			</table>
			</fieldset>
			<br>
			
		<?php //****************************************Emp Name and Main (End)******************************************?>
		<?php //****************************************Emp Other Info (Start)*******************************************?>
			<fieldset>
			<legend><b>Further Details of Employee</b></legend>
			<table border="0" cellpadding="2" cellspacing="0" align="center">	
				<tr>
					<td>
						<table border="1" cellpadding="2" cellspacing="0" align="center">	
							<tr>
								<th>Rank</th><th>Posted In</th>
							</tr><tr>
								<td>
									<select name="designation" disabled="disabled">
										<option value="">--Select--</option>
										<?php 
											$Desg=get_all_designation('designation_name');
											while($Designation=mysql_fetch_array($Desg)){
										?>
											<option value="<?php echo $Designation["designation_id"] ;?>"
												<?php if($employee['designation'] == $Designation["designation_id"]){echo " selected ";} ?>>
												<?php echo ucwords($Designation["designation_name"]) ;?>
											</option>
										<?php }?>
									</select>&nbsp;
								</td>
								<td>
									<select name="postedin" disabled="disabled">
										<option value="">--Select--</option>
										<?php 
											$PostIn=get_all_postedin('postedin_name');
											while($PostedIn=mysql_fetch_array($PostIn)){
										?>
											<option value="<?php echo $PostedIn["postedin_id"] ;?>"
												<?php if($employee['postedin'] == $PostedIn["postedin_id"]){echo " selected ";} ?>>
												<?php echo ucwords($PostedIn["postedin_name"]) ;?>
											</option>
										<?php }?>
									</select>&nbsp;
								</td>
							</tr><tr>
								<th>Date of Birth</th><th>Age</th>
							</tr><tr>
								<td>
									<?php
									if(isset($employee['dob'])){
										$arr=explode("-",$employee['dob']);
										$dob_year = $arr[0];
										$dob_month = $arr[1];
										$dob_day = $arr[2];
									}else{
										$dob_year = 0;
										$dob_month = 0;
										$dob_day = 0;
									}
											
									?>
									<select name="dob_day" onChange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)" disabled="disabled">
										<option value="">-D-</option>
										<?php for ($i=1;$i<=31;$i++){?>
										<option value="<?php echo $i?>" <?php if($dob_day == $i){echo " selected ";} ?>><?php echo $i?></option>
										<?php }?>
									</select>
									<select name="dob_month" onChange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)" disabled="disabled">
										<option value="">-M-</option>
										<?php for ($i=1;$i<=12;$i++){?>
										<option value="<?php echo $i?>" <?php if($dob_month == $i){echo " selected ";} ?>><?php echo showmonth($i);?></option>
										<?php }?>
									</select>
									<select name="dob_year" onChange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)" disabled="disabled">
										<option value="">-YYYY-</option>
										<?php for ($i=(date('Y')-20);$i>=(date('Y')-60) ;$i--){?>
										<option value="<?php echo $i?>" <?php if($dob_year == $i){echo " selected ";} ?>><?php echo $i?></option>
										<?php }?>
									</select>
								</td>
								<td><input type="text" name="age" value="<?php echo $employee['age'];?>" size="2" maxlength="2" readonly readonly /> Years&nbsp;</td>
							</tr><tr>
								<th>District<br>(Posted)</th><th>Sex</th>
							</tr><tr>
								
								<td>
									<select name="district" disabled="disabled">
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
									</select>&nbsp;
								</td>
								<td>
									<select name="gender" disabled="disabled">
										<option value="Male" <?php if($employee['gender'] == "Male"){echo " selected ";} ?>>Male</option>
										<option value="Female" <?php if($employee['gender'] == "Female"){echo " selected ";} ?>>Female</option>
									</select>
								</td>
							</tr>
						</table>
					</td>
					<td>
						<table border="1" cellpadding="2" cellspacing="0" align="center">	
							<tr>
								<th>Email Id</th>
							</tr><tr>
								<td><input type="text" name="email_id" value="<?php echo $employee['email_id'];?>" size="10" maxlength="50" onBlur="IsEmail(this)" readonly />&nbsp;</td>
							</tr><tr>
								<th>Phone No.</th>
							</tr><tr>
								<td align="right">
									R<input type="text" name="phone_no1" value="<?php echo $employee['phone_no'];?>" size="10" maxlength="25" onBlur="IsInteger(this)" readonly /><br>
									O<input type="text" name="office_no1" value="<?php echo $employee['office_no'];?>" size="10" maxlength="25" onBlur="IsInteger(this)" readonly /><br>
									M<input type="text" name="mobile_no1" value="<?php echo $employee['mobile_no'];?>" size="10" maxlength="25" onBlur="IsInteger(this)" readonly />
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<table align="right">
				<tr><td><a href="#" onClick="EditForm('edit_employee_details1.php?empid=<?php echo urlencode($employee['empid']);?>')">Edit</a></td></tr>
			</table>
			</fieldset>
			<br>
			
		<?php //****************************************Emp Other Info (End)*********************************************?>
<?php }?>
<?php if(isset($conn)) mysql_close($conn);?>