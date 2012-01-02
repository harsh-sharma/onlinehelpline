<script language="javascript">
function BSave_onclick(){
	if(IsBlank(document.form1.postedin_name) == false)return false;
	PageLoad(document.form1,'add_postedin1.php')
}
function EditForm(page){  
	popUpWindow=window.open(page,'popUpWindow','height=150,width=300,left=550,top=150,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}
</script>
<form action="" method="post" name="form1">
	<table>
		<tr>
			<td>Posted-In<span class="mandatory">*</span></td>
			<td><input type="text" name="postedin_name" maxlength="50" value=""></td>
		</tr><tr>
			<td colspan="2"><input type="button" value="Add" onClick="BSave_onclick();"></td>
		</tr>
		<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />
	</table>
</form>
<br /><br /><hr>
<h2>Posted-In Details</h2>
	<ul style="list-style: none;">
	<?php 
		$Desg=get_all_postedin('postedin_id');
		$i=1;
		while($PostedIn=mysql_fetch_array($Desg)){
	?>
			<li><b><?php echo $PostedIn["postedin_id"] ;?></b>&nbsp;&nbsp;<?php echo ucwords($PostedIn["postedin_name"]) ;?>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="#" onclick="EditForm('edit_postedin.php?postedin_id=<?php echo urlencode($PostedIn['postedin_id']);?>')" >Update</a>
				&nbsp;&nbsp;&nbsp;
				<a href="delete_postedin.php?postedin_id=<?php echo urlencode($PostedIn['postedin_id']);?>" onclick="return confirm('Are you sure you want to delete this?');">Delete</a>
			</li>
		
	<?php }?>
	</ul>