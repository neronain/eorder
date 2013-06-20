

<html>
<head>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
</head>
<script src="../resource/javascript/default.js"></script>
<script>
function refreshVisibleData(){
	obj = findObj("isdocdate");
	var isdocdate = obj.checked;
	obj = findObj("ordtypeF");
	var isFix = obj.checked;
	obj = findObj("ordtypeR");
	var isRemove = obj.checked;
	obj = findObj("ordtypeO");
	var isOrtho = obj.checked;
	
	

	
	if(isdocdate){
		showHideLayers('divisdocdate','','show');
	}else{
		showHideLayers('divisdocdate','','hide');
	}

/*	if(isFix){
		showHideLayers('tblfixdata','','show');
	}else{
		showHideLayers('tblfixdata','','hide');
	}*/
	obj = findObj("tblfixdata");
	if(isFix){
		obj.style.display = 'inline';
	}else{
		obj.style.display = 'none';
	}

	obj = findObj("tblremovedata");
	if(isRemove){
		obj.style.display = 'inline';
	}else{
		obj.style.display = 'none';
	}

	obj = findObj("tblorthodata");
	if(isOrtho){
		obj.style.display = 'inline';
	}else{
		obj.style.display = 'none';
	}
	
}
</script>
<body>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
<tr><td align="center" valign="top">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td class="HeaderW">Order detail </td>
  </tr>
  <form action="../order/orderedit_c.php" method="post" name="editorderform" >  
  <tr>
    <td bgcolor="#FFFFFF" class="Normal"><table width="100%" border="0" cellpadding="2" cellspacing="0" class="Normal">
        <tr>
          <td width="100">order code </td>
<td>
<?=$arg1?>
<input type="text" name="arg2" value="<?=$arg2?>" style="width:36px">
</td></tr>
        <tr>
          <td width="100">customer</td>
          <td><?  buildComboBoxList('customer','customer order by cus_nick','customerid',array('cus_nick','cus_name'),$customer_id,"") ?>
		 </td>
        </tr>
        <tr>
          <td width="100">doctor</td>
          <td><?=$docname ?></td>
        </tr>
<tr><td>Patient  </td><td><input type="text" name="patientname" value="<?=$patientname?>"></td></tr>
<tr><td>งานเข้า  </td><td><? buildDateSelector('orddate',$orddate_day,$orddate_month,$orddate_year)?></td></tr>
 <tr><td>กำหนดออก   </td><td>
 <? buildDateSelector('ordreleasedate',$ordreleasedate_day,$ordreleasedate_month,$ordreleasedate_year)?> 
 <? buildTimeSelector('ordreleasedate',$ordreleasedate_hour,$ordreleasedate_minute)?> 
 </td></tr>
<tr><td>หมอนัด  <input name="isdocdate" type="checkbox" id="isdocdate"  value="true" <?=$isdocdate?"checked":""?> onClick="refreshVisibleData();"></td><td>
<div id="divisdocdate"> 
<? buildDateSelector('orddocdate',$orddocdate_day,$orddocdate_month,$orddocdate_year)?> <? buildTimeSelector('orddocdate',$orddocdate_hour,$orddocdate_minute)?> </div>
</td></tr> 
    <tr>
      <td colspan="2"><hr></td>
      </tr>
      </table>      </td>
  </tr>

  
  
  
  
  
  

  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal"><table width="100%" align="center" cellpadding="2" cellspacing="0" class="Normal">
<tr>
  <td colspan="2" class="popHeader">
  <input name="ordtypeF" type="checkbox" id="ordtypeF"  value="true" <?=$ordtypeF?"checked":""?> onClick="refreshVisibleData();">
    Fix-order</td>
  </tr>
 </table>
 <div  id="tblfixdata">
