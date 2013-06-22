<?
abstract class Unit_IFrameWorkTesterCallback{
	public $param = array();
	protected $unitestInstance = NULL;
	function __construct($unit){
		$this->unitestInstance = $unit;
	}
	public abstract function DoCallback();
}
class Unit_FrameWorkTester{
	public static $outputContent = NULL;
	public static function TestReq($unitestInstance,$req){
		//================= Config Unittest Environment =============//
		Conf()->UNITTEST_CONTROLLER_SKIP_VIEW = true;
		ModelObjectCaching::ClearAll();
		
		
		//================= Setup submit data ======================//
		foreach($req as $irName => $ireq){
			Req()->Clear();
			foreach($ireq as $k => $v){
				Req()->__set($k,$v);
			}
			
			self::$outputContent = NULL;
			ModelObjectCaching::ClearAll();
			
			if($ireq['CALLBACK_ONSTART']){
				if(is_array($ireq['CALLBACK_ONSTART'])){
					foreach($ireq['CALLBACK_ONSTART'] as $callbackFunction){
						$callbackFunction($unitestInstance);
					}
				}else{
					$callbackFunction = $ireq['CALLBACK_ONSTART'];
					$callbackFunction($unitestInstance);
				}
			}
			

			Joay_Controller::Run();
			
			
			
			if($ireq['EXPECTED']){
				$unitestInstance->assertFalse(SaveDS()->ifError							,"Action return error\n".self::ReportError($irName,$ireq,SaveDS()));
			}else{
				$unitestInstance->assertTrue(SaveDS()->ifError							,"Action return no error\n".self::ReportError($irName,$ireq));
				$ireqErrAr = array();
				foreach($ireq['ERR'] as $ireqErr){
					$ireqErrAr[$ireqErr] = TRUE;
				}
				foreach(SaveDS()->error as $sdsErrID => $errorMsg){
					$unitestInstance->assertArrayHasKey($sdsErrID,$ireqErrAr			,self::ReportError($irName,$ireq,SaveDS()));
					$sdsErrAr[] = $sdsErrID;
				}
				foreach($ireq['ERR'] as $expectedErr){
					$unitestInstance->assertArrayHasKey($expectedErr, SaveDS()->error	,self::ReportError($irName,$ireq,SaveDS()));
				}
			}
			
			
			$ireqWarningAr = array();
			if($ireq['WARNING'])foreach($ireq['WARNING'] as $ireqErr){
				$ireqWarningAr[$ireqErr] = TRUE;
			}
			foreach(SaveDS()->warning as $sdsErrID => $errorMsg){
				$unitestInstance->assertArrayHasKey($sdsErrID,$ireqWarningAr			,self::ReportError($irName,$ireq,SaveDS()));
			}
			if($ireq['WARNING'])foreach($ireq['WARNING'] as $expectedErr){
				$unitestInstance->assertArrayHasKey($expectedErr, SaveDS()->warning		,self::ReportError($irName,$ireq,SaveDS()));
			}
			
			
			if($ireq['CALLBACK_ONEND']){
				if(is_array($ireq['CALLBACK_ONEND'])){
					foreach($ireq['CALLBACK_ONEND'] as $callbackFunction){
						$callbackFunction($unitestInstance);
					}
				}else{
					$callbackFunction = $ireq['CALLBACK_ONEND'];
					$callbackFunction($unitestInstance);
				}
				
			}
			SaveDS()->Clear();
			SaveDS()->warning = array();
			SaveDS()->option = array();
		}		
	}
	public static function ReportError($irName,$ireq,$saveds=NULL){
		unset($ireq["CALLBACK"]);
		$str = "";
		$str .= str_pad("",80,"#")."\n";
		$str .= "#".str_pad("",78," ")."#"."\n";
		$str .= "# Request: ".$irName.str_pad("",68-strlen($irName)," ")."#\n";
		$str .= "#".str_pad("",78," ")."#"."\n";
		$str .= str_pad("",80,"#")."\n";
		$str .= "----- Request parameter ".str_pad("",56,"-")."\n";
		$str .= var_export($ireq,TRUE)."\n";
		if($saveds!=NULL){
			$str .= "\n";
			$str .= "----- Result error ".str_pad("",61,"-")."\n";
			$str .= var_export(SaveDS()->error,true)."\n";
			$str .= str_pad("",80,"-")."\n";
			$str .= "----- Result warning ".str_pad("",61,"-")."\n";
			$str .= var_export(SaveDS()->warning,true)."\n";
			$str .= str_pad("",80,"-")."\n";
			
		}
		
		return $str;
	}
}
