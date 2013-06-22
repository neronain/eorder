<?

define(ABSTRACT_ACTIONCLASS,'Joay_Action');
abstract class Joay_Action{
	//public static $DEF = NULL;
	protected $current_todo = NULL;

	function __construct(){
		Conf()->head_title = WHITELABELNAMEFULL.Inc_Var::strtofupper(Req(act))." ".Inc_Var::strtofupper(Req(todo));
	}

	public function DoAction(){
		$todo = Req(todo);
		$todo = str_replace("-",'',$todo);
		$this->current_todo = $todo;

		$this->BeforeAction();
		Joay_Controller::Process_Action_Start($this);


		/*if(function_exists()){
		 }*/
		$paraminfo = Config_GetTodoArg(get_class($this),$todo);
		if($paraminfo!=NULL){
			foreach($paraminfo as $reqname => $def){
				$arrreq = explode("_ARRAY", $reqname);
				if(count($arrreq)==2 && $arrreq[1]===""){

					$args[$reqname] = NULL;
					for($i=0;$i<3 || $args[$reqname][$i-1]!=NULL;$i++){
						$val = Req($arrreq[0]."".$i);
						if($val!=NULL){
							$args[$reqname][$i] = $val;
						}
					}
				}else{
					if($def!=''){
						if($def=="array()"){
							$args[$reqname] = Req($reqname,array());
						}else{
							$args[$reqname] = Req($reqname,$def);
						}
					}else{
						$args[$reqname] = Req($reqname);
					}
				}
				if($args[$reqname]==='TRUE'||$args[$reqname]==='true'){
					$args[$reqname] = true;
				}
				if($args[$reqname]==='FALSE'||$args[$reqname]==='false'){
					$args[$reqname] = false;	
				}
			}
			call_user_func_array(array($this, "todo_{$todo}"),$args);
		}else{
			//echo "YYYY";
			call_user_func(array($this, "todo_{$todo}"));
		}


		$this->AfterAction();
		Joay_Controller::Process_Action_End($this);
	}

	
	public function AssertPermissionCheckNULL($refObj,$permission,$type='BASIC'){
		if($refObj==NULL){
			exit('Object not found');
		}
		$this->AssertPermissionIgnoreNULL($refObj,$permission,$type);
	}	
	public function AssertPermissionIgnoreNULL($refObj,$permission,$type='BASIC'){
		if($refObj==NULL)return;
		Inc_Authen::checkLogin();
		$refObj->Assert($permission,$type);
	}
	
	
	
	
	public function AssertGlobalPermissionCheckNULL($refObj1,$refObj2=-1){
		if($refObj1==NULL){
			exit('Object not found');
		}
		if($refObj2==NULL){
			exit('Object not found');
		}
		if($refObj2==-1){
			$refObj2 = NULL;
		}
		$this->AssertGlobalPermission($refObj1,$refObj2);
	}
	public function AssertGlobalPermission($refObj1,$refObj2=NULL){
		if(!Conf()->DEVSERVER){
			return;	
		}
		
		$class =  str_replace("Joay_Action_", "",get_class($this));
		$todo = $this->current_todo;
		$Global_permissionAr = ActionPermissionConfig::GetPermissionAr();
		$permissionAr = $Global_permissionAr[$class][$todo];
		if($permissionAr==NULL){
			if(Conf()->DEVSERVER){
				exit("unimplement ActionPermissionConfig::GetPermissionAr \$perm['{$class}']['{$todo}']");
			}else{
				Inc_Notify::Mail(2, AssertGlobalPermission, "unimplement ActionPermissionConfig::GetPermissionAr \$perm['{$class}']['{$todo}']"."\n\n".Inc_Var::varexport(debug_backtrace(false)));
				return;	
			}
		}

		$isfound1 = $refObj1==NULL;
		$isfound2 = $refObj2==NULL;
		
		//If nothing to check then return
		if($isfound1 && $isfound2){
			return;
		}
		
		//If the global unlock is enable that's no point to check anything 
		if(Conf()->global_unlock_superable || Conf()->global_unlock_writeable){
			return;
		}
		
		Inc_Authen::checkLogin();
		
		foreach($permissionAr as $classname => $permission){
			if(!$isfound1 && get_class($refObj1)==$classname){
				$pr = explode(",",$permission);
				$refObj1->Assert($pr[1],$pr[0]);
				$isfound1 = true;
				if($refObj2==NULL)return;
			}
			if(!$isfound2 && get_class($refObj2)==$classname){
				$pr = explode(",",$permission);
				$refObj2->Assert($pr[1],$pr[0]);
				$isfound2 = true;
			}
				
		}
		
		if(!$isfound1){
			if(Conf()->DEVSERVER){
				exit("unimplement ActionPermissionConfig::GetPermissionAr \$perm['{$class}']['{$todo}'] for class ". get_class($refObj1));
			}else{
				Inc_Notify::Mail(2, AssertGlobalPermission, "unimplement ActionPermissionConfig::GetPermissionAr \$perm['{$class}']['{$todo}'] for class ". get_class($refObj1)."\n\n".Inc_Var::varexport(debug_backtrace(false)));
				exit('permission denied');
				return;
			}
		}
		if(!$isfound2){
			if(Conf()->DEVSERVER){
				exit("unimplement ActionPermissionConfig::GetPermissionAr \$perm['{$class}']['{$todo}'] for class ". get_class($refObj2));
			}else{
				Inc_Notify::Mail(2, AssertGlobalPermission, "unimplement ActionPermissionConfig::GetPermissionAr \$perm['{$class}']['{$todo}'] for class ". get_class($refObj2)."\n\n".Inc_Var::varexport(debug_backtrace(false)));
				exit('permission denied');
				return;
			}
		}
	}



