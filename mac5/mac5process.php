<?php
	include_once("../core/default.php");
	GetVar($act,"act");
	GetVar($eorderid,"eorderid");
	GetVar($id,"id");
	GetVar($index,"index");
	GetVar($code,"code");
	GetVar($note,"note");


	$doctype ='IS';


	$eorder = new Csql();
	$eorder->Connect();
	$eorder->Query("select * from eorder where eorderid=$eorderid limit 1");
	if($eorder->EOF) {exit("Invalid e-orderID $eorderid");}
	$ord_agn_id = $eorder->Rs("ord_agn_id");
	$ord_cus_id = $eorder->Rs("ord_cus_id");
	$ord_doc_id = $eorder->Rs("ord_doc_id");


	$agent = new Csql();
	$agent->Connect();
	$agent->Query("select * from agent where agentid=$ord_agn_id limit 1");
	if($agent->EOF) {exit("Invalid agent $ord_agn_id");}
	
	$doctor = new Csql();
	$doctor->Connect();
	$doctor->Query("select * from doctor where doctorid=$ord_doc_id limit 1");
	if($doctor->EOF) {exit("Invalid doctor $ord_agn_id");}




	
	$m5m = new Csql();
	$m5m->Query("select * from eorder_m5m where eorder_m5mid=$eorderid limit 1");
	if($m5m->EOF) {
		exit();
	}
	$m5m->TableName = "eorder_m5m";
	
	$m5m_date = date('d',DateMysqlToPHP($m5m->Rs("m5m_date")));
    $m5m_month = date('m',DateMysqlToPHP($m5m->Rs("m5m_date"))); 
    $m5m_year = date('Y',DateMysqlToPHP($m5m->Rs("m5m_date")));
	$m5m_cum_code = utf8_to_tis620($m5m->Rs("m5m_cum_code"));
	$m5m_pdcname = $m5m->Rs("m5m_pdcname");
	$m5m_pricegroup = $m5m->Rs("m5m_pricegroup");	
	$m5m->Set("m5m_note","'$note'");
	$m5m->Update();	
	
	
	
	if(substr($m5m->Rs('m5m_no'),0,1)=='H'){
		$doctype ='PS';
	}
	
	
	$DEB = new Msql();
	$DEB->Connect();
	$sql = "select  DEBcode,
	CAST(DEBnameT AS TEXT) AS DEBnameT,
	CAST(DEBadd1AT AS TEXT) AS DEBadd1AT,
	CAST(DEBadd2AT AS TEXT) AS DEBadd2AT,
	CAST(DEBadd3AT AS TEXT) AS DEBadd3AT,
	DEBzone,
	DEBcreditTerm
	
	from DEB where DEBcode = '$m5m_cum_code' ";	
	//echo $sql;
	$DEB->Query($sql);
	if($DEB->EOF) {exit("Invalid DEB $m5m_cum_code");}
	//$ord_cus_id = $eorder->Rs("ord_cus_id");
	
	
	$mih = new Msql();
	$mih->Connect();
	$sql = "select 
		
MIHday, 
MIHmonth, 
MIHyear,
MIHtype,
MIHvnos,
MIHcus,
MIHjob,
MIHdep,
MIHper,
MIHdoc,
MIHmec,
MIHvatNO,
CAST(MIHdesc AS TEXT) AS MIHdesc,
CAST(MIHmemo AS TEXT) AS MIHmemo,
CAST(MIHnotes AS TEXT) AS MIHnotes,
CAST(MIHref1 AS TEXT) AS MIHref1,
CAST(MIHref2 AS TEXT) AS MIHref2,
CAST(MIHref3 AS TEXT) AS MIHref3,

