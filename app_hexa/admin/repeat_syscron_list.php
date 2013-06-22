<?
class Repeater_syscron_list extends Joay_Repeater{
	public static function GenerateRfPage($obj){ 
		if($_GET['rfpage']>0){
			return self::NormalizeData($obj);
		}
		return false;
	}
	public static function NormalizeData($obj){ 

		if(Inc_Var::right(get_class($obj),5)=='Array'){
			$arObj = array();
			foreach($obj->GetArray() as $tmpObj){
					
					$arObj[] = array('success' => true,'messages'=>'','warning'=>'','record'=>self::NormalizeData($tmpObj));
					
			}
			return array('isarray'=>1,'array'=>$arObj);
		}



		$repeatid = $obj->id;
		$obj__id = $obj->id;
		$obj__cronclass = $obj->cronclass;
		$obj__message = $obj->message;
		$obj__maximum_instant = $obj->maximum_instant;
		$obj__limit_instant = $obj->limit_instant;
		$obj__lastexedate = $obj->lastexedate;
		$obj__maxexecutetime = $obj->maxexecutetime;


		if($obj->enable){
		$mode_alt = "Enabled";
		$mode_switch = "Disable";
		$mode_img = "accept.png";
		}else{
		$mode_alt = "Disabled";
		$mode_switch = "Enable";
		$mode_img = "exclamation.png";
		}
		

		$lastexe_diff =  mktime() - Inc_Var::DateMySQLToPHP($obj->lastexedate);
		$lastexe_diff = floor($lastexe_diff/60);
		
		$extname = '';
		$act_exe = '';
		if($obj->croninterval==0){
		if($lastexe_diff>180){
		$lastexe_diff = '<span style="color:red">'.$lastexe_diff."<span>";
		}								
		
		}else{
		$next_diff =  Inc_Var::DateMySQLToPHP($obj->nextexedate)-mktime();
		$next_diff = floor($next_diff/60);
		if($next_diff<0){
		$next_diff = '<span style="color:red">'.$next_diff."<span>";
		}
		$extname = '(Next schedule '.$obj->nextexedate.' ['.$next_diff.' mins])';
		$act_exe = "[AC ".($obj->exemicrosec/1000)."]";
		}
		
		$obj_cronclass = htmlspecialchars($obj->cronclass);
		
		
		$classObj = new $obj_cronclass;
		
		$countPending = $classObj->CountQueue();
		$countPendingTxt = "";
		if($countPending>0){
		$countPendingTxt = "[Pending: $countPending]";
		}
		
		
		$enable_C2 = in_array('C2', $obj->allow_instant)?'control_play_blue':'control_stop';
		$enable_C3 = in_array('C3', $obj->allow_instant)?'control_play_blue':'control_stop';
		$enable_C4 = in_array('C4', $obj->allow_instant)?'control_play_blue':'control_stop';
		$enable_BD = in_array('BD', $obj->allow_instant)?'control_play_blue':'control_stop';
		$enable_MJ = in_array('MJ', $obj->allow_instant)?'control_play_blue':'control_stop';
		
		$enable_C1 = in_array('C1', $obj->allow_instant)?'control_play_blue':'control_stop';
		$enable_B1 = in_array('B1', $obj->allow_instant)?'control_play_blue':'control_stop';
		
		
		$enable_localhost = in_array('localhost', $obj->allow_instant)?'control_play_blue':'control_stop';
		$enable_debug = in_array('debug', $obj->allow_instant)?'control_play_blue':'control_stop';
		
		
		$maxexecutetime_min = floor($obj->maxexecutetime/60); 
		 
		$countInstant = MD_SysCron::CountInstant($obj->id);
		
		
		$inc_ID = $countInstant['IDLE']==NULL?'':$countInstant['IDLE'];
		$inc_QU = $countInstant['QUEUE']==NULL?'':$countInstant['QUEUE'];
		$inc_WK = $countInstant['WORKING']==NULL?'':$countInstant['WORKING'];
		$inc_PD = $countInstant['PENDING_STOP']==NULL?'':$countInstant['PENDING_STOP'];
		
		
		

		return array(
			'classname'=>'MD_SysCron',
			'isarray'=>0,
			'id'=>$repeatid,
			'obj__id' => $obj__id,
			'obj_cronclass' => $obj_cronclass,
			'mode_switch' => $mode_switch,
			'mode_img' => $mode_img,
			'mode_alt' => $mode_alt,
			'obj__cronclass' => $obj__cronclass,
			'countPendingTxt' => $countPendingTxt,
			'extname' => $extname,
			'obj__message' => $obj__message,
			'enable_C2' => $enable_C2,
			'enable_C3' => $enable_C3,
			'enable_C4' => $enable_C4,
			'enable_BD' => $enable_BD,
			'enable_MJ' => $enable_MJ,
			'enable_C1' => $enable_C1,
			'enable_B1' => $enable_B1,
			'enable_localhost' => $enable_localhost,
			'enable_debug' => $enable_debug,
			'inc_ID' => $inc_ID,
			'inc_QU' => $inc_QU,
			'inc_WK' => $inc_WK,
			'inc_PD' => $inc_PD,
			'obj__maximum_instant' => $obj__maximum_instant,
			'obj__limit_instant' => $obj__limit_instant,
			'obj__lastexedate' => $obj__lastexedate,
			'lastexe_diff' => $lastexe_diff,
			'obj__maxexecutetime' => $obj__maxexecutetime,
			'maxexecutetime_min' => $maxexecutetime_min,
			'act_exe' => $act_exe
			);

	}
	public static function GenerateScript(){ ?>
			<script>

			if(typeof(Repeater_Remove) == 'undefined'){
				Repeater_Remove = function(classname,id,refill){
					$('#'+classname+'' + id).remove();
					if(typeof(UpdateRecord_OnAfter)=='function'){
						UpdateRecord_OnAfter('delete',{classname:classname,id:id});
					}
					
					if(typeof(refill)!='undefined' && refill>0){
						var isfunction = false;
						eval('isfunction = typeof(PageCtrlRefill_'+classname+'List)== "function"');
						if(isfunction){
							eval('PageCtrlRefill_'+classname+'List(1)');
						}	
					}
					
				}
			}
			if(typeof(GenerateRepeatRecord) == 'undefined'){
				GenerateRepeatRecord = function(data){ 	
					if(typeof(data.record)=='undefined'){
						LoggerNofity('Message',data.messages);
						return;
					}
					if(data.record.isarray==1){
						for(var i in data.record.array){
							if(typeof(data.record.array[i])=='function')continue;
							var obj = data.record.array[i];
							obj.messages = data.messages;
							GenerateRepeatRecord(obj);
						}
						return;
					}
					var classname = data.record.classname;
					if(typeof(data.record.isdelete)!='undefined' && data.record.isdelete){
						Repeater_Remove(classname,data.record.id);
					}else{
						var isfunction = false;
						
						eval('isfunction = typeof(GenerateRepeatRecord'+classname+')== "function"');
						if(isfunction){
							eval('GenerateRepeatRecord'+classname+'(data)');
						}
					}	
				}
			}
			
			if(typeof(GenerateRepeatRecordMD_SysCron) == 'undefined'){
				GenerateRepeatRecordMD_SysCron = function(data){ 
					if(data.record.classname!='MD_SysCron')return;
					if($('#MD_SysCronList').length == 0) {
						if(typeof(data.noredirect)=='undefined'){
							if(typeof(data.redirect)=='undefined'){
								window.location = window.location+'';
							}else{
								window.location=data.redirect;
							}
						}
						return;
					}
					
	var text = '';
	var text_suffix_create='';
	text += ' ';
	text += ' ';
	text += ' <td class="padleft width-40">';
	text += ' <a href="#" onclick="RefreshRC('+(data.record.obj__id)+');return false;">';
	text += ' <img src="resources/images/fatcow/arrow_refresh.png" alt="<?=__("Refresh")?>" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' <td class="width-40">';
	text += ' <a href="#" onclick="UpdateEnableMode('+(data.record.obj__id)+',\''+(data.record.obj_cronclass)+'\',\''+(data.record.mode_switch)+'\');return false;">';
	text += ' <img src="resources/images/fatcow/'+(data.record.mode_img)+'" alt="<?=__("'+(data.record.mode_alt)+'")?>" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' <td class="align-left"><a class="big" href="#" onClick="<?=Def(Dialog_SysCron)->openFunctionName?>('+(data.record.obj__id)+'); return false;">'+(data.record.obj__cronclass)+'</a>';
	text += ' <br/>'+(data.record.countPendingTxt)+''+(data.record.extname)+'<span class="smalltext_gray">';
	text += ' '+(data.record.obj__message)+'						';
	text += ' </span>';
	text += ' </td>';
	text += ' ';
	text += ' ';
	text += ' ';
	text += ' ';
	text += ' <td>';
	text += ' <a href="#" onclick="ToggleEnable('+(data.record.obj__id)+',\'C2\');return false;">';
	text += ' <img src="resources/images/fatcow/'+(data.record.enable_C2)+'.png" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' <td>';
	text += ' <a href="#" onclick="ToggleEnable('+(data.record.obj__id)+',\'C3\');return false;">';
	text += ' <img src="resources/images/fatcow/'+(data.record.enable_C3)+'.png" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' <td>';
	text += ' <a href="#" onclick="ToggleEnable('+(data.record.obj__id)+',\'C4\');return false;">';
	text += ' <img src="resources/images/fatcow/'+(data.record.enable_C4)+'.png" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' <td>';
	text += ' <a href="#" onclick="ToggleEnable('+(data.record.obj__id)+',\'BD\');return false;">';
	text += ' <img src="resources/images/fatcow/'+(data.record.enable_BD)+'.png" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' <td>';
	text += ' <a href="#" onclick="ToggleEnable('+(data.record.obj__id)+',\'MJ\');return false;">';
	text += ' <img src="resources/images/fatcow/'+(data.record.enable_MJ)+'.png" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' ';
	text += ' <td>';
	text += ' <a href="#" onclick="ToggleEnable('+(data.record.obj__id)+',\'C1\');return false;">';
	text += ' <img src="resources/images/fatcow/'+(data.record.enable_C1)+'.png" width="32" height="32" border="0"  /></a>';
	text += ' <a href="#" onclick="ToggleEnable('+(data.record.obj__id)+',\'B1\');return false;">';
	text += ' <img src="resources/images/fatcow/'+(data.record.enable_B1)+'.png" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' ';
	text += ' <td>';
	text += ' <a href="#" onclick="ToggleEnable('+(data.record.obj__id)+',\'localhost\');return false;">';
	text += ' <img src="resources/images/fatcow/'+(data.record.enable_localhost)+'.png" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' <td>';
	text += ' <a href="#" onclick="ToggleEnable('+(data.record.obj__id)+',\'debug\');return false;">';
	text += ' <img src="resources/images/fatcow/'+(data.record.enable_debug)+'.png" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' ';
	text += ' <td class="big" style="color:gray">'+(data.record.inc_ID)+'</td>';
	text += ' <td class="big" style="color:red">'+(data.record.inc_QU)+'</td>';
	text += ' <td class="big" >'+(data.record.inc_WK)+'</td>';
	text += ' <td class="big" style="color:red">'+(data.record.inc_PD)+'</td>';
	text += ' ';
	text += ' ';
	text += ' ';
	text += ' ';
	text += ' <td>';
	text += ' ';
	text += ' <a href="#" onclick="UpdateMaxinstant('+(data.record.obj__id)+',-1);return false;" style="margin-top:0px;display:block;float:left">';
	text += ' <img src="resources/images/fatcow/resultset_previous.png" alt="<?=__("Inc")?>" width="32" height="32" border="0"  /></a>';
	text += ' <span class="big" style="margin-top:6px;display:block;width:34px;float:left">'+(data.record.obj__maximum_instant)+'</span>';
	text += ' ';
	text += ' <a href="#" onclick="UpdateMaxinstant('+(data.record.obj__id)+',1);return false;" style="margin-top:0px;display:block;float:right">';
	text += ' <img src="resources/images/fatcow/resultset_next.png" alt="<?=__("Inc")?>" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' ';
	text += ' ';
	text += ' <td>';
	text += ' ';
	text += ' <a href="#" onclick="UpdateLimitinstant('+(data.record.obj__id)+',-1);return false;" style="margin-top:0px;display:block;float:left">';
	text += ' <img src="resources/images/fatcow/resultset_previous.png" alt="<?=__("Inc")?>" width="32" height="32" border="0"  /></a>';
	text += ' <span class="big" style="margin-top:6px;display:block;width:34px;float:left">'+(data.record.obj__limit_instant)+'</span>';
	text += ' ';
	text += ' <a href="#" onclick="UpdateLimitinstant('+(data.record.obj__id)+',1);return false;" style="margin-top:0px;display:block;float:right">';
	text += ' <img src="resources/images/fatcow/resultset_next.png" alt="<?=__("Inc")?>" width="32" height="32" border="0"  /></a>';
	text += ' </td>	';
	text += ' ';
	text += ' ';
	text += ' ';
	text += ' <td>'+(data.record.obj__lastexedate)+'<br/><span class="smalltext_gray">(Diff '+(data.record.lastexe_diff)+' min)</span></td>';
	text += ' <td>'+(data.record.obj__maxexecutetime)+'<br/><span class="smalltext_gray">'+(data.record.maxexecutetime_min)+' min '+(data.record.act_exe)+'</span></td>';
	text += ' ';
	text += ' <td class="buttonh-short">';
	text += ' <div class="button-inline-short" onclick="<?=Def(Dialog_SysCron)->openFunctionName?>('+(data.record.obj__id)+');">';
	text += ' <img src="resources/images/fatcow/edit.png" /><?=__('Edit')?></div></td>';
	text += ' <td class="buttonh-short padright">';
	text += ' <div class="button-inline-short" onclick="<?=Def(Dialog_SysCron)->deleteFunctionName?>('+(data.record.obj__id)+',\''+(data.record.obj_cronclass)+'\'); return false;">';
	text += ' <img src="resources/images/fatcow/delete.png" /><?=__('Delete')?></div></td>';
						

				
				
					var method = '';
					if($('#MD_SysCron' + data.record.id).html() != null) {
						$('#MD_SysCron' + data.record.id).html(text);
						LoggerNofity('Update',data.messages);
						method = 'update';
					} else {
						$('#MD_SysCronList').append('<tr class="record-list" id="MD_SysCron' + data.record.id + '">' + text + '</tr>'+text_suffix_create);
						LoggerNofity('Create',data.messages);
						method = 'create';
						
						$('#hint_on_empty').hide();
						$('table.table-record-list').show();						
						
					}//*/	

					UpdateRecordList();	
					if(typeof(UpdateRecord_OnAfter)=='function'){
						UpdateRecord_OnAfter(method,data);
					}
					

					
				}
			}
</script>
			
			
			<? 
	}
}
