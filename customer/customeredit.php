<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<table width="550" border="0" align="center" cellpadding="2" cellspacing="1" bgcolor="#000000" class="TableBorder">
<form action="customeredit_c.php" method="post">
  <tr>
    <td class="HeaderW">Customer edit </td>
  </tr>

	<input type="hidden" name="customerid" value="<?=$customerid?>" />
  <tr>
    <td height="300" valign="top" bgcolor="#FFFFFF" class="Normal">
      <table width="500" border="0" align="center" cellpadding="2" cellspacing="0">
        <tr>
          <td width="100"><?=T_LABNAME;?></td>
          <td>
              <input name="cus_name" type="text" id="cus_name" value="<?=$cus_name ?>" style="width:400px" />		</td>
        </tr>
        <tr>
          <td>Nickname</td>
          <td><input name="cus_nick" type="text" id="cus_nick" value="<?=$cus_nick ?>" style="width:50px" /></td>
        </tr>
        <tr>
          <input type="hidden" name="Pvince" id="Pvince" value="<?=$province?>" />
          <td width="100"><?=T_PROVINCE;?></td>
          <td><div id="DivShowProvince" overflow:auto="overflow:auto" >
                <select name="province" id="province">
                  <? 
									$pro_data = new CSql();
									$pro_data->Connect();
							
										$sqlpr = "SELECT * FROM province WHERE prv_cnt_id=".$country;
										$sqlpr =$sqlpr." ORDER BY prv_name";							
										$pro_data->Query($sqlpr);		
								
									while(!$pro_data->EOF){
		
									$pid 		= $pro_data->Rs("provinceid");
									$pname	 	= $pro_data->Rs("prv_name");
									$pnick 		= $pro_data->Rs("prv_cnt_id");	
							
									if($province == $pid)
									echo "<option selected=\"selected\" value=\"".$pid."\">".$pname."</option>";
									else
									echo "<option value=\"".$pid."\">".$pname."</option>";	
			
									$pro_data->MoveNext();
									}
									?>
                </select>
          </div></td>
        </tr>
        <tr>
          <td width="100"><?=T_COUNTRY;?></td>
          <td>
              <select name="country" id="country" onchange="showHTML('DivShowProvince','queryprovince.php?prvid='+this.value);">
                <?							
                                $country_data = new CSql();
								$country_data->Connect();
								
								$country_data->Query("SELECT * FROM country");		
								
								while(!$country_data->EOF){
		
								$cid 		= $country_data->Rs("countryid");
								$cname	 	= $country_data->Rs("cnt_name");
								$cnick 		= $country_data->Rs("cnt_nick");
									
								if($country == $cid)
								echo "<option selected=\"selected\" value=\"".$cid."\">".$cname."</option>";
								else
								echo "<option value=\"".$cid."\">".$cname."</option>";	
			
								$country_data->MoveNext();
									}
								?>
              </select>            </td>
        </tr>
        <tr>
          <td>Telephone No.</td>
          <td><input name="cus_tel" type="text" id="cus_tel" value="<?=$cus_tel ?>" style="width:200px" /></td>
        </tr>
        <tr>
          <td>e-mail address</td>
          <td><input name="cus_email" type="text" id="cus_email" value="<?=$cus_email ?>" style="width:200px" /></td>
        </tr>
 		 <tr>
          <td>Shipping by</td>
          <td><input name="cus_shipmethod" type="text" id="cus_shipmethod" value="<?=$cus_shipmethod ?>" style="width:200px" /></td>
        </tr>        
        <tr>
          <td colspan="2"><hr /></td>
        </tr>
        <tr>
          <td valign="top"><?=T_ADDRESS;?></td>
          <td align="left" valign="top"><textarea name="address" cols="50" rows="2" id="address" style="width:400px"><?=$address ?></textarea></td>
        </tr>

        
        <tr>
          <td width="100" valign="top"><?=T_SENDING;?>
              <br />
              <?=T_ADDRESS;?>
            <br /></td>
          <td><textarea name="shipaddress" id="shipaddress" cols="50" rows="2" style="width:400px"><?=$shipaddress?></textarea></td>
        </tr>

        <tr>
          <td width="100" valign="top"><?=T_BILLING;?>
              <br />
              <?=T_ADDRESS;?></td>
          <td><textarea name="billaddress" id="billaddress" cols="50" rows="2" style="width:400px"><?=$billaddress?></textarea></td>
        </tr>
      </table>	</td>
</tr>
  
    <td class="FooterTD"><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td>&nbsp;</td>
		
        <td align="right">
		<input name="METHOD" type="submit" class="BTupdate" value="UPDATE"
         /><!-- onclick="CustomerChangeTab('update')" -->
		
		</td>
		
      </tr>
    </table>
      </td>
  </tr>
</form>
</table>

