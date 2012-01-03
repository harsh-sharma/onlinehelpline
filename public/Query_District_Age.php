<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<html>
	<head>
		<title>District Wise & Age Wise Distribution Of Queries Asked For Employee Of Diferent Categories</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body id="page">
		<h2>District Wise & Age Wise Distribution Of Queries Asked For Employee Of Diferent Categories</h2>
		<?php set_time_limit(300000); ?>
		<table cellspacing="2" cellpadding="2" border="1" align="center">
			<tr>
				<th rowspan="3">Name of<br />District/<br />Office/<br />Units</th>
				<th rowspan="3">Age</th>
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
			$Dist=get_all_district('district_name');
			while($District=mysql_fetch_array($Dist)){
		?>
			<tr>
				<th rowspan="5" align="left"><?php echo ucwords($District["district_name"]) ;?></th>
		<?php //****************************************18-30 (Start)******************************************************?>
		<?php
			$mainquery = "select * 
					from issue_master1 inner join 
					employee_master on person_for=empid 
					and not person_for like concat(empid,'-%') and not person_for like concat(empid,'.%')
					where district='".$District["district_id"]."' ";
		?>
				<th><font size="-2">18-30</font></th>
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
										<span title="<?php echo $District["district_name"]."/18-30/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],$CatDetail["cat_detail_id"]);?>">
										<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?>
										<?php 
										$query = $mainquery." and age between 18 and 30 
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
									<span title="<?php echo $District["district_name"]."/18-30/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],0);?>">
									<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".0" ;?>
									<?php 
									$query = $mainquery." and age between 18 and 30 
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
							<span title="<?php echo $District["district_name"]."/18-30/".catg_name($Category["cat_id"],0,0);?>">
							<?php //echo $Category["cat_id"].".0.0" ;?>
							<?php 
							$query = $mainquery." and age between 18 and 30 
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
					<span title="<?php echo $District["district_name"]."/18-30/Total";?>">
					<?php 
					$query = $mainquery." and age between 18 and 30 
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
		<?php //****************************************18-30 (End)******************************************************?>
		<?php //****************************************31-60 (Start)******************************************************?>
		<?php
			for ($i=31;$i<=60;$i++){
				$j=$i+9; 
		?>
			<tr>
				<th><font size="-2"><?php echo $i."-".$j;?></font></th>
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
										<span title="<?php echo $District["district_name"]."/".$i."-".$j."/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],$CatDetail["cat_detail_id"]);?>">
										<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?>
										<?php 
										$query = $mainquery." and age between ".$i." and ".$j." 
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
									<span title="<?php echo $District["district_name"]."/".$i."-".$j."/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],0);?>">
									<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".0" ;?>
									<?php 
									$query = $mainquery." and age between ".$i." and ".$j."
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
							<span title="<?php echo $District["district_name"]."/".$i."-".$j."/".catg_name($Category["cat_id"],0,0);?>">
							<?php //echo $Category["cat_id"].".0.0" ;?>
							<?php 
							$query = $mainquery." and age between ".$i." and ".$j." 
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
					<span title="<?php echo $District["district_name"]."/".$i."-".$j."/Total";?>">
					<?php 
					$query = $mainquery." and age between ".$i." and ".$j." 
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
		<?php
				$i+=9;
			}
		?>
		<?php //****************************************31-60 (End)******************************************************?>
		<?php //****************************************Total (Start)******************************************************?>
			<tr>
				<th><font size="-2">Total</font></th>
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
										$query = $mainquery." and age between 18 and 60 
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
									$query = $mainquery." and age between 18 and 60
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
							$query = $mainquery." and age between 18 and 60 
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
					$query = $mainquery." and age between 18 and 60 
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
		<?php }?>
			<tr>
				<th rowspan="5">Total</th>
		<?php //****************************************18-30 (Start)******************************************************?>
		<?php
			$mainquery = "select * 
					from issue_master1 inner join 
					employee_master on person_for=empid 
					and not person_for like concat(empid,'-%') and not person_for like concat(empid,'.%')
					where 1=1 ";
		?>
				<th><font size="-2">18-30</font></th>
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
										<span title="<?php echo "Total/18-30/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],$CatDetail["cat_detail_id"]);?>">
										<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?>
										<?php 
										$query = $mainquery." and age between 18 and 30 
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
									<span title="<?php echo "Total/18-30/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],0);?>">
									<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".0" ;?>
									<?php 
									$query = $mainquery." and age between 18 and 30 
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
							<span title="<?php echo "Total/18-30/".catg_name($Category["cat_id"],0,0);?>">
							<?php //echo $Category["cat_id"].".0.0" ;?>
							<?php 
							$query = $mainquery." and age between 18 and 30 
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
					<span title="<?php echo "Total/18-30/Total";?>">
					<?php 
					$query = $mainquery." and age between 18 and 30 
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
		<?php //****************************************18-30 (End)******************************************************?>
		<?php //****************************************31-60 (Start)******************************************************?>
		<?php
			for ($i=31;$i<=60;$i++){
				$j=$i+9; 
		?>
			<tr>
				<th><font size="-2"><?php echo $i."-".$j;?></font></th>
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
										<span title="<?php echo "Total/".$i."-".$j."/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],$CatDetail["cat_detail_id"]);?>">
										<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?>
										<?php 
										$query = $mainquery." and age between ".$i." and ".$j." 
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
									<span title="<?php echo "Total/".$i."-".$j."/".catg_name($Category["cat_id"],$SubCategory["sub_cat_id"],0);?>">
									<?php //echo $Category["cat_id"].".".$SubCategory["sub_cat_id"].".0" ;?>
									<?php 
									$query = $mainquery." and age between ".$i." and ".$j."
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
							<span title="<?php echo "Total/".$i."-".$j."/".catg_name($Category["cat_id"],0,0);?>">
							<?php //echo $Category["cat_id"].".0.0" ;?>
							<?php 
							$query = $mainquery." and age between ".$i." and ".$j." 
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
					<span title="<?php echo "Total/".$i."-".$j."/Total";?>">
					<?php 
					$query = $mainquery." and age between ".$i." and ".$j." 
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
		<?php
				$i+=9;
			}
		?>
		<?php //****************************************31-60 (End)******************************************************?>
		<?php //****************************************Total (Start)******************************************************?>
			<tr>
				<th><font size="-1">Total</font></th>
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
										$query = $mainquery." and age between 18 and 60 
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
									$query = $mainquery." and age between 18 and 60
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
							$query = $mainquery." and age between 18 and 60 
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
					$query = $mainquery." and age between 18 and 60 
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
			</tr>
		</table>
		<br><br>
	</body>
</html>
<?php if(isset($conn)) mysql_close($conn);?>