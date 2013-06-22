<?
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');
function Rewrite_classpath($path,$exception=NULL){
	$dir_handle = @opendir($path) or die("Unable to open $path");
	if($exception==NULL){
		$exception=array();
	}
	
	$outputdir = $path;
	if(!file_exists($outputdir)){
		mkdir($outputdir);
	}
	
	$countf = 0;
	while ($file = readdir($dir_handle)) 
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
		if($class[count($class)-1]!="php")continue;
		
		$code = file_get_contents($path."/".$file);
		
		$code = str_replace("\r\n","\n",$code);
		
		preg_match_all('/.*(function)[\t ]+(.+?)\((.*)\)/i', $code, $matches);
		for($i=0;$i<count($matches[0]);$i++){	
		}

		//$fw = file_put_contents("../include/".$file,$restrict.$rwcode);
	}
	closedir($dir_handle);
}
$except = array();//"common.inc.php","func.inc.php","config.inc.php","csql.php","unittest.inc.php","wordpress.inc.php","ziputil.inc.php");
Rewrite_classpath("../tmp/include_src",$except);


