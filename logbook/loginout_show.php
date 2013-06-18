<?
	include_once("../core/default.php"); 
// IN
	$filterroom 	= $_COOKIE["filterroom"];	

//DEFINE
	$enablefilter = false;
	if(!isset($filterroom)){$filterroom='';}
	

// VALIDATE		
/*
	if(!isset($_COOKIE["staffsection"])){
		gotourl("../staff/index.php");
		exit();
	}
	*/

// INIT
	$cache = array();
	
	$data_logbook = new Csql();
	$data_logbook->Connect();

	//$sectionid = $_COOKIE["staffsection"];
	//$revalue = $data_logbook->PassValue("section","sectionid=$sectionid",array("sec_room"));
	
	//$sectionname = $revalue['sec_room'];


	
	$filtersql = '';	
	$filtersection = array();
	$filterroomA = array();
	$filterroomA[] = 0;
	if(isset($filterroom) && strlen($filterroom)>0){
		$filterroomA = convertToArray($filterroom);
		/*foreach($filterroomA as $f){
			$filtersection[$f+0] = true;
			$filtersql.= " stf_sec_id = $f  or";
		}*/
		
	}
	$filtersql.= " FALSE ";	
	
	
	
	$data_order = new Csql();
	$data_staff = new Csql();
	
	
	$data_section = new Csql();
	$data_section->Query("select * from section where sectionid in (".implode(',',$filterroomA).") order by sec_type,sec_room");	
	
	
	
	?>
	
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
	
	<?  
		while(!$data_section->EOF){

			$data_logbookAr = $data_logbook->ExecuteARecord("
			select count(logbooktodayid) as countlog from logbooktoday
			where logt_sec_id = ".$data_section->Rs("sectionid")." and DATE(logt_date)  =  CURDATE() and logt_type='OUT'")
		 ?>
         
          <tr>
            <td colspan="6" bgcolor="#CCCCFF" class="Normal">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr><td>
            <b>Section : 
			<a href="../section/sectiondetail_c.php?sectionid=<?= $data_section->Rs("sectionid"); ?>"
				target="_blank">
				<?= $data_section->Rs("sec_room"); ?></a>			</b>			</td>
			 <td bgcolor="#CCCCFF" class="Normal" align="right">
			 (งานเสร็จไปแล้ว <?= $data_logbookAr["countlog"]+0; ?> กล่อง)			</td></tr></table></td>
		</tr>	
		
		<?
		
		$data_staff->Query("select * from staff where stf_sec_id =".$data_section->Rs("sectionid")." order by stf_name");
		$staffIndex=0;
		while(!$data_staff->EOF){
			$data_logbook->Query("
			select logbookworkingid as logbookid,
			DATE_FORMAT(logw_date,'%d/%m %H:%i') as log_date,
			HOUR(TIMEDIFF(NOW(),logw_date)) as log_longh,
			MINUTE(TIMEDIFF(NOW(),logw_date)) as log_longm,
			logw_stf_id as log_stf_id,logw_ord_id
			from logbookworking where logw_stf_id = ".$data_staff->Rs("staffid"));

			$countLogbook = $data_logbook->Count();
			
			
			
		?>
		<tr <?=$staffIndex%2==1?'style="background-color:#DDD"':""?>>
            <td width="200" rowspan="<?=$countLogbook?>">
		
			<a href="../staff/staffdetail_c.php?staffid=<?= $data_staff->Rs("staffid"); ?>" target="_blank" 
             title="<?= $data_staff->Rs("stf_code"); ?>"
            >
			<?= $data_staff->Rs("stf_name"); ?></a>
			</td>
			
			<? $i=0;while(!$data_logbook->EOF){ ?>
			<? if($i>0){ ?> <tr <?=$staffIndex%2==1?'style="background-color:#DDD"':""?>><? } ?>
			<? $order = $data_order->ExecuteARecord("select TIME_TO_SEC(TIMEDIFF(ordt_releasedate,NOW())) as islate,
	HOUR(TIMEDIFF(ordt_releasedate,NOW())) as release_datehr,
	MINUTE(TIMEDIFF(ordt_releasedate,NOW())) as release_datemn,eordertodayid as eorderid,ordt_typeofwork as ordt_typeofwork,ordt_releasedate as ord_releasedate,ordt_code as ord_code from eordertoday where eordertodayid = ".$data_logbook->Rs("logw_ord_id"));?>
			
			<td <?=$staffIndex%2==1?'style="background-color:#DDD"':""?> class="tdRowOnOut" onMouseOver="this.className='tdRowOnOver'" onMouseOut="this.className='tdRowOnOut'" 
            onClick="OpenDivShowSummary(<?= $order["eorderid"]; ?>)" >
			<?= $order["ord_code"]; ?></td>
            <td width="80" align="right"><?= $data_logbook->Rs("log_date"); ?></td>
			<td width="40" align="right">(<?=$data_logbook->Rs("log_longh")>0?$data_logbook->Rs("log_longh").":":""?><?=str_pad($data_logbook->Rs("log_longm"),2,'0',0); ?>)</td>
			<td> 
			
			
			  <?
				if($order["islate"]<0){
					echo "<font color=#ff0000>เลยมา ".($order["release_datehr"])." ชม. ".($order["release_datemn"]) ." นาที</font>";
				}else	if($order["release_datehr"]+0>0){
					echo "อีก ".($order["release_datehr"]+0)." ชม. ".($order["release_datemn"]+0) ." นาที";
				}else if($order["release_datehr"]+0==0){
					echo "อีก ".($order["release_datemn"]+0) ." นาที";
				}
						
						
						?>			  </td>
					
					<td align="left"><?=$order["ordt_typeofwork"]?></td>			
			
			
			</tr>
			
			
			<? $data_logbook->MoveNext();$i++;} ?>
			<? if($data_logbook->Count()==0){?><td colspan=5></td></tr><?}?>
		<? $data_staff->MoveNext();$staffIndex++;} ?>
		
		
		<? $data_section->MoveNext();} ?>
	
	
	
	</table>
	
	<?
	exit();
	
	
	
	
	$data_logbook->Query("select logbookid,stf_name,stf_code,sec_room,ord_code,eorderid,staffid,sectionid,
	DATE_FORMAT(log_date,'%d/%m %H:%i') as log_date,
	HOUR(TIMEDIFF(NOW(),log_date)) as log_longh,
	MINUTE(TIMEDIFF(NOW(),log_date)) as log_longm,
	countlog,ordt_typeofwork,
	TIME_TO_SEC(TIMEDIFF(ord_releasedate,NOW())) as islate,
	HOUR(TIMEDIFF(ord_releasedate,NOW())) as release_datehr,
	MINUTE(TIMEDIFF(ord_releasedate,NOW())) as release_datemn,
	log_date as orderlogdate

	
	 from 
	(select staffid,stf_name,stf_code,stf_sec_id,sec_room,sec_type,sectionid
	from staff,section where sectionid=stf_sec_id and ($filtersql)) as stf

	left join(
		select logt_sec_id as log_sec_id,count(logbooktodayid) as countlog from logbooktoday 
		where DATE(logt_date)  =  CURDATE() and logt_type='OUT'
		group by logt_sec_id
	)as counttoday on sectionid = log_sec_id 

	left join (
		select logbookworkingid as logbookid,logw_date as log_date,
		eordertodayid as eorderid,ordt_typeofwork as ordt_typeofwork,ordt_releasedate as ord_releasedate,ordt_code as ord_code,
		logw_stf_id as log_stf_id 
		from logbookworking,eordertoday where eordertodayid=logw_ord_id )as logb 
		on staffid = log_stf_id 

	order by sec_room,stf_name,orderlogdate");
	
	
	
	$data_staff = new Csql();
	$data_staff->Query("select * from staff,section where sectionid=stf_sec_id and stf_sec_id in (",implode(',',$filterroomA),") order by sec_type,sec_room");
	
	
	
	
	/*-------------- optimize -------------------*/
	$data_tmp = new Csql();
	$data_tmp->Connect();
	
	
	$data_logbookAr = array();
	
	while(!$data_logbook->EOF){
		$rowAr = $data_logbook->CurrentRowArray();
	
		$key = $rowAr['log_ord_id'];
		if($cache['eorder'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select ord_code from eorder where eorderid = {$key} limit 0,1");
			$cache['eorder'][$key] = $tmpRow;
		}
		$rowAr['eorderid'] = $rowAr['log_ord_id'];
		$rowAr['ord_code'] = $cache['eorder'][$key]["ord_code"];
	
		$key = $rowAr['log_stf_id'];
		if($cache['staff'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select stf_name from staff where staffid = {$key} limit 0,1");
			$cache['staff'][$key] = $tmpRow;
		}
		$rowAr['stf_name'] = $cache['staff'][$key]["stf_name"];
	
	
		$key = $rowAr['log_sec_id'];
		if($cache['section'][$key]==NULL){
			$tmpRow = $data_tmp->ExecuteARecord("select sec_room from section where sectionid = {$key} limit 0,1");
			$cache['section'][$key] = $tmpRow;
		}
		$rowAr['sec_room'] = $cache['section'][$key]["sec_room"];
	
	
	
	
		$data_logbookAr[] = $rowAr;
		$data_logbook->MoveNext();
	
	}
	/*-------------- optimize -------------------*/
		
	
	
	
	
	
	
	
	
	
	
	
	
?>

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
        </table>