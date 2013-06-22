<?
class Def{
	private static $_cache = array();
	public static function G($classname){
		if(self::$_cache[$classname]==NULL){
			self::$_cache[$classname] = new $classname();
			//echo "$classname";
			//vardump(self::$_cache[$classname]);
		}
		return self::$_cache[$classname];
	}
}
function Def($classname){
	return Def::G($classname);
}

