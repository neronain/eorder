// JavaScript Document

function MAC5_SaveNo(no,orderid){
	showHTML('MAC5_DivNo','../mac5/process.php?act=saveno&no='+no+"&eorderid="+orderid);
	setFocus('MAC5_DateD');
}
function MAC5_SaveTaxNo(taxno,orderid){
	showHTML('MAC5_DivTaxNo','../mac5/process.php?act=savetaxno&taxno='+taxno+"&eorderid="+orderid);
	setFocus('MAC5_CustomerCode');
}
function MAC5_Init(){
	for(index=1;index<9;index++){
		itemcode = getValue('MAC5_DCode_'+index);
		obj = findObj('MAC5_DCode_'+index);
		obj.oldcode = itemcode;
	}
}

function MAC5_CheckItemCode(index,orderid){
	itemcode = getValue('MAC5_DCode_'+index);
	obj = findObj('MAC5_DCode_'+index);
	if(itemcode==obj.oldcode)return;
	obj.oldcode = itemcode;
	
	
	qty = getValue('MAC5_DQty_'+index);
	price = getValue('MAC5_DPrice_'+index);
	disc = getValue('MAC5_DDisc_'+index);
	qty = qty.replace(',',"");
	price = price.replace(',',"");
	disc = disc.replace(',',"");
	
	if(itemcode.length==0){
		setValue('MAC5_DQty_'+index,"");
		setValue('MAC5_DDisc_'+index,"");
	}else{// if(qty.length==0){
		setValue('MAC5_DQty_'+index,"");
		setValue('MAC5_DDisc_'+index,"0.00");
	}

	setValue('MAC5_DVcol_'+index,"");



		showHTML('MAC5_DivName_'+index,		'../mac5/process.php?act=processitemname&code='+itemcode+"&eorderid="+orderid+"&index="+index,
				 function(){
					//showHTML('MAC5_DName_'+index,		'../mac5/process.php?act=processitemname&code='+itemcode+"&eorderid="+orderid+"&index="+index);
					showHTML('MAC5_DUnit_'+index,		'../mac5/process.php?act=processitemunit&code='+itemcode+"&eorderid="+orderid+"&index="+index);
					showHTML('MAC5_DCog_'+index,		'../mac5/process.php?act=processitemcog&code='+itemcode+"&eorderid="+orderid+"&index="+index);
					 if(itemcode.length==0){
						 setValue('MAC5_DPrice_'+index,"");
						 writeit('MAC5_DSum_'+index,"");
						setTimeout("MAC5_RefreshSumOverall()",100);
						 
					 }//else if(price.length==0){
						showHTML('MAC5_DivDPrice_'+index,	'../mac5/process.php?act=processitemprice&code='+itemcode+"&eorderid="+orderid+"&index="+index,function(){
									setTimeout("MAC5_RefreshSumTotal("+index+","+orderid+")",100);
									//MAC5_RefreshSumTotal(index,orderid));
																																									});
					 //}
			});

	
}
function MAC5_SaveExchg(orderid){
	exchg = getValue('MAC5_Exchg');
	exchg = exchg.replace(',',"");
	showHTML('MAC5_DivExchg','../mac5/process.php?act=saveexchg&exchg='+exchg+"&eorderid="+orderid);
	setFocus('MAC5_DCode_1');
	
}

function MAC5_SaveDisCount(orderid){
	disc = getValue('MAC5_Disc');
	disc = disc.replace(',',"");
	showHTML('MAC5_DivDisc','../mac5/process.php?act=savediscount&disc='+disc+"&eorderid="+orderid,function(){
			setTimeout("MAC5_RefreshSumOverall()",100);
																											});
}
function MAC5_SaveName(index,orderid){
	name =  encodeTH(getValue('MAC5_DName_'+index));
	showHTML('MAC5_DivName_'+index,		'../mac5/process.php?act=savename&name='+name+"&eorderid="+orderid+"&index="+index);
	setFocus('MAC5_DVcol_'+index);
}

function MAC5_SaveVcol(index,orderid){
	vcol = getValue('MAC5_DVcol_'+index);
	obj = findObj('MAC5_DVcol_'+index);
	if(vcol==obj.oldcode)return;
	obj.oldcode = vcol;	
	
	
	vcol = encodeTH(getValue('MAC5_DVcol_'+index));
	showHTML('MAC5_DivVcol_'+index,		'../mac5/process.php?act=savevcol&vcol='+vcol+"&eorderid="+orderid+"&index="+index);
	setFocus('MAC5_DQty_'+index);
}

