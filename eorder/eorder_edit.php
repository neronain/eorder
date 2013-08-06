<? include "../cfrontend/header.php" ?>
<? include_once("../core/default.php"); ?>
<?php /* */ include_once "../eorder/eorder_alert.php" ?>
<? //$menu='order' ?>
<? //include "mainmenu.php"?>
<? /* */ include_once "../resource/divbackground.php" ?>
<form action="../eorder/eorder_edit_process.php" method="post" enctype="multipart/form-data" name="FormEorderEdit">
<? include_once("../eorder/eorder_edit_c.php"); ?>
<script src="../resource/javascript/default.js"></script>
<script src="../resource/javascript/ajax.js"></script>
<script src="../resource/javascript/smooth.pack.js"></script>
<script>
function refreshVisibleData(){
	obj = findObj("isdocdate");
	var isdocdate = obj!=null && obj.checked;
	obj = findObj("isdeliverydate");
	var isdeliverydate = obj!=null && obj.checked;
	obj = findObj("ordtypeF");
	var isFix = obj!=null && obj.checked;
	obj = findObj("ordtypeR");
	var isRemove = obj!=null && obj.checked;
	obj = findObj("ordtypeO");
	var isOrtho = obj!=null && obj.checked;
    obj = findObj("ordtypeS");
    var isSpecial = obj!=null && obj.checked;

	if(isdocdate){
		showHideLayers('divisdocdate','','show');
	}else{
		showHideLayers('divisdocdate','','hide');
	}
	if(isdeliverydate){
		showHideLayers('divisdeliverydate','','show');
	}else{
		showHideLayers('divisdeliverydate','','hide');
	}	

	obj = findObj("tblfixdata");
	//obj_opt = findObj("tblfixoption");
	if(obj){
	if(isFix){
		obj.style.display = 'inline';
	
		//clearInterval(Scroller.interval);
		//Scroller.interval=setInterval('Scroller.scroll(10000)',10);
		
		//Scroller.scroll(1000);
		//setTimeout("location='#FIX'", 1000);
		//obj_opt.style.display = 'inline';
	}else{
		obj.style.display = 'none';
		//obj_opt.style.display = 'none';
	}}

	obj = findObj("tblremovedata");
	if(obj){
	if(isRemove){
		obj.style.display = 'inline';
	}else{
		obj.style.display = 'none';
	}}

	obj = findObj("tblorthodata");
	if(obj){
	if(isOrtho){
		obj.style.display = 'inline';
	}else{
		obj.style.display = 'none';
	}}

    obj = findObj("tblspecialdata");
	if(obj){
	if(isSpecial){
		obj.style.display = 'inline';
	}else{
		obj.style.display = 'none';
	}}
	
}
</script>
<input type="hidden" name="act" id="act" value="<?=$action?>" />
<input type="hidden" name="eorder_custid" id="eorder_custid" value="<?=$customer_id?>" />
<input type="hidden" name="mode"  value="<?=$mode?>" />
<input type="hidden" name="issubmit" id="issubmit" value="0" /><br />
<a name="TOP"></a>
<table cellpadding="0" cellspacing="0" border="0"> 
  <tr><td width="20"></td><td width=930>

