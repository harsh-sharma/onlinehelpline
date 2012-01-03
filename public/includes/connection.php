<?php
	require("constants.php");
	$conn=mysql_connect(DB_SERVER,DB_USER,DB_Pass);
	if(!$conn)
		die("Databse connection failed:" . mysql_error());
		
	$db_select=mysql_select_db(DB_NAME,$conn);
	if(!$db_select)
		die("Databse selection failed:" . mysql_error());
	
?>