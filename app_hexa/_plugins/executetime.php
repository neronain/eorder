<?


class executetime extends Joay_Controller{
	public $START_TIMER;
	public function Route_Start(){
		$this->START_TIMER = microtime(TRUE);

		
	}
	public function Loop_Start(){

	}
	public function Action_Start($act){

			
		global $LOGSQL;
		if(Conf()->DEBUGSQL || $LOGSQL || Conf()->LOGSQL) {
			if(Conf()->DEBUG){
				$i = 0;
				$debug = debug_backtrace();
				$source = "\t\t".basename($debug[0]['file'])."(".$debug[0]['line'].") ";
				while($debug[++$i]!=NULL && basename($debug[$i]['file'])!='action.class.php'){
					$source .= basename($debug[$i]['file'])."(".$debug[$i]['line'].") ";
				}
			}
			error_log("[".date("Y-m-d H:i:s")."][START ".$act->GetAct()." ".$act->GetTodo()." ---------------------------------------]\r\n", 3, Qry()->errorlog);
		}
		
	}

	public function Html_Start(){

	}
	public function Html_End(){
		$exetime = microtime(TRUE) - $this->START_TIMER;
		echo "<!-- plugin executetime {$exetime} -->";
	}
	public function Json_Start(){
	}
	public function Json_End(){
	}
	public function JsScript_Start(){
	}
	public function JsScript_End(){
	}
	public function Action_End($act){
		global $LOGSQL;
		if(Conf()->DEBUGSQL || $LOGSQL || Conf()->LOGSQL) {
			if(Conf()->DEBUG){
				$i = 0;
				$debug = debug_backtrace();
				$source = "\t\t".basename($debug[0]['file'])."(".$debug[0]['line'].") ";
				while($debug[++$i]!=NULL && basename($debug[$i]['file'])!='action.class.php'){
					$source .= basename($debug[$i]['file'])."(".$debug[$i]['line'].") ";
				}
			}
			error_log("[".date("Y-m-d H:i:s")."][END   ".$act->GetAct()." ".$act->GetTodo()." ---------------------------------------]\r\n", 3, Qry()->errorlog);
		}
	}
	public function Loop_End(){

	}
	public function Route_End(){
		$exetime = microtime(TRUE) - $this->START_TIMER;
		$exetime *= 1000;
		if($exetime>2000){
			error_log('['.date('Y-m-d H:i:s').']'.$exetime." ".$_SERVER["REQUEST_URI"]."\n",3,"../../log/longexec.log");
		}	
		
		
		
	}



}





