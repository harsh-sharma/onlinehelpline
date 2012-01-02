<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	
	$empid = ucwords(trim(mysql_prep($_GET['empid'])));
	$relative_name = ucwords(trim(mysql_prep($_GET['relative_name'])));
	$relative_father_name = ucwords(trim(mysql_prep($_GET['relative_father_name'])));
	$relative_mother_name = ucwords(trim(mysql_prep($_GET['relative_mother_name'])));
	$relation = ucwords(trim(mysql_prep($_GET['relation'])));		
		
	if ($relative_name != "" && $relative_father_name != "" && $relative_mother_name != "" && $relation != "" ){
		$query = "select max(relative_id) as maxid from emp_relatives where empid='".$empid."'";
		$sql=mysql_query($query,$conn);
		confirm_query($sql);
		$max=mysql_fetch_array($sql);
		$relative_id=$max['maxid']+1;
		//echo $relative_id;
		
		$query = "insert into emp_relatives 
				(relative_id, empid, relative_name, relative_father_name, relative_mother_name, relation)
				 values 
				('".$relative_id."', '".$empid."', '".$relative_name."', '".$relative_father_name."', '".$relative_mother_name."', '".$relation."')";
		//echo $query;
		$result = mysql_query($query,$conn);
		
		if($result){?>
			<?php //****************************************Relative Details (Start)*****************************************?>
			<?php
				$relatives=get_all_relatives_for_emp($empid);
				$relatives_count=mysql_num_rows($relatives);
				if($relatives_count != 0){
			?>
				<fieldset>
				<legend><b>Detail of Relatives</b> (<font size="-3">Who were queried for</font>)</legend>
				<table align="center" border="1" cellpadding="2" cellspacing="0">
					<caption><b>Relatives</b></caption>
					<tr align="center">
						<th>Sn.&nbsp;</th>
						<th>Id&nbsp;</th>
						<th>Name&nbsp;</th>
						<th>Relation with Employee&nbsp;</th>
						<th><input type="radio" name="relative" value="0" checked="checked">None&nbsp;</th>
					</tr>
				<?php $i=1;
					while($emprelatives=mysql_fetch_array($relatives)){?>
					<tr>
						<td><?php echo $i ; $i++;?>&nbsp;</td>
						<td><?php echo $emprelatives["empid"].".".$emprelatives["relative_id"];?>&nbsp;</td>
						<td><?php echo ucwords($emprelatives["relative_name"]);?>&nbsp;</td>
						<td><?php echo ucwords($emprelatives["relation"]) ;?>&nbsp;</td>
						<td><input type="radio" name="relative" value="<?php echo $emprelatives["empid"].".".$emprelatives["relative_id"];?>">&nbsp;</td>
					</tr>
				<?php }?>
				</table>
			<?php }?>
			<table width="100%" border="0" cellpadding="2" cellspacing="0">	
				<tr>
					<td style="padding-right:25px; text-align:right;"><input type="button" name ="Go4" value="Go" onclick="check_relative()"></td>
				</tr>
			</table>
			</fieldset>
			<br>
		<?php //****************************************Relative Details (End)*******************************************?>
	<?php }else{echo mysql_error(); }
	}
	
	
	
?>
<?php if(isset($conn)) mysql_close($conn);?>