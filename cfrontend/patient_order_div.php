<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<div id="DivShowPatientInfo" style="position:absolute;left:0px;top:0px;width:618px;height:500px;z-index:1;<?="display:none;"?>">
<? $tbframeheader = "Patient Order Information"?>
<? $tbframehclose = "CloseDivShowPatientInfo()";?>
<? include "tbframeh.php"?>
<div id="DivPatientOrderList" style="overflow:auto;width:600px;height:450px" align="left">
<? include_once "../cfrontend/patient_order_c.php" ?>
</div>
<? include "tbframef.php"?>
</div>
<script>
var PatientInfoCurrentId = 0;
var PatientInfoCurrentName = "";

function OpenDivShowPatientInfo(id,name)
{
	
	activeBG();
	showHideLayers('DivShowPatientInfo','','show');
	makeCenterScreen('DivShowPatientInfo');
	if(name){
		PatientInfoCurrentId = id;
		PatientInfoCurrentName = name;
		showHTML('DivPatientOrderList','../cfrontend/patient_order_c.php?cusid='+id+'&limit=10&pname='+encodeTH(name));
	}
}
function CloseDivShowPatientInfo()
{
	hideBG();
	showHideLayers('DivShowPatientInfo','','hide');
}
showHideLayers('DivShowPatientInfo','','hide');


function gotoPage(id,stat,lim,page)
{
showHTML('DivPatientOrderList','../cfrontend/patient_order_c.php?cusid='+PatientInfoCurrentId+'&pname='+encodeTH(PatientInfoCurrentName)+'&limit='+lim+'&page='+page);
//showHTML('DivPatientOrderList','../cfrontend/patient_order_c.php?cusid='+PatientInfoCurrentId+'&pname='+PatientInfoCurrentName+'&limit='+lim+'&page='+page);
return false;
}

</script>
