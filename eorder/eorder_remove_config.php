<?php
$remove_config_main = array(
    "0" => "None",
    "A" => "RPD",
    "B" => "TP",
    "C" => "Acetal",
    "D" => "Hexa-Flex",
    "E" => "Order spacial Tray",
    "F" => "Bite Block",
    "G" => "Order spacial Tray + Bite Block",
    "H" => "Removeable bridge",
);

$remove_config_option = array(
    "A" => array(
        "A" => " + Full Plate",
        "B" => " + Lingual Plate",
        "C" => " + Lingual Bar",
        "D" => " + Kennedy Bar",
        "E" => " + Palatal Stap (minimal coverage)",
        "F" => " + Skeleton Design",
        "G" => " + Horseshoe Plate",
        "H" => " + Ackers METAL",
        "I" => " + Rebase",
        "J" => " + Pepair",
        "K" => " + Adiunction",
        "L" => " + None"),
    "B" => array(
        "A" => " + Block Out & Duplicate Technique",
        "B" => " + Full Denture",
        "C" => " + Partial Denture",
        "D" => " + Rebase",
        "E" => " + Reline",
        "F" => " + Addition",
        "G" => " + Lingualized Occlusion",
        "H" => " + Repair"),
     "C" => array(
         "A" => " + Acetal Tooth",
         "B" => " + Acetal Clasp",
         "C" => " + All Acetal Frame Work",
         "D" => " + All Acetal Removable Bridge",
         "E" => " + Acetal Swing Lock"),
    "D" => array(
        "A" => " + Partial Denture",
        "B" => " + Removable Bridge",
        "C" => " + Special Request")
);


if(!$DEFINE_REMOVE_CONFIG){
	$DEFINE_REMOVE_CONFIG = 1;
	function GetRemoveMaterialName($id,$opt = 0){
		global $removematerial_name;
		global $removematerial_idvalue;
		global $removematerial_option_value;
		global $removematerial_option_sname;
		
		for($i=0;$i<count($removematerial_name);$i++){
			if($id == $removematerial_idvalue[$i]){
				$opttext = "";
				//var_dump($opt);
				//var_dump($removematerial_option_sname[$i]);
				if(count($removematerial_option_value[$i])>0){
					//echo "count[/]";
					for($j=0;$j<count($removematerial_option_value[$i]);$j++){
						//echo "check".$removematerial_option_value[$i][$j];
						if($opt == $removematerial_option_value[$i][$j]){
							$opttext = $removematerial_option_sname[$i][$j];
						}
					}
				}
				//echo($opttext);
				$opttext  = str_replace("[R]"," - Rest",$opttext);
				
				return $removematerial_name[$i].$opttext;
			}
		}
		return "Error : No ID $id";
	}
	function GetRemoveMaterialImage($id,$auto=0){
		global $removematerial_image;
		global $removematerial_idvalue;
		global $removematerial_imagepath;
		$auto_fill = array(26,31);
		for($i=0;$i<count($removematerial_image);$i++){
			if($id == $removematerial_idvalue[$i]){
				if(in_array($id,$auto_fill))
					return $removematerial_imagepath. "t_uppergray.gif";
				else
					return $removematerial_imagepath.$removematerial_image[$i];
			}
		}
		return "Error : No ID $id";
	}
	
	function ExportRemoveMaterialTypeMain($arr) {
		//var_dump ($arr);
        global $remove_config_main;
        global $remove_config_option;

        return $remove_config_main[$arr[0]];

        /*$result = "";

		$type[0] = array(
				"0" => "None",
				"A" => "RPD",
				"B" => "TP",
				"C" => "Acetal",
				"D" => "Hexa-Flex",
				"E" => "Order spacial Tray",
				"F" => "Bite Block",
				"G" => "Order spacial Tray + Bite Block",
				"H" => "Removeable bridge",
	
		);
		return $type[0][$arr{0}];*/
	}
	function ExportRemoveMaterialTypeText($arr) {
		//var_dump ($arr);
		$result = "";
        global $remove_config_main;
        global $remove_config_option;

        return $remove_config_main[$arr[0]].$remove_config_option[$arr[0]][$arr[1]];

		/*$type[0] = array(
			"0" => "None",
			"A" => "RPD",
			"B" => "TP",
			"C" => "Acetal",
			"D" => "Hexa-Flex",
			"E" => "Order spacial Tray",
			"F" => "Bite Block",
			"G" => "Order spacial Tray + Bite Block",
			"H" => "Removeable bridge",
			
			);
		
		if($arr{0} == "A"){
			$type[1] = array(
				"A" => " + Full Plate",
				"B" => " + Lingual Plate",
				"C" => " + Lingual Bar",
				"D" => " + Kennedy Bar",
				"E" => " + Palatal Stap (minimal coverage)",
				"F" => " + Skeleton Design",
				"G" => " + Horseshoe Plate",
				"H" => " + Ackers METAL",
				"I" => " + Rebase",
				"J" => " + Pepair",
				"K" => " + Adiunction",
				"L" => " + None");
		}else if($arr{0} == "B"){
			$type[1] = array(
			"A" => " + Block Out & Duplicate Technique",
			"B" => " + Full Denture",
			"C" => " + Partial Denture",
			"D" => " + Rebase",
			"E" => " + Reline",
			"F" => " + Addition",
			"G" => " + Lingualized Occlusion",
			"H" => " + Repair");
		}else if($arr{0} == "C"){
			$type[1] = array(
			"A" => " + Acetal Tooth",
			"B" => " + Acetal Clasp",
			"C" => " + All Acetal Frame Work",
			"D" => " + All Acetal Removable Bridge",
			"E" => " + Acetal Swing Lock");
		}else if($arr{0} == "D"){
			$type[1] = array(
			"A" => " + Partial Denture",
			"B" => " + Removable Bridge",
			"C" => " + Special Request");
		}else if($arr{0} == "E"){
		
		}
		
		return $type[0][$arr{0}].$type[1][$arr{1}];
		//return $type[0][$arr{0}].$type[1][$arr{1}].$type[2][$arr{2}].$type[3][$arr{3}];*/
	}

}


