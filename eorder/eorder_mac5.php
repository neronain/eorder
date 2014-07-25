<?php
	include_once("../core/default.php");
	//$eorder_id = $_GET["eorderid"];
	GetVar($eorder_id,"eorderid");
	$eorderid = $eorder_id;
	//$eorder_id = 1000007;
	/*$data = new Csql();
	$data->Connect();
	$data->Query("select * from eorder where eorderid=$eorder_id limit 1");
	if(!$data->EOF) {
		$ord_cus_id = $data->Rs("ord_cus_id");

		$data->Query("select * from customer where customerid= $ord_cus_id limit 1");
		if(!$data->EOF) {
			$cus_mac_id = $data->Rs("cus_mac_id");
			$cus_pdcname = $data->Rs("cus_pdcname");
			$cus_pricegroup = $data->Rs("cus_pricegroup");
			$data->Query("select * from customac where customacid= $cus_mac_id limit 1");
			if(!$data->EOF) {
				$cum_code = $data->Rs("cum_code");
				$cum_nameT = $data->Rs("cum_nameT");
				$cum_add1AT = $data->Rs("cum_add1AT");
				$cum_add1AT2 = $data->Rs("cum_add2AT");
				$cum_add1AT3 = $data->Rs("cum_add3AT");
			}


		}
	}*/
	
	$exchangerate['EXTHB'] = 1;
	$dataex = new Csql();
	$dataex->Connect();	
	$dataex->Query("SELECT * FROM conf where con_key like 'EX%'");
	while(!$dataex->EOF){
		$exchangerate[$dataex->Rs('con_key')] =  $dataex->Rs('con_value');
		$dataex->MoveNext();
	}


	
	
	
	$data = new Csql();
	$data->Connect();
	

	$eorder = new Csql();
	$eorder->Query("select * from eorder where eorderid=$eorder_id limit 1");
	if($eorder->EOF) {exit("Invalid e-orderID $eorderid");}
	$ord_cus_id = $eorder->Rs("ord_cus_id");
    $ord_brn_id = $eorder->Rs("ord_brn_id");



    $branch = new Csql();
    $branch->Query("select * from branch where branchid=$ord_brn_id limit 1");
    if($branch->EOF) {exit("Invalid branchid $ord_brn_id");}
    $branch->TableName = "customer";
    $branch_mac5db = $customer->Rs("branch_mac5db");

    global $AppConfodbc_dbname;
    $AppConfodbc_dbname = '['.$branch_mac5db.']';


	$customer = new Csql();
	$customer->Query("select * from customer where customerid=$ord_cus_id limit 1");
	if($customer->EOF) {exit("Invalid customerid $ord_cus_id");}
	$customer->TableName = "customer";
	$cus_mac_code = $customer->Rs("cus_mac_code");
	
	$m5m = new Csql();
	if($customer->Rs("cus_nick")=='K002'){
		$maxindex = $m5m->ExecuteScalar("select max(MID(m5m_no,3,LENGTH(m5m_no)-2)+0) from eorder_m5m where  LEFT(m5m_no,1)='H'")+1;
		$no = 'H-'.($maxindex);
		$taxno = $no;		
		$doctype ='PS';
	}else if($customer->Rs("cus_cnt_id")>1){
		$maxindex = $m5m->ExecuteScalar("select max(MID(m5m_no,3,LENGTH(m5m_no)-2)+0) from eorder_m5m,eorder where eorderid=eorder_m5mid and ord_cus_id =  {$customer->Rs('customerid')}")+1;
		$no = 'IN'.($maxindex);
		$taxno = $no;	
		$doctype ='IS';
	}else{
		$maxindex = $m5m->ExecuteScalar("select max(MID(m5m_no,3,LENGTH(m5m_no)-2)+0) from eorder_m5m where  LEFT(m5m_no,1)='B'")+1;
		$no = 'B-'.($maxindex);
		$taxno = $no;	
		$doctype ='IS';
	}
	
	
	$m5m->Query("select * from eorder_m5m where eorder_m5mid=$eorderid limit 1");
	if($m5m->EOF) {

		$m5m->AddNew();
		$m5m->TableName = "eorder_m5m";
		$m5m->Set("eorder_m5mid","'$eorderid'");
		$m5m->Set("m5m_cum_code","'$cus_mac_code'");
		$m5m->Set("m5m_no","'$no'");
		$m5m->Set("m5m_cacheno1","'".substr($no,0,1)."'");
		$m5m->Set("m5m_cacheno2","'$maxindex'");
		
		if($doctype=='IS'){
			$m5m->Set("m5m_taxno","'$taxno'");
		}
		
		$m5m->Set("m5m_date","CURDATE()");
		$m5m->Set("m5m_pdcname","'{$customer->Rs('cus_pdcname')}'");
		$m5m->Set("m5m_pricegroup","'{$customer->Rs('cus_pricegroup')}'");
		$m5m->Set("m5m_exchg","'".$exchangerate['EX'.substr($customer->Rs('cus_pricegroup'),0,3)]."'");
		
		$m5m->Update();
	}
	$m5m->TableName = "eorder_m5m";	
	
	$m5m_cum_code = $m5m->Rs("m5m_cum_code");
	$m5m_pdcname = $m5m->Rs("m5m_pdcname");
	$m5m_pricegroup = $m5m->Rs("m5m_pricegroup");	



	$customac = new Msql();
	$customac->Connect();
	$sql = "select  DEBcode,
	CAST(DEBnameT AS TEXT) AS DEBnameT,
	CAST(DEBadd1AT AS TEXT) AS DEBadd1AT,
	CAST(DEBadd2AT AS TEXT) AS DEBadd2AT,
	CAST(DEBadd3AT AS TEXT) AS DEBadd3AT
	from DEB where DEBcode='$m5m_cum_code' ";
	//$sql = "select TOP 10 DEBcode from DEB ";
	$customac->Query($sql);
	//$customac->Query("select * from customac where customacid='$m5m_cum_code' limit 1");
	if(!$customac->EOF) {
		$cum_code = $customac->Rs("DEBcode");
		$cum_nameT = tis620_to_utf8($customac->Rs("DEBnameT"));
		$cum_add1AT = tis620_to_utf8($customac->Rs("DEBadd1AT"));
		$cum_add2AT = tis620_to_utf8($customac->Rs("DEBadd2AT"));
		$cum_add3AT = tis620_to_utf8($customac->Rs("DEBadd3AT"));
	}else{
		$cum_nameT = "<font color=#FF0000>ยังไม่ได้เลือกลูกค้า</font>";
	}
	$customac->TableName = "DEBcode";	


	
	

	$m5d = new Csql();
	$m5d->Query("select * from eorder_m5d where eorder_m5did=$eorderid");
	while(!$m5d->EOF) {
		$index = $m5d->Rs("m5d_index");
		$m5data[$index]['m5d_pdc_code'] = $m5d->Rs("m5d_pdc_code");
		$m5data[$index]['m5d_pdc_name'] = $m5d->Rs("m5d_pdc_name");
		$m5data[$index]['m5d_pdc_unit'] = $m5d->Rs("m5d_pdc_unit");
		$m5data[$index]['m5d_vcol'] = $m5d->Rs("m5d_vcol");
		$m5data[$index]['m5d_qty'] = $m5d->Rs("m5d_qty");
		$m5data[$index]['m5d_price'] = $m5d->Rs("m5d_price");
		$m5data[$index]['m5d_discount'] = $m5d->Rs("m5d_discount");
		$m5d->MoveNext();
	}
	
	$m5m_date = date('d',DateMysqlToPHP($m5m->Rs("m5m_date")));
    $m5m_month = date('m',DateMysqlToPHP($m5m->Rs("m5m_date"))); 
    $m5m_year = date('Y',DateMysqlToPHP($m5m->Rs("m5m_date")));	
	
	
	$mih = new Msql();
	$mih->Connect();
	//$DEBUGSQL=true;
	$mih->Query("select 
		
MIHday, 
MIHmonth, 
MIHyear,
MIHtype,
MIHvnos,
MIHcus,
MIHjob,
MIHdep,
MIHper,
MIHdoc,
MIHmec,
MIHvatNO,
CAST(MIHdesc AS TEXT) AS MIHdesc,
CAST(MIHmemo AS TEXT) AS MIHmemo,
CAST(MIHnotes AS TEXT) AS MIHnotes,
CAST(MIHref1 AS TEXT) AS MIHref1,
CAST(MIHref2 AS TEXT) AS MIHref2,
CAST(MIHref3 AS TEXT) AS MIHref3,

MIHcog,
MIHvatSUM,
MIHnetSUM,
MIHdiscLST,
MIHdiscHF1,
MIHdiscHF2,
CAST(MIHdiscHT1 AS TEXT) AS MIHdiscHT1,
CAST(MIHdiscHT2 AS TEXT) AS MIHdiscHT2,
MIHcurC,
MIHexchg


	
		from MIH where 
		MIHday = $m5m_date and 
		MIHmonth = $m5m_month and  
		MIHyear = $m5m_year and 
		MIHtype = '{$doctype}' and 
		MIHvnos = '{$m5m->Rs('m5m_no')}' and 
		MIHcus = '{$m5m->Rs('m5m_cum_code')}'

	");	
	
	$mil = new Msql();
	$mil->Connect();
	$mil->Query("select 
	MILlistNo,
	MILstk,
	CAST(MILdesc AS TEXT) AS MILdesc,
	CAST(MILuname AS TEXT) AS MILuname,
	CAST(MILvCol1 AS TEXT) AS MILvCol1,
	MILquan,
	MILcog,
	MILsum,
	MILadisc,
	MILdiscA
	
	
	 from MIL,STK where 
		MILday = $m5m_date and 
		MILmonth = $m5m_month and  
		MILyear = $m5m_year and 
		MILtype = '{$doctype}' and 
		MILvnos = '{$m5m->Rs('m5m_no')}' and 
		MILcus = '{$m5m->Rs('m5m_cum_code')}' and
		MILstk=STKcode ");
	while(!$mil->EOF) {
		$MILlistNo = $mil->Rs("MILlistNo","$index");
		$mldata[$MILlistNo]['m5d_pdc_code'] = $mil->Rs("MILstk");
		$mldata[$MILlistNo]['m5d_pdc_name'] = tis620_to_utf8($mil->Rs("MILdesc"));
		$mldata[$MILlistNo]['m5d_pdc_unit'] = $mil->Rs("MILuname");
		$mldata[$MILlistNo]['m5d_vcol'] = tis620_to_utf8($mil->Rs("MILvCol1"));
		$mldata[$MILlistNo]['m5d_qty'] = $mil->Rs("MILquan");
		$mldata[$MILlistNo]['m5d_price'] = $mil->Rs("MILcog");
		$mldata[$MILlistNo]['m5d_total'] = $mil->Rs("MILsum");
		$mldata[$MILlistNo]['MILadisc'] = $mil->Rs("MILadisc");
		$mldata[$MILlistNo]['MILdiscA'] = $mil->Rs("MILdiscA");
		
		$mil->MoveNext();
	}
	
	//vardump($m5data);
	
	
?>

<link href="../resource/css/default.css" rel="stylesheet" type="text/css">


<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#A8EABD" class="mac5_style">
  <tr>
    <td width="120" height="26" align="right" class="mac5_style">เลขที่</td>
    <td width="120" class="mac5_style"><div id="MAC5_DivNo">
      <input id="MAC5_No"  type="text" style="width:100px" value="<?=$m5m->Rs("m5m_no")?>" onBlur="MAC5_SaveNo(this.value,<?=$eorder_id?>)"
       onfocus="MAC5_CheckKeyDown(this,0)"
      >
        </div></td>
    <td width="400" align="center" bgcolor="#339900" class="mac5_style" style="color:#FFFFFF"><strong>ใบนำส่งเข้าโปรแกรม MAC5<?=$AppConfodbc_dbname?></strong></td>
    <td rowspan="3" align="center" valign="top" bgcolor="#FFFFFF" class="mac5_style">
      <table border="0" cellspacing="0" cellpadding="0" class="mac5_style">
        <tr>
          <td class="mac5_style">Product Name</td>
      <td><div id="MAC5_DivProductName" class="mac5_style"><select onChange="MAC5_ChangeProductName(this.value,<?=$eorder_id?>)">
        <option value="T1" <?=$m5m_pdcname=='T1'?'selected':''?>>Thai</option>
        <option value="E1" <?=$m5m_pdcname=='E1'?'selected':''?>>Eng1</option>
        <option value="E2" <?=$m5m_pdcname=='E2'?'selected':''?>>Eng2</option>
        <option value="E3" <?=$m5m_pdcname=='E3'?'selected':''?>>Eng3</option>
        </select></div></td>
    </tr>
        <tr>
          <td class="mac5_style">Curency</td>
      <td>
        <div id="MAC5_DivPriceGroup" class="mac5_style">
          <select onChange="MAC5_ChangePriceGroup(this.value,<?=$eorder_id?>)">
            <option value="THB1" <?=$m5m_pricegroup=='THB1'?'selected':''?>>บาท</option>
            <option value="USD1" <?=$m5m_pricegroup=='USD1'?'selected':''?>>USD1</option>
            <option value="EUR1" <?=$m5m_pricegroup=='EUR1'?'selected':''?>>EUR</option>
            <!--option value="EUR2" <?=$m5m_pricegroup=='EUR2'?'selected':''?>>EUR2(I) ราคาตัวแทนจำหน่าย</option>
            <option value="EUR3" <?=$m5m_pricegroup=='EUR3'?'selected':''?>>EUR3(J) ราคาพิเศษ</option>
            <option value="EUR4" <?=$m5m_pricegroup=='EUR4'?'selected':''?>>EUR4(K) ราคาพิเศษงาน:Lingaul...</option-->
            </select>
          </div>          </td>
    </tr>
        <tr>
          <td class="mac5_style">อัตราแลกเปลียน</td>
          <td><div id="MAC5_DivExchg" class="mac5_style">
          <input type="text"  id="MAC5_Exchg" class="numberfiled" style="width:80px" value="<?=$m5m->Rs("m5m_exchg")?>" 
        onBlur="MAC5_SaveExchg(<?=$eorder_id?>)" onfocus="MAC5_CheckKeyDown(this,0)"></div></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="26" align="right" class="mac5_style">วันที่</td>
    <td class="mac5_style">      
    <input type="text"  id="MAC5_DataD" style="width:20px" value="<?=date('d',DateMysqlToPHP($m5m->Rs("m5m_date")))?>" 
    onBlur="MAC5_SaveDateD(<?=$eorder_id?>)" onfocus="MAC5_CheckKeyDown(this,0)"/>
    <input type="text"  id="MAC5_DataM" style="width:20px" value="<?=date('m',DateMysqlToPHP($m5m->Rs("m5m_date")))?>" 
    onBlur="MAC5_SaveDateM(<?=$eorder_id?>)" onfocus="MAC5_CheckKeyDown(this,0)"/>
    <input type="text"  id="MAC5_DataY" style="width:40px" value="<?=date('Y',DateMysqlToPHP($m5m->Rs("m5m_date")))?>" 
    onBlur="MAC5_SaveDateY(<?=$eorder_id?>)" onfocus="MAC5_CheckKeyDown(this,0)"/>
    <span id="MAC5_DivDate"></span>
    </td>
    <td rowspan="2" valign="top" bgcolor="#FFFFFF" class="mac5_style">
      <label>
      Customer Code
      <input type="text" id="MAC5_CustomerCode" style="width:100px" value="<?=$cum_code?>"  onBlur="MAC5_CheckCustomerCode(<?=$eorder_id?>)" 
      onfocus="MAC5_CheckKeyDown(this,0)">      </label>    
      <br>
        
    <div id="MAC5_DivCutomerName"><?=$cum_nameT?> <?=$cum_add1AT?> <?=$cum_add2AT?> <?=$cum_add3AT?></div></td>
  </tr>
  <tr>
    <td align="right" valign="top" class="mac5_style">เลขใบกำกับภาษี</td>
    <td valign="top" class="mac5_style"><div id="MAC5_DivTaxNo">
      <input id="MAC5_TaxNo" type="text" style="width:100px" value="<?=$m5m->Rs("m5m_taxno")?>" onBlur="MAC5_SaveTaxNo(this.value,<?=$eorder_id?>)"
       onfocus="MAC5_CheckKeyDown(this,0)">
        </div> </td>
  </tr>
</table>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#C0C0C0" class="mac5_style">
  <tr>
    <td width="40" align="center" bgcolor="#E3F9EB" class="mac5_style">No.</td>
    <td width="100" align="center" bgcolor="#E3F9EB" class="mac5_style">รหัสสินค้า</td>
    <td align="center" bgcolor="#E3F9EB" class="mac5_style">รายละเอียด</td>
    <td width="40" align="center" bgcolor="#E3F9EB" class="mac5_style">ปริมาณ</td>
    <td width="80" align="center" bgcolor="#E3F9EB" class="mac5_style">ตัวแปร1</td>
    <td width="60" align="center" bgcolor="#E3F9EB" class="mac5_style">หน่วยนับ</td>
    <td width="81" align="center" bgcolor="#E3F9EB" class="mac5_style">หน่วยละ</td>
    <td width="81" align="center" bgcolor="#E3F9EB" class="mac5_style">ราคาสินค้า</td>
    <td width="81" align="center" bgcolor="#E3F9EB" class="mac5_style">ส่วนลด</td>
    <td width="80" align="center" bgcolor="#E3F9EB" class="mac5_style">ยอดรวม</td>
  </tr>
<? 
$overall = 0;
$totaldiscount = 0;
for($i=1;$i<9;$i++){
	$total = $m5data[$i]['m5d_price']*$m5data[$i]['m5d_qty'];
	$totaldiscount += $m5data[$i]['m5d_discount'];
	$cog = $m5data[$i]['m5d_price']*$m5data[$i]['m5d_qty'];
	$overall+=$total;
?>
  <tr>
    <td align="right" valign="top" bgcolor="#FFFFFF" class="mac5_style"><?=$i?></td>
    <td valign="top" bgcolor="#FFFFFF" class="mac5_style">
    <input type="text"  id="MAC5_DCode_<?=$i?>" style="width:100px" value="<?=$m5data[$i]['m5d_pdc_code']?>"  
        onBlur="MAC5_CheckItemCode(<?=$i?>,<?=$eorder_id?>)" onfocus="MAC5_CheckKeyDown(this,'MAC5_DQty_<?=$i?>')"></td>
    <td valign="top" bgcolor="#FFFFFF" class="mac5_style">
   	  <div id="MAC5_DivName_<?=$i?>">
        <input type="text"  id="MAC5_DName_<?=$i?>" style="width:400px" value="<?=$m5data[$i]['m5d_pdc_name']?>"  
        onBlur="MAC5_SaveName(<?=$i?>,<?=$eorder_id?>)" onfocus="MAC5_CheckKeyDown(this,'MAC5_DQty_<?=$i?>')">
    </div></td>

    <td valign="top" bgcolor="#FFFFFF" class="mac5_style">
    	<div id="MAC5_DivDQty_<?=$i?>">
   	<input type="text"  id="MAC5_DQty_<?=$i?>" class="numberfiled" style="width:40px" value="<?=$m5data[$i]['m5d_qty']>0?$m5data[$i]['m5d_qty']+0:''?>" 
        onBlur="MAC5_RefreshSumTotal(<?=$i?>,<?=$eorder_id?>)"  onfocus="MAC5_CheckKeyDown(this,'MAC5_DVcol_<?=$i?>')"></div></td>   
         <td valign="top" bgcolor="#FFFFFF" class="mac5_style">
    
    <div id="MAC5_DivVcol_<?=$i?>">
        <input type="text"  id="MAC5_DVcol_<?=$i?>" style="width:80px" value="<?=$m5data[$i]['m5d_vcol']?>"  
        onBlur="MAC5_SaveVcol(<?=$i?>,<?=$eorder_id?>)" onfocus="MAC5_CheckKeyDown(this,'MAC5_DCode_<?=$i+1?>')">
      </div>
    </td>
    <td align="right" valign="top" bgcolor="#FFFFFF" class="mac5_style" style="padding-right:5px">
   	<div id="MAC5_DUnit_<?=$i?>"><?=$m5data[$i]['m5d_pdc_unit']?></div></td>
    <td align="right" valign="top" bgcolor="#FFFFFF" class="mac5_style">
      <div id="MAC5_DivDPrice_<?=$i?>">
      <input type="text"  id="MAC5_DPrice_<?=$i?>" class="numberfiled" style="width:80px" value="<?=$m5data[$i]['m5d_price']?>" 
            onBlur="MAC5_RefreshSumTotal(<?=$i?>,<?=$eorder_id?>)" onfocus="MAC5_CheckKeyDown(this,'MAC5_DCode_<?=$i+1?>')"></div>
    	</td>
    <td align="right" valign="top" bgcolor="#FFFFFF" class="mac5_style">
    <div id="MAC5_DCog_<?=$i?>" style="padding-right:5px"><?=$cog>0?number_format($cog,2):''?></div>
    	</td>
    <td align="right" valign="top" bgcolor="#FFFFFF" class="mac5_style">
    	<div id="MAC5_DivDDisc_<?=$i?>">
	<input type="text"  id="MAC5_DDisc_<?=$i?>" class="numberfiled" style="width:80px" value="<?=$m5data[$i]['m5d_discount']?>" 
        onBlur="MAC5_RefreshSumTotal(<?=$i?>,<?=$eorder_id?>)"  onfocus="MAC5_CheckKeyDown(this,'MAC5_DCode_<?=$i+1?>')"></div></td>
    <td align="right" valign="top" bgcolor="#FFFFFF" class="mac5_style"><div id="MAC5_DSum_<?=$i?>"  style="padding-right:5px"><?=$total>0?number_format($total,2):''?></div></td>
  </tr>
<? } ?>
</table>
<table width="100%" border="0" cellpadding="4" cellspacing="1" bgcolor="#A8EABD" class="mac5_style">
  <tr>
    <td width="120" align="right" class="mac5_style">หมายเหตุ</td>
    <td rowspan="2" bgcolor="#A8EABD" class="mac5_style"><textarea id="MAC5_Note" style="width:400px" rows="3"><?=$m5m->Rs("m5m_note")?></textarea></td>
    <td width="100" align="right" class="mac5_style">รวม</td>
    <td width="80" align="right" bgcolor="#FFFFFF" class="mac5_style"><div id="MAC_Total" align="right" style="padding-right:5px">
      <?=$overall>0?number_format($overall,2):''?>
    </div></td>
    <td width="90" align="right" bgcolor="#FFFFFF" class="mac5_style">
    <div id="MAC5_DivDisc"><?=$overall>0?number_format($totaldiscount,2):''?></div></td>
    <td width="80" align="right" bgcolor="#FFFFFF" class="mac5_style">
    <div id="MAC5_Overall" align="right" style="padding-right:5px"><?=$overall>0?number_format($overall-$totaldiscount,2):''?></div></td>
  </tr>
  <tr>
    <td align="right" class="mac5_style">&nbsp;</td>
    <td align="right" class="mac5_style">&nbsp;</td>
    <td align="right" bgcolor="#A8EABD" class="mac5_style">&nbsp;</td>
    <td align="right" bgcolor="#A8EABD" class="mac5_style">&nbsp;</td>
    <td align="right" bgcolor="#A8EABD" class="mac5_style">&nbsp;</td>
  </tr>
</table>
<div align="center" id="MAC5_DivOutput">
<input type="button" value="Send to MAC5" onclick="showHTML('MAC5_DivOutput','../mac5/mac5process.php?act=send&eorderid=<?=$eorder_id?>&note='+encodeTH(getValue('MAC5_Note')),MAC5_OnSend);return false;" />

<? if(!$mih->EOF){ ?>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css">

<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#E3E4EC" class="mac5_style">
  <tr>
    <td width="120" align="right" class="mac5_style">เลขที่</td>
    <td width="100" class="mac5_style"><?=$mih->Rs("MIHvnos")?></td>
    <td width="400" align="center" bgcolor="#BBCBFF" class="mac5_style">ใบแจ้งหนี้ขาย</td>
    <td bgcolor="#FFFFFF" class="mac5_style">
    REF1(Code):
      <?=$mih->Rs("MIHref1")?><br />    </td>
    <td valign="top" bgcolor="#FFFFFF" class="mac5_style"> Currency:
    <?
		switch($mih->Rs("MIHcurC")){
			case 0:echo "Baht";break;
			case 1:echo "USD";break;
			case 2:echo "EUR";break;
			case 3:echo "GBP";break;
			case 4:echo "DEM";break;
			case 4:echo "JPY";break;
		}
	?></td>
  </tr>
  <tr>
    <td align="right" class="mac5_style">วันที่</td>
    <td class="mac5_style">     <?=$mih->Rs("MIHday")?>/<?=$mih->Rs("MIHmonth")?>/<?=$mih->Rs("MIHyear")?>    </td>
    <td rowspan="2" valign="top" bgcolor="#FFFFFF" class="mac5_style">
      <?=$mih->Rs("MIHcus")?> <?=$cum_nameT?><?=$cum_add1AT?><br><?=$cum_add1AT2?><?=$cum_add1AT3?></td>
    <td bgcolor="#FFFFFF" class="mac5_style">REF2(Agent):
      <?=tis620_to_utf8($mih->Rs("MIHref2"))?></td>
    <td valign="top" bgcolor="#FFFFFF" class="mac5_style">อัตราแลกเปลี่ยน :
      <?=$mih->Rs("MIHexchg")?></td>
  </tr>
  <tr>
    <td align="right" valign="top" class="mac5_style">เลขใบกำกับภาษี</td>
    <td valign="top" class="mac5_style"><?=$mih->Rs("MIHvatNO")?></td>
    <td colspan="2" bgcolor="#FFFFFF" class="mac5_style">REF3(Doctor):
      <?=tis620_to_utf8($mih->Rs("MIHref3"))?>
      <br />
DESC(Patient):
<?=tis620_to_utf8($mih->Rs("MIHdesc"))?></td>
    </tr>
</table>
<table width="100%" border="0" cellpadding="1" cellspacing="1" bgcolor="#C0C0C0" class="mac5_style">
  <tr>
    <td width="40" align="center" bgcolor="#C0DDFC" class="mac5_style">No.</td>
    <td width="100" align="center" bgcolor="#C0DDFC" class="mac5_style">รหัสสินค้า</td>
    <td align="center" bgcolor="#C0DDFC" class="mac5_style">รายละเอียด</td>
    <td width="80" align="center" bgcolor="#C0DDFC" class="mac5_style">ตัวแปร1</td>
    <td width="40" align="center" bgcolor="#C0DDFC" class="mac5_style">ปริมาณ</td>
    <td width="60" align="center" bgcolor="#C0DDFC" class="mac5_style">หน่วยนับ</td>
    <td width="80" align="center" bgcolor="#C0DDFC" class="mac5_style">หน่วยละ</td>
    <td width="80" align="center" bgcolor="#C0DDFC" class="mac5_style">ราคาสินค้า</td>
    <td width="80" align="center" bgcolor="#C0DDFC" class="mac5_style">ส่วนลด</td>
    <td width="80" align="center" bgcolor="#C0DDFC" class="mac5_style">ยอดรวม</td>
  </tr>
<? 
$overall = 0;
for($i=1;$i<9;$i++){
	$total = $mldata[$i]['m5d_total'];
	//$total = $mldata[$i]['m5d_price']*$mldata[$i]['m5d_qty'];
	//$overall+=$total;
?>
  <tr>
    <td align="right" bgcolor="#FFFFFF" class="mac5_style"><?=$i?></td>
    <td bgcolor="#FFFFFF" class="mac5_style"><?=$mldata[$i]['m5d_pdc_code']?></td>
    <td bgcolor="#FFFFFF" class="mac5_style"><?=$mldata[$i]['m5d_pdc_name']?></td>
    <td align="right" bgcolor="#FFFFFF" class="mac5_style"><?=$mldata[$i]['m5d_vcol']?></td>
    <td align="right" bgcolor="#FFFFFF" class="mac5_style"><?=$mldata[$i]['m5d_pdc_code']!=''?$mldata[$i]['m5d_qty']+0:''?></td>
    <td align="right" bgcolor="#FFFFFF" class="mac5_style" style="padding-right:5px"><?=$mldata[$i]['m5d_pdc_unit']?></td>
    <td align="right" bgcolor="#FFFFFF" class="mac5_style"><?=$mldata[$i]['m5d_pdc_code']!=''?number_format($mldata[$i]['m5d_price'],2):''?></td>
    <td align="right" bgcolor="#FFFFFF" class="mac5_style"><?=$mldata[$i]['m5d_pdc_code']!=''?number_format($mldata[$i]['m5d_price'],2):''?></td>
    <td align="right" bgcolor="#FFFFFF" class="mac5_style"><?=$mldata[$i]['m5d_pdc_code']!=''?number_format($mldata[$i]['MILdiscA'],2):''?></td>
    <td align="right" bgcolor="#FFFFFF" class="mac5_style"><?=$mldata[$i]['m5d_pdc_code']!=''?number_format($total,2):''?></td>
  </tr>
<? } ?>
</table>
<table width="100%" border="0" cellpadding="2" cellspacing="1" bgcolor="#E3E4EC" class="mac5_style">
  <tr>
    <td align="right" class="mac5_style">ราคาสินค้า</td>
    <td align="right" bgcolor="#FFFFE0" class="mac5_style"><?=number_format($mih->Rs("MIHcog"),2)?></td>
    <td width="120" align="right" class="mac5_style">ส่วนลดรายการ</td>
    <td width="100" align="right" bgcolor="#FFFFE0" class="mac5_style"><?=number_format($mih->Rs("MIHdiscLST"),2)?></td>
    <td width="50" align="right" class="mac5_style">รวม</td>
    <td align="right" bgcolor="#FFFFE0" class="mac5_style"><?=number_format($mih->Rs("MIHcog")-$mih->Rs("MIHdiscLST"),2)?></td>
  </tr>
  <tr>
    <td align="right" class="mac5_style">ส่วนลด 1 %</td>
    <td bgcolor="#FFFFFF" class="mac5_style"><?=number_format($mih->Rs("MIHdiscHT1"),2)?></td>
    <td width="120" align="right" class="mac5_style">ยอดส่วนลด 1</td>
    <td align="right" bgcolor="#FFFFFF" class="mac5_style"><?=number_format($mih->Rs("MIHdiscHF1"),2)?></td>
    <td class="mac5_style">&nbsp;</td>
    <td align="right" bgcolor="#FFFFE0" class="mac5_style"><?=number_format($mih->Rs("MIHcog")-$mih->Rs("MIHdiscLST"),2)?></td>
  </tr>
  <tr>
    <td width="120" align="right" class="mac5_style">Revoke VAT</td>
    <td width="100" bgcolor="#FFFFFF" class="mac5_style"><?=number_format($mih->Rs("MIHdiscHT2"),2)?></td>
    <td width="120" align="right" class="mac5_style">ยอดส่วนลด 2</td>
    <td align="right" bgcolor="#FFFFFF" class="mac5_style"><?=number_format($mih->Rs("MIHdiscHF2"),2)?></td>
    <td class="mac5_style">&nbsp;</td>
    <td align="right" bgcolor="#FFFFE0" class="mac5_style"><?=number_format($mih->Rs("MIHcog")-$mih->Rs("MIHdiscLST")-$mih->Rs("MIHvatSUM"),2)?></td>
  </tr>
  <tr>
    <td align="right" class="mac5_style">VAT %</td>
    <td bgcolor="#FFFFFF" class="mac5_style">7</td>
    <td width="120" align="right" valign="top" class="mac5_style">ยอดภาษี</td>
    <td align="right" valign="top" bgcolor="#FFFFFF" class="mac5_style"><?=number_format($mih->Rs("MIHvatSUM"),2)?></td>
    <td class="mac5_style">&nbsp;</td>
    <td align="right" bgcolor="#FFFFE0" class="mac5_style"><?=number_format($mih->Rs("MIHnetSUM"),2)?></td>
  </tr>
  <tr>
    <td align="right" valign="top" class="mac5_style">หมายเหตุ</td>
    <td colspan="5" class="mac5_style"><pre><?=tis620_to_utf8($mih->Rs("MIHnotes"))?></pre><br />
<br />
<br />
</td>
  </tr>
</table>


<? } ?>
</div>
<br />
<br />
<br />