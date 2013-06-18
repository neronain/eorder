<?
	include_once("../core/default.php");
	$data = new Csql();
	$data->Connect();
	
	$action = isset($_GET["act"]) ? $_GET["act"] : $_POST["act"];
	$news_id = isset($_GET["nid"]) ? $_GET["nid"] : 0;
	if($action == "edit") {
		$data->Query("select newsid,news_title,news_data,DAY(news_enddate) as news_day,MONTH(news_enddate) as news_month,YEAR(news_enddate) as news_year from news where newsid = $news_id limit 1");
		if(!$data->EOF) {
			$news_title = $data->Rs("news_title");
			$news_data = $data->Rs("news_data");
			$newsdate_day = $data->Rs("news_day");
			$newsdate_month = $data->Rs("news_month");
			$newsdate_year = $data->Rs("news_year");
			$newsdate = "$newsdate_year-$newsdate_month-$newsdate_day 23:59:59";
			$islimit = ($newsdate == "2099-12-31 23:59:59") ? false : true;
		}
	} else {
		$data->Query("select DAY(NOW()) as current_day,MONTH(NOW()) as current_month,YEAR(NOW()) as current_year");
		$newsdate_day = $data->Rs("current_day");
		$newsdate_month = $data->Rs("current_month");
		$newsdate_year = $data->Rs("current_year");
		$islimit = false;
	}

	include("../admin/news_editor.php");
?>