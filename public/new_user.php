<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	include("includes/form_functions.php");
	
	if(isset($_POST['submit'])){
		$errors =array();
		
		$required_fields = array('username','password');
		$errors = array_merge($errors, check_required_fields($required_fields));
				
		$fields_with_lengths = array('username' => 20, 'password' => 20);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths));
			
		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
		$usertype = trim(mysql_prep($_POST['usertype']));
						
		if (empty($errors)){
			$query = "insert into login_master
					(user_name, password, user_type) values 
					('".$username."', '".$password."', '".$usertype."')";
			$result = mysql_query($query,$conn);
			
			if($result){
				$message = "The user was successfully created.";
			}else{
				$message = "The page could not be created.";
				$message .= "<br />" . mysql_error();
			}
		}else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
	}else{
		$username = "";
		$password = "";
	}
?>
<?php include("includes/header.php");?>
			<td id="navigation">
				<a href="staff.php">Return to Menu</a>
			</td>
			<td id="page">
				<h2>Create New User</h2>
				<?php if(!empty($message)) {echo "<p class=\"message\">". $message ."</p>";} ?>
				<?php if (!empty($errors)) {display_errors($errors);} ?>
				<form name="create_user" method="post" action="new_user.php">
				<table>
					<tr>
						<td>Username:</td>
						<td><input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>"></td>
					</tr><tr>
						<td>Password:</td>
						<td><input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>"></td>
					</tr><tr>
						<td>User Type:</td>
						<td>
							<select name="usertype">
								<option value="staff">Staff</option>
								<option value="admin">Admin</option>
							</select>
						</td>
					</tr><tr>
						<td colspan="2"><input type="submit" name="submit" value="Create User"></td>
					</tr>
				</table>
				</form>
			</td>
<?php require("includes/footer.php");?>