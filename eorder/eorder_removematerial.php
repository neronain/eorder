<link href="../resource/css/eorder.css" rel="stylesheet" type="text/css" />
<div id="RemoveMaterialSelector"
 style="position:absolute; white-space:nowrap; left:0px; top:0px; width:450px; height:500px; z-index:1; visibility:true; margin:0"
>
<table border="0" width="100%" height="100%" cellpadding="0" cellspacing="0">
<tr><td valign="middle" align="center"><table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="#FFFF99">
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
        <td height="25" colspan="3" align="center" background="../resource/images/eorder/panel/hd2.gif" class="TBHead">Select Remove Material</td>
        <td width="11" height="25" align="left" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
      </tr>
    </table>
              <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorMaterial(1)" id="RemoveSelectMaterialAcetal" style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/m_acetal.gif" width="56" height="56" /></td>
          <td>Clasp Acetal</td>
        </tr>
      </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorMaterial(2)" id="RemoveSelectMaterialMetal" style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/m_metal.gif" width="56" height="56" /></td>
          <td>Clasp Metal</td>
        </tr>
      </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorMaterial(3)" id="RemoveSelectMaterialVitaflex" style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/m_vitaflex.gif" width="56" height="56" /></td>
          <td>Clasp Vitaflex</td>
        </tr>
      </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorMaterial(21)" id="RemoveSelectMaterialAdjunction" style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/m_adjunction.gif" width="56" height="56" /></td>
          <td>Adjunction</td>
        </tr>
      </table>
            <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorMaterial(22)" id="RemoveSelectMaterialBacking" style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/m_backing.gif" width="56" height="56" /></td>
          <td>Backing</td>
        </tr>
      </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorMaterial(23)" id="RemoveSelectMaterialFullMetal" style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/m_fullmetal.gif" width="56" height="56" /></td>
          <td>Full Metal</td>
        </tr>
      </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorMaterial(24)" id="RemoveSelectMaterialFullResine" style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/m_fullresine.gif" width="56" height="56" /></td>
          <td>Full Resine</td>
        </tr>
      </table>
                  <table width="100%" border="0" cellspacing="0" cellpadding="0" 
      onclick="OnClickRemoveSelectorMaterial(10)" id="RemoveSelectMaterialRest" style="cursor:pointer">
        <tr>
          <td width="100" align="center"><img src="../resource/images/eorder/teeth/teeth_imagefile/m_rest.gif" width="56" height="56" /></td>
          <td>Rest</td>
        </tr>
      </table>
           </td>
    <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
  </tr>
  <tr>
    <td height="25" background="../resource/images/eorder/panel/pn4.gif"></td>
    <td height="35" align="right" valign="bottom"><button class="BTselect" onclick="RemoveMaterialApply();" style="width:60px;height:20px;">Select</button>
        
      <button class="BTselect" onclick="CloseRemoveMaterialSelector();" style="width:60px;height:20px;">Cancel</button></td>
    <td height="25" background="../resource/images/eorder/panel/pn6.gif"></td>
  </tr>
  <tr>
    <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
    <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
    <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
  </tr>
</table></td>
</tr></table>



<script type="text/javascript">
<!--

showHideLayers('RemoveMaterialSelector','','hide');
var selected_material_id = 0;
var selected_rest_id = 0;
function OnClickRemoveSelectorMaterial(id){
	if(id==10){
		if(selected_rest_id==10){
			selected_rest_id = 0;
		}else{
			selected_rest_id = 10;
			if(selected_material_id>20){
				selected_material_id=0;
				BuildRemoveSelecterImage(0);
			}
		}
		BuildRemoveSelecterImage(10);
	}else{
		if(id>20){
			selected_rest_id = 0;
			
		}
		oldID = selected_material_id;
		selected_material_id = id;

		BuildRemoveSelecterImage(oldID);
		BuildRemoveSelecterImage(id);
		BuildRemoveSelecterImage(10);
	}
//	g_FixTeeth_list[selected_teeth_index].material = id;
}


function OpenRemoveMaterialSelector(teethNo){
	makeCenterScreen('RemoveMaterialSelector');
	showHideLayers('RemoveMaterialSelector','','show');
	//SetScrollbarEnable(false);
	activeBG();
}
function CloseRemoveMaterialSelector(){
	showHideLayers('RemoveMaterialSelector','','hide');
	//SetScrollbarEnable(true);
	hideBG();
}
function RemoveMaterialApply(){
	g_RemoveTeeth_list[selected_teeth_index].material = selected_material_id;
	g_RemoveTeeth_list[selected_teeth_index].rest = selected_rest_id;
	RefreshRemoveTeethImage(selected_teeth_index);
	CloseRemoveMaterialSelector();
}

function BuildRemoveSelecterImage(id){
	if(id==10){
		findObj("RemoveSelectMaterialRest").style.background 				= (selected_rest_id==10?		"#FFCC99":"");
	}else{
		findObj("RemoveSelectMaterialAcetal").style.background 				= (id==1?			"#FFCC99":"");
		findObj("RemoveSelectMaterialMetal").style.background 				= (id==2?			"#FFCC99":"");
		findObj("RemoveSelectMaterialVitaflex").style.background 				= (id==3?			"#FFCC99":"");
		findObj("RemoveSelectMaterialAdjunction").style.background 		= (id==21?		"#FFCC99":"");
		findObj("RemoveSelectMaterialBacking").style.background 			= (id==22?		"#FFCC99":"");
		findObj("RemoveSelectMaterialFullMetal").style.background 			= (id==23?		"#FFCC99":"");
		findObj("RemoveSelectMaterialFullResine").style.background 			= (id==24?		"#FFCC99":"");
	}
}

//-->
</script>
</div>