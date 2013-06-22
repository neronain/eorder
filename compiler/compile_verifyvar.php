<pre>
<?
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');
$unsettxt = array();
$unusetxt = array();
$markerArr = array();

set_time_limit(0);

define(DEBUG,false);

define(COPYBACK,true);

define(MAX_UNSET,100000);
define(MAX_UNUSE,100000);

function Verify_code($filename,$tokens,$parentvar1=array(),$parentvar2=array()){
	global $unusetxt,$unsettxt,$markerArr;
	if(count($unsettxt)>MAX_UNSET)return;
	if(count($unusetxt)>MAX_UNUSE)return;
	if(DEBUG && 0){
		echo "\n\n----------------- Verify_code ------------------------\n";
	 foreach($tokens as $token){
	 	list($token_id, $token_text, $lineno) = $token;
	 	if(is_string($token_id)){
	 		echo htmlentities($token_id);
	 	}else{
	 		echo htmlentities($token_text);
	 	}
		}

		echo "\n\n------------------------------------------------------\n";//*/
	}
	$thisvar = array();
	$declairvar = array();
	$declairvar1 = array();
	$functionvar = array();
	foreach($parentvar1 as $key => $val){
		$declairvar[$key] = $val;
		if(DEBUG){
			echo "Header Define [$key][$val]\n";
		}
	}
	foreach($parentvar2 as $key => $val){
		$declairvar[$key] = $val;
		if(DEBUG){
			echo "Header Define [$key][$val]\n";
		}
	}

	$sublevel  = 0;
	$subcode  = array();

	$linenum = 0;
	$isNextAssign = false;


	$isFunctionLevel0 = false;
	$isCatchLevel0 = false;
	$isListLevel0 = false;
	$isGlobalLevel0 = false;

	$ifStateLevel0 = NULL;
	$ifVarLevel1x1 = array();
	$ifVarLevel1x2 = array();

	if(!is_array($tokens))var_dump($tokens);
	$tokenIndex = 0;
	for(;$tokenIndex<count($tokens);$tokenIndex++){
		$token = $tokens[$tokenIndex];

		list($token_id, $token_text, $lineno) = $token;




		if($lineno>0)$linenum = $lineno;

		if($token_id=='}'){
			if($isSkipBacket){
				$isSkipBacket = false;
					
				if(DEBUG){
					echo "[S}-]";
				}
				continue;
			}


			$sublevel--;
			if($sublevel<0)echo '<span style="font-size:48">***BUG*** BACKET '.$filename.'#'.$linenum.'</span>';

			if(DEBUG)echo "[S+".($sublevel+1)."&gt;".($sublevel)."]";
			if($sublevel==0){
				//var_dump($functionvar);
				$tmp = array();
				foreach($declairvar as $k => $v){
					$tmp[$k] = $v;
				}
				foreach($declairvar1 as $k => $v){
					$tmp[$k] = $v;
				}
				Verify_code($filename,$subcode[1],$tmp,$functionvar);
				$subcode[1]=array();
				$functionvar = array();


				switch($ifStateLevel0){
					case 'IF':
						break;
					case 'ELSEIF':
						$tmp = array();
						foreach($ifVarLevel1x1 as $v => $l){
							if($ifVarLevel1x2[$v]!=NULL){
								$tmp[$v] = $l;
							}
						}
						$ifVarLevel1x1 = $tmp;
						$ifVarLevel1x2 = array();
						break;
					case 'ELSE':
						$tmp = array();
						foreach($ifVarLevel1x1 as $v => $l){
							if($ifVarLevel1x2[$v]!=NULL){
								$declairvar1[$v] = $l;
							}
						}
						$ifVarLevel1x1 = array();
						$ifVarLevel1x2 = array();
						break;
					default:
						$ifVarLevel1x1 = array();
						$ifVarLevel1x2 = array();
				}

			}
			if($sublevel>0){
				$subcode[1][] = $token;
			}
			//echo "sublevel--[$sublevel]\n";
			continue;
		}




		if($token_id=='{'){
			if($sublevel>0){
				$subcode[1][] = $token;
			}
			$sublevel++;
			if(DEBUG)echo "[S-".($sublevel-1)."&gt;".($sublevel)."]";
			//echo "sublevel++[$sublevel]\n";
			continue;
		}


		if($sublevel>0){
			$subcode[1][] = $token;
		}

		if(DEBUG){
			//if($sublevel==0){
			if(is_string($token_id)){
				echo htmlentities($token_id);
			}else{
				echo htmlentities($token_text);
			}
			//}//*/
		}

		if($token_id==T_WHITESPACE || $token_id==T_COMMENT){
			continue;
		}

		//if($sublevel==0){
		//{

		if(is_string($token_id)){
			switch($token_id){
				case '=' :
					if($lastvariable!=''){
						//echo("[= Define $lastvariable"."[$linenum]]\n");
						if($sublevel==0){
							$declairvar[$lastvariable] = $linenum;
							if(DEBUG){
								echo "[D+$lastvariable@$linenum]";
							}
							/*if($thisvar[$lastvariable]==$linenum && $parentvar1[$lastvariable]==0 && $parentvar2[$lastvariable]==0 ){
							 $thisvar[$lastvariable]=0;
							 if(DEBUG){
							 echo "[U-$lastvariable@$linenum]";
							 }
							 }*/
						}
						elseif($sublevel==1){
							switch($ifStateLevel0){
								case 'IF':
									$ifVarLevel1x1[$lastvariable] = $linenum;
									if(DEBUG){
										echo "[DF1+$lastvariable]";
									}
									break;
								case 'ELSEIF':
								case 'ELSE':
									$ifVarLevel1x2[$lastvariable] = $linenum;
									if(DEBUG){
										echo "[DF2+$lastvariable]";
									}
									break;
								default:
							}
						}
					}
					break;
				case ')' :
					if($isFunctionLevel0){
						$isFunctionLevel0  = false;
						if(DEBUG){
							echo "[ISFUNC-]";
						}
					}elseif($isListLevel0){
						$isListLevel0  = false;
						if(DEBUG){
							echo "[ISLIST-]";
						}
					}elseif($isCatchLevel0){
						$isCatchLevel0  = false;
						if(DEBUG){
							echo "[ISCTCH-]";
						}
					}
					break;
				case ';' :
					if($isGlobalLevel0){
						$isGlobalLevel0  = false;
						if(DEBUG){
							echo "[ISGBL-]";
						}
					}
					break;
				case '(' :
				case '@' :
				case '?' :

				case ':' :
				case '[' :
				case ']' :
				case '"' :
				case '.' :
				case ',' :
				case '+' :
				case '-' :
				case '*' :
				case '/' :
				case '!' :
				case '$' :
				case '>' :
				case '<' :
				case '&' :
				case '%' :
				case '^' :
					$lastvariable = '';
					if($lastvariable!="" && DEBUG){
						echo "[LVAR=''by c".$token_id."]";
					}
					$isNextAssignDBR1 = false;
					break;
				default:
					$lastvariable = '';
					$isNextAssignDBR1 = false;
					echo "case '".$token_id."' :\n";
					break;
			}
		}else{
			switch($token_id){
				case T_DOC_COMMENT:
				case T_COMMENT:
				case T_WHITESPACE:
					//echo "[-]";
					continue;
				case T_VARIABLE:

					if($isNextSkip){
						if(DEBUG){
							echo "[NSKIP-]";
						}
						break;
					}

					if($token_text=="\$this")break;

					if($token_text=="\$_SERVER")break;
					if($token_text=="\$_SESSION")break;
					if($token_text=="\$_COOKIE")break;
					if($token_text=="\$_FILES")break;
					if($token_text=="\$_ENV")break;
					if($token_text=="\$_POST")break;
					if($token_text=="\$_GET")break;
					if($token_text=="\$_REQUEST")break;
					


					$lastvariable = $token_text;



					if($isFunctionLevel0){
						//echo("[Function Define $token_text"."[$linenum]]\n");
						$functionvar[$token_text] = $linenum;
						if(DEBUG){
							echo "[FV+$token_text]";
						}
					}elseif($isListLevel0 || $isGlobalLevel0){
						$declairvar[$token_text] = $linenum;
						if(DEBUG){
							echo "[D+$token_text]";
						}
					}elseif($isCatchLevel0){
						$declairvar[$token_text] = $linenum;
						if(DEBUG){
							echo "[D+$token_text]";
						}
						if($thisvar[$token_text]==0){
							$thisvar[$token_text] = $linenum;
							if(DEBUG){
								echo "[U+$token_text@$linenum]";
							}
						}
					}else{
						if($sublevel==0){
							if($thisvar[$token_text]==0){
								//echo("[$token_text"."[$linenum]]\n");
								$thisvar[$token_text] = $linenum;
								if(DEBUG){
									echo "[U+$token_text@$linenum]";
								}
								//var_dump($thisvar);
							}
							//if($sublevel==0){

							if($isNextAssign){
								//echo("[[=> Define $token_text]]\n");
								$declairvar[$token_text] = $linenum;
								if(DEBUG){
									echo "[D+$token_text]";
								}
								$isNextAssign = false;
								$isNextAssignDBR1=true;
							}
							//}

							if($isNextAssignDBR2){
								//echo("[[=> Define $token_text]]\n");
								//if($sublevel==0){
								$declairvar[$token_text] = $linenum;
								if(DEBUG){
									echo "[D+$token_text]";
								}
								//}
								$isNextAssignDBR2=false;
							}
							if($declairvar[$token_text]==0){
								//echo "[Undefined]";
							}
						}else{
							if($sublevel==1){

							}

							if($declairvar[$token_text]>0){
								if($thisvar[$token_text]==0){
									$thisvar[$token_text] = $linenum;
									if(DEBUG){
										echo "[U+$token_text@$linenum]";
									}
								}
							}
						}
					}

					//var_dump(token_name($token_id));
					//var_dump($token);
					break;
				case T_DOUBLE_ARROW:
					//$isNextAssign = true;
					if($isNextAssignDBR1 && $sublevel==0){
						$isNextAssignDBR2=true;
						$isNextAssignDBR1=false;
					}
					break;
				case T_PROTECTED:
				case T_PUBLIC:
				case T_PRIVATE:
				case T_AS:
					if($sublevel==0){
						$isNextAssign = true;
					}
					break;
				case T_GLOBAL:
					if($sublevel==0){
						$isGlobalLevel0 = true;
						if(DEBUG){
							echo "[ISGBL+]";
						}
					}
					break;
				case T_CATCH:

					if($sublevel==0){
						$isCatchLevel0 = true;
						if(DEBUG){
							echo "[ISCTCH+]";
						}
					}
					break;
				case T_LIST:
					if($sublevel==0){
						$isListLevel0 = true;
						if(DEBUG){
							echo "[ISLIST+]";
						}
					}
					break;
				case T_FUNCTION:
					if($sublevel==0){
						$isFunctionLevel0 = true;
						if(DEBUG){
							echo "[ISFUNC+]";
						}
					}
					//$sublevel++;
					break;
				case T_ENCAPSED_AND_WHITESPACE:

					break;
				case T_CONSTANT_ENCAPSED_STRING:
					//echo "x";
					break;

				case T_IF:
					if($sublevel==0){
						$ifStateLevel0 = 'IF';
						$ifVarLevel1x1 = array();
						$ifVarLevel1x2 = array();
						if(DEBUG){
							echo "[IF+]";
						}
					}
					break;

				case T_ELSEIF:
					if($sublevel==0 && ($ifStateLevel0=='IF' || $ifStateLevel0=='ELSEIF')){
						$ifStateLevel0 = 'ELSEIF';
						if(DEBUG){
							echo "[EF+]";
						}
					}
					break;
				case T_ELSE:
					if($sublevel==0 && ($ifStateLevel0=='IF' || $ifStateLevel0=='ELSEIF')){
						$ifStateLevel0 = 'ELSE';
						if(DEBUG){
							echo "[EL+]";
						}
					}
					break;
				case T_STRING:
					/*echo("[[Found $token_text line $linenum]]");
					 break;*/

				case T_OPEN_TAG:
				case T_CLOSE_TAG:
				case T_CLASS:

				case T_ABSTRACT:

				case T_CLONE:
				case T_INC:
				case T_DEC:
				case T_INCLUDE_ONCE:
				case T_FOR:
				case T_IS_IDENTICAL:
				case T_IS_NOT_IDENTICAL:
				case T_INT_CAST:
				case T_TRY:
				case T_REQUIRE_ONCE:


				case T_EXTENDS:
				case T_INLINE_HTML:
				case T_INCLUDE:
				case T_ECHO:


				case T_IS_NOT_EQUAL:
				case T_OPEN_TAG_WITH_ECHO:
				case T_OBJECT_OPERATOR:


				case T_IS_EQUAL:
				case T_LNUMBER:
				case T_FOREACH:
				case T_BOOLEAN_AND:
				case T_ARRAY:

				case T_DOUBLE_COLON:
				case T_CURLY_OPEN:
				case T_EXIT:
				case T_NEW:
				case T_IS_SMALLER_OR_EQUAL:
				case T_IS_GREATER_OR_EQUAL:
				case T_BREAK:
				case T_RETURN:
					
				case T_VAR:
				case T_DO:					
				case T_FUNC_C:
				case T_LINE:
					
				case T_BOOL_CAST:
				case T_CONCAT_EQUAL:
				case T_CASE:
				case T_SWITCH:
				case T_STATIC:
				case T_ISSET:
				case T_CONTINUE:
				case T_BOOLEAN_OR:
				case T_DNUMBER:
				case T_DEFAULT:
				case T_EMPTY:
				case T_WHILE:
				case T_PLUS_EQUAL:
				case T_LOGICAL_OR:
				case T_UNSET:
				case T_OR_EQUAL:
				case T_LOGICAL_AND:

				case T_DOUBLE_CAST:
				case T_FILE:
				case T_PRINT:
				case T_NUM_STRING:					
					
				case T_MINUS_EQUAL:
				case T_CONST:
				case T_AND_EQUAL:
				case T_INSTANCEOF:
				case T_REQUIRE:
				case T_DIV_EQUAL:
				case T_MUL_EQUAL:

				case T_DOLLAR_OPEN_CURLY_BRACES:
				case T_STRING_VARNAME:
					//$lastvariable = '';
					$isNextAssignDBR1 = false;
					break;
				default:
					//$lastvariable = '';
					$isNextAssignDBR1 = false;
					echo "case ".token_name($token_id).":\n";
					//var_dump(token_name($token_id));
					//var_dump($token);
			}
		}
		if($token_id!=T_VARIABLE && $token_id!=T_WHITESPACE){
			if($lastvariable!="" && DEBUG){
				if(is_string($token_id)){
					echo "[LVAR='' by c".$token_id."]";
				}else{
					echo "[LVAR='' by n".token_name($token_id)."]";
				}
			}
			$lastvariable = "";
		}


		//if($token_id!=T_WHITESPACE && $token_id!=T_WHITESPACE){
		//$oldNextSkip = $isNextSkip;
		$isNextSkip = $token_id == T_DOUBLE_COLON || $token_id ==  T_STATIC;
		if(DEBUG){
			if($isNextSkip){
				echo "[NSKIP+]";
			}
			/*if(!$isNextSkip && $oldNextSkip){
				echo "[NSKIP-]ERROR:#".$linenum."".token_name($token_id);;
			}*/
		}
		//}

		if($token_id!=T_VARIABLE && $token_id!=T_LNUMBER  && $token_id!=T_CONSTANT_ENCAPSED_STRING && $token_id!=T_OBJECT_OPERATOR && $token_id!=T_STRING && $token_id!=T_STRING && $token_id!='[' && $token_id!=']' && $token_id!='(' && $token_id!=')'){
			$oldIsSkipBacket = $isSkipBacket;
			$isSkipBacket = $token_id == T_CURLY_OPEN;
			if(DEBUG && $isSkipBacket != $oldIsSkipBacket){
				if($isSkipBacket){
					echo "[S{+]";
				}else{
					echo "[S{-]ERROR:#".$linenum."".token_name($token_id);
				}
			}
		}
		//}

	}
	//var_dump($declairvar);
	//var_dump($thisvar);
	foreach($thisvar as $key => $val){
		if($val==0)continue;
		if($declairvar[$key]>0)continue;
		if($declairvar1[$key]>0)continue;

		$markerArr[$filename][$val][] = array(
			'T' => 'US',
			'V' => $key
		);
		//$unverify[$key] = $val;
		$txt = "Unset $key at $filename #$val\n";
		//echo $txt;
		$unsettxt[] = $txt;
	}

	foreach($declairvar as $key => $val){
		if($thisvar[$key]>0)continue;
		if($parentvar1[$key]>0)continue;
		$markerArr[$filename][$val][] = array(
			'T' => 'UU', 
			'V' => $key
		);


		//$unuse[$key] = $val;
		$txt = "Unuse $key at $filename #$val\n";
		//echo $txt;
		$unusetxt[] = $txt;

	}

	//var_dump($subcode[0]);
	//var_dump($declairvar);
	//if($unverify!=NULL){
	//	var_dump($unverify);
	//}


}
if(DEBUG){
	//Verify_code(file_get_contents("../index/test.php"));

	//Verify_code(file_get_contents("../app_hexa/affiliates/_ac_commission.php"));
	//Verify_code("../index/test.php",token_get_all(file_get_contents("../index/test.php")));
	//Verify_code(token_get_all(file_get_contents("../app_hexa/pm/view_message_preview.php")));


	//$file = "../app_hexa/form/form_dialog.php";
	/*$file = "../index/test.php";
	 Verify_code($file,token_get_all(file_get_contents($file)));
	 foreach($unsettxt as $txt){
	 echo $txt;
	 }
	 foreach($unusetxt as $txt){
	 echo $txt;
	 }*/
	Verify_path("../index");
	exit();//*/
}

