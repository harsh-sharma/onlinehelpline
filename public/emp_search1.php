<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$emp_name=$_GET['emp_name'];
	$father_husband_name=$_GET['father_husband_name'];
	$empid=$_GET['empid'];
	$native_place=$_GET['native_place'];
	$dob=$_GET['dob'];
	
	if ($emp_name!="" || $father_husband_name!="" || $empid!="" || $native_place!="" || $dob!=""){
?>
<h2>Employee Search</h2>
	<table>
		<tr align="left">
			<th>Sn.&nbsp;</th>
			<th>Employee Name<br> -(ID)&nbsp;</th>
			<th>Father/Husband<br>Name&nbsp;</th>
			<th>DOB&nbsp;</th>
			<th>Native<br>Place&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php 
			
			//echo $emp_name."<br>";
			//echo $father_husband_name."<br>";
			//echo $dob."<br>";
			
			$query = "select * from employee_master where not empid=0 ";
			if($emp_name!=""){$query .= " and emp_name like '%".$emp_name."%' ";}
			if($father_husband_name!=""){$query .= " and father_husband_name like '%".$father_husband_name."%' ";}
			if($empid!=""){$query .= " and empid like '%".$empid."%' ";}
			if($native_place!=""){$query .= " and native_place like '%".$native_place."%' ";}
			if($dob!=""){$query .= " and dob like '%".$dob."%' ";}
			$query .= " order by emp_name limit 0,10";
			//echo $query;
			$emp=mysql_query($query,$conn);
			confirm_query($emp);
			$i=1;
			while($employee=mysql_fetch_array($emp)){
		?>
		<tr>
			<td><?php echo $i ; $i++;?>&nbsp;</td>
			<td><?php echo ucwords($employee["emp_name"])." -(".$employee["empid"].")" ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["father_husband_name"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["dob"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["native_place"]) ;?>&nbsp;</td>
			<td><a href="content.php?page=7&empid=<?php echo urlencode($employee['empid']);?>">Query</a></td>
		</tr>
		<?php }?>
	</table>
<?php }?>