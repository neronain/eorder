<script src="../resource/javascript/default.js"></script>


<div id = "div_eorder_tooltip" align="right" style="position:absolute; white-space:nowrap; right:10px; top:10px; z-index:1; margin:0;
overflow:visible;width:150px;height:50px">
<table  width="100%"  border="0" bgcolor="#000000" cellpadding="2" cellspacing="1">
  <tr>
    <td background="../cfrontend/images/bgblockalpha_5.png"  id = "TableToolTip" >&nbsp;</td>
  </tr>
</table>
</div>


<script>

strTooltip=new Array (
300,"Tool Tip 1",
150,"Tool Tip 2 <br><br><br><br><br>sssss",
150,"Tool Tip 3",
150,"Tool Tip 4",
150,"Tool Tip 5",
150,"Tool Tip 6",
150,"Tool Tip 7",
150,"Tool Tip 8",
150,"Tool Tip 9",
150,"Tool Tip 10"
);

//writeit('TableToolTip',strTooltip[0]);
function dToolTip(index){
	findObj('div_eorder_tooltip').style.width = strTooltip[index*2+0]+"px";
	writeit('TableToolTip',strTooltip[index*2+1]);
	makeConnerScreen('div_eorder_tooltip');
	showHideLayers('div_eorder_tooltip','','show');
}

function hToolTip(){
	showHideLayers('div_eorder_tooltip','','hide');
}

showHideLayers('div_eorder_tooltip','','hide');

</script>