
var txtmaterialid = new Array();
var txtmaterialname = new Array();
var txtmaterialimage = new Array();
txtmaterialid[ 0] = 1;		txtmaterialname[ 0] ="PFM";									txtmaterialimage[ 0] ="d_pfm";
txtmaterialid[ 1] = 2;		txtmaterialname[ 1] ="PFM Richmond";					txtmaterialimage[ 1] ="d_pfm_richmond";	
txtmaterialid[ 2] = 3;		txtmaterialname[ 2] ="PFM Marryland Bridge";			txtmaterialimage[ 2] ="d_pfm_marryland_bridge";		
txtmaterialid[ 3] = 4;		txtmaterialname[ 3] ="PFM on Implant";					txtmaterialimage[ 3] ="d_pfm_implant";		
txtmaterialid[ 4] = 5;		txtmaterialname[ 4] ="PF";									txtmaterialimage[ 4] ="d_pf";		
txtmaterialid[ 5] = 6;		txtmaterialname[ 5] ="FMC";									txtmaterialimage[ 5] ="d_fmc";	
txtmaterialid[ 6] = 7;		txtmaterialname[ 6] ="Inlay/Onlay";						txtmaterialimage[ 6] ="d_inlay_outlay";			
txtmaterialid[ 7] = 8;		txtmaterialname[ 7] ="Rest";								txtmaterialimage[ 7] ="d_rest";		
txtmaterialid[ 8] = 9;		txtmaterialname[ 8] ="Gingival mask";						txtmaterialimage[ 8] ="d_gingival";
txtmaterialid[ 9] = 10;		txtmaterialname[ 9] ="Temperary Crown";				txtmaterialimage[ 9] ="d_tc";					
txtmaterialid[10] = 11;		txtmaterialname[10] ="Temperary Abutment";		txtmaterialimage[10] ="d_ta";						
txtmaterialid[11] = 100;	txtmaterialname[11] ="Pintooth";							txtmaterialimage[11] ="d_pintooth";		
txtmaterialid[12] = 200;	txtmaterialname[12] ="Pintooth Root II";				txtmaterialimage[12] ="d_pintooth2";	
txtmaterialid[13] = 301;	txtmaterialname[13] ="Empress II";						txtmaterialimage[13] ="d_e";	
txtmaterialid[14] = 302;	txtmaterialname[14] ="Inlay/Onlay Empress II";		txtmaterialimage[14] ="d_ioe";						
txtmaterialid[15] = 303;	txtmaterialname[15] ="Inlay Empress II";				txtmaterialimage[15] ="d_ie";			
txtmaterialid[16] = 305;	txtmaterialname[16] ="Inceram";							txtmaterialimage[16] ="d_i";				
txtmaterialid[17] = 306;	txtmaterialname[17] ="Crown Inceram";					txtmaterialimage[17] ="d_ci";				
txtmaterialid[18] = 310;	txtmaterialname[18] ="Cercon";							txtmaterialimage[18] ="d_c";	
txtmaterialid[19] = 311;	txtmaterialname[19] ="Crown Cercon";					txtmaterialimage[19] ="d_cc";				
txtmaterialid[20] = 312;	txtmaterialname[20] ="Veneer Cercon";					txtmaterialimage[20] ="d_vc";		
txtmaterialid[21] = 315;	txtmaterialname[21] ="Procera";							txtmaterialimage[21] ="d_p";
txtmaterialid[22] = 316;	txtmaterialname[22] ="Procera Alumina";				txtmaterialimage[22] ="d_pa";			
txtmaterialid[23] = 317;	txtmaterialname[23] ="Procera Zirconia";				txtmaterialimage[23] ="d_pz";		
txtmaterialid[24] = 318;	txtmaterialname[24] ="Veneer Procera Alumina";		txtmaterialimage[24] ="d_vpa";					
txtmaterialid[25] = 319;	txtmaterialname[25] ="Veneer Procera Zirconia";		txtmaterialimage[25] ="d_vpz";					
txtmaterialid[26] = 320;	txtmaterialname[26] ="Zirconium Dioxide";				txtmaterialimage[26] ="d_zi";		
txtmaterialid[27] = 321;	txtmaterialname[27] ="Zirconium Dioxide Green";		txtmaterialimage[27] ="d_zg";			
txtmaterialid[28] = 322;	txtmaterialname[28] ="Zirconium Dioxide Hip";			txtmaterialimage[28] ="d_zh";				
txtmaterialid[29] = 325;	txtmaterialname[29] ="Zeno System";					txtmaterialimage[29] ="d_ze";
txtmaterialid[30] = 326;	txtmaterialname[30] ="Crown Zeno";						txtmaterialimage[30] ="d_cz";			
txtmaterialid[31] = 330;	txtmaterialname[31] ="Composite";						txtmaterialimage[31] ="d_com";		
txtmaterialid[32] = 331;	txtmaterialname[32] ="Crown Composite";				txtmaterialimage[32] ="d_ccom";					
txtmaterialid[33] = 332;	txtmaterialname[33] ="Veneer Composite";			txtmaterialimage[33] ="d_vcom";					
txtmaterialid[34] = 333;	txtmaterialname[34] ="Inlay/Onlay Composite";		txtmaterialimage[34] ="d_icom";					