	public function Process_Html($html){
		//global $G;
		if(Conf()->UNITTEST===TRUE){
			if(Conf()->UNITTEST_CONTROLLER===TRUE)
			return false;
		}

		$this->BeforeView();
		Joay_Controller::Process_Html_Start($file);
		if(!(Conf()->UNITTEST && Conf()->UNITTEST_CONTROLLER_SKIP_VIEW)){
			echo $html;
		}
		if(Conf()->UNITTEST){
			Unit_FrameWorkTester::$outputContent.= $html;
		}
		
		$this->AfterView();
		Joay_Controller::Process_Html_End($file);
	}

	public function Process_JSON($jsonArr){


		if(Conf()->UNITTEST===TRUE){
			if(Conf()->UNITTEST_CONTROLLER===TRUE)
			return false;
		}
		$this->BeforeView();
		Joay_Controller::Process_Json_Start();

		$jsonSTR = json_encode($jsonArr);
		if(Conf()->DOUBLE_ENCODE_QUOTE){
			$jsonSTR = str_replace("\\\\","",$jsonSTR);
		}
		if(!(Conf()->UNITTEST && Conf()->UNITTEST_CONTROLLER_SKIP_VIEW)){
			echo $jsonSTR;
		}
		if(Conf()->UNITTEST){
			Unit_FrameWorkTester::$outputContent.= $jsonSTR;
		}

		$this->AfterView();
		Joay_Controller::Process_Json_End();


	}
	public function Process_XJSON($callback,$jsonArr){

		if(Conf()->UNITTEST===TRUE){
			if(Conf()->UNITTEST_CONTROLLER===TRUE)
			return false;
		}
		$this->BeforeView();
		Joay_Controller::Process_Json_Start();

		$jsonSTR = json_encode($jsonArr);
		if(Conf()->DOUBLE_ENCODE_QUOTE){
			$jsonSTR = str_replace("\\\\","",$jsonSTR);
		}
		if(!(Conf()->UNITTEST && Conf()->UNITTEST_CONTROLLER_SKIP_VIEW)){
			echo $callback."(".$jsonSTR.")";
		}
		if(Conf()->UNITTEST){
			Unit_FrameWorkTester::$outputContent.= $callback."(".$jsonSTR.")";
		}

		$this->AfterView();
		Joay_Controller::Process_Json_End();


	}

	public function Process_HTML_RAW($html=NULL){
		if($html===NULL){
			$html = ob_get_clean();
			ob_start();
		}
		$this->Process_Html($html);
	}

