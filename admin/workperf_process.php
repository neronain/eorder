<?
	include_once("../core/default.php");

	$data = new Csql();
	$data->Connect();
	$data->Query("select * from workperformance");
	if(!$data->EOF) {
		$i = 0;
		$num = $data->Count();
		while(!$data->EOF) {
			$workperfData
			[$data->Rs("workperf_type")]
			[$data->Rs("workperf_sec_id")]
			[$data->Rs("workperf_mat_short")]
			[$data->Rs("workperf_mat_full")]
			[$data->Rs("workperf_method")]
			 = array($data->Rs("workperf_factor"),$data->Rs("workperf_time"));
			
			$data->MoveNext();
		}
	}	
	
	$postdata = $_POST["data"];
	$posttime = $_POST["time"];
	$redirect = $_POST["redirect"];
	
	foreach($workperfData as $type => $data1){
		foreach($data1 as $sec_id => $data2){
			foreach($data2 as $mats=> $data3){
				foreach($data3 as $matf=> $data4){
					foreach($data4 as $method=> $data5){
						$factor = $data5[0];
						$time = $data5[1];
						$newfactor = $postdata[stringToHex($type)][($sec_id)][stringToHex($mats)][stringToHex($matf)][stringToHex($method)];
						$newtime = $posttime[stringToHex($type)][($sec_id)][stringToHex($mats)][stringToHex($matf)][stringToHex($method)];
						if($newfactor!==NULL && $newtime!==NULL && ($factor+0!=$newfactor+0 || $time+0!=$newtime+0)){
							$sql = "update workperformance set workperf_factor = $newfactor,workperf_time = $newtime where 
							 workperf_type = '$type' and
							 workperf_method = '$method' and
							 workperf_mat_short = '$mats' and
							 workperf_mat_full = '$matf' and
							 workperf_sec_id = '$sec_id'
							";
							
							$data->Execute($sql);
						}
						//echo "postdata[($type)][($sec_id)][($mats)][($matf)][($method)]=$newfactor,$newtime<br/>";
					}
				}
			}
		}
	}
			
	if($redirect!=''){
		gotourl($redirect,0);
	}else{
		gotourl("../admin/workperf_manager_c.php",0);
	}
?>