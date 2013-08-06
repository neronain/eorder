<? 
include_once("../core/default.php"); 
include_once("../order/inc_getstring.php"); 

	$method = $_GET["METHOD"];
	$filter = $_GET["filter"];

	$searchtype = $_GET["searchtype"];
	$type = $_GET["type"];
	$istype		 	= $_GET["selectTypeChkBox"];
	
	if($istype != 1){
		$type = "A";
	}
	
	$country = $_GET["country"];

	$order = $_GET["order"];
	$output = $_GET["output"];
	if(!isset($output))$output = "web";
	
	
	
	
	$iscountry 		= $_GET["CountryChkBox"];
	
	$keyword = trim($_GET["keyword"]);
	

	$cdate 		= $_GET["exdate_day"];
	$cmonth 	= $_GET["exdate_month"];
	$cyear 		= $_GET["exdate_year"];

	$edate 		= $_GET["endate_day"];
	$emonth 	= $_GET["endate_month"];
	$eyear 		= $_GET["endate_year"];

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
	
	$iquery = "select ord_code as ord_code,
	eorderid as eorderid,ord_typeofwork, 
	ord_cus_id,ord_doc_id,ord_patientname,ord_shipmethod,
	
	DATE_FORMAT(ord_date,'%d/%m') as ord_datel,ord_date as ord_date,

	DATE_FORMAT(ord_releasedate,'%e') as ord_releasedated,
	DATE_FORMAT(ord_releasedate,'%m') as ord_releasedatem,
	DATE_FORMAT(ord_releasedate,'%Y') as ord_releasedatey,

	DATE_FORMAT(ord_arrivedate,'%e') as ord_arrivedated,
	DATE_FORMAT(ord_arrivedate,'%m') as ord_arrivedatem,
	DATE_FORMAT(ord_arrivedate,'%Y') as ord_arrivedatey,

	DATE_FORMAT(ord_releasedate,'%d/%m/%y') as exdate,
	DATE_FORMAT(ord_deliverydate,'%d/%m %H:%i') as deliverydate,
	

	DATE_FORMAT(ord_arrivedate,'%d/%m') as endate,
	DATE_FORMAT(ord_arrivedate,'%d/%m/%y') as endatel,

	DATE_FORMAT(ord_docdate,'%d/%m %H:%i') as docdate,
	DATE_FORMAT(ord_docdate,'%Y') as docdateYear,

		
	 ";
	 
		//if($type=="M" || $type=="F"|| $type=="A"){
