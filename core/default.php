<? ob_start();  
// OUT
//echo"yyy1";
	date_default_timezone_set ('Asia/Bangkok');
	$includeConditionFail = "../cfrontend/login.php";

// Condition	
	include_once("../core/funccom.php");

	GetSession($userdentalid,"userdentalid");
	GetSession($usertype,"usertype");
	GetSession($userstfid,"userstfid");
	GetSession($usersecid,"usersecid");
	
	
	if(!isset($SKIPPERMISSION) && !isset($usertype)){
		$param = 'DN';
		include($includeConditionFail);
		exit();
	}//*/
	

	
//echo"yyy2";
	
// Start code
	include_once("../core/languageselect.php");
 	include_once("../core/config.php");
	include_once("../core/csql.php");
	include_once("../core/msql.php");
 	include_once("../core/funccom.php");
 	include_once("../core/funchtml.php");
	include_once("../core/funccalc.php");
	include_once("../core/functooth.php");
	include_once("../core/teeth.php");		
//	$data = new CSql();
// 	$err =	$data->Connect();
//echo"yyy3";

	define("WEBSITE_HEADER","Hexa ceram e-order engine");
		

	header('Content-Type: text/html; charset=utf-8');

?>
