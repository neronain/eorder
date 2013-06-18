<? 

	$type = $_COOKIE['usertype'];
	if($type=='AD'){
		include ("../admin/menu.php");
	}else if($type=='MN'){
		include ("../manager/menu.php");
	}else if($type=='CM'){
		include ("../customer/menu.php");
	}else if($type=='ST'){
		include ("../staff/menu.php");
	}


?>