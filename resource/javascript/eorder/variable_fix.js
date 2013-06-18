var METHOD = { NONE : 0, TRYIN : 1, CONTOUR : 2, FINISH : 3, REPAIR : 4 }
var v_method = METHOD.NONE;
	

var i=0;
var txtmaterialid = new Array();
var txtmaterialname = new Array();
var txtmaterialimage = new Array();

txtmaterialid[i] = 0;		txtmaterialname[i] ="NONE";	
txtmaterialimage[i] = new Array(new Array(),new Array(),new Array());i++;
																					
txtmaterialid[i] = 1;		txtmaterialname[i] ="PFM";
txtmaterialimage[i] = new Array(
								new Array(1021,1031),
								new Array(1002,1026,1036,1012),
								new Array(1007,1017,1026,1036,1102,1107));i++;
																					
txtmaterialid[i] = 2;		txtmaterialname[i] ="PF";
txtmaterialimage[i] = new Array(
								new Array(1008,1028,1031,1103),
								new Array(1008,1028,1031,1012,1103),
								new Array(1008,1028,1036,1017,1103,1107));i++;

txtmaterialid[i] = 3;		txtmaterialname[i] ="FMC";
txtmaterialimage[i] = new Array(
								new Array(1023,1033),
								new Array(1038,1028,1003,1013),
								new Array(1038,1028,1008,1018,1103,1108));i++;
																					
txtmaterialid[i] = 50;	txtmaterialname[i] ="E-Max<br>[Dental Vission]";
txtmaterialimage[i] = new Array(
								new Array(),
								new Array(3003,1002,1012,1022,1032,1102,1107),
								new Array(3003,1007,1017,1027,1037,1102,1107));i++;
																					
txtmaterialid[i] = 51;	txtmaterialname[i] ="Inlay / Onlay E-Max<br>[Dental Vission]";
txtmaterialimage[i] = new Array(
								new Array(),
								new Array(3003,2011,2001),
								new Array(3003,2021,2001));i++;
																					
txtmaterialid[i] = 52;	txtmaterialname[i] ="Inceram<br>[Vita]";
txtmaterialimage[i] = new Array(
								new Array(),
								new Array(3004,1002,1012,1022,1032,1102,1107),
								new Array(3004,1007,1017,1027,1037,1102,1107));i++;
																					
txtmaterialid[i] = 53;	txtmaterialname[i] ="Cercon<br>[Dent Supply]";
txtmaterialimage[i] = new Array(
								new Array(),
								new Array(3002,1002,1012,1022,1032,1102,1107),
								new Array(3002,1007,1017,1027,1037,1102,1107));i++;
																					
txtmaterialid[i] = 54;	txtmaterialname[i] ="Veneer Cercon<br>[Dent Supply]";
txtmaterialimage[i] = new Array(
								new Array(),
								new Array(3006,1002,1012,1022,1032,1102,1107),
								new Array(3006,1007,1017,1027,1037,1102,1107));i++;
																					
txtmaterialid[i] = 55;	txtmaterialname[i] ="Procera Alumina<br>[Noble]";
txtmaterialimage[i] = new Array(
								new Array(),
								new Array(3010,1002,1012,1022,1032,1102,1107),
								new Array(3010,1007,1017,1027,1037,1102,1107));i++;
																					
txtmaterialid[i] = 56;	txtmaterialname[i] ="Procera Zirconia<br>[Noble]";
txtmaterialimage[i] = new Array(
								new Array(),
								new Array(3011,1002,1012,1022,1032,1102,1107),
								new Array(3011,1007,1017,1027,1037,1102,1107));i++;
																					
txtmaterialid[i] = 57;	txtmaterialname[i] ="Veneer Procera Alumina<br>[Noble]";
txtmaterialimage[i] = new Array(
								new Array(),
								new Array(3005,1002,1012,1022,1032,1102,1107),
								new Array(3005,1007,1017,1027,1037,1102,1107));i++;
																					
txtmaterialid[i] = 58;	txtmaterialname[i] ="Veneer Procera Zirconia<br>[Noble]";
txtmaterialimage[i] = new Array(
								new Array(),
								new Array(3007,1002,1012,1022,1032,1102,1107),
								new Array(3007,1007,1017,1027,1037,1102,1107));i++;
																					
txtmaterialid[i] = 59;	txtmaterialname[i] ="Zeno System<br>[Dental Vission]";
txtmaterialimage[i] = new Array(
								new Array(),
								new Array(3012,1002,1012,1022,1032,1102,1107),
								new Array(3012,1007,1017,1027,1037,1102,1107));i++;
																					
													
													
													
																					
function get_teeth_number(i){
	var number =0;
	if(i<8){					number = 18-i;
	}else if(i<16)	{		number = i+13;
	}else if(i<24)	{		number = 38-i+16;
	}else	{					number = i+17;
	}
	return number;
}
function getTeethName(id){
	for(var i=0;i<txtmaterialid.length;i++){
		if(txtmaterialid[i]==id)
			return txtmaterialname[i];
	}
	return "";
}	
function getTeethMaterialImageArray(method,id){
	if(method==METHOD.NONE) return new Array();
	if(method==METHOD.REPAIR) return new Array();
	
	for(var i=0;i<txtmaterialid.length;i++){
		if(txtmaterialid[i]==id)
			return txtmaterialimage[i][method-METHOD.TRYIN];
	}
	return new Array();
}							

/*
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
//*/




//************************************************************************
// Class teeth

var g_FixTeeth_list = new Array();
for(var i=0;i<32;i++){	
	g_FixTeeth_list[i] = new FixTeeth();
}

function FixTeeth(){
	this.material = 0;
	this.pintooth = 0;
	this.Attach = false; // For Fix is Attach 0:false 1:true
	this.PorcelainMargin = false; // For Fix is Porcelain Margin 0:false 1:true
	this.StepBar = false; // For Fix is Step bar 0:false 1:true
}






