<? 
	$SKIPPERMISSION = true;
	include_once("../core/default.php"); 
	
	$query = isset($_GET["q"]) ? $_GET["q"] : " ";
	$query = trim($query);
	$data = new Csql();
	$data->Connect();
	
	$unuse_word = array("สหคลิ","สหคลี","คลิ","คลี","นิก","นิค","โรงพยาบาล","รพ.","ร.พ.","บริษัท","จำกัด","บ.","ทันตแพทย์","ทพ.ญ.","ทพ.","ทญ.","แลป","แล็ป","แลบ","แล็บ","dental","clinic"," ");
	for($i=0;$i<count($unuse_word);$i++) {
		$query = str_replace($unuse_word[$i],"%",$query);
	}
	$query = "%".$query."%";
	while(strchr($query,"%%") > -1) {
		$query = str_replace("%%","%",$query);
	}
	//echo $query;
	$data->Query("select count(*) as countall from customer where cus_name like '$query'");
	$totalfound = $data->Rs("countall");
	
	$data->Query("select * from customer where cus_name like '$query' limit 0,20");
	
	if($data->Count()==1){ 
		$act="input";
		$cid=$data->Rs("customerid");
		include ("../cregister/customer_authen.php");
		exit();
	}
	
?>
<div style="width:400px" align="center">
<? include "../cfrontend/tbframe2h.php"?>
<table width="100%" border="0" cellpadding="2" cellspacing="1">
  <tr>
    <td align="center">
	 <?  if($data->Count()>0){ ?>
    <span style="font-weight: bold">
     <?  if($totalfound>20){ ?>
    Found <?=$totalfound?> record. Please specify more keyword<br />
    <? } ?>
    
    
<?=T_SELECT;?> <?=T_CUSTNAME;?></span>


    <? }else{ ?>
    <font color="#FF0000">
    <strong>No record found.Try again with other keywords.
	
</strong></font><br />
If you have a problem please contect us.
    <br /> <?=T_EMAILADDR;?>: pppstudio@gmail.com
    <br /> 
    <?=T_TELNO;?>
    : (+66) 08-6728-3309 (pitipong) </font>
    <br />
    <? } ?>
    </td>
  </tr>
  <? while(!$data->EOF){ ?>
  <tr>
    <td style="padding-left:10px;padding-right:10px; cursor:pointer" 
    onclick="showHTML('DivShowCustomer','../cregister/customer_authen.php?act=input&cid=<?=$data->Rs("customerid")?>');setValue('q','<?=$data->Rs("cus_name")?>');"  onmouseover="this.style.background='#DCEECA'" 
    onmouseout="this.style.background=''"><?=$data->Rs("cus_name");?></td>
  </tr>
<? 
		$data->MoveNext(); 
		} 
?>
  <!-- tr>
    <td  align="left" style="padding-left:10px;padding-right:10px; cursor:pointer" 
    onclick="showHTML('DivShowCustomer','../cregister/customer_new.php?a=1');setValue('q','');"  onmouseover="this.style.background='#DCEECA'" 
    onmouseout="this.style.background=''">*** <?=T_REGISTER;?> <?=T_NCUSTOMER;?> ***</td>
  </tr-->
</table>
<? include "../cfrontend/tbframe2f.php"?>
</div>