<table align="center" cellpadding="3" cellspacing="0" class="Normal">
<tr>
  <td>Method</td>
  <td>
    <table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">
			  <input name="ordfmethod" type="radio" value="Try-in" <?=$ordfmethod=='Try-in'?"checked":""?>></td>
              <td width="32"><img src="../resource/images/eorder/fix/ty_tryin.gif" width="32" height="32"></td>
              <td class="Normal">Try-in</td>
            </tr>
        </table></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">
			  <input name="ordfmethod" type="radio" value="Contour" <?=$ordfmethod=='Contour'?"checked":""?>></td>
              <td width="32"><img src="../resource/images/eorder/fix/ty_contour.gif" width="32" height="32"></td>
              <td class="Normal">Contour</td>
            </tr>
        </table></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">
			  <input name="ordfmethod" type="radio" value="Finish" <?=$ordfmethod=='Finish'?"checked":""?>></td>
              <td width="32"><img src="../resource/images/eorder/fix/ty_finish.gif" width="32" height="32"></td>
              <td class="Normal">Finish</td>
            </tr>
        </table></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">
			  <input name="ordfmethod" type="radio" value="Repair" <?=$ordfmethod=='Repair'?"checked":""?>></td>
              <td width="32"><img src="../resource/images/eorder/fix/ty_repair.gif" width="32" height="32"></td>
              <td class="Normal">Repair</td>
            </tr>
        </table></td>
      </tr>
    </table>  </td>
</tr>

<tr>
  <td colspan="2" bgcolor="#DDDDFF"> Type of work </td>
  </tr>
<tr>
  <td align="right" bgcolor="#DDDDFF">&nbsp;</td>
  <td bgcolor="#DDDDFF"><textarea name="ordftypeofworkt" id="ordftypeofworkt" style="width:450;height:50"><?=$ordftypeofworkt?></textarea></td>
</tr>
<tr>
  <td>Shade</td>
  <td>
  <select name = "ordfshade">
  <? for($i=0;$i<count($txtshadeid);$i++){?>
  <option  value="<?=$txtshadeid[$i] ?>" <?=$ordfshade==$txtshadeid[$i]?"selected":""?>>
  <?=$txtshadename[$i]?></option>
  
  <? }?>
  </select>  </td>
</tr>
<tr>
  <td valign="top" bgcolor="#DDDDFF">Alloy</td>
  <td bgcolor="#DDDDFF"><table border="0" cellpadding="0" cellspacing="0">
    
    <tr>
      <td><table width="100%" border="0" cellpadding="2" cellspacing="0" class="Normal">
          <tr>
            <td align="right">
			<input name="ordfalloy" type="radio" value="1" <?=$ordfalloy=='1'?"checked":""?>></td>
            <td>None</td>
          </tr>
          <tr>
            <td align="right">
			<input name="ordfalloy" type="radio" value="2" <?=$ordfalloy=='2'?"checked":""?>></td>
            <td>Non precious</td>
          </tr>
          <tr>
            <td align="right"><input name="ordfalloy" type="radio" value="3" <?=$ordfalloy=='3'?"checked":""?>></td>
            <td>Non nickel </td>
          </tr>
          
          <tr>
            <td align="right"><input name="ordfalloy" type="radio" value="4" <?=$ordfalloy=='4'?"checked":""?>></td>
            <td>Precious - Palladium </td>
          </tr>
          <tr>
            <td align="right"><input name="ordfalloy" type="radio" value="5" <?=$ordfalloy=='5'?"checked":""?>></td>
            <td>Precious - Semi-precious</td>
          </tr>
          <tr>
            <td align="right">
              <input name="ordfalloy" type="radio" value="6" <?=$ordfalloy=='6'?"checked":""?>>            </td>
            <td>Precious - White - Gold </td>
          </tr>
          <tr>
            <td align="right">
              <input name="ordfalloy" type="radio" value="7" <?=$ordfalloy=='7'?"checked":""?>>            </td>
            <td>Precious - Yellow - Gold</td>
          </tr>
      </table></td>
    </tr>
  </table></td>
