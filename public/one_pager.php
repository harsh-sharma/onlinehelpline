<script type="text/javascript" src="javascripts/one_pager_js.js"></script>
<form action="" method="post" name="form1">
<?php //****************************************UID (Start)******************************************************?>
	<fieldset>
	<legend><b>ID</b></legend>
	<table border="1" cellpadding="2" cellspacing="0" align="center">	
		<tr>
			<th>Employee Id<span class="mandatory">*</span></th><td><input type="text" name="find_empid" value="" size="5" maxlength="10" onblur="checkid()" />&nbsp;</td>
		</tr>
	</table>
	<div id="check" align="center"></div>
	</fieldset>
	<br>
<?php //****************************************UID (End)********************************************************?>
<div id="check_id"></div>
<?php //****************************************Emp Name and Main (Start)****************************************?>
	<div id="div2" style="display: none;">
	<fieldset>
	<legend><b>Detail of Employee for ID</b></legend>
	<table border="1" cellpadding="2" cellspacing="0" align="center">	
		<tr>
			<th>Employee<br>Name<span class="mandatory">*</span></th>
			<th>Father/Husband<br>Name<span class="mandatory">*</span></th>
			<th>Mother's<br>Name<span class="mandatory">*</span></th>
			<th>Native<br>District<span class="mandatory">*</span></th>
		</tr><tr>
			<td><input type="text" name="emp_name" value="" size="15" maxlength="50" />&nbsp;</td>
			<td><input type="text" name="father_husband_name" value="" size="15" maxlength="50" />&nbsp;</td>
			<td><input type="text" name="mother_name" value="" size="15" maxlength="50" />&nbsp;</td>
			<td>
				<select name="native_place">
					<option value="">--Select--</option>
					<?php 
						$Dist=get_all_district('district_name');
						while($District=mysql_fetch_array($Dist)){
					?>
						<option value="<?php echo $District["district_id"] ;?>"><?php echo ucwords($District["district_name"]) ;?></option>
					<?php }?>
				</select>&nbsp;
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="2" cellspacing="0">	
		<tr>
			<td style="padding-right:25px; text-align:right;"><input type="button" name ="Go2" value="Go" onclick="add_employee()"></td>
		</tr>
	</table>
	</fieldset>
	<br>
	</div>
<?php //****************************************Emp Name and Main (End)******************************************?>
<?php //****************************************Emp Other Info (Start)*******************************************?>
	<div id="div3" style="display: none;">
	<fieldset>
	<legend><b>Further Details of Employee</b></legend>
	<table border="0" cellpadding="2" cellspacing="0" align="center">	
		<tr>
			<td>
				<table border="1" cellpadding="2" cellspacing="0" align="center">	
					<tr>
						<th>Rank<span class="mandatory">*</span></th><th>Posted In<span class="mandatory">*</span></th>
					</tr><tr>
						<td>
							<select name="designation">
								<option value="">--Select--</option>
								<?php 
									$Desg=get_all_designation('designation_name');
									while($Designation=mysql_fetch_array($Desg)){
								?>
									<option value="<?php echo $Designation["designation_id"] ;?>"><?php echo ucwords($Designation["designation_name"]) ;?></option>
								<?php }?>
							</select>&nbsp;
						</td>
						<td>
							<select name="postedin">
								<option value="">--Select--</option>
								<?php 
									$PostIn=get_all_postedin('postedin_name');
									while($PostedIn=mysql_fetch_array($PostIn)){
								?>
									<option value="<?php echo $PostedIn["postedin_id"] ;?>"><?php echo ucwords($PostedIn["postedin_name"]) ;?></option>
								<?php }?>
							</select>&nbsp;
						</td>
					</tr><tr>
						<th>Date of Birth</th><th>Age<span class="mandatory">*</span></th>
					</tr><tr>
						<td>
							<select name="dob_day" onChange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)">
								<option value="">-D-</option>
								<?php for ($i=1;$i<=31;$i++){?>
								<option value="<?php echo $i?>"><?php echo $i?></option>
								<?php }?>
							</select>
							<select name="dob_month" onChange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)">
								<option value="">-M-</option>
								<?php for ($i=1;$i<=12;$i++){?>
								<option value="<?php echo $i?>"><?php echo showmonth($i);?></option>
								<?php }?>
							</select>
							<select name="dob_year" onChange="calulate_age(document.form1.dob_day,document.form1.dob_month,document.form1.dob_year,document.form1.age)">
								<option value="">-YYYY-</option>
								<?php for ($i=(date('Y')-20);$i>=(date('Y')-60) ;$i--){?>
								<option value="<?php echo $i?>"><?php echo $i?></option>
								<?php }?>
							</select>
						</td>
						<td><input type="text" name="age" value="" size="2" maxlength="2" onBlur="IsInteger(this)" /> Years&nbsp;</td>
					</tr><tr>
						<th>District<br>(Posted)<span class="mandatory">*</span></th><th>Sex<span class="mandatory">*</span></th>
					</tr><tr>
						
						<td>
							<select name="district">
								<option value="">--Select--</option>
								<?php 
									$Dist=get_all_district('district_name');
									while($District=mysql_fetch_array($Dist)){
								?>
									<option value="<?php echo $District["district_id"] ;?>"><?php echo ucwords($District["district_name"]) ;?></option>
								<?php }?>
							</select>&nbsp;
						</td>
						<td>
							<select name="gender">
								<option value="">--Select--</option>
								<option value="Male">Male</option>
								<option value="Female">Female</option>
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
						<td><input type="text" name="email_id" value="" size="10" maxlength="50" onBlur="IsEmail(this)" />&nbsp;</td>
					</tr><tr>
						<th>Phone No.</th>
					</tr><tr>
						<td align="right">
							R<input type="text" name="phone_no" value="" size="10" maxlength="25" onBlur="IsInteger(this)" /><br>
							O<input type="text" name="office_no" value="" size="10" maxlength="25" onBlur="IsInteger(this)" /><br>
							M<input type="text" name="mobile_no" value="" size="10" maxlength="25" onBlur="IsInteger(this)" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="2" cellspacing="0">	
		<tr>
			<td style="padding-right:25px; text-align:right;"><input type="button" name ="Go3" value="Go" onclick="add_more_employee()"></td>
		</tr>
	</table>
	</fieldset>
	<br>
	</div>
