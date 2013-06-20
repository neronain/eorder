<? include_once("../core/default.php"); ?>

<?

	$group = $_GET["gr"]; if(!isset($group))$group = 'ST';
	$keyword = $_GET["keyword"];
	$enable_staff = (isset($_GET["enable"])) ? $_GET["enable"] : 1;
	$disable_staff = (isset($_GET["disable"])) ? $_GET["disable"] : 1;
	$page = $_GET["page"]; if(!isset($page))$page = 1;
	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	
	$country_id = $_GET["country"]; if(!isset($country_id))$country_id = 0;
	$section = $_GET["section"]; if(!isset($section))$section = 0;
	
	
	$pdc_data = new CSql();
 	$pdc_data->Connect();
	$iquery = "select * ";
	$cquery = "select count(*) as countrow ";
	
	if($keyword != "") {
		$query = "from product where pdc_code like '".$keyword."%' or 
		pdc_descT1 like '%".$keyword."%' or 
		pdc_descE1 like '%".$keyword."%' or 
		pdc_descE2 like '%".$keyword."%' or 
		pdc_descE3 like '%".$keyword."%' 
		
		" ;
	}else{
		$query = "from product ";
	}

	$cquery.=$query;
	$query = $iquery.$query;
	$pdc_data->Query("$cquery");
	$totalrow = $pdc_data->Rs("countrow");
	$sql = "$query  limit ".(($page-1)*$eachpage).",$eachpage";
	//echo $sql;
	$pdc_data->Query($sql);
	$totalpage = ceil($totalrow/$eachpage);
	$querystring  = "?";
	foreach($_GET as $variable => $value){
		if($variable=="page") continue;
		$querystring  .= "$variable=$value&";
	}

?>

<? include("../admin/material_manager.php"); ?>