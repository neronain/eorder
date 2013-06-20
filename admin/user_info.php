<br />
<table align="center" height="90%">
<tr>
    <td width="90%" valign="top">
<? 
	if(isset($user_id) && $user_id != 0) {
?>
<div style="width:250px" align="left">
<? include "../cfrontend/tbframe2h.php"?>
<table width="100%" border="0" cellspacing="1" align="center">
  <tr>
    <td colspan="2" align="center"><strong>User Information</strong></td>
  </tr>
  <tr>
    <td style="width:100px"><strong>Username</strong></td>
    <td align="left">&nbsp;<?=$username?></td>
  </tr>
  <tr>
    <td ><strong>Password</strong></td>
    <td align="left" >&nbsp;
	<?
		$passwd = "";
    	for($i=0;$i<strlen($password);$i++) {
			$passwd .= "*";
		}
		echo substr($passwd,0,8);
	?>
    </td>
  </tr>
  <tr>
    <td><strong>Name</strong></td>
    <td align="left">&nbsp;<?=$name?></td>
  </tr>
  <tr>
    <td><strong>e-mail</strong></td>
    <td align="left">&nbsp;<?=$email?></td>
  </tr>
</table>
<? include "../cfrontend/tbframe2f.php"?>
</div>
<?
	}
?>
    </td>
   	<td width="90%" valign="top">
<?
	switch($group) {
		case "ST":
?>
<div style="width:400px" align="right">
<? include "../cfrontend/tbframe2h.php"?>
<table width="100%" border="0" cellspacing="1" align="center">
  <tr>
    <td colspan="2" align="center"><strong>Staff Information</strong></td>
  </tr>
  <tr>
    <td width="100"><strong>Staff Name</strong></td>
    <td>&nbsp;<?=$staff_prefix?> <?=$staff_name?></td>
  </tr>
  <tr>
    <td width="100"><strong>Staff Code</strong></td>
    <td>&nbsp;<?=$staff_code?></td>
  </tr>
  <tr>
    <td width="100"><strong>ID Card No.</strong></td>
    <td>&nbsp;<?=$staff_idcard?></td>
  </tr>
  <tr>
    <td width="100"><strong>Section</strong></td>
    <td>&nbsp;<?=$section_name?></td>
    </tr>
  
  <tr>
    <td width="100"><strong>Status</strong></td>
    <td>&nbsp;<?= ($enable)? "Enable" : "Disable"?></td>
  </tr>
</table>
<? include "../cfrontend/tbframe2f.php"?>
</div>
<?
			break;
		case "CM":
?>
<div style="width:400px" align="right">
<? include "../cfrontend/tbframe2h.php"?>
<table width="100%" border="0" cellspacing="1" align="center">
  <tr>
    <td colspan="2" align="center"><strong>Customer Information</strong></td>
  </tr>
  <tr>
    <td width="100"><strong>Lab. Name</strong></td>
    <td>&nbsp;<?=$cus_name?></td>
  </tr>
  <tr>
    <td width="100"><strong>Lab. Code</strong></td>
    <td>&nbsp;<?=$cus_nick?></td>
  </tr>
  <tr>
    <td width="100"><strong>Address</strong></td>
    <td>&nbsp;<?=$cus_address?></td>
  </tr>
  <tr>
    <td><strong>Province</strong></td>
    <td>&nbsp;<?=$prvt?></td>
    </tr>
  <tr>
    <td width="100"><strong>Country</strong></td>
    <td>&nbsp;<?=$cntt?></td>
    </tr>

  
  <tr>
    <td width="100"><strong>Shipping <br>
      address</strong></td>
    <td>&nbsp;<?=$ship_address?></td>
  </tr>
  
  <tr>
    <td width="100"><strong>Billing <br>
      address</strong></td>
    <td>&nbsp;<?=$bill_address?></td>
  </tr>
</table>
<? include "../cfrontend/tbframe2f.php"?>
</div>
<?
			break;
		default:
			break;
	}
?>    
    </td>
</tr>

<tr><td colspan="2" align="right">&nbsp;</td>
</tr>
<tr>
<td colspan="4">
<table width="100%" border="0"  align="center" cellpadding="2" cellspacing="1">
  <tr>
    <td>&nbsp;</td>
    <td width="2">&nbsp;</td>
    <td width="50"><table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr>
    <td  width="50" align="center" bgcolor="#FFFFFF" class="tdButtonOnOut" onclick="CloseDivShowUserData();OpenDivEditUserData('<?=$group?>',<?=$user_id?>,<?=$staff_id?>,<?=$customer_id?>);"  onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" >Edit</td>
  </tr>
</table></td>
    <td width="2">&nbsp;</td>
    <td width="50"><table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
        <tr>
          <td  width="50" align="center" bgcolor="#FFFFFF" class="tdButtonOnOut" onclick="CloseDivShowUserData();"  onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" >Close </td>
        </tr>
      </table></td>
    <td width="10">&nbsp;</td>
  </tr>
</table>
</td>
</tr>
</table>