<? $tbframeheader = "E-Order Edit"?>
<? include "../cfrontend/tbframeh.php"?><br />
    <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" bordercolor="" class="Normal">
            <tr>
        <td width="150" height="25">Order Code</td>
        <td height="25">
		
		<?=$order_code?>
        
        </td>
        <td width="300" rowspan="12" align="center" valign="top">
        <div id="DivInvoiceResult" style="width:100%;display:none" >        </div></td>
            </tr>
	<tr>
        <td height="25">Customer name</td>
        <td height="25"><?=$customer_nickname." ".$customer_name?></td>
        </tr>
      <tr>
        <td height="25" valign="top" style="padding-top:7px">Agent/Code</td>
        <td height="25"><div id="DivComboAgent"><?  buildComboBoxList('eorder_agentid','agent order by agn_name','agentId',array('agn_name'),$agent_id,"") ?>&nbsp;<input type="button" id="add_agent" value="Add Agent" onclick="showHTML('DivComboAgent','../eorder/agent_add.php?cid=<?=$customer_id?>&aid='+getValue('eorder_agentid'));"></div></td>
        </tr>
      <tr>
        <td height="25" valign="top" style="padding-top:7px">Doctor name</td>
        <td height="25"><div id="DivComboDoctor"><?  buildComboBoxList('eorder_doctid','doctor where doc_cus_id='.$customer_id.' order by doc_name','doctorId',array('doc_name'),$doctor_id,"") ?>&nbsp;
        <input type="button" id="add_doctor" value="Add Doctor" 
        onclick="showHTML('DivComboDoctor','../eorder/doctor_add.php?cid=<?=$customer_id?>&did='+getValue('eorder_doctid'));">
        <input type="button" id="edit_doctor" value="Edit Doctor" 
        onclick="showHTML('DivComboDoctor','../eorder/doctor_edit.php?cid=<?=$customer_id?>&did='+getValue('eorder_doctid'));">
        
        
        </div></td>
        </tr>        
      <tr>
        <td height="25">Patient name</td>
        <td height="25"><input type="text" id="eorder_patname" name="eorder_patname" style="width:200px" value="<?=$patient_name?>" /></td>
        </tr>
      <tr>
        <td height="25">Doctor Appointment
          <input name="isdocdate" type="checkbox" id="isdocdate"  value="true" <?=$isdocdate?" checked":" "?> onclick="refreshVisibleData();" /></td>
        <td height="25"><div id="divisdocdate" <?='style="display:none"'?>>
            <? buildDateSelector('eorder_docdate',$eorder_docdate_day,$eorder_docdate_month,$eorder_docdate_year)?>
            <? buildTimeSelector('eorder_docdate',$eorder_docdate_hour,$eorder_docdate_minute)?>
        </div></td>
        </tr>
 		<tr><td height="25">
        Send by </td><td height="25">
         <select name="order_shipmethod">
          <option value="NONE" <?=$order_shipmethod=='NONE'?' selected="selected"':'' ?>>ไม่ระบุ</option>
          <option value="EMS" <?=$order_shipmethod=='EMS'?' selected="selected"':'' ?>>EMS</option>
          <option value="Green bus" <?=$order_shipmethod=='Green bus'?' selected="selected"':'' ?>>Green bus (เมล์เขียว)</option>
          <option value="Tour bus" <?=$order_shipmethod=='Tour bus'?' selected="selected"':'' ?>>Tour bus (รถทัวร์)</option>
          <option value="Van" <?=$order_shipmethod=='Van'?' selected="selected"':'' ?>>Van (รถตู้)</option>
          <option value="Siamfirst bus" <?=$order_shipmethod=='Siamfirst bus'?' selected="selected"':'' ?>>Siamfirst bus (สยามเฟิส)</option>
          <option value="Messenger" <?=$order_shipmethod=='Messenger'?' selected="selected"':'' ?>>Messenger (พนักงานส่งของ)</option>
          <option value="Plane" <?=$order_shipmethod=='"Plane"'?' selected="selected"':'' ?>>Plane (เครื่องบิน)</option>
          </select>
        </td></tr>            
        <tr><td> 
        
                
      <tr>
        <td height="25" >Attach image(.jpg)</td>
        <td height="25" >
  <?
			if(file_exists("../file/eorderattach/".$eorder_id.".jpg")) {
?>
          <a href="../file/eorderattach/<?=$eorder_id?>.jpg" target="_blank">View image</a>
  <?
			}
