<div id="DivstaffMenu" style="vertical-align:center; top:100px;" >
<br>
Menu<br>
<table width="100" border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr bgcolor="#FFFFFF">
    <td  class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" onclick="OpenDivConfirmDelete();"><table width="100%" border="0">
      <tr>
        <td width="30" align="right"><img src="../resource/images/silkicons/cross.gif"></td>
        <td>delete</td>
      </tr>
    </table></td>
  </tr>
</table>


</div>


<div id="divConfirmDelete" align="center" style="position:absolute;left:250px;top:150px;width:300px;height:350px;z-index:1; display:none">
<? $tbframeheader = "Confirm Delete Order."?>
<? $tbframehclose = "CloseDivConfirmDelete()";?>
<? include "tbframeh.php"?>
<div style="height:150px;width:250px;" align="center">
<br />
<table border="0" >
  <tr>
    <td colspan="5" align="center">
	  <strong>Are you sure to Delete Order?    </strong></td>
  </tr>
    <tr>
    <td colspan="5">&nbsp;    </td>
  </tr>
      <tr>
    <td colspan="5">&nbsp;    </td>
  </tr>
      <tr>
    <td>&nbsp;</td>
    <td width="50" align="center">
	<table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr>
    <td  width="50" align="center" bgcolor="#FFFFFF"  class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" onclick="OrderSummaryChangeTab('deleteorder');" >Yes</td>
  </tr>
</table>
    </td>
    <td width="30">&nbsp;</td>
    <td width="50" align="center">
    <table border="0" cellpadding="2" cellspacing="1" bgcolor="#000000">
  <tr>
    <td  width="50" align="center" bgcolor="#FFFFFF"  class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'" onclick="CloseDivConfirmDelete()";">No</td>
  </tr>
</table>

    
    </td>
    <td>&nbsp;</td>
      </tr>
</table>
</div>
<? include "tbframef.php"?>

</div>



