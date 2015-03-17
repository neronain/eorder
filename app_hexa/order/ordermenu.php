<? 
$temp = $currentMenu;
$currentMenu="order"; include ("../core/mainmenu.php"); 

?>
<script>
var popUpWin=0;

function popUpWindow(URLStr, left, top, width, height)

{

  if(popUpWin)

  {

    if(!popUpWin.closed) popUpWin.close();

  }

  popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');

}
</script>

<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<table width="100%" border="0" cellpadding="0" cellspacing="0" background="../cfrontend/images/bg_03.png"><tr><td>
<table  border="0" cellpadding="0" cellspacing="7" background="../cfrontend/images/bg_03.png" >
  <tr>
    <td width="100" height="26" align="center" <?=$temp=="addorder"?'class="MenuTab"':''?>>
	<a href="../order/orderadd_c.php">
	<img src="../resource/images/silkicons/package_add.gif" border="0" />  Add order</a>  </td>
    <td width="80" height="26" align="center" <?=$status=="0"?'class="MenuTab"':''?>>
	<a href="orderlist_c.php?status=0">
	<img src="../resource/images/silkicons/script.gif" border="0" /> Draft</a> </td>
    <td width="80" height="26" align="center" <?=$status=="1"?'class="MenuTab"':''?>>
	<a href="orderlist_c.php?status=1">
	<img src="../resource/images/silkicons/lorry_go.gif" border="0" /> Sending</a> </td>
    <td width="80" height="26" align="center" <?=$status=="2"?'class="MenuTab"':''?>>
	<a href="orderlist_c.php?status=2">
	<img src="../resource/images/silkicons/box.gif" border="0" /> Arrived</a> </td>
    <td width="100" height="26" align="center" <?=$status=="3"?'class="MenuTab"':''?>>
	<a href="orderlist_c.php?status=3">
	<img src="../resource/images/silkicons/cog.gif" border="0" /> Processing</a> </td>
    <td width="90" height="26" align="center" <?=$status=="4"?'class="MenuTab"':''?>><a href="orderlist_c.php?status=4"> <img src="../resource/images/silkicons/lorry_gor.gif" border="0" /> Released</a> </td>
    <td width="120" height="26" align="center" <?=$status=="5"?'class="MenuTab"':''?>><a href="orderlist_c.php?status=5"> <img src="../resource/images/silkicons/money.gif" border="0" /> Wait payment</a> </td>
    <td width="120" height="26" align="center" <?=$status=="6"?'class="MenuTab"':''?>><a href="orderlist_c.php?status=6"> <img src="../resource/images/silkicons/flag_green.gif" border="0" /> Wait confirm</a> </td>
    <td width="90" height="26" align="center" <?=$status=="7"?'class="MenuTab"':''?>><a href="orderlist_c.php?status=7"> <img src="../resource/images/silkicons/compress.gif" border="0" /> Archieve</a> </td>
  </tr>
</table>
</td></tr></table>