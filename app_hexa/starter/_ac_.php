<?

class Joay_Action_ extends Joay_Action{
	function GetSector(){	return "INDEX";	}
	function BeforeAction(){	

	}


	function todo_(){
		
		Inc_SessionCache::Clean();
		Conf()->MAX_PASSWORD_RETRY = 3;
		

		
		if(Inc_Authen::GetCurrentMember()!=null){
			
			
			$forwardSuccess['AD'] = "admin/index.php";
			$forwardSuccess['MN'] = "admin/index.php";
			$forwardSuccess['CM'] = "cfrontend/dashboard.php";
			$forwardSuccess['ST'] = "staff/index.php";
			$forwardSuccess['DC'] = "cfrontend/dashboard.php";
			
			
			$this->ForwardUrl($forwardSuccess[Inc_Authen::GetCurrentMember()->usr_ugp_id]);
			
			//$this->ForwardUrl(Def(Joay_Action_)->URL_starter());
		}else{
			Conf()->MAINSECTOR="HOME";

			Conf()->global_unlock_readable = true;
			Conf()->global_unlock_writeable = true;
			
			if(Inc_Server::is_https()){
				$this->SwapProtocol();
			}
			$this->ForwardUrl("cfrontend/login.php");
			//$this->Process_Html(Page_Login::GenerateHtml());
		}		
	}
	
	function todo_starter(){
		
		if(Conf()->ENABLEHTTPS && !Inc_Server::is_https()){
			$this->SwapProtocol();
		}
		
		
		
		//$this->Process_Html(Page_Starter::GenerateHtml());
	}


}
