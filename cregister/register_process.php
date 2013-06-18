<? include_once("../cregister/customer_register.php"); ?>

<?	
	//$DEBUGSQL = true;	
	function validateEmail($email)
	{
		return eregi('^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.([a-zA-Z]{2,4})$',$email);
	}
	
	$data = new Csql();
	$data->Connect();	
	
    getVar($customerid,"cid");
    getVar($usertype,"utype"); 
    getVar($register_username,"uname"); 
    getVar($password,"passwd"); 
    getVar($retype_password,"vpasswd"); 
    getVar($email,"email"); 
    getVar($retype_email,"vemail"); 
    getVar($labname,"labname"); 
    getVar($address,"address"); 
    getVar($province,"Pvince"); 
    getVar($country,"Ctry"); 
    getVar($shipaddress,"shipaddress"); 
    getVar($billaddress,"billaddress"); 
	    
    if($usertype == "new") {
       $have_useracc = false;
    } else {
        $data->Query("select cus_usr_id from customer where customerid=$customerid limit 1");
        if(!$data->EOF) {
            $have_useracc = ($data->Rs("cus_usr_id") == 0) ? false : true;
        } else {
            $have_useracc = false;
        }   
    }

	/*echo "register_username = $register_username<br>";
	echo "password = $password<br>";
	echo "retype_password = $retype_password<br>";
	echo "email = $email<br>";
	echo "retype_email = $retype_email<br>";
	echo "labname = $labname<br>";
	echo "address = $address<br>";
	echo "province = $province<br>";
	echo "country = $country<br>";
	echo "shipaddress = $shipaddress<br>";
	echo "billaddress = $billaddress<br>";*/

if($have_useracc) {
		$error = true;
?>
<script>showHTML('DivShowCustomer',"../cregister/display_status.php?type=EXISTINGACCOUNT&addtype=<?=$usertype?>&cid=<?=$customerid?>");</script>
<?
} else {
	/*if(($usertype == "new") && ($labname =="" || $register_username=="" || $password=="" || $retype_password=="" || $email=="" || $retype_email=="")) {
		$error = true;
?>
<script>showHTML('DivShowCustomer',"../cregister/display_status.php?type=FILLALLTEXTBOX&addtype=<?=$usertype?>&cid=<?=$customerid?>");</script>
<?
	} else*/if(($register_username=="" || $password=="" || $retype_password=="" || $email=="" || $retype_email=="") || ($usertype == "new" && $labname == "")) {
		$error = true;
		$binary = 0;
		$binary += (($register_username=="") ? 1 : 0) << 0;
		$binary += (($password=="") ? 1 : 0) << 1;
		$binary += (($retype_password=="") ? 1 : 0) << 2;
		$binary += (($email=="") ? 1 : 0) << 3;
		$binary += (($retype_email=="") ? 1 : 0) << 4;
		$binary += (($usertype == "new" && $labname == "") ? 1 : 0) << 5;
		//echo "binary = $binary<br>";
?>
<script>showHTML('DivShowCustomer',"../cregister/display_status.php?type=FILLALLTEXTBOX&addtype=<?=$usertype?>&cid=<?=$customerid?>&empty=<?=$binary?>");</script>
<?
	} elseif($password != $retype_password) {
		$error = true;
?>
<script>showHTML('DivShowCustomer',"../cregister/display_status.php?type=INCORRECTPASSWORD&addtype=<?=$usertype?>&cid=<?=$customerid?>");</script>
<?
	} elseif ($email != $retype_email) {
		$error = true;
?>
<script>showHTML('DivShowCustomer',"../cregister/display_status.php?type=INCORRECTEMAIL&addtype=<?=$usertype?>&cid=<?=$customerid?>");</script>
<?
	} elseif(!validateEmail($email)) {
?>
<script>showHTML('DivShowCustomer',"../cregister/display_status.php?type=EMAILINVALID&addtype=<?=$usertype?>&cid=<?=$customerid?>");</script>
<?
	} else {
		$data->Query("select * from userdental where usr_username='$register_username' limit 1");
		if(!$data->EOF) {
			$error = true;
?>
<script>showHTML('DivShowCustomer',"../cregister/display_status.php?type=DUPLICATEUSERNAME&addtype=<?=$usertype?>&cid=<?=$customerid?>");</script>
<?
		} else {
			$error = false;
			$data->AddNew();
			$data->TableName = "userdental";
			$data->Set("usr_username","'$register_username'");
			$data->Set("usr_password","OLD_PASSWORD('$password')");
			if($email != NULL) $data->Set("usr_email","'$email'");
			$data->Set("usr_ugp_id","'CM'");
			$data->Set("usr_status","'DEACTIVE'");
			$data->Update();
			$user_id = $data->GetMaxID("userdental");
			
			$max_nick = 0;
			$data->Query("select max(right(cus_nick,3)) as max_nick from customer where left(cus_nick,1) = 'D'");
			if(!$data->EOF) {
				$max_nick = $data->Rs("max_nick");
			}
			$cus_nick = "D".str_pad($max_nick+1, 3, "0", STR_PAD_LEFT);
			if($usertype == "new") {				
				$data->AddNew();
				$data->TableName = "customer";
				$data->Set("cus_usr_id","'$user_id'");
				$data->Set("cus_name","'$labname'");
				$data->Set("cus_nick","'$cus_nick'");
				if($address != NULL) $data->Set("cus_address","'$address'");
				if($email != NULL) $data->Set("cus_email","'$email'");
				if($shipaddress != NULL) $data->Set("cus_shipaddress","'$shipaddress'");
				if($billaddress != NULL) $data->Set("cus_billaddress","'$billaddress'");
				$data->Update();
				$customerid = $data->GetMaxID("customer");
			} elseif($usertype == "old") {
				$data->Query("select * from customer where customerid=$customerid limit 1");
				$data->TableName = "customer";
				$data->Set("cus_usr_id","$user_id");
				$data->Update();
			}
?>
<script>showHTML('DivShowCustomer',"../cregister/display_status.php?type=COMPLETE&uname=<?=$register_username?>&passwd=<?=$password?>&addtype=<?=$usertype?>&cid=<?=$customerid?>");</script>
<?
		}
	}
}
	
	if($error === true) {
		if($usertype == "old") {
            redirect("../cregister/customer_register.php?act=add&utype=old&cid=$customerid",5);
		} elseif($usertype == "new") {
            redirect("../cregister/customer_register.php?act=add&utype=new",5); 
		}
	} 
?>
