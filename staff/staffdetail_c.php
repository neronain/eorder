<?
	include "../core/default.php";
	
	$staffid = $_GET["staffid"];
	$tab = $_GET["tab"];
	$only_na = $_GET["only_na"];
	
	if(!isset($staffid))$staffid = $_POST["staffid"];
	if(!isset($only_na))$only_na = $_POST["only_na"];


	//$sort = $_GET["sort"];
	$method = $_GET["METHOD"];
	//$filter = $_GET["filter"];
	//$column = $_GET["column"];

	$logstart_day = $_GET["logstart_day"];
	$logstart_month = $_GET["logstart_month"];
	$logstart_year = $_GET["logstart_year"];
	$logend_day = $_GET["logend_day"];
	$logend_month = $_GET["logend_month"];
	$logend_year = $_GET["logend_year"];
			$today = getdate();
		//print_r($today);
	if(!isset($logstart_day))$logstart_day=1;
	if(!isset($logstart_month))$logstart_month=$today['mon']; 
	if(!isset($logstart_year))$logstart_year=$today['year'];
	
	if(!isset($logend_day))$logend_day=$today['mday'];
	if(!isset($logend_month))$logend_month=$today['mon']; 
	if(!isset($logend_year))$logend_year=$today['year'];


	$orderperday = -1;



	$data_staff = new Csql();
	$err =	$data_staff->Connect();
	$query = "select * from staff,section
		where 
			stf_sec_id = sectionid and
			staffid=$staffid limit 0,1";
	$data_staff->Query($query);

	if($tab=="orderstat"){
		if($method=="GO!"){
			$data_perday = new CSql();
			$data_pertype = new CSql();
			
			
			$sqlperday = "
				select avg(eachday) as avgday,sum(eachday) as sumall from
				(select sum(workperf_factor) as eachday,DATE(logcount_date) from logcount,workperformance where
					 DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and 
					 DATE('$logend_year-$logend_month-$logend_day')  and
					 logcount_stf_id = $staffid 		 and

					 workperf_factor > 0 and
					 workperf_type = logcount_type and
					 workperf_method = logcount_method and
					 workperf_mat_short = logcount_mat_short and
					 workperf_mat_full = logcount_mat_full and
					 workperf_sec_id = logcount_sec_id
					 
					 		
					 group by DATE(logcount_date)
				 )as cnteach
			";
			$data_perday->Query("$sqlperday");
			$orderperday = $data_perday->Rs("avgday"); 
			$orderperday = round($orderperday*100);
			$orderperday = $orderperday/100;
			$sumall =   $data_perday->Rs("sumall"); 


			$sqlperday = "
				select max(eachday) as maxperday from
				(select sum(workperf_factor) as eachday,DATE(logcount_date) from logcount,workperformance where
					 DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and 
					 DATE('$logend_year-$logend_month-$logend_day')  and
					 logcount_stf_id = $staffid 			 and

					 workperf_factor > 0 and
					 workperf_type = logcount_type and
					 workperf_method = logcount_method and
					 workperf_mat_short = logcount_mat_short and
					 workperf_mat_full = logcount_mat_full and
					 workperf_sec_id = logcount_sec_id
					 
					 
					 group by DATE(logcount_date)
				 )as cnteach
			";
			$data_perday->Query("$sqlperday");
			$maxperday = $data_perday->Rs("maxperday"); 





			if(($logend_year * 12 + $logend_month) - ($logstart_year * 12 + $logstart_month) <= 2){
			//if(1-1==0){
				$isgroupday = true;
				$selectfield = "
					DATE_FORMAT(logcount_date,'%e') as log_dated,
					DATE_FORMAT(logcount_date,'%m') as log_datem,
					DATE_FORMAT(logcount_date,'%Y') as log_datey";
				$groupby = "
					DATE_FORMAT(logcount_date,'%e'),
					DATE_FORMAT(logcount_date,'%m'),
					DATE_FORMAT(logcount_date,'%Y')";
			}else{
				$isgroupday = false;
				$selectfield = "
					DATE_FORMAT(logcount_date,'%m') as log_datem,
					DATE_FORMAT(logcount_date,'%Y') as log_datey";
				$groupby = "
					DATE_FORMAT(logcount_date,'%m'),
					DATE_FORMAT(logcount_date,'%Y')";
			}
			
			$sqlperday = "
			
				select sum(workperf_factor) as eachday,$selectfield
				
				from logcount,workperformance where
					 DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and 
					 DATE('$logend_year-$logend_month-$logend_day')  and
					 logcount_stf_id = $staffid 		 and

					 workperf_factor > 0 and
					 workperf_type = logcount_type and
					 workperf_method = logcount_method and
					 workperf_mat_short = logcount_mat_short and
					 workperf_mat_full = logcount_mat_full and
					 workperf_sec_id = logcount_sec_id
					 
					 		
					 group by $groupby
					order by logcount_date
			
			";
			$data_perday->Query("$sqlperday");
			
			
			
			$sqlpertype = "
			
			select workperf_method,workperf_mat_full,count(*)as eachtype_raw,sum(workperf_factor) as eachtype_cal
			
			from logcount,workperformance where
			DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and
			DATE('$logend_year-$logend_month-$logend_day')  and
			logcount_stf_id = $staffid 		 and
			
			workperf_factor > 0 and
			workperf_type = logcount_type and
			workperf_method = logcount_method and
			workperf_mat_short = logcount_mat_short and
			workperf_mat_full = logcount_mat_full and
			workperf_sec_id = logcount_sec_id
			
			
			group by workperf_method,workperf_mat_full
			order by workperf_mat_full,workperf_method
			
			";
			$data_pertype->Query("$sqlpertype");			
			
			
			
		}
	
	
	}else	if($tab=="orderlist"){
	
	
	
	//---------------------------------------------------------------------------------------------------------------------------------------------

		

		

		
		
		
		$page = $_GET["page"]; if(!isset($page))$page = 1;
	
	
		$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	
	
		$where = "";
		
		
		$data_order = new CSql();
		
		if($method=="GO!"){
			$where = " and DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') 
			and DATE('$logend_year-$logend_month-$logend_day')  and
			
			";
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
			
			if($only_na){
				$where .= " workperf_factor < 0 and ";
			}else{
				//$where .= "workperf_factor >= 0 and";
			}
			
			$iquery = "select ord_code ,ord_patientname,eorderid,ord_typeofwork,
			DATE_FORMAT(ord_date,'%d/%m/%y') as ord_datel,logcount_date,ord_date ".
			",count(*) as unit,sum(workperf_factor) as countunit ".
			 "";
			$cquery = "select count(distinct eorderid) as countrow ";
			$query = "from eorder,logcount".
			",workperformance".
			"
				where 
					
					
					logcount_ord_id = eorderid	and
					logcount_stf_id = $staffid 
					
					$where
					
					
 					".
 					"
					 workperf_type = logcount_type and
					 workperf_method = logcount_method and
					 workperf_mat_short = logcount_mat_short and
					 workperf_mat_full = logcount_mat_full and
					 workperf_sec_id = logcount_sec_id					
					

					";
		
			$cquery.=$query;
			$query = $iquery.$query."  group by eorderid  order by logcount_date ,eorderid desc";
			$data_order->Query("$cquery");
			$totalrow = $data_order->Rs("countrow");
			
			//echo $query;
			$data_order->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
				
				
			
			//$page = 10;	
			$totalpage = ceil($totalrow/$eachpage);			
			
			
			$sqlperday = "
			
				select avg(eachday) as avgday from
				(select sum(workperf_factor) as eachday,DATE(logcount_date) from logcount,workperformance where
					 DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and 
					 DATE('$logend_year-$logend_month-$logend_day')  and
					 logcount_stf_id = $staffid		 and

					 workperf_factor > 0 and
					 workperf_type = logcount_type and
					 workperf_method = logcount_method and
					 workperf_mat_short = logcount_mat_short and
					 workperf_mat_full = logcount_mat_full and
					 workperf_sec_id = logcount_sec_id
					 
					 
					 group by DATE(logcount_date)
				 )as cnteach
			
			";
			//echo $sqlperday;
			$data_perday = new CSql();
			$data_perday->Query("$sqlperday");
			$orderperday = $data_perday->Rs("avgday"); 
			
			$orderperday = round($orderperday*100);
			$orderperday = $orderperday/100;
		}else{
				

		}
	

	}

	include "staffdetail.php";

?>
