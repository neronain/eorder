function build_teeth_html(number,id,pintooth){
	text='';
	if(id==0){
		text+="	<table  cellpadding=\"0\" cellspacing=\"0\"><tr>";
	}else{
		text+="	<table  cellpadding=\"0\" cellspacing=\"0\" bgcolor=\"#FFFFCC\"><tr>";
	}
	if(pintooth==1){
		text+="  <td background=\"../resource/images/eorder/teeth/d_pintooth.gif\">";
	}else	if(pintooth==2){
		text+="  <td background=\"../resource/images/eorder/teeth/d_pintooth2.gif\">";
	}else{
		text+="  <td>";
	}
	text+="		<a href=\"#fixteeth_select\">";
	if(id==0){
		text+="			<img src=\"../resource/images/eorder/teeth/b_"+number+".gif\" name=\"fixteeth_"+number+"\" width=\"44\" height=\"44\" border=\"0\"></a>";
	}else{
		text+="			<img src=\"../resource/images/eorder/teeth/b_"+number+".gif\" name=\"fixteeth_"+number+"\" width=\"32\" height=\"32\" border=\"0\"></a>";
	}

	text+="	</td></tr></table>";
/*
	<table width="44" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="12" height="12" bgcolor="#FF0000"></td>
    <td width="12" height="12"></td>
    <td width="12" height="12" bgcolor="#FF0000"></td>
    <td width="8" height="12"></td>
  </tr>
  <tr>
    <td width="12" bgcolor="#FF0000">s</td>
    <td height="32" width="32" colspan="3" rowspan="3">d</td>
  </tr>
  <tr>
    <td width="12"  bgcolor="#00FF00">c</td>
  </tr>
  <tr>
    <td width="8" bgcolor="#FF0000">d</td>
  </tr>
</table>
		*/
	return text;
}



