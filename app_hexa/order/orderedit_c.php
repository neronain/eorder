<? include_once("../core/default.php"); ?>
<? include_once("../order/inc_shade.php"); ?>
<? include_once("../order/inc_getstring.php"); ?>
<?
	$method 		= $_POST["METHOD"];
	$eorderid = $_POST["eorderid"];


	$customer 		= $_POST["customer"];
	$arg1 		= $_POST["arg1"];
	$arg2 		= $_POST["arg2"];
	//$fixcodearg 	= $_POST["fixcodearg"];
	
	//$doctor 			= $_POST["doctor"];
	//$doctorname 	= $_POST["doctorname"];
	$patientname 	= $_POST["patientname"];

	$orddate_day 	= $_POST["orddate_day"];
	$orddate_month = $_POST["orddate_month"];
	$orddate_year 	= $_POST["orddate_year"];

	$ordreleasedate_day 	= $_POST["ordreleasedate_day"];
	$ordreleasedate_month = $_POST["ordreleasedate_month"];
	$ordreleasedate_year 	= $_POST["ordreleasedate_year"];
	$ordreleasedate_hour = $_POST["ordreleasedate_hour"];
	$ordreleasedate_minute 	= $_POST["ordreleasedate_minute"];


	$isdocdate 				= $_POST["isdocdate"]=='true';
	$orddocdate_day 	= $_POST["orddocdate_day"];
	$orddocdate_month = $_POST["orddocdate_month"];
	$orddocdate_year 	= $_POST["orddocdate_year"];
	$orddocdate_hour = $_POST["orddocdate_hour"];
	$orddocdate_minute 	= $_POST["orddocdate_minute"];

	//$orddetail		 	= $_POST["orddetail"];

	$ordtypeF			= $_POST["ordtypeF"]=='true';
	$ordtypeR			= $_POST["ordtypeR"]=='true';
	$ordtypeO			= $_POST["ordtypeO"]=='true';
	
	$ordfmethod			= $_POST["ordfmethod"];
	$ordftypeofworkt	= $_POST["ordftypeofworkt"];
	$ordfshade				= $_POST["ordfshade"];
	$ordfalloy				= $_POST["ordfalloy"];
	$ordfembrasure		= $_POST["ordfembrasure"];
	$ordfpontic				= $_POST["ordfpontic"];
	$ordfoptiont			= $_POST["ordfoptiont"];
	$ordfobservation		= $_POST["ordfobservation"];
	$ordfoptmoreinfo	= $_POST["ordfoptmoreinfo"];
	$ordfoptremark		= $_POST["ordfoptremark"];



	$ordrmethod			= $_POST["ordrmethod"];
	$ordrtypeofworkt	= $_POST["ordrtypeofworkt"];
	$ordrshade				= $_POST["ordrshade"];
	$ordrobservation		= $_POST["ordrobservation"];
	
	$ordomethod			= $_POST["ordomethod"];
	$ordotypeofworkt	= $_POST["ordotypeofworkt"];
	$ordoshade				= $_POST["ordoshade"];
	$ordoobservation		= $_POST["ordoobservation"];


	if(!isset($ordfoptmoreinfo))$ordfoptmoreinfo=array();
	if(!is_array($ordfoptmoreinfo))$ordfoptmoreinfo = explode('|',$ordfoptmoreinfo);
	if(!isset($ordfoptremark))$ordfoptremark=array();
	if(!is_array($ordfoptremark))$ordfoptremark = explode('|',$ordfoptremark);



	$data_eorder = new Csql();
	$err =	$data_eorder->Connect();



	if($method=="Cancel"){
		gotourl("../order/orderdetail_c.php?eorderid=$eorderid");
		exit();
	}else if($method=="Save"){
	
		$query = "select * from eorder where eorderid=$eorderid limit 0,1";
		$data_eorder->Query($query);
	
		$data_eorder->TableName = "eorder";
		$data_eorder->Set("ord_code","'$arg1$arg2'");
		$data_eorder->Set("ord_cus_id","$customer");
		$data_eorder->Set("ord_patientname","'$patientname'");
		$data_eorder->Set("ord_date","NOW()");
		$data_eorder->Set("ord_arrivedate","'$orddate_year-$orddate_month-$orddate_day'");
		$data_eorder->Set("ord_releasedate",
		"'$ordreleasedate_year-$ordreleasedate_month-$ordreleasedate_day $ordreleasedate_hour:$ordreleasedate_minute'");
		if($isdocdate){
			$data_eorder->Set("ord_docdate",
			"'$orddocdate_year-$orddocdate_month-$orddocdate_day $orddocdate_hour:$orddocdate_minute'");
		}else{
			$data_eorder->Set("ord_docdate","'0000-00-00 00:00'");
		}

		$data_eorder->Update();

		$query = "select * from eordertoday where eordertodayid=$eorderid limit 0,1";
		$data_eorder->Query($query);
		if($data_eorder->Count()>0){
			$data_eorder->TableName = "eordertoday";
			$data_eorder->Set("ordt_code","'$arg1$arg2'");
			$data_eorder->Set("ordt_cus_id","$customer");
			$data_eorder->Set("ordt_patientname","'$patientname'");
			$data_eorder->Set("ordt_date","'$orddate_year-$orddate_month-$orddate_day'");
			$data_eorder->Set("ordt_releasedate",
			"'$ordreleasedate_year-$ordreleasedate_month-$ordreleasedate_day $ordreleasedate_hour:$ordreleasedate_minute'");
			if($isdocdate){
				$data_eorder->Set("ordt_docdate",
				"'$orddocdate_year-$orddocdate_month-$orddocdate_day $orddocdate_hour:$orddocdate_minute'");
			}else{
				$data_eorder->Set("ordt_docdate","'0000-00-00 00:00'");
			}
		}
		$data_eorder->Update();

	
		// Fix table add
		if($ordtypeF){
			$query = "select * from eorder_fix where eorder_fixid=$eorderid limit 0,1";
			$data_eorder->Query($query);
			if($data_eorder->RecordCount==0){
				$data_eorder->Addnew();
			}
			$data_eorder->TableName = "eorder_fix";
			$data_eorder->Set("eorder_fixid","$eorderid");
			$data_eorder->Set("ordf_method","'$ordfmethod'");
			$data_eorder->Set("ordf_typeofworkt","'$ordftypeofworkt'");
			$data_eorder->Set("ordf_shade","$ordfshade");
			$data_eorder->Set("ordf_alloy","$ordfalloy");
			$data_eorder->Set("ordf_embrasure","'$ordfembrasure'");
			$data_eorder->Set("ordf_pontic","$ordfpontic");
			$data_eorder->Set("ordf_optiont","'$ordfoptiont'");
			$data_eorder->Set("ordf_observation","'$ordfobservation'");
			$data_eorder->Set("ordf_optmoreinfo","'".implode(',',$ordfoptmoreinfo)."'");
			$data_eorder->Set("ordf_optremark","'".implode(',',$ordfoptremark)."'");			
			$data_eorder->Update();
		}else{
			$data_eorder->Execute("delete eorder_fix from eorder_fix where eorder_fixid = $eorderid ");
		}
		if($ordtypeR){
			$query = "select * from eorder_remove where eorder_removeid=$eorderid limit 0,1";
			$data_eorder->Query($query);
			if($data_eorder->RecordCount==0){
				$data_eorder->Addnew();
			}
			$data_eorder->TableName = "eorder_remove";
			$data_eorder->Set("eorder_removeid","$eorderid");
			$data_eorder->Set("ordr_method","'$ordrmethod'");
			$data_eorder->Set("ordr_typeofworkt","'$ordrtypeofworkt'");
			$data_eorder->Set("ordr_shade","$ordrshade");
			$data_eorder->Set("ordr_observation","'$ordrobservation'");
			$data_eorder->Update();
		}else{
			$data_eorder->Execute("delete eorder_remove from eorder_remove where eorder_removeid = $eorderid ");
		}
		if($ordtypeO){
			$query = "select * from eorder_ortho where eorder_orthoid=$eorderid limit 0,1";
			$data_eorder->Query($query);
			if($data_eorder->RecordCount==0){
				$data_eorder->Addnew();
			}
			$data_eorder->TableName = "eorder_ortho";
			$data_eorder->Set("eorder_orthoid","$eorderid");
			$data_eorder->Set("ordo_method","'$ordomethod'");
			$data_eorder->Set("ordo_typeofworkt","'$ordotypeofworkt'");
			$data_eorder->Set("ordo_shade","'$ordoshade'");
			$data_eorder->Set("ordo_observation","'$ordoobservation'");
			$data_eorder->Update();
		}else{
			$data_eorder->Execute("delete eorder_ortho from eorder_ortho where eorder_orthoid = $eorderid ");
		}	
	
	
	
	
	
		gotourl("../order/orderdetail_c.php?eorderid=$eorderid");
		exit();
	}



	

	
	
	
	
	
	
	$query = "select 
		ord_code,cus_name,doc_name,ord_patientname,ord_detail,eorderid,customerid,
		left(ord_code,14) as arg1, right(ord_code,2) as arg2,
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
		
		
		
		eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
		ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation,ordf_optmoreinfo,ordf_optremark,

		eorder_removeid,ordr_method,ordr_typeofworkt,ordr_shade,ordr_observation,
		eorder_orthoid,ordo_method,ordo_typeofworkt,ordo_shade,ordo_observation
		
	 	from 
		(select * from eorder,customer,doctor 
		where ord_cus_id = customerid and ord_doc_id = doctorid and eorderid=$eorderid)as main
		left join
		(select * from eorder_fix)as efix on eorderid = eorder_fixid
		left join
		(select * from eorder_remove)as eremove on eorderid = eorder_removeid
		left join
		(select * from eorder_ortho)as eortho on eorderid = eorder_orthoid

		
		
		 limit 0,1";
	$data_eorder->Query($query);

	$arg1 = $data_eorder->Rs("arg1");
	$arg2 = $data_eorder->Rs("arg2");

	$customer = $data_eorder->Rs("customerid");
	$docname = $data_eorder->Rs("doc_name");
	$patientname = $data_eorder->Rs("ord_patientname");

	$ordcode = $data_eorder->Rs("ord_code");


	$orddate_day =$data_eorder->Rs("ord_dated");
	$orddate_month = $data_eorder->Rs("ord_datem");
	$orddate_year = $data_eorder->Rs("ord_datey");
	
	
	$ordreleasedate_day = $data_eorder->Rs("ord_releasedated");
	$ordreleasedate_month = $data_eorder->Rs("ord_releasedatem") ;
	$ordreleasedate_year = $data_eorder->Rs("ord_releasedatey");
	$ordreleasedate_hour = $data_eorder->Rs("ord_releasedateh");
	$ordreleasedate_minute = $data_eorder->Rs("ord_releasedatemn");

	$isdocdate			= $data_eorder->Rs("ord_docdatey")+0>0;
	if($isdocdate){
		$orddocdate_day = $data_eorder->Rs("ord_docdated");
		$orddocdate_month = $data_eorder->Rs("ord_docdatem");
		$orddocdate_year = $data_eorder->Rs("ord_docdatey");
		$orddocdate_hour = $data_eorder->Rs("ord_docdateh");
		$orddocdate_minute = $data_eorder->Rs("ord_docdatemn");
	}else{
		$orddocdate_day = $ordreleasedate_day;
		$orddocdate_month = $ordreleasedate_month;
		$orddocdate_year = $ordreleasedate_year;
		$orddocdate_hour = $ordreleasedate_hour;
		$orddocdate_minute = $ordreleasedate_minute;
	}






	$ordtypeF			= $data_eorder->Rs("eorder_fixid")+0>0;
	$ordtypeR			= $data_eorder->Rs("eorder_removeid")+0>0;
	$ordtypeO			= $data_eorder->Rs("eorder_orthoid")+0>0;
	
	if($ordtypeF){
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
	}else{
		$ordfmethod		= 'Finish';
		$ordfalloy			= 1;
		$ordfembrasure	= 'None';
		$ordfpontic			= 1;
	}

	if($ordtypeR){
		$ordrmethod			= $data_eorder->Rs("ordr_method");
		$ordrtypeofworkt	= $data_eorder->Rs("ordr_typeofworkt");
		$ordrshade				= $data_eorder->Rs("ordr_shade");
		$ordrobservation		= $data_eorder->Rs("ordr_observation");
	}else{
		$ordrmethod		= 'Finish';
	}
	
	if($ordtypeO){
		$ordomethod			= $data_eorder->Rs("ordo_method");
		$ordotypeofworkt	= $data_eorder->Rs("ordo_typeofworkt");
		$ordoshade			= $data_eorder->Rs("ordo_shade");
		$ordoobservation		= $data_eorder->Rs("ordo_observation");
	}else{
		$ordomethod		= 'Finish';
	}
//	 TIME_TO_SEC(),




	include "orderedit.php";

?>
