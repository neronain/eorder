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

<?php include_once "../eorder/eorder_fix_config.php" ?>

<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {font-size: 18px}
-->
</style>
<div id="FixMaterialSelector" style="position:absolute; white-space:nowrap; left:0px; top:2000px; width:640px; height:480px; z-index:1; margin:0;">
<? $tbframeheader = "Fix type of work select"?>
<? $tbframehclose = "fix_materialclose()";?>
<? include "../cfrontend/tbframeh.php"?><br />

    <div style="width:auto;height:auto;overflow:auto">
      <table border="0" cellpadding="2" cellspacing="1" bgcolor="#999999">
      <? for($i=0;$i<count($fixmaterial_name);$i+=3){ ?>
        <tr>
          <td width="200" class="tdButtonOnOut"  onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" id="FixMaterialSelector_ID<?=$fixmaterial_idvalue[$i]?>" onclick="fix_material_setvalue(fix_materialpopup_select,'<?=$fixmaterial_idvalue[$i]?>',1)" >

        <img src="../resource/images/eorder/fix/<?=$fixmaterial_image[$i]?>" /><?=$fixmaterial_name[$i]?>

        </td>
          <td width="200" class="tdButtonOnOut"  onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" id="FixMaterialSelector_ID<?=$fixmaterial_idvalue[$i+1]?>" onclick="fix_material_setvalue(fix_materialpopup_select,'<?=$fixmaterial_idvalue[$i+1]?>',1)"><? if(isset($fixmaterial_idvalue[$i+1])){ ?>

       <? if(isset($fixmaterial_image[$i+1])){ ?><img src="../resource/images/eorder/fix/<?=$fixmaterial_image[$i+1]?>" /><? } ?><? if(isset($fixmaterial_name[$i+1])){echo $fixmaterial_name[$i+1];}?><? }?></td>
       	  <td width="200" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" id="FixMaterialSelector_ID<?=$fixmaterial_idvalue[$i+2]?>" onclick="fix_material_setvalue(fix_materialpopup_select,'<?=$fixmaterial_idvalue[$i+2]?>',1)" ><? if(isset($fixmaterial_idvalue[$i+2])){ ?>

       <? if(isset($fixmaterial_image[$i+2])){ ?><img src="../resource/images/eorder/fix/<?=$fixmaterial_image[$i+2]?>" /><? } ?><? if(isset($fixmaterial_name[$i+2])){echo $fixmaterial_name[$i+2];}?><? }?></td>
        </tr>
      <? } ?>
      </table>
      </div>
<? include "../cfrontend/tbframef.php"?>
</div>
<? // ------------------------------------------------------------------------------- ?>
<div id="DivFixOptionMaterial" style="position:absolute; white-space:nowrap; left:0px; top:1800px; width:260px; height:200px; z-index:1; margin:0;" align="left">
<? include "../cfrontend/tbframe2h.php"?>
  <span style="font-weight: bold">Option</span><br><div id="DivFixOptionMaterial_Question"> </div><br>	

<div id="DivFixOptionMaterial_TR0"> 
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240" height="30" align="center" class="tdButtonOnOut" onclick="fix_material_setoptionvalue(fix_materialpopup_select,getValue('DivFixOptionMaterial_Opt0'));" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivFixOptionMaterial_Opt0"></Div></td>
    </tr>  
  </table>
</div>    

<div id="DivFixOptionMaterial_TR1">    
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240"  height="30" align="center" class="tdButtonOnOut" onclick="fix_material_setoptionvalue(fix_materialpopup_select,getValue('DivFixOptionMaterial_Opt1'));" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivFixOptionMaterial_Opt1"></Div></td>
    </tr>
  </table>
</div>    

<div id="DivFixOptionMaterial_TR2">
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240" height="30" align="center" class="tdButtonOnOut" onclick="fix_material_setoptionvalue(fix_materialpopup_select,getValue('DivFixOptionMaterial_Opt2'));" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivFixOptionMaterial_Opt2"></Div></td></tr>
  </table>
</div>


<div id="DivFixOptionMaterial_TR3">
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240" height="30" align="center" class="tdButtonOnOut" onclick="fix_material_setoptionvalue(fix_materialpopup_select,getValue('DivFixOptionMaterial_Opt3'));" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivFixOptionMaterial_Opt3"></Div></td></tr>
  </table>
</div>

<div id="DivFixOptionMaterial_TR4">
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240" height="30" align="center" class="tdButtonOnOut" onclick="fix_material_setoptionvalue(fix_materialpopup_select,getValue('DivFixOptionMaterial_Opt4'));" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivFixOptionMaterial_Opt4"></Div></td></tr>
  </table>
</div>

<div id="DivFixOptionMaterial_TR5">
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240" height="30" align="center" class="tdButtonOnOut" onclick="fix_material_setoptionvalue(fix_materialpopup_select,getValue('DivFixOptionMaterial_Opt5'));" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivFixOptionMaterial_Opt5"></Div></td></tr>
  </table>
</div>
<div id="DivFixOptionMaterial_TR6">
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240" height="30" align="center" class="tdButtonOnOut" onclick="fix_material_setoptionvalue(fix_materialpopup_select,getValue('DivFixOptionMaterial_Opt6'));" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivFixOptionMaterial_Opt6"></Div></td></tr>
  </table>
</div>
<div id="DivFixOptionMaterial_TR7">
  <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
    <tr>
      <td width="240" height="30" align="center" class="tdButtonOnOut" onclick="fix_material_setoptionvalue(fix_materialpopup_select,getValue('DivFixOptionMaterial_Opt7'));" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">
      <Div id="DivFixOptionMaterial_Opt7"></Div></td></tr>
  </table>
</div>


