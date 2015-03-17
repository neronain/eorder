	<!-- general variable -->
   	<input type="hidden" name="eorder_id" id="eorder_id" value="<?=$eorder_id?>" />
	<input type="hidden" name="eorder_custid" id="eorder_custid" value="<?=$customer_id?>" />
    <input type="hidden" name="eorder_code" id="eorder_code" value="<?=$order_code?>" />
    
    <? if($usertype!='ST'){?> 
    	<input type="hidden" name="eorder_priority" id="eorder_priority" value="<?=$ordpriority?>" />
    <? } ?>
    
    <!-- fix-order variable -->
    <input type="hidden" name="fix_method" id="fix_method" value="<?=$fix_method?>" />
    <input type="hidden" name="fix_alloy" id="fix_alloy" value="<?=$fix_alloy?>" />
    <input type="hidden" name="fix_embrasure" id="fix_embrasure" value="<?=$fix_embrasure?>" />
    <input type="hidden" name="fix_pontic" id="fix_pontic" value="<?=$fix_pontic?>" />
    <input type="hidden" name="fix_box" id="fix_box" value="<?=$fix_box?>" />

    
	<!-- fix-order material -->
    <input type="hidden" name="fix_material[18]" id="fix_material[18]" value="<?=$fix_material[18]?>" />
    <input type="hidden" name="fix_material[17]" id="fix_material[17]" value="<?=$fix_material[17]?>" />
    <input type="hidden" name="fix_material[16]" id="fix_material[16]" value="<?=$fix_material[16]?>" />
    <input type="hidden" name="fix_material[15]" id="fix_material[15]" value="<?=$fix_material[15]?>" />
    <input type="hidden" name="fix_material[14]" id="fix_material[14]" value="<?=$fix_material[14]?>" />
    <input type="hidden" name="fix_material[13]" id="fix_material[13]" value="<?=$fix_material[13]?>" />
    <input type="hidden" name="fix_material[12]" id="fix_material[12]" value="<?=$fix_material[12]?>" />
    <input type="hidden" name="fix_material[11]" id="fix_material[11]" value="<?=$fix_material[11]?>" />
    <input type="hidden" name="fix_material[21]" id="fix_material[21]" value="<?=$fix_material[21]?>" />
    <input type="hidden" name="fix_material[22]" id="fix_material[22]" value="<?=$fix_material[22]?>" />
    <input type="hidden" name="fix_material[23]" id="fix_material[23]" value="<?=$fix_material[23]?>" />
    <input type="hidden" name="fix_material[24]" id="fix_material[24]" value="<?=$fix_material[24]?>" />
    <input type="hidden" name="fix_material[25]" id="fix_material[25]" value="<?=$fix_material[25]?>" />
    <input type="hidden" name="fix_material[26]" id="fix_material[26]" value="<?=$fix_material[26]?>" />
    <input type="hidden" name="fix_material[27]" id="fix_material[27]" value="<?=$fix_material[27]?>" />
    <input type="hidden" name="fix_material[28]" id="fix_material[28]" value="<?=$fix_material[28]?>" />
    <input type="hidden" name="fix_material[38]" id="fix_material[38]" value="<?=$fix_material[38]?>" />
    <input type="hidden" name="fix_material[37]" id="fix_material[37]" value="<?=$fix_material[37]?>" />
    <input type="hidden" name="fix_material[36]" id="fix_material[36]" value="<?=$fix_material[36]?>" />
    <input type="hidden" name="fix_material[35]" id="fix_material[35]" value="<?=$fix_material[35]?>" />
    <input type="hidden" name="fix_material[34]" id="fix_material[34]" value="<?=$fix_material[34]?>" />
    <input type="hidden" name="fix_material[33]" id="fix_material[33]" value="<?=$fix_material[33]?>" />
    <input type="hidden" name="fix_material[32]" id="fix_material[32]" value="<?=$fix_material[32]?>" />
    <input type="hidden" name="fix_material[31]" id="fix_material[31]" value="<?=$fix_material[31]?>" />
    <input type="hidden" name="fix_material[41]" id="fix_material[41]" value="<?=$fix_material[41]?>" />
    <input type="hidden" name="fix_material[42]" id="fix_material[42]" value="<?=$fix_material[42]?>" />
    <input type="hidden" name="fix_material[43]" id="fix_material[43]" value="<?=$fix_material[43]?>" />
    <input type="hidden" name="fix_material[44]" id="fix_material[44]" value="<?=$fix_material[44]?>" />
    <input type="hidden" name="fix_material[45]" id="fix_material[45]" value="<?=$fix_material[45]?>" />
    <input type="hidden" name="fix_material[46]" id="fix_material[46]" value="<?=$fix_material[46]?>" />
    <input type="hidden" name="fix_material[47]" id="fix_material[47]" value="<?=$fix_material[47]?>" />
    <input type="hidden" name="fix_material[48]" id="fix_material[48]" value="<?=$fix_material[48]?>" />

	<!-- fix-order option material -->
    <input type="hidden" name="fix_opt_mat[18]" id="fix_opt_mat[18]" value="<?=$fix_opt_mat[18]?>" />
    <input type="hidden" name="fix_opt_mat[17]" id="fix_opt_mat[17]" value="<?=$fix_opt_mat[17]?>" />
    <input type="hidden" name="fix_opt_mat[16]" id="fix_opt_mat[16]" value="<?=$fix_opt_mat[16]?>" />
    <input type="hidden" name="fix_opt_mat[15]" id="fix_opt_mat[15]" value="<?=$fix_opt_mat[15]?>" />
    <input type="hidden" name="fix_opt_mat[14]" id="fix_opt_mat[14]" value="<?=$fix_opt_mat[14]?>" />
    <input type="hidden" name="fix_opt_mat[13]" id="fix_opt_mat[13]" value="<?=$fix_opt_mat[13]?>" />
    <input type="hidden" name="fix_opt_mat[12]" id="fix_opt_mat[12]" value="<?=$fix_opt_mat[12]?>" />
    <input type="hidden" name="fix_opt_mat[11]" id="fix_opt_mat[11]" value="<?=$fix_opt_mat[11]?>" />
    <input type="hidden" name="fix_opt_mat[21]" id="fix_opt_mat[21]" value="<?=$fix_opt_mat[21]?>" />
    <input type="hidden" name="fix_opt_mat[22]" id="fix_opt_mat[22]" value="<?=$fix_opt_mat[22]?>" />
    <input type="hidden" name="fix_opt_mat[23]" id="fix_opt_mat[23]" value="<?=$fix_opt_mat[23]?>" />
    <input type="hidden" name="fix_opt_mat[24]" id="fix_opt_mat[24]" value="<?=$fix_opt_mat[24]?>" />
    <input type="hidden" name="fix_opt_mat[25]" id="fix_opt_mat[25]" value="<?=$fix_opt_mat[25]?>" />
    <input type="hidden" name="fix_opt_mat[26]" id="fix_opt_mat[26]" value="<?=$fix_opt_mat[26]?>" />
    <input type="hidden" name="fix_opt_mat[27]" id="fix_opt_mat[27]" value="<?=$fix_opt_mat[27]?>" />
    <input type="hidden" name="fix_opt_mat[28]" id="fix_opt_mat[28]" value="<?=$fix_opt_mat[28]?>" />
    <input type="hidden" name="fix_opt_mat[38]" id="fix_opt_mat[38]" value="<?=$fix_opt_mat[38]?>" />
    <input type="hidden" name="fix_opt_mat[37]" id="fix_opt_mat[37]" value="<?=$fix_opt_mat[37]?>" />
    <input type="hidden" name="fix_opt_mat[36]" id="fix_opt_mat[36]" value="<?=$fix_opt_mat[36]?>" />
    <input type="hidden" name="fix_opt_mat[35]" id="fix_opt_mat[35]" value="<?=$fix_opt_mat[35]?>" />
    <input type="hidden" name="fix_opt_mat[34]" id="fix_opt_mat[34]" value="<?=$fix_opt_mat[34]?>" />
    <input type="hidden" name="fix_opt_mat[33]" id="fix_opt_mat[33]" value="<?=$fix_opt_mat[33]?>" />
    <input type="hidden" name="fix_opt_mat[32]" id="fix_opt_mat[32]" value="<?=$fix_opt_mat[32]?>" />
    <input type="hidden" name="fix_opt_mat[31]" id="fix_opt_mat[31]" value="<?=$fix_opt_mat[31]?>" />
    <input type="hidden" name="fix_opt_mat[41]" id="fix_opt_mat[41]" value="<?=$fix_opt_mat[41]?>" />
    <input type="hidden" name="fix_opt_mat[42]" id="fix_opt_mat[42]" value="<?=$fix_opt_mat[42]?>" />
    <input type="hidden" name="fix_opt_mat[43]" id="fix_opt_mat[43]" value="<?=$fix_opt_mat[43]?>" />
    <input type="hidden" name="fix_opt_mat[44]" id="fix_opt_mat[44]" value="<?=$fix_opt_mat[44]?>" />
    <input type="hidden" name="fix_opt_mat[45]" id="fix_opt_mat[45]" value="<?=$fix_opt_mat[45]?>" />
    <input type="hidden" name="fix_opt_mat[46]" id="fix_opt_mat[46]" value="<?=$fix_opt_mat[46]?>" />
    <input type="hidden" name="fix_opt_mat[47]" id="fix_opt_mat[47]" value="<?=$fix_opt_mat[47]?>" />
    <input type="hidden" name="fix_opt_mat[48]" id="fix_opt_mat[48]" value="<?=$fix_opt_mat[48]?>" />
    
	<!-- fix-order attachment -->
    <input type="hidden" name="fix_attachment[18]" id="fix_attachment[18]" value="<?=$fix_attachment[18]?>" />
    <input type="hidden" name="fix_attachment[17]" id="fix_attachment[17]" value="<?=$fix_attachment[17]?>" />
    <input type="hidden" name="fix_attachment[16]" id="fix_attachment[16]" value="<?=$fix_attachment[16]?>" />
    <input type="hidden" name="fix_attachment[15]" id="fix_attachment[15]" value="<?=$fix_attachment[15]?>" />
    <input type="hidden" name="fix_attachment[14]" id="fix_attachment[14]" value="<?=$fix_attachment[14]?>" />
    <input type="hidden" name="fix_attachment[13]" id="fix_attachment[13]" value="<?=$fix_attachment[13]?>" />
    <input type="hidden" name="fix_attachment[12]" id="fix_attachment[12]" value="<?=$fix_attachment[12]?>" />
    <input type="hidden" name="fix_attachment[11]" id="fix_attachment[11]" value="<?=$fix_attachment[11]?>" />
    <input type="hidden" name="fix_attachment[21]" id="fix_attachment[21]" value="<?=$fix_attachment[21]?>" />
    <input type="hidden" name="fix_attachment[22]" id="fix_attachment[22]" value="<?=$fix_attachment[22]?>" />
    <input type="hidden" name="fix_attachment[23]" id="fix_attachment[23]" value="<?=$fix_attachment[23]?>" />
    <input type="hidden" name="fix_attachment[24]" id="fix_attachment[24]" value="<?=$fix_attachment[24]?>" />
    <input type="hidden" name="fix_attachment[25]" id="fix_attachment[25]" value="<?=$fix_attachment[25]?>" />
    <input type="hidden" name="fix_attachment[26]" id="fix_attachment[26]" value="<?=$fix_attachment[26]?>" />
    <input type="hidden" name="fix_attachment[27]" id="fix_attachment[27]" value="<?=$fix_attachment[27]?>" />
    <input type="hidden" name="fix_attachment[28]" id="fix_attachment[28]" value="<?=$fix_attachment[28]?>" />
    <input type="hidden" name="fix_attachment[38]" id="fix_attachment[38]" value="<?=$fix_attachment[38]?>" />
    <input type="hidden" name="fix_attachment[37]" id="fix_attachment[37]" value="<?=$fix_attachment[37]?>" />
    <input type="hidden" name="fix_attachment[36]" id="fix_attachment[36]" value="<?=$fix_attachment[36]?>" />
    <input type="hidden" name="fix_attachment[35]" id="fix_attachment[35]" value="<?=$fix_attachment[35]?>" />
    <input type="hidden" name="fix_attachment[34]" id="fix_attachment[34]" value="<?=$fix_attachment[34]?>" />
    <input type="hidden" name="fix_attachment[33]" id="fix_attachment[33]" value="<?=$fix_attachment[33]?>" />
    <input type="hidden" name="fix_attachment[32]" id="fix_attachment[32]" value="<?=$fix_attachment[32]?>" />
    <input type="hidden" name="fix_attachment[31]" id="fix_attachment[31]" value="<?=$fix_attachment[31]?>" />
    <input type="hidden" name="fix_attachment[41]" id="fix_attachment[41]" value="<?=$fix_attachment[41]?>" />
    <input type="hidden" name="fix_attachment[42]" id="fix_attachment[42]" value="<?=$fix_attachment[42]?>" />
    <input type="hidden" name="fix_attachment[43]" id="fix_attachment[43]" value="<?=$fix_attachment[43]?>" />
    <input type="hidden" name="fix_attachment[44]" id="fix_attachment[44]" value="<?=$fix_attachment[44]?>" />
    <input type="hidden" name="fix_attachment[45]" id="fix_attachment[45]" value="<?=$fix_attachment[45]?>" />
    <input type="hidden" name="fix_attachment[46]" id="fix_attachment[46]" value="<?=$fix_attachment[46]?>" />
    <input type="hidden" name="fix_attachment[47]" id="fix_attachment[47]" value="<?=$fix_attachment[47]?>" />
    <input type="hidden" name="fix_attachment[48]" id="fix_attachment[48]" value="<?=$fix_attachment[48]?>" />
     
    <!-- fix-order step bar / milling -->
    <input type="hidden" name="fix_stepbar[18]" id="fix_stepbar[18]" value="<?=$fix_stepbar[18]?>" />
    <input type="hidden" name="fix_stepbar[17]" id="fix_stepbar[17]" value="<?=$fix_stepbar[17]?>" />
    <input type="hidden" name="fix_stepbar[16]" id="fix_stepbar[16]" value="<?=$fix_stepbar[16]?>" />
    <input type="hidden" name="fix_stepbar[15]" id="fix_stepbar[15]" value="<?=$fix_stepbar[15]?>" />
    <input type="hidden" name="fix_stepbar[14]" id="fix_stepbar[14]" value="<?=$fix_stepbar[14]?>" />
    <input type="hidden" name="fix_stepbar[13]" id="fix_stepbar[13]" value="<?=$fix_stepbar[13]?>" />
    <input type="hidden" name="fix_stepbar[12]" id="fix_stepbar[12]" value="<?=$fix_stepbar[12]?>" />
    <input type="hidden" name="fix_stepbar[11]" id="fix_stepbar[11]" value="<?=$fix_stepbar[11]?>" />
    <input type="hidden" name="fix_stepbar[21]" id="fix_stepbar[21]" value="<?=$fix_stepbar[21]?>" />
    <input type="hidden" name="fix_stepbar[22]" id="fix_stepbar[22]" value="<?=$fix_stepbar[22]?>" />
    <input type="hidden" name="fix_stepbar[23]" id="fix_stepbar[23]" value="<?=$fix_stepbar[23]?>" />
    <input type="hidden" name="fix_stepbar[24]" id="fix_stepbar[24]" value="<?=$fix_stepbar[24]?>" />
    <input type="hidden" name="fix_stepbar[25]" id="fix_stepbar[25]" value="<?=$fix_stepbar[25]?>" />
    <input type="hidden" name="fix_stepbar[26]" id="fix_stepbar[26]" value="<?=$fix_stepbar[26]?>" />
    <input type="hidden" name="fix_stepbar[27]" id="fix_stepbar[27]" value="<?=$fix_stepbar[27]?>" />
    <input type="hidden" name="fix_stepbar[28]" id="fix_stepbar[28]" value="<?=$fix_stepbar[28]?>" />
    <input type="hidden" name="fix_stepbar[38]" id="fix_stepbar[38]" value="<?=$fix_stepbar[38]?>" />
    <input type="hidden" name="fix_stepbar[37]" id="fix_stepbar[37]" value="<?=$fix_stepbar[37]?>" />
    <input type="hidden" name="fix_stepbar[36]" id="fix_stepbar[36]" value="<?=$fix_stepbar[36]?>" />
    <input type="hidden" name="fix_stepbar[35]" id="fix_stepbar[35]" value="<?=$fix_stepbar[35]?>" />
    <input type="hidden" name="fix_stepbar[34]" id="fix_stepbar[34]" value="<?=$fix_stepbar[34]?>" />
    <input type="hidden" name="fix_stepbar[33]" id="fix_stepbar[33]" value="<?=$fix_stepbar[33]?>" />
    <input type="hidden" name="fix_stepbar[32]" id="fix_stepbar[32]" value="<?=$fix_stepbar[32]?>" />
    <input type="hidden" name="fix_stepbar[31]" id="fix_stepbar[31]" value="<?=$fix_stepbar[31]?>" />
    <input type="hidden" name="fix_stepbar[41]" id="fix_stepbar[41]" value="<?=$fix_stepbar[41]?>" />
    <input type="hidden" name="fix_stepbar[42]" id="fix_stepbar[42]" value="<?=$fix_stepbar[42]?>" />
    <input type="hidden" name="fix_stepbar[43]" id="fix_stepbar[43]" value="<?=$fix_stepbar[43]?>" />
    <input type="hidden" name="fix_stepbar[44]" id="fix_stepbar[44]" value="<?=$fix_stepbar[44]?>" />
    <input type="hidden" name="fix_stepbar[45]" id="fix_stepbar[45]" value="<?=$fix_stepbar[45]?>" />
    <input type="hidden" name="fix_stepbar[46]" id="fix_stepbar[46]" value="<?=$fix_stepbar[46]?>" />
    <input type="hidden" name="fix_stepbar[47]" id="fix_stepbar[47]" value="<?=$fix_stepbar[47]?>" />
    <input type="hidden" name="fix_stepbar[48]" id="fix_stepbar[48]" value="<?=$fix_stepbar[48]?>" />
    
    <!-- fix-order porcelain margin -->
    <input type="hidden" name="fix_porcelain[18]" id="fix_porcelain[18]" value="<?=$fix_porcelain[18]?>" />
    <input type="hidden" name="fix_porcelain[17]" id="fix_porcelain[17]" value="<?=$fix_porcelain[17]?>" />
    <input type="hidden" name="fix_porcelain[16]" id="fix_porcelain[16]" value="<?=$fix_porcelain[16]?>" />
    <input type="hidden" name="fix_porcelain[15]" id="fix_porcelain[15]" value="<?=$fix_porcelain[15]?>" />
    <input type="hidden" name="fix_porcelain[14]" id="fix_porcelain[14]" value="<?=$fix_porcelain[14]?>" />
    <input type="hidden" name="fix_porcelain[13]" id="fix_porcelain[13]" value="<?=$fix_porcelain[13]?>" />
    <input type="hidden" name="fix_porcelain[12]" id="fix_porcelain[12]" value="<?=$fix_porcelain[12]?>" />
    <input type="hidden" name="fix_porcelain[11]" id="fix_porcelain[11]" value="<?=$fix_porcelain[11]?>" />
    <input type="hidden" name="fix_porcelain[21]" id="fix_porcelain[21]" value="<?=$fix_porcelain[21]?>" />
    <input type="hidden" name="fix_porcelain[22]" id="fix_porcelain[22]" value="<?=$fix_porcelain[22]?>" />
    <input type="hidden" name="fix_porcelain[23]" id="fix_porcelain[23]" value="<?=$fix_porcelain[23]?>" />
    <input type="hidden" name="fix_porcelain[24]" id="fix_porcelain[24]" value="<?=$fix_porcelain[24]?>" />
    <input type="hidden" name="fix_porcelain[25]" id="fix_porcelain[25]" value="<?=$fix_porcelain[25]?>" />
    <input type="hidden" name="fix_porcelain[26]" id="fix_porcelain[26]" value="<?=$fix_porcelain[26]?>" />
    <input type="hidden" name="fix_porcelain[27]" id="fix_porcelain[27]" value="<?=$fix_porcelain[27]?>" />
    <input type="hidden" name="fix_porcelain[28]" id="fix_porcelain[28]" value="<?=$fix_porcelain[28]?>" />
    <input type="hidden" name="fix_porcelain[38]" id="fix_porcelain[38]" value="<?=$fix_porcelain[38]?>" />
    <input type="hidden" name="fix_porcelain[37]" id="fix_porcelain[37]" value="<?=$fix_porcelain[37]?>" />
    <input type="hidden" name="fix_porcelain[36]" id="fix_porcelain[36]" value="<?=$fix_porcelain[36]?>" />
    <input type="hidden" name="fix_porcelain[35]" id="fix_porcelain[35]" value="<?=$fix_porcelain[35]?>" />
    <input type="hidden" name="fix_porcelain[34]" id="fix_porcelain[34]" value="<?=$fix_porcelain[34]?>" />
    <input type="hidden" name="fix_porcelain[33]" id="fix_porcelain[33]" value="<?=$fix_porcelain[33]?>" />
    <input type="hidden" name="fix_porcelain[32]" id="fix_porcelain[32]" value="<?=$fix_porcelain[32]?>" />
    <input type="hidden" name="fix_porcelain[31]" id="fix_porcelain[31]" value="<?=$fix_porcelain[31]?>" />
    <input type="hidden" name="fix_porcelain[41]" id="fix_porcelain[41]" value="<?=$fix_porcelain[41]?>" />
    <input type="hidden" name="fix_porcelain[42]" id="fix_porcelain[42]" value="<?=$fix_porcelain[42]?>" />
    <input type="hidden" name="fix_porcelain[43]" id="fix_porcelain[43]" value="<?=$fix_porcelain[43]?>" />
    <input type="hidden" name="fix_porcelain[44]" id="fix_porcelain[44]" value="<?=$fix_porcelain[44]?>" />
    <input type="hidden" name="fix_porcelain[45]" id="fix_porcelain[45]" value="<?=$fix_porcelain[45]?>" />
    <input type="hidden" name="fix_porcelain[46]" id="fix_porcelain[46]" value="<?=$fix_porcelain[46]?>" />
    <input type="hidden" name="fix_porcelain[47]" id="fix_porcelain[47]" value="<?=$fix_porcelain[47]?>" />
    <input type="hidden" name="fix_porcelain[48]" id="fix_porcelain[48]" value="<?=$fix_porcelain[48]?>" /> 
       
    <!--fix-order bridge-->
    <input type="hidden" name="fix_bridge[0]" id="fix_bridge[0]" value="<?=$fix_bridge[0]?>" />
    <input type="hidden" name="fix_bridge[1]" id="fix_bridge[1]" value="<?=$fix_bridge[1]?>" />
    <input type="hidden" name="fix_bridge[2]" id="fix_bridge[2]" value="<?=$fix_bridge[2]?>" />
    <input type="hidden" name="fix_bridge[3]" id="fix_bridge[3]" value="<?=$fix_bridge[3]?>" />
    <input type="hidden" name="fix_bridge[4]" id="fix_bridge[4]" value="<?=$fix_bridge[4]?>" />
    <input type="hidden" name="fix_bridge[5]" id="fix_bridge[5]" value="<?=$fix_bridge[5]?>" />
    <input type="hidden" name="fix_bridge[6]" id="fix_bridge[6]" value="<?=$fix_bridge[6]?>" />
    <input type="hidden" name="fix_bridge[7]" id="fix_bridge[7]" value="<?=$fix_bridge[7]?>" />
    <input type="hidden" name="fix_bridge[8]" id="fix_bridge[8]" value="<?=$fix_bridge[8]?>" />
    <input type="hidden" name="fix_bridge[9]" id="fix_bridge[9]" value="<?=$fix_bridge[9]?>" />
    <input type="hidden" name="fix_bridge[10]" id="fix_bridge[10]" value="<?=$fix_bridge[10]?>" />
    <input type="hidden" name="fix_bridge[11]" id="fix_bridge[11]" value="<?=$fix_bridge[11]?>" />
    <input type="hidden" name="fix_bridge[12]" id="fix_bridge[12]" value="<?=$fix_bridge[12]?>" />
    <input type="hidden" name="fix_bridge[13]" id="fix_bridge[13]" value="<?=$fix_bridge[13]?>" />
    <input type="hidden" name="fix_bridge[14]" id="fix_bridge[14]" value="<?=$fix_bridge[14]?>" />
    <input type="hidden" name="fix_bridge[16]" id="fix_bridge[16]" value="<?=$fix_bridge[16]?>" />
    <input type="hidden" name="fix_bridge[17]" id="fix_bridge[17]" value="<?=$fix_bridge[17]?>" />
    <input type="hidden" name="fix_bridge[18]" id="fix_bridge[18]" value="<?=$fix_bridge[18]?>" />
    <input type="hidden" name="fix_bridge[19]" id="fix_bridge[19]" value="<?=$fix_bridge[19]?>" />
    <input type="hidden" name="fix_bridge[20]" id="fix_bridge[20]" value="<?=$fix_bridge[20]?>" />
    <input type="hidden" name="fix_bridge[21]" id="fix_bridge[21]" value="<?=$fix_bridge[21]?>" />
    <input type="hidden" name="fix_bridge[22]" id="fix_bridge[22]" value="<?=$fix_bridge[22]?>" />
    <input type="hidden" name="fix_bridge[23]" id="fix_bridge[23]" value="<?=$fix_bridge[23]?>" />
    <input type="hidden" name="fix_bridge[24]" id="fix_bridge[24]" value="<?=$fix_bridge[24]?>" />
    <input type="hidden" name="fix_bridge[25]" id="fix_bridge[25]" value="<?=$fix_bridge[25]?>" />
    <input type="hidden" name="fix_bridge[26]" id="fix_bridge[26]" value="<?=$fix_bridge[26]?>" />
    <input type="hidden" name="fix_bridge[27]" id="fix_bridge[27]" value="<?=$fix_bridge[27]?>" />
    <input type="hidden" name="fix_bridge[28]" id="fix_bridge[28]" value="<?=$fix_bridge[28]?>" />
    <input type="hidden" name="fix_bridge[29]" id="fix_bridge[29]" value="<?=$fix_bridge[29]?>" />
    <input type="hidden" name="fix_bridge[30]" id="fix_bridge[30]" value="<?=$fix_bridge[30]?>" />
    
    <!--fix-order shade-->
    <input type="hidden" name="fix_shade[0]" id="fix_shade[0]" value="<?=$fix_shade[0]?>" />
    <input type="hidden" name="fix_shade[1]" id="fix_shade[1]" value="<?=$fix_shade[1]?>" />
    <input type="hidden" name="fix_shade[2]" id="fix_shade[2]" value="<?=$fix_shade[2]?>" />
    <input type="hidden" name="fix_shade[3]" id="fix_shade[3]" value="<?=$fix_shade[3]?>" />

    <!-- fix-order option -->
    <input type="hidden" name="fix_option[MarginGoDeep]" id="fix_option[MarginGoDeep]" value="<?=isset($fix_option["MarginGoDeep"])? $fix_option["MarginGoDeep"] : 0?>" />
    <input type="hidden" name="fix_option[UnderOcclusion05mm]" id="fix_option[UnderOcclusion05mm]" value="<?=isset($fix_option["UnderOcclusion05mm"])? $fix_option["UnderOcclusion05mm"] : 0?>" />
    <input type="hidden" name="fix_option[UnderOcclusion10mm]" id="fix_option[UnderOcclusion10mm]" value="<?=isset($fix_option["UnderOcclusion10mm"])? $fix_option["UnderOcclusion10mm"] : 0?>" />
    <input type="hidden" name="fix_option[UnderOcclusion20mm]" id="fix_option[UnderOcclusion20mm]" value="<?=isset($fix_option["UnderOcclusion20mm"])? $fix_option["UnderOcclusion20mm"] : 0?>" />
    <input type="hidden" name="fix_option[NoMetalMargin]" id="fix_option[NoMetalMargin]" value="<?=isset($fix_option["NoMetalMargin"])? $fix_option["NoMetalMargin"] : 0?>" />
    <input type="hidden" name="fix_option[Metal margin 1 mm Lingual]" id="fix_option[Metal margin 1 mm Lingual]" value="<?=isset($fix_option["Metal margin 1 mm Lingual"])? $fix_option["Metal margin 1 mm Lingual"] : 0?>" />
    <input type="hidden" name="fix_option[Metal margin 0.5 mm Lingual]" id="fix_option[Metal margin 0.5 mm Lingual]" value="<?=isset($fix_option["Metal margin 0.5 mm Lingual"])? $fix_option["Metal margin 0.5 mm Lingual"] : 0?>" />
	<input type="hidden" name="fix_option[SmallMetalMarginAround]" id="fix_option[SmallMetalMarginAround]" value="<?=isset($fix_option["SmallMetalMarginAround"])? $fix_option["SmallMetalMarginAround"] : 0?>" />
    <input type="hidden" name="fix_option[Hair line metal margin Lingual]" id="fix_option[Hair line metal margin Lingual]" value="<?=isset($fix_option["Hair line metal margin Lingual"])? $fix_option["Hair line metal margin Lingual"] : 0?>" />
    <input type="hidden" name="fix_option[HairLineMetalMarginAround]" id="fix_option[HairLineMetalMarginAround]" value="<?=isset($fix_option["HairLineMetalMarginAround"])? $fix_option["HairLineMetalMarginAround"] : 0?>" />
    <input type="hidden" name="fix_option[No approximal contact]" id="fix_option[No approximal contact]" value="<?=isset($fix_option["No approximal contact"])? $fix_option["No approximal contact"] : 0?>" />
    <input type="hidden" name="fix_option[SmallTeeth]" id="fix_option[SmallTeeth]" value="<?=isset($fix_option["SmallTeeth"])? $fix_option["SmallTeeth"] : 0?>" />
    <input type="hidden" name="fix_option[RestPrepareForRPDTP]" id="fix_option[RestPrepareForRPDTP]" value="<?=isset($fix_option["RestPrepareForRPDTP"])? $fix_option["RestPrepareForRPDTP"] : 0?>" />
    <input type="hidden" name="fix_option[AdeptWithRPDTP]" id="fix_option[AdeptWithRPDTP]" value="<?=isset($fix_option["AdeptWithRPDTP"])? $fix_option["AdeptWithRPDTP"] : 0?>" />
    <input type="hidden" name="fix_option[NoSpaceMakePF]" id="fix_option[NoSpaceMakePF]" value="<?=isset($fix_option["NoSpaceMakePF"])? $fix_option["NoSpaceMakePF"] : 0?>" />
    <input type="hidden" name="fix_option[No anagonist]" id="fix_option[No anagonist]" value="<?=isset($fix_option["No anagonist"])? $fix_option["No anagonist"] : 0?>" />
    <input type="hidden" name="fix_option[PorcelainMargin]" id="fix_option[PorcelainMargin]" value="<?=isset($fix_option["PorcelainMargin"])? $fix_option["PorcelainMargin"] : 0?>" />
    <input type="hidden" name="fix_option[PorcelainMarginAround]" id="fix_option[PorcelainMarginAround]" value="<?=isset($fix_option["PorcelainMarginAround"])? $fix_option["PorcelainMarginAround"] : 0?>" />
    <input type="hidden" name="fix_option[PonticBuccalPalatalSmaller]" id="fix_option[PonticBuccalPalatalSmaller]" value="<?=isset($fix_option["PonticBuccalPalatalSmaller"])? $fix_option["PonticBuccalPalatalSmaller"] : 0?>" />
    <input type="hidden" name="fix_option[Crown endosed for shade/anatomy]" id="fix_option[Crown endosed for shade/anatomy]" value="<?=isset($fix_option["Crown endosed for shade/anatomy"])? $fix_option["Crown endosed for shade/anatomy"] : 0?>" />
    <input type="hidden" name="fix_option[Bridge enclosed for shade/anatomy]" id="fix_option[Bridge enclosed for shade/anatomy]" value="<?=isset($fix_option["Bridge enclosed for shade/anatomy"])? $fix_option["Bridge enclosed for shade/anatomy"] : 0?>" />
    <input type="hidden" name="fix_option[New Dentist]" id="fix_option[New Dentist]" value="<?=isset($fix_option["New Dentist"])? $fix_option["New Dentist"] : 0?>" />
    
    
	<input type="hidden" name="fix_remake[ChangeShade]" id="fix_remake[ChangeShade]" value="<?=isset($fix_remake["ChangeShade"])? $fix_remake["ChangeShade"] : 0?>" />
    <input type="hidden" name="fix_remake[ShortMargin]" id="fix_remake[ShortMargin]" value="<?=isset($fix_remake["ShortMargin"])? $fix_remake["ShortMargin"] : 0?>" />
    <input type="hidden" name="fix_remake[AddContactPoint]" id="fix_remake[AddContactPoint]" value="<?=isset($fix_remake["AddContactPoint"])? $fix_remake["AddContactPoint"] : 0?>" />
    <input type="hidden" name="fix_remake[RepairCeramic]" id="fix_remake[RepairCeramic]" value="<?=isset($fix_remake["RepairCeramic"])? $fix_remake["RepairCeramic"] : 0?>" />
    <input type="hidden" name="fix_remake[CeramicCracked]" id="fix_remake[CeramicCracked]" value="<?=isset($fix_remake["CeramicCracked"])? $fix_remake["CeramicCracked"] : 0?>" />
    <input type="hidden" name="fix_remake[CanNotInsert]" id="fix_remake[CanNotInsert]" value="<?=isset($fix_remake["CanNotInsert"])? $fix_remake["CanNotInsert"] : 0?>" />
    <input type="hidden" name="fix_remake[ChangeDesign]" id="fix_remake[ChangeDesign]" value="<?=isset($fix_remake["ChangeDesign"])? $fix_remake["ChangeDesign"] : 0?>" />
    <input type="hidden" name="fix_remake[WrongBite]" id="fix_remake[WrongBite]" value="<?=isset($fix_remake["WrongBite"])? $fix_remake["WrongBite"] : 0?>" />
    
    
    <input type="hidden" name="fix_enclosed[upper_tray]" id="fix_enclosed[upper_tray]" value="<?=isset($fix_enclosed["upper_tray"])? $fix_enclosed["upper_tray"] : 0?>" />
    <input type="hidden" name="fix_enclosed[lower_tray]" id="fix_enclosed[lower_tray]" value="<?=isset($fix_enclosed["lower_tray"])? $fix_enclosed["lower_tray"] : 0?>" />
    <input type="hidden" name="fix_enclosed[upper_special_tray]" id="fix_enclosed[upper_special_tray]" value="<?=isset($fix_enclosed["upper_special_tray"])? $fix_enclosed["upper_special_tray"] : 0?>" />
    <input type="hidden" name="fix_enclosed[lower_special_tray]" id="fix_enclosed[lower_special_tray]" value="<?=isset($fix_enclosed["lower_special_tray"])? $fix_enclosed["lower_special_tray"] : 0?>" />
    <input type="hidden" name="fix_enclosed[bite_silicone]" id="fix_enclosed[bite_silicone]" value="<?=isset($fix_enclosed["bite_silicone"])? $fix_enclosed["bite_silicone"] : 0?>" />
    <input type="hidden" name="fix_enclosed[bite-wax]" id="fix_enclosed[bite-wax]" value="<?=isset($fix_enclosed["bite-wax"])? $fix_enclosed["bite-wax"] : 0?>" />
    <input type="hidden" name="fix_enclosed[upper_model]" id="fix_enclosed[upper_model]" value="<?=isset($fix_enclosed["upper_model"])? $fix_enclosed["upper_model"] : 0?>" />
    <input type="hidden" name="fix_enclosed[lower_model]" id="fix_enclosed[lower_model]" value="<?=isset($fix_enclosed["lower_model"])? $fix_enclosed["lower_model"] : 0?>" />
    
    <input type="hidden" name="fix_shadeoption[None]" id="fix_shadeoption[None]" value="<?=isset($fix_shadeoption["None"])? $fix_shadeoption["None"] : 0?>" />
    <input type="hidden" name="fix_shadeoption[Translucent Gray]" id="fix_shadeoption[Translucent Gray]" value="<?=isset($fix_shadeoption["Translucent Gray"])? $fix_shadeoption["Translucent Gray"] : 0?>" />
    <input type="hidden" name="fix_shadeoption[Translucent White]" id="fix_shadeoption[Translucent White]" value="<?=isset($fix_shadeoption["Translucent White"])? $fix_shadeoption["Translucent White"] : 0?>" />
    <input type="hidden" name="fix_shadeoption[Translucent Blue]" id="fix_shadeoption[Translucent Blue]" value="<?=isset($fix_shadeoption["Translucent Blue"])? $fix_shadeoption["Translucent Blue"] : 0?>" />
    <input type="hidden" name="fix_shadeoption[Translucent Yellow]" id="fix_shadeoption[Translucent Yellow]" value="<?=isset($fix_shadeoption["Translucent Yellow"])? $fix_shadeoption["Translucent Yellow"] : 0?>" />
    <input type="hidden" name="fix_shadeoption[Translucent Orange]" id="fix_shadeoption[Translucent Orange]" value="<?=isset($fix_shadeoption["Translucent Orange"])? $fix_shadeoption["Translucent Orange"] : 0?>" />
    <input type="hidden" name="fix_shadeoption[Translucent Brown]" id="fix_shadeoption[Translucent Brown]" value="<?=isset($fix_shadeoption["Translucent Brown"])? $fix_shadeoption["Translucent Brown"] : 0?>" />
    <input type="hidden" name="fix_shadeoption[Transparent]" id="fix_shadeoption[Transparent]" value="<?=isset($fix_shadeoption["Transparent"])? $fix_shadeoption["Transparent"] : 0?>" />
    <input type="hidden" name="fix_shadeoption[CrackLines]" id="fix_shadeoption[CrackLines]" value="<?=isset($fix_shadeoption["CrackLines"])? $fix_shadeoption["CrackLines"] : 0?>" />
    <input type="hidden" name="fix_shadeoption[Infraction Line]" id="fix_shadeoption[Infraction Line]" value="<?=isset($fix_shadeoption["Infraction Line"])? $fix_shadeoption["Infraction Line"] : 0?>" />
    
    <!-- remove-order variable -->
    <input type="hidden" name="remove_method" id="remove_method" value="<?=$remove_method?>" />
    
    <input type="hidden" name="remove_mat[upper]" id="remove_mat[upper]" value="<?=isset($remove_mat["upper"]) ? $remove_mat["upper"] : "0000" ?>" />
     <input type="hidden" name="remove_mat[lower]" id="remove_mat[lower]" value="<?= isset($remove_mat["lower"]) ? $remove_mat["lower"] : "0000" ?>" />
    <input type="hidden" name="remove_pie[U]" id="remove_pie[U]" value="<?= isset($remove_pie["U"]) ? $remove_pie["U"] : 0 ?>" />
     <input type="hidden" name="remove_pie[L]" id="remove_pie[L]" value="<?= isset($remove_pie["L"]) ? $remove_pie["L"] : 0 ?>" />
    <input type="hidden" name="remove_cire[U]" id="remove_cire[U]" value="<?= isset($remove_cire["U"]) ? $remove_cire["U"] : 0 ?>" />
    <input type="hidden" name="remove_cire[L]" id="remove_cire[L]" value="<?= isset($remove_cire["L"]) ? $remove_cire["L"] : 0 ?>" />
   <!--remove-order shade-->
    <input type="hidden" name="remove_shade[0]" id="remove_shade[0]" value="<?=$remove_shade[0]?>" />
    <input type="hidden" name="remove_shade[1]" id="remove_shade[1]" value="<?=$remove_shade[1]?>" />
    <input type="hidden" name="remove_shade[2]" id="remove_shade[2]" value="<?=$remove_shade[2]?>" />
    <input type="hidden" name="remove_shade[3]" id="remove_shade[3]" value="<?=$remove_shade[3]?>" />
	<!-- remove-order material -->
    <input type="hidden" name="remove_material[18]" id="remove_material[18]" value="<?=$remove_material[18]?>" />
    <input type="hidden" name="remove_material[17]" id="remove_material[17]" value="<?=$remove_material[17]?>" />
    <input type="hidden" name="remove_material[16]" id="remove_material[16]" value="<?=$remove_material[16]?>" />
    <input type="hidden" name="remove_material[15]" id="remove_material[15]" value="<?=$remove_material[15]?>" />
    <input type="hidden" name="remove_material[14]" id="remove_material[14]" value="<?=$remove_material[14]?>" />
    <input type="hidden" name="remove_material[13]" id="remove_material[13]" value="<?=$remove_material[13]?>" />
    <input type="hidden" name="remove_material[12]" id="remove_material[12]" value="<?=$remove_material[12]?>" />
    <input type="hidden" name="remove_material[11]" id="remove_material[11]" value="<?=$remove_material[11]?>" />
    <input type="hidden" name="remove_material[21]" id="remove_material[21]" value="<?=$remove_material[21]?>" />
    <input type="hidden" name="remove_material[22]" id="remove_material[22]" value="<?=$remove_material[22]?>" />
    <input type="hidden" name="remove_material[23]" id="remove_material[23]" value="<?=$remove_material[23]?>" />
    <input type="hidden" name="remove_material[24]" id="remove_material[24]" value="<?=$remove_material[24]?>" />
    <input type="hidden" name="remove_material[25]" id="remove_material[25]" value="<?=$remove_material[25]?>" />
    <input type="hidden" name="remove_material[26]" id="remove_material[26]" value="<?=$remove_material[26]?>" />
    <input type="hidden" name="remove_material[27]" id="remove_material[27]" value="<?=$remove_material[27]?>" />
    <input type="hidden" name="remove_material[28]" id="remove_material[28]" value="<?=$remove_material[28]?>" />
    <input type="hidden" name="remove_material[38]" id="remove_material[38]" value="<?=$remove_material[38]?>" />
    <input type="hidden" name="remove_material[37]" id="remove_material[37]" value="<?=$remove_material[37]?>" />
    <input type="hidden" name="remove_material[36]" id="remove_material[36]" value="<?=$remove_material[36]?>" />
    <input type="hidden" name="remove_material[35]" id="remove_material[35]" value="<?=$remove_material[35]?>" />
    <input type="hidden" name="remove_material[34]" id="remove_material[34]" value="<?=$remove_material[34]?>" />
    <input type="hidden" name="remove_material[33]" id="remove_material[33]" value="<?=$remove_material[33]?>" />
    <input type="hidden" name="remove_material[32]" id="remove_material[32]" value="<?=$remove_material[32]?>" />
    <input type="hidden" name="remove_material[31]" id="remove_material[31]" value="<?=$remove_material[31]?>" />
    <input type="hidden" name="remove_material[41]" id="remove_material[41]" value="<?=$remove_material[41]?>" />
    <input type="hidden" name="remove_material[42]" id="remove_material[42]" value="<?=$remove_material[42]?>" />
    <input type="hidden" name="remove_material[43]" id="remove_material[43]" value="<?=$remove_material[43]?>" />
    <input type="hidden" name="remove_material[44]" id="remove_material[44]" value="<?=$remove_material[44]?>" />
    <input type="hidden" name="remove_material[45]" id="remove_material[45]" value="<?=$remove_material[45]?>" />
    <input type="hidden" name="remove_material[46]" id="remove_material[46]" value="<?=$remove_material[46]?>" />
    <input type="hidden" name="remove_material[47]" id="remove_material[47]" value="<?=$remove_material[47]?>" />
    <input type="hidden" name="remove_material[48]" id="remove_material[48]" value="<?=$remove_material[48]?>" />
	<!-- remove-order option material -->
    <input type="hidden" name="remove_opt_mat[18]" id="remove_opt_mat[18]" value="<?=$remove_opt_mat[18]?>" />
    <input type="hidden" name="remove_opt_mat[17]" id="remove_opt_mat[17]" value="<?=$remove_opt_mat[17]?>" />
    <input type="hidden" name="remove_opt_mat[16]" id="remove_opt_mat[16]" value="<?=$remove_opt_mat[16]?>" />
    <input type="hidden" name="remove_opt_mat[15]" id="remove_opt_mat[15]" value="<?=$remove_opt_mat[15]?>" />
    <input type="hidden" name="remove_opt_mat[14]" id="remove_opt_mat[14]" value="<?=$remove_opt_mat[14]?>" />
    <input type="hidden" name="remove_opt_mat[13]" id="remove_opt_mat[13]" value="<?=$remove_opt_mat[13]?>" />
    <input type="hidden" name="remove_opt_mat[12]" id="remove_opt_mat[12]" value="<?=$remove_opt_mat[12]?>" />
    <input type="hidden" name="remove_opt_mat[11]" id="remove_opt_mat[11]" value="<?=$remove_opt_mat[11]?>" />
    <input type="hidden" name="remove_opt_mat[21]" id="remove_opt_mat[21]" value="<?=$remove_opt_mat[21]?>" />
    <input type="hidden" name="remove_opt_mat[22]" id="remove_opt_mat[22]" value="<?=$remove_opt_mat[22]?>" />
    <input type="hidden" name="remove_opt_mat[23]" id="remove_opt_mat[23]" value="<?=$remove_opt_mat[23]?>" />
    <input type="hidden" name="remove_opt_mat[24]" id="remove_opt_mat[24]" value="<?=$remove_opt_mat[24]?>" />
    <input type="hidden" name="remove_opt_mat[25]" id="remove_opt_mat[25]" value="<?=$remove_opt_mat[25]?>" />
    <input type="hidden" name="remove_opt_mat[26]" id="remove_opt_mat[26]" value="<?=$remove_opt_mat[26]?>" />
    <input type="hidden" name="remove_opt_mat[27]" id="remove_opt_mat[27]" value="<?=$remove_opt_mat[27]?>" />
    <input type="hidden" name="remove_opt_mat[28]" id="remove_opt_mat[28]" value="<?=$remove_opt_mat[28]?>" />
    <input type="hidden" name="remove_opt_mat[38]" id="remove_opt_mat[38]" value="<?=$remove_opt_mat[38]?>" />
    <input type="hidden" name="remove_opt_mat[37]" id="remove_opt_mat[37]" value="<?=$remove_opt_mat[37]?>" />
    <input type="hidden" name="remove_opt_mat[36]" id="remove_opt_mat[36]" value="<?=$remove_opt_mat[36]?>" />
    <input type="hidden" name="remove_opt_mat[35]" id="remove_opt_mat[35]" value="<?=$remove_opt_mat[35]?>" />
    <input type="hidden" name="remove_opt_mat[34]" id="remove_opt_mat[34]" value="<?=$remove_opt_mat[34]?>" />
    <input type="hidden" name="remove_opt_mat[33]" id="remove_opt_mat[33]" value="<?=$remove_opt_mat[33]?>" />
    <input type="hidden" name="remove_opt_mat[32]" id="remove_opt_mat[32]" value="<?=$remove_opt_mat[32]?>" />
    <input type="hidden" name="remove_opt_mat[31]" id="remove_opt_mat[31]" value="<?=$remove_opt_mat[31]?>" />
    <input type="hidden" name="remove_opt_mat[41]" id="remove_opt_mat[41]" value="<?=$remove_opt_mat[41]?>" />
    <input type="hidden" name="remove_opt_mat[42]" id="remove_opt_mat[42]" value="<?=$remove_opt_mat[42]?>" />
    <input type="hidden" name="remove_opt_mat[43]" id="remove_opt_mat[43]" value="<?=$remove_opt_mat[43]?>" />
    <input type="hidden" name="remove_opt_mat[44]" id="remove_opt_mat[44]" value="<?=$remove_opt_mat[44]?>" />
    <input type="hidden" name="remove_opt_mat[45]" id="remove_opt_mat[45]" value="<?=$remove_opt_mat[45]?>" />
    <input type="hidden" name="remove_opt_mat[46]" id="remove_opt_mat[46]" value="<?=$remove_opt_mat[46]?>" />
    <input type="hidden" name="remove_opt_mat[47]" id="remove_opt_mat[47]" value="<?=$remove_opt_mat[47]?>" />
    <input type="hidden" name="remove_opt_mat[48]" id="remove_opt_mat[48]" value="<?=$remove_opt_mat[48]?>" />
    
	<!-- remove-order attachment -->
    <input type="hidden" name="remove_attachment[18]" id="remove_attachment[18]" value="<?=$remove_attachment[18]?>" />
    <input type="hidden" name="remove_attachment[17]" id="remove_attachment[17]" value="<?=$remove_attachment[17]?>" />
    <input type="hidden" name="remove_attachment[16]" id="remove_attachment[16]" value="<?=$remove_attachment[16]?>" />
    <input type="hidden" name="remove_attachment[15]" id="remove_attachment[15]" value="<?=$remove_attachment[15]?>" />
    <input type="hidden" name="remove_attachment[14]" id="remove_attachment[14]" value="<?=$remove_attachment[14]?>" />
    <input type="hidden" name="remove_attachment[13]" id="remove_attachment[13]" value="<?=$remove_attachment[13]?>" />
    <input type="hidden" name="remove_attachment[12]" id="remove_attachment[12]" value="<?=$remove_attachment[12]?>" />
    <input type="hidden" name="remove_attachment[11]" id="remove_attachment[11]" value="<?=$remove_attachment[11]?>" />
    <input type="hidden" name="remove_attachment[21]" id="remove_attachment[21]" value="<?=$remove_attachment[21]?>" />
    <input type="hidden" name="remove_attachment[22]" id="remove_attachment[22]" value="<?=$remove_attachment[22]?>" />
    <input type="hidden" name="remove_attachment[23]" id="remove_attachment[23]" value="<?=$remove_attachment[23]?>" />
    <input type="hidden" name="remove_attachment[24]" id="remove_attachment[24]" value="<?=$remove_attachment[24]?>" />
    <input type="hidden" name="remove_attachment[25]" id="remove_attachment[25]" value="<?=$remove_attachment[25]?>" />
    <input type="hidden" name="remove_attachment[26]" id="remove_attachment[26]" value="<?=$remove_attachment[26]?>" />
    <input type="hidden" name="remove_attachment[27]" id="remove_attachment[27]" value="<?=$remove_attachment[27]?>" />
    <input type="hidden" name="remove_attachment[28]" id="remove_attachment[28]" value="<?=$remove_attachment[28]?>" />
    <input type="hidden" name="remove_attachment[38]" id="remove_attachment[38]" value="<?=$remove_attachment[38]?>" />
    <input type="hidden" name="remove_attachment[37]" id="remove_attachment[37]" value="<?=$remove_attachment[37]?>" />
    <input type="hidden" name="remove_attachment[36]" id="remove_attachment[36]" value="<?=$remove_attachment[36]?>" />
    <input type="hidden" name="remove_attachment[35]" id="remove_attachment[35]" value="<?=$remove_attachment[35]?>" />
    <input type="hidden" name="remove_attachment[34]" id="remove_attachment[34]" value="<?=$remove_attachment[34]?>" />
    <input type="hidden" name="remove_attachment[33]" id="remove_attachment[33]" value="<?=$remove_attachment[33]?>" />
    <input type="hidden" name="remove_attachment[32]" id="remove_attachment[32]" value="<?=$remove_attachment[32]?>" />
    <input type="hidden" name="remove_attachment[31]" id="remove_attachment[31]" value="<?=$remove_attachment[31]?>" />
    <input type="hidden" name="remove_attachment[41]" id="remove_attachment[41]" value="<?=$remove_attachment[41]?>" />
    <input type="hidden" name="remove_attachment[42]" id="remove_attachment[42]" value="<?=$remove_attachment[42]?>" />
    <input type="hidden" name="remove_attachment[43]" id="remove_attachment[43]" value="<?=$remove_attachment[43]?>" />
    <input type="hidden" name="remove_attachment[44]" id="remove_attachment[44]" value="<?=$remove_attachment[44]?>" />
    <input type="hidden" name="remove_attachment[45]" id="remove_attachment[45]" value="<?=$remove_attachment[45]?>" />
    <input type="hidden" name="remove_attachment[46]" id="remove_attachment[46]" value="<?=$remove_attachment[46]?>" />
    <input type="hidden" name="remove_attachment[47]" id="remove_attachment[47]" value="<?=$remove_attachment[47]?>" />
    <input type="hidden" name="remove_attachment[48]" id="remove_attachment[48]" value="<?=$remove_attachment[48]?>" />    
 
     <input type="hidden" name="gumfit_enable" id="gumfit_enable" value="<?=$gumfit_enable?>" />       
