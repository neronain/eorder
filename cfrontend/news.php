<?
	$SKIPPERMISSION = true;
	include_once("../core/default.php"); 
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
			$news[$i]["month"] = $news_data->Rs("news_month");
			$news_data->MoveNext(); $i++;
		}
	}
?>
<style type="text/css">
a:link {
	color: #0000FF;
	text-decoration: none;
}
a:visited {
	color: #0000CC;
	text-decoration: none;
}
a:hover {
	color: #CC0000;
	text-decoration: none;
}
a:active {
	color: #CC0000;
	text-decoration: none;
}
</style>
<body>
<font style="font-size:12px;font-family:Tahoma, verdana">
<?

	for($i=0;$i<count($news);$i++) {
?>
<a href="#"><?=$news[$i]["month"]?>,<?=$news[$i]["day"]?> : <?=$news[$i]["title"]?></a><br />


<?
	}
?>
</font>
</body>