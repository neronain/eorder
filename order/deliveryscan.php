<?
	include_once("../core/default.php"); 
	$barcode = $_POST["barcode"];
	$staff = $_POST["staff"];
	$section = $_POST["section"];
	$msg='';
	$msg = "กรุณาสแกน หมายเลขประจำตัว ของผู้ส่ง";
	$data_order = new Csql();
	$data_order->Connect();	
	if(isset($barcode)){
		$barcode = trim($barcode);


		$codetype = "ERROR";

		$data_order->Query("select *  from staff where stf_code='$barcode' limit 0,1");
		if($data_order->Count()>0){
			$staff = $data_order->Rs("staffid");
			$section = $data_order->Rs("stf_sec_id");
			$stf_name = $data_order->Rs("stf_name");
			$codetype = "STAFF";
			$msg = "กรุณาสแกน กล่องงาน";
		}else{
			$data_order->Query("select eordertodayid,cus_name,ordt_typeofwork,ordt_isship
			 from eordertoday,customer 
			where 
			ordt_cus_id = customerid and
			ordt_code='$barcode' limit 0,1");
			if($data_order->Count()>0){
				$eorderid = $data_order->Rs("eordertodayid");
				$eorder_cusname = $data_order->Rs("cus_name");
				$eorder_work = $data_order->Rs("ordt_typeofwork");
				$eorder_isship = $data_order->Rs("ordt_isship");
				
				if($eorder_isship){
					$codetype = "DUP";
					$msg = "กรุณาสแกน กล่องงาน" ;
					$result = "กล่องงานนี้ถูกสแกนไปแล้ว";
				}else if($staff>0 && $section>0){
					$codetype = "EORDER";
					$msg = "กรุณาสแกน กล่องงาน กล่องต่อไป" ;
				}else{
					$codetype = "ERROR";
					$msg = "กรุณาสแกน หมายเลขประจำตัว ของผู้ส่ง อีกครั้ง ";
					//$result  = "$staff>0 && $section>0";
				}
			}else{
			
			}
		}
		
		
		if($codetype == "EORDER"){
			//$msg="".$barcode ." " .$data_order->Rs("ordt_patientname");
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
			
			

			
			$data_logbook = new Csql();
			$data_logbook->Addnew();
			$data_logbook->TableName = "logbook";
			$data_logbook->Set("log_ord_id","$eorderid");
			$data_logbook->Set("log_stf_id","$staff");
			$data_logbook->Set("log_sec_id","$section");
			$data_logbook->Set("log_type","'IN'");
			$data_logbook->Set("log_date","NOW()");
			$data_logbook->Update();
			
			$data_logbook->Query("select max(logbookid) as maxlog from logbook
				where log_ord_id=$eorderid and log_stf_id=$staff and 
				log_sec_id=$section and log_type='IN'");
			$maxlog = $data_logbook->Rs("maxlog");
			$data_logbook->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");

		
			$data_logbook->Addnew();
			$data_logbook->TableName = "logbook";
			$data_logbook->Set("log_ord_id","$eorderid");
			$data_logbook->Set("log_stf_id","$staff");
			$data_logbook->Set("log_sec_id","$section");
			$data_logbook->Set("log_type","'OUT'");
			$data_logbook->Set("log_date","NOW()");
			$data_logbook->Update();
			
			$data_logbook->Query("select max(logbookid) as maxlog from logbook
				where log_ord_id=$eorderid and log_stf_id=$staff and 
				log_sec_id=$section and log_type='OUT'");
			$maxlog = $data_logbook->Rs("maxlog");
			$data_logbook->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");
		
			
			
			$data_order->Execute("update eordertoday set ordt_isdone=TRUE,ordt_isship=TRUE  where ordt_code='$barcode'");
			$data_order->Execute("update eorder set ord_status=4,ord_sendbackdate=NOW() where ord_code='$barcode'");
			
			$result = "บันทึก การส่งของ <br>โค้ด $barcode <br>ลูกค้า $eorder_cusname <br>รายละเอียด $eorder_work";
			
			


			
		}else if($codetype == "STAFF"){
			$result="$stf_name <br>หมายเลขประจำตัว $barcode";
		}else{		
			$staff = -1;
			//$result="<font color=#FF0000>Not found Order barcode $barcode</font>";
		}
	}
	
	$data_order->Query("select eordertodayid,ordt_code,ordt_isship  from eordertoday 
	where DATE(ordt_releasedate) = CURDATE()");//CURDATE()
	while(!$data_order->EOF){			
		$id = $data_order->Rs("eordertodayid");
		$isship = $data_order->Rs("ordt_isship");
		$cus = substr($data_order->Rs("ordt_code"),2,4);
		$suff = substr($data_order->Rs("ordt_code"),12,2);
		$code = $cus."-".$suff;
		
		$eodertosend[$id] = $code;
		$eodership[$id] = $isship;
		$data_order->MoveNext();
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
<form action="deliveryscan.php" method="post">
<br />
  <strong>Scan eorder's barcode for massenger</strong>  <br />
  <?=$msg?>
  <br />
  <input name="staff" type="hidden" value="<?=$staff?>"/>
  <input name="section" type="hidden" value="<?=$section?>"/>

  <input type="text" name="Stupid_IE_Bug" value="" style="width:0;display:none" />
  <input name="barcode" type="text" />
  <input name="METHOD" type="submit" class="BTok" value="OK" id="barcodeok"/>
  <br />
 </form><br />

 <?=$result?><br />
<br />

</div>
<? $i=-1; ?>
<table align="center" cellpadding="2" cellspacing="0"><tr>
<? if($eodertosend)foreach($eodertosend as $id => $code){ ?>
	<? if($id==$eorderid){ ?>
    
	<td bgcolor="#FF6666"><?=$code?></td>
    <? }elseif($eodership[$id]){ ?>
	<td bgcolor="#999999"><?=$code?></td>
    <? }else{ ?>
	<td><?=$code?></td>
    <? } ?>
    <? if(++$i%7==6){ ?></tr><tr><? } ?>
<? } ?></tr>
</table>

</body>
</html>
<script>setFocus('barcode');</script>
