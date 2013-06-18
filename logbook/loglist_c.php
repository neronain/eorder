<?
	include_once("../core/default.php"); 
// IN
	$method 	= $_POST["METHOD"];	
	$logbookid = $_POST["logbookid"];
	$page = $_GET["page"]; 
	if(!isset($page)){		$page = $_POST["page"];	}
	if(!isset($page)){		$page = 1;	}
	
	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	
	
// INIT
	$data_logbook = new Csql();
	$data_logbook->Connect();

// Start Code
	$msg = '';
	if(isset($method)){
		if($method=="DELETE"){
			if(isset($logbookid)){
				$data_logbook->Execute("delete logbook from logbook where logbookid=$logbookid");
			}
		}
	}


	/*$iquery = "select logbookid,
	DATE_FORMAT(log_date,'%d/%m/%y %H:%i') as log_datef,log_date,
	stf_name,sec_room,ord_code,log_type,eorderid ";*/
	$iquery = "select logbookid,
	DATE_FORMAT(log_date,'%d/%m/%y %H:%i') as log_datef,log_date,log_type,
	log_stf_id,log_ord_id,log_sec_id";	
	$cquery = "select count(*) as countrow ";
	/*$query = "from  logbook,staff,eorder,customer,section
		where 
			log_stf_id = staffid and 
			log_ord_id = eorderid and
			log_sec_id = sectionid and
			ord_cus_id = customerid 
			
			order by log_date desc
			";*/
	$query = " from  logbook ";
	$oquery = " order by log_date desc"; 
	
	$cquery.=$query;
	$query = $iquery.$query.$oquery;
	$data_logbook->Query("$cquery");
	$totalrow = $data_logbook->Rs("countrow");
	$data_logbook->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
	
	
	/*-------------- optimize -------------------*/
	$data_tmp = new Csql();
	$data_tmp->Connect();
	
	$cache = array();
	$data_logbookAr = array();
	
	while(!$data_logbook->EOF){
		$rowAr = $data_logbook->CurrentRowArray();
		
		$key = $rowAr['log_ord_id'];
		if($cache['eorder'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select ord_code from eorder where eorderid = {$key} limit 0,1");
			$cache['eorder'][$key] = $tmpRow;
		}
		$rowAr['eorderid'] = $rowAr['log_ord_id'];
		$rowAr['ord_code'] = $cache['eorder'][$key]["ord_code"];
		
		$key = $rowAr['log_stf_id'];
		if($cache['staff'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select stf_name from staff where staffid = {$key} limit 0,1");
			$cache['staff'][$key] = $tmpRow;
		}
		$rowAr['stf_name'] = $cache['staff'][$key]["stf_name"];
		

		$key = $rowAr['log_sec_id'];
		if($cache['section'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select sec_room from section where sectionid = {$key} limit 0,1");
			$cache['section'][$key] = $tmpRow;
		}
		$rowAr['sec_room'] = $cache['section'][$key]["sec_room"];		
		

		

		$data_logbookAr[] = $rowAr;
		$data_logbook->MoveNext();	
	
	} 	
	/*-------------- optimize -------------------*/
	
	
	
	
	
	//$page = 10;	
	$totalpage = ceil($totalrow/$eachpage);

	include ("../logbook/loglist.php");
	
	
?>
