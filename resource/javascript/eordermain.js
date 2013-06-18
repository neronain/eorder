var temp2=-1;
var m_select_teeth = -1;
var m_teeth_list = new Array();
for(var i=0;i<34;i++){	
	m_teeth_list[i] = new Teeth();
}
var m_teeth_last = new Teeth();
var m_bridge_list = new Array();
for(var i=0;i<30;i++){	
	m_bridge_list[i] = false;
}

//************************************************************************
// Class teeth
function Teeth(){
	this.isFix = 0 // 1:Fix 2:Remove
	this.method = // 1:Tryin 2:Contour 3:Finish 4:FinishDirect 5:Repair 
	this.material = 0;
	//this.materialname = "";
/********************
	    1- 99		crown bridge					
	100-199		pintooth crown bridge		100:Pintooth
	200-299		pintoothII crown bridge	200:PintoothII
	300+			Ceramic
********************/
	this.option1 = 0; // For Fix 1:single or 2:Bridge
	this.option2 = 0; // For Fix 1:None 2:Ѵͺҹ˹ 3:Ѵͺͺ
	this.option3 = 0; // For Fix 1:None 2:Magin 3:Step Bar 4:Both
	this.option4 = 0; // For Fix Bridge pontic 1:None 2:type1 3:type2 4:type3 5:type4
	this.option5 = 0; // For Fix Embrasure 1:None 2:open 3:close
	this.option6 = 0; // For Fix Alloy 1:None 2-16:Alloy
	this.option7 = false; // For Fix is Attach 0:false 1:true
	this.option8 = 0; // For Fix Color 1-255:ColorID 
	this.option9 = ""; // For Fix ColorName XXXXXX
	this.option10 = ""; // For Fix ColorCode #XXXXXX
	this.option11 = false; // For Fix is Porcelain Margin 0:false 1:true
	this.option12 = false; // For Fix is Step bar 0:false 1:true
}
// For all Fix ********************
	fixteethmethod = 0; // 1:Tryin 2:Contour 3:Finish 4:FinishDirect 5:Repair 
	fixteethoption4 = 0; // For Fix Bridge pontic 1:None 2:type1 3:type2 4:type3 5:type4
	fixteethoption5 = 0; // For Fix Embrasure 1:None 2:open 3:close
	fixteethoption6 = 0; // For Fix Alloy 1:None 2-16:Alloy
// ****************************
function get_teeth_number(i){
	var number =0;
	if(i<8){					number = 18-i;
	}else if(i<16)	{		number = i+13;
	}else if(i<24)	{		number = 38-i+16;
	}else	{					number = i+17;
	}
	return number;
}

function getTeethMouseOutImg(id){
	var text='';
	if(m_teeth_list[id].material!=0){
		text = "../resource/images/eorder/fix/"+getFixMaterialImage(m_teeth_list[id].material)+".gif";
	}else{
		var index = get_teeth_number(id);
		text='../resource/images/eorder/teeth/b_'+index+'.gif';
	}

	return text;
}
function getTeethMouseOverImg(id){
	var text='';
	if(m_teeth_list[id].material!=0){
		text = "../resource/images/eorder/fix/"+getFixMaterialImage(m_teeth_list[id].material)+".gif";
	}else{
		var index = get_teeth_number(id);
		text='../resource/images/eorder/teeth/b_'+index+'s.gif';
	}
	return text;
}
//function onMouseOverTeeth(i){
//	for(var j=0;j<32;j++){
//		//alert("debug"+j);
//		if(i==j)continue;
//		onMouseOutTeeth(j);
//	}
//	for(var j=0;j<30;j++){
//		onMouseOutBridge(j);
//	}
//
//	var text='';
//	if(m_teeth_list[i].material==0){
//		
//		var index = get_teeth_number(i);
//		text='<img src=\"../resource/images/eorder/teeth/b_'+index+'s.gif\"   onMouseOut="onMouseOutTeeth('+i+');" onClick="onClickTeeth('+i+');">';
//		//text='<img src=\"../resource/images/eorder/teeth/b_'+index+'s.gif\">';
//	}else{
//		var id = m_teeth_list[i].material;
//		text='<table  border=0 cellspacing=1 cellpadding=0  bgcolor=#000000 width=44 height=44><tr><td align=center bgcolor=#C2EDED>';
//		if(id>100 && id < 200){
//			text+='<table border=0 cellspacing=0 cellpadding=0 background="../resource/images/eorder/teeth/'+getFixMaterialImage(100)+'.gif\"><tr><td><img src=../resource/images/eorder/teeth/'+getFixMaterialImage(id%100)+'.gif width=32 height=32    onMouseOut="onMouseOutTeeth('+i+');" onClick="onClickTeeth('+i+');"></td></tr></table>';
//		}else if(id>200 && id < 300){
//			text+='<table border=0 cellspacing=0 cellpadding=0 background="../resource/images/eorder/teeth/'+getFixMaterialImage(200)+'.gif\"><tr><td><img src=../resource/images/eorder/teeth/'+getFixMaterialImage(id%100)+'.gif width=32 height=32    onMouseOut="onMouseOutTeeth('+i+');" onClick="onClickTeeth('+i+');"></td></tr></table>';
//		}else{
//			text+='<img src=../resource/images/eorder/teeth/'+getFixMaterialImage(id)+'.gif width=32 height=32   onMouseOut="onMouseOutTeeth('+i+');" onClick="onClickTeeth('+i+');">';
//		}
//		text+='</td></tr></table>';
//	}
//	writeit("teethImg"+i,text);  // */
//}
function onMouseOverTeeth(i){
	setBG('tblTeethImg'+i+'','#000000');
	setBG('tblTDTeethImg'+i+'','#C2EDED');
}
function onMouseOutTeethBG(i){
	setBG('tblTeethImg'+i+'','#FFFFFF');
	setBG('tblTDTeethImg'+i+'','#FFFFFF');
}
function onMouseOverTeethR(i){
	setBG('tblTeethImgR'+i+'','#000000');
	setBG('tblTDTeethImgR'+i+'','#C2EDED');
}
function onMouseOutTeethBGR(i){
	setBG('tblTeethImgR'+i+'','#FFFFFF');
	setBG('tblTDTeethImgR'+i+'','#FFFFFF');
}



