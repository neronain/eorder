<? include_once("../core/default.php"); ?>
<?
	$sort = $_GET["sort"];
	$method = $_GET["METHOD"];
	$keyword = $_GET["keyword"];
	//$section_id = $_GET["sec_id"];
	//if(isset($section_id)) {
	//	$criteria = " and sectionid=$section_id ";
	//} else {
	//	$criteria = "";
	//}
	
	$criteria = "";
	$page = $_GET["page"]; if(!isset($page))$page = 1;


	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	

	$where = "";
	if($method=="GO!"){
		$where = " and (cus_name like '%$keyword%')";
	}
	
	$data_invoice = new CSql();
 	$err =	$data_invoice->Connect();
	$iquery = "select *  ";
	$cquery = "select count(*) as countrow ";
	$query = "from invoice,customer
		 	where inv_cus_id = customerid 
		 	$where $criteria
		
			order by inv_date desc,invoiceid desc
			";
	$cquery.=$query;
	$query = $iquery.$query;
	$data_invoice->Query("$cquery");
	$totalrow = $data_invoice->Rs("countrow");
	$data_invoice->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
	//echo $query;	
		
	
	//$page = 10;	
	$totalpage = ceil($totalrow/$eachpage);
	include("../invoice/invoicelist.php");
	
	//echo "[".$data_invoice->GetMaxID("invoice")."]";
?>
