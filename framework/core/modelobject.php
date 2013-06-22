<?


$global_disable_auto_id = false;


class ModelObjectCaching{
	static /*@array*/$ModelObjectCachingArray = array();
	public static /*@array*/$disable_caching = array();
	public static function /*@VOID*/Push(/*@ModelObject*/&$obj){
		//Inc_Var::vardump(ModelObjectCaching::$disable_caching);
		if(in_array(get_class($obj),ModelObjectCaching::$disable_caching))return;
		//echo "Push [".get_class($obj)."][".$obj->Get('id')."]<br/>";
		ModelObjectCaching::$ModelObjectCachingArray[get_class($obj)][$obj->Get('id')] = & $obj;
	}
	public static function /*@ModelObject*/Get(/*@CLASSNAME*/$class,/*@DBID*/$id){
		if(in_array($class,ModelObjectCaching::$disable_caching))return;
		//echo "Get [".$class."][".$id."]";
		//echo (ModelObjectCaching::$ModelObjectCachingArray[$class][$id]==NULL?"NULL":"OBJ")."<br/>";
		return ModelObjectCaching::$ModelObjectCachingArray[$class][$id];
	}
	public static function /*@VOID*/Clear(/*@CLASSNAME*/$class,/*@DBID*/$id){
		unset(ModelObjectCaching::$ModelObjectCachingArray[$class][$id]);
	}
	public static function /*@VOID*/ClearClass(/*@CLASSNAME*/$class){
		unset(ModelObjectCaching::$ModelObjectCachingArray[$class]);
	}
	public static function /*@VOID*/ClearAll(){
		foreach(self::$ModelObjectCachingArray as $key => $obj){
			unset(self::$ModelObjectCachingArray[$key]);
		}
	}
	public static function /*@VOID*/Debug_Memory(){
		echo "ModelObjectCaching::Debug_Memory\n";
		foreach(self::$ModelObjectCachingArray as $class => $data){
			echo $class."[".count($data)."]";
			/*foreach($data as $id => $obj){
			}*/
		}
	}
}




abstract class ModelObject {
	//Native data on database
	protected /*@array*/$data = array ();
	protected /*@array*/$olddata = array ();
	protected /*@array*/$unfretch_col = array ();
	//Reference data on database (read only)
	protected /*@array*/$refdata = array ();
	protected /*@bool*/$isNew = false;
	protected /*@bool*/$isModify = false;
	protected /*@bool*/$isDelete = false;
	public /*@bool*/$local_unlock_superable = false;
	public /*@bool*/$local_unlock_writeable = false;
	public /*@bool*/$local_unlock_readable = false;

	protected /*@array*/$_cached_custom = NULL;
	public /*@bool*/$disable_log = false;

	//public $classname = "ModelObject";
	//private $backupQry = null;

	public static /*@string*/$primarytable = "Please set Primary table";



	static function /*@UNIQUEARRAY*/UNFETCHARRAY(){
		return array ();
	}

	static function /*@UNIQUEARRAY*/UNIQUEARRAY(){
		return /*(UNIQUEARRAY)*/array ();
	}

	static function /*@INDEXARRAY*/INDEXARRAY(){
		return array ();
	}

	static function /*@FULLTEXTARRAY*/FULLTEXTARRAY(){
		return array ();
	}

	//public static abstract function BuildByID($id);
	//public static abstract function BuildByData($rsdata);


	public function /*@ModelObject*/ModelObject(){
		//
		//$this->Qry() = Qry();
		//$this->SaveDS() = SaveDS();
		$this->isNew = true;
		$this->isModify = true;
		
		//if(Conf()->DEBUG) Inc_Io::DebugMemoryLeak();

		foreach($this->GetColumnArrayFull() as $key => $type){

			$optionindex = strpos($type,'|');
			if($optionindex>0){
				$option = substr($type,$optionindex+1);
				$type = substr($type,0,$optionindex);
				$optionarray = explode(",",$option);
			}

			if($type=="REF"){
				$this->refdata[$key] = "";
			}elseif($type=="array" || $type=="set"){
				$this->data[$key] = array();
			}elseif($type=="bool"){
				$this->data[$key] = false;
			}else{
				$this->data[$key] = "";
			}
		}
		$this->data['id'] = "-1";

		$this->Init();
		$this->Init2();
	}
	
	
	protected function OnCompressForCache(){
	}
	protected function GetCompressSkipCol(){
		return array();
	}
	public function CompressForCache($skipDeleteCol=NULL){
		$cloneObj = clone $this;
		
		$cloneObj->OnCompressForCache();
		if($skipDeleteCol==NULL){
			$skipDeleteCol = $cloneObj->GetCompressSkipCol();
		}
		foreach($cloneObj->GetColumnArrayFull() as $key => $type){
			if(in_array($key, $skipDeleteCol))continue;
			
			if($type=="REF"){
				unset($cloneObj->refdata[$key]);
			}else{
				unset($cloneObj->data[$key]);
			}
		}
		unset($cloneObj->olddata);
		unset($cloneObj->unfretch_col);
		unset($cloneObj->local_unlock_superable);
		unset($cloneObj->local_unlock_writeable);
		unset($cloneObj->local_unlock_readable);
		unset($cloneObj->isNew);
		unset($cloneObj->isModify);
		unset($cloneObj->isDelete);
		unset($cloneObj->_cached_custom);
		
		return $cloneObj;
	}
	public function DecompressForCache(){
		foreach($this->GetColumnArrayFull() as $key => $type){
			if($type=="REF")continue;
			$this->unfretch_col[$key]=true;
		}
		foreach($this->data as $key=>$value){
			$this->olddata[$key] = $value;
			$this->unfretch_col[$key]=false;
		}
	}
	

	public function /*@VOID*/Init(){
	}
	public function /*@VOID*/Init2(){
		/*Inc_Var::vardump($this);
		echo "<pre>";
		debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
		echo "</pre>";
		exit();*/
		
		$col =  $this->GetColumnArrayFull();
		if($col['member_id']!='' && $this->member_id==0){
			$this->member_id = $_SESSION['session_userdentalid'];
			//Inc_Var::vardump($_SESSION['session_userdentalid']);
			
			//debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
			//exit('Start');
			
			//if(get_class($this)=='MD_HSEmail'){
			//	Inc_Var::vardump(Inc_Authen::GetCurrentMember());
			//}
			//Inc_Var::vardump($_SESSION['session_userdentalid']);
			//Inc_Var::vardump($_SESSION);
		}
		
	}

