<?
	include("../core/teeth.php");
	include("../eorder/eorder_fix_config.php");
	include("../eorder/eorder_remove_config.php");
	include("../eorder/price_config.php");
	
	function calculateOptionPrice($arr,$ordertype) {
		global $option_price;
		$result = 0;
		foreach($arr as $key => $value) {
			for($j=0;$j<count($option_price[$ordertype]);$j++) {
				if($arr[$key] == $option_price[$ordertype][$j]["name"]) {
					if($option_price[$ordertype][$j]["type"] == "all") 
						$result += $option_price[$ordertype][$j]["price"];
					elseif($option_price[$ordertype][$j]["type"] == "tooth")
						$result += $option_price[$ordertype][$j]["price"]*$value;
				}
			}
		}
		return $result;
	}
	
	function calculateRemakePrice($arr) {
		global $remake_price;
		$result = 0;
		foreach($arr as $key => $value) {
			for($j=0;$j<count($remake_price["fix"]);$j++) {
				if($arr[$key] == $remake_price["fix"][$j]["name"]) {
					if($remake_price["fix"][$j]["type"] == "all") 
						$result += $remake_price["fix"][$j]["price"];
					elseif($remake_price["fix"][$j]["type"] == "tooth")
						$result += $remake_price["fix"][$j]["price"]*$value;
				}
			}
		}
		return $result;
	}
	
	function calculateMaterialPriceTotal($arr,$ordertype) {
		global $fixmaterial_price,$removematerial_idvalue,$removematerial_price;
		$result = 0;
		if($ordertype == "fix") {
			foreach($arr as $key => $value) {
				$result += ($fixmaterial_price[$key]*$value);
			}
		} elseif($ordertype  == "remove") {
			foreach($arr as $key => $value) {
				for($i=0;$i<count($removematerial_idvalue);$i++) {
					if($arr[$key] == $removematerial_idvalue[$i]) {
						$result += $removematerial_price[$i]*$value;
					}
				}
			}
		}
		return $result;
	}

	function calculateMaterialQuantityTotal($arr,$ordertype) {
		global $fixmaterial_price,$removematerial_idvalue,$removematerial_price;
		$result = 0;
		if($ordertype == "fix") {
			foreach($arr as $key => $value) {
				$result += $value;
			}
		} elseif($ordertype  == "remove") {
			foreach($arr as $key => $value) {
				$result += $value;
			}
		}
		return $result;
	}
	
	function calculateMaterialPriceEach($arr,$ordertype) {
		global $fixmaterial_price,$removematerial_idvalue,$removematerial_price,$fixmaterial_name,$removematerial_name,$fixmaterial_shortname,$removematerial_shortname;
		$result = array();
		if($ordertype == "fix") {
			foreach($arr as $key => $value) {
				if($key != 0) {
					$result[$key]["name"] = $fixmaterial_name[$key];
					$result[$key]["sname"] = $fixmaterial_shortname[$key];
					$result[$key]["price"] = ($fixmaterial_price[$key]);
					$result[$key]["quantity"] = $value;
					$result[$key]["total"] = ($fixmaterial_price[$key])*$value;
				}
			}
		} elseif($ordertype  == "remove") {
			foreach($arr as $key => $value) {
				if($key != 0) {
					$result[$key]["name"] = $removematerial_name[$key];
					$result[$key]["sname"] = $removematerial_shortname[$key];
					$result[$key]["price"] = ($removematerial_price[$key]);
					$result[$key]["quantity"] = $value;
					$result[$key]["total"] = ($removematerial_price[$key])*$value;
				}
			}
		}
		return $result;
	}
		
	function ParseTeethToCalculate($arr,$arrType) {
		global $fixmaterial_idvalue;
		switch($arrType) {
			case "fix_option":
			case "fix_remake":
			case "remove_option":
				foreach($arr as $key => $value) {
					if($value != 0)
						$result[$key] = $value;
				}
				return $result;
			case "fix_material":
				foreach($arr as $key => $value) {
					if($value != 0)
						$result[$value] = 0;
				}
				foreach($arr as $key => $value) {
					if($value != 0) {
						for($i=0;$i<count($fixmaterial_idvalue);$i++) {
							if($value == $fixmaterial_idvalue[$i]) {
								$result[$value] += 1;
							}
						}
					}
				}
				return $result;
			case "remove_material":
				foreach($arr as $key => $value) {
					if($value != 0) {
						for($i=0;$i<count($removematerial_idvalue);$i++) {
							if($value == $removematerial_idvalue[$i]) {
								$result[$value] += 1;
							}
						}
					}
				}
				return $result;
			default:
				return array();
			}
		}
?>