$removematerial_imagepath = "../resource/images/eorder/remove/";
$removematerial_curentcy = "฿";
$i=0;
//-------------------------------------- RPD -----------------------------------

$removematerial_name[$i] = "None";
$removematerial_shortname[$i] = "";
$removematerial_image[$i] = "t_uppergray.gif";
$removematerial_idvalue[$i] = "0";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 0;
$i++;

$removematerial_name[$i] = "+Addition";
$removematerial_shortname[$i] = "Addition";
$removematerial_image[$i] = "c_addition.gif";
$removematerial_idvalue[$i] = "35";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Backing";
$removematerial_shortname[$i] = "Backing";
$removematerial_image[$i] = "c_backing.gif";
$removematerial_idvalue[$i] = "36";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;

$removematerial_name[$i] = "Acker Double arm clasp";
$removematerial_shortname[$i] = "Acker";
$removematerial_image[$i] = "c_acker.gif";
$removematerial_idvalue[$i] = "1";
$removematerial_description[$i] = "test-destcrip";
$removematerial_option_question[$i] = "Please select Option";
$removematerial_option_value[$i][0] = "0";
$removematerial_option_fname[$i][0] = "None";
$removematerial_option_sname[$i][0] = "";
$removematerial_option_value[$i][1] = "1";
$removematerial_option_fname[$i][1] = "Rest";
$removematerial_option_sname[$i][1] = "[R]";
$removematerial_optiononselect[$i] = "RemoveOptionMaterial_Popup();";
$removematerial_price[$i] = 222;
$i++;


$removematerial_name[$i] = "Round Section cast clasp";
$removematerial_shortname[$i] = "Round";
$removematerial_image[$i] = "c_round.gif";
$removematerial_idvalue[$i] = "2";
$removematerial_description[$i] = "";
$removematerial_option_question[$i] = "Please select Option";
$removematerial_option_value[$i][0] = "0";
$removematerial_option_fname[$i][0] = "None";
$removematerial_option_sname[$i][0] = "";
$removematerial_option_value[$i][1] = "1";
$removematerial_option_fname[$i][1] = "Rest";
$removematerial_option_sname[$i][1] = "[R]";
$removematerial_optiononselect[$i] = "RemoveOptionMaterial_Popup();";
$removematerial_price[$i] = 333;
$i++;


$removematerial_name[$i] = "Bonwill/Embrasure";
$removematerial_shortname[$i] = "Bonwill";
$removematerial_image[$i] = "c_bonwill.gif";
$removematerial_idvalue[$i] = "3";
$removematerial_description[$i] = "";
$removematerial_option_question[$i] = "Please select Option";
$removematerial_option_value[$i][0] = "0";
$removematerial_option_fname[$i][0] = "None";
$removematerial_option_sname[$i][0] = "";
$removematerial_option_value[$i][1] = "1";
$removematerial_option_fname[$i][1] = "Rest";
$removematerial_option_sname[$i][1] = "[R]";
$removematerial_optiononselect[$i] = "RemoveOptionMaterial_Popup();";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 444;
$i++;

$removematerial_name[$i] = "Roach Y clasp";
$removematerial_shortname[$i] = "Roach Y";
$removematerial_image[$i] = "c_y.gif";
$removematerial_idvalue[$i] = "4";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 555;
$i++;

