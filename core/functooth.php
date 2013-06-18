<?php
	include_once("../core/teeth.php");
	include_once("../core/funccalc.php");
	include("../eorder/eorder_fix_config.php");
	include("../eorder/eorder_remove_config.php");
	
	function ParseOptionArrayToText($option_array) {
		//var_dump($option_array);
		$result = "????????";
		foreach($option_array as $main_key => $main_value) {
			switch($main_key) {
				case "RPDAcrylic":
					$option = array(0 => "None","AcrylicPalaPress","AcrylicInvocap","Nylon","HighImpact");
					foreach($option as $key => $value) {
						if($value == $main_value)
							$result[0] = Tooth::ParseIndexToText($key);
					}
					break;
				case "TeethSetup":
					$option = array(0 => "None","Square","Triangular","Oval");
					foreach($option as $key => $value) {
						if($value == $main_value)
							$result[1] = Tooth::ParseIndexToText($key);
					}
					break;
				case "GumFit":
					$option = array(0 => "None","Hard","Socket","Soft");
					foreach($option as $key => $value) {
						if($value == $main_value)
							$result[2] = Tooth::ParseIndexToText($key);
					}
					break;
				case "TPOrderAcrylic":
					$option = array(0 => "None","AcrylicNormal","AcrylicHighImpact","AcrylicIvocap");
					foreach($option as $key => $value) {
						if($value == $main_value)
							$result[3] = Tooth::ParseIndexToText($key);
					}
					break;
				case "TPOrderGrid":
					$option = array(0 => "None","CastGridCrCo","MeshGoldColour","PreFabricatedGoldColour");
					foreach($option as $key => $value) {
						if($value == $main_value)
							$result[4] = Tooth::ParseIndexToText($key);
					}
					break;
				case "SpecialRequest":
					$num = 0;
					foreach($option_array[$main_key] as $key =>$value) {
						//if($key == "Backing" && $value == 1) $num+=1;
						if($key == "DummyToothMetal" && $value == 1) $num+=2;
						if($key == "StressBroken" && $value == 1) $num+=4;
						if($key == "Boxing" && $value == 1) $num+=8;
					}
					$result[5] = Tooth::ParseIndexToText($num);
					break;
				case "TPExtra":
					$num = 0; $num2 = 0;
					foreach($option_array[$main_key] as $key =>$value) {
						if($key == "Backing" && $value == 1) $num+=1;
						if($key == "WireClasp" && $value == 1) $num+=2;
						if($key == "CastClasp" && $value == 1) $num+=4;
						if($key == "WireRest" && $value == 1) $num+=8;
						if($key == "BonClasp" && $value == 1) $num2+=1;
						if($key == "CastRest" && $value == 1) $num2+=2;
						if($key == "AcetalClasp" && $value == 1) $num2+=4;
						if($key == "WirePlate" && $value == 1) $num2+=8;
					}
					$result[6] = Tooth::ParseIndexToText($num);
					$result[7] = Tooth::ParseIndexToText($num2);
					break;
				case "SpecialTray":
					$option = array("Hole","NoHole");
					foreach($option as $key => $value) {
						if($value == $main_value)
							$result[8] = Tooth::ParseIndexToText($key);
					}
					break;
				case "SpecialTrayBiteBlock":
					$num = 0;
					foreach($option_array[$main_key] as $key =>$value) {
						if($key == "ReliefWax" && $value == 1) $num+=1;
						if($key == "CloseFit" && $value == 1) $num+=2;
						if($key == "BiteBlock" && $value == 1) $num+=4;
						if($key == "BasePlate" && $value == 1) $num+=8;
						if($key == "Remark" && $value == 1) $num+=16;
						if($key == "SpecialTray" && $value == 1) $num+=32;
					}
					$result[9] = Tooth::ParseIndexToText($num,"other");
					break;
				case "Removework":
					$option = array(0 => "None","Try-in frame","Setup teeth","Finish","Bite Block","Repair","Remake","Remake & Finish");
					foreach($option as $key => $value) {
						if($value == $main_value)
							$result[10] = Tooth::ParseIndexToText($key);
					}
					break;
				case "WireStrengthener":
					$result[11] = Tooth::ParseIndexToText($main_value);
					break;
				default: break;
			}
		}
		return $result;
	}
	
	function ParseOptionTextToArray($option_text) {
		//echo $option_text;
		$result = array();
		for($i=0;$i<strlen($option_text);$i++) {
			switch($i) {
				case 0: // RPDAcrylic
					$index = Tooth::ParseTextToIndex($option_text[$i]);
					$option = array(0 => "None","AcrylicPalaPress","AcrylicInvocap","Nylon","HighImpact");
					$result["RPDAcrylic"] = $option[$index];
					break;
				case 1: // TeethSetup
					$index = Tooth::ParseTextToIndex($option_text[$i]);
					$option = array(0 => "None","Square","Triangular","Oval");
					$result["TeethSetup"] = $option[$index];
					break;
				case 2: // GumFit
					$index = Tooth::ParseTextToIndex($option_text[$i]);
					$option = array(0 => "None","Hard","Socket","Soft");
					$result["GumFit"] = $option[$index];
					break;
				case 3: // TPOrderAcrylic
					$index = Tooth::ParseTextToIndex($option_text[$i]);
					$option = array(0 => "None","AcrylicNormal","AcrylicHighImpact","AcrylicIvocap");
					$result["TPOrderAcrylic"] = $option[$index];
					break;
				case 4: // TPOrderGrid
					$index = Tooth::ParseTextToIndex($option_text[$i]);
					$option = array(0 => "None","CastGridCrCo","MeshGoldColour","PreFabricatedGoldColour");
					$result["TPOrderGrid"] = $option[$index];
					break;
				case 5: // SpecialRequest
					$result["SpecialRequest"] = array();
					$num = Tooth::ParseTextToIndex($option_text[$i]);
					//if(($num&1) == 1)  $result["SpecialRequest"]["Backing"] = 1;
					if(($num&2) == 2)  $result["SpecialRequest"]["DummyToothMetal"] = 1;
					if(($num&4) == 4)  $result["SpecialRequest"]["StressBroken"] = 1;
					if(($num&8) == 8)  $result["SpecialRequest"]["Boxing"] = 1;
					break;
				case 6: // SpecialRequest
				case 7:
					$result["TPExtra"] = array();
					if($i == 6) {
					$num = Tooth::ParseTextToIndex($option_text[$i]);
						if(($num&1) == 1)  $result["TPExtra"]["Backing"] = 1;
						if(($num&2) == 2)  $result["TPExtra"]["WireClasp"] = 1;
						if(($num&4) == 4)  $result["TPExtra"]["CastClasp"] = 1;
						if(($num&8) == 8)  $result["TPExtra"]["WireRest"] = 1;
					} elseif($i == 7) {
					$num = Tooth::ParseTextToIndex($option_text[$i]);
						if(($num&1) == 1)  $result["TPExtra"]["BonClasp"] = 1;
						if(($num&2) == 2)  $result["TPExtra"]["CastRest"] = 1;
						if(($num&4) == 4)  $result["TPExtra"]["AcetalClasp"] = 1;
						if(($num&8) == 8)  $result["TPExtra"]["WirePlate"] = 1;
					}
					break;
				case 8: // SpecialTray
					$index = Tooth::ParseTextToIndex($option_text[$i]);
					$option = array("Hole","NoHole");
					$result["SpecialTray"] = $option[$index];
					break;
				case 9: // SpecialTrayBiteBlock
					$result["SpecialTrayBiteBlock"] = array();
					$num = Tooth::ParseTextToIndex($option_text[$i],"other");
					if(($num&1) == 1)  $result["SpecialTrayBiteBlock"]["ReliefWax"] = 1;
					if(($num&2) == 2)  $result["SpecialTrayBiteBlock"]["CloseFit"] = 1;
					if(($num&4) == 4)  $result["SpecialTrayBiteBlock"]["BiteBlock"] = 1;
					if(($num&8) == 8)  $result["SpecialTrayBiteBlock"]["BasePlate"] = 1;
					if(($num&16) == 16)  $result["SpecialTrayBiteBlock"]["Remark"] = 1;
					if(($num&32) == 32)  $result["SpecialTrayBiteBlock"]["SpecialTray"] = 1;
					break;
				case 10: // Removework
					$index = Tooth::ParseTextToIndex($option_text[$i]);
					$option = array(0 => "None","Try-in frame","Setup teeth","Finish","Bite Block","Repair","Remake","Remake & Finish");
					$result["Removework"] = $option[$index];
					break;
				case 11:
					$result["WireStrengthener"] =Tooth::ParseTextToIndex($option_text[$i]);
					break;
				default: break;
			}
		}
		return $result;
	}
	
	function BuildSummaryTeethText($teeth,$type,$method,$upper="",$lower="") {
		$result = "";
		//echo "upper=$uppper<br>";echo "lower=$lower<br>";
		$sm = " ";
		switch($method){
			case "Try-in"				:$sm = "T";break;
			case "Contour"				:$sm = "C";break;
			case "Finish"				:$sm = "F";break;
			case "Repair"				:$sm = "R";break;
			case "Remake"				:$sm = "M";break;
			case "Remake&Finish"		:
			case "Remake & Finish" 		:$sm = "M";break;
			case "Setup"				:$sm = "S";break;
			case "BiteBox"				:$sm = "B";break;
			case "BiteBlock"			:$sm = "B";break;
			default						:$sm = " ";break;
		}
	
		
		
		switch($type) {
			case "fix":
				$fix_material = calculateMaterialPriceEach($teeth->ExportFixTeethMaterialCostArray(),"fix");	
				$fix_teethnumber = $teeth->ExportFixTeethNumberArray();
				$result = "F:\{$sm\}"; $i = 0;
				if(count($fix_material) > 0) {
					$tmp = array();
					foreach($fix_material as $key => $value) {
						$tmp[$i++] = $fix_material[$key]["sname"]."(".$fix_material[$key]["quantity"].$fix_teethnumber[$key].")";
					}
					$result .= implode(",",$tmp);
					$result .= " ";
				}
				break;
			case "remove":
				$result = "R:\{$sm\}"; $i = 0;
				if($upper != "" || $lower != "")	 {
					
					if($upper != "") {
						$result .= "[";
						$result .= ExportRemoveMaterialTypeText($upper);
						$result .= "]";
					}
					if($lower != "") {
						$result .= "[";
						$result .= ExportRemoveMaterialTypeText($lower);	
						$result .= "]";
					}
					//$result .= ";";
				}
				/*$remove_material = calculateMaterialPriceEach($teeth->ExportRemoveTeethMaterialCostArray(),"remove");
				$tmp2 = array();
				foreach($remove_material as $key => $value) {
					$tmp2[$i++] = $remove_material[$key]["sname"]."(".$remove_material[$key]["quantity"].")";
				}
				$result .= implode(",",$tmp2);*/
				break;
			case "ortho":
				$result = "O:\{$sm\}";
				break;
			default: break;
		}
		return $result;
	}
	
	function getParameter($searchstr,$type) {
		//echo "type=".$type;
		$pos = strpos($searchstr,"[".$type.":");
		$length = strlen($type);
		if($pos !== FALSE) {
			$tmp = substr($searchstr,$pos+$length+2);
			//echo "tmp=".$tmp;
			$pos = strpos($tmp,"]");
			$param = substr($tmp,0,$pos);
			//echo "param=".$param;
			return $param;
		}
		return NULL;
	}
?>