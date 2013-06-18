<? include_once("../core/default.php"); ?>
<? 
	if(!isset($status))$status = $_GET['status'];
	//if(!isset($start))$start = $_GET['start'];
	if(!isset($doc_id))$doc_id = $_GET['docid'];
	
	if(!isset($page))$page = $_GET["page"]; 
	if(!isset($page))$page = 1;

	if(!isset($limit))$limit	= $_GET['limit'];
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
	$iquery = "SELECT eorderID,ord_code,ord_patientname,ord_docnote,ord_status,doc_name,
			DATE_FORMAT(ord_date,'%d/%m/%y') as ord_date,
			DATE_FORMAT(ord_arrivedate,'%d/%m/%y') as ord_arrivedate,
			DATE_FORMAT(ord_senddate,'%d/%m/%y') as ord_senddate,	
			DATE_FORMAT(ord_gotdate,'%d/%m/%y') as ord_gotdate,
			ord_typeofwork,ord_totalcost ";
	$query = "FROM eorder,doctor WHERE ord_doc_id = doctorid and ord_doc_id = '$doc_id' order by ord_status,eorderID ";
	$cquery.=$query;
	$eorder_data->Query($cquery);
	$totalrow = $eorder_data->Rs("countrow");
	$query = $iquery.$query.$sql_limit;
	
	$eorder_data->Query($query);
	$totalpage = ceil($totalrow/$limit);
	$switchpage='doctor_order_c';
	$id = $doc_id;
	include("../cfrontend/queryorderlist.php");
 ?>