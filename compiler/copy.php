<?
$classpath = array();
function Copy_CSS($path,$exception=NULL){
	global $classpath,$classfunc;
	$dir_handle = @opendir($path) or die("Unable to open $path");
	if($exception==NULL){
		$exception=array();
	}
	
	$countf = 0;
	while ($file = readdir($dir_handle)) 
	{
		if(is_dir($path."/".$file)){
			if(!in_array($file,$exception) && $file !="." && $file !=".." && $file != ".svn"){
				Copy_CSS($path."/".$file);
			}
			continue;
		}
		if(in_array($file,$exception)){
			continue;
		}

		$class = explode(".",$file);
		//echo $class[count($class)-1];
		if($class[count($class)-1]!="css"){
			continue;
		}
		//echo "Read(".$path."/".$file.")<br />";
		//if(mktime()-filemtime($path."/".$file)> 60*60*4){ //4HR
		//	continue;
		//}
		
		$data = file_get_contents($path."/".$file);
		if(strpos($data,"#editorv1_main,#editorv1_header,#editorv1_loginbox,#editorv1_menu,#editorv1_content,#editorv1_footer")===false){
			continue;
		}
		echo "found(".$path."/".$file.")<br />";
		$data = preg_replace("/#editorv1_main,#editorv1_header,#editorv1_loginbox,#editorv1_menu,#editorv1_content,#editorv1_footer *\{.+?\}/s","",$data);
		//#editorv1_main,#editorv1_header,#editorv1_loginbox,#editorv1_menu,#editorv1_content,#editorv1_footer {
		//	behavior: url(pie.htc);
		//}
		
		$data .= "
#editorv1_main,#editorv1_header,#editorv1_loginbox,#editorv1_menu,#editorv1_content,#editorv1_footer {
	behavior: url(pie.htc);
}
		";
		$outputdir = "../tmp/upload/".$path;
		if(!file_exists($outputdir)){
			mkdir($outputdir);
		}		
		//file_put_contents($path."/".$file,$data);
		file_put_contents($outputdir."/".$file,$data);
		//copy($path."/".$file,$outputdir."/".$file);
		
	}
	closedir($dir_handle);
	
}
$except = array("default","resources");
Copy_CSS("../upload",$except);