<? include "../cfrontend/tbframe2f.php"?>
</div>
<script>
function FixOptionMaterial_Popup(){
	activeBG();
	var question;
	switch(fix_materialpopup_material){
	<? for($i=0;$i<count($fixmaterial_name);$i++){?>
		case '<?=$fixmaterial_idvalue[$i]?>':
<?php//----------------------------------------------Option Fix-------------------------------------------------?>
			question = '<?=$fixmaterial_option_question[$i]?>'
			
			option0 = '<?=$fixmaterial_option_fname[$i][0]?>';
			option1 = '<?=$fixmaterial_option_fname[$i][1]?>';
			option2 = '<?=$fixmaterial_option_fname[$i][2]?>';
			option3 = '<?=$fixmaterial_option_fname[$i][3]?>';
			option4 = '<?=$fixmaterial_option_fname[$i][4]?>';
			option5 = '<?=$fixmaterial_option_fname[$i][5]?>';
			option6 = '<?=$fixmaterial_option_fname[$i][6]?>';
			option7 = '<?=$fixmaterial_option_fname[$i][7]?>';
			option8 = '<?=$fixmaterial_option_fname[$i][8]?>';
			option9 = '<?=$fixmaterial_option_fname[$i][9]?>';
			
			optionV0 = '<?=$fixmaterial_option_value[$i][0]?>';
			optionV1 = '<?=$fixmaterial_option_value[$i][1]?>';
			optionV2 = '<?=$fixmaterial_option_value[$i][2]?>';
			optionV3 = '<?=$fixmaterial_option_value[$i][3]?>';
			optionV4 = '<?=$fixmaterial_option_value[$i][4]?>';
			optionV5 = '<?=$fixmaterial_option_value[$i][5]?>';
			optionV6 = '<?=$fixmaterial_option_value[$i][6]?>';
			optionV7 = '<?=$fixmaterial_option_value[$i][7]?>';
			optionV8 = '<?=$fixmaterial_option_value[$i][8]?>';
			optionV9 = '<?=$fixmaterial_option_value[$i][9]?>';

			break;
	<? }?> 
	}
	writeit('DivFixOptionMaterial_Question',question);


	findObj('DivFixOptionMaterial_TR2').style.display = option2.length==0?'none':'inline';
	findObj('DivFixOptionMaterial_TR3').style.display = option3.length==0?'none':'inline';
	findObj('DivFixOptionMaterial_TR4').style.display = option4.length==0?'none':'inline';
	findObj('DivFixOptionMaterial_TR5').style.display = option5.length==0?'none':'inline';
	findObj('DivFixOptionMaterial_TR6').style.display = option6.length==0?'none':'inline';
	findObj('DivFixOptionMaterial_TR7').style.display = option7.length==0?'none':'inline';


	writeit('DivFixOptionMaterial_Opt0',option0);
	writeit('DivFixOptionMaterial_Opt1',option1);
	writeit('DivFixOptionMaterial_Opt2',option2);
	writeit('DivFixOptionMaterial_Opt3',option3);
	writeit('DivFixOptionMaterial_Opt4',option4);
	writeit('DivFixOptionMaterial_Opt5',option5);
	writeit('DivFixOptionMaterial_Opt6',option6);
	writeit('DivFixOptionMaterial_Opt7',option7);


	
	findObj('DivFixOptionMaterial_Opt0').value = optionV0;
	findObj('DivFixOptionMaterial_Opt1').value = optionV1;
	findObj('DivFixOptionMaterial_Opt2').value = optionV2;
	findObj('DivFixOptionMaterial_Opt3').value = optionV3;
	findObj('DivFixOptionMaterial_Opt4').value = optionV4;
	findObj('DivFixOptionMaterial_Opt5').value = optionV5;
	findObj('DivFixOptionMaterial_Opt6').value = optionV6;
	findObj('DivFixOptionMaterial_Opt7').value = optionV7;


	
	
	

	makeCenterScreen('DivFixOptionMaterial');
	showHideLayers('DivFixOptionMaterial','','show');
}
function fix_material_setoptionvalue(number,value)
{	
	//alert(value);
	var optsname = new Array();
	if(value=='')value=0;
	if(!value)value=0;
	switch(fix_materialpopup_material){
	<? for($i=0;$i<count($fixmaterial_name);$i++){?>
		case '<?=$fixmaterial_idvalue[$i]?>':
			sname = '<?=$fixmaterial_shortname[$i]?>';
			optsname[value]="";
			<? if($fixmaterial_option_value[$i][0]>0) { ?>
			optsname[<?=$fixmaterial_option_value[$i][0]?>] = '<?=$fixmaterial_option_sname[$i][0]?>'; <? } ?>
			<? if($fixmaterial_option_value[$i][1]>0) { ?>
			optsname[<?=$fixmaterial_option_value[$i][1]?>] = '<?=$fixmaterial_option_sname[$i][1]?>';<? } ?>
			<? if($fixmaterial_option_value[$i][2]>0) { ?>
			optsname[<?=$fixmaterial_option_value[$i][2]?>] = '<?=$fixmaterial_option_sname[$i][2]?>';<? } ?>
			<? if($fixmaterial_option_value[$i][3]>0) { ?>
			optsname[<?=$fixmaterial_option_value[$i][3]?>] = '<?=$fixmaterial_option_sname[$i][3]?>';<? } ?>
			<? if($fixmaterial_option_value[$i][4]>0) { ?>
			optsname[<?=$fixmaterial_option_value[$i][4]?>] = '<?=$fixmaterial_option_sname[$i][4]?>';<? } ?>
			<? if($fixmaterial_option_value[$i][5]>0) { ?>
			optsname[<?=$fixmaterial_option_value[$i][5]?>] = '<?=$fixmaterial_option_sname[$i][5]?>';<? } ?>
			<? if($fixmaterial_option_value[$i][6]>0) { ?>
			optsname[<?=$fixmaterial_option_value[$i][6]?>] = '<?=$fixmaterial_option_sname[$i][6]?>';<? } ?>
			<? if($fixmaterial_option_value[$i][7]>0) { ?>
			optsname[<?=$fixmaterial_option_value[$i][7]?>] = '<?=$fixmaterial_option_sname[$i][7]?>';<? } ?>
						
			writeit('DivFixMaterialSname'+number,sname+optsname[value]);
			
			break;
	<? }?> 
	}
	//oldName = findObj('DivFixMaterialSname'+number).id;
	//alert(oldName);
	//alert('['+number+']'+value);
	setValue('fix_opt_mat['+number+']',value)

	hideBG();
	showHideLayers('DivFixOptionMaterial','','hide');
}
</script>
<? // ------------------------------------------------------------------------------- ?>
<a name="FixAnchor" id="FixAnchor"></a>
<table cellpadding="0" cellspacing="0">
  <tr><td width="20"></td><td width="930">
