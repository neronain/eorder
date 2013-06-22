<?php

class Inc_PostTrack{
	public static function Assemble($prefix,$code,$suffix){
		$checksum_key = "86423597";
		$checksum = NULL;
		
		$totalsum = 0;
		for($i=0;$i<strlen($code);$i++){
			$char1 =  $code[$i];
			$char2 =  $checksum_key[$i];
			$totalsum += $char1*$char2;
		}
		$mod_value = $totalsum%11;
		switch($mod_value){
			case 0;	$checksum = 5;break;
			case 1;	$checksum = 0;break;
			default;$checksum = 11-$mod_value;break;
		}
		return $prefix.$code.$checksum.$suffix;
	}
}