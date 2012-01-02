<?php
echo "<link rel=\"stylesheet\" href=\"css2/Style.css\" type=\"text/css\" />";
require_once("../includes/connection.php");


$chkqry="select * from cat_master";
$rschk=mysql_query($chkqry);
echo "<option value='0'>-Select category-</option>";
while($row=mysql_fetch_array($rschk))
{
echo "<option value=".$row["cat_id"].">".strtoupper($row["cat_name"])."</option>";
}

?>
