<script language="javascript">
function BSave_onclick(){
	if(IsBlank(document.form1.cat_id) == false)return false;
	if(IsBlank(document.form1.sub_cat_name) == false)return false;
	PageLoad(document.form1,'add_sub_category1.php')
}
function EditForm(page){  
	popUpWindow=window.open(page,'popUpWindow','height=150,width=300,left=550,top=150,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}
</script>
<form action="" method="post" name="form1">
	<table>
		<tr>
			<td>Category<span class="mandatory">*</span></td>
			<td>
				<select name="cat_id">
					<option value="">--Select--</option>
					<?php 
						$Cat=get_all_catg('cat_name');
						while($Category=mysql_fetch_array($Cat)){
					?>
						<option value="<?php echo $Category["cat_id"] ;?>"><?php echo ucwords($Category["cat_name"]) ;?></option>
					<?php }?>
				</select>
			</td>
		</tr><tr>
			<td>Sub Category<span class="mandatory">*</span></td>
			<td><input type="text" name="sub_cat_name" maxlength="50" value=""></td>
		</tr><tr>
			<td colspan="2"><input type="button" value="Add" onClick="BSave_onclick();"></td>
		</tr>
		<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />
	</table>
</form>
<br /><br /><hr>
<h2>Sub Categories</h2>
	<!--<table>
		<tr align="left">
			<th>Sn.&nbsp;</th>
			<th>Id&nbsp;</th>
			<th>Category&nbsp;</th>
			<th>Sub Category Name&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php 
			$Cat=get_all_sub_catg('sub_cat_master.cat_id,sub_cat_id');
			$i=1;
			$j=0;
			while($SubCategory=mysql_fetch_array($Cat)){
		?>
		<tr>
			<td><?php echo $i ; $i++;?>&nbsp;</td>
			<td><?php echo $SubCategory["cat_id"].".".$SubCategory["sub_cat_id"] ;?>&nbsp;</td>
			<td>
				<?php 
				if($j!=$SubCategory["cat_id"]){
					$j=$SubCategory["cat_id"];
					echo $SubCategory["cat_name"] ;
				}
				?>&nbsp;
			</td>
			<td><?php echo ucwords($SubCategory["sub_cat_name"]) ;?>&nbsp;</td>
			<td><a href="delete_sub_category.php?subcatid=<?php echo urlencode($SubCategory['subcatid']);?>" onclick="return confirm('Are you sure you want to delete this?');">Delete</a></td>
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
			//echo $SubCat_count;
			if($SubCat_count != 0){echo "<ul style=\"list-style: none;\" class=\"pages\">";
				while($SubCategory=mysql_fetch_array($SubCat)){
		?>
				<li><b><?php echo $SubCategory["cat_id"].".".$SubCategory["sub_cat_id"] ;?></b>&nbsp;&nbsp;<?php echo ucwords($SubCategory["sub_cat_name"]) ;?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<a href="#" onclick="EditForm('edit_sub_category.php?cat_id=<?php echo urlencode($SubCategory['cat_id']);?>&sub_cat_id=<?php echo urlencode($SubCategory['sub_cat_id']);?>')" >Update</a>
					&nbsp;&nbsp;&nbsp;
					<a href="delete_sub_category.php?subcatid=<?php echo urlencode($SubCategory['subcatid']);?>" onclick="return confirm('Are you sure you want to delete this?');">Delete</a>
				</li>
			<?php }
				echo "</ul>";
			}?>
			</li>
		
	<?php }?>
	</ul>
	