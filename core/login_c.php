<?
// IN
	$username = $_POST['username'];
	$password = $_POST['password'];
	$language = $_POST['language'];
// OUT
	$forwardSuccess['AD'] = "../admin/index.php";
	$forwardSuccess['MN'] = "../admin/index.php";
	$forwardSuccess['CM'] = "../cfrontend/dashboard.php";
	$forwardSuccess['ST'] = "../staff/index.php";
	$forwardSuccess['DC'] = "../cfrontend/dashboard.php";

	$param;
	$includeInvalid				=	"../cfrontend/login.php";
	$includeFail					=	"../cfrontend/login.php";


// Condition
	if(!isset($username) && isset($_COOKIE['usertype'])){
		header('Location:'.$forwardSuccess[$_COOKIE['usertype']]) ;
		exit();
	}
// Validate
	if(!isset($username) || !isset($password) || $username=="" || $password==""){
		$param = 'NC';		
		include($includeInvalid);	
		exit();
	}



// Start code


	include_once("csql.php");
 	include_once("config.php");
 	include_once("user.php");


	if(isset($language)){
		setcookie("language",$language,0,'/');
	}

	$data = new CSql();
 	$err =	$data->Connect();
	
	//$DEBUGSQL = true;
	$data->Query("select * from userdental where usr_username='$username' ".
	//"and usr_password=old_password('$password') ".
	"");

	if ($data->RecordCount == 1) {
		$type = $data->Rs("usr_ugp_id");
		$userid = $data->Rs("userdentalid");
		$username = $data->Rs("usr_username");
		setcookie("userdentalid",$userid,0,'/');
		setcookie("username",$username,0,'/');
		setcookie("usertype",$type,0,'/');
		$_SESSION["userdentalid"] = $userid;
		$_SESSION["username"] = $username;
		$_SESSION["usertype"] = $type;
		
		
		
		if($type=="CM"){
			$data->Query("select customerid from customer where cus_usr_id=$userid  ");
			$customerid = $data->Rs("customerid");
			setcookie("customerid",$customerid,0,'/');
			//setcookie("language","thai",0,'/');
			header('Location:'.$forwardSuccess[$type]."?customerid=$customerid");
			exit();
		}
		
		if($type=="ST"){
			$data->Query("select staffid,stf_name,stf_sec_id from staff where stf_usr_id=$userid  ");
			if($data->Count()>0){
				$staffid = $data->Rs("staffid");
				$stf_name = $data->Rs("stf_name");
				$stf_sec_id = $data->Rs("stf_sec_id");
				
				$_SESSION["userstfid"] = $staffid;
				$_SESSION["usersecid"] = $stf_sec_id;

				setcookie("staffid",$staffid,0,'/');
				setcookie("stf_name",$stf_name,0,'/');
				setcookie("stf_sec_id",$stf_sec_id,0,'/');

				setcookie("userstfid",$staffid,0,'/');
				setcookie("usersecid",$stf_sec_id,0,'/');

			}
			

		}
				
		header('Location:'.$forwardSuccess[$type]);
		//? ><script>window.open('<?=$forwardSuccess[$type]? >', '', 'fullscreen=yes, scrollbars=1'); < /script> <?
		exit();
	}else{
		setcookie("username","",0,'/');
		setcookie("usertype","",0,'/');
		$param = 'UP';
		include($includeFail);
		exit();

	}
	

?>