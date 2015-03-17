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

<div id="DivRemoveTypeSelector"
style="position:absolute; white-space:nowrap; left:0px; top:0px; width:500px; height:400px; z-index:1; margin:0;<?="display:none;"?>"
>
<? $tbframeheader = "Remove Type selector Upper"?>
<? $tbframehclose = "CloseDivRemoveTypeSelectorNoEffect()";?>
<? include "../cfrontend/tbframeh.php"?><br />
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <div id="DivMainRemoveType">
    <table width="200" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
      <tr>
        <td height="30" align="center" class="tdRowOnOut" onclick="removetype_setvalue(0,'0')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">NONE</td>
      </tr>
      <tr>
        <td height="30" align="center" class="tdRowOnOut" onclick="removetype_setvalue(0,'A')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">RPD</td>
      </tr>
      <tr>
        <td height="30" align="center" class="tdRowOnOut" onclick="removetype_setvalue(0,'B')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">TP</td>
      </tr>
      <tr>
        <td height="30" align="center" class="tdRowOnOut" onclick="removetype_setvalue(0,'C')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Acetal</td>
      </tr>
      <tr>
        <td height="30" align="center" class="tdRowOnOut" onclick="removetype_setvalue(0,'D')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Hexa-Flex</td>
      </tr>
      <tr>
        <td height="30" align="center" class="tdRowOnOut" onclick="removetype_setvalue(0,'H')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Removeable Bridge</td>
      </tr>
      <tr>
        <td height="30" align="center" class="tdRowOnOut" onclick="removetype_setvalue(0,'E')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Order spacial Tray</td>
      </tr>
      <tr>
        <td height="30" align="center" class="tdRowOnOut" onclick="removetype_setvalue(0,'F')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Bite Block</td>
      </tr>
      <tr>
        <td height="30" align="center" class="tdRowOnOut" onclick="removetype_setvalue(0,'G')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Order spacial Tray + Bite Block</td>
      </tr>
    </table>
</div>    
<div id="DivOptionRemoveType1">
<table width="480" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
  <tr>
    <td width="240"  class="tdRowOnOut" onclick="removetype_setvalue(1,'A')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'"><img src="../resource/images/eorder/remove/t_full_plate.gif" width="48" height="48" /> Full plate</td>
    <td  class="tdRowOnOut" onclick="removetype_setvalue(1,'G')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'"><img src="../resource/images/eorder/remove/t_horseshoe_plate.gif" width="48" height="48" /> Horseshoe Plate</td>
  </tr>
   <tr>
     <td width="240"  class="tdRowOnOut" onclick="removetype_setvalue(1,'B')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'"><img src="../resource/images/eorder/remove/t_lingual_plate.gif" width="48" height="48" /> Lingual Plate</td>
    <td  class="tdRowOnOut" onclick="removetype_setvalue(1,'H')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'"><img src="../resource/images/eorder/remove/t_ackers_acetal.gif" width="48" height="48" /> Ackers METAL</td>
  </tr>
  <tr>
    <td width="240"  class="tdRowOnOut" onclick="removetype_setvalue(1,'C')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'"><img src="../resource/images/eorder/remove/t_lingual_bar.gif" width="48" height="48" /> Lingual Bar</td>
    <td  class="tdRowOnOut" onclick="removetype_setvalue(1,'I')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Rebase</td>
  </tr>
  <tr>
    <td width="240"  class="tdRowOnOut" onclick="removetype_setvalue(1,'D')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'"><img src="../resource/images/eorder/remove/t_kennedy_bar.gif" width="48" height="48" /> Kennedy Bar</td>
    <td  class="tdRowOnOut" onclick="removetype_setvalue(1,'J');setValue('remove_option[Removework]','Repair');setValue('remove_method','Repair');findObj('tmpRadioWorkRepair').checked=true;" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Repair</td>
  </tr>
  <tr>
    <td width="240"  class="tdRowOnOut" onclick="removetype_setvalue(1,'E')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'"><img src="../resource/images/eorder/remove/t_palatal_strap.gif" width="48" height="48" /> Palatal Strap (minimal coverage)</td>
    <td  class="tdRowOnOut" onclick="removetype_setvalue(1,'K')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Adjunction</td>
  </tr>
  <tr>
    <td class="tdRowOnOut" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'" onclick="removetype_setvalue(1,'F')"><img src="../resource/images/eorder/remove/t_skeleton_design.gif" width="48" height="48" /> Skeleton Design</td>
    <td class="tdRowOnOut" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'" onclick="removetype_setvalue(1,'L')">Non Design</td>
  </tr>
