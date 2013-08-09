<? include_once("../core/default.php"); ?>
<?
	$data_order = new CSql();
 	$err =	$data_order->Connect();
	
	$edate = $_GET["edate"];
	
	$cdate 		= substr($edate,8,2);
	$cmonth 	= substr($edate,5,2);
	$cyear 		= substr($edate,0,4);
//-----------------------------------------------------------------------------------------------------------------------------------	
// Clear	
	
//	$data_order->Execute("delete eordertoday from eordertoday 
//	where  DATEDIFF(CURDATE(),ordt_releasedate)>7 and ordt_isship=TRUE");
	
	
	
	
	
//-----------------------------------------------------------------------------------------------------------------------------------	
	
	$iquery = "select ordt_code as ord_code,ordt_patientname as ord_patientname,
	eordertodayid as eorderid,ordt_isship,ordt_isdone,
	ordt_cus_id as ord_cus_id,ordt_doc_id as ord_doc_id,ordt_shipmethod as ord_shipmethod,
	
	DATE_FORMAT(ordt_date,'%d/%m') as ord_datel,ordt_date as ord_date,
	DATE_FORMAT(ordt_releasedate,'%e') as ord_releasedated,
	DATE_FORMAT(ordt_releasedate,'%m') as ord_releasedatem,
	DATE_FORMAT(ordt_releasedate,'%Y') as ord_releasedatey,
	DATE_FORMAT(ordt_releasedate,'%d/%m/%y') as exdate,
	DATE_FORMAT(ordt_docdate,'%d/%m %k:%i') as docdate,
	DATE_FORMAT(ordt_docdate,'%Y') as docdateYear,

	ordt_typeofwork , ";
	 
		//if($type=="M" || $type=="F"){
		/*	$iquery .= " eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
								ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation,
								
								 logt_ord_id,stf_code,sec_room,logt_type,logt_date,staffid,
		logt_datef,	logt_dated,
								";*/
		//}	 
		//if($type=="M" || $type=="R"){
			//$iquery .= " eorder_removeid,ordr_method,ordr_typeofworkt,ordr_shade,ordr_observation, ";
			//$iquery .= " eorder_orthoid,ordo_method,ordo_typeofworkt,ordo_shade,ordo_observation, ";
		//}	 
	 
	 $iquery .= " 1 ";
	 
	//$cquery = "select count(*) as countrow ";
	
	
	$query = "from eordertoday
		where  ";

		$query  .= " DATE(ordt_releasedate)='$edate' and ordt_isdone=FALSE ";

		


		//$query .= " left join	(select * from eorder_fix)as efix on eordertodayid = eorder_fixid ";
				
		//$query .= " left join	(select * from eorder_remove)as eremove on eordertodayid = eorder_removeid ";
		//$query .= " left join	(select * from eorder_ortho)as eortho on eordertodayid = eorder_orthoid  ";

		$oquery = " order by DATE(ordt_releasedate),ord_cus_id,ord_doc_id,eordertodayid";
		
				
			
	$cquery.=$query;
	$query = $iquery.$query.$oquery;
	//$data_order->Query("$cquery");
	//$totalrow = $data_order->Rs("countrow");
	$data_order->Query("$query");//Query("select * from ");
	//echo $query;
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
	include("../order/orderexportlist.php");
	
	//echo "[".$data_order->GetMaxID("eorder")."]";
?>
