<? include_once("../core/default.php"); ?>
<?
	$sort = $_GET["sort"];
	$method = $_GET["METHOD"];
	$keyword = $_GET["keyword"];
	$page = $_GET["page"]; if(!isset($page))$page = 1;
	$cnt_id = $_GET["cnt_id"];
	$prv_id = $_GET["prv_id"];
	if(isset($cnt_id)) {
		$criteria = " and countryid=$cnt_id ";
		$data_province = new Csql();
		$data_province->Connect();
		$data_province->Query("select * from province where prv_cnt_id = $cnt_id");
		$i = 0; $province = array();
		while(!$data_province->EOF) {
			$province[$i]["id"] = $data_province->Rs("provinceid");
			$province[$i]["name"] = $data_province->Rs("prv_name");
			$data_province->MoveNext(); $i++;
		}
	} else {
		$criteria = "";
		$cnt_id = 0;
	}
	
	if(isset($prv_id)) {
		$criteria2 = " and provinceid = $prv_id";
	} else {
		$criteria2 = "";
	}
	
	$data_country = new Csql();
	$data_country->Connect();
	$data_country->Query("select * from country order by cnt_name");
	$i = 0; $country = array();
	while(!$data_country->EOF) {
		$country[$i]["id"] = $data_country->Rs("countryid");
		$country[$i]["name"] = $data_country->Rs("cnt_name");
		$data_country->MoveNext(); $i++;
	}


	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	

	$where = "";
	if($method=="GO!"){
		$where = " and (cus_name like '%$keyword%' or cus_nick ='$keyword')";
	}
	
	
	$data_customer = new CSql();
 	$err =	$data_customer->Connect();
	$iquery = "select * ";
	$cquery = "select count(*) as countrow ";
	$query = "from customer,country,province
		 	where cus_prv_id = provinceid and prv_cnt_id = countryid
			and cus_enable = TRUE 
		 	$where $criteria $criteria2
		
			order by cus_name
			";
	$cquery.=$query;
	$query = $iquery.$query;
	$data_customer->Query("$cquery");
	$totalrow = $data_customer->Rs("countrow");
	$data_customer->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
	//echo $query;	
		
	
	//$page = 10;	
	$totalpage = ceil($totalrow/$eachpage);
	include("../customer/customerlist.php");
	
	//echo "[".$data_customer->GetMaxID("customer")."]";
?>
