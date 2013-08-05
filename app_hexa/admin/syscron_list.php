<?
class ListPage_SysCron extends Joay_ListPage {	
	public function Test(){
		$objArray = MD_SysCronArray::BuildAllRecord(PageCtrl());
		
		$this->GenerateHtml($objArray);		
	}
	public static function GenerateHtml(MD_SysCronArray $objArray){ ?>
		<? /*## CSS DUMMY ###########################################################*/ if(0){?>
		<link rel="stylesheet" type="text/css" href="../../resources/css/<?=WHITELABELNAMELOW?>.css" />
		<link rel="stylesheet" type="text/css" href="../../resources/css/share/jquery-ui-1.8.7.custom.css" />
		<? /*## CSS DUMMY ###########################################################*/}?>
		<? include '../../app_hexa/_share/html_header.php'; ?>

		<div class="div-main-auto">
			<div class="div-main-head">
				<div class="div-main-head-create">
					<? Def(Dialog_SysCron)->GenerateAddBox() ?>
				</div>
				<div class="div-clear"></div>
			</div>

			<? if(count($objArray->GetArray())>0){ 
				$obj_name = htmlspecialchars( str_replace("'", "\'", $obj->name), ENT_QUOTES);
				?>
				<table class="table-record-list" cellpadding="0" cellspacing="0">
					<tr>
						<th class="padleft width-40">&nbsp;</th>
						<th class="width-40">&nbsp;</th>
						<th class="align-left">Name</th>
						

						<th class="width-40">C2</th>
						<th class="width-40">C3</th>
						<th class="width-40">C4</th>
						<th class="width-40">C5</th>
						<th class="width-40">BD</th>
						<th class="width-40">MJ</th>
						<th class="width-40">R</th>
						<th class="width-40">L</th>						
						<th class="width-40">D</th>
						
						<th class="width-40">ID</th>
						<th class="width-40">QU</th>
						<th class="width-40">WK</th>
						<th class="width-40">PD</th>						
						
						
						<th class="width-100">Generate</td>
						<th class="width-100">Limit</td>
						<th class="width-200">Last exe</td>
						<th class="width-100">Exe time</td>
						<th class="buttonh-short">&nbsp;</th>
						<th class="buttonh-short">&nbsp;</th>				
					</tr>
					<tbody id="MD_SysCronList">
					<? foreach($objArray->GetArray() as $obj) { ?>
						<tr id="MD_SysCron<?=$obj->id?>" class="record-list">
						<!-- ROWREPEAT[MD_SysCron] -->
						<? /*PREREPEAT*/
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
							$enable_C5 = in_array('C5', $obj->allow_instant)?'control_play_blue':'control_stop';
							$enable_B5 = in_array('B5', $obj->allow_instant)?'control_play_blue':'control_stop';
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
							
							
						/*/PREREPEAT*/ ?>
						<td class="padleft width-40">
							<a href="#" onclick="RefreshRC(<?=$obj->id?>);return false;">
							<img src="resources/images/fatcow/arrow_refresh.png" alt="Refresh" width="32" height="32" border="0"  /></a>
						</td>						
						<td class="width-40">
							<a href="#" onclick="UpdateEnableMode(<?=$obj->id?>,'<?=$obj_cronclass?>','<?=$mode_switch?>');return false;">
							<img src="resources/images/fatcow/<?=$mode_img?>" alt="<?=$mode_alt?>" width="32" height="32" border="0"  /></a>
						</td>						
						<td class="align-left"><a class="big" href="#" onClick="<?=Def(Dialog_SysCron)->openFunctionName?>(<?=$obj->id?>); return false;"><?=$obj->cronclass?></a>
						<br/><?=$countPendingTxt?><?=$extname?><span class="smalltext_gray">
							<?=$obj->message ?>						
						</span>
						</td>
						
						

						
						<td>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'C2');return false;">
							<img src="resources/images/fatcow/<?=$enable_C2?>.png" width="32" height="32" border="0"  /></a>
						</td>						
												<td>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'C3');return false;">
							<img src="resources/images/fatcow/<?=$enable_C3?>.png" width="32" height="32" border="0"  /></a>
						</td>						
												<td>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'C4');return false;">
							<img src="resources/images/fatcow/<?=$enable_C4?>.png" width="32" height="32" border="0"  /></a>
						</td>						
												<td>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'C5');return false;">
							<img src="resources/images/fatcow/<?=$enable_C5?>.png" width="32" height="32" border="0"  /></a>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'B5');return false;">
							<img src="resources/images/fatcow/<?=$enable_B5?>.png" width="32" height="32" border="0"  /></a>
						</td>						
												<td>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'BD');return false;">
							<img src="resources/images/fatcow/<?=$enable_BD?>.png" width="32" height="32" border="0"  /></a>
						</td>						
						<td>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'MJ');return false;">
							<img src="resources/images/fatcow/<?=$enable_MJ?>.png" width="32" height="32" border="0"  /></a>
						</td>								
						
						<td>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'C1');return false;">
							<img src="resources/images/fatcow/<?=$enable_C1?>.png" width="32" height="32" border="0"  /></a>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'B1');return false;">
							<img src="resources/images/fatcow/<?=$enable_B1?>.png" width="32" height="32" border="0"  /></a>
						</td>						
				
						<td>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'localhost');return false;">
							<img src="resources/images/fatcow/<?=$enable_localhost?>.png" width="32" height="32" border="0"  /></a>
						</td>						
						<td>
							<a href="#" onclick="ToggleEnable(<?=$obj->id?>,'debug');return false;">
							<img src="resources/images/fatcow/<?=$enable_debug?>.png" width="32" height="32" border="0"  /></a>
						</td>						
						
						<td class="big" style="color:gray"><?=$inc_ID?></td>
						<td class="big" style="color:red"><?=$inc_QU?></td>
						<td class="big" ><?=$inc_WK?></td>
						<td class="big" style="color:red"><?=$inc_PD?></td>
						
						

						
						<td>
						
						<a href="#" onclick="UpdateMaxinstant(<?=$obj->id?>,-1);return false;" style="margin-top:0px;display:block;float:left">
							<img src="resources/images/fatcow/resultset_previous.png" alt="Inc" width="32" height="32" border="0"  /></a>
						<span class="big" style="margin-top:6px;display:block;width:34px;float:left"><?=$obj->maximum_instant?></span>
						
						<a href="#" onclick="UpdateMaxinstant(<?=$obj->id?>,1);return false;" style="margin-top:0px;display:block;float:right">
							<img src="resources/images/fatcow/resultset_next.png" alt="Inc" width="32" height="32" border="0"  /></a>
						</td>						


						<td>
						
						<a href="#" onclick="UpdateLimitinstant(<?=$obj->id?>,-1);return false;" style="margin-top:0px;display:block;float:left">
							<img src="resources/images/fatcow/resultset_previous.png" alt="Inc" width="32" height="32" border="0"  /></a>
						<span class="big" style="margin-top:6px;display:block;width:34px;float:left"><?=$obj->limit_instant?></span>
						
						<a href="#" onclick="UpdateLimitinstant(<?=$obj->id?>,1);return false;" style="margin-top:0px;display:block;float:right">
							<img src="resources/images/fatcow/resultset_next.png" alt="Inc" width="32" height="32" border="0"  /></a>
						</td>						


						
						<td><?=$obj->lastexedate?><br/><span class="smalltext_gray">(Diff <?=$lastexe_diff?> min)</span></td>
						<td><?=$obj->maxexecutetime?><br/><span class="smalltext_gray"><?=$maxexecutetime_min?> min <?=$act_exe?></span></td>
						
						<td class="buttonh-short">
							<div class="button-inline-short" onclick="<?=Def(Dialog_SysCron)->openFunctionName?>(<?=$obj->id?>);">
								<img src="resources/images/fatcow/edit.png" />Edit</div></td>
						<td class="buttonh-short padright">
							<div class="button-inline-short" onclick="<?=Def(Dialog_SysCron)->deleteFunctionName?>(<?=$obj->id?>,'<?=$obj_cronclass?>'); return false;">
								<img src="resources/images/fatcow/delete.png" />Delete</div></td>
						<!-- /ROWREPEAT -->
						</tr>
					<? }  ?>
					</tbody>
					<tr><td colspan="3"><?=PageCtrl()->BuildFullHTML()?></td></tr>
					</table>
			<?
}else{
?>
			
			<? } ?>
			<div class="gap"></div>
		</div>
