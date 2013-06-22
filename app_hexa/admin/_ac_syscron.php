<?

class Joay_Action_syscron extends Joay_Action{
	function GetSector(){	return "ADMIN";	}
	
	public function BeforeAction(){
		if(!Inc_Authen::IsAdmin()) {
			if(Conf()->DEVSERVER && Inc_Authen::IsAdvanceUser()) {
				Inc_Htmlutil::forward(Def(Joay_Action_dashboard)->URL_());
			} else {
				exit(__('This is private section'));
			}
		}
	}
	
	function /*@VOID*/todo_list(){
	
		$objArray = MD_SysCronArray::BuildAllRecord();
		$this->Process_Html(Def(ListPage_SysCron)->GenerateHtml($objArray));
	}

	function /*@VOID*/todo_edit($id,$cronclass=''){
		if($id==-1){
			$obj = new MD_SysCron();
			$obj->cronclass = $cronclass;
		}else{
			$obj = MD_SysCron::BuildByID($id);
		}
		$this->Process_Html(Def(Dialog_SysCron)->GenerateForm($obj));
	}

	function /*@VOID*/todo_save($id,$enable,$allow_instant,$maximum_instant,$limit_instant,$nextexedate,$maxexecutetime,$cronclass,$croninterval){
		$obj = NULL;
		if($id==-1){
			$obj = new MD_SysCron();
		}else{
			$obj = MD_SysCron::BuildByID($id);
		}

		$obj->enable = $enable;
		
		$obj->allow_instant = $allow_instant;
		
		$obj->maximum_instant = $maximum_instant;
		$obj->limit_instant = $limit_instant;
		
		
		$obj->nextexedate = $nextexedate;
		$obj->maxexecutetime = $maxexecutetime;
		
		$obj->cronclass = $cronclass; 					
		$obj->croninterval = $croninterval;
		
		
		$obj->update();
		
		if(!$obj->enable){
			MD_SysInstant::Restart($id);
		}		
		

		parent::prototype_refresh_record(Repeater_syscron_list::NormalizeData($obj));
	}

	function /*@VOID*/todo_delete($id){
		//Conf()->DEBUGSQL = true;
		$obj = MD_SysCron::BuildByID($id);
		$obj->DeleteMe();
		
		parent::prototype_deletefake($obj);
	}

	function /*@VOID*/todo_toggle_enable($id){
		$obj = MD_SysCron::BuildByID($id);
		if(!$obj->WriteAble())
		exit("Permission Denied");
	
		$obj->enable = !$obj->enable;
		$obj->update();
		
		if(!$obj->enable){
			MD_SysInstant::Restart($id);
		}
	
		parent::prototype_refresh_record(Repeater_syscron_list::NormalizeData($obj));
	
	}
	function /*@VOID*/todo_alter_instant($id,$diff){
		$obj = MD_SysCron::BuildByID($id);
		if(!$obj->WriteAble())
		exit("Permission Denied");
	
		
		//Conf()->DEBUGSQL = true;
		//Inc_Var::vardump($obj->maximum_instant+ $diff);
		
		if($diff>0){	
			MD_SysCron::Instant_Increase($id,$obj->maximum_instant+ $diff);
		}else{
			MD_SysCron::Instant_Decrease($id,$obj->maximum_instant+ $diff);
		}
	
		ModelObjectCaching::Clear(MD_SysCron, $id);
		$obj = MD_SysCron::BuildByID($id);
		
		parent::prototype_refresh_record(Repeater_syscron_list::NormalizeData($obj));
	
	}
	function /*@VOID*/todo_alter_limitinstant($id,$diff){
		$obj = MD_SysCron::BuildByID($id);
		if(!$obj->WriteAble())
		exit("Permission Denied");
	
		
		
		$obj->limit_instant = $obj->limit_instant+$diff;
		$obj->Update();
	
		MD_SysInstant::Restart($obj->id);
		
		parent::prototype_refresh_record(Repeater_syscron_list::NormalizeData($obj));
	
	}
		
	function /*@VOID*/todo_refresh($id){
		$obj = MD_SysCron::BuildByID($id);
		parent::prototype_refresh_record(Repeater_syscron_list::NormalizeData($obj));
	
	}	
	
	
	
	function /*@VOID*/todo_toggle_domain($id,$domain){
		$obj = MD_SysCron::BuildByID($id);
		if(!$obj->WriteAble())
		exit("Permission Denied");
	
		$domain = str_replace('_','.',$domain);
		
		$allow_instant = $obj->allow_instant;
		
		if(in_array($domain, $allow_instant)){
			$allow_instant = array_diff($allow_instant, array($domain));
		}else{
			$allow_instant[] = $domain;
		}
		
		$obj->allow_instant = $allow_instant;
		$obj->update();
	
		parent::prototype_refresh_record(Repeater_syscron_list::NormalizeData($obj));
	
	}	
	
	
	
	

}


