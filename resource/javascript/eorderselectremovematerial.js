
var txtrematerialid = new Array();
var txtrematerialname = new Array();
var txtrematerialimage = new Array();
var i=0;
txtrematerialid[i] = 100;txtrematerialname[i] ="RPD";						txtrematerialimage[i] ="d_rpd"; 				i++;
txtrematerialid[i] = 151;txtrematerialname[i] ="Decolte";					txtrematerialimage[i] ="d_decolte"; 			i++;
txtrematerialid[i] = 152;txtrematerialname[i] ="Plein";						txtrematerialimage[i] ="d_plein"; 				i++;
txtrematerialid[i] = 153;txtrematerialname[i] ="Fil Chingulaire";			txtrematerialimage[i] ="d_fc"; 					i++;
txtrematerialid[i] = 154;txtrematerialname[i] ="Banne espace";			txtrematerialimage[i] ="d_banne"; 			i++;


txtrematerialid[i] = 2;		txtrematerialname[i] ="TP";							txtrematerialimage[i] ="d_tp"; 			i++;
txtrematerialid[i] = 3;		txtrematerialname[i] ="Repair";						txtrematerialimage[i] ="d_repair"; 		i++;
txtrematerialid[i] = 4;		txtrematerialname[i] ="Vitaflex";					txtrematerialimage[i] ="d_vitaflex"; 	i++;


txtrematerialid[i] = 211;		txtrematerialname[i] ="Clasp Acetal";			txtrematerialimage[i] ="d_o_acetal"; 			i++;
txtrematerialid[i] = 212;		txtrematerialname[i] ="Clasp Metal";			txtrematerialimage[i] ="d_o_metal"; 			i++;
txtrematerialid[i] = 213;		txtrematerialname[i] ="Clasp Vitaflex";		txtrematerialimage[i] ="d_o_vitaflex"; 			i++;
txtrematerialid[i] = 214;		txtrematerialname[i] ="Adjunction";			txtrematerialimage[i] ="d_adjunction"; 			i++;
txtrematerialid[i] = 215;		txtrematerialname[i] ="Backing";				txtrematerialimage[i] ="d_backing"; 				i++;
txtrematerialid[i] = 216;		txtrematerialname[i] ="Full Metal";				txtrematerialimage[i] ="d_fullmetal"; 				i++;
txtrematerialid[i] = 217;		txtrematerialname[i] ="Full Resine";			txtrematerialimage[i] ="d_fullresine"; 				i++;
txtrematerialid[i] = 218;		txtrematerialname[i] ="Rest";					txtrematerialimage[i] ="d_rest"; 					i++;
txtrematerialid[i] = 219;		txtrematerialname[i] ="Clasp Acetal";			txtrematerialimage[i] ="d_i_acetal"; 			i++;
txtrematerialid[i] = 220;		txtrematerialname[i] ="Clasp Metal";			txtrematerialimage[i] ="d_i_metal"; 			i++;
txtrematerialid[i] = 221;		txtrematerialname[i] ="Clasp Vitaflex";		txtrematerialimage[i] ="d_i_vitaflex"; 			i++;

// */


temp = 0;

function getRemoveMaterialName(id){
	for(i=0;i<txtrematerialid.length;i++){
		if(txtrematerialid[i]==id)
			return txtrematerialname[i];
	}
	return '';
}
function getRemoveMaterialImage(id){
	for(i=0;i<txtrematerialid.length;i++){
		if(txtrematerialid[i]==id)
			return txtrematerialimage[i];
	}
	return '';
}