	public function Process_HTML_EMJS_RAW($data=NULL){
		//global $G;
		if(Conf()->UNITTEST===TRUE){
			if(Conf()->UNITTEST_CONTROLLER===TRUE)
			return false;
		}

		$this->BeforeView();
		Joay_Controller::Process_JsScript_Start();

		if($data===NULL){
			$data = ob_get_clean();
			ob_start();
		}

		$data = str_replace("\r\n",'\n',$data);
		$data = str_replace("\n",'\n',$data);
		$data = str_replace("'","\\'",$data);
		$data = str_replace('/',"\\/",$data);

		$data = "document.write('{$data}');";
		
		if(!(Conf()->UNITTEST && Conf()->UNITTEST_CONTROLLER_SKIP_VIEW)){
			echo $data;
		}
		if(Conf()->UNITTEST){
			Unit_FrameWorkTester::$outputContent.= $data;
		}
		
		$this->AfterView();
		Joay_Controller::Process_JsScript_End();
	}

	public function Process_HTML_EMJS_FILE($data=NULL, $prefix_code=NULL,$suffix_code=NULL){
		//global $G;
		if(Conf()->UNITTEST===TRUE){
			if(Conf()->UNITTEST_CONTROLLER===TRUE)
			return false;
		}


		$this->BeforeView();
		Joay_Controller::Process_JsScript_Start();

		if($data===NULL){
			$data = ob_get_clean();
			ob_start();
		}


		$data = str_replace("\r\n",'\n',$data);
		$data = str_replace("\n",'\n',$data);
		$data = str_replace("'","\\'",$data);
		$data = str_replace('/',"\\/",$data);

		$output = "";
		if( isset($prefix_code) ) {
			$output .= $prefix_code;
		}
		$output .= "document.write('{$data}');";
		if( isset($suffix_code) ) {
			$output .= $suffix_code;
		}
		if(!(Conf()->UNITTEST && Conf()->UNITTEST_CONTROLLER_SKIP_VIEW)){	
			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Type: application/x-javascript");
			header("Content-Disposition: attachment; filename=\"script_".rand()."\"");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: " . strlen($output));

			echo $output;
		}
		if(Conf()->UNITTEST){
			Unit_FrameWorkTester::$outputContent.= $output;
		}
		
		$this->AfterView();
		Joay_Controller::Process_JsScript_End();
	}
	public function Process_JS_EMHTML_RAW($data=NULL){
		if($data===NULL){
			$data = ob_get_clean();
			ob_start();
		}

		$data = "<script>".$data."</script>";

		$this->Process_Html($data);
	}

	public function Process_HTML_EMJS_EMHTML_RAW($data=NULL){
		//global $G;
		if(Conf()->UNITTEST===TRUE){
			if(Conf()->UNITTEST_CONTROLLER===TRUE)
			return false;
		}

		$this->BeforeView();
		Joay_Controller::Process_Html_Start();

		if($data===NULL){
			$data = ob_get_clean();
			ob_start();
		}


		$data = str_replace("\r\n",'\n',$data);
		$data = str_replace("\n",'\n',$data);
		$data = str_replace("'","\\'",$data);
		$data = str_replace('/',"\\/",$data);

		$data = "<script>document.write('{$data}');</script>";
		if(!(Conf()->UNITTEST && Conf()->UNITTEST_CONTROLLER_SKIP_VIEW)){
			echo $data;
		}
		if(Conf()->UNITTEST){
			Unit_FrameWorkTester::$outputContent.= $data;
		}
		$this->AfterView();
		Joay_Controller::Process_Html_End();
	}

	public function Process_JS_RAW($data=NULL){
		if($data===NULL){
			$data = ob_get_clean();
			ob_start();
		}
		
		Joay_Controller::Process_JsScript_Start();
		if(!(Conf()->UNITTEST && Conf()->UNITTEST_CONTROLLER_SKIP_VIEW)){
			echo $data;
		}
		if(Conf()->UNITTEST){
			Unit_FrameWorkTester::$outputContent.= $data;
		}
		Joay_Controller::Process_JsScript_End();		
		
		
	}

	public function Process_JS_FILE($data=NULL){
		//global $G;
		if(Conf()->UNITTEST===TRUE){
			if(Conf()->UNITTEST_CONTROLLER===TRUE)
			return false;
		}


		$this->BeforeView();
		Joay_Controller::Process_JsScript_Start();

		if($data===NULL){
			$data = ob_get_clean();
			ob_start();
		}


		if(!(Conf()->UNITTEST && Conf()->UNITTEST_CONTROLLER_SKIP_VIEW)){

			header("Pragma: public");
			header("Expires: 0");
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Cache-Control: public");
			header("Content-Description: File Transfer");
			header("Content-Type: application/x-javascript");
			header("Content-Disposition: attachment; filename=\"script_".rand()."\"");
			header("Content-Transfer-Encoding: binary");
			header("Content-Length: " . strlen($data));

			echo $data;

		}
		if(Conf()->UNITTEST){
			Unit_FrameWorkTester::$outputContent.= $data;
		}
		
		$this->AfterView();
		Joay_Controller::Process_JsScript_End();
	}





