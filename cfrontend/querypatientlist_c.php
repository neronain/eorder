<? include_once("../core/default.php"); ?>
<?

if(!isset($customer_id))$customer_id = $_GET['cusid'];
$page = $_GET["page"]; if(!isset($page))$page = 1;

if(!isset($limit))$limit = $_GET['limit'];
if(!isset($limit))$limit = 25;

if($limit > 0){
	$start = ($page-1)*$limit;
	$sql_limit = "Limit $start,".$limit;
}else{
	$sql_limit = "";
}
	
//$customer_id = 585;

$patient_data = new CSql();
$patient_data->Connect();

$iquery = "SELECT DISTINCT ord_patientname ";
$query  = "FROM eorder WHERE ord_cus_id = '$customer_id' order by ord_patientname ";

$cquery = $iquery.$query;
$patient_data->Query($cquery); 
$totalrow = ceil($patient_data->Count());

$query = $iquery.$query.$sql_limit;

$patient_data->Query($query);
$totalpage = ceil($totalrow/$limit);

//echo ("tp = ".$totalpage.",p = ".$page.",tr = ".$totalrow.",lim = ".$limit);
?>

<? include "../cfrontend/querypatientlist.php" ?>

