<?
	include_once "../core/default.php";
	
	GetVar($customerid,"customerid");

	$data_doctor = new Csql();
	$err =	$data_doctor->Connect();
	$query = "select * from doctor
		where 
			doc_cus_id = $customerid ";

	$data_doctor->Query($query);
	
	$data_customer= new Csql();
	$data_customer->Connect();
	


	include "customerdoctor.php";

?>
