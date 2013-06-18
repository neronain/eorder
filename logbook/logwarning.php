<?
$sql = "select eordertodayid from eordertoday where eordertodayid=$eorderid 
and datediff(curdate(),date(ordt_releasedate))>7";
$data_logbook->Query($sql);
if($data_logbook->Count()){
	$sql = "select eorderwarningid from eorderwarning where eorderwarningid=$eorderid";
	$data_logbook->Query($sql);
	if($data_logbook->Count()==0){
		$data_logbook->Execute("insert into eorderwarning values($eorderid)");
	}
}


?>