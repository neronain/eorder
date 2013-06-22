<?
class SaveDataResult {
	public static $defaultSaveDS = NULL;

	public $debug = '';
	public $ifError = false;
	public $error = array ();
	public $warning = array ();
	public $option = array ();
	public $source = array ();
	
	public function IsError() {
		return $this->ifError;	
	}
	
	public function Put($id, $msg) {
		$this->ifError = true;
		if($id==''){
			$debug = debug_backtrace();
			$id = basename($debug[0]['file'])."(".$debug[0]['line'].") ";
		}
		if($msg==''){
			$debug = debug_backtrace();
			$source = basename($debug[0]['file'])."(".$debug[0]['line'].") ";
			$source .= basename($debug[1]['file'])."(".$debug[1]['line'].") ";
			$msg = "Internal error at ".$source;
		}
		
		if(!array_key_exists($id, $this->error) || (!empty($msg) && strpos($this->error[$id], $msg) === false)) {
			$this->error[$id] .= $msg;
			
			$debug = debug_backtrace();
			$this->source[$id] .= basename($debug[0]['file'])."(".$debug[0]['line'].")".basename($debug[1]['file'])."(".$debug[1]['line'].")\n";
			
			
		}
	}
	public function Warning($id, $msg=NULL) {
		if($id==''){
			$debug = debug_backtrace();
			$id = basename($debug[0]['file'])."(".$debug[0]['line'].") ";
		}
		
		if($msg==NULL){
			$msg = $id;
			$id='msg';	
		}
		if(!array_key_exists($id, $this->warning) || (!empty($msg) && strpos($this->warning[$id], $msg) === false)) {
			$this->warning[$id] .= $msg;
		}
	}
	public function Option($id, $value) {
		$this->option[$id] = $value;
	}	
	public function Append($tmp) {
		if(!isset($tmp))return;
		foreach ($tmp->error as $id => $msg) {
			$this->Put($id,$msg);
		}
	}
	public function GetFirstErrorKey() {
		foreach ($this->error as $id => $msg) {
			return $id;
		}
		return '';
	}
	
	public function GetOption() {
		return $this->option;
	}
	public function GetErrorMsgWithBR() {
		return str_replace("\n",'<br/>',$this->GetErrorMsg());
	}
	public function GetErrorMsgWithComma() {
		return str_replace("\n",', ',$this->GetErrorMsg());
	}

	public function GetErrorMsg($showfield=false,$newline=true) {
		$rmsg = array(); $i = 0;
		if(is_array($this->error))
		foreach ($this->error as $id => $msg) {
			if($msg!=""){
				if($showfield) $rmsg[$i] .= "[".$id."] => ";
				$rmsg[$i] .= $msg;
				$i++;
			}
		}

		if($newline) $glue = "\n";
		else $glue = ", ";
		
		$retMsg = count($rmsg)>0 ? implode($glue,$rmsg) : '';
		return $retMsg;
	}
	public function GetWarningMsg($showfield=false,$newline=true) {
		$rmsg = array(); $i = 0;
		if(is_array($this->warning))
		foreach ($this->warning as $id => $msg) {
			if($msg!=""){
				if($showfield) $rmsg[$i] .= "[".$id."] => ";
				$rmsg[$i] .= $msg;
				$i++;
			}
		}

		if($newline) $glue = "\n";
		else $glue = ", ";
		
		$retMsg = count($rmsg)>0 ? implode($glue,$rmsg) : '';
		return $retMsg;
	}	
	
	public function AssertError() {
		if(!$this->ifError)return;
		$msg ="";
		foreach (SaveDS()->error as $id => $msg) {
			$msg .="[".$id."]".$msg."\n";
		}
		exit($msg);
	}
	public function Clear() {
		$this->ifError = false;
		$this->error = array ();
	}
}

SaveDataResult::$defaultSaveDS = new SaveDataResult();

function SaveDS(){
	return SaveDataResult::$defaultSaveDS;
}

