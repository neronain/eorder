<? ob_start() ?>
<html >
<head>
<title><?=WEBSITE_HEADER  ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--meta http-equiv='refresh' content='600;url=loginout_c.php'-->
<script src="../resource/javascript/default.js"></script>
<script src="../resource/javascript/ajax.js"></script>

<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? $tbframehclose2 = "setFocus('barcode');" ?>
<? /**/ include "../cfrontend/ordersummary.php" ?>
<? /* */ include_once "../resource/divbackground.php" ?>

<table width="100%" height="100%" cellspacing="0" cellpadding="0">
  <tr>
    <td height="50"><?  $currentMenu="loginout"; include_once("../logbook/logbookmenu.php"); ?></td>
  </tr>
  <tr>
    <td align="center" valign="top" bgcolor="#FFFFFF"><table width="900" border="0" align="center" cellpadding="2" cellspacing="1" class="TableBorder">
      <tr>
        <td bgcolor="#FFFFFF" class="Normal">
        <div id="DIV_loginout" style="min-height:110px">
        <!--table width="100%" border="0" cellpadding="2" cellspacing="1" class="popBorder">
          <tr>
            <td rowspan="2" align="center" class="popHeader" style="font-size:18px">
			<div align="center" id="messageBig">
            <font color="#000000"><?=$msg?></font>			
			</div>
			</td>
            <td width="220" height="30" align="center" class="popHeader">Stamp in-out</td>
          </tr>
		<!--form action="../logbook/loginout_c.php" method="post" name="barcodeform" -->
		<!--input type="hidden" name="STEP" value="<?=$step?>" id="STEP">
		<input type="hidden" name="eorderid" value="<?=$eorderid?>" id="eorderid">
          <tr>
            <td width="220" height="70" align="center" valign="middle" bgcolor="#FFFFFF" class="popNormal">
			<input name="barcode" type="text" id="barcode" onKeyDown="CheckKeyDown(event)"/>&nbsp;&nbsp;
            <script>setFocus('barcode');</script>

               <input name="METHOD" type="submit" class="BTok" value="OK" id="barcodeok" onClick="SendRequest()"/>
			   <input type="text" name="Stupid_IE_Bug" value="" style="width:0;visibility:hidden" ></td>
          </tr>
		  <!--/form-->
		  <? //onKeyDown="if(this.value.length==15){setFocus('barcodeok');barcodeform.submit();}" ?>
        <!--/table -->
        </div>
        
        </td>
      </tr>
      <tr>
        <td bgcolor="#FFFFFF" class="Normal">
		<? if($enablefilter){ ?>
				<table width="100%" border="0" cellspacing="1" cellpadding="2" class="Normal">
		 <form action="../logbook/loginout_c.php" method="post">
          <tr>
            <td colspan="3"  class="HeaderW">Section filter </td></tr>
			<tr>
			<? 
			$count=0;
			while(!$data_section->EOF){ ?>
            <td>
			<input type="checkbox" name="section[]" value="<?= $data_section->Rs("sectionid"); ?>"
			<?=$filtersection[$data_section->Rs("sectionid")]?" checked ":"" ?>
			
			 /><?= $data_section->Rs("sec_type"); ?>:
			<?= $data_section->Rs("sec_room"); ?></td>
			<? 
			if($count%2==1)echo("</tr><tr>");
			$count++;
			
			$data_section->MoveNext();	} ?>
          </tr>
		    <tr>
        <td align="right" colspan="3">
		
	 	<input name="METHOD" type="submit" class="BTupdate" value="UPDATE" />
</td>
      </tr>
		 </form>
        </table>
		<? }else{?>
		<table width="100%" border="0" cellpadding="2" cellspacing="0" class="HeaderW">
				<form action="../logbook/loginout_c.php" method="post">	 
                 <tr>
			<td align="left">
			<img src="../resource/images/silkicons/book_go.gif"> Logbook <font color="#FF0000">(สแกนได้เลยโดยที่ไม่ต้องรอให้ด้านล่างโหลดเสร็จครับ)</font></td>
			<td align="right" ><div id="RefresherDisplay"></div></td>
			<td align="right" >
			<input name="METHOD" type="button" class="BToption" value="REFRESH" onClick="RefreshRoomShowCurrent();return false;" />
			<input name="METHOD" type="submit" class="BToption"  value="OPTION" /></td>	</tr>  </form></table>
            
            <div id="RoomShowCurrent"></div>
            
           <? if(0){ ?>
		<table border="0" cellpadding="4" cellspacing="0" class="Normal">

          <tr>
            <td colspan="8" class="HeaderW">				  </td>
          </tr>
		
          <tr>
            <td width="200" class="HeaderTable">Staff</td>
            <td width="120" class="HeaderTable">Code</td>
            <td colspan="2" align="center" class="HeaderTable">Date</td>
            <td width="130" class="HeaderTable">กำหนดออก</td>
            <td width="270" class="HeaderTable">Work</td>
          </tr>
		<? $old_section = "" ;$last_stf_id= "" ?>
          <? while(!$data_logbook->EOF){ 

		  	if($last_stf_id+0==$data_logbook->Rs("staffid")+0){
			  	$existman = true;				
			}else{
				$last_stf_id =$data_logbook->Rs("staffid")+0;
			  	$existman = false;
			}
		  
		  
		 if($oldsection!=$data_logbook->Rs("sec_room")) { $oldsection=$data_logbook->Rs("sec_room");

		 ?>
         
          <tr>
            <td colspan="6" bgcolor="#CCCCFF" class="Normal">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr><td>
            <b>Section : 
			<a href="../section/sectiondetail_c.php?sectionid=<?= $data_logbook->Rs("sectionid"); ?>"
				target="_blank">
				<?= $data_logbook->Rs("sec_room"); ?></a>			</b>			</td>
			 <td bgcolor="#CCCCFF" class="Normal" align="right">
			 (งานเสร็จไปแล้ว <?= $data_logbook->Rs("countlog")+0; ?> กล่อง)			</td></tr></table></td>
		</tr>	
		<? } ?>
		<tr>
            <td width="200">
			<? if(!$existman){?>
			<a href="../staff/staffdetail_c.php?staffid=<?= $data_logbook->Rs("staffid"); ?>" target="_blank" 
             title="<?= $data_logbook->Rs("stf_code"); ?>"
            >
			<?= $data_logbook->Rs("stf_name"); ?></a>
			<? } ?>			</td>
			<? if($data_logbook->Rs("logbookid")!=NULL){ ?>
			
           <? // <td align="center"><? if(!$existman){ echo "*";}</td> ?>
			
			
            <td class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" 
            onClick="OpenDivShowSummary(<?= $data_logbook->Rs("eorderid"); ?>)" >
			<?= $data_logbook->Rs("ord_code"); ?></td>
            <td width="80" align="right"><?= $data_logbook->Rs("log_date"); ?></td>
			<td width="40" align="right">(<?=$data_logbook->Rs("log_longh")>0?$data_logbook->Rs("log_longh").":":""?><?=str_pad($data_logbook->Rs("log_longm"),2,'0',0); ?>)</td>
			<td> 
			
			
			  <?
		if($data_logbook->Rs("islate")<0){
			echo "<font color=#ff0000>เลยมา ".($data_logbook->Rs("release_datehr"))." ชม. ".($data_logbook->Rs("release_datemn")) ." นาที</font>";
		}else	if($data_logbook->Rs("release_datehr")+0>0){
			echo "อีก ".($data_logbook->Rs("release_datehr")+0)." ชม. ".($data_logbook->Rs("release_datemn")+0) ." นาที";
		}else if($data_logbook->Rs("release_datehr")+0==0){
			echo "อีก ".($data_logbook->Rs("release_datemn")+0) ." นาที";
		}
				
				
				?>			  </td>
			
			<td align="left"><?=$data_logbook->Rs("ordt_typeofwork")?></td>
			<? }else{
				echo '<td colspan=3 align="center"></td>';
			}
			
			 ?>
          </tr>
		 
          <? $data_logbook->MoveNext();	} ?>
        </table><? } ?>
		
		<? }?>
		
		</td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
