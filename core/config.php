<? 
   $AppConf_dbname = "dental";
   //$AppConf_host = "192.168.1.10";
   $AppConf_host = "localhost";
   $AppConf_username = "dentaluser";
   //$AppConf_username = "root";
  	$AppConf_password = "qwerty654321";
    //$AppConf_password = "qwerty";
	
   	//DEN $AppConfodbc_dbname = "[M5CM-PA-01]";
   	//$AppConfodbc_dbname = "[M5CM-AA-11]";
   	
   	$AppConfodbc_dbname = "[M5CM-RE-01]";
   	
   	if($_GET['mac5_db']){
   		$AppConfodbc_dbname = '['.$_GET['mac5_db'].']';
   	}
   	if($_POST['mac5_db']){
   		$AppConfodbc_dbname = '['.$_POST['mac5_db'].']';
   	}
   	
   	
   	//$AppConfodbc_host = "WIN2006\SQLEXPRESS";
   	$AppConfodbc_host = "192.168.0.125";
   	//$AppConfodbc_driver = "{SQL Server}";
   	$AppConfodbc_driver = "Default";
	
   	/*$AppConfodbc_username = "dentaluser";
	$AppConfodbc_password = "1qaZ";*/
   	$AppConfodbc_username = "sa";
	$AppConfodbc_password = "HeXa380";
	
	
	
?>
