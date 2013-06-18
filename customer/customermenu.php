<? 
$temp = $currentMenu;
$currentMenu="customer"; include ("../core/mainmenu.php"); 

?>


<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />

<table width="100%" height="25" border="0" cellpadding="0" cellspacing="7" background="../cfrontend/images/bg_03.png">
  <tr>
    <td width="150" height="26" align="center" <?=$temp=="customerlist"?'class="MenuTab"':''?>>
	<a href="../customer/customerlist_c.php">
	<img src="../resource/images/silkicons/building.gif" border="0" /> Customer list</a> </td>
    <td width="150" height="26" align="center" <?=$temp=="addcustomer"?'class="MenuTab"':''?>>
	<a href="../customer/customeradd_c.php">
	<img src="../resource/images/silkicons/building_add.gif" border="0" /> Add customer</a>  </td>
    <td height="26">&nbsp;</td>
  </tr>
</table>
