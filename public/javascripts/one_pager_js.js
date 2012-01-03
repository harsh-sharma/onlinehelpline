function checkid(){
	if(IsBlank(document.form1.find_empid) == false)return false;
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			//alert(xmlhttp.responseText)
			document.getElementById("div3").style.display = "none";
			document.getElementById("relative_detail").style.display = "none";
			document.getElementById("div6").style.display = "none";
			document.getElementById("div7").style.display = "none";
			document.getElementById("div8").style.display = "none";
			document.getElementById("div9").style.display = "none";
			document.getElementById("div10").style.display = "none";
			document.getElementById("query_saved").style.display = "none";
			
			if(xmlhttp.responseText==0){
				document.getElementById("check_id").innerHTML="";
				document.getElementById("check").innerHTML="Employee not found."
				document.getElementById("div2").style.display = "block";
				document.getElementById("div4").style.display = "none";
			}else{
				document.getElementById("check_id").innerHTML=xmlhttp.responseText;
				document.getElementById("check").innerHTML="Employee found.";
				document.getElementById("div2").style.display = "none";
				document.getElementById("div4").style.display = "block";
			}
		}
	}
	var empid = document.form1.find_empid.value;
	xmlhttp.open("GET","check_id.php?empid="+empid,true);
	xmlhttp.send();
}

function add_employee(){
	if(IsBlank(document.form1.emp_name) == false)return false;
	if(IsBlank(document.form1.father_husband_name) == false)return false;
	if(IsBlank(document.form1.mother_name) == false)return false;
	if(IsBlank(document.form1.native_place) == false)return false;
	
	var emp_name = document.form1.emp_name.value;
	var father_husband_name = document.form1.father_husband_name.value;
	var mother_name = document.form1.mother_name.value;
	var native_place = document.form1.native_place.value;
	
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			var str=xmlhttp.responseText;
			var check=str.search(/Employee already exist./i);
			document.getElementById("div2").style.display = "none";
			document.getElementById("query_saved").style.display = "none";
			if (check == -1){
				document.getElementById("check_id").innerHTML=xmlhttp.responseText;
				document.getElementById("div3").style.display = "block";
			}else{
				document.getElementById("check_id").innerHTML=xmlhttp.responseText;
				document.getElementById("div3").style.display = "none";
				document.getElementById("div4").style.display = "block";
			}
		}
	}
	xmlhttp.open("GET","add_employee.php?emp_name="+emp_name+"&father_husband_name="+father_husband_name+"&mother_name="+mother_name+"&native_place="+native_place,true);
	xmlhttp.send();
}

function add_more_employee(){
    if(IsBlank(document.form1.designation) == false)return false;
	if(IsBlank(document.form1.postedin) == false)return false;
	if(IsBlank(document.form1.age) == false)return false;
	//if(IsInteger(document.form1.age) == false)return false;
	if(IsBlank(document.form1.gender) == false)return false;
	if(IsBlank(document.form1.district) == false)return false;
	
	/*if(document.form1.phone_no.value == "" && document.form1.office_no.value == "" && document.form1.mobile_no.value == ""){
		alert("Please fill atleast one Phone No.");
		return false;
	}*/
	
	var empid = document.form1.empid.value;
	var designation = document.form1.designation.value;
	var district = document.form1.district.value;
	var dob_day = document.form1.dob_day.value;
	var dob_month = document.form1.dob_month.value;
	var dob_year = document.form1.dob_year.value;
	var age = document.form1.age.value;
	var gender = document.form1.gender.value;
	var email_id = document.form1.email_id.value;
	var phone_no = document.form1.phone_no.value;
	var office_no = document.form1.office_no.value;
	var mobile_no = document.form1.mobile_no.value;
	var postedin = document.form1.postedin.value;
		
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("check_id").innerHTML=xmlhttp.responseText;
			document.getElementById("div3").style.display = "none";
			document.getElementById("div4").style.display = "block";
			document.getElementById("query_saved").style.display = "none";
		}
	}
	xmlhttp.open("GET","add_more_employee.php?empid="+empid+"&designation="+designation+"&district="+district+"&dob_day="+dob_day+"&dob_month="+dob_month+"&dob_year="+dob_year+"&age="+age+"&gender="+gender+"&email_id="+email_id+"&phone_no="+phone_no+"&office_no="+office_no+"&mobile_no="+mobile_no+"&postedin="+postedin,true);
	xmlhttp.send();
}