	public function /*@bool*/IsNew(){
		return $this->isNew;
	}
	public function /*@bool*/IsDelete(){
		return $this->isDelete;
	}
	public function /*@bool*/IsModify(/*@ModelObject:column*/$column=NULL,$ignoreAr=NULL){
		if($column==NULL && $ignoreAr==NULL)
		return $this->isModify;
			
		
		
		if(is_array($column)) {
			$is_modify = false;
			foreach($column as $val) {
				if($ignoreAr!=NULL){
					if(is_array($ignoreAr)){
						if(in_array($val, $ignoreAr))continue;
					}else{
						if($val==$ignoreAr)continue;
					}
				}
				
				$is_modify = $is_modify || ($this->olddata[$val]!=$this->data[$val]);
				if($is_modify)return true;
			}
			return $is_modify;
		} else if($column==NULL) {
			
			$columnArrayFull = $this->GetColumnArrayFull();
			foreach($columnArrayFull as $column => $type){
				if($ignoreAr!=NULL){
					if(is_array($ignoreAr)){
						if(in_array($column, $ignoreAr)){
							return false;
						}
					}else{
						if($column==$ignoreAr){
							return false;
						}
					}
				}
				
				
				
				$is_modify = $this->olddata[$column]!=$this->data[$column];
				if($is_modify){
					if($this->olddata[$column]==="[]" && $this->data[$column]===""){
						$is_modify =  false;
					}elseif(is_numeric($this->olddata[$column])){
						
					}else{
						$is_modify = $this->olddata[$column] != str_replace(array("\\r","\\n"),array("\r","\n"),$this->data[$column]);
					}
				}

				if($is_modify){
					return true;
				}
			}
			return false;	
		} else {
			
			if($ignoreAr!=NULL){
				if(is_array($ignoreAr)){
					if(in_array($column, $ignoreAr)){
						return false;
					}
				}else{
					if($column==$ignoreAr){
						return false;
					}
				}
			}
			
			
			
			$is_modify = $this->olddata[$column]!=$this->data[$column];
			if($is_modify){
				/*if(Conf()->DEBUG && $column=='cache_relateprojectier'){
					Inc_Var::vardump($this->olddata[$column]);
					Inc_Var::vardump($this->data[$column]);
				}*/
				if($this->olddata[$column]==="[]" && $this->data[$column]===""){
					$is_modify =  false;
				}elseif(is_numeric($this->olddata[$column])){
					
				}else{
					$is_modify = $this->olddata[$column] != str_replace(array("\\r","\\n"),array("\r","\n"),$this->data[$column]);
				}
			}
			
			
			return $is_modify;
		}
	}
	public function /*@VOID*/ForceCopyOldData(){
		$columnArrayFull = $this->GetColumnArrayFull();
		foreach($columnArrayFull as $column => $type){
			$this->olddata[$column] = 	$this->data[$column];
		}
	}
	
	
	public function /*@VOID*/ForceSetIsNew(/*@bool*/$value){
		$this->isNew = $value;
		if($value){
			$this->id =-1;
			$columnArrayFull = $this->GetColumnArrayFull();
			foreach($columnArrayFull as $column => $type){
					
				$optionindex = strpos($type,'|');
				if($optionindex>0){
					$option = substr($type,$optionindex+1);
					$type = substr($type,0,$optionindex);
					$optionarray = explode(",",$option);
				}
				/*if($type=='varchar' || $type=='text' || $type=='longtext' ||  $type=='textdata'){
					$this->data[$column] = mysql_real_escape_string($this->data[$column]);
				}*/
			}
		}
		ModelObjectCaching::Clear(get_class($this),$this->Get('id'));
	}
	
	public function /*@bool*/SuperAble(){
		if(Conf()->global_unlock_superable) return true;
		if($this->local_unlock_superable) return true;
		
		if(Inc_Authen::GetCurrentMember()==null){
			return false;
		}
		if(Inc_Authen::GetCurrentMember()->id>0 && (Inc_Authen::GetCurrentMember()->id==$this->member_id || Inc_Authen::GetCurrentMember()->id==$this->owner_id)){
			return true;
		}
		if(Inc_Authen::IsAdmin()){
			return true;
		}
	}
	public function /*@bool*/WriteAble(){
		
		if(Conf()->global_unlock_superable===TRUE) return true;
		if($this->local_unlock_superable===TRUE) return true;
		
		if(Conf()->global_unlock_writeable===TRUE) return true;
		if($this->local_unlock_writeable===TRUE) return true;

		if(Inc_Authen::GetCurrentMember()==null){
			return false;
		}
		if(Inc_Authen::GetCurrentMember()->id>0 && (Inc_Authen::GetCurrentMember()->id==$this->data['member_id'] || Inc_Authen::GetCurrentMember()->id==$this->data['owner_id'] || Inc_Authen::GetCurrentMember()->id==WHITELABEL_SYS_ACCID)){
			return true;
		}
		if(Inc_Authen::IsAdmin()){
			return true;
		}


		if(Inc_Authen::IsMod()){
			$owner_id = 0;
			if($owner_id == 0 && is_numeric($this->data['owner_id'])){
				$owner_id = $this->data['owner_id'];
			}
			if($owner_id == 0 && is_numeric($this->data['owner_id'])){
				$owner_id = $this->data['member_id'];
			}
			$ownerObj = MD_UserDental::BuildByID($owner_id);
			if($ownerObj!=NULL){
				if(Inc_Authen::checkPackage('PP_BASIC',false,$ownerObj->GetMemberShipVENDER()->name)){
					return true;
				}
			}
		}	




		return false;
	}
	public function /*@bool*/ReadAble(){
		
		if(Conf()->global_unlock_superable===TRUE) return true;
		if($this->local_unlock_superable===TRUE) return true;
		
		if(Conf()->global_unlock_writeable===TRUE) return true;
		if($this->local_unlock_writeable===TRUE) return true;
		
		if(Conf()->global_unlock_readable===TRUE) return true;
		if($this->local_unlock_readable===TRUE) return true;
		//TODO: manage permission across member(ie affiliate will see some informaiton)
		//return true;
		
		
		//if(!Conf()->DEVSERVER)return true;
		
		
		if(Inc_Authen::GetCurrentMember()==null){
			return false;
		}
		if(Inc_Authen::GetCurrentMember()->id>0 && ($this->member_id==1||Inc_Authen::GetCurrentMember()->id==$this->member_id || Inc_Authen::GetCurrentMember()->id==$this->owner_id)){
			return true;
		}
		if(Inc_Authen::IsAdmin()){
			return true;
		}
		
		if(Inc_Authen::IsMod()){
			$owner_id = 0;
			if($owner_id == 0 && is_numeric($this->data['owner_id'])){
				$owner_id = $this->data['owner_id'];
			}
			if($owner_id == 0 && is_numeric($this->data['owner_id'])){
				$owner_id = $this->data['member_id'];
			}
			$ownerObj = MD_UserDental::BuildByID($owner_id);
			if($ownerObj!=NULL){
				if(Inc_Authen::checkPackage('PP_BASIC',false,$ownerObj->GetMemberShipVENDER()->name)){
					return true;
				}
			}
		}		

		//$cols = $this->GetColumnArrayFull();
		/*if($cols['access']==null){
			return true;
		}*/

		/*if($this->access=='FREE'){
			return true;
		}



		if(Inc_Authen::GetCurrentMember()==null){
		return false;
		}
		if(Inc_Authen::GetCurrentMember()->Get('id')==$this->Get('member_id')){
		return true;
		}
			
		if(Inc_Authen::IsAdmin()){
		return true;
		}
			
		if(get_class($this)=='MD_UserDental'){
		//if(Inc_Authen::GetCurrentMember()->Get('id')==$this->Get('id'))
		return true;

		//if(Inc_Authen::GetCurrentMember()->Get('iscustomer')==true)
		//	return true;
		}
			
			
			
		$cols = $this->GetColumnArrayFull();
		if (get_class($this)!='MD_UserDental' && !array_key_exists("member_id",$cols)) {
		return true;
		}
		*/
		return false;
	}
	
	public function Assert($compare,$type='BASIC'){
		
		if($type!='BASIC'){
			exit('Unimplement permission type '.$type);
		}
		
		if($compare==PERM_NO){
			return;
		}
		if($compare==PERM_VW){
			if(!$this->ReadAble()){
				if(Conf()->DEBUG){
					debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				}
				exit('Permission denied');
			}
			return;	
		}
		if($compare==PERM_ED){
			if(!$this->WriteAble()){
				if(Conf()->DEBUG){
					debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				}
				exit('Permission denied');
			}	
			return;
		}
		exit('Unimplement permission level '.$compare);
	}	
	
	

	public function /*@VOID*/SetBySendingParam(/*@ModelObject:column*/$attname, /*@string*/$paramname=null) {
		if($paramname==null) $paramname = $attname;
		$value = Req($paramname);
		$col = $this->GetColumnArrayFull();
		$type = $col[$attname];
		$optionindex = strpos($type,'|');
		if($optionindex>0){
			$option = substr($type,$optionindex+1);
			$type = substr($type,0,$optionindex);
			$optionarray = explode(",",$option);
		}
		//echo $type;
		if($type=='bool' || ($type=='CUS' && $option=='bool')){
			$this->SetValue($attname, $value=='1' || $value=='true'|| $value=='TRUE');
		}else{
			$this->SetValue($attname, $value);
		}
	}
	public function /*@STRUCT{filename,size,path}*/SetUploadFile(/*@ModelObject:column*/$attname, /*@string*/$paramname) {
		
		
		if(isset($_FILES[$paramname]))
		{
			$attach = $_FILES[$paramname];
			$picture = '';
			if($attach['error']!=4)
			{
				$attachment = $attach['name'];
				$tmp_attachment  = $attach['tmp_name'];
				$attachment_size = $attach['size'];
				
				$md5checksum = md5_file($tmp_attachment);
				//Conf()->DEUBGSQL = true;
				$existPhysic = MD_File::BuildByMD5Size($md5checksum, $attachment_size);
				if($existPhysic!=NULL){
					$targetPath= $existPhysic->filepath;
				}else{
					$targetPath= Inc_Io::uploadfile($attachment,$tmp_attachment,$attachment_size);
				}
				if($targetPath==NULL)return NULL;
				
				$this->Set($attname,$targetPath);
				//Inc_Var::vardump($this);
				//exit();
				$retArray = array(
						"filename"=>$attachment,
						"size"=>$attachment_size,
						"path"=>$targetPath,
						"md5checksum"=>$md5checksum
				);
					
				return $retArray;
			}
		}
		return NULL;
	}
	public function /*@path*/SetUploadFileWithFilename(/*@ModelObject:column*/$attname, /*@string*/$paramname) {
		if(isset($_FILES[$paramname]))
		{
			$attach = $_FILES[$paramname];
			$picture = '';
			if($attach['error']!=4)
			{
				$attachment = $attach['name'];
				$tmp_attachment  = $attach['tmp_name'];
				$attachment_size = $attach['size'];
				$targetPath= Inc_Io::uploadfile($attachment,$tmp_attachment,$attachment_size);
				$this->Set($attname,$attachment.":".$targetPath);
				return $targetPath;
			}
		}
		return NULL;
	}

