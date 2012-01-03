<?php
	
	$district = $_REQUEST['district'];
	$designation = $_REQUEST['designation'];
	$age = $_REQUEST['age'];
	$cat_id = $_REQUEST['cat_id'];
	$sub_cat_id = $_REQUEST['sub_cat_id'];
	$cat_detail_id = $_REQUEST['cat_detail_id'];
	$query_by = $_REQUEST['query_by'];
	$query_for = $_REQUEST['query_for'];
	
	/*echo "district ".$district."<br>";
	echo "designation ".$designation."<br>";
	echo "age ".$age."<br>";
	echo "cat_id ".$cat_id."<br>";
	echo "sub_cat_id ".$sub_cat_id."<br>";
	echo "cat_detail_id ".$cat_detail_id."<br>";
	echo "query_by ".$query_by."<br>";
	echo "query_for ".$query_for."<br><br>";*/
	
	if($age != 0){
		$arr=explode("-",$age);
		$age1 = $arr[0];
		$age2 = $arr[1];
	}
	
	$order = " desc_remark";
	if(isset($_REQUEST['sort'])){$sort = $_REQUEST['sort'];}else{$sort="";}
	if($sort == "1.1"){$order = "date";}
	if($sort == "1.2"){$order = "date desc";}
	if($sort == "2.1"){$order = "cat_id,sub_cat_id,cat_detail_id";}
	if($sort == "2.2"){$order = "cat_id desc,sub_cat_id desc,cat_detail_id desc";}
	if($sort == "3.1"){$order = "person_for";}
	if($sort == "3.2"){$order = "person_for desc";}
	if($sort == "4.1"){$order = "status";}
	if($sort == "4.2"){$order = "status desc";}
	
	$str = "content.php?page=32
			&district=".$district."&designation=".$designation."
			&age=".$age."&cat_id=".$cat_id."
			&sub_cat_id=".$sub_cat_id."&cat_detail_id=".$cat_detail_id."
			&query_by=".$query_by."&query_for=".$query_for."
			&sort=";
	$query = "select * 
		from issue_master1 inner join 
		employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%') 
		where 1=1 ";
	
	if($district != 0){$query .= " and district='".$district."' ";}
	if($designation != 0){$query .= " and designation='".$designation."' ";}
	if($age != 0){$query .= " and age between '".$age1."' and '".$age2."' ";}
	if($cat_id != 0){$query .= " and cat_id='".$cat_id."' ";}
	if($sub_cat_id != 0){$query .= " and sub_cat_id='".$sub_cat_id."' ";}
	if($cat_detail_id != 0){$query .= " and cat_detail_id='".$cat_detail_id."' ";}
	if($query_by != "0"){
		$query .= " and ";
		if($query_by != "Relative"){
			$query .= " not ";
		}
		$query .= " person_by='Relative' ";
	}
	if($query_for != "0"){
		$query .= " and ";
		if($query_for != "Relative"){
			$query .= " not ";
		}
		$query .= " (person_for like '%-%' or person_for like '%.%') ";
	}
	
	$query .= " order by ".$order;
	//echo $query;
	$issue=mysql_query($query,$conn);
	confirm_query($issue);
	$issue_count=mysql_num_rows($issue);
	echo "<br><b>Issue Count = ".$issue_count."</b>";
?>
	
	<input type="hidden" name="district" value="<?php echo $district;?>"/>
	<input type="hidden" name="designation" value="<?php echo $designation;?>"/>
	<input type="hidden" name="age" value="<?php echo $age;?>"/>
	<input type="hidden" name="cat_id" value="<?php echo $cat_id;?>"/>
	<input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id;?>"/>
	<input type="hidden" name="cat_detail_id" value="<?php echo $cat_detail_id;?>"/>
	<input type="hidden" name="query_by" value="<?php echo $query_by;?>"/>
	<input type="hidden" name="query_for" value="<?php echo $query_for;?>"/>
	<br>
