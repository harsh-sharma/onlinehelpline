<script language="javascript">
function BSave_onclick(){
	if(IsBlank(document.form1.form_name) == false)return false;
	if(IsBlank(document.form1.file_name) == false)return false;
	if(IsBlank(document.form1.form_type) == false)return false;
	PageLoad(document.form1,'create_page.php')
}
</script>
<form action="" method="post" name="form1">
	<table>
		<tr>
			<td>Form Name<span class="mandatory">*</span></td>
			<td><input type="text" name="form_name" maxlength="500" value=""></td>
		</tr><tr>
			<td>File Name<span class="mandatory">*</span></td>
			<td><input type="text" name="file_name" maxlength="50" value=""></td>
		</tr><tr>
			<td>Form Type<span class="mandatory">*</span></td>
			<td>
				<select name="form_type">
					<option value="EN">Entry</option>
					<option value="RE">Report</option>
				</select>
			</td>
		</tr><tr>
			<td>Visible</td>
			<td>
				<input type="radio" name="visible" value="0"> No
				&nbsp;
				<input type="radio" name="visible" value="1" selected> Yes
			</td>
		</tr><tr>
			<td colspan="2"><input type="button" value="Add Form" onClick="BSave_onclick();"></td>
		</tr>
		<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />
	</table>
</form>
<br />
<a href="content.php">Cancel</a>