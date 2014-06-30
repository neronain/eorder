<? include_once("../core/default.php"); ?>

<?

    if($usertype!='AD')exit("Permission deny");

	$page = $_GET["page"]; if(!isset($page))$page = 1;
	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 10000;


    $section_data = new CSql();
 	$section_data->Connect();
	$iquery = "select * ";
	$cquery = "select count(*) as countrow ";

    $query = "from section  ";
    if($keyword != "") {
        $query .= " where (sec_room like '%".$keyword."%')";
    }

	$cquery.=$query;
	$query = $iquery.$query;
	$section_data->Query("$cquery");
	$totalrow = $section_data->Rs("countrow");
	$section_data->Query("$query order by sec_type limit ".(($page-1)*$eachpage).",$eachpage");
	$totalpage = ceil($totalrow/$eachpage);
	$querystring  = "?";
	foreach($_GET as $variable => $value){
		if($variable=="page") continue;
		$querystring  .= "$variable=$value&";
	}

?>

<? include("../admin/section_manager.php"); ?>