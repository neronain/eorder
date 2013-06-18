<?
	function gotourl($url){
		//header('Location:'.$url) ;
		echo "<meta http-equiv='refresh' content='0;url=$url'>";
	}
	function stringToHex ($s) {
		$r = "0x";
		$hexes = array ("0","1","2","3","4","5","6","7","8","9","a","b","c","d","e","f");
		for ($i=0; $i<strlen($s); $i++) {
			$r .= ($hexes [(ord($s{$i}) >> 4)] . $hexes [(ord($s{$i}) & 0xf)]);
		}
		return $r;
	}
	
	function hexToString ($h) {
		$r = "";
		for ($i= (substr($h, 0, 2)=="0x")?2:0; $i<strlen($h); $i+=2) {
			$r .= chr (base_convert (substr ($h, $i, 2), 16, 10));
		}
		return $r;
	}
	function convertToString($array){
		$tmp="";
		foreach($array as $a){
			$tmp.="$a,";
		}
		return substr($tmp,0,strlen($tmp)-1);
	}
	function convertToArray($string){
		return split(",",$string);
	}
	function reduceName($string){
		$temp = $string;
		$temp = str_replace("คลินิก","ค.",$temp);
		$temp = str_replace("คลินิค","ค.",$temp);
		$temp = str_replace("คลีนิก","ค.",$temp);
		$temp = str_replace("คลีนิค","ค.",$temp);
		$temp = str_replace("โรงพยาบาล","รพ.",$temp);
		$temp = str_replace("บริษัท","บ.",$temp);
		$temp = str_replace("จำกัด","จก.",$temp);
		$temp = str_replace("ทันตแพทย์","ทพ.",$temp);
		
		return $temp;
	}
	
	function GetVar(&$varobj,$varname) // getVar($x,"x");
	{
		//mysql_real_escape_string();
		global $_GET;
		global $_POST;
		if(isset($varobj))	return;
		if(isset($_GET[$varname]))
		{
			$varobj = $_GET[$varname];
		}
		else if(isset($_POST[$varname]))
		{
			$varobj = $_POST[$varname];
		}
		if(!isset($varobj)){
			$varobj=NULL;
		}
	}
	function GetSession(&$varobj,$varname) // getVar($x,"x");
	{
		//mysql_real_escape_string();
		global $_SESSION;
		global $_COOKIE;
		if(isset($varobj))	return;
		if(isset($_SESSION[$varname]))
		{
			$varobj = $_SESSION[$varname];
		}
		else if(isset($_COOKIE[$varname]))
		{
			$_SESSION[$varname] =  $_COOKIE[$varname];
			$varobj = $_SESSION[$varname];
		}
		if(!isset($varobj)){
			$varobj=NULL;
		}
	}	
	function utf8_to_tis620($string) {
	  $str = $string;
	  $res = "";
	  for ($i = 0; $i < strlen($str); $i++) {
		if (ord($str[$i]) == 224) {
		  $unicode = ord($str[$i+2]) & 0x3F;
		  $unicode |= (ord($str[$i+1]) & 0x3F) << 6;
		  $unicode |= (ord($str[$i]) & 0x0F) << 12;
		  $res .= chr($unicode-0x0E00+0xA0);
		  $i += 2;
		} else {
		  $res .= $str[$i];
		}
	  }
	  return $res;
	}	
	function tis620_to_utf8 ( $string ) {
	 for( $i=0 ; $i< strlen ( $string ) ; $i++ ){
	  $s = substr ( $string, $i, 1);
	  $val = ord ( $s );
	  if ( $val < 0x80 ) {
	   $utf8 .= $s;
	  } elseif ( ( 0xA1 <= $val and $val <= 0xDA ) or ( 0xDF <= $val and $val <= 0xFB ) ){
	   $unicode = 0x0E00 + $val - 0xA0;
	   $utf8 .= chr ( 0xE0 | ($unicode >> 12) );
	   $utf8 .= chr ( 0x80 | ( ($unicode >> 6) & 0x3F) );
	   $utf8 .= chr ( 0x80 | ($unicode & 0x3F) );
	  }
	 }
	 return $utf8;
	}	
	
	

	function DateMysqlToISO8601($text){
		if($text=="")return "0000-00-00T00:00:00";
		//$datearray=explode("/",$text);
		$dt = substr($text,0,10);
		return $dt."T00:00:00";
	}	
	function DateMysqlToPHP($text){
		$text = str_replace(" ","-",$text);
		$text = str_replace(":","-",$text);
		$datearray=explode("-",$text);
		//var_dump($datearray);
		return mktime($datearray[3]+0,$datearray[4]+0,$datearray[5]+0,$datearray[1]+0,$datearray[2]+0,$datearray[0]+0);
	}
	function DatePHPToMysql($phpdate){
		$day = date('d',$phpdate);
		$month = date('m',$phpdate);
		$year = date('Y',$phpdate);
		$hr = date('H',$phpdate);
		$mn = date('i',$phpdate);
	
	
		return "{$year}-{$month}-{$day} {$hr}:{$mn}:00";
	}

	
	function DateMysql_GetDate($text){
		$datearray=explode(" ",$text);
		return $datearray[0];
	}
	function DateMysql_GetTime($text){
		$datearray=explode(" ",$text);
		return substr($datearray[1],0,5);
	}
	function DateMysql_GetTime12($text){
		return DateMysql_GetHour12($text).":".DateMysql_GetMinute($text).DateMysql_GetHourSplice($text);
	}
	
	function DateMysql_GetHour12($text){
		$datearray=explode(" ",$text);
		$datearray2=explode(":",$datearray[1]);
		return $datearray2[0]%12;
	}
	function DateMysql_GetHour24($text){
		$datearray=explode(" ",$text);
		$datearray2=explode(":",$datearray[1]);
		return $datearray2[0];
	}

	function DateMysql_GetMinute($text){
		$datearray=explode(" ",$text);
		$datearray2=explode(":",$datearray[1]);
		return $datearray2[1];
	}
	function DateMysql_NoSecond($text){
		return substr($text,0,16);
	}
	function DateMysql_NoSecond12($text){
		return DateMysql_GetDate($text)." ".DateMysql_GetTime12($text);
	}
	
	
	
?>