<?php //****************************************Emp Other Info (End)*********************************************?>
<?php //****************************************Query Asked By/For (Start)***************************************?>
	<div id="div4" style="display: none;">
	<fieldset>
	<legend><b>Question asked By / For</b></legend>
	<table border="1" cellpadding="2" cellspacing="0" align="center">	
		<tr>
			<th>Question<br>By<span class="mandatory">*</span></th>
			<th>Question<br>For<span class="mandatory">*</span></th>
		</tr><tr>
			<td>
				<select name="query_by">
					<option value="">--Select--</option>
					<option value="Employee">Employee</option>
					<option value="Relative">Relative</option>
				</select>&nbsp;
			</td>
			<td>
				<select name="query_for">
					<option value="">--Select--</option>
					<option value="Employee">Employee</option>
					<option value="Relative">Relative</option>
				</select>&nbsp;
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="2" cellspacing="0">	
		<tr>
			<td style="padding-right:25px; text-align:right;"><input type="button" name ="Go4" value="Go" onclick="question_by_for();"></td>
		</tr>
	</table>
	</fieldset>
	<br>
	</div>
<?php //****************************************Query Asked By/For (End)*****************************************?>
<div id="relative_detail" style="display: none;"></div>
<?php //****************************************Add Relative (Start)*********************************************?>
	<div id="div6" style="display: none;">
	<fieldset>
	<legend><b>ADD Relative</b></legend>
	<table border="1" cellpadding="2" cellspacing="0" align="center">	
		<tr>
			<th>Relative<br>Name<span class="mandatory">*</span></th>
			<th>Father's<br>Name<span class="mandatory">*</span></th>
			<th>Mother's<br>Name<span class="mandatory">*</span></th>
			<th>Relation<span class="mandatory">*</span></th>
		</tr><tr>
			<td><input type="text" name="relative_name" value="" size="15" maxlength="50" />&nbsp;</td>
			<td><input type="text" name="relative_father_name" value="NA" size="15" maxlength="50" />&nbsp;</td>
			<td><input type="text" name="relative_mother_name" value="NA" size="15" maxlength="10" />&nbsp;</td>
			<td>
				<select name="relation">
					<option value="">--Select--</option>
					<option value="Brother">Brother</option>
					<option value="Sister">Sister</option>
					<option value="Mother">Mother</option>
					<option value="Father">Father</option>
					<option value="Children">Children</option>
					<option value="Husband">Husband</option>
					<option value="Wife">Wife</option>
					<option value="MotherInLaw">Mother In Law</option>
					<option value="FatherInLaw">Father In Law</option>
					<option value="Other">Other</option>
				</select>&nbsp;
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="2" cellspacing="0">	
		<tr>
			<td style="padding-right:25px; text-align:right;"><input type="button" name ="Go4" value="Go" onclick="add_relative()"></td>
		</tr>
	</table>
	</fieldset>
	<br>
	</div>