<table cellspacing="2" cellpadding="2" border="1" align="center" width="80%">
	<tr align="center">
		<th>Sn.&nbsp;</th>
		<th><a href="<?php echo $str; if(isset($_REQUEST['sort'])){if($_REQUEST['sort']=="1.1"){echo 1.2;}else{echo 1.1;}}else{echo 1.1;} ?>">Dated</a>&nbsp;</th>
		<th><a href="<?php echo $str; if(isset($_REQUEST['sort'])){if($_REQUEST['sort']=="2.1"){echo 2.2;}else{echo 2.1;}}else{echo 2.1;} ?>">Catg</a>&nbsp;</th>
		<th>Employee<br>Id&nbsp;</th>
		<th><a href="<?php echo $str; if(isset($_REQUEST['sort'])){if($_REQUEST['sort']=="3.1"){echo 3.2;}else{echo 3.1;}}else{echo 3.1;} ?>">Query<br>For</a>&nbsp;</th>
		<th>Contact<br>Person&nbsp;</th>
		<th>Contact<br>Number&nbsp;</th>
		<th>Suitable<br>Time&nbsp;</th>
		<th><a href="<?php echo $str; if(isset($_REQUEST['sort'])){if($_REQUEST['sort']=="4.1"){echo 4.2;}else{echo 4.1;}}else{echo 4.1;} ?>">Status</a>&nbsp;</th>
	</tr>
<?php 
	if($issue_count != 0){
$j="";
		while($empissue=mysql_fetch_array($issue)){
?>
		<?php 
			if($j!=$empissue["desc_remark"]){
				$j=$empissue["desc_remark"];
				$i=1;?>
				<tr>
					<td colspan="9" bgcolor="AntiqueWhite"><B>Query:- </B><?php echo ucwords($empissue["desc_remark"]) ;?>&nbsp;</td>
				</tr>
		<?php }?>
		<tr>
			<td><?php echo $i ; $i++;?>&nbsp;</td>
			<td><?php echo change_date($empissue["date"]) ;?>&nbsp;</td>
			<td><span title="<?php echo catg_name($empissue['cat_id'],$empissue['sub_cat_id'],$empissue['cat_detail_id']);?>">
				<?php echo $empissue['cat_id'];?>
				<?php if($empissue['sub_cat_id'] != 0){echo ".".$empissue['sub_cat_id'];}?>
				<?php if($empissue['cat_detail_id'] != 0){echo ".".$empissue['cat_detail_id'];}?>
				</span>&nbsp;
			</td>
			<td><span title="<?php echo $empissue["emp_name"];?>">
				<?php echo $empissue["empid"];?></span>&nbsp;
			</td>
			<td>
				<?php 
					$relative = strstr($empissue['person_for'],"-");
					if($relative == ""){
						$emp1=get_emp_by_id($empissue['person_for']);
						$employee1=mysql_fetch_array($emp1);
						echo $employee1['emp_name'] ;
					}else{
						$arr = explode("-",$empissue['person_for']);
						$emparr = $arr[0];
						$relativearr = $arr[1];
						$emp1=get_relative_of_emp($emparr,$relativearr);
						$employee1=mysql_fetch_array($emp1);
						echo $employee1['relative_name'] ;
					}
				?>
				&nbsp;
			</td>
			<td><?php echo ucwords($empissue["contact_name"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($empissue["contact_no"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($empissue["suitable_time"]) ;?>&nbsp;</td>
			<td><?php echo ucwords($empissue["status"]) ;?>&nbsp;</td>
		</tr>
	<?php }
	}else{?>
		<tr>
			<td colspan="12" align="center"><font color="red"><B>No Past Query.</B></font>&nbsp;</td>
		</tr>
<?php }?>
</table>
<br><br>
	<form action="" method="post" name="form1">
	<input type="button" name ="Done" value="Done" onclick="PageLoad(document.form1,'content.php?page=30')">
	</form>