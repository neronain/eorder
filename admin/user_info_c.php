<? include_once("../core/default.php"); ?>

<?
	//var_dump($_GET);
	$user_id = $_GET["uid"];
	$customer_id = $_GET["cid"];
	$staff_id = $_GET["sid"];
	$group = $_GET["gr"];
	
	$user_data = new Csql();
	$staff_data = new Csql();
	$customer_data = new Csql();
	$user_data->Connect();
	$staff_data->Connect();
	$customer_data->Connect();
	
	if(isset($user_id) && $user_id != 0) {
		$user_data->Query("select * from userdental where userdentalid = $user_id limit 1");
		if(!$user_data->EOF) {
			$username = $user_data->Rs("usr_username");
			$password = $user_data->Rs("usr_password");
			$email = $user_data->Rs("usr_email");
			$name = $user_data->Rs("usr_fname")." ".$user_data->Rs("usr_sname");
		}
	}
	if(isset($staff_id) && $staff_id != 0) {
		$staff_data->Query("select stf_name,stf_code,stf_idcard,stf_enable,stf_prefix,sec_room,sec_type,branch_name from staff,section,branch where staffid=$staff_id and stf_sec_id=sectionid and stf_brn_id=branchid limit 1");
		if(!$staff_data->EOF) {
			$staff_name = $staff_data->Rs("stf_name");
			$staff_code = $staff_data->Rs("stf_code");
			$staff_idcard = $staff_data->Rs("stf_idcard");
			$enable = $staff_data->Rs("stf_enable");
			$staff_prefix = $staff_data->Rs("stf_prefix");
			switch($staff_data->Rs("sec_type")) {
				case "F": $sname = "[ Fix ] "; break;
				case "R": $sname = "[ Remove ] "; break;
				case "O": $sname = "[ Ortho ] "; break;
			}
			$section_name .= $staff_data->Rs("sec_room");
            $branch_name = $staff_data->Rs("branch_name");
		}
	} elseif(isset($customer_id) && $customer_id != 0) {
		$customer_data->Query("select cus_name,cus_nick,cus_address,cus_shipaddress,cus_billaddress,cnt_name,prv_name from customer,province,country where cus_cnt_id = countryid and cus_prv_id = provinceid and customerid=$customer_id limit 1");
		if(!$customer_data->EOF) {
			$cus_name = $customer_data->Rs("cus_name");
			$cus_nick = $customer_data->Rs("cus_nick");
			$cus_address = $customer_data->Rs("cus_address");
			$ship_address = $customer_data->Rs("cus_shipaddress");
			$bill_address = $customer_data->Rs("cus_billaddress");
			$cntt = $customer_data->Rs("cnt_name");
			$prvt = $customer_data->Rs("prv_name");
		}
	}
?>

<? include("../admin/user_info.php"); ?>