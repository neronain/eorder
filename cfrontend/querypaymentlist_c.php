<? include_once("../core/default.php"); ?>
<?

if(!isset($customer_id))$customer_id = $_GET['customerid'];
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

$payment_data = new CSql();
$payment_data->Connect();

$payment_data->Query("SELECT 
	left(ord_releasedate,7) as releasemonth,
	count(eorderid) as countorder,
	sum(ord_totalcost) as totalcost
	
	from 	eorder WHERE 
	ord_status = 5 and ord_cus_id = '$customer_id' 
	group by left(ord_releasedate,7)
	order by ord_releasedate desc $sql_limit");


$totalrow = $payment_data->Count();
$totalpage = ceil($totalrow/$limit);

//echo ("tp = ".$totalpage.",p = ".$page.",tr = ".$totalrow.",lim = ".$limit);
?>

<? include "../cfrontend/querypaymentlist.php" ?>