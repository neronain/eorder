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
</style>






<table width="50%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF" class="print">
<tr><td height="700" align="center" valign="top" bgcolor="#FFFFFF">
<table width="350" border="0" cellpadding="2" cellspacing="0" class="print">
  <tr>
    <td colspan="2" align="left"><font face="IDAutomationHC39M" style="font-size:14px">*<?=$data_eorder->Rs("ord_code");?>*</font>&nbsp;&nbsp;<span class="SBig"><?=$data_eorder->Rs("ord_priority");?></span></td>
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
          <?=$data_eorder->Rs("ord_datehh");?>
          :
          <?=$data_eorder->Rs("ord_datemm");?></td>
      </tr>
      <tr>
        <td width="70" align="left" class="HI">Ship</td>
        <td align="left"><?=$data_eorder->Rs("ord_releasedated");?>
          <?=passThaiMonth($data_eorder->Rs("ord_releasedatem"));?>
          <?=passThaiYear($data_eorder->Rs("ord_releasedatey"));?>
          <?=$data_eorder->Rs("ord_releasedateh");?>
          :
          <?=$data_eorder->Rs("ord_releasedatemn");?></td>
      </tr>
    </table></td>
    </tr>
  
  <tr>
    <td colspan="2"><hr></td>
    </tr>
  <tr>
    <td colspan="2" align="left">
	 <? if($ordtypeF){?>
<strong class="Big">--- Fix order ---</strong>
<table border="0" cellpadding="2" cellspacing="0" class="print">
<tr>
  <td colspan="3">
    <strong>---------------------------</strong><br>


  <?
	$fix_materialtext = "";
	$tmpFixMaterial = array();
	foreach($fix_material as $key => $value) {
		if($value != 0){// && $key<30) {
			//$fix_materialtext .= "[".$key."] : ".GetFixMaterialName($value,$fix_opt_mat[$key]);
			//$fix_materialtext .= "<br>";
			if(!is_array($tmpFixMaterial[GetFixMaterialName($value,$fix_opt_mat[$key])])){
				$tmpFixMaterial[GetFixMaterialName($value,0)] = array();
				//$tmpFixMaterial[GetFixMaterialName($value,$fix_opt_mat[$key])] = array();
			}
			array_push($tmpFixMaterial[GetFixMaterialName($value,0)],$key);
			//array_push($tmpFixMaterial[GetFixMaterialName($value,$fix_opt_mat[$key])],$key);
		}
	}
	foreach($tmpFixMaterial as $material => $teeth) {
		$fix_materialtext .= "[".$material."] : ";
		foreach($teeth as $key => $number) {
			$fix_materialtext .= " $number".GetFixMaterialOptionName($fix_material[$number],$fix_opt_mat[$number])." ";
		}
		$fix_materialtext .= "<br/>";
	}
	
	echo $fix_materialtext;
  ?>
  <? //var_dump($tmpFixMaterial) ?>
  <? if(in_array(TRUE,$fix_bridge)){ ?>
  <?=$fix_bridgetext;?><br/>
  <? } ?>
  <?
	$attach = array(); $i=0;
	foreach($fix_attachment as $key => $value) {
		if($value != 0){// && $key<30) {
			$attach[$i++] = $key;
		}
	}
	if(count($attach) > 0)
		echo "Attachment: ".implode(",",$attach)."<br>";
  ?>  <strong>---------------------------</strong><br>  </td>
</tr>
<tr>
  <td class="HI">Box color</td>
  <td colspan="2"><?=$ordfboxcolor?></td>
</tr>
<tr>
  <td class="HI"> Method</td>
  <td colspan="2"> <?=$ordfmethod?></td>
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
  <?="[1] = ".getShadeName($fix_shade[0]).""?><br />
  <?="[2] = ".getShadeName($fix_shade[1]).""?><br />
  <?="[3] = ".getShadeName($fix_shade[2]).""?><br />
  <?=str_replace(",","<br>",$ordfshadeoption)?>  </td>
</tr>
<tr>
  <td class="HI"> Alloy </td>
  <td colspan="2"> <?=getAlloyName($ordfalloy)?></td>
  </tr>
<tr>
  <td class="HI"> Embras.. </td>
  <td colspan="2"> <?=$ordfembrasure?></td>
  </tr>
<tr>
  <td class="HI"> Pontic </td>
  <td colspan="2">
  <img src="../resource/images/eorder/fix/fix_pontic<?=($ordfpontic)?>.gif" width="32" height="32">
  <?=strlen($ordfponticmm)>0?$ordfponticmm." mm":""?></td>
  </tr>
            <? if(count($ordfoptremark)+0>0 || count($ordfoptmoreinfo)+0>0){ ?>
            <tr>
              <td valign="top" class="HI" colspan="3"> Option
            
            <? if(count($ordfoptremark)+0>0){ ?>
            
         <table border="1" bordercolor="#000000" cellspacing="0" cellpadding="2"
width="100%">
           <tr>
             <td align="left" valign="top"><strong>Remake</strong><br>
                 <?=in_array('ChangeShade', $ordfoptremark)?"-Change shade<br>":""?>
                 <?=in_array('ShortMargin', $ordfoptremark)?"-Short margin<br>":""?>
                 <?=in_array('AddContactPoint', $ordfoptremark)?"-Add contact point<br>":""?>
                 <?=in_array('RepairCeramic', $ordfoptremark)?"-Repair ceramic<br>":""?>
                 <?=in_array('CeramicCracked', $ordfoptremark)?"-Ceramic cracked<br>":""?>
                 <?=in_array('CanNotInsert', $ordfoptremark)?"-Can not insert<br>":""?>
                 <?=in_array('ChangeDesign', $ordfoptremark)?"-Change design<br>":""?>
                 <?=in_array('WrongBite', $ordfoptremark)?"-Wrong bite":""?>
                 <?=in_array('WrongBite2', $ordfoptremark)?"-Wrong bite2":""?>
				 
				 </td>
           </tr>
         </table>
         <? } ?>
         <? if(count($ordfoptmoreinfo)+0>0){ ?>
         <table border="1" bordercolor="#000000" cellspacing="0" cellpadding="2" 
width="100%">
           <tr>
             <td align="left" valign="top"><strong>More Info</strong><br>
                 <?=in_array('MarginGoDeep', $ordfoptmoreinfo)?"-Margin ลงลึกใต้เหงือก<br>":""?>
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
                 <?=in_array('AdeptWithRPDTP', $ordfoptmoreinfo)?"-ทำงาน FIX ให้เข้ากับ RPD<br>":""?>
                 <?=in_array('Adapt with RPD/TP', $ordfoptmoreinfo)?"-Adapt with RPD/TP<br>":""?>
                 <?=in_array('NoSpaceMakePF', $ordfoptmoreinfo)?"-ถ้าไม่มีพื้นที่ให้ทำเป็น PF ได้<br>":""?>
                 <?=in_array('NotHaveAnagonist', $ordfoptmoreinfo)?"-Not have antagonist<br>":""?>
                 <?=in_array('No anagonist', $ordfoptmoreinfo)?"-No antagonist<br>":""?>
                 <?=in_array('PorcelainMargin', $ordfoptmoreinfo)?"-Porcelain Margin<br>":""?>
                 <?=in_array('PorcelainMarginAround', $ordfoptmoreinfo)?"-Porcelain Margin around<br>":""?>
                 <?=in_array('PonticBuccalPalatalSmaller', $ordfoptmoreinfo)?"-Pontic buccal , palatal smaller than neighbour teeth<br>":""?>      
                 <?=in_array('Crown endosed for shade/anatomy', $ordfoptmoreinfo)?"-Crown endosed for shade/anatomy<br>":""?>
                 <?=in_array('Bridge enclosed for shade/anatomy', $ordfoptmoreinfo)?"-Bridge enclosed for shade/anatomy<br>":""?>
                 <?=in_array('New Dentist', $ordfoptmoreinfo)?"-New Dentist<br>":""?>                 
				 <?=in_array('Lingual Mistal & Distal margin', $ordfoptmoreinfo)?"-Lingual Mistal & Distal margin<br>":""?>
                 <?=in_array('Pindex', $ordfoptmoreinfo)?"-Pindex<br>":""?>
                 <?=in_array('เจาะรู / Drilling Hold', $ordfoptmoreinfo)?"-เจาะรู / Drilling Hold<br>":""?>
                 <?=in_array('ChangeShade', $ordfoptmoreinfo)?"-Pink Porcelain<br>":""?>
				 </td>
           </tr>
         </table>
         <? } ?>         </td></tr>
           <? } ?>
<tr>
  <td valign="top" class="HI"> Observ..</td>
  <td>&nbsp;</td>
  <td><pre><?=$ordfobservation?></pre></td></tr>
 </table>
<? }?>
    
 
	<? if($ordtypeR){?><? }?>
 
		<? if($ordtypeO){?>		<? }?>    </td>
  </tr>
  <tr>
    <td colspan="2"></td>
  </tr>
