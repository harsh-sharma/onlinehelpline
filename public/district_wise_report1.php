<?php
	$cat_id = $_REQUEST['cat_id'];
	$native_place = $_REQUEST['native_place'];
	
	
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
	
	$str = "content.php?page=23&cat_id=".$cat_id."&native_place=".$native_place."&sort=";
	$query = "select * 
		from issue_master1 inner join 
		employee_master on employee_master.empid=issue_master1.person_for 
		where cat_id='".$cat_id."' and native_place='".$native_place."' 
		order by ".$order;
	$issue=mysql_query($query,$conn);
	confirm_query($issue);
	$issue_count=mysql_num_rows($issue);
?>
	<input type="hidden" name="cat_id" value="<?php echo $cat_id;?>"/>
	<input type="hidden" name="native_place" value="<?php echo $native_place;?>"/>
	<br>
<table cellspacing="2" cellpadding="2" border="1" align="center" width="98%">
	<tr align="center">
		<th>Sn.&nbsp;</th>
		<th><a href="<?php echo $str; if(isset($_REQUEST['sort'])){if($_REQUEST['sort']=="1.1"){echo 1.2;}else{echo 1.1;}}else{echo 1.1;} ?>">Dated</a>&nbsp;</th>
		<th><a href="<?php echo $str; if(isset($_REQUEST['sort'])){if($_REQUEST['sort']=="2.1"){echo 2.2;}else{echo 2.1;}}else{echo 2.1;} ?>">Catg</a>&nbsp;</th>
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
					<td colspan="8" bgcolor="AntiqueWhite"><B>Query:- </B><?php echo ucwords($empissue["desc_remark"]) ;?>&nbsp;</td>
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
	
	<input type="button" name ="Close" value="Close" onclick="javascript:window.close();">