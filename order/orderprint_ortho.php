<? include_once("../core/default.php"); ?>
<? include_once("../order/inc_shade.php"); ?>
<? include_once("../order/inc_getstring.php"); ?>



<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />




<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="print">
<tr><td width="50%" height="700" align="center" valign="top" bgcolor="#FFFFFF">
<table width="350" border="0" cellpadding="2" cellspacing="0" class="print">
  <tr>
    <td colspan="2" align="left"><font face="IDAutomationHC39M" style="font-size:14px"><?="*".$data_eorder->Rs("ord_code")."*";?></font>&nbsp;&nbsp;<span class="SBig"><?=$data_eorder->Rs("ord_priority");?></span></td>
    </tr>
  <tr>
    <td colspan="2"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="70" align="left"><strong>Code </strong></td>
        <td align="left"><strong>
          <?=$data_eorder->Rs("ord_code");?>
        </strong></td>
      </tr>
      <tr>
        <td width="70" align="left" class="HI">Cus</td>
        <td align="left"><?=$data_eorder->Rs("cus_name");?></td>
      </tr>
	  <tr>
        <td width="70" align="left" class="HI">Agent</td>
        <td align="left"><?=$data_eorder->Rs("agn_name");?></td>
      </tr>
      <tr>
        <td width="70" align="left" class="HI">Doc</td>
        <td align="left"><?=$data_eorder->Rs("doc_name");?></td>
      </tr>	    
      <tr>
        <td width="70" align="left" class="HI" style="">Pat</td>
        <td align="left" style=""><?=$data_eorder->Rs("ord_patientname");?></td>
      </tr>
      <tr>
        <td width="70" align="left" class="HI">Entry</td>
        <td align="left"><?=$data_eorder->Rs("ord_dated");?>
          <?=passThaiMonth($data_eorder->Rs("ord_datem"));?>
          <?=passThaiYear($data_eorder->Rs("ord_datey"));?>
          <?=$data_eorder->Rs("ord_datehh");?>:<?=$data_eorder->Rs("ord_datemm");?></td>
      </tr>
      <tr>
        <td align="left" class="HI">Trans</td>
            <td align="left"><?=$data_eorder->Rs("ord_inputdated");?>
                    <?=passThaiMonth($data_eorder->Rs("ord_inputdatem"));?>
                    <?=passThaiYear($data_eorder->Rs("ord_inputdatey"));?>
                    <?=$data_eorder->Rs("ord_inputdateh");?>:<?=$data_eorder->Rs("ord_inputdatemn");?>  <?=$user_creater?> </td>
      </tr>
      <tr>
        <td width="70" align="left" class="style1">Finish</td>
        <td align="left"><strong>
          <?=$data_eorder->Rs("ord_releasedated");?>
          <?=passThaiMonth($data_eorder->Rs("ord_releasedatem"));?>
          <?=passThaiYear($data_eorder->Rs("ord_releasedatey"));?>
          <?=$data_eorder->Rs("ord_releasedateh");?>
          :
          <?=$data_eorder->Rs("ord_releasedatemn");?>
        </strong></td>
      </tr>
    </table></td>
    </tr>
  
  <tr>
    <td colspan="2"><hr></td>
    </tr>
<? if($ordoobservation!=''){ ?><tr><td colspan="2"><strong><pre><?=$ordoobservation?></pre></strong></td></tr><? } ?>    
  <tr>
    <td colspan="2" align="left">
	 <? if($ordtypeO){?>
<!--strong class="Big">--- Ortho order ---</strong-->
<table border="0" cellpadding="2" cellspacing="0" class="print">
<tr>
  <td width="100" class="style1"> Method</td>
  <td> <strong>
    <?=$ordomethod?>
  </strong></td>
</tr>
<!--tr>
  <td class="HI"> Box</td>
  <td> <?=$ordoboxcolor?></td></tr-->
<tr>
  <td valign="top" class="style1">Work</td>
  <td><strong><?=$ordowork!='-'?"$ordowork<br/>":""?><?=$ordoworkupper!='-'?"U: $ordoworkupper<br/>":""?><?=$ordoworklower!='-'?"L: $ordoworklower":""?></strong></td>
</tr>
<tr>
  <td valign="top" class="style1"> Color </td>
  <td><strong>
    <?=$ordoshade /*
  	$oldval = NULL;
	$ortho_shade = explode(",");
  	foreach($ortho_shade as $key => $value) {
		if($oldval==$value)continue;
 		echo "[".($key+1)."] = ".getShadeName($value)."<br>";
		$oldval=$value;
	}*/
  //var_dump($ordfshade);
  ?>
  </strong></td>
</tr>

<!--tr>
  <td valign="top" class="HI"> Observ..</td>
  <td><pre><?=$ordoobservation?></pre></td></tr-->
 </table>
<? }?>    <br />
<br /></td>
  </tr>
  <tr>
    <td colspan="2" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
