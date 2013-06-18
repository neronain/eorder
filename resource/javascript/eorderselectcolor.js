var currentSelectShade = 0;
var txtshadeid = new Array();
var txtshadename = new Array();
var txtshadecolor = new Array();

txtshadeid[ 0] = 1011;		txtshadename[ 0]="Vita 3D Master [0M1]";			txtshadecolor[ 0]="#FFFFFF";
txtshadeid[ 1] = 1012;		txtshadename[ 1]="Vita 3D Master [0M2]";			txtshadecolor[ 1]="#FFFEFC";
txtshadeid[ 2] = 1013;		txtshadename[ 2]="Vita 3D Master [0M3]";			txtshadecolor[ 2]="#FEFEF9";
txtshadeid[ 3] = 1111;		txtshadename[ 3]="Vita 3D Master [1M1]";			txtshadecolor[ 3]="#FDFDF5";
txtshadeid[ 4] = 1112;		txtshadename[ 4]="Vita 3D Master [1M2]";			txtshadecolor[ 4]="#FDFCF1";
txtshadeid[ 5] = 1201;		txtshadename[ 5]="Vita 3D Master [2L1.5]";			txtshadecolor[ 5]="#FCFBEC";
txtshadeid[ 6] = 1202;		txtshadename[ 6]="Vita 3D Master [2L2.5]";			txtshadecolor[ 6]="#FBFAE7";
txtshadeid[ 7] = 1211;		txtshadename[ 7]="Vita 3D Master [2M1]";			txtshadecolor[ 7]="#FBF9E2";
txtshadeid[ 8] = 1212;		txtshadename[ 8]="Vita 3D Master [2M2]";			txtshadecolor[ 8]="#FAF8DC";
txtshadeid[ 9] = 1213;		txtshadename[ 9]="Vita 3D Master [2M3]";			txtshadecolor[ 9]="#F9F7D6";
txtshadeid[10] = 1221;		txtshadename[10]="Vita 3D Master [2R1.5]";		txtshadecolor[10]="#F8F6D0";
txtshadeid[11] = 1222;		txtshadename[11]="Vita 3D Master [2R2.5]";		txtshadecolor[11]="#F7F4CA";
txtshadeid[12] = 1301;		txtshadename[12]="Vita 3D Master [3L1.5]";		txtshadecolor[12]="#F6F3C4";
txtshadeid[13] = 1302;		txtshadename[13]="Vita 3D Master [3L2.5]";		txtshadecolor[13]="#F5F2BE";
txtshadeid[14] = 1311;		txtshadename[14]="Vita 3D Master [3M1]";			txtshadecolor[14]="#F4F0B7";
txtshadeid[15] = 1312;		txtshadename[15]="Vita 3D Master [3M2]";			txtshadecolor[15]="#F3EFB1";
txtshadeid[16] = 1313;		txtshadename[16]="Vita 3D Master [3M3]";			txtshadecolor[16]="#F2EEAA";
txtshadeid[17] = 1321;		txtshadename[17]="Vita 3D Master [3R1.5]";		txtshadecolor[17]="#F1ECA4";
txtshadeid[18] = 1322;		txtshadename[18]="Vita 3D Master [3R2.5]";		txtshadecolor[18]="#F0EB9D";
txtshadeid[19] = 1401;		txtshadename[19]="Vita 3D Master [4L1.5]";		txtshadecolor[19]="#EFEA97";
txtshadeid[20] = 1402;		txtshadename[20]="Vita 3D Master [4L2.5]";		txtshadecolor[20]="#EEE991";
txtshadeid[21] = 1411;		txtshadename[21]="Vita 3D Master [4M1]";			txtshadecolor[21]="#EDE88B";
txtshadeid[22] = 1412;		txtshadename[22]="Vita 3D Master [4M2]";			txtshadecolor[22]="#ECE686";
txtshadeid[23] = 1413;		txtshadename[23]="Vita 3D Master [4M3]";			txtshadecolor[23]="#ECE580";
txtshadeid[24] = 1421;		txtshadename[24]="Vita 3D Master [4R1.5]";		txtshadecolor[24]="#EBE47C";
txtshadeid[25] = 1422;		txtshadename[25]="Vita 3D Master [4R2.5]";		txtshadecolor[25]="#EAE377";
txtshadeid[26] = 1511;		txtshadename[26]="Vita 3D Master [5M1]";			txtshadecolor[26]="#EAE373";
txtshadeid[27] = 1512;		txtshadename[27]="Vita 3D Master [5M2]";			txtshadecolor[27]='#E9E26F';
txtshadeid[28] = 1513;		txtshadename[28]="Vita 3D Master [5M3]";			txtshadecolor[28]='#E8E169';

