<? include_once("../core/default.php"); ?>
<?
	GetVar($eorder_id,"eorderid");
	GetVar($action,"action");
	GetVar($day,"day");
	GetVar($month,"month");
	GetVar($year,"year");
	GetVar($hr,"hr");
	GetVar($mn,"mn");
	GetVar($defectcode,"defectcode");
	GetVar($stf_code,"stf_code");
	GetVar($sec_id,"sec_id");
	GetVar($problem,"problem");
	GetVar($repair,"repair");
	GetVar($rework,"rework");
	GetVar($detectby,"detectby");
	GetVar($supervisor,"supervisor");
	GetVar($remark,"remark");
	GetVar($repairrework_id,"repairrework_id");
	
	$repair=="true"?$repair=1:$repair=0;
	$rework=="true"?$rework=1:$rework=0;
	
	include_once("../textdb/eorder_repairrework_conftable.php");	
	//echo "<pre>";
	//var_dump($_GET);
	//echo "</pre>";
	
	$date = $year."-".$month."-".$day." ".$hr.":".$mn;
	
	$rwdata = new Csql();
	$rwdata->Connect();
	
	$data_tmp = new Csql();
	$data_tmp->Connect();
	
	
	
 
	
	if($action == "add"){
		$tmpRow = $data_tmp->ExecuteARecord("select staffid,stf_name,stf_code from staff where stf_code = '{$stf_code}' limit 0,1");
		$stf_id = $tmpRow["staffid"];
		
		
		
		$rwdata->Addnew();
		$rwdata->TableName = "eorder_repairrework";
		$rwdata->Set("eorder_id","'$eorder_id'");
		$rwdata->Set("eorder_repairrework_date","'$date'");
		$rwdata->Set("eorder_repairrework_defectcode","'$defectcode'");
		$rwdata->Set("eorder_repairrework_stf_id","'$stf_id'");
		$rwdata->Set("eorder_repairrework_section_id","'$sec_id'");
		$rwdata->Set("eorder_repairrework_problem","'$problem'");
		$rwdata->Set("eorder_repairrework_repair","'$repair'");
		$rwdata->Set("eorder_repairrework_rework","'$rework'");
		$rwdata->Set("eorder_repairrework_detectby","'$detectby'");
		$rwdata->Set("eorder_repairrework_supervisor","'$supervisor'");
		$rwdata->Set("eorder_repairrework_remark","'$remark'");
		$rwdata->Update();
	}else if($action == "del"){
		$rwdata->Execute("delete from eorder_repairrework where eorder_repairrework_id = $repairrework_id ");
	}
	
		
	
	
	
	
	
	
	$rwdata->Query("select * from eorder_repairrework  where eorder_repairrework.eorder_id = $eorder_id order by eorder_repairrework.eorder_repairrework_date ");
