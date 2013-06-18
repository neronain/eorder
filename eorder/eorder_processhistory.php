<? include_once("../core/default.php"); ?>
<? include_once("../order/inc_shade.php"); ?>
<? include_once("../order/inc_getstring.php"); ?>
<?

	$data_logbook = new Csql();
	$err =	$data_logbook->Connect();
	
	$eorderid = $_GET["eorderid"];
	$query = "select 
	
	 logbookid,stf_name,sec_room,log_type,
	 TO_DAYS(log_date)*24*60*60+TIME_TO_SEC(TIME(log_date)) as log_dateD,
	DATE_FORMAT(log_date,'%d/%m/%y %H:%i') as log_date,
	log_date as log_datem
	 
		from logbook,staff,section
		where 
			log_stf_id=staffid and 
			log_sec_id = sectionID and
			log_ord_id=$eorderid 
			
			order by log_datem
			";	
	$data_logbook->Query($query);
	




	$status = "OUT";
	while(!$data_logbook->EOF){ 
		$id = $data_logbook->Rs("logbookid");
		$logbook[$id]['log_dateD']=$data_logbook->Rs("log_dateD");
		$logbook[$id]['log_date']=$data_logbook->Rs("log_date");
		$logbook[$id]['sec_room']=$data_logbook->Rs("sec_room");
		$logbook[$id]['stf_name']=$data_logbook->Rs("stf_name");
		$logbook[$id]['log_type']=$data_logbook->Rs("log_type");
		$data_logbook->MoveNext();
		
		if(!isset($minTime))$minTime = $logbook[$id]['log_dateD'];
		
		$minTime = min($minTime,$logbook[$id]['log_dateD']);
		$maxTime = max($maxTime,$logbook[$id]['log_dateD']);
	}
	$maxdiff = $maxTime-$minTime;
/*
	if(!$data_logbook->EOF){
		$data_logbook->MoveLast();
		$status = $data_logbook->Rs("log_type");
		$room = $data_logbook->Rs("sec_room");
		$data_logbook->MoveFirst();
	}
	
*/
	
?>
<table width="100%" border="0" cellpadding="2" cellspacing="2" class="Normal">
  <tr>
    <td colspan="4" class="HeaderW">Logbook [Process Time:<?="$maxdiff"?>]</td>
  </tr>
  <tr>
    <td class="HeaderTable">Date</td>
    <td class="HeaderTable">Section</td>
    <td class="HeaderTable">Staff</td>
    <td class="HeaderTable">Type</td>
  </tr>
  <? 
$oldtime = 0 ;
$timediff = 0;
$arraytimediff = array();
$count = 0;
$totaltimediff = 0;
if($logbook)
foreach($logbook as $logid => $clog){ 
	$timediff = $clog["log_dateD"]-$oldtime;
	if($oldtime!=0){
		$arraytimediff[$count] = $timediff;
		$count++;
		$totaltimediff+=$timediff;
	}
	$oldtime = $clog["log_dateD"];

?>
  <tr>
    <td><?= $clog["log_date"]; ?></td>
    <td><?= $clog["sec_room"]; ?></td>
    <td><?= $clog["stf_name"]; ?></td>
    <td><?= $clog["log_type"]; ?></td>
  </tr>
  <? if($clog["log_type"]=='IN'){
  	$starttime = $oldtime;
  }else if($clog["log_type"]=='OUT'){
  	$endtime = $oldtime;
  ?>
  
  <tr><td colspan="4" style="padding-left:<?=floor(($starttime-$minTime)/$maxdiff*100)?>%"><hr width="<?=ceil(($endtime-$starttime)/$maxdiff*100)?>%" align="left" size="5" noshade>
  </td></tr>
  <? } ?>
  <? 	} ?>
</table>
