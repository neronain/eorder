<? include_once("../core/default.php"); ?>
<?
$customerid = $_GET['cusid'];
$docname = $_GET['docname'];

$doc_data = new CSql();
$doc_data->connect();
$doc_data->AddNew();	
$doc_data->TableName = "doctor";
$doc_data->Set("doc_name","'$docname'");
$doc_data->Set("doc_cus_id","$customerid");
$doc_data->Update();

?>

<?
include ("../customer/customerdoctor_c.php");
?>

