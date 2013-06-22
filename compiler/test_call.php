Don't forgot to clear ,([ \r\n\t]*\)) => $1<br/><?
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');
ob_start();
global $globalcode;
$DISABLE_SESSION = true;

$globalcode = "";
function find_calling($path,$exception=NULL){
	global $globalcode;
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
				find_calling($path."/".$file);
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
		$arrayStr = "array[ \t\r\n]*\([ \t\r\n]*(['\"][\w]+['\"]=>.+?,?[ \r\n\t]*)*\)";
		preg_match_all('/Def\((Joay_Action_[\w]*)\)->(URL|HIDDEN|CALL)_([\w]*)\([ \t\r\n]*('.$arrayStr.')?[ \t\r\n]*\)/si', $code, $matches);
		for($i=0;$i<count($matches[0]);$i++){	
			$cname = $matches[1][$i];
			$fname = $matches[2][$i];
			
			$globalcode .= "/*".$pathstr."/".$file."*/ ";
			$globalcode .= $matches[0][$i].";\n";
			//echo "x".$matches[0][$i];
		}		
	}
	closedir($dir_handle);
	
}

$except = array("wizard","sample");//"common.inc.php","func.inc.php","config.inc.php","csql.php","unittest.inc.php","wordpress.inc.php","ziputil.inc.php");
find_calling("../app_hexa",$except);

file_put_contents("test_call_gen.php",'<? 
class testcall{
function a(){
'.$globalcode.'
}
}
$t = new testcall();
$t->a();

');

chdir("../tmp/chdir");

require_once("../../framework/conf/classpath.php");
require_once("../../framework/core/def.class.php");
require_once("../../framework/core/common.inc.php");

Conf()->global_current_member = new MD_UserDental();

include "test_call_gen.php";
echo "Test complete";
//echo "<pre>";
//echo htmlspecialchars($globalcode);
//echo "</pre>";