MIHcog,
MIHvatSUM,
MIHnetSUM,
MIHdiscLST,
MIHdiscHF1,
MIHdiscHF2,
CAST(MIHdiscHT1 AS TEXT) AS MIHdiscHT1,
CAST(MIHdiscHT2 AS TEXT) AS MIHdiscHT2,
MIHcurC,
MIHexchg

	
	 from MIH where 
		MIHday = $m5m_date and 
		MIHmonth = $m5m_month and  
		MIHyear = $m5m_year and 
		MIHtype = '{$doctype}' and 
		MIHvnos = '{$m5m->Rs('m5m_no')}' and 
		MIHcus = '{$m5m->Rs('m5m_cum_code')}'
		
		
	";
	$mih->Query($sql);
	//echo $sql;

	$mih->TableName = "MIH";
	
	
	
	$mie = new Msql();
	$mie->Connect();
	$sql = "select 

MIEday, 
MIEmonth, 
MIEyear,
MIEtype,
MIEvnos,
MIEcus,
MIErecDT3,
MIErecDT53,
MIErecDRND,
MIErecDEXG,
MIErecDCSH,
MIErecDOTH,
MIErecPLUS,
MIErecCASH,
MIErecCQRD,
CAST(MIEctermCX AS TEXT) AS MIEctermCX,
CAST(MIEctermPX AS TEXT) AS MIEctermPX,
CAST(MIEctermAX  AS TEXT) AS MIEctermAX,
CAST(MIEctermDX  AS TEXT) AS MIEctermDX,
MIEtag,
MIEbaseDT3,
MIEbaseDT53,
CAST(MIEdescDT3 AS TEXT) AS MIEdescDT3,
CAST(MIEdescDT53 AS TEXT) AS MIEdescDT53,
MIEconDT3,
MIEconDT53,
CAST(MIErecFC  AS TEXT) AS MIErecFC


	 from MIE where 
		MIEday = $m5m_date and 
		MIEmonth = $m5m_month and  
		MIEyear = $m5m_year and 
		MIEtype = '{$doctype}' and 
		MIEvnos = '{$m5m->Rs('m5m_no')}' and 
		MIEcus = '{$m5m->Rs('m5m_cum_code')}'
		
		
	";
	$mie->Query($sql);
	//echo $sql;

	$mie->TableName = "MIE";	
	
	
	$cfs = new Msql();
	$cfs->Connect();
	$sql = "select 


