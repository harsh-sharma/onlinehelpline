<form action="" method="post" name="form1">
	<table border="0" cellpadding="2" cellspacing="0">	
		<tr>
			<td>Id</td><td>Employee<br>Name</td><td>Father/Husband<br>Name</td><td>Mother's<br>Name</td><td>Native Place</td>
		</tr><tr>
			<td><input type="text" name="empid" value="<?php if(isset($_REQUEST['empid'])){ echo $_REQUEST['empid'];}?>" size="5" maxlength="50" />&nbsp;</td>
			<td><input type="text" name="emp_name" value="<?php if(isset($_REQUEST['emp_name'])){ echo $_REQUEST['emp_name'];}?>" size="15" maxlength="50" />&nbsp;</td>
			<td><input type="text" name="father_husband_name" value="<?php if(isset($_REQUEST['father_husband_name'])){ echo $_REQUEST['father_husband_name'];}?>" size="15" maxlength="50" />&nbsp;</td>
			<td><input type="text" name="mother_name" value="<?php if(isset($_REQUEST['mother_name'])){ echo $_REQUEST['mother_name'];}?>" size="15" maxlength="10" />&nbsp;</td>
			<td><input type="text" name="native_place" value="<?php if(isset($_REQUEST['native_place'])){ echo $_REQUEST['native_place'];}?>" size="15" maxlength="50" />&nbsp;</td>
			<td><input type="submit" name ="searchbttn" value="Search"></td>
		</tr>
	</table>
	<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />

<br /><hr>
<?php
	//********************************Search Result*******************************
	if (isset($_REQUEST['searchbttn'])){  
	$emp_name=$_REQUEST['emp_name'];
	$father_husband_name=$_REQUEST['father_husband_name'];
	$empid=$_REQUEST['empid'];
	$native_place=$_REQUEST['native_place'];
	$mother_name=$_REQUEST['mother_name'];
	
	if ($emp_name!="" || $father_husband_name!="" || $empid!="" || $native_place!="" || $mother_name!=""){
		$query = "select * from employee_master where not empid=0 ";
		if($emp_name!=""){$query .= " and emp_name like '%".$emp_name."%' ";}
		if($father_husband_name!=""){$query .= " and father_husband_name like '%".$father_husband_name."%' ";}
		if($empid!=""){$query .= " and empid = '".$empid."' ";}
		if($native_place!=""){$query .= " and native_place like '%".$native_place."%' ";}
		if($mother_name!=""){$query .= " and mother_name like '%".$mother_name."%' ";}
		$query .= " order by emp_name limit 0,10 ";
		$emp=mysql_query($query,$conn);
		confirm_query($emp);
		//echo $query;
		$search_count=mysql_num_rows($emp);
		//echo $search_count;
	
?>
<h2>Employee Search</h2>
<?php if($search_count > 1){?>
	<table>
		<tr align="left">
			<th>Sn.&nbsp;</th>
			<th>Employee Name<br> -(ID)&nbsp;</th>
			<th>Father/Husband<br>Name&nbsp;</th>
			<th>Mother's Name&nbsp;</th>
			<th>Native<br>Place&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php 
			$i=1;
			while($employee=mysql_fetch_array($emp)){
		?>
		<tr>
			<td><?php echo $i ; $i++;?>&nbsp;</td>
			<td><?php echo ucwords($employee["emp_name"])." -(".$employee["empid"].")" ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["father_husband_name"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["mother_name"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($employee["native_place"]) ;?>&nbsp;</td>
			<td><a href="content.php?page=11&empid=<?php echo urlencode($employee['empid']);?>">Query</a></td>
		</tr>
		<?php }?>
	</table>
<?php }elseif($search_count == 1){
		$employee=mysql_fetch_array($emp);
		redirect_to("content.php?page=11&empid=".urlencode($employee['empid']));
	  }elseif($search_count == 0){?>
	  	No data found.<br>
		<INPUT type="button" value="Add Employee" name="Add" onClick="PageLoad(document.form1,'content.php?page=10')">
<?php }
	}
}?>
</form>