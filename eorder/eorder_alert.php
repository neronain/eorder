<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<? // ------------------------------------------------------------------------------- ?>

<div id="DivEorderAlert"
style="position:absolute; white-space:nowrap; left:0px; top:0px; width:500px; height:500px; z-index:1; margin:0;<?="display:none;"?>"
>
<? $tbframeheader = "<div id=\"div_alert\"></div>"?>
<? $tbframehclose = "";?>
<? include "../cfrontend/tbframeh.php"?>
<table  width="100%" border="0" align="center">
  <tr>
      <td id = "TdAlert" align="center">&nbsp;</td>
  </tr>
</table>
<table align="center" cellpadding="2" cellspacing="0">
	<tr class="tdButtonOnOut" onClick="closeAlert()"  onMouseOver="this.className='tdButtonOnOver'" onMouseOut="this.className='tdButtonOnOut'">
	  <td ><img src="../resource/images/icon/famfamfam/action_stop.gif" width="16" height="16" /></td>
<td >close</td>
  </tr> 
</table>


<? include "../cfrontend/tbframef.php"?>
</div>


<script>

alertmsg = new Array(
"SelectTOW","Tip",300,130,"Please Select type of work first",
"CDoctorName","Error",300,130,"Please select doctor name",
"CPatientName","Error",300,130,"Please insert patient name",
"Name4","header4",200,100,"alert message 4",
"Name5","header5",200,100,"alert message 5"
);



function showAlert(name){
	var id = -1;
	for(i=0;i<alertmsg.length;i+=5){
		//alert(alertmsg[i]);
		if(alertmsg[i]==name){
			id = i/5;
			break;
		}
	}
	//alert(id);
	activeBG();
	writeit('div_alert',alertmsg[id*5+1]);
	writeit('TdAlert',alertmsg[id*5+4]);
	
	findObj('DivEorderAlert').style.width = alertmsg[id*5+2]+"px";
	findObj('DivEorderAlert').style.height = alertmsg[id*5+3]+"px";
	//findObj('TdAlert').style.width = (alertmsg[id*2+1])+"px";
	findObj('TdAlert').style.height = (alertmsg[id*5+3]-80)+"px";
	//DivEorderAlert_inner
	
	
	
	makeCenterScreen('DivEorderAlert');
	showHideLayers('DivEorderAlert','','show');
}

function closeAlert(){
	hideBG();
	showHideLayers('DivEorderAlert','','hide');
}

showHideLayers('DivEorderAlert','','hide');

</script>
