<? include_once("../core/default.php"); ?>
<? include_once("../order/inc_shade.php"); ?>
<? include_once("../order/inc_getstring.php"); ?>
<?

	$data_logbook = new Csql();
	$err =	$data_logbook->Connect();
	//$err =	$data_logbook->Connect();
	
	$eorderid = $_GET["orderid"];
	
	if(!isset($eorderid)){
		$eorderid = $_POST["orderid"];
	}
	
	

		
	
	

	
 

	
	
	$query = "select 
		ord_code,cus_name,doc_name,ord_patientname,ord_detail,eorderid,customerid,
		DATE_FORMAT(ord_date,'%e') as ord_dated,
		DATE_FORMAT(ord_date,'%m') as ord_datem,
		DATE_FORMAT(ord_date,'%Y') as ord_datey,

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
		ord_remark,
		
		
		
		eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
		ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation,ordf_optmoreinfo,ordf_optremark,

		eorder_removeid,ordr_method,ordr_typeofworkt,ordr_shade,ordr_observation,
		eorder_orthoid,ordo_method,ordo_typeofworkt,ordo_shade,ordo_observation
		
	 	from 
		(select * from eorder,customer,doctor 
		where ord_cus_id = customerid and ord_doc_id = doctorid and eorderid=$eorderid)as main
		left join
		(select * from eorder_fix where eorder_fixid=$eorderid)as efix on eorderid = eorder_fixid
		left join
		(select * from eorder_remove where eorder_removeid=$eorderid)as eremove on eorderid = eorder_removeid
		left join
		(select * from eorder_ortho where eorder_orthoid=$eorderid)as eortho on eorderid = eorder_orthoid

		
		
		 limit 0,1";
	$data_eorder->Query($query);

	$remark 			= $data_eorder->Rs("ord_remark");

	$ordtypeF			= $data_eorder->Rs("eorder_fixid")+0>0;
	$ordtypeR			= $data_eorder->Rs("eorder_removeid")+0>0;
	$ordtypeO			= $data_eorder->Rs("eorder_orthoid")+0>0;
	
	$ordfmethod			= $data_eorder->Rs("ordf_method");
	$ordftypeofworkt	= $data_eorder->Rs("ordf_typeofworkt");
	$ordfshade				= $data_eorder->Rs("ordf_shade");
	$ordfalloy				= $data_eorder->Rs("ordf_alloy");
	$ordfembrasure		= $data_eorder->Rs("ordf_embrasure");
	$ordfpontic				= $data_eorder->Rs("ordf_pontic");
	$ordfoptiont			= $data_eorder->Rs("ordf_optiont");
	$ordfobservation		= $data_eorder->Rs("ordf_observation");
	$ordfoptmoreinfo	= explode(",",$data_eorder->Rs("ordf_optmoreinfo"));
	$ordfoptremark		= explode(",",$data_eorder->Rs("ordf_optremark"));

	$ordrmethod			= $data_eorder->Rs("ordr_method");
	$ordrtypeofworkt	= $data_eorder->Rs("ordr_typeofworkt");
	$ordrshade				= $data_eorder->Rs("ordr_shade");
	$ordrobservation		= $data_eorder->Rs("ordr_observation");

	$ordomethod			= $data_eorder->Rs("ordo_method");
	$ordotypeofworkt	= $data_eorder->Rs("ordo_typeofworkt");
	$ordoshade				= $data_eorder->Rs("ordo_shade");
	$ordoobservation		= $data_eorder->Rs("ordo_observation");
	
	if($ordfoptmoreinfo[0]=='')unset($ordfoptmoreinfo[0]);
	if($ordfoptremark[0]=='')unset($ordfoptremark[0]);
	
//	 TIME_TO_SEC(),

	$query = "select 
	
	 logbookid,stf_name,sec_room,log_type,
	 TO_DAYS(log_date)*24*60*60+TIME_TO_SEC(TIME(log_date)) as log_dateD,
	DATE_FORMAT(log_date,'%d/%m/%y %H:%i') as log_date,
	log_date as log_datem
	 
		from logbook,staff,section
		where 
			log_stf_id=staffid and 
			log_sec_id = sectionID and
			log_ord_id=$eorderid 
			
			order by log_datem
			";	
	$data_logbook->Query($query);
	




	$status = "OUT";

	if(!$data_logbook->EOF){
		$data_logbook->MoveLast();
		$status = $data_logbook->Rs("log_type");
		$room = $data_logbook->Rs("sec_room");
		$data_logbook->MoveFirst();
	}

	include "orderdetail.php";

?>
