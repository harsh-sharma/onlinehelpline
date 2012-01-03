<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
	if(logged_in()){
		redirect_to("staff.php");
	}
	 

	include("includes/form_functions.php");
	
	if(isset($_POST['submit'])){
		$errors =array();
		
		$required_fields = array('username','password');
		$errors = array_merge($errors, check_required_fields($required_fields));
				
		$fields_with_lengths = array('username' => 20, 'password' => 20);
		$errors = array_merge($errors, check_max_field_lengths($fields_with_lengths));
			
		$username = trim(mysql_prep($_POST['username']));
		$password = trim(mysql_prep($_POST['password']));
				
		if (empty($errors)){
			$query = "select login_id, user_name, user_type  
				from login_master 
				where user_name = '{$username}' and 
				password = '{$password}'
				limit 1";
			$result_set = mysql_query($query,$conn);
			confirm_query($result_set);
			if(mysql_num_rows($result_set) == 1){
				$found_user = mysql_fetch_array($result_set);
				$_SESSION['user_id'] = $found_user['login_id'];
				$_SESSION['user_name'] = $found_user['user_name'];
				$_SESSION['user_type'] = $found_user['user_type'];
				if($_SESSION['user_type'] == "staff"){redirect_to("content.php?page=14");} 
				redirect_to("staff.php");
			}else{
				$message = "Username/Password combination incorrect.<br>
							Please make sure your caps lock key is off and try again.";
			}
		}else {
			if (count($errors) == 1) {
				$message = "There was 1 error in the form.";
			} else {
				$message = "There were " . count($errors) . " errors in the form.";
			}
		}
	}else{
		if(isset($_GET['logout']) && $_GET['logout'] == 1){
			$message = "You are now logged out.";
		}
		$username = "";
		$password = "";
	}
?><?php include("includes/header.php");?>
			<td id="navigation">
				<a href="index.php">Return to Public Site</a>
			</td>
			<td id="page">
				<h2>Staff Login</h2>
				<?php if(!empty($message)) {echo "<p class=\"message\">". $message ."</p>";} ?>
				<?php if (!empty($errors)) {display_errors($errors);} ?>
				<form name="login_form" method="post" action="login.php">
				<table>
					<tr>
						<td>Username:</td>
						<td><input type="text" name="username" maxlength="30" value="<?php echo htmlentities($username); ?>"></td>
					</tr><tr>
						<td>Password:</td>
						<td><input type="password" name="password" maxlength="30" value="<?php echo htmlentities($password); ?>"></td>
					</tr><tr>
						<td colspan="2"><input type="submit" name="submit" value="Login"></td>
					</tr>
				</table>
				</form>
			</td>
<?php require("includes/footer.php");?>