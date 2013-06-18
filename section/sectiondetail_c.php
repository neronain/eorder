<?
	include "../core/default.php";
	
	$sectionid = $_GET["sectionid"];
	$tab = $_GET["tab"];
	
	if(!isset($sectionid))$sectionid = $_POST["sectionid"];



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



	$data_section = new Csql();
	$err =	$data_section->Connect();
	$query = "select * from section
		where 
			sectionid=$sectionid limit 0,1";
	$data_section->Query($query);

	$data_staff = new Csql();
	$err =	$data_section->Connect();
	$query = "select * from staff
		where 
			stf_sec_id=$sectionid and stf_enable = TRUE ";
	$data_staff->Query($query);
	
	$staffcount = $data_staff->Count();

	if($tab=="orderstat"){
		if($method=="GO!"){
			$data_perday = new CSql();
			
			
			$sqlperday = "
				select avg(eachday) as avgday,sum(eachday) as sumall from
				(select sum(workperf_factor) as eachday,DATE(logcount_date) from logcount,workperformance where
					 DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and 
					 DATE('$logend_year-$logend_month-$logend_day')  and
					 logcount_sec_id = $sectionid and

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
					 logcount_sec_id = $sectionid  and

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
					 logcount_sec_id = $sectionid  and

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
		}
	
	
	}else	if($tab=="orderstaff"){
	
			$data_perday = new CSql();
			$data_country = new CSql();
			
			$sqlperday = "
				select avg(eachday) as avgday,sum(eachday) as sumall from
				(select sum(workperf_factor) as eachday,DATE(logcount_date) from logcount,workperformance where
					 DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and 
					 DATE('$logend_year-$logend_month-$logend_day')  and
					 logcount_sec_id = $sectionid 	 and

					 workperf_factor > 0 and
					 workperf_type = logcount_type and
					 workperf_method = logcount_method and
					 workperf_mat_short = logcount_mat_short and
					 workperf_mat_full = logcount_mat_full and
					 workperf_sec_id = logcount_sec_id
					 
					 group by DATE(logcount_date)
				 )as cnteach
			";
			//echo $sqlperday."<hr/>";
			$data_perday->Query("$sqlperday");
			$orderperday = $data_perday->Rs("avgday")/$staffcount; 
			$orderperday = round($orderperday*100);
			$orderperday = $orderperday/100;
			$sumall =   $data_perday->Rs("sumall"); 


			$sqlperday = "
				select max(eachday) as maxperday from
				(select logcount_stf_id,sum(workperf_factor) as eachday from logcount,workperformance where
					 DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and 
					 DATE('$logend_year-$logend_month-$logend_day')  and
					 logcount_sec_id = $sectionid 	 and

					 workperf_factor > 0 and
					 workperf_type = logcount_type and
					 workperf_method = logcount_method and
					 workperf_mat_short = logcount_mat_short and
					 workperf_mat_full = logcount_mat_full and
					 workperf_sec_id = logcount_sec_id
					 
					 group by logcount_stf_id
				 )as cnteach
			";
			//echo $sqlperday."<hr/>";
			$data_perday->Query("$sqlperday");
			$maxperday = $data_perday->Rs("maxperday"); 
			/*

			$sqlperday = "
				select max(eachday) as maxperday from
				(select count(logcountid) as eachday,DATE(logcount_date) from logcount where
					 DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and 
					 DATE('$logend_year-$logend_month-$logend_day')  and
					 log_sec_id = $sectionid and
					 log_type='OUT'				
					 group by DATE(logcount_date)
				 )as cnteach
			";
			$data_perday->Query("$sqlperday");
			$maxperday = $data_perday->Rs("maxperday"); 
			*/
			
			$sqlperday = "
				select logcount_stf_id,sum(workperf_factor) as eachday from logcount,workperformance where
					 DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and 
					 DATE('$logend_year-$logend_month-$logend_day')  and
					 logcount_sec_id = $sectionid 	 and
					
					 workperf_factor > 0 and
					 workperf_type = logcount_type and
					 workperf_method = logcount_method and
					 workperf_mat_short = logcount_mat_short and
					 workperf_mat_full = logcount_mat_full and
					 workperf_sec_id = logcount_sec_id
					 
					 group by logcount_stf_id

				 order by logcount_stf_id
			";
			//echo $sqlperday."<hr/>";
			$data_perday->Query("$sqlperday");
			
			
			$data_perdayna = new CSql();
			$sqlperdayna = "
			select logcount_stf_id,count(distinct logcount_ord_id) as countna,sum(workperf_factor) as eachday from logcount,workperformance where
			DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and
			DATE('$logend_year-$logend_month-$logend_day')  and
			logcount_sec_id = $sectionid 	 and
			
			workperf_factor < 0 and
			workperf_type = logcount_type and
			workperf_method = logcount_method and
			workperf_mat_short = logcount_mat_short and
			workperf_mat_full = logcount_mat_full and
			workperf_sec_id = logcount_sec_id
			
			group by logcount_stf_id
			
			order by logcount_stf_id
			";
			//echo $sqlperday."<hr/>";
			$data_perdayna->Query("$sqlperdayna");			
			while(!$data_perdayna->EOF){
				$na_record[$data_perdayna->Rs('logcount_stf_id')] = $data_perdayna->Rs('countna');
				$data_perdayna->MoveNext();
			}
			
			
			
			/*$sqlcountry = "
				select distinct cnt_name from
					 logcount,eorder,customer,country where
					 DATE(logcount_date) between DATE('$logstart_year-$logstart_month-$logstart_day') and 
					 DATE('$logend_year-$logend_month-$logend_day')  and
					 logcount_sec_id = $sectionid and
					 logcount_ord_id = eorderid and
					 ord_cus_id = customerid and
					 cus_cnt_id = countryid
					 
				order by	 cnt_name
			";			
			echo $sqlcountry."<hr/>";
			$data_country->Query("$sqlcountry");*/
			
			
			//$orderperday = $data_perday->Rs("avgday"); 
			//$orderperday = round($orderperday*100);
			//$orderperday = $orderperday/100;
			//$sumall =   $data_perday->Rs("sumall"); 			

	

	}

	
	
	
	include "sectiondetail.php";

?>
