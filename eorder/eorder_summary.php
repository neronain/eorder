<?php include_once "../eorder/eorder_fix_config.php" ?>
<?php include_once "../eorder/eorder_remove_config.php" ?>
<?php include_once "../core/teeth.php" ?>
<script>
var fixmaterial_price = new Array();
var fixmaterial_name = new Array();
var removematerial_price = new Array();
var removematerial_name = new Array();
var fix_material = new Array();
var remove_material = new Array();
<? 
//var_dump($fixmaterial_price);
for($i=0;$i<count($fixmaterial_price);$i++) {
	echo "fixmaterial_price[".$fixmaterial_idvalue[$i]."]= ".($fixmaterial_price[$i]+0).";\n";
	echo "fixmaterial_name[".$fixmaterial_idvalue[$i]."] = '".($fixmaterial_name[$i])."';\n";
}

for($i=0;$i<count($removematerial_price);$i++) {
	echo "removematerial_price[".$removematerial_idvalue[$i]."] = ".($removematerial_price[$i]+0).";\n";
	echo "removematerial_name[".$removematerial_idvalue[$i]."] = '".($removematerial_name[$i])."';\n";
}
?>

function ReCalculateSummary(divname){
for(var i=0;i<<?=count($fixmaterial_price)?>;i++){
	fix_material[i] = 0;
}
for(var i=0;i<<?=count($removematerial_price)?>;i++){
	remove_material[i] = 0;
}
	var total_quantity = 0;
	var total_cost = 0.0;
	for(var i=1;i<=4;i++){
		for(var j=1;j<=8;j++){
			index = i*10+j;
			value = findObj('fix_material['+index+']').value;
			fix_material[value] += 1;
			value = findObj('remove_material['+index+']').value;
			remove_material[value] += 1;
		}
	}

		var text='';


text+='			<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#999999">';
text+='            <tr>';
text+='              <td height="20" align="center" bgcolor="#CCCCCC">List</td>';
text+='              <td width="50" align="center" bgcolor="#CCCCCC">Each</td>';
text+='              <td width="40" height="20" align="center" bgcolor="#CCCCCC">Unit</td>';
text+='              <td width="50" height="20" align="center" bgcolor="#CCCCCC">Total</td>';
text+='            </tr>';

for(var key in fix_material) {
	if(fix_material[key] > 0 && key != 0) {
		total_quantity += fix_material[key];
		total_cost += (fix_material[key]*fixmaterial_price[key]);
		text+='            <tr>';
		text+='              <td bgcolor="#FFFFFF">' + fixmaterial_name[key] + '</td>';
		text+='              <td align="right" bgcolor="#FFFFFF">' + fixmaterial_price[key] + '</td>';
		text+='              <td align="right" bgcolor="#FFFFFF">' + fix_material[key] + '</td>';
		text+='              <td align="right" bgcolor="#FFFFFF">' + (fix_material[key]*fixmaterial_price[key]) + '</td>';
		text+='            </tr>';
	}
}

for(var key in remove_material) {
	if(remove_material[key] > 0 && key != 0) {
		total_quantity += remove_material[key];
		total_cost += (remove_material[key]*removematerial_price[key]);
		text+='            <tr>';
		text+='              <td bgcolor="#FFFFFF">' + removematerial_name[key] + '</td>';
		text+='              <td align="right" bgcolor="#FFFFFF">' + removematerial_price[key] + '</td>';
		text+='              <td align="right" bgcolor="#FFFFFF">' + remove_material[key] + '</td>';
		text+='              <td align="right" bgcolor="#FFFFFF">' + (remove_material[key]*removematerial_price[key]) + '</td>';
		text+='            </tr>';
	}
}

text+='            <tr>';
text+='              <td align="right" bgcolor="#CCCCCC" colspan="2"> Estimate total</td>';
text+='              <td align="right" bgcolor="#FFFFFF">' + total_quantity + '</td>';
text+='              <td align="right" bgcolor="#FFFFFF">' + total_cost + '</td>';
text+='            </tr>';
text+='            <tr>';
text+='              <td align="center" bgcolor="#CCCCCC" colspan="4"><span style="color:#FF0000"><strong>* This cost may change without notice *</strong></span></td>';
text+='            </tr>';


text+='          </table>';

	writeit(divname,text);
	
}

</script>

