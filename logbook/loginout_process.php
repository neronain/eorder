<?
	include_once("../core/default.php"); 
// IN
	$barcode 	= $_GET["barcode"];	
	$method 	= $_GET["METHOD"];	
	$step 		= $_GET["STEP"]+0;	
	$eorderid 	= $_GET["eorderid"]+0;	
	$filterroom 	= $_COOKIE["filterroom"];	
	
	$defectcode 	= $_GET["defectcode"];	
	
	GetVar($repair,"repair");
	GetVar($rework,"rework");
	GetVar($problem,"problem");
	GetVar($remark,"remark");
	
	
	//$logbookid = $_POST["logbookid"];
	//$section = $_POST["section"];
	
//DEFINE
	define("S_WAITORDER", 0);	
	define("S_WAITSTAFF", 1);	
	define("S_CHECKDB", 2);	
	define("S_CHECKTYPE", 3);	
	define("S_LOGOUT", 4);	
	define("S_LOGIN", 5);	
	define("S_CHECKSTAFF", 6);
	define("S_CHECKDEFECT", 7);
	define("S_DEFECTCODE", 8);
	define("S_WAITCONFIRMDEFECT", 9);
	define("S_CHECKCONFIRMDEFECT", 10);
	
	$enablefilter = false;
	if(!isset($filterroom)){$filterroom='';}
	
	$datetimenow = date('Y-m-d H:i:s');
	
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
						//error_log("S_WAITORDER ",3,"debug.log");
						if(strlen($barcode)>0 && substr($barcode,0,1)=='E'){
							$step = S_CHECKDB;
						}elseif(strlen($barcode)>0 && substr($barcode,0,2)=='DF'){
							$step = S_WAITORDER;						
							$msg = 'Insert E-Order code &gt;&gt;';
						}else{
							$step = S_WAITORDER;						
							$msg = 'Insert E-Order code &gt;&gt;';
						}
						break;
					case S_WAITSTAFF:
						//error_log("S_WAITORDER ",3,"debug.log");
						if(strlen($barcode)>0 && substr($barcode,0,1)=='E'){
							$step = S_CHECKDB;
						}elseif(strlen($barcode)>0 && substr($barcode,0,2)=='DF'){
							$step = S_CHECKDEFECT;
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
						//error_log("S_CHECKDB ",3,"debug.log");
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
							$staffid	= $data_logbook->Rs("logt_stf_id");
							$staffname	= $data_logbook->Rs("stf_name");
							$sectionid	= $data_logbook->Rs("logt_sec_id");
						}else{
							$data_logbook->Query("select eordertodayid from eordertoday
								where ordt_code='$barcode' limit 0,1");
							if($data_logbook->Count()>0){
								$eorderid 	= $data_logbook->Rs("eordertodayid");
								$step = S_WAITSTAFF;
								$msg = 'Insert "Staff/Defect-Code" &gt;&gt;';
								

								
								
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
									$msg = 'Insert "Staff/Defect-Code" &gt;&gt;';
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
						//error_log("S_CHECKTYPE ",3,"debug.log");
						//error_log("lasttype=".$type." ",3,"debug.log");
						if($type=="IN"){
							$step = S_LOGOUT;
						}else{
							$step = S_WAITSTAFF;
							$msg = 'Insert "Staff/Defect-Code" &gt;&gt;';
						}
						break;
					case S_CHECKSTAFF:
						//error_log("S_CHECKSTAFF ",3,"debug.log");
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
						//error_log("S_LOGOUT ",3,"debug.log");
						if($eorderid==0){$step = S_WAITORDER;$msg = '<font color="#FF0000">No E-order code</font>';break;}
						
						
						$data_logbook->Addnew();
						$data_logbook->TableName = "logbook";
						$data_logbook->Set("log_ord_id","$eorderid");
						$data_logbook->Set("log_stf_id","$staffid");
						$data_logbook->Set("log_sec_id","$sectionid");
						$data_logbook->Set("log_type","'OUT'");
						$data_logbook->Set("log_date","'$datetimenow'");
						$data_logbook->Update();
						
						
						$data_logbook->Query("select max(logbookid) as maxlog from logbook
							where log_ord_id=$eorderid and log_stf_id=$staffid and 
							log_sec_id=$sectionid and log_type='OUT'");
						$maxlog = $data_logbook->Rs("maxlog");
						//$maxlog = $data_logbook->GetInsertedID();
						
						
						$data_logbook->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");
						 						
						$data_logbook->Execute(" delete  logbookworking from logbookworking where logw_ord_id = $eorderid");
				
						include("logcountwork.php");
						
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
						//error_log("S_LOGIN ",3,"debug.log");
						if($eorderid==0){$step = S_WAITORDER;$msg = 'กรุณาใส่หมายเลข E-order';break;}
						$data_logbook->Addnew();
						$data_logbook->TableName = "logbook";
						$data_logbook->Set("log_ord_id","$eorderid");
						$data_logbook->Set("log_stf_id","$staffid");
						$data_logbook->Set("log_sec_id","$sectionid");
						$data_logbook->Set("log_type","'IN'");
						$data_logbook->Set("log_date","'$datetimenow'");
						$data_logbook->Update();
					
						$data_logbook->Query("select max(logbookid) as maxlog from logbook
							where log_ord_id=$eorderid and log_stf_id=$staffid and 
							log_sec_id=$sectionid and log_type='IN'");
						$maxlog = $data_logbook->Rs("maxlog");
						//$maxlog = $data_logbook->GetInsertedID();
						$data_logbook->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");
						 						
						$data_logbook->Execute(" delete  logbookworking from logbookworking where logw_ord_id = $eorderid");


						$data_logbook->Execute("update eorder set ord_status=3,
										ord_date = '$datetimenow',ord_processdate = '$datetimenow'
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
						$data_logbook->Set("logw_date","'$datetimenow'");
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
						
						
					case S_CHECKDEFECT:
						//error_log("S_CHECKDEFECT ",3,"debug.log");
						if($eorderid>0){
							$defectcode = $barcode;
							$step = S_WAITCONFIRMDEFECT;
							$msg = 'Insert "Staff-Code to confirm" &gt;&gt;';
						}else{
							$step = S_WAITORDER;
							$msg = 'Insert E-Order code &gt;&gt;';
						}
						break;
					case S_WAITCONFIRMDEFECT:
						//error_log("S_WAITCONFIRMDEFECT ",3,"debug.log");
						include_once("../textdb/eorder_repairrework_conftable.php");
						
						if(strlen($barcode)>0 && substr($barcode,0,1)=='E'){
							$step = S_CHECKDB;
						}elseif(strlen($barcode)>0 && substr($barcode,0,2)=='DF'){
							$defectcode = $barcode;
							$step = S_WAITCONFIRMDEFECT;
							$msg = 'Insert "Staff-Code to confirm" &gt;&gt;';
						}else if(strlen($barcode)>0){
							$step = S_CHECKCONFIRMDEFECT;
						}else{
							$msg = '<font color="#FF0000">หมายเลข staff ผิดพลาด!!</font>
							<script>setTimeout("writeit(\'messageBig\',\'สแกนหมายเลข Staff &gt;&gt;\')",4000);</script>
							';
							$step = S_WAITCONFIRMDEFECT;
						}
						break;
					case S_CHECKCONFIRMDEFECT:
						//error_log("S_CHECKCONFIRMDEFECT ",3,"debug.log");
						//barcode should be staff code
						$data_logbook->Query("select * from staff
								where stf_code='$barcode' limit 0,1");
						if($data_logbook->Count()>0){
							$staffid=$data_logbook->Rs("staffid");
							$sectionid=$data_logbook->Rs("stf_sec_id");
							$staffname=$data_logbook->Rs("stf_name");
							$step = S_DEFECTCODE;
						}else{
							$msg = '<font color="#FF0000">หมายเลข staff ผิด กรุณา scan ใหม่หรือ scan defectcode ใหม่ (ยกเลิกให้ scan eorder)</font>';
							$step = S_WAITCONFIRMDEFECT;
						}
						break;
					case S_DEFECTCODE:
						//error_log("S_DEFECTCODE ",3,"debug.log");
						include_once("../textdb/eorder_repairrework_conftable.php");
						

						
						$rwdata = new Csql();
						$rwdata->Connect();
						$rwdata->Addnew();
						$rwdata->TableName = "eorder_repairrework";
						$rwdata->Set("eorder_id","'$eorderid'");
						$rwdata->Set("eorder_repairrework_date","'$datetimenow'");
						$rwdata->Set("eorder_repairrework_defectcode","'$defectcode'");
						$rwdata->Set("eorder_repairrework_stf_id","'$staffid'");
						$rwdata->Set("eorder_repairrework_section_id","'$sectionid'");
						$rwdata->Set("eorder_repairrework_problem","'$problem'");
						$rwdata->Set("eorder_repairrework_repair","'$repair'");
						$rwdata->Set("eorder_repairrework_rework","'$rework'");
						//$rwdata->Set("eorder_repairrework_detectby","'$detectby'");
						//$rwdata->Set("eorder_repairrework_supervisor","'$supervisor'");
						$rwdata->Set("eorder_repairrework_remark","'$remark'");
						$rwdata->Update();
						
						
						
						$step = S_WAITORDER;
						$msg = '<font color="#3399FF">Defectcode '.$defectcode.$glo_defectcode_table[$defectcode]. ' confirmed <br>by '.$staffname.' </font>';
						
						break;
						
			
				}
				//error_log("\n",3,"debug.log");
			}while($step!=S_WAITORDER && $step!=S_WAITSTAFF && $step!=S_WAITCONFIRMDEFECT);
		
			if($eorderid>0){
				$defectSql = "select eorder_repairrework_defectcode from eorder_repairrework where eorder_id = $eorderid";
				$defectData = new Csql();
				$defectData->Connect();
				$defectData->Query($defectSql);
				if(!$defectData->EOF){
					include_once("../textdb/eorder_repairrework_conftable.php");
					while(!$defectData->EOF){
						$defectCodeAr[] = $defectData->Rs("eorder_repairrework_defectcode");
						$defectData->MoveNext();
					}
					$data_eorder = new Csql();
					$data_eorder->Connect();
					$data_eorder->Query("select ordt_code from eordertoday
									where eordertodayid=$eorderid limit 0,1");
					$ordt_code = $data_eorder->Rs("ordt_code");
					
					$msg .= '<br/><div style="display:block;margin:auto;padding:30px 10px;border:dashed 3px #FF0;width:80%;background:#F00;color: #FFF;">';
					$msg .= "โปรดระวัง $ordt_code มี Defect code<br/>";
					foreach($defectCodeAr as $defc){
						$msg .= $defc.':'.$glo_defectcode_table[$defc].'<br/>';
					}
					$msg .= '<a href="#" onclick="OpenDivShowSummary('.$eorderid.',\'repairrework\')" style="color:#FFF">คลิ๊กที่นี่เพื่อดูรายละเอียด</a>';
					$msg .= "</div>";
				}
			}
		
			//error_log("\n\n\n",3,"debug.log");
		}

	}
	
	
if(0){	?><head>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/default.js"></script>
<script src="../resource/javascript/ajax.js"></script>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>
	<?
}
	
	if($step==S_WAITCONFIRMDEFECT){
		$data_eorder = new Csql();
		$data_eorder->Connect();
		$data_eorder->Query("select * from eordertoday
				where eordertodayid='$eorderid' limit 0,1");
		
		
		?>
		
	<table width="100%" border="0" cellpadding="2" cellspacing="1" class="popBorder">
		<tr>
		<td rowspan="2" align="center" class="popHeader" style="font-size:12px">
<div align="center" id="messageBig">
            <font color="#000000"><?=$msg?></font>			
			</div> 
        Eorder:<?=$data_eorder->Rs('ordt_code')?> <?=$data_eorder->Rs('ordt_typeofwork')?>
			<br/>
    <table border="0" cellpadding="2" cellspacing="0" ><tr><td  class="popHeader" style="font-size:12px"><?=$defectcode?>:<?=$glo_defectcode_table[$defectcode]?></td><td  align="center" class="popHeader" style="font-size:12px">รายละเอียดเพิ่มเติม</td><td  class="popHeader"  align="center" style="font-size:12px">หมายเหตุ</td></tr>
    <tr>
    <td  class="popHeader" style="font-size:12px">
    
    <label><input name="chk_repair" type="checkbox" id="chk_repair" value="1" <?=$repair?'checked="checked"':''?> />ซ่อม
    </label><label>
      <input name="chk_rework" type="checkbox" id="chk_rework" value="1"  <?=$rework?'checked="checked"':''?>/>ทำใหม่
    </label>
    </td>
    <td><textarea name="tproblem" cols="20" rows="2" id="tproblem"><?=$problem?></textarea></td><td>
    <textarea name="tremark" cols="20" rows="2" id="tremark"><?=$remark?></textarea></td></tr></table>
     
    
    
		</td>
		<td width="220" height="30" align="center" class="popHeader">Scan หมายเลขผู้ตรวจพบ</td>
		</tr>
		<!--form action="../logbook/loginout_c.php" method="post" name="barcodeform" -->
		<input type="hidden" name="STEP" value="<?=$step?>" id="STEP">
		<input type="hidden" name="eorderid" value="<?=$eorderid?>" id="eorderid">
		<input type="hidden" name="defectcode" value="<?=$defectcode?>" id="defectcode">
		<tr>
		<td width="220" height="70" align="center" valign="middle" bgcolor="#FFFFFF" class="popNormal">
		<input name="barcode" type="text" id="barcode" onKeyDown="CheckKeyDown(event)"/>&nbsp;&nbsp;
		
		<input name="METHOD" type="submit" class="BTok" value="OK" id="barcodeok" onClick="SendRequest()"/>
		<input type="text" name="Stupid_IE_Bug" value="" style="width:0;visibility:hidden" ></td>
		</tr>
		<!--/form-->
		<? //onKeyDown="if(this.value.length==15){setFocus('barcodeok');barcodeform.submit();}" ?>
		</table>
		
		<?
		
		
		
	}else{
	
	
?>
        <table width="100%" border="0" cellpadding="2" cellspacing="1" class="popBorder">
          <tr>
            <td rowspan="2" align="center" class="popHeader" style="font-size:18px">
			<div align="center" id="messageBig">
            <font color="#000000"><?=$msg?></font>			
			</div>
			</td>
            <td width="220" height="30" align="center" class="popHeader">Stamp in-out</td>
          </tr>
		<!--form action="../logbook/loginout_c.php" method="post" name="barcodeform" -->
		<input type="hidden" name="STEP" value="<?=$step?>" id="STEP">
		<input type="hidden" name="eorderid" value="<?=$eorderid?>" id="eorderid">
		<input type="hidden" name="defectcode" value="<?=$defectcode?>" id="defectcode">
          <tr>
            <td width="220" height="70" align="center" valign="middle" bgcolor="#FFFFFF" class="popNormal">
			<input name="barcode" type="text" id="barcode" onKeyDown="CheckKeyDown(event)"/>&nbsp;&nbsp;

               <input name="METHOD" type="submit" class="BTok" value="OK" id="barcodeok" onClick="SendRequest()"/>
			   <input type="text" name="Stupid_IE_Bug" value="" style="width:0;visibility:hidden" ></td>
          </tr>
		  <!--/form-->
		  <? //onKeyDown="if(this.value.length==15){setFocus('barcodeok');barcodeform.submit();}" ?>
        </table>
        
        <? } ?>