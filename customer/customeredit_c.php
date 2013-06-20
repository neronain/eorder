<?

	include "../core/default.php";
	//$DEBUGSQL = true;
	//var_dump($_POST);
	if(!isset($customerid)) $customerid = $_GET["customerid"];
	if(!isset($customerid)) $customerid = $_POST["customerid"];
	$method = $_POST["METHOD"];
		
	$data_customer = new Csql();
	$data_customer->Connect();
	$query = "select * from customer where customerid=$customerid limit 0,1";
	$data_customer->Query($query);
	
	
	if($method=="UPDATE"){
		if($_POST["customerid"] != "") {
			$customerid = $_POST["customerid"];
			$cus_name = $_POST["cus_name"];
			$cus_nick = $_POST["cus_nick"];
			$cus_tel = $_POST["cus_tel"];
			$cus_email = $_POST["cus_email"];
			$country = $_POST["country"];
			$province = $_POST["province"];
			$address = $_POST["address"];
			$shipaddress = $_POST["shipaddress"];
			$billaddress = $_POST["billaddress"];
		}

		//TODO : update customer parameter
		$data_customer->TableName = "customer";
		$data_customer->Set("cus_name","'$cus_name'");			
		$data_customer->Set("cus_nick","'$cus_nick'");
		if($province != "")
			$data_customer->Set("cus_prv_id","$province");
		if($country != "")
			$data_customer->Set("cus_cnt_id","$country");
		$data_customer->Set("cus_tel","'$cus_tel'");
		$data_customer->Set("cus_email","'$cus_email'");
		$data_customer->Set("cus_address","'$address'");
		$data_customer->Set("cus_shipaddress","'$shipaddress'");
		$data_customer->Set("cus_billaddress","'$billaddress'");
		$data_customer->Update();
		
		include "../customer/customeredit_saved.php";
		exit();
	
	}
	
	$customerid 	= $data_customer->Rs("customerid");
	$cus_name 		= $data_customer->Rs("cus_name");
	$cus_nick	 	= $data_customer->Rs("cus_nick");
	$country = $data_customer->Rs("cus_cnt_id");
	$province 		= $data_customer->Rs("cus_prv_id");
	$cus_tel = $data_customer->Rs("cus_tel");
	$cus_email = $data_customer->Rs("cus_email");
	$address = $data_customer->Rs("cus_address");
	$shipaddress = $data_customer->Rs("cus_shipaddress");
	$billaddress = $data_customer->Rs("cus_billaddress");

	include "../customer/customeredit.php";
?>
