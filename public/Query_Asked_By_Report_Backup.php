<table cellspacing="2" cellpadding="2" border="1" align="center">
	<tr>
		<th rowspan=2>Name of<br />District/<br />Office/<br />Units</th>
		<th rowspan=2>Asked<br />By</th>
		<?php 
			$Desg=get_all_designation('designation_id');
			$Desg_count=mysql_num_rows($Desg);
		?>
		<th colspan="<?php echo $Desg_count;?>">Ranks</th>
		<th rowspan=2>Total</th>
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
		<th rowspan="2" align="left"><?php echo ucwords($District["district_name"]) ;?></th>
		<th align="left">Employee</th>
		<?php 
			$Desg=get_all_designation('designation_id');
			$dist_count=0;
			while($Designation=mysql_fetch_array($Desg)){
				$query = "select * 
							from issue_master1 inner join 
							employee_master on person_for=empid 
								or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
							where district='".$District["district_id"]."' 
								and designation='".$Designation["designation_id"]."' and not person_by='Relative' 
							order by desc_remark";
				$issue=mysql_query($query,$conn);
				confirm_query($issue);
				$issue_count=mysql_num_rows($issue);
				$dist_count+=$issue_count;
		?>
			<td align="right">
				<?php 
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
				?>&nbsp;
			</td>
		<?php }?>
		<td align="right">
			<?php 
				if($dist_count!=0){echo "<span class=\"mandatory\">";}
				echo $dist_count;
				if($dist_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
	</tr><tr>
		<th align="left">Relative</th>
		<?php 
			$Desg=get_all_designation('designation_id');
			$dist_count=0;
			while($Designation=mysql_fetch_array($Desg)){
				$query = "select * 
							from issue_master1 inner join 
							employee_master on person_for=empid 
								or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
							where district='".$District["district_id"]."' 
								and designation='".$Designation["designation_id"]."' and person_by='Relative' 
							order by desc_remark";
				$issue=mysql_query($query,$conn);
				confirm_query($issue);
				$issue_count=mysql_num_rows($issue);
				$dist_count+=$issue_count;
		?>
			<td align="right">
				<?php 
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
				?>&nbsp;
			</td>
		<?php }?>
		<td align="right">
			<?php 
				if($dist_count!=0){echo "<span class=\"mandatory\">";}
				echo $dist_count;
				if($dist_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
	</tr>
<?php }?>
	<tr>
		<th rowspan="2">Total</th>
		<th align="left">Employee</th>
		<?php 
			$Desg=get_all_designation('designation_id');
			$dist_count=0;
			while($Designation=mysql_fetch_array($Desg)){
				$query = "select * 
							from issue_master1 inner join 
							employee_master on person_for=empid 
								or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
							where designation='".$Designation["designation_id"]."' 
								and not person_by='Relative' 
							order by desc_remark";
				$issue=mysql_query($query,$conn);
				confirm_query($issue);
				$issue_count=mysql_num_rows($issue);
				$dist_count+=$issue_count;
		?>
			<td align="right">
				<?php 
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
				?>&nbsp;
			</td>
		<?php }?>
		<td align="right">
			<?php 
				if($dist_count!=0){echo "<span class=\"mandatory\">";}
				echo $dist_count;
				if($dist_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
	</tr><tr>
		<th align="left">Relative</th>
		<?php 
			$Desg=get_all_designation('designation_id');
			$dist_count=0;
			while($Designation=mysql_fetch_array($Desg)){
				$query = "select * 
							from issue_master1 inner join 
							employee_master on person_for=empid 
								or person_for like concat(empid,'-%') or person_for like concat(empid,'.%')
							where designation='".$Designation["designation_id"]."' 
								and person_by='Relative' 
							order by desc_remark";
				$issue=mysql_query($query,$conn);
				confirm_query($issue);
				$issue_count=mysql_num_rows($issue);
				$dist_count+=$issue_count;
		?>
			<td align="right">
				<?php 
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
				?>&nbsp;
			</td>
		<?php }?>
		<td align="right">
			<?php 
				if($dist_count!=0){echo "<span class=\"mandatory\">";}
				echo $dist_count;
				if($dist_count!=0){echo "</span>";}
			?>&nbsp;
		</td>
	</tr>
</table>
