<?
//+INIT
if(!file_exists("local.txt"))exit("no unittest on real server, run in DEBUG server only\n");
//-INIT

function resetUnitcase(){
	$arrConf = Conf()->bufferArray;
	//Inc_Var::vardump($arrConf);
	foreach ($arrConf as $key => $value) {
		if (strpos($key,'UNITCASE')!==false){
			unset($arrConf[$key]);
		}
	}
	//Inc_Var::vardump($arrConf);
}
function encryptTestpayInput($inputArr){
	
	$process = $inputArr['process_id'];
	$processObj = MD_Process::BuildByID($process);
	$secretkey = $processObj->Get('secretkey');
	
	
	$inpute = '&m='.Inc_Secur::custombase_convert_big($inputArr['payment_plan'],'DEC','BASE62').
			 '&n='.Inc_Secur::custombase_convert_big($inputArr['node_end'],'DEC','BASE62').
			 '&p='.Inc_Secur::custombase_convert_big($inputArr['node_start'],'DEC','BASE62').
			 '&f='.$inputArr['split_test'].
			 '&s='.$inputArr['split'].
			 '&l='.$inputArr['link'];
							
	$encrypted_string= Inc_Secur::encrypt($inpute,$secretkey);
	//echo 'before:: '.$encrypted_string;
	$validate_code = substr(md5("PP".$encrypted_string.$secretkey),0,8);
	$encrypted_string= str_replace("/","%2F",$encrypted_string);
	//echo 'before:: '.$encrypted_string.'========='.$secretkey.'xxxxxxxxx';
	$code = "http://localhost/processpuppy/export/p{$process}/payment.php?e={$encrypted_string}&v={$validate_code}&process={$process}";
	return $code;
}


	
	
	
	
	
error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT);

$DISABLE_SESSION = true;
//require_once 'PHPUnit/Framework.php';
//require_once 'PHPUnit/Extensions/OutputTestCase.php';
$_SERVER['HTTP_HOST'] = 'localhost';
//chdir('../');
//include_once "../model/md_member.php";







require_once("../../framework/conf/classpath.php");
require_once("../../framework/core/def.class.php");
spl_autoload_register('__autoload');

require_once("../../framework/core/common.inc.php");
require_once("../../framework/conf/config.unit.php");

include_once "unitclass/unit_dummyrecord.php";
include_once "unitclass/unit_frameworktester.php";



///*

/*$path = "../model";
$dir_handle = @opendir($path) or die("Unable to open $path");
$countf = 0;
while ($file = readdir($dir_handle)) 
{
	if(substr($file,0,3)!='md_')continue;
	$class = explode(".",$file);
	if($class[count($class)-1]!="php")continue;

	if(substr($file,strlen($file)-8,8)=='_ext.php')continue;
	if($class[0]=='md_tool_link')continue;

	$classarray[] = $class[0];
}	

require_once '../include/common.inc.php';*/
__autoload(Joay_Controller);
__autoload(unittest);


Joay_Controller::Plug("unittest");


Conf()->UNITTEST_dbresetfile = "../../compiler/unittest/phpunit_reset_db.sql";
Conf()->UNITTEST_dbrecordfile =  "../../compiler/unittest/phpunit_record_db.sql";

function UNITEST_clearDB(){
	if(is_resource(Conf()->UNITTEST_dbresetfile_resource)){
		fclose(Conf()->UNITTEST_dbresetfile_resource);
	}
	if(file_exists(Conf()->UNITTEST_dbresetfile)){
		$sql = file_get_contents(Conf()->UNITTEST_dbresetfile);
		$sqlAr = explode(";",$sql);
		foreach($sqlAr as $sql){
			Qry()->Execute($sql);
		}
		unlink(Conf()->UNITTEST_dbresetfile);
	}
	Unit_DummyRecord::$emaillist_index = 0;
}
UNITEST_clearDB();

function UNITEST_recordSql($sql){
	if(!is_resource(Conf()->UNITTEST_dbrecordfile_resource)){
		Conf()->UNITTEST_dbrecordfile_resource = fopen(Conf()->UNITTEST_dbrecordfile,"a+");
	}


	fputs(Conf()->UNITTEST_dbrecordfile_resource,$sql.";",strlen($sql)+1);
	fflush(Conf()->UNITTEST_dbrecordfile_resource);
}
function UNITEST_quereSql($sql){
	if(!is_resource(Conf()->UNITTEST_dbresetfile_resource)){
		Conf()->UNITTEST_dbresetfile_resource = fopen(Conf()->UNITTEST_dbresetfile,"a+");
	}
	

	fputs(Conf()->UNITTEST_dbresetfile_resource,$sql.";",strlen($sql)+1);
	fflush(Conf()->UNITTEST_dbresetfile_resource);
}
/*
foreach($classarray as $class){
	include_once "../model/".$class.".php";
}*/

//*/





Conf()->UNITTEST = TRUE;

//chdir($INIT_DIR);
//Inc_Debug::PrintStack();
	
	
	
	
	
	
