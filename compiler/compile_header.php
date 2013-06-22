<?
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');
include "../../framework/core/common.inc.php";


$path = "../model";
$dir_handle = @opendir($path) or die("Unable to open $path");

$outputdir = "../tmp/header";
if(!file_exists($outputdir)){
	mkdir($outputdir);
}

define(DECLAIRVAR,'(\/\*@([\w_:\{\},]+)\*\/)');
define(PARSEVAR,'(\/\*\(([\w_:\{\},]+)\)\*\/)');

define(T_FUNCTION_ARG,10001);
define(T_FUNCTION_BODY,10002);
define(T_BLACKET,10003);
define(T_SQBLACKET,10004);
define(T_STRING2,10005);
define(T_IF_EXPRESSION,10006);
define(T_ARRAY_BODY,10007);
define(T_CALL,10008);
define(T_CALL_BODY,10009);
define(T_PARSE,10010);
define(T_RESOLVEVAR,10011);
define(T_IF_BODY,10012);
define(T_IF_SHORT,10013);
define(T_COMPAIR,10014);
define(T_STRING_BODY,10015);
define(T_STRING_GLUE,10016);
define(T_BOOL_GLUE,10017);




?>
<style>
span{
	color:#CCCCCC;
	font-size:0.75em;
}
span.br{
	clear:both;
}

</style>

<?

class CompileStackAR{
	public $count = 0;
	public $blacketStack = array();
	public $tagStack = array();

	function push($id,$tagAR){
		//echo "$tagAR";
		if(!is_numeric($id))exit("Push string $id now allow");
	
		$this->blacketStack[$this->count] = $id;
		if(is_array($tagAR)){
			$this->tagStack[$this->count] = $tagAR;
		}else{
			$this->tagStack[$this->count] = array('TEXT'=>$tagAR);
		}
		$this->count++;
	}
	function dump(){
		for($i=0;$i<$this->count;$i++){
			$retArray[] = array($this->getTokenName($this->blacketStack[$i]),$this->nameStack[$i],$this->tagStack[$i]);
		}	
		$retArray[] = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
		for(;$i<count($this->blacketStack);$i++){
			$retArray[] = array($this->getTokenName($this->blacketStack[$i]),$this->nameStack[$i],$this->tagStack[$i]);
		}			
		return $retArray;
	}

	function pop($expected=0){
		if($expected>0 && $this->top()!=$expected){
			exit("Can't pop ".$this->getTokenName($this->top())." expected ".$this->getTokenName($expected));
		}
		$this->count--;
	}
	function top(){
		return $this->blacketStack[$this->count-1];
	}
	function over($level=0){
		return $this->blacketStack[$this->count+$level];
	}
	function overTag($key,$level=0){
		return $this->tagStack[$this->count+$level][$key];
	}
	function search($id){
		for($i=$this->count-1;$i>=0;$i--){
			if($this->blacketStack[$i]==$id){
				return $this->tagStack[$i];
			}
		}
		return NULL;
	}

	function setTag($key,$val){
		$this->tagStack[$this->count-1][$key] = $val;
	}
	function getTag($key){
		return $this->tagStack[$this->count-1][$key];
	}


	function getTokenName($id){
		switch($id){
			case T_FUNCTION_ARG:
				return 'T_FUNCTION_ARG';
			case T_FUNCTION_BODY:
				return 'T_FUNCTION_BODY';
			case T_BLACKET:
				return 'T_BLACKET';
			case T_SQBLACKET:
				return 'T_SQBLACKET';
			case T_STRING2:
				return 'T_STRING2';
			case T_IF_EXPRESSION:
				return 'T_IF_EXPRESSION';
			case T_ARRAY_BODY:
				return 'T_ARRAY_BODY';
			case T_CALL:
				return 'T_CALL';
			case T_CALL_BODY:
				return 'T_CALL_BODY';
			case T_PARSE:
				return 'T_PARSE';
			case T_RESOLVEVAR:
				return 'T_RESOLVEVAR';
			case T_IF_BODY:
				return 'T_IF_BODY';
			case T_IF_SHORT:
				return 'T_IF_SHORT';
			case T_COMPAIR:
				return 'T_COMPAIR';
			case T_STRING_BODY:
				return 'T_STRING_BODY';
			case T_STRING_GLUE:
				return 'T_STRING_GLUE';
			case T_BOOL_GLUE:
				return 'T_BOOL_GLUE';


			default:
				if(is_string($id))return $id;
				$ret = token_name($id);
				if($ret=="UNKNOWN")return "UNKNOWN[$id]";
				return $ret;		}
	}
	
}
class CompileStack{
	public $count = 0;
	public $blacketStack = array();
	public $nameStack = array();
	public $tagStack = array();

	function push($id,$name='',$tag=''){
		$this->blacketStack[$this->count] = $id;
		$this->nameStack[$this->count] = $name;
		$this->tagStack[$this->count] = $tag;
		$this->count++;
		return $this->count;
		//echo "<ul>";
		//Inc_Var::vardump($this->blacketStack);
	}
	function dump(){
		for($i=0;$i<$this->count;$i++){
			$retArray[] = array($this->getTokenName($this->blacketStack[$i]),$this->nameStack[$i],$this->tagStack[$i]);
		}	
		$retArray[] = "XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX";
		for($i=0;$i<count($this->blacketStack);$i++){
			$retArray[] = array($this->getTokenName($this->blacketStack[$i]),$this->nameStack[$i],$this->tagStack[$i]);
		}	
		return $retArray;
	}
	function pop(){
		$this->count--;
		//echo "</ul>";
	}
	function popTag(){
		$this->count--;
		return $this->tagStack[$this->count];
	}	
	function top(){
		return $this->blacketStack[$this->count-1];
	}
	function topTag(){
		return $this->tagStack[$this->count-1];
	}
	function setTag($val){
		$this->tagStack[$this->count-1] = $val;
	}

