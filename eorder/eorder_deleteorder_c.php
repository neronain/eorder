<?
include_once("../core/default.php") ;

$eorder_id = $_GET['eorderid'];
//echo($eorder_id);

$del_data = new CSql();
$del_data->Connect();

$sql = "select ord_code from eorder where eorderid = '$eorder_id'";
//echo($sql."<br>");
$del_data->Query($sql);
while(!$del_data->EOF){
	$orderCode = $del_data->Rs("ord_code");
	$del_data->MoveNext();
}
//echo($orderCode."<br>");

$sql = "delete from eorder where eorderid = '$eorder_id'";
//echo($sql."<br>");
$del_data->Execute($sql);
$sql = "delete from eordertoday where eordertodayid = '$eorder_id'";
//echo($sql."<br>");
$del_data->Execute($sql);
$sql = "delete from eorderwarning where eorderwarningid = '$eorder_id'";
//echo($sql."<br>");
$del_data->Execute($sql);
$sql = "delete from eorder_fix where eorder_fixid = '$eorder_id'";
//echo($sql."<br>");
$del_data->Execute($sql);
$sql = "delete from eorder_ortho where eorder_orthoid = '$eorder_id'";
//echo($sql."<br>");
$del_data->Execute($sql);
$sql = "delete from eorder_remove where eorder_removeid = '$eorder_id'";
//echo($sql."<br>");
$del_data->Execute($sql);
$sql = "delete from logbook where log_ord_id = '$eorder_id'";
//echo($sql."<br>");
$del_data->Execute($sql);
$sql = "delete from logbooktoday where logt_ord_id = '$eorder_id'";
//echo($sql."<br>");
$del_data->Execute($sql);
$sql = "delete from logbookworking where logw_ord_id = '$eorder_id'";
//echo($sql."<br>");
$del_data->Execute($sql);

 if(file_exists("../file/eorderattach/".$eorder_id.".jpg")){
 	unlink("../file/eorderattach/".$eorder_id.".jpg");
 }
 
 if(file_exists("../file/eorderrelease/".$orderCode.".png")){
 	unlink("../file/eorderrelease/".$orderCode.".png");
 }
 
?>
<br />
<table width="100%" border="0" cellpadding="2" cellspacing="1">
  <tr>
    <td align="center">Delete Order <?=$orderCode?> Complete.</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><label>
      <input type="submit" name="button" id="button" value="Ok" onclick="DeleteComplete();" />
    </label></td>
  </tr>
</table>
