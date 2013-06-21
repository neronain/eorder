<?
	$patientname = $_POST["patientname"];


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Hexaceram - eOrder</title>
<link href="../resource/css/eorder.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/eorder/func_main.js" type="text/javascript"></script>

<link href="../SpryAssets/SpryTabbedPanels.css" rel="stylesheet" type="text/css" />
<script src="../resource/javascript/jquery-1.9.1.min.js"></script>
</head>

<body leftmargin="8" topmargin="8" marginwidth="8" marginheight="8">

<div id="backgroundLayer" style="position:absolute;left:0;top:0;width:100;height:100;visibility:hidden;background-color:#FFFFFF;z-index:0;filter: alpha(opacity=80, style=0); "></div>
<script>activeBG();</script>
<script src="../resource/javascript/eorder/func_fix.js" type="text/javascript"></script>
<script src="../resource/javascript/eorder/func_remove.js" type="text/javascript"></script>
<script src="../resource/javascript/eorder/html_teeth_image.js" type="text/javascript"></script>
<script src="../resource/javascript/eorder/variable_fix.js" type="text/javascript"></script>
<script src="../resource/javascript/eorder/variable_remove.js" type="text/javascript"></script>
<script src="../SpryAssets/SpryTabbedPanels.js" type="text/javascript"></script>


<? /*Select Material Layer*/ include "eorder_fixmaterial.php";	?>
<? /*Select Material Layer*/ include "eorder_removetype.php";	?>
<? /*Select Material Layer*/ include "eorder_removematerial.php";	?>
<? /*Select Shade Layer*/ 	include "eorder_shade.php";			?>

<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
    <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
    <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
  </tr>
  <tr>
    <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
    <td>
      
      <table width="100%" border="0" cellspacing="0" cellpadding="4">
        <tr>
          <td colspan="4" align="center" bgcolor="#000066" style="font-size:16px"  class="TBHead">Order Info</td>
        </tr>
        <tr>
          <td><h4>Doctor</h4></td>
          <td><h4>&nbsp;</h4></td>
          <td><h4>Patient : <?=$patientname?></h4></td>
          <td><h4>&nbsp;</h4></td>
        </tr>
        <tr>
          <td><h4>Date</h4></td>
          <td><h4>&nbsp;</h4></td>
          <td><h4>Finish-date</h4></td>
          <td><h4>&nbsp;</h4></td>
        </tr>
      </table>    </td>
    <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
  </tr>
  <tr>
    <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
    <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
    <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
  </tr>
</table>
<br />
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#333333">
  <tr>
    <td bgcolor="#FFFFFF">
      
      <table width="100%" border="0" cellspacing="0" cellpadding="2">
        <tr>
          <td width="70" align="right"  class="TBHead2" >select -&gt;</td>
          <td width="20" align="left" class="TBHead2" ><span class="TBHead" style="font-size:16px">
            <input type="checkbox" name="checkbox" id="checkbox" onclick="SetFixOrder(this.checked);" />
          </span></td>
          <td  style="font-size:16px"  class="TBHead2">
          Fix order</td>
        </tr>
      </table>
