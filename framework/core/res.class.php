<?
include_once "../../framework/core/common.inc.php";
class ResClass
{
	public static $defaultResponse;
	public $bufferArray = array();

	function __construct(){
		$this->pagectrl = PageCtrl();
	}
	function __get($data)
	{
		return $this->bufferArray[$data];
	}	
	function __set($data,$value)
	{
		$this->bufferArray[$data] = $value;
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

ResClass::$defaultResponse = new ResClass();
function Res($name=NULL)
{
	return Req($name);
	if($name==NULL)
		return ReqClass::$defaultRequest;
	return ReqClass::$defaultRequest->__get($name);
/*	
	if($name==NULL)
		return ResClass::$defaultResponse;
	return ResClass::$defaultResponse->__get($name);*/
}




