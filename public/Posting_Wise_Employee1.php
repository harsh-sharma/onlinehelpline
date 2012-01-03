<table rules="rows" width="100%">
		<tr align="left">
			<th>Sn.</th>
			<th>Id</th>
			<th>Employee</th>
			<th>Rank</th>
			<th>Father/Husband</th>
			<th>Mother</th>
			<th>District</th>
			<th>ContactNo</th>
		</tr>
		<?php 
			$district=$_GET['district'];
			$emp=get_emp_by_district($district);
			$i=1;
			while($employee=mysql_fetch_array($emp)){
		?>
		<tr class='rowhd'>
			<td><?php echo $i ; $i++;?>.</td>
			<td class="mandatory"><b><?php echo $employee["empid"] ;?></b>&nbsp;</td>
			<td><?php echo ucwords($employee["emp_name"]) ;?>&nbsp;</td>
			<td><?php echo ucwords(get_designation_by_id1($employee["designation"])) ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["father_husband_name"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["mother_name"]) ;?>&nbsp;</td>
			<td><?php echo ucwords(get_native_by_id($employee["district"]));?>&nbsp;</td>
			<td><?php echo "(R)".$employee["phone_no"]."<br/>(M)".$employee["mobile_no"]."<br/>(O)".$employee["office_no"] ;?></td>
		</tr>
		<?php }?>
	</table>