<? 
	$SKIPPERMISSION = true;
	include_once("../core/default.php"); 

	getVar($customerid,"cid");
	getVar($register_username,"uname");
	
	$data = new Csql();
	$data->Connect();
	$data->Query("select * from customer where customerid=$customerid limit 1");
	if(!$data->EOF)
	{
		$cus_name = $data->Rs("cus_name");
	}
?>
<div style="width:400px" align="center">
<? include "../cfrontend/tbframe2h.php"?>
<strong><?=T_REGUSRnPSSW;?></strong>
<table width="100%" border="0" align="center" cellpadding="3" cellspacing="1">
<input name="cid" id="cid" type="hidden" value="<?=$customerid?>">
<input name="utype" id="utype" type="hidden" value="old">
    <tr>
      <td><?=T_CUSTNAME;?></td>
      <td>&nbsp;<?=$cus_name?></td>
    </tr>
    <tr>
    <td><?=T_USERNAME;?></td>
    <td>
    <input name="uname" type="text" id="uname" value="<?=$register_username?>" >    </td>
  </tr>
  <tr>
    <td><?=T_PASSWORD;?> <br>
      (8 - 20 <?=T_ALPHANUMERIC;?>)</td>
    <td>
      <input name="passwd" type="password" id="passwd">    </td>
  </tr>
  <tr>
    <td><?=T_RE_PASSWORD;?></td>
    <td>
      <input type="password" name="vpasswd" id="vpasswd" >	</td>
  </tr>
  <tr>
    <td><?=T_EMAIL;?></td>
    <td>
    <input name="email" type="text" id="email" >    </td>
  </tr>
  <tr>
    <td><?=T_RE_EMAIL;?></td>
    <td>
    <input name="vemail" type="text" id="vemail" >    </td>
  </tr>
  <tr>
    <td colspan="2" align="right"><label>
      <input type="submit" value="<?=T_REGISTER;?>">&nbsp;&nbsp;&nbsp;<input type="button" value="<?=T_CANCEL;?>" onclick="javascript:window.location='../cregister/customer_register.php?act=search';return false;">
    </label></td>
  </tr>
</table>
<? include "../cfrontend/tbframe2f.php"?>
</div>