<?
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');
set_time_limit(0);


//var_dump($permissionAr);
$classpath = array();
$classpathdebug = array();
//$wz_collector = array();
function Rewrite_classpath($path,$exception=NULL){
	global $classpath,$classpathdebug,$classfunc,$wz_collector;
	$dir_handle = @opendir($path) or die("Unable to open $path");
	if($exception==NULL){
		$exception=array();
	}
	
	$outputdir = $path;
	if(!file_exists($outputdir)){
		mkdir($outputdir);
	}
	
	$countf = 0;
	$sort_dir = array();
	while ($file = readdir($dir_handle)) 
	{
		$sort_dir[] = $file;
	}
	sort($sort_dir); 
	//while ($file = readdir($dir_handle))
	foreach($sort_dir as $file) 
	{
		if(is_dir($path."/".$file)){
			if(!in_array($file,$exception) && $file !="." && $file !=".." && $file != ".svn"){
				Rewrite_classpath($path."/".$file);
			}
			continue;
		}
		if(in_array($file,$exception)){
			continue;
		}

		$class = explode(".",$file);
		if($class[count($class)-1]!="php" && $class[count($class)-1]!="phps"){
			
			continue;
		}
		//echo $path."/".$file."<br>";
		
		$code = file_get_contents($path."/".$file);
		
		$code = str_replace("\r\n","\n",$code);
		
		
		/*preg_match_all('/\([\'"](wz_.+?)[\'"][\),]/i', $code, $matches);
		for($i=0;$i<count($matches[0]);$i++){
			$wzname = $matches[1][$i];
			$wz_collector[$wzname]++;

		}*/		
		
		$isGenerateTodo = true;
		preg_match_all('/\n[ \t]*(abstract [ ]*)?class [ ]*([\w\d_]+)/i', $code, $matches);
		for($i=0;$i<count($matches[0]);$i++){	
			$classname = $matches[2][$i];
			$preclassname = strtolower(substr($classname,0,4));
			//if(preg_match("/.Graph$/",$classname))continue;
			//if(preg_match("/.Array$/",$classname))continue;
			if($classpath[$preclassname][$classname]!=NULL && $classpath[$preclassname][$classname] != "../".$path."/".$file){
				if(preg_match("/\.(\w\w)\.php$/",$file,$match)){
					if(is_string($classpath[$preclassname][$classname])){
						$oldpath = $classpath[$preclassname][$classname];
						preg_match("/\.(\w\w)\.php$/",$oldpath,$oldmatch);
						$oldlang = strtoupper($oldmatch[1]);
						$classpath[$preclassname][$classname] = array();
						$classpath[$preclassname][$classname][$oldlang] = $oldpath;
						
						$classpathdebug[$classname] = array();
						$classpathdebug[$classname][$oldlang] = $oldpath;
						
					}
					$classpath[$preclassname][$classname][strtoupper($match[1])] = "../".$path."/".$file;
					$classpathdebug[$classname][strtoupper($match[1])] = "../".$path."/".$file;
					echo "LG FIle $file";	
				}else{
					$oldpath = $classpath[$preclassname][$classname];
					$newpath = "../".$path."/".$file;
					if(preg_match("/^compiled_/",basename($oldpath),$match)){
						$classpath[$preclassname][$classname] = $oldpath;
						$classpathdebug[$classname] = $newpath;
					}elseif(preg_match("/^compiled_/",basename($newpath),$match)){
						$classpath[$preclassname][$classname] = $newpath;
						$classpathdebug[$classname] = $oldpath;
						$isGenerateTodo = false;
					}else{
						echo "<span style=\"color:#FF0000\">Conflict ".$matches[1][$i]." ".$classpath[$preclassname][$classname]." vs ".$path."/".$file."</span><br>";
					}
				}	
			}else{
				$classpath[$preclassname][$classname] = "../".$path."/".$file;
				$classpathdebug[$classname] = "../".$path."/".$file;
			}
			
/*			if(strpos($classname,'Dialog_')===0){
				include_once("../framework/core/dialog.class.php");
				include_once("../framework/core/page.class.php");
				include_once("../framework/core/listpage.class.php");
				include_once("../framework/core/".$classpath[$preclassname][$classname]);
			}*/
		}
		preg_match_all('/\n[ \t]*interface [ ]*([\w\d_]+)/i', $code, $matches);
		for($i=0;$i<count($matches[0]);$i++){
			$classname = $matches[1][$i];
			$preclassname = strtolower(substr($classname,0,4));
			//if(preg_match("/.Graph$/",$classname))continue;
			//if(preg_match("/.Array$/",$classname))continue;
			if($classpath[$preclassname][$classname]!=NULL && $classpath[$preclassname][$classname] != "../".$path."/".$file){
				$oldpath = $classpath[$preclassname][$classname];
				$newpath = "../".$path."/".$file;
				if(preg_match("/^compiled_/",basename($oldpath),$match)){
					$classpath[$preclassname][$classname] = $oldpath;
					$classpathdebug[$classname] = $newpath;
				}elseif(preg_match("/^compiled_/",basename($newpath),$match)){
					$classpath[$preclassname][$classname] = $newpath;
					$classpathdebug[$classname] = $oldpath;
					$isGenerateTodo = false;
				}else{
					echo "<span style=\"color:#FF0000\">Conflict ".$matches[1][$i]." ".$classpath[$preclassname][$classname]." vs ".$path."/".$file."</span><br>";
				}
			}
			$classpath[$preclassname][$classname] = "../".$path."/".$file;
			$classpathdebug[$classname] = "../".$path."/".$file;
		
			/*			if(strpos($classname,'Dialog_')===0){
			 include_once("../framework/core/dialog.class.php");
			include_once("../framework/core/page.class.php");
			include_once("../framework/core/listpage.class.php");
			include_once("../framework/core/".$classpath[$preclassname][$classname]);
			}*/
		}		
		
		
		
		preg_match_all('/Def\((Joay_Action_.+?)\)->URL_(.+?)\(/i', $code, $matches);
		for($i=0;$i<count($matches[0]);$i++){	
			$cname = $matches[1][$i];
			$fname = $matches[2][$i];
			$classfunc[$cname][$fname][REF] += 1;
		}		
		
		if($isGenerateTodo)
		if(preg_match("/^Joay_Action_/",$classname)){
			preg_match_all('/function (\/\*.+?\*\/)?todo_(.*?)\((.*?)\)[\n\t ]*{/s', $code, $matches);
			for($i=0;$i<count($matches[0]);$i++){
				//echo $classname."/".$matches[2][$i]." > ". $matches[3][$i]."<br>";
				$funcname = $matches[2][$i];
				$param = $matches[3][$i];
				
				$actionname = str_replace("Joay_Action_", "", $classname);
				
				//if($permissionAr[$actionname][$funcname]===NULL){
				//	echo "<span style=\"color:#FF0000\">\$perm['".$actionname."']['".$funcname."']  = NULL;  </span><br>";
				//}
				
				$classfunc[$classname][$funcname][PARAMETER] = array();
				$tmpCheckExist = array();				
				preg_match_all('/\$([\w\d_]+)[ ]*(=["\' ]*(.*?)["\' ]*)?[\n\t ]*(,|$)/', $param, $matchesAr);
				for($j=0;$j<count($matchesAr[0]);$j++){
					if($tmpCheckExist[$matchesAr[1][$j]]){
						exit("!!!!Existing parameter ".$matchesAr[1][$j]." in $classname $funcname");
					}
					$tmpCheckExist[$matchesAr[1][$j]] = true;
					if($matchesAr[2][$j]==''){
						$classfunc[$classname][$funcname][PARAMETER][$matchesAr[1][$j]] = NULL;
					}elseif($matchesAr[2][$j]=='array()'){
						$classfunc[$classname][$funcname][PARAMETER][$matchesAr[1][$j]] = array();
					}else{
						$classfunc[$classname][$funcname][PARAMETER][$matchesAr[1][$j]] = $matchesAr[3][$j];
					}
				}
			}
		}
		
		$checkercode = $code;
		$checkercode = preg_replace("/function BeforeAction.+?function/s","function",$checkercode);
		
		if(preg_match("/app_hexa/",$path) && (!preg_match("/app_hexa\/_plugin/",$path))){
			
			if(preg_match('/Req\(.*;/', $checkercode, $matches)){
				echo "using Req() not allow in <b>{$classname}</b> {$path}/{$file} <span style=\"font-size:0.7em\">".$matches[0]."</span><br/>";	
			}
			if(preg_match('/SetBySendingParam\(.*;/', $checkercode, $matches)){
				echo "using SetBySendingParam() not allow in <b>{$classname}</b> {$path}/{$file} <span style=\"font-size:0.7em\">".$matches[0]."</span><br/>";	
			}
			if(preg_match('/[^\\\]\$_(GET|POST).*(;|\?)/', $code, $matches)){
				echo "using ".$matches[1]." not allow in <b>{$classname}</b> {$path}/{$file} <span style=\"font-size:0.7em\">".$matches[0]."</span><br/>";	
			}
			if(preg_match('/SetBySendingParam/', $code, $matches)){
				echo "using ".$matches[0]." not allow in <b>{$classname}</b> {$path}/{$file} <span style=\"font-size:0.7em\">".$matches[0]."</span><br/>";	
			}
			if(preg_match('/json_encode/', $code, $matches)){
				echo "using ".$matches[0]." not allow in <b>{$classname}</b> {$path}/{$file} <span style=\"font-size:0.7em\">".$matches[0]."</span><br/>";	
			}
		}
		/*if(preg_match("/app_hexa/",$path) && (!preg_match("/^md_/",$file)) && (!preg_match("/^_ac/",$file)) && (!preg_match("/^ab/",$file))){
				if(preg_match('/\$id/', $code, $matches)){
					echo "using ".$matches[0]." \$id is might not defined in <b>{$classname}</b> {$path}/{$file} <span style=\"font-size:0.7em\">".$matches[0]."</span><br/>";	
				}
		}*/
		//$fw = file_put_contents("../include/".$file,$restrict.$rwcode);
	}
	closedir($dir_handle);
	
}
echo "<p style=\"font-size:10px\">";
$except = array();//"common.inc.php","func.inc.php","config.inc.php","csql.php","unittest.inc.php","wordpress.inc.php","ziputil.inc.php");
//Rewrite_classpath("../model",$except);
Rewrite_classpath("../framework",$except);
Rewrite_classpath("../app_hexa",$except);



if(!is_dir("../framework/conf/pathcache")){
	mkdir("../framework/conf/pathcache");
}
$global_classpath = array();
foreach($classpath as $pre=>$cp){
	$global_classpath = array_merge($global_classpath,$cp);
	$export = "<?\n \$classpath = ";
	$export .= var_export($cp,true).";";
	$fw = file_put_contents("../framework/conf/pathcache/classpath.".$pre.".php",$export);
}

$export = "<?\n \$classpath = ";
$export .= var_export($classpathdebug,true).";";
$fw = file_put_contents("../framework/conf/classpath.gen.php",$export);


$export = "<?\n \$classfunc = ";
$export .= var_export($classfunc,true).";";
$fw = file_put_contents("../framework/conf/classfunc.gen.php",$export);

/*
$export = "";
foreach($wz_collector as $wzname => $count){
	$export .= "$wzname\r\n";
}
$fw = file_put_contents("../tmp/wz_export.txt",$export);
*/
echo "<pre>";
//var_dump($classfunc);
echo "</pre>";
echo "Done";
echo "</p>";