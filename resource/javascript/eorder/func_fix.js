// JavaScript Document
function SetFixMethod(m){
	v_method = m;
	var obj = findObj('MainFix');
	obj.style.display='inline';
	RebuildAllMaterialSelecter();
	RebuildAllTeethImage();
	RefreshFixMethodTB();
}
function RefreshFixMethodTB(){
	var obj = findObj("FixMethodTypeTB");
	if(v_method == METHOD.NONE){
		obj.style.background = "#FFFFFF";
	}else{
		obj.style.background = "#D6D6D6";
	}
 	findObj("FixMethodTypeTD1").style.background = (v_method == METHOD.TRYIN?			"#FFFFFF":"");
 	findObj("FixMethodTypeTD2").style.background = (v_method == METHOD.CONTOUR?	"#FFFFFF":"");
 	findObj("FixMethodTypeTD3").style.background = (v_method == METHOD.FINISH?			"#FFFFFF":"");
 	findObj("FixMethodTypeTD4").style.background = (v_method == METHOD.REPAIR?		"#FFFFFF":"");
	
}

function RebuildAllTeethImage(){
	for(var i=0;i<g_FixTeeth_list.length;i++){
		if(g_FixTeeth_list[i].material!=0 || g_FixTeeth_list[i].pintooth!=0 )
			RefreshFixTeethImage(i);
	}
}


var selected_teeth_index;
function OnClickFixTeeth(index){
	selected_teeth_index = index;
	OnClickFixSelectorMaterial(g_FixTeeth_list[selected_teeth_index].material)
	OpenFixMaterialSelector(index);	
	
}

var selected_material_id = 0;
function OnClickFixSelectorMaterial(id){
	oldID = selected_material_id;
	selected_material_id = id;
	if(id!=0){
		BuildFixSelecterImage(id);
	}
	if(oldID!=0){
		BuildFixSelecterImage(oldID);
	}
//	g_FixTeeth_list[selected_teeth_index].material = id;
}

function FixMaterialApply(){
	g_FixTeeth_list[selected_teeth_index].material = selected_material_id;
	RefreshFixTeethImage(selected_teeth_index);
	CloseFixMaterialSelector();
}