</table>
</div>
<div id="DivOptionRemoveType2">
<table border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
  <tr>
    <td width="200" height="30"  class="tdRowOnOut" onclick="removetype_setvalue(2,'A')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Block Out &amp; Duplicate Technique</td>
    <td width="200" height="30"  class="tdRowOnOut" onclick="removetype_setvalue(2,'E')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Reline</td>
  </tr>
  <tr>
    <td width="200" height="30"  class="tdRowOnOut" onclick="removetype_setvalue(2,'B')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Full denture</td>
    <td width="200" height="30"  class="tdRowOnOut" onclick="removetype_setvalue(2,'F')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Addition</td>
  </tr>
  <tr>
    <td width="200" height="30"  class="tdRowOnOut" onclick="removetype_setvalue(2,'C')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Partial Denture</td>
    <td width="200" height="30"  class="tdRowOnOut" onclick="removetype_setvalue(2,'G')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Lingualized Occlusion</td>
  </tr>
  <tr>
    <td width="200" height="30"  class="tdRowOnOut" onclick="removetype_setvalue(2,'D')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Rebase</td>
    <td width="200" height="30"  class="tdRowOnOut" onclick="removetype_setvalue(2,'H')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Repair</td>
  </tr>
</table>
</div>    


<div id="DivOptionRemoveType3">
<table width="300" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000" table>
  <tr>
    <td height="30" class="tdRowOnOut" onclick="removetype_setvalue(3,'A')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Partial Denture</td>
  </tr>
  <tr>
    <td height="30" class="tdRowOnOut" onclick="removetype_setvalue(3,'B')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Removable Bridge</td>
  </tr>
    <tr>
    <td height="30" class="tdRowOnOut" onclick="removetype_setvalue(3,'C')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Special request ...</td>
  </tr>
</table>

</div>
<div id="DivOptionRemoveType4">
<table width="300" border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000" table>
  <tr>
    <td class="tdRowOnOut" onclick="removetype_setvalue(4,'A')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Acetal Tooth</td>
  </tr>
  <tr>
    <td class="tdRowOnOut" onclick="removetype_setvalue(4,'B')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Acetal Clasp</td>
  </tr>
  <tr>
    <td class="tdRowOnOut" onclick="removetype_setvalue(4,'C')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">All Acetal Frame Work</td>
  </tr>
  <tr>
    <td class="tdRowOnOut" onclick="removetype_setvalue(4,'D')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">All Acetal Removable Bridge</td>
  </tr>
  <tr>
    <td class="tdRowOnOut" onclick="removetype_setvalue(4,'E')" onmouseover="this.className='tdRowOnOver'" onmouseout="this.className='tdRowOnOut'">Acetal Swing Lock</td>
  </tr>
</table>

