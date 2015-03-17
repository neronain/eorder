<? include_once("../eorder/eorder_preview_c.php");
if(!$forward){
 ?>
<table width="95%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" colspan="2"><strong>*<?=$eorder_code?>*</strong></td>
  </tr>
  <tr>
    <td colspan="2"><table cellspacing="2" cellpadding="0" width="100%" border="0">
        <tr>
          <td align="left" width="120">Code</td>
          <td align="left"><?=$eorder_code?></td>
          <td width="250" rowspan="6" align="center">
        
        <? if($ord_status==0 || $ord_status==1 ){  ?>
        <? include "../cfrontend/tbframe2h.php"?>
          <p align="center">Please write this code  on your box</p>
          <p align="center">
		<span style="font-size:20px"><b><?=substr($eorder_code,9,5)?></b></span></p>
        <? include "../cfrontend/tbframe2f.php"?>
        <? } ?>
        
        </td>
        </tr>
        <tr>
          <td align="left">Customer name</td>
          <td align="left"><?=$customer_name?></td>
        </tr>
        <tr>
          <td align="left">Doctor name</td>
          <td align="left"><?=$doctor_name?></td>
        </tr>
        <tr>
          <td align="left">Patient name</td>
          <td align="left"><?=$patient_name?></td>
        </tr>
        <tr>
          <td align="left">Order Date</td>
          <td align="left"><?=$order_date?></td>
        </tr>
        <tr>
          <td align="left">Ship Date</td>
          <td align="left"><?=$doctor_appointment?></td>
        </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><hr />
    </td>
  </tr>
  </table>
<!-- fix order section-->
<? if($isfix) {?>
<table width="95%" cellspacing="0" cellpadding="0">
  <tr>
    <td align="left" colspan="2"><strong>--- Fix order ---</strong>
        <table width="100%" cellspacing="0" cellpadding="2" border="0">
            <tr>
              <td width="120">Method</td>
              <td><?=$fix_method?></td>
            </tr>
            <tr>
              <td>Box</td>
              <td><?=$fix_box?></td>
            </tr>
            <tr>
              <td valign="top">Type of work</td>
              <td><?=$fix_typeofwork?></td>
            </tr>
            <tr>
              <td>Shade</td>
              <td><?=$fix_shade?></td>
            </tr>
            <tr>
              <td>Alloy</td>
              <td><?=$fix_alloy?></td>
            </tr>
            <tr>
              <td>Embrasure</td>
              <td><?=$fix_embrasure?></td>
            </tr>
            <tr>
              <td>Pontic</td>
              <td><img height="32" src="../resource/images/eorder/fix/fix_pontic<?=$fix_pontic?>.gif" width="32" /> 
              <?=$fix_pontic==5? " ".$_POST["fix_pontic_roottipmm"]." mm" :""?>              </td>
            </tr>
<? if($fix_margin["MGNO"]!=""){?><tr><td> Margin </td><td>No metal margin <?=$fix_margin["MGNO"]?></td></tr><? } ?>
<? if($fix_margin["MGLM"]!=""){?><tr><td> Margin </td><td>Ligual metal margin : <?=$fix_margin["MGLM"]?></td></tr><? } ?>
<? if($fix_margin["MGPO"]!=""){?><tr><td> Margin </td><td>Porcelain Margin : <?=$fix_margin["MGPO"]?></td></tr><? } ?>
<? if($fix_margin["MGSM"]!=""){?><tr><td> Margin </td><td>Small matel margin around :<?=$fix_margin["MGSM"]?></td></tr><? } ?>
<? if($fix_margin["MGHM"]!=""){?><tr><td> Margin </td><td>Hairline metal margin around : <?=$fix_margin["MGHM"]?></td></tr><? } ?>
<? if($fix_margin["MGPL"]!=""){?><tr><td> Margin </td><td>Por. Margin + Lingual metal : <?=$fix_margin["MGPL"]?></td></tr><? } ?>
<? if($fix_margin["MGPN"]!=""){?><tr><td> Margin </td><td>Por. Margin + No metal : <?=$fix_margin["MGPN"]?></td></tr><? } ?>
<? if($fix_margin["MGPM"]!=""){?><tr><td> Margin </td><td>Por. Margin around : <?=$fix_margin["MGPM"]?></td></tr><? } ?>
<? if($fix_margin["MGM1"]!=""){?><tr><td> Margin </td><td>Lingual Metal margin 1 mm : <?=$fix_margin["MGM1"]?></td></tr><? } ?>
<? if($fix_margin["MGM5"]!=""){?><tr><td> Margin </td><td>Lingual Metal margin 0.5 mm : <?=$fix_margin["MGM5"]?></td></tr><? } ?>
<? if($fix_margin["MGDM"]!=""){?><tr><td> Margin </td><td>Lingual Mistal & Distal margin : <?=$fix_margin["MGDM"]?></td></tr><? } ?>
<? if($fix_margin["MGPD"]!=""){?><tr><td> Margin </td><td>Pindex : <?=$fix_margin["MGPD"]?></td></tr><? } ?>
<? if($fix_margin["MGDH"]!=""){?><tr><td> Margin </td><td>เจาะรู / Drilling Hold : <?=$fix_margin["MGDH"]?></td></tr><? } ?>
 
            <tr>
              <td valign="top">Option</td>
              <td><?=$fix_option?></td>
            </tr>
            <tr>
              <td valign="top">Observation</td>
              <td><pre><?=$fix_observation?></pre></td>
            </tr>
    </table></td>
  </tr>
 </table>
<? } ?>
<!-- remove order section -->
<? if($isremove) { ?>
<table width="95%" cellspacing="0" cellpadding="0">
  <tr>
    <td colspan="2"><hr />
    </td>
  </tr>
  <tr>
    <td align="left" colspan="2"><strong>--- Remove order ---</strong><br />
  <table width="100%" cellspacing="0" cellpadding="2" border="0">
<tr>
              <td width="120">Method</td>
          <td><?=$remove_method?></td>
            </tr>
            <tr>
              <td valign="top">Type of work</td>
              <td>Upper: <?=$remove_mat["upper"]?><br />Lower: <?=$remove_mat["lower"]?><br/><?=$remove_typeofwork?></td>
            </tr>
            <tr>
              <td>Shade</td>
              <td><?=$remove_shade?></td>
            </tr>

            <tr>
              <td valign="top">Option</td>
              <td><?=$remove_option?></td>
            </tr>
        <tr>
              <td valign="top">Observation</td>
              <td><pre><?=$remove_observation?></pre></td>
            </tr>
    </table></td>
  </tr>
  </table>
        
<? } ?>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>
<? }?>