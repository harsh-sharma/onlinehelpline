<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/form_functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$emp_name = ucwords(trim(mysql_prep($_GET['emp_name'])));
	$father_husband_name = ucwords(trim(mysql_prep($_GET['father_husband_name'])));
	$mother_name = ucwords(trim(mysql_prep($_GET['mother_name'])));
	$native_place = ucwords(trim(mysql_prep($_GET['native_place'])));
	
	
	
	if($emp_name != "" && $father_husband_name != "" && $mother_name != "" && $native_place != ""){
		$query = "select empid from employee_master 
					where emp_name='".$emp_name."' and father_husband_name='".$father_husband_name."' 
					and mother_name='".$mother_name."' and native_place='".$native_place."'";
		$sql=mysql_query($query,$conn);
		confirm_query($sql);
		$count=mysql_num_rows($sql);
		if ($count == 0){
		
			$query = "select max(empid) as maxid from employee_master";
			$sql=mysql_query($query,$conn);
			confirm_query($sql);
			$max=mysql_fetch_array($sql);
			$empid=$max['maxid']+1;
			//echo $empid;
			
			$query = "insert into employee_master 
				(empid, emp_name, father_husband_name, mother_name, native_place)
				 values 
				('".$empid."', '".$emp_name."','".$father_husband_name."','".$mother_name."','".$native_place."')";
		
			$result = mysql_query($query,$conn);
			//echo $query;
			if($result){
				$emp=get_emp_by_id($empid);
				$employee=mysql_fetch_array($emp);
				$emp_count=mysql_num_rows($emp);?>
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
				<table width="100%" border="0" cellpadding="2" cellspacing="0">	
					<tr>
						<td style="padding-right:25px; text-align:right;">&nbsp;</td>
					</tr>
				</table>
				</fieldset>
				<br>
				
			<?php //****************************************Emp Name and Main (End)******************************************?>
		<?php }else{
				echo "<p>Employee creation failed.</p>";
				echo "<p>". mysql_error() ."</p>";
			}
		}else{
			$id=mysql_fetch_array($sql);
			$empid=$id['empid'];
			$emp=get_emp_by_id($empid);
			$employee=mysql_fetch_array($emp);
			$emp_count=mysql_num_rows($emp);?>
			<?php //****************************************Emp Name and Main (Start)****************************************?>
			<fieldset>
			<legend><b>Detail of Employee for ID</b></legend>
			<span class="mandatory">Employee already exist.</span><br>
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
			<table width="100%" border="0" cellpadding="2" cellspacing="0">	
				<tr>
					<td style="padding-right:25px; text-align:right;">&nbsp;</td>
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
								<th>Rank</th><th>District<br>(Posted)</th>
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
								<th>Sex</th><td rowspan="2">&nbsp;</td>
							</tr><tr>
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
<?php   } 
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>