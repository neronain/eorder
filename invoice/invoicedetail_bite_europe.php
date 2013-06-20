<?
?>
<html>
<head>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
</head>
<style>
body td{
	font-size:12px;
}
</style>
<body>

<table width="100%" height="100%" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
<tr><td height="10"></td></tr>
<tr><td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0" >
  <tr>
    <td width="200">&nbsp;</td>
    <td width="200" valign="top"><span class="popNormal">HEXA CERAM Co.,LTD</span><br>
             213 moo 5 Sanpraned <br>
            SanSai Chiang Mai <br>
            50210 Thailand<br>
        Tel. 052 380801-2 <br>
        Fax 053 380471</td>
    <td valign="top">INVOICE/TAX INVOICE<br>
      INVOICE NO.
      <?= $data_invoice->Rs("inv_no"); ?>
      <br>
      DATE:
      <?= $data_invoice->Rs("inv_date"); ?>
      <br>
      REFERENCE:<br>
      <br>
      VAT NO.
      <?= $data_invoice->Rs("invoiceid"); ?><br></td>
  </tr>
</table>

    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:solid 2px #000000">
  <tr>
    <td align="left" valign="top">CUSTOMER:</td>
    <td width="300" align="left" valign="top"> <?= $data_invoice->Rs("cus_name"); ?></td>
    <td align="left" valign="top" style="border-left:solid 2px #000000">CONSIGNEE:</td>
  </tr>
  <tr>
    <td width="100" align="left" valign="top">ADDRESS</td>
    <td align="left" valign="top">
   
    <?= $data_invoice->Rs("cus_address"); ?><br>
	<?= $data->ExecuteScalar("select prv_name from province where provinceid={$data_invoice->Rs('cus_prv_id')}"); ?><br>
    <?= $data->ExecuteScalar("select cnt_name from country where countryid={$data_invoice->Rs('cus_cnt_id')}"); ?>   </td>
    <td align="left" valign="top" style="border-left:solid 2px #000000">DELIVERY:<br>
      ADDRESS:<br>
      YOUR REF:</td>
  </tr>
  <tr>
    <td align="left" valign="top">Tel: </td>
    <td align="left" valign="top"><?= $data_invoice->Rs("cus_tel"); ?></td>
    <td align="left" valign="top" style="border-left:solid 2px #000000">&nbsp;</td>
  </tr>
</table></td>
</tr>
<tr>
  <td align="left" valign="top" height="500"><br>
<?
	$data_m5m = new Csql();
	$err =	$data_m5m->Connect();
	$query = "select * from eorder_m5m
		where 
			m5m_inv_id =$invoiceid ";
	$data_m5m->Query($query);  
	
	$total = 0;
	
?>  
    <table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:solid 2px #000000">
    <tr>
      <td width="100" rowspan="2" align="center" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><strong>ORDER NO.</strong></td>
      <td colspan="3" align="center" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><strong>WORK REFERENCE</strong></td>
      
      <td rowspan="2" align="center" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><strong>Description</strong></td>
      <td width="60" rowspan="2" align="center" class="prints" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><strong>QUANTITY</strong></td>
      <td width="70" rowspan="2" align="center" class="prints" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><strong>UNIT PRICE<br>
         (<?=substr($data_invoice->Rs("cus_pricegroup"),0,3)?>)</strong></td>
      <td width="60" rowspan="2" align="center" class="prints" style="border-bottom:solid 2px #000000"><strong>AMOUNT<br> 
        (
        <?=substr($data_invoice->Rs("cus_pricegroup"),0,3)?>)</strong></td>
    </tr>
    <tr>
      <td width="100" align="center" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><strong>AGENT/CODE</strong></td>
      <td width="100" align="center" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><strong>DOCTOR</strong></td>
      <td width="100" align="center" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><strong>PATIENT</strong></td>
      </tr>
