<? include_once("../core/default.php"); ?>
<? 

	$pre_customerid = $_POST["pre_customerid"];
	$pcus_nick 		= $_POST["pcus_nick"];
	$data_customer = new Csql();
	$data_customer->Connect();
	$data_customer->Query("select *  from pre_customer where pre_customerid = $pre_customerid");

		
	
	$data_customer->Execute("
		insert into userdental
		(usr_username,usr_password,usr_ugp_id)
		select pcus_usr_username,pcus_usr_password,'CM' from pre_customer
		where pre_customerid = $pre_customerid
		");

	$data_customer->Query("select *  from userdental,pre_customer where pcus_usr_username = usr_username");
	$userid = $data_customer->Rs("userdentalid");

	$data_customer->Execute("
		insert into customer
		(cus_usr_id,cus_nick,cus_name,cus_address,cus_cnt_id,cus_prv_id,cus_tel,cus_email)
		select $userid,'$pcus_nick',pcus_name,pcus_address,pcus_cnt_id,pcus_prv_id,pcus_tel,pcus_email 
		from pre_customer
		where pre_customerid = $pre_customerid
		");	
	

	$data_customer->Query("select customerid  from customer where cus_nick='$pcus_nick'");
	$cusid = $data_customer->Rs("customerid");

	$data_customer->Execute("
		insert into doctor
		(doc_name,doc_cus_id)
		select pcus_docname,$cusid 
		from pre_customer
		where pre_customerid = $pre_customerid
		");	
	
	$data_customer->Execute("delete pre_customer from pre_customer where pre_customerid = $pre_customerid");
	
	include("../admin/rqnewcus.php");
?>