function onMouseOutTeeth(i){
	//alert("debug"); // /*
	var text='';
	if(m_teeth_list[i].material==0){
		
		var index = get_teeth_number(i);
		if(m_teeth_list[i].option7){
			text='<table  id="tblTeethImg'+i+'" border=0 cellspacing=1 cellpadding=0  width=44 height=44><tr><td  id="tblTDTeethImg'+i+'" align=center bgcolor=#FFFFFF>';			
			text+='<img src=../resource/images/eorder/teeth/d_attach.gif width=32 height=32 ';
			text+=' onMouseOut="onMouseOutTeethBG('+i+');"   ';
			text+=' onMouseOver="onMouseOverTeeth('+i+');" ';
			text+=' onClick="onClickTeeth('+i+');" style="cursor:pointer" >';

			text+='</td></tr></table>';
		}else{
		text='<img src=\"../resource/images/eorder/teeth/b_'+index+'.gif\"   onMouseOver="this.src=\'../resource/images/eorder/teeth/b_'+index+'s.gif\'" onMouseOut="this.src=\'../resource/images/eorder/teeth/b_'+index+'.gif\'" onClick="onClickTeeth('+i+');"  style="cursor:pointer" >';
		}

		
		//text='<img src=\"../resource/images/eorder/teeth/b_'+index+'.gif\">';
	}else{
		var id = m_teeth_list[i].material;
		text='<table  id="tblTeethImg'+i+'" border=0 cellspacing=1 cellpadding=0  width=44 height=44><tr><td  id="tblTDTeethImg'+i+'" align=center bgcolor=#FFFFFF>';
		

		if(id>100 && id < 200){
			text+='<table border=0 cellspacing=0 cellpadding=0 ';
			text+=' background="../resource/images/eorder/fix/'+getFixMaterialImage(100)+'.gif\"';
			text+=' onMouseOut="onMouseOutTeethBG('+i+');"   ';
			text+=' onMouseOver="onMouseOverTeeth('+i+');" ';
			text+=' onClick="onClickTeeth('+i+');" style="cursor:pointer" ';
			text+=' ><tr><td>';
			
			text+='<table border=0 cellspacing=0 cellpadding=0 ';
			text+=' background="../resource/images/eorder/fix/'+getFixMaterialImage(id%100)+'.gif\"><tr><td>';
			
			if(m_teeth_list[i].option7){
				text+='<img src=../resource/images/eorder/teeth/d_attach.gif width=32 height=32 >';
			}else{
				text+='<img src=../resource/images/eorder/null.gif width=32 height=32 >';
			}
			text+='</td></tr></table>';
			
			text+='</td></tr></table>';

			
			

		}else if(id>200 && id < 300){
			text+='<table border=0 cellspacing=0 cellpadding=0 ';
			text+=' background="../resource/images/eorder/fix/'+getFixMaterialImage(200)+'.gif\"';
			text+=' onMouseOut="onMouseOutTeethBG('+i+');"   ';
			text+=' onMouseOver="onMouseOverTeeth('+i+');" ';
			text+=' onClick="onClickTeeth('+i+');" style="cursor:pointer" ';
			text+=' ><tr><td>';
			
			text+='<table border=0 cellspacing=0 cellpadding=0 ';
			text+=' background="../resource/images/eorder/fix/'+getFixMaterialImage(id%100)+'.gif\"><tr><td>';
			
			if(m_teeth_list[i].option7){
				text+='<img src=../resource/images/eorder/teeth/d_attach.gif width=32 height=32 >';
			}else{
				text+='<img src=../resource/images/eorder/null.gif width=32 height=32 >';
			}
			text+='</td></tr></table>';
			
			text+='</td></tr></table>';
		}else{
			text+='<table border=0 cellspacing=0 cellpadding=0 ';
			text+=' background="../resource/images/eorder/fix/'+getFixMaterialImage(id)+'.gif\"';
			text+=' onMouseOut="onMouseOutTeethBG('+i+');"   ';
			text+=' onMouseOver="onMouseOverTeeth('+i+');" ';
			text+=' onClick="onClickTeeth('+i+');" style="cursor:pointer" ';
			text+=' ><tr><td>';
			

			
			if(m_teeth_list[i].option7){
				text+='<img src=../resource/images/eorder/teeth/d_attach.gif width=32 height=32 >';
			}else{
				text+='<img src=../resource/images/eorder/null.gif width=32 height=32 >';
			}

			
			text+='</td></tr></table>';
			
			
		}
		text+='</td></tr></table>';
		

	//*/	
	}
	
	

	writeit("teethImg"+i,text);  // */
	//alert("debug");
}











function onClickTeeth(i){
	m_select_teeth = i;
	temp=m_teeth_list[i].material;
	popup_selectfixmaterial();
}

function onClickTeethR(i){
	m_select_teeth = i;
	temp=m_teeth_list[i].material;
	popup_selectremovematerial();	
	
}







