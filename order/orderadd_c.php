<? include_once("../core/default.php"); ?>
<?
// $define 

/*
	$step_inputcus=0;
	$step_inputfix=1;
	$step_selectdoctor=2;
	$step_adddoctor=3;
	$step_inputpatian=4;
	*/
// IN
	//$vowels = array("a", "e", "i", "o", "u", "A", "E", "I", "O", "U");
	//$onlyconsonants = str_replace($vowels, "", "Hello World of PHP");

	$method 		= $_POST["METHOD"];
	$step 			= $_POST["STEP"];
	$step_back 	= $_POST["STEPBACK"];
	$step_next 	= $_POST["STEPNEXT"];
	$step_addition= $_POST["STEPADD"];
	$customer 		= $_POST["customer"]; 
	$fixcode 		= $_POST["fixcode"];
	$fixcodearg 	= $_POST["fixcodearg"];
	
	$doctor 			= $_POST["doctor"];
	$doctorname 	= str_replace("'","",$_POST["doctorname"]);
	$patientname 	= str_replace("'","",$_POST["patientname"]);

	$orddate_day 	= $_POST["orddate_day"];
	$orddate_month = $_POST["orddate_month"];
	$orddate_year 	= $_POST["orddate_year"];

	$ordreleasedate_day 	= $_POST["ordreleasedate_day"];
	$ordreleasedate_month = $_POST["ordreleasedate_month"];
	$ordreleasedate_year 	= $_POST["ordreleasedate_year"];
	$ordreleasedate_hour = $_POST["ordreleasedate_hour"];
	$ordreleasedate_minute 	= $_POST["ordreleasedate_minute"];


	$isdocdate 					= $_POST["isdocdate"]=='true';
	$orddocdate_day 		= $_POST["orddocdate_day"];
	$orddocdate_month 	= $_POST["orddocdate_month"];
	$orddocdate_year 		= $_POST["orddocdate_year"];
	$orddocdate_hour 		= $_POST["orddocdate_hour"];
	$orddocdate_minute 	= $_POST["orddocdate_minute"];
	$ordpriority 				= $_POST["ordpriority"];

	$orddetail		 	= $_POST["orddetail"];

	$ordtypeF			= $_POST["ordtypeF"]=='true';
	$ordtypeR			= $_POST["ordtypeR"]=='true';
	$ordtypeO			= $_POST["ordtypeO"]=='true';
	
	$ordfmethod			= $_POST["ordfmethod"];
	$ordfboxcolor			= $_POST["ordfboxcolor"];
	$ordftypeofworkt	= $_POST["ordftypeofworkt"];
	$ordfshade				= $_POST["ordfshade"];
	$ordfalloy				= $_POST["ordfalloy"];
	$ordfembrasure		= $_POST["ordfembrasure"];
	$ordfpontic				= $_POST["ordfpontic"];
	$ordfponticmm		= $_POST["ordfponticmm"];
	$ordfoptiont			= $_POST["ordfoptiont"];
	$ordfobservation		= $_POST["ordfobservation"];
	$ordfoptmoreinfo	= $_POST["ordfoptmoreinfo"];
	$ordfoptremark		= $_POST["ordfoptremark"];

	//echo $ordfoptmoreinfo['MarginGoDeep'];
	
	$ordrmethod			= $_POST["ordrmethod"];
	$ordrtypeofworkt	= $_POST["ordrtypeofworkt"];
	$ordrshade				= $_POST["ordrshade"];
	$ordrobservation		= $_POST["ordrobservation"];
	
	
	$ordomethod			= $_POST["ordomethod"];
	$ordotypeofworkt	= $_POST["ordotypeofworkt"];
	$ordoshade			= $_POST["ordoshade"];
	$ordoobservation		= $_POST["ordoobservation"];
	
//Validate

	if(!isset($fixcodearg))			$fixcodearg		= '50';


	if(!isset($ordfmethod))			$ordfmethod		= 'Finish';
	if(!isset($ordfboxcolor))		$ordfboxcolor		= 'Brown';
	
	if(!isset($ordfalloy))				$ordfalloy			= 1;
	if(!isset($ordfembrasure))		$ordfembrasure	= 'None';
	if(!isset($ordfpontic))			$ordfpontic			= 1;

	if(!isset($ordrmethod))			$ordrmethod		= 'Finish';


