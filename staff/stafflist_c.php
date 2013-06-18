<? include_once("../core/default.php"); ?>
<?
	$sort = $_GET["sort"];
	$method = $_GET["METHOD"];
	$keyword = $_GET["keyword"];
	$section_id = $_GET["sec_id"];
	if(isset($section_id)) {
		$criteria = " and sectionid=$section_id ";
	} else {
		$criteria = "";
	}
	$page = $_GET["page"]; if(!isset($page))$page = 1;


	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	

	$data_section = new Csql();
	$data_section->Connect();
	$data_section->Query("select * from section order by sec_type,sec_room");
	$i = 0;
	while(!$data_section->EOF) {
		$section[$i]["id"] = $data_section->Rs("sectionid");
		$section[$i]["name"] = $data_section->Rs("sec_type").":".$data_section->Rs("sec_room");
		$data_section->MoveNext(); $i++;
	}
	$where = "";
	if($method=="GO!"){
		$where = " and (stf_code like '%$keyword%' or stf_name like '%$keyword%' or sec_room like '%$keyword%')";
	}
	
	$data_staff = new CSql();
 	$err =	$data_staff->Connect();
	$iquery = "select CONCAT(stf_prefix,stf_name) as stf_names,staffid,sectionid,sec_room,staffid,stf_code  ";
	$cquery = "select count(*) as countrow ";
	$query = "from staff,section
		 	where stf_sec_id = sectionid and stf_enable = 1 
		 	$where $criteria
		
			order by stf_name
			";
	$cquery.=$query;
	$query = $iquery.$query;
	$data_staff->Query("$cquery");
	$totalrow = $data_staff->Rs("countrow");
	$data_staff->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
	//echo $query;	
		
	
	//$page = 10;	
	$totalpage = ceil($totalrow/$eachpage);
	include("../staff/stafflist.php");
	
	//echo "[".$data_staff->GetMaxID("staff")."]";
?>