<? $tbframeheader = "Fix order detail"?>
<? $tbframehscript='<a href="#TOP">Goto top</a>' ?>
<? include "../cfrontend/tbframeh.php"?>
<br />
<table border="0" cellpadding="2" cellspacing="1">
<tr>
	<td valign="top" ><? include "../cfrontend/tbframe2h.php" ?>
            <span style="font-weight: bold"><span class="style1">Detail</span><br />
            </span> <br />
            <table border="0" cellpadding="2" cellspacing="1">
              <tr>
                <td width="80" align="center" >Method</td>
                <td align="center" ><table border="0" cellpadding="0" cellspacing="5" width="100%">
                  <tr>
                    <td width="60" height="25" align="center" bgcolor="" 
                    id = "tdTry-in"
                    onclick="setTdMethodValue('fix_method','Try-in');"
                    onMouseOver="checkOnOver('tdTry-in','fix_method','Try-in')"
                    onMouseOut="checkOnOut('tdTry-in','fix_method','Try-in')">
                      Try-in</td>
                    <td width="60" height="25" align="center"  id = "tdContour"
                    onclick="setTdMethodValue('fix_method','Contour');"
                    onMouseOver="checkOnOver('tdContour','fix_method','Contour')"
                    onMouseOut="checkOnOut('tdContour','fix_method','Contour')">
                      Contour</td>
                    <td width="60" height="25" align="center"  id = "tdFinish"
                    onclick="setTdMethodValue('fix_method','Finish');"
                    onMouseOver="checkOnOver('tdFinish','fix_method','Finish')"
                    onMouseOut="checkOnOut('tdFinish','fix_method','Finish')">
                      Finish</td>
                    <td width="60" height="25" align="center"  id = "tdRepair"
                    onclick="setTdMethodValue('fix_method','Repair');"
                    onMouseOver="checkOnOver('tdRepair','fix_method','Repair')"
                    onMouseOut="checkOnOut('tdRepair','fix_method','Repair')">
                      Repair</td>
                    <td width="60" height="25" align="center"  id = "tdRemake"
                    onclick="setTdMethodValue('fix_method','Remake');"
                    onMouseOver="checkOnOver('tdRemake','fix_method','Remake')"
                    onMouseOut="checkOnOut('tdRemake','fix_method','Remake')">
                      Remake</td>
                      <td width="60">&nbsp;</td>
                 </tr>
                 <tr>
                    <td height="25" colspan="3" align="center"  id = "tdFinishTry-in"
                    onclick="setTdMethodValue('fix_method','Finish after Try-in');"
                    onMouseOver="checkOnOver2('tdFinishTry-in','fix_method','Finish after Try-in')"
                    onMouseOut="checkOnOut2('tdFinishTry-in','fix_method','Finish after Try-in')">                      
                      Finish after Try-in</td>
                      <td height="25" colspan="3" align="center"  id = "tdRemakeFinish"
                    onclick="setTdMethodValue('fix_method','Remake & Finish');"
                    onMouseOver="checkOnOver2('tdRemakeFinish','fix_method','Remake & Finish')"
                    onMouseOut="checkOnOut2('tdRemakeFinish','fix_method','Remake & Finish')">
                      Remake & Finish</td>
                      

                  </tr>
                </table></td>
              </tr>
              <tr>
                <td align="center">Embrasure</td>
                <td><table border="0" cellpadding="0" cellspacing="5">
                    <tr>
                      <td width="60" height="25" align="center" id="tdEmbNone"
                      onclick="setTdMethodValue('fix_embrasure','None');"
                      onMouseOver="checkOnOver('tdEmbNone','fix_embrasure','None')"
                      onMouseOut="checkOnOut('tdEmbNone','fix_embrasure','None')">                        None</td>
                      <td width="60" height="25" align="center" id="tdEmbOpen"
                      onclick="setTdMethodValue('fix_embrasure','Open');"
                      onMouseOver="checkOnOver('tdEmbOpen','fix_embrasure','Open')"
                      onMouseOut="checkOnOut('tdEmbOpen','fix_embrasure','Open')">                        Open</td>
                      <td width="60" height="25" align="center" id="tdEmbClose"
                      onclick="setTdMethodValue('fix_embrasure','Close');"
                      onMouseOver="checkOnOver('tdEmbClose','fix_embrasure','Close')"
                      onMouseOut="checkOnOut('tdEmbClose','fix_embrasure','Close')">                        Close</td>
                    </tr>
                </table></td>
              </tr>
              <tr>
                <td align="center">Bridge</td>
                <td>
			<table width="150" border="0" cellpadding="2" cellspacing="1" bgcolor="#999999">
                        <tr>
          <td height="30" align="center" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OpenDivBridgeSelector();"><table width="100%">
              <tr>
                <td><img src="../resource/images/eorder/fix/bridge_5.gif" width="26" height="5" /></td>
                <td>Select bridge</td>
              </tr>
          </table></td>
        </tr>
      </table>
                </td>
              </tr>
              </table>
                          <table border="0" cellpadding="2" cellspacing="1">
              
              <tr>
                <td width="80" align="center">Pontic</td>
                <td><table border="0" cellpadding="0" cellspacing="5">
                    <tr>
                      <td width="36" height="36" align="center" id="tdPontic0"
                      onclick="setTdMethodValue('fix_pontic','0');"
                      onMouseOver="checkOnOver3('tdPontic0','fix_pontic','0')"
                      onMouseOut="checkOnOut3('tdPontic0','fix_pontic','0')"><img src="../resource/images/eorder/fix/fix_pontic0.gif" width="32" height="32" /></td>
                      <td width="36" height="36" align="center" id="tdPontic1"
                      onclick="setTdMethodValue('fix_pontic','1');"
                      onMouseOver="checkOnOver3('tdPontic1','fix_pontic','1')"
                      onMouseOut="checkOnOut3('tdPontic1','fix_pontic','1')"><img src="../resource/images/eorder/fix/fix_pontic1.gif" width="32" height="32" /></td>
                      <td width="36" height="36" align="center" id="tdPontic2"
                      onclick="setTdMethodValue('fix_pontic','2');"
                      onMouseOver="checkOnOver3('tdPontic2','fix_pontic','2')"
                      onMouseOut="checkOnOut3('tdPontic2','fix_pontic','2')"><img src="../resource/images/eorder/fix/fix_pontic2.gif" width="32" height="32" /></td>
                      <td width="36" height="36" align="center" id="tdPontic3"
                      onclick="setTdMethodValue('fix_pontic','3');"
                      onMouseOver="checkOnOver3('tdPontic3','fix_pontic','3')"
                      onMouseOut="checkOnOut3('tdPontic3','fix_pontic','3')"><img src="../resource/images/eorder/fix/fix_pontic3.gif" width="32" height="32" /></td>
                      <td width="36" height="36" align="center" id="tdPontic4"
                      onclick="setTdMethodValue('fix_pontic','4');"
                      onMouseOver="checkOnOver3('tdPontic4','fix_pontic','4')"
                      onMouseOut="checkOnOut3('tdPontic4','fix_pontic','4')"><img src="../resource/images/eorder/fix/fix_pontic4.gif" width="32" height="32" /></td>
                      <td width="36" height="36" align="center" id="tdPontic5"
                      onclick="setTdMethodValue('fix_pontic','5');"
                      onMouseOver="checkOnOver3('tdPontic5','fix_pontic','5')"
                      onMouseOut="checkOnOut3('tdPontic5','fix_pontic','5')"><img src="../resource/images/eorder/fix/fix_pontic5.gif" width="32" height="32" /></td>
                      <td align="center"><div id="divPontic5mm"><input type="text" name="fix_pontic_roottipmm" 
                        value="<?=$fix_pontic_roottipmm?>" style="width:30px" />
