<?

class ReqClass
{
	public static $defaultRequest;
	public $bufferArray = array();

	function FirstInit(){
		foreach($_GET as $key => $val){
			Inc_Var::GetVar($var,$key);
			$this->bufferArray[$key] = $var;
		}
		foreach($_POST as $key => $val){
			Inc_Var::GetVar($var,$key);
			$this->bufferArray[$key] = $var;
		}
	}
	function __get($data)
	{
		return $this->bufferArray[$data];
	}	
	function __set($data,$value)
	{
		$this->bufferArray[$data] = $value;
	}
	function Def($data,$value)
	{
		if($this->bufferArray[$data]==''){
			$this->bufferArray[$data] = $value;
		}
		return $this->bufferArray[$data];
	}		
	function Clear(){
		foreach($this->bufferArray as $key => $val){
			unset($this->bufferArray[$key]);
		}
	}
	function __isset($data)
	{
		return isset($this->bufferArray[$data]);
	}
	
}

ReqClass::$defaultRequest = new ReqClass();
ReqClass::$defaultRequest->FirstInit();

function Req($name=NULL,$defaultval=NULL)
{
	if($name==NULL)
		return ReqClass::$defaultRequest;
	if($defaultval!==NULL)
		return ReqClass::$defaultRequest->Def($name,$defaultval);
	return ReqClass::$defaultRequest->__get($name);
}



