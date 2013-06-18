var selectedOption = new Array();
for(var i=0;i<32;i++){	
	selectedOption[i] = false;
}
var currentOption = 0;
function popup_selectfixoption(co){
	activeBG();
	currentOption = co;
	
	for(var i=0;i<32;i++){	
		switch(currentOption){
			case 1: selectedOption[i] = m_teeth_list[i].option11;break;
			case 2: selectedOption[i] = m_teeth_list[i].option12;break;
			case 3: selectedOption[i] = m_teeth_list[i].option7;break;
		
		}
		if(currentOption!=3){
			if(m_teeth_list[i].material==0){
				selectedOption[i] = false;
			}
			if(m_teeth_list[i].material>300){
				selectedOption[i] = false;
			}
		}
	}
	
	
	refresh_selectfixoption();
	makeCenterScreen('PopUPSelectFixOption');
	showHideLayers('PopUPSelectFixOption','','show');

}
function close_selectfixoption(){
	showHideLayers('PopUPSelectFixOption','','hide');
	hideBG();
}
function refresh_selectfixoption(){
	writeit('PopUPSelectFixOption',build_html_selectfixoption());

}
function selectfixoptionApply(){
	for(var i=0;i<32;i++){	

		switch(currentOption){
			case 1: m_teeth_list[i].option11 = selectedOption[i];break;
			case 2: m_teeth_list[i].option12 = selectedOption[i];break;
			case 3: 
				if(m_teeth_list[i].option7 != selectedOption[i]){
					m_teeth_list[i].option7 = selectedOption[i];
					onMouseOutTeeth(i);
					onMouseOutTeethR(i);
				}else{
					m_teeth_list[i].option7 = selectedOption[i];
				}
				break;
		
		}
		
	}
	writeit('optiontable'+currentOption,build_html_teethtable_option(currentOption));
	close_selectfixoption();
	
	//m_teeth_list[m_select_teeth].material = temp; 
	//onMouseOutTeethR(m_select_teeth);
}
function resetfixoption(){
	for(var i=0;i<32;i++){	
		selectedOption[i] = false;
	}
	refresh_selectfixoption();
}
function selectfixoption(id){
	selectedOption[id] = !selectedOption[id];
	refresh_selectfixoption();
}

