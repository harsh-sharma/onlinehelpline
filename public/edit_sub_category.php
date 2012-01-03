<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<html>
	<head>
		<title>Edit Sub Category</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body bgcolor="#eee4b9">
		<table align="center" width="100%" height="100%"><tr><td>
			<tr>
				<td id="page">
					<h2>Edit Sub Category</h2>
					<script language="javascript">
					function BSave_onclick(){
						if(IsBlank(document.form1.sub_cat_name) == false)return false;
						PageLoad(document.form1,'edit_sub_category1.php')
					}
					</script>
					
					<form action="" method="post" name="form1">
						<table>
							<tr>
								<td>Category</td>
								<?php 
									$SubCat=get_sub_catg_by_id($_GET['cat_id'],$_GET['sub_cat_id']);
									$SubCategory=mysql_fetch_array($SubCat);
										echo "<td>".ucwords($SubCategory["cat_name"])."</td>" ;
									?>
							</tr><tr>
								<td>Sub Category<span class="mandatory">*</span></td>
								<td><input type="text" name="sub_cat_name" maxlength="50" value="<?php echo ucwords($SubCategory["sub_cat_name"]) ;?>"></td>
								
							</tr><tr>
								<td colspan="2"><input type="button" value="Update" onClick="BSave_onclick();"></td>
							</tr>
							<input type="hidden" name="pageid" value="2" />
							<input type="hidden" name="cat_id" value="<?php echo $_GET['cat_id'];?>" />
							<input type="hidden" name="sub_cat_id" value="<?php echo $_GET['sub_cat_id'];?>" />
						</table>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>
