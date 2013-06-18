<? include_once("../core/default.php"); ?>
<html>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/default.js"></script><body>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
<tr><td height="50"><? $currentMenu="addinvoice";include_once("../invoice/invoicemenu.php"); ?></td></tr>
<tr>
  <td align="center" valign="top"><br>
    <br>
    
    
<? switch($step){ 
	case 1:
	?>    
    <table width="600" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td align="center" class="HeaderW">
	<img src="../resource/images/silkicons/package_add.gif" border="0" /> 	Add invoice </td>
  </tr>
    
    
    
    
  <form action="../invoice/invoiceadd_c.php" method="post" name="addorderform" >
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal">
<strong>--- Select customer ---</strong><br />
Customer <?  buildComboBoxList('customer','customer where cus_enable=TRUE and cus_cnt_id>1 order by cus_nick','customerid',array('cus_nick','cus_name'),$customer,"") ?><br />
      <input type="hidden" name="STEP" value="2" />
      </td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td>&nbsp;</td><td align="right"><input name="METHOD" type="submit" class="BTnextback" value="NEXT" /></td></tr></table></td>
  </tr>
</form>
</table>
<? break;
case 2:?>
    <table width="600" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
  <tr>
    <td align="center" class="HeaderW">
	<img src="../resource/images/silkicons/package_add.gif" border="0" /> 	Add invoice </td>
  </tr>
    
  <form action="../invoice/invoiceadd_c.php" method="post" name="addorderform" >
  <input type="hidden" name="customer" value="<?=$customer?>" />
  <input type="hidden" name="STEP" value="3" />
  <tr>
    <td height="200" valign="top" bgcolor="#FFFFFF" class="Normal"><strong>--- Select customer ---<br>
    </strong>Customer: <?= $data->ExecuteScalar("select cus_name from customer where customerid={$customer}"); ?>
    <br>
   <strong> Invoice No.</strong>  <input type="text" name="invoice_no" id="invoice_no" value="" />
    <br> 
    <strong>--- Select order ---</strong><br />
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#CCCCCC">
  <tr>
    <td width="50" class="HeaderTable">Select</td>
    <td width="150" class="HeaderTable">Invoice</td>
    <td width="150" class="HeaderTable">Eorder</td>
    <td class="HeaderTable">No</td>
    </tr>
  
  <?
	$data_m5m = new Csql();
	$data_eorder = new Csql();
	$err =	$data_m5m->Connect();
	$query = "select * from eorder_m5m,eorder
			where 
			ord_cus_id = $customer and
			eorderid = eorder_m5mid and
			m5m_inv_id = 0
			order by m5m_no
			";
	$data_m5m->Query($query);  
	
	$total = 0;
	
?>    
 <? while(!$data_m5m->EOF){
			$query = "select * from eorder where 
				eorderid ={$data_m5m->Rs('eorder_m5mid')} ";
			$data_eorder->Query($query);  
			
  			$inv_no = substr($data_m5m->Rs('m5m_no'),0,6);
  ?>
  <script>setValue('invoice_no','<?=$inv_no?>');</script>
  
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF">
    <input type="checkbox" name="eorder[]"  value="<?=$data_m5m->Rs('eorder_m5mid')?>" checked>
    <input type="hidden" name="m5m_no[<?=$data_m5m->Rs('eorder_m5mid')?>]"  value="<?=$data_m5m->Rs('m5m_no')?>">
    </td>
    <td valign="top" bgcolor="#FFFFFF">
	<a href="../mac5/mac5invoice.php?METHOD=GO!&code=<?=$data_m5m->Rs('ord_code')?>" target="b
    ">
	<?=$data_m5m->Rs('m5m_no')?></a>
    
    </td>
    <td valign="top" bgcolor="#FFFFFF"><?=$data_eorder->Rs("ord_code")?></td>
    <td valign="top" bgcolor="#FFFFFF"><?=$data_eorder->Rs("ord_no")?></td>
    </tr>
        <? $data_m5m->MoveNext(); ?>
     <? } ?>
</table>
<br>
<!--table width="100%" border="0">
  <tr>
    <td width="100">Service IN</td>
    <td><input type="text" name="service_in" value="" /></td>
  </tr>
  <tr>
    <td>Service OUT</td>
    <td><input type="text" name="service_out" value="" /></td>
  </tr>
</table-->
<br>
</td>
  </tr>
  <tr><td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr><td><input name="METHOD" type="submit" class="BTnextback" value="BACK" /></td><td align="right"><input name="METHOD" type="submit" class="BTnextback" value="NEXT" /></td></tr></table></td>
  </tr>
</form>
</table>
<? break;}?>
</td></tr>
</table>

</body></html>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>