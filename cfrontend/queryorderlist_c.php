<? include_once("../core/default.php"); ?>
<? 
	//if(!isset($status))$status = $_GET['status'];
	GetVar($status,"status");
	//if(!isset($status))$status	= 0;
	//if(!isset($start))$start = $_GET['start'];
	
	GetVar($customer_id,"customerid");
	GetSession($customer_id,"customerid");
	//if(!isset($customer_id))$customer_id = $_GET['customerid'];
	
	//if(!isset($page))$page = $_GET["page"]; 
	GetVar($page,"page");
	if(!isset($page))$page = 1;
	
	//if(!isset($limit))$limit	= $_GET['limit'];
	GetVar($limit,"limit");
	if(!isset($limit))$limit	= 10;
	
	//$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	
	
	/* $status
	$limit
	$customer_id */
	//if(!isset($start))$start = 0;
	
	$eorder_data = new CSql();
	$eorder_data->Connect();
	
	if($limit > 0){
		$start = ($page-1)*$limit;
		$sql_limit = "Limit $start,".$limit;
	}else{
		$sql_limit = "";
	}
	
	if(!isset($status)){
		$statusql = " ";
	}else{
		$statusSql = " ord_status = '$status' and ";
	} 
	
	$cquery = "SELECT count(*) as countrow " ;
	$iquery = "SELECT 
			eorderID,ord_code,ord_patientname,ord_typeofwork,ord_docnote,ord_status,doc_name,
			DATE_FORMAT(ord_date,'%d/%m/%y') as ord_date,
			DATE_FORMAT(ord_senddate,'%d/%m/%y') as ord_senddate,
			DATE_FORMAT(ord_arrivedate,'%d/%m/%y') as ord_arrivedate,
			DATE_FORMAT(ord_gotdate,'%d/%m/%y') as ord_gotdate,
			ord_totalcost ";
	$query = "FROM eorder,doctor WHERE ".$statusSql." ord_cus_id = '$customer_id' and 
				ord_doc_id = doctorid order by eorderid desc ";
	//echo $query;
	$cquery.=$query;
	$eorder_data->Query($cquery);
	$totalrow = $eorder_data->Rs("countrow");
	$query = $iquery.$query.$sql_limit;
	
	$eorder_data->Query($query);
	$totalpage = ceil($totalrow/$limit);
	$switchpage='queryorderlist_c';
	$id = $customer_id;
	include("../cfrontend/queryorderlist.php");
 ?>