<!-- remove-order option  radio button -->
    <input type="hidden" name="remove_option[WireStrengthener]" id="remove_option[WireStrengthener]" value="<?=$remove_option["WireStrengthener"]?>" />    
    <input type="hidden" name="remove_option[RPDAcrylic]" id="remove_option[RPDAcrylic]" value="<?=$remove_option["RPDAcrylic"]?>" />    
    <input type="hidden" name="remove_option[TeethSetup]" id="remove_option[TeethSetup]" value="<?=$remove_option["TeethSetup"]?>" />    
    <input type="hidden" name="remove_option[GumFit]" id="remove_option[GumFit]" value="<?=$remove_option["GumFit"]?>" />    
     <input type="hidden" name="remove_option[TPOrderAcrylic]" id="remove_option[TPOrderAcrylic]" value="<?=$remove_option["TPOrderAcrylic"]?>" />    
     <input type="hidden" name="remove_option[TPOrderGrid]" id="remove_option[TPOrderGrid]" value="<?=$remove_option["TPOrderGrid"]?>" />    
      <input type="hidden" name="remove_option[SpecialTray]" id="remove_option[SpecialTray]" value="<?=$remove_option["SpecialTray"]?>" />    
      <input type="hidden" name="remove_option[Removework]" id="remove_option[Removework]" value="<?=$remove_option["Removework"]?>" />    
  <!-- remove-order option  checkbox button -->
    <input type="hidden" name="remove_option[SpecialRequest][Backing]" id="remove_option[SpecialRequest][Backing]" value="<?=$remove_option["SpecialRequest"]["Backing"]?>" />
    <input type="hidden" name="remove_option[SpecialRequest][DummyToothMetal]" id="remove_option[SpecialRequest][DummyToothMetal]" value="<?=$remove_option["SpecialRequest"]["DummyToothMetal"]?>" />    
    <input type="hidden" name="remove_option[SpecialRequest][StressBroken]" id="remove_option[SpecialRequest][StressBroken]" value="<?=$remove_option["SpecialRequest"]["StressBroken"]?>" />    
    <input type="hidden" name="remove_option[SpecialRequest][Boxing]" id="remove_option[SpecialRequest][Boxing]" value="<?=$remove_option["SpecialRequest"]["Boxing"]?>" />
