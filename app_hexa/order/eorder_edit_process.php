<? include_once("../core/default.php"); ?>
<? include_once("../core/functooth.php"); ?>

<?php
	//$debug = true;
	$error = FALSE;
	if($debug){
		echo "<pre>";
		var_dump($_POST);
		echo "</pre>";
	}
	// Data Add into Table eorder
	$action = $_POST["act"];
	$issubmit = $_POST["issubmit"];
	$eorder_id = $_POST["eorder_id"];
	$eorder_code = $_POST["txteorder_code"];
	$eorder_no = $_POST["txteorder_code"];
	if(isset($_POST['staffcodecheckbox'])){
		$input = $eorder_code;
		$eorder_code = str_pad($input, 8 , "0", STR_PAD_LEFT);
		$eorder_code = substr($eorder_code,strlen($eorder_code)-8,8);
	}else{
		$eorder_code = "[autono]";
	}
    $eorder_brn_id = $_POST["eorder_brn_id"];
	$eorder_custid = $_POST["eorder_custid"];
	$customer_id = $eorder_custid;
	$eorder_doctid = $_POST["eorder_doctid"];
	$eorder_agentid = $_POST["eorder_agentid"];
	$eorder_patname = $_POST["eorder_patname"];
	//$eorder_priority = $_POST["ordpriority"];
	
	$eorder_isdocdate = $_POST["isdocdate"]=="true";
	$eorder_docdate_day = $_POST["eorder_docdate_day"];
	$eorder_docdate_month = $_POST["eorder_docdate_month"];
	$eorder_docdate_year = $_POST["eorder_docdate_year"];
	$eorder_docdate_hour = $_POST["eorder_docdate_hour"];
	$eorder_docdate_minute = $_POST["eorder_docdate_minute"];
	
	$eorder_isdeliverydate = $_POST["isdeliverydate"]=="true";
	$eorder_deliverydate_day = $_POST["eorder_deliverydate_day"];
	$eorder_deliverydate_month = $_POST["eorder_deliverydate_month"];
	$eorder_deliverydate_year = $_POST["eorder_deliverydate_year"];
	$eorder_deliverydate_hour = $_POST["eorder_deliverydate_hour"];
	$eorder_deliverydate_minute = $_POST["eorder_deliverydate_minute"];	
	
	if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){
		$eorder_arrivedate_day = $_POST["eorder_arrivedate_day"];
		$eorder_arrivedate_month = $_POST["eorder_arrivedate_month"];
		$eorder_arrivedate_year = $_POST["eorder_arrivedate_year"];
        $eorder_arrivedate_hour = $_POST["eorder_arrivedate_hour"];
		$eorder_arrivedate_minute = $_POST["eorder_arrivedate_minute"];
		
		$eorder_releasedate_day = $_POST["eorder_releasedate_day"];
		$eorder_releasedate_month = $_POST["eorder_releasedate_month"];
		$eorder_releasedate_year = $_POST["eorder_releasedate_year"];
		$eorder_releasedate_hour = $_POST["eorder_releasedate_hour"];
		$eorder_releasedate_minute = $_POST["eorder_releasedate_minute"];
		
		
	}		
	
	$ord_shipmethod =  $_POST["order_shipmethod"];
	
	
	$eorder_priority = 'C';//$_POST["eorder_priority"];
	$order_fix = $_POST["order_fix"];
	$order_remove = $_POST["order_remove"];
	$order_ortho = $_POST["order_ortho"];
	$order_special = $_POST["order_special"];

	// Data Add into Table eorder_fix
	$fix_material = $_POST["fix_material"];
	$fix_opt_mat = $_POST["fix_opt_mat"];
	$fix_attachment = $_POST["fix_attachment"];
	$fix_stepbar = $_POST["fix_stepbar"];
	$fix_porcelain = $_POST["fix_porcelain"];
	$fix_bridge = $_POST['fix_bridge'];
	$fix_method = $_POST["fix_method"];
	$fix_shade = $_POST["fix_shade"];
	for($i=0;$i<count($fix_shade);$i++) {
		if(!isset($fix_shade[$i]) || $fix_shade[$i] == "") {
			if($i == 0) $fix_shade[$i] = 0;
			$fix_shade[$i] = $fix_shade[0];
		}
	}
	$fix_alloy = $_POST["fix_alloy"];
	$fix_embrasure = $_POST["fix_embrasure"];
	$fix_pontic = $_POST["fix_pontic"];
	$fix_box = $_POST["fix_box"];



	//vardump($fix_enclosed);
	//exit();

	$fix_observationt = $_POST["fix_observation"];
	$fix_observ_prefix = "";
	$fix_observ_prefix .= ($fix_pontic == "5") ? "[RT:".$_POST["fix_pontic_roottipmm"]."]" : "";

	$fix_observ_prefix .=  ($_POST["margin_mgno"] != "") ?"[MGNO:".$_POST["margin_mgno"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mglm"] != "") ?"[MGLM:".$_POST["margin_mglm"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mgpo"] != "") ?"[MGPO:".$_POST["margin_mgpo"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mgsm"] != "") ?"[MGSM:".$_POST["margin_mgsm"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mghm"] != "") ?"[MGHM:".$_POST["margin_mghm"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mgpl"] != "") ?"[MGPL:".$_POST["margin_mgpl"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mgpn"] != "") ?"[MGPN:".$_POST["margin_mgpn"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mgpm"] != "") ?"[MGPM:".$_POST["margin_mgpm"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mgm1"] != "") ?"[MGM1:".$_POST["margin_mgm1"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mgm5"] != "") ?"[MGM5:".$_POST["margin_mgm5"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mgdm"] != "") ?"[MGDM:".$_POST["margin_mgdm"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mgpd"] != "") ?"[MGPD:".$_POST["margin_mgpd"]."]" : "";
	$fix_observ_prefix .=  ($_POST["margin_mgdh"] != "") ?"[MGDH:".$_POST["margin_mgdh"]."]" : "";


	$fix_observation = $fix_observ_prefix."^".trim($fix_observationt);

	$i = 0;
	foreach ($_POST["fix_option"] as $key => $value) {
    	if($value == 1) {
			$option[$i] = $key;
			$i++;
		}
	}
	$i = 0;
	foreach ($_POST["fix_remake"] as $key => $value) {
    	if($value == 1) {
			$remake[$i] = $key;
			$i++;
		}
	}
	foreach ($_POST["fix_shadeoption"] as $key => $value) {
    	if($value == 1) {
			$shadeoption[$i] = $key;
			$i++;
		}
	}
	foreach ($_POST["fix_enclosed"] as $key => $value) {
    	if($value == 1) {
			$fix_enclosed[] = $key;
			//$i++;
		}
	}
	//var_dump($_POST["fix_shadeoption"] );
	//exit();

	// Data Add into Table eorder_remove
	$remove_material = $_POST["remove_material"];
	$remove_bridge = $_POST['remove_bridge'];
	//$remove_method = $_POST["remove_method"];
	$remove_shade = $_POST["remove_shade"];
	$remove_opt_mat = $_POST["remove_opt_mat"];
	$remove_observation = $_POST["remove_observation"];
	$remove_observation = trim($remove_observation);
	$remove_mat = $_POST["remove_mat"];
	$remove_cire = $_POST["remove_cire"];
	$remove_pie = $_POST["remove_pie"];
	$remove_option = $_POST["remove_option"];
	$remove_option_text = ParseOptionArrayToText($remove_option);
	for($i=0;$i<count($remove_shade);$i++) {
		if(!isset($remove_shade[$i]) || $remove_shade[$i] == "") {
			if($i == 0) $remove_shade[$i] = 0;
			$remove_shade[$i] = $remove_shade[0];
		}
	}

	
	//'Try-in','Contour','Finish','Repair','BiteBox','BiteBlock','Setup','Remake','Remake&Finish'
	//
	switch($remove_option["Removework"]){
		case 'Try-in frame':	$remove_method = 'Try-in';			break;
		case 'Bite Block':		$remove_method = 'BiteBox';			break;
		case 'Setup teeth':		$remove_method = 'Setup';			break;
		case 'Remake & Finish':	$remove_method = 'Remake&Finish';	break;
		default:
		$remove_method = $remove_option["Removework"];
	}
	
	
	
	
	
	foreach ($_POST["remove_enclosed"] as $key => $value) {
    	if($value == 1) {
			$remove_enclosed[] = $key;
			//$i++;
		}
	}



	$ortho_method = $_POST["ortho_method"];
	$ortho_work = $_POST["ortho_work"];
	$ortho_workupper = $_POST["ortho_workupper"];
	$ortho_worklower = $_POST["ortho_worklower"];
	$ortho_shade = $_POST["ortho_shade"];
	$ortho_observation = $_POST["ortho_observation"];
	$ortho_observation = trim($ortho_observation);

	$special_description = $_POST["special_description"];
	$special_description = trim($special_description);

	//echo "<pre>";
	//var_dump($remove_option);
	//echo "</pre>";

	
	$ord_cache_typeAr = array();
	if($order_fix)		$ord_cache_typeAr[] = "FIX";
	if($order_remove)	$ord_cache_typeAr[] = "REMOVE";
	if($order_ortho)	$ord_cache_typeAr[] = "ORTHO";
	$ord_cache_type = implode(',', $ord_cache_typeAr);	
	
	// Parser from array to class member
	$teeth = new Teeth();
	$teeth->BuildFixTeethVariable($fix_material,$fix_attachment,$fix_stepbar,$fix_porcelain,$fix_opt_mat,$fix_bridge);
	$teeth->BuildRemoveTeethVariable($remove_material,$fix_attachment,$remove_opt_mat,$fix_bridge);
	$remove_worktype =  $teeth->BuildRemoveTeethText();
	$fix_worktype =  $teeth->BuildFixTeethText();
	// new instance
	$data = new Csql();
	$data->Connect();

	if($action =="add") {
		// Add data into table eorder
		$data->Query("select cus_nick,cus_cnt_id,cus_shipmethod  from customer where customerid=$customer_id limit 1");
		$customer_nick = (!$data->EOF)?$data->Rs("cus_nick"):"C000";
		$cus_cnt_id = (!$data->EOF)?$data->Rs("cus_cnt_id"):"0";
		$cus_shipmethod = (!$data->EOF)?$data->Rs("cus_shipmethod"):"NONE";
		
		
		if(($cus_shipmethod=='' || $cus_shipmethod=='NONE') && $ord_shipmethod!='' && $ord_shipmethod!='NONE'){
			$data->Execute("update customer set cus_shipmethod = '$ord_shipmethod' where customerid=$customer_id limit 1");;
		}

		$data->Query("select max(right(ord_code,2)) as maxcode
		from eorder where ord_cus_id = $customer_id and left(ord_code,14)='ET".$customer_nick.$eorder_code."'");
		$maxcode = (!$data->EOF)?$data->Rs("maxcode"):"0";
		$maxcode+=1;
		$maxcode = str_pad($maxcode,2,'0',STR_PAD_LEFT);

		
		
		$data->AddNew();
		$data->TableName = "eorder";
		$data->Set("ord_cus_id","$customer_id");
		$data->Set("ord_cache_cnt_id","$cus_cnt_id");
		$data->Set("ord_cache_type","'$ord_cache_type'");
		
		$data->Set("ord_code","'ET".$customer_nick.$eorder_code."".$maxcode.""."'");
		$data->Set("ord_no","'$eorder_no'");
		//$data->Set("ord_code","'ET".$customer_nick."[autono]"."01"."'");

		$error = $error || $data->Update();
		$eorder_id = $data->GetMaxID("eorder");
		$error = $error || $data->Execute("update eorder set ord_code = concat(left(ord_code,6),repeat('0',8-LENGTH(eorderid)),eorderid,right(ord_code,2))
		where ord_cus_id = $customer_id and right( left(ord_code,14),8)='[autono]'");

		$data->Query("select * from eorder where eorderid=$eorder_id limit 0,1");
		$data->TableName = "eorder";
        $data->Set("ord_brn_id","$eorder_brn_id");
		$data->Set("ord_doc_id","$eorder_doctid");
		$data->Set("ord_agn_id","$eorder_agentid");
		$data->Set("ord_patientname","'$eorder_patname'");
		if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){
			$data->Set("ord_arrivedate","'$eorder_arrivedate_year-$eorder_arrivedate_month-$eorder_arrivedate_day $eorder_arrivedate_hour:$eorder_arrivedate_minute:00'");
		}else{
			$data->Set("ord_arrivedate","NOW()");
		}
		$data->Set("ord_date","NOW()");

		if($eorder_isdocdate){
			$data->Set("ord_docdate","'$eorder_docdate_year-$eorder_docdate_month-$eorder_docdate_day $eorder_docdate_hour:$eorder_docdate_minute:00'");
		}else{
			$data->Set("ord_docdate","'0000-00-00 00:00:00'");
		}
		$data->Set("ord_shipmethod","'$ord_shipmethod'");
		
		$order_type = "";
		if($order_fix && $order_remove) {
			$order_type = BuildSummaryTeethText($teeth,"fix",$fix_method)."|$fix_observationt ".BuildSummaryTeethText($teeth,"remove",$remove_method,$remove_mat["upper"],$remove_mat["lower"])."|$remove_observation";
		} elseif($order_fix) {
			$order_type = BuildSummaryTeethText($teeth,"fix",$fix_method)."|$fix_observationt";
		} elseif($order_remove) {
			$order_type = BuildSummaryTeethText($teeth,"remove",$remove_method,$remove_mat["upper"],$remove_mat["lower"])."|$remove_observation";
		}
		if($order_ortho) {
			$ortho_worktext = $ortho_work!='-'?"[$ortho_work]":"";
			$ortho_workuppertext = $ortho_workupper!='-'?"[U:$ortho_workupper]":"";
			$ortho_worklowertext = $ortho_worklower!='-'?"[L:$ortho_worklower]":"";
			$order_type .= BuildSummaryTeethText($teeth,"ortho",$ortho_method)."{$ortho_worktext}{$ortho_workuppertext}{$ortho_worklowertext}|{$ortho_observation}";
		}

		$data->Set("ord_typeofwork","'$order_type'");
		if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){
			$data->Set("ord_inputdate","NOW()");


			$data->Set("ord_arrivedate","'$eorder_arrivedate_year-$eorder_arrivedate_month-$eorder_arrivedate_day $eorder_arrivedate_hour:$eorder_arrivedate_minute:00'");
			$data->Set("ord_releasedate","'$eorder_releasedate_year-$eorder_releasedate_month-$eorder_releasedate_day $eorder_releasedate_hour:$eorder_releasedate_minute:00'");

			if($eorder_isdeliverydate){
				$data->Set("ord_deliverydate","'$eorder_deliverydate_year-$eorder_deliverydate_month-$eorder_deliverydate_day $eorder_deliverydate_hour:$eorder_deliverydate_minute:00'");
			}else{
				$data->Set("ord_deliverydate","'$eorder_releasedate_year-$eorder_releasedate_month-$eorder_releasedate_day $eorder_releasedate_hour:$eorder_releasedate_minute:00'");
			}

		}

		$data->Set("ord_priority","'$eorder_priority'");

		// ---------------------------
		if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){
			$data->Set("ord_status","2");
			$data->Set("ord_user_id","$userdentalid");
		}
		$error = $error || $data->Update();


		// ---------------------------
		if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){
			// Update to eordertoday
			$error = $error || $data->Execute("insert ignore into eordertoday
				(eordertodayid) values($eorder_id)");

			$error = $error || $data->Execute("update eordertoday,eorder
				set
				ordt_code = ord_code,
				ordt_no = ord_no,
				ordt_brn_id = ord_brn_id,
				ordt_doc_id = ord_doc_id,
				ordt_agn_id = ord_agn_id,
				ordt_cus_id = ord_cus_id,
				ordt_cache_cnt_id = ord_cache_cnt_id,
				ordt_cache_type = ord_cache_type,
				ordt_patientname =ord_patientname,
				ordt_arrivedate =ord_arrivedate,
				ordt_releasedate =ord_releasedate,
				ordt_deliverydate =ord_deliverydate,
				ordt_docdate =ord_docdate,
				ordt_priority =ord_priority,
				ordt_detail =ord_detail,
				ordt_remark =ord_remark,
				ordt_typeofwork = ord_typeofwork,
				ordt_shipmethod = ord_shipmethod

				where eorderid = $eorder_id and eordertodayid=$eorder_id and eordertodayid=eorderid ");

			//$userstaffid = $_SESSION["userstaffid"];
			//$usersec_id = $_SESSION["usersec_id"];
			if($userstfid>0){
				$data->Addnew();
				$data->TableName = "logbook";
				$data->Set("log_ord_id","$eorder_id");
				$data->Set("log_stf_id","$userstfid");
				$data->Set("log_sec_id","$usersecid");
				$data->Set("log_type","'IN'");
				$data->Set("log_date","NOW()");
				$data->Update();

				$data->Query("select max(logbookid) as maxlog from logbook
					where log_ord_id=$eorder_id and log_stf_id=$userstfid and
					log_sec_id=$usersecid and log_type='IN'");
				$maxlog = $data->Rs("maxlog");
				$data->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");

				$data->Addnew();
				$data->TableName = "logbook";
				$data->Set("log_ord_id","$eorder_id");
				$data->Set("log_stf_id","$userstfid");
				$data->Set("log_sec_id","$usersecid");
				$data->Set("log_type","'OUT'");
				$data->Set("log_date","NOW()");
				$data->Update();

				$data->Query("select max(logbookid) as maxlog from logbook
					where log_ord_id=$eorder_id and log_stf_id=$userstfid and
					log_sec_id=$usersecid and log_type='OUT'");
				$maxlog = $data->Rs("maxlog");
				$data->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");

			}

		}

		// Add data into table eorder_fix
		if($order_fix) {
			$data->Addnew();
			$data->TableName = "eorder_fix";
			$data->Set("eorder_fixid","'$eorder_id'");
			$data->Set("ordf_method","'$fix_method'");
			$data->Set("ordf_typeofworkt","'$fix_worktype'");
			if(isset($fix_shade))
				$data->Set("ordf_shade","'".implode(",",$fix_shade)."'");
			$data->Set("ordf_alloy","'$fix_alloy'");
			$data->Set("ordf_embrasure","'$fix_embrasure'");
			$data->Set("ordf_pontic","'$fix_pontic'");
			$data->Set("ordf_boxcolor","'$fix_box'");
			$data->Set("ordf_observation","'$fix_observation'");
			if(isset($remake))
				$data->Set("ordf_optremark","'".implode(",",$remake)."'");
			if(isset($option))
				$data->Set("ordf_optmoreinfo","'".implode(",",$option)."'");
			if(isset($shadeoption))
				$data->Set("ordf_shadeoption","'".implode(",",$shadeoption)."'");
			if(isset($fix_enclosed))
				$data->Set("ordf_optenclosed","'".implode(",",$fix_enclosed)."'");

			$error = $error || $data->Update();

			// Add data to table eorder_fixsum
			//echo "<pre>"; var_dump($fix_material); echo "</pre>";
			$arr = ParseTeethToCalculate($fix_material,"fix_material");
			//echo "<pre>"; var_dump($arr); echo "</pre>";

			// TODO : Fix bug
			/*
			foreach($arr as $key => $value) {
				$fixsum = new Csql();
				$fixsum->Connect();
				$fixsum->Query("select * from eorder_fixsum where eorder_fixsumid=$eorder_id and ordfs_mat_id=$key limit 0,1");
				if($fixsum->Count() == 0) {
					$data->Addnew();
				}
				$data->TableName = "eorder_fixsum";
				$data->Set("eorder_fixsumID","$eorder_id");
				$data->Set("ordfs_mat_id","$key");
				$data->Set("ordfs_count","$value");
				$data->Update(" and ordfs_mat_id=$key ");
			}
			*/
		}
		// Add data into table eorder_remove
		if($order_remove) {
			$data->Addnew();
			$data->TableName = "eorder_remove";
			$data->Set("eorder_removeid","'$eorder_id'");
			$data->Set("ordr_method","'$remove_method'");
			$data->Set("ordr_typeofworkt","'$remove_worktype'");
			$data->Set("ordr_materialupper","'".$remove_mat["upper"]."'");
			$data->Set("ordr_materiallower","'".$remove_mat["lower"]."'");
			if(isset($remove_shade))
				$data->Set("ordr_shade","'".implode(",",$remove_shade)."'");
			if(isset($remove_cire))
				$data->Set("ordr_cire","'".implode(",",$remove_cire)."'");
			if(isset($remove_pie))
				$data->Set("ordr_pie","'".implode(",",$remove_pie)."'");
			$data->Set("ordr_observation","'$remove_observation'");
			$data->Set("ordr_option","'$remove_option_text'");

			if(isset($remove_enclosed))
				$data->Set("ordr_optenclosed","'".implode(",",$remove_enclosed)."'");

			$error = $error || $data->Update();
		}

		if($order_ortho) {
			$data->Addnew();
			$data->TableName = "eorder_ortho";
			$data->Set("eorder_orthoid","'$eorder_id'");
			$data->Set("ordo_method","'$ortho_method'");
			$data->Set("ordo_work","'$ortho_work'");
			$data->Set("ordo_workupper","'$ortho_workupper'");
			$data->Set("ordo_worklower","'$ortho_worklower'");
			//$data->Set("ordo_typeofworkt","'$fix_worktype'");
			//if(isset($ortho_shade))
			//	$data->Set("ordo_shade","'".implode(",",$ortho_shade)."'");
			$data->Set("ordo_shade","'$ortho_shade'");
			$data->Set("ordo_observation","'$ortho_observation'");
			$error = $error || $data->Update();

		}

        //Add data into eorder_special
        if($order_special) {
			$data->Addnew();
			$data->TableName = "eorder_special";
			$data->Set("eorder_specialid","'$eorder_id'");
			$data->Set("description","'$special_description'");			
			$error = $error || $data->Update();
		}


//-----------------------------------------------------------------------------------

	} elseif($action == "edit") {
		$data->Query("select * from eorder where eorderid=$eorder_id limit 0,1");
		$data->TableName = "eorder";
		$data->Set("ord_no","'$eorder_no'");
        $data->Set("ord_brn_id","$eorder_brn_id");
		$data->Set("ord_doc_id","$eorder_doctid");
		$data->Set("ord_agn_id","$eorder_agentid");
		$data->Set("ord_patientname","'$eorder_patname'");
		$data->Set("ord_cache_type","'$ord_cache_type'");
		//$data->Set("ord_date","NOW()");


		if($eorder_isdocdate){
			$data->Set("ord_docdate","'$eorder_docdate_year-$eorder_docdate_month-$eorder_docdate_day $eorder_docdate_hour:$eorder_docdate_minute:00'");
		}else{
			$data->Set("ord_docdate","'0000-00-00 00:00:00'");
		}
		$data->Set("ord_shipmethod","'$ord_shipmethod'");
		
		if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){
			$data->Set("ord_arrivedate","'$eorder_arrivedate_year-$eorder_arrivedate_month-$eorder_arrivedate_day $eorder_arrivedate_hour:$eorder_arrivedate_minute:00'");
			$data->Set("ord_releasedate","'$eorder_releasedate_year-$eorder_releasedate_month-$eorder_releasedate_day $eorder_releasedate_hour:$eorder_releasedate_minute:00'");
			if($eorder_isdeliverydate){
				$data->Set("ord_deliverydate","'$eorder_deliverydate_year-$eorder_deliverydate_month-$eorder_deliverydate_day $eorder_deliverydate_hour:$eorder_deliverydate_minute:00'");
			}else{
				$data->Set("ord_deliverydate","'$eorder_releasedate_year-$eorder_releasedate_month-$eorder_releasedate_day $eorder_releasedate_hour:$eorder_releasedate_minute:00'");
			}
		}
		$order_type = "";
		if($order_fix && $order_remove) {
			$order_type = BuildSummaryTeethText($teeth,"fix",$fix_method)."|$fix_observation ".BuildSummaryTeethText($teeth,"remove",$remove_method,$remove_mat["upper"],$remove_mat["lower"])."|$remove_observation";
		} elseif($order_fix) {
			$order_type = BuildSummaryTeethText($teeth,"fix",$fix_method)."|$fix_observation";
		} elseif($order_remove) {
			$order_type = BuildSummaryTeethText($teeth,"remove",$remove_method,$remove_mat["upper"],$remove_mat["lower"])."|$remove_observation";
		}
		if($order_ortho) {
			$ortho_worktext = $ortho_work!='-'?"[$ortho_work]":"";
			$ortho_workuppertext = $ortho_workupper!='-'?"[U:$ortho_workupper]":"";
			$ortho_worklowertext = $ortho_worklower!='-'?"[L:$ortho_worklower]":"";
			$order_type .= BuildSummaryTeethText($teeth,"ortho",$ortho_method)."{$ortho_worktext}{$ortho_workuppertext}{$ortho_worklowertext}|{$ortho_observation}";
		}

		$data->Set("ord_typeofwork","'$order_type'");
		$data->Set("ord_priority","'$eorder_priority'");
		$error = $error || $data->Update();

		if($order_fix) {
			$data->Query("select * from eorder_fix where eorder_fixid=$eorder_id limit 1");
			if($data->EOF)
				$data->AddNew();
			$data->TableName = "eorder_fix";
			$data->Set("eorder_fixid","'$eorder_id'");
			$data->Set("ordf_method","'$fix_method'");
			$data->Set("ordf_typeofworkt","'$fix_worktype'");
			if(isset($fix_shade))
				$data->Set("ordf_shade","'".implode(",",$fix_shade)."'");
			$data->Set("ordf_alloy","'$fix_alloy'");
			$data->Set("ordf_embrasure","'$fix_embrasure'");
			$data->Set("ordf_pontic","'$fix_pontic'");
			$data->Set("ordf_boxcolor","'$fix_box'");
			$data->Set("ordf_observation","'$fix_observation'");
			if(isset($remake))
				$data->Set("ordf_optremark","'".implode(",",$remake)."'");
			if(isset($option))
				$data->Set("ordf_optmoreinfo","'".implode(",",$option)."'");
			if(isset($shadeoption))
				$data->Set("ordf_shadeoption","'".implode(",",$shadeoption)."'");

			if(isset($fix_enclosed))
				$data->Set("ordf_optenclosed","'".implode(",",$fix_enclosed)."'");

			//global $DEBUGSQL;
			//$DEBUGSQL = true;

			$error = $error || $data->Update();

			//vardump($fix_enclosed);
			//exit();
			// Add data to table eorder_fixsum
			//echo "<pre>"; var_dump($fix_material); echo "</pre>";
			$arr = ParseTeethToCalculate($fix_material,"fix_material");
			//echo "<pre>"; var_dump($arr); echo "</pre>";

			// TODO : Fix bug
			/*
			$fixsum = new Csql();
			$fixsum->Connect();
			$fixsum->Execute("delete from eorder_fixsum where eorder_fixsumid=$eorder_id");
			foreach($arr as $key => $value) {

				$fixsum->Query("select * from eorder_fixsum where eorder_fixsumid=$eorder_id and ordfs_mat_id=$key limit 0,1");
				if($fixsum->Count() == 0) {
					$data->Addnew();
				}
				$data->TableName = "eorder_fixsum";
				$data->Set("eorder_fixsumid","$eorder_id");
				$data->Set("ordfs_mat_id","$key");
				$data->Set("ordfs_count","$value");
				$data->Update(" and ordfs_mat_id=$key ");
			}
			*/

		}else{
			$error = $error || $data->Execute("delete from eorder_fix where eorder_fixid=$eorder_id");
		}

		if($order_remove) {
			$data->Query("select * from eorder_remove where eorder_removeid=$eorder_id limit 1");
			if($data->EOF)
				$data->AddNew();
			$data->TableName = "eorder_remove";
			$data->Set("eorder_removeid","'$eorder_id'");
			$data->Set("ordr_method","'$remove_method'");
			$data->Set("ordr_typeofworkt","'$remove_worktype'");
			$data->Set("ordr_materialupper","'".$remove_mat["upper"]."'");
			$data->Set("ordr_materiallower","'".$remove_mat["lower"]."'");
			if(isset($remove_cire))
				$data->Set("ordr_cire","'".implode(",",$remove_cire)."'");
			if(isset($remove_pie))
				$data->Set("ordr_pie","'".implode(",",$remove_pie)."'");
			if(isset($remove_shade))
				$data->Set("ordr_shade","'".implode(",",$remove_shade)."'");
			$data->Set("ordr_observation","'$remove_observation'");
			$data->Set("ordr_option","'$remove_option_text'");

			if(isset($remove_enclosed))
				$data->Set("ordr_optenclosed","'".implode(",",$remove_enclosed)."'");

			$error = $error || $data->Update();
		}else{
			$error = $error || $data->Execute("delete from eorder_remove where eorder_removeid=$eorder_id");
		}

		if($order_ortho) {
			$data->Query("select * from eorder_ortho where eorder_orthoid=$eorder_id limit 1");
			if($data->EOF)
				$data->AddNew();
			$data->TableName = "eorder_ortho";
			$data->Set("eorder_orthoid","'$eorder_id'");
			$data->Set("ordo_method","'$ortho_method'");
			$data->Set("ordo_work","'$ortho_work'");
			$data->Set("ordo_workupper","'$ortho_workupper'");
			$data->Set("ordo_worklower","'$ortho_worklower'");
			//if(isset($ortho_shade))
			//$data->Set("ordo_shade","'".implode(",",$ortho_shade)."'");
			$data->Set("ordo_shade","'$ortho_shade'");
			$data->Set("ordo_observation","'$ortho_observation'");
			$error = $error || $data->Update();
		}else{
			$error = $error || $data->Execute("delete from eorder_ortho where eorder_orthoid=$eorder_id");
		}

        if($order_special) {
			$data->Query("select * from eorder_special where eorder_specialid=$eorder_id limit 1");
			if($data->EOF)
				$data->AddNew();
			$data->TableName = "eorder_special";
			$data->Set("eorder_specialid","'$eorder_id'");
			$data->Set("description","'$special_description'");
			
			$error = $error || $data->Update();
		}else{
			$error = $error || $data->Execute("delete from eorder_special where eorder_specialid=$eorder_id");
		}



		// Update to eordertoday
		$error = $error || $data->Execute("update eordertoday,eorder
			set
			ordt_code = ord_code,
			ordt_no = ord_no,
			ordt_brn_id = ord_brn_id,
			ordt_doc_id =ord_doc_id,
			ordt_agn_id = ord_agn_id,
			ordt_cus_id = ord_cus_id,
			ordt_cache_cnt_id = ord_cache_cnt_id,
			ordt_cache_type = ord_cache_type,
			ordt_patientname =ord_patientname,
			ordt_arrivedate =ord_arrivedate,
			ordt_releasedate =ord_releasedate,
			ordt_deliverydate =ord_deliverydate,
			ordt_docdate =ord_docdate,
			ordt_priority =ord_priority,
			ordt_detail =ord_detail,
			ordt_remark =ord_remark,
			ordt_typeofwork = ord_typeofwork,
			ordt_shipmethod = ord_shipmethod

			where eorderid = $eorder_id and eordertodayid=$eorder_id and eordertodayid=eorderid ");

	}





	// Picture upload
	$target_path = "../file/eorderattach/";
	$file = $_FILES['attachfile1']['name'];
	$typefile = $_FILES['attachfile1']['type'];
	$sizefile = $_FILES['attachfile1']['size'];
	$target_name =  $eorder_id.".jpg";
	$error = false;
	if($file != "")   {
		if($typefile == "image/jpeg") {
			if($sizefile <= 2000000) {
				if(file_exists($target_path.$target_name)) {
					unlink($target_path.$target_name);
				} else {
					move_uploaded_file($_FILES['attachfile1']['tmp_name'], $target_path.$target_name);
					$error = false;
				}
			} else {
				$error = true;
				$error_type = "large file";
			}
		} else {
			$error = true;
			$error_type = "invalid type";
		}
	}

	if($error == true) {
		if($error_type == "large file") {
?>
	<font color="#FF0000"><strong>ไฟล์รูปภาพที่เลือกมีขนาดใหญ่เกินไป ขนาดที่สามารถ Upload ได้ คือ 2 MB</strong></font>
    <br /><a href="../eorder/eorder_edit.php?eorderid=<?=$eorder_id?>">กลัีบไปหน้าก่อนหน้า</a>
<?
		} elseif($error_type == "invalid type") {
?>
	<font color="#FF0000"><strong>ประเภทของไฟล์รูปภาพที่เลือกไม่ถูกต้อง ประเภทไฟล์ที่สามารถ Upload ได้คือไฟล์นามสกุล .jpg เท่านั้น</strong></font>
    <br /><a href="../eorder/eorder_edit.php?eorderid=<?=$eorder_id?>">กลัีบไปหน้าก่อนหน้า</a>
<?
		} else {
?>
	<font color="#FF0000"><strong>เกิดข้อผิดพลาดที่ไม่ทราบสาเหตุขึ้น</strong></font>
    <br /><a href="../eorder/eorder_edit.php?eorderid=<?=$eorder_id?>">กลัีบไปหน้าก่อนหน้า</a>
<?
		}
	} else {
		if($issubmit == 1) {
			redirect("../eorder/submit_order.php?eorderid=$eorder_id",0);
		} else {
			if(!$debug){
				if($usertype=='CM'){
					redirect("../cfrontend/order.php?eorderid=$eorder_id",0);
				}else if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){
					//redirect("../eorder/submit_order.php?eorderid=$eorder_id",10);
					$directime = $error?10:0;
					redirect("../order/orderlist_c.php?column=eorderid&keyword=".$eorder_id."&METHOD=GO%21",0);
				}
			}else{
				if($usertype=='CM'){
					redirect("../cfrontend/order.php?eorderid=$eorder_id",0);
				}else if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){
					//redirect("../eorder/submit_order.php?eorderid=$eorder_id",10);
					redirect("../order/orderlist_c.php?column=eorderid&keyword=".$eorder_id."&METHOD=GO%21",10);
				}
			}
		}
	}
?>
