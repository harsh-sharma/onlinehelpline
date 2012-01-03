<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<html>
	<head>
		<title>Edit Sub Categories Detail</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body bgcolor="#eee4b9">
		<table align="center" width="100%" height="100%"><tr><td>
			<tr>
				<td id="page">
					<h2>Edit Sub Categories Detail</h2>
					<script language="javascript">
					function BSave_onclick(){
						if(IsBlank(document.form1.detail) == false)return false;
						PageLoad(document.form1,'edit_sub_category_detail1.php')
					}
					</script>
					
					<form action="" method="post" name="form1">
						<table>
							<tr>
								<td>Category</td>
								<?php 
									$Detail=get_detail_by_id($_GET['cat_id'],$_GET['sub_cat_id'],$_GET['cat_detail_id']);
									$CatDetail=mysql_fetch_array($Detail);
										echo "<td>".ucwords($CatDetail["cat_name"])."</td>" ;
									?>
							</tr><tr>
								<td>Sub Category</td>
								<td><?php echo ucwords($CatDetail["sub_cat_name"]) ;?></td>
								
							</tr><tr>
								<td>Sub Category<span class="mandatory">*</span></td>
								<td><input type="text" name="detail" maxlength="500" value="<?php echo ucwords($CatDetail["detail"]) ;?>"></td>
								
							</tr><tr>
								<td colspan="2"><input type="button" value="Update" onClick="BSave_onclick();"></td>
							</tr>
							<input type="hidden" name="pageid" value="2" />
							<input type="hidden" name="cat_id" value="<?php echo $_GET['cat_id'];?>" />
							<input type="hidden" name="sub_cat_id" value="<?php echo $_GET['sub_cat_id'];?>" />
							<input type="hidden" name="cat_detail_id" value="<?php echo $_GET['cat_detail_id'];?>" />
						</table>
					</form>
				</td>
			</tr>
		</table>
	</body>
</html>
