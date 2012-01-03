<script language="javascript">
function save_pending(){
	if(IsBlank(document.form1.satisfied_by) == false)return false;
	PageLoad(document.form1,'content.php?page=17');
}
</script>
<form action="" method="post" name="form1">
<?php
	$cat_id = $_REQUEST['cat_id'];
	$sub_cat_id = $_REQUEST['sub_cat_id'];
	$cat_detail_id = $_REQUEST['cat_detail_id'];
	$day = $_REQUEST['day'];
	$month = $_REQUEST['month'];
	$year = $_REQUEST['year'];
	
	if ($day != "" && $month != "" && $year != ""){
		$date = $year."-".$month."-".$day;
	}else{$date = "";}
	
	$order = "";
	if(isset($_REQUEST['sort'])){$sort = $_REQUEST['sort'];}else{$sort="";}
	if($sort == "1.1"){$order = "date";}
	if($sort == "1.2"){$order = "date desc";}
	if($sort == "2.1"){$order = "cat_id,sub_cat_id,cat_detail_id";}
	if($sort == "2.2"){$order = "cat_id desc,sub_cat_id desc,cat_detail_id desc";}
	if($sort == "3.1"){$order = "person_for";}
	if($sort == "3.2"){$order = "person_for desc";}
	
	$str = "content.php?page=16&cat_id=".$cat_id."&sub_cat_id=".$sub_cat_id."&cat_detail_id=".$cat_detail_id."&day=".$day."&month=".$month."&year=".$year."&sort=";
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
		<th>Check&nbsp;</th>
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
					<td colspan="7" bgcolor="AntiqueWhite"><B>Query:- </B><?php echo ucwords($empissue["desc_remark"]) ;?>&nbsp;</td><td></td>
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
			<td align="center"><input type="checkbox" name="chk<?php echo $empissue["issue_id"];?>"></td>
		</tr>
	<?php }
	}else{?>
		<tr>
			<td colspan="12" align="center"><font color="red"><B>No Past Query.</B></font>&nbsp;</td>
		</tr>
<?php }?>
</table>
<br>
<center>
	<b>Satisfied By<font color="red">*</font></b>
	<select name="satisfied_by">
		<option value="">--Select--</option>
		<option value="Counselor">Counselor</option>
		<option value="Research Officer">Research Officer</option>
		<option value="Co-Investigator I">Co-Investigator I</option>
		<option value="Co-Investigator II">Co-Investigator II</option>
		<option value="Pricipal Investigator">Pricipal Investigator</option>
		<option value="Special">Specialist</option>
	</select>&nbsp;
	<br><br>
	<input type="button" name ="Back" value="Back" onclick="javascript:history.back();">
	<input type="button" name ="Submit" value="Submit" onclick="save_pending()">
</center>