<? /* */ 
	include_once("../eorder/eorder_remove_config.php") ;

	$teeth = new Teeth();
	if($ordtypeR){
		$teeth->BuildRemoveTeethFromText($data_eorder->Rs("ordr_typeofworkt"));
		
		$remove_material = $teeth->ExportRemoveTeethMaterialArray();
		$remove_attachment = $teeth->ExportRemoveTeethAttachmentArray();
		$remove_opt_mat = $teeth->ExportRemoveTeethOptionMaterialArray();		
		//var_dump($remove_opt_mat);
		//echo "XXX".$data_eorder->Rs("ordr_materialupper");
		$remove_typeofwork["upper"] = ExportRemoveMaterialTypeText($data_eorder->Rs("ordr_materialupper"));
		$remove_typeofwork["lower"] = ExportRemoveMaterialTypeText($data_eorder->Rs("ordr_materiallower"));		
		
		$remove_option = ParseOptionTextToArray($data_eorder->Rs("ordr_option"));	

		//var_dump($remove_typeofwork);
	}

	$shade = explode(",",$ordrshade);
	//$remove_shade[$key] = "[".($key+1)."] = ".$txtshadename[$i];
	
	//foreach($shade as $key => $value) {
		for($i=0;$i<count($txtshadename);$i++) {
			if($shade[0] == $txtshadeid[$i]) {
				$remove_shade = $txtshadename[$i];
				break;
			}
		}
	//}
	//$same = true;
	//for($i=0;$i<count($shade)-1;$i++) {
	//	if($shade[$i] != $shade[$i+1]) {
	//		$same = false;
	//		break;
	//	}
	//}
	//$remove_shade = $remove_shade[0];
	//if($same) {
	//	$remove_shade = substr($remove_shade[0],11);
	//} else {
	//	$remove_shade = implode("<br>",$remove_shade);
	//}

?>
<style>
.print{
	font-size:16px;
}
.prints{
	font-size:10px;
}
.SBig {
	font-size:42px;
	font-weight: bold;
}
.HI {
	font-size:16px;
	font-style: italic;
}
.H {
	font-size:14px;
}

.xsmall {font-size: 12px}
</style>
<style type="text/css" media="print">
div#teethbackground
{
    margin:0px;
    background-image:0px;;
}
</style>
<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="print">
  <tr>
    <td width="50%" height="750" align="center" valign="top" bgcolor="#FFFFFF"><table width="350" border="0" cellpadding="2" cellspacing="0" class="print">
      <tr>
        <td colspan="2" align="left"><font face="IDAutomationHC39M" style="font-size:14px"><?="*".$data_eorder->Rs("ord_code")."*";?></font>&nbsp;&nbsp;<span class="SBig">
            <?=$data_eorder->Rs("ord_priority");?>
          </span></td>
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
            <td width="70" align="left" class="HI">Pat</td>
            <td align="left"><?=$data_eorder->Rs("ord_patientname");?></td>
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
            <td width="70" align="left" class="HI"><strong>Finish</strong></td>
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
        <td colspan="2"><hr /></td>
      </tr>
<? if($ordrobservation!=''){ ?><tr><td colspan="2"><pre><?=$ordrobservation?></pre></td></tr><? } ?>
      <tr>
        <td colspan="2" align="left">
    
<!--strong class="Big">--- Remove order ---</strong-->
<table border="0" cellpadding="2" cellspacing="0" class="print">
<tr>
  <td colspan="2" align="left" valign="top" class="H">
  <strong>---------------------------<br />
  Upper - <?=$remove_typeofwork["upper"] ?><?=$remove_typeofwork["upper"]!='None' && $remove_option["Removework"]=='Repair'?'[Repair]':''?></strong><br>


