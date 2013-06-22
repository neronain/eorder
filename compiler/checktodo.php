<?

if ($handle = opendir('log/118')) {
    //echo "Directory handle: $handle\n";
    //echo "Files:\n";

    /* This is the correct way to loop over the directory. */
    while (false !== ($file = readdir($handle))) {
		if(strpos($file,'ipn_validate_2')===false)continue;
		$data = file_get_contents('log/118/'.$file);
		//txn_type=subscr_eot
		//echo "$file<br>";
		
		preg_match_all('/txn_type=subscr_eot.+?subscr_id=(.+?)[ ]*,/s', $data, $matches);
		//preg_match_all('/VERIFIED/s', $data, $matches);
		if(is_array($matches))
		for($i=0;$i<count($matches[0]);$i++){
			echo "update paymentrecord set subscription_status = 'EOT' where subscriptionid = '{$matches[1][$i]}';<br>";
		}

		
		//var_dump($matches);
		//break;
    }



    closedir($handle);
}