function onMouseOutTeethR(i){
	//alert("debug"); // /*
	var text='';
	var id = m_teeth_list[i].material;
	if(i<32){
		if(m_teeth_list[i].material==0){
			var index = get_teeth_number(i);
			
			if(m_teeth_list[i].option7){
				text='<table  id="tblTeethImgR'+i+'" border=0 cellspacing=1 cellpadding=0  width=44 height=44><tr><td  id="tblTDTeethImgR'+i+'" align=center bgcolor=#FFFFFF>';			
				text+='<img src=../resource/images/eorder/teeth/d_attach.gif width=32 height=32 ';
				text+=' onMouseOut="onMouseOutTeethBGR('+i+');"   ';
				text+=' onMouseOver="onMouseOverTeethR('+i+');" ';
				text+=' onClick="onClickTeethR('+i+');" style="cursor:pointer" >';
	
				text+='</td></tr></table>';
			}else{
			text='<img src=\"../resource/images/eorder/teeth/b_'+index+'.gif\"   onMouseOver="this.src=\'../resource/images/eorder/teeth/b_'+index+'s.gif\'" onMouseOut="this.src=\'../resource/images/eorder/teeth/b_'+index+'.gif\'" onClick="onClickTeethR('+i+');"  style="cursor:pointer" >';
			}
/*
			
			text='<img src=\"../resource/images/eorder/teeth/b_'+index+'.gif\"   onMouseOver="this.src=\'../resource/images/eorder/teeth/b_'+index+'s.gif\'" onMouseOut="this.src=\'../resource/images/eorder/teeth/b_'+index+'.gif\'" onClick="onClickTeethR('+i+');">';//*/
			//text='<img src=\"../resource/images/eorder/teeth/b_'+index+'.gif\">';
		}else{
			
			var opt = id - 2000;
			var middle 		= Math.floor((opt%1000)/100);
			var outside 	= Math.floor((opt% 100)/ 10);
			var inside 		= Math.floor((opt%  10)/   1);
			
			
			text='<table  id="tblTeethImgR'+i+'" border=0 cellspacing=1 cellpadding=0  width=44 height=44><tr><td  id="tblTDTeethImgR'+i+'" align=center bgcolor=#FFFFFF>';
			
			text+='<table border=0 cellspacing=0 cellpadding=0 ';
			//text+=' background="../resource/images/eorder/remove/'+getRemoveMaterialImage(id)+'.gif\"';
			text+=' onMouseOut="onMouseOutTeethBGR('+i+');"   ';
			text+=' onMouseOver="onMouseOverTeethR('+i+');" ';
			text+=' onClick="onClickTeethR('+i+');" style="cursor:pointer" ';
			text+=' ><tr><td>';
			
			if(middle!=0){
			  text+='<table border=0 cellspacing=0 cellpadding=0  ';
			  text+='background="../resource/images/eorder/remove/'+getRemoveMaterialImage(213+middle)+'.gif\"><tr><td>';
			}
			if(outside!=0){
			  text+='<table border=0 cellspacing=0 cellpadding=0  ';
			  text+='background="../resource/images/eorder/remove/'+getRemoveMaterialImage(210+outside)+'.gif\"><tr><td>';
			}
			if(inside!=0){
			  text+='<table border=0 cellspacing=0 cellpadding=0  ';
			  text+='background="../resource/images/eorder/remove/'+getRemoveMaterialImage(218+inside)+'.gif\"><tr><td>';
			}
			
			if(m_teeth_list[i].option7){
				text+='<img src=../resource/images/eorder/teeth/d_attach.gif width=32 height=32 >';
			}else{
				text+='<img src=../resource/images/eorder/null.gif width=32 height=32 >';
			}
			
			if(middle!=0){text+='</td></tr></table>';}
			if(outside!=0){text+='</td></tr></table>';}
			if(inside!=0){text+='</td></tr></table>';}
			
			text+='</td></tr></table>';
			
			
			text+='</td></tr></table>';			
			/*
			text='<table  id="tblTeethImgR'+i+'" border=0 cellspacing=1 cellpadding=0  width=44 height=44><tr><td  id="tblTDTeethImgR'+i+'" align=center bgcolor=#FFFFFF>';
			text+='<img src=../resource/images/eorder/remove/'+getRemoveMaterialImage(id)+'.gif width=32 height=32   onMouseOut="onMouseOutTeethBGR('+i+');" onMouseOver="onMouseOverTeethR('+i+');" onClick="onClickTeethR('+i+');">';
			text+='</td></tr></table>'; //*/
		}
	}else{
		if(id==0){
			var img = i == 32?"b_11_28":"b_31_48";
			text='<img src=\"../resource/images/eorder/remove/'+img+'.gif\"   onMouseOver="this.src=\'../resource/images/eorder/remove/'+img+'s.gif\'" onMouseOut="this.src=\'../resource/images/eorder/remove/'+img+'.gif\'" onClick="onClickTeethR('+i+');">';	
		}else{
			text='<table  id="tblTeethImgR'+i+'" border=0 cellspacing=1 cellpadding=0  width=44 height=44><tr><td  id="tblTDTeethImgR'+i+'" align=center bgcolor=#FFFFFF onMouseOut="onMouseOutTeethBGR('+i+');" onMouseOver="onMouseOverTeethR('+i+');" onClick="onClickTeethR('+i+');">';
			if(id<100){
				text+='<img src=../resource/images/eorder/remove/'+getRemoveMaterialImage(id)+'.gif width=32 height=32>';
			}else{
			text+='<img src=../resource/images/eorder/remove/'+getRemoveMaterialImage(100)+'.gif width=32 height=32>';

				var opt = id - 100;
				var isDecolte = opt%16>7;
				var isPlein = opt%8>3;
				var isFilC = opt%4>1;
				var isBanne = opt%2==1;
			
				if(isDecolte)text+='<img src=../resource/images/eorder/remove/d_decolte.gif width=32 height=32>';
				if(isPlein)text+='<img src=../resource/images/eorder/remove/d_plein.gif width=32 height=32>';
				if(isFilC)text+='<img src=../resource/images/eorder/remove/d_fc.gif width=32 height=32>';
				if(isBanne)text+='<img src=../resource/images/eorder/remove/d_banne.gif width=32 height=32>';
	
			}
			text+='</td></tr></table>';
		}
	}
	
	
	writeit("teethImgR"+i,text);  // */
	//alert("debug");
}




function onMouseOutBridge(i){
	var text='';
	if(m_bridge_list[i]){
		text='<img src="../resource/images/eorder/fix/bridge.gif" width="41" height="6" onClick="onClickBridge('+i+');" style="cursor:pointer" >';
	}else{
		text='<img src="../resource/images/eorder/fix/bridge_n.gif" width="41" height="6" onMouseOut="this.src=\'../resource/images/eorder/fix/bridge_n.gif\'"  onMouseOver="this.src=\'../resource/images/eorder/fix/bridge_h.gif\'" onClick="onClickBridge('+i+');" style="cursor:pointer" >';
	}
	writeit("bridgeImg"+i,text);  // */
}
function onClickBridge(i){
	m_bridge_list[i]=!m_bridge_list[i];
	onMouseOutBridge(i);
}











function setselectteeth(i){
	m_select_teeth = i;
	popup_panel(0);
	refresh_main_display();
}
function setfixremove(v){
	m_teeth_list[m_select_teeth].isFix = v;
	if(v==1){
		m_teeth_list[m_select_teeth].method = fixteethmethod;
		m_teeth_list[m_select_teeth].option4 = fixteethoption4;
		m_teeth_list[m_select_teeth].option5 = fixteethoption5;
		m_teeth_list[m_select_teeth].option6 = fixteethoption6;
	}
	refresh_main_display();
}
function setmethod(m){
	var fix = m_teeth_list[m_select_teeth].isFix;
	for(var i=0;i<32;i++){	
		if(fix == m_teeth_list[i].isFix){
			if(fix==1){
				m_teeth_list[i].method = m;
			}else{
			}
		}
	}
	if(fix==1){
		fixteethmethod = m;
	}
	refresh_main_display();
}
function setAttach(a){
	m_teeth_list[m_select_teeth].option7 = a;
	refresh_main_display();
}
function setfixEmbrasure(e){
	var fix = m_teeth_list[m_select_teeth].isFix;
	for(var i=0;i<32;i++){	
		if(fix == m_teeth_list[i].isFix){
			if(fix==1){
				m_teeth_list[i].option5 = e;
			}else{
			}
		}
	}
	if(fix==1){
		fixteethoption5 = e;
	}
	refresh_main_display();
}
function setfixAlloy(e){
	var fix = m_teeth_list[m_select_teeth].isFix;
	for(var i=0;i<32;i++){	
		if(fix == m_teeth_list[i].isFix){
			if(fix==1){
				m_teeth_list[i].option6 = e;
			}else{
			}
		}
	}
	if(fix==1){
		fixteethoption6 = e;
	}
	refresh_main_display();
}
function setfixPontic(e){
	var fix = m_teeth_list[m_select_teeth].isFix;
	for(var i=0;i<32;i++){	
		if(fix == m_teeth_list[i].isFix){
			if(fix==1){
				m_teeth_list[i].option4 = e;
			}else{
			}
		}
	}
	if(fix==1){
		fixteethoption4 = e;
	}
	refresh_main_display();
}
function toggleFixSingleBridge(){
	switch(m_teeth_list[m_select_teeth].option1){
		case 0:		m_teeth_list[m_select_teeth].option1 = 2;		break;
		case 1:		m_teeth_list[m_select_teeth].option1 = 2;		break;
		case 2:		m_teeth_list[m_select_teeth].option1 = 1;		break;
	}
	refresh_main_display();
}