function MAC5_RefreshSumTotal(index,orderid){

	qty = getValue('MAC5_DQty_'+index);
	price = getValue('MAC5_DPrice_'+index);
	disc = getValue('MAC5_DDisc_'+index);
	qty = qty.replace(',',"");
	price = price.replace(',',"");
	disc = disc.replace(',',"");
	
	
	showHTML('MAC5_DSum_'+index,	'../mac5/process.php?act=calsum&qty='+qty+"&price="+price+"&discount="+disc+"&eorderid="+orderid+"&index="+index,MAC5_RefreshSumOverall);
	
	writeit('MAC5_DCog_'+index,format_number(qty*price,2));
	
	/*if(qty*price==0)
		writeit('MAC5_DSum_'+index,'');
	else
		writeit('MAC5_DSum_'+index,qty*price);
		*/
}
function MAC5_RefreshSumOverall(){
	total = 0;
	adisc = 0;
	for(index=1;index<9;index++){
		qty = getValue('MAC5_DQty_'+index);
		price = getValue('MAC5_DPrice_'+index);
		disc = getValue('MAC5_DDisc_'+index);
		qty = qty.replace(',',"");
		price = price.replace(',',"");
		disc = disc.replace(',',"");	

		adisc+=1*disc;
		
		total+=qty*price;
	}
	total = format_number(total,2);
	
	writeit('MAC_Total',total);
	
	adisc = format_number(adisc,2);
	writeit('MAC5_DivDisc',adisc);
	
	//disc = getValue('MAC5_Disc');
	//disc = disc.replace(',',"");
	//fdisc = parseFloat(disc);
	writeit('MAC5_Overall',format_number(total-adisc,2));
		


}

    function format_number(pnumber,decimals){
        if (isNaN(pnumber)) { return 0};
        if (pnumber=='') { return 0};
        var snum = new String(pnumber);
        var sec = snum.split('.');
        var whole = parseFloat(sec[0]);
        var result = '';
        if(sec.length > 1){
            var dec = new String(sec[1]);
           dec = String(parseFloat(sec[1])/Math.pow(10,(dec.length - decimals)));
           dec = String(whole + Math.round(parseFloat(dec))/Math.pow(10,decimals));
           var dot = dec.indexOf('.');
           if(dot == -1){
               dec += '.';
               dot = dec.indexOf('.');
           }
           while(dec.length <= dot + decimals) { dec += '0'; }
           result = dec;
       } else{
           var dot;
           var dec = new String(whole);
           dec += '.';
           dot = dec.indexOf('.');       
           while(dec.length <= dot + decimals) { dec += '0'; }
          result = dec;
       }   
       return result;
   }


function MAC5_ChangeProductName(val,orderid){
	showHTML('MAC5_DivProductName',	'../mac5/process.php?act=changeproductname&pdcname='+val+"&eorderid="+orderid+"");
	
}
function MAC5_ChangePriceGroup(val,orderid){
	showHTML('MAC5_DivPriceGroup',	'../mac5/process.php?act=changepricegroup&pricegroup='+val+"&eorderid="+orderid+"",
			 function(){
				/*for(index=1;index<9;index++){
					itemcode = getValue('MAC5_DCode_'+index);
					showHTML('MAC5_DivDPrice_'+index,	'../mac5/process.php?act=processitemprice&code='+itemcode+"&eorderid="+orderid+"&index="+index);
					writeit('MAC5_DSum_'+index,'');
				}*/
				showHTML('MAC5_DivExchg',	'../mac5/process.php?act=getexchange&pricegroup='+val+"&eorderid="+orderid+"");
				


			 });
}

function MAC5_SaveDateD(orderid){
	MAC5_SaveDate(orderid);
	setFocus('MAC5_DataD');
}
function MAC5_SaveDateM(orderid){
	MAC5_SaveDate(orderid);
	setFocus('MAC5_DataY');
}
function MAC5_SaveDateY(orderid){
	MAC5_SaveDate(orderid);
	setFocus('MAC5_CustomerCode');
}
function MAC5_SaveDate(orderid){
	d = getValue('MAC5_DataD');
	m = getValue('MAC5_DataM');
	y = getValue('MAC5_DataY');
	showHTML('MAC5_DivDate','../mac5/process.php?act=savedate&d='+d+'&m='+m+'&y='+y+'&eorderid='+orderid+"");
}





