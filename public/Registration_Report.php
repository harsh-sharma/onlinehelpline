<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<html>
	<head>
		<title>Total Registration - District Wise & Rank Wise</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body id="page">
		<h2>Total Registration - District Wise & Rank Wise</h2>
		<table cellspacing="2" cellpadding="2" border="1" align="center">
			<tr>
				<th rowspan=2>Name of<br />District/<br />Office/<br />Units</th>
				<?php 
					$Desg=get_all_designation('designation_id');
					$Desg_count=mysql_num_rows($Desg);
				?>
				<th colspan="<?php echo $Desg_count;?>">Ranks</th>
				<th rowspan=2>Total</th>
			</tr><tr>
				<?php while($Designation=mysql_fetch_array($Desg)){?>
					<th><?php echo ucwords($Designation["designation_name"]) ;?></th>
				<?php }?>
			</tr>
		<?php
			$Dist=get_all_district('district_name');
			while($District=mysql_fetch_array($Dist)){
		?>
			<tr>
				<th align="left"><?php echo ucwords($District["district_name"]) ;?></th>
				<?php 
					$Desg=get_all_designation('designation_id');
					$dist_count=0;
					while($Designation=mysql_fetch_array($Desg)){
						$query = "select *
									from employee_master
									where district='".$District["district_id"]."' 
										and designation='".$Designation["designation_id"]."' 
									order by empid";
						$emp=mysql_query($query,$conn);
						confirm_query($emp);
						$emp_count=mysql_num_rows($emp);
						$dist_count+=$emp_count;
				?>
					<td align="right">
						<span title="<?php echo $District["district_name"]."/".$Designation["designation_name"];?>">
						<?php 
							if($emp_count!=0){echo "<span class=\"mandatory\">";}
							echo $emp_count;
							if($emp_count!=0){echo "</span>";}
						?>&nbsp;
						</span>
					</td>
				<?php }?>
				<td align="right">
					<span title="<?php echo $District["district_name"]."/Total";?>">
					<?php 
						if($dist_count!=0){echo "<span class=\"mandatory\">";}
						echo $dist_count;
						if($dist_count!=0){echo "</span>";}
					?>&nbsp;
					</span>
				</td>
			</tr>
		<?php }?>
			<tr>
				<th>Total</th>
				<?php 
					$Desg=get_all_designation('designation_id');
					$dist_count=0;
					while($Designation=mysql_fetch_array($Desg)){
						$query = "select *
									from employee_master
									where designation='".$Designation["designation_id"]."' 
									order by empid";
						$emp=mysql_query($query,$conn);
						confirm_query($emp);
						$emp_count=mysql_num_rows($emp);
						$dist_count+=$emp_count;
				?>
					<td align="right">
						<span title="<?php echo "Total/".$Designation["designation_name"];?>">
						<?php 
							if($emp_count!=0){echo "<span class=\"mandatory\">";}
							echo $emp_count;
							if($emp_count!=0){echo "</span>";}
						?>&nbsp;
						</span>
					</td>
				<?php }?>
				<td align="right">
					<span title="<?php echo "Total/Total";?>">
					<?php 
						if($dist_count!=0){echo "<span class=\"mandatory\">";}
						echo $dist_count;
						if($dist_count!=0){echo "</span>";}
					?>&nbsp;
					</span>
				</td>
			</tr>
		</table>
		<br><br>
	</body>
</html>
<?php if(isset($conn)) mysql_close($conn);?>