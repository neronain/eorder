<!-- 
Default javascript
//Function javascript พื้นฐาน เอาไว้ใช้นะครับ 
function writeit(objID,text);
function makeCenterScreen(objID);
function showHideLayers();// Example: showHideLayers(Layer1,'','show',Layer2,'','hide');
function setBG(objID,color);
function findObj(objID);
function setFocus(objID);
function activeBG();
function hideBG();
function setValue(objID,val);
-->

<?php include "../eorder/eorder_remove_config.php" ?>
<?php /* */ include "../eorder/eorder_remove_type.php" ?>
<?php /* */ include "../eorder/eorder_tooltip.php" ?>
<?php /* */ //include "../eorder/eorder_alert.php" ?>
<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 18px}
-->
</style>
<div id="RemoveMaterialSelector" style="position:absolute; white-space:nowrap; left:0px; top:2000px; width:640px; height:400px; z-index:1; margin:0;overflow:hidden">
<? $tbframeheader = "Remove type of work select"?>
<? $tbframehclose = "remove_materialclose()";?>
<? include "../cfrontend/tbframeh.php"?><br />
<table cellpadding="0" cellspacing="0" border="0"><tr><td width="640" height="320" valign="top" align="center"\>
    <div id="RemoveMaterialSelector_RPD" style="width:640px;height:320px;overflow:hidden">
      <table width="95%" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
      <? for($i=0;$i<$RPDcount;$i+=3){ ?>
        <tr>
          <td align="left" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="remove_material_setvalue(remove_materialpopup_select,'<?=$removematerial_idvalue[$i]?>',1)">
        <img src="../resource/images/eorder/remove/<?=$removematerial_image[$i]?>" /> <?=$removematerial_name[$i]?></td>
        <? if(isset($removematerial_idvalue[$i+1])  && $i+1 < $RPDcount){ ?>
          <td align="left" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
       onclick="remove_material_setvalue(remove_materialpopup_select,'<?=$removematerial_idvalue[$i+1]?>',1)">
       <img src="../resource/images/eorder/remove/<?=$removematerial_image[$i+1]?>" /> <?= $removematerial_name[$i+1];?></td><? }else{ ?><td  bgcolor="#FFFFFF"></td><? } ?>
       	<? if(isset($removematerial_idvalue[$i+2])  && $i+2 < $RPDcount){ ?>
       	  <td align="left" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
       onclick="remove_material_setvalue(remove_materialpopup_select,'<?=$removematerial_idvalue[$i+2]?>',1)">
       <img src="../resource/images/eorder/remove/<?=$removematerial_image[$i+2]?>" /> <?=$removematerial_name[$i+2];?></td><? }else{ ?><td  bgcolor="#FFFFFF"></td><? } ?>
        </tr>
      <? } ?>
      </table>
      </div>
      
      <div id="RemoveMaterialSelector_TP" style="width:640px;height:320px;overflow:hidden">
      <table width="95%" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
      <? for($i=$TPstart;$i<$TPcount;$i+=3){ ?>
        <tr>
          <td align="left" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="remove_material_setvalue(remove_materialpopup_select,'<?=$removematerial_idvalue[$i]?>',1)">
        <img src="../resource/images/eorder/remove/<?=$removematerial_image[$i]?>" /> <?=$removematerial_name[$i]?></td>
        <? if(isset($removematerial_idvalue[$i+1])  && $i+1 < $TPcount){ ?>
          <td align="left" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
       onclick="remove_material_setvalue(remove_materialpopup_select,'<?=$removematerial_idvalue[$i+1]?>',1)">
       <img src="../resource/images/eorder/remove/<?=$removematerial_image[$i+1]?>" /> <?= $removematerial_name[$i+1];?></td><? }else{ ?><td  bgcolor="#FFFFFF"></td><? } ?>
       	<? if(isset($removematerial_idvalue[$i+2])  && $i+2 < $TPcount){ ?>
       	  <td align="left" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
       onclick="remove_material_setvalue(remove_materialpopup_select,'<?=$removematerial_idvalue[$i+2]?>',1)">
       <img src="../resource/images/eorder/remove/<?=$removematerial_image[$i+2]?>" /> <?=$removematerial_name[$i+2];?></td><? }else{ ?><td  bgcolor="#FFFFFF"></td><? } ?>
        </tr>
      <? } ?>
      </table>
      </div>
      
      <div id="RemoveMaterialSelector_HEXA" style="width:640px;height:320px;overflow:hidden">
      <table width="95%" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
      <? for($i=$HEXAstart;$i<$HEXAcount;$i+=3){ ?>
        <tr>
          <td align="left" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="remove_material_setvalue(remove_materialpopup_select,'<?=$removematerial_idvalue[$i]?>',1)">
        <img src="../resource/images/eorder/remove/<?=$removematerial_image[$i]?>" /> <?=$removematerial_name[$i]?></td>
        <? if(isset($removematerial_idvalue[$i+1])  && $i+1 < $HEXAcount){ ?>
          <td align="left" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
       onclick="remove_material_setvalue(remove_materialpopup_select,'<?=$removematerial_idvalue[$i+1]?>',1)">
       <img src="../resource/images/eorder/remove/<?=$removematerial_image[$i+1]?>" /> <?= $removematerial_name[$i+1];?></td><? }else{ ?><td  bgcolor="#FFFFFF"></td><? } ?>
       	<? if(isset($removematerial_idvalue[$i+2])  && $i+2 < $HEXAcount){ ?>
       	  <td align="left" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
       onclick="remove_material_setvalue(remove_materialpopup_select,'<?=$removematerial_idvalue[$i+2]?>',1)">
       <img src="../resource/images/eorder/remove/<?=$removematerial_image[$i+2]?>" /> <?=$removematerial_name[$i+2];?></td><? }else{ ?><td  bgcolor="#FFFFFF"></td><? } ?>
        </tr>
      <? } ?>
      </table>
      </div>     
      </td></tr></table> 