txtshadeid[29] = 2110;		txtshadename[29]="Vivodent PE [01/110]";			txtshadecolor[29]='#FFFFFF';
txtshadeid[30] = 2120;		txtshadename[30]="Vivodent PE [1A/120]";			txtshadecolor[30]='#FEFEF9';
txtshadeid[31] = 2130;		txtshadename[31]="Vivodent PE [2A/130]";			txtshadecolor[31]='#FDFDF5';
txtshadeid[32] = 2140;		txtshadename[32]="Vivodent PE [1C/140]";			txtshadecolor[32]='#FCFBEC';
txtshadeid[33] = 2210;		txtshadename[33]="Vivodent PE [2B/210]";			txtshadecolor[33]='#FBFAE7';
txtshadeid[34] = 2220;		txtshadename[34]="Vivodent PE [1D/220]";			txtshadecolor[34]='#FAF8DC';
txtshadeid[35] = 2230;		txtshadename[35]="Vivodent PE [1E/230]";			txtshadecolor[35]='#F9F7D6';
txtshadeid[36] = 2240;		txtshadename[36]="Vivodent PE [2C/240]";			txtshadecolor[36]='#F7F4CA';
txtshadeid[37] = 2310;		txtshadename[37]="Vivodent PE [3A/310]";			txtshadecolor[37]='#F6F3C4';
txtshadeid[38] = 2320;		txtshadename[38]="Vivodent PE [5B/320]";			txtshadecolor[38]='#F4F0B7';
txtshadeid[39] = 2330;		txtshadename[39]="Vivodent PE [2E/330]";			txtshadecolor[39]='#F3EFB1';
txtshadeid[40] = 2340;		txtshadename[40]="Vivodent PE [3E/340]";			txtshadecolor[40]='#F1ECA4';
txtshadeid[41] = 2410;		txtshadename[41]="Vivodent PE [4A/410]";			txtshadecolor[41]='#F0EB9D';
txtshadeid[42] = 2420;		txtshadename[42]="Vivodent PE [6B/420]";			txtshadecolor[42]='#EEE991';
txtshadeid[43] = 2430;		txtshadename[43]="Vivodent PE [4B/430]";			txtshadecolor[43]='#EDE88B';
txtshadeid[44] = 2440;		txtshadename[44]="Vivodent PE [6C/440]";			txtshadecolor[44]='#ECE580';
txtshadeid[45] = 2510;		txtshadename[45]="Vivodent PE [6D/510]";			txtshadecolor[45]='#EBE47C';
txtshadeid[46] = 2520;		txtshadename[46]="Vivodent PE [4C/520]";			txtshadecolor[46]='#EAE373';
txtshadeid[47] = 2530;		txtshadename[47]="Vivodent PE [3C/530]";			txtshadecolor[47]='#E9E26F';
txtshadeid[48] = 2540;		txtshadename[48]="Vivodent PE [4D/540]";			txtshadecolor[48]='#E8E169';

function getShadeName(id){
	for(i=0;i<txtshadeid.length;i++){
		if(txtshadeid[i]==id)
			return txtshadename[i];
	}
	return '';
}
function getShadeColor(id){
	for(i=0;i<txtshadeid.length;i++){
		if(txtshadeid[i]==id)
			return txtshadecolor[i];
	}
	return '';
}



