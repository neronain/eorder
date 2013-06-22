<?php
if($_GET['test']){
	require_once "../_include/ab_threadcompatible.php";
}
class cron_virtualsubscription extends AB_TheardStandard{

	public function InitThread(){

		ModelObjectCaching::$disable_caching[] = 'MD_UserDental';
	}
	public function GetThreadName(){
		return "";
	}
	public function GetThreadOption(){
		return "";
	}
	public function GetIteratureLimit(){
		return 10;
	}
	public function GetObjectClass(){
		return MD_CronSubscription;
	}
	public function GetArrayClass(){
		return MD_CronSubscriptionArray;
	}
	public function Iterature(ModelObject $obj){
		SaveDS()->Clear();
		Inc_Log::debug("[Cron virtualsubscription]  " . ($obj->subscriptionid) . " \n");
		Inc_Log::log("[Cron virtualsubscription]  " . ($obj->subscriptionid) . " \n");

		
		
		return 'PENDING';
	}

	public function GetMessage(){
		return "";
	}
}

if($_GET['test']){
	$cron = new cron_virtualsubscription();
	$cron->Test();
}
//test add cronjob << run once
//http://localhost/xxx/test/cron.php

//testing cron
//http://localhost/xxx/control/sys_cron.php