// Intilize
	$method 	= isset($method)?$method:'NEW';
	$step 		= isset($step)?$step:0;

	while(strlen($fixcode)<8 && strlen($fixcode)>0){ $fixcode = "0".$fixcode;	}
	
	

	if(!isset($ordfoptmoreinfo))$ordfoptmoreinfo=array();
	if(!is_array($ordfoptmoreinfo))$ordfoptmoreinfo = explode('|',$ordfoptmoreinfo);
	if(!isset($ordfoptremark))$ordfoptremark=array();
	if(!is_array($ordfoptremark))$ordfoptremark = explode('|',$ordfoptremark);

	
	$today = getdate();
		//print_r($today);
	if(!isset($orddate_day))$orddate_day=$today['mday'];
	if(!isset($orddate_month))$orddate_month=$today['mon']; 
	if(!isset($orddate_year))$orddate_year=$today['year'];
	$hr = $today['hours'];
	$mn = $today['minutes'];

	if(!isset($ordreleasedate_day))$ordreleasedate_day=$today['mday'];
	if(!isset($ordreleasedate_month))$ordreleasedate_month=$today['mon']; 
	if(!isset($ordreleasedate_year))$ordreleasedate_year=$today['year'];
	if(!isset($ordreleasedate_hour))$ordreleasedate_hour='00';
	if(!isset($ordreleasedate_minute))$ordreleasedate_minute='00';

	//if(!isset($isdocdate))			$isdocdate		= false;
	if(!isset($orddocdate_day))$orddocdate_day=$today['mday'];
	if(!isset($orddocdate_month))$orddocdate_month=$today['mon']; 
	if(!isset($orddocdate_year))$orddocdate_year=$today['year'];
	if(!isset($orddocdate_hour))$orddocdate_hour='00';
	if(!isset($orddocdate_minute))$orddocdate_minute='00';

				//$data_order->Set("ord_date","NOW()");

	$orddate_day 				=  str_pad($orddate_day,2,'0',0);
	$orddate_month 			=  str_pad($orddate_month,2,'0',0);
	$ordreleasedate_day 		=  str_pad($ordreleasedate_day,2,'0',0);
	$ordreleasedate_month 	=  str_pad($ordreleasedate_month,2,'0',0);
	$orddocdate_day 			=  str_pad($orddocdate_day,2,'0',0);
	$orddocdate_month 		=  str_pad($orddocdate_month,2,'0',0);


