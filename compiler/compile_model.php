<?
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');
include "../../framework/core/common.inc.php";


$path = "../model";
$dir_handle = @opendir($path) or die("Unable to open $path");

$outputdir = "../tmp";
if(!file_exists($outputdir)){
	mkdir($outputdir);
}

define('DECLAIRVAR','(\/\*@([\w_:]+)\*\/)');
define('RESOLVEVAR','(\/\*#([\w_:]+)\*\/)');
define('FUNCNAME','([\w\d_]+)');
define('VARIABLE','\$([\w\d_]+)');

define('BREAKVAR','[ \$=\+\-\*\/<>\]\[\)\(;,]');
define('STATEMENT_BREAKER','[;\n]');


$classTable['PageControl']['return']['recordcount'] = 'int';

$Compilearray = array("MD_Stat");

while ($file = readdir($dir_handle)) 
{
	if(substr($file,0,3)!='md_')continue;
	$fileQry = explode(".",$file);
	if($fileQry[count($fileQry)-1]!="php")continue;

	if(substr($file,strlen($file)-8,8)=='_ext.php')continue;
	if($fileQry[0]=='md_tool_link')continue;
	
	$class = $fileQry[0];
	
	$fullpath = $path."/".$file;
	include_once $fullpath;
	$obj = new $fileQry[0];

	$className = get_class($obj);

	if(!in_array($className,$Compilearray))continue;

	$classList[] = $className;
	$classColumns = $obj->GetColumnArrayFull();
	
			
	$readfile = file_get_contents($fullpath);


	$functionTable = "{$fileQry[0]}_func.php";
	$variableTable = "{$fileQry[0]}_vars.php";
	
	$classTable[$className]['name'] = $className;
	$classTable[$className]['columns'] = $classColumns;
	$classTable[$className]['return'] = array();

	foreach($classColumns as $column=> $type){
		if($type=='varchar')$type = 'string';
		if($type=='text')$type = 'string';
		if($type=='num')$type = 'int';
		if($type=='auto')$type = 'DBID';
		$classTable[$className]['return'][$column] = $type;
	}
	$classTable[$className]['return']['WriteAble'] = 'bool';
	$classTable[$className]['return']['BuildDataBySQL'] = 'RSData';
	$classTable[$className]['return']['_BuildByData'] = $className;
	$classTable[$className]['return']['BuildCountSQL'] = 'SQL';
	$classTable[$className]['return']['BuildSelectSQL'] = 'SQL';
	$classTable[$className]['return']['Update'] = 'VOID';



	$classTable[$className]['function_args']['BuildDataBySQL'] = array('SQL');
	$classTable[$className]['function_args']['_BuildByData'] = array($className,'RSData');
	$classTable[$className]['function_args']['BuildCountSQL'] = array('SQL');
	$classTable[$className]['function_args']['BuildSelectSQL'] = array('SQL','PageControl','ORDERBY');



	
	$readfile = preg_replace('/(private|public|protected) [ ]*(static [ ]*)?function/','function',$readfile);

	preg_match_all('/(private |public |protected |static )[ ]*'.DECLAIRVAR.'?[ ]*'.VARIABLE.'[ =]+.+?;/s', $readfile, $matches);
	for($i=0;$i<count($matches[0]);$i++){
		$funcName = $matches[4][$i];
		$funcReturn = $matches[3][$i];
		if($funcReturn==''){
			echo "No return value defined at {$file} function {$funcName} <br/>";
			continue;
		}
		$classTable[$className]['return'][$funcName] = $funcReturn;
		
	}
	//Inc_Var::vardump($matches);

	//Inc_Var::vardump();(\/\*@([\w_]+)\*\/)?
	echo "$class<BR>";
	preg_match_all('/function [ ]*'.DECLAIRVAR.'?[ ]*'.FUNCNAME.'\(([^\)]*)\)/is', $readfile, $matches);
	for($i=0;$i<count($matches[0]);$i++){
		$funcName = $matches[3][$i];
		$funcReturn = $matches[2][$i];
		$funcParam  = $matches[4][$i];
		//echo "function name $funcReturn $funcName";
		//echo "function arg ".$matches[2][$i];

		if($funcReturn==''){
			echo "No return value defined at {$file} function {$funcName} <br/>";
			exit();
			continue;
		}
		$classTable[$className]['return'][$funcName] = $funcReturn;


		preg_match_all('/'.DECLAIRVAR.'?(&)?\$([\w\d_]+)[ ]*(=(.+?))?[ ]*(,|$)/is', $funcParam, $args);
		//Inc_Var::vardump($args);
		$argClassAr = array();
		for($j=0;$j<count($args[0]);$j++){	
			$argClass = $args[2][$j];
			$argName = $args[4][$j];
			//echo "arg $j ";
			//echo "class ".$args[2][$j];
			//echo "ref ".$args[3][$j];
			//echo "name ".$args[4][$j];
			//echo "def ".$args[6][$j];
			if($argClass==''){
				echo "Unidentify class for variable name {$argName}  at {$file} function {$funcName} <br/>";
				exit();
				continue;
			}


			$argClassAr[] = $argClass;
			//echo "[$class][$funcName][$j][C] = '$argClass'<br/>";

		}
		$classTable[$className]['function_args'][$funcName] = $argClassAr;
	}
	

	//if(count($classTable)>3)break;
	
}
closedir($dir_handle);
foreach($classList as $className){
	$fileQry[0] = strtolower($className);
	$file = $fileQry[0].".php";
	$fullpath = $path."/".$file;

	$tmpCompile = file_get_contents($fullpath);
	
	$tmpCompile = preg_replace('/(private [ ]*|public [ ]*|protected [ ]*)?(static [ ]*)?function/','function',$tmpCompile);
	// /**/
	$tmpCompile = preg_replace('/\/\*\*\//s','',$tmpCompile);
	// /*.....*/
	$tmpCompile = preg_replace('/\/\*[^@].*?\*\//s','',$tmpCompile);
	// //
	$tmpCompile = preg_replace('/\/\/.+/','',$tmpCompile);
	// empty string 
	$tmpCompile = preg_replace('/(""|\'\')/s','/*#NULL*/',$tmpCompile);

	// $this 
	$tmpCompile = preg_replace('/\$this/','/*#'.$className.'*/',$tmpCompile);
	// :: 
	$tmpCompile = preg_replace('/::/','->',$tmpCompile);
	// self::
	$tmpCompile = preg_replace('/self->/','/*#'.$className.'*/->',$tmpCompile);
	// parent:: 
	$tmpCompile = preg_replace('/parent->/','/*#'.$className.'*/->',$tmpCompile);
	// ->$ 
	$tmpCompile = preg_replace('/->\$/','->',$tmpCompile);

	// new XXX()
	//$tmpCompile = preg_replace('/(.'.BREAKVAR.')new'.BREAKVAR.'(.+?)\(\)[ ]*;/','$1 /*#$2*/',$tmpCompile);

	$tmpCompile = preg_replace('/^/s','"',$tmpCompile);
	$tmpCompile = preg_replace('/$/s','"',$tmpCompile);
	$tmpCompile = preg_replace('/<\?/','"',$tmpCompile);

	$tmpCompile = preg_replace('/static[ ]*'.DECLAIRVAR.'\$COLUMNARRAY .+?;/s','',$tmpCompile);
	$tmpCompile = preg_replace('/'.DECLAIRVAR.'&/s','$1',$tmpCompile);
	
	//Inc_Var::vardump($tmpCompile );
/**/
	$tmpResolve = "";
	$tmpBufer = "";
	$vartable = array();
	$varlevel = 0;
	$varInFunc = false;
	for($i=0;$i<strlen($tmpCompile);$i++){
		$tmpBufer .= $tmpCompile[$i];
		if(preg_match('/function [ ]*'.DECLAIRVAR.'?[ ]*'.FUNCNAME.'\(/',$tmpBufer,$match)){
			
			$tmpResolve.= $tmpBufer;
			$tmpBufer = substr($tmpBufer,$pos+1);
			$pos = 0;
			//echo " Clear Var LV[$varlevel]<br>";
			$varInFunc = true;
			$varlevel++;
			$vartable[$varlevel] = array();
		}else
		if(preg_match('/(('.DECLAIRVAR.''.VARIABLE.')|('.VARIABLE.'))'.BREAKVAR.'/',$tmpBufer,$match)){
			$tmpBuferLen = strlen($tmpBufer);
			if($match[3]==''){
				$vstr = $match[1];
				$v = $match[7];
				$foundDefined = false;
				for($vlv=$varlevel;$vlv>0;$vlv--){
					if($vartable[$vlv][$v]!=''){
						$foundDefined = $vartable[$vlv][$v];
						break;
					}
				}
				if($foundDefined===false){
					echo "Unidentify variable name {$vstr}  at <pre>{$tmpBufer}</pre> <br/>";
					Inc_Var::vardump($varlevel);
					Inc_Var::vardump($vartable);
					exit();

				}else{
					//Inc_Var::vardump($match);
					//Inc_Var::vardump($vlv);
					//Inc_Var::vardump($vartable);
					//echo " str_replace($vstr,{$vartable[$vlv][$v]},$tmpBufer);<br/>";
					$tmpBufer = str_replace($vstr,"/*#".$vartable[$vlv][$v]."*/",$tmpBufer);
				}
				$tmpResolve.= $tmpBufer;
			}else{
				$t = $match[4];
				$v = $match[5];
				$foundDefined = false;
				for($vlv=$varlevel;$vlv>0;$vlv--){
					if($vartable[$vlv][$v]!=''){
						$foundDefined = $vartable[$vlv][$v];
						break;
					}
				}
				if($foundDefined!==false){
					echo "Variable name {$vstr} already defined at <pre>{$tmpBufer}</pre> <br/>";
					Inc_Var::vardump($vartable);
					exit();
				}else{
					$vartable[$varlevel][$v] = $t;
				}
				//Inc_Var::vardump($match);
				//echo "vartable[$varlevel][$v] = $t;<br/>";
				$tmpBufer = str_replace($match[1],"/*#".$t."*/",$tmpBufer);
				$tmpResolve.= $tmpBufer;
			}
			//Inc_Var::vardump($tmpBufer);
			$diffTmpBuferLen = strlen($tmpBufer)-$tmpBuferLen;
			$tmpBufer = substr($tmpBufer,$pos+$diffTmpBuferLen+1);
			//Inc_Var::vardump($tmpBufer);
			$pos = 0;
			

			//if(count($vartable)>5)break;
		}else{

		}
		$pos++;
		if($tmpCompile[$i]=="{"){
			if($varInFunc){
				$varInFunc = false;
				
			}else{
				$varlevel++;	
				$vartable[$varlevel] = array();	
			}
		}

		if($tmpCompile[$i]=="}"){
			
			$varlevel--;
		}

	}
	
	$tmpCompile = $tmpResolve.$tmpBufer;
	//Inc_Var::vardump($tmpResolve);
	//exit();
/**/



	// ->data[]
	preg_match_all('/'.RESOLVEVAR.'\->data\[("|\')(.+?)("|\')\]/', $tmpCompile, $matches);
	for($i=0;$i<count($matches[0]);$i++){	
		$cName = $matches[2][$i];
		$column = $matches[4][$i];
		if($classTable[$cName]['columns'][$column]==''){
			echo "Invalid columnname {$column}  at {$file} query  {$matches[0][$i]}<br/>";
			exit();
			continue;
		}
		$columnTmp = $classTable[$cName]['return'][$column];
		$columnTmp = "/*#".$columnTmp."*/";
	
		$tmpCompile = str_replace($matches[0][$i],$columnTmp,$tmpCompile);
	}
	// $this->get()preg_match_all('/function [ ]*'.DECLAIRVAR.'?[ ]*'.FUNCNAME.'\(([^\)]*)\)/is', $readfile, $matches);
	preg_match_all('/'.RESOLVEVAR.'\->get\(("|\')(.+?)("|\')\)/i', $tmpCompile, $matches);
	for($i=0;$i<count($matches[0]);$i++){	
		$cName = $matches[2][$i];
		$column = $matches[4][$i];
		if($classTable[$cName]['columns'][$column]==''){
			echo "Invalid columnname {$column}  at {$file} query  {$matches[0][$i]}<br/>";
			exit();
			continue;
		}
		$columnTmp = $classTable[$cName]['return'][$column];
		$columnTmp = "/*#".$columnTmp."*/";
	
		$tmpCompile = str_replace($matches[0][$i],$columnTmp,$tmpCompile);
	}
	// $this->set()
	preg_match_all('/'.RESOLVEVAR.'\->set\(("|\')(.+?)("|\'),(.+?)\)[ ]*;/i', $tmpCompile, $matches);
	for($i=0;$i<count($matches[0]);$i++){	
		$cName = $matches[2][$i];
		$column = $matches[4][$i];
		$value = $matches[6][$i];
		if($classTable[$cName]['columns'][$column]==''){
			echo "Invalid columnname {$column}  at {$file} query  {$matches[0][$i]}<br/>";
			exit();
			continue;
		}
		//Inc_Var::vardump($matches);
		$columnTmp = $classTable[$cName]['columns'][$column];
		$columnTmp = "/*#".$columnTmp."*/ = ".$value.";";
	
		$tmpCompile = str_replace($matches[0][$i],$columnTmp,$tmpCompile);
	}
	// $this->IsModify()
	preg_match_all('/'.RESOLVEVAR.'\->IsModify\(("|\')(.+?)("|\')\)/i', $tmpCompile, $matches);
	for($i=0;$i<count($matches[0]);$i++){	
		$cName = $matches[2][$i];
		$column = $matches[4][$i];
		if($classTable[$cName]['columns'][$column]==''){
			echo "Invalid columnname {$column}  at {$file} query  {$matches[RESOLVEVAR0][$i]}<br/>";
			exit();
			continue;
		}
		//$columnTmp = $classTable[$className]['columns'][$column];
		$columnTmp = "/*#bool*/";
	
		$tmpCompile = str_replace($matches[0][$i],$columnTmp,$tmpCompile);
	}
	

	

	do{
		// /*@CLASS*/->Function
		$anymatch = false;
		while(preg_match_all('/'.RESOLVEVAR.'\->'.FUNCNAME.'\((('.RESOLVEVAR.'|)*)\)/i', $tmpCompile, $matches)){
			for($i=0;$i<count($matches[0]);$i++){	
				$cName = $matches[2][$i];
				$column = $matches[3][$i];
				$funcParam = $matches[4][$i];
				if($classTable[$cName]['return'][$column]==''){
					echo "Invalid return define $cName::$column at {$file} query  {$matches[0][$i]}<br/>";
					Inc_Var::vardump($classTable[$cName]['return']);
					continue;
				}
				preg_match_all('/'.RESOLVEVAR.'[ ]*(,|$)/is', $funcParam, $args);
				$argClassAr = array();
				for($j=0;$j<count($args[0]);$j++){	
					$argClass = $args[2][$j];
					//$argClassAr[] = $argClass;
					if($classTable[$cName]['function_args'][$column][$j] != $argClass){
						echo "Invalid argument define ".$classTable[$cName]['function_args'][$column][$j]."!=".$argClass."  $cName::$column at {$file} query  {$matches[0][$i]}<br/>";
						//Inc_Var::vardump($classTable[$cName]['function_args'][$column]);
						//Inc_Var::vardump($args);
					}
				}
		
		


				$columnTmp = "/*#".$classTable[$cName]['return'][$column]."*/";
	
				$tmpCompile = str_replace($matches[0][$i],$columnTmp,$tmpCompile);
			}
			$anymatch = true;
		}


		// /*@CLASS*/->ATT
		preg_match_all('/'.RESOLVEVAR.'\->'.FUNCNAME.''.BREAKVAR.'/i', $tmpCompile, $matches);
		for($i=0;$i<count($matches[0]);$i++){	
			$cName = $matches[2][$i];
			$column = $matches[3][$i];
			if($classTable[$cName]['return'][$column]==''){
				echo "Invalid return define $cName::$column at {$file} query  {$matches[0][$i]}<br/>";
				Inc_Var::vardump($classTable[$cName]['return']);
				continue;
			}
			$columnTmp = "/*#".$classTable[$cName]['return'][$column]."*/";
	
			$tmpCompile = str_replace($matches[0][$i],$columnTmp,$tmpCompile);
		}
	}while($anymatch);


	// string "
	$tmpCompile = preg_replace('/"([^(\\")]+)"/s','/*#string*/',$tmpCompile);
	// string '
	$tmpCompile = preg_replace("/'([^(\\')]+)'/s",'/*#string*/',$tmpCompile);


	echo "<pre>";
	echo $tmpCompile;
	echo "</pre>";

	file_put_contents($outputdir."/{$fileQry[0]}_tmp.php",$tmpCompile);
	echo $outputdir."/{$fileQry[0]}_tmp.php";


}



