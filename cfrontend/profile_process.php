<?
	include("../core/default.php");
	
	getVar($action,"act");
	getVar($error,"err");
	getVar($uid,"uid");

	if($action == "complete") {
		echo "Save Profile Complete.<br>";
	} elseif($action == "error") {
		if($error == "incompleteform") {
			echo "Please fill in password and retype-password field<br> to change password or blank it to do nothing.<br>";
		} elseif($error == "noconfirmpassword") {
			echo "Please input your old password to change password.<br>";
		} elseif($error == "passmismatch") {
			echo "Password and retype-password mismatch.<br>";
		} elseif($error == "nouser") {
			echo "Cannot find this username stored in database.<br>";
		} elseif($error == "invalidpassword") {
			echo "Invalid old password.<br>";
		}
	} elseif($action == "changecomplete") {
		echo "Change Password Complete.<br>";
	} else {
		echo "";
	}	
?>