	public function SwapProtocol($new_protocol=NULL){
		if($new_protocol==NULL){
			$new_protocol = Inc_Server::is_https()?'http':'https';
		}
		switch($new_protocol){
			case 'http':
				$url = Conf()->this_http_domain.$_SERVER['REQUEST_URI'];
				break;
			case 'https':
				$url = Conf()->this_https_domain.$_SERVER['REQUEST_URI'];
				break;
		}

		Joay_Controller::ForwardUrl($url);
	}
	public function ForwardUrl($url){
		Joay_Controller::ForwardUrl($url);
	}
	public function ForwardAction($act,$todo='',$param=array()){
		Joay_Controller::ForwardAction($act,$todo,$param);
	}
	public function ForwardTodo($todo='',$param=array()){
		Joay_Controller::ForwardTodo($todo,$param);
	}
	public function RedirectAction($act,$todo='',$param=array()){
		Joay_Controller::RedirectAction($act,$todo,$param);
	}
	public function RedirectTodo($todo='',$param=array()){
		Joay_Controller::RedirectTodo($todo,$param);
	}



	public function BeforeAction(){
	}
	public function AfterAction(){
	}

	public function BeforeView(){
	}
	public function AfterView(){
	}


	protected final function prototype_isajax_refresh($recordArray){
		if($recordArray==false)return;
		self::prototype_refresh_record($recordArray);
	}


	protected final function prototype_delete($obj,$msg=NULL){
		if($msg===NULL){
			$msg = __("Deleted successfully.");
		}
		$phperror = ob_get_clean();
		ob_start();
		if(trim($phperror)!='' && $phperror!=NULL){
			SaveDS()->Warning('phperror',($phperror));
		}

		if($obj!=null && !$obj->WriteAble()) {
			SaveDS()->Put('permission',__("You do not have permission to delete this record."));
			$this->prototype_json_result();
		}
		
		$obj->local_unlock_writeable = true;
		$isforce_delete = true;
		
		if(!SaveDS()->ifError){
			if($obj instanceof AB_Projectier){
				$isforce_delete = $obj->IsForceDeleteOnRemove();
			}
		}

		if(SaveDS()->ifError){
			$this->prototype_json_result();
		}
		
		if($obj!=null && $obj->IsDelete()){
			self::prototype_json_result($msg,array('isdelete'=>1,'classname'=>get_class($obj),'id'=>$obj->id));
		}elseif($obj!=null && $obj->HasKey('enable')){
			if($isforce_delete){
				if($obj->enable){
					$obj->enable = false;
					$obj->Update();
				}
			}
			self::prototype_json_result($msg,array('isdelete'=>1,'classname'=>get_class($obj),'id'=>$obj->id));
		}elseif($obj!=null){
			if($isforce_delete){
				if(!$obj->IsDelete()){
					$obj->DeleteMe();
				}
			}
			self::prototype_json_result($msg,array('isdelete'=>1,'classname'=>get_class($obj),'id'=>$obj->id));
		}else{
			$json = array(
				"success" => false,
				"messages" => sprintf(__("Record Not Found %s"),SaveDS()->GetWarningMsg()),
				"option" => SaveDS()->GetOption()
			);
		}
		$this->Process_Json($json);
	}
	
