<div style="width:400px" align="right">
<? include "../cfrontend/tbframe2h.php"?>
<table width="100%" border="0" cellspacing="1" align="center">
<input type="hidden" name="cid" id="cid" value="<?=$customer_id?>" />
  <tr>
    <td colspan="4" align="center"><strong>Customer Information</strong></td>
  </tr>
  <tr>
    <td width="100">Lab. Name</td>
    <td colspan="3">
      <input name="labname" type="text" id="labname" value="<?=$cus_name?>" style="width:250px" /></td>
  </tr>
  <tr>
    <td width="100">Lab. Code</td>
    <td colspan="3"><input name="code" type="text" id="code" value="<?=$cus_nick?>" style="width:50px" /></td>
  </tr>
  <tr>
    <td width="100">Address</td>
    <td colspan="3">
      <textarea name="address" rows="2" id="address" style="width:250px"><?=$cus_address?></textarea></td>
  </tr>
  <tr>
    <td width="100">Province</td>
    <td><div id="DivShowProvince" overflow:auto>
                                    <select name="Pvince" id="Pvince">
                                    <? 
									$pro_data = new CSql();
									$pro_data->Connect();
							
										$sqlpr = "SELECT * FROM province WHERE prv_cnt_id=".$cntt;
										$sqlpr =$sqlpr." ORDER BY prv_name";							
										$pro_data->Query($sqlpr);		
								
									while(!$pro_data->EOF){
		
									$pid 		= $pro_data->Rs("provinceid");
									$pname	 	= $pro_data->Rs("prv_name");
									$pnick 		= $pro_data->Rs("prv_cnt_id");	
							
									if($prvt == $pid)
									echo "<option selected=\"selected\" value=\"".$pid."\">".$pname."</option>";
									else
									echo "<option value=\"".$pid."\">".$pname."</option>";	
			
									$pro_data->MoveNext();
									}
									?>
                                    </select>
                  </div></td>
    <td align="right">Country</td>
    <td align="right"><select name="Ctry" id="Ctry" onChange="showHTML('DivShowProvince','../cfrontend/queryprovince.php?prvid='+this.value);">
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
    <td width="100">Shipping <br>
      address</td>
    <td colspan="3">
    <textarea name="shipaddress" rows="2" id="shipaddress" style="width:250px"><?=$cus_shipaddress?></textarea></td>
  </tr>
  
  <tr>
    <td width="100">Billing <br>
      address</td>
    <td colspan="3">
    <textarea name="billaddress"  rows="2" id="billaddress" style="width:250px"><?=$cus_billaddress?></textarea></td>
  </tr>
  <tr>
    <td colspan="4" align="center"><label>
    </label></td>
  </tr>
</table>
<? include "../cfrontend/tbframe2f.php"?>
</div>