</tr>
<tr>
  <td>Embrasure</td>
  <td><table border="0" cellpadding="0" cellspacing="0">

    <tr>
      <td bgcolor="#FFFFFF">
	  <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right">
		  <input name="ordfembrasure" type="radio" value="None" <?=$ordfembrasure=='None'?"checked":""?>></td>
          <td align="center" class="Normal">None</td>
        </tr>
      </table>	  </td>
      <td width="30" bgcolor="#FFFFFF">&nbsp;</td>
      <td bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right">
		  <input name="ordfembrasure" type="radio" value="Open" <?=$ordfembrasure=='Open'?"checked":""?>></td>
          <td><img src="../resource/images/eorder/fix/em_open.gif" width="32" height="32"></td>
          <td align="center" class="Normal">Open</td>
        </tr>
      </table></td>
      <td width="30" bgcolor="#FFFFFF">&nbsp;</td>
      <td height="32" bgcolor="#FFFFFF"><table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right">
		  <input name="ordfembrasure" type="radio" value="Close" <?=$ordfembrasure=='Close'?"checked":""?>></td>
          <td><img src="../resource/images/eorder/fix/em_close.gif" width="32" height="32"></td>
          <td align="center" class="Normal">Close</td>
        </tr>
      </table></td>
    </tr>

  </table></td>
</tr>
<tr>
  <td bgcolor="#DDDDFF">Type of<br>
    pontic</td>
  <td bgcolor="#DDDDFF"><table border="0" cellpadding="0" cellspacing="0">
    <tr>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right"><input name="ordfpontic" type="radio" value="1" <?=$ordfpontic=='1'?"checked":""?>></td>
            <td width="32"><img src="../resource/images/eorder/fix/fix_pontic0.gif" width="32" height="32"></td>
          </tr>
      </table></td>
      <td>&nbsp;</td>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right"><input name="ordfpontic" type="radio" value="2" <?=$ordfpontic=='2'?"checked":""?>></td>
            <td width="32"><img src="../resource/images/eorder/fix/fix_pontic1.gif" width="32" height="32"></td>
          </tr>
      </table></td>
      <td>&nbsp;</td>
      <td height="32" ><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right"><input name="ordfpontic" type="radio" value="3" <?=$ordfpontic=='3'?"checked":""?>></td>
            <td width="32"><img src="../resource/images/eorder/fix/fix_pontic2.gif" width="32" height="32"></td>
          </tr>
      </table></td>
      <td>&nbsp;</td>
      <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right"><input name="ordfpontic" type="radio" value="4" <?=$ordfpontic=='4'?"checked":""?>></td>
            <td width="32"><img src="../resource/images/eorder/fix/fix_pontic3.gif" width="32" height="32"></td>
          </tr>
      </table></td>
      <td>&nbsp;</td>
      <td height="32"><table width="100%" border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td align="right"><input name="ordfpontic" type="radio" value="5" <?=$ordfpontic=='5'?"checked":""?>></td>
            <td width="32"><img src="../resource/images/eorder/fix/fix_pontic4.gif" width="32" height="32"></td>
          </tr>
      </table></td>
    </tr>
  </table></td>
</tr>
<tr>
  <td colspan="2"> Option </td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td><textarea name="ordfoptiont" id="ordfoptiont" style="width:450;height:50"><?=$ordfoptiont?></textarea></td>
</tr>

<tr>
  <td colspan="2" bgcolor="#DDDDFF">Addition information</td>
</tr>
<tr>
  <td bgcolor="#DDDDFF"></td>
  <td bgcolor="#DDDDFF">
  <input name="ordfoptmoreinfo[]" type="checkbox" value="MarginGoDeep"  
