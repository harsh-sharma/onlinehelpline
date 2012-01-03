<script language="javascript">
function BSave_onclick(){
	if(IsBlank(document.form1.emp_name) == false)return false;
	if(IsBlank(document.form1.mother_name) == false)return false;
	if(IsBlank(document.form1.father_husband_name) == false)return false;
	if(IsBlank(document.form1.designation) == false)return false;	
	if(IsBlank(document.form1.native_place) == false)return false;
	if(IsBlank(document.form1.query_for) == false)return false;
	if(document.form1.query_for.value == "Other"){
		if(IsBlank(document.form1.relation) == false)return false;
		if(IsBlank(document.form1.relative_name) == false)return false;
		if(IsBlank(document.form1.relative_age) == false)return false;
		if(IsInteger(document.form1.relative_age) == false)return false;
	}
	PageLoad(document.form1,'emp_master_new1.php')
}
function EditForm(page){  
	popUpWindow=window.open(page,'popUpWindow','height=350,width=670,left=550,top=150,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}
function check_relative(query_for){
	var Id;
	if(query_for.value == "Other"){
		for(Id=1;Id<=6;Id++)
		document.getElementById("Relative"+Id).style.display = "block";
	}else{
		for(Id=1;Id<=6;Id++)
		document.getElementById("Relative"+Id).style.display = "none";
	}
}
</script>

<br /><br />

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
			$emp=get_all_emp();
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