function popup_selectremovematerial(){
	activeBG();
	refresh_selectremovematerial();
	//moveLayerToMouseLoc('PopUPSelectRemoveMaterial',-565,-380);
	if(m_select_teeth<32){
		makeCenterScreen('PopUPSelectRemoveMaterialEach');
		showHideLayers('PopUPSelectRemoveMaterialEach','','show');
	}else{
		makeCenterScreen('PopUPSelectRemoveMaterial');
		showHideLayers('PopUPSelectRemoveMaterial','','show');
	}
}
function close_selectremovematerial(){
	showHideLayers('PopUPSelectRemoveMaterialEach','','hide');
	showHideLayers('PopUPSelectRemoveMaterial','','hide');
	hideBG();
}
function refresh_selectremovematerial(){
	if(m_select_teeth<32){
		writeit('PopUPSelectRemoveMaterialEach',build_html_selectremovematerialEach());
	}else{
		writeit('PopUPSelectRemoveMaterial',build_html_selectremovematerial());
	}
}
function selectremovematerialApply(){
	close_selectremovematerial();
	m_teeth_list[m_select_teeth].material = temp; 
	m_teeth_list[m_select_teeth].isFix = 2;
	onMouseOutTeethR(m_select_teeth);
}
function resetremovematerial(){
	temp=0;
	refresh_selectremovematerial();
}
function selectremovematerial(id){
	if(temp==id){
		temp = 0;
	}else{
		if(temp<100 || id<100 ){
			temp = id;
		}else{
			var opt = temp - 100;
			var isDecolte = opt%16>7;
			var isPlein = opt%8>3;
			var isFilC = opt%4>1;
			var isBanne = opt%2==1;
			switch(id)	{
				case 100:
					if(temp<100){
						temp = 100;
					}else{
						temp =0;
					}
					break;
				case 151: 
					isDecolte = !isDecolte;	
					if(isDecolte && isPlein){
						isPlein=!isDecolte;
					}
					break;
				case 152: 
					isPlein 		= !isPlein;		
					if(isDecolte && isPlein){
						isDecolte=!isPlein; 
					}
					break;
				case 153: isFilC 		= !isFilC;			break;
				case 154: isBanne 	= !isBanne;		break;
			}
			if(temp!=0){
				opt = 0;
				if(isDecolte)opt+=8;
				if(isPlein)opt+=4;
				if(isFilC)opt+=2;
				if(isBanne)opt+=1;
				temp = 100+opt;
			}
		}
	}
	refresh_selectremovematerial();
}
function selectremovematerialeach(id){
	if(temp+0==0)temp=2000;
	var opt = temp - 2000;
	var middle 		= Math.floor((opt%1000)/100);
	var outside 	= Math.floor((opt% 100)/ 10);
	var inside 		= Math.floor((opt%  10)/   1);
	switch(id)	{
		case 211:
			if(outside!=1){outside=1;if(middle!=5){middle=0;}}else{outside=0;}break;
		case 212:
			if(outside!=2){outside=2;if(middle!=5){middle=0;}}else{outside=0;}break;
		case 213:
			if(outside!=3){outside=3;if(middle!=5){middle=0;}}else{outside=0;}break;


		case 214:
			if(middle!=1){middle=1;outside=0;inside=0;}else{middle=0;}break;
		case 215:
			if(middle!=2){middle=2;outside=0;inside=0;}else{middle=0;}break;
		case 216:
			if(middle!=3){middle=3;outside=0;inside=0;}else{middle=0;}break;
		case 217:
			if(middle!=4){middle=4;outside=0;inside=0;}else{middle=0;}break;
		case 218:
			if(middle!=5){middle=5;}else{middle=0;}break;




		case 219:
			if(inside!=1){inside=1;if(middle!=5){middle=0;}}else{inside=0;}break;
		case 220:
			if(inside!=2){inside=2;if(middle!=5){middle=0;}}else{inside=0;}break;
		case 221:
			if(inside!=3){inside=3;if(middle!=5){middle=0;}}else{inside=0;}break;
	}
	//if(temp!=0){
		opt = 0;
		opt+=middle*100;
		opt+=outside*10;
		opt+=inside*1;
		temp = 2000+opt;
	//}
	if(temp+0==2000)temp=0;
	
	
	refresh_selectremovematerial();
}



