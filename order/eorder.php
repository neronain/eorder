<?php
	
	//include("session.php");
	//$sessionid = session_id();
	//check_permission("CN",$sessionid);
	//$session_data = load_session_data($sessionid);
	//$member = getMember();
	//$doctor = load_doctor_name($session_data["doctorId"]);
	//$clinic = load_clinic_data($session_data["loginid"]);
?>

<HTML>
<HEAD>

<TITLE>Hexa Ceram Dental Laboratory</TITLE>
<style>
#innermenu a{
text-decoration:none;
}

#innermenu a:hover{
background-color:#FFFF95;

}
.orderNormal {font-size: 14px; font-family: Arial, Helvetica, sans-serif;}
</style>
<script src="../resource/javascript/default.js"></script>
<script src="../resource/javascript/eordermain.js"></script>
<script src="../resource/javascript/eorderselectcolor.js"></script>
<script src="../resource/javascript/eorderselectfixmaterial.js"></script>
<script src="../resource/javascript/eorderselectremovematerial.js"></script>
<script src="../resource/javascript/eorderselectfixoption.js"></script>
<script src="../resource/javascript/eorderselectteeth.js"></script>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=utf-8">
<link href="../resource/css/eorder.css" rel="stylesheet" type="text/css">


</HEAD>
<BODY BGCOLOR=#FFFFFF LEFTMARGIN=0 MARGINWIDTH=0 topmargin="2" onmousemove="getMouseLoc(event)">
<div id="backgroundLayer" style="position:absolute;left:0;top:0;width:100%;height:2000;visibility:hidden;background-image:url(../resource/images/eorder/bglayer.gif);z-index:0;"></div>
 <div id="PopUPSelectColor"  style="position:absolute;white-space:nowrap;left:0;top:0;width:580px;height:250px;border:1px solid black;background-color:white;visibility:hidden;"></div>
 <div id="PopUPSelectFixMaterial" style="position:absolute;white-space:nowrap;left:0;top:0;width:702px;height:380px;border:1px solid black;background-color:white;visibility:hidden;z-index:100;"></div>
 <div id="PopUPSelectFixOption" style="position:absolute;white-space:nowrap;left:0;top:0;width:500px;height:180px;border:1px solid black;background-color:white;visibility:hidden;"></div>
 <div id="PopUPSelectRemoveMaterial" style="position:absolute;white-space:nowrap;left:0;top:0;width:300px;height:380px;border:1px solid black;background-color:white;visibility:hidden;"></div>
 <div id="PopUPSelectRemoveMaterialEach" style="position:absolute;white-space:nowrap;left:0;top:0;width:400px;height:450px;border:1px solid black;background-color:white;visibility:hidden;"></div>
 <div id="PopUPTooltip" style="position:absolute;left:0;top:0;width:200px;height:100px;background-color:white;visibility:hidden;z-index:100;"><table border="0" cellspacing="1" cellpadding="3" bgcolor="#003300" width="100%" height="100%">
   <tr><td bgcolor="#99FF99" class="TableHeadingNormal" height="20" id="PopUPTooltipHead" >[Tip]</td>
 </tr><tr><td valign="top" bgcolor="#FFFFFF" class="orderSmall" id="PopUPTooltipText"></td>
 </tr></table></div>

