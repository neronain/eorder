<?
abstract class Joay_ListPage extends Joay_Page{
	//public abstract function /*@VOID*/Run(/*array*/$params=NULL);
	//public abstract function /*@string*/GetFormID();
	public static $DEF = NULL;

	
	function __construct(){
		
	}

	
	
	static function CheckLimit($classname=NULL,$label=NULL,$arrayCount=-1){
		if($classname==NULL){
			
			return;	
		}
		
		$limit = Inc_Authen::privilegeLimit($classname);
		$quotaCount = Inc_Authen::GetCurrentOwner()->GetQuotaCount($classname);
		
		
			if($limit ==0 ){ 
				if($arrayCount==0){
					if($label!=NULL){
						?>
						<div class="div-restriction">
							You're using a
							<?=Inc_Authen::GetCurrentPackageText()?>
							account, you are not able to create more <?=$label?>.<br /> If you wish to upgrade your package click <a
								href="<?=Def(Joay_Action_member)->URL_upgrade()?>">upgrade</a>.<br />
						</div>
						<br />
						<?
					}
				}
				
				return false;
			}elseif($limit > 0 &&  $quotaCount >= $limit){ 
			
				if($label!=NULL){
					?>
					<div class="div-restriction">
						You're using a
						<?=Inc_Authen::GetCurrentPackageText()?>
						account, you can only create <strong><?=$limit?>
						</strong> <?=$label?>.<br /> If you wish to upgrade your package click <a
							href="<?=Def(Joay_Action_member)->URL_upgrade()?>">upgrade</a>.<br />
					</div>
					<br />
					<? /*
					<script>
					$(document).ready(function(){
						check_component_limit();
					});
					function check_component_limit(){
						var count = $("tr",$('#<?=$classname?>List')).length;
						if(count><?=$limit?>){
							//disable
							$("a",$('#<?=$classname?>List')).each(function(){
								if($(this).prop('href')!='#' && $(this).prop('target')!='_blank'){
									$(this).prop('rel',$(this).prop('href'));
									$(this).prop('href','#');
								}
							});
							
						}else{
							//enaable
						}
					}


					</script>
					*/ ?>
					
					<?
				}
				return false;
			}
			return true;
		
	}
	
}