?>
        <input type="file" name="attachfile1" id="attachfile1" style="width:200px" /></td>        
      </tr>
      <tr>
        <td height="8" colspan="2"><hr /></td>
      </tr>
        <? if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){?> 
             <tr>
        <td height="25" colspan="2">
          <? include "../cfrontend/tbframe2h.php" ?>
          <table><tr><td colspan="2">
        <strong>Staff only</strong></td></tr>
            <tr>
              <td><label><span style="font-weight: bold">Code
                <input type="checkbox" onclick="findObj('eordercodeDiv').style.display=(this.checked?'inline':'none')" name="staffcodecheckbox" id="staffcodecheckbox" <?=substr($order_code,6,8)+0>0?"checked":""?> />
              </span></label></td>
              <td><div id="eordercodeDiv" style="display:<?=$order_no==""?"none":""?>">
              <input type="text" id="txteorder_code" name="txteorder_code" style="width:100px" maxlength="20" value="<?=$order_no?>" /> 
              <span style="color: #FF0000; font-weight: bold">*ใส่ได้ 20 ตัว</span></div></td>
            </tr>
            <!-- tr>
              <td><strong>Priority</strong></td>
              <td><strong>
    <input name="eorder_priority" type="radio" value="A" <?=$ordpriority=='A'?"checked":""?>>
    A&nbsp;&nbsp;&nbsp;&nbsp;
    <input name="eorder_priority" type="radio" value="B" <?=$ordpriority=='B'?"checked":""?>>
      B&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="eorder_priority" type="radio" value="C" <?=$ordpriority=='C'?"checked":""?>  >
      C&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="eorder_priority" type="radio" value="D" <?=$ordpriority=='D'?"checked":""?>>
      D&nbsp;&nbsp;&nbsp;&nbsp;
      <input name="eorder_priority" type="radio" value="X" <?=$ordpriority=='X'?"checked":""?>>
      X</strong></td>
            </tr -->
            <tr><td>
       <strong> Entry </strong></td><td>
       <? buildDateSelector('eorder_arrivedate',$eorder_arrivedate_day,$eorder_arrivedate_month,$eorder_arrivedate_year)?>
       <? buildTimeSelector('eorder_arrivedate',$eorder_arrivedate_hour,$eorder_arrivedate_minute)?>
</td></tr>
            <tr>
              <td><span style="font-weight: bold">วัน key ข้อมูล</span></td>
              <td>
              <input value="<?=$eorder_inputdate_day?>" style="width:40px" readonly="readonly" />
              <input value="<?=passThaiMonth($eorder_inputdate_month)?>" style="width:90px" readonly="readonly" />
              <input value="<?=$eorder_inputdate_year+543?>" style="width:50px" readonly="readonly" />
              <input value="<?=$eorder_inputdate_hour?>" style="width:40px" readonly="readonly" />
              <input value="<?=$eorder_inputdate_minute?>" style="width:40px" readonly="readonly" />

              
              
             </td>
            </tr>
            <tr><td>
       <strong> Release </strong> </td><td>
            <? buildDateSelector('eorder_releasedate',$eorder_releasedate_day,$eorder_releasedate_month,$eorder_releasedate_year)?>
            <? buildTimeSelector('eorder_releasedate',$eorder_releasedate_hour,$eorder_releasedate_minute)?>
        </td></tr>            
        <tr><td> 
       <strong> Delivery </strong> <input name="isdeliverydate" type="checkbox" id="isdeliverydate"  value="true" <?=$isdeliverydate?" checked":" "?> onclick="refreshVisibleData();" /></td><td>
       <div id="divisdeliverydate" <?='style="display:none"'?>>
            <? buildDateSelector('eorder_deliverydate',$eorder_deliverydate_day,$eorder_deliverydate_month,$eorder_deliverydate_year)?>
            <? buildTimeSelector('eorder_deliverydate',$eorder_deliverydate_hour,$eorder_deliverydate_minute)?></div>
        </td></tr>
        
       
        
        
        </table>
         <? include "../cfrontend/tbframe2f.php" ?>
        </td>
      </tr><? } ?>
      <tr>
        <td height="25" colspan="2"><span class="popHeader"><label><input name="order_fix" type="checkbox" id="ordtypeF"  value="true" <?=$order_fix?"checked":""?> onClick="refreshVisibleData();">
              <span style="font-weight: bold;font-size:20px" >
              Fix-order</span></label>
        </span></td>
      </tr>
      <tr>
        <td height="25" colspan="2"><span class="popHeader">
          <label><input name="order_remove" type="checkbox" id="ordtypeR"  value="true" <?=$order_remove?"checked":""?>  onclick="refreshVisibleData();" />
          <span style="font-weight: bold;font-size:20px" >
          Remove-order</span></label>
        </span></td>
      </tr>
      <tr>
        <td height="25" colspan="2"><span class="popHeader">
          <label><input name="order_ortho" type="checkbox" id="ordtypeO"  value="true" <?=$order_ortho?"checked":""?>  onclick="refreshVisibleData();" />
          <span style="font-weight: bold;font-size:20px">Ortho-order</span></label>
        </span></td>
      </tr>
      <tr>
        <td height="25" colspan="2"><span class="popHeader">
          <label><input name="order_special" type="checkbox" id="ordtypeS"  value="true" <?=$order_special?"checked":""?>  onclick="refreshVisibleData();" />
          <span style="font-weight: bold;font-size:20px">Special-order</span></label>
        </span></td>
      </tr>
      <tr>
        <td>&nbsp;</td><td><label></label></td>
      </tr>
    </table>
    <br /> 

    <div align="right">
    
