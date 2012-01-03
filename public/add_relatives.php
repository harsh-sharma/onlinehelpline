<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<html>
	<head>
		<title>Add Relatives</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body bgcolor="#eee4b9">
		<table align="center" width="100%" height="100%"><tr><td>
			<tr>
				<td id="page">
					<h2>Add Relatives</h2>
					<script language="javascript">
					function BSave_onclick(){
						PageLoad(document.form1,'add_relatives1.php')
					}
					</script>
					
					<form action="" method="post" name="form1">
						<table>
							<tr align="left">
								<th>Name<span class="mandatory">*</span></th>
								<th>Relation<span class="mandatory">*</span></th>
								<th>Age<span class="mandatory">*</span></th>
							</tr>
							<?php for($i=1;$i<=5;$i++){?>
							<tr>
								<td><input type="text" name="relative_name<?php echo $i;?>" value="" size="15" maxlength="50" />&nbsp;</td>
								<td>
									<select name="relation<?php echo $i;?>">
										<option value="">--Select--</option>
										<option value="Brother">Brother</option>
										<option value="Sister">Sister</option>
										<option value="Mother">Mother</option>
										<option value="Father">Father</option>
										<option value="Children">Children</option>
										<option value="Husband">Husband</option>
										<option value="Wife">Wife</option>
									</select>&nbsp;
								</td>
								<td><input type="text" name="relative_age<?php echo $i;?>" value="" size="3" maxlength="2" onBlur="IsInteger(this)" />&nbsp;</td>
							</tr>
							<?php }?>
							<tr>
								<td colspan="3" align="center"><input type="button" value="Add" onClick="BSave_onclick();"></td>
							</tr>
							<input type="hidden" name="empid" value="<?php echo $_GET['empid'];?>" />
						</table>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>