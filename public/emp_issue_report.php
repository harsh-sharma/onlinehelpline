<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<html>
	<head>
		<title>Employee and Relatives Past Queries</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body bgcolor="#eee4b9">
		<table align="center" width="100%" height="100%"><tr><td>
			<tr>
				<td id="page">
					<?php
						$empid=$_GET['empid'];
						$emp=get_emp_by_id($empid);
						$employee=mysql_fetch_array($emp)
					?>
					<h4>Employee and Relatives Past Queries of <font color="Brown"><?php echo $employee['emp_name']." -(".$employee['empid'].")";?></font></h4>
					<table cellspacing="2" cellpadding="2" border="1" align="center">
						<tr align="center">
							<th>Sn.&nbsp;</th>
							<th>Dated&nbsp;</th>
							<th>Catg&nbsp;</th>
							<th>Query<br>For&nbsp;</th>
							<th>Query<br>By&nbsp;</th>
						</tr>
					<?php 
						$empid=$_GET['empid'];
						$issue=get_all_issue1_for_emp($empid);
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
										<td colspan="5" bgcolor="AntiqueWhite"><B>Query:- </B><?php echo ucwords($empissue["desc_remark"]) ;?>&nbsp;</td>
									</tr>
							<?php }?>
							<tr>
								<td><?php echo $i ; $i++;?>&nbsp;</td>
								<td><?php echo change_date($empissue["date"]) ;?>&nbsp;</td>
								<td><span title="<?php echo catg_name($empissue['cat_id'],$empissue['sub_cat_id'],$empissue['cat_detail_id']);?>">
									<?php echo $empissue['cat_id'] ;?>
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
								<td>
									<?php 
										if($empissue['person_by'] != "Relative"){
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
										}
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
				</td>
			</tr>
		</table>
	</body>
</html>
<?php if(isset($conn)) mysql_close($conn);?>