<? include "../cfrontend/tbframef.php"?>
</div>


<? // ------------------------------------------------------------------------------- ?>
<div id="DivRemoveOptionMaterial" style="position:absolute; white-space:nowrap; left:0px; top:1600px; width:260px; height:150px; z-index:1; margin:0;" align="left">
<? include "../cfrontend/tbframe2h.php"?>
  <span style="font-weight: bold">Option</span><br><div id="DivRemoveOptionMaterial_Question"> </div><br>	

<div id="DivRemoveOptionMaterial_TR0"> 
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240" height="30" align="center" class="tdButtonOnOut" onclick="remove_material_setoptionvalue(remove_materialpopup_select,0);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivRemoveOptionMaterial_Opt0"></Div></td>
    </tr>  
  </table>
</div>    

<div id="DivRemoveOptionMaterial_TR1">    
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240"  height="30" align="center" class="tdButtonOnOut" onclick="remove_material_setoptionvalue(remove_materialpopup_select,1);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivRemoveOptionMaterial_Opt1"></Div></td>
    </tr>
  </table>
</div>    

<div id="DivRemoveOptionMaterial_TR2">
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240" height="30" align="center" class="tdButtonOnOut" onclick="remove_material_setoptionvalue(remove_materialpopup_select,2);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivRemoveOptionMaterial_Opt2"></Div></td></tr>
  </table>
</div>
<? include "../cfrontend/tbframe2f.php"?>
</div>
<script>
function RemoveOptionMaterial_Popup(){
	activeBG();
	var question;
	switch(remove_materialpopup_material){
	<? for($i=0;$i<count($removematerial_name);$i++){?>
		case '<?=$removematerial_idvalue[$i]?>':
			question = '<?=$removematerial_option_question[$i]?>'
			option0 = '<?=$removematerial_option_fname[$i][0]?>';
			option1 = '<?=$removematerial_option_fname[$i][1]?>';
			option2 = '<?=$removematerial_option_fname[$i][2]?>';
			break;
	<? }?> 
	}
	writeit('DivRemoveOptionMaterial_Question',question);

	if(option2.length==0){
		findObj('DivRemoveOptionMaterial_TR2').style.display='none';
	}else{
		findObj('DivRemoveOptionMaterial_TR2').style.display='inline';
	}
	writeit('DivRemoveOptionMaterial_Opt0',option0);
	writeit('DivRemoveOptionMaterial_Opt1',option1);
	writeit('DivRemoveOptionMaterial_Opt2',option2);
	

	makeCenterScreen('DivRemoveOptionMaterial');
	showHideLayers('DivRemoveOptionMaterial','','show');
}
function remove_material_setoptionvalue(number,value)
{	
	var optsname = new Array();
	switch(remove_materialpopup_material){
		case '<?=$removematerial_idvalue[0]?>':
			sname = '<?=$removematerial_shortname[0]?>';
			optsname[0] = '<?=$removematerial_option_sname[0][0]?>';
			optsname[1] = '<?=$removematerial_option_sname[0][1]?>';
			optsname[2] = '<?=$removematerial_option_sname[0][2]?>';
			break;
	<? for($i=1;$i<count($removematerial_name);$i++){?>
		<? if($removematerial_idvalue[$i]==0)continue; ?>	
		case '<?=$removematerial_idvalue[$i]?>':
			sname = '<?=$removematerial_shortname[$i]?>';
			optsname[0] = '<?=$removematerial_option_sname[$i][0]?>';
			optsname[1] = '<?=$removematerial_option_sname[$i][1]?>';
			optsname[2] = '<?=$removematerial_option_sname[$i][2]?>';
			break;
	<? }?> 
	}
	//oldName = findObj('DivRemoveMaterialSname'+number).id;
	//alert(oldName);
	setValue('remove_opt_mat['+number+']',value);
	writeit('DivRemoveMaterialSname'+number,sname+optsname[value]);
	hideBG();
	showHideLayers('DivRemoveOptionMaterial','','hide');
}
</script>
<? // ------------------------------------------------------------------------------- ?>

<a name="RemoveAnchor" id="RemoveAnchor"></a>
<table cellpadding="0" cellspacing="0">
  <tr><td width="20"></td><td width="930">