<strong>  <?

	$remove_materialtext = "";
	$tmpremoveMaterial = array();
	foreach($remove_material as $key => $value) {
		if($value != 0 && $key<30) {
			//$remove_materialtext .= "[".$key."] : ".GetRemoveMaterialName($value,$remove_opt_mat[$key]);
			//$remove_materialtext .= "<br>";
			if(!is_array($tmpremoveMaterial[GetRemoveMaterialName($value,$remove_opt_mat[$key])])){
				$tmpremoveMaterial[GetRemoveMaterialName($value,$remove_opt_mat[$key])] = array();
			}
			array_push($tmpremoveMaterial[GetRemoveMaterialName($value,$remove_opt_mat[$key])],$key);
		}
	}
	foreach($tmpremoveMaterial as $material => $teeth) {
		$remove_materialtext .= "[".$material."] : ";
		foreach($teeth as $key => $number) {
			$remove_materialtext .= " $number ";
		}
		$remove_materialtext .= "<br/>";
	}
	
	echo $remove_materialtext;
/*
  
	$remove_materialtext = "";
	foreach($remove_material as $key => $value) {
		if($value != 0 && $key<30) {
			$remove_materialtext .= "[".$key."] : ".GetRemoveMaterialName($value,$remove_opt_mat[$key]);
			$remove_materialtext .= "<br>";
		}
	}
	
	
	echo $remove_materialtext;//*/
  ?>
 <?
	$attach = array(); $i=0;
	foreach($remove_attachment as $key => $value) {
		if($value != 0 && $key<30) {
			$attach[$i++] = $key;
		}
	}
	if(count($attach) > 0)
		echo "Upper Teeth Attachment: ".implode(",",$attach)."<br>";
  ?></strong>  ---------------------------<br />

  <strong>Lower - <?=$remove_typeofwork["lower"] ?><?=$remove_typeofwork["lower"]!='None' && $remove_option["Removework"]=='Repair'?'[Repair]':''?></strong><br>


  <? /*
	$remove_materialtext = "";
	foreach($remove_material as $key => $value) {
		if($value != 0 && $key>30) {
			$remove_materialtext .= "[".$key."] : ".GetRemoveMaterialName($value,$remove_opt_mat[$key]);
			$remove_materialtext .= "<br>";
		}
	}
	echo $remove_materialtext; */
  ?>  
 <strong><? 
	$remove_materialtext = "";
	$tmpremoveMaterial = array();
	foreach($remove_material as $key => $value) {
		if($value != 0 && $key>30) {
			//$remove_materialtext .= "[".$key."] : ".GetRemoveMaterialName($value,$remove_opt_mat[$key]);
			//$remove_materialtext .= "<br>";
			if(!is_array($tmpremoveMaterial[GetRemoveMaterialName($value,$remove_opt_mat[$key])])){
				$tmpremoveMaterial[GetRemoveMaterialName($value,$remove_opt_mat[$key])] = array();
			}
			array_push($tmpremoveMaterial[GetRemoveMaterialName($value,$remove_opt_mat[$key])],$key);
		}
	}
	foreach($tmpremoveMaterial as $material => $teeth) {
		$remove_materialtext .= "[".$material."] : ";
		foreach($teeth as $key => $number) {
			$remove_materialtext .= " $number ";
		}
		$remove_materialtext .= "<br/>";
	}
	
	echo $remove_materialtext;  
  ?>
  
  
  
   <?
	$attach = array(); $i=0;
	foreach($remove_attachment as $key => $value) {
		if($value != 0 && $key>30) {
			$attach[$i++] = $key;
		}
	}
	if(count($attach) > 0)
		echo "Lower Teeth Attachment: ".implode(",",$attach)."<br>";
  ?></strong> ---------------------------<br />  </td>
  </tr>
<tr>
  <td align="left" valign="top" class="HI">Type of work</td>
  <td align="left"><strong>
    <?=$remove_option["Removework"] ?>
  </strong></td>
</tr>
<tr>
  <td align="left" class="HI"> Shade </td>
  <td align="left"><strong>
    <?=$remove_shade?>
  </strong></td>
