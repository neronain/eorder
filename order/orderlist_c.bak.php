<? include_once("../core/default.php"); ?>
<?
	$sort = $_GET["sort"];
	$method = $_GET["METHOD"];
	$filter = $_GET["filter"];
	$column = $_GET["column"];

	$keyword = $_GET["keyword"];
	$page = $_GET["page"]; if(!isset($page))$page = 1;


	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	

	$where = "";
	if($method=="GO!" && isset($column)){
		if($column=="ord_remark"){
			$where = " and LENGTH(ord_remark>0) and ord_remark like '%$keyword%'  ";	
		}else if($column=="ord_code"){
			$where = " and (ord_code = '$keyword' or eorderid%10000=$keyword)";
		}else{
			$where = " and $column like '%$keyword%' ";
		}	
		/*
		$where = " and (FALSE or ";
		foreach($filter as $f){
			$where .="$f like '%$keyword%' or ";
		}
		/*
		ord_patientname like '%$keyword%' or 
		doc_name like '%$keyword%' or 
		cus_name like '%$keyword%' or 
		
		$where .= " FALSE	)";//*/
	}


	$data_order = new CSql();
 	$err =	$data_order->Connect();
	$iquery = "select ord_code,cus_name,doc_name,ord_patientname,eorderid,
	DATE_FORMAT(ord_date,'%d/%m/%y') as ord_datel,ord_date,ord_remark 
	
	 ";
	$cquery = "select count(*) as countrow ";
	$query = "from eorder,customer,doctor 
		where 
			ord_cus_id = customerid and 
			ord_doc_id = doctorid 
			
			$where
			
			order by ord_date desc,eorderid desc
			";
	$cquery.=$query;
	$query = $iquery.$query;
	$data_order->Query("$cquery");
	$totalrow = $data_order->Rs("countrow");
	$data_order->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
		
		
	
	//$page = 10;	
	$totalpage = ceil($totalrow/$eachpage);
	include("../order/orderlist.php");
	
	//echo "[".$data_order->GetMaxID("eorder")."]";
?>
