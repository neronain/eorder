<?
	include_once("../core/default.php");
	$eorderid = $_GET["eorderid"];
	$action = $_GET["act"];
	switch($action) {
		case "rej": $status = 0; $status_b=0; break;
		case "sub": $status = 1;$status_b=0;  break;
		case "rec": $status = 2; $status_b=1; break;
		case "rnp": $status = 3; $status_b=1; break;
		case "pro": $status = 3; $status_b=2; break;
		default: $status = 0; $status_b=0; break;
	}
	$data = new Csql();
	$data->Connect();
	$data->Query("select * from eorder where eorderid=$eorderid limit 0,1");		
	if(!$data->EOF) {		
		$data->TableName = "eorder";
		switch($action) {
			case "rej": 
				$column = array(); break;
			case "sub":
				 $column = array("ord_senddate" => "NOW()"); break;
			case "rec":
				 $column = array("ord_arrivedate" => "NOW()"); break;
			case "rnp":
				 $column = array("ord_arrivedate" => "NOW()","ord_processdate" => "NOW()"); break;
			case "pro":
				 $column = array("ord_processdate" => "NOW()"); break;
			default:
				 $column = array(); break;
		}
		foreach($column as $key => $value) {
			$data->Set("$key","$value");
		}
		$data->Set("ord_status","'$status'");
		$data->Update();
	}
	redirect("../order/orderlist_c.php?status=$status_b",0);
?>