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

<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<? // ------------------------------------------------------------------------------- ?>
<div id="DivAttachmentSelector" style="position:absolute; white-space:nowrap; left:0px; top:0px; width:400px; height:500px; z-index:1; margin:0;<?="display:none;"?>">
<? $tbframeheader = "Attachment selector"?>
<? $tbframehclose = "CloseDivAttachmentSelector()";?>
<? include "../cfrontend/tbframeh.php"?><br />


<table border="0" align="center" cellpadding="2" cellspacing="1">
<tr>
	<td>
    
	  <table border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="150" align="right"><table width="100%" border="0" cellpadding="0" cellspacing="0">

            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(11)">
                    <tr>
                      <td width="24" height="24" align="center">11</td>
                      <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach11" width="24" height="24" id="ImgAttach11" /></td>
                      </tr>
                  </table></td>
                  <td width="3" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(12)">
                    <tr>
                      <td width="24" height="24" align="center">12</td>
                      <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach12" width="24" height="24" id = "ImgRemoveMaterial12" /></td>
                      </tr>
                  </table></td>
                  <td width="28" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(13)">
                    <tr>
                      <td width="24" height="24" align="center">13</td>
                      <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach13" width="24" height="24" id="ImgAttach13" /></td>
                      </tr>
                  </table></td>
                  <td width="51" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(14)">
                    <tr>
                      <td width="24" height="24" align="center">14</td>
                      <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach14" width="24" height="24" id="ImgAttach14" /></td>
                      </tr>
                  </table></td>
                  <td width="64" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(15)">
                <tr>
                  <td width="24" align="center">15</td>
                  <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach15" width="24" height="24" id="ImgAttach15" /></td>
                  </tr>
                  </table></td>
                  <td width="76" height="24">&nbsp;</td> 
                 </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(16)">
                    <tr>
                      <td width="24" height="24" align="center">16</td>
                      <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach16" width="24" height="24" id="ImgAttach16" /></td>
                      </tr>
                  </table></td>
                  <td width="85" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(17)">
                    <tr>
                      <td width="24" height="24" align="center">17</td>
                      <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach17" width="24" height="24" id="ImgAttach17" /></td>
                      </tr>
                  </table></td>
                  <td width="91" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(18)">
                    <tr>
                      <td width="24" height="24" align="center">18</td>
                      <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach18" width="24" height="24" id="ImgAttach18" /></td>
                      </tr>
                  </table></td>
                  <td width="97" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td width="150"><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="3">&nbsp;</td>
                    <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(21)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach21" width="24" height="24" id="ImgAttach21" /></td>
                        <td width="24" align="center">21</td>
                        </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="28">&nbsp;</td>
                    <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(22)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach22" width="24" height="24" id="ImgAttach22" /></td>
                        <td width="24" align="center">22</td>
                        </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="51">&nbsp;</td>
                    <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(23)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach23" width="24" height="24" id="ImgAttach23" /></td>
                        <td width="24" align="center">23</td>
                        </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="64" height="28">&nbsp;</td>
                    <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(24)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach24" width="24" height="24" id="ImgAttach24" /></td>
                        <td width="24" align="center">24</td>
                        </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="76">&nbsp;</td>
                    <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(25)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach25" width="24" height="24" id="ImgAttach25" /></td>
                        <td width="24" align="center">25</td>
                        </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="85">&nbsp;</td>
                  <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(26)">
                    <tr>
                      <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach26" width="24" height="24" id="ImgAttach26" /></td>
                      <td width="24" align="center">26</td>
                      </tr>
                  </table></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="91">&nbsp;</td>
                  <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(27)">
                    <tr>
                      <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach27" width="24" height="24" id="ImgAttach27" /></td>
                      <td width="24" align="center">27</td>
                      </tr>
                  </table></td>
                  </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="97">&nbsp;</td>
                    <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(28)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach28" width="24" height="24" id="ImgAttach28" /></td>
                        <td width="24" align="center">28</td>
                        </tr>
                    </table></td>
                    </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
        <tr>
          <td height="16">&nbsp;</td>
          <td height="16">&nbsp;</td>
        </tr>
        <tr>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="24" align="right"><table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td align="right"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(38)">
                      <tr>
                        <td width="24" height="24" align="center">38</td>
                        <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach38" width="24" height="24" id="ImgAttach38" /></td>
                      </tr>
                  </table></td>
                  <td width="97" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(37)">
                      <tr>
                        <td width="24" height="24" align="center">37</td>
                        <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach37" width="24" height="24" id="ImgAttach37" /></td>
                      </tr>
                  </table></td>
                  <td width="91" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(36)">
                      <tr>
                        <td width="24" height="24" align="center">36</td>
                        <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach36" width="24" height="24" id="ImgAttach36" /></td>
                      </tr>
                  </table></td>
                  <td width="85" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(35)">
                      <tr>
                        <td width="24" align="center">35</td>
                        <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach35" width="24" height="24" id="ImgAttach35" /></td>
                      </tr>
                  </table></td>
                  <td width="76" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(34)">
                      <tr>
                        <td width="24" height="24" align="center">34</td>
                        <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach34" width="24" height="24" id="ImgAttach34" /></td>
                      </tr>
                  </table></td>
                  <td width="64" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(33)">
                      <tr>
                        <td width="24" height="24" align="center">33</td>
                        <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach33" width="24" height="24" id="ImgAttach33" /></td>
                      </tr>
                  </table></td>
                  <td width="51" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(32)">
                      <tr>
                        <td width="24" height="24" align="center">32</td>
                        <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach32" width="24" height="24" id="ImgAttach32" /></td>
                      </tr>
                  </table></td>
                  <td width="28" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="right"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td align="center"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(31)">
                      <tr>
                        <td width="24" height="24" align="center">31</td>
                        <td width="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach31" width="24" height="24" id="ImgAttach31" /></td>
                      </tr>
                  </table></td>
                  <td width="3" height="24">&nbsp;</td>
                </tr>
              </table></td>
            </tr>
          </table></td>
          <td><table width="100%" border="0" cellpadding="0" cellspacing="0">
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="97">&nbsp;</td>
                  <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(48)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach48" width="24" height="24" id="ImgAttach48" /></td>
                        <td width="24" align="center">48</td>
                        </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="91">&nbsp;</td>
                  <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(47)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach47" width="24" height="24" id="ImgAttach47" /></td>
                        <td width="24" align="center">47</td>
                        </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="85">&nbsp;</td>
                  <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(46)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach46" width="24" height="24" id="ImgAttach46" /></td>
                        <td width="24" align="center">46</td>
                        </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="76">&nbsp;</td>
                  <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(45)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach45" width="24" height="24" id="ImgAttach45" /></td>
                        <td width="24" align="center">45</td>
                        </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="64" height="28">&nbsp;</td>
                  <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(44)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach44" width="24" height="24" id="ImgAttach44" /></td>
                        <td width="24" align="center">44</td>
                        </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="51">&nbsp;</td>
                  <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(43)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach43" width="24" height="24" id="ImgAttach43" /></td>
                        <td width="24" align="center">43</td>
                        </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="28">&nbsp;</td>
                  <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(42)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach42" width="24" height="24" id="ImgAttach42" /></td>
                        <td width="24" align="center">42</td>
                        </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
            <tr>
              <td height="24" align="left"><table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="3">&nbsp;</td>
                  <td height="24"><table border="0" cellspacing="0" cellpadding="0" 
                  onmouseover="this.className='btnTeethSelectC'" onmouseout="this.className=''"
        		  onclick="attach_set(41)">
                      <tr>
                        <td width="24" height="24"><img src="../resource/images/eorder/attach/unattach.gif" name="ImgAttach41" width="24" height="24" id="ImgAttach41" /></td>
                        <td width="24" align="center">41</td>
                        </tr>
                  </table></td>
                </tr>
              </table></td>
            </tr>
          </table></td>
        </tr>
      </table>