<? $tbframeheader = "Remove order detail"?>
<? $tbframehscript='<a href="#TOP">Goto top</a>' ?>
<? include "../cfrontend/tbframeh.php"?>
<br />
<table width="100%" border="0" cellpadding="2" cellspacing="1">
<tr>
  <td>
  <? include "../cfrontend/tbframe2h.php" ?>
            <span style="font-weight: bold"><span class="style1">Detail</span><br />
            </span> <br />
            <table border="0" cellpadding="3" cellspacing="1">
            <? /*
              <tr>
                <td width="150" align="center" >Method</td>
                <td align="center" ><table border="0" cellpadding="0" cellspacing="5" width="100%">
                  <tr>
                    <td width="60" height="25" align="center" id = "tdRemoveTry-in"
                    onclick="setTdMethodValue('remove_method','Try-in');"
                    onMouseOver="checkOnOver('tdRemoveTry-in','remove_method','Try-in')"
                    onMouseOut="checkOnOut('tdRemoveTry-in','remove_method','Try-in')">
                      Try-in</td>
                    <td width="60" height="25" align="center"  id = "tdRemoveContour"
                    onclick="setTdMethodValue('remove_method','Contour');"
                    onMouseOver="checkOnOver('tdRemoveContour','remove_method','Contour')"
                    onMouseOut="checkOnOut('tdRemoveContour','remove_method','Contour')">
                      Contour</td>
                    <td width="60" height="25" align="center"  id = "tdRemoveFinish"
                    onclick="setTdMethodValue('remove_method','Finish');"
                    onMouseOver="checkOnOver('tdRemoveFinish','remove_method','Finish')"
                    onMouseOut="checkOnOut('tdRemoveFinish','remove_method','Finish')">
                      Finish</td>
                    <td width="60" height="25" align="center"  id = "tdRemoveRepair"
                    onclick="setTdMethodValue('remove_method','Repair');"
                    onMouseOver="checkOnOver('tdRemoveRepair','remove_method','Repair')"
                    onMouseOut="checkOnOut('tdRemoveRepair','remove_method','Repair')">
                      Repair</td>
                  </tr>
                </table></td>
              </tr> */ ?>
              <tr> <td height="30" width="150">Type of Upper Work</td>
                <td width="250" height="30" align="center" class="tdButtonOnOut" id="TDRemoveTypeupper"
        onclick="OpenDivRemoveTypeSelector('upper');" onmouseover="this.className='tdButtonOnOver';" onmouseout="this.className='tdButtonOnOut';"></td>
              </tr>
              <tr><td height="30">Type of Lower Work</td>
                <td height="30" align="center" class="tdButtonOnOut" id="TDRemoveTypelower"
        onclick="OpenDivRemoveTypeSelector('lower');" onmouseover="this.className='tdButtonOnOver';" onmouseout="this.className='tdButtonOnOut';"></td>
              </tr>
            </table>
            <? include "../cfrontend/tbframe2f.php" ?></td>
  <td width="300" rowspan="2" valign="top">
    <div style="width:290px"><? include("../eorder/eorder_remove_option.php");?>
    </div>
      <p>&nbsp;</p></td>
