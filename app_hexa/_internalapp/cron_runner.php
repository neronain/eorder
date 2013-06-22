<?php


$DISABLE_SESSION = true;


$DISABLE_MYSQL_PERSISTANT = true;


error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT);
ini_set('log_errors',true);


if($instant_name=='debug' || $instant_name=='localhost'){
	$_SERVER['HTTP_HOST'] = 'localhost';
	
}else{
	chdir("/var/www/eorder2/tmp/chdir");
}


require_once("../../framework/conf/classpath.php");
require_once("../../framework/core/def.class.php");
require_once("../../framework/core/common.inc.php");

/*set_error_handler('DefaultErrorHandler');*/

if(Conf()->instant_name!=''){
	$instant_name = Conf()->instant_name;
}else{
	Conf()->instant_name = $instant_name;
}
// this file require instant name to run
if($instant_name==''){
	exit("Please specify \$instant_name for call this file");
}
if($_SERVER['SERVER_ADDR']==NULL){
	exit("Please specify \$_SERVER['SERVER_ADDR'] for call this file");
}
if($_SERVER['HTTP_HOST']==NULL){
	exit("Please specify \$_SERVER['HTTP_HOST'] for call this file");
}





$pathname = "../../log/cron/$instant_name";
if(!file_exists(dirname($pathname))){
	mkdir($pathname, 0777, true);
}
ini_set('error_log',$pathname."/error_".date('Y-m-d').".log");



if($instant_name=='debug'){
	Conf()->DEBUGSQL= true;
}


Conf()->global_unlock_superable = true;
Conf()->global_unlock_writeable = true;
Conf()->global_unlock_readable = true;


//$LOGSQL = true;

//Call connection;
//Qry();
Csql::$DISABLE_PROXY = true;
Csql::$defaultQry = Csql::$defaultUpdateQry;
	


$cronObjArray = MD_SysCronArray::BuildExecuteRecordForSource($instant_name);
//Inc_Var::vardump($cronObjArray);
foreach($cronObjArray->GetArray() as $cron) {
	Inc_Log::log("Run ".$cron->cronclass." of ".$cron->primary_system." primary system:".WHITELABEL_SYS_PRIMARYNAME." host:".$_SERVER['HTTP_HOST']." address:".$_SERVER['SERVER_ADDR']." \n");
	if($cron->primary_system!=WHITELABEL_SYS_PRIMARYNAME){
		Inc_Debug::PrintStack();
		exit();	
	}
	$e = NULL;
	try{
		$cronclass = $cron->cronclass;

		Inc_Log::log("Create syscron start\n");
		$runable = new $cronclass();
		//Inc_Log::log("[/]\n");
		$params = array();
		$params['DB_OBJ'] = $cron;

		$start_timer = microtime(TRUE);
		
		
		Inc_Log::log("Reserve Instant");
		$instant = MD_SysInstant::ReserveInstant($cron->id);
		if($instant==NULL){
			Inc_Log::log("[x]\n");
			continue;
		}
		Inc_Log::log("[/]\n");
		
		Inc_Log::setDefaultLogFile($pathname."/".$cronclass."_".date('Y-m-d').".log");		
		Inc_Log::$defaultlogref = $instant->id;
		
		Inc_Log::log("RunThread \n");
		$runable->RunThread($instant,$params);

		$end_timer = microtime(TRUE);

		if(!$cron->isDelete()){
			$cron->lastexedate = Inc_Var::DatePHPToMysql(mktime());
			$cron->exemicrosec = $end_timer-$start_timer;
			$cron->message .= $runable->GetMessage();
			$cron->Update();
		}
		break;
	} catch (Exception $e) {
		Inc_Log::log("Error ".$e->getMessage()."\n");
		Inc_Log::errorlog("Error ".$e->getMessage()."\n");
		$cron->enable = false;
		$cron->lastexedate = Inc_Var::DatePHPToMysql(mktime());
		$cron->message = "ERROR:".$e->getMessage();
		$cron->SetCustom('error'.date('Y-m-d'),Inc_Var::varexport($e));
		$cron->Update();
		
		Inc_Notify::Mail(2,sprintf(__("Cron %s stop working "),$cron->cronclass), Inc_Var::varexport($e));
	}
	//	Inc_Htmlutil::FlushOB($pairvarobj->note1." >> ".$pairvarobj->name." >> ".$result."<br/>");
}

