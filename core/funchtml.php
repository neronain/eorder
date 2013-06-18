<?

	function VarDump($var)
	{
		echo "<br><pre>";
		var_dump($var);
		echo "</pre><br>";
	}

	function Redirect($url,$timer=5) {
		echo "<meta http-equiv='refresh' content='$timer;url=$url'>";
	}

	function passThaiMonth($month){
		//$txtmonth = array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน"
		//,"พฤษภาคม","มิถุนายน","กรกฎาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
		$txtmonth = array("January","February","March","April"
		,"May","June","July","August","September","October","November","December ");
		return $txtmonth[$month-1];
	}
	function passThaiYear($year){
		return $year+543;
	}
	function buildComboBoxList($name,$table,$idfield,$valuefields,$selected,$onchange){
		$data = new Csql();
		$err =	$data->Connect();
		$data->Query("select * from $table");
		echo "<select name=\"$name\" id=\"$name\" onchange=\"$onchange\">";
		while(!$data->EOF){
			$id = $data->Rs($idfield);
			$value = "";
			foreach($valuefields as $f){
				$value .= $data->Rs($f)." ";
			}
			echo "<option value=\"$id\" ";
			if(isset($selected) && $id==$selected)echo " selected";
			echo ">$value</option>";
			$data->MoveNext();
		}
		echo '</select>';
	}
	function buildDateSelector($name,$day,$month,$year){
		$txt = "<select name={$name}_day id={$name}_day>";
		for($i=1;$i<=31;$i++){
			$txt.="<option ";
			if($day==$i)$txt .=" selected ";
			$txt.=">$i</option>";
		}
		$txt.="</select>";
		$txt .= "<select name={$name}_month id={$name}_month>";
		
		for($i=1;$i<=12;$i++){
			$txt.="<option value=$i ";
			if($month==$i)$txt .=" selected ";
			$txt.=">".passThaiMonth($i)."</option>";
		}
		$txt.="</select>";
		$txt .= "<select name={$name}_year id={$name}_year>";
		$today = getdate();
		//print_r($today);
		
		for($i=$today["year"]-3;$i<$today["year"]+2;$i++){
			$txt .="<option value=$i ";
			if($year==$i)$txt .=" selected ";
			$txt.=">".passThaiYear($i)."</option>";
		}
		$txt .="</select>";
		echo $txt;
	}
	function buildTimeSelector($name,$hour,$minute){
		$txt = "<select name={$name}_hour id={$name}_hour>";
		for($i=0;$i<=23;$i++){
			$tmp = "$i";
			if($i<10)$tmp = "0$i";		
			$txt.="<option value=$tmp ";
			if($hour==$i)$txt .=" selected ";
			$txt.=">$tmp</option>";
		}
		$txt.="</select>";
		$txt .= "<select name={$name}_minute id={$name}_minute>";
		$isMatchMin = false;
		for($i=0;$i<=59;$i+=15){
			$tmp = "$i";
			if($i<10)$tmp = "0$i";
			$txt.="<option value=$tmp ";
			if($minute==$i){$txt .=" selected ";$isMatchMin=true;}
			$txt.=">$tmp</option>";
		}
		if(!$isMatchMin){
			$tmp = $minute;
			if($minute<10)$tmp = "0$minute";
			$txt.="<option value=$tmp selected>$tmp</option>";
		}
		
		$txt.="</select>";

		echo $txt;
	}

	
	/*
	function buildComboBoxListLimit($name,$table,$idfield,$valuefields,$selected,$limit){
		$data = new Csql();
		$err =	$data->Connect();
		$data->Query("select * from $table");
		echo "<select name=\"$name\">";
		while(!$data->EOF){
			$id = $data->Rs($idfield);
			$value = "";
			foreach($valuefields as $f){
				$value .= $data->Rs($f)." ";
			}
			if(strlen($value)>$limit){$value = substr($value,0,$limit); }
			echo "<option value=\"$id\" ";
			if(isset($selected) && $id==$selected)echo " selected";
			echo ">$value</option>";
			$data->MoveNext();
		}
		echo '</select>';
	}	//*/
function selfURL() {
	$s = empty($_SERVER["HTTPS"]) ? ''
		: ($_SERVER["HTTPS"] == "on") ? "s"
		: "";
	$protocol = strleft(strtolower($_SERVER["SERVER_PROTOCOL"]), "/").$s;
	$port = ($_SERVER["SERVER_PORT"] == "80") ? ""
		: (":".$_SERVER["SERVER_PORT"]);
	return $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];
}
function strleft($s1, $s2) {
	return substr($s1, 0, strpos($s1, $s2));
}
?>