<?=in_array('MarginGoDeep', $ordfoptmoreinfo)?"checked":""?>>
Margin go deep inside the parodental pocket<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="UnderOcclusion05mm"  
<?=in_array('UnderOcclusion05mm', $ordfoptmoreinfo)?"checked":""?>>
Under occlusion 0.5mm<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="UnderOcclusion10mm"  
<?=in_array('UnderOcclusion10mm', $ordfoptmoreinfo)?"checked":""?>>
Under occlusion 1.0mm<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="UnderOcclusion20mm"  
<?=in_array('UnderOcclusion20mm', $ordfoptmoreinfo)?"checked":""?>>
Under occlusion 2.0mm<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="NoMetalMargin"  
<?=in_array('NoMetalMargin', $ordfoptmoreinfo)?"checked":""?>> 
No metal margin<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="Metal margin 1 mm Lingual"  
<?=in_array('Metal margin 1 mm Lingual', $ordfoptmoreinfo)?"checked":""?>> 
Metal margin 1 mm Lingual<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="Metal margin 0.5 mm Lingual"  
<?=in_array('Metal margin 0.5 mm Lingual', $ordfoptmoreinfo)?"checked":""?>> 
Metal margin 0.5 mm Lingual<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="SmallMetalMarginAround"  
<?=in_array('SmallMetalMarginAround', $ordfoptmoreinfo)?"checked":""?>>
Small metal margin around<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="Hair line metal margin Lingual"  
<?=in_array('Hair line metal margin Lingual', $ordfoptmoreinfo)?"checked":""?>>
Hair line metal margin Lingual<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="HairLineMetalMarginAround"  
<?=in_array('HairLineMetalMarginAround', $ordfoptmoreinfo)?"checked":""?>>
Hair line metal margin around<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="No approximal contact"  
<?=in_array('No approximal contact', $ordfoptmoreinfo)?"checked":""?>> 
No approximal contact<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="SmallTeeth"  
<?=in_array('SmallTeeth', $ordfoptmoreinfo)?"checked":""?>> 
Small teeth<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="RestPrepareForRPDTP"  
<?=in_array('RestPrepareForRPDTP', $ordfoptmoreinfo)?"checked":""?>>
Rest , Prepare for RPD/TP<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="Adapt with RPD/TP"  
<?=in_array('Adapt with RPD/TP', $ordfoptmoreinfo)?"checked":""?>> 
Adapt with RPD/TP<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="NoSpaceMakePF"  
<?=in_array('NoSpaceMakePF', $ordfoptmoreinfo)?"checked":""?>> 
No space make PF<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="No anagonist"  
<?=in_array('No anagonist', $ordfoptmoreinfo)?"checked":""?>> 
No anagonist<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="PorcelainMargin"  
<?=in_array('PorcelainMargin', $ordfoptmoreinfo)?"checked":""?>>
Porcelain Margin<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="PorcelainMarginAround"  
<?=in_array('PorcelainMarginAround', $ordfoptmoreinfo)?"checked":""?>>
Porcelain Margin around<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="PonticBuccalPalatalSmaller"  
<?=in_array('PonticBuccalPalatalSmaller', $ordfoptmoreinfo)?"checked":""?>> 
Pontic buccal , palatal smaller than neighbour teeth<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="Crown endosed for shade/anatomy"  
<?=in_array('Crown endosed for shade/anatomy', $ordfoptmoreinfo)?"checked":""?>> 
Crown endosed for shade/anatomy<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="Bridge enclosed for shade/anatomy"  
<?=in_array('Bridge enclosed for shade/anatomy', $ordfoptmoreinfo)?"checked":""?>> 
Bridge enclosed for shade/anatomy<br>
<input name="ordfoptmoreinfo[]" type="checkbox" value="New Dentist"  
<?=in_array('New Dentist', $ordfoptmoreinfo)?"checked":""?>> 
New Dentist<br>
  </td>
</tr>
<tr>
  <td colspan="2">Repair &amp; Finish Remark</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td><input type="checkbox" name="ordfoptremark[]" value="ChangeShade"  
<?=in_array('ChangeShade', $ordfoptremark)?"checked":""?>>
    Change shade<br>
    <input type="checkbox" name="ordfoptremark[]" value="ShortMargin"  
