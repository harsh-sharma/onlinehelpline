<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<html>
	<head>
		<title>Edit Query</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body bgcolor="#eee4b9">
		<table align="center" width="100%" height="100%"><tr><td>
			<tr>
				<td id="page">
					<h2>Edit Query</h2>
					<script language="javascript">
					function BSave_onclick(){
						if(IsBlank(document.form1.desc_remark) == false)return false;
						PageLoad(document.form1,'edit_issue1.php')
					}
					</script>
					
					<form action="" method="post" name="form1">
						<table>
							<tr>
								<td>Query<span class="mandatory">*</span></td>
								<?php 
									$Qry=get_issue_by_id($_GET['issue_id']);
									$Query=mysql_fetch_array($Qry);?>
								<td>
									<textarea name="desc_remark" value="" rows="5" cols="65" ><?php echo ($Query["desc_remark"]) ;?></textarea>
								</td>
							</tr><tr>
								<td colspan="2"><input type="button" value="Update" onClick="BSave_onclick();"></td>
							</tr>
							<input type="hidden" name="issue_id" value="<?php echo $_GET['issue_id'];?>" />
						</table>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>
