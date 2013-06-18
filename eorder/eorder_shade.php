<script src="../resource/javascript/default.js"></script>
<link href="../cfrontend/default.css" rel="stylesheet" type="text/css" />
<div id="ShadeSelector"
 style="position:absolute; left:0px; top:0px; width:620px; height:400px; z-index:1; margin:0;<?="display:none;"?>">

 
 <table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td id="ShadeLabel1" width="100" height="30" align="center" class="menuOver"
    onclick="OpenShadeSelector(g_type,g_index,1)">
    Vita 3D Master</td>
    <td id="ShadeLabel2" width="100" height="30" align="center" class="menuOut" 
    onclick="OpenShadeSelector(g_type,g_index,2)">
    Vivodent PE    </td>
    <td id="ShadeLabel3" width="100" height="30" align="center" class="menuOut"
    onclick="OpenShadeSelector(g_type,g_index,3)">
    Vitaplan    </td>
    <td id="ShadeLabel4" width="100" height="30" align="center" class="menuOut" 
    onclick="OpenShadeSelector(g_type,g_index,4)">
    Cosmo HXL    </td>
    <td id="ShadeLabel5" width="100" height="30" align="center" class="menuOut"
    onclick="OpenShadeSelector(g_type,g_index,5)">
    Majadent   </td>
    <td id="ShadeLabel6" width="100" height="30" align="center" class="menuOut"
    onclick="OpenShadeSelector(g_type,g_index,6)">
    Shofu</td>    
    <td height="30" align="right" class="logout">&nbsp;</td>
  </tr>
</table>

<? $tbframeheader = ""?>
<? include "../cfrontend/tbframeh.php"?>
<table border="0" align="center" cellpadding="0" cellspacing="0" ><tr><td height="300">
<div id="Shade1"> 
    <table border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
      <tr>
        <td height="150" bgcolor="#FFFFFF"><table border="0" align="center" cellpadding="0" cellspacing="3">
            <tr align="center">
              <td onclick="SetShade(g_type,g_index,1013)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                0M3</td>
              <td width="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td width="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td onclick="SetShade(g_type,g_index,1213)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2M3</td>
              <td>&nbsp;</td>
              <td width="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td onclick="SetShade(g_type,g_index,1313)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                3M3</td>
              <td>&nbsp;</td>
              <td width="20">&nbsp;</td>
              <td>&nbsp;</td>
              <td onclick="SetShade(g_type,g_index,1413)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4M3</td>
              <td>&nbsp;</td>
              <td width="20">&nbsp;</td>
              <td onclick="SetShade(g_type,g_index,1513)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                5M3</td>
              </tr>
            
            <tr>
              <td align="center" onclick="SetShade(g_type,g_index,1012)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                0M2</td>
              <td width="20" align="center">&nbsp;</td>
              <td align="center" onclick="SetShade(g_type,g_index,1112)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                1M2</td>
              <td width="20" align="center">&nbsp;</td>
              <td align="center" onclick="SetShade(g_type,g_index,1202)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2L2.5</td>
              <td align="center" onclick="SetShade(g_type,g_index,1212)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2M2</td>
              <td align="center" onclick="SetShade(g_type,g_index,1222)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2R2.5</td>
              <td width="20" align="center">&nbsp;</td>
              <td align="center" onclick="SetShade(g_type,g_index,1302)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                3L2.5</td>
              <td align="center" onclick="SetShade(g_type,g_index,1312)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                3M2</td>
              <td align="center" onclick="SetShade(g_type,g_index,1322)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                3R2.5</td>
              <td width="20" align="center">&nbsp;</td>
              <td align="center" onclick="SetShade(g_type,g_index,1402)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4L2.5</td>
              <td align="center" onclick="SetShade(g_type,g_index,1412)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4M2</td>
              <td align="center" onclick="SetShade(g_type,g_index,1422)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4R2.5</td>
              <td width="20" align="center">&nbsp;</td>
              <td align="center" onclick="SetShade(g_type,g_index,1512)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                5M2</td>
              </tr>
            
            <tr>
              <td align="center" onclick="SetShade(g_type,g_index,1011)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                0M1</td>
              <td width="20" align="center">&nbsp;</td>
              <td align="center" onclick="SetShade(g_type,g_index,1111)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                1M1</td>
              <td width="20" align="center">&nbsp;</td>
              <td align="center" onclick="SetShade(g_type,g_index,1201)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2L1.5</td>
              <td align="center" onclick="SetShade(g_type,g_index,1211)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2M1</td>
              <td align="center" onclick="SetShade(g_type,g_index,1221)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2R1.5</td>
              <td width="20" align="center">&nbsp;</td>
              <td align="center" onclick="SetShade(g_type,g_index,1301)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                3L1.5</td>
              <td align="center" onclick="SetShade(g_type,g_index,1311)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                3M1</td>
              <td align="center" onclick="SetShade(g_type,g_index,1321)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                3R1.5</td>
              <td width="20" align="center">&nbsp;</td>
              <td align="center" onclick="SetShade(g_type,g_index,1401)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4L1.5</td>
              <td align="center" onclick="SetShade(g_type,g_index,1411)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4M1</td>
              <td align="center" onclick="SetShade(g_type,g_index,1421)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4R1.5</td>
              <td width="20" align="center">&nbsp;</td>
              <td align="center" onclick="SetShade(g_type,g_index,1511)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                5M1</td>
              </tr>
            
          </table>
            <br />
            <br />
            <h1 align="right"> Vita 3D Master</h1></td>
      </tr>
    </table>