	function getTokenName($id){
		switch($id){
			case T_FUNCTION_ARG:
				return 'T_FUNCTION_ARG';
			case T_FUNCTION_BODY:
				return 'T_FUNCTION_BODY';
			case T_BLACKET:
				return 'T_BLACKET';
			case T_SQBLACKET:
				return 'T_SQBLACKET';
			case T_STRING2:
				return 'T_STRING2';
			case T_IF_EXPRESSION:
				return 'T_IF_EXPRESSION';
			case T_ARRAY_BODY:
				return 'T_ARRAY_BODY';
			case T_CALL:
				return 'T_CALL';
			case T_CALL_BODY:
				return 'T_CALL_BODY';
			case T_PARSE:
				return 'T_PARSE';
			case T_RESOLVEVAR:
				return 'T_RESOLVEVAR';
			case T_IF_BODY:
				return 'T_IF_BODY';
			case T_IF_SHORT:
				return 'T_IF_SHORT';
			case T_COMPAIR:
				return 'T_COMPAIR';
			case T_STRING_BODY:
				return 'T_STRING_BODY';
			case T_STRING_GLUE:
				return 'T_STRING_GLUE';				
			case T_BOOL_GLUE:
				return 'T_BOOL_GLUE';
				
			default:
				if(is_string($id))return $id;
				$ret = token_name($id);
				if($ret=="UNKNOW")return "UNKNOW[$id]";
				return $ret;
		}
	}
	function topTokenName(){
		return $this->getTokenName($this->blacketStack[$this->count-1]);
	}
	function search($id){
		for($i=$this->count-1;$i>=0;$i--){
			if($this->blacketStack[$i]==$id){
				return $this->nameStack[$i];
			}
		}
		return NULL;
	}
	function appendTag($id,$tag){
		for($i=$this->count-1;$i>=0;$i--){
			if($this->blacketStack[$i]==$id){
				$this->tagStack[$i].=$tag;
				echo $tag;
				return;
			}
		}
		exit("NO $id in stack");
	}
}
class CompileVariable{
	private $currentLevel = 0;
	private $varTable = array();
	function declair($name,$type){
		for($i=$this->currentLevel;$i>=0;$i--){
			if($this->varTable[$i][$name]!=''){
				exit("Declair variable exist name:$name type:".$this->varTable[$i][$name]." type:$type");
			}
		}
		$this->varTable[$this->currentLevel][$name] = $type;
	}
	function check($name){
		for($i=$this->currentLevel;$i>=0;$i--){
			if($this->varTable[$i][$name]!=''){
				return $this->varTable[$i][$name];
			}
		}
		return NULL;
	}
	function openLevel(){
		$this->currentLevel++;
	}
	function closeLevel(){
		$this->varTable[$this->currentLevel] = array();
		$this->currentLevel--;
	}
	function dump(){
		Inc_Var::vardump($this->varTable);
	}
}
function CompileHeader($fullpath){
	global $compileList;
	global $classInfo;
	global $compileQueue;
	if($compileList[$fullpath])return;
	$compileList[$fullpath]=true;
	//echo "CompileHeader($fullpath)<br/>";
	

	$fileDir = explode("/",$fullpath);
	$file = $fileDir[count($fileDir)-1];
	$fileQry = explode(".",$file);
	if(substr($file,0,3)=='md_' && $fileQry[count($fileQry)-1]=="php" && substr($fullpath,strlen($fullpath)-8,8)!='_ext.php' && $fileQry[0]!='md_tool_link'){
		$class = $fileQry[0];
		include_once $fullpath;
		$obj = new $fileQry[0];
		$className = get_class($obj);
		$classColumns = $obj->GetColumnArrayFull();
		foreach($classColumns as $column=> $type){
			if($type=='varchar')$type = 'string';
			if($type=='text')$type = 'string';
			if($type=='num')$type = 'int';
			if($type=='auto')$type = 'DBID';
			
			
			
			$optionindex = strpos($type,'|');
			if($optionindex>0){
				$option = substr($type,$optionindex+1);
				$type = substr($type,0,$optionindex);
				if(substr($type,0,strlen('enum'))=='enum'){
					$classInfo[$className]['ENUM'][$column] = $option;
					$classInfo[$className]['RETURN']['$'.$column] = "$className>E>$column";
					$classInfo[$className]['COLUMN'][$column] = "$className>E>$column";
				}elseif(substr($type,0,strlen('set'))=='set'){
					$classInfo[$className]['SET'][$column] = $option;
					$classInfo[$className]['RETURN']['$'.$column] = "$className>S>$column";
					$classInfo[$className]['COLUMN'][$column] = "$className>S>$column";
				}else{
					exit("Compiler not implement column type $type yet");
				}
			}else{
				$classInfo[$className]['RETURN']['$'.$column] = $type;
				$classInfo[$className]['COLUMN'][$column] = $type;
			}

		}
	}


	$readfile = file_get_contents($fullpath);
	$tokens = token_get_all($readfile);

	$cpStack = new CompileStack();

	for($tokenindex=0;$tokenindex<count($tokens);$tokenindex++){
		$token = $tokens[$tokenindex];

		if (is_string($token)) {
			// simple 1-character token
			switch($token){
				case '(':
					switch($cpStack->top()){
						case T_STRING:			/*ignore any () in string*/break;
						case T_ARRAY:			break;
						case T_FUNCTION_BODY:	$cpStack->push(T_BLACKET);											break;
						case T_BLACKET:			$cpStack->push(T_BLACKET);											break;
						case T_SQBLACKET:		$cpStack->push(T_BLACKET);											break;
						case T_FUNCTION:		$cpStack->push(T_FUNCTION_ARG,$cpStack->search(T_FUNCTION));		break;
						default:				echo "Unable to open ( in ".$cpStack->topTokenName()." $errorPos ";			exit();
					}
					break;
				case ')':
					switch($cpStack->top()){
						case T_STRING:			/*ignore any () in string*/break;
						case T_BLACKET:			$cpStack->pop();													break;
						case T_INCLUDE_ONCE:	$cpStack->pop();													break;
						case T_ARRAY:			$cpStack->pop();													break;
						case T_FUNCTION_ARG:	$cpStack->pop();													break;
						default:				echo "Unable to close ) in  ".$cpStack->topTokenName()." $errorPos ";			exit();
					}
					break;
				case ';':
					switch($cpStack->top()){
						case T_OPEN_TAG:		/*ignore <?php*/break;
						case T_FUNCTION_BODY:	/*ignore <?php*/break;
						case T_BLACKET:			/*ignore <?php*/break;
						case T_CLASS:			/*ignore <?php*/break;
						case T_FUNCTION:		$cpStack->pop();													break;
						default:				echo "Unable use ; in  ".$cpStack->topTokenName()." $errorPos";			exit();
					}
					break;
				case ',':
					break;
				case '=':
					break;
				case '{':
					switch($cpStack->top()){
						case T_BLACKET:			$cpStack->push(T_BLACKET);											break;
						case T_FUNCTION_BODY:	$cpStack->push(T_BLACKET);											break;
						case T_CLASS:																				break;
						case T_FUNCTION:		$cpStack->push(T_FUNCTION_BODY,$cpStack->search(T_FUNCTION));		break;
						default:				echo "Unable to open { in ".$cpStack->topTokenName()." $errorPos ";			exit();
					}
					break;
				case '}':
					switch($cpStack->top()){
						case T_STRING:																				break;
						case T_BLACKET:			$cpStack->pop();													break;
						case T_CLASS:			$cpStack->pop();													break;
						case T_FUNCTION_BODY:	$cpStack->pop();$cpStack->pop();									break;
						default:				echo "Unable to close } in ".$cpStack->topTokenName()." $errorPos ";Inc_Var::vardump($cpStack->dump());			exit();
					}
					break;
				case '[':
					switch($cpStack->top()){
						case T_STRING:			break;
						case T_SQBLACKET:		$cpStack->push(T_SQBLACKET);										break;
						case T_BLACKET:			$cpStack->push(T_SQBLACKET);										break;
						case T_FUNCTION_BODY:	$cpStack->push(T_SQBLACKET);										break;
						default:				echo "Unable to open [ in ".$cpStack->topTokenName()." $errorPos ";			exit();
					}
					break;
				case ']':
					switch($cpStack->top()){
						case T_STRING:			break;
						case T_SQBLACKET:		$cpStack->pop();													break;
						default:				echo "Unable to close ] in ".$cpStack->topTokenName()." $errorPos ";			exit();
					}
					break;
				case '"':
					if($cpStack->top()==T_STRING){
						$cpStack->pop();
					}else{
						$cpStack->push(T_STRING);
					}
					break;
				case "'":
					if($cpStack->top()==T_STRING2){
						$cpStack->pop();
					}else{
						$cpStack->push(T_STRING2);
					}
					break;

				case '&':
					switch($cpStack->top()){
						case T_FUNCTION_BODY:	break;
						case T_FUNCTION_ARG:	echo "Variable not define type ".$cpStack->topTokenName()." $errorPos ";	exit();
						default:				echo "Unable use & in ".$cpStack->topTokenName()." $errorPos ";			exit();
					}
					break;
				case '!':
				case '.':
				case '>':
				case '<':
				case ':':
				case '+':
				case '-':
				case '*':
				case '/':
				case '%':
				case '@':
					break;

				default:
					echo "STRING ".$token;
					exit();
					break;
			}
		} else {
			// token$compileList array
			list($id, $text,$linenum) = $token;
			$tokenname = token_name($id);
			$errorPos = "$fullpath at line $linenum";
			switch ($id) { 
				case T_VARIABLE:
					switch($cpStack->top()){
						case T_ARRAY:			/* variable in array	*/ 	break;
						case T_STRING:			/* variable in string	*/ 	break;
						case T_SQBLACKET:		/* [$var]				*/ 	break;
						case T_FUNCTION_BODY:	break;
						case T_BLACKET:			break;
						case T_OPEN_TAG:		echo "Warning to define var $text as global. Please use <b>Conf()->$text</b> $errorPos<br/><br/>";	break;
						case T_BLACKET:			break;
						case T_FUNCTION_ARG :	echo "Unable to define var $text without type. Use <b>/*@type*/$text</b> $errorPos";	exit();
						default:				echo "Unable to define var $text without type in ".$cpStack->topTokenName().". Use <b>/*@type*/$text</b> $errorPos";	exit();
					}
					break;

				case T_ENCAPSED_AND_WHITESPACE:
					switch($cpStack->top()){
						case T_STRING:			break;
						default:				echo "Unable to use string in  ".$cpStack->topTokenName()." $errorPos";	exit();
					}
					break;
				case T_DOUBLE_COLON:
					switch($cpStack->top()){
						case T_BLACKET:			break;
						case T_FUNCTION_BODY:	break;
						default:				echo "Unable to use T_DOUBLE_COLON :: in  ".$cpStack->topTokenName()." $errorPos";	exit();
					}
					break;
				case T_STRING:
					switch($cpStack->top()){
						case T_OPEN_TAG:		do{	$token = $tokens[++$tokenindex]; }while($token!=';');break;
						case T_CLASS:			do{	$token = $tokens[++$tokenindex]; }while($token!=';');break;
						case T_SQBLACKET:		break;
						case T_BLACKET:			break;
						case T_STRING:			/* " $var->T_STRING " */break;
						case T_FUNCTION_BODY:	break;
						case T_FUNCTION_ARG:	break;
						case T_ARRAY :			break;
						default:				echo "Unable to use T_STRING $text in  ".$cpStack->topTokenName()." $errorPos";	exit();
					}
					break;
				case T_DNUMBER:
				case T_ECHO:
				case T_ABSTRACT:
				case T_PLUS_EQUAL:
				case T_CONCAT_EQUAL:
				case T_GLOBAL:
				case T_ISSET:
				case T_UNSET:
				case T_IS_SMALLER_OR_EQUAL:
				case T_IS_NOT_EQUAL:
				case T_IS_NOT_IDENTICAL:
				case T_IS_GREATER_OR_EQUAL:
				case T_IS_IDENTICAL:
				case T_OR_EQUAL:
				case T_AND_EQUAL:
				case T_BOOLEAN_OR:
				case T_BOOLEAN_AND:
				case T_OBJECT_OPERATOR:
				case T_LNUMBER:
				case T_NEW:
				case T_IS_EQUAL:
				case T_AS:
				case T_EXIT:
				case T_INC:
				case T_IF:
				case T_ELSE:
				case T_ELSEIF:
				case T_FOR:
				case T_FOREACH:
				case T_CASE:
				case T_SWITCH:
				case T_DEFAULT:
				case T_BREAK:
				case T_WHILE:
				case T_CONTINUE:
				case T_STATIC:
				case T_PUBLIC:
				case T_PRIVATE:
				case T_PROTECTED:
				case T_RETURN:
				case T_WHITESPACE:
				case T_CURLY_OPEN: /* "{$var}" */
				case T_DEC:
				case T_LOGICAL_OR:
				
					break;
				case T_ARRAY:
					$cpStack->push(T_ARRAY);
					break;
				case T_CONSTANT_ENCAPSED_STRING:
				case T_DOUBLE_ARROW:
					break;
				case T_INCLUDE:
				case T_INCLUDE_ONCE:
					$token = $tokens[++$tokenindex];
					if(is_string($token))$token = $tokens[++$tokenindex];
					list($id, $text,$linenum) = $token;
					if($id==T_CONSTANT_ENCAPSED_STRING){
						$cpStack->push(T_INCLUDE_ONCE);
						//CompileHeader(substr($text,1,strlen($text)-2));
						$compileQueue[] = substr($text,1,strlen($text)-2);
					}else{
						exit("Compile error $text not file name ".$cpStack->topTokenName()." $errorPos");
					}
					break;
				case T_OPEN_TAG:
					$cpStack->push(T_OPEN_TAG);
					//echo "Open PHP<br/>";
					break;
				case T_CLOSE_TAG:
					//echo "Close PHP<br/>";
					$cpStack->pop();
					break;
				case T_CLASS:
					
					$token = $tokens[++$tokenindex];
					$token = $tokens[++$tokenindex];
					list($id, $text,$linenum) = $token;
					$tokenname = token_name($id);
					if($id==T_STRING){
						//echo "Compile Class ".$text."<br/>";
						$cpStack->push(T_CLASS,$text);
					}else{
						exit("Compile error $text not class name $errorPos");
					}	
					break;
				case T_FUNCTION:
					
					$token = $tokens[++$tokenindex];
					$token = $tokens[++$tokenindex];
					list($id, $text,$linenum) = $token;
					$tokenname = token_name($id);
					if($id==T_COMMENT && preg_match('/'.DECLAIRVAR.'/',$text,$match)){
						$type = $match[2];
					}else{
						exit("No return type defined of function $text. Use function /*@type*/$text $errorPos");
					}	
					$token = $tokens[++$tokenindex];
					list($id, $text,$linenum) = $token;
					$tokenname = token_name($id);
					if($id==T_STRING){
						$classname = $cpStack->search(T_CLASS);
						if($classInfo[$classname]['RETURN'][$text]==''){
							$classInfo[$classname]['RETURN'][$text] = $type;
							//Inc_Var::vardump($classInfo);
						}else{
							echo "Variable exist $text in $classname $errorPos";
							exit();
						}
						//echo "Compile Function ".$text." [return $type]<br/>";
					$cpStack->push(T_FUNCTION,$text);
					}else{
						exit("Compile error $text not class name $errorPos");
					}	

					//Inc_Var::vardump($cpStack);
					
					break;
					//Inc_Var::vardump($text);exit();
				case T_EXTENDS:
					$token = $tokens[++$tokenindex];
					$token = $tokens[++$tokenindex];
					list($id, $text,$linenum) = $token;
					$tokenname = token_name($id);
					if($id==T_STRING){
						$classname = $cpStack->search(T_CLASS);
						$classInfo[$classname]['EXTENDS'] = $text;
					}else{
						exit("Compile error $text not class name $errorPos");
					}	
					break;
				case T_COMMENT:
					if(preg_match('/'.DECLAIRVAR.'/',$text,$match)){
						$type = $match[2];
						$token = $tokens[++$tokenindex];
						if($token=='&')$token = $tokens[++$tokenindex];
						list($id, $text,$linenum) = $token;
						if($id==T_VARIABLE){
							switch($cpStack->top()){
								case T_CLASS:
									//$text = str_replace("$","",$text);
									$classname = $cpStack->search(T_CLASS);
									if($classInfo[$classname]['RETURN'][$text]==''){
										$classInfo[$classname]['RETURN'][$text] = $type;
									}else{
										echo "Variable exist $text in $classname $errorPos";
										Inc_Var::vardump($classInfo);
										exit();
									}
									break;
								case T_FUNCTION_ARG:
									$classname = $cpStack->search(T_CLASS);
									$functionname = $cpStack->search(T_FUNCTION);
									if($classInfo[$classname]['PARAMS'][$functionname]!=""){
										$ar = explode(" ",$classInfo[$classname]['PARAMS'][$functionname]);
									}else{
										$ar = array();
									}	
									$ar[] = $type;
									$classInfo[$classname]['PARAMS'][$functionname] = implode(" ",$ar);
									break;
								case T_BLACKET: 
								case T_FUNCTION_BODY:
									/*ignore any variable define in function*/
									break;
								default:
									echo "Unable to add variable $type $text in ".$cpStack->topTokenName();
									//Inc_Var::vardump($cpStack);
									exit();
							}							
						}else{
							exit("Compile error $text not variable name after define $match[0] $errorPos");
						}
					}
					
					break;
				default:
					// anything else -> output "as is"
					echo $tokenname ." ".$text." #".$linenum;
					exit();
					break;
			}
			//echo $tokenname ." ".$text." #".$linenum;
		}
	}

}


