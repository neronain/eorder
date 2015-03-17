<?
	include_once("../core/default.php");
	include_once("../core/functooth.php");
	
	GetVar($eorder_id,"eorderid");
	$forward = false;
	//---------- Version converter --------------------
		if($eorder_id < 1071613){
			//include("../../eorder1/order/orderprint.php");
			include("../order/orderprint.php");
			exit();
		}
	//-------------------------------------------------
	if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){	
		$data = new Csql();
		$data->Connect();
		$data->Query("select ord_status from eorder where eorderid=$eorder_id limit 1");
		if($data->EOF){
			echo "ERR : NO EORDER ID $eorder_id";
			exit();
		}
		$status = $data->Rs("ord_status");
		if($status>1){
			include("../order/orderprint.php");
			$forward = true;
		}
		
	}
	if(!$forward){
	
	include("../order/inc_shade.php");
	include("../eorder/eorder_fix_config.php");
	include("../eorder/eorder_remove_config.php");
	$alloy = array(1 => "None","Non precious","Non nickel","Precious - Palladium","Precious - Semi-precious","Precious - White - Gold","Precious - Yellow - Gold","Precious - High Yellow - Gold","Other");
	
	$isfix = false; $isremove = false;
	$teeth = new Teeth();
	$eorder = new Csql();
	$eorder->Connect();
	
	$eorder->Query("select eorderid,ord_code,DATE_FORMAT(ord_date,'%d/%m/%Y %H:%i') as ord_date,ord_status,
	 DATE_FORMAT(ord_docdate,'%d/%m/%Y %H:%i') as ord_docdate,cus_name,doc_name,ord_patientname from eorder,customer,doctor where eorderid=$eorder_id and ord_cus_id=customerid and ord_doc_id=doctorId limit 1");
	if(!$eorder->EOF) {
	
		$eorder_code = $eorder->Rs("ord_code");
		$customer_name = $eorder->Rs("cus_name");
		$doctor_name = $eorder->Rs("doc_name");
		$patient_name = $eorder->Rs("ord_patientname");
		$order_date = $eorder->Rs("ord_date");
		$ord_status = $eorder->Rs("ord_status");
		$doctor_appointment = $eorder->Rs("ord_docdate");
		$fix = new Csql(); $remove = new Csql();
		$fix->Connect(); $remove->Connect();
		$fix->Query("select * from eorder_fix where eorder_fixid=$eorder_id limit 1");
		$remove->Query("select * from eorder_remove where eorder_removeid =$eorder_id limit 1");
		$isfix = !$fix->EOF; $isremove = !$remove->EOF;
		if($isfix) {
			$fix_method = $fix->Rs("ordf_method");
			$fix_box = $fix->Rs("ordf_boxcolor");
			$typeofwork = $fix->Rs("ordf_typeofworkt");
			
			$shade = explode(",",$fix->Rs("ordf_shade"));
			
			foreach($shade as $key => $value) {
				for($i=0;$i<count($txtshadename);$i++) {
					if($value == $txtshadeid[$i]) {
						$fix_shade[$key] = "Shade[".($key+1)."] = ".$txtshadename[$i];
						break;
					}
				}
			}
			
			$same = true;
			for($i=0;$i<count($shade)-1;$i++) {
				if($shade[$i] != $shade[$i+1]) {
					$same = false;
					break;
				}
			}
			if($same) {
				$fix_shade = substr($fix_shade[0],11);
			} else {
				$fix_shade = implode("<br>",$fix_shade);
			}
			$fix_alloy = $alloy[$fix->Rs("ordf_alloy")];
			$fix_embrasure = $fix->Rs("ordf_embrasure");
			$fix_pontic = $fix->Rs("ordf_pontic");
			$fix_box = $fix->Rs("ordf_boxcolor");
			$fix_observation = $fix->Rs("ordf_observation");
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
				$fix_margin["MGDM"] = getParameter($fix_prefix_observ,"MGDM");	
				$fix_margin["MGPD"] = getParameter($fix_prefix_observ,"MGPD");	
				$fix_margin["MGDH"] = getParameter($fix_prefix_observ,"MGDH");	
			}			
			
			
			$remake = $fix->Rs("ordf_optremark");
			$option = $fix->Rs("ordf_optmoreinfo");
			if(isset($option) && isset($remake)) {
				$fix_option = "Normal option: ".$option."<br>Remake option: ".$remake;
			}elseif(isset($option)) {
				$fix_option = "Normal option: ".$option;
			} elseif(isset($remake)) {
				$fix_option = "Remake option: ".$remake;
			} else {
				$fix_option = "-";
			}
			$fix_option .= "<br>";
			$teeth->BuildFixTeethFromText($typeofwork);
			$bridge = $teeth->ExportBridgeText();
			$attach_fix = $teeth->ExportFixTeethAttachmentText();
			$material = $teeth->ExportFixTeethMaterialArray();
			$opt_mat = $teeth->ExportFixTeethOptionMaterialArray();
			foreach($material as $key => $value) {
				if($value != 0) {
					//$fix_material .= "[".$key."] : ".$fixmaterial_name[$value];
					$fix_material .= "[".$key."] : ".GetFixMaterialName($value,$opt_mat[$key])."<br>";
				}
			}
			$fix_typeofwork = $fix_material."<br>".$bridge."<br>".$attach_fix."<br>";
		}
		
		if($isremove) {
			$remove_method = $remove->Rs("ordr_method");
			$typeofwork = $remove->Rs("ordr_typeofworkt");
			$remove_mat["upper"] = ExportRemoveMaterialTypeText($remove->Rs("ordr_materialupper"));
			$remove_mat["lower"] = ExportRemoveMaterialTypeText($remove->Rs("ordr_materiallower"));
			$shade = explode(",",$remove->Rs("ordr_shade"));
			foreach($shade as $key => $value) {
				for($i=0;$i<count($txtshadename);$i++) {
					if($value == $txtshadeid[$i]) {
						$remove_shade[$key] = "Shade[".($key+1)."] = ".$txtshadename[$i];
						break;
					}
				}
			}
			$same = true;
			for($i=0;$i<count($shade)-1;$i++) {
				if($shade[$i] != $shade[$i+1]) {
					$same = false;
					break;
				}
			}
			if($same) {
				$remove_shade = substr($remove_shade[0],11)."<br>";
			} else {
				$remove_shade = implode("<br>",$remove_shade)."<br>";
			}
			$remove_observation = $remove->Rs("ordr_observation");
			$teeth->BuildRemoveTeethFromText($typeofwork);
			
			$opt_mat = $teeth->ExportRemoveTeethOptionMaterialArray();
			$material = $teeth->ExportRemoveTeethMaterialArray();
			$attach_remove = $teeth->ExportRemoveTeethAttachmentText();
			foreach($material as $key => $value) {
				if($value != 0)
					$remove_material .= "[".$key."] : ".GetRemoveMaterialName($value,$opt_mat[$key])."<br>";
			}
			$remove_typeofwork = $remove_material."<br>".$attach_remove."<br>";
		
		
		
			$option_array = ParseOptionTextToArray($remove->Rs("ordr_option"));
			$remove_option = "";
			if($option_array != NULL) {
				$remove_option .=  isset($option_array["TPOrderAcrylic"]) ? ("TP Order Acrylic: ".$option_array["TPOrderAcrylic"]."<br>") : "";
				$remove_option .=  isset($option_array["TPOrderGrid"]) ? ("TP Order Grid: ".$option_array["TPOrderGrid"]."<br>") : "";
				$remove_option .=  isset($option_array["RPDAcrylic"]) ? ("RPD Acrylic For Finish: ".$option_array["RPDAcrylic"]."<br>") : "";
				$remove_option .= isset($option_array["TeethSetup"]) ? ("Teeth Setup: ".$option_array["TeethSetup"]."<br>") : "";
				$remove_option .=  isset($option_array["GumFit"]) ? ("Gum Fit: ".$option_array["GumFit"]."<br>") : "";
				$remove_option .=  isset($option_array["SpecialTray"]) ? ("Special Tray: ".$option_array["SpecialTray"]."<br>") : "";
				$remove_option .=  isset($option_array["WireStrengthener"]) ? ("Wire Strengthener: ".(($option_array["WireStrengthener"] == 1) ? "Yes" : "No")."<br>") : "";
				
				if(count($option_array["SpecialTrayBiteBlock"])>0) {
					$txt = array(); $i=0;
					foreach ($option_array["SpecialTrayBiteBlock"] as $key => $value) { 
						$txt[$i++] .= "$key" ;
					}
					$remove_option .=  "Special Tray, Bite Block: ".implode(", ",$txt)."<br>";
				}
				if(count($option_array["SpecialRequest"])>0) {
					$txt = array(); $i=0;
					foreach ($option_array["SpecialRequest"] as $key => $value) { 
						$txt[$i++] .= "$key" ;
					}
					$remove_option .=  "Special Request: ".implode(", ",$txt)."<br>";
				}
			} else {
				$remove_option = "-";
			}	
		}
	}
}
?>