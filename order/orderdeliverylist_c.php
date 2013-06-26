<? include_once("../core/default.php"); ?>
<?
	$method = $_GET["METHOD"];
	$filter = $_GET["filter"];

	$searchtype = $_GET["searchtype"];
	$type = $_GET["type"];
	$istype		 	= $_GET["selectTypeChkBox"];
	
	if($istype != 1){
		$type = "A";
	}
	
	$country = $_GET["country"];
	
	
	
	
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
	
//	$data_order->Execute("delete eordertoday from eordertoday 
//	where  DATEDIFF(CURDATE(),ordt_deliverydate)>7 and ordt_isship=TRUE");
	
	
	
	
	
//-----------------------------------------------------------------------------------------------------------------------------------	
	
	$iquery = "select ordt_code as ord_code,ordt_no as ord_no,ordt_patientname as ord_patientname,
	eordertodayid as eorderid,ordt_isship,ordt_isdone,
	ordt_cus_id as ord_cus_id,ordt_doc_id as ord_doc_id,ordt_agn_id as ord_agn_id,
	
	DATE_FORMAT(ordt_arrivedate,'%d/%m') as ord_datel,ordt_date as ord_date,
	DATE_FORMAT(ordt_deliverydate,'%e') as ord_deliverydated,
	DATE_FORMAT(ordt_deliverydate,'%m') as ord_deliverydatem,
	DATE_FORMAT(ordt_deliverydate,'%Y') as ord_deliverydatey,
	DATE_FORMAT(ordt_deliverydate,'%d/%m/%y') as exdate,
	DATE_FORMAT(ordt_docdate,'%d/%m %H:%i') as docdate,
	DATE_FORMAT(ordt_docdate,'%Y') as docdateYear,



	ordt_typeofwork , ";
	
	
	 //$iquery .= " eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
	//							ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation,";
	 /*
		if($type=="M" || $type=="F"|| $type=="A"){
			$iquery .= " eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
								ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation,";
		}	 
		if($type=="M" || $type=="R"|| $type=="A"){
			$iquery .= " eorder_removeid,ordr_method,ordr_typeofworkt,ordr_shade,ordr_observation, ";
		}
		if($type=="M" || $type=="O"|| $type=="A"){
			$iquery .= " eorder_orthoid,ordo_method,ordo_typeofworkt,ordo_shade,ordo_observation, ";
		}	 
	  //*/
	 $iquery .= " 1 ";
	
	$cquery = "select count(*) as countrow ";
	
	
	if($iscountry == 1){
		$query = "from eordertoday where ";
		if($country==1){
			$query .=" ordt_cache_cnt_id in (0,1) ";
		}else{
			$query .=" ordt_cache_cnt_id = $country ";
		}
	}else{
		$query = "from eordertoday where TRUE ";
	}
	if($searchtype=="date"){
		$query  .= " and DATE(ordt_deliverydate) =  '$cyear-$cmonth-$cdate' ";
		
		
	
		//$query  .= ")as main ";
		
		if($istype){
			switch($type){
				case 'F': $query  .= " and ordt_cache_type = 'FIX' "; break;
				case 'R': $query  .= " and ordt_cache_type = 'REMOVE' "; break;
				case 'O': $query  .= " and ordt_cache_type = 'ORTHO' "; break;
				case 'M': $query  .= " and ordt_cache_type = 'FIX,REMOVE' "; break;
			}
		
		}
		/*
		
		if($type=="M"){
			$query  .= "  and
				ordt_typeofwork like '%F:{%'  and ( ordt_typeofwork like '%R:{%'  or ordt_typeofwork like '%O:{%' ) or
				ordt_typeofwork like '%R:{%'  and ( ordt_typeofwork like '%F:{%'  or ordt_typeofwork like '%O:{%' ) or
				ordt_typeofwork like '%O:{%'  and ( ordt_typeofwork like '%F:{%'  or ordt_typeofwork like '%R:{%' )
				";
		}else if($type=="F"){
			$query  .= "  and
				ordt_typeofwork like '%F:{%'  and NOT ( ordt_typeofwork like '%R:{%'  or ordt_typeofwork like '%O:{%' )";
		}else if($type=="R"){
			$query  .= "  and
				ordt_typeofwork like '%R:{%'  and NOT ( ordt_typeofwork like '%F:{%'  or ordt_typeofwork like '%O:{%' )";
		}else if($type=="O"){
			$query  .= "  and
				ordt_typeofwork like '%O:{%'  and NOT ( ordt_typeofwork like '%F:{%'  or ordt_typeofwork like '%R:{%' )";
		}
		*/
		
		
		/*		
		if($type=="M"){
			$query .= " left join	(select * from eorder_fix)as efix on eordertodayid = eorder_fixid ";
			$query .= " left join	(select * from eorder_remove)as eremove on eordertodayid = eorder_removeid ";
			$query .= " left join	(select * from eorder_ortho)as eortho on eordertodayid = eorder_orthoid  
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
			$query .= " inner join	(select * from eorder_fix)as efix on eordertodayid = eorder_fixid ";
			$query .= " left join	(select * from eorder_remove)as eremove on eordertodayid = eorder_removeid ";
			$query .= " left join	(select * from eorder_ortho)as eortho on eordertodayid = eorder_orthoid  
								having  isnull(eorder_removeid)  and  isnull(eorder_orthoid)";
		}else if($type=="R"){
			$query .= " inner join	(select * from eorder_remove)as eremove on eordertodayid = eorder_removeid ";
			$query .= " left join	(select * from eorder_fix)as efix on eordertodayid = eorder_fixid  ";
			$query .= " left join	(select * from eorder_ortho)as eortho on eordertodayid = eorder_orthoid  
								having  isnull(eorder_fixid) and  isnull(eorder_orthoid)";
		}else if($type=="O"){
			$query .= " inner join	(select * from eorder_ortho)as eortho on eordertodayid = eorder_orthoid  ";
			$query .= " left join	(select * from eorder_remove)as eremove on eordertodayid = eorder_removeid ";
			$query .= " left join	(select * from eorder_fix)as efix on eordertodayid = eorder_fixid  
								having  isnull(eorder_fixid) and  isnull(eorder_removeid)";
		}else if($type=="A"){
			$query .= " left join	(select * from eorder_fix)as efix on eordertodayid = eorder_fixid ";
			$query .= " left join	(select * from eorder_remove)as eremove on eordertodayid = eorder_removeid ";
			$query .= " left join	(select * from eorder_ortho)as eortho on eordertodayid = eorder_orthoid  ";
		}//*/

		$oquery = " order by DATE(ordt_deliverydate),ord_cus_id,ord_doc_id,eordertodayid";
		
				
	}else if($searchtype=="typeofwork"){
		$query  .= " and (DATE(ordt_deliverydate) between '$cyear-$cmonth-$cdate' 
							and '$eyear-$emonth-$edate'  ) )as main ";
		$query  .= " where ordt_typeofwork like '%".$keyword."%' ";
