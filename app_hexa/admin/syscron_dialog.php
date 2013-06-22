<?
class Dialog_SysCron extends AB_FhqDialog {	
	function __construct(){
		parent::__construct();


		$this->width = 480;
		$this->height = 500;
		
		$this->createLabel = __('Create SysCron');
		$this->createText = __('Enter new syscron name here');
		
		$this->openTitle = __("Edit SysCron");
		$this->openFunctionParams = "id,cronclass";

		$this->deleteAct = Def(Joay_Action_syscron)->ACT();
		$this->deleteTodo = Def(Joay_Action_syscron)->CALL_delete();
		
		$this->buttonArray = array();
		$this->buttonArray[__('Save')] = "
							$('#".$this->formID."').submit(); ";
		$this->buttonArray[__('Cancel')] = "
							$(this).dialog('close'); ";
							
		$this->url = "(id==-1?'".Def(Joay_Action_syscron)->URL_edit(array('id'=>-1,'cronclass'=>"'+cronclass+'"))."':'".Def(Joay_Action_syscron)->URL_edit(array('id'=>"'+id+'"))."')";
		
		
	}
	
	
	public function GenerateAddBox(){ 
	
		$classlist = MD_SysCron::ListClass();
		?>
	<form method="post" id="<?=$this->formID?>add">
	
		<? //border-uldc border-r ?>
			<select class="input-select-head border-uldc border-r" id="<?=$this->formID?>_cronclass">
				<? foreach($classlist as $cclass){ ?>
					<option value="<?=$cclass?>" ><?=$cclass?></option>
				<? } ?>
			</select>		
		
		
		
		
		<button class="button-head-create" type="submit">
		<?=$this->createLabel?>
		</button>
	</form>
	<script type="text/javascript">
	        $(document).ready(function() {	
	            $('#<?=$this->formID?>add').ajaxForm({
	                dataType: 'json',
	                resetForm: true,
	                beforeSubmit: function() {
						<? if($this->force_non_empty_oncreate){?>
						if($("#<?=$this->formID?>_name").val().trim()==''){
							ShowDialog('error','<?=__('Please type in a new list name')?>');
							return false;
						}
						<? } ?>
						
	                    <?=$this->openFunctionName?>(-1,$("#<?=$this->formID?>_cronclass").val());
	                    return false;
	                },
	                success: function(data) {
	                    return false;
	                }
	            }); 
	        
	        });
	        </script>
	                    <?
		}
		
	
	
	public function GenerateForm(MD_SysCron $obj){ 
		$classlist = MD_SysCron::ListClass();
		
		?>
		<? /*## CSS DUMMY ###########################################################*/ if(0){?>
		<link rel="stylesheet" type="text/css" href="../../resources/css/<?=WHITELABELNAMELOW?>.css" />
		<link rel="stylesheet" type="text/css" href="../../resources/css/share/jquery-ui-1.8.7.custom.css" />
		<? /*## CSS DUMMY ###########################################################*/}?>
		<form action="<?=Def(Joay_Action_syscron)->URL_save(array(
				'id'=>$obj->id,
				"enable"=>"FORM_enable",
				"allow_instant"=>"FORM_allow_instant",
				"maximum_instant"=>"FORM_maximum_instant",
				"limit_instant"=>"FORM_limit_instant",
				"nextexedate"=>"FORM_nextexedate",
				"maxexecutetime"=>"FORM_maxexecutetime",
				"cronclass"=>"FORM_cronclass",
				"croninterval"=>"FORM_croninterval"
				))?>" 
				method="post" name="<?=$this->formID?>" id="<?=$this->formID?>">
			<table>
			
			<tr><td>enable: </td><td>
				<lable><input type="radio" name="enable" value="TRUE" <?=$obj->enable?' checked ':''?> />Enable</lable>
				<lable><input type="radio" name="enable" value="FALSE" <?=!$obj->enable?' checked ':''?> />Disable</lable>
			
			</td></tr>
			<tr><td>cronclass: </td><td>
			
			
			<select name="cronclass" class="input-select" id="cronclass">
				<? foreach($classlist as $cclass){ ?>
					<option value="<?=$cclass?>" <?=$obj->cronclass==$cclass?'selected="selected"':''?>><?=$cclass?></option>
				<? } ?>
			</select>
			
			</td></tr>
			
			<tr><td>croninterval: </td><td><input type="text" name="croninterval" value="<?=$obj->croninterval?>" style="width:60px" /> Sec <span class="smalltext_gray">(0 for infinity loop)</span></td></tr>
			
			<? if($obj->croninterval>0){ ?>
			<tr><td>Next EXE: </td><td><input type="text" name="nextexedate" value="<?=$obj->nextexedate?>" /><br/><span class="smalltext_gray"><?=Inc_Var::DatePHPToMysql(mktime())?></span></td></tr>
			<? } ?>
			<tr><td>allow_instant: </td><td>
					<lable><input type="checkbox" name="allow_instant[]" value="hexaceram" <?=in_array('hexaceram', $obj->allow_instant)?' checked ':''?> />hexaceram</lable><br/>
				</td></tr>
			<tr><td>maxexecutetime: </td><td><input type="text" name="maxexecutetime" value="<?=$obj->maxexecutetime?>" style="width:60px" /> Sec</td></tr>
			<tr><td>maximum_instant: </td><td><input type="text" name="maximum_instant" value="<?=$obj->maximum_instant?>" style="width:60px" /> </td></tr>
			<tr><td>limit_instant: </td><td><input type="text" name="limit_instant" value="<?=$obj->limit_instant?>" style="width:60px" /> </td></tr>
			
			</table>
		</form>

		<script type="text/javascript">
		$(document).ready(function() {	
			<? $this->GenerateDisable($obj); ?>
			<? $this->GenerateFormAjax() ?>
		});
		</script>
		<?
	}
}
			