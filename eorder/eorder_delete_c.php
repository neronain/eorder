<?
	include_once("../core/default.php");
	$eorderid = isset($_GET["eorderid"]) ? $_GET["eorderid"] : 0;
	$currentid = isset($_GET["currentid"]) ? $_GET["currentid"] : 0;
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;
	$status = isset($_GET["status"]) ? $_GET["status"] : 0;
	$limit = isset($_GET["limit"]) ? $_GET["limit"] : 15;
	$totalpage = isset($_GET["totalpage"]) ? $_GET["totalpage"] : 0;
	$data = new Csql();
	$data->Connect();
	$data->Execute("delete from eorder where eorderid=$eorderid");
	$data->Execute("delete from eorder_fix where eorder_fixid=$eorderid");
	$data->Execute("delete from eorder_remove where eorder_removeid=$eorderid");
?>
<? $customer_id = $currentid; ?>
<? include "../cfrontend/queryorderlist_c.php" ?>