function CompileStatement($statement,$cpStack,$varStack,$varTable){
	global $classInfo;
	//exit("ST ".$statement);
	$tokens = token_get_all("<? ".$statement .".?>");
	
	for($tokenindex=0;$tokenindex < count($tokens);$tokenindex++){
		$token = $tokens[$tokenindex];
		if (is_string($token)) {
			switch($token){
				default:
					echo "STRING ".$token;
					exit();
					break;
			}
		}else{
			list($id, $text,$linenum) = $token;
			$tokenname = token_name($id);
			switch ($id) {
 				case T_OPEN_TAG:
				case T_CLOSE_TAG:
				case T_WHITESPACE:
					break;
 				case T_ARRAY:
					return 'array';
 				case T_COMMENT:
					if(preg_match('/'.PARSEVAR.'/',$text,$match)){
						$type = $match[2];
						$token = $tokens[++$tokenindex];
						if($token=='&')$token = $tokens[++$tokenindex];
						list($id, $text,$linenum) = $token;
						$tokenname = token_name($id);
						if(preg_match('/(MD_.+):columnarray/',$type,$match2)){
							switch($id){
								case T_ARRAY:
									// TODO validate array format
									return $type;
								default:
									exit("Compile error can't parse $tokenname $text to columnarray not variable name after define $match[0] $errorPos");
							}
						}elseif(preg_match('/(UNIQUEARRAY)/',$type,$match2)){
							switch($id){
								case T_ARRAY:
									// TODO validate array format
									return $type;
								default:
									exit("Compile error can't parse $tokenname $text to columnarray not variable name after define $match[0] $errorPos");
							}
						}elseif(preg_match('/(INDEXARRAY)/',$type,$match2)){
							switch($id){
								case T_ARRAY:
									// TODO validate array format
									return $type;
								default:
									exit("Compile error can't parse $tokenname $text to columnarray not variable name after define $match[0] $errorPos");
							}
						}elseif(preg_match('/(CLASSNAME)/',$type,$match2)){
							switch($id){
								case T_CONSTANT_ENCAPSED_STRING:
									// TODO validate classname format
									return $type;
								default:
									exit("Compile error can't parse $tokenname $text to columnarray not variable name after define $match[0] $errorPos");
							}
						}else{
						
							switch($id){
								default:
									exit("Compile error can't parse $tokenname $text to $type not variable name after define $match[0] $errorPos");
							}
						}	
					}
					return;
				case T_STRING:
					$classname = '';
					switch($text){
						case 'parent':
						case 'self':
							$classname = $cpStack->search(T_CLASS);
							if($text=='parent'){
								$c = $classname;
								$classname = $classInfo[$c]['EXTENDS'];
								if($classname=='')exit("no extends to $c");
							}
						default:
							if($classname=='')
								$classname = $text;

							$token = $tokens[++$tokenindex]; //::
							if($token[0]!==T_DOUBLE_COLON)exit("no T_DOUBLE_COLON ".$statement);
							$token = $tokens[++$tokenindex]; //function
							list($id, $text,$linenum) = $token;
							$tokenname = token_name($id);
							switch($id){
								case T_STRING:
								case T_VARIABLE:
									$functionname = $text;
									if($classInfo[$classname]['RETURN'][$functionname]==''){
										echo "Compile error no return type of $classname $functionname $errorPos<br/> please extern \$classInfo['$classname']['RETURN']['$functionname']";	exit();
									}
									$retType = $classInfo[$classname]['RETURN'][$functionname];
									if($id==T_STRING){
										$param = $classInfo[$classname]['PARAMS'][$functionname];
										$params = explode(" ",$param);
										$cpStack->push(T_IF,$params[0]);
										for($tokenindex++;$tokenindex<count($tokens);$tokenindex++){
											$token = $tokens[$tokenindex];
											Inc_Var::vardump($token);
										}
										Inc_Var::vardump($params);
										Inc_Var::vardump($varTable);
										Inc_Var::vardump($cpStack->dump());
										exit("I AM HERE $classname $functionname");
									}
									return $retType;
									break;
								default:
									echo "CompileStatement T_STRING > self >".$text." $tokenname ";
									exit();
							}
							echo "CompileStatement T_STRING > ".$text." ";
							exit();
					}
					break;				
				case T_CONSTANT_ENCAPSED_STRING:
					return 'string';
				default:
					echo "CompileStatement ".$tokenname ." ".$text." ";
					exit();
					break;
			}
		}
	}
	
}
function CompileBody($fullpath){
	global $compileBodyList;	
	global $classInfo;
	if($compileBodyList[$fullpath])return;
	$compileBodyList[$fullpath]=true;


	$readfile = file_get_contents($fullpath);
	$tokens = token_get_all($readfile);

	$cpStack = new CompileStack();
	$varStack = new CompileStack();
	$varTable = new CompileVariable();

	for($tokenindex=0;$tokenindex < count($tokens);$tokenindex++){
		$token = $tokens[$tokenindex];
		if (is_string($token)) {
			if($cpStack->top()==T_IF_EXPRESSION){
				switch ($token) {
					case '(': 
						$cpStack->appendTag(T_IF,$token);
						$cpStack->push(T_IF_EXPRESSION);
						break;
					case ')': 
						$cpStack->appendTag(T_IF,$token);
						$cpStack->pop();
						if($cpStack->top()==T_IF){
							//Inc_Var::vardump($cpStack);
							$statement = $cpStack->topTag();
							if(CompileStatement($statement,$cpStack,$varStack,$varTable)!='bool')
								exit("bool not return in $statement");
							exit('I AM HERE '.$statement);
						}
						break;
					case ',':
						$cpStack->appendTag(T_IF,$token);break;
					default:
						exit('appendx '.$token);
						$cpStack->appendTag(T_IF,$token);break;
				}
			}else{
				switch($token){
					case '(':
						switch($cpStack->top()){
							case T_IF:				$cpStack->push(T_IF_EXPRESSION);break;
							case T_FUNCTION:		$cpStack->push(T_FUNCTION_ARG,$cpStack->search(T_FUNCTION));$varTable->openLevel();		break;
							default:				echo "Unable to open ( in ".$cpStack->topTokenName()." $errorPos ";			exit();
						}
						break;
					case ')':
						switch($cpStack->top()){
							case T_FUNCTION_ARG:		$cpStack->pop();													break;
							default:				echo "Unable to close ) in  ".$cpStack->topTokenName()." $errorPos ";			exit();
						}
						break;
					case ';':
						switch($cpStack->top()){
							default:				echo "Unable use ; in  ".$cpStack->topTokenName()." $errorPos";			exit();
						}$tokens = token_get_all($readfile);
						break;
					case ',':
						break;
				
					case '=':
						switch($varStack->top()){
							case T_VARIABLE:
								$statement = '';
								do{	
									$token = $tokens[++$tokenindex];
									if(is_string($token)){
										$statement .= $token;
									}else{
										list($id, $text,$linenum) = $token;
										$statement .= $text;
									}
								}while($token!=';');
							
								$type1 = $varStack->topTag();
								$type2 = CompileStatement($statement,$cpStack,$varStack,$varTable);
								if($type1 != $type2){
									echo "Compile error ".$type1 ." != ".$type2.". $errorPos";	exit();
								}
								break;
							default:				echo "Unable use = in C ".$varStack->cpTokenName()." V ".$varStack->topTokenName().". $errorPos";	exit();
						}
						break;
					case '{':
						switch($cpStack->top()){
							case T_FUNCTION:		$cpStack->push(T_FUNCTION_BODY,$cpStack->search(T_FUNCTION));	break;
							default:				echo "Unable to open { in ".$cpStack->topTokenName()." $errorPos ";			exit();
						}
						break;
					case '}':
						switch($cpStack->top()){
							case T_FUNCTION_BODY:	$cpStack->pop();$cpStack->pop();$varTable->closeLevel();	break;
							default:				echo "Unable to close } in ".$cpStack->topTokenName()." $errorPos ";Inc_Var::vardump($cpStack->dump());			exit();
						}
						break;
					case '[':
						switch($cpStack->top()){
							default:				echo "Unable to open [ in ".$cpStack->topTokenName()." $errorPos ";			exit();
						}
						break;
					case ']':
						switch($cpStack->top()){
							default:				echo "Unable to close ] in ".$cpStack->topTokenName()." $errorPos ";			exit();
						}
						break;
					case '"':
						/*if($cpStack->top()==T_STRING){
							$cpStack->pop();
						}else{
							$cpStack->push(T_STRING);
						}*/
						exit("Unable use & in ".$cpStack->topTokenName()." $errorPos");
						break;
					case "'":
						/*if($cpStack->top()==T_STRING2){
							$cpStack->pop();
						}else{
							$cpStack->push(T_STRING2);
						}*/
						exit("Unable use & in ".$cpStack->topTokenName()." $errorPos");
						break;

					case '&':
						switch($cpStack->top()){
							default:				echo "Unable use & in ".$cpStack->topTokenName()." $errorPos ";			exit();
						}
						break;
					case '!':
					case '.':
					case '>':
					case '<':
					case ':':
					case '+':
					case '-':
					case '*':
					case '/':
					case '%':
						break;

					default:
						echo "STRING ".$token;
						exit();
						break;
				}
			}
		} else {
			list($id, $text,$linenum) = $token;
			$tokenname = token_name($id);
			$errorPos = "$fullpath at line $linenum";
			if($cpStack->top()==T_IF_EXPRESSION){
				switch ($id) { 
					
					default:
						//echo "> ".$text;
						$cpStack->appendTag(T_IF,$text);break;
				}
			}else{
				switch ($id) { 
					case T_VARIABLE:
						switch($cpStack->top()){
							default:				echo "Unable to define var $text without type in ".$cpStack->topTokenName().". Use <b>/*@type*/$text</b> $errorPos";	exit();
						}
						break;

					case T_ENCAPSED_AND_WHITESPACE:
						switch($cpStack->top()){
							default:				echo "Unable to use string in  ".$cpStack->topTokenName()." $errorPos";	exit();
						}
						break;
					case T_DOUBLE_COLON:
						switch($cpStack->top()){
							default:				echo "Unable to use T_DOUBLE_COLON :: in  ".$cpStack->topTokenName()." $errorPos";	exit();
						}
						break;
					case T_STRING:
						switch($cpStack->top()){
							
							default:				echo "Unable to use T_STRING $text in  ".$cpStack->topTokenName()." $errorPos";	exit();
						}
						break;
					//case T_DNUMBER:
					//case T_ECHO:
					case T_ABSTRACT:
					//case T_PLUS_EQUAL:
					//case T_CONCAT_EQUAL:
					//case T_GLOBAL:
					//case T_ISSET:
					//case T_UNSET:
					//case T_IS_SMALLER_OR_EQUAL:
					//case T_IS_NOT_EQUAL:$classInfo[$classname]['RETURN'][$functionname]
					//case T_IS_NOT_IDENTICAL:
					//case T_IS_IDENTICAL:
					//case T_OR_EQUAL:
					//case T_AND_EQUAL:
					//case T_BOOLEAN_OR:
					//case T_BOOLEAN_AND:
					//case T_OBJECT_OPERATOR:
					//case T_LNUMBER:
					//case T_NEW:
					//case T_IS_EQUAL:
					//case T_AS:
					//case T_EXIT:
					//case T_INC:
					//
					//case T_ELSE:
					//case T_ELSEIF:
					//case T_FOR:
					//case T_FOREACH:
					//case T_CASE:
					//case T_SWITCH:
					//case T_DEFAULT:
					//case T_BREAK:
					//case T_WHILE:
					//case T_CONTINUE:
					case T_STATIC:
					case T_WHITESPACE:
					//case T_CURLY_OPEN: 
					//case T_ARRAY:
					//case T_CONSTANT_ENCAPSED_STRING:
					//case T_DOUBLE_ARROW:
					case T_PUBLIC:
					case T_PRIVATE:
					case T_PROTECTED:
					case T_OPEN_TAG:
					case T_CLOSE_TAG:
						break;
					case T_IF:
						$cpStack->push(T_IF,'bool');
						break;
					case T_RETURN:
						$classname = $cpStack->search(T_CLASS);
						$functionname = $cpStack->search(T_FUNCTION);
						//Inc_Var::vardump($cpStack);
						if($classInfo[$classname]['RETURN'][$functionname]==''){
							echo "Compile error no return type of $classname $functionname $errorPos";	exit();
						}
						$returntype = $classInfo[$classname]['RETURN'][$functionname];
						$statement = '';
						do{	
							$token = $tokens[++$tokenindex];
							if(is_string($token)){
								$statement .= $token;
							}else{
								list($id, $text,$linenum) = $token;
								$statement .= $text;
							}
						}while($token!=';');
					
						$type1 = $returntype;
						$type2 = CompileStatement($statement,$cpStack,$varStack,$varTable);
						if($type1 != $type2){
							echo "Compile error return type ".$type1 ." != ".$type2.". $errorPos";	exit();
						}
						break;

					case T_INCLUDE_ONCE:
						do{	$token = $tokens[++$tokenindex]; }while($token!=';');
						break;
					case T_CLASS:
						$token = $tokens[++$tokenindex];
						$token = $tokens[++$tokenindex];
						list($id, $text,$linenum) = $token;
						$tokenname = token_name($id);
						if($id==T_STRING){
							//echo "Compile Class ".$text."<br/>";
							$cpStack->push(T_CLASS,$text);
							$varTable->openLevel();
							do{	$token = $tokens[++$tokenindex]; }while($token!='{');
						}else{
							exit("Compile error $text not class name $errorPos");
						}
						break;
				
					case T_FUNCTION:
					
						$token = $tokens[++$tokenindex];
						$token = $tokens[++$tokenindex];
						list($id, $text,$linenum) = $token;
						$tokenname = token_name($id);
						if($id==T_COMMENT && preg_match('/'.DECLAIRVAR.'/',$text,$match)){
							$type = $match[2];
						}else{
							exit("No return type defined of function $text. Use function /*@type*/$text $errorPos");
						}	
						$token = $tokens[++$tokenindex];
						list($id, $text,$linenum) = $token;
						$tokenname = token_name($id);
						if($id==T_STRING){
							$cpStack->push(T_FUNCTION,$text);
						}else{
							exit("Compile error $text not class name $errorPos");
						}	

						//Inc_Var::vardump($cpStack);
					
						break;
						//Inc_Var::vardump($text);exit();
					case T_COMMENT:
						if(preg_match('/'.DECLAIRVAR.'/',$text,$match)){
							$type = $match[2];
							$token = $tokens[++$tokenindex];
							if($token=='&')$token = $tokens[++$tokenindex];
							list($id, $text,$linenum) = $token;
							if($id==T_VARIABLE){
								$varTable->declair($text,$type);
								$varStack->push(T_VARIABLE,$text,$type);
							}else{
								exit("Compile error $text not variable name after define $match[0] $errorPos");
							}
						}
					
						break;
					default:
						echo $tokenname ." ".$text." $errorPos";
						exit();
						break;
				}
			}
		}
	}

}

