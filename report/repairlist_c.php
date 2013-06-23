<? 
include_once("../core/default.php"); 
include_once("../order/inc_getstring.php"); 

	$method = $_GET["METHOD"];
	$filter = $_GET["filter"];

	$searchtype = $_GET["searchtype"];
	$type = $_GET["type"];
	$istype		 	= $_GET["selectTypeChkBox"];
	
	$output_type	= $_GET["output_type"];
	
	
	if($istype != 1){
		$type = "A";
	}
	
	$country = $_GET["country"];

	$order = $_GET["order"];
	$output = $_GET["output"];
	if(!isset($output))$output = "web";
	
	
	
	
	$iscountry 		= $_GET["CountryChkBox"];
	
	$keyword = trim($_GET["keyword"]);
	

	$cdate 		= $_GET["fromdate_day"];
	$cmonth 	= $_GET["fromdate_month"];
	$cyear 		= $_GET["fromdate_year"];

	$edate 		= $_GET["enddate_day"];
	$emonth 	= $_GET["enddate_month"];
	$eyear 		= $_GET["enddate_year"];

	while(strlen($cdate)<2 && strlen($cdate)>0){ $cdate = "0".$cdate;	}
	while(strlen($cmonth)<2 && strlen($cmonth)>0){ $cmonth = "0".$cmonth;	}
	while(strlen($edate)<2 && strlen($edate)>0){ $edate = "0".$edate;	}
	while(strlen($emonth)<2 && strlen($emonth)>0){ $emonth = "0".$emonth;	}



	$data_order = new CSql();
 	$err =	$data_order->Connect();
	
//-----------------------------------------------------------------------------------------------------------------------------------	
// Clear	
	
//	$data_order->Execute("delete eorder from eorder 
//	where  DATEDIFF(CURDATE(),ord_releasedate)>7 and ord_isship=TRUE");
	
	
	
	
	
//-----------------------------------------------------------------------------------------------------------------------------------	
	
	$iquery = "
	select eorder_repairrework_defectcode,ord_code as ord_code,
	eorderid as eorderid,ord_cus_id,ord_typeofwork,

`eorder_repairrework_problem`, `eorder_repairrework_repair`, `eorder_repairrework_rework`, `eorder_repairrework_detectby`, `eorder_repairrework_supervisor`, `eorder_repairrework_remark`,


	

	DATE_FORMAT(eorder_repairrework_date,'%d/%m/%y') as eorder_repairrework_date,



	 ";
	 

	$iquery .= " 1 ";
	
	$cquery = "select count(*) as countrow ";
	
	
	$query = "from 
		(select * from eorder,eorder_repairrework
			where 
				eorder_id = eorderid 
	";

	if($iscountry){
		$query  .= " and ord_cache_cnt_id = $country ";
	}

	if($istype){
		switch($type){
			case 'F': $query  .= " and ord_cache_type = 'FIX' "; break;
			case 'R': $query  .= " and ord_cache_type = 'REMOVE' "; break;
			case 'O': $query  .= " and ord_cache_type = 'ORTHO' "; break;
			case 'M': $query  .= " and ord_cache_type = 'FIX,REMOVE' "; break;
		}
		
	}
	
	
	$query  .= " and DATE(eorder_repairrework_date) between  '$cyear-$cmonth-$cdate'  and  '$eyear-$emonth-$edate'";

	
	
	$query  .= ")as main ";



	$query .= "order by eorder_repairrework_defectcode,eorderid";
		


			
	$cquery.=$query;
	$query = $iquery.$query;
	//$data_order->Query("$cquery");
	//$totalrow = $data_order->Rs("countrow");
	$data_order->Query("$query");//Query("select * from ");
	//$data_order->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");

	
	
	
	/*-------------- optimize -------------------*/
	$data_tmp = new Csql();
	$data_tmp->Connect();
	
	$cache = array();
	$data_orderAr = array();
	
	while(!$data_order->EOF){
	
	
		$rowAr = $data_order->CurrentRowArray();
	
	
		$key = $rowAr['ord_cus_id'];
		if($cache['customer'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select customerid,cus_name,cus_prv_id,cus_cnt_id from customer where customerid = {$key} limit 0,1");
			$cache['customer'][$key] = $tmpRow;
		}
		$rowAr['customerid'] = $cache['customer'][$key]["customerid"];
		$rowAr['cus_name'] = $cache['customer'][$key]["cus_name"];
		$rowAr['cus_prv_id'] = $cache['customer'][$key]["cus_prv_id"];
		$rowAr['cus_cnt_id'] = $cache['customer'][$key]["cus_cnt_id"];
	
		$key = $rowAr['cus_cnt_id'];
		if($cache['country'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select cnt_name from country where countryid = {$key} limit 0,1");
			$cache['country'][$key] = $tmpRow;
		}
		$rowAr['cnt_name'] = $cache['country'][$key]["cnt_name"];
	
	
		$data_orderAr[] = $rowAr;
		$data_order->MoveNext();
	
	}
	/*-------------- optimize -------------------*/	
	
	
	
	
		
	//echo $query;
	//$page = 10;	
	if($output_type=='graph'){
		include("../report/repairlist_graph.php");
	}else{
		include("../report/repairlist.php");
	}

	
	//echo "[".$data_order->GetMaxID("eorder")."]";
?>