// Start code
//	$eorderid;


	$data_order = new CSql();
	$data_order->Connect();
	
	if($method=="BACK")$step=$step_back;
	else if($method=="NEXT")$step=$step_next;
	else $step=$step_addition;
	
	if(isset($customer)){
			$data_order->Query("select cus_nick,cus_name,cnt_nick 
				from customer,country where customerid=$customer and countryid=cus_cnt_id");
			$cusnick 	= $data_order->Rs("cus_nick");
			$cusname 	= $data_order->Rs("cus_name");
			$cntnick 	= $data_order->Rs("cnt_nick");
	}


	if(!isset($ordpriority))
	{
		if($cntnick=="T"){
			$ordpriority	='D';
		}else{
			$ordpriority	='C';
		}
	}

	if(isset($doctor)){
			$data_order->Query("select doc_name from doctor where doctorid=$doctor");
			$doctorname 	= $data_order->Rs("doc_name");
	}
	
	
	$loop = true;
	while($loop){
		$loop = false;
		switch($step){
			case 11:
				$fixcode = "[autono]";
				$step=2;
			case 2:
				if(strlen($fixcode)==0){
					$step=11;
					break;
				}
			case 5:
				if(isset($customer) && isset($fixcode)){
					$data_order->Query("select eorderid,ord_code,right(ord_code,2) as arg , ord_doc_id,ord_patientname,
						DATE_FORMAT(ord_date,'%d') as ord_dateday,
						DATE_FORMAT(ord_date,'%m') as ord_datemonth,
						DATE_FORMAT(ord_date,'%Y') as ord_dateyear,
	
						DATE_FORMAT(ord_releasedate,'%d') as ord_releasedateday,
						DATE_FORMAT(ord_releasedate,'%m') as ord_releasedatemonth,
						DATE_FORMAT(ord_releasedate,'%Y') as ord_releasedateyear,
	
						DATE_FORMAT(ord_docdate,'%d') as ord_docdateday,
						DATE_FORMAT(ord_docdate,'%m') as ord_docdatemonth,
						DATE_FORMAT(ord_docdate,'%Y') as ord_docdateyear,
						DATE_FORMAT(ord_docdate,'%k') as ord_docdateh,
						DATE_FORMAT(ord_docdate,'%i') as ord_docdatemn,					
	
						ord_detail
					
						from eorder where ord_cus_id=$customer and left(ord_code,14)='E$cntnick$cusnick$fixcode' order by ord_code desc limit 0,1");
					if($data_order->RecordCount>0){
						$eorderid		= $data_order->Rs("eorderid");
						$doctor 			= $data_order->Rs("ord_doc_id");
						$patientname 	= $data_order->Rs("ord_patientname");
						//$orddate_day 		= $data_order->Rs("ord_dateday");
						//$orddate_month 	= $data_order->Rs("ord_datemonth");
						//$orddate_year 		= $data_order->Rs("ord_dateyear");
						
						$orddetail 				= $data_order->Rs("ord_detail");
						$fixcodearg_next = $data_order->Rs("arg")+1;
						if($fixcodearg_next+0<10)$fixcodearg_next="0".$fixcodearg_next;
	
						$data_order->Query("select doc_name from doctor where doctorid=$doctor limit 0,1");
						$doctorname 	= $data_order->Rs("doc_name");
	
	
	
	
						//put fix remove order here

	
	
						$step = 6;
					}else{
					
					}
				}
				if($step==2){
					$data_order->Query("select doctorid from doctor where doc_cus_id=$customer limit 0,1");
					if($data_order->RecordCount==0){
						$step = 3;
					}
				}
				
				break;
			case 10:
				$data_order->Addnew();
				$data_order->TableName = "doctor";
				$data_order->Set("doc_name","'$doctorname'");
				$data_order->Set("doc_cus_id","$customer");
				$data_order->Update();
				$doctor = $data_order->GetMaxID("doctor");
				$step = 5;
				break;
			case 20:
				if(strlen($patientname)==0){$step = 5;$loop = true;}
				//if(!$ordtypeF && !$ordtypeR && !$ordtypeO)$step = 5;
				
				break;
			case 30:
				$data_order->Addnew();
				$data_order->TableName = "eorder";
				$data_order->Set("ord_code","'E$cntnick$cusnick$fixcode$fixcodearg'");
				$data_order->Set("ord_cus_id","$customer");
				$data_order->Set("ord_doc_id","$doctor");
				$data_order->Set("ord_patientname","'$patientname'");
				$data_order->Set("ord_date","'$orddate_year-$orddate_month-$orddate_day $hr:$mn'");
				$data_order->Set("ord_releasedate",
				"'$ordreleasedate_year-$ordreleasedate_month-$ordreleasedate_day $ordreleasedate_hour:$ordreleasedate_minute'");
				$data_order->Set("ord_priority","'$ordpriority'");
				
				if($isdocdate){
					$data_order->Set("ord_docdate",
					"'$orddocdate_year-$orddocdate_month-$orddocdate_day $orddocdate_hour:$orddocdate_minute'");
				}else{
					$data_order->Set("ord_docdate","'0000-00-00 00:00'");
				}
				$data_order->Set("ord_detail","'$orddetail'");
				$data_order->Update();
					$eorderid = $data_order->GetMaxID("eorder");
	
				if($fixcode=="[autono]"){
					$fixcode = $eorderid;
					while(strlen($fixcode)<8 && strlen($fixcode)>0){ $fixcode = "0".$fixcode;	}
					$data_order->Execute("
						update eorder set ord_code =
						concat(left(ord_code,6),repeat('0',8-LENGTH(eorderid)),eorderid,right(ord_code,2)) 
						where ord_cus_id = $customer and ord_doc_id = $doctor and right( left(ord_code,14),8)='[autono]' ");
				}
				
				$data_order->Execute("insert into eordertoday
				(eordertodayid, ordt_code, ordt_doc_id, ordt_patientname, ordt_cus_id, ordt_date, ordt_releasedate, ordt_docdate,ordt_priority, ordt_status, ordt_operateday, ordt_detail, ordt_remark, ordt_isship) 
				
				 select eorderid, ord_code, ord_doc_id, ord_patientname, ord_cus_id, ord_date, ord_releasedate, ord_docdate,ord_priority, ord_status, ord_operateday, ord_detail, ord_remark,0 
				 from eorder where eorderid = $eorderid ");
				// Fix table add
				if($ordtypeF){
					$data_order->Addnew();
					$data_order->TableName = "eorder_fix";
					$data_order->Set("eorder_fixid","$eorderid");
					$data_order->Set("ordf_method","'$ordfmethod'");
					$data_order->Set("ordf_boxcolor","'$ordfboxcolor'");
					$data_order->Set("ordf_typeofworkt","'$ordftypeofworkt'");
					$data_order->Set("ordf_shade","$ordfshade");
					$data_order->Set("ordf_alloy","$ordfalloy");
					$data_order->Set("ordf_embrasure","'$ordfembrasure'");
					$data_order->Set("ordf_pontic","$ordfpontic");
					$data_order->Set("ordf_ponticmm","'$ordfponticmm'");
					$data_order->Set("ordf_optiont","'$ordfoptiont'");
					$data_order->Set("ordf_observation","'$ordfobservation'");
					$data_order->Set("ordf_optmoreinfo","'".implode(',',$ordfoptmoreinfo)."'");
					$data_order->Set("ordf_optremark","'".implode(',',$ordfoptremark)."'");
					$data_order->Update();
				}
				if($ordtypeR){
					$data_order->Addnew();
					$data_order->TableName = "eorder_remove";
					$data_order->Set("eorder_removeid","$eorderid");
					$data_order->Set("ordr_method","'$ordrmethod'");
					$data_order->Set("ordr_typeofworkt","'$ordrtypeofworkt'");
					$data_order->Set("ordr_shade","$ordrshade");
					$data_order->Set("ordr_observation","'$ordrobservation'");
					$data_order->Update();
				}
				if($ordtypeO){
					$data_order->Addnew();
					$data_order->TableName = "eorder_ortho";
					$data_order->Set("eorder_orthoid","$eorderid");
					$data_order->Set("ordo_method","'$ordomethod'");
					$data_order->Set("ordo_typeofworkt","'$ordotypeofworkt'");
					$data_order->Set("ordo_shade","'$ordoshade'");
					$data_order->Set("ordo_observation","'$ordoobservation'");
					$data_order->Update();
				}
				
				$data_order->Execute("update eordertoday,customer,doctor
				set ordt_docname = doc_name, ordt_cusname = cus_name,
				ordt_typeofwork = '$ordftypeofworkt $ordrtypeofworkt $ordotypeofworkt'
				 where eordertodayid = $eorderid and doctorid = ordt_doc_id and customerid = ordt_cus_id");				
				/*
					$ordfmethod			= $_POST["ordfmethod"];
		$ordftypeofworkt	= $_POST["ordftypeofworkt"];
		$ordfshade				= $_POST["ordfshade"];
		$ordfalloy				= $_POST["ordfalloy"];
		$ordfembrasure		= $_POST["ordfembrasure"];
		$ordfpontic				= $_POST["ordfpontic"];
		$ordfoptiont			= $_POST["ordfoptiont"];
		$ordfobservation		= $_POST["ordfobservation"];
				*/
				//$doctor = $data_order->GetMaxID("doctor");
				$step = 40;
				break;
		}
	}
	
	$orddate_day 				+=  0;
	$orddate_month 			+=  0;
	$ordreleasedate_day 		+=  0;
	$ordreleasedate_month 	+=  0;
	$orddocdate_day 			+=  0;
	$orddocdate_month 		+=  0;
	
	include("../order/orderadd.php");
	
	//$cusvars = $data_order->PassValue("customer","customerid=$customer",array("cus_nick","cus_name"));
	//echo($cusvars["cus_nick"]);
	//echo($cusvars["cus_name"]);

	
	
	
	/*
	echo($customer);
	echo($cusnick);
	echo($cusname);
	echo($cntnick);
	echo($fixcode);
	// */
	//echo "E$cntnick$cusnick$fixcode$fixcodearg";
?>