class CompileHelper{
	public $filepath = '';
	private $cpStackAr = NULL;
	private $varTable = NULL;
	private $tokens = NULL;
	public $tokenIndex = -1;	
	
	public $token = NULL;
	public $tID = NULL;
	public $tName = NULL;
	public $tText = NULL;
	public $tLine = NULL;
	function CompileHelper($tokens){
		$this->tokens = $tokens;
		$this->cpStack = new CompileStack();
		$this->cpStackAr = new CompileStackAR();
		$this->varTable = new CompileVariable();
	}
	function SkipUntil($expect){
		do{	$this->NextToken(); }while($this->tID!=$expect);
	}
	function NextToken($checker=NULL){
		if($this->tokenIndex==count($this->tokens)-1){
			$this->tID = 0;
			$this->tName = NULL;
			$this->tText = NULL;
			return NULL;
		}
		$this->token = $this->tokens[++$this->tokenIndex];
		if(is_string($this->token)){
			$this->tID = $this->token;
			$this->tName = $this->token;
			$this->tText = $this->token;
			
		}else{
			list($this->tID, $this->tText,$this->tLine) = $this->token;
			$this->tName = token_name($this->tID);
			$this->ErrorPos = " at ".$this->filepath." line ".$this->tLine;
		}
		if($checker!=NULL && $this->tID!=$checker){
			$this->dump();
			if(is_string($checker)){
				exit("Checker=".$checker." ID=".$this->tName);
			}else{
				exit("Checker=".token_name($checker)." ID=".$this->tName);
			}
		}
		return $this->token;
	}
	function dump(){
		echo " tID[". $this->tID ."] tName[". $this->tName ."] tText[".$this->tText."] ".$this->ErrorPos."<br/>";
		////Inc_Var::vardump($this->cpStack->dump());
		echo "Top ".$this->cpStackAr->getTokenName($this->top())."<br/>";
		//Inc_Var::vardump($this->cpStackAr);
		Inc_Var::vardump($this->cpStackAr->dump());
		$this->varTable->dump();
	}
	/*function push($id,$name='',$tag=''){
		return $this->cpStackAr->push($id,array('NAME'=>$name,'TAG'=>$tag));
	}*/
	function push($id,$tagAR=NULL){
		echo "<span>[!".$this->cpStackAr->getTokenName($id).' '.$tagAR['TEXT']."]</span>";
		$ret = $this->cpStackAr->push($id,$tagAR);
		//Inc_Var::vardump($this->cpStackAr);
		return $ret;
	}
	function countStack(){
		return $this->cpStackAr->count;
	}
	function pop($expected=0){
		echo "<span>[^".$this->cpStackAr->getTokenName($this->top())."]</span>";
		
		if($this->top()==T_RETURN){
			$returntype = $this->overTag('TYPE'); 
			$expecttype = $this->getTag(T_FUNCTION,'TYPE');
			//$helper->dump();exit();
			//exit("$returntype XXXX $expecttype");
			$this->compairtype($expecttype,$returntype);
			
			
		}
		
		$this->cpStackAr->pop($expected);
	}
	function compairtype($expecttype,$returntype){
		if($expecttype=='' || $returntype==''){
			echo "<br/>Compile error: empty expecttype $expecttype returntype $returntype";
			$this->dump();exit();
		}
		global $classInfo;
		$bypass = false;
		if(strpos($expecttype,"string:")===0){
			$expecttype = 'string';
		}
		if($expecttype=='SQL' && strpos($returntype,"string")===0){
			$bypass = true;
		}



		if(preg_match("/(MD_[\w]+)>E>([\w\d_]+)/",$expecttype,$match)){
			$class = $match[1];
			$typename = $match[2];
			
			$allow = explode(',',$classInfo[$class]['ENUM'][$typename]);
			//Inc_Var::vardump($allow);
			$returntype = str_replace("string:","",$returntype);
			if(in_array($returntype,$allow)){
				$bypass = true;
			}
			
		}
		
		
		if($bypass){
		}elseif($returntype=='NULL'){
		}elseif($expecttype=='string' && strpos($returntype,"string:")===0){
		}elseif($expecttype=='ModelObject' && strpos($returntype,"MD_")==0 && strpos($returntype,"Array")===false){
		}elseif($returntype=='ModelObject' && strpos($expecttype,"MD_")==0 && strpos($expecttype,"Array")===false){
		}elseif($expecttype!=$returntype){
			echo "<br/>Compile error: expect return $expecttype but return $returntype";
			$this->dump();exit();
		}	
		echo "<span>[$expecttype=$returntype]</span>";
	}
	
