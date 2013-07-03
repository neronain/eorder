UPDATE eorder set ord_cache_type = '';

UPDATE eorder,eorder_fix SET ord_cache_type = CONCAT_WS(  ',', ord_cache_type,  'FIX' ) WHERE FIND_IN_SET(  'FIX', ord_cache_type ) =0 AND eorderid = eorder_fixid;
UPDATE eorder,eorder_remove SET ord_cache_type = CONCAT_WS(  ',', ord_cache_type,  'REMOVE' ) WHERE FIND_IN_SET(  'REMOVE', ord_cache_type ) =0 AND eorderid = eorder_removeid;
UPDATE eorder,eorder_ortho SET ord_cache_type = CONCAT_WS(  ',', ord_cache_type,  'ORTHO' ) WHERE FIND_IN_SET(  'ORTHO', ord_cache_type ) =0 AND eorderid = eorder_orthoid;


update eorder,customer set ord_cache_cnt_id = cus_cnt_id where customerid = ord_cus_id;
update eordertoday,customer set ordt_cache_cnt_id = cus_cnt_id where customerid = ordt_cus_id;
update eordertoday,eorder set ordt_cache_cnt_id = ord_cache_cnt_id,ordt_cache_type = ord_cache_type where eordertodayid = eorderid;