function toggleFixMagin(){
	switch(m_teeth_list[m_select_teeth].option3){
		case 0:		m_teeth_list[m_select_teeth].option3 = 2;		break;
		case 2:		m_teeth_list[m_select_teeth].option3 = 0;		break;
		case 3:		m_teeth_list[m_select_teeth].option3 = 4;		break;
		case 4:		m_teeth_list[m_select_teeth].option3 = 3;		break;
	}
	refresh_main_display();
}
function toggleFixStepbar(){
	switch(m_teeth_list[m_select_teeth].option3){
		case 0:		m_teeth_list[m_select_teeth].option3 = 3;		break;
		case 2:		m_teeth_list[m_select_teeth].option3 = 4;		break;
		case 3:		m_teeth_list[m_select_teeth].option3 = 0;		break;
		case 4:		m_teeth_list[m_select_teeth].option3 = 2;		break;
	}
	refresh_main_display();
}
function toggleFixMetelColarLingual(){
	switch(m_teeth_list[m_select_teeth].option2){
		case 0:		m_teeth_list[m_select_teeth].option2 = 2;		break;
		case 2:		m_teeth_list[m_select_teeth].option2 = 0;		break;
		case 3:		m_teeth_list[m_select_teeth].option2 = 2;		break;
		//case 4:		m_teeth_list[m_select_teeth].option2 = 3;		break;
	}
	refresh_main_display();
}
function toggleFixMetelColar360(){
	switch(m_teeth_list[m_select_teeth].option2){
		case 0:		m_teeth_list[m_select_teeth].option2 = 3;		break;
		case 2:		m_teeth_list[m_select_teeth].option2 = 3;		break;
		case 3:		m_teeth_list[m_select_teeth].option2 = 0;		break;
		//case 4:		m_teeth_list[m_select_teeth].option2 = 2;		break;
	}
	refresh_main_display();
}
function isCeramic(t){
	return t.material>=300;
}
function isAnyFixBridge(){
	for(var i=0;i<32;i++){	
		if(m_teeth_list[i].option1==2){
			return true;
		}
	}
	return false;
}
function isAnyFixCeramic(){
	for(var i=0;i<32;i++){	
		if(isCeramic(m_teeth_list[i])){
			return true;
		}
	}
	return false;
}

//************************************************************************
var m_popup_panel = 0;
// 0:None
// 1:Fix Material
function popup_panel(index){
	m_popup_panel= index;
}

//************************************************************************


function build_html_teeth_selected_panel(){

}

function build_html_teeth_imagematerial(id){
	var text="";
	if(id==0)return "";
	if(id>100 && id < 200){
		text+="<table border=0 cellspacing=0 cellpadding=0 background=\"../resource/images/eorder/fix/"+getFixMaterialImage(100)+".gif\"><tr><td><img src=../resource/images/eorder/fix/"+getFixMaterialImage(id%100)+".gif width=32 height=32></td></tr></table>";
	}else if(id>200 && id < 300){
		text+="<table border=0 cellspacing=0 cellpadding=0 background=\"../resource/images/eorder/fix/"+getFixMaterialImage(200)+".gif\"><tr><td><img src=../resource/images/eorder/fix/"+getFixMaterialImage(id%100)+".gif width=32 height=32></td></tr></table>";
	}else{
		text+='<img src=../resource/images/eorder/fix/'+getFixMaterialImage(id)+'.gif width=32 height=32>';
	}
	return text;
}





function build_html_teeth_image(i,t){
	var number = get_teeth_number(i);
	var temp='';
	text='';

	if (t.isFix!=0){
		text+="              <table width=44 border=0 cellspacing=0 cellpadding=0 onclick=\"setselectteeth("+i+");\">";
		text+="                <tr>";
		text+="                  <td width=12 height=12><img src=../resource/images/eorder/teeth/s_"+(t.isFix==1?"fix":"remove")+".gif width=12 height=12></td>";
		text+="                  <td width=8 height=12></td>";
		text+="                  <td width=8 height=12></td>";
		
		temp='';if(isCeramic(t) && (t.option2==2))temp+='<img src=../resource/images/eorder/teeth/s_mcl.gif width=6 height=6>';if(isCeramic(t) && (t.option2==3))temp+='<img src=../resource/images/eorder/teeth/s_mc360.gif width=6 height=6>';
		text+="                  <td width=8 height=12>"+temp+"</td>";
		
		temp='';if(isCeramic(t) && (t.option3==2||t.option3==4))temp+='<img src=../resource/images/eorder/teeth/s_margin.gif width=4 height=8>';if(isCeramic(t) && (t.option3==3||t.option3==4))temp+='<img src=../resource/images/eorder/teeth/s_stepbar.gif width=4 height=8>';
		text+="                  <td width=8 height=12>"+temp+"</td>"
		
		text+="                </tr>";
		text+="                <tr>";
//		text+="                  <td width=12 height=8>"+(t.method>0?"<img src=../resource/images/eorder/teeth/s_method"+t.method+".gif width=12 height=8>":"")+"</td>";
		text+="                  <td width=12 height=8></td>";
		if(t.method==5){
			text+="                  <td height=32 colspan=4 rowspan=4><img src=images/ty_repair.gif width=32 height=32></td>";
		}else{
			text+="                  <td height=32 colspan=4 rowspan=4>"+build_html_teeth_imagematerial(t.material);+"</td>";
		}
		text+="                </tr>";
		text+="                <tr>";
//		text+="                  <td width=12 height=8>"+(t.option5>0?"<img src=../resource/images/eorder/teeth/s_em"+t.option5+".gif width=12 height=8>":"")+"</td>";
		text+="                  <td width=12 height=8></td>";
		text+="                </tr>";
		text+="                <tr>";
		text+="                  <td width=12 height=8></td>";
		text+="                </tr>";
		text+="                <tr>";
		text+="                  <td width=12 height=8>"+(t.option7==0?"":"<img src=../resource/images/eorder/teeth/s_attach.gif width=12 height=8>")+"</td>";
		text+="                </tr>";
		text+="              </table>";
		
	}else {
		text+="	<table  cellpadding=\"0\" cellspacing=\"0\" onclick=\"setselectteeth("+i+");\"><tr>";
		text+="  <td>";
		//text+="		<a href=\"#fixteeth_select\" onclick=\"setselectteeth("+i+");\">";
		text+="			<img src=\"../resource/images/eorder/teeth/b_"+number+".gif\" width=\"44\" height=\"44\" border=\"0\"> ";//</a>";
		text+="	</td></tr></table>";
	}
	return text;
}

