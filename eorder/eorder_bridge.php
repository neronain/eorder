
<!-- 
Default javascript
//Function javascript พื้นฐาน เอาไว้ใช้นะครับ 
function writeit(objID,text);
function makeCenterScreen(objID);
function showHideLayers();// Example: showHideLayers(Layer1,'','show',Layer2,'','hide');
function setBG(objID,color);
function findObj(objID);
function setFocus(objID);
function activeBG();
function hideBG();
function setValue(objID,val);
-->

<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<? // ------------------------------------------------------------------------------- ?>
<style type="text/css">
<!--
.style1 {font-size: 14px}
.style2 {font-size: 16px}
-->
</style>
<div id="DivBridgeSelector" style="position:absolute; white-space:nowrap; left:0px; top:0px; width:400px; height:500px; z-index:1; margin:0;<?="display:none;"?>">
<? $tbframeheader = "Bridge selector"?>
<? $tbframehclose = "CloseDivBridgeSelector()";?>
<? include "../cfrontend/tbframeh.php"?>
Click between the teeth to bridge<br />


<table width="320" border="0" align="center" cellpadding="0" cellspacing="0" background="../resource/images/eorder/fix/bridgebg2.gif">
<tr>
	<td>
    
	  <table width="320" border="0" cellpadding="0" cellspacing="0">
        <tr>
          <td height="10">&nbsp;</td>
          </tr>
        <tr>
          <td height="6"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="138" height="14">&nbsp;</td>
              <td width="32" align="center" valign="bottom" bgcolor=""  class="ClickAble" onclick="bridge_set(7)" ><img src="../resource/images/eorder/fix/bridge_n.gif" width="26" height="5" border="0" id="ImgBridge7" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="16"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="107" height="22">&nbsp;</td>
              <td width="40" bgcolor=""  class="ClickAble"  onclick="bridge_set(6)" ><img src="0.gif" width="40" height="18" border="0" id="ImgBridge6" ></td>
              <td width="15" height="18">&nbsp;</td>
              <td width="40" bgcolor=""  class="ClickAble"  onclick="bridge_set(8)" ><img src="0.gif" width="40" height="18" border="0" id="ImgBridge8" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="82" height="22">&nbsp;</td>
              <td width="40" bgcolor=""  class="ClickAble"  onclick="bridge_set(5)" ><img src="0.gif" width="40" height="18" border="0" id="ImgBridge5" ></td>
              <td width="63" height="22">&nbsp;</td>
              <td width="40" bgcolor=""  class="ClickAble"  onclick="bridge_set(9)" ><img src="0.gif" width="40" height="18" border="0" id="ImgBridge9" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="70">&nbsp;</td>
              <td width="32" align="center" bgcolor=""  class="ClickAble"  onclick="bridge_set(4)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge4" ></td>
              <td width="105" height="22">&nbsp;</td>
              <td width="32" bgcolor=""  class="ClickAble" onclick="bridge_set(10)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge10" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="56">&nbsp;</td>
              <td width="30" align="center" bgcolor=""  class="ClickAble" onclick="bridge_set(3)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge3" ></td>
              <td width="136" height="22">&nbsp;</td>
              <td width="30" align="center" bgcolor=""  class="ClickAble" onclick="bridge_set(11)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge11" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="50">&nbsp;</td>
              <td width="25" bgcolor=""  class="ClickAble"  onclick="bridge_set(2)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge2" ></td>
              <td width="160" height="22">&nbsp;</td>
              <td width="25" bgcolor=""  class="ClickAble"  onclick="bridge_set(12)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge12" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="42">&nbsp;</td>
              <td width="25" bgcolor=""  class="ClickAble"  onclick="bridge_set(1)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge1" ></td>
              <td width="175" height="22">&nbsp;</td>
              <td width="25" bgcolor=""  class="ClickAble"  onclick="bridge_set(13)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge13" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="36">&nbsp;</td>
              <td width="25" bgcolor=""  class="ClickAble"  onclick="bridge_set(0)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge0" ></td>
              <td width="187" height="22">&nbsp;</td>
              <td width="25" bgcolor=""  class="ClickAble"  onclick="bridge_set(14)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge14" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="44"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="35" height="44">&nbsp;</td>
              <td width="20" bgcolor="">&nbsp;</td>
              <td width="198" height="44">&nbsp;</td>
              <td width="20" bgcolor="">&nbsp;</td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="36" height="22">&nbsp;</td>
              <td width="25" height="22" bgcolor=""  class="ClickAble"  onclick="bridge_set(30)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge30" ></td>
              <td width="187" height="22">&nbsp;                </td>
              <td width="25" height="22" bgcolor=""  class="ClickAble"  onclick="bridge_set(16)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge16" ></td>
              <td height="22">&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="42" height="22">&nbsp;</td>
              <td width="25" height="22" bgcolor=""  class="ClickAble"  onclick="bridge_set(29)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge29" ></td>
              <td width="175" height="22">&nbsp;</td>
              <td width="25" height="22" bgcolor=""  class="ClickAble"  onclick="bridge_set(17)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge17" ></td>
              <td height="22">&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="50">&nbsp;</td>
              <td width="25" bgcolor=""  class="ClickAble"  onclick="bridge_set(28)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge28" ></td>
              <td width="160" height="22">&nbsp;</td>
              <td width="25" bgcolor=""  class="ClickAble"  onclick="bridge_set(18)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge18" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="56">&nbsp;</td>
              <td width="30" align="right" bgcolor=""  class="ClickAble"  onclick="bridge_set(27)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge27" ></td>
              <td width="136" height="22">&nbsp;</td>
              <td width="30" bgcolor=""  class="ClickAble"  onclick="bridge_set(19)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge19" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
          </tr>
        <tr>
          <td height="24"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="70">&nbsp;</td>
              <td width="32" bgcolor=""  class="ClickAble"  onclick="bridge_set(26)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge26" ></td>
              <td width="105" height="22">&nbsp;</td>
              <td width="32" bgcolor=""  class="ClickAble"  onclick="bridge_set(20)" ><img src="0.gif" width="25" height="22" border="0" id="ImgBridge20" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="22"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="82">&nbsp;</td>
              <td width="40" bgcolor=""  class="ClickAble"  onclick="bridge_set(25)" ><img src="0.gif" width="40" height="18" border="0" id="ImgBridge25" ></td>
              <td width="63" height="22">&nbsp;</td>
              <td width="42" bgcolor=""  class="ClickAble"  onclick="bridge_set(21)" ><img src="0.gif" width="40" height="18" border="0" id="ImgBridge21" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="20"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="107" height="18">&nbsp;</td>
              <td width="40" height="18" bgcolor=""  class="ClickAble"  onclick="bridge_set(24)" ><img src="0.gif" width="40" height="18" border="0" id="ImgBridge24" ></td>
              <td width="15" height="18">&nbsp;</td>
              <td width="40" height="18" bgcolor=""  class="ClickAble"  onclick="bridge_set(22)" ><img src="0.gif" width="40" height="18" border="0" id="ImgBridge22" ></td>
              <td height="18">&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="14"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td width="138" height="14">&nbsp;</td>
              <td width="32" align="center" valign="top" bgcolor=""  class="ClickAble"  onclick="bridge_set(23)" ><img src="0.gif" width="26" height="5" border="0" id="ImgBridge23" ></td>
              <td>&nbsp;</td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="24">&nbsp;</td>
          </tr>
      </table>
