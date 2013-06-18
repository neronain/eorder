<?php
	include_once("../core/default.php");
	//$eorder_id = $_GET["eorderid"];
	GetVar($eorder_id,"eorderid");
	//$eorder_id = 1000007;
	$data = new Csql();
	$data->Connect();
	$data->Query("select ord_code,ord_cus_id from eorder where eorderid=$eorder_id limit 1");
	if(!$data->EOF) {
		$order_code = $data->Rs("ord_code");
		$customer_id = $data->Rs("ord_cus_id");
		if(isset($order_code) && $order_code != "") {
			$code = substr($order_code,0,count($order_code)-3);
		}
		$data->Query("select * from eorder where ord_cus_id = $customer_id and left(ord_code,14)= '$code' order by ord_code asc");
?>
<br />
<table cellpadding="0" cellspacing="0" border="0" width="100%">
      <tr><td>
<?
		while(!$data->EOF) {
?>
<table cellpadding="2" cellspacing="1" border="0" width="100%" bgcolor="<?= ($data->Rs("ord_code") == $order_code) ? "#FFFFCC" : "#FFFFFF" ?>"  onclick="OrderSummaryCurrentTab='overview';OpenDivShowSummary(<?=$data->Rs("eorderid")?>)" class="tableOnOut" onMouseOver="this.className='tableOnOver'" onMouseOut="this.className='tableOnOut'">
<tr>
	<td style="width:150px"><strong>Code</strong></td>
    <td>&nbsp;<?=$data->Rs("ord_code")?></td>
    <td width="330" rowspan="10" align="center" valign="middle">
    <table  border="0" cellpadding="0" cellspacing="1" bgcolor="#000000">
      <tr>
        <td width="320" height="240" align="center" valign="middle" bgcolor="#FFFFFF">    
		<? if(file_exists("../file/eorderrelease/".$data->Rs("ord_code").".png")){?>
   		<img src="../file/eorderrelease/<?=$data->Rs("ord_code")?>.png" width="320" height="240" />
    	<? }else{ ?>
        No photo 
        <? } ?>        </td>
      </tr>
    </table>      </td>
</tr>
<tr>
  <td valign="top"><strong>Type of work</strong></td>
  <td><?=$data->Rs("ord_typeofwork")?></td>
</tr>
<tr>
  <td><strong>Send date</strong></td>
  <td>&nbsp;<?=$data->Rs("ord_senddate")?></td>
  </tr>
<tr>
  <td><strong>Arrived date</strong></td>
  <td>&nbsp;<?=$data->Rs("ord_arrivedate")?></td>
  </tr>
<tr>
  <td><strong>Processing date</strong></td>
  <td>&nbsp;<?=$data->Rs("ord_processdate")?></td>
  </tr>
<tr>
  <td><strong>Delivery date</strong></td>
  <td>&nbsp;<?=$data->Rs("ord_sendbackdate")?></td>
  </tr>
<tr>
  <td><strong>Got back date</strong></td>
  <td>&nbsp;<?=$data->Rs("ord_gotdate")?></td>
  </tr>
<tr>
  <td><strong>Paid date</strong></td>
  <td>&nbsp;<?=$data->Rs("ord_paiddate")?></td>
  </tr>
<tr>
  <td><strong>Archieve date</strong></td>
  <td>&nbsp;<?=$data->Rs("ord_archievedate")?></td>
  </tr>
<tr>
  <td colspan="2">&nbsp;</td>
  </tr>
</table>
<br />
<?
			$data->MoveNext();
		}
?>
	</td></tr>
</table>
<?
	}
?>