function question_by_for(){
	if(IsBlank(document.form1.query_by) == false)return false;
	if(IsBlank(document.form1.query_for) == false)return false;
	var empid = document.form1.empid.value;
	var query_by = document.form1.query_by.value;
	var query_for = document.form1.query_for.value;
	
	document.getElementById("div8").style.display = "none";
	document.getElementById("div9").style.display = "none";
	document.getElementById("div10").style.display = "none";
	document.getElementById("query_saved").style.display = "none";
	if(query_for == "Relative"){
		if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		}else{// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange=function(){
			if (xmlhttp.readyState==4 && xmlhttp.status==200){
				document.getElementById("relative_detail").innerHTML=xmlhttp.responseText;
			}
		}
		xmlhttp.open("GET","question_by_for.php?empid="+empid+"&query_by="+query_by+"&query_for="+query_for,true);
		xmlhttp.send();
		document.getElementById("relative_detail").style.display = "block";
		document.getElementById("div6").style.display = "block";
		document.getElementById("div7").style.display = "none";
	}else{
		document.getElementById("relative_detail").style.display = "none";
		document.getElementById("div6").style.display = "none";
		document.getElementById("div7").style.display = "block";
	}
	document.form1.contact_person.value = "";
	document.form1.contact_no.value = "";
	if(query_by == "Employee" && query_for == "Employee"){
		document.form1.person_by.value = empid;
		document.form1.person_for.value = empid;
		document.form1.contact_person.value = document.form1.emp_name1.value;
		if (document.form1.mobile_no1.value != ""){
			document.form1.contact_no.value = document.form1.mobile_no1.value;
		}else if (document.form1.phone_no1.value != ""){
			document.form1.contact_no.value = document.form1.phone_no1.value;
		}else{
			document.form1.contact_no.value = document.form1.office_no1.value;
		}
		
	}else if(query_by == "Relative" && query_for == "Employee"){
		document.form1.person_by.value = "Relative";
		document.form1.person_for.value = empid;
	}
}

function satisfied(){
	var satisfied_by = document.form1.satisfied_by.value;
	if(satisfied_by != "Not Satisfied"){
		document.getElementById("satisfied").style.display = "none";
	}else{
		document.getElementById("satisfied").style.display = "block";
	}
}

function check_relative(){
	var empid = document.form1.empid.value;
	var query_by = document.form1.query_by.value;
	var query_for = document.form1.query_for.value;
	chosen = ""
	len = document.form1.relative.length
	
	for (i = 0; i <len; i++) {
		if (document.form1.relative[i].checked) {
			chosen = document.form1.relative[i].value
		}
	}
	document.getElementById("div8").style.display = "none";
	document.getElementById("div9").style.display = "none";
	document.getElementById("div10").style.display = "none";
	document.getElementById("query_saved").style.display = "none";
	if (chosen == "0") {
		alert("Please select Relative.");
		document.getElementById("div7").style.display = "none";
		document.getElementById("div6").style.display = "block";
	}else {
		document.getElementById("div7").style.display = "block";
		document.getElementById("div6").style.display = "none";
		
		document.form1.contact_person.value = "";
		document.form1.contact_no.value = "";
		if(query_by == "Employee" && query_for == "Relative"){
			document.form1.person_by.value = empid;
			document.form1.person_for.value = chosen;
			document.form1.contact_person.value = document.form1.emp_name1.value;
			if (document.form1.mobile_no1.value != ""){
				document.form1.contact_no.value = document.form1.mobile_no1.value;
			}else if (document.form1.phone_no1.value != ""){
				document.form1.contact_no.value = document.form1.phone_no1.value;
			}else{
				document.form1.contact_no.value = document.form1.office_no1.value;
			}
			
		}else if(query_by == "Relative" && query_for == "Employee"){
			document.form1.person_by.value = "Relative";
			document.form1.person_for.value = empid;
		}else if(query_by == "Relative" && query_for == "Relative"){
			document.form1.person_by.value = "Relative";
			document.form1.person_for.value = chosen;
		}
	}
}

