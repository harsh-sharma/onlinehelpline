<?php //****************************************District V/s Rank (Start)***********************************************?>
<h3>District V/s Rank Report</h3>
<table cellspacing="2" cellpadding="2" border="1" align="center">
	<tr>
		<th rowspan=2>Districts</th>
		<?php 
			$Desg=get_all_designation('designation_id');
			$Desg_count=mysql_num_rows($Desg);
		?>
		<th colspan="<?php echo $Desg_count;?>">Ranks</th>
	</tr><tr>
		<?php while($Designation=mysql_fetch_array($Desg)){?>
			<th><?php echo ucwords($Designation["designation_name"]) ;?></th>
		<?php }?>
	</tr>
<?php
	$Dist=get_all_district('district_name');
	while($District=mysql_fetch_array($Dist)){
?>
	<tr>
		<th align="left"><?php echo ucwords($District["district_name"]) ;?></th>
		<?php 
			$Desg=get_all_designation('designation_id');
			while($Designation=mysql_fetch_array($Desg)){
				$query = "select * 
					from issue_master1 inner join 
					employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
					where native_place='".$District["district_id"]."' and designation='".$Designation["designation_id"]."' 
					order by desc_remark";
				$issue=mysql_query($query,$conn);
				confirm_query($issue);
				$issue_count=mysql_num_rows($issue);
		?>
			<td align="right">
				<?php 
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
				?>&nbsp;
			</td>
		<?php }?>
	</tr>
<?php }?>
</table>
<a href="">Download</a>
<br><br>
<?php //****************************************District V/s Rank (End)***********************************************?>
<?php //****************************************District V/s Age (Start)***********************************************?>
<h3>District V/s Age Report</h3>
<table cellspacing="2" cellpadding="2" border="1" align="center">
	<tr>
		<th rowspan=2>Districts</th>
		<th colspan="5">Age Groups</th>
	</tr><tr>
		<th>18 - 20</th>
		<?php for ($i=21;$i<=60;$i++){?>
			<th><?php echo $i; $i+=9; echo " - ".$i;?></th>
		<?php }?>
	</tr>
