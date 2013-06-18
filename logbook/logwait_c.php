<?
	include_once("../core/default.php"); 
// IN
	$method 	= $_POST["METHOD"];	
	$logbookid = $_POST["logbookid"];
	$page = $_GET["page"]; 
	if(!isset($page)){		$page = $_POST["page"];	}
	if(!isset($page)){		$page = 1;	}
	
	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	
	
// INIT
	$data_logbook = new Csql();
	$data_logbook->Connect();

// Start Code
	$msg = '';
	if(isset($method)){
	/*
		if($method=="DELETE"){
			if(isset($logbookid)){
				$data_logbook->Execute("delete logbook from logbook where logbookid=$logbookid");
			}
		} // */
	}


	$iquery = "select logbookid,
	TIME_FORMAT(TIMEDIFF(NOW(),log_date),'%H:%i') as log_datediff,
	DATE_FORMAT(log_date,'%d/%m/%y %H:%i') as log_datef,log_date,
	stf_name,sec_room,ord_code,log_type,eorderid ";
	$cquery = "select count(*) as countrow ";
	$query = "from  
		(select eorderid,ord_code from eorder)as ord
		left join
		(select max(log_date) as maxdate,log_ord_id as maxorder 
		from logbook group by log_ord_id)as maxorder on maxorder = eorderid
		inner join
		(select logbookid,log_date,stf_name,sec_room,log_type,log_ord_id 
		from logbook,section,staff where log_sec_id = sectionid and log_stf_id = staffid and  log_type = 'OUT'
		)as logb on log_date=maxdate and log_ord_id=maxorder
			

			order by TIMEDIFF(NOW(),log_date) desc
			";
	$cquery.=$query;
	$query = $iquery.$query;
	$data_logbook->Query("$cquery");
	$totalrow = $data_logbook->Rs("countrow");
	$data_logbook->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
		
		
	
	//$page = 10;	
	$totalpage = ceil($totalrow/$eachpage);

	include ("../logbook/logwait.php");
	
	
?>
