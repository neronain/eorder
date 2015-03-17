<? include "../cfrontend/tbframe2h.php" ?>
            <span style="font-size: 18px"><strong>Option</strong></span><br />
<hr width="270" />

<!-- RPD Acrylic For Finish -->
<div id = "TABLE_Work">
<table  width="285" align="center" cellpadding="3" cellspacing="0" class="Normal" >
  <tr>
    <td><span style="font-size: 18px"><strong>
      Work</strong></span></td>
  </tr>
  <tr>
    <td>
    <div>
    <label><input name="tmpRadioWork" type="radio" onchange="setValue('remove_option[Removework]','Try-in frame');setValue('remove_method','Try-in');" value="Try-in frame" <?= ($remove_option["Removework"] == "Try-in frame") ? " checked" : " " ?>/>
    Try in frame</label>
    <br />
    <label><input name="tmpRadioWork" type="radio" onchange="setValue('remove_option[Removework]','Bite Block');setValue('remove_method','BiteBlock');" value="Setup teeth" <?= ($remove_option["Removework"] == "Bite Block") ? " checked" : " " ?>/>
    Bite Block</label>
    <br />
    <label><input name="tmpRadioWork" type="radio" onchange="setValue('remove_option[Removework]','Setup teeth');setValue('remove_method','Setup');" value="Setup teeth" <?= ($remove_option["Removework"] == "Setup teeth") ? " checked" : " " ?>/>
    Setup teeth</label>
    <br />
    <label><input name="tmpRadioWork" type="radio" onchange="setValue('remove_option[Removework]','Finish');setValue('remove_method','Finish');" value="Finish" <?= ($remove_option["Removework"] == "Finish") ? " checked" : " " ?>/>
    Finish</label>
    <br />
    <label><input name="tmpRadioWork" type="radio" id = "tmpRadioWorkRepair" onchange="setValue('remove_option[Removework]','Repair');setValue('remove_method','Repair');" value="Repair" <?= ($remove_option["Removework"] == "Repair") ? " checked" : " " ?>/>
    Repair</label>
    <br />
    <label><input name="tmpRadioWork" type="radio" id = "tmpRadioWorkRemake & Finish" onchange="setValue('remove_option[Removework]','Remake & Finish');setValue('remove_method','Remake & Finish');" value="Remake & Finish" <?= ($remove_option["Removework"] == "Remake & Finish") ? " checked" : " " ?>/>
    Remake and Finish</label>
    </div>
  </td>
        </tr></table>
        </div>


<!-- RPD Acrylic For Finish -->
<div id = "TABLE_RPD_ACRYLICFORFINISH">
<table  width="285" align="center" cellpadding="3" cellspacing="0" class="Normal" >
  <tr>
    <td><strong>
      <input name="RPDAcrylicEnable" id="RPDAcrylicEnable"  type="checkbox" onchange="findObj('DivRPDAcrylic').style.display=(this.checked?'inline':'none');if(!this.checked){setValue('remove_option[RPDAcrylic]','None');}" <?=$remove_option["RPDAcrylic"] != "None"?" checked":""?> />
      RPD Acrylic For Finish</strong></td>
  </tr>
  <tr>
    <td>
    <div id="DivRPDAcrylic" <?=$remove_option["RPDAcrylic"] == "None"?" style=\"display:none\"":""?> >
    <label><input name="tmpRadio1" type="radio" onchange="setValue('remove_option[RPDAcrylic]','AcrylicPalaPress');" value="AcrylicPalaPress" <?= ($remove_option["RPDAcrylic"] == "AcrylicPalaPress") ? " checked" : " " ?>/>
    Acrylic Pala Press (Pola)</label><br />
    <label><input name="tmpRadio1" type="radio" onchange="setValue('remove_option[RPDAcrylic]','AcrylicInvocap');" value="AcrylicInvocap" <?= ($remove_option["RPDAcrylic"] == "AcrylicInvocap") ? " checked" : " " ?>/>
    Acrylic Invocap</label><br />
    <label><input name="tmpRadio1" type="radio" onchange="setValue('remove_option[RPDAcrylic]','Nylon');" value="Nylon" <?= ($remove_option["RPDAcrylic"] == "Nylon") ? " checked" : " " ?>/>
    Nylon</label><br />
    <label><input name="tmpRadio1" type="radio" onchange="setValue('remove_option[RPDAcrylic]','HighImpact');" value="HighImpact" <?= ($remove_option["RPDAcrylic"] == "HighImpact") ? " checked" : " " ?>/>
    High impact</label><br />
    </div>
     <? /*
      <br />  */ ?>  </td>
        </tr></table>
        </div>
