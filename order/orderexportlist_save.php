<?  include_once("../core/default.php"); ?>
<?

	//echo "xxx0";
	$method = $_POST["METHOD"];
	$filter = $_POST["filter"];

	$searchtype = $_POST["searchtype"];
	$type = $_POST["type"];
	$country = $_POST["country"];
	$keyword = trim($_POST["keyword"]);
	

	$cdate 		= $_POST["exdate_day"];
	$cmonth 	= $_POST["exdate_month"];
	$cyear 		= $_POST["exdate_year"];

	$edate 		= $_POST["endate_day"];
	$emonth 	= $_POST["endate_month"];
	$eyear 		= $_POST["endate_year"];
	
	$arrCheckID = $_POST["eorderid"];

	while(strlen($cdate)<2 && strlen($cdate)>0){ $cdate = "0".$cdate;	}
	while(strlen($cmonth)<2 && strlen($cmonth)>0){ $cmonth = "0".$cmonth;	}
	while(strlen($edate)<2 && strlen($edate)>0){ $edate = "0".$edate;	}
	while(strlen($emonth)<2 && strlen($emonth)>0){ $emonth = "0".$emonth;	}


	if(!isset($arrCheckID))$arrCheckID=array();
	
	$data_order = new CSql();
 	$err =	$data_order->Connect();
	
	
	//echo "xxx1";
//-----------------------------------------------------------------------------------------------------------------------------------	
// Clear	
	

	
	$data_order->Execute("delete eordertoday from eordertoday 
	where  (DATEDIFF(CURDATE(),DATE(ordt_releasedate))>5 and ordt_isship=TRUE) 
			
			or (ordt_date>'2000-01-01' and DATEDIFF(CURDATE(),DATE(ordt_date))>180)
			or (ordt_date>'2000-01-01' and DATEDIFF(CURDATE(),DATE(ordt_date))>60 and ordt_isdone=TRUE)
			
			
			");
	
	$data_order->Execute(" delete  logbooktoday from logbooktoday
	 where logt_ord_id not in (select eordertodayid from eordertoday)");
//-----------------------------------------------------------------------------------------------------------------------------------	
	//echo "xxx2";


	foreach ($arrCheckID as $value) {

			$data_order->Query("select * from logbooktoday,eordertoday
			where logt_ord_id = eordertodayid and eordertodayid='$value'
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
			
			$data_order->Execute("update eordertoday set ordt_isdone=TRUE where eordertodayid='$value'");
			//$data_order->Execute("update eorder set ord_status=4 where eorderid='$value'");

	
	}
	//echo "xxx3";
/*
	//include("../order/orderexportlist_c.php");
//*/
?>
<div align="center"><br />
  <br />
Save complete!
<? if($msg!=""){?>
<font color="#FF0000"><strong><?='<br><br>Some Error!<br>'.$msg?></strong></font>
<? }?>
<br />
<? if(isset($country) && $country+0!=0){?>
<a href="<?="../order/orderexportlist_c.php?METHOD=$method&filter=$filter&searchtype=$searchtype&type=$type&country=$country&keyword=$keyword&exdate_day=$cdate&exdate_month=$cmonth&exdate_year=$cyear&endate_day=$edate&endate_month=$emonth&endate_year=$eyear"?>">Back</a>
<? }else{ ?>
<a href="<?="../order/orderexportlist_expire.php"?>">Back</a>
<? } ?>
</div>