mm</div></td>
                    </tr>
                </table></td>
              </tr>
            <? if(($usertype=='ST' || $usertype=='MN' || $usertype=='AD') && 0){?>
              <tr>
                <td align="center">Box color</td>
                <td><table border="0" cellpadding="0" cellspacing="5">
                    <tr>
                      <td width="36" height="36" align="center" id="tdBoxBrown"
                      onclick="setTdMethodValue('fix_box','Brown');"
                      onMouseOver="checkOnOver3('tdBoxBrown','fix_box','Brown')"
                      onMouseOut="checkOnOut3('tdBoxBrown','fix_box','Brown')"><img src="../resource/images/eorder/fix/fix_boxBrown.gif" width="32" height="32" /></td>
                      <td width="36" height="36" align="center" id="tdBoxGreen"
                      onclick="setTdMethodValue('fix_box','Green');"
                      onMouseOver="checkOnOver3('tdBoxGreen','fix_box','Green')"
                      onMouseOut="checkOnOut3('tdBoxGreen','fix_box','Green')"><img src="../resource/images/eorder/fix/fix_boxGreen.gif" width="32" height="32" /></td>
                      <td width="36" height="36" align="center" id="tdBoxYellow"
                      onclick="setTdMethodValue('fix_box','Yellow');"
                      onMouseOver="checkOnOver3('tdBoxYellow','fix_box','Yellow')"
                      onMouseOut="checkOnOut3('tdBoxYellow','fix_box','Yellow')"><img src="../resource/images/eorder/fix/fix_boxYellow.gif" width="32" height="32" /></td>
                      <td width="36" height="36" align="center" id="tdBoxWhite"
                      onclick="setTdMethodValue('fix_box','White');"
                      onMouseOver="checkOnOver3('tdBoxWhite','fix_box','White')"
                      onMouseOut="checkOnOut3('tdBoxWhite','fix_box','White')"><img src="../resource/images/eorder/fix/fix_boxWhite.gif" width="32" height="32" /></td>
                      <td width="36" height="36" align="center" id="tdBoxBlue"
                      onclick="setTdMethodValue('fix_box','Blue');"
                      onMouseOver="checkOnOver3('tdBoxBlue','fix_box','Blue')"
                      onMouseOut="checkOnOut3('tdBoxBlue','fix_box','Blue')"><img src="../resource/images/eorder/fix/fix_boxBlue.gif" width="32" height="32" /></td>
                      <td width="36" height="36" align="center" id="tdBoxRed"
                      onclick="setTdMethodValue('fix_box','Red');"
                      onMouseOver="checkOnOver3('tdBoxRed','fix_box','Red')"
                      onMouseOut="checkOnOut3('tdBoxRed','fix_box','Red')"><img src="../resource/images/eorder/fix/fix_boxRed.gif" width="32" height="32" /></td>
                    </tr>
                </table></td>
              </tr>
              
              <? } ?>
            </table>
            <? include "../cfrontend/tbframe2f.php" ?>
    
	  <br />
	  <table border="0" cellpadding="0" cellspacing="0" background="../resource/images/eorder/teethbg.gif">
        <tr>
          <td width="300" height="192" align="right"><table width="100%" border="0" cellpadding="0" cellspacing="0">

            <tr>
              <td height="32" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectL'" onmouseout="this.className=''"
        		  onclick="fix_materialpopup(11)">
                    <tr>
                      <td width="100" align="center"><div id="DivFixMaterialSname11"></div></td>
                      <td width="32" height="32" align="center">11</td>
                      <td width="32"><img src="../resource/images/eorder/fix/t_uppergray.gif" width="32" height="32" id="ImgFixMaterial11" /></td>
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
        		  onclick="fix_materialpopup(12)">
                    <tr>
                      <td width="100" align="center"><div id="DivFixMaterialSname12"></div></td>
                      <td width="32" height="32" align="center">12</td>
                      <td width="32"><img id = "ImgFixMaterial12" src="../resource/images/eorder/fix/t_uppergray.gif" width="32" height="32" /></td>
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
        		  onclick="fix_materialpopup(13)">
                    <tr>
                      <td width="100" align="center"><div id="DivFixMaterialSname13"></div></td>
                      <td width="32" height="32" align="center">13</td>
                      <td width="32"><img src="../resource/images/eorder/fix/t_uppergray.gif" name="ImgFixMaterial13" width="32" height="32" id="ImgFixMaterial13" /></td>
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
        		  onclick="fix_materialpopup(14)">
                    <tr>
                      <td width="100" align="center"><div id="DivFixMaterialSname14"></div></td>
                      <td width="32" height="32" align="center">14</td>
                      <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial14" width="32" height="32" id="ImgFixMaterial14" /></td>
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
        		  onclick="fix_materialpopup(15)">
                <tr>
                  <td width="100" align="center"><div id="DivFixMaterialSname15"></div></td>
                  <td width="32" align="center">15</td>
                  <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial15" width="32" height="32" id="ImgFixMaterial15" /></td>
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
        		  onclick="fix_materialpopup(16)">
                    <tr>
                      <td width="100" align="center"><div id="DivFixMaterialSname16"></div></td>
                      <td width="32" height="32" align="center">16</td>
                      <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial16" width="32" height="32" id="ImgFixMaterial16" /></td>
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
        		  onclick="fix_materialpopup(17)">
                    <tr>
                      <td width="100" align="center"><div id="DivFixMaterialSname17"></div></td>
                      <td width="32" height="32" align="center">17</td>
                      <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial17" width="32" height="32" id="ImgFixMaterial17" /></td>
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
        		  onclick="fix_materialpopup(18)">
                    <tr>
                      <td width="100" align="center"><div id="DivFixMaterialSname18"></div></td>
                      <td width="32" height="32" align="center">18</td>
                      <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial18" width="32" height="32" id="ImgFixMaterial18" /></td>
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
        		  onclick="fix_materialpopup(21)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_uppergray.gif" name="ImgFixMaterial21" width="32" height="32" id="ImgFixMaterial21" /></td>
                        <td width="32" align="center">21</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname21"></div></td>
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
        		  onclick="fix_materialpopup(22)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_uppergray.gif" name="ImgFixMaterial22" width="32" height="32" id="ImgFixMaterial22" /></td>
                        <td width="32" align="center">22</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname22"></div></td>
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
        		  onclick="fix_materialpopup(23)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_uppergray.gif" name="ImgFixMaterial23" width="32" height="32" id="ImgFixMaterial23" /></td>
                        <td width="32" align="center">23</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname23"></div></td>
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
        		  onclick="fix_materialpopup(24)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial24" width="32" height="32" id="ImgFixMaterial24" /></td>
                        <td width="32" align="center">24</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname24"></div></td>
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
        		  onclick="fix_materialpopup(25)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial25" width="32" height="32" id="ImgFixMaterial25" /></td>
                        <td width="32" align="center">25</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname25"></div></td>
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
        		  onclick="fix_materialpopup(26)">
                    <tr>
                      <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial26" width="32" height="32" id="ImgFixMaterial26" /></td>
                      <td width="32" align="center">26</td>
                      <td width="100" height="32" align="center"><div id="DivFixMaterialSname26"></div></td>
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
        		  onclick="fix_materialpopup(27)">
                    <tr>
                      <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial27" width="32" height="32" id="ImgFixMaterial27" /></td>
                      <td width="32" align="center">27</td>
                      <td width="100" height="32" align="center"><div id="DivFixMaterialSname27"></div></td>
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
        		  onclick="fix_materialpopup(28)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial28" width="32" height="32" id="ImgFixMaterial28" /></td>
                        <td width="32" align="center">28</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname28"></div></td>
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
        		  onclick="fix_materialpopup(48)">
                      <tr>
                        <td width="100" align="center"><div id="DivFixMaterialSname48"></div></td>
                        <td width="32" height="32" align="center">48</td>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial48" width="32" height="32" id="ImgFixMaterial48" /></td>
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
        		  onclick="fix_materialpopup(47)">
                      <tr>
                        <td width="100" align="center"><div id="DivFixMaterialSname47"></div></td>
                        <td width="32" height="32" align="center">47</td>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial47" width="32" height="32" id="ImgFixMaterial47" /></td>
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
        		  onclick="fix_materialpopup(46)">
                      <tr>
                        <td width="100" align="center"><div id="DivFixMaterialSname46"></div></td>
                        <td width="32" height="32" align="center">46</td>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial46" width="32" height="32" id="ImgFixMaterial46" /></td>
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
        		  onclick="fix_materialpopup(45)">
                      <tr>
                        <td width="100" align="center"><div id="DivFixMaterialSname45"></div></td>
                        <td width="32" align="center">45</td>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial45" width="32" height="32" id="ImgFixMaterial45" /></td>
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
        		  onclick="fix_materialpopup(44)">
                      <tr>
                        <td width="100" align="center"><div id="DivFixMaterialSname44"></div></td>
                        <td width="32" height="32" align="center">44</td>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial44" width="32" height="32" id="ImgFixMaterial44" /></td>
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
        		  onclick="fix_materialpopup(43)">
                      <tr>
                        <td width="100" align="center"><div id="DivFixMaterialSname43"></div></td>
                        <td width="32" height="32" align="center">43</td>
                        <td width="32"><img src="../resource/images/eorder/fix/t_lowergray.gif" name="ImgFixMaterial43" width="32" height="32" id="ImgFixMaterial43" /></td>
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
        		  onclick="fix_materialpopup(42)">
                      <tr>
                        <td width="100" align="center"><div id="DivFixMaterialSname42"></div></td>
                        <td width="32" height="32" align="center">42</td>
                        <td width="32"><img src="../resource/images/eorder/fix/t_lowergray.gif" name="ImgFixMaterial42" width="32" height="32" id="ImgFixMaterial42" /></td>
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
        		  onclick="fix_materialpopup(41)">
                      <tr>
                        <td width="100" align="center"><div id="DivFixMaterialSname41"></div></td>
                        <td width="32" height="32" align="center">41</td>
                        <td width="32"><img src="../resource/images/eorder/fix/t_lowergray.gif" name="ImgFixMaterial41" width="32" height="32" id="ImgFixMaterial41" /></td>
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
        		  onclick="fix_materialpopup(38)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial38" width="32" height="32" id="ImgFixMaterial38" /></td>
                        <td width="32" align="center">38</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname38"></div></td>
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
        		  onclick="fix_materialpopup(37)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial37" width="32" height="32" id="ImgFixMaterial37" /></td>
                        <td width="32" align="center">37</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname37"></div></td>
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
        		  onclick="fix_materialpopup(36)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial36" width="32" height="32" id="ImgFixMaterial36" /></td>
                        <td width="32" align="center">36</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname36"></div></td>
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
        		  onclick="fix_materialpopup(35)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial35" width="32" height="32" id="ImgFixMaterial35" /></td>
                        <td width="32" align="center">35</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname35"></div></td>
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
        		  onclick="fix_materialpopup(34)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_middlegray.gif" name="ImgFixMaterial34" width="32" height="32" id="ImgFixMaterial34" /></td>
                        <td width="32" align="center">34</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname34"></div></td>
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
        		  onclick="fix_materialpopup(33)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_lowergray.gif" name="ImgFixMaterial33" width="32" height="32" id="ImgFixMaterial33" /></td>
                        <td width="32" align="center">33</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname33"></div></td>
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
        		  onclick="fix_materialpopup(32)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_lowergray.gif" name="ImgFixMaterial32" width="32" height="32" id="ImgFixMaterial32" /></td>
                        <td width="32" align="center">32</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname32"></div></td>
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
        		  onclick="fix_materialpopup(31)">
                      <tr>
                        <td width="32"><img src="../resource/images/eorder/fix/t_lowergray.gif" name="ImgFixMaterial31" width="32" height="32" id="ImgFixMaterial31" /></td>
                        <td width="32" align="center">31</td>
                        <td width="100" height="32" align="center"><div id="DivFixMaterialSname31"></div></td>
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

      
      <table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td rowspan="2" valign="top"><? include "../cfrontend/tbframe2h.php" ?><span class="style1" style="font-weight: bold">Shade</span><br />
            <div align="center">
                    <img src="../resource/images/eorder/preview/preview.gif" width="280" height="147" />            </div>
            <table align="center" cellpadding="3" cellspacing="2" >
        <tr>
          <td>Shade[S1] </td>
          <td width="200" align="center" class="tdButtonOnOut" id="TDShadeTextfix0"
        onclick="OpenShadeSelector('fix',0,-1);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"></td>
        </tr>
        <tr>
          <td>Shade[S2]</td>
          <td width="200" align="center" class="tdButtonOnOut" id="TDShadeTextfix1"
        onclick="OpenShadeSelector('fix',1,-1);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"></td>
        </tr>
        <tr>
          <td>Shade[S3]</td>
          <td width="200" align="center" class="tdButtonOnOut" id="TDShadeTextfix2"
        onclick="OpenShadeSelector('fix',2,-1);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"></td>
        </tr>
        <!-- tr>
          <td>Shade[S4]</td>
          <td width="200" align="center" class="tdButtonOnOut" id="TDShadeTextfix3"
        onclick="OpenShadeSelector('fix',3,-1);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"></td>
        </tr -->
      </table>
      <br />
      <? include "../cfrontend/tbframe2f.php" ?></td>
    <td width="250" valign="top"><? include "../cfrontend/tbframe2h.php" ?>
      <span style="font-weight: bold"><span class="style1">Option</span><br />
      </span> <br />
      <table width="120" border="0" cellpadding="2" cellspacing="1" bgcolor="#999999">
        <tr>
          <td height="30" align="center" class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OpenDivAttachmentSelector('fix');"><table width="100%">
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
    <td valign="top"><? include "../cfrontend/tbframe2h.php" ?>
      <span style="font-weight: bold">SHADE Option<br />
      </span> <br />
      <!-- table width="" border="0" cellpadding="2" cellspacing="1" bgcolor="">

         <tr>
        	<td><label><input  type="checkbox" value="Translucent"  onclick="setValue('fix_shadeoption[Translucent]',this.checked+0);" <?=array_key_exists ('Translucent', $fix_shadeoption)?" checked":" "?>/>Translucent</label></td>
            </tr>
         <tr>
         <tr>
        	<td><label><input  type="checkbox" value="Translucent Gray"  onclick="setValue('fix_shadeoption[Translucent Gray]',this.checked+0);" <?=array_key_exists ('Translucent Gray', $fix_shadeoption)?" checked":" "?>/>Translucent Gray</label></td>
            </tr>
         <tr>
        	<td><label><input  type="checkbox" value="Translucent White"  onclick="setValue('fix_shadeoption[Translucent White]',this.checked+0);" <?=array_key_exists ('Translucent White', $fix_shadeoption)?" checked":" "?>/>Translucent White</label></td>
            </tr>
         <tr>
        	<td><label><input  type="checkbox" value="Translucent Blue"  onclick="setValue('fix_shadeoption[Translucent Blue]',this.checked+0);" <?=array_key_exists ('Translucent Blue', $fix_shadeoption)?" checked":" "?>/>Translucent Blue</label></td>
            </tr>
         <tr>
        	<td><label><input  type="checkbox" value="Translucent Yellow"  onclick="setValue('fix_shadeoption[Translucent Yellow]',this.checked+0);" <?=array_key_exists ('Translucent Yellow', $fix_shadeoption)?" checked":" "?>/>Translucent Yellow</label></td>
            </tr>
         <tr>
        	<td><label><input type="checkbox" value="Translucent Orange"  onclick="setValue('fix_shadeoption[Translucent Orange]',this.checked+0);" <?=array_key_exists ('Translucent Orange', $fix_shadeoption)?" checked":" "?>/>Translucent Orange</label></td>
            </tr>
         <tr>
        	<td><label><input type="checkbox" value="Translucent Brown"  onclick="setValue('fix_shadeoption[Translucent Brown]',this.checked+0);" <?=array_key_exists ('Translucent Brown', $fix_shadeoption)?" checked":" "?>/>Translucent Brown</label></td>
            </tr>
         <tr>
        	<td><label><input name="shadeoptionradio" type="checkbox" value="Transparent"  onclick="setValue('fix_shadeoption[Transparent]',this.checked+0);" <?=array_key_exists ('Transparent', $fix_shadeoption)?" checked='checked'":" "?>/>Transparent</label></td>
            </tr>
         <tr>
        	<td><label><input  type="checkbox" value="CrackLines"  onclick="setValue('fix_shadeoption[CrackLines]',this.checked+0);" <?=array_key_exists ('CrackLines', $fix_shadeoption)?" checked":" "?>/>CrackLines</label></td>
            </tr>
         <tr>
        	<td><label><input  type="checkbox" value="Infraction Line"  onclick="setValue('fix_shadeoption[Infraction Line]',this.checked+0);" <?=array_key_exists ('Infraction Line', $fix_shadeoption)?" checked":" "?>/>InfractionLine</label></td>
            </tr>
      </table -->
      