	public function /*@VOID*/HasKey(/*@ModelObject:column*/$attname) {
		$col = $this->GetColumnArrayFull();
		return array_key_exists( $attname,$col);
	}


	public function /*@VOID*/Set(/*@ModelObject:column*/$attname, /*@ANY*/$value) {
		$this->SetValue($attname, $value);
	}
	public function /*@VOID*/SetValue(/*@ModelObject:column*/$attname, /*@ANY*/$value) {
		
		/*if(Conf()->DEBUG && $attname=='member_id' && $value==2){
			Inc_Var::vardump($this);
			debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
			exit();
		}*/
		
		$value = $this->ParseSet($attname,$value);
		$col = $this->GetColumnArrayFull();
		if (!array_key_exists( $attname,$col)) {
			if(Conf()->DEBUG || Conf()->UNITTEST){
				echo "<pre>";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				echo "</pre>";
			}else{
				echo "<script>/*";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				echo "*/</script>";
			}
			exit("No key [$attname] for ".get_class($this)." class Value[$value]");
		}
		$type = $col[$attname];
		$optionindex = strpos($type,'|');
		if($optionindex>0){
			$option = substr($type,$optionindex+1);
			$type = substr($type,0,$optionindex);
			$optionarray = explode(",",$option);
		}
			
		if ($type=='REF'){
			if(Conf()->DEVSERVER || Conf()->UNITTEST){
				echo "<!-- ";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				echo " -->";
			}
			exit("Key [$attname] is readonly class[".get_class($this)."]");
			//Inc_Var::vardump($this);
		}
		if ($type=='CUS'){
			$type = $optionarray[0];
		}


		if ($type=='bool' && !is_bool($value)){
			if($value=='F' || $value=='f' || $value=='FALSE' || $value=='false' || $value=='0'  || $value==''){
				$value = false;
			}elseif($value=='T' || $value=='t' || $value=='TRUE' || $value=='true' || $value=='1'){
				$value = true;
			}
		}
		if (($type=='array'||$type=='set') && !is_array($value)){
			$tmp = $value;
			$value = array();
			if($tmp!=NULL)
			$value[] = $tmp;
		}
		
		if (($type=='json') && is_array($value)){
			$value = json_encode($value);
		}
		

		//Verify enum type
		if((Conf()->DEBUG || Conf()->UNITTEST)&& $type=='enum'){
			if($value!='' && !in_array($value,$optionarray)){
				echo "<pre>";
				echo "No type [$value] in enum [$attname] class [".$this->classname."]\n";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				echo "</pre>";
				exit();
			}
		}


		if ($this->data[$attname] == $value)
		return;
		$this->data[$attname] = $value;
		$this->isModify = true;
		$this->OnSetValue($attname, $value);
	}
	public function /*@VOID*/SetREF(/*@ModelObject:column*/$attname, /*@ANY*/$value) {
		$col = $this->GetColumnArrayFull();
		if (!array_key_exists( $attname,$col)) {
			if(Conf()->DEBUG || Conf()->UNITTEST){
				echo "<pre>";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				echo "</pre>";
			}
			exit("No key [$attname] for ".$this->classname." class Value[$value]");
		}
		$type = $col[$attname];
		$optionindex = strpos($type,'|');
		if($optionindex>0){
			$option = substr($type,$optionindex+1);
			$type = substr($type,0,$optionindex);
			$optionarray = explode(",",$option);
		}
			
		if ($type=='REF'){
			$this->refdata[$attname] = $value;
		}else{
			exit("Key [$attname] not REF");
		}
	}

	public function /*@VOID*/OnSetValue(/*@ModelObject:column*/$attname, /*@ANY*/$value) {
	}
	public function /*@array*/GetArray() {
		return $this->data;
	}
	function /*@ANY*/__get(/*@ModelObject:column*/$data)
	{
		return $this->Get($data);
	}
	function /*@VOID*/__set(/*@ModelObject:column*/$data,/*@ANY*/$value)
	{
		return $this->Set($data,$value);
	}
	function /*@bool*/__isset(/*@ModelObject:column*/$variablename)
	{
		return $this->Get($variablename)!="";
	}


	public function /*@ANY*/Get(/*@ModelObject:column*/$attname) {
		/*if(memory_get_usage(true)>1024*1024*10){
			echo "<pre>";
			debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
			echo "</pre>";
		
		exit('Exit mem');
		}*/
		return $this->GetValue($attname);
	}
	public function /*@ANY*/GetOld(/*@ModelObject:column*/$attname) {
		return $this->GetValue($attname,true);
	}
	public function /*@ANY*/GetSelf(/*@ModelObject:column*/$attname) {
		return Inc_SQL::CheckSafe($this->GetValue($attname));
	}
	public function /*@ANY*/GetSelfJS(/*@ModelObject:column*/$attname) {
		$val = $this->GetValue($attname);
		$val = str_replace("'","\\'",$val);
		$val = str_replace("\r\n","'+\r\n'",$val);
		return $val;
	}
	public function /*@ANY*/GetUnSelf(/*@ModelObject:column*/$attname) {
		$val = $this->GetValue($attname);
		$val = str_replace("\\'","'",$val);
		$val = str_replace('\\"','"',$val);
		//$val = str_replace("\r\n","'+\r\n'",$val);
		return $val;
	}
	public function /*@ANY*/GetValue(/*@ModelObject:column*/$attname,/*@bool*/$olddata=false) {
		
		switch($attname){
			case 'id':break;
			case 'member_id':break;
			case 'owner_id':break;
			case 'profile_id':break;
			case 'name':break;
			case 'autoresponder':break;
			default:
			/*if(!$this->ReadAble()){
				if(Conf()->DEBUG){
					echo "----------- Non Readable {$attname}-----------";
					Inc_Var::vardump($this);
				}
			}*/
		}
		
		
		
		$value = null;
		$cols = $this->GetColumnArrayFull();
		//var_dump($cols);
		if (!array_key_exists($attname,$cols)) {

			if(Conf()->UNITTEST){
				echo  "No key [$attname]\n";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
			}

			return "No key [$attname]";
		}

		$type = $cols[$attname];


		if($this->unfretch_col[$attname]){
			//echo "UNFRETCH ".$attname;
			//Inc_Var::vardump(debug_backtrace());
			$table = $this->GetPrimaryTable();
			//Conf()->DEBUGSQL = true;
			$data = Qry()->ExecuteScalar("select {$attname} from {$table} where id = {$this->id}");
			//Conf()->DEBUGSQL = false;
			$this->data[$attname] = $data;

			if($type=="bool")$this->data[$attname] = $this->data[$attname]>0;
			$this->olddata[$attname] = $this->data[$attname];

			$this->unfretch_col[$attname] = false;
		}













		$optionindex = strpos($type,'|');
		if($optionindex>0){
			$option = substr($type,$optionindex+1);
			$type = substr($type,0,$optionindex);
			$optionarray = explode(",",$option);
		}

		if ($type=="REF") {
			//echo "REF ".$this->refdata[$attname];
			$value = $this->refdata[$attname];
		} else if($olddata) {
			$value = $this->olddata[$attname];
		} else {
			$value = $this->data[$attname];
		}
		$value = str_replace("\\'","'",$value);
		$value = str_replace("\\{","{",$value);
		$value = str_replace("\\}","}",$value);
		$value = str_replace("\\\"","\"",$value);
		if($value=='' && ($type=='int' || $type=='decimal' || $type=='float' || $type=='signdecimal')){
			$value = (int)0;
		}
		//if(Conf()->global_unlock_readable) return $value;
		return $this->ParseGet($attname,$value);
	}


