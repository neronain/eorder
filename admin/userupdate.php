<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body>

<? include_once("../core/default.php");
$userdental_data = new CSql();
$userdental_data->Connect();


// if click edit from queryuserlist.php

if($userid && $sh==1){
	$userdental_data->Query("SELECT usr_username,usr_email,usr_ugp_id,usr_fname,usr_sname,usr_status FROM userdental WHERE userdentalid='".$userid."'");
?>
<table width="100%" border="0" cellpadding="2" cellspacing="1">
  <tr>
	<td align="center" bgcolor="#CCCCCC">User info</td>
  </tr>
</table>
<table border="0" cellpadding="2" cellspacing="1" class="Normal">
  <tr>
    <td width="100">User Name </td>
    <td><?=$userdental_data->Rs("usr_username");?></td>
  </tr>
  <tr>
    <td width="100">User e-mail </td>
    <td><?=$userdental_data->Rs("usr_email");?></td>
  </tr>
  <tr>
    <td width="100">Group</td>
    <td><?=$userdental_data->Rs("usr_ugp_id");?></td>
  </tr>
  <tr>
    <td width="100">First name </td>
    <td><?=$userdental_data->Rs("usr_fname");?></td>
  </tr>
  <tr>
    <td width="100">Sure name</td>
    <td><?=$userdental_data->Rs("usr_sname");?></td>
  </tr>
  <tr>
    <td width="100">User Status</td>
    <td><?=$userdental_data->Rs("usr_status");?></td>
  </tr>
  </table>
<?
}

//-----------------------------------------------

if($_POST['save']){
	$userdental_data->Query("SELECT MAX(userdentalid) as MaxID FROM userdental;");
	$vUserid = $userdental_data->Rs("MaxID") +1;

	$vUsername = $_POST['usr_username'];
	$vUserpassw = $_POST['usr_password'];
	$vUseremail = $_POST['usr_email'];
	$vUsergroup = $_POST['groupid'];
	$vUserfname = $_POST['usr_fname'];
	$vUsersname = $_POST['usr_sname'];
	$vUserstatus = $_POST['status'];
	$xSql = "INSERT INTO userdental(userdentalid,usr_username,usr_password,usr_email,usr_ugp_id,usr_fname,usr_sname,usr_status)";
	$xSql .= " VALUES ('".$vUserid."','".$vUsername."','".$vUserpassw."','".$vUseremail."','".$vUsergroup."', '".$vUserfname."','";
	$xSql .= $vUsersname."','".$vUserstatus."')";

	$userdental_data->Execute($xSql);
}
if($_POST['cancel']=="Cancel"){
	echo "<script>location='queryuserlist_c.php';</script>";
}

?>
	<table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('add')">
        <img src="../resource/images/silkicons/add.png" /> Add</td>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('edit')">
        <img src="../resource/images/silkicons/pencil.gif" /> Edit </td>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('close')">
        <img src="../resource/images/silkicons/package_go.gif" /> Close </td>
      </tr>
    </table>
<?
if($add){ ?>
<table border="0" cellpadding="2" cellspacing="1" class="Normal">
  <tr>
    <td width="100">User Name </td>
    <td><input type="text" name="usr_username" value"<?echo $userdental_data->Rs("usr_username");?>"></td>
  </tr>
  <tr>
  <td>Password</td>
  <td><input type="password" name="usr_password" value"<?=$userdental_data->Rs("usr_password");?>" ></td>
  </tr>
  <tr>
  <td>E-mail</td>
  <td><input type="text" name="usr_email" value"<?=$userdental_data->Rs("usr_email");?>"></td>
  </tr>
  <tr>
    <td>Group </td>
    <td><select name="groupid"> 
			<option value="AD">Admin</option> 
			<option value="MN">Manager</option> 
			<option value="ST">Staff</option> 
			<option value="CM">Customer</option> 
			</select>
	</td>
  </tr>
  <tr>
  <td>First Name </td>
  <td><input type="text" name="usr_fname" value"<?=$userdental_data->Rs("usr_fname");?>"></td>
  </tr>
  <tr>
  <td>Sure Name </td>
  <td><input type="text" name="usr_sname"  value"<?=$userdental_data->Rs("usr_sname");?>"></td>
  </tr>
  <tr>
    <td>Status</td>
    <td><select name="status"> 
			<option value="DEACTIVE">DEACTIVE</option> 
			<option value="VERIFY">VERIFY</option> 
			<option value="ACTIVE">ACTIVE</option> 
			</select>
	</td>
  </tr>
</table>
<?
	}
?>

</body>
</html>


