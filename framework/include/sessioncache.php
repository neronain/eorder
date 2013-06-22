<?

class Inc_SessionCache{
	private static $session_cache = NULL;
	public static function Get($key){
		if($_SESSION['session_userdentalid']==NULL)return NULL;
		if(self::$session_cache==NULL){
			self::$session_cache = unserialize($_SESSION['session_cache']);
		}
		return unserialize(self::$session_cache[$key]);
	}
	public static function GetModelObject($classname,$id){
		global $DISABLE_SESSION;
		if($DISABLE_SESSION)return NULL;
		
		//return NULL;
		//Inc_Var::vardump("GetModelObject($classname,$id)");
		
		//Inc_Var::vardump($_SESSION['session_userdentalid']);
		//Inc_Var::vardump($_SESSION['session_cache']);
		
		if($id==NULL||$id==0)return NULL;
		if($_SESSION['session_userdentalid']==NULL)return NULL;
		if(self::$session_cache==NULL){
			self::$session_cache = unserialize($_SESSION['session_cache']);
		}
		if(self::$session_cache[$classname][$id]==NULL)return NULL;
		$obj = unserialize(self::$session_cache[$classname][$id]);
		if(!is_object($obj) || get_class($obj)!=$classname){
			unset(self::$session_cache[$classname][$id]);
			return NULL;
		}
		
		$obj->DecompressForCache();
		//Inc_Var::vardump($obj);
		return $obj;
	}	
	
	public static function Set($key,$value){
		if(is_a($value, ModelObject)){
			exit('Use SetModelObject instead');
		}
		if($session_cache==NULL){
			$session_cache = unserialize($_SESSION['session_cache']);
		}
		self::$session_cache[$key] =  serialize($value);
		
	}
	public static function SetModelObject($original){
		if($original==NULL)return;
		if(!is_a($original, ModelObject)){
			Inc_Var::vardump($original);
			debug_print_backtrace();
			exit('Use Set instead');
		}
		if($session_cache==NULL){
			$session_cache = unserialize($_SESSION['session_cache']);
		}		

		$classname = get_class($original);
		$id = $original->id;
		$value = $original->CompressForCache();
		self::$session_cache[$classname][$id] = serialize($value);
		
		//Inc_Var::vardump(self::$session_cache);
	}
	public static function UpdateModelObject($value){
		
		if(!is_a($value, ModelObject)){
			return;
		}
		if($session_cache==NULL){
			$session_cache = unserialize($_SESSION['session_cache']);
		}
		
		
		$classname = get_class($value);
		$id = $value->id;
		
		if(self::$session_cache[$classname][$id]==NULL)return;
		
		self::SetModelObject($value);
	}
	public static function Clean(){
		global $DISABLE_SESSION;
		if($DISABLE_SESSION)return;
		
		$_SESSION['session_cache'] = NULL;
		self::$session_cache = NULL;
		
		//Inc_Var::vardump("!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!");
		
	}	
	public static function Flush(){
		global $DISABLE_SESSION;
		if($DISABLE_SESSION)return;
		
		//Inc_Var::vardump($_SESSION['session_cache']);
		$serializeData = serialize(self::$session_cache);
		if($serializeData!=$_SESSION['session_cache']){
			$_SESSION['session_cache'] = $serializeData;
		}
		//Inc_Var::vardump($_SESSION['session_cache']);
		//Inc_Var::vardump($_SESSION);
		//Inc_Var::vardump($serializeData);
	}
}