$removematerial_name[$i] = "J-clasp";
$removematerial_shortname[$i] = "J-clasp";
$removematerial_image[$i] = "c_j.gif";
$removematerial_idvalue[$i] = "5";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 666;
$i++;

$removematerial_name[$i] = "Reverse J-clasp";
$removematerial_shortname[$i] = "Reverse J";
$removematerial_image[$i] = "c_reverse_j.gif";
$removematerial_idvalue[$i] = "6";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 777;
$i++;

$removematerial_name[$i] = "C-clasp/Return clasp/Reverse";
$removematerial_shortname[$i] = "C-clasp";
$removematerial_image[$i] = "c_c.gif";
$removematerial_idvalue[$i] = "7";
$removematerial_description[$i] = "";
$removematerial_option_question[$i] = "Please select Option";
$removematerial_option_value[$i][0] = "0";
$removematerial_option_fname[$i][0] = "None";
$removematerial_option_sname[$i][0] = "";
$removematerial_option_value[$i][1] = "1";
$removematerial_option_fname[$i][1] = "Rest";
$removematerial_option_sname[$i][1] = "[R]";
$removematerial_optiononselect[$i] = "RemoveOptionMaterial_Popup();";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 888;
$i++;

$removematerial_name[$i] = "Ring clasp";
$removematerial_shortname[$i] = "Ring";
$removematerial_image[$i] = "c_ring.gif";
$removematerial_idvalue[$i] = "8";
$removematerial_description[$i] = "";
$removematerial_option_question[$i] = "Please select Option";
$removematerial_option_value[$i][0] = "0";
$removematerial_option_fname[$i][0] = "None";
$removematerial_option_sname[$i][0] = "";
$removematerial_option_value[$i][1] = "1";
$removematerial_option_fname[$i][1] = "Rest";
$removematerial_option_sname[$i][1] = "[R]";
$removematerial_optiononselect[$i] = "RemoveOptionMaterial_Popup();";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;

$removematerial_name[$i] = "Ball clasp";
$removematerial_shortname[$i] = "Ball";
$removematerial_image[$i] = "c_ball.gif";
$removematerial_idvalue[$i] = "9";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;

$removematerial_name[$i] = "Acetal Clasp";
$removematerial_shortname[$i] = "Acetal Clasp";
$removematerial_image[$i] = "c_acetalclasp.gif";
$removematerial_idvalue[$i] = "18";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;
/* $removematerial_name[$i] = "Rest";
$removematerial_shortname[$i] = "Rest";
$removematerial_image[$i] = "c_rest.gif";
$removematerial_idvalue[$i] = "10";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;

$i++; */
$RPDcount = $i;
//-------------------------------------- TP -----------------------------------
$TPstart = $i;

$removematerial_name[$i] = "None";
$removematerial_shortname[$i] = "";
$removematerial_image[$i] = "t_uppergray.gif";
$removematerial_idvalue[$i] = "0";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 0;
$i++;

$removematerial_name[$i] = "+Addition";
$removematerial_shortname[$i] = "Addition";
$removematerial_image[$i] = "c_addition.gif";
$removematerial_idvalue[$i] = "34";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Backing";
$removematerial_shortname[$i] = "Backing";
$removematerial_image[$i] = "c_backing.gif";
$removematerial_idvalue[$i] = "11";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;

$removematerial_name[$i] = "Wire clasp";
$removematerial_shortname[$i] = "Wire clasp";
$removematerial_image[$i] = "c_wireclasp.gif";
$removematerial_idvalue[$i] = "12";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;
$removematerial_name[$i] = "Cast clasp";
$removematerial_shortname[$i] = "Cast";
$removematerial_image[$i] = "c_cast.gif";
$removematerial_idvalue[$i] = "13";
$removematerial_description[$i] = "";
$removematerial_option_question[$i] = "Please select Option";
$removematerial_option_value[$i][0] = "0";
$removematerial_option_fname[$i][0] = "None";
$removematerial_option_sname[$i][0] = "";
$removematerial_option_value[$i][1] = "1";
$removematerial_option_fname[$i][1] = "Rest";
$removematerial_option_sname[$i][1] = "[R]";
$removematerial_optiononselect[$i] = "RemoveOptionMaterial_Popup();";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;

$removematerial_name[$i] = "Wire rest";
$removematerial_shortname[$i] = "Wire Rest";
$removematerial_image[$i] = "c_wirerest.gif";
$removematerial_idvalue[$i] = "14";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;
$removematerial_name[$i] = "Bon clasp";
$removematerial_shortname[$i] = "Bon clasp";
$removematerial_image[$i] = "c_bonclasp.gif";
$removematerial_idvalue[$i] = "15";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;

