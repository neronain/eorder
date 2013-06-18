<?
	include_once("../core/default.php"); 
// IN
	$barcode 	= $_POST["barcode"];	
	$method 	= $_POST["METHOD"];	
	$step 		= $_POST["STEP"]+0;	
	$eorderid 	= $_POST["eorderid"]+0;	
	$filterroom 	= $_COOKIE["filterroom"];	
	$logbookid = $_POST["logbookid"];
	$section = $_POST["section"];
	
//DEFINE
	define("S_WAITORDER", 0);	
	define("S_WAITSTAFF", 1);	
	define("S_CHECKDB", 2);	
	define("S_CHECKTYPE", 3);	
	define("S_LOGOUT", 4);	
	define("S_LOGIN", 5);	
	define("S_CHECKSTAFF", 6);	
	define("S_DEFECTCODE", 7);	
	$enablefilter = false;
	if(!isset($filterroom)){$filterroom='';}
	

// VALIDATE		
/*
	if(!isset($_COOKIE["staffsection"])){
		gotourl("../staff/index.php");
		exit();
	}
	*/
	$barcode = strtoupper($barcode);
	$barcode = trim($barcode);
	
// INIT
	$data_logbook = new Csql();
	$data_logbook->Connect();

	//$sectionid = $_COOKIE["staffsection"];
	//$revalue = $data_logbook->PassValue("section","sectionid=$sectionid",array("sec_room"));
	
	//$sectionname = $revalue['sec_room'];

	$data_section = new Csql();
	$data_section->Query("select * from section order by sec_type,sec_room");