</div>
<div id="Shade2"> 
    <table border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
      <tr>
        <td height="150" bgcolor="#FFFFFF"><table border="0" align="center" cellpadding="0" cellspacing="5">
            <tr align="center">
              <td onclick="SetShade(g_type,g_index,2110)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                01/110<br /></td>
              <td onclick="SetShade(g_type,g_index,2120)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                1A/120</td>
              <td onclick="SetShade(g_type,g_index,2130)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2A/130</td>
              <td onclick="SetShade(g_type,g_index,2140)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                1C/140</td>
              <td onclick="SetShade(g_type,g_index,2210)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2B/210</td>
              <td onclick="SetShade(g_type,g_index,2220)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                1D/220</td>
              <td onclick="SetShade(g_type,g_index,2230)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                1E/230</td>
              <td onclick="SetShade(g_type,g_index,2240)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2C/240</td>
              <td onclick="SetShade(g_type,g_index,2310)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                3A/310</td>
              <td onclick="SetShade(g_type,g_index,2320)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                5B/320</td>
              </tr>
            <tr align="center">
              <td onclick="SetShade(g_type,g_index,2330)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                2E/330</td>
              <td onclick="SetShade(g_type,g_index,2340)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                3E/340</td>
              <td onclick="SetShade(g_type,g_index,2410)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4A/410</td>
              <td onclick="SetShade(g_type,g_index,2420)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                6B/420</td>
              <td onclick="SetShade(g_type,g_index,2430)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4B/430</td>
              <td onclick="SetShade(g_type,g_index,2440)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                6C/440</td>
              <td onclick="SetShade(g_type,g_index,2510)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                6D/510</td>
              <td onclick="SetShade(g_type,g_index,2520)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4C/520</td>
              <td onclick="SetShade(g_type,g_index,2530)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                3C/530</td>
              <td onclick="SetShade(g_type,g_index,2540)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
                4D/540</td>
              </tr>
          </table>
            <br />
            <br />
            <h1 align="right"> Vivodent PE</h1></td>
      </tr>
    </table>
</div>
<div id="Shade3" >
    <table border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
      <tr>
        <td height="150" bgcolor="#FFFFFF"><table border="0" align="center" cellpadding="0" cellspacing="3">
          <tr align="center">
            <td onclick="SetShade(g_type,g_index,3110)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A1</td>
            <td onclick="SetShade(g_type,g_index,3120)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A2</td>
            <td onclick="SetShade(g_type,g_index,3130)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A3</td>
            <td onclick="SetShade(g_type,g_index,3135)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A3.5</td>
            <td onclick="SetShade(g_type,g_index,3140)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A4</td>
            <td onclick="SetShade(g_type,g_index,3210)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B1</td>
            <td onclick="SetShade(g_type,g_index,3220)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B2</td>
            <td onclick="SetShade(g_type,g_index,3230)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B3</td>
            <td onclick="SetShade(g_type,g_index,3240)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B4</td>
            <td onclick="SetShade(g_type,g_index,3310)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C1</td>
            <td onclick="SetShade(g_type,g_index,3320)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C2</td>
            <td onclick="SetShade(g_type,g_index,3330)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C3</td>
            <td onclick="SetShade(g_type,g_index,3340)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C4</td>
            <td onclick="SetShade(g_type,g_index,3420)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              D2</td>
            <td onclick="SetShade(g_type,g_index,3430)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              D3</td>
            <td onclick="SetShade(g_type,g_index,3440)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              D4</td>
          </tr>
        </table>
          <br />
            <br />
            <h1 align="right"> Vitaplan</h1></td>
      </tr>
    </table>
