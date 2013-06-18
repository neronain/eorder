<? include_once("../core/default.php"); ?>
<?

if(!isset($customer_id))$customer_id = $_GET['cusid'];
$page = $_GET["page"]; if(!isset($page))$page = 1;


if(!isset($limit))$limit = $_GET['limit'];
if(!isset($limit))$limit = 20;

if($limit > 0){
	$start = ($page-1)*$limit;
	$sql_limit = "Limit $start,".$limit;
}else{
	$sql_limit = "";
}
	
//$customer_id = 585;

$doctor_data = new CSql();
$doctor_data->Connect();

$cquery = "SELECT count(*) as countrow " ;
$iquery = "SELECT doctorId,clinicCode,address,doc_name,doc_cus_id ";
$query  = "FROM doctor WHERE doc_cus_id = '$customer_id' order by doc_name ";

$cquery.=$query;
$doctor_data->Query($cquery);
$totalrow = $doctor_data->Rs("countrow");
$query = $iquery.$query.$sql_limit;

$doctor_data->Query($query);
$totalpage = ceil($totalrow/$limit);
	
?>

<? include "../cfrontend/querydoctorlist.php" ?>