function popup_selectcolor(currentSS){
	currentSelectShade = currentSS;
	activeBG();
	refresh_selectcolor();
	makeCenterScreen('PopUPSelectColor');
	//moveLayerToMouseLoc('PopUPSelectColor',-565,-245);
	showHideLayers('PopUPSelectColor','','show');

	
}
function close_selectcolor(){
	showHideLayers('PopUPSelectColor','','hide');
	hideBG();
}
function refresh_selectcolor(){
	writeit('PopUPSelectColor',build_html_selectcolor());
}
function selectcolor(id){
	close_selectcolor();
	//m_teeth_list[m_select_teeth].option8 = id; // For Fix Color 1-255:ColorID 
	//m_teeth_list[m_select_teeth].option9 = color; // For Fix ColorName XXXXXX
	//m_teeth_list[m_select_teeth].option10 = code; // For Fix ColorCode #XXXXXX
	//alert(id);
	//refresh_main_display();
	if(currentSelectShade==0){
		setBG('fixcolorpreview',getShadeColor(id));
		writeit('selectedcolor',"&nbsp;"+getShadeName(id));
	}else{
		setBG('removecolorpreview',getShadeColor(id));
		writeit('selectedcolorR',"&nbsp;"+getShadeName(id))
	}
	

}
var selectbrand = 0;
function build_html_selectcolor(){
	text = "";
	text+="<table width=\"100%\" height=100% border=\"0\" cellpadding=\"0\" cellspacing=\"1\" bgcolor=\"#000000\" align=center>";
	text+="  <tr>";
	text+="    <td align=\"center\" bgcolor=\"#FFCC66\" height=25 class=\"TableHeadingNormal\"><font color=#000000>Select Shade </font></td>";
	text+="  </tr>";
	text+="  <tr>";
	text+="    <td  align=\"center\" valign=\"top\" bgcolor=\"#FFFFFF\">";

	switch(selectbrand){
		case 0: text+= build_html_selectcolorVT(); break;
		case 1: text+= build_html_selectcolorVV(); break;
		case 2: text+= build_html_selectcolorVP(); break;
		case 3: text+= build_html_selectcolorCS(); break;
		case 4: text+= build_html_selectcolorMJ(); break;
	}

	text+="  </td></tr>";
	text+="  <tr>";
	text+="    <td align=\"right\" bgcolor=\"#FFCC66\" height=26>";
	text+="    <input type=\"button\" value=\"X\" onClick=\"javascript:close_selectcolor()\" style=\"width:24;height:24;font-weight:bold;font-size:12px\"></td>";
	text+="  </tr>";
	text+="</table>";
	return text;
}
function select_colorVT(){	selectbrand=0;	refresh_selectcolor();}
function select_colorVV(){	selectbrand=1;	refresh_selectcolor();}
function select_colorVP(){	selectbrand=2;	refresh_selectcolor();}
function select_colorCS(){	selectbrand=3;	refresh_selectcolor();}
function select_colorMJ(){	selectbrand=4;	refresh_selectcolor();}

function build_html_selectcolorVT(){
	//alert('');
	text='';
	text+="	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td bgcolor=\"#FFFFFF\" class=\"TableHeading\"  style=\"cursor:default\" >Vita 3D Master</td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVV();\">Vivodent PE </td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVP();\">Vitaplan</td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorCS();\">Cosmo HXL </td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorMJ();\">Majadent</td>";
	text+="      </tr>";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td bgcolor=\"#FFFFFF\" height=4></td><td colspan=8></td>";
//	text+="        <td></td><td></td>";
//	text+="        <td></td><td></td>";
//	text+="        <td></td><td></td>";
//	text+="        <td></td>";
	text+="      </tr>";
	text+="    </table><br><br>";
	text+="	       <table border=\"0\" cellspacing=\"1\" cellpadding=\"0\">";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1011);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >0M1</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1012);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >0M2</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1013);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >0M3</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1111);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >1M1</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1112);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >1M2</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="          </tr>";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1201);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2L1.5</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1202);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2L2.5</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1211);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2M1</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1212);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2M2</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1213);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2M3</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1221);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2R1.5</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1222);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2R2.5</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1301);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >3L1.5</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1302);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >3L2.5</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1311);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >3M1</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1312);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >3M2</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1313);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >3M3</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1321);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >3R1.5</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1322);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >3R2.5</td>";
	text+="          </tr>";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1401);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4L1.5</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1402);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4L2.5</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1411);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4M1</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1412);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4M2</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1413);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4M3</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1421);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4R1.5</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1422);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4R2.5</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1511);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >5M1</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1512);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >5M2</td>";
	text+="            <td width=\"36\" height=\"36\" onclick=\"selectcolor(1513);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >5M3</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="            <td width=\"36\" height=\"36\">&nbsp;</td>";
	text+="          </tr>";
	text+="      </table>";
	return text;
	//writeit('color_table_display',text);
}