<TABLE WIDTH=100% height="100%" BORDER=0 align="center" CELLPADDING=0 CELLSPACING=0>
 <form action="m_sum_fixed.php" target="" method="post" name="order" id="order" onKeyPress="return noenter();">
	<TR>
	  <TD height="23">
		<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
			<tr>

			<td height="23" align="center" background="../resource/images/eorder/menuco.gif" class="TableHeading">
				Create New Order :: Fixed &amp; Remove </td>

			</tr>
		</table>	  </TD>
    </TR> 	
	<TR>
	  <TD valign="top" height=800>
	  
											<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0">
											  <tr>
												<td valign="top" bgcolor="#FFFFFF"><table width="100%" border="0" bgcolor="#F5F5F5">
												  <tr>
													<td width="100" class="orderBold">Doctor Name </td>
													<td><span class="orderNormal"><? echo $doctor["name"]; ?></span></td>
													<td width="100"><span class="orderBold">Patient Name </span></td>
													<td><span class="orderNormal"><? echo $session_data["patientName"]; ?></span></td>
												  </tr>
												  <tr>
													<td class="orderBold">Lab/Clinic</td>
													<td><span class="orderNormal"><? echo $member["name"]; ?></span></td>
													<td><span class="orderBold">Address</span></td>
													<td>&nbsp;</td>
												  </tr>
												  <tr>
												    <td class="orderBold">Date</td>
												    <td>&nbsp;</td>
												    <td class="orderBold">Date of </td>
												    <td>&nbsp;</td>
											      </tr>
												  
												</table>

                                                 
                                                  <table width="100%" border="0" cellpadding="5" cellspacing="0">
                                                    <tr>
                                                      <td align="center" bgcolor="#99CCCC" class="TableHeadingNormal">
                                                        <input type="checkbox" name="checkbox322" value="checkbox" />
                                                      <font color="#FFFFFF">Fixed teeth</font> </td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center"><table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFCC66">
                                                        <tr>
                                                          <td colspan="4" align="center" bgcolor="#FFFF99"><span class="TableHeadingNormal">Method</span></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="120" height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                              <td width="32" align="right"><input name="method" type="radio" value="1"></td>
                                                              <td width="32"><img src="../resource/images/eorder/fix/ty_tryin.gif" width="32" height="32"></td>
                                                              <td class="TableHeadingNormal">Try-in</td>
                                                            </tr>
                                                          </table></td>
                                                          <td width="120" height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                              <td width="32" align="right"><input name="method" type="radio" value="2"></td>
                                                              <td width="32"><img src="../resource/images/eorder/fix/ty_contour.gif" width="32" height="32"></td>
                                                              <td class="TableHeadingNormal">Contour</td>
                                                            </tr>
                                                          </table></td>
                                                          <td width="120" height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                              <td width="32" align="right"><input name="method" type="radio" value="3"></td>
                                                              <td width="32"><img src="../resource/images/eorder/fix/ty_finish.gif" width="32" height="32"></td>
                                                              <td class="TableHeadingNormal">Finish</td>
                                                            </tr>
                                                          </table></td>
                                                          <td width="120" height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                              <td width="32" align="right"><input name="method" type="radio" value="5"></td>
                                                              <td width="32"><img src="../resource/images/eorder/fix/ty_repair.gif" width="32" height="32"></td>
                                                              <td class="TableHeadingNormal">Repair</td>
                                                            </tr>
                                                          </table></td>
                                                        </tr>
                                                      </table>
                                                          <table width="100%" border="0" cellspacing="10" cellpadding="0">
                                                            <tr>
                                                              <td></td>
                                                            </tr>
                                                        </table>
                                                        <table border="0" cellpadding="2" cellspacing="0" bgcolor="#FFCC66">
                                                        <tr>
                                                          <td width="490" align="center" valign="top" bgcolor="#FFFF99"><span class="TableHeadingNormal">Alloy</span></td>
                                                          </tr>
                                                        <tr>
                                                          <td align="center" bgcolor="#FFFFFF"><select name="select" class="TableHeadingNormal" id="stupid_ie_select1">
                                                            <option>&nbsp;&nbsp;&nbsp; None &nbsp;&nbsp;&nbsp;</option>
                                                            <option>&nbsp;&nbsp;&nbsp; Non precious &nbsp;&nbsp;&nbsp;</option>
                                                            <option>&nbsp;&nbsp;&nbsp; Non nickel &nbsp;&nbsp;&nbsp;</option>
                                                            <option>&nbsp;&nbsp;&nbsp; Precious Palladium &nbsp;&nbsp;&nbsp;</option>
                                                            <option>&nbsp;&nbsp;&nbsp; Precious Semi-precious &nbsp;&nbsp;&nbsp;</option>
                                                            <option>&nbsp;&nbsp;&nbsp; Precious White - Gold &nbsp;&nbsp;&nbsp;</option>
                                                            <option>&nbsp;&nbsp;&nbsp; Precious Yellow - Gold &nbsp;&nbsp;&nbsp;</option>
                                                          </select>													      </td>
                                                          </tr>
                                                      </table>
                                                        <table width="100%" border="0" cellspacing="20" cellpadding="0">
                                                          <tr>
                                                            <td></td>
                                                          </tr>
                                                        </table>
                                                        <table border="0" align="center" cellpadding="0" cellspacing="0">
                                                          <tr>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg0"></div><script>onMouseOutBridge(0);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg1"></div><script>onMouseOutBridge(1);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg2"></div><script>onMouseOutBridge(2);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg3"></div><script>onMouseOutBridge(3);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg4"></div><script>onMouseOutBridge(4);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg5"></div><script>onMouseOutBridge(5);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg6"></div><script>onMouseOutBridge(6);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg7"></div><script>onMouseOutBridge(7);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg8"></div><script>onMouseOutBridge(8);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg9"></div><script>onMouseOutBridge(9);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg10"></div><script>onMouseOutBridge(10);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg11"></div><script>onMouseOutBridge(11);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg12"></div><script>onMouseOutBridge(12);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg13"></div><script>onMouseOutBridge(13);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg14"></div><script>onMouseOutBridge(14);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                          </tr>
                                                        </table>
                                                        <table width="760" border="0" cellpadding="0" cellspacing="1">
                                                            <tr>
                                                              <td align="right"><table border="0" cellpadding="0" cellspacing="0" class="orderSmall">
                                                                   <tr>
                                                                    <td align="center">18</td>
                                                                    <td align="center">17</td>
                                                                    <td align="center">16</td>
                                                                    <td align="center">15</td>
                                                                    <td align="center">14</td>
                                                                    <td align="center">13</td>
                                                                    <td align="center">12</td>
                                                                    <td align="center">11</td>
                                                                  </tr>
																  <tr>
                                                                    <td width="47" height="47" align="center"><div id="teethImg0"></div><script>onMouseOutTeeth(0);</script></td>
                                                                    <td width="47" height="47" align="center"><div id="teethImg1"></div><script>onMouseOutTeeth(1);</script></td>
                                                                    <td width="47" height="47" align="center"><div id="teethImg2"></div><script>onMouseOutTeeth(2);</script></td>
                                                                    <td width="47" height="47" align="center"><div id="teethImg3"></div><script>onMouseOutTeeth(3);</script></td>
                                                                    <td width="47" height="47" align="center"><div id="teethImg4"></div><script>onMouseOutTeeth(4);</script></td>
                                                                    <td width="47" height="47" align="center"><div id="teethImg5"></div><script>onMouseOutTeeth(5);</script></td>
                                                                    <td width="47" height="47" align="center"><div id="teethImg6"></div><script>onMouseOutTeeth(6);</script></td>
                                                                    <td width="47" height="47" align="center"><div id="teethImg7"></div><script>onMouseOutTeeth(7);</script></td>
                                                                  </tr>

                                                                </table></td>
                                                              <td width="1" bgcolor="#003399"></td>
                                                              <td><table border="0" cellpadding="0" cellspacing="0" class="orderSmall">
                                                                <tr>
                                                                  <td align="center">21</td>
                                                                  <td align="center">22</td>
                                                                  <td align="center">23</td>
                                                                  <td align="center">24</td>
                                                                  <td align="center">25</td>
                                                                  <td align="center">26</td>
                                                                  <td align="center">27</td>
                                                                  <td align="center">28</td>
                                                                </tr>
                                                                <tr>
                                                                  <td width="47" height="47" align="center"><div id="teethImg8"></div><script>onMouseOutTeeth(8);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg9"></div><script>onMouseOutTeeth(9);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg10"></div><script>onMouseOutTeeth(10);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg11"></div><script>onMouseOutTeeth(11);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg12"></div><script>onMouseOutTeeth(12);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg13"></div><script>onMouseOutTeeth(13);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg14"></div><script>onMouseOutTeeth(14);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg15"></div><script>onMouseOutTeeth(15);</script></td>
                                                                </tr>

                                                              </table></td>
                                                            </tr>
                                                            <tr>
                                                              <td height="1" colspan="3" bgcolor="#003399"></td>
                                                            </tr>
                                                            <tr>
                                                              <td align="right"><table border="0" cellpadding="0" cellspacing="0" class="orderSmall">

                                                                <tr>
                                                                  <td width="47" height="47" align="center"><div id="teethImg16"></div><script>onMouseOutTeeth(16);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg17"></div><script>onMouseOutTeeth(17);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg18"></div><script>onMouseOutTeeth(18);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg19"></div><script>onMouseOutTeeth(19);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg20"></div><script>onMouseOutTeeth(20);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg21"></div><script>onMouseOutTeeth(21);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg22"></div><script>onMouseOutTeeth(22);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg23"></div><script>onMouseOutTeeth(23);</script></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="center">38</td>
                                                                  <td align="center">37</td>
                                                                  <td align="center">36</td>
                                                                  <td align="center">35</td>
                                                                  <td align="center">34</td>
                                                                  <td align="center">33</td>
                                                                  <td align="center">32</td>
                                                                  <td align="center">31</td>
                                                                </tr>																
                                                              </table>                                                                </td>
                                                              <td width="1" bgcolor="#003399"></td>
                                                              <td><table border="0" cellpadding="0" cellspacing="0" class="orderSmall">

                                                                <tr>
                                                                  <td width="47" height="47" align="center"><div id="teethImg24"></div><script>onMouseOutTeeth(24);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg25"></div><script>onMouseOutTeeth(25);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg26"></div><script>onMouseOutTeeth(26);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg27"></div><script>onMouseOutTeeth(27);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg28"></div><script>onMouseOutTeeth(28);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg29"></div><script>onMouseOutTeeth(29);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg30"></div><script>onMouseOutTeeth(30);</script></td>
                                                                  <td width="47" height="47" align="center"><div id="teethImg31"></div><script>onMouseOutTeeth(31);</script></td>
                                                                </tr>
                                                                <tr>
                                                                  <td align="center">41</td>
                                                                  <td align="center">42</td>
                                                                  <td align="center">43</td>
                                                                  <td align="center">44</td>
                                                                  <td align="center">45</td>
                                                                  <td align="center">46</td>
                                                                  <td align="center">47</td>
                                                                  <td align="center">48</td>
                                                                </tr>																
                                                              </table>                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <table border="0" align="center" cellpadding="0" cellspacing="0">
                                                          <tr>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg15"></div><script>onMouseOutBridge(15);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg16"></div><script>onMouseOutBridge(16);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg17"></div><script>onMouseOutBridge(17);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg18"></div><script>onMouseOutBridge(18);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg19"></div><script>onMouseOutBridge(19);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg20"></div><script>onMouseOutBridge(20);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg21"></div><script>onMouseOutBridge(21);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg22"></div><script>onMouseOutBridge(22);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg23"></div><script>onMouseOutBridge(23);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg24"></div><script>onMouseOutBridge(24);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg25"></div><script>onMouseOutBridge(25);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg26"></div><script>onMouseOutBridge(26);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg27"></div><script>onMouseOutBridge(27);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg28"></div><script>onMouseOutBridge(28);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                            <td width="41" height="12"><div id="bridgeImg29"></div><script>onMouseOutBridge(29);</script></td>
                                                            <td width="6" height="12"><img src="../resource/images/eorder/fix/dot.gif" width="6" height="6"></td>
                                                          </tr>
                                                        </table>
                                                        <br>
                                                        <br>
                                                        <br>
                                                      <table width="95%" border="0" cellspacing="0" cellpadding="2">
                                                        <tr>
                                                          <td valign="top">
														  <table width="160" border="0" cellpadding="2" cellspacing="1" bgcolor="#FFCC66">
                                                            <tr>
                                                              <td height="32" align="center" bgcolor="#FFFF99" class="TableHeadingNormal">Embrasure</td>
                                                            </tr>
                                                            <tr>
                                                              <td height="32" bgcolor="#FFFFFF"><table width="120" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="32" align="right"><input name="embrasure" type="radio" value="2"></td>
                                                                  <td width="32"><img src="../resource/images/eorder/fix/em_open.gif" width="32" height="32"></td>
                                                                  <td align="center" class="TableHeadingNormal">Open</td>
                                                                </tr>
                                                              </table></td>
                                                            </tr>
                                                            <tr>
                                                              <td height="32" bgcolor="#FFFFFF"><table width="120" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="32" align="right"><input name="embrasure" type="radio" value="3"></td>
                                                                  <td width="32"><img src="../resource/images/eorder/fix/em_close.gif" width="32" height="32"></td>
                                                                  <td align="center" class="TableHeadingNormal">Close</td>
                                                                </tr>
                                                              </table></td>
                                                            </tr>
                                                          </table></td>
                                                          <td align="center" valign="top"><table width="300" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFCC33">
                                                            <tr>
                                                              <td height="20" bgcolor="#FFFF99"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr>
                                                                    <td class="TableHeadingNormal">&nbsp;&nbsp;Shade</td>
                                                                    <td align="right"><input name="button" type="button"  id="btnSelectColor" style="width:40;height:18;font-size:9px" onClick="popup_selectcolor(0);" value="Select"></td>
                                                                  </tr>
                                                              </table></td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#FFFFFF" class="orderSmall" style="font-size:10px" height=20><div class="TableHeadingNormal" id="selectedcolor">&nbsp;No shade select</div></td>
                                                            </tr>
                                                            <tr>
                                                              <td height="100" align="center" bgcolor="#FFFFFF"><table border="0" cellspacing="5" cellpadding="0">
                                                                  <tr>
                                                                    <td id="fixcolorpreview" bgcolor="#CCCCCC"><a href="javascript:popup_selectcolor(0);"><img src="../resource/images/eorder/teeth/preview2.gif" width="91" height="56" border="0"></a></td>
                                                                  </tr>
                                                              </table></td>
                                                            </tr>
                                                          </table></td>
                                                          <td rowspan="2" align="right" valign="top"><table width="220" border="0" cellpadding="2" cellspacing="1" bgcolor="#FFCC33">
                                                            <tr>
                                                              <td height="20" bgcolor="#FFFF99" class="TableHeadingNormal">&nbsp;&nbsp;Option</td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#FFFFFF" class="orderSmall"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                                  <tr>
                                                                    <td width="20"><input type="checkbox" name="checkbox32" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/fix/op_mcl.gif" width="32" height="32" /></td>
                                                                    <td colspan="2" class="orderSmall">Metel Collar Lingual</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td width="20" bgcolor="#FFFFCC"><input type="checkbox" name="checkbox33" value="checkbox" /></td>
                                                                    <td width="32" bgcolor="#FFFFCC"><img src="../resource/images/eorder/fix/op_mc360.gif" width="32" height="32" /></td>
                                                                    <td colspan="2" bgcolor="#FFFFCC" class="orderSmall">Metel Collar 360&deg; </td>
                                                                  </tr>

                                                                  <tr>
                                                                    <td width="20">&nbsp;</td>
                                                                    <td><img src="../resource/images/eorder/fix/op_pm.gif" width="32" height="32" /></td>
                                                                    <td colspan="2" class="orderSmall">Porcelain Margin </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>&nbsp;</td>
                                                                    <td colspan="3">
																	<table><tr><td><div id="optiontable1"></div></td><td><input  type="button" style="width:40;height:18;font-size:9px" onClick="popup_selectfixoption(1);" value="Select"></td></tr></table>
                                                                    <script>writeit('optiontable1',build_html_teethtable_option(1));</script>                                                                    </td>
                                                                  </tr>

                                                                  <tr>
                                                                    <td width="20" bgcolor="#FFFFCC">&nbsp;</td>
                                                                    <td bgcolor="#FFFFCC"><img src="../resource/images/eorder/fix/op_sb.gif" width="32" height="32" /></td>
                                                                    <td colspan="2" bgcolor="#FFFFCC" class="orderSmall">Step bar / Milling </td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td bgcolor="#FFFFCC">&nbsp;</td>
                                                                    <td colspan="3" bgcolor="#FFFFCC">
																	<table><tr><td><div id="optiontable2"></div></td><td><input  type="button"  style="width:40;height:18;font-size:9px" onClick="popup_selectfixoption(2);" value="Select"></td></tr></table>
																	<script>writeit('optiontable2',build_html_teethtable_option(2));</script>																	</td>
                                                                  </tr>

                                                                  <tr>
                                                                    <td width="20">&nbsp;</td>
                                                                    <td><img src="../resource/images/eorder/fix/op_att.gif" width="32" height="32" /></td>
                                                                    <td colspan="2" class="orderSmall">Attachment</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td>&nbsp;</td>
                                                                    <td colspan="3">
																	<table><tr><td><div id="optiontable3"></div></td><td><input type="button" style="width:40;height:18;font-size:9px" onClick="popup_selectfixoption(3);" value="Select"></td></tr></table>
																	<script>writeit('optiontable3',build_html_teethtable_option(3));</script>																	</td>
                                                                  </tr>
                                                              </table></td>
                                                            </tr>
                                                          </table></td>
                                                        </tr>
                                                        <tr>
                                                          <td valign="top"><table width="160" border="0" cellpadding="2" cellspacing="1" bgcolor="#FFCC66">
                                                            <tr>
                                                              <td height="32" colspan="2" align="center" bgcolor="#FFFF99" class="TableHeadingNormal">Type of
