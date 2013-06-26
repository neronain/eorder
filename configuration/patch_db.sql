update eorder,customer set ord_cache_cnt_id = cus_cnt_id where customerid = ord_cus_id;
update eordertoday,customer set ordt_cache_cnt_id = cus_cnt_id where customerid = ordt_cus_id;
update eordertoday,eorder set ordt_cache_cnt_id = ord_cache_cnt_id,ordt_cache_type = ord_cache_type where eordertodayid = eorderid;


