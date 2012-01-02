<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<html>
	<head>
		<title>District Wise & Rank Wise Distribution Of Queries Asked For Employee Of Diferent Categories</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body id="page">
		<h2>District Wise & Rank Wise Distribution Of Queries Asked For Employee Of Diferent Categories</h2>
		<?php set_time_limit(300000); ?>
		<table cellspacing="2" cellpadding="2" border="1" align="center">
			<tr>
				<th rowspan="3">Name of<br />District/<br />Office/<br />Units</th>
				<th rowspan="3">Rank</th>
			<?php 
				$Cat=get_all_catg('cat_id');
				
				while($Category=mysql_fetch_array($Cat)){
					//rowspan
					$rowcount1=3;
					$SubCat=get_sub_catg_for_catg($Category["cat_id"],'cat_master.cat_id,sub_cat_id');
					$SubCat_count=mysql_num_rows($SubCat);
					//colspan
					if($SubCat_count!=0){$colcount1 = $SubCat_count;}else{$colcount1 = 1;}
					//rowspan
					if($SubCat_count!=0){$rowcount1=1;}
					while($SubCategory=mysql_fetch_array($SubCat)){
						$Detail=get_detail_for_sub_catg($SubCategory["cat_id"],$SubCategory["sub_cat_id"],'sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,cat_detail_id');
						$DetailCat_count=mysql_num_rows($Detail);
						//rowspan
						if($DetailCat_count!=0){$rowcount1 = 1;}
						//colspan
						if($DetailCat_count!=0){$colcount1 += $DetailCat_count-1;}
					}
					
			?>
				<th colspan="<?php echo $colcount1;?>" rowspan="<?php echo $rowcount1;?>">
					<span title="<?php echo catg_name($Category['cat_id'],0,0);?>"><font size="-2"><?php echo $Category["cat_id"] ;?></font></span>
				</th>
			<?php }?>
				<th rowspan="3">Total</th>
			</tr>
			<tr>
			<?php 
				$Cat=get_all_catg('cat_id');
				
				while($Category=mysql_fetch_array($Cat)){
					$SubCat=get_sub_catg_for_catg($Category["cat_id"],'cat_master.cat_id,sub_cat_id');
					$SubCat_count=mysql_num_rows($SubCat);
					while($SubCategory=mysql_fetch_array($SubCat)){
						//rowspan
						$rowcount1=2;
						$Detail=get_detail_for_sub_catg($SubCategory["cat_id"],$SubCategory["sub_cat_id"],'sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,cat_detail_id');
						$DetailCat_count=mysql_num_rows($Detail);
						//rowspan
						if($DetailCat_count!=0){$rowcount1 = 1;}
						//colspan
						if($DetailCat_count!=0){$colcount1 = $DetailCat_count;}else{$colcount1 = 1;}
			?>	
							<th colspan="<?php echo $colcount1;?>" rowspan="<?php echo $rowcount1;?>">
								<span title="<?php echo catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],0);?>"><font size="-2"><?php echo $Category["cat_id"].".".$SubCategory["sub_cat_id"] ;?></font></span>
							</th>
			<?php	}
			 }?>
			</tr>
			<tr>
			<?php 
				$Cat=get_all_catg('cat_id');
				while($Category=mysql_fetch_array($Cat)){
					$SubCat=get_sub_catg_for_catg($Category["cat_id"],'cat_master.cat_id,sub_cat_id');
					$SubCat_count=mysql_num_rows($SubCat);
					while($SubCategory=mysql_fetch_array($SubCat)){
						$Detail=get_detail_for_sub_catg($SubCategory["cat_id"],$SubCategory["sub_cat_id"],'sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,cat_detail_id');
						$DetailCat_count=mysql_num_rows($Detail);
						while($CatDetail=mysql_fetch_array($Detail))
							if($DetailCat_count!=0){
			?>	
							<th colspan="1" rowspan="1">
								<span title="<?php echo catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],$CatDetail["cat_detail_id"]);?>"><font size="-2"><?php echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?></font></span>
							</th>
			<?php	}
				}
			 }?>
			</tr>
		<?php
			$Desg=get_all_designation('designation_id');
			$Desg_count=mysql_num_rows($Desg);
			$Dist=get_all_district('district_name');
			while($District=mysql_fetch_array($Dist)){
		?>
			<tr>
				<th rowspan="<?php echo $Desg_count+1;?>" align="left"><?php echo ucwords($District["district_name"]) ;?></th>
		<?php //****************************************Desg (Start)******************************************************?>
		<?php
			$mainquery = "select * 
					from issue_master1 inner join 
					employee_master on person_for=empid 
					and not person_for like concat(empid,'-%') and not person_for like concat(empid,'.%')
					where district='".$District["district_id"]."' ";
		?>	
			<?php
				$Desg=get_all_designation('designation_id');
				while($Designation=mysql_fetch_array($Desg)){
			?>
				<th align="left"><font size="-2"><?php echo ucwords($Designation["designation_name"]) ;?></font></th>
			<?php 
				$Cat=get_all_catg('cat_id');
				while($Category=mysql_fetch_array($Cat)){
					$SubCat=get_sub_catg_for_catg($Category["cat_id"],'cat_master.cat_id,sub_cat_id');
					$SubCat_count=mysql_num_rows($SubCat);
					if($SubCat_count!=0){
						while($SubCategory=mysql_fetch_array($SubCat)){
							$Detail=get_detail_for_sub_catg($SubCategory["cat_id"],$SubCategory["sub_cat_id"],'sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,cat_detail_id');
							$DetailCat_count=mysql_num_rows($Detail);
							if($DetailCat_count!=0){
								while($CatDetail=mysql_fetch_array($Detail)){
			?>	
									<td colspan="1" rowspan="1" align="right">
										<span title="<?php echo $District["district_name"]."/".$Designation["designation_name"]."/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],$CatDetail["cat_detail_id"]);?>">
										<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?>
										<?php 
										$query = $mainquery." and designation = '".$Designation["designation_id"]."' 
													and cat_id='".$Category["cat_id"]."' and sub_cat_id='".$SubCategory["sub_cat_id"]."'
													and cat_detail_id='".$CatDetail["cat_detail_id"]."'
													order by issue_id";
										$issue=mysql_query($query,$conn);
										confirm_query($issue);
										$issue_count=mysql_num_rows($issue);
										if($issue_count!=0){echo "<span class=\"mandatory\">";}
										echo $issue_count;
										if($issue_count!=0){echo "</span>";}
										?>
										</span>
									</td>
			<?php				}
							}else{
			?>			
								<td colspan="1" rowspan="1" align="right">
									<span title="<?php echo $District["district_name"]."/".$Designation["designation_name"]."/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],0);?>">
									<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".0" ;?>
									<?php 
									$query = $mainquery." and designation = '".$Designation["designation_id"]."' 
												and cat_id='".$Category["cat_id"]."' and sub_cat_id='".$SubCategory["sub_cat_id"]."'
												and cat_detail_id='0'
												order by issue_id";
									$issue=mysql_query($query,$conn);
									confirm_query($issue);
									$issue_count=mysql_num_rows($issue);
									if($issue_count!=0){echo "<span class=\"mandatory\">";}
									echo $issue_count;
									if($issue_count!=0){echo "</span>";}
									?>
									</span>
								</td>
			<?php			}
						}
					}else{
			?>		
						<td colspan="1" rowspan="1" align="right">
							<span title="<?php echo $District["district_name"]."/".$Designation["designation_name"]."/".catg_name($Category["cat_id"],0,0);?>">
							<?php //echo $Category["cat_id"].".0.0" ;?>
							<?php 
							$query = $mainquery." and designation = '".$Designation["designation_id"]."' 
										and cat_id='".$Category["cat_id"]."' 
										and sub_cat_id='0' and cat_detail_id='0'
										order by issue_id";
							$issue=mysql_query($query,$conn);
							confirm_query($issue);
							$issue_count=mysql_num_rows($issue);
							if($issue_count!=0){echo "<span class=\"mandatory\">";}
							echo $issue_count;
							if($issue_count!=0){echo "</span>";}
							?>
							</span>
						</td>
			<?php	}
				}?>
				<td colspan="1" rowspan="1" align="right">
					<span title="<?php echo $District["district_name"]."/".$Designation["designation_name"]."/Total";?>">
					<?php 
					$query = $mainquery." and designation = '".$Designation["designation_id"]."' 
								order by issue_id";
					$issue=mysql_query($query,$conn);
					confirm_query($issue);
					$issue_count=mysql_num_rows($issue);
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
					?>
					</span>
				</td>
			</tr>
			<tr>
			<?php }?>
		<?php //****************************************Desg (End)******************************************************?>
		<?php //****************************************Total (Start)******************************************************?>
				<th align="left"><font size="-2">Total</font></th>
			<?php 
				$Cat=get_all_catg('cat_id');
				while($Category=mysql_fetch_array($Cat)){
					$SubCat=get_sub_catg_for_catg($Category["cat_id"],'cat_master.cat_id,sub_cat_id');
					$SubCat_count=mysql_num_rows($SubCat);
					if($SubCat_count!=0){
						while($SubCategory=mysql_fetch_array($SubCat)){
							$Detail=get_detail_for_sub_catg($SubCategory["cat_id"],$SubCategory["sub_cat_id"],'sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,cat_detail_id');
							$DetailCat_count=mysql_num_rows($Detail);
							if($DetailCat_count!=0){
								while($CatDetail=mysql_fetch_array($Detail)){
			?>	
									<td colspan="1" rowspan="1" align="right">
										<span title="<?php echo $District["district_name"]."/Total/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],$CatDetail["cat_detail_id"]);?>">
										<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?>
										<?php 
										$query = $mainquery."  
													and cat_id='".$Category["cat_id"]."' and sub_cat_id='".$SubCategory["sub_cat_id"]."'
													and cat_detail_id='".$CatDetail["cat_detail_id"]."'
													order by issue_id";
										$issue=mysql_query($query,$conn);
										confirm_query($issue);
										$issue_count=mysql_num_rows($issue);
										if($issue_count!=0){echo "<span class=\"mandatory\">";}
										echo $issue_count;
										if($issue_count!=0){echo "</span>";}
										?>
										</span>
									</td>
			<?php				}
							}else{
			?>			
								<td colspan="1" rowspan="1" align="right">
									<span title="<?php echo $District["district_name"]."/Total/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],0);?>">
									<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".0" ;?>
									<?php 
									$query = $mainquery."  
												and cat_id='".$Category["cat_id"]."' and sub_cat_id='".$SubCategory["sub_cat_id"]."'
												and cat_detail_id='0'
												order by issue_id";
									$issue=mysql_query($query,$conn);
									confirm_query($issue);
									$issue_count=mysql_num_rows($issue);
									if($issue_count!=0){echo "<span class=\"mandatory\">";}
									echo $issue_count;
									if($issue_count!=0){echo "</span>";}
									?>
									</span>
								</td>
			<?php			}
						}
					}else{
			?>		
						<td colspan="1" rowspan="1" align="right">
							<span title="<?php echo $District["district_name"]."/Total/".catg_name($Category["cat_id"],0,0);?>">
							<?php //echo $Category["cat_id"].".0.0" ;?>
							<?php 
							$query = $mainquery." 
										and cat_id='".$Category["cat_id"]."' 
										and sub_cat_id='0' and cat_detail_id='0'
										order by issue_id";
							$issue=mysql_query($query,$conn);
							confirm_query($issue);
							$issue_count=mysql_num_rows($issue);
							if($issue_count!=0){echo "<span class=\"mandatory\">";}
							echo $issue_count;
							if($issue_count!=0){echo "</span>";}
							?>
							</span>
						</td>
			<?php	}
				}?>
				<td colspan="1" rowspan="1" align="right">
					<span title="<?php echo $District["district_name"]."/Total/Total";?>">
					<?php 
					$query = $mainquery."  
								order by issue_id";
					$issue=mysql_query($query,$conn);
					confirm_query($issue);
					$issue_count=mysql_num_rows($issue);
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
					?>
					</span>
				</td>
			</tr>
		<?php //****************************************Total (End)******************************************************?>
			</tr>
		<?php }?>
			<tr>
				<th rowspan="<?php echo $Desg_count+1;?>">Total</th>
		<?php //****************************************Desg (Start)******************************************************?>
		<?php
			$mainquery = "select * 
					from issue_master1 inner join 
					employee_master on person_for=empid 
					and not person_for like concat(empid,'-%') and not person_for like concat(empid,'.%')
					where 1=1 ";
		?>	
			<?php
				$Desg=get_all_designation('designation_id');
				while($Designation=mysql_fetch_array($Desg)){
			?>
				<th align="left"><font size="-2"><?php echo ucwords($Designation["designation_name"]) ;?></font></th>
			<?php 
				$Cat=get_all_catg('cat_id');
				while($Category=mysql_fetch_array($Cat)){
					$SubCat=get_sub_catg_for_catg($Category["cat_id"],'cat_master.cat_id,sub_cat_id');
					$SubCat_count=mysql_num_rows($SubCat);
					if($SubCat_count!=0){
						while($SubCategory=mysql_fetch_array($SubCat)){
							$Detail=get_detail_for_sub_catg($SubCategory["cat_id"],$SubCategory["sub_cat_id"],'sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,cat_detail_id');
							$DetailCat_count=mysql_num_rows($Detail);
							if($DetailCat_count!=0){
								while($CatDetail=mysql_fetch_array($Detail)){
			?>	
									<td colspan="1" rowspan="1" align="right">
										<span title="<?php echo "Total/".$Designation["designation_name"]."/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],$CatDetail["cat_detail_id"]);?>">
										<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?>
										<?php 
										$query = $mainquery." and designation = '".$Designation["designation_id"]."' 
													and cat_id='".$Category["cat_id"]."' and sub_cat_id='".$SubCategory["sub_cat_id"]."'
													and cat_detail_id='".$CatDetail["cat_detail_id"]."'
													order by issue_id";
										$issue=mysql_query($query,$conn);
										confirm_query($issue);
										$issue_count=mysql_num_rows($issue);
										if($issue_count!=0){echo "<span class=\"mandatory\">";}
										echo $issue_count;
										if($issue_count!=0){echo "</span>";}
										?>
										</span>
									</td>
			<?php				}
							}else{
			?>			
								<td colspan="1" rowspan="1" align="right">
									<span title="<?php echo "Total/".$Designation["designation_name"]."/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],0);?>">
									<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".0" ;?>
									<?php 
									$query = $mainquery." and designation = '".$Designation["designation_id"]."' 
												and cat_id='".$Category["cat_id"]."' and sub_cat_id='".$SubCategory["sub_cat_id"]."'
												and cat_detail_id='0'
												order by issue_id";
									$issue=mysql_query($query,$conn);
									confirm_query($issue);
									$issue_count=mysql_num_rows($issue);
									if($issue_count!=0){echo "<span class=\"mandatory\">";}
									echo $issue_count;
									if($issue_count!=0){echo "</span>";}
									?>
									</span>
								</td>
			<?php			}
						}
					}else{
			?>		
						<td colspan="1" rowspan="1" align="right">
							<span title="<?php echo "Total/".$Designation["designation_name"]."/".catg_name($Category["cat_id"],0,0);?>">
							<?php //echo $Category["cat_id"].".0.0" ;?>
							<?php 
							$query = $mainquery." and designation = '".$Designation["designation_id"]."' 
										and cat_id='".$Category["cat_id"]."' 
										and sub_cat_id='0' and cat_detail_id='0'
										order by issue_id";
							$issue=mysql_query($query,$conn);
							confirm_query($issue);
							$issue_count=mysql_num_rows($issue);
							if($issue_count!=0){echo "<span class=\"mandatory\">";}
							echo $issue_count;
							if($issue_count!=0){echo "</span>";}
							?>
							</span>
						</td>
			<?php	}
				}?>
				<td colspan="1" rowspan="1" align="right">
					<span title="<?php echo "Total/".$Designation["designation_name"]."/Total";?>">
					<?php 
					$query = $mainquery." and designation = '".$Designation["designation_id"]."' 
								order by issue_id";
					$issue=mysql_query($query,$conn);
					confirm_query($issue);
					$issue_count=mysql_num_rows($issue);
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
					?>
					</span>
				</td>
			</tr>
			<tr>
			<?php }?>
		<?php //****************************************Desg (End)******************************************************?>
		<?php //****************************************Total (Start)******************************************************?>
				<th align="left"><font size="-2">Total</font></th>
			<?php 
				$Cat=get_all_catg('cat_id');
				while($Category=mysql_fetch_array($Cat)){
					$SubCat=get_sub_catg_for_catg($Category["cat_id"],'cat_master.cat_id,sub_cat_id');
					$SubCat_count=mysql_num_rows($SubCat);
					if($SubCat_count!=0){
						while($SubCategory=mysql_fetch_array($SubCat)){
							$Detail=get_detail_for_sub_catg($SubCategory["cat_id"],$SubCategory["sub_cat_id"],'sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,cat_detail_id');
							$DetailCat_count=mysql_num_rows($Detail);
							if($DetailCat_count!=0){
								while($CatDetail=mysql_fetch_array($Detail)){
			?>	
									<td colspan="1" rowspan="1" align="right">
										<span title="<?php echo "Total/Total/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],$CatDetail["cat_detail_id"]);?>">
										<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?>
										<?php 
										$query = $mainquery."  
													and cat_id='".$Category["cat_id"]."' and sub_cat_id='".$SubCategory["sub_cat_id"]."'
													and cat_detail_id='".$CatDetail["cat_detail_id"]."'
													order by issue_id";
										$issue=mysql_query($query,$conn);
										confirm_query($issue);
										$issue_count=mysql_num_rows($issue);
										if($issue_count!=0){echo "<span class=\"mandatory\">";}
										echo $issue_count;
										if($issue_count!=0){echo "</span>";}
										?>
										</span>
									</td>
			<?php				}
							}else{
			?>			
								<td colspan="1" rowspan="1" align="right">
									<span title="<?php echo "Total/Total/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],0);?>">
									<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".0" ;?>
									<?php 
									$query = $mainquery."  
												and cat_id='".$Category["cat_id"]."' and sub_cat_id='".$SubCategory["sub_cat_id"]."'
												and cat_detail_id='0'
												order by issue_id";
									$issue=mysql_query($query,$conn);
									confirm_query($issue);
									$issue_count=mysql_num_rows($issue);
									if($issue_count!=0){echo "<span class=\"mandatory\">";}
									echo $issue_count;
									if($issue_count!=0){echo "</span>";}
									?>
									</span>
								</td>
			<?php			}
						}
					}else{
			?>		
						<td colspan="1" rowspan="1" align="right">
							<span title="<?php echo "Total/Total/".catg_name($Category["cat_id"],0,0);?>">
							<?php //echo $Category["cat_id"].".0.0" ;?>
							<?php 
							$query = $mainquery." 
										and cat_id='".$Category["cat_id"]."' 
										and sub_cat_id='0' and cat_detail_id='0'
										order by issue_id";
							$issue=mysql_query($query,$conn);
							confirm_query($issue);
							$issue_count=mysql_num_rows($issue);
							if($issue_count!=0){echo "<span class=\"mandatory\">";}
							echo $issue_count;
							if($issue_count!=0){echo "</span>";}
							?>
							</span>
						</td>
			<?php	}
				}?>
				<td colspan="1" rowspan="1" align="right">
					<span title="<?php echo "Total/Total/Total";?>">
					<?php 
					$query = $mainquery."  
								order by issue_id";
					$issue=mysql_query($query,$conn);
					confirm_query($issue);
					$issue_count=mysql_num_rows($issue);
					if($issue_count!=0){echo "<span class=\"mandatory\">";}
					echo $issue_count;
					if($issue_count!=0){echo "</span>";}
					?>
					</span>
				</td>
		<?php //****************************************Total (End)******************************************************?>
			</tr>
		</table>
		<br><br>
	</body>
</html>
<?php if(isset($conn)) mysql_close($conn);?>