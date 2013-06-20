<? include_once("../core/default.php"); ?>

<?
	$group = $_GET["gr"]; if(!isset($group))$group = 'ST';
	$keyword = $_GET["keyword"];
	$enable_staff = (isset($_GET["enable"])) ? $_GET["enable"] : 1;
	$disable_staff = (isset($_GET["disable"])) ? $_GET["disable"] : 1;
	$page = $_GET["page"]; if(!isset($page))$page = 1;
	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	
	$country_id = $_GET["country"]; if(!isset($country_id))$country_id = 0;
	$section = $_GET["section"]; if(!isset($section))$section = 0;
	$user_data = new CSql();
 	$user_data->Connect();
	$iquery = "select * ";
	$cquery = "select count(*) as countrow ";
	switch($group) {
		case "ST":
			$iquery = "select staffid,sec_room,userdentalid,usr_status,usr_username,stf_name ";
			$criteria = ($section != 0) ? " and stf_sec_id=$section " : " ";
			if($enable_staff==1 && $disable_staff==1) {
				$criteria .= " ";
			} elseif($enable_staff==1) {
				$criteria .= " and stf_enable=1";
			} elseif($disable_staff==1) {
				$criteria .= " and stf_enable=0";
			} else {
				$criteria .= " and (false)";
			}
			if($keyword != "") {
				$query = "from (select * from staff,section
								where stf_sec_id = sectionID and (stf_name like '%".$keyword."%' or sec_room like '%".$keyword."%')".$criteria.") as main
								left join userdental on stf_usr_id=userdentalid and usr_ugp_id = '".$group."' 
								and usr_username like '%".$keyword."%'";
			} else {
				$query = "from (select * from staff,section
								where stf_sec_id = sectionID".$criteria.") as main
								left join userdental on stf_usr_id=userdentalid and usr_ugp_id = '".$group."'";
			}
			 break;
		case "MN":
			$query = "from userdental where usr_ugp_id='".$group."' ";
			if($keyword != "") {
				$query .= " and (usr_username like '%".$keyword."%' or stf_name like '%".$keyword."%' or sec_room like '%".$keyword."%')";
			}
			break;
		case "CM":
			$iquery = "select customerid,cus_name,prv_name,cnt_name,usr_username,
			userdentalid,usr_status ";
			$criteria = ($keyword != "") ? " and (cus_name like '%".$keyword."%' or prv_name like '%".$keyword."%') " : " ";
			if($country_id != 0){ 
				$query = " from (select * from customer,province,country 
								where cus_cnt_id = countryid  and cus_cnt_id = $country_id 
								and cus_prv_id = provinceid".$criteria.") as main
				left join userdental on cus_usr_id=userdentalid and usr_ugp_id = '".$group."'";
			}else{
				$query = "from (select * from customer,province ,country
								where cus_cnt_id = countryid 
								and cus_prv_id = provinceid ".$criteria.") as main
					left join userdental on cus_usr_id=userdentalid and usr_ugp_id = '".$group."'";
			}
			if($keyword != "") {
				$query .= " and (usr_username like '%".$keyword."%' or cus_name like '%".$keyword."%' or prv_name like '%".$keyword."%')";
			}

			break;
		default:
			$query = "from userdental"; break;
	}
	$cquery.=$query;
	$query = $iquery.$query;
	$user_data->Query("$cquery");
	$group_name = ($group=="ST") ? "Staff" : (($group=="MN") ? "Manager" : (($group=="CM") ? "Customer" : ""));
	$totalrow = $user_data->Rs("countrow");
	$user_data->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");
	$totalpage = ceil($totalrow/$eachpage);
	$querystring  = "?";
	foreach($_GET as $variable => $value){
		if($variable=="page") continue;
		$querystring  .= "$variable=$value&";
	}

?>

<? include("../admin/user_manager.php"); ?>