// */


var temp = 0;

function getFixMaterialName(id){
	for(i=0;i<txtmaterialid.length;i++){
		if(txtmaterialid[i]==id)
			return txtmaterialname[i];
	}
	if(id>100&&id<200){
		return getFixMaterialName(id-100)+" + "+getFixMaterialName(100);
	}else if(id>200&&id<300){
		return getFixMaterialName(id-200)+" + "+getFixMaterialName(200);
	}
	return '';
}
function getFixMaterialImage(id){
	for(i=0;i<txtmaterialid.length;i++){
		if(txtmaterialid[i]==id)
			return txtmaterialimage[i];
	}
	return '';
}

function popup_selectfixmaterial(){
	activeBG();
	selectbrand=temp>300?1:0;
	refresh_selectfixmaterial();
	//moveLayerToMouseLoc('PopUPSelectFixMaterial',-565,-380);
	makeCenterScreen('PopUPSelectFixMaterial');
	showHideLayers('PopUPSelectFixMaterial','','show');
}
function close_selectfixmaterial(){
	showHideLayers('PopUPSelectFixMaterial','','hide');
	hideBG();
}
function refresh_selectfixmaterial(){
	writeit('PopUPSelectFixMaterial',build_html_selectfixmaterial());
}
function selectfixmaterialApply(){
	 close_selectfixmaterial();
	m_teeth_list[m_select_teeth].material = temp; 
	m_teeth_list[m_select_teeth].isFix = 1;
	onMouseOutTeeth(m_select_teeth);
}
function resetfixmaterial(){
	temp=0;
	refresh_selectfixmaterial();
}
function selectfixmaterial(id){
	if(id>300){
		if(temp==id){
			temp=0;
		}else{
			temp = id;
		}
	}else{
		if(temp < 300 && id%100!=0 && id%100==temp%100){
			temp-=id%100;
		}else

		if (id==100){
			if (temp<100){
				temp+=100;
//			}else if(temp<200){
//				temp-=100;
			}else if(temp<300){
				temp-=100;
			}else{
				temp = id;
			}
		}else if (id==200){
			if (temp<100){
				temp+=200;
			}else if(temp<200){
				temp+=100;
			}else if(temp<300){
				temp-=200;
			}else{
				temp = id;
			}
		}else{
			if (temp<100){
				temp=id;
			}else if(temp<200){
				temp=100+id;
			}else if(temp<300){
				temp=200+id;
			}else{
				temp = id;
			}
		}


	}
	refresh_selectfixmaterial();
}


function popFixTooltip(head,text,w,h){
	text='';	
	text='<a href="" target=_blank>Tip</a>';
	//writeit('selectfixmaterialtip',text); 
}
function closeFixTooltip(){
	text='';
	text+='<a href="" target=_blank>Tip</a>';
	//writeit('selectfixmaterialtip',text); 
}