function build_html_selectcolorVV(){
	//alert('');
	text='';
	text+="	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVT();\">Vita 3D Master</td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFFFF\" class=\"TableHeading\" style=\"cursor:default\"  >Vivodent PE </td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVP();\">Vitaplan</td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorCS();\">Cosmo HXL </td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorMJ();\">Majadent</td>";
	text+="      </tr>";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td></td><td></td>";
	text+="        <td bgcolor=\"#FFFFFF\" height=4 ></td><td colspan=6></td>";
//	text+="        <td></td><td></td>";
//	text+="        <td></td><td></td>";
//	text+="        <td></td>";
	text+="      </tr>";
	text+="    </table><br><br>";
	text+="        <table border=\"0\" cellspacing=\"1\" cellpadding=\"0\">";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2110);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >01/110</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2120);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >1A/120</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2130);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2A/130</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2140);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >1C/140</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2210);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2B/210</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2220);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >1D/220</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2230);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >1E/230</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2240);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2C/240</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2310);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >3A/310</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2320);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >5B/320</td>";
	text+="          </tr>";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2330);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >2E/330</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2340);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >3E/340</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2410);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4A/410</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2420);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >6B/420</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2430);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4B/430</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2440);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >6C/440</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2510);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >6D/510</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2520);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4C/520</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2530);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >3C/530</td>";
	text+="            <td width=\"48\" height=\"48\" onclick=\"selectcolor(2540);\"  onMouseOut=\"this.style.background=''\" onMouseOver=\"this.style.background='#FFFF99'\" style=\"cursor:pointer\" >4D/540</td>";
	text+="          </tr>";
	text+="      </table>";
	return text;
	//writeit('color_table_display',text);
}

