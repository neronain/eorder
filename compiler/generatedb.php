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

/*Qry()->Execute("
SHOW [FULL] COLUMNS {FROM | IN} tbl_name [{FROM | IN} db_name]
    [LIKE 'pattern' | WHERE expr]
	";*/

if($class=="" || $class=="ALL"){
	$path = "../../app_hexa/_model";
	$dir_handle = @opendir($path) or die("Unable to open $path");
	$countf = 0;
	while ($file = readdir($dir_handle)) 
	{
		if(substr($file,0,3)!='md_')continue;
		$class = explode(".",$file);
		if($class[count($class)-1]!="php")continue;

		if(substr($file,strlen($file)-8,8)=='_ext.php')continue;
		if($class[0]=='md_tool_link')continue;
		
		//echo substr($file,strlen($file)-5,4);
		$classarray[] = $class[0];
	}	
	$onlychange = true;
}else{
	$classarray[] = $class;
	$onlychange = false;

}
$missing_tables = array();

$change = "";
foreach($classarray as $class){
	
	include_once "../../app_hexa/_model/".$class.".php";
	
	$obj = new $class;
	
	$table = $obj->GetPrimaryTable();
	$data = "
	DROP TABLE IF EXISTS `{$table}`;
	CREATE TABLE `{$table}` ( 
					" ;
	$dbkey;
	
	$result  = array();
	$indexkey = array();
	$uniquekey = array();
	$fulltextkey = array();
	//Qry()->Connect();
	
	Qry()->Query("SHOW TABLES LIKE '{$table}'");
	if(!Qry()->EOF){
		Qry()->Query("SHOW COLUMNS FROM `{$table}`	");
		$i = 0;
		while(!Qry()->EOF){
			$result[Qry()->Rs('Field')]['Field'] = Qry()->Rs('Field');
			$result[Qry()->Rs('Field')]['Type'] = Qry()->Rs('Type');
			$result[Qry()->Rs('Field')]['Null'] = Qry()->Rs('Null');
			$result[Qry()->Rs('Field')]['Key'] = Qry()->Rs('Key');
			$result[Qry()->Rs('Field')]['Default'] = Qry()->Rs('Default');
			$result[Qry()->Rs('Field')]['Extra'] = Qry()->Rs('Extra');
			$result[Qry()->Rs('Field')]['Exist'] = FALSE;
			!Qry()->MoveNext();
			$i++;
		}
		
		Qry()->Query("SHOW INDEX FROM `{$table}`	");
		$i = 0;
		$ischange_key = array();
		//Table 	Non_unique 	Key_name 	Seq_in_index 	Column_name 	Collation 	Cardinality 	Sub_part 	Packed 	Null 	Index_type
		while(!Qry()->EOF){
			
			$resultRs = Qry()->CurrentRowArray();
			
			if($resultRs['Key_name']!='PRIMARY'){
				if($resultRs['Non_unique']+0>0){
					if($resultRs['Index_type']=='FULLTEXT'){
						$fulltextkey[$resultRs['Key_name']][] = $resultRs['Column_name'];
					}else{
						$indexkey[] = $resultRs['Column_name'];
					}
				}else{
					$uniquekey[$resultRs['Key_name']][] = $resultRs['Column_name'];
				}	
			}else{
				$primary = 	$resultRs;
				/*array(12) {
				  ["Table"]=>
				  string(10) "crrelation"
				  ["Non_unique"]=>
				  string(1) "0"
				  ["Key_name"]=>
				  string(4) "type"
				  ["Seq_in_index"]=>
				  string(1) "1"
				  ["Column_name"]=>
				  string(4) "type"
				  ["Collation"]=>
				  string(1) "A"
				  ["Cardinality"]=>
				  NULL
				  ["Sub_part"]=>
				  NULL
				  ["Packed"]=>
				  NULL
				  ["Null"]=>
				  string(0) ""
				  ["Index_type"]=>
				  string(5) "BTREE"
				  ["Comment"]=>
				  string(0) ""
				}*/
				
			}
			Qry()->MoveNext();
			$i++;
		}		
		
		
		$create = FALSE;
	}else{
		$create = TRUE;
		$missing_tables[] = $table;
	}
	//echo "<pre>";
	//var_dump($result);
	//var_dump($primary);
	//echo "</pre>";
	
	//$keyarray = $class::$UNIQUEARRAY;
	$UNIQUEARRAY = $obj->UNIQUEARRAY();
	$INDEXARRAY = $obj->INDEXARRAY();
	$FULLTEXTARRAY = $obj->FULLTEXTARRAY();
	foreach($UNIQUEARRAY as $key => $tmp){
		if($uniquekey[$key]==NULL)continue;
		if(count($uniquekey[$key])!=count($UNIQUEARRAY[$key])){
			$ischange_key[$key] = TRUE;
		}else{
			foreach($uniquekey[$key] as $col){
				if(!in_array($col,$UNIQUEARRAY[$key])){
					$ischange_key[$key] = TRUE;
				}
			}
		}
		if(in_array($key,$indexkey)){
			$ischange_key[$key] = TRUE;
		}	
	}

	
	foreach($uniquekey as $key => $raw){
		if($UNIQUEARRAY[$key]==NULL){
			$ischange_key[$key] = TRUE;
		}elseif(!in_array($key,$UNIQUEARRAY[$key])){
			$ischange_key[$key] = TRUE;
		}
	}	
	
	
	foreach($FULLTEXTARRAY as $key => $tmp){
		if($fulltextkey[$key]==NULL)continue;
		if(count($fulltextkey[$key])!=count($FULLTEXTARRAY[$key])){
			$ischange_key[$key] = TRUE;
		}else{
			foreach($fulltextkey[$key] as $col){
				if(!in_array($col,$FULLTEXTARRAY[$key])){
					$ischange_key[$key] = TRUE;
				}
			}
		}
		if(in_array($key,$indexkey)){
			$ischange_key[$key] = TRUE;
		}	
	}
	foreach($fulltextkey as $key => $raw){
		if($FULLTEXTARRAY[$key]==NULL){
			$ischange_key[$key] = TRUE;
		}elseif(!in_array($key,$FULLTEXTARRAY[$key])){
			$ischange_key[$key] = TRUE;
		}
	}		
	
	
	foreach($INDEXARRAY as $key ){
		if($uniquekey[$key]!=NULL){
			$ischange_key[$key] = TRUE;
		}		
	}
	foreach($indexkey as $key){
		if(!in_array($key,$INDEXARRAY)){
			$ischange_key[$key] = TRUE;
		}elseif(!in_array($key,$INDEXARRAY)){
			$ischange_key[$key] = TRUE;
			
		}
	}		
	
	/* Revert Key
	$dbkey .='#---------------------------------------------------------------	'.$class.'------------';
	$dbkey .='
	static function UNIQUEARRAY(){return array (';
			foreach($uniquekey as $key => $raw){
				$dbkey .='
		"'.$key.'"=> array("'.implode('","',$raw).'"),'."\n";
			}			
	$dbkey .='
	);';

	$dbkey .='
	}
	static function INDEXARRAY(){return array ("'.implode('","',$indexkey).'");
		
		
		
		';
	
	*/

	/*if($table=='pushbutton'){
		echo "<pre> {$table}";
		var_dump($result['id']);
		var_dump($primary);
		echo "</pre>";
	}*/

	if(!$create){
		if($primary==NULL){// ||  $result['id']["Key"] != "PRI"){
			$dbkey .="ALTER TABLE `{$table}` ADD PRIMARY KEY (id);\n";
			$dbkey .="ALTER TABLE `{$table}` CHANGE `id` `id` int(10) unsigned NOT NULL auto_increment;\n";
		}else{
			if($result[$table.'id']["Key"]!="PRI"){
				$dbkey .="ALTER TABLE `{$table}` ADD PRIMARY KEY (id);\n";
			}
			if($result[$table.'id']["Extra"]!="auto_increment"){
				
				$dbkey .="ALTER TABLE `{$table}` CHANGE `id` `id` int(10) unsigned NOT NULL auto_increment;\n";
				
				//echo "<pre> {$table}";
				//var_dump($result['id']);
				//var_dump($primary);
				//echo "</pre>";
			}
			//var_dump($result['id']);
			
				
			
			//$primary[] = 	Qry()->CurrentRowArray();
					/*array(12) {
					  ["Table"]=>
					  string(10) "crrelation"
					  ["Non_unique"]=>
					  string(1) "0"
					  ["Key_name"]=>
					  string(4) "type"
					  ["Seq_in_index"]=>
					  string(1) "1"
					  ["Column_name"]=>
					  string(4) "type"
					  ["Collation"]=>
					  string(1) "A"
					  ["Cardinality"]=>
					  NULL
					  ["Sub_part"]=>
					  NULL
					  ["Packed"]=>
					  NULL
					  ["Null"]=>
					  string(0) ""
					  ["Index_type"]=>
					  string(5) "BTREE"
					  ["Comment"]=>
					  string(0) ""
					}*/
		}
	}
	
	if($ischange_key)
	foreach($ischange_key as $key => $raw){
		$dbkey .="ALTER TABLE `{$table}` DROP INDEX `{$key}`;\n";
	}	
	
	foreach($UNIQUEARRAY as $key => $tmp){
		if($uniquekey[$key]!=NULL && !$ischange_key[$key])continue;
		$dbkey .="ALTER TABLE `{$table}` ADD UNIQUE (`".implode("`,`",$tmp)."`);\n";
			
	}
	foreach($INDEXARRAY as $key ){
		if(in_array($key,$indexkey) && !$ischange_key[$key])continue;
		$dbkey .="ALTER TABLE `{$table}` ADD INDEX (`".$key."`);\n";
	}	
	
	foreach($FULLTEXTARRAY as $key => $tmp){
		if($fulltextkey[$key]!=NULL && !$ischange_key[$key])continue;
		$dbkey .="ALTER TABLE `{$table}` ADD FULLTEXT (`".implode("`,`",$tmp)."`);\n";
			
	}
	
	
/*	
ALTER TABLE `ticket` ADD FULLTEXT (
`subject` ,
`detail` ,
`cache_customername`
);*/	
	
	
	
	//Inc_Var::vardump($indexkey);
	
	$columns = $obj->GetColumnArrayFull();
	$lastcol = "";
	
	
	
	foreach($columns as $column=> $type){
		if($column=="id"){
			$data .= "`id` int(10) unsigned NOT NULL auto_increment,
					";
		}else{
			$optionindex = strpos($type,'|');
			if($optionindex>0){
				$option = substr($type,$optionindex+1);
				$type = substr($type,0,$optionindex);
				$optionarray = explode(",",$option);
			}
			

			$iralter ="";	
			$irchange ="";	
			switch($type){
				case "id":
				case "auto":
					$data .= "`id` int(10) unsigned NOT NULL auto_increment,
					";
					break;
				case "num":
					echo($column." # ".$class." => Error type num please change to int <br>");
					break;
				case "int":
					$data .= "`{$column}` int(10) unsigned NOT NULL default '0',
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` int(10) unsigned NOT NULL default '0';\n";
					if($result[$column]!=NULL && $result[$column]['Type'] != "int(10) unsigned" && $result[$column]['Type'] != "int(11) unsigned" && $result[$column]['Type'] != "int(10)" && $result[$column]['Type'] != "int(11)"){
						
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` int(10) unsigned NOT NULL default '0';#".$result[$column]['Type']."\n";
					}
					
					
					break;			
				case "float":
					$data .= "`{$column}` float NOT NULL default '0',
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` float NOT NULL default '0';\n";
					if($result[$column]!=NULL && $result[$column]['Type'] != "float"){
						
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` float NOT NULL default '0';#".$result[$column]['Type']."\n";
					}
					
					
					break;
				case "double":
					$data .= "`{$column}` double NOT NULL default '0',
									";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` double NOT NULL default '0';\n";
					if($result[$column]!=NULL && $result[$column]['Type'] != "double"){
				
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` double NOT NULL default '0';#".$result[$column]['Type']."\n";
					}
						
						
					break;
							
				case "decimal":
					$data .= "`{$column}` decimal(12,2) unsigned NOT NULL default '0',
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` decimal(12,2) unsigned NOT NULL default '0';\n";

					if($result[$column]!=NULL && $result[$column]['Type'] != "decimal(12,2) unsigned"){
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` decimal(12,2) unsigned NOT NULL default '0';#".$result[$column]['Type']."\n";
					}

					break;			
				case "signdecimal":
					$data .= "`{$column}` decimal(12,2) NOT NULL default '0',
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` decimal(12,2) NOT NULL default '0';\n";

					if($result[$column]!=NULL && $result[$column]['Type'] != "decimal(12,2)"){
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` decimal(12,2) NOT NULL default '0';#".$result[$column]['Type']."\n";
					}

					break;
				case "varchar":
					$data .= "`{$column}` varchar(250) default NULL ,
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` varchar(250) default NULL;\n";

					if($result[$column]!=NULL && $result[$column]['Type'] != "varchar(250)" && $result[$column]['Type'] != "varchar(255)"){
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` varchar(250) default NULL;#".$result[$column]['Type']."\n";
					}

					break;			
				case "array":
				case "text":
				case "textdata":
				case "json":
					$data .= "`{$column}` text default NULL ,
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` text default NULL;\n";
					if($result[$column]!=NULL && $result[$column]['Type'] != "text"){
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` text default NULL;#".$result[$column]['Type']."\n";
					}
					break;			
				case "longjson":
				case "longtext":
					$data .= "`{$column}` longtext default NULL ,
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` longtext default NULL;\n";
					if($result[$column]!=NULL && $result[$column]['Type'] != "longtext"){
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` longtext default NULL;#".$result[$column]['Type']."\n";
					}
					break;			
				case "date":
					$data .= "`{$column}` date default NULL ,
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` date default NULL;\n";
					if($result[$column]!=NULL && $result[$column]['Type'] != "date"){
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` date default NULL;#".$result[$column]['Type']."\n";
					}
					break;			
				case "datetime":
					$data .= "`{$column}` datetime default NULL ,
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` datetime default NULL;\n";
					if($result[$column]!=NULL && $result[$column]['Type'] != "datetime"){
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` datetime default NULL;#".$result[$column]['Type']."\n";
					}
					break;			
				case "enum":
					$data .= "`{$column}` enum('".implode("','",$optionarray)."') NOT NULL DEFAULT '".$optionarray[0]."',
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` enum('".implode("','",$optionarray)."') NOT NULL DEFAULT '".$optionarray[0]."';\n";
					
					if($result[$column]!=NULL){
						if($result[$column]['Type'] != "enum('".implode("','",$optionarray)."')"
							|| $result[$column]['Default'] != $optionarray[0]
						){
							$irchange = 
							"ALTER TABLE `$table` CHANGE `{$column}` `{$column}` enum('".implode("','",$optionarray)."') NOT NULL DEFAULT '".$optionarray[0]."';#".$result[$column]['Type']."\n";
							
						}
					}
					
					break;
				case "set":
					$data .= "`{$column}` set('".implode("','",$optionarray)."') NOT NULL DEFAULT '',
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` set('".implode("','",$optionarray)."') NOT NULL DEFAULT '';\n";
					if($result[$column]!=NULL && $result[$column]['Type'] != "set('".implode("','",$optionarray)."')"){
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` set('".implode("','",$optionarray)."') NOT NULL DEFAULT '';#".$result[$column]['Type']."\n";
					}
					
					break;
				case "bool":
					$data .= "`{$column}` tinyint(1)  NOT NULL default '0',
					";
					$iralter = "ALTER TABLE `$table` ADD `{$column}` tinyint(1)  NOT NULL default '0';\n";
					if($result[$column]!=NULL && $result[$column]['Type'] != "tinyint(1)" && $result[$column]['Type'] != "tinyint(1) unsigned"){
						$irchange = "ALTER TABLE `$table` CHANGE `{$column}` `{$column}` tinyint(1)  NOT NULL default '0';#".$result[$column]['Type']."\n";
					}
					
					break;	
					
				case "cus":
				case "CUS":
				case "ref":
				case "REF":
					$result[$column]['Exist'] |= TRUE;
					break;
				default:
					echo "Invalid type {$type}";
				
			}

			

			
			if($create){
				//$change .= $iralter;
			}else{	
				if($result[$column]==NULL){
					$irchange .= $iralter;
				}else{
					$result[$column]['Exist'] |= TRUE;
				}
				//echo $irchange;
				$change .= $irchange;
			}
			$alter .= $iralter;
			
		}
	
	}

	
	foreach($result as $column => $row){
		if(!$result[$column]['Exist'] && $column!='id'){
			$drop .= "ALTER TABLE `{$table}` DROP `".$column."` ;\n";
		}
	
	}
	
	$data .= "PRIMARY KEY  (`id`) 
	";
	
	$data .= ") ENGINE=MyISAM  DEFAULT CHARSET=utf8; \n";

	if($create){
		$change .= $data;
	}
}

if($is_admin) {
	if(!$onlychange) {
		$sql['data'] = $data;
		$sql['alter'] = $alter;
	}
	$sql['change'] = $change;
	$sql['dbkey'] = $dbkey;
	
	$sql_result = "";
	foreach($sql as $key=>$value) {
		$sql_result .= "#------------------------------------------------ ".strtoupper($key)." ------------------------------------------------\n".$value."\n";
	}
	//$sql_result = implode("\n",$sql);
} else {
	if(!$onlychange){
		echo "<pre>#---------------------------CREATE---------------------------------\n";
		echo $data;
		echo "</pre>";
		
		echo "<pre>#---------------------------ALTER---------------------------------\n";
		echo $alter;
		echo $drop;
		echo "</pre>";
	}
	echo "<pre>#---------------------------CHANGE-----------------------------\n";
	echo $change;
	echo "<pre>#---------------------------DROP-----------------------------\n";
	echo $drop;
	echo "<pre>#---------------------------KEY-----------------------------\n";
	echo $dbkey;
	echo "</pre>";
}