</div>
<div id="Shade4"> 
    <table border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
      <tr>
        <td height="150" bgcolor="#FFFFFF"><table border="0" align="center" cellpadding="0" cellspacing="3">
          <tr align="center">
            <td onclick="SetShade(g_type,g_index,4110)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A1</td>
            <td onclick="SetShade(g_type,g_index,4120)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A2</td>
            <td onclick="SetShade(g_type,g_index,4130)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A3</td>
            <td onclick="SetShade(g_type,g_index,4135)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A3.5</td>
            <td onclick="SetShade(g_type,g_index,4140)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A4</td>
            <td onclick="SetShade(g_type,g_index,4210)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B1</td>
            <td onclick="SetShade(g_type,g_index,4220)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B2</td>
            <td onclick="SetShade(g_type,g_index,4230)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B3</td>
            <td onclick="SetShade(g_type,g_index,4240)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B4</td>
            <td onclick="SetShade(g_type,g_index,4310)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C1</td>
            <td onclick="SetShade(g_type,g_index,4320)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C2</td>
            <td onclick="SetShade(g_type,g_index,4330)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C3</td>
            <td onclick="SetShade(g_type,g_index,4340)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C4</td>
            <td onclick="SetShade(g_type,g_index,4420)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              D2</td>
            <td onclick="SetShade(g_type,g_index,4430)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              D3</td>
            <td onclick="SetShade(g_type,g_index,4440)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              D4</td>
          </tr>
        </table>
          <br />
            <br />
            <h1 align="right">Cosmo HXL</h1></td>
      </tr>
    </table>
</div>
<div id="Shade5">
    <table border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
      <tr>
        <td height="150" bgcolor="#FFFFFF"><table border="0" align="center" cellpadding="0" cellspacing="3">
          <tr align="center">
            <td onclick="SetShade(g_type,g_index,5203)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              2C</td>
            <td onclick="SetShade(g_type,g_index,5104)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              1D</td>
            <td onclick="SetShade(g_type,g_index,5304)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              3D</td>
            <td onclick="SetShade(g_type,g_index,5504)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              5D</td>
            <td onclick="SetShade(g_type,g_index,5106)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              1F</td>
            <td onclick="SetShade(g_type,g_index,5306)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              3F</td>
            <td onclick="SetShade(g_type,g_index,5406)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              4F</td>
            <td onclick="SetShade(g_type,g_index,5212)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              2L</td>
            <td onclick="SetShade(g_type,g_index,5412)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              4L</td>
            <td onclick="SetShade(g_type,g_index,5118)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              1R</td>
            <td onclick="SetShade(g_type,g_index,5318)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              3R</td>
            <td onclick="SetShade(g_type,g_index,5403)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              4C</td>
            <td onclick="SetShade(g_type,g_index,5503)" style="cursor:pointer"><img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              5C</td>
            </tr>
        </table>
          <br />
            <br />
            <h1 align="right">Majadent</h1></td>
      </tr>
    </table>
</div>
<div id="Shade6" >
    <table border="0" align="center" cellpadding="5" cellspacing="1" bgcolor="#000000">
      <tr>
        <td height="150" bgcolor="#FFFFFF"><table border="0" align="center" cellpadding="0" cellspacing="3">
          <tr align="center">
            <td onclick="SetShade(g_type,g_index,6110)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A1</td>
            <td onclick="SetShade(g_type,g_index,6120)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A2</td>
            <td onclick="SetShade(g_type,g_index,6130)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A3</td>
            <td onclick="SetShade(g_type,g_index,6135)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A3.5</td>
            <td onclick="SetShade(g_type,g_index,6140)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              A4</td>
            <td onclick="SetShade(g_type,g_index,6210)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B1</td>
            <td onclick="SetShade(g_type,g_index,6220)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B2</td>
            <td onclick="SetShade(g_type,g_index,6230)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B3</td>
            <td onclick="SetShade(g_type,g_index,6240)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              B4</td>
            <td onclick="SetShade(g_type,g_index,6310)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C1</td>
            <td onclick="SetShade(g_type,g_index,6320)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C2</td>
            <td onclick="SetShade(g_type,g_index,6330)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C3</td>
            <td onclick="SetShade(g_type,g_index,6340)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              C4</td>
            <td onclick="SetShade(g_type,g_index,6420)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              D2</td>
            <td onclick="SetShade(g_type,g_index,6430)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              D3</td>
            <td onclick="SetShade(g_type,g_index,6440)" style="cursor:pointer">
            <img src="../resource/images/eorder/teeth/shade.gif" width="30" height="47" /><br />
              D4</td>
          </tr>
        </table>
          <br />
            <br />
            <h1 align="right"> Shofu</h1></td>
      </tr>
    </table>
