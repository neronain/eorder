<?
	include "../core/default.php";
	
	GetVar($customerid,"customerid");


	$data_customer = new Csql();
	$err =	$data_customer->Connect();
	$query = "select * from customer,country,province
		where 
			cus_prv_id = provinceid and
			cus_cnt_id = countryid and
			customerid=$customerid limit 0,1";
	$data_customer->Query($query);



	include "customerdetail.php";

?>
