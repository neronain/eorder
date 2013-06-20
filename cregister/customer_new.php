<? 	
	$SKIPPERMISSION = true;
	include_once("../core/default.php"); 
	
?>
<div style="width:400px" align="center">
<? include "../cfrontend/tbframe2h.php"?>
<table width="100%" border="0" cellspacing="1" align="center">
<input name="utype" id="utype" type="hidden" value="new">
  <tr>
    <td colspan="2" align="center"><strong><?=T_REGISTRATION;?></strong></td>
  </tr>
  <tr>
    <td ><?=T_USERNAME;?></td>
    <td>
      <input name="uname" type="text" id="uname">    </td>
  </tr>
  <tr>
    <td ><?=T_PASSWORD;?> <br>
      (8 - 20 <?=T_ALPHANUMERIC;?>)</td>
    <td >
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
    <td><?=T_LABNAME;?></td>
    <td>
      <input name="labname" type="text" id="labname" value="" style="width:200px" /></td>
  </tr>
  <tr>
    <td><?=T_ADDRESS;?></td>
    <td>
      <textarea name="address" rows="3" id="address" style="width:200px"><?=$addresst; ?></textarea></td>
  </tr>
  <tr>
    <td><?=T_PROVINCE;?></td>
    <td><div id="DivShowProvince" overflow:auto>
            <select name="Pvince" id="Pvince">
<? 
				$pro_data = new CSql();
				$pro_data->Connect();
		
					$sqlpr = "SELECT * FROM province WHERE prv_cnt_id=1 ORDER BY prv_name";							
					$pro_data->Query($sqlpr);		
			
				while(!$pro_data->EOF){
	
					$pid 		= $pro_data->Rs("provinceid");
					$pname	 	= $pro_data->Rs("prv_name");
					$pnick 		= $pro_data->Rs("prv_cnt_id");	
			
					echo "<option value=\"".$pid."\">".$pname."</option>";	
	
				$pro_data->MoveNext();
				}
?>
            </select>
    </div></td>
  </tr>
  <tr>
    <td><?=T_COUNTRY;?></td>
    <td>
    <select name="Ctry" id="Ctry" onChange="showHTML('DivShowProvince','../cfrontend/queryprovince.php?prvid='+this.value);return false;">
      <?							
                                $country_data = new CSql();
								$country_data->Connect();
								
								$country_data->Query("SELECT * FROM country");		
								
								while(!$country_data->EOF){
		
								$cid 		= $country_data->Rs("countryid");
								$cname	 	= $country_data->Rs("cnt_name");
								$cnick 		= $country_data->Rs("cnt_nick");
									
								if($cntt == $cid)
								echo "<option selected=\"selected\" value=\"".$cid."\">".$cname."</option>";
								else
								echo "<option value=\"".$cid."\">".$cname."</option>";	
			
								$country_data->MoveNext();
									}
								?>
    </select></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><input type="button" onclick="setValue('shipaddress',getValue('address'));return false;" value="<?=T_CPFA;?>"/></td>
    </tr>
  <tr>
    <td><?=T_SHIPPING;?> <?=T_ADDRESS;?></td>
    <td>
    <textarea name="shipaddress" rows="3" id="shipaddress" style="width:200px"></textarea></td>
  </tr>
  <tr>
    <td colspan="2" align="right"><input type="button" onclick="setValue('billaddress',getValue('address'));return false;" value="<?=T_CPFA;?>"/></td>
    </tr>
  <tr>
    <td><?=T_BILLING;?> <?=T_ADDRESS;?></td>
    <td>
    <textarea name="billaddress"  rows="3" id="billaddress" style="width:200px"></textarea></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><label>
    <input type="submit" value="<?=T_REGISTER;?>">&nbsp;&nbsp;&nbsp;
    <input type="button" value="<?=T_CANCEL;?>" onclick="javascript:window.location='../cregister/customer_register.php?act=search'; return false;">
    </label></td>
  </tr>
</table>
<? include "../cfrontend/tbframe2f.php"?>
</div>