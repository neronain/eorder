<? 
$temp = $currentMenu;
$currentMenu="report"; include ("../core/mainmenu.php"); 

?>

<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" background="../cfrontend/images/bg_03.png">
<tr><td>
<table border="0" cellpadding="0" cellspacing="7"  background="../cfrontend/images/bg_03.png">
  <tr>
    <td width="50">&nbsp;</td>
    <td width="120" height="26" align="center" <?=$temp=="processorder"?'class="MenuTab"':''?>>
	<a href="../order/orderprocesslist_q.php"> Processing order</a>  </td>
    <td width="120" height="26" align="center" <?=$temp=="releaseorder"?'class="MenuTab"':''?>>
	<a href="../order/orderexportlist_q.php">	  Release order</a>  </td>
    <td width="120" height="26" align="center" <?=$temp=="deliveryorder"?'class="MenuTab"':''?>>
	<a href="../order/orderdeliverylist_q.php">	  Delivery order</a>  </td>
    <td width="120" height="26" align="center" <?=$temp=="summaryorder"?'class="MenuTab"':''?>>
	<a href="../report/summarylist_q.php">	  Summary</a>  </td>
    <td width="120" height="26" align="center" <?=$temp=="invoiceorder"?'class="MenuTab"':''?>>
	<a href="../report/invoicelist_q.php">	  Invoice</a>  </td>
    <td width="120" height="26" align="center" <?=$temp=="repairorder"?'class="MenuTab"':''?>>
	<a href="../report/repairlist_q.php">	  Repair</a>  </td>

    <td></td>
  </tr>
</table>
</td></tr></table>
