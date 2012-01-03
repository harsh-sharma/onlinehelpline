<script language="javascript">
function BSave_onclick(){
	if(IsBlank(document.form1.query_for) == false)return false;
	if(IsBlank(document.form1.caller_relation) == false)return false;
	if(IsBlank(document.form1.call_district) == false)return false;
	if(IsBlank(document.form1.desc_remark) == false)return false;
	if(IsBlank(document.form1.cat_id) == false)return false;
	if(IsBlank(document.form1.counsel_by) == false)return false;
	if(IsInteger(document.form1.contact_no) == false)return false;
	//PageLoad(document.form1,'issue_master_new1.php')
	empissue();
}

function empissue()
{

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("past_query").innerHTML=xmlhttp.responseText;
    }
  }
var query_for = document.form1.query_for.value;
var caller_relation = document.form1.caller_relation.value;
var call_district = document.form1.call_district.value;
var desc_remark = document.form1.desc_remark.value;
var cat_id = document.form1.cat_id.value;
var sub_cat_id = document.form1.sub_cat_id.value;
var cat_detail_id = document.form1.cat_detail_id.value;
var suitable_time = document.form1.suitable_time.value;
var contact_no = document.form1.contact_no.value;
var counsel_by = document.form1.counsel_by.value;

var para = "query_for="+query_for+"&caller_relation="+caller_relation+"&call_district="+call_district+"&desc_remark="+desc_remark+"&cat_id="+cat_id+"&sub_cat_id="+sub_cat_id+"&cat_detail_id="+cat_detail_id+"&suitable_time="+suitable_time+"&contact_no="+contact_no+"&counsel_by="+counsel_by
xmlhttp.open("GET","issue_master_new2.php?"+para,true);
xmlhttp.send();
}

