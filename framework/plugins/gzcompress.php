<?


class gzcompress extends Joay_Controller{
	public function Route_Start(){
	}
	public function Loop_Start(){
	}		
	public function Action_Start($act){
	}


	public function Html_Start(){
	}
	public function Html_End(){
			if(!Conf()->DISABLE_gzcompress){
			if(!Conf()->LOADING_MASK || Conf()->LOADING_MASK_NOFLUSH){
				Inc_Io::CompressOutput();
			}	
		}
	}
	public function Json_Start(){
	}
	public function Json_End(){
			if(!Conf()->DISABLE_gzcompress){
			if(!Conf()->LOADING_MASK || Conf()->LOADING_MASK_NOFLUSH){
				Inc_Io::CompressOutput();
			}	
		}
	}
	public function JsScript_Start(){
	}
	public function JsScript_End(){
			if(!Conf()->DISABLE_gzcompress){
			if(!Conf()->LOADING_MASK || Conf()->LOADING_MASK_NOFLUSH){
				Inc_Io::CompressOutput();
			}	
		}
	}
	
	

	public function Action_End($act){
	}
	public function Loop_End(){
	}
	public function Route_End(){

	}
	
	public function OnJumpURL($url){

	}

	public function OnJumpAction($act,$todo,$param){
	
	}	
	

}





