<table cellspacing="2" cellpadding="2" border="1" align="center">
	<tr>
		<th>Districts</th>
		<th>Employee</th>
	</tr>
	<?php
		$Dist=get_all_district('district_name');
		$empcount=0;
		while($District=mysql_fetch_array($Dist)){
	?>
	<tr>
		<td><?php echo ucwords($District["district_name"]) ;?></td>
		<?php 
			$emp=get_emp_by_district($District["district_id"]);
			$emp_count=mysql_num_rows($emp);
			echo "<td align=right>";
			if($emp_count != 0){
			$empcount += $emp_count;
		?>
				<a href="content.php?page=34&district=<?php echo urlencode($District["district_id"]) ?>"><?php echo $emp_count;?></a>
		<?php }else{echo $emp_count;}?>
		</td>
	</tr>
	<?php }?>
	<tr>
		<th>Total</th>
		<td align="right"><?php echo $empcount;?></td>
	</tr>
</table>
		