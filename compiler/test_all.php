<?php
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');
ob_start();
chdir("../tmp/chdir");
require_once("../../framework/conf/classpath.gen.php");
require_once("../../framework/conf/classpath.php");
require_once("../../framework/core/def.class.php");

require_once("../../framework/core/common.inc.php");

$start = $_GET['start']+0;
//$member1 = MD_UserDental::BuildByID(1);
$member2 = MD_UserDental::BuildByID(4);
$i = 0;
echo "Test all ".count($classpath)." class<br/>"; 
if($start>0){
	echo "Skip at 1 - ".($start-1)." <br/>";
}
ob_flush();
ob_start();
foreach($classpath as $class => $path){
	$i++;
	if($i<$start)continue;
	$skip = false;
	if(strpos($class,"Joay_Action")===0)$skip = true;
	if(strpos($class,"Abstract_")===0)$skip = true;
	if(strpos($class,"MD_")===0)$skip = true;
	if(strpos($class,"Repeater_")===0)$skip = true;
	if(strpos($path,"../../framework")===0)$skip = true;
	if(strpos($path,"../../lib")===0)$skip = true;
	if(strpos($path,"../../app_hexa/_")===0)$skip = true;
	if(strpos($path,"../../model")===0)$skip = true;
	if(strpos($path,"../../resource")===0)$skip = true;
	//if(strpos($path,"../../app_hexa/bulksites")===0)$skip = true;
	//if(strpos($path,"../../app_hexa/memsites")===0)$skip = true;
	if(strpos($path,"../../app_hexa/wizard")===0)$skip = true;
	if(strpos($path,"../../app_hexa/sample")===0)$skip = true;

	if($skip){
		echo "[&nbsp;&nbsp;&nbsp;] $i.) Skip $class @ $path <br/>";
		ob_flush();
		ob_start();
		continue;
	}
	
	$obj = new $class();
	
	if(!method_exists ($obj,"Test")){
		ob_end_clean();
		echo "[XXX] $i.) Class $class @ $path not have => public function Test(){ }<br/>";
		ob_start();
	}else{
		//Conf()->global_current_member = $member1;
		//$obj->Test();
		Conf()->global_current_member = $member2;
		$obj->Test();
		ob_end_clean();
		echo "[ / ] $i.) Class $class @ $path <br/>";
		ob_start();
	}
	
}
ob_end_clean();
