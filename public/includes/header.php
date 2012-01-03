<html>
	<head>
		<title>24X7 Helpline</title>
		<link href="stylesheets/public.css" media="all" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascripts/Javascript.js"></script>
	</head>
	<body>
		<table align="center" width="87%"><tr><td>
		<div id="header">
			<?php if(logged_in()){?>
			<b>Welcome <?php echo ucwords($_SESSION['user_name']);?> !!
			<a href="logout.php">Logout</a>
			<?php }?>
			</b><img src="images/header.png">
		</div>
		<div id="main">	<table id="structure">
		<tr>
			