<? include_once("../core/default.php"); 

include_once("../textdb/eorder_repairrework_conftable.php");
?>


<html>
<title><?=WEBSITE_HEADER  ?></title>
<link href="../resource/css/default.css" rel="stylesheet" type="text/css" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<body style="background-color:#FFFFFF">
<? /* */include_once("../cfrontend/ordersummary.php"); ?>
<? /* */ include_once "../resource/divbackground.php" ?>
<center> 
  <strong><span class="Normal"><font size="+2">Order repair list<br>
Date :
  <?=($cdate+0)?> <?=passThaiMonth($cmonth)?> <?=passThaiYear($cyear)?> - 
  <?=($edate+0)?> <?=passThaiMonth($emonth)?> <?=passThaiYear($eyear)?>
</font> </span></strong></center>
<?
$defectSumAr = array();
foreach($data_orderAr as $dt_order){ 
	
	$defectcode = $dt_order["eorder_repairrework_defectcode"];
	$defectSumAr[$defectcode]++;
    
  		
	
}

?>
<table border="0" cellspacing="0" cellpadding="1" class="Normal" align="center">
<tr><td>Defect</td><td></td>
  	 <td>Total</td>
  	  <td>&nbsp;</td>
     </tr>
     
     
	<? 
	foreach($defectSumAr as $defectcode => $sum){

		
		if($glo_defectcode_table[$defectcode]!=NULL){
		  		$defectcode_text = $defectcode.":".$glo_defectcode_table[$defectcode];
		  	}else{
		  		$defectcode_text = "";
		  	}
		?>		
		
         <tr>
         <td>
        	<?=$defectcode_text;?>
         </td>
         
			 <td align="right" width=50><?=number_format($sum,0) ?></td>
					<td align="left">
					<table  border="0" cellspacing="2" cellpadding="2">
					<tr><td  bgcolor="#CC3300"
					<? //=$data_perday->Rs("sumall")+0==$maxperday?"#FF0000":"#CC3300" ?>
					width="<?=$sum/2 ?>" height=12></td></tr></table>
			</td>
			
			</tr>

            <? }?>
			

	
	 		

</table>

</body></html>
<script>hideLoading()</script>
<? 
include_once '../core/inc_pngfix.php';
//echo replacePngTags(ob_get_clean()); ?>