<?
			$data_eorder = new Csql();
			$data_m5d = new Csql();
	?>    
    <? while(!$data_m5m->EOF){
			$query = "select * from eorder where 
				eorderid ={$data_m5m->Rs('eorder_m5mid')} ";
			$data_eorder->Query($query);  
			$query = "select * from eorder_m5d where 
				eorder_m5did ={$data_m5m->Rs('eorder_m5mid')} order by m5d_index";
			$data_m5d->Query($query);  
			
			if($agent[$data_eorder->Rs('ord_agn_id')]==null){
				$agent[$data_eorder->Rs('ord_agn_id')] = 
					$data->ExecuteScalar("select agn_name from agent where agentid={$data_eorder->Rs('ord_agn_id')}");
			}
			if($doctor[$data_eorder->Rs('ord_doc_id')]==null){
				$doctor[$data_eorder->Rs('ord_doc_id')] = 
					$data->ExecuteScalar("select doc_name from doctor where doctorid={$data_eorder->Rs('ord_doc_id')}");
			}
	
	?>
    <tr>
      <td align="center" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><?=$data_eorder->Rs("ord_no")?></td>
      <td align="left" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000;"><span style="padding-left:4px">
        <?= $agent[$data_eorder->Rs('ord_agn_id')] ?>
      </span></td>
      <td align="left" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><span style="padding-left:4px">
        <?= $doctor[$data_eorder->Rs('ord_doc_id')] ?>
      </span> </td>
      <td align="left" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000"><span style="padding-left:4px">
        <?=$data_eorder->Rs("ord_patient")?>
      </span> </td>
      <td colspan="4" style="border-bottom:solid 2px #000000">
      <table width="100%" cellpadding="0" cellspacing="0">
       <? while(!$data_m5d->EOF){
	   $total+=$data_m5d->Rs("m5d_price")*$data_m5d->Rs("m5d_qty");
	   ?>
      	<tr>
      	  <td align="left" style="border-right:solid 2px #000000"><span style="padding-left:10px">
      	    <?=$data_m5d->Rs("m5d_pdc_name")?>
      	  </span></td>
      	  <td width="60" align="center" style="border-right:solid 2px #000000"><?=$data_m5d->Rs("m5d_qty")+0?></td>
      	  <td width="80" align="center" style="border-right:solid 2px #000000"><?=$data_m5d->Rs("m5d_price")?></td>
      	  <td width="50" align="right" style="padding-right:10px"><?=number_format($data_m5d->Rs("m5d_price")*$data_m5d->Rs("m5d_qty"),2)?>	      </td></tr>
       <? $data_m5d->MoveNext(); ?>
      <? } ?>
      </table>      </td>
      </tr>
      <? $data_m5m->MoveNext(); ?>
     <? } ?>
      
      
    <tr>
      <td style="border-right:solid 2px #000000;border-bottom:solid 2px #000000">&nbsp;</td>
      <td style="border-right:solid 2px #000000;border-bottom:solid 2px #000000">&nbsp;</td>
      <td style="border-right:solid 2px #000000;border-bottom:solid 2px #000000">&nbsp;</td>
      <td style="border-right:solid 2px #000000;border-bottom:solid 2px #000000">&nbsp;</td>
      
      <td align="center" style="border-right:solid 2px #000000;border-bottom:solid 2px #000000">ORIGIN OF THAILAND</td>
      <td style="border-right:solid 2px #000000;border-bottom:solid 2px #000000">&nbsp;</td>
      <td style="border-right:solid 2px #000000;border-bottom:solid 2px #000000">&nbsp;</td>
      <td style="border-bottom:solid 2px #000000">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td colspan="2" align="right" valign="bottom" style="border-right:solid 2px #000000;">TOTAL</td>
      <td style="border-bottom:solid 2px #000000;padding-right:10px" align="right"><?=number_format($total,2)?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td colspan="2" align="right" valign="bottom" style="border-right:solid 2px #000000;">VAT 0.00 </td>
      <td style="border-bottom:solid 2px #000000;padding-right:10px" align="right">0.00</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td colspan="2" align="right" valign="bottom" style="border-right:solid 2px #000000;">SUB TOTAL</td>
      <td style="border-bottom:solid 2px #000000;padding-right:10px" align="right"><?=number_format($total,2)?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td colspan="2" align="right" valign="bottom" style="">&nbsp;</td>
      <td style="padding-right:10px" align="right">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td colspan="2" align="right" valign="bottom" style="border-bottom:solid 2px #000000;">&nbsp;</td>
      <td style="border-bottom:solid 2px #000000;padding-right:10px" align="right">&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td colspan="2" align="right" valign="bottom" style="border-right:solid 2px #000000;">TOTAL FOB</td>
      <td align="right" style="border-bottom:solid 2px #000000;padding-right:10px"><?=number_format($total,2)?></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td colspan="2" align="right" valign="bottom" style="border-right:solid 2px #000000;">HANDING &amp; FREIGHT</td>
      <td align="right" style="border-bottom:solid 2px #000000;padding-right:10px">0.00</td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td colspan="2" align="right" style="border-right:solid 2px #000000;">GRAND TOTAL</td>
      <td align="right" style="padding-right:10px"><?=number_format($total,2)?></td>
    </tr>
  </table></td>
</tr>
<tr>
  <td align="left" valign="top" ><table width="100%" border="0">
      <tr>
        <td width="400" align="right">BRUSSELS/BELGIUM</td>
        <td bgcolor="#CCCCCC" style="font-size:14px;font-weight:bold"><?=num2words($total);?></td>
      </tr>
    </table></td>
</tr>
<tr>
  <td align="left" valign="top">&nbsp;</td>
</tr>
<tr>
  <td align="left" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="2">
    <tr>
      <td width="200"><strong>COUNTRY OF REGION</strong></td>
      <td><strong>THAILAND</strong></td>
      <td width="200">TERM OF PAYMENT: NET 30</td>
    </tr>
    <tr>
      <td><strong>ACCOUNT NAME:</strong></td>
      <td colspan="2"><strong>HEXA CERAM CO., LTD.</strong></td>
    </tr>
    <tr>
      <td><strong>BANK:</strong></td>
      <td colspan="2"><strong>KASIKORNBANK</strong></td>
    </tr>
    <tr>
      <td><strong>SWIFT CODE:</strong></td>
      <td colspan="2"><strong>KASITHBK</strong></td>
    </tr>
    <tr>
      <td><strong>NO:</strong></td>
      <td colspan="2"><strong>406-2-04868-4</strong></td>
    </tr>
    <tr>
      <td><strong>BRANCH:</strong></td>
      <td colspan="2"><strong>Yoi Sam Yak Sansai Chiangmai Thailand</strong></td>
    </tr>
  </table></td>
</tr>
</table>
</body>
</html>

