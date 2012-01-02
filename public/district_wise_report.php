<script language="javascript">
function show_report(page){  
	popUpWindow=window.open(page,'popUpWindow','height=500,width=900,left=50,top=150,resizable=no,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}
</script>
<table cellspacing="2" cellpadding="2" border="1" align="center">
	<tr>
		<th>District</th>
		<?php 
			$Cat=get_all_catg('cat_id');
			$i=1;
			while($Category=mysql_fetch_array($Cat)){
				echo "<th>".ucwords($Category["cat_name"])."</th>";
			}
		?>
	</tr>
	<?php 
		if($_POST['district'] == 0){
			$Dist=get_all_district('district_name');
		}else{
			$Dist=get_district_by_id($_POST['district']);
		}
		while($District=mysql_fetch_array($Dist)){
	?>
	<tr>
		<th align="left"><?php echo ucwords($District["district_name"]) ;?></th>
		<?php 
			$Cat=get_all_catg('cat_id');
			$i=1;
			while($Category=mysql_fetch_array($Cat)){
				$query = "select * 
					from issue_master1 inner join 
					employee_master on employee_master.empid=issue_master1.person_for 
					where cat_id='".$Category["cat_id"]."' and native_place='".$District["district_id"]."' 
					order by desc_remark";
				$issue=mysql_query($query,$conn);
				confirm_query($issue);
				$issue_count=mysql_num_rows($issue);
				echo "<td align=\"right\">";
				if($issue_count != 0){
						echo "<a href=\"#\" onclick=\"show_report('content.php?page=23&cat_id=".$Category["cat_id"]."&native_place=".$District["district_id"]."')\">".$issue_count."</a>";
				}else{
					echo $issue_count;
				}
				echo "</td>";				
			}
		?>
	</tr>
	<?php }?>
</table>