function build_html_selectremovematerial(){
	text = "";
	text+="<table width=100% height=100% border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#000000\" align=center>";
	text+="  <tr>";
	var name = temp==0?"":temp>100?" [ "+getRemoveMaterialName(100)+" ] ":" [ "+getRemoveMaterialName(temp)+" ] ";//+"<input type=\"button\" value=\"X\" onClick=\"selectremovematerial(0);\" style=\"width:24;height:24;font-weight:bold;font-size:10px\">";
	var teeth_name = m_select_teeth==32?"upper":"lower";
	text+="    <td  bgcolor=\"#FFCC66\" height=32 class=\"TableHeadingNormal\"  align=right><table border=0 cellpadding=0 cellspacing=0 width=90% class=\"TableHeadingNormal\"><tr><td  align=left  height = 25><font color=#000000 style=\"font-size:16px\">Select type of work </font></td>";
	text+="    <td  width=32  height = 50 align=right rowspan=2>"
	if(temp>100){
		text+="<img src=../resource/images/eorder/remove/"+getRemoveMaterialImage(100)+".gif width=32 height=32>";
	}else 	if(temp>0){
		text+="<img src=../resource/images/eorder/remove/"+getRemoveMaterialImage(temp)+".gif width=32 height=32>";
	}
	text+="</td><td width=5 rowspan=2></td></tr><tr><td>"+ teeth_name+" teeth"+name+"</td></table></td>";
	text+="  </tr>";
	text+="  <tr>";
	text+="    <td  align=\"center\" valign=\"top\" bgcolor=\"#FFFFFF\" ><br>";

	text+="					<table width=\"200\" border=\"0\" cellpadding=\"0\" cellspacing=\"2\">";
	text+="                        ";

	id = 100;bg = (temp>=id && temp<id+100)?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
	text+="                          <tr><td ><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectremovematerial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";
	
	if(temp>=100 && temp< 200){
			var opt = temp - 100;
			var isDecolte = opt%16>7;
			var isPlein = opt%8>3;
			var isFilC = opt%4>1;
			var isBanne = opt%2==1;
	
	
	id = 151;bg =isDecolte ?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
	text+="                          <tr><td ><table align=right border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=90% onclick=\"selectremovematerial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";

	id = 152;bg = isPlein ?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
	text+="                          <tr><td ><table align=right border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=90% onclick=\"selectremovematerial("+id+");\"   bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";

	id = 153;bg = isFilC ?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
	text+="                          <tr><td ><table align=right border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=90% onclick=\"selectremovematerial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";


		if(m_select_teeth==33){
			id = 154;bg =isBanne ?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
			text+="                          <tr><td ><table align=right border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=90% onclick=\"selectremovematerial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
			text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
			text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";
			}
		}
	
	id = 2;bg = temp==id ?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
	text+="                           <tr><td ><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectremovematerial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";
	
	id = 3;bg = temp==id ?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
	text+="                           <tr><td ><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectremovematerial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";
	
	id = 4;bg = temp==id ?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
	text+="                           <tr><td ><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectremovematerial("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
	text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
	text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";
	
	
	
	text+="                          <td>&nbsp;</td>";
	text+="                        </tr>";
	text+="                      </table>";



	text+="  </td></tr>";
	text+="  <tr>";
	text+="    <td bgcolor=\"#FFCC66\"  height=25  ><table width=100%><tr><td  align=\"left\">";
	text+="    <input type=\"button\" value=\"Reset\" onClick=\"resetremovematerial();\" style=\"width:50;height:24;font-weight:bold;font-size:12px\"></td><td align=\"right\">";
	text+="    <input type=\"button\" value=\"Apply\" onClick=\"selectremovematerialApply();\" style=\"width:50;height:24;font-weight:bold;font-size:12px\">";
	text+="    <input type=\"button\" value=\"X\" onClick=\"javascript:close_selectremovematerial();\" style=\"width:24;height:24;font-weight:bold;font-size:12px\"></td></tr></table></td>";
	text+="  </tr>";
	text+="</table>";
	return text;

}


