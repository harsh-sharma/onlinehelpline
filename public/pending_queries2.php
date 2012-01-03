<form action="" method="post" name="form1">
<?php
	$cat_id = $_REQUEST['cat_id'];
	$sub_cat_id = $_REQUEST['sub_cat_id'];
	$cat_detail_id = $_REQUEST['cat_detail_id'];
	$day = $_REQUEST['day'];
	$month = $_REQUEST['month'];
	$year = $_REQUEST['year'];
	$satisfied_by = $_REQUEST['satisfied_by'];
	
	if ($day != "" && $month != "" && $year != ""){
		$date = $year."-".$month."-".$day;
	}else{$date = "";}
	
	$order = "";	
	
	$issue=get_all_pending_issue1($cat_id,$sub_cat_id,$cat_detail_id,$date,$order);
	//echo $issue;
	$issue_count=mysql_num_rows($issue);
?>
	<input type="hidden" name="cat_id" value="<?php echo $cat_id;?>"/>
	<input type="hidden" name="sub_cat_id" value="<?php echo $sub_cat_id;?>"/>
	<input type="hidden" name="cat_detail_id" value="<?php echo $cat_detail_id;?>"/>
	<input type="hidden" name="day" value="<?php echo $day;?>"/>
	<input type="hidden" name="month" value="<?php echo $month;?>"/>
	<input type="hidden" name="year" value="<?php echo $year;?>"/>
	<input type="hidden" name="satisfied_by" value="<?php echo $satisfied_by;?>"/>
	<br>
<table cellspacing="2" cellpadding="2" border="1" align="center" width="98%">
	<caption><b>Saved Queries</b><caption>
	<tr align="center">
		<th>Sn.&nbsp;</th>
		<th>Dated&nbsp;</th>
		<th>Catg&nbsp;</th>
		<th>Query<br>For&nbsp;</th>
		<th>Contact<br>Person&nbsp;</th>
		<th>Contact<br>Number&nbsp;</th>
		<th>Suitable<br>Time&nbsp;</th>
	</tr>
<?php 
	if($issue_count != 0){
$j="";
		while($empissue=mysql_fetch_array($issue)){
			if (isset($_REQUEST["chk{$empissue["issue_id"]}"])){
?>
		<?php 
			if($j!=$empissue["desc_remark"]){
				$j=$empissue["desc_remark"];
				$i=1;?>
				<tr>
					<td colspan="7" bgcolor="AntiqueWhite"><B>Query:- </B><?php echo ucwords($empissue["desc_remark"]) ;?>&nbsp;</td>
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
		</tr>
		<?php
			$query = "update issue_master1 set status='Completed', satisfied_by='".$satisfied_by."' where issue_id='".$empissue["issue_id"]."'";
			$result = mysql_query($query,$conn);
		?>
	<?php }
		}
	}else{?>
		<tr>
			<td colspan="12" align="center"><font color="red"><B>No Past Query.</B></font>&nbsp;</td>
		</tr>
<?php }?>
</table>
<br>
<center>
	<input type="button" name ="Back" value="Back" onclick="javascript:history.back();">
	<input type="button" name ="OK" value="OK" onclick="PageLoad(document.form1,'content.php?page=15');">
</center>