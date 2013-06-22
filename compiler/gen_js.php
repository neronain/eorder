<?
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');
chdir("../tmp/chdir");
include_once "../../framework/core/common.inc.php";
require_once('../../lib/php-gettext/gettext.inc');

$sourceDirAr = array("../../resources/js");
$targetDummyPath = "../../app_hexa/langjs";
$exception = array();

$convertList = array();
$languageList = array("en_US"=>array("fusionhq"=>NULL));

foreach($sourceDirAr as $dir){
	
	$dir_handle = @opendir($dir) or die("Unable to open $dir");
	
	while ($file = readdir($dir_handle)) {
		if(in_array($file,$exception)){
			continue;
		}
		if(is_file($dir."/".$file)){
			$search_result = preg_match("/(.+)\.js_lang\.php/", $file, $matches);
			
			if($search_result!=FALSE){
				$targetPath = $targetDummyPath."/".preg_replace('/^\.\.\/\.\.\//','',$dir)."/".$file;
				if(!file_exists(dirname($targetPath))){
					mkdir(dirname($targetPath),0755,true);
				}
				
				copy($dir."/".$file, $targetPath);
				$convertList[] = $dir."/".$file;
			}
		}
		
	}

}

//Scan language
$dir = "../../locale";
$dir_handle = @opendir($dir) or die("Unable to open $dir");
while ($file = readdir($dir_handle)) {
	if(preg_match("/^\./",$file))continue;
	
	$dir_scanMO = @opendir($dir."/".$file."/LC_MESSAGES");
	while ($mofile = readdir($dir_scanMO)) {
		if(!preg_match('/\.mo$/',$mofile))continue;
		$languageList[$file][preg_replace('/\.mo$/','',$mofile)] = $dir."/".$file."/LC_MESSAGES/".$mofile; 
	}	
}
//echo "<pre>";
//var_dump($convertList);
//var_dump($languageList);


foreach($languageList as $lang => $moList){
	foreach($moList as $textdomain => $mofile){
		
		_bindtextdomain($textdomain, '../../locale/');
		_bind_textdomain_codeset($textdomain, 'UTF-8');
		_textdomain($textdomain);
		
	
		_setlocale(LC_MESSAGES, $lang);
		_setlocale(LC_TIME, $lang);
		
		foreach($convertList as $jsLangfile){
			ob_start();
			include $jsLangfile;//"../resources/js/fhq.dialog.js_lang.php";
			$data = ob_get_clean();
			$filename = preg_replace("/\.js_lang\.php$/","_".$lang."_".$textdomain.".js",$jsLangfile);
			file_put_contents($filename, $data);
		}
	}
}	
		
		
/*
ob_start();
include "../resources/js/fhq.dialog.js_lang.php";
$data = ob_get_clean();
$filename = "../resources/js/fhq.dialog.".$lang."_".$textdomain.".js";
file_put_contents($filename, $data);
//*/