function build_html_selectfixmaterial(){
	text = "";
	text+="<table width=100% height=100% border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#000000\" align=center>";
	text+="  <tr>";
	var name = temp==0?"":" [ "+getFixMaterialName(temp)+" ] ";//+"<input type=\"button\" value=\"X\" onClick=\"selectfixmaterial(0);\" style=\"width:24;height:24;font-weight:bold;font-size:10px\">";
	text+="    <td  bgcolor=\"#FFCC66\" height=32 class=\"TableHeadingNormal\"  align=right><table border=0 cellpadding=0 cellspacing=0 width=90% class=\"TableHeadingNormal\"><tr><td  align=left width=250><font color=#000000 style=\"font-size:16px\">Select type of work </font> "+ get_teeth_number(m_select_teeth)+"th teeth</td><td> "+name+"</td>";
	text+="    <td  width=32 align=right>"+build_html_teeth_imagematerial(temp)+"</td><td width=5></td></tr></table></td>";
	text+="  </tr>";
	text+="  <tr>";
	text+="    <td  align=\"center\" valign=\"top\" bgcolor=\"#FFFFFF\" >";

	switch(selectbrand){
		case 0: text+= build_html_selectfixmaterialcb(); break;
		case 1: text+= build_html_selectfixmaterialac(); break;
	}

	text+="  </td></tr>";
	text+="  <tr>";
	text+="    <td bgcolor=\"#FFCC66\"  height=25  ><table width=100%><tr><td  align=\"left\">";
	text+="    <input type=\"button\" value=\"Reset\" onClick=\"resetfixmaterial();\" style=\"width:50;height:24;font-weight:bold;font-size:12px\"></td>";
	
	if( temp==310 || temp==312 || temp==316 || temp==317 ){
		text+="<td align=center>"
		text+='<a href="../order/ordertip.html#'+temp+'" target=_blank><img src=../resource/images/silkicons/tip.gif border=0> Please see tip for '+name+ ' <img src=../resource/images/silkicons/tip.gif border=0></a>';
		text+="</td>";
	}
	
	text+="    <td align=\"right\"><input type=\"button\" value=\"Apply\" onClick=\"selectfixmaterialApply();\" style=\"width:50;height:24;font-weight:bold;font-size:12px\">";
	text+="    <input type=\"button\" value=\"X\" onClick=\"javascript:close_selectfixmaterial();\" style=\"width:24;height:24;font-weight:bold;font-size:12px\"></td></tr></table></td>";
	text+="  </tr>";
	text+="</table>";
	return text;

}
function select_materialcb(){	selectbrand=0;	refresh_selectfixmaterial();}
function select_materialac(){	selectbrand=1;	refresh_selectfixmaterial();}

function build_html_selectfixmaterialcb(){
	//alert('');
	var bg='';var id=0;var name='';
	text='';
	text+="	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td bgcolor=\"#FFFFFF\" class=\"TableHeadingNormal\" ><font color=#000000 style=\"cursor:default;font-size:14px\">Crown &amp; Bridge</font></td><td width=2></td>";
	//FFFF99
	text+="        <td bgcolor=\"#CCCCCC\" class=\"TableHeadingNormal\" onmousemove=\"select_materialac();\"><font color=#666666 style=\"font-size:14px\">All ceramic</font></td>";
	text+="      </tr>";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td bgcolor=\"#FFFFFF\" ></td><td></td>";
	text+="        <td></td>";
	text+="      </tr>";
	text+="    </table><br/>";

	text+="					<table width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"1\">";
	text+="                        <tr>";

	id = 1;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td width=33%><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/fix/d_pfm.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td>";
	
	
	id = 6;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_fmc.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td>";	
	

	id = 9;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_gingival.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td>";


	text+="                        </tr>";
	text+="                        <tr>";
	
	id = 4;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_pfm_implant.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td></tr></table></td>";	
	
	id = 7;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_inlay_outlay.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td>";
	
	
	id = 10;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_tc.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td>";
	
//	text+="                          <td>&nbsp;</td>";
/*
	id = 2;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td ><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  onMouseOut=\"this.style.background='"+bg+"'\" onMouseOver=\"this.style.background='#FFFF99'\" bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_pfm_richmond.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td>";
	// */


	text+="                        </tr>";
	text+="                        <tr>";
	
	id = 5;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_pf.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td>";
	
	
	id = 8;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td width=33%><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_rest.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td>";	
	/*
	id = 3;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  onMouseOut=\"this.style.background='"+bg+"'\" onMouseOver=\"this.style.background='#FFFF99'\" bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_pfm_marryland_bridge.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td></tr></table></td>";
	//*/
	id = 11;bg = temp%100==id && temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_ta.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td></tr></table></td>";

	text+="                        </tr>";


	text+="                        <tr><td colspan=3 height=4 bgcolor=FFCC66></td></tr>";


	text+="                        <tr>";

	id = 100;bg = temp>=100&&temp<200?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_pintooth.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td></tr></table></td>";

	id = 200;bg = temp>=200&&temp<300?"#FFCC99":"#FFFFFF";name = getFixMaterialName(id);
	text+="                          <td><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\"><img src=\"../resource/images/eorder/fix/d_pintooth2.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td></tr></table></td>";
	
	text+="                          <td>&nbsp;</td>";
	text+="                        </tr>";
	text+="                      </table>";


	return text;

}

