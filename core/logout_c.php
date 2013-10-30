<?
// OUT
	$includeSuccess = "../cfrontend/login.php";
	
// Start code
	setcookie("userdentalid","",0,'/');
	setcookie("username","",0,'/');
	setcookie("usertype","",0,'/');
	setcookie("customerid","",0,'/');
	setcookie("doctorid","",0,'/');
	
	$_SESSION["userdentalid"] = null;
	$_SESSION["username"] = null;
	$_SESSION["usertype"] = null;
	
//	setcookie("staffsection","",0,'/');
	$param = 'LO';
	include($includeSuccess);
?>