	protected final function prototype_archive($obj,$isarchive,$msg=NULL){
		if($msg===NULL){
			$msg = __("Archive successfully.");	
		}
		$phperror = ob_get_clean();
		ob_start();
		if(trim($phperror)!='' && $phperror!=NULL){
			SaveDS()->Warning('phperror',($phperror));
		}
	
		if($obj!=null && !$obj->WriteAble()) {
			SaveDS()->Put('permission',__("You do not have permission to archive this record."));
			$this->prototype_json_result();
		}
	
		if(SaveDS()->ifError){
			$this->prototype_json_result();
		}
	
		if($obj!=null){
			if($isarchive){
				$obj->record_mark = 'ARCHIVE';
				$obj->Update();
				self::prototype_json_result($msg,array('isdelete'=>1,'classname'=>get_class($obj),'id'=>$obj->id));
			}else{
				$obj->record_mark = 'NONE';
				$obj->Update();
			}
		}else{
			$json = array(
					"success" => false,
					"messages" => sprintf(__("Record Not Found %s"),SaveDS()->GetWarningMsg()),
					"option" => SaveDS()->GetOption()
			);
			$this->Process_Json($json);
		}
		
	}
	
	
	protected final function prototype_deletefake($obj,$msg=NULL){
		if($msg===NULL){
			$msg = __("Deleted successfully.");
		}
		
		$phperror = ob_get_clean();
		ob_start();
		if(trim($phperror)!='' && $phperror!=NULL){
			SaveDS()->Warning('phperror',($phperror));
		}

		if(SaveDS()->ifError){
			$this->prototype_json_result();
		}else{
			self::prototype_json_result($msg,array('isdelete'=>1,'classname'=>get_class($obj),'id'=>$obj->id));
		}
		$this->Process_Json($json);
	}
	protected final function prototype_json_result($msg=NULL,$recordArray=NULL){
		if($msg===NULL){
			$msg = __("Save complete");
		}
		
		$phperror = ob_get_clean();
		ob_start();
		if(trim($phperror)!='' && $phperror!=NULL){
			SaveDS()->Warning('phperror',$phperror);
		}

		if(!SaveDS()->ifError){
			$json = array(
				"success" => true,
				"warning" => SaveDS()->GetWarningMsg(),
				"messages" => $msg,
				"option" => SaveDS()->GetOption()
			);
			if($recordArray!=NULL){
				$json['record']	= $recordArray;
			}
		}else{
			$json = array(
				"success" => false,
				"messages" => SaveDS()->GetWarningMsg().SaveDS()->GetErrorMsg(),
				"option" => SaveDS()->GetOption()
			//"messages" => SaveDS()->GetErrorMsg()
			);
		}
		$this->Process_Json($json);
	}

	protected final function prototype_refresh_record($recordArray){
		$phperror = ob_get_clean();
		ob_start();
		if(trim($phperror)!='' && $phperror!=NULL){
			SaveDS()->Warning('phperror',($phperror));
		}

		if(!SaveDS()->ifError) {
			$result = array(
				"success" => true,
				"messages" => __("Save complete"),
				"warning" => SaveDS()->GetWarningMsg(),
				"option" => SaveDS()->GetOption(),
				"record" => $recordArray
			);
			$this->Process_Json($result);
		} else {
			$result = array(
				"success" => false,
				"messages" => SaveDS()->GetErrorMsg().SaveDS()->GetWarningMsg(),
				"option" => SaveDS()->GetOption()
			//"warning" => SaveDS()->GetWarningMsg()
			);
			$this->Process_Json($result);
		}
	}
	protected final function prototype_refresh_recordX($callback,$recordArray){
		
		if(!SaveDS()->ifError) {
			$result = array(
					"success" => true,
					"messages" => __("Save complete"),
					"warning" => SaveDS()->GetWarningMsg(),
					"option" => SaveDS()->GetOption(),
					"record" => $recordArray
			);
			$this->Process_XJSON($callback,$result);
		} else {
			$result = array(
					"success" => false,
					"messages" => SaveDS()->GetErrorMsg().SaveDS()->GetWarningMsg(),
					"option" => SaveDS()->GetOption()
			//"warning" => SaveDS()->GetWarningMsg()
			);
			$this->Process_XJSON($callback,$result);
		}
	}


	
	

	public function GetAct(){
		return str_replace(ABSTRACT_ACTIONCLASS."_","",get_class($this));
	}
	public function GetTodo(){
		return $this->current_todo;
	}	
	/*

	public function GetUrlList(){	return "index.php?act=".$this->GetAct()."&todo=show";}
	public function GetUrlAdd(){	return "index.php?act=".$this->GetAct()."&todo=add";}
	public function GetUrlEdit(){	return "index.php?act=".$this->GetAct()."&todo=edit";}
	public function GetUrlDelete(){	return "index.php?act=".$this->GetAct()."&todo=delete";}
	public function GetUrlSave(){	return "index.php?act=".$this->GetAct()."&todo=save";}*/


