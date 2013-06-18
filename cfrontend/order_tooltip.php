<script src="../resource/javascript/default.js"></script>

<? include "tbframe2h.php"?>
<strong>-- Tooltip --<br /></strong>
<table  width="100%"  border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td background="../cfrontend/images/bgblockalpha_5.png"  id = "TableToolTip"  align="justify">&nbsp;</td>
  </tr>
</table>
<? include "tbframe2f.php"?>

<script>

strTooltip=new Array (
"PREVIEW",
"<img src=\"../resource/images/silkicons/zoom.gif\" style=\"background-color:#F3F2F2\" border=1 width=32 height=32  align=left /> &nbsp;Order summary/preview",
"SENDSUBMIT",
"<img src=\"../resource/images/silkicons/package_go.gif\" style=\"background-color:#F3F2F2\" border=1 width=32 height=32  align=left /> &nbsp;Send this order to Hexaceram",
"EDITORDER",
"<img src=\"../resource/images/silkicons/pencil.gif\" style=\"background-color:#F3F2F2\" border=1 width=32 height=32  align=left /> &nbsp;Edit order",
"DELETEORDER",
"<img src=\"../resource/images/silkicons/package_delete.gif\" style=\"background-color:#F3F2F2\" border=1 width=32 height=32  align=left /> &nbsp;Delete order",
"LISTORDER_DRAFT",
"<img src=\"../cfrontend/images/icons/draft.gif\" border=1 align=left /> &nbsp;List drafted orders",
"LISTORDER_SENDING",
"<img src=\"../cfrontend/images/icons/carr.gif\" border=1 align=left /> &nbsp;List the order which going to hexa",
"LISTORDER_ARRIVE",
"<img src=\"../cfrontend/images/icons/hexa.gif\" border=1 align=left /> &nbsp;List the order which arrived at hexa",
"LISTORDER_PROCESS",
"<img src=\"../cfrontend/images/icons/process.gif\" border=1 align=left /> &nbsp;List the order which processing in hexa",
"LISTORDER_SENDBACK",
"<img src=\"../cfrontend/images/icons/carl.gif\" border=1 align=left /> &nbsp;List the orders which coming to you",
"LISTORDER_WAITPAY",
"<img src=\"../cfrontend/images/icons/doctor_payment.gif\" border=1 align=left /> &nbsp;List pending payment orders",
"ADDORDER",
"<img src=\"../cfrontend/images/icons/add.gif\" border=1 align=left /> &nbsp;Create new order",
"TEXTBOX_LABNAME",
" &nbsp; Fill in your laboratory name",
"TEXTBOX_USERNAME",
" &nbsp; Change your login username",
"TEXTBOX_NEWPASSWORD",
" &nbsp; Fill in your new password",
"TEXTBOX_RETYPEPASSWORD",
" &nbsp; Retype your new password",
"TEXTBOX_OLDPASSWORD",
" &nbsp; Fill in your old password to confirm changing password",
"BUTTON_COPYADDRESS",
" &nbsp; Press this button will copy from address textbox into this textbox",
"GOT_ORDER",
"<img src=\"../resource/images/silkicons/package_link.gif\" style=\"background-color:#F3F2F2\" border=1 width=32 height=32  align=left /> &nbsp; Got finished order back from factory ",
"XXX",
"Tool Tip 10"
);

//writeit('TableToolTip',strTooltip[0]);
function dToolTip(key){
	//findObj('div_eorder_tooltip').style.width = strTooltip[index*2+0]+"px";
	var id = -1;
	for(i=0;i<strTooltip.length;i+=2){
		//alert(alertmsg[i]);
		if(strTooltip[i]==key){
			id = i/2;
			break;
		}
	}
	if(id==-1)
		writeit('TableToolTip',"NO implement tooltip "+key);
	else
		writeit('TableToolTip',strTooltip[id*2+1]);
	//makeConnerScreen('div_eorder_tooltip');
	//showHideLayers('div_eorder_tooltip','','show');
}

//function hToolTip(){
//	showHideLayers('div_eorder_tooltip','','hide');
//}

//showHideLayers('div_eorder_tooltip','','hide');

</script>