// Start Code
	$msg = 'สแกนหมายเลข E-Order &gt;&gt;';
	if(isset($method)){
	
	
		/*if($method=="DELETE"){
			if(isset($logbookid)){
				$data_logbook->Execute("delete logbook from logbook where logbookid=$logbookid");
			}
		}else	// */
		if($method=="UPDATE"){
			$filterroom='';
			if(isset($section)){
				$data_section->MoveFirst();
				$filterroom = convertToString($section);
				$data_section->MoveFirst();
			}
			setcookie("filterroom","$filterroom",0,'/');
			
			
			$enablefilter = false;
			
		}else	if($method=="OPTION"){
			$enablefilter = true;
		}else	if($method=="OK"){
			do{
				switch($step){
					case S_WAITORDER:
						if(strlen($barcode)>0 && substr($barcode,0,1)=='E'){
							$step = S_CHECKDB;
						}else{
							$step = S_WAITORDER;						
							$msg = 'Insert E-Order code &gt;&gt;';
						}
						break;
					case S_WAITSTAFF:
						if(strlen($barcode)>0 && substr($barcode,0,1)=='E'){
							$step = S_CHECKDB;
						}else if(strlen($barcode)>0){
							$step = S_CHECKSTAFF;
						}else{
							$msg = '<font color="#FF0000">หมายเลข staff ผิดพลาด!!</font>
								<script>setTimeout("writeit(\'messageBig\',\'สแกนหมายเลข Staff &gt;&gt;\')",4000);</script>
								';
							$step = S_WAITSTAFF;
						}
						break;
					case S_CHECKDB:
						$validatePass = false;
						$eorderid = 0;
						$data_logbook->Query("select eordertodayid from eordertoday
							where ordt_code='$barcode' limit 0,1");
						if($data_logbook->Count()>0){
							$eorderid 	= $data_logbook->Rs("eordertodayid");
						}
						$maxdate = 0;
						if($eorderid>0){
							$data_logbook->Query("select max(logt_date) as maxdate from logbooktoday where logt_ord_id = $eorderid");
							if($data_logbook->Count()>0){
								$maxdate = $data_logbook->Rs("maxdate");
							}
						}
						if($maxdate>0){
							$data_logbook->Query("select * from logbooktoday,staff
								where 
								logt_ord_id = $eorderid and 
								logt_date = '$maxdate' and 
								logt_stf_id=staffid 
								limit 0,1");
							$validatePass=true;
						}
						if($validatePass && $data_logbook->Count()>0){
							$step = S_CHECKTYPE;
							//$eorderid 	= $data_logbook->Rs("eordertodayid");
							$type 		= $data_logbook->Rs("logt_type");
							$staffid		= $data_logbook->Rs("logt_stf_id");
							$staffname	= $data_logbook->Rs("stf_name");
							$sectionid	= $data_logbook->Rs("logt_sec_id");
						}else{
							$data_logbook->Query("select eordertodayid from eordertoday
								where ordt_code='$barcode' limit 0,1");
							if($data_logbook->Count()>0){
								$eorderid 	= $data_logbook->Rs("eordertodayid");
								$step = S_WAITSTAFF;
								$msg = 'Insert "Staff-Code" &gt;&gt;';
								

								
								
							}else{
								// check eorder in eorder table
								$data_logbook->Query("select eorderid from eorder
									where ord_code='$barcode' limit 0,1");
								if($data_logbook->Count()>0){
									$eorderid 	= $data_logbook->Rs("eorderid");
									// insert data to eordertoday
									$data_logbook->Execute("insert into eordertoday
										(eordertodayid, ordt_code, ordt_doc_id, ordt_patientname, 
										ordt_cus_id, ordt_date, ordt_arrivedate, ordt_releasedate, ordt_docdate,ordt_priority, 
										ordt_status, ordt_operateday, ordt_detail, ordt_remark, ordt_isship,ordt_typeofwork) 
				
				 						select 
										 eorderid, ord_code, ord_doc_id, ord_patientname, 
										 ord_cus_id, ord_date, ord_arrivedate,ord_releasedate, ord_docdate,ord_priority, 
										 ord_status, ord_operateday, ord_detail, ord_remark,0 ,ord_typeofwork 
				 						from eorder where eorderid = $eorderid ");
									$step = S_WAITSTAFF;
									$msg = 'Insert "Staff-Code" &gt;&gt;';
								}else{
							
									$step = S_WAITORDER;
									$msg = '<font color="#FF0000">หมายเลข eorder ผิดพลาด</font>
									<script>
									setTimeout("writeit(\'messageBig\',\'สแกนหมายเลข E-Order &gt;&gt;\')",4000);
									</script>
									';
								}
							}
						}
						break;
					case S_CHECKTYPE:
						if($type=="IN"){
							$step = S_LOGOUT;
						}else{
							$step = S_WAITSTAFF;
							$msg = 'Insert Staff-Code &gt;&gt;';
						}
						break;
					case S_CHECKSTAFF:
						$data_logbook->Query("select * from staff
								where stf_code='$barcode' limit 0,1");
						if($data_logbook->Count()>0){
							$staffid=$data_logbook->Rs("staffid");
							$sectionid=$data_logbook->Rs("stf_sec_id");
							$staffname=$data_logbook->Rs("stf_name");

							$step = S_LOGIN;
						}else{
							$msg = '<font color="#FF0000">หมายเลข staff ผิดพลาด!!</font>
								<script>setTimeout("writeit(\'messageBig\',\'สแกนหมายเลข Staff &gt;&gt;\')",4000);</script>
								';
							$step = S_WAITSTAFF;
						}
						break;
					case S_LOGOUT:
						if($eorderid==0){$step = S_WAITORDER;$msg = '<font color="#FF0000">No E-order code</font>';break;}
						
						$data_logbook->Addnew();
						$data_logbook->TableName = "logbook";
						$data_logbook->Set("log_ord_id","$eorderid");
						$data_logbook->Set("log_stf_id","$staffid");
						$data_logbook->Set("log_sec_id","$sectionid");
						$data_logbook->Set("log_type","'OUT'");
						$data_logbook->Set("log_date","NOW()");
						$data_logbook->Update();
						
						$data_logbook->Query("select max(logbookid) as maxlog from logbook
							where log_ord_id=$eorderid and log_stf_id=$staffid and 
							log_sec_id=$sectionid and log_type='OUT'");
						$maxlog = $data_logbook->Rs("maxlog");
						$data_logbook->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");
						 						
						$data_logbook->Execute(" delete  logbookworking from logbookworking where logw_ord_id = $eorderid");
				
						include("logwarning.php");
/*
						$pos = strpos($filterroom,','.$sectionid.',');
						if($pos == false){
							$pos = strpos($filterroom,''.$sectionid.',');
							if($pos == false){
								$pos = strpos($filterroom,','.$sectionid.'');
								if($pos == false){
									$filterroom = strlen($filterroom)>0?$filterroom.','.$sectionid:$filterroom=''.$sectionid;
									setcookie("filterroom","$filterroom",0,'/');
								}
							}
						}

*/

						$step = S_WAITORDER;
						$msg = '<font color="#3399FF">'.$staffname. ' log out <br>'.$barcode.' เรียบร้อยแล้ว </font>';
						break;
					case S_LOGIN:

						if($eorderid==0){$step = S_WAITORDER;$msg = 'กรุณาใส่หมายเลข E-order';break;}
						$data_logbook->Addnew();
						$data_logbook->TableName = "logbook";
						$data_logbook->Set("log_ord_id","$eorderid");
						$data_logbook->Set("log_stf_id","$staffid");
						$data_logbook->Set("log_sec_id","$sectionid");
						$data_logbook->Set("log_type","'IN'");
						$data_logbook->Set("log_date","NOW()");
						$data_logbook->Update();
					
						$data_logbook->Query("select max(logbookid) as maxlog from logbook
							where log_ord_id=$eorderid and log_stf_id=$staffid and 
							log_sec_id=$sectionid and log_type='IN'");
						$maxlog = $data_logbook->Rs("maxlog");
						$data_logbook->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");
						 						
						$data_logbook->Execute(" delete  logbookworking from logbookworking where logw_ord_id = $eorderid");


						$data_logbook->Execute("update eorder set ord_status=3,
										ord_date = NOW(),ord_processdate = NOW()
										where eorderid = $eorderid and ord_status=2");

						
						if($sectionid==36){
							$data_logbook->Execute("update eordertoday set ordt_isdone=TRUE 
										where eordertodayid = $eorderid");
						}//*/

						$data_logbook->Addnew();
						$data_logbook->TableName = "logbookworking";
						$data_logbook->Set("logw_ord_id","$eorderid");
						$data_logbook->Set("logw_stf_id","$staffid");
						$data_logbook->Set("logw_sec_id","$sectionid");
						$data_logbook->Set("logw_date","NOW()");
						$data_logbook->Update();


						$pos = strpos($filterroom,','.$sectionid.',');
						if($pos == false){
							$pos = strpos($filterroom,''.$sectionid.',');
							if($pos == false){
								$pos = strpos($filterroom,','.$sectionid.'');
								if($pos == false){
									$filterroom = strlen($filterroom)>0?$filterroom.','.$sectionid:$filterroom=''.$sectionid;
									setcookie("filterroom","$filterroom",0,'/');
								}
							}
						}
		
					
					
						$step = S_WAITORDER;
						$msg = '<font color="#FFFFFF">'.$staffname.' log in <br>'.$barcode.' เรียบร้อยแล้ว</font>';
						break;
						
						
				
					case S_DEFECTCODE:
						$rwdata->Addnew();
						$rwdata->TableName = "eorder_repairrework";
						$rwdata->Set("eorder_id","'$eorder_id'");
						$rwdata->Set("eorder_repairrework_date","'$date'");
						$rwdata->Set("eorder_repairrework_defectcode","'$defectcode'");
						$rwdata->Set("eorder_repairrework_stf_id","'$stf_id'");
						$rwdata->Set("eorder_repairrework_section_id","'$sec_id'");
						$rwdata->Set("eorder_repairrework_problem","'$problem'");
						$rwdata->Set("eorder_repairrework_repair","'$repair'");
						$rwdata->Set("eorder_repairrework_rework","'$rework'");
						$rwdata->Set("eorder_repairrework_detectby","'$detectby'");
						$rwdata->Set("eorder_repairrework_supervisor","'$supervisor'");
						$rwdata->Set("eorder_repairrework_remark","'$remark'");
						$rwdata->Update();
						break;
						
			
				}
			}while($step!=S_WAITORDER && $step!=S_WAITSTAFF);
		

		}

	}
	//echo ("fr $filterroom");
	/*$filtersql = '';	
	$filtersection = array();
	if(isset($filterroom) && strlen($filterroom)>0){
		$filterroomA = convertToArray($filterroom);
		foreach($filterroomA as $f){
			$filtersection[$f+0] = true;
			$filtersql.= " stf_sec_id = $f  or";
		}
		
	}
	$filtersql.= " FALSE ";*/
	//if(strlen($filtersql)==0)$filtersql = " FALSE ";
	/*
	$data_logbook->Query("select * from logbook,staff,eorder,section		where 
		log_stf_id=staffid and 
		log_ord_id=eorderid and
		log_sec_id=sectionid and 
		(
			DATE_FORMAT(log_date,'%Y%m%d') = DATE_FORMAT(NOW(),'%Y%m%d')
		)
		and 
		(
			".$filtersql."
		)
		
		
		order by DATE_FORMAT(log_date,'%Y%m%d') desc ,ord_code ,log_date"); //*/
	/*
	
	$data_logbook->Query("select * from 
	(select staffid,stf_name,stf_sec_id,sec_room 
	from staff,section where sectionid=stf_sec_id and ($filtersql)) as stf
	left join (
		select MAX(log_date) as log_date,eorderid,ord_code,log_stf_id,log_type  
		from logbook,eorder where eorderid=log_ord_id group by log_stf_id )as logb 
		on staffid = log_stf_id

	order by sec_room,DATE_FORMAT(log_date,'%Y%m%d') desc ,ord_code ,log_date");// */
	
	/*
	$data_logbook->Query("select logbookid,stf_name,sec_room,log_type,ord_code,eorderid,staffid,
	DATE_FORMAT(log_date,'%d/%m/%y %H:%i') as log_date
	
	 from 
	(select staffid,stf_name,stf_sec_id,sec_room,sec_type 
	from staff,section where sectionid=stf_sec_id and ($filtersql)) as stf
	left join (
		select max(log_date) as maxlog_date, log_stf_id as maxlog_stf_id from logbook group by log_stf_id  )as logbmax
		on staffid = maxlog_stf_id
	left join (
		select logbookid,log_date,eorderid,ord_code,log_stf_id,log_type  
		from logbook,eorder where eorderid=log_ord_id )as logb 
		on staffid = log_stf_id and log_date = maxlog_date

	order by sec_room,stf_name");//*/
/*

	$data_logbook->Query("select logbookid,stf_name,stf_code,sec_room,ord_code,eorderid,staffid,sectionid,
	DATE_FORMAT(log_date,'%d/%m %H:%i') as log_date,
	HOUR(TIMEDIFF(NOW(),log_date)) as log_longh,
	MINUTE(TIMEDIFF(NOW(),log_date)) as log_longm,
	countlog,ordt_typeofwork,
	TIME_TO_SEC(TIMEDIFF(ord_releasedate,NOW())) as islate,
	HOUR(TIMEDIFF(ord_releasedate,NOW())) as release_datehr,
	MINUTE(TIMEDIFF(ord_releasedate,NOW())) as release_datemn,
	log_date as orderlogdate

	
	 from 
	(select staffid,stf_name,stf_code,stf_sec_id,sec_room,sec_type,sectionid
	from staff,section where sectionid=stf_sec_id and ($filtersql)) as stf

	left join(
		select logt_sec_id as log_sec_id,count(logbooktodayid) as countlog from logbooktoday 
		where DATE(logt_date)  =  CURDATE() and logt_type='OUT'
		group by logt_sec_id
	)as counttoday on sectionid = log_sec_id 

	left join (
		select logbookworkingid as logbookid,logw_date as log_date,
		eordertodayid as eorderid,ordt_typeofwork as ordt_typeofwork,ordt_releasedate as ord_releasedate,ordt_code as ord_code,
		logw_stf_id as log_stf_id 
		from logbookworking,eordertoday where eordertodayid=logw_ord_id )as logb 
		on staffid = log_stf_id 

	order by sec_room,stf_name,orderlogdate");

	
	*/
	include ("../logbook/loginout.php");
?>
