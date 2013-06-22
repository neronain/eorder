<?

abstract class Joay_Dialog{
	//public abstract function /*@VOID*/Run(/*array*/$params=NULL);
	//public abstract function /*@string*/GetFormID();

	protected $dummyID = NULL;
	protected $formID = NULL;


	public $width = "$(window).width()-80";
	public $height = "$(window).height()-80";

	protected $force_non_empty_oncreate = false;
	protected $createLabel = "Create";

	public $openTitle = "";
	public $openFunctionName = "";
	public $openFunctionParams = "";
	public $openOnOpen = "";
	public $openOnClose = "";
	public $openOnLoad = "";

	protected $deleteText = "";
	public $deleteFunctionName = "";
	public $deleteFunctionParams = "";

	protected $archiveText = "";
	public $archiveFunctionName = "";
	public $archiveFunctionParams = "";
	
	
	protected $formBeforeSerialize = "";
	protected $onSuccess='';

	protected $deleteAct = "";
	protected $deleteTodo = "delete";
	
	protected $archiveAct = "";
	protected $archiveTodo = "archive";
	
	
	protected $buttonArray = NULL;
	protected $url = "''";

	protected $ext_dummy = NULL;
	protected $resizable = false;
	protected $dialogOption = '';
	
	protected $mode = "DIALOG";// DIALOG/FORM

	function __construct(){

		$this->dummyID = "dmy".get_class($this);
		$this->formID = "form".$this->dummyID;
		
		$this->openFunctionName = "Show".$this->dummyID."";
		$this->openFunctionParams = "id,name";
				
		$this->deleteText = "'".__("Important!! You are going to delete")." <strong>\"' + name + '\"</strong>. ".__("Once it is deleted, the information cannot be recovered. Click \"Yes\" if you confirm to delete.")."'";
		$this->deleteFunctionName = "Delete".$this->dummyID."";
		$this->deleteFunctionParams = "id,name";

		$this->archiveText = "'".__("Please confirm to archive")." <strong>\"' + name + '\"</strong>. ".__("Click \"Yes\" if you confirm to archive it.")."'";
		$this->archiveFunctionName = "Archive".$this->dummyID."";
		$this->archiveFunctionParams = "id,name,isarchive";
		
		
		
		$this->buttonArray = array(
			__("Close") => "\$(this).dialog('close');"
			);

	}
	






	protected function GetButtonsSyntex(){
		$synt = "";
		foreach($this->buttonArray as $key => $command){
			$synt .= "
					'$key': function() {
					$command
					},";
		}
		$synt = substr($synt,0,strlen($synt)-1);
		return $synt;
	}


