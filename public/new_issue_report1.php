<form action="" method="post" name="form1">
	<table>
		<tr>
			<th>Categories</th>
			<?php
				$district = $_REQUEST['district'];
				$designation = $_REQUEST['designation'];
				$age = $_REQUEST['age'];
				$query_by = $_REQUEST['query_by'];
				$query_for = $_REQUEST['query_for'];
				
				/*echo "district ".$district."<br>";
				echo "designation ".$designation."<br>";
				echo "age ".$age."<br>";
				echo "query_by ".$query_by."<br>";
				echo "query_for ".$query_for."<br><br>";*/
				
				if($age != 0){
					$arr=explode("-",$age);
					$age1 = $arr[0];
					$age2 = $arr[1];
				}
				
				$str = "content.php?page=32
						&district=".$district."&designation=".$designation."
						&age=".$age."&query_by=".$query_by."&query_for=".$query_for."&";
				
				$main_query = "select * from issue_master1 inner join 
								employee_master on person_for=empid or person_for like concat(empid,'-%') or person_for like concat(empid,'.%') 
								where 1=1 ";
				//*****************Filters (Start)*******************************
				if($district != 0){$main_query .= " and district='".$district."' ";}
				if($designation != 0){$main_query .= " and designation='".$designation."' ";}
				if($age != 0){$main_query .= " and age between '".$age1."' and '".$age2."' ";}
				if($query_by != "0"){
					$main_query .= " and ";
					if($query_by != "Relative"){
						$main_query .= " not ";
					}
					$main_query .= " person_by='Relative' ";
				}
				if($query_for != "0"){
					$main_query .= " and ";
					if($query_for != "Relative"){
						$main_query .= " not ";
					}
					$main_query .= " (person_for like '%-%' or person_for like '%.%') ";
				}
				//*****************Filters (End)*******************************
				//echo $main_query;
				$issue=mysql_query($main_query,$conn);
				confirm_query($issue);
				$issue_count=mysql_num_rows($issue);
			?>
			<th>Total Issues = <?php echo $issue_count;?></th>
		</tr><tr>
			<td>
				<ul style="list-style: none;" class="pages">
				<?php 
					$Cat=get_all_catg('cat_id');
					$i=1;
					while($Category=mysql_fetch_array($Cat)){
				?>
						<li><b><?php echo $Category["cat_id"] ;?></b>&nbsp;&nbsp;<?php echo ucwords($Category["cat_name"]) ;?>
					<?php 
						$SubCat=get_sub_catg_for_catg($Category["cat_id"],'cat_master.cat_id,sub_cat_id');
						$SubCat_count=mysql_num_rows($SubCat);
						if($SubCat_count != 0){echo "<ul style=\"list-style: none;\" class=\"pages\">";
							while($SubCategory=mysql_fetch_array($SubCat)){
					?>
							<li><b><?php echo $SubCategory["cat_id"].".".$SubCategory["sub_cat_id"] ;?></b>&nbsp;&nbsp;<?php echo ucwords($SubCategory["sub_cat_name"]) ;?>
							
							
							<?php 
							$Detail=get_detail_for_sub_catg($SubCategory["cat_id"],$SubCategory["sub_cat_id"],'sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,cat_detail_id');
							$DetailCat_count=mysql_num_rows($Detail);
							if($DetailCat_count != 0){echo "<ul style=\"list-style: none;\" class=\"pages\">";
								while($CatDetail=mysql_fetch_array($Detail)){
						?>
								<li><b><?php echo $CatDetail["cat_id"].".".$CatDetail["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?></b>&nbsp;&nbsp;<?php echo ucwords($CatDetail["detail"]) ;?></li>
							<?php }
								echo "</ul>";
							}?>
							
							</li>
						<?php }
							echo "</ul>";
						}?>
						</li>
					
				<?php }?>
				</ul>
			</td>
			<td>
				<ul style="list-style: none;" class="pages">
				<?php 
					$Cat=get_all_catg('cat_id');
					$i=1;
					while($Category=mysql_fetch_array($Cat)){
				?>
						<li>
							<?php
								$query = $main_query ." and cat_id='".$Category["cat_id"]."'";
								$issue=mysql_query($query,$conn);
								confirm_query($issue);
								$issue_count=mysql_num_rows($issue);
								if($issue_count != 0){
							?>
							<a href ="<?php echo $str;?>cat_id=<?php echo urlencode($Category["cat_id"]);?>&sub_cat_id=0&cat_detail_id=0"><?php echo $issue_count;?></a>
							<?php }else{echo $issue_count;}?>
					<?php 
						$SubCat=get_sub_catg_for_catg($Category["cat_id"],'cat_master.cat_id,sub_cat_id');
						$SubCat_count=mysql_num_rows($SubCat);
						if($SubCat_count != 0){echo "<ul style=\"list-style: none;\" class=\"pages\">";
							while($SubCategory=mysql_fetch_array($SubCat)){
					?>
							<li>
								<?php
									$query = $main_query ." and cat_id='".$SubCategory["cat_id"]."' and sub_cat_id='".$SubCategory["sub_cat_id"]."'";
									$issue=mysql_query($query,$conn);
									confirm_query($issue);
									$issue_count=mysql_num_rows($issue);
									if($issue_count != 0){
								?>
								<a href ="<?php echo $str;?>cat_id=<?php echo urlencode($SubCategory["cat_id"]);?>&sub_cat_id=<?php echo urlencode($SubCategory["sub_cat_id"]);?>&cat_detail_id=0"><?php echo $issue_count;?></a>
								<?php }else{echo $issue_count;}?>
							
							<?php 
							$Detail=get_detail_for_sub_catg($SubCategory["cat_id"],$SubCategory["sub_cat_id"],'sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,cat_detail_id');
							$DetailCat_count=mysql_num_rows($Detail);
							if($DetailCat_count != 0){echo "<ul style=\"list-style: none;\" class=\"pages\">";
								while($CatDetail=mysql_fetch_array($Detail)){
						?>
								<li>
									<?php
										$query = $main_query ." and cat_id='".$CatDetail["cat_id"]."' and sub_cat_id='".$CatDetail["sub_cat_id"]."' and cat_detail_id='".$CatDetail["cat_detail_id"]."'";
										$issue=mysql_query($query,$conn);
										confirm_query($issue);
										$issue_count=mysql_num_rows($issue);
										if($issue_count != 0){
									?>
									<a href ="<?php echo $str;?>cat_id=<?php echo urlencode($CatDetail["cat_id"]);?>&sub_cat_id=<?php echo urlencode($CatDetail["sub_cat_id"]);?>&cat_detail_id=<?php echo urlencode($CatDetail["cat_detail_id"]);?>"><?php echo $issue_count;?></a>
									<?php }else{echo $issue_count;}?>
								
								</li>
							<?php }
								echo "</ul>";
							}?>
							
							</li>
						<?php }
							echo "</ul>";
						}?>
						</li>
					
				<?php }?>
				</ul>
			</td>
		</tr>
	</table>
</form>