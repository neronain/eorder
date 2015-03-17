<? include_once("../core/default.php"); ?>
<?

$order_id = $_GET['eorderid'];
$type = $_GET['type'];


?>
<table width="100%" height="100%"><tr><td>
<div align="center">
<?
if($type == "r"){
?>
<? 

$data = new CSql();
$data->Connect();
//$order_id = str_pad($order_id, 8 , "0", STR_PAD_LEFT);
$data->Query("select ord_code from eorder where eorderid = $order_id");

while(!$data->EOF){
	$order_idR = $data->Rs("ord_code");
	$data->MoveNext();
}
//echo($order_idR);
?>
<img src="../file/eorderrelease/<?=$order_idR?>.png" />
<?
}else{
?>
<img src="../file/eorderattach/<?=$order_id?>.jpg" />
<?
}
?>
</div>
</td></tr></table>
