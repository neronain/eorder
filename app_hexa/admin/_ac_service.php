<?
class Joay_Action_service extends Joay_Action{
	function GetSector(){
		return "ADMIN";
	}
	public static function GenKey(){
		$ny_time =  new DateTimeZone('Asia/Bangkok');
		$datetime = new DateTime();
		$datetime->setTimezone($ny_time);
		$key = md5($datetime->format('dmyM')).md5($datetime->format('dM').'xx');
		return $key;
	}
	public function BeforeAction(){
		$key = Req(key);
		if($key!=self::GenKey()){
			
			exit('Access denie');
		}
		Conf()->LOGSQL = false;
		
		
		Csql::$DISABLE_PROXY = true;
		
		//Call Qry for init default Qry;
		Qry();
		Csql::$defaultQry = Csql::$defaultUpdateQry;	
	
		
	}
	
	function todo_mysqlstartslave(/*TODO:V+UU*/$key,$callback){
		//$sql_skiperr = "stop slave;set global sql_slave_skip_counter = 1;start slave;";
		Qry()->Execute('start slave',true);
		parent::prototype_refresh_recordx($callback,array());
	}
	
	function todo_mysqlstopslave(/*TODO:V+UU*/$key,$callback){
		//$sql_skiperr = "stop slave;set global sql_slave_skip_counter = 1;start slave;";
		Qry()->Execute('stop slave',true);
		parent::prototype_refresh_recordx($callback,array());
	}	