</td>
</tr>
</table>
<br />
<? include "../cfrontend/tbframef.php"?>
</div>
<?php
//echo $name[0] . " ".$image[0]." ".$idvalue[0]." ".$description[0];
?>
<script type="text/javascript">
var attach_material_select;

function attach_set(teethnumber)
{
	attach_material_select = teethnumber;
	isSelect = findObj(g_attach_part+'_attachment['+teethnumber+']').value;
	//alert (teethnumber);
	
	if(isSelect == 1){
		//alert('unattach');
		findObj(g_attach_part+'_attachment['+teethnumber+']').value = 0;
		findObj('ImgAttach'+teethnumber).src = '../resource/images/eorder/attach/unattach.gif';
	}else{
		//alert('attach');
		findObj(g_attach_part+'_attachment['+teethnumber+']').value = 1;
		findObj('ImgAttach'+teethnumber).src = '../resource/images/eorder/attach/attach.gif';
	}
}
var g_attach_part;
function OpenDivAttachmentSelector(part)
{
	g_attach_part = part;
	
	for(var i=1;i<5;i++){
		for(var j=1;j<8;j++){
			var teethnumber = (i*10)+j;
			isSelect = findObj(g_attach_part+'_attachment['+teethnumber+']').value;
			if(isSelect == 1){
				findObj('ImgAttach'+teethnumber).src = '../resource/images/eorder/attach/attach.gif';
			}else{
				findObj('ImgAttach'+teethnumber).src = '../resource/images/eorder/attach/unattach.gif';
			}
		}
	}
	
	
	activeBG();
	makeCenterScreen('DivAttachmentSelector');
	showHideLayers('DivAttachmentSelector','','show');
}


function CloseDivAttachmentSelector()
{
	hideBG();
	showHideLayers('DivAttachmentSelector','','hide');
}

showHideLayers('DivAttachmentSelector','','hide');

</script>