function AddForm(page){  
	popUpWindow=window.open(page,'popUpWindow','height=250,width=300,left=550,top=150,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}
</script>
<?php
	//**************************Employee Detail*****************************
	$empid=$_GET['empid'];
	$emp=get_emp_by_id($empid);
	$employee=mysql_fetch_array($emp) 
?>
	<table align="center" border="1" cellpadding="2" cellspacing="0">
		<tr>
			<th align="left">Name</th><td colspan="3"><?php echo $employee['emp_name']." -(".$employee['empid'].")";?>&nbsp;</td>
			
			<th align="left">Designation</th><td><?php echo $employee['designation'];?>&nbsp;</td>
		</tr><tr>
			<th align="left">Mother's Name</th><td><?php echo $employee['mother_name'];?>&nbsp;</td>
			<th align="left">Father/Husband Name</th><td><?php echo $employee['father_husband_name'];?>&nbsp;</td>
			<th align="left">Native Place</th><td><?php echo $employee['native_place'];?>&nbsp;</td>
		</tr><tr>
			<th align="left">Gender</th><td><?php echo $employee['gender'];?></td>
			<th align="left">Date of Birth </th><td><?php echo $employee['dob'];?></td>
			<th align="left">Age</th><td><?php echo $employee['age'];?> Years&nbsp;</td>
		</tr><tr>
			<th align="left">Phone No. </th><td><?php echo $employee['phone_no'];?>&nbsp;</td>
			<th align="left">Mobile No. </th><td><?php echo $employee['mobile_no'];?>&nbsp;</td>
			<th align="left">Email Id </th><td><?php echo $employee['email_id'];?>&nbsp;</td>
		</tr><tr>
			<th align="left">Address</th><td colspan="3"><?php echo $employee['address'];?>&nbsp;</td>
			<th align="left">District</th>
			<td><?php 
					$Dist=get_district_by_id($employee['district']);
					$District=mysql_fetch_array($Dist);
					echo $District["district_name"] ;
				?>&nbsp;
			</td>	
		</tr>
	</table>
	<br>
	<?php
		//**************************Relative Detail*****************************
		$relatives=get_all_relatives_for_emp($empid);
		//echo $issue;
		$relatives_count=mysql_num_rows($relatives);
		if($relatives_count != 0){
	?>
	<table align="center" border="1" cellpadding="2" cellspacing="0">
		<caption><b>Relatives</b></caption>
		<tr align="center">
			<th>Sn.&nbsp;</th>
			<th>Name&nbsp;</th>
			<th>Age&nbsp;</th>
			<th>Employee's&nbsp;</th>
		</tr>
	<?php $i=1;
		while($emprelatives=mysql_fetch_array($relatives)){?>
		<tr>
			<td><?php echo $i ; $i++;?>&nbsp;</td>
			<td><?php echo ucwords($emprelatives["relative_name"])." -(".$emprelatives["relative_id"].")" ;?>&nbsp;</td>
			<td align="right"><?php echo ucwords($emprelatives["relative_age"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($emprelatives["relation"]) ;?>&nbsp;</td>
		</tr>
	<?php }?>
	</table>
<?php }?>
	<center><a href="#" onclick="AddForm('add_relatives.php?empid=<?php echo $empid;?>')" >Add Relatives</a></center>
<hr>
<?php //**************************Create Issue*****************************?>
<form action="" method="post" name="form1">
	<table align="center" border="1" cellpadding="2" cellspacing="0">
		<tr>
			<td>Query For<span class="mandatory">*</span></td>
			<td>
				<select name="query_for">
					<option value="">--Select--</option>
					<option value="<?php echo $empid;?>" <?php if(isset($_POST['query_for'])){if($_POST['query_for'] == $empid){ echo " selected";}}?>><?php echo $employee['emp_name'];?></option>
					<?php 
						$relatives=get_all_relatives_for_emp($empid);
						while($emprelatives=mysql_fetch_array($relatives)){
					?>
						<option value="<?php echo $empid."-".$emprelatives["relative_id"] ;?>"
							<?php if(isset($_POST['query_for'])){if($_POST['query_for'] == $empid."-".$emprelatives["relative_id"]){echo " selected ";}} ?>>
							<?php echo ucwords($emprelatives["relative_name"]) ;?>
						</option>
					<?php }?>
				</select>&nbsp;
			</td>
		   <td>Caller Relation<span class="mandatory">*</span></td>
		   <td>
				<select name="caller_relation">
					<option value="">--Select--</option>
					<option value="Brother" <?php if(isset($_POST['caller_relation'])){if($_POST['caller_relation'] == "Brother"){ echo " selected";}}?>>Brother</option>
					<option value="Sister" <?php if(isset($_POST['caller_relation'])){if($_POST['caller_relation'] == "Sister"){ echo " selected";}}?>>Sister</option>
					<option value="Mother" <?php if(isset($_POST['caller_relation'])){if($_POST['caller_relation'] == "Mother"){ echo " selected";}}?>>Mother</option>
					<option value="Father" <?php if(isset($_POST['caller_relation'])){if($_POST['caller_relation'] == "Father"){ echo " selected";}}?>>Father</option>
					<option value="Children" <?php if(isset($_POST['caller_relation'])){if($_POST['caller_relation'] == "Children"){ echo " selected";}}?>>Children</option>
					<option value="Husband" <?php if(isset($_POST['caller_relation'])){if($_POST['caller_relation'] == "Husband"){ echo " selected";}}?>>Husband</option>
					<option value="Wife" <?php if(isset($_POST['caller_relation'])){if($_POST['caller_relation'] == "Wife"){ echo " selected";}}?>>Wife</option>
					<option value="Self" <?php if(isset($_POST['caller_relation'])){if($_POST['caller_relation'] == "Self"){ echo " selected";}}?>>Self</option>
				</select>	
			</td>
			<td>Call District<span class="mandatory">*</span></td>
			<td>
				<select name="call_district">
					<option value="">--Select--</option>
					<?php 
						$Dist=get_all_district('district_name');
						while($District=mysql_fetch_array($Dist)){
					?>
						<option value="<?php echo $District["district_id"] ;?>"
							<?php if(isset($_POST['call_district'])){if($_POST['call_district'] == $District["district_id"]){echo " selected ";}} ?>>
							<?php echo ucwords($District["district_name"]) ;?>
						</option>
					<?php }?>
				</select>&nbsp;
			</td>
         </tr><tr>
		   <td>Description<span class="mandatory">*</span></td>
		   <td colspan="5"><textarea name="desc_remark" value="" rows="5" cols="65" ><?php if(isset($_POST['desc_remark'])){ echo $_POST['desc_remark'];}?></textarea>&nbsp;</td>
		</tr><tr>
			<td>Category<span class="mandatory">*</span></td>
			<td>
				<select name="cat_id" onchange="PageLoad(document.form1,'content.php?page=11&empid=<?php echo $empid;?>')">
					<option value="">--Select--</option>
					<?php 
						$Cat=get_all_catg('cat_name');
						while($Category=mysql_fetch_array($Cat)){
					?>
						<option value="<?php echo $Category["cat_id"] ;?>" 
							<?php if(isset($_POST['cat_id'])){if($_POST['cat_id'] == $Category["cat_id"]){ echo " selected";}} ?>>
							<?php echo ucwords($Category["cat_name"]) ;?>
						</option>
					<?php }?>
				</select>
			</td>
			<td>Sub Category</td>
			<td>
				<select name="sub_cat_id" onchange="PageLoad(document.form1,'content.php?page=11&empid=<?php echo $empid;?>')">
					<option value="">--Select--</option>
					<?php if(isset($_POST['cat_id'])){
							if($_POST['cat_id'] != ""){
								$SubCat=get_sub_catg_for_catg($_POST['cat_id'],'cat_master.cat_id,sub_cat_name');
								while($SubCategory=mysql_fetch_array($SubCat)){
								?>
									<option value="<?php echo $SubCategory["sub_cat_id"] ;?>"
										<?php if(isset($_POST['sub_cat_id'])){if($_POST['sub_cat_id'] == $SubCategory["sub_cat_id"]){ echo " selected";}} ?>>
										<?php echo ucwords($SubCategory["sub_cat_name"]) ;?>
									</option>
							<?php }
							}
						}?>
				</select>
			</td>
			<td>Sub Category Detail</td>
			<td>
				<select name="cat_detail_id">
					<option value="">--Select--</option>
					<?php if(isset($_POST['sub_cat_id'])){
							if($_POST['sub_cat_id'] != ""){
								$DetailCat=get_detail_for_sub_catg($_POST['cat_id'],$_POST['sub_cat_id'],'sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,detail');
								while($DetailCategory=mysql_fetch_array($DetailCat)){
								?>
									<option value="<?php echo $DetailCategory["cat_detail_id"] ;?>"><?php echo ucwords($DetailCategory["detail"]) ;?></option>
							<?php }
							}
						}?>
				</select>
			</td>
		</tr><tr>
			<td>Suitable Time<br>for Contact</td>
			<td><input type="text" name="suitable_time" value="<?php if(isset($_POST['suitable_time'])){ echo $_POST['suitable_time'];}?>" size="10" maxlength="50"  />&nbsp;</td>
			<td>Contact No.</td>
			<td><input type="text" name="contact_no" value="<?php if(isset($_POST['contact_no'])){ echo $_POST['contact_no'];}?>" size="10" maxlength="20"  onBlur="IsInteger(this)" />&nbsp;</td>
			<td>Counsler<span class="mandatory">*</span></td>
			<td><input type="text" name="counsel_by" value="<?php if(isset($_POST['counsel_by'])){ echo $_POST['counsel_by'];}else{echo ucwords($_SESSION['user_name']);} ?>" size="15" maxlength="50"  />&nbsp;</td>
		</tr>
	</table>
	<br>	
	<center>
		<input type="button" value="Submit Query" onClick="BSave_onclick();">&nbsp;&nbsp;&nbsp;
		<input type="button" value="Done" onClick="PageLoad(document.form1,'content.php?page=9');">
	</center>
	<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />
	<input type="hidden" name="empid" value="<?php echo $empid ;?>" />
</form>
<?php //**************************Employee Issue Detail*****************************?>
<hr />
<div id="past_query"></div>
<br>
<table cellspacing="2" cellpadding="2" border="1" align="center">
	<caption><b>Past Queries</b></caption>
	<tr align="center">
		<th>Sn.&nbsp;</th>
		<th>Issue<br>No.&nbsp;</th>
		<th>Issue<br>For&nbsp;</th>
		<th>Catg&nbsp;</th>
		<th>Sub<br>Catg&nbsp;</th>
		<th>Catg<br>Detail&nbsp;</th>
		<th>Ask<br>By&nbsp;</th>
		<th>Call<br>District&nbsp;</th>
		<th>Suitable<br>Time&nbsp;</th>
		<th>Contact<br>No.&nbsp;</th>
		<th>Counseled<br>By&nbsp;</th>
		<th>Dated&nbsp;</th>
	</tr>
<?php 
	$issue=get_all_issue_for_emp($empid);
	//echo $issue;
	$issue_count=mysql_num_rows($issue);
	if($issue_count != 0){
$j="";
		while($empissue=mysql_fetch_array($issue)){
?>
		<?php 
			if($j!=$empissue["desc_remark"]){
				$j=$empissue["desc_remark"];
				$i=1;?>
				<tr>
					<td colspan="12" bgcolor="AntiqueWhite"><B>Query:- </B><?php echo ucwords($empissue["desc_remark"]) ;?>&nbsp;</td>
				</tr>
		<?php }?>
		<tr>
			<td><?php echo $i ; $i++;?>&nbsp;</td>
			<td><?php echo $empissue["issue_id"] ;?>&nbsp;</td>
			<td>
				<?php 
					$relative = strstr($empissue['query_for'],"-");
					if($relative == ""){
						$emp1=get_emp_by_id($empissue['query_for']);
						$employee1=mysql_fetch_array($emp1);
						echo $employee1['emp_name'] ;
					}else{
						$arr = explode("-",$empissue['query_for']);
						$emparr = $arr[0];
						$relativearr = $arr[1];
						$emp1=get_relative_of_emp($emparr,$relativearr);
						$employee1=mysql_fetch_array($emp1);
						echo $employee1['relative_name'] ;
					}
				?>
				&nbsp;
			</td>
			<td>
				<?php 
					$Cat=get_catg_by_id($empissue['cat_id']);
					$Category=mysql_fetch_array($Cat);
					echo $Category["cat_name"] ;
				?>
				&nbsp;
			</td>
			<td>
				<?php 
					$SubCat=get_sub_catg_by_id($empissue['cat_id'],$empissue['sub_cat_id']);
					$SubCategory=mysql_fetch_array($SubCat);
					echo $SubCategory["sub_cat_name"] ;
				?>
				&nbsp;
			</td>
			<td>
				<?php 
					$Detail=get_detail_by_id($empissue['cat_id'],$empissue['sub_cat_id'],$empissue['cat_detail_id']);
					$CatDetail=mysql_fetch_array($Detail);
					echo $CatDetail["detail"] ;
				?>
				&nbsp;
			</td>
			<td><?php echo ucwords($empissue["caller_relation"]) ;?>&nbsp;</td>
			<td><?php 
					$Dist=get_district_by_id($empissue['call_district']);
					$District=mysql_fetch_array($Dist);
					echo $District["district_name"] ;
				?>&nbsp;
			</td>
			<td><?php echo strtoupper($empissue["suitable_time"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($empissue["contact_no"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($empissue["counsel_by"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($empissue["date"]) ;?>&nbsp;</td>
		</tr>
	<?php }
	}else{?>
		<tr>
			<td colspan="12" align="center"><font color="red"><B>No Past Query.</B></font>&nbsp;</td>
		</tr>
<?php }?>
</table>

