<? include_once("../core/default.php"); ?>
<? include_once("../core/functooth.php"); ?>
<? include_once("../order/inc_getstring.php"); ?>
<? include_once("../order/inc_shade.php");
	include_once("../eorder/eorder_fix_config.php");
	include_once("../eorder/eorder_remove_config.php");

	
	GetVar($eorder_id,"eorderid");
	$eorderid = $eorder_id;
	$teeth = new Teeth();

	$data_eorder = new Csql();
	$err =	$data_eorder->Connect();
	$query = "select ord_code,cus_name,cus_cnt_id,doc_name,ord_patientname,agent.agn_name ,ord_detail,ord_priority,
	
	
		ord_cache_cnt_id,ord_cache_type,
	
		DATE_FORMAT(ord_arrivedate,'%e') as ord_dated,
		DATE_FORMAT(ord_arrivedate,'%m') as ord_datem,
		DATE_FORMAT(ord_arrivedate,'%Y') as ord_datey,
		DATE_FORMAT(ord_arrivedate,'%k') as ord_datehh,
		DATE_FORMAT(ord_arrivedate,'%i') as ord_datemm,
		
		DATE_FORMAT(ord_inputdate,'%e') as ord_inputdated,
		DATE_FORMAT(ord_inputdate,'%m') as ord_inputdatem,
		DATE_FORMAT(ord_inputdate,'%Y') as ord_inputdatey,
		DATE_FORMAT(ord_inputdate,'%k') as ord_inputdateh,
		DATE_FORMAT(ord_inputdate,'%i') as ord_inputdatemn,

		DATE_FORMAT(ord_releasedate,'%e') as ord_releasedated,
		DATE_FORMAT(ord_releasedate,'%m') as ord_releasedatem,
		DATE_FORMAT(ord_releasedate,'%Y') as ord_releasedatey,
		DATE_FORMAT(ord_releasedate,'%k') as ord_releasedateh,
		DATE_FORMAT(ord_releasedate,'%i') as ord_releasedatemn,

		DATE_FORMAT(ord_docdate,'%e') as ord_docdated,
		DATE_FORMAT(ord_docdate,'%m') as ord_docdatem,
		DATE_FORMAT(ord_docdate,'%Y') as ord_docdatey,
		DATE_FORMAT(ord_docdate,'%k') as ord_docdateh,
		DATE_FORMAT(ord_docdate,'%i') as ord_docdatemn,		
		
		eorder_fixid,ordf_method,ordf_boxcolor,ordf_typeofworkt,ordf_shade,ordf_shadeoption,ordf_alloy,
		ordf_embrasure,ordf_pontic,ordf_ponticmm,ordf_optiont,ordf_observation,ordf_optmoreinfo,ordf_optenclosed,ordf_optremark,ord_user_id,

		eorder_removeid,ordr_method,ordr_typeofworkt,ordr_shade,ordr_observation,
		ordr_materialupper,ordr_materiallower,ordr_option,ordr_optenclosed,
		
		eorder_orthoid,ordo_method,ordo_work,ordo_workupper,ordo_worklower,ordo_typeofworkt,ordo_shade,ordo_observation
		

		from 
		(select * from eorder,customer,doctor 
		where ord_cus_id = customerid and ord_doc_id = doctorid and eorderid=$eorder_id)as main
		left join
		(select * from eorder_fix where eorder_fixid=$eorder_id)as efix on eorderid = eorder_fixid
		left join
		(select * from eorder_remove where eorder_removeid=$eorder_id)as eremove on eorderid = eorder_removeid
		left join
		(select * from eorder_ortho where eorder_orthoid=$eorder_id)as eortho on eorderid = eorder_orthoid
		left join agent on 
		main.ord_agn_id = agent.agentid 
		 limit 0,1";
	$data_eorder->Query($query);
	
	$ordtypeF			= $data_eorder->Rs("eorder_fixid")+0>0;
	$ordtypeR			= $data_eorder->Rs("eorder_removeid")+0>0;
	$ordtypeO			= $data_eorder->Rs("eorder_orthoid")+0>0;
	
	
	$ord_cache_cnt_id	= $data_eorder->Rs("ord_cache_cnt_id");
	$ord_cache_type		= $data_eorder->Rs("ord_cache_type");
	$cus_cnt_id			= $data_eorder->Rs("cus_cnt_id");
	
	
	
	$ordfmethod			= $data_eorder->Rs("ordf_method");
	$ordfboxcolor			= $data_eorder->Rs("ordf_boxcolor");
	$ordftypeofworkt	= $data_eorder->Rs("ordf_typeofworkt");
	$ordfshade			= $data_eorder->Rs("ordf_shade");
	$ordfshadeoption	= $data_eorder->Rs("ordf_shadeoption");
	$ordfalloy				= $data_eorder->Rs("ordf_alloy");
	$ordfembrasure		= $data_eorder->Rs("ordf_embrasure");
	$ordfpontic				= $data_eorder->Rs("ordf_pontic");
	$ordfoptiont			= $data_eorder->Rs("ordf_optiont");
	$ordfobservation		= $data_eorder->Rs("ordf_observation");
	$fix_prefix = substr($ordfobservation,0,strpos($ordfobservation,"^"));
	if($ordfpontic == "5") {
		$ordfponticmm = getParameter($fix_prefix,"RT");
	}
	
	$ordfobservation = substr($ordfobservation,strpos($ordfobservation,"^")+1);
	$ordfoptmoreinfo	= explode(",",$data_eorder->Rs("ordf_optmoreinfo"));
	$ordfoptremark		= explode(",",$data_eorder->Rs("ordf_optremark"));
	$ordfoptenclosed	= explode(",",$data_eorder->Rs("ordf_optenclosed"));
		
	$ordrmethod			= $data_eorder->Rs("ordr_method");
	$ordrtypeofworkt	= $data_eorder->Rs("ordr_typeofworkt");
	$ordrshade				= $data_eorder->Rs("ordr_shade");
	$ordrobservation		= $data_eorder->Rs("ordr_observation");
	$ordroptenclosed	= explode(",",$data_eorder->Rs("ordr_optenclosed"));
	
	$ordomethod			= $data_eorder->Rs("ordo_method");
	$ordowork			= $data_eorder->Rs("ordo_work");
	$ordoworkupper		= $data_eorder->Rs("ordo_workupper");
	$ordoworklower		= $data_eorder->Rs("ordo_worklower");
	$ordotypeofworkt	= $data_eorder->Rs("ordo_typeofworkt");
	$ordoshade				= $data_eorder->Rs("ordo_shade");
	$ordoobservation		= $data_eorder->Rs("ordo_observation");	
	
	if($ordfoptmoreinfo[0]=='')unset($ordfoptmoreinfo[0]);
	if($ordfoptremark[0]=='')unset($ordfoptremark[0]);
	
	

	$userid = $data_eorder->Rs("ord_user_id");

	$data_user = new Csql();
	$err =	$data_user->Connect();
	$query = "select * from userdental where userdentalid='$userid' limit 0,1";
	//$query = "select * from userdental,staff where  where userdentalid='$userid' and stf_usr_id=$userid  limit 0,1";
	$data_user->Query($query);
	$user_creater = $data_user->EOF?"":$data_user->Rs("usr_username");	
	
	
	$data_logbook = new Csql();
	$query = "select * from logbook where log_ord_id = $eorder_id order by log_date";
	$data_logbook->Query($query);
	
	
	$data_tmp =  new Csql();
	$cache = array();
	$data_logbookAr = array();
	
	while(!$data_logbook->EOF){
		$rowAr = $data_logbook->CurrentRowArray();
	
		if($data_logbook->Rs('log_type')=='OUT'){
			$data_logbookAr[count($data_logbookAr)-1]['out'] = date('H:i',strtotime($data_logbook->Rs('log_date')));
			$data_logbook->MoveNext();
			continue;
		}
		
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
		
		
		$rowAr['date'] = date('m/d',strtotime($data_logbook->Rs('log_date')));
		
		$rowAr['in'] = date('H:i',strtotime($data_logbook->Rs('log_date')));
	
	
		$data_logbookAr[] = $rowAr;
		$data_logbook->MoveNext();
	
	}	
	
	
	
	//Fix cache
	if($ord_cache_cnt_id==0){
		$cus_cnt_id+=0;
		$sql = "Update eorder set ord_cache_cnt_id = $cus_cnt_id where eorderid = $eorder_id ";
		$data_tmp->Execute($sql);
		$sql = "Update eordertoday set ordt_cache_cnt_id = $cus_cnt_id where eordertodayid = $eorder_id ";
		$data_tmp->Execute($sql);
	}
	
	if($ord_cache_type==NULL){
		
		if($ordtypeF){
			$ord_cache_type[] = 'FIX';
		}
		if($ordtypeR){
			$ord_cache_type[] = 'REMOVE';
		}
		if($ordtypeO){
			$ord_cache_type[] = 'ORTHO';
		}
		
		if($ord_cache_type!=NULL){
			//var_dump($ord_cache_type);
			$sql = "Update eorder set ord_cache_type = '".implode(',',$ord_cache_type)."' where eorderid = $eorder_id ";
			//var_dump($sql);
			$data_tmp->Execute($sql);
						
			$sql = "Update eordertoday set ordt_cache_type = '".implode(',',$ord_cache_type)."' where eordertodayid = $eorder_id ";
			//var_dump($sql);
			$data_tmp->Execute($sql);
				
			
		}
		
	}
?>


<html>
<head>
<title>Order <?=$data_eorder->Rs("ord_code");?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>

<?

	//if($ordtypeF && $ordtypeR && !$ordtypeO){
	//	include("orderprintmix.php");
	//	exit();
	//}
	if($ordtypeF){
		include("orderprint_fix2.php");
		echo "<br>";
		//exit();
	}
	if($ordtypeR){
		include("orderprint_remove.php");
		echo "<br>";
		//exit();
	}
	if($ordtypeO){
		include("orderprint_ortho.php");
		echo "<br>";
		//exit();
	}	
?>

</body>
</html>
