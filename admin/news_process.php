<?
	include_once("../core/default.php");
	$data = new Csql();
	$data->Connect();
	//$DEBUGSQL = true;
	$action = isset($_GET["act"]) ? $_GET["act"] : $_POST["act"];
	$news_id = isset($_GET["nid"]) ? $_GET["nid"] : $_POST["nid"];
	$news_title = isset($_POST["title"]) ? $_POST["title"] : "No Title";
	$news_data = isset($_POST["data"]) ? $_POST["data"] : "No Data";
	$newsdate_month = $_POST["newsdate_month"];
	$newsdate_day = $_POST["newsdate_day"];
	$newsdate_year = $_POST["newsdate_year"];
	$islimit = isset($_POST["islimit"]) ? true : false;
	$news_begindate = "NOW()";
	if($islimit) 
		$news_enddate = "$newsdate_year-$newsdate_month-$newsdate_day 23:59:59";
	else
		$news_enddate = "2099-12-31 23:59:59";
	
	if($action == "add") {
		$data->AddNew();
		$data->TableName = "news";
		$data->Set("news_title","'$news_title'");
		$data->Set("news_data","'$news_data'");
		$data->Set("news_date","$news_begindate");
		$data->Set("news_enddate","'$news_enddate'");
		$data->Update();
	} elseif($action == "edit") {
		$data->Query("select * from news where newsid= $news_id limit 1");
		if(!$data->EOF) {
			$data->TableName = "news";
			$data->Set("news_title","'$news_title'");
			$data->Set("news_data","'$news_data'");
			$data->Set("news_date","$news_begindate");
			$data->Set("news_enddate","'$news_enddate'");
			$data->Update();
		}
	} elseif($action == "del") {
		$data->Execute("delete from news where newsid=$news_id");
	}
	gotourl("../admin/news_manager_c.php",0);
?>