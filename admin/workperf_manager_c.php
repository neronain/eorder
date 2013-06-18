<?
	include_once("../core/default.php");
	$data = new Csql();
	$data->Connect();
	$data->Query("select * from workperformance order by workperf_type,workperf_sec_id,workperf_mat_short,workperf_mat_full,workperf_method");
	if(!$data->EOF) {
		$i = 0;
		$num = $data->Count();
		while(!$data->EOF) {
			$workperfData
			[$data->Rs("workperf_type")]
			[$data->Rs("workperf_sec_id")]
			[$data->Rs("workperf_mat_short")]
			[$data->Rs("workperf_mat_full")]
			[$data->Rs("workperf_method")] = array($data->Rs("workperf_factor"),$data->Rs("workperf_time"));
			$data->MoveNext(); 
		}
	}
	
	include("../admin/workperf_manager.php");
?>