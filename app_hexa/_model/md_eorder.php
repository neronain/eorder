<?


class MD_EOrder extends ModelObject {
	static $COLUMNARRAY = array (
	
		"eorderid" => "auto",
		"ord_code" => "varchar",
		"ord_no" => "varchar",
		"ord_doc_id" => "int",
		"ord_agn_id" => "int",
		"ord_patientname" => "varchar",
		"ord_cus_id" => "int",
		"ord_date" => 'datetime',
		"ord_senddate" => 'datetime',
		"ord_arrivedate" => 'datetime',
		"ord_inputdate" => 'datetime',
		"ord_processdate" => 'datetime',
		"ord_sendbackdate" => 'datetime',
		"ord_gotdate" => 'datetime',
		"ord_paiddate" => 'datetime',
		"ord_archievedate" => 'datetime',
		"ord_acreleasedate" => 'datetime',
		"ord_releasedate" => 'datetime',
		"ord_deliverydate" => 'datetime',
		"ord_acdeliverydate" => 'datetime',
		"ord_docdate" => 'datetime',
		"ord_priority" => "enum|A,B,C,D,X",
		"ord_status" => "int",
		"ord_operateday" => 'int',
		"ord_detail" => "text",
		"ord_docnote" => "varchar",
		"ord_remark" => "varchar",
		"ord_typeofwork" => "text",
		"ord_totalcost" => "decimal",
		"ord_user_id" => "int",
		
		"ord_cache_cnt_id" => "int",
		"ord_cache_type" => "set|FIX,REMOVE,ORTHO",
			

	);
	
	static function UNIQUEARRAY(){return array (
		"ord_code" => array("ord_code")
	);}
	
	static function INDEXARRAY(){return array ("ord_doc_id","ord_cus_id","ord_date","ord_arrivedate","ord_releasedate","ord_cache_cnt_id","ord_cache_type");}	
	
//############### Class template ###########################################
	public static function GetPrimaryTable() {						
		return "eorder";											
	}																
	public static function GetColumnArrayFull() {					
		return self::$COLUMNARRAY;									
	}																
	public static function BuildByID($id) {							
		if(ModelObjectCaching::Get(MD_EOrder,$id)){				
			return ModelObjectCaching::Get(MD_EOrder,$id);}		
		$rsdata=parent::BuildDataBySQL(self::BuildSQLByID($id));	
		if($rsdata==null)return null;								
		return self::BuildByData($rsdata);							
	}																
	public static function BuildByData($rsdata) {		
		if(ModelObjectCaching::Get(MD_EOrder,$rsdata['id'])){
			return ModelObjectCaching::Get(MD_EOrder,$rsdata['id']);
		}
		$retObj = new MD_ARServer();									
		parent::_BuildByData($retObj,$rsdata);						
		self::BuildExtraByData($retObj,$rsdata);					
		return 	$retObj;											
	}																
//############### Class template ###########################################
		public static function ExecuteChangeMember(/*TODO:V+UU*/$oldid,/*TODO:V+UU*/$newid){
		}	
		public function Init(){	

		}																
		
		public static function BuildSQLByID($id){	
			if(!is_numeric($id) || $id==0)return "";		
			return "select * from eorder where id='$id' limit 1";
		}																

		public static function BuildByPhysicalID($id){	
			if(!is_numeric($id) || $id==0)return NULL;		
			$sql = "
					select * from eorder where physical_id='$id' limit 1
					";
				$rsdata=parent::BuildDataBySQL($sql);	
			if($rsdata==null)return null;								
			return self::BuildByData($rsdata);							
		}
		public static function KillFreezeServer($time_sec){	
			
			$sql = "select count(*) from eorder where status='WORKING' and  last_working < DATE_SUB('".Inc_Var::DatePHPToMysql(mktime())."',INTERVAL {$time_sec} SECOND);";
			$countfree = Qry()->ExecuteScalar($sql);
			if($countfree>0){
				$sql = "
					update eorder set  status='PENDING' where status='WORKING' and  last_working < DATE_SUB('".Inc_Var::DatePHPToMysql(mktime())."',INTERVAL {$time_sec} SECOND);
					";
			
				return Qry()->Execute($sql);
			}
			return null;
		}
		public static function ResetAll(){	
			$sql = "update eorder set  status='PENDING' where status='WORKING' ";
			return Qry()->Execute($sql);
		}
		


		public static function ReserveStart($uniqueid,$type="'CLIENT','CALLER'"){	
								
			$sql = "select count(*) from eorder where status='PENDING' and type in ($type) limit 1";
			$countfree = Qry()->ExecuteScalar($sql);
			if($countfree>0){
				$sql = "
					update eorder set uniqueid = '{$uniqueid}', status='START' where status='PENDING'  and type in ($type) limit 1
					";
				return Qry()->Execute($sql);
			}
			return NULL;
		}
		public static function GetReserveServer($uniqueid){	
				
			$sql = "
					select * from eorder where uniqueid = '$uniqueid' limit 1
					";
			$rsdata=parent::BuildDataBySQL($sql);	
			if($rsdata==null)return null;								
			return self::BuildByData($rsdata);	
		}		


		public static function BuildExtraByData(/*TODO:V+UU*/&$retObj,/*TODO:V+UU*/$rsdata){ 



		}


		
		public function OnBeforeUpdate(){
					
			
		}
		public function GetStatus(){
					
			$sql = "select status from eorder where id=".$this->id." limit 1";
			return Qry()->ExecuteScalar($sql);
		}		
		
}

class MD_EOrderArray extends ModelObjectArray {
//############### Class template #######################################	
	public function BuildIteratureByData($rsdata){				
		return MD_EOrder::BuildByData($rsdata);				
	}															
//############### Class template #######################################

	public static function GetSortQuery($sort=''){
		$asc = "";
		$desc = "DESC";
		if($sort[0]=="-"){
			$asc = "DESC";
			$desc = "";
			$sort = substr($sort,1);
		}
		//echo  $asc;
		$orderby = "";
		switch($sort){
			default: $orderby = " order by status = 'WORKING' $desc,status = 'PENDING' $desc"; break;
		}
		return $orderby;
	}

	public static function BuildAllRecord($pagectrl=null) { 
		
		//if($pagectrl==null)$pagectrl = new PageControl(1000);
		$qsql = " select {SELECTOR} from  eorder {LIMIT}
				";
		$orderby = self::GetSortQuery();
		$sql  = self::BuildSelectSQL($qsql,$pagectrl,$orderby);
		$csql = self::BuildCountSQL($qsql);	
		if($pagectrl!=NULL){	$pagectrl->recordcount = Qry()->ExecuteScalar($csql);	}
		
		return new MD_EOrderArray($sql);
	}


	public static function BuildByCustomerID($customerid,$pagectrl=null) { 
		
		//if($pagectrl==null)$pagectrl = new PageControl(1000);
		$qsql = " select {SELECTOR} from  eorder where ord_cus_id = {$customerid} {LIMIT}
				";
		$orderby = self::GetSortQuery();

		$sql  = self::BuildSelectSQL($qsql,$pagectrl,$orderby);
		$csql = self::BuildCountSQL($qsql);	
		if($pagectrl!=NULL){	$pagectrl->recordcount = Qry()->ExecuteScalar($csql);	}		
		
		return new MD_EOrderArray($sql);
	}		

	
	
}

