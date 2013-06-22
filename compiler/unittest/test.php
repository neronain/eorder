<?



class testcontrol extends Joay_Controller{
	public function Route_Start(){
		echo "Route_Start<br>";
	}
	public function Action_Start($act){
		echo "Action_Start<br>";
	}
	public function Todo_Start($todo){
		echo "Todo_Start<br>";
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
	
	
	public function Todo_End($todo){
		echo "Todo_End<br>";
	}
	public function Action_End($act){
		echo "Action_End<br>";
	}
	public function Route_End(){
		echo "Route_End<br>";
	}
}

Joay_Controller::Add(new testcontrol());
$act="test";
chdir("../");
include "index.php";