$removematerial_name[$i] = "Cast Rest";
$removematerial_shortname[$i] = "Cast Rest";
$removematerial_image[$i] = "c_rest.gif";
$removematerial_idvalue[$i] = "16";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;
$removematerial_name[$i] = "Acetal clasp";
$removematerial_shortname[$i] = "Rest";
$removematerial_image[$i] = "c_acetal.gif";
$removematerial_idvalue[$i] = "17";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999;
$i++;

/* $removematerial_name[$i] = "Wire Strengthener";
$removematerial_shortname[$i] = "Wire Streng";
$removematerial_image[$i] = "c_strengtherner.gif";
$removematerial_idvalue[$i] = "18";
$removematerial_description[$i] = "";
//$removematerial_optiononselect[$i] = "";
$removematerial_price[$i] = 999; 
$i++;*/


$TPcount = $i;
//-------------------------------------- HEXA -----------------------------------
$HEXAstart = $i;

$removematerial_name[$i] = "None";
$removematerial_shortname[$i] = "";
$removematerial_image[$i] = "t_uppergray.gif";
$removematerial_idvalue[$i] = "0";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 0;
$i++;

$removematerial_name[$i] = "+Addition";
$removematerial_shortname[$i] = "Addition";
$removematerial_image[$i] = "c_addition.gif";
$removematerial_idvalue[$i] = "33";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Acetal Clasp";
$removematerial_shortname[$i] = "Acetal";
$removematerial_image[$i] = "c_acetal.gif";
$removematerial_idvalue[$i] = "19";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Bon Clasp";
$removematerial_shortname[$i] = "Bon";
$removematerial_image[$i] = "c_bonclasp.gif";
$removematerial_idvalue[$i] = "20";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Wire Clasp";
$removematerial_shortname[$i] = "Wire Clasp";
$removematerial_image[$i] = "c_wireclasp.gif";
$removematerial_idvalue[$i] = "21";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Cate Clasp";
$removematerial_shortname[$i] = "Cate";
$removematerial_image[$i] = "c_cate.gif";
$removematerial_idvalue[$i] = "22";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Rest cate";
$removematerial_shortname[$i] = "Rest cate";
$removematerial_image[$i] = "c_rest.gif";
$removematerial_idvalue[$i] = "23";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Backing Cate";
$removematerial_shortname[$i] = "Backing cate";
$removematerial_image[$i] = "c_backing.gif";
$removematerial_idvalue[$i] = "24";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;

$i++;
$HEXAcount = $i;
//$removematerial_optiononselect[$i] = "";


//-------------------------------------- HEXA OPTION -----------------------------------
$HEXAOptionstart = $i;

$removematerial_name[$i] = "None";
$removematerial_shortname[$i] = "";
$removematerial_image[$i] = "t_uppergray.gif";
$removematerial_idvalue[$i] = "0";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 0;
$i++;

$removematerial_name[$i] = "+Addition";
$removematerial_shortname[$i] = "Addition";
$removematerial_image[$i] = "c_addition.gif";
$removematerial_idvalue[$i] = "25";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Clasp";
$removematerial_shortname[$i] = "";
$removematerial_image[$i] = "c_hexaflex.gif";
$removematerial_idvalue[$i] = "26";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

//-------------------------------------- ACETAL OPTION -----------------------------------
$removematerial_name[$i] = "None";
$removematerial_shortname[$i] = "";
$removematerial_image[$i] = "t_uppergray.gif";
$removematerial_idvalue[$i] = "0";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 0;
$i++;


$removematerial_name[$i] = "+Addition";
$removematerial_shortname[$i] = "Addition";
$removematerial_image[$i] = "c_addition.gif";
$removematerial_idvalue[$i] = "27";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Acetal Clasp";
$removematerial_shortname[$i] = "Acetal Clasp";
$removematerial_image[$i] = "c_acetalclasp.gif";
$removematerial_idvalue[$i] = "28";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "+Addition";
$removematerial_shortname[$i] = "Addition";
$removematerial_image[$i] = "c_addition.gif";
$removematerial_idvalue[$i] = "29";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "+Addition";
$removematerial_shortname[$i] = "Addition";
$removematerial_image[$i] = "c_addition.gif";
$removematerial_idvalue[$i] = "30";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "Acetal Clasp";
$removematerial_shortname[$i] = "";
$removematerial_image[$i] = "c_acetalclasp.gif";
$removematerial_idvalue[$i] = "31";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

$removematerial_name[$i] = "+Addition";
$removematerial_shortname[$i] = "Addition";
$removematerial_image[$i] = "c_addition.gif";
$removematerial_idvalue[$i] = "32";
$removematerial_description[$i] = "test-destcrip";
$removematerial_price[$i] = 222;
$i++;

?>