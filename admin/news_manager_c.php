<?
	include_once("../core/default.php");
	$data = new Csql();
	$data->Connect();
	$data->Query("select * from news order by newsid desc");
	if(!$data->EOF) {
		$i = 0;
		$num = $data->Count("news");
		while(!$data->EOF) {
			$news_id[$i] = $data->Rs("newsid");
			$news_title[$i] = $data->Rs("news_title");
			$news_data[$i] = $data->Rs("news_data");
			$news_date[$i] = $data->Rs("news_date");
			$news_enddate[$i] = $data->Rs("news_enddate");
			$data->MoveNext(); $i++;
		}
	}
	
	include("../admin/news_manager.php");
?>