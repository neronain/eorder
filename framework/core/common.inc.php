<?
ob_start();
ob_implicit_flush(false);

umask(0);

if (!defined('PHP_VERSION_ID')) {
    $version = explode('.', PHP_VERSION);
    define('PHP_VERSION_ID', ($version[0] * 10000 + $version[1] * 100 + $version[2]));
}

define('ROOT',$ROOT_PATH);

require_once('../../framework/core/conf.class.php');
require_once('../../framework/conf/classpath.php');
require_once('../../framework/conf/config.def.php');

@include_once "../../framework/conf/config.cus.php";


if(!$DISABLE_SESSION){

	
	
	if (session_id() == "") session_start();

	header("Cache-control: private");
	header("Content-Type: text/html; charset=UTF-8");	
}
define("IN_SITE", "TRUE");



require_once('../../framework/core/csql.php');
require_once('../../framework/core/req.class.php');
require_once('../../framework/core/pagecontrol.class.php');
require_once('../../framework/core/saveds.class.php');


function FlushContent($msg=''){ 
	echo $msg;
	while (ob_get_contents()) {
		ob_end_flush();
		ob_flush();
		flush();
	}
	ob_start();
}




