<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/form_functions.php");?>
<?php confirm_logged_in(); ?>
<?php 
	$empid=$_GET['empid'];
	$query_by=$_GET['query_by'];
	$query_for=$_GET['query_for'];
	//echo $empid . "<br>";
	//echo $query_by . "<br>";
	//echo $query_for . "<br>";
	
	
	if($query_by == "Relative" || $query_for == "Relative"){
		//echo $empid . "<br>";
		//echo $query_by . "<br>";
		//echo $query_for . "<br>";
		//*******************Employee not found.***************Employee not found.*********Employee not found.***********?>
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
						<td><input type="radio" name="relative" value="<?php echo $emprelatives["empid"]."-".$emprelatives["relative_id"];?>">&nbsp;</td>
					</tr>
				<?php }?>
				</table>
			
				<table width="100%" border="0" cellpadding="2" cellspacing="0">	
					<tr>
						<td style="padding-right:25px; text-align:right;"><input type="button" name ="Go4" value="Go" onclick="check_relative()"></td>
					</tr>
				</table>
				</fieldset>
			<br>
			<?php }?>
		<?php //****************************************Relative Details (End)*******************************************?>
		<?php //****************************************Relative Queries (Start)*******************************************?>
		
			<br>
		<?php //****************************************Relative Queries (End)*******************************************?>

<?php }else{
		//echo "harsh";
		//*******************Employee found.***************Employee found.*********Employee found.***********************?>

<?php }?>
<?php if(isset($conn)) mysql_close($conn);?>