</div>


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
var part;
var texttype1='';
var texttype2='';
var texttype3='';
var texttype4='';
function removetype_initvalue(p,text)
{
	texttype1='';
	texttype2='';
	texttype3='';
	texttype4='';
	//alert(text);
	switch(text.charAt(0)){
		case '0':texttype1 = 'None';break;
		case 'A': {
			texttype1 = 'RPD';
			switch(text.charAt(1)){
				case '0':break;
				case 'A':texttype2 = ' + Full Plate';break;
				case 'B':texttype2 = ' + Lingual Plate';break;
				case 'C':texttype2 = ' + Lingual Bar';break;
				case 'D':texttype2 = ' + Kennedy Bar';break;
				case 'E':texttype2 = ' + Palatal Stap (minimal coverage)';break;
				case 'F':texttype2 = ' + Skeleton Design';break;
				case 'G':texttype2 = ' + Horseshoe Plate';break;
				case 'H':texttype2 = ' + Ackers METAL';break;
				case 'I':texttype2 = ' + Rebase';break;
				case 'J':texttype2 = ' + Pepair';break;
				case 'K':texttype2 = ' + Adiunction';break;
			}
			break;
		}
		case 'B': {
			texttype1 = 'TP';
			switch(text.charAt(1)){
				case '0':break;
				case 'A':texttype2 = ' + Block Out & Duplicate Technique';break;
				case 'B':texttype2 = ' + Full Denture';break;
				case 'C':texttype2 = ' + Partial Denture';break;
				case 'D':texttype2 = ' + Rebase';break;
				case 'E':texttype2 = ' + Reline';break;
				case 'F':texttype2 = ' + Addition';break;
				case 'G':texttype2 = ' + Lingualized Occlusion';break;
				case 'H':texttype2 = ' + Repair';break;
			}
			break;
		}
		case 'C': {
			texttype1 = 'Acetal';
			switch(text.charAt(1)){
				case 'A':texttype2 = ' + Acetal Tooth';break;
				case 'B':texttype2 = ' + Acetal Clasp';break;
				case 'C':texttype2 = ' + All Acetal Frame Work';break;
				case 'D':texttype2 = ' + All Acetal Removable Bridge';break;
				case 'E':texttype2 = ' + Acetal Swing Lock';break;
			}
			break;
		}
		case 'D': {
			texttype1 = 'Hexa-Flex';
			switch(text.charAt(1)){
				case '0':break;
				case 'A':texttype2 = ' + Partial Denture';break;
				case 'B':texttype2 = ' + Removable Bridge';break;
				case 'C':texttype2 = ' + Special Request';break;
			}
			break;
		}
		case 'E':texttype1 = 'Order spacial Tray,Bite Block';break;
	}
	writeit('TDRemoveType'+p,texttype1+texttype2+texttype3+texttype4);
	
	   showHideLayers('TABLE_RPD_ACRYLICFORFINISH','','hide');
		showHideLayers('TABLE_RPD_TEETHANDSETUP','','hide');
		showHideLayers('TABLE_RPD_GUMFIT','','hide');
		showHideLayers('TABLE_RPD_SPECIALREQUEST','','hide');
		showHideLayers('TABLE_TP_OrderAcrylic','','hide');
		showHideLayers('TABLE_TP_TPOrderGrid','','hide');
		showHideLayers('TABLE_SPBB','','hide');
		
		upvalue = findObj('remove_mat[upper]').value;
		lowvalue = findObj('remove_mat[lower]').value;

		if(upvalue.substring(0,1) == "A" || lowvalue.substring(0,1) == "A"){
			showHideLayers('TABLE_RPD_ACRYLICFORFINISH','','show');
			showHideLayers('TABLE_RPD_TEETHANDSETUP','','show');
			showHideLayers('TABLE_RPD_GUMFIT','','show');
			showHideLayers('TABLE_RPD_SPECIALREQUEST','','show');
		}
		
		if(upvalue.substring(0,1) == "B" || lowvalue.substring(0,1) == "B"){
			showHideLayers('TABLE_TP_OrderAcrylic','','show');
			showHideLayers('TABLE_TP_TPOrderGrid','','show');
		}
		
		if(upvalue.substring(0,1) == "E" || lowvalue.substring(0,1) == "E"){
			showHideLayers('TABLE_SPBB','','show');
		}
		
		if(upvalue.substring(0,1) == "F" || lowvalue.substring(0,1) == "F"){
			showHideLayers('TABLE_SPBB','','show');
		}
		
		if(upvalue.substring(0,1) == "G" || lowvalue.substring(0,1) == "G"){
			showHideLayers('TABLE_SPBB','','show');
		}
}