function Verify_path($path,$exception=NULL){
	global $classpath,$classfunc;
	global $unusetxt,$unsettxt,$markerArr;
	if(count($unsettxt)>MAX_UNSET)return;
	if(count($unusetxt)>MAX_UNUSE)return;

	$dir_handle = @opendir($path) or die("Unable to open $path");
	if($exception==NULL){
		$exception=array();
	}

	$outputdir = $path;
	if(!file_exists($outputdir)){
		mkdir($outputdir);
	}

	$countf = 0;
	while ($file = readdir($dir_handle))
	{
		if(is_dir($path."/".$file)){
			if(!in_array($file,$exception) && $file !="." && $file !=".." && $file != ".svn" && !preg_match('/^lang$/',$file)){// && !preg_match('/^repeat_/',$file) && !preg_match('/^lang$/',$file)){
				Verify_path($path."/".$file,$exception);
			}
			continue;
		}
		if(in_array($file,$exception)){
			continue;
		}

		$class = explode(".",$file);
		if($class[count($class)-1]!="php" && $class[count($class)-1]!="phps"){
			continue;
		}

		$code = file_get_contents($path."/".$file);
		$code = str_replace("\r\n","\n",$code);

		$filename = $path."/".$file;
		$tokens = token_get_all($code);
		Verify_Code($path."/".$file,$tokens);





		$outputpath = "../tmp/verifyvar/compiler/".$filename;
		$outputdir = dirname($outputpath);
		if(!file_exists($outputdir)){
			mkdir($outputdir,0777,true);
		}
		//copy($filename, $outputpath);

		$fp = fopen($filename, "r");
		$fo = fopen($outputpath, "w+");
		$line = 1;
		while($buf = fgets($fp)){
			$tmp2 = $tmp[$line];
			$buf = str_replace("/*TODO".":V+US*/","",$buf);
			$buf = str_replace("/*TODO".":V+UU*/","",$buf);

			//echo htmlentities($buf);
			$tmp  = $markerArr[$filename];
			if($tmp2!=NULL){
				foreach($tmp2 as $marker){
					$var = $marker['V'];
					$type = $marker['T'];
					$buf = str_replace($var, "/*TODO:V+$type*/".$var, $buf);
				}
			}
			$buf = str_replace("&/*TODO:V+UU*/$","/*TODO:V+UU*/&$", $buf);
			$buf = str_replace("&/*TODO:V+US*/$","/*TODO:V+US*/&$", $buf);
			fputs($fo, $buf);
			$line++;
		}
		fclose($fp);
		fclose($fo);
		if(COPYBACK){
			copy($outputpath,$filename);
		}

		$markerArr = array();
		//exit();




	}
	if(count($unsettxt)+count($unusetxt)>0){
		echo "<hr/>";
		echo "Path $path \n";
		echo "Unset ".count($unsettxt)."\n";
		echo "Unuse ".count($unusetxt)."\n";
		echo "--------------------------------------------------------------------\n";
		foreach($unsettxt as $txt){
			echo $txt;
		}
		//echo "<hr/>";
		foreach($unusetxt as $txt){
			echo $txt;
		}
		$unsettxt = array();
		$unusetxt = array();

	}




	closedir($dir_handle);

}
$except = array("cron_encode.php");//"common.inc.php","func.inc.php","config.inc.php","csql.php","unittest.inc.php","wordpress.inc.php","ziputil.inc.php");
//Verify_path("../model",$except);
//Verify_path("../framework",$except);
Verify_path("../app_hexa",$except);
//Verify_path("../app_hexa/autoresponder",$except);
//Verify_path("../lib",$except);
//Verify_path("../resources/lib",$except);

/*$export = "<?\n \$classpath = ";
 $export .= var_export($classpath,true).";";
 $fw = file_put_contents("../framework/conf/classpath.gen.php",$export);

 $export = "<?\n \$classfunc = ";
 $export .= var_export($classfunc,true).";";
 $fw = file_put_contents("../framework/conf/classfunc.gen.php",$export);*/

//echo "<pre>";
//var_dump($classfunc);
//echo "</pre>";


?></pre>
