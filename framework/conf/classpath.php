<?
function Config_GetClassPath($classname){
	global $DEFAULT_LANGUAGE;
	$classname = preg_replace("/^(MD_.+?)Array$/i","$1",$classname);
	$preclassname = strtolower(substr($classname,0,4));
	
	if(preg_match('/:/',$preclassname)){
		var_dump($classname);
		Inc_Debug::PrintStack();
	}
	if($DEFAULT_LANGUAGE=='en' || $DEFAULT_LANGUAGE==''){
		include "classpath.gen.php";
	}else{
		include "pathcache/classpath.".$preclassname.".php";
	}
	//echo "---------- $classname {$classpath[$classname]} ----------";
	if(is_array($classpath[$classname])){
		global $DEFAULT_LANGUAGE;
		if($classpath[$classname][$DEFAULT_LANGUAGE]!=NULL){
			$classpath[$classname][$DEFAULT_LANGUAGE];
		}else{
			$classpath[$classname]['EN'];;
		}
	}
	return $classpath[$classname];
}
function Config_GetTodoArg($classname,$todo){
	include "classfunc.gen.php";
	//echo "---------- $classname {$todo} ----------";
	//Inc_Var::vardump($classfunc[$classname][$todo]);
	return $classfunc[$classname][$todo][PARAMETER];
}
//TODO: Rewrite
function prepath()
{
	$prepath = "";
	$cwdtext = getcwd();
	$cwdtext = str_replace("\\","/",$cwdtext);
	$cwd = explode("/",$cwdtext);
	//Inc_Var::vardump($cwd);
	if($cwd[count($cwd)-1]!='index' && $cwd[count($cwd)-1]!='model' && $cwd[count($cwd)-1]!='control' && $cwd[count($cwd)-1]!='log' && $cwd[count($cwd)-1]!='compiler' && $cwd[count($cwd)-1]!='resources'){
		$prepath = "../";
	}
	return $prepath;
}
function patchinc($path)
{
	include_once prepath().$path;
}

function __autoload($classname)
{
	$config_path = Config_GetClassPath($classname);
	if($config_path!=""){
		$cwdtext = getcwd();
		$cwdtext = str_replace("\\","/",$cwdtext);
		$cwd = explode("/",$cwdtext);
		if($cwd[count($cwd)-1]=='index' || $cwd[count($cwd)-1]=='model' || $cwd[count($cwd)-1]=='control' || $cwd[count($cwd)-1]=='log' || $cwd[count($cwd)-1]=='compiler' || $cwd[count($cwd)-1]=='resources'){
			$config_path = str_replace("../../","../",$config_path);
		}
		
		require_once $config_path;

		return $config_path;
	}	
}