<div align="center" id="FixSelectType">
<table border="0" align="center" cellpadding="0" cellspacing="0" bgcolor="FFFFFF"  id="FixMethodTypeTB">
  <tr>
    <td height="2" bgcolor="#FFFFFF"></td>
    </tr>
  <tr>
    <td width="10" height="10"><img src="../resource/images/eorder/panel/pn1.gif" width="10" height="10" /></td>
    <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
    <td width="10" height="10"><img src="../resource/images/eorder/panel/pn3.gif" width="10" height="10" /></td>
  </tr>
  <tr>
    <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
    <td height="20"  align="center">
    <table><tr><td><table>
      <tr>
        <td colspan="4"><table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="10" height="25" align="right"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
              <td align="center" background="../resource/images/eorder/panel/hd2.gif" class="TBHead">Select method</td>
              <td width="11" height="25" align="left"><img src="../resource/images/eorder/panel/hd3.gif" width="11" height="25" /></td>
            </tr>
                </table></td>
        </tr>
      <tr>
        <td align="center" id="FixMethodTypeTD1"   style="cursor:pointer" onclick="SetFixMethod(METHOD.TRYIN);">
        <img src="../resource/images/eorder/teeth/method/tryin.gif" width="56" height="37"  /><br /> Try-in</td>
        <td align="center" onclick="SetFixMethod(METHOD.CONTOUR);"   style="cursor:pointer" id="FixMethodTypeTD2">
        <img src="../resource/images/eorder/teeth/method/contour.gif" width="56" height="37" /><br /> Contour</td>
        <td align="center" onclick="SetFixMethod(METHOD.FINISH);"   style="cursor:pointer" id="FixMethodTypeTD3">
        <img src="../resource/images/eorder/teeth/method/finish.gif" width="56" height="37"  /><br /> Finish</td>
        <td align="center" onclick="SetFixMethod(METHOD.REPAIR);"   style="cursor:pointer" id="FixMethodTypeTD4">
        <img src="../resource/images/eorder/teeth/method/repair.gif" width="56" height="37"   /><br /> Repair</td>
        </tr>
      
    </table></td>
    </tr></table></td>
    <td background="../resource/images/eorder/panel/pn6.gif"></td>
  </tr>
  <tr>
    <td width="10" height="11"><img src="../resource/images/eorder/panel/pn7.gif" width="10" height="11" /></td>
    <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
    <td width="10" height="11"><img src="../resource/images/eorder/panel/pn9.gif" width="10" height="11" /></td>
  </tr>
</table>
</div>
<div id="MainFix">
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
    <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
    <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
  </tr>
  <tr>
    <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
    <td>
    
    
    <table border="0" align="center" cellpadding="2" cellspacing="0">
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage0"></div><script>RefreshFixTeethImage(0);</script></td>
    <td width="56" height="56"><div id="FixTeethImage8"></div><script>RefreshFixTeethImage(8);</script></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage1"></div><script>RefreshFixTeethImage(1);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage9"></div><script>RefreshFixTeethImage(9);</script></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage2"></div><script>RefreshFixTeethImage(2);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage10"></div><script>RefreshFixTeethImage(10);</script></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage3"></div><script>RefreshFixTeethImage(3);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage11"></div><script>RefreshFixTeethImage(11);</script></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage4"></div><script>RefreshFixTeethImage(4);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage12"></div><script>RefreshFixTeethImage(12);</script></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage5"></div><script>RefreshFixTeethImage(5);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage13"></div><script>RefreshFixTeethImage(13);</script></td>
  </tr>
  <tr>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage6"></div><script>RefreshFixTeethImage(6);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage14"></div><script>RefreshFixTeethImage(14);</script></td>
  </tr>
  <tr>
    <td width="56" height="56"><div id="FixTeethImage7"></div><script>RefreshFixTeethImage(7);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage15"></div><script>RefreshFixTeethImage(15);</script></td>
  </tr>
  <tr>
    <td width="56" height="56"><div id="FixTeethImage16"></div><script>RefreshFixTeethImage(16);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage24"></div><script>RefreshFixTeethImage(24);</script></td>
  </tr>
  <tr>
 	<td>&nbsp;</td>
   <td width="56" height="56"><div id="FixTeethImage17"></div><script>RefreshFixTeethImage(17);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage25"></div><script>RefreshFixTeethImage(25);</script></td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage18"></div><script>RefreshFixTeethImage(18);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage26"></div><script>RefreshFixTeethImage(26);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage19"></div><script>RefreshFixTeethImage(19);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage27"></div><script>RefreshFixTeethImage(27);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
 	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
   <td width="56" height="56"><div id="FixTeethImage20"></div><script>RefreshFixTeethImage(20);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage28"></div><script>RefreshFixTeethImage(28);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage21"></div><script>RefreshFixTeethImage(21);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage29"></div><script>RefreshFixTeethImage(29);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage22"></div><script>RefreshFixTeethImage(22);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage30"></div><script>RefreshFixTeethImage(30);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
  <tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
    <td width="56" height="56"><div id="FixTeethImage23"></div><script>RefreshFixTeethImage(23);</script></td>
    <td width="56" height="56"><div id="FixTeethImage31"></div><script>RefreshFixTeethImage(31);</script></td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
  </tr>
</table>
    
    </td>
    <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
  </tr>
  <tr>
    <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
    <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
    <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
  </tr>
