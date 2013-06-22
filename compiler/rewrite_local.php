<?
if($_SERVER['HTTP_HOST']!='localhost')exit('permission denie');
chdir("../tmp/chdir");
include "../../framework/core/common.inc.php";

function CompileLocalLanguage($path,$exception=NULL){
	//echo "{$path}<br />";
	$dir_handle = @opendir($path) or die("Unable to open $path");
	if($exception==NULL){
		$exception=array();
	}
	
	$outputdir = $path;//."_output";
	if(!file_exists($outputdir)){
		mkdir($outputdir);
	}
	
	$countf = 0;
	while ($file = readdir($dir_handle)) 
	{
		if(is_dir($path."/".$file)){
			if(!in_array($file,$exception) && $file !="." && $file !=".." && $file != ".svn"){
				CompileLocalLanguage($path."/".$file);
			}
			continue;
		}
	
	
		//if(substr($file,0,3)!='md_')continue;
		$class = explode(".",$file);
		if($class[count($class)-1]!="php")continue;
		
		$code = file_get_contents($path."/".$file);
		
		$code = str_replace("\r\n","\n",$code);
		
		$code = str_replace("/*TODO:V+US*/","",$code);
		$code = str_replace("/*TODO:V+UU*/","",$code);
		
		
		$rwcode = "";
		$precode = "";
		
		
		// <!-- ROWREPEAT --> 
		$is_repeat = false;
		preg_match_all('/<!\-\- ROWREPEAT\[(.+?)\] \-\->(.+?)<!\-\- \/ROWREPEAT \-\->/s', $code, $matches);
		for($i=0;$i<count($matches[0]);$i++){	
			$is_repeat = true;
			$rwclass = $matches[1][$i];
			$rwcode = $matches[2][$i];
			
			if(preg_match('/<\?[ \n\t]*\/\*PREREPEAT\*?\/?(.+?)\/?\*?\/PREREPEAT\*\/[ \n\t]*\?>/s', $rwcode, $pre_matches)){
				$precode = $pre_matches[1];
				$rwcode = str_replace($pre_matches[0],"",$rwcode);
				$precode = preg_replace("/\n\t+/","\n\t\t",$precode);
			}
			$rwcode = str_replace("'","\\'",$rwcode);
			
			$rwcode = preg_replace("/<\?=[ ]*\\$(\w[\w\d_]*)\->(.+?)[ ]*\?>/i","'+(data.record.$1__$2)+'",$rwcode);
			$rwcode = preg_replace("/<\?=[ ]*\\$([^\?]+)[ ]*\?>/","'+(data.record.$1)+'",$rwcode);
			$rwcode = preg_replace("/=>[ ]*\\$(\w[\w\d_]*)\->(.+?)[ ]*(,|\))/","=>\"'+data.record.$1__$2+'\"$3",$rwcode);
			$rwcode = preg_replace("/=>[ ]*\\$([^\?]+)[ ]*(,|\))/","=>\"'+data.record.$1+'\"$3",$rwcode);
			break;
		}
		
		if($is_repeat){
			//echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$file} - repeat<br />";
			$rwcode = preg_replace("/[\t ]*(.*?)\n/","	text += ' $1';\n",$rwcode);
			$rwcode = preg_replace("/	text \+= '';\n/","\n",$rwcode);
			$rwcode = preg_replace("/text \+= '[\t ]*<\? (.+?)\?>.*';/i","<? $1?>",$rwcode);
			preg_match_all('/<\?[ ]*\/\*\+(\*\/)?(.+?)(\/\*)?\-\*\/[ ]*\?>/s', $rwcode, $skip_matches);//*/
			for($i=0; $i < count($skip_matches[0]);$i++){	
				$inside = $skip_matches[2][$i];
				$inside = str_replace('$','data.record.',$inside);
				$inside = str_replace('->','__',$inside);
				$inside = str_replace("\\'","'",$inside);
				$rwcode = str_replace($skip_matches[0][$i],$inside,$rwcode);
			}
			
			$rwcode = str_replace(')__URL_',')->URL_',$rwcode);
			
			//find data variable
			$mainObjName = '';
			$precode_prefix = "\t\t\$repeatid = \${MAINOBJNAME}->id;\n";
			//$precode_suffix = "\n\t\treturn array(\n\t\t\t'classname'=>get_class(\${MAINOBJNAME}),\n\t\t\t'isarray'=>0,\n\t\t\t'id'=>\${MAINOBJNAME}->id,\n";
			$precode_suffix = "\n\t\treturn array(\n\t\t\t'classname'=>'{$rwclass}',\n\t\t\t'isarray'=>0,\n\t\t\t'id'=>\$repeatid,\n";
			
			$varnameCollect = array();
			$requireCollect = array();
			

			preg_match_all('/data\.record\.([\w\d\._]+)/s', $rwcode, $var_matches);//*/
			for($i=0; $i < count($var_matches[0]);$i++){	
				$varname = $var_matches[1][$i];
				if($varnameCollect[$varname]!=NULL)continue;
				$varnameCollect[$varname]=true;
				$orginalname = $varname;
				if(preg_match('/([\w\d\._]+)__([\w\d\._]+)/s', $varname, $obj_matches)){
					$precode_prefix .= "\t\t\${$orginalname} = \${$obj_matches[1]}->{$obj_matches[2]};\n";
					if(!in_array("\$".$obj_matches[1],$requireCollect)){
						$requireCollect[] = "\$".$obj_matches[1];
						if($mainObjName=='')$mainObjName = $obj_matches[1];
					}
				}else{
					if(!preg_match('/\$'.$orginalname.'[^\w\d_][ ]*=[^=]/is', $precode)){
						$requireCollect[] = "\$".$orginalname;
					}
				}
				$precode_suffix .= "\t\t\t'$varname' => \${$orginalname},\n";
			}
			$precode_suffix = preg_replace("/,$/", '', $precode_suffix);
			$precode_suffix .= "\t\t\t);";
			
			preg_match_all('/\$([\w\d_]+)/s', $precode, $var_matches);
			for($i=0; $i < count($var_matches[0]);$i++){	
				$varname = $var_matches[1][$i];
				if($varnameCollect[$varname]!=NULL)continue;
				$varnameCollect[$varname]=true;
				$orginalname = $varname;
				if(!preg_match('/\$'.$orginalname.'[^\w\d_][ ]*=[^=]/is', $precode)){
					if(!in_array("\$".$orginalname,$requireCollect)){
						$requireCollect[] = "\$".$orginalname;
					}
				}			
			}
			
			//Remove set var
			foreach($requireCollect as $ind => $rqCollect){
				if($mainObjName==''){
					$mainObjName = substr($rqCollect,1);	
				}
				if(preg_match('/^\$\d/',$rqCollect)){
					unset($requireCollect[$ind]);
				}
				
				if(preg_match('/\\'.$rqCollect.' *=/i', $precode)){
					if('$'.$mainObjName==$requireCollect[$ind]){
						$mainObjName='';
					}
					unset($requireCollect[$ind]);
				}
			}

			if($mainObjName=='')$mainObjName = 'nothing';
			$precode_prefix = str_replace("{MAINOBJNAME}",$mainObjName,$precode_prefix);
			$precode_suffix = str_replace("{MAINOBJNAME}",$mainObjName,$precode_suffix);
			
			$extranormallize = implode(",",$requireCollect);
			$extranormallize  = preg_replace("/\\$".$mainObjName.",?/", "", $extranormallize);
			if($extranormallize!=''){
				$extranormallize = ",".$extranormallize;
			}
			
			$precode_array = 
				"\t\tif(Inc_Var::right(get_class(\${$mainObjName}),5)=='Array'){\n".
				"\t\t\t\$arObj = array();\n".
				"\t\t\tforeach(\${$mainObjName}->GetArray() as \$tmpObj){\n".
				"\t\t\t\t\t\n".
				"\t\t\t\t\t\$arObj[] = array('success' => true,'messages'=>'','warning'=>'','record'=>self::NormalizeData(\$tmpObj$extranormallize));\n".
				"\t\t\t\t\t\n".
				"\t\t\t}\n".
				"\t\t\treturn array('isarray'=>1,'array'=>\$arObj);\n".
				"\t\t}\n";
			
			//Fix jquery style
			$rwcode = str_replace("data.record.(","\$(",$rwcode);
			
			//Fix Const
			$rwcode = preg_replace("/(CONST_[A-Z]+)/","'<?=$1?>'",$rwcode);
			
			
			$rwcode = "<?\nclass Repeater_{$class[0]} extends Joay_Repeater{\n".
				"\tpublic static function GenerateRfPage(".implode(",",$requireCollect)."){ \n".
				"\t\tif(\$_GET['rfpage']>0){\n".
				"\t\t\treturn self::NormalizeData(".implode(",",$requireCollect).");\n".
				"\t\t}\n".
				"\t\treturn false;\n".
				"\t}\n".
				"\tpublic static function NormalizeData(".implode(",",$requireCollect)."){ \n".
				"\n".
				"{$precode_array}\n".
				"\n".
				"\n".
				"{$precode_prefix}\n".
				"{$precode}\n".
				"{$precode_suffix}\n".
				"\n".
				"\t}\n".
				"\tpublic static function GenerateScript(){ ?>
			<script>\n
			if(typeof(Repeater_Remove) == 'undefined'){
				Repeater_Remove = function(classname,id,refill){
					$('#'+classname+'' + id).remove();
					if(typeof(UpdateRecord_OnAfter)=='function'){
						UpdateRecord_OnAfter('delete',{classname:classname,id:id});
					}
					
					if(typeof(refill)!='undefined' && refill>0){
						var isfunction = false;
						eval('isfunction = typeof(PageCtrlRefill_'+classname+'List)== \"function\"');
						if(isfunction){
							eval('PageCtrlRefill_'+classname+'List(1)');
						}	
					}
					
				}
			}
			if(typeof(GenerateRepeatRecord) == 'undefined'){
				GenerateRepeatRecord = function(data){ 	
					if(typeof(data.record)=='undefined'){
						LoggerNofity('Message',data.messages);
						return;
					}
					if(data.record.isarray==1){
						for(var i in data.record.array){
							if(typeof(data.record.array[i])=='function')continue;
							var obj = data.record.array[i];
							obj.messages = data.messages;
							GenerateRepeatRecord(obj);
						}
						return;
					}
					var classname = data.record.classname;
					if(typeof(data.record.isdelete)!='undefined' && data.record.isdelete){
						Repeater_Remove(classname,data.record.id);
					}else{
						var isfunction = false;
						
						eval('isfunction = typeof(GenerateRepeatRecord'+classname+')== \"function\"');
						if(isfunction){
							eval('GenerateRepeatRecord'+classname+'(data)');
						}
					}	
				}
			}
			
			if(typeof(GenerateRepeatRecord".$rwclass.") == 'undefined'){
				GenerateRepeatRecord".$rwclass." = function(data){ 
					if(data.record.classname!='".$rwclass."')return;
					if($('#".$rwclass."List').length == 0) {
						if(typeof(data.noredirect)=='undefined'){
							if(typeof(data.redirect)=='undefined'){
								window.location = window.location+'';
							}else{
								window.location=data.redirect;
							}
						}
						return;
					}
					\n\tvar text = '';\n\tvar text_suffix_create='';\n" . $rwcode;
		
				$rwcode .= "\n
				
				
					var method = '';
					if($('#".$rwclass."' + data.record.id).html() != null) {
						$('#".$rwclass."' + data.record.id).html(text);
						LoggerNofity('Update',data.messages);
						method = 'update';
					} else {
						$('#".$rwclass."List').append('<tr class=\"record-list\" id=\"".$rwclass."' + data.record.id + '\">' + text + '</tr>'+text_suffix_create);
						LoggerNofity('Create',data.messages);
						method = 'create';
						
						$('#hint_on_empty').hide();
						$('table.table-record-list').show();						
						
					}//*/	

					UpdateRecordList();	
					if(typeof(UpdateRecord_OnAfter)=='function'){
						UpdateRecord_OnAfter(method,data);
					}
					

					
				}
			}\n</script>
			
			
			<? \n".
			"	}\n".
			"}\n".
			"";
			
			//Inc_Var::vardump($rwcode);
			$fw = file_put_contents($outputdir."/repeat_".$file,$rwcode);
		}



	}
	
	closedir($dir_handle);
}


//CompileTemplate("../templates");
CompileLocalLanguage("../../app_hexa",array("_cron","_include","_internalapp","_lib","_model","_plugins","_skeleton","_uncat"));

?>Done.
