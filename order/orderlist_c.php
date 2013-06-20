<? include_once("../core/default.php"); ?>
<?
	//$DEBUGSQL = true;
	$sort = $_GET["sort"];
	$method = $_GET["METHOD"];
	$filter = $_GET["filter"];
	$column = $_GET["column"];
	$keyword = $_GET["keyword"];
	
	$page = (isset($_GET["page"])) ? $_GET["page"] : 1;
	GetVar($status,"status");
	$eachpage = (isset($_GET["eachpage"])) ? $_GET["eachpage"] : 15;	


	

	$where = "";
	if($method=="GO!" && isset($column)){
		if($keyword!=''){
			if($column=="ord_remark"){
				$where = " and ord_remark like '%$keyword%' and LENGTH(ord_remark>0) ";	
			}else if($column=="eorderid"){
				$where = " and eorderid = '$keyword' ";
				$status =-1;
			}else if($column=="ord_code"){
				if(strlen($keyword)==16){
					$where = " and (ord_code like '$keyword' )  ";
				}else{
					$where = " and (ord_code like '%$keyword%')";/* or eorderid%100000=".($keyword+0)." 
					 or left(right(ord_code,10),8) %100000=".($keyword+0)." )  ";*/
				}
				$status =-1;
	
			}else if($column=="cus_name"){
				$where = " and ord_cus_id in (select customerid from customer where cus_name like '%$keyword%') ";
			}else if($column=="doc_name"){
				$where = " and ord_doc_id in (select doctorid from doctor where doc_name like '%$keyword%') ";
			}else{
				$where = " and $column like '%$keyword%' ";
			}	
			/*
			if($status!=NULL && $status!=-1 && $column!="eorderid" && $column!="ord_code"){
				if($status=='56'){
					$where .=" and (ord_status=5 or ord_status=6)";
				}else{
					$where .=" and ord_status=$status ";
				}
			}*/	
		}	
	}else{
		if($status!=NULL && $status!=-1){
			$where .=" and ord_status=$status ";
		}
	}
	
	$data_order = new CSql();
 	$err =	$data_order->Connect();
	$iquery = "select ord_code,ord_patientname,eorderid,ord_typeofwork,
	DATE_FORMAT(ord_date,'%d/%m/%y') as ord_datel,ord_date,ord_remark ,ord_status,
	DATE_FORMAT(ord_releasedate,'%d/%m/%y') as ord_releasedatel,ord_cus_id,ord_doc_id
	
	
	
	 ";
	$cquery = "select count(*) as countrow ";
	$query = "from eorder
		where 
			TRUE
			
			$where
			
			
			order by ord_date desc,eorderid desc
			";
	$cquery.=$query;
	$query = $iquery.$query;
	$data_order->Query("$cquery");
	
	$totalrow = $data_order->Rs("countrow");
	$data_order->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");
	$totalpage = ceil($totalrow/$eachpage);
	//echo $query;
	$currentMenu = $status;

	
	
	
	/*-------------- optimize -------------------*/
	$data_tmp = new Csql();
	$data_tmp->Connect();
	
	$cache = array();
	$data_orderAr = array();
	
	while(!$data_order->EOF){
		$rowAr = $data_order->CurrentRowArray();
		
		$key = $rowAr['ord_cus_id'];
		if($cache['customer'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select cus_name from customer where customerid = {$key} limit 0,1");
			$cache['customer'][$key] = $tmpRow;
		}
		$rowAr['cus_name'] = $cache['customer'][$key]["cus_name"];
	
		$key = $rowAr['ord_doc_id'];
		if($cache['doctor'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select doc_name from doctor where doctorid = {$key} limit 0,1");
			$cache['doctor'][$key] = $tmpRow;
		}
		$rowAr['doc_name'] = $cache['doctor'][$key]["doc_name"];
	
	
	
		$data_orderAr[] = $rowAr;
		$data_order->MoveNext();
	
	}
	/*-------------- optimize -------------------*/	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
 include("../order/orderlist.php"); ?>