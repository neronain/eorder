<?
	include_once("../core/default.php"); 
	$barcode = $_POST["barcode"];
	$msg='';
	if(isset($barcode)){
		$barcode = trim($barcode);
		$data_order = new Csql();
		$data_order->Connect();
		$data_order->Query("select ordt_patientname from eordertoday where ordt_code='$barcode'");

		if($data_order->Count()>0){
			$msg="".$barcode ." " .$data_order->Rs("ordt_patientname");
			$data_order->Query("select * from logbooktoday,eordertoday
			where logt_ord_id = eordertodayid and ordt_code='$barcode'
			order by logt_date desc limit 0,1");
			if($data_order->Count()>0 && $data_order->Rs("logt_type")=='IN'){
			
					$eorderid = $data_order->Rs("eordertodayid");
					$staffid = $data_order->Rs("logt_stf_id");
					$sectionid = $data_order->Rs("logt_sec_id");
					
					$data_logbook = new Csql();
					$data_logbook->Addnew();
					$data_logbook->TableName = "logbook";
					$data_logbook->Set("log_ord_id","$eorderid");
					$data_logbook->Set("log_stf_id","$staffid");
					$data_logbook->Set("log_sec_id","$sectionid");
					$data_logbook->Set("log_type","'OUT'");
					$data_logbook->Set("log_date","NOW()");
					$data_logbook->Update();
					
					$data_logbook->Query("select max(logbookid) as maxlog from logbook
						where log_ord_id=$eorderid and log_stf_id=$staffid and 
						log_sec_id=$sectionid and log_type='OUT'");
					$maxlog = $data_logbook->Rs("maxlog");
					$data_logbook->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");
											
					$data_logbook->Execute(" delete  logbookworking from logbookworking where logw_ord_id = $eorderid");
			
					include("../logbook/logwarning.php");




				//$msg="<font color=#FF0000>ยังไม่ได้ logout $barcode</font>";
			}
			
			$data_order->Execute("update eordertoday set ordt_isdone=TRUE,ordt_isship=TRUE where ordt_code='$barcode'");
			$data_order->Execute("update eorder set ord_status=4 where ord_code='$barcode'");
			
		}else{
			$msg="<font color=#FF0000>Not found Order barcode $barcode</font>";
		}
	}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Eorder Scan shipout</title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/default.js"></script>
</head>

<body>
<div align="center">
<form action="exportscan.php" method="post">
<br />
  <strong>Scan eorder's barcode for ship</strong>  <br />
  สแกนบาร์โค้ดสำหรับ ออร์เดอร์ ที่จะส่งให้ลูกค้า
  <br />

  <input type="text" name="Stupid_IE_Bug" value="" style="width:0;display:none" />
  <input name="barcode" type="text" />
  <input name="METHOD" type="submit" class="BTok" value="OK" id="barcodeok"/>
  <br />
 </form><br />

 <?=$msg?>
</div>

</body>
</html>
<script>setFocus('barcode');</script>
