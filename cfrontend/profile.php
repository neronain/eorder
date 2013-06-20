<? include_once("../core/default.php"); ?>
<? include "header.php" ?>
<? $menu='profile' ?><br />
<? include "mainmenu.php"?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" valign="top">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
         <tr>
                    <td width="50"  align="center" valign="top">&nbsp;</td>
                    <td align="left" valign="top">
                    <div style="width:600px">
					<? $tbframeheader = "Update your profile"?>
                            <? include "tbframeh.php"?>
<table align="center"><tr><td style="height:20px;width:350px">
<font color="#0000FF"><div id="DivShowStatus" align="center" style="background-color:#FFFF66;">Waiting For Event</div></font>  
</td></tr></table>
<br />                      
                         <form id="profileupdate" name="profileupdate" method="post" action="profile_c.php"> 

<?	
	//echo "ajax_action = $ajax_action<br>";
	//echo "ajax_error = $ajax_error<br>";

	//$cusid = $_GET["customerid"];
	getVar($cusid,"customerid");
    if(!isset($cusid))$cusid=$_COOKIE['customerid'];
    if(!isset($cusid))$cusid=8;

	$customer_data = new CSql();
	$customer_data->Connect();
	
	$sqlm = "SELECT * FROM customer WHERE customerid=".$cusid;							
	$customer_data->Query($sqlm);		
	if(!$data->EOF) {
		$Lnamet 		= $customer_data->Rs("cus_name");
		$addresst 		= $customer_data->Rs("cus_address");
		$cntt      		= $customer_data->Rs("cus_cnt_id");
		$prvt 			= $customer_data->Rs("cus_prv_id");	
		$userid 			= $customer_data->Rs("cus_usr_id");
		$shipaddress 	= $customer_data->Rs("cus_shipaddress");	
		$billaddress 	= $customer_data->Rs("cus_billaddress");	
	}
						
	$user_data = new Csql();
	$user_data->Connect();
	$user_data->Query("select * from userdental where userdentalid=$userid limit 1");
	if(!$user_data->EOF) {
		$username = $user_data->Rs("usr_username");
	}
?>
 <input name="cusid" type="hidden" id="cusid" value="<?=$cusid ?>">
                          <div align="left" style="height:500px"><br />
                            <table width="500" border="0" align="center" cellpadding="2" cellspacing="0">
                              <tr>
                                <td width="200"><strong><?=T_LABNAME;?></strong></td>
                                <td colspan="2">
                                  <input name="Lname" type="text" id="Lname" value="<?=$Lnamet ?>" style="width:300px" onmouseover="dToolTip('TEXTBOX_LABNAME')" />                                </td>
                              </tr>
                              <tr>
                                <td valign="top"><strong><?=T_ADDRESS;?></strong></td>
                                <td colspan="2" align="left" valign="top"><textarea name="address" cols="50" rows="3" id="address" style="width:300px"><?=$addresst; ?></textarea></td>
                              </tr>

                              <tr>
                                <td><strong><?=T_PROVINCE;?></strong></td>
                                <td colspan="2"><div id="DivShowProvince" overflow:auto >
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
                                <td><strong><?=T_COUNTRY;?></strong></td>
                        <td colspan="2">
                                    <select name="Ctry" id="Ctry" onchange="showHTML('DivShowProvince','queryprovince.php?prvid='+this.value);">
                                    
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
                                    </select>                                 </td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td colspan="2" align="right"><input type="button" onclick="setValue('shipaddress',getValue('address'));return 0;" value="<?=T_CPFA;?>" onmouseover="dToolTip('BUTTON_COPYADDRESS')" /></td>
                              </tr>
                              <tr>                              </tr>
                              <tr>
                                <td valign="top"><strong><?=T_SENDING;?><br />
                                  <?=T_ADDRESS;?></strong></td>
                                <td colspan="2"><textarea name="shipaddress" id="shipaddress" cols="50" rows="3" style="width:300px"><?=$shipaddress?></textarea></td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td colspan="2">&nbsp;</td>
                              </tr>
                              <tr>
                                <td>&nbsp;</td>
                                <td colspan="2" align="right"><input type="button" onclick="setValue('billaddress',getValue('address'));return 0;" value="<?=T_CPFA;?>" onmouseover="dToolTip('BUTTON_COPYADDRESS')"/></td>
                              </tr>
                              <tr>
                                <td valign="top"><strong><?=T_BILLING;?><br />
                                  <?=T_ADDRESS;?></strong></td>
                                <td colspan="2"><textarea name="billaddress" id="billaddress" cols="50" rows="3" style="width:300px"><?=$billaddress?></textarea></td>
                              </tr>
                              <tr>
                                <td><strong>Username</strong></td>
                                <td colspan="2">&nbsp;<?=$username?><!--input name="username" type="text" id="username" value="<?=$username?>" style="width:100px" onmouseover="dToolTip('TEXTBOX_USERNAME')" /--></td>
                                <input type="hidden" name="uid" id="uid" value="<?=$userid?>" />
                              </tr>
                              <tr>
                                <td><strong>New Password</strong></td>
                                <td colspan="2"><input name="newpasswd" type="password" id="newpasswd" style="width:100px" onmouseover="dToolTip('TEXTBOX_NEWPASSWORD')" /></td>
                              </tr>
                              <tr>
                                <td><strong>Retype <br />New Password</strong></td>
                                <td colspan="2"><input name="vpasswd" type="password" id="vpasswd" style="width:100px" onmouseover="dToolTip('TEXTBOX_RETYPEPASSWORD')" /></td>
                              </tr>
                              <tr>
                                <td><strong>Old Password <br />(Need for change password)</strong></td>
                                <td colspan="2"><input name="oldpasswd" type="password" id="oldpasswd" style="width:100px" onmouseover="dToolTip('TEXTBOX_OLDPASSWORD')" /></td>
                              </tr>
                            </table>
                          </div>
                          </form>
                          <div align="right">
                            <table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999" style="margin:5px">
                              <tr>
                                <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="Loading();profileupdate.submit();"><img src="../resource/images/silkicons/disk.gif" /> <?=T_SAVE;?> </td>
                              </tr>
                            </table>
                          </div>
                          <? include "tbframef.php"?>
                    </div>                </td>
            <td width="300" align="center" valign="top">
                      <br />                         
					  <?  include "../cfrontend/order_tooltip.php" ?>

          </td>
                  </tr>
    </table></td>
  </tr>
</table>
<script type="text/javascript">
			showHTML("DivShowStatus","../cfrontend/profile_process.php?act=<?=$ajax_action?>&err=<?=$ajax_error?>");
</script>
<? include "footer.php" ?>
