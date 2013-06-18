<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<table width="580" border="0" align="center" cellpadding="2" cellspacing="1" class="TableBorder">
<tr>
          <td  class="HeaderW">Doctor</td>
          </tr>
        <tr>
          <td class="HeaderTable">Doctor name</td>


  </tr>
     
<? 
	$i=0;
	while(!$data_doctor->EOF){ 
		$doc_id = $data_doctor->Rs("doctorId");
?>
        <tr class="Normal" bgcolor="#FFFFFF">
			
          <td><table cellpadding="0" cellspacing="1"><tr>
          <?
				  	$query = "select eorderid from eorder where ord_doc_id = '$doc_id' Limit 0,1";
					$data_customer->Query($query);
					$enableDelete = "none";
					if($data_customer->Count()==0){
						$enableDelete = "inline";
					}
		  ?>
          <td id="TDDoctorDelete<?=$i?>" style="display:<?=$enableDelete?>" align="center" class="tdButtonOnOut"  onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" onclick="delCustomerDoctorList('<?=$doc_id?>')"><img src="../resource/images/icon/Mini_Pixel_Icons/Mini_Pixel_Icons/delete-comment-red.gif" width="14" height="14" />Delete</td>
           <td><input type="text" style="width:400px" name="doc_name<?=$i?>" id="doc_name<?=$i?>" value="<?= $data_doctor->Rs("doc_name"); ?>" onfocus="findObj('TDDoctorSave<?=$i?>').style.display='inline'" /></td>    
          
          
          <td id="TDDoctorSave<?=$i?>" style="display:none" width="50" align="center" class="tdButtonOnOut" onclick="editCustomerDoctorList('<?=$doc_id?>',getValue('doc_name<?=$i?>'))"  onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"><img src="../resource/images/icon/Mini_Pixel_Icons/Mini_Pixel_Icons/edit-comment-orange.gif" width="14" height="14" /> Save</td>
          </tr></table></td>
  </tr>
<? 
$i++;
$data_doctor->MoveNext();	} ?>		
		 <tr class="Normal" bgcolor="#FFFFFF">
         <td><table cellpadding="0" cellspacing="1"><tr>
          <td><input type="text" onfocus="findObj('TDDoctorAdd').style.display='inline'" style="width:400px" name="doc_name" value="" id="doc_nameadd" /></td>
          <td id="TDDoctorAdd" style="display:none" align="center" class="tdButtonOnOut"  onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" onclick="addCustomerDoctorList(getValue('doc_nameadd'))"><img src="../resource/images/icon/Mini_Pixel_Icons/Mini_Pixel_Icons/add-comment-green.gif" width="14" height="14" /> Add</td>
</tr></table></td>
  </tr>
      </table>
<input type="hidden" id="doctor_id" />