<?=in_array('ShortMargin', $ordfoptremark)?"checked":""?>>
    Short margin<br>
    <input type="checkbox" name="ordfoptremark[]" value="AddContactPoint"  
<?=in_array('AddContactPoint', $ordfoptremark)?"checked":""?>>
    Add contact point<br>
    <input type="checkbox" name="ordfoptremark[]" value="RepairCeramic"  
<?=in_array('RepairCeramic', $ordfoptremark)?"checked":""?>>
    Repair ceramic<br>
    <input type="checkbox" name="ordfoptremark[]" value="CeramicCracked"  
<?=in_array('CeramicCracked', $ordfoptremark)?"checked":""?>>
    Ceramic cracked<br>
    <input type="checkbox" name="ordfoptremark[]" value="CanNotInsert"  
<?=in_array('CanNotInsert', $ordfoptremark)?"checked":""?>>
    Can not insert<br>
    <input type="checkbox" name="ordfoptremark[]" value="ChangeDesign"  
<?=in_array('ChangeDesign', $ordfoptremark)?"checked":""?>>
    Change design<br>
    <input type="checkbox" name="ordfoptremark[]" value="WrongBite"  
<?=in_array('WrongBite', $ordfoptremark)?"checked":""?>>
    Wrong bite</td>
</tr>

<tr>
  <td colspan="2" bgcolor="#DDDDFF">Observation</td>
  </tr>
<tr><td bgcolor="#DDDDFF">
</td>
  <td bgcolor="#EEEEFF"><textarea name="ordfobservation" id="ordfobservation" style="width:450;height:100"><?=$ordfobservation?></textarea></td>
</tr></table>
 </div>

<!-- ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<table width="100%" align="center" cellpadding="2" cellspacing="0" class="Normal">
<tr>
  <td colspan="2" class="popHeader">
  <input name="ordtypeR" type="checkbox" id="ordtypeR"  value="true" <?=$ordtypeR?"checked":""?>  onClick="refreshVisibleData();">
    Remove-order</td>
  </tr>
 </table>
  <div  id="tblremovedata">
<table align="center" cellpadding="3" cellspacing="0" class="Normal" >
<tr>
  <td>Method</td>
  <td>
    <table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">
			  <input name="ordrmethod" type="radio" value="Try-in" <?=$ordrmethod=='Try-in'?"checked":""?>></td>
              <td width="32"><img src="../resource/images/eorder/fix/ty_tryin.gif" width="32" height="32"></td>
              <td class="Normal">Try-in</td>
            </tr>
        </table></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">
			  <input name="ordrmethod" type="radio" value="Finish" <?=$ordrmethod=='Finish'?"checked":""?>></td>
              <td width="32"><img src="../resource/images/eorder/fix/ty_finish.gif" width="32" height="32"></td>
              <td class="Normal">Finish</td>
            </tr>
        </table></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">
			  <input name="ordrmethod" type="radio" value="Repair" <?=$ordrmethod=='Repair'?"checked":""?>></td>
              <td width="32"><img src="../resource/images/eorder/fix/ty_repair.gif" width="32" height="32"></td>
              <td class="Normal">Repair</td>
            </tr>
        </table></td>
      </tr>
    </table>  </td>
</tr>

<tr>
  <td colspan="2" bgcolor="#DDDDFF"> Type of work </td>
  </tr>
<tr>
  <td align="right" bgcolor="#DDDDFF">&nbsp;</td>
  <td bgcolor="#DDDDFF"><textarea name="ordrtypeofworkt"  style="width:450;height:50"><?=$ordrtypeofworkt?></textarea></td>
</tr>
<tr>
  <td>Shade</td>
  <td>
  <select name = "ordrshade">
  <? for($i=0;$i<count($txtshadeid);$i++){?>
  <option  value="<?=$txtshadeid[$i] ?>" <?=$ordrshade==$txtshadeid[$i]?"selected":""?>>
  <?=$txtshadename[$i]?></option>
  
  <? }?>
  </select>  </td>
