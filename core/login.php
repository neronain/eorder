<?
// IN
	$in = isset($param)?$param:$_POST['param']; 
	
	 if($in!='LO' && isset($_COOKIE['usertype'])){
	 	//echo "debug!!!!!!!!!!!!!!!11";
	 	include "../core/login_c.php";
	 	exit();
	 }
	
	// NC: Not complete agument
	// UP: User or Password invalid
	// DN: Denie
	if($in=='NC'){
		$msg = 	"Not complete agument";
	}else if($in=='UP'){
		$msg = 	"User or Password invalid";
	}else if($in=='DN'){
		$msg = 	"Access deny";
	}
?>
<html>
<title>Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<body>

<table width="100%" height="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td align="center">
	<table width="300" border="0" cellpadding="3" cellspacing="1" class="TableBorder">
  <tr>
    <td class="HeaderW">Login</td>
  </tr>
<form id="loginform" name="loginform" method="post" action="../core/login_c.php">

  <tr>
    <td bgcolor="#FFFFFF">
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
      <tr>
        <td>username</td>
        <td><input name="username" type="text" id="username"  style="width:100"/></td>
      </tr>
      <tr>
        <td>password</td>
        <td><input name="password" type="password" id="password" style="width:100"/></td>
      </tr>
      <tr>
        <td colspan="2" align="right">
		<font color="#CC0000"><?=$msg?></font>
		<input name="Submit" type="submit" class="BTok" value="Login" /></td>
        </tr>
    </table></td>
  </tr>
  </form>
</table>
    <a href="../register/index.php">Sign up an acount</a></td>
  </tr>
</table>
</body></html>