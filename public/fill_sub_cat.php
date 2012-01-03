<?php require_once("includes/connection.php");?>
<?php require_once("includes/functions.php");?>
<?php
$cat_id=trim($_GET["cat_id"]);
$query="select * from sub_cat_master where cat_id='".$cat_id."' order by cat_id,sub_cat_name";
$rsquery=mysql_query($query,$conn);
confirm_query($rsquery);
echo "<option value='0'>-Select-</option>";
while($row=mysql_fetch_array($rsquery))
{
echo "<option value=".$row["sub_cat_id"].">". ucwords($row["sub_cat_name"])."</option>";
}

?>