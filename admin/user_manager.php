<? include_once("../admin/header.php"); ?>
<? /* */ include_once "../resource/divbackground.php" ?>
<div id="DivStatus"></div>
<table width="100%" border="0" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td colspan="2" class="HeaderW"> 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td class="HeaderW"><img src="../resource/images/silkicons/group.gif"><?=$group_name?> list</td>
              <td class="Normal" align="right">Found <?=$totalrow?> <?=$group_name?> in <?=$totalpage?> pages</td>
            </tr>
          </table></td>
      </tr>
	  <form name="FormSearch" action="../admin/user_manager_c.php" method="get">
      <input type="hidden" name="gr" id="gr" value="<?=$group?>" />
      <input type="hidden" name="enable" id="enable" value="<?=$enable_staff?>" />
      <input type="hidden" name="disable" id="disable" value="<?=$disable_staff?>" />	
      <tr>
        <td align="left" bgcolor="#FFFFFF" class="searchTD">Choose <?=($group == "ST") ? "Section" : "Country"?> 
<?
	if($group == "ST") {
?>
          <select name="section" id="section" onChange="FormSearch.submit();" style="display:none">
      <?							
                                $data = new CSql();
								$data->Connect();
								
								$data->Query("SELECT * FROM section order by sec_type");		
								
								echo "<option value=\"0\">All Section</option>";
								while(!$data->EOF){
		
									$sid 		= $data->Rs("sectionID");
									$sname ="";
									switch($data->Rs("sec_type")) {
										case "F": $sname = "[ Fix ] "; break;
										case "R": $sname = "[ Remove ] "; break;
										case "O": $sname = "[ Ortho ] "; break;
										case "M": $sname = "[ Mics ] "; break;
									}
									$sname.= $data->Rs("sec_room");
										
									if($section == $sid)
										echo "<option selected=\"selected\" value=\"".$sid."\">".$sname."</option>";
									else
										echo "<option value=\"".$sid."\">".$sname."</option>";	
			
									$data->MoveNext();
									}
								?>
    		</select><br />
			<input type="checkbox" name="en" id="en" onchange="setValue('enable',this.checked+0);" <?=$enable_staff ? " checked" : " "?> />&nbsp;Enable &nbsp;
            <input type="checkbox" name="di" id="di" onchange="setValue('disable',this.checked+0);"<?=$disable_staff ? " checked" : " "?> />&nbsp;Disable
<?
	} else {
?>
          <select name="country" id="country" onChange="FormSearch.submit();" style="display:none">
      <?							
                                $country_data = new CSql();
								$country_data->Connect();
								
								$country_data->Query("SELECT * FROM country");		
								
								echo "<option selected=\"selected\" value=\"0\">All Country</option>";
								while(!$country_data->EOF){
		
								$cid 		= $country_data->Rs("countryid");
								$cname	 	= $country_data->Rs("cnt_name");
								$cnick 		= $country_data->Rs("cnt_nick");
									
								if($country_id == $cid)
								echo "<option selected=\"selected\" value=\"".$cid."\">".$cname."</option>";
								else
								echo "<option value=\"".$cid."\">".$cname."</option>";	
			
								$country_data->MoveNext();
									}
								?>
    		</select>
<? } ?>
		</td>
        <td align="right" bgcolor="#FFFFFF" class="searchTD" width="220"><input type="text" name="keyword" style="width:150px" value="<?=$keyword?>" />&nbsp;<input type="submit" class="BTsearch"value="Search"></td>
      </tr>
	  </form>
      <tr>
        <td colspan="2" align="center" bgcolor="#FFFFFF">