<!-- Special Request -->
<div id = "TABLE_RPD_SPECIALREQUEST">
    <table  width="285" align="center" cellpadding="3" cellspacing="0" class="Normal">
      <tr>
        <td><strong>
          RPD Special request</strong></td>
      </tr>
      <tr>
     <td>
      <label><input  type="checkbox"   onchange="setValue('remove_option[SpecialRequest][DummyToothMetal]',this.checked+0);"<?=array_key_exists ('DummyToothMetal', $remove_option["SpecialRequest"])?" checked":" "?>/>
      Dummy tooth metal</label>
      <br />
      <label><input  type="checkbox" onchange="setValue('remove_option[SpecialRequest][StressBroken]',this.checked+0);" <?=array_key_exists ('StressBroken', $remove_option["SpecialRequest"])?" checked":" "?> />
      Stress broken or hinge saddle</label>
      <br />
      <label><input  type="checkbox" onchange="setValue('remove_option[SpecialRequest][Boxing]',this.checked+0);" <?=array_key_exists ('Boxing', $remove_option["SpecialRequest"])?" checked":" "?> />
      Boxing</label>
      <br />
</td>
    </tr></table>
    </div>

<!-- TP Order Acrylic -->
<div id = "TABLE_TP_OrderAcrylic" >
<table  width="285" align="center" cellpadding="3" cellspacing="0" class="Normal">
      <tr>
        <td><strong>
          <input name="TPOrderAcrylicEnable" id="TPOrderAcrylicEnable"  type="checkbox" onchange="findObj('DivTPOrderAcrylic').style.display=(this.checked?'inline':'none');if(!this.checked){setValue('remove_option[TPOrderAcrylic]','None');}" <?=$remove_option["TPOrderAcrylic"] != "None"?" checked":""?>  />
          TP Order Acrylic</strong></td>
      </tr>
      <tr>
     <td>
      <div id="DivTPOrderAcrylic"  <?=$remove_option["TPOrderAcrylic"] == "None"?" style=\"display:none\"":""?> >
      <label><input name="tmpRadio2"  type="radio"  onchange="setValue('remove_option[TPOrderAcrylic]','AcrylicNormal');" <?= ($remove_option["TPOrderAcrylic"] == "AcrylicNormal") ? " checked" : " " ?>/>
      Acrylic normal</label>
      <br />
      <label><input name="tmpRadio2"  type="radio" onchange="setValue('remove_option[TPOrderAcrylic]','AcrylicHighImpact');" <?= ($remove_option["TPOrderAcrylic"] == "AcrylicHighImpact") ? " checked" : " " ?>/>
     Acrylic high impact</label>
      <br />
      <label><input name="tmpRadio2"  type="radio"  onchange="setValue('remove_option[TPOrderAcrylic]','AcrylicIvocap');" <?= ($remove_option["TPOrderGrid"] == "AcrylicIvocap") ? " checked" : " " ?>/>
      Acrylic ivocap</label>
      <br />
    </div>
	</td>
    </tr>
    </table>
    </div>
