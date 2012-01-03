<?php
	function mysql_prep($value){
		$magic_quotes_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists("mysql_real_escape_string");
		if($new_enough_php){
			if($magic_quotes_active){
				$value = stripslashes($value);
			}
			$value = mysql_real_escape_string($value);
		}else{
			if(!$magic_quotes_active){
				$value = addslashes($value);
			}
		}
		return $value;
	}
	
	function redirect_to($location = NULL){
		if($location != NULL){
			header("Location: {$location}");
			exit();
		}
	}
	
	function confirm_query($result_set)	{
		if(!$result_set)
			die("Databse query failed:" . mysql_error());
	}
	
	function get_all_page($public = true){
		global $conn;
		$query = "select * 
				from form_master 
				where 1=1 
				and visible=1 ";
		$query .= " and form_id in (select form_id 
									from profile_master 
									where user_type = '".$_SESSION['user_type']."' ) 
					order by priority, form_name";
		$page_set=mysql_query($query,$conn);
		confirm_query($page_set);
		return $page_set;
	}
	
	function get_all_catg($order){
		global $conn;
		$query = "select * from cat_master order by ". $order ;
		$Cat=mysql_query($query,$conn);
		confirm_query($Cat);
		return $Cat;
	}
	
	function get_catg_by_id($cat_id){
		global $conn;
		$query = "select * from cat_master where cat_id='".$cat_id."' ";
		$Cat=mysql_query($query,$conn);
		confirm_query($Cat);
		return $Cat;
	}
	
	function get_all_sub_catg($order){
		global $conn;
		$query = "select * 
				from sub_cat_master inner join 
				cat_master on sub_cat_master.cat_id=cat_master.cat_id 
				order by ". $order ;
		$Cat=mysql_query($query,$conn);
		confirm_query($Cat);
		return $Cat;
	}
	
	function get_sub_catg_for_catg($cat_id,$order){
		global $conn;
		$query = "select * 
				from sub_cat_master inner join 
				cat_master on sub_cat_master.cat_id=cat_master.cat_id 
				where sub_cat_master.cat_id='".$cat_id."' 
				order by ". $order ;
		$Cat=mysql_query($query,$conn);
		confirm_query($Cat);
		return $Cat;
	}
	
	function get_sub_catg_by_id($cat_id,$sub_cat_id){
		global $conn;
		$query = "select * 
				from sub_cat_master inner join 
				cat_master on sub_cat_master.cat_id=cat_master.cat_id 
				where sub_cat_master.cat_id='".$cat_id."' and  sub_cat_id='".$sub_cat_id."' " ;
		$Cat=mysql_query($query,$conn);
		confirm_query($Cat);
		return $Cat;
	}
	
	function get_all_catg_detail($order){
		global $conn;
		$query = "select * 
				from sub_cat_detail inner join 
				cat_master on sub_cat_detail.cat_id=cat_master.cat_id inner join 
				sub_cat_master on sub_cat_detail.cat_id=sub_cat_master.cat_id and sub_cat_detail.sub_cat_id=sub_cat_master.sub_cat_id 
				order by ". $order ;
		$Cat=mysql_query($query,$conn);
		confirm_query($Cat);
		return $Cat;
	}
	
	function get_detail_for_sub_catg($cat_id,$sub_cat_id,$order){
		global $conn;
		$query = "select * 
				from sub_cat_detail inner join 
				cat_master on sub_cat_detail.cat_id=cat_master.cat_id inner join 
				sub_cat_master on sub_cat_detail.cat_id=sub_cat_master.cat_id and sub_cat_detail.sub_cat_id=sub_cat_master.sub_cat_id 
				where sub_cat_detail.cat_id='".$cat_id."' and  sub_cat_detail.sub_cat_id='".$sub_cat_id."'
				order by ". $order ;
		$Cat=mysql_query($query,$conn);
		confirm_query($Cat);
		return $Cat;
	}
	
	function get_detail_by_id($cat_id,$sub_cat_id,$cat_detail_id){
		global $conn;
		$query = "select * 
				from sub_cat_detail inner join 
				cat_master on sub_cat_detail.cat_id=cat_master.cat_id inner join 
				sub_cat_master on sub_cat_detail.cat_id=sub_cat_master.cat_id and sub_cat_detail.sub_cat_id=sub_cat_master.sub_cat_id 
				where sub_cat_detail.cat_id='".$cat_id."' and  sub_cat_detail.sub_cat_id='".$sub_cat_id."' and cat_detail_id='".$cat_detail_id."' ";
		$Cat=mysql_query($query,$conn);
		confirm_query($Cat);
		return $Cat;
	}
	
	function get_all_emp($public = true){
		global $conn;
		$query = "select * from employee_master order by emp_name";
		$emp=mysql_query($query,$conn);
		confirm_query($emp);
		return $emp;
	}
	
	function get_emp_by_id($empid){
		global $conn;
		$query = "select * from employee_master where empid='".$empid."'";
		$emp=mysql_query($query,$conn);
		confirm_query($emp);
		return $emp;
	}
	
	function get_all_issue_for_emp($emp_id){
		global $conn;
		$query = "select * 
				from issue_master inner join 
				employee_master on employee_master.empid=issue_master.query_for 
				where query_for='".$emp_id."' or query_for like '".$emp_id."-%'
				order by date desc";
		$issue=mysql_query($query,$conn);
		confirm_query($issue);
		return $issue;
	}
	
	function get_all_issue1_for_emp($emp_id){
		global $conn;
		$query = "select * 
				from issue_master1 inner join 
				employee_master on employee_master.empid=issue_master1.person_for 
				where person_for='".$emp_id."' or person_for like '".$emp_id."-%' or person_for like '".$emp_id.".%'
				order by desc_remark,date desc";
		$issue=mysql_query($query,$conn);
		confirm_query($issue);
		return $issue;
	}
	
	function get_all_issue1_for_emp_relative($emp_id){
		global $conn;
		$query = "select * 
				from issue_master1 inner join 
				employee_master on employee_master.empid=issue_master1.person_for 
				where person_for like '".$emp_id."-%'
				order by desc_remark,date desc";
		$issue=mysql_query($query,$conn);
		confirm_query($issue);
		return $issue;
	}
	
	function get_all_pending_issue1($cat_id,$sub_cat_id,$cat_detail_id,$date,$order){
		global $conn;
		$query = "select * 
				from issue_master1 inner join 
				employee_master on employee_master.empid=issue_master1.person_for 
				where status='Pending' and satisfied_by = 'Not Satisfied'  ";
		if($cat_id!="" && $cat_id!=0){$query .= " and cat_id='".$cat_id."' ";}
		if($sub_cat_id!="" && $sub_cat_id!=0){$query .= " and sub_cat_id='".$sub_cat_id."' ";}
		if($cat_detail_id!="" && $cat_detail_id!=0){$query .= " and cat_detail_id='".$cat_detail_id."' ";}
		if($date!=""){$query .= " and date between '".$date." 00:00:00' and '".$date." 23:59:59' ";}
		if($order!=""){$query .= " order by ".$order;}else{$query .= " order by desc_remark ";}
		$issue=mysql_query($query,$conn);
		confirm_query($issue);
		return $issue;
	}
	
	function get_all_issue_for_catg($cat_id,$sub_cat_id,$cat_detail_id){
		global $conn;
		$query = "select * 
				from issue_master 
				where cat_id='".$cat_id."' ";
		if($sub_cat_id!=""){$query .= " and sub_cat_id='".$sub_cat_id."' ";}
		if($cat_detail_id!=""){$query .= " and cat_detail_id='".$cat_detail_id."' ";}
		$query .= "	order by date desc";
		$issue=mysql_query($query,$conn);
		confirm_query($issue);
		return $issue;
	}
	
	function get_issue_by_id($issue_id){
		global $conn;
		$query = "select * 
				from issue_master 
				where issue_id='".$issue_id."'";
		$issue=mysql_query($query,$conn);
		confirm_query($issue);
		return $issue;
	}
	
	function get_all_relatives_for_emp($emp_id){
		global $conn;
		$query = "select * 
				from emp_relatives inner join 
				employee_master on employee_master.empid=emp_relatives.empid 
				where emp_relatives.empid='".$emp_id."' 
				order by relative_name";
		$relatives=mysql_query($query,$conn);
		confirm_query($relatives);
		return $relatives;
	}
	
	function get_relative_of_emp($emp_id,$relative_id){
		global $conn;
		$query = "select * 
				from emp_relatives 
				where emp_relatives.empid='".$emp_id."' and  relative_id='".$relative_id."'";
		$relatives=mysql_query($query,$conn);
		confirm_query($relatives);
		return $relatives;
	}
	
	function get_all_district($order){
		global $conn;
		$query = "select * from district_master order by ". $order ;
		$Dist=mysql_query($query,$conn);
		confirm_query($Dist);
		return $Dist;
	}
	
	function get_district_by_id($district_id){
		global $conn;
		$query = "select * from district_master where district_id='".$district_id."' ";
		$Dist=mysql_query($query,$conn);
		confirm_query($Dist);
		return $Dist;
	}
	
	function get_all_designation($order){
		global $conn;
		$query = "select * from designation_master order by ". $order ;
		$Desg=mysql_query($query,$conn);
		confirm_query($Desg);
		return $Desg;
	}
	
	function find_selected_page(){
		global $sel_subject;
		global $sel_page;
		if(isset($_GET['subj'])){
			$sel_subject = get_subject_by_id($_GET['subj']);
			$sel_page = get_default_page($sel_subject['id']);
		}elseif(isset($_GET['page'])){
			$sel_subject = NULL;
			$sel_page = get_page_by_id($_GET['page']);
		}else{
			$sel_subject = NULL;
			$sel_page = NULL;
		}
	}
	
	function get_page_by_id($page_id){
		global $conn;
		$query ="select * ";
		$query .="from form_master ";
		$query .="where form_id='". $page_id ."' ";
		$query .="limit 1";
		$result_set=mysql_query($query,$conn);
		confirm_query($result_set);
		if ($page=mysql_fetch_array($result_set)){
			return $page;
		}else{
			return NULL;
		}		
	}
	
	function navigation($sel_subject, $sel_page, $public = false){
		$output = "<a href=\"staff.php\">Return to Menu</a>";
		$output .= "<ul class=\"subjects\">";
				
		$page_set=get_all_page($public);
		while($page=mysql_fetch_array($page_set)){
			$output .= "<li";
			if($page["form_id"]==$sel_page["form_id"]){$output .= " class=\"selected\"";}
			$output .= "><a href=\"content.php?page=". urlencode($page["form_id"]) ."\">{$page["form_name"]}</a></li>";
		}
		$output .= "</ul>";
		return $output;
	}

	function catg_name($cat_id,$sub_cat_id,$cat_detail_id){
		$name = "";
		$Cat=get_catg_by_id($cat_id);
		$Category=mysql_fetch_array($Cat);
		$name .= $Category["cat_name"];
		
		if($sub_cat_id != 0 && $sub_cat_id != ""){
			$SubCat=get_sub_catg_by_id($cat_id,$sub_cat_id);
			$SubCategory=mysql_fetch_array($SubCat);
			$name .= " /".$SubCategory["sub_cat_name"];
		}
		
		if($cat_detail_id != 0 && $cat_detail_id != ""){
			$Detail=get_detail_by_id($cat_id,$sub_cat_id,$cat_detail_id);
			$CatDetail=mysql_fetch_array($Detail);
			$name .= " /".$CatDetail["detail"];
		}
		return $name;
	}
	
	function database_change_date($givendate) {
      $cd = strtotime($givendate);
      $newdate = date('Y-m-d h:i:s', mktime(date('h',$cd),
    date('i',$cd), date('s',$cd), date('m',$cd),
    date('d',$cd), date('Y',$cd)));
      return $newdate;
              }
			  
	function change_date($givendate) {
		$cd = strtotime($givendate);
		$newdate = date('d-M-Y', mktime(date('h',$cd),
		date('i',$cd), date('s',$cd), date('m',$cd),
		date('d',$cd), date('Y',$cd)));
		return $newdate;
	}
			  
	function get_designation_by_id($designation_id){
		global $conn;
		$query = "select * from designation_master where designation_id='".$designation_id."' ";
		$Desg=mysql_query($query,$conn);
		confirm_query($Desg);
		return $Desg;
	}

	function get_native_by_id($nativeplace_id){
		global $conn;
		$query = "select district_name from district_master where district_id='".$nativeplace_id."' ";
 		$district=mysql_query($query,$conn);
                $num_rows=mysql_num_rows($district);   
 
		if($num_rows>0)
 		{
                confirm_query($district);
                $rsrow=mysql_fetch_array($district); 
		return $rsrow[0];
		}
                else
                return "NA";
	}

	function get_designation_by_id1($designation_id){
		global $conn;
		$query = "select designation_name from designation_master where designation_id='".$designation_id."' ";
 		$designation=mysql_query($query,$conn);
                $num_rows=mysql_num_rows($designation);   
 
		if($num_rows>0)
 		{
                confirm_query($designation);
                $rsrow=mysql_fetch_array($designation); 
		return $rsrow[0];
		}
                else
                return "--";
	}
function showmonth($monthid)
{
  switch($monthid)
   {
    case 1: return "January";
	        break;
    case 2: return "February";
	        break;
	case 3: return "March";
	        break;	
    case 4: return "April";
	        break;		
    case 5: return "May";
	        break;		
    case 6: return "June";
	        break;		
    case 7: return "July";
	        break;					
	case 8: return "August";
	        break;				
	case 9: return "September";
	        break;		
	case 10: return "October";
	        break;				
	case 11: return "November";
	        break;				
	case 12: return "December";
	        break;				
   }
}
?> 