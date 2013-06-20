<?	include_once("../core/csql.php"); ?>
<?  	include_once("../core/config.php");?>
<?
	
	$usrusername 	= $_POST["usrusername"];
	$password 			= $_POST["password"];
	$password2 		= $_POST["password2"];
	$country 			= $_POST["country"];


	$passcondition = true;
	$errortext = "";
	
	if(!isset($country)){
		include "../register/regis1.php";
		exit();
	}

	if(strlen($usrusername)>0){
		$data_customer = new Csql();
		$data_customer->Connect();
		$query = "select * from userdental
			where usr_username='$usrusername'";
		$data_customer->Query($query);
		if($data_customer->Count()>0){
			$errortext .="- Username exists.<br>";
			$passcondition = false;
		}
		$query = "select * from pre_customer
			where pcus_usr_username='$usrusername'";
		$data_customer->Query($query);
		if($data_customer->Count()>0){
			$errortext .="- Username was used for register already.<br>";
			$passcondition = false;
		}
	}else{
		$errortext .="- Please define username.<br>";
		$passcondition = false;
	}
	

	if(strlen($password)<5 || strlen($password2)<5){
		$errortext .="- Password need at least 5 characters.<br>";
		$passcondition = false;
	}else	if($password!=$password2 ){
		$errortext .="- Password not match.<br>";
		$passcondition = false;
	}



	if($passcondition){
		if($country==1){
			include "../register/regis2_t.php";
		}else{
			include "../register/regis2_e.php";
		}
	}else{
		include "../register/regis1.php";
	}

?>
