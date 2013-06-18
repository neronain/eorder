<?	include_once("../core/csql.php"); ?>
<?  	include_once("../core/config.php");?>
<?
	$usrusername 	= $_POST["usrusername"];
	$password 			= $_POST["password"];

	
	$cusname 			= $_POST["cusname"];

	$docname			= $_POST["docname"];

	$address 			= $_POST["address"];

	$address1 			= $_POST["address1"];
	$address2 			= $_POST["address2"];
	$address3 			= $_POST["address3"];
	$address4 			= $_POST["address4"];
	$address5 			= $_POST["address5"];
	$address6 			= $_POST["address6"];
	

	$tel					= $_POST["tel"];
	$email				= $_POST["email"];	
	$remark				= $_POST["remark"];

	$country 			= $_POST["country"];
	$provinceid 		= $_POST["provinceid"];
	$provincename 	= $_POST["provincename"];
	
	if($country==1){
		if($provinceid==1){
			$address.=$address1;
			if(trim($address2)!='-' && trim($address2)!='') $address.=" ซอย ".$address2;
			if(trim($address3)!='-' && trim($address3)!='') $address.=" ถ. ".$address3;
			if(trim($address4)!='-' && trim($address4)!='') $address.=" ".$address4;
			if(trim($address5)!='-' && trim($address5)!='') $address.=" ".$address5;
			if(trim($address6)!='-' && trim($address6)!='') $address.=" ".$address6;
		}else{
			$address.=$address1;
			if(trim($address2)!='-' && trim($address2)!='') $address.=" ถ. ".$address2;
			if(trim($address3)!='-' && trim($address3)!='') $address.=" ซอย ".$address3;
			if(trim($address4)!='-' && trim($address4)!='') $address.=" หมู่ ".$address4;
			if(trim($address5)!='-' && trim($address5)!='') $address.=" ต. ".$address5;
			if(trim($address6)!='-' && trim($address6)!='') $address.=" อ. ".$address6;
		}
	}



	$data_customer = new Csql();
	$data_customer->Connect();
	$data_customer->Query("select * from pre_customer limit 0,1");
	$data_customer->Addnew();
	$data_customer->TableName = "pre_customer";
	$data_customer->Set("pcus_usr_username","'$usrusername'");
	$data_customer->Set("pcus_usr_password","password('$password')");
	$data_customer->Set("pcus_name","'$cusname'");
	$data_customer->Set("pcus_docname","'$docname'");
	$data_customer->Set("pcus_address","'$address'");
	$data_customer->Set("pcus_cnt_id","$country");
	$data_customer->Set("pcus_prv_id","$provinceid");
	$data_customer->Set("pcus_prv_name","'$provincename'");
	$data_customer->Set("pcus_tel","'$tel'");
	$data_customer->Set("pcus_email","'$email'");
	$data_customer->Set("pcus_remark","'$remark'");
	$data_customer->Update();
	
	include("../register/waitcheck.php");
?>
