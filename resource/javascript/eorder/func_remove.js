// JavaScript Document




var selected_teeth_index;
function OnClickRemoveTeeth(index){
	selected_teeth_index = index;
	
	if(index==32){
		selected_type_id	 = g_RemoveUpperType;
		selected_type_option1	 = g_RemoveUpperOption1;
		selected_type_option2	 = g_RemoveUpperOption2;
		OpenRemoveTypeSelector();	
	}else if(index==33){
		selected_type_id	 = g_RemoveLowerType;
		selected_type_option1	 = g_RemoveLowerOption1;
		selected_type_option2 = g_RemoveLowerOption2;
		selected_type_option3 = g_RemoveLowerOption3;
		OpenRemoveTypeSelector();	
	}else{
		if(index<16 && g_RemoveUpperType == 0){
			selected_teeth_index = 32;
			OnClickRemoveSelectorType(g_RemoveUpperType);
			OpenRemoveTypeSelector(32);	
		}else if(index>=16 && g_RemoveLowerType == 0){
			selected_teeth_index = 33;
			OnClickRemoveSelectorType(g_RemoveLowerType);
			OpenRemoveTypeSelector(33);	
		}else{
			selected_material_id = g_RemoveTeeth_list[selected_teeth_index].material;
			selected_rest_id = g_RemoveTeeth_list[selected_teeth_index].rest;
			OnClickRemoveSelectorMaterial(g_RemoveTeeth_list[selected_teeth_index].material);
			OpenRemoveMaterialSelector(index);	
		}
	}
}




function VerifyRemoveDetailDisplay(uplo){
	var id=REMOVETYPE.NONE;
	if(uplo=="Upper")
		id = g_RemoveUpperType;
	else
		id = g_RemoveLowerType;
	//if(findObj("RemoveDetail"+uplo+"RPD")!=null){
		findObj("RemoveDetail"+uplo+"RPD").style.display = (id==REMOVETYPE.RPD?'inline':'none');
		findObj("RemoveDetail"+uplo+"TP").style.display = (id==REMOVETYPE.TP?'inline':'none');
		findObj("RemoveDetail"+uplo+"Vitaflex").style.display = (id==REMOVETYPE.VITAFLEX?'inline':'none');
		findObj("RemoveDetail"+uplo+"Repair").style.display = (id==REMOVETYPE.REPAIR?'inline':'none');
	//}
}