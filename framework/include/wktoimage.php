<?php

class Inc_WkToImage{
	public static function Capture($url,&$filename=NULL,$jpegQuality=60){
		if($filename==NULL){
			$filename = Inc_Io::generateFilepath('jpg');
		}
		 $extension  = strtolower(substr(strrchr($filename, "."),1));
		
		$url = str_replace("&","%26", $url);
		$filename = realpath(dirname($filename))."/".basename($filename);
		
		if(!Conf()->DEBUG){
			$exePath = realpath("../../resources/bin/wkhtmltoimage-amd64");
		}else{
			if(WKHTMLTOIMAGE){
				$exePath = '"'.WKHTMLTOIMAGE.'"';
			}else{
				$exePath = '"C:\Program Files (x86)\wkhtmltopdf\wkhtmltoimage.exe"';
			}
			$filename = str_replace("/","\\", $filename);
		}
		
			
		$cmd = "$exePath --quality $jpegQuality $url $filename";
		$output = Inc_External::run($cmd, $code);
		
		//Inc_Var::vardump($cmd);
		// code table
		// 1: 403 Forbidden
		// 2: 404 File not found
		if($code!==0 && $code!==1 && $code!==2){
			//Inc_Var::vardump($cmd);
			Inc_Var::vardump($code);
			Inc_Var::vardump($output);
		}
		//Return 0 if no error
		return $code;
	}
}