	public function /*@string*/GetJsonCustom($col,$attname=NULL){
		$_cached_custom = json_decode($this->Get($col), true);
		if($attname==NULL){
			return Inc_Var::decyptQuote($_cached_custom);
		}
		return Inc_Var::decyptQuote($_cached_custom[$attname]);
	}
	

	public function /*@string*/GetColCustom($col,$attname=NULL){
		$_cached_custom = json_decode($this->Get($col), true);
		if($attname==NULL){
			return Inc_Var::decyptQuote($_cached_custom);
		}
		return Inc_Var::decyptQuote($_cached_custom[$attname]);
	}	
	
	
	public function /*@VOID*/SetColCustom($col,/*@string*/$attname,/*@string*/$value){
		$_cached_custom = json_decode($this->Get($col), true);
		if($_cached_custom==NULL ) {
			$_cached_custom = array();
		}
		$_cached_custom[$attname] = Inc_Var::encyptQuote($value);
		
		$str = json_encode($_cached_custom);
		$this->Set($col,$str);
	}	
	
	
	
	
	public function /*@string*/GetCustom(/*@string*/$attname=NULL){
		$cols = $this->GetColumnArrayFull();
		if (!array_key_exists('custom',$cols)) {
			if(Conf()->DEBUG || Conf()->UNITTEST){
				echo "<pre>";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				echo "</pre>";
			}
			exit("No key custom ".get_class($this));
		}
		if($this->_cached_custom===NULL){
			$this->_cached_custom = json_decode($this->custom, true);
			if($this->_cached_custom==NULL ) {
				$this->_cached_custom = array();
			}
		}

		return Inc_Var::decyptQuote($this->_cached_custom[$attname]);
	}
	public function /*@string*/GetCustomArray(){
		$cols = $this->GetColumnArrayFull();
		if (!array_key_exists('custom',$cols)) {
			if(Conf()->DEBUG || Conf()->UNITTEST){
				echo "<pre>";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				echo "</pre>";
			}

			exit ("No key custom ".get_class($this));
		}
		if($this->_cached_custom===NULL){
			$this->_cached_custom = json_decode($this->custom, true);
			if($this->_cached_custom==NULL ) {
				$this->_cached_custom = array();
			}
		}
		foreach($this->_cached_custom as $k => $v){
			$ret[$k] = is_string($v) ? Inc_Var::decyptQuote($v) : $v;
		}
		return $ret;
	}

	public function /*@VOID*/SetCustom(/*@string*/$attname,/*@string*/$value){
		$cols = $this->GetColumnArrayFull();
		if (!array_key_exists('custom',$cols)) {
			if(Conf()->DEBUG || Conf()->UNITTEST){
				echo "<pre>";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				echo "</pre>";
			}

			exit("No key custom ".get_class($this));
		}
		if($this->_cached_custom===NULL){
			$this->_cached_custom = json_decode($this->custom, true);
			if($this->_cached_custom==NULL ) {
				$this->_cached_custom = array();
			}
		}
		$this->_cached_custom[$attname] = is_string($value) ? Inc_Var::encyptQuote($value) : $value;
		$str = json_encode($this->_cached_custom);
		$this->custom = $str;
	}
	public function /*@VOID*/DeleteCustom(/*@string*/$attname){
		$cols = $this->GetColumnArrayFull();
		if (!array_key_exists('custom',$cols)) {
			if(Conf()->DEBUG){
				echo "<pre>";
				debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
				echo "</pre>";
			}
			exit("No key custom ".get_class($this));
		}
		if($this->_cached_custom===NULL){
			$this->_cached_custom = json_decode($this->custom, true);
			if($this->_cached_custom==NULL ) {
				$this->_cached_custom = array();
			}
		}
		unset($this->_cached_custom[$attname]);
		$str = json_encode($this->_cached_custom);
		$this->custom = $str;
	}




	public function /*@ANY*/ParseGet(/*@ModelObject:column*/$attname,/*@ANY*/$value){
		return $value;
	}
	public function /*@ANY*/ParseSet(/*@ModelObject:column*/$attname,/*@ANY*/$value){
		return $value;
	}

	public static abstract function /*@MD_Optin:columnarray*/GetColumnArrayFull();

	public static abstract function /*@VOID*/ExecuteChangeMember(/*@DBID*/$oldid,/*@DBID*/$newid);

	public function /*@VOID*/OnBeforeUpdate0(){
	}
	public function /*@VOID*/OnBeforeUpdate(){
	}
	public function /*@VOID*/OnBeforeUpdate2(){
	}
	public function /*@VOID*/OnAfterUpdate0(){
	}
	public function /*@VOID*/OnAfterUpdate(){
	}
	public function /*@VOID*/OnAfterUpdate2(){
	}
	
	function /*@VOID*/UpdateWithoutPermission(/*@bool*/$bypass=false) {
		$this->local_unlock_writeable = true;
		$updateResult = $this->Update($bypass);
		$this->local_unlock_writeable = false;
		return $updateResult;
	}
	
