<? 
$temp = $currentMenu;
$currentMenu="logbook"; include ("../core/mainmenu.php"); 

?>
<script>
var popUpWin=0;
function popUpWindow(URLStr, left, top, width, height){
  if(popUpWin){   if(!popUpWin.closed) popUpWin.close(); }
  popUpWin = open(URLStr, 'popUpWin', 'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width='+width+',height='+height+',left='+left+', top='+top+',screenX='+left+',screenY='+top+'');
}
</script>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />

<table width="100%" height="25" border="0" cellpadding="0" cellspacing="7" background="../cfrontend/images/bg_03.png">
  <tr>
    <td width="120" height="26" align="center" <?=$temp=="loginout"?'class="MenuTab"':''?>>
	<a href="../logbook/loginout_c.php">
	<img src="../resource/images/silkicons/book_go.gif" border="0" /> log in-out</a></td>
    <td width="140" height="26" align="center" <?=$temp=="loglist"?'class="MenuTab"':''?>>
	<a href="../logbook/loglist_c.php">
	<img src="../resource/images/silkicons/book.gif" border="0" /> logbook list</a></td>
  <td width="150" height="26" align="center">
        <a href="#" onclick="popUpWindow('../order/deliveryscan.php', 300, 10, 500, 650)">
	  Massenger scan</a>        </td>
  <td width="150" height="26" align="center">
        <a href="#" onclick="popUpWindow('../order/exportscan.php', 100, 100, 400, 300)">
	  Export Scan out</a>        </td>
<? /*
    <td <?=$temp=="logcountdown"?'class="MenuTab"':''?> align="center" width="120">
	<a href="../logbook/logcountdown_c.php">
	<img src="../resource/images/silkicons/book_wait.gif" border="0" /> countdown</a></td> 

    <td width="120" height="26" align="center" <?=$temp=="logwait"?'class="MenuTab"':''?>>
	<a href="../logbook/logwait_c.php">
	<img src="../resource/images/silkicons/book_wait.gif" border="0" /> waiting</a></td>//*/?>
	    <td height="26">&nbsp;</td>
  </tr>
</table>