</td>
</tr>
</table>
<br />
<? include "../cfrontend/tbframef.php"?>
</div>
<?php
//echo $name[0] . " ".$image[0]." ".$idvalue[0]." ".$description[0];
?>
<script type="text/javascript">
var bridge_teeth_select;

function bridge_set(bridgenumber,value)
{
	bridge_teeth_select = bridgenumber;
	isSelect = findObj('fix_bridge['+bridgenumber+']').value;
	//alert (teethnumber);
	if(bridgenumber<=4)
		filename = '../resource/images/eorder/fix/bridge_1.gif';
	else if(bridgenumber<=6)
		filename = '../resource/images/eorder/fix/bridge_4.gif';
	else if(bridgenumber==7 || bridgenumber==23)
		filename = '../resource/images/eorder/fix/bridge_5.gif';
	else if(bridgenumber<=9)
		filename = '../resource/images/eorder/fix/bridge_3.gif';
	else if(bridgenumber<=14)
		filename = '../resource/images/eorder/fix/bridge_2.gif';
	else if(bridgenumber<=20)
		filename = '../resource/images/eorder/fix/bridge_1.gif';
	else if(bridgenumber<=22)
		filename = '../resource/images/eorder/fix/bridge_4.gif';
	else if(bridgenumber<=25)
		filename = '../resource/images/eorder/fix/bridge_3.gif';
	else if(bridgenumber<=30)
		filename = '../resource/images/eorder/fix/bridge_2.gif';
	
	if(value){
		findObj('fix_bridge['+bridgenumber+']').value = value;
		findObj('ImgBridge'+bridgenumber).src = value==1?filename:'../cfrontend/images/spacer.gif';
	}else{
		if(isSelect == 1){
			//alert('unattach');
			findObj('fix_bridge['+bridgenumber+']').value = 0;
			findObj('ImgBridge'+bridgenumber).src = '../cfrontend/images/spacer.gif';
		}else{
			//alert('attach');
			findObj('fix_bridge['+bridgenumber+']').value = 1;
			findObj('ImgBridge'+bridgenumber).src = filename;
		}

	}
}
function SetupFixBridge(){
	for(i=0;i<31;i++){
		if(i==15)continue;
		if(i<=4)
			filename = '../resource/images/eorder/fix/bridge_1.gif';
		else if(i<=6)
			filename = '../resource/images/eorder/fix/bridge_4.gif';
		else if(i==7 || i==23)
			filename = '../resource/images/eorder/fix/bridge_5.gif';
		else if(i<=9)
			filename = '../resource/images/eorder/fix/bridge_3.gif';
		else if(i<=14)
			filename = '../resource/images/eorder/fix/bridge_2.gif';
		else if(i<=20)
			filename = '../resource/images/eorder/fix/bridge_1.gif';
		else if(i<=22)
			filename = '../resource/images/eorder/fix/bridge_4.gif';
		else if(i<=25)
			filename = '../resource/images/eorder/fix/bridge_3.gif';
		else if(i<=30)
			filename = '../resource/images/eorder/fix/bridge_2.gif';		

		isSelect = findObj('fix_bridge['+i+']').value;
		findObj('ImgBridge'+i).src = isSelect==1?filename:'../cfrontend/images/spacer.gif';
	}
}
function OpenDivBridgeSelector()
{
	activeBG();
	makeCenterScreen('DivBridgeSelector');
	showHideLayers('DivBridgeSelector','','show');
}
function CloseDivBridgeSelector()
{
	hideBG();
	showHideLayers('DivBridgeSelector','','hide');
}

showHideLayers('DivBridgeSelector','','hide');
//showHideLayers('DivBridgeSelector','','show');

</script>