	function /*@VOID*/Update(/*@bool*/$bypass=false) {
		//Inc_Log::debug_disableme();
		//Inc_Var::vardump($this);
		global  $global_disable_auto_id;
		$table = $this->GetPrimaryTable();
		if (!$this->isModify)
		return SaveDS();

		if(!$bypass){
			SaveDS()->Append($this->OnBeforeUpdate0());
			SaveDS()->Append($this->OnBeforeUpdate());
			SaveDS()->Append($this->OnBeforeUpdate2());

		}
		
		

		// #####################    Check exist record    #########################
		if ($this->IsNew() && (!$bypass|$this->data["id"]==-1)) {
			Qry()->AddNew();
		} else {
			$id = $this->data["id"];
			// Checking dupicate record that has this id

			/*Qry()->Query("select * from {$table} where id=$id limit 1");
			 if (Qry()->EOF) {
			SaveDS()->Put('id',__('Invalid ID'));
			return SaveDS();
			}*/
		}


		if (!SaveDS()->ifError) {
			$setQryData = array();
			$columnArrayFull = $this->GetColumnArrayFull();
			foreach($columnArrayFull as $column => $type){
					
				$optionindex = strpos($type,'|');
				if($optionindex>0){
					$option = substr($type,$optionindex+1);
					$type = substr($type,0,$optionindex);
					$optionarray = explode(",",$option);
				}
					
				if($column=="id" && $this->IsNew() && $type=="auto"){
					//echo "$column $type ";
					continue;
				}

				if($type=="CUS")continue;
				if($type=="REF")continue;
				if($column=="member_id"){

					if( $this->IsNew() && ($this->data[$column]==0 || $this->data[$column]=='') && !in_array( get_class($this) , array("MD_PaymentRecord") ) ){

						if(Conf()->UNITTEST){
							$this->member_id = Conf()->UNITCASE_GetCurrentMember->id;
						}else{
							$this->member_id = Inc_Authen::GetCurrentMember()->id;
						}

					}else if(!$this->IsNew() && !$this->WriteAble()){
						global $file;if($file!=null){
							fwrite($file, "No permission [{$this->data[$column]}]");
						}
						//Inc_Log::debuglog("No permission ".get_class($this)."[".$this->data['id']."]".$column."[".$this->data[$column]."]\n");
						//Inc_Log::debuglog(debug_backtrace());
						if(Conf()->DEBUG){
							echo "<pre>";
							debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
							echo "</pre>";
							Inc_Var::vardump($this);
							echo "<pre>";
							var_dump($this);
							echo "</pre>";
							
						}
						exit("No permission ".get_class($this)."[".$this->data['id']."]".$column."[".$this->data[$column]."]");

					}

				}
				if($column=="access"){
					if($this->IsNew() && $this->data[$column]==''){
						if(Inc_Authen::GetCurrentMember()!=null && Inc_Authen::GetCurrentMember()->Get('id')==1){
							$this->data[$column] = 'FREE';
						}else{
							$this->data[$column] = 'PRIVATE';
						}
					}
				}

				$updateValue = $this->data[$column];
				//date_default_timezone_get()
				if($type=='datetime' && $this->data['dbtimezone']!='' && $this->data['dbtimezone']!=date_default_timezone_get()){
					$dbtimezone = $this->data['dbtimezone'];
					
					$db_time = new DateTimeZone($dbtimezone);
					$lc_time = new DateTimeZone(date_default_timezone_get());
					
					$datetime = new DateTime($updateValue,$lc_time);
					$datetime->setTimezone($db_time);
					$updateValue = $datetime->format('Y-m-d H:i:s');
				}
				if($column=="dbtimezone" && $this->data['dbtimezone']==''){
					$this->data['dbtimezone'] = date_default_timezone_get();
					$updateValue = $this->data['dbtimezone'];
				}
				
				if(($this->IsNew() && $this->data[$column]!=NULL) || $this->IsModify($column)){
					$setQryData[$column]['v'] = Inc_SQL::CheckSafe($updateValue);
					$setQryData[$column]['t'] =  $type;

				}
			}
			foreach($setQryData as $column => $tmp){
				Qry()->Set("{$column}" , $setQryData[$column]['v'], $setQryData[$column]['t']);
			}
			Qry()->TableName = $table;
			Qry()->Update(" where id = ".$this->data['id']);
			
			if(!$global_disable_auto_id && $this->data['id']==-1 && $columnArrayFull['id']=="auto") {
				$this->data['id'] = Qry()->GetInsertedID();
				ModelObjectCaching::Push($this);
				if(Conf()->UNITTEST){
					UNITEST_quereSql("delete from $table where id = ".$this->data['id']);
				}
			}
			

			if(!$bypass){
				SaveDS()->Append($this->OnAfterUpdate0());
				SaveDS()->Append($this->OnAfterUpdate());
				SaveDS()->Append($this->OnAfterUpdate2());
			}
			
			
			if(Conf()->ENABLE_MODEL_LOG && !$this->disable_log){
				
				$logpath  = "../../log/model/".get_class($this)."/".$this->id.".log";			
				
				$logdata = array('a'=>Req(act),'t'=>Req(todo),'m'=>$_SESSION['session_userdentalid'],'ip'=>$_SERVER['REMOTE_ADDR']);
				foreach($setQryData as $column => $tmp){
					if($setQryData[$column]['t']=='longtext')continue;
					if($logdata[$column]==NULL)$logdata[$column] = array();
					$logdata[$column]["O"] = $this->olddata[$column];
					$logdata[$column]["N"] = $this->data[$column];
				}
				
				$debug = debug_backtrace();
				$src = basename($debug[0]['file'])."#".$debug[0]['line'];
				for($i=1;$i<count($debug);$i++){
					$src .= " ".basename($debug[$i]['file'])."#".$debug[$i]['line'];
				}
				
				$logdata['src'] = $src;
				
				if(count($logdata)>5){
					Inc_Log::pushDefaultLogFile($logpath);
					//JSON_UNESCAPED_UNICODE
					Inc_Log::log(json_encode($logdata,256)."\n");
					Inc_Log::popDefaultLogFile();
				}
			
			}			
			
			
			if(!$bypass){
				if($this->isNew){
					$this->isNew = false;
				}
				foreach($columnArrayFull as $column => $type){
					$this->olddata[$column] = 	$this->data[$column];
				}
			}
			
			
			
			
			Inc_SessionCache::UpdateModelObject($this);
			

		}else{
			//Inc_Log::debuglog(SaveDS());
			$this->PutLog(SaveDS()->GetErrorMsgWithComma());
		}
		return SaveDS();
	}

	public function PutLog($msg){
		
		$logpath  = "../../log/model/".get_class($this)."/".$this->id.".log";			
		
		$logdata = array('a'=>Req(act),'t'=>Req(todo),'m'=>$_SESSION['session_userdentalid'],'ip'=>$_SERVER['REMOTE_ADDR']);
		
		$logdata['msg'] = $msg;
		
		$debug = debug_backtrace();
		$src = basename($debug[0]['file'])."#".$debug[0]['line'];
		for($i=1;$i<count($debug);$i++){
			$src .= " ".basename($debug[$i]['file'])."#".$debug[$i]['line'];
		}
		
		$logdata['src'] = $src;
		
		if(count($logdata)>5){
			Inc_Log::pushDefaultLogFile($logpath);
			//JSON_UNESCAPED_UNICODE
			Inc_Log::log(json_encode($logdata,256)."\n");
			Inc_Log::popDefaultLogFile();
		}
	}
	
	public function /*@VOID*/OnBeforeDelete(){
	}
	public function /*@VOID*/OnAfterDelete(){
	}
	public function /*@bool*/OnDeleteMe(){
		return true;
	}
	function /*@bool*/DeleteMe() {
		if($this->isDelete)return false;
		$table = $this->GetPrimaryTable();
		$id = $this->data["id"];
		// #####################    Check exist record    #########################
		//echo "**".get_class($this)."***";
		if(ModelObjectCaching::Get(get_class($this),$id)==NULL){
			Qry()->Query("select * from $table where id=$id limit 1");
			if (Qry()->EOF) {
				return false;
			}
		}

		$this->OnBeforeDelete();

		$success = false;
		// #####################    Delete record    #########################
		if (!SaveDS()->ifError) {
			if($this->WriteAble()){
				Qry()->Execute("delete from $table where id=$id");
				ModelObjectCaching::Clear(get_class($this),$id);
				$success = $this->OnDeleteMe();
				$this->isDelete = $success;
			}else{
				if(Conf()->DEBUG || Conf()->UNITTEST){
					echo "<pre>";
					debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
					echo "</pre>";
				}
				echo("No permission ".get_class($this).$this->data['name']."<br>");
			}

		}
		if (!SaveDS()->ifError) {
			$this->OnAfterDelete();
		}
		
		
		if(Conf()->ENABLE_MODEL_LOG && !$this->disable_log){
			
			$logpath  = "../../log/model/".get_class($this)."/".$this->id.".log";			
			
			$logdata = array('a'=>Req(act),'t'=>Req(todo),'m'=>$_SESSION['session_userdentalid'],'ip'=>$_SERVER['REMOTE_ADDR'],'delete'=>"delete");
			
			$debug = debug_backtrace();
			$src = basename($debug[0]['file'])."#".$debug[0]['line'];
			$src .= basename($debug[1]['file'])."#".$debug[1]['line'];
			$logdata['src'] = $src;
			
			Inc_Log::pushDefaultLogFile($logpath);
			//JSON_UNESCAPED_UNICODE
			Inc_Log::log(json_encode($logdata,256)."\n");
			Inc_Log::popDefaultLogFile();
			
		
		}					
		
		
		return $success;
	}

