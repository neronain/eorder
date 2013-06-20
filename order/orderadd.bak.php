<? include_once("../core/default.php"); ?>
<? include_once("../order/inc_shade.php"); ?>
<? include_once("../order/inc_getstring.php"); ?>


<? 	//echo("Step $step<br>");?>
<html>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
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

	/*if(isFix){
		showHideLayers('tblfixdata','','show');
	}else{
		showHideLayers('tblfixdata','','hide');
	}

	if(isRemove){
		showHideLayers('tblremovedata','','show');
	}else{
		showHideLayers('tblremovedata','','hide');
	}

	if(isOrtho){
		showHideLayers('tblorthodata','','show');
	}else{
		showHideLayers('tblorthodata','','hide');
	}//*/
	
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
<tr><td height="50"><? $currentMenu="addorder";include_once("../order/ordermenu.php"); ?></td></tr>
<tr><td align="center" valign="top">
<? if($step!=5 && $step!=6){ ?>
<table width="600" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td align="center" class="HeaderW">
	<img src="../resource/images/silkicons/package_add.gif" border="0" /> 	Add order </td>
  </tr>
  
<? } ?>


<?
switch($step){
	case 0:
?>









<form action="../order/orderadd_c.php" method="post" name="addorderform" id="addorderform1">
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
<strong>--- Select customer ---</strong><br />
Customer <?  buildComboBoxList('customer','customer order by cus_nick','customerid',array('cus_nick','cus_name'),$customer,"") ?><br />
<input type="hidden" name="STEP" value="<?=$step?>" />
<input type="hidden" name="STEPNEXT" value="1" />
	</td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td>&nbsp;</td><td align="right"><input name="METHOD" type="submit" class="BTnextback" value="NEXT" /></td></tr></table></td>
  </tr>
</form>







<? break;case 1: ?>
<form action="../order/orderadd_c.php" method="post" name="addorderform" id="addorderform2">
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
<strong>--- Input code or select new auto ID ---</strong><br />	
Customer : <?=$cusname?><br />
Code : E<?=$cntnick.$cusnick?> 
<input name="fixcode" type="text" value="<?=$fixcode?>" size="10" maxlength="8">
-- <input name="METHOD" type="submit" class="BTnextback" value="AUTO NUMBER">
<br />
<input type="hidden" name="customer" value="<?=$customer?>" />
<input type="hidden" name="STEP" value="<?=$step?>" />
<input type="hidden" name="STEPBACK" value="0" />
<input type="hidden" name="STEPNEXT" value="2" />
<input type="hidden" name="STEPADD" value="11" />
	</td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td><input name="METHOD" type="submit" class="BTnextback" value="BACK" /></td><td align="right"><input name="METHOD" type="submit" class="BTnextback" value="NEXT" /></td></tr></table></td>
  </tr>
</form>





<? break;case 2: ?>
<form action="../order/orderadd_c.php" method="post" name="addorderform" id="addorderform3">
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
<strong>--- Select doctor ---</strong><br />		
Customer : <?=$cusname?><br />
Code : E<?=$cntnick.$cusnick.$fixcode?><br />

Doctor <?  buildComboBoxList('doctor',"doctor where doc_cus_id = $customer order by doc_name",'doctorid',array('doc_name'),$doctor,"") ?>
 If not found  <input name="METHOD" type="submit" class="BTnextback" value="ADDNEW">
 <br />
 <input type="hidden" name="STEPBACK" value="1" />
<input type="hidden" name="STEPNEXT" value="5" />
<input type="hidden" name="STEPADD" value="4" />
<input type="hidden" name="customer" value="<?=$customer?>" />
<input type="hidden" name="fixcode" value="<?=$fixcode?>" />
<input type="hidden" name="STEP" value="<?=$step?>" />
	</td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td><input name="METHOD" type="submit" class="BTnextback" value="BACK" /></td><td align="right"><input name="METHOD" type="submit" class="BTnextback" value="NEXT" /></td></tr></table></td>
  </tr>
</form>





<? break;case 3:case 4: ?>
<form action="../order/orderadd_c.php" method="post" name="addorderform" id="addorderform4">
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
<strong>--- Input doctor's name ---</strong><br />		
Customer : <?=$cusname?><br />
Code : E<?=$cntnick.$cusnick.$fixcode?>--<br />
Doctor name  <input type="text" name="doctorname" value=""><br />
<input type="hidden" name="STEPBACK" value="<?=$step==3?"1":"2"?>" />
<input type="hidden" name="STEPNEXT" value="10" />
<input type="hidden" name="customer" value="<?=$customer?>" />
<input type="hidden" name="fixcode" value="<?=$fixcode?>" />
<input type="hidden" name="STEP" value="<?=$step?>" />
	</td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td><input name="METHOD" type="submit" class="BTnextback" value="BACK" /></td><td align="right"><input name="METHOD" type="submit" class="BTnextback" value="NEXT" /></td></tr></table></td>
  </tr>
</form>






<? break;case 5:case 6: ?>
<? //$mode = "STAFF" ?>
<? //include("../eorder/eorder_edit.php") ?>


<? //break;case 99: ?>

<form action="../order/orderadd_c.php" method="post" name="addorderform" id="addorderform5">
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
<strong>--- Fill information ---</strong><br />	
<table cellpadding="2" cellspacing="0" class="Normal">
<tr><td>Customer</td><td><?=$cusname?></td></tr>
<tr><td>Code </td><td> E<?=$cntnick.$cusnick.$fixcode ?>
<? if($step==5){?>
<select name="fixcodearg">
  <option value="01" <?=$fixcodearg=="01"?"selected":""?>>01 - ลองโครงครั้งแรก</option>
  <option value="15" <?=$fixcodearg=="15"?"selected":""?>>15 - ลอง Bitebox ครั้งแรก</option>
  <option value="25" <?=$fixcodearg=="25"?"selected":""?>>25 - ลองฟันครั้งแรก</option>
  <option value="50" <?=$fixcodearg=="50"?"selected":""?>>50 - งานจบ</option>
  <option value="51" <?=$fixcodearg=="51"?"selected":""?>>51 - งานแก้</option>
</select>
<? }else if($fixcodearg_next+0<15){?>
<select name="fixcodearg">
<option value="<?=$fixcodearg_next?>"  <?=$fixcodearg==$fixcodearg_next?"selected":""?>>
<?=$fixcodearg_next?> - ลองโครงครั้งที่ <?=$fixcodearg_next+0?></option>
  <option value="15" <?=$fixcodearg=="15"?"selected":""?>>15 - ลอง Bitebox ครั้งแรก</option>
  <option value="25" <?=$fixcodearg=="25"?"selected":""?>>25 - ลองฟันครั้งแรก</option>
<option value="50" <?=$fixcodearg=="50"?"selected":""?>>50 - งานจบ</option>
</select>
<? }else if($fixcodearg_next+0<25){?>
<select name="fixcodearg">
<option value="<?=$fixcodearg_next?>"  <?=$fixcodearg==$fixcodearg_next?"selected":""?>>
<?=$fixcodearg_next?> - ลอง Bitebox ครั้งที่ <?=$fixcodearg_next+0-14?></option>
  <option value="25" <?=$fixcodearg=="25"?"selected":""?>>25 - ลองฟันครั้งแรก</option>
<option value="50" <?=$fixcodearg=="50"?"selected":""?>>50 - งานจบ</option>
</select>
<? }else if($fixcodearg_next+0<50){?>
<select name="fixcodearg">
<option value="<?=$fixcodearg_next?>"  <?=$fixcodearg==$fixcodearg_next?"selected":""?>>
<?=$fixcodearg_next?> - ลองฟันครั้งที่ <?=$fixcodearg_next+0-24?></option>
<option value="50" <?=$fixcodearg=="50"?"selected":""?>>50 - งานจบ</option>
</select>
<? }else{?>
<?=$fixcodearg_next?><input type="hidden" name="fixcodearg" value="<?=$fixcodearg_next?>" />
 -- Repair#<?=$fixcodearg_next-50?>
<? }?></td></tr>
<tr><td>Doctor </td><td><?=$doctorname ?></td></tr>
<tr><td>Patient  </td><td><input type="text" name="patientname" value="<?=$patientname?>"></td></tr>
<tr><td>งานเข้า  </td><td><? buildDateSelector('orddate',$orddate_day,$orddate_month,$orddate_year)?></td></tr>
 <tr><td>กำหนดออก   </td><td>
 <? buildDateSelector('ordreleasedate',$ordreleasedate_day,$ordreleasedate_month,$ordreleasedate_year)?> 
 <? buildTimeSelector('ordreleasedate',$ordreleasedate_hour,$ordreleasedate_minute)?> 
 </td></tr>
<? /*
<select name="ordope*rateday">
<? for($i=0;$i<20;$i++){ ?>
<option  <?=$ordope*rateday=="$i"?"selected":""?>><?=$i?></option>
<? } ?>
</select> days*/?>


<tr><td>หมอนัด  <input name="isdocdate" type="checkbox" id="isdocdate"  value="true" <?=$isdocdate?"checked":""?> onClick="refreshVisibleData();"></td><td>
<div id="divisdocdate"> 
<? buildDateSelector('orddocdate',$orddocdate_day,$orddocdate_month,$orddocdate_year)?> <? buildTimeSelector('orddocdate',$orddocdate_hour,$orddocdate_minute)?> </div></td></tr>
<tr>
  <td>Priority</td>
  <td><strong>
    <input name="ordpriority" type="radio" value="A" <?=$ordpriority=='A'?"checked":""?>>
    A&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="ordpriority" type="radio" value="B" <?=$ordpriority=='B'?"checked":""?>>
      B&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="ordpriority" type="radio" value="C" <?=$ordpriority=='C'?"checked":""?>  >
      C&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="ordpriority" type="radio" value="D" <?=$ordpriority=='D'?"checked":""?>>
      D&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="ordpriority" type="radio" value="X" <?=$ordpriority=='X'?"checked":""?>>
      X</strong>
      &nbsp;&nbsp;
      Assigned today[
<?
	$data_tmp = new Csql();
	$err =	$data_tmp->Connect();
	$query = "
		select ordt_priority as priority,count(*) as countrow from eordertoday
		where  ordt_isship=FALSE and DATE(ordt_date) = CURDATE()
		group by ordt_priority order by ordt_priority
		 ";
	
	$data_tmp->Query($query);
	while(!$data_tmp->EOF){ 
		echo $data_tmp->Rs("priority").":".$data_tmp->Rs("countrow")." ";
		$data_tmp->MoveNext();	 
	}
?> ]
      
      </td>
</tr>
</table>
<table width="100%" align="center" cellpadding="2" cellspacing="0" class="Normal">
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
  <td bgcolor="#DDDDFF">Box color</td>
  <td bgcolor="#DDDDFF">
  <input name="ordfboxcolor" type="radio" value="Brown" <?=$ordfboxcolor=='Brown'?"checked":""?>>
    <font color="#CC6633">Brown</font>
  <input name="ordfboxcolor" type="radio" value="Green" <?=$ordfboxcolor=='Green'?"checked":""?>>
  <font color="#006600">Green</font>
<input name="ordfboxcolor" type="radio" value="Yellow" <?=$ordfboxcolor=='Yellow'?"checked":""?>>
<font color="#CCCC00">Yellow</font>
<input name="ordfboxcolor" type="radio" value="White" <?=$ordfboxcolor=='White'?"checked":""?>>
White
<input name="ordfboxcolor" type="radio" value="Blue" <?=$ordfboxcolor=='Blue'?"checked":""?>> 
<font color="#0000FF">Blue</font></td>
</tr>
<tr>
  <td colspan="2"> Type of work </td>
  </tr>
<tr>
  <td align="right">&nbsp;</td>
  <td><textarea name="ordftypeofworkt" id="ordftypeofworkt" style="width:450;height:50"><?=$ordftypeofworkt?></textarea></td>
</tr>
<tr>
  <td bgcolor="#DDDDFF">Shade</td>
  <td bgcolor="#DDDDFF">
  <select name = "ordfshade">
  <? for($i=0;$i<count($txtshadeid);$i++){?>
  <option  value="<?=$txtshadeid[$i] ?>" <?=$ordfshade==$txtshadeid[$i]?"selected":""?>>
  <?=$txtshadename[$i]?></option>
  
  <? }?>
  </select>  </td>
</tr>
<tr>
  <td valign="top">Alloy</td>
  <td><table border="0" cellpadding="0" cellspacing="0">
    
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
  <td bgcolor="#DDDDFF">Embrasure</td>
  <td bgcolor="#DDDDFF"><table border="0" cellpadding="0" cellspacing="0">

    <tr>
      <td>
	  <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right">
		  <input name="ordfembrasure" type="radio" value="None" <?=$ordfembrasure=='None'?"checked":""?>></td>
          <td align="center" class="Normal">None</td>
        </tr>
      </table>	  </td>
      <td width="30">&nbsp;</td>
      <td><table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td align="right">
		  <input name="ordfembrasure" type="radio" value="Open" <?=$ordfembrasure=='Open'?"checked":""?>></td>
          <td><img src="../resource/images/eorder/fix/em_open.gif" width="32" height="32"></td>
          <td align="center" class="Normal">Open</td>
        </tr>
      </table></td>
      <td width="30">&nbsp;</td>
      <td height="32"><table border="0" cellspacing="0" cellpadding="0">
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
  <td>Type of<br>
    pontic</td>
  <td><table border="0" cellpadding="0" cellspacing="0">
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
      <td><input name="ordfponticmm" type="text" id="ordfponticmm" size="5">
        mm</td>
    </tr>
  </table></td>
</tr>
<tr>
  <td colspan="2"></td>
  </tr>
<tr>
  <td colspan="2"></td>
  </tr>
<tr>
  <td colspan="2"></td>
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
  <td colspan="2">Repair &amp;  Remake</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td>

<input type="checkbox" name="ordfoptremark[]" value="ChangeShade"  
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
<tr>
  <td bgcolor="#DDDDFF"></td>
  <td bgcolor="#DDDDFF"><textarea name="ordfoptiont" id="ordfobservation" style="width:450;height:100"><?=$ordfobservation?>
  </textarea></td>
</tr>
</table>
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
  <input type="hidden" name="STEP" value="<?=$step?>" />
<input type="hidden" name="STEPBACK" value="<?=$step==5?"2":"1"?>" />
<input type="hidden" name="STEPNEXT" value="20" />
<input type="hidden" name="customer" value="<?=$customer?>" />
<input type="hidden" name="doctor" value="<?=$doctor?>" />
<input type="hidden" name="fixcode" value="<?=$fixcode?>" />
  
  <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td><input name="METHOD" type="submit" class="BTnextback" value="BACK" /></td><td align="right"><input name="METHOD" type="submit" class="BTnextback" value="NEXT" /></td></tr></table></td>
  </tr>
</form>

<script>
	refreshVisibleData();
</script>




<? break;case 20: ?>
<form action="../order/orderadd_c.php" method="post" name="addorderform" id="addorderform20">
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
	<strong>--- Preview ---</strong><br />
Customer : <?=$cusname?><br />
Code : E<?=$cntnick.$cusnick.$fixcode.$fixcodearg?><br />
Doctor : <?=$doctorname?><br />
Patient : <?=$patientname?><br />
งานเข้า : <?=$orddate_day?> <?=passThaiMonth($orddate_month)?> <?=passThaiYear($orddate_year)?>
<? $today = getdate();
	if($orddate_day!=$today['mday'] || $orddate_month!=$today['mon'] || $orddate_year!=$today['year']){?>
		<font color="#FF0000">** กรุณาตรวจสอบ วันที่อีกครั้ง (วันนี้วันที่ 
		<?=$today['mday']?> 
		<?=passThaiMonth($today['mon'])?> 
		<?=passThaiYear($today['year'])?>
		)</font>
	<? }?>
<br/>
กำหนดออก : <?=$ordreleasedate_day?> <?=passThaiMonth($ordreleasedate_month)?> <?=passThaiYear($ordreleasedate_year)?>  <?=$ordreleasedate_hour?>:<?=$ordreleasedate_minute?>
<?
if($ordreleasedate_year*12+$ordreleasedate_month==$today['year']*12+$today['mon']
&& $ordreleasedate_day < $today['mday']+0 
|| $ordreleasedate_year*12+$ordreleasedate_month<$today['year']*12+$today['mon']
){
?>
<font color="#FF0000">** กรุณาตรวจสอบ วันที่อีกครั้ง (กำหนดออก เลยมาแล้ว)</font>
<? }?>
<br />
หมอนัด : 
<? if($isdocdate){?>
<?=$orddocdate_day?> <?=passThaiMonth($orddocdate_month)?> <?=passThaiYear($orddocdate_year)?> 
 <?=$orddocdate_hour?>:<?=$orddocdate_minute?>
 <? }else{echo"-";} ?>
<br/>
Priority :<strong> <?=$ordpriority?></strong><br />

 <br> 
 <? if($ordtypeF){?>
<strong>--- Fix order ---</strong>
<table cellpadding="2" cellspacing="0" border="0" class="Normal">
<tr><td> Method</td><td> <?=$ordfmethod?></td></tr>
<tr><td> Box color</td><td> <?=$ordfboxcolor?></td></tr>
<tr><td valign="top"> Type of work</td><td><pre><?=$ordftypeofworkt?>	</pre></td></tr>
<tr><td> Shade </td><td><?=getShadeName($ordfshade)?></td></tr>
<tr><td> Alloy </td><td> <?=getAlloyName($ordfalloy)?></td></tr>
<tr><td> Embrasure </td><td> <?=$ordfembrasure?></td></tr>
<tr><td> Type of pontic </td><td>
<img src="../resource/images/eorder/fix/fix_pontic<?=$ordfpontic-1?>.gif" width="32" height="32">
<?=$ordfponticmm?> mm
</td></tr>
<tr><td valign="top"> Option</td><td><pre><?=$ordfoptiont?></pre></td></tr>
<tr>
  <td valign="top">More Info</td>
  <td>
<? while (list ($key,$val) = @each ($ordfoptmoreinfo)) { ?>
- <?=$val?><br>
<? } ?>
  </td>
</tr>
<tr>
  <td valign="top">Remark</td>
  <td>
<? while (list ($key,$val) = @each ($ordfoptremark)) { ?>
- <?=$val?><br>
<? } ?>
  </td>
</tr>
<tr><td valign="top"> Observation </td><td><pre><?=$ordfobservation?></pre></td></tr>
 </table>
  <? }?>
 
 <? if($ordtypeR){?>
<strong>--- Remove order ---</strong>
<table cellpadding="2" cellspacing="0" border="0" class="Normal">
<tr><td> Method</td><td> <?=$ordrmethod?></td></tr>
<tr><td valign="top"> Type of work</td><td><pre><?=$ordrtypeofworkt?>	</pre></td></tr>
<tr><td> Shade </td><td><?=getShadeName($ordrshade)?></td></tr>
<tr><td valign="top"> Observation </td><td><pre><?=$ordrobservation?></pre></td></tr>
 </table>
  <? }?>
 
  <? if($ordtypeO){?>
<strong>--- Ortho order ---</strong>
<table cellpadding="2" cellspacing="0" border="0" class="Normal">
<tr><td> Method</td><td> <?=$ordomethod?></td></tr>
<tr><td valign="top"> Type of work</td><td><pre><?=$ordotypeofworkt?>	</pre></td></tr>
<tr><td> Shade </td><td><?=getShadeName($ordoshade)?></td></tr>
<tr><td valign="top"> Observation </td><td><pre><?=$ordoobservation?></pre></td></tr>
 </table>
  <? }?>
 
 
 
 
 
 
<input type="hidden" name="STEPBACK" value="5" />
<input type="hidden" name="STEPADD" value="30" />
<input type="hidden" name="customer" value="<?=$customer?>" />
<input type="hidden" name="doctor" value="<?=$doctor?>" />
<input type="hidden" name="patientname" value="<?=$patientname?>" />

<input type="hidden" name="orddate_day" value="<?=$orddate_day?>" />
<input type="hidden" name="orddate_month" value="<?=$orddate_month?>" />
<input type="hidden" name="orddate_year" value="<?=$orddate_year?>" />

<input type="hidden" name="ordreleasedate_day" value="<?=$ordreleasedate_day?>" />
<input type="hidden" name="ordreleasedate_month" value="<?=$ordreleasedate_month?>" />
<input type="hidden" name="ordreleasedate_year" value="<?=$ordreleasedate_year?>" />
<input type="hidden" name="ordreleasedate_hour" value="<?=$ordreleasedate_hour?>" />
<input type="hidden" name="ordreleasedate_minute" value="<?=$ordreleasedate_minute?>" />

<input type="hidden" name="isdocdate" value="<?=$isdocdate?"true":"false"?>" />
<input type="hidden" name="orddocdate_day" value="<?=$orddocdate_day?>" />
<input type="hidden" name="orddocdate_month" value="<?=$orddocdate_month?>" />
<input type="hidden" name="orddocdate_year" value="<?=$orddocdate_year?>" />
<input type="hidden" name="orddocdate_hour" value="<?=$orddocdate_hour?>" />
<input type="hidden" name="orddocdate_minute" value="<?=$orddocdate_minute?>" />
<input type="hidden" name="ordpriority" value="<?=$ordpriority?>" />


<input type="hidden" name="orddetail" value="<?=$orddetail?>" />
<input type="hidden" name="fixcode" value="<?=$fixcode?>" />
<input type="hidden" name="fixcodearg" value="<?=$fixcodearg?>" />
<input type="hidden" name="STEP" value="<?=$step?>" />


<input type="hidden" name="ordtypeF" value="<?=$ordtypeF?"true":"false"?>" />
<input type="hidden" name="ordfmethod" value="<?=$ordfmethod?>" />
<input type="hidden" name="ordfboxcolor" value="<?=$ordfboxcolor?>" />
<input type="hidden" name="ordftypeofworkt" value="<?=$ordftypeofworkt?>" />
<input type="hidden" name="ordfshade" value="<?=$ordfshade?>" />
<input type="hidden" name="ordfalloy" value="<?=$ordfalloy?>" />
<input type="hidden" name="ordfembrasure" value="<?=$ordfembrasure?>" />
<input type="hidden" name="ordfpontic" value="<?=$ordfpontic?>" />
<input type="hidden" name="ordfponticmm" value="<?=$ordfponticmm?>" />
<input type="hidden" name="ordfoptiont" value="<?=$ordfoptiont?>" />
<input type="hidden" name="ordfobservation" value="<?=$ordfobservation?>" />
<input type="hidden" name="ordfoptremark" value="<?=$ordfoptremark?>" />
<input type="hidden" name="ordfoptmoreinfo" value="<?=implode('|',$ordfoptmoreinfo)?>" />
<input type="hidden" name="ordfoptremark" value="<?=implode('|',$ordfoptremark)?>" />


<input type="hidden" name="ordtypeR" value="<?=$ordtypeR?"true":"false"?>" />
<input type="hidden" name="ordrmethod" value="<?=$ordrmethod?>" />
<input type="hidden" name="ordrtypeofworkt" value="<?=$ordrtypeofworkt?>" />
<input type="hidden" name="ordrshade" value="<?=$ordrshade?>" />
<input type="hidden" name="ordrobservation" value="<?=$ordrobservation?>" />

<input type="hidden" name="ordtypeO" value="<?=$ordtypeO?"true":"false"?>" />
<input type="hidden" name="ordomethod" value="<?=$ordomethod?>" />
<input type="hidden" name="ordotypeofworkt" value="<?=$ordotypeofworkt?>" />
<input type="hidden" name="ordoshade" value="<?=$ordoshade?>" />
<input type="hidden" name="ordoobservation" value="<?=$ordoobservation?>" />

	</td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td><input name="METHOD" type="submit" class="BTnextback" value="BACK" /></td><td align="right">
	  	  		<button onClick="METHOD.value='FINISH';addorderform20.submit();" class="BTfinish">
		<img src="../resource/images/silkicons/disk.gif"> Finish</button>
	  
	  
	  </td></tr></table></td>
  </tr>
</form>





<? break;case 40: ?>

  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
<strong>--- Add Complete ---</strong><br />
Customer : <?=$cusname?><br />
Code : E<?=$cntnick.$cusnick.$fixcode.$fixcodearg?><br />
Doctor : <?=$doctorname?><br />
Patient : <?=$patientname?><br />
งานเข้า : <?=$orddate_day?> <?=passThaiMonth($orddate_month)?> <?=passThaiYear($orddate_year)?><br/>
กำหนดออก : <?=$ordreleasedate_day?> <?=passThaiMonth($ordreleasedate_month)?> <?=passThaiYear($ordreleasedate_year)?>   <?=$ordreleasedate_hour?>:<?=$ordreleasedate_minute?><br />
หมอนัด : <? if($isdocdate){?>
<?=$orddocdate_day?> <?=passThaiMonth($orddocdate_month)?> <?=passThaiYear($orddocdate_year)?> 
 <?=$orddocdate_hour?>:<?=$orddocdate_minute?><? }else{echo"-";} ?>
<br/>
Priority :<strong> <?=$ordpriority?></strong><br />
<br/>
 <? if($ordtypeF){?>
<strong>--- Fix order ---</strong>
<table cellpadding="2" cellspacing="0" border="0" class="Normal">
<tr><td> Method</td><td> <?=$ordfmethod?></td></tr>
<tr><td> Box color</td><td> <?=$ordfboxcolor?></td></tr>
<tr><td valign="top"> Type of work</td><td><pre><?=$ordftypeofworkt?>	</pre></td></tr>
<tr><td> Shade </td><td><?=getShadeName($ordfshade)?></td></tr>
<tr><td> Alloy </td><td> <?=getAlloyName($ordfalloy)?></td></tr>
<tr><td> Embrasure </td><td> <?=$ordfembrasure?></td></tr>
<tr><td> Type of pontic </td><td>
<img src="../resource/images/eorder/fix/fix_pontic<?=$ordfpontic-1?>.gif" width="32" height="32">
<?=$ordfponticmm?> mm
</td></tr>
<tr><td valign="top"> Option</td><td><pre><?=$ordfoptiont?></pre></td></tr>
<tr><td valign="top"> Observation </td><td><pre><?=$ordfobservation?></pre></td></tr>
 </table>
  <? }?>
 
 <? if($ordtypeR){?>
<strong>--- Remove order ---</strong>
<table cellpadding="2" cellspacing="0" border="0" class="Normal">
<tr><td> Method</td><td> <?=$ordrmethod?></td></tr>
<tr><td valign="top"> Type of work</td><td><pre><?=$ordrtypeofworkt?>	</pre></td></tr>
<tr><td> Shade </td><td><?=getShadeName($ordrshade)?></td></tr>
<tr><td valign="top"> Observation </td><td><pre><?=$ordrobservation?></pre></td></tr>
 </table>
  <? }?>
 
   <? if($ordtypeO){?>
<strong>--- Ortho order ---</strong>
<table cellpadding="2" cellspacing="0" border="0" class="Normal">
<tr><td> Method</td><td> <?=$ordomethod?></td></tr>
<tr><td valign="top"> Type of work</td><td><pre><?=$ordotypeofworkt?>	</pre></td></tr>
<tr><td> Shade </td><td><?=getShadeName($ordoshade)?></td></tr>
<tr><td valign="top"> Observation </td><td><pre><?=$ordoobservation?></pre></td></tr>
 </table>
  <? }?>
</td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
	  <form action="../order/orderadd_c.php" method="post" name="addorderform">
	  <input type="hidden" name="STEPADD" value="0" />
        <td width="60%" align="right"><input name="METHOD" type="submit" class="BTok" value="Add another" /></td>
		</form>
	  <td align="right">
	  	<a href="../order/orderprint.php?eorderid=<?= $eorderid; ?>" target="_blank">
	<img src="../resource/images/silkicons/printer.gif" border="0"> print
	</a></td>
      </tr></table></td>
  </tr>


<? }?>

<? if($step!=5 && $step!=6){ ?>
</table>
</td></tr>
</table>
<? } ?>
</body></html>
