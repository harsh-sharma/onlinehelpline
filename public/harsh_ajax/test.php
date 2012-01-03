<?php require_once("../includes/session.php");?>
<?php require_once("../includes/connection.php");?>
<?php require_once("../includes/functions.php");?>
<script>
function popcategory()
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
    {alert(xmlhttp.responseText)
    document.getElementById("fillcategory").innerHTML=xmlhttp.responseText;
    document.getElementById("fillcategory").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("GET","fillcat.php",true);
xmlhttp.send();
}


function popsubcategory(catid)
{

if (catid.length==0)
  { 
  document.getElementById("fillsubcategory").innerHTML="";
  document.getElementById("fillsubcategory").style.border="0px";
  return;
  }
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
    document.getElementById("fillsubcategory").innerHTML=xmlhttp.responseText;
    document.getElementById("fillsubcategory").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("GET","fillsubcategory.php?q="+catid,true);
xmlhttp.send();
}

function popsubcategorydetail(catid,subcatid)
{

if (catid.length==0)
  { 
  document.getElementById("fillsubcategorydetails").innerHTML="";
  document.getElementById("fillsubcategorydetails").style.border="0px";
  return;
  }
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
    document.getElementById("fillsubcategorydetails").innerHTML=xmlhttp.responseText;
    document.getElementById("fillsubcategorydetails").style.border="1px solid #A5ACB2";
    }
  }
xmlhttp.open("GET","fillsubcategorydetails.php?q="+catid+"&r="+subcatid,true);
xmlhttp.send();
}
</script><head><title>7bandhan.com:Add Sub Caste</title></head>

<link rel="stylesheet" type="text/css" href="css/style.css" />
<body onload ="popcategory();">
<form name ="frmfill" method="GET">
<div class="box_admin">
<table border="0" align ="center">
<tr><th align="center">Category</th></tr>
<tr><td align="center"><select name="category" id ="fillcategory" onChange="popsubcategory(this.value)"></select></td></tr>
<tr><td align="center">Sub Category</td></tr>
<tr><td align="center"><select id="fillsubcategory" name="subcategory" onChange="popsubcategorydetail(document.frmfill.category.value,this.value)"><option>-Subcategory-</option></select></td></tr>
<tr><td align="center">Sub Category Deatil</td></tr>
<tr><td align="center"><select id="fillsubcategorydetails" name="subcategorydetail"><option>-Sub Category Details-</option></select></td></tr>


</table>

</div>
</form>
</body>
</html>