<?php
	$Dist=get_all_district('district_name');
	while($District=mysql_fetch_array($Dist)){
?>
	<tr>
		<th align="left"><?php echo ucwords($District["district_name"]) ;?></th>
		<?php 
			$query = "select * 
				from issue_master1 inner join 
				employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
				where native_place='".$District["district_id"]."' and age between 18 and 20 
				order by desc_remark";
			$issue=mysql_query($query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
			<td align="right">
				<?php 
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
				?>&nbsp;
			</td>
		<?php 
			for ($i=21;$i<=60;$i++){
				$j=$i+9;
				$query = "select * 
					from issue_master1 inner join 
					employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
					where native_place='".$District["district_id"]."' and age between ".$i." and ".$j."
					order by desc_remark";
				$i+=9;
				$issue=mysql_query($query,$conn);
				confirm_query($issue);
				$issue_count=mysql_num_rows($issue);
		?>
			<td align="right">
				<?php 
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
				?>&nbsp;
			</td>
		<?php }?>
	</tr>
<?php }?>
</table>
<br><br>
<?php //****************************************District V/s Age (End)***********************************************?>
<?php //****************************************District V/s Gender (Start)***********************************************?>
<h3>District V/s Gender Report</h3>
<table cellspacing="2" cellpadding="2" border="1" align="center">
	<tr>
		<th rowspan=2>Districts</th>
		<th colspan="2">Gender</th>
	</tr><tr>
		<th>Male</th>
		<th>Female</th>
	</tr>
<?php
	$Dist=get_all_district('district_name');
	while($District=mysql_fetch_array($Dist)){
?>
	<tr>
		<th align="left"><?php echo ucwords($District["district_name"]) ;?></th>
		<?php 
			$query = "select * 
				from issue_master1 inner join 
				employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
				where native_place='".$District["district_id"]."' and gender='Male' 
				order by desc_remark";
			$issue=mysql_query($query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<td align="right">
			<?php 
				if($issue_count!=0){echo "<span class=\"mandatory\">";}
				echo $issue_count;
				if($issue_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
		<?php 
			$query = "select * 
				from issue_master1 inner join 
				employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
				where native_place='".$District["district_id"]."' and gender='Female' 
				order by desc_remark";
			$issue=mysql_query($query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<td align="right">
			<?php 
				if($issue_count!=0){echo "<span class=\"mandatory\">";}
				echo $issue_count;
				if($issue_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
	</tr>
<?php }?>
</table>
<br><br>
<?php //****************************************District V/s Gender (End)***********************************************?>
<?php //****************************************District V/s Asked For (Start)***********************************************?>
<h3>District V/s Asked For Report</h3>
<table cellspacing="2" cellpadding="2" border="1" align="center">
	<tr>
		<th rowspan=2>Districts</th>
		<th colspan="2">Asked For</th>
	</tr><tr>
		<th>Employee</th>
		<th>Relative</th>
	</tr>
<?php
	$Dist=get_all_district('district_name');
	while($District=mysql_fetch_array($Dist)){
?>
	<tr>
		<th align="left"><?php echo ucwords($District["district_name"]) ;?></th>
		<?php 
			$query = "select * 
				from issue_master1 inner join 
				employee_master on person_for=empid 
				and not person_for like concat(empid,'-%') and not person_for like concat(empid,'.%')
				where native_place='".$District["district_id"]."' 
				order by desc_remark";
			$issue=mysql_query($query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<td align="right">
			<?php 
				if($issue_count!=0){echo "<span class=\"mandatory\">";}
				echo $issue_count;
				if($issue_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
		<?php 
			$query = "select * 
				from issue_master1 inner join 
				employee_master on person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
				where native_place='".$District["district_id"]."' 
				order by desc_remark";
			$issue=mysql_query($query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<td align="right">
			<?php 
				if($issue_count!=0){echo "<span class=\"mandatory\">";}
				echo $issue_count;
				if($issue_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
	</tr>
<?php }?>
</table>
<br><br>
<?php //****************************************District V/s Asked For (End)***********************************************?>
<?php //****************************************District V/s Asked By (Start)***********************************************?>
<h3>District V/s Asked By Report</h3>
<table cellspacing="2" cellpadding="2" border="1" align="center">
	<tr>
		<th rowspan=2>Districts</th>
		<th colspan="2">Asked By</th>
	</tr><tr>
		<th>Employee</th>
		<th>Relative</th>
	</tr>
<?php
	$Dist=get_all_district('district_name');
	while($District=mysql_fetch_array($Dist)){
?>
	<tr>
		<th align="left"><?php echo ucwords($District["district_name"]) ;?></th>
		<?php 
			$query = "select * 
				from issue_master1 inner join 
				employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
				where native_place='".$District["district_id"]."' and not person_by='Relative'
				order by desc_remark";
			$issue=mysql_query($query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<td align="right">
			<?php 
				if($issue_count!=0){echo "<span class=\"mandatory\">";}
				echo $issue_count;
				if($issue_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
		<?php 
			$query = "select * 
				from issue_master1 inner join 
				employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
				where native_place='".$District["district_id"]."' and person_by='Relative'
				order by desc_remark";
			$issue=mysql_query($query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<td align="right">
			<?php 
				if($issue_count!=0){echo "<span class=\"mandatory\">";}
				echo $issue_count;
				if($issue_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
	</tr>
<?php }?>
</table>
<br><br>
<?php //****************************************District V/s Asked By (End)***********************************************?>
<?php //****************************************District V/s Status (Start)***********************************************?>
<h3>District V/s Status Report</h3>
<table cellspacing="2" cellpadding="2" border="1" align="center">
	<tr>
		<th rowspan="2">Districts</th>
		<th colspan="2">Status</th>
	</tr><tr>
		<th>Pending</th>
		<th>Complete</th>
	</tr>
<?php
	$Dist=get_all_district('district_name');
	while($District=mysql_fetch_array($Dist)){
?>
	<tr>
		<th align="left"><?php echo ucwords($District["district_name"]) ;?></th>
		<?php 
			$query = "select * 
				from issue_master1 inner join 
				employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
				where native_place='".$District["district_id"]."' and Status='Pending'
				order by desc_remark";
			$issue=mysql_query($query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<td align="right">
			<?php 
				if($issue_count!=0){echo "<span class=\"mandatory\">";}
				echo $issue_count;
				if($issue_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
		<?php 
			$query = "select * 
				from issue_master1 inner join 
				employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
				where native_place='".$District["district_id"]."' and not Status='Pending'
				order by desc_remark";
			$issue=mysql_query($query,$conn);
			confirm_query($issue);
			$issue_count=mysql_num_rows($issue);
		?>
		<td align="right">
			<?php 
				if($issue_count!=0){echo "<span class=\"mandatory\">";}
				echo $issue_count;
				if($issue_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
	</tr>
<?php }?>
</table>
<br><br>
<?php //****************************************District V/s Status (End)***********************************************?>