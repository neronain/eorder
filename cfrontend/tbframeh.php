<table width="100%" border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="8" height="40" valign="bottom"><img src="../cfrontend/images/bg_03.png" width="8" height="40" /></td>
                  <td height="40" background="../cfrontend/images/bg_04.png"  align="left" >
                  <table width="100%" border="0" cellpadding="0" cellspacing="0"><tr><td class="frameHeader">
				  <?=$tbframeheader?></td>
                  
				  	<? if(isset($tbframehclose) && $tbframehclose!=''){?> 
                    <? if(!isset($tbframehclose2))$tbframehclose2=''; ?>
                  	<td width="25" align="right">
                    <img src="../resource/images/silkicons/cross.gif" onclick="<?=$tbframehclose.";".$tbframehclose2 ?>" style="cursor:pointer;"  /></td>
					<? $tbframehclose='';$tbframehclose2='';} ?>
                    
                    
				  	<? if(isset($tbframehscript) && $tbframehscript!=''){?> 
                  	<td align="right">
                    <?= $tbframehscript ?>  
                    </td>
					<? $tbframehscript='';$tbframehscript='';} ?>
                    <td width="13"></td>
                    
                  </tr></table>
                  </td>
                  <td width="10" height="40" valign="bottom"><img src="../cfrontend/images/bg_06.png" width="10" height="40"  /></td>
                </tr>
              <tr>
                <td background="../cfrontend/images/bg_08.png"></td>
                  <td align="left" valign="top" bgcolor="#FFFFFF">
                  
                  
                  
                  
                  
