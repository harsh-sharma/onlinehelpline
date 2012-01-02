<?php require_once("includes/session.php");?>
<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php confirm_logged_in(); ?>
<?php
	
	$empid = ucwords(trim(mysql_prep($_POST['empid'])));
	
	for($i=1;$i<=5;$i++){
		$relative_name = ucwords(trim(mysql_prep($_POST["relative_name{$i}"])));
		$relation = ucwords(trim(mysql_prep($_POST["relation$i"])));
		$relative_age = ucwords(trim(mysql_prep($_POST["relative_age$i"])));
		
		if ($relative_name != "" && $relation != "" && $relative_age != ""){
			echo $relative_name."<br>";
			echo $relation."<br>";
			echo $relative_age."<br><br>";
			
			$query = "select max(relative_id) as maxid from emp_relatives";
			$sql=mysql_query($query,$conn);
			confirm_query($sql);
			$max=mysql_fetch_array($sql);
			$relative_id=$max['maxid']+1;
			echo $relative_id;
			
			$query = "insert into emp_relatives 
					(relative_id, empid, relative_name, relative_age, relation)
					 values 
					('".$relative_id."', '".$empid."', '".$relative_name."','".$relative_age."','".$relation."')";
			echo $query;
			$result = mysql_query($query,$conn);
		}
	}
	echo "<body onload=\"javascript:window.close();\">";
?>
<?php if(isset($conn)) mysql_close($conn);?>