/*
			$query .= " left join	(select * from eorder_fix)as efix on eordertodayid = eorder_fixid ";
			$query .= " left join	(select * from eorder_remove)as eremove on eordertodayid = eorder_removeid ";
			$query .= " left join	(select * from eorder_ortho)as eortho on eordertodayid = eorder_orthoid  
					having  
					ordf_typeofworkt like '%".$keyword."%' or
					ordr_typeofworkt like '%".$keyword."%' or
					ordo_typeofworkt like '%".$keyword."%' 
					
					"; //*/
	}

			
	$cquery.=$query;
	$query = $iquery.$query.$oquery;
	//$data_order->Query("$cquery");
	//$totalrow = $data_order->Rs("countrow");
	$data_order->Query("$query");//Query("select * from ");
	//$data_order->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
		/* 
		
		
			 =
		
		//*/

	/*-------------- optimize -------------------*/
	$data_tmp = new Csql();
	$data_tmp->Connect();
	
	$cache = array();
	$data_orderAr = array();
	
	while(!$data_order->EOF){
	
	
		$rowAr = $data_order->CurrentRowArray();
	
	
		$iquery .= " eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
		ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation,
	
		logt_ord_id,stf_code,sec_room,logt_type,logt_date,staffid,
		logt_datef,	logt_dated,
		";
		$tmpRow = $data_tmp->ExecuteARecord("select eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
				ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation from eorder_fix where eorder_fixid = {$rowAr['eorderid']} limit 0,1");
		if($tmpRow!=NULL){
			$rowAr = array_merge($rowAr, $tmpRow);
		}
		
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
		
		
		$key = $rowAr['ord_agn_id'];
		if($cache['agent'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select agn_name from agent where agentid = {$key} limit 0,1");
			$cache['agent'][$key] = $tmpRow;
		}
		$rowAr['agn_name'] = $cache['agent'][$key]["agn_name"];
		
		
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
		
		
		$data_logbook = new Csql();
		$data_logbook->Connect();
		$data_logbook->Query("select logt_ord_id,logt_type,logt_date,
		DATE_FORMAT(logt_date,'%d/%m %H:%i') as logt_datef,
		DATEDIFF(CURDATE(),logt_date) as logt_dated,
		logt_stf_id,logt_sec_id
		
		
		from	logbooktoday where logt_ord_id = {$rowAr['eorderid']} order by logt_date desc");
		while(!$data_logbook->EOF){
			$rowAr2 =  $data_logbook->CurrentRowArray();
			
			
			$key = $data_logbook->Rs('logt_stf_id');
			
			if($cache['staff'][$key]==NULL){
				$tmpRow = $data_tmp->ExecuteARecord("select staffid,stf_name,stf_code from staff where staffid = {$key} limit 0,1");
				$cache['staff'][$key] = $tmpRow;
			}
			if($cache['staff'][$key]!=NULL){
				$rowAr2 = array_merge($rowAr2, $cache['staff'][$key]);
			}
		
			$key = $data_logbook->Rs('logt_sec_id');
			if($cache['section'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select sec_room from section where sectionid = {$key} limit 0,1");
				$cache['section'][$key] = $tmpRow;
			}
			if($cache['section'][$key]!=NULL){
				$rowAr2 = array_merge($rowAr2, $cache['section'][$key]);
			}
		
			$rowAr['current_status'][] = $rowAr2;
			$data_logbook->MoveNext();
		}
		/*
		* logt_ord_id,stf_code,sec_room,logt_type,logt_date,staffid,
		logt_datef,	logt_dated
		*
		$query .= "
		left join (select logt_ord_id,stf_code,sec_room,logt_type,logt_date,staffid,
				DATE_FORMAT(logt_date,'%d/%m %H:%i') as logt_datef,
				DATEDIFF(CURDATE(),logt_date) as logt_dated
	
	
				from	logbooktoday,section,staff where
				logt_stf_id = staffid and logt_sec_id = sectionid
		) as logbooktoday on logt_ord_id = eordertodayid  ";
	
		*/
	
	
		$data_orderAr[] = $rowAr;
		$data_order->MoveNext();
	
	}
	/*-------------- optimize -------------------*/	
	
	//echo $query;
	//$page = 10;	

	include("../order/orderdeliverylist.php");
	
	//echo "[".$data_order->GetMaxID("eorder")."]";
?>