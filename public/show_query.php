<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/form_functions.php");?>
<?php confirm_logged_in(); ?>

	<fieldset>
	<legend><b>Past Queries of same Category</legend>
	<table cellspacing="2" cellpadding="2" border="1" align="center">
	<tr align="center">
		<th>Sn.&nbsp;</th>
		<th>Asked<br>For&nbsp;</th>
		<th width="50%">Query&nbsp;</th>
		<th>Catg&nbsp;</th>
		<th>Asked<br>By&nbsp;</th>
	</tr>
<?php 
	$empid=$_GET['empid'];
	$cat_id = $_GET['cat_id'];
	if($_GET['sub_cat_id'] != "" && $_GET['sub_cat_id'] != 0){$sub_cat_id = $_GET['sub_cat_id'];}else{$sub_cat_id = "";}
	if($_GET['cat_detail_id'] != "" && $_GET['cat_detail_id'] != 0){$cat_detail_id = $_GET['cat_detail_id'];}else{$cat_detail_id = "";}
	
	$query = "select person_for, desc_remark, cat_id, sub_cat_id, cat_detail_id
			from issue_master1 
			where (person_for='".$empid."' or person_for like '".$empid."-%') and cat_id='".$cat_id."' ";
	if($sub_cat_id!="" && $sub_cat_id!=0){$query .= " and sub_cat_id='".$sub_cat_id."' ";}
	if($cat_detail_id!="" && $cat_detail_id!=0){$query .= " and cat_detail_id='".$cat_detail_id."' ";}
	$query .= "	group by person_for, desc_remark";
	//echo $query;
	$issue=mysql_query($query,$conn);
	confirm_query($issue);
	$issue_count=mysql_num_rows($issue);
	if($issue_count != 0){
		$j="";
		$i=1;
		while($empissue=mysql_fetch_array($issue)){
?>
		<tr>
			<td><?php echo $i ; $i++;?>&nbsp;</td>
			<td>
				<?php 
					$relative = strstr($empissue['person_for'],"-");
					$relative1 = strstr($empissue['person_for'],".");
					if($relative == "" && $relative1 == ""){
						$emp1=get_emp_by_id($empissue['person_for']);
						$employee1=mysql_fetch_array($emp1);
						echo $employee1['emp_name'] ;
					}else{
						if($relative != "")
							$arr = explode("-",$empissue['person_for']);
						if($relative1 != "")
							$arr = explode(".",$empissue['person_for']);
						$emparr = $arr[0];
						$relativearr = $arr[1];
						$emp1=get_relative_of_emp($emparr,$relativearr);
						$employee1=mysql_fetch_array($emp1);
						echo $employee1['relative_name'] ;
					}
				?>
				&nbsp;
			</td>
			<td width="50%"><?php echo ucwords($empissue["desc_remark"]) ;?>&nbsp;</td>
			<td><span title="<?php echo catg_name($empissue['cat_id'],$sub_cat_id,$cat_detail_id);?>">
				<?php 
					echo $empissue['cat_id'];
					if($sub_cat_id!="" && $sub_cat_id!=0){echo ".".$empissue['sub_cat_id'];}
					if($cat_detail_id!="" && $cat_detail_id!=0){echo ".".$empissue['cat_detail_id'];}
				?>
				</span>&nbsp;
			</td>
			<td>
				<?php
					$query = "select person_by, contact_name 
							from issue_master1 
							where person_for='".$empissue['person_for']."' and desc_remark='".$empissue['desc_remark']."' 
							and cat_id='".$empissue['cat_id']."' ";
					if($sub_cat_id!="" && $sub_cat_id!=""){$query .= " and sub_cat_id='".$empissue['sub_cat_id']."' ";}
					if($cat_detail_id!="" && $cat_detail_id!=""){$query .= " and cat_detail_id='".$empissue['cat_detail_id']."' ";}
					$query .= " order by person_by";
					//echo $query."<br>";
					$person_id=mysql_query($query,$conn);
					confirm_query($person_id);
					$person = "";
					while($person_by=mysql_fetch_array($person_id)){
						//$person .= $person_by['person_by'].", ";
						
						if($person_by['person_by'] != "Relative"){
							$relative = strstr($person_by['person_by'],"-");
							if($relative == ""){
								$emp1=get_emp_by_id($person_by['person_by']);
								$employee1=mysql_fetch_array($emp1);
								$person .= $employee1['emp_name'].", " ;
							}else{
								$arr = explode("-",$person_by['person_by']);
								$emparr = $arr[0];
								$relativearr = $arr[1];
								$emp1=get_relative_of_emp($emparr,$relativearr);
								$employee1=mysql_fetch_array($emp1);
								$person .= $employee1['relative_name'].", " ;
							}
						}else{
							$person .= $person_by['contact_name'].", " ;
						}
					}
					$person = rtrim($person,", ");
					echo $person;
				?>
				&nbsp;
			</td>
		</tr>
	<?php }
	}else{?>
		<tr>
			<td colspan="12" align="center"><font color="red"><B>No Past Query.</B></font>&nbsp;</td>
		</tr>
<?php }?>
</table>
	</fieldset>
	<br>
<?php if(isset($conn)) mysql_close($conn);?>