<table width="" border="0" cellpadding="2" cellspacing="1" bgcolor="">

         <tr>
        	<td><label><input  type="checkbox" value="Translucent"  onclick="setValue('fix_shadeoption[Translucent]',this.checked+0);" <?=array_key_exists ('Translucent', $fix_shadeoption)?" checked":" "?>/>Translucent</label></td>
            </tr>
         <tr>
        	<td><label><input name="shadeoptionradio" type="checkbox" value="Transparent"  onclick="setValue('fix_shadeoption[Transparent]',this.checked+0);" <?=array_key_exists ('Transparent', $fix_shadeoption)?" checked='checked'":" "?>/>Transparent</label></td>
            </tr>
         <tr>
        	<td><label><input  type="checkbox" value="CrackLines"  onclick="setValue('fix_shadeoption[CrackLines]',this.checked+0);" <?=array_key_exists ('CrackLines', $fix_shadeoption)?" checked":" "?>/>CrackLines</label></td>
            </tr>
         <!--tr>
        	<td><label><input  type="checkbox" value="Whitespot"  onclick="setValue('fix_shadeoption[Whitespot]',this.checked+0);" <?=array_key_exists ('Whitespot', $fix_shadeoption)?" checked":" "?>/>Whitespot</label></td>
            </tr -->
         <tr>
           <td>&nbsp;</td>
         </tr>
      </table>      
      
      
      
      <? include "../cfrontend/tbframe2f.php" ?>
    </td>
  </tr>
  <tr>
    <td colspan="2"><? include "../cfrontend/tbframe2h.php" ?>
      <span style="font-weight: bold"><span class="style1">observation</span><br />
      </span> <br />
      <textarea name="fix_observation" id="fix_observation" style="width:550px;height:150px"><?=$fix_observation?></textarea><? include "../cfrontend/tbframe2f.php" ?></td>
  </tr>