function removetype_setvalue(id,value){
	//alert("part = "+part+" id = "+id+" value = "+value);
	switch(id){
		case 0 :
			if(value=='0'){
				setValue('remove_mat['+part+']',value);
				//alert('remove_mat['+part+'] = '+findObj('remove_mat['+part+']').value);
				texttype1 = 'None';
				CloseDivRemoveTypeSelector();
			}else if(value=='A'){
				//findObj('remove_mat['+part+']').value[0] = value;
				setValue('remove_mat['+part+']',value);
				texttype1 = 'RPD';
				OpenDivRemoveTypeOption1();
			}else if(value=='B'){
				//alert("B");
				setValue('remove_mat['+part+']',value);
				//alert(findObj('remove_mat['+part+']').value);
				texttype1 = 'TP';
				OpenDivRemoveTypeOption2();
			}else if(value=='C'){
				setValue('remove_mat['+part+']',value);
				//alert(findObj('remove_mat['+part+']').value);
				texttype1 = 'Acetal';
				OpenDivRemoveTypeOption4();
			}else if(value=='D'){
				setValue('remove_mat['+part+']',value);
				//alert(findObj('remove_mat['+part+']').value);
				texttype1 = 'Hexa-Flex';
				OpenDivRemoveTypeOption3();
			}else if(value=='E'){
				setValue('remove_mat['+part+']',value);
				//alert(findObj('remove_mat['+part+']').value);
				texttype1 = 'Order spacial Tray';
				CloseDivRemoveTypeSelector();
			}else if(value=='F'){
				setValue('remove_mat['+part+']',value);
				//alert(findObj('remove_mat['+part+']').value);
				texttype1 = 'Bite Block';
				CloseDivRemoveTypeSelector();
			}else if(value=='G'){
				setValue('remove_mat['+part+']',value);
				//alert(findObj('remove_mat['+part+']').value);
				texttype1 = 'Order spacial Tray + Bite Block';
				CloseDivRemoveTypeSelector();
			}else if(value=='H'){
				setValue('remove_mat['+part+']',value);
				//alert(findObj('remove_mat['+part+']').value);
				texttype1 = 'Removeable bridge';
				CloseDivRemoveTypeSelector();
			}
			break;
		case 1 : {
			setValue('remove_mat['+part+']',findObj('remove_mat['+part+']').value+value);
			//findObj('remove_mat['+part+']').value[1] = value;
			switch(value){
				case '0':break;
				case 'A':texttype2 = ' + Full Plate';break;
				case 'B':texttype2 = ' + Lingual Plate';break;
				case 'C':texttype2 = ' + Lingual Bar';break;
				case 'D':texttype2 = ' + Kennedy Bar';break;
				case 'E':texttype2 = ' + Palatal Stap (minimal coverage)';break;
				case 'F':texttype2 = ' + Skeleton Design';break;
				case 'G':texttype2 = ' + Horseshoe Plate';break;
				case 'H':texttype2 = ' + Ackers METAL';break;
				case 'I':texttype2 = ' + Rebase';break;
				case 'J':texttype2 = ' + Pepair';break;
				case 'K':texttype2 = ' + Adiunction';break;
			}
			
			CloseDivRemoveTypeSelector();
			break;
			}
		case 2 : {
				setValue('remove_mat['+part+']',findObj('remove_mat['+part+']').value+value);
				//findObj('remove_mat['+part+']').value[2] = value;
				//setValue('remove_mat['+part+'][2]',value);
				switch(value){
					case '0':break;
					case 'A':texttype2 = ' + Block Out & Duplicate Technique';break;
					case 'B':texttype2 = ' + Full Denture';break;
					case 'C':texttype2 = ' + Partial Denture';break;
					case 'D':texttype2 = ' + Rebase';break;
					case 'E':texttype2 = ' + Reline';break;
					case 'F':texttype2 = ' + Addition';break;
					case 'G':texttype2 = ' + Lingualized Occlusion';break;
					case 'H':texttype2 = ' + Repair';break;
				}				
				CloseDivRemoveTypeSelector();
				break;
				}
			case 3 : {
				setValue('remove_mat['+part+']',findObj('remove_mat['+part+']').value+value);
				switch(value){
					case '0':break;
					case 'A':texttype2 = ' + Partial Denture';break;
					case 'B':texttype2 = ' + Removable Bridge';break;
					case 'C':texttype2 = ' + Special Request';break;
				}
				CloseDivRemoveTypeSelector();
				break;
				}
			case 4 : {
				setValue('remove_mat['+part+']',findObj('remove_mat['+part+']').value+value);
				switch(value){
					case 'A':texttype2 = ' + Acetal Tooth';break;
					case 'B':texttype2 = ' + Acetal Clasp';break;
					case 'C':texttype2 = ' + All Acetal Frame Work';break;
					case 'D':texttype2 = ' + All Acetal Removable Bridge';break;
					case 'E':texttype2 = ' + Acetal Swing Lock';break;
				}
				CloseDivRemoveTypeSelector();
				break;
			}
		}
		
		showHideLayers('TABLE_RPD_ACRYLICFORFINISH','','hide');
		showHideLayers('TABLE_RPD_TEETHANDSETUP','','hide');
		showHideLayers('TABLE_RPD_GUMFIT','','hide');
		showHideLayers('TABLE_RPD_SPECIALREQUEST','','hide');
		showHideLayers('TABLE_TP_OrderAcrylic','','hide');
		showHideLayers('TABLE_TP_TPOrderGrid','','hide');
		showHideLayers('TABLE_SPBB','','hide');
		//showHideLayers('TABLE_Work','','hide');
		
		upvalue = findObj('remove_mat[upper]').value;
		lowvalue = findObj('remove_mat[lower]').value;

		if(upvalue.substring(0,1) == "A" || lowvalue.substring(0,1) == "A"){
			showHideLayers('TABLE_RPD_ACRYLICFORFINISH','','show');
			showHideLayers('TABLE_RPD_TEETHANDSETUP','','show');
			showHideLayers('TABLE_RPD_GUMFIT','','show');
			showHideLayers('TABLE_RPD_SPECIALREQUEST','','show');
			//showHideLayers('TABLE_Work','','show');
		}
		
		if(upvalue.substring(0,1) == "B" || lowvalue.substring(0,1) == "B"){

			//showHideLayers('TABLE_Work','','show');
			showHideLayers('TABLE_TP_OrderAcrylic','','show');
			showHideLayers('TABLE_TP_TPOrderGrid','','show');
			showHideLayers('TABLE_RPD_TEETHANDSETUP','','show');
			showHideLayers('TABLE_RPD_GUMFIT','','show');
		}
		if(upvalue.substring(0,1) == "D" || lowvalue.substring(0,1) == "D"){
			//showHideLayers('TABLE_Work','','show');
		}
		if(upvalue.substring(0,1) == "E" || lowvalue.substring(0,1) == "E"){
			showHideLayers('TABLE_SPBB','','show');
		}
		if(upvalue.substring(0,1) == "F" || lowvalue.substring(0,1) == "F"){
			showHideLayers('TABLE_SPBB','','show');
		}
		if(upvalue.substring(0,1) == "G" || lowvalue.substring(0,1) == "G"){
			showHideLayers('TABLE_SPBB','','show');
		}

		//alert(part+':'+getValue('remove_mat['+part+']'));
}

