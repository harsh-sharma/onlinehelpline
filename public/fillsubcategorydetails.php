<?php
echo "<link rel=\"stylesheet\" href=\"css2/Style.css\" type=\"text/css\" />";
require_once("includes/connection.php");
$catid=trim($_GET["q"]);
$subcatid=trim($_GET["r"]);
$chkqry="select * from sub_cat_detail where cat_id=".$catid." and sub_cat_id=".$subcatid;
$rschk=mysql_query($chkqry);
echo "<option value='0'>-Select Sub category details-</option>";
while($row=mysql_fetch_array($rschk))
{
echo "<option value=".$row["cat_detail_id"].">".strtoupper($row["detail"])."</option>";
}

?>