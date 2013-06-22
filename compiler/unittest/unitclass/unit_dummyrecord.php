<?
class Unit_DummyRecord{
	public static $emaillist_index = 0;
		
	private static $productlist = array(
			'PP_PRO_PACKAGE' => 2,
			'PP_PROL_PACKAGE' => 4
		);		
		
	
	public static function AutoInitCurrentMember(PHPUnit_Framework_TestCase $unitestInstance){
		if(Inc_Authen::GetCurrentMember()==NULL){
			$memberObj = self::CreateMember($unitestInstance,true);
			self::SetCurrentMember($memberObj);
			return $memberObj;
		}
		return Inc_Authen::GetCurrentMember();
	}
	
	public static function SetCurrentMember(MD_UserDental $memberObj){
		Conf()->UNITCASE_GetCurrentMember = $memberObj;
	}
	public static function CreateMember(PHPUnit_Framework_TestCase $unitestInstance,$creatememship=true,$email=NULL){
		$unitestInstance->assertFalse(SaveDS()->ifError,SaveDS()->GetErrorMsg(true));
		if($email==NULL){
			$email = 'unittest'.self::$emaillist_index.'@fake.com';
			self::$emaillist_index++;
		}
		
		$memberObj = new MD_UserDental();
		$memberObj->usr_email = $email;
		$memberObj->username = $email;
		$memberObj->Update();
		$unitestInstance->assertTrue($memberObj->id>0,$email." ".self::$emaillist_index." ".SaveDS()->GetErrorMsg(true));

	
		
		return MD_UserDental::BuildByID($memberObj->id);
	}
	public static function GetProduct(PHPUnit_Framework_TestCase $unitestInstance,$name=NULL){
		$productObj = MD_Product::BuildByID(self::$productlist[$name]);
		$unitestInstance->assertNotNull($productObj);
		return $productObj;
	}
}
