<?
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');

		$url = "https://test.ctpe.net/payment/DemoMerchantInfo?id=5tg6rt63re6547AB";
		$data = file_get_contents($url);
		$testHeidelDetail = array();
		$lineAr = explode("\n",$data);
		foreach($lineAr as $line){
			if(preg_match('/^([A-Z0-9]+)(\.([A-Z0-9]+))?= *(.+?)$/',$line,$match)){
				//Inc_Var::vardump($match);
				$var1 = $match[1];
				$var2 = $match[3];
				$var3 = trim($match[4]);
				if($var2!=''){
					$testHeidelDetail[$var1][$var2] = $var3;
				}else{
					$testHeidelDetail[$var1] = $var3;
				}
				
			}
		}
		
		$buffer = var_export($testHeidelDetail,true);
		
		$buffer = "<? \$HEIDEL_TEST_ACCOUNT = ".$buffer.";";
		
		file_put_contents("../framework/conf/config.dynamic.php",$buffer);
		?> Done.