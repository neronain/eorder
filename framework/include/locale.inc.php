<?php
class Inc_Locale{
	private static $isInitTextdomain=false;
	private static $currentLanguage='en_US';
	private static $currentTextdomain='hexa';
	
	
	public static function InitIfNeed($lang=NULL){
		global $DEFAULT_LANGUAGE;
		global $DEFAULT_TEXTDOMAIN;
		if($lang==NULL){
			$lang = $DEFAULT_LANGUAGE;
		}

		// Not init if language is in english
		if(!self::$isInitTextdomain && $lang!='en' && $lang!='EN' && $lang!='en_US'){
			self::$isInitTextdomain = true;
			_bindtextdomain($DEFAULT_TEXTDOMAIN, '../../locale/');
			_bind_textdomain_codeset($DEFAULT_TEXTDOMAIN, 'UTF-8');
			_textdomain($DEFAULT_TEXTDOMAIN);
			self::$currentTextdomain = $DEFAULT_TEXTDOMAIN;
			self::SetLang($lang);
			
		}
	}
	public static function GetLang(){
		return self::$currentLanguage;
	}
	public static function GetTextdomain(){
		return self::$currentTextdomain;
	}
	
	public static function SetLang($lang){
		if(!self::$isInitTextdomain){
			self::InitIfNeed($lang);
		}
		
		switch(strtoupper($lang)){
			case 'en':
			case 'EN':$lang = 'en_US';break;
			case 'DE':$lang = 'de_DE';break;
			case 'PL':$lang = 'pl_PL';break;
			case 'VN':$lang = 'vn_VN';break;
			case 'ZH':$lang = 'zh_CN';break;
		}
		
		if(self::$currentLanguage!=$lang){
			self::$currentLanguage=$lang;
			_setlocale(LC_MESSAGES, $lang);
			//_setlocale(LC_CTYPE, $lang);
			//_setlocale(LC_TIME, $lang);
		}
		
	}
	
	public static function GetCurrencyUnit($currency){
		$unitar = array(
				'USD'=>__('USD'),
				'GBP'=>__('Pound'),
				'EUR'=>__('Euro'),
				'CHF'=>__('Franc'),
				'CAD'=>__('CAD'),
				'AUD'=>__('AUD'),
				'SGD'=>__('SGD'),
				'NZD'=>__('NZD'),
				'JPY'=>__('Yen'),
				'CNY'=>__('Yuan'),
				'HKD'=>__('HKD'),
				'BRL'=>__('Real'),
				'TRY'=>__('Lira'),
				'ANG'=>__('Guilder'),
				'KRW'=>__('Won'),
				'MXN'=>__('Peso'),
				'CZK'=>__('Koruna'),
				'VND'=>__('Dong'),
				'PLN'=>__('Zloty'),
				'MYR'=>__('Ringgit'),
				'AED'=>__('Dirham'),
				'ILS'=>__('Shekel'),
				'THB'=>__('Baht'),
				'TWD'=>__('TWD'),
				'RUB'=>__('Rouble'),
				'PHP'=>__('Peso'),
				'INR'=>__('Rupee'),
				'DKK'=>__('Krone'),
				'NOK'=>__('Krone'),
				'SEK'=>__('Krona'),
				'ZAR'=>__('Rand'),
				'RSD'=>__('Dinar'),
				'IDR'=>__('Rupiah'),
		);
		
		/*
USD = US Dollar
GBP = Pound
EUR = Euro
CHF = Swiss Francs
CAD =Canadian Dollar
AUD = Australian Dollar
SGD = Singaporean Dollar
NZD = New Zealand Dollar

JPY = Yen
CNY = Yuan
HKD = HongKong Dollar
BRL = Brazilian Real
TRY = New Turkish Lira
ANG =Guilder
KRW =Korean Won
MXN = Mexican Peso
CZK = Czech Koruna
VND = Dong
PLN = Polish New Zloty
MYR = Malaysian Ringgit
AED = Dirham 
ILS = Israeli Shekel
THB = Baht
TWD = Taiwan Dollar
RUB =Russian Rouble
PHP =Philippine Peso
INR = Indian Rupee
DKK = Danish Krone
NOK = Norwegian Krone
SEK =Swedish Krona
ZAR =South African Rand
RSD = Republic of Serbia Dinar
IDR = Indonesian Rupiah

		
		
		*/
		if($unitar[$currency]){
			return $unitar[$currency];
		}
		return __($currency);
	}
	
}