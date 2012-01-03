<script language="javascript">
function BSave_onclick(){
	if(IsBlank(document.form1.cat_name) == false)return false;
	PageLoad(document.form1,'add_category1.php')
}
function EditForm(page){  
	popUpWindow=window.open(page,'popUpWindow','height=150,width=300,left=550,top=150,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}
</script>
<form action="" method="post" name="form1">
	<table>
		<tr>
			<td>Category<span class="mandatory">*</span></td>
			<td><input type="text" name="cat_name" maxlength="50" value=""></td>
		</tr><tr>
			<td colspan="2"><input type="button" value="Add" onClick="BSave_onclick();"></td>
		</tr>
		<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />
	</table>
</form>
<br /><br /><hr>
<h2>Categories</h2>
	<!--<table>
		<tr align="left">
			<th>Sn.&nbsp;</th>
			<th>Id&nbsp;</th>
			<th>Category Name&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?php 
			$Cat=get_all_catg('cat_id');
			$i=1;
			while($Category=mysql_fetch_array($Cat)){
		?>
		<tr>
			<td><?php echo $i ; $i++;?>&nbsp;</td>
			<td><?php echo $Category["cat_id"] ;?>&nbsp;</td>
			<td><?php echo ucwords($Category["cat_name"]) ;?>&nbsp;</td>
			<td><a href="delete_category.php?catid=<?php echo urlencode($Category['catid']);?>" onclick="return confirm('Are you sure you want to delete this?');">Delete</a></td>
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
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#" onclick="EditForm('edit_category.php?cat_id=<?php echo urlencode($Category['cat_id']);?>')" >Update</a>
				&nbsp;&nbsp;&nbsp;
				<a href="delete_category.php?catid=<?php echo urlencode($Category['catid']);?>" onclick="return confirm('Are you sure you want to delete this?');">Delete</a>
			</li>
		
	<?php }?>
	</ul>