	public function GenerateAddBox(){ ?>
<form method="post" id="<?=$this->formID?>add">
	<input type="text" class="input-text" id="<?=$this->formID?>_name" value="" placeholder="<?=$this->createText?>" />
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
					
                    <?=$this->openFunctionName?>(-1,$("#<?=$this->formID?>_name").val());
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


	public function GenerateScriptOpenDialog(){
		if(0){?>
<script><? } ?>

		if(typeof(<?=$this->openFunctionName?>) == 'undefined'){
			<?=$this->openFunctionName?> = function (<?=$this->openFunctionParams?>){
				var button_syntex = null;	
				if(typeof(id)!='undefined'){
					var tmp = id;
					id = Math.floor(tmp);
					option = tmp-id;
				}
				
				if(typeof(id)!='undefined' && id<-1){
					id*=-1;
					button_syntex = {'Close':function(){ $(this).dialog('close');}};
				}else{
					button_syntex = { <?=$this->GetButtonsSyntex()?> };
				}

				<?=$this->beforeDialogOption?>
				
				$("#<?=$this->dummyID?>").dialog({
					autoOpen: false,
					resizable: <?=$this->resizable?'true':'false'?>,
					<?=$this->dialogOption?>
					show: 'fade',
					hide: 'fade',
					width: <?=$this->width?>,
					height: <?=$this->height?>,
					modal: true,
					buttons: button_syntex,
					open: function(event, ui) {
						<?=$this->openOnOpen?>
					},
					close: function() {	
						<?=$this->openOnClose?>
						$(this).html('<?=$this->GetDummyText()?>').dialog('destroy');
						if(typeof(UpdateRecord_OnAfter)=='function'){
							UpdateRecord_OnAfter('close',{});
						}
					}
				}).load(<?=$this->url?>,function(){<?=$this->openOnLoad?>}).dialog('open');
				return false;
			}	
		}
		<? if(0){?></script>
		<? }
	}
	public function GenerateScriptDeleteDialog(){
		if(0){?><script><? } ?>
		if(typeof(<?=$this->deleteFunctionName?>) == 'undefined'){
			function <?=$this->deleteFunctionName?>(<?=$this->deleteFunctionParams?>) {
				ShowDialog('confirm', <?=$this->deleteText?>, function() {
					ShowSavingDialog('<?=__('Processing')?> ...');
					$.ajax({
						url: 'index.php',
						dataType: 'json',
						data: {
							'act': '<?=$this->deleteAct?>', 
							'todo': '<?=$this->deleteTodo?>', 
							'id': id 
						},
						success: function(data, textStatus, jqXHR) {
							CloseSavingDialog();
							if(data==null) {
								<? if(Conf()->DEBUG) { ?>
								ShowDialog('error','textStatus = ' + textStatus + '<br>' + data);
								<? } else { ?>
								ShowDialog('error','<?=__('An internal error has occurred due to a connection problem. Please Try again!')?>');
								<? } ?>
							} else if(data.success) {
								if(typeof(data.record.isarray)!='undefined' && data.record.isarray==1){
									for(var i in data.record.array){
										var obj = data.record.array[i];
										Repeater_Remove(obj.classname,obj.id);
									}
								}else{
									Repeater_Remove(data.record.classname,data.record.id);
								}
								LoggerNofity('Delete',data.messages);
								
								UpdateRecordList();
								<?=$this->onDelete?>
								return false;
							} else {
								ShowDialog('error',data.messages);
								return false;
							}
						}, error: function(jqXHR, textStatus, errorThrown) {
							CloseSavingDialog();
			                <? if(Conf()->DEVSERVER) { ?>
			    			if(textStatus == 'parsererror') {
			    				ShowDialog('fatalerror','Fatal Error:<br/>' + jqXHR.responseText);
			    			} else {
			    				ShowDialog('error','textStatus = ' + textStatus + '<br/>' + errorThrown);
			    			}
							 <? } else { ?>
							ShowDialog('error','<?=__('An internal error has occurred due to a connection problem. Please Try again!')?>');
							<? } ?>
							return false;
						}
					});
					return false;
				});
				return false;
			}
		}
		<? if(0){?></script><? }
	}

	public function GenerateScriptArchiveDialog(){
	 	if(0){?><script><? } ?>
		if(typeof(<?=$this->archiveFunctionName?>) == 'undefined'){
				function <?=$this->archiveFunctionName?>(<?=$this->archiveFunctionParams?>) {
					
						//ShowSavingDialog('Processing ...');
						$.ajax({
							url: 'index.php',
							dataType: 'json',
							data: {
								'act': '<?=$this->archiveAct?>', 
								'todo': '<?=$this->archiveTodo?>', 
								'id': id,
								'isarchive': isarchive
							},
							success: function(data, textStatus, jqXHR) {
								//CloseSavingDialog();
								if(data==null) {
									<? if(Conf()->DEBUG) { ?>
									ShowDialog('error','textStatus = ' + textStatus + '<br>' + data);
									<? } else { ?>
									ShowDialog('error','<?=__('An internal error has occurred due to a connection problem. Please Try again!')?>');
									<? } ?>
								} else if(data.success) {
									if(typeof(data.record.isarray)!='undefined' && data.record.isarray==1){
										var countrefill=data.record.array.length; 
										for(var i in data.record.array){
											if(typeof(data.record.isdelete)!='undefined' && data.record.isdelete){
												var obj = data.record.array[i];
												Repeater_Remove(obj.classname,obj.id,countrefill);
												countrefill = 0;
											}else{
												 GenerateRepeatRecord(data.record.array[i]);
											}
										}
										
									}else{
										if(typeof(data.record.isdelete)!='undefined' && data.record.isdelete){
											Repeater_Remove(data.record.classname,data.record.id,1);
										}else{
											GenerateRepeatRecord(data);
										}
									}
									//LoggerNofity('Archive',data.messages);
									
									UpdateRecordList();
									<?=$this->onArchive?>
									return false;
								} else {
									ShowDialog('error',data.messages);
									return false;
								}
							}, error: function(jqXHR, textStatus, errorThrown) {
								//CloseSavingDialog();
				                <? if(Conf()->DEVSERVER) { ?>
				    			if(textStatus == 'parsererror') {
				    				ShowDialog('fatalerror','Fatal Error:<br/>' + jqXHR.responseText);
				    			} else {
				    				ShowDialog('error','textStatus = ' + textStatus + '<br/>' + errorThrown);
				    			}
								 <? } else { ?>
								ShowDialog('error','<?=__('An internal error has occurred due to a connection problem. Please Try again!')?>');
								<? } ?>
								return false;
							}
						});
						return false;
					
				}
		}
		<? if(0){?></script><? }
	}
	
	public function GetDummyID(){
		return $this->dummyID;
	}
	
	private $_GetDummyText = false;
	public function GetDummyText(){
		if($this->_GetDummyText)return;
		$this->_GetDummyText = true;
		return '<table align="center" width="95%" height="100%" border="0"><tr><td align="center" valign="middle"><img src="resources/images/indicator.gif" />&nbsp;'.__('Now Loading').' ...</td></tr></table>';
	}

	public function GenerateAllScript(){
		//$classname = get_called_class();
		$this->GenerateOpenScript();
		$this->GenerateDeleteScript();
		$this->GenerateArchiveScript();
	}
	
	private $_GenerateOpenScript = false;
	public function GenerateOpenScript(){
		if($this->_GenerateOpenScript)return;
		$this->_GenerateOpenScript = true;		
		//$classname = get_called_class();

		?>
<?=$this->ext_dummy?>
<script type="text/javascript">
		if($('#<?=$this->dummyID?>').length==0){
			$('body').append('<div id="<?=$this->dummyID?>" title="<?=$this->openTitle?>" style="display: none;"><?=$this->GetDummyText()?></div>');
		}
		<? $this->GenerateScriptOpenDialog() ?>
		</script>
		<?
	}
	
	private $_GenerateDeleteScript = false;
	public function GenerateDeleteScript(){
		if($this->_GenerateDeleteScript)return;
		$this->_GenerateDeleteScript = true;	
		
		?>
<script type="text/javascript">
		<? $this->GenerateScriptDeleteDialog() ?>
		</script>
		<?
	}
	
	private $_GenerateArchiveScript = false;
	public function GenerateArchiveScript(){
		if($this->_GenerateArchiveScript)return;
		$this->_GenerateArchiveScript = true;
	
		?>
	<script type="text/javascript">
			<? $this->GenerateScriptArchiveDialog() ?>
			</script>
			<?
		}
	

	
	public function GenerateDisable($obj){
		if(!$obj->WriteAble() && !$obj->IsNew()){ ?>
			$('select',$('#<?=$this->formID?>')).each(function(){
				$(this).before($('option:selected',$(this)).text());
				$(this).hide();
			});
			$('input[type="text"]',$('#<?=$this->formID?>')).prop('disabled',true).addClass('dlgFrmDisTX');
			$('input[type="text"][value=""]',$('#<?=$this->formID?>')).val('-')

			$('textarea',$('#<?=$this->formID?>')).addClass('dlgFrmDisTX');
			


			$('button',$('#<?=$this->formID?>')).hide();
			$('input[type="file"]',$('#<?=$this->formID?>')).remove();
		<? }
		
			/*$('input[type="checkbox"]',$('#<?=$this->formID?>')).prop('disabled',true).addClass('dlgFrmDisCB');
			$('input[type="checkbox"]:checked',$('#<?=$this->formID?>')).prop('disabled',false).removeClass('dlgFrmDisCB');
			$('input[type="radio"]',$('#<?=$this->formID?>')).prop('disabled',true).addClass('dlgFrmDisCB');
			$('input[type="radio"]:checked',$('#<?=$this->formID?>')).prop('disabled',false).removeClass('dlgFrmDisCB');*/
		 
	}
	public function GenerateFormAjax($type='ajaxForm'){

		if(0){?>
<script><? } ?>
            $('#<?=$this->formID?>').<?=$type?>({
            dataType: 'json',
            beforeSubmit: function() {
            	<? $this->formBeforeSubmit ?>
                ShowSavingDialog();
            },
			<? if($this->formBeforeSerialize!=""){?>beforeSerialize :function(form,option){
				var valid = true;
				var messages = "";
				
				if(!valid){
					ShowDialog('error',messages);
					return false;
				}
				<?=$this->formBeforeSerialize?>
			},<? } ?>
            success: function(data, textStatus, jqXHR) {			
                CloseSavingDialog();
                if(data==null) {
                	<? if(Conf()->DEBUG) { ?>
				ShowDialog('error','[success] textStatus = ' + textStatus + '<br>' + data);
				<? } else { ?>
				ShowDialog('error','<?=__('An internal error has occurred due to a connection problem. Please Try again!')?>');
				<? } ?>
                } else if(data.success) {
					if(typeof(data.warning)!='undefined'	&& data.warning!=''){
						ShowDialog('info',data.warning);
					}
                    GenerateRepeatRecord(data);
                    <?=$this->onSuccess?>
                    $('#<?=$this->dummyID?>').dialog('close');
                    return false;
                } else {
                    ShowDialog('error',data.messages);
					if(data.option.error_field.length>0){
						for(var i in data.option.error_field){
							$('#'+data.option.error_field[i]).addClass('ui-state-error');
						}
					}
                    return false;
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                CloseSavingDialog();
                <? if(Conf()->DEVSERVER) { ?>
    			if(textStatus == 'parsererror') {
    				ShowDialog('fatalerror','Fatal Error:<br/>' + jqXHR.responseText);
    			} else {
    				ShowDialog('error','textStatus = ' + textStatus + '<br/>' + errorThrown);
    			}
				 <? } else { ?>
			 	ShowDialog('error','<?=__('An internal error has occurred due to a connection problem. Please Try again!')?>');
			 <? } ?>
                return false;
            }
        });


           $('span.nonproject-toggle').click(function(){
	        		var isshow = $(this).html()=='+';
	        		var rel = $(this).attr('rel');
	        		if(isshow){
	        			$('div.nonproject-area[rel="'+rel+'"]').show();
	        			$('ul.nonproject-area[rel="'+rel+'"]').show();
	        			$('tbody.nonproject-area[rel="'+rel+'"]').show();
	        			$(this).html('-');
	        		}else{
	        			$('div.nonproject-area[rel="'+rel+'"]').hide();
	        			$('ul.nonproject-area[rel="'+rel+'"]').hide();
	        			$('tbody.nonproject-area[rel="'+rel+'"]').hide();
	        			$(this).html('+');
	        		}
        		});
            
        <? if(0){?></script>
        <? }
	}
	public function GenerateSubmitAjax(){
		$this->GenerateFormAjax('ajaxSubmit');
	}
}