<!-- TP Extra -->
<table id = "TABLE_TP_Extra" width="285" align="center" cellpadding="3" cellspacing="0" class="Normal" style="display:none">
      <tr>
        <td><strong>TP Extra</strong></td>
      </tr>
      <tr>
     <td>
      <label><input  type="checkbox" onchange="setValue('remove_option[TPExtra][Backing]',this.checked+0);" <?=array_key_exists ('Backing', $remove_option["TPExtra"])?" checked":" "?>/> Backing</label><br />
      <label><input  type="checkbox"  onchange="setValue('remove_option[TPExtra][WireClasp]',this.checked+0);" <?=array_key_exists ('WireClasp', $remove_option["TPExtra"])?" checked":" "?>/> Wire Clasp</label><br />
      <label><input  type="checkbox"  onchange="setValue('remove_option[TPExtra][CastClasp]',this.checked+0);" <?=array_key_exists ('CastClasp', $remove_option["TPExtra"])?" checked":" "?>/> Cast Clasp</label><br />
      <label><input  type="checkbox"  onchange="setValue('remove_option[TPExtra][WireRest]',this.checked+0);" <?=array_key_exists ('WireRest', $remove_option["TPExtra"])?" checked":" "?>/> Wire Rest</label><br />
      <label><input  type="checkbox"   onchange="setValue('remove_option[TPExtra][BonClasp]',this.checked+0);" <?=array_key_exists ('BonClasp', $remove_option["TPExtra"])?" checked":" "?>/> Bon Clasp</label><br />
      <label><input  type="checkbox"  onchange="setValue('remove_option[TPExtra][AcetalClasp]',this.checked+0);" <?=array_key_exists ('AcetalClasp', $remove_option["TPExtra"])?" checked":" "?>/> Acetal Clasp</label><br />
      <label><input  type="checkbox"  onchange="setValue('remove_option[TPExtra][WirePlate]',this.checked+0);" <?=array_key_exists ('WirePlate', $remove_option["TPExtra"])?" checked":" "?>/> ลวดดามเพลท</label><br />
</td>
    </tr></table>
<!-- TP Order Grid -->
<div id = "TABLE_TP_TPOrderGrid">
<table width="285" align="center" cellpadding="3" cellspacing="0" class="Normal">
  <tr>
    <td><strong>
      <input name="TPOrderGridEnable" id="TPOrderGridEnable"  type="checkbox" onchange="findObj('DivTPOrderGrid').style.display=(this.checked?'inline':'none');if(!this.checked){setValue('remove_option[TPOrderGrid]','None');}"  <?=$remove_option["TPOrderGrid"] != "None"?" checked":""?> />
      TP Order Grid</strong></td>
  </tr>
  <tr>
    <td>
    <div id="DivTPOrderGrid"   <?=$remove_option["TPOrderGrid"] == "None"?" style=\"display:none\"":""?>>
    <label><input name="tmpRadio3"  type="radio"  onchange="setValue('remove_option[TPOrderGrid]','CastGridCrCo');" <?= ($remove_option["TPOrderGrid"] == "CastGridCrCo") ? " checked" : " " ?>/>
    Cast grid CrCo <?=($language=="thai") ? "(ตะแกรงเหวี่ยง)" : "" ?></label>
    <br />
    <label><input name="tmpRadio3"  type="radio"  onchange="setValue('remove_option[TPOrderGrid]','MeshGoldColour');" <?= ($remove_option["TPOrderGrid"] == "MeshGoldColour") ? " checked" : " " ?>/>
    Mesh, Gold Colour <?=($language=="thai") ? "(ตะแกรงสำเร็จ รูเล็ก)" : "" ?></label>
    <br />
    <label><input name="tmpRadio3" type="radio"  onchange="setValue('remove_option[TPOrderGrid]','PreFabricatedGoldColour');" <?= ($remove_option["TPOrderGrid"] == "PreFabricatedGoldColour") ? " checked" : " " ?>/>
    Pre-fabricated gold colour grid <?=($language=="thai") ? "<br>(ตะแกรงสำเร็จ รูใหญ่)" : "" ?></label>
    <br />
    </div></td>
  </tr>
