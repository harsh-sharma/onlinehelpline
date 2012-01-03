<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/form_functions.php");?>
<?php confirm_logged_in(); ?>
<?php
		$cat_id = mysql_prep($_GET['cat_id']);
		$sub_cat_id = mysql_prep($_GET['sub_cat_id']);
		$cat_detail_id = mysql_prep($_GET['cat_detail_id']);
		
		$person_by = mysql_prep($_GET['person_by']);
		$person_for = mysql_prep($_GET['person_for']);
		
		$desc_remark = ucwords(trim(mysql_prep($_GET['desc_remark'])));
		
		$satisfied_by = mysql_prep($_GET['satisfied_by']);
		
		$contact_name = ucwords(trim(mysql_prep($_GET['contact_person'])));
		$contact_no = ucwords(trim(mysql_prep($_GET['contact_no'])));
		$suitable_time = ucwords(trim(mysql_prep($_GET['suitable_time'])));
		
		$counsel_by = ucwords($_SESSION['user_name']);
		if ($satisfied_by == 'Not Satisfied'){
			$status = "Pending";
		}else{
			$status = "Completed";
		}
		
		$query = "select max(issue_id) as maxid from issue_master1";
		//echo $query."<br>";
		$sql=mysql_query($query,$conn);
		confirm_query($sql);
		$max=mysql_fetch_array($sql);
		$issue_id=$max['maxid']+1;
		//echo $issue_id."<br>";
		
		$query = "insert into issue_master1 
				(issue_id, cat_id, sub_cat_id, cat_detail_id, person_by, person_for, desc_remark, satisfied_by, contact_name, contact_no, suitable_time, counsel_by, status) 
				values 
				('".$issue_id."', '".$cat_id."', '".$sub_cat_id."', '".$cat_detail_id."', '".$person_by."', '".$person_for."', '".$desc_remark."', '".$satisfied_by."', '".$contact_name."', '".$contact_no."', '".$suitable_time."', '".$counsel_by."', '".$status."')";
		//echo $query;
		$result = mysql_query($query,$conn);
		
		if($result){
			
			//echo $issue_id;?>
			<fieldset>
			<legend><b>New Query Saved</legend>
			<?php echo "<p><span class=\"mandatory\">Query created successfully.</span></p>";?>
			<table cellspacing="2" cellpadding="2" border="1" align="center">
				<tr align="center">
					<th>Sn.&nbsp;</th>
					<th>Asked<br>For&nbsp;</th>
					<th width="50%">Query&nbsp;</th>
					<th>Catg&nbsp;</th>
					<th>Asked<br>By&nbsp;</th>
                         	</tr>
                               

			<?php 
				$query = "select *
						from issue_master1 
						where issue_id='".$issue_id."' ";
				$issue=mysql_query($query,$conn);
				confirm_query($issue);
				$issue_count=mysql_num_rows($issue);
				if($issue_count != 0){
					$j="";
					$i=1;
					$empissue=mysql_fetch_array($issue)
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
								echo $empissue['contact_name'];
								/*if($empissue['person_by'] != "Relative"){
									$relative = strstr($empissue['person_by'],"-");
									if($relative == ""){
										$emp1=get_emp_by_id($empissue['person_by']);
										$employee1=mysql_fetch_array($emp1);
										echo $employee1['emp_name'] ;
									}else{
										$arr = explode("-",$empissue['person_by']);
										$emparr = $arr[0];
										$relativearr = $arr[1];
										$emp1=get_relative_of_emp($emparr,$relativearr);
										$employee1=mysql_fetch_array($emp1);
										echo $employee1['relative_name'] ;
									}
								}else{
									echo $empissue['contact_name'] ;
								}*/
							?>
							&nbsp;
						</td>
					</tr>
				<?php 
				}else{?>

					<tr>
						<td colspan="12" align="center"><font color="red"><B>No Past Query.</B></font>&nbsp;</td>
					</tr>
			<?php }?>


			</table>
 <p align="right"><input type="button" name ="Go10" value="Done" onClick="PageLoad(document.form1,'content.php?page=14')"> </p>
			</fieldset>
	<?php }else{
			echo "<p><span class=\"mandatory\">Issue creation failed.</p>";
			echo "<p>". mysql_error() ."</span></p>";
		}
?>
<?php if(isset($conn)) mysql_close($conn);?>