<?
	include_once("../core/default.php") ;
	
	GetVar($eorder_id,"eorderid");
	GetVar($eorderid,"eorderid");
	GetVar($status,"status");
	
	$arrivedatetime = $_GET['adate'];
	$releasedatetime = $_GET['rdate'];
	
	$data = new Csql();
	$data->Connect();
	$data->Query("select eorderid,ord_status from eorder where eorderid=$eorder_id limit 1");
	if($data->EOF) {
		exit();
	}
	$update = FALSE;
	if($data->Rs("ord_status")!=$status){
		$update = TRUE;
	}
	if($update){
		$data->TableName = "eorder";
		$data->Set("ord_status","$status");
		$data->Set("ord_date","NOW()");
		$data->Update();
	}
	
	switch($status){
		case 0: // Draft
			break;
		case 1: // Sending
			break;
		case 2: // Arrive
			if($update){
			 
			 	$data->Execute("update eorder set 
					ord_arrivedate = '$arrivedatetime' ,
					ord_releasedate = '$releasedatetime' 
					where  eorderid = $eorderid ");
					
				$data->Execute("insert into eordertoday
				(eordertodayid, ordt_code, ordt_doc_id, ordt_patientname, ordt_cus_id, ordt_date, ordt_releasedate, ordt_docdate,ordt_priority, ordt_status, ordt_operateday, ordt_detail, ordt_remark, ordt_isship,ordt_typeofwork) 
				
				 select eorderid, ord_code, ord_doc_id, ord_patientname, ord_cus_id, ord_date, ord_releasedate, ord_docdate,ord_priority, ord_status, ord_operateday, ord_detail, ord_remark,0 ,ord_typeofwork 
				 from eorder where eorderid = $eorderid ");	
				 					
			}
			include("../cfrontend/ordersummary_menu.php");
			exit();
			break;
		case 3: // Processing
			if($update) {
				$data->Execute("update eorder set ord_processdate = NOW() where eorderid = $eorderid ");
			}
			break;
		case 4: // Released
			if($update) {
				$data->Execute("update eorder set ord_sendbackdate = '$releasedatetime' where eorderid = $eorderid ");
			}
			break;
		case 5: // Wait payment
			if($update) {
				$data->Execute("update eorder set ord_gotdate = NOW() where eorderid = $eorderid ");
			}
			break;
		case 6: // Wait confirm
			if($update) {
				$data->Execute("update eorder set ord_paiddate = NOW() where eorderid = $eorderid ");
			}
			break;
		case 7: // Archieve
			if($update) {
				$data->Execute("update eorder set ord_archievedate = NOW() where eorderid = $eorderid ");
			}
			break;

	}	
?>