<?
	$customer_id = isset($_GET["customerid"]) ? $_GET["customerid"] : $_COOKIE["customerid"];
	$customerid =$customer_id;
	//if(!isset($customer_id)) $customer_id=8;
	$data = new Csql();
	$data->Connect();
	$eorder_id = $data->GetMaxID("eorder");
	$news_data = new Csql();
	$news_data->Connect();
	$news_data->Query("select newsid,news_title,news_data,news_date,news_enddate,DAY(news_date) as news_day,MONTHNAME(news_date) as news_month from news where DATEDIFF(news_enddate,NOW()) >= 0 order by news_date desc limit 0,3");
	if(!$news_data->EOF) {
		$i = 0;
		while(!$news_data->EOF) {
			$news[$i]["id"] = $news_data->Rs("newsid");
			$news[$i]["title"] = $news_data->Rs("news_title");
			$news[$i]["data"] = $news_data->Rs("news_data");
			$news[$i]["day"] = $news_data->Rs("news_day");
			$news[$i]["month"] = substr($news_data->Rs("news_month"),0,3);
			$news_data->MoveNext(); $i++;
		}
	}
?>
