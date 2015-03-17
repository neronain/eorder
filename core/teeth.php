<?php
	include_once("../eorder/eorder_configproductcode.php");
	abstract class Tooth {
		static $NUMTOOTH = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p');
		static $NUMBRIDGE = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','a','b','c','d','e','f','g','h','i','j','k','l','m','n');
		static $ASCIICODE = array('A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','0','1','2','3','4','5','6','7','8','9','#','?');
		var $m_number = 18;
		function Tooth($num) 
		{ 
			$this->m_number = $num;
		}
		abstract function BuildText();
		abstract function BuildTooth($arg);
		
		function ParseAsciiToInteger($ascii) {
			for($i=0;$i<count(Tooth::$ASCIICODE);$i++)
			{
				if($ascii==Tooth::$ASCIICODE[$i]){
					return $i;
				}
			}
		}
		
		function ParseIntegerToAscii($num) {
			return Tooth::$ASCIICODE[$num];
		}
		
		function ParseNumberToIndex($num,$type='tooth')
		{
			if($type == 'tooth') {
				if($num<20)
					return 18-$num;
				if($num<30)
					return 8+$num-21;
				if($num<40)
					return 38-$num+16;
				return 24+$num-41;
			} else {
				if($num<20)
					return 17-$num;
				if($num<30)
					return 7+$num-21;
				if($num<40)
					return 37-$num+14;
				return 21+$num-41;
			}
		}
		
		function ParseIndexToNumber($index,$type='tooth')
		{
			if($type == 'tooth') {
				if($index<8)
					return 18-$index;
				if($index<16)
					return $index+21-8;
				if($index<24)
					return 38-$index+16;
				return $index+41-24;
			} else {
				if($index<7)
					return 17-$index;
				if($index<14)
					return $index+21-7;
				if($index<21)
					return 37-$index+14;
				return $index+41-21;
			}
		}
				
		function ParseTextToNumber($text,$type='tooth')
		{
			$index = Tooth::ParseTextToIndex($text,$type);
			return Tooth::ParseIndextoNumber($index,$type);
		}
		
		function ParseNumberToText($num,$type='tooth')
		{
			$index = Tooth::ParseNumberToIndex($num,$type);
			return Tooth::ParseIndexToText($index,$type);
		}		
		
		function ParseIndexToText($index,$type='tooth')
		{
			if($type == 'tooth') {
				return Tooth::$NUMTOOTH[$index];
			} else {
				return Tooth::$ASCIICODE[$index];
			}
		}
		
		function ParseTextToIndex($text,$type='tooth')
		{
			if($type == 'tooth') {
				for($i=0;$i<count(Tooth::$NUMTOOTH);$i++)
				{
					if($text==Tooth::$NUMTOOTH[$i]){
						return $i;
					}
				}			
			} else {
				for($i=0;$i<count(Tooth::$ASCIICODE);$i++)
				{
					if($text==Tooth::$ASCIICODE[$i]){
						return $i;
					}
				}			
			}
		}		
	}
	
	class FixTooth extends Tooth {
		var $m_material = 0;
		var $m_attachment = 0;
		var $m_stepbar = 0;
		var $m_porcelain = 0;
		var $m_opt_mat = 0;
		
		function FixTooth($num) {
			parent::Tooth($num);
			$this->m_material = 0;
			$this->m_attachment = 0;
			$this->m_stepbar = 0;
			$this->m_porcelain = 0;
			$this->m_opt_mat = 0;
		}
		
		function ShowMember() {
			echo "m_number=".$this->m_number.",";
			echo "m_material=".$this->m_material.",";
			echo "m_attachment=".$this->m_attachment.",";
			echo "m_stepbar=".$this->m_stepbar.",";
			echo "m_porcelain=".$this->m_porcelain.",";
			echo "m_opt_mat=".$this->m_opt_mat;
		}
		
		function BuildText() {
			for($i=0;$i<4;$i++) {
				$str[$i] = $this->ParseMemberToAscii($i);
			}
			return implode("",$str);
		}
		
		function BuildTooth($arg) {
			$this->BuildMemberFromText('m_number',$arg[0]);
			$this->BuildMemberFromText('m_material',$arg[1]);
			$this->BuildMemberFromText('m_attachment',$arg[2]);
			$this->BuildMemberFromText('m_stepbar',$arg[2]);
			$this->BuildMemberFromText('m_porcelain',$arg[2]);
			$this->BuildMemberFromText('m_opt_mat',$arg[2]);
		}
				
		protected function ParseMemberToAscii($num) {
			switch($num) {
				case 0:	 
					return parent::ParseNumberToText($this->m_number,'tooth');
				case 1:	
					return parent::ParseIntegerToAscii($this->m_material);
				case 2:				
					//return  parent::ParseIntegerToAscii(($this->m_attachment<<0)+($this->m_stepbar<<1)+($this->m_porcelain<<2)+($this->m_opt_mat<<3));
					return  parent::ParseIntegerToAscii(($this->m_attachment<<0)+($this->m_opt_mat<<1));
				case 3: 
					return 'A';
				default: 
					return  parent::ParseIntegerToAscii(62);
			}
		}
		
		protected function BuildMemberFromText($name,$value) {
			switch($name) {
				case 'm_number':	$this->m_number = parent::ParseTextToNumber($value,'tooth'); break;
				case 'm_material':	$this->m_material = parent::ParseAsciiToInteger($value); break;
				case 'm_attachment':	$this->m_attachment = ((parent::ParseAsciiToInteger($value))>>0)&1; break;
				//case 'm_stepbar':	$this->m_stepbar = ((parent::ParseAsciiToInteger($value))>>1)&1; break;
				//case 'm_porcelain':	$this->m_porcelain = ((parent::ParseAsciiToInteger($value))>>2)&1; break;
				//case 'm_opt_mat': $this->m_opt_mat = ((parent::ParseAsciiToInteger($value))>>3)&3; break;
				case 'm_opt_mat': $this->m_opt_mat = ((parent::ParseAsciiToInteger($value))>>1)&127; break;
				default: break;
			}
		}
		
		protected function BuildMemberFromNumber($name,$value) {
			switch($name) {
				case 'm_number':	$this->m_number= $value; break;
				case 'm_material':	$this->m_material=$value; break;
				case 'm_attachment':	$this->m_attachment= $value; break;
				case 'm_stepbar':	$this->m_stepbar= $value; break;
				case 'm_porcelain':	$this->m_porcelain= $value; break;
				case 'm_opt_mat':	$this->m_opt_mat= $value; break;
				default: break;
			}
		}
		
		function BuildVariable($material,$attachment,$stepbar,$porcelain,$opt_mat)
		{
			//$this->BuildMemberFromNumber('m_number',$num);
			$this->BuildMemberFromNumber('m_material',$material);
			$this->BuildMemberFromNumber('m_attachment',$attachment);
			$this->BuildMemberFromNumber('m_stepbar',$stepbar);
			$this->BuildMemberFromNumber('m_porcelain',$porcelain);
			$this->BuildMemberFromNumber('m_opt_mat',$opt_mat);
		}
	}
	
	class RemoveTooth extends Tooth {
		var $m_material = 0;
		var $m_attachment = 0;
		var $m_opt_mat = 0;

		function RemoveTooth($num) {
			parent::Tooth($num);
			$this->m_material = 0;
			$this->m_attachment = 0;
			$this->m_opt_mat = 0;
		}
		
		function ShowMember() {
			echo "m_number=".$this->m_number.",";
			echo "m_material=".$this->m_material;
			echo "m_attachment=".$this->m_attachment.",";
			echo "m_opt_mat=".$this->m_opt_mat;
		}
		
		function BuildText() {
			for($i=0;$i<4;$i++) {
				$str[$i] = $this->ParseMemberToAscii($i);
			}
			return implode("",$str);
		}
		
		function BuildTooth($arg) {
			$this->BuildMemberFromText('m_number',$arg[0]);
			$this->BuildMemberFromText('m_material',$arg[1]);
			$this->BuildMemberFromText('m_attachment',$arg[2]);
			$this->BuildMemberFromText('m_opt_mat',$arg[2]);
		}
				
		protected function ParseMemberToAscii($num) {
			switch($num) {
				case 0:	 
					return parent::ParseNumberToText($this->m_number,'tooth');
				case 1:	
					return parent::ParseIntegerToAscii($this->m_material);
				case 2:		
					return  parent::ParseIntegerToAscii(($this->m_attachment<<0)+($this->m_opt_mat<<1));
				case 3: 
					return 'A';
				default: 
					return  parent::ParseIntegerToAscii(62);
			}
		}
		
		protected function BuildMemberFromText($name,$value) {
			switch($name) {
				case 'm_number':	$this->m_number= parent::ParseTextToNumber($value,'tooth'); break;
				case 'm_material':	$this->m_material= parent::ParseAsciiToInteger($value); break;
				case 'm_attachment':	$this->m_attachment= ((parent::ParseAsciiToInteger($value))>>0)&1; break;
				case 'm_opt_mat': $this->m_opt_mat = ((parent::ParseAsciiToInteger($value))>>1)&1; break;
				default: break;
			}
		}
		
		protected function BuildMemberFromNumber($name,$value) {
			switch($name) {
				case 'm_number':	$this->m_number= $value; break;
				case 'm_material':	$this->m_material=$value; break;
				case 'm_attachment':	$this->m_attachment= $value; break;
				case 'm_opt_mat':	$this->m_opt_mat= $value; break;
				default: break;
			}
		}
		
		function BuildVariable($material,$attachment,$opt_mat)
		{
			//$this->BuildMemberFromNumber('m_number',$num);
			$this->BuildMemberFromNumber('m_material',$material);
			$this->BuildMemberFromNumber('m_attachment',$attachment);
			$this->BuildMemberFromNumber('m_opt_mat',$opt_mat);
		}
	}
	
	class Teeth {
		var $fix_tooth = array();
		var $remove_tooth = array();
		var $bridge = array();
		var $bridge_name = array();
				
		function Teeth() {
			for($i=0;$i<32;$i++) {
				$this->fix_tooth[$i] = new FixTooth(Tooth::ParseIndexToNumber($i,'tooth'));
				$this->remove_tooth[$i] = new RemoveTooth(Tooth::ParseIndexToNumber($i,'tooth'));
			}
			for($j=0;$j<30;$j++) {
				$this->bridge[$j] = 0;
				$num = Tooth::ParseIndexToNumber($j,'tooth');
				if($j < 7)
					$this->bridge_name[($num)."-".($num-1)] = 0;
				elseif($j == 7)
					$this->bridge_name[($num)."-".($num+10)] = 0;
				elseif($j < 15)
					$this->bridge_name[($num)."-".($num+1)] = 0;
				elseif($j == 15)
					$this->bridge_name[($num)."-".($num+10)] = 0;
				elseif($j < 23)
					$this->bridge_name[($num)."-".($num-1)] = 0;
				elseif($j == 23)
					$this->bridge_name[($num)."-".($num+10)] = 0;
				else
					$this->bridge_name[($num)."-".($num+1)] = 0;
			}
		}
		
		function ExportBridgeText() {
			$i = 0;
			foreach($this->bridge_name as $key => $value) {
				if($value == 1) {
					$bridgeArray[$i++] = $key;
				}
			}
			$bridge_str = ((count($bridgeArray) > 0)) ? implode("] [",$bridgeArray) : "-";
			for($i=11;$i<=48;$i++){
				$bridge_str=str_replace($i.'] ['.$i,$i,$bridge_str);
			}
			return "Bridge: [".$bridge_str."]";
		}
		
		function ExportFixTeethAttachmentText() {
			for($i=0;$i<32;$i++) {
				if($this->fix_tooth[$i]->m_attachment == 1) {
					$attachArray[$j++] = Tooth::ParseIndexToNumber($i,'tooth');
				}
			}
			$attach_str = ((count($attachArray) > 0)) ? implode(",",$attachArray) : "-";
			return "Attach: ".$attach_str;
		}
		
		function ExportRemoveTeethAttachmentText() {
			for($i=0;$i<32;$i++) {
				if($this->remove_tooth[$i]->m_attachment == 1) {
					$attachArray[$j++] = Tooth::ParseIndexToNumber($i,'tooth');
				}
			}
			$attach_str = ((count($attachArray) > 0)) ? implode(",",$attachArray) : "-";
			return "Attach: ".$attach_str;
		}
		
		function ExportFixTeethMaterialText() {
			for($i=0;$i<32;$i++) {
				$result[Tooth::ParseIndexToNumber($i,'tooth')] = $this->fix_tooth[$i]->m_material;
			}
			return $result;
		}
		
		function ExportRemoveTeethMaterialText() {
			for($i=0;$i<32;$i++) {
				$result[$i] = $this->remove_tooth[$i]->m_material;
			}
			return $result;
		}
		
		function ShowMember($showfix,$showremove) {
			for($i=0;$i<32;$i++) {
				if($showfix) {
					echo "<br>fix_tooth[$i]<br>";
					$this->fix_tooth[$i]->ShowMember();
				}
				if($showremove) {
					echo "<br>remove_tooth[$i]<br>";
					$this->remove_tooth[$i]->ShowMember();
				}
			}
		}
				
		function BuildRemoveTeethText() {
			$result = "";
			for($i=0;$i<32;$i++) {
				$str[$i] = $this->remove_tooth[$i]->BuildText();
				$br[$i] = ($this->bridge[$i] == 1) ? '-' : ',';
				if(substr($str[$i],1) != "AAA") {
					$result .= $str[$i];
					if($i == 31) break;
					$result .= $br[$i];
				}
			}
			$result = str_replace("-,",",",$result);
			$result = str_replace(",-",",",$result);
			$result = str_replace(",,",",",$result);
			if($result[0] == ",")
				$result = substr($result,1);
			if($result[strlen($result)-1] == ",")
				$result = substr($result,0,strlen($result)-1);
			return $result;
		}
		
		function BuildFixTeethText() {
			$result = "";
			for($i=0;$i<32;$i++) {
				$str[$i] = $this->fix_tooth[$i]->BuildText();
				$br[$i] = ($this->bridge[$i] == 1) ? '-' : ',';
				if(substr($str[$i],1) != "AAA") {
					$result .= $str[$i];
					if($i == 31) break;
					$result .= $br[$i];
				}
			}
			$result = str_replace("-,",",",$result);
			$result = str_replace(",-",",",$result);
			$result = str_replace(",,",",",$result);
			if($result[0] == ",")
				$result = substr($result,1);
			if($result[strlen($result)-1] == ",")
				$result = substr($result,0,strlen($result)-1);
			return $result;
		}
		
		function BuildRemoveTeethVariable($materialArray,$attachmentArray,$option1Array,$bridgeArray)
		{
			for($i=0;$i<32;$i++) {
				$num = $this->remove_tooth[$i]->m_number;
				$this->remove_tooth[$i]->BuildVariable
				($materialArray[$num],$attachmentArray[$num],$option1Array[$num]);
			}
			for($j=0;$j<30;$j++) {
				if($j != 15)
					$this->bridge[$j] = $bridgeArray[$j];
				else
					$this->bridge[$j] = 0;
			}
		}
		
		function BuildRemoveTeethFromText($arg) {
			$str=$arg;	$i = 0; $j = 0;$index = 0;
			while(strlen($str)>0) {
				$comma = (strpos($str, ',') != "") ? strpos($str, ',') : 999;
				$dash = (strpos($str, '-') != "") ? strpos($str, '-') : 999;
				$index = ($comma > $dash) ? $dash : $comma;
				$notbridge = ($comma > $dash) ? false : true;
				$head = substr($str,0,$index);
				$tail = substr($str,$index+1);
				$this->remove_tooth[Tooth::ParseTextToIndex($str[$head])]->BuildTooth($head);
				$j = Tooth::ParseTextToIndex($str[$head]);
				if($notbridge) {
					$this->bridge[$j] = 0;
				} else {
					$this->bridge[$j] = 1;
					$num = Tooth::ParseIndexToNumber($j,'tooth');
					if($j < 7 || ($j >15 && $j < 23))
						$this->bridge_name[($num)."-".($num-1)] = 1;
					elseif($j == 7 || $j == 15 || $j == 23)
						$this->bridge_name[($num)."-".($num+10)] = 1;
					elseif(($j < 15) || $j >23)
						$this->bridge_name[($num)."-".($num+1)] = 1;
					$j++;
				}
				$str =$tail; $i++;
			}		
		}
		
		function ExportRemoveTeethMaterialArray() {
			for($i=0;$i<32;$i++) {
				$array[Tooth::ParseIndexToNumber($i,'tooth')] = $this->remove_tooth[$i]->m_material;
			}
			return $array;
		}
		
		function ExportRemoveTeethMaterialCostArray() {
			for($i=0;$i<32;$i++) {
				$tmp = $this->remove_tooth[$i]->m_material;
				$array[$tmp] +=1;
			}
			return $array;
		}
		function ExportFixTeethMaterialCostArray() {
			for($i=0;$i<32;$i++) {
				$tmp = $this->fix_tooth[$i]->m_material;
				$array[$tmp] +=1;
			}
			return $array;
		}
		function ExportFixTeethNumberArray() {
			for($i=0;$i<32;$i++) {
				$tmp = $this->fix_tooth[$i]->m_material;
				$array[$tmp] .="#".Tooth::ParseIndexToNumber($i)."";
			}
			return $array;
		}		

		function ExportRemoveTeethAttachmentArray() {
			for($i=0;$i<32;$i++) {
				$array[Tooth::ParseIndexToNumber($i,'tooth')] = $this->remove_tooth[$i]->m_attachment;
			}
			return $array;
		}

		function BuildFixTeethVariable($materialArray,$attachmentArray,$stepbarArray,$porcelainArray,$option1Array,$bridgeArray)
		{
			for($i=0;$i<32;$i++) {
				$num = $this->fix_tooth[$i]->m_number;
				$this->fix_tooth[$i]->BuildVariable
				($materialArray[$num],$attachmentArray[$num],$stepbarArray[$num],$porcelainArray[$num],$option1Array[$num]);
			}
			for($j=0;$j<=30;$j++) {
				if($j != 15)
					$this->bridge[$j] = $bridgeArray[$j];
				else
					$this->bridge[$j] = 0;
			}
		}
		
		function BuildFixTeethFromText($arg) {
			$str=$arg;	$i = 0; $j = 0;$index = 0;
			while(strlen($str)>0) {
				$comma = (strpos($str, ',') != "") ? strpos($str, ',') : 999;
				$dash = (strpos($str, '-') != "") ? strpos($str, '-') : 999;
				$index = ($comma > $dash) ? $dash : $comma;
				$notbridge = ($comma > $dash) ? false : true;
				$head = substr($str,0,$index);
				$tail = substr($str,$index+1);
				
				//var_dump($index);
				//var_dump($str);
				//var_dump($head);
				
				$this->fix_tooth[Tooth::ParseTextToIndex($head[0])]->BuildTooth($head);
				$j = Tooth::ParseTextToIndex($head[0]);
				if($notbridge) {
					$this->bridge[$j] = 0;
				} else {
					$this->bridge[$j] = 1;
					$num = Tooth::ParseIndexToNumber($j,'tooth');
					if($j < 7 || ($j >15 && $j < 23))
						$this->bridge_name[($num)."-".($num-1)] = 1;
					elseif($j == 7 || $j == 15 || $j == 23)
						$this->bridge_name[($num)."-".($num+10)] = 1;
					elseif(($j < 15) || $j >23)
						$this->bridge_name[($num)."-".($num+1)] = 1;
					$j++;
				}
				$str =$tail; $i++;
			}
		}
		
		function ExportFixTeethOptionMaterialArray() {
			for($i=0;$i<32;$i++) {
				$array[Tooth::ParseIndexToNumber($i,'tooth')] = $this->fix_tooth[$i]->m_opt_mat;
			}
			return $array;
		}
		
		function ExportRemoveTeethOptionMaterialArray() {
			for($i=0;$i<32;$i++) {
				$array[Tooth::ParseIndexToNumber($i,'tooth')] = $this->remove_tooth[$i]->m_opt_mat;
			}
			return $array;
		}
						
		function ExportFixTeethMaterialArray() {
			for($i=0;$i<32;$i++) {
				$array[Tooth::ParseIndexToNumber($i,'tooth')] = $this->fix_tooth[$i]->m_material;
			}
			return $array;
		}
		
		function ExportFixTeethAttachmentArray() {
			for($i=0;$i<32;$i++) {
				$array[Tooth::ParseIndexToNumber($i,'tooth')] = $this->fix_tooth[$i]->m_attachment;
			}
			return $array;
		}
		
		function ExportFixTeethStepBarArray() {
			for($i=0;$i<32;$i++) {
				$array[Tooth::ParseIndexToNumber($i,'tooth')] = $this->fix_tooth[$i]->m_stepbar;
			}
			return $array;
		}
		
		function ExportFixTeethPorcelainArray() {
			for($i=0;$i<32;$i++) {
				$array[Tooth::ParseIndexToNumber($i,'tooth')] = $this->fix_tooth[$i]->m_porcelain;
			}
			return $array;
		}
		
		function ExportBridgeArray() {
			for($i=0;$i<=30;$i++) {
				$array[$i] = $this->bridge[$i];
			}
			return $array;
		}
		
		function ShowBridge() {
			foreach($this->bridge_name as $key => $value) {
				echo $key." = ".$value."<br>";
			}
		}
		function ExportToProductCODE() {
			
		}
	}
?>