</table></td>
</tr>
<? if($ordtypeF){?>
     <tr>
       <td height="30" align="center" valign="bottom"  bgcolor="#FFFFFF">[ ]Bite [ ]IMP [ ]2ndModel[ ]________</td>
  </tr>
  <tr>
    <td height="150" align="center" valign="bottom"  bgcolor="#FFFFFF"><table border="0" cellpadding="3" cellspacing="0" class="print">
      <tr>
        <td class="popNormal">Model</td>
        <td class="Normal">: ___________ __/__ __:__</td>
      </tr>
      <tr>
        <td class="popNormal">Wax</td>
        <td class="Normal">: ___________ __/__ __:__</td>
      </tr>
      <tr>
        <td class="popNormal">Metal</td>
        <td class="Normal">: ___________ __/__ __:__</td>
      </tr>
      <tr>
        <td class="popNormal">Ceramic</td>
        <td class="Normal">: ___________ __/__ __:__</td>
      </tr>
      <tr>
        <td class="popNormal">Q.C.</td>
        <td class="Normal">: ___________ __/__ __:__</td>
      </tr>
    </table>    </td>
  </tr>
<? }?>
  <tr>
    <td height="60" align="center" valign="bottom"  bgcolor="#FFFFFF" class="Small">HEXA CERAM CO.LTD<br>
213 Moo 5 Sanpraned <br>
Sansai Chiangmai 50210 Thailand<br>
Tel (66) 53 380 801 - 2 Tel & Fax (66) 53 380 471	</td>
  </tr>
</table>
<br />
<br />


