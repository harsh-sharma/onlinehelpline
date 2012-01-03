<script language ="javascript">
function empsearch()
{

if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("result").innerHTML=xmlhttp.responseText;
    }
  }
var emp_name = document.form1.emp_name.value;
var father_husband_name = document.form1.father_husband_name.value;
var empid = document.form1.empid.value;
var native_place = document.form1.native_place.value;
var dob = document.form1.dob.value;
xmlhttp.open("GET","emp_search1.php?emp_name="+emp_name+"&father_husband_name="+father_husband_name+"&empid="+empid+"&native_place="+native_place+"&dob="+dob,true);
xmlhttp.send();
}
</script>
<form action="" method="post" name="form1">
	<table border="0" cellpadding="2" cellspacing="0">
		<tr>
			<td>Name</td><td>Father/Husband Name</td><td>Id</td><td>Native Place</td><td>Date of Birth </td>
		</tr><tr>
			<td><input type="text" name="emp_name" value="" size="20" maxlength="50" onkeyup="empsearch()" />&nbsp;</td>
			<td><input type="text" name="father_husband_name" value="" size="20" maxlength="50" onkeyup="empsearch()" />&nbsp;</td>
			<td><input type="text" name="empid" value="" size="15" maxlength="50" onkeyup="empsearch()" />&nbsp;</td>
			<td><input type="text" name="native_place" value="" size="15" maxlength="50" onkeyup="empsearch()" />&nbsp;</td>
			<td><input type="text" name="dob" value="" size="7" maxlength="10" onkeyup="empsearch()" />&nbsp;</td>
		</tr>
	</table>
	<input type="hidden" name="pageid" value="<?php echo $sel_page['form_id'] ;?>" />
</form>
<br /><hr>
<div id="result"></div>