<?

//Conf()->SessionSync_link = mysql_pconnect(Conf()->SessionSync_host ,Conf()->SessionSync_username,Conf()->SessionSync_password,false);
//mysql_select_db(Conf()->SessionSync_dbname,Conf()->SessionSync_link);

function session_connect_db() {
	//error_log("session_connect_db");
	Conf()->SessionSync_link = mysql_pconnect(Conf()->SessionSync_host ,Conf()->SessionSync_username,Conf()->SessionSync_password,false);
	if (!mysql_ping(Conf()->SessionSync_link ))
	{
		Conf()->SessionSync_link  = mysql_pconnect(Conf()->SessionSync_host ,Conf()->SessionSync_username,Conf()->SessionSync_password,false);
	}
	
	
	mysql_select_db(Conf()->SessionSync_dbname,Conf()->SessionSync_link);
}

function on_session_start($save_path, $session_name) {
	//error_log("on_session_start");
	$key = session_id();
	//error_log($session_name . " ". $key);
	$table = Conf()->SessionSync_table;
	$insert_stmt  = "INSERT into {$table}(session_id,session_expiration) values('$key',date_add(now(), interval 2 hour)) on duplicate key update session_expiration = date_add(now(), interval 2 hour)";

	if(Conf()->SessionSync_link==null || Conf()->SessionSync_link==false){
		session_connect_db();
	}
	
	
	mysql_select_db(Conf()->SessionSync_dbname,Conf()->SessionSync_link);
	mysql_query($insert_stmt,Conf()->SessionSync_link);
	mysql_select_db(Conf()->AppConf_dbname ,Conf()->SessionSync_link);
}

function on_session_end() {
	//error_log("on_session_end");
	// Nothing needs to be done in this function
	// since we used persistent connection.
	
}

function on_session_read($key) {
	//error_log("on_session_read");
	//error_log($key);

	if(Conf()->SessionSync_link==null || Conf()->SessionSync_link==false){
		session_connect_db();
	}
	
	$table = Conf()->SessionSync_table;
	$stmt = "select session_data from {$table} ";
	$stmt .= "where session_id ='$key' ";
	$stmt .= "and session_expiration > now()";

	
	mysql_select_db(Conf()->SessionSync_dbname,Conf()->SessionSync_link);
	$sth = mysql_query($stmt,Conf()->SessionSync_link);
	mysql_select_db(Conf()->AppConf_dbname ,Conf()->SessionSync_link);
	
	$err = mysql_error(Conf()->SessionSync_link);
	if ($err != '')error_log($err);
	
	if($sth)
	{
		$row = mysql_fetch_array($sth);
		return($row['session_data']);
	}
	else
	{
		return serialize(array());
	}
}
function on_session_write($key, $val) { //return;
	//error_log("on_session_write");
	
	//error_log("$key = $value");
	$val = addslashes($val);
	
	$table = Conf()->SessionSync_table;
	$insert_stmt  = "REPLACE into {$table} values('$key', ";
	$insert_stmt .= "'$val', date_add(now(), interval 2 hour))";

	
	if(Conf()->SessionSync_link==null || Conf()->SessionSync_link==false){
		session_connect_db();
	}

	mysql_select_db(Conf()->SessionSync_dbname,Conf()->SessionSync_link);
	mysql_query($insert_stmt,Conf()->SessionSync_link);
	mysql_select_db(Conf()->AppConf_dbname ,Conf()->SessionSync_link);
	
	
	$err = mysql_error(Conf()->SessionSync_link);
	if ($err != '')
	{
		error_log($err);
	}
}

function on_session_destroy($key) {
	//error_log("on_session_destroy");
	
	if(Conf()->SessionSync_link==null || Conf()->SessionSync_link==false){
		session_connect_db();
	}
	
	$table = Conf()->SessionSync_table;
	mysql_select_db(Conf()->SessionSync_dbname,Conf()->SessionSync_link);
	mysql_query("delete from $table where session_id = '$key'",Conf()->SessionSync_link);
	mysql_select_db(Conf()->AppConf_dbname ,Conf()->SessionSync_link);
}

function on_session_gc($max_lifetime) 
{
	if(Conf()->SessionSync_link==null || Conf()->SessionSync_link==false){
		session_connect_db();
	}	
	$table = Conf()->SessionSync_table;
	mysql_select_db(Conf()->SessionSync_dbname,Conf()->SessionSync_link);
	mysql_query("delete from $table where session_expiration < now()",Conf()->SessionSync_link);
	mysql_select_db(Conf()->AppConf_dbname ,Conf()->SessionSync_link);
}
	
    	    
// Set the save handlers
session_set_save_handler("on_session_start",   "on_session_end",
			"on_session_read",    "on_session_write",
			"on_session_destroy", "on_session_gc");
	
session_start();


