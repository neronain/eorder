<link href="../resource/css/eorder.css" rel="stylesheet" type="text/css" />
<div id="RemoveTypeSelector"
 style="position:absolute; white-space:nowrap; left:0px; top:0px; width:450px; height:500px; z-index:1; visibility:true; margin:0"
>

<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
<tr><td valign="middle" align="center">
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFF99">
  <tr>
    <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
    <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
    <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
  </tr>
  <tr>
    <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
    <td align="left"><table width="400" border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10" height="25" align="right" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25"  align="right" /></td>
        <td height="25" colspan="3" align="center" background="../resource/images/eorder/panel/hd2.gif" class="TBHead">Select Remove Type</td>
        <td width="11" height="25" align="left" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
      </tr>
  </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorType(REMOVETYPE.RPD)" id="RemoveSelectTypeTBRPD"
      style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/mty_rpd.gif" width="56" height="56" /></td>
          <td>RPD</td>
        </tr>
      </table>
<table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorType(REMOVETYPE.DECOLTE)" id="RemoveSelectTypeTBDECOLTE"
      style="cursor:pointer">
        <tr>
          <td width="20" align="center">&nbsp;</td>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/mty_decolte.gif" width="56" height="56" /></td>
          <td>Decolte</td>
        </tr>
      </table><br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorType(REMOVETYPE.PLEIN)" id="RemoveSelectTypeTBPLEIN"
      style="cursor:pointer">
        <tr>
          <td width="20" align="center">&nbsp;</td>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/mty_plein.gif" width="56" height="56" /></td>
          <td>Plein</td>
        </tr>
      </table><br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorType(REMOVETYPE.FILCHINGULAIRE)" id="RemoveSelectTypeTBFILCHINGULAIRE"
      style="cursor:pointer">
        <tr>
          <td width="20" align="center">&nbsp;</td>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/mty_filchingulaire.gif" width="56" height="56" /></td>
          <td>Fil Chingulaire</td>
        </tr>
      </table><br />

<table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorType(REMOVETYPE.BANNEESPACE)" id="RemoveSelectTypeTBBANNEESPACE"
      style="cursor:pointer">
        <tr>
          <td width="20" align="center">&nbsp;</td>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/mty_banneespace.gif" width="56" height="56" /></td>
          <td>Banne Espace</td>
        </tr>
      </table>                        
      <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorType(REMOVETYPE.TP)" id="RemoveSelectTypeTBTP"
      style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/mty_tp.gif" width="56" height="56" /></td>
          <td>TP</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorType(REMOVETYPE.VITAFLEX)" id="RemoveSelectTypeTBVITAFLEX"
      style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/mty_vitaflex.gif" width="56" height="56" /></td>
          <td>Vitaflex</td>
        </tr>
      </table>
      <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorType(REMOVETYPE.REPAIR)" id="RemoveSelectTypeTBREPAIR"
      style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/mty_repair.gif" width="56" height="56" /></td>
          <td>Repair</td>
        </tr>
      </table>
      <br />    </td>
    <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
  </tr>
  <tr>
    <td height="25" background="../resource/images/eorder/panel/pn4.gif"></td>
    <td height="35" align="right" valign="bottom">
    
         <button class="BTselect" onclick="RemoveTypeApply();" style="width:60px;height:20px;">Select</button>  
     <button class="BTselect" onclick="CloseRemoveTypeSelector();" style="width:60px;height:20px;">Cancel</button> 
    </td>
    <td height="25" background="../resource/images/eorder/panel/pn6.gif"></td>
  </tr>
  <tr>
    <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
    <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
    <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
  </tr>
</table>
</td></tr></table>



<script type="text/javascript">
showHideLayers('RemoveTypeSelector','','hide');
var selected_type_id = 0;
var selected_type_option1 = 0;
var selected_type_option2 = 0;
var selected_type_option3 = 0;
function OnClickRemoveSelectorType(id){
	if(id < REMOVETYPE.DECOLTE){
		selected_type_id = id;
		selected_type_option1=0;
		selected_type_option2=0;
		selected_type_option3=0;
	}else{
		if(id == REMOVETYPE.DECOLTE){
			selected_type_option1	 = (selected_type_option1==1?0:1);
		}else if(id == REMOVETYPE.PLEIN){
			selected_type_option1	 = (selected_type_option1==2?0:2);
		}else if(id == REMOVETYPE.FILCHINGULAIRE){
			selected_type_option2	 = (selected_type_option2==1?0:1);
		}else if(id == REMOVETYPE.BANNEESPACE){
			selected_type_option3	 = (selected_type_option3==1?0:1);
		}
	}
	//if(id!=0){
	//}
	BuildRemoveTypeSelecterImage();
//	g_FixTeeth_list[selected_teeth_index].material = id;
}
function OpenRemoveTypeSelector(){
	BuildRemoveTypeSelecterImage();
	makeCenterScreen('RemoveTypeSelector');
	showHideLayers('RemoveTypeSelector','','show');
	//SetScrollbarEnable(false);
	activeBG();
	
}
function CloseRemoveTypeSelector(){
	showHideLayers('RemoveTypeSelector','','hide');
	//SetScrollbarEnable(true);
	hideBG();
}
function RemoveTypeApply(){
	if(selected_teeth_index==32){
		g_RemoveUpperType = selected_type_id;
		g_RemoveUpperOption1 = selected_type_option1;
		g_RemoveUpperOption2 = selected_type_option2;
	}else if (selected_teeth_index==33){
		g_RemoveLowerType = selected_type_id;
		g_RemoveLowerOption1 = selected_type_option1;
		g_RemoveLowerOption2 = selected_type_option2;
		g_RemoveLowerOption3 = selected_type_option3;
	}
	RefreshRemoveTeethImage(selected_teeth_index);
	CloseRemoveTypeSelector();
}
function BuildRemoveTypeSelecterImage(){
	var obj;
	obj = findObj("RemoveSelectTypeTBRPD");
	obj.style.background  = (selected_type_id==REMOVETYPE.RPD?			"#FFCC99":"");
	obj = findObj("RemoveSelectTypeTBTP");
	obj.style.background 		= (selected_type_id==REMOVETYPE.TP?			"#FFCC99":"");
	obj = findObj("RemoveSelectTypeTBVITAFLEX");
	obj.style.background 	= (selected_type_id==REMOVETYPE.VITAFLEX?	"#FFCC99":"");
	obj = findObj("RemoveSelectTypeTBREPAIR");
	obj.style.background = (selected_type_id==REMOVETYPE.REPAIR?	"#FFCC99":"");


	obj = findObj("RemoveSelectTypeTBDECOLTE");
	obj.style.display =  (selected_type_id==REMOVETYPE.RPD?			"inline":"none");
	obj.style.background = (selected_type_option1==1?	"#FFCC99":"");
	obj = findObj("RemoveSelectTypeTBPLEIN");
	obj.style.display =  (selected_type_id==REMOVETYPE.RPD?			"inline":"none");
	obj.style.background = (selected_type_option1==2?	"#FFCC99":"");
	obj = findObj("RemoveSelectTypeTBFILCHINGULAIRE");
	obj.style.display =  (selected_type_id==REMOVETYPE.RPD?			"inline":"none");
	obj.style.background = (selected_type_option2==1?	"#FFCC99":"");
	obj = findObj("RemoveSelectTypeTBBANNEESPACE");
	obj.style.display =  (selected_type_id==REMOVETYPE.RPD && selected_teeth_index==33?		"inline":"none");
	obj.style.background = (selected_type_option3==1?	"#FFCC99":"");
}
//-->
</script>
</div>