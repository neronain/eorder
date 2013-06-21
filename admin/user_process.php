<? include("../core/default.php"); ?>

<?
function validateEmail($email)
{
	return eregi('^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$',$email);
}
	//var_dump($_GET);
	//$DEBUGSQL = true;
	$action = $_GET["act"];
	$group = $_GET["gr"];
	$customer_id = $_GET["cid"];
	$user_id = $_GET["uid"];
	$staff_id = $_GET["sid"];
	
	// User Information
	$user_username = $_GET["uname"];
	$user_password = $_GET["passwd"];
	$user_email = $_GET["email"];
	$user_fname = $_GET["fname"];
	$user_lname = $_GET["lname"];
	// Staff Inforamtion
	$staff_prefix = $_GET["prefix"];
	$staff_name = $_GET["stfname"];
	$staff_code = $_GET["code"];
	$staff_idcard = $_GET["idcard"];
	$staff_sect = $_GET["section"];
	$staff_enable = $_GET["stfenable"];
	//Customer Information
	$customer_name = $_GET["labname"];
	$customer_code = $_GET["code"];
	$customer_address = $_GET["address"];
	$customer_shipaddress = $_GET["shipaddress"];
	$customer_billaddress = $_GET["billaddress"];
	$customer_province = $_GET["Pvince"];
	$customer_country = $_GET["Ctry"];
	
	$data = new Csql();
	$data->Connect();
	
	switch($action) {
		case "chst":
			$data->Query("select * from userdental where userdentalid = $user_id limit 1");
			$data->TableName = "userdental";
			if(!$data->EOF) {
				$status_new = ($data->Rs("usr_status") == "ACTIVE") ? "DEACTIVE" : "ACTIVE";
				$data->Set("usr_status","'$status_new'");
				$data->Update();
			}
			$data->Query("select usr_status from userdental where userdentalid= $user_id limit 1");
			if(!$data->EOF)
				echo $data->Rs("usr_status");
			break;
		case "add":
			if($user_username!="") {
				$data->Query("select * from userdental where usr_username ='$user_username'");
				if($data->Count() == 0) {
					$data->AddNew();
					$data->TableName = "userdental";
					$data->Set("usr_username","'$user_username'");
					$data->Set("usr_password","OLD_PASSWORD('$user_password')");
					$data->Set("usr_email","'$user_email'");
					$data->Set("usr_ugp_id","'$group'");
					$data->Set("usr_fname","'$user_fname'");
					$data->Set("usr_sname","'$user_lname'");
					$data->Update();
					redirect("../admin/user_manager_c.php?gr=$group",0);
				} else {
?>
	<p align="center"><font color="#FF0000">
    <strong>You already have user account store in database.</strong>
    <br /> Please contact Supporter.
    <br /> E-mail address: pppstudio@gmail.com
    <br /> Telephone no: (+66) 053-331-555 </font>
    <br /><a href='../admin/user_manager_c.php?gr=<?=$group?>'>Back to main page</a>
    </p>
<?				
				}
			}
			if($group == "ST") {
				$data->AddNew();
				$data->TableName = "staff";
				$data->Set("stf_prefix","'$staff_prefix'");
				$data->Set("stf_name","'$staff_name'");
				$data->Set("stf_sec_id","'$staff_sect'");
				$data->Set("stf_code","'$staff_code'");
				$data->Set("stf_idcard","'$staff_idcard'");
				$data->Set("stf_enable","'$staff_enable'");
				$data->Update();			
				$id = $data->GetMaxID("staff");
				if($user_username != "") {
					$data->Query("select * from staff where staffid = $id limit 1");
					$data->TableName = "staff";
					$data->Set("stf_usr_id","'$id'");
					$data->Update();
				}
				redirect("../admin/user_manager_c.php?gr=$group",0);
			} elseif($group == "CM") {
				$data->AddNew();
				$data->TableName = "customer";
				$data->Set("cus_name","'$customer_name'");
				$data->Set("cus_nick","'$customer_code'");
				$data->Set("cus_address","'$customer_address'");
				$data->Set("cus_shipaddress","'$customer_shipaddress'");
				$data->Set("cus_billaddress","'$customer_billaddress'");
				$data->Set("cus_prv_id","'$customer_province'");
				$data->Set("cus_cnt_id","'$customer_country'");
				$data->Update();
				$id = $data->GetMaxID("customer");
				if($user_username != "") {
					$data->Query("select * from customer where customerid = $id limit 1");
					$data->TableName = "customer";
					$data->Set("cus_usr_id","'$id'");
					$data->Update();
				}
				redirect("../admin/user_manager_c.php?gr=$group",0);
			}
			break;
		case "edit":
			if($user_id > 0) {
				$data->Query("select * from userdental where userdentalid = $user_id limit 1");
				$data->TableName = "userdental";
				$data->Set("usr_username","'$user_username'");
				if($user_password != "")
					$data->Set("usr_password","OLD_PASSWORD('$user_password')");
				$data->Set("usr_email","'$user_email'");
				$data->Set("usr_ugp_id","'$group'");
				$data->Set("usr_fname","'$user_fname'");
				$data->Set("usr_sname","'$user_lname'");
				$data->Update();
				$gr = "MN";
			} elseif($user_id < 0) {
				$data->AddNew();
				$data->TableName = "userdental";
				$data->Set("usr_username","'$user_username'");
				$data->Set("usr_password","OLD_PASSWORD('$user_password')");
				$data->Set("usr_email","'$user_email'");
				$data->Set("usr_ugp_id","'$group'");
				$data->Set("usr_fname","'$user_fname'");
				$data->Set("usr_sname","'$user_lname'");
				$data->Update();
			}
			if($staff_id != 0) {
				$data->Query("select * from staff where staffid = $staff_id limit 1");
				$data->TableName = "staff";
				$data->Set("stf_prefix","'$staff_prefix'");
				$data->Set("stf_name","'$staff_name'");
				$data->Set("stf_sec_id","'$staff_sect'");
				$data->Set("stf_code","'$staff_code'");
				$data->Set("stf_idcard","'$staff_idcard'");
				$data->Set("stf_enable","'$staff_enable'");
				if($user_id == -1) {
					$userdata = new Csql();
					$userdata->Connect();
					$id = $userdata->GetMaxID("userdental");
					$data->Set("stf_usr_id","'$id'");
				}
				$data->Update();
				$gr = "ST";
			}elseif($customer_id != 0) {
				$data->Query("select * from customer where customerid = $customer_id limit 1");
				$data->TableName = "customer";
				$data->Set("cus_name","'$customer_name'");
				$data->Set("cus_nick","'$customer_code'");
				$data->Set("cus_address","'$customer_address'");
				$data->Set("cus_shipaddress","'$customer_shipaddress'");
				$data->Set("cus_billaddress","'$customer_billaddress'");
				$data->Set("cus_prv_id","'$customer_province'");
				$data->Set("cus_cnt_id","'$customer_country'");
				if($user_id == -1) {
					$userdata = new Csql();
					$userdata->Connect();
					$id = $userdata->GetMaxID("userdental");
					$data->Set("cus_usr_id","'$id'");
				}
				$data->Update();
				$gr = "CM";
			}			
			redirect("../admin/user_manager_c.php?gr=$gr",0);
			break;
		case "del":
			if($user_id != 0) {
				$data->Execute("delete from userdental where userdentalid = $user_id");
				$gr = "MN";
			}
			if($staff_id != 0) {
				$data->Query("select * from staff where staffid = $staff_id limit 1");
				$data->TableName = "staff";
				$data->Set("stf_usr_id","'0'");
				$data->Set("stf_enable","'0'");
				$data->Update();
				$gr = "ST";
			} elseif($customer_id != 0) {
				$data->Query("select * from customer where customerid = $customer_id limit 1");
				$data->TableName = "customer";
				$data->Set("cus_usr_id","'0'");
				$data->Update();
				$gr = "CM";
			}
			//redirect("../admin/user_manager_c.php?gr=$gr",0);
			echo "";
			break;
		default:
			redirect("../admin/user_manager_c.php",0);
			break;
	}
?>