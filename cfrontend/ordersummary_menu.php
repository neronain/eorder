<?
	include_once("../core/default.php") ;

	GetVar($eorder_id,"eorderid");
	
	$eorder = new Csql();
	$eorder->Connect();
	$eorder->Query("select ord_status,ord_code from eorder where eorderid=$eorder_id limit 1");
	if($eorder->EOF) {
		exit();
	}
	$status = $eorder->Rs("ord_status");
	$code = $eorder->Rs("ord_code");
	//var_dump($language);
	//var_dump($_COOKIE);
	
?>
<? if($usertype=='CM'){ ?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('overview')">
        <img src="../resource/images/silkicons/information.gif" /> <?=T_OVERVIEW?></td>
         <?
		 if(file_exists("../file/eorderattach/".$eorder_id.".jpg")){?>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('attachimage')"><img src="../resource/images/silkicons/picture.png" />Attach image </td>
		<? } ?>        
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('history')">
        <img src="../resource/images/silkicons/page_white_gear.gif" /> <?=T_HISTORY?> </td>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
    	onclick="OrderSummaryChangeTab('invoice')">
   		<img src="../resource/images/silkicons/money.gif" width="16" height="16" /> <?=T_COST?></td>
      </tr>
    </table></td>
    <td align="right"><table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('print')">
        <img src="../resource/images/silkicons/printer.gif" /> <?=T_TPRINT?></td>
        
        <? if($status==0){ ?>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('edit')">
        <img src="../resource/images/silkicons/pencil.gif" /> <?=T_EDIT?> </td>
        <? }?>
        
         <? if($status==0){ ?>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('submit')">
        <img src="../resource/images/silkicons/package_go.gif" /> <?=T_SUBMIT?> </td> 
		
		<? }?>
      </tr>
    </table></td>
    <td width="50" align="right">&nbsp;</td>
  </tr>
</table>

<? }else if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){ ?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('overview')"><img src="../resource/images/silkicons/information.gif" />
             Overview</td>
         <?
		 if(file_exists("../file/eorderattach/".$eorder_id.".jpg")){?>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('attachimage')"><img src="../resource/images/silkicons/picture.png" />Attach image </td>
		<? } ?>
 		<? if(file_exists("../file/eorderrelease/".$code.".png")){?>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('releaseimage')"><img src="../resource/images/silkicons/picture.png" />Release image </td>
		<? } ?>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('history')"><img src="../resource/images/silkicons/page_white_gear.gif" />
              History        </td>
    <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('log')"><img src="../resource/images/silkicons/book.gif" /> Log</td>              
    <!--td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
    	onclick="OrderSummaryChangeTab('invoice')"><img src="../resource/images/silkicons/money.gif" width="16" height="16" />
              Cost</td-->
    <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('repairrework')">Repair/Rework</td>
    <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('mac5')">Mac5</td>
      </tr>
    </table></td>
    
    
    
    <td align="center">
    
    
    <table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
  <tr>
  <? if($status>=3 && ($usertype=='ST' || $usertype=='MN' || $usertype=='AD')){ ?>
    <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="window.location='../eorder/eorder_extend.php?orderid=<?=$eorder_id?>'"><img src="../resource/images/silkicons/package_add.gif" /> Extend Order</td>
    <? }?>
  </tr>
</table>

    
    </td>
    <td align="right"><table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('print')"><img src="../resource/images/silkicons/printer.gif" />
              Print</td>
		<? if($usertype=='ST' || $usertype=='MN' || $usertype=='AD'){ ?>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('menu')"><img src="../resource/images/silkicons/information.gif" /> Menu</td>
        <? }?>
      <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('edit')"><img src="../resource/images/silkicons/pencil.gif" />
              Edit        </td>
      </tr>
    </table></td>

    <td align="right" >
    <table border="0" cellpadding="3" cellspacing="1" bgcolor="#999999">
      <tr>
            <? if($status<2){ ?>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('arrive')"><img src="../resource/images/silkicons/package_go.gif" />
              Arrive        </td>
        <? }?>
        <? if($status==5 || $status==6){ ?>
        <td class="tdButtonOnOut" onmouseover="this.className='tdButtonOnOver'" onmouseout="this.className='tdButtonOnOut'"
        onclick="OrderSummaryChangeTab('paid')"><img src="../resource/images/silkicons/money.gif" />
              Paid        </td>
        <? }?>     
    </tr></table>    </td>
    <td width="20" align="right">&nbsp;</td>
  </tr>
</table>
<? }?>