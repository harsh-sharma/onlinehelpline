<form action="" method="post" name="form1">
	<table>
		<tr>
			<th>Categories</th>
			<?php
				$main_query = "select * from issue_master1 where 1=1 ";
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
							<a href ="content.php?page=13&cat_id=<?php echo urlencode($Category["cat_id"]);?>"><?php echo $issue_count;?></a>
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
								<a href ="content.php?page=13&cat_id=<?php echo urlencode($SubCategory["cat_id"]);?>&sub_cat_id=<?php echo urlencode($SubCategory["sub_cat_id"]);?>"><?php echo $issue_count;?></a>
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
									<a href ="content.php?page=13&cat_id=<?php echo urlencode($CatDetail["cat_id"]);?>&sub_cat_id=<?php echo urlencode($CatDetail["sub_cat_id"]);?>&cat_detail_id=<?php echo urlencode($CatDetail["cat_detail_id"]);?>"><?php echo $issue_count;?></a>
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