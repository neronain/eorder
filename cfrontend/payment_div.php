<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<div id="DivShowPaymentInfo" style="position:absolute;left:0px;top:0px;width:618px;height:500px;z-index:0;<?="display:none;"?>">
<? $tbframeheader = "Payment Information"?>
<? $tbframehclose = "CloseDivShowPaymentInfo()";?>
<? include "tbframeh.php"?>
<div id="DivPaymentOrderList" style="overflow:auto;width:600px;height:450px;" align="left">
<? include_once "../cfrontend/payment_div_c.php" ?>
</div>
<? include "tbframef.php"?>
</div>
<script>
var PaymentInfoCurrentTab ='overview'; 
var PaymentInfoCurrentID = "";

function OpenDivShowPaymentInfo(id,date)
{
	
	activeBG();
	showHideLayers('DivShowPaymentInfo','','show');
	makeCenterScreen('DivShowPaymentInfo');
	if(id!=""){
		PaymentInfoCurrentID = id;
		showHTML('DivPaymentOrderList','../cfrontend/payment_div_c.php?customerid='+id+'&limit=20&date='+date);
	}
}
function CloseDivShowPaymentInfo()
{
	hideBG();
	showHideLayers('DivShowPaymentInfo','','hide');
}
showHideLayers('DivShowPaymentInfo','','hide');


function gotoPaymentPage(id,stat,lim,page,date)
{
	showHTML('DivPaymentOrderList','../cfrontend/payment_div_c.php?customerid='+id+'&limit='+lim+'&page='+page+'&date='+date);
return false;
}

</script>
