<?
 	include_once("../core/config.php");
	include_once("../core/csql.php");

/*

SELECT * FROM `logcount`,eorder_fix,eorder where 
`logcount_type` = 'FIX' and
(`logcount_method` = '' or
`logcount_mat_short` = '' or
`logcount_mat_full` = '' ) and 
`logcount_ord_id` = eorder_fixid and
logcount_ord_id = eorderid


SELECT * FROM `logcount`,eorder_remove,eorder where 
`logcount_type` = 'REMOVE' and
(`logcount_method` = '' or
`logcount_mat_short` = '' or
`logcount_mat_full` = '' ) and 
`logcount_ord_id` = eorder_removeid and
logcount_ord_id = eorderid



SELECT * FROM `logcount`,eorder_ortho,eorder where 
`logcount_type` = 'ORTHO' and
(`logcount_method` = '' or
`logcount_mat_short` = '' or
`logcount_mat_full` = '' ) and 
`logcount_ord_id` = eorder_orthoid and
logcount_ord_id = eorderid



*/
/*
 
//Fix Finish after Try-in
   
update `logcount`,eorder_fix set 
`logcount_method` = 'Finish after Try-in'
where 
`logcount_type` = 'FIX' and
(`logcount_method` = '' or
`logcount_mat_short` = '' or
`logcount_mat_full` = '' ) and 
`logcount_ord_id` = eorder_fixid and
ordf_method = 'Finish after Try-in'  
  
  
*/

$cronSQL = new Csql();
$cronSQL->Connect();

$sql = "insert ignore into workperformance(workperf_type,workperf_method,workperf_mat_short,workperf_mat_full,workperf_sec_id)
select distinct logcount_type,logcount_method,logcount_mat_short,logcount_mat_full,logcount_sec_id from logcount where 
logcount_date > ".date('Y-m-d',mktime()-60*60*24*3);

/*."and 
logcount_method<> '' and logcount_mat_short <> '' and logcount_mat_full <> ''

";*/

$cronSQL->Execute($sql);



$sql = "update `eorder`,customer set `ord_cache_cnt_id` = cus_cnt_id where ord_cus_id = customerid and `ord_cache_cnt_id` = 0;";
$cronSQL->Execute($sql);

$sql = "update `eordertoday`,customer set `ordt_cache_cnt_id` = cus_cnt_id where ordt_cus_id = customerid and `ordt_cache_cnt_id` = 0;"
$cronSQL->Execute($sql);