<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
	if($totalpage>1){
		if($page!=1){
			echo "<a href=\"../admin/user_manager_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
	?></td><td width="50"><?
		if($page>1){
			echo "<a href=\"../admin/user_manager_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	?></td><td align="center" width="300"><?
		for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
			if($p==$page){
				echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
			}else{
				echo "&nbsp;&nbsp;<a href=\"../admin/user_manager_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
			}
		} 
	?></td><td width="50" align="right"><? 
		if($page<$totalpage){
			echo "<a href=\"../admin/user_manager_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	?></td><td width="50" align="right"><? 
		if($page!=$totalpage){
			echo "<a href=\"../admin/user_manager_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	}
	?></td></tr></table>		</td>
      </tr>
      <tr>
        <td colspan="2" bgcolor="#FFFFFF">
<? 
	switch($group) {
		case "ST":
			?>
<!------------------------------------------ Staff Table ------------------------------------------>
		<table width="100%"  border="0" cellpadding="2" cellspacing="2">
			<tr align="center">
			    <td class="HeaderTable" width="100">Username</td>	    
			    <td class="HeaderTable" >Staff Name</td>
                <td class="HeaderTable" >Section Room</td>
                <td class="HeaderTable" width="80">Status</td>
                <td class="HeaderTable" width="60">Operation</td>
		      </tr>
<? while(!$user_data->EOF) { 
		$userid = $user_data->Rs("userdentalid");
		$staffid = $user_data->Rs("staffid");
		$stf_enable = $user_data->Rs("stf_enable");
?>
			  <tr id="tr_<?=$staffid?>" class="tdRowOnOut" style="<?=$stf_enable?'':'text-decoration:line-through'?>" valign="top" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className=''">
				<td onclick="OpenDivShowUserData('ST',<?=($userid != "") ? $userid : 0 ?>,<?=$staffid?>,0);"><div id="DivStatus<?=$user_data->Rs("userdentalid")?>"><?= $user_data->Rs("usr_username"); ?></div></td>
				<td onclick="OpenDivShowUserData('ST',<?=($userid != "") ? $userid : 0 ?>,<?=$staffid?>,0);">&nbsp;<?= $user_data->Rs("stf_name") ?></td>
				<td align="left" onclick="OpenDivShowUserData('<?=$group?>',<?=($userid != "") ? $userid : 0 ?>,<?=$staffid?>,0);">&nbsp;<?= $user_data->Rs("sec_room") ?></td>
				<td  align="center"  onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className=''" onclick="showHTML('DivActive<?=$user_data->Rs("userdentalid")?>','../admin/user_process.php?act=chst&gr=ST&uid=<?=($user_data->Rs("userdentalid") != "") ? $user_data->Rs("userdentalid") : 0 ?>');">				
                <div id="DivActive<?=$user_data->Rs("userdentalid")?>"> <?= $user_data->Rs("usr_status"); ?></div>
</td>
                <td align="center"><table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                  <tr>
                    <td width="30" align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className='tdButtonOnOutS'"
                    onclick="OpenDivEditUserData('<?=$group?>',<?=($userid != "") ? $userid : 0 ?>,<?=$staffid?>,0);"><img src="../resource/images/silkicons/user_edit.gif" alt="Edit"/></td>
                    <td width="30" align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className='tdButtonOnOutS'"
					onclick="if(confirm('Are you sure u want to delete this user?')) {showHTML('DivStatus<?=$user_data->Rs("userdentalid")?>','../admin/user_process.php?gr=ST&act=del&uid=<?=$user_data->Rs("userdentalid")?>&sid=<?=$staffid?>',function(){ $('#tr_<?=$staffid?>').css('text-decoration','line-through');});}"><img src="../resource/images/silkicons/user_delete.gif" alt="Delete"/></td>
                  </tr>
                </table></td>
			  </tr>	
<? $user_data->MoveNext();	} ?>
            </table>		
<? 
			break;
		case "CM":
?>
<!------------------------------------------ Customer Table ------------------------------------------>
		<table width="100%"  border="0" cellpadding="2" cellspacing="2">
			<tr align="center">
			    <td class="HeaderTable" width="100">Username</td>	    
			    <td class="HeaderTable" >Lab Name</td>
                <td class="HeaderTable" >Province</td>
                <td class="HeaderTable" width="80">Status</td>
                <td class="HeaderTable" width="60">Operation</td>
		      </tr>
<? while(!$user_data->EOF) { 
		$userid = $user_data->Rs("userdentalid");
		$customerid = $user_data->Rs("customerid");
?>
			  <tr class="tdRowOnOut" valign="top" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className=''">
				<td onclick="OpenDivShowUserData('CM',<?=($userid != "") ? $userid : 0 ?>,0,<?=$customerid?>);"><div id="DivStatus<?=$user_data->Rs("userdentalid")?>"><?= $user_data->Rs("usr_username"); ?></div></td>
				<td onclick="OpenDivShowUserData('CM',<?=($userid != "") ? $userid : 0 ?>,0,<?=$customerid?>);">&nbsp;<?= $user_data->Rs("cus_name")?></td>
				<td onclick="OpenDivShowUserData('CM',<?=($userid != "") ? $userid : 0 ?>,0,<?=$customerid?>);">&nbsp;<?= $user_data->Rs("prv_name"); ?></td>
				<td  align="center"  onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className=''" onclick="showHTML('DivActive<?=$user_data->Rs("userdentalid")?>','../admin/user_process.php?act=chst&gr=CM&uid=<?=($user_data->Rs("userdentalid") != "") ? $user_data->Rs("userdentalid") : 0 ?>');">
				<div id="DivActive<?=$user_data->Rs("userdentalid")?>"> <?= $user_data->Rs("usr_status"); ?></div>
                </td>
                <td align="center"><table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                  <tr>
                    <td width="30" align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className='tdButtonOnOutS'"
                    onclick="OpenDivEditUserData('<?=$group?>',<?=($userid != "") ? $userid : 0 ?>,0,<?=$customerid?>);"><img src="../resource/images/silkicons/user_edit.gif" alt="Edit"/></td>
                    <td width="30" align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className='tdButtonOnOutS'"
					onclick="if(confirm('Are you sure u want to delete this user?')) {showHTML('DivStatus<?=$user_data->Rs("userdentalid")?>','../admin/user_process.php?gr=CM&act=del&uid=<?=$user_data->Rs("userdentalid");?>&cid=<?=$user_data->Rs("customerid")?>');}"><img src="../resource/images/silkicons/user_delete.gif" alt="Delete"/></td>
                  </tr>
                </table></td>
			  </tr>	
<? $user_data->MoveNext();	} ?>
          </table>		
<?
			break;
		case "MN":
?>
<!------------------------------------------ Manager Table ------------------------------------------>
		<table width="100%"  border="0" cellpadding="2" cellspacing="2">
			<tr align="center">
			    <td class="HeaderTable" width="100">Username</td>	    
			    <td class="HeaderTable" >Manager Name</td>
                <td class="HeaderTable" width="80">Status</td>
                <td class="HeaderTable" width="60">Operation</td>
		      </tr>
<? while(!$user_data->EOF) { 
		$userid = $user_data->Rs("userdentalid");
?>
			  <tr class="tdRowOnOut" valign="top" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className=''">
				<td onclick="OpenDivShowUserData('MN',<?=$userid?>,0,0);"><div id="DivStatus<?=$user_data->Rs("userdentalid")?>"><?= $user_data->Rs("usr_username"); ?></div></td>
				<td onclick="OpenDivShowUserData('MN',<?=$userid?>,0,0);">&nbsp;<?= $user_data->Rs("usr_fname")." ".$user_data->Rs("usr_sname")?></td>
				<td  align="center"  onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className=''" onclick="showHTML('DivActive<?=$user_data->Rs("userdentalid")?>','../admin/user_process.php?act=chst&gr=MN&uid=<?=($user_data->Rs("userdentalid") != "") ? $user_data->Rs("userdentalid") : 0 ?>');">				
                <div id="DivActive<?=$user_data->Rs("userdentalid")?>"> <?= $user_data->Rs("usr_status"); ?></div>
</td>
                <td align="center"><table border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">
                  <tr>
                    <td width="30" align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className='tdButtonOnOutS'"
                    onclick="OpenDivEditUserData('<?=$group?>',<?=$userid?>,0,0);"><img src="../resource/images/silkicons/user_edit.gif" alt="Edit"/></td>
                    <td width="30" align="center" class="tdButtonOnOutS" 
                    onmouseover="this.className='tdButtonOnOverS'" onmouseout="this.className='tdButtonOnOutS'"
					onclick="if(confirm('Are you sure u want to delete this user?')) {showHTML('DivStatus<?=$user_data->Rs("userdentalid")?>','../admin/user_process.php?gr=MN&act=del&uid=<?=$user_data->Rs("userdentalid");?>');}"><img src="../resource/images/silkicons/user_delete.gif" alt="Delete"/></td>
                  </tr>
                </table></td>
			  </tr>	
<? $user_data->MoveNext();	} ?>
          </table>		
<?
			break;
	} 
?>
        </td>
      </tr>
      <tr>
        <td colspan="2" align="center" bgcolor="#FFFFFF">
<table cellspacing="0" cellpadding="0"><tr><td width="50"><?
	if($totalpage>1){
		if($page!=1){
			echo "<a href=\"../admin/user_manager_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
	?></td><td width="50"><?
		if($page>1){
			echo "<a href=\"../admin/user_manager_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	?></td><td align="center" width="300"><?
		for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
			if($p==$page){
				echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
			}else{
				echo "&nbsp;&nbsp;<a href=\"../admin/user_manager_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
			}
		} 
	?></td><td width="50" align="right"><? 
		if($page<$totalpage){
			echo "<a href=\"../admin/user_manager_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	?></td><td width="50" align="right"><? 
		if($page!=$totalpage){
			echo "<a href=\"../admin/user_manager_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
	}
	?></td></tr></table>		</td>
      </tr>
      <tr>
        <td colspan="2" class="FooterTD" align="right"><button onclick="OpenDivAddUserData('<?=$group?>',-1,-1,-1);"><img src="../resource/images/silkicons/user_add.gif" alt="Add User" /> Add New <?=$group_name?></button></td>
      </tr>
    </table>

<div id="DivEditUserData" style="position:absolute;left:0px;top:500px;width:718px;height:400px;z-index:1;">
  <? $tbframeheader = "Edit User Data"?>
  <? $tbframehclose = "CloseDivEditUserData()";?>
  <? include "../cfrontend/tbframeh.php"?>
  <div id="DivUserData" style="overflow:auto;width:700px;height:350px"></div>
  <? include "../cfrontend/tbframef.php"?>
</div>

<div id="DivShowUserData" style="position:absolute;left:0px;top:500px;width:718px;height:400px;z-index:1;">
  <? $tbframeheader = "User Information"?>
  <? $tbframehclose = "CloseDivShowUserData()";?>
  <? include "../cfrontend/tbframeh.php"?>
  <div id="DivUserInfo" style="overflow:auto;width:700px;height:350px"></div>
  <? include "../cfrontend/tbframef.php"?>
</div>

<script>
function OpenDivEditUserData(group,userid,staffid,customerid)
{
	activeBG();
	showHideLayers('DivEditUserData','','show');
	makeCenterScreen('DivEditUserData');
	showHTML('DivUserData','../admin/user_edit_c.php?act=edit&gr='+group+'&uid='+userid+'&sid='+staffid+'&cid='+customerid);
}
function OpenDivAddUserData(group,userid,staffid,customerid)
{
	activeBG();
	showHideLayers('DivEditUserData','','show');
	makeCenterScreen('DivEditUserData');
	showHTML('DivUserData','../admin/user_edit_c.php?act=add&gr='+group+'&uid='+userid+'&sid='+staffid+'&cid='+customerid);
}

function OpenDivShowUserData(group,userid,staffid,customerid)
{
	activeBG();
	showHideLayers('DivShowUserData','','show');
	makeCenterScreen('DivShowUserData');
	showHTML('DivUserInfo','../admin/user_info_c.php?gr='+group+'&uid='+userid+'&sid='+staffid+'&cid='+customerid);
}
function CloseDivEditUserData()
{
	hideBG();
	showHideLayers('DivEditUserData','','hide');
}
function CloseDivAddUserData()
{
	hideBG();
	showHideLayers('DivEditUserData','','hide');
}
function CloseDivShowUserData()
{
	hideBG();
	showHideLayers('DivShowUserData','','hide');
}
showHideLayers('DivEditUserData','','hide');
showHideLayers('DivAddUserData','','hide');
showHideLayers('DivShowUserData','','hide');
hideLoading();
</script>

<? include_once("../admin/footer.php"); ?>