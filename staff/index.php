<? include_once("../core/default.php"); 

/*
	if(!isset($_COOKIE["staffsection"])){
		if(isset($_COOKIE["userdentalid"])){
			$user = $_COOKIE["userdentalid"];
			$data_staff = new Csql();
			$data_staff->Connect();
			$data_staff->Query("select * from staff where stf_usr_id=$user limit 0,1");
			if($data_staff->Count()>0){
				setcookie("staffsection",$data_staff->Rs("stf_sec_id"),0,'/');
			}else{
				echo("Not found $user");
			}
		}else{
			gotourl("../core/login.php");
			exit();
		}
	}
*/
?>



<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>
<? include("../staff/menu.php")?>
<table width="100%" height="25" border="0" cellpadding="0" cellspacing="7" background="../cfrontend/images/bg_03.png" class="MenuTab">
  <tr>
    <td height="26" align="center" >&nbsp;</td>
  </tr>
</table>  <br>
  <br>
  <br>
  <br>
  <br><br>
<div align="center" class="Big">
  Welcome <?=$_COOKIE["stf_name"]?>
  <? //var_dump($_COOKIE); ?>
  <? //var_dump($_SESSION); ?>
</div>
</body></html>

<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>