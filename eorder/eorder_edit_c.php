<? include_once("../core/default.php"); ?>
<? //include_once("../core/functooth.php"); ?>
<?
	
	GetVar($customer_id,"customerid");
	GetVar($eorder_id,"eorderid");
	//$customer_id = (isset($_GET["customerid"])) ? $_GET["customerid"] : $_COOKIE["customerid"];

	GetVar($cancelURL,"CANCELURL");


	$action = '';
	//$DEBUGSQL = true;

	$data = new Csql();
	$data->Connect();
	$fix_teeth = new Teeth();
	$remove_teeth = new Teeth();
	
	if(isset($eorder_id)) {
		//$eorder_id = $_GET["eorderid"];
		// query data from eorder
		$data->Query("select * from eorder where eorderid=$eorder_id limit 1");
		
		if($data->EOF){
			echo "NO EORDER ID : $eorder_id";
			exit();
		}
		$order_code = $data->Rs("ord_code");
		$order_no = $data->Rs("ord_no");
        $brn_id =  $data->Rs("ord_brn_id");
		$ordpriority = $data->Rs("ord_priority");
		$customer_id =  $data->Rs("ord_cus_id");
		$doctor_id =  $data->Rs("ord_doc_id");
		$agent_id =  $data->Rs("ord_agn_id");
		$patient_name = $data->Rs("ord_patientname");
		$eorder_docdate = $data->Rs("ord_docdate");
		$order_shipmethod = $data->Rs("ord_shipmethod");
		
		$eorder_docdate_day = substr($data->Rs("ord_docdate"),8,2);
		$eorder_docdate_month =substr($data->Rs("ord_docdate"),5,2);
		$eorder_docdate_year =substr($data->Rs("ord_docdate"),0,4);
        $eorder_docdate_hour=substr($data->Rs("ord_docdate"),11,2);
		$eorder_docdate_minute=substr($data->Rs("ord_docdate"),14,2);
		$isdocdate = $eorder_docdate_year+0!=0;
		
		
		if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){
			$eorder_arrivedate_day = substr($data->Rs("ord_arrivedate"),8,2);
			$eorder_arrivedate_month = substr($data->Rs("ord_arrivedate"),5,2);
			$eorder_arrivedate_year = substr($data->Rs("ord_arrivedate"),0,4);
			$eorder_arrivedate_hour = substr($data->Rs("ord_arrivedate"),11,2);
			$eorder_arrivedate_minute = substr($data->Rs("ord_arrivedate"),14,2);
			
			$eorder_inputdate_day = substr($data->Rs("ord_inputdate"),8,2);
			$eorder_inputdate_month = substr($data->Rs("ord_inputdate"),5,2);
			$eorder_inputdate_year = substr($data->Rs("ord_inputdate"),0,4);
			$eorder_inputdate_hour = substr($data->Rs("ord_inputdate"),11,2);
			$eorder_inputdate_minute = substr($data->Rs("ord_inputdate"),14,2);			
			
			$eorder_releasedate_day = substr($data->Rs("ord_releasedate"),8,2);
			$eorder_releasedate_month = substr($data->Rs("ord_releasedate"),5,2);
			$eorder_releasedate_year = substr($data->Rs("ord_releasedate"),0,4);
			$eorder_releasedate_hour = substr($data->Rs("ord_releasedate"),11,2);
			$eorder_releasedate_minute = substr($data->Rs("ord_releasedate"),14,2);

			$eorder_deliverydate_day = substr($data->Rs("ord_deliverydate"),8,2);
			$eorder_deliverydate_month = substr($data->Rs("ord_deliverydate"),5,2);
			$eorder_deliverydate_year = substr($data->Rs("ord_deliverydate"),0,4);
			$eorder_deliverydate_hour = substr($data->Rs("ord_deliverydate"),11,2);
			$eorder_deliverydate_minute = substr($data->Rs("ord_deliverydate"),14,2);
			$isdeliverydate = $eorder_deliverydate_year+0!=0;
		}
		
		
		// query data from eorder_fix
		$data->Query("select * from eorder_fix where eorder_fixid=$eorder_id limit 1");
		$order_fix = (!$data->EOF) ? true : false;
		$fix_method = (!$data->EOF) ? $data->Rs("ordf_method") : "Finish";
		$fix_alloy = (!$data->EOF) ? $data->Rs("ordf_alloy") : "1";
		$fix_embrasure =(!$data->EOF) ? $data->Rs("ordf_embrasure") : "None";
		$fix_pontic = (!$data->EOF) ? $data->Rs("ordf_pontic") : "0";
		$fix_box = (!$data->EOF) ? $data->Rs("ordf_boxcolor") : "Brown";
		$fix_observation = (!$data->EOF) ? $data->Rs("ordf_observation") : "Nothing";
		$pos = strpos($fix_observation,"^");
		if($pos !== FALSE) {
			$fix_prefix_observ = substr($fix_observation,0,$pos);
			$fix_observation = substr($fix_observation,$pos+1);	
			$fix_pontic_roottipmm = getParameter($fix_prefix_observ,"RT");		

			$fix_margin["MGNO"] = getParameter($fix_prefix_observ,"MGNO");	
			$fix_margin["MGLM"] = getParameter($fix_prefix_observ,"MGLM");	
			$fix_margin["MGPO"] = getParameter($fix_prefix_observ,"MGPO");	
			$fix_margin["MGSM"] = getParameter($fix_prefix_observ,"MGSM");	
			$fix_margin["MGHM"] = getParameter($fix_prefix_observ,"MGHM");	
			$fix_margin["MGPL"] = getParameter($fix_prefix_observ,"MGPL");	
			$fix_margin["MGPN"] = getParameter($fix_prefix_observ,"MGPN");	
			$fix_margin["MGPM"] = getParameter($fix_prefix_observ,"MGPM");	
			$fix_margin["MGM1"] = getParameter($fix_prefix_observ,"MGM1");	
			$fix_margin["MGM5"] = getParameter($fix_prefix_observ,"MGM5");	
		}

		$option = (!$data->EOF) ? explode(",",$data->Rs("ordf_optmoreinfo")) : array();
		$remake = (!$data->EOF) ? explode(",",$data->Rs("ordf_optremark")) : array();
		$enclosed = (!$data->EOF) ? explode(",",$data->Rs("ordf_optenclosed")) : array();
		$shadeoption  = (!$data->EOF) ? explode(",",$data->Rs("ordf_shadeoption")) : array();
		$fix_shade = (!$data->EOF) ? explode(",",$data->Rs("ordf_shade")) : array(0,0,0,0);
		if(!$data->EOF) {
			$fix_teeth->BuildFixTeethFromText($data->Rs("ordf_typeofworkt"));
		} 
		$fix_material = $fix_teeth->ExportFixTeethMaterialArray();
		$fix_attachment = $fix_teeth->ExportFixTeethAttachmentArray();
		$fix_stepbar = $fix_teeth->ExportFixTeethStepBarArray();
		$fix_porcelain = $fix_teeth->ExportFixTeethPorcelainArray();
		$fix_bridge = $fix_teeth->ExportBridgeArray();
		$fix_opt_mat = $fix_teeth->ExportFixTeethOptionMaterialArray();
		$fix_price = calculateMaterialPriceEach($fix_teeth->ExportFixTeethMaterialCostArray(),"fix");
		
		// ----------------------------------------------------------------------------------------------------
		//$test = BuildSummaryTeethText($fix_teeth,"fix");
		//echo $test;
		// ----------------------------------------------------------------------------------------------------
		$fix_option = array();
		foreach($option as $key => $value) {
			$fix_option[$value] = 1;
		}
		$fix_remake = array();
		foreach($remake as $key => $value) {
			$fix_remake[$value] = 1;
		}
		
		$fix_enclosed = array();
		foreach($enclosed as $key => $value) {
			$fix_enclosed[$value] = 1;
		}
		
		$fix_shadeoption = array();
		foreach($shadeoption as $key => $value) {
			$fix_shadeoption[$value] = 1;
		}
		// query data from eorder_remove
		$data->Query("select * from eorder_remove where eorder_removeid=$eorder_id limit 1");
		$order_remove = (!$data->EOF) ? true : false;		
		$remove_method = (!$data->EOF) ? $data->Rs("ordr_method") : " ";
		$remove_observation = (!$data->EOF) ? $data->Rs("ordr_observation") : " ";
		$remove_shade = (!$data->EOF) ? explode(",",$data->Rs("ordr_shade")) : array(0,0,0,0);
		$cire = (!$data->EOF) ? explode(",",$data->Rs("ordr_cire")) : array();
		$pie = (!$data->EOF) ? explode(",",$data->Rs("ordr_pie")) : array();	
		$enclosed = (!$data->EOF) ? explode(",",$data->Rs("ordr_optenclosed")) : array();		
		$remove_mat["upper"] = (!$data->EOF) ? $data->Rs("ordr_materialupper") : "0000";
		$remove_mat["lower"] = (!$data->EOF) ? $data->Rs("ordr_materiallower") : "0000";
		
		if(!$data->EOF) {
			$remove_option = ParseOptionTextToArray($data->Rs("ordr_option"));
		} else {
			$remove_option = array();
			$remove_option["SpecialRequest"] = array();
			$remove_option["TPExtra"] = array();
			$remove_option["SpecialTrayBiteBlock"] = array();
		}
		$remove_cire = array();
		foreach($cire as $key => $value) {
			$remove_cire[$value] = 1;
		}
		$remove_pie = array();
		foreach($pie as $key => $value) {
			$remove_pie[$value] = 1;
		}
		$remove_enclosed = array();
		foreach($enclosed as $key => $value) {
			$remove_enclosed[$value] = 1;
		}
		if(!$data->EOF) {
			$remove_teeth->BuildRemoveTeethFromText($data->Rs("ordr_typeofworkt"));
		}
		$remove_opt_mat = $remove_teeth->ExportRemoveTeethOptionMaterialArray();
		$remove_material = $remove_teeth->ExportRemoveTeethMaterialArray();
		$remove_attachment = $remove_teeth->ExportRemoveTeethAttachmentArray();
		$remove_price = calculateMaterialPriceEach($remove_teeth->ExportRemoveTeethMaterialCostArray(),"remove");
		// query data from eorder_ortho
		$data->Query("select * from eorder_ortho where eorder_orthoid=$eorder_id limit 1");
		$order_ortho = (!$data->EOF) ? true : false;
		$ortho_method = (!$data->EOF) ? $data->Rs("ordo_method") : " ";
		$ortho_work = (!$data->EOF) ? $data->Rs("ordo_work") : " ";
		$ortho_workupper = (!$data->EOF) ? $data->Rs("ordo_workupper") : " ";
		$ortho_worklower = (!$data->EOF) ? $data->Rs("ordo_worklower") : " ";
		$ortho_observation = (!$data->EOF) ? $data->Rs("ordo_observation") : " ";
		//$ortho_shade = (!$data->EOF) ? explode(",",$data->Rs("ordo_shade")) : array(0,0,0,0);
		$ortho_shade = (!$data->EOF) ? $data->Rs("ordo_shade") : "";

        // query data from eorder_special
		$data->Query("select * from eorder_special where eorder_specialid=$eorder_id limit 1");
		$order_special = (!$data->EOF) ? true : false;
		$special_description = (!$data->EOF) ? $data->Rs("description") : "";
				
		$action = 'edit';
	} else {
	
		
		$order_code = "****************";//$data->Rs("ord_code");
		$order_fix = false;
		$order_remove = false;
		$order_ortho = false;
		$ordpriority = "C";

		$agent_id =  0;
        $brn_id =  $userbrnid;

		$today = getdate();
		$month = $today['mon'];
		$day = $today['mday'];
		$year = $today['year'];
		$offset = 0;
//		echo "dddddddd".$today['wday'];

		// SEARCHME wday
		if($today['wday']==0)$offset=0;//sun
		if($today['wday']==1)$offset=0;
		if($today['wday']==2)$offset=0;
		if($today['wday']==3)$offset=2;
		if($today['wday']==4)$offset=2;
		if($today['wday']==5)$offset=2;
		if($today['wday']==6)$offset=1;
		$timestamp = mktime(24*(3+$offset),'00','00',$month,$day,$year);
		$nextday = getdate($timestamp);
	

	
		$eorder_docdate_day = $nextday['mday'];
		$eorder_docdate_month =$nextday['mon']; 
		$eorder_docdate_year =$nextday['year'];
        $eorder_docdate_hour="17";
		$eorder_docdate_minute="00";
		$isdocdate = false;
		
		if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){
			$eorder_arrivedate_day = $today['mday'];
			$eorder_arrivedate_month =$today['mon']; 
			$eorder_arrivedate_year =$today['year'];
			$eorder_arrivedate_hour=$today['hours'];
			$eorder_arrivedate_minute=$today['minutes'];
			
	
			$eorder_inputdate_day = $today['mday'];
			$eorder_inputdate_month =$today['mon']; 
			$eorder_inputdate_year =$today['year'];
			$eorder_inputdate_hour=$today['hours'];
			$eorder_inputdate_minute=$today['minutes'];

			
			$eorder_releasedate_day=$eorder_docdate_day;
			$eorder_releasedate_month=$eorder_docdate_month;
			$eorder_releasedate_year=$eorder_docdate_year;
			$eorder_releasedate_hour=$eorder_docdate_hour;
			$eorder_releasedate_minute=$eorder_docdate_minute;

			$eorder_deliverydate_day=$eorder_docdate_day;
			$eorder_deliverydate_month=$eorder_docdate_month;
			$eorder_deliverydate_year=$eorder_docdate_year;
			$eorder_deliverydate_hour=$eorder_docdate_hour;
			$eorder_deliverydate_minute=$eorder_docdate_minute;
		}		
		
		
		// fix data
		$fix_method = "Finish";
		$fix_alloy = 1;
		$fix_embrasure = "None";
		$fix_pontic = 'Brown';
		$fix_observation = "";
		$fix_remake = array();
		$fix_enclosed = array();
		$fix_option = array();
		$fix_shadeoption['None'] = 1;


		$fix_shade = array(0,0,0,0);
		for($i=0;$i<32;$i++) {
			$fix_material[Tooth::ParseIndexToNumber($i,'tooth')] = 0;
			$fix_attachment[Tooth::ParseIndexToNumber($i,'tooth')]  = 0;
			$fix_stepbar[Tooth::ParseIndexToNumber($i,'tooth')]  = 0;
			$fix_porcelain[Tooth::ParseIndexToNumber($i,'tooth')] = 0;
			$fix_opt_mat[Tooth::ParseIndexToNumber($i,'tooth')] = 0;
		}
		// remove data
		$remove_method = "Finish";
		$remove_observation = "";
		$remove_shade = array(0,0,0,0);
		$remove_cire = array();
		$remove_pie = array();
		$remove_enclosed = array();
		$remove_mat["upper"] = "0000";
		$remove_mat["lower"] = "0000";
		$remove_option = array();
		$remove_option["Removework"] = "Finish";
		$remove_option["SpecialRequest"] = array();
		$remove_option["TPExtra"] = array();
		$remove_option["SpecialTrayBiteBlock"] = array();
		for($i=0;$i<32;$i++) {
			$remove_material[Tooth::ParseIndexToNumber($i,'tooth')] = 0;
			$remove_attachment[Tooth::ParseIndexToNumber($i,'tooth')]  = 0;
			$remove_opt_mat[Tooth::ParseIndexToNumber($i,'tooth')] = 0;
		}
		/*$remove_option["Removework"] = "Try-in frame";
		$remove_option["RPDAcrylic"] = "AcrylicPalaPress";
		$remove_option["SpecialRequest"]["Backing"] = "1";
		$remove_option["TPOrderAcrylic"] = "AcrylicNormal";
		$remove_option["TPExtra"] = "Backing";
		$remove_option["TPOrderGrid"] = "CastGridCrCo";
		$remove_option["TeethSetup"] = "Square";
		$remove_option["GumFit"] = "Hard";
		$remove_option["SpecialTray"] = "Hole";
		$remove_option["SpecialTrayBiteBlock"]["ReliefWax"] = "1";*/
		
		$remove_option["Removework"] = "Try-in frame";
		$remove_option["RPDAcrylic"] = "None";
		$remove_option["SpecialRequest"]["Backing"] = "1";
		$remove_option["TPOrderAcrylic"] = "None";
		$remove_option["TPExtra"] = "Backing";
		$remove_option["TPOrderGrid"] = "None";
		$remove_option["TeethSetup"] = "None";
		$remove_option["GumFit"] = "None";
		$remove_option["SpecialTray"] = "Hole";
		$remove_option["SpecialTrayBiteBlock"]["ReliefWax"] = "1";
		
		//Ortho
		$ortho_method = "Finish";
		$ortho_work = "-";
		$ortho_workupper = "-";
		$ortho_worklower = "-";
		$ortho_observation = "";
		$ortho_shade = "";//array(0,0,0,0);

        //Special
        $special_description = "";
		
		// other data
		$action = 'add';
		for($i=0;$i<=30;$i++) {
			$fix_bridge[$i] = 0;
		}
	}
	$data->Query("select cus_nick,cus_name,cus_shipmethod from customer where customerid=$customer_id limit 0,1");
	$customer_nickname = (!$data->EOF) ? $data->Rs("cus_nick") : " ";
	$customer_name = (!$data->EOF) ? $data->Rs("cus_name") : "คลินิกนิรนาม";
	$cus_shipmethod = (!$data->EOF) ? $data->Rs("cus_shipmethod") : "NONE";
	
	if($order_shipmethod ==NULL){
		$order_shipmethod = $cus_shipmethod;
	}
?>

<?
	echo "<pre>";
	//var_dump($remove_option);
	echo "</pre>";
?>

