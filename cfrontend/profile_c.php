<? include_once("../core/default.php"); 
	
	getVar($cusid,"cusid");
	getVar($labname,"Lname");
	getVar($uaddress,"address");
	getVar($province,"Pvince");
	getVar($country,"Ctry");
	getVar($shipaddress,"shipaddress");
	getVar($billaddress,"billaddress");
	getVar($userid,"uid");
	getVar($new_password,"newpasswd");
	getVar($retype_password,"vpasswd");	
	getVar($old_password,"oldpasswd");	
		
	$profile_update_data = new CSql();
	$profile_update_data->Connect();
							
	$sqlp = "SELECT * FROM customer WHERE customerid=$cusid limit 0,1";							
	$profile_update_data->Query($sqlp);		
	$profile_update_data->TableName = "customer";
	$profile_update_data->Set("cus_name","'$labname'");
	$profile_update_data->Set("cus_address","'$uaddress'");
	$profile_update_data->Set("cus_cnt_id","'$country'");
	$profile_update_data->Set("cus_prv_id","$province");
	$profile_update_data->Set("cus_shipaddress","'$shipaddress'");
	$profile_update_data->Set("cus_billaddress","'$billaddress'");
	$profile_update_data->Update();	

	// begin check user want to change password
	if(($new_password == "" || $retype_password == "") && $old_password != "") {
			$ajax_action = "error";
			$ajax_error = "incompleteform";
	} elseif($new_password != "" && $retype_password != "") {
		// begin check password mismatch
		if($new_password != $retype_password) {
			$ajax_action = "error";
			$ajax_error = "passmismatch";
		} else {
			// begin check old password is blank
			if($old_password != "") {
				if($userid == "" || $userid == 0) {
					$ajax_action = "error";
					$ajax_error = "nouser";
				} else {
					//  begin check that input old password is correct?
					$data = new Csql();
					$data->Connect();
					$data->Query("select * from userdental where userdentalid=$userid and usr_password = OLD_PASSWORD('$old_password') limit 1");
					if(!$data->EOF) {
						$data->TableName = "userdental";
						$data->Set("usr_password","OLD_PASSWORD('$new_password')");
						$data->Update();
						$ajax_action = "changecomplete";
					} else {
						$ajax_action = "error";
						$ajax_error = "invalidpassword";
					}
					// end check old password				
				}
				// end check old password is blank
			} else {
				$ajax_action = "error";
				$ajax_error = "noconfirmpassword";
			}
			// end check password mismatch
		}
	}  else {	
		$ajax_action = "complete";
	} 
	// end check user want to change password

	include("../cfrontend/profile.php");
?>