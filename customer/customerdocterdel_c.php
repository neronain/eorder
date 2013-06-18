<? include_once("../core/default.php"); ?>
<?
$customerid = $_GET['cusid'];
$docid = $_GET['docid'];
$doc_data = new CSql();
$doc_data->connect();

$query = "delete from doctor
		where 
			doctorId = '$docid'
			and doc_cus_id = '$customerid' ";
$doc_data->Execute($query);


?>

<?
include ("../customer/customerdoctor_c.php");
?>