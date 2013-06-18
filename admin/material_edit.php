<div style="width:550px" align="left">
<? include "../cfrontend/tbframe2h.php"?>
<table width="100%" border="0" cellspacing="0" align="center">
<input type="hidden" name="productid" id="productid" value="<?=$productid?>" />
  <tr>
    <td colspan="2" align="center"><strong>Product Information</strong></td>
  </tr>
      <tr>
    <td width="100">CODE</td>
    <td align="left"> <?=$pdc_code?></td>
    </tr>
	<tr>
    <td>Name</td>
    <td align="left"><?=$pdc_descT1?></td>
	</tr>
	<tr>
    <td>&nbsp;</td>
    <td align="left"><?=$pdc_descE1?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="left"> <?=$pdc_descE2?> </td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="left"><?=$pdc_descE3?></td>
    </tr>
    <tr>
    <td>&nbsp;</td>
    <td align="left">&nbsp;</td>
    </tr>
    <tr>
    <td>Price</td>
    <td align="left">&nbsp;</td>
    </tr>
    <tr>
    <td>THB</td>
    <td align="left"><input name="pdc_price_THB1" type="text" id="pdc_price_THB1" style="width:150px" value="<?=$pdc_price_THB1?>" /></td>
    </tr>
    <tr>
    <td>EUR1</td>
    <td align="left"><input name="pdc_price_EUR1" type="text" id="pdc_price_EUR1" style="width:150px" value="<?=$pdc_price_EUR1?>" /></td>
    </tr>
    <tr>
    <td>EUR2</td>
    <td align="left"><input name="pdc_price_EUR2" type="text" id="pdc_price_EUR2" style="width:150px" value="<?=$pdc_price_EUR2?>" /></td>
    </tr>
    <tr>
    <td>EUR3</td>
    <td align="left"><input name="pdc_price_EUR3" type="text" id="pdc_price_EUR3" style="width:150px" value="<?=$pdc_price_EUR3?>" /></td>
    </tr>
    <tr>
    <td>EUR4</td>
    <td align="left"><input name="pdc_price_EUR4" type="text" id="pdc_price_EUR4" style="width:150px" value="<?=$pdc_price_EUR4?>" /></td>
    </tr>  
 
</table>
<? include "../cfrontend/tbframe2f.php"?>
</div>