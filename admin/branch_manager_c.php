<? include_once("../core/default.php"); ?>

<?

    if($usertype!='AD')exit("Permission deny");

	$page = $_GET["page"]; if(!isset($page))$page = 1;
	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	


    $branch_data = new CSql();
 	$branch_data->Connect();
	$iquery = "select * ";
	$cquery = "select count(*) as countrow ";

    $query = "from branch  ";
    if($keyword != "") {
        $query .= " where (branch_name like '%".$keyword."%')";
    }

	$cquery.=$query;
	$query = $iquery.$query;
	$branch_data->Query("$cquery");
	$totalrow = $branch_data->Rs("countrow");
	$branch_data->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");
	$totalpage = ceil($totalrow/$eachpage);
	$querystring  = "?";
	foreach($_GET as $variable => $value){
		if($variable=="page") continue;
		$querystring  .= "$variable=$value&";
	}

?>

<? include("../admin/branch_manager.php"); ?>