//			$iquery .= " eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
//								ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation,";
			//$iquery .= " eorder_fixid,ordf_alloy,";
		//}	 
		//if($type=="M" || $type=="R"|| $type=="A"){
		//	$iquery .= " eorder_removeid,ordr_typeofworkt, ";
		//}
		//if($type=="M" || $type=="O"|| $type=="A"){
		//	$iquery .= " eorder_orthoid,ordo_method,ordo_typeofworkt,ordo_shade,ordo_observation, ";
		//}	 
	  //*/
	 $iquery .= " 1 ";
	
	$cquery = "select count(*) as countrow ";
	$oquery = "";
	
	//$query = "from 
	//	(select * from eorder,customer,doctor,province,country
	//	where ord_cus_id = customerid and ord_doc_id = doctorid and cus_prv_id = provinceid and cus_cnt_id = countryid ";
	
	
	
	if($iscountry){
		$query = "from eorder where ";
		if($country==1){
			$query .=" ord_cache_cnt_id in (0,1)";
		}else{
			$query .=" ord_cache_cnt_id = $country ";
		}
	}else{
		$query = "from eorder where TRUE ";
	}
	
	if($searchtype=="date"){
	
		if($order=="arrive"){
			$query  .= " and ord_arrivedate between  '$cyear-$cmonth-$cdate'  and  '$eyear-$emonth-$edate'";
		}else{
			$query  .= " and ord_releasedate between  '$cyear-$cmonth-$cdate'  and  '$eyear-$emonth-$edate'";
		}
		
	
		
		if($istype){
			switch($type){
				case 'F': $query  .= " and ord_cache_type = 'FIX' "; break;
				case 'R': $query  .= " and ord_cache_type = 'REMOVE' "; break;
				case 'O': $query  .= " and ord_cache_type = 'ORTHO' "; break;
				case 'M': $query  .= " and ord_cache_type = 'FIX,REMOVE' "; break;
			}
		
		}
		
		/*
		
		if($type=="M"){
			$query  .= "  and
				ord_typeofwork like '%F:{%'  and ( ord_typeofwork like '%R:{%'  or ord_typeofwork like '%O:{%' ) or
				ord_typeofwork like '%R:{%'  and ( ord_typeofwork like '%F:{%'  or ord_typeofwork like '%O:{%' ) or
				ord_typeofwork like '%O:{%'  and ( ord_typeofwork like '%F:{%'  or ord_typeofwork like '%R:{%' )
				";
		}else if($type=="F"){
			$query  .= "  and
				ord_typeofwork like '%F:{%'  and NOT ( ord_typeofwork like '%R:{%'  or ord_typeofwork like '%O:{%' )";
		}else if($type=="R"){
			$query  .= "  and
				ord_typeofwork like '%R:{%'  and NOT ( ord_typeofwork like '%F:{%'  or ord_typeofwork like '%O:{%' )";
		}else if($type=="O"){
			$query  .= "  and
				ord_typeofwork like '%O:{%'  and NOT ( ord_typeofwork like '%F:{%'  or ord_typeofwork like '%R:{%' )";
		}*/
		
		//$query  .= ")as main ";
		
		//$query .= " left join	(select eorder_fixid,ordf_alloy from eorder_fix)as efix on eorderid = eorder_fixid ";
		
		/*
		if($type=="M"){
			$query .= " left join	(select * from eorder_fix)as efix on eorderid = eorder_fixid ";
			$query .= " left join	(select * from eorder_remove)as eremove on eorderid = eorder_removeid ";
			$query .= " left join	(select * from eorder_ortho)as eortho on eorderid = eorder_orthoid  
					having  
					(
					(not isnull(eorder_fixid) and not isnull(eorder_removeid))
					or
					(not isnull(eorder_fixid) and not isnull(eorder_orthoid))
					or
					(not isnull(eorder_removeid) and not isnull(eorder_orthoid))
					or
					isnull(eorder_fixid) and  isnull(eorder_removeid) and  isnull(eorder_orthoid)
					)
					
					";

		
				
		}else if($type=="F"){
			$query .= " inner join	(select * from eorder_fix)as efix on eorderid = eorder_fixid ";
			$query .= " left join	(select * from eorder_remove)as eremove on eorderid = eorder_removeid ";
			$query .= " left join	(select * from eorder_ortho)as eortho on eorderid = eorder_orthoid  
								having  isnull(eorder_removeid)  and  isnull(eorder_orthoid)";
		}else if($type=="R"){
			$query .= " inner join	(select * from eorder_remove)as eremove on eorderid = eorder_removeid ";
			$query .= " left join	(select * from eorder_fix)as efix on eorderid = eorder_fixid  ";
			$query .= " left join	(select * from eorder_ortho)as eortho on eorderid = eorder_orthoid  
								having  isnull(eorder_fixid) and  isnull(eorder_orthoid)";
		}else if($type=="O"){
			$query .= " inner join	(select * from eorder_ortho)as eortho on eorderid = eorder_orthoid  ";
			$query .= " left join	(select * from eorder_remove)as eremove on eorderid = eorder_removeid ";
			$query .= " left join	(select * from eorder_fix)as efix on eorderid = eorder_fixid  
								having  isnull(eorder_fixid) and  isnull(eorder_removeid)";
		}else if($type=="A"){
			$query .= " left join	(select * from eorder_fix)as efix on eorderid = eorder_fixid ";
			$query .= " left join	(select * from eorder_remove)as eremove on eorderid = eorder_removeid ";
			$query .= " left join	(select * from eorder_ortho)as eortho on eorderid = eorder_orthoid  ";
		}//*/

			
	}else if($searchtype=="typeofwork"){
		$query  .= " and (DATE(ord_releasedate) between '$cyear-$cmonth-$cdate' 
							and '$eyear-$emonth-$edate'  ) )as main ";
		$query  .= " where ord_typeofwork like '%".$keyword."%' ";
