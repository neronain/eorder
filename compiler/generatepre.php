<?

$class = $_GET['class'];
$secretkey = $_GET['s'];

chdir("../tmp/chdir");

include_once "../../framework/core/common.inc.php";

if($_SERVER['HTTP_HOST']!='localhost'){
	if(!($secretkey==md5(date('Ymd')."X") || $is_admin)){
		exit("Access denied ");
	}
}

if($_GET['unit']){
	include_once "../../framework/conf/config.unit.php";
}


include_once "../../framework/conf/prerecord_db.php";
echo "<pre>#---------------------------PRE RECORD---------------------------------\n";
foreach($record as $table => $tmp1){
	foreach($tmp1 as $id => $data){
		if($data==-1){
			$dataAR = Qry()->ExecuteARecord("select * from $table where id=$id");
			echo "\$record['$table'][$id] = array(";
			foreach($dataAR as $col => $val){
				if(is_numeric($col))continue;
				if($val=='')continue;
				if($val=='0')continue;
				echo "'$col'=>'$val',";
			}
			echo ");\n";
		}
	}
}
echo "\n\n</pre>\n";