	function todo_mysqlrestartslave(/*TODO:V+UU*/$key,$callback){
		//$sql_skiperr = "stop slave;set global sql_slave_skip_counter = 1;start slave;";
		Qry()->Execute('stop slave',true);
		Qry()->Execute('start slave',true);
		parent::prototype_refresh_recordx($callback,array());
	}	
	
	
	function todo_fixdup($table,$indexkey,/*TODO:V+UU*/$key1,/*TODO:V+UU*/$key2,$key3,/*TODO:V+UU*/$key,$callback){
		$success = false;
		if(Conf()->DEBUG){
			if($indexkey=='repair'){
				Qry()->Execute('repair table '.$table.'',true);
				$success = true;
			}else{
				$table = str_replace('`','',$table);
				switch($table){
					case 'memship':
					
						if($indexkey=='member_id'){
							Qry()->Execute('delete from '.$table.' where member_id='.$key1.' and memlevel_id='.$key2,true);
							$success = true;
						}
						break;
					case 'memlevel':
					
						if($indexkey=='name'){
							preg_match('/^(.+)\-(\d+)$/',$key1,$match);
							//Inc_Debug::Dump($match);
							if($match){
								Qry()->Execute('delete from '.$table.' where name=\''.$match[1].'\' and member_id='.$match[2],true);
								$success = true;
							}
						}
						break;
						
					case 'stat':
					
						if($indexkey=='from_node_id' && $key1==0){
							Qry()->Execute('stop slave',true);
							Qry()->Execute('set global sql_slave_skip_counter = 1;',true);
							Qry()->Execute('start slave',true);
							$success = true;
							parent::prototype_refresh_recordx($callback,array());
						}
						break;
											
						
					case 'hsparkdm':
					
						if($indexkey=='domain'){
							Qry()->Execute('delete from '.$table.' where domain=\''.$key1.'\';',true);
							$success = true;
						}
						break;
					
					case 'hsdomain':
					
						if($indexkey=='domain'){
							preg_match('/^(.+)\-(\d+)$/',$key1,$match);
							//Inc_Debug::Dump($match);
							if($match){
								Qry()->Execute('delete from '.$table.' where domain=\''.$match[1].'\' and member_id='.$match[2],true);
								$success = true;
							}
						}
						break;
						
					case 'optlist':
				
						if($indexkey=='member_id' || $indexkey==2){
							Qry()->Execute('delete from '.$table.' where member_id='.$key1.' and optin_id='.$key2,true);
							$success = true;
						}
						break;
											
						
					case 'logininfo':
				
						if($indexkey=='memsite_id'){
							Qry()->Execute('delete from '.$table.' where memsite_id='.$key1.' and username=\''.$key2."'",true);
							$success = true;
						}
						break;
	
						
					case 'afjoin':
					
						if($indexkey=='campaign_id'){
							Qry()->Execute('delete from '.$table.' where campaign_id='.$key1.' and member_id='.$key2,true);
							$success = true;
						}
						break;
						
					case 'lcmstag':
					
						if($indexkey=='lcmref_id'){
							Qry()->Execute('delete from '.$table.' where lcmref_id='.$key1.' and type=\''.$key2.'\' and lcmtag_id='.$key3.' ',true);
							$success = true;
						}
						break;
						
					case 'crrelation':
					
						if($indexkey=='type'){
							Qry()->Execute('delete from '.$table.' where type=\''.$key1.'\' and ref1_id=\''.$key2.'\'  and ref2_id='.$key3.' ',true);
							$success = true;
						}
						if($indexkey=='PRIMARY'){
							Qry()->Execute('delete from '.$table.' where id=\''.$key1.'\'  ',true);
							$success = true;
						}
						break;	
						
					case 'pairvar':
					
						if($indexkey=='name'){
							Qry()->Execute('delete from '.$table.' where name=\''.$key1.'\' and groupname=\''.$key2.'\'  and member_id='.$key3.' ',true);
							$success = true;
						}
						if($indexkey=='PRIMARY'){
							Qry()->Execute('delete from '.$table.' where id=\''.$key1.'\'  ',true);
							$success = true;
						}
						break;						
					
					
					case 'member':
						if($indexkey=='email'){
							Qry()->Execute('delete from '.$table.' where email=\''.$key1.'\' ',true);
							$success = true;
						}
						break;
								
					default:
						
				}
				if(!$success && $indexkey=='PRIMARY'){
					Qry()->Execute('delete from '.$table.' where id='.$key1.' ',true);
					$success = true;
				}
			}
		}
		if(!$success){
			SaveDS()->Put('qry',sprintf(__("not implement table[%s] indexkey[%s] key1[%s] key2[%s] key3[%s]"),$table,$indexkey,$key1,$key2,$key3));
		}
		
		//$sql_skiperr = "stop slave;set global sql_slave_skip_counter = 1;start slave;";
		Qry()->Execute('stop slave',true);
		Qry()->Execute('start slave',true);
		parent::prototype_refresh_recordx($callback,array());
	}	
	
	function todo_mysqlskip(/*TODO:V+UU*/$key,$callback){
		//$sql_skiperr = "stop slave;set global sql_slave_skip_counter = 1;start slave;";
		Qry()->Execute('stop slave',true);
		if(Conf()->DEBUG){
			Qry()->Execute('set global sql_slave_skip_counter = 1',true);
		}else{
			Qry()->Execute('set global sql_slave_skip_counter = 1',true);
		}
		Qry()->Execute('start slave',true);
		parent::prototype_refresh_recordx($callback,array());
	}
	function todo_mysqlfixrelay(/*TODO:V+UU*/$key,$callback){
		
		$result = Qry()->ExecuteARecord("show slave status",true);
		$slave_status = array();
		if($result!=NULL){
			$fixQuery = "CHANGE MASTER TO MASTER_LOG_FILE='".$result['Master_Log_File']."', MASTER_LOG_POS=".$result['Exec_Master_Log_Pos'].";";
			Qry()->Execute('stop slave',true);
			Qry()->Execute($fixQuery,true);
			Qry()->Execute('start slave',true);
		}
		parent::prototype_refresh_recordx($callback,array());

	}
	
