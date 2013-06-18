<?
/*
$sql = "select eordertodayid from eordertoday where eordertodayid=$eorderid 
and datediff(curdate(),date(ordt_releasedate))>7";
$data_logbook->Query($sql);
if($data_logbook->Count()){
	$sql = "select eorderwarningid from eorderwarning where eorderwarningid=$eorderid";
	$data_logbook->Query($sql);
	if($data_logbook->Count()==0){
		$data_logbook->Execute("insert into eorderwarning values($eorderid)");
	}
}
*/
/*
$eorderid
$staffid
$sectionid
$maxlog
*/

	$data_logbook = new Csql();
	$data_logbook->Connect();
	$data_logbook->Query("select * from logcount where logcount_log_id = $eorderid and logcount_stf_id = $staffid");
	if($data_logbook->EOF){
		
		include_once "../eorder/eorder_fix_config.php";
		include_once "../eorder/eorder_remove_config.php";
		
		global $fixmaterial_name;
		global $fixmaterial_idvalue;
		global $fixmaterial_option_value;
		global $fixmaterial_option_sname;
		
		$logcountIns = array();
		
		//echo "<pre>";
		$data_eorder = new Csql();
		$data_eorder->Connect();
		$eorderRecode = $data_eorder->ExecuteARecord("select * from eorder where eorderid = $eorderid");
		//var_dump($eorderRecode);
	
		$eorderFixRecode = $data_eorder->ExecuteARecord("select * from eorder_fix where eorder_fixid = $eorderid");
		if($eorderFixRecode!=NULL){
			$type = 'FIX';
			$method = $eorderFixRecode['ordf_method'];
			
			$explodeTeeth = explode((","),$eorderFixRecode['ordf_typeofworkt']);
			foreach($explodeTeeth as $tmp){
				$explodeTeeth2 = explode(("-"),$tmp);
				foreach($explodeTeeth2 as $teethSet){
					//echo ''.$teethSet[1].'+ ';
					if($teethSet[1]!=''){
						$teeth = Tooth::ParseTextToNumber($teethSet[0]);
						$mat_id = Tooth::ParseAsciiToInteger($teethSet[1]);
						$opt = Tooth::ParseAsciiToInteger($teethSet[2]);
						

						
						for($i=0;$i<count($fixmaterial_name);$i++){
							if($mat_id == $fixmaterial_idvalue[$i]){
								
								$mat_short = $fixmaterial_shortname[$i];
								
								$opttext = "";
								//var_dump($opt);
								//var_dump($removematerial_option_sname[$i]);
								if(count($fixmaterial_option_value[$i])>0){
									//echo "count[/]";
									for($j=0;$j<count($fixmaterial_option_value[$i]);$j++){
										//echo "check".$removematerial_option_value[$i][$j];
										if($opt == $fixmaterial_option_value[$i][$j]){
											$opttext = $fixmaterial_option_sname[$i][$j];
										}
									}
								}
								//echo($opttext);
								/*$opttext  = str_replace("[W]"," - Wire reinforced",$opttext);
								$opttext  = str_replace("[P]"," - Post core",$opttext);
								$opttext  = str_replace("[CL]"," - CL",$opttext);
								$opttext  = str_replace("[P+CL]"," - Postcore + CL",$opttext);
								$opttext  = str_replace("[IM]"," - Implant",$opttext);
								$opttext  = str_replace("[R]"," - Richmond",$opttext);*/
						
								$mat_full =  $fixmaterial_shortname[$i].$opttext;
							}
						}			
	
						
						$logcountIns[] = array('type'=>$type,'method'=>$method,'teeth'=>$teeth,'mat_short'=>$mat_short,'mat_full'=>$mat_full);
						
						
					}
				}
			}
			
		}
		
		$eorderRemoveRecode = $data_eorder->ExecuteARecord("select * from eorder_remove where eorder_removeid = $eorderid");
		//var_dump($eorderRemoveRecode);
		if($eorderRemoveRecode!=NULL){
			$type = 'REMOVE';
			$teeth = '';
			$method = $eorderRemoveRecode['ordr_method'];
			
			$matUP = $eorderRemoveRecode['ordr_materialupper'];
			$matLO = $eorderRemoveRecode['ordr_materiallower'];
			
			if($matUP=='' && $matLO==''){
				$logcountIns[] = array('type'=>$type,'method'=>$method,'teeth'=>$teeth,'mat_short'=>'None','mat_full'=>'None');
			}else{
				if($matUP!='' && $matUP[0]!='0' ){		
					$mat_short = ExportRemoveMaterialTypeMain($matUP);
					$mat_full = ExportRemoveMaterialTypeText($matUP);
					$logcountIns[] = array('type'=>$type,'method'=>$method,'teeth'=>$teeth,'mat_short'=>$mat_short,'mat_full'=>$mat_full);
				}
							
				if($matLO!='' && $matLO[0]!='0'){
					$mat_short = ExportRemoveMaterialTypeMain($matLO);
					$mat_full = ExportRemoveMaterialTypeText($matLO);
					$logcountIns[] = array('type'=>$type,'method'=>$method,'teeth'=>$teeth,'mat_short'=>$mat_short,'mat_full'=>$mat_full);
				}
			}
			
		}
		
		
		$eorderOrthoRecode = $data_eorder->ExecuteARecord("select * from eorder_ortho where eorder_orthoid = $eorderid");
		
		if($eorderOrthoRecode!=NULL){
			$type = 'ORTHO';
			$teeth = '';
			$method = $eorderOrthoRecode['ordo_method'];

			if($eorderOrthoRecode['ordo_work']=='-' && $eorderOrthoRecode['ordo_workupper']=='-' && $eorderOrthoRecode['ordo_worklower']=='-'){
				$logcountIns[] = array('type'=>$type,'method'=>$method,'teeth'=>$teeth,'mat_short'=>'None','mat_full'=>'None');
			}else{
				$mat_short =  $eorderOrthoRecode['ordo_work'];
				$mat_full =  $eorderOrthoRecode['ordo_work'];
				if($mat_short!='-'){
					$logcountIns[] = array('type'=>$type,'method'=>$method,'teeth'=>$teeth,'mat_short'=>$mat_short,'mat_full'=>$mat_full);
				}
				
				$mat_short =  $eorderOrthoRecode['ordo_workupper'];
				$mat_full =  $eorderOrthoRecode['ordo_workupper'];
				if($mat_short!='-'){
					$logcountIns[] = array('type'=>$type,'method'=>$method,'teeth'=>$teeth,'mat_short'=>$mat_short,'mat_full'=>$mat_full);
				}
				
				$mat_short =  $eorderOrthoRecode['ordo_worklower'];
				$mat_full =  $eorderOrthoRecode['ordo_worklower'];
				if($mat_short!='-'){
					$logcountIns[] = array('type'=>$type,'method'=>$method,'teeth'=>$teeth,'mat_short'=>$mat_short,'mat_full'=>$mat_full);
				}
			}
			
		}
		
		
		
		
		
		
		//$logcountIns[] = array('type'=>'','method'=>'','mat_short'=>'','mat_full'=>'');
		
		//var_dump($logcountIns);
		
		
		
		foreach($logcountIns as $insData){
		
			$type = $insData['type'];
			
			$method = $insData['method'];
			if($method=='Remake & Finish'){
				$method = 'Remake&Finish';
			}
			$teeth = $insData['teeth'];
			$mat_short = $insData['mat_short'];
			$mat_full = $insData['mat_full'];
			
			$data_logbook->Addnew();
			$data_logbook->TableName = "logcount";
			$data_logbook->Set("logcount_date","'$datetimenow'");
			$data_logbook->Set("logcount_log_id","$maxlog");
			$data_logbook->Set("logcount_ord_id","$eorderid");
			$data_logbook->Set("logcount_stf_id","$staffid");
			$data_logbook->Set("logcount_sec_id","$sectionid");
			$data_logbook->Set("logcount_type","'$type'");
			$data_logbook->Set("logcount_method","'$method'");
			$data_logbook->Set("logcount_teeth","'$teeth'");
			$data_logbook->Set("logcount_mat_short","'$mat_short'");
			$data_logbook->Set("logcount_mat_full","'$mat_full'");
			
			$data_logbook->Update();
		}
	}


