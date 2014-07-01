<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />

<table width="100%" border="0" cellpadding="0" cellspacing="0" class="MenuTable" >
<tr>
<td colspan="10" height="5" bgcolor="#999999"></td>
</tr>
  <tr>
    <td width="50" height="30" align="center"  class="Normal" style="background-color:#999999;color:#FFFFFF"> Menu</td>

    <td width="100" height="30" align="center" valign="bottom" bgcolor="#999999"  style="background-repeat:no-repeat;cursor:pointer;background-image:url('../cfrontend/images/tab<?=($currentMenu=='order')?"over":"out"?>.png');" onclick="location='../order/orderhome.php'">
    <img src="../resource/images/menu/main_menu_order.gif" width="96" height="24" border="0" style="cursor:pointer" /></td>
    <td width="100" height="30" align="left" valign="bottom" bgcolor="#999999"   style="background-repeat:no-repeat;cursor:pointer;background-image:url('../cfrontend/images/tab<?=($currentMenu=='invoice')?"over":"out"?>.png');" onclick="location='../invoice/invoicehome.php'"> <img src="../resource/images/menu/main_menu_invoice.gif" width="84" height="24" border="0" style="cursor:pointer" /></td>
    <td width="100" height="30" align="left" valign="bottom" bgcolor="#999999"   style="background-repeat:no-repeat;cursor:pointer;background-image:url('../cfrontend/images/tab<?=($currentMenu=='logbook')?"over":"out"?>.png');" onclick="location='../logbook/logbookhome.php'">
    <img src="../resource/images/menu/main_menu_logbook.gif" width="84" height="24" border="0" style="cursor:pointer" /></td>
    <td width="100" height="30" align="center" valign="bottom" bgcolor="#999999"   style="background-repeat:no-repeat;cursor:pointer;background-image:url('../cfrontend/images/tab<?=($currentMenu=='customer')?"over":"out"?>.png');" onclick="location='../customer/customerhome.php'">
   <img src="../resource/images/menu/main_menu_customer.gif" width="96" height="24" border="0" style="cursor:pointer" /></td>
   
    <td width="100" height="30" align="left" valign="bottom" bgcolor="#999999"   style="background-repeat:no-repeat;cursor:pointer;background-image:url('../cfrontend/images/tab<?=($currentMenu=='staff')?"over":"out"?>.png');" onclick="location='../staff/staffhome.php'">
    <img src="../resource/images/menu/main_menu_staff.gif" width="90" height="24" border="0" style="cursor:pointer" /></td>
    <td width="100" height="30" align="left" valign="bottom" bgcolor="#999999"   style="background-repeat:no-repeat;cursor:pointer;background-image:url('../cfrontend/images/tab<?=($currentMenu=='report')?"over":"out"?>.png');" onclick="location='../report/reporthome.php'">
    <img src="../resource/images/menu/main_menu_report.gif" width="90" height="24" border="0" style="cursor:pointer" /></td>
	
    <td height="30" align="center" bgcolor="#999999"><a href="../resource/IDAutomationHC39M_Free.ttf">Download barcode</a>
    ID[<?=$userstfid?>] SEC[<?=$usersecid?>] BRN[<?=$userbrnid?>]    </td>
    <td height="30" bgcolor="#999999">&nbsp;</td>
    <td width="113" height="30" align="center" bgcolor="#999999"><? include("../core/logout.php")?></td>
  </tr>
</table>
