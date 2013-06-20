<? include_once("../core/default.php"); ?>
<?
// IN
	$method 		= $_POST["METHOD"];
	//$stfcode		= $_POST["stfcode"];
	$stfgender			= $_POST["stfgender"];
	$stfname 		= $_POST["stfname"];
	$stfidcard	 	= $_POST["stfidcard"];
	$stfsec	 		= $_POST["stfsec"];


// Intilize
	$method 	= isset($method)?$method:'NEW';
	$msg ='';
// Start code
//	$staffid;


	$data_staff = new CSql();
	$data_staff->Connect();
	
	if($method=="ADD"){
		if(strlen($stfname)>0 && isset($stfidcard)>0 && strlen($stfsec) ){
		
			$data_staff->Query("select * from staff
				where stf_idcard='$stfidcard'");
			if($data_staff->Count()==0){
				$data_staff->Addnew();
				$data_staff->TableName = "staff";
				//$data_staff->Set("stf_code","'$stfcode'");
				$data_staff->Set("stf_name","'$stfname'");
				$data_staff->Set("stf_idcard","'$stfidcard'");
				$data_staff->Set("stf_sec_id","'$stfsec'");
				$data_staff->Set("stf_prefix","'$stfgender'");
				$data_staff->Update();
				
				//$stfcode ="";

				$data_staff->Execute("update staff,section set stf_code = CONCAT(sec_type,REPEAT('0',4-LENGTH(staffid)),staffid) 
					where stf_idcard='$stfidcard'  and stf_sec_id = sectionid ");

				$data_staff->Query("select * from staff	where stf_idcard='$stfidcard'");
				$stfcode = $data_staff->Rs("stf_code");
				
				$msg ="<font color =#00CC33>Add complete Code:$stfcode</font>";
				
				$stfname ="";
				$stfidcard ="";
				$stfsec ="";
			}else{
				$data_staff->Query("select * from staff	where stf_idcard='$stfidcard'");
				if($data_staff->Count()>0){					$stfidcard="[ Duplicate! ]".$stfidcard;				}
				
				$msg ="<font color =#CC3300>Error duplicated data</font>";
			}
		}else{
			$msg ="<font color =#CC3300>Error not complete data</font>";
		}
	}

	include("../staff/staffadd.php");

?>
