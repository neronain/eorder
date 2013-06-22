<?
class MD_UserDental extends ModelObject {
	static /*@MD_UserDental:column*/$COLUMNARRAY = array (
		"userdentalid" => "auto",

		"usr_username" => "varchar",
		"usr_password" => "varchar",
		"usr_email" => "varchar",
		"usr_ugp_id" => "enum|AD,MN,ST,CM",
		"usr_fname" => "varchar",
		"usr_sname" => "varchar",
		"usr_lastlogin" => "datetime",
		"usr_status" => "auto",
		"sessionid" => "varchar",
		
	);

	static function UNIQUEARRAY(){return array (
		"usr_username"=> array("usr_username")

	);
	}
	static function INDEXARRAY(){return array ();}

	//############### Class template ###########################################
	public static function GetPrimaryTable() {
		return "userdental";
	}
	public static function GetColumnArrayFull() {
		return self::$COLUMNARRAY;
	}
	public static function BuildByID($id) {
		//=============== FOR UNIT TEST ======================//
		/*if(Conf()->UNITTEST){
		 if(Conf()->UNITCASE_MD_UserDental_BuildByID!=NULL){
		 $userdental = new MD_UserDental();
		 $userdental->id = Conf()->UNITCASE_MD_UserDental_BuildByID;
		 return $userdental;
		 }
			}	*/
		//======================= END ========================//
		if(ModelObjectCaching::Get(MD_UserDental,$id)){
			return ModelObjectCaching::Get(MD_UserDental,$id);
		}
		$rsdata=parent::BuildDataBySQL(self::BuildSQLByID($id));
		if($rsdata==null)return null;
		return self::BuildByData($rsdata);
	}
	public static function BuildByData($rsdata) {
		if(ModelObjectCaching::Get(MD_UserDental,$rsdata['id'])){
			return ModelObjectCaching::Get(MD_UserDental,$rsdata['id']);
		}
		$retObj = new MD_UserDental();
		parent::_BuildByData($retObj,$rsdata);
		self::BuildExtraByData($retObj,$rsdata);
		return 	$retObj;
	}
	
	//############### Class template ###########################################
	public static function ExecuteChangeMember(/*TODO:V+UU*/$oldid,/*TODO:V+UU*/$newid){

	}
	

	public function Init(){


	}
	public function /*@bool*/ReadAble(){
		return true;
	}
	public function /*@bool*/WriteAble(){
		$writeable = parent::WriteAble();
		if(!$writeable){
			return Inc_Authen::GetCurrentMember()->id==$this->id;
		}
		return $writeable;
	}	
	

	public static function BuildSQLByID($id){
		if(!is_numeric($id) || $id==0) return "";

		return "select * from userdental where id=$id limit 1";

	}

	public static function BuildExtraByData(&$retObj,/*TODO:V+UU*/$rsdata){
		
	}

	public static $_BuildByUsername;
	public static function BuildByUsername($username){
		if($username=='')return NULL;
		if(self::$_BuildByUsername[$username]!=NULL){
			return MD_UserDental::BuildByID(self::$_BuildByUsername[$username]);
		}
		$sql = "select * from userdental where usr_username = '$username' ";
		$rsdata=parent::BuildDataBySQL($sql);
		if($rsdata==null)return null;
		$retObj = self::BuildByData($rsdata);
		self::$_BuildByUsername[$username] = $retObj->id;
		return $retObj;
	}
	
	public function OnBeforeUpdate(){

		

	}
	public function OnAfterUpdate(){
		
		
	}

	
	
}

class MD_UserDentalArray extends ModelObjectArray {
	//############### Class template #######################################
	public function BuildIteratureByData($rsdata){
		return MD_UserDental::BuildByData($rsdata);
	}
	public function BuildIteratureByID($id){
		return MD_UserDental::BuildByID($id);
	}
	//############### Class template #######################################
	public static function GetSortQuery($sort){
		$asc = "";
		$desc = "DESC";
		if($sort[0]=="-"){
			$asc = "DESC";
			$desc = "";
			$sort = substr($sort,1);
		}
		$orderby = "";
		switch($sort){
			case 'username': 	$orderby = " ORDER BY usr_username $asc"; break;
			default:			$orderby = ""; break;
		}
		return $orderby;
	}

	
	public static function SearchByUsername($username='',$pagectrl=null) {
		$qsql = "
					select {SELECTOR} from userdental where usr_username like '%{$username}%' {LIMIT}
				";

		$sql  = self::BuildSelectSQL($qsql,$pagectrl);
		$csql = self::BuildCountSQL($qsql);
		if($pagectrl!=NULL){	$pagectrl->recordcount = Qry()->ExecuteScalar($csql);	}

		return new MD_UserDentalArray($sql);
	}

	public static function BuildAllRecord($pagectrl=null) {

		//if($pagectrl==null)$pagectrl = new PageControl(1000);
		$qsql = "
					select {SELECTOR} from userdental {LIMIT}
				";

		$sql  = self::BuildSelectSQL($qsql,$pagectrl);
		$csql = self::BuildCountSQL($qsql);
		if($pagectrl!=NULL){	$pagectrl->recordcount = Qry()->ExecuteScalar($csql);	}

		return new MD_UserDentalArray($sql);
	}
}