/*
			$query .= " left join	(select * from eorder_fix)as efix on eorderid = eorder_fixid ";
			$query .= " left join	(select * from eorder_remove)as eremove on eorderid = eorder_removeid ";
			$query .= " left join	(select * from eorder_ortho)as eortho on eorderid = eorder_orthoid  
					having  
					ordf_typeofworkt like '%".$keyword."%' or
					ordr_typeofworkt like '%".$keyword."%' or
					ordo_typeofworkt like '%".$keyword."%' 
					
					"; //*/
	}

	if($searchtype=="date"){
		if($order=="arrive"){
			//$oquery = " order by DATE(ord_arrivedate),countryid,cus_name,doc_name";
			$oquery = " order by DATE(ord_arrivedate),left(ord_code,6),ord_doc_id";
		}else{
			//$oquery = " order by DATE(ord_releasedate),countryid,cus_name,doc_name";
			$oquery = " order by DATE(ord_releasedate),left(ord_code,6),ord_doc_id";
		}
	}
	
	
	
	
	
	
	$cquery.=$query;
	$query = $iquery.$query.$oquery;
	//$data_order->Query("$cquery");
	//$totalrow = $data_order->Rs("countrow");
	//echo $query;
	$data_order->Query("$query");//Query("select * from ");
	//$data_order->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
		/* 
		
		
		
		
		
		
		//*/
		
	
	
	
	/*-------------- optimize -------------------*/
	$data_tmp = new Csql();
	$data_tmp->Connect();
	
	$cache = array();
	$data_orderAr = array();
	
	while(!$data_order->EOF){
		
		
		$rowAr = $data_order->CurrentRowArray();
		
		
		$tmpRow = $data_tmp->ExecuteARecord("select eorder_fixid,ordf_alloy from eorder_fix where eorder_fixid = {$rowAr['eorderid']} limit 0,1");
		$rowAr['eorder_fixid'] = $tmpRow["eorder_fixid"];
		$rowAr['ordf_alloy'] = $tmpRow["ordf_alloy"];
		
	
		$key = $rowAr['ord_cus_id'];
		if($cache['customer'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select customerid,cus_name,cus_prv_id,cus_cnt_id from customer where customerid = {$key} limit 0,1");
			$cache['customer'][$key] = $tmpRow;
		}
		
		$rowAr['customerid'] = $cache['customer'][$key]["customerid"];
		$rowAr['cus_name'] = $cache['customer'][$key]["cus_name"];
		$rowAr['cus_prv_id'] = $cache['customer'][$key]["cus_prv_id"];
		$rowAr['cus_cnt_id'] = $cache['customer'][$key]["cus_cnt_id"];
	
		$key = $rowAr['ord_doc_id'];
		if($cache['doctor'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select doc_name from doctor where doctorid = {$key} limit 0,1");
			$cache['doctor'][$key] = $tmpRow;
		}
		$rowAr['doc_name'] = $cache['doctor'][$key]["doc_name"];
	
		$key = $rowAr['cus_prv_id'];
		if($cache['province'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select prv_name from province where provinceid = {$key} limit 0,1");
			$cache['province'][$key] = $tmpRow;
		}
		$rowAr['prv_name'] = $cache['province'][$key]["prv_name"];		
		
		
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
	if($output=='web'){
		include("../report/summarylist.php");
	}else if($output=='excel'){
		include("../report/summarylist_excel.php");
	}
	
	//echo "[".$data_order->GetMaxID("eorder")."]";
?>
