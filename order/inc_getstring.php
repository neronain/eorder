<?
function getAlloyName($id){
	switch($id){
		case 1 : return "None";
		case 2 : return "Non precious";
		case 3 : return "Non nickel";
		case 4 : return "Precious - Palladium";
		case 5 : return "Precious - Semi-precious";
		case 6 : return "Precious - White - Gold";
		case 7 : return "Precious - Yellow - Gold";
	}
	return "";
}
function getFixCodeArg($id){
	$id = substr($id,strlen($id)-2,2);

	if($id<15){
		return "ลองโครงครั้งที่ ".($id-0);
	}else if($id<25){
		return "ลอง Bitebox ครั้งที่ ".($id-14);
	}else if($id<50){
		return "ลองฟันครั้งที่ ".($id-24);
	}else if($id==50){
		return "งานจบ";
	}else{
		return " งานแก้ครั้งที่ ".($id-50);
	}
}


?>