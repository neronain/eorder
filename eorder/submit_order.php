<?
	include_once("../core/default.php");
	//echo "submit order ready<br>";
	$eorderid = $_GET["eorderid"];
	$data = new Csql();
	$data->Connect();
	$data->Query("select * from eorder where eorderid=$eorderid limit 0,1");		
	if(!$data->EOF) {		
		$data->TableName = "eorder";
		$data->Set("ord_senddate","NOW()");
		$data->Set("ord_status","1");
		$data->Update();
	}
	redirect("../cfrontend/order.php?eorderid=$eorderid",0);
?>