</table>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
        <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
      </tr>
      <tr>
        <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
        <td><table width="160" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
          <tr>
            <td width="10" height="25" align="right" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
            <td height="25" colspan="3" align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Embrasure</td>
            <td width="11" height="25" align="left" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
          </tr>
          <tr>
            <td height="8" colspan="5" align="center"></td>
            </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td align="center"><img src="../resource/images/eorder/teeth/embrasure/open.gif" width="56" height="56" /></td>
            <td align="center">&nbsp;</td>
            <td align="center"><img src="../resource/images/eorder/teeth/embrasure/close.gif" width="56" height="56" /></td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td align="center">&nbsp;</td>
          </tr>
          <tr>
            <td align="center">&nbsp;</td>
            <td align="center">Open</td>
            <td align="center">&nbsp;</td>
            <td align="center">Close</td>
            <td align="center">&nbsp;</td>
          </tr>

        </table></td>
        <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
      </tr>
      <tr>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
        <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
      </tr>
    </table></td>
    <td rowspan="3" align="center" valign="top"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
        <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
      </tr>
      <tr>
        <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
        <td><table width="400" border="0" cellspacing="0" cellpadding="0">
              <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
              <td width="10" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
              <td align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Shade</td>
              <td width="11" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
              </tr></table><br />

                            
              
                <table border="0" align="center" cellpadding="0" cellspacing="0">
                  <tr>
                    <td width="290"><img src="../resource/images/eorder/preview/preview_01.gif" width="290" height="19" /></td>
                    </tr>
                  <tr>
                    <td width="290"><img src="../resource/images/eorder/preview/preview_02.gif" width="290" height="16" /></td>
                    </tr>
                  <tr>
                    <td width="290"><img src="../resource/images/eorder/preview/preview_03.gif" width="290" height="16" /></td>
                    </tr>
                  <tr>
                    <td width="290"><img src="../resource/images/eorder/preview/preview_04.gif" width="290" height="45" /></td>
                    </tr>
                  <tr>
                    <td width="290"><img src="../resource/images/eorder/preview/preview_05.gif" width="290" height="16" /></td>
                    </tr>
                  <tr>
                    <td width="290"><img src="../resource/images/eorder/preview/preview_06.gif" width="290" height="16" /></td>
                    </tr>
                  <tr>
                    <td width="290"><img src="../resource/images/eorder/preview/preview_07.gif" width="290" height="19" /></td>
                    </tr>
                </table>
                <br /></td>
            </tr>
            <tr>
              <td colspan="3" bordercolor="#FFFFFF"><table width="400" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                  <td width="30">&nbsp;</td>
                  <td width="282" align="left">S1 - </td>
                  <td width="70"><button class="BTselect" onclick="OpenFixShadeSelector(1);" style="width:60px;height:20px;">
                  Select</button></td>
                </tr>
                <tr>
                  <td width="30">&nbsp;</td>
                  <td width="282" align="left">S2 - </td>
                  <td width="70"><button class="BTselect" onclick="OpenFixShadeSelector(2);" style="width:60px;height:20px;">
                  Select</button></td>
                </tr>
                <tr>
                  <td width="30">&nbsp;</td>
                  <td width="282" align="left">S3 - </td>
                  <td width="70"><button class="BTselect" onclick="OpenFixShadeSelector(3);" style="width:60px;height:20px;">
                  Select</button></td>
                </tr>
                <tr>
                  <td width="30">&nbsp;</td>
                  <td width="282" align="left">S4 - </td>
                  <td width="70"><button class="BTselect" onclick="OpenFixShadeSelector(4);" style="width:60px;height:20px;">
                  Select</button></td>
                </tr>
              </table></td>
            </tr>
            

        </table></td>
        <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
      </tr>
      <tr>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
        <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
      </tr>
    </table></td>
    <td rowspan="3" align="right" valign="top"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
        <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
      </tr>
      <tr>
        <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
        <td><table width="250" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
              <td width="10" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
              <td align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Option</td>
              <td width="11" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
            </tr>
            <tr>
              <td colspan="3">&nbsp;</td>
              </tr>
            
        </table></td>
        <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
      </tr>
      <tr>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
        <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
        <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
      </tr>
      <tr>
        <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
        <td><table width="160" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
              <td width="10" height="25" align="right" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
              <td height="25" colspan="2" align="center" background="../resource/images/eorder/panel/hd2.gif" class="TBHead">Type of pontic</td>
              <td width="11" height="25" align="left" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" width="11" height="25" /></td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center"><img src="../resource/images/eorder/teeth/pontic/pontic1.gif" width="56" height="56" /></td>
              <td align="center"><img src="../resource/images/eorder/teeth/pontic/pontic2.gif" width="56" height="56" /></td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center"><img src="../resource/images/eorder/teeth/pontic/pontic3.gif" width="56" height="56" /></td>
              <td align="center"><img src="../resource/images/eorder/teeth/pontic/pontic4.gif" width="56" height="56" /></td>
              <td align="center">&nbsp;</td>
            </tr>
        </table></td>
        <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
      </tr>
      <tr>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
        <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td align="left"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
        <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
      </tr>
      <tr>
        <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
        <td><table width="160" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
              <td width="10" height="20" align="right" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
              <td height="25" colspan="3" align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Type of preparation</td>
              <td width="11" height="25" align="left" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
            </tr>
            <tr>
              <td height="8" colspan="5" align="center"></td>
              </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center"><img src="../resource/images/eorder/teeth/preparation/preparation1.gif" width="56" height="31" /></td>
              <td width="8" align="center">&nbsp;</td>
              <td align="center"><img src="../resource/images/eorder/teeth/preparation/preparation2.gif" width="56" height="31" /></td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td width="8" align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center"><img src="../resource/images/eorder/teeth/preparation/preparation3.gif" width="56" height="31" /></td>
              <td width="8" align="center">&nbsp;</td>
              <td align="center"><img src="../resource/images/eorder/teeth/preparation/preparation4.gif" width="56" height="31" /></td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td width="8" align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td align="center">&nbsp;</td>
              <td align="center"><img src="../resource/images/eorder/teeth/preparation/preparation5.gif" width="56" height="31" /></td>
              <td width="8" align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
              <td align="center">&nbsp;</td>
            </tr>
            <tr>
              <td height="8" colspan="5" align="center"></td>
              </tr>
        </table></td>
        <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
      </tr>
      <tr>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
        <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="3" align="center">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" align="center"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
        <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
        <td rowspan="3" valign="top"><table border="0" cellpadding="0" cellspacing="0" id="AttachImagePreviewTB" style="display:none">
          <tr>
            <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
            <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
            <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
          </tr>
          <tr>
            <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
            <td><table width="105" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                  <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr bgcolor="#FFFFFF">
                        <td width="10" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
                        <td align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Attach</td>
                        <td width="11" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
                      </tr>
                    </table>
                      <img  width ="100" height="100" id="AttachImagePreviewIMG"/></td>
                </tr>
            </table></td>
            <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
          </tr>
          <tr>
            <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
            <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
            <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
          </tr>
        </table></td>
      </tr>
      <tr>
        <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
        <td><table width="500" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

            <tr>
              <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr bgcolor="#FFFFFF">
                  <td width="10" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
                  <td align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Observation</td>
                  <td width="11" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
                </tr>
              </table>
                <textarea name="textarea"  style="width:500px;height:80px"></textarea></td>
            </tr>
            <tr>
              <td align="right">Attach picture &nbsp; <input type="file" name="fileField" style="width:400px;" 
