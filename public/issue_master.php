<?php
	//**************************Employee Detail*****************************
	$empid=$_GET['empid'];
	$emp=get_emp_by_id($empid);
	$employee=mysql_fetch_array($emp) 
?>
	<table align="center" border="1" cellpadding="2" cellspacing="0">
		<tr>
			<th align="left">Name</th><td><?php echo $employee['emp_name'];?>&nbsp;</td>
			<th align="left">Father/Husband Name</th>	<td><?php echo $employee['father_husband_name'];?>&nbsp;</td>
			<th align="left">Designation</th><td><?php echo $employee['designation'];?>&nbsp;</td>
		</tr><tr>
			<th align="left">Date of Birth </th><td><?php echo $employee['dob'];?></td>
			<th align="left">Age</th><td><?php echo $employee['age'];?> Years&nbsp;</td>
			<th align="left">Sutable Time</th><td><?php echo $employee['sutable_time'];?>&nbsp;</td>
		</tr><tr>
			<th align="left">Phone No. </th><td><?php echo $employee['phone_no'];?>&nbsp;</td>
			<th align="left">Mobile No. </th><td><?php echo $employee['mobile_no'];?>&nbsp;</td>
			<th align="left">Email Id </th><td><?php echo $employee['email_id'];?>&nbsp;</td>
		</tr><tr>
			<th align="left">Gender</th><td><?php echo $employee['gender'];?></td>
			<th align="left">District</th>
			<td><?php 
					$Dist=get_district_by_id($employee['district']);
					$District=mysql_fetch_array($Dist);
					echo $District["district_name"] ;
				?>&nbsp;
			</td>
			<th align="left">Native Place</th><td><?php echo $employee['native_place'];?>&nbsp;</td>
		</tr><tr>
			<th align="left">Address</th><td colspan="5"><?php echo $employee['address'];?>&nbsp;</td>		
		</tr>
	</table>
<hr>
<?php //**************************Create Issue*****************************?>
<script language="javascript">
function BSave_onclick(){
	if(IsBlank(document.form1.caller_relation) == false)return false;
	if(IsBlank(document.form1.call_district) == false)return false;
	if(IsBlank(document.form1.counsel_by) == false)return false;
	if(IsBlank(document.form1.cat_id) == false)return false;
	if(IsBlank(document.form1.desc_remark) == false)return false;
	PageLoad(document.form1,'issue_master1.php')
}
</script>
<form action="" method="post" name="form1">
	<table align="center" border="1" cellpadding="2" cellspacing="0">
		<tr>
		   <td>Relation With Emp<span class="mandatory">*</span></td>
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
			<td><input type="text" name="call_district" value="<?php if(isset($_POST['call_district'])){ echo $_POST['call_district'];}?>" size="15" maxlength="50" />&nbsp;</td>
			<td>Counsler<span class="mandatory">*</span></td>
			<td><input type="text" name="counsel_by" value="<?php echo ucwords($_SESSION['user_name']); ?>" size="15" maxlength="50"  />&nbsp;</td>
         </tr><tr>
			<td>Category<span class="mandatory">*</span></td>
			<td>
				<select name="cat_id" onchange="PageLoad(document.form1,'content.php?page=7&empid=<?php echo $empid;?>')">
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
				<select name="sub_cat_id" onchange="PageLoad(document.form1,'content.php?page=7&empid=<?php echo $empid;?>')">
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
		   <td>Description<span class="mandatory">*</span></td>
		   <td colspan="5"><textarea name="desc_remark" value="" rows="5" cols="50" ><?php if(isset($_POST['desc_remark'])){ echo $_POST['desc_remark'];}?></textarea>&nbsp;</td>
		</tr>
	</table>
	<br>	
	<center><input type="button" value="Submit Query" onClick="BSave_onclick();"></center>
	<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />
	<input type="hidden" name="empid" value="<?php echo $empid ;?>" />
</form>
<?php //**************************Employee Issue Detail*****************************?>
<hr />
<table cellspacing="2" cellpadding="2" border="1" align="center">
	<caption><b>Past Queries</b></caption>
	<tr align="left">
		<th>Sn.&nbsp;</th>
		<th>Issue No&nbsp;</th>
		<th>Catg&nbsp;</th>
		<th>Sub Catg&nbsp;</th>
		<th>Catg Detail&nbsp;</th>
		<th>Ask By&nbsp;</th>
		<th>Call from&nbsp;</th>
		<th>Counsel By&nbsp;</th>
		<th>Dated&nbsp;</th>
	</tr>
<?php 
	$issue=get_all_issue_for_emp($empid);
	//echo $issue;
	$issue_count=mysql_num_rows($issue);
	if($issue_count != 0){
		$i=1;
		while($empissue=mysql_fetch_array($issue)){
?>
		<tr>
			<td rowspan="2"><?php echo $i ; $i++;?>&nbsp;</td>
			<td><?php echo $empissue["issue_id"] ;?>&nbsp;</td>
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
			<td><?php echo ucwords($empissue["call_district"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($empissue["counsel_by"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($empissue["date"]) ;?>&nbsp;</td>
		</tr><tr>
			<td colspan="8" bgcolor="AntiqueWhite"><B>Query:- </B><?php echo ucwords($empissue["desc_remark"]) ;?>&nbsp;</td>
		</tr>
	<?php }
	}else{?>
		<tr>
			<td colspan="9" align="center"><font color="red"><B>No Past Query.</B></font>&nbsp;</td>
		</tr>
<?php }?>
</table>
