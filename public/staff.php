<?php require_once("includes/session.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php include("includes/header.php");?>
			<td id="navigation">&nbsp;</td>
			<td id="page">
				<h2>Staff Menu</h2>
				<p>Welcome <b><?php echo ucwords($_SESSION['user_name']); ?></b> to Admin area.</p>
				<ul>
					<li><a href="content.php">Manage Website Content</a></li>
					<li><a href="new_user.php">Add Staff User</a></li>
					<li><a href="logout.php">Logout</a></li>
				</ul>
			</td>
<?php include("includes/footer.php");?>