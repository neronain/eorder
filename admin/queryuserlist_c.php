<? include_once("../core/default.php"); ?>
<?

if(!isset($userdentalid))$userdentalid = $_GET['cusid'];
$page = $_GET["page"]; if(!isset($page))$page = 1;

if(!isset($limit))$limit = $_GET['limit'];
if(!isset($limit))$limit = 3;

if($limit > 0){
	$start = ($page-1)*$limit;
	$sql_limit = "Limit $start,".$limit;
}else{
	$sql_limit = "";
}
	
//$userdentalid = 585;

$userdental_data = new CSql();
$userdental_data->Connect();

$iquery = "SELECT userdentalid,usr_username ";
$query  = "FROM userdental ";

$query = $iquery.$query.$sql_limit;

$userdental_data->Query($query);
$totalrow = ceil($userdental_data->Count()/$limit);
$totalpage = ceil($totalrow/$limit);
	
?>

<? include "../admin/queryuserlist.php" ?>

