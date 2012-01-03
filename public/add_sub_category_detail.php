<script language="javascript">
function BSave_onclick(){
	if(IsBlank(document.form1.sub_cat_id) == false)return false;
	if(IsBlank(document.form1.detail) == false)return false;
	PageLoad(document.form1,'add_sub_category_detail1.php')
}
function EditForm(page){  
	popUpWindow=window.open(page,'popUpWindow','height=180,width=400,left=550,top=150,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}
</script>
<form action="" method="post" name="form1">
	<table>
		<tr>
			<td>Sub Category<span class="mandatory">*</span></td>
			<td>
				<select name="sub_cat_id">
					<option value="">--Select--</option>
					<?php 
						$Cat=get_all_sub_catg('sub_cat_master.cat_id,sub_cat_name');
						$i=1;$j=0;
						while($SubCategory=mysql_fetch_array($Cat)){
					?>
					<?php 
					if($j!=$SubCategory["cat_id"]){
						$j=$SubCategory["cat_id"];
						echo "<optgroup label=\"--".$SubCategory["cat_name"]."--\"></optgroup>" ;
					}?>
					<option value="<?php echo $SubCategory["cat_id"]."-".$SubCategory['sub_cat_id'] ;?>"><?php echo ucwords($SubCategory["sub_cat_name"]) ;?></option>
					<?php }?>
				</select>
			</td>
		</tr><tr>
			<td>Detail<span class="mandatory">*</span></td>
			<td><input type="text" name="detail" maxlength="300" value=""></td>
		</tr><tr>
			<td colspan="2"><input type="button" value="Add" onClick="BSave_onclick();"></td>
		</tr>
		<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />
	</table>
</form>
<br /><br /><hr>
<h2>Sub Categories Detail</h2>
	<!--<table>
		<tr align="left">
			<th>Sn.&nbsp;</th>
			<th>Id&nbsp;</th>
			<th>Category&nbsp;</th>
			<th>Sub Category&nbsp;</th>
			<th>Detail&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php 
			$Detail=get_all_catg_detail('sub_cat_detail.cat_id,sub_cat_detail.sub_cat_id,cat_detail_id');
			$i=1;
			$j=0;
			$k=0;
			while($CatDetail=mysql_fetch_array($Detail)){
		?>
		<tr>
			<td><?php echo $i ; $i++;?>&nbsp;</td>
			<td><?php echo $CatDetail["cat_id"].".".$CatDetail["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?>&nbsp;</td>
			<td>
				<?php 
				if($j!=$CatDetail["cat_id"]){
					$j=$CatDetail["cat_id"];
					echo $CatDetail["cat_name"] ;
				}
				?>&nbsp;
			</td>
			<td>
				<?php 
				if($k!=$CatDetail["sub_cat_id"]){
					$k=$CatDetail["sub_cat_id"];
					echo $CatDetail["sub_cat_name"] ;
				}
				?>&nbsp;
			</td>
			<td><?php echo ucwords($CatDetail["detail"]) ;?>&nbsp;</td>
			<td><a href="delete_sub_category_detail.php?catdetailid=<?php echo urlencode($CatDetail['catdetailid']);?>" onclick="return confirm('Are you sure you want to delete this?');">Delete</a></td>
		</tr>
		<?php }?>
	</table>-->
	
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
					<li><b><?php echo $CatDetail["cat_id"].".".$CatDetail["sub_cat_id"].".".$CatDetail["cat_detail_id"] ;?></b>&nbsp;&nbsp;<?php echo ucwords($CatDetail["detail"]) ;?>
						&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="#" onclick="EditForm('edit_sub_category_detail.php?cat_id=<?php echo urlencode($CatDetail['cat_id']);?>&sub_cat_id=<?php echo urlencode($CatDetail['sub_cat_id']);?>&cat_detail_id=<?php echo urlencode($CatDetail['cat_detail_id']);?>')" >Update</a>
						&nbsp;&nbsp;&nbsp;
						<a href="delete_sub_category_detail.php?catdetailid=<?php echo urlencode($CatDetail['catdetailid']);?>" onclick="return confirm('Are you sure you want to delete this?');">Delete</a>
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
	
	
	
	
	
	
	
	
	
	