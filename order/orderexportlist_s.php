<? include_once("../core/default.php"); ?>
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
	where  DATEDIFF(CURDATE(),DATE(ordt_releasedate))>5 and ordt_isship=TRUE");
	
	$data_order->Execute(" delete  logbooktoday from logbooktoday
	 where logt_ord_id not in (select eordertodayid from eordertoday)");
//-----------------------------------------------------------------------------------------------------------------------------------	
	//echo "xxx2";


	foreach ($arrCheckID as $value) {
	
		$data_order->Query("select * from logbooktoday,eordertoday
			where logt_ord_id = $value and logt_ord_id = eordertodayid
			order by logt_date desc limit 0,1");
		if($data_order->Count()>0 && $data_order->Rs("logt_type")=='IN'){
			$msg.="ยังไม่ได้ logout ".$data_order->Rs("ordt_code")."<br>";
		}else{
			$data_order->Execute("update eordertoday set ordt_isdone=TRUE where eordertodayid = $value");
		}			
	}
	//echo "xxx3";

	//include("../order/orderexportlist_c.php");

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