function OpenDivRemoveTypeSelector(p)
{
	part = p;
	texttype1='';
	texttype2='';
	texttype3='';
	texttype4='';
	activeBG();
	makeCenterScreen('DivRemoveTypeSelector');
	showHideLayers('DivRemoveTypeSelector','','show');
	OpenDivRemoveTypeMain(part);
}

function CloseDivRemoveTypeSelector()
{
	writeit('TDRemoveType'+part,texttype1+texttype2+texttype3+texttype4);
	hideBG();
	showHideLayers('DivRemoveTypeSelector','','hide');
}

function CloseDivRemoveTypeSelectorNoEffect()
{
	hideBG();
	showHideLayers('DivRemoveTypeSelector','','hide');
}

function OpenDivRemoveTypeMain()
{
	showHideLayers('DivMainRemoveType','','show');
	showHideLayers('DivOptionRemoveType1','','hide');
	showHideLayers('DivOptionRemoveType2','','hide');
	showHideLayers('DivOptionRemoveType3','','hide');
	showHideLayers('DivOptionRemoveType4','','hide');
}

function OpenDivRemoveTypeOption1()
{
	//alert("1");
	showHideLayers('DivOptionRemoveType1','','show');
	showHideLayers('DivMainRemoveType','','hide');
	showHideLayers('DivOptionRemoveType2','','hide');
	showHideLayers('DivOptionRemoveType3','','hide');
	showHideLayers('DivOptionRemoveType4','','hide');
}

function OpenDivRemoveTypeOption2()
{
	//alert("2");
	showHideLayers('DivOptionRemoveType1','','hide');
	showHideLayers('DivOptionRemoveType2','','show');
	showHideLayers('DivMainRemoveType','','hide');
	showHideLayers('DivOptionRemoveType3','','hide');
	showHideLayers('DivOptionRemoveType4','','hide');
}

function OpenDivRemoveTypeOption3()
{
	//alert("2");
	showHideLayers('DivOptionRemoveType1','','hide');
	showHideLayers('DivOptionRemoveType2','','hide');
	showHideLayers('DivMainRemoveType','','hide');
	showHideLayers('DivOptionRemoveType3','','show');
	showHideLayers('DivOptionRemoveType4','','hide');
}

function OpenDivRemoveTypeOption4()
{
	//alert("2");
	showHideLayers('DivOptionRemoveType1','','hide');
	showHideLayers('DivOptionRemoveType2','','hide');
	showHideLayers('DivMainRemoveType','','hide');
	showHideLayers('DivOptionRemoveType3','','hide');
	showHideLayers('DivOptionRemoveType4','','show');
}

showHideLayers('DivRemoveTypeSelector','','hide');
showHideLayers('DivMainRemoveTyper','','hide');
showHideLayers('DivOptionRemoveType1','','hide');
showHideLayers('DivOptionRemoveType2','','hide');
showHideLayers('DivOptionRemoveType3','','hide');
showHideLayers('DivOptionRemoveType4','','hide');


</script>
