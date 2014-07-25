<?php
	include_once("../core/default.php");
	GetVar($act,"act");
	GetVar($eorderid,"eorderid");
	$eorder_id = $eorderid;

	GetVar($id,"id");
	GetVar($index,"index");
	GetVar($code,"code");
	
	$code = strtoupper($code);

	$data = new Csql();
	$data->Connect();

	$sqlserv = new Msql();
	$sqlserv->Connect();

	$eorder = new Csql();
	$eorder->Query("select * from eorder where eorderid=$eorderid limit 1");
	if($eorder->EOF) {exit("Invalid e-orderID $eorderid");}
	$ord_cus_id = $eorder->Rs("ord_cus_id");


	$customer = new Csql();
	$customer->Query("select * from customer where customerid=$ord_cus_id limit 1");
	if($customer->EOF) {exit("Invalid customerid $ord_cus_id");}
	$customer->TableName = "customer";
	
	
	$m5m = new Csql();
	$m5m->Query("select * from eorder_m5m where eorder_m5mid=$eorderid limit 1");
	if($m5m->EOF) {
		$m5m->AddNew();
		$m5m->TableName = "eorder_m5m";
		$m5m->Set("eorder_m5mid","'$eorderid'");
		$m5m->Set("m5m_date","CURDATE()");
		$m5m->Set("m5m_pdcname","'{$customer->Rs('cus_pdcname')}'");
		$m5m->Set("m5m_pricegroup","'{$customer->Rs('cus_pricegroup')}'");
		$m5m->Update();
	}
	$m5m->TableName = "eorder_m5m";
	
	
	switch($act){
		case 'saveno':
			GetVar($no,"no");
			$m5m->Set("m5m_no","'{$no}'");
			$m5m->Set("m5m_cacheno1","'".substr($no,0,1)."'");
			$m5m->Set("m5m_cacheno2","'".substr($no,2)."'");
			$m5m->Update();				
			?><input id="MAC5_No" type="text" style="width:100px" value="<?=$m5m->Rs("m5m_no")?>" onBlur="MAC5_SaveNo(this.value,<?=$eorderid?>,'<?=$mac5_db?>')"
            onfocus="MAC5_CheckKeyDown(this,'MAC5_DCode_1')"><?
			break;	
		case 'savetaxno':
			GetVar($taxno,"taxno");
			$m5m->Set("m5m_taxno","'{$taxno}'");
			$m5m->Update();				
			?><input id="MAC5_TaxNo"  type="text" style="width:100px" value="<?=$m5m->Rs("m5m_taxno")?>" onBlur="MAC5_SaveTaxNo(this.value,<?=$eorderid?>,'<?=$mac5_db?>')"
             onfocus="MAC5_CheckKeyDown(this,'MAC5_DCode_1')"
            ><?
			break;	
	
		case 'processcustomercode':
			//$sql = "select  * from DEB where DEBcode='$code' ";
			$sql = "select  TOP 25 DEBcode,
				CAST(DEBnameT AS TEXT) AS DEBnameT,
				CAST(DEBadd1AT AS TEXT) AS DEBadd1AT,
				CAST(DEBadd2AT AS TEXT) AS DEBadd2AT,
				CAST(DEBadd3AT AS TEXT) AS DEBadd3AT
				from DEB where DEBcode like '$code%' 
				or DEBnameT like '%".($code)."%'
				";
			$sqlserv->Query($sql);
			//echo $sql;
			
			
			if($sqlserv->RecordCount==1) {
				
				$cum_code = $sqlserv->Rs("DEBcode");
				$cum_nameT = $sqlserv->Rs("DEBnameT");
				$cum_add1AT = $sqlserv->Rs("DEBadd1AT");
				$cum_add2AT = $sqlserv->Rs("DEBadd2AT");
				$cum_add3AT = $sqlserv->Rs("DEBadd3AT");
				
				if($cum_code==$code){
					$customer->Set("cus_mac_code","'{$code}'");
					$customer->Update();				
	
					$m5m->Set("m5m_cum_code","'{$code}'");
					$m5m->Update();				
					
					
					
	
					echo tis620_to_utf8($cum_nameT)." ".
						tis620_to_utf8($cum_add1AT)." ".
						tis620_to_utf8($cum_add2AT)." ".
						tis620_to_utf8($cum_add3AT);
						
				}else{
					echo '<div class="div-selector-main">'; ?>
					<div class="div-selector-option" onClick="MAC5_CustomerSeletorClick('<?=$cum_code?>',<?=$eorderid?>,'<?=$mac5_db?>')">
						<?=$cum_code?> <?=tis620_to_utf8($cum_nameT)." ".
						tis620_to_utf8($cum_add1AT)." ".
						tis620_to_utf8($cum_add2AT)." ".
						tis620_to_utf8($cum_add3AT);?><br />
						<font color=#ff0000> กรุณาคลิ๊กเพื่อบันทึก</font>
					</div>
                    <?
					echo "</div>";
				}
					
			}else if(!$sqlserv->EOF) {
				echo '<div class="div-selector-main">';
				$i=0;
				while(!$sqlserv->EOF && $i++<20){
					$cum_code = $sqlserv->Rs("DEBcode");
					$cum_nameT = $sqlserv->Rs("DEBnameT");
					$cum_add1AT = $sqlserv->Rs("DEBadd1AT");
					$cum_add2AT = $sqlserv->Rs("DEBadd2AT");
					$cum_add3AT = $sqlserv->Rs("DEBadd3AT");
					
					
					//$customer->Set("cus_mac_code","'{$code}'");
					//$customer->Update();				
	
					//$m5m->Set("m5m_cum_code","'{$code}'");
					//$m5m->Update();				
					
					
					?>
					<div class="div-selector-option" onClick="MAC5_CustomerSeletorClick('<?=$cum_code?>',<?=$eorderid?>)">
						<?=$cum_code?> <?=tis620_to_utf8($cum_nameT)?>
					</div>
                    <?
					
					$sqlserv->MoveNext();
				}
				if(!$sqlserv->EOF){
					echo "!! มีรายการมากกว่า 20 รายชื่อ โปรดใส่ keyword เพิ่มเติม !!";
				}
				
				echo "</div>";
				
			}else{
				echo "!!Invalid Customer code!!";
			}
			
			break;
		case 'changeproductname':
			GetVar($pdcname,"pdcname");
			
			$customer->Set("cus_pdcname","'{$pdcname}'");
			$customer->Update();

			$m5m->Set("m5m_pdcname","'{$pdcname}'");
			$m5m->Update();
			
			$m5m_pdcname = $pdcname;
					?>
					<select onChange="MAC5_ChangeProductName(this.value,<?=$eorderid?>,'<?=$mac5_db?>')">
					  <option value="T1" <?=$m5m_pdcname=='T1'?'selected':''?>>Thai</option>
					  <option value="E1" <?=$m5m_pdcname=='E1'?'selected':''?>>Eng1</option>
					  <option value="E2" <?=$m5m_pdcname=='E2'?'selected':''?>>Eng2</option>
					  <option value="E3" <?=$m5m_pdcname=='E3'?'selected':''?>>Eng3</option>
					  </select>
					
					<?
			
			break;	
		case 'changepricegroup':
			GetVar($pricegroup,"pricegroup");
			
			$customer->Set("cus_pricegroup","'{$pricegroup}'");
			$customer->Update();
			

			$exchangerate['EXTHB'] = 1;
			$dataex = new Csql();
			$dataex->Connect();	
			$dataex->Query("SELECT * FROM conf where con_key like 'EX%'");
			while(!$dataex->EOF){
				$exchangerate[$dataex->Rs('con_key')] =  $dataex->Rs('con_value');
				$dataex->MoveNext();
			}
						
			
			$m5m->Set("m5m_pricegroup","'{$pricegroup}'");
			$m5m->Set("m5m_exchg","'".($exchangerate['EX'.substr($pricegroup,0,3)]+0)."'");
			$m5m->Update();		
			


			$m5m_pricegroup = $pricegroup;
			?>
			<select onChange="MAC5_ChangePriceGroup(this.value,<?=$eorderid?>)">
            <option value="THB1" <?=$m5m_pricegroup=='THB1'?'selected':''?>>บาท</option>
            <option value="USD1" <?=$m5m_pricegroup=='USD1'?'selected':''?>>EUR</option>
            <option value="EUR1" <?=$m5m_pricegroup=='EUR1'?'selected':''?>>EUR</option>
				  </select>
			
			<?


			break;						
			
			
		case 'processitemname':
			$pdcname = $m5m->Rs("m5m_pdcname");
			$pricegroup = $m5m->Rs("m5m_pricegroup");
			if($code==''){
				$m5d = new Csql();
				$m5d->Execute("delete from eorder_m5d where eorder_m5did=$eorderid and m5d_index = $index limit 1");
				exit();
			}
		
			//echo $price;
			//$DEBUGSQL=true;
			$sqlserv->Query("select 
			STKcode,
			CAST(STKdesc{$pdcname} AS TEXT) AS STKdesc{$pdcname},
			CAST(STKuname1 AS TEXT) AS STKuname1
			
			from STK where STKcode like '$code%' or STKdesc{$pdcname} like '%$code%'");
			
			if($sqlserv->RecordCount==1) {
			
				$STKcode = $sqlserv->Rs("STKcode");
				$STKdesc = $sqlserv->Rs("STKdesc{$pdcname}");
				$STKuname1 = $sqlserv->Rs("STKuname1");
				
				if($STKcode==$code){
				
					$price = 0;
					$linkvcid = 0;
					$sql = "select  DPGprice,DPGAutoNO from DPG where DPGscode='$code' and  DPGccode = '{$m5m->Rs('m5m_cum_code')}'";
					$sqlserv->Query($sql);
					if(!$sqlserv->EOF) {
						$price = $sqlserv->Rs("DPGprice")+0;
						$linkvcid = $sqlserv->Rs("DPGAutoNO");
					}else{
						$sql = "select  STPprice from STP where STPcode='$code' and  STPsp = 1";
						$sqlserv->Query($sql);
						if(!$sqlserv->EOF) {
							$price = $sqlserv->Rs("STPprice")+0;
						}else{
							$price = 0;
						}
					}						
				
				
					$m5d = new Csql();
					$m5d->Query("select * from eorder_m5d where eorder_m5did=$eorderid and m5d_index = $index limit 1");
					if($m5d->EOF) {
						$m5d->AddNew();
						$m5d->TableName = "eorder_m5d";
						$m5d->Set("eorder_m5did","'$eorderid'");
						$m5d->Set("m5d_index","$index");
						$m5d->Set("m5d_pdc_code","'$STKcode'");
						$m5d->Set("m5d_pdc_name","'$STKdesc'");
						$m5d->Set("m5d_pdc_unit","'$STKuname1'");
						$m5d->Set("m5d_qty","0");
						$m5d->Set("m5d_price","".($price+0)."");
						$m5d->Set("m5d_discount","0");
						$m5d->Set("m5d_prove","TRUE");
						$m5d->Set("m5d_linkvcid","$linkvcid");
						$m5d->Update();
						//echo "Add->".$price;
					}else{
						if($m5d->RS('m5d_pdc_code')!=$code) {
							$m5d->TableName = "eorder_m5d";				
							$m5d->Set("eorder_m5did","'$eorderid'");
							$m5d->Set("m5d_pdc_code","'$STKcode'");
							$m5d->Set("m5d_index","'$index'");
							$m5d->Set("m5d_pdc_name","'$STKdesc'");
							$m5d->Set("m5d_pdc_unit","'$STKuname1'");
							$m5d->Set("m5d_qty","0");
							$m5d->Set("m5d_price","$price");
							$m5d->Set("m5d_discount","0");
							$m5d->Set("m5d_prove","TRUE");
							$m5d->Set("m5d_linkvcid","$linkvcid");
							$m5d->Update("and m5d_index=$index");					
						}
					}
				
					$name = $STKdesc;
					echo "<input type=\"text\"  id=\"MAC5_DName_{$index}\" style=\"width:400px\" value=\"".$name."\" 
							onBlur=\"MAC5_SaveName({$index},{$eorderid},'{$mac5_db}')\"  onfocus=\"MAC5_CheckKeyDown(this,'MAC5_DQty_{$index}')\">";
				}else{
					echo '<div class="div-selector-main">'; ?>
					<div class="div-selector-option" onClick="MAC5_ItemSeletorClick('<?=$STKcode?>',<?=$index?>,<?=$eorderid?>,'<?=$mac5_db?>')">
						<?=$STKcode?> <?=tis620_to_utf8($STKdesc)?><br />
						<font color=#ff0000> กรุณาคลิ๊กเพื่อบันทึก</font>
					</div>
                    <?
					echo "</div>";
				}

			}else if(!$sqlserv->EOF) {
				echo '<div class="div-selector-main">';
				$i=0;
				while(!$sqlserv->EOF && $i++<20){
					$STKcode = $sqlserv->Rs("STKcode");
					$STKdesc = $sqlserv->Rs("STKdesc{$pdcname}");
					$STKuname1 = $sqlserv->Rs("STKuname1");
					
					
					//$customer->Set("cus_mac_code","'{$code}'");
					//$customer->Update();				
	
					//$m5m->Set("m5m_cum_code","'{$code}'");
					//$m5m->Update();				
					
					
					?>
					<div class="div-selector-option" onClick="MAC5_ItemSeletorClick('<?=$STKcode?>',<?=$index?>,<?=$eorderid?>,'<?=$mac5_db?>')">
						<?=$STKcode?> <?=tis620_to_utf8($STKdesc)?>
					</div>
                    <?
					
					$sqlserv->MoveNext();
				}
				if(!$sqlserv->EOF){
					echo "!! มีรายการมากกว่า 20 รายชื่อ โปรดใส่ keyword เพิ่มเติม !!";
				}
				
				echo "</div>";
				
			}else{
				echo "!!Invalid Item code!!";
			}
			
			break;
					
		case 'processitemunit':
			$m5d = new Csql();
			$m5d->Query("select * from eorder_m5d where eorder_m5did=$eorderid and m5d_index = $index limit 1");
			if(!$m5d->EOF) {
				$unit  = $m5d->Rs("m5d_pdc_unit");
				echo "$unit";
			}else{
				echo "";
			}

			break;
					
		case 'processitemcog':
			if($code==''){
				echo "";
				exit();
			}		
			$cog = 0;
			$m5d = new Csql();
			$m5d->Query("select * from eorder_m5d where eorder_m5did=$eorderid and m5d_index = $index limit 1");
			if(!$m5d->EOF) {
				$cog  = $m5d->Rs("m5d_price")*$m5d->Rs("m5d_qty");
			}else{

			}	
			echo number_format($cog,2);
			/*$pricegroup = $m5m->Rs("m5m_pricegroup");

			$data->Query("select pdc_price_{$pricegroup} from product where pdc_code='$code' limit 1");
			if(!$data->EOF) {
				$price = $data->Rs("pdc_price_{$pricegroup}");
				//$price = 100;
				echo number_format($price,2);
			}else{ 
				echo "!!Invalid Item code!!";
			}*/
			
			break;
					
		case 'processitemprice':
			if($code==''){
				echo "<input type=\"text\"  id=\"MAC5_DPrice_{$index}\" class=\"numberfiled\" style=\"width:80px\" value=\"\" 
				onBlur=\"MAC5_RefreshSumTotal({$index},{$eorderid},'{$mac5_db}')\"  onfocus=\"MAC5_CheckKeyDown(this,'MAC5_DCode_".($index+1)."')\">";
				exit();
			}
			/*$price = null;

			$sql = "select  * from DPG where DPGscode='$code' and  DPGccode = '{$m5m->Rs('m5m_cum_code')}'";
			$sqlserv->Query($sql);
			
			if(!$sqlserv->EOF) {
				$price = $sqlserv->Rs("DPGprice")+0;
			}else{
				$sql = "select  * from STP where STPcode='$code' and  STPsp = 1";
				$sqlserv->Query($sql);
				if(!$sqlserv->EOF) {
					$price = $sqlserv->Rs("DPGprice")+0;
				}else{
					echo "<input type=\"text\"  id=\"MAC5_DPrice_{$index}\" class=\"numberfiled\" style=\"width:80px\" value=\"\" 
				onBlur=\"MAC5_RefreshSumTotal({$index},{$eorderid})\" >";
					exit();
				}
			}*/
			
			$m5d = new Csql();
			$m5d->Query("select * from eorder_m5d where eorder_m5did=$eorderid and m5d_index = $index limit 1");
			if(!$m5d->EOF) {
				$price  = $m5d->Rs("m5d_price");
				echo "<input type=\"text\"  id=\"MAC5_DPrice_{$index}\" class=\"numberfiled\" style=\"width:80px\" value=\"".number_format($price,2)."\" 
					onBlur=\"MAC5_RefreshSumTotal({$index},{$eorderid},'{$mac5_db}')\"  onfocus=\"MAC5_CheckKeyDown(this,'MAC5_DCode_".($index+1)."')\">";
			}else{
				echo "<input type=\"text\"  id=\"MAC5_DPrice_{$index}\" class=\"numberfiled\" style=\"width:80px\" value=\"\" 
					onBlur=\"MAC5_RefreshSumTotal({$index},{$eorderid},'{$mac5_db}')\"  onfocus=\"MAC5_CheckKeyDown(this,'MAC5_DCode_".($index+1)."')\">";
			}
			

			
			/*$pricegroup = $m5m->Rs("m5m_pricegroup");

			$data->Query("select pdc_price_{$pricegroup} from product where pdc_code='$code' limit 1");
			if(!$data->EOF) {
				$price = $data->Rs("pdc_price_{$pricegroup}");
				//$price = 100;
				echo "<input type=\"text\"  id=\"MAC5_DPrice_{$index}\" class=\"numberfiled\" style=\"width:80px\" value=\"".number_format($price,2)."\" 
				onBlur=\"MAC5_RefreshSumTotal({$index},{$eorderid})\" >";
			}else{ 
				echo "!!Invalid Item code!!";
			}*/
			
			break;
		case 'savename':
			GetVar($name,'name');
			$m5d = new Csql();
			$m5d->Query("select * from eorder_m5d where eorder_m5did=$eorderid and m5d_index = $index limit 1");
			if(!$m5d->EOF) {
				$m5d->TableName = "eorder_m5d";				
				$m5d->Set("eorder_m5did","'$eorderid'");
				$m5d->Set("m5d_pdc_name","'$name'");
				$m5d->Update("and m5d_index=$index");					
			}
			echo "<input type=\"text\"  id=\"MAC5_DName_{$index}\" style=\"width:400px\" value=\"".$name."\" 
					onBlur=\"MAC5_SaveName({$index},{$eorderid},'{$mac5_db}')\"  onfocus=\"MAC5_CheckKeyDown(this,'MAC5_DQty_".($index+1)."')\">";
			
			break;
		case 'savevcol':
			GetVar($vcol,'vcol');
			$m5d = new Csql();
			$m5d->Query("select * from eorder_m5d where eorder_m5did=$eorderid and m5d_index = $index limit 1");
			if(!$m5d->EOF) {
				$m5d->TableName = "eorder_m5d";				
				$m5d->Set("eorder_m5did","'$eorderid'");
				$m5d->Set("m5d_vcol","'$vcol'");
				$m5d->Update("and m5d_index=$index");					
			}
			echo "<input type=\"text\"  id=\"MAC5_DVcol_{$index}\" style=\"width:80px\" value=\"".$vcol."\" 
					onBlur=\"MAC5_SaveVcol({$index},{$eorderid},'{$mac5_db}')\"  onfocus=\"MAC5_CheckKeyDown(this,'MAC5_DCode_".($index+1)."')\">";

            break;

		case 'savediscount':
			GetVar($disc,"disc");
			$m5m->Set("m5m_discount","'$disc'");
			$m5m->Update();		
			?>
			<input type="text"  id="MAC5_Disc" class="numberfiled" style="width:80px" value="<?=number_format($m5m->Rs('m5m_discount')+0,2)?>" 
		        onBlur="MAC5_SaveDisCount(<?=$eorderid?>,'<?=$mac5_db?>')" onfocus="MAC5_CheckKeyDown(this,'MAC5_DCode_1')"><?
			break;
			
			
		case 'savedate':
			GetVar($d,"d");
			GetVar($m,"m");
			GetVar($y,"y");
			if($y>2500){
				$y-=543;
			}
			$d = str_pad($d,2,'0',STR_PAD_LEFT);
			$m = str_pad($m,2,'0',STR_PAD_LEFT);
			$m5m->Set("m5m_date","'$y-$m-$d'");
			$m5m->Update();		
			break;
		case 'saveexchg':
			GetVar($exchg,"exchg");
			$m5m->Set("m5m_exchg","'$exchg'");
			$m5m->Update();		
			?>
			<input type="text"  id="MAC5_Exchg" class="numberfiled" style="width:80px" value="<?=number_format($m5m->Rs('m5m_exchg')+0,2)?>" 
		        onBlur="MAC5_SaveExchg(<?=$eorderid?>,'<?=$mac5_db?>')"  onfocus="MAC5_CheckKeyDown(this,'MAC5_DCode_1')"><?
			break;
		case 'getexchange':
			GetVar($pricegroup,"pricegroup");
			
			$exchangerate['EXTHB'] = 1;
			$dataex = new Csql();
			$dataex->Connect();	
			$dataex->Query("SELECT * FROM conf where con_key like 'EX%'");
			while(!$dataex->EOF){
				$exchangerate[$dataex->Rs('con_key')] =  $dataex->Rs('con_value');
				$dataex->MoveNext();
			}
			
			?>
			<input type="text"  id="MAC5_Exchg" class="numberfiled" style="width:80px" value="<?=number_format($exchangerate['EX'.substr($pricegroup,0,3)]+0,2)?>" 
		        onBlur="MAC5_SaveExchg(<?=$eorderid?>,'<?=$mac5_db?>')"  onfocus="MAC5_CheckKeyDown(this,'MAC5_DCode_1')"><?
			break;			
		case 'savenote':
			GetVar($note,"note");
			$m5m->Set("m5m_note","'$note'");
			$m5m->Update();		
			?>
			<input type="text"  id="MAC5_Exchg" class="numberfiled" style="width:80px" value="<?=number_format($m5m->Rs('m5m_exchg')+0,2)?>" 
		        onBlur="MAC5_SaveExchg(<?=$eorderid?>,'<?=$mac5_db?>')" ><?
			break;
		case 'calsum':
			GetVar($qty,"qty");
			GetVar($price,"price");
			GetVar($discount,"discount");
			$qty+=0;
			$price+=0;
			$discount+=0;

			$m5d = new Csql();
			$m5d->Query("select * from eorder_m5d where eorder_m5did=$eorderid and m5d_index = $index limit 1");
			if($m5d->EOF) {
				exit();
			}else{
				$m5d->TableName = "eorder_m5d";				
				$m5d->Set("eorder_m5did","'$eorderid'");
				$m5d->Set("m5d_qty","$qty");
				$m5d->Set("m5d_price","$price");
				$m5d->Set("m5d_discount","$discount");
				$m5d->Update("and m5d_index=$index");					
			}
			

			echo number_format($qty*$price-$discount,2);
			
			break;					
		

	}
	

?>