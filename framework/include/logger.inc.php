<?
class Inc_Log{
	
	public static function debug($data){
		if(!(Conf()->DEBUG)){
			// TODO: log to file
			 return;
		}
		if(gettype($data)=='string'){
			echo $data;
		}else{
			Inc_Var::export($data);
		}
		while (ob_get_contents()) {
			ob_end_flush();
			ob_flush();
			flush();
		}
		ob_start();
	}
	
	
	private static $disable_list = NULL;
	public static function debug_disableme(){
		$debug = debug_backtrace();
		$source = basename($debug[0]['file'].$debug[1]['function']);
		self::$disable_list[$source] = true;
	}
	private static $is_debuglastnewline = true;
	public static function debuglog($data){
		if((Conf()->DEBUG)){
			
		}
		
		$debug = debug_backtrace();
		if(self::$disable_list[basename($debug[0]['file']).$debug[1]['function']])return;
		$source = basename($debug[0]['file'])."(".$debug[0]['line'].")";
		//Inc_Var::vardump($debug);
		
		
		$logfile = "../../log/debug_".date("Y-m-d").".log";
		
		if(!file_exists($logfile)){
			error_log("\xEF\xBB\xBF", 3, $logfile);
		}
		
		
		$msg = "";
		if(gettype($data)=='string'){
			$msg = $data;
		}else{
			$msg = Inc_Var::varexport($data);
		}

		/*if((Conf()->DEBUG)){
			Inc_Htmlutil::FlushOB(str_replace("\n","<br/>\n",$msg));
		}*/		
		if(self::$is_debuglastnewline){
			$reftext = '';
			if(self::$defaultlogref!=''){
				$reftext = "[".self::$defaultlogref."] ";
			}
			error_log("".$reftext.'['.date('Y-m-d H:i:s').']'.$source." ".$msg, 3, $logfile);
		}else{
			error_log($msg, 3, $logfile);
		}	
		self::$is_debuglastnewline = preg_match("/\n$/", $msg);
	}
	
	public static $defaultlogfile = "../../log/logger.log";
	public static $defaultlogref = NULL;
	public static function setDefaultLogFile($path){
		$dir = dirname($path);
		if(!file_exists($dir)){
			mkdir($dir,0777,true);
		}
		self::$defaultlogfile = $path;
	}
	
	
	public static $defaultlogfileStack = array();
	public static function pushDefaultLogFile($path){
		$dir = dirname($path);
		if(!file_exists($dir)){
			mkdir($dir,0777,true);
		}
		
		if(!file_exists($path)){
			error_log("\xEF\xBB\xBF", 3, $path);
		}
		
		array_push(self::$defaultlogfileStack,self::$defaultlogfile);
		self::$defaultlogfile = $path;
	}	
	public static function popDefaultLogFile(){
		$path = array_pop(self::$defaultlogfileStack);
		self::$defaultlogfile = $path;
	}
	
	private static $is_loglastnewline = true;
	public static function log($data){

		$logfile = self::$defaultlogfile;
		$msg = "";
		if(gettype($data)=='string'){
			$msg = $data;
		}else{
			$msg = var_export($data,true);
			$msg.="\n";
		}

		/*if((Conf()->DEBUG)){
			Inc_Htmlutil::FlushOB(str_replace("\n","<br/>\n",$msg));
		}*/		
		if(self::$is_loglastnewline){
			$reftext = "";
			if(self::$defaultlogref!=''){
				$reftext = "[".self::$defaultlogref."]";
			}
			error_log("".$reftext.'['.date('Y-m-d H:i:s').']'.$msg, 3, $logfile);
		}else{
			error_log($msg, 3, $logfile);
		}	
		self::$is_loglastnewline = preg_match("/\n$/", $msg);
	}
	
	private static $is_errlastnewline = true;	
	public static function errorlog($data){
		self::log($data);
		$logfile = self::$defaultlogfile."err";
		$msg = "";
		if(gettype($data)=='string'){
			$msg = $data;
		}else{
			$msg = Inc_Var::varexport($data);
		}

		
		$debug = debug_backtrace();
		$source = basename($debug[0]['file'])."(".$debug[0]['line'].")";
		$source .= basename($debug[1]['file'])."(".$debug[1]['line'].")";
		
		$msg .= $source;
		
		if((Conf()->DEBUG) && Req("todo")!="virtualipn" && Req("todo")!="processpayment"){
			Inc_Htmlutil::FlushOB("ERROR:".str_replace("\n","<br/>\n",$msg));
		}		
		if(self::$is_errlastnewline){
			$reftext = "";
			if(self::$defaultlogref!=''){
				$reftext = "[".self::$defaultlogref."]";
			}
			error_log("".$reftext.'['.date('Y-m-d H:i:s').']'.$msg, 3, $logfile);
		}else{
			error_log($msg, 3, $logfile);
		}	
		self::$is_errlastnewline = preg_match("/\n$/", $msg);
		
		self::log($msg);
		
	}	
	
	

}

