<? include_once("../core/default.php"); ?>
<? include_once("../order/inc_shade.php"); ?>
<? include_once("../order/inc_getstring.php"); ?>
<?
		
	if($ordtypeF) {
		$teeth->BuildFixTeethFromText($data_eorder->Rs("ordf_typeofworkt"));

		$fix_material = $teeth->ExportFixTeethMaterialArray();
		$fix_attachment = $teeth->ExportFixTeethAttachmentArray();
		$fix_stepbar = $teeth->ExportFixTeethStepBarArray();
		$fix_porcelain = $teeth->ExportFixTeethPorcelainArray();
		$fix_bridge = $teeth->ExportBridgeArray();
		$fix_bridgetext = $teeth->ExportBridgeText();
		$fix_opt_mat = $teeth->ExportFixTeethOptionMaterialArray();
		$fix_shade = explode(",",$ordfshade);

	}
	
	/*
	$rwdata = new Csql();
	$rwdata->Connect();
	
	$rwdata->Query("select * from eorder_repairrework , section where eorder_repairrework.eorder_id = $eorder_id and section.sectionID = eorder_repairrework.eorder_repairrework_section_id order by eorder_repairrework.eorder_repairrework_date ");
	*/
?>

<style>
.print{
	font-size:16px;
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
.Small {
	font-size:9px;
}
.prints {	font-size:10px;
}
</style>
<!-- Debug -->





<table width="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="print">
  <tr>
    <td width="50%" height="690" align="center" valign="top" bgcolor="#FFFFFF"><table width="350" border="0" cellpadding="2" cellspacing="0" class="print">
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
                    <?=$data_eorder->Rs("ord_inputdateh");?>:<?=$data_eorder->Rs("ord_inputdatemn");?> <?=$user_creater?> </td>
          </tr>
          <tr>
            <td width="70" align="left" class="HI"><strong>Finish</strong></td>
<td align="left"><strong>
                  <?=$data_eorder->Rs("ord_releasedated");?>
                    <?=passThaiMonth($data_eorder->Rs("ord_releasedatem"));?>
                    <?=passThaiYear($data_eorder->Rs("ord_releasedatey"));?>
                    <?=$data_eorder->Rs("ord_releasedateh");?>:<?=$data_eorder->Rs("ord_releasedatemn");?><?=$data_eorder->Rs("ord_shipmethod")!="NONE"?" by ".__($data_eorder->Rs("ord_shipmethod")):"";?>
</strong></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td ><hr /></td>
      </tr>

      <tr>
        <td colspan="2" align="left">

        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td class="HI"><strong>Alloy</strong></td>
            <td class="print"><strong>
              <?=getAlloyName($ordfalloy)?>
            </strong></td>
          </tr>
        </table>
        <table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
          <tr>
            <td width="25%" align="center" class="print"><span class="Small">After casting</span></td>
            <td width="25%" align="center" class="print">&nbsp;</td>
            <td width="25%" align="center" class="print"><span class="Small">After polishing</span></td>
            <td width="25%" align="center" class="print">&nbsp;</td>
          </tr>
        </table>        </td>
      </tr>
      <? if($ordfobservation!=''){ ?>
      <tr>
        <td colspan="2"><strong><pre><?=$ordfobservation?>
</pre></strong></td>
      </tr>
      <? } ?>      
      <tr>
        <td colspan="2" align="left"><? if($ordtypeF){?>
              <!--strong class="Big">--- Fix order ---</strong-->
              <table border="0" cellpadding="2" cellspacing="0" class="print">
                <tr>
                  <td colspan="3"><strong>---------------------------</strong><br />
                      <? 
  	$split=true;
	$fixbuildstring = array();
	$i=-1;
	//$fixbuildstring[0] = array();
	$fixbridgestack = array();
	foreach($fix_bridge as $key => $value) {
		if($value!=0){
			if($split){
				$split=false;
				$i++;
				$fixbuildstring[$i] = array();
			}
			$t1 = Tooth::ParseIndexToNumber($key);
			$t2 = Tooth::ParseIndexToNumber($key+1);
			if(!in_array($t1,$fixbuildstring[$i]))
				array_push($fixbuildstring[$i],$t1);
			if(!in_array($t2,$fixbuildstring[$i]))
				array_push($fixbuildstring[$i],$t2);
				
			if(!in_array($t1,$fixbridgestack))	array_push($fixbridgestack,$t1);
			if(!in_array($t2,$fixbridgestack))	array_push($fixbridgestack,$t2);

		}else{
			$split=true;
		}
	}
	
	
//	  var_dump($fix_bridgereduce);
	  //var_dump($fix_material);
	$fix_materialtext = "";
	$tmpFixMaterial = array();
	foreach($fix_material as $key => $value) {
		if($value != 0){// && $key<30) {
			if(!is_array($tmpFixMaterial[GetFixMaterialName($value,0)])){
				$tmpFixMaterial[GetFixMaterialName($value,0)] = array();
			}
			if(!in_array($key,$fixbridgestack)){
				array_push($tmpFixMaterial[GetFixMaterialName($value,0)],$key);
			}
		}
	}
	
	
	//echo "<pre>";
	// var_dump($fix_opt_mat);
	// echo "</pre>";

	foreach($tmpFixMaterial as $material => $teeth) {
		if(count($teeth)==0){ continue;}
		$fix_materialtext .= count($teeth)." [".$material."] # ";
		foreach($teeth as $key => $number) {
			$fix_materialtext .= " $number".GetFixMaterialOptionName($fix_material[$number],$fix_opt_mat[$number]).",";
		}
		$fix_materialtext .= "<br/>";
	}
	
	
	foreach($fixbuildstring as $bridge) {
		$fix_materialtext .= "1 Br. ";

		$tmpFixMaterial = array();
		foreach($fix_material as $key => $value) {
			if($value != 0){// && $key<30) {
				if(!is_array($tmpFixMaterial[GetFixMaterialName($value,0)])){
					$tmpFixMaterial[GetFixMaterialName($value,0)] = array();
				}
				if(in_array($key,$bridge)){
					array_push($tmpFixMaterial[GetFixMaterialName($value,0)],$key);
				}
			}
		}
		$i=0;
		foreach($tmpFixMaterial as $material => $teeth) {
			if($i>0)$fix_materialtext .="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$fix_materialtext .= count($teeth)." [".$material."] # ";
			foreach($teeth as $key => $number) {
				$fix_materialtext .= " $number".GetFixMaterialOptionName($fix_material[$number],$fix_opt_mat[$number]).",";
			}
			$fix_materialtext .= "<br/>";
			$i++;
		}
	}
	
	
	
	echo $fix_materialtext;
  ?>
                      <? //var_dump($tmpFixMaterial) ?>
                      <? //if(in_array(TRUE,$fix_bridge)){ ?>
                      <? //=$fix_bridgetext;?>
                      <? //} ?>
                      <?
	$attach = array(); $i=0;
	foreach($fix_attachment as $key => $value) {
		if($value != 0){// && $key<30) {
			$attach[$i++] = $key;
		}
	}
	if(count($attach) > 0)
		echo "Attachment: ".implode(",",$attach)."<br>";
  ?>
                      <strong>---------------------------</strong><br />                  </td>
                </tr>
                <!--tr>
                  <td class="HI">Box color</td>
                  <td colspan="2"><?=$ordfboxcolor?></td>
                </tr-->
                <tr>
                  <td class="HI"><strong> Method</strong>&nbsp;&nbsp;</td>
                  <td colspan="2"><strong>
                  <?=$ordfmethod?>
                  </strong></td>
                </tr>
                <!--tr>
  <td class="HI"> Box</td>
  <td> <?=$ordfboxcolor?></td></tr-->
                <tr>
                  <td class="HI" valign="top"> Shade </td>
                  <td width="32" valign="top"><img src="../resource/images/eorder/shadeguide.gif" width="32" height="32" /></td>
                  <td valign="top" style="font-size:12px"><?
  	//$oldval = NULL;
  	//foreach($fix_shade as $key => $value) {
		//if($oldval==$value)continue;
 	//	echo "[".($key+1)."] = ".getShadeName($value)."<br>";
		//$oldval=$value;
	//}
  //var_dump($ordfshadeoption);
  ?>
                      <?="[1] = ".getShadeName($fix_shade[0]).""?>
                      <br />
                      <?="[2] = ".getShadeName($fix_shade[1]).""?>
                      <br />
                      <?="[3] = ".getShadeName($fix_shade[2]).""?>
                      <br />
                      <? //=str_replace(",","<br>",$ordfshadeoption) ?>                  </td>
                </tr>
                <!--tr>
                  <td class="HI"> Alloy </td>
                  <td colspan="2"><?=getAlloyName($ordfalloy)?></td>
                </tr-->
                <tr>
                  <td class="HI"> Embras.. </td>
                  <td colspan="2"><?=$ordfembrasure?></td>
                </tr>
                <tr>
                  <td class="HI"> Pontic </td>
                  <td colspan="2"><img src="../resource/images/eorder/fix/fix_pontic<?=($ordfpontic)?>.gif" width="32" height="32" />
                      <?=strlen($ordfponticmm)>0?$ordfponticmm." mm":""?></td>
                </tr>
                <?  
  $marginvalue = getParameter($fix_prefix,"MGNO");
  $margintext = "No metal margin ". $marginvalue;
  
  if($marginvalue!=""){  ?>
                <tr>
                  <td class="HI"> Margin </td>
                  <td colspan="2"><?=$margintext?></td>
                </tr>
                <? } ?>
                <?  
  $marginvalue = getParameter($fix_prefix,"MGLM");
  $margintext = "Ligual metal margin : ". $marginvalue;
  
  if($marginvalue!=""){  ?>
                <tr>
                  <td class="HI"> Margin </td>
                  <td colspan="2"><?=$margintext?></td>
                </tr>
                <? } ?>
                <?  
  $marginvalue = getParameter($fix_prefix,"MGPO");
  $margintext = "Porcelain Margin : ". $marginvalue;
  
  if($marginvalue!=""){  ?>
                <tr>
                  <td class="HI"> Margin </td>
                  <td colspan="2"><?=$margintext?></td>
                </tr>
                <? } ?>
                <?  
  $marginvalue = getParameter($fix_prefix,"MGSM");
  $margintext = "Small matel margin around : ". $marginvalue;
  
  if($marginvalue!=""){  ?>
                <tr>
                  <td class="HI"> Margin </td>
                  <td colspan="2"><?=$margintext?></td>
                </tr>
                <? } ?>
                <?  
  $marginvalue = getParameter($fix_prefix,"MGHM");
  $margintext = "Hairline metal margin around : ". $marginvalue;
  
  if($marginvalue!=""){  ?>
                <tr>
                  <td class="HI"> Margin </td>
                  <td colspan="2"><?=$margintext?></td>
                </tr>
                <? } ?>
                <?  
  $marginvalue = getParameter($fix_prefix,"MGPL");
  $margintext = "Por. Margin + Lingual metal : ". $marginvalue;
  
  if($marginvalue!=""){  ?>
                <tr>
                  <td class="HI"> Margin </td>
                  <td colspan="2"><?=$margintext?></td>
                </tr>
                <? } ?>
                <?  
  $marginvalue = getParameter($fix_prefix,"MGPN");
  $margintext = "Por. Margin + No metal : ". $marginvalue;
  
  if($marginvalue!=""){  ?>
                <tr>
                  <td class="HI"> Margin </td>
                  <td colspan="2"><?=$margintext?></td>
                </tr>
                <? } ?>
                <?  
  $marginvalue = getParameter($fix_prefix,"MGPM");
  $margintext = "Por. Margin around : ". $marginvalue;
  
  if($marginvalue!=""){  ?>
                <tr>
                  <td class="HI"> Margin </td>
                  <td colspan="2"><?=$margintext?></td>
                </tr>
                <? } ?>
                <?  
  $marginvalue = getParameter($fix_prefix,"MGM1");
  $margintext = "Lingual Metal margin 1 mm : ". $marginvalue;
  
  if($marginvalue!=""){  ?>
                <tr>
                  <td class="HI"> Margin </td>
                  <td colspan="2"><?=$margintext?></td>
                </tr>
                <? } ?>
                <?  
  $marginvalue = getParameter($fix_prefix,"MGM5");
  $margintext = "Lingual Metal margin 0.5 mm : ". $marginvalue;
  
  if($marginvalue!=""){  ?>
                <tr>
                  <td class="HI"> Margin </td>
                  <td colspan="2"><?=$margintext?></td>
                </tr>
                <? } ?>
                <? if(count($ordfoptremark)+0>0 || count($ordfoptmoreinfo)+0>0){ ?>
                <tr>
                  <td valign="top" class="HI" colspan="3"> Option
                    <? if(count($ordfoptremark)+0>0){ ?>
                      <table border="1" bordercolor="#000000" cellspacing="0" cellpadding="2"
width="100%">
                        <tr>
                          <td align="left" valign="top"><strong>Remake</strong><br />
                              <?=in_array('ChangeShade', $ordfoptremark)?"-Change shade<br>":""?>
                              <?=in_array('ShortMargin', $ordfoptremark)?"-Short margin<br>":""?>
                              <?=in_array('AddContactPoint', $ordfoptremark)?"-Add contact point<br>":""?>
                              <?=in_array('RepairCeramic', $ordfoptremark)?"-Repair ceramic<br>":""?>
                              <?=in_array('CeramicCracked', $ordfoptremark)?"-Ceramic cracked<br>":""?>
                              <?=in_array('CanNotInsert', $ordfoptremark)?"-Can not insert<br>":""?>
                              <?=in_array('ChangeDesign', $ordfoptremark)?"-Change design<br>":""?>
                              <?=in_array('WrongBite', $ordfoptremark)?"-Wrong bite":""?></td>
                        </tr>
                      </table>
                    <? } ?>
                      <? if(count($ordfoptmoreinfo)+0>0){ ?>
                      <table border="1" bordercolor="#000000" cellspacing="0" cellpadding="2" 
width="100%">
                        <tr>
                          <td align="left" valign="top"><strong>Additional Info</strong><br />
                              <?=in_array('MarginGoDeep', $ordfoptmoreinfo)?"-Margin go deep inside the parodental pocket<br>":""?>
                              <?=in_array('UnderOcclusion05mm', $ordfoptmoreinfo)?"-Under occlusion 0.5mm<br>":""?>
                              <?=in_array('UnderOcclusion10mm', $ordfoptmoreinfo)?"-Under occlusion 1.0mm<br>":""?>
                              <?=in_array('UnderOcclusion20mm', $ordfoptmoreinfo)?"-Under occlusion 2.0mm<br>":""?>
                              <?=in_array('NoMetalMargin', $ordfoptmoreinfo)?"-No metal margin<br>":""?>
                              <?=in_array('SmallMetalMargin', $ordfoptmoreinfo)?"-Small metal margin<br>":""?>
                              <?=in_array('Metal margin 1 mm Lingual', $ordfoptmoreinfo)?"-Metal margin 1 mm Lingual<br>":""?>
                              <?=in_array('Metal margin 0.5 mm Lingual', $ordfoptmoreinfo)?"-Metal margin 0.5 mm Lingual<br>":""?>
                              <?=in_array('SmallMetalMarginAround', $ordfoptmoreinfo)?"-Small metal margin around<br>":""?>
                              <?=in_array('HairLineMetalMargin', $ordfoptmoreinfo)?"-Hair line metal margin<br>":""?>
                              <?=in_array('Hair line metal margin Lingual', $ordfoptmoreinfo)?"-Hair line metal margin Lingual<br>":""?>
                              <?=in_array('HairLineMetalMarginAround', $ordfoptmoreinfo)?"-Hair line metal margin around<br>":""?>
                              <?=in_array('LetSpaceBetweenTeeth', $ordfoptmoreinfo)?"-Let space between teeth<br>":""?>
                              <?=in_array('No approximal contact', $ordfoptmoreinfo)?"-No approximal contact<br>":""?>
                              <?=in_array('SmallTeeth', $ordfoptmoreinfo)?"-Small teeth<br>":""?>
                              <?=in_array('RestPrepareForRPDTP', $ordfoptmoreinfo)?"-Rest , Prepare for RPD/TP<br>":""?>
                              <?=in_array('AdeptWithRPDTP', $ordfoptmoreinfo)?"-Adept with RPD/TP<br>":""?>
                              <?=in_array('Adapt with RPD/TP', $ordfoptmoreinfo)?"-Adapt with RPD/TP<br>":""?>
                              <?=in_array('NoSpaceMakePF', $ordfoptmoreinfo)?"-No space make PF<br>":""?>
                              <?=in_array('NotHaveAnagonist', $ordfoptmoreinfo)?"-Not have anagonist<br>":""?>
                              <?=in_array('No anagonist', $ordfoptmoreinfo)?"-No anagonist<br>":""?>
                              <?=in_array('PorcelainMargin', $ordfoptmoreinfo)?"-Porcelain Margin<br>":""?>
                              <?=in_array('PorcelainMarginAround', $ordfoptmoreinfo)?"-Porcelain Margin around<br>":""?>
                              <?=in_array('PonticBuccalPalatalSmaller', $ordfoptmoreinfo)?"-Pontic buccal , palatal smaller than neighbour teeth<br>":""?>
                              <?=in_array('Crown endosed for shade/anatomy', $ordfoptmoreinfo)?"-Crown endosed for shade/anatomy<br>":""?>
                              <?=in_array('Bridge enclosed for shade/anatomy', $ordfoptmoreinfo)?"-Bridge enclosed for shade/anatomy<br>":""?>
                              <?=in_array('New Dentist', $ordfoptmoreinfo)?"-New Dentist<br>":""?>                          </td>
                        </tr>
                      </table>
                    <? } ?>                  </td>
                </tr>
                <? } ?>
                <!--tr>
  <td valign="top" class="HI"> Observ..</td>
  <td>&nbsp;</td>
  <td><pre><?=$ordfobservation?></pre></td></tr-->
              </table>
          <? }?> </td>
      </tr>
    </table></td>
    <td align="center" valign="top"><table width="350" border="0" cellpadding="2" cellspacing="0" class="print">
      <tr>
        <td colspan="2" align="left" valign="top">
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
        <table width="100%" cellpadding="0" cellspacing="0">
            <tr height="20">
              <td height="20">Model </td>
              <td><span class="Normal">: ___________ __/__ __:__</span><span class="Normal"> __:__</span></td>
              </tr>

            <tr height="20">
              <td height="20" colspan="2" align="right">[  ]Bite [     ]IMP [  ]2ndModel   [  ]____________</td>
              </tr>
            <tr height="20">
              <td height="20">QC </td>
              <td height="20"><span class="Normal">: ___________ __/__ __:__ __:__</span></td>
              </tr>
            <tr height="20">
              <td height="20">Implant </td>
              <td><span class="Normal">: ___________ __/__ __:__ __:__</span></td>
              </tr>
            <tr height="20">
              <td height="20">Wax </td>
              <td><span class="Normal">: ___________ __/__ __:__ __:__</span></td>
              </tr>
            <tr height="20">
              <td height="20">Metal </td>
              <td><span class="Normal">: ___________ __/__ __:__ __:__</span></td>
              </tr>
            <tr height="20">
              <td height="20">Cer/Opaque</td>
              <td><span class="Normal">: ___________ __/__ __:__ __:__</span></td>
              </tr>
            <tr height="20">
              <td height="20">Cer/Ceramic</td>
              <td><span class="Normal">: ___________ __/__ __:__ __:__</span></td>
              </tr>
            <tr height="20">
              <td height="20">Polishing </td>
              <td><span class="Normal">: ___________ __/__ __:__ __:__</span></td>
              </tr>
            <tr height="20">
              <td height="20">QC finish</td>
              <td> :<span class="Normal"> ___________ __/__ __:__ __:__</span></td>
              </tr>
          </table>
          <? } ?>
          <br />
          <br />
          <br />
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
                          [<? if(in_array('upper_tray', $ordfoptenclosed) || in_array('lower_tray', $ordfoptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Tray                         </td>
                          <td>[<? if(in_array('upper_tray', $ordfoptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] บน</td>
                          <td>[<? if(in_array('lower_tray', $ordfoptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] ล่าง</td>
                        </tr>
                        <tr>
                          <td>[<? if(in_array('upper_special_tray', $ordfoptenclosed) || in_array('lower_special_tray', $ordfoptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Special Tray</td>
                          <td>[<? if(in_array('upper_special_tray', $ordfoptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] บน</td>
                          <td>[<? if(in_array('lower_special_tray', $ordfoptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] ล่าง</td>
                        </tr>
                        <tr>
                          <td>[<? if(in_array('bite_silicone', $ordfoptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Bite-Silicone</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>[<? if(in_array('bite-wax', $ordfoptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Bite-Wax</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>[<? if(in_array('upper_model', $ordfoptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Model บน</td>
                          <td>&nbsp;</td>
                          <td>&nbsp;</td>
                        </tr>
                        <tr>
                          <td>[<? if(in_array('lower_model', $ordfoptenclosed)){ echo "&#8226;"; }else{ echo " "; } ?>] Model ล่าง</td>
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
            </table>          </td>
      </tr>
      
    </table></td>
  </tr>
  <? if($ordtypeF){?>
  <tr>
    <td height="200" colspan="2" align="left" valign="bottom"  bgcolor="#FFFFFF">
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
    
      QF02-009 ( 06/06/2552 ครั้งที่แก้ไข : 1 )<br />
    HEXA CERAM CO.LTD</td>
  </tr>
  
  <? }?>
</table>