/*








'Try-in','Contour','Finish','Repair','Remake','Finish after Try-in','Remake&Finish','BiteBox','BiteBlock','Setup','Remake&Finish'

 
logcountid` int(11) NOT NULL AUTO_INCREMENT,
`logcount_date` datetime NOT NULL,
`logcount_log_id` int(11) NOT NULL,
`logcount_ord_id` int(11) NOT NULL,
`logcount_stf_id` int(11) NOT NULL,
`logcount_sec_id` int(11) NOT NULL,
`logcount_type` enum('FIX','REMOVE','ORTHO') NOT NULL,
`logcount_method` enum('Try-in','Contour','Finish','Repair','Remake','Finish after Try-in','Remake&Finish','BiteBox','BiteBlock','Setup','Remake&Finish') NOT NULL,
`logcount_mat_short` enum('None','TmpRS','TmpCPS','WrRF','PFM','PF','FMC','P&C','In/On','CPS','PAlmn','PZirc','In-Cr','Cercon','Zeno-Tec','Csm-P','Captek','Substr','Tele-C','e-max','hx prss','Zir green','Zir hip','Express cosmo','TA','RPD','TP','Acetal','Hexa-Flex','Order spacial Tray','Bite Block','Order spacial Tray + Bite Block','Removeable bridge','Hawley retainer','Wraparound retainer','Bleaching tray','Night guard','Fashion removable plate') NOT NULL,
`logcount_mat_full` enum('None','TmpRS','TmpRS[W]','TmpRS[P]','TmpRS[P+CL]','TmpRS[IM]','TmpRS[PT]','TmpRS[R]','TmpCPS','TmpCPS[W]','TmpCPS[P]','TmpCPS[P+CL]','TmpCPS[IM]','TmpCPS[PT]','TmpCPS[R]','WrRF','PFM','PFM[P]','PFM[P+CL]','PFM[IM]','PFM[PT]','PFM[R]','PF','PF[P]','PF[P+CL]','PF[IM]','PF[PT]','PF[R]','FMC','FMC[P]','FMC[P+CL]','FMC[IM]','FMC[PT]','FMC[R]','P&C','P&C[CL]','In/On','CPS','CPS[P]','CPS[P+CL]','CPS[IM]','CPS[PT]','CPS[R]','PAlmn','PAlmn[P]','PAlmn[P+CL]','PAlmn[IM]','PAlmn[PT]','PAlmn[R]','PZirc','PZirc[P]','PZirc[P+CL]','PZirc[IM]','PZirc[PT]','PZirc[R]','In-Cr','In-Cr[P]','In-Cr[P+CL]','In-Cr[IM]','In-Cr[PT]','In-Cr[R]','Cercon','Cercon[P]','Cercon[P+CL]','Cercon[IM]','Cercon[PT]','Cercon[R]','Zeno-Tec','Zeno-Tec[P]','Zeno-Tec[P+CL]','Zeno-Tec[IM]','Zeno-Tec[PT]','Zeno-Tec[R]','Csm-P','Csm-P[P]','Csm-P[P+CL]','Csm-P[IM]','Csm-P[PT]','Csm-P[R]','Captek','Captek[P]','Captek[P+CL]','Captek[IM]','Captek[PT]','Captek[R]','Substr','Substr[P]','Substr[P+CL]','Substr[IM]','Substr[PT]','Substr[R]','Tele-C','Tele-C[P]','Tele-C[P+CL]','Tele-C[IM]','Tele-C[PT]','Tele-C[R]','e-max','e-max[P]','e-max[P+CL]','e-max[IM]','e-max[PT]','e-max[R]','hx prss','hx prss[P]','hx prss[P+CL]','hx prss[IM]','hx prss[PT]','hx prss[R]','Zir green','Zir green[P]','Zir green[P+CL]','Zir green[IM]','Zir green[PT]','Zir green[R]','Zir hip','Zir hip[P]','Zir hip[P+CL]','Zir hip[IM]','Zir hip[PT]','Zir hip[R]','Express cosmo','Express cosmo[P]','Express cosmo[P+CL]','Express cosmo[IM]','Express cosmo[PT]','Express cosmo[R]','TA','TA[P]','TA[P+CL]','TA[IM]','TA[PT]','TA[R]','RPD + Full Plate','RPD + Lingual Plate','RPD + Lingual Bar','RPD + Kennedy Bar','RPD + Palatal Stap (minimal coverage)','RPD + Skeleton Design','RPD + Horseshoe Plate','RPD + Ackers METAL','RPD + Rebase','RPD + Pepair','RPD + Adiunction','RPD + None','TP + Block Out & Duplicate Technique','TP + Full Denture','TP + Partial Denture','TP + Rebase','TP + Reline','TP + Addition','TP + Lingualized Occlusion','TP + Repair','Acetal + Acetal Tooth','Acetal + Acetal Clasp','Acetal + All Acetal Frame Work','Acetal + All Acetal Removable Bridge','Acetal + Acetal Swing Lock','Hexa-Flex + Partial Denture','Hexa-Flex + Removable Bridge','Hexa-Flex + Special Request','Order spacial Tray','Bite Block','Order spacial Tray + Bite Block','Removeable bridge','Hawley retainer','Wraparound retainer','Bleaching tray','Night guard','Fashion removable plate') NOT NULL
*/
