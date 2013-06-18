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

<?php include_once "../eorder/eorder_ortho_config.php" ?>

<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<a name="OrthoAnchor" id="OrthoAnchor"></a>
<table cellpadding="0" cellspacing="0">
  <tr><td width="20"></td><td width="930">
<? $tbframeheader = "Ortho order detail"?>
<? $tbframehscript='<a href="#TOP">Goto top</a>' ?>
<? include "../cfrontend/tbframeh.php"?>
<br />
<table border="0" cellpadding="2" cellspacing="1">
<tr>
	<td valign="top" ><? include "../cfrontend/tbframe2h.php" ?>
            <span style="font-weight: bold">Detail<br />
            </span> <br />
            <table border="0" cellpadding="2" cellspacing="1">
              <tr>
                <td width="80" align="center" >Method</td>
                <td align="center" ><table border="0" cellpadding="0" cellspacing="5" width="100%">
                  <tr>
                    <!--td width="60" height="25" align="center" bgcolor="" 
                    id = "tdOrthoTry-in"
                    onclick="setTdMethodValue('ortho_method','Try-in');"
                    onMouseOver="checkOnOver('tdOrthoTry-in','ortho_method','Try-in')"
                    onMouseOut="checkOnOut('tdOrthoTry-in','ortho_method','Try-in')">
                      Try-in</td>
                    <td width="60" height="25" align="center"  id = "tdOrthoContour"
                    onclick="setTdMethodValue('ortho_method','Contour');"
                    onMouseOver="checkOnOver('tdOrthoContour','ortho_method','Contour')"
                    onMouseOut="checkOnOut('tdOrthoContour','ortho_method','Contour')">
                      Contour</td!-->
                    <td width="60" height="25" align="center"  id = "tdOrthoFinish"
                    onclick="setTdMethodValue('ortho_method','Finish');"
                    onMouseOver="checkOnOver('tdOrthoFinish','ortho_method','Finish')"
                    onMouseOut="checkOnOut('tdOrthoFinish','ortho_method','Finish')">
                      Finish</td>
                    <td width="60" height="25" align="center"  id = "tdOrthoRepair"
                    onclick="setTdMethodValue('ortho_method','Repair');"
                    onMouseOver="checkOnOver('tdOrthoRepair','ortho_method','Repair')"
                    onMouseOut="checkOnOut('tdOrthoRepair','ortho_method','Repair')">
                      Repair</td>
                    <td width="60" height="25" align="center"  id = "tdOrthoRemake"
                    onclick="setTdMethodValue('ortho_method','Remake');"
                    onMouseOver="checkOnOver('tdOrthoRemake','ortho_method','Remake')"
                    onMouseOut="checkOnOut('tdOrthoRemake','ortho_method','Remake')">
                      Remake</td>
                  </tr>
                </table></td>
              </tr>
            </table>
             <span style="font-weight: bold"><br />
             Work 
            <select name="ortho_work" id="ortho_work">
				<? foreach($ortho_work_conf as $key => $work){ ?>
                <option value="<?=$key?>" <?=$ortho_work==$key?'selected="selected"':''?>><?=$work?></option>
                <? } ?>
             </select>
             <br />
              Work Upper
            <select name="ortho_workupper" id="ortho_workupper">
				<? foreach($ortho_workupper_conf as $key => $work){ ?>
                <option value="<?=$key?>" <?=$ortho_workupper==$key?'selected="selected"':''?>><?=$work?></option>
                <? } ?>
             </select>
             <br />
              Work Lower
            <select name="ortho_worklower" id="ortho_worklower">
				<? foreach($ortho_worklower_conf as $key => $work){ ?>
                <option value="<?=$key?>" <?=$ortho_worklower==$key?'selected="selected"':''?>><?=$work?></option>
                <? } ?>
             </select>
             <br />
            </span> <br />
            <br />
            <? include "../cfrontend/tbframe2f.php" ?>
    
	  <br />
	  <br />

      
      <table border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td valign="top"><? include "../cfrontend/tbframe2h.php" ?><span style="font-weight: bold">Color</span><br />
    	<textarea name="ortho_shade" id="ortho_shade"><?=$ortho_shade?></textarea>
            <!--div align="center">
                    <img src="../resource/images/eorder/preview/preview.gif" width="280" height="147" />            </div>
            <table align="center" cellpadding="3" cellspacing="2" >
        <tr>
          <td>Shade[S1] </td>
          <td width="200" align="center" class="tdButtonOnOut" id="TDShadeTextortho0"
        onclick="OpenShadeSelector('ortho',0,-1);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"></td>
        </tr>
        <tr>
          <td>Shade[S2]</td>
          <td width="200" align="center" class="tdButtonOnOut" id="TDShadeTextortho1"
        onclick="OpenShadeSelector('ortho',1,-1);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"></td>
        </tr>
        <tr>
          <td>Shade[S3]</td>
          <td width="200" align="center" class="tdButtonOnOut" id="TDShadeTextortho2"
        onclick="OpenShadeSelector('ortho',2,-1);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"></td>
        </tr>
        <tr>
          <td>Shade[S4]</td>
          <td width="200" align="center" class="tdButtonOnOut" id="TDShadeTextortho3"
        onclick="OpenShadeSelector('ortho',3,-1);" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"></td>
        </tr>
      </table!-->
      <br />
      <? include "../cfrontend/tbframe2f.php" ?></td>
    <td width="250" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><? include "../cfrontend/tbframe2h.php" ?>
      <span style="font-weight: bold">observation<br />
      </span> <br />
      <textarea name="ortho_observation" id="ortho_observation" style="width:550px;height:150px"><?=$ortho_observation?></textarea><? include "../cfrontend/tbframe2f.php" ?></td>
  </tr>
</table></td>
    <td align="center" valign="top">&nbsp;</td>
</tr>
<tr>
  <td valign="top" >&nbsp;</td>
  <td align="right" valign="top"><a href="#TOP">Goto top</a></td>
</tr>
</table>
<? include "../cfrontend/tbframef.php"?>
</td></tr></table>



