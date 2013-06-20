<? include_once("../core/default.php"); ?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="background-color:#FFFFFF">
<center> 
  <strong><span class="Normal"><font size="+2">Order export list<br>
<?=$order=="arrive"?"Entry ":"Delivery "?> Date :
  <?=($cdate+0)?> <?=passThaiMonth($cmonth)?> <?=passThaiYear($cyear)?> - 
  <?=($edate+0)?> <?=passThaiMonth($emonth)?> <?=passThaiYear($eyear)?>
</font> </span></strong></center>
		<table  border="0" cellpadding="2" cellspacing="1" bgcolor="#000000" id="exporttb">

<? 

if($order=="arrive"){
	$sourcecol = "endate";
	$nonsourcecol = "deliverydate";
}else{
	$sourcecol = "deliverydate";
	$nonsourcecol = "endate";
}



$index=1;
foreach($data_orderAr as $dt_order){

?>
<? if($dt_order[$sourcecol]!=$tmpexdate){ ?>
<? if(isset($tmpexdate)){ ?>
<tr>
  <td colspan="11" bgcolor="#FFFFFF">&nbsp;</td>
</tr>
<? } ?>
<? $tmpexdate=$dt_order[$sourcecol];$index=1; ?>
<tr>
  <td colspan="11" class="HeaderTable">
<strong>Date : <?=($dt_order["ord_".$order."dated"]+0)?> <?=passThaiMonth($dt_order["ord_".$order."datem"])?> <?=passThaiYear($dt_order["ord_".$order."datey"])?></strong></td>
</tr>
<tr>
<td class="HeaderTable">&nbsp;</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal"><?=$order=="arrive"?"Release":"Entry"?></td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">หมอนัด</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Customer</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Doctor</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Patient</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Order code</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Work</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">ประเทศ</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">หมายเหตุ</td>
</tr>
<? } ?>

			  <tr valign="top" bgcolor="#FFFFFF" class="Normal" >
				<td align="right"><?= $index++ ?></td>
				<td nowrap><?= $dt_order[$nonsourcecol]; ?></td>
				<td nowrap><?= str_replace("00/00","-",str_replace("00:00","",$dt_order["docdate"])); ?></td>
				<td nowrap><?= reduceName($dt_order["cus_name"]); ?></td>
				<td nowrap><?= $dt_order["doc_name"]; ?> </td>
				<td nowrap><?= $dt_order["ord_patientname"]; ?> </td>
				<td nowrap  ><?= $dt_order["ord_code"]; ?></td>
				<td nowrap>
				<? 
					/*if($type=="F"){
						echo $dt_order["ordf_typeofworkt"];
					}else if($type=="R"){
						echo $dt_order["ordr_typeofworkt"]; 
					}else if($type=="M"){*/
						//echo $dt_order["ordf_typeofworkt"]."&nbsp;".$dt_order["ordr_typeofworkt"]."&nbsp;".$dt_order["ordo_typeofworkt"];
						echo $dt_order["ord_typeofwork"];
					//}
				 ?>				</td>
				
				
				<td nowrap><?= $dt_order["cnt_name"]; ?> </td>
				<td nowrap><? if($dt_order["eorder_fixid"]>0){?>
				
						<?=getAlloyName($dt_order["ordf_alloy"])?>
					
					<? } ?></td>
		    </tr>
			<? } ?> 
        </table>
</body></html>

<? 
include_once '../core/inc_pngfix.php';
//echo replacePngTags(ob_get_clean()); ?>