</table></td>
  <td align="center" valign="top"><div style="width:290px"><? include "../cfrontend/tbframe2h.php" ?>
<table width="100%" border="0" cellspacing="0" cellpadding="2">
  <tr>
  <!-- After Add Product Goto Add Line 1251-->
    <td align="left" ><span class="style1"><strong>Alloy</strong></span></td>
    </tr>
  <tr>
    <td align="center" ><table border="0" cellpadding="0" cellspacing="0" class="Normal">
          <tr>
            <td width="170" height="25" align="left" id = "tdAlloyNone" style="padding-left:10px"
                     onclick="setTdMethodValue('fix_alloy',1);"
                     onmouseover="checkOnOver2('tdAlloyNone','fix_alloy',1)"
                     onmouseout="checkOnOut2('tdAlloyNone','fix_alloy',1)">None</td>
          </tr>
          <tr>
            <td width="170" height="25" align="left" id = "tdAlloyNonPrecious" style="padding-left:10px"
                     onclick="setTdMethodValue('fix_alloy',2);"
                     onmouseover="checkOnOver2('tdAlloyNonPrecious','fix_alloy',2)"
                     onmouseout="checkOnOut2('tdAlloyNonPrecious','fix_alloy',2)">Non precious</td>
          </tr>
          <tr>
            <td width="170" height="25" align="left" id = "tdAlloyNoneNickel" style="padding-left:10px"
                     onclick="setTdMethodValue('fix_alloy',3);"
                     onmouseover="checkOnOver2('tdAlloyNoneNickel','fix_alloy',3)"
                     onmouseout="checkOnOut2('tdAlloyNoneNickel','fix_alloy',3)">Non nickel </td>
          </tr>
          <tr>
            <td width="170" height="25" align="left" id = "tdAlloyPreciousPalladium" style="padding-left:10px"
                     onclick="setTdMethodValue('fix_alloy',4);"
                     onmouseover="checkOnOver2('tdAlloyPreciousPalladium','fix_alloy',4)"
                     onmouseout="checkOnOut2('tdAlloyPreciousPalladium','fix_alloy',4)"> Palladium </td>
          </tr>
          <tr>
            <td width="170" height="25" align="left" id="tdAlloyPreciousSemiPrecious" style="padding-left:10px"
                     onclick="setTdMethodValue('fix_alloy',5);"
                     onmouseover="checkOnOver2('tdAlloyPreciousSemiPrecious','fix_alloy',5)"
                     onmouseout="checkOnOut2('tdAlloyPreciousSemiPrecious','fix_alloy',5)"> Semi-precious</td>
          </tr>
          <tr>
            <td width="170" height="25" align="left" id="tdAlloyPreciousWhiteGold" style="padding-left:10px"
                     onclick="setTdMethodValue('fix_alloy',6);"
                     onmouseover="checkOnOver2('tdAlloyPreciousWhiteGold','fix_alloy',6)"
                     onmouseout="checkOnOut2('tdAlloyPreciousWhiteGold','fix_alloy',6)">White - Gold </td>
          </tr>
          <tr>
            <td width="170" height="25" align="left" id="tdAlloyPreciousYellowGold" style="padding-left:10px;"
                     onclick="setTdMethodValue('fix_alloy',7);"
                     onmouseover="checkOnOver2('tdAlloyPreciousYellowGold','fix_alloy',7)"
                     onmouseout="checkOnOut2('tdAlloyPreciousYellowGold','fix_alloy',7)">Yellow - Gold</td>
          </tr>
		  <tr>
            <td width="170" height="25" align="left" id="tdAlloyPreciousHighYellowGold" style="padding-left:10px;"
                     onclick="setTdMethodValue('fix_alloy',8);"
                     onmouseover="checkOnOver2('tdAlloyPreciousHighYellowGold','fix_alloy',8)"
                     onmouseout="checkOnOut2('tdAlloyPreciousHighYellowGold','fix_alloy',8)">High Yellow - Gold</td>
          </tr>
        </table></td>
    </tr>
