<?

	include "../core/default.php";
	
	$method = $_POST["METHOD"];
		
	$staffid = $_POST["staffid"];
	
	//$stfcode 		= $_POST["stfcode"];
	$stfgender 		= $_POST["stfgender"];
	$stfname 		= $_POST["stfname"];
	$stfidcard 		= $_POST["stfidcard"];
	$stfsec	 		= $_POST["stfsec"];

	$data_staff = new Csql();
	$err =	$data_staff->Connect();
	$query = "select * from staff
		where 
			staffid=$staffid limit 0,1";
	$data_staff->Query($query);
	
	
	if($method=="UPDATE"){
		$data_staff->TableName = "staff";
		//$data_staff->Set("stf_code","'$stfcode'");
		$data_staff->Set("stf_prefix","'$stfgender'");
		$data_staff->Set("stf_name","'$stfname'");
		$data_staff->Set("stf_idcard","'$stfidcard'");
		$data_staff->Set("stf_sec_id","'$stfsec'");
		$data_staff->Update();
		$data_staff->Execute("update staff,section set stf_code = CONCAT(sec_type,REPEAT('0',4-LENGTH(staffid)),staffid) 
		
		where staffid=$staffid and stf_sec_id = sectionid
		
		");
		
		include "../staff/staffdetail_c.php";
	
	
	}
	$stfcode		= $data_staff->Rs("stf_code"); 
	$stfname 		= $data_staff->Rs("stf_name");
	$stfidcard 		= $data_staff->Rs("stf_idcard");
	$stfsec	 		= $data_staff->Rs("stf_sec_id");

	include "../staff/staffedit.php";
?>