</tr>
<tr>
	<td height="500">	  <br />
	  <table border="0" cellpadding="0" cellspacing="0" background="../resource/images/eorder/teethbg.gif">
        <tr>
          <td width="300" height="192" align="right"><table width="100%" border="0" cellpadding="0" cellspacing="0">

            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(11)">
                    <tr>
                      <td width="100" align="center"><div id="DivRemoveMaterialSname11"></div></td>
                      <td width="32" height="32" align="center">11</td>
                      <td width="32"><img src="../resource/images/eorder/remove/t_uppergray.gif" name="ImgRemoveMaterial11" width="32" height="32" id="ImgRemoveMaterial11" /></td>
                      </tr>
                  </table></td>
                  <td width="4" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(12)">
                    <tr>
                      <td width="100" align="center"><div id="DivRemoveMaterialSname12"></div></td>
                      <td width="32" height="32" align="center">12</td>
                      <td width="32"><img id = "ImgRemoveMaterial12" src="../resource/images/eorder/remove/t_uppergray.gif" width="32" height="32" /></td>
                      </tr>
                  </table></td>
                  <td width="36" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(13)">
                    <tr>
                      <td width="100" align="center"><div id="DivRemoveMaterialSname13"></div></td>
                      <td width="32" height="32" align="center">13</td>
                      <td width="32"><img src="../resource/images/eorder/remove/t_uppergray.gif" name="ImgRemoveMaterial13" width="32" height="32" id="ImgRemoveMaterial13" /></td>
                      </tr>
                  </table></td>
                  <td width="68" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(14)">
                    <tr>
                      <td width="100" align="center"><div id="DivRemoveMaterialSname14"></div></td>
                      <td width="32" height="32" align="center">14</td>
                      <td width="32"><img src="../resource/images/eorder/remove/t_uppergray.gif" name="ImgRemoveMaterial14" width="32" height="32" id="ImgRemoveMaterial14" /></td>
                      </tr>
                  </table></td>
                  <td width="86" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(15)">
                <tr>
                  <td width="100" align="center"><div id="DivRemoveMaterialSname15"></div></td>
                  <td width="32" align="center">15</td>
                  <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial15" width="32" height="32" id="ImgRemoveMaterial15" /></td>
                  </tr>
                  </table></td>
                  <td width="102" height="32">&nbsp;</td> 
                 </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(16)">
                    <tr>
                      <td width="100" align="center"><div id="DivRemoveMaterialSname16"></div></td>
                      <td width="32" height="32" align="center">16</td>
                      <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial16" width="32" height="32" id="ImgRemoveMaterial16" /></td>
                      </tr>
                  </table></td>
                  <td width="114" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(17)">
                    <tr>
                      <td width="100" align="center"><div id="DivRemoveMaterialSname17"></div></td>
                      <td width="32" height="32" align="center">17</td>
                      <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial17" width="32" height="32" id="ImgRemoveMaterial17" /></td>
                      </tr>
                  </table></td>
                  <td width="122" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(18)">
                    <tr>
                      <td width="100" align="center"><div id="DivRemoveMaterialSname18"></div></td>
                      <td width="32" height="32" align="center">18</td>
                      <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial18" width="32" height="32" id="ImgRemoveMaterial18" /></td>
                      </tr>
                  </table></td>
                  <td width="130" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td width="300" height="192"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="4">&nbsp;</td>
                    <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(21)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_uppergray.gif" name="ImgRemoveMaterial21" width="32" height="32" id="ImgRemoveMaterial21" /></td>
                        <td width="32" align="center">21</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname21"></div></td>
                      </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="36">&nbsp;</td>
                    <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(22)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_uppergray.gif" name="ImgRemoveMaterial22" width="32" height="32" id="ImgRemoveMaterial22" /></td>
                        <td width="32" align="center">22</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname22"></div></td>
                      </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="68">&nbsp;</td>
                    <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(23)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_uppergray.gif" name="ImgRemoveMaterial23" width="32" height="32" id="ImgRemoveMaterial23" /></td>
                        <td width="32" align="center">23</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname23"></div></td>
                      </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="86" height="28">&nbsp;</td>
                    <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(24)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_uppergray.gif" name="ImgRemoveMaterial24" width="32" height="32" id="ImgRemoveMaterial24" /></td>
                        <td width="32" align="center">24</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname24"></div></td>
                      </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="102">&nbsp;</td>
                    <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(25)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial25" width="32" height="32" id="ImgRemoveMaterial25" /></td>
                        <td width="32" align="center">25</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname25"></div></td>
                      </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="114">&nbsp;</td>
                  <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(26)">
                    <tr>
                      <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial26" width="32" height="32" id="ImgRemoveMaterial26" /></td>
                      <td width="32" align="center">26</td>
                      <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname26"></div></td>
                    </tr>
                  </table></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="122">&nbsp;</td>
                  <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(27)">
                    <tr>
                      <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial27" width="32" height="32" id="ImgRemoveMaterial27" /></td>
                      <td width="32" align="center">27</td>
                      <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname27"></div></td>
                    </tr>
                  </table></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="130">&nbsp;</td>
                    <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(28)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial28" width="32" height="32" id="ImgRemoveMaterial28" /></td>
                        <td width="32" align="center">28</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname28"></div></td>
                      </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="30" colspan="2" align="center"><strong><font color="#FF0000">โปรดระวังกรอกผิดเพราะ แก้ให้สลับฟัน 31-38 กับ 41-48 แล้ว</font></strong></td>
          </tr>
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="32" align="right"><table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(48)">
                      <tr>
                        <td width="100" align="center"><div id="DivRemoveMaterialSname48"></div></td>
                        <td width="32" height="32" align="center">48</td>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial48" width="32" height="32" id="ImgRemoveMaterial48" /></td>
                      </tr>
                  </table></td>
                  <td width="130" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(47)">
                      <tr>
                        <td width="100" align="center"><div id="DivRemoveMaterialSname47"></div></td>
                        <td width="32" height="32" align="center">47</td>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial47" width="32" height="32" id="ImgRemoveMaterial47" /></td>
                      </tr>
                  </table></td>
                  <td width="122" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(46)">
                      <tr>
                        <td width="100" align="center"><div id="DivRemoveMaterialSname46"></div></td>
                        <td width="32" height="32" align="center">46</td>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial46" width="32" height="32" id="ImgRemoveMaterial46" /></td>
                      </tr>
                  </table></td>
                  <td width="114" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(45)">
                      <tr>
                        <td width="100" align="center"><div id="DivRemoveMaterialSname45"></div></td>
                        <td width="32" align="center">45</td>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial45" width="32" height="32" id="ImgRemoveMaterial45" /></td>
                      </tr>
                  </table></td>
                  <td width="102" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(44)">
                      <tr>
                        <td width="100" align="center"><div id="DivRemoveMaterialSname44"></div></td>
                        <td width="32" height="32" align="center">44</td>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial44" width="32" height="32" id="ImgRemoveMaterial44" /></td>
                      </tr>
                  </table></td>
                  <td width="86" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(43)">
                      <tr>
                        <td width="100" align="center"><div id="DivRemoveMaterialSname43"></div></td>
                        <td width="32" height="32" align="center">43</td>
                        <td width="32"><img src="../resource/images/eorder/remove/t_lowergray.gif" name="ImgRemoveMaterial43" width="32" height="32" id="ImgRemoveMaterial43" /></td>
                      </tr>
                  </table></td>
                  <td width="68" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(42)">
                      <tr>
                        <td width="100" align="center"><div id="DivRemoveMaterialSname42"></div></td>
                        <td width="32" height="32" align="center">42</td>
                        <td width="32"><img src="../resource/images/eorder/remove/t_lowergray.gif" name="ImgRemoveMaterial42" width="32" height="32" id="ImgRemoveMaterial42" /></td>
                      </tr>
                  </table></td>
                  <td width="36" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(41)">
                      <tr>
                        <td width="100" align="center"><div id="DivRemoveMaterialSname41"></div></td>
                        <td width="32" height="32" align="center">41</td>
                        <td width="32"><img src="../resource/images/eorder/remove/t_lowergray.gif" name="ImgRemoveMaterial41" width="32" height="32" id="ImgRemoveMaterial41" /></td>
                      </tr>
                  </table></td>
                  <td width="4" height="32">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="130">&nbsp;</td>
                  <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(38)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial38" width="32" height="32" id="ImgRemoveMaterial38" /></td>
                        <td width="32" align="center">38</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname38"></div></td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="122">&nbsp;</td>
                  <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(37)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial37" width="32" height="32" id="ImgRemoveMaterial37" /></td>
                        <td width="32" align="center">37</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname37"></div></td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="114">&nbsp;</td>
                  <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(36)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial36" width="32" height="32" id="ImgRemoveMaterial36" /></td>
                        <td width="32" align="center">36</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname36"></div></td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="102">&nbsp;</td>
                  <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(35)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial35" width="32" height="32" id="ImgRemoveMaterial35" /></td>
                        <td width="32" align="center">35</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname35"></div></td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="86" height="28">&nbsp;</td>
                  <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(34)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_middlegray.gif" name="ImgRemoveMaterial34" width="32" height="32" id="ImgRemoveMaterial34" /></td>
                        <td width="32" align="center">34</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname34"></div></td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="68">&nbsp;</td>
                  <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(33)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_lowergray.gif" name="ImgRemoveMaterial33" width="32" height="32" id="ImgRemoveMaterial33" /></td>
                        <td width="32" align="center">33</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname33"></div></td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="36">&nbsp;</td>
                  <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(32)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_lowergray.gif" name="ImgRemoveMaterial32" width="32" height="32" id="ImgRemoveMaterial32" /></td>
                        <td width="32" align="center">32</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname32"></div></td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="32" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="4">&nbsp;</td>
                  <td height="32"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectR'" onmouseout="this.className=''"
        		  onclick="remove_materialpopup(31)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/remove/t_lowergray.gif" name="ImgRemoveMaterial31" width="32" height="32" id="ImgRemoveMaterial31" /></td>
                        <td width="32" align="center">31</td>
                        <td width="100" height="32" align="center"><div id="DivRemoveMaterialSname31"></div></td>
                      </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
      <br />
      <br />
      <br />
      <br />
    <br /></td>
