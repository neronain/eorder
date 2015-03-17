<? include "../cfrontend/tbframe2h.php" ?>
            <span style="font-size: 18px"><strong>Margin option</strong></span>
  <? include "eorder_marginoption.php" ?>
  
<table align="center" cellpadding="3" cellspacing="0" class="Normal">
  <tr>
    <td><span style="font-size: 18px"><strong>Addition information</strong></span></td>
  </tr>
  <tr>
    <td>
      <label><input  type="checkbox" value="MarginGoDeep" onchange="setValue('fix_option[MarginGoDeep]',this.checked+0);" <?=array_key_exists ('MarginGoDeep', $fix_option)?"checked":""?>/> 
      Margin ลงลึกใต้เหงือก</label><br />
      <label><input  type="checkbox" value="UnderOcclusion05mm" onchange="setValue('fix_option[UnderOcclusion05mm]',this.checked+0);" <?=array_key_exists ('UnderOcclusion05mm', $fix_option)?" checked":" "?>/>
      Under occlusion 0.5mm</label><br />
      <label><input  type="checkbox" value="UnderOcclusion10mm"  onchange="setValue('fix_option[UnderOcclusion10mm]',this.checked+0);"<?=array_key_exists ('UnderOcclusion10mm', $fix_option)?" checked":" "?>/>
      Under occlusion 1.0mm</label><br />
      <label><input  type="checkbox" value="UnderOcclusion20mm"  onchange="setValue('fix_option[UnderOcclusion20mm]',this.checked+0);" <?=array_key_exists ('UnderOcclusion20mm', $fix_option)?" checked":" "?> />
      Under occlusion 2.0mm</label><br />
      <label><input  type="checkbox" value="No approximal contact" onchange="setValue('fix_option[No approximal contact]',this.checked+0);" <?=array_key_exists ('No approximal contact', $fix_option)?" checked":" "?> />
      No approximal contact</label><br />
      <label><input  type="checkbox" value="SmallTeeth" onchange="setValue('fix_option[SmallTeeth]',this.checked+0);" <?=array_key_exists ('SmallTeeth', $fix_option)?" checked":" "?> />
      Small teeth</label><br />
      <label><input  type="checkbox" value="RestPrepareForRPDTP" onchange="setValue('fix_option[RestPrepareForRPDTP]',this.checked+0);" <?=array_key_exists ('RestPrepareForRPDTP', $fix_option)?" checked":" "?> />
      Rest , Prepare for RPD/TP</label><br />
      <label><input  type="checkbox" value="AdeptWithRPDTP"  onchange="setValue('fix_option[AdeptWithRPDTP]',this.checked+0);" <?=array_key_exists ('AdeptWithRPDTP', $fix_option)?" checked":" "?> />
	    ทำงาน FIX ให้เข้ากับ RPD</label><br />
      <label><input  type="checkbox" value="NoSpaceMakePF"  onchange="setValue('fix_option[NoSpaceMakePF]',this.checked+0);" <?=array_key_exists ('NoSpaceMakePF', $fix_option)?" checked":" "?> />
	    ถ้าไม่มีพื้นที่ให้ทำเป็น PF ได้</label><br />
      <label><input  type="checkbox" value="No anagonist"  onchange="setValue('fix_option[No anagonist]',this.checked+0);" <?=array_key_exists ('No anagonist', $fix_option)?" checked":" "?> />
      No antagonist</label><br />
      <label><input  type="checkbox" value="PonticBuccalPalatalSmaller"  onchange="setValue('fix_option[PonticBuccalPalatalSmaller]',this.checked+0);" <?=array_key_exists ('PonticBuccalPalatalSmaller', $fix_option)?" checked":" "?> />
      Pontic buccal , palatal smaller</label><br />
      <label><input  type="checkbox" value="Crown endosed for shade/anatomy" onchange="setValue('fix_option[Crown endosed for shade/anatomy]',this.checked+0);" <?=array_key_exists ('Crown endosed for shade/anatomy', $fix_option)?" checked":" "?> />
      Crown endosed for shade/anatomy</label><br />
      <label><input  type="checkbox" value="Bridge enclosed for shade/anatomy"  onchange="setValue('fix_option[Bridge enclosed for shade/anatomy]',this.checked+0);" <?=array_key_exists ('Bridge enclosed for shade/anatomy', $fix_option)?" checked":" "?> />
      Bridge enclosed for shade/anatomy</label><br />
      <label><input  type="checkbox" value="New Dentist"  onchange="setValue('fix_option[New Dentist]',this.checked+0);" <?=array_key_exists ('New Dentist', $fix_option)?" checked":" "?> />
      New Dentist</label><br />
	  <label><input type="checkbox"  value="ChangeShade" onchange="setValue('fix_remake[ChangeShade]',this.checked+0);" <?=array_key_exists ('ChangeShade', $fix_remake)?" checked":" "?>/>
      Pink Porcelain</label><br />
	  </td>
    </tr>
  <?php/*<tr>
    <td><span style="font-size: 18px"><strong>Repair &amp; Finish Remark</strong></span></td>
  </tr>
  <tr>
    <td>
      <label><input type="checkbox"  value="ShortMargin" onchange="setValue('fix_remake[ShortMargin]',this.checked+0);" <?=array_key_exists ('ShortMargin', $fix_remake)?" checked":" "?> />
      Short margin</label><br />
      <label><input type="checkbox"  value="AddContactPoint" onchange="setValue('fix_remake[AddContactPoint]',this.checked+0);" <?=array_key_exists ('AddContactPoint', $fix_remake)?" checked":" "?> />
      Add contact point</label><br />
      <label><input type="checkbox"  value="RepairCeramic" onchange="setValue('fix_remake[RepairCeramic]',this.checked+0);" <?=array_key_exists ('RepairCeramic', $fix_remake)?" checked":" "?> />
      Repair ceramic</label><br />
      <label><input type="checkbox"  value="CeramicCracked" onchange="setValue('fix_remake[CeramicCracked]',this.checked+0);" <?=array_key_exists ('CeramicCracked', $fix_remake)?" checked":" "?> />
      Ceramic cracked</label><br />
      <label><input type="checkbox"  value="CanNotInsert" onchange="setValue('fix_remake[CanNotInsert]',this.checked+0);" <?=array_key_exists ('CanNotInsert', $fix_remake)?" checked":" "?> />
      Can not insert</label><br />
      <label><input type="checkbox"  value="ChangeDesign" onchange="setValue('fix_remake[ChangeDesign]',this.checked+0);" <?=array_key_exists ('ChangeDesign', $fix_remake)?" checked":" "?> />
      Change design</label><br />
      <label><input type="checkbox"  value="WrongBite" onchange="setValue('fix_remake[WrongBite]',this.checked+0);" <?=array_key_exists ('WrongBite', $fix_remake)?" checked":" "?> />
      Wrong bite</label><br/>
	  
	  </td>
    </tr>*/?>
  <tr>
    <td><span style="font-weight: bold; font-size: 18px">Enclosed / สิ่งที่ส่งมาด้วย</span></td>
  </tr>
  <tr>
    <td><label><input type="checkbox"  value="upper_tray" onchange="setValue('fix_enclosed[upper_tray]',this.checked+0);" <?=array_key_exists ('upper_tray', $fix_enclosed)?" checked":" "?>/>
    Tray บน
    </label>
      <br />
      <label><input type="checkbox"  value="lower_tray" onchange="setValue('fix_enclosed[lower_tray]',this.checked+0);" <?=array_key_exists ('lower_tray', $fix_enclosed)?" checked":" "?>/>
      Tray ล่าง     </label>
      <br />
      <label><input type="checkbox"  value="upper_special_tray" onchange="setValue('fix_enclosed[upper_special_tray]',this.checked+0);" <?=array_key_exists ('upper_special_tray', $fix_enclosed)?" checked":" "?>/>
      Special Tray บน    </label>
      <br />
      <label><input type="checkbox"  value="lower_special_tray" onchange="setValue('fix_enclosed[lower_special_tray]',this.checked+0);" <?=array_key_exists ('lower_special_tray', $fix_enclosed)?" checked":" "?>/>
      Special Tray ล่าง    </label>
      <br />
      <label><input type="checkbox"  value="bite_silicone" onchange="setValue('fix_enclosed[bite_silicone]',this.checked+0);" <?=array_key_exists ('bite_silicone', $fix_enclosed)?" checked":" "?>/>
      Bite-Silicone      </label>
      <br />
      <label><input type="checkbox"  value="bite-wax" onchange="setValue('fix_enclosed[bite-wax]',this.checked+0);" <?=array_key_exists ('bite-wax', $fix_enclosed)?" checked":" "?>/>
      Bite-Wax</label>
      <br />
      <label><input type="checkbox"  value="upper_model" onchange="setValue('fix_enclosed[upper_model]',this.checked+0);" <?=array_key_exists ('upper_model', $fix_enclosed)?" checked":" "?>/>
      Model บน</label>
      <br />
      <label><input type="checkbox"  value="lower_model" onchange="setValue('fix_enclosed[lower_model]',this.checked+0);" <?=array_key_exists ('lower_model', $fix_enclosed)?" checked":" "?>/>
      Model ล่าง</label>
      <br />
    </td>
  </tr>
</table>
<? include "../cfrontend/tbframe2f.php" ?>