<?php //****************************************Add Relative (End)***********************************************?>
<?php //****************************************Main Query (Start)***********************************************?>
	<div id="div7" style="display: none;">
	<fieldset>
	<legend><b>Ask Query</b></legend>
	<table border="1" cellpadding="2" cellspacing="0" align="center">	
		<tr>
			<th align="left" colspan="2">
				Query<span class="mandatory">*</span>
				<input type="hidden" name="person_by" value="" size="15" maxlength="20" />
				<input type="hidden" name="person_for" value="" size="15" maxlength="20" />
			</th>
		</tr><tr>
			<td colspan="2"><textarea name="desc_remark" value="" rows="5" cols="65" ></textarea>&nbsp;</td>
		</tr><tr>
			<th align="left">Satisfied By<span class="mandatory">*</span></th>
			<td rowspan="2">
				<div id="satisfied">
					<table border="1" cellpadding="2" cellspacing="0" align="center">	
						<tr align="left">
							<th>Contact Person<span class="mandatory">*</span></th>
							<td><input type="text" name="contact_person" value="" size="15" maxlength="50" />&nbsp;</td>
						</tr><tr align="left">
							<th>Contact No.<span class="mandatory">*</span></th>
							<td><input type="text" name="contact_no" value="" size="15" maxlength="20" />&nbsp;</td>
						</tr><tr align="left">
							<th>Suitable Time<span class="mandatory">*</span></th>
							<td>
								<select name="suitable_time">
									<option value="">--Select--</option>
									<?php for ($i=8;$i<=10;$i++){?>
									<option value="<?php echo $i;?> A.M. - <?php echo $i+1;?> A.M."><?php echo $i;?> A.M. - <?php echo $i+1;?> A.M.</option>
									<?php }?>
									<option value="11 A.M. - 12 P.M.">11 A.M. - 12 P.M.</option>
									<option value="12 P.M. - 1 P.M.">12 P.M. - 1 P.M.</option>
									<?php for ($i=1;$i<=6;$i++){?>
									<option value="<?php echo $i;?> P.M. - <?php echo $i+1;?> P.M."><?php echo $i;?> P.M. - <?php echo $i+1;?> P.M.</option>
									<?php }?>
								</select>&nbsp;
							</td>
						</tr>
					</table>
				</div>
			</td>
		</tr><tr>
			<td>
				<select name="satisfied_by" onchange="satisfied();">
					<option value="Not Satisfied">Not Satisfied</option>
					<option value="Counselor">Counselor</option>
					<option value="Research Officer">Research Officer</option>
					<option value="Co-Investigator I">Co-Investigator I</option>
					<option value="Co-Investigator II">Co-Investigator II</option>
					<option value="Pricipal Investigator">Pricipal Investigator</option>
					<option value="Special">Specialist</option>
				</select>&nbsp;
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="2" cellspacing="0">	
		<tr>
			<td style="padding-right:25px; text-align:right;">
				<!--<input type="button" name ="Go4" value="Past Queries" onclick="show_report()">&nbsp;&nbsp;&nbsp;-->
				<input type="button" name ="Go4" value="Go" onclick="check_query()">
			</td>
		</tr>
	</table>
	</fieldset>
	<br>
	</div>
<?php //****************************************Main Query (End)*************************************************?>
<?php //****************************************Categorization (Start)*******************************************?>
	<div id="div8" style="display: none;">
	<fieldset>
	<legend><b>Categorization</b></legend>
	<table border="1" cellpadding="2" cellspacing="0" align="center">	
		<tr>
			<th>Category<span class="mandatory">*</span></th>
			<td>
				<select name="category" id ="fillcategory" onchange="popsubcategory(this.value)" onchange="popsubcategorydetail(document.form1.subcategory.value,this.value)"> 
					<option value="">--Select--</option>
					
				</select>&nbsp;
			</td>
		</tr><tr>
			<th>Sub Category</th>
			<td>
				<select id="fillsubcategory" name="subcategory" onclick="popsubcategorydetail(document.form1.category.value,this.value)" onchange="popsubcategorydetail(document.form1.category.value,this.value)">
					<option value="">--Select--</option>
											
				</select>&nbsp;
			</td>
		</tr><tr>
			<th>Sub Category Deatil</th>
			<td>
				<select id="fillsubcategorydetails" name="subcategorydetail"> 
					<option value="">--Select--</option>
					
				</select>&nbsp;
			</td>
		</tr>
	</table>
	<table width="100%" border="0" cellpadding="2" cellspacing="0">	
		<tr>
			<td style="padding-right:25px; text-align:right;"><input type="button" name ="Go8" value="Go" onclick="show_query()"></td>
		</tr>
	</table>
	</fieldset>
	<br>
	</div>
<?php //****************************************Categorization (End)*********************************************?>
<?php //****************************************Save Query (Start)*********************************************?>
	<div id="div10" style="display: none;">
	<fieldset>
	<legend><b>Save Query / Cancel(Done)</b></legend>
	<table width="100%" border="0" cellpadding="2" cellspacing="0">	
		<tr>
			<td style="padding-right:25px; text-align:right;">
				<input type="button" name ="Go9" value="Save Query" onclick="save_query()">&nbsp;&nbsp;&nbsp;
				
			</td>
		</tr>
	</table>
	</fieldset>
	<br>
	</div>
<?php //****************************************Save Query (End)***********************************************?>
<div id="query_saved" style="display: none;"></div>
<?php //****************************************Past Queries (Start)*********************************************?>
	<div id="div9" style="display: none;">
	</div>
<?php //****************************************Past Queries (End)***********************************************?>

</form>