<?php
	//Conf()->AppConf_host 		= '192.168.1.4';
Conf()->AppConf_username 	= "root";
Conf()->AppConf_password 	= "qwertyuiop";

Conf()->AppConf_dbname = "dental_unit";


Csql::$DISABLE_PROXY = true;

Conf()->DISABLE_STAT_DISPLAY = false;

global $PROXY_TABLE_FORCE_USE_PROXY;
$PROXY_TABLE_FORCE_USE_PROXY = array('stat','mstat');
$PROXY_DIFF_SEC_IGNORE_PROXY = 2;

define(WKHTMLTOIMAGE,'C:\Program Files\wkhtmltopdf\wkhtmltoimage.exe');
//Conf()->DISABLE_LOCALFILESYNC = true;

//Conf()->AppConf_proxydbname 		= Conf()->AppConf_dbname;
//Conf()->AppConf_proxyhost 		= '__proxy__';
//Conf()->AppConf_proxyusername	= Conf()->AppConf_username;
//Conf()->AppConf_proxypassword 	= Conf()->AppConf_password;
//*/
