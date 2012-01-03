<form action="" method="post" name="form1">
<table border="1" cellpadding="2" cellspacing="0" align="center" width="80%">
	<tr>
		<th align="left">District</th>
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
	</tr>
</table>
<center>
	<br>
	<input type="button" name ="Show" value="Show Issue Report" onClick="PageLoad(document.form1,'content.php?page=31')">
</center>
</form>