<script>
hideLoading();
var countDownRefresh=0;
function CheckKeyDown(e)
{

	var event = e || window.event;
    var keycode = event.charCode || event.keyCode;
    console.log(keycode);
    if(keycode === 13){
    	SendRequest();
    	return;
    }
	var barcode = getValue('barcode');
	if(barcode.length=0)return;
	var h = barcode.substring(0,1);
	if(h!='E' && barcode.length==5){
		SendRequest();
	}else if(barcode.length==16 
		&& (barcode.substring(0,6) != 'ETL012' && barcode.substring(0,6) != 'ETL011')
		){
		SendRequest();
	}else if( barcode.length==20 ){
		SendRequest();
	}
}

function SendRequest(){
	countDownRefresh = 20;
	var barcode = getValue('barcode');
	var STEP =  getValue('STEP');
	var eorderid =  getValue('eorderid');
	var defectcode =  getValue('defectcode');


	if(findObj('tproblem')!=null){
		var repair =  document.getElementById('chk_repair').checked?'1':'';
		var rework =  document.getElementById('chk_rework').checked?'1':'';
		var problem =  encodeTH(getValue('tproblem'));
		var remark =  encodeTH(getValue('tremark'));
		
		showHTML('DIV_loginout',"../logbook/loginout_process.php?METHOD=OK&barcode="+barcode+"&STEP="+STEP+"&eorderid="+eorderid+"&defectcode="+defectcode+'&repair='+repair+'&rework='+rework+'&problem='+problem+'&remark='+remark,AfterResponse());
	}else{
		showHTML('DIV_loginout',"../logbook/loginout_process.php?METHOD=OK&barcode="+barcode+"&STEP="+STEP+"&eorderid="+eorderid+"&defectcode="+defectcode,AfterResponse());
	}
}
function AfterResponse(){
	SetFocusLoop(-1);
	countDownRefresh = 5;
}
function RefreshRoomShowCurrent(){
	countDownRefresh = 2000;
	showHTML('RoomShowCurrent',"../logbook/loginout_show.php?dummy=0");
}
function SetFocusLoop(count){
	var obj = findObj('barcode');
	if(obj!=null){
		setFocus('barcode');
		//setValue('barcode','----'+count+'----');
		if(count==0){
			//setValue('barcode','');
			return;
		}
		if(count<0){
			count=10;
		}
		count--;
		setTimeout('SetFocusLoop('+(count)+')',100);
	}else{
		setTimeout('SetFocusLoop(0)',100);
	}
	
}
function Refresher(){
	countDownRefresh--;
	if(countDownRefresh<0){
		//countDownRefresh = 20;
		RefreshRoomShowCurrent();
	}
	writeit('RefresherDisplay','โหลดอีกครั้งใน '+countDownRefresh+' วินาที');
	setTimeout('Refresher()',1000);
}

SetFocusLoop(-1);
SendRequest();
Refresher();
RefreshRoomShowCurrent();
//RefreshRoomShowCurrent();
</script>

</html>
<? 
include_once '../core/inc_pngfix.php';
echo replacePngTags(ob_get_clean()); ?>