</tr>
<tr>
  <td><table border="0" cellspacing="0" cellpadding="0">
    <tr>
      <td valign="top"><? include "../cfrontend/tbframe2h.php" ?>
          <span class="style1" style="font-weight: bold">Shade</span><br />
          <table cellpadding="3" cellspacing="2" >
            <tr>
              <td>Shade </td>
              <td width="250" align="center" class="tdButtonOnOut" id="TDShadeTextremove0"
        onclick="OpenShadeSelector('remove',0,-1);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"></td>
            </tr>
          </table>
          <br />
          <span style="font-weight: bold"><span class="style1">Option</span><br />
          </span> <br />
          <table width="120" border="0" cellpadding="2" cellspacing="1" bgcolor="#999999">
            <tr>
              <td height="30" align="center" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OpenDivAttachmentSelector('remove');"><table width="100%">
                  <tr>
                    <td><img src="../resource/images/eorder/attach/attach.gif" width="24" height="24" /></td>
                    <td>Attachment</td>
                  </tr>
              </table></td>
            </tr>
          </table>
          
          
          <? include "../cfrontend/tbframe2f.php" ?></td>
      </tr>
    <tr>
      <td><? include "../cfrontend/tbframe2h.php" ?>
          <span style="font-weight: bold"><span class="style1">observation</span><br />
          </span> <br />
          <textarea name="remove_observation" id="remove_observation" style="width:550px;height:150px"><?=$remove_observation?></textarea>
          <? include "../cfrontend/tbframe2f.php" ?></td>
    </tr>
  </table></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td align="right" valign="bottom"><a href="#TOP">Goto top</a></td>
</tr>
</table>


<? include "../cfrontend/tbframef.php"?>
</td></tr></table>

