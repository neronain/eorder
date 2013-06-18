<?
	include_once("../core/default.php");
	//echo "submit order ready<br>";
	$eorderid = isset($_GET["eorderid"]) ? $_GET["eorderid"] : 0;
	$currentid = isset($_GET["currentid"]) ? $_GET["currentid"] : 0;
	$page = isset($_GET["page"]) ? $_GET["page"] : 1;
	$status = isset($_GET["status"]) ? $_GET["status"] : 0;
	$limit = isset($_GET["limit"]) ? $_GET["limit"] : 15;
	$totalpage = isset($_GET["totalpage"]) ? $_GET["totalpage"] : 0;
	$data = new Csql();
	$data->Connect();
	$data->Query("select * from eorder where eorderid=$eorderid limit 0,1");		
	if(!$data->EOF) {		
		$data->TableName = "eorder";
		$data->Set("ord_gotdate","NOW()");
		$data->Set("ord_status","5");
		$data->Update();
	}
	$status = 4;
	$customer_id = $currentid;
?>
<? include "../cfrontend/queryorderlist_c.php" ?>