</table></td>
  <td width="50%" align="center" valign="baseline" bgcolor="#FFFFFF"><table width="350" border="0" cellpadding="2" cellspacing="0" class="print">
    <tr>
      <td align="left">
      <? if(count($data_logbookAr)>1){ ?>
        <table width="100%" cellpadding="0" cellspacing="0">
        <? foreach($data_logbookAr as $data_logbookRow){ ?>
            <tr height="20">
              <td height="20"><span class="Normal"><?=$data_logbookRow['sec_room']?></span></td>
              <td height="20"><span class="Normal"><?=$data_logbookRow['stf_name']?></span></td>
              <td height="20"><span class="Normal"><?=$data_logbookRow['date']?></span></td>
              <td height="20"><span class="Normal"><?=$data_logbookRow['in']?></span></td>
              <td height="20"><span class="Normal"><?=$data_logbookRow['out']?></span></td>
              </tr>
           <? } ?>
          </table>
        <? }else{ ?>
      <table width="100%" border="0" cellpadding="3" cellspacing="0" class="printm">
          <tr>
            <td class="printm">Log-book,Model</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Prepare</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Wire Bending</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Wax - up</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Plaster Technique</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Solder,Welding</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Finishing Plate</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Bonding Pracket</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Transfer Tray</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Mouthguard</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Splint</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="printm">Model Show</td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>

          <tr>
            <td class="printm">Q.C. </td>
            <td class="printm">: ___________ __/__ __:__ __:__</td>
          </tr>
      </table>
      <? } ?>
        <br />
        <table width="100%" border="1" cellpadding="1" cellspacing="0" class="prints">
          <tr>
            <td align="center" class="prints">มาตรฐานคุณภาพ</td>
            <td colspan="2" align="center" nowrap="nowrap" class="prints">ผ่าน/ไม่</td>
            <td align="center" nowrap="nowrap" class="prints">ผู้ตรวจสอบ</td>
          </tr>
          <tr>
            <td class="prints">1. โมเดลสามารถทำงานได้ , ตรงกับใบสั่งงาน</td>
            <td width="20" class="prints">&nbsp;</td>
            <td width="20" class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">2. คำสั่งการผลิตถูกต้อง</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">3. วัตถุดิบในการผลิตอยู่ในกล่อง</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">4. ทำความสะอาด, Block-out,เขียนชื่อติดโมเดล,เข้า Artieulator,Duplicate</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">5. Design,ตำแหน่งของลวด (Wire)/ Soder</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">6. Design,ตำแหน่งของแว๊กส์ (Wax)</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">7. Design,ตำแหน่ง และ สีของ Plate</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">8. Design,ตำแหน่งของ Brackets</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">9. บันทึกข้อมูลในใบค่าการวัดตำแหน่ง</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">10. Scan, Save แล้ว ขนาด 97%</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">11. งาน Model Show ไม่กระดก ไม่มีรอย</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">12. ลวดไม่มีรอยกรอ Plate เรียบขึ้นเงา ไม่มีความคม Plate แนบไม่กระดก Occlusal Plane ถูกต้องตามคำสั่ง</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">13. งาน Mouth Guard, Splint, Bleaching Tray Night Guard แนบไม่กระดก กรอแต่งเรียบร้อย สีขนาดตรงคำสั่ง</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">14. QC เช็คความถูกต้องของงาน</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
          <tr>
            <td class="prints">15. Scan และ Save ข้อมูล,ส่ง Packing</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
            <td class="prints">&nbsp;</td>
          </tr>
        </table>
        </td>
    </tr>
  </table></td>
</tr>

  <tr>
    <td height="200" colspan="2" align="left" valign="bottom"  bgcolor="#FFFFFF"><br />
        <table width="100%" border="1" cellpadding="1" cellspacing="0" bordercolor="#000000">
      <tr height="21">
        <td height="21" colspan="7" align="center" class="prints">Repair/Rework record for work in-process</td>
      </tr>
      <tr height="20">
        <td width="80" rowspan="2" align="center" valign="middle" class="prints">Date</td>
        <td rowspan="2" align="center" valign="middle" class="prints">Problem<br />
          ปัญหาที่พบ</td>
        <td height="20" colspan="2" align="center" valign="middle" class="prints">แก้ไขโดย</td>
        <td width="60" rowspan="2" align="center" valign="middle" class="prints">Detect by<br />
          ผู้ตรวจพบ</td>
        <td width="60" rowspan="2" align="center" valign="middle" class="prints">Supervisor<br />
          ผู้อนุมัติ</td>
        <td rowspan="2" align="center" valign="middle" class="prints">Cause of defect<br />
          สาเหตุของปัญหา</td>
      </tr>
      <tr height="20">
        <td width="30" height="20" align="center" valign="middle" class="prints">ซ่อม</td>
        <td width="30" align="center" valign="middle" class="prints">ทำใหม่</td>
      </tr>

<? 
  $rwdata = new Csql();
  $data_tmp = new Csql();
  
  $rwdata->Connect();
  $data_tmp->Connect();
  
  $rwdata->Query("select * from eorder_repairrework  where eorder_repairrework.eorder_id = $eorder_id order by eorder_repairrework.eorder_repairrework_date ");
  
  include_once("../textdb/eorder_repairrework_conftable.php");
  
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
  
  foreach($rwdataArList as $rwdataAr){ 
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
  </tr> <? } ?>
  
      <tr height="20">
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
      <tr height="20">
        <td height="20">&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
      </tr>
    </table>
      QF02-011 ( 05/06/2552 ครั้งที่แก้ไข : 1 )<br />
    HEXA CERAM CO.LTD</td>
  </tr>
</table>