</table></div>
<!-- Teeth Setup -->
<div id = "TABLE_RPD_TEETHANDSETUP">
<table  width="285" align="center" cellpadding="3" cellspacing="0" class="Normal">
  <tr>
    <td><strong> 
      <input name="TeethSetupEnable" id="TeethSetupEnable"  type="checkbox" onchange="findObj('DivTeethSetup').style.display=(this.checked?'inline':'none');if(!this.checked){setValue('remove_option[TeethSetup]','None');}" <?=$remove_option["TeethSetup"] != "None"?" checked":""?>/>
      Teeth &amp; setup</strong></td>
  </tr>
  <tr>
    <td><div id="DivTeethSetup"    <?=$remove_option["TeethSetup"] == "None"?" style=\"display:none\"":""?>>
    <label><input name="tmpRadio4"  type="radio"  onchange="setValue('remove_option[TeethSetup]','Square');" <?= ($remove_option["TeethSetup"] == "Square") ? " checked" : " " ?>/>
    Square</label>
    <br />
    <label><input name="tmpRadio4" type="radio"  onchange="setValue('remove_option[TeethSetup]','Triangular');" <?= ($remove_option["TeethSetup"] == "Triangular") ? " checked" : " " ?>/>
    Triangular</label>
    <br />
    <label><input name="tmpRadio4"  type="radio" onchange="setValue('remove_option[TeethSetup]','Oval');" <?= ($remove_option["TeethSetup"] == "Oval") ? " checked" : " " ?>/>
    Oval</label>
    <br />
    </div></td>
  </tr>
   </table>
   </div>
<!-- Gum Fit -->
<div id = "TABLE_RPD_GUMFIT">
<table width="285" align="center" cellpadding="3" cellspacing="0" class="Normal">
  <tr>
    <td>
    <label>
<input name="WireStrengthener" id="WireStrengthener"  type="checkbox" onchange="setValue('remove_option[WireStrengthener]',this.checked + 0);" <?=($remove_option["WireStrengthener"] == "1")?" checked":" "?>/><strong> Wire Strengthener</strong></label><br /> 
    <label>
<input name="GumFitEnable" id="GumFitEnable"  type="checkbox" onClick="findObj('DivGumFit').style.display=(this.checked?'inline':'none');if(!this.checked){setValue('remove_option[GumFit]','None');}" <?=$remove_option["GumFit"] != "None"?" checked":""?> /><strong> Gum fit</strong></label></td>
  </tr>
  <tr>
    <td><div id="DivGumFit"  <?=$remove_option["GumFit"] == "None"?" style=\"display:none\"":""?>>
    <table border="0" cellspacing="0" cellpadding="2">
      <tr>
        <td width="80" align="center"><label>
          <img style="cursor:pointer" src="../resource/images/eorder/remove/gum_fit_hard.gif" width="36" height="36" />          <br /><input name="gumfitradio" type="radio"  onchange="setValue('remove_option[GumFit]','Hard');" <?= ($remove_option["GumFit"] == "Hard") ? " checked" : " " ?> />
          Hard </label></td>
        <td width="80" align="center"><label>
           <img style="cursor:pointer" src="../resource/images/eorder/remove/gum_fit_socket.gif" width="36" height="36" /><br /><input name="gumfitradio" type="radio" onchange="setValue('remove_option[GumFit]','Socket');" <?= ($remove_option["GumFit"] == "Socket") ? " checked" : " " ?>/>
          Socket</label></td>
        <td width="80" align="center"><label>
          <img style="cursor:pointer" src="../resource/images/eorder/remove/gum_fit_soft.gif" width="36" height="36" /><br /><input name="gumfitradio"  type="radio" onchange="setValue('remove_option[GumFit]','Soft');" <?= ($remove_option["GumFit"] == "Soft") ? " checked" : " " ?>/>
          
          Soft</label></td>
      </tr>
    </table>
    </div></td>
  </tr>
</table>
</div>
<div id = "TABLE_SPBB">
<table width="285" align="center" cellpadding="3" cellspacing="0" class="Normal">
  <tr>
    <td><strong>Special Tray + Bite Block</strong><br />
        </td>
  </tr>
  <tr>
    <td><div id="DivSpecialTrayHole">
      <label>