function build_html_selectfixoption(){
	var header = "";
	switch(currentOption){
		case 1: header="Porcelain Margin";break;
		case 2: header="Step bar";break;
		case 3: header="Attach";break;
		
	}
	
	text = "";
	text+=' 	<table width=100% height=100% border="0" cellpadding="0" cellspacing="1" bgcolor="#000000" align=center>';
	text+='	  <tr>';
	text+='';
	text+='';
	text+='	    <td  bgcolor="#FFCC66" height=32 class="TableHeadingNormal"  align=center><font color="#000000" style="font-size:16px">Select teeth for '+header+'</font></td>';
	text+='	  </tr>';
	text+='	  <tr>';
	text+='	    <td  align="center" valign="top" bgcolor="#FFFFFF" ><br>';
	text+='	      <table border="0" cellpadding="0" cellspacing="0" class="orderSmall">';
	text+='            <tr>';
	text+='              <td width="25" align="center">58</td>';
	text+='              <td width="25" align="center">17</td>';
	text+='              <td width="25" align="center">16</td>';
	text+='              <td width="25" align="center">15</td>';
	text+='              <td width="25" align="center">14</td>';
	text+='              <td width="25" align="center">13</td>';
	text+='              <td width="25" align="center">12</td>';
	text+='              <td width="25" align="center">11</td>';
	text+='              <td width="2" align="center" bgcolor="#006699"></td>';
	text+='              <td width="25" align="center">21</td>';
	text+='              <td width="25" align="center">22</td>';
	text+='              <td width="25" align="center">23</td>';
	text+='              <td width="25" align="center">24</td>';
	text+='              <td width="25" align="center">25</td>';
	text+='              <td width="25" align="center">26</td>';
	text+='              <td width="25" align="center">27</td>';
	text+='              <td width="25" align="center">28</td>';
	text+='            </tr>';
	text+='            <tr>';
	
	for(var i=0;i<8;i++){ 	text+=build_html_selectfixoptionEach(i); }


	
	text+='              <td width="2" height="25" align="center" bgcolor="#006699"></td>';

	for(var i=8;i<16;i++){ 	text+=build_html_selectfixoptionEach(i); }

	
	text+='            </tr>';
	text+='            <tr>';
	text+='              <td colspan="17" align="center" bgcolor="#006699" height=2></td>';
	text+='            </tr>';
	text+='            <tr>';
	
	for(var i=16;i<24;i++){ 	text+=build_html_selectfixoptionEach(i); }

	
	text+='              <td width="2" height="25" align="center" bgcolor="#006699"></td>';

	for(var i=24;i<32;i++){ 	text+=build_html_selectfixoptionEach(i); }


	
	text+='            </tr>';
	text+='            <tr>';
	text+='              <td width="25" align="center">38</td>';
	text+='              <td width="25" align="center">37</td>';
	text+='              <td width="25" align="center">36</td>';
	text+='              <td width="25" align="center">35</td>';
	text+='              <td width="25" align="center">34</td>';
	text+='              <td width="25" align="center">33</td>';
	text+='              <td width="25" align="center">32</td>';
	text+='              <td width="25" align="center">31</td>';
	text+='              <td width="2" align="center" bgcolor="#006699"></td>';
	text+='              <td width="25" align="center">41</td>';
	text+='              <td width="25" align="center">42</td>';
	text+='              <td width="25" align="center">43</td>';
	text+='              <td width="25" align="center">44</td>';
	text+='              <td width="25" align="center">45</td>';
	text+='              <td width="25" align="center">46</td>';
	text+='              <td width="25" align="center">47</td>';
	text+='              <td width="25" align="center">48</td>';
	text+='            </tr>';
	text+='          </table>';



	text+="  </td></tr>";
	text+="  <tr>";
	text+="    <td bgcolor=\"#FFCC66\"  height=25  ><table width=100%><tr><td  align=\"left\">";
	text+="    <input type=\"button\" value=\"Reset\" onClick=\"resetfixoption();\" style=\"width:50;height:24;font-weight:bold;font-size:12px\"></td><td align=\"right\">";
	text+="    <input type=\"button\" value=\"Apply\" onClick=\"selectfixoptionApply();\" style=\"width:50;height:24;font-weight:bold;font-size:12px\">";
	text+="    <input type=\"button\" value=\"X\" onClick=\"javascript:close_selectfixoption();\" style=\"width:24;height:24;font-weight:bold;font-size:12px\"></td></tr></table></td>";
	text+="  </tr>";
	text+="</table>";
	return text;

}
function build_html_selectfixoptionEach(id){
	text='';
	var number = get_teeth_number(id);
	var img = selectedOption[id]?"btn_selected":"btn_cross";
	
	if(( m_teeth_list[id].material > 0 &&  m_teeth_list[id].material<300)|| currentOption==3){
		text+='              <td width="25" align="center" ';
		text+=' onMouseOut="this.style.background=\'#FFFFFF\'" onMouseOver="this.style.background=\'#FFFF99\'" ';
		text+='	onClick="selectfixoption('+id+');" style="cursor:pointer" >';
		text+='<img src=../resource/images/eorder/'+img+'.gif width=16 height=16>';
		text+='</td>';
	}else{
		text+='              <td width="25" >';
		text+='</td>';
		
	}
	
	return text;
}


function build_html_teethtable_option(option){
	text='';
	text+='<table border="0" cellpadding="0" cellspacing="1" bgcolor="#999999" align=center  style="cursor:pointer" onClick="popup_selectfixoption('+option+');"   class="orderSmall" >';
	/*
	for(var i=0;i<32;i++){
		var vl = false;
		switch(option){
			case 1: vl = m_teeth_list[i].option11;break;
			case 2: vl = m_teeth_list[i].option12;break;
			case 3: vl = m_teeth_list[i].option7;break;
		}
		var bg = vl?"#339933":"#FFFFFF";
		text+='<td bgcolor = '+bg+' width=8 height=8></td>';
		if(i==15){
			text+='</tr><tr>';
		}
	} //*/
	
	text+='<tr><td  bgcolor="#FFFFFF"  width=150 height=16>';

	for(var i=0;i<32;i++){
		var vl = false;
		switch(option){
			case 1: vl = m_teeth_list[i].option11;break;
			case 2: vl = m_teeth_list[i].option12;break;
			case 3: vl = m_teeth_list[i].option7;break;
		}
		if(vl){
			text+=get_teeth_number(i)+'  ';
		}
	}
	text+='</td></tr></table>';
	return text;
}