onchange="findObj('AttachImagePreviewIMG').src=this.value;findObj('AttachImagePreviewTB').style.display=this.value==''?'none':'inline';"
              /></td>
            </tr>
            
        </table></td>
        <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
        </tr>
      <tr>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
        <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
        </tr>
    </table>
      </td>
    </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td align="left">&nbsp;</td>
    <td align="center" valign="top">&nbsp;</td>
    <td align="right" valign="top">&nbsp;</td>
  </tr>
</table>
</div>

    </td>
  </tr>
</table>
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="1" bgcolor="#333333">
  <tr>
    <td bgcolor="#FFFFFF">
    <table width="100%" border="0" cellspacing="0" cellpadding="2">
      <tr>
          <td width="70" align="right" class="TBHead2" >select -&gt;</td>
          <td width="20" align="left" class="TBHead2" ><span class="TBHead" style="font-size:16px">
            <input type="checkbox" name="checkbox" id="checkbox" onclick="SetRemoveOrder(this.checked);" />
          </span></td>      
        <td align="left" style="font-size:16px"  class="TBHead2">
          Removable order</td>
      </tr>
      </table>
      <div id="MainRemove"><br />

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td align="center"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
        <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
      </tr>
      <tr>
        <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
        <td><table width="250" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">

            <tr>
              <td><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td><img src="../resource/images/eorder/teeth/remove/pie.gif" width="56" height="56" /></td>
                  <td width="50" align="center">PIE</td>
                  <td width="70" align="center"><input type="checkbox" name="checkbox4" id="checkbox4" />
                    Upper</td>
                  <td width="70" align="center"><input type="checkbox" name="checkbox4" id="checkbox5" />
                    Lower</td>
                </tr>
              </table></td>
            </tr>
            
        </table></td>
        <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
      </tr>
      <tr>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
        <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
      </tr>
    </table>
      </td>
    <td align="center"><table border="0" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
        <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
        <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
      </tr>
      <tr>
        <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
        <td><table width="250" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
            <tr>
              <td><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td><img src="../resource/images/eorder/teeth/remove/cire.gif" width="56" height="56" /></td>
                    <td width="50" align="center">CIRE</td>
                    <td width="70" align="center"><input type="checkbox" name="checkbox2" id="checkbox2" />
                      Upper</td>
                    <td width="70" align="center"><input type="checkbox" name="checkbox2" id="checkbox3" />
                      Lower</td>
                  </tr>
              </table></td>
            </tr>
        </table></td>
        <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
      </tr>
      <tr>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
        <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
        <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<br />
