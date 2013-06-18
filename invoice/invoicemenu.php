<? 
$temp = $currentMenu;
$currentMenu="invoice"; include ("../core/mainmenu.php"); 

?>


<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />

<table width="100%" height="25" border="0" cellpadding="0" cellspacing="7" background="../cfrontend/images/bg_03.png">
  <tr>
    <td width="150" height="26" align="center" <?=$temp=="invoicelist"?'class="MenuTab"':''?>>
	<a href="../invoice/invoicelist_c.php">
    Invoice list</a> </td>
    <td width="150" height="26" align="center" <?=$temp=="addinvoice"?'class="MenuTab"':''?>>
	<a href="../invoice/invoiceadd_c.php">
    Add invoice</a>  </td>
    <td height="26">&nbsp;</td>
  </tr>
</table>
<?
//"../staff/staffprint.php"
?>