<?
class Inc_ZipUtil{
    public static function extractZip( $zipFile = '', $dirFromZip = '',$targetDir )
    {   
		
		//Inc_Htmlutil::FlushOB("Inc_ZipUtil::extractZip( $zipFile , $dirFromZip,$targetDir )");
        define(DIRECTORY_SEPARATOR, '/');
    
        $zipDir = getcwd() . DIRECTORY_SEPARATOR;
        $zip = zip_open($zipDir.$zipFile);
    	//var_dump($zipDir.$zipFile);
		//exit;
        if ($zip)
        {
			//Inc_Htmlutil::FlushOB("Open Zip<br>");
            while ($zip_entry = zip_read($zip))
            {
                $completePath = $zipDir . dirname(zip_entry_name($zip_entry));
                $completeName = $targetDir.DIRECTORY_SEPARATOR. zip_entry_name($zip_entry);
	            //Inc_Htmlutil::FlushOB("".$completeName."<br>");
                // Walk through path to create non existing directories
                // This won't apply to empty directories ! They are created further below
                if(!file_exists($completePath) && preg_match( '#^' . $dirFromZip .'.*#', dirname(zip_entry_name($zip_entry)) ) )
                {
                    $tmp = '';
                    foreach(explode('/',$completePath) AS $k)
                    {
                        $tmp .= $k.'/';
                        if(!file_exists($tmp) )
                        {
                            @mkdir($tmp, 0777,true);
                        }
                    }
                }
               
                if (zip_entry_open($zip, $zip_entry, "r"))
                {
                    if( preg_match( '#^' . $dirFromZip .'.*#', dirname(zip_entry_name($zip_entry)) ) )
                    {
						
                        if ($fd = @fopen($completeName, 'w+'))
                        {
                            fwrite($fd, zip_entry_read($zip_entry, zip_entry_filesize($zip_entry)));
                            fclose($fd);
                        }
                        else
                        {
                            // We think this was an empty directory
                            mkdir($completeName, 0777,true);
                        }
                        zip_entry_close($zip_entry);
                    }
                }
            }
            zip_close($zip);
        }else{
			Inc_Htmlutil::FlushOB("Can't open zipfile: ". $zipFile);
		}
        return true;
    }
    
    public static function zipFileErrMsg($errno) {
    	// using constant name as a string to make this function PHP4 compatible
    	$zipFileFunctionsErrors = array(
    							'ZIPARCHIVE::ER_MULTIDISK' => 'Multi-disk zip archives not supported.',
    							'ZIPARCHIVE::ER_RENAME' => 'Renaming temporary file failed.',
    							'ZIPARCHIVE::ER_CLOSE' => 'Closing zip archive failed',
    							'ZIPARCHIVE::ER_SEEK' => 'Seek error',
    							'ZIPARCHIVE::ER_READ' => 'Read error',
    							'ZIPARCHIVE::ER_WRITE' => 'Write error',
    							'ZIPARCHIVE::ER_CRC' => 'CRC error',
    							'ZIPARCHIVE::ER_ZIPCLOSED' => 'Containing zip archive was closed',
    							'ZIPARCHIVE::ER_NOENT' => 'No such file.',
    							'ZIPARCHIVE::ER_EXISTS' => 'File already exists',
    							'ZIPARCHIVE::ER_OPEN' => 'Can\'t open file',
    							'ZIPARCHIVE::ER_TMPOPEN' => 'Failure to create temporary file.',
    							'ZIPARCHIVE::ER_ZLIB' => 'Zlib error',
    							'ZIPARCHIVE::ER_MEMORY' => 'Memory allocation failure',
    							'ZIPARCHIVE::ER_CHANGED' => 'Entry has been changed',
    							'ZIPARCHIVE::ER_COMPNOTSUPP' => 'Compression method not supported.',
    							'ZIPARCHIVE::ER_EOF' => 'Premature EOF',
    							'ZIPARCHIVE::ER_INVAL' => 'Invalid argument',
    							'ZIPARCHIVE::ER_NOZIP' => 'Not a zip archive',
    							'ZIPARCHIVE::ER_INTERNAL' => 'Internal error',
    							'ZIPARCHIVE::ER_INCONS' => 'Zip archive inconsistent',
    							'ZIPARCHIVE::ER_REMOVE' => 'Can\'t remove file',
    							'ZIPARCHIVE::ER_DELETED' => 'Entry has been deleted'
    	);
    	$errmsg = 'unknown';
    	foreach ($zipFileFunctionsErrors as $constName => $errorMessage) {
    		if (defined($constName) and constant($constName) === $errno) {
    			return 'Zip File Function error: '.$errorMessage;
    		}
    	}
    	return 'Zip File Function error: unknown';
    }
    
}

// The call to exctract a path within the zip file
//Inc_ZipUtil::extractZip( 'clansuite.zip', 'core/filters' );