<table border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
    <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
    <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
  </tr>
  <tr>
    <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
    <td>
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="10" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
        <td align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Upper</td>
        <td width="11" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
      </tr>
    </table>
    <table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
      <tr>
        <td><table border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="center"><div id="RemoveTeethImage32"></div></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
    <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
  </tr>
  <tr>
    <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
    <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
    <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
  </tr>
</table>
<br />

        <table border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
            <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
            <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
          </tr>
          <tr>
            <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
            <td><table border="0" align="center" cellpadding="2" cellspacing="0">
                <tr>
                  <td height="20" align="center">18</td>
                  <td height="20" align="center">17</td>
                  <td height="20" align="center">16</td>
                  <td height="20" align="center">15</td>
                  <td height="20" align="center">14</td>
                  <td height="20" align="center">13</td>
                  <td height="20" align="center">12</td>
                  <td height="20" align="center">11</td>
                  <td height="20" align="center">21</td>
                  <td height="20" align="center">22</td>
                  <td height="20" align="center">23</td>
                  <td height="20" align="center">24</td>
                  <td height="20" align="center">25</td>
                  <td height="20" align="center">26</td>
                  <td height="20" align="center">27</td>
                  <td height="20" align="center">28</td>
                </tr>
                <tr>
                  <td width="56" height="56"><div id="RemoveTeethImage0"></div>                      <script>RefreshRemoveTeethImage(0);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage1"></div>                      <script>RefreshRemoveTeethImage(1);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage2"></div>                      <script>RefreshRemoveTeethImage(2);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage3"></div>                      <script>RefreshRemoveTeethImage(3);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage4"></div>                      <script>RefreshRemoveTeethImage(4);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage5"></div>                      <script>RefreshRemoveTeethImage(5);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage6"></div>                      <script>RefreshRemoveTeethImage(6);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage7"></div>                      <script>RefreshRemoveTeethImage(7);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage8"></div>                      <script>RefreshRemoveTeethImage(8);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage9"></div>                      <script>RefreshRemoveTeethImage(9);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage10"></div>                      <script>RefreshRemoveTeethImage(10);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage11"></div>                      <script>RefreshRemoveTeethImage(11);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage12"></div>                      <script>RefreshRemoveTeethImage(12);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage13"></div>                      <script>RefreshRemoveTeethImage(13);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage14"></div>                      <script>RefreshRemoveTeethImage(14);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage15"></div>                      <script>RefreshRemoveTeethImage(15);</script></td>
                </tr>
                <tr>
                  <td width="56" height="56"><div id="RemoveTeethImage16"></div>                      <script>RefreshRemoveTeethImage(16);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage17"></div>                      <script>RefreshRemoveTeethImage(17);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage18"></div>                      <script>RefreshRemoveTeethImage(18);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage19"></div>                      <script>RefreshRemoveTeethImage(19);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage20"></div>                      <script>RefreshRemoveTeethImage(20);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage21"></div>                      <script>RefreshRemoveTeethImage(21);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage22"></div>                      <script>RefreshRemoveTeethImage(22);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage23"></div>                      <script>RefreshRemoveTeethImage(23);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage24"></div>                      <script>RefreshRemoveTeethImage(24);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage25"></div>                      <script>RefreshRemoveTeethImage(25);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage26"></div>                      <script>RefreshRemoveTeethImage(26);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage27"></div>                      <script>RefreshRemoveTeethImage(27);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage28"></div>                      <script>RefreshRemoveTeethImage(28);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage29"></div>                      <script>RefreshRemoveTeethImage(29);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage30"></div>                      <script>RefreshRemoveTeethImage(30);</script></td>
                  <td width="56" height="56"><div id="RemoveTeethImage31"></div>                      <script>RefreshRemoveTeethImage(31);</script></td>
                </tr>
                <tr>
                  <td height="20" align="center">38</td>
                  <td height="20" align="center">37</td>
                  <td height="20" align="center">36</td>
                  <td height="20" align="center">35</td>
                  <td height="20" align="center">34</td>
                  <td height="20" align="center">33</td>
                  <td height="20" align="center">32</td>
                  <td height="20" align="center">31</td>
                  <td height="20" align="center">41</td>
                  <td height="20" align="center">42</td>
                  <td height="20" align="center">43</td>
                  <td height="20" align="center">44</td>
                  <td height="20" align="center">45</td>
                  <td height="20" align="center">46</td>
                  <td height="20" align="center">47</td>
                  <td height="20" align="center">48</td>
                </tr>
            </table></td>
            <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
          </tr>
          <tr>
            <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
            <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
            <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
          </tr>
        </table>
        
        <br />
        <table border="0" cellpadding="0" cellspacing="0">
          <tr>
            <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
            <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
            <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
          </tr>
          <tr>
            <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
            <td><table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="10" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
                  <td align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Lower</td>
                  <td width="11" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
                </tr>
              </table>
                <table border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                  <tr>
                    <td><table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                          <td align="center"><div id="RemoveTeethImage33"></div></td>
                        </tr>
                    </table></td>
                  </tr>
              </table></td>
            <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
          </tr>
          <tr>
            <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
            <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
            <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
          </tr>
        </table>
        <br />
        <br />
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="300" valign="top"><? $uplotype="Upper"?>
              <? include("eorder_removedetail.php")?></td>
            <td rowspan="2" valign="top"><table border="0" cellpadding="0" cellspacing="0">
              <tr>
                <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
                <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
                <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
              </tr>
              <tr>
                <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
                <td><table width="400" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                      <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tr>
                            <td width="10" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
                            <td align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Shade</td>
                            <td width="11" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
                          </tr>
                      </table>
                          <br />
                          <table border="0" align="center" cellpadding="0" cellspacing="0">
                            <tr>
                              <td width="290"><img src="../resource/images/eorder/preview/preview_01.gif" width="290" height="19" /></td>
                            </tr>
                            <tr>
                              <td width="290"><img src="../resource/images/eorder/preview/preview_02.gif" width="290" height="16" /></td>
                            </tr>
                            <tr>
                              <td width="290"><img src="../resource/images/eorder/preview/preview_03.gif" width="290" height="16" /></td>
                            </tr>
                            <tr>
                              <td width="290"><img src="../resource/images/eorder/preview/preview_04.gif" width="290" height="45" /></td>
                            </tr>
                            <tr>
                              <td width="290"><img src="../resource/images/eorder/preview/preview_05.gif" width="290" height="16" /></td>
                            </tr>
                            <tr>
                              <td width="290"><img src="../resource/images/eorder/preview/preview_06.gif" width="290" height="16" /></td>
                            </tr>
                            <tr>
                              <td width="290"><img src="../resource/images/eorder/preview/preview_07.gif" width="290" height="19" /></td>
                            </tr>
                          </table>
                        <br /></td>
                    </tr>
                    <tr>
                      <td colspan="3" bordercolor="#FFFFFF"><table width="400" border="0" cellpadding="3" cellspacing="0" bgcolor="#FFFFFF">
                          <tr>
                            <td width="30">&nbsp;</td>
                            <td width="282" align="left">S1 - </td>
                            <td width="70"><button class="BTselect" onclick="OpenFixShadeSelector(1);" style="width:60px;height:20px;"> Select</button></td>
                          </tr>
                          <tr>
                            <td width="30">&nbsp;</td>
                            <td width="282" align="left">S2 - </td>
                            <td width="70"><button class="BTselect" onclick="OpenFixShadeSelector(2);" style="width:60px;height:20px;"> Select</button></td>
                          </tr>
                          <tr>
                            <td width="30">&nbsp;</td>
                            <td width="282" align="left">S3 - </td>
                            <td width="70"><button class="BTselect" onclick="OpenFixShadeSelector(3);" style="width:60px;height:20px;"> Select</button></td>
                          </tr>
                          <tr>
                            <td width="30">&nbsp;</td>
                            <td width="282" align="left">S4 - </td>
                            <td width="70"><button class="BTselect" onclick="OpenFixShadeSelector(4);" style="width:60px;height:20px;"> Select</button></td>
                          </tr>
                      </table></td>
                    </tr>
                </table></td>
                <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
              </tr>
              <tr>
                <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
                <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
                <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td width="300" valign="top"><? $uplotype="Lower"?>
              <? include("eorder_removedetail.php")?></td>
          </tr>
        </table>
        <table border="0" align="center" cellpadding="0" cellspacing="0">
          <tr>
            <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
            <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
            <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
            <td rowspan="3" valign="top"><table border="0" cellpadding="0" cellspacing="0" id="AttachImagePreviewTB2" style="display:none">
                <tr>
                  <td width="10" height="10" background="../resource/images/eorder/panel/pn1.gif"></td>
                  <td height="10" background="../resource/images/eorder/panel/pn2.gif"></td>
                  <td width="10" height="10" background="../resource/images/eorder/panel/pn3.gif"></td>
                </tr>
                <tr>
                  <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
                  <td><table width="105" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                      <tr>
                        <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                            <tr bgcolor="#FFFFFF">
                              <td width="10" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
                              <td align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Attach</td>
                              <td width="11" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
                            </tr>
                          </table>
                            <img  width ="100" height="100" id="AttachImagePreviewIMG2"/></td>
                      </tr>
                  </table></td>
                  <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
                </tr>
                <tr>
                  <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
                  <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
                  <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
                </tr>
            </table></td>
          </tr>
          <tr>
            <td width="10" background="../resource/images/eorder/panel/pn4.gif"></td>
            <td><table width="500" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFFFFF">
                <tr>
                  <td align="center"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                      <tr bgcolor="#FFFFFF">
                        <td width="10" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd1.gif" width="10" height="25" /></td>
                        <td align="center" background="../resource/images/eorder/panel/hd2.gif" bgcolor="#000066" class="TBHead">Observation</td>
                        <td width="11" height="25" align="center" class="TBHead"><img src="../resource/images/eorder/panel/hd3.gif" alt="" width="11" height="25" /></td>
                      </tr>
                    </table>
                      <textarea name="textarea2"  style="width:500px;height:80px"></textarea></td>
                </tr>
                <tr>
                  <td align="right">Attach picture &nbsp;
                      <input type="file" name="fileField2" style="width:400px;" 
onchange="findObj('AttachImagePreviewIMG2').src=this.value;findObj('AttachImagePreviewTB2').style.display=this.value==''?'none':'inline';"
              /></td>
                </tr>
            </table></td>
            <td width="10" background="../resource/images/eorder/panel/pn6.gif"></td>
          </tr>
          <tr>
            <td width="10" height="11" background="../resource/images/eorder/panel/pn7.gif"></td>
            <td height="11" background="../resource/images/eorder/panel/pn8.gif"></td>
            <td width="10" height="11" background="../resource/images/eorder/panel/pn9.gif"></td>
          </tr>
        </table>
        <br />
        

</div></td>
  </tr>
</table>


<script type="text/javascript">



InitLayer();
RefreshRemoveTeethImage(32);
RefreshRemoveTeethImage(33);

hideBG();
</script>
</body>
</html>
