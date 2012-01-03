<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<html>
	<head>
		<title>Edit Ranks</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body bgcolor="#eee4b9">
		<table align="center" width="100%" height="100%"><tr><td>
			<tr>
				<td id="page">
					<h2>Edit Ranks</h2>
					<script language="javascript">
					function BSave_onclick(){
						if(IsBlank(document.form1.designation_name) == false)return false;
						PageLoad(document.form1,'edit_designation1.php')
					}
					</script>
					
					<form action="" method="post" name="form1">
						<table>
							<tr>
								<td>Ranks<span class="mandatory">*</span></td>
								<?php 
									$Desg=get_designation_by_id($_GET['designation_id']);
									$Designation=mysql_fetch_array($Desg);?>
								<td><input type="text" name="designation_name" maxlength="50" value="<?php echo ucwords($Designation["designation_name"]) ;?>"></td>
							</tr><tr>
								<td colspan="2"><input type="button" value="Update" onClick="BSave_onclick();"></td>
							</tr>
							<input type="hidden" name="pageid" value="2" />
							<input type="hidden" name="designation_id" value="<?php echo $_GET['designation_id'];?>" />
						</table>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>