</tr>
<? if($remove_typeofwork["upper"][0]=="R" || $remove_typeofwork["lower"][0]=="R") { ?>

<tr>
  <td align="left" valign="top" class="HI">RPD-Acrylic</td>
  <td align="left"><strong>
    <?=$remove_option["RPDAcrylic"] ?>
  </strong></td>
</tr>

	<? if(count($remove_option["SpecialRequest"])>0){?>
    <tr>
      <td align="left" valign="top" class="HI">Special</td>
      <td align="left"><strong>
        <?
      foreach ($remove_option["SpecialRequest"] as $key => $value) { 
        echo "$key <br>" ;
      }?>
      </strong></td>
    </tr>
    <? }?>
<? } ?>
<? if($remove_typeofwork["upper"][0]=="T" || $remove_typeofwork["lower"][0]=="T") { ?>
<tr>
  <td align="left" valign="top" class="HI">TP-Acrylic</td>
  <td align="left"><strong>
    <?=$remove_option["TPOrderAcrylic"]?>
  </strong></td>
</tr>
<tr>
  <td align="left" valign="top" class="HI">TP-Order Grid</td>
  <td align="left"><strong>
    <?=$remove_option["TPOrderGrid"]?>
  </strong></td>
</tr>
<? } ?>
<? if($remove_typeofwork["upper"][0]=="R" || $remove_typeofwork["lower"][0]=="R"
|| $remove_typeofwork["upper"][0]=="T" || $remove_typeofwork["lower"][0]=="T"
) { ?>
<tr>
  <td align="left" valign="top" class="HI">Teeth Setup</td>
  <td align="left"><strong>
    <?=$remove_option["TeethSetup"]?>
  </strong></td>
</tr>
<tr>
  <td align="left" valign="top" class="HI">Gum fit</td>
  <td align="left"><strong>
    <?=$remove_option["GumFit"]?>
  </strong></td>
</tr>
<? }?>

<? if($remove_typeofwork["upper"][0]=="O" || $remove_typeofwork["lower"][0]=="O") { ?>
<tr>
  <td align="left" valign="top" class="HI">Wire Strengthener</td>
  <td align="left"><strong>
    <?=($remove_option["WireStrengthener"] == 1) ? "Yes" : "No"?>
  </strong></td>
</tr>
<tr>
  <td align="left" valign="top" class="HI">Special option</td>
  <td align="left"><strong>
    <?=$remove_option["SpecialTray"]?>
    <br>
    <?
  //var_dump($remove_option);
  	if(count($remove_option["SpecialTrayBiteBlock"])>0)
      foreach ($remove_option["SpecialTrayBiteBlock"] as $key => $value) { 
        echo "$key <br>" ;
	}?>
  </strong></td>
</tr>
<? }?>

<!--tr>
  <td align="left" valign="top" class="HI"> Observ </td>
  <td align="left"><pre><?=$ordrobservation?></pre></td></tr-->
</table>
<br></td>
      </tr>
      <tr>
        <td colspan="2" align="left">
        
