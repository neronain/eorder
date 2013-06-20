<? include_once("../core/default.php"); ?>
<?
$order_id = $_GET['eorderid'];
$order_data = new CSql();
$order_data->Connect();

$order_data->Query("select ord_arrivedate,ord_releasedate from eorder where eorderid = '$order_id' limit 0,1");
if($order_data->EOF){
}

$arrive = $order_data->Rs("ord_arrivedate");
$release = $order_data->Rs("ord_releasedate");
$order_data->MoveNext();


$today = getdate();
$month = $today['mon'];
$day = $today['mday'];
$year = $today['year'];
$offset = 0;
// SEARCHME wday
if($today['wday']==0)$offset=0;//sun
if($today['wday']==1)$offset=0;
if($today['wday']==2)$offset=0;
if($today['wday']==3)$offset=2;
if($today['wday']==4)$offset=2;
if($today['wday']==5)$offset=2;
if($today['wday']==6)$offset=1;
$timestamp = mktime(24*(3+$offset),'00','00',$month,$day,$year);
$nextday = getdate($timestamp);
//var_dump($today);
//$teststr = "YYYY-MM-DD HH:mm:SS";
//echo(substr($teststr,11,2).substr($teststr,14,2).substr($teststr,17,2));
?>

<table width="100%" border="0">
  <tr>
    <td height="100">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><table>
		<tr>
        <td colspan="2" align="center"><label><strong>Please select Entry date and Arrive date</strong></label></td>
     </tr>
     <tr>
        <td colspan="2" align="center">&nbsp;</td>
     </tr>
        <td>
        <strong> Entry </strong></td>
        <td>
        <? buildDateSelector('eorder_confirmarrivedate',$today['mday'],$today['mon'],$today['year'])?>
        <? buildTimeSelector('eorder_confirmarrivetime',$today['hours'],$today['minutes'])?>        </td>
        </tr>
        <tr>
        <td>
         <strong> Release </strong> </td>
         <td>
        <? buildDateSelector('eorder_confirmreleasedate',$nextday['mday'],$nextday['mon'],$nextday['year'])?>
        <? buildTimeSelector('eorder_confirmreleasetime',$today['hours'],$today['minutes'])?>         </td>
     </tr>
        <tr>
          <td align="center"><strong>Box color</strong></td>
          <td><table border="0" cellpadding="0" cellspacing="5">

              <tr>
                <td width="36" height="36" align="center" >
                <label><input type="radio" name="boxcolor" value="Brown" checked="checked" />
                <img src="../resource/images/eorder/fix/fix_boxBrown.gif" width="32" height="32" /></label></td>
                <td width="36" height="36" align="center">
                 <label><input type="radio" name="boxcolor" value="Green" />
                <img src="../resource/images/eorder/fix/fix_boxGreen.gif" width="32" height="32" /></label></td>
                <td width="36" height="36" align="center">
                 <label><input type="radio" name="boxcolor" value="Yellow" />
                <img src="../resource/images/eorder/fix/fix_boxYellow.gif" width="32" height="32" /></label></td>
                <td width="36" height="36" align="center">
                 <label><input type="radio" name="boxcolor" value="White" />
                <img src="../resource/images/eorder/fix/fix_boxWhite.gif" width="32" height="32" /></label></td>
                <td width="36" height="36" align="center">
                 <label><input type="radio" name="boxcolor" value="Blue" />
                <img src="../resource/images/eorder/fix/fix_boxBlue.gif" width="32" height="32" /></label></td>
                <td width="36" height="36" align="center">
                 <label><input type="radio" name="boxcolor" value="Red" />
                <img src="../resource/images/eorder/fix/fix_boxRed.gif" width="32" height="32" /></label></td>
              </tr>
          </table></td>
        </tr>
     <tr>
        <td colspan="2" align="center"><label>
          <input type="button" name="button" id="button" value="Confirm" onClick="OrderSummaryChangeTab('submitarrive')">
        </label></td>
     </tr>
    <tr>
 </table></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
</table>