//	$rwdata->Query("select * from eorder_repairrework  where eorder_repairrework.eorder_id = $eorder_id and section.sectionID = eorder_repairrework.eorder_repairrework_section_id order by eorder_repairrework.eorder_repairrework_date ");

	//echo($date);

	
	
	
	
	/*-------------- optimize -------------------*/
	
	$cache = array();
	$rwdataArList = array();
	
	while(!$rwdata->EOF){
		$rowAr = $rwdata->CurrentRowArray();
	
		$key = $rowAr['eorder_repairrework_stf_id'];
		if($cache['staff'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select stf_name,stf_code from staff where staffid = {$key} limit 0,1");
			$cache['staff'][$key] = $tmpRow;
		}
		$rowAr['staff_name'] = $cache['staff'][$key]["stf_name"];
		$rowAr['staff_code'] = $cache['staff'][$key]["stf_code"];
	
		$rwdataArList[] = $rowAr;
		$rwdata->MoveNext();
	
	}
	/*-------------- optimize -------------------*/
	
	$key = $userstfid;
	if($key!=NULL && $cache['staff'][$key]==NULL){
		$tmpRow = $data_tmp->ExecuteARecord("select stf_name,stf_code from staff where staffid = {$key} limit 0,1");
		$cache['staff'][$key] = $tmpRow;
	}
	$current_stf_code = $cache['staff'][$key]["stf_code"];
	
	
	
	
	
?>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellpadding="2" cellspacing="1" bordercolor="#000000" bgcolor="#000000">
  <tr bgcolor="#FFFFFF" height="21">
    <td height="21" colspan="9" align="center"><strong>Repair/Rework record for work in-process</strong></td>
  </tr>
  <tr bgcolor="#FFFFFF" height="20">
    <td width="200" rowspan="2" align="center" valign="middle" class="Normal">Date</td>
    <!--td rowspan="2" align="center" valign="middle">Section</td-->
    <td width="170" rowspan="2" align="center" valign="middle" class="Normal">Problem/ปัญหาที่พบ</td>
    <td height="20" colspan="2" align="center" valign="middle" class="Normal"> Correction Method/แก้ไขโดยวิธี</td>
    <td width="110" rowspan="2" align="center" valign="middle" class="Normal">Detectby<br />
    ผู้ตรวจพบ</td>
    <td width="110" rowspan="2" align="center" valign="middle" class="Normal">Supervisor<br />
    ผู้อนุมัติ</td>
    <td width="110" rowspan="2" align="center" valign="middle" class="Normal">Cause of defect<br />
    สาเหตุของปัญหา</td>
    <td rowspan="2" align="center" valign="middle" class="Normal">Edit</td>
  </tr>
  <tr height="20">
    <td width="110" height="20" align="center" valign="middle" bgcolor="#FFFFFF" class="Normal">Repair/ซ่อม</td>
    <td width="110" align="center" valign="middle" bgcolor="#FFFFFF" class="Normal">Rework/ทำใหม่</td>
  </tr>
 
  <? foreach($rwdataArList as $rwdataAr){ 
  	$defectcode = $rwdataAr["eorder_repairrework_defectcode"];
  	if($glo_defectcode_table[$defectcode]!=NULL){
  		$defectcode_text = $defectcode.":".$glo_defectcode_table[$defectcode];
  	}else{
  		$defectcode_text = "";
  	}
  	$problem = $defectcode_text.$rwdataAr["eorder_repairrework_problem"];
  	
  	?>
  <tr bgcolor="#FFFFFF" height="20">
    <td height="20" class="Normal"><?=$rwdataAr["eorder_repairrework_date"]?></td>
    <!--td><?=$rwdataAr["sec_type"]?>&nbsp;<?=$rwdataAr["sec_room"]?></td-->
    <td class="Normal"><?=$problem?></td>
    <td align="center" class="Normal"><?=$rwdataAr["eorder_repairrework_repair"]==1?"&#8226;":"";?></td>
    <td align="center" class="Normal"><?=$rwdataAr["eorder_repairrework_rework"]==1?"&#8226;":"";?></td>
    <td class="Normal"><?=$rwdataAr["staff_code"]?> <?=$rwdataAr["staff_name"]?> <?=$rwdataAr["eorder_repairrework_detectby"]?></td>
    <td class="Normal"><?=$rwdataAr["eorder_repairrework_supervisor"]?></td>
    <td class="Normal"><?=$rwdataAr["eorder_repairrework_remark"]?></td>
    <td align="center" class="Normal"
        onclick="showHTML('DivAjaxOrderSummary','../eorder/eorder_repairrework.php?eorderid=<?=$eorder_id?>&repairrework_id=<?=$rwdataAr["eorder_repairrework_id"]?>&action=del');	" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">Del</td>
  </tr> <? } ?>
  
  
  
  
  <tr bgcolor="#FFFFFF" height="20">
    <td height="20"  align="center" bgcolor="#F0FFEC" class="Normal"><? buildDateSelector('datecombo',date('d'),date('m'),date('Y'))?>      <br />
  <? buildTimeSelector('timecombo',date('H'),0)?>
  
    <? //  buildComboBoxList('stfsec','section order by sec_type,sec_room','sectionid',array('sec_type','sec_room'),$stfsec,'" style="width:180px') ?></td>
    <td bgcolor="#F0FFEC" class="Normal">
    <select id="tdefectcode">
    <? foreach($glo_defectcode_table as $defectcode => $defecttext ){?>
    <option value="<?=$defectcode?>"><?=$defectcode?>:<?=$defecttext?></option>
    <? } ?>
    <option value="OTHER">อื่นๆ</option>
    </select><br/>
    <textarea name="tproblem" cols="25" rows="3" id="tproblem"></textarea></td>
    <td align="center" bgcolor="#F0FFEC" class="Normal"><label>
      <input name="chk_repair" type="checkbox" id="chk_repair" value="1"  />
    </label></td>
    <td align="center" bgcolor="#F0FFEC" class="Normal"><label>
      <input name="chk_rework" type="checkbox" id="chk_rework" value="1"  />
    </label></td>
    <td bgcolor="#F0FFEC" class="Normal">
    Staff code: <input id="tstf_code" type="text"  value="<?=$current_stf_code?>" style="width:80px;"  /><br/>
    <textarea name="tdetectby" cols="15" rows="3"  id="tdetectby"></textarea></td>
    <td bgcolor="#F0FFEC" class="Normal"><textarea name="tsuper" cols="15" rows="3"  id="tsuper"></textarea></td>
    <td bgcolor="#F0FFEC" class="Normal"><textarea name="tremark" cols="20" rows="3" id="tremark"></textarea></td>
    <td align="center" class="Normal"
        onclick="showHTML('DivAjaxOrderSummary','../eorder/eorder_repairrework.php?eorderid=<?=$eorder_id?>&day='+getValue('datecombo_day')+'&month='+getValue('datecombo_month')+'&year='+getValue('datecombo_year')+'&hr='+getValue('timecombo_hour')+'&mn='+getValue('timecombo_minute')+'&problem='+encodeTH(getValue('tproblem'))+'&defectcode='+encodeTH(getValue('tdefectcode'))+'&repair='+document.getElementById('chk_repair').checked+'&rework='+document.getElementById('chk_rework').checked+'&stf_code='+encodeTH(getValue('tstf_code'))+'&detectby='+encodeTH(getValue('tdetectby'))+'&supervisor='+encodeTH(getValue('tsuper'))+'&remark='+encodeTH(getValue('tremark'))+'&action=add');	" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">Add</td>
  </tr>
</table>