pontic</td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="32" align="right"><input name="pontic" type="radio" value="2"></td>
                                                                  <td width="32"><img src="../resource/images/eorder/fix/fix_pontic1.gif" width="32" height="32"></td>
                                                                </tr>
                                                              </table></td>
                                                              <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="32" align="right"><input name="pontic" type="radio" value="3"></td>
                                                                  <td width="32"><img src="../resource/images/eorder/fix/fix_pontic3.gif" width="32" height="32"></td>
                                                                </tr>
                                                              </table></td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                  <td width="32" align="right"><input name="pontic" type="radio" value="4"></td>
                                                                  <td width="32"><img src="../resource/images/eorder/fix/fix_pontic2.gif" width="32" height="32"></td>
                                                                </tr>
                                                              </table></td>
                                                              <td height="32" bgcolor="#FFFFFF"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr>
                                                                    <td width="32" align="right"><input name="pontic" type="radio" value="5"></td>
                                                                    <td width="32"><img src="../resource/images/eorder/fix/fix_pontic4.gif" width="32" height="32"></td>
                                                                  </tr>
                                                              </table></td>
                                                            </tr>
                                                          </table></td>
                                                          <td align="center" valign="top">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td valign="top">&nbsp;</td>
                                                          <td align="center" valign="top">&nbsp;</td>
                                                          <td align="right" valign="top">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td colspan="3" align="center" valign="top"><table border="0" cellpadding="2" cellspacing="1" bgcolor="#FFCC66">
                                                            <tr>
                                                              <td align="left" bgcolor="#FFFF99" class="TableHeadingNormal">&nbsp;&nbsp;&nbsp;&nbsp;Observations</td>
                                                            </tr>
                                                            <tr>
                                                              <td height="32" align="center" bgcolor="#FFFFFF" class="TableHeadingNormal"><textarea name="textfield" cols="80" rows="5"></textarea></td>
                                                            </tr>
                                                                                                                    </table></td>
                                                        </tr>
                                                      </table>
                                                      <br></td>
                                                    </tr>
                                                    <tr>
                                                      <td align="center" bgcolor="#99CCCC" class="TableHeadingNormal">
                                                        <input type="checkbox" name="checkbox323" value="checkbox" />
                                                      <font color="#FFFFFF">Remove teeth</font> </td>
                                                    </tr>
													
                                                    <tr>
                                                      <td align="center" bgcolor="#FFFFFF"><table width="600" border="0" cellpadding="0" cellspacing="0" class="orderSmall">
                                                          <tr>
                                                            <td width="32"><img src="../resource/images/eorder/remove/d_pei.gif" width="32" height="32"></td>
                                                            <td>&nbsp; PEI
                                                              <input type="checkbox" name="checkbox" value="checkbox">
