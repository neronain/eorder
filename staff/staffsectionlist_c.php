<? include_once("../core/default.php"); ?>
<?
	//$page = $_GET["page"]; if(!isset($page))$page = 1;
	//$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	


	$data_staff = new CSql();
 	$data_staff->Connect();
	$iquery = "select sectionID,sec_room , sec_type ";
	//$cquery = "select count(*) as countrow ";
	$query = "from section order by sec_type,sec_room";
	//$cquery.=$query;
	$query = $iquery.$query;
	$data_staff->Query($query);
	//$data_staff->Query($query);
	//$totalrow = $data_staff->Count();
	//$data_staff->Query("$cquery");
	//$data_staff->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");

	
	//echo $query;	
		
	
	//$page = 10;	
	//$totalpage = ceil($totalrow/$eachpage);
	include("../staff/staffsectionlist.php");
	
	//echo "[".$data_staff->GetMaxID("staff")."]";
?>
