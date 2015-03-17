<? include_once("../core/default.php"); ?>
<?

$order_id = $_GET['orderid'];

$query_data = new CSql();
$query_data->Connect();

$query_data->Query("select ord_code from eorder where eorderid=$order_id limit 1");
if($query_data->EOF){
	echo "NO EORDER ID : $order_id";
	exit();
}
$order_code = $query_data->Rs("ord_code");
$order_code = substr($query_data->Rs("ord_code"),0,strlen($query_data->Rs("ord_code"))-2);

$query_data->Query("select max(eorderid) as eorderid from eorder where ord_code like '$order_code%' ");

if($query_data->EOF){
	echo "NO EORDER ID : ord_code like '$order_code%'";
	exit();
}

$eorderid = $query_data->Rs("eorderid");

$sql = "insert into eorder (

ord_code, ord_no,ord_doc_id, ord_patientname, ord_cus_id, ord_date, ord_senddate, ord_arrivedate, ord_processdate, ord_sendbackdate, ord_gotdate, ord_paiddate, ord_archievedate, ord_releasedate, ord_docdate, ord_priority, ord_status, ord_operateday, ord_detail, ord_docnote, ord_remark, ord_typeofwork, ord_totalcost,ord_shipmethod 


)


select 


concat(left(ord_code,14) ,lpad(right(ord_code,2)+1,2,'0'))

, ord_no, ord_doc_id, ord_patientname, ord_cus_id,  now(), ord_senddate, now(), ord_processdate, ord_sendbackdate, ord_gotdate, ord_paiddate, ord_archievedate, ord_releasedate, ord_docdate, ord_priority, 2, ord_operateday, ord_detail, ord_docnote, ord_remark, 'Not edit yet', ord_totalcost ,ord_shipmethod


from eorder where eorderid = '$eorderid' limit 0,1";
//echo ($sql."<br>");
$query_data->Execute($sql);

$eid = $query_data->GetMaxID('eorder');

$sql = "insert into eorder_fix (
eorder_fixid, ordf_method, ordf_boxcolor, ordf_typeofworkt, ordf_shade, ordf_alloy, ordf_embrasure, ordf_pontic, ordf_ponticmm, ordf_optiont, ordf_observation, ordf_optremark, ordf_optmoreinfo 
)
select 
$eid, ordf_method, ordf_boxcolor, ordf_typeofworkt, ordf_shade, ordf_alloy, ordf_embrasure, ordf_pontic, ordf_ponticmm, ordf_optiont, ordf_observation, ordf_optremark, ordf_optmoreinfo 
from eorder_fix where eorder_fixid = '$eorderid' limit 0,1";
//echo ($sql."<br>");
$query_data->Execute($sql);


$sql = "insert into eorder_remove (
eorder_removeid, ordr_method, ordr_materialupper, ordr_materiallower, ordr_pie, ordr_cire, ordr_typeofworkt, ordr_option, ordr_shade, ordr_observation
)
select 
$eid, ordr_method, ordr_materialupper, ordr_materiallower, ordr_pie, ordr_cire, ordr_typeofworkt, ordr_option, ordr_shade, ordr_observation
from eorder_remove where eorder_removeid = '$eorderid' limit 0,1";
//echo ($sql."<br>");
$query_data->Execute($sql);

$sql = "insert into eorder_ortho (
eorder_orthoid, ordo_method, ordo_typeofworkt, ordo_shade, ordo_observation
)
select 
$eid,ordo_method, ordo_typeofworkt, ordo_shade, ordo_observation
from eorder_ortho where eorder_orthoid = '$eorderid' limit 0,1";
//echo ($sql."<br>");
$query_data->Execute($sql);





if(($usertype=='ST' || $usertype=='MN' || $usertype=='AD') &&  $userstfid>0){
	$data = $query_data;
	$data->Addnew();
	$data->TableName = "logbook";
	$data->Set("log_ord_id","$eorderid");
	$data->Set("log_stf_id","$userstfid");
	$data->Set("log_sec_id","$usersecid");
	$data->Set("log_type","'IN'");
	$data->Set("log_date","NOW()");
	$data->Update();

	$data->Query("select max(logbookid) as maxlog from logbook
			where log_ord_id=$eorderid and log_stf_id=$userstfid and
			log_sec_id=$usersecid and log_type='IN'");
	$maxlog = $data->Rs("maxlog");
	$data->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");

	$data->Addnew();
	$data->TableName = "logbook";
	$data->Set("log_ord_id","$eorderid");
	$data->Set("log_stf_id","$userstfid");
	$data->Set("log_sec_id","$usersecid");
	$data->Set("log_type","'OUT'");
	$data->Set("log_date","NOW()");
	$data->Update();

	$data->Query("select max(logbookid) as maxlog from logbook
			where log_ord_id=$eorderid and log_stf_id=$userstfid and
			log_sec_id=$usersecid and log_type='OUT'");
	$maxlog = $data->Rs("maxlog");
	$data->Execute(" insert into logbooktoday select * from logbook where logbookid=$maxlog ");

}












?>
<META http-equiv="refresh" content="0;URL=../eorder/eorder_edit.php?eorderid=<?=$eid?>">