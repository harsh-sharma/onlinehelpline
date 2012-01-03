<?php
echo "<link rel=\"stylesheet\" href=\"css2/Style.css\" type=\"text/css\" />";
require_once("includes/connection.php");
$catid=trim($_GET["q"]);
$chkqry="select * from sub_cat_master where cat_id=".$catid;
$rschk=mysql_query($chkqry);
echo "<option value='0'>-Select Sub category-</option>";
while($row=mysql_fetch_array($rschk))
{
echo "<option value=".$row["sub_cat_id"].">".strtoupper($row["sub_cat_name"])."</option>";
}

?>