<? include "header.php" ?>
<?
	getVar($action,"act");
	getVar($usertype,"utype");
	getVar($cid,"cid");
?>

<table width="100%"><tr><td align="center">
<div style="width:500px">
<form name="customer_register" method="post" action="../cregister/register_process.php" >
<? $tbframeheader = "Registration"?>
<? include "../cfrontend/tbframeh.php"?>
<table align="center" border="0" cellspacing="0" cellpadding="5">
  <tr>
    <td><strong>&nbsp;<?=T_SEARCH;?> <?=T_LABNAME;?></strong></td>
    <td>&nbsp;
        <input name="q" id="q" type="text" value="" style="width:200px" title="Input your clinic name to search your information in database" />&nbsp;<input type="submit" value="<?=T_FIND;?>" onClick="if(getValue('q')!=''){showHTML('DivShowCustomer','../cregister/customer_register_c.php?q='+encodeTH(getValue('q')));}else{alert('Please insert some words of your clinic name');}return false;" /></td>
  </tr>
  <tr>
    <td colspan="2">
    <? if($language=='thai'){?>
    กรุณาใส่ชื่อคลีนิค เพื่อค้นหาข้อมูลของคุณในฐานข้อมูล

    <? } else{ ?>
    Input your clinic name in text field to search your information in database.<br />
      (Just a key-word of your lab name.Normaly it should be in our database)
      <? } ?>
      </td>
  </tr>
</table>
<br />
<div id="DivShowCustomer" align="center">
    <!--p align="center">
    	<a href="#" onclick="showHTML('DivShowCustomer','../cregister/customer_new.php?a=1');">Register as new customer.</a>        	
    </p-->
</div>
<div id="DivShowStatus" align="center"></div>
<?
		if($action == "add" && $usertype == "old") {
?>
<script language="javascript" type="text/javascript">
    showHTML('DivShowCustomer','../cregister/customer_old.php?cid=<?=$cid?>');
</script>
<?
		} elseif($action == "add" && $usertype == "new") {
?>
<script language="javascript" type="text/javascript">
    showHTML('DivShowCustomer','../cregister/customer_new.php?a=1');
</script>
<?
		}
?>
<? include "../cfrontend/tbframef.php"?>
</form>
</div>
</td></tr></table>

<script type="text/javascript">

function stopRKey(evt) {
  var evt = (evt) ? evt : ((event) ? event : null);
  var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
  if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
}

document.onkeypress = stopRKey;

</script>
<? include "footer.php" ?>