<script>
function UpdateEnableMode(id,name,mode) {
	ReloadRepeatRecord('<?=Def(Joay_Action_syscron)->URL_toggle_enable(array('id'=>"'+id+'"))?>');
}
function UpdateMaxinstant(id,diff) {
	ReloadRepeatRecord('<?=Def(Joay_Action_syscron)->URL_alter_instant(array('id'=>"'+id+'","diff"=>"'+diff+'"))?>');
}
function UpdateLimitinstant(id,diff) {
	ReloadRepeatRecord('<?=Def(Joay_Action_syscron)->URL_alter_limitinstant(array('id'=>"'+id+'","diff"=>"'+diff+'"))?>');
}
function ToggleEnable(id,domain) {
	ReloadRepeatRecord('<?=Def(Joay_Action_syscron)->URL_toggle_domain(array('id'=>"'+id+'","domain"=>"'+domain+'"))?>');
}
function RefreshRC(id) {
	ReloadRepeatRecord('<?=Def(Joay_Action_syscron)->URL_refresh(array('id'=>"'+id+'"))?>');
}



</script>
		<? Def(Dialog_SysCron)->GenerateAllScript(); ?>
		<? Repeater_syscron_list::GenerateScript(); ?>
		<? include '../../app_hexa/_share/html_footer.php'; ?>
		<?
	}
}
			