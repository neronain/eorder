<? include_once("../core/default.php"); ?>
<?
$method = $_GET["METHOD"];
$filter = $_GET["filter"];


$ordpriority = $_GET["ordpriority"];
$sort = $_GET["sort"];
$sort = 'customer';

$cdate 		= $_GET["indate_day"];
$cmonth 	= $_GET["indate_month"];
$cyear 		= $_GET["indate_year"];

$issort = $_GET['issort'];
$iscatagory = $_GET['iscatagory'];

if($issort == 1){

}

if($iscatagory == 1){

}

$iscountry = $_GET["iscountry"];
$country = $_GET["country"];


while(strlen($cdate)<2 && strlen($cdate)>0){
	$cdate = "0".$cdate;
}
while(strlen($cmonth)<2 && strlen($cmonth)>0){
	$cmonth = "0".$cmonth;
}


$data_order = new CSql();
$err =	$data_order->Connect();


$iquery = "select ordt_code as ord_code,
ordt_cus_id as ord_cus_id,
eordertodayid as eorderid,ordt_isship,ordt_typeofwork,	DATE_FORMAT(ordt_arrivedate,'%d/%m') as ord_datel,ordt_date as ord_date


";

/*
 $iquery .= " eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation,";

$iquery .= " eorder_removeid,ordr_method,ordr_typeofworkt,ordr_shade,ordr_observation, ";
$iquery .= " eorder_orthoid,ordo_method,ordo_typeofworkt,ordo_shade,ordo_observation, ";
*/
$countrySQL = "";
if($iscountry==1)
{
	if($country==1){
		$countrySQL .=" and ordt_cache_cnt_id in (0,1)";
	}else{
		$countrySQL .=" and ordt_cache_cnt_id = $country ";
	}
	
}
//echo $countrySQL;
$iquery .= "  ";

//$cquery = "select count(*) as countrow ";


//	$query = "from 	(select * ";
$query  .= "  from eordertoday

where

ordt_isship=FALSE $countrySQL and DATE(ordt_arrivedate) =  '$cyear-$cmonth-$cdate' and ordt_priority='$ordpriority'





";



/*
 $query  .= ")as main ";

$query .= " left join	(select * from eorder_fix)as efix on eordertodayid = eorder_fixid ";
$query .= " left join	(select * from eorder_remove)as eremove on eordertodayid = eorder_removeid ";
$query .= " left join	(select * from eorder_ortho)as eortho on eordertodayid = eorder_orthoid  	";
*/

/*if($sort=="sec"){
	$query .= "order by sec_room,logt_date desc";
}else{*/
	$oquery = " order by ord_code";
//}




$cquery.=$query;
$query = $iquery.$query.$oquery;

$data_order->Query("$query");


/*-------------- optimize -------------------*/
$data_tmp = new Csql();
$data_tmp->Connect();

$cache = array();
$data_orderAr = array();

while(!$data_order->EOF){


	$rowAr = $data_order->CurrentRowArray();


	$iquery .= " eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
	ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation,

	logt_ord_id,stf_code,sec_room,logt_type,logt_date,staffid,
	logt_datef,	logt_dated,
	";
	$tmpRow = $data_tmp->ExecuteARecord("select eorder_fixid,ordf_method,ordf_typeofworkt,ordf_shade,ordf_alloy,
			ordf_embrasure,ordf_pontic,ordf_optiont,ordf_observation from eorder_fix where eorder_fixid = {$rowAr['eorderid']} limit 0,1");
	if($tmpRow!=NULL){
		$rowAr = array_merge($rowAr, $tmpRow);
	}



	$data_logbook = new Csql();
	$data_logbook->Connect();
	$data_logbook->Query("select logt_ord_id,logt_type,logt_date,
			DATE_FORMAT(logt_date,'%d/%m %H:%i') as logt_datef,
			DATEDIFF(CURDATE(),logt_date) as logt_dated,
			logt_stf_id,logt_sec_id


			from	logbooktoday where logt_ord_id = {$rowAr['eorderid']} order by logt_date desc");
	while(!$data_logbook->EOF){
		$rowAr2 =  $data_logbook->CurrentRowArray();


		$key = $data_logbook->Rs('logt_stf_id');

		if($cache['staff'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select staffid,stf_name,stf_code from staff where staffid = {$key} limit 0,1");
			$cache['staff'][$key] = $tmpRow;
		}
		if($cache['staff'][$key]!=NULL){
			$rowAr2 = array_merge($rowAr2, $cache['staff'][$key]);
		}

		$key = $data_logbook->Rs('logt_sec_id');
		if($cache['section'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select sec_room from section where sectionid = {$key} limit 0,1");
			$cache['section'][$key] = $tmpRow;
		}
		if($cache['section'][$key]!=NULL){
			$rowAr2 = array_merge($rowAr2, $cache['section'][$key]);
		}

		$rowAr['current_status'][] = $rowAr2;
		$data_logbook->MoveNext();
	}
	/*
		* logt_ord_id,stf_code,sec_room,logt_type,logt_date,staffid,
	logt_datef,	logt_dated
	*
	$query .= "
	left join (select logt_ord_id,stf_code,sec_room,logt_type,logt_date,staffid,
			DATE_FORMAT(logt_date,'%d/%m %H:%i') as logt_datef,
			DATEDIFF(CURDATE(),logt_date) as logt_dated


			from	logbooktoday,section,staff where
			logt_stf_id = staffid and logt_sec_id = sectionid
	) as logbooktoday on logt_ord_id = eordertodayid  ";

	*/


	$data_orderAr[] = $rowAr;
	$data_order->MoveNext();

}
/*-------------- optimize -------------------*/


include("../order/orderprocesslist.php");

?>
