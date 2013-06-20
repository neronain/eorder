<?

			$data = new CSql();
			$data->Connect();


//INSERT
			$data->Addnew();
			$data->TableName = "customer";
			$data->Set("cus_name","'$cusname'");
			$data->Set("cus_nick","'$cusnick'");
			$data->Set("cus_cnt_id","$country");
			$data->Set("cus_prv_id","$province");
			$data->Update();
					
//UPDATE					
			$data->Query("select * from customer where customerid=$customerid limit 0,1");				
			$data->TableName = "customer";
			$data->Set("cus_name","'$cusname'");
			$data->Set("cus_nick","'$cusnick'");
			$data->Set("cus_prv_id","$province");
			$data->Update();
//DEL
			$data->Execute("Delete customer WHERE customerid=$customerid");
//SELECT
		$data->Query("select * from customer");			
		while(!$data->EOF){
		
			$cusname 		= $data->Rs("cus_name");
			$cusnick	 	= $data->Rs("cus_nick");
			$province 		= $data->Rs("cus_prv_id");		
			
			$data->MoveNext();
		}
?>

<div onmouseover="this.style.background='#FFE1A4'" onmouseout="this.style.background='#FFFFFF'" style="cursor:pointer" 
  onclick="javascript:location='http://www.google.com';"></div>



<!--   Page running     -->
<?
	$data_order = new CSql();
 	$err =	$data_order->Connect();
	$iquery = "select ord_code,cus_name,doc_name,ord_patientname,eorderid,
	DATE_FORMAT(ord_date,'%d/%m/%y') as ord_datel,ord_date,ord_remark 
	
	 ";
	$cquery = "select count(*) as countrow ";
	$query = "from eorder,customer,doctor 
		where 
			ord_cus_id = customerid and 
			ord_doc_id = doctorid 
			
			$where
			
			order by ord_date desc,eorderid desc
			";
	$cquery.=$query;
	$query = $iquery.$query;
	$data_order->Query("$cquery");
	$totalrow = $data_order->Rs("countrow");
	$data_order->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");//Query("select * from ");
		
		
	
	//$page = 10;	
	$totalpage = ceil($totalrow/$eachpage);
?>




<table cellspacing="0" cellpadding="0"><tr><td width="50">
<?

	//$data->Query("$query  limit ".(($page-1)*$eachpage).",$eachpage");
	$page = $_GET["page"]; if(!isset($page))$page = 1;
	
	$eachpage = $_GET["eachpage"]; if(!isset($eachpage))$eachpage = 15;	
	
					if($totalpage>1){
			 if($page!=1){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=1\"><img src=\"../resource/images/silkicons/resultset_first.gif\" width=\"16\" height=\"16\" border=0></a></a>";	 }
			?></td><td width="50"><?
			if($page>1){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=".($page-1)."\"><img src=\"../resource/images/silkicons/resultset_previous.gif\" width=\"16\" height=\"16\" border=0></a>";	 }
			?></td><td align="center" width="300"><?
			for($p=max(1,$page-3);$p<=$page+3 && $p<=$totalpage;$p++){ 
					if($p==$page){
						echo "&nbsp;&nbsp;&nbsp;<strong>$p</strong>&nbsp;&nbsp;&nbsp;";
					}else{
						echo "&nbsp;&nbsp;<a href=\"../order/orderlist_c.php".$querystring."page=$p\">$p</a>&nbsp;&nbsp;";		
					}
			} ?>
			</td><td width="50" align="right">
			<? if($page<$totalpage){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=".($page+1)."\"><img src=\"../resource/images/silkicons/resultset_next.gif\" width=\"16\" height=\"16\" border=0></a>";	 }?>
			</td><td width="50" align="right">
			<? if($page!=$totalpage){
			echo "<a href=\"../order/orderlist_c.php".$querystring."page=$totalpage\"><img src=\"../resource/images/silkicons/resultset_last.gif\" width=\"16\" height=\"16\" border=0></a>";	 }}?>
			</td></tr></table>
            
<!--   Page running     -->


