<? 
$temp = $currentMenu;
$currentMenu="staff"; include ("../core/mainmenu.php"); 

?>


<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />

<table width="100%" height="25" border="0" cellpadding="0" cellspacing="7" background="../cfrontend/images/bg_03.png">
  <tr>
    <td width="150" height="26" align="center" <?=$temp=="stafflist"?'class="MenuTab"':''?>>
	<a href="../staff/stafflist_c.php">
	<img src="../resource/images/silkicons/group.gif" border="0" /> Staff list</a> </td>
    <td width="150" height="26" align="center" <?=$temp=="addstaff"?'class="MenuTab"':''?>>
	<a href="../staff/staffadd_c.php">
	<img src="../resource/images/silkicons/group_add.gif" border="0" /> Add staff</a>  </td>
	    <td height="26">&nbsp;</td>
    <td width="150" height="26"  align="center" <?=$temp=="staffsectionlist"?'class="MenuTab"':''?>>
	<a href="../staff/staffsectionlist_c.php">
    <img src="../resource/images/silkicons/printer.gif" border="0" /> Print staff</a>
    </td>
    <td width="150" height="26"  align="center" <?=$temp=="staffsectionlist"?'class="MenuTab"':''?>>
    <a href="#" onclick="popUpWindow('../order/defectprint.php',100,100,800,600);return false;">
    <img src="../resource/images/silkicons/printer.gif" border="0" /> Print defect</a>
    </td>
  </tr>
</table>
<?
//"../staff/staffprint.php"
?>