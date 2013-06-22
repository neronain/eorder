<?
class ConfClass
{
	public static /*@ConfClass*/$defaultConfig;
	public /*@array*/$bufferArray = array();

	function /*@ANY*/__get(/*@string*/$data)
	{
		return $this->bufferArray[$data];
	}	
	function /*@VOID*/__set(/*@string*/$data,/*@ANY*/$value)
	{
		$this->bufferArray[$data] = $value;
	}
	function /*@bool*/__isset(/*@string*/$data)
	{
		return isset($this->bufferArray[$data]);
	}
	
}

ConfClass::$defaultConfig = new ConfClass();

function /*@ConfClass*/Conf(/*@string*/$data=NULL,/*@ANY*/$value=NULL)
{
	if($data==NULL)
		return ConfClass::$defaultConfig;
	if($value==NULL)
		return ConfClass::$defaultConfig->__get($data);
	return ConfClass::$defaultConfig->__set($data,$value);
}