<?php
//echo $name[0] . " ".$image[0]." ".$idvalue[0]." ".$description[0];
?>
<script>
var remove_materialpopup_select;
var remove_materialpopup_material;
var remove_materialpopup_type;
function remove_materialpopup(teethnumber)
{
	var isCompleteRemove1 = false;
	var isCompleteRemove2 = false;
	remove_materialpopup_select = teethnumber;
	//Sample : เปิดหน้าต่างเลือก ชนิดฟัน  FixMaterialSelector
	
	if(teethnumber < 30){
		part = "upper";
	}else{
		part = "lower";
	}
	

	
	
	remove_materialpopup_type = findObj('remove_mat['+part+']').value;
	
	if(remove_materialpopup_type.substring(0,1) == "0"){//Check is none
		showAlert("SelectTOW");
		return;
	}
	//alert(remove_materialpopup_type);
	//alert(remove_materialpopup_type.substring(0,1));
	if(remove_materialpopup_type.substring(0,1) == "A"){//RPD
		activeBG();
		makeCenterScreen('RemoveMaterialSelector');
		showHideLayers('RemoveMaterialSelector','','show');
		showHideLayers('RemoveMaterialSelector_RPD','','show');
		showHideLayers('RemoveMaterialSelector_TP','','hide');
		showHideLayers('RemoveMaterialSelector_HEXA','','hide');
		
	}else if(remove_materialpopup_type.substring(0,1) == "B"){//TP
		activeBG();
		makeCenterScreen('RemoveMaterialSelector');
		showHideLayers('RemoveMaterialSelector','','show');
		showHideLayers('RemoveMaterialSelector_RPD','','show');
		showHideLayers('RemoveMaterialSelector_TP','','show');
		showHideLayers('RemoveMaterialSelector_HEXA','','hide');
		
		
	}else if(remove_materialpopup_type.substring(0,2) == "DC"){//HEXA Special request
		activeBG();
		makeCenterScreen('RemoveMaterialSelector');
		showHideLayers('RemoveMaterialSelector','','show');
		showHideLayers('RemoveMaterialSelector_RPD','','hide');
		showHideLayers('RemoveMaterialSelector_TP','','hide');
		showHideLayers('RemoveMaterialSelector_HEXA','','show');
	}else if(remove_materialpopup_type.substring(0,2) == "DB"){//HEXA Removable Bridge
		if(findObj('remove_material['+teethnumber+']').value != "25"){
			if(teethnumber == 11){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "25"){
					remove_material_setvalue(teethnumber+1,"25",1);
				}else{
					remove_material_setvalue(teethnumber+1,"26",1);
				}
				if(findObj('remove_material[21]').value == "25"){
					remove_material_setvalue("21","25",1);
				}else{
					remove_material_setvalue("21","26",1);
				}
				remove_material_setvalue(teethnumber,"25",1);
			}else if(teethnumber == 21){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "25"){
					remove_material_setvalue(teethnumber+1,"25",1);
				}else{
					remove_material_setvalue(teethnumber+1,"26",1);
				}
				if(findObj('remove_material[11]').value == "25"){
					remove_material_setvalue("11","25",1);
				}else{
					remove_material_setvalue("11","26",1);
				}
				remove_material_setvalue(teethnumber,"25",1);
			}else if(teethnumber == 31){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "25"){
					remove_material_setvalue(teethnumber+1,"25",1);
				}else{
					remove_material_setvalue(teethnumber+1,"26",1);
				}
				if(findObj('remove_material[41]').value == "25"){
					remove_material_setvalue("41","25",1);
				}else{
					remove_material_setvalue("41","26",1);
				}
				remove_material_setvalue(teethnumber,"25",1);
			}else if(teethnumber == 41){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "25"){
					remove_material_setvalue(teethnumber+1,"25",1);
				}else{
					remove_material_setvalue(teethnumber+1,"26",1);
				}
				if(findObj('remove_material[31]').value == "25"){
					remove_material_setvalue("31","25",1);
				}else{
					remove_material_setvalue("31","26",1);
				}
				remove_material_setvalue(teethnumber,"25",1);
			}else if(teethnumber == 18){
			
			}else if(teethnumber == 28){
			
			}else if(teethnumber == 38){
			
			}else if(teethnumber == 48){
			
			}else{		
				if(findObj('remove_material['+(teethnumber+1)+']').value == "25"){
					remove_material_setvalue(teethnumber+1,"25",1);
				}else{
					remove_material_setvalue(teethnumber+1,"26",1);
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "25"){
					remove_material_setvalue(teethnumber-1,"25",1);
				}else{
					remove_material_setvalue(teethnumber-1,"26",1);
				}
				remove_material_setvalue(teethnumber,"25",1);
			}
		}else{
			if(teethnumber == 11){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "26"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "25"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"26",1);
					}
				}
				if(findObj('remove_material[21]').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[22]').value != "25"){
						remove_material_setvalue("21","0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue("21","26",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
			}else if(teethnumber == 12){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "26"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "25"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"26",1);
					}
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[21]').value != "25"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"26",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
			}else if(teethnumber == 21){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "26"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "25"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"26",1);
					}
				}
				if(findObj('remove_material[11]').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[12]').value != "25"){
						remove_material_setvalue("11","0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue("11","26",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
			}else if(teethnumber ==22){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "26"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "25"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"26",1);
					}
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[11]').value != "25"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"26",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
			}else if(teethnumber == 31){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "26"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "25"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"26",1);
					}
				}
				if(findObj('remove_material[41]').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[42]').value != "25"){
						remove_material_setvalue("41","0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue("41","26",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
			}else if(teethnumber == 32){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "26"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "25"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"26",1);
					}
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[41]').value != "25"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"26",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
			}else if(teethnumber == 41){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "26"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "25"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"26",1);
					}
				}
				if(findObj('remove_material[31]').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[32]').value != "25"){
						remove_material_setvalue("31","0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue("31","26",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
			}else if(teethnumber == 42){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "26"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "25"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"26",1);
					}
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[31]').value != "25"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"26",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
			}else if(teethnumber == 18){
			
			}else if(teethnumber == 17){
				if(findObj('remove_material['+(teethnumber-1)+']').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material['+(teethnumber-2)+']').value != "25"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"26",1);
					}
				}
				if(isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
				remove_material_setvalue(teethnumber+1,"0",1);
			}else if(teethnumber == 28){
			
			}else if(teethnumber == 27){
				if(findObj('remove_material['+(teethnumber-1)+']').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material['+(teethnumber-2)+']').value != "25"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"26",1);
					}
				}
				if(isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
				remove_material_setvalue(teethnumber+1,"0",1);
			}else if(teethnumber == 38){
			
			}else if(teethnumber == 37){
				if(findObj('remove_material['+(teethnumber-1)+']').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material['+(teethnumber-2)+']').value != "25"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"26",1);
					}
				}
				if(isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
				remove_material_setvalue(teethnumber+1,"0",1);
			}else if(teethnumber == 48){
			
			}else if(teethnumber == 47){
				if(findObj('remove_material['+(teethnumber-1)+']').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material['+(teethnumber-2)+']').value != "25"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"26",1);
					}
				}
				if(isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
				remove_material_setvalue(teethnumber+1,"0",1);
			}else{
				 if(findObj('remove_material['+(teethnumber+1)+']').value == "26"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "25"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"26",1);
					}
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "26"){
					isCompleteRemove2 = true;
					if(findObj('remove_material['+(teethnumber-2)+']').value != "25"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"26",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"26",1);
				}
			}
		}
	}else if(remove_materialpopup_type.substring(0,2) == "CA"){//ACETAL tooth
		if(getValue('remove_material['+teethnumber+']') != "27"){
			remove_material_setvalue(teethnumber,"27",0);
		}else{
			remove_material_setvalue(teethnumber,"0",0);
		}
	}else if(remove_materialpopup_type.substring(0,2) == "CB"){//ACETAL clasp
		if(findObj('remove_material['+teethnumber+']').value != "28"){
			remove_material_setvalue(teethnumber,"28",1);
		}else{
			remove_material_setvalue(teethnumber,"0",1);
		}
	}else if(remove_materialpopup_type.substring(0,2) == "CC"){//ACETAL framework
		if(findObj('remove_material['+teethnumber+']').value != "29"){
			remove_material_setvalue(teethnumber,"29",1);
		}else{
			remove_material_setvalue(teethnumber,"0",1);
		}
	}else if(remove_materialpopup_type.substring(0,2) == "CD"){//ACETAL Removable Bridge

		/////////////////
		if(findObj('remove_material['+teethnumber+']').value != "30"){
			if(teethnumber == 11){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "30"){
					remove_material_setvalue(teethnumber+1,"30",1);
				}else{
					remove_material_setvalue(teethnumber+1,"31",1);
				}
				if(findObj('remove_material[21]').value == "30"){
					remove_material_setvalue("21","30",1);
				}else{
					remove_material_setvalue("21","31",1);
				}
				remove_material_setvalue(teethnumber,"30",1);
			}else if(teethnumber == 21){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "30"){
					remove_material_setvalue(teethnumber+1,"30",1);
				}else{
					remove_material_setvalue(teethnumber+1,"31",1);
				}
				if(findObj('remove_material[11]').value == "30"){
					remove_material_setvalue("11","30",1);
				}else{
					remove_material_setvalue("11","31",1);
				}
				remove_material_setvalue(teethnumber,"30",1);
			}else if(teethnumber == 31){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "30"){
					remove_material_setvalue(teethnumber+1,"30",1);
				}else{
					remove_material_setvalue(teethnumber+1,"31",1);
				}
				if(findObj('remove_material[41]').value == "30"){
					remove_material_setvalue("41","30",1);
				}else{
					remove_material_setvalue("41","31",1);
				}
				remove_material_setvalue(teethnumber,"30",1);
			}else if(teethnumber == 41){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "30"){
					remove_material_setvalue(teethnumber+1,"30",1);
				}else{
					remove_material_setvalue(teethnumber+1,"31",1);
				}
				if(findObj('remove_material[31]').value == "30"){
					remove_material_setvalue("31","30",1);
				}else{
					remove_material_setvalue("31","31",1);
				}
				remove_material_setvalue(teethnumber,"30",1);
			}else if(teethnumber == 18){
			}else if(teethnumber == 28){
			}else if(teethnumber == 38){
			}else if(teethnumber == 48){
			}else{		
				if(findObj('remove_material['+(teethnumber+1)+']').value == "30"){
					remove_material_setvalue(teethnumber+1,"30",1);
				}else{
					remove_material_setvalue(teethnumber+1,"31",1);
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "30"){
					remove_material_setvalue(teethnumber-1,"30",1);
				}else{
					remove_material_setvalue(teethnumber-1,"31",1);
				}
				remove_material_setvalue(teethnumber,"30",1);
			}
		}else{
			if(teethnumber == 11){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "31"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "30"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"31",1);
					}
				}
				if(findObj('remove_material[21]').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[22]').value != "30"){
						remove_material_setvalue("21","0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue("21","31",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
			}else if(teethnumber == 12){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "31"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "30"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"31",1);
					}
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[21]').value != "30"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"31",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
			}else if(teethnumber == 21){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "31"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "30"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"31",1);
					}
				}
				if(findObj('remove_material[11]').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[12]').value != "30"){
						remove_material_setvalue("11","0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue("11","31",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
			}else if(teethnumber ==22){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "31"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "30"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"31",1);
					}
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[11]').value != "30"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"31",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
			}else if(teethnumber == 31){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "31"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "30"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"31",1);
					}
				}
				if(findObj('remove_material[41]').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[42]').value != "30"){
						remove_material_setvalue("41","0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue("41","31",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
			}else if(teethnumber == 32){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "31"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "30"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"31",1);
					}
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[41]').value != "30"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"31",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
			}else if(teethnumber == 41){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "31"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "30"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"31",1);
					}
				}
				if(findObj('remove_material[31]').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[32]').value != "30"){
						remove_material_setvalue("31","0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue("31","31",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
			}else if(teethnumber == 42){
				if(findObj('remove_material['+(teethnumber+1)+']').value == "31"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "30"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"31",1);
					}
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material[31]').value != "30"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"31",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
			}else if(teethnumber == 18){
			
			}else if(teethnumber == 17){
				if(findObj('remove_material['+(teethnumber-1)+']').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material['+(teethnumber-2)+']').value != "30"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"31",1);
					}
				}
				if(isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
				remove_material_setvalue(teethnumber+1,"0",1);
			}else if(teethnumber == 28){
			
			}else if(teethnumber == 27){
				if(findObj('remove_material['+(teethnumber-1)+']').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material['+(teethnumber-2)+']').value != "30"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"31",1);
					}
				}
				if(isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
				remove_material_setvalue(teethnumber+1,"0",1);
			}else if(teethnumber == 38){
			
			}else if(teethnumber == 37){
				if(findObj('remove_material['+(teethnumber-1)+']').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material['+(teethnumber-2)+']').value != "30"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"31",1);
					}
				}
				if(isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
				remove_material_setvalue(teethnumber+1,"0",1);
			}else if(teethnumber == 48){
			
			}else if(teethnumber == 47){
				if(findObj('remove_material['+(teethnumber-1)+']').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material['+(teethnumber-2)+']').value != "30"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"31",1);
					}
				}
				if(isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
				remove_material_setvalue(teethnumber+1,"0",1);
			}else{
				 if(findObj('remove_material['+(teethnumber+1)+']').value == "31"){
				 	isCompleteRemove1 = true;
					if(findObj('remove_material['+(teethnumber+2)+']').value != "30"){
						remove_material_setvalue(teethnumber+1,"0",1);
						isCompleteRemove1 = true;
					}else{
						remove_material_setvalue(teethnumber+1,"31",1);
					}
				}
				if(findObj('remove_material['+(teethnumber-1)+']').value == "31"){
					isCompleteRemove2 = true;
					if(findObj('remove_material['+(teethnumber-2)+']').value != "30"){
						remove_material_setvalue(teethnumber-1,"0",1);
						isCompleteRemove2 = true;
					}else{
						remove_material_setvalue(teethnumber-1,"31",1);
					}
				}
				if(isCompleteRemove1 && isCompleteRemove2){
					remove_material_setvalue(teethnumber,"0",1);
				}else{
					remove_material_setvalue(teethnumber,"31",1);
				}
			}
		}
	}else if(remove_materialpopup_type.substring(0,2) == "CE"){//ACETAL Swing lock
		if(findObj('remove_material['+teethnumber+']').value != "32"){
			remove_material_setvalue(teethnumber,"32",1);
		}else{
			remove_material_setvalue(teethnumber,"0",1);
		}
	}else if(remove_materialpopup_type.substring(0,1) == "F"){//Bite Block
		activeBG();
		makeCenterScreen('RemoveMaterialSelector');
		showHideLayers('RemoveMaterialSelector','','show');
		showHideLayers('RemoveMaterialSelector_RPD','','show');
		showHideLayers('RemoveMaterialSelector_TP','','show');
		showHideLayers('RemoveMaterialSelector_HEXA','','show');
	}else if(remove_materialpopup_type.substring(0,1) == "G"){//Order spacial Tray + Bite Block
		activeBG();
		makeCenterScreen('RemoveMaterialSelector');
		showHideLayers('RemoveMaterialSelector','','show');
		showHideLayers('RemoveMaterialSelector_RPD','','show');
		showHideLayers('RemoveMaterialSelector_TP','','show');
		showHideLayers('RemoveMaterialSelector_HEXA','','show');
	}	
	
}
function remove_materialclose()
{
	hideBG();
	showHideLayers('RemoveMaterialSelector','','hide');
}