upper 
<input type="checkbox" name="checkbox2" value="checkbox">
lower </td>
                                                            <td width="32"><img src="../resource/images/eorder/remove/d_cire.gif" width="32" height="32"></td>
                                                            <td width="200">&nbsp; CIRE
                                                              <input type="checkbox" name="checkbox3" value="checkbox">
upper
<input type="checkbox" name="checkbox22" value="checkbox">
lower </td>
                                                          </tr>
                                                        </table>
													    <br>
													    <table width="760" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                          <td><table width="48" height="48" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                              <td><div id="teethImgR32"></div>
                                                                    <script>onMouseOutTeethR(32);</script></td>
                                                            </tr>
                                                          </table></td>
                                                          <td>&nbsp;</td>
                                                          <td height="32">&nbsp;</td>
                                                        </tr>
                                                      </table>
                                                       
                                                      <table width="760" border="0" cellpadding="0" cellspacing="1">
                                                        <tr>
                                                          <td align="right"><table border="0" cellpadding="0" cellspacing="0" class="orderSmall">
														    <tr>
                                                                <td align="center">18</td>
                                                                <td align="center">17</td>
                                                                <td align="center">16</td>
                                                                <td align="center">15</td>
                                                                <td align="center">14</td>
                                                                <td align="center">13</td>
                                                                <td align="center">12</td>
                                                                <td align="center">11</td>
                                                            </tr>
                                                              <tr>
                                                                <td width="47" height="47" align="center"><div id="teethImgR0"></div>
                                                                    <script>onMouseOutTeethR(0);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR1"></div>
                                                                    <script>onMouseOutTeethR(1);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR2"></div>
                                                                    <script>onMouseOutTeethR(2);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR3"></div>
                                                                    <script>onMouseOutTeethR(3);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR4"></div>
                                                                    <script>onMouseOutTeethR(4);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR5"></div>
                                                                    <script>onMouseOutTeethR(5);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR6"></div>
                                                                    <script>onMouseOutTeethR(6);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR7"></div>
                                                                    <script>onMouseOutTeethR(7);</script></td>
                                                              </tr>

                                                          </table></td>
                                                          
                                                          <td><table border="0" cellpadding="0" cellspacing="0" class="orderSmall">
                                                              <tr>
                                                                <td align="center">21</td>
                                                                <td align="center">22</td>
                                                                <td align="center">23</td>
                                                                <td align="center">24</td>
                                                                <td align="center">25</td>
                                                                <td align="center">26</td>
                                                                <td align="center">27</td>
                                                                <td align="center">28</td>
                                                              </tr>                                                              <tr>
                                                                <td width="47" height="47" align="center"><div id="teethImgR8"></div>
                                                                    <script>onMouseOutTeethR(8);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR9"></div>
                                                                    <script>onMouseOutTeethR(9);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR10"></div>
                                                                    <script>onMouseOutTeethR(10);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR11"></div>
                                                                    <script>onMouseOutTeethR(11);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR12"></div>
                                                                    <script>onMouseOutTeethR(12);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR13"></div>
                                                                    <script>onMouseOutTeethR(13);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR14"></div>
                                                                    <script>onMouseOutTeethR(14);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR15"></div>
                                                                    <script>onMouseOutTeethR(15);</script></td>
                                                              </tr>

                                                          </table></td>
                                                        </tr>
                                                        <tr>
                                                          <td height="1" colspan="2" bgcolor="#003399"></td>
                                                        </tr>
                                                        <tr>
                                                          <td align="right"><table border="0" cellpadding="0" cellspacing="0" class="orderSmall">

                                                              <tr>
                                                                <td width="47" height="47" align="center"><div id="teethImgR16"></div>
                                                                    <script>onMouseOutTeethR(16);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR17"></div>
                                                                    <script>onMouseOutTeethR(17);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR18"></div>
                                                                    <script>onMouseOutTeethR(18);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR19"></div>
                                                                    <script>onMouseOutTeethR(19);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR20"></div>
                                                                    <script>onMouseOutTeethR(20);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR21"></div>
                                                                    <script>onMouseOutTeethR(21);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR22"></div>
                                                                    <script>onMouseOutTeethR(22);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR23"></div>
                                                                    <script>onMouseOutTeethR(23);</script></td>
                                                              </tr>
                                                               <tr>
                                                                <td align="center">38</td>
                                                                <td align="center">37</td>
                                                                <td align="center">36</td>
                                                                <td align="center">35</td>
                                                                <td align="center">34</td>
                                                                <td align="center">33</td>
                                                                <td align="center">32</td>
                                                                <td align="center">31</td>
                                                              </tr>                                                         </table></td>
                                                          
                                                          <td><table border="0" cellpadding="0" cellspacing="0" class="orderSmall">

                                                              <tr>
                                                                <td width="47" height="47" align="center"><div id="teethImgR24"></div>
                                                                    <script>onMouseOutTeethR(24);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR25"></div>
                                                                    <script>onMouseOutTeethR(25);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR26"></div>
                                                                    <script>onMouseOutTeethR(26);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR27"></div>
                                                                    <script>onMouseOutTeethR(27);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR28"></div>
                                                                    <script>onMouseOutTeethR(28);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR29"></div>
                                                                    <script>onMouseOutTeethR(29);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR30"></div>
                                                                    <script>onMouseOutTeethR(30);</script></td>
                                                                <td width="47" height="47" align="center"><div id="teethImgR31"></div>
                                                                    <script>onMouseOutTeethR(31);</script></td>
                                                              </tr>
                                                               <tr>
                                                                <td align="center">41</td>
                                                                <td align="center">42</td>
                                                                <td align="center">43</td>
                                                                <td align="center">44</td>
                                                                <td align="center">45</td>
                                                                <td align="center">46</td>
                                                                <td align="center">47</td>
                                                                <td align="center">48</td>
                                                              </tr>                                                         </table></td>
                                                        </tr>
                                                      </table>
													  <table width="760" border="0" cellpadding="0" cellspacing="0">
                                                        <tr>
                                                          <td><table width="48" height="48" border="0" cellspacing="0" cellpadding="0">
                                                            <tr>
                                                              <td><div id="teethImgR33"></div>
                                                                    <script>onMouseOutTeethR(33);</script></td>
                                                            </tr>
                                                          </table></td>
                                                          <td>&nbsp;</td>
                                                          <td height="32">&nbsp;</td>
                                                        </tr>
                                                      </table>
                                                      <br><br>
                                                      <table width="95%" border="0" cellspacing="0" cellpadding="2">
                                                        <tr>
                                                          <td width="260" valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#FFCC33">
                                                            <tr>
                                                              <td height="20" bgcolor="#FFFF99" class="TableHeadingNormal">&nbsp;&nbsp;TP</td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#FFFFFF" class="orderSmall">
															  <div >
															  
															  <table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                                  <tr>
                                                                    <td width="20"><input type="checkbox" name="checkbox325" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_tp_tryin.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall">Essayage</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td width="20" bgcolor="#FFFFCC"><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td width="32" bgcolor="#FFFFCC"><img src="../resource/images/eorder/remove/d_tp.gif" width="32" height="32" /></td>
                                                                    <td bgcolor="#FFFFCC" class="orderSmall">Finition direct</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td width="20"><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td width="32"><img src="../resource/images/eorder/remove/d_tp.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall">Finition (retour d'essayage)</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td width="20" bgcolor="#FFFFCC"><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td width="32" bgcolor="#FFFFCC"><img src="../resource/images/eorder/remove/d_tp_hurry.gif" width="32" height="32" /></td>
                                                                    <td bgcolor="#FFFFCC" class="orderSmall">Appareile provisoire</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td width="20"><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td width="32"><img src="../resource/images/eorder/remove/d_ackers.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall">Ackers Acetal</td>
                                                                  </tr>
																  

                                                              </table>
															  </div>
															  </td>
                                                            </tr>
                                                          </table></td>
                                                          <td rowspan="3" align="center" valign="bottom"><table width="300" border="0" cellpadding="0" cellspacing="1" bgcolor="#FFCC33">
                                                            <tr>
                                                              <td height="20" bgcolor="#FFFF99"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                                                                  <tr>
                                                                    <td class="TableHeadingNormal">&nbsp;&nbsp;Shade</td>
                                                                    <td align="right"><input name="button2" type="button" id="button" style="width:40;height:18;font-size:9px" onClick="popup_selectcolor(1);" value="Select"></td>
                                                                  </tr>
                                                              </table></td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#FFFFFF" class="orderSmall" style="font-size:10px" height=20><div class="TableHeadingNormal" id="selectedcolorR">&nbsp;No shade select</div></td>
                                                            </tr>
                                                            <tr>
                                                              <td height="100" align="center" bgcolor="#FFFFFF"><table border="0" cellspacing="5" cellpadding="0">
                                                                  <tr>
                                                                    <td id="removecolorpreview" bgcolor="#CCCCCC"><a href="javascript:popup_selectcolor(1);"><img src="../resource/images/eorder/teeth/preview2.gif" width="91" height="56" border="0"></a></td>
                                                                  </tr>
                                                              </table></td>
                                                            </tr>
                                                          </table>                                                            
                                                            <br>
                                                            <br>
                                                            <br>
                                                            <br>
                                                          <img src="../resource/images/eorder/remove/teeth.jpg" width="140" height="254"></td>
                                                          <td width="260" align="right" valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#FFCC33">
                                                            <tr>
                                                              <td height="20" bgcolor="#FFFF99" class="TableHeadingNormal">&nbsp;&nbsp;Vitaflex</td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#FFFFFF" class="orderSmall"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                                  <tr>
                                                                    <td><input type="checkbox" name="checkbox325" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_vitaflex_tryin.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall">Essayage dent sur cire</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td bgcolor="#FFFFCC"><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td bgcolor="#FFFFCC"><img src="../resource/images/eorder/remove/d_vitaflex.gif" width="32" height="32" /></td>
                                                                    <td bgcolor="#FFFFCC" class="orderSmall">Finition direct</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_vitaflex.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall">Retour d'essayage</td>
                                                                  </tr>
                                                                  

                                                              </table></td>
                                                            </tr>
                                                          </table></td>
                                                        </tr>
                                                        <tr>
                                                          <td width="260" valign="bottom">&nbsp;</td>
                                                          <td width="260" align="right" valign="bottom">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td width="260" valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#FFCC33">
                                                            <tr>
                                                              <td height="20" bgcolor="#FFFF99" class="TableHeadingNormal">&nbsp;&nbsp;Repair</td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#FFFFFF" class="orderSmall"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                                  <tr>
                                                                    <td><input type="checkbox" name="checkbox325" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_repair.gif" width="32" height="32" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_fullresine.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall">Adjonction de dent</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td bgcolor="#FFFFCC"><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td bgcolor="#FFFFCC"><img src="../resource/images/eorder/remove/d_repair.gif" width="32" height="32" /></td>
                                                                    <td bgcolor="#FFFFCC"><img src="../resource/images/eorder/remove/d_claspacetal.gif" width="32" height="32" /></td>
                                                                    <td bgcolor="#FFFFCC" class="orderSmall">Adjonction de Crochet acetal</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_repair.gif" width="32" height="32" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_claspmetal.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall">Adjonction de Crochet metal</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td bgcolor="#FFFFCC"><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td bgcolor="#FFFFCC"><img src="../resource/images/eorder/remove/d_cassure.gif" width="32" height="32" /></td>
                                                                    <td colspan="2" bgcolor="#FFFFCC" class="orderSmall">Cassure simple (Resine)</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_rebasage.gif" width="32" height="32" /></td>
                                                                    <td colspan="2" class="orderSmall">Rebasage partiel ou complet</td>
                                                                  </tr>
                                                                  
                                                                  <tr>
                                                                    <td bgcolor="#FFFFCC"><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td bgcolor="#FFFFCC"><img src="../resource/images/eorder/remove/d_soudure.gif" width="32" height="32" /></td>
                                                                    <td colspan="2" bgcolor="#FFFFCC" class="orderSmall">Soudure sur Stellite</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_renfort.gif" width="32" height="32" /></td>
                                                                    <td colspan="2" class="orderSmall">Renfort metal</td>
                                                                  </tr>
                                                                  

                                                              </table></td>
                                                            </tr>
                                                                                                                    </table></td>
                                                          <td width="260" align="right" valign="top"><table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#FFCC33">
                                                            <tr>
                                                              <td height="20" bgcolor="#FFFF99" class="TableHeadingNormal">&nbsp;&nbsp;RPD</td>
                                                            </tr>
                                                            <tr>
                                                              <td bgcolor="#FFFFFF" class="orderSmall"><table width="100%" border="0" cellspacing="0" cellpadding="2">
                                                                  <tr>
                                                                    <td><input type="checkbox" name="checkbox325" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_rpd_tryin.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall">&nbsp;</td>
                                                                    <td class="orderSmall">Essayage plaque</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td bgcolor="#FFFFCC"><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td bgcolor="#FFFFCC"><img src="../resource/images/eorder/remove/d_fullresine_tryin.gif" width="32" height="32" /></td>
                                                                    <td bgcolor="#FFFFCC" class="orderSmall">&nbsp;</td>
                                                                    <td bgcolor="#FFFFCC" class="orderSmall">Essayage dent sur cire</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_rpd_tryin.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall"><img src="../resource/images/eorder/remove/d_fullresine_tryin.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall">Essayage plaque + dents sur cire</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td bgcolor="#FFFFCC"><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td bgcolor="#FFFFCC"><img src="../resource/images/eorder/remove/d_rpd.gif" width="32" height="32" /></td>
                                                                    <td bgcolor="#FFFFCC" class="orderSmall">&nbsp;</td>
                                                                    <td bgcolor="#FFFFCC" class="orderSmall">Finition direct</td>
                                                                  </tr>
                                                                  <tr>
                                                                    <td><input type="checkbox" name="checkbox335" value="checkbox" /></td>
                                                                    <td><img src="../resource/images/eorder/remove/d_rpd.gif" width="32" height="32" /></td>
                                                                    <td class="orderSmall">&nbsp;</td>
                                                                    <td class="orderSmall"> Finition <br>
                                                                    (retour d'essayage)</td>
                                                                  </tr>
                                                                  
                                                                  

                                                              </table></td>
                                                            </tr>
                                                                                                                    </table></td>
                                                        </tr>
                                                        <tr>
                                                          <td valign="top">&nbsp;</td>
                                                          <td align="center" valign="bottom">&nbsp;</td>
                                                          <td align="right" valign="top">&nbsp;</td>
                                                        </tr>
                                                        <tr>
                                                          <td colspan="3" align="center" valign="top"><table border="0" cellpadding="2" cellspacing="1" bgcolor="#FFCC66">
                                                            <tr>
                                                              <td align="left" bgcolor="#FFFF99" class="TableHeadingNormal">&nbsp;&nbsp;&nbsp;&nbsp;Observations</td>
                                                            </tr>
                                                            <tr>
                                                              <td height="32" align="center" bgcolor="#FFFFFF" class="TableHeadingNormal"><textarea name="textarea" cols="80" rows="5"></textarea></td>
                                                            </tr>
                                                          </table></td>
                                                        </tr>
                                                        <tr>
                                                          <td valign="top">&nbsp;</td>
                                                          <td align="center" valign="bottom">&nbsp;</td>
                                                          <td align="right" valign="top">&nbsp;</td>
                                                        </tr>
                                                      </table>                                                      </td></tr>
                                                    <tr>
                                                      <td bgcolor="#FFFFFF">&nbsp;</td>
                                                    </tr>
                                                  </table></td>
  </tr>
</table>  	  </TD>
    </TR> 	
  </form>
</TABLE> 






</BODY>
</HTML>