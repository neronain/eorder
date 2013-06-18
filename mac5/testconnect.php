<?
	include_once("../core/default.php");
	$con = mssql_connect("192.168.0.133","sa","HeXa380");
	mssql_select_db("[M5CM-EH-01]",$con);
	$rs = mssql_query("select TOP 10 DEBcode from DEB");
	while (($row=mssql_fetch_array($rs))!=null) {
		 var_dump($row);
	}

/*

	include_once("../core/default.php");




	$m5m = new Msql();
	$m5m->Connect();
	
	$m5m->Query("select TOP 10 * from MIH");
	while(!$m5m->EOF) {
		echo "+";
		echo $m5m->Rs('MIHvatSUM')."<br>";
		
		$m5m->MoveNext();
	}*/
/*$dsn = "Driver={SQL Server};Server=WIN2006\SQLEXPRESS;Database=M5CM-EH-01;";
$con = odbc_connect($dsn,'dentaluser','1qaZ');
$rs = odbc_exec($con,"select TOP 10 * from MIH");
while (($row=odbc_fetch_array($rs))!=null){
	var_dump($row);
  //$MIHdoc=odbc_result($rs,"MIHdoc");
  //echo "$MIHdoc <br>";
}
odbc_close($con);


exit();	

         include('../resource/adodb/adodb.inc.php');

         //$db = ADONewConnection('mssql'); # eg 'mysql' or 'postgres'

         //$db->debug = true;
		 
         $db =& ADONewConnection('odbc_mssql');
		$db->debug = true;
         $dsn = "Driver={SQL Server};Server=WIN2006\SQLEXPRESS;Database=M5CM-EH-01;";

         $db->Connect($dsn,'dentaluser','1qaZ'); 
		echo "D1";
		$recordSet = &$db->Execute('select * from MIH');
		echo "D2";
		if (!$recordSet) 
		
				 echo "Error".$db->ErrorMsg();
		
		else
		
		while (!$recordSet->EOF) {
		
				 echo $recordSet->fields[0].' '.$recordSet->fields[1].'<BR>';
		
				 $recordSet->MoveNext();
		
		}
		
		 
		
		$recordSet->Close(); # optional
		
		$db->Close(); # optional


//*/
	
	
?>