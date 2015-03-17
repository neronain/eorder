<?php
$fixmaterial_imagepath = "../resource/images/eorder/fix/";
$fixmaterial_curentcy = "฿";



if(!$DEFINE_FIX_CONFIG){
	$DEFINE_FIX_CONFIG = 1;
	function GetFixMaterialName($id,$opt = 0){
		global $fixmaterial_name;
		global $fixmaterial_idvalue;
		global $fixmaterial_option_value;
		global $fixmaterial_option_sname;
		
		for($i=0;$i<count($fixmaterial_name);$i++){
			if($id == $fixmaterial_idvalue[$i]){
				$opttext = "";
				//var_dump($opt);
				//var_dump($removematerial_option_sname[$i]);
				if(count($fixmaterial_option_value[$i])>0){
					//echo "count[/]";
					for($j=0;$j<count($fixmaterial_option_value[$i]);$j++){
						//echo "check".$removematerial_option_value[$i][$j];
						if($opt == $fixmaterial_option_value[$i][$j]){
							$opttext = $fixmaterial_option_sname[$i][$j];
						}
					}
				}
				//echo($opttext);
				$opttext  = str_replace("[W]"," - Wire reinforced",$opttext);
				$opttext  = str_replace("[P]"," - Post core",$opttext);
				$opttext  = str_replace("[CL]"," - CL",$opttext);
				$opttext  = str_replace("[P+CL]"," - Postcore + CL",$opttext);
				$opttext  = str_replace("[IM]"," - Implant",$opttext);
				$opttext  = str_replace("[R]"," - Richmond",$opttext);
				
				return $fixmaterial_name[$i].$opttext;
			}
		}
		return "Error : No ID $id";
	}
	function GetFixMaterialOptionName($id,$opt = 0){
		global $fixmaterial_name;
		global $fixmaterial_idvalue;
		global $fixmaterial_option_value;
		global $fixmaterial_option_sname;
		
		for($i=0;$i<count($fixmaterial_name);$i++){
			if($id == $fixmaterial_idvalue[$i]){
				$opttext = "";
				//var_dump($opt);
				//var_dump($removematerial_option_sname[$i]);
				if(count($fixmaterial_option_value[$i])>0){
					//echo "count[$opt]";
					for($j=0;$j<count($fixmaterial_option_value[$i]);$j++){
						//echo $fixmaterial_option_value[$i][$j];
						
						if($opt == $fixmaterial_option_value[$i][$j]){
							//echo "match [$i][$j]".$fixmaterial_option_sname[$i][$j];
							$opttext = $fixmaterial_option_sname[$i][$j];
						}
					}
				}
				//echo($opttext);
				$opttext  = str_replace("[W]","(Wire reinforced)",$opttext);
				$opttext  = str_replace("[P]","(Postcore)",$opttext);
				$opttext  = str_replace("[CL]","(CL)",$opttext);
				$opttext  = str_replace("[P+CL]","(Postcore+CL)",$opttext);
				$opttext  = str_replace("[IM]","(Implant)",$opttext);
				$opttext  = str_replace("[PT]","(Pontic)",$opttext);
				$opttext  = str_replace("[R]","(Richmond)",$opttext);

				return $opttext;
			}
		}
		return "Error : No ID $id";
	}	
	function GetFixMaterialImage($id,$auto=0){
		global $fixmaterial_image;
		global $fixmaterial_idvalue;
		global $fixmaterial_imagepath;
		$auto_fill = array();
		for($i=0;$i<count($fixmaterial_image);$i++){
			if($id == $fixmaterial_idvalue[$i]){
				if(in_array($id,$auto_fill))
					return $fixmaterial_imagepath. "t_uppergray.gif";
				else
					return $fixmaterial_imagepath.$fixmaterial_image[$i];
			}
		}
		return "Error : No ID $id";
	}
}

$i=0;
$fixmaterial_name[$i] = "None";
$fixmaterial_shortname[$i] = "";
$fixmaterial_image[$i] = "t_uppergray.gif";
$fixmaterial_idvalue[$i] = "0";
$fixmaterial_description[$i] = "test-destcrip";
$fixmaterial_price[$i] = 0;
$i++;

$fixmaterial_name[$i] = "Coping";
$fixmaterial_shortname[$i] = "Coping";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "1";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 475;
$i++;

$fixmaterial_name[$i] = "Temp. Resin";
$fixmaterial_shortname[$i] = "TmpRS";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "2";
$fixmaterial_description[$i] = "test-destcrip";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 150;
$i++;

$fixmaterial_name[$i] = "Full Metal Crown";
$fixmaterial_shortname[$i] = "FMC";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "3";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 400;
$i++;