function build_html_selectcolorVP(){
	text="";
	text+="	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVT();\">Vita 3D Master</td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVV();\">Vivodent PE </td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFFFF\" class=\"TableHeading\"  style=\"cursor:default\" >Vitaplan</td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorCS();\">Cosmo HXL </td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorMJ();\">Majadent</td>";
	text+="      </tr>";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td></td><td></td>";
	text+="        <td></td><td></td>";
	text+="        <td bgcolor=\"#FFFFFF\"  height=4 ></td><td></td>";
	text+="        <td></td><td></td>";
	text+="        <td></td>";
	text+="      </tr>";
	text+="    </table><br><br>";
	text+="        <table border=\"0\" cellspacing=\"1\" cellpadding=\"0\">";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"48\" height=\"48\">A1</td>";
	text+="            <td width=\"48\" height=\"48\">A2</td>";
	text+="            <td width=\"48\" height=\"48\">A3</td>";
	text+="            <td width=\"48\" height=\"48\">A3.5</td>";
	text+="            <td width=\"48\" height=\"48\">A4</td>";
	text+="            <td width=\"48\" height=\"48\">B1</td>";
	text+="            <td width=\"48\" height=\"48\">B2</td>";
	text+="            <td width=\"48\" height=\"48\">B3</td>";
	text+="          </tr>";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"48\" height=\"48\">B4</td>";
	text+="            <td width=\"48\" height=\"48\">C1</td>";
	text+="            <td width=\"48\" height=\"48\">C2</td>";
	text+="            <td width=\"48\" height=\"48\">C3</td>";
	text+="            <td width=\"48\" height=\"48\">C4</td>";
	text+="            <td width=\"48\" height=\"48\">D2</td>";
	text+="            <td width=\"48\" height=\"48\">D3</td>";
	text+="            <td width=\"48\" height=\"48\">D4</td>";
	text+="          </tr>";
	text+="      </table>";
	return text;
	//writeit('color_table_display',text);
}
function build_html_selectcolorCS(){
	text="";
	text+="	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVT();\">Vita 3D Master</td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVV();\">Vivodent PE </td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVP();\">Vitaplan</td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFFFF\" class=\"TableHeading\"  style=\"cursor:default\" >Cosmo HXL </td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorMJ();\">Majadent</td>";
	text+="      </tr>";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td></td><td></td>";
	text+="        <td></td><td></td>";
	text+="        <td></td><td></td>";
	text+="        <td bgcolor=\"#FFFFFF\"  height=4 ></td><td></td>";
	text+="        <td></td>";
	text+="      </tr>";
	text+="    </table><br><br>";
	text+="        <table border=\"0\" cellspacing=\"1\" cellpadding=\"0\">";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"48\" height=\"48\">A1</td>";
	text+="            <td width=\"48\" height=\"48\">A2</td>";
	text+="            <td width=\"48\" height=\"48\">A3</td>";
	text+="            <td width=\"48\" height=\"48\">A3.5</td>";
	text+="            <td width=\"48\" height=\"48\">A4</td>";
	text+="            <td width=\"48\" height=\"48\">B1</td>";
	text+="            <td width=\"48\" height=\"48\">B2</td>";
	text+="            <td width=\"48\" height=\"48\">B3</td>";
	text+="          </tr>";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"48\" height=\"48\">B4</td>";
	text+="            <td width=\"48\" height=\"48\">C1</td>";
	text+="            <td width=\"48\" height=\"48\">C2</td>";
	text+="            <td width=\"48\" height=\"48\">C3</td>";
	text+="            <td width=\"48\" height=\"48\">C4</td>";
	text+="            <td width=\"48\" height=\"48\">D2</td>";
	text+="            <td width=\"48\" height=\"48\">D3</td>";
	text+="            <td width=\"48\" height=\"48\">D4</td>";
	text+="          </tr>";
	text+="      </table>";

	return text;
	//writeit('color_table_display',text);
}
function build_html_selectcolorMJ(){
	text="";

	text+="	<table width=\"100%\" border=\"0\" cellspacing=\"0\" cellpadding=\"2\">";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVT();\">Vita 3D Master</td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVV();\">Vivodent PE </td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorVP();\">Vitaplan</td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFF99\" class=\"TableHeading\" onmousemove=\"select_colorCS();\">Cosmo HXL </td><td width=2></td>";
	text+="        <td bgcolor=\"#FFFFFF\" class=\"TableHeading\" style=\"cursor:default\"  >Majadent</td>";
	text+="      </tr>";
	text+="      <tr align=\"center\" bgcolor=\"#666666\">";
	text+="        <td colspan=8></td>";
	text+="        <td bgcolor=\"#FFFFFF\"  height=4 ></td>";
	text+="      </tr>";
	text+="    </table><br><br>";
	text+="	        <table border=\"0\" cellspacing=\"1\" cellpadding=\"0\">";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"48\" height=\"48\">2C</td>";
	text+="            <td width=\"48\" height=\"48\">1D</td>";
	text+="            <td width=\"48\" height=\"48\">3D</td>";
	text+="            <td width=\"48\" height=\"48\">5D</td>";
	text+="            <td width=\"48\" height=\"48\">1F</td>";
	text+="            <td width=\"48\" height=\"48\">3F</td>";
	text+="            <td width=\"48\" height=\"48\">4F</td>";
	text+="          </tr>";
	text+="          <tr align=\"center\" class=\"Color_select\">";
	text+="            <td width=\"48\" height=\"48\">2L</td>";
	text+="            <td width=\"48\" height=\"48\">4L</td>";
	text+="            <td width=\"48\" height=\"48\">1R</td>";
	text+="            <td width=\"48\" height=\"48\">3R</td>";
	text+="            <td width=\"48\" height=\"48\">4C</td>";
	text+="            <td width=\"48\" height=\"48\">5C</td>";
	text+="            <td width=\"48\" height=\"48\">&nbsp;</td>";
	text+="          </tr>";
	text+="      </table>";
	return text;
	//writeit('color_table_display',text);
}