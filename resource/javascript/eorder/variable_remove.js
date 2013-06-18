var REMOVETYPE = { NONE : 0, RPD : 1, TP : 2, VITAFLEX : 3, REPAIR : 4 , DECOLTE : 5, PLEIN : 6, FILCHINGULAIRE : 7, BANNEESPACE : 8}



var i=0;
var txtremovematerialid = new Array();
var txtremovematerialname = new Array();
var txtremovematerialimage = new Array();

txtremovematerialid[i] = 0;		txtremovematerialname[i] ="NONE";	
txtremovematerialimage[i] = new Array();i++;
																					
txtremovematerialid[i] = 1;		txtremovematerialname[i] ="Clasp Acetal";
txtremovematerialimage[i] = new Array(8001,0);i++;
																					
txtremovematerialid[i] = 2;		txtremovematerialname[i] ="Clasp Metal";
txtremovematerialimage[i] = new Array(8002,0);i++;
																					
txtremovematerialid[i] = 3;		txtremovematerialname[i] ="Clasp Vitaflex";
txtremovematerialimage[i] = new Array(8003,0);i++;

txtremovematerialid[i] = 10;		txtremovematerialname[i] ="Rest";
txtremovematerialimage[i] = new Array(8008,0);i++;

txtremovematerialid[i] = 21;		txtremovematerialname[i] ="Adjunction";
txtremovematerialimage[i] = new Array(8004,0);i++;
																					
txtremovematerialid[i] = 22;		txtremovematerialname[i] ="Backing";
txtremovematerialimage[i] = new Array(8005,0);i++;
																					
txtremovematerialid[i] = 23;		txtremovematerialname[i] ="Full Metal";
txtremovematerialimage[i] = new Array(8006,0);i++;
																					
txtremovematerialid[i] = 24;		txtremovematerialname[i] ="Full Resine";
txtremovematerialimage[i] = new Array(8007,0);i++;
										
										
																					
txtremovematerialid[i] = 1001;		txtremovematerialname[i] ="RPD";
txtremovematerialimage[i] = new Array(9001,0);i++;										
//************************************************************************
// Class teeth
var g_RemoveUpperType = REMOVETYPE.NONE;
var g_RemoveUpperOption1 = 0; //0:none 1:decolte 2:plein
var g_RemoveUpperOption2 = 0; //0:none 1:Filchingulaire

var g_RemoveLowerType = REMOVETYPE.NONE;
var g_RemoveLowerOption1 = 0; //0:none 1:decolte 2:plein
var g_RemoveLowerOption2 = 0; //0:none 1:Filchingulaire
var g_RemoveLowerOption3 = 0; //0:none 1:Banne Espace

var g_RemoveTeeth_list = new Array();
for(var i=0;i<32;i++){	
	g_RemoveTeeth_list[i] = new RemoveTeeth();
}

function RemoveTeeth(){
	this.material = 0;
	this.rest = 0;
	this.Attach = false; // For Fix is Attach 0:false 1:true
}

function getTeethRemoveMaterialImageArray(id){
	for(var i=0;i<txtremovematerialid.length;i++){
		if(txtremovematerialid[i]==id)
			return txtremovematerialimage[i];
	}
	return new Array();
}		