function remove_material_setvalue(number,value,isPopOption)
{
	//var conf_no = con_no;
	var sname,img;
	setValue('remove_material['+number+']',value);
	remove_materialpopup_material = value;
	remove_materialclose();
	switch(value){
		case '0':
		sname = '<?=$removematerial_shortname[0]?>';
		img = '<?=$removematerial_image[0]?>';
		if(isPopOption){
			<?=$removematerial_optiononselect[0];?>
			ReCalculateSummary('DivInvoiceResult');
		}
			
		break;
	<? for($i=1;$i<count($removematerial_name);$i++){?>
		<? if($removematerial_idvalue[$i]==0)continue; ?>
		case '<?=$removematerial_idvalue[$i]?>':
			sname = '<?=$removematerial_shortname[$i]?>';
			img = '<?=$removematerial_image[$i]?>';
			if(isPopOption){
				<?=$removematerial_optiononselect[$i];?>
				ReCalculateSummary('DivInvoiceResult');
			}
			
			break;
	<? }?> 
	}
	writeit('DivRemoveMaterialSname'+number,sname);
	findObj('ImgRemoveMaterial'+number).src = '<?=$removematerial_imagepath?>'+img;
	
	
}


</script>
<script>showHideLayers('RemoveMaterialSelector','','hide');</script>
<script>showHideLayers('RemoveMaterialSelector_TP','','hide');</script>
<script>showHideLayers('RemoveMaterialSelector_RPD','','hide');</script>
<script>showHideLayers('RemoveMaterialSelector_HEXA','','hide');</script>
<script>showHideLayers('DivRemoveOptionMaterial','','hide');</script>
<script>showHideLayers('TABLE_RPD_ACRYLICFORFINISH','','hide');</script>
<script>showHideLayers('TABLE_RPD_TEETHANDSETUP','','hide');</script>
<script>showHideLayers('TABLE_RPD_GUMFIT','','hide');</script>
<script>showHideLayers('TABLE_RPD_SPECIALREQUEST','','hide');</script>
<script>showHideLayers('TABLE_TP_OrderAcrylic','','hide');</script>
<script>showHideLayers('TABLE_TP_TPOrderGrid','','hide');</script>
<script>//showHideLayers('TABLE_Work','','hide');</script>
