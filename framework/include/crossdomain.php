<?

class Inc_CrossDomain{
	
	public static function GenerateDummy(){
		?><iframe id="crossdomain_script_iframe" width=0 height=0 style="display:none"></iframe><?
	}

	public static function Call($url,$params){
		if(0){?><script><?}
		$ex_param = Inc_Var::pairArr2Str($params,'=','&');
		?>$('#crossdomain_script_iframe').attr('src','<?=$url?>?<?=$ex_param?>');<?
	}
	
}