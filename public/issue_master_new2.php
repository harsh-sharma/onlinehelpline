<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/form_functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	$errors =array();
	$required_fields = array('query_for','caller_relation','call_district','desc_remark','cat_id','counsel_by');
	foreach($required_fields as $fieldname){
		if (!isset($_GET[$fieldname]) || empty($_GET[$fieldname])){
			$errors[] = $fieldname;
		}
	}
	
	if (empty($errors)){
	
		$cat_id = mysql_prep($_GET['cat_id']);
		$sub_cat_id = mysql_prep($_GET['sub_cat_id']);
		$cat_detail_id = mysql_prep($_GET['cat_detail_id']);
		$query_for = mysql_prep($_GET['query_for']);
		$desc_remark = ucwords(trim(mysql_prep($_GET['desc_remark'])));
		$caller_relation = mysql_prep($_GET['caller_relation']);
		$call_district = ucwords(trim(mysql_prep($_GET['call_district'])));
		$suitable_time = ucwords(trim(mysql_prep($_GET['suitable_time'])));
		$contact_no = ucwords(trim(mysql_prep($_GET['contact_no'])));
		$counsel_by = ucwords(trim(mysql_prep($_GET['counsel_by'])));
		
		$query = "select max(issue_id) as maxid from issue_master";
		//echo $query."<br>";
		$sql=mysql_query($query,$conn);
		confirm_query($sql);
		$max=mysql_fetch_array($sql);
		$issue_id=$max['maxid']+1;
		//echo $issue_id."<br>";
		
		$query = "insert into issue_master 
				(issue_id, cat_id, sub_cat_id, cat_detail_id, query_for, desc_remark, caller_relation, call_district, suitable_time, contact_no, counsel_by) 
				values 
				('".$issue_id."', '".$cat_id."', '".$sub_cat_id."', '".$cat_detail_id."', '".$query_for."', '".$desc_remark."', '".$caller_relation."', '".$call_district."', '".$suitable_time."', '".$contact_no."', '".$counsel_by."')";
		//echo $query;
		$result = mysql_query($query,$conn);
		
		if($result){
			echo "<p><span class=\"mandatory\">Issue created successfully.</span></p>";
			//echo $issue_id;?>
			<table cellspacing="2" cellpadding="2" border="1" align="center">
				<caption><b>New Query</b></caption>
				<tr align="center">
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
				$issue=get_issue_by_id($issue_id);
				//echo $issue;
				$issue_count=mysql_num_rows($issue);
				if($issue_count != 0){
					while($empissue=mysql_fetch_array($issue)){
			?>
					<tr>
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
					</tr><tr>
						<td colspan="11" bgcolor="AntiqueWhite"><B>Query:- </B><?php echo ucwords($empissue["desc_remark"]) ;?>&nbsp;</td>
					</tr>
				<?php }
				}else{?>
					<tr>
						<td colspan="12" align="center"><font color="red"><B>No Past Query.</B></font>&nbsp;</td>
					</tr>
			<?php }?>
			</table>
	<?php }else{
			echo "<p><span class=\"mandatory\">Issue creation failed.</p>";
			echo "<p>". mysql_error() ."</span></p>";
		}
	}else{
		echo "<p><span class=\"mandatory\">Issue creation failed123.</p>";
		echo "<p>". mysql_error() ."</span></p>";
	}
?>
<?php if(isset($conn)) mysql_close($conn);?>