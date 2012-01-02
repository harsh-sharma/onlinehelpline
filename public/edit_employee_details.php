<script language="javascript">
function search(){
	if (document.form1.empid.value == "" && document.form1.emp_name.value == "" && document.form1.father_husband_name.value == "" && document.form1.mother_name.value == "" && document.form1.native_place.value == ""){
		alert("Please fill atleast one parameter for search.");
		return false;
	}
	PageLoad(document.form1,'content.php?page=26');
}
function EditForm(page){  
	popUpWindow=window.open(page,'popUpWindow','height=500,width=600,left=100,top=150,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}
function DeleteForm(page){  
	popUpWindow=window.open(page,'popUpWindow','height=50,width=60,left=550,top=150,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}
function show_confirm(page){
	var r=confirm("Are you sure you want to delete this?");
	if (r==true){
	  DeleteForm(page);
	}else{
	  return false;
	}
}
</script>
<form action="" method="post" name="form1">
	<span class="mandatory" align="right">Fill atleast one.</span>
	<table border="0" cellpadding="2" cellspacing="0">
		<tr>
			<td>Id</td><td>Employee<br>Name</td><td>Father/Husband<br>Name</td><td>Mother's<br>Name</td><td>Native Place</td>
		</tr><tr>
			<td><input type="text" name="empid" value="<?php if(isset($_REQUEST['empid'])){ echo $_REQUEST['empid'];}?>" size="5" maxlength="50" />&nbsp;</td>
			<td><input type="text" name="emp_name" value="<?php if(isset($_REQUEST['emp_name'])){ echo $_REQUEST['emp_name'];}?>" size="15" maxlength="50" />&nbsp;</td>
			<td><input type="text" name="father_husband_name" value="<?php if(isset($_REQUEST['father_husband_name'])){ echo $_REQUEST['father_husband_name'];}?>" size="15" maxlength="50" />&nbsp;</td>
			<td><input type="text" name="mother_name" value="<?php if(isset($_REQUEST['mother_name'])){ echo $_REQUEST['mother_name'];}?>" size="15" maxlength="10" />&nbsp;</td>
			<td>
				<select name="native_place">
					<option value="">--Select--</option>
					<?php 
						$Dist=get_all_district('district_name');
						while($District=mysql_fetch_array($Dist)){
					?>
						<option value="<?php echo $District["district_id"] ;?>" 
						<?php if(isset($_REQUEST['native_place'])){if($_REQUEST['native_place']==$District["district_id"]){echo " selected";}}?>>
							<?php echo ucwords($District["district_name"]) ;?>
						</option>
					<?php }?>
				</select>
			</td>
			<td><input type="button" name ="searchbttn" value="Search" onclick="search()"></td>
		</tr>
	</table>
	<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />

<br /><hr>
<?php
	if (isset($_REQUEST['empid']) || isset($_REQUEST['emp_name']) || isset($_REQUEST['father_husband_name']) || isset($_REQUEST['mother_name']) || isset($_REQUEST['native_place'])){ 
		$empid=$_REQUEST['empid'];
		$emp_name=$_REQUEST['emp_name'];
		$father_husband_name=$_REQUEST['father_husband_name'];
		$mother_name=$_REQUEST['mother_name'];
		$native_place=$_REQUEST['native_place'];
		
		if ($empid!="" || $emp_name!="" || $father_husband_name!="" || $mother_name!=""|| $native_place!="" ){
			$query = "select * from employee_master where not empid=0 ";
			if($empid!=""){$query .= " and empid = '".$empid."' ";}
			if($emp_name!=""){$query .= " and emp_name like '%".$emp_name."%' ";}
			if($father_husband_name!=""){$query .= " and father_husband_name like '%".$father_husband_name."%' ";}
			if($mother_name!=""){$query .= " and mother_name like '%".$mother_name."%' ";}
			if($native_place!=""){$query .= " and native_place = '".$native_place."' ";}
			$query .= " order by emp_name ";
			$emp=mysql_query($query,$conn);
			confirm_query($emp);
			//echo $query;
			$search_count=mysql_num_rows($emp);?>
			<span class="mandatory" align="right"><?php echo $search_count;?> record(s) found.</span><br><br>
	
			<table>
				<tr align="left">
					<th>Sn.&nbsp;</th>
					<th>Id&nbsp;</th>
					<th>Employee<br>Name&nbsp;</th>
					<th>Father/Husband<br>Name&nbsp;</th>
					<th>Mother's<br>Name&nbsp;</th>
					<th>Native<br>Place&nbsp;</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
				</tr>
				<?php 
					
					$i=1;
					while($employee=mysql_fetch_array($emp)){
				?>
				<tr>
					<td><?php echo $i ; $i++;?>&nbsp;</td>
					<td><?php echo $employee["empid"] ;?>&nbsp;</td>
					<td><?php echo ucwords($employee["emp_name"]) ;?>&nbsp;</td>
					<td><?php echo ucwords($employee["father_husband_name"]) ;?>&nbsp;</td>
					<td><?php echo ucwords($employee["mother_name"]) ;?>&nbsp;</td>
					<td>
						<?php 
							$Dist=get_district_by_id($employee["native_place"]);
							$District=mysql_fetch_array($Dist);
							echo ucwords($District["district_name"]) ;
						?>&nbsp;
					</td>
					<td>&nbsp;</td>
					<td><a href="#" onClick="EditForm('edit_employee_details1.php?empid=<?php echo urlencode($employee['empid']);?>')">Update</a>&nbsp;</td>
					<td><a href="#" onClick="show_confirm('delete_employee_new1.php?empid=<?php echo urlencode($employee['empid']);?>');">Delete</a></td>
				</tr>
				<?php }?>
			</table>
	<?php }
		}
	?>