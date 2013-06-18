<div style="width:250px" align="left">
<? include "../cfrontend/tbframe2h.php"?>
<table width="100%" border="0" cellspacing="1" align="center">
<input name="utype" id="utype" type="hidden" value="new">
<input type="hidden" name="uid" id="uid" value="<?=$user_id?>" />
  <tr>
    <td colspan="2" align="center"><strong>User Information</strong></td>
  </tr>
<?
	if($user_type == "AD") {
?>
  <tr>
    <td >Username</td>
    <td align="right">
      <input name="uname" type="text" id="uname" style="width:100px" value="<?=$uname?>">    </td>
  </tr>
  <tr>
    <td >Password </td>
    <td align="right" >
      <input name="passwd" type="password" id="passwd" style="width:100px" value="">    </td>
  </tr>
    <tr>
    <td>First name</td>
    <td align="right">
    <input name="fname" type="text" id="fname" style="width:100px" value="<?=$fname?>" >    </td>
  </tr>
    <tr>
    <td>Last name</td>
    <td align="right">
    <input name="lname" type="text" id="lname" style="width:100px" value="<?=$lname?>" >    </td>
  </tr>
  <tr>
    <td>e-mail</td>
    <td align="right">
    <input name="email" type="text" id="email" style="width:100px" value="<?=$email?>" >    </td>
  </tr>
<? 
	} else {	
?>
	<tr>
    <td >Username</td>
    <td align="left">&nbsp;<?=$username?></td>
  </tr>
  <tr>
    <td >Password </td>
    <td align="left" >&nbsp;	
	<?
		$passwd = "";
    	for($i=0;$i<strlen($password);$i++) {
			$passwd .= "*";
		}
		echo $passwd;
	?>
</td>
  </tr>
    <tr>
    <td>First name</td>
    <td><?=$fname?></td>
  </tr>
    <tr>
    <td>Last name</td>
    <td><?=$lname?></td>
  </tr>
  <tr>
    <td>e-mail</td>
    <td>&nbsp;<?=$email?></td>
  </tr>
<?
	}
?>
</table>
<? include "../cfrontend/tbframe2f.php"?>
</div>