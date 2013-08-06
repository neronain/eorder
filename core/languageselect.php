<?
	if(isset($_GET["lang"])){
		setcookie("language",$_GET["lang"],0,'/');
		$_SESSION['language'] = $_GET["lang"];
	}

	if(isset($_SESSION['language'])){
		$language = $_SESSION['language'];
	}else{
		$language = $_COOKIE['language'];
		if(!isset($language)){
			$language = 'thai';
		}
		$_SESSION['language'] = $language;
	}
	include_once("../configuration/text_".$language.".php");
    
	
	
?>