</table><? include "../cfrontend/tbframe2f.php" ?>
 </div>
  <div style="width:290px">

  <? include("../eorder/eorder_fix_option.php");?></div>
  
  </td>
</tr>
<tr>
  <td valign="top" >&nbsp;</td>
  <td align="right" valign="top"><a href="#TOP">Goto top</a></td>
</tr>
</table>
<? include "../cfrontend/tbframef.php"?>
</td></tr></table>
<?php
//echo $name[0] . " ".$image[0]." ".$idvalue[0]." ".$description[0];
?>
<script>
var fix_materialpopup_select;
var fix_materialpopup_material;
function fix_materialpopup(teethnumber)
{
	fix_materialpopup_select = teethnumber;
	//Sample : เปิดหน้าต่างเลือก ชนิดฟัน  FixMaterialSelector
	alloy = getValue('fix_alloy')
	if(alloy==0){
		showAlert("SelectTOW");
		return;
	}
	activeBG();
	// Mask for Use Alloy

	/*findObj("FixMaterialSelector_ID2").style.textDecoration  = alloy>1?"":"line-through";
	findObj("FixMaterialSelector_ID5").style.textDecoration = alloy>1?"":"line-through";
	findObj("FixMaterialSelector_ID8").style.textDecoration = alloy>1?"":"line-through";
	findObj("FixMaterialSelector_ID11").style.textDecoration = alloy>1?"":"line-through";
	findObj("FixMaterialSelector_ID14").style.textDecoration = alloy>1?"":"line-through";
	findObj("FixMaterialSelector_ID17").style.textDecoration = alloy>1?"":"line-through";
	findObj("FixMaterialSelector_ID23").style.textDecoration = alloy>1?"":"line-through";
	findObj("FixMaterialSelector_ID20").style.textDecoration = alloy>1?"":"line-through";//*/
	//

	makeCenterScreen('FixMaterialSelector');
	showHideLayers('FixMaterialSelector','','show');
}
function fix_materialclose()
{
	hideBG();
	showHideLayers('FixMaterialSelector','','hide');
}

