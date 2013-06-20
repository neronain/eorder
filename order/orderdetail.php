
<html>
<head>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/default.js"></script>
<script type="text/javascript">
function OnclickRemark(){
	if(!findObj("isremark").checked){
		findObj("tdSave").style.display = "none";
		if(findObj("txtRemark").value.length>0 ){
			if(confirm("ลบข้อมูลหมายเหตุ")){
				findObj("txtRemark").value ='';
				findObj("formSetRemark").submit();
			}else{
				findObj("isremark").checked = true;
				findObj("tdSave").style.display = "inline";
			}
			 
		}
	}else{
		findObj("tdSave").style.display = "inline";
	}
}
</script>
	
</head>

<body>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"></td></tr>
<tr><td align="center" valign="top">
<table width="600" border="0" align="center" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td  class="HeaderW"><table width="100%" border="0" cellspacing="0" cellpadding="0"  class="HeaderW">
        <form action="../order/orderedit_c.php" method="post" name="orderedit">
		<input type="hidden" name="eorderid" value="<?=$data_eorder->Rs("eorderid");?>" />
		<tr>
          <td>Order detail </td>
		  
          <td align="right">
		  <a href="javascript:orderedit.submit()"  alt="Edit information">
		  <img src="../resource/images/silkicons/vcard_edit.gif" width="16" height="16" border="0">		  </a>		  </td>
        </tr> </form>
      </table></td>
  </tr>
  
  <tr>
    <td bgcolor="#FFFFFF" class="Normal">
    <table width="100%" border="0" cellpadding="2" cellspacing="0" class="Normal">
        <tr>
          <td width="100">order code </td>
          <td><?=$data_eorder->Rs("ord_code");?> [<?=getFixCodeArg($data_eorder->Rs("ord_code"));?>]</td>
        </tr>
		  <tr>
          <td width="100"><strong>Status</strong></td>
          <td><strong><?=$status=="IN"?"At $room room":"Waiting for next room" ?></strong></td>
        </tr>
        <tr>
          <td width="100">customer</td>
          <td>
		  <a href="../customer/customerdetail_c.php?customerid=<?= $data_eorder->Rs("customerid"); ?>"
				 target="_blank">
				
		  <?=$data_eorder->Rs("cus_name");?></a>		  </td>
        </tr>
        <tr>
          <td width="100">doctor</td>
          <td><?=$data_eorder->Rs("doc_name");?></td>
        </tr>
        <tr>
          <td width="100">Patient</td>
          <td><?=$data_eorder->Rs("ord_patientname");?></td>
        </tr>
	<tr>
    <td width="100">งานเข้า</td>
    <td>
	<?=$data_eorder->Rs("ord_dated");?> 
	<?=passThaiMonth($data_eorder->Rs("ord_datem"));?> 
	<?=passThaiYear($data_eorder->Rs("ord_datey"));?></td>
  </tr>
    <tr>
    <td width="100">กำหนดออก</td>
    <td><?=$data_eorder->Rs("ord_releasedated");?> 
	<?=passThaiMonth($data_eorder->Rs("ord_releasedatem"));?> 
	<?=passThaiYear($data_eorder->Rs("ord_releasedatey"));?> 
	<?=$data_eorder->Rs("ord_releasedateh");?>:<?=$data_eorder->Rs("ord_releasedatemn");?>	 </td>
  </tr>  
    <tr>
    <td width="100">หมอนัด</td>
    <td>
	<? if($data_eorder->Rs("ord_docdatey")+0>0){?>
	<?=$data_eorder->Rs("ord_docdated");?> 
	<?=passThaiMonth($data_eorder->Rs("ord_docdatem"));?> 
	<?=passThaiYear($data_eorder->Rs("ord_docdatey"));?>
	 <?=$data_eorder->Rs("ord_docdateh");?>:<?=$data_eorder->Rs("ord_docdatemn");?><? }else{echo"-";} ?>	 </td>
  </tr> 
  <form method="post" name="formSetRemark">
  
  <input type="hidden" name="eorderid"  value="<?=$eorderid?>"> 
  <input type="hidden" name="METHOD"  value="Save"> 
  <tr><td  align="top" valign="top">หมายเหตุ  
  		<input name="isremark" type="checkbox" id="isremark"  
		<?=strlen($remark)>0?"checked":"" ?>  onClick="OnclickRemark();"></td>
  <td  align="buttom" id="tdSave" style="display:none"><label></label>
      <textarea name="txtRemark" id="txtRemark" cols="45" rows="2"><?=$remark?></textarea>
      <input type="submit" class="BTupdate" value="Save" />
  <td></tr> 
	</form>
    <tr>
      <td colspan="2"><hr></td>
      </tr>
    <tr>
    <td width="100">Detail</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
	<ul><pre><?=$data_eorder->Rs("ord_detail");?> </pre></ul>	</td>
    </tr>
	        <tr>
          <td width="100" >	</td>
          <td>
		  <? if($ordtypeF){?>
<strong>--- Fix order ---</strong>
<table cellpadding="2" cellspacing="0" border="0" class="Normal">
<tr><td> Method</td><td> <?=$ordfmethod?></td></tr>
<tr><td valign="top"> Type of work</td><td><pre><?=$ordftypeofworkt?>	</pre></td></tr>
<tr><td> Shade </td><td><?=getShadeName($ordfshade)?></td></tr>
<tr><td> Alloy </td><td> <?=getAlloyName($ordfalloy)?></td></tr>
<tr><td> Embrasure </td><td> <?=$ordfembrasure?></td></tr>
<tr><td> Type of pontic </td><td>
<img src="../resource/images/eorder/fix/fix_pontic<?=($ordfpontic)?>.gif" width="32" height="32"></td></tr>
<tr><td valign="top"> Option</td><td><pre><?=$ordfoptiont?></pre></td></tr>
<? if(count($ordfoptmoreinfo)+0>0){?>
<tr>
  <td valign="top">More Info</td>
  <td>
<? while (list ($key,$val) = @each ($ordfoptmoreinfo)) { ?>
- <?=$val?><br>
<? } ?>
  </td>
</tr><? } ?>
<? if(count($ordfoptremark)+0>0){?>
<tr>
  <td valign="top">Remark</td>
  <td>
<? while (list ($key,$val) = @each ($ordfoptremark)) { ?>
- <?=$val?><br>
<? } ?>
  </td>
</tr><? } ?>
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
<tr><td> Shade </td><td><?=$ordoshade?></td></tr>
<tr><td valign="top"> Observation </td><td><pre><?=$ordoobservation?></pre></td></tr>
 </table>
  <? }?>  </td>
          </tr>

        <tr>
          <td width="100">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="100">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="100">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="100">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td width="100">&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
      </table>
      </td>
  </tr>


  <tr>
    <td class="FooterTD">
	<table width="100%" cellpadding="0" cellspacing="0">
	  <tr><td></td><td align="right">
	
	<a href="../order/orderprint.php?eorderid=<?= $data_eorder->Rs("eorderid"); ?>" target="_blank">
	<img src="../resource/images/silkicons/printer.gif" border="0"> print
	</a>
	
	</td>
	  </tr></table>	</td>
  </tr>
    <tr>
    <td bgcolor="#FFFFFF" >
	<table width="100%" border="0" cellpadding="2" cellspacing="2" class="Normal">
        <tr>
          <td colspan="4" class="HeaderW">Logbook
            <?=$data_eorder->Rs("ord_code");?></td>
          </tr>
        <tr>
          <td class="HeaderTable">Date</td>
          <td class="HeaderTable">Section</td>
          <td class="HeaderTable">Staff</td>
          <td class="HeaderTable">Type</td>
        </tr>
