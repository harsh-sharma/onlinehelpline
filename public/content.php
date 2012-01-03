<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php require_once("includes/form_functions.php");?>
<?php confirm_logged_in(); ?>
<?php find_selected_page();?>
<?php include("includes/header.php");?>
			<td id="navigation">
				<?php echo navigation($sel_subject, $sel_page);?>
				<br>
				<!--a href="content.php?page=1">+ Add a new Form</a-->
			</td>
			<td id="page">
				<?php if (!is_null($sel_page)){?>
					<h2><?php echo $sel_page['form_name']; ?></h2>
					<?php include($sel_page['file_name']);
				}else{?>
					<h2>Select a Page to edit</h2>
				<?php }?>
								
			</td>
<?php require("includes/footer.php");?>