	function top(){
		return $this->cpStackAr->top();
	}	
	function over($level=0){
		return $this->cpStackAr->over($level);
	}	
	function overTag($key,$level=0){	
		return $this->cpStackAr->overTag($key,$level);
	}
	function setTag($key,$val){
		return $this->cpStackAr->setTag($key,$val);
	}	
	function getTag($id,$key){
		for($i=$this->cpStackAr->count-1;$i>=0;$i--){
			if($this->cpStackAr->blacketStack[$i]==$id){
				return $this->cpStackAr->tagStack[$i][$key];
			}
		}
		return NULL;
	}	

	function topTag($key){
		return $this->cpStackAr->getTag($key);
	}	
	function popTag($key){
		return $this->cpStackAr->popTag($key);
	}	
	function declair($name,$type){
		echo "<span>[@".$name.":".$type."]</span>";
		return $this->varTable->declair($name,$type);
	}	
	function openLevel(){
		echo "<span>||+</span>";
		return $this->varTable->openLevel();
	}	
	function closeLevel(){
		echo "<span>+||</span>";
		return $this->varTable->closeLevel();
	}	
	function check($name){
		return $this->varTable->check($name);
	}	
	function resolveVar(){
		global $classInfo;
		$syn = array();
		$text = "";
		$allow = array(T_VARIABLE,T_STRING,T_NEW,T_OBJECT_OPERATOR,T_SQBLACKET,T_CONSTANT_ENCAPSED_STRING,T_STRING_GLUE);
		for($i=$this->cpStackAr->count-1;$i>=0;$i--){
			if(in_array($this->cpStackAr->blacketStack[$i],$allow)){
				if($this->cpStackAr->tagStack[$i]['TEXT']!=NULL){
					$syn[] = $this->cpStackAr->tagStack[$i]['TEXT'];
					$text = $this->cpStackAr->tagStack[$i]['TEXT'].$text;
				}else{
					$syn[] = $this->cpStackAr->getTokenName($this->cpStackAr->blacketStack[$i]);
					$text = $this->cpStackAr->getTokenName($this->cpStackAr->blacketStack[$i]).$text;
				}
				$this->pop();
			}else{
				break;
			}
		}		
		
		if(count($syn)==1){
			if(strpos($syn[0],'$')===0){
				//Inc_Var::vardump($syn[0]);
				$type = $this->check($syn[0]);
				if($type==''){
					$this->dump();
					echo "Compile error: variable name {$syn[0]} did not declair type";
					exit();
				}
			}elseif($syn[0]=='true' || $syn[0]=='TRUE' || $syn[0]=='false' || $syn[0]=='FALSE'){
				$type = 'bool';
			}elseif($syn[0]=='null' || $syn[0]=='NULL'){
				$type = 'NULL';
			}elseif($syn[0]=='substr'|| $syn[0]=='strtolower'){
				$type = 'string';
			}else{
				$type = 'CLASSNAME';
			}
		}elseif(count($syn)==2){
			if($syn[1]=="T_NEW"){
				$type = $syn[0];
			}elseif(strpos($syn[1],'$')===0){
				$type = 'array';
			}else{
				Inc_Var::vardump($syn);
				exit('1124');
			}
		}elseif(count($syn)==3){
		
			if($syn[1]==NULL){
				exit('666');
			}elseif($syn[1]=='::'){
				
				$class = $syn[2];
				if($class=='parent'){
					$childclass = $this->getTag(T_CLASS,'TEXT');
					$class = $classInfo[$childclass]['EXTENDS'];
				}elseif($class=='self'){
					$class = $this->getTag(T_CLASS,'TEXT');
				}
				$varname = $syn[0];
				$type = $classInfo[$class]['RETURN'][$varname];
				
				
				
				//Inc_Var::vardump($class);
				//Inc_Var::vardump($varname);
				//Inc_Var::vardump($type);
				//$this->dump();
			}elseif($syn[1]=='->'){
				//hardcode
				
				if(implode("",$syn)=='Execute->Qry'){
					$type = 'Void';
				}elseif(strpos($syn[2],'$')===0){
					
					$class = $this->check($syn[2]);
					if($syn[0]=='Get'){
						echo "Compile error: function Get not support anymore use magic var instead";
						$this->dump();
						exit();	
					}
					$type = $classInfo[$class]['RETURN']['$'.$syn[0]];
					if($type==''){
						$type = $classInfo[$class]['RETURN'][$syn[0]];
					}
					if($type==''){
						$class = $classInfo[$class]['EXTENDS'];
						$type = $classInfo[$class]['RETURN']['$'.$syn[0]];
					}
					if($type==''){
						$type = $classInfo[$class]['RETURN'][$syn[0]];
					}
				}elseif($text == 'Conf->global_unlock_writeable'){
					$type = 'bool';
				}else{
					Inc_Var::vardump($text);
					Inc_Var::vardump($syn);
					exit('779');
				}
			}elseif($syn[1]=='['){
				$type='array';
			}else{
				Inc_Var::vardump($syn);
				exit('777');
			}
		}elseif(count($syn)==5){
			if($syn[1]=='[' && ($syn[2]=='data'||$syn[2]=='olddata') && $syn[3]=='->' && $syn[4]=='$this'){
				$class = $this->getTag(T_CLASS,'TEXT');
				$type = $classInfo[$class]['RETURN']['$'.$syn[0]];
				//Inc_Var::vardump($class);
				//Inc_Var::vardump($type);
				//Inc_Var::vardump('$'.$syn[0]);
				//exit('ccccc');
			}else{
				Inc_Var::vardump($syn);
				exit('77ww');
			}
		}else{
			Inc_Var::vardump($syn);
			$this->dump();
			exit('234');
		}
		
		$this->cpStackAr->blacketStack[$i+1] = T_RESOLVEVAR;
		$this->cpStackAr->tagStack[$i+1]['TYPE'] = $type;				
		
		
		
		echo "<span>[Resolve $text as $type]</span>";
		if($this->top()==T_RETURN){
			$this->pop();
		}
		if($type=='string'){
			return $type.":".$text;
		}
		if($type==''){
			echo "Compile error: resolve fail for $text";
			$this->dump();
			exit();
		}
		
		return $type;
		//Inc_Var::vardump($syn);
		//exit();
		//return $this->varTable->check($name);
	}	
}
function ProcessToken($helper){
	global $classInfo;
	$helper->NextToken();
	//echo "<pre>";
	$tmp = $helper->tText;
	$tmp = htmlentities($tmp);
	$tmp = str_replace("\t","&nbsp;&nbsp;&nbsp;&nbsp;",$tmp);
	$tmp = str_replace(" ","&nbsp;",$tmp);
	$tmp = str_replace(array("\r\n","\n"),"<br>",$tmp);
	echo $tmp;
	//echo "</pre>";
	switch($helper->tID){
		case T_WHITESPACE:
			//while(($processtype=ProcessToken($helper))===true);
			//return $processtype;
			break;
		case T_PUBLIC:
		case T_STATIC:
			break;
		case T_INCLUDE_ONCE:
			$helper->push(T_INCLUDE_ONCE,$helper->tText);
			//$helper->SkipUntil(';');
			return true;
		case T_IF:
			$helper->push(T_IF,$helper->tText);
			$helper->push(T_IF_SHORT,'XXX');
			$helper->openLevel();
			//$level = $helper->countStack();
			//while($helper->countStack()>=level){
			//	ProcessToken($helper);
			//}			
			
			break;
		case T_ARRAY:
			$helper->push(T_ARRAY,$helper->tText);
			//TODO verify array body
			//while(($processtype=ProcessToken($helper))===true);
			//if($processtype!='array')exit($helper->tText." 2not array".$helper->dump());
			//return 'array';
			break;
		case T_OPEN_TAG:
			$helper->push(T_OPEN_TAG);
			break;
		case '.':
			switch($helper->top()){
				case T_STRING: 	
					$helper->push(T_STRING_GLUE,array('TEXT'=>$helper->tText));
					break;
				default:$helper->dump();exit();
			}
			break;
		case '=':
			switch($helper->top()){
				case T_VARIABLE: 	
					$type = $helper->getTag(T_VARIABLE,'TYPE');
					//echo "%%%% $type";
					if($type==''){
						$text = $helper->getTag(T_VARIABLE,'TEXT');
						$type = $helper->resolveVar();
						$helper->push(T_VARIABLE,array('TEXT'=>$text,'TYPE'=>$type));
					}
					$helper->push(T_COMPAIR,'=');
					break;
				case T_STRING: 	
					$type = $helper->resolveVar();
					$helper->push(T_VARIABLE,array('TEXT'=>$text,'TYPE'=>$type));
					$helper->push(T_COMPAIR,'=');
					break;				
				//$helper->push(T_OPEN_TAG);
				//T_COMPAIR
				default:
				$helper->dump();exit();
			}
			break;
			//return ProcessToken($helper);
		case T_ENCAPSED_AND_WHITESPACE:
			$helper->push(T_RESOLVEVAR,array('TEXT'=>$helper->tText,'TYPE'=>'string:'.$helper->tText));
			$helper->pop();
			break;
		case '"':
			switch($helper->top()){
				case T_COMPAIR: 	
				case T_RETURN: 	
					$helper->push(T_STRING_BODY,array('TEXT'=>$helper->tText,'TYPE'=>'string'));
					break;
				case T_STRING_BODY: 
					$helper->pop();
					$helper->push(T_RESOLVEVAR,array('TEXT'=>$helper->tText,'TYPE'=>'string'));
					//$helper->pop();
					break;
				default:
					$helper->dump();exit();
					break;
			}
			break;
		case '{':
			switch($helper->top()){
				case T_FUNCTION: 		$helper->push(T_FUNCTION_BODY); return true;
				case T_IF_SHORT: 		$helper->pop(T_IF_SHORT);$helper->push(T_IF_BODY); return true;
				
				//case T_IF: 			$helper->push(T_IF_BODY); return true;
				default:	$helper->dump();exit();
			}
			break;
		case '}':
			switch($helper->top()){
				case T_PARSE: 	$helper->pop(); break;
				case T_CONSTANT_ENCAPSED_STRING: 	$helper->pop(); break;
			}

			switch($helper->top()){
				case T_RETURN: 	
					$helper->pop();
					break;
			}

		
			switch($helper->top()){
				//case T_PARSE: 	$helper->pop();
			
				//case T_FUNCTION: 		$helper->pop();$helper->closeLevel(); 				return true;
				//case T_IF: 				$helper->pop();$helper->closeLevel(); 				return true;
				case T_IF_BODY: 		$helper->pop();$helper->pop();$helper->closeLevel(); return true;
				case T_FUNCTION_BODY: 	$helper->pop();$helper->pop();$helper->closeLevel(); return true;
				//case T_IF_BODY: 		$helper->pop();$helper->pop();$helper->closeLevel(); return true;
				default:	$helper->dump();exit();
			}
			break;
		case '(':
			switch($helper->top()){
				case T_ARRAY: 		$helper->push(T_ARRAY_BODY);$helper->push(T_BLACKET); break;
				default:			$helper->push(T_BLACKET); break;
			}
			break;
		case ')':
			
			switch($helper->top()){
				case T_BLACKET:			$helper->pop(); 
					
					if($helper->top()==T_ARRAY_BODY){
						$helper->pop();
						//$helper->pop();
						
					
					}
				
					break;	
				case T_ARRAY_BODY: 		$helper->pop();//$helper->pop();
					
					break;
				//default:	$helper->dump();exit();
				default:
				//$a=0;
					while($helper->top()!=T_BLACKET){
						//$helper->dump();
						$helper->pop();
						//exit();
						//if($a++>10)exit();
					}
					$helper->pop();
					
					if($helper->top()==T_ARRAY_BODY){
						$helper->pop();
						//$helper->pop();
						
					
					}					
				
			}

			switch($helper->top()){
				case T_PARSE: 			$helper->pop();break;
				//case T_INCLUDE_ONCE: 	$helper->pop();break;
				default;
			}			
			
			break;
		case T_DOUBLE_ARROW:
			switch($helper->top()){
				case T_CONSTANT_ENCAPSED_STRING: 	
					$helper->push(T_DOUBLE_ARROW);
					break;
				default:	$helper->dump();exit();
			}
			break;
		case ',':
			switch($helper->top()){
				case T_CONSTANT_ENCAPSED_STRING: 
					$helper->pop();
					if($helper->top()==T_DOUBLE_ARROW){
						$helper->pop();
						$helper->pop();
					}
				break;
				case T_LNUMBER: 	break;
				case T_VARIABLE: 	$helper->resolveVar(); break;
				case T_CALL_BODY: 	return true;
				case T_ARRAY_BODY: 	return $helper->topTag();
				case T_BLACKET: 	break;
				case T_STRING: 		$helper->resolveVar(); break;
				default:	$helper->dump();exit();
			}
			break;			
		case ';':
			switch($helper->top()){
				case T_PARSE:
					$type = $helper->getTag(T_PARSE,'TYPE');
					$helper->pop(T_PARSE);
					$helper->push(T_RESOLVEVAR,array('TYPE'=>$type));
					 break;	
				case T_ARRAY: 		
					//if($helper->top()==T_ARRAY){
						$helper->setTag('TYPE','ARRAY');
						$helper->pop();
					//}else{
					//	echo "Compile error: ; not outside array";
					//	$helper->dump();
					//	exit();
					//}
					break;
				case T_STRING: 		
				case T_VARIABLE: 		
					$helper->resolveVar();
					break;
				case T_LNUMBER:
				case T_RESOLVEVAR:
				case T_CONSTANT_ENCAPSED_STRING:
					$helper->pop();
					if($helper->top()==T_RETURN){
						$helper->pop();
					}
					break;
				case T_INCLUDE_ONCE: 	$helper->pop();break;
				default:	$helper->dump();exit();
			}
			
			if($helper->getTag(T_IF_SHORT,'TEXT')!=NULL){
				$helper->pop(T_IF_SHORT);
				$helper->pop(T_IF);
				$helper->closeLevel();
			}
			if($helper->getTag(T_COMPAIR,'TEXT')!=NULL){
				if($helper->top()==T_PARSE){
					$helper->pop(T_PARSE);
				}
				if($helper->top()==T_RESOLVEVAR){
					$helper->pop(T_RESOLVEVAR);
				}
				//$helper->dump();exit();
				$returntype = $helper->overTag('TYPE'); 
				$helper->pop(T_COMPAIR);
				$expecttype = $helper->topTag('TYPE');
				
				$helper->compairtype($expecttype,$returntype);
				$helper->pop(T_VARIABLE);
			}
			
			//$helper->dump();
			//$retType = $helper->popTag();
			//if($retType==NULL)
			//	return 'void';
			//return $retType;
			break;
			
		case T_OBJECT_OPERATOR:
			$helper->push(T_STRING,$helper->tText);
			break;
		case T_DOUBLE_COLON:
			$helper->push(T_STRING,$helper->tText);
			break;
		case '[':
			switch($helper->top()){
				case T_STRING: 	
					$helper->push(T_SQBLACKET,$helper->tText);
					break;
				case T_VARIABLE: 	
					if($helper->topTag('TYPE')!='array'){
						echo "Compile error: not allow [ for no array variable";
						$helper->dump();exit();
					}
					$helper->push(T_SQBLACKET,$helper->tText);
					break;
				default:	$helper->dump();exit();
			
			}
			break;
		case ']':
			switch($helper->top()){
				
				case T_CONSTANT_ENCAPSED_STRING: 	
					$type = $helper->resolveVar();
					$helper->push(T_VARIABLE,array('TEXT'=>'$'.'XXX','TYPE'=>$type));
					break;
				default:	$helper->dump();exit();
			
			}
			break;
		case T_STRING:
			$helper->push(T_STRING,$helper->tText);
			break;
			switch($helper->top()){
				case T_BLACKET: 	
				case T_CALL_BODY: 	
					$helper->push(T_STRING,$helper->tText);
					break;
				case T_CALL: 	
				case T_IF_EXPRESSION: 	
				case T_IF_BODY: 	
				case T_FUNCTION_BODY: 	
					if($helper->tText=='self'){
						$classname = $helper->getName(T_CLASS);
						$helper->NextToken(T_DOUBLE_COLON);
					}elseif($helper->tText=='parent'){
						$mclass = $helper->getName(T_CLASS);
						$classname = $classInfo[$mclass]['EXTENDS'];
						$helper->NextToken(T_DOUBLE_COLON);
					}else{
						$classname = $helper->tText;
						$helper->NextToken(T_DOUBLE_COLON);
					}
					$helper->NextToken();
					switch($helper->tID){
						case T_STRING : 
							$retType = $classInfo[$classname]['RETURN'][$helper->tText];
							$helper->push(T_CALL,$classname.":".$helper->tText,$retType);
							//echo("START");
							//$level = $helper->countStack();
							//while($helper->countStack()>=level){
							//	ProcessToken($helper);
							//}
							//exit("I AM HERE");
							//return $retType;
							break;
						case T_VARIABLE: 
							$retType = $classInfo[$classname]['RETURN'][$helper->tText];
							$helper->push(T_VARIABLE,$helper->tText,$retType);
							return true;//return ProcessToken($helper);
						default:	$helper->dump();exit('T_STRING > '.$helper->tName);
					}
					//$returnType = $classInfo[$classname][]
					
					break;
				default:	$helper->dump();exit();
			}
			//break;
			//$helper->dump();
			//exit("I AM HERE");
			break;
		case T_VARIABLE:
			switch($helper->top()){
				case T_STRING_BODY:
					break;
				default:
				//$retType = 'string';
				$retType = $helper->check($helper->tText);
				$helper->push(T_VARIABLE,array('TEXT'=>$helper->tText,'TYPE'=>$retType));
				//return ProcessToken($helper);	
			}
			break;
		case T_COMMENT:
			if(preg_match('/'.DECLAIRVAR.'/',$helper->tText,$match)){
				$type = $match[2];
				$helper->SkipUntil(T_VARIABLE);
				$helper->declair($helper->tText,$type);
				$helper->push(T_VARIABLE,array('TEXT'=>$helper->tText,'TYPE'=>$type));
				//while(($processtype=ProcessToken($helper))===true);
				//if($processtype!=$type)exit($helper->tText.$type);
				break;
			}
			if(preg_match('/'.PARSEVAR.'/',$helper->tText,$match)){
				$type = $match[2];
				$helper->push(T_PARSE,array('TYPE'=>$type));
				//$parsetype = $type;
				//while(($processtype=ProcessToken($helper))===true);
				//TODO check compatible 
				//echo "parseType $parsetype";
				//if($parsetype=='')exit("parse type empty");
				//return $parsetype;
			}
			
			break;		
		case T_NEW:
			$helper->push(T_NEW,'T_NEW');	
			break;
			
			
		case T_LNUMBER:
			$helper->push(T_LNUMBER,array('TEXT'=>substr($helper->tText,1,strlen($helper->tText)-2),'TYPE'=>'int'));
			break;
		case T_CONSTANT_ENCAPSED_STRING:
			$text = substr($helper->tText,1,strlen($helper->tText)-2);
			$helper->push(T_CONSTANT_ENCAPSED_STRING,array('TEXT'=>$text,'TYPE'=>'string:'.$text));
			//$retType = 'string';
			/*$helper->setTag($retType);
			while(($processtype=ProcessToken($helper))===true);
			if($processtype!=$retType)
				exit($helper->tText." 8not ".$retType.$helper->dump());*/
			//return $retType;
			break;
		case T_CLASS:
			$helper->NextToken(T_WHITESPACE);
			$helper->NextToken(T_STRING);
			$helper->push(T_CLASS,$helper->tText);
			$helper->openLevel();
			$helper->SkipUntil('{');
			break;
		case T_FUNCTION:
			$helper->SkipUntil(T_COMMENT);
			if(preg_match('/'.DECLAIRVAR.'/',$helper->tText,$match)){
				$type = $match[2];
			}
			$helper->SkipUntil(T_STRING);
			$helper->push(T_FUNCTION,array('TEXT'=>$helper->tText,'TYPE'=>$type));
			$helper->openLevel();
			break;
			
			
		case T_IS_EQUAL:
			$helper->resolveVar();
			$helper->push(T_IS_EQUAL,$helper->tText);
			break;
		case T_BOOLEAN_OR:
			$helper->resolveVar();
			//$helper->push(T_BOOL_GLUE,$helper->tText);
			break;
		case T_RETURN:
			$helper->push(T_RETURN,$helper->tText);
			/*
			$expect = $helper->getTag(T_FUNCTION);
			while(($returntype=ProcessToken($helper))===true);
			if($expect!==$returntype){
				echo "return type $returntype not match return type of Function (should be $expect) ";
				$helper->dump();
				exit();
			}*/
			//echo "return type $returntype match return type of Function (should be $expect) ";
			//$helper->dump();
			
			break;
		case '!':
			break;
		default:
			$helper->dump();
			exit("NON TYPE");
		case NULL:
			echo "RETURN FALSE";
			$helper->dump();
			return false;
	}
	return true;
}
function DoParser($fullpath){
	global $compileParserList;	
	global $classInfo;
	if($compileParserList[$fullpath])return;
	$compileParserList[$fullpath]=true;



	$readfile = file_get_contents($fullpath);
	$tokens = token_get_all($readfile);

	$helper = new CompileHelper($tokens);
	$helper->filepath = $fullpath;
	
	//echo "<pre>";
	while(ProcessToken($helper)!==false){}
	//echo "</pre>";

}


$compileQueue[] = "../app_hexa/_model/md_optin.php";
$compileQueue[] = "../app_hexa/_indexuncat/member.inc.php";

//$classInfo['ModelObjectCaching']['RETURN']['Get'] = 'ModelObject';
for($i=0;$i  < count($compileQueue);$i++){
	CompileHeader($compileQueue[$i]);
	$classInfoDump = "<? \n \$classInfoDump = ".var_export($classInfo,true)." \n ?>";
	file_put_contents($outputdir."/header_define.php",$classInfoDump);
	if($i>=1)break;
}

DoParser("../model/md_optin.php");
exit("EXIT");
for($i=0;$i < count($compileQueue);$i++){
	DoParser($compileQueue[$i]);
}



exit();