</div>
</td></tr></table>



<table width="100%" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>
        <td width="50" align="center" class="tdButtonOnOut"
        onclick="NoneShadeSelector()" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'">None</td>
      </tr>
    </table></td>
    <td align="right"><table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="CloseShadeSelector()"> <img src="../resource/images/silkicons/cross.gif" width="16" height="16" />Close </td>
      </tr>
    </table></td>
    </tr>
</table>
<? include "../cfrontend/tbframef.php"?>

</div>
<script type="text/javascript">
<!--

var g_type;
var g_index;
var g_lastbrand = 1;
function OpenShadeSelector(type,index,brand){//type:fix,remove,index:0-3
	g_type = type;
	g_index = index;
	brand = parseInt(brand);
	if(brand==-1)
	{
		value = ''+getValue(type+'_shade['+index+']');
		brand = value.substring(0,1);
		//alert("debug"+brand);
		brand = parseInt(brand);
		if(brand==0)
		{
			brand = g_lastbrand;
		}
		//alert("debug"+value);
	}
	makeCenterScreen('ShadeSelector');
	showHideLayers('ShadeSelector','','show');
	showHideLayers('Shade1','',brand==1?'show':'hide');
	showHideLayers('Shade2','',brand==2?'show':'hide');
	showHideLayers('Shade3','',brand==3?'show':'hide');
	showHideLayers('Shade4','',brand==4?'show':'hide');
	showHideLayers('Shade5','',brand==5?'show':'hide');
	showHideLayers('Shade6','',brand==6?'show':'hide');
//	background-image: url(../cfrontend/images/tabout.png);
	findObj('ShadeLabel1').style.background = brand==1?'url(../cfrontend/images/tabover.gif)':'url(../cfrontend/images/tabout.gif)';
	findObj('ShadeLabel2').style.background = brand==2?'url(../cfrontend/images/tabover.gif)':'url(../cfrontend/images/tabout.gif)';
	findObj('ShadeLabel3').style.background = brand==3?'url(../cfrontend/images/tabover.gif)':'url(../cfrontend/images/tabout.gif)';
	findObj('ShadeLabel4').style.background = brand==4?'url(../cfrontend/images/tabover.gif)':'url(../cfrontend/images/tabout.gif)';
	findObj('ShadeLabel5').style.background = brand==5?'url(../cfrontend/images/tabover.gif)':'url(../cfrontend/images/tabout.gif)';
	findObj('ShadeLabel6').style.background = brand==6?'url(../cfrontend/images/tabover.gif)':'url(../cfrontend/images/tabout.gif)';			

	
	g_lastbrand = brand;
	//SetScrollbarEnable(false);
	activeBG();	
}
function SetShade(type,index,idvalue)
{
	setValue(type+'_shade['+index+']',idvalue);
	idvalue = parseInt(idvalue);
	var shadename='None';
	//var txtshadeid = new array();
	switch(idvalue){
	<? for($i=0;$i<count($txtshadeid);$i++){?>
		case <?=$txtshadeid[$i]?>:shadename='<?=$txtshadename[$i]?>';break;
		<? //txtshadecolor[i] = <?=$txtshadecolor[$i] ?>;
	<? }?>
	}
	if(findObj('TDShadeText'+type+''+index+''))
		writeit('TDShadeText'+type+''+index+'',shadename);
	//alert(type+index+idvalue);
	if(idvalue+0!=0){
		if(parseInt(getValue(type+'_shade[0]'))=='0')SetShade(type,0,idvalue);
		if(parseInt(getValue(type+'_shade[1]'))=='0')SetShade(type,1,idvalue);
		if(parseInt(getValue(type+'_shade[2]'))=='0')SetShade(type,2,idvalue);
		if(parseInt(getValue(type+'_shade[3]'))=='0')SetShade(type,3,idvalue);
	}
	CloseShadeSelector();
}
function CloseShadeSelector(){
	showHideLayers('ShadeSelector','','hide');
	//SetScrollbarEnable(true);
	hideBG();
}
function NoneShadeSelector(){
	SetShade(g_type,g_index,0);
	CloseShadeSelector();
}
//-->
</script>