<? if($usertype=='CM'){?>    
<table cellpadding="2" cellspacing="0"><tr><td>
<table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999" style="margin:5px">
  <tr>
    <td width="150" align="center" class="tdButtonOnOut"
onclick="if(ValidateForm()){setValue('issubmit',1);Loading();FormEorderEdit.submit();};" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"><img src="../resource/images/silkicons/disk.gif" />
&nbsp;<img src="../resource/images/silkicons/package_go.gif" width="16" height="16" /> Save &amp; Submit </td>
  </tr>
</table>
</td>
<td>
<table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999" style="margin:5px">
  <tr>
    <td width="100" align="center" class="tdButtonOnOut"
onclick="if(ValidateForm(getValue('eorder_doctid'))){Loading();FormEorderEdit.submit();};" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"><img src="../resource/images/silkicons/disk.gif" /> Save only</td>
  </tr>
</table>
</td><td>
<table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999" style="margin:5px">
  <tr><? $canceloption = $eorder_id!=''?"?eorderid=$eorder_id":'';?>
    <td width="70" align="center" class="tdButtonOnOut"

	onclick="Loading();location='../cfrontend/order.php<?=$canceloption?>'" 
    onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"><img src="../resource/images/silkicons/cancel.png" /> Cancel </td>
  </tr>
</table>

</td></tr></table>

<? }else if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){?>
<table cellpadding="2" cellspacing="0"><tr>
<td>
<table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999" style="margin:5px">
  <tr>
    <td width="100" align="center" class="tdButtonOnOut"
onclick="if(ValidateForm(getValue('eorder_doctid'))){Loading();FormEorderEdit.submit();};" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"><img src="../resource/images/silkicons/disk.gif" /> Save </td>
  </tr>
</table>
</td><td>
<table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999" style="margin:5px">
  <tr><? $canceloption = $eorder_id!=''?"?eorderid=$eorder_id":'';?>
    <td width="70" align="center" class="tdButtonOnOut"
    onclick="history.back(1);"
    onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"><img src="../resource/images/silkicons/cancel.png" /> Cancel </td>
  </tr>
</table>

</td></tr></table>

<? } ?>
</div>
<? include "../cfrontend/tbframef.php"?>
</td></tr></table>
<br />
<? include ("../eorder/eorder_edit_hidden.php");?>

<? /* */ include_once("../order/inc_shade.php"); ?>
<? /* */ include_once("../eorder/eorder_shade.php"); ?>


<div id="tblfixdata" style=" <?="display:none;"?>">
<? /* */ include("../eorder/eorder_fix.php"); ?>
</div>
<div id="tblremovedata" style=" <?="display:none;"?>">
<? /* */ include("../eorder/eorder_remove.php"); ?>
</div>
<div id="tblorthodata" style=" <?="display:none;"?>">
<? /* */ include("../eorder/eorder_ortho.php"); ?>
</div>
<div id="tblspecialdata" style=" <?="display:none;"?>">
<? /* */ include("../eorder/eorder_special.php"); ?>
</div>
</form>
<? /* */ include("../eorder/eorder_attach.php"); ?>
<? /* */ include("../eorder/eorder_bridge.php"); ?>
<? include "../cfrontend/footer.php" ?>


<? include_once ("../eorder/eorder_summary.php");?>


<script>