<!------------------------------------------------------------------------------------------------>
    <input type="hidden" name="remove_option[TPExtra][Backing]" id="remove_option[TPExtra][Backing]" value="<?=$remove_option["TPExtra"]["Backing"]?>" />
    <input type="hidden" name="remove_option[TPExtra][WireClasp]" id="remove_option[TPExtra][WireClasp]" value="<?=$remove_option["TPExtra"]["WireClasp"]?>" />
    <input type="hidden" name="remove_option[TPExtra][CastClasp]" id="remove_option[TPExtra][CastClasp]" value="<?=$remove_option["TPExtra"]["CastClasp"]?>" />
    <input type="hidden" name="remove_option[TPExtra][WireRest]" id="remove_option[TPExtra][WireRest]" value="<?=$remove_option["TPExtra"]["WireRest"]?>" />
    <input type="hidden" name="remove_option[TPExtra][BonClasp]" id="remove_option[TPExtra][BonClasp]" value="<?=$remove_option["TPExtra"]["BonClasp"]?>" />
    <input type="hidden" name="remove_option[TPExtra][AcetalClasp]" id="remove_option[TPExtra][AcetalClasp]" value="<?=$remove_option["TPExtra"]["AcetalClasp"]?>" />
    <input type="hidden" name="remove_option[TPExtra][WirePlate]" id="remove_option[TPExtra][WirePlate]" value="<?=$remove_option["TPExtra"]["WirePlate"]?>" />
