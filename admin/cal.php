<?
include("../core/default.php");

set_time_limit(0);


$startdate = '2013-05-05';

$data = new Csql();

$data->Connect();
$workperfData = array();
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

$stepMin = 1;
if($_GET['stepmin']>0){
	$stepMin = $_GET['stepmin'];
}

$maxChange = 9999999999;//$stepMin*5;

$possibleMin = 1;
$possibleMax = 7*60;


$perday = 7;
$countType = 1;
$changed = 0;
foreach($workperfData as $type => $data1){
	//echo "Start type $type<br>";
	$countSec = 1;
	foreach($data1 as $sec_id => $data2){
		//echo "Start Sec $sec_id <br>";
		$countMats = 1;
		foreach($data2 as $mats=> $data3){
			//echo "Start mats $mats <br>";
			$countMatf = 1;
			foreach($data3 as $matf=> $data4){
				//echo "Start matf $matf <br>";
				$countMethod = 1;
				foreach($data4 as $method=> $data5){
					echo "<hr/>------------------ ";
					echo "$type(".$countType."/".count($workperfData).")  ";
					echo "$sec_id(".$countSec."/".count($data1).")  ";
					echo "$mats(".$countMats."/".count($data2).")  ";
					echo "$matf(".$countMatf."/".count($data3).")  ";
					echo "$method(".$countMethod."/".count($data4).")  ";
					echo "--------------------<br/>";
					//echo "Start +<br>";
					
					$prefixtext = "(".$countType."/".count($workperfData).")(".$countSec."/".count($data1).")(".$countMats."/".count($data2).")(".$countMatf."/".count($data3).")(".$countMethod."/".count($data4).") ";
					
					$factor = $data5[0];
					$time = $data5[1];
					$time = max($possibleMin,$time);
					//$time = round($time);
					//$time = min($possibleMax-3,max($possibleMin+3,$time));
					
					
					$sumerror = 9999999;
					$lastSumError = $sumerror+1;
					$bestError = $lastSumError;
					$bestTime = $time;
					$inc = 1;
					$startTime = $time;
					echo $prefixtext."Start time:============================================================== ".$time."<br/>";
					
					while(true){//abs(round($lastSumError*1000))>abs(round($sumerror*1000)) || ($method>0)){
						if (connection_status()!=0) exit();
						
						if(abs($lastSumError)<=abs($sumerror) || $time<$possibleMin || $time > $possibleMax || abs($startTime-$time)>$maxChange){
							$inc-=2;
							if($inc<-1)break;
							//echo "Start -<br>";
							$time = $lasttime-$stepMin;
							if($time==$startTime){
								$time -= $stepMin; 
							}
							if($time<$possibleMin)break;
						}
						
						
						$data->Execute("update workperformance set workperf_time = $time where
								workperf_type = '$type' and
								workperf_method = '$method' and
								workperf_mat_short = '$mats' and
								workperf_mat_full = '$matf' and
								workperf_sec_id = '$sec_id'
								");
						
						$lastSumError = $sumerror;
						
						$sumerror = 0;
						/*$sql = "    
						SELECT 
						date(logcount_date) as workdate,
						logcount_sec_id,
						count(distinct logcount_stf_id) as staff_count,
						sum(workperf_time)/count(distinct logcount_stf_id)/60 as workhr
						
						
						FROM `logcount`,workperformance WHERE 
						
						logcount_sec_id = $sec_id and
						
						workperf_type = logcount_type and
						workperf_method = logcount_method and
						workperf_mat_short = logcount_mat_short and
						workperf_mat_full = logcount_mat_full and
						workperf_sec_id = logcount_sec_id
						group by date(logcount_date),date(logcount_sec_id)     ";
						
						$data->Query($sql);
						
						
						
						if(!$data->EOF) {
							while(!$data->EOF) {
								$workhr = $data->Rs("workhr");
								$staff_count = $data->Rs("staff_count");
								$sumerror += abs(($workhr-$perday))*$staff_count;
								$data->MoveNext();
							}
						}
						*/
	
	
			           	$countMeanSqError = 0;
			            $sql = "
			            SELECT date(logcount_date) as workdate,
			            logcount_stf_id,
			            min(logcount_date) as mindatetime,
			            max(logcount_date) as maxdatetime,
			            sum(workperf_time)/60 as workhr,
			            min(workperf_time) as min_config,
			            max(workperf_time) as max_config
			            
			            
			            FROM `logcount`,workperformance WHERE 
			            
			            logcount_sec_id = $sec_id and
			            
			            workperf_type = logcount_type and
			            workperf_method = logcount_method and
			            workperf_mat_short = logcount_mat_short and
			            workperf_mat_full = logcount_mat_full and
			            workperf_sec_id = logcount_sec_id
			            group by date(logcount_date),logcount_stf_id    ";
			            
			            $data->Query($sql);
			            
			            if(!$data->EOF) {
			            	while(!$data->EOF) {
			            		$workdatePHP = strtotime($data->Rs("workdate").' 08:00:00');
			            		$mindatetime = min($workdatePHP,strtotime($data->Rs("mindatetime")));
			            		$maxdatetime = strtotime($data->Rs("maxdatetime"));
			            		$acwork = ($maxdatetime-$mindatetime)/3600-2;// 2hr for lunch 
			            		
			            		$min_config = $data->Rs("min_config");
			            		$max_config = $data->Rs("max_config");
			            		
			            		$workhr = $data->Rs("workhr");
			            		
			            		if($min_config>1 && $max_config < 7*60){
			            			$sumerror += ($workhr-$acwork)*($workhr-$acwork);
			            			$countMeanSqError++;
			            		}
			            		$data->MoveNext();
			            	}
			            }
			            
			            $lasttime = $time;
			            
			            if($countMeanSqError==0){
			            	$sumerror = 0;
			            }else{
			            	$sumerror = $sumerror/$countMeanSqError;
			            }
			            
			            if(abs($bestError)>abs($sumerror)){
			            	$bestError = $sumerror;
			            	$bestTime = $time;
			            }
			            
			            
			            $time += $inc*$stepMin;
			            
			            echo $prefixtext."Error ".$lasttime." = ".$sumerror."<br/>";
			            if($lastSumError!=9999999){
			            	if(abs($lastSumError)>abs($sumerror)){
			            		echo $prefixtext."Progress:--------------------------------------------- Try ".$lasttime." =&gt; ".$time."<br/>";
			            	}
			            }
			           	ob_end_flush();
						ob_flush();
						flush();
					}
					
					echo $prefixtext."Best time:============================================================== ".$bestTime."<br/>";
					$data->Execute("update workperformance set workperf_time = $bestTime where
							workperf_type = '$type' and
							workperf_method = '$method' and
							workperf_mat_short = '$mats' and
							workperf_mat_full = '$matf' and
							workperf_sec_id = '$sec_id'
							");
					if($bestTime!=$startTime){
						$changed++;
						echo $prefixtext."Changed record:======================================================================================= ".$changed;
					}
					$countMethod++;
				}
				$countMatf++;
			}
			$countMats++;
		}
		$countSec++;
	}
	$countType++;
}

if($changed==0){
	$stepMin = $stepMin/2;
	if($stepMin<0.0001){
		echo "Done<br/>";
		exit();
	}
}
?><script>location = 'cal.php?stepmin=<?=$stepMin?>&lastchanged=<?=$changed?>';</script>
            