function add_relative(){
	if(IsBlank(document.form1.relative_name) == false)return false;
	if(IsBlank(document.form1.relative_father_name) == false)return false;
	if(IsBlank(document.form1.relative_mother_name) == false)return false;
	if(IsBlank(document.form1.relation) == false)return false;

	var empid = document.form1.empid.value;
	var relative_name = document.form1.relative_name.value;
	var relative_father_name = document.form1.relative_father_name.value;
	var relative_mother_name = document.form1.relative_mother_name.value;
	var relation = document.form1.relation.value;
	
	
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("relative_detail").innerHTML=xmlhttp.responseText;
			document.form1.relative_name.value="";
			document.form1.relative_father_name.value ="";
			document.form1.relative_mother_name.value ="";
			document.form1.relation.value ="";
		}
	}
	xmlhttp.open("GET","add_relative.php?empid="+empid+"&relative_name="+relative_name+"&relative_father_name="+relative_father_name+"&relative_mother_name="+relative_mother_name+"&relation="+relation,true);
	xmlhttp.send();
}

function check_query(){
	if(IsBlank(document.form1.desc_remark) == false)return false;
	if(IsBlank(document.form1.satisfied_by) == false)return false;
	if(document.form1.satisfied_by.value == "Not Satisfied"){
		if(IsBlank(document.form1.contact_person) == false)return false;
		if(IsBlank(document.form1.contact_no) == false)return false;
		if(IsBlank(document.form1.suitable_time) == false)return false;
	}
	document.getElementById("div8").style.display = "block";
	document.getElementById("div9").style.display = "none";
	document.getElementById("div10").style.display = "none";
	document.getElementById("query_saved").style.display = "none";
	popcategory();
}

function show_query(){
	if(IsBlank(document.form1.category) == false)return false;
	if(document.form1.category.value == 0){
		alert("Please fill Mandatory field.")
		return false;
	}

	var empid = document.form1.empid.value;
	var cat_id = document.form1.category.value;
	var sub_cat_id = document.form1.subcategory.value;
	var cat_detail_id = document.form1.subcategorydetail.value;
	
	
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("div9").style.display = "block";
			document.getElementById("div10").style.display = "block";
			document.getElementById("div9").innerHTML=xmlhttp.responseText;
			document.getElementById("query_saved").style.display = "none";
		}
	}
	xmlhttp.open("GET","show_query.php?empid="+empid+"&cat_id="+cat_id+"&sub_cat_id="+sub_cat_id+"&cat_detail_id="+cat_detail_id,true);
	xmlhttp.send();
}

function save_query(){
	if(IsBlank(document.form1.category) == false)return false;
	if(IsBlank(document.form1.desc_remark) == false)return false;
	if(IsBlank(document.form1.satisfied_by) == false)return false;
	if(document.form1.satisfied_by.value == "Not Satisfied"){
		if(IsBlank(document.form1.contact_person) == false)return false;
		if(IsBlank(document.form1.contact_no) == false)return false;
		if(IsBlank(document.form1.suitable_time) == false)return false;
	}

	var cat_id = document.form1.category.value;
	var sub_cat_id = document.form1.subcategory.value;
	var cat_detail_id = document.form1.subcategorydetail.value;
	var person_by = document.form1.person_by.value;
	var person_for = document.form1.person_for.value;
	var desc_remark = document.form1.desc_remark.value;
	var satisfied_by = document.form1.satisfied_by.value;
	var contact_person = document.form1.contact_person.value;
	var contact_no = document.form1.contact_no.value;
	var suitable_time = document.form1.suitable_time.value;
	
	
	if (window.XMLHttpRequest){// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}else{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function(){
		if (xmlhttp.readyState==4 && xmlhttp.status==200){
			document.getElementById("query_saved").innerHTML=xmlhttp.responseText;
			document.getElementById("query_saved").style.display = "block";
		}
	}
	xmlhttp.open("GET","save_query.php?cat_id="+cat_id+"&sub_cat_id="+sub_cat_id+"&cat_detail_id="+cat_detail_id+"&person_by="+person_by+"&person_for="+person_for+"&desc_remark="+desc_remark+"&satisfied_by="+satisfied_by+"&contact_person="+contact_person+"&contact_no="+contact_no+"&suitable_time="+suitable_time,true);
	xmlhttp.send();
}

function show_report(){
	var empid = document.form1.empid.value;
	var page = "emp_issue_report.php?empid="+empid
	popUpWindow=window.open(page,'popUpWindow','height=500,width=800,left=50,top=150,resizable=no,scrollbars=yes,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}

function EditForm(page){  
	popUpWindow=window.open(page,'popUpWindow','height=500,width=600,left=100,top=150,resizable=no,scrollbars=no,toolbar=no,menubar=no,location=no,directories=no, status=yes');
}