<?


class stopforward extends Joay_Controller{
	public function Route_Start(){
	}
	public function Loop_Start(){
	}		
	public function Action_Start(/*TODO:V+UU*/$act){
	}

	public function Html_Start(){
	}
	public function Html_End(){
	}
	public function Json_Start(){
	}
	public function Json_End(){
	}
	public function JsScript_Start(){
	}
	public function JsScript_End(){
	}
	public function Action_End(/*TODO:V+UU*/$act){
	}
	public function Loop_End(){
	}
	public function Route_End(){
	}
	
	public function OnJumpURL($url){
		Inc_Var::vardump($url);
		return true;
	}

	public function OnJumpAction($act,$todo,$param){
		echo "act ".$act."<br>";
		echo "todo ".$todo."<br>";
		echo "param "."<br>";
		Inc_Var::vardump($param);
		return true;
	}	
	

}