<table border="1" bordercolor="#000000" cellspacing="0" cellpadding="2" 
width="100%">
              <tr>
                <td><table width="100%" cellpadding="1" cellspacing="0">
                    <tr>
                      <td class="HI"><strong>Enclosed / สิ่งที่ส่งมาด้วย</strong></td>
                    </tr>
                    <tr>
                      <td>
                      <table width="100%" cellpadding="2" cellspacing="0" >
                        <tr>
                          <td>
                          [<? if(in_array('upper_tray', $ordroptenclosed) || in_array('lower_tray', $ordroptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Tray                         </td>
                          <td>[<? if(in_array('upper_tray', $ordroptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] บน</td>
                          <td>[<? if(in_array('lower_tray', $ordroptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] ล่าง</td>
                        </tr>
                        <tr>
                          <td>[<? if(in_array('upper_special_tray', $ordroptenclosed) || in_array('lower_special_tray', $ordroptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Special Tray</td>
                          <td>[<? if(in_array('upper_special_tray', $ordroptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] บน</td>
                          <td>[<? if(in_array('lower_special_tray', $ordroptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] ล่าง</td>
                        </tr>
                        <tr>
                          <td>[<? if(in_array('bite_silicone', $ordroptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Bite-Silicone</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>[<? if(in_array('bite-wax', $ordroptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Bite-Wax</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>[<? if(in_array('upper_model', $ordroptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Model บน</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>[<? if(in_array('lower_model', $ordroptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Model ล่าง</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>Order __________________</td>
                          <td colspan="2">Box ____________</td>
                          </tr>
                        <tr>
                          <td colspan="3">หมายเหตุ ________________________________</td>
                          </tr>
                        <tr>
                          <td colspan="3">ผู้ตรวจสอบ _______________________________</td>
                          </tr>
                      </table>
                      </td>
                    </tr>
                </table></td>
              </tr>
            </table>        
        </td>
      </tr>
      <tr>
        <td colspan="2" align="left"></td>
      </tr>
    </table>    </td>
    <td width="50%"  align="center" valign="top" bgcolor="#FFFFFF"><table width="350" border="0" cellpadding="2" cellspacing="0" class="print">
      <tr>
        <td colspan="2" align="left"><img src="../resource/images/eorder/teeth.png" width="335" height="367" /></td>
      </tr>
      <tr>
        <td colspan="2" align="left">
        
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
        
        <table width="100%" border="0" cellpadding="3" cellspacing="0" class="print">
          <tr>
            <td class="xsmall">Model</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Bite Block</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Design</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Duplicate</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Wax Patturn</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Grinding</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Shade</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Mounting</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Set-up teeth</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Gum work</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Flask</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Silicone</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">กรอ+Polishing Finish</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Ace/Wax</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Ace/Vital</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Finish Ace</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Finish Vital</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
          <tr>
            <td class="xsmall">Q.C. Finish</td>
            <td class="xsmall">: ___________ __/__ __:__ __:__</td>
          </tr>
        </table>
        <? } ?>
        
        </td>
      </tr>
      
      <tr>
        <td colspan="2"><hr /></td>
      </tr>
      <!--tr>
        <td colspan="2"><br />
        <div id="teethbackground">
            <table border="0" cellpadding="0" cellspacing="0" background="../resource/images/eorder/teeth.png" >
              <tr>
                <td width="165" height="192" align="right"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["11"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="4" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["12"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="36" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["13"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="68" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["14"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="86" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32"><img src="<?=GetRemoveMaterialImage($remove_material["15"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="102" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["16"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="114" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["17"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="122" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="right"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["18"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="130" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
                <td width="165" height="192"><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="4">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["21"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="36">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["22"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="68">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["23"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="86" height="28">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["24"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="102">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["25"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="114">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["26"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="122">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["27"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="130">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["28"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td height="15">&nbsp;</td>
                <td height="15">&nbsp;</td>
              </tr>
              <tr>
                <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="32" align="right"><table border="0" cellpadding="0" cellspacing="0">
                          <tr>
                            <td align="right"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["38"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="130" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["37"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="122" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["36"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="114" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32"><img src="<?=GetRemoveMaterialImage($remove_material["35"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="102" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["34"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="86" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["33"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="68" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["32"]) ?>" width="32" height="32"  /></td>
                                </tr>
                            </table></td>
                            <td width="36" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td align="center"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["31"]) ?>" width="32" height="32"  /> </td>
                                </tr>
                            </table></td>
                            <td width="4" height="32">&nbsp;</td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
                <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="130">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["48"]) ?>" width="32" height="32"  /> </td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="122">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["47"]) ?>" width="32" height="32"  /> </td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="114">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["46"]) ?>" width="32" height="32"  /> </td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="102">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["45"]) ?>" width="32" height="32"  /> </td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="86" height="28">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["44"]) ?>" width="32" height="32"  /> </td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="68">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["43"]) ?>" width="32" height="32"  /> </td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="36">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["42"]) ?>" width="32" height="32"  /> </td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                    <tr>
                      <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="4">&nbsp;</td>
                            <td height="32"><table border="0" cellspacing="0" cellpadding="0" >
                                <tr>
                                  <td width="32" height="32"><img src="<?=GetRemoveMaterialImage($remove_material["41"]) ?>" width="32" height="32"  /> </td>
                                </tr>
                            </table></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
              </tr>
          </table>
          </div>          </td>
      </tr -->
    </table></td>
  <tr>
    <td height="200" align="left" valign="bottom"  bgcolor="#FFFFFF" colspan="2">
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
    QF02-010 ( 05/06/2552 ครั้งที่แก้ไข : 1 )<br />
    HEXA CERAM CO.LTD</td>
  </tr>
</table>