<input type="radio" name="radioSpecialTray" id="radioSpecialTray2" value="hole" onchange="setValue('remove_option[SpecialTray]','Hole');" <?= ($remove_option["SpecialTray"] == "Hole") ? " checked" : " " ?>/> 
Holes</label>
     <label> <input type="radio" name="radioSpecialTray" id="radioSpecialTray" value="nohole" onchange="setValue('remove_option[SpecialTray]','NoHole');" <?= ($remove_option["SpecialTray"] == "NoHole") ? " checked" : " " ?>/>
      No Holes</label><br />
    </div>
    
    <label><input name="" type="checkbox" value=""  onchange="setValue('remove_option[SpecialTrayBiteBlock][ReliefWax]',this.checked+0);" <?=array_key_exists ('ReliefWax', $remove_option["SpecialTrayBiteBlock"])?" checked":" "?>/>Relief wax for full denture</label><br />
    <label><input name="" type="checkbox" value=""  onchange="setValue('remove_option[SpecialTrayBiteBlock][CloseFit]',this.checked+0);" <?=array_key_exists ('CloseFit', $remove_option["SpecialTrayBiteBlock"])?" checked":" "?>/>Close fit for full denture</label><br />
    <label><input name="" type="checkbox" value=""  onchange="setValue('remove_option[SpecialTrayBiteBlock][BasePlate]',this.checked+0);" <?=array_key_exists ('BasePlate', $remove_option["SpecialTrayBiteBlock"])?" checked":" "?>/>Base Plate</label><br />
    <label><input name="" type="checkbox" value=""  onchange="setValue('remove_option[SpecialTrayBiteBlock][Remark]',this.checked+0);" <?=array_key_exists ('Remark', $remove_option["SpecialTrayBiteBlock"])?" checked":" "?>/>Remarks</label><br />    </td>
    </tr>
    </table>
    </div>

<table width="285" border="0" align="center">
      <tr>
    <td><span style="font-weight: bold; font-size: 18px">Enclosed / สิ่งที่ส่งมาด้วย</span></td>
  </tr>
  <tr>
    <td><label><input type="checkbox"  value="upper_tray" onchange="setValue('remove_enclosed[upper_tray]',this.checked+0);" <?=array_key_exists ('upper_tray', $remove_enclosed)?" checked":" "?>/>
    Tray บน
    </label>
      <br />
      <label><input type="checkbox"  value="lower_tray" onchange="setValue('remove_enclosed[lower_tray]',this.checked+0);" <?=array_key_exists ('lower_tray', $remove_enclosed)?" checked":" "?>/>
      Tray ล่าง     </label>
      <br />
      <label><input type="checkbox"  value="upper_special_tray" onchange="setValue('remove_enclosed[upper_special_tray]',this.checked+0);" <?=array_key_exists ('upper_special_tray', $remove_enclosed)?" checked":" "?>/>
      Special Tray บน    </label>
      <br />
      <label><input type="checkbox"  value="lower_special_tray" onchange="setValue('remove_enclosed[lower_special_tray]',this.checked+0);" <?=array_key_exists ('lower_special_tray', $remove_enclosed)?" checked":" "?>/>
      Special Tray ล่าง    </label>
      <br />
      <label><input type="checkbox"  value="bite_silicone" onchange="setValue('remove_enclosed[bite_silicone]',this.checked+0);" <?=array_key_exists ('bite_silicone', $remove_enclosed)?" checked":" "?>/>
      Bite-Silicone      </label>
      <br />
      <label><input type="checkbox"  value="bite-wax" onchange="setValue('remove_enclosed[bite-wax]',this.checked+0);" <?=array_key_exists ('bite-wax', $remove_enclosed)?" checked":" "?>/>
      Bite-Wax</label>
      <br />
      <label><input type="checkbox"  value="upper_model" onchange="setValue('remove_enclosed[upper_model]',this.checked+0);" <?=array_key_exists ('upper_model', $remove_enclosed)?" checked":" "?>/>
      Model บน</label>
      <br />
      <label><input type="checkbox"  value="lower_model" onchange="setValue('remove_enclosed[lower_model]',this.checked+0);" <?=array_key_exists ('lower_model', $remove_enclosed)?" checked":" "?>/>
      Model ล่าง</label>
      <br />
    </td>
  </tr>
</table>
</div>
<? include "../cfrontend/tbframe2f.php" ?>