</tr>
<tr>
  <td colspan="2" bgcolor="#DDDDFF">Observation</td>
  </tr>
<tr><td bgcolor="#DDDDFF">
</td>
  <td bgcolor="#EEEEFF"><textarea name="ordrobservation" id="ordrobservation" style="width:450;height:100"><?=$ordrobservation?></textarea></td>
</tr></table></div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++= -->


<!-- ++++++++++++++++++++++++++++++++++++++++++++++++ -->
<table width="100%" align="center" cellpadding="2" cellspacing="0" class="Normal">
<tr>
  <td colspan="2" class="popHeader">
  <input name="ordtypeO" type="checkbox" id="ordtypeO"  value="true" <?=$ordtypeO?"checked":""?>  onClick="refreshVisibleData();">
    Ortho-order</td>
  </tr>
 </table>
  <div  id="tblorthodata">
<table align="center" cellpadding="3" cellspacing="0" class="Normal" >
<tr>
  <td>Method</td>
  <td>
    <table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">
			  <input name="ordomethod" type="radio" value="Try-in" <?=$ordomethod=='Try-in'?"checked":""?>></td>
              <td width="32"><img src="../resource/images/eorder/fix/ty_tryin.gif" width="32" height="32"></td>
              <td class="Normal">Try-in</td>
            </tr>
        </table></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">
			  <input name="ordomethod" type="radio" value="Finish" <?=$ordomethod=='Finish'?"checked":""?>></td>
              <td width="32"><img src="../resource/images/eorder/fix/ty_finish.gif" width="32" height="32"></td>
              <td class="Normal">Finish</td>
            </tr>
        </table></td>
        <td bgcolor="#FFFFFF">&nbsp;</td>
        <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td align="right">
			  <input name="ordomethod" type="radio" value="Repair" <?=$ordomethod=='Repair'?"checked":""?>></td>
              <td width="32"><img src="../resource/images/eorder/fix/ty_repair.gif" width="32" height="32"></td>
              <td class="Normal">Repair</td>
            </tr>
        </table></td>
      </tr>
    </table>  </td>
</tr>

<tr>
  <td colspan="2" bgcolor="#DDDDFF"> Type of work </td>
  </tr>
<tr>
  <td align="right" bgcolor="#DDDDFF">&nbsp;</td>
  <td bgcolor="#DDDDFF"><textarea name="ordotypeofworkt"  style="width:450;height:50"><?=$ordotypeofworkt?></textarea></td>
</tr>
<tr>
  <td>Shade</td>
  <td>
  <select name = "ordoshade">
  <? for($i=0;$i<count($txtshadeid);$i++){?>
  <option  value="<?=$txtshadeid[$i] ?>" <?=$ordoshade==$txtshadeid[$i]?"selected":""?>>
  <?=$txtshadename[$i]?></option>
  
  <? }?>
  </select>  </td>
</tr>
<tr>
  <td colspan="2" bgcolor="#DDDDFF">Observation</td>
  </tr>
<tr><td bgcolor="#DDDDFF">
</td>
  <td bgcolor="#EEEEFF"><textarea name="ordoobservation" id="ordoobservation" style="width:450;height:100"><?=$ordoobservation?></textarea></td>
</tr></table></div>
<!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++= -->
</td>



  </tr>
  <tr><td class="FooterTD">
  
  <input type="hidden" name="eorderid" value="<?=$data_eorder->Rs("eorderid");?>" />
  <input type="hidden" name="arg1" value="<?=$arg1?>" />
  
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td><input name="METHOD" type="submit" class="BTnextback" value="Cancel" /></td><td align="right"><input name="METHOD" type="submit" class="BTupdate" value="Save" /></td></tr></table></td>
  </tr>
</form>

<script>
	refreshVisibleData();
</script>
</table></td></tr></table>
</body>
</html>





