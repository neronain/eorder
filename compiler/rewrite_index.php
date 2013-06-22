<?
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');

include "../../framework/core/common.inc.php";

$path = "../index";
$dir_handle = @opendir($path) or die("Unable to open $path");

$outputdir = $path."_output";
if(!file_exists($outputdir)){
	mkdir($outputdir);
}

$countf = 0;
while ($file = readdir($dir_handle)) 
{
	//if(substr($file,0,3)!='md_')continue;
	$class = explode(".",$file);
	if($class[count($class)-1]!="php")continue;
	
	$code = file_get_contents($path."/".$file);
	$classAR = array();
	//echo("----------- ".$file." ------------- <br/>\n");
	//echo substr($code,0,20);
	preg_match_all('/MD_([A-Za-z0-9]+)[ ]*(\:|\()/', $code, $matches);
	for($i=0;$i<count($matches[0]);$i++){	
		$c = $matches[1][$i];
		$c = str_replace("Array","",$c);
		$classAR[$c] = TRUE;
		
	}
	preg_match_all('/include_once[ "\'\(]*\.\.\/model\/md_(.+?);(\r\n)?/s', $code, $matches);
	for($i=0;$i<count($matches[0]);$i++){	
		//echo("-------------------------------------------------------------".$matches[0][$i]."<br/>");
		$code = str_replace($matches[0][$i],"",$code);
	}



	$addcode = "\r\n\r\n/*--------------------- START GENERATE CODE ---------------------*/\r\n/* INCLUDE MODEL */\r\n";
	foreach ($classAR as $c => $v) {
		$addcode .= "include_once '../model/md_".strtolower($c).".php';\r\n";
		//echo("".$c."<br/>");
	}
	$addcode .= "/* DEFINE VAR */\r\n";



	$addcode .= "/*--------------------- STOP GENERATE CODE ---------------------*/\r\n";
	//echo $addcode;
	
	$code = preg_replace("/\/\*\-* START GENERATE CODE.+STOP GENERATE CODE \-*\*\/\r\n/s","",$code);
	
	
	
	//$code = preg_replace("/switch\(\$todo\)/s","Joay_Controller::Process_Todo_Start($todo)\r\nswitch($todo)",$code);
	//$code = preg_replace("/(Joay_Controller::Process_Todo_Start\(\$todo\)\r\n)?switch\(\$todo\)/s","Joay_Controller::Process_Todo_Start($todo)\r\nswitch($todo)",$code);
	
	
	$startcode = strpos($code,"<?");
	$code = substr($code,0,$startcode+2).$addcode. substr($code,$startcode+2);
	if(count($classAR)>0){
		$fw = file_put_contents($outputdir."/".$file,$code);
	}
	
	//if($countf++>150)break;
}

closedir($dir_handle);