function build_html_teeth_table(frm){
		text="";
		text+="<table  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#FFCC33\"><tr>";
		for(var i=0;i<32;i++){	
				//var bgcolor = i==m_select_teeth?"FFCC99":"FFFF99";
				var bgcolor = i==m_select_teeth?"FFFF99":"FFFFFF";
				var bgcolorh = i==m_select_teeth?"FFFF99":"FFFF99";
				text+="<td width=\"44\" height=\"44\" align=\"center\" bgcolor=\"#"+bgcolor+"\" onMouseOut=\"this.style.background='#"+bgcolor+"'\" onMouseOver=\"this.style.background='#"+bgcolorh+"'\">";
				text+=""+build_html_teeth_image(i,m_teeth_list[i])+"";
				text+="</td>";
				if(i%16==15 && i!=31){
					text+="</tr><tr>";
				}
				//if(i==m_select_teeth)alert('xxx');
		}
		text+="</tr></table>";
	return text;
}
function build_html_teeth_fix_remove_select(){
		text="";
		//if(m_teeth_list[m_select_teeth].isFix==0){
			text+="<table width=120 border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\" align=center><tr>";
			text+="	<td  align=center colspan=2 height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeading\">Fix or Remove ?</td></tr><tr>";
			text+="	<td align=center bgcolor=#FFFFFF  onclick=\"setfixremove(1);\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFFF99'\"><img src=\"../resource/images/eorder/teeth/fr_fix.gif\" width=\"32\" height=\"32\" border=\"0\"></td>";
			text+=" <td align=center bgcolor=#FFFFFF  onclick=\"setfixremove(2);\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFFF99'\"><img src=\"../resource/images/eorder/teeth/fr_remove.gif\" width=\"32\" height=\"32\" border=\"0\"></td>";
			text+="	</td></tr></table>";
		/*}else{
			var str = "Fix" ;
			if(m_teeth_list[m_select_teeth].isFix==2){
				str = "Remove" ;
			}
			text+="<table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\"><tr>";
			//text+="	<td  align=center height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeading\">"+str+"";
			//text+="	<a href=\"#fixteeth_select\" onclick=\"setfixremove(0);\"><img src=\"images/btn_cancel.gif\" width=\"16\" height=\"16\" border=\"0\"></a>";
			//text+="	</td></tr><tr>";
			text+="	<td align=center bgcolor=#FFFFFF  onclick=\"setfixremove(0);\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFCC99'\"><img src=\"../resource/images/eorder/teeth/fr_"+str+".gif\" width=\"32\" height=\"32\" border=\"0\"></td>";
			text+="	</td></tr></table>";

			if(m_teeth_list[m_select_teeth].isFix==1){
				text+=build_html_teeth_fix_method();
			}*/

		//}
	return text;
}
function build_html_teeth_fix_method(){
	text="";
	if(m_teeth_list[m_select_teeth].method==0){
		text+="<table width=150 border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\"><tr>";
		text+="	<td   colspan=4 align=center height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeading\">Method ?</td></tr>";
		text+="	<td align=center bgcolor=#FFFFFF  onclick=\"setmethod(1);\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFCC99'\"><img src=\"images/ty_tryin.gif\" width=\"32\" height=\"32\" border=\"0\"></a></td>";
		text+="	<td align=center bgcolor=#FFFFFF  onclick=\"setmethod(2);\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFCC99'\"><img src=\"images/ty_contour.gif\" width=\"32\" height=\"32\" border=\"0\"></td>";
		text+="	<td align=center bgcolor=#FFFFFF  onclick=\"setmethod(3);\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFCC99'\"><img src=\"images/ty_finish.gif\" width=\"32\" height=\"32\" border=\"0\"></td>";
		text+=" <td align=center bgcolor=#FFFFFF  onclick=\"setmethod(5);\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFCC99'\"><img src=\"images/ty_repair.gif\" width=\"32\" height=\"32\" border=\"0\"></td>";
		text+="	</td></tr></table>";
	}else{
		text+="<table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\"><tr>";
		//text+="	<td   align=center height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeading\">Method ?</td></tr>";
		text+="	<td align=center bgcolor=#FFFFFF  onclick=\"setmethod(0);\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFCC99'\"><img src=\"images/";
		switch(m_teeth_list[m_select_teeth].method){
			case 1: text+="ty_tryin";				break;
			case 2: text+="ty_contour";			break;
			case 3: text+="ty_finish";			break;
			case 4: text+="ty_finishdirect";	break;
			case 5: text+="ty_repair";			break;
		}
		text+=".gif\" width=\"32\" height=\"32\" border=\"0\"></td>";
		text+="	</td></tr></table>";

	}
	return text;
}

