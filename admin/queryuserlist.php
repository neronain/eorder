<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=WEBSITE_HEADER?></title>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>
<body>
<? /* */ include_once "../resource/divbackground.php" ?>



<table width="100%" class="tdButtonOnOut"  onmouseout="this.className='tdButtonOnOut'">
<tr>
<td align="center">User List</td>
</tr>
                              <? while(!$userdental_data->EOF){ ?>
                              <tr>
                                <td class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" onClick="OpenDivShowAjaxExample(<?=$userdental_data->Rs("userdentalid");?>);"  style="padding-left:10px;padding-right:10px">
								<?=$userdental_data->Rs("userdentalid");?>:<?=$userdental_data->Rs("usr_username");?>
								</td>
                              </tr>
                              <? $userdental_data->MoveNext(); 
							  } ?>

</table>




<div id="DivShowAjaxExample" style="position:absolute;left:0px;top:500px;width:618px;height:500px;z-index:1;">
  <? $tbframeheader = "User Information"?>
  <? $tbframehclose = "CloseDivShowAjaxExample()";?>
  <? include "../cfrontend/tbframeh.php"?>
  <div id="DivAjaxExample" style="overflow:auto;width:600px;height:450px" align="left"></div>
  <? include "../cfrontend/tbframef.php"?>
</div>
<script>


function OrderSummaryChangeTab(name)
{
	alert(name);
}


function OpenDivShowAjaxExample(u_id)
{
	activeBG();
	showHideLayers('DivShowAjaxExample','','show');
	makeCenterScreen('DivShowAjaxExample');
	showHTML('DivAjaxExample','userupdate.php?userid='+u_id+'&sh=1');
}
function CloseDivShowAjaxExample()
{
	hideBG();
	showHideLayers('DivShowAjaxExample','','hide');
}
showHideLayers('DivShowAjaxExample','','hide');
hideLoading();

</script>
</body>
</html>
