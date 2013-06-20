<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<div id="DivShowDoctorInfo" style="position:absolute;left:0px;top:0px;width:618px;height:500px;z-index:1;<?="display:none;"?>">
<? $tbframeheader = "Doctor Information"?>
<? $tbframehclose = "CloseDivShowDoctorInfo()";?>
<? include "tbframeh.php"?>
<div id="DivDoctorOrderList" style="overflow:auto;width:600px;height:450px" align="left">
<? include_once "../cfrontend/doctor_order_c.php" ?>
</div>
<? include "tbframef.php"?>
</div>
<script>
var DoctorInfoCurrentTab ='overview'; 
var DoctorInfoCurrentID = 0;

function OpenDivShowDoctorInfo(id)
{
	
	activeBG();
	showHideLayers('DivShowDoctorInfo','','show');
	makeCenterScreen('DivShowDoctorInfo');
	if(id>0){
		DoctorInfoCurrentID = id;
		showHTML('DivDoctorOrderList','../cfrontend/doctor_order_c.php?limit=10&docid='+id);
	}
}
function CloseDivShowDoctorInfo()
{
	hideBG();
	showHideLayers('DivShowDoctorInfo','','hide');
}
showHideLayers('DivShowDoctorInfo','','hide');


function gotoPage(id,stat,lim,page)
{
showHTML('DivDoctorOrderList','../cfrontend/doctor_order_c.php?docid='+id+'&limit='+lim+'&page='+page);
return false;
}

</script>