<!------------------------------------------------------------------------------------------------>
    <input type="hidden" name="remove_option[SpecialTrayBiteBlock][ReliefWax]" id="remove_option[SpecialTrayBiteBlock][ReliefWax]" value="<?=$remove_option["SpecialTrayBiteBlock"]["ReliefWax"]?>" />
    <input type="hidden" name="remove_option[SpecialTrayBiteBlock][CloseFit]" id="remove_option[SpecialTrayBiteBlock][CloseFit]" value="<?=$remove_option["SpecialTrayBiteBlock"]["CloseFit"]?>" />
    <input type="hidden" name="remove_option[SpecialTrayBiteBlock][BiteBlock]" id="remove_option[SpecialTrayBiteBlock][BiteBlock]" value="<?=$remove_option["SpecialTrayBiteBlock"]["BiteBlock"]?>" />
    <input type="hidden" name="remove_option[SpecialTrayBiteBlock][SpecialTray]" id="remove_option[SpecialTrayBiteBlock][SpecialTray]" value="<?=$remove_option["SpecialTrayBiteBlock"]["SpecialTray"]?>" />
    <input type="hidden" name="remove_option[SpecialTrayBiteBlock][BasePlate]" id="remove_option[SpecialTrayBiteBlock][BasePlate]" value="<?=$remove_option["SpecialTrayBiteBlock"]["BasePlate"]?>" />
    <input type="hidden" name="remove_option[SpecialTrayBiteBlock][Remark]" id="remove_option[SpecialTrayBiteBlock][Remark]" value="<?=$remove_option["SpecialTrayBiteBlock"]["Remark"]?>" />
