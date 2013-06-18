<? include_once("../core/default.php"); ?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="background-color:#FFFFFF">
<? /* */include_once("../cfrontend/ordersummary.php"); ?>
<? /* */ include_once "../resource/divbackground.php" ?>
<center> 
  <strong><span class="Normal"><font size="+2">Order invoice list<br>
Invoice Date :
  <?=($cdate+0)?> <?=passThaiMonth($cmonth)?> <?=passThaiYear($cyear)?> - 
  <?=($edate+0)?> <?=passThaiMonth($emonth)?> <?=passThaiYear($eyear)?>
</font> </span></strong></center>
		<table  border="0" cellpadding="2" cellspacing="1" bgcolor="#000000" id="exporttb">
<tr>
<td class="HeaderTable">&nbsp;</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Invoice NO.</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">วันที่</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Customer</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Doctor</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Patient</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Order code</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Work</td>
<td class="HeaderTable" style="font-size:12px;font-weight:normal">Mac 5</td>
</tr>
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


			  <tr valign="top" bgcolor="#FFFFFF" class="Normal" >
				<td align="right"><?= $index++ ?></td>
				<td nowrap><?= $dt_order['m5m_no']; ?></td>
				<td nowrap><?= $dt_order['m5m_date']; ?></td>
				<td nowrap><?=$dt_order["m5m_cum_code"]?> <?= reduceName($dt_order["cus_name"]); ?></td>
				<td nowrap><?= $dt_order["doc_name"]; ?> </td>
				<td nowrap><?= $dt_order["ord_patientname"]; ?> </td>
<td  class="tdRowOnOut" onClick="OpenDivShowSummary(<?= $dt_order["eorderid"]?>)" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'">
				<span style="color: #0000FF"><?= $dt_order["ord_code"]; ?></span></a></td>				<td nowrap>
				<? 
					/*if($type=="F"){
						echo $dt_order["ordf_typeofworkt"];
					}else if($type=="R"){
						echo $dt_order["ordr_typeofworkt"]; 
					}else if($type=="M"){*/
						//echo $dt_order["ordf_typeofworkt"]."&nbsp;".$dt_order["ordr_typeofworkt"]."&nbsp;".$dt_order["ordo_typeofworkt"];
						echo $dt_order["ord_typeofwork"];
					//}
				 ?>			<? if($dt_order["eorder_fixid"]>0){?>
				
						<?=getAlloyName($dt_order["ordf_alloy"])?>
					
					<? } ?>
                    
                    	</td>
				
				

				<td nowrap>
                <table border="0" cellpadding="1" cellspacing="0" bgcolor="#000066">
               <?
				$data2 = new csql();
				$data2->Query("select * from eorder_m5d where eorder_m5did = ".$dt_order['eorder_m5mid']." order by m5d_index");
				while(!$data2->EOF){ ?>
                <tr>
                  <td width="100" align="center" nowrap bgcolor="#FFFFFF"><?=$data2->Rs("m5d_pdc_code")?></td>
                  <td width="400" nowrap bgcolor="#FFFFFF"><?=$data2->Rs("m5d_pdc_name")?></td>
                  <td width="100" nowrap bgcolor="#FFFFFF"><?=$data2->Rs("m5d_vcol")?></td>
                  <td width="25" align="right" nowrap bgcolor="#FFFFFF"><?=number_format($data2->Rs("m5d_qty"),0)?></td>
                  <td width="50" align="right" nowrap bgcolor="#FFFFFF"><?=number_format($data2->Rs("m5d_price"),0)?></td>
                  </tr>
                <? $data2->MoveNext();	} ?>
                </table></td>
		    </tr>
			<? } ?> 
        </table>
</body></html>
<script>hideLoading()</script>
<? 
include_once '../core/inc_pngfix.php';
//echo replacePngTags(ob_get_clean()); ?>