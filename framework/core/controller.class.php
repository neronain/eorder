<?

abstract class Joay_Controller{
	static $controllerArray = array();
	private static $currentAction = NULL;
	private static $actionQueue = array();
	
	public static function Run(){
		$act = Req(act); 
		$todo = Req(todo); 
		$todo = str_replace("-",'',$todo);
		
		Joay_Controller::Process_Route_Start();
		$config_path = Config_GetClassPath("Joay_Action_{$act}");
		
		if($config_path!=NULL){
			$classname = "Joay_Action_{$act}";
			$actionclass = new $classname();
			//$classname::$DEF = $actionclass;
			Joay_Controller::SetCurrentAction($actionclass);
			Joay_Controller::Process_Loop();
			
		}elseif(file_exists("../index/{$act}.inc.php")){
			include_once "../index/{$act}.inc.php";
			if(class_exists("Joay_Action_{$act}")){
				$classname = "Joay_Action_{$act}";
				$actionclass = new $classname();
				//$classname::$DEF = $actionclass;
				Joay_Controller::SetCurrentAction($actionclass);
				Joay_Controller::Process_Loop();
			}else{
		
			}
		}else{
			echo "/* No action ".Req(act)." */";
		}		
		Joay_Controller::Process_Route_End();	
	}
	
	public static function Plug($plugin){
		//if(class_exists($plugin))return;
		//include_once "../plugins/{$plugin}.php";
		$controler = new $plugin();
		Joay_Controller::Add($controler);
	}
	public static function Add($controler){
		Joay_Controller::$controllerArray[] = $controler;
	}
	public static function GetCurrentAction(){
		return Joay_Controller::$currentAction;
	}
	public static function SetCurrentAction($action){
		Joay_Controller::$currentAction = $action;
	}	
	public static function Process_Route_Start(){
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Route_Start();
		}
	}
	public static function Process_Loop(){
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Loop_Start($act);
		}

		Joay_Controller::$currentAction->DoAction();
		
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Loop_End($act);
		}		
	}


	public static function Process_Action_Start($act){
		Joay_Controller::$currentAction = &$act;
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Action_Start($act);
		}
	}

	public static function Process_Html_Start(){
		Joay_Controller::$currentAction->AfterAction();
		Joay_Controller::Process_Action_End(Joay_Controller::GetCurrentAction());	

		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Loop_End($act);
		}	
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Html_Start();
		}
		
	}
	public static function Process_Html_End(){
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Html_End();
		}
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Loop_End($act);
		}		
		Joay_Controller::Process_Route_End();
		if(!Conf()->UNITTEST){
			exit();
		}
	}
	
	public static function Process_Json_Start(){
		header("Content-Type: application/x-javascript");
		
		Joay_Controller::$currentAction->AfterAction();
		Joay_Controller::Process_Action_End(Joay_Controller::GetCurrentAction());	

		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Loop_End($act);
		}	
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Json_Start();
		}
		
	}
	public static function Process_Json_End(){
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Json_End();
		}
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Loop_End($act);
		}		
		Joay_Controller::Process_Route_End();
		if(!Conf()->UNITTEST){
			exit();
		}
	}

	public static function Process_JsScript_Start(){
		Joay_Controller::$currentAction->AfterAction();
		Joay_Controller::Process_Action_End(Joay_Controller::GetCurrentAction());	

		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Loop_End($act);
		}	
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->JsScript_Start();
		}
		
	}
	public static function Process_JsScript_End(){
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->JsScript_End();
		}
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Loop_End($act);
		}		
		Joay_Controller::Process_Route_End();
		if(!Conf()->UNITTEST){
			exit();
		}
	}	
	
	


	public static function Process_Action_End($act){
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Action_End($act);
		}
	}
	

	public static function Process_Route_End(){
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Route_End();
		}
	}
	
	public static function RedirectAction($act,$todo='',$param=array()){
		$paramstring = Inc_Var::pairArr2Str($param,'=','&');
		$url = "index.php?act={$act}&todo={$todo}&".$paramstring;

		
		Joay_Controller::$currentAction->AfterAction();
		Joay_Controller::Process_Action_End(Joay_Controller::GetCurrentAction());
		
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Loop_End($act);
		}		
		
		$cancel = false;
		foreach(Joay_Controller::$controllerArray as $controler){
			$cancel |= $controler->OnJumpURL($url);
		}
		if(!$cancel){
			Joay_Controller::Process_Route_End();
			Inc_Htmlutil::forward($url);
		}else{
			Joay_Controller::Process_Route_End();
		}
		if(!Conf()->UNITTEST){
			exit();
		}
	}
	public static function RedirectTodo($todo='',$param=array()){
		$act = Req(act);
		Joay_Controller::RedirectAction($act,$todo,$param);
	}
		
	
	public static function ForwardUrl($url){
		Joay_Controller::$currentAction->AfterAction();
		Joay_Controller::Process_Action_End(Joay_Controller::GetCurrentAction());
		
		foreach(Joay_Controller::$controllerArray as $controler){
			$controler->Loop_End($act);
		}		

		$cancel = false;
		foreach(Joay_Controller::$controllerArray as $controler){
			$cancel |= $controler->OnJumpURL($url);
		}
		
		if(!$cancel){
			Joay_Controller::Process_Route_End();
			if(!Conf()->UNITTEST){
				Inc_Htmlutil::forward($url);
			}
		}else{
			Joay_Controller::Process_Route_End();
		}
		if(!Conf()->UNITTEST){
			exit();
		}
	}	
	public static function ForwardTodo($todo='',$param=array()){
		Joay_Controller::ForwardAction(Req(act),$todo,$param);
	}
	public static function ForwardAction($act,$todo='',$param=array()){
	
		Joay_Controller::$currentAction->AfterAction();
		Joay_Controller::Process_Action_End(Joay_Controller::GetCurrentAction());		
	
	
		$cancel = false;
		$url = "index.php?act={$act}&todo={$todo}";
		foreach($param as $key => $value){
			$url .= "&{$key}={$value}";
		}
		foreach(Joay_Controller::$controllerArray as $controler){
			$cancel |= $controler->OnJumpAction($act,$todo,$param);
		}
		if(!$cancel){
			
				if($param!=Req()){
					Req()->Clear();
				}
				Req()->act = $act;
				Req()->todo = $todo;
				
				if($param!=Req()){
					foreach($param as $key => $val){
						Req()->__set($key,$val);
					}
				}

				$classname = "Joay_Action_{$act}";
				$actionObj = new $classname();
				$actionObj->DoAction();
		}
	}	
	
	
	public abstract function Route_Start();
	public abstract function Loop_Start();
	public abstract function Action_Start($act);
	//public abstract function Todo_Start($act,$todo);
	public abstract function Html_Start();
	public abstract function Html_End();
	public abstract function Json_Start();
	public abstract function Json_End();
	public abstract function JsScript_Start();
	public abstract function JsScript_End();
	//public abstract function Todo_End($act,$todo);
	public abstract function Action_End($act);
	public abstract function Loop_End();
	public abstract function Route_End();
	public function OnJumpURL($url){}
	public function OnJumpAction($act,$todo,$param){}
}