function build_html_selectfixmaterialac(){
	//alert('');
	var bg='';
	text='';
	text+="	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td bgcolor=\"#CCCCCC\" class=\"TableHeadingNormal\" onmousemove=\"select_materialcb();\"><font color=#666666 style=\"font-size:14px\">Crown &amp; Bridge</font></td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFFFF\" class=\"TableHeadingNormal\" ><font color=#000000 style=\"cursor:default;font-size:14px\">All ceramic</font></td>";
	text+="      </tr>";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td></td><td></td>";
	text+="        <td bgcolor=\"#FFFFFF\" ></td>";
	text+="      </tr>";
	text+="    </table>";

	text+="		<BR><table width=\"700\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\"><tr><td colspan=5 height=8></td></tr>";
	text+="                          <tr>";
	
	id = 301;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  onMouseOut=\"closeFixTooltip();\" onMouseOver=\"popFixTooltip('[Notice]','Empress type can be bridge at most 3 teeths.',150,100);\" bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_e.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";
	text+="                            <td width=\"8\" rowspan=\"8\"></td>";
	
	id = 316;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  onMouseOut=\"closeFixTooltip();\" onMouseOver=\"popFixTooltip('[Notice]','Procera type can be bridge at most 3 teeths.',150,100);\" bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_pa.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";
	
	id = 318;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_vpa.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";
	text+="                          </tr>";
	text+="                          <tr>";
	
	id = 302;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  onMouseOut=\"closeFixTooltip();\" onMouseOver=\"popFixTooltip('[Notice]','Empress type can be bridge at most 3 teeths.',150,100);\" bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_ioe.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";
	
	id = 317;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  onMouseOut=\"closeFixTooltip();\" onMouseOver=\"popFixTooltip('[Notice]','Procera type can be bridge at most 3 teeths.',150,100);\" bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_pz.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";	
	
	id = 319;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_vpz.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";	
	text+="                          </tr>";
	text+="                          <tr>";
	
	id = 303;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  onMouseOut=\"closeFixTooltip();\" onMouseOver=\"popFixTooltip('[Notice]','Empress type can be bridge at most 3 teeths.',150,100);\" bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_ie.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";	
	
	id = 320;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_zi.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";

	id = 325;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_ze.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                            </table></td>";
	text+="                          </tr>";
	text+="                          <tr>";	
	
	id = 305;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  onMouseOut=\"closeFixTooltip();\" onMouseOver=\"popFixTooltip('[Notice]','Inceram type can be single teeth only.',150,100);\" bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_i.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";	
	
	id = 321;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_zg.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";


	id = 330;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_com.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                            </table></td>";
	text+="                          </tr>";
	text+="                          <tr>";
	
	id = 310;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_c.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";	

	id = 322;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_zh.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";

	id = 332;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_vcom.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                            </table></td>";
	text+="                          </tr>";
	text+="                          <tr>";

	id = 312;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_vc.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";
	
	text+="                            <td>&nbsp;</td>";
	
	id = 333;bg = temp==id?"#FFCC99":"#FFFFFF";name=getFixMaterialName(id);
	text+="                            <td><table border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectfixmaterial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr>";
	text+="                                  <td width=32><img src=\"../resource/images/eorder/fix/d_icom.gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+" </td>";
	text+="                                </tr>";
	text+="                                                          </table></td>";
	text+="                          </tr>";	
	
	text+="                      </table>";

	return text;
	//writeit('color_table_display',text);
}