function fix_material_setvalue(number,value,isPopOption)
{
	var sname='';
	var img='';
	//var conf_no = con_no;
	setValue('fix_material['+number+']',value);
	fix_materialpopup_material = value;
	fix_materialclose();
	//var sname='';
	switch(value){
	<? for($i=0;$i<count($fixmaterial_name);$i++){?>
		case '<?=$fixmaterial_idvalue[$i]?>':
			sname = '<?=$fixmaterial_shortname[$i]?>';
			img = '<?=$fixmaterial_image[$i]?>';
			if(isPopOption){
				<? 
				if(isset($fixmaterial_optiononselect[$i])){
					echo $fixmaterial_optiononselect[$i];
				}else{?>
					fix_material_setoptionvalue(number,0);
				<? } ?>
				ReCalculateSummary('DivInvoiceResult');
			}
			break;
	<? }?> 
	}
	writeit('DivFixMaterialSname'+number,sname);
	findObj('ImgFixMaterial'+number).src = '<?=$fixmaterial_imagepath?>'+img;
	
	
}
function checkOnOut(tdid,valueid,value){
	if(findObj(valueid).value==value){
		findObj(tdid).className='tdMethodOnSelect';
	}else{
		findObj(tdid).className='';
	}
}

function checkOnOver(tdid,valueid,value){
	if(findObj(valueid).value==value){
		findObj(tdid).className='tdMethodOnSelect';
	}else{
		findObj(tdid).className='tdMethodOnHiLight';
	}
}
function checkOnOut2(tdid,valueid,value){
	if(findObj(valueid).value==value){
		findObj(tdid).className='tdAlloyOnSelect';
	}else{
		findObj(tdid).className='';
	}
}

function checkOnOver2(tdid,valueid,value){
	if(findObj(valueid).value==value){
		findObj(tdid).className='tdAlloyOnSelect';
	}else{
		findObj(tdid).className='tdAlloyOnHiLight';
	}
}
function checkOnOut3(tdid,valueid,value){
	if(findObj(valueid).value==value){
		findObj(tdid).className='tdPonticOnSelect';
	}else{
		findObj(tdid).className='';
	}
}

function checkOnOver3(tdid,valueid,value){
	if(findObj(valueid).value==value){
		findObj(tdid).className='tdPonticOnSelect';
	}else{
		findObj(tdid).className='tdPonticOnHiLight';
	}
}
function setTdMethodValue(valueid,value){
	setValue(valueid,value);
	if(valueid == "fix_method"){
		findObj('tdTry-in').className=(value=='Try-in'?'tdMethodOnSelect':'');
		findObj('tdContour').className=(value=='Contour'?'tdMethodOnSelect':'');
		findObj('tdFinish').className=(value=='Finish'?'tdMethodOnSelect':'');
		findObj('tdRepair').className=(value=='Repair'?'tdMethodOnSelect':'');
		findObj('tdRemake').className=(value=='Remake'?'tdMethodOnSelect':'');
		findObj('tdFinishTry-in').className=(value=='Finish after Try-in'?'tdAlloyOnSelect':'');
		findObj('tdRemakeFinish').className=(value=='Remake & Finish'?'tdAlloyOnSelect':'');
	}else if(valueid == "remove_method"){
		findObj('tdRemoveTry-in').className=(value=='Try-in'?'tdMethodOnSelect':'');
		findObj('tdRemoveContour').className=(value=='Contour'?'tdMethodOnSelect':'');
		findObj('tdRemoveFinish').className=(value=='Finish'?'tdMethodOnSelect':'');
		findObj('tdRemoveRepair').className=(value=='Repair'?'tdMethodOnSelect':'');
	}else if(valueid == "fix_alloy"){
		findObj('tdAlloyNone').className=(value=='1'?'tdAlloyOnSelect':'');
		findObj('tdAlloyNoneNickel').className=(value=='2'?'tdAlloyOnSelect':'');
		findObj('tdAlloyPreciousPalladium').className=(value=='3'?'tdAlloyOnSelect':'');
		findObj('tdAlloyPreciousSemiPrecious').className=(value=='4'?'tdAlloyOnSelect':'');
		findObj('tdAlloyPreciousWhiteGold').className=(value=='5'?'tdAlloyOnSelect':'');
		findObj('tdAlloyPreciousYellowGold').className=(value=='6'?'tdAlloyOnSelect':'');
    findObj('tdAlloyPreciousHighYellowGold').className=(value=='7'?'tdAlloyOnSelect':'');

	}else if(valueid == "fix_embrasure"){
		findObj('tdEmbNone').className=(value=='None'?'tdMethodOnSelect':'');
		findObj('tdEmbOpen').className=(value=='Open'?'tdMethodOnSelect':'');
		findObj('tdEmbClose').className=(value=='Close'?'tdMethodOnSelect':'');
	}else if(valueid == "fix_pontic"){
		findObj('tdPontic0').className=(value=='0'?'tdPonticOnSelect':'');
		findObj('tdPontic1').className=(value=='1'?'tdPonticOnSelect':'');
		findObj('tdPontic2').className=(value=='2'?'tdPonticOnSelect':'');
		findObj('tdPontic3').className=(value=='3'?'tdPonticOnSelect':'');
		findObj('tdPontic4').className=(value=='4'?'tdPonticOnSelect':'');
		findObj('tdPontic5').className=(value=='5'?'tdPonticOnSelect':'');
		findObj('divPontic5mm').style.display=(value=='5'?'inline':'none');
		
	}else if(valueid == "fix_box"){
		/*findObj('tdBoxBrown').className		=(value=='Brown'?'tdPonticOnSelect':'');
		findObj('tdBoxGreen').className		=(value=='Green'?'tdPonticOnSelect':'');
		findObj('tdBoxYellow').className	=(value=='Yellow'?'tdPonticOnSelect':'');
		findObj('tdBoxWhite').className		=(value=='White'?'tdPonticOnSelect':'');
		findObj('tdBoxBlue').className		=(value=='Blue'?'tdPonticOnSelect':'');
		findObj('tdBoxRed').className		=(value=='Red'?'tdPonticOnSelect':'');*/
	}else if(valueid == "ortho_method"){
		//findObj('tdOrthoTry-in').className=(value=='Try-in'?'tdMethodOnSelect':'');
		//findObj('tdOrthoContour').className=(value=='Contour'?'tdMethodOnSelect':'');
		findObj('tdOrthoFinish').className=(value=='Finish'?'tdMethodOnSelect':'');
		findObj('tdOrthoRepair').className=(value=='Repair'?'tdMethodOnSelect':'');
		findObj('tdOrthoRemake').className=(value=='Remake'?'tdMethodOnSelect':'');
	}
	
}
</script>
<script>showHideLayers('FixMaterialSelector','','hide');</script>
<script>showHideLayers('DivFixOptionMaterial','','hide');</script>
