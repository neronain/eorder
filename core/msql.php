<?php
	//include_once("../core/osql.php");
	
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
			global	$AppConfodbc_username;
			global	$AppConfodbc_password;
			global	$AppConfodbc_dbname;
			$this->Link = mssql_connect($AppConfodbc_host,$AppConfodbc_username,$AppConfodbc_password);
			//mssqli_character_set_name(
			//use_unicode=True,charset='utf8'
			if (!($this->Link)){
				echo "กรุณาตรวจสอบชื่อโฮสต์ ชื่อผู้่ใช้ และรหัสผ่าน ว่าถูกต้องหรือไม่";
				return 1;
			}
			mssql_select_db($AppConfodbc_dbname,$this->Link);

			
			//mssql_query("SET NAMES 'utf8'");
			
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
			
			$result = mssql_query($sql);
			if (!$result) {
				echo "<font color='red'>";
				echo "----------------------------------------------------  Command Error ----------------------------------------------<br>";
				echo("SQL : [$sql] <br>");
				echo("ERROR : ".mssql_error()." <br>");
				echo("------------------------------------------------------------------------------------------------------------------------<br>");
				echo "</font>";
				return 1;
			} else {
				if($DEBUGSQL) {
					echo "<font color='$color'>";
					echo("---------------------------------------------------- Execute $type command  ----------------------------------------------<br>");
					echo("SQL : [$sql] <br>");
					echo("Row Affect: ".mssql_affected_rows()."<br>");
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
			
			$sql = utf8_to_tis620($sql);
			
			$result = mssql_query($sql);
			
			if (!$result) {
				echo "<font color='red'>";
				echo "---------------------------------------------------- Query Command Error ----------------------------------------------<br>";
				echo("SQL : [$sql] <br>");
				echo("ERROR : ".mssql_error()." <br>");
				echo("------------------------------------------------------------------------------------------------------------------------<br>");
				echo "</font>";
				return 1;
			} else {
				if($DEBUGSQL) {
					echo "<font color='darkgreen'>";
					echo("------------------------------------------------------ Query command --------------------------------------------<br>");
					echo("SQL: [$sql]<br>");
					echo("Row count: ".mssql_num_rows($result)."<br>");
					echo("------------------------------------------------------------------------------------------------------------------------<br>");
					echo "</font>";
				}
			}
			//$this->TableName = "NULL";
			$this->RecordSource = $sql;
			$this->Recordset = $result;
			$this->RecordCount = mssql_num_rows($this->Recordset);
			if ($this->RecordCount > 0){
				$this->BOF = false;
				$this->EOF = false;
				$this->Cursor = 0;
			}else{
				$this->BOF = true;
				$this->EOF = true;
				$this->Cursor = -1;
			}
			return 0;
		}
		
		function Rs($field){
			return mssql_result($this->Recordset,$this->Cursor,$field);
		}
		
		function AddNew(){
			$this->IsAddnew = true;
			$this->FieldName = "NULL";
			$this->FieldValue = "NULL";
			//$this->Set($this->TableName."ID","''");
		}
		
		function Set($fname,$fval){
			/*if($fval==0){
				$fval = "0";
			}*/
			if ($this->IsAddnew){
				if (strcmp($this->FieldName,"NULL") == 0) 
					$this->FieldName = $fname;
				else 
					$this->FieldName .= ",$fname";
					
				if (strcmp($this->FieldValue,"NULL") == 0) 
					$this->FieldValue = $fval;
				else 
					$this->FieldValue .= ",$fval";
			}else{
				if (strcmp($this->EditStr,"NULL") == 0) $this->EditStr = "$fname=$fval";
				else $this->EditStr .= ", $fname=$fval";
			}
			
		}
		
		function Update($addwhere=""){


			$returnval =0;
			if($this->IsAddnew){
				$returnval = $this->Execute("Insert Into ".$this->TableName." (".$this->FieldName.") Values (".$this->FieldValue.");");
				$this->FieldName = "NULL";
				$this->FieldValue = "NULL";
				$this->IsAddnew = false;
			}else{
				$tb = $this->TableName;
				$this->current_cursor = $this->Cursor;
				$returnval=$this->Execute("Update ".$this->TableName." Set ".$this->EditStr."  $addwhere;");
				$this->EditStr="NULL";
			}
			$this->Refresh();
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
			mssql_close($this->Link);
			$this->init();
		}
		
		function Find($fieldname,$value){
			$this->MoveFirst();
			while ((!$this->EOF) && (strcmp($this->Rs($fieldname),$value) != 0)){
				$this->MoveNext();
			}
		}
		function GetMaxID($table){
			$this->Query("select Max(".$table."id) as maxid from $table");
			return $this->Rs("maxid");
		}
		function PassValue($table,$where,$outputfields){
			$this->Query("select *  from $table where $where limit 0,1");
			foreach($outputfields as $f){
				$returnvar[$f] = $this->Rs($f);
				//echo("$f = ".$returnvar[$f]);
			}
			return $returnvar;
		}		
		function ExecuteScalar($sql){
			//global $DEBUGSQL;	
			$this->Query($sql);
			if($this->RecordCount==0)return NULL;
			return mssql_result($this->Recordset,0,0);
		}		
	} //*/

?>