function MAC5_ItemSeletorClick(code,index,orderid){
	setValue('MAC5_DCode_'+index,code);
	MAC5_CheckItemCode(index,orderid)
}
function MAC5_CustomerSeletorClick(code,orderid){
	setValue('MAC5_CustomerCode',code);
	MAC5_CheckCustomerCode(orderid);
}
function MAC5_CheckCustomerCode(orderid){
	cuscode = getValue('MAC5_CustomerCode');
	if(cuscode.length>0){
	
		showHTML('MAC5_DivCutomerName','../mac5/process.php?act=processcustomercode&code='+encodeTH(cuscode)+"&eorderid="+orderid+"");
	}
	
}

function MAC5_CheckKeyDown(frmRequest,nextelement){
	//var frmRequest = document.getElementById('frmRequest');
	frmRequest.nextelement = nextelement;
	frmRequest.oldcode = frmRequest.value;
	if (frmRequest){
		   if (window.event){
			  frmRequest.onkeydown = frmRequest_KeyDown;
			  //frmRequest_KeyDown(false);
		   }
		   else{
			  frmRequest.onkeypress = frmRequest_KeyPress;
			  //frmRequest_KeyPress(false);
		   }
	}
	
	
	
	
	//setFocus('MAC5_DivVcol_1');
}



// ----------------------------------------------------------------------------
// frmRequest_KeyDown
//
// Description: event handler for request form key down event
//    translates returns on option buttons to a tab
//    this works only for IE, the keypress event is used for other browsers
//
// Arguments : 
//    e - the event object
//
// Dependencies : none
//
// History :
// 2006.07.13 - WSR : adapted to this project
//
function frmRequest_KeyDown( e )
   {

   var numCharCode;
   var elTarget;
   var strType;

   // get event if not passed
   if (!e) var e = window.event;

   // get character code of key pressed
   if (e.keyCode) numCharCode = e.keyCode;
   else if (e.which) numCharCode = e.which;

   // get target
   if (e.target) elTarget = e.target;
   else if (e.srcElement) elTarget = e.srcElement;
                                              
   // if form input field
   if ( elTarget.tagName.toLowerCase() == 'input' )
      {

      // get type
      strType = elTarget.getAttribute('type').toLowerCase();

      // based on type
      switch ( strType )
         {
         case 'checkbox' :
         case 'radio' :
         case 'text' :

            // if this is a return - change to tab
            if ( numCharCode == 13 )
               {
               if (e.keyCode) e.keyCode = 9;
               else if (e.which) e.which = 9;
               }
				setFocus(elTarget.nextelement);
            break;
            
         }

      }

   // process default action
   return true;

   }
//
// frmRequest_KeyDown
// ----------------------------------------------------------------------------


// ----------------------------------------------------------------------------
// frmRequest_KeyPress
//
// Description: event handler for request form key press event
//    cancels returns on form elements that would prematurely submit the form
//
// Arguments : 
//    e - the event object
//
// Dependencies : none
//
// History :
// 2006.07.13 - WSR : adapted to this project
//
function frmRequest_KeyPress( e )
   {

   var numCharCode;
   var elTarget;
   var strType;

   // get event if not passed
   if (!e) var e = window.event;

   // get character code of key pressed
   if (e.keyCode) numCharCode = e.keyCode;
   else if (e.which) numCharCode = e.which;

   // get target
   if (e.target) elTarget = e.target;
   else if (e.srcElement) elTarget = e.srcElement;
                                              
   // if form input field
   if ( elTarget.tagName.toLowerCase() == 'input' )
      {

      // get type
      strType = elTarget.getAttribute('type').toLowerCase();

      // based on type
      switch ( strType )
         {
         case 'checkbox' :
         case 'radio' :
         case 'text' :

            // if this is a return
            if ( numCharCode == 13 )
               {
               // cancel event to prevent form submission
			   //alert(elTarget.nextelement);
			   	setFocus(elTarget.nextelement);
               return false;
               }

            break;
            
         }

      }

   // process default action
   return true;

   }
//
// frmRequest_KeyPress

