<? ob_start();  ?>
<? //ob_start("ob_gzhandler");  ?>
<? include_once("../core/default.php"); ?>
<?


	if(!isset($eorderid))$eorderid = $_GET["eorderid"];
	if(!isset($eorderid))$eorderid = $_POST["eorderid"];
	
	if(!isset($cusid))$cusid = $_GET["customerid"];
	if(!isset($cusid))$cusid = $_POST["customerid"];	
	if(!isset($cusid))$cusid=$_COOKIE['customerid'];
	if(!isset($cusid))$cusid=8;
	$customer_id = $cusid;	

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title><?=WEBSITE_HEADER?></title>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>
<body>
<? /* */ include_once "../resource/divbackground.php" ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="37" bgcolor="#2D2D2D" background="../cfrontend/images/header.png" valign="top"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><img src="../cfrontend/images/header.gif" width="474" height="35" /></td>
        <td>&nbsp;</td>
        <td width="80" class="logout"><a href="../core/logout_c.php"><strong class="logout"><?= T_LOGOUT ?></strong></a></td>
      </tr>
    </table></td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="500" align="left" valign="top" background="../cfrontend/images/body.png" style="background-repeat:repeat-x">

