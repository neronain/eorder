<? //Additional option $OpenDivShowSummaryAlterMethod ?>
<? if(!isset($OpenDivShowSummaryAlterMethod))$OpenDivShowSummaryAlterMethod="" ?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<div id="DivShowSummary" style="position:absolute;left:0px;top:0px;width:618px;height:500px;z-index:1;<?="display:none;"?>">
<? $tbframeheader = "Order summary"?>
<? $tbframehclose = "CloseDivShowSummary()";?>
<? include "tbframeh.php"?>
<div id="DivAjaxOrderSummary" style="overflow:auto;width:600px;height:450px" align="left"><br>
</div>

<div id="DivAjaxOrderSummary_MENU">
</div>

<? include "tbframef.php"?>
<input type="hidden" id="currentUrl" name="currentUrl" value="<?=selfURL()?>" />
</div>
<script>
var OrderSummaryCurrentTab ='overview'; 
var OrderSummaryCurrentID = 0;
function OrderSummaryChangeTab(name)
{
	switch(name){
		case 'overview':
			OrderSummaryCurrentTab = name;
			showHTML('DivAjaxOrderSummary','../eorder/eorder_preview.php?eorderid='+OrderSummaryCurrentID);	
			break;
		case 'repairrework':
			OrderSummaryCurrentTab = name;
			showHTML('DivAjaxOrderSummary','../eorder/eorder_repairrework.php?eorderid='+OrderSummaryCurrentID);	
			break;
		case 'edit':
			CloseDivShowSummary();
			OrderSummaryCurrentTab = name;
			//showHideLayers('DivShowSummary','','hide');;
			location = '../eorder/eorder_edit.php?eorderid='+OrderSummaryCurrentID;
			break;
		case 'invoice':
			OrderSummaryCurrentTab = name;
			showHTML('DivAjaxOrderSummary','../eorder/eorder_invoice_c.php?eorderid='+OrderSummaryCurrentID);
			break;
		case 'history':
			OrderSummaryCurrentTab = name;
			showHTML('DivAjaxOrderSummary','../eorder/eorder_history.php?eorderid='+OrderSummaryCurrentID);
			break;
		case 'log':
			OrderSummaryCurrentTab = name;
			showHTML('DivAjaxOrderSummary','../eorder/eorder_processhistory.php?eorderid='+OrderSummaryCurrentID);
			break;
		case 'submit':
			OrderSummaryCurrentTab = name;
			showHideLayers('DivShowSummary','','hide');
			hideBG();
			document.location="../eorder/submit_order.php?eorderid="+OrderSummaryCurrentID;
			//showHTML('DivAjaxOrderSummary','../eorder/submit_order.php?eorderid='+OrderSummaryCurrentID);
			break;
		case 'print':
			popitup("../cfrontend/printversion.php?tab="+OrderSummaryCurrentTab+"&eorderid="+OrderSummaryCurrentID);
			break;
		case 'arrive':
			//OrderSummaryCurrentTab = 'overview';
			showHTML('DivAjaxOrderSummary','../eorder/eorder_arrive.php?eorderid='+OrderSummaryCurrentID+'&status=2');
			//showHTML('DivAjaxOrderSummary','../order/orderprint.php?eorderid='+OrderSummaryCurrentID);
			//popitup("../cfrontend/printversion.php?tab="+OrderSummaryCurrentTab+"&eorderid="+OrderSummaryCurrentID);
			break;
		case 'submitarrive':
			OrderSummaryCurrentTab = 'overview';
			var adate = getValue('eorder_confirmarrivedate_day');if(adate.length==1){	adate = '0'+adate;	}
			var amonth = getValue('eorder_confirmarrivedate_month');	if(amonth.length==1){	amonth = '0'+amonth;}
			var arrivedate = getValue('eorder_confirmarrivedate_year')+'-'+amonth+'-'+adate;
			var arrivetime = getValue('eorder_confirmarrivetime_hour')+':'+getValue('eorder_confirmarrivetime_minute')+':00';
			
			
			var rdate = getValue('eorder_confirmreleasedate_day');if(rdate.length==1){rdate = '0'+rdate;}
			var rmonth = getValue('eorder_confirmreleasedate_month');if(rmonth.length==1){rmonth = '0'+rmonth;}
			var releasedate = getValue('eorder_confirmreleasedate_year')+'-'+rmonth+'-'+rdate;
			var releasetime = getValue('eorder_confirmreleasetime_hour')+':'+getValue('eorder_confirmreleasetime_minute')+':00';
			
			var arriveDateTime = arrivedate+' '+arrivetime;
			var releaseDateTime = releasedate+' '+releasetime;
			var boxcolor = getValue('boxcolor');
			
			
			var cb = function(){
				showHTML('DivAjaxOrderSummary','../order/orderprint.php?eorderid='+OrderSummaryCurrentID);
				popitup("../cfrontend/printversion.php?tab="+OrderSummaryCurrentTab+"&eorderid="+OrderSummaryCurrentID);				
			}
			
			showHTML('DivAjaxOrderSummary_MENU','../eorder/eorder_setstatus.php?eorderid='+OrderSummaryCurrentID+'&status=2&adate='+encodeTH(arriveDateTime)+'&rdate='+encodeTH(releaseDateTime)+"&box="+boxcolor,cb);
			
			
			break;			
		case 'paid':
			showHTML('DivAjaxOrderSummary_MENU','../eorder/eorder_setstatus.php?eorderid='+OrderSummaryCurrentID+'&status=7');
			break;
		case 'mac5':
			showHTML('DivAjaxOrderSummary','../eorder/eorder_mac5.php?eorderid='+OrderSummaryCurrentID+'',function(){ setTimeout("MAC5_Init()",100);});
			break;
		case 'attachimage':
			showHTML('DivAjaxOrderSummary','../eorder/eorder_showpicture.php?eorderid='+OrderSummaryCurrentID+'&type=a');
			break;
		case 'releaseimage':
			showHTML('DivAjaxOrderSummary','../eorder/eorder_showpicture.php?eorderid='+OrderSummaryCurrentID+'&type=r');
			break;
		case 'menu':
			showHTML('DivAjaxOrderSummary','../cfrontend/staffmenu.php?eorderid='+OrderSummaryCurrentID);
			break;
		case 'deleteorder':
			showHTML('DivAjaxOrderSummary','../eorder/eorder_deleteorder_c.php?eorderid='+OrderSummaryCurrentID);
			//CloseDivConfirmDelete();
			//DeleteComplete();
			break;
	}
	
}
function OpenDivShowSummary(id)
{
	OrderSummaryCurrentID = id;
	<?=$OpenDivShowSummaryAlterMethod ?>;
	activeBG();
	makeScale('DivShowSummary',80,90);
	makeScale('DivAjaxOrderSummary',80,90,-18,-50);
	
	makeCenterScreen('DivShowSummary');
	showHideLayers('DivShowSummary','','show');
	showHTML('DivAjaxOrderSummary','../eorder/eorder_preview.php?eorderid='+id);
	showHTML('DivAjaxOrderSummary_MENU','../cfrontend/ordersummary_menu.php?eorderid='+id);
}
<? $OpenDivShowSummaryAlterMethod=""; ?>
function CloseDivShowSummary()
{
	hideBG();
	showHideLayers('DivShowSummary','','hide');
}
showHideLayers('DivShowSummary','','hide');
function popitup(url) {
	newwindow=window.open(url,'name','height=640,width=480,scrollbars=1');
	if (window.focus) {newwindow.focus()}
	return false;
}
</script>

<script>
function OpenDivConfirmDelete(){
	//makeScale('divConfirmDelete',1,1);
	//makeCenterScreen('divConfirmDelete');
	showHideLayers('divConfirmDelete','','show');
	showHideLayers('DivstaffMenu','','hide');
}

function CloseDivConfirmDelete(){
	
	//alert(getValue('currentUrl'));
	
	showHideLayers('divConfirmDelete','','hide');
	showHideLayers('DivstaffMenu','','show');
}

function DeleteComplete(){
	CloseDivConfirmDelete();
	CloseDivShowSummary();
	location = getValue('currentUrl');
	
}

function MAC5_OnSend(){

}
</script>

