<?
define(SHAREDMEM_IGNORE_RELOAD_SEC,2);


define(KSHAREDMEM_TABLEUPDATE,5);

class SharedMem {

	// compile php by edit
	// vi /var/cpanel/easy/apache/rawopts/all_php5
	// add --enable-shmop
	
	static $SIZERESERVE = array(KSHAREDMEM_TABLEUPDATE=>2048);
	static $_cache = array();
	
	public static function GetAr($ksharedmem) {
		if(extension_loaded('shmop')){
			$shm_id = @shmop_open($ksharedmem, "a", 0644, self::$SIZERESERVE[$ksharedmem]);
			if($shm_id==false){
				return array();
			}
			$shm_size = shmop_size($shm_id);
			$datastring = shmop_read($shm_id, 0, $shm_size);
			$dateObj = unserialize($datastring);
			shmop_close($shm_id);
		}else{
			$dateObj = self::$_cache[$ksharedmem][1];
			if($dateObj==NULL){
				return array();
			}
		}
		 
		return $dateObj;
	}
	
	public static function Get($ksharedmem,$softkey) {
		
		if(self::$_cache[$ksharedmem]!==NULL){
			if(mktime()-self::$_cache[$ksharedmem][0]<SHAREDMEM_IGNORE_RELOAD_SEC){
				return self::$_cache[$ksharedmem][1][$softkey];
			}
			//echo "expire {$softkey} XXXXXXXX;".self::$_cache[$ksharedmem][$softkey][0];
		}
		
		if(extension_loaded('shmop')){
			$shm_id = @shmop_open($ksharedmem, "a", 0644, self::$SIZERESERVE[$ksharedmem]);
			if($shm_id==false){
				return NULL;
			}
			$shm_size = shmop_size($shm_id);
			$datastring = shmop_read($shm_id, 0, $shm_size);
			$dateObj = unserialize($datastring);
			shmop_close($shm_id); 

			self::$_cache[$ksharedmem][0] = mktime();
			self::$_cache[$ksharedmem][1] = $dateObj;		
			
			//echo "reload {$softkey} ;";
			//Inc_Debug::Dump($dateObj);
			//Inc_Debug::PrintStack();
		}else{
			return self::$_cache[$ksharedmem][1][$softkey];
		}
		
		
		return $dateObj[$softkey];
	}
	
	public static function Set($ksharedmem,$softkey,$value) {
		
		if(extension_loaded('shmop')){
			$shm_id = shmop_open($ksharedmem, "c", 0644, self::$SIZERESERVE[$ksharedmem]);
			$shm_size = shmop_size($shm_id);
			$datastring = shmop_read($shm_id, 0, $shm_size);
			$dateObj = unserialize($datastring);
			if($dateObj==NULL){
				$dateObj = array();	
			}
		}else{
			$dateObj = self::$_cache[$ksharedmem][1];
		}
		//if(!is_string($softkey)){
		//	Inc_Debug::PrintStack();	
		//}
		//Inc_Debug::Dump($softkey);
		//Inc_Debug::Dump($dateObj);
		
		$dateObj[$softkey] = $value;
		
		if(extension_loaded('shmop')){
			$datastring = serialize($dateObj);
			shmop_write($shm_id, $datastring,0);
			shmop_close($shm_id);
		}
		
		
		
		self::$_cache[$ksharedmem][0] = mktime();
		self::$_cache[$ksharedmem][1] = $dateObj;
		
		//echo "set  [{$softkey}]  XXXXXXXX;".self::$_cache[$ksharedmem][$softkey][0];
	}
	
}

