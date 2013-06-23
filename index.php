<?
$url = "cfrontend/login.php";
header("Location: $url");
echo "<meta http-equiv='refresh' content='0;url=$url'>";
exit();
ob_start();

define('ROOT_PATH',dirname(__FILE__));

chdir("app_hexa/_internalapp");

require_once("../../framework/conf/classpath.php");
require_once("../../framework/core/def.class.php");

Joay_Controller::Plug("executetime");
Joay_Controller::Plug("gzcompress");

require_once("../../framework/core/common.inc.php");

Joay_Controller::Process_Route_Start();

$act = Req(act);
$todo = Req(todo);
$i = Req(i);


$config_path = Config_GetClassPath("Joay_Action_{$act}");
if($config_path!=NULL){
	
	$classname = "Joay_Action_{$act}";
	$actionclass = new $classname();
	//$classname::$DEF = $actionclass;
	Joay_Controller::SetCurrentAction($actionclass);
	Joay_Controller::Process_Loop();
}elseif(file_exists("../../{$act}/{$todo}.php")){
	chdir("../../tmp");
	include_once "../{$act}/{$todo}.php";
	if(class_exists("Joay_Action_{$act}")){
		$classname = "Joay_Action_{$act}";
		$actionclass = new $classname();
		//$classname::$DEF = $actionclass;
		Joay_Controller::SetCurrentAction($actionclass);
		Joay_Controller::Process_Loop();
	}else{

	}
	//patch rewrite
	$html = ob_get_clean();
	$html = str_replace("../", "", $html);
	//$html = str_replace("../cfrontend", "cfrontend", $html);
	
	
	echo $html;
}else{
	echo "/* No action ".Req(act)." */";
}
Joay_Controller::Process_Route_End();

