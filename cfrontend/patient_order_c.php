<? include_once("../core/default.php"); ?>
<? 
	if(!isset($status))$status = $_GET['status'];
	//if(!isset($start))$start = $_GET['start'];
	if(!isset($patientname))$patientname = $_GET['pname'];
	if(!isset($customer_id))$customer_id = $_GET['cusid'];
	
	if(!isset($page))$page = $_GET["page"]; 
	if(!isset($page))$page = 1;

	if(!isset($limit))$limit	= $_GET['limit'];
	if(!isset($limit))$limit	= 8;
	
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
	
	$cquery = "SELECT count(*) as countrow " ;
	$iquery = "SELECT 
		eorderID,ord_code,ord_patientname,doc_name,ord_docnote,
		ord_status,ord_date,ord_senddate,ord_arrivedate,ord_typeofwork,
		DATE_FORMAT(ord_gotdate,'%d/%m/%y') as ord_gotdate,
		ord_totalcost ";
	$query = "FROM eorder,doctor WHERE ord_patientname = '$patientname' and
	ord_doc_id = doctorid and ord_cus_id = '$customer_id' order by ord_date desc ";
	$cquery.=$query;
	$eorder_data->Query($cquery);
	$totalrow = $eorder_data->Rs("countrow");
	$query = $iquery.$query.$sql_limit;
	
	$eorder_data->Query($query);
	$totalpage = ceil($totalrow/$limit);
	$switchpage='patient_order_c';
	$id = "'$patientname'";
	include("../cfrontend/queryorderlist.php");
 ?>