	public static abstract function /*@SQL*/BuildSQLByID(/*@DBID*/$id);
	public static abstract function /*@ModelObject*/BuildByID(/*@DBID*/$id);
	public static function /*@RSData*/BuildDataBySQL(/*@SQL*/$sql) {
		if($sql=='')return NULL;

		//$table = $this->GetPrimaryTable();
		//echo "TB[$table]";
		Qry()->Query($sql);

		if (Qry()->EOF) {
			return null;
		}

		$rsset = Qry()->DumpArray("id");
		$rsdata = current($rsset);
		Qry()->Clear();
		//Inc_Var::vardump($rsdata);
		return $rsdata;
	}
	public static abstract function /*@ModelObject*/BuildByData(/*@RSData*/$rsdata);
	public static function /*@VOID*/BuildExtraByData(/*@ModelObject*/&$retObj,/*@RSData*/$rsdata){
	}
	protected static function /*@VOID*/_BuildByData(/*@ModelObject*/&$retObj,/*@RSData*/$rsdata) {
		//$retObj = self::BuildBlankObj();
		global $global_enable_low_memory;
		$retObj->isNew = false;
		$retObj->isModify = false;
	
		
		//Inc_Var::vardump($rsdata);
		
		//Inc_Var::vardump($retObj);
		foreach($retObj->GetColumnArrayFull() as $column => $type){
			//echo $type;
			$optionindex = strpos($type,'|');
			if($optionindex>0){
				$option = substr($type,$optionindex+1);
				$type = substr($type,0,$optionindex);
				$optionarray = explode(",",$option);
			}

			if($type=='id'){
				//echo "TYPE = ID TABLE[$option]";
				$table = $option;
			}

			if($type=="REF"){
				if($optionindex>0 && 	isset($rsdata["{$option}"])){

					$retObj->refdata[$column] =   $rsdata["{$option}"];
				}else if(isset($rsdata["{$column}"])){
					//echo "retObj->refdata[$column] =   rsdata[$column];";
					$retObj->refdata[$column] =   $rsdata["{$column}"];
				}else{
					$retObj->refdata[$column] = NULL;
				}
				//echo "retObj->refdata[$column] = rsdata[$column]";
			}else{
				if(isset($rsdata["{$column}"])){
					//echo "TABLE_COLUMN";
					if($type=='datetime' && $rsdata['dbtimezone']!='' && $rsdata[$column]!=date_default_timezone_get()){
						//date_default_timezone_get()
							$db_time = new DateTimeZone($rsdata['dbtimezone']);
							$lc_time = new DateTimeZone(date_default_timezone_get());
							
							$datetime = new DateTime($rsdata["{$column}"],$db_time);
							$datetime->setTimezone($lc_time);
							$retObj->data[$column] = $datetime->format('Y-m-d H:i:s');
						
					}else{
						$retObj->data[$column] =  $rsdata["{$column}"];
					}
					
				}else{
					//echo "COLUMN";
					//$retObj->data[$column] = $rsdata[$column];
					if(array_key_exists($column,$rsdata)){
						$retObj->data[$column] =  $rsdata[$column];
					}else{
						if($type!='CUS'){
							//echo "UNFETCH {$column}";
							//vardump($rsdata);
							$retObj->unfretch_col[$column] = true;
							$retObj->data[$column] = NULL;
						}else{

							//exit($type);
						}
					}
				}
				

				if($type=="bool")$retObj->data[$column] = $rsdata[$column]>0;
				if($type=="array" || $type=="set"){
					$ar = str_replace(array(',',';','|'),',',$rsdata[$column]);
					if(trim($ar)==''){
						$retObj->data[$column] = array();
					}else{
						$retObj->data[$column] = explode(',',trim($ar));
					}
					
				}
				//echo "retObj->refdata[$column] = rsdata[$column]";
			}
			$retObj->olddata[$column] =	$retObj->data[$column];
		}

		ModelObjectCaching::Push($retObj);

		

		if($global_enable_low_memory){
			unset($retObj->olddata);
			unset($retObj->refdata);
			foreach($retObj->GetColumnArrayFull() as $column => $type){
				if($type=='id') continue;
				if(strpos($column,"_id")>0)continue;
				unset($retObj->data[$column]);
			}
			unset($retObj->olddata);
		}

		//var_dump($retObj);

		return $retObj;
	}


	public function /*@VOID*/CloneData(/*@ModelObject*/$obj){
		foreach($obj->data as $key => $value){
			$this->data[$key] = $value;
		}
		foreach($obj->refdata as $key => $value){
			$this->refdata[$key] = $value;
		}

		$this->isNew = $obj->isNew;
		$this->isModify = $obj->isModify;
		$this->isDelete = $obj->isDelete;
		$this->classname = $obj->classname;
	}

	public static function ThreadLock($sysinstant_id,$limit=1,$threadname='',$option=NULL){
		$class = get_called_class();
		$table = $class::GetPrimaryTable();
		
		$where = " thread_status_{$threadname} = 'PENDING'  and primary_system = '".WHITELABEL_SYS_PRIMARYNAME."' ";
		$where .= $class::ThreadLockOption($threadname,$option);
		
		if(WHITELABEL_SYS_PRIMARYNAME==''){
			Inc_Log::log("WHITELABEL_SYS_PRIMARYNAME NULL!!!");
			exit("WHITELABEL_SYS_PRIMARYNAME NULL!!!");
		}
		
		$countsql = "select count(*) from {$table} where $where ";
		$countsql = str_replace("{LIMIT}","",$countsql);

		$countfree = Qry()->ExecuteScalar($countsql);
		//Inc_Log::log($countsql);
		if($countfree>0){
			$sql = "update {$table} set thread_instantid_{$threadname} = $sysinstant_id, thread_status_{$threadname} = 'QUEUE'  where $where ";
			if($limit>0){
				$sql = str_replace("{LIMIT}"," limit $limit ",$sql);
			}else{
				$sql = str_replace("{LIMIT}","",$sql);
			}
			Qry()->Execute($sql);
		}
		return $countfree;
	}
	

	
	public static function CountThreadLock($threadname='',$option=NULL){
		$class = get_called_class();
		$table = $class::GetPrimaryTable();
		$where = " thread_status_{$threadname} = 'PENDING'  and primary_system = '".WHITELABEL_SYS_PRIMARYNAME."' ";
		$where .= $class::ThreadLockOption($threadname,$option);
		$countsql = "select count(*) from {$table} where $where ";

		$countsql = str_replace('{LIMIT}','',$countsql);
		$countfree = Qry()->ExecuteScalar($countsql);
		return $countfree;
	}
	public function ThreadUnlock($threadname=''){
		$this->Set("thread_status_{$threadname}",'PENDING');
		$this->Update();
	}
	public static function ThreadLockOption($threadname='',$option=NULL){
		return "{LIMIT}";
	}

	public function Dump($tab=0){
		$tabstr = str_pad("", $tab,"\t");
		echo $tabstr."[".get_class($this)."]".$this->id."\n";
		foreach($this->data as $k => $v){
			if(is_a($v,ModelObject)){
				echo $tabstr."\t".$k." => \n";
				$v->Dump($tab+1);
			}else{
				if($this->olddata[$k]!=$v){
					$pre = "*";
					$bt = "[".$this->olddata[$k]."] ";
				}
				if(is_array($v)){
					$vexp = var_export($v,true);
					$vexp = preg_replace("/^/", "".$tabstr."\t\t", $vexp);
					$vexp = preg_replace("/\n/", "\n".$tabstr."\t\t", $vexp);
					echo $tabstr."\t".$pre.$k." => ".$bt."\n".$vexp."\n";
				}else{
					echo $tabstr."\t".$pre.$k." => ".$bt."".$v."\n";
				}
			}
		}
		$this->InternalDump($tab);
	}
	protected function InternalDump($tab=0){
	}

}

abstract class ModelObjectArray {

	protected function GetCompactColumnList(){
		return "*";
	}
	protected static function _GetCompactColumnList($full,$unfetch){
		foreach($full as $k => $v){
			if(preg_match("/^(REF|CUS)/",$v) || in_array($k,$unfetch)){
				unset($full[$k]);
			}
		}
		return $full;
	}


	protected /*@array*/$dataarray = array ();
	protected /*@array*/$dataarrayOrder = array ();
	public function /*@ModelObject*/GetByID(/*@DBID*/$id) {
		return $this->dataarray[$id];
	}
	public function /*@ModelObject*/GetByIndex(/*@int*/$index) {
		return $this->GetByID($this->dataarrayOrder[$index]);
	}
	public function /*@array*/GetArray() {
		return $this->dataarray;
	}

	public function /*@VOID*/Update() {
		foreach ($this->dataarray as $id => $object) {
			$object->Update();
		}
	}
	public function /*@VOID*/Add(/*@ModelObject*/$obj) {
		if($obj==null)return;
		if($this->dataarray[$obj->Get('id')]==null){
			$this->dataarray[$obj->Get('id')] = $obj;
			$this->dataarrayOrder[] = $obj->Get('id');
		}
	}
	public function /*@VOID*/Remove(/*@ModelObject*/$data) {
		unset($this->dataarray[$data->Get('id')]);
		$keys = array_search($data->Get('id'),$this->dataarrayOrder);
		unset($this->dataarrayOrder[$keys]);
		// TODO remove object from dataarrayOrder
	}
	public function /*@VOID*/Merge(/*@ModelObjectArray*/$arrayObj) {
		foreach ($arrayObj->GetArray() as $id => $object) {
			if($this->dataarray[$id]==null){
				$this->dataarray[$id] = $object;
			}
		}
	}
	public function /*@int*/Count() {
		return count($this->dataarray);
	}
	public function /*@VOID*/Filter(/*@array*/$rule){
		$newarray = array();
		foreach ($this->dataarray as $id => $object) {
			foreach($rule as $column => $keyword){
				$data = $object->Get($column);
				$match = strpos($data,$keyword);
				if($match!==false){
					$newarray[$id] = $object;
					break;
				}
			}
		}
		$this->dataarray = $newarray;


	}