	public abstract function GetSector();

	/*public function __call($method, $args) {

	}*/


	/* Function for generate url of action
	 * Def(Joay_Action_xxx)->URL_yyy(array('id'=>0)) = index.php?act=xxx&todo=yyy&id=0
	* Def(Joay_Action_xxx)->HIDDEN_yyy(array('id'=>0)) = <input type=hidden name=act value=xxx/><input type=hidden name=todo value=yyy/><input type=hidden name=id value=0/>
	* Def(Joay_Action_xxx)->ACT = xxx
	* Def(Joay_Action_xxx)->CALL_yyy = yyy
	*
	*
	*
	*
	*
	*/
	public function __call($name, $arguments) {

		if(preg_match("/^(URL|EURL|HIDDEN)_(.*?)$/",$name,$match)){
			$basefunc = $match[1];
			$func = $match[2];
			//Inc_Var::vardump($name);
			//Inc_Var::vardump($arguments);
			$class = str_replace(ABSTRACT_ACTIONCLASS."_","",get_class($this));

			$compile_error = false;

			$paraminfo = Config_GetTodoArg(get_class($this),$func);
			if($paraminfo===NULL){
				$compile_error = "no function name \"$func\" for action $class ";
			}
			if($arguments==NULL){
				$arguments = array();
			}


			$ext_param = "";
			if($func!=""){
				$ext_param .= "&todo=".$func;
			}

			if(Req(prj)!='' &&
					!( 
						(get_class($this)=="Joay_Action_project" && $func=="active") ||  
						(get_class($this)=="Joay_Action_project" && $func=="editprojectier") ||  
						(get_class($this)=="Joay_Action_team" && $func=="list") ||
						(get_class($this)==Joay_Action_payredirect) ||
						(get_class($this)==Joay_Action_pushbutton) ||
						(get_class($this)==Joay_Action_pushpackage)
					)
				){
				$prj_param = "&prj=".Req(prj);
			}

			if(Req(apiemail)!='' && !(get_class($this)=="Joay_Action_api")){
				$prj_param .= "&apiemail=".Req(apiemail)."&apikey=".Req(apikey);
			}

			
			
			$count_pam = count($paraminfo);
			if($compile_error === false){
				if(is_array($arguments[0]) || $arguments[0]==NULL){
					$count_arg = count($arguments[0]);
					if($paraminfo!==NULL){

						foreach($paraminfo as $reqname => $def){
							if($reqname=='prj'){
								if($arguments[0][$reqname]=='' && Req(prj)!=''){
									$arguments[0][$reqname] = Req(prj);
									continue;
								}
							}

							if($def===NULL && !array_key_exists ($reqname,$arguments[0])){
								Inc_Var::vardump($arg_key);
								$compile_error = "function require parameter name $reqname";
								break;
							}
						}

						$special_arg = array('page','sector','topmsg','redirect','apiemail','apikey');
						if(is_array($arguments[0]))
						foreach($arguments[0] as $reqname => $targ){
							if(!array_key_exists ($reqname,$paraminfo) && !in_array($reqname,$special_arg)){
								$compile_error = "function not have parameter name $reqname";
								break;
							}
							$tmp_arg = $targ;
							if(preg_match("/^FORM_(.+)/",$tmp_arg,$fixinput)){
								if($fixinput[1]!=$reqname){
									$compile_error = "Argument not match {$fixinput[1]} != {$reqname}";
									break;
								}
								$i++;
								continue;
							}

							if(preg_match("/^(.*?)'\+(.+)\+'(.*?)$/",$tmp_arg,$scriptmatch)){
								$tmp_arg = "".$scriptmatch[1]."'+encodeURIComponent(".$scriptmatch[2].")+'".$scriptmatch[3]."";
							}

							if($reqname=='prj'){
								$prj_param = '';
							}

							if($tmp_arg!=''){
								$ext_param .= "&".$reqname."=".$tmp_arg;
							}
						}

					}else{
						if($count_arg>0){
							$compile_error = "function todo_{$func} have not defined any parameter";
						}
					}
				}else{
					$compile_error = "Argument must be array";
					/*$count_arg = count($arguments);
					 if($paraminfo!=NULL){
					$i=0;
					$start_ignore = false;
					foreach($paraminfo as $reqname => $def){
					if($count_min_pam==0 && $def!==NULL){
					$count_min_pam = $i - 1;
					}

					$tmp_arg = $arguments[$i];

					if($tmp_arg===NULL && $def!==NULL){
					break;
					}
					if(preg_match("/^FORM_(.+)/",$tmp_arg,$fixinput)){
					if($fixinput[1]!=$reqname){
					$compile_error = "Argument not match {$fixinput[1]} != {$reqname}";
					break;
					}
					$i++;
					continue;
					}


					$ext_param .= "&".$reqname."=".$tmp_arg;
					$i++;

					}
					}*/
				}
			}
			/*if($count_arg < $count_min_pam){
				$compile_error = "Argument count not match function require at least $count_min_pam";
			}elseif($count_arg > $count_pam){
			$compile_error = "Argument count not match function require at most $count_pam";
			}elseif($count_arg!=$count_pam){
			$compile_error = "Argument count not match";
			}*/
			if($compile_error!==false){
				ob_clean();
				$stack = debug_backtrace();

				echo "<pre>\n\n\n";
				echo "Message: {$compile_error} \n";
				echo $stack[0]['file']." #".$stack[0]['line']."\n\n\n";

				echo "CALL: Def(".get_class($this).")->URL_".$func."("."\n";
				echo "CLASS: ".get_class($this)."\n";
				echo "TODO: $func\n";
				echo "ARGUMENT:\n";
				var_dump($arguments[0]);
				echo "REQUIRE PARAMETER:\n";
				var_dump($paraminfo);
				echo ")\n\n";

				if($paraminfo!=NULL){
					echo("---------------------- HINT ---------------------------\n");
					echo("array(\n");
					foreach($paraminfo as $key => $defval){
						if($defval!==NULL)continue;
						echo "\t".'"'.$key.'"=>"FORM_'.$key.'",'."\n";
					}
					echo("\n");
					foreach($paraminfo as $key => $defval){
						if($defval===NULL)continue;
						echo "\t".'"'.$key.'"=>"FORM_'.$key.'",'."\n";
					}
					echo(")\n");
					echo("-------------------------------------------------------\n");
				}
				//echo "Hint: if you pass parameter by form use Joay_Action_{$class}::URL_{$func}(";
				//foreach($paraminfo as $reqname => $def){
				//	echo "FORM_$reqname,";
				//}





				echo "Strack:\n";

				debug_print_backtrace();
				echo "</pre>";
				exit("---------------------- COMPILE ERROR ARGUMENT NOT MATCH ---------------------------");
			}
			$getparam = "act=".$class.$ext_param.$prj_param;
			if($basefunc=='URL'){
				return "index.php?".$getparam;
			}elseif($basefunc=='EURL'){
				//$getparam = preg_replace('/&([\w\d]+)=/i','&amp;$1=',$getparam);
				$getparam = urlencode($getparam);
				preg_match_all('/%3C%3F%3D(.+?)%3F%3E/',$getparam,$matches);
				for($i=0;$i<count($matches[0]);$i++){
					$src = $matches[0][$i];
					$code = '<?='.urldecode($matches[1][$i]).'?>';
					$getparam = str_replace($src,$code,$getparam);
					/*echo "------------";
					Inc_Var::vardump($src);
					Inc_Var::vardump($code);
					Inc_Var::vardump($getparam);
					echo "-----/-------";*/
				}
				return "index.enp".$getparam;
			}elseif($basefunc=='HIDDEN'){
				$paramAr = Inc_Var::pairstr2Arr($getparam, "=", "&");
				$buildstring = "";
				foreach($paramAr as $key => $val){
					$buildstring .= '<input type="hidden" id="'.$key.'" name="'.$key.'" value="'.$val.'">';
				}
				return $buildstring;
			}
		}
		if(preg_match("/^CALL_(.+?)$/",$name,$match)){
			$func = $match[1];
			//Inc_Var::vardump($name);
			//Inc_Var::vardump($arguments);
			//$class = str_replace(ABSTRACT_ACTIONCLASS."_","",get_class(self::$DEF));
			return ''.$func;
		}
		if(preg_match("/^ACT$/",$name,$match)){
			$class = str_replace(ABSTRACT_ACTIONCLASS."_","",get_class($this));
			return $class;
		}
		exit("Undefine $name in ".get_class($this));
		//return call_user_func_array(array($this, "$name"),$arguments);
	}
}
