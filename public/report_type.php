<body onLoad="popcategory()">
<form action="" method="post" name="form1">
<table border="1" cellpadding="2" cellspacing="0" align="center" width="80%">
	<tr>
		<th align="left">District Posted</th>
		<td>
			<select name="district">
				<option value="0">--All--</option>
				<?php 
					$Dist=get_all_district('district_name');
					while($District=mysql_fetch_array($Dist)){
				?>
					<option value="<?php echo $District["district_id"] ;?>"><?php echo ucwords($District["district_name"]) ;?></option>
				<?php }?>
			</select>&nbsp;
		</td>
	</tr><tr>
		<th align="left">Rank</th>
		<td>
			<select name="designation">
				<option value="0">--All--</option>
				<?php 
					$Desg=get_all_designation('designation_name');
					while($Designation=mysql_fetch_array($Desg)){
				?>
					<option value="<?php echo $Designation["designation_id"] ;?>"><?php echo ucwords($Designation["designation_name"]) ;?></option>
				<?php }?>
			</select>&nbsp;
		</td>
	</tr><tr>
		<th align="left">Age</th>
		<td>
			<select name="age">
				<option value="0">--All--</option>
				<option value="18-30">18-30</option>
				<option value="31-40">31-40</option>
				<option value="41-50">41-50</option>
				<option value="51-60">51-60</option>
			</select>&nbsp;
		</td>
	</tr><tr>
		<th align="left">Categories</th>
		<td>
			<table border="1" cellpadding="2" cellspacing="0" align="left">	
				<tr>
					<th>Category</th>
					<td>
						<select name="cat_id" id ="fillcategory" onChange="popsubcategory(this.value)">
							<option value="0">--Select--</option>
							
						</select>&nbsp;
					</td>
				</tr><tr>
					<th>Sub Category</th>
					<td>
						<select id="fillsubcategory" name="sub_cat_id" onChange="popsubcategorydetail(document.form1.cat_id.value,this.value)">
							<option value="0">--Select--</option>
										
						</select>&nbsp;
					</td>
				</tr><tr>
					<th>Sub Category Deatil</th>
					<td>
						<select id="fillsubcategorydetails" name="cat_detail_id">
							<option value="0">--Select--</option>
							
						</select>&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr><tr>
		<th align="left">Questions Asked</th>
		<td>
			<table border="1" cellpadding="2" cellspacing="0" align="left">	
				<tr>
					<th>Question By</th><th>Question For</th>
				</tr><tr>
					<td>
						<select name="query_by">
							<option value="0">--All--</option>
							<option value="Employee">Employee</option>
							<option value="Relative">Relative</option>
						</select>&nbsp;
					</td>
					<td>
						<select name="query_for">
							<option value="0">--All--</option>
							<option value="Employee">Employee</option>
							<option value="Relative">Relative</option>
						</select>&nbsp;
					</td>
				</tr>
			</table>
		</td>
	</tr><tr>
		<th align="left">Gender</th>
		<td>
			<select name="gender">
				<option value="0">--Select--</option>
				<option value="Male">Male</option>
				<option value="Female">Female</option>
			</select>
		</td>
	</tr><tr>
		<?php
			$main_query = "select * from issue_master1 ";
			$issue=mysql_query($main_query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<th align="left" colspan="2">Total Queries = <?php echo $issue_count;?></th>
	</tr><tr>
		<?php
			$main_query = "select * from issue_master1 where status='Pending' ";
			$issue=mysql_query($main_query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<th align="left" colspan="2">Total Pending Queries = <?php echo $issue_count;?></th>
	</tr><tr>
		<?php
			$main_query = "select * from issue_master1 where not status='Pending' ";
			$issue=mysql_query($main_query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<th align="left" colspan="2">Total Solved Queries = <?php echo $issue_count;?></th>
	</tr><tr>
		<?php
			$main_query = "select * from employee_master where 1=1 ";
			$employee=mysql_query($main_query,$conn);
			confirm_query($employee);
			$employee_count=mysql_num_rows($employee);
		?>
		<th align="left" colspan="2">Total Registered Employees = <?php echo $employee_count;?></th>
	</tr>
</table>
<center>
	<br>
	<input type="button" name ="Show" value="Show Report" onClick="PageLoad(document.form1,'content.php?page=27')">
</center>
</form>
