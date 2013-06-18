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

while(strlen($cdate)<2 && strlen($cdate)>0){
	$cdate = "0".$cdate;
}
while(strlen($cmonth)<2 && strlen($cmonth)>0){
	$cmonth = "0".$cmonth;
}
while(strlen($edate)<2 && strlen($edate)>0){
	$edate = "0".$edate;
}
while(strlen($emonth)<2 && strlen($emonth)>0){
	$emonth = "0".$emonth;
}



$data_order = new CSql();
$err =	$data_order->Connect();

//-----------------------------------------------------------------------------------------------------------------------------------
// Clear

//	$data_order->Execute("delete eorder from eorder
//	where  DATEDIFF(CURDATE(),ord_releasedate)>7 and ord_isship=TRUE");





//-----------------------------------------------------------------------------------------------------------------------------------

$iquery = "
select 
eorder_m5mid,
m5m_no,
m5m_date,
m5m_cum_code,


DATE_FORMAT(m5m_date,'%d/%m/%y') as m5m_date,



";


$iquery .= " 1 ";

$cquery = "select count(*) as countrow ";


$query = "from eorder_m5m

where TRUE


";


$query  .= " and DATE(m5m_date) between  '$cyear-$cmonth-$cdate'  and  '$eyear-$emonth-$edate'";




$oquery .= " order by m5m_no,m5m_cum_code";




$cquery.=$query;
$query = $iquery.$query.$oquery;
//$data_order->Query("$cquery");
//$totalrow = $data_order->Rs("countrow");
$data_order->Query("$query");//Query("select * from ");
//$data_order->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
/*


=

//*/

/*-------------- optimize -------------------*/
$data_tmp = new Csql();
$data_tmp->Connect();

$cache = array();
$data_orderAr = array();

while(!$data_order->EOF){


	$rowAr = $data_order->CurrentRowArray();

	

	$tmpRow = $data_tmp->ExecuteARecord("select ord_code as ord_code,ord_patientname as ord_patientname,
	eorderid as eorderid,ord_typeofwork,
	ord_cus_id as ord_cus_id,ord_doc_id as ord_doc_id from eorder where eorderid = {$rowAr['eorder_m5mid']} limit 0,1");
	if($tmpRow!=NULL){
		$rowAr = array_merge($rowAr, $tmpRow);
	}else{
		$data_order->MoveNext();
		continue;
	}
	
	$tmpRow = $data_tmp->ExecuteARecord("select eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
			ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation from eorder_fix where eorder_fixid = {$rowAr['eorderid']} limit 0,1");
	if($tmpRow!=NULL){
		$rowAr = array_merge($rowAr, $tmpRow);
	}

	$key = $rowAr['ord_cus_id'];
	if($cache['customer'][$key]==NULL){
		$tmpRow = $data_tmp->ExecuteARecord("select customerid,cus_name,cus_prv_id,cus_cnt_id from customer where customerid = {$key} limit 0,1");
		$cache['customer'][$key] = $tmpRow;
	}
	$rowAr['customerid'] = $cache['customer'][$key]["customerid"];
	$rowAr['cus_name'] = $cache['customer'][$key]["cus_name"];
	$rowAr['cus_prv_id'] = $cache['customer'][$key]["cus_prv_id"];
	$rowAr['cus_cnt_id'] = $cache['customer'][$key]["cus_cnt_id"];

	$key = $rowAr['ord_doc_id'];
	if($cache['doctor'][$key]==NULL){
		$tmpRow = $data_tmp->ExecuteARecord("select doc_name from doctor where doctorid = {$key} limit 0,1");
		$cache['doctor'][$key] = $tmpRow;
	}
	$rowAr['doc_name'] = $cache['doctor'][$key]["doc_name"];

	$key = $rowAr['cus_prv_id'];
	if($cache['province'][$key]==NULL){
		$tmpRow = $data_tmp->ExecuteARecord("select prv_name from province where provinceid = {$key} limit 0,1");
		$cache['province'][$key] = $tmpRow;
	}
	$rowAr['prv_name'] = $cache['province'][$key]["prv_name"];


	$key = $rowAr['cus_cnt_id'];
	if($cache['country'][$key]==NULL){
		$tmpRow = $data_tmp->ExecuteARecord("select cnt_name from country where countryid = {$key} limit 0,1");
		$cache['country'][$key] = $tmpRow;
	}
	$rowAr['cnt_name'] = $cache['country'][$key]["cnt_name"];


	


	$data_orderAr[] = $rowAr;
	$data_order->MoveNext();

}
/*-------------- optimize -------------------*/


//echo $query;
//$page = 10;
include("../report/invoicelist.php");


//echo "[".$data_order->GetMaxID("eorder")."]";
?>