<?

class Inc_Debug{
			
	public static function PrintStack(){
		echo "<pre>";
		debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		echo "</pre>";		
	}
	public static function Dump($var){
		echo '<pre>';
		var_dump($var);
		echo '</pre>';
	}
}