function build_html_teeth_fix(){
		text="";
		text+="				<table border=\"0\" cellspacing=\"0\" cellpadding=\"4\" align=center>";
		text+="                <tr>";
		text+="                  <td><table width=\"200\" border=\"0\" cellpadding=\"4\" cellspacing=\"1\" bgcolor=\"#000000\">";
		text+="                    <tr>";
		text+="                      <td height=\"25\" bgcolor=\"#CCCCCC\" class=\"TableHeadingNormal\">&nbsp;&nbsp;For all fix teeths </td>";
		text+="                    </tr>";
		text+="                    <tr>";
		text+="                      <td bgcolor=\"#F8F8F8\"><table border=0 cellpadding=0 cellspacing=2><tr>";


		
		if(m_teeth_list[m_select_teeth].method==0){
			text+="						 <td valign=top><table width=\"100\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
//			text+="						 <td valign=top><table width=\"100\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#CC3300\">";
			text+="                          <tr>";
			text+="                            <td height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\"> &nbsp;&nbsp;Method ?</td>";
			text+="                          </tr>";
			text+="                          <tr>";
			text+="                            <td bgcolor=\"#FFFFFF\" class=\"orderSmall\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
			text+="                                <tr onclick=\"setmethod(1);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].method==1?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].method==1?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].method==1?"bgcolor=#FFCC99":"")+">";
	//		text+="                                  <td width=\"16\"><input name=\"radiobutton\" type=\"radio\" value=\"radiobutton\" /></td>";
			text+="                                  <td width=\"32\"><img src=\"images/ty_tryin.gif\" width=\"32\" height=\"32\" /></td>";
			text+="                                  <td class=\"orderSmall\">Try - in </td>";
			text+="                                </tr>";
			text+="                                <tr onclick=\"setmethod(2);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].method==2?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].method==2?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].method==2?"bgcolor=#FFCC99":"")+">";
	//		text+="                                  <td width=\"16\"><input name=\"radiobutton\" type=\"radio\" value=\"radiobutton\" /></td>";
			text+="                                  <td width=\"32\"><img src=\"images/ty_contour.gif\" width=\"32\" height=\"32\" /></td>";
			text+="                                  <td class=\"orderSmall\">Contour</td>";
			text+="                                </tr>";
			text+="                                <tr onclick=\"setmethod(3);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].method==3?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].method==3?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].method==3?"bgcolor=#FFCC99":"")+">";
	//		text+="                                  <td width=\"16\"><input name=\"radiobutton\" type=\"radio\" value=\"radiobutton\" /></td>";
			text+="                                  <td width=\"32\"><img src=\"images/ty_finish.gif\" width=\"32\" height=\"32\" /></td>";
			text+="                                  <td class=\"orderSmall\">Finish</td>";
			text+="                                </tr>";
			text+="                                <tr onclick=\"setmethod(5);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].method==5?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].method==5?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].method==5?"bgcolor=#FFCC99":"")+">";
	//		text+="                                  <td width=\"16\"><input name=\"radiobutton\" type=\"radio\" value=\"radiobutton\" /></td>";
			text+="                                  <td width=\"32\"><img src=\"images/ty_repair.gif\" width=\"32\" height=\"32\" /></td>";
			text+="                                  <td class=\"orderSmall\">Repair</td>";
			text+="                                </tr>";
			text+="                            </table></td>";
			text+="                          </tr>";
			text+="                        </table></td>";
		}else{
			switch(m_teeth_list[m_select_teeth].method){
				case 1:	image = "tryin";break;
				case 2:	image = "contour";break;
				case 3:	image = "finish";break;
				case 5:	image = "repair";break;
			}
			text+="						 <td valign=top><table width=\"100\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
			text+="                          <tr><td height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\">&nbsp;&nbsp;Method</td></tr>";
			text+="                          <tr  onclick=\"setmethod(0);\"   bgcolor=\"#FFFFFF\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFFF99'\" >";
			text+="                          <td><table border=0 cellpadding=0 cellspacing=0><tr><td><img src=\"images/ty_"+image+".gif\" width=\"32\" height=\"32\"/></td><td class=\"orderSmall\">";
			switch(m_teeth_list[m_select_teeth].method){
				case 1:	text += "Try - in";break;
				case 2:	text += "Contour";break;
				case 3:	text += "Finish";break;
				case 5:	text += "Repair";break;
			}
			text+="                          </td></tr></table></td></tr></table></td>";
		}


		if(m_teeth_list[m_select_teeth].option5==0){
			text+="                          <td valign=top><table width=\"100\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
			text+="                            <tr>";
			text+="                              <td height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\">&nbsp;&nbsp;Embrasure ?</td>";
			text+="                            </tr>";
			text+="                            <tr>";
			text+="                              <td bgcolor=\"#FFFFFF\" class=\"orderSmall\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
	//		text+="                                  <tr onclick=\"setfixEmbrasure(2);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].option5==1?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].option5==1?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].option5==1?"bgcolor=#FFCC99":"")+">";
	////		text+="                                    <td width=\"16\"><input name=\"radiobutton\" type=\"radio\" value=\"radiobutton\" /></td>";setfixEmbrasure
	//		text+="                                    <td width=\"32\" height=\"32\" ></td>";
	//		text+="                                    <td class=\"orderSmall\">None </td>";
	//		text+="                                  </tr>";
			text+="                                  <tr onclick=\"setfixEmbrasure(2);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].option5==2?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].option5==2?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].option5==2?"bgcolor=#FFCC99":"")+">";
	//		text+="                                    <td width=\"16\"><input name=\"radiobutton\" type=\"radio\" value=\"radiobutton\" /></td>";setfixEmbrasure
			text+="                                    <td width=\"32\"><img src=\"../resource/images/eorder/teeth/em_open.gif\" width=\"32\" height=\"32\" /></td>";
			text+="                                    <td class=\"orderSmall\">Open </td>";
			text+="                                  </tr>";
			text+="                                  <tr onclick=\"setfixEmbrasure(3);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].option5==3?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].option5==3?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].option5==3?"bgcolor=#FFCC99":"")+">";
	//		text+="                                    <td width=\"16\"><input name=\"radiobutton\" type=\"radio\" value=\"radiobutton\" /></td>";
			text+="                                    <td width=\"32\"><img src=\"../resource/images/eorder/teeth/em_close.gif\" width=\"32\" height=\"32\" /></td>";
			text+="                                    <td class=\"orderSmall\">Close </td>";
			text+="                                  </tr>";
			text+="                              </table></td>";
			text+="                            </tr>";
			text+="                        </table></td>";
		}else{

			text+="						 <td valign=top><table width=\"100\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
			text+="                          <tr><td height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\">&nbsp;&nbsp;Embrasure</td></tr>";
			text+="                          <tr  onclick=\"setfixEmbrasure(0);\"   bgcolor=\"#FFFFFF\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFFF99'\" >";
			text+="                          <td><table border=0 cellpadding=0 cellspacing=0><tr><td >";
			switch(m_teeth_list[m_select_teeth].option5){
				case 2:	text += "<img src=\"../resource/images/eorder/teeth/em_open.gif\" width=\"32\" height=\"32\"  />";break;
				case 3:	text += "<img src=\"../resource/images/eorder/teeth/em_close.gif\" width=\"32\" height=\"32\"  />";break;
			}
			text+="</td><td class=\"orderSmall\">";
			switch(m_teeth_list[m_select_teeth].option5){
				case 1:	text += "&nbsp;None";break;
				case 2:	text += "&nbsp;Open";break;
				case 3:	text += "&nbsp;Close";break;
			}
			text+="                          </td></tr></table></td></tr></table></td>";
		}

		if(isAnyFixCeramic()){
			if(m_teeth_list[m_select_teeth].option6==0){
				text+="                        <td valign=top><table width=\"180\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
				text+="                            <tr>";
				text+="                              <td height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\">&nbsp;&nbsp;Alloy ?</td>";
				text+="                            </tr>";
				text+="                            <tr>";
				text+="                              <td height=\"20\" bgcolor=\"#FFFFFF\" ><table border=\"0\" cellpadding=\"2\" cellspacing=\"1\" width=\"100%\"> ";
				text+="                            <tr onclick=\"setfixAlloy(2);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==2?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==2?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].option6==2?"bgcolor=#FFCC99":"")+">";
				text+="                            <td class=\"orderSmall\">&nbsp;Non Precious </td></tr>";
				text+="                            <tr onclick=\"setfixAlloy(3);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==3?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==3?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].option6==3?"bgcolor=#FFCC99":"")+">";
				text+="                            <td class=\"orderSmall\">&nbsp;Non Nickel </td></tr>";
				text+="                            <tr onclick=\"setfixAlloy(4);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==4?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==4?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].option6==4?"bgcolor=#FFCC99":"")+">";
				text+="                            <td class=\"orderSmall\"> &nbsp;Precious-Palladium</td></tr>";
				text+="                            <tr onclick=\"setfixAlloy(5);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==5?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==5?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].option6==5?"bgcolor=#FFCC99":"")+">";
				text+="                            <td class=\"orderSmall\">&nbsp;Precious-Semi-Precious</td></tr>";
				text+="                            <tr onclick=\"setfixAlloy(6);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==6?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==6?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].option6==6?"bgcolor=#FFCC99":"")+">";
				text+="                            <td class=\"orderSmall\">&nbsp;Precious-White Gold </td></tr>";
				text+="                            <tr onclick=\"setfixAlloy(7);\" onMouseOut=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==7?"#FFCC99":"#FFFFFF")+"'\" onMouseOver=\"this.style.background='"+(m_teeth_list[m_select_teeth].option6==7?"#FFCC99":"#FFFF99")+"'\" "+(m_teeth_list[m_select_teeth].option6==7?"bgcolor=#FFCC99":"")+">";
				text+="                            <td class=\"orderSmall\">&nbsp;Precious-Yellow Gold </td></tr>";
				text+="                            </table></td></tr>";
				text+="                        </table></td>";
			}else{
				text+="						 <td valign=top><table width=\"180\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
				text+="                          <tr><td height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\">&nbsp;&nbsp;Alloy</td></tr>";
				text+="                          <tr  onclick=\"setfixAlloy(0);\"   bgcolor=\"#FFFFFF\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFFF99'\" >";
				text+="                          <td><table border=0 cellpadding=0 cellspacing=0><tr><td class=\"orderSmall\" height=32>&nbsp;";
				switch(m_teeth_list[m_select_teeth].option6){
					case 2:	text += "Non Precious";break;
					case 3:	text += "Non Nickel";break;
					case 4:	text += "Precious-Palladium";break;
					case 5:	text += "Precious-Semi-Precious";break;
					case 6:	text += "Precious-White Gold";break;
					case 7:	text += "Precious-Yellow Gold";break;
				}
				text+="                          </td></tr></table></td></tr></table></td>";
			}
		}

		if(isAnyFixBridge()){
			if(m_teeth_list[m_select_teeth].option4==0){
				text+="                        <td valign=top><table width=\"75\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
				text+="                            <tr>";
				text+="                              <td height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\">&nbsp;&nbsp;Pontic ?</td>";
				text+="                            </tr>";
				text+="                            <tr>";
				text+="                              <td bgcolor=\"#FFFFFF\"><table width=\"100%\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FFFFFF\">";
				text+="                                  <tr><td align=\"center\" onclick=\"setfixPontic(2);\"  onmouseover=\"this.style.background='#FFFF99'\"";
				text+="				  onmouseout=\"this.style.background=''\"><img src=\"images/fix_pontic1.gif\" width=\"32\" height=\"32\" /></td></tr>";
				text+="                                  <tr><td align=\"center\" onclick=\"setfixPontic(3);\"  onmouseover=\"this.style.background='#FFFF99'\"";
				text+="				  onmouseout=\"this.style.background=''\"><img src=\"images/fix_pontic2.gif\" width=\"32\" height=\"32\" /></td></tr>";
				text+="                                  <tr><td align=\"center\" onclick=\"setfixPontic(4);\"  onmouseover=\"this.style.background='#FFFF99'\"";
				text+="				  onmouseout=\"this.style.background=''\"><img src=\"images/fix_pontic3.gif\" width=\"32\" height=\"32\" /></td></tr>";
				text+="                                  <tr><td align=\"center\" onclick=\"setfixPontic(5);\"  onmouseover=\"this.style.background='#FFFF99'\"";
				text+="				  onmouseout=\"this.style.background=''\"><img src=\"images/fix_pontic4.gif\" width=\"32\" height=\"32\" /></td></tr>";
				text+="                              </table>";
				text+="								</td>";
				text+="                            </tr>";
				text+="                        </table></td>";
			}else{
				text+="						 <td valign=top><table width=\"75\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
				text+="                          <tr><td height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\">&nbsp;&nbsp;Pontic</td></tr>";
				text+="                          <tr  onclick=\"setfixPontic(0);\"   bgcolor=\"#FFFFFF\" onMouseOut=\"this.style.background='#FFFFFF'\" onMouseOver=\"this.style.background='#FFFF99'\" >";
				text+="                          <td align=center><img src=\"images/";
				switch(m_teeth_list[m_select_teeth].option4){
					case 2:	text += "fix_pontic1";break;
					case 3:	text += "fix_pontic2";break;
					case 4:	text += "fix_pontic3";break;
					case 5:	text += "fix_pontic4";break;
				}
				text+=".gif\" width=\"32\" height=\"32\"  /></td></tr></table></td>";
			}
		}

		text+="							</tr></table>";
		//text+=build_html_teeth_table();
		
		text+="                  <table width=500  border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#000000\" align=center>";
		text+="                    <tr>";
		text+="                      <td width=436 height=\"25\" bgcolor=\"#CCCCCC\" class=\"TableHeadingNormal\">&nbsp;&nbsp;For this teeth ["+get_teeth_number(m_select_teeth)+"]</td>";
		text+="                      <td width=50 bgcolor=\"#CCCCCC\" align=center><input type=\"button\" style=\"width:50;height:23;font-size:9px\" onclick=\"setfixremove(0);\" value=\"Reset\" /></td>";
		text+="                    </tr>";
		text+="                    <tr>";
		text+="                      <td bgcolor=\"#F8F8F8\" class=\"orderSmall\" colspan=2><table height=\"100%\" border=\"0\" cellpadding=\"4\" cellspacing=\"0\">";
		text+="                          <tr>";
		text+="                            <td valign=\"top\"><table width=\"250\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
		text+="                                <tr>";
		text+="                                  <td width=\"189\" height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\">&nbsp;&nbsp;Material </td>";
		text+="                                  <td width=\"50\" align=\"center\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\"><input type=\"button\" style=\"width:50;height:18;font-size:9px\" onclick=\"popup_selectfixmaterial();\" value=\"Select\" /></td>";
		text+="                                </tr>";
		text+="                                <tr>";

		
//		text+="                                  <td colspan=\"2\" bgcolor=\"#FFFFFF\" class=\"orderSmall\">&nbsp;"+m_teeth_list[m_select_teeth].material==0?"No material select":getFixMaterialName(m_teeth_list[m_select_teeth].material)+"</td>";
		if(m_teeth_list[m_select_teeth].material==0){
				text+="                                  <td colspan=\"2\" bgcolor=\"#FFFFFF\" class=\"orderSmall\">&nbsp;No material select</td>";
		}else{
				text+="                                  <td colspan=\"2\" bgcolor=\"#FFFFFF\" class=\"orderSmall\">&nbsp;"+getFixMaterialName(m_teeth_list[m_select_teeth].material)+"</td>";
		}
		text+="                                </tr>";
		text+="                              </table>";
		text+="                                <table>";
		text+="                                  <tr>";
		text+="                                    <td height=\"2\"></td>";
		text+="                                  </tr>";
		text+="                                </table>";


		if(m_teeth_list[m_select_teeth].method==3){
			text+="                              <table width=\"250\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
			text+="                                  <tr>";
			text+="                                    <td width=\"189\" height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\">&nbsp;&nbsp;Shade</td>";
			text+="                                    <td width=\"50\" align=\"center\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\"><input name=\"button22\" type=\"button\" id=\"button2\" style=\"width:50;height:18;font-size:9px\" onclick=\"popup_selectcolor();\" value=\"Select\" /></td>";
			text+="                                  </tr>";
			text+="                                  <tr>";
			text+="                                    <td colspan=\"2\" bgcolor=\"#FFFFFF\" class=\"orderSmall\" >&nbsp;"+(m_teeth_list[m_select_teeth].option8==0?"No color select":m_teeth_list[m_select_teeth].option9)+" </td>";
			text+="                                  </tr>";
			text+="                                  <tr>";
			text+="                                    <td colspan=\"2\" align=\"center\" bgcolor=\"#FFFFFF\"><a href=\"#fixteeth_select\"  onclick=\"popup_selectcolor();\"></a>";
			text+="                                        <table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" bgcolor="+(m_teeth_list[m_select_teeth].option8==0?"#CCCCCC":m_teeth_list[m_select_teeth].option10)+">";
			text+="                                          <tr>";
			text+="                                            <td><a href=\"javascript:;\"  onclick=\"popup_selectcolor();\"><img src=\"../resource/images/eorder/teeth/preview.gif\" width=\"147\" height=\"134\" border=\"0\" /></a></td>";
			text+="                                          </tr>";
			text+="                                      </table></td>";
			text+="                                  </tr>";
			text+="                              </table>";
		}

		text+="                              </td>";
		text+="                            <td valign=\"top\">";

		if(m_teeth_list[m_select_teeth].material!=0){
			text+="                            <table width=\"220\" border=\"0\" cellpadding=\"2\" cellspacing=\"1\" bgcolor=\"#FFCC33\">";
			text+="                                <tr>";
			text+="                                  <td height=\"20\" bgcolor=\"#FFFF99\" class=\"TableHeadingNormal\">&nbsp;&nbsp;Option</td>";
			text+="                                </tr>";
			text+="                                <tr>";
			text+="                                  <td bgcolor=\"#FFFFFF\" class=\"orderSmall\"><table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";

			if(isCeramic(m_teeth_list[m_select_teeth])){
//				text+="                                      <tr>";
//				text+="                                        <td width=\"16\"><input name=\"radiobutton\" type=\"radio\" value=\"radiobutton\" /></td>";
//				text+="                                        <td width=\"32\" height=\"32\">&nbsp;</td>";
//				text+="                                        <td class=\"orderSmall\">None</td>";
//				text+="                                      </tr>";
				text+="                                      <tr>";
				text+="                                        <td width=\"16\"><input type=\"checkbox\" "+(m_teeth_list[m_select_teeth].option2==2||m_teeth_list[m_select_teeth].option2==4?"checked":"")+" onclick=\"toggleFixMetelColarLingual();\" /></td>";
				text+="                                        <td><img src=\"../resource/images/eorder/teeth/op_mcl.gif\" width=\"32\" height=\"32\" /></td>";
				text+="                                        <td class=\"orderSmall\">Metel Collar Lingual</td>";
				text+="                                      </tr>";
				text+="                                      <tr>";
				text+="                                        <td><input type=\"checkbox\" "+(m_teeth_list[m_select_teeth].option2==3||m_teeth_list[m_select_teeth].option2==4?"checked":"")+" onclick=\"toggleFixMetelColar360();\" /></td>";
				text+="                                        <td width=\"32\"><img src=\"../resource/images/eorder/teeth/op_mc360.gif\" width=\"32\" height=\"32\" /></td>";
				text+="                                        <td class=\"orderSmall\">Metel Collar 360&deg; </td>";
				text+="                                      </tr>";
				text+="                                      <tr>";
				text+="                                        <td height=\"4\" colspan=\"3\" bgcolor=\"#FFFF99\"></td>";
				text+="                                      </tr>";
				text+="                                      <tr>";
				text+="                                        <td><input type=\"checkbox\" "+(m_teeth_list[m_select_teeth].option3==2||m_teeth_list[m_select_teeth].option3==4?"checked":"")+" onclick=\"toggleFixMagin();\" /></td>";
				text+="                                        <td><img src=\"../resource/images/eorder/teeth/op_pm.gif\" width=\"32\" height=\"32\" /></td>";
				text+="                                        <td class=\"orderSmall\">Porcelain Margin </td>";
				text+="                                      </tr>";
				text+="                                      <tr>";
				text+="                                        <td><input type=\"checkbox\" "+(m_teeth_list[m_select_teeth].option3==3||m_teeth_list[m_select_teeth].option3==4?"checked":"")+" onclick=\"toggleFixStepbar();\" /></td>";
				text+="                                        <td><img src=\"../resource/images/eorder/teeth/op_sb.gif\" width=\"32\" height=\"32\" /></td>";
				text+="                                        <td class=\"orderSmall\">Step bar</td>";
				text+="                                      </tr>";
				text+="                                      <tr>";
				text+="                                        <td height=\"4\" colspan=\"3\" bgcolor=\"#FFFF99\"></td>";
				text+="                                      </tr>";
			}
			text+="                                      <tr>";
			text+="                                        <td width=\"16\"><input type=\"checkbox\" "+(m_teeth_list[m_select_teeth].option7==1?"checked":"")+" onclick=\"setAttach("+(m_teeth_list[m_select_teeth].option7==1?"0":"1")+");\" /></td>";
			text+="                                        <td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/teeth/op_att.gif\" width=\"32\" height=\"32\" /></td>";
			text+="                                        <td class=\"orderSmall\">Attach </td>";
			text+="                                      </tr>";
			text+="                                      <tr>";
			text+="                                        <td height=\"4\" colspan=\"3\" bgcolor=\"#FFFF99\"></td>";
			text+="                                      </tr>";			
			text+="                                      <tr>";
			text+="                                        <td><input type=\"checkbox\" "+(m_teeth_list[m_select_teeth].option1==2?"checked":"")+" onclick=\"toggleFixSingleBridge();\" /></td>";
//			text+="                                        <td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/teeth/op_att.gif\" width=\"32\" height=\"32\" /></td>";
			if(m_teeth_list[m_select_teeth].option1==2){
				text+="                                        <td class=\"orderSmall\" colspan=2>Bridge "+(temp2!=-1?" with "+get_teeth_number(temp2):"(select below)")+"<td>";
				text+="                                      </tr>";
				text+="                                      <tr>";
				text+="												<td colspan=3  onmouseout=\"temp2=-1;refresh_main_display();\"><table  border=\"0\" cellspacing=\"1\" cellpadding=\"1\" bgcolor=#000000  ><tr class=\"orderSmall\"  bgcolor=#FFFFFF >";
				for(var i=0;i<16;i++){
					text+="												<td width=8 height=10  onmouseover=\"temp2="+i+";refresh_main_display();\"></td>";
				}
				text+="												</tr></table></td>";
				text+="                                      </tr>";
			}else{
				text+="                                        <td class=\"orderSmall\" colspan=2>Bridge <td>";
				text+="                                      </tr>";
			}
//			text+="                                      <tr>";
//			text+="                                        <td></td>";
//			text+="                                        <td colspan=2></td>";
//			text+="                                      </tr>";

			text+="                                  </table></td>";
			text+="                                </tr>";
			text+="                            </table>";
		}
		text+="                          </td></tr>";
		text+="                      </table>";
		text+="                    </td></tr>";
		text+="                  </table>";
		text+="                </td></tr>";
		text+="              </table>";

		//text+=" ccccc";

		return text;
}

function refresh_main_display(){
	text="";
	text+=build_html_teeth_table();
	text+="<table><tr><td height=4></td></tr></table>";
	switch(m_popup_panel){
		case 0:
			if(m_select_teeth!=-1){
				if(m_teeth_list[m_select_teeth].isFix == 0){
					text+=build_html_teeth_fix_remove_select();
				}else{
					text+=build_html_teeth_fix();
				}
			}
			break;
		case 1:
			text+=build_html_selectcolor();
			break;
		case 2:
			text+=build_html_selectfixmaterial();
			break;
	}
	writeit('main_display',text);
}


		  


                  