<!------------------------------------------------------------------------------------------------>
	<input type="hidden" name="remove_enclosed[upper_tray]" id="remove_enclosed[upper_tray]" value="<?=isset($remove_enclosed["upper_tray"])? $remove_enclosed["upper_tray"] : 0?>" />
    <input type="hidden" name="remove_enclosed[lower_tray]" id="remove_enclosed[lower_tray]" value="<?=isset($remove_enclosed["lower_tray"])? $remove_enclosed["lower_tray"] : 0?>" />
    <input type="hidden" name="remove_enclosed[upper_special_tray]" id="remove_enclosed[upper_special_tray]" value="<?=isset($remove_enclosed["upper_special_tray"])? $remove_enclosed["upper_special_tray"] : 0?>" />
    <input type="hidden" name="remove_enclosed[lower_special_tray]" id="remove_enclosed[lower_special_tray]" value="<?=isset($remove_enclosed["lower_special_tray"])? $remove_enclosed["lower_special_tray"] : 0?>" />
    <input type="hidden" name="remove_enclosed[bite_silicone]" id="remove_enclosed[bite_silicone]" value="<?=isset($remove_enclosed["bite_silicone"])? $remove_enclosed["bite_silicone"] : 0?>" />
    <input type="hidden" name="remove_enclosed[bite-wax]" id="remove_enclosed[bite-wax]" value="<?=isset($remove_enclosed["bite-wax"])? $remove_enclosed["bite-wax"] : 0?>" />
    <input type="hidden" name="remove_enclosed[upper_model]" id="remove_enclosed[upper_model]" value="<?=isset($remove_enclosed["upper_model"])? $remove_enclosed["upper_model"] : 0?>" />
    <input type="hidden" name="remove_enclosed[lower_model]" id="remove_enclosed[lower_model]" value="<?=isset($remove_enclosed["lower_model"])? $remove_enclosed["lower_model"] : 0?>" />
<!------------------------------------------------------------------------------------------------>
    <!-- ortho-order variable -->
        <!--fix-order shade-->
    
    
    <input type="hidden" name="ortho_method" id="ortho_method" value="<?=$ortho_method?>" />

    <!--input type="hidden" name="ortho_shade[0]" id="ortho_shade[0]" value="<? //=$ortho_shade[0]?>" />
    <input type="hidden" name="ortho_shade[1]" id="ortho_shade[1]" value="<? //=$ortho_shade[1]?>" />
    <input type="hidden" name="ortho_shade[2]" id="ortho_shade[2]" value="<? //=$ortho_shade[2]?>" />
    <input type="hidden" name="ortho_shade[3]" id="ortho_shade[3]" value="<? //=$ortho_shade[3]?>" /-->
