<? include_once("../core/default.php"); ?>

<?
	//var_dump($_GET);
	//$DEBUGSQL = true;
	$user_type = $_COOKIE["usertype"];
	$action = $_GET["act"];
	$group = $_GET["gr"];
	$user_id = $_GET["uid"];
	$staff_id = $_GET["sid"];
	$customer_id = $_GET["cid"];
	
	$user_data = new Csql();
	$staff_data = new Csql();
	$customer_data = new Csql();
	$user_data->Connect();
	$staff_data->Connect();
	$customer_data->Connect();
	
	if(isset($user_id) && $user_id != 0) {
		$user_data->Query("select * from userdental where userdentalid = $user_id limit 1");
		if(!$user_data->EOF) {
			$uname = $user_data->Rs("usr_username");
			$password = $user_data->Rs("usr_password");
			$fname = $user_data->Rs("usr_fname");
			$lname = $user_data->Rs("usr_sname");
			$email = $user_data->Rs("usr_email");
		}
	}
	
?>
<br />
<form name="formUserEdit" id="formUserEdit" method="get" action="../admin/user_process.php">
<input type="hidden" name="act" id="act" value="<?=$action?>" />
<input type="hidden" name="gr" id="gr" value="<?=$group?>" />
<table width="100%" height="100%" border="0" align="center">
    <tr><td valign="top">
<? 
	if(isset($user_id) && $user_id != 0) {
		include("../admin/user_edit.php"); 	
	}
?>
    </td>
    <td valign="top">
<?
	switch($group) {
		case "ST":
			$staff_data->Query("select * from staff where staffid = $staff_id limit 1");
			if(!$staff_data->EOF) {
				$staff_name = $staff_data->Rs("stf_name");
				$staff_code = $staff_data->Rs("stf_code");
				$staff_idcard = $staff_data->Rs("stf_idcard");
				$section_id = $staff_data->Rs("stf_sec_id");
				$enable = $staff_data->Rs("stf_enable");
				$staff_prefix = $staff_data->Rs("stf_prefix");
			}
			include("../admin/staff_edit.php");
			break;
		case "CM":
			$customer_data->Query("select * from customer where customerid = $customer_id limit 1");
			if(!$customer_data->EOF) {
				$cus_name = $customer_data->Rs("cus_name");
				$cus_nick = $customer_data->Rs("cus_nick");
				$cus_address = $customer_data->Rs("cus_address");
				$ship_address = $customer_data->Rs("cus_shipaddress");
				$bill_address = $customer_data->Rs("cus_billaddress");
				$prvt = $customer_data->Rs("cus_prv_id");
				$cntt = $customer_data->Rs("cus_cnt_id");
			}
			include("../admin/customer_edit.php");
			break;
		case "MN":
		case "AD":
		default:
			break;
	}
?>
    </td></tr>
    <tr><td colspan="2">&nbsp;
    </td></tr>
    <tr><td colspan="2" align="center">
     &nbsp;&nbsp;&nbsp;
    </td></tr>
    <tr><td colspan="2" valign="bottom">
    	
        <table width="100%" border="0"  align="center" cellpadding="2" cellspacing="1">
  <tr>
    <td>&nbsp;</td>
    <td width="70">
     <? if($user_id == 0) { ?>
    <table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
      <tr>
        <td width="50" align="center" bgcolor="#FFFFFF" class="tdButtonOnOut" onclick="CloseDivEditUserData();OpenDivEditUserData('<?=$group?>',-1,<?=$staff_id?>,<?=$customer_id?>);"  onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">Add 
      User</td>
      </tr>
    </table><? } ?>
      </td>

    <td width="2">&nbsp;</td>
    <td width="50"><table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr>
    <td  width="50" align="center" bgcolor="#FFFFFF" class="tdButtonOnOut" onclick="formUserEdit.submit();"  onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" >Save</td>
  </tr>
</table>
</td>
    <td width="2">&nbsp;</td>
    <td width="50"><table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
        <tr>
          <td  width="50" align="center" bgcolor="#FFFFFF" class="tdButtonOnOut" onclick="CloseDivEditUserData();"  onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" >Close </td>
        </tr>
      </table></td>
    <td width="25">&nbsp;</td>
  </tr>
</table>
        
    </td></tr>
</table>

</form>