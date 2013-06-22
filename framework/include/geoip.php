<?php
define(GEOIP_DATAPATH,"../../lib/geoip/GeoIP-106_20120717.dat");

class Inc_GeoIP{
	private static function INIT(){
		include_once("../../lib/geoip/geoip.inc");
		include_once("../../lib/geoip/geoipcity.inc");
		include_once("../../lib/geoip/geoipregionvars.php");
		$gi = geoip_open(GEOIP_DATAPATH,GEOIP_STANDARD);
		return $gi;
	}
	
	public static function GetCountry($ip=NULL){
		$gi = self::INIT();
		
		if($ip==NULL){
			$ip =  $_SERVER['REMOTE_ADDR'];
		}
		
		$country =  geoip_country_code_by_addr($gi, $ip);
		
		return $country;
	}
	public static function GetProvince($ip=NULL){
		$gi = self::INIT();
		
		if($ip==NULL){
			$ip =  $_SERVER['REMOTE_ADDR'];
		}
	
		$record = geoip_record_by_addr($gi,$ip);
	
		return $record->city;
	}	

	
	
}