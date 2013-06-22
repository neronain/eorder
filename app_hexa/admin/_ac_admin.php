<?
class Joay_Action_admin extends Joay_Action{
	function GetSector(){	return "ADMIN";	}

	public function BeforeAction(){
		if(!Inc_Authen::IsAdmin()) {
			if(Conf()->DEBUG) {
				return;
			}elseif(Conf()->DEVSERVER && Inc_Authen::IsAdvanceUser()) {
				Inc_Htmlutil::forward(Def(Joay_Action_dashboard)->URL_());
			} else {
				exit('This is private section');
			}
		}
	}

	function todo_mysqlshow(){
		$this->Process_Html(Page_MysqlStatus::GenerateHtml());
	}

	
}