function ValidateForm(){

	//alert(docterName);
	if(getValue('eorder_doctid') == ""){
		showAlert("CDoctorName");
		return false;
	}
	if(getValue('eorder_patname') == ""){
		showAlert("CPatientName");
		return false;
	}
	
	
	return true;
}

refreshVisibleData();

function loadData(){
	setTdMethodValue('fix_method',getValue('fix_method'));
	setTdMethodValue('fix_alloy',getValue('fix_alloy'));
	setTdMethodValue('fix_embrasure',getValue('fix_embrasure'));
	setTdMethodValue('fix_pontic',getValue('fix_pontic'));
	setTdMethodValue('fix_box',getValue('fix_box'));

	SetShade('fix',0,getValue('fix_shade[0]'));
	SetShade('fix',1,getValue('fix_shade[1]'));
	SetShade('fix',2,getValue('fix_shade[2]'));
	SetShade('fix',3,getValue('fix_shade[3]'));

	var sname='';

//--------------- Fix -----------------
	for(var i=1;i<=4;i++){
		for(var j=1;j<=8;j++){
			index = i*10+j;
			value = findObj('fix_material['+index+']').value;
			<? /*
			switch(value){
		<? 		for($i=0;$i<count($fixmaterial_name);$i++){?>
					case '<?=$fixmaterial_idvalue[$i]?>':
						sname = '<?=$fixmaterial_shortname[$i]?>';
						img = '<?=$fixmaterial_image[$i]?>';
					break;
				<? }?> 
			}
			writeit('DivFixMaterialSname'+index,sname);
			findObj('ImgFixMaterial'+index).src = '<?=$fixmaterial_imagepath?>'+img;
			 */ ?>
			fix_material_setvalue(index,value,0);
			value = getValue('fix_opt_mat['+index+']');
			fix_material_setoptionvalue(index,value);
		}
	}

	SetupFixBridge();



//--------------------------------------
	//setTdMethodValue('remove_method',getValue('remove_method'));
	removetype_initvalue('upper',getValue('remove_mat[upper]'));
	removetype_initvalue('lower',getValue('remove_mat[lower]'));
	
	SetShade('remove',0,getValue('remove_shade[0]'));
	SetShade('remove',1,getValue('remove_shade[1]'));
	SetShade('remove',2,getValue('remove_shade[2]'));
	SetShade('remove',3,getValue('remove_shade[3]'));
//--------------- Remove ---------------
	for(var i=1;i<=4;i++){
		for(var j=1;j<=8;j++){
			index = i*10+j;
			value = findObj('remove_material['+index+']').value;
			<? /*
			switch(value){
		<? 		for($i=0;$i<count($removematerial_name);$i++){?>
					case '<?=$removematerial_idvalue[$i]?>':
						sname = '<?=$removematerial_shortname[$i]?>';
						img = '<?=$removematerial_image[$i]?>';
					break;
				<? }?> 
			}
			writeit('DivRemoveMaterialSname'+index,sname);
			findObj('ImgRemoveMaterial'+index).src = '<?=$removematerial_imagepath?>'+img; */ ?>
			remove_material_setvalue(index,value,0);
			value = getValue('remove_opt_mat['+index+']');
			remove_material_setoptionvalue(index,value);
		}
	}


//--------------------------------------

//--------------- attach ---------------
	for(var i=1;i<=4;i++){
		for(var j=1;j<=8;j++){
			index = i*10+j;
			if(getValue('fix_attachment['+index+']') == 0){
				findObj('ImgAttach'+index).src = '../resource/images/eorder/attach/unattach.gif';
			}else{
				findObj('ImgAttach'+index).src = '../resource/images/eorder/attach/attach.gif';
			}
		}
	//--------------------------------------
	}
	
	//  --------------- Ortho --------------
	setTdMethodValue('ortho_method',getValue('ortho_method'));

	//SetShade('ortho',0,getValue('ortho_shade[0]'));
	//SetShade('ortho',1,getValue('ortho_shade[1]'));
	//SetShade('ortho',2,getValue('ortho_shade[2]'));
	//SetShade('ortho',3,getValue('ortho_shade[3]'));
	
	
	//ReCalculateSummary('DivInvoiceResult');
	
	
}
loadData();
</script>