	function todo_readfile(/*TODO:V+UU*/$key,$filepath,$pretag=''){
		if(!file_exists($filepath)){
			echo "Chdir".getcwd();
			exit('File not found');
		}
		
		$fsize = filesize($filepath);
		$range = 0;
		$size = $fsize;
		
		$pre_offset = NULL;
		$suf_offset = NULL;
		
		$pre_length = 0;
		$suf_length = 0;
		if($pretag!=''){
			$pretag = str_replace('\\\\\"','"',$pretag);
			$pre_offset = "<pre $pretag>";
			$suf_offset = "</pre>";
			$pre_length = strlen($pre_offset);
			$suf_length = strlen($suf_offset);
				
		}		
		
		$size += $pre_length+$suf_length;
		
		if(isset($_SERVER['HTTP_RANGE']))
		{
			$a = NULL;
			list($a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
			list($range) = explode(",",$range,2);
			list($range, $range_end) = explode("-", $range);
			$range=intval($range);
			if(!$range_end) {
				$range_end=$size-1;
			} else {
				$range_end=intval($range_end);
			}
		
			$new_length = $range_end-$range+1;
			header("HTTP/1.1 206 Partial Content");
			header("Content-Length: $new_length");
			header("Content-Range: bytes $range-$range_end/$size");
		} else {
			$new_length=$size;
			header("Content-Length: ".$size);
		}
		
		if($pretag!=''){
			echo $pre_offset;
		}
		
		/* output the file itself */
		$chunksize = 1*(1024*1024); //you may want to change this
		$bytes_send = 0;		
		
		if ($file = fopen($filepath, 'r')){
		
			if(isset($_SERVER['HTTP_RANGE']))
				fseek($file, $range);
		
			while(!feof($file) && (!connection_aborted()) && ($bytes_send<$new_length)){
		
				$buffer = fread($file, $chunksize);
				print($buffer); 
				//echo($buffer); // is also possible
				flush();
				$bytes_send += strlen($buffer);
			}
		
			fclose($file);
		} else die('Error - can not open file.');
		
		if($pretag!=''){
			echo $suf_offset;
		}
		
		
		die();
	}
	
	
	function todo_getfile(/*TODO:V+UU*/$key,$filepath){
		if(!file_exists($filepath) && preg_match("/upload/",$filepath)){
			Inc_Io::Header404();
		}
		// file size in bytes
		$fsize = filesize($filepath);
		$size = $fsize;
		$fname = basename($filepath);
		
		// file extension
		$fext = strtolower(substr(strrchr($fname,"."),1));
		
		$downloadname = $fname;
		$downloadname = str_replace(" ","_",$downloadname);
		
		
		
		
		
		$mtype = '';
		// mime type is not set, get from server settings
		if(function_exists('mime_content_type')) {
			$mtype = mime_content_type($filepath);
		} else
			if(function_exists('finfo_file')) {
			$finfo = finfo_open(FILEINFO_MIME); // return mime type
			$mtype = finfo_file($finfo,$filepath);
			finfo_close($finfo);
		}
		if($mtype == '') {
			$mtype = "application/force-download";
		}
		
		
		
		
		// Browser will try to save file with this filename, regardless original filename.
		// You can override it if needed.
		// multipart-download and download resuming support
		
		
		// required for IE, otherwise Content-Disposition may be ignored
		if(ini_get('zlib.output_compression'))
			ini_set('zlib.output_compression', 'Off');
		
		
		
		// set headers
		// header("Pragma: public");
		// header("Expires: 0");
		// header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
		// header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Type: $mtype");
		header("Content-Disposition: attachment; filename=\"$downloadname\"");
		header("Content-Transfer-Encoding: binary");
		// header("Content-Length: ".$fsize);
		
		
		header('Accept-Ranges: bytes');
		
		/* The three lines below basically make the
		 download non-cacheable */
		header("Cache-control: private");
		header('Pragma: private');
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		
		$range = 0;
		if(isset($_SERVER['HTTP_RANGE']))
		{
			list(/*TODO:V+UU*/$a, $range) = explode("=",$_SERVER['HTTP_RANGE'],2);
			list($range) = explode(",",$range,2);
			list($range, $range_end) = explode("-", $range);
			$range=intval($range);
			if(!$range_end) {
				$range_end=$size-1;
			} else {
				$range_end=intval($range_end);
			}
		
			$new_length = $range_end-$range+1;
			header("HTTP/1.1 206 Partial Content");
			header("Content-Length: $new_length");
			header("Content-Range: bytes $range-$range_end/$size");
		} else {
			$new_length=$size;
			header("Content-Length: ".$size);
		}
		
		
		
		/* output the file itself */
		$chunksize = 1*(1024*1024); //you may want to change this
		$bytes_send = 0;
		if ($file = fopen($filepath, 'r')){
		
			if(isset($_SERVER['HTTP_RANGE']))
				fseek($file, $range);
		
			while(!feof($file) && (!connection_aborted()) && ($bytes_send<$new_length)){
		
				$buffer = fread($file, $chunksize);
				print($buffer); //echo($buffer); // is also possible
				flush();
				$bytes_send += strlen($buffer);
			}
		
			fclose($file);
		} else die('Error - can not open file.');
		
		die();
		
	}
	
	
	function todo_mysqlstatus($key,$callback){

		$result = Qry()->ExecuteARecord("show variables",true);
		$variable_list = array();
		while(!Qry()->EOF){
			$Variable_name = Qry()->Rs('Variable_name');
			switch($Variable_name){
				case 'server_id':
				case 'slave_max_allowed_packet':
				case 'hostname':
				case 'auto_increment_offset':
				case 'auto_increment_increment':
				case 'have_innodb':					
					$variable_list[$Variable_name] = Qry()->Rs('Value');
					break;
				
			}
			
			
			
			Qry()->MoveNext();
		}
		//Inc_Debug::Dump($variable_list);
		//exit();
		
		$result = Qry()->ExecuteARecord("show master status",true);
		$master_status = array();
		if($result!=NULL)foreach($result as $key =>$val){
			if(is_numeric($key))continue;
			$master_status[$key] = $val;
		}
		//File 				Position 		Binlog_Do_DB 	Binlog_Ignore_DB
		//mysql-bin.000015 	21586022 						mysql,eximstats,horde,mail,cphulkd,eximstats,fusio...
		
		
		$result = Qry()->ExecuteARecord("show slave status",true);
		$slave_status = array();
		if($result!=NULL)foreach($result as $key =>$val){
			if(is_numeric($key))continue;
			$slave_status[$key] = $val;
		}
		
		Qry()->Query("show processlist",true);
		$process_list = array();
		while(!Qry()->EOF){
			$process_list[] = Qry()->CurrentRowArray();
			Qry()->MoveNext();
		}	
		
		
		//Slave_IO_State 					Master_Host 	Master_User 	Master_Port 	Connect_Retry 	Master_Log_File 	Read_Master_Log_Pos 	
		//Waiting for master to send event 	67.227.223.32 	hexa_sync 	3306 			60 				mysql-bin.000004 	887100650 				
		
		//Relay_Log_File 		Relay_Log_Pos 	Relay_Master_Log_File 	Slave_IO_Running 	Slave_SQL_Running 	Replicate_Do_DB 	Replicate_Ignore_DB 									
		//db2-relay-bin.000002 	30839189 		mysql-bin.000004 		Yes 				Yes 									mysql,eximstats,horde,mail,cphulkd,eximstats,fusio... 	
		
		//Replicate_Do_Table 	Replicate_Ignore_Table 	Replicate_Wild_Do_Table 	Replicate_Wild_Ignore_Table 	Last_Errno 	Last_Error 	Skip_Counter 	
		//																											0 						0 				
		
		//Exec_Master_Log_Pos 	Relay_Log_Space 	Until_Condition 	Until_Log_File 	Until_Log_Pos 	Master_SSL_Allowed 	Master_SSL_CA_File 	Master_SSL_CA_Path 	Master_SSL_Cert 	Master_SSL_Cipher 	Master_SSL_Key 	Seconds_Behind_Master
		//887100650 			30839189 			None 								0 				No 																													0
		
		
		$err = ob_get_clean();
		if($err!=''){
			SaveDS()->Put('error',$err);
		}
		/*if(Conf()->DEBUG){
			$master_status = array(
				"File"=>"mysql-bin.000015",
				"Position"=>"22341481",
				"Binlog_Do_DB"=>"",
				"Binlog_Ignore_DB"=>"mysql,eximstats,horde,mail,cphulkd,eximstats,horde,information_schema,leechprotect,massage_wrdp1,modsec,roundcube,httpd_session,httpd_%,munin%"
			);
			$slave_status = array(
				"Slave_IO_State"=>"Waiting for master to send event",
				"Master_Host"=>"67.227.223.32",
				"Master_User"=>"hexa_sync",
				"Master_Port"=>"3306",
				"Connect_Retry"=>"60",
				"Master_Log_File"=>"mysql-bin.000004",
				"Read_Master_Log_Pos"=>"887791493",
				"Relay_Log_File"=>"db2-relay-bin.000002",
				"Relay_Log_Pos"=>"30859706",
				"Relay_Master_Log_File"=>"mysql-bin.000004",
				"Slave_IO_Running"=>"Yes",
				"Slave_SQL_Running"=>"Yes",
				"Replicate_Do_DB"=>"",
				"Replicate_Ignore_DB"=>"mysql,eximstats,horde,mail,cphulkd,eximstats,horde,information_schema,leechprotect,massage_wrdp1,modsec,roundcube,httpd_session,httpd_%,munin%",
				"Replicate_Do_Table"=>"",
				"Replicate_Ignore_Table"=>"",
				"Replicate_Wild_Do_Table"=>"",
				"Replicate_Wild_Ignore_Table"=>"",
				"Last_Errno"=>"0",
				"Last_Error"=>"",
				"Skip_Counter"=>"0",
				"Exec_Master_Log_Pos"=>"887791493",
				"Relay_Log_Space"=>"30859706",
				"Until_Condition"=>"None",
				"Until_Log_File"=>"",
				"Until_Log_Pos"=>"0",
				"Master_SSL_Allowed"=>"No",
				"Master_SSL_CA_File"=>"",
				"Master_SSL_CA_Path"=>"",
				"Master_SSL_Cert"=>"",
				"Master_SSL_Cipher"=>"",
				"Master_SSL_Key"=>"",
				"Seconds_Behind_Master"=>"0"
			);
			
		}*/

		$host = strtolower(Conf()->this_http_domain);
		$host = str_replace('http://', '', $host);
		
		parent::prototype_refresh_recordx($callback,array('id'=>$host,'master'=>$master_status,'slave'=>$slave_status,'process'=>$process_list,'variable'=>$variable_list));
		//print_r($result_master_status);
		/*
		#File
		print "|";
		print $result_master_status['File'];
		print "|";
		print $result_master_status['Position'];
		print "|";


		## Slave
		$query_slave_status = @mysql_query("show slave status");
		$result_slave_status = @mysql_fetch_array($query_slave_status);

		print "\n";
		print "|";
		#Master Host IP Address
		print $result_slave_status['Master_Host'];
		print "|";

		#Slave_IO_Running
		print $result_slave_status['Slave_IO_Running'];
		print "|";
		#Slave_SQL_Running
		print $result_slave_status['Slave_SQL_Running'];
		print "|";

		#Master Log File
		print $result_slave_status['Master_Log_File'];
		print "|";

		#Read Master Log Pos
		print $result_slave_status['Read_Master_Log_Pos'];
		print "|";


		#Exec_Master_Log_Pos
		print $result_slave_status['Exec_Master_Log_Pos'];
		print "|";

		#Skip Counter
		print $result_slave_status['Skip_Counter'];
		print "|";

		#Last Errorno
		print $result_slave_status['Last_Errno'];
		print "|";

		#Last Error
		print $result_slave_status['Last_Error'];
		print "|";
		*/
	}
}

/*
+-----------------------------------------+--------------------------------------+
| Variable_name                           | Value                                |
+-----------------------------------------+--------------------------------------+
| auto_increment_increment                | 10                                   |
| auto_increment_offset                   | 5                                    |
| automatic_sp_privileges                 | ON                                   |
| back_log                                | 50                                   |
| basedir                                 | /                                    |
| binlog_cache_size                       | 32768                                |
| bulk_insert_buffer_size                 | 8388608                              |
| character_set_client                    | latin1                               |
| character_set_connection                | latin1                               |
| character_set_database                  | latin1                               |
| character_set_filesystem                | binary                               |
| character_set_results                   | latin1                               |
| character_set_server                    | latin1                               |
| character_set_system                    | utf8                                 |
| character_sets_dir                      | /usr/share/mysql/charsets/           |
| collation_connection                    | latin1_swedish_ci                    |
| collation_database                      | latin1_swedish_ci                    |
| collation_server                        | latin1_swedish_ci                    |
| completion_type                         | 0                                    |
| concurrent_insert                       | 1                                    |
| connect_timeout                         | 30                                   |
| datadir                                 | /var/lib/mysql/                      |
| date_format                             | %Y-%m-%d                             |
| datetime_format                         | %Y-%m-%d %H:%i:%s                    |
| default_week_format                     | 0                                    |
| delay_key_write                         | ON                                   |
| delayed_insert_limit                    | 100                                  |
| delayed_insert_timeout                  | 300                                  |
| delayed_queue_size                      | 1000                                 |
| div_precision_increment                 | 4                                    |
| keep_files_on_create                    | OFF                                  |
| engine_condition_pushdown               | OFF                                  |
| expire_logs_days                        | 0                                    |
| flush                                   | OFF                                  |
| flush_time                              | 0                                    |
| ft_boolean_syntax                       | + -><()~*:""&|                       |
| ft_max_word_len                         | 84                                   |
| ft_min_word_len                         | 4                                    |
| ft_query_expansion_limit                | 20                                   |
| ft_stopword_file                        | (built-in)                           |
| group_concat_max_len                    | 1024                                 |
| have_archive                            | YES                                  |
| have_bdb                                | NO                                   |
| have_blackhole_engine                   | YES                                  |
| have_compress                           | YES                                  |
| have_community_features                 | NO                                   |
| have_profiling                          | NO                                   |
| have_crypt                              | YES                                  |
| have_csv                                | YES                                  |
| have_dynamic_loading                    | YES                                  |
| have_example_engine                     | YES                                  |
| have_federated_engine                   | YES                                  |
| have_geometry                           | YES                                  |
| have_innodb                             | DISABLED                             |
| have_isam                               | NO                                   |
| have_merge_engine                       | YES                                  |
| have_ndbcluster                         | NO                                   |
| have_openssl                            | NO                                   |
| have_ssl                                | NO                                   |
| have_query_cache                        | YES                                  |
| have_raid                               | NO                                   |
| have_rtree_keys                         | YES                                  |
| have_symlink                            | YES                                  |
| hostname                                | hexaceram                            |
| init_connect                            |                                      |
| init_file                               |                                      |
| init_slave                              |                                      |
| innodb_additional_mem_pool_size         | 1048576                              |
| innodb_autoextend_increment             | 8                                    |
| innodb_buffer_pool_awe_mem_mb           | 0                                    |
| innodb_buffer_pool_size                 | 402653184                            |
| innodb_checksums                        | ON                                   |
| innodb_commit_concurrency               | 0                                    |
| innodb_concurrency_tickets              | 500                                  |
| innodb_data_file_path                   | ibdata1:2000M;ibdata2:10M:autoextend |
| innodb_data_home_dir                    | /var/lib/mysql/                      |
| innodb_adaptive_hash_index              | ON                                   |
| innodb_doublewrite                      | ON                                   |
| innodb_fast_shutdown                    | 1                                    |
| innodb_file_io_threads                  | 4                                    |
| innodb_file_per_table                   | OFF                                  |
| innodb_flush_log_at_trx_commit          | 1                                    |
| innodb_flush_method                     |                                      |
| innodb_force_recovery                   | 0                                    |
| innodb_lock_wait_timeout                | 50                                   |
| innodb_locks_unsafe_for_binlog          | OFF                                  |
| innodb_log_arch_dir                     |                                      |
| innodb_log_archive                      | OFF                                  |
| innodb_log_buffer_size                  | 8388608                              |
| innodb_log_file_size                    | 104857600                            |
| innodb_log_files_in_group               | 2                                    |
| innodb_log_group_home_dir               | /var/lib/mysql/                      |
| innodb_max_dirty_pages_pct              | 90                                   |
| innodb_max_purge_lag                    | 0                                    |
| innodb_mirrored_log_groups              | 1                                    |
| innodb_open_files                       | 300                                  |
| innodb_rollback_on_timeout              | OFF                                  |
| innodb_support_xa                       | ON                                   |
| innodb_sync_spin_loops                  | 20                                   |
| innodb_table_locks                      | ON                                   |
| innodb_thread_concurrency               | 8                                    |
| innodb_thread_sleep_delay               | 10000                                |
| innodb_use_legacy_cardinality_algorithm | ON                                   |
| interactive_timeout                     | 28800                                |
| join_buffer_size                        | 131072                               |
| key_buffer_size                         | 402653184                            |
| key_cache_age_threshold                 | 300                                  |
| key_cache_block_size                    | 1024                                 |
| key_cache_division_limit                | 100                                  |
| language                                | /usr/share/mysql/english/            |
| large_files_support                     | ON                                   |
| large_page_size                         | 0                                    |
| large_pages                             | OFF                                  |
| lc_time_names                           | en_US                                |
| license                                 | GPL                                  |
| local_infile                            | ON                                   |
| locked_in_memory                        | OFF                                  |
| log                                     | OFF                                  |
| log_bin                                 | ON                                   |
| log_bin_trust_function_creators         | OFF                                  |
| log_error                               |                                      |
| log_queries_not_using_indexes           | OFF                                  |
| log_slave_updates                       | ON                                   |
| log_slow_queries                        | ON                                   |
| log_warnings                            | 1                                    |
| long_query_time                         | 1                                    |
| low_priority_updates                    | OFF                                  |
| lower_case_file_system                  | OFF                                  |
| lower_case_table_names                  | 0                                    |
| max_allowed_packet                      | 536870912                            |
| max_binlog_cache_size                   | 18446744073709547520                 |
| max_binlog_size                         | 1073741824                           |
| max_connect_errors                      | 1000                                 |
| max_connections                         | 300                                  |
| max_delayed_threads                     | 20                                   |
| max_error_count                         | 64                                   |
| max_heap_table_size                     | 16777216                             |
| max_insert_delayed_threads              | 20                                   |
| max_join_size                           | 18446744073709551615                 |
| max_length_for_sort_data                | 1024                                 |
| max_prepared_stmt_count                 | 16382                                |
| max_relay_log_size                      | 0                                    |
| max_seeks_for_key                       | 18446744073709551615                 |
| max_sort_length                         | 1024                                 |
| max_sp_recursion_depth                  | 0                                    |
| max_tmp_tables                          | 32                                   |
| max_user_connections                    | 0                                    |
| max_write_lock_count                    | 18446744073709551615                 |
| multi_range_count                       | 256                                  |
| myisam_data_pointer_size                | 6                                    |
| myisam_max_sort_file_size               | 9223372036853727232                  |
| myisam_mmap_size                        | 18446744073709551615                 |
| myisam_recover_options                  | OFF                                  |
| myisam_repair_threads                   | 1                                    |
| myisam_sort_buffer_size                 | 67108864                             |
| myisam_stats_method                     | nulls_unequal                        |
| net_buffer_length                       | 16384                                |
| net_read_timeout                        | 30                                   |
| net_retry_count                         | 10                                   |
| net_write_timeout                       | 60                                   |
| new                                     | OFF                                  |
| old_passwords                           | ON                                   |
| open_files_limit                        | 1500                                 |
| optimizer_prune_level                   | 1                                    |
| optimizer_search_depth                  | 62                                   |
| pid_file                                | /var/lib/mysql/hexaceram.pid         |
| plugin_dir                              |                                      |
| port                                    | 3306                                 |
| preload_buffer_size                     | 32768                                |
| protocol_version                        | 10                                   |
| query_alloc_block_size                  | 8192                                 |
| query_cache_limit                       | 1048576                              |
| query_cache_min_res_unit                | 4096                                 |
| query_cache_size                        | 33554432                             |
| query_cache_type                        | ON                                   |
| query_cache_wlock_invalidate            | OFF                                  |
| query_prealloc_size                     | 8192                                 |
| range_alloc_block_size                  | 4096                                 |
| read_buffer_size                        | 2097152                              |
| read_only                               | OFF                                  |
| read_rnd_buffer_size                    | 8388608                              |
| relay_log                               |                                      |
| relay_log_index                         |                                      |
| relay_log_info_file                     | relay-log.info                       |
| relay_log_purge                         | ON                                   |
| relay_log_space_limit                   | 0                                    |
| rpl_recovery_rank                       | 0                                    |
| secure_auth                             | OFF                                  |
| secure_file_priv                        |                                      |
| server_id                               | 50                                   |
| skip_external_locking                   | ON                                   |
| skip_networking                         | OFF                                  |
| skip_show_database                      | OFF                                  |
| slave_compressed_protocol               | OFF                                  |
| slave_load_tmpdir                       | /tmp/                                |
| slave_net_timeout                       | 3600                                 |
| slave_skip_errors                       | OFF                                  |
| slave_transaction_retries               | 10                                   |
| slow_launch_time                        | 2                                    |
| socket                                  | /var/lib/mysql/mysql.sock            |
| sort_buffer_size                        | 2097152                              |
| sql_big_selects                         | ON                                   |
| sql_mode                                |                                      |
| sql_notes                               | ON                                   |
| sql_warnings                            | OFF                                  |
| ssl_ca                                  |                                      |
| ssl_capath                              |                                      |
| ssl_cert                                |                                      |
| ssl_cipher                              |                                      |
| ssl_key                                 |                                      |
| storage_engine                          | MyISAM                               |
| sync_binlog                             | 0                                    |
| sync_frm                                | ON                                   |
| system_time_zone                        | EDT                                  |
| table_cache                             | 64                                   |
| table_lock_wait_timeout                 | 50                                   |
| table_type                              | MyISAM                               |
| thread_cache_size                       | 8                                    |
| thread_stack                            | 262144                               |
| time_format                             | %H:%i:%s                             |
| time_zone                               | SYSTEM                               |
| timed_mutexes                           | OFF                                  |
| tmp_table_size                          | 33554432                             |
| tmpdir                                  | /tmp/                                |
| transaction_alloc_block_size            | 8192                                 |
| transaction_prealloc_size               | 4096                                 |
| tx_isolation                            | REPEATABLE-READ                      |
| updatable_views_with_limit              | YES                                  |
| version                                 | 5.0.96-community-log                 |
| version_comment                         | MySQL Community Edition (GPL)        |
| version_compile_machine                 | x86_64                               |
| version_compile_os                      | unknown-linux-gnu                    |
| wait_timeout                            | 28800                                |
+-----------------------------------------+--------------------------------------+
*/