<? 
$oldtime = 0 ;
$timediff = 0;
$arraytimediff = array();
$count = 0;
$totaltimediff = 0;
while(!$data_logbook->EOF){ 
$timediff = $data_logbook->Rs("log_dateD")-$oldtime;
if($oldtime!=0){
	$arraytimediff[$count] = $timediff;
	$count++;
	$totaltimediff+=$timediff;
}
$oldtime = $data_logbook->Rs("log_dateD");

?>
        <tr>
          <td><?= $data_logbook->Rs("log_date"); ?></td>
          <td><?= $data_logbook->Rs("sec_room"); ?></td>
          <td><?= $data_logbook->Rs("stf_name"); ?></td>
          <td><?= $data_logbook->Rs("log_type"); ?></td>
        </tr>
<? $data_logbook->MoveNext();	} ?>		
      </table>
		<? 
	echo "<table width=100% border=0 cellpading=0 cellspacing=0><tr>";
	$count=0;
	foreach($arraytimediff as $timediff){
		$hr = floor($timediff/3600);
		$mn = floor(($timediff%3600)/60);
		$sc = ($timediff%3600)%60;
		
	//echo "$hr:$mn:$sc ";
	echo "<td width=".  round($timediff*100.0/$totaltimediff) . "%  
	bgcolor = #".($count%2==0?"99FF99":"FF9999")."
	height = 5></td>";
	
		$count++;

	}
	
	echo "</tr></table>"
	
	?>
	</td>
  </tr>
</table></td></tr></table>
</body>
</html>
<script>
OnclickRemark();
</script>