	public function /*@VOID*/Sort(/*@ModelObject:column*/$column){
		$sortarray = array();
		foreach ($this->dataarray as $id => $object) {
			$sortarray[$object->Get($column).$id] = $id;
		}
		ksort($sortarray);
		$newarray = array();
		foreach ($sortarray as $id) {
			$obj = $this->dataarray[$id];
			$newarray[$obj->Get('id')] = $obj;
		}
		$this->dataarray = $newarray;
	}



	public abstract function /*@ModelObject*/BuildIteratureByData(/*@RSData*/$rsdata);
	public function /*@ModelObjectArray*/__construct(/*@SQL*/$sql='',$compact=NULL) {
		if($sql=='')return;


		if(preg_match("/COMPACT/",$sql)){
			$selector = "*";
			if(!Conf()->DISABLE_COMPACT_FETCH){
				if($compact==NULL){
					$compact = $this->GetCompactColumnList();
				}
				if(is_array($compact)){
					$selector = implode(",",array_keys($compact));
				}else{
					$selector = $compact;
				}
			}
			$sql = preg_replace("/COMPACT/",$selector,$sql);
		}

		//Inc_Var::vardump($sql);
		Qry()->Query($sql);
		if (Qry()->EOF) {
			return;
		}
		$rsset = Qry()->DumpArray("id");
		Qry()->Clear();
		//Inc_Var::vardump($rsset);

		foreach ($rsset as $id => $rsdata) {
			$iteraObj = $this->BuildIteratureByData($rsdata);
			if($iteraObj!=null){
				$this->dataarray[$id] = $iteraObj;
				$this->dataarrayOrder[count($this->dataarrayOrder)] = $id;
			}
		}
	}
	public function /*@VOID*/ExtactObjByID(/*@SQL*/$sql='') {

		if($sql=='')return;
		Qry()->Query($sql);
		if (Qry()->EOF) {
			return;
		}
		$rsset = Qry()->DumpArray("id");
		foreach ($rsset as $id => $rsdata) {
			$iteraObj = $this->BuildIteratureByID($id);
			if($iteraObj!=null){
				$this->dataarray[$id] = $iteraObj;
				$this->dataarrayOrder[count($this->dataarrayOrder)] = $this->dataarray[$id];
			}
		}
	}




	public static function /*@SQL*/BuildSelectSQL(/*@SQL*/$qsql,/*@PageControl*/$pagectrl,/*@ORDERBY*/$orderby='',/*@string*/$selector="COMPACT"){
		if($selector=='')$selector = "COMPACT";

		$sql = $qsql;
		$sql = str_replace("{SELECTOR}",$selector,$sql);

		if($pagectrl!=NULL){
			if(Conf()->DEBUG){
				if(!is_a($pagectrl, 'PageControl')){
					debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
					exit();
				}
			}
			$sql = str_replace("{LIMIT}"," {$orderby} limit ".$pagectrl->GetStartRecord().",".$pagectrl->GetPageSize()."",$sql);
		}else{
			$sql = str_replace("{LIMIT}"," {$orderby} ",$sql);
		}
		return $sql;
	}
	public static function /*@SQL*/BuildCountSQL(/*@SQL*/$qsql,/*@string*/$selector="*"){
		if($selector=='')$selector = "*";
		$csql = $qsql;
		$csql = str_replace("{SELECTOR}","count({$selector}) as coutnall",$csql);
		$csql = str_replace("{LIMIT}","",$csql);
		return $csql;
	}


	public static function BuildByThread($sysinstant_id,$threadname='') {
		$class = get_called_class();
		$subclass = str_replace("Array","",$class);
		$table = $subclass::GetPrimaryTable();
		$qsql = " select {SELECTOR} from  {$table} where thread_instantid_{$threadname} = $sysinstant_id and  thread_status_{$threadname} = 'QUEUE'  {LIMIT}	";

		//$orderby = " order by processdate ";
		$sql  = self::BuildSelectSQL($qsql,$pagectrl,$orderby);
		$csql = self::BuildCountSQL($qsql);
		if($pagectrl!=NULL){
			$pagectrl->recordcount = Qry()->ExecuteScalar($csql);
		}

		return new $class($sql);
	}

}
abstract class ModelObjectGraph {
	public /*@string*/$Name = "";
	public /*@array*/$data = array();
	public /*@array*/$cacheX = array();
	public /*@int*/$maxY = 0;
	public /*@int*/$minY = 0;
	public /*@graph*/$graph = NULL;
	public /*@array*/$labelAr = array();
	public /*@int*/$minX = 9999999999;
	public /*@int*/$maxX = 0;
	public /*@int*/$GraphScale = 100;
	public /*@bool*/$isFill0 = false;

	/*
		data["Legend1"][index][X]
	data["Legend1"][index][Y]
	data["Legend2"]

	*/
	/*function __construct(){
		for( $i=0; $i<12; $i++ )
	{
	$this->Y[] = rand(0,50);
	}

	$this->X =  array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec' );
	// $this->Y =  //array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec' );

	}*/
	public function /*@ModelObjectGraph*/__construct(/*@string*/$class='graph') {

		switch($class){
			case 'bar':
				$this->graph = new bar_outline( 50, '#9933CC', '#8010A0' );
				break;
			case 'graph':
			default:
				$this->graph = new graph();
		}

		// Spoon sales, March 2007
		$this->graph->title( $this->Name , '{font-size: 18px;}' );
		$this->graph->bg_colour = '#FFFFFF';
		$this->graph->x_axis_colour( '#CFE7AF', '#E9F3DA' );
		$this->graph->y_axis_colour( '#CFE7AF', '#E9F3DA' );


		if(Conf()->DEBUG){
			set_time_limit(60);	
		}

	}
	public function /*@VOID*/BuildData(/*@SQL*/$sql='',$legend_prefix='') {
		if($sql=='')return;
		Qry()->Query($sql);
		$legendAr = NULL;
		$rowAr = array();
		while(!Qry()->EOF){
			$rowAr[] = Qry()->CurrentRowArray();
			Qry()->MoveNext();
		}
		foreach($rowAr as $row){
			if($legendAr==NULL){
				$legendAr = array();
				//Inc_Var::vardump($row);
				foreach($row as $key => $val){
					$legend = str_replace(array("_X","_Y"),"",$key);
					if($legend!="" && $legend!="Default" && !in_array($legend,$legendAr)){
						$legendAr[] = $legend;
					}
				}
				//Inc_Var::vardump($legendAr);
			}

			foreach($legendAr as $legend){
				if($legend=='currency')continue;
				$x = $row[$legend."_X"];
				if($x=='')$x = $row["Default_X"];
				$x = preg_replace("/[:\- ]/", '', $x);
				
				$currency = $row["currency"];
				if($currency!=NULL && $currency != Inc_Authen::GetCurrentOwner()->default_currency){
					$parse = MD_Pairvar::G(Inc_Authen::GetCurrentOwner()->default_currency,'CURRENCY')/MD_Pairvar::G($currency,'CURRENCY');
					$value = $row[$legend."_Y"] * $parse;
					
				}else{
					$value = $row[$legend."_Y"];
				}
				$this->Push($legend_prefix.$legend,$x,$value);
				
				
				
			}

			//if(Conf()->DEBUGSQL){
			//	Inc_Var::vardump($row);
				//Inc_Var::vardump("$legend,$x,$value");
				//Inc_Var::vardump($this->data);
			//}
			
			
		}
	}

