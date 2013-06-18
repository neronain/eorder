<?
	include_once("../core/funccom.php");
	$page_title = $_GET["tab"];
	GetVar($eorder_id,"eorderid");
	$eorderid = $eorder_id;
	$print=1;
	switch($page_title) {
		case 'overview':
			//$inc = "../eorder/eorder_preview.php?print=1&eorderid=".$eorder_id;break;
			$inc = "../eorder/eorder_preview.php";break;
		case 'invoice':
			//$inc = "../eorder/eorder_invoice_c.php?eorderid=".$eorder_id;break;
			$inc = "../eorder/eorder_invoice_c.php";break;
		case 'history':
			//$inc = "../eorder/eorder_history.php?eorderid=".$eorder_id;break;
			$inc = "../eorder/eorder_history.php";break;
		default:
			exit();
	}
	include($inc);
	//gotourl($inc);
?>
<script>window.print();window.close();</script>