function build_html_selectremovematerialEach(){
	text = "";
	text+="<table width=100% height=100% border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#000000\" align=center>";
	text+="  <tr>";
	//var name = temp==0?"":" [ "+getRemoveMaterialName(temp)+" ] ";//+"<input type=\"button\" value=\"X\" onClick=\"selectremovematerial(0);\" style=\"width:24;height:24;font-weight:bold;font-size:10px\">";
	var teeth_name = get_teeth_number(m_select_teeth)+"th ";
	text+="    <td  bgcolor=\"#FFCC66\" height=32 class=\"TableHeadingNormal\"  align=right><table border=0 cellpadding=0 cellspacing=0 width=90% class=\"TableHeadingNormal\"><tr><td  align=left  height = 25><font color=#000000 style=\"font-size:16px\">Select type of work </font></td>";
	text+="    <td  width=32  height = 50 align=right rowspan=2>"
	if(temp>0){
		
			var opt = temp - 2000;
			var middle 		= Math.floor((opt%1000)/100);
			var outside 	= Math.floor((opt% 100)/ 10);
			var inside 		= Math.floor((opt%  10)/   1);
			
			

			
			text+='<table border=0 cellspacing=0 cellpadding=0 ><tr><td>';
			
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
			
			text+='<img src=../resource/images/eorder/null.gif width=32 height=32 >';

			
			if(middle!=0){text+='</td></tr></table>';}
			if(outside!=0){text+='</td></tr></table>';}
			if(inside!=0){text+='</td></tr></table>';}
			
			text+='</td></tr></table>';

	}
	text+="</td><td width=5 rowspan=2></td></tr><tr><td>"+ teeth_name+" teeth</td></table></td>";
	text+="  </tr>";
	text+="  <tr>";
	text+="    <td  align=\"center\" valign=\"top\" bgcolor=\"#FFFFFF\" ><br>";

	text+="					<table width=\"300\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">";
	text+="                        ";
	//text+="             <tr><td rowspan=18 width=300 align=center  class=\"TableHeadingNormal\">"
	
	//text+=' Outside<br>';
	//text+=' <img src=\"../resource/images/eorder/remove/d_rest.gif\" width=\"128\" height=\"128\" border=0/><br>';
	//text+=' Inside';
	//text+="  </td><td></td></tr> ";
	
	
		var opt = temp - 2000;
		var middle 		= Math.floor((opt%1000)/100);
		var outside 	= Math.floor((opt% 100)/ 10);
		var inside 		= Math.floor((opt%  10)/   1);
			
	text+="             <tr><td rowspan=4 width=100 align=center  class=\"TableHeadingNormal\">Outside</td><td></td></tr>"
			
	for(id=211;id<=213;id++){
		//id = 1;
		bg = outside==id-210 ?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
		text+="                          <tr><td ><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectremovematerialeach("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
		text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
		text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";
	}
	text+="<tr><td height=2 colspan=2></td></tr>"
	text+="<tr><td height=2 colspan=2 bgcolor=#FFCC66></td></tr>"
	text+="<tr><td height=2 colspan=2></td></tr>"	

	text+="             <tr><td rowspan=6 width=100 align=center  class=\"TableHeadingNormal\">Middle</td><td></td></tr>"

	for(id=214;id<=218;id++){
		//id = 1;
		bg = middle==id-213  ?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
		text+="                          <tr><td ><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectremovematerialeach("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
		text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
		text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";
	}
	
	text+="<tr><td height=2 colspan=2></td></tr>"
	text+="<tr><td height=2 colspan=2 bgcolor=#FFCC66></td></tr>"
	text+="<tr><td height=2 colspan=2></td></tr>"

	text+="             <tr><td rowspan=4 width=100 align=center  class=\"TableHeadingNormal\">Inside</td><td></td></tr>"

	for(id=219;id<=221;id++){
		//id = 1;
		bg = inside==id-218 ?"#FFCC99":"#FFFFFF";name = getRemoveMaterialName(id);img = getRemoveMaterialImage(id);
		text+="                          <tr><td ><table align=left border=\"0\" cellspacing=\"0\" cellpadding=\"0\" width=100% onclick=\"selectremovematerialeach("+id+");\"  bgcolor="+bg+" style=\"cursor:pointer\">";
		text+="                                <tr><td width=\"32\" height=\"32\" ><img src=\"../resource/images/eorder/remove/"+img+".gif\" width=\"32\" height=\"32\" /></td>";
		text+="                          <td class=\"TableHeadingNormal\">&nbsp;&nbsp;"+name+"</td></tr></table></td></tr>";
	}




	text+="                          <td>&nbsp;</td>";
	text+="                        </tr>";
	text+="                      </table>";



	text+="  </td></tr>";
	text+="  <tr>";
	text+="    <td bgcolor=\"#FFCC66\"  height=25  ><table width=100%><tr><td  align=\"left\">";
	text+="    <input type=\"button\" value=\"Reset\" onClick=\"resetremovematerial();\" style=\"width:50;height:24;font-weight:bold;font-size:12px\"></td><td align=\"right\">";
	text+="    <input type=\"button\" value=\"Apply\" onClick=\"selectremovematerialApply();\" style=\"width:50;height:24;font-weight:bold;font-size:12px\">";
	text+="    <input type=\"button\" value=\"X\" onClick=\"javascript:close_selectremovematerial();\" style=\"width:24;height:24;font-weight:bold;font-size:12px\"></td></tr></table></td>";
	text+="  </tr>";
	text+="</table>";
	return text;

}
