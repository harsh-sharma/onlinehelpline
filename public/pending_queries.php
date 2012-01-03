<script language="javascript">
function show_pending(){
	if(document.form1.day.value != "" && document.form1.month.value != "" && document.form1.year.value != "" ){
	}else if(document.form1.day.value == "" && document.form1.month.value == "" && document.form1.year.value == "" ){
	}else{
		alert("Please select / de-select all date combinations.");
		return false;
	}
	PageLoad(document.form1,'content.php?page=16');
}
</script>
<body onLoad="popcategory()">
<form action="" method="post" name="form1">
<table border="1" cellpadding="2" cellspacing="0" align="center">	
	<tr>
		<th>Category</th>
		<td>
			<select name="cat_id" id ="fillcategory" onChange="popsubcategory(this.value)">
				<option value="">--Select--</option>
				
			</select>&nbsp;
		</td>
	</tr><tr>
		<th>Sub Category</th>
		<td>
			<select id="fillsubcategory" name="sub_cat_id" onChange="popsubcategorydetail(document.form1.cat_id.value,this.value)">
				<option value="">--Select--</option>
							
			</select>&nbsp;
		</td>
	</tr><tr>
		<th>Sub Category Deatil</th>
		<td>
			<select id="fillsubcategorydetails" name="cat_detail_id">
				<option value="">--Select--</option>
				
			</select>&nbsp;
		</td>
	</tr><tr>
		<th>Date</th>
		<td>
			<select name="day">
				<option value="">-D-</option>
				<?php for ($i=1;$i<=31;$i++){?>
				<option value="<?php echo $i?>"><?php echo $i?></option>
				<?php }?>
			</select>
			<select name="month">
				<option value="">-M-</option>
				<?php for ($i=1;$i<=12;$i++){?>
				<option value="<?php echo $i?>"><?php echo $i?></option>
				<?php }?>
			</select>
			<select name="year">
				<option value="">-YYYY-</option>
				<?php for ($i=(date('Y'));$i>=2011 ;$i--){?>
				<option value="<?php echo $i?>"><?php echo $i?></option>
				<?php }?>
			</select>
		</td>
	</tr><tr>
		
		
		
		<!--<td><?php include_once("harsh_ajax/testing.html");?>&nbsp;</td>-->
		
	</tr>
</table>
<center>
	<br>
	<input type="button" name ="Show" value="Show Queries" onClick="show_pending()">
</center>
</form>
