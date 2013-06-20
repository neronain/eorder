<link href="default.css" rel="stylesheet" type="text/css">

<? 


if(!isset($customerid)){
	$customerid = isset($_GET["customerid"]) ? $_GET["customerid"] : $_COOKIE["customerid"];
}
//$customerid=0 

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50" height="30" style="cursor:pointer">&nbsp;</td>
    <td width="100" height="30" align="left"
style="background-repeat:no-repeat;cursor:pointer;background-image:url('images/tab<?=($menu=='dashboard')?"over":"out"?>.png');"
    onclick="javascript:location='../cfrontend/dashboard.php?customerid=<?=$customerid?>'">
    <strong>&nbsp;<img src="../resource/images/silkicons/color_swatch.gif" width="16" height="16" />&nbsp;<?=T_DASHBOARD;?></strong>
    </td>
    <td width="100" height="30" align="left"  
    style="background-repeat:no-repeat;cursor:pointer;background-image:url('images/tab<?=($menu=='order')?"over":"out"?>.png');"
    onclick="javascript:location='../cfrontend/order.php?customerid=<?=$customerid?>'">
    <strong>&nbsp;<img src="../resource/images/silkicons/package.gif" width="16" height="16" />&nbsp;&nbsp;<?=T_ORDER;?></strong>
    </td>
    <td width="100" height="30" align="left" 
  style="background-repeat:no-repeat;cursor:pointer;background-image:url('images/tab<?=($menu=='profile')?"over":"out"?>.png');"
    onclick="javascript:location='../cfrontend/profile.php?customerid=<?=$customerid?>'">
    <strong>&nbsp;<img src="../resource/images/silkicons/book.gif" width="16" height="16" />&nbsp;&nbsp;<?=T_PROFILE;?></strong>
    </td>
    <td width="100" height="30" align="left" 
  style="background-repeat:no-repeat;cursor:pointer;background-image:url('images/tab<?=($menu=='doctor')?"over":"out"?>.png');"
    onclick="javascript:location='../cfrontend/doctor.php?customerid=<?=$customerid?>'">
    <strong>&nbsp;<img src="../resource/images/silkicons/user.gif" width="16" height="16" />&nbsp;&nbsp;<?=T_DOCTOR;?></strong>
    </td>
    <td width="100" height="30" align="left" 
  style="background-repeat:no-repeat;cursor:pointer;background-image:url('images/tab<?=($menu=='patient')?"over":"out"?>.png');"
    onclick="javascript:location='../cfrontend/patient.php?customerid=<?=$customerid?>'">
    <strong>&nbsp;<img src="../resource/images/silkicons/user_red.gif" width="16" height="16" />&nbsp;&nbsp;<?=T_PATIENT;?></strong>
    </td>
    <td height="30" align="right" class="logout">&nbsp;</td>
  </tr>
</table>