$fixmaterial_name[$i] = "Telescopic-crown";
$fixmaterial_shortname[$i] = "Tele-C";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "4";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 1100;
$i++;

$fixmaterial_name[$i] = "Temp. Composite";
$fixmaterial_shortname[$i] = "TmpCPS";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "5";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 200;
$i++;

$fixmaterial_name[$i] = "Inlay/Onlay";
$fixmaterial_shortname[$i] = "In/On";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "6";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 500;
$i++;

$fixmaterial_name[$i] = "Zircon";
$fixmaterial_shortname[$i] = "Zir";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "7";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 600;
$i++;

$fixmaterial_name[$i] = "Composite";
$fixmaterial_shortname[$i] = "CPS";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "8";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 550;
$i++;

$fixmaterial_name[$i] = "TA";
$fixmaterial_shortname[$i] = "TA";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "9";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 600;
$i++;

$fixmaterial_name[$i] = "BruxZir";
$fixmaterial_shortname[$i] = "BruxZir";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "10";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 600;
$i++;

$fixmaterial_name[$i] = "Wax Up Full Contour";
$fixmaterial_shortname[$i] = "WUFC";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "11";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 250;
$i++;

$fixmaterial_name[$i] = "Post & Core";
$fixmaterial_shortname[$i] = "P&C";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "12";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 450;
$i++;

$fixmaterial_name[$i] = "BruxZir Cutback";
$fixmaterial_shortname[$i] = "BruxCut";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "13";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 600;
$i++;

$fixmaterial_name[$i] = "Acrylic Jacket";
$fixmaterial_shortname[$i] = "AcrJ";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "14";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 600;
$i++;

$fixmaterial_name[$i] = "Bar Attachment";
$fixmaterial_shortname[$i] = "BarAtt";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "15";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 750;
$i++;

$fixmaterial_name[$i] = "e-max press";
$fixmaterial_shortname[$i] = "e-max";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "16";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 600;
$i++;

$fixmaterial_name[$i] = "Casting Abutment";
$fixmaterial_shortname[$i] = "CasAbut";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "17";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 950;
$i++;

$fixmaterial_name[$i] = "PFM";
$fixmaterial_shortname[$i] = "PFM";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "18";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 300;
$i++;

$fixmaterial_name[$i] = "Empress Esthetic";
$fixmaterial_shortname[$i] = "EmpEs";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "19";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 600;
$i++;

$fixmaterial_name[$i] = "Zircon Abutment";
$fixmaterial_shortname[$i] = "ZirAbut";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "20";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 600;
$i++;

$fixmaterial_name[$i] = "PF";
$fixmaterial_shortname[$i] = "PF";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "21";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 350;
$i++;

$fixmaterial_name[$i] = "Cosmo-Post";
$fixmaterial_shortname[$i] = "Csm-P";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "22";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 900;
$i++;

$fixmaterial_name[$i] = "Hibrid Implant";
$fixmaterial_shortname[$i] = "HiIm";
$fixmaterial_image[$i] = "normal.gif";
$fixmaterial_idvalue[$i] = "23";
$fixmaterial_description[$i] = "";
$fixmaterial_option_question[$i] = "Please select option";

$fixmaterial_option_value[$i][0] = "0";
$fixmaterial_option_fname[$i][0] = "None";
$fixmaterial_option_sname[$i][0] = "";
$fixmaterial_option_value[$i][1] = "1";
$fixmaterial_option_fname[$i][1] = "Post core";
$fixmaterial_option_sname[$i][1] = "[P]";
$fixmaterial_option_value[$i][2] = "2";
$fixmaterial_option_fname[$i][2] = "Postcore + CL";
$fixmaterial_option_sname[$i][2] = "[P+CL]";
$fixmaterial_option_value[$i][3] = "3";
$fixmaterial_option_fname[$i][3] = "Implant";
$fixmaterial_option_sname[$i][3] = "[IM]";
$fixmaterial_option_value[$i][4] = "4";
$fixmaterial_option_fname[$i][4] = "Pontic";
$fixmaterial_option_sname[$i][4] = "[PT]";
$fixmaterial_option_value[$i][5] = "5";
$fixmaterial_option_fname[$i][5] = "Richmond";
$fixmaterial_option_sname[$i][5] = "[R]";
$fixmaterial_option_value[$i][6] = "6";
$fixmaterial_option_fname[$i][6] = "Veneer";
$fixmaterial_option_sname[$i][6] = "[V]";
$fixmaterial_option_value[$i][7] = "7";
$fixmaterial_option_fname[$i][7] = "Inlay/Onlay";
$fixmaterial_option_sname[$i][7] = "[IO]";

$fixmaterial_optiononselect[$i] = "FixOptionMaterial_Popup();";
$fixmaterial_price[$i] = 650;
$i++;

?>