CFSvnosID, 
CFSdateID, 
CFScusID, 
CFStypeID, 
CAST(CFSjob AS TEXT) AS CFSjob, 
CAST(CFSdep AS TEXT) AS CFSdep, 
CAST(CFSper AS TEXT) AS CFSper, 
CAST(CFSdoc AS TEXT) AS CFSdoc, 
CAST(CFSmec AS TEXT) AS CFSmec, 
CFSsumREQ, 
CFSsumCUT1, 
CFSsumCUT2, 
CFSclearSUM, 
CFSclearUSER, 
CFSclearALL, 
CFScurC, 
CFSexchg, 
CFSbillCUT, 
CFSbillCLR

	 from CFS where 
		CFSdateID = '$m5m_year-$m5m_month-$m5m_date 00:00:00' and
		CFStypeID = '{$doctype}' and 
		CFSvnosID = '{$m5m->Rs('m5m_no')}' and 
		CFScusID = '{$m5m->Rs('m5m_cum_code')}'
		
		
	";
	$cfs->Query($sql);
	//echo $sql;

	$cfs->TableName = "CFS";		
	
	
	
	switch($act){
		case "show":
			break;
		
		case "send":


			$m5d = new Csql();
			$m5d->Query("select * from eorder_m5d where eorder_m5did=$eorderid ");
			$m5data = array();
			$MIHcog = 0;
			$summildis=0;
			while(!$m5d->EOF) {
				$index = $m5d->Rs("m5d_index");
				$m5data[$index]['m5d_pdc_code'] = $m5d->Rs("m5d_pdc_code");
				$m5data[$index]['m5d_pdc_name'] = $m5d->Rs("m5d_pdc_name");
				$m5data[$index]['m5d_pdc_unit'] = $m5d->Rs("m5d_pdc_unit");
				$m5data[$index]['m5d_vcol'] = $m5d->Rs("m5d_vcol");
				$m5data[$index]['m5d_qty'] = $m5d->Rs("m5d_qty");
				$m5data[$index]['m5d_price'] = $m5d->Rs("m5d_price");
				$m5data[$index]['m5d_discount'] = $m5d->Rs("m5d_discount");
				$m5data[$index]['m5d_linkvcid']= $m5d->Rs("m5d_linkvcid");
				
				
				$MIHcog+=$m5d->Rs("m5d_qty")*$m5d->Rs("m5d_price");
				$summildis+=$m5d->Rs("m5d_discount");
				
				$m5d->MoveNext();
			}

			
			$currency = substr($m5m->Rs('m5m_pricegroup'),0,3);
			//echo $currency;
			switch($currency){
				case "USD":
					$curC = 1;
					$exchg = $m5m->Rs('m5m_exchg');
					break;
				case "EUR":
					$curC = 2;
					$exchg = $m5m->Rs('m5m_exchg');
					break;
				case "GBP":
					$curC = 3;
					$exchg = $m5m->Rs('m5m_exchg');
					break;
				case "DEM":
					$curC = 4;
					$exchg = $m5m->Rs('m5m_exchg');
					break;
				case "JPY":
					$curC = 5;
					$exchg = $m5m->Rs('m5m_exchg');
					break;
				case "THB":
				default:
					$curC = 0;
					$exchg = 1;
					break;
			}			
			
			$MIHcogWithDiscount = $MIHcog-$summildis;
			

			$sumEXVAT = $MIHcogWithDiscount/1.07;
			
			// make 2 significant------
			$sumEXVAT = $sumEXVAT*100;
			$sumEXVAT = round($sumEXVAT);
			$sumEXVAT = $sumEXVAT/100;
			// ------------------------
			
			$vat = $MIHcogWithDiscount-$sumEXVAT;

			$revoke=0;
			if($MIHcogWithDiscount!=0){
				$revoke = $vat/$MIHcogWithDiscount*100;
			}


			

			$mil = new Msql();
			$mil->Connect();
			for($i=1;$i<9;$i++){
				
				$addwhere = " MILday = $m5m_date and 
					MILmonth = $m5m_month and  
					MILyear = $m5m_year and 
					MILtype = '{$doctype}' and 
					MILvnos = '{$m5m->Rs('m5m_no')}' and 
					MILcus = '{$m5m->Rs('m5m_cum_code')}' and
					MILlistNo = $i ";
				$sql = "select 
				
					MIlvnos
				
				
					from MIL,STK where 
					$addwhere and MILstk=STKcode ";
				$mil->Query($sql);
				//echo $sql;
				
				if($m5data[$i]['m5d_pdc_code']!=""){					
					if($mil->EOF) {
						$mil->AddNew();		
					}
					$mildis = $m5data[$i]['m5d_discount'];
					$milcog = "".($m5data[$i]['m5d_qty']*$m5data[$i]['m5d_price']);
					$milsum = "".($milcog-$mildis);
					$MILadisc = "".($vat*$milsum/($MIHcogWithDiscount));
					
					
					
					$mil->TableName = "MIL";
					$mil->Set("MILday","$m5m_date");
					$mil->Set("MILmonth","$m5m_month");
					$mil->Set("MILyear","$m5m_year");
					$mil->Set("MILtype","'{$doctype}'");
					$mil->Set("MIlvnos","'{$m5m->Rs('m5m_no')}'");
					$mil->Set("MIlcus","'{$m5m->Rs('m5m_cum_code')}'");
					$mil->Set("MILstk","'{$m5data[$i]['m5d_pdc_code']}'");
					$mil->Set("MILjob","''");
					$mil->Set("MILdep","''");
					$mil->Set("MILper","''");
					$mil->Set("MILdoc","''");
					$mil->Set("MILmec","''");
					$mil->Set("MILsto","'FG'");
					$mil->Set("MILstoMT","''");
					$mil->Set("MILlistNo","$i");
					$mil->Set("MILquan",$m5data[$i]['m5d_qty']);
					$mil->Set("MILquanP2","0");
					$mil->Set("MILadisc",$MILadisc+0);
					$mil->Set("MILcog",$milcog);
					$mil->Set("MILconv","1");
					$mil->Set("MILdiscA","$mildis");
					$mil->Set("MILdiscT","'".($milcog!=0?$mildis/$milcog*100:0)."'");
					$mil->Set("MILvat","0");
					$mil->Set("MILsum","$milsum");
					$mil->Set("MILcut","-1");
					$mil->Set("MILstype","1");
					$mil->Set("MILuname","'{$m5data[$i]['m5d_pdc_unit']}'");
					$mil->Set("MILdesc","'".utf8_to_tis620($m5data[$i]['m5d_pdc_name'])."'");
					$mil->Set("MILvCol1","'".utf8_to_tis620($m5data[$i]['m5d_vcol'])."'");
					$mil->Set("MILvCol2","''");
					$mil->Set("MILvCol3","''");
					$mil->Set("MILvCol4","''");
					$mil->Set("MILcurC","$curC");
					$mil->Set("MILexchg","$exchg");
					
					$mil->Set("MILacost","0");
					$mil->Set("MILpqm","0");
					$mil->Set("MILpmFrom","$i");
					$mil->Set("MILpmTo","$i");
					$mil->Set("MILtag","0");
					$mil->Set("MILlinkVCno","''");
					$mil->Set("MILlinkVCtype","''");
					$mil->Set("MILlinkVCdeposit","''");
					$mil->Set("MILlinkVCid","'{$m5data[$i]['m5d_linkvcid']}'"  );
					$mil->Set("MILclearUM","0");
					$mil->Set("MILnotes","''");
					$mil->Set("MILnotKL","0");


					
					
					
					
					$mil->Update("where $addwhere ");
				}else{
					if(!$mil->EOF) {
						$mil->Execute("delete from MIL where $addwhere ");
					}
				}
						
			}
			

			


			if($mih->EOF) {
				//echo "Adding....";
				$mih->AddNew();
				
				
				$vmp = new Msql();
				$vmp->Connect();
				$sql = "select 	* from VMP where VMmonth = $m5m_month and VMyear = $m5m_year";			
				$vmp->Query($sql);
				if($vmp->EOF) {
					$vmp->AddNew();
					$vmp->Set('VMARtotal','1');
					$vmp->Set('VMARinv','1');
				}else{	
					$vmp->Set('VMARtotal','VMARtotal+1');
					$vmp->Set('VMARinv','VMARtotal+1');
				}
				$vmp->TableName = "VMP";
				$vmp->update("where VMmonth = $m5m_month and VMyear = $m5m_year ");
				
			}else{
				//exit("Duplicate data");
			}
			$mih->TableName = "MIH";
			$mih->Set("MIHday","$m5m_date");
			$mih->Set("MIHmonth","$m5m_month");
			$mih->Set("MIHyear","$m5m_year");
			$mih->Set("MIHtype","'{$doctype}'");
			$mih->Set("MIHvnos","'{$m5m->Rs('m5m_no')}'");
			$mih->Set("MIHvatNO","'{$m5m->Rs('m5m_taxno')}'");
			$mih->Set("MIHcus","'{$m5m->Rs('m5m_cum_code')}'");
			$mih->Set("MIHref1","'".utf8_to_tis620($eorder->Rs('ord_no'))."'");
			$mih->Set("MIHref2","'".utf8_to_tis620($agent->Rs('agn_name'))."'");
			$mih->Set("MIHref3","'".utf8_to_tis620($doctor->Rs('doc_name'))."'");
			if($DEB->Rs('DEBzone')=='E'){
				$mih->Set("MIHdesc","'".utf8_to_tis620($eorder->Rs('ord_patientname'))."'");
			}else{
				$mih->Set("MIHdesc","'{$eorder->Rs('ord_no')}/".utf8_to_tis620($eorder->Rs('ord_patientname'))."(".utf8_to_tis620($doctor->Rs('doc_name')).")'");
			}
			
			$mih->Set("MIHnolist",count($m5data));

			$mih->Set("MIHdiscLST","'{$summildis}'");
			//echo $summildis;


			$mih->Set("MIHdiscHT1","'0'");
			$mih->Set("MIHdiscHT2","'{$revoke}'");
			$mih->Set("MIHdiscHF1","'0'");
			$mih->Set("MIHdiscHF2","'".($vat)."'");


			
			$mih->Set("MIHcog","'".$MIHcog."'");
			$mih->Set("MIHvatSUM","'".($vat)."'");
			$mih->Set("MIHnetSUM","'".($MIHcogWithDiscount)."'");



			

			$mih->Set("MIHcurC","$curC");
			$mih->Set("MIHexchg","$exchg");

			
			
			GetSession($MIHkeyUser,"username");
			$mih->Set("MIHkeyUser","'$MIHkeyUser'");
			$mih->Set("MIHkeyDate","getdate()");
			
			if($doctype=='PS'){
				$mih->Set("MIHdelvDate","getdate()");
			}

			$mih->Set("MIHisCF","0");
			$mih->Set("MIHextraMEM","''");
			$mih->Set("MIHrecNO","''");
			$mih->Set("MIHextraVAT","'0'");
			$mih->Set("MIHextraSUM","'0'");
			
			$mih->Set("MIHlinkGL","0");
			$mih->Set("MIHnoUPLINK","0");

			$mih->Set("MIHstanding","30");
			$mih->Set("MIHvatInList","0");
			$mih->Set("MIHlock","0");
			$mih->Set("MIHprintN","'0'");
			$mih->Set("MIHcheque","0");
			$mih->Set("MIHcancel","0");
			$mih->Set("MIHstatus","0");
			$mih->Set("MIHclearUM","0");
			$mih->Set("MIHctermNO","1");
			$mih->Set("MIHnotes","'".utf8_to_tis620($note)."'");
			


			

			$mih->Update("where MIHday = $m5m_date and 
				MIHmonth = $m5m_month and  
				MIHyear = $m5m_year and 
				MIHtype = '{$doctype}' and 
				MIHvnos = '{$m5m->Rs('m5m_no')}' and 
				MIHcus = '{$m5m->Rs('m5m_cum_code')}' ");
			
			
			
			
			
			if($mie->EOF) {
				//echo "Adding....";
				$mie->AddNew();
			}else{
				//exit("Duplicate data");
			}
			$mie->TableName = "MIE";
			
			
			
			
			
			$mie->Set("MIEday","$m5m_date");
			$mie->Set("MIEmonth","$m5m_month");
			$mie->Set("MIEyear","$m5m_year");
			$mie->Set("MIEtype","'{$doctype}'");
			$mie->Set("MIEvnos","'{$m5m->Rs('m5m_no')}'");
			$mie->Set("MIEcus","'{$m5m->Rs('m5m_cum_code')}'");
			
			
			
			$mie->Set("MIErecDT3","0");
			$mie->Set("MIErecDT53","0");
			$mie->Set("MIErecDRND","0");
			$mie->Set("MIErecDEXG","0");
			$mie->Set("MIErecDCSH","0");
			$mie->Set("MIErecDOTH","0");
			$mie->Set("MIErecPLUS","0");
			$mie->Set("MIErecCASH","0");
			$mie->Set("MIErecCQRD","0");
			
			$DEBcreditTerm = $DEB->Rs('DEBcreditTerm')+0;
			$nextcredit = mktime(0,0,0,$m5m_month,$m5m_date+$DEBcreditTerm,$m5m_year);
			
			$mie->Set("MIEctermCX","'$DEBcreditTerm|'");
			$mie->Set("MIEctermPX","'100|'");
			$mie->Set("MIEctermAX","'".($MIHcogWithDiscount)."|'");
			$mie->Set("MIEctermDX","'".date('d',$nextcredit)."/".date('m',$nextcredit)."/".date('Y',$nextcredit).""."|'");
			
			
			$mie->Set("MIEtag","0");
			$mie->Set("MIEbaseDT3","0");
			$mie->Set("MIEbaseDT53","0");
			$mie->Set("MIEdescDT3","''");
			$mie->Set("MIEdescDT53","''");
			$mie->Set("MIEconDT3","1");
			$mie->Set("MIEconDT53","1");
			$mie->Set("MIErecFC","''");
			



			

			$mie->Update("where MIEday = $m5m_date and 
				MIEmonth = $m5m_month and  
				MIEyear = $m5m_year and 
				MIEtype = '{$doctype}' and 
				MIEvnos = '{$m5m->Rs('m5m_no')}' and 
				MIEcus = '{$m5m->Rs('m5m_cum_code')}' ");
						
			
			

			
			
			if($cfs->EOF) {
				$cfs->AddNew();
				$cfs->TableName = "CFS";
				$cfs->Set("CFSsumCUT1","0"); 
				$cfs->Set("CFSsumCUT2","0"); 
				$cfs->Set("CFSclearSUM","0"); 
				$cfs->Set("CFSclearUSER","0");  
				$cfs->Set("CFSclearALL","0");  
				
				$cfs->Set("CFSbillCLR","0");
				$cfs->Set("CFSbillCUT","0");

			}else{
				$cfs->TableName = "CFS";
				
			}

			$cfs->Set("CFSvnosID","'{$m5m->Rs('m5m_no')}'"); 
			$cfs->Set("CFSdateID","'$m5m_year-$m5m_month-$m5m_date 00:00:00'"); 
			$cfs->Set("CFScusID","'{$m5m->Rs('m5m_cum_code')}'"); 
			$cfs->Set("CFStypeID","'{$doctype}'");
			$cfs->Set("CFSjob","''");
			$cfs->Set("CFSdep","''");
			$cfs->Set("CFSper","''");
			$cfs->Set("CFSdoc","''"); 
			$cfs->Set("CFSmec","''");
			
			$cfs->Set("CFScurC","$curC");
			$cfs->Set("CFSexchg","$exchg");
			$cfs->Set("CFSsumREQ","'".($MIHcogWithDiscount)."'");



			$cfs->Update("where 
				CFSdateID = '$m5m_year-$m5m_month-$m5m_date 00:00:00' and
				CFStypeID = '{$doctype}' and 
				CFSvnosID = '{$m5m->Rs('m5m_no')}' and 
				CFScusID = '{$m5m->Rs('m5m_cum_code')}' ");
						
/*
INSERT INTO CFS
                      (CFSvnosID, CFSdateID, CFScusID, CFStypeID, CFSjob, CFSdep, CFSper, CFSdoc, CFSmec, CFSsumREQ, CFSsumCUT1, CFSsumCUT2, CFSclearSUM, 
                      CFSclearUSER, CFSclearALL, CFScurC, CFSexchg, CFSbillCUT, CFSbillCLR)
SELECT     MIHvnos, '' + CONVERT(varchar(5), MIHyear) + '-' + RIGHT(REPLICATE('0', 2) + CONVERT(varchar(5), MIHmonth), 2) + '-' + RIGHT(REPLICATE('0', 2) 
                      + CONVERT(varchar(5), MIHday), 2) + ' 00:00:00' AS Expr1, MIHcus, 'IS' AS Expr2, '' AS Expr3, '' AS Expr4, '' AS Expr5, '' AS Expr6, '' AS Expr7, 
                      MIHnetSUM, 0 AS Expr8, 0 AS Expr9, 0 AS Expr10, 0 AS Expr11, 0 AS Expr12, MIHcurC, MIHexchg, 0 AS Expr13, 0 AS Expr14
FROM         MIH
WHERE     (MIHtype = 'IS') 
and MIHyear=2009 and MIHmonth>6
AND (MIHvnos NOT IN
                          (SELECT     CFSvnosID
                            FROM          CFS AS CFS_1))

*/			
			

						
			
			
			?>
            <input type="button" value="Reload data" onclick="OrderSummaryChangeTab('mac5');return false;" />
			<?
			break;
		
				
		

	}
	

?>