<?php
	$DEBUGSQL = false;
	class Msql{
		var $Link 			= NULL;
		var $Recordset 	= NULL;
		var $TableName;
		var $IsAddnew	= false;
		var $BOF 			= true;
		var $EOF 			= true;
		var $FieldName 	= "NULL";
		var $FieldValue 	= "NULL";
		var $EditStr 		= "NULL";
		var $RecordSource; //Store Query

		var $RecordCount=-1;
		var $Cursor=-1;
		var $current_cursor=-1;
		
		function init(){
			$this->Link 			= NULL;
			$this->Recordset 	= NULL;
			$this->TableName = "";
			$this->IsAddnew	= false;
			$this->BOF 			= true;
			$this->EOF 			= true;
			$this->FieldName 	= "NULL";
			$this->FieldValue 	= "NULL";
			$this->EditStr 		= "NULL";
			$this->RecordSource = ""; 

			$this->RecordCount=-1;
			$this->Cursor=-1;
			$this->current_cursor=-1;
		}
		//Complete
		function Connect(){
			global	$AppConfodbc_host;
			global	$AppConfodbc_driver;
			global	$AppConfodbc_username;
			global	$AppConfodbc_password;
			global	$AppConfodbc_dbname;
			
			//$dsn = "Driver={SQL Server};Server={$AppConfodbc_host};Database={$AppConfodbc_dbname};";
			$dsn = "Driver={SQL Server};Server=WIN2006\SQLEXPRESS;Database=M5CM-EH-01;";
			//$dsn = "Driver={SQL Server};Server={$AppConfodbc_host};Database={$AppConfodbc_dbname};";
			//$dsn = utf8_to_tis620("$AppConfodbc_driver");
			
			$this->Link = odbc_connect($dsn,'dentaluser','1qaZ');
			//odbci_character_set_name(
			//use_unicode=True,charset='utf8'
			if (!($this->Link)){
				echo "กรุณาตรวจสอบชื่อโฮสต์ ชื่อผู้่ใช้ และรหัสผ่าน ว่าถูกต้องหรือไม่";
				echo $AppConfodbc_host." ".$AppConfodbc_driver;
				
				return 1;
			}
			//$sql = "USE ".$AppConf_dbname;
			//$result = odbc_exec($this->Link,$sql);
			
			//odbc_exec($this->Link,"SET NAMES 'utf8'");
			
			//if (!$result){
			//	echo "Can not use $dbname";
			//	return 2;
			//}
			return 0;
		}
		
		//Complete
		function Execute($sql){
			global $DEBUGSQL;	
			if(strlen(trim($sql)) == 0) return;		
					
			$sql = str_replace("select","SELECT ",$sql);
			$sql = str_replace("insert ","INSERT ",$sql);
			$sql = str_replace("into ","INTO ",$sql);
			$sql = str_replace("values ","VALUES ",$sql);
			$sql = str_replace("update ","UPDATE ",$sql);
			$sql = str_replace("delete ","DELETE ",$sql);
			$sql = str_replace(" from "," FROM ",$sql);
			$sql = str_replace(" set "," SET ",$sql);
			$sql = str_replace(" where "," WHERE ",$sql);
			$sql = str_replace(" isnull"," ISNULL",$sql);
			$sql = str_replace(" not"," NOT",$sql);
			$sql = str_replace(" and "," AND ",$sql);
			$sql = str_replace(" or "," OR ",$sql);
			$sql = str_replace(" as "," AS ",$sql);
						
			$txt = trim(substr($sql,0,1));
			switch($txt) {
				case "s": case "S": $color = "darkgreen"; $type="Select"; break;
				case "i": case "I": $color = "darkgoldenrod"; $type="Insert"; break;
				case "u": case "U": $color = "darkblue"; $type="Update"; break;
				case "d": case "D": $color = "maroon"; $type="Delete"; break;
				default: $color = "black"; break;
			}
			
			$result = odbc_exec($this->Link,$sql);
			if (!$result) {
				echo "<font color='red'>";
				echo "----------------------------------------------------  Command Error ----------------------------------------------<br>";
				echo("SQL : [$sql] <br>");
				echo("------------------------------------------------------------------------------------------------------------------------<br>");
				echo "</font>";
				return 1;
			} else {
				if($DEBUGSQL) {
					echo "<font color='$color'>";
					echo("---------------------------------------------------- Execute $type command  ----------------------------------------------<br>");
					echo("SQL : [$sql] <br>");
					echo("Row Affect: ".odbc_affected_rows()."<br>");
					echo("------------------------------------------------------------------------------------------------------------------------<br>");
					echo "</font>";
				}
			}
			$this->BOF = true;
			$this->EOF = true;
			$this->RecordCount=-1;
			$this->Cursor=-1;
			$this->Recordset = NULL;
			return 0;
		}
		
		//Complete
		function Refresh(){
			if($this->RecordSource=="")return;
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
		function Query($sql){
			global $DEBUGSQL;
			if(strlen(trim($sql)) == 0) return;

			$sql = str_replace("select","SELECT ",$sql);
			$sql = str_replace(" from "," FROM ",$sql);
			$sql = str_replace(" where "," WHERE ",$sql);
			$sql = str_replace(" left "," LEFT ",$sql);
			$sql = str_replace(" right "," RIGHT ",$sql);
			$sql = str_replace(" join "," JOIN ",$sql);
			$sql = str_replace(" inner "," INNER ",$sql);
			$sql = str_replace(" on "," ON ",$sql);
			$sql = str_replace(" order "," ORDER ",$sql);
			$sql = str_replace(" group "," GROUP ",$sql);
			$sql = str_replace(" by "," BY ",$sql);
			$sql = str_replace(" distinct "," DISTINCT ",$sql);
			$sql = str_replace(" isnull"," ISNULL",$sql);
			$sql = str_replace(" not"," NOT",$sql);
			$sql = str_replace(" and "," AND ",$sql);
			$sql = str_replace(" or "," OR ",$sql);
			$sql = str_replace(" as "," AS ",$sql);
			$sql = str_replace("limit ","LIMIT ",$sql);
			
			$result = odbc;
		}
		

}