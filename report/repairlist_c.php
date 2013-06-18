<? 
include_once("../core/default.php"); 
include_once("../order/inc_getstring.php"); 

	$method = $_GET["METHOD"];
	$filter = $_GET["filter"];

	$searchtype = $_GET["searchtype"];
	$type = $_GET["type"];
	$istype		 	= $_GET["selectTypeChkBox"];
	
	if($istype != 1){
		$type = "A";
	}
	
	$country = $_GET["country"];

	$order = $_GET["order"];
	$output = $_GET["output"];
	if(!isset($output))$output = "web";
	
	
	
	
	$iscountry 		= $_GET["CountryChkBox"];
	
	$keyword = trim($_GET["keyword"]);
	

	$cdate 		= $_GET["fromdate_day"];
	$cmonth 	= $_GET["fromdate_month"];
	$cyear 		= $_GET["fromdate_year"];

	$edate 		= $_GET["enddate_day"];
	$emonth 	= $_GET["enddate_month"];
	$eyear 		= $_GET["enddate_year"];

	while(strlen($cdate)<2 && strlen($cdate)>0){ $cdate = "0".$cdate;	}
	while(strlen($cmonth)<2 && strlen($cmonth)>0){ $cmonth = "0".$cmonth;	}
	while(strlen($edate)<2 && strlen($edate)>0){ $edate = "0".$edate;	}
	while(strlen($emonth)<2 && strlen($emonth)>0){ $emonth = "0".$emonth;	}



	$data_order = new CSql();
 	$err =	$data_order->Connect();
	
//-----------------------------------------------------------------------------------------------------------------------------------	
// Clear	
	
//	$data_order->Execute("delete eorder from eorder 
//	where  DATEDIFF(CURDATE(),ord_releasedate)>7 and ord_isship=TRUE");
	
	
	
	
	
//-----------------------------------------------------------------------------------------------------------------------------------	
	
	$iquery = "
	select eorder_repairrework_defectcode,ord_code as ord_code,cus_name,doc_name,ord_patientname as ord_patientname,
	eorderid as eorderid,prv_name,cnt_name,customerid,ord_typeofwork,

`eorder_repairrework_problem`, `eorder_repairrework_repair`, `eorder_repairrework_rework`, `eorder_repairrework_detectby`, `eorder_repairrework_supervisor`, `eorder_repairrework_remark`,


	

	DATE_FORMAT(eorder_repairrework_date,'%d/%m/%y') as eorder_repairrework_date,



	 ";
	 

	$iquery .= " 1 ";
	
	$cquery = "select count(*) as countrow ";
	
	
	$query = "from 
		(select * from eorder,customer,doctor,province,country,eorder_repairrework
		
		where 
		eorder_id = eorderid and
		
		ord_cus_id = customerid and ord_doc_id = doctorid and cus_prv_id = provinceid and cus_cnt_id = countryid
		
		
		 ";
		
	
	$query  .= " and DATE(eorder_repairrework_date) between  '$cyear-$cmonth-$cdate'  and  '$eyear-$emonth-$edate'";

	
	
	$query  .= ")as main ";



	$query .= "order by eorder_repairrework_defectcode,eorderid";
		


			
	$cquery.=$query;
	$query = $iquery.$query;
	//$data_order->Query("$cquery");
	//$totalrow = $data_order->Rs("countrow");
	$data_order->Query("$query");//Query("select * from ");
	//$data_order->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
		/* 
		
		
			 =
		
		//*/
		
	//echo $query;
	//$page = 10;	
	include("../report/repairlist.php");

	
	//echo "[".$data_order->GetMaxID("eorder")."]";
?>