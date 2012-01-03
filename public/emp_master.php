<script language="javascript">
function BSave_onclick(){
	if(IsBlank(document.form1.emp_name) == false)return false;
	if(IsBlank(document.form1.father_husband_name) == false)return false;
	if(IsBlank(document.form1.designation) == false)return false;
	if(IsBlank(document.form1.sutable_time) == false)return false;
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
	PageLoad(document.form1,'emp_master1.php')
}
function EditForm(page){  
	popUpWindow=window.open(page,'popUpWindow','height=350,width=600,left=550,top=150,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}
</script>
<form action="" method="post" name="form1">
	<table border="0" cellpadding="2" cellspacing="0">
		<tr>
			<td>Name<span class="mandatory">*</span></td>
			<td><input type="text" name="emp_name" value="" size="15" maxlength="50" />&nbsp;</td>
			<td>Father/Husband Name<span class="mandatory">*</span></td>	
			<td><input type="text" name="father_husband_name" value="" size="15" maxlength="50" />&nbsp;</td>
		</tr><tr>
			<td>Designation<span class="mandatory">*</span></td>
			<td><input type="text" name="designation" value="" size="15" maxlength="20" />&nbsp;</td>
			<td>Sutable Time<span class="mandatory">*</span></td>
			<td><input type="text" name="sutable_time" value="" size="15" maxlength="20" />&nbsp;</td>
		</tr><tr>
			<td>Address<span class="mandatory">*</span></td>
			<td colspan="3"><input type="text" name="address" value="" size="50" maxlength="300" />&nbsp;</td>
		</tr><tr>
			<td>Date of Birth<span class="mandatory">*</span></td>
			<td colspan="2">
				<select name="dob_day" onchange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)">
					<option value="">-D-</option>
					<?php for ($i=1;$i<=31;$i++){?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php }?>
				</select>
				<select name="dob_month" onchange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)">
					<option value="">-M-</option>
					<?php for ($i=1;$i<=12;$i++){?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php }?>
				</select>
				<select name="dob_year" onchange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)">
					<option value="">-YYYY-</option>
					<?php for ($i=(date('Y')-20);$i>=(date('Y')-60) ;$i--){?>
					<option value="<?php echo $i?>"><?php echo $i?></option>
					<?php }?>
				</select>
			</td>
			<td>Age <input type="text" name="age" value="" size="2" maxlength="2" readonly /> Years&nbsp; </td>
		</tr><tr>
			<td>Gender<span class="mandatory">*</span></td>
			<td>
				<select name="gender">
					<option value="Male">Male</option>
					<option value="Female">Female</option>
				</select>&nbsp;
			</td>
			<td>Phone No.<span class="mandatory">*</span></td>
			<td><input type="text" name="phone_no" value="" size="10" maxlength="20" onBlur="IsInteger(this)" />&nbsp;</td>
		</tr><tr>
			<td>Email Id</td>
			<td><input type="text" name="email_id" value="" size="10" maxlength="50" onBlur="IsEmail(this)" />&nbsp;</td></td>
			<td>Mobile No.</td>
			<td><input type="text" name="mobile_no" value="" size="10" maxlength="20" onBlur="IsInteger(this)" />&nbsp;</td>
		</tr><tr>
			<td>Native Place<span class="mandatory">*</span></td>
			<td><input type="text" name="native_place" value="" size="15" maxlength="50" />&nbsp;</td>
			<td>District<span class="mandatory">*</span></td>
			<td>
				<select name="district">
					<option value="">--Select--</option>
					<?php 
						$Dist=get_all_district('district_name');
						while($District=mysql_fetch_array($Dist)){
					?>
						<option value="<?php echo $District["district_id"] ;?>"><?php echo ucwords($District["district_name"]) ;?></option>
					<?php }?>
				</select>
			</td>
		</tr><tr>
			<td colspan="4"align="center">&nbsp;</td>
		</tr><tr>
			<td colspan="4"align="center"><input type="button" value="Add" onClick="BSave_onclick();">&nbsp;</td>
		</tr>
	</table>
	<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />
</form>
<br /><br /><hr>
<h2>Employee</h2>
	<table>
		<tr align="left">
			<th>Sn.&nbsp;</th>
			<th>Id&nbsp;</th>
			<th>Employee Name&nbsp;</th>
			<th>Designation&nbsp;</th>
			<th>Native<br>Place&nbsp;</th>
			<th>District&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php 
			$emp=get_all_emp();
			$i=1;
			while($employee=mysql_fetch_array($emp)){
		?>
		<tr>
			<td><?php echo $i ; $i++;?>&nbsp;</td>
			<td><?php echo $employee["empid"] ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["emp_name"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["designation"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["native_place"]) ;?>&nbsp;</td>
			<td><?php 
					$Dist=get_district_by_id($employee['district']);
					$District=mysql_fetch_array($Dist);
					echo $District["district_name"] ;
				?>
				&nbsp;
			</td>
			<td><a href="#" onclick="EditForm('edit_employee.php?empid=<?php echo urlencode($employee['empid']);?>')">Update</a>&nbsp;</td>
			<td><a href="delete_employee.php?empid=<?php echo urlencode($employee['empid']);?>" onclick="return confirm('Are you sure you want to delete this?');">Delete</a></td>
		</tr>
		<?php }?>
	</table>