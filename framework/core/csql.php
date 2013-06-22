<?

	//include_once "../include/config.inc.php"; 
	
	//Conf()->DEBUGSQL = false;
	//Conf()->LOGSQL = false;
	//$LOGSQL = false;
	$SQL_EXECOUNT = 0;
	$SQL_EXEARRAY = array();

	
	class Csql{
		public static $defaultSelectQry = NULL;
		public static $defaultUpdateQry	= NULL;
		public static $defaultQry = NULL;
		public static $DISABLE_PROXY = false;
		
		
		public static $updatedTable = array();
		
		public $hostname 			= NULL;
		public $username 			= NULL;
		public $password 			= NULL;
		public $dbname 			= NULL;
		
		var $Link 			= NULL;
		
		
		var $LastQuery 		= NULL;
		
		
		var $Recordset 	= NULL;
		var $TableName;
		var $IsAddnew	= false;
		var $IsInsertIgnore = false;
		var $BOF 			= true;
		var $EOF 			= true;
		var $FieldName 	= "NULL";
		var $FieldValue 	= "NULL";
		var $EditStr 		= "NULL";
		var $FieldStr = "NULL";
		var $RecordSource; //Store Query
		public $errorlog 			= NULL;

		var $RecordCount=-1;
		var $Cursor=-1;
		var $current_cursor=-1;
		public $enable_record = TRUE;
		function Csql($hostname=NULL,$username=NULL,$password=NULL,$dbname=NULL){
			if($hostname==NULL){
				$hostname = Conf()->AppConf_host;
			}
			$this->hostname = $hostname;

			if($username==NULL){
				$username = Conf()->AppConf_username;
			}
			$this->username = $username;
			
			if($password==NULL){
				$password = Conf()->AppConf_password;
			}
			$this->password = $password;
			
			if($dbname==NULL){
				$dbname = Conf()->AppConf_dbname;
			}
			$this->dbname = $dbname;
						
			
			$this->init();
			//$this->Connect();
		}
		function Clear(){
			unset($this->Recordset);
			unset($this->RecordSource);
		}		
		
		function init(){
			$this->Link 			= NULL;
			$this->Recordset 	= NULL;
			$this->TableName = "";
			$this->IsAddnew	= false;
			$this->InsertIgnore = false;
			$this->BOF 			= true;
			$this->EOF 			= true;
			$this->FieldName 	= "NULL";
			$this->FieldValue 	= "NULL";
			$this->EditStr 		= "NULL";
			$this->FieldStr 		= "NULL";
			$this->RecordSource = ""; 

			$this->RecordCount=-1;
			$this->Cursor=-1;
			$this->current_cursor=-1;

			$this->errorlog = '../../log/csql/csql_'.date('Ymd').'.log';
			if(!file_exists($this->errorlog)) {
				//chmod(prepath().'../log', 0766);
				$file = fopen($this->errorlog,'a+');
				fclose($file);
			}
			//chmod($this->errorlog, 0766);
		}
		
		//Complete
		function Connect(){
			global $DISABLE_MYSQL_PERSISTANT;
			if($DISABLE_MYSQL_PERSISTANT){
				$this->Link = mysql_connect($this->hostname,$this->username,$this->password,true,0);
			}else{
				$this->Link = mysql_pconnect($this->hostname,$this->username,$this->password,false);
			}
			//mysqli_character_set_name(
			//use_unicode=True,charset='utf8'
			if (!($this->Link)){
				echo "Please verify your database login details.";
				error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."][INCORRECT LOGIN DETAILS] >>> [AppConf_host=".$this->hostname.",AppConf_username=".$this->username.",AppConf_host=".$this->password>"]\r\n", 3, $this->errorlog);
				exit();
				return 1;
			}
			
			if (!mysql_ping($this->Link ))
			{
				if($DISABLE_MYSQL_PERSISTANT){
					$this->Link = mysql_connect($this->hostname,$this->username,$this->password,true,0);
				}else{
					$this->Link = mysql_pconnect($this->hostname,$this->username,$this->password,false);
				}
			}
			
			
			mysql_query("SET NAMES 'utf8' COLLATE 'utf8_general_ci';",$this->Link);
			mysql_query("SET lc_time_names = 'th_TH';",$this->Link);
			
			$sql = "USE ".$this->dbname;
			$result = mysql_query($sql,$this->Link);
			
			
			if (!$result){
				echo "Cannot use ".$this->dbname;
				echo("SQL : [$sql] ".mysql_error());
				error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."][UNKNOWN DATABASE] >>> [AppConf_dbname=".$this->dbname."]\r\n", 3, $this->errorlog);
				exit();
				return 2;
			}
			
			if(Conf()->DEBUGSQL || $LOGSQL || Conf()->LOGSQL) {
				$debug = debug_backtrace();
				$source = "\t\t".basename($debug[0]['file'])."(".$debug[0]['line'].") ";
				while($debug[++$i]!=NULL && basename($debug[$i]['file'])!='action.class.php'){
					$source .= basename($debug[$i]['file'])."(".$debug[$i]['line'].") ";
				}
				error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."][CONNECTED] {$source}\r\n", 3, $this->errorlog);
			}
			
			return 0;
		}
		function Disconnect(){
			if($this==self::$defaultSelectQry||$this==self::$defaultUpdateQry){
					if(self::$defaultQry->Link){
							mysql_close(self::$defaultQry->Link);
					}
					self::$defaultQry->init();
					
					if(self::$defaultSelectQry->Link){
							mysql_close(self::$defaultSelectQry->Link);
					}
					self::$defaultSelectQry->init();
			}else{
				if($this->Link){
					mysql_close($this->Link);
				}
				$this->init();
			}
		}
		//Complete
		
		private function GenerateTableAR($sql,&$tableSelect,&$tableUpdate){
			$query_type = NULL;
			if(preg_match("/^[ \r\n\t]*(select|insert|update|delete)/is", $sql,$matches)){
				$query_type = strtolower($matches[1]);
			}
			if($matches==NULL && preg_match("/^show ((master|slave) status|processlist)/is", $sql,$matches)){
				$query_type = 'service';
			}
			if($matches==NULL && preg_match("/^show (tables|columns|index)/is", $sql,$matches)){
				$query_type = 'service';
			}
			
			if($tableSelect==NULL){
				$tableSelect = array();
			}
			if($tableUpdate==NULL){
				$tableUpdate = array();
			}
			
			switch($query_type){
				case 'select':
					if(preg_match_all("/from[ \r\n\t]+(.+?)[ \r\n\t]+(where|group by|having|order by|limit|$)/i", $sql,$matches)){
						for($i=0;$i<count($matches[0]);$i++){
							$tablelist = explode(',',$matches[1][$i]);
							foreach($tablelist as $table){
								$tableTrim = trim($table);
								$singletable = explode(' ',$tableTrim);
								foreach($singletable as $sgTable){
									if(!in_array($sgTable, $tableUpdate)){
										$tableSelect[] = $sgTable;
									}
								}
							}
						}
					}
					if((Conf()->DEBUG || Conf()->UNITTEST) && count($tableSelect)==0){
						Inc_Var::vardump($sql);
						Inc_Var::vardump($matches);
						Inc_Var::vardump($tableSelect);
						exit();
					}
					
					break;
				case 'update':
					if(preg_match_all("/update[ \r\n\t]+(.+?)[ \r\n\t]+(set)/i", $sql,$matches)){
						for($i=0;$i<count($matches[0]);$i++){
							$tablelist = explode(',',$matches[1][$i]);
							foreach($tablelist as $table){
								$tableTrim = trim($table);
								$singletable = explode(' ',$tableTrim);
								foreach($singletable as $sgTable){
									if(!in_array($sgTable, $tableUpdate)){
										$tableUpdate[] = $sgTable;
									}
								}
							}
						}
					}
					if((Conf()->DEBUG || Conf()->UNITTEST) && count($tableUpdate)==0){
						Inc_Var::vardump($sql);
						Inc_Var::vardump($matches);
						exit();
					}
					break;
				case 'insert':
					if(preg_match_all("/insert[ \r\n\t(LOW_PRIORITY|DELAYED|HIGH_PRIORITY|IGNORE)]+(into)?[ \r\n\t]+(.+?)[ \r\n\t]\(?/i", $sql,$matches)){
						for($i=0;$i<count($matches[0]);$i++){
							$tablelist = explode(',',$matches[2][$i]);
							foreach($tablelist as $table){
								$tableTrim = trim($table);
								$singletable = explode(' ',$tableTrim);
								foreach($singletable as $sgTable){
									if(!in_array($sgTable, $tableUpdate)){
										$tableUpdate[] = $sgTable;
									}
								}
							}
						}
					}				

					if((Conf()->DEBUG || Conf()->UNITTEST) && count($tableUpdate)==0){
						Inc_Var::vardump($sql);
						Inc_Var::vardump($matches);
						exit();
					}
					 
					
					break;
				case 'delete':
					if(preg_match_all("/delete.+?from[ \r\n\t]+(.+?)[ \r\n\t]+(where|order by|limit|$)/i", $sql,$matches)){
						for($i=0;$i<count($matches[0]);$i++){
							$tablelist = explode(',',$matches[1][$i]);
							foreach($tablelist as $table){
								$tableTrim = trim($table);
								$singletable = explode(' ',$tableTrim);
								foreach($singletable as $sgTable){
									if(!in_array($sgTable, $tableUpdate)){
										$tableUpdate[] = $sgTable;
									}
								}
							}
						}
					}
					if((Conf()->DEBUG || Conf()->UNITTEST) && count($tableUpdate)==0){
						Inc_Var::vardump($sql);
						Inc_Var::vardump($matches);
						exit();
					}
					break;
				case 'service':
					
					break;
				default:
					if((Conf()->DEBUG || Conf()->UNITTEST)){
						Inc_Var::vardump("Invalid SQL for proxy");
						Inc_Var::vardump($sql);
						Inc_Var::vardump($tableAr);
						exit();
					}
					 
			}
			global $PROXY_TABLE_FORCE_USE_PROXY;
			foreach($tableUpdate as $table){
				if(!in_array($table, self::$updatedTable) && !in_array($table, $PROXY_TABLE_FORCE_USE_PROXY)){
					self::$updatedTable[] = $table;
					self::UpdateTableModifyTime($table);
				}
			}
			
			
			return $query_type;
		}
		
		
		function Execute($sql,$bypass_proxy=false,&$tableSelect=NULL,&$tableUpdate=NULL){
			global $LOGSQL,$SQL_EXECOUNT,$SQL_EXEARRAY,$SQL_EXETIME;	
			if(strlen(trim($sql)) == 0) return;		
					

			
			
			if(!$bypass_proxy && !self::$DISABLE_PROXY){
				$query_type = $this->GenerateTableAR($sql,$tableSelect,$tableUpdate);
				if($this==self::$defaultSelectQry||$this==self::$defaultUpdateQry){
					self::$defaultQry=self::$defaultSelectQry;
					if(self::$defaultSelectQry!=self::$defaultUpdateQry){
						switch($query_type){
							case 'insert':
							case 'update':
							case 'delete':
								if(Conf()->DEBUGSQL) {
									echo "<font color='$color' style=\"font-size:14px\">";
									echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB -----<br>");
								}
								
								self::$defaultQry=self::$defaultUpdateQry;
								return self::$defaultUpdateQry->Execute($sql,true,$tableSelect,$tableUpdate);
								
								break;
							case 'select':
								global $PROXY_DIFF_SEC_IGNORE_PROXY;
								foreach($tableSelect as $table){
									if(in_array($table, self::$updatedTable) || self::CheckTableUpdateDiffSec($table)<$PROXY_DIFF_SEC_IGNORE_PROXY){
										if(Conf()->DEBUGSQL) {
											echo "<font color='$color' style=\"font-size:14px\">";
											echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB[{$table}] -----<br>");
										}
										self::$defaultQry=self::$defaultUpdateQry;
										return self::$defaultUpdateQry->Execute($sql,true,$tableSelect,$tableUpdate);
												
									}
								}
								break;			
							default:
								if(Conf()->DEBUGSQL) {
									echo "<font color='$color' style=\"font-size:14px\">";
									echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB -----<br>");
								}
								
								self::$defaultQry=self::$defaultUpdateQry;
								return self::$defaultUpdateQry->Execute($sql,true,$tableSelect,$tableUpdate);
								
						}
						if(self::$defaultQry!=$this){
							
							return self::$defaultQry->Execute($sql,true,$tableSelect,$tableUpdate);
						}
					}
				}
			}
			
			$txt = trim(substr($sql,0,1));
			switch($txt) {
				case "s": case "S": $color = "darkgreen"; $type="Select"; break;
				case "i": case "I": $color = "darkgoldenrod"; $type="Insert"; break;
				case "u": case "U": $color = "darkblue"; $type="Update"; break;
				case "d": case "D": $color = "maroon"; $type="Delete"; break;
				default: $color = "black"; break;
			}
			$start_timer = microtime(TRUE);
			$this->LastQuery = $sql;
			
			if($this->Link==NULL){
				$this->Connect();
			}
			
			try{
				$result = mysql_query($sql,$this->Link);
			} catch (DbException $e) {
				if (strstr($e->getMessage(), 'MySQL server has gone away')){
					$this->Connect();
					$result = mysql_query($sql,$this->Link);
				} else {
					throw $e;
				}
			}			
			
			
			
			if (!$result) {
				global $file;if($file!=null){fwrite($file, "SQL : [$sql] ".mysql_error()); }
				echo("SQL : [$sql] ".mysql_error());
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."][EXECUTE SQL ERROR] >>> [{$sql}] >>> [".mysql_error()."]\r\n", 3, $this->errorlog);
				exit();
				return 1;
			} else {
				if(Conf()->DEBUGSQL) {
					echo "<font color='$color' style=\"font-size:14px\">";
					echo("<hr size=2 noshade/>----- Execute $type command -----<hr width=50% size=1 noshade/><br>");
					
					echo("SQL : [$sql] <br>");
					echo("Row Affect: ".mysql_affected_rows($this->Link)."<br>");
					echo "<pre>";
					debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
					echo "</pre>";
					echo("<hr size=2 noshade/>");
					echo "</font>";
					Inc_Htmlutil::FlushOB();
				}
				if(Conf()->DEBUGSQL || $LOGSQL || Conf()->LOGSQL || in_array($query_type, array('insert','update','delete'))) {
					if(Conf()->DEBUG){
						$debug = debug_backtrace();
						$source = "\t\t".basename($debug[0]['file'])."(".$debug[0]['line'].") ";
						while($debug[++$i]!=NULL && basename($debug[$i]['file'])!='action.class.php'){
							$source .= basename($debug[$i]['file'])."(".$debug[$i]['line'].") ";
						}
					}
					error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."][".str_pad(round((microtime(TRUE)-$start_timer)*1000),5,' ',STR_PAD_LEFT)."][EXECU SQL] >>> [".str_replace(array("\r\n","\n","\t")," ",trim($sql))."] >>> [".mysql_error($this->Link)."] $source\r\n", 3, $this->errorlog);
				}
			}
			$this->BOF = true;
			$this->EOF = true;
			$this->RecordCount=-1;
			$this->Cursor=-1;
			$this->Recordset = NULL;
			if($this->enable_record){
				$SQL_EXEARRAY[$SQL_EXECOUNT]['SQL'] = $sql;
				$SQL_EXEARRAY[$SQL_EXECOUNT]['HOST'] =  $this->hostname;
				if(is_array($tableSelect)){
					$SQL_EXEARRAY[$SQL_EXECOUNT]['TABLE_S'] = implode("|", $tableSelect);
				}
				if(is_array($tableUpdate)){
					$SQL_EXEARRAY[$SQL_EXECOUNT]['TABLE_U'] = implode("|", $tableUpdate);
				}
				$SQL_EXEARRAY[$SQL_EXECOUNT]['TIME'] = (microtime(TRUE)-$start_timer)*1000;
				$SQL_EXECOUNT++;
			}
			return 0;
		}
		function CheckTableUpdateDiffSec($table){
			if(!self::$DISABLE_PROXY){
				return mktime() - SharedMem::Get(KSHAREDMEM_TABLEUPDATE, $table);
			}
			return false;
		}
		function UpdateTableModifyTime($table){
			if(!self::$DISABLE_PROXY){
				SharedMem::Set(KSHAREDMEM_TABLEUPDATE, $table,mktime());
			}
		}
		
		//Complete
		function Refresh(){
			if($this->RecordSource=="") return;
			$this->Query($this->RecordSource);
			if ($this->current_cursor != -1) { $this->Cursor = $this->current_cursor; }
		}
		
		//Complete
		function Open($tblname){
			$this->Query("Select * From $tblname;");
			$this->TableName = $tblname;
			return 0;
		}
		
		//Complete
		function Query($sql,$bypass_proxy=false,&$tableSelect=NULL,&$tableUpdate=NULL){
			global $LOGSQL,$SQL_EXECOUNT,$SQL_EXEARRAY,$SQL_EXETIME;
			if(strlen(trim($sql)) == 0) return;
			

			if(!$bypass_proxy && !self::$DISABLE_PROXY){
				$query_type = $this->GenerateTableAR($sql,$tableSelect,$tableUpdate);
				if($this==self::$defaultSelectQry||$this==self::$defaultUpdateQry){
					self::$defaultQry=self::$defaultSelectQry;
					if(self::$defaultSelectQry!=self::$defaultUpdateQry){
						$query_type = $this->GenerateTableAR($sql,$tableSelect,$tableUpdate);
						switch($query_type){
							case 'insert':
							case 'update':
							case 'delete':
								if(Conf()->DEBUGSQL) {
									echo "<font color='$color' style=\"font-size:14px\">";
									echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB -----<br>");
								}
								
								self::$defaultQry=self::$defaultUpdateQry;
								return self::$defaultUpdateQry->Query($sql,true,$tableSelect,$tableUpdate);
								
								break;
							case 'select':
								global $PROXY_DIFF_SEC_IGNORE_PROXY;
								foreach($tableSelect as $table){
									if(in_array($table, self::$updatedTable) || self::CheckTableUpdateDiffSec($table)<$PROXY_DIFF_SEC_IGNORE_PROXY){
										if(Conf()->DEBUGSQL) {
											echo "<font color='$color' style=\"font-size:14px\">";
											echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB[{$table}] -----<br>");
										}
										self::$defaultQry=self::$defaultUpdateQry;
										return self::$defaultUpdateQry->Query($sql,true,$tableSelect,$tableUpdate);
												
									}
								}
								break;			
							default:
								if(Conf()->DEBUGSQL) {
									echo "<font color='$color' style=\"font-size:14px\">";
									echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB -----<br>");
								}
								self::$defaultQry=self::$defaultUpdateQry;
								return self::$defaultUpdateQry->Query($sql,true,$tableSelect,$tableUpdate);
								
						}
						
						if(self::$defaultQry!=$this){
							//error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."] SWITCH TO ".self::$defaultQry->hostname."\r\n", 3, $this->errorlog);
							return self::$defaultQry->Query($sql,true,$tableSelect,$tableUpdate);
						}
					}
				}
			}
			
			
			
			if($this->Link==NULL){
				$this->Connect();
			}
			
			$start_timer = microtime(TRUE);
			$this->LastQuery = $sql;
			try{
				$result = mysql_query($sql,$this->Link);
			} catch (DbException $e) {
				  if (strstr($e->getMessage(), 'MySQL server has gone away')){
				  	$this->Connect();
				    $result = mysql_query($sql,$this->Link);
				  } else {
				  	
				 	mail('pppstudio.gm@gmail.com',"Db Error [".$e->getMessage()."]",Inc_Var::varexport($e));
				  	
				    throw $e;
				  }
			}
			
			if (!$result) {
				$errorTxt = mysql_error($this->Link);
				echo("SQL : [$sql] ".$errorTxt);
				echo "<pre>";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				echo "</pre>";
				error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."][QUERY SQL ERROR] >>> [{$sql}] >>> [".mysql_error()."]\r\n", 3, $this->errorlog);
				
				if($errorTxt == 'Access denied; you need the SUPER,REPLICATION CLIENT privilege for this operation'){
					echo "User:{$this->username} Host:User:{$this->hostname}";
				}
				
				exit();
				return 1;
			} else {
				if(Conf()->DEBUGSQL) {
					echo "<font color='darkgreen' style=\"font-size:14px\">";
					echo("<hr size=2 noshade/>----- Query command -----<hr width=50% size=1 noshade/><br>");
					echo("SQL: [$sql]<br>");
					echo("Row count: ".mysql_num_rows($result)."<br>");
					echo "<pre>";
					debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
					echo "</pre>";
					echo("<hr size=2 noshade/>");
					echo "</font>";
					Inc_Htmlutil::FlushOB();
				}
				if(Conf()->DEBUGSQL || $LOGSQL || Conf()->LOGSQL) {
					if(Conf()->DEBUG){
						$debug = debug_backtrace();
						$source = "\t\t".basename($debug[0]['file'])."(".$debug[0]['line'].") ";
						while($debug[++$i]!=NULL && basename($debug[$i]['file'])!='action.class.php'){
							$source .= basename($debug[$i]['file'])."(".$debug[$i]['line'].") ";
						}
					}
					error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."][".str_pad(round((microtime(TRUE)-$start_timer)*1000),5,' ',STR_PAD_LEFT)."][QUERY SQL] >>> [".str_replace(array("\r\n","\n","\t")," ",trim($sql))."] >>> [".mysql_num_rows($result)."][".mysql_error($this->Link)."] $source\r\n", 3, $this->errorlog);
				}
			}
			//$this->TableName = "NULL";
			$this->RecordSource = $sql;
			$this->Recordset = $result;
			$this->RecordCount = mysql_num_rows($this->Recordset);
			if ($this->RecordCount > 0){
				$this->BOF = false;
				$this->EOF = false;
				$this->Cursor = 0;
			}else{
				$this->BOF = true;
				$this->EOF = true;
				$this->Cursor = -1;
			}
			if($this->enable_record){
				$SQL_EXEARRAY[$SQL_EXECOUNT]['SQL'] = $sql;
				$SQL_EXEARRAY[$SQL_EXECOUNT]['HOST'] =  $this->hostname;
				if($tableSelect){
					$SQL_EXEARRAY[$SQL_EXECOUNT]['TABLE_S'] = implode("|", $tableSelect);
				}
				if($tableUpdate){
					$SQL_EXEARRAY[$SQL_EXECOUNT]['TABLE_U'] = implode("|", $tableUpdate);
				}
				$SQL_EXEARRAY[$SQL_EXECOUNT]['TIME'] = (microtime(TRUE)-$start_timer);
				$SQL_EXECOUNT++;
			}
			return 0;
		}
		function DumpArray($primary){
			$retdata = array();
			$numcol = mysql_num_fields($this->Recordset);
			
			for($col=0;$col < $numcol ;$col++){
				$colarray = mysql_fetch_field($this->Recordset,$col);
				//Inc_Var::vardump($colarray);
				$colname = $colarray->name;
				for($row=0;$row < mysql_num_rows($this->Recordset);$row++){
					$id = mysql_result($this->Recordset,$row,$primary);
					$retdata[$id][$colname] = mysql_result($this->Recordset,$row,$colname);
					//echo $retdata[$id][$colname];
				}
			}
			//Inc_Var::vardump($retdata);
			return $retdata;
		}
		function Rs($field){
			
			return mysql_result($this->Recordset,$this->Cursor,$field);
		}

		function CurrentRowArray() {
			$row = mysql_fetch_array($this->Recordset);
			//return $row;
			//unset($row[0]);
			$row2 = array();
			foreach($row as $key => $val){
				if(is_string($key)){
					$row2[$key] = $val;
				}
			}
			return $row2;
		}
				
		function CurrentRow() {
			return mysql_result($this->Recordset,$this->Cursor);
		}
		
		function ParseToArray() {
			return $this->Recordset;
		}
		
		function AddNew(){
			$this->IsAddnew = true;
			$this->FieldName = "NULL";
			$this->FieldValue = "NULL";
		}
		
		function Set($fname,$fval,$ftype = "text"){
			if(is_null($fval)) {
				$fval = "";
			}
			switch($ftype) {
				case "id": 
				case "auto": 
				case "int": 
				case "float": 
				case "double":
				case "num": 
				case "decimal": 
				case "signdecimal":
					$fval = "'".(str_replace(',','',$fval)+0)."'"; 
					break;
				case "array":
				case "set":
					//echo gettype(fval);
					//echo $fval;
					$fval = "'".implode(",",$fval)."'"; 
					break;
				case "txt": 
				case "text": 
				case "varchar": 
				case "longtext":
				case "textdata":
					$fval = "'".$fval."'"; break;
				case "longjson":
				case "json":
					if(is_string($fval)){
						$str = $fval;
					}else{
						$str = json_encode($fval);
					}
					$str = preg_replace("/(\\\\u[0-9a-f][0-9a-f][0-9a-f][0-9a-f])/i", "\\\\$1", $str);
					$fval = "'".$str."'"; break;
				case "bool": $fval = $fval?"TRUE":"FALSE"; break;
				case "pass": $fval = "MD5('".$fval."')"; break;
				case "enum": 
				 $fval = "'".strtoupper($fval)."'"; break;
				case "image": $fval = $fval; break;
				case "date": 
					if($fval=="NOW()"){
						
					}else{
						$fval = "'".($fval)."'"; 
					}
					
					break;
				case "datetime": $fval = "'".$fval."'"; break;
				default: $fval = "NULL"; break;
				
			}
			/*if(is_null($fval)) $fval = "NULL";
			else if(strcmp($fval,"NULL") != 0) {
				if(strstr($fval,"MD5")) $fval = "MD5('".$fval."')";
				else $fval = "'".$fval."'";*/
			//echo "Set ".$this->FieldValue;
			if ($this->IsAddnew){
				if (strcmp($this->FieldName,"NULL") == 0) $this->FieldName = $fname;
				else $this->FieldName .= ",$fname";
				if (strcmp($this->FieldValue,"NULL") == 0) $this->FieldValue = $fval;
				else $this->FieldValue .= ",$fval";
			} else if($this->IsInsertIgnore) {
				if (strcmp($this->FieldStr,"NULL") == 0) $this->FieldStr = "$fname=$fval";
				else $this->FieldStr .= ", $fname=$fval";
			}else{
				if (strcmp($this->EditStr,"NULL") == 0) $this->EditStr = "$fname=$fval";
				else $this->EditStr .= ", $fname=$fval";
			}
			
			//if(Conf()->DEBUG && $this->TableName=='tool_email'){
			//	echo "$this->FieldName<br/>";	
			//	echo "$this->FieldValue<br/>";
			//}
		}
		
		function InsertIgnore($tbname = "NULL") {
			if(strcmp($tbname,"NULL") != 0) $this->TableName = $tbname;
			$this->IsInsertIgnore = true;
			$this->FieldName = "NULL";
			$this->FieldValue = "NULL";
		}
		
		function Update($where=null) {
			/*if(strcmp($this->TableName,"NULL") == 0){
			 echo "Cannot Update Query";
			 return 1;
			}*/
			//Inc_Var::vardump($this);
			if($where==null)
				$where = " Where id=".$this->Rs("id");
				
			$returnval =0;
			if($this->IsAddnew){
				if($this->FieldName=='NULL')return;
				$returnval = $this->Execute("Insert Into ".$this->TableName." (".$this->FieldName.") Values (".$this->FieldValue.");");
				$this->FieldName = "NULL";
				$this->FieldValue = "NULL";
				$this->IsAddnew = false;
			} else if($this->IsInsertIgnore) {
				if($this->FieldStr=='NULL')return;
				$this->current_cursor = $this->Cursor;
				$returnval=$this->Execute("Insert Ignore Into ".$this->TableName." Set ".$this->FieldStr." On Duplicate Key Update ".$this->FieldStr);
				$this->FieldStr="NULL";
				$this->TableName = "";
			} else {
				if($this->EditStr=='NULL')return;
				$tb = $this->TableName;
				$this->current_cursor = $this->Cursor;
				$returnval=$this->Execute("Update ".$this->TableName." Set ".$this->EditStr." {$where};");
				$this->EditStr="NULL";
			}
			//$this->Refresh();
			return $returnval;
		}
		
		function MoveFirst(){
			if ($this->RecordCount > 0) {
				$this->Cursor = 0;
				$this->BOF = false;
				$this->EOF = false;
			}
		}
		
		function MoveLast(){
			if ($this->RecordCount > 0) {
				$this->Cursor = $this->RecordCount - 1;
				$this->BOF = false;
				$this->EOF = false;
			}
		}
		
		function MoveNext(){
			$this->Cursor++;
			if ($this->Cursor > ($this->RecordCount -1)) $this->EOF = true;
			else $this->EOF = false;
		}
		
		function MovePrevious(){
			$this->Cursor--;
			if ($this->Cursor < 0) $this->BOF = true;
			else $this->BOF = false;
		}

		function MoveTo($num){
				if (($num > -1) && ($num < $this->RecordCount)){
						$this->Cursor = $num;
						$this->BOF = false;
						$this->EOF = false;
				}
		}
		function Count(){
			return $this->RecordCount;
		}
		function Close(){
			mysql_close($this->Link);
			$this->init();
		}
		
		function Find($fieldname,$value){
			$this->MoveFirst();
			while ((!$this->EOF) && (strcmp($this->Rs($fieldname),$value) != 0)){
				$this->MoveNext();
			}
		}
		function GetMaxID($table){
			$this->Query("select Max(id) as maxid from $table");
			return $this->Rs("maxid");
		}

		function GetInsertedID(){
			return mysql_insert_id ($this->Link);
		}
		
		
		
		function PassValue($table,$where,$outputfields){
			$this->Query("select *  from $table where $where limit 0,1");
			foreach($outputfields as $f){
				$returnvar[$f] = $this->Rs($f);
				//echo("$f = ".$returnvar[$f]);
			}
			return $returnvar;
		}	

		/*public static function GetCount($table,$where){
			$this->Query("select Count(*) as countall from $table $where");
			return $this->Rs("countall");
		}*/
		function ExecuteScalar($sql,$bypass_proxy=false,&$tableSelect=NULL,&$tableUpdate=NULL){

			if(!$bypass_proxy && !self::$DISABLE_PROXY){
				$query_type = $this->GenerateTableAR($sql,$tableSelect,$tableUpdate);
				if($this==self::$defaultSelectQry||$this==self::$defaultUpdateQry){
					self::$defaultQry=self::$defaultSelectQry;
					if(self::$defaultSelectQry!=self::$defaultUpdateQry){
						switch($query_type){
							case 'insert':
							case 'update':
							case 'delete':
								if(Conf()->DEBUGSQL) {
									echo "<font color='$color' style=\"font-size:14px\">";
									echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB -----<br>");
								}
								
								self::$defaultQry=self::$defaultUpdateQry;
								return self::$defaultUpdateQry->ExecuteScalar($sql,true,$tableSelect,$tableUpdate);
								
								break;
							case 'select':
								global $PROXY_DIFF_SEC_IGNORE_PROXY;
								foreach($tableSelect as $table){
									if(in_array($table, self::$updatedTable) || self::CheckTableUpdateDiffSec($table)<$PROXY_DIFF_SEC_IGNORE_PROXY){
										if(Conf()->DEBUGSQL) {
											echo "<font color='$color' style=\"font-size:14px\">";
											echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB[{$table}] -----<br>");
										}
										self::$defaultQry=self::$defaultUpdateQry;
										return self::$defaultUpdateQry->ExecuteScalar($sql,true,$tableSelect,$tableUpdate);
												
									}
								}
								break;			
							default:
								if(Conf()->DEBUGSQL) {
									echo "<font color='$color' style=\"font-size:14px\">";
									echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB -----<br>");
								}
								self::$defaultQry=self::$defaultUpdateQry;
								return self::$defaultUpdateQry->ExecuteScalar($sql,true,$tableSelect,$tableUpdate);
								
						}
						if(self::$defaultQry!=$this){
							return self::$defaultQry->ExecuteScalar($sql,true,$tableSelect,$tableUpdate);
						}
					}
				}
			}	
			$start_timer = microtime(TRUE);
			$this->Query($sql,true,$tableSelect,$tableUpdate);
			if($this->RecordCount==0)return NULL;
			if(!is_resource($this->Recordset) && Conf()->DEBUG){
				error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."][RESULT SET NULL] >>> [{$sql}] >>> [".Inc_Var::varexport(debug_backtrace())."]\r\n", 3, $this->errorlog);
			}
			
			//if(Conf()->DEBUGSQL || $LOGSQL || Conf()->LOGSQL) {
			//	error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."][".str_pad(round((microtime(TRUE)-$start_timer)*1000),5,' ',STR_PAD_LEFT)."][EXSCL SQL] >>> [".str_replace(array("\r\n","\n","\t")," ",trim($sql))."] \r\n", 3, $this->errorlog);
			//}
			
			return mysql_result($this->Recordset,0,0);
		}
			
		function ExecuteARecord($sql,$bypass_proxy=false,&$tableSelect=NULL,&$tableUpdate=NULL){
			
			
			
			if(!$bypass_proxy && !self::$DISABLE_PROXY){
				$query_type = $this->GenerateTableAR($sql,$tableSelect,$tableUpdate);
				if($this==self::$defaultSelectQry||$this==self::$defaultUpdateQry){
					self::$defaultQry=self::$defaultSelectQry;
					if(self::$defaultSelectQry!=self::$defaultUpdateQry){
						
						switch($query_type){
							case 'insert':
							case 'update':
							case 'delete':
								if(Conf()->DEBUGSQL) {
									echo "<font color='$color' style=\"font-size:14px\">";
									echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB -----<br>");
								}
								
								self::$defaultQry=self::$defaultUpdateQry;
								return self::$defaultUpdateQry->ExecuteARecord($sql,true,$tableSelect,$tableUpdate);
								
								break;
							case 'select':
								global $PROXY_DIFF_SEC_IGNORE_PROXY;
								foreach($tableSelect as $table){
									if(in_array($table, self::$updatedTable) || self::CheckTableUpdateDiffSec($table)<$PROXY_DIFF_SEC_IGNORE_PROXY){
										if(Conf()->DEBUGSQL) {
											echo "<font color='$color' style=\"font-size:14px\">";
											echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB[{$table}] -----<br>");
										}
										self::$defaultQry=self::$defaultUpdateQry;
										return self::$defaultUpdateQry->ExecuteARecord($sql,true,$tableSelect,$tableUpdate);
												
									}
								}
								break;			
							default:
								if(Conf()->DEBUGSQL) {
									echo "<font color='$color' style=\"font-size:14px\">";
									echo("<hr size=2 noshade/>----- SWITCH TO MAIN HOSTDB -----<br>");
								}
								self::$defaultQry=self::$defaultUpdateQry;
								return self::$defaultUpdateQry->ExecuteARecord($sql,true,$tableSelect,$tableUpdate);
								
						}
						if(self::$defaultQry!=$this){
							return self::$defaultQry->ExecuteARecord($sql,true,$tableSelect,$tableUpdate);
						}
					}
				}
			}			
		
			$start_timer = microtime(TRUE);
			
			$this->Query($sql,true,$tableSelect,$tableUpdate);
			if($this->RecordCount==0)return NULL;
			//if(Conf()->DEBUGSQL || $LOGSQL || Conf()->LOGSQL) {
			//	error_log("[".date("Y-m-d H:i:s")."][".$this->hostname."][".$this->dbname."][".str_pad(round((microtime(TRUE)-$start_timer)*1000),5,' ',STR_PAD_LEFT)."][EXARC SQL] >>> [".str_replace(array("\r\n","\n","\t")," ",trim($sql))."] \r\n", 3, $this->errorlog);
			//}
			
			
			return mysql_fetch_array($this->Recordset);
		}	
		
		
		static $_proxy_temperary_disable = false;
		static function proxy_temperary_disable_start(){
			self::$_proxy_temperary_disable = self::$DISABLE_PROXY;
			self::$DISABLE_PROXY = true;
			if($this==self::$defaultSelectQry||$this==self::$defaultUpdateQry){
				self::$defaultQry=self::$defaultUpdateQry;
			}
		}
		static function proxy_temperary_disable_end(){
			self::$DISABLE_PROXY = self::$_proxy_temperary_disable;
		}
		
		
	}




function Qry(){
	if(Csql::$defaultQry==NULL){

		
		if(Conf()->AppConf_proxyhost && !Csql::$DISABLE_PROXY){
			Csql::$defaultSelectQry = new Csql(Conf()->AppConf_proxyhost,Conf()->AppConf_proxyusername,Conf()->AppConf_proxypassword,Conf()->AppConf_proxydbname);
			Csql::$defaultUpdateQry = new Csql(Conf()->AppConf_host,Conf()->AppConf_username,Conf()->AppConf_password,Conf()->AppConf_dbname);
			Csql::$defaultQry =  Csql::$defaultSelectQry;
		}else{
			Csql::$defaultQry = Csql::$defaultSelectQry = Csql::$defaultUpdateQry = new Csql(Conf()->AppConf_host,Conf()->AppConf_username,Conf()->AppConf_password,Conf()->AppConf_dbname);
		}
	}
	return Csql::$defaultQry;
}
	