	public function /*@VOID*/Push(/*@string*/$legend,/*@int*/$x,/*@int*/$y){
		//echo "Push($legend,$x,$y)<br>";
		//Inc_Var::vardump($this->data);
		if($this->cacheX[$x]!==NULL){
			$index = $this->cacheX[$x];
		}else{
			$index = count($this->cacheX);
		}
		$this->data[$legend][$index]['X'] = $x;
		$this->data[$legend][$index]['Y'] += $y;
		$y = $this->data[$legend][$index]['Y'];
		
		$this->cacheX[$x] = $index;
		
		if($y!=NULL){
			$this->minY = min($this->minY,$y);
		}
		if($y!=NULL){
			$this->maxY = max($this->maxY,$y);
		}
		
		$this->minX = min($this->minX,$x);
		$this->maxX = max($this->maxX,$x);
		
		$this->GraphScale = pow(10,ceil(log10($this->maxY))-1);
		//Inc_Var::vardump($this->data);
		//Inc_Var::vardump($this->minY);
	}
	public function /*@VOID*/Add(/*@string*/$legend,/*@int*/$x,/*@int*/$y){
		//echo "Add($legend,$x,$y)<br>";
		if($this->cacheX[$x]===NULL){
			$this->Push($legend,$x,$y);
		}else{
			//
			$this->data[$legend][$this->cacheX[$x]]['Y'] += $y;
			if($y!=NULL){
				$this->maxY = max($this->maxY,$this->data[$legend][$this->cacheX[$x]]['Y']);
			}
			if($y!=NULL){
				$this->minY = min($this->minY,$this->data[$legend][$this->cacheX[$x]]['Y']);
			}
			//Inc_Var::vardump($this->data);

		}
	}
	public function /*@VOID*/SortX(){
		
		
		for($i=$this->minX;$i<$this->maxX;$i++){
			if($this->cacheX[$i]===NULL){
				$this->cacheX[$i] = -1;
			}
		}
		ksort( $this->cacheX,SORT_REGULAR);

		
	}
	public function /*@VOID*/Normallize(){
	}
	public function /*@VOID*/Dump(){
		$this->SortX();
		$this->Normallize();
		Inc_Var::vardump($this);
	}

	public function /*@VOID*/Export(){

		//header("Content-Type: text/plain");
		//header("Content-Transfer-Encoding: text");
		//Inc_Htmlutil::FlushOB();
			
		
		
		
		$this->SortX();

		/*if(count($this->Y)==0){
			$this->X[] = 0;
		$this->Y[] = 0;
		}*/

		// use the chart class to build the chart:

		//$this->graph->line_dot( 3, 6, '#8BC53F' ,"Revenue" ,"10");


		$colorarray = array("#FF0000",'#8BC53F','#8BC5CC',"#663399","#CC6600","#99e8af","#16ae22","#381f59","#fb8750","#3b2482","#9b307d",
"#e558b0",
"#9f8b05",
"#72c1ad",

"#65453a",
"#517257"		
		
		);
		$legendcount = 0;
		/*foreach($this->data as $legend => $row){
			$this->graph->line_dot( 3, 6, $colorarray[$legendcount++], $legend, 10 );
		foreach($row as $index => $row2){
		$label = $this->data[$legend][$index]['X'];
		if(!in_array($label,$labelAr)){
		$labelAr[] = $label;
		}
		$dataAr[$legend][] = $this->data[$legend][$index]['Y'];
		}
		}*/
		
		$countLegend = count($this->data);
		$i=0;
		foreach($this->data as $legend => $row){
			if($legend==__('Total')){
				//area_hollow $width, $dot_size, $colour, $alpha, $text='', $font_size='', $fill_colour=''
				$this->graph->area_hollow( 1, 0, 15,"#999999", urlencode($legend), 10);
			}elseif($legend==__('Net')|| $legend==__('Pending')){
				//area_hollow $width, $dot_size, $colour, $alpha, $text='', $font_size='', $fill_colour=''
				$this->graph->area_hollow( 1, 0, 15,"#669966", urlencode($legend), 10);
			}else{
				$this->graph->line_dot( 3, 6, $colorarray[$legendcount++], urlencode($legend), 10 );
			}
			$i++;
		}
		//Inc_Var::CheckMemory();
		//Inc_Var::vardump($this->cacheX);
		//exit();
		$dataAr = array();
		foreach($this->cacheX as $x => $index){
			$this->labelAr[] = $x;
			foreach($this->data as $legend => $row){
				//Inc_Var::CheckMemory();
				if($this->data[$legend][$index]['Y']===NULL){
					if($this->isFill0){
						$dataAr[$legend][] = '0';
					}else{
						$dataAr[$legend][] = 'null';
					}
				}else{
					if(round($this->data[$legend][$index]['Y'])==0){
						$dataAr[$legend][] = round($this->data[$legend][$index]['Y']*100)/100;
					}else{
						$dataAr[$legend][] = round($this->data[$legend][$index]['Y']);
					}
				}
			}
		}
		
		
		if($this->isFill0){
			foreach($dataAr as $legend => $d){
				for($i=0;$i<count($d);$i++){
					if($dataAr[$legend][$i]=='0'){
						$dataAr[$legend][$i]='null';
					}else{
						break;
					}
				}
				for($i=count($d)-1;$i>=0;$i--){
					if($dataAr[$legend][$i]=='0'){
						$dataAr[$legend][$i]='null';
					}else{
						break;
					}
				}
			}
		}

		//exit();
		$this->Normallize();


		/*foreach($this->cacheX as $x => $index){
			foreach($this->data as $legend => $row){
		$label = $this->data[$legend][$index]['X'];
		if($label=='')continue;
		if(!in_array($label,$labelAr)){
		$labelAr[] = $label;
		}
		break;
		}
		}*/
		//Inc_Var::vardump($this->cacheX);
		//Inc_Var::vardump($this->labelAr);
		//Inc_Var::vardump($dataAr);
		//exit();

		foreach($dataAr as $legend => $data){
			$this->graph->set_data( $data );
		}
		
		
		
		//Inc_Var::vardump();
		// we add the 3 line types and key labels
		/*$this->graph->line( 2, '0x9933CC', 'Page views', 10 );
		 $this->graph->line_dot( 3, 5, '0xCC3399', 'Downloads', 10);    // <-- 3px thick + dots
		$this->graph->line_hollow( 2, 4, '0x80a033', 'Bounces', 10 );*/

		$this->graph->set_x_labels($this->labelAr);// array( 'January','February','March','April','May','June','July','August','Spetember','October','November','December' ) );
		//$this->graph->set_x_label_style( 10, '0x000000', 0, 2 );


		//$this->graph->set_y_legend( 'Open Flash Chart', 12, '#736AFF' );


		//$this->graph->set_data( $this->Y );
		// label each point with its value
		//$this->graph->set_x_labels( $this->X );
		$this->GraphScale = max(1,$this->GraphScale);
		
		if($this->maxY>0){
			$maxY = round($this->maxY * 1.1);
			$cutMax = $maxY%$this->GraphScale;
			$maxY += $this->GraphScale-$cutMax;
			$this->graph->set_y_max($maxY);
		}else{
			$this->graph->set_y_max($this->maxY);
		}
		if($this->minY<0){
			$minY = round($this->minY * 1.1);
			$cutMin = abs($minY)%$this->GraphScale;
			$minY -= ($this->GraphScale-$cutMin);
			$this->graph->set_y_min($minY);
		}else{
			//$this->graph->set_y_min($this->minY);
		}
		
		
		//$maxY > 10000;
		// set the Y max
		
		// label every 20 (0,20,40,60)
		$range = $maxY - $minY;
		if($range <10){
			$this->graph->y_label_steps( $range );
		}elseif($range <20){
			if(($range)%2==0){
				$this->graph->y_label_steps($range /2 );
			}else{
				$this->graph->set_y_max($maxY1+1);
				$this->graph->y_label_steps($range+1 /2 );
			}
		}else{
			$short = substr($range,0,2)+0;
			if($short<12){
				$this->graph->y_label_steps($short);
			}elseif($short<50){
				$this->graph->y_label_steps( $short/5 );
			}else{
				$this->graph->y_label_steps( $short/10 );
			}
		}
		
		// display the data
		$data = $this->graph->render();
		//header('content-type: text; charset:  iso-8859-1');
		header('Cache-Control: cache, must-revalidate');
		header('Pragma: public');
